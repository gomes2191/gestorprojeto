  <?php if ( ! defined('ABSPATH')) exit; ?>
	<?php if ( $this->login_required && ! $this->logged_in ) return; ?>

    <!-- Fixed navbar -->
    <nav class="navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><strong>BETA</strong></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo HOME_URI;?>">INÍCIO</a></li>
            <li><a href="<?php echo HOME_URI;?>/agenda/">AGENDA</a></li>
            <!--<li><a href="<?php echo HOME_URI;?>/exemplo/">Exemplo básico</a></li>-->

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" > ARQUIVOS <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo HOME_URI;?>/dentista/">Dentista</a></li>
                <li><a href="<?php echo HOME_URI;?>/noticias/">Pacientes</a></li>
                <li><a href="<?php echo HOME_URI;?>/noticias/adm/">Funcionarios</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">OUTROS DEPARTAMENTOS</li>
                <li><a href="#">Fornecedores</a></li>
                <li><a href="#">Patrimônio</a></li>
                <li><a href="#">Controle de Estoque</a></li>
                <li><a href="#">Laboratório</a></li>
                <li><a href="#">Convênios / Planos</a></li>
                <li><a href="#">Tabela de Honorários</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" >FINANCEIRO <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Contas a Pagar</a></li>
                <li><a href="#">Contas a Receber</a></li>
                <li><a href="#">Fluxo de caixa</a></li>
                <li><a href="#">Controles de Cheques</a></li>
                <li><a href="#">Pagamentos</a></li>
                <!--<li><a href="<?php echo HOME_URI;?>/noticias/">Notícias</a></li>
                <li><a href="<?php echo HOME_URI;?>/noticias/adm/">Notícias Admin</a></li>-->
              </ul>
            </li>
            <li><a href="<?php echo HOME_URI;?>">UTILITÁRIOS</a></li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo HOME_URI;?>/login/">Logar-se</a></li>
            <li><a class="<?php  ?>" href="<?php echo HOME_URI;?>/user-register/">Registrar usuario</a></li>
            <!--<li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container"> <!-- Inicio conteudo -->
