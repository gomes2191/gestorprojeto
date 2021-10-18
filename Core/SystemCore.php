<?php


class SystemCore
{

    private $controlador;

    private $acao;

    private $_parameters;

    private $_notFound = '/includes/404.php';

    public function __construct()
    {
        $this->getUrlData();

        if (!$this->controlador) {

            // Adiciona o controlador padrão
            include_once $this->_getFile('ProjectsController.php');

            $this->controlador = new ProjectsController();

            // Executa o método index()
            $this->controlador->index();

            // FIM :)
            return;
        }

        // Se o arquivo do controlador não existir, não faremos nada
        if (!file_exists($this->_getFile($this->controlador . '.php'))) {


            // Página não encontrada
            include_once Config::ABS_PATH . $this->_notFound;

            // FIM :)
            return;
        }

        // Inclui o arquivo do controlador
        include_once $this->_getFile($this->controlador . '.php');

        $this->controlador = preg_replace('/[^a-zA-Z]/i', '', $this->controlador);


        // Se a classe do controlador indicado não existir, não faremos nada
        if (!class_exists($this->controlador)) {
            echo 'Aqui';
            // Página não encontrada
            include_once Config::ABS_PATH . $this->_notFound;

            // FIM :)
            return;
        } // class_exists

        // Cria o objeto da classe do controlador e envia os parâmentros
        $this->controlador = new $this->controlador($this->_parameters);

        // Remove caracteres inválidos do nome da ação (método)
        $this->acao = preg_replace('/[^a-zA-Z]/i', '', $this->acao);

        // Se o método indicado existir, executa o método e envia os parâmetros
        if (method_exists($this->controlador, $this->acao)) {
            $this->controlador->{$this->acao}($this->_parameters);

            // FIM :)
            return;
        } // method_exists
        # Sem ação, chamamos o método index
        if ((!$this->acao || ($this->acao && !method_exists($this->controlador, $this->acao))) && method_exists($this->controlador, 'index')) {
            $this->controlador->index($this->_parameters);

            // FIM :)
            return;
        } // ! $this->acao
        // Página não encontrada
        include_once Config::ABS_PATH . $this->_notFound;

        // FIM :)
        return;
    }

    private function _getFile($controle)
    {
        $encontrado = null;

        $directory = new \RecursiveDirectoryIterator(Config::ABS_PATH . '/App/Controllers/');

        $iterator = new \RecursiveIteratorIterator($directory);

        foreach ($iterator as $info) {

            if (strripos($info->getPathname(), $controle)) {
                $encontrado = $info->getPathname();
            }
        }
        unset($directory, $iterator, $info, $controle);
        return $encontrado;
    }

    public function getUrlData()
    {
        // Verifica se o parâmetro path foi enviado
        if ((filter_input(INPUT_GET, 'path', FILTER_SANITIZE_URL))) {

            # Captura o valor de $_GET['path']
            $path1 = filter_input(INPUT_GET, 'path', FILTER_SANITIZE_URL);

            # Remove a barra invertida do final
            $path2 = preg_replace('/[\/]$/', "", $path1);

            // Limpa os dados
            $path3 = rtrim($path2, '/');
            $path4 = ucfirst(filter_var($path3, FILTER_SANITIZE_URL));

            // Cria um array de parâmetros
            $path = explode('/', $path4);

            // Configura as propriedades
            $this->controlador = GFunc::chkArray($path, 0);
            $this->controlador .= 'Controller';
            $this->acao = GFunc::chkArray($path, 1);

            // Configura os parâmetros
            if (GFunc::chkArray($path, 2)) {

                unset($path[0]);
                unset($path[1]);

                // Os parâmetros sempre virão após a ação
                $this->_parameters = array_values($path);
            }
        }
    }
}
