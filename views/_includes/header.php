<?php if (! defined('ABSPATH')) { exit(); } TIME_ZONE; ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="FAGA - Tecnologia">
        <link rel="icon" type="image/png" href="<?= HOME_URI; ?>/favicon-32x32.png" sizes="32x32">

        <!-- Titulo do site -->
        <title><?= NOME_SITE . $this->title; ?></title>

        <!-- My style -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/views/_css/style.css">

        <!-- My icon fon -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/views/font-awesome/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/views/_css/bootstrap.min.css">
        
        <!-- Outro plugins -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/views/_css/jasny-bootstrap.min.css">
        
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/views/_css/ie10-viewport-bug-workaround.css">

        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/views/_css/navbar-top-fixed.css">
        
         <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?= HOME_URI; ?>/views/_js/jquery.min.js"></script>
        <script src="<?= HOME_URI; ?>/views/_js/tether.min.js"></script>
        <script src="<?= HOME_URI; ?>/views/_js/bootstrap.min.js"></script>
        
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="<?= HOME_URI; ?>/views/_js/ie-emulation-modes-warning.js"></script>
        <script src="<?= HOME_URI; ?>/views/_js/jasny-bootstrap.min.js"></script>
        <script src="<?= HOME_URI; ?>/views/_js/form-validator/jquery.form-validator.min.js"></script>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <?php
        
        if (($this->title == ' Agenda') OR ($this->title == ' Contas a pagar') OR ($this->title == ' Contas a receber') OR 
            ($this->title == ' Controle de cheques')) {
            echo '<script>console.log("Bibliotecas inseridas")</script>';
            
            #--> Start JS
            echo '<script src="'.HOME_URI.'/views/_js/moment.js"></script>';
            echo '<link rel="stylesheet" href="' . HOME_URI . '/views/_css/datetimepicker/jquery.datetimepicker.min.css">';
            echo '<script src="'.HOME_URI.'/views/_js/datetimepicker/jquery.datetimepicker.full.min.js"></script>';
            echo '<script src="'.HOME_URI.'/views/_js/scriptsTop.js"></script>';
            #--> End JS
        }else{
            # Outros plugins
            //echo '<script src="'.HOME_URI.'/views/_js/moment.js"></script>';

            //echo '<link rel="stylesheet" href="'.HOME_URI. '/views/_css/sweetalert.css">';
            //echo '<script src="'.HOME_URI.'/views/_js/sweetalert.min.js"></script>';
            # End outros plugins

            //echo '<script src="'.HOME_URI.'/views/_js/angular.min.js"></script>';
            //echo '<script src="'.HOME_URI.'/views/_js/angular-locale_pt-br.js"></script>';
            //echo '<script src="'.HOME_URI.'/views/_js/jquery.maskMoney.min.js"></script>';
            echo '<script src="'.HOME_URI.'/views/_js/metodos.js"></script>';
        }if($this->title == ' Agenda'){
            # Start agenda css -->
            echo '<link rel="stylesheet" href="' . HOME_URI . '/_agenda/css/calendar.min.css">';
            # End agenda css -->

            #--> Start JS
            echo '<script src="'.HOME_URI.'/_agenda/js/pt-BR.js"></script>';
            //echo '<script src="'.HOME_URI.'/views/_js/moment.js"></script>';
            //echo '<script src="'.HOME_URI.'/views/_js/scriptsTop.js"></script>';
            #--> End JS
        }
            
        ?>
    </head>
    <body data-spy="scroll" data-target="spy-scroll-id">