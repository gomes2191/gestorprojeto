<?php
    if (!defined('ABSPATH')) {
        exit();
    }
    
    
    
    
    // Output HTML formats
    $html  = '<tr class="text-center content">';
    $html .= '<td class="small">pay_id</td>';
    $html .= '<td class="small">pay_venc</td>';
    $html .= '<td class="small">pay_date_pay</td>';
    $html .= '<td class="small">pay_cat</td>';
    $html .= '<td class="small">pay_desc</td>';
    $html .= '<td class="small">pay_val</td>';
    $html .= '<td class="small">acao</td>';
    $html .= '</tr>';
    
    // Output HTML formats
    $htmlN  = '<tr class="text-center">';
    $htmlN .= '<td colspan="6" class="small">Nenhum registro encontrado.</td>';
    $htmlN .= '</tr>';

    // Get the Search
    $search_string = filter_input(INPUT_POST, 'query', FILTER_SANITIZE_SPECIAL_CHARS);
    
    //$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
    // Check if length is more than 1 character
    if (strlen($search_string) >= 1 && $search_string !== ' ') {
        
        //Insert Time Stamp
        $time = "UPDATE query_data SET timestamp=now() WHERE name='" . $search_string . "'";
        
        //Count how many times a query occurs
        $query_count = "UPDATE query_data SET querycount = querycount +1 WHERE name='" . $search_string . "'";
        
        // Query
        $query = 'SELECT * FROM `bills_to_pay` WHERE `pay_venc` LIKE "%' . $search_string . '%"';
        
        //Timestamp entry of search for later display
        $time_entry = $modelo->get_table_data(3, NULL, NULL, NULL, NULL, NULL, $time, NULL);
        
        //Count how many times a query occurs
        $query_count = $modelo->get_table_data(3, NULL, NULL, NULL, NULL, NULL, $query_count, NULL);
        
        // Do the search
        $result_array = $modelo->get_table_data(4, NULL, NULL, NULL, NULL, NULL, NULL, $query); 
        
          
        //var_dump($result_array);die;
        // Check for results
        if (!empty($result_array)) {
            
            //var_dump($result_array);die;
            foreach ($result_array as $result) {
                 
                // Output strings and highlight the matches
                ///$pay_venc = preg_replace("/[a-z]{3} [a-z]{3} \d{1,2} \d{2}:\d{2}:\d{2} \d{4}/ie" . $search_string . "/i", "<span style='color: red;'>" . $search_string . "</span>", $result['pay_venc']);
                
                // Replace the items into above HTML
                $o = str_replace('pay_venc', $result['pay_venc'], $html);
                
                $o = str_replace('pay_id', $result['pay_id'], $o);
                $o = str_replace('pay_date_pay', $result['pay_date_pay'], $o);
                $o = str_replace('pay_cat', $result['pay_cat'], $o);
                $o = str_replace('pay_desc', $result['pay_desc'], $o);
                $o = str_replace('pay_val', $result['pay_val'], $o);
                $o = str_replace('acao','<a href="'.$result['pay_id'].'" >Excluir</a>', $o);
                
                // Output it
                echo($o);
            }
            
           
        } else {
            // Replace for no results
            $o = str_replace('pay_id', '---', $html);
            $o = str_replace('pay_cat', '---', $o);
            $o = str_replace('pay_venc', '<span class="label label-danger">Não existe</span>', $o);
            $o = str_replace('pay_date_pay', '---', $o);
            $o = str_replace('pay_desc', '---', $o);
            $o = str_replace('pay_val', '---', $o);
            $o = str_replace('acao', '---', $o);
            // Output
            echo($o);
        }
    }