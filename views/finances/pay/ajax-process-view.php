<?php
    # Verifica se constatante referente ao caminho foi definida
    if (!defined('ABSPATH')) { exit; }
    echo ABSPATH;die;
    
    (filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : header('Location: '.HOME_URI.'/finances-pay');
    
