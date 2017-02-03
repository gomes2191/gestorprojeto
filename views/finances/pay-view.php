<?php
    if (!defined('ABSPATH')) { exit; }
    
//     # Verifica se existe a requisição GET, se sim continua na página se não retorna a pagina convenios
//    if (!(filter_input(INPUT_GET, 'get_two', FILTER_DEFAULT)) OR (filter_input(INPUT_GET, 'get', FILTER_DEFAULT))) {
//        echo '<script>window.location.href ="'.HOME_URI.'/covenant";</script>';
//    }
    
    //$get_decode = intval($modelo->encode_decode(0, filter_input(INPUT_GET, 'get_two', FILTER_DEFAULT)));
    
    //var_dump($modelo->get_table_data(2, 'covenant_id',  'covenant', 'covenant_id', $get_decode, 'covenant_id'));
    
//    if(in_array($get_decode, $modelo->get_table_data(2, 'covenant_id',  'covenant', 'covenant_id', $get_decode, 'covenant_id'))) {
//        
//    }else{
//        # Retorna para página 'covenant' caso não exista o id correspondente
//        echo'<script>window.location="'.HOME_URI.'/covenant";</script>';
//        //exit();
//    };
    


    # Verifica se existe a requisição POST se existir executa o método se não faz nada
    (filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : FALSE;
    
//     # Verifica se existe a requisição GET caso exista executa o método
//    if (filter_input(INPUT_GET, 'get_three', FILTER_DEFAULT)) {
//        $encode_id = filter_input(INPUT_GET, 'get_three', FILTER_DEFAULT);
//        $modelo->delRegister($encode_id);
//        
//        # Destroy variável não mais utilizadas
//        unset($encode_id);
//    }
    
    # Configura o Feedback para o usuário
    $form_msg = $modelo->form_msg;
?>

<script>
    var objFinanca = new Financeiro();
    //  Muda url da pagina
    //  window.history.pushState("fees", "", "fees");
    
    // Chama o paginador da tabela    
    $(function () {
        if($('.text-center').hasClass('vazio') === false){
            $('#table-fees').DataTable({
                language: {url: 'Portuguese-Brasil.json'}
                
            });   
        }
    });
         
    $(function (){
        $('.btn-gravar-fees').click(function (){
            valorVetor = [];
            valorVetor['fees_id']   =  parseInt($(this).closest('tr').find('#fees_id').text().replace(' ',''));
            valorVetor['fees_cod']  =  $(this).closest('tr').find('#fees_cod').text().replace(' ','');
            valorVetor['fees_proc'] =  $(this).closest('tr').find('#fees_proc').text().replace(' ','');
            valorVetor['fees_cat']  =  $(this).closest('tr').find('#fees_cat').text().replace(' ','');
            valorVetor['fees_desc'] =  $(this).closest('tr').find('#fees_desc').text().replace(' ','');
            valorVetor['fees_part'] =  $(this).closest('tr').find('input').val();
            valorVetor['fees_total'] =  $(this).closest('tr').find('#fees_total').text().replace(' ','');
            alert($(this).closest('tr').find('input').val());
            
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
    });
    
    function delConfirm(encode_id){
        swal({
          title: "",
          text: "Você realmente deseja remover este registro? apos a remoção será impossivel reverter isso",
          type: "warning",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Remover",
          closeOnConfirm: true,
          closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm){
                $.ajax({
                  type:'POST',
                  url:'<?= HOME_URI ?>/covenant/ajax-fees',
                  data: { encode_id: encode_id },
                  dataType: "html",
                  success: function(retorno){
                    if(retorno == 1){
                        setTimeout(function(){
                            swal({title:'Registro removido com sucesso!' ,type: "success", timer: 1500, showConfirmButton: false});
                        }, 200);
                        
                    }else{
                        swal("Erro!", "Ouve um erro durante a exclusao do registro se o problema persistir contate o administrador :)", "error");
                    }
                  }
                });
                
            }else{
                swal("Cancelado!", "O registro foi mantido :)", "error");
            }
          
        });
    };
    
    $(function (){
        //  Verifica cada elemento tr em busca de um valor especificado
        $('#table-fees tbody tr').each(function(i){
            
            /* Variável que aramazena o retorno da consulta na classe vazio armazenando
            * true caso exista e false caso nao exista.*/
             
            testeError =  $(this).find('.vazio').text();
            
            
            //  Verifica se o valor na variavel é false se for executa a rotina.
            if(testeError == false){
                
                fees_part =  $(this).find('input').val().toString();
                fees_desc =  $(this).find('#fees_desc').text().toString();


               objFinanca.setUS(fees_part);
               objFinanca.mostrarUS();

               fees_part = parseFloat(objFinanca.getUS());

                // Declaração de vetores

                var vetorPerc  = [];
                var vetorValor = [];
                var resultado  = [];

                vetorPerc[i]    =   fees_desc;
                vetorValor[i]   =   fees_part;
                //vetorTotal[i]   =   fees_total;


                resultado[i] = ( vetorValor[i] - ( vetorValor[i] *  vetorPerc[i] / 100).toFixed(2) );

                
                
                
                objFinanca.setMoneyCash(resultado[i], 2, ',', '.');
                objFinanca.formatMoneyCash();
                $(this).find("#fees_total").text(objFinanca.getMoneyCash());
                
                objFinanca.setMoneyCash(vetorValor[i], 2, ',', '.');
                objFinanca.formatMoneyCash();
                $(this).find('#fees_part').text(objFinanca.getMoneyCash());
            }
            
        });
        
        $("input#fees_part").maskMoney({allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        
    });
</script>
<div class="row-fluid">
    <div class="col-md-12  col-sm-12 col-xs-12"  ng-app="myFess" ng-controller="myFessController">
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
                        <label for="fees_part">Data de vencimento:</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            <input id="pay_venc" name="pay_venc" style="border-radius: 0px !important;" type="date" class="form-control" placeholder="dd/mm/aaaa" >
                            <!--<div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>-->
                        </div>
                        <br>
                    </div>
                    
                    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                        <label for="fees_proc"> Descrição:</label>
                        <input id="fees_proc" name="fees_proc" class="form-control" type="text" placeholder="Descreva as informações aqui..." value="">
                        <br>
                    </div>
                     <div class="form-group col-md-2 col-sm-12 col-xs-12" >
                        <label for="fees_part">Valor montante ( em reais )</label>
                        <div class="input-group">
                            <div class="input-group-addon">R$</div>
                            <input id="fees_part" name="fees_part" style="border-radius: 0px !important;" type="text" class="form-control" placeholder="0,00" >
                            <div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></div>
                        </div>
                        <br>
                    </div>
                   
                    <div class="form-group col-md-2 col-sm-12 col-xs-12" >
                        <label for="fees_part">Valor particular montante ( em reais )</label>
                        <div class="input-group">
                            <div class="input-group-addon">R$</div>
                            <input id="fees_part" name="fees_part" style="border-radius: 0px !important;" type="text" class="form-control" placeholder="0,00" >
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
        
        <div class="table-responsive">
            <br>
            <table id="table-fees" class="table table-bordered table-condensed table-hover table-format" >
                <?php #if ($modelo->get_table_data(2, 'fees_id',  'covenant_fees', 'covenant_fees_id', $get_decode, 'fees_id')): ?>
                <thead>
                    <tr class="cabe-title">
                        <th class="text-center">#</th>
                        <th class="text-center">Código</th>
                        <th class="text-center">Procedimento</th>
                        <th class="text-center">Categoria</th>
                        <th class="text-center">Percentual</th>
                        <th class="text-center">Valor Particular</th>
                        <th class="text-center">Valor total com percentual</th>
                        <th class="text-center">Salvar | Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //foreach ( $modelo->get_table_data(2, '*',  'covenant_fees', 'covenant_fees_id', $get_decode, 'fees_id') as $fetch_userdata  ): ?>
                    <tr class="text-center"> 
                        <td id="fees_id" ><span></span></td>
                        <td title="Código"><span id="fees_cod"></span></td>
                        <td title="Procedimento" ><span id="fees_proc"></span></td>
                        <td title="Categoria" ><span id="fees_cat"></span></td>
                        <td style="color: chocolate"   title="Desconto"><span id="fees_desc"></span>%</td>
                        <td style="color: #468847;" title="Particular" ><input type="hidden" value="">R$ <span id="fees_part"></span></td>
                        <td title="Valor após desconto" style="color: chocolate"><span >R$ </span></td>
                        <td>
                            <button title="Grava alterações" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-default btn-gravar-fees">
                                <i style="color:#2196f3;" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button> |
                            <a href="javascript:void(0);" title="Eliminar registro" onclick="delConfirm('');" class="btn btn-sm btn-default">
                                <i style="color:#c71c22;" class="fa fa-1x fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                       
<!--                        <td>
                            <a href="<?= HOME_URI; ?>/covenant/box-view?v=<?= $modelo->encode_decode($fetch_userdata['covenant_id']); ?>" class="btn btn-sm btn-default" data-toggle="modal" data-target="#visualizar-forne" title="Visualizar cadastro" >
                                <i style="color: #2fa4e7;" class="fa fa-1x fa-info-circle" aria-hidden="true"></i>
                            </a>
                        </td>-->
                    
                    </tr>
                    <?php #endforeach; ?>
                    <?php 
                        /*else: 
                            echo '<tbody><tr><td class="text-center vazio" style="color: red;" >Não há registros cadastrado no sistema.</td></tr>'; 
                        endif;*/ 
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
    </div>
</div>

