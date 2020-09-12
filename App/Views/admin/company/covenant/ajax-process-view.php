<?php
# Verifica se constatante referente ao caminho foi definida
if (!defined('ABSPATH')) {
    exit();
}

if ((filter_input(INPUT_POST, 'action_type')) && !empty(filter_input(INPUT_POST, 'action_type'))) {

    if (filter_input(INPUT_POST, 'action_type') == 'loadInfo') {
        $conditions['where'] = ['covenant_id' => $modelo->encodeDecode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
        $conditions['return_type'] = 'single';
        $allReg = $modelo->searchTable('covenant', $conditions);
        $allReg['covenant_id'] = $modelo->encodeDecode($allReg['covenant_id']);
        ($allReg['covenant_sit'] == 'active') ? $allReg['covenant_sit'] = 'Ativo' : FALSE;
        ($allReg['covenant_sit'] == 'inactive') ? $allReg['covenant_sit'] = 'Inativo' : FALSE;
        $allReg['covenant_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['covenant_created']);
        $allReg['covenant_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['covenant_modified']);
        echo json_encode($allReg);
    } elseif (filter_input(INPUT_POST, 'action_type') == 'loadEdit') {
        $conditions['where'] = ['covenant_id' => $modelo->encodeDecode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
        $conditions['return_type'] = 'single';
        $allReg = $modelo->searchTable('covenant', $conditions);
        $allReg['covenant_id'] = $modelo->encodeDecode($allReg['covenant_id']);
        $allReg['covenant_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['covenant_created']);
        $allReg['covenant_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['covenant_modified']);
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
