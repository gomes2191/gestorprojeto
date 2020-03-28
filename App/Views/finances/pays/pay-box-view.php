<?php
    if (!defined('ABSPATH')) {
        exit();
    }

    # Verifica se existe o método get se existir chama função
    if (filter_input(INPUT_GET, 'v', FILTER_DEFAULT)) {
        $id_encode = filter_input(INPUT_GET, 'v', FILTER_DEFAULT);
        
        # Recebe os valores da consulta
        $modelo = $modelo->get_registro($id_encode);

        # Dstroy variáveis não mais utilizada
        unset($id_encode);
    } else {
        # Retorna para página 'stock' caso não exista o id correspondente
        header('Location:' . HOME_URI . '/covenant');
        exit();
    }
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> INFORMAÇÕES </h4>
</div>
<div class="modal-body">
    <ul class="list-inline list-modal-forn">
       <?= ($modelo['pay_venc']) ? '<li style="color: #666666" class="list-for list-group-item list-group-item-info list-group-item-text"><b>DATA DE VENCIMENTO:</b> '.$modelo['pay_venc'].'</li>' : '' ?> 
       <?= ($modelo['pay_date_pay']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>DATA DE PAGAMENTO:</b> '.$modelo['pay_date_pay'].'</li>' : '' ?>
       <?= ($modelo['pay_cat']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>CATEGORIA:</b> '.$modelo['pay_cat'].'</li>' : '' ?>
       <?= ($modelo['pay_desc']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>DESCRIÇÃO:</b> '.$modelo['pay_desc'].'</li>' : '' ?>
       <?= ($modelo['pay_val']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>Valor total R$:</b> '.$modelo['pay_val'].'</li>' : '' ?>
    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar X</button>
</div>

<?php 
    # Dstroy a variavel não mais utilizada
    //unset($modelo); 
    flush($modelo); 
?>