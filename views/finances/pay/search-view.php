<?php   if (!defined('ABSPATH')) {  exit(); }
    
    $tblName = 'bills_to_pay';
    $conditions = [];
    //var_dump($_POST);die;
    # Paginação parametros-------->
    $start = !empty($_POST['page']) ? $_POST['page']  : 0;
    if(filter_input( INPUT_POST, 'qtdLine', FILTER_VALIDATE_INT )){
        var_dump($_POST['qtdLine']);
        $limit = filter_input( INPUT_POST, 'qtdLine', FILTER_VALIDATE_INT );
    }else{
        $limit = 5;
    }
    
    if(!empty(filter_input(INPUT_POST, 'keywords', FILTER_DEFAULT))) {
        $conditions['search'] = ['pay_venc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING), 'pay_desc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)];
        $count = COUNT($modelo->searchTable( $tblName, $conditions ));
        
        $conditions['order_by'] = "pay_id DESC LIMIT $start, $limit";
        $pays = $modelo->searchTable( $tblName, $conditions );
    }elseif(!empty(filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING))) { 
        unset($pays);
        $sortBy = filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING);
        
        switch ($sortBy) {
            case 'active':
                $conditions['active'] = ['pay_status' => 2];
                $conditions['order_by'] = 'pay_id DESC';
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $pays = $modelo->searchTable( $tblName, $conditions );
                break;            
            case 'inactive':
                $conditions['inactive'] = ['pay_status' => 1];
                $conditions['order_by'] = 'pay_id DESC';
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $pays = $modelo->searchTable( $tblName, $conditions );
                break;
            case 'asc':
                $conditions['order_by'] = "pay_id ASC";
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $pays = $modelo->searchTable( $tblName, $conditions );
                break;
            case 'desc':
                $conditions['order_by'] = "pay_id DESC";
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $pays = $modelo->searchTable( $tblName, $conditions );
                break;
            case 'new':
                $conditions['id'] = 'pay_id';
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                
                $pays = $modelo->searchTable( $tblName, $conditions );
                break;   
            default:
                break;
        }
    } else {
        $conditions['order_by'] = "pay_id DESC LIMIT 100";
        $count = COUNT($modelo->searchTable( $tblName, $conditions ));
        $conditions['order_by'] = "pay_id DESC LIMIT $start, $limit";
        $pays = $modelo->searchTable( $tblName, $conditions );
    }
    
    $pagConfig = [
        'currentPage' => $start,
        'totalRows' => $count,
        'perPage' => $limit,
        'link_func' => 'searchFilter'];

    $pagination =  new Pagination($pagConfig);
    
    $table = <<<HTML
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
                    <tbody>
HTML;
    
    if (!empty($pays)) {
        $count = 0;
        echo $table;
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
        echo <<<HTML
                </tbody>
            </table>    
HTML;
      echo $pagination->createLinks();  
    }else {
        echo '<div class="col-md-3  col-sm-0 col-xs-0"></div><div class="col-md-6  col-sm-5 col-xs-12 text-center alert alert-warning" role="alert">Nenhum registro encontrado.</div><div class="col-md-3  col-sm-0 col-xs-0"></div>';
    }
    

    
    