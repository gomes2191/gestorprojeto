    <?php if (!defined('ABSPATH')) exit(); ?>
    <?php if ($this->login_required && !$this->logged_in) return; ?>

        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Beta -teste</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= HOME_URI; ?>" title="Página inicial"><i class="glyphicon glyphicon-home" aria-hidden="true"></i> Home</a></li>
                        <li><a href="<?= HOME_URI; ?>/agenda" title="Agenda"><i class="fa fa-calendar" aria-hidden="true"></i> Agenda</a></li>
                        <li class="menu-item dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"  ><i class="fa fa-university" aria-hidden="true"></i> Empresa<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= HOME_URI; ?>/providers">Fornecedores</a></li>
                                <li><a href="<?= HOME_URI; ?>/patrimony">Patrimônio</a></li>
                                <li><a href="<?= HOME_URI; ?>/stock">Controle de Estoque</a></li>
                                <li><a href="<?= HOME_URI; ?>/laboratory">Laboratório</a></li>
                                <li><a href="<?= HOME_URI; ?>/covenant">Convênios / Planos</a></li>
                                <li><a href="#">Tabela de Honorários</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" ><i class="fa fa-calculator" aria-hidden="true"></i> Financeiro<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= HOME_URI; ?>/finances-pay">Contas a Pagar</a></li>
                                <li><a href="<?= HOME_URI; ?>/finances-receive">Contas a Receber</a></li>
                                <li><a href="<?= HOME_URI; ?>/finances-flow">Fluxo de caixa</a></li>
                                <li><a href="<?= HOME_URI; ?>/finances-checks">Controle de Cheques</a></li>
                                <li><a href="<?= HOME_URI; ?>/finances-payments">Pagamentos</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" title="Controle de pessoal" ><i class="fa fa-users" aria-hidden="true"></i> Controle de Pessoal<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= HOME_URI; ?>/users/register-dentist">Inserir Dentista</a></li>
                                <li><a href="<?= HOME_URI; ?>/users/register-employee">Inserir Funcionario</a></li>
                                <li><a href="<?= HOME_URI; ?>/users">Listar cadastros</a></li>
                            </ul>
                        </li>
                        <li><a href="<?= HOME_URI; ?>/patients" title="Pacientes"><i class="fa fa-user-md" aria-hidden="true"></i> Pacientes</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav> <!--  /End Fixed NavBar -->
        <div class="container"> <!-- Aqui é o inicio do corpo principal todo conteúdo vai aqui -->
