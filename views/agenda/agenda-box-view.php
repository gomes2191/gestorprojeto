<?php
    if (!defined('ABSPATH')) {
        exit;
    }
    
    $id = $modelo->avaliar($_GET['id']);
    
    echo $id;

    $row = $modelo->get_evento_list($id);

    // Paciente 
    $agenda_pac = $row[0]['agenda_pac'];

    // Descrição
    $agenda_proc = $row[0]['agenda_proc'];

    // Descrição
    $agenda_desc = $row[0]['agenda_desc'];

    // Fecha inicio
    $inicio = $row[0]['agenda_start_normal'];

    // Fecha Termino
    $final = $row[0]['agenda_end_normal'];
    
    var_dump($_POST);
    // Eliminar evento
    if (isset($_POST['eliminar'])) {
        $sql = "DELETE FROM `agendas` WHERE `agenda_id` = $id";

        if ($db->query($sql)) {
            echo "Consulta eliminada";
        } else {
            echo "Não foi eliminado";
        }
    }
?>

<div>
    <p>
        <b>Paciente:</b>
        <br> 
        <?= $agenda_pac ?>
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

    <form id="ajax_form" action="" method="post">

        <br>
        <!-- Single button -->
        <div class="btn-group">
            <button type="submit" class="btn btn-sm btn-danger deleta" name="eliminar"> 
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
    
    
    
    
</div>




