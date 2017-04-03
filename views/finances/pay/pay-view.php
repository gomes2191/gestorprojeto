<?php
if (!defined('ABSPATH')) {
    exit();
}

if (filter_input(INPUT_GET, 're', FILTER_DEFAULT)) {
    $encode_id = filter_input(INPUT_GET, 're', FILTER_DEFAULT);
    $modelo->delRegister($encode_id);

    # Destroy variavel não mais utilizadas
    unset($encode_id);
}
    # Verifica se existe a requisição POST se existir executa o método se não faz nada
    (filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : FALSE;
    
    # ///
    $pays = $modelo->getRows('bills_to_pay',array('order_by'=>'pay_id DESC'));
    
    

    # Verifica se existe feedback e retorna o feedback se sim se não retorna false
    $form_msg = $modelo->form_msg;
?>

<script>
    //  Muda url da pagina
    //  window.history.pushState("fees", "", "fees");

    //  Faz um refresh de url apos fechar modal
    $(function () {
        $('#infor-view').on('hidden.bs.modal', function () {
            //document.location.reload();
            $(this).removeData('bs.modal');
        });
    });
    
    function getUsers(type,val){
    $.ajax({
        type: 'POST',
        url: 'finances-pay/search',
        data: 'type='+type+'&val='+val,
		beforeSend:function(html){
			$('.loading-overlay').show();
		},
        success:function(html){
			$('.loading-overlay').hide();
            $('#userData').html(html);
        }
    });
}
</script>


<div class="row-fluid">
    <div class="col-md-12  col-sm-12 col-xs-12">
        <!--Implementação da nova tabela-->
        <div class="row">
            <div class="col-md-1  col-sm-0 col-xs-0"></div>
            <div class="col-md-10  col-sm-12 col-xs-12">
                <div class="pull-left">
        <input type="text" class="search form-control" id="searchInput" placeholder="Por nome...">
        
        <button type="button" class="btn btn-primary" onclick="getUsers('search',$('#searchInput').val())">BUSCAR</button>
    </div>
    <div class="pull-right">
        <select class="form-control" onchange="getUsers('sort',this.value)">
          <option value="">Sort By</option>
          <option value="new">Newest</option>
          <option value="asc">Ascending</option>
          <option value="desc">Descending</option>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
    </div>
                <div class="loading-overlay" style="display: none;"><div class="overlay-content">Loading.....</div></div>
                <table  class="table table-bordered table-hover ">
                    <thead>
                        <tr>
                            <th class="small text-center">#</th>
                            <th class="small text-center">DATA DE VENCIMENTO</th>
                            <th class="small text-center">DATA DE PAGAMENTO</th>
                            <th class="small text-center">CATEGORIA</th>
                            <th class="small text-center">DESCRIÇÃO</th>
                            <th class="small text-center">VALOR</th>
                            <th class="small text-center">AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody id="userData">
                        <?php
                        if (!empty($pays)) {
                            $count = 0;
                            foreach ($pays as $pay) {
                                $count++;
                                ?>

                                <tr>
                                    <td><?php echo $pay['pay_id']; ?></td>
                                    <td><?php echo $pay['pay_venc']; ?></td>
                                    <td><?php echo $pay['pay_date_pay']; ?></td>
                                    <td><?php echo $pay['pay_cat']; ?></td>
                                    <!--<td><?php echo ($pay['pay_desc'] == 1) ? 'Active' : 'Inactive'; ?></td>-->
                                    <td><?php echo $pay['pay_desc']; ?></td>
                                    <td><?php echo $pay['pay_val']; ?></td>
                                    <td> <button>Deletar</button></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr><td colspan="5">No user(s) found...</td></tr>
                          <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-1  col-sm-0 col-xs-0"></div> 
        </div><!-- End row -->
        
        <!--Implementação da nova tabela-->
        
        <!-- Start Modal deletar fornecedores -->
        <div class="modal in fade"  role="dialog" id="myModal">
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
                        <a href="<?= HOME_URI; ?>/finances-pay" class="btn btn-primary">Desistir</a>
                        <a href="<?= HOME_URI; ?>/finances-pay?re=<?= $modelo->encode_decode($fetch_userdata['pay_id']); ?> " class="btn btn-danger" >Eliminar</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <!-- Start Modal Informações de pagamentos -->
        <div id="infor-view" class="modal fade" >
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <!--Conteudo do modal-->
                </div>
            </div>
        </div>
        <!-- End modal -->
    </div>
</div>

