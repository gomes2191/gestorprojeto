<?php
$db = new PDO('mysql:host=localhost;dbname=migration_ov;charset=utf8', 'root', 'libre');

// Avaliar os dados inseridos pelo usuário e excluir caracteres indesejados.
function avaliar($valor) {
    $nopermitido = array("'", '\\', '<', '>', "\"");
    $valor_1 = str_replace($nopermitido, "", $valor);

    $valor_2 = filter_var($valor_1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    return $valor_2;
}

// Obtenemos el id del evento
/* @var $id type */
$id = avaliar($_GET['id']);


// Buscamos na base de dados as informações necessaria
$fetch_result = $db->query("SELECT * FROM  agendas WHERE `agenda_id`= $id LIMIT 1");

// Obtemos os dados relacionado aquele id
$row = $fetch_result->fetch(PDO::FETCH_ASSOC);
//var_dump($row);

// Paciente 
$agenda_pac = $row['agenda_pac'];

// Descrição
$agenda_proc = $row['agenda_proc'];

// Descrição
$agenda_desc = $row['agenda_desc'];

// Fecha inicio
$inicio = $row['agenda_start_normal'];

// Fecha Termino
$final = $row['agenda_end_normal'];

// Eliminar evento
if (isset($_POST['eliminar_evento'])) {
    $id = avaliar($_GET['id']);
    $sql = "DELETE FROM eventos WHERE id = $id";
    if ($conexion->query($sql)) {
        echo "Evento eliminado";
    } else {
        echo "El evento no se pudo eliminar";
    }
}
?>

<p>
<b>Paciente:</b><br> <?= $agenda_pac ?>
</p>
<p>
<b>Procedimento:</b>
<br> 
<?= $agenda_proc ?>
</p>
<p>
<b>Descrição:</b>
<br> 
<?= $agenda_desc ?>
</p>
<hr>
<b>Inicio:</b> <mark><?= $inicio ?></mark> <b>Terminio:</b> <mark><?= $final ?></mark> 

<form action="" method="post">

<br>
    <!-- Single button -->
    <div class="btn-group">
        <button type="submit" class="btn btn-sm btn-danger" name="eliminar_evento"> 
            <i class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></i> 
            Eliminar  
        </button>
    </div>
    <div class="btn-group">
        <button type="submit" class="btn btn-sm btn-primary right" name="editar"> 
            <i class="glyphicon glyphicon-edit" aria-hidden="true"></i> 
            Editar  
        </button>
    </div>
</form>

