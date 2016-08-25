<?php if (!defined('ABSPATH')) exit; ?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        
    <?php
        if ($this->logged_in) 
        {
            echo '<p class="alert">Logado</p>';
        }
    ?>
        
        <?php
        if ($this->login_error) 
        {
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
			    	<h3 class="panel-title">
                                    <img src="<?php echo HOME_URI;?>/logo.png" style="margin-top: -5px;" width="100">
                                    Logar-se
                                </h3>
			 	</div>
			  	<div class="panel-body">
			    	
                                    
                                    
                                    <form class="form-signin" method="post" role="form">
                                        <fieldset>
            
            <div class="form-group">
            <label for="inputEmail" class="sr-only">Usuário</label>
            <input name="userdata[user]" type="text" id="inputEmail" class="form-control" placeholder="Insira seu login..." required autofocus>
            </div>
            <div class="form-group">
            <label for="inputPassword" class="sr-only">Senha</label>
            <input name="userdata[user_password]" type="password" id="inputPassword" class="form-control" placeholder="Sua senha..." required>
            </div>
            <div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Lembrar-me
			    	    	</label>
			    	    </div>
            <button class="btn btn-success btn-block" type="submit">Logar-se</button>
            </fieldset>
        </form>
			    </div>
			</div>

    </div>
    <div class="col-md-4"></div>
</div> <!-- /row -->