<?php
if (!defined('ABSPATH')) {
    exit();
}

if (filter_input(INPUT_GET, 're', FILTER_DEFAULT)) {

    $encode_id = filter_input(INPUT_GET, 're', FILTER_DEFAULT);

    # var_dump($encode_id);die;
    $modelo->delRegister($encode_id);

    # Destroy variavel não mais utilizadas
    unset($encode_id);
}

# Verifica se existe a requisição POST se existir executa o método se não faz nada
(filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : false;

# Paginação parametros
$limit = 5;

# Realiza um consulta na base de dados e reatorna os valores
$patrimonys = $modelo->searchTable('patrimony', ['order_by' => 'patrimony_id DESC ', 'limit' => $limit]);

$pagConfig = [
    'totalRows' => COUNT($modelo->searchTable('patrimony')),
    'perPage' => $limit,
    'link_func' => 'searchFilter'];

$pagination = new Pagination($pagConfig);

# Verifica se existe feedback e retorna o feedback se sim se não retorna false
$form_msg = $modelo->form_msg;

#date_default_timezone_set('America/Sao_Paulo');
$date = (date('Y-m-d H:i'));
date('Y-m-d H:i:s', time());
?>
<div class="row"><!--Start row loading  -->
    <div class="col-md-1  col-sm-0 col-xs-0"></div>
    <div class="col-md-10  col-sm-12 col-xs-12">
        <div id="loading" style="display: none;"><!--Loading.. este aqui-->
            <ul class="bokeh">
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
    <div class="col-md-1  col-sm-0 col-xs-0"></div>
</div><!--End row loading -->

<div class="row"><!--Start row Form-->
    <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <form id="" enctype="multipart/form-data" class="form-register" data-id="" method="post" action="" role="form" >
            <fieldset>
                <legend >PATRIMÔNIO <span class="text-success"></span></legend>
                <div class="row form-hide" style="display: none;"><!-- Start div hidden 1 -->
                    <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES DO PATRIMÔNIO</small></div>
                </div>    
                <div class="row form-hide" style="display: none;"><!-- Start div hidden 2 -->
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_cod">Código:</label>
                        <input type="hidden" id="patrimony_id" name="patrimony_id" value="" >
                        <input id="patrimony_cod" name="patrimony_cod" type="text" class="form-control form-control-sm text-center" placeholder="Código do patrimônio..." >
                    </div>

                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="patrimony_desc">Descrição:</label>
                        <input id="patrimony_desc" name="patrimony_desc" type="text" class="form-control form-control-sm text-center" placeholder="Descrição do patrimônio..." >
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_data_aq">Data da aquisição:</label>
                        <input id="patrimony_data_aq" name="patrimony_data_aq" class="form-control form-control-sm data text-center" type="text" placeholder="__/__/____" value="">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_cor">Cor:</label>
                        <input id="patrimony_cor" name="patrimony_cor" class="form-control form-control-sm text-center" type="text" placeholder="Cor do patrimônio..." value="">
                    </div>
                    <div class="form-group col-md-3 col-sm-12 col-xs-12" >
                        <label for="patrimony_for">Fornecedor:</label>
                        <input id="patrimony_for" name="patrimony_for" type="text" class="form-control form-control-sm text-center" placeholder="Fornecedor..." >
                    </div>
                </div><!-- End div hidden 2 -->

                <div class="row form-hide" style="display: none;"><!--Start div hidden 3-->
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_dimen">Dimensões:</label>
                        <input id="patrimony_dimen" name="patrimony_dimen" type="text" class="form-control form-control-sm text-center" placeholder="Dimensões do patrimônio..." >
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_setor">Setor:</label>
                        <input id="patrimony_setor" name="patrimony_setor" type="text" class="form-control form-control-sm text-center" placeholder="Setor..." >
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_valor">Valor do patrimônio:</label>
                        <input id="patrimony_valor" name="patrimony_valor" type="text" class="form-control form-control-sm text-center" placeholder="R$..." >
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_garan">Garantia:</label>
                        <input id="patrimony_garan" name="patrimony_garan" type="text" class="form-control form-control-sm text-center" placeholder="Garantia..." >
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_quant">Quantidade:</label>
                        <input id="patrimony_quant" name="patrimony_quant" type="text" class="form-control form-control-sm text-center" placeholder="Quantidade..." >
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_nf">Nota fiscal:</label>
                        <input id="patrimony_nf" name="patrimony_nf" type="text" class="form-control form-control-sm text-center" placeholder="Nota fiscal..." >
                    </div>
                </div><!--End div hidden 3 -->

                <div class="row form-hide" style="display: none;"><!--Start div hidden 4-->
                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                        <label for="patrimony_info">Observações:</label>
                        <textarea id="patrimony_info" class="form-control" name="patrimony_info" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..." ></textarea>
                    </div>
                </div><!--End div hidden 4 -->
                <div class="row form-compact row-button-hide" style="display: none;"><!--Start  div hidden button 1-->
                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <div id="group-btn-save" class="btn-group">
                            <button id="btn-save" title="Salvar informações" class="btn btn-outline-primary btn-sm" type="button"></button>
                        </div>
                        <div id="group-btn-reset" class="btn-group">
                            <button title="Limpar formulário" class="btn btn-outline-warning btn-sm marg-top fees-clear" type="reset"><i class="fa fa-eraser"></i> <span>LIMPAR</span></button>
                        </div>
                        <div id="group-btn-form-new" class="btn-group" style="display:none;">
                            <button id="btn-form-new" title="Volta para o modo adicionar novo registro" class="btn btn-light btn-sm  marg-top" type="reset"><i class="text-primary glyphicon glyphicon-plus"></i> <span>MODO NOVO REGISTRO</span></button>
                        </div>
                    </div>
                </div><!--End div hidden button 1 -->

                <div class="row form-compact" ><!--Start  div hidden button 2-->
                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <div id="group-btn-new" class="btn-group">
                            <button id="btn-new-show" title="Insere novo registro" class="btn btn-outline-primary btn-sm marg-top" type="reset">
                                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<span>ADICIONAR REGISTRO</span>
                            </button>
                        </div>
                        <div id="group-btn-show" style="display: none;" class="btn-group">
                            <button id="btn-show" title="Mostrar o formulário" class="btn btn-outline-success btn-sm marg-top" type="reset">
                                <i class="fa fa-eye"></i> ABRE FORMULÁRIO
                            </button>
                        </div>
                        <div id="group-btn-hide" style="display: none;" class="btn-group">
                            <button id="btn-hide" title="Esconde o formulário" class="btn top btn-outline-success btn-sm marg-top" type="reset"><i class="fa fa-eye-slash"></i> FECHA FORMULÁRIO</button>
                        </div>
                    </div>
                </div><!--End div hidden button 2 -->
            </fieldset>
        </form>
    </div>
</div><!--End row Form -->

<div id="filtros" class="row"><!--Start row filtros-->
    <div class="form-group col-md-4 col-sm-10 col-xs-12">
        <div id="custom-search-input">
            <div class="input-group">
                <input type="text" class="search form-control disable-focus" id="keywords" placeholder="Buscar por: Descrição ou Data de Vencimento..." onkeyup="objFinanca.ajaxFilter();">
                <span class="input-group-btn">
                    <button class="btn btn-info btn-lg" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div><!--End .custom-search-input -->
    </div><!--/End col-->

    <div class="col-md-5 col-sm-0 col-xs-0"></div><!--End/-->

    <div class="form-group col-md-1  col-sm-3 col-xs-12">
        <div class="input-group">
            <input type="text" class="text-center form-control" id="qtdLine"  placeholder="5" onkeyup="objFinanca.ajaxFilter();" data-toggle="tooltip" data-placement="bottom" title="Quantidade de registro por página de 1 até 50." >
        </div>
    </div><!--/End col-->

    <div class="form-group col-md-2  col-sm-3 col-xs-12">
        <select id="sortBy" class="custom-select" onchange="objFinanca.ajaxFilter();">
            <option value="">Ordenar Por</option>
            <option value="asc">Ascendente</option>
            <option value="desc">descendente</option>
            <option value="active">Pago</option>
            <option value="inactive">Não Pago</option>
        </select>
    </div><!--/End col-->
</div><!--End row filtros -->

<div class="row"><!--Start row tableData -->
    <div class="col-md-12  col-sm-12 col-xs-12">
        <div id="tableData" class="table-responsive-sm" style="border: none;">

        </div>
    </div>
</div><!--End row tableData-->

<div id="inforView" class="modal fade" ><!-- Start Modal inforView -->
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
                    <li class="list-group-item list-group-item-text"><b>EMPRESA:</b>&nbsp;<span class="patrimony_name"></span></li> 
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>CPF / CNPJ:</b>&nbsp;<span class="patrimony_cpf_cnpj">----</span></li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Razão social:</b>&nbsp;<span class="patrimony_rs">----</span> </li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Área de atuação:</b>&nbsp;<span class="patrimony_at"></span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Endereço:</b>&nbsp;<span class="patrimony_end">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Bairro:</b>&nbsp;<span class="patrimony_district">----</span></li>
                    <li class="list-group-item list-group-item-info list-group-item-text"><b>Cidade:</b>&nbsp;<span class="patrimony_city">----</span></li>
                    <li class="list-group-item list-group-item-light list-group-item-text"><b>UF:</b>&nbsp;<span class="patrimony_uf">----</span></li>
                    <li class="list-group-item list-group-item-dark list-group-item-text"><b>CEP:</b>&nbsp;<span class="patrimony_cep"></span></li> 
                    <li class="list-group-item list-group-item-text"><b>País:</b>&nbsp;<span class="patrimony_nation">----</span></li>
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Celular:</b>&nbsp;<span class="patrimony_cel">----</span> </li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Telefone 1:</b>&nbsp;<span class="patrimony_tel_1"></span></li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Telefone 2:</b>&nbsp;<span class="patrimony_tel_2">----</span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Inscrição Estadual:</b>&nbsp;<span class="patrimony_insc_uf">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b> Site url:</b>&nbsp;<span class="patrimony_web_url">----</span></li>
                    <li class="list-group-item list-group-item-info list-group-item-text"><b>E-mail:</b>&nbsp;<span class="patrimony_email">----</span></li>
                    <li class="list-group-item list-group-item-light list-group-item-text"><b>Nome do representante:</b>&nbsp;<span class="patrimony_rep_name">----</span></li>
                    <li class="list-group-item list-group-item-dark list-group-item-text"><b>Apelido representante:</b>&nbsp;<span class="patrimony_rep_apelido"></span></li> 
                    <li class="list-group-item list-group-item-text"><b>Representante celular:</b>&nbsp;<span class="patrimony_rep_cel">----</span></li>
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Representante telefone 1:</b>&nbsp;<span class="patrimony_rep_tel_1">----</span> </li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Representante telefone 2:</b>&nbsp;<span class="patrimony_rep_tel_2"></span></li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Representante E-mail:</b>&nbsp;<span class="patrimony_rep_email">----</span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Banco 1:</b>&nbsp;<span class="patrimony_banco_1">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Agência 1:</b>&nbsp;<span class="patrimony_agencia_1">----</span></li>
                    <li class="list-group-item list-group-item-info list-group-item-text"><b>Conta 1:</b>&nbsp;<span class="patrimony_conta_1">----</span></li>
                    <li class="list-group-item list-group-item-light list-group-item-text"><b>Titular 1:</b>&nbsp;<span class="patrimony_titular_1">----</span></li>
                    <li class="list-group-item list-group-item-dark list-group-item-text"><b>Banco 2:</b>&nbsp;<span class="patrimony_banco_2"></span></li> 
                    <li class="list-group-item list-group-item-text"><b>Agência 2:</b>&nbsp;<span class="patrimony_agencia_2">----</span></li>
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Conta 2:</b>&nbsp;<span class="patrimony_conta_2">----</span> </li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Titular 2:</b>&nbsp;<span class="patrimony_titular_2"></span></li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Criado em:</b>&nbsp;<span class="patrimony_created">----</span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Modificado em:</b>&nbsp;<span class="patrimony_modified">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Observações:</b>&nbsp;<span class="patrimony_obs">----</span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar X</button>
            </div>
        </div>
    </div>
</div><!-- End modal infoView -->

    <script>// Start script -->
        // Parâmetros necessários para a requisição Ajax
        var objFinanca = new Financeiro();
        objFinanca.setAjaxData('<?= HOME_URI; ?>/company-patrimony/filters');
        objFinanca.ajaxData();
        objFinanca.getAjaxData();

        //Tipo de ação desparada pelo usuário
        function typeAction(objData) {
            id = (typeof objData.id === "undefined") ? '' : objData.id;
            if (objData.type === 'loadInfo' || objData.type === 'loadEdit') {
                typeExec = objData.type;
                if (objData.type === 'loadEdit') {
                    objFinanca.setAjaxActionUser(objSet = {type: objData.type, url: '<?= HOME_URI; ?>/company-patrimony/ajax-process', id: objData.id});
                    objFinanca.ajaxActionUser();
                } else {
                    objFinanca.setAjaxActionUser(objSet = {type: objData.type, url: '<?= HOME_URI; ?>/company-patrimony/ajax-process', id: objData.id});
                    objFinanca.ajaxActionUser();
                }

            } else if (objData.type === 'add') {
                objData.userData = $("#addForm").serialize() + '&action_type=' + objData.type + '&id=' + id;
                feedback = 'Inserido com sucesso!';
                $('#filtros').show();
                objFinanca.setAjaxActionUser(
                        objSet = {type: objData.type,
                            url: '<?= HOME_URI; ?>/company-patrimony/ajax-process',
                            userData: objData.userData}
                );
                objFinanca.ajaxActionUser();
            } else if (objData.type === 'update') {
                objData.userData = $("#editForm").serialize() + '&action_type=' + objData.type;
                feedback = 'Atualizado com sucessso!';
                objFinanca.setAjaxActionUser(
                        objSet = {type: objData.type,
                            url: '<?= HOME_URI; ?>/company-patrimony/ajax-process',
                            userData: objData.userData}
                );
                objFinanca.ajaxActionUser();
            } else if (objData.type === 'delete') {
                if (confirm('Deseja remover esse registro?')) {
                    objData.userData = 'action_type=' + objData.type + '&id=' + objData.id;
                    feedback = 'Remoção realizada com sucesso!';
                    objFinanca.setAjaxActionUser(
                            objSet = {type: objData.type,
                                url: '<?= HOME_URI; ?>/company-patrimony/ajax-process',
                                userData: objData.userData}
                    );
                    objFinanca.ajaxActionUser();
                } else {
                    return false;
                }
            }
        }
    </script>
