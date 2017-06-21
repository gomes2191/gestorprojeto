<?php
    # Verifica se constatante referente ao caminho foi definida
    if (!defined('ABSPATH')) {
        exit();
    }

    if (filter_input_array(INPUT_POST)) {
        if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
            if ($_POST['action_type'] == 'data') {
                $conditions['where'] = ['pay_id' => $modelo->encode_decode(0, $_POST['id'])];
                $conditions['return_type'] = 'single';
                $allReg = $modelo->searchTable('bills_to_pay', $conditions);
                echo json_encode($allReg);
            } elseif ($_POST['action_type'] == 'add') {
                # Retorna a função que faz o registro no sistema e finaliza.
                return $modelo->validate_register_form();
            } elseif ($_POST['action_type'] == 'edit') {
                # Retorna a função que faz o update e finaliza.
                return $modelo->validate_register_form();
            } elseif ($_POST['action_type'] == 'delete') {
                if (!empty($_POST['id'])) {
                    return $modelo->delRegister($_POST['id']);
                }
            }
            exit;
        }
    } else {
        header('Location: ' . HOME_URI . '/');
    }
    
    
    
    
    