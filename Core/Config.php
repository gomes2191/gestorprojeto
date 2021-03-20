<?php

//namespace Core;


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
class Config
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
    const TB_PREFIX = ' ';

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
     * mostra o TIME_ZONE atual, ex.: true liga, false desliga.
     *
     * @var array
     */
    const TIME_ZONE = ['set' => 'America/Sao_Paulo', 'show' => false];

    /**
     * Mostra o TIME_ZONE atual, ex.: true liga, false desliga.
     *
     * @var boolean
     */
    //const SHOW_TIME_ZONE = true;

    /**
     * 'set' => true, liga ou desliga o DEBUG "true" liga "false" desliga.
     * 'show' => true, mostra se o debug está ativo
     *
     * @var boolean
     */
    const DEBUG = ['display' => false];

    /*
    * Método construtor
    */
    public function __construct()
    {
        $this->setTimeZone();

        $this->debug();
    }

    /**
     * Seta os parâmetros do fuso horário.
     *
     * @param string $timeZone recebe um valor no formato array.
     *
     * @return object object Retorna um object com os valores.
     */
    public static function setTimeZone()
    {
        // Recebe a constante com os parâmetros
        $timeZone = Config::TIME_ZONE;

        if ($timeZone['set']) {
            // retorna o TIME_ZONE especificado na constante...
            return date_default_timezone_set($timeZone['set']);
        } else {

            // retorna o TIME_ZONE padrão UTC ...
            return date_default_timezone_set(\DateTimeZone::listIdentifiers(\DateTimeZone::UTC)[0]);
        }
    }

    public static function debug()
    {
        // Recebe a constante
        $debug = Config::DEBUG;

        // Verifica se o debug esta ativo.
        if (!$debug['display'] || $debug['display'] === false) {
            // Esconde todos os erros
            error_reporting(1);
            ini_set('ignore_repeated_source', 1);
            ini_set('ignore_repeated_errors', 1);
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            ini_set('html_errors', 1);
            ini_set('log_errors', 1);
            ini_set('error_log', dirname(__DIR__) . '/logs/error_log.txt');

            //echo ini_get('display_errors');
            //echo ini_get('error_reporting');
            //echo ini_get('display_errors');
            //echo ini_get('log_errors');

            //echo "<script>alert('Modo debug desativado!');</script>";
        } else {
            // Mostra todos os erros
            ini_set('xdebug.scream', '1');
            ini_set('ignore_repeated_source', 1);
            ini_set('ignore_repeated_errors', 1);
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            ini_set('error_reporting', 1);
            ini_set('html_errors', 1);
            ini_set('log_errors', 1);
            ini_set('error_log', dirname(__DIR__) . '/logs/error_log.txt');

            //echo "<script>alert('Modo Debug ativado!');</script>";
        }
    }
}

$config = new Config();



/***
 * Primordial para o funcionamento da Aplicação,
 * sem essa classe o sistema não fuciona. (0_0)
 */
include_once dirname(__DIR__) . '/Core/AutoLoad.php';
