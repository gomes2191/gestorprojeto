<?php if (!defined('ABSPATH')) {
    exit();
}

#   Verifica se existe o metodo get se exsite passa para variavel $get com o filtro necessario
$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

#   Verifica se existe o método $get['p'] na requisição   
if (isset($get['d'])) {
    $modelo->delRegister($get['d']);
}

#   Passa as mensagem de erro do sistema para a variável especificada
$form_msg = $modelo->form_msg;

#   Destroy a variável não mais utilizada
unset($get);
?>

<script>
    //  Muda a url atual para a nova url passada
    window.history.pushState("users", "", "users");

    //  Faz um refresh de url apos fechar modal
    $(function() {
        $('#visualizar-forne').on('hidden.bs.modal', function() {
            document.location.reload();
        });
    });

    // Chama o paginador da tabela    
    $(function() {
        $('#table-users').DataTable({
            language: {
                url: 'Portuguese-Brasil.json'
            }
        });

    });
</script>

<div class="row-fluid">
    <div class="col-md-12">
        <?php
        if ($form_msg == true) {
            echo '<div class="alert alertH ' . $form_msg[0] . '  alert-dismissible fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-info-circle fa-4" >&nbsp;</i>
                        <strong>' . $form_msg[1] . '</strong>&nbsp;' . $form_msg[2] . ' 
                    </div>';
            unset($form_msg);
        }
        ?>

        <div class="input-group-sm">
            <a href="<?= HOME_URI; ?>/users/register-dentist" title="Adicionar dentista" class="btn btn-sm btn-primary "><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> NOVO DENTISTA </a>
            <a href="<?= HOME_URI; ?>/users/register-employee" title="Adicionar usuário" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> NOVO USUÁRIO </a>
        </div>
        <br>
        <div class="table-responsive">
            <br>
            <table id="table-users" class="table table-hover  table-text-center table-responsive">
                <?php $lista = $modelo->get_listar();    ?>
                <?php if ($lista) :  ?>
                    <thead>
                        <tr>
                            <th>NOME</th>
                            <th>USUÁRIO</th>
                            <th>EDITAR</th>
                            <th>ELIMINAR</th>
                            <th>INFORMAÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                else :
                    echo '<tr><td><span style="color: #FF0000;">Não a usuário cadastrado no sistema</span></td></tr>';
                endif;
                    ?>

                    <?php foreach ($lista as $fetch_userdata) : ?>
                        <tr>
                            <td>
                                <?= $fetch_userdata['user_name']; ?>
                            </td>
                            <td>
                                <?= $fetch_userdata['user_email']; ?>
                            </td>

                            <td>
                                <?php if ($fetch_userdata['user_role_id'] == 1 or $fetch_userdata['user_role_id'] == 2) :  ?>
                                    <a href="<?= HOME_URI; ?>/users/register-employee?emp=<?= $modelo->encodeDecode($fetch_userdata['user_id']); ?>" class="btn btn-sm btn-default" title="<?= Translate::t('dMsg_10'); ?>">
                                        <i style="color: #73a839;" class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>


                                <?php
                                else :
                                    echo '<a href="' . HOME_URI . '/users/register-dentist?de=' . $modelo->encodeDecode($fetch_userdata['user_id']) . '" class="btn btn-sm btn-default"  title="' . Translate::t('dMsg_10') . '">
                                                    <i style="color: #73a839;" class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>';
                                endif;
                                ?>
                            </td>

                            <td>
                                <a href="#" title="Eliminar registro" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-default">
                                    <i style="color: #c71c22;" class="fa fa-2x fa-times" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a href="<?= HOME_URI; ?>/users/box-view?v=<?= $modelo->encodeDecode($fetch_userdata['user_id']); ?>" class="btn btn-sm btn-default" data-toggle="modal" data-target="#visualizar-forne" title="Visualizar cadastro">
                                    <i style="color: #2fa4e7;" class="fa fa-2x fa-info-circle" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
            </table>
            <br>
        </div>
        <!--End table responsiva-->

        <!-- Start Modal deletar users -->
        <div class="modal in fade" role="dialog" id="myModal">
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

                        <a href="<?= HOME_URI; ?>/users" class="btn btn-primary">Desistir</a>
                        <a href="<?= HOME_URI; ?>/users?d=<?= $modelo->encodeDecode($fetch_userdata['user_id']); ?> " class="btn btn-danger">Eliminar</a>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Start Modal visualizar fornecedores -->
        <div id="visualizar-forne" class="modal fade">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">

                </div>
            </div>
        </div><!-- End modal -->

    </div> <!-- /col-md-12 -->
</div> <!-- /row -->