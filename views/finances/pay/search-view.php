<?php
    if (!defined('ABSPATH')) {
        exit();
    }

    $tblName = 'bills_to_pay';
    $conditions = [];
    if (!empty(filter_input(INPUT_POST, 'type', FILTER_DEFAULT)) && !empty(filter_input(INPUT_POST, 'val', FILTER_DEFAULT))) {
        if (filter_input(INPUT_POST, 'type', FILTER_DEFAULT) == 'search') {
            $conditions['search'] = ['pay_venc' => filter_input(INPUT_POST, 'val', FILTER_SANITIZE_STRING), 'pay_desc' => filter_input(INPUT_POST, 'val', FILTER_SANITIZE_STRING)];
            $conditions['order_by'] = 'pay_id DESC';
        } elseif (filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING) == 'sort') {
            $sortVal = filter_input(INPUT_POST, 'val', FILTER_SANITIZE_STRING);
            $sortArr = [
                'new' => [
                    'order_by' => 'pay_created DESC'
                ],
                'asc' => [
                    'order_by' => 'pay_venc ASC'
                ],
                'desc' => [
                    'order_by' => 'pay_venc DESC'
                ],
                'active' => [
                    'where' => ['pay_status' => '1']
                ],
                'inactive' => [
                    'where' => ['pay_status' => '0']
                ]
            ];
            $sortKey = key($sortArr[$sortVal]);
            $conditions[$sortKey] = $sortArr[$sortVal][$sortKey];
        }
    } else {
        $conditions['order_by'] = 'pay_id DESC';
    }
    
    $pays = $modelo->getRows($tblName, $conditions);
    
    if (!empty($pays)) {
        $count = 0;
        foreach ($pays as $pay) : $count++;
            echo '<tr data-id="' . $pay['pay_id'] . '" class="text-center">';
            echo "<td>{$pay['pay_id']}</td>";
            echo "<td>{$pay['pay_venc']}</td>";
            echo "<td>{$pay['pay_date_pay']}</td>";
            echo "<td>{$pay['pay_cat']}</td>";
            echo "<td>{$pay['pay_desc']}</td>";
            echo "<td>{$pay['pay_val']}</td>";
            echo "<td>{$pay['pay_created']}</td>";
            echo "<td>{$pay['pay_modified']}</td>";
            $status = ($pay['pay_status'] == 1) ? '<span class="label label-success">Pago</span>' : '<span class="label label-warning">Não pago</span>';
            echo '<td>' . $status . '</td>';
            echo "<td><button class='btn btn-success btn-xs'>Editar</button></td>";
            echo "<td><button data-id='" . $modelo->encode_decode($pay['pay_id']) . "' class='btn-dell btn btn-warning btn-xs'>Deletar</button></td>";
            echo "<td><button class='btn btn-primary btn-xs'>Visualizar</button></td>";
            echo '</tr>';
        endforeach;
    }else {
        echo '<tr class="text-center"><td colspan="10"><span class="label label-primary">Nenhum registro encontrado...</span></td></tr>';
    }
    exit;
