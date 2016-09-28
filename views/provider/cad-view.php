<?php if (!defined('ABSPATH')) exit; 

    // Carrega todos os métodos do modelo
    $modelo->validate_register_form();
    #$modelo->get_register_form(chk_array($parametros, 1));
    #$modelo->del_user($parametros);
?>


<p id="resultado"></p>
<div class="row-fluid">  
    <div class="col-md-1 col-xs-1"></div>
    <div class="col-md-10  col-xs-12">
        <!--<h4 class="text-center">CADASTRO DE FORNECEDORES</h4>-->
        <form id="form-register" enctype="multipart/form-data" method="post" role="form" class="validate-form">
            

            <?= $modelo->form_msg; $modelo->form_data; ?>
            
            <fieldset>
                <legend><h6>INFORMAÇÕES DO FORNECEDOR</h6></legend>
                <div class="row form-compact">
                    <div class="form-group col-md-3 col-sm-4 col-xs-12">
                        <label for="provider_name">Empresa:</label>
                        <input id="provider_name" type="text" name="provider_name" placeholder="Nome da empresa... " value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'provider_name'));
                        ?>" class="form-control" id="provider_name" 
                               data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo."
                               data-validation-help="Digite um nome com (3) ou mais caracteres.">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="cnpj_cpf">CPF/CPNJ:</label>
                        <input id="cnpj_cpf" name="provider_cpf_cnpj" class="form-control" type="text" placeholder="CPF ou CNPJ">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="rs">Razão Social:</label>
                        <input id="rs" name="provider_rs" class="form-control" type="text" placeholder="Razão social...">
                        <br>
                    </div>


                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="at">Área de Atuação:</label>
                        <input id="at" name="provider_at" class="form-control" type="text" placeholder="Área de atuação..." >
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-4 col-xs-12">
                        <label for="endereco">Endereço:</label>
                        <input id="endereco" name="provider_end" class="form-control" type="text" placeholder="Endereço..." >
                        <br>
                    </div>
                    <br>
                </div>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="bairro">Bairro:</label>
                        <input id="bairro" name="provider_bair" class="form-control" type="text" placeholder="Bairro...">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="cidade">Cidade:</label>
                        <input id="cidade" name="cidade" class="form-control" type="text" placeholder="Cidade...">
                        <br>
                    </div>

                    <div class="form-group col-md-1 col-sm-4 col-xs-6">
                        <label for="estado">UF:</label>
                        <input id="estado" name="provider_cid" class="form-control uf" type="text" placeholder="UF">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="pais">País:</label>
                        <input id="pais" name="provider_pais" class="form-control" type="text" placeholder="País...">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="cep">CEP:</label>
                        <input id="cep" name="provider_cep" class="form-control" type="text" placeholder="CEP...">

                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="tel-cel">Celular:</label>
                        <input id="tel-cel" name="provider_cel" class="form-control" type="text" placeholder="(00) 00000-0000">
                    </div>

                </div>
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="tel-casa">Telefone 1:</label>
                        <input id="tel-casa" name="provider_tel_1" class="form-control" type="text" placeholder="(00) 0000-0000">
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="tel-casa-2">Telefone 2:</label>
                        <input id="tel-casa-2" name="provider_tel_2" class="form-control" type="text" placeholder="(00) 0000-0000">
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="insc_estadual">Inscrição Estadual:</label>
                        <input id="insc_estadual" name="provider_insc_uf" class="form-control" type="text" placeholder="Inscrição Estadual...">
                    </div>
                    
                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="email">Email:</label>
                        <input id="email" name="provider_email" class="form-control" type="email" placeholder="Email...">
                        <br>
                    </div>
                    <div class="form-group col-md-3 col-sm-4 col-xs-6">
                        <label for="email">Web Site:</label>
                        <input name="provider_web_url" class="form-control" type="url" placeholder="Web site...">
                        <br>
                    </div>
                    
                </div>
            </fieldset>
            <fieldset>
                <legend><h6>INFORMAÇÕES DO REPRESENTANTE - PESSOA DE CONTATO</h6></legend>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="rep-nome">Nome:</label>
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
                        <input id="tel-cel" name="provider_rep_cel" class="form-control" type="text" placeholder="(00) 00000-0000">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="tel-casa">Telefone 1:</label>
                        <input id="tel-casa" name="provider_rep_tel_1" class="form-control" type="text" placeholder="(00) 0000-0000">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="rep-email">Telefone 2:</label>
                        <input id="rep-email" name="provider_rep_tel_2" class="form-control" type="text" placeholder="(00) 0000-0000">
                        <br>
                    </div>
                </div>
            </fieldset>

            

            <fieldset>
                <legend><h6>INFORMAÇÕES BANCÁRIAS</h6></legend>
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="banco">Banco:</label>
                        <input id="banco" name="provider_banco" class="form-control" type="text" placeholder="Banco...">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="agencia">Agência:</label>
                        <input id="agencia" name="provider_agencia" class="form-control" type="text" placeholder="Agência...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="conta">Conta:</label>
                        <input id="conta" name="provider_conta" class="form-control" type="text" placeholder="Conta...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="titular">Titular:</label>
                        <input id="titular" name="provider_titular" class="form-control" type="text" placeholder="Titular...">
                        <br>
                    </div>
                </div>
                
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="banco_2">Banco:</label>
                        <input id="banco_2" name="provider_banco" class="form-control" type="text" placeholder="Banco...">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="agencia_2">Agência:</label>
                        <input id="agencia_2" name="provider_agencia" class="form-control" type="text" placeholder="Agência...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="conta_2">Conta:</label>
                        <input id="conta_2" name="provider_conta" class="form-control" type="text" placeholder="Conta...">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="rep-email">Titular:</label>
                        <input id="rep-email" name="provider_titular" class="form-control" type="text" placeholder="Titular...">
                        <br>
                    </div>
                </div>
            </fieldset>
            <hr>
            <div class="row form-compact">
                <div class="form-group col-md-8 col-sm-8 col-xs-12">
                    <label for="obs">Observações:</label>
                    <textarea id="obs" name="provider_obs" style="margin-top: 0px; width: 100%;  margin-bottom: 0px; height: 89px; text-align: justify;" rows="3" class="form-control" placeholder="Outras informações..."></textarea>
                </div>
            </div>
            <div class="row form-compact">
                <div class="form-group col-md-3 col-sm-8 col-xs-12">
                    <div class="input-group-btn">
                        <button id="user-register-btn" type="submit" class="btn btn-default" title="Cadastrar" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processando..." >Cadastra
                            <i class="glyphicon glyphicon-floppy-save" aria-hidden="true"></i>
                        </button>
                    </div>

                    <div class="input-group-btn">
                        <a href="<?= HOME_URI; ?>/providers" class="btn btn-default">
                            Fornecedores cadastrados <i class="fa fa-users" aria-hidden="true"></i>
                        </a>
                    </div>

                    <div class="input-group-btn">
                        <button type="reset" class="btn btn-warning">Limpar 
                            <i class="glyphicon glyphicon-erase" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-1 col-xs-1"></div>
</div> <!-- /row  -->
