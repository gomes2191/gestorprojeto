<?php
    # Display 10 most recent search items
    $query = "SELECT * FROM live_table c INNER JOIN query_data q ON c.name = q.name ORDER BY querycount DESC LIMIT 5";
    
    # The search
    $results = $modelo->get_table_data(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $query);
    while($results) {
        $result_array[] = $results;
    }

    foreach ($result_array as $result) {
        # The output
        echo '<tr>';			
        echo '<td class="small">'.$result['name'].'</td>';
        echo '<td class="small">'.$result['company'].'</td>';
        echo '<td class="small">'.$result['zip'].'</td>';
        echo '<td class="small">'.$result['city'].'</td>';
        echo '</tr>';	
    }