<?php   if (!defined('ABSPATH')) {  exit(); }
    
    # Parâmetros de páginação ------> 
    $tblName = 'bills_to_pay';
    $conditions = [];

    # Recebe o valor da quantidade de registro por páginas.
    $qtdLine = filter_input( INPUT_POST, 'qtdLine', FILTER_VALIDATE_INT );

    /*
     * Rotina que verifica se o valor da quantidade
     * de pagina e = ou menor 0 ou superior a 50. 
     */
    if (($qtdLine <= 0) OR ( $qtdLine > 50)) {
        $limit = 5;
    } else {
        $limit = $qtdLine;
    }

    $start = !empty(filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT)) ? filter_input(INPUT_POST, 'page', FILTER_VALIDATE_INT) : 0;
    
    if(!empty(filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING))) {
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
            $status = ($pay['pay_date_pay']) ? '<span class="label label-success">Pago</span>' : '<span class="label label-danger">Em débito</span>';
            echo '<td>' . $status . '</td>';
            echo "<td><button class='btn btn-default btn-xs btn-edit-show' onclick='editUser(".$pay['pay_id'].")' ><span class='text-success'>EDITAR</span></button></td>";
            echo "<td><button data-id='".$modelo->encode_decode($pay['pay_id'])."' class='btn-dell btn btn-default btn-xs'><span class='text-danger'>DELETAR</span></button></td>";
            echo "<td><a href='javascript:void(0);' class='btn btn-default btn-xs' onclick='infoView(".$pay['pay_id'].")' data-toggle='modal' data-target='#inforView'><span class='text-primary'>VISUALIZAR</span></a></td>";
            echo '</tr>';
        endforeach;
        echo <<<HTML
                </tbody>
            </table>    
HTML;
      echo $pagination->createLinks();  
    }else {
        echo '<div style="z-index: -100;" class="col-md-12  col-sm-5 col-xs-12 text-center alert alert-warning" role="alert">Nenhum registro encontrado.</div>';
    }
    

    
    