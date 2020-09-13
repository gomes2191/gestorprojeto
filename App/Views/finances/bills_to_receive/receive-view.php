            <?php if (!defined('Config::HOME_URI')) {
                exit();
            }
            # Define o limite padrão de registro por página
            $limit = 5;

            # Monta os _parameters necessarios para a páginação
            $pagConfig = [
                'totalRows' => COUNT($modelo->searchTable('bills_to_receive', ['order_by' => 'receive_id DESC ', 'limit' => $limit])),
                'perPage'   => $limit,
                'link_func' => 'searchFilter'
            ];

            # Cria o objeto da classe páginação
            $pagination = new Pagination($pagConfig);

            date_default_timezone_set('America/Sao_Paulo');
            $date = (date('Y-m-d H:i'));
            date('Y-m-d H:i:s', time());
            ?>
            <div class="row">
                <!--Start row loading  -->
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
                    <form id="" enctype="multipart/form-data" class="form-register" data-id="" method="post" action="" role="form">
                        <fieldset>
                            <legend>CONTAS A RECEBER <span class="text-success"></span></legend>
                            <div class="row form-hidden" style="display: none;">
                                <!-- Start div hidden 1 -->
                                <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES DA CONTA</small></div>
                            </div><!-- End div hidden 1 -->
                            <div class="row form-hidden" style="display: none;">
                                <!-- Start div hidden 2 -->
                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="receive_cod">Código:</label>
                                    <input type="hidden" id="receive_id" name="receive_id" value="">
                                    <input id="receive_cod" name="receive_cod" type="text" class="form-control form-control-sm text-center" placeholder="GB0000">
                                    <div class="invalid-feedback">
                                        Preencha esse campo.
                                    </div>
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="receive_desc">Descrição:</label>
                                    <input id="receive_desc" name="receive_desc" type="text" class="form-control form-control-sm text-center" placeholder="Boleto - Luz">
                                    <div class="invalid-feedback">
                                        Preencha esse campo.
                                    </div>
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="receive_cat">Categoria:</label><br>
                                    <select id="receive_cat" name="receive_cat" class="custom-select form-control-sm">
                                        <option selected value="active">Ativo</option>
                                        <option value="inactive">Inativo</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="receive_venc">Data de vencimento:</label>
                                    <input id="receive_venc" name="receive_venc" class="form-control form-control-sm date text-center" type="text" placeholder="__/__/____" value="">
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="receive_date_receive">Data de pagamento:</label>
                                    <input id="receive_date_receive" name="receive_date_receive" class="form-control form-control-sm date text-center" type="text" placeholder="__/__/____" value="">
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="receive_value_real">Montante em R$:</label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">R$</span>
                                        </div>
                                        <input type="text" id="receive_value_real" class="form-control form-control-sm text-center money" name="receive_value_real" placeholder="0,00">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- End div hidden 2 -->

                            <div class="row form-hidden" style="display: none;">
                                <!--Start div hidden 3-->
                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="receive_perce">Desconto ( % ):</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" id="receive_perce" class="form-control form-control-sm number text-center" name="receive_perce" placeholder="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="receive_value_final">Valor final:</label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">R$</span>
                                        </div>
                                        <input type="text" id="receive_value_final" class="form-control form-control-sm text-center money" name="receive_value_final" placeholder="0,00" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="receive_sit">Situação:</label><br>
                                    <select id="receive_sit" name="receive_sit" class="custom-select form-control-sm">
                                        <option selected value="active">Pago</option>
                                        <option value="inactive">Não pago</option>
                                    </select>
                                </div>
                            </div>
                            <!--End div hidden 3 -->

                            <div class="row form-hidden" style="display: none;">
                                <!--Start div hidden 4-->
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                    <label for="receive_obs">Observações:</label>
                                    <textarea id="receive_obs" class="form-control" name="receive_obs" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..."></textarea>
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
                                <li class="list-group-item list-group-item-primary list-group-item-text"><b>Código:</b>&nbsp;<span class="receive_cod">----</span></li>
                                <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Descrição:</b>&nbsp;<span class="receive_desc">----</span> </li>
                                <li class="list-group-item list-group-item-success list-group-item-text"><b>Categoria:</b>&nbsp;<span class="receive_cat"></span></li>
                                <li class="list-group-item list-group-item-danger list-group-item-text"><b>Data de vencimento:</b>&nbsp;<span class="receive_venc">----</span></li>
                                <li class="list-group-item list-group-item-warning list-group-item-text"><b>Data de pagamento:</b>&nbsp;<span class="receive_date_receive">----</span></li>
                                <li class="list-group-item list-group-item-info list-group-item-text"><b>Valor real:</b>&nbsp;<span class="receive_value_real">----</span></li>
                                <li class="list-group-item list-group-item-light list-group-item-text"><b>Desconto:</b>&nbsp;<span class="receive_perce">----</span></li>
                                <li class="list-group-item list-group-item-dark list-group-item-text"><b>Valor final:</b>&nbsp;<span class="receive_value_final"></span></li>
                                <li class="list-group-item list-group-item-text"><b>Situação:</b>&nbsp;<span class="receive_sit">----</span></li>
                                <li class="list-group-item list-group-item-primary list-group-item-text"><b>Observação:</b>&nbsp;<span class="receive_obs">----</span> </li>
                                <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Criado em:</b>&nbsp;<span class="receive_created"></span></li>
                                <li class="list-group-item list-group-item-success list-group-item-text"><b>Modificado em:</b>&nbsp;<span class="receive_modified">----</span></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar X</button>
                        </div>
                    </div>
                </div>
            </div><!-- End modal infoView -->
            <script>
                // Instância os objetos das classses
                var objMetodos = new Metodos();
                var objFinanca = new Financeiro();

                // Efetua a requisição ajax e retorna os registros
                objFinanca.setAjaxData(objSet = {
                    url: '<?= HOME_URI; ?>/receive/filters',
                    url_id: '/receive/',
                    get_decode: false
                });
                objFinanca.ajaxData();
                objFinanca.getAjaxData();


                $('input').on('keydown keyup', function() {
                    objMetodos.setVerify(arrayData = ['receive_cod', 'receive_desc']);
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
                                url: '<?= HOME_URI; ?>/receive/ajax-process',
                                id: objAction.id
                            });
                            objFinanca.ajaxActionUser();
                        } else {
                            objFinanca.setAjaxActionUser(objSet = {
                                type: objAction.type,
                                url: '<?= HOME_URI; ?>/receive/ajax-process',
                                id: objAction.id
                            });
                            objFinanca.ajaxActionUser();
                        }
                    } else if (objAction.type === 'add') {
                        if ($('#receive_cod').val() == '' || $('#receive_desc').val() == '') {
                            alert('Existem campos obrigatórios não preenchido.');
                        } else {
                            objAction.userData = $("#addForm").serialize() + '&action_type=' + objAction.type + '&id=' + id;
                            feedback = 'Inserido com sucesso!';
                            $('#filtros').show();
                            objFinanca.setAjaxActionUser(
                                objSet = {
                                    type: objAction.type,
                                    url: '<?= HOME_URI; ?>/receive/ajax-process',
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
                                url: '<?= HOME_URI; ?>/receive/ajax-process',
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
                                    url: '<?= HOME_URI; ?>/receive/ajax-process',
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