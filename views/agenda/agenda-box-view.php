<?php
    if (!defined('ABSPATH')) {
        exit;
    }
    
    //Verifica se existe caractres especiais no id
    $id = $modelo->avaliar($_GET['id']);

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

<p class="texto"> DOM not carregado...</p>

<div class="trigger">Trigger</div>
<div class="result"></div>
<div class="log"></div>

<!-- TESTE AJAX -->

<form id="form-agenda-ajax">
    <div class="btn-group">
        <input type='hidden' id="metodo" value='del'>
    <!--<button id="deletar" class="btn btn-sx btn-danger" title="Deletar" >
            <span class="glyphicon glyphicon-trash">Deletar</span>
        </button>-->
        
        <input id="deletar" class="btn btn-sx btn-danger" type="submit" value="Deletar">
    </div>
</form>


<script>
    
//    TESTE AJAX 


$( document ).ajaxComplete( function(){
    $('.log').text('Ajax completado..');
});


    $('.trigger').click( function(){
        $('.result').load('../valida.html');
    });
    
    $(function (){
        
        $('.texto').text('Carregado DOM...');
        
    });
    
    
    
    
//    TESTE AJAX 
    
    
    $( function (){
        
        $('#form-agenda-ajax').submit(
           function(e){
               e.preventDefault();

              

               if($('#deletar').val() == 'Processando...') {
                   return (false);

               }

               $('#deletar').val('Processando...');

               $.ajax({
                   url: '',
                   type: 'post',
                   dataType: 'html',
                   data: {'metodo': $('#metodo').val()}


               }).done(function(data){

                    alert(data);

                   $('#deletar').val('Deletar');
                   $('#metodo').val('');


               });
        
        });
    
        
    } );
        
    
  
  
  
    
</script>


