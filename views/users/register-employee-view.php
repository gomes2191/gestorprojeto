<?php
if (!defined('ABSPATH')) {
    exit();
}
$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if (isset($get['emp'])) {
    $parametros = $get['emp'];
}

#   Carrega todos os métodos do modelo
(filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : FALSE;
$form_msg = $modelo->form_msg;
$modelo->get_register_form($parametros, 1);
unset($parametros, $get);
?>

<div class="row-fluid">  
    <div class="col-md-1 col-xs-0 col-sm-0"></div>
    <div class="col-md-10  col-sm-12 col-xs-12">
        <?php
        if ($form_msg == true) {
            echo'<div class="alert alertH ' . $form_msg[0] . '  alert-dismissible fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-info-circle fa-4" >&nbsp;</i>
                        <strong>' . $form_msg[1] . '</strong>&nbsp;' . $form_msg[2] . ' 
                    </div>';
            unset($form_msg);
        }
        ?>
        <form id="form-register" enctype="multipart/form-data" method="post" role="form" class="validate-form">
            <div class="row form-compact">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                            <img src="<?= HOME_URI ?>/views/img/padrao.png" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Selecionar imagem</span>
                                <span class="fileinput-exists">Alterar</span>
                                <input type="file"  name="user_img_profile" >
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
                        </div>
                    </div>
                </div>
            </div>

            <fieldset >
                <legend>Informações cadastrais</legend>
                <div class="row form-compact">
                    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                        <label for="user_name">Nome:</label>
                        <input type="hidden" name="user_id" value="<?= htmlentities(chk_array($modelo->form_data, 'user_id')); ?>">
                        <input type="text" name="user_name" placeholder="Nome completo... " value="<?php echo htmlentities(chk_array($modelo->form_data, 'user_name')); ?>" class="form-control" id="user_name" 
                               data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo."
                               data-validation-help="Digite um nome com (3) ou mais caracteres.">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-4 col-xs-12 cpf">
                        <label for="user_cpf">CPF:</label>
                        <input id="user_cpf" name="user_cpf" class="cpf form-control" type="text" placeholder="000.000.000-00">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="user_rg">RG:</label>
                        <input id="user_rg" name="user_rg" class="rg form-control" type="text" placeholder="Somente números...">
                        <br>
                    </div>


                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="user_birth">Data de nascimento:</label>
                        <input id="user_birth" name="user_birth" class=" data form-control" type="text" placeholder="dd/mm/aaaa" >
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="user_gen">Sexo:</label>
                        <select name="user_gen" class="form-control">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </div>
                    <br>
                </div>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="user_civil_status">Estado civil:</label>
                        <select name="user_civil_status" class="form-control">
                            <?php
                                $lista = $modelo->get_col_data('civil_status', 'users_civil_status', 'civil_status_id');
                                foreach ($lista as $fetch_userdata):
                                    ?>
                                    <option value="<?= $fetch_userdata['civil_status']; ?>"><?= $fetch_userdata['civil_status']; ?></option>
                                    <?php
                                endforeach;
                                unset($lista, $fetch_userdata);
                            ?>
                        </select>
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="user_phone_home">Telefone casa:</label>
                        <input id="user_phone_home" name="user_phone_home" class="tel-casa form-control" type="text" placeholder="(00) 0000-0000">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="user_cel_phone">Celular:</label>
                        <input id="user_cel_phone" name="user_cel_phone" class="tel-cel form-control" type="text" placeholder="(00) 00000-0000">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="user_father_name">Nome do pai:</label>
                        <input name="user_father_name" class="form-control" type="text" placeholder="Nome do pai...">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="user_mother_name">Nome da mãe:</label>
                        <input name="user_mother_name" class="form-control" type="text" placeholder="Nome da mãe...">
                        <br>
                    </div>
                </div>
                <div class="row form-compact">
                    <div class="form-group col-md-5 col-sm-4 col-xs-6">
                        <label for="user_address">Endereço:</label>
                        <input name="user_address" class="form-control" type="text" placeholder="Endereço...">
                    </div>
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="user_district">Bairro:</label>
                        <input name="user_district" class="form-control" type="text" placeholder="Bairro...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="user_city">Cidade:</label>
                        <input name="user_city" class="form-control" type="text" placeholder="Cidade...">
                    </div>

                    <div class="form-group col-md-1 col-sm-4 col-xs-6">
                        <label for="user_state">UF:</label>
                        <input name="user_state" class="form-control uf" type="text" placeholder="UF">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="user_cep">CEP:</label>
                        <input id="user_cep" name="user_cep" class=" cep form-control" type="text" placeholder="00000-000">
                    </div>
                </div>
                <div class="row form-compact">
                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="user_func_pri">Função Principal:</label>
                        <input name="user_func_pri" class="form-control" type="text" placeholder="Função Principal...">
                        <br>
                    </div>
                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="user_func_sec">Função Secundária:</label>
                        <input name="user_func_sec" class="form-control" type="text" placeholder="Função Secundária...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="user_date_dem">Data de Admissão:</label>
                        <input id="user_date_dem" name="user_date_dem" class="data form-control" type="text" placeholder="dd/mm/aaaa" >
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="user_date_adm">Data de Demissão:</label>
                        <input id="user_date_adm" name="user_date_adm" class="data form-control" type="text" placeholder="dd/mm/aaaa" >
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="user_active">Status ativo: Sim / Não</label>
                        <select name="user_active" class="form-control">
                            <option value='0'>Não</option>
                            <option value='1'>Sim</option>
                        </select>
                        <br>
                    </div>
                </div>
            </fieldset>

            <div class="row form-compact">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">

                    <span style="color: #006dcc;" class="text-center">NÍVEIS DE PERMISSÃO</span>
                    <ul class="list-inline funkyradio">
                        <li>
                            <div class="funkyradio-default">
                                <input type="checkbox" name="user_level_1" id="checkbox1" />
                                <label for="checkbox1">Acesso agenda</label>
                            </div>

                        </li>

                        <li>
                            <div class="funkyradio-primary">
                                <input type="checkbox" name="user_level_2" id="checkbox2" />
                                <label for="checkbox2">Nivel 2</label>
                            </div>
                        </li>
                        <li>
                            <div class="funkyradio-success">
                                <input type="checkbox" name="user_level_3" id="checkbox3" />
                                <label for="checkbox3">Nivel 3</label>
                            </div>
                        </li>
                        <li>
                            <div class="funkyradio-danger">
                                <input type="checkbox" name="user_level_4" id="checkbox4" />
                                <label for="checkbox4">Nivel 4</label>
                            </div>
                        </li>
                        <li>
                            <div class="funkyradio-warning">
                                <input type="checkbox" name="user_level_5" id="checkbox5" />
                                <label for="checkbox5">Nivel 5</label>
                            </div>
                        </li>
                        <li>
                            <div class="funkyradio-info">
                                <input type="checkbox" name="user_level_6" id="checkbox6" checked/>
                                <label for="checkbox6">Nivel 6</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <br>
            <fieldset >
                <legend>Informações de login</legend>
                <div class="row form-compact">
                    <div class="form-group  col-md-4 col-sm-12 col-xs-12">
                        <label for="user_email">Email este será o usuário:</label>
                        <input type="text" name="user_email" placeholder="Seu email será seu usuário de login..." value="<?= htmlentities(chk_array($modelo->form_data, 'user_email')); ?>" class="form-control" id="user_email" >
                        <p></p>

                    </div>
                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="user_password"> Senha:</label>
                        <input type="password" title="Sua senha" name="user_password" class="form-control" placeholder="Sua senha..."
                               value="<?= htmlentities(chk_array($modelo->form_data, 'user_password')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <br>
                        <div class="btn-group">
                            <button id="user-register-btn" type="submit" class="btn btn-primary" title="Cadastrar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processando..." >Cadastra
                                <i class="glyphicon glyphicon-floppy-save" aria-hidden="true"></i>
                            </button>
                            <a href="<?= HOME_URI; ?>/users" class="btn btn-default">
                                Ver cadastros <i class="fa fa-users" aria-hidden="true"></i>
                            </a>

                            <button type="reset" class="btn-limpar btn btn-warning">Limpar 
                                <i class="glyphicon glyphicon-erase" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <br>
            </fieldset>
        </form>
    </div>
    <div class="col-md-1 col-sm-0 col-xs-0"></div>
</div> <!-- /row  -->
