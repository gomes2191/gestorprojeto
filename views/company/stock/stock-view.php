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
$stock = $modelo->searchTable('stock', ['order_by' => 'stock_id DESC ', 'limit' => $limit]);

$pagConfig = [
    'totalRows' => COUNT($modelo->searchTable('stock')),
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
                        <label for="stock_cod">Código:</label>
                        <input type="hidden" id="stock_id" name="stock_id" value="" >
                        <input id="stock_cod" name="stock_cod" type="text" class="form-control form-control-sm text-center" placeholder="Ex: G300, P20, M30..." >
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="stock_desc">Descrição do produto:</label>
                        <input id="stock_desc" name="stock_desc" type="text" class="form-control form-control-sm text-center" placeholder="Produto - Marca" >
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="stock_tipo_unit">Tipo unitário:</label><br>
                        <select id="stock_tipo_unit" name="stock_tipo_unit" class="custom-select form-control-sm">
                            <?php foreach ($modelo->get_table_data('*', 'stock_tipo_unitario', 'tipo_unitario_id') as $fetch_userdata): ?>
                                <option value="<?= $fetch_userdata['tipo_unitario']; ?>" <?= ($fetch_userdata['tipo_unitario'] == htmlentities(chk_array($modelo->form_data, 'stock_tipo_unit'))) ? 'selected' : ''; ?>><?= $fetch_userdata['tipo_unitario']; ?></option>
                            <?php endforeach; unset($fetch_userdata); ?>
                        </select>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="stock_forn">Fornecedor:</label>
                        <input id="stock_forn" name="stock_forn" class="form-control form-control-sm text-center" type="text" placeholder="Fornecedor..." value="">
                    </div>
                     <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="stock_inicial">Estoque inícial:</label>
                        <input id="stock_inicial" name="stock_inicial" type="text" class="form-control form-control-sm text-center" placeholder="100" >
                    </div>
                    
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="stock_minimo">Estoque mínimo:</label>
                        <input id="stock_minimo" name="stock_minimo" type="text" class="form-control form-control-sm text-center" placeholder="10" >
                    </div>
                </div><!-- End div hidden 2 -->

                <div class="row form-hide" style="display: none;"><!--Start div hidden 3-->
                    <div class="form-group col-md-2 col-sm-12 col-xs-12" >
                        <label for="stock_atual">Estoque atual:</label>
                        <input id="stock_atual" name="stock_atual" type="text" class="form-control form-control-sm text-center" placeholder="95" >
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="stock_prec">Preço:</label>
                        <input id="stock_prec" name="stock_prec" type="text" class="form-control form-control-sm text-center" placeholder="R$..." >
                    </div>
                </div><!--End div hidden 3 -->

                <div class="row form-hide" style="display: none;"><!--Start div hidden 4-->
                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                        <label for="stock_obs">Observações:</label>
                        <textarea id="stock_obs" class="form-control" name="stock_obs" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..." ></textarea>
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
            <!--<option value="active">Ativo</option>-->
            <!--<option value="inactive">Inativo</option>-->
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
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Código:</b>&nbsp;<span class="stock_cod">----</span></li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Descrição:</b>&nbsp;<span class="stock_desc">----</span> </li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Tipo unitário:</b>&nbsp;<span class="stock_tipo_unit"></span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Fornecedor:</b>&nbsp;<span class="stock_forn">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Stoque inicial:</b>&nbsp;<span class="stock_inicial">----</span></li>
                    <li class="list-group-item list-group-item-info list-group-item-text"><b>Stoque mínimo:</b>&nbsp;<span class="stock_minimo">----</span></li>
                    <li class="list-group-item list-group-item-light list-group-item-text"><b>Stoque atual:</b>&nbsp;<span class="stock_atual">----</span></li>
                    <li class="list-group-item list-group-item-dark list-group-item-text"><b>Preço:</b>&nbsp;<span class="stock_prec"></span></li> 
                    <li class="list-group-item list-group-item-text"><b>Observações:</b>&nbsp;<span class="stock_obs">----</span></li>
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Criado em::</b>&nbsp;<span class="stock_created">----</span> </li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Modificado em:</b>&nbsp;<span class="stock_modified"></span></li>
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
        objFinanca.setAjaxData('<?= HOME_URI; ?>/company-stock/filters');
        objFinanca.ajaxData();
        objFinanca.getAjaxData();

        //Tipo de ação desparada pelo usuário
        function typeAction(objData) {
            id = (typeof objData.id === "undefined") ? '' : objData.id;
            if (objData.type === 'loadInfo' || objData.type === 'loadEdit') {
                typeExec = objData.type;
                if (objData.type === 'loadEdit') {
                    objFinanca.setAjaxActionUser(objSet = {type: objData.type, url: '<?= HOME_URI; ?>/company-stock/ajax-process', id: objData.id});
                    objFinanca.ajaxActionUser();
                } else {
                    objFinanca.setAjaxActionUser(objSet = {type: objData.type, url: '<?= HOME_URI; ?>/company-stock/ajax-process', id: objData.id});
                    objFinanca.ajaxActionUser();
                }

            } else if (objData.type === 'add') {
                objData.userData = $("#addForm").serialize() + '&action_type=' + objData.type + '&id=' + id;
                feedback = 'Inserido com sucesso!';
                $('#filtros').show();
                objFinanca.setAjaxActionUser(
                    objSet = {type: objData.type,
                        url: '<?= HOME_URI; ?>/company-stock/ajax-process',
                        userData: objData.userData}
                );
                objFinanca.ajaxActionUser();
            } else if (objData.type === 'update') {
                objData.userData = $("#editForm").serialize() + '&action_type=' + objData.type;
                feedback = 'Atualizado com sucessso!';
                objFinanca.setAjaxActionUser(
                    objSet = {type: objData.type,
                        url: '<?= HOME_URI; ?>/company-stock/ajax-process',
                        userData: objData.userData}
                );
                objFinanca.ajaxActionUser();
            } else if (objData.type === 'delete') {
                if (confirm('Deseja remover esse registro?')) {
                    objData.userData = 'action_type=' + objData.type + '&id=' + objData.id;
                    feedback = 'Remoção realizada com sucesso!';
                    objFinanca.setAjaxActionUser(
                        objSet = {type: objData.type,
                            url: '<?= HOME_URI; ?>/company-stock/ajax-process',
                            userData: objData.userData}
                    );
                    objFinanca.ajaxActionUser();
                } else {
                    return false;
                }
            }
        }
    </script>
