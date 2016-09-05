<?php if (!defined('ABSPATH')) exit; 

    // Carrega todos os métodos do modelo
    $modelo->validate_register_form();
    $modelo->get_register_form(chk_array($parametros, 1));
    $modelo->del_user($parametros);
?>


<p id="resultado"></p>
<div class="row-fluid">  
    <div class="col-md-1 col-xs-1"></div>
    <div class="col-md-10  col-xs-10">
        <h4 class="text-center">CADASTRO DE PESSOAL</h4>

        <form id="form-register" enctype="multipart/form-data" method="post" role="form" class="validate-form">
            

            <?php
                echo $modelo->form_msg;
                $modelo->form_data;
            ?>
            <div class="row form-compact">
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                    
                    
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                            <img src="<?= HOME_URI ?>/views/img/padrao.png" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                        <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Selecionar imagem</span>
                                <span class="fileinput-exists">Alterar</span>
                                <input type="file"  name="img_perfil" >
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <fieldset>
                <legend>Informações cadastrais</legend>
                <!--                    <div class="form-group">
                                        <label for="clinic_name">Nome da clinica:</label>
                                        <input type="text" name="clinic_name" placeholder="Nome da clinica..." value="<?php
                echo htmlentities(chk_array($modelo->form_data, 'clinic_name'));
                ?>" class="form-control" id="clinic_name" required >
                                    </div>-->
                <!--<div class="form-group">
                    <label for="user_user">Seu usuário:</label>
                    <input type="text" name="user_user"  class="form-control" placeholder="Usuário a ser utilizado para entrar no sistema..." id="user_user" value="<?php
                echo htmlentities(chk_array($modelo->form_data, 'user_user'));
                ?>" >
                </div>-->
                <div class="row form-compact">
                    <div class="form-group col-md-4 col-sm-4 col-xs-12">
                        <label for="user_name">Nome:</label>
                        <input type="text" name="user_name" placeholder="Nome completo... " value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_name'));
                        ?>" class="form-control" id="user_name" 
                               data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo."
                               data-validation-help="Digite um nome com (3) ou mais caracteres.">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="cpf">CPF:</label>
                        <input id="cpf" name="cpf" class="form-control" type="text" placeholder="000.000.000-00">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="rg">RG:</label>
                        <input id="rg" name="rg" class="form-control" type="text" placeholder="0.000.000">
                        <br>
                    </div>


                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="nascimento">Data de nascimento:</label>
                            <input id="nasc" name="nasc" class="form-control" type="text" placeholder="dd/mm/aaaa" >
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-12">
                        <label for="genero">Sexo:</label>
                        <select name="genero" class="form-control">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </div>
                    <br>
                </div>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="tel-casa">Telefone casa:</label>
                        <input id="tel-casa" name="tel-casa" class="form-control" type="text" placeholder="(00) 0000-0000">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="tel-cel">Celular:</label>
                        <input id="tel-cel" name="tel-cel" class="form-control" type="text" placeholder="(00) 00000-0000">
                        <br>
                    </div>

                    <div class="form-group col-md-4 col-sm-4 col-xs-6">
                        <label for="name-pai">Nome do pai:</label>
                        <input name="name-pai" class="form-control" type="text" placeholder="Nome do pai...">
                        <br>
                    </div>

                    <div class="form-group col-md-4 col-sm-4 col-xs-6">
                        <label for="name-mae">Nome da mãe:</label>
                        <input name="name-mae" class="form-control" type="text" placeholder="Nome da mãe...">
                        <br>
                    </div>




                </div>
                <div class="row form-compact">
                    <div class="form-group col-md-4 col-sm-4 col-xs-6">
                        <label for="endereco">Endereço:</label>
                        <input name="endereco" class="form-control" type="text" placeholder="Endereço...">

                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="bairro">Bairro:</label>
                        <input name="bairro" class="form-control" type="text" placeholder="Bairro...">
                        <br>
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="cidade">Cidade:</label>
                        <input name="cidade" class="form-control" type="text" placeholder="Cidade...">
                    </div>
                    
                    <div class="form-group col-md-1 col-sm-4 col-xs-6">
                        <label for="estado">UF:</label>
                        <input name="estado" class="form-control uf" type="text" placeholder="UF">
                        <br>
                    </div>
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="cep">CEP:</label>
                        <input id="cep" name="cep" class="form-control" type="text" placeholder="00000-000">

                    </div>

                </div>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="esp-1">Área de especialização 1:</label>
                        <select name="esp-1" class="form-control" id="esp-1">
                            <option value="1">Cirurgia e Traumatologia Buco Maxilo Faciais</option>
                            <option value="2">Clínica Geral</option>
                            <option selected="selected" value="3">Dentistica</option>
                            <option value="4">Dentistica Restauradora</option>
                            <option value="5">Disfuncao Temporo-Mandibular e Dor-Orofacial</option>
                            <option value="6">Endodontia</option>
                            <option value="7">Estomatologia</option>
                            <option value="8">Implantodontia</option>
                            <option value="13">Odontogeriatria</option>
                            <option value="9">Odontologia do Trabalho</option>
                            <option value="10">Odontologia em Saude Coletiva</option>
                            <option value="11">Odontologia Legal</option>
                            <option value="12">Odontologia para Pacientes com Necessidades Especiais</option>
                            <option value="14">Odontopediatria</option>
                            <option value="15">Ortodontia</option>
                            <option value="16">Ortodontia e Ortopedia Facial</option>
                            <option value="17">Ortopedia Funcional dos Maxilares</option>
                            <option value="18">Patologia Bucal</option>
                            <option value="19">Periodontia</option>
                            <option value="20">Protese Buco Maxilo Facial</option>
                            <option value="21">Protese Dentaria</option>
                            <option value="22">Radiologia</option>
                            <option value="23">Radiologia Odontologica e Imaginologia</option>
                            <option value="24">Saúde Coletiva</option>
                        </select>
                        <br>
                    </div>


                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="esp-2">Área de especialização 2:</label>
                        <select name="esp-2" class="form-control" id="esp-2">
                            <option value="1">Cirurgia e Traumatologia Buco Maxilo Faciais</option>
                            <option value="2">Clínica Geral</option>
                            <option selected="selected" value="3">Dentistica</option>
                            <option value="4">Dentistica Restauradora</option>
                            <option value="5">Disfuncao Temporo-Mandibular e Dor-Orofacial</option>
                            <option value="6">Endodontia</option>
                            <option value="7">Estomatologia</option>
                            <option value="8">Implantodontia</option>
                            <option value="13">Odontogeriatria</option>
                            <option value="9">Odontologia do Trabalho</option>
                            <option value="10">Odontologia em Saude Coletiva</option>
                            <option value="11">Odontologia Legal</option>
                            <option value="12">Odontologia para Pacientes com Necessidades Especiais</option>
                            <option value="14">Odontopediatria</option>
                            <option value="15">Ortodontia</option>
                            <option value="16">Ortodontia e Ortopedia Facial</option>
                            <option value="17">Ortopedia Funcional dos Maxilares</option>
                            <option value="18">Patologia Bucal</option>
                            <option value="19">Periodontia</option>
                            <option value="20">Protese Buco Maxilo Facial</option>
                            <option value="21">Protese Dentaria</option>
                            <option value="22">Radiologia</option>
                            <option value="23">Radiologia Odontologica e Imaginologia</option>
                            <option value="24">Saúde Coletiva</option>
                        </select>
                        <br>

                    </div>
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="esp-3">Área de especialização 3:</label>
                        <select name="esp-3" class="form-control" id="esp-3">
                            <option value="1">Cirurgia e Traumatologia Buco Maxilo Faciais</option>
                            <option value="2">Clínica Geral</option>
                            <option selected="selected" value="3">Dentistica</option>
                            <option value="4">Dentistica Restauradora</option>
                            <option value="5">Disfuncao Temporo-Mandibular e Dor-Orofacial</option>
                            <option value="6">Endodontia</option>
                            <option value="7">Estomatologia</option>
                            <option value="8">Implantodontia</option>
                            <option value="13">Odontogeriatria</option>
                            <option value="9">Odontologia do Trabalho</option>
                            <option value="10">Odontologia em Saude Coletiva</option>
                            <option value="11">Odontologia Legal</option>
                            <option value="12">Odontologia para Pacientes com Necessidades Especiais</option>
                            <option value="14">Odontopediatria</option>
                            <option value="15">Ortodontia</option>
                            <option value="16">Ortodontia e Ortopedia Facial</option>
                            <option value="17">Ortopedia Funcional dos Maxilares</option>
                            <option value="18">Patologia Bucal</option>
                            <option value="19">Periodontia</option>
                            <option value="20">Protese Buco Maxilo Facial</option>
                            <option value="21">Protese Dentaria</option>
                            <option value="22">Radiologia</option>
                            <option value="23">Radiologia Odontologica e Imaginologia</option>
                            <option value="24">Saúde Coletiva</option>
                        </select>

                    </div>
                    <div class="form-group col-md-2 col-sm-2 col-xs-6">
                        <label for="cro">CRO:</label>
                        <input id="cro" name="cro" class="form-control" type="text" placeholder="DF-AAA-000">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="ativo">Ativo:</label>
                        <select name="ativo" class="form-control">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                        <br>
                    </div>

                </div>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="ini-ativi">início de atividades  na clínica:</label>
                        <input name="ini-ativi" id="ini-ativi" class="form-control" type="text" placeholder="dd/mm/aaaa">                            
                    </div>
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="fim-ativi">Fim de atividades na clínica:</label>
                        <input name="fim-ativi" id="fim-ativi" class="form-control" type="text" placeholder="dd/mm/aaaa">
                    </div>

                </div>
            </fieldset>

            <hr>

            <fieldset>
                <legend>Horário de Atendimento</legend>
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="dom-1">Domingo:</label>
                        <input name="dom-1" id="dom-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="dom-2" id="dom-2" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="seg-1">Segunda-feira:</label>
                        <input name="seg-1" id="seg-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="seg-2" id="seg-2" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="ter-1">Terça-feira:</label>
                        <input name="ter-1" id="ter-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="ter-2" id="ter-2" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="qua-1">Quarta-feira:</label>
                        <input name="qua-1" id="qua-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="qua-2" id="qua-2" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="qui-1">Quinta-feira:</label>
                        <input name="qui-1" id="qui-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="qui-2" id="qui-2" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="sex-1">Sexta-feira:</label>
                        <input name="sex-1" id="sex-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="sex-2" id="sex-2" class="form-control" type="text" placeholder="hh:mm">

                    </div>

                </div>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="sab-1">Sábado:</label>
                        <input name="sab-1" id="sab-1" class="form-control" type="text" placeholder="hh:mm">
                        <br>
                        <input name="sab-2" id="sab-2" class="form-control" type="text" placeholder="hh:mm">
                    </div>
                </div>
            </fieldset>
            <hr>
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
