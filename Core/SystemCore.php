<?php

/**
 * SystemCore - Responsável por gerenciar: Models, Controllers e Views.
 *
 * @category Class
 * @package  SystemCore
 * @author   Francisco <gomes.tisystem@gmail.com>
 * @license  gclinic.com Private
 * @link     www.gclinic.com
 * @since    0.2
 **/
class SystemCore
{
    /**
     * $controlador
     *
     * Receberá o valor do controlador (Vindo da URL).
     * exemplo.com/controlador/
     *
     * @access private
     */
    private $controlador;

    /**
     * $acao
     *
     * Receberá o valor da ação (Também vem da URL):
     * exemplo.com/controlador/acao
     *
     * @access private
     */
    private $acao;

    /**
     * $_parameters
     *
     * Receberá um array dos parâmetros (Também vem da URL):
     * exemplo.com/controlador/acao/param1/param2/param50
     *
     * @access private
     */
    private $_parameters;

    /**
     * $not_found
     *
     * Caminho da página não encontrada
     *
     * @access private
     */
    private $_notFound = '/includes/404.php';

    /**
     * Construtor para essa classe
     *
     * Obtém os valores do controlador, ação e parâmetros. Configura
     * o controlado e a ação (método).
     */
    public function __construct()
    {

        // Obtém os valores do controlador, ação e parâmetros da URL.
        // E configura as propriedades da classe.
        $this->getUrlData();

        /**
         * Verifica se o controlador existe. Caso contrário, adiciona o
         * controlador padrão (controllers/home-controller.php) e chama o método index().
         */
        if (!$this->controlador) {
            // Adiciona o controlador padrão
            include_once $this->_getFile('RegisterController.php');

            // Cria o objeto do controlador "home-controller.php"
            // Este controlador deverá ter uma classe chamada HomeController
            $this->controlador = new RegisterController();

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

        /* Remove caracteres inválidos do nome do controlador para gerar o nome
        da classe. Se o arquivo chamar "news-controller.php", a classe deverá
        se chamar NewsController. */
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
    } // __construct

    /**
     * @access: private
     * @author: Francisco Aparecido - F.A.G.A <gomes.tisystem@gmail.com>
     * @version: 0.2
     * @param: string variable
     * @param: string $controle [required]
     * </code>
     * @return: string Retorna uma string com o valor retornado.
     */
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

    /**
     * Obtém parâmetros de $_GET['path']
     *
     * Obtém os parâmetros de $_GET['path'] e configura as propriedades
     * $this->controlador, $this->acao e $this->_parameters
     *
     * A URL deverá ter o seguinte formato:
     * http://www.example.com/controlador/acao/parametro1/parametro2/etc...
     */
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
} // End :) Class
