<?php
    # Verifica se constatante referente ao caminho foi definida
    if (!defined('ABSPATH')) { exit(); }
    
        if (filter_input(INPUT_POST, 'action_type') && !empty(filter_input(INPUT_POST, 'action_type'))) {
            if (filter_input(INPUT_POST, 'action_type') == 'data') {
                $conditions['where'] = ['pay_id' => $modelo->encode_decode(0, filter_input(INPUT_POST, 'id'))];
                $conditions['return_type'] = 'single';
                $allReg = $modelo->searchTable('bills_to_pay', $conditions);
                echo json_encode($allReg);
            } elseif (filter_input(INPUT_POST, 'action_type') == 'add') {
                # Retorna a função que faz o registro no sistema e finaliza.
                return $modelo->validate_register_form();
            } elseif (filter_input(INPUT_POST, 'action_type') == 'edit') {
                # Retorna a função que faz o update e finaliza.
                return $modelo->validate_register_form();
            } elseif (filter_input(INPUT_POST, 'action_type') == 'delete') {
                if (!empty(filter_input(INPUT_POST, 'id'))) {
                    return $modelo->delRegister(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
                }
            }
            exit();
        }else {
            header('Location: ' . HOME_URI . '/');
        }
    
    
    
    
    