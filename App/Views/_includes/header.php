<?php
    /**
    * Verifica se o diretório do arquivo foi definido.
    * Evita acesso direto ao arquivo.*/
    if (! defined('ABSPATH')) { 
        exit(); 
    } 
    
    TIME_ZONE; 
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="FAGA - TECNOLOGIA">        
        <link rel="apple-touch-icon" sizes="180x180" href="<?=HOME_URI;?>/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?=HOME_URI;?>/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?=HOME_URI;?>/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?=HOME_URI;?>/favicon/site.webmanifest">
        <link rel="mask-icon" href="<?=HOME_URI;?>/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <!-- Titulo do site -->
        <title><?= NOME_SITE . $this->title; ?></title>

        <!-- My style -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/public/css/style.css">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/public/lib/_css/bootstrap/bootstrap.min.css">
        
        <!-- Outro plugins -->
        <!--<link rel="stylesheet" href="<?= HOME_URI; ?>/public/_css/jasny-bootstrap.min.css">-->              

        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/public/css/navbar-top-fixed.css">
        
        <!-- Load icones... -->
        <link href="<?= HOME_URI; ?>/public/lib/_fontaWesome/css/all.min.css" rel="stylesheet">
        
         <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?= HOME_URI; ?>/public/lib/_js/jquery.min.js"></script>
        <script src="<?= HOME_URI; ?>/public/lib/_js/popper.min.js"></script><!--Necessário para que funcione os dropdowns-->
        <!--<script src="<?= HOME_URI; ?>/public/lib/_js/tether.min.js"></script>-->
        <script src="<?= HOME_URI; ?>/public/lib/_js/bootstrap/bootstrap.min.js"></script>
        
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <script src="<?= HOME_URI; ?>/public/lib/_js/jquery.mask.min.js"></script>
        <?php
            if (($this->page_type === 1) OR ($this->title == ' Contas a receber') ) {
                echo '<script>console.log("Bibliotecas inseridas")</script>';
                
                #--> Start JS
                echo '<script src="'.HOME_URI.'/public/js/metodos.js"></script>';
                //echo '<script src="'.HOME_URI.'/public/lib/_js/moment.js"></script>';
                echo '<link rel="stylesheet" href="' . HOME_URI . '/public/lib/_css/datetimepicker/jquery.datetimepicker.min.css">';
                echo '<script src="'.HOME_URI.'/public/lib/_js/datetimepicker/jquery.datetimepicker.full.min.js"></script>';
                //echo '<script src="'.HOME_URI.'/public/js/scriptsTop.js"></script>';
                #--> End JS
            }if($this->title == ' Agenda'){
                echo '<script>console.log("Bibliotecas inseridas")</script>';
                # Start agenda css -->
                echo '<link rel="stylesheet" href="' . HOME_URI . '/_agenda/css/calendar.css">';
                # End agenda css -->

                #--> Start JS
                echo '<script src="'.HOME_URI.'/public/lib/_js/moment.js"></script>';
                echo '<link rel="stylesheet" href="' . HOME_URI . '/public/lib/_css/datetimepicker/jquery.datetimepicker.min.css">';
                echo '<script src="'.HOME_URI.'/public/lib/_js/datetimepicker/jquery.datetimepicker.full.min.js"></script>';
                echo '<script src="'.HOME_URI.'/public/js/scriptsTop.js"></script>';
                echo '<script src="'.HOME_URI.'/_agenda/js/pt-BR.js"></script>';
                echo '<script src="'.HOME_URI.'/_agenda/js/underscore-min.js"></script>';
                echo '<script src="'.HOME_URI.'/_agenda/js/calendar.js"></script>';
                echo '<script src="'.HOME_URI.'/_agenda/js/calendar-param.js"></script>';
                #--> End JS
            }
        ?>

    </head>
    <body data-spy="scroll" data-target="spy-scroll-id">