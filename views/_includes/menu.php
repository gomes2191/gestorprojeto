<?php if (!defined('ABSPATH')) exit(); ?>
<?php if ($this->login_required && !$this->logged_in) return; ?>

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
            <a class="navbar-brand" href="<?= HOME_URI; ?>/"><img src="<?= HOME_URI; ?>/logo.png" style="margin-top: -5px;" width="100"><strong></strong></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?= HOME_URI; ?>" title="Página inicial"><i class="glyphicon glyphicon-home" aria-hidden="true"></i> HOME</a></li>
                <li><a href="<?= HOME_URI; ?>/agenda" title="Agenda"><i class="fa fa-calendar" aria-hidden="true"></i> AGENDA</a></li>
                <li class="menu-item dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"  ><i class="fa fa-university" aria-hidden="true"></i> EMPRESA<span class="caret"></span></a>
                    <ul class="dropdown-menu">
<!--                        <li class="menu-item dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Controle de pessoal</a>
                            <ul class="dropdown-menu">
                                <li class="menu-item "><a href="#">Cadastro de dentista</a></li>
                                <li class="menu-item "><a href="#">Cadastro de funcionario</a></li>
                                <li class="menu-item dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">More</a>
                                  <ul class="dropdown-menu"><li><a href="#">3rd level link more options</a></li><li><a href="#">3rd level link</a></li></ul>
                                </li>
                              </ul>
                        </li>-->
                        
                        <li><a href="<?= HOME_URI; ?>/providers">Fornecedores</a></li>
                        <li><a href="#">Patrimônio</a></li>
                        <li><a href="#">Controle de Estoque</a></li>
                        <li><a href="#">Laboratório</a></li>
                        <li><a href="#">Convênios / Planos</a></li>
                        <li><a href="#">Tabela de Honorários</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" ><i class="fa fa-calculator" aria-hidden="true"></i> FINANCEIRO<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Contas a Pagar</a></li>
                        <li><a href="#">Contas a Receber</a></li>
                        <li><a href="#">Fluxo de caixa</a></li>
                        <li><a href="#">Controles de Cheques</a></li>
                        <li><a href="#">Pagamentos</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" title="Controle de pessoal" ><i class="fa fa-users" aria-hidden="true"></i> CONTROLE DE PESSOAL<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= HOME_URI; ?>/users/register-dentist">Inserir Dentista</a></li>
                        <li><a href="<?= HOME_URI; ?>/users/register-employee">Inserir Funcionario</a></li>
                        <li><a href="<?= HOME_URI; ?>/users">Listar cadastros</a></li>
                    </ul>
                </li>
                <li><a href="<?= HOME_URI; ?>/agenda" title="Agenda"><i class="fa fa-user-md" aria-hidden="true"></i> PACIENTE</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                        <span>gomes.tisystem@gmail.com</span>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <span class="glyphicon glyphicon-user icon-size"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong>Francisco</strong></p>
                                        <p class="text-left small">gomes.tisystem@gmail.com</p>
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btn-block btn-sm">Atualizar dados</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="#" class="btn btn-danger btn-block">Finalizar seção</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            
        </div><!--/.nav-collapse -->
    </div>
</nav> <!-- Fixed navbar end -->
<div class="container-fluid"> <!-- Inicio conteudo -->
