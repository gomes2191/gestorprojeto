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
    const ABS_PATH = '/home/gomes/development/p_gclinic';

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
    const DB_PASSWORD = 'Vectra';

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
    const TIME_ZONE = ['set' => false, 'show' => false];

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
}

/***
 * Primordial para o funcionamento da Aplicação,
 * sem essa classe o sistema não fuciona. (0_0)
 */
include_once dirname(__DIR__) . '/Core/AutoLoad.php';
