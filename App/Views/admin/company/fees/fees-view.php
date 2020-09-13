<?php if (!defined('Config::HOME_URI')) {
    exit();
}
/* Estrutura que verifica se existe a requisição get e se existe valor se o valor
     * se o valor existir a mesma chega na base de dados se este valor existe
     * se não existir a mesma retorna para á página de convênio.
     */
if (filter_input(INPUT_GET, 'get_encode', FILTER_DEFAULT, TRUE) && $modelo->searchTable('covenant', ['where' => ['covenant_id' => (int) $modelo->encodeDecode(0, filter_input(INPUT_GET, 'get_encode', FILTER_DEFAULT, TRUE))]])) {
    $get_decode = (int) $modelo->encodeDecode(0, filter_input(INPUT_GET, 'get_encode', FILTER_DEFAULT, TRUE));
    $return = $modelo->searchTable('fees', ['where' => ['covenant_id' => $get_decode]]);
} else {
    echo '<script>window.location.href ="' . HOME_URI . '/covenant";</script>';
}

# Paginação _parameters
$limit = 5;

# Realiza um consulta na base de dados e reatorna os valores
//$feess = $modelo->searchTable('fees', ['order_by' => 'fees_id DESC ', 'limit' => $limit]);

$pagConfig = [
    'totalRows' => COUNT($return),
    'perPage' => $limit,
    'link_func' => 'searchFilter'
];

$pagination = new Pagination($pagConfig);

#date_default_timezone_set('America/Sao_Paulo');
$date = (date('Y-m-d H:i'));
date('Y-m-d H:i:s', time());
?>
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
        <!--End loandind-->
    </div>
    <div class="col-md-1  col-sm-0 col-xs-0"></div>
</div><!-- End row feedback -->

<div class="row">
    <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <form id="" enctype="multipart/form-data" class="form-register" data-id="" method="post" action="" role="form">
            <fieldset>
                <legend>HONORÁRIOS <span class="text-success"></span></legend>
                <div class="row form-hidden" style="display: none;">
                    <!-- Start div hidden 1 -->
                    <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES DO HONORÁRIOS</small></div>
                </div>
                <div class="row form-hidden" style="display: none;">
                    <!-- Start div hidden 1 -->
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="fees_cod">Código:</label>
                        <input type="hidden" id="fees_id" name="fees_id" value="">
                        <input id="fees_cod" name="fees_cod" type="text" class="form-control form-control-sm" placeholder="Código...">
                        <div class="invalid-feedback">
                            Preencha esse campo.
                        </div>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="fees_proc">Procedimento:</label>
                        <input id="fees_proc" name="fees_proc" type="text" class="form-control form-control-sm" placeholder="Tipo de procedimento...">
                        <div class="invalid-feedback">
                            Preencha esse campo.
                        </div>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="fees_cat">Categoria:</label><br>
                        <select id="fees_cat" name="fees_cat" class="custom-select form-control-sm">
                            <option selected>Tipo de categoria</option>
                            <option value="active">Ativo</option>
                            <option value="inactive">Inativo</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="fees_val_real">Valor real:</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            <input type="text" id="fees_val_real" class="form-control form-control-sm" name="fees_val_real" placeholder="0,00">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="fees_desc">Desconto ( % ):</label>
                        <div class="input-group input-group-sm">
                            <input type="text" id="fees_desc" class="form-control form-control-sm" name="fees_desc" placeholder="0,00">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="fees_val_final">Valor final:</label>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">R$</span>
                            </div>
                            <input type="text" id="fees_val_final" class="form-control form-control-sm" name="fees_val_final" placeholder="0,00">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End div hidden 1 -->
                <div class="row form-hidden" style="display: none;">
                    <!--Start div hidden 4-->
                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                        <label for="fees_obs">Observações:</label>
                        <textarea id="fees_obs" class="form-control" name="fees_obs" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..."><?php echo htmlentities(chkArray($modelo->form_data, 'fees_obs')); ?></textarea>
                    </div>
                </div><!-- End div hidden 6 -->

                <div class="row form-compact row-button-hidden" style="display: none;">
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

                <div class="row form-compact">
                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <div id="group-btn-new" class="btn-group">
                            <button id="btn-new-show" title="Insere novo registro" class="btn btn-outline-primary btn-sm" type="reset">
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
            </fieldset>
        </form>
    </div>
</div><!-- End row button new form -->

<div id="filtros" class="row">
    <div class="form-group col-md-4 col-sm-10 col-xs-12">
        <div class="input-group">
            <input type="text" class="form-control search" id="keywords" placeholder="Buscar por: Código ou Procedimento..." onkeyup="objFinanca.ajaxFilter();">
            <div class="input-group-append">
                <span class="input-group-text spanSearch">
                    <i class="fab fa-searchengin fa-lg"></i>
                </span>
            </div>
        </div><!-- End search engine-->
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
            <option value="desc">Descendente</option>
        </select>
    </div>
    <!--/End col-->
</div><!-- End row filtros -->

<div class="row">
    <div class="col-md-12  col-sm-12 col-xs-12">
        <div id="tableData" class="table-responsive-sm" style="border: none;">

        </div>
    </div>
</div><!-- End row table -->
<!-- Start Modal deletar fornecedores -->
<div class="modal in fade" role="dialog" id="dellReg">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><span class=" info glyphicon glyphicon-floppy-remove">&nbsp;</span>ELIMINAR REGISTRO</h5>
            </div>
            <div class="modal-body">
                <p class="text-justify">Tem certeza que deseja remover este registro? não sera possível reverter isso.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a href="javascript:void();" class="btn btn-danger delete-yes">Eliminar</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Start Modal Informações -->
<div id="inforView" class="modal fade">
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
                    <li class="list-group-item list-group-item-text"><b>Código:</b>&nbsp;<span class="fees_cod"></span></li>
                    <li class="list-group-item list-group-item-primary list-group-item-text"><b>Procedimento:</b>&nbsp;<span class="fees_proc">----</span></li>
                    <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Categoria:</b>&nbsp;<span class="fees_cat">----</span> </li>
                    <li class="list-group-item list-group-item-success list-group-item-text"><b>Valor real:</b>&nbsp;<span class="fees_val_real"></span></li>
                    <li class="list-group-item list-group-item-danger list-group-item-text"><b>Desconto:</b>&nbsp;<span class="fees_desc">----</span></li>
                    <li class="list-group-item list-group-item-warning list-group-item-text"><b>Valor final:</b>&nbsp;<span class="fees_val_real">----</span></li>
                    <li class="list-group-item list-group-item-info list-group-item-text"><b>Observações:</b>&nbsp;<span class="fees_obs">----</span></li>
                    <li class="list-group-item list-group-item-light list-group-item-text"><b>Data da criação:</b>&nbsp;<span class="fees_created">----</span></li>
                    <li class="list-group-item list-group-item-dark list-group-item-text"><b>Data da modificação:</b>&nbsp;<span class="fees_modified"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar X</button>
            </div>
        </div>
    </div>
</div><!-- End modal visualizar -->
<script>
    var objMetodos = new Metodos();
    var objFinanca = new Financeiro();

    // Parâmetros necessários para a requisição Ajax
    objFinanca.setAjaxData(objSet = {
        url: '<?= HOME_URI; ?>/fees/filters',
        url_id: 'fees',
        get_decode: '<?= $get_decode; ?>'
    });
    objFinanca.ajaxData();
    objFinanca.getAjaxData();

    $('input').on('keydown keyup', function() {
        objMetodos.setVerify(arrayData = ['fees_cod', 'fees_proc']);
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
                    url: '<?= HOME_URI; ?>/fees/ajax-process',
                    id: objAction.id
                });
                objFinanca.ajaxActionUser();
            } else {
                objFinanca.setAjaxActionUser(objSet = {
                    type: objData.type,
                    url: '<?= HOME_URI; ?>/fees/ajax-process',
                    id: objAction.id
                });
                objFinanca.ajaxActionUser();
            }

        } else if (objAction.type === 'add') {

            if ($('#fees_cod').val() == '' || $('#fees_proc').val() == '') {
                alert('Existem campos obrigatórios não preenchido.');
            } else {
                objAction.userData = $("#addForm").serialize() + '&action_type=' + objAction.type + '&covenant_id=' + <?= $get_decode; ?> + '&id=' + id;
                feedback = 'Inserido com sucesso!';
                $('#filtros').show();
                objFinanca.setAjaxActionUser(
                    objSet = {
                        type: objAction.type,
                        url: '<?= HOME_URI; ?>/fees/ajax-process',
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
                    url: '<?= HOME_URI; ?>/fees/ajax-process',
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
                        url: '<?= HOME_URI; ?>/fees/ajax-process',
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