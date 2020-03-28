        <?php if (!defined('ABSPATH')) { exit(); }

            # Paginação parametros
            $limit = 5;

            # Realiza um consulta na base de dados e reatorna os valores
            $laboratorys = $modelo->searchTable('laboratory', ['order_by' => 'laboratory_id DESC ', 'limit' => $limit]);

            $pagConfig = [
                'totalRows' => COUNT($modelo->searchTable('laboratory')),
                'perPage' => $limit,
                'link_func' => 'searchFilter'
            ];

            $pagination = new Pagination($pagConfig);

            # Verifica se existe feedback e retorna o feedback se sim se não retorna false
            $form_msg = $modelo->form_msg;

            #date_default_timezone_set('America/Sao_Paulo');
            $date = (date('Y-m-d H:i'));
            date('Y-m-d H:i:s', time());
        ?>
        <div class="row">
            <div class="col-md-1  col-sm-0 col-xs-0"></div>
            <div class="col-md-10  col-sm-12 col-xs-12">
                <div id="loading" style="display: none;"><!--Loading.. este aqui-->
                    <ul class="bokeh">
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div><!--End loandind-->
            </div>
            <div class="col-md-1  col-sm-0 col-xs-0"></div>
        </div><!-- End row feedback -->
        
        <div class="row">
            <div class="form-group col-md-12 col-sm-12 col-xs-12"><!--Coluna principal do form start-->
                <form id="" enctype="multipart/form-data" class="form-register" data-id="" method="post" action="" role="form" >
                    <fieldset>
                        <legend >LABORATÓRIO <span class="text-success"></span></legend>
                        <div class="row form-hidden" style="display: none;"><!-- Start div hidden 1 -->
                            <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES DO LABORATÓRIO</small></div>
                        </div>    
                        <div class="row form-hidden" style="display: none;"><!-- Start div hidden 1 -->
                            <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                <label for="laboratory_name">Empresa:</label>
                                <input type="hidden" id="laboratory_id" name="laboratory_id" value="" >
                                <input id="laboratory_name" name="laboratory_name" type="text" class="form-control form-control-sm text-center" placeholder="Empresa" >
                                <div class="invalid-feedback">
                                    Preencha esse campo.
                                </div>
                            </div>

                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_cpf_cnpj">CPF/CNPJ:</label>
                                <input id="laboratory_cpf_cnpj" name="laboratory_cpf_cnpj" type="text" class="form-control form-control-sm text-center" placeholder="CPF/CNPJ" >
                                <div class="invalid-feedback">
                                    Preencha esse campo.
                                </div>
                            </div>

                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_rs">Razão social:</label>
                                <input id="laboratory_rs" name="laboratory_rs" class="form-control form-control-sm text-center" type="text" placeholder="Razão social" value="">
                            </div>

                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_at">Área de atuação:</label>
                                <input id="laboratory_at" name="laboratory_at" class="form-control form-control-sm text-center" type="text" placeholder="Área de Atuação" value="">
                            </div>
                            
                            <div class="form-group col-md-3 col-sm-12 col-xs-12" >
                                <label for="laboratory_end">Endereço:</label>
                                <input id="laboratory_end" name="laboratory_end" type="text" class="form-control form-control-sm text-center" placeholder="Endereço" >
                            </div>
                            
                        </div><!-- End div hidden 1 -->
                        
                        <div class="row form-hidden" style="display: none;"><!--Start div hidden 2-->
                            <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                <label for="laboratory_district">Bairro:</label>
                                <input id="laboratory_district" name="laboratory_district" type="text" class="form-control form-control-sm text-center" placeholder="Bairro..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_city">Cidade:</label>
                                <input id="laboratory_city" name="laboratory_city" type="text" class="form-control form-control-sm text-center" placeholder="Cidade" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_cep">CEP:</label>
                                <input id="laboratory_cep" name="laboratory_cep" type="text" class="form-control form-control-sm cep text-center" placeholder="00.000-000" >
                            </div>
                            <div class="form-group col-md-1 col-sm-12 col-xs-12">
                                <label for="laboratory_uf">UF:</label>
                                <input id="laboratory_uf" name="laboratory_uf" type="text" class="form-control form-control-sm uf text-center" placeholder="UF" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_nation">País:</label>
                                <input id="laboratory_nation" name="laboratory_nation" type="text" class="form-control form-control-sm text-center" placeholder="Nação" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_cel">Celular:</label>
                                <input id="laboratory_cel" name="laboratory_cel" type="text" class="form-control form-control-sm phone_cel text-center" placeholder="(00) 00000-0000" >
                            </div>
                        </div><!-- End row hidden 2 -->
                        
                        <div class="row form-hidden" style="display: none;"><!--Start div hidden 3-->
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_tel_1">Telefone 1:</label>
                                <input id="laboratory_tel_1" name="laboratory_tel_1" type="text" class="form-control form-control-sm phone_tel text-center" placeholder="(00) 00000-0000" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_tel_2">Telefone 2:</label>
                                <input id="laboratory_tel_2" name="laboratory_tel_2" type="text" class="form-control form-control-sm phone_tel text-center" placeholder="(00) 00000-0000" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_insc_uf">Inscrição Estadual:</label>
                                <input id="laboratory_insc_uf" name="laboratory_insc_uf" type="text" class="form-control form-control-sm text-center" placeholder="Inscrição estadual" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_email">E-mail:</label>
                                <input id="laboratory_email" name="laboratory_email" type="email" class="form-control form-control-sm text-center" placeholder="exemplo@email.com" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_web_url">Site:</label>
                                <input id="laboratory_web_url" name="laboratory_web_url" type="text" class="form-control form-control-sm text-center" placeholder="www.exemplo.com.br" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12" >
                                <label for="laboratory_sit">Situação:</label><br>
                                <select id="laboratory_sit" name="laboratory_sit" class="custom-select form-control-sm text-center">
                                    <option selected value="active">Ativo</option>
                                    <option value="inactive">Inativo</option>
                                </select>
                            </div>
                        </div><!-- End div hidden 3 -->
                        
                        <div class="row form-hidden" style="display: none;"><!-- Start div hidden 1 -->
                            <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES DO REPRESENTANTE - PESSOA DE CONTATO</small></div>
                        </div> 
                        
                        <div class="row form-hidden" style="display: none;"><!--Start div hidden 3-->
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_rep_nome">Nome:</label>
                                <input id="laboratory_rep_nome" name="laboratory_rep_nome" type="text" class="form-control form-control-sm text-center" placeholder="Nome" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_rep_apelido">Apelido:</label>
                                <input id="laboratory_rep_apelido" name="laboratory_rep_apelido" type="text" class="form-control form-control-sm text-center" placeholder="Apelido" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_rep_email">E-mail:</label>
                                <input id="laboratory_rep_email" name="laboratory_rep_email" type="email" class="form-control form-control-sm text-center" placeholder="exemplo@email.com" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_rep_cel">Celular:</label>
                                <input id="laboratory_rep_cel" name="laboratory_rep_cel" type="text" class="form-control form-control-sm phone_cel text-center" placeholder="(00) 00000-0000" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_rep_tel_1">Telefone 1:</label>
                                <input id="laboratory_rep_tel_1" name="laboratory_rep_tel_1" type="text" class="form-control form-control-sm phone_tel text-center" placeholder="(00) 00000-0000" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_rep_tel_2">Telefone 2:</label>
                                <input id="laboratory_rep_tel_2" name="laboratory_rep_tel_2" type="text" class="form-control form-control-sm phone_tel text-center" placeholder="(00) 00000-0000" >
                            </div>
                        </div><!-- End div hidden 3 -->
                        
                        <div class="row form-hidden" style="display: none;"><!-- Start div hidden 1 -->
                            <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES BANCÁRIAS</small></div>
                        </div> 
                        
                        <div class="row form-hidden" style="display: none;"><!--Start div hidden 4-->
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_banco_1">Banco 1:</label>
                                <input id="laboratory_banco_1" name="laboratory_banco_1" type="text" class="form-control form-control-sm text-center" placeholder="Banco" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_agencia_1">Agência 1:</label>
                                <input id="laboratory_agencia_1" name="laboratory_agencia_1" type="text" class="form-control form-control-sm text-center" placeholder="Agência" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_conta_1">Conta 1:</label>
                                <input id="laboratory_conta_1" name="laboratory_conta_1" type="text" class="form-control form-control-sm text-center" placeholder="Conta" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_titular_1">Titular 1:</label>
                                <input id="laboratory_titular_1" name="laboratory_titular_1" type="text" class="form-control form-control-sm text-center" placeholder="Titular" >
                            </div>
                        </div><!-- End div hidden 4 -->
                        
                        <div class="row form-hidden" style="display: none;"><!--Start div hidden 4-->
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_banco_2">Banco 2:</label>
                                <input id="laboratory_banco_2" name="laboratory_banco_2" type="text" class="form-control form-control-sm text-center" placeholder="Nome banco" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_agencia_2">Agência 2:</label>
                                <input id="laboratory_agencia_2" name="laboratory_agencia_2" type="text" class="form-control form-control-sm text-center" placeholder="Agência" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_conta_2">Conta 2:</label>
                                <input id="laboratory_conta_2" name="laboratory_conta_2" type="text" class="form-control form-control-sm text-center" placeholder="Conta" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="laboratory_titular_2">Titular 2:</label>
                                <input id="laboratory_titular_2" name="laboratory_titular_2" type="text" class="form-control form-control-sm text-center" placeholder="Titular" >
                            </div>
                        </div><!-- End div hidden 5 -->
                        
                        <div class="row form-hidden" style="display: none;"><!--Start div hidden 4-->
                            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                <label for="laboratory_obs">Observações:</label>
                                <textarea id="laboratory_obs" class="form-control" name="laboratory_obs" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..." ><?php echo htmlentities(chk_array($modelo->form_data, 'laboratory_obs')); ?></textarea>
                            </div>
                        </div><!-- End div hidden 6 -->
                        
                        <div class="row row-button-hidden" style="display: none;">
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
                                        <i class="text-primary glyphicon glyphicon-plus"></i> <span>MODO NOVO REGISTRO</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row" >
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
                    </fieldset>
                </form>
            </div>
        </div><!-- End row button new form -->
        
        <div id="filtros" class="row">
            <div class="form-group col-md-4 col-sm-10 col-xs-12">
                
                <div class="input-group">
                    <input type="text" class="form-control inputSearch" id="keywords" placeholder="Buscar por: Empresa ou CNPJ" onkeyup="objFinanca.ajaxFilter();">
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
        </div><!-- End row filtros -->
        
        <div class="row">
            <div class="col-md-12  col-sm-12 col-xs-12">
                <div id="tableData" class="table-responsive-sm" style="border: none;">
                    
                </div>
            </div>
        </div><!-- End row table -->
        <!-- Start Modal deletar fornecedores -->
        <div class="modal in fade"  role="dialog" id="dellReg">
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
                        <a href="javascript:void();" class="btn btn-danger delete-yes" >Eliminar</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Start Modal Informações -->
        <div id="inforView" class="modal fade" >
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
                            <li class="list-group-item list-group-item-success"><b>EMPRESA:</b>&nbsp;<span class="laboratory_name"></span></li> 
                            <li class="list-group-item list-group-item-secondary"><b>CPF / CNPJ:</b>&nbsp;<span class="laboratory_cpf_cnpj">----</span></li>
                            <li class="list-group-item list-group-item-info"><b>Razão social:</b>&nbsp;<span class="laboratory_rs">----</span> </li>
                            <li class="list-group-item list-group-item-warning"><b>Área de atuação:</b>&nbsp;<span class="laboratory_at"></span></li>
                            <li class="list-group-item list-group-item-danger"><b>Endereço:</b>&nbsp;<span class="laboratory_end">----</span></li>
                            <li class="list-group-item list-group-item-primary"><b>Bairro:</b>&nbsp;<span class="laboratory_district">----</span></li>
                            <li class="list-group-item list-group-item-dark"><b>Cidade:</b>&nbsp;<span class="laboratory_city">----</span></li>
                            <li class="list-group-item list-group-item-light"><b>UF:</b>&nbsp;<span class="laboratory_uf">----</span></li>
                            <li class="list-group-item list-group-item-success"><b>CEP:</b>&nbsp;<span class="laboratory_cep"></span></li> 
                            <li class="list-group-item list-group-item-secondary"><b>País:</b>&nbsp;<span class="laboratory_nation">----</span></li>
                            <li class="list-group-item list-group-item-info"><b>Celular:</b>&nbsp;<span class="laboratory_cel">----</span> </li>
                            <li class="list-group-item list-group-item-warning"><b>Telefone 1:</b>&nbsp;<span class="laboratory_tel_1"></span></li>
                            <li class="list-group-item list-group-item-danger"><b>Telefone 2:</b>&nbsp;<span class="laboratory_tel_2">----</span></li>
                            <li class="list-group-item list-group-item-primary"><b>Inscrição Estadual:</b>&nbsp;<span class="laboratory_insc_uf">----</span></li>
                            <li class="list-group-item list-group-item-dark"><b> Site url:</b>&nbsp;<span class="laboratory_web_url">----</span></li>
                            <li class="list-group-item list-group-item-light"><b>E-mail:</b>&nbsp;<span class="laboratory_email">----</span></li>
                            <li class="list-group-item list-group-item-success"><b>Nome do representante:</b>&nbsp;<span class="laboratory_rep_name">----</span></li>
                            <li class="list-group-item list-group-item-secondary"><b>Apelido representante:</b>&nbsp;<span class="laboratory_rep_apelido"></span></li> 
                            <li class="list-group-item list-group-item-info"><b>Representante celular:</b>&nbsp;<span class="laboratory_rep_cel">----</span></li>
                            <li class="list-group-item list-group-item-warning"><b>Representante telefone 1:</b>&nbsp;<span class="laboratory_rep_tel_1">----</span> </li>
                            <li class="list-group-item list-group-item-danger"><b>Representante telefone 2:</b>&nbsp;<span class="laboratory_rep_tel_2"></span></li>
                            <li class="list-group-item list-group-item-primary"><b>Representante E-mail:</b>&nbsp;<span class="laboratory_rep_email">----</span></li>
                            <li class="list-group-item list-group-item-dark"><b>Banco 1:</b>&nbsp;<span class="laboratory_banco_1">----</span></li>
                            <li class="list-group-item list-group-item-light"><b>Agência 1:</b>&nbsp;<span class="laboratory_agencia_1">----</span></li>
                            <li class="list-group-item list-group-item-success"><b>Conta 1:</b>&nbsp;<span class="laboratory_conta_1">----</span></li>
                            <li class="list-group-item list-group-item-secondary"><b>Titular 1:</b>&nbsp;<span class="laboratory_titular_1">----</span></li>
                            <li class="list-group-item list-group-item-info"><b>Banco 2:</b>&nbsp;<span class="laboratory_banco_2"></span></li> 
                            <li class="list-group-item list-group-item-warning"><b>Agência 2:</b>&nbsp;<span class="laboratory_agencia_2">----</span></li>
                            <li class="list-group-item list-group-item-danger"><b>Conta 2:</b>&nbsp;<span class="laboratory_conta_2">----</span> </li>
                            <li class="list-group-item list-group-item-primary"><b>Titular 2:</b>&nbsp;<span class="laboratory_titular_2"></span></li>
                            <li class="list-group-item list-group-item-dark"><b>Criado em:</b>&nbsp;<span class="laboratory_created">----</span></li>
                            <li class="list-group-item list-group-item-light"><b>Modificado em:</b>&nbsp;<span class="laboratory_modified">----</span></li>
                            <li class="list-group-item list-group-item-success"><b>Observações:</b>&nbsp;<span class="laboratory_obs">----</span></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar X</button>
                    </div>
                </div>
            </div>
        </div><!-- End modal visualizar -->
        <script>
            // Instância os objetos das classses
            var objMetodos = new Metodos();
            var objFinanca = new Financeiro();

            // Efetua a requisição ajax e retorna os registros
            objFinanca.setAjaxData(objSet = {url:'<?= HOME_URI; ?>/laboratory/filters', url_id: '/laboratory/', get_decode: false});
            objFinanca.ajaxData();
            objFinanca.getAjaxData();

            $('input').on('keydown keyup', function (){
               objMetodos.setVerify(arrayData = ['laboratory_name','laboratory_cpf_cnpj']);
               objMetodos.emptyVerify();
               objMetodos.getVerify();
            });

            // Tipo de ação disparada pelo usuário
            function typeAction( objAction ){     
                id = (typeof objAction.id === "undefined") ? '' : objAction.id;
                if(objAction.type === 'loadInfo' || objAction.type === 'loadEdit'){
                    typeExec = objAction.type;
                    if(objAction.type === 'loadEdit'){
                        objFinanca.setAjaxActionUser(objSet = {type: objAction.type, url:'<?= HOME_URI; ?>/laboratory/ajax-process', id:objAction.id});
                        objFinanca.ajaxActionUser();
                    }else{
                        objFinanca.setAjaxActionUser(objSet = {type: objAction.type, url:'<?= HOME_URI; ?>/laboratory/ajax-process', id:objAction.id});
                        objFinanca.ajaxActionUser();
                    }
                }else if ( objAction.type === 'add' ) {
                    if($('#laboratory_name').val() == '' || $('#laboratory_cpf_cnpj').val() == ''){
                        alert('Existem campos obrigatórios não preenchido.');
                    }else{
                        objAction.userData = $("#addForm").serialize()+'&action_type='+objAction.type+'&id='+id;
                        feedback = 'Inserido com sucesso!';
                        $('#filtros').show();
                        objFinanca.setAjaxActionUser( 
                            objSet = {type: objAction.type,
                            url:'<?= HOME_URI; ?>/laboratory/ajax-process',
                            userData:objAction.userData} 
                        );
                        objFinanca.ajaxActionUser();
                    }

                }else if( objAction.type === 'update' ){
                    objAction.userData = $("#editForm").serialize()+'&action_type='+objAction.type;
                    feedback = 'Atualizado com sucessso!';
                    objFinanca.setAjaxActionUser( 
                        objSet = {type: objAction.type,
                        url:'<?= HOME_URI; ?>/laboratory/ajax-process',
                        userData:objAction.userData} 
                    );
                     objFinanca.ajaxActionUser();
                }else if(objAction.type === 'delete') {
                    if(confirm('Deseja remover esse registro?')){
                        objAction.userData = 'action_type='+objAction.type+'&id='+objAction.id;
                        feedback = 'Remoção realizada com sucesso!';
                        objFinanca.setAjaxActionUser( 
                            objSet = {type: objAction.type,
                            url:'<?= HOME_URI; ?>/laboratory/ajax-process',
                            userData:objAction.userData} 
                        );
                        objFinanca.ajaxActionUser();
                    }else{
                        return false;
                    }   
                }
            }
        </script>
