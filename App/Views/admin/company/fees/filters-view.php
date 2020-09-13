<?php if (!defined('Config::HOME_URI')) {
    exit();
}

# Parâmetros de páginação
$tblName = 'fees';

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
    $conditions['search'] = ['fees_cod' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING, TRUE), 'fees_proc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING, TRUE)];
    $conditions['and'] = 'covenant_id = ' . filter_input(INPUT_POST, 'get_decode', FILTER_VALIDATE_INT);
    $count = (int) count($modelo->searchTable($tblName, $conditions));
    $conditions['order_by'] = 'fees_id DESC LIMIT ' . $start . ', ' . $limit . '';
    $allReg = $modelo->searchTable($tblName, $conditions);
} elseif (!empty(filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING))) {
    unset($allReg);
    $sortBy = filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING);
    switch ($sortBy) {
        case 'asc':
            $conditions['where'] = ['covenant_id' => filter_input(INPUT_POST, 'get_decode', FILTER_VALIDATE_INT)];
            $count = (int) count($modelo->searchTable($tblName, $conditions));
            $conditions['order_by'] = "fees_id ASC LIMIT $start, $limit";
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        case 'desc':
            $conditions['where'] = ['covenant_id' => filter_input(INPUT_POST, 'get_decode', FILTER_VALIDATE_INT)];
            $count = (int) count($modelo->searchTable($tblName, $conditions));
            $conditions['order_by'] = "fees_id DESC LIMIT $start, $limit";
            $allReg = $modelo->searchTable($tblName, $conditions);
            break;
        default:
            break;
    }
} else {
    $conditions['where'] = ['covenant_id' => filter_input(INPUT_POST, 'get_decode', FILTER_VALIDATE_INT)];
    $count = (int) count($modelo->searchTable($tblName, $conditions));
    $conditions['order_by'] = "fees_id DESC LIMIT $start, $limit";
    $allReg = $modelo->searchTable($tblName, $conditions);
}

$pagConfig = [
    'currentPage' => $start,
    'totalRows' =>  $count,
    'perPage' => $limit,
    'link_func' => 'objFinanca.ajaxFilter'
];
$pagination =  new Pagination($pagConfig);

if (!empty($allReg)) {
    echo <<<HTML
            <table  id="tableList" class="table table-bordered table-sm" >
                <thead class="thead-green">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">CÓDIGO</th>
                        <th class="text-center">PROCEDIMENTO</th>
                        <th class="text-center">CATEGORIA</th>
                        <th class="text-center">DESCONTO</th>
                        <th class="text-center">VALOR PARTICULAR</th>
                        <th class="text-center">TOTAL COM PERCENTUAL</th>
                        <th colspan="3" class="text-center">AÇÃO</th>
                    </tr>
                </thead>
                <tbody>
HTML;
    $count = 0;
    foreach ($allReg as $reg) : $count++;
        echo '<tr class="text-center">';
        echo '<td>' . $reg['fees_id'] . '</td>';
        echo '<td>' . $reg['fees_cod'] . '</td>';
        echo '<td>' . (($reg['fees_proc']) ? $reg['fees_proc'] : '---') . '</td>';
        echo '<td>' . (($reg['fees_cat']) ? $reg['fees_cat'] : '---') . '</td>';
        echo '<td>' . (($reg['fees_desc']) ? $reg['fees_desc'] : '---') . '</td>';
        echo '<td>' . (($reg['fees_val_real']) ? $reg['fees_val_real'] : '---') . '</td>';
        echo '<td>' . (($reg['fees_val_final']) ? $reg['fees_val_final'] : '---') . '</td>';
        //echo '<td>'.(($reg['fees_city']) ? $reg['fees_city'] : '---') .'</td>';
        //echo '<td>'.(($reg['fees_created']) ? $modelo->convertDataHora('Y-m-d H:i:s','d/m/Y H:i:s',$reg['fees_created']) : '---') .'</td>';
        //echo '<td>'.(($reg['fees_modified']) ? $modelo->convertDataHora('Y-m-d H:i:s','d/m/Y H:i:s',$reg['fees_modified']) : '---') .'</td>';
        //$status = ($reg['payments_date_pay']) ? '<span class="label label-success">Pago</span>' : '<span class="label label-danger">Em débito</span>';
        //echo '<td>' . $status . '</td>';
        echo "<td><button class='btn btn-outline-success btn-sm btn-edit-show' onClick={typeAction(objData={type:'loadEdit',id:'{$modelo->encodeDecode($reg['fees_id'])}'})} ><i class='far fa-edit fa-lg' ></i> EDITAR</button></td>";
        echo "<td><a href='javaScript:void(0);' id='btn-dell' class='btn btn-outline-danger btn-sm' onClick={typeAction(objData={type:'delete',id:'{$modelo->encodeDecode($reg['fees_id'])}'})}><i class='far fa-trash-alt fa-lg' ></i> DELETAR</a></td>";
        echo "<td><a href='javaScript:void(0);' class='btn btn-outline-info btn-sm' onClick={typeAction(objData={type:'loadInfo',id:'{$modelo->encodeDecode($reg['fees_id'])}'})} data-toggle='modal' data-target='#inforView'><i class='fas fa-eye fa-lg' ></i> VISUALIZAR</a></td>";
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
