<?php if (!defined('Config::HOME_URI')) {
    exit();
}

# Parâmetros de páginação
$tblName = 'bills_to_receive';

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
    $conditions['search'] = ['receive_desc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING), 'receive_cod' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)];
    $count = COUNT($modelo->searchTable($tblName, $conditions));
    $conditions['order_by'] = "receive_id DESC LIMIT $start, $limit";
    $allReg = $modelo->searchTable($tblName, $conditions);
} elseif (!empty(filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING))) {
    unset($allReg);
    $sortBy = filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING);
    switch ($sortBy) {
        case 'active':
            $conditions['active'] = ['receive_sit' => 'active'];
            $conditions['order_by'] = 'receive_id DESC';
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $conditions['start'] = $start;
            $conditions['limit'] = $limit;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'inactive':
            $conditions['inactive'] = ['receive_sit' => 'inactive'];
            $conditions['order_by'] = 'receive_id DESC';
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $conditions['start'] = $start;
            $conditions['limit'] = $limit;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'asc':
            $conditions['order_by'] = "receive_id ASC";
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $conditions['start'] = $start;
            $conditions['limit'] = $limit;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'desc':
            $conditions['order_by'] = "receive_id DESC";
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $conditions['start'] = $start;
            $conditions['limit'] = $limit;
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'new':
            $conditions['id'] = 'receive_id';
            $count = COUNT($modelo->searchTable($tblName, $conditions));
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        default:
            break;
    }
} else {
    $conditions['order_by'] = "receive_id DESC LIMIT 100";
    $count = COUNT($modelo->searchTable($tblName, $conditions));
    $conditions['order_by'] = "receive_id DESC LIMIT $start, $limit";
    $allReg = $modelo->searchTable($tblName, $conditions);
}

$pagConfig = [
    'currentPage'  => $start,
    'totalRows'    => $count,
    'perPage'      => $limit,
    'link_func'    => 'objFinanca.ajaxFilter'
];

# Cria um objeto da classe de páginação
$pagination =  new Pagination($pagConfig);

if (!empty($allReg)) {
    echo <<<HTML
            <table  id="tableList" class="table table-bordered table-sm table-hover" >
                <thead class="thead-green">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">CÓDIGO</th>
                        <th class="text-center">DESCRIÇÃO</th>
                        <th class="text-center">CATEGORIA</th>
                        <th class="text-center">VENCIMENTO</th>
                        <th class="text-center">PAGAMENTO</th>
                        <th class="text-center">SITUAÇÃO</th>
                        <th colspan="3" class="text-center">AÇÃO</th>
                    </tr>
                </thead>
                <tbody>
HTML;
    $count = 0;
    foreach ($allReg as $reg) : $count++;
        echo '<tr class="text-center">';
        echo '<td>' . $reg['receive_id'] . '</td>';
        echo '<td>' . $reg['receive_cod'] . '</td>';
        echo '<td>' . (($reg['receive_desc']) ? $reg['receive_desc'] : '---') . '</td>';
        echo '<td>' . (($reg['receive_cat']) ? $reg['receive_cat'] : '---') . '</td>';
        echo '<td>' . (($reg['receive_date_venc']) ? $modelo->convertDataHora('Y-m-d', 'd/m/Y', $reg['receive_date_venc'])  : '---') . '</td>';
        echo '<td>' . (($reg['receive_date_pay']) ?  $modelo->convertDataHora('Y-m-d', 'd/m/Y', $reg['receive_date_pay']) : '---') . '</td>';
        echo '<td>' . (($reg['receive_sit'] == 'active') ? '<span class="badge badge-success">PAGO</span>' : '<span class="badge badge-danger">NÃO PAGO</span>') . '</td>';


        //echo '<td>'.(($reg['patrimony_created']) ? $modelo->convertDataHora('Y-m-d H:i:s','d/m/Y H:i:s',$reg['patrimony_created']) : '---') .'</td>';
        //echo '<td>'.(($reg['patrimony_modified']) ? $modelo->convertDataHora('Y-m-d H:i:s','d/m/Y H:i:s',$reg['patrimony_modified']) : '---') .'</td>';
        //$status = ($reg['receivements_date_receive']) ? '<span class="label label-success">Pago</span>' : '<span class="label label-danger">Em débito</span>';
        //echo '<td>' . $status . '</td>';
        echo "<td><button class='btn btn-outline-success btn-sm btn-edit-show' onClick={typeAction(objData={type:'loadEdit',id:'{$modelo->encodeDecode($reg['receive_id'])}'})}><i class='far fa-edit fa-lg' ></i> EDITAR</button></td>";
        echo "<td><a href='javaScript:void(0);' id='btn-dell' class='btn btn-outline-danger btn-sm' onClick={typeAction(objData={type:'delete',id:'{$modelo->encodeDecode($reg['receive_id'])}'})}><i class='far fa-trash-alt fa-lg' ></i> DELETAR</a></td>";
        echo "<td><a href='javaScript:void(0);' class='btn btn-outline-info btn-sm' onClick={typeAction(objData={type:'loadInfo',id:'{$modelo->encodeDecode($reg['receive_id'])}'})} data-toggle='modal' data-target='#inforView'><i class='fas fa-eye fa-lg' ></i> VISUALIZAR</a></td>";
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

# Dstroy variáveis
unset($start, $limit, $tblName, $qtdLine, $conditions, $allReg, $pagination, $pagConfig, $count, $modelo, $sortBy);
