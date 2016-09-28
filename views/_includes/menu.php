<?php if ( ! defined('ABSPATH')) exit; ?>
<?php if ( $this->login_required && ! $this->logged_in ) return; ?>

    <!-- Fixed navbar -->
    <nav class="navbar-default navbar-findcond navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="<?= HOME_URI; ?>/"><img src="<?= HOME_URI; ?>/logo.png" style="margin-top: -5px;" width="100"><strong></strong></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?= HOME_URI; ?>/" title="Página inicial"><i class="glyphicon glyphicon-home" aria-hidden="true"></i> HOME</a></li>
            <li><a href="<?= HOME_URI; ?>/agenda" title="Agenda"><i class="fa fa-calendar" aria-hidden="true"></i> AGENDA</a></li>
            <!--<li><a href="<?= HOME_URI; ?>/exemplo/">Exemplo básico</a></li>-->

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" >
                  <i class="fa fa-university" aria-hidden="true"></i>
                  EMPRESA<span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?= HOME_URI; ?>/users/">Controle de pessoal</a></li>
                <li><a href="<?= HOME_URI; ?>/noticias/">Pacientes</a></li>
                <li><a href="<?= HOME_URI; ?>/noticias/adm/">Funcionarios</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">OUTROS DEPARTAMENTOS</li>
                <li><a href="<?= HOME_URI; ?>/fornecedores">Fornecedores</a></li>
                <li><a href="#">Patrimônio</a></li>
                <li><a href="#">Controle de Estoque</a></li>
                <li><a href="#">Laboratório</a></li>
                <li><a href="#">Convênios / Planos</a></li>
                <li><a href="#">Tabela de Honorários</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" ><i class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></i> FINANCEIRO<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Contas a Pagar</a></li>
                <li><a href="#">Contas a Receber</a></li>
                <li><a href="#">Fluxo de caixa</a></li>
                <li><a href="#">Controles de Cheques</a></li>
                <li><a href="#">Pagamentos</a></li>
                <!--<li><a href="<?= HOME_URI; ?>/noticias/">Notícias</a></li>
                <li><a href="<?= HOME_URI; ?>/noticias/adm/">Notícias Admin</a></li>-->
              </ul>
            </li>
            
            <li><a href="<?= HOME_URI; ?>/user-register/" title="Cadastro de pessoal"><i class="fa fa-user-plus" aria-hidden="true"></i> CADASTRO DE PESSOAL</a></li>
            <!--<li><a href="<?= HOME_URI; ?>">UTILITÁRIO</a></li>-->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?= HOME_URI; ?>/login/"><i class="glyphicon glyphicon-log-in" aria-hidden="true"></i> LOGAR-SE</a></li>
            
            <!--<li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> <!-- Fixed navbar end -->

    <div class="container-fluid"> <!-- Inicio conteudo -->
