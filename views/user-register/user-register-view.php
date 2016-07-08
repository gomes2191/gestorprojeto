<?php if (!defined('ABSPATH')) exit; ?>

<div class="row">
    <?php
        // Carrega todos os métodos do modelo
        $modelo->validate_register_form();
        $modelo->get_register_form(chk_array($parametros, 1));
        $modelo->del_user($parametros);
    ?>
    <div class="col-md-12">
        <div class="panel panel-primary"> <!-- Start panel cad -->
            <div class="panel-heading">
                <h3 class="panel-title text-center"><b>TELA DE CADASTRO</b></h3>
            </div> 
            <div class="panel-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" name="user_name" placeholder="name" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_name'));
                        ?>" class="form-control" id="name" >

                    </div>
                    <div class="form-group">
                        <label for="user">Usuario:</label>
                        <input type="text" name="user"  class="form-control" placeholder="Usuario" id="user" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user'));
                        ?>" >
                    </div>

                    <div class="form-group">
                        <label for="password"> Senha: </label>
                        <input type="password" name="user_password" class="form-control" placeholder="Senha" id="password" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_password'));
                        ?>" >
                    </div>

                    <div class="form-group">
                        <label for="permission"><b>Permissions</b> <small>(Separate permissions using commas)</small></label>
                        <input type="text" name="user_permissions" class="form-control" placeholder="permission" id="permission" value="<?php
                        echo htmlentities(chk_array($modelo->form_data, 'user_permissions'));
                        ?>" >
                    </div>

                    <?php echo $modelo->form_msg; ?>
                    <button type="submit" class="btn btn-default">Salvar</button>
                    <a href="<?php echo HOME_URI . '/user-register'; ?>">New user</a>
                </form>
            </div> 
        </div> <!-- / End panel cad -->
        <?php
            // Lista os usuários
            $lista = $modelo->get_user_list();
        ?>
        <div class="panel panel-default"> <!-- Start panel -->
            <div class="panel-heading panel-primary text-center"><b><?= Translate::t('dMsg_2'); ?></b></div>
            <table class="table table-hover  table-text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?= Translate::t('dMsg_3'); ?></th>
                        <th><?= Translate::t('dMsg_4'); ?></th>
                        <th><?= Translate::t('dMsg_5'); ?></th>
                        <th><?= Translate::t('dMsg_6'); ?></th>
                        <th><?= Translate::t('dMsg_7'); ?></th>
                        <th><?= Translate::t('dMsg_8'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $fetch_userdata): ?>
                        <tr>
                            <th scope="row">
                                <?php echo $fetch_userdata['user_id'] ?>
                            </th>
                            <td>
                                <?php echo $fetch_userdata['user_name'] ?>                                
                            </td>
                            <td>
                                <?php echo $fetch_userdata['user'] ?>                               
                            </td>
                            <td>
                                <?php echo implode(',', unserialize($fetch_userdata['user_permissions'])) ?> 
                            </td>
                            <td>
                                <a href="<?php echo HOME_URI ?>/user-register/index/edit/<?php echo $fetch_userdata['user_id'] ?>" class="btn btn-sx btn-info"  title="<?= Translate::t('dMsg_10'); ?>">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo HOME_URI ?>/user-register/index/del/<?php echo $fetch_userdata['user_id'] ?>" class="btn btn-sx btn-danger" title="<?= Translate::t('dMsg_11'); ?>" >
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sx btn-success"  title="<?= Translate::t('dMsg_12'); ?>" >
                                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- /End start panel -->
    </div>
</div> <!-- /row  -->
