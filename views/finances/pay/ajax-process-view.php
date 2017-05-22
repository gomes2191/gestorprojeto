<?php
    # Verifica se constatante referente ao caminho foi definida
    if (!defined('ABSPATH')) { exit; }
    
    (filter_input_array(INPUT_POST)) ? $teste = $modelo->validate_register_form() : header('Location: '.HOME_URI.'/finances-pay');
    echo $teste;