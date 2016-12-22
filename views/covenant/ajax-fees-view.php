<?php
    if (!defined('ABSPATH')) { exit; }
    
    #   Verifica se existe o método post e executa os parametros necessarios caso exista
    (filter_input_array(INPUT_POST)) ? $modelo->validate_register_form() : FALSE;
    
    if($modelo->form_msg == TRUE){
        echo 1;
        
    }else{
        exit();
    }