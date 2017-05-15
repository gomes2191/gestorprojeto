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
            url: 'finances-pay/search',
            data: 'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&qtdLine='+qtdLine,
            beforeSend:function(){
                $('#loading').show();
            },
            success:function(html){
                $('#loading').hide();
                $('#tableData').html(html);
            }
        });
    }
</script>
<div class="row-fluid">
    <div class="col-md-1  col-sm-0 col-xs-0"></div>
    <div class="col-md-10  col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-md-12  col-sm-12 col-xs-12">
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
            </div>
        </div><!-- End row feedback -->
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
                
                
                <div id="loading" style="display: none;">
                    <ul class="bokeh">
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                
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
                
    </div> <!-- End coll 10 -->
                
    <div class="col-md-1  col-sm-0 col-xs-0"></div> 
    </div><!-- End row principal-->
        
        <!--Implementação da nova tabela-->
        
        <!-- Start Modal deletar fornecedores -->
        <div class="modal in fade"  role="dialog" id="dellReg">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title"><span style="colo" class=" info glyphicon glyphicon-floppy-remove">&nbsp;</span>ELIMINAR REGISTRO</h5>
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
        </div>
        <!-- End modal -->
<!-- Metodos necessarios -->    
<script>
    
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