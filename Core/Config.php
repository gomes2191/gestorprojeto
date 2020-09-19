<?php

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
     * Caminho do projeto.
     *
     * @var string
     */
    const ABS_PATH = '/home/gomes/development/p_gclinic';

    /**
     * Diretório do projeto..
     *
     * @var string
     */
    const HOME_URI = '/p_gclinic';

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
     * Tipo de driver ex.: pgsql, mysql...
     * @var string
     */
    const DB_DRIVER = 'pgsql';

    /**
     * Nome do banco de dados.
     * @var string
     */
    const DB_NAME = 'gclinic';

    /**
     * Prefixo da tabela do banco de dados.
     * @var string
     */
    const TB_PREFIX = '_';

    /**
     * Usuário do banco de dados.
     * @var string
     */
    const DB_USER = 'postgres';

    /**
     * Usuário do banco de dados.
     * @var string
     */
    const DB_PASSWORD = 'Vectra';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;
}

/**
 * Retorna o diretório do arquivo.
 * Se usado dentro de um include, o diretório do arquivo incluído é retornado.
 * */
//define('ABS_PATH', dirname(__DIR__));

# Nome do site
///define('NOME_SITE', 'GClinic - ');

# Idioma do sistema
//define('LANG', 'pt_BR');

# Caminho para a pasta de uploads
define('UP_PATH', '/App/Views/_uploads');

// URL da home coloque o nome do diretório do projeto logo após a barra
//define('HOME_URI', '/p_gclinic');

# Nome do host da base de dados
//define('HOSTNAME', 'localhost');

# Tipo de driver Ex.: pgsql, mysql...
//define('DB_DRIVER', 'pgsql');

# Nome do banco
//('DB_NAME', 'gclinic');

# Tabela prefixo
//define('TB_PREFIX', '_');

# Usuário do banco
define('DB_USER', 'postgres');

# Senha do banco
define('DB_PASSWORD', 'Vectra');

# Charset da conexão PDO
define('DB_CHARSET', 'utf8');

# DEFINE O FUSO HORÁRIO COMO O HORÁRIO DE BRASÍLIA
define('TIME_ZONE', date_default_timezone_set('America/Sao_Paulo'));

# Liga ou desliga o DEBUG "TRUE" liga "FALSE" desliga
define('DEBUG', TRUE);

# Carrega o loader, que vai carregar a aplicação inteira
require_once dirname(__DIR__) . '/Core/Loader.php';
