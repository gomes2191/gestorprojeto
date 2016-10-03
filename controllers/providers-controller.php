<?php

/**
 * UserRegisterController - Controller de exemplo
 *
 * @package OdontoVision
 * @since 0.1
 */
class ProvidersController extends MainController {

    /**
     * $login_required
     *
     * Se a página precisa de login
     *
     * @access public
     */
    public $login_required = false;

    /**
     * $permission_required
     *
     * Permissão necessária
     *
     * @access public
     */
//        public $permission_required = 'user-register';

    
    #   Carrega a página "/views/user-register/index.php"
     
    public function index() {
        // Page title
        $this->title = ' Fornecedores';

        // Verifica se o usuário está logado
//		if ( ! $this->logged_in ) {
//
//			// Se não; garante o logout
//			$this->logout();
//
//			// Redireciona para a página de login
//			$this->goto_login();
//
//			// Garante que o script não vai passar daqui
//			return;
//
//		}
//		// Verifica se o usuário tem a permissão para acessar essa página
//		if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
//
//			// Exibe uma mensagem
//			echo 'Você não tem permissões para acessar essa página.';
//
//			// Finaliza aqui
//			return;
//		}
        # Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];

        # Carrega o modelo para este view
        $modelo = $this->load_model('provider/provider-model');

        #   Carrega os arquivos do view 
        #-->   /views/_includes/header.php
        require_once (ABSPATH . '/views/_includes/header.php');

        #--> /views/_includes/menu.php
        require_once (ABSPATH . '/views/_includes/menu.php');

        #--> /views/user-register/index.php
        require_once (ABSPATH . '/views/provider/providers-view.php');

        #--> /views/_includes/footer.php
        require_once (ABSPATH . '/views/_includes/footer.php');
    }   #--> End index
    
    # URL: dominio.com/exemplo/exemplo
    public function Cad() {
        #   Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        
        #   Page title
        $this->title = ' Cadastro de fornecedor';
        
        #---> Inclua seus models e views aqui
        
        #   Carrega o modelo
        $modelo = $this->load_model('provider/provider-model');

        #   Carrega o topo
        require_once (ABSPATH . '/views/_includes/header.php');
        
        #   Carrega menus
        require_once (ABSPATH.'/views/_includes/menu.php');

        #   Carrega o view
        require_once (ABSPATH . '/views/provider/cad-view.php');

        require_once (ABSPATH . '/views/_includes/footer.php');
        
    }   #--> End cad
    
}   #--> End FonecedoresController