<?php


if (defined('Config::ABS_PATH') && (!filter_has_var(INPUT_POST, 'get_decode'))) {
    exit();
}

# Parâmetros de páginação
//$tblName = 'Providers p';

//$tblJoinName = ['Address', 'BankAccounts'];

//$conditions['innerJoin'] = ['Address.id_provider' => 'p.id', 'BankAccounts.id_representative' => 'p.id'];

// Recebe os parâmetros do tipo de banco.
$offset = Config::DB_DRIVER['offset'];

# Recebe o valor da quantidade de registro por páginas.
$qtdLine = filter_input(INPUT_POST, 'qtdLine', FILTER_VALIDATE_INT);

/*
* Rotina que verifica se o valor da quantidade
* de pagina e = ou menor que 0 ou superior a 50.
*/
if (($qtdLine <= 0) or ($qtdLine > 50)) {
    $limit = 5;
} else {
    $limit = $qtdLine;
}

$start = !empty(filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT)) ? filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT) : 0;

if (!empty(filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING))) {
    $allReg = $modelo->listar('Providers PR', 'PR.id, PR.`name`, PR.`email`,  PR.`occupation_area`, PR.`status`, AD.uf, GROUP_CONCAT(DISTINCT CT.`type`,CT.`owner`,":",CT.phone) as phone', "INNER JOIN  Address AS AD ON PR.id = AD.id_provider
    INNER JOIN Contacts AS CT ON CT.id_provider = PR.id
    WHERE PR.name LIKE '" . '%' . filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING, TRUE) . '%' . "' OR PR.occupation_area LIKE '" . '%' . filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING, TRUE) . '%' . "'
    GROUP BY PR.id
    ORDER BY PR.id DESC LIMIT {$start}{$offset}{$limit}");
    $count = count($allReg);
} elseif (!empty(filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING))) {
    $sortBy = filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING);
    switch ($sortBy) {
        case 'active':
            $count = (is_array($count = $modelo->listar('Providers P', '*', "WHERE P.status='active'"))) ? COUNT($count) : 0;
            $allReg = $modelo->listar('Providers PR', 'PR.id, PR.`name`, PR.`email`,  PR.`occupation_area`, PR.`status`, AD.uf, GROUP_CONCAT(DISTINCT CT.`type`,CT.`owner`,":",CT.phone) as phone', "INNER JOIN  Address AS AD ON PR.id = AD.id_provider
            INNER JOIN Contacts AS CT ON CT.id_provider = PR.id
            WHERE PR.status='active'
            GROUP BY PR.id
            ORDER BY PR.id DESC LIMIT {$start}{$offset}{$limit}");
            break;
        case 'inactive':
            $count = (is_array($count = $modelo->listar('Providers p', '*', "WHERE p.status='inactive'"))) ? COUNT($count) : 0;
            $allReg = $modelo->listar('Providers PR', 'PR.id, PR.`name`, PR.`email`,  PR.`occupation_area`, PR.`status`, AD.uf, GROUP_CONCAT(DISTINCT CT.`type`,CT.`owner`,":",CT.phone) as phone', "INNER JOIN  Address AS AD ON PR.id = AD.id_provider
            INNER JOIN Contacts AS CT ON CT.id_provider = PR.id
            WHERE PR.status='inactive'
            GROUP BY PR.id
            ORDER BY PR.id DESC LIMIT {$start}{$offset}{$limit}");
            break;
        case 'asc':
            $count = (is_array($count = $modelo->listar('Providers P', '*'))) ? COUNT($count) : 0;
            $allReg = $modelo->listar(
                'Providers PR',
                'PR.id, PR.`name`, PR.`email`,  PR.`occupation_area`, PR.`status`, AD.uf, GROUP_CONCAT(DISTINCT CT.`type`,CT.`owner`,":",CT.phone) as phone',
                "INNER JOIN  Address AS AD ON PR.id = AD.id_provider
                INNER JOIN Contacts AS CT ON CT.id_provider = PR.id
                GROUP BY PR.id
                ORDER BY PR.id ASC LIMIT {$start}{$offset}{$limit}"
            );
            break;
        case 'desc':
            $count = (is_array($count = $modelo->listar('Providers P', '*'))) ? COUNT($count) : 0;
            $allReg = $modelo->listar(
                'Providers PR',
                'PR.id, PR.`name`, PR.`email`,  PR.`occupation_area`, PR.`status`, AD.uf, GROUP_CONCAT(DISTINCT CT.`type`,CT.`owner`,":",CT.phone) as phone',
                "INNER JOIN  Address AS AD ON PR.id = AD.id_provider
                INNER JOIN Contacts AS CT ON CT.id_provider = PR.id
                GROUP BY PR.id
                ORDER BY PR.id DESC LIMIT {$start}{$offset}{$limit}"
            );
            break;
        case 'new':
            $conditions['id'] = 'id';
            $count = ($modelo->searchTable($tblName, $conditions)) ? count($modelo->searchTable($tblName, $conditions)) : 0;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        default:
            break;
    }
} else {
    $count = (is_array($count = $modelo->listar('Providers P', '*'))) ? COUNT($count) : 0;
    $allReg = $modelo->listar(
        'Providers PR',
        'PR.id, PR.`name`, PR.`email`,  PR.`occupation_area`, PR.`status`, AD.uf, GROUP_CONCAT(DISTINCT CT.`type`,CT.`owner`,":",CT.phone) as phone',
        "INNER JOIN  Address AS AD ON PR.id = AD.id_provider
        INNER JOIN Contacts AS CT ON CT.id_provider = PR.id
        GROUP BY PR.id
        ORDER BY PR.id DESC LIMIT {$start}{$offset}{$limit}"
    );
}

$pagConfig = [
    'currentPage'   => $start,
    'totalRows'     => $count,
    'perPage'       => $limit,
    'link_func'     => 'objFinanca.ajaxFilter'
];

$pagination =  new Pagination($pagConfig);

if (!empty($allReg)) {
    echo <<<HTML
            <table  id="tableList" class="table table-bordered table-sm table-hover" >
                <thead class="thead-green">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">EMPRESA</th>
                        <th class="text-center">CELULAR</th>
                        <th class="text-center">TELEFONE</th>
                        <th class="text-center">E-MAIL</th>
                        <th class="text-center">ATUAÇÃO</th>
                        <th colspan="1" class="text-center">UF</th>
                        <th class="text-center">STATUS</th>
                        <th colspan="3" class="text-center">AÇÃO</th>
                    </tr>
                </thead>
                <tbody>
HTML;
    $count = 0;
    foreach ($allReg as $reg) : $count++;
        ($reg['status'] == 'active') ? $reg['status'] = 'Ativo' : FALSE;
        ($reg['status'] == 'inactive') ? $reg['status'] = 'Inativo' : FALSE;
        echo '<tr class="text-center">';
        echo '<td>' . $reg['id'] . '</td>';
        echo '<td>' . $reg['name'] . '</td>';
        echo '<td>' . ((GFunc::getCode(explode(',', $reg['phone']), 'CP')) ?  GFunc::getCode(explode(',', $reg['phone']), 'CP') : '---') . '</td>';
        echo '<td>' . ((GFunc::getCode(explode(',', $reg['phone']), 'TP')) ? GFunc::getCode(explode(',', $reg['phone']), 'TP') : '---') . '</td>';
        echo '<td>' . (($reg['email']) ? $reg['email'] : '---') . '</td>';
        echo '<td>' . (($reg['occupation_area']) ? $reg['occupation_area'] : '---') . '</td>';
        echo '<td>' . (($reg['states']) ? $reg['states'] : '---') . '</td>';
        echo '<td>' . (($reg['status']) ? $reg['status'] : '---') . '</td>';
        echo "<td><button class='btn btn-success btn-sm btn-edit-show' onClick={typeAction(objData={type:'loadEdit',id:'" . GFunc::encodeDecode($reg['id']) . "'})}><i class='far fa-edit fa-lg' ></i> EDITAR</button></td>";
        echo "<td><a href='javaScript:void(0);' id='btn-dell' class='btn btn-danger btn-sm' onClick={typeAction(objData={type:'delete',id:'" . GFunc::encodeDecode($reg['id']) . "'})}><i class='far fa-trash-alt fa-lg' ></i> DELETAR</a></td>";
        echo "<td><a href='javaScript:void(0);' class='btn btn-info btn-sm' onClick={typeAction(objData={type:'loadInfo',id:'" . GFunc::encodeDecode($reg['id']) . "'})} data-toggle='modal' data-target='#inforView'><i class='fas fa-eye fa-lg' ></i> VISUALIZAR</a></td>";
        echo '</tr>';
    endforeach;
    echo <<<HTML
                </tbody>
            </table>
HTML;
    echo $pagination->createLinks();
} elseif ((filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING) or filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)) && $allReg == false) {
    echo '<div style="z-index: -100;" class="col-md-12  col-sm-5 col-xs-12 text-center alert alert-info" role="alert">Nenhum registro encontrado.</div>';
} else {
    echo '<div style="z-index: -100;" class="col-md-12  col-sm-5 col-xs-12 text-center alert alert-info" role="alert">Não há registros na base de dados.</div>';
}
