<?php
    if (defined('Config::ABS_PATH')
    && (!filter_has_var(INPUT_POST, 'get_decode'))
    && (!filter_has_var(INPUT_POST, 'populate')))
    {
        exit();
    }

    $allReg = $modelo->listar('Projects PR', 'PR.id, PR.name');

    if ($_POST['populate']) {
        # code...
        die(json_encode($allReg));
    }

    if(!$allReg){
        die('<div id="notProject" style="z-index: -100;" class="col-md-12 col-sm-5 col-xs-12 text-center alert alert-info" role="alert">Não há projeto cadastrado, cadastre pelo menos um projeto.</div>');
    }

    unset($allReg);

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
    $allReg = $modelo->listar('Activities AC', 'AC.*', "
    WHERE AC.name LIKE '" . '%' . filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING, TRUE) . '%' . "'
    GROUP BY AC.id
    ORDER BY AC.id DESC LIMIT {$start}{$offset}{$limit}");
    $count = count($allReg);
} else {
    $count = (is_array($count = $modelo->listar('Activities AC', '*'))) ? COUNT($count) : 0;
    $allReg = $modelo->listar(
        'Activities AC',
        'AC.*, PR.name projectName',
        "LEFT JOIN Projects PR on AC.id_project=PR.id
        GROUP BY AC.id
        ORDER BY PR.id DESC LIMIT {$start}{$offset}{$limit}"
    );
}

$pagConfig = [
    'currentPage'   => $start,
    'totalRows'     => $count,
    'perPage'       => $limit,
    'link_func'     => 'objGMetodo.ajaxFilter'
];

$pagination =  new Pagination($pagConfig);

if (!empty($allReg)) {
    echo <<<HTML
            <table  id="tableList" class="table table-bordered table-sm table-hover" >
                <thead class="thead-green">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">NOME DA ATIVIDADE</th>
                        <th class="text-center">VINCULADA AO PROJETO</th>
                        <th class="text-center">DATA DE INICIO</th>
                        <th class="text-center">DATA FIM</th>
                        <th class="text-center">FINALIZADO?</th>
                        <th colspan="3" class="text-center">AÇÃO</th>
                    </tr>
                </thead>
                <tbody>
HTML;
    $count = 0;
    foreach ($allReg as $reg) : $count++;
        echo '<tr class="text-center">';
        echo '<td>' . $reg['id'] . '</td>';
        echo '<td>' . $reg['name'] . '</td>';
        echo '<td>' . $reg['projectName'] . '</td>';
        echo '<td>' . GFunc::convertDataHora('Y-m-d', 'd/m/Y', $reg['start_date']) . '</td>';
        echo '<td>' . GFunc::convertDataHora('Y-m-d', 'd/m/Y', $reg['end_date']) . '</td>';
        echo '<td>' . (($reg['finished']) ? 'Sim' : 'Não') . '</td>';


        //echo '<td>' . ((GFunc::getCode(explode(',', $reg['phone']), 'CP')) ?  GFunc::getCode(explode(',', $reg['phone']), 'CP') : '---') . '</td>';
        //echo '<td>' . ((GFunc::getCode(explode(',', $reg['phone']), 'TP')) ? GFunc::getCode(explode(',', $reg['phone']), 'TP') : '---') . '</td>';
        //echo '<td>' . (($reg['email']) ? $reg['email'] : '---') . '</td>';
        echo "<td><button class='btn btn-success btn-sm btn-edit-show' onClick={typeAction(objData={type:'loadEdit',id:'" . GFunc::encodeDecode($reg['id']) . "'})}><i class='far fa-edit fa-lg' ></i> EDITAR</button></td>";
        echo "<td><a href='javaScript:void(0);' id='btn-dell' class='btn btn-danger btn-sm' onClick={typeAction(objData={type:'delete',id:'" . GFunc::encodeDecode($reg['id']) . "'})}><i class='far fa-trash-alt fa-lg' ></i> DELETAR</a></td>";
        echo "<td><a href='javaScript:void(0);' class='btn btn-primary btn-sm' onClick={typeAction(objData={type:'loadInfo',id:'" . GFunc::encodeDecode($reg['id']) . "'})} data-bs-toggle='modal' data-bs-target='#inforView'><i class='fas fa-eye fa-lg' ></i> VISUALIZAR</a></td>";
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
