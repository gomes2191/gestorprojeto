<?php if ( !defined('Config::HOME_URI') ) { exit; }

    $get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    if(isset($get['v'])){
        $modelo = $modelo->get_registro($get['v']);
    }else{

        header('Location:'.HOME_URI.'/users');
        exit;
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
       <?= ($modelo['user_name']) ? '<li class="list-for list-group-item list-group-item-info list-group-item-text"><b>Nome:</b> '.$modelo['user_name'].'</li>' : '' ?>
       <?= ($modelo['user_cpf']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>CPF:</b> '.$modelo['user_cpf'].'</li>' : '' ?>
       <?= ($modelo['user_rg']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>RG:</b> '.$modelo['user_rg'].'</li>' : '' ?>
       <?= ($modelo['user_birth']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Data de nascimento:</b> '.$modelo['user_birth'].'</li>' : '' ?>
       <?= ($modelo['user_gen']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Sexo:</b> '.$modelo['user_gen'].'</li>' : '' ?>
       <?= ($modelo['user_civil_status']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Estado civil:</b> '.$modelo['user_civil_status'].'</li>' : '' ?>
       <?= ($modelo['user_home_phone']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Telefone casa:</b> '.$modelo['user_home_phone'].'</li>' : '' ?>
       <?= ($modelo['user_cel_phone']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Celular:</b> '.$modelo['user_cel_phone'].'</li>' : '' ?>
       <?= ($modelo['user_father_name']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Nome do pai:</b> '.$modelo['user_father_name'].'</li>' : '' ?>
       <?= ($modelo['user_mother_name']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Nome da mãe:</b> '.$modelo['user_mother_name'].'</li>' : '' ?>
       <?= ($modelo['user_address']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Endereço:</b> '.$modelo['user_address'].'</li>' : '' ?>
       <?= ($modelo['user_district']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Bairro:</b> '.$modelo['user_district'].'</li>' : '' ?>
       <?= ($modelo['user_city']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Cidade:</b> '.$modelo['user_city'].'</li>' : '' ?>
       <?= ($modelo['user_state']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>UF:</b> '.$modelo['user_state'].'</li>' : '' ?>
       <?= ($modelo['user_cep']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>CEP:</b> '.$modelo['user_cep'].'</li>' : '' ?>
       <?= ($modelo['user_func_pri']) ? '<li class="list-group-item list-group-item-info list-group-item-text"><b>Função Principal:</b> '.$modelo['user_func_pri'].'</li>' : '' ?>
        <br>
       <?= ($modelo['user_func_sec']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Função Secundária:</b> '.$modelo['user_func_sec'].'</li>' : '' ?>
       <?= ($modelo['user_date_adm']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Data de Admissão:</b> '.$modelo['user_date_dem'].'</li>' : '' ?>
       <?= ($modelo['user_date_dem']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Data de Demissão:</b> '.$modelo['user_date_dem'].'</li>' : '' ?>
       <?= ($modelo['user_active']) ? '<li class="list-group-item list-group-item-success list-group-item-text"><b>Status: </b>Ativo </li>' : '<li class="list-group-item list-group-item-danger list-group-item-text"><b>Status: </b> Desativado</li>' ?>

    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar X</button>
</div>