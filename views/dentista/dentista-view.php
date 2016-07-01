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


		</div>
		<div class="col-md-4"></div>
	</div> <!-- /row -->