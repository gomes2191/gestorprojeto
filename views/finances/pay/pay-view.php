        <?php
            if (!defined('ABSPATH')) {  exit(); }

            if (filter_input(INPUT_GET, 're', FILTER_DEFAULT)) {
                $encode_id = filter_input(INPUT_GET, 're', FILTER_DEFAULT);
                //var_dump($encode_id);die;
                $modelo->delRegister($encode_id);

                # Destroy variavel não mais utilizadas
                unset($encode_id);
            }
                # Verifica se existe a requisição POST se existir executa o método se não faz nada
                (filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : FALSE;

                # Paginação parametros-------->
                $limit = 5;
                $pagConfig = [
                    'totalRows' => COUNT($modelo->searchTable('bills_to_pay')),
                    'perPage'   => $limit,
                    'link_func' => 'searchFilter'];

                $pagination =  new Pagination($pagConfig);

                #-->
                $pays = $modelo->searchTable('bills_to_pay', ['order_by'=>'pay_id DESC ', 'limit'=>$limit]);

                # Verifica se existe feedback e retorna o feedback se sim se não retorna false
                $form_msg = $modelo->form_msg;

                //date_default_timezone_set('America/Sao_Paulo');
                $date = date('Y-m-d H:i');
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
                        <legend >CONTAS A PAGAR <span></span></legend>
                        <div class="row form-compact form-hide" style="display: none;">
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="pay_venc">Data de vencimento:</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                                    <input type="hidden" id="pay_id" name="pay_id" value="" >
                                    <input id="pay_venc" name="pay_venc" style="border-radius: 0px !important;" type="text" class="form-control data" placeholder="dd/mm/aaaa" >
                                    <!--<div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>-->
                                </div>
                                <br>
                            </div>

                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="pay_date_pay">Data de pagamento:</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                                    <input id="pay_date_pay" name="pay_date_pay" style="border-radius: 0px !important;" type="text" class="form-control data" placeholder="dd/mm/aaaa" >
                                    <!--<div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>-->
                                </div>
                                <br>
                            </div>

                            <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                <label for="pay_desc"> Descrição:</label>
                                <input id="pay_desc" name="pay_desc" class="form-control" type="text" placeholder="Descreva as informações aqui..." value="">
                                <br>
                            </div>

                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="pay_cat">Categoria:</label>
                                <select id="pay_cat" name="pay_cat" class="form-control">
                                    <option>Teste 1</option>
                                    <option>Teste 2</option>
                                </select>
                                <br>
                            </div>
                            <div class="form-group col-md-2 col-sm-12 col-xs-12" >
                                <label for="pay_val">Valor montante ( em reais )</label>
                                <div class="input-group">
                                    <div class="input-group-addon">R$</div>
                                    <input id="pay_val" name="pay_val" style="border-radius: 0px !important;" type="text" class="form-control" placeholder="0,00" onkeydown="objFinanca.moneyCash(this,28,event,2,'.',',');" >
                                    <div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>
                                </div>
                                <br>
                            </div>
                            <br>
                        </div>
                        <div class="row form-compact row-button-hide" style="display: none;">
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

                        <div class="row form-compact" >
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
                        </div>
                    </fieldset>
                </form>
            </div>
        </div><!-- End row button new form -->
        <?php if (!empty($pays)) { ?>
        <div id="filtros" class="row">
            <div class="form-group col-md-4 col-sm-10 col-xs-12">
                <div class="input-group">
                    <div class="input-group-addon" >
                        <i class="glyphicon glyphicon-search text-primary" title="Efetue um pesqisa no sistema." aria-hidden="true"></i>
                    </div>
                    <input style="border-radius: 0px !important;" type="text" class="search form-control " id="keywords" placeholder="Buscar por: Descrição ou Data de Vencimento..." onkeyup="objFinanca.ajaxFilter();">
                </div>
            </div><!--/End col-->

            <div class="col-md-5 col-sm-0 col-xs-0"></div><!--End/-->

            <div class="form-group col-md-1  col-sm-3 col-xs-12">
                <div class="input-group">
                    <input type="text" class="text-center form-control" id="qtdLine"  placeholder="5" onkeyup="objFinanca.ajaxFilter();" data-toggle="tooltip" data-placement="bottom" title="Quantidade de registro por página de 1 até 50." >
                </div>
            </div><!--/End col-->

            <div class="form-group col-md-2  col-sm-3 col-xs-12">
                <select id="sortBy" class="form-control" onchange="objFinanca.ajaxFilter();">
                    <option value="">Ordenar Por</option>
                    <option value="asc">Ascendente</option>
                    <option value="desc">descendente</option>
                    <option value="active">Pago</option>
                    <option value="inactive">Não Pago</option>
                </select>
            </div><!--/End col-->
        </div><!-- End row filtros -->
        
        <?php } ?>
        <div class="row">
            <div class="col-md-12  col-sm-12 col-xs-12">
                <div id="tableData" class="table-responsive" style="border: none;">
                    
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

        <!-- Start Modal Informações de pagamentos -->
        <div id="inforView" class="modal fade" >
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
                            <li class="list-group-item list-group-item-info list-group-item-text"><b>Data De Vencimento: </b> <span class="pay_venc">---</span></li> 
                            <li class="list-group-item list-group-item-warning list-group-item-text"><b>Data de Pagamento: </b> <span class="pay_date_pay ">----</span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Categoria: </b> <span class="pay_cat">----</span> </li>
                            <li class="list-group-item list-group-item-info list-group-item-text"><b>Descrição: </b> <span class="pay_desc"></span></li>
                            <li class="list-group-item list-group-item-warning list-group-item-text"><b>Valor: </b> <span class="pay_val">----</span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Data da Inclusao: </b> <span class="pay_created">----</span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Modificado Em: </b> <span class="pay_modified">----</span></li>
                            <li class="list-group-item list-group-item-success list-group-item-text"><b>Status: </b> <span class="pay_status">----</span></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar X</button>
                    </div>
                </div>
            </div>
        </div><!-- End modal visualizar -->
        
        <!-- Modal editar inserir -->
        <div class="modal fade" id="modalForm" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Fechar X</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Contact Form</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form class="form" role="form">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control" id="inputName" placeholder="Enter your name"/>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email"/>
                            </div>
                            <div class="form-group">
                                <label for="inputMessage">Message</label>
                                <textarea class="form-control" id="inputMessage" placeholder="Enter your message"></textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <a href="JavaScript:void(0);" class="btn btn-success" onclick="userAction('add')">Add User</a>
                    </div>
                </div>
            </div>
        </div><!--End modal editar inserir-->
        <script>
            //Setando valores do ajax
            var objFinanca = new Financeiro();
            objFinanca.setAjaxData('finances-pay/filters');
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
            function editRegister( id ){
               $.ajax({
                    type: 'POST',
                    dataType:'JSON',
                    url: '<?=HOME_URI;?>/finances-pay/ajax-process',
                    data: 'action_type=data&id='+id,
                    async: true,
                    success:function(result) {
                        document.getElementById('pay_id').value = result.pay_id;
                        document.getElementById('pay_venc').value = result.pay_venc;
                        document.getElementById('pay_date_pay').value = result.pay_date_pay;
                        document.getElementById('pay_desc').value = result.pay_desc;
                        document.getElementById('pay_cat').value = result.pay_cat;
                        document.getElementById('pay_val').value = result.pay_val;
                    }
                });
            }
            
            //Açoes de remoção e inserção
            function userAction(type,id){
                id = (typeof id === "undefined") ? '' : id;
                //var statusArr = {add:"added",edit:"updated",delete:"deleted"};
                var userData = '';
                if (type === 'add') {
                    userData = $("#addForm").serialize()+'&action_type='+type+'&id='+id;
                    feedback = 'Inserido com sucesso!';
                }else if (type === 'edit'){
                    userData = $("#editForm").serialize()+'&action_type='+type;
                    feedback = 'Atualizado com sucessso!';
                }else{
                    if(confirm('Deseja remover esse registro?')){
                        userData = 'action_type='+type+'&id='+id;
                        feedback = 'Remoção realizada com sucesso!';
                    }else{
                        return false;
                    }   
                }
                $.ajax({
                    type: 'POST',
                    url: '<?= HOME_URI; ?>/finances-pay/ajax-process',
                    data: userData,
                    success:function(msg){
                        objFinanca.ajaxData();
                        if(msg === 'ok'){
                            toastr.success(feedback, 'Sucesso!', {timeOut: 5000});
                            $('.form-register')[0].reset();
                        }else{
                            toastr.warning('Ocorreu algum problema, tente novamente', 'Erro!', {timeOut: 5000});
                        }
                    }
                });
            }
            // Invoca a visualização do registro
            function infoView(id){
                $.ajax({
                    type: 'POST',
                    dataType:'JSON',
                    url: '<?=HOME_URI;?>/finances-pay/ajax-process',
                    data: 'action_type=data&id='+id,
                    success:function(data){
                        console.log(data.pay_date_pay);
                        $('.pay_venc').text(data.pay_venc);
                        $('.pay_date_pay').text(data.pay_date_pay);
                        $('.pay_cat').text(data.pay_cat);
                        $('.pay_desc').text(data.pay_desc);
                        $('.pay_val').text(data.pay_val);
                        $('.pay_created').text(data.pay_created);
                        $('.pay_modified').text(data.pay_modified);
                        $('.pay_status').text((data.pay_date_pay) ? 'Pago' : 'Em débito');
                        //$('#editForm').slideDown();
                    }
                });
            }
            
        </script>