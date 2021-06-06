<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="FAGA - TECNOLOGIA">
		<link rel="apple-touch-icon" sizes="180x180" href="{{ Config::HOME_URI }}/public/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ Config::HOME_URI }}/public/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ Config::HOME_URI }}/public/favicon/favicon-16x16.png">
		<link rel="shortcut icon" href="{{ Config::HOME_URI }}/public/favicon/favicon.ico" type="image/x-icon">
		<link rel="manifest" href="{{ Config::HOME_URI }}/public/favicon/site.webmanifest">
		<link
		rel="mask-icon" href="{{ Config::HOME_URI }}/public/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<!-- Titulo do site -->
		<title>
            {{ Config::NOME_SITE }} @yield('title')
		</title>
		<!-- My style -->
		<link rel="stylesheet" href="{{ Config::HOME_URI }}/public/css/app.css">

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="{{ Config::HOME_URI }}/public/lib/_css/bootstrap/bootstrap.min.css">

		<!-- Outro plugins -->
		<!--<link rel="stylesheet" href="<?= Config::HOME_URI; ?>/public/_css/jasny-bootstrap.min.css">-->

		<!-- Load icones... -->
		<link href="{{ Config::HOME_URI }}/public/lib/_icons/css/all.min.css" rel="stylesheet"> <!-- Bootstrap core JavaScript
			            ================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="{{ Config::HOME_URI }}/public/lib/_js/jquery.min.js"> </script>
		<!-- <script src="<?= Config::HOME_URI; ?>/public/lib/_js/bootstrap/bootstrap.bundle.min.js"></script>
		<script src="<?= Config::HOME_URI; ?>/public/lib/_js/popper/popper.min.js"></script> -->
		<script src="{{ Config::HOME_URI }}/public/lib/_js/bootstrap/bootstrap.bundle.min.js"></script>
		<!--Necessário para que funcione os dropdowns-->
		<!--<script src="<?= Config::HOME_URI; ?>/public/lib/_js/tether.min.js"></script>
		<script src="<?= Config::HOME_URI; ?>/public/lib/_js/bootstrap/bootstrap.min.js"></script> -->

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<script src="{{ Config::HOME_URI }}/public/lib/_js/jquery.mask.min.js"> </script>

		@if ($pageType == 1 or $title == ' Contas a receber')
			<script>
				console.log("Bibliotecas inseridas")
			</script>
			<!-- Start JS -->
			<script src="{{ Config::HOME_URI }}/public/js/metodos.js"></script>
			<!--<script src="'.HOME_URI.'/public/lib/_js/moment.js"></script>-->
			<link rel="stylesheet" href="{{ Config::HOME_URI }}/public/lib/_css/datetimepicker/jquery.datetimepicker.min.css">
			<script src="{{ Config::HOME_URI }}/public/lib/_js/datetimepicker/jquery.datetimepicker.full.min.js"></script>
			<!--<script src="{{ Config::HOME_URI }}/public/js/scriptsTop.js"></script>-->
			<!-- End JS -->

		@elseif ($title == ' Agenda')
			<script>
				console.log("Bibliotecas inseridas")
			</script>
			<!-- Start agenda css -->
			<link rel="stylesheet" href="{{ Config::HOME_URI }}/_agenda/css/calendar.css">
			<!-- End agenda css -->

			<!-- Start JS --><script src="{{ Config::HOME_URI }}/public/lib/_js/moment.min.js"> </script>
			<link rel="stylesheet" href="{{ Config::HOME_URI }}/public/lib/_css/datetimepicker/jquery.datetimepicker.min.css">
			<script src="{{ Config::HOME_URI }}/public/lib/_js/datetimepicker/jquery.datetimepicker.full.min.js"></script>
			<script src="{{ Config::HOME_URI }}/public/js/scriptsTop.js"></script>
			<script src="{{ Config::HOME_URI }}/_agenda/js/pt-BR.js"></script>
			<script src="{{ Config::HOME_URI }}/_agenda/js/underscore-min.js"></script>
			<script src="{{ Config::HOME_URI }}/_agenda/js/calendar.js"></script>
			<script src="{{ Config::HOME_URI }}/_agenda/js/calendar-param.js"></script>
			<!-- End JS -->
		@endif
	</head>
	<body data-spy="scroll" data-target="spy-scroll-id">

		{{-- Include header --}}
		@include('admin.layouts.header')

		<!-- Start Main container principal -->
		<main id="principal" role="main" class="container-fluid">
			{{ AutoLoad::statusDebug() }}
			{{ AutoLoad::showTimeZone() }}

			{{-- Conteúdo principal --}}
			@yield('content')
		</main><!-- End Main container principal -->

		 @include('admin.layouts.footer')

		<!-- <script src="<?= Config::HOME_URI; ?>/public/lib/_js/bootstrap/bootstrap.bundle.min.js"></script> -->

		<!-- ===== Javascript customizado ===== --><script src="{{ Config::HOME_URI }}/public/js/scriptsFooter.js"> </script>
		@if ( !$pageType and $pageType == 'calendar')
			<!-- Start JS -->
			<script src="{{ Config::HOME_URI }}/_agenda/js/calendar-param.js"></script>
			<!-- End JS -->
		@endif
	</body>
</html>
