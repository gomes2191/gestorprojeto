<?php   


        
        
        
        $host  = $_SERVER['HTTP_HOST'];

        $db = new PDO('mysql:host=localhost;dbname=migration_ov;charset=utf8', 'root', 'libre');
        // Pega todos os dados da tabela agendas.
        $query = $db->query(' SELECT * FROM `agendas` ');
        
        // Verifica se a consulta foi realizada com sucesso.
        if (!$query) {
            return [];
        }
        
        foreach ($query as $row){
            $out[] = array(
                'id'    => $row['agenda_id'],
                'title' => $row['agenda_pac'],
                'url'   => $row['agenda_url'],
                'body'  => $row['agenda_desc'],
                'class' => $row['agenda_class'],
                'start' => $row['agenda_start'],
                'end'   => $row['agenda_end']
            );
            
        }
        echo json_encode(array('success' => 1, 'result' => $out));
        exit;
        