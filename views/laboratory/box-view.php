<?php
    if (!defined('ABSPATH')) {
        exit();
    }

    # Verifica se existe o método get se existir chama função
    if (filter_input(INPUT_GET, 'v', FILTER_DEFAULT)) {
        $id_encode = filter_input(INPUT_GET, 'v', FILTER_DEFAULT);
        
        # Recebe os valores da consulta
        $modelo = $modelo->get_registro($id_encode);

        # Destroy variáveis não mais utilizada
        unset($id_encode);
    } else {
        # Retorna para página 'stock' caso não exista o id correspondente
        header('Location:' . HOME_URI . '/laboratory');
        exit();
    }
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> INFORMAÇÕES</h4>
</div>
<div class="modal-body">
    <ul class="list-inline list-modal-forn">
       <?= ($modelo['laboratory_nome']) ? '<li class="list-for list-group-item list-group-item-info list-group-item-text"><b>Nome da empresa:</b> '.$modelo['laboratory_nome'].'</li>' : '' ?> 
       <?= ($modelo['laboratory_cpf_cnpj']) ? '<li class="list-group-item list-group-item-warning list-group-item-text"><b>CPF / CNPJ:</b> '.$modelo['laboratory_cpf_cnpj'].'</li>' : '' ?>
       <?= ($modelo['laboratory_rs']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Razão social:</b> '.$modelo['laboratory_rs'].'</li>' : '' ?>
       <?= ($modelo['laboratory_at']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Fornecedor:</b> '.$modelo['laboratory_at'].'</li>' : '' ?>
       <?= ($modelo['laboratory_end']) ? '<li class="list-group-item list-group-item-warning list-group-item-text"><b>Stoque inicial:</b> '.$modelo['laboratory_end'].'</li>' : '' ?>
       <?= ($modelo['laboratory_bair']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Stoque minimo:</b> '.$modelo['laboratory_bair'].'</li>' : '' ?>
       <?= ($modelo['laboratory_cid']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Estoque atual</b> '.$modelo['laboratory_cid'].'</li>' : '' ?>
       <?= ($modelo['laboratory_uf']) ? '<li class="list-group-item list-group-item-warning list-group-item-text"><b>Valor R$:</b> '.$modelo['laboratory_uf'].'</li>' : '' ?>
       <?= ($modelo['laboratory_cep']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Informações extra:</b> '.$modelo['laboratory_cep'].'</li>' : '' ?>
    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar X</button>
</div>

<?php 
    # Destroy a variavl não mais utilizada
    unset($modelo); 
?>