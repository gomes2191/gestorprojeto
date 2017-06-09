<?php
    if (!defined('ABSPATH')) {
        exit();
    }
echo 'Teste';
    # Verifica se existe o método get se existir chama função
    if (filter_input(INPUT_GET, 'v', FILTER_DEFAULT)) {
        $id_encode = filter_input(INPUT_GET, 'v', FILTER_DEFAULT);
        
        # Recebe os valores da consulta
        $modelo = $modelo->get_registro($id_encode);

        # Destroy variáveis não mais utilizada
        unset($id_encode);
    } else {
        # Retorna para página 'stock' caso não exista o id correspondente
        header('Location:' . HOME_URI . '/stock');
        exit();
    }
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> INFORMAÇÕES</h4>
</div>
<div class="modal-body">
    <ul class="list-inline list-modal-forn">
       <?= ($modelo['stock_cod']) ? '<li class="list-for list-group-item list-group-item-info list-group-item-text"><b>Código:</b> '.$modelo['stock_cod'].'</li>' : '' ?> 
       <?= ($modelo['stock_desc']) ? '<li class="list-group-item list-group-item-warning list-group-item-text"><b>Descrição:</b> '.$modelo['stock_desc'].'</li>' : '' ?>
       <?= ($modelo['stock_tipo_unit']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Tipo unitário:</b> '.$modelo['stock_tipo_unit'].'</li>' : '' ?>
       <?= ($modelo['stock_fornecedor']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Fornecedor:</b> '.$modelo['stock_fornecedor'].'</li>' : '' ?>
       <?= ($modelo['stock_inicial']) ? '<li class="list-group-item list-group-item-warning list-group-item-text"><b>Stoque inicial:</b> '.$modelo['stock_inicial'].'</li>' : '' ?>
       <?= ($modelo['stock_minimo']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Stoque minimo:</b> '.$modelo['stock_minimo'].'</li>' : '' ?>
       <?= ($modelo['stock_atual']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Estoque atual</b> '.$modelo['stock_atual'].'</li>' : '' ?>
       <?= ($modelo['stock_valor']) ? '<li class="list-group-item list-group-item-warning list-group-item-text"><b>Valor R$:</b> '.$modelo['stock_valor'].'</li>' : '' ?>
       <?= ($modelo['stock_info']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Informações extra:</b> '.$modelo['stock_info'].'</li>' : '' ?>
    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar X</button>
</div>

<?php 
    # Destroy a variavl não mais utilizada
    unset($modelo); 
?>