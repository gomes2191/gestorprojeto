<?php

// Inclui o config no sistema
use Core\ControleErros;

/**
 * Config - classe com os parâmetros de configuração.
 *
 * @category Class
 * @package  Config
 * @author   F.A.G.A - <gomes.tisystem@gmail.com>
 * @license  gclinic.com Private
 * @link     www.gclinic.com
 * @since    0.2
 */
class Config extends ControleErros
{

    /**
     * Diretório do projeto..
     *
     * @var string
     */
    const HOME_URI = '/p_gclinic';

    /**
     * Caminho do projeto.
     *
     * @var string
     */
    const ABS_PATH = '/home/francisco/development/p_gclinic';

    /**
     * Caminho para a pasta de uploads.
     *
     * @var string
     */
    const UP_PATH = '/public/_uploads';


    /**
     * Define o nome do site;
     *
     * @var string
     */
    const NOME_SITE = 'GClinic - ';

    /**
     * Define o idioma do site.
     *
     * @var string
     */
    const LANG = 'pt_BR';
    /**
     * Define o endereço do banco de dados.
     *
     * @var string
     */

    const DB_HOST = 'localhost';

    /**
     * Tipo de driver ex.: pgsql, mysql.
     * Tipo de offset ex.: pgsql -> ' offset ', mysql -> ' , '.
     * Exemplos de configuração: ['driver' => 'mysql', 'offset' => ' , '] para mysql,
     * ['driver' => 'pgsql', 'offset' => ' offset '] para postgres.
     *
     * @var array
     */
    const DB_DRIVER = ['driver' => 'mysql', 'offset' => ' , '];



    /**
     * Nome do banco de dados.
     *
     * @var string
     */
    const DB_NAME = 'gclinic';

    /**
     * Prefixo da tabela do banco de dados.
     *
     * @var string
     */
    const TB_PREFIX = '';

    /**
     * Usuário do banco de dados.
     *
     * @var string
     */
    const DB_USER = 'admin';

    /**
     * Usuário do banco de dados.
     *
     * @var string
     */
    const DB_PASSWORD = '123456';

    /**
     * Charset da conexão PDO.
     *
     * @var string
     */
    const DB_CHARSET = 'utf8';

    /**
     * Define o TIME_ZONE, ex.: 'America/Sao_Paulo'
     * se especificado o fuso horário retorna ele,
     * se não, retorna o fuso horário padrão 'UTC'.
     * Ex.: set => 'America/Sao_Paulo' & 'show' => true
     *
     * @var array
     */
    const TIME_ZONE = ['set' => 'America/Sao_Paulo', 'show' => true];

    /**
     * Mostra o TIME_ZONE atual, ex.: true liga, false desliga.
     *
     * @var boolean
     */
    const SHOW_TIME_ZONE = true;

    /**
     * Liga ou desliga o DEBUG "TRUE" liga "FALSE" desliga.
     * @var boolean
     */
    const SHOW_ERRORS = true;

    /*
    * Método construtor
    */
    public function __construct()
    {
        $this->setTimeZone();
        //$this->ligaDebug();

        set_error_handler(array(&$this, 'controlar'));
    }


    public static function setTimeZone()
    {
        if (Config::TIME_ZONE['set']) {

            // retorna o TIME_ZONE especificado na constante...
            return date_default_timezone_set(Config::TIME_ZONE['set']);
        } else {

            // retorna o TIME_ZONE padrão UTC ...
            return date_default_timezone_set(DateTimeZone::listIdentifiers(DateTimeZone::UTC)[0]);
        }
    }

    public static function ligaDebug($showErros =  Config::SHOW_ERRORS)
    {
        // Verifica o modo para debugar
        if (!$showErros || $showErros == false) {
            // Esconde todos os erros
            error_reporting(0);
            ini_set('display_errors', 0);
            //echo "<script>alert('Modo debug desativado!');</script>";
        } else {

            // Mostra todos os erros
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            ini_set('log_errors', 1);
            ini_set('error_reporting', -1);
            ini_set('html_errors', 1);

            print_r(dirname(__DIR__));

            ini_set('error_log', dirname(__DIR__) . '/logs/error_log.txt');

            //echo "<h6><span class='badge badge-pill badge-primary'>MOSTRAR ERROS: ATIVO</span></h6>";

            //echo "<script>alert('Modo Debug ativado!');</script>";
        }
    }
}

$Config = new Config();

/***
 * Primordial para o funcionamento da Aplicação,
 * sem essa classe o sistema não fuciona. (0_0)
 */
include_once dirname(__DIR__) . '/Core/AutoLoad.php';
