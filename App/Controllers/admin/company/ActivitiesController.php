<?php

    use Core\View;

class ActivitiesController extends MainController
{
    public function index()
    {
        if (!Config::ABS_PATH) {
            echo 'Erro: O diretório da aplicação não foi definido.';
        }

        View::renderTemplate(
            '/admin/company/activity/activity',
            [
                'modelo' => $this->loadModel('admin/company/Activity'),
                'objControl' => new ActivitiesController(),
                'pageType' => 1,
                'title' => $this->title
            ]
        );
    }

    public function Filters()
    {
        View::render('/admin/company/activity/filters.php', [
            'modelo' => $this->loadModel('admin/company/Activity'), 'globalF' => new GFunc
        ]);
    }

    public function AjaxProcess()
    {
        View::render('/admin/company/activity/ajax-process.php', ['modelo' => $this->loadModel('admin/company/Activity')]);
    }

}