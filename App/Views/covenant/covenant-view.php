<?php
if (!defined('ABSPATH')) {
    exit();
}

if (filter_input(INPUT_GET, 'get', FILTER_DEFAULT)) {
    $encode_id = filter_input(INPUT_GET, 'get', FILTER_DEFAULT);
    $modelo->delRegister($encode_id);

    # Destroy variavel não mais utilizadas
    unset($encode_id);
}

# Verifica se existe feedback e retorna o feedback se sim se não retorna false
$form_msg = $modelo->form_msg;
?>

<script>
    //  Muda a url atual para a nova url passada
    window.history.pushState("covenant", "", "covenant");

    //    //  Faz um refresh de url apos fechar modal
    //    $(function () {
    //        $('#visualizar-forne').on('hidden.bs.modal', function () {
    //            document.location.reload();
    //        });
    //    });

    // Chama o paginador da tabela    
    $(function() {
        if ($('.text-center').hasClass('vazio') == false) {
            $('#table-laboratory').DataTable({
                language: {
                    url: 'Portuguese-Brasil.json'
                }
            });
        }
    });

    // Executa a exclusão do registro
    function delConfirm(id) {
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
            function(isConfirm) {
                if (isConfirm) {
                    setTimeout(function() {
                        window.location.href = '<?= HOME_URI; ?>/covenant?get=' + id;
                    }, 400);

                    //swal({title:'Eliminado!' ,type: "success", timer: 1250, showConfirmButton: false}, 
                    //function(){ window.location.href = '<?= HOME_URI; ?>/laboratory?get=' + id; });

                } else {
                    swal("Cancelado!", "O registro foi mantido :)", "error");
                }

            });
    };
</script>

<div class="row-fluid">
    <div class="col-md-12 col-sm-12 col-sx-12">
        <?php
        if ($form_msg) {
            echo '<div class="alert alertH ' . $form_msg[0] . '  alert-dismissible fade in">
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

        <div class="input-group-sm">
            <a href="<?= HOME_URI; ?>/covenant/cad" title="Adicionar Convênio" class="btn btn-default btn-group-sm"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Adicionar Convênio </a>
        </div>
        <br>
        <div class="table-responsive">
            <br>
            <table id="table-covenant" class="table table-bordered table-condensed table-hover table-format">
                <?php if ($modelo->get_table_data(1, '*', 'covenant', NULL, NULL, 'covenant_id')) : ?>
                    <thead>
                        <tr class="cabe-title">
                            <th class="text-center">Empresa</th>
                            <th class="text-center">Telefone</th>
                            <th class="text-center">Honorários</th>
                            <th class="text-center">Editar</th>
                            <th class="text-center">Eliminar</th>
                            <th class="text-center">Informações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($modelo->get_table_data(1, '*', 'covenant', NULL, NULL, 'covenant_id') as $fetch_userdata) : ?>
                            <tr class="text-center">
                                <td><?= $fetch_userdata['covenant_nome']; ?></td>
                                <td><?= $fetch_userdata['covenant_tel_1']; ?></td>

                                <td>
                                    <a href="<?= HOME_URI; ?>/covenant/fees?get_two=<?= $modelo->encodeDecode($fetch_userdata['covenant_id']); ?>" title="Honorários" class="btn btn-sm btn-default">
                                        <i style="color: #2fa4e7;" class="fa fa-money" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= HOME_URI; ?>/covenant/cad?get=<?= $modelo->encodeDecode($fetch_userdata['covenant_id']); ?>" class="btn btn-sm btn-default" title="<?= Translate::t('dMsg_10'); ?>">
                                        <i style="color: #73a839;" class="fa fa-1x fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" title="Eliminar registro" onclick="delConfirm('<?= $modelo->encodeDecode($fetch_userdata['covenant_id']); ?>');" class="btn btn-sm btn-default">
                                        <i style="color: #c71c22;" class="fa fa-1x fa-times" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= HOME_URI; ?>/covenant/box-view?v=<?= $modelo->encodeDecode($fetch_userdata['covenant_id']); ?>" class="btn btn-sm btn-default" data-toggle="modal" data-target="#visualizar-forne" title="Visualizar cadastro">
                                        <i style="color: #2fa4e7;" class="fa fa-1x fa-info-circle" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php
                else :
                    echo '<tbody><tr><td class="text-center" style="color: red;" >Não há Empresa cadastrada.</td></tr>';
                endif;
                    ?>
                    </tbody>
            </table>
            <br>
        </div>
    </div> <!-- End col-md-12 -->
</div> <!-- End row-fluid -->
<?php unset($fetch_userdata); ?>