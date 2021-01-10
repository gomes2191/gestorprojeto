{{--
Verifica se o diretório do arquivo foi definido.
Evita acesso direto ao arquivo. --}}
@if(!Config::ABS_PATH) {{ exit("Erro: diretório do projeto não definido.")}}
@endif

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="FAGA - TECNOLOGIA">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= Config::HOME_URI; ?>/public/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= Config::HOME_URI; ?>/public/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= Config::HOME_URI; ?>/public/favicon/favicon-16x16.png">
        <link rel="shortcut icon" href="<?= Config::HOME_URI; ?>/public/favicon/favicon.ico" type="image/x-icon">
        <link rel="manifest" href="<?= Config::HOME_URI; ?>/public/favicon/site.webmanifest">
        <link rel="mask-icon" href="<?= Config::HOME_URI; ?>/public/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <!-- Titulo do site -->
        <title>{{ Config::NOME_SITE }} @yield('title')</title>

        <!-- My style -->
        <link rel="stylesheet" href="<?= Config::HOME_URI; ?>/public/css/app.css">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?= Config::HOME_URI; ?>/public/lib/_css/bootstrap/bootstrap.min.css">

        <!-- Outro plugins -->
        <!--<link rel="stylesheet" href="<?= Config::HOME_URI; ?>/public/_css/jasny-bootstrap.min.css">-->

        <!-- Load icones... -->
        <link href="<?= Config::HOME_URI; ?>/public/lib/_fontaWesome/css/all.min.css" rel="stylesheet">

        <!-- Bootstrap core JavaScript
            ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?= Config::HOME_URI; ?>/public/lib/_js/jquery.min.js"></script>
        <script src="<?= Config::HOME_URI; ?>/public/lib/_js/popper/popper.min.js"></script>
        <!--Necessário para que funcione os dropdowns-->
        <!--<script src="<?= Config::HOME_URI; ?>/public/lib/_js/tether.min.js"></script>-->
        <script src="<?= Config::HOME_URI; ?>/public/lib/_js/bootstrap/bootstrap.min.js"></script>

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <script src="<?= Config::HOME_URI; ?>/public/lib/_js/jquery.mask.min.js"></script>
        <?php
        if (($pageType === 1) or ($title == ' Contas a receber')) {
            echo '<script>console.log("Bibliotecas inseridas")</script>';

            //--> Start JS
            echo '<script src="' . Config::HOME_URI . '/public/js/metodos.js"></script>';
            //echo '<script src="'.HOME_URI.'/public/lib/_js/moment.js"></script>';
            echo '<link rel="stylesheet" href="' . Config::HOME_URI . '/public/lib/_css/datetimepicker/jquery.datetimepicker.min.css">';
            echo '<script src="' . Config::HOME_URI . '/public/lib/_js/datetimepicker/jquery.datetimepicker.full.min.js"></script>';
            //echo '<script src="'.HOME_URI.'/public/js/scriptsTop.js"></script>';
            //--> End JS
        }
        if ($title == ' Agenda') {
            echo '<script>console.log("Bibliotecas inseridas")</script>';
            // Start agenda css -->
            echo '<link rel="stylesheet" href="' . Config::HOME_URI . '/_agenda/css/calendar.css">';
            // End agenda css -->

            //--> Start JS
            echo '<script src="' . Config::HOME_URI . '/public/lib/_js/moment.min.js"></script>';
            echo '<link rel="stylesheet" href="' . Config::HOME_URI . '/public/lib/_css/datetimepicker/jquery.datetimepicker.min.css">';
            echo '<script src="' . Config::HOME_URI . '/public/lib/_js/datetimepicker/jquery.datetimepicker.full.min.js"></script>';
            echo '<script src="' . Config::HOME_URI . '/public/js/scriptsTop.js"></script>';
            echo '<script src="' . Config::HOME_URI . '/_agenda/js/pt-BR.js"></script>';
            echo '<script src="' . Config::HOME_URI . '/_agenda/js/underscore-min.js"></script>';
            echo '<script src="' . Config::HOME_URI . '/_agenda/js/calendar.js"></script>';
            echo '<script src="' . Config::HOME_URI . '/_agenda/js/calendar-param.js"></script>';
            //--> End JS
        }
        ?>

    </head>
    <body data-spy="scroll" data-target="spy-scroll-id">

        @include('admin.layout.header')

        <main role="main" class="container-fluid"><!-- Start Main container principal -->



            {{ AutoLoad::showTimeZone() }}
            {{ AutoLoad::statusDebug() }}

            @yield('content')

        </main> <!-- End Main container principal -->

        @include('admin.layout.footer')

        <!-- ===== Javascript customizado ===== -->
        <script src="<?= Config::HOME_URI; ?>/public/js/scriptsFooter.js"></script>

        <?php
            if (isset($modelo->pag_type) && $modelo->pag_type == 'calendar') {
                //--> Start JS
                echo '<script src="' . Config::HOME_URI . '/_agenda/js/calendar-param.js"></script>';
                //--> End JS
            }
        ?>

    </body>
</html>