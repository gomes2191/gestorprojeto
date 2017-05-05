<?php   if (!defined('ABSPATH')) {  exit(); }
            
    $tblName = 'bills_to_pay';
    $conditions = [];
    //var_dump($_POST);die;
    # Paginação parametros-------->
    $start = !empty($_POST['page']) ? $_POST['page']  : 0;    
    $limit = 3;
   
    if(!empty(filter_input(INPUT_POST, 'keywords', FILTER_DEFAULT))) {
        $conditions['search'] = ['pay_venc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING), 'pay_desc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)];
        $count = COUNT($modelo->get_table_data( 4, null, $tblName, null, null, null, null, $conditions  ));
        
        $conditions['order_by'] = "pay_id DESC LIMIT $start, $limit";
        $pays = $modelo->get_table_data( 4, null, $tblName, null, null, null, null, $conditions );
    }elseif(!empty(filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING))) { 
        unset($pays);
        $sortBy = filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING);
        
        switch ($sortBy) {
            case 'active':
                $conditions['active'] = ['pay_status' => 2];
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $conditions['order_by'] = "pay_id DESC LIMIT $start, $limit";
                $pays = $modelo->searchTable( $tblName, $conditions );
                break;            
            case 'inactive':
                $conditions['inactive'] = ['pay_status' => 1];
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $conditions['order_by'] = "pay_id DESC LIMIT $start, $limit";
                $pays = $modelo->searchTable( $tblName, $conditions );
                break;

            default:
                break;
        }
    } else {
        $conditions['order_by'] = "pay_id DESC LIMIT $start, $limit";
    }
    
    //!empty( $pays ) ? '' : $count = COUNT( $pays = $modelo->getRows($tblName, $conditions) );
    
    $pagConfig = [
        'currentPage' => $start,
        'totalRows' => $count,
        'perPage' => $limit,
        'link_func' => 'searchFilter'];

    $pagination =  new Pagination($pagConfig);
    
    
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
            $status = ($pay['pay_status'] == 2) ? '<span class="label label-success">Pago</span>' : '<span class="label label-warning">Não pago</span>';
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