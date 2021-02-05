

@extends('admin.layout.app')

@section('title',' Fornecedores')

@section('content')

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

<div class="row">
    <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <form id="" enctype="multipart/form-data" class="form-register" data-id="" method="post" action="" role="form">
            <fieldset>
                <legend>FORNECEDORES <span class="text-success"></span></legend>
                <div class="row form-hidden" style="display: none;">
                    <!-- Start div hidden 1 -->
                    <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES DO FORNECEDOR</small></div>
                </div>
                <div class="row form-hidden" style="display: none;">
                    <!-- Start div hidden 1 -->
                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="provider_name">Empresa:</label>
                        <input type="hidden" id="id" name="provider_id" value="">
                        <input id="name" name="name" type="text" class="form-control form-control-sm text-center" placeholder="Nome da empresa" value="">
                        <div class="invalid-feedback">
                            Preencha esse campo.
                        </div>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="provider_cpf_cnpj">CPF/CNPJ:</label>
                        <input id="cpf_cnpj" name="cpf_cnpj" type="text" class="form-control form-control-sm text-center" placeholder="CPF/CNPJ">
                        <div class="invalid-feedback">
                            Preencha esse campo.
                        </div>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="razao_social">Razão social:</label>
                        <input id="razao_social" name="razao_social" class="form-control form-control-sm text-center" type="text" placeholder="Razão social" value="">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="occupation_area">Área de atuação:</label>
                        <input id="occupation_area" name="occupation_area" class="form-control form-control-sm text-center" type="text" placeholder="Área de atuação" value="">
                    </div>
                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="address">Endereço:</label>
                        <input id="address" name="address" type="text" class="form-control form-control-sm text-center" placeholder="Endereço">
                    </div>
                </div><!-- /End div hidden 1 -->

                <div class="row form-hidden" style="display: none;">
                    <!--Start div hidden 2-->
                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="district">Bairro:</label>
                        <input id="district" name="district" type="text" class="form-control form-control-sm text-center" placeholder="Bairro">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="city">Cidade:</label>
                        <input id="city" name="city" type="text" class="form-control form-control-sm text-center" placeholder="Cidade">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="cep">CEP:</label>
                        <input id="cep" name="cep" type="text" class="form-control form-control-sm text-center cep" placeholder="00000-000">
                    </div>
                    <div class="form-group col-md-1 col-sm-12 col-xs-12">
                        <label for="uf">UF:</label>
                        <input id="uf" name="uf" type="text" class="form-control form-control-sm text-center uf" placeholder="UF">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="nation">Território:</label>
                        <input id="nation" name="nation" type="text" class="form-control form-control-sm text-center" placeholder="País">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="cel">Celular:</label>
                        <input id="cel" name="cel" type="text" class="form-control form-control-sm phone_cel text-center" placeholder="(00) 00000-0000">
                    </div>
                </div><!-- End div hidden 2 -->

                <div class="row form-hidden" style="display: none;">
                    <!-- Start div hidden 3 -->
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="phone">Telefone 1:</label>
                        <input id="phone" name="phone" type="text" class="form-control form-control-sm phone_tel text-center" placeholder="(00) 0000-00000">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="insc_uf">Inscrição Estadual:</label>
                        <input id="insc_uf" name="insc_uf" type="text" class="form-control form-control-sm text-center" placeholder="Inscrição estadual...">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="email">E-mail:</label>
                        <input id="email" name="email" type="text" class="form-control form-control-sm text-center" placeholder="exemplo@email.com">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="web_url">Site:</label>
                        <input id="web_url" name="web_url" type="text" class="form-control form-control-sm text-center" placeholder="www.exemplo.com">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="status">Situação:</label><br>
                        <select id="status" name="status" class="custom-select custom-select-sm">
                            <option selected value="active">Ativo</option>
                            <option value="inactive">Inativo</option>
                        </select>
                    </div>
                </div><!-- End div hidden 3 -->

                <div class="row form-hidden" style="display: none;">
                    <!-- Start div hidden 4 -->
                    <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES DO REPRESENTANTE - PESSOA DE CONTATO</small></div>
                </div><!-- End div hidden 4 -->

                <div class="row form-hidden" style="display: none;">
                    <!--Start div hidden 5-->
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="rp_name">Nome:</label>
                        <input id="rp_name" name="rp_name" type="text" class="form-control form-control-sm text-center" placeholder="Nome">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="rp_nickname">Apelido:</label>
                        <input id="rp_nickname" name="rp_nickname" type="text" class="form-control form-control-sm text-center" placeholder="Apelido">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="rp_email">E-mail:</label>
                        <input id="rp_email" name="rp_email" type="text" class="form-control form-control-sm text-center" placeholder="email@exemplo.com">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="rp_cel">Celular:</label>
                        <input id="rp_cel" name="rp_cel" type="text" class="form-control form-control-sm text-center" placeholder="(00) 00000-0000">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="rp_phone">Telefone 1:</label>
                        <input id="rp_phone" name="rp_phone" type="text" class="form-control form-control-sm text-center" placeholder="(00) 00000-0000">
                    </div>
                </div><!-- /End div hidden 5 -->

                <div class="row form-hidden" style="display: none;">
                    <!-- Start div hidden 6 -->
                    <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES BANCÁRIAS</small></div>
                </div> <!-- End div hidden 6 -->

                <div class="row form-hidden" style="display: none;">
                    <!--Start div hidden 7-->
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="bank">Banco 1:</label>
                        <input id="bank" name="bank" type="text" class="form-control form-control-sm text-center" placeholder="Banco">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="agency">Agência 1:</label>
                        <input id="agency" name="agency" type="text" class="form-control form-control-sm text-center" placeholder="Agência">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="account">Conta 1:</label>
                        <input id="account" name="account" type="text" class="form-control form-control-sm text-center" placeholder="Conta">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="holder">Titular 1:</label>
                        <input id="holder" name="holder" type="text" class="form-control form-control-sm text-center" placeholder="Titular">
                    </div>
                </div><!-- End div hidden 7 -->

                <div class="row form-hidden" style="display: none;">
                    <!--Start div hidden 9-->
                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                        <label for="obs">Observações:</label>
                        <textarea id="obs" class="form-control" name="obs" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..."><?= htmlentities(GFunc::chkArray($modelo->form_data, 'providers_obs')); ?></textarea>
                    </div>
                </div><!-- End div hidden 9 -->

                <div class="row row-button-hidden" style="display: none;">
                    <!-- Start div button hidden 1 -->
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
                            <button id="btn-form-new" title="Volta para o modo adicionar novo registro" class="btn btn-outline-primary btn-sm" type="reset" onclick="newRegister();">
                                <i class="fas fa-plus fa-lg"></i> <span>MODO NOVO REGISTRO</span>
                            </button>
                        </div>
                    </div>
                </div><!-- End div button hidden 1 -->

                <div class="row">
                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <div id="group-btn-new" class="btn-group">
                            <button id="btn-new-show" title="Insere novo registro" class="btn btn-primary btn-sm" type="reset" >
                                <i class="fas fa-plus fa-lg" aria-hidden="true"></i>&nbsp;<span>ADICIONAR REGISTRO</span>
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
    <div class="form-group col-md-4 col-sm-10 col-xs-12">

        <div class="input-group">
            <input type="text" class="form-control inputSearch" id="keywords" placeholder="Buscar por: Nome ou Área de atuação..." onkeyup="objFinanca.ajaxFilter();">
            <div class="input-group-append">
                <span class="input-group-text spanSearch">
                    <i class="fab fa-searchengin fa-lg"></i>
                </span>
            </div>
        </div><!-- /End search engine-->

    </div><!-- /End col search engine -->

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
            <option value="desc">Descendente</option>
            <option value="active">Ativo</option>
            <option value="inactive">Inativo</option>
        </select>
    </div>
    <!--/End col-->
</div><!-- End row filtros -->

<div class="row">
    <div class="col-md-12  col-sm-12 col-xs-12">
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
                <h4 class="modal-title"><i class="fa fa-info-circle" aria-hidden="true"></i> INFORMAÇÕES</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush list-modal-forn">
                    <li class="list-group-item list-group-item-text"><b>EMPRESA:</b>&nbsp;<span class="name"></span></li>
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>CPF / CNPJ:</b>&nbsp;<span class="cpf_cnpj">----</span></li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Razão social:</b>&nbsp;<span class="provider_rs">----</span> </li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Área de atuação:</b>&nbsp;<span class="provider_at"></span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Endereço:</b>&nbsp;<span class="provider_end">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Bairro:</b>&nbsp;<span class="provider_district">----</span></li>
                    <li class="list-group-item list-group-item-info list-group-item-text"><b>Cidade:</b>&nbsp;<span class="provider_city">----</span></li>
                    <li class="list-group-item list-group-item-light list-group-item-text"><b>UF:</b>&nbsp;<span class="provider_uf">----</span></li>
                    <li class="list-group-item list-group-item-dark list-group-item-text"><b>CEP:</b>&nbsp;<span class="provider_cep"></span></li>
                    <li class="list-group-item list-group-item-text"><b>País:</b>&nbsp;<span class="provider_nation">----</span></li>
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Celular:</b>&nbsp;<span class="provider_cel">----</span> </li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Telefone 1:</b>&nbsp;<span class="provider_tel_1"></span></li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Telefone 2:</b>&nbsp;<span class="provider_tel_2">----</span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Inscrição Estadual:</b>&nbsp;<span class="provider_insc_uf">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Site url:</b>&nbsp;<span class="provider_web_url">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Situação:</b>&nbsp;<span class="status">----</span></li>
                    <li class="list-group-item list-group-item-info list-group-item-text"><b>E-mail:</b>&nbsp;<span class="provider_email">----</span></li>
                    <li class="list-group-item list-group-item-light list-group-item-text"><b>Nome do representante:</b>&nbsp;<span class="provider_rep_name">----</span></li>
                    <li class="list-group-item list-group-item-dark list-group-item-text"><b>Apelido representante:</b>&nbsp;<span class="provider_rep_apelido"></span></li>
                    <li class="list-group-item list-group-item-text"><b>Representante celular:</b>&nbsp;<span class="provider_rep_cel">----</span></li>
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Representante telefone 1:</b>&nbsp;<span class="provider_rep_tel_1">----</span> </li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Representante telefone 2:</b>&nbsp;<span class="provider_rep_tel_2"></span></li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Representante E-mail:</b>&nbsp;<span class="provider_rep_email">----</span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Banco 1:</b>&nbsp;<span class="provider_banco_1">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Agência 1:</b>&nbsp;<span class="provider_agencia_1">----</span></li>
                    <li class="list-group-item list-group-item-info list-group-item-text"><b>Conta 1:</b>&nbsp;<span class="provider_conta_1">----</span></li>
                    <li class="list-group-item list-group-item-light list-group-item-text"><b>Titular 1:</b>&nbsp;<span class="provider_titular_1">----</span></li>
                    <li class="list-group-item list-group-item-dark list-group-item-text"><b>Banco 2:</b>&nbsp;<span class="provider_banco_2"></span></li>
                    <li class="list-group-item list-group-item-text"><b>Agência 2:</b>&nbsp;<span class="provider_agencia_2">----</span></li>
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Conta 2:</b>&nbsp;<span class="provider_conta_2">----</span> </li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Titular 2:</b>&nbsp;<span class="provider_titular_2"></span></li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Criado em:</b>&nbsp;<span class="created_at">----</span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Modificado em:</b>&nbsp;<span class="modified_at">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Observações:</b>&nbsp;<span class="provider_obs">----</span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar X</button>
            </div>
        </div>
    </div>
</div><!-- End modal visualizar -->

<script>
    //Instância os objetos das classses
    var objMetodos = new Metodos();

    var objFinanca = new Financeiro();

    objEvent = new EventAction();

    // Efetua a requisição ajax e retorna os registros
    objFinanca.setAjaxData(objSet = {
        url: '<?= Config::HOME_URI; ?>/providers/filters',
        url_id: '/providers/',
        get_decode: false
    });

    objFinanca.ajaxData();
    objFinanca.getAjaxData();

    $('input').on('keydown keyup', function() {
        objMetodos.setVerify(arrayData = ['name', 'cpf_cnpj']);
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
                    url: '<?= Config::HOME_URI; ?>/providers/ajax-process',
                    id: objAction.id
                });
                objFinanca.ajaxActionUser();

            } else {
                objFinanca.setAjaxActionUser(objSet = {
                    type: objAction.type,
                    url: "{{Config::HOME_URI}}/providers/ajax-process",
                    id: objAction.id
                });
                objFinanca.ajaxActionUser();
            }

        } else if (objAction.type === 'add') {

            if ($('#name').val() == '' || $('#cpf_cnpj').val() == '') {
                alert('Existem campos obrigatórios não preenchido.');
            } else {
                objAction.userData = $("#addForm").serialize() + '&action_type=' + objAction.type + '&id=' + id;
                feedback = 'Inserido com sucesso!';
                $('#filtros').show();
                objFinanca.setAjaxActionUser(
                    objSet = {
                        type: objAction.type,
                        url: '<?= Config::HOME_URI; ?>/providers/ajax-process',
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
                    url: '<?= Config::HOME_URI; ?>/providers/ajax-process',
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
                        url: '<?= Config::HOME_URI; ?>/providers/ajax-process',
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
        objEvent.newRegister("#btn-new-show", "#group-btn-new", "#btn-form-new");
    }

    table = document.getElementById("tableData");

    waitLoad();

    function waitLoad() {
        if (table.readyState != "complete") {
            setTimeout(waitLoad, 100);
            objEvent.editRegister(".btn-edit-show", "#group-btn-new, #btn-show", ".form-hidden, #group-btn-hidden, .row-button-hidden, #group-btn-form-new, #btn-form-new");
        }
    }

</script>
@endsection