<?php if (!defined('ABSPATH')) exit; ?>



<div class="row-fluid">
    <?php
        // Carrega todos os métodos do modelo
        $modelo->validate_register_form();
        $modelo->get_register_form(chk_array($parametros, 1));
        $modelo->del_user($parametros);
    ?>
    <div class="col-md-8"> <h4>Seja Bem-vindo</h4></div>
    <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title text-center">Cadastra-se</h3>
          </div>
          <div class="panel-body">
                <form method="post" action="">

                  <?php echo ($modelo->form_msg); ?>
                    
                    <div class="form-group">
                        <!--<label for="clinic_name">Nome da clinica:</label>-->
                        <input type="text" name="clinic_name" class="form-control clinic" id="clinic_name" placeholder="Nome da clinica..."
                        value="<?php echo htmlentities(chk_array($modelo->form_data, 'clinic_name'));?>" 
                        data-placement="top"  data-trigger="manual" data-content="Digite um nome válido Ex: Clínica"
                        data-validation="custom" data-validation-regexp="^([A-Z]{1}[a-z\s]{2,40})$"
                        data-validation="required" data-validation-error-msg="Nome digitado de forma incorreta.">
                    </div>
                                        
                    <div class="form-group">
                        <!--<label for="user_name">Seu nome:</label>-->
                        <input type="text" name="user_name" class="form-control clinic" id="user_name"
                        placeholder="Seu nome completo..." value="<?php echo htmlentities(chk_array($modelo->form_data, 'user_name'));?>" 
                        data-placement="top"  data-trigger="manual" data-content="Digite um nome válido Ex: João Carlos"
                        data-validation="custom" data-validation-regexp="^([A-Z]{1}[a-z\s]{2,40})$"
                        data-validation="required" data-validation-error-msg="Nome digitado de forma incorreta.">
                    </div>

                    <div class="form-group">
                        <!--<label for="user_name">Seu nome:</label>-->
                        <input type="text" name="user_email" class="form-control email" id="user_email"
                        placeholder="Seu email aqui, este será seu usuario..." value="<?php echo htmlentities(chk_array($modelo->form_data, 'user_email'));?>" 
                        data-placement="top"  data-trigger="manual" data-content="Digite um email válido Ex: user@gmail.com"
                        data-validation="custom" data-validation-regexp="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                        data-validation="required" data-validation-error-msg="Email digitado de forma incorreta.">
                    </div>
                        
                    <div class="form-group">
                        <!--<label for="user_password"> Senha: </label>-->
                        <input type="password" name="user_password" class="form-control pass" id="user_password"
                        placeholder="Sua senha..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_password'));?>" 
                        data-placement="top"  data-trigger="manual" data-content="A senha deve conter no minimo 6 caracteres com letras maiusculas e numeros"
                        data-validation="custom" data-validation-regexp="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                        data-validation="required" data-validation-error-msg="Digite uma senha válida.">
                    </div>

                
                    <button type="submit" class="btn btn-primary">Efetuar cadastro</button>
                    <!--<a href="<?php echo HOME_URI . '/user-register'; ?>">New user</a>-->
                    <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p>
                </form>
            </div>
            <div class="panel-footer"> <small>Veja nosso contrato de prestação de serviço. <a a href="#" title="Leia nosso termo de uso"> Leia-me</a></small> </div>
        </div>
    </div>
</div> <!-- /row  -->
