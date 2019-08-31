<?php

    # Evita que usuários acesse este arquivo diretamente.
    if (!defined('ABSPATH')) {
        exit();
    }

    # Inicia a sessão
    session_start();

    # Verifica o modo para debugar
    if (!defined('DEBUG') || DEBUG == false) {
        # Esconde todos os erros
        error_reporting(0);
        ini_set("display_errors", 0);
        //echo "<script>alert('Modo debug desativado!');</script>";
    } else {
        # Mostra todos os erros
        ini_set('display_errors', 1);
        ini_set('log_errors', 1);
        ini_set('error_log', dirname(__FILE__).'/logs/error_log.txt');
        error_reporting(E_ALL);
        //echo "<script>alert('Modo Bug ativado!');</script>";
    }

    # Funções globais
    require_once (ABSPATH . '/functions/global-functions.php');

    # Carrega a aplicação
    $systemControl = new SystemControl();
