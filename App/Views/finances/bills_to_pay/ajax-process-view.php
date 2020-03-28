<?php
    # Verifica se constatante referente ao caminho foi definida
    if (!defined('ABSPATH')) { exit(); }

    if ((filter_input(INPUT_POST, 'action_type')) && !empty(filter_input(INPUT_POST, 'action_type'))) {

        if (filter_input(INPUT_POST, 'action_type') == 'loadInfo') {
            $conditions['where'] = ['pay_id' => $modelo->encode_decode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
            $conditions['return_type'] = 'single';
            $allReg = $modelo->searchTable('bills_to_pay', $conditions);
            $allReg['pay_id'] = $modelo->encode_decode($allReg['pay_id']);
            ($allReg['pay_sit'] == 'active') ? $allReg['pay_sit'] = 'Pago' : FALSE;
            ($allReg['pay_sit'] == 'inactive') ? $allReg['pay_sit'] = 'Não pago' : FALSE;
            $allReg['pay_venc'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y', $allReg['pay_venc']);
            $allReg['pay_date_pay'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y', $allReg['pay_date_pay']);
            $allReg['pay_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['pay_created']);
            $allReg['pay_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['pay_modified']);
            echo json_encode($allReg);
        }elseif(filter_input(INPUT_POST, 'action_type') == 'loadEdit'){
            $conditions['where'] = ['pay_id' => $modelo->encode_decode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
            $conditions['return_type'] = 'single';
            $allReg = $modelo->searchTable('bills_to_pay', $conditions);
            $allReg['pay_id'] = $modelo->encode_decode($allReg['pay_id']);
            $allReg['pay_venc'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y', $allReg['pay_venc']);
            $allReg['pay_date_pay'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y', $allReg['pay_date_pay']);
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

