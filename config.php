<?php

    /* Configuração geral */

    // Caminho para a raiz
    define('ABSPATH', dirname(__FILE__));

    // Nome do site
    define('NOME_SITE', 'Odonto C - ');

    // Idioma do sistema
    define('LANG', 'pt_BR');

    // Caminho para a pasta de uploads
    define('UP_ABSPATH', ABSPATH . '/views/_uploads');

    // URL da home
    define('HOME_URI', 'http://localhost/soc');

    // Nome do host da base de dados
    define('HOSTNAME', 'localhost');

    // Nome do banco
    define('DB_NAME', 'migration_ov');

    // Usuário do banco
    define('DB_USER', 'root');

    // Senha do banco
    define('DB_PASSWORD', 'libre');

    // Charset da conexão PDO
    define('DB_CHARSET', 'utf8');

    // Se você estiver desenvolvendo, modifique o valor para true
    define('DEBUG', TRUE);

    /**
     * Não edite daqui em diante
     * */
    // Carrega o loader, que vai carregar a aplicação inteira
    require_once (ABSPATH . '/loader.php');
