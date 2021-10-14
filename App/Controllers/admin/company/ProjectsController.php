<?php

use Core\View;

/**
 * @description ProvidersController - controlador de fornecedores
 *
 * @package SystemControl
 * @since 0.1
 */
class ProjectsController extends MainController
{
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
    public $permission_required = 'user-register';


    /*
     * Carrega a página (Providers) em:
     * "Views/admin/company/provider/provider.blade.php"
     */
    public function index()
    {
        // Carrega o modelo para esta view
        //$modelo = $this->loadModel('admin/company/Provider');

        /******
         * Verifica se o diretório do arquivo foi definido.
         * Evita o acesso direto ao arquivo.
         *******/
        if (!Config::ABS_PATH) {
            echo 'Erro: O diretório da aplicação não foi definido.';
        }

        View::renderTemplate(
            '/admin/company/project/project',
            [
                'modelo' => $this->loadModel('admin/company/Project'),
                'objControl' => new ProjectsController(),
                'pageType' => 1,
                'title' => $this->title
            ]
        );
    }   #--> End index

    # URL: dominio.com/exemplo/exemplo
    public function Filters()
    {
        View::render('/admin/company/project/filters.php', [
            'modelo' => $this->loadModel('admin/company/Project'), 'globalF' => new GFunc
        ]);
    }   #--> End Search

    # URL: dominio.com/exemplo/exemplo
    public function AjaxProcess()
    {
        View::render('/admin/company/project/ajax-process.php', ['modelo' => $this->loadModel('admin/company/Project')]);
    }   #--> End TopSearch

}   #--> End FonecedoresController