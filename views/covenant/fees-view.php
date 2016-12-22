<?php
    if (!defined('ABSPATH')) { exit; }
    
     # Verifica se existe a requisição GET, se sim continua na página se não retorna a pagina convenios
    if (!(filter_input(INPUT_GET, 'get_two', FILTER_DEFAULT)) OR (filter_input(INPUT_GET, 'get', FILTER_DEFAULT))) {
        echo '<script>window.location.href ="'.HOME_URI.'/covenant";</script>';
    }
    
    $get_decode = intval($modelo->encode_decode(0, filter_input(INPUT_GET, 'get_two', FILTER_DEFAULT)));
    var_dump($get_decode);
    
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
    
     # Verifica se existe a requisição GET caso exista executa o método
    if (filter_input(INPUT_GET, 'get_three', FILTER_DEFAULT)) {
        $encode_id = filter_input(INPUT_GET, 'get_three', FILTER_DEFAULT);
        $modelo->delRegister($encode_id);
        
        # Destroy variável não mais utilizadas
        unset($encode_id);
    }
    
    # Configura o Feedback para o usuário
    $form_msg = $modelo->form_msg;
?>

<script>
    
    //   Muda url da pagina
    //  window.history.pushState("fees", "", "fees");
    
    // Chama o paginador da tabela    
    $(function () {
        if($('.text-center').hasClass('vazio') == false){
            $('#table-fees').DataTable({
                language: {url: '../Portuguese-Brasil.json'},
                pageResize: true
                
            });   
        }
    });
    
    
   
   function CarregaText() {
        var fees_cod  = $('#table-fees tbody tr.ativo #fees_cod').text();
        var fees_proc = $('#table-fees tbody tr.ativo #fees_proc').text();
        var fees_cat = $('#table-fees tbody tr.ativo #fees_cat').text();
        var fees_desc = $('#table-fees tbody tr.ativo #fees_desc').text();
        var fees_part = $('#table-fees tbody tr.ativo #fees_part').text();
        $('#table-fees tbody tr.ativo input.fees_cod').val(fees_cod);
        $('#table-fees tbody tr.ativo input.fees_proc').val(fees_proc);
        $('#table-fees tbody tr.ativo input.fees_cat').val(fees_cat);
        $('#table-fees tbody tr.ativo input.fees_desc').val(fees_desc);
        $('#table-fees tbody tr.ativo input.fees_part').val(fees_part);
    }
    
    // Formulário editável
    $(function (){
        $('#table-fees tbody tr').mouseenter( function (){
           $(this).closest('tr').addClass('ativo');
        });
          
        $('.btn-gravar-fees').click( function() {
           dados = $('tr.ativo td > input').serialize();
           console.log(dados);
            swal({
                title: "Armazenar alterações",
                text: "Realmente e do seu interesse gravar essas alterações? Ainda e possível cancelar, se você prosseguir as alterações serão armazenadas (Salvas).",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonText: "Salvar",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                  },
                function(){                  
                    $.ajax({
                      type:'POST',
                      url:'<?= HOME_URI ?>/covenant/ajax-fees',
                      dataType: 'html',
                      data: dados,
                      success: function(retorno){
                        if(retorno == 1){
                            setTimeout(function(){
                                swal({title:'Gravação finalizada com sucesso!' ,type: "success", timer: 1250, showConfirmButton: false});
                            }, 1000);
                              
                        }else{
                            swal("Erro!", "Ouve um erro durante a exclusao do registro se o problema persistir contate o administrador :)", "error");
                        }
                      }
                    });
                });
        });
        
        $('#table-fees tbody tr').mouseleave( function(){
            $(this).closest('tr').removeClass('ativo');
        });
    
    });
        
    function delConfirm(id){
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
                setTimeout(function(){
                        window.location.href = document.URL + '&get_three=' + id;
                  }, 400 );
                
                //swal({title:'Eliminado!' ,type: "success", timer: 1250, showConfirmButton: false}, 
                //function(){ window.location.href = '<?= HOME_URI; ?>/laboratory?get=' + id; });
                
            }else{
                swal("Cancelado!", "O registro foi mantido :)", "error");
            }
          
        });
    };
       
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
                        <input id="fees_cod" type="text" name="fees_cod" placeholder="Ex: G300, P20, M30... " value="<?= htmlentities(chk_array($modelo->form_data, 'fees_cod')); ?>" class="form-control" 
                               data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo."
                               data-validation-help="Digite um nome com (3) ou mais caracteres.">
                        <br>
                    </div>

                    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                        <label for="fees_proc"><i style="color: red;">*</i> Procedimento:</label>
                        <input id="fees_proc" name="fees_proc" class="form-control" type="text" placeholder="Produto - Marca" value="<?php echo htmlentities(chk_array($modelo->form_data, 'fees_desc')); ?>">
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
                <i class="glyphicon glyphicon-eye-open"></i> Mostrar Formulário
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
                        <th class="text-center">Convênio</th>
                        <th class="text-center">Particular</th>
                        <th class="text-center">Diferença</th>
                        <th class="text-center">Salvar | Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $modelo->get_table_data(2, '*',  'covenant_fees', 'covenant_fees_id', $get_decode, 'fees_id') as $fetch_userdata  ): ?>
                    <tr class="text-center">
                        <td ><?= $fetch_userdata['fees_id']; ?> <input type="hidden" name="fees_id" class="form-control" value="<?= $fetch_userdata['fees_id']; ?>"></td>
                        <td id="fees_cod"   contenteditable="true" title="Código" class="edit"><?= $fetch_userdata['fees_cod']; ?> <input name="fees_cod" class="fees_cod" type="hidden" value=""></td>
                        <td id="fees_proc"  contenteditable="true" title="Procedimento" class="edit"><?= $fetch_userdata['fees_proc']; ?> <input name="fees_proc" class="fees_proc" type="hidden" value=""></td>
                        <td id="fees_cat"   contenteditable="true" title="Categoria" class="edit"><?= $fetch_userdata['fees_cat']; ?> <input name="fees_cat" class="fees_cat" type="hidden" value=""></td>
                        <td id="fees_desc"  contenteditable="true" title="Convênio" class="edit"><?= $fetch_userdata['fees_desc']; ?> <input name="fees_desc" class="fees_desc" type="hidden" value=""></td>
                        <td id="fees_part"  contenteditable="true" title="Particular" ><?= $fetch_userdata['fees_part']; ?><input  name="fees_part" class="fees_part" type="hidden" value=""></td>
                        <td><?= $fetch_userdata['fees_part']; ?></td>
                        <td>
                            <button title="Grava alterações" data-toggle="modal" data-target="#myModal" onclick="CarregaText()" class="btn btn-sm btn-default btn-gravar-fees">
                                <i style="color:#2196f3;" class="fa fa-1x fa-floppy-o" aria-hidden="true"></i>
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
                            echo '<tbody><tr><td class="text-center vazio" style="color: red;" >Não há produto cadastrado no sistema.</td></tr>'; 
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