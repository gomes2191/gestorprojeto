<?php
/*
    # Verifica se a constante existe "ABSPATH" existe, se nao existir sai
    if (!defined('ABSPATH')) { exit; }
    
    if(!empty(filter_input_array(INPUT_POST))){
        # Verifica se existe encode_id se existe executa o metod de exclusão
        if((filter_input(INPUT_POST, 'encode_id'))){
            $modelo->delRegister(filter_input(INPUT_POST, 'encode_id'));
            echo $modelo->form_msg;
        }else{
            $modelo->validate_register_form();
            echo $modelo->form_msg;
        }
        
    }else{
        exit();
    }

*/
    
//    $draw                = filter_input(INPUT_POST, 'draw');//counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
//    $orderByColumnIndex  = filter_input(INPUT_POST, ['order'][0]['column']);// index of the sorting column (0 index based - i.e. 0 is the first record)
//    $orderBy             = filter_input(INPUT_POST, ['columns'][$orderByColumnIndex]['data']);//Get name of the sorting column from its index
//    $orderType           = filter_input(INPUT_POST, ['order'][0]['dir']); // ASC or DESC
//    $start               = filter_input(INPUT_POST, ['start']);//Paging first record indicator.
//    $length              = filter_input(INPUT_POST, ['length']);//Number of records that the table can display in the current draw
//  
//  
//  $recordsTotal = count($modelo->getSelect_return(" SELECT * FROM `bills_to_pay` "));
//  var_dump($recordsTotal);
//
//    /* SEARCH CASE : Filtered data */
//    if(!empty(filter_input(INPUT_POST, ['search']['value']))){
//
//        /* WHERE Clause for searching */
//        for($i=0 ; $i<count(filter_input(INPUT_POST, ['columns']));$i++){
//            $column = filter_input(INPUT_POST, ['columns'][$i]['data']);//we get the name of each column using its index from POST request
//            $where[]="$column like '%".filter_input(INPUT_POST, ['search']['value'])."%'";
//        }
//        $where = "WHERE ".implode(" OR " , $where);// id like '%searchValue%' or name like '%searchValue%' ....
//        /* End WHERE */
//
//        $sql = sprintf("SELECT * FROM %s %s", 'bills_to_pay' , $where);//Search query without limit clause (No pagination)
//
//        $recordsFiltered = count($modelo->getSelect_return($sql));//Count of search result
//
//        /* SQL Query for search with limit and orderBy clauses*/
//        $sql = sprintf("SELECT * FROM %s %s ORDER BY %s %s limit %d , %d ", 'bills_to_pay' , $where ,$orderBy, $orderType ,$start,$length  );
//        $data = $modelo->getSelect_return($sql);
//    }
//    /* END SEARCH */
//    else {
//        $sql = sprintf("SELECT * FROM %s ORDER BY %s %s limit %d , %d ", 'bills_to_pay' ,$orderBy,$orderType ,$start , $length);
//        $data = $modelo->getSelect_return($sql);
//
//        $recordsFiltered = $recordsTotal;
//    }
//
//    /* Response to client before JSON encoding */
//    $response = array(
//        "draw" => intval($draw),
//        "recordsTotal" => $recordsTotal,
//        "recordsFiltered" => $recordsFiltered,
//        "data" => $data
//    );
//
//    echo json_encode($response);
//


/* Useful $_POST Variables coming from the plugin */
    $draw = $_POST["draw"];//counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
    $orderByColumnIndex  = $_POST['order'][0]['column'];// index of the sorting column (0 index based - i.e. 0 is the first record)
    $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
    $orderType = $_POST['order'][0]['dir']; // ASC or DESC
    $start  = $_POST["start"];//Paging first record indicator.
    $length = $_POST['length'];//Number of records that the table can display in the current draw
    /* END of POST variables */

    $recordsTotal = count($modelo->getSelect_return(" SELECT * FROM `bills_to_pay` "));
    //var_dump($recordsTotal);

    /* SEARCH CASE : Filtered data */
    if(!empty($_POST['search']['value'])){

        /* WHERE Clause for searching */
        for($i=0 ; $i<count($_POST['columns']);$i++){
            $column = $_POST['columns'][$i]['data'];//we get the name of each column using its index from POST request
            $where[]="$column like '%".$_POST['search']['value']."%'";
        }
        $where = "WHERE ".implode(" OR " , $where);// id like '%searchValue%' or name like '%searchValue%' ....
        /* End WHERE */

        $sql = sprintf("SELECT * FROM %s %s", 'bills_to_pay' , $where);//Search query without limit clause (No pagination)

        $recordsFiltered = count($modelo->getSelect_return($sql));//Count of search result

        /* SQL Query for search with limit and orderBy clauses*/
        $sql = sprintf("SELECT * FROM %s %s ORDER BY %s %s limit %d , %d ", 'bills_to_pay' , $where ,$orderBy, $orderType ,$start,$length  );
        $data = $modelo->getSelect_return($sql);
    }
    /* END SEARCH */
    else {
        $sql = sprintf("SELECT * FROM %s ORDER BY %s %s limit %d , %d ", 'bills_to_pay' ,$orderBy,$orderType ,$start , $length);
        $data = $modelo->getSelect_return($sql);

        $recordsFiltered = $recordsTotal;
    }

    /* Response to client before JSON encoding */
    $response = array(
        "draw" => intval($draw),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    );

    echo json_encode($response);