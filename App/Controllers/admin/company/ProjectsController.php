<?php

    use Core\View;

    class ProjectsController extends MainController
    {
        public function index()
        {
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
        }

        public function Filters()
        {
            View::render('/admin/company/project/filters.php', [
                'modelo' => $this->loadModel('admin/company/Project'), 'globalF' => new GFunc
            ]);
        }

        public function AjaxProcess()
        {
            View::render('/admin/company/project/ajax-process.php', ['modelo' => $this->loadModel('admin/company/Project')]);
        }
}