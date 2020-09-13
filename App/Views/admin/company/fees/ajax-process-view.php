<?php
# Verifica se constatante referente ao caminho foi definida
if (!defined('Config::HOME_URI')) {
    exit();
}

if ((filter_input(INPUT_POST, 'action_type')) && !empty(filter_input(INPUT_POST, 'action_type'))) {

    if (filter_input(INPUT_POST, 'action_type') == 'loadInfo') {
        $conditions['where'] = ['fees_id' => $modelo->encodeDecode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
        $conditions['return_type'] = 'single';
        $allReg = $modelo->searchTable('fees', $conditions);
        $allReg['fees_id'] = $modelo->encodeDecode($allReg['fees_id']);
        #($allReg['fees_sit'] == 'active') ? $allReg['fees_sit'] = 'Ativo' : FALSE;
        #($allReg['fees_sit'] == 'inactive') ? $allReg['fees_sit'] = 'Inativo' : FALSE;
        $allReg['fees_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['fees_created']);
        $allReg['fees_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['fees_modified']);
        echo json_encode($allReg);
    } elseif (filter_input(INPUT_POST, 'action_type') == 'loadEdit') {
        $conditions['where'] = ['fees_id' => $modelo->encodeDecode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
        $conditions['return_type'] = 'single';
        $allReg = $modelo->searchTable('fees', $conditions);
        $allReg['fees_id'] = $modelo->encodeDecode($allReg['fees_id']);
        $allReg['fees_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['fees_created']);
        $allReg['fees_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['fees_modified']);
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
