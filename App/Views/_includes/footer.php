            <?php if ( !defined('ABSPATH')) {   exit(); } ?>

            </main> <!-- End Main container principal -->
            
            <!-- Bootstrap core JavaScript ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <!--<script>window.jQuery || document.write('<script src="<?php echo HOME_URI;?>/public/lib/_js/jquery.min.js"><\/script>')</script>-->

            <!-- Javascript customizado ===================================================== --> 
            <script src="<?= HOME_URI; ?>/public/js/scriptsFooter.js"></script>
            
            <?php
            
                if(isset($modelo->pag_type) && $modelo->pag_type == 'calendar'){
                    #--> Start JS
                    echo '<script src="'.HOME_URI.'/_agenda/js/calendar-param.js"></script>';
                    #--> End JS
                }
            ?>
            
    </body>
</html>