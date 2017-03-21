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
    
    $modelo->getJSON('bills_to_pay', 'pay_id');
?>

<script>
    //  Muda url da pagina
    //  window.history.pushState("fees", "", "fees");

    //  Faz um refresh de url apos fechar modal
    $(function () {
        $('#infor-view').on('hidden.bs.modal', function () {
            //document.location.reload();
            $(this).removeData('bs.modal');
        });
    });
</script>

<div class="row-fluid">
    <div class="col-md-12  col-sm-12 col-xs-12">
        <!--Implementação da nova tabela--> 

        <!-- Table Markup -->
        <table id="showcase-example-1" class="table" data-paging="true" data-filtering="true" data-sorting="true" data-editing="true" data-state="true">
        </table>

        <!-- Editing Modal Markup -->
        <div class="modal fade" id="editor-modal" tabindex="-1" role="dialog" aria-labelledby="editor-title">
            <style scoped>
                /* provides a red astrix to denote required fields - this should be included in common stylesheet */
                .form-group.required .control-label:after {
                    content:"*";
                    color:red;
                    margin-left: 4px;
                }
            </style>
            <div class="modal-dialog" role="document">
                <form class="modal-content form-horizontal" id="editor">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="editor-title">Add Row</h4>
                    </div>
                    <div class="modal-body">
                        <input type="number" id="id" name="id" class="hidden"/>
                        <div class="form-group required">
                            <label for="firstName" class="col-sm-3 control-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="lastName" class="col-sm-3 control-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jobTitle" class="col-sm-3 control-label">Job Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="jobTitle" name="jobTitle" placeholder="Job Title">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="startedOn" class="col-sm-3 control-label">Started On</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="startedOn" name="startedOn" placeholder="Started On" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="col-sm-3 control-label">Date of Birth</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Disabled">Disabled</option>
                                    <option value="Suspended">Suspended</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!--Implementação da nova tabela-->
        
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

