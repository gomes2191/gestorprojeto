<?php
    if (!defined('ABSPATH')) {
        exit;
    }
    
    //Verifica se existe caractres especiais no id
    $id = $modelo->avaliar($_GET['ag']);

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
    
    
    if ( isset($del_evento)) {
        
        $modelo->del_evento($id);
           
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
    <b>Início:</b> <mark><?= $inicio ?></mark> <b>Término:</b> <mark><?= $final ?></mark>
</div>

<!-- TESTE AJAX -->

<!-- TESTE AJAX -->

<br>
    <div class="btn-group">
        
        <a href="<?= HOME_URI ?>/agenda/index/del/<?= $id ?>" id="deletar" class="btn btn-sx btn-danger" title="Deletar" >
            <span class="glyphicon glyphicon-trash">Deletar</span>
        </a>
    </div>
