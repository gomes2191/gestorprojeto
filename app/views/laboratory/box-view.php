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
    <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> INFORMAÇÕES REFERENTE</h4>
</div>
<div class="modal-body">
    <ul class="list-inline list-modal-forn">
       <?= ($modelo['laboratory_nome']) ? '<li style="color: #666666" class="list-for list-group-item list-group-item-info list-group-item-text"><b>LABORATÓRIO:</b> '.$modelo['laboratory_nome'].'</li>' : '' ?> 
       <?= ($modelo['laboratory_cpf_cnpj']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>CPF / CNPJ:</b> '.$modelo['laboratory_cpf_cnpj'].'</li>' : '' ?>
       <?= ($modelo['laboratory_rs']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>RAZÃO SOCIAL:</b> '.$modelo['laboratory_rs'].'</li>' : '' ?>
       <?= ($modelo['laboratory_at']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>AREA DE ATUAÇÃO:</b> '.$modelo['laboratory_at'].'</li>' : '' ?>
       <?= ($modelo['laboratory_end']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>ENDEREÇO:</b> '.$modelo['laboratory_end'].'</li>' : '' ?>
       <?= ($modelo['laboratory_bair']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>BAIRRO:</b> '.$modelo['laboratory_bair'].'</li>' : '' ?>
       <?= ($modelo['laboratory_cid']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>CIDADE:</b> '.$modelo['laboratory_cid'].'</li>' : '' ?>
       <?= ($modelo['laboratory_uf']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>UF:</b> '.$modelo['laboratory_uf'].'</li>' : '' ?>
       <?= ($modelo['laboratory_cep']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>CEP:</b> '.$modelo['laboratory_cep'].'</li>' : '' ?>
       <?= ($modelo['laboratory_pais']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>PAIS:</b> '.$modelo['laboratory_pais'].'</li>' : '' ?>
       <?= ($modelo['laboratory_cel']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>CELULAR:</b> '.$modelo['laboratory_cel'].'</li>' : '' ?>
       <?= ($modelo['laboratory_tel_1']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>TELEFONE 1:</b> '.$modelo['laboratory_tel_1'].'</li>' : '' ?>
       <?= ($modelo['laboratory_tel_2']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>TELEFONE 2:</b> '.$modelo['laboratory_tel_2'].'</li>' : '' ?>
       <?= ($modelo['laboratory_insc_uf']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>INSCRIÇÃO ESTADUAL:</b> '.$modelo['laboratory_insc_uf'].'</li>' : '' ?>
       <?= ($modelo['laboratory_web_url']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>WEB SITE:</b> '.$modelo['laboratory_web_url'].'</li>' : '' ?>
       <?= ($modelo['laboratory_email']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>E-MAIL:</b> '.$modelo['laboratory_email'].'</li>' : '' ?>
       <?= ($modelo['laboratory_rep_nome']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>REPRESENTANTE NOME:</b> '.$modelo['laboratory_rep_nome'].'</li>' : '' ?>
       <?= ($modelo['laboratory_rep_apelido']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>REPRESENTANTE APELIDO:</b> '.$modelo['laboratory_rep_apelido'].'</li>' : '' ?>
       <?= ($modelo['laboratory_rep_cel']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>REPRESENTANTE CELULAR:</b> '.$modelo['laboratory_rep_cel'].'</li>' : '' ?>
       <?= ($modelo['laboratory_rep_tel_1']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>REPRESENTANTE TELEFONE 1:</b> '.$modelo['laboratory_rep_tel_1'].'</li>' : '' ?>
       <?= ($modelo['laboratory_rep_tel_2']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>REPRESENTANTE TELEFONE 2:</b> '.$modelo['laboratory_rep_tel_2'].'</li>' : '' ?>
       <?= ($modelo['laboratory_rep_email']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>REPRESENTANTE E-EMAIL:</b> '.$modelo['laboratory_rep_email'].'</li>' : '' ?>
       <?= ($modelo['laboratory_banco_1']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>REPRESENTANTE BANCO 1:</b> '.$modelo['laboratory_banco_1'].'</li>' : '' ?>
       <?= ($modelo['laboratory_agencia_1']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>REPRESENTANTE AGÊNCIA 1:</b> '.$modelo['laboratory_agencia_1'].'</li>' : '' ?>
       <?= ($modelo['laboratory_conta_1']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>REPRESENTANTE CONTA 1:</b> '.$modelo['laboratory_conta_1'].'</li>' : '' ?>
       <?= ($modelo['laboratory_titular_1']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>REPRESENTANTE TITULAR CONTA 1:</b> '.$modelo['laboratory_titular_1'].'</li>' : '' ?>
       <?= ($modelo['laboratory_banco_2']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>REPRESENTANTE CONTA 2:</b> '.$modelo['laboratory_banco_2'].'</li>' : '' ?>
       <?= ($modelo['laboratory_agencia_2']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>REPRESENTANTE AGÊNCIA 2:</b> '.$modelo['laboratory_agencia_2'].'</li>' : '' ?>
       <?= ($modelo['laboratory_conta_2']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>REPRESENTANTE CONTA 2:</b> '.$modelo['laboratory_conta_2'].'</li>' : '' ?>
       <?= ($modelo['laboratory_titular_2']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>REPRESENTANTE TITULAR CONTA 2:</b> '.$modelo['laboratory_titular_2'].'</li>' : '' ?>
       <?= ($modelo['laboratory_obs']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>INFORMAÇÃO EXTRA:</b> '.$modelo['laboratory_obs'].'</li>' : '' ?>
    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar X</button>
</div>

<?php 
    # Destroy a variavl não mais utilizada
    unset($modelo); 
?>