<?php 
    if (!defined('ABSPATH')){ exit(); }
    $get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    
    if(isset($get['pr'])){ $parametros = $get['pr']; }
    
    # Carrega todos os métodos do modelo
    $modelo->validate_register_form();
    $form_msg = $modelo->form_msg;
    $modelo->get_register_form($parametros);
    unset($parametros, $get);
?>
<script>window.history.pushState("cad", "", "cad");</script>
<div class="row-fluid">
    <div class="col-md-1  col-sm-0 col-xs-0"></div>
    <div class="col-md-10  col-sm-12 col-xs-12">
        <!--<h4 class="text-center">CADASTRO DE FORNECEDORES</h4>-->
        <form id="form-register" enctype="multipart/form-data" method="post" role="form" class="">
            <?php
                if ($form_msg == true) {
                    echo '<div class="alert alertH ' . $form_msg[0] . '  alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="fa fa-info-circle fa-4" >&nbsp;</i>
                            <strong>' . $form_msg[1] . '</strong>&nbsp;' . $form_msg[2] . ' 
                         </div>';
                    unset($form_msg);
                }
            ?>
            <fieldset>
                <legend><h6>INFORMAÇÕES DO FORNECEDOR</h6></legend>
                <div class="row form-compact">
                    <div class="form-group col-md-3 col-sm-4 col-xs-12">
                        <label for="provider_nome">Empresa:</label>
                        <input type="hidden" name="provider_id" value="<?= htmlentities(chk_array($modelo->form_data, 'provider_id')); ?>">
                        <input id="provider_nome" type="text" name="provider_nome" placeholder="Nome da empresa... " value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_nome')); ?>" class="form-control" 
                        data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo."
                        data-validation-help="Digite um nome com (3) ou mais caracteres.">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="provider_cpf_cnpj">CPF/CPNJ:</label>
                        <input id="provider_cpf_cnpj" name="provider_cpf_cnpj" class="form-control" type="text" placeholder="CPF ou CNPJ" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_cpf_cnpj')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="rs">Razão Social:</label>
                        <input id="rs" name="provider_rs" class="form-control" type="text" placeholder="Razão social..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_rs')); ?>">
                        <br>
                    </div>


                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="provider_at">Área de Atuação:</label>
                        <input id="provider_at" name="provider_at" class="form-control" type="text" placeholder="Área de atuação..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_at')); ?>" >
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-4 col-xs-12">
                        <label for="provider_end">Endereço:</label>
                        <input id="provider_end" name="provider_end" class="form-control" type="text" placeholder="Endereço..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_end')); ?>" >
                        <br>
                    </div>
                    <br>
                </div>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="provider_bair">Bairro:</label>
                        <input id="provider_bair" name="provider_bair" class="form-control" type="text" placeholder="Bairro..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_bair')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="provider_cid">Cidade:</label>
                        <input id="provider_cid" name="provider_cid" class="form-control" type="text" placeholder="Cidade..."   value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_cid')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-1 col-sm-4 col-xs-6">
                        <label for="provider_uf">UF:</label>
                        <input id="provider_uf" name="provider_uf" class="form-control uf" type="text" placeholder="UF" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_uf')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="provider_pais">País:</label>
                        <input id="provider_pais" name="provider_pais" class="form-control" type="text" placeholder="País..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_pais')); ?>">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="provider_cep">CEP:</label>
                        <input id="provider_cep" name="provider_cep" class="form-control" type="text" placeholder="CEP..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_cep')); ?>">
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="provider_cel">Celular:</label>
                        <input id="provider_cel" name="provider_cel" class="form-control tel-cel" type="text" placeholder="(00) 00000-0000" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_cel')); ?>">
                    </div>
                </div>
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="provider_tel_1">Telefone 1:</label>
                        <input id="tel-casa" name="provider_tel_1" class="form-control tel-casa" type="text" placeholder="(00) 0000-0000" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_tel_1')); ?>">
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="provider_tel_2">Telefone 2:</label>
                        <input id="provider_tel_2" name="provider_tel_2" class="form-control tel-casa" type="text" placeholder="(00) 0000-0000" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_tel_2')); ?>">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="provider_insc_uf">Inscrição Estadual:</label>
                        <input id="provider_insc_uf" name="provider_insc_uf" class="form-control" type="text" placeholder="Inscrição Estadual..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_insc_uf')); ?>">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="provider_email">Email:</label>
                        <input id="provider_email" name="provider_email" class="form-control" type="email" placeholder="Email..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_email')); ?>">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="provider_web_url">Web Site:</label>
                        <input id="provider_web_url" name="provider_web_url" class="form-control" type="url" placeholder="Web site..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_web_url')); ?>">
                        <br>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><h6>INFORMAÇÕES DO REPRESENTANTE - PESSOA DE CONTATO</h6></legend>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_rep_nome">Nome:</label>
                        <input id="provider_rep_nome" name="provider_rep_nome" class="form-control" type="text" placeholder="Nome do representante..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_rep_nome')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_rep_apelido">Apelido:</label>
                        <input id="provider_rep_apelido" name="provider_rep_apelido" class="form-control" type="text" placeholder="Apelido representante..."    value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_rep_apelido')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_rep_email">E-mail:</label>
                        <input id="provider_rep_email" name="provider_rep_email" class="form-control" type="text" placeholder="E-mail representante..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_rep_email')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_rep_cel">Celular:</label>
                        <input id="provider_rep_cel" name="provider_rep_cel" class="form-control tel-cel" type="text" placeholder="(00) 00000-0000" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_rep_cel')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_rep_tel_1">Telefone 1:</label>
                        <input id="provider_rep_tel_1" name="provider_rep_tel_1" class="form-control tel-casa" type="text" placeholder="(00) 0000-0000" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_tel_1')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_rep_tel_2">Telefone 2:</label>
                        <input id="provider_rep_tel_2" name="provider_rep_tel_2" class="form-control tel-casa" type="text" placeholder="(00) 0000-0000" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_rep_tel_2')); ?>">
                        <br>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><h6>INFORMAÇÕES BANCÁRIAS</h6></legend>
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_banco_1">Banco:</label>
                        <input id="provider_banco_1" name="provider_banco_1" class="form-control" type="text" placeholder="Banco..."    value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_banco_1')); ?>">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_agencia_1">Agência:</label>
                        <input id="provider_agencia_1" name="provider_agencia_1" class="form-control" type="text" placeholder="Agência..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_agencia_1')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_conta_1">Conta:</label>
                        <input id="provider_conta_1" name="provider_conta_1" class="form-control" type="text" placeholder="Conta..."    value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_conta_1')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_titular_1">Titular:</label>
                        <input id="provider_titular_1" name="provider_titular_1" class="form-control" type="text" placeholder="Titular..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_titular_1')); ?>">
                        <br>
                    </div>
                </div>
                
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_banco_2">Banco:</label>
                        <input id="provider_banco_2" name="provider_banco_2" class="form-control" type="text" placeholder="Banco..."    value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_banco_2')); ?>">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_agencia_2">Agência:</label>
                        <input id="provider_agencia_2" name="provider_agencia_2" class="form-control" type="text" placeholder="Agência..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_agencia_2')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_conta_2">Conta:</label>
                        <input id="provider_conta_2" name="provider_conta_2" class="form-control" type="text" placeholder="Conta..."    value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_conta_2')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="provider_titular_2">Titular:</label>
                        <input id="provider_titular_2" name="provider_titular_2" class="form-control" type="text" placeholder="Titular..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_titular_2')); ?>">
                        <br>
                    </div>
                </div>
            </fieldset>
            <hr>
            <div class="row form-compact">
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="provider_obs">Observações:</label>
                    <textarea id="provider_obs" class="form-control" name="provider_obs" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..." ><?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_obs')); ?></textarea>
                </div>
            </div>
            <div class="row form-compact">
                <div class="form-group col-xs-6 col-sm-3 col-md-2 ">
                    <div class="input-group-btn ">
                        <a href="<?= HOME_URI; ?>/providers" class="btn btn-sx btn-primary" title="Ir a página de fornecedores"><span class="fa fa-users"></span> Visualizar fornecedores</a>
                    </div>
                    <br>
                </div>
                <div class="form-group col-xs-6 col-sm-3 col-md-1">
                    <div class="input-group-btn">
                        <button title="Salvar informações" class="btn btn-sx btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Salvar</button>
                    </div>
                    <br>
                </div>
                <div class="form-group col-xs-4 col-sm-3 col-md-1 ">
                    <div class="input-group-btn">
                        <button title="Limpar formulário" class="btn btn-sx btn-warning" type="reset"><span class="glyphicon glyphicon-erase"></span> Limpar</button>
                    </div>
                    
                </div>
                <div class="form-group col-xs-4 col-sm-3 col-md-1 ">
                    <div class="input-group-btn">
                        <span title="Ir ao topo da página" class=" btn btn-primary top glyphicon glyphicon-arrow-up"></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-1  col-sm-0 col-xs-0"></div>
</div> <!-- /row  -->
<script>
    $('.top').click(function(){ 
         $('html, body').animate({scrollTop:0}, 'slow');
         return false;
     });
</script>