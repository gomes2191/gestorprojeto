<?php

// Inicia a sessão
session_start();

// Evita que usuários acesse este arquivo diretamente.
if (!Config::ABS_PATH) {
    (Config::SHOW_ERRORS) ? var_dump('Não foi definido o diretório do sistema.') : die('Erro fatal...');
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
class Loader
{
    static function ligaDebug($showErros =  Config::SHOW_ERRORS)
    {
        // Verifica o modo para debugar
        if (!$showErros || $showErros == false) {
            // Esconde todos os erros
            error_reporting(0);
            ini_set('display_errors', 0);
            echo "<script>alert('Modo debug desativado!');</script>";
        } else {

            // Mostra todos os erros
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            ini_set('log_errors', 1);
            ini_set('error_reporting', -1);
            ini_set('html_errors', 1);

            // print_r(dirname(__DIR__));die;
            ini_set('error_log', dirname(__DIR__) . '/logs/error_log.txt');

            echo "<h6><span class='badge badge-pill badge-primary'>MOSTRAR ERROS: ATIVO</span></h6>";

            //echo "<script>alert('Modo Debug ativado!');</script>";
        }
    }

    static function loadTimeZone()
    {
        if (Config::TIME_ZONE['set']) {

            // retorna o TIME_ZONE especificado na constante...
            return date_default_timezone_set(Config::TIME_ZONE['set']);
        } else {

            // retorna o TIME_ZONE padrão UTC ...
            return date_default_timezone_set(DateTimeZone::listIdentifiers(DateTimeZone::UTC)[0]);
        }
    }

    static function showTimeZone()
    {
        if (Config::TIME_ZONE['show']) {
            echo "<h6><span class='badge badge-pill badge-primary'>FUSO HORÁRIO: " . date_default_timezone_get() . "</span></h6>";
        }
    }
}

// Carrega o método mostrar erros.
Loader::ligaDebug();

// Carrega o metódo que seta o Time_Zone.
Loader::loadTimeZone();

// Carrega o Time_Zone atual caso esteja setado no Config.
Loader::showTimeZone();

// Funções globais
// print_r(dirname(__DIR__));die('<br>'.'Loader.php');
include_once dirname(__DIR__) . '/Core/GlobalFunctions.php';

// Carrega toda aplicação.
$loadApplication = new SystemCore();
