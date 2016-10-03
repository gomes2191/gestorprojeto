<?php if (!defined('ABSPATH')) {    exit(); }
    $get = filter_input_array(INPUT_GET, FILTER_DEFAULT);
    if(isset($get['p'])) {  $modelo->delRegister($get['p']); }
    elseif(isset($get['v']))    {$v = $get['v']; echo $v;}
    $form_msg = $modelo->form_msg;
    unset($get, $v);
?>
<!--Muda a url atual para a nova url passada-->
<script>window.history.pushState("providers", "", "providers");</script>
<div class="row-fluid">
    <div class="col-md-1 col-sm-0 col-sx-0"></div>
    <div class="col-md-10 col-sm-12 col-sx-12">
        <?php
            if ($form_msg == true) {
                echo'<div class="alert alertH ' . $form_msg[0] . '  alert-dismissible fade in">
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
            <a href="<?= HOME_URI; ?>/providers/cad" title="Adiciona fornecedor." class="btn btn-default btn-group-sm"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Adicionar fornecedor </a>
        </div>
        
        <!--Apenas chama o metodo listar usuário que traz os valores obtidos e insere no vetor $lista -->
        <?php $lista = $modelo->get_listar(); ?>
        
        <div class="panel"> <!-- Start panel -->
            <div class="panel-heading text-center"><h5>FORNECEDORES CADASTRADO NO SISTEMA</h5></div>
            
            <div class="table-responsive">
                <table id="table-for" class="table table-hover  table-text-center">
                <?php if ($lista): ?>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>EMPRESA</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                        <th>INFORMAÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($lista as $fetch_userdata): ?>
                    <tr>
                        <td>
                            <?= $fetch_userdata['provider_id']; ?>
                        </td>
                        <td>
                            <?= $fetch_userdata['provider_nome']; ?>
                        </td>
                        <td>
                            <a href="<?= HOME_URI; ?>/providers/cad?pr=<?= $modelo->encode_decode($fetch_userdata['provider_id']); ?>" class="btn btn-sx btn-info"  title="<?= Translate::t('dMsg_10'); ?>">
                                <i class="glyphicon glyphicon-edit" aria-hidden="true"></i>
                            </a>
                        </td>

                        <td>
                            <button class="btn btn-sx btn-danger openBtn" data-toggle="modal" data-target="#myModal"  title="<?= Translate::t('dMsg_11'); ?>" >
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-sx btn-success" data-toggle="modal" data-target="#visualizar-forne" title="<?= Translate::t('dMsg_12'); ?>" >
                                <span class="glyphicon glyphicon-info-sign"></span>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php
                      else:
                        echo '<tr><td class="text-center" style="color: red;" >Não há fornecedores cadastrado no sistema.</td></tr>';
                      endif;
                    ?>
                </tbody>
            </table>
            </div>
            <div class="panel-footer"><i>Tabela de fornecedores</i></div>
        </div> <!-- /End start panel -->
           
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

                        <a href="<?= HOME_URI; ?>/providers" class="btn btn-primary">Desistir</a>
                        <a href="<?= HOME_URI; ?>/providers?p=<?= $modelo->encode_decode($fetch_userdata['provider_id']); ?> " class="btn btn-danger" >Eliminar</a>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <!-- Start Modal visualizar fornecedores -->
        <div id="visualizar-forne" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">INFORMAÇÕES DA EMPRESA</h4>
                    </div>
                    <div class="modal-body">
                        <?= $id ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar X</button>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End col-md-12 -->    
    <div class="col-md-1 col-sm-0 col-sx-0"></div>
</div> <!-- End row-fluid -->
