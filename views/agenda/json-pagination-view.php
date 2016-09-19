<?php

    // Evita que o arquivo seja acessdado diretamente.
    if (!defined('ABSPATH')) {
        exit();
    }

    /*
     * Simpesmente verifica se existe os parametros e executa a rotina
     * 
     */
    if ($_GET['param1'] == 'cuantos') {
        $param1 = 'cuantos';
        $modelo->jsonPagination($param1);
        exit();
        
    } elseif ($_GET['param1'] == 'dame') {
        
        $param1 = 'dame';

        $limit = $modelo->avaliar($_GET['limit']);
        $offset = $modelo->avaliar($_GET['offset']);
        
        $modelo->jsonPagination($param1, $limit, $offset);
        exit();
       

    }else{
        exit();
    }
   
