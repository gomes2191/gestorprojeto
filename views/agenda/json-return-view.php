<?php
    if (!defined('ABSPATH')) {
        exit;
        
    } 
//     var_dump($_SERVER['REQUEST_METHOD']);
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $modelo->return_json_evento();
        
    }else{
        echo 'Teste';
    }
     
        
        