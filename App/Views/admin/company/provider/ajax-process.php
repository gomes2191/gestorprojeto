<?php
# Verifica se constatante referente ao caminho foi definida


if ((filter_input(INPUT_POST, 'action_type')) && !empty(filter_input(INPUT_POST, 'action_type'))) {

    if (filter_input(INPUT_POST, 'action_type') == 'loadInfo') {
        $conditions['where'] = ['id' => GFunc::encodeDecode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
        $conditions['return_type'] = 'single';
        $allReg = $modelo->searchTable('Providers', $conditions);
        $allReg['id'] = $modelo->encodeDecode($allReg['id']);
        ($allReg['provider_sit'] == 'active') ? $allReg['provider_sit'] = 'Ativo' : FALSE;
        ($allReg['provider_sit'] == 'inactive') ? $allReg['provider_sit'] = 'Inativo' : FALSE;
        $allReg['provider_created'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['provider_created']);
        $allReg['provider_modified'] = $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['provider_modified']);
        echo json_encode($allReg);
    } elseif (filter_input(INPUT_POST, 'action_type') == 'loadEdit') {
        $id = GFunc::encodeDecode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
        $allReg = $modelo->listar(
            'Providers PR',
            'PR.*, AD.*, RP.`name` as rp_name, RP.`nickname` as rp_nickname, RP.`email` as rp_email, BK.*, GROUP_CONCAT(DISTINCT CT.`type`,CT.`owner`,":",CT.phone) as phone',
            "INNER JOIN Address AS AD ON PR.id = AD.id_provider
            INNER JOIN Contacts AS CT ON CT.id_provider = PR.id
            INNER JOIN Representatives AS RP ON RP.id_provider = PR.id
            INNER JOIN BankAccounts AS BK ON BK.id_representative = RP.id_provider
            WHERE PR.id = {$id}
            GROUP BY PR.id"
        );

        //var_dump($allReg);
        // die;
        //unset($id);

        //$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

        //echo json_encode($arr);
        /* $conditions['where'] = ['id' => GFunc::encodeDecode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
        $conditions['return_type'] = 'single';
        $allReg = $modelo->searchTable('Providers', $conditions);
        $allReg['id'] = GFunc::encodeDecode($allReg['id']);
        $allReg['provider_created'] = GFunc::convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['provider_created']);
        $allReg['provider_modified'] = GFunc::convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['provider_modified']); */

        echo json_encode($allReg[0], JSON_FORCE_OBJECT);
    } elseif (filter_input(INPUT_POST, 'action_type') == 'add') {
        # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
        return $modelo->formValidation();
    } elseif (filter_input(INPUT_POST, 'action_type') == 'update') {
        # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
        return $modelo->formValidation();
    } elseif (filter_input(INPUT_POST, 'action_type') == 'delete') {
        if (!empty(filter_input(INPUT_POST, 'id'))) {
            return $modelo->delRegister(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
        }
    }
} else {
    //header('Location: ' . HOME_URI . '/');
}
