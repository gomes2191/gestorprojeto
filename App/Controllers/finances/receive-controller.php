<?php

/**
 * BillsToPayController - Controller de exemplo
 *
 * @package OdontoControl
 * @since 0.1
 */
class ReceiveController extends MainController {

    # Tipo de página [int]
    public $page_type = 1;
    
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
     #public $permission_required = 'user-register';
    
    
    
    
    # Carrega a página "/views/user-register/index.php"
    public function index() {
        # Page title
        $this->title = ' Contas a pagar';

        #Verifica se o usuário está logado
        /*if (!$this->logged_in) {

            // Se não; garante o logout
            $this->logout();

            // Redireciona para a página de login
            $this->goto_login();

            // Garante que o script não vai passar daqui
            return;
        }
        // Verifica se o usuário tem a permissão para acessar essa página
        if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {

            // Exibe uma mensagem
            echo 'Você não tem permissões para acessar essa página.';

            // Finaliza aqui
            return;
        }
        */
        
        # Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        
       /* Carrega o modelo da classe
        * @var $modelo [mixed]*/
        //$modelo[0] = new MainModel();
        
       /* Carrega o modelo da classe
        * @var $modelo [mixed]*/
        $modelo = $this->load_model('finances/receive-model');
        
        #   Carrega os arquivos do view 
        #-->   /app/views/_includes/header.php
        require_once (ABSPATH . '/app/views/_includes/header.php');

        #--> /views/_includes/menu.php
        require_once (ABSPATH . '/app/views/_includes/menu.php');

        #--> /views/user-register/index.php
        require_once (ABSPATH . '/app/views/finances/bills_to_receive/receive-view.php');

        #--> /views/_includes/footer.php
        require_once (ABSPATH . '/app/views/_includes/footer.php');
        
    }   #--> End index
    
    # URL: dominio.com/exemplo/exemplo
    public function Filters() {
        //$search_string = $_POST['query'];
       //echo $search_string;
        #   Parametros da função
        #$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        
        #   Page title
        #$this->title = ' Honorários';
        
        #---> Inclua seus models e views aqui
        
        /* Carrega o modelo da classe
        * @var $modelo [mixed]*/
        //$modelo[0] = new MainModel();
        
       /* Carrega o modelo da classe
        * @var $modelo [mixed]*/
        $modelo = $this->load_model('finances/receive-model');

        #   Carrega o topo
        //require_once (ABSPATH . '/views/_includes/header.php');
        
        #   Carrega menus
        //require_once (ABSPATH.'/views/_includes/menu.php');

        #   Carrega o view
        require_once (ABSPATH . '/app/views/finances/bills_to_receive/filters-view.php');

        //require_once (ABSPATH . '/views/_includes/footer.php');
        
    }   #--> End Search
    
    # URL: dominio.com/exemplo/exemplo
    public function AjaxProcess() {
        #   Parametros da função
        #$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        
        #   Page title
        #$this->title = ' Honorários';
        
        #---> Inclua seus models e views aqui
        
        /* Carrega o modelo da classe
        * @var $modelo [mixed]*/
        //$modelo[0] = new MainModel();
        
       /* Carrega o modelo da classe
        * @var $modelo [mixed]*/
        $modelo = $this->load_model('finances/receive-model');

        #   Carrega o topo
        //require_once (ABSPATH . '/views/_includes/header.php');
        
        #   Carrega menus
        //require_once (ABSPATH.'/views/_includes/menu.php');

        #   Carrega o view
        require_once (ABSPATH . '/app/views/finances/bills_to_receive/ajax-process-view.php');

        //require_once (ABSPATH . '/views/_includes/footer.php');
        
    }   #--> End TopSearch
    
}   #--> End FonecedoresController