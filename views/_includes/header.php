<?php
    if (!defined('ABSPATH')){
        exit();
    } 
   
?>

<!DOCTYPE html>
<html lang="pt-br" >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="FAGA - Tecnologia">
        <link rel="icon" type="image/png" href="<?= HOME_URI; ?>/favicon-32x32.png" sizes="32x32">

        <!-- Titulo do site -->
        <title><?= NOME_SITE . $this->title; ?></title>

        <!-- My style -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/views/_css/style.css">

        <!-- My icon fon -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/views/font-awesome-4.6.3/css/font-awesome.min.css">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/views/_css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= HOME_URI; ?>/views/_css/jasny-bootstrap.min.css">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/views/_css/ie10-viewport-bug-workaround.css">

        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="<?= HOME_URI; ?>/views/_css/navbar-fixed-top.css">

        <!-- Agenda bibliotecas css -->
        <?php
            if($this->title == ' Agenda'){

                echo '<link rel="stylesheet" href="'.HOME_URI. '/_agenda/css/calendar.css">';
                
                echo '<link rel="stylesheet" href="' . HOME_URI . '/_agenda/css/bootstrap-datetimepicker.min.css">';
                
                

            }
        ?>
        <!-- Final agenda css -->
        
       
        
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?= HOME_URI; ?>/views/_js/jquery.min.js"></script>
        <script src="<?= HOME_URI; ?>/views/_js/bootstrap.min.js"></script>
        
        
        
        <!-- Biblioteca de futuro upgrade de agenda -->
        <!--<script src="/_agenda/js/moment.min.js" type="text/javascript"></script>
        <script src="/_agenda/js/interact.min.js" type="text/javascript"></script>
        <script src="/_agenda/js/angular.js" type="text/javascript"></script>
        <script src="/_agenda/js/angular-animate.js" type="text/javascript"></script>
        
        <script src="/_agenda/js/ui-bootstrap-tpls.min.js" type="text/javascript"></script>
        <script src="/_agenda/js/rrule.js" type="text/javascript"></script>
        <script src="/_agenda/js/bootstrap-colorpicker-module.min.js" type="text/javascript"></script>
        
        <script src="/_agenda/js/angular-bootstrap-calendar-tpls.min.js" type="text/javascript"></script>
        <script src="/_agenda/js/exemplo.js" type="text/javascript"></script>
        <script src="/_agenda/js/helper.js" type="text/javascript"></script>
        
        <link href="/_agenda/css/colorpicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="/_agenda/css/angular-bootstrap-calendar.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- / Biblioteca de futuro upgrade de agenda -->
        
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
    </head>
    <body data-spy="scroll" data-target="spy-scroll-id">
