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
        $result = $modelo->listar(
            'Patrimony PA','PA.`id`, PA.`code`, PA.`description`, PA.`acquisition_date`, PA.`color`,
            PA.`provider`, PA.`dimension`, PA.`sector`, PA.`value`, PA.`warranty`, PA.`quantity`,
            PA.`receipt`, PA.`situation`, PA.`observation`',
            "WHERE PA.id = ".GFunc::encodeDecode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))."
            GROUP BY PA.`id`");

        foreach ($result as $allReg) {
            $allReg['id'] = GFunc::encodeDecode($allReg['id']);
        }

        // Imprime o JSON do resultado.
        die(json_encode($allReg, JSON_FORCE_OBJECT));
    } elseif (filter_input(INPUT_POST, 'action_type') == 'add') {
        # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
        $modelo->actionType('add');
    } elseif (filter_input(INPUT_POST, 'action_type') == 'update') {
        # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
        $modelo->actionType('update');
    } elseif (filter_input(INPUT_POST, 'action_type') == 'delete') {
        $modelo->actionType('delete');
    }
} else {
    //header('Location: ' . HOME_URI . '/');
}
