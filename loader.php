<?php

    // Evita que usuários acesse este arquivo diretamente
    if (!defined('ABSPATH')) {
        exit;
    }

    // Inicia a sessão
    session_start();

    // Verifica o modo para debugar
    if (!defined('DEBUG') || DEBUG == false) {
        // Esconde todos os erros
        error_reporting(0);
        ini_set("display_errors", 0);
    } else {
        // Mostra todos os erros
        ini_set('display_errors', 1);
        ini_set('log_errors', 0);
        ini_set('error_log', dirname(__FILE__).'/error_log.txt');
        error_reporting(E_ALL);
    }

    // Funções globais
    require_once (ABSPATH . '/functions/global-functions.php');

    // Carrega a aplicação
    $odonto_control = new OdontoControl();
