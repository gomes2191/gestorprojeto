<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Definimos nuestra zona horaria
date_default_timezone_set("America/Sao_Paulo");

// incluimos el archivo de funciones
require_once('_agenda/funciones.php');

// incluimos el archivo de configuracion
//require_once '_agenda/config.php';
// Verificamos si se ha enviado el campo con name from
if (isset($_POST['from'])) {

    // Si se ha enviado verificamos que no vengan vacios
    if ($_POST['from'] != "" AND $_POST['to'] != "") {

        // Recibimos el fecha de inicio y la fecha final desde el form
        $inicio = _formatear($_POST['from']);

        // y la formateamos con la funcion _formatear
        $final = _formatear($_POST['to']);

        // Recibimos el fecha de inicio y la fecha final desde el form
        $inicio_normal = $_POST['from'];

        // y la formateamos con la funcion _formatear
        $final_normal = $_POST['to'];

        // Outros recebem dados do formulário
        $titulo = evaluar($_POST['title']);

        // e avaliar a função
        $body = evaluar($_POST['event']);

        // Substituimos os caracteres ilegais
        $clase = evaluar($_POST['class']);

        // Inserimos o evento
        $query = "INSERT INTO agenda VALUES(null, '$titulo','$body','','$clase','$inicio','$final','$inicio_normal','$final_normal')";

        // Executamos nosa sequencia SQL
        $conexion->query($query);

        // Obtemos o ultimo id inserido
        $im = $conexion->query("SELECT MAX(id) AS id FROM agenda ");

        $row = $im->fetch_row();

        $id = trim($row[0]);

        // Gera o link de um evento
        $link = HOME_URI . " _agenda/descripcion_evento.php?id = $id ";

        // Aqui atualizamos nosso link
        $query = " UPDATE agenda SET url = '$link' WHERE id = $id ";

        // Executamos nossa sequencia sql
        $conexion->query($query);

        // Redirecionamos para nosso calendario
        header(" Location: HOME_URI ");
    }
}
?>