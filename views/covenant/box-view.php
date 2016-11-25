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
        header('Location:' . HOME_URI . '/covenant');
        exit();
    }
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> INFORMAÇÕES REFERENTE</h4>
</div>
<div class="modal-body">
    <ul class="list-inline list-modal-forn">
       <?= ($modelo['covenant_nome']) ? '<li style="color: #666666" class="list-for list-group-item list-group-item-info list-group-item-text"><b>LABORATÓRIO:</b> '.$modelo['covenant_nome'].'</li>' : '' ?> 
       <?= ($modelo['covenant_cpf_cnpj']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>CPF / CNPJ:</b> '.$modelo['covenant_cpf_cnpj'].'</li>' : '' ?>
       <?= ($modelo['covenant_rs']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>RAZÃO SOCIAL:</b> '.$modelo['covenant_rs'].'</li>' : '' ?>
       <?= ($modelo['covenant_at']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>AREA DE ATUAÇÃO:</b> '.$modelo['covenant_at'].'</li>' : '' ?>
       <?= ($modelo['covenant_end']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>ENDEREÇO:</b> '.$modelo['covenant_end'].'</li>' : '' ?>
       <?= ($modelo['covenant_bair']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>BAIRRO:</b> '.$modelo['covenant_bair'].'</li>' : '' ?>
       <?= ($modelo['covenant_cid']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>CIDADE:</b> '.$modelo['covenant_cid'].'</li>' : '' ?>
       <?= ($modelo['covenant_uf']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>UF:</b> '.$modelo['covenant_uf'].'</li>' : '' ?>
       <?= ($modelo['covenant_cep']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>CEP:</b> '.$modelo['covenant_cep'].'</li>' : '' ?>
       <?= ($modelo['covenant_pais']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>PAIS:</b> '.$modelo['covenant_pais'].'</li>' : '' ?>
       <?= ($modelo['covenant_cel']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>CELULAR:</b> '.$modelo['covenant_cel'].'</li>' : '' ?>
       <?= ($modelo['covenant_tel_1']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>TELEFONE 1:</b> '.$modelo['covenant_tel_1'].'</li>' : '' ?>
       <?= ($modelo['covenant_tel_2']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>TELEFONE 2:</b> '.$modelo['covenant_tel_2'].'</li>' : '' ?>
       <?= ($modelo['covenant_insc_uf']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>INSCRIÇÃO ESTADUAL:</b> '.$modelo['covenant_insc_uf'].'</li>' : '' ?>
       <?= ($modelo['covenant_web_url']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>WEB SITE:</b> '.$modelo['covenant_web_url'].'</li>' : '' ?>
       <?= ($modelo['covenant_email']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>E-MAIL:</b> '.$modelo['covenant_email'].'</li>' : '' ?>
       <?= ($modelo['covenant_rep_nome']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>REPRESENTANTE NOME:</b> '.$modelo['covenant_rep_nome'].'</li>' : '' ?>
       <?= ($modelo['covenant_rep_apelido']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>REPRESENTANTE APELIDO:</b> '.$modelo['covenant_rep_apelido'].'</li>' : '' ?>
       <?= ($modelo['covenant_rep_cel']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>REPRESENTANTE CELULAR:</b> '.$modelo['covenant_rep_cel'].'</li>' : '' ?>
       <?= ($modelo['covenant_rep_tel_1']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>REPRESENTANTE TELEFONE 1:</b> '.$modelo['covenant_rep_tel_1'].'</li>' : '' ?>
       <?= ($modelo['covenant_rep_tel_2']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>REPRESENTANTE TELEFONE 2:</b> '.$modelo['covenant_rep_tel_2'].'</li>' : '' ?>
       <?= ($modelo['covenant_rep_email']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>REPRESENTANTE E-EMAIL:</b> '.$modelo['covenant_rep_email'].'</li>' : '' ?>
       <?= ($modelo['covenant_banco_1']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>REPRESENTANTE BANCO 1:</b> '.$modelo['covenant_banco_1'].'</li>' : '' ?>
       <?= ($modelo['covenant_agencia_1']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>REPRESENTANTE AGÊNCIA 1:</b> '.$modelo['covenant_agencia_1'].'</li>' : '' ?>
       <?= ($modelo['covenant_conta_1']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>REPRESENTANTE CONTA 1:</b> '.$modelo['covenant_conta_1'].'</li>' : '' ?>
       <?= ($modelo['covenant_titular_1']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>REPRESENTANTE TITULAR CONTA 1:</b> '.$modelo['covenant_titular_1'].'</li>' : '' ?>
       <?= ($modelo['covenant_banco_2']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>REPRESENTANTE CONTA 2:</b> '.$modelo['covenant_banco_2'].'</li>' : '' ?>
       <?= ($modelo['covenant_agencia_2']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>REPRESENTANTE AGÊNCIA 2:</b> '.$modelo['covenant_agencia_2'].'</li>' : '' ?>
       <?= ($modelo['covenant_conta_2']) ? '<li style="color: #666666" class="list-group-item list-group-item-info list-group-item-text"><b>REPRESENTANTE CONTA 2:</b> '.$modelo['covenant_conta_2'].'</li>' : '' ?>
       <?= ($modelo['covenant_titular_2']) ? '<li style="color: #666666" class="list-group-item list-group-item-warning list-group-item-text"><b>REPRESENTANTE TITULAR CONTA 2:</b> '.$modelo['covenant_titular_2'].'</li>' : '' ?>
       <?= ($modelo['covenant_obs']) ? '<li style="color: #666666" class="list-group-item list-group-item-success list-group-item-text"><b>INFORMAÇÃO EXTRA:</b> '.$modelo['covenant_obs'].'</li>' : '' ?>
    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar X</button>
</div>

<?php 
    # Destroy a variavl não mais utilizada
    unset($modelo); 
?>