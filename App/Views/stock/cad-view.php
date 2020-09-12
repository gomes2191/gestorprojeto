<?php
if (!defined('ABSPATH')) {
    exit();
}

# Verifica se existe o método get se existir chama função
if (filter_input(INPUT_GET, 'pa', FILTER_DEFAULT)) {
    $id_encode = filter_input(INPUT_GET, 'pa', FILTER_DEFAULT);

    $modelo->get_register_form($id_encode);

    # Destroy variáveis não mais utilizada
    unset($id_encode);
}

# Verifica se existe a requisição POST se existir executa o método se não faz nada
(filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : FALSE;
# Configura o Feedback para o usuário
$form_msg = $modelo->form_msg;
?>

<script>
    window.history.pushState("cad", "", "cad");
</script>

<div class="row-fluid">
    <div class="col-md-1  col-sm-0 col-xs-0"></div>
    <div class="col-md-10  col-sm-12 col-xs-12">
        <!--<h4 class="text-center">CADASTRO DE FORNECEDORES</h4>-->
        <form id="form-register" enctype="multipart/form-data" method="post" role="form" class="">
            <?php
            if ($form_msg) {
                echo '<div class="alert alertH ' . $form_msg[0] . ' alert-dismissible fade in">
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
                <legend>Informações do produto</legend>
                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="stock_cod"><i style="color: red;">*</i> Código:</label>
                        <input type="hidden" name="stock_id" value="<?= htmlentities(chkArray($modelo->form_data, 'stock_id')); ?>">
                        <input id="stock_cod" type="text" name="stock_cod" placeholder="Ex: G300, P20, M30... " value="<?= htmlentities(chkArray($modelo->form_data, 'stock_cod')); ?>" class="form-control" data-validation="custom" data-validation-regexp="^([A-z0-9\s]{3,40})$" data-validation-error-msg="Preencha corretamente o campo." data-validation-help="Digite um nome com (3) ou mais caracteres.">
                        <br>
                    </div>

                    <div class="form-group col-md-4 col-sm-12 col-xs-12">
                        <label for="stock_desc"><i style="color: red;">*</i> Descreva o produto:</label>
                        <input id="stock_desc" name="stock_desc" class="form-control" type="text" placeholder="Produto - Marca" value="<?php echo htmlentities(chkArray($modelo->form_data, 'stock_desc')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="stock_tipo_unit">Tipo unitário:</label>
                        <select name="stock_tipo_unit" class="form-control">
                            <?php foreach ($modelo->get_table_data('*', 'stock_tipo_unit', 'tipo_unitario_id') as $fetch_userdata) : ?>
                                <option value="<?= $fetch_userdata['tipo_unitario']; ?>" <?= ($fetch_userdata['tipo_unitario'] == htmlentities(chkArray($modelo->form_data, 'stock_tipo_unit'))) ? 'selected' : ''; ?>><?= $fetch_userdata['tipo_unitario']; ?></option>
                            <?php endforeach;
                            unset($fetch_userdata); ?>
                        </select>
                        <br>
                    </div>

                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="stock_fornecedor">Fornecedor:</label>
                        <input id="stock_fornecedor" name="stock_fornecedor" class="form-control" type="text" placeholder="Fornecedor..." value="<?php echo htmlentities(chkArray($modelo->form_data, 'stock_fornecedor')); ?>">
                        <br>
                    </div>
                    <br>
                </div>

                <div class="row form-compact">
                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="stock_inicial">Estoque inicial:</label>
                        <input id="stock_inicial" name="stock_inicial" class="form-control" type="text" placeholder="100" value="<?php echo htmlentities(chkArray($modelo->form_data, 'stock_inicial')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="stock_minimo">Estoque minimo:</label>
                        <input id="stock_minimo" name="stock_minimo" class="form-control" type="text" placeholder="10" value="<?php echo htmlentities(chkArray($modelo->form_data, 'stock_minimo')); ?>">
                        <br>
                    </div>

                    <div class="form-group col-md-2 col-sm-12 col-xs-12">
                        <label for="stock_atual">Estoque atual:</label>
                        <input id="stock_atual" name="stock_atual" class="form-control" type="text" placeholder="95" value="<?php echo htmlentities(chkArray($modelo->form_data, 'stock_atual')); ?>">
                        <br>
                    </div>
                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                        <label for="stock_valor">Montante total ( em reais )</label>
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input id="stock_valor" name="stock_valor" style="border-radius: 0px !important;" type="text" class="form-control" placeholder="Montante..." value="<?= htmlentities(chkArray($modelo->form_data, 'stock_valor')); ?>">
                            <div class="input-group-addon">.00</div>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="row form-compact">
                    <div class="form-group col-md-7 col-xs-12 col-sm-12">
                        <label for="stock_info">Informações extra:</label>
                        <textarea id="stock_info" class="form-control" name="stock_info" style="margin-top: 0px; width: 100%; max-width: 100%;  margin-bottom: 0px; height: 150px; text-align: justify;" rows="3" placeholder="Outras informações..."><?php echo htmlentities(chkArray($modelo->form_data, 'stock_info')); ?></textarea>
                        <br>
                    </div>

                    <div class="form-group col-md-5 col-sm-12 col-xs-12">
                        <br>
                        <div class="btn-group">
                            <a href="<?= HOME_URI; ?>/stock" class="btn btn-default" title="Lista cadastros"><i class="fa fa-list fa-1x" aria-hidden="true"></i> Listar Cadastros</a>
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
    <div class="col-md-1  col-sm-0 col-xs-0"></div>
</div> <!-- /row  -->

<script>
    $('.top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');
        return false;

    });
</script>