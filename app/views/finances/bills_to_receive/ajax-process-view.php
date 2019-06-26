<?php
    # Verifica se constatante referente ao caminho foi definida
    if (!defined('ABSPATH')) { exit(); }

    if ((filter_input(INPUT_POST, 'action_type')) && !empty(filter_input(INPUT_POST, 'action_type'))) {

        if (filter_input(INPUT_POST, 'action_type') == 'loadInfo') {
            $conditions['where'] = ['receive_id' => $modelo->encode_decode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
            $conditions['return_type'] = 'single';
            $allReg = $modelo->searchTable('bills_to_receive', $conditions);
            $allReg['receive_id'] = $modelo->encode_decode($allReg['receive_id']);
            ($allReg['receive_sit'] == 'active') ? $allReg['receive_sit'] = 'Pago' : FALSE;
            ($allReg['receive_sit'] == 'inactive') ? $allReg['receive_sit'] = 'Não pago' : FALSE;
            $allReg['receive_date_venc'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y', $allReg['receive_date_venc']);
            $allReg['receive_date_pay'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y', $allReg['receive_date_pay']);
            $allReg['receive_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['receive_created']);
            $allReg['receive_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['receive_modified']);
            echo json_encode($allReg);
        }elseif(filter_input(INPUT_POST, 'action_type') == 'loadEdit'){
            $conditions['where'] = ['receive_id' => $modelo->encode_decode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
            $conditions['return_type'] = 'single';
            $allReg = $modelo->searchTable('bills_to_receive', $conditions);
            $allReg['receive_id'] = $modelo->encode_decode($allReg['receive_id']);
            $allReg['receive_date_venc'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y', $allReg['receive_date_venc']);
            $allReg['receive_date_pay'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y', $allReg['receive_date_pay']);
            //$allReg['patrimony_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['patrimony_created']);
            //$allReg['patrimony_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['patrimony_modified']);
            echo json_encode($allReg);
        }elseif (filter_input(INPUT_POST, 'action_type') == 'add') {
            # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
            return $modelo->validate_register_form();
        } elseif (filter_input(INPUT_POST, 'action_type') == 'update') {
            # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
            return $modelo->validate_register_form();
        } elseif (filter_input(INPUT_POST, 'action_type') == 'delete') {
            if (!empty(filter_input(INPUT_POST, 'id'))) {
                # Chama o método que remove o registro da base de dados
                return $modelo->delRegister(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
            }
        }
        
        unset($modelo, $allReg, $conditions);
        
        exit();
    }

