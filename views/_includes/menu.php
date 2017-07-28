        <?php if (!defined('ABSPATH')) exit(); ?>
        <?php if ($this->login_required && !$this->logged_in) return; ?>

        <nav class="navbar navbar-toggleable-sm fixed-top navbar-light bg-faded">
            <div class="container">
                <a class="navbar-brand" href="#">Beta Teste</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    
                    <ul class="navbar-nav mr-auto mt-2 mt-md-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= HOME_URI; ?>" title="Página inicial">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= HOME_URI; ?>/agenda" title="Agenda">Agenda</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Empresa
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/providers">Fornecedores</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/patrimony">Patrimônio</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/stock">Controle de Estoque</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/laboratory">Laboratório</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/covenant">Convênios / Planos</a>
                                <a class="dropdown-item" href="#">Tabela de Honorários</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Financeiro
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/finances-pay">Contas a Pagar</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/finances-receive">Contas a Receber</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/finances-flow">Fluxo de caixa</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/finances-checks">Controle de Cheques</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/finances-payments">Pagamentos</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Controle de Pessoal
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/users/register-dentist">Inserir Dentista</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/users/register-employee">Inserir Funcionario</a>
                                <a class="dropdown-item" href="<?= HOME_URI; ?>/users">Listar cadastros</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= HOME_URI; ?>/patient-control" title="Gerenciar pacientes no sistema">Controle de Pacientes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> <!--End navbar fixed-->
        <div class="container">  <!--Aqui é o inicio do corpo principal todo conteúdo vai aqui -->
