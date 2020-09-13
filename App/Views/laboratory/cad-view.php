<?php
if (!defined('Config::HOME_URI')) {
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

<script>
    window.history.pushState("cad", "", "cad");
</script>

<div class="row-fluid">
    <div class="col-md-1  col-sm-0 col-xs-0"></div>
    <div class="col-md-10  col-sm-12 col-xs-12">
        <!--<h4 class="text-center">CADASTRO DE FORNECEDORES</h4>-->
        <form id="form-register" enctype="multipart/form-data" method="post" role="form" class="ui form segment">
            <?php
            if ($form_msg) {
                echo '<div class="alert alertH ' . $form_msg[0] . ' alert-dismissible fade in">
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
                <legend>
                    <h6>INFORMAÇÕES DO LABORATÓRIO</h6>
                </legend>
                <div class="row form-compact">
                    <div class="form-group col-md-3 col-sm-4 col-xs-12">
                        <label for="laboratory_nome">Nome do laboratório:</label>
                        <input type="hidden" name="laboratory_id" value="<?= htmlentities(chkArray($modelo->form_data, 'laboratory_id')); ?>">
                        <input id="laboratory_nome" type="text" name="laboratory_nome" placeholder="Nome do laboratório... " value="<?php
                                                                                                                                    echo htmlentities(chkArray($modelo->form_data, 'laboratory_nome')); ?>" class="form-control" data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo." data-validation-help="Digite um nome com (3) ou mais caracteres.">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="laboratory_cpf_cnpj">CPF/CPNJ:</label>
                        <input id="laboratory_cpf_cnpj" name="laboratory_cpf_cnpj" class="form-control" type="text" placeholder="CPF ou CNPJ" value="<?php
                                                                                                                                                        echo htmlentities(chkArray($modelo->form_data, 'laboratory_cpf_cnpj')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="rs">Razão Social:</label>
                        <input id="rs" name="laboratory_rs" class="form-control" type="text" placeholder="Razão social..." value="<?php
                                                                                                                                    echo htmlentities(chkArray($modelo->form_data, 'laboratory_rs')); ?>">
                        <br>
                    </div>


                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="laboratory_at">Área de Atuação:</label>
                        <input id="laboratory_at" name="laboratory_at" class="form-control" type="text" placeholder="Área de atuação..." value="<?php
                                                                                                                                                echo htmlentities(chkArray($modelo->form_data, 'laboratory_at')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-4 col-xs-12">
                        <label for="laboratory_end">Endereço:</label>
                        <input id="laboratory_end" name="laboratory_end" class="form-control" type="text" placeholder="Endereço..." value="<?php
                                                                                                                                            echo htmlentities(chkArray($modelo->form_data, 'laboratory_end')); ?>">
                        <br>
                    </div>
                    <br>
                </div>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="laboratory_bair">Bairro:</label>
                        <input id="laboratory_bair" name="laboratory_bair" class="form-control" type="text" placeholder="Bairro..." value="<?php
                                                                                                                                            echo htmlentities(chkArray($modelo->form_data, 'laboratory_bair')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="laboratory_cid">Cidade:</label>
                        <input id="laboratory_cid" name="laboratory_cid" class="form-control" type="text" placeholder="Cidade..." value="<?php
                                                                                                                                            echo htmlentities(chkArray($modelo->form_data, 'laboratory_cid')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-1 col-sm-4 col-xs-6">
                        <label for="laboratory_uf">UF:</label>
                        <input id="laboratory_uf" name="laboratory_uf" class="form-control uf" type="text" placeholder="UF" value="<?php
                                                                                                                                    echo htmlentities(chkArray($modelo->form_data, 'laboratory_uf')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="laboratory_pais">País:</label>
                        <input id="laboratory_pais" name="laboratory_pais" class="form-control" type="text" placeholder="País..." value="<?php
                                                                                                                                            echo htmlentities(chkArray($modelo->form_data, 'laboratory_pais')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="laboratory_cep">CEP:</label>
                        <input id="laboratory_cep" name="laboratory_cep" class="form-control" type="text" placeholder="CEP..." value="<?php
                                                                                                                                        echo htmlentities(chkArray($modelo->form_data, 'laboratory_cep')); ?>">
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="laboratory_cel">Celular:</label>
                        <input id="laboratory_cel" name="laboratory_cel" class="form-control tel-cel" type="text" placeholder="(00) 00000-0000" value="<?php
                                                                                                                                                        echo htmlentities(chkArray($modelo->form_data, 'laboratory_cel')); ?>">
                    </div>
                </div>
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="laboratory_tel_1">Telefone 1:</label>
                        <input id="tel-casa" name="laboratory_tel_1" class="form-control tel-casa" type="text" placeholder="(00) 0000-0000" value="<?php
                                                                                                                                                    echo htmlentities(chkArray($modelo->form_data, 'laboratory_tel_1')); ?>">
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="laboratory_tel_2">Telefone 2:</label>
                        <input id="laboratory_tel_2" name="laboratory_tel_2" class="form-control tel-casa" type="text" placeholder="(00) 0000-0000" value="<?php
                                                                                                                                                            echo htmlentities(chkArray($modelo->form_data, 'laboratory_tel_2')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="laboratory_insc_uf">Inscrição Estadual:</label>
                        <input id="laboratory_insc_uf" name="laboratory_insc_uf" class="form-control" type="text" placeholder="Inscrição Estadual..." value="<?php
                                                                                                                                                                echo htmlentities(chkArray($modelo->form_data, 'laboratory_insc_uf')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="laboratory_email">Email:</label>
                        <input id="laboratory_email" name="laboratory_email" class="form-control" type="email" placeholder="Email..." value="<?php
                                                                                                                                                echo htmlentities(chkArray($modelo->form_data, 'laboratory_email')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="laboratory_web_url">Web Site:</label>
                        <input id="laboratory_web_url" name="laboratory_web_url" class="form-control" type="url" placeholder="Web site..." value="<?php
                                                                                                                                                    echo htmlentities(chkArray($modelo->form_data, 'laboratory_web_url')); ?>">
                        <br>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>
                    <h6>INFORMAÇÕES DO REPRESENTANTE - PESSOA DE CONTATO</h6>
                </legend>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_rep_nome">Nome:</label>
                        <input id="laboratory_rep_nome" name="laboratory_rep_nome" class="form-control" type="text" placeholder="Nome do representante..." value="<?php
                                                                                                                                                                    echo htmlentities(chkArray($modelo->form_data, 'laboratory_rep_nome')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_rep_apelido">Apelido:</label>
                        <input id="laboratory_rep_apelido" name="laboratory_rep_apelido" class="form-control" type="text" placeholder="Apelido representante..." value="<?php
                                                                                                                                                                        echo htmlentities(chkArray($modelo->form_data, 'laboratory_rep_apelido')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_rep_email">E-mail:</label>
                        <input id="laboratory_rep_email" name="laboratory_rep_email" class="form-control" type="text" placeholder="E-mail representante..." value="<?php
                                                                                                                                                                    echo htmlentities(chkArray($modelo->form_data, 'laboratory_rep_email')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_rep_cel">Celular:</label>
                        <input id="laboratory_rep_cel" name="laboratory_rep_cel" class="form-control tel-cel" type="text" placeholder="(00) 00000-0000" value="<?php
                                                                                                                                                                echo htmlentities(chkArray($modelo->form_data, 'laboratory_rep_cel')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_rep_tel_1">Telefone 1:</label>
                        <input id="laboratory_rep_tel_1" name="laboratory_rep_tel_1" class="form-control tel-casa" type="text" placeholder="(00) 0000-0000" value="<?php
                                                                                                                                                                    echo htmlentities(chkArray($modelo->form_data, 'laboratory_tel_1')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_rep_tel_2">Telefone 2:</label>
                        <input id="laboratory_rep_tel_2" name="laboratory_rep_tel_2" class="form-control tel-casa" type="text" placeholder="(00) 0000-0000" value="<?php
                                                                                                                                                                    echo htmlentities(chkArray($modelo->form_data, 'laboratory_rep_tel_2')); ?>">
                        <br>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>
                    <h6>INFORMAÇÕES BANCÁRIAS</h6>
                </legend>
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_banco_1">Banco:</label>
                        <input id="laboratory_banco_1" name="laboratory_banco_1" class="form-control" type="text" placeholder="Banco..." value="<?php
                                                                                                                                                echo htmlentities(chkArray($modelo->form_data, 'laboratory_banco_1')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_agencia_1">Agência:</label>
                        <input id="laboratory_agencia_1" name="laboratory_agencia_1" class="form-control" type="text" placeholder="Agência..." value="<?php
                                                                                                                                                        echo htmlentities(chkArray($modelo->form_data, 'laboratory_agencia_1')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_conta_1">Conta:</label>
                        <input id="laboratory_conta_1" name="laboratory_conta_1" class="form-control" type="text" placeholder="Conta..." value="<?php
                                                                                                                                                echo htmlentities(chkArray($modelo->form_data, 'laboratory_conta_1')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_titular_1">Titular:</label>
                        <input id="laboratory_titular_1" name="laboratory_titular_1" class="form-control" type="text" placeholder="Titular..." value="<?php
                                                                                                                                                        echo htmlentities(chkArray($modelo->form_data, 'laboratory_titular_1')); ?>">
                        <br>
                    </div>
                </div>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_banco_2">Banco:</label>
                        <input id="laboratory_banco_2" name="laboratory_banco_2" class="form-control" type="text" placeholder="Banco..." value="<?php
                                                                                                                                                echo htmlentities(chkArray($modelo->form_data, 'laboratory_banco_2')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_agencia_2">Agência:</label>
                        <input id="laboratory_agencia_2" name="laboratory_agencia_2" class="form-control" type="text" placeholder="Agência..." value="<?php
                                                                                                                                                        echo htmlentities(chkArray($modelo->form_data, 'laboratory_agencia_2')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_conta_2">Conta:</label>
                        <input id="laboratory_conta_2" name="laboratory_conta_2" class="form-control" type="text" placeholder="Conta..." value="<?php
                                                                                                                                                echo htmlentities(chkArray($modelo->form_data, 'laboratory_conta_2')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="laboratory_titular_2">Titular:</label>
                        <input id="laboratory_titular_2" name="laboratory_titular_2" class="form-control" type="text" placeholder="Titular..." value="<?php
                                                                                                                                                        echo htmlentities(chkArray($modelo->form_data, 'laboratory_titular_2')); ?>">
                        <br>
                    </div>
                </div>
            </fieldset>
            <hr>
            <div class="row form-compact">
                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                    <label for="laboratory_obs">Observações:</label>
                    <textarea id="laboratory_obs" class="form-control" name="laboratory_obs" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..."><?php
                                                                                                                                                                                                                                                            echo htmlentities(chkArray($modelo->form_data, 'laboratory_obs')); ?></textarea>
                </div>
            </div>
            <div class="row form-compact">
                <div class="form-group col-xs-6 col-sm-3 col-md-2 ">
                    <div class="input-group-btn ">
                        <a href="<?= HOME_URI; ?>/laboratory" class="btn btn-sx btn-default" title="Ir a página de cadastros"><span class="fa fa-users"></span> Listar cadastros</a>
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
    $('.top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');
        return false;
    });
</script>