<?php if ( ! defined('ABSPATH')) exit; ?>

<div class="row">
    <form class="form-signin" method="post">
        <div class="panel panel-default"> <!-- Start panel --> 
            <div class="panel-heading"><b><?= Translate::t('dMsg_2'); ?></b></div>
            <table class="table">
                <thead> 
                    <tr> 
                        <th>#</th> 
                        <th><?= Translate::t('dMsg_3'); ?></th>
                        <th><?= Translate::t('dMsg_4'); ?></th>
                        <th><?= Translate::t('dMsg_5'); ?></th> 
                    </tr> 
                </thead>
                <tbody> 
                    <tr> <th scope="row">1</th> <td>Mark</td> <td>Otto</td> <td>@mdo</td> </tr>
                    <tr> <th scope="row">2</th> <td>Jacob</td> <td>Thornton</td> <td>@fat</td> </tr>
                    <tr> <th scope="row">3</th> <td>Larry</td> <td>the Bird</td> <td>@twitter</td> </tr>
                </tbody> 
            </table> 
        </div> <!-- /End start panel -->
    </form>
    <div class="col-md-4"></div>
</div> <!-- /row -->