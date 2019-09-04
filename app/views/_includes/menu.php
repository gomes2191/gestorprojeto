    <?php if(($this->login_required && !$this->logged_in) && !defined ('ABSPATH') ) {   return;   } ?>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top top-mix navbar-icon-top"><!-- Fixed navbar -->
            <div class="container">
                <a class="navbar-brand" href="javascript:void(0)">
                    <img src="<?=HOME_URI;?>/logo.png" alt="Gestor Clínico" title="GC - Gestor Clínico">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item <?= (isSite('gclinic')) ? 'active' : FALSE ?>">
                            <a class="nav-link" href="<?= HOME_URI; ?>" title="Página inicial">
                                <i class="fal fa-home"></i> HOME
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item <?= (isSite('agenda')) ? 'active' : FALSE; ?>">
                            <a class="nav-link" href="<?= HOME_URI; ?>/agenda" title="Agenda">
                                <i class='fal fa-calendar-alt'></i> AGENDA
                            </a>
                        </li>
                        <li class="nav-item dropdown <?= (isSite('covenant', 'fees', 'providers', 'patrimony', 'stock', 'laboratory')) ? 'active' : FALSE; ?>">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class='fal fa-building '></i> EMPRESA
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item <?= (isSite('providers')) ? 'active' : FALSE; ?>" href="<?= HOME_URI; ?>/providers">Fornecedores</a>
                                <a class="dropdown-item <?= (isSite('patrimony')) ? 'active' : FALSE; ?>" href="<?= HOME_URI; ?>/patrimony">Patrimônio</a>
                                <a class="dropdown-item <?= (isSite('stock')) ? 'active' : FALSE; ?>" href="<?= HOME_URI; ?>/stock">Controle de Estoque</a>
                                <a class="dropdown-item <?= (isSite('laboratory')) ? 'active' : FALSE; ?>" href="<?= HOME_URI; ?>/laboratory">Laboratório</a>
                                <a class="dropdown-item <?= (isSite('covenant', 'fees')) ? 'active' : FALSE; ?>" href="<?= HOME_URI; ?>/covenant">Convênios / Planos</a>
                                <a class="dropdown-item" href="#">Tabela de Honorários</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown <?= (isSite('pay', 'receive', '', '', '', '')) ? 'active' : FALSE; ?>">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class='fal fa-chart-bar'></i> FINANÇAS
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item <?= (isSite('pay')) ? 'active' : FALSE; ?>" href="<?= HOME_URI; ?>/pay">Contas a Pagar</a>
                                <a class="dropdown-item <?= (isSite('receive')) ? 'active' : FALSE; ?>" href="<?= HOME_URI; ?>/receive">Contas a Receber</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/finances-flow">Fluxo de caixa</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/finances-checks">Controle de Cheques</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/finances-payments">Pagamentos</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fal fa-users"></i> USUÁRIOS
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/users/register-dentist">Inserir Dentista</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/users/register-employee">Inserir Funcionario</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/users">Listar cadastros</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= HOME_URI; ?>/patient-control" title="Gerenciar pacientes no sistema">
                                <i class="fal fa-handshake"></i> CLIENTES
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> <!--End navbar-->
        <main role="main" class="container"><!-- Start Main container principal -->
