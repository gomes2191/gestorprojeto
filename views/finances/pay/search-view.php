<?php
    if (!defined('ABSPATH')) {
        exit();
    }
    // Output HTML formats
    $html  = '<tr>';
    $html .=    '<td class="small">nameString</td>';
    $html .=    '<td class="small">compString</td>';
    $html .=    '<td class="small">zipString</td>';
    $html .=    '<td class="small">cityString</td>';
    $html .= '</tr>';

    // Get the Search
    $search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
    
    // Check if length is more than 1 character
    if (strlen($search_string) >= 1 && $search_string !== ' ') {
        
        //Insert Time Stamp
        $time = "UPDATE query_data SET timestamp=now() WHERE name='" . $search_string . "'";
        
        //Count how many times a query occurs
        $query_count = "UPDATE query_data SET querycount = querycount +1 WHERE name='" . $search_string . "'";
        
        // Query
        $query = 'SELECT * FROM `bills_to_pay` WHERE `pay_cat` LIKE "%' . $search_string . '%"';
        
        //Timestamp entry of search for later display
        $time_entry = $modelo->get_table_data(3, NULL, NULL, NULL, NULL, NULL, $time, NULL);
        
        //Count how many times a query occurs
        $query_count = $modelo->get_table_data(3, NULL, NULL, NULL, NULL, NULL, $query_count, NULL);
        
        // Do the search
        $result_array = $modelo->get_table_data(4, NULL, NULL, NULL, NULL, NULL, NULL, $query); 
        
        # Check for results
        if (isset($result_array)) {
            foreach ($result_array as $result) {
                # var_dump($result);die;
                # Output strings and highlight the matches
                $d_name = preg_replace("/" . $search_string . "/i", "<b>" . $search_string . "</b>", $result['pay_cat']);
                $d_comp = $result['pay_id'];
                $d_zip = $result['pay_venc'];
                $d_city = $result['pay_date_pay'];
                # Replace the items into above HTML
                $o = str_replace('nameString', $d_name, $html);
                $o = str_replace('compString', $d_comp, $o);
                $o = str_replace('zipString', $d_zip, $o);
                $o = str_replace('cityString', $d_city, $o);
                # Output it
                echo($o);
            }
        } else {
            # Replace for no results
            $o = str_replace('nameString', '<span class="label label-danger">Não existe</span>', $html);
            $o = str_replace('compString', '', $o);
            $o = str_replace('zipString', '', $o);
            $o = str_replace('cityString', '', $o);
            # Output
            echo($o);
        }
    }