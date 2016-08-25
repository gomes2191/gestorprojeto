<?php if (!defined('ABSPATH')) exit; ?>



<div class="row-fluid">
    <?php
    // Carrega todos os métodos do modelo
    $modelo->validate_register_form();
    $modelo->get_register_form(chk_array($parametros, 1));
    $modelo->del_user($parametros);
    ?>
    <div class="col-md-0"></div>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">CADASTRO DE NOVO USUÁRIO</h3>
            </div>
            <div class="panel-body">

                <form method="post" action="" role="form">

                    <?php echo ($modelo->form_msg); ?>
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
                            <input type="text" name="user_name" placeholder="Digite aqui o nome completo do usuário... " value="<?php
                            echo htmlentities(chk_array($modelo->form_data, 'user_name'));
                            ?>" class="form-control" id="user_name" >
                        </div>
                        
                        <div class="form-group col-md-2 col-sm-4 col-xs-12">  
                            <label for="cpf">CPF:</label>
                            <input id="cpf" name="cpf" class="form-control" type="text" placeholder="000.000.000-00"> 
                        </div>
                        <div class="form-group col-md-2 col-sm-4 col-xs-12">
                            <label for="rg">RG:</label>
                            <input id="rg" name="rg" class="form-control" type="text" placeholder="0.000.000"> 
                        </div>
                        <div class="form-group col-md-2 col-sm-4 col-xs-12">
                            <label for="ssn">Data de nascimento:</label>
                            <input id="nascimento" name="nascimento" class="form-control" type="text" placeholder="00/00/0000"> 
                        </div>
                        
                        <div class="form-group col-md-2 col-sm-4 col-xs-12">
                            <label for="race">Sexo:</label>
                            <select name="race" class="form-control"> 
                                <option>Masculino</option>
                                <option>Feminino</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row form-compact">
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="tel">Telefone casa:</label>
                            <input id="tel" name="tel" class="form-control" type="text" placeholder="(00) 0000-0000"> 
                        </div>
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="cel">Celular:</label>
                            <input id="cel" name="cel" class="form-control" type="text" placeholder="(00) 00000-0000"> 
                        </div>
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="pai">Nome do pai:</label>
                            <input name="pai" class="form-control" type="text" placeholder="Aqui nome do pai..."> 
                        </div>
                        
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="mae">Nome da mãe:</label>
                            <input name="mae" class="form-control" type="text" placeholder="Aqui nome da mãe..."> 
                        </div>
                        
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="endereco">Endereço:</label>
                            <input name="endereco" class="form-control" type="text" placeholder="Digite aqui o endereço..."> 
                        </div>
                        
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="bairro">Bairro:</label>
                            <input name="bairro" class="form-control" type="text" placeholder="Digite aqui o baiiro..."> 
                        </div>
                        
                    </div>
                    <div class="row form-compact">
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="cidade">Cidade:</label>
                            <input name="cidade" class="form-control" type="text" placeholder="Digite aqui a cidade..."> 
                        </div>
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="estado">Estado:</label>
                            <input name="estado" class="form-control" type="text" placeholder="Digite aqui o Estado..."> 
                        </div>
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="pai">CEP:</label>
                            <input id="cep" name="pai" class="form-control" type="text" placeholder="00000-000"> 
                        </div>
                        
                        
                       
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="race">Área de especialização 1:</label>
                            <select name="codigo_areaatuacao1" class="form-control" id="codigo_areaatuacao1">
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
                        
                         <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="race">Área de especialização 2:</label>
                            <select name="codigo_areaatuacao1" class="form-control" id="codigo_areaatuacao1">
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
                         <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="race">Área de especialização 3:</label>
                            <select name="codigo_areaatuacao1" class="form-control" id="codigo_areaatuacao1">
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
                    </div>
                    
                    <div class="row form-compact">
                         <div class="form-group col-md-2 col-sm-2 col-xs-6">
                            <label for="pai">CRO:</label>
                            <input id="cro" name="pai" class="form-control" type="text" placeholder="DF-AAA-000">
                        </div>
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="race">Ativo:</label>
                            <select name="race" class="form-control"> 
                                <option>Sim</option>
                                <option>Não</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="pai">início de atividades  na clínica:</label>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa"> 
                        </div>
                         <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="pai">Fim de atividades na clínica:</label>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa"> 
                        </div>
                        </div>
                    
                    
                    
                    </fieldset>
                    <fieldset>
                    <legend>Horário de Atendimento</legend>
                    <div class="row form-compact">
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="pai">Domingo:</label>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                            <br>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                        </div>
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="pai">Segunda-feira:</label>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                            <br>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                        </div>
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="pai">Terça-feira:</label>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                            <br>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                        </div> 
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="pai">Quarta-feira:</label>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                            <br>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                        </div> 
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="pai">Quinta-feira:</label>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                            <br>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                        </div> 
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="pai">Sexta-feira:</label>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                            <br>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                        </div> 
                    </div>
                    
                    <div class="row form-compact">
                        <div class="form-group col-md-2 col-sm-4 col-xs-6">
                            <label for="pai">Sábado:</label>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                            <br>
                            <input name="pai" class="form-control" type="text" placeholder="dd/mm/aaaa">
                        </div> 
                        
                    </div>
                    </fieldset>
                    <fieldset>
                    <legend>Informações de login</legend>
                     <div class="row form-compact">
                         <div class="form-group col-md-4 col-sm-2 col-xs-6">
                            <label for="user_email">Email este será o usuário:</label>
                        <input type="text" name="user_email" placeholder="Seu email será seu usuário de login..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_email'));
                        ?>" class="form-control" id="user_email" >
                        </div>
                        <div class="form-group col-md-4 col-sm-3 col-xs-6">
                            <label for="user_password"> Senha: </label>
                        <input type="password" name="user_password" class="form-control" placeholder="Sua senha para entrar no sistema.." id="user_password" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_password'));
                        ?>" >
                        </div>
                        
                        
                        
                    </div>
                    <br>
                    
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Cadastra <i class="glyphicon glyphicon-floppy-save" aria-hidden="true"></i></button>
                    <a href="<?php echo HOME_URI ?>/users/" class="btn btn-primary">Usuários cadastrados <i class="fa fa-users" aria-hidden="true"></i></a>
                    <button type="reset" class="btn btn-success">Limpar <i class="glyphicon glyphicon-erase" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="panel-footer"></div>
        </div>
        <div class="modal in fade"  role="dialog" id="myModal"> <!-- Modal start -->
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Remoção de usuário</h4>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja remover este usuário? não sera possivel reverter isso.
                    </div>
                    <div class="modal-footer">

                        <a href="<?php echo HOME_URI; ?>/user-register/" class="btn btn-primary">Não remover</a>
                        <a href="<?php echo HOME_URI ?>/user-register/index/del/<?php echo $fetch_userdata['user_id'] ?>/confirma " class="btn btn-danger" >Remover</a>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- Modal end -->
    </div>
    <div class="col-md-0"></div>
</div> <!-- /row  -->
