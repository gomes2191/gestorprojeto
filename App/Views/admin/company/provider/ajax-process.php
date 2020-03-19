<?php
    # Verifica se constatante referente ao caminho foi definida
    if (!defined('ABSPATH')) { exit(); }

    if ((filter_input(INPUT_POST, 'action_type')) && !empty(filter_input(INPUT_POST, 'action_type'))) {

        if (filter_input(INPUT_POST, 'action_type') == 'loadInfo') {
            $conditions['where'] = ['id' => $modelo->encode_decode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
            $conditions['return_type'] = 'single';
            $allReg = $modelo->searchTable('providers', $conditions);
            $allReg['id'] = $modelo->encode_decode($allReg['id']);
            ($allReg['provider_sit'] == 'active') ? $allReg['provider_sit'] = 'Ativo' : FALSE;
            ($allReg['provider_sit'] == 'inactive') ? $allReg['provider_sit'] = 'Inativo' : FALSE;
            $allReg['provider_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['provider_created']);
            $allReg['provider_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['provider_modified']);
            echo json_encode($allReg);
        }elseif(filter_input(INPUT_POST, 'action_type') == 'loadEdit'){
            $conditions['where'] = ['id' => $modelo->encode_decode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
            $conditions['return_type'] = 'single';
            $allReg = $modelo->searchTable('providers', $conditions);
            $allReg['id'] = $modelo->encode_decode($allReg['id']);
            $allReg['provider_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['provider_created']);
            $allReg['provider_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['provider_modified']);
            echo json_encode($allReg);
        }elseif (filter_input(INPUT_POST, 'action_type') == 'add') {
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

