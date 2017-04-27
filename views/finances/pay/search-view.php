<?php   if (!defined('ABSPATH')) {  exit(); }
            
    $tblName = 'bills_to_pay';
    $conditions = [];
    //var_dump($_POST);die;
    # Paginação parametros-------->
    $start = !empty($_POST['page']) ? $_POST['page']  : 0;
    
    var_dump($_POST['sortBy']);die;
    $limit = 3;
    $pagConfig = [
        'currentPage' => $start,
        'totalRows' => COUNT($modelo->getRows($tblName)),
        'perPage' => $limit,
        'link_func' => 'searchFilter'];

    $pagination =  new Pagination($pagConfig);
    
    if(!empty(filter_input(INPUT_POST, 'keywords', FILTER_DEFAULT))) {
            $conditions['search'] = ['pay_venc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING), 'pay_desc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)];
            $conditions['order_by'] = "pay_id DESC LIMIT $start, $limit";
    }elseif(!empty(filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING))) {
            
    } else {
            
        $conditions['order_by'] = "pay_id DESC LIMIT $start, $limit";
    }
    
    var_dump($conditions);die;
    $pays = $modelo->getRows($tblName, $conditions);
    
    echo <<<HTML
            <table  class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="small text-center">#</th>
                        <th class="small text-center">DATA DE VENCIMENTO</th>
                        <th class="small text-center">DATA DE PAGAMENTO</th>
                        <th class="small text-center">CATEGORIA</th>
                        <th class="small text-center">DESCRIÇÃO</th>
                        <th class="small text-center">VALOR</th>
                        <th class="small text-center">DATA DA INCLUSÃO</th>
                        <th class="small text-center">MODIFICADO EM</th>
                        <th class="small text-center">STATUS</th>
                        <th colspan="10" class="small text-center">AÇÃO</th>
                    </tr>
                </thead>
                <tbody >
HTML;
    
    if (!empty($pays)) {
        $count = 0;
        foreach ($pays as $pay) : $count++;
            echo '<tr data-id="' . $pay['pay_id'] . '" class="text-center">';
            echo "<td>{$pay['pay_id']}</td>";
            echo "<td>{$pay['pay_venc']}</td>";
            echo "<td>{$pay['pay_date_pay']}</td>";
            echo "<td>{$pay['pay_cat']}</td>";
            echo "<td>{$pay['pay_desc']}</td>";
            echo "<td>{$pay['pay_val']}</td>";
            echo "<td>{$pay['pay_created']}</td>";
            echo "<td>{$pay['pay_modified']}</td>";
            $status = ($pay['pay_status'] == 1) ? '<span class="label label-success">Pago</span>' : '<span class="label label-warning">Não pago</span>';
            echo '<td>' . $status . '</td>';
            echo "<td><button class='btn btn-success btn-xs'>Editar</button></td>";
            echo "<td><button data-id='" . $modelo->encode_decode($pay['pay_id']) . "' class='btn-dell btn btn-warning btn-xs'>Deletar</button></td>";
            echo "<td><button class='btn btn-primary btn-xs'>Visualizar</button></td>";
            echo '</tr>';
        endforeach;
        
        
    }else {
        echo '<tr class="text-center"><td colspan="10"><span class="label label-primary">Nenhum registro encontrado...</span></td></tr>';
    }
    echo <<<HTML
        </tbody>
    </table>    
HTML;

    echo '<span>'.$pagination->createLinks().'</span>';