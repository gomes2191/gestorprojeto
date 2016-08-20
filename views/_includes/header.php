
<?php if ( ! defined('ABSPATH')) exit; ?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo HOME_URI;?>/favicon.ico">

    <title><?php echo NOME_SITE.$this->title; ?></title>

    <!-- My style -->
    <link rel="stylesheet" href="<?php echo HOME_URI;?>/views/_css/style.css">
    
    <!-- My icon fon -->
    <link rel="stylesheet" href="<?php echo HOME_URI;?>/views/font-awesome-4.6.3/css/font-awesome.min.css">
    
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo HOME_URI;?>/views/_css/bootstrap.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link rel="stylesheet" href="<?php echo HOME_URI;?>/views/_css/ie10-viewport-bug-workaround.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo HOME_URI;?>/views/_css/navbar-fixed-top.css">

    <!-- Agenda bibliotecas css -->
    <link rel="stylesheet" href="<?php echo HOME_URI;?>/_agenda/css/calendar.css">

    <link rel="stylesheet" href="<?php echo HOME_URI;?>/_agenda/css/bootstrap-datetimepicker.min.css">
    <!-- Final agenda css -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo HOME_URI;?>/views/_js/jquery.min.js"></script>    
    <script src="<?php echo HOME_URI;?>/views/_js/bootstrap.min.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo HOME_URI;?>/views/_js/ie-emulation-modes-warning.js"></script>
    <script src="<?php echo HOME_URI;?>/views/_js/jquery.maskedinput.js"></script>
    <script src="<?php echo HOME_URI;?>/views/_js/form-validator/jquery.form-validator.min.js"></script>
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>-->
   
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
        body{
            font-family: abel;
        }
    </style>
  </head>
  <body data-spy="scroll" data-target="spy-scroll-id">