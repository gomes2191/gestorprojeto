<?php
# Verifica se a constante existe "Config::HOME_URI" existe, se nao existir sai
if (!defined('Config::HOME_URI')) {
    exit;
}

if (!empty(filter_input_array(INPUT_POST))) {
    # Verifica se existe encode_id se existe executa o metod de exclusão
    if ((filter_input(INPUT_POST, 'encode_id'))) {
        $modelo->delRegister(filter_input(INPUT_POST, 'encode_id'));
        echo $modelo->form_msg;
    } else {
        $modelo->validate_register_form();
        echo $modelo->form_msg;
    }
} else {
    exit();
}
