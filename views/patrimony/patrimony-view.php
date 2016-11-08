<?php
    if (!defined('ABSPATH')) {
        exit();
    }
    $get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    if (isset($get['p'])) {
        $modelo->delRegister($get['p']);
    }
    $form_msg = $modelo->form_msg;
    unset($get);
?>

<script>
    //  Muda a url atual para a nova url passada
    window.history.pushState("patrimony", "", "patrimony");

    //  Faz um refresh de url apos fechar modal
    $(function () {
        $('#visualizar-forne').on('hidden.bs.modal', function () {
            document.location.reload();
        });
    });

    // Chama o paginador da tabela    
    $(function () {
        $('#table-for').DataTable({
            language: {
                url: 'Portuguese-Brasil.json'
            }
        });

    });

</script>

<div class="row-fluid">

    <div class="col-md-12 col-sm-12 col-sx-12">
        <?php
        if ($form_msg == true) {
            echo'<div class="alert alertH ' . $form_msg[0] . '  alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="' . $form_msg[1] . '" >&nbsp;</i>
                            <strong>' . $form_msg[2] . '</strong>&nbsp;' . $form_msg[3] . ' 
                            </div>';
            unset($form_msg);
        }
        ?>

        <div class="input-group-sm">
            <a href="<?= HOME_URI; ?>/patrimony/cad" title="Adicionar Patrimônio." class="btn btn-default btn-group-sm"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Adiciona Patrimônio </a>
        </div>
        <br>
        <div class="table-responsive">
            <br>
            <table id="table-for" class="table table-hover">
                <!--Apenas chama o metodo listar usuário que traz os valores obtidos e insere no vetor $lista -->
                <?php $lista = $modelo->get_listar(); ?>
                <?php if ($lista): ?>
                    <thead>
                        <tr>
                            <th class="text-center">CÓDIGO</th>
                            <th class="text-center">DESCRIÇÃO</th>
                            <th class="text-center">EDITAR</th>
                            <th class="text-center">ELIMINAR</th>
                            <th class="text-center">INFORMAÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($lista as $fetch_userdata): ?>
                            <tr class="text-center">
                                <td>
                                    <?= $fetch_userdata['patrimony_cod']; ?>
                                </td>
                                <td>
                                    <?= $fetch_userdata['patrimony_desc']; ?>
                                </td>
                                <td>
                                    <a href="<?= HOME_URI; ?>/providers/cad?pr=<?= $modelo->encode_decode($fetch_userdata['patrimony_id']); ?>" class="btn btn-sm btn-default"  title="<?= Translate::t('dMsg_10'); ?>">
                                        <i style="color: #73a839;" class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </td>

                                <td>
                                    <a href="#" title="Eliminar registro" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-default">
                                        <i style="color: #c71c22;" class="fa fa-2x fa-times" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= HOME_URI; ?>/patrimony/box-view?v=<?= $modelo->encode_decode($fetch_userdata['patrimony_id']); ?>" class="btn btn-sm btn-default" data-toggle="modal" data-target="#visualizar-forne" title="Visualizar cadastro" >
                                        <i style="color: #2fa4e7;" class="fa fa-2x fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php
                    else:
                        echo '<tr><td class="text-center" style="color: red;" >Não há patrimônio cadastrado no sistema.</td></tr>';
                    endif;
                    ?>
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
                        <a href="<?= HOME_URI; ?>/patrimony" class="btn btn-primary">Desistir</a>
                        <a href="<?= HOME_URI; ?>/patrimony?p=<?= $modelo->encode_decode($fetch_userdata['patrimony_id']); ?> " class="btn btn-danger" >Eliminar</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Start Modal visualizar fornecedores -->
        <div id="visualizar-forne" class="modal fade" >
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">

                </div>
            </div>
        </div><!-- End modal -->
    </div> <!-- End col-md-12 -->    
</div> <!-- End row-fluid -->
