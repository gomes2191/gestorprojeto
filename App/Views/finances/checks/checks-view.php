        <?php
        if (!defined('Config::HOME_URI')) {
            exit();
        }

        if (filter_input(INPUT_GET, 're', FILTER_DEFAULT)) {
            $encode_id = filter_input(INPUT_GET, 're', FILTER_DEFAULT);
            //var_dump($encode_id);die;
            $modelo->delRegister($encode_id);

            # Destroy variavel não mais utilizadas
            unset($encode_id);
        }
        # Verifica se existe a requisição POST se existir executa o método se não faz nada
        (filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : FALSE;

        # Paginação _parameters -------->
        $limit = 5;
        $pagConfig = [
            'totalRows' => COUNT($modelo->searchTable('checks')),
            'perPage'   => $limit,
            'link_func' => 'searchFilter'
        ];

        $pagination =  new Pagination($pagConfig);

        #-->
        $checks = $modelo->searchTable('checks', ['order_by' => 'checks_id DESC ', 'limit' => $limit]);

        # Verifica se existe feedback e retorna o feedback se sim se não retorna false
        $form_msg = $modelo->form_msg;

        //date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');
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
                        <legend>CONTROLE DE CHEQUES <span></span></legend>
                        <div class="row form-compact form-hide" style="display: none;">

                            <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                <label for="checks_holder">Titular:</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></div>
                                    <input type="hidden" id="checks_id" name="checks_id" value="">
                                    <input id="checks_holder" name="checks_holder" style="border-radius: 0px !important;" type="text" class="form-control" placeholder="Nome do titular do cheque..." required="">
                                    <!--<div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>-->
                                </div>
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="checks_val">* Valor montante ( em reais )</label>
                                <div class="input-group">
                                    <div class="input-group-addon">R$</div>
                                    <input id="checks_val" name="checks_val" style="border-radius: 0px !important;" type="text" class="form-control" placeholder="0,00" onkeydown="objFinanca.moneyCash(this,28,event,2,'.',',');">
                                    <div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>
                                </div>
                            </div>

                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="checks_cod"> Número do Cheque:</label>
                                <input id="checks_cod" name="checks_cod" class="form-control" type="text" placeholder="Número do cheque aqui..." value="">
                            </div>

                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="checks_bank">Banco:</label>
                                <input id="checks_bank" name="checks_bank" class="form-control" type="text" placeholder="Nome do banco..." value="">

                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="checks_agency">Número da Agência:</label>
                                <input id="checks_agency" name="checks_agency" class="form-control" type="text" placeholder="Nome do banco..." value="">
                            </div>
                        </div><!-- /End row--->

                        <div class="row form-compact row-button-hide" style="display: none;">
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="checks_date">Data de Compensação:</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                                    <input id="checks_date" name="checks_date" style="border-radius: 0px !important;" type="text" class="form-control dateTime" placeholder="dd/mm/aaaa">
                                    <!--<div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>-->
                                </div>
                            </div>

                            <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                <label for="checks_received">* Recebido de:</label>
                                <input id="checks_received" name="checks_received" class="form-control" type="text" placeholder="Descreva as informações aqui..." value="">
                                <br>
                            </div>

                            <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                <label for="checks_forwarded">Encaminhado para:</label>
                                <input id="checks_forwarded" name="checks_forwarded" class="form-control" type="text" placeholder="Descreva as informações aqui..." value="">
                                <br>
                            </div>

                            <br>
                            <div class="form-group col-md-5 col-sm-12 col-xs-12">
                                <div id="group-btn-save" class="btn-group">
                                    <button id="btn-save" title="Salvar informações" class="btn btn-sm btn-default" type="button"></button>
                                </div>
                                <div id="group-btn-reset" class="btn-group">
                                    <button title="Limpar formulário" class="btn btn-sm btn-default marg-top fees-clear" type="reset"><i class="text-warning glyphicon glyphicon-erase"></i> <span class="text-warning">LIMPAR</span></button>
                                </div>
                                <div id="group-btn-form-new" class="btn-group" style="display:none;">
                                    <button id="btn-form-new" title="Inserir nova conta a pagar" class="btn btn-sm btn-default marg-top" type="reset"><i class="text-primary glyphicon glyphicon-plus"></i> <span class="text-primary">MODO NOVO REGISTRO</span></button>
                                </div>
                            </div>
                        </div>

                        <div class="row form-compact">
                            <div class="form-group col-md-5 col-sm-12 col-xs-12">
                                <div id="group-btn-new" class="btn-group">
                                    <button id="btn-new-show" title="Insere novo registro" class="btn btn-sm btn-default marg-top" type="reset">
                                        <i class="glyphicon glyphicon-plus text-primary"></i> <span class="text-primary">NOVO REGISTRO</span>
                                    </button>
                                </div>
                                <div id="group-btn-show" style="display: none;" class="btn-group">
                                    <button id="btn-show" title="Mostrar formulário" class="btn btn-sm btn-default marg-top" type="reset">
                                        <i class="glyphicon glyphicon-eye-open"></i> Mostrar Formulário
                                    </button>
                                </div>
                                <div id="group-btn-hide" style="display: none;" class="btn-group">
                                    <button id="btn-hide" title="Ocultar formulário" class="btn btn-sm btn-default marg-top" type="reset"><i class="glyphicon glyphicon-eye-close"></i> OCULTAR FORMULÁRIO</button>
                                </div>
                            </div>
                        </div><!-- /End row-->
                    </fieldset>
                </form>
            </div>
        </div><!-- End row container -->
        <?php if (!empty($checks)) { ?>
            <div id="filtros" class="row">
                <div class="form-group col-md-4 col-sm-10 col-xs-12">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-search text-primary" title="Efetue um pesqisa no sistema." aria-hidden="true"></i>
                        </div>
                        <input style="border-radius: 0px !important;" type="text" class="search form-control " id="keywords" placeholder="Buscar por: Descrição ou Data de Vencimento..." onkeyup="objFinanca.ajaxFilter();">
                    </div>
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
                    <select id="sortBy" class="form-control" onchange="objFinanca.ajaxFilter();">
                        <option value="">Ordenar Por</option>
                        <option value="asc">Ascendente</option>
                        <option value="desc">descendente</option>
                        <option value="active">Pago</option>
                        <option value="inactive">Não Pago</option>
                    </select>
                </div>
                <!--/End col-->
            </div><!-- End row filtros -->

        <?php } ?>
        <div class="row">
            <div class="col-md-12  col-sm-12 col-xs-12">
                <div id="tableData" class="table-responsive" style="border: none;">

                </div>
            </div>
        </div><!-- /End row table -->

        <!-- Start Modal Informações de pagamentos -->
        <div id="inforView" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <!--Conteudo do modal-->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> INFORMAÇÕES</h4>
                    </div>
                    <div class="modal-body">
                        <ul class="list-inline list-modal-forn">
                            <li class="list-group-item list-group-item-info list-group-item-text"><b>Titular: </b> <span class="checks_holder">---</span></li>
                            <li class="list-group-item list-group-item-warning list-group-item-text"><b>Valor: </b> <span class="checks_val">----</span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Código: </b> <span class="checks_cod">----</span> </li>
                            <li class="list-group-item list-group-item-info list-group-item-text"><b>Banco: </b> <span class="checks_bank"></span></li>
                            <li class="list-group-item list-group-item-warning list-group-item-text"><b>Agência: </b> <span class="checks_agency">----</span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Data de Compensação: </b> <span class="checks_created">----</span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Recebido de: </b> <span class="checks_received">----</span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Encaminhado para: </b> <span class="checks_forwarded">----</span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Data da inclusão: </b> <span class="checks_status">----</span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Modificado em: </b> <span class="checks_status">----</span></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Fechar X</button>
                    </div>
                </div>
            </div>
        </div><!-- End modal visualizar -->

        <script>
            //Setando valores do ajax
            var objFinanca = new Financeiro();
            objFinanca.setAjaxData('finances-checks/filters');
            objFinanca.ajaxData();
            objFinanca.getAjaxData();

            //  Muda url da pagina
            //  window.history.pushState("fees", "", "fees");
            //  Faz um refresh de url apos fechar modal
            //$(function () {
            //    $('body').on('hidden.bs.modal', function () {
            //        $(this).removeData('bs.modal');
            //    });
            //});

            // Invoca a edição de registro
            function editRegister(id) {
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '<?= HOME_URI; ?>/finances-checks/ajax-process',
                    data: 'action_type=data&id=' + id,
                    async: true,
                    success: function(result) {
                        $('#checks_id').val(result.checks_id);
                        $('#checks_holder').val(result.checks_holder);
                        $('#checks_val').val(result.checks_val);
                        $('#checks_cod').val(result.checks_cod);
                        $('#checks_bank').val(result.checks_bank);
                        $('#checks_agency').val(result.checks_agency);
                        $('#checks_date').val(result.checks_date);
                        $('#checks_received').val(result.checks_received);
                        $('#checks_forwarded').val(result.checks_forwarded);
                    }
                });
            }

            //Açoes de remoção e inserção
            function userAction(type, id) {
                id = (typeof id === "undefined") ? '' : id;
                //var statusArr = {add:"added",edit:"updated",delete:"deleted"};
                var userData = '';
                if (type === 'add') {
                    userData = $("#addForm").serialize() + '&action_type=' + type + '&id=' + id;
                    feedback = 'Inserido com sucesso!';
                } else if (type === 'edit') {
                    userData = $("#editForm").serialize() + '&action_type=' + type;
                    feedback = 'Atualizado com sucessso!';
                } else {
                    if (confirm('Deseja remover esse registro?')) {
                        userData = 'action_type=' + type + '&id=' + id;
                        feedback = 'Remoção realizada com sucesso!';
                    } else {
                        return false;
                    }
                }
                $.ajax({
                    type: 'POST',
                    url: '<?= HOME_URI; ?>/finances-checks/ajax-process',
                    data: userData,
                    success: function(msg) {
                        objFinanca.ajaxData();
                        if (msg === 'ok') {
                            toastr.success(feedback, 'Sucesso!', {
                                timeOut: 5000
                            });

                            $('.form-register')[0].reset();
                        } else {
                            toastr.warning('Ocorreu algum problema, tente novamente', 'Erro!', {
                                timeOut: 5000
                            });
                        }
                    }
                });
            }
            // Invoca a visualização do registro
            function infoView(id) {
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '<?= HOME_URI; ?>/finances-checks/ajax-process',
                    data: 'action_type=data&id=' + id,
                    async: true,
                    success: function(data) {
                        $('.checks_holder').text((data.checks_holder) ? data.checks_holder : '---');
                        $('.checks_val').text((data.checks_val) ? data.checks_val : '---');
                        $('.checks_cod').text((data.checks_cod) ? data.checks_cod : '---');
                        $('.checks_bank').text((data.checks_bank) ? data.checks_bank : '---');
                        $('.checks_agency').text((data.checks_agency) ? data.checks_agency : '---');
                        $('.checks_date').text((data.checks_date) ? data.checks_date : ' ---');
                        $('.checks_received').text((data.checks_modified) ? data.checks_received : '---');
                        $('.checks_forwarded').text((data.checks_forwarded) ? data.checks_forwarded : '---');
                    }
                });
            }
        </script>