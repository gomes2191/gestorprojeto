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
                <legend >STOQUE <span class="text-success"></span></legend>
                <div class="row form-hide" style="display: none;"><!-- Start div hidden 1 -->
                    <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES DO PRODUTO</small></div>
                </div>    
                <div class="row form-hide" style="display: none;"><!-- Start div hidden 2 -->
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_cod">Código:</label>
                        <input type="hidden" id="patrimony_id" name="patrimony_id" value="" >
                        <input id="patrimony_cod" name="patrimony_cod" type="text" class="form-control form-control-sm text-center" placeholder="Código do produto..." >
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_desc">Descrição:</label>
                        <input id="patrimony_desc" name="patrimony_desc" type="text" class="form-control form-control-sm text-center" placeholder="Descrição do produto..." >
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_data_aq">Tipo unitário:</label>
                        <input id="patrimony_data_aq" name="patrimony_data_aq" class="form-control form-control-sm text-center" type="text" placeholder="Tipo unitário..." value="">
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_cor">Fornecedor:</label>
                        <input id="patrimony_cor" name="patrimony_cor" class="form-control form-control-sm text-center" type="text" placeholder="Fornecedor..." value="">
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12" >
                        <label for="patrimony_for">Estoque minimo:</label>
                        <input id="patrimony_for" name="patrimony_for" type="text" class="form-control form-control-sm text-center" placeholder="Estoque minimo..." >
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_dimen">Estoque inícial:</label>
                        <input id="patrimony_dimen" name="patrimony_dimen" type="text" class="form-control form-control-sm text-center" placeholder="Estoque inícial..." >
                    </div>
                </div><!-- End div hidden 2 -->

                <div class="row form-hide" style="display: none;"><!--Start div hidden 3-->
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="patrimony_setor">Valor:</label>
                        <input id="patrimony_setor" name="patrimony_setor" type="text" class="form-control form-control-sm text-center" placeholder="R$..." >
                    </div>
                </div><!--End div hidden 3 -->

                <div class="row form-hide" style="display: none;"><!--Start div hidden 4-->
                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                        <label for="patrimony_info">Observações:</label>
                        <textarea id="patrimony_obs" class="form-control" name="patrimony_obs" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..." ></textarea>
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
                <input type="text" class="search form-control disable-focus" id="keywords" placeholder="Buscar por: Código ou Descrição..." onkeyup="objFinanca.ajaxFilter();">
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
            <option value="active">Ativo</option>
            <option value="inactive">Inativo</option>
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
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Código:</b>&nbsp;<span class="patrimony_cod">----</span></li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Descrição:</b>&nbsp;<span class="patrimony_desc">----</span> </li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Data de aquisisção:</b>&nbsp;<span class="patrimony_data_aq"></span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Cor:</b>&nbsp;<span class="patrimony_cor">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Fornecedor:</b>&nbsp;<span class="patrimony_for">----</span></li>
                    <li class="list-group-item list-group-item-info list-group-item-text"><b>Dimensão:</b>&nbsp;<span class="patrimony_dimen">----</span></li>
                    <li class="list-group-item list-group-item-light list-group-item-text"><b>Setor:</b>&nbsp;<span class="patrimony_setor">----</span></li>
                    <li class="list-group-item list-group-item-dark list-group-item-text"><b>Valor:</b>&nbsp;<span class="patrimony_valor"></span></li> 
                    <li class="list-group-item list-group-item-text"><b>Garantia:</b>&nbsp;<span class="patrimony_nation">----</span></li>
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Quantidade:</b>&nbsp;<span class="patrimony_quant">----</span> </li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Nota fiscal:</b>&nbsp;<span class="patrimony_nf"></span></li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Observações:</b>&nbsp;<span class="patrimony_obs">----</span></li>
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
