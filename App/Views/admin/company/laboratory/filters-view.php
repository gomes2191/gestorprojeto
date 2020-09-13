<?php if (!defined('Config::HOME_URI')) {
    exit();
}

# Parâmetros de páginação
$tblName = 'laboratory';

# Recebe o valor da quantidade de registro por páginas.
$qtdLine = filter_input(INPUT_POST, 'qtdLine', FILTER_VALIDATE_INT);

/*
     * Rotina que verifica se o valor da quantidade
     * de pagina e = ou menor 0 ou superior a 50.
     */
if (($qtdLine <= 0) or ($qtdLine > 50)) {
    $limit = 5;
} else {
    $limit = $qtdLine;
}

$start = !empty(filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT)) ? filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT) : 0;

if (!empty(filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING))) {
    $conditions['search'] = ['laboratory_name' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING), 'laboratory_cpf_cnpj' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)];
    $count = COUNT($modelo->searchTable($tblName, $conditions));
    $conditions['order_by'] = "laboratory_id DESC LIMIT $start, $limit";
    $allReg = $modelo->searchTable($tblName, $conditions);
} elseif (!empty(filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING))) {
    unset($allReg);
    $sortBy = filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING);

    switch ($sortBy) {
        case 'active':
            $conditions['active'] = ['laboratory_sit' => 'active'];
            $conditions['order_by'] = 'laboratory_id DESC';
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $conditions['start'] = $start;
            $conditions['limit'] = $limit;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'inactive':
            $conditions['inactive'] = ['laboratory_sit' => 'inactive'];
            $conditions['order_by'] = 'laboratory_id DESC';
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $conditions['start'] = $start;
            $conditions['limit'] = $limit;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'asc':
            $conditions['order_by'] = "laboratory_id ASC";
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $conditions['start'] = $start;
            $conditions['limit'] = $limit;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'desc':
            $conditions['order_by'] = "laboratory_id DESC";
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $conditions['start'] = $start;
            $conditions['limit'] = $limit;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'new':
            $conditions['id'] = 'laboratory_id';
            $count = COUNT($modelo->searchTable($tblName, $conditions));

            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        default:
            break;
    }
} else {
    $conditions['order_by'] = "laboratory_id DESC LIMIT 100";
    $count = COUNT($modelo->searchTable($tblName, $conditions));
    $conditions['order_by'] = "laboratory_id DESC LIMIT $start, $limit";
    $allReg = $modelo->searchTable($tblName, $conditions);
}

$pagConfig = [
    'currentPage' => $start,
    'totalRows' => $count,
    'perPage' => $limit,
    'link_func' => 'objFinanca.ajaxFilter'
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
                        <th colspan="3" class="text-center">AÇÃO</th>
                    </tr>
                </thead>
                <tbody>
HTML;
    $count = 0;
    foreach ($allReg as $reg) : $count++;
        echo '<tr class="text-center">';
        echo '<td>' . $reg['laboratory_id'] . '</td>';
        echo '<td>' . $reg['laboratory_name'] . '</td>';
        echo '<td>' . (($reg['laboratory_cel']) ? $reg['laboratory_cel'] : '---') . '</td>';
        echo '<td>' . (($reg['laboratory_tel_1']) ? $reg['laboratory_tel_1'] : '---') . '</td>';
        echo '<td>' . (($reg['laboratory_email']) ? $reg['laboratory_email'] : '---') . '</td>';
        echo '<td>' . (($reg['laboratory_at']) ? $reg['laboratory_at'] : '---') . '</td>';
        //echo '<td>'.(($reg['laboratory_city']) ? $reg['laboratory_city'] : '---') .'</td>';
        echo '<td>' . (($reg['laboratory_uf']) ? $reg['laboratory_uf'] : '---') . '</td>';

        //echo '<td>'.(($reg['laboratory_created']) ? $modelo->convertDataHora('Y-m-d H:i:s','d/m/Y H:i:s',$reg['laboratory_created']) : '---') .'</td>';
        //echo '<td>'.(($reg['laboratory_modified']) ? $modelo->convertDataHora('Y-m-d H:i:s','d/m/Y H:i:s',$reg['laboratory_modified']) : '---') .'</td>';
        //$status = ($reg['payments_date_pay']) ? '<span class="label label-success">Pago</span>' : '<span class="label label-danger">Em débito</span>';
        //echo '<td>' . $status . '</td>';
        echo "<td><button class='btn btn-outline-success btn-sm btn-edit-show' onClick={typeAction(objData={type:'loadEdit',id:'{$modelo->encodeDecode($reg['laboratory_id'])}'})} >EDITAR</button></td>";
        echo "<td><a href='javaScript:void(0);' id='btn-dell' class='btn btn-outline-danger btn-sm' onClick={typeAction(objData={type:'delete',id:'{$modelo->encodeDecode($reg['laboratory_id'])}'})}>DELETAR</a></td>";
        echo "<td><a href='javaScript:void(0);' class='btn btn-outline-info btn-sm' onClick={typeAction(objData={type:'loadInfo',id:'{$modelo->encodeDecode($reg['laboratory_id'])}'})} data-toggle='modal' data-target='#inforView'>VISUALIZAR</a></td>";
        echo '</tr>';
    endforeach;
    echo <<<HTML
                </tbody>
            </table>
HTML;
    echo $pagination->createLinks();
    echo '<p></p>';
} elseif ((filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING) or filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)) && $allReg == false) {
    echo '<div style="z-index: -100;" class="col-md-12  col-sm-5 col-xs-12 text-center alert alert-info" role="alert">Nenhum registro encontrado.</div>';
} else {
    echo '<div style="z-index: -100;" class="col-md-12  col-sm-5 col-xs-12 text-center alert alert-info" role="alert">Não há registros na base de dados.</div>';
}
