<?php
    # Verifica se constatante referente ao caminho foi definida
    if (!defined('ABSPATH')) { exit(); }
    
        if ((filter_input(INPUT_POST, 'action_type')) && !empty(filter_input(INPUT_POST, 'action_type'))) {
           
            if (filter_input(INPUT_POST, 'action_type') == 'data') {
                $conditions['where'] = ['checks_id' => $modelo->encode_decode(0, filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS))];
                $conditions['return_type'] = 'single';
                $allReg = $modelo->searchTable('checks', $conditions);
                $allReg['checks_date'] = $modelo->convertDataHora('Y-m-d', 'd/m/Y',$allReg['checks_date']);
                $allReg['checks_created'] = $modelo->convertDataHora('Y-m-d H:i:s','d/m/Y H:i:s',$allReg['checks_created']);
                $allReg['checks_modified'] = $modelo->convertDataHora('Y-m-d H:i:s','d/m/Y H:i:s',$allReg['checks_modified']);
                echo json_encode($allReg);
            } elseif (filter_input(INPUT_POST, 'action_type') == 'add') {
                # Retorna a função que faz o registro no sistema e finaliza.
                return $modelo->validate_register_form();
            } elseif (filter_input(INPUT_POST, 'action_type') == 'edit') {
                # Retorna a função que faz o update e finaliza.
                return $modelo->validate_register_form();
            } elseif (filter_input(INPUT_POST, 'action_type') == 'delete') {
                if (!empty(filter_input(INPUT_POST, 'id'))) {
                    return $modelo->delRegister(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
                }
            }
            exit();
        }else {
            //header('Location: ' . HOME_URI . '/');
            
        }
    
    
    
    
    