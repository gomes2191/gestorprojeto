@extends('admin.layouts.app')

@section('title',' Projetos')

@section('content')
    <!--Start row loading  -->
    <div class="row">
        <div class="col-md-1  col-sm-0 col-xs-0"></div>
        <!--div ocupa espaço left-->
        <div class="col-md-10  col-sm-12 col-xs-12">
            <div id="loading" style="display: none;">
                <!--Loading.. este aqui-->
                <ul class="bokeh">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <!--End loandind-->
        </div> <!-- div central -->
        <div class="col-md-1  col-sm-0 col-xs-0"></div> <!-- div espaço right -->
    </div><!-- End row loading -->

    <div class="row g-3">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <form id="regForm" enctype="multipart/form-data" class="form-register" data-id="" method="post" action="" role="form">
                <fieldset>
                    <legend>PROJETOS <span class="badge bg-light text-dark text-wrap fst-italic"></span></legend>

                    <div class="row form-hidden" style="display: none">
                        <!-- Start div hidden 1 -->
                        <div class="col-md col-sm mb-2"><small class="text-muted">INFORMAÇÕES DO PROJETO</small></div>
                    </div>

                    <div class="row mb-3 form-hidden" style="display: none">
                        <!-- Start div hidden 1 -->
                        <div class="form-group col-md col-sm">
                            <label for="name">Projeto:</label>
                            <input type="hidden" id="id" name="id" value="">
                            <input id="name" name="name" type="text" class="form-control form-control-sm" placeholder="Projeto nome..." value="">
                            <div class="invalid-feedback">
                                Preencha esse campo.
                            </div>
                        </div>

                        <div class="form-group col-md col-sm">
                            <label for="start_date ">Data início:</label>
                            <input id="start_date" name="acquisition_date"
                                class="form-control form-control-sm date text-center" type="text" placeholder="dd/mm/aaaa" value="">
                            <div class="invalid-feedback">
                                Preencha esse campo.
                            </div>
                        </div>

                        <div class="form-group col-md col-sm">
                            <label for="end_date">Data fim:</label>
                            <input id="end_date" name="end_date"
                                class="form-control form-control-sm date text-center" type="text" placeholder="dd/mm/aaaa" value="">
                            <div class="invalid-feedback">
                                Preencha esse campo.
                            </div>
                        </div>

                        <div class="form-group col-md col-sm">
                            <label for="status">Atrasado:</label><br>
                            <select id="status" name="status" class="form-select form-select-sm">
                                <option selected value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>



                        <div class="form-group col-md col-sm">
                            <label for="progress">Progresso:</label>
                            <div class="input-group">
                                <input id="progress" name="progress" type="text" min="1" max="100" step="1"
                                    class="form-control form-control-sm number text-center" placeholder="10">
                                    <span class="input-group-text">%</span>
                            </div>

                        </div>

                    </div><!-- /End div hidden 1 -->

                    <div class="form-row mb-3 row-button-hidden" style="display: none;">
                        <!-- Start div button hidden 1 -->
                        <div class="form-group col-md col-sm">
                            <div id="group-btn-save" class="btn-group">
                                <button id="btn-save" title="Salvar informações" class="btn btn-primary btn-sm" type="button"></button>
                            </div>
                            <div id="group-btn-reset" class="btn-group">
                                <button title="Limpar formulário" class="btn btn-warning btn-sm" type="reset">
                                    <i class="fas fa-eraser fa-lg"></i> <span>LIMPAR</span>
                                </button>
                            </div>
                            <div id="group-btn-form-new" class="btn-group" style="display:none;">
                                <button id="btn-form-new" title="Volta para o modo adicionar novo registro" class="btn btn-primary btn-sm" type="reset">
                                    <i class="fas fa-plus fa-lg"></i> <span>MODO NOVO REGISTRO</span>
                                </button>
                            </div>
                        </div>
                    </div><!-- End div button hidden 1 -->

                    <div class="form-row mb-3">
                        <div class="form-group col-md col-sm">
                            <div id="group-btn-new" class="btn-group">
                                <button id="btn-new-show" title="Insere novo registro" class="btn btn-primary btn-sm" type="reset" >
                                    <i class="fas fa-plus"></i>&nbsp;<span>ADICIONAR REGISTRO</span>
                                </button>
                            </div>
                            <div id="group-btn-show" style="display: none;" class="btn-group">
                                <button id="btn-show" title="Mostrar o formulário" class="btn btn-success btn-sm" type="reset">
                                    <i class="fas fa-eye fa-lg"></i> ABRE FORMULÁRIO
                                </button>
                            </div>
                            <div id="group-btn-hidden" style="display: none;" class="btn-group">
                                <button id="btn-hidden" title="Esconde o formulário" class="btn top btn-success btn-sm" type="reset">
                                    <i class="fas fa-eye-slash fa-lg"></i> FECHA FORMULÁRIO
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--End row button -->
                </fieldset>
            </form>
        </div>
    </div><!-- End row button new form -->

    <div id="filtros" class="row">
        <div class="form-group mb-3 col-md-4 col-sm-10">
            <div class="input-group">
                <input type="text" class="form-control inputSearch" id="keywords" placeholder="Buscar por: Nome ou Área de atuação..." onkeyup="objFinanca.ajaxFilter();">
                <span class="input-group-text btn-primary">
                    <i class="fab fa-searchengin fa-lg"></i>
                </span>
            </div><!-- /End search engine-->
        </div><!-- /End col search engine -->

        <div class="col-md-5 col-sm-0"></div>
        <!--End/-->

        <div class="form-group mb-3 col-md-1 col-sm-">
            <div class="input-group">
                <input type="text" class="text-center form-control" id="qtdLine" placeholder="5" onkeyup="objFinanca.ajaxFilter();" data-bs-toggle="tooltip" data-bs-placement="top" title="Quantidade de registro por página de 1 até 50.">
            </div>
        </div>
        <!--/End col-->

        <div class="form-group mb-3 col-md-2  col-sm-3">
            <select id="sortBy" class="form-select" onchange="objFinanca.ajaxFilter();">
                <option value="">Ordenar Por</option>
                <option value="asc">Ascendente</option>
                <option value="desc">Descendente</option>
                <option value="active">Ativo</option>
                <option value="inactive">Inativo</option>
            </select>
        </div>
        <!--/End col-->
    </div><!-- End row filtros -->

    <div class="row">
        <div class="col-md-12  col-sm-12">
            <div id="tableData" class="table-responsive" style="border: none;">

            </div>
        </div>
    </div><!-- End row table -->

    <!-- Start Modal Informações -->
    <div id="inforView" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable">
            <!-- Modal content-->
            <div class="modal-content">
                <!--Conteudo do modal-->
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-info-circle text-primary" aria-hidden="true"></i> INFORMAÇÕES</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Empresa:</b>&nbsp;<span class="name"></span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>CPF / CNPJ:</b>&nbsp;<span class="cpf_cnpj">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Razão social:</b>&nbsp;<span class="razao_social">----</span> </li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Área de atuação:</b>&nbsp;<span class="occupation_area"></span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Endereço:</b>&nbsp;<span class="provider_end">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Bairro:</b>&nbsp;<span class="provider_district">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Cidade:</b>&nbsp;<span class="provider_city">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>UF:</b>&nbsp;<span class="provider_uf">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>CEP:</b>&nbsp;<span class="provider_cep"></span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>País:</b>&nbsp;<span class="provider_nation">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Celular:</b>&nbsp;<span class="provider_cel">----</span> </li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Telefone 1:</b>&nbsp;<span class="provider_tel_1"></span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Telefone 2:</b>&nbsp;<span class="provider_tel_2">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Inscrição Estadual:</b>&nbsp;<span class="provider_insc_uf">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Site url:</b>&nbsp;<span class="provider_web_url">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Situação:</b>&nbsp;<span class="status">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>E-mail:</b>&nbsp;<span class="provider_email">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Nome do representante:</b>&nbsp;<span class="provider_rep_name">----</span></li>
                        <li class="list-group-item list-group-item-primary"><b>Apelido representante:</b>&nbsp;<span class="provider_rep_apelido"></span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Representante celular:</b>&nbsp;<span class="provider_rep_cel">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Representante telefone 1:</b>&nbsp;<span class="provider_rep_tel_1">----</span> </li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Representante telefone 2:</b>&nbsp;<span class="provider_rep_tel_2"></span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Representante E-mail:</b>&nbsp;<span class="provider_rep_email">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Banco 1:</b>&nbsp;<span class="provider_banco_1">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Agência 1:</b>&nbsp;<span class="provider_agencia_1">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Conta 1:</b>&nbsp;<span class="provider_conta_1">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Titular 1:</b>&nbsp;<span class="provider_titular_1">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Banco 2:</b>&nbsp;<span class="provider_banco_2"></span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Agência 2:</b>&nbsp;<span class="provider_agencia_2">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Conta 2:</b>&nbsp;<span class="provider_conta_2">----</span> </li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Titular 2:</b>&nbsp;<span class="provider_titular_2"></span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Criado em:</b>&nbsp;<span class="created_at">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Modificado em:</b>&nbsp;<span class="modified_at">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Observações:</b>&nbsp;<span class="provider_obs">----</span></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar X</button>
                </div>
            </div>
        </div>
    </div><!-- End modal visualizar -->

    <script>
        //Instância os objetos das classses
        objMetodos = new Metodos();
        objFinanca = new Financeiro();
        objEvent = new EventAction();

        // Efetua a requisição ajax e retorna os registros
        objFinanca.setAjaxData(objSet = {
            url: '<?= Config::HOME_URI; ?>/projects/filters',
            url_id: '/projects/',
            get_decode: false
        });

        objFinanca.ajaxData();
        objFinanca.getAjaxData();

        $('input').on('keydown keyup', function() {
            objMetodos.setVerify(arrayData = ['name', 'start_date', 'end_date']);
            objMetodos.emptyVerify();
            objMetodos.getVerify();
        });

        //Tipo de ação disparada pelo usuário
        function typeAction(objAction) {
            id = (typeof objAction.id === "undefined") ? '' : objAction.id;
            if (objAction.type === 'loadInfo' || objAction.type === 'loadEdit') {
                typeExec = objAction.type;
                if (objAction.type === 'loadEdit') {
                    objFinanca.setAjaxActionUser(objSet = {
                        type: objAction.type,
                        url: '<?= Config::HOME_URI; ?>/projects/ajax-process',
                        id: objAction.id
                    });
                    objFinanca.ajaxActionUser();
                } else {
                    objFinanca.setAjaxActionUser(objSet = {
                        type: objAction.type,
                        url: "{{Config::HOME_URI}}/projects/ajax-process",
                        id: objAction.id
                    });
                    objFinanca.ajaxActionUser();
                }

            } else if (objAction.type === 'add') {

                if ($('#name').val() == '' || $('#cpf_cnpj').val() == '') {
                    alert('Existem campos obrigatórios não preenchido.');
                } else {
                    objAction.userData = $("#regForm").serialize() + '&action_type=' + objAction.type + '&id=' + id;
                    objFinanca.setAjaxActionUser(
                        objSet = {
                            type: objAction.type,
                            url: '<?= Config::HOME_URI; ?>/projects/ajax-process',
                            userData: objAction.userData
                        }
                    );
                    objFinanca.ajaxActionUser();
                    EventAction.resetForm();
                }

            } else if (objAction.type === 'update') {
                objAction.userData = $("#regForm").serialize() + '&action_type=' + objAction.type;
                feedback = 'Atualizado com sucessso!';
                objFinanca.setAjaxActionUser(
                    objSet = {
                        type: objAction.type,
                        url: '<?= Config::HOME_URI; ?>/projects/ajax-process',
                        userData: objAction.userData
                    }
                );
                objFinanca.ajaxActionUser();
                EventAction.resetForm();
            } else if (objAction.type === 'delete') {
                if (confirm('Deseja remover esse registro?')) {
                    objAction.userData = 'action_type=' + objAction.type + '&id=' + objAction.id;
                    objFinanca.setAjaxActionUser(
                        objSet = {
                            type: objAction.type,
                            url: '<?= Config::HOME_URI; ?>/projects/ajax-process',
                            userData: objAction.userData
                        }
                    );
                    objFinanca.ajaxActionUser();
                } else {
                    return false;
                }
            }
        }

        //mycar = new EventAction("Ford");
        //console.log(mycar.val);


        window.onload = function () {
            // Chama o modo novo registro.
            objEvent.newRegister('new', "#btn-new-show", "#group-btn-new, .form-hidden, #group-btn-hidden, .row-button-hidden", "#btn-form-new", "#group-btn-form-new", "#group-btn-form-new, #group-btn-hidden");
            objEvent.newRecordMode('returnNew', '#btn-form-new','#btn-save', '#group-btn-form-new');
            EventAction.hideForm('#btn-hidden', '#group-btn-hidden, .form-hidden, .row-button-hidden', '#group-btn-show, #btn-show');
            EventAction.showForm('#btn-show', '#group-btn-show', '.form-hidden, #group-btn-hidden, .row-button-hidden, #btn-show');
        }

        waitLoad();

        function waitLoad() {
            if (document.getElementById('tableData').readyState != "complete") {
                setTimeout(waitLoad, 100);
                objEvent.editRegister(".btn-edit-show", "#group-btn-new, #btn-show", ".form-hidden, #group-btn-hidden, .row-button-hidden, #group-btn-form-new, #btn-form-new");
            }
        }

    </script>

@endsection