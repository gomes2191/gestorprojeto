	<?php if ( ! defined('ABSPATH')) exit; ?>

	<div class="row">

		<?php
			if ( $this->logged_in ) 
			{
				echo '<p class="alert">Logado</p>';
			}
		?>

		<div class="col-md-4"></div>
		<div class="col-md-4">
			<?php
				if( $this->login_error )
				{
					echo
					'
						<div class="alert alert-info" role="alert">
			 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			 				 <span aria-hidden="true">&times;</span></button>
			  				 <strong>Atenção! </strong>'.$this->login_error.'
						</div>

					';


	  			}
			?>

			<form class="form-signin" method="post">
		        <h3 class="form-signin-heading"><center>ACESSO AO SISTEMA</center></h3>
		        <label for="inputEmail" class="sr-only">Usuário</label>
		        <input name="userdata[user]" type="text" id="inputEmail" class="form-control" placeholder="Insira seu login..." required autofocus>
		        <label for="inputPassword" class="sr-only">Senha</label>
		        <input name="userdata[user_password]" type="password" id="inputPassword" class="form-control" placeholder="Sua senha..." required>
		        <!--<div class="checkbox">
		          <label>
		            <input type="checkbox" value="remember-me"> Remember me
		          </label>
		        </div>-->
		        <button class="btn btn-lg btn-primary btn-block" type="submit">Logar-se</button>
      		</form>

		</div>
		<div class="col-md-4"></div>
	</div> <!-- /row -->