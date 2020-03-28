<?php


    if ( defined('ABSPATH') && (!filter_has_var(INPUT_POST, 'get_decode')) ) {
        Swoole\Http\Request::__destruct;
    }
    
    # Parâmetros de páginação
    $tblName = 'providers';

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
        $conditions['search'] = ['name' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING, TRUE), 'area_de_atuacao' => filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING)];
        $count = (int) ( is_array($modelo->searchTable( $tblName, $conditions )) ) ? count($modelo->searchTable( $tblName, $conditions )) : FALSE;
        $conditions['order_by'] = "id DESC LIMIT $start, $limit";
        $allReg = $modelo->searchTable( $tblName, $conditions );
    }elseif(!empty(filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING))) { 
        unset($allReg);
        $sortBy = filter_input(INPUT_POST, 'sortBy', FILTER_SANITIZE_STRING);
        switch ($sortBy) {
            case 'active':
                $conditions['active'] = ['provider_sit' => 'active'];
                $conditions['order_by'] = 'id DESC';
                $count = (is_array($modelo->searchTable( $tblName, $conditions ))) ? COUNT($modelo->searchTable( $tblName, $conditions )) : 0 ;
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;            
            case 'inactive':
                $conditions['inactive'] = ['provider_sit' => 'inactive'];
                $conditions['order_by'] = 'id DESC';
                $count = (is_array($modelo->searchTable( $tblName, $conditions ))) ? COUNT($modelo->searchTable( $tblName, $conditions )) : 0 ;
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;
            case 'asc':
                $conditions['order_by'] = "id ASC";
                $count = (is_array($modelo->searchTable( $tblName, $conditions ))) ? COUNT($modelo->searchTable( $tblName, $conditions )) : 0;
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;
            case 'desc':
                $conditions['order_by'] = "id DESC";
                $count = ( $modelo->searchTable( $tblName, $conditions ) ) ? COUNT($modelo->searchTable( $tblName, $conditions )) : 0;
                $conditions['start'] = $start;
                $conditions['limit'] = $limit;
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;
            case 'new':
                $conditions['id'] = 'id';
                $count = ( $modelo->searchTable( $tblName, $conditions ) ) ? count($modelo->searchTable( $tblName, $conditions )) : 0;
                $allReg = $modelo->searchTable( $tblName, $conditions );
                break;   
            default:
                break;
        }
    } else {
        $conditions['order_by'] = "id DESC LIMIT 100";
        $count = (is_array($modelo->searchTable( $tblName, $conditions ))) ? count($modelo->searchTable( $tblName, $conditions )) : 0;
        $conditions['order_by'] = "id DESC LIMIT $start, $limit";
        $allReg = $modelo->searchTable( $tblName, $conditions );
    }
    
    $pagConfig = [
        'currentPage'   => $start,
        'totalRows'     => $count,
        'perPage'       => $limit,
        'link_func'     => 'objFinanca.ajaxFilter'
    ];

    $pagination =  new Pagination($pagConfig);
    
    if (!empty($allReg)) {
        echo <<<HTML
            <table  id="tableList" class="table table-bordered table-sm table-hover" >
                <thead class="thead-green">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">EMPRESA</th>
                        <th class="text-center">CELULAR</th>
                        <th class="text-center">TELEFONE</th>
                        <th class="text-center">E-MAIL</th>
                        <th class="text-center">ATUAÇÃO</th>
                        <th colspan="1" class="text-center">UF</th>
                        <th colspan="3" class="text-center">AÇÃO</th>
                    </tr>
                </thead>
                <tbody>
HTML;
        $count = 0;
        foreach ($allReg as $reg) : $count++;
            echo '<tr class="text-center">';
            echo '<td>'.$reg['id'].'</td>';
            echo '<td>'.$reg['name'].'</td>';
            echo '<td>'.(($reg['celular']) ? $reg['celular'] : '---') .'</td>';
            echo '<td>'.(($reg['phone_1']) ? $reg['phone_1'] : '---') .'</td>';
            echo '<td>'.(($reg['email']) ? $reg['email'] : '---') .'</td>';
            echo '<td>'.(($reg['area_de_atuacao']) ? $reg['area_de_atuacao'] : '---') .'</td>';
            echo '<td>'.(($reg['states']) ? $reg['states'] : '---') .'</td>';
            echo "<td><button class='btn btn-outline-success btn-sm btn-edit-show' onClick={typeAction(objData={type:'loadEdit',id:'{$globalF->encode_decode($reg['id'])}'})}><i class='far fa-edit fa-lg' ></i> EDITAR</button></td>";
            echo "<td><a href='javaScript:void(0);' id='btn-dell' class='btn btn-outline-danger btn-sm' onClick={typeAction(objData={type:'delete',id:'{$globalF->encode_decode($reg['id'])}'})}><i class='far fa-trash-alt fa-lg' ></i> DELETAR</a></td>";
            echo "<td><a href='javaScript:void(0);' class='btn btn-outline-info btn-sm' onClick={typeAction(objData={type:'loadInfo',id:'{$globalF->encode_decode($reg['id'])}'})} data-toggle='modal' data-target='#inforView'><i class='fas fa-eye fa-lg' ></i> VISUALIZAR</a></td>";
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
    