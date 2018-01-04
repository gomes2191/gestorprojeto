<?php   if (!defined('ABSPATH')) {  exit(); }
    
    # Parâmetros de páginação ------> 
    $tblName = 'payments';
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
        $conditions['search'] = ['payments_venc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING), 'payments_desc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)];
        $count = COUNT($modelo->searchTable( $tblName, $conditions ));
        $conditions['order_by'] = "payments_id DESC LIMIT $start, $limit";
        $allReg = $modelo->searchTable( $tblName, $conditions );
    }elseif(!empty(filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING))) { 
        unset($allReg);
        $sortBy = filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING);
        
        switch ($sortBy) {
            case 'active':
                $conditions['active'] = ['payments_status' => 2];
                $conditions['order_by'] = 'payments_id DESC';
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;            
            case 'inactive':
                $conditions['inactive'] = ['payments_status' => 1];
                $conditions['order_by'] = 'payments_id DESC';
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;
            case 'asc':
                $conditions['order_by'] = "payments_id ASC";
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;
            case 'desc':
                $conditions['order_by'] = "payments_id DESC";
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;
            case 'new':
                $conditions['id'] = 'payments_id';
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;   
            default:
                break;
        }
    } else {
        $conditions['order_by'] = "payments_id DESC LIMIT 100";
        $count = COUNT($modelo->searchTable( $tblName, $conditions ));
        $conditions['order_by'] = "payments_id DESC LIMIT $start, $limit";
        $allReg = $modelo->searchTable( $tblName, $conditions );
    }
    
    $pagConfig = [
        'currentPage' => $start,
        'totalRows' => $count,
        'perPage' => $limit,
        'link_func' => 'objFinanca.ajaxFilter'];

    $pagination =  new Pagination($pagConfig);
    
    if (!empty($allReg)) {
        echo <<<HTML
            <table  id="tableList" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="small text-center">#</th>
                        <th class="small text-center">DATA DE VENCIMENTO</th>
                        <th class="small text-center">DATA DE PAGAMENTO</th>
                        <th class="small text-center">CATEGORIA</th>
                        <th class="small text-center">DESCRIÇÃO</th>
                        <th class="small text-center">MONTANTE</th>
                        <th class="small text-center">DATA DA INCLUSÃO</th>
                        <th class="small text-center">MODIFICADO EM</th>
                        <th class="small text-center">STATUS</th>
                        <th colspan="10" class="small text-center">AÇÃO</th>
                    </tr>
                </thead>
                <tbody>
HTML;
        $count = 0;
        foreach ($allReg as $reg) : $count++;
            echo '<tr class="text-center">';
            echo '<td>'.$reg['payments_id'].'</td>';
            echo '<td>'.$modelo->convertDataHora('Y-m-d','d/m/Y',$reg['payments_venc']).'</td>';
            echo '<td>'.$modelo->convertDataHora('Y-m-d','d/m/Y',$reg['payments_date_pay']).'</td>';
            echo '<td>'.$reg['payments_cat'].'</td>';
            echo '<td>'.$reg['payments_desc'].'</td>';
            echo '<td>'.'R$ '.number_format($reg['payments_val'], 2, ',', '.').'</td>';
            echo '<td>'.$modelo->convertDataHora('Y-m-d H:i:s','d/m/Y H:i:s',$reg['payments_created']).'</td>';
            echo '<td>'.$modelo->convertDataHora('Y-m-d H:i:s','d/m/Y H:i:s',$reg['payments_modified']).'</td>';
            $status = ($reg['payments_date_pay']) ? '<span class="label label-success">Pago</span>' : '<span class="label label-danger">Em débito</span>';
            echo '<td>' . $status . '</td>';
            echo "<td><button class='btn btn-default btn-xs btn-edit-show' onClick={editRegister('{$modelo->encode_decode($reg['payments_id'])}')} ><span class='text-success'>EDITAR</span></button></td>";
            echo "<td><a href='javaScript:void(0);' class='btn btn-default btn-xs' onClick={userAction('delete','{$modelo->encode_decode($reg['payments_id'])}')}><span class='text-danger'>DELETAR</span></a></td>";
            echo "<td><a href='javaScript:void(0);' class='btn btn-default btn-xs' onClick={infoView('{$modelo->encode_decode($reg['payments_id'])}')} data-toggle='modal' data-target='#inforView'><span class='text-primary'>VISUALIZAR</span></a></td>";
            echo '</tr>';
        endforeach;
        echo <<<HTML
                </tbody>
            </table>    
HTML;
      echo $pagination->createLinks();  
    }elseif ((filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING) OR filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)) && $allReg == false) {
        echo '<div style="z-index: -100;" class="col-md-12  col-sm-5 col-xs-12 text-center alert alert-info" role="alert">Nenhum registro encontrado.</div>';
    }else{
        echo '<div style="z-index: -100;" class="col-md-12  col-sm-5 col-xs-12 text-center alert alert-info" role="alert">Não há registros na base de dados.</div>';
    }
    

    
    