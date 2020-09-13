<?php if (!defined('Config::HOME_URI')) exit; ?>

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">

    <?php
    if ($this->logged_in) {
      echo '<p class="alert">Logado</p>';
    }
    ?>

    <?php
    if ($this->login_error) {
      echo
        '
                  <div class="alert alert-info" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span></button>
                           <strong>Atenção! </strong>' . $this->login_error . '
                  </div>

              ';
    }
    ?>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title text-center">ODONTO V</h3>
      </div>
      <div class="panel-body">
        <div class="alert alert-dismissible alert-success" role="alert">
          <h5>Recuperar sua senha,</h5> um link de redefinição de senha será enviado ao seu Email caso usuário exista na nossa base dedados...
        </div>
        <form class="form-signin" method="post">
          <h4 class="form-signin-heading text-center"></h4>
          <label for="user" class="sr-only">Usuário:</label>
          <input name="userdata[user]" type="text" id="user" class="form-control" placeholder="Seu login..." required autofocus>
          <br>
          <button class="btn btn-primary btn-block" type="submit">Redefinir senha</button>
        </form>
      </div>
      <div class="panel-footer"></div>
    </div>

  </div>
  <div class="col-md-4"></div>
</div> <!-- /row -->