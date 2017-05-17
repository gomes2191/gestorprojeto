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
                    'perPage' => $limit,
                    'link_func' => 'searchFilter'];

                $pagination =  new Pagination($pagConfig);

                #-->
                $pays = $modelo->searchTable('bills_to_pay', ['order_by'=>'pay_id DESC ', 'limit'=>$limit]);

                # Verifica se existe feedback e retorna o feedback se sim se não retorna false
                $form_msg = $modelo->form_msg;
        ?>
        <script>
            //  Muda url da pagina
            //  window.history.pushState("fees", "", "fees");
            //  Faz um refresh de url apos fechar modal
            $(function () {
                $('#dellReg').on('hidden.bs.modal', function () {
                    $(this).removeData('bs.modal');
                });
            });

            function searchFilter(page_num){
                page_num = page_num ? page_num : 0;

                var keywords = $('#keywords').val();
                var qtdLine = $('#qtdLine').val();
                var sortBy = $('#sortBy').val();

                //var keywords = $('#keywords').val();
                //var sortBy = $('#sortBy').val();
                $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    url: '<?=HOME_URI;?>/finances-pay/filters',
                    data: 'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&qtdLine='+qtdLine,
                    async: true,
                    beforeSend: function (){
                        $('#loading').show();
                    },
                    success: function ( data ){
                        $('#tableData').html( data );
                        $('#loading').fadeOut();
                    }
                });
            }
        </script>
        
        <div class="row">
            <div class="col-md-1  col-sm-0 col-xs-0"></div>
            <div class="col-md-10  col-sm-12 col-xs-12">
                <?php
                    if ($form_msg) {
                        echo'<div class="alert alertH ' . $form_msg[0] . '  alert-dismissible fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="' . $form_msg[1] . '" >&nbsp;</i>
                                <strong>' . $form_msg[2] . '</strong>&nbsp;' . $form_msg[3] . ' 
                            </div>';
                        unset($form_msg);
                    } else {
                        unset($form_msg);
                    }
                ?>
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
                <form id="form-register" enctype="multipart/form-data" data-id="" method="post" action="" role="form" >
                    <fieldset>
                        <legend >CONTAS A PAGAR</legend>
                        <div class="row notice-hide" style="display: none;">
                            <div class="col-md-5 col-sm-2 col-sx-12">
                                <div class="notice notice-sm">
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-10 col-sx-0"></div>
                        </div>
                        <div class="row form-compact form-hide" style="display: none;">
                            <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                <label for="pay_venc">Data de vencimento:</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
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
                                    <input id="pay_val" name="pay_val" style="border-radius: 0px !important;" type="text" class="form-control" placeholder="0,00" >
                                    <div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>
                                </div>
                                <br>
                            </div>
                            <br>
                        </div>

                        <div class="row form-compact row-button-hide" style="display: none;">
                            <div class="form-group col-md-5 col-sm-12 col-xs-12">
                                <div id="group-btn-save" class="btn-group">
                                    <button id="btn-save" title="Salvar informações" class="btn btn-sm btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-save"></i> Salvar</button>
                                </div>
                                <div id="group-btn-reset" class="btn-group">
                                    <button title="Limpar formulário" class="btn btn-sm btn-warning marg-top fees-clear" type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                                </div>
                                <div id="group-btn-form-new" class="btn-group" style="display:none;">
                                    <button title="Inserir nova conta a pagar" class="btn btn-sm btn-default marg-top btn-form-new" type="reset"><i class="glyphicon glyphicon-plus"></i> Novo registro</button>
                                </div>
                            </div>
                        </div>

                        <div class="row form-compact" >
                            <div class="form-group col-md-5 col-sm-12 col-xs-12">
                                <div id="group-btn-new" class="btn-group">
                                    <button id="btn-new-show" title="Insere novo registro" class="btn btn-sm btn-primary marg-top" type="reset">
                                        <i class="glyphicon glyphicon-plus"></i> Novo registro
                                    </button>
                                </div>
                                <div id="group-btn-show" class="btn-group">
                                    <button id="btn-show" title="Mostrar formulário" class="btn btn-sm btn-default marg-top" type="reset">
                                        <i class="glyphicon glyphicon-eye-open"></i> Mostrar formulário
                                    </button>
                                </div>
                                <div id="group-btn-hide" class="btn-group">
                                    <button id="btn-hide" title="Ocultar formulário" class="btn btn-sm btn-default marg-top" type="reset"><i class="glyphicon glyphicon-eye-close"></i> Ocultar Formulário</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div><!--End row button new form-->
        
        <div class="row">
            <div class="form-group col-md-4 col-sm-10 col-xs-12">
                <div class="input-group">
                    <input type="text" class="search form-control " id="keywords" placeholder="Buscar por: Descrição ou Data de Vencimento..." onkeyup="searchFilter()">
                    <span class="input-group-btn">
                        <button class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
            </div><!--/End col-->

            <div class="col-md-5 col-sm-0 col-xs-0"></div><!--End/-->

            <div class="form-group col-md-1  col-sm-3 col-xs-12">
                <input type="text" class="text-center form-control" id="qtdLine"  placeholder="5" onkeyup="searchFilter()" data-toggle="tooltip" data-placement="bottom" title="Quantidade de registro por página de 1 até 50." >
            </div><!--/End col-->

            <div class="form-group col-md-2  col-sm-3 col-xs-12">
                <select id="sortBy" class="form-control" onchange="searchFilter()">
                    <option value="">Ordenar Por</option>
                    <option value="asc">Ascendente</option>
                    <option value="desc">descendente</option>
                    <option value="active">Pago</option>
                    <option value="inactive">Não Pago</option>
                </select>
            </div><!--/End col-->
        </div><!-- End row filtros -->

        <div class="row">
            <div class="col-md-12  col-sm-12 col-xs-12">
                
                <div id="tableData" class="table-responsive" style="border: none;">
                    <table  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="small text-center">#</th>
                                <th class="small text-center">DATA DE VENCIMENTO</th>
                                <th class="small text-center">DATA DE PAGAMENTO</th>
                                <th class="small text-center">CATEGORIA</th>
                                <th class="small text-center">DESCRIÇÃO</th>
                                <th class="small text-center">VALOR</th>
                                <th class="small text-center">DATA DA INCLUSÃO</th>
                                <th class="small text-center">MODIFICADO EM</th>
                                <th class="small text-center">STATUS</th>
                                <th colspan="10" class="small text-center">AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody >
                            <?php
                            if (!empty($pays)) {
                                $count = 0;
                                foreach ($pays as $pay) {
                                    $count++;
                            ?>
                            <tr class="text-center">
                                <td><?= htmlentities($pay['pay_id']); ?></td>
                                <td><?= htmlentities($pay['pay_venc']); ?></td>
                                <td><?= htmlentities($pay['pay_date_pay']); ?></td>
                                <td><?= htmlentities($pay['pay_cat']); ?></td>
                                <td><?= htmlentities($pay['pay_desc']); ?></td>
                                <td><?= htmlentities($pay['pay_val']); ?></td>
                                <td><?= htmlentities($pay['pay_created']); ?></td>
                                <td><?= htmlentities($pay['pay_modified']); ?></td>
                                <td><?= ($pay['pay_status'] == 1) ? '<span class="label label-success">Pago</span>' : '<span class="label label-warning">Não pago</span>'; ?></td>
                                <td><button class="btn btn-success btn-xs">Editar</button></td>
                                <td><button data-id="<?= $modelo->encode_decode($pay['pay_id']); ?>" class="btn-dell btn btn-warning btn-xs">Deletar</button></td>
                                <td><button class="btn btn-primary btn-xs">Visualizar</button></td>
                            </tr>
                                <?php }
                            } else {
                                ?>
                                <tr class="text-center"><td colspan="10"><span class="label label-primary">Não há registros...</span></td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?= $pagination->createLinks(); ?>
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
                            <span class="sr-only">Close</span>
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
                        <a href="javascript:void(0);" class="btn btn-success" onclick="userAction('add')">Add User</a>
                    </div>
                </div>
            </div>
        </div><!--End modal editar inserir-->

        <!-- Metodos necessarios -->  
        <script>
                function submitContactForm(){
        var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var name = $('#inputName').val();
        var email = $('#inputEmail').val();
        var message = $('#inputMessage').val();
        if(name.trim() == '' ){
                    alert('Please enter your name.');
            $('#inputName').focus();
                    return false;
            }else if(email.trim() == '' ){
                    alert('Please enter your email.');
            $('#inputEmail').focus();
                    return false;
            }else if(email.trim() != '' && !reg.test(email)){
                    alert('Please enter valid email.');
            $('#inputEmail').focus();
                    return false;
            }else if(message.trim() == '' ){
                    alert('Please enter your message.');
            $('#inputMessage').focus();
                    return false;
            }else{
            $.ajax({
                type:'POST',
                url:'<?=HOME_URI;?>/finances-pay/submit',
                data:'contactFrmSubmit=1&name='+name+'&email='+email+'&message='+message,
                beforeSend: function () {
                    $('.submitBtn').attr("disabled","disabled");
                    $('.modal-body').css('opacity', '.5');
                },
                success:function(msg){
                    alert(msg);
                    if(msg == 'ok'){
                        $('#inputName').val('');
                        $('#inputEmail').val('');
                        $('#inputMessage').val('');
                        $('.statusMsg').html('<span style="color:green;">Thanks for contacting us, we\'ll get back to you soon.</p>');
                    }else{
                        $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                    }
                    $('.submitBtn').removeAttr("disabled");
                    $('.modal-body').css('opacity', '');
                }
            });
        }
    }
            //Setando valores do ajax
            //var objFinanca = new Financeiro();

            //objFinanca.setAjax('.btn-dell');

            //objFinanca.getAjax();

            //objFinanca.mostraAjax();

            $('body').on('click', '.btn-dell', function(){
                  //var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
                  var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
                  //$('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
                  $('a.delete-yes').attr('href', '?re=' +id); // mudar dinamicamente o link, href do botão confirmar da modal
                  $('#dellReg').modal('show'); // modal aparece
            });
            
            
        </script>