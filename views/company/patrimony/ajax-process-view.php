<?php
    # Verifica se constatante referente ao caminho foi definida
    if (!defined('ABSPATH')) { exit(); }

    if ((filter_input(INPUT_POST, 'action_type')) && !empty(filter_input(INPUT_POST, 'action_type'))) {
        if (filter_input(INPUT_POST, 'action_type') == 'data') {
            $conditions['where'] = ['patrimony_id' => $modelo->encode_decode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
            $conditions['return_type'] = 'single';
            $allReg = $modelo->searchTable('patrimony', $conditions);
            $allReg['patrimony_id'] = $modelo->encode_decode($allReg['patrimony_id']);
            $allReg['patrimony_data_aq'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y', $allReg['patrimony_data_aq']);
            #$allReg['payments_venc'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y', $allReg['payments_venc']);
            $allReg['patrimony_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['patrimony_created']);
            $allReg['patrimony_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['patrimony_modified']);
            echo json_encode($allReg);
        } elseif (filter_input(INPUT_POST, 'action_type') == 'add') {
            # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
            return $modelo->validate_register_form();
        } elseif (filter_input(INPUT_POST, 'action_type') == 'update') {
            # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
            return $modelo->validate_register_form();
        } elseif (filter_input(INPUT_POST, 'action_type') == 'delete') {
            if (!empty(filter_input(INPUT_POST, 'id'))) {
                return $modelo->delRegister(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
            }
        }
        exit();
    } else {
        //header('Location: ' . HOME_URI . '/');
    }

