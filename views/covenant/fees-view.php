<?php
    if (!defined('ABSPATH')) {
        exit();
    }
    
    $get_decode = intval($modelo->encode_decode(0, filter_input(INPUT_GET, 'get_two', FILTER_DEFAULT)));
    
    var_dump($modelo->get_table_data(2, 'covenant_id',  'covenant', 'covenant_id', $get_decode, 'covenant_id'));
    
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
    
    if(isset($_POST['msg'])) {
    //salva no banco de dados
    echo 'sucesso'; // sucesso
    echo $_POST['msg'];
} else {
    echo 'falha'; // falhou
}
?>

<script>
    //Muda url da pagina
    //window.history.pushState("fees", "", "fees");
    
    // Chama o paginador da tabela    
    $(function () {
        $('#table-covenant').DataTable({
            language: {
                url: '../Portuguese-Brasil.json'
            }
        });

    });
    
    
  $(function(){
  $('#i-msg').hide();
  $('#b-msg').hide();
  
  $('#t-msg').click(function(){
      $('#t-msg').toggle('fast');
      $('#i-msg').val($('#t-msg').text());
      $('#i-msg').toggle('fast');
      $('#b-msg').toggle('fast');
  });
  
  $('#b-msg').click(function(){
      $('#t-msg').text($('#i-msg').val());
    
      $.post(
           "fees",
           "msg="+ $('#t-msg').text(),
        function (retorno) {
          if (retorno != "success") {
            // Quando der erro
            alert('erro');
          } else {
            // Quando salvar
            alert('certo');
          }
      });
    
      $('#i-msg').toggle('fast');
      $('#b-msg').toggle('fast');
      $('#t-msg').toggle('fast');
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
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="fees_cod"><i style="color: red;">*</i> Código:</label>
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

                <div class="row form-compact">
                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <div class="btn-group">
                            <a href="<?= HOME_URI; ?>/covenant" class="btn btn-default" title="Ir para lista de conveniados"><i class="fa fa-list fa-1x" aria-hidden="true"></i> Listar convênios</a>
                        </div>
                        <div class="btn-group">
                            <button title="Salvar informações" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-floppy-save"></i> Salvar</button>
                        </div>
                        <div class="btn-group">
                            <button title="Limpar formulário" class="btn btn-default marg-top" type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                        </div>
                        <div class="btn-group">
                            <span title="Ir ao topo da página" class="btn btn-default marg-top"><i class="top glyphicon glyphicon-arrow-up"></i></span>
                        </div>
                        <br>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div> <!-- /row  -->
<div class="row-fluid">
    <div class="col-md-12  col-sm-12 col-xs-12">
        <div class="table-responsive">
            <br>
            <table id="table-covenant" class="table table-bordered table-condensed table-hover table-format">
                <?php if ($modelo->get_table_data(2, 'fees_id',  'covenant_fees', 'covenant_fees_id', $get_decode, 'fees_id')): ?>
                <thead>
                    <tr class="cabe-title">
                        <th class="text-center">Código</th>
                        <th class="text-center">Procedimento</th>
                        <th class="text-center">Particular</th>
                        <th class="text-center">Convênio</th>
                        <th class="text-center">Diferença</th>
                        <th class="text-center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $modelo->get_table_data(1, '*', 'covenant_fees', NULL, NULL, 'fees_id') as $fetch_userdata  ): ?>
                    <tr class="text-center">
                        <td><?= $fetch_userdata['fees_cod']; ?></td>
                        <td >
                            <span id="t-msg"><?= $fetch_userdata['fees_proc']; ?></span>
                            
                            <input id="i-msg" name="msg" style="border-radius: 0px !important;" type="text" class="form-control" placeholder="Montante..." value="<?= htmlentities(chk_array($modelo->form_data, 'fees_valor')); ?>">
                            <button id="b-msg">Ok</button>
                            
                        </td>
                        <td><?= $fetch_userdata['fees_cat']; ?></td>
                        <td><?= $fetch_userdata['fees_part']; ?></td>
                        <td><?= $fetch_userdata['fees_part']; ?></td>
                        <td><?= $fetch_userdata['fees_part']; ?></td>
                       
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