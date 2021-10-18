<?php if (!defined('\Config::HOME_URI')) { die('Acesso não permitido.'); } ?>
    <nav class="navbar navbar-dark bg-gclinic navbar-expand-lg fixed-top navbar-icon-top">
        <!-- Fixed navbar -->
        <div class="container-fluid">
            <div class="d-flex w-50 order-0">
                <a class="navbar-brand mr-1" href="javascript:void(0)">
                    GESTOR DE PROJETOS
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse justify-content-center order-2" id="collapsingNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item @if(GFunc::isSite('projects')) 'active' @endif">
                        <a class="nav-link" href="{{ constant('Config::HOME_URI') }}/projects" title="Página inicial">
                            <i class="fas fa-project-diagram"></i> Projetos
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (GFunc::isSite('activities')) ? 'active' : false; ?>">
                        <a class="nav-link" href="{{ constant('Config::HOME_URI') }}/activities" title="Atividades">
                            <i class='fas fa-list'></i> Atividades
                        </a>
                    </li>
                </ul>
            </div>
            <div class="navbar-text small text-truncate mt-1 w-50 text-right order-1 order-md-last"></div>
        </div>
    </nav><!--End navbar-->