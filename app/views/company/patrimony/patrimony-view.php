            <?php   if (!defined('ABSPATH')) {  exit();  }
                # Define o limite padrão de registro por página
                $limit = 5;

                # Realiza uma consulta na base de dados e retorna todos os registro caso exista
                $patrimonys = $modelo->searchTable('patrimony', ['order_by' => 'patrimony_id DESC ', 'limit' => $limit]);

                # Monta os parametros necessarios para a páginação
                $pagConfig = [
                    'totalRows' => COUNT($patrimonys),
                    'perPage' => $limit,
                    'link_func' => 'searchFilter'
                ];

                # Cria o objeto da classe páginação
                $pagination = new Pagination($pagConfig);

                date_default_timezone_set('America/Sao_Paulo');
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
                            <div class="row form-hidden" style="display: none;"><!-- Start div hidden 1 -->
                                <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES DO PATRIMÔNIO</small></div>
                            </div><!-- End div hidden 1 -->
                            <div class="row form-hidden" style="display: none;"><!-- Start div hidden 2 -->
                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="patrimony_cod">Código:</label>
                                    <input type="hidden" id="patrimony_id" name="patrimony_id" value="" >
                                    <input id="patrimony_cod" name="patrimony_cod" type="text" class="form-control form-control-sm text-center" placeholder="GB-300" >
                                    <div class="invalid-feedback">
                                        Preencha esse campo.
                                    </div>
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="patrimony_desc">Descrição:</label>
                                    <input id="patrimony_desc" name="patrimony_desc" type="text" class="form-control form-control-sm text-center" placeholder="Ex: Cadeiras" >
                                    <div class="invalid-feedback">
                                        Preencha esse campo.
                                    </div>
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="patrimony_data_aq">Data da aquisição:</label>
                                    <input id="patrimony_data_aq" name="patrimony_data_aq" class="form-control form-control-sm data text-center" type="text" placeholder="__/__/____" value="">
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="patrimony_cor">Cor:</label>
                                    <input id="patrimony_cor" name="patrimony_cor" class="form-control form-control-sm text-center" type="text" placeholder="Ex: Preto" value="">
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12" >
                                    <label for="patrimony_for">Fornecedor:</label>
                                    <input id="patrimony_for" name="patrimony_for" type="text" class="form-control form-control-sm text-center" placeholder="Fornecedor..." >
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="patrimony_dimen">Dimensões:</label>
                                    <input id="patrimony_dimen" name="patrimony_dimen" type="text" class="form-control form-control-sm text-center" placeholder="Dimensões do patrimônio..." >
                                </div>

                            </div><!-- End div hidden 2 -->

                            <div class="row form-hidden" style="display: none;"><!--Start div hidden 3-->
                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="patrimony_setor">Setor:</label>
                                    <input id="patrimony_setor" name="patrimony_setor" type="text" class="form-control form-control-sm text-center" placeholder="Informática" >
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="patrimony_valor">Valor do patrimônio:</label>
                                    <input id="patrimony_valor" name="patrimony_valor" type="text" class="form-control form-control-sm text-center money" placeholder="100,00" >
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="patrimony_garan">Garantia:</label>
                                    <input id="patrimony_garan" name="patrimony_garan" type="text" class="form-control form-control-sm text-center" placeholder="2 - Anos" >
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="patrimony_quant">Quantidade:</label>
                                    <input id="patrimony_quant" name="patrimony_quant" type="text" class="form-control form-control-sm number text-center" placeholder="10" >
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label for="patrimony_nf">Nota fiscal:</label>
                                    <input id="patrimony_nf" name="patrimony_nf" type="text" class="form-control form-control-sm text-center" placeholder="Nota fiscal..." >
                                </div>

                                <div class="form-group col-md-2 col-sm-12 col-xs-12" >
                                    <label for="patrimony_sit">Situação:</label><br>
                                    <select id="patrimony_sit" name="patrimony_sit" class="custom-select form-control-sm">
                                        <option selected value="active">Ativo</option>
                                        <option value="inactive">Inativo</option>
                                    </select>
                                </div>
                            </div><!--End div hidden 3 -->

                            <div class="row form-hidden" style="display: none;"><!--Start div hidden 4-->
                                <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                    <label for="patrimony_obs">Observações:</label>
                                    <textarea id="patrimony_obs" class="form-control" name="patrimony_obs" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..." ></textarea>
                                </div>
                            </div><!--End div hidden 4 -->
                            <div class="row form-compact row-button-hidden" style="display: none;"><!--Start  div hidden button 1-->
                                <div class="form-group col-md-5 col-sm-12 col-xs-12">
                                    <div id="group-btn-save" class="btn-group">
                                        <button id="btn-save" title="Salvar informações" class="btn btn-outline-primary btn-sm" type="button"></button>
                                    </div>
                                    <div id="group-btn-reset" class="btn-group">
                                        <button title="Limpar formulário" class="btn btn-outline-warning btn-sm marg-top fees-clear" type="reset"><i class="fa fa-eraser"></i> <span>LIMPAR</span></button>
                                    </div>
                                    <div id="group-btn-form-new" class="btn-group" style="display:none;">
                                        <button id="btn-form-new" title="Volta para o modo adicionar novo registro" class="btn btn-outline-primary btn-sm" type="reset"><i class="text-primary glyphicon glyphicon-plus"></i> <span>MODO NOVO REGISTRO</span></button>
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
                                    <div id="group-btn-hidden" style="display: none;" class="btn-group">
                                        <button id="btn-hidden" title="Esconde o formulário" class="btn top btn-outline-success btn-sm marg-top" type="reset"><i class="fa fa-eye-slash"></i> FECHA FORMULÁRIO</button>
                                    </div>
                                </div>
                            </div><!--End div hidden button 2 -->
                        </fieldset>
                    </form>
                </div>
            </div><!--End row Form -->

            <div id="filtros" class="row"><!--Start row filtros-->
                <div class="form-group col-md-4 col-sm-10 col-xs-12">
                    
                    <div class="input-group">
                        <input type="text" class="form-control search" id="keywords" placeholder="Buscar por: Código ou Descrição" onkeyup="objFinanca.ajaxFilter();">
                        <div class="input-group-append">
                            <span class="input-group-text spanSearch">
                                <i class="fab fa-searchengin fa-lg"></i>
                            </span>
                        </div>
                    </div><!-- /End search engine-->
                    
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
                <script>
                    // Instância os objetos das classses
                    var objMetodos = new Metodos();
                    var objFinanca = new Financeiro();

                    // Efetua a requisição ajax e retorna os registros
                    objFinanca.setAjaxData(objSet = {url:'<?= HOME_URI; ?>/patrimony/filters', url_id: '/patrimony/', get_decode: false});
                    objFinanca.ajaxData();
                    objFinanca.getAjaxData();


                    $('input').on('keydown keyup', function (){
                       objMetodos.setVerify(arrayData = ['patrimony_cod','patrimony_desc']);
                       objMetodos.emptyVerify();
                       objMetodos.getVerify();
                    });

                    // Tipo de ação disparada pelo usuário
                    function typeAction( objData ){     
                        id = (typeof objData.id === "undefined") ? '' : objData.id;
                        if(objData.type === 'loadInfo' || objData.type === 'loadEdit'){
                            typeExec = objData.type;
                            if(objData.type === 'loadEdit'){
                                objFinanca.setAjaxActionUser(objSet = {type: objData.type, url:'<?= HOME_URI; ?>/patrimony/ajax-process', id:objData.id});
                                objFinanca.ajaxActionUser();
                            }else{
                                objFinanca.setAjaxActionUser(objSet = {type: objData.type, url:'<?= HOME_URI; ?>/patrimony/ajax-process', id:objData.id});
                                objFinanca.ajaxActionUser();
                            }
                        }else if ( objData.type === 'add' ) {
                            if($('#provider_name').val() == '' || $('#provider_cpf_cnpj').val() == ''){
                                alert('Existem campos obrigatórios não preenchido.');
                            }else{
                                objData.userData = $("#addForm").serialize()+'&action_type='+objData.type+'&id='+id;
                                feedback = 'Inserido com sucesso!';
                                $('#filtros').show();
                                objFinanca.setAjaxActionUser( 
                                    objSet = {type: objData.type,
                                    url:'<?= HOME_URI; ?>/patrimony/ajax-process',
                                    userData:objData.userData} 
                                );
                                objFinanca.ajaxActionUser();
                            }

                        }else if( objData.type === 'update' ){
                            objData.userData = $("#editForm").serialize()+'&action_type='+objData.type;
                            feedback = 'Atualizado com sucessso!';
                            objFinanca.setAjaxActionUser( 
                                objSet = {type: objData.type,
                                url:'<?= HOME_URI; ?>/patrimony/ajax-process',
                                userData:objData.userData} 
                            );
                             objFinanca.ajaxActionUser();
                        }else if(objData.type === 'delete') {
                            if(confirm('Deseja remover esse registro?')){
                                objData.userData = 'action_type='+objData.type+'&id='+objData.id;
                                feedback = 'Remoção realizada com sucesso!';
                                objFinanca.setAjaxActionUser( 
                                    objSet = {type: objData.type,
                                    url:'<?= HOME_URI; ?>/patrimony/ajax-process',
                                    userData:objData.userData} 
                                );
                                objFinanca.ajaxActionUser();
                            }else{
                                return false;
                            }   
                        }
                    }
                </script>
