<?php
    if (!defined('ABSPATH')) { exit; }
    
     # Verifica se existe a requisição GET, se sim continua na página se não retorna a pagina convenios
    if (!(filter_input(INPUT_GET, 'get_two', FILTER_DEFAULT)) OR (filter_input(INPUT_GET, 'get', FILTER_DEFAULT))) {
        echo '<script>window.location.href ="'.HOME_URI.'/covenant";</script>';
    }
    
    $get_decode = intval($modelo->encode_decode(0, filter_input(INPUT_GET, 'get_two', FILTER_DEFAULT)));
    
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
    
    
    Number.prototype.formatMoney = function(c, d, t){
     var n = this, c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
     return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };

// usando


//retorna 1.000,00
    
    //   Muda url da pagina
    //  window.history.pushState("fees", "", "fees");
    
    // Chama o paginador da tabela    
    $(function () {
        if($('.text-center').hasClass('vazio') == false){
            $('#table-fees').DataTable({
                language: {url: '../Portuguese-Brasil.json'}
                
            });   
        }
    });
    function apenasNumeros(string) 
{
    var numsStr = string.replace(/[^0-9]/g,'');
    return parseInt(numsStr);
}       
    $(function (){
        $('.btn-gravar-fees').click(function (){
            valorVetor = [];
            valorVetor['fees_id']   =  parseInt($(this).closest('tr').find('#fees_id').text().replace(' ',''));
            valorVetor['fees_cod']  =  $(this).closest('tr').find('#fees_cod').text().replace(' ','');
            valorVetor['fees_proc'] =  $(this).closest('tr').find('#fees_proc').text().replace(' ','');
            valorVetor['fees_cat']  =  $(this).closest('tr').find('#fees_cod').text().replace(' ','');
            valorVetor['fees_desc'] =  $(this).closest('tr').find('#fees_cod').text().replace(' ','');
            valorVetor['fees_part'] =  apenasNumeros($(this).closest('tr').find('#fees_part').text().replace(' ',''));
            
            $('input#fees_id').val(valorVetor['fees_id']);
            $('input#fees_cod').val(valorVetor['fees_cod']);
            $('input#fees_proc').val(valorVetor['fees_proc']);
            $('input#fees_cat').val(valorVetor['fees_cat']);
            $('input#fees_desc').val(valorVetor['fees_desc']);
            $('input#fees_part').val(valorVetor['fees_part']);
            
            $('#btn-new-hide').trigger('click');
        });
    });
    
    
    function delConfirm(encode_id){
        var tr = $('tr.ativo');
        
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
                        
                        tr.remove();
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
        $('#table-fees tbody tr').each(function(i){
            
            fees_part =  parseFloat($(this).find('#fees_part').text().toString());
            fees_desc =  parseFloat($(this).find('#fees_desc').text().toString());
            
            
            // Declaração de vetores
            
            var vetorPerc  = [];
            var vetorValor = [];
            var vetorTotal = [];
            var resultado  = [];
            
            vetorPerc[i]    =   fees_desc;
            vetorValor[i]   =   fees_part;
            vetorTotal[i]   =   fees_total;
            
            
            resultado[i] = parseFloat(( vetorValor[i] - ( vetorValor[i] *  vetorPerc[i] / 100).toFixed() ));
            
            
            
            $(this).find("#fees_part").text('$' + (vetorValor[i]).formatMoney(2, '.', ','));
            $(this).find("#fees_total").text('$' + (resultado[i]).formatMoney(2, '.', ','));
            
        });
        
        
    });
    
    
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
        <form id="form-register" enctype="multipart/form-data" method="post" role="form" class="">
            <fieldset>
                <legend>TABELA DE HONORÁRIOS</legend>
                <div class="row form-compact new-fees" style="display: none;">
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="fees_cod"><i style="color: red;">*</i>Nr:</label>
                        <input type="hidden" name="covenant_fees_id" value="<?= $get_decode; ?>">
                        <input id="fees_id" type="hidden" name="fees_id" value="">
                        <input id="fees_cod" type="text" name="fees_cod" placeholder="Ex: G300, P20, M30... " value="" class="form-control" 
                               data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo."
                               data-validation-help="Digite um nome com (3) ou mais caracteres.">
                        <br>
                    </div>

                    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                        <label for="fees_proc"><i style="color: red;">*</i> Procedimento:</label>
                        <input id="fees_proc" name="fees_proc" class="form-control" type="text" placeholder="Produto - Marca" value="">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="fees_cat">Categoria:</label>
                        <select name="fees_cat" class="form-control">
                            <?php foreach ($modelo->get_table_data('*', 'fees_tipo_unitario', 'tipo_unitario_id') as $fetch_userdata): ?>
                                <option value="<?= $fetch_userdata['tipo_unitario']; ?>" <?= ($fetch_userdata['tipo_unitario'] == htmlentities(chk_array($modelo->form_data, 'fees_tipo_unit'))) ? 'selected' : ''; ?>><?= $fetch_userdata['tipo_unitario']; ?></option>
                            <?php endforeach; unset($fetch_userdata); ?>
                        </select>
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="fees_part">Valor particular montante ( em reais )</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input id="fees_part" name="fees_part" style="border-radius: 0px !important;" type="text" class="form-control" placeholder="Montante..." value="<?= htmlentities(chk_array($modelo->form_data, 'fees_valor')); ?>">
                            <div class="input-group-addon">.00</div>
                        </div>
                        <br>
                    </div>
                    <br>
                </div>
                <div class="row form-compact new-fees" style="display: none;">
                    <div class="form-group col-md-2 col-sm-4 col-xs-6">
                        <label for="fees_desc">Desconto convênio:</label>
                        <input id="fees_desc" name="fees_desc" class="form-control" type="text" placeholder="0.00" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'fees_desc')); ?>">
                        <br>
                    </div>
                </div>

                <div class="row form-compact new-fees" style="display: none;">
                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <div class="btn-group">
                            <button title="Salvar informações" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-floppy-save"></i> Salvar</button>
                        </div>
                        <div class="btn-group">
                            <button title="Limpar formulário" class="btn btn-default marg-top" type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
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
    </div>
</div> <!-- /row  -->
<div class="row-fluid">
    <div class="col-md-12  col-sm-12 col-xs-12">
        
        <div class="table-responsive">
            <br>
            <table id="table-fees" class="table table-bordered table-condensed table-hover table-format" >
                <?php if ($modelo->get_table_data(2, 'fees_id',  'covenant_fees', 'covenant_fees_id', $get_decode, 'fees_id')): ?>
                <thead>
                    <tr class="cabe-title">
                        <th class="text-center">#</th>
                        <th class="text-center">Código</th>
                        <th class="text-center">Procedimento</th>
                        <th class="text-center">Categoria</th>
                        <th class="text-center">Desconto %</th>
                        <th class="text-center">Particular</th>
                        <th class="text-center">Valor com desconto</th>
                        <th class="text-center">Salvar | Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $modelo->get_table_data(2, '*',  'covenant_fees', 'covenant_fees_id', $get_decode, 'fees_id') as $fetch_userdata  ): ?>
                    <tr class="text-center">
                        <td id="fees_id" ><?= $fetch_userdata['fees_id']; ?></td>
                        <td id="fees_cod" title="Código" class="edit"><?= $fetch_userdata['fees_cod']; ?></td>
                        <td id="fees_proc" title="Procedimento" class="edit"><?= $fetch_userdata['fees_proc']; ?></td>
                        <td id="fees_cat" title="Categoria" class="edit"><?= $fetch_userdata['fees_cat']; ?></td>
                        <td id="fees_desc"  title="Desconto" class="edit"><?= $fetch_userdata['fees_desc']; ?></td>
                        <td id="fees_part" title="Particular" ><?= $fetch_userdata['fees_part']; ?></td>
                        <td id="fees_total"></td>
                        <td>
                            <button title="Grava alterações" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-default btn-gravar-fees">
                                <i style="color:#2196f3;" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button> |
                            <a href="javascript:void(0);" title="Eliminar registro" onclick="delConfirm('<?= $modelo->encode_decode($fetch_userdata['fees_id']); ?>');" class="btn btn-sm btn-default">
                                <i style="color:#c71c22;" class="fa fa-1x fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                       
<!--                        <td>
                            <a href="<?= HOME_URI; ?>/covenant/box-view?v=<?= $modelo->encode_decode($fetch_userdata['covenant_id']); ?>" class="btn btn-sm btn-default" data-toggle="modal" data-target="#visualizar-forne" title="Visualizar cadastro" >
                                <i style="color: #2fa4e7;" class="fa fa-1x fa-info-circle" aria-hidden="true"></i>
                            </a>
                        </td>-->
                    
                    </tr>
                    <?php endforeach; ?>
                    <?php 
                        else: 
                            echo '<tbody><tr><td class="text-center vazio" style="color: red;" >Não há registros cadastrado no sistema.</td></tr>'; 
                        endif; 
                    ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
</div>

<script>

    $('.top').click(function () {
        $('html, body').animate({scrollTop: 0}, 'slow');
        return false;

    });
    
    


</script>