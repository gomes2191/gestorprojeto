<?php

/**
 * StockController - Controller de exemplo
 *
 * @package OdontoControl
 * @since 0.1
 */
class LaboratoryController extends MainController {

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
        $this->title = ' Laboratório';

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
        $modelo = $this->load_model('laboratory/laboratory-model');

        #   Carrega os arquivos do view 
        #-->   /views/_includes/header.php
        require_once (ABSPATH . '/views/_includes/header.php');

        #--> /views/_includes/menu.php
        require_once (ABSPATH . '/views/_includes/menu.php');

        #--> /views/user-register/index.php
        require_once (ABSPATH . '/views/laboratory/laboratory-view.php');

        #--> /views/_includes/footer.php
        require_once (ABSPATH . '/views/_includes/footer.php');
    }   #--> End index
    
    # URL: dominio.com/exemplo/exemplo
    public function Cad() {
        #   Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        
        #   Page title
        $this->title = ' Cadastro de laboratório';
        
        #---> Inclua seus models e views aqui
        
        #   Carrega o modelo
        $modelo = $this->load_model('laboratory/laboratory-model');

        #   Carrega o topo
        require_once (ABSPATH . '/views/_includes/header.php');
        
        #   Carrega menus
        require_once (ABSPATH.'/views/_includes/menu.php');

        #   Carrega o view
        require_once (ABSPATH . '/views/laboratory/cad-view.php');

        require_once (ABSPATH . '/views/_includes/footer.php');
        
    }   #--> End cad
    
    public function BoxView(){
        
        #   Carrega o modelo
        $modelo = $this->load_model('laboratory/laboratory-model');
        
        #   Carrega o view
        require_once (ABSPATH . '/views/laboratory/box-view.php');
        
    }   #--> End BoxView
    
    public function Card(){
        
        # Carrega o modelo
        $modelo = $this->load_model('laboratory/laboratory-model');
        
        # Carrega a classe que gera o pdf
        require_once (ABSPATH . '/dompdf/autoload.inc.php');
        
        # Carrega o view
        require_once (ABSPATH . '/views/laboratory/card-view.php');
        
    }   #--> End Card
    
    
    public function ReturnView(){
        
        #   Carrega o modelo
        $modelo = $this->load_model('laboratory/laboratory-model');
        
        #   Carrega o view
        require_once (ABSPATH . '/views/laboratory/return-view.php');
        
    }   #--> End BoxView
    
}   #--> End FonecedoresController