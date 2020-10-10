<?php

// Inicia a sessão
session_start();

// Evita que usuários acesse este arquivo diretamente.
if (!Config::ABS_PATH) {
    (Config::SHOW_ERRORS) ? var_dump('Não foi definido o diretório do sistema.') : die('Erro fatal...');
}

/**
 * Loader - classe responsável por fazer a carga do
 * sistema e com algumas funções importantes.
 *
 * @category Class
 * @package  Loader
 * @author   F.A.G.A - <gomes.tisystem@gmail.com>
 * @license  gclinic.com Private
 * @link     www.gclinic.com
 * @since    0.2
 */
class AutoLoad
{

    public function __construct()
    {
        //spl_autoload_extensions('.class.php');
        spl_autoload_register(array($this, 'load'));

        // Carrega o método mostrar erros.
        $this->ligaDebug();

        // Carrega o metódo que seta o Time_Zone.
        $this->loadTimeZone();

        // Carrega o Time_Zone atual caso esteja setado no Config.
        $this->showTimeZone();
    }

    static function ligaDebug($showErros =  Config::SHOW_ERRORS)
    {
        // Verifica o modo para debugar
        if (!$showErros || $showErros == false) {
            // Esconde todos os erros
            error_reporting(0);
            ini_set('display_errors', 0);
            echo "<script>alert('Modo debug desativado!');</script>";
        } else {

            // Mostra todos os erros
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            ini_set('log_errors', 1);
            ini_set('error_reporting', -1);
            ini_set('html_errors', 1);

            // print_r(dirname(__DIR__));die;
            ini_set('error_log', dirname(__DIR__) . '/logs/error_log.txt');

            echo "<h6><span class='badge badge-pill badge-primary'>MOSTRAR ERROS: ATIVO</span></h6>";

            //echo "<script>alert('Modo Debug ativado!');</script>";
        }
    }

    static function loadTimeZone()
    {
        if (Config::TIME_ZONE['set']) {

            // retorna o TIME_ZONE especificado na constante...
            return date_default_timezone_set(Config::TIME_ZONE['set']);
        } else {

            // retorna o TIME_ZONE padrão UTC ...
            return date_default_timezone_set(DateTimeZone::listIdentifiers(DateTimeZone::UTC)[0]);
        }
    }

    static function showTimeZone()
    {
        if (Config::TIME_ZONE['show']) {
            echo "<h6><span class='badge badge-pill badge-primary'>FUSO HORÁRIO: " . date_default_timezone_get() . "</span></h6>";
        }
    }

    /**
     * Recebe a requisição e verifica se classe existe.
     *
     * @param string $nomeDaClasse recebe um valor no formato string.
     *
     * @return object object Retorna um object com os valores.
     */
    public static function load($nomeDaClasse)
    {
        $pastas = ['/Core/', '/interfaces/'];

        $extension =  spl_autoload_extensions();

        foreach ($pastas as $pasta) {
            $fileParcial = Config::ABS_PATH . $pasta . $nomeDaClasse;

            if ((file_exists($fileParcial . '.class.php')) or (file_exists($fileParcial . '.interf.php'))) {
                ('/Core/' === $pasta) ? include_once $fileParcial . '.class.php' : include_once $fileParcial . '.interf.php';

                unset($fileParcial, $pasta, $pastas, $nomeDaClasse);

                return;
            }
        } // End autoLoad

        //include_once dirname(__DIR__) . '/includes/404.php';

        //die('Erro: Classes não encontrada.');

        unset($fileParcial, $pasta, $nomeDaClasse, $pastas, $nomeDaClasse);
        //exit();
    }
}

// Carrega a classe AutoLoad
$autoload = new AutoLoad();

// Carrega toda aplicação.
$loadApplication = new SystemCore();
