<?php

// Inicia a sessão
session_start();

// Evita que usuários acesse este arquivo diretamente.
if (!Config::ABS_PATH) {
    (Config::DEBUG['show']) ? var_dump('Não foi definido o diretório do sistema.') : die('Erro fatal...');
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
        spl_autoload_register(array($this, 'load'));

        // Carrega o método mostrar erros.
        //$this->ligaDebug();

        // Carrega o metódo que seta o Time_Zone.
        //$this->setTimeZone();

        // Carrega o Time_Zone atual caso esteja setado no Config.
        //$this->showTimeZone();
    }

    public static function showTimeZone()
    {
        if (Config::TIME_ZONE['show']) {
            echo "<h6><span class='badge bg-primary'>FUSO HORÁRIO: " . date_default_timezone_get() . "</span></h6>";
        }
    }

    public static function statusDebug()
    {
        if (Config::DEBUG['display']) {
            echo "<h6><span class='badge bg-primary'>MODO DEBUG: ativo </span></h6>";
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
        $pastas = ['/Core/', '/interf/'];

        //$extension =  spl_autoload_extensions();
        spl_autoload_extensions('.php');

        foreach ($pastas as $pasta) {
            $fileParcial = Config::ABS_PATH . $pasta . $nomeDaClasse;
            /* echo '<pre>';
            print_r($fileParcial);
            echo '</pre>'; */

            if ((file_exists($fileParcial . '.php'))) {

                require_once $fileParcial . '.php';

                unset($fileParcial, $pasta, $pastas, $nomeDaClasse);

                return;
            }
        }

        include_once dirname(__DIR__) . '/includes/404.php';

        //die('Erro: Classes não encontrada.');

        unset($fileParcial, $pasta, $nomeDaClasse, $pastas, $nomeDaClasse);
    } // End autoLoad
}

// Carrega a classe AutoLoad
$autoLoad = new AutoLoad();

// Carrega toda aplicação.
$loadApplication = new SystemCore();
