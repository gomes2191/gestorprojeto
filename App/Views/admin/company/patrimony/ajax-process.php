<?php

if ((filter_input(INPUT_POST, 'action_type')) && !empty(filter_input(INPUT_POST, 'action_type'))) {
    if (filter_input(INPUT_POST, 'action_type') == 'loadInfo') {
        $conditions['where'] = ['patrimony_id' => $modelo->encodeDecode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
        $conditions['return_type'] = 'single';
        $allReg = $modelo->searchTable('patrimony', $conditions);
        $allReg['patrimony_id'] = $modelo->encodeDecode($allReg['patrimony_id']);
        ($allReg['patrimony_sit'] == 'active') ? $allReg['patrimony_sit'] = 'Ativo' : FALSE;
        ($allReg['patrimony_sit'] == 'inactive') ? $allReg['patrimony_sit'] = 'Inativo' : FALSE;
        $allReg['patrimony_data_aq'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y', $allReg['patrimony_data_aq']);
        $allReg['patrimony_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['patrimony_created']);
        $allReg['patrimony_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['patrimony_modified']);
        echo json_encode($allReg);
    } elseif (filter_input(INPUT_POST, 'action_type') == 'loadEdit') {
        $conditions['where'] = ['patrimony_id' => $modelo->encodeDecode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
        $conditions['return_type'] = 'single';
        $allReg = $modelo->searchTable('patrimony', $conditions);
        $allReg['patrimony_id'] = $modelo->encodeDecode($allReg['patrimony_id']);
        $allReg['patrimony_data_aq'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y', $allReg['patrimony_data_aq']);
        $allReg['patrimony_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['patrimony_created']);
        $allReg['patrimony_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['patrimony_modified']);
        die(json_encode($allReg, JSON_FORCE_OBJECT));
    } elseif (filter_input(INPUT_POST, 'action_type') == 'add') {
        # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
        $modelo->formValidation();
    } elseif (filter_input(INPUT_POST, 'action_type') == 'update') {
        # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
        return $modelo->validate_register_form();
    } elseif (filter_input(INPUT_POST, 'action_type') == 'delete') {
        if (!empty(filter_input(INPUT_POST, 'id'))) {
            # Chama o método que remove o registro da base de dados
            return $modelo->delRegister(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
        }
    }
    exit();
} else {
    //header('Location: ' . HOME_URI . '/');
}
