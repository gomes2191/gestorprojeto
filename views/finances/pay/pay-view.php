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
    
    # Verifica se existe feedback e retorna o feedback se sim se não retorna false
    $form_msg = $modelo->form_msg;
    
?>

<script>
    var objFinanca = new Financeiro();
    //  Muda url da pagina
    //  window.history.pushState("fees", "", "fees");
    
    //  Faz um refresh de url apos fechar modal
    $(function () {
        $('#infor-view').on('hidden.bs.modal', function () {
            //document.location.reload();
            $(this).removeData('bs.modal');
        });
    });
    
    // Chama o paginador da tabela    
    $(function () {
        if($('.text-center').hasClass('vazio') === false){
            $('#table-fees').DataTable({
                language: {url: 'Portuguese-Brasil.json'}
                
            });   
        }
    });
         
    $(function (){
        $('.btn-editable').click(function (){
            valorVetor = [];
            valorVetor['pay_id']        =  parseInt($(this).closest('tr').find('#pay_id').text().replace(' ',''));
            valorVetor['pay_venc']      =  $(this).closest('tr').find('#pay_venc').text().replace(' ','');
            valorVetor['pay_date_pay']  =  $(this).closest('tr').find('#pay_date_pay').text().replace(' ','');
            valorVetor['pay_desc']      =  $(this).closest('tr').find('#pay_desc').text().replace(' ','');
            valorVetor['pay_val']     =  $(this).closest('tr').find('#pay_val').text().replace(' ','');
            //valorVetor['fees_part']     =  $(this).closest('tr').find('input').val();
            valorVetor['fees_total']    =  $(this).closest('tr').find('#fees_total').text().replace(' ','');
            //alert($(this).closest('tr').find('input').val());
            console.log(valorVetor);
            
            $('input#fees_id').val(valorVetor['fees_id']);
            $('input#fees_cod').val(valorVetor['fees_cod']);
            $('input#fees_proc').val(valorVetor['fees_proc']);
            $('select#fees_cat').val(valorVetor['fees_cat']);
            $('input#fees_desc').val(valorVetor['fees_desc']);
            $('input#fees_part').val(valorVetor['fees_part']);
            $('input#fees_total').val(valorVetor['fees_total']);
            
            $('.new-fees').show(500);
            $('#fees-btn-show').hide();
            $('#fees-btn-hide').show();
            $('html, body').animate({scrollTop:0}, 'slow');
        });
        
        $('.fees-clear').click(function (){
            $('#fees_id').val("");
        });
        
        $("input#pay_val").maskMoney({allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    });
    
    
 //Teste serverSide
    $(document).ready(function () {
        $('#example').DataTable({
            dom: 'Bfrtip',
            "buttons": [
                {
                    extend: 'copy',
                    text: 'Copiar'
                },{
                  extend: 'excel',
                  text: 'Gerar excel'},{
                  extend: 'pdf',
                  text: 'Gerar PDF'  
                }
            ],
            "language": {url: 'Portuguese-Brasil.json'},
            "columns": [
                {"data": "pay_id"},
                {"data": "pay_venc"},
                {"data": "pay_date_pay"},
                {"data": "pay_cat"},
                {"data": "pay_desc"},
                {"data": "pay_val"},
                {
                 data: "Action",
                 data: false,
                 mRender: function (o) { return '<i class="ui-tooltip fa fa-pencil" style="font-size: 22px;" data-original-title="Edit"></i><i class="ui-tooltip fa fa-trash-o" style="font-size: 22px;" data-original-title="Delete"></i>'; }
             }
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: '<?= HOME_URI; ?>/finances-pay/ajax-process',
                        type: 'POST'
                    }
                });
    });


 //Teste server Side
        
        
</script>
<div class="row-fluid">
    <div class="col-md-12  col-sm-12 col-xs-12">
        <?php
            if ($form_msg) {
                echo'<div class="alert alertH ' . $form_msg[0] . ' alert-dismissible fade in">
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
        <!--<h4 class="text-center">CADASTRO DE FORNECEDORES</h4>-->
        <form id="form-register" enctype="multipart/form-data" method="post" action="" role="form" >
            <fieldset>
                <legend>CONTAS A PAGAR</legend>
                <div class="row form-compact new-fees" style="display: none;">
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
               
                <div class="row form-compact new-fees" style="display: none;">
                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <div class="btn-group">
                            <button title="Salvar informações" class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-save"></i> Salvar</button>
                        </div>
                        <div class="btn-group">
                            <button title="Limpar formulário" class="btn btn-warning marg-top fees-clear" type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="btn-group">
                <a href="<?= HOME_URI; ?>/covenant" class="btn btn-default" title="Ir para lista de conveniados"><i class="fa fa-list fa-1x" aria-hidden="true"></i> Listar convênios</a>
            </div>
            <div id="fees-btn-show" class="btn-group">
                <button id="btn-new-show" title="Mostrar formulário" class="btn btn-default marg-top" type="reset">
                    <i class="glyphicon glyphicon-plus"></i> Adicionar registro
                </button>
            </div>
            <div id="fees-btn-hide" class="btn-group">
                <button id="btn-new-hide" title="Ocultar formulário" class="btn btn-default marg-top" type="reset"><i class="glyphicon glyphicon-eye-close"></i> Ocultar Formulário</button>
            </div>
        </form>
    </div>
</div> <!-- /row  -->
<div class="row-fluid">
    <div class="col-md-12  col-sm-12 col-xs-12">
        
        
<!--        Teste tabela servside-->
    <div class="">
        <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name teste</th>
                <th>Salary</th>
                <th>ID</th>
                <th>Name teste</th>
                <th>Salary</th>
               
            </tr>
        </thead>
 
        <tfoot>
            <tr>
               <th>ID</th>
                <th>Name teste</th>
                <th>Salary</th>
                <th>ID</th>
                <th>Name teste</th>
                <th>Salary</th>
                
            </tr>
        </tfoot>
    </table>
    </div>
    

<!--        Teste tabela servside-->
        
        <div class="table-responsive">
            <br>
            <table id="table-fees" class="table table-condensed table-hover table-format" >
                <?php if ($modelo->get_table_data(1, '*',  'bills_to_pay', NULL, NULL, 'pay_id')): ?>
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Data do vencimento</th>
                        <th class="text-center">Data de pagamento</th>
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Categoria</th>
                        <th class="text-center">Valor</th>
                        <th class="text-center">Salvar | Deletar | Informações </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $modelo->get_table_data(1, '*',  'bills_to_pay', NULL, NULL, 'pay_id') as $fetch_userdata  ): ?>
                    <tr class="text-center"> 
                        <td id="pay_id" > <?= $fetch_userdata['pay_id']; ?></td>
                        <td title="Código" id="pay_venc"><?= $fetch_userdata['pay_venc']; ?></td>
                        <td title="Procedimento" id="pay_date_pay" ><?= $fetch_userdata['pay_date_pay']; ?></td>
                        <td title="Categoria" id="pay_desc" ><?= $fetch_userdata['pay_desc']; ?></td>
                        <td style="color: chocolate"   title="Desconto"><?= $fetch_userdata['pay_cat']; ?></td>
                        <td style="color: #468847;" title="Particular" >R$ <span id="pay_val"><?= $fetch_userdata['pay_val']; ?></span></td>
                        <td>
                            <button title="Editar informações" class="btn btn-sm btn-default btn-editable">
                                <i style="color:#2196f3;" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button> |
                            <a href="javascript:void(0);" title="Eliminar registro" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-default">
                                <i style="color: #c71c22;" class="fa fa-1x fa-times" aria-hidden="true"></i>
                            </a> |
                            <a href="<?= HOME_URI; ?>/finances-pay/pay-box-view?v=<?= $modelo->encode_decode($fetch_userdata['pay_id']); ?>" class="btn btn-sm btn-default" data-toggle="modal" data-target="#infor-view" title="Visualizar informações" >
                                <i style="color: #2fa4e7;" class="fa fa-1x fa-info-circle" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php 
                        else: 
                            echo '<tbody><tr><td class="text-center vazio" style="color: red;" >Não há registros cadastrado no sistema.</td></tr>'; 
                        endif; 
                    ?>
                    
                    <script>
                        var objFinanca = new Financeiro();
                        
                        $( function (){
                           $('input#fees_part, input#fees_desc').bind('click focusout', function (){
                               objFinanca.setNumberCalc('fees_part', 'fees_desc');
                               objFinanca.somarNumberCalc();
                               
//                               $('input#fees_total').val(objFinanca.getNumberCalc());
                                objFinanca.setMoneyCash(objFinanca.getNumberCalc(), 2, ',', '.');
                                objFinanca.formatMoneyCash();
                                
                                document.getElementById('fees_total').setAttribute('value', objFinanca.getMoneyCash() );
                               
                                console.log(objFinanca.getNumberCalc());
                           }); 
                        });
                        
                        
                        
                        
                        
    
//                        var app = angular.module('myFess', []);
//                        app.controller('myFessController', function($scope){
//                            $scope.operacao = {fees_part:0, valorReal:0, fees_desc:0, fees_total:0};            
//                            $scope.somarValores = function(){
//                                objFinanca.setUS(String($scope.operacao.fees_part));
//                                objFinanca.mostrarUS();
//                                console.log($scope.operacao.valorReal = objFinanca.getUS());
//                                $scope.operacao.fees_total = $scope.operacao.valorReal - ($scope.operacao.valorReal * $scope.operacao.fees_desc / 100);
//                            };
//                        });
                    </script>    
                </tbody>
            </table>
            <br>
        </div>
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

