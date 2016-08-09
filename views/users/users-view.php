<?php if (!defined('ABSPATH')) exit; ?>

<div class="row-fluid">
    
    <?php
        // Carrega todos os métodos do modelo
        $modelo->validate_register_form();
        $modelo->get_register_form(chk_array($parametros, 1));
        $modelo->del_user($parametros);
    ?>
    
    <div class="col-md-12">       
        <form class="form-signin" method="post">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="<?= Translate::t('dMsg_1'); ?>" name="q">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search" aria-hidden="true"></i></button>
                </div>
            </div>
            <br>
            
        </form>
        
        
        <a href="<?php echo HOME_URI; ?>/user-register/" class="btn btn-primary">Adicionar usuário <i class="glyphicon glyphicon-user" aria-hidden="true"></i></a>
        
        
        <?php
            // Lista os usuários
            $lista = $modelo->get_user_list();
        ?>
        <div class="panel panel-primary"> <!-- Start panel -->
            <div class="panel-heading text-center"><?= Translate::t('dMsg_2'); ?></div>
            
            <table class="table table-hover  table-text-center table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?= Translate::t('dMsg_3'); ?></th>
                        <!--<th><?= Translate::t('dMsg_4'); ?></th>-->
                        <th><?= Translate::t('dMsg_5'); ?></th>
                        <th><?= Translate::t('dMsg_6'); ?></th>
                        <th><?= Translate::t('dMsg_7'); ?></th>
                        <th><?= Translate::t('dMsg_8'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $fetch_userdata): ?>
                        <tr>
                            <td>
                                <?php echo $fetch_userdata['user_id'] ?>
                            </td>
                            <td>
                                <?php echo $fetch_userdata['user_name'] ?>
                            </td>
                            <td>
                                <?php echo $fetch_userdata['user_email'] ?>
                            </td>
                            
                            <td>
                                <a href="<?php echo HOME_URI ?>/user-register/index/edit/<?php echo $fetch_userdata['user_id'] ?>" class="btn btn-sx btn-info"  title="<?= Translate::t('dMsg_10'); ?>">
                                    <i class="glyphicon glyphicon-edit" aria-hidden="true"></i>
                                </a>
                            </td>
                            
                            <td>
                                <button class="btn btn-sx btn-danger openBtn" data-toggle="modal" data-target="myModal"  title="<?= Translate::t('dMsg_11'); ?>" >
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-sx btn-success"  title="<?= Translate::t('dMsg_12'); ?>" >
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="panel-footer"></div>
        </div> <!-- /End start panel -->
        
        <div class="modal in fade"  role="dialog" id="myModal">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Remoção de usuário</h4>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja remover este usuário? não sera possivel reverter isso.
                    </div>
                    <div class="modal-footer">

                        <a href="<?php echo HOME_URI; ?>/user-register/" class="btn btn-primary">Não remover</a>
                        <a href="<?php echo HOME_URI ?>/user-register/index/del/<?php echo $fetch_userdata['user_id'] ?>/confirma " class="btn btn-danger" >Remover</a>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->
