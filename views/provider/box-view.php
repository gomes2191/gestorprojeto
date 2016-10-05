<?php if ( !defined('ABSPATH') ) { exit('Teste'); }
    
    $get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    if(isset($get['v'])){
        $modelo = $modelo->get_registro($get['v']);
    }
    
    #   Destroy variáveis não mais utilizadas
    unset($get);
?>


<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> INFORMAÇÕES</h4>
</div>
<div class="modal-body">
    <ul class="list-inline list-modal-forn">
       <?= ($modelo['provider_nome']) ? '<li class="list-for list-group-item list-group-item-info list-group-item-text"><b>Empresa:</b> '.$modelo['provider_nome'].'</li>' : '' ?> 
       <?= ($modelo['provider_cpf_cnpj']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>CNPJ/CPF:</b> '.$modelo['provider_cpf_cnpj'].'</li>' : '' ?>
       <?= ($modelo['provider_rs']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Razão social:</b> '.$modelo['provider_rs'].'</li>' : '' ?>
       <?= ($modelo['provider_at']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Área de atuação:</b> '.$modelo['provider_at'].'</li>' : '' ?>
       <?= ($modelo['provider_end']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Endereço:</b> '.$modelo['provider_end'].'</li>' : '' ?>
       <?= ($modelo['provider_bair']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Bairro:</b> '.$modelo['provider_bair'].'</li>' : '' ?>
       <?= ($modelo['provider_cid']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Cidade:</b> '.$modelo['provider_cid'].'</li>' : '' ?>
       <?= ($modelo['provider_uf']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>UF:</b> '.$modelo['provider_uf'].'</li>' : '' ?>
       <?= ($modelo['provider_cep']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>CEP:</b> '.$modelo['provider_cep'].'</li>' : '' ?>
       <?= ($modelo['provider_pais']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Pais:</b> '.$modelo['provider_pais'].'</li>' : '' ?>
       <?= ($modelo['provider_cel']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Celular:</b> '.$modelo['provider_cel'].'</li>' : '' ?>
       <?= ($modelo['provider_tel_1']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Telefone 1:</b> '.$modelo['provider_tel_1'].'</li>' : '' ?>
       <?= ($modelo['provider_tel_2']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Telefone 2:</b> '.$modelo['provider_tel_2'].'</li>' : '' ?>
       <?= ($modelo['provider_insc_uf']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Inscrição Estadual:</b> '.$modelo['provider_insc_uf'].'</li>' : '' ?>
       <?= ($modelo['provider_web_url']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Web site:</b> '.$modelo['provider_web_url'].'</li>' : '' ?>
       <?= ($modelo['provider_email']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Email:</b> '.$modelo['provider_email'].'</li>' : '' ?>
        <br>
       <?= ($modelo['provider_rep_nome']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Representante nome:</b> '.$modelo['provider_rep_nome'].'</li>' : '' ?>
       <?= ($modelo['provider_rep_apelido']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Representante apelido:</b> '.$modelo['provider_rep_apelido'].'</li>' : '' ?>
       <?= ($modelo['provider_rep_cel']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Representante celular:</b> '.$modelo['provider_rep_cel'].'</li>' : '' ?>
       <?= ($modelo['provider_rep_tel_1']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Representante telefone 1:</b> '.$modelo['provider_rep_tel_1'].'</li>' : '' ?>
       <?= ($modelo['provider_rep_tel_2']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Representante telefone 2:</b> '.$modelo['provider_rep_tel_2'].'</li>' : '' ?>
       <?= ($modelo['provider_rep_email']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Representante email:</b> '.$modelo['provider_rep_email'].'</li>' : '' ?>
        <br>
       <?= ($modelo['provider_banco_1']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Banco 1:</b> '.$modelo['provider_banco_1'].'</li>' : '' ?>
       <?= ($modelo['provider_agencia_1']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Agência 1:</b> '.$modelo['provider_agencia_1'].'</li>' : '' ?>
       <?= ($modelo['provider_conta_1']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Conta 1:</b> '.$modelo['provider_conta_1'].'</li>' : '' ?>
       <?= ($modelo['provider_titular_1']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Titular 1:</b> '.$modelo['provider_titular_1'].'</li>' : '' ?>
        <br>
       <?= ($modelo['provider_banco_2']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Banco 2:</b> '.$modelo['provider_banco_2'].'</li>' : '' ?>
       <?= ($modelo['provider_agencia_2']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Agência 2:</b> '.$modelo['provider_agencia_2'].'</li>' : '' ?>
       <?= ($modelo['provider_conta_2']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Conta 2:</b> '.$modelo['provider_conta_2'].'</li>' : '' ?>
       <?= ($modelo['provider_titular_2']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Titular 2:</b> '.$modelo['provider_titular_2'].'</li>' : '' ?>
    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar X</button>
</div>


