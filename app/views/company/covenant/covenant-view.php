<?php if (!defined('ABSPATH')) { exit(); }
    # Paginação parametros
    $limit = 5;

    # Realiza um consulta na base de dados e reatorna os valores
    $covenants = $modelo->searchTable('covenant', ['order_by' => 'covenant_id DESC ', 'limit' => $limit]);

    $pagConfig = [
        'totalRows' => COUNT($covenants),
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
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <form id="" enctype="multipart/form-data" class="form-register" data-id="" method="post" action="" role="form" >
                    <fieldset>
                        <legend >CONVÊNIO / PLANOS <span class="text-success"></span></legend>
                        <div class="row form-hide" style="display: none;"><!-- Start div hidden 1 -->
                            <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES DO CONVÊNIO</small></div>
                        </div>    
                        <div class="row form-hide" style="display: none;"><!-- Start div hidden 1 -->
                            <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                <label for="covenant_name">Empresa:</label>
                                <input type="hidden" id="covenant_id" name="covenant_id" value="" >
                                <input id="covenant_name" name="covenant_name" type="text" class="form-control form-control-sm" placeholder="Nome da empresa..." >
                                <div class="invalid-feedback">
                                    Preencha esse campo.
                                </div>
                            </div>

                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_cpf_cnpj">CPF/CNPJ:</label>
                                <input id="covenant_cpf_cnpj" name="covenant_cpf_cnpj" type="text" class="form-control form-control-sm" placeholder="CPF/CNPJ" >
                                <div class="invalid-feedback">
                                    Preencha esse campo.
                                </div>
                            </div>

                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_rs">Razão social:</label>
                                <input id="covenant_rs" name="covenant_rs" class="form-control form-control-sm" type="text" placeholder="Razão social..." value="">
                            </div>

                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_at">Área de atuação:</label>
                                <input id="covenant_at" name="covenant_at" class="form-control form-control-sm" type="text" placeholder="Área de atuação..." value="">
                            </div>
                            <div class="form-group col-md-3 col-sm-12 col-xs-12" >
                                <label for="covenant_end">Endereço:</label>
                                <input id="covenant_end" name="covenant_end" type="text" class="form-control form-control-sm" placeholder="Endereço..." >
                            </div>
                        </div><!-- End div hidden 1 -->
                        
                        <div class="row form-hide" style="display: none;"><!--Start div hidden 2-->
                            <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                <label for="covenant_district">Bairro:</label>
                                <input id="covenant_district" name="covenant_district" type="text" class="form-control form-control-sm" placeholder="Bairro..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_city">Cidade:</label>
                                <input id="covenant_city" name="covenant_city" type="text" class="form-control form-control-sm" placeholder="Cidade..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_cep">CEP:</label>
                                <input id="covenant_cep" name="covenant_cep" type="text" class="form-control form-control-sm cep" placeholder="00.000-000" >
                            </div>
                            <div class="form-group col-md-1 col-sm-12 col-xs-12">
                                <label for="covenant_uf">UF:</label>
                                <input id="covenant_uf" name="covenant_uf" type="text" class="form-control form-control-sm uf" placeholder="UF..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_nation">País:</label>
                                <input id="covenant_nation" name="covenant_nation" type="text" class="form-control form-control-sm" placeholder="País..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_cel">Celular:</label>
                                <input id="covenant_cel" name="covenant_cel" type="text" class="form-control form-control-sm tel" placeholder="(00) 00000-0000" >
                            </div>
                        </div><!-- End row hidden 2 -->
                        
                        <div class="row form-hide" style="display: none;"><!--Start div hidden 3-->
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_tel_1">Telefone 1:</label>
                                <input id="covenant_tel_1" name="covenant_tel_1" type="text" class="form-control form-control-sm tel" placeholder="(00) 00000-0000" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_tel_2">Telefone 2:</label>
                                <input id="covenant_tel_2" name="covenant_tel_2" type="text" class="form-control form-control-sm tel" placeholder="(00) 00000-0000" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_insc_uf">Inscrição Estadual:</label>
                                <input id="covenant_insc_uf" name="covenant_insc_uf" type="text" class="form-control form-control-sm" placeholder="Inscrição estadual..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_email">E-mail:</label>
                                <input id="covenant_email" name="covenant_email" type="email" class="form-control form-control-sm" placeholder="E-mail..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_web_url">Site:</label>
                                <input id="covenant_web_url" name="covenant_web_url" type="text" class="form-control form-control-sm" placeholder="Site da empresa..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12" >
                                <label for="covenant_sit">Situação:</label><br>
                                <select id="covenant_sit" name="covenant_sit" class="custom-select form-control-sm">
                                    <option selected value="active">Ativo</option>
                                    <option value="inactive">Inativo</option>
                                </select>
                            </div>
                        </div><!-- End div hidden 3 -->
                        
                        <div class="row form-hide" style="display: none;"><!-- Start div hidden 1 -->
                            <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES DO REPRESENTANTE - PESSOA DE CONTATO</small></div>
                        </div> 
                        
                        <div class="row form-hide" style="display: none;"><!--Start div hidden 3-->
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_rep_name">Nome:</label>
                                <input id="covenant_rep_name" name="covenant_rep_name" type="text" class="form-control form-control-sm" placeholder="Nome..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_rep_nick">Apelido:</label>
                                <input id="covenant_rep_nick" name="covenant_rep_nick" type="text" class="form-control form-control-sm" placeholder="Apelido..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_rep_email">E-mail:</label>
                                <input id="covenant_rep_email" name="covenant_rep_email" type="email" class="form-control form-control-sm" placeholder="E-mail..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_rep_cel">Celular:</label>
                                <input id="covenant_rep_cel" name="covenant_rep_cel" type="text" class="form-control form-control-sm tel" placeholder="(00) 00000-0000" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_rep_tel_1">Telefone 1:</label>
                                <input id="covenant_rep_tel_1" name="covenant_rep_tel_1" type="text" class="form-control form-control-sm tel" placeholder="(00) 00000-0000" >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_rep_tel_2">Telefone 2:</label>
                                <input id="covenant_rep_tel_2" name="covenant_rep_tel_2" type="text" class="form-control form-control-sm tel" placeholder="(00) 00000-0000" >
                            </div>
                        </div><!-- End div hidden 3 -->
                        
                        <div class="row form-hide" style="display: none;"><!-- Start div hidden 1 -->
                            <div class="col-md-12  col-sm-12 col-xs-12"><small class="text-muted">INFORMAÇÕES BANCÁRIAS</small></div>
                        </div> 
                        
                        <div class="row form-hide" style="display: none;"><!--Start div hidden 4-->
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_banco_1">Banco 1:</label>
                                <input id="covenant_banco_1" name="covenant_banco_1" type="text" class="form-control form-control-sm" placeholder="Nome banco..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_agencia_1">Agência 1:</label>
                                <input id="covenant_agencia_1" name="covenant_agencia_1" type="text" class="form-control form-control-sm" placeholder="Agência..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_conta_1">Conta 1:</label>
                                <input id="covenant_conta_1" name="covenant_conta_1" type="text" class="form-control form-control-sm" placeholder="Conta..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_titular_1">Titular 1:</label>
                                <input id="covenant_titular_1" name="covenant_titular_1" type="text" class="form-control form-control-sm" placeholder="Titular..." >
                            </div>
                        </div><!-- End div hidden 4 -->
                        
                        <div class="row form-hide" style="display: none;"><!--Start div hidden 4-->
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_banco_2">Banco 2:</label>
                                <input id="covenant_banco_2" name="covenant_banco_2" type="text" class="form-control form-control-sm" placeholder="Nome banco..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_agencia_2">Agência 2:</label>
                                <input id="covenant_agencia_2" name="covenant_agencia_2" type="text" class="form-control form-control-sm" placeholder="Agência..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_conta_2">Conta 2:</label>
                                <input id="covenant_conta_2" name="covenant_conta_2" type="text" class="form-control form-control-sm" placeholder="Conta..." >
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="covenant_titular_2">Titular 2:</label>
                                <input id="covenant_titular_2" name="covenant_titular_2" type="text" class="form-control form-control-sm" placeholder="Titular..." >
                            </div>
                        </div><!-- End div hidden 5 -->
                        
                        <div class="row form-hide" style="display: none;"><!--Start div hidden 4-->
                            <div class="form-group col-xs-12 col-sm-12 col-md-12">
                                <label for="covenant_obs">Observações:</label>
                                <textarea id="covenant_obs" class="form-control" name="covenant_obs" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..." ><?php echo htmlentities(chk_array($modelo->form_data, 'covenant_obs')); ?></textarea>
                            </div>
                        </div><!-- End div hidden 6 -->
                        
                        <div class="row form-compact row-button-hide" style="display: none;">
                            <div class="form-group col-md-5 col-sm-12 col-xs-12">
                                <div id="group-btn-save" class="btn-group">
                                    <button id="btn-save" title="Salvar informações" class="btn btn-outline-primary btn-sm" type="button"></button>
                                </div>
                                <div id="group-btn-reset" class="btn-group">
                                    <button title="Limpar formulário" class="btn btn-outline-warning btn-sm marg-top fees-clear" type="reset"><i class="fas fa-eraser fa-lg"></i> <span>LIMPAR</span></button>
                                </div>
                                <div id="group-btn-form-new" class="btn-group" style="display:none;">
                                    <button id="btn-form-new" title="Volta para o modo adicionar novo registro" class="btn btn-light btn-sm  marg-top" type="reset"><i class="fas  fa-plus fa-lg"></i> <span>MODO NOVO REGISTRO</span></button>
                                </div>
                            </div>
                        </div>

                        <div class="row form-compact" >
                            <div class="form-group col-md-5 col-sm-12 col-xs-12">
                                <div id="group-btn-new" class="btn-group">
                                    <button id="btn-new-show" title="Insere novo registro" class="btn btn-outline-primary btn-sm marg-top" type="reset">
                                        <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<span>ADICIONAR REGISTRO</span>
                                    </button>
                                </div>
                                <div id="group-btn-show" style="display: none;" class="btn-group">
                                    <button id="btn-show" title="Mostrar o formulário" class="btn btn-outline-success btn-sm marg-top" type="reset">
                                        <i class="fas fa-eye fa-lg"></i> ABRE FORMULÁRIO
                                    </button>
                                </div>
                                <div id="group-btn-hide" style="display: none;" class="btn-group">
                                    <button id="btn-hide" title="Esconde o formulário" class="btn top btn-outline-success btn-sm marg-top" type="reset"><i class="fas fa-eye-slash fa-lg"></i> FECHA FORMULÁRIO</button>
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
                    <input type="text" class="form-control search" id="keywords" placeholder="Buscar por: Descrição ou Data de Vencimento..." onkeyup="objFinanca.ajaxFilter();">
                    <div class="input-group-append">
                        <span class="input-group-text spanSearch">
                            <i class="fab fa-searchengin fa-lg"></i>
                        </span>
                    </div>
                </div><!-- End search engine-->
                
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
                            <li class="list-group-item list-group-item-text"><b>EMPRESA:</b>&nbsp;<span class="covenant_name"></span></li> 
                            <li class="list-group-item list-group-item-primary list-group-item-text"><b>CPF / CNPJ:</b>&nbsp;<span class="covenant_cpf_cnpj">----</span></li>
                            <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Razão social:</b>&nbsp;<span class="covenant_rs">----</span> </li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Área de atuação:</b>&nbsp;<span class="covenant_at"></span></li>
                            <li class="list-group-item list-group-item-danger list-group-item-text"><b>Endereço:</b>&nbsp;<span class="covenant_end">----</span></li>
                            <li class="list-group-item list-group-item-warning list-group-item-text"><b>Bairro:</b>&nbsp;<span class="covenant_district">----</span></li>
                            <li class="list-group-item list-group-item-info list-group-item-text"><b>Cidade:</b>&nbsp;<span class="covenant_city">----</span></li>
                            <li class="list-group-item list-group-item-light list-group-item-text"><b>UF:</b>&nbsp;<span class="covenant_uf">----</span></li>
                            <li class="list-group-item list-group-item-dark list-group-item-text"><b>CEP:</b>&nbsp;<span class="covenant_cep"></span></li> 
                            <li class="list-group-item list-group-item-text"><b>País:</b>&nbsp;<span class="covenant_nation">----</span></li>
                            <li class="list-group-item list-group-item-primary list-group-item-text"><b>Celular:</b>&nbsp;<span class="covenant_cel">----</span> </li>
                            <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Telefone 1:</b>&nbsp;<span class="covenant_tel_1"></span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Telefone 2:</b>&nbsp;<span class="covenant_tel_2">----</span></li>
                            <li class="list-group-item list-group-item-danger list-group-item-text"><b>Inscrição Estadual:</b>&nbsp;<span class="covenant_insc_uf">----</span></li>
                            <li class="list-group-item list-group-item-warning list-group-item-text"><b> Site url:</b>&nbsp;<span class="covenant_web_url">----</span></li>
                            <li class="list-group-item list-group-item-info list-group-item-text"><b>E-mail:</b>&nbsp;<span class="covenant_email">----</span></li>
                            <li class="list-group-item list-group-item-light list-group-item-text"><b>Nome do representante:</b>&nbsp;<span class="covenant_rep_name">----</span></li>
                            <li class="list-group-item list-group-item-dark list-group-item-text"><b>Apelido representante:</b>&nbsp;<span class="covenant_rep_apelido"></span></li> 
                            <li class="list-group-item list-group-item-text"><b>Representante celular:</b>&nbsp;<span class="covenant_rep_cel">----</span></li>
                            <li class="list-group-item list-group-item-primary list-group-item-text"><b>Representante telefone 1:</b>&nbsp;<span class="covenant_rep_tel_1">----</span> </li>
                            <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Representante telefone 2:</b>&nbsp;<span class="covenant_rep_tel_2"></span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Representante E-mail:</b>&nbsp;<span class="covenant_rep_email">----</span></li>
                            <li class="list-group-item list-group-item-danger list-group-item-text"><b>Banco 1:</b>&nbsp;<span class="covenant_banco_1">----</span></li>
                            <li class="list-group-item list-group-item-warning list-group-item-text"><b>Agência 1:</b>&nbsp;<span class="covenant_agencia_1">----</span></li>
                            <li class="list-group-item list-group-item-info list-group-item-text"><b>Conta 1:</b>&nbsp;<span class="covenant_conta_1">----</span></li>
                            <li class="list-group-item list-group-item-light list-group-item-text"><b>Titular 1:</b>&nbsp;<span class="covenant_titular_1">----</span></li>
                            <li class="list-group-item list-group-item-dark list-group-item-text"><b>Banco 2:</b>&nbsp;<span class="covenant_banco_2"></span></li> 
                            <li class="list-group-item list-group-item-text"><b>Agência 2:</b>&nbsp;<span class="covenant_agencia_2">----</span></li>
                            <li class="list-group-item list-group-item-primary list-group-item-text"><b>Conta 2:</b>&nbsp;<span class="covenant_conta_2">----</span> </li>
                            <li class="list-group-item list-group-item-secondary list-group-item-text"><b>Titular 2:</b>&nbsp;<span class="covenant_titular_2"></span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Criado em:</b>&nbsp;<span class="covenant_created">----</span></li>
                            <li class="list-group-item list-group-item-danger list-group-item-text"><b>Modificado em:</b>&nbsp;<span class="covenant_modified">----</span></li>
                            <li class="list-group-item list-group-item-warning list-group-item-text"><b>Observações:</b>&nbsp;<span class="covenant_obs">----</span></li>
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
            objFinanca.setAjaxData(objSet = {url:'<?= HOME_URI; ?>/covenant/filters', url_id: '/covenant/', get_decode: false});
            objFinanca.ajaxData();
            objFinanca.getAjaxData();
            
            
            $('input').on('keydown keyup', function (){
                objMetodos.setVerify(arrayData = ['covenant_name','covenant_cpf_cnpj']);
                objMetodos.emptyVerify();
                objMetodos.getVerify();
            });
            
            //Tipo de ação disparada pelo usuário
            function typeAction( objData ){     
                id = (typeof objData.id === "undefined") ? '' : objData.id;
                if(objData.type === 'loadInfo' || objData.type === 'loadEdit'){
                    typeExec = objData.type;
                    if(objData.type === 'loadEdit'){
                        objFinanca.setAjaxActionUser(objSet = {type: objData.type, url:'<?= HOME_URI; ?>/covenant/ajax-process', id:objData.id});
                        objFinanca.ajaxActionUser();
                    }else{
                        objFinanca.setAjaxActionUser(objSet = {type: objData.type, url:'<?= HOME_URI; ?>/covenant/ajax-process', id:objData.id});
                        objFinanca.ajaxActionUser();
                    }
                    
                }else if ( objData.type === 'add' ) {
                    
                    if($('#covenant_name').val() == '' || $('#covenant_cpf_cnpj').val() == ''){
                        alert('Existem campos obrigatórios não preenchido.');
                    }else{
                        objData.userData = $("#addForm").serialize()+'&action_type='+objData.type+'&id='+id;
                        feedback = 'Inserido com sucesso!';
                        $('#filtros').show();
                        objFinanca.setAjaxActionUser( 
                            objSet = {type: objData.type,
                            url:'<?= HOME_URI; ?>/covenant/ajax-process',
                            userData:objData.userData} 
                        );
                        objFinanca.ajaxActionUser();
                    }
                    
                }else if( objData.type === 'update' ){
                    objData.userData = $("#editForm").serialize()+'&action_type='+objData.type;
                    feedback = 'Atualizado com sucessso!';
                    objFinanca.setAjaxActionUser( 
                        objSet = {type: objData.type,
                        url:'<?= HOME_URI; ?>/covenant/ajax-process',
                        userData:objData.userData} 
                    );
                    objFinanca.ajaxActionUser();
                }else if(objData.type === 'delete') {
                    if(confirm('Deseja remover esse registro?')){
                        objData.userData = 'action_type='+objData.type+'&id='+objData.id;
                        feedback = 'Remoção realizada com sucesso!';
                        objFinanca.setAjaxActionUser( 
                            objSet = {type: objData.type,
                            url:'<?= HOME_URI; ?>/covenant/ajax-process',
                            userData:objData.userData} 
                        );
                        objFinanca.ajaxActionUser();
                    }else{
                        return false;
                    }   
                }
            }
        </script>
