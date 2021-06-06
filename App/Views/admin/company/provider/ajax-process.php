<?php
# Verifica se constatante referente ao caminho foi definida
if ((filter_input(INPUT_POST, 'action_type')) && !empty(filter_input(INPUT_POST, 'action_type'))) {
    if (filter_input(INPUT_POST, 'action_type') == 'loadInfo') {
        $result = $modelo->listar(
            'Providers PR',
            'PR.`name`, PR.`cpf_cnpj`, PR.`razao_social`, PR.`occupation_area`, PR.`insc_uf`, PR.`web_url`, PR.`status`, PR.`email`, PR.`obs`, PR.`created_at`,
            PR.`created_at`, PR.`modified_at`, AD.address, AD.`district`, AD.`city`, AD.`uf`, AD.`cep`, AD.`nation`, RP.`name` as rp_name, RP.`nickname` as rp_nickname,
            RP.`email` as rp_email, BK.`bank`, BK.`agency`, BK.`account`, BK.`holder`, GROUP_CONCAT(DISTINCT CT.`type`,CT.`owner`,":",CT.phone ORDER BY CT.phone SEPARATOR ",") as phone',
            "INNER JOIN Address AS AD ON PR.id = AD.id_provider
            INNER JOIN Contacts AS CT ON CT.id_provider = PR.id
            INNER JOIN Representatives AS RP ON RP.id_provider = PR.id
            INNER JOIN BankAccounts AS BK ON BK.id_representative = RP.id_provider
            WHERE PR.id = " . GFunc::encodeDecode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS)) . "
            GROUP BY PR.id"
        );
        foreach ($result as $allReg) {
            ($allReg['status'] == 'active') ? $allReg['status'] = 'Ativo' : FALSE;
            ($allReg['status'] == 'inactive') ? $allReg['status'] = 'Inativo' : FALSE;
            $allReg['cel'] = GFunc::getCode(explode(',', $allReg['phone']), 'CP');
            $allReg['phone'] = GFunc::getCode(explode(',', $allReg['phone']), 'TP');
            $allReg['rp_cel'] = GFunc::getCode(explode(',', $allReg['phone']), 'CR');
            $allReg['rp_phone'] = GFunc::getCode(explode(',', $allReg['phone']), 'TR');
            $allReg['created_at'] = GFunc::convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['created_at']);
            $allReg['modified_at'] = GFunc::convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['modified_at']);
        }
        // Retorna o JSON
        echo json_encode($allReg, JSON_FORCE_OBJECT);
    } elseif (filter_input(INPUT_POST, 'action_type') == 'loadEdit') {

        $result = $modelo->listar(
            'Providers PR', 'PR.`id`, PR.`name`, PR.`cpf_cnpj`, PR.`razao_social`, PR.`occupation_area`,
             PR.`insc_uf`, PR.`web_url`, PR.`status`, PR.`email`, PR.`obs`,
             AD.`address`, AD.`district`, AD.`city`, AD.`uf`, AD.`cep`, AD.`nation`,
             RP.`name` as rp_name, RP.`nickname` as rp_nickname, RP.`email` as rp_email,
             BK.`bank`, BK.`agency`, BK.`account`, BK.`bank`,
             GROUP_CONCAT(DISTINCT CT.`type`,CT.`owner`,":",CT.phone) as phone',
            "INNER JOIN Address AS AD ON PR.id = AD.id_provider
             INNER JOIN Contacts AS CT ON CT.id_provider = PR.id
             INNER JOIN Representatives AS RP ON RP.id_provider = PR.id
             INNER JOIN BankAccounts AS BK ON BK.id_representative = RP.id_provider
             WHERE PR.id = " . GFunc::encodeDecode(false, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS)) . "
             GROUP BY PR.id"
        );

        foreach ($result as $allReg) {
            $allReg['rp_cel']  = GFunc::getCode(explode(',', $allReg['phone']), 'CR');
            $allReg['rp_phone'] = GFunc::getCode(explode(',', $allReg['phone']), 'TR');
            $allReg['cel'] = GFunc::getCode(explode(',', $allReg['phone']), 'CP');
            $allReg['phone'] = GFunc::getCode(explode(',', $allReg['phone']), 'TP');
            $allReg['id'] = GFunc::encodeDecode($allReg['id']);
            //$allReg['created_at'] = GFunc::convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['created_at']);
            //$allReg['modified_at'] = GFunc::convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $allReg['modified_at']);
        }

        die(json_encode($allReg, JSON_FORCE_OBJECT));
    } elseif (filter_input(INPUT_POST, 'action_type') == 'add') {
        # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
        $modelo->formValidation();
    } elseif (filter_input(INPUT_POST, 'action_type') == 'update') {
        # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
        $modelo->formValidation();
    } elseif (filter_input(INPUT_POST, 'action_type') == 'delete') {
        if (!empty(filter_input(INPUT_POST, 'id'))) {
            $modelo->delReg(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
        }
    }
} else {
    header('Location: ' . Config::HOME_URI . '/');
}
