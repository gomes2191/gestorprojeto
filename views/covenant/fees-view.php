<?php
    if (!defined('ABSPATH')) {
        exit();
    }
    
    $get_decode = intval($modelo->encode_decode(0, filter_input(INPUT_GET, 'get_two', FILTER_DEFAULT)));
    
    //var_dump($modelo->get_table_data(2, 'covenant_id',  'covenant', 'covenant_id', $get_decode, 'covenant_id'));
    
    if(in_array($get_decode, $modelo->get_table_data(2, 'covenant_id',  'covenant', 'covenant_id', $get_decode, 'covenant_id'))) {
        echo 'Teste';
    }else{
        # Retorna para página 'covenant' caso não exista o id correspondente
        #echo'<script>window.location="'.HOME_URI.'/covenant";</script>';
        #exit();
    }


    # Verifica se existe a requisição POST se existir executa o método se não faz nada
    (filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : FALSE;
    
    # Configura o Feedback para o usuário
    $form_msg = $modelo->form_msg;
?>

<script>
    //Muda url da pagina
    //window.history.pushState("fees", "", "fees");
    
    // Chama o paginador da tabela    
    $( function() {
        $('#table-fees').DataTable({
            language: {
                url: '../Portuguese-Brasil.json'
            }
        });

    });
    
   
    
    $(function (){
        $('#table-fees tbody tr td.edit').dblclick( function(){
            if( $('td > input').length > 0){return;}
            var conteudoOriginal = $(this).text();
            var novoElemento = $('<input>',{type:'text', value:conteudoOriginal, class:'form-control fees-input-edit', name:'novo'}, '<input>', {type:'hidden', class:'fees_id', value:'brasil'});
            
            $(this).html(novoElemento.bind('blur keydown', function(e){
                
                
                if( $(this).parent().attr('title') == 'Código' ){
                 $('input.fees-input-edit').attr("name", "fees_cod");
                 
                
                }else if( $(this).attr('title') == 'Procedimento' ){

                }else if( $(this).attr('title') == 'Categoria' ){

                }else if( $(this).attr('title') == 'Convênio' ){

                }
                
                var keyCode = e.which;
                var conteudoNovo = $(this).val();
                if(keyCode == 13 && conteudoNovo != '' && conteudoNovo != conteudoOriginal){
                    
                    //var dados = [$(this).parents('tr').children().first().text()];
                    
                    //dados[$(this).attr('name')] = conteudoNovo ;
                    //dados['fees_id'] = $(this).parents('tr').children().first().text();
                    
                    //var teste1 = $(this).attr('name');
                    
                    //console.log(dados);
                    
                    var dados = $( ".fees_id, .fees-input-edit"  ).serialize();
                    console.log(dados);
                    var objeto = $(this);
                    $.ajax({
                    // Antes do envio
                    beforeSend: function() {
                        alert('Processando...');
                    }, 
                    type:'POST',
                    url:'',
                    dataType: 'html',
                    data: dados
                         //fees_id:$(this).parents('tr').children().first().text(),
                         //testo:testo}

                     ,
                    success:function(result){
                        objeto.parent().html(conteudoNovo);
                        $('body').append(result);

                    }
                        
                    });

                        
                }
                else if( keyCode == 27 ||  e.type == 'blur'){
                    $(this).parent().html(conteudoOriginal);
                }
                
            }));
            $(this).children().select();
        });
    });
      
      
</script>

<div class="row-fluid">
    <div class="col-md-10  col-sm-12 col-xs-12">
        <!--<h4 class="text-center">CADASTRO DE FORNECEDORES</h4>-->
        <form id="form-register" enctype="multipart/form-data" method="post" role="form" class="">
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
            <fieldset>
                <legend>TABELA DE HONORÁRIOS</legend>
                <div class="row form-compact new-fees" style="display: none;">
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="fees_cod"><i style="color: red;">*</i>Nr:</label>
                        <input type="hidden" name="fees_id" value="<?= htmlentities(chk_array($modelo->form_data, 'fees_id')); ?>">
                        <input id="fees_cod" type="text" name="fees_cod" placeholder="Ex: G300, P20, M30... " value="<?= htmlentities(chk_array($modelo->form_data, 'fees_cod')); ?>" class="form-control" 
                               data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo."
                               data-validation-help="Digite um nome com (3) ou mais caracteres.">
                        <br>
                    </div>

                    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                        <label for="fees_proc"><i style="color: red;">*</i> Procedimento:</label>
                        <input id="fees_proc" name="fees_desc" class="form-control" type="text" placeholder="Produto - Marca" value="<?php echo htmlentities(chk_array($modelo->form_data, 'fees_desc')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="fees_tipo_unit">Categoria:</label>
                        <select name="fees_tipo_unit" class="form-control">
                            <?php foreach ($modelo->get_table_data('*', 'fees_tipo_unitario', 'tipo_unitario_id') as $fetch_userdata): ?>
                                <option value="<?= $fetch_userdata['tipo_unitario']; ?>" <?= ($fetch_userdata['tipo_unitario'] == htmlentities(chk_array($modelo->form_data, 'fees_tipo_unit'))) ? 'selected' : ''; ?>><?= $fetch_userdata['tipo_unitario']; ?></option>
                            <?php endforeach; unset($fetch_userdata); ?>
                        </select>
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="fees_valor">Valor particular montante ( em reais )</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input id="fees_valor" name="fees_valor" style="border-radius: 0px !important;" type="text" class="form-control" placeholder="Montante..." value="<?= htmlentities(chk_array($modelo->form_data, 'fees_valor')); ?>">
                            <div class="input-group-addon">.00</div>
                        </div>
                        <br>
                    </div>
                    <br>
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
            <table id="table-fees" class="table table-bordered table-condensed table-hover table-format">
                <?php if ($modelo->get_table_data(2, 'fees_id',  'covenant_fees', 'covenant_fees_id', $get_decode, 'fees_id')): ?>
                <thead>
                    <tr class="cabe-title">
                        <th class="text-center">Nr</th>
                        <th class="text-center">Código</th>
                        <th class="text-center">Procedimento</th>
                        <th class="text-center">Categoria</th>
                        <th class="text-center">Convênio</th>
                        <th class="text-center">Particular</th>
                        <th class="text-center">Diferença</th>
                        <th class="text-center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $modelo->get_table_data(2, '*',  'covenant_fees', 'covenant_fees_id', $get_decode, 'fees_id') as $fetch_userdata  ): ?>
                    <tr class="text-center">
                        
                        <td > <?= $fetch_userdata['fees_id']; ?></td>
                        <td title="Código" class="edit"><?= $fetch_userdata['fees_cod']; ?></td>
                        <td title="Procedimento" class="edit"><?= $fetch_userdata['fees_proc']; ?></td>
                        <td title="Categoria" class="edit"><?= $fetch_userdata['fees_cat']; ?></td>
                        <td title="Convênio" class="edit"><?= $fetch_userdata['fees_conv']; ?></td>
                        <td title="Particular" class="edit"><?= $fetch_userdata['fees_part']; ?></td>
                        <td><?= $fetch_userdata['fees_part']; ?></td>
                        <td>
                            <a href="#" title="Eliminar registro" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-default">
                                <i style="color: #c71c22;" class="fa fa-1x fa-times" aria-hidden="true"></i>
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
                            echo '<tbody><tr><td class="text-center" style="color: red;" >Não há produto cadastrado no sistema.</td></tr>'; 
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