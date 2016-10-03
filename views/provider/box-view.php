<?php if ( !defined('ABSPATH') ) { exit('Teste'); }
    
    $get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    if(isset($get['v'])){
        $id = $get['v'];
        
    }
 
 
?>


<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">INFORMAÇÕES DA EMPRESA</h4>
</div>
<div class="modal-body">
    <?php echo $id;     header("cache-control: no-cache, must-revalidate");?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar X</button>
</div>


