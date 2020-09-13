<?php

// Evita que usuários acesse este arquivo diretamente.
if (!defined('ABSPATH')) {
    exit('Não foi definido o diretório do sistem.');
}

// Inicia a sessão
session_start();

// Verifica o modo para debugar
if (!defined('DEBUG') || DEBUG == false) {
    // Esconde todos os erros
    error_reporting(0);
    ini_set("display_errors", 0);
    echo "<script>alert('Modo debug desativado!');</script>";
} else {

    // Mostra todos os erros
    ini_set('display_errors', 1);

    ini_set('log_errors', 1);

    // print_r(dirname(__DIR__));die;

    ini_set('error_log', dirname(__DIR__) . '/logs/error_log.txt');

    error_reporting(E_ALL);
    echo "<script>alert('Modo Debug ativado!');</script>";
}

// Funções globais
//print_r(dirname(__DIR__));die('<br>'.'Loader.php');
require_once dirname(__DIR__) . '/Core/GlobalFunctions.php';

// Carrega toda aplicação.
$loadApplication = new SystemCore();
