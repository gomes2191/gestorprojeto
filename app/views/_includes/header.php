<?php if (! defined('ABSPATH')) { exit(); } TIME_ZONE; ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="FAGA - TECNOLOGIA">
        <link rel="icon" type="image/png" href="<?= HOME_URI; ?>/favicon-32x32.png" sizes="32x32">
        
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
        
        <!--load everything-->
        <script defer src="<?= HOME_URI; ?>/public/lib/_fontsWesome/js/fontawesome-all.min.js"></script>
        
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