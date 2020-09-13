<?php if (!defined('Config::HOME_URI')) {
    exit();
}

# Parâmetros de páginação ------>
$tblName = 'checks';
$conditions = [];

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
    $conditions['search'] = ['checks_venc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING), 'checks_desc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)];
    $count = COUNT($modelo->searchTable($tblName, $conditions));
    $conditions['order_by'] = "checks_id DESC LIMIT $start, $limit";
    $allReg = $modelo->searchTable($tblName, $conditions);
} elseif (!empty(filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING))) {
    unset($allReg);
    $sortBy = filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING);

    switch ($sortBy) {
        case 'active':
            $conditions['active'] = ['checks_status' => 2];
            $conditions['order_by'] = 'checks_id DESC';
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $conditions['start'] = $start;
            $conditions['limit'] = $limit;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'inactive':
            $conditions['inactive'] = ['checks_status' => 1];
            $conditions['order_by'] = 'checks_id DESC';
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $conditions['start'] = $start;
            $conditions['limit'] = $limit;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'asc':
            $conditions['order_by'] = "checks_id ASC";
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $conditions['start'] = $start;
            $conditions['limit'] = $limit;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'desc':
            $conditions['order_by'] = "checks_id DESC";
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $conditions['start'] = $start;
            $conditions['limit'] = $limit;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'new':
            $conditions['id'] = 'checks_id';
            $count = COUNT($modelo->searchTable($tblName, $conditions));

            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        default:
            break;
    }
} else {
    $conditions['order_by'] = "checks_id DESC LIMIT 100";
    $count = COUNT($modelo->searchTable($tblName, $conditions));
    $conditions['order_by'] = "checks_id DESC LIMIT $start, $limit";
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
            <table  id="tableList" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="small text-center">#</th>
                        <th class="small text-center">TITULAR</th>
                        <th class="small text-center">VALOR</th>
                        <th class="small text-center">CÓDIGO</th>
                        <th class="small text-center">BANCO</th>
                        <th class="small text-center">AGÊNCIA</th>
                        <th class="small text-center">Data de Compensação</th>
                        <th class="small text-center">RECEBIDO DE</th>
                        <th class="small text-center">ENCAMINHADO PARA</th>
                        <th class="small text-center">DATA DA INCLUSÃO</th>
                        <th class="small text-center">MODIFICADO EM</th>
                        <th colspan="10" class="small text-center">AÇÃO</th>
                    </tr>
                </thead>
                <tbody>
HTML;
    $count = 0;
    foreach ($allReg as $reg) : $count++;
        echo '<tr class="text-center">';
        echo '<td>' . $reg['checks_id'] . '</td>';
        echo '<td>' . (($reg['checks_holder']) ? $reg['checks_holder']  : '---') . '</td>';
        echo '<td>' . 'R$ ' . number_format($reg['checks_val'], 2, ',', '.') . '</td>';
        echo '<td>' . (($reg['checks_cod']) ? $reg['checks_cod'] : '---') . '</td>';
        echo '<td>' . (($reg['checks_bank']) ? $reg['checks_bank'] : '---') . '</td>';
        echo '<td>' . (($reg['checks_agency']) ? $reg['checks_agency'] : '---') . '</td>';
        echo '<td>' . (($modelo->convertDataHora('Y-m-d', 'd/m/Y', $reg['checks_date'])) ? $modelo->convertDataHora('Y-m-d', 'd/m/Y', $reg['checks_date']) : '---') . '</td>';
        echo '<td>' . (($reg['checks_received']) ? $reg['checks_received'] : '---') . '</td>';
        echo '<td>' . (($reg['checks_forwarded']) ? $reg['checks_forwarded'] : '---') . '</td>';
        echo '<td>' . $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $reg['checks_created']) . '</td>';
        echo '<td>' . (($modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $reg['checks_modified'])) ? $modelo->convertDataHora('Y-m-d H:i:s', 'd/m/Y H:i:s', $reg['checks_modified']) : '---') . '</td>';

        echo "<td><button class='btn btn-default btn-xs btn-edit-show' onClick={editRegister('{$modelo->encodeDecode($reg['checks_id'])}')} ><span class='text-success'>EDITAR</span></button></td>";
        echo "<td><button type='button' class='btn btn-default btn-xs' onClick={userAction('delete','{$modelo->encodeDecode($reg['checks_id'])}')}><span class='text-danger'>DELETAR</span></a></td>";
        echo "<td><button type='button' class='btn btn-default btn-xs' onClick={infoView('{$modelo->encodeDecode($reg['checks_id'])}')} data-toggle='modal' data-target='#inforView'><span class='text-primary'>VISUALIZAR</span></button></td>";
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
