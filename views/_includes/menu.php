
	<?php if ( ! defined('ABSPATH')) exit; ?>

	<?php if ( $this->login_required && ! $this->logged_in ) return; ?>


    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">ODONTO - VISION</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo HOME_URI;?>">Home</a></li>
            <li><a href="<?php echo HOME_URI;?>/agenda/">Agenda</a></li>
            <li><a href="<?php echo HOME_URI;?>/exemplo/">Exemplo básico</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="<?php echo HOME_URI;?>/noticias/">Notícias</a></li>
                <li><a href="<?php echo HOME_URI;?>/noticias/adm/">Notícias Admin</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo HOME_URI;?>/login/">Logar-se</a></li>
            <li><a href="<?php echo HOME_URI;?>/user-register/">User Register</a></li>
            <li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container"> <!-- Inicio conteudo -->