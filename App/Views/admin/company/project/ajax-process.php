<?php
# Verifica se constatante referente ao caminho foi definida
if ((filter_input(INPUT_POST, 'action_type')) && !empty(filter_input(INPUT_POST, 'action_type'))) {
    if (filter_input(INPUT_POST, 'action_type') == 'loadInfo') {
        $result = $modelo->listar(
            'Projects PR',
            'PR.*, MAX(AC.end_date) bigDate, group_concat(AC.finished separator ":") finished,
            sum(if(finished <= 1, 1,0)) total, sum(if(finished=1, 1,0)) totalF',
            "LEFT JOIN Activities AC On PR.id=AC.id_project
            GROUP BY PR.id ORDER BY PR.id"
        );

        foreach ($result as $allReg) {
            $allReg['start_date'] = GFunc::convertDataHora('Y-m-d', 'd/m/Y', $allReg['start_date']);
            $allReg['end_date'] = GFunc::convertDataHora('Y-m-d', 'd/m/Y', $allReg['end_date']);
            $allReg['progress'] = (($reg['total'] >= 1) ? (($reg['totalF'] / $reg['total']) * 100) . '%' : '100%');
            $allReg['late'] = (($allReg['end_date'] < $reallReg['bigDate']) ? 'Sim' : 'Não');
        }
        // Retorna o JSON
        echo json_encode($allReg, JSON_FORCE_OBJECT);
    } elseif (filter_input(INPUT_POST, 'action_type') == 'loadEdit') {
        $result = $modelo->listar(
            "Projects PR",
            "PR.*",
            "WHERE PR.id=" . GFunc::encodeDecode(false, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))
        );

        foreach ($result as $allReg) {
            $allReg['id'] = GFunc::encodeDecode($allReg['id']);
            $allReg['start_date'] = GFunc::convertDataHora('Y-m-d', 'd/m/Y', $allReg['start_date']);
            $allReg['end_date'] = GFunc::convertDataHora('Y-m-d', 'd/m/Y', $allReg['end_date']);
        }

        die(json_encode($allReg, JSON_FORCE_OBJECT));
    } elseif (filter_input(INPUT_POST, 'action_type') == 'add') {
        # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
        $modelo->actionType();
    } elseif (filter_input(INPUT_POST, 'action_type') == 'update') {
        # Chama a função que trata os dados do formulário e faz update o insert conforme a condição passada.
        $modelo->actionType();
    } elseif (filter_input(INPUT_POST, 'action_type') == 'delete') {
        if (!empty(filter_input(INPUT_POST, 'id'))) {
            $modelo->delReg(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
        }
    }
} else {
    header('Location: ' . Config::HOME_URI . '/');
}
