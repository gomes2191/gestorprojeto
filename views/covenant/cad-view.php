<?php
    if (!defined('ABSPATH')) {
        exit();
    }

    # Verifica se existe o método get se existir chama função
    if (filter_input(INPUT_GET, 'get', FILTER_DEFAULT)) {
        $id_encode = filter_input(INPUT_GET, 'get', FILTER_DEFAULT);

        $modelo->get_register_form($id_encode);

        # Destroy variáveis não mais utilizada
        unset($id_encode);
    }

    # Verifica se existe a requisição POST se existir executa o método se não faz nada
    (filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : FALSE;
    # Configura o Feedback para o usuário
    $form_msg = $modelo->form_msg;
?>

<script>window.history.pushState("cad", "", "cad");</script>

<div class="row-fluid">
    <div class="col-md-1  col-sm-0 col-xs-0"></div>
    <div class="col-md-10  col-sm-12 col-xs-12">
        <!--<h4 class="text-center">CADASTRO DE FORNECEDORES</h4>-->
        <form id="form-register" enctype="multipart/form-data" method="post" role="form" class="ui form segment">
            <?php
                if ($form_msg) {
                    echo'<div class="alert alertH ' . $form_msg[0] . ' alert-dismissible fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="' . $form_msg[1] . '" >&nbsp;</i>
                                <strong>' . $form_msg[2] . '</strong>&nbsp;' . $form_msg[3] . ' 
                            </div>';
                    unset($form_msg);
                } else {
                    unset($form_msg);
                }
            ?>
            <fieldset>
                <legend><h6>INFORMAÇÕES DO CONVÊNIO</h6></legend>
                <div class="row form-compact">
                    <div class="form-group col-md-3 col-sm-4 col-xs-12">
                        <label for="covenant_nome">Empresa:</label>
                        <input type="hidden" name="covenant_id" value="<?= htmlentities(chk_array($modelo->form_data, 'covenant_id')); ?>">
                        <input id="covenant_nome" type="text" name="covenant_nome" placeholder="Nome do laboratório... " value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_nome')); ?>" class="form-control" 
                        data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo."
                        data-validation-help="Digite um nome com (3) ou mais caracteres.">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="covenant_cpf_cnpj">CPF/CPNJ:</label>
                        <input id="covenant_cpf_cnpj" name="covenant_cpf_cnpj" class="form-control" type="text" placeholder="CPF ou CNPJ" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_cpf_cnpj')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="rs">Razão Social:</label>
                        <input id="rs" name="covenant_rs" class="form-control" type="text" placeholder="Razão social..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_rs')); ?>">
                        <br>
                    </div>


                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="covenant_at">Área de Atuação:</label>
                        <input id="covenant_at" name="covenant_at" class="form-control" type="text" placeholder="Área de atuação..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_at')); ?>" >
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-4 col-xs-12">
                        <label for="covenant_end">Endereço:</label>
                        <input id="covenant_end" name="covenant_end" class="form-control" type="text" placeholder="Endereço..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_end')); ?>" >
                        <br>
                    </div>
                    <br>
                </div>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="covenant_bair">Bairro:</label>
                        <input id="covenant_bair" name="covenant_bair" class="form-control" type="text" placeholder="Bairro..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_bair')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="covenant_cid">Cidade:</label>
                        <input id="covenant_cid" name="covenant_cid" class="form-control" type="text" placeholder="Cidade..."   value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_cid')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-1 col-sm-4 col-xs-6">
                        <label for="covenant_uf">UF:</label>
                        <input id="covenant_uf" name="covenant_uf" class="form-control uf" type="text" placeholder="UF" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_uf')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="covenant_pais">País:</label>
                        <input id="covenant_pais" name="covenant_pais" class="form-control" type="text" placeholder="País..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_pais')); ?>">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="covenant_cep">CEP:</label>
                        <input id="covenant_cep" name="covenant_cep" class="form-control" type="text" placeholder="CEP..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_cep')); ?>">
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="covenant_cel">Celular:</label>
                        <input id="covenant_cel" name="covenant_cel" class="form-control tel-cel" type="text" placeholder="(00) 00000-0000" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_cel')); ?>">
                    </div>
                </div>
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="covenant_tel_1">Telefone 1:</label>
                        <input id="tel-casa" name="covenant_tel_1" class="form-control tel-casa" type="text" placeholder="(00) 0000-0000" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_tel_1')); ?>">
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="covenant_tel_2">Telefone 2:</label>
                        <input id="covenant_tel_2" name="covenant_tel_2" class="form-control tel-casa" type="text" placeholder="(00) 0000-0000" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_tel_2')); ?>">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="covenant_insc_uf">Inscrição Estadual:</label>
                        <input id="covenant_insc_uf" name="covenant_insc_uf" class="form-control" type="text" placeholder="Inscrição Estadual..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_insc_uf')); ?>">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="covenant_email">Email:</label>
                        <input id="covenant_email" name="covenant_email" class="form-control" type="email" placeholder="Email..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_email')); ?>">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="covenant_web_url">Web Site:</label>
                        <input id="covenant_web_url" name="covenant_web_url" class="form-control" type="url" placeholder="Web site..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_web_url')); ?>">
                        <br>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><h6>INFORMAÇÕES DO REPRESENTANTE - PESSOA DE CONTATO</h6></legend>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_rep_nome">Nome:</label>
                        <input id="covenant_rep_nome" name="covenant_rep_nome" class="form-control" type="text" placeholder="Nome do representante..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_rep_nome')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_rep_apelido">Apelido:</label>
                        <input id="covenant_rep_apelido" name="covenant_rep_apelido" class="form-control" type="text" placeholder="Apelido representante..."    value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_rep_apelido')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_rep_email">E-mail:</label>
                        <input id="covenant_rep_email" name="covenant_rep_email" class="form-control" type="text" placeholder="E-mail representante..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_rep_email')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_rep_cel">Celular:</label>
                        <input id="covenant_rep_cel" name="covenant_rep_cel" class="form-control tel-cel" type="text" placeholder="(00) 00000-0000" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_rep_cel')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_rep_tel_1">Telefone 1:</label>
                        <input id="covenant_rep_tel_1" name="covenant_rep_tel_1" class="form-control tel-casa" type="text" placeholder="(00) 0000-0000" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_tel_1')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_rep_tel_2">Telefone 2:</label>
                        <input id="covenant_rep_tel_2" name="covenant_rep_tel_2" class="form-control tel-casa" type="text" placeholder="(00) 0000-0000" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_rep_tel_2')); ?>">
                        <br>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend><h6>INFORMAÇÕES BANCÁRIAS</h6></legend>
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_banco_1">Banco:</label>
                        <input id="covenant_banco_1" name="covenant_banco_1" class="form-control" type="text" placeholder="Banco..."    value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_banco_1')); ?>">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_agencia_1">Agência:</label>
                        <input id="covenant_agencia_1" name="covenant_agencia_1" class="form-control" type="text" placeholder="Agência..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_agencia_1')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_conta_1">Conta:</label>
                        <input id="covenant_conta_1" name="covenant_conta_1" class="form-control" type="text" placeholder="Conta..."    value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_conta_1')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_titular_1">Titular:</label>
                        <input id="covenant_titular_1" name="covenant_titular_1" class="form-control" type="text" placeholder="Titular..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_titular_1')); ?>">
                        <br>
                    </div>
                </div>
                
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_banco_2">Banco:</label>
                        <input id="covenant_banco_2" name="covenant_banco_2" class="form-control" type="text" placeholder="Banco..."    value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_banco_2')); ?>">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_agencia_2">Agência:</label>
                        <input id="covenant_agencia_2" name="covenant_agencia_2" class="form-control" type="text" placeholder="Agência..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_agencia_2')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_conta_2">Conta:</label>
                        <input id="covenant_conta_2" name="covenant_conta_2" class="form-control" type="text" placeholder="Conta..."    value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_conta_2')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="covenant_titular_2">Titular:</label>
                        <input id="covenant_titular_2" name="covenant_titular_2" class="form-control" type="text" placeholder="Titular..."  value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_titular_2')); ?>">
                        <br>
                    </div>
                </div>
            </fieldset>
            <hr>
            <div class="row form-compact">
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="covenant_obs">Observações:</label>
                    <textarea id="covenant_obs" class="form-control" name="covenant_obs" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..." ><?php
                        echo htmlentities(chk_array($modelo->form_data, 'covenant_obs')); ?></textarea>
                </div>
            </div>
            <div class="row form-compact">
                <div class="form-group col-xs-6 col-sm-3 col-md-2 ">
                    <div class="input-group-btn ">
                        <a href="<?= HOME_URI; ?>/covenant" class="btn btn-sx btn-default" title="Ir a página de cadastros"><span class="fa fa-users"></span> Listar cadastros</a>
                    </div>
                    <br>
                </div>
                <div class="form-group col-xs-6 col-sm-3 col-md-1">
                    <div class="input-group-btn">
                        <button title="Salvar informações" class="btn btn-sx btn-default" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Salvar</button>
                    </div>
                    <br>
                </div>
                <div class="form-group col-xs-4 col-sm-3 col-md-1 ">
                    <div class="input-group-btn">
                        <button title="Limpar formulário" class="btn btn-sx btn-default" type="reset"><span class="glyphicon glyphicon-erase"></span> Limpar</button>
                    </div>
                    
                </div>
                <div class="form-group col-xs-4 col-sm-3 col-md-1 ">
                    <div class="input-group-btn">
                        <span title="Ir ao topo da página" class=" btn btn-default top glyphicon glyphicon-arrow-up"></span>
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