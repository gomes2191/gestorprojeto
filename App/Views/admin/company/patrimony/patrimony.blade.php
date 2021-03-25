@extends('admin.layout.app')

@section('title',' Patrimônio')

@section('content')

<!--Start row loading  -->
<div class="row">
    <div class="col-md-1  col-sm-0 col-xs-0"></div>
    <div class="col-md-10  col-sm-12 col-xs-12">
        <div id="loading" style="display: none;">
            <!--Loading.. este aqui-->
            <ul class="bokeh">
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
    <div class="col-md-1  col-sm-0 col-xs-0"></div>
</div>
<!--End row loading -->

<div class="row">
    <!--Start row Form-->
    <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <form id="regForm" enctype="multipart/form-data" class="form-register" data-id="" method="post" action="" role="form">
            <fieldset>
                <legend>PATRIMÔNIO <span class="text-success"></span></legend>

                <div class="row form-hidden" style="display: none;">
                    <!-- Start div hidden 1 -->
                    <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES DO PATRIMÔNIO</small></div>
                </div><!-- End div hidden 1 -->

                <div class="row mb-3 form-hidden" style="display: none;">
                    <!-- Start div hidden 2 -->
                    <div class="form-group col-md col-sm">
                        <label for="code">Código:</label>
                        <input type="hidden" id="id" name="id" value="">
                        <input id="code" name="code" type="text" class="form-control form-control-sm" placeholder="Ex.: C300">
                        <div class="invalid-feedback">
                            Preencha esse campo.
                        </div>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="description">Descrição:</label>
                        <input id="description" name="description" type="text" class="form-control form-control-sm text-center" placeholder="Ex.: Cadeiras">
                        <div class="invalid-feedback">
                            Preencha esse campo.
                        </div>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="acquisition_date ">Data da aquisição:</label>
                        <input id="acquisition_date" name="acquisition_date " class="form-control form-control-sm date text-center" type="date" placeholder="dd/mm/aaaa" value="">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="color">Cor:</label>
                        <input id="color" name="color" class="form-control form-control-sm text-center" type="text" placeholder="Ex.: Branco" value="">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="provider">Fornecedor:</label>
                        <input id="provider" name="provider" type="text" class="form-control form-control-sm text-center" placeholder="Ex.: Fornecedor">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="dimension">Dimensões:</label>
                        <input id="dimension" name="dimension" type="text" class="form-control form-control-sm text-center" placeholder="Ex.: 53 x 43 x 91 cm">
                    </div>

                </div><!-- End div hidden 2 -->

                <div class="row form-hidden" style="display: none;">
                    <!--Start div hidden 3-->
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="sector">Setor:</label>
                        <input id="sector" name="sector" type="text" class="form-control form-control-sm text-center" placeholder="Ex.: Almoxarifado">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="value">Valor do patrimônio:</label>
                        <input id="value" name="value" type="text" class="form-control form-control-sm text-center money" placeholder="100,00">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="warranty">Garantia:</label>
                        <input id="warranty" name="warranty" type="text" class="form-control form-control-sm text-center" placeholder="2 - Anos">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="quantity">Quantidade:</label>
                        <input id="quantity" name="quantity" type="text" class="form-control form-control-sm number text-center" placeholder="10">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="receipt">Nota fiscal:</label>
                        <input id="receipt" name="receipt" type="text" class="form-control form-control-sm text-center" placeholder="Nota fiscal...">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="situation">Situação:</label><br>
                        <select id="situation" name="situation" class="custom-select custom-select-sm">
                            <option selected value="active">Ativo</option>
                            <option value="inactive">Inativo</option>
                        </select>
                    </div>
                </div>
                <!--End div hidden 3 -->

                <div class="row form-hidden" style="display: none;">
                    <!--Start div hidden 4-->
                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                        <label for="observation">Observações:</label>
                        <textarea id="observation" class="form-control" name="observation" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..."></textarea>
                    </div>
                </div>
                <!--End div hidden 4 -->
                <div class="row form-compact row-button-hidden" style="display: none;">
                    <!--Start  div hidden button 1-->
                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <div id="group-btn-save" class="btn-group">
                            <button id="btn-save" title="Salvar informações" class="btn btn-outline-primary btn-sm" type="button"></button>
                        </div>
                        <div id="group-btn-reset" class="btn-group">
                            <button title="Limpar formulário" class="btn btn-outline-warning btn-sm marg-top fees-clear" type="reset">
                                <i class="fas fa-eraser fa-lg"></i> <span>LIMPAR</span>
                            </button>
                        </div>
                        <div id="group-btn-form-new" class="btn-group" style="display:none;">
                            <button id="btn-form-new" title="Volta para o modo adicionar novo registro" class="btn btn-outline-primary btn-sm" type="reset">
                                <i class="fas fa-plus fa-lg"></i> <span>MODO NOVO REGISTRO</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!--End div hidden button 1 -->

                <div class="row form-compact">
                    <!--Start  div hidden button 2-->
                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <div id="group-btn-new" class="btn-group">
                            <button id="btn-new-show" title="Insere novo registro" class="btn btn-outline-primary btn-sm marg-top" type="reset">
                                <i class="fas fa-plus fa-lg" aria-hidden="true"></i>&nbsp;<span>ADICIONAR REGISTRO</span>
                            </button>
                        </div>
                        <div id="group-btn-show" style="display: none;" class="btn-group">
                            <button id="btn-show" title="Mostrar o formulário" class="btn btn-outline-success btn-sm marg-top" type="reset">
                                <i class="fas fa-eye fa-lg"></i> ABRE FORMULÁRIO
                            </button>
                        </div>
                        <div id="group-btn-hidden" style="display: none;" class="btn-group">
                            <button id="btn-hidden" title="Esconde o formulário" class="btn top btn-outline-success btn-sm marg-top" type="reset">
                                <i class="fas fa-eye-slash fa-lg"></i> FECHA FORMULÁRIO
                            </button>
                        </div>
                    </div>
                </div>
                <!--End div hidden button 2 -->
            </fieldset>
        </form>
    </div>
</div>
<!--End row Form -->

<div id="filtros" class="row">
    <!--Start row filtros-->
    <div class="form-group col-md-4 col-sm-10 col-xs-12">

        <div class="input-group">
            <input type="text" class="form-control inputSearch" id="keywords" placeholder="Buscar por: Código ou Descrição" onkeyup="objFinanca.ajaxFilter();">
            <div class="input-group-append">
                <span class="input-group-text spanSearch">
                    <i class="fab fa-searchengin fa-lg"></i>
                </span>
            </div>
        </div><!-- /End search engine-->

    </div>
    <!--/End col-->

    <div class="col-md-5 col-sm-0 col-xs-0"></div>
    <!--End/-->

    <div class="form-group col-md-1  col-sm-3 col-xs-12">
        <div class="input-group">
            <input type="text" class="text-center form-control" id="qtdLine" placeholder="5" onkeyup="objFinanca.ajaxFilter();" data-toggle="tooltip" data-placement="bottom" title="Quantidade de registro por página de 1 até 50.">
        </div>
    </div>
    <!--/End col-->

    <div class="form-group col-md-2  col-sm-3 col-xs-12">
        <select id="sortBy" class="custom-select" onchange="objFinanca.ajaxFilter();">
            <option value="">Ordenar Por</option>
            <option value="asc">Ascendente</option>
            <option value="desc">descendente</option>
            <option value="active">Ativo</option>
            <option value="inactive">Inativo</option>
        </select>
    </div>
    <!--/End col-->
</div>
<!--End row filtros -->

<div class="row">
    <!--Start row tableData -->
    <div class="col-md-12  col-sm-12 col-xs-12">
        <div id="tableData" class="table-responsive-sm" style="border: none;">

        </div>
    </div>
</div>
<!--End row tableData-->

<div id="inforView" class="modal fade">
    <!-- Start Modal inforView -->
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!--Conteudo do modal-->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-info-circle" aria-hidden="true"></i> INFORMAÇÕES</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-modal-forn">
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Código:</b>&nbsp;<span class="patrimony_cod">----</span></li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Descrição:</b>&nbsp;<span class="patrimony_desc">----</span> </li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Data de aquisisção:</b>&nbsp;<span class="patrimony_data_aq"></span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Cor:</b>&nbsp;<span class="color">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Fornecedor:</b>&nbsp;<span class="provider">----</span></li>
                    <li class="list-group-item list-group-item-info list-group-item-text"><b>Dimensão:</b>&nbsp;<span class="dimension">----</span></li>
                    <li class="list-group-item list-group-item-light list-group-item-text"><b>Setor:</b>&nbsp;<span class="sector">----</span></li>
                    <li class="list-group-item list-group-item-dark list-group-item-text"><b>Valor:</b>&nbsp;<span class="value"></span></li>
                    <li class="list-group-item list-group-item-text"><b>Garantia:</b>&nbsp;<span class="patrimony_nation">----</span></li>
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Quantidade:</b>&nbsp;<span class="quantity">----</span> </li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Nota fiscal:</b>&nbsp;<span class="receipt"></span></li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Observações:</b>&nbsp;<span class="observation">----</span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Criado em:</b>&nbsp;<span class="patrimony_created">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Modificado em:</b>&nbsp;<span class="patrimony_modified">----</span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar X</button>
            </div>
        </div>
    </div>
</div><!-- End modal infoView -->

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remoção de registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Você, realmente, deseja proseguir com a remoção desse registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="deleteExecute" id>Remover</button>
            </div>

        </div>
    </div>
</div>


<script>
    // Instância os objetos das classses
    objMetodos = new Metodos();
    objFinanca = new Financeiro();
    objEvent = new EventAction();

    // Efetua a requisição ajax e retorna os registros
    objFinanca.setAjaxData(objSet = {
        url: '<?= Config::HOME_URI; ?>/patrimony/filters',
        url_id: '/patrimony/',
        get_decode: false
    });

    objFinanca.ajaxData();
    objFinanca.getAjaxData();


    $('input').on('keydown keyup', function() {
        objMetodos.setVerify(arrayData = ['patrimony_cod', 'patrimony_desc']);
        objMetodos.emptyVerify();
        objMetodos.getVerify();
    });

    // Tipo de ação disparada pelo usuário
    function typeAction(objAction) {
        id = (typeof objAction.id === "undefined") ? '' : objAction.id;
        if (objAction.type === 'loadInfo' || objAction.type === 'loadEdit') {
            typeExec = objAction.type;
            if (objAction.type === 'loadEdit') {
                objFinanca.setAjaxActionUser(objSet = {
                    type: objAction.type,
                    url: '<?= HOME_URI; ?>/patrimony/ajax-process',
                    id: objAction.id
                });
                objFinanca.ajaxActionUser();
            } else {
                objFinanca.setAjaxActionUser(objSet = {
                    type: objAction.type,
                    url: '<?= HOME_URI; ?>/patrimony/ajax-process',
                    id: objAction.id
                });
                objFinanca.ajaxActionUser();
            }
        } else if (objAction.type === 'add') {
            if ($('#provider_name').val() == '' || $('#provider_cpf_cnpj').val() == '') {
                alert('Existem campos obrigatórios não preenchido.');
            } else {
                objAction.userData = $("#addForm").serialize() + '&action_type=' + objAction.type + '&id=' + id;
                feedback = 'Inserido com sucesso!';
                $('#filtros').show();
                objFinanca.setAjaxActionUser(
                    objSet = {
                        type: objAction.type,
                        url: '<?= HOME_URI; ?>/patrimony/ajax-process',
                        userData: objAction.userData
                    }
                );
                objFinanca.ajaxActionUser();
            }

        } else if (objAction.type === 'update') {
            objAction.userData = $("#editForm").serialize() + '&action_type=' + objAction.type;
            feedback = 'Atualizado com sucessso!';
            objFinanca.setAjaxActionUser(
                objSet = {
                    type: objAction.type,
                    url: '<?= HOME_URI; ?>/patrimony/ajax-process',
                    userData: objAction.userData
                }
            );
            objFinanca.ajaxActionUser();
        } else if (objAction.type === 'delete') {
            if (confirm('Deseja remover esse registro?')) {
                objAction.userData = 'action_type=' + objAction.type + '&id=' + objAction.id;
                feedback = 'Remoção realizada com sucesso!';
                objFinanca.setAjaxActionUser(
                    objSet = {
                        type: objAction.type,
                        url: '<?= HOME_URI; ?>/patrimony/ajax-process',
                        userData: objAction.userData
                    }
                );
                objFinanca.ajaxActionUser();
            } else {
                return false;
            }
        }
    }
</script>
@endsection