<?php 
    if (!defined('ABSPATH')){ exit(); }
    $get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    
    if(isset($get['emp'])){ $parametros = $get['emp']; }
    
    #   Carrega todos os métodos do modelo
    (filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : FALSE;
    $form_msg = $modelo->form_msg;
    $modelo->get_register_form($parametros, 1);
    unset($parametros, $get);
?>

<div class="row-fluid">  
    <div class="col-md-1 col-sm-0 col-xs-0"></div>
    <div class="col-md-10 col-sm-12  col-xs-12">
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
                <div class="form-group hide-show col-md-12 col-sm-12 col-xs-12">
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

            <fieldset class="hide-show-geral">
                <legend>Informações cadastrais</legend>
                <div class="row form-compact">
                    <div class="form-group hide-show col-md-4 col-sm-12 col-xs-12">
                        <label for="user_name">Nome:</label>
                        <input type="text" name="user_name" placeholder="Nome completo... " value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_name')); ?>" class="form-control" id="user_name" 
                               data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo."
                               data-validation-help="Digite um nome com (3) ou mais caracteres.">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12 cpf">
                        <label for="cpf">CPF:</label>
                        <input id="cpf" name="cpf" class="cpf form-control" type="text" placeholder="000.000.000-00">
                        <br>
                    </div>

                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-12">
                        <label for="rg">RG:</label>
                        <input id="rg" name="rg" class="rg form-control" type="text" placeholder="0.000.000">
                        <br>
                    </div>


                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-12">
                        <label for="nascimento">Data de nascimento:</label>
                        <input id="nasc" name="nasc" class="form-control" type="text" placeholder="dd/mm/aaaa" >
                        <br>
                    </div>

                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-12">
                        <label for="user_gen">Sexo:</label>
                        <select name="user_gen" class="form-control">
                            <option value="1" <?= (htmlentities(chk_array($modelo->form_data, 'user_gen')) == 'Não informado') ? 'selected'  : FALSE; ?> selected  >Não informado</option>
                            <option value="2" <?= (htmlentities(chk_array($modelo->form_data, 'user_gen')) == 'Masculino') ? 'selected'  : FALSE; ?>>Masculino</option>
                            <option value="3" <?= (htmlentities(chk_array($modelo->form_data, 'user_gen')) == 'Feminino') ? 'selected'  : FALSE; ?>>Feminino</option>
                        </select>
                    </div>
                    
                   
                    <br>
                </div>

                <div class="row form-compact">
                     <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="user_civil_status">Estado civil:</label>
                        <select name="user_civil_status" class="form-control">
                            <?php $lista = $modelo->get_col_data('civil_status', 'users_civil_status','civil_status_id'); foreach ($lista as $fetch_userdata):  ?>
                            <option value="<?= $fetch_userdata['civil_status']; ?>"><?= $fetch_userdata['civil_status']; ?></option>
                            <?php endforeach;   unset($lista, $fetch_userdata); ?>
                        </select>
                        <br>
                    </div>
                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="tel-casa">Telefone casa:</label>
                        <input id="tel-casa" name="tel-casa" class="tel-casa form-control" type="text" placeholder="(00) 0000-0000">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="tel-cel">Celular:</label>
                        <input id="tel-cel" name="tel-cel" class=" tel-cel form-control" type="text" placeholder="(00) 00000-0000">
                        <br>
                    </div>

                    <div class="form-group hide-show col-md-3 col-sm-4 col-xs-6">
                        <label for="user_father_name">Nome do pai:</label>
                        <input name="user_father_name" class="form-control" type="text" placeholder="Nome do pai...">
                        <br>
                    </div>

                    <div class="form-group hide-show col-md-3 col-sm-4 col-xs-6">
                        <label for="user_mother_name">Nome da mãe:</label>
                        <input name="user_mother_name" class="form-control" type="text" placeholder="Nome da mãe...">
                        <br>
                    </div>
                </div>
                <div class="row form-compact">
                    <div class="form-group hide-show col-md-4 col-sm-4 col-xs-6">
                        <label for="endereco">Endereço:</label>
                        <input name="endereco" class="form-control" type="text" placeholder="Endereço...">

                    </div>

                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="bairro">Bairro:</label>
                        <input name="bairro" class="form-control" type="text" placeholder="Bairro...">
                        <br>
                    </div>

                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="cidade">Cidade:</label>
                        <input name="cidade" class="form-control" type="text" placeholder="Cidade...">
                    </div>

                    <div class="form-group hide-show col-md-1 col-sm-4 col-xs-6">
                        <label for="estado">UF:</label>
                        <input name="estado" class="form-control uf" type="text" placeholder="UF">
                        <br>
                    </div>
                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="cep">CEP:</label>
                        <input id="cep" name="cep" class="form-control" type="text" placeholder="00000-000">
                    </div>
                </div>

                <div class="row form-compact">
                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="esp_1">Área de especialização 1:</label>
                        <select name="esp_1" class="form-control" id="esp_1">
                            <?php $lista = $modelo->get_col_data('esp', 'users_esp', 'esp_id'); foreach($lista as $fetch_userdata): ?>
                                <option value="<?= $fetch_userdata['esp']; ?>"><?= $fetch_userdata['esp']; ?></option>
                            <?php endforeach; unset($lista, $fetch_userdata); ?>
                        </select>
                        <br>
                    </div>
                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="esp_2">Área de especialização 2:</label>
                        <select name="esp_2" class="form-control" id="esp_2">
                            <?php $lista = $modelo->get_col_data('esp', 'users_esp', 'esp_id'); foreach($lista as $fetch_userdata): ?>
                                <option value="<?= $fetch_userdata['esp']; ?>"><?= $fetch_userdata['esp']; ?></option>
                            <?php endforeach; unset($lista, $fetch_userdata); ?>
                        </select>
                        <br>
                    </div>
                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="esp_3">Área de especialização 3:</label>
                        <select name="esp_3" class="form-control" id="esp_3">
                            <?php $lista = $modelo->get_col_data('esp', 'users_esp', 'esp_id'); foreach($lista as $fetch_userdata): ?>
                                <option value="<?= $fetch_userdata['esp']; ?>"><?= $fetch_userdata['esp']; ?></option>
                            <?php endforeach; unset($lista, $fetch_userdata); ?>
                        </select>

                    </div>
                    <div class="form-group hide-show col-md-2 col-sm-2 col-xs-6">
                        <label for="cro">CRO:</label>
                        <input id="cro" name="cro" class="form-control" type="text" placeholder="DF-AAA-000">
                        <br>
                    </div>

                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                       <label for="user_active">Status ativo: Não / Sim</label>
                        <select name="user_active" class="form-control">
                            <option value="0" <?= (htmlentities(chk_array($modelo->form_data, 'user_active')) == 0) ? 'selected'  : FALSE; ?> selected  >Não</option>
                            <option value="1" <?= (htmlentities(chk_array($modelo->form_data, 'user_active')) == 1) ? 'selected'  : FALSE; ?>>Sim</option>
                        </select>
                        <br>
                    </div>

                </div>

                <div class="row form-compact">
                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="ini-ativi">início de atividades  na clínica:</label>
                        <input name="ini-ativi" id="ini-ativi" class="form-control" type="text" placeholder="dd/mm/aaaa">                            
                    </div>
                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="fim-ativi">Fim de atividades na clínica:</label>
                        <input name="fim-ativi" id="fim-ativi" class="form-control" type="text" placeholder="dd/mm/aaaa">
                    </div>

                </div>
            </fieldset>

           
            <br>
            <fieldset class="hide-show-geral">
                <legend >Horário de Atendimento</legend>
                <div class="row form-compact">
                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="dom_1">Domingo:</label>
                        <input name="dom_1" id="dom_1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="dom_2" id="dom_2" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                    </div>

                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="seg_1">Segunda-feira:</label>
                        <input name="seg_1" id="seg-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="seg_2" id="seg-2" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                    </div>

                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="ter-1">Terça-feira:</label>
                        <input name="ter-1" id="ter-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="ter-2" id="ter-2" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                    </div>

                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="qua-1">Quarta-feira:</label>
                        <input name="qua-1" id="qua-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="qua-2" id="qua-2" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                    </div>

                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="qui-1">Quinta-feira:</label>
                        <input name="qui-1" id="qui-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="qui-2" id="qui-2" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                    </div>

                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="sex-1">Sexta-feira:</label>
                        <input name="sex-1" id="sex-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="sex-2" id="sex-2" class="form-control" type="text" placeholder="hh:mm">

                    </div>

                </div>

                <div class="row form-compact">
                    <div class="form-group hide-show col-md-2 col-sm-4 col-xs-6">
                        <label for="sab-1">Sábado:</label>
                        <input name="sab-1" id="sab-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="sab-2" id="sab-2" class="form-control" type="text" placeholder="hh:mm">
                    </div>
                </div>
            </fieldset>
            <br>
           <div class="row form-compact">
                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                    <b>NÍVEIS DE ACESSO: 
                        <i style="color: #dd5600;"  data-toggle="tooltip" title="Olá, para utilizar as permissões selecio ao lado para selecionar mais de uma permissao mantenha a tecla ctrl presionada e click nas permissões desejada. !" class="fa fa-question-circle" aria-hidden="true"  ></i>
                    </b>
                    <div class="acess-card input-group btn-group">
                        <span class="card input-group-addon">
                            <i style="color: #9E9E9E;" class="fa fa-3x fa-id-card-o" aria-hidden="true"></i>
                        </span>

                        <select name="user_permissions[]" style="text-align: justify;" id="permission-select" class="form-control" multiple="multiple">
                            <?php   foreach ($modelo->get_all_col('users_permissions', 'permissions_id') as $fetch_userdata):   ?>
                            <option value="<?= $fetch_userdata['permissions_id']; ?>" <?php if (isset($modelo->form_data['user_permissions'])) {if (in_array($fetch_userdata['permissions_id'], $modelo->form_data['user_permissions'])) {echo 'selected';}} ?> > <?= $fetch_userdata['permissions']; ?> </option>
                            <?php   endforeach; unset($fetch_userdata); ?>
                        </select>
                    </div>
                </div>
            </div> 
            <br>
            <fieldset >
                <legend>Informações de login</legend>
                <div class="row form-compact">
                    <div class="form-group  col-md-4 col-sm-12 col-xs-12">
                        <label for="user_email">Email este será o usuário:</label>
                        <input type="text" name="user_email" placeholder="Seu email será seu usuário de login..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_email'));?>" class="form-control" id="user_email" >
                        <p></p>
                        
                    </div>
                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="user_password"> Senha:</label>
                        <input type="password" title="Sua senha" name="user_password" class="form-control" placeholder="Sua senha..."
                               value="<?php echo htmlentities(chk_array($modelo->form_data, 'user_password')); ?>">
                        <p></p>
                    </div>

                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <br>
                        <div class="btn-group">
                            <button id="user-register-btn" type="submit" class="btn btn-primary" title="Cadastrar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processando..." >Cadastra
                                <i class="glyphicon glyphicon-floppy-save" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="btn-group">
                            <a href="<?= HOME_URI; ?>/users" class="btn btn-default">
                                Usuários cadastrados <i class="fa fa-users" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="btn-group">
                            <button type="reset" class=" btn-limpar btn btn-warning">Limpar 
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
