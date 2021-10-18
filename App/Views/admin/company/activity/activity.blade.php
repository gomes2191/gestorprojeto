@extends('admin.layouts.app')

@section('title',' Atividades')
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
            <form id="regForm" name="regForm" enctype="multipart/form-data" class="form-register" data-id="" method="post" onsubmit="return validateForm()" action="" role="form">
                <fieldset>
                    <legend>ATIVIDADES<span class="badge bg-light text-dark text-wrap fst-italic"></span></legend>

                    <div class="row form-hidden" style="display: none">
                        <!-- Start div hidden 1 -->
                        <div class="col-md col-sm mb-2"><small class="text-muted">INFORMAÇÕES DO PROJETO</small></div>
                    </div>

                    <div class="row mb-3 form-hidden" style="display: none">
                        <!-- Start div hidden 1 -->
                        <div class="form-group col-md-3 col-sm-12">
                            <label for="name">Nome da Atividade:</label>
                            <input type="hidden" id="id" name="id" value="">
                            <input id="name" name="name" type="text" class="form-control form-control-sm" placeholder="Atividade nome..." value="">
                            <div class="invalid-feedback">
                                Preencha esse campo.
                            </div>
                        </div>

                        <div class="form-group col-md-2 col-sm">
                            <label for="id_project">Projeto vinculado:</label>
                            <select name="id_project" id="id_project" class="form-select form-select-sm"></select>
                            <div class="invalid-feedback">
                                Preencha esse campo.
                            </div>
                        </div>

                        <div class="form-group col-md-2 col-sm-12">
                            <label for="start_date ">Data início:</label>
                            <input id="start_date" name="start_date"
                                class="form-control form-control-sm date dataTime text-center" type="text" placeholder="dd/mm/aaaa" value="">
                            <div class="invalid-feedback">
                                Preencha esse campo.
                            </div>
                        </div>

                        <div class="form-group col-md-2 col-sm">
                            <label for="end_date">Data fim:</label>
                            <input id="end_date" name="end_date"
                                class="form-control form-control-sm date text-center" type="text" placeholder="dd/mm/aaaa" value="">
                            <div class="invalid-feedback">
                                Preencha esse campo.
                            </div>
                        </div>

                        <div class="form-group col-md-2 col-sm">
                            <label for="finished">Finalizada?</label>
                            <select name="finished" id="finished" class="form-select form-select-sm">
                                <option value="0" selected>Não</option>
                                <option value="1">Sim</option>
                            </select>
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
                <input type="text" class="form-control inputSearch" id="keywords" placeholder="Buscar por: Nome da Atividade..." onkeyup="objGMetodo.ajaxFilter();">
                <span class="input-group-text btn-primary">
                    <i class="fab fa-searchengin fa-lg"></i>
                </span>
            </div><!-- /End search engine-->
        </div><!-- /End col search engine -->

        <div class="col-md-5 col-sm-0"></div>
        <!--End/-->

        <div class="form-group mb-3 col-md-1 col-sm-">
            <div class="input-group">
                <input type="text" class="text-center form-control" id="qtdLine" placeholder="5" onkeyup="objGMetodo.ajaxFilter();" data-bs-toggle="tooltip" data-bs-placement="top" title="Quantidade de registro por página de 1 até 50.">
            </div>
        </div><!--/End col-->
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
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Nome da atividade:</b>&nbsp;<span class="name">---</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Projeto vinculado:</b>&nbsp;<span class="projectName">---</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Data início:</b>&nbsp;<span class="start_date">----</span></li>
                        <li class="list-group-item list-group-item-action list-group-item-primary"><b>Data final:</b>&nbsp;<span class="end_date">----</span> </li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><b>Finalizado?:</b>&nbsp;<span class="finished">---</span></li>
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
        objGMetodo = new GMetodo();
        objEvent = new EventAction();


        objGMetodo.setAjaxDataSelect(objSet = {
            url: '<?= Config::HOME_URI; ?>/activities/filters',
            url_id: '/activities/',
            populate: true
        });

        objGMetodo.ajaxDataSelect();
        objGMetodo.getAjaxDataSelect();

        // Efetua a requisição ajax e retorna os registros
        objGMetodo.setAjaxData(objSet = {
            url: '<?= Config::HOME_URI; ?>/activities/filters',
            url_id: '/activities/',
            get_decode: false
        });

        objGMetodo.ajaxData();
        objGMetodo.getAjaxData();

        $('input').on('keydown keyup', function() {
            objMetodos.setVerify(arrayData = ['name', 'id_project', 'start_date', 'end_date']);
            objMetodos.emptyVerify();
            objMetodos.getVerify();
        });

        //Tipo de ação disparada pelo usuário
        function typeAction(objAction) {
            id = (typeof objAction.id === "undefined") ? '' : objAction.id;
            if (objAction.type === 'loadInfo' || objAction.type === 'loadEdit') {
                typeExec = objAction.type;
                if (objAction.type === 'loadEdit') {
                    objGMetodo.setAjaxActionUser(objSet = {
                        type: objAction.type,
                        url: '<?= Config::HOME_URI; ?>/activities/ajax-process',
                        id: objAction.id
                    });
                    objGMetodo.ajaxActionUser();
                } else {
                    objGMetodo.setAjaxActionUser(objSet = {
                        type: objAction.type,
                        url: "{{Config::HOME_URI}}/activities/ajax-process",
                        id: objAction.id
                    });
                    objGMetodo.ajaxActionUser();
                }

            } else if (objAction.type === 'add') {
                if ($('#name').val() == '' || $('#start_date').val() == '' || $('#end_date').val() == '' || $('#id_project').val() == '') {
                    alert('Existem campos obrigatórios não preenchido.');
                } else {
                    objAction.userData = $("#regForm").serialize() + '&action_type=' + objAction.type + '&id=' + id;
                    objGMetodo.setAjaxActionUser(
                        objSet = {
                            type: objAction.type,
                            url: '<?= Config::HOME_URI; ?>/activities/ajax-process',
                            userData: objAction.userData
                        }
                    );
                    objGMetodo.ajaxActionUser();
                    EventAction.resetForm();
                }

            } else if (objAction.type === 'update') {
                objAction.userData = $("#regForm").serialize() + '&action_type=' + objAction.type;
                feedback = 'Atualizado com sucessso!';
                objGMetodo.setAjaxActionUser(
                    objSet = {
                        type: objAction.type,
                        url: '<?= Config::HOME_URI; ?>/activities/ajax-process',
                        userData: objAction.userData
                    }
                );
                objGMetodo.ajaxActionUser();
                EventAction.resetForm();
            } else if (objAction.type === 'delete') {
                if (confirm('Deseja remover esse registro?')) {
                    objAction.userData = 'action_type=' + objAction.type + '&id=' + objAction.id;
                    objGMetodo.setAjaxActionUser(
                        objSet = {
                            type: objAction.type,
                            url: '<?= Config::HOME_URI; ?>/activities/ajax-process',
                            userData: objAction.userData
                        }
                    );
                    objGMetodo.ajaxActionUser();
                } else {
                    return false;
                }
            }
        }

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