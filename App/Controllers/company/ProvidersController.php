<?php

use Core\View;
//use Core\GlobalFunctions;
/**
 * @description ProvidersController - controlador de fornecedores
 *
 * @package SystemControl
 * @since 0.1
 */
class ProvidersController extends MainController {

    // Tipo de página [int]
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
       
        # Carrega o modelo para esta view
        $modelo = $this->load_model('company/Provider');
       
        /******
        * Verifica se o diretório do arquivo foi definido. 
        * Evita o acesso direto ao arquivo. 
        *******/
        if ( !defined('ABSPATH') ) { exit(); }

        # Define o limite padrão de registro por página
        $limit = 5;

    # Realiza uma consulta na base de dados e retorna todos os registro caso exista
    $providers = $modelo->searchTable('providers', ['order_by' => 'id DESC ', 'limit' => $limit]);

    $pagConfig = [
        'totalRows' => (is_array($providers) ? COUNT($providers) : 0),
        'perPage'   => $limit,
        'link_func' => 'searchFilter'
    ];

    # Cria um objeto da classe paginação
    $pagination = new Pagination($pagConfig);

    date_default_timezone_set('America/Sao_Paulo');
    $date = (date('Y-m-d H:i'));
    date('Y-m-d H:i:s', time());

    # Finaliza variáveis não mais utilizada.
    unset($providers, $date, $pagination);
       

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
        

        #   Carrega os arquivos do view 
        #-->   /views/_includes/header.php
        require_once (ABSPATH . '/App/Views/_includes/header.php');

        #--> /views/_includes/menu.php
        require_once (ABSPATH . '/App/Views/_includes/menu.php');

        #--> /views/user-register/index.php
        //require_once (ABSPATH . '/App/Views/company/providers/providers.php');
        // View::renderTemplate('/Admin/home/index', ['home' => '']);


        View::renderTemplate('/admin/company/provider/provider', ['']);
        
        GlobalFunctions::isSite();

        #--> /views/_includes/footer.php
        require_once (ABSPATH . '/App/Views/_includes/footer.php');
    }   #--> End index
    
    # URL: dominio.com/exemplo/exemplo
    public function Cad() {
        #   Parametros da função
        #$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        
        #   Page title
        $this->title = ' Cadastro de convênio';
        
        #---> Inclua seus models e views aqui
        
        #   Carrega o modelo
        $modelo = $this->load_model('covenant/covenant-model');

        #   Carrega o topo
        require_once (ABSPATH . '/views/_includes/header.php');
        
        #   Carrega menus
        require_once (ABSPATH.'/views/_includes/menu.php');

        #   Carrega o view
        require_once (ABSPATH . '/views/covenant/cad-view.php');

        require_once (ABSPATH . '/views/_includes/footer.php');
        
    }   #--> End cad
    
    public function BoxView(){
        
        #   Carrega o modelo
        $modelo = $this->load_model('finances/receive-model');
        
        #   Carrega o view
        require_once (ABSPATH . '/views/finances/receive/box-view.php');
        
    }   #--> End BoxView
    
    public function Card(){
        
        # Carrega o modelo
        $modelo = $this->load_model('covenant/covenant-model');
        
        # Carrega a classe que gera o pdf
        //require_once (ABSPATH . '/dompdf/autoload.inc.php');
        
        # Carrega o view
        require_once (ABSPATH . '/views/covenant/card-view.php');
        
    }   #--> End Card
    
    
    # URL: dominio.com/exemplo/exemplo
    public function Fees() {
        #   Parametros da função
        #$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        
        #   Page title
        $this->title = ' Contas a pagar';
        
        #---> Inclua seus models e views aqui
        
        #   Carrega o modelo
        $modelo = $this->load_model('covenant/fees-model');

        #   Carrega o topo
        require_once (ABSPATH . '/views/_includes/header.php');
        
        #   Carrega menus
        require_once (ABSPATH.'/views/_includes/menu.php');

        #   Carrega o view
        require_once (ABSPATH . '/views/covenant/fees-view.php');

        require_once (ABSPATH . '/views/_includes/footer.php');
        
    }   #--> End cad
    
    # URL: dominio.com/exemplo/exemplo
    public function Filters() {
        //$search_string = $_POST['query'];
       //echo $search_string;
        #   Parametros da função
        #$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        
        #   Page title
        #$this->title = ' Honorários';
        
        #---> Inclua seus models e views aqui
        
        #   Carrega o modelo
        //$modelo = $this->load_model('company/Provider');

        // Carrega a classe GlobalFunctions
        //$globalF = new GlobalFunctions;

        #   Carrega o topo
        //require_once (ABSPATH . '/views/_includes/header.php');
        
        #   Carrega menus
        //require_once (ABSPATH.'/views/_includes/menu.php');

        #   Carrega o view
        //require_once (ABSPATH . '/App/Views/company/provider/filters.php');
      
        View::render('/admin/company/provider/filters.php', ['modelo' => $this->load_model('company/Provider'), 'globalF' => new GlobalFunctions]);

        //require_once (ABSPATH . '/app/views/_includes/footer.php');
        
    }   #--> End Search
    
    # URL: dominio.com/exemplo/exemplo
    public function AjaxProcess() {
        #   Parametros da função
        #$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : [];
        
        #   Page title
        #$this->title = ' Honorários';
        
        #---> Inclua seus models e views aqui
        
        #   Carrega o modelo
        $modelo = $this->load_model('company/Provider');

        //print_r($modelo);die();

        #   Carrega o topo
        //require_once (ABSPATH . '/views/_includes/header.php');
        
        #   Carrega menus
        //require_once (ABSPATH.'/views/_includes/menu.php');

        #   Carrega o view
        require_once (ABSPATH . '/App/Views/company/provider/ajax-process.php');

        //require_once (ABSPATH . '/views/_includes/footer.php');
        
    }   #--> End TopSearch
    
}   #--> End FonecedoresController