<?php if (!defined('ABSPATH')) exit; 

    // Carrega todos os métodos do modelo
    //$modelo->validate_register_form();
    //$modelo->get_register_form(chk_array($parametros, 1));
    //$modelo->del_user($parametros);
?>


<p id="resultado"></p>
<div class="row-fluid">  
    <div class="col-md-1 col-xs-1"></div>
    <div class="col-md-10  col-xs-10">
        <!--<h4 class="text-center">CADASTRO DE FORNECEDORES</h4>-->
        <form id="form-register" enctype="multipart/form-data" method="post" role="form" class="validate-form">
            

            <?=
                $modelo->form_msg;
                $modelo->form_data;
            ?>
            
            <fieldset>
                <legend>Informações do fornecedor</legend>
                <div class="row form-compact">
                    <div class="form-group col-md-3 col-sm-4 col-xs-12">
                        <label for="provider_name">Empresa:</label>
                        <input type="text" name="provider_name" placeholder="Nome da empresa... " value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_name'));
                        ?>" class="form-control" id="provider_name" 
                               data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo."
                               data-validation-help="Digite um nome com (3) ou mais caracteres.">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="cnpj">CPF/CPNJ:</label>
                        <input id="cnpj" name="cnpj" class="form-control" type="text" placeholder="CPF ou CNPJ">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="razao_social">Razão Social:</label>
                        <input id="razao_social" name="razao_social" class="form-control" type="text" placeholder="Razão social...">
                        <br>
                    </div>


                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="area_atuacao">Área de Atuação:</label>
                        <input id="area_atuacao" name="area_atuacao" class="form-control" type="text" placeholder="Área de atuação..." >
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-4 col-xs-12">
                        <label for="endereco">Endereço:</label>
                        <input id="endereco" name="endereco" class="form-control" type="text" placeholder="Endereço..." >
                        <br>
                    </div>
                    <br>
                </div>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="bairro">Bairro:</label>
                        <input id="bairro" name="bairro" class="form-control" type="text" placeholder="Bairro...">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="cidade">Cidade:</label>
                        <input id="cidade" name="cidade" class="form-control" type="text" placeholder="Cidade...">
                        <br>
                    </div>

                    <div class="form-group col-md-1 col-sm-4 col-xs-6">
                        <label for="estado">UF:</label>
                        <input name="estado" class="form-control uf" type="text" placeholder="UF">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="pais">País:</label>
                        <input name="pais" class="form-control" type="text" placeholder="País...">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="cep">CEP:</label>
                        <input id="cep" name="cep" class="form-control" type="text" placeholder="CEP...">

                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="cel">Celular:</label>
                        <input id="tel-cel" name="provider_cel" class="form-control" type="text" placeholder="">
                    </div>

                </div>
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="tel-casa">Telefone 1:</label>
                        <input id="tel-casa" name="provider_tel_casa_1" class="form-control" type="text" placeholder="Telefone casa...">
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="tel-casa-2">Telefone 2:</label>
                        <input id="tel-casa-2" name="provider_tel_casa_2" class="form-control" type="text" placeholder="Telefone casa...">
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="insc_estadual">Inscrição Estadual:</label>
                        <input name="provider_insc_estadual" class="form-control" type="text" placeholder="Inscrição Estadual...">
                    </div>
                    
                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="email">Email:</label>
                        <input name="provider_email" class="form-control" type="email" placeholder="Email...">
                        <br>
                    </div>
                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="email">Web Site:</label>
                        <input name="provider_site" class="form-control" type="url" placeholder="Web site...">
                        <br>
                    </div>
                    
                    

                </div>
            </fieldset>
            <fieldset>
                <legend>Informações do Representante - Pessoa de Contato</legend>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="rep-nome">Nome do Representante - Pessoa de Contato:</label>
                        <input id="rep-nome" name="provider_rep_nome" class="form-control" type="text" placeholder="Nome do representante...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="rep-apelido">Apelido:</label>
                        <input id="rep-apelido" name="provider_rep_apelido" class="form-control" type="text" placeholder="Apelido representante...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="rep-email">E-mail:</label>
                        <input id="rep-email" name="provider_rep_email" class="form-control" type="text" placeholder="E-mail representante...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="tel-cel">Celular:</label>
                        <input id="tel-cel" name="provider_rep_cel" class="form-control" type="text" placeholder="Celular...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="tel-casa">Telefone 1:</label>
                        <input id="tel-casa" name="provider_rep_tel_1" class="form-control" type="text" placeholder="Telefone 1...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="rep-email">Telefone 2:</label>
                        <input id="rep-email" name="provider_rep_tel_2" class="form-control" type="text" placeholder="Telefone 2...">
                        <br>
                    </div>
                </div>
            </fieldset>

            

            <fieldset>
                <legend>Informações Bancárias</legend>
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="rep-email">Banco:</label>
                        <input id="rep-email" name="provider_rep_tel_2" class="form-control" type="text" placeholder="Telefone 2...">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="rep-email">Agência:</label>
                        <input id="rep-email" name="provider_rep_tel_2" class="form-control" type="text" placeholder="Telefone 2...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="rep-email">Conta:</label>
                        <input id="rep-email" name="provider_rep_tel_2" class="form-control" type="text" placeholder="Telefone 2...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="rep-email">Titular:</label>
                        <input id="rep-email" name="provider_rep_tel_2" class="form-control" type="text" placeholder="Telefone 2...">
                        <br>
                    </div>
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Informações de login</legend>
                <div class="row form-compact">
                    <div class="form-group col-md-3 col-sm-2 col-xs-6">
                        <label for="user-email">Email este será o usuário:</label>
                        <input type="text" name="user_email" placeholder="Seu email será seu usuário de login..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_email'));
                        ?>" class="form-control" id="user_email" >
                    </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-6">
                        <label for="user_password"> Senha: </label>
                        <input type="password" title="Sua senha" name="user_password" class="form-control" placeholder="Sua senha..."
                        value="<?php echo htmlentities(chk_array($modelo->form_data, 'user_password')); ?>">
                    </div>
                </div>
                <br>
            </fieldset>
            <div class="btn-group">
                <button id="user-register-btn" type="submit" class="btn btn-default" title="Cadastrar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processando..." >Cadastra
                    <i class="glyphicon glyphicon-floppy-save" aria-hidden="true"></i>
                </button>
            </div>
            <div class="btn-group">
                <a href="<?php echo HOME_URI ?>/users/" class="btn btn-default">
                    Usuários cadastrados <i class="fa fa-users" aria-hidden="true"></i>
                </a>
            </div>
            <div class="btn-group">
                
                <button type="reset" class="btn btn-warning">Limpar 
                    <i class="glyphicon glyphicon-erase" aria-hidden="true"></i>
                </button>
            </div>
            
            
        </form>
    </div>
    <div class="col-md-1 col-xs-1"></div>
</div> <!-- /row  -->
