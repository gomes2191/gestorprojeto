<?php 
    if (!defined('ABSPATH')){ exit; }
    
    // Carrega todos os métodos do modelo
    $modelo->validate_register_form();
    $modelo->get_register_form(chk_array($parametros, 1));
    $modelo->del_user($parametros);
    
    
?>

<div class="row">
    <div class="col-md-8  col-sm-12 col-xs-12"> 
        <h4>Seja Bem-vindo</h4>
    </div>
    <div class="col-md-4  col-sm-12 col-xs-12">
        <div class="card">
          <h3 class="card-header">Cadastra-se</h3>
          <div class="card-block">
                <form role="form" method="post" action="">

                  <?= $modelo->form_msg; ?>

                    <div class="form-group has-feedback has-feedback-left ">
                        <!--<label for="clinic_name">Nome da clinica:</label>-->
                        <input type="text" title="Nome da clínica" name="clinic_name" class="form-control form-control-sm" id="clinic_name" placeholder="Nome da clinica..."
                        value="<?php echo htmlentities(chk_array($modelo->form_data, 'clinic_name'));?>"
                        data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo."
                        data-validation-help="Digite um nome com (3) ou mais caracteres." >
                        <i class="form-control-feedback fa fa-institution"></i>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <!--<label for="user_name">Seu nome:</label>-->
                        <input type="text" title="Seu nome" name="user_name" class="form-control form-control-sm" id="user_name"
                        placeholder="Seu nome completo..." value="<?php echo htmlentities(chk_array($modelo->form_data, 'user_name'));?>"
                        data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$"
                        data-validation-help="Digite um nome com (3) ou mais caracteres."
                        data-validation-error-msg="Não é permitido campo em branco.">
                        <i class=" form-control-feedback glyphicon glyphicon-user" aria-hidden="true"></i>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <!--<label for="user_name">Seu nome:</label>-->
                        <input type="text" title="Seu email" name="user_email" class="form-control form-control-sm email" id="user_email"
                        placeholder="Seu email aqui, este será seu usuario..." value="<?php echo htmlentities(chk_array($modelo->form_data, 'user_email'));?>"
                        data-validation="custom" data-validation-regexp="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                        data-validation-help="Digite um email válido Ex: user@gmail.com"
                        data-validation-error-msg="Email digitado de forma incorreta.">
                        <i class=" form-control-feedback fa fa-envelope-o fa-fw"></i>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <!--<label for="user_name">Seu nome:</label>-->
                        <input type="text" title="Repita seu email" name="repeat" class="form-control form-control-sm email"
                        placeholder="Seu email aqui, este será seu usuario..." data-validation="confirmation"
                        data-validation-help="Repita o email novamente."
                        data-validation-confirm="user_email" data-validation-error-msg="O email não é igual ao digitado anteriormente.">
                        <i class=" form-control-feedback fa fa-envelope-o fa-fw"></i>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <!--<label for="user_password"> Senha: </label>-->
                        <input type="password" title="Sua senha" name="user_password" class="form-control form-control-sm error" placeholder="Sua senha..."
                        value="<?php echo htmlentities(chk_array($modelo->form_data, 'user_password'));?>"
                        data-validation="custom" data-validation-regexp="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                        data-validation-error-msg="A senha não cumpre os requisitos solicitados"
                        data-validation-help="A senha deve conter no minimo 6 caracteres inluindo um número e uma letra maiuscula Ex: User226.">
                        <i class=" form-control-feedback fa fa-key fa-fw"></i>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                        <!--<label for="user_password"> Senha: </label>-->
                        <input type="password" title="Repita sua senha" name="repeat" class="form-control form-control-sm"
                        placeholder="Repita sua senha..." data-validation-error-msg="As senhas não são iguais."
                        data-validation="confirmation" data-validation-confirm="user_password">
                        <i class=" form-control-feedback fa fa-key fa-fw"></i>
                    </div>

                    <div class="input-group-sm">
                        <button type="submit" title="Faz o cadastro" class="btn btn-primary btn-group-sm">Cadastrar-se <i class="glyphicon glyphicon-floppy-save" ></i> </button>
                        <button type="reset" title="Limpa o formulário" class="btn btn-danger btn-group-sm">Limpar <i class="glyphicon glyphicon-erase" ></i> </button>
                        <!--<a href="<?php echo HOME_URI . '/user-register'; ?>">New user</a>-->
                    </div>
                </form>

            </div>
            <div class="card-footer text-muted"> <small>Veja nosso contrato de prestação de serviço. <a href="#" title="Leia nosso termo de uso"> Leia-me</a></small> </div>
        </div>
    </div>
    <div class="col-md-1 col-md-1"></div>
</div> <!-- /row fluid  -->
