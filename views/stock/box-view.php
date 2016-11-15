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
        # Retorna para página 'patrimony' caso não exista o id correspondente
        header('Location:' . HOME_URI . '/patrimony');
        exit();
    }
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> INFORMAÇÕES</h4>
</div>
<div class="modal-body">
    <ul class="list-inline list-modal-forn">
       <?= ($modelo['patrimony_cod']) ? '<li class="list-for list-group-item list-group-item-info list-group-item-text"><b>Código:</b> '.$modelo['patrimony_cod'].'</li>' : '' ?> 
       <?= ($modelo['patrimony_desc']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Descrição:</b> '.$modelo['patrimony_desc'].'</li>' : '' ?>
       <?= ($modelo['patrimony_data_aq']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Data de Aquisição:</b> '.$modelo['patrimony_data_aq'].'</li>' : '' ?>
       <?= ($modelo['patrimony_cor']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Cor:</b> '.$modelo['patrimony_cor'].'</li>' : '' ?>
       <?= ($modelo['patrimony_for']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Fornecedor:</b> '.$modelo['patrimony_for'].'</li>' : '' ?>
       <?= ($modelo['patrimony_dimen']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Dimensões:</b> '.$modelo['patrimony_dimen'].'</li>' : '' ?>
       <?= ($modelo['patrimony_setor']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Setor:</b> '.$modelo['patrimony_setor'].'</li>' : '' ?>
       <?= ($modelo['patrimony_valor']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Valor R$:</b> '.$modelo['patrimony_valor'].'</li>' : '' ?>
       <?= ($modelo['patrimony_garan']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Garantia:</b> '.$modelo['patrimony_garan'].'</li>' : '' ?>
       <?= ($modelo['patrimony_quant']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Quantidade:</b> '.$modelo['patrimony_quant'].'</li>' : '' ?>
       <?= ($modelo['patrimony_nf']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Nota Fiscal:</b> '.$modelo['patrimony_nf'].'</li>' : '' ?>
       <?= ($modelo['patrimony_info']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Informações extra:</b> '.$modelo['patrimony_info'].'</li>' : '' ?>
    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar X</button>
</div>

# Destroy a variavl não mais utilizada
<?php unset($modelo); ?>