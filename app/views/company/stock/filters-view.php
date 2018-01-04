<?php   if (!defined('ABSPATH')) {  exit(); }
    
    # Parâmetros de páginação
    $tblName = 'stock';
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
        $conditions['search'] = ['stock_desc' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING), 'stock_cod' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)];
        $count = COUNT($modelo->searchTable( $tblName, $conditions ));
        $conditions['order_by'] = "stock_id DESC LIMIT $start, $limit";
        $allReg = $modelo->searchTable( $tblName, $conditions );
    }elseif(!empty(filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING))) { 
        unset($allReg);
        $sortBy = filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING);
        
        switch ($sortBy) {
//            case 'active':
//                $conditions['active'] = ['stock_sit' => 'active'];
//                $conditions['order_by'] = 'stock_id DESC';
//                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
//                $conditions['start'] = $start;
//                $conditions['limit'] = $limit;
//                $allReg = $modelo->searchTable( $tblName, $conditions );
//                break;            
//            case 'inactive':
//                $conditions['inactive'] = ['patrimony_sit' => 'inactive'];
//                $conditions['order_by'] = 'patrimony_id DESC';
//                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
//                $conditions['start'] = $start;
//                $conditions['limit'] = $limit;
//                $allReg = $modelo->searchTable( $tblName, $conditions );
//                break;
            case 'asc':
                $conditions['order_by'] = "stock_id ASC";
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;
            case 'desc':
                $conditions['order_by'] = "stock_id DESC";
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;
            case 'new':
                $conditions['id'] = 'stock_id';
                $count = COUNT($modelo->searchTable( $tblName, $conditions ));
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;   
            default:
                break;
        }
    } else {
        $conditions['order_by'] = "stock_id DESC LIMIT 100";
        $count = COUNT($modelo->searchTable( $tblName, $conditions ));
        $conditions['order_by'] = "stock_id DESC LIMIT $start, $limit";
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
            <table  id="tableList" class="table table-bordered table-sm table-hover" >
                <thead class="thead-dark">
                    <tr>
                        <th class="small text-center">#</th>
                        <th class="small text-center">CÓDIGO</th>
                        <th class="small text-center">DESCRIÇÃO</th>
                        <th class="small text-center">FORNECEDOR</th>
                        <th class="small text-center">PREÇO</th>
                        <th colspan="3" class="small text-center">AÇÃO</th>
                    </tr>
                </thead>
                <tbody>
HTML;
        $count = 0;
        foreach ($allReg as $reg) : $count++;
            echo '<tr class="text-center">';
            echo '<td>'.$reg['stock_id'].'</td>';
            echo '<td>'.$reg['stock_cod'].'</td>';
            echo '<td>'.(($reg['stock_desc']) ? $reg['stock_desc'] : '---') .'</td>';
            echo '<td>'.(($reg['stock_forn']) ? $reg['stock_forn'] : '---') .'</td>';
            echo '<td>'.(($reg['stock_prec']) ? '$ '.$reg['stock_prec'] : '---') .'</td>';
            
            
            //echo '<td>'.(($reg['patrimony_created']) ? $modelo->convertDataHora('Y-m-d H:i:s','d/m/Y H:i:s',$reg['patrimony_created']) : '---') .'</td>';
            //echo '<td>'.(($reg['patrimony_modified']) ? $modelo->convertDataHora('Y-m-d H:i:s','d/m/Y H:i:s',$reg['patrimony_modified']) : '---') .'</td>';
            //$status = ($reg['payments_date_pay']) ? '<span class="label label-success">Pago</span>' : '<span class="label label-danger">Em débito</span>';
            //echo '<td>' . $status . '</td>';
            echo "<td><button class='btn btn-outline-success btn-sm btn-edit-show' onClick={typeAction(objData={type:'loadEdit',id:'{$modelo->encode_decode($reg['stock_id'])}'})} >EDITAR</button></td>";
            echo "<td><a href='javaScript:void(0);' id='btn-dell' class='btn btn-outline-danger btn-sm' onClick={typeAction(objData={type:'delete',id:'{$modelo->encode_decode($reg['stock_id'])}'})}>DELETAR</a></td>";
            echo "<td><a href='javaScript:void(0);' class='btn btn-outline-info btn-sm' onClick={typeAction(objData={type:'loadInfo',id:'{$modelo->encode_decode($reg['stock_id'])}'})} data-toggle='modal' data-target='#inforView'>VISUALIZAR</a></td>";
            echo '</tr>';
        endforeach;
        echo <<<HTML
                </tbody>
            </table>    
HTML;
      echo $pagination->createLinks();
      echo '<p></p>';
    }elseif ((filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING) OR filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)) && $allReg == false) {
        echo '<div style="z-index: -100;" class="col-md-12  col-sm-5 col-xs-12 text-center alert alert-info" role="alert">Nenhum registro encontrado.</div>';
    }else{
        echo '<div style="z-index: -100;" class="col-md-12  col-sm-5 col-xs-12 text-center alert alert-info" role="alert">Não há registros na base de dados.</div>';
    }
    

    
    