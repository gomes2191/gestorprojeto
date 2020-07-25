<?php
    #======================#
    #  PHP Version: 7.>  #
    #  Configuração Geral  #
    #======================#

    class Config {

        /**
         * Database host
         * @var string
         */
        const DB_HOST = 'localhost';

        /**
         * Database name
         * @var string
         */
        const DB_NAME = 'gclinic';

        /**
         * Database user
         * @var string
         */
        const DB_USER = 'root';

        /**
         * Database password
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
    define('ABSPATH', dirname(__DIR__));

    # Nome do site
    define('NOME_SITE', 'GClinic - ');
    
    # Idioma do sistema
    define('LANG', 'pt_BR');

    # Caminho para a pasta de uploads
    define('UP_ABSPATH', ABSPATH . '/App/Views/_uploads');

    # URL da home
    define('HOME_URI', '/gclinic');

    # Nome do host da base de dados
    define('HOSTNAME', 'localhost');

    # Tipo de driver Ex.: pgsql, mysql...
    define('DB_DRIVER', 'pgsql');

    # Nome do banco
    define('DB_NAME', 'gclinic');

    # Tabela prefixo
    define('TB_PREFIX', '');

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
    require_once (dirname(__DIR__).'/Core/Loader.php');
