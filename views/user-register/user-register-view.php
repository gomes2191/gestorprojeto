<?php if (!defined('ABSPATH')) exit; ?>

<div class="row-fluid">
    <?php
        // Carrega todos os métodos do modelo
        $modelo->validate_register_form();
        $modelo->get_register_form(chk_array($parametros, 1));
        $modelo->del_user($parametros);
    ?>
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title text-center">BETA - Tela de cadastro</h3>
          </div>
          <div class="panel-body">
                <form method="post" action="">

                  <?php echo ($modelo->form_msg); ?>
                    
                    <div class="form-group">
                        <label for="clinic_name">Nome da clinica:</label>
                        <input type="text" name="clinic_name" placeholder="Nome da clinica..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'clinic_name'));
                        ?>" class="form-control" id="clinic_name" required >
                    </div>
                    
                    <div class="form-group">
                        <label for="user_name">Seu nome:</label>
                        <input type="text" name="user_name" placeholder="Nome do responsavel pelo cadastro..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_name'));
                        ?>" class="form-control" id="user_name" >
                    </div>

                    <div class="form-group">
                        <label for="user_email">Email:</label>
                        <input type="text" name="user_email" placeholder="Seu email será seu usuário de login..." value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_email'));
                        ?>" class="form-control" id="user_email" >
                    </div>

                    <!--<div class="form-group">
                        <label for="user_user">Seu usuário:</label>
                        <input type="text" name="user_user"  class="form-control" placeholder="Usuário a ser utilizado para entrar no sistema..." id="user_user" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_user'));
                        ?>" >
                    </div>-->

                    <div class="form-group">
                        <label for="user_password"> Senha: </label>
                        <input type="password" name="user_password" class="form-control" placeholder="Sua senha para entrar no sistema.." id="user_password" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_password'));
                        ?>" >
                    </div>

                <!--<div class="form-group">
                        <label for="permission"><b>Permissions</b> <small>(Separate permissions using commas)</small></label>
                        <input type="text" name="user_permissions" class="form-control" placeholder="permission" id="permission" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_permissions'));
                        ?>" >
                    </div>-->
                    <button type="submit" class="btn btn-primary">Efetuar cadastro</button>
                    <!--<a href="<?php echo HOME_URI . '/user-register'; ?>">New user</a>-->
                </form>
            </div>
          <div class="panel-footer"></div>
        </div>
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
                            <!--<td>
                                <?php echo implode(',', unserialize($fetch_userdata['user_permissions'])) ?>
                            </td>-->
                            <td>
                                <a href="<?php echo HOME_URI ?>/user-register/index/edit/<?php echo $fetch_userdata['user_id'] ?>" class="btn btn-sx btn-info"  title="<?= Translate::t('dMsg_10'); ?>">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo HOME_URI ?>/user-register/index/del/<?php echo $fetch_userdata['user_id'] ?>" class="btn btn-sx btn-danger" title="<?= Translate::t('dMsg_11'); ?>" >
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sx btn-success"  title="<?= Translate::t('dMsg_12'); ?>" >
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="panel-footer"></div>
        </div> <!-- /End start panel -->
    </div>
    <div class="col-md-2"></div>
</div> <!-- /row  -->
