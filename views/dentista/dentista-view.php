<?php if (!defined('ABSPATH')) exit; ?>

<div class="row">
    <div class="col-md-12">
        <form class="form-signin" method="post">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="<?= Translate::t('dMsg_1'); ?>" name="q">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search" aria-hidden="true"></i></button>
                </div>
            </div>
            <br>
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
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <a href="#" class="btn btn-sx btn-info"  title="<?= Translate::t('dMsg_10'); ?>">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sx btn-danger" title="<?= Translate::t('dMsg_11'); ?>" >
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sx btn-success"  title="<?= Translate::t('dMsg_12'); ?>" >
                                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- /End start panel -->
        </form>
    </div> <!-- /col-md-12 -->
</div> <!-- /row -->
