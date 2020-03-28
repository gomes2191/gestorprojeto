<?php
/**
 * RecuperarController - Controller de repureção de senha
 *
 * @package OdontoControl
 * @since 0.1
 */
class RecuperarController extends MainController
{

	/**
	 * Carrega a página "/views/login/index.php"
	 */
    public function index() {
		// Título da página
		$this->title = 'Solicitar senha';

		// Parametros da função
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

		// Login não tem Model

		/** Carrega os arquivos do view **/

		// /views/_includes/header.php
        require ABSPATH . '/views/_includes/header.php';

		// /views/_includes/menu.php
        require ABSPATH . '/views/_includes/menu.php';

		// /views/home/login-view.php
        require ABSPATH . '/views/recuperar/recuperar-view.php';

		// /views/_includes/footer.php
        require ABSPATH . '/views/_includes/footer.php';

    } // index

} // class LoginController
