<?php
    if (!defined('ABSPATH')) {
        exit();
        
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $modelo->return_json_evento();
        
    } else {
        echo 'Teste';
    }
     
        
        