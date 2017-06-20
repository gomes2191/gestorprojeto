<?php
    # Verifica se constatante referente ao caminho foi definida
    if (!defined('ABSPATH')) { exit; }
    
 if(filter_input_array(INPUT_POST)) {
    if (isset($_POST['action_type']) && !empty($_POST['action_type'])) {
        if ($_POST['action_type'] == 'data') {
            $conditions['where'] = array('pay_id' => $_POST['id']);
            $conditions['return_type'] = 'single';
            $allReg = $modelo->searchTable('bills_to_pay', $conditions);
            echo json_encode($allReg);
        } elseif ($_POST['action_type'] == 'view') {
            $records = $modelo->searchTable('bills_to_pay', array('order_by' => 'pay_id DESC'));
            if (!empty($records)) {
                $table = <<<HTML
                <table  class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="small text-center">#</th>
                            <th class="small text-center">DATA DE VENCIMENTO</th>
                            <th class="small text-center">DATA DE PAGAMENTO</th>
                            <th class="small text-center">CATEGORIA</th>
                            <th class="small text-center">DESCRIÇÃO</th>
                            <th class="small text-center">VALOR</th>
                            <th class="small text-center">DATA DA INCLUSÃO</th>
                            <th class="small text-center">MODIFICADO EM</th>
                            <th class="small text-center">STATUS</th>
                            <th colspan="10" class="small text-center">AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
HTML;
                $count = 0;
                echo $table;
                foreach ($records as $record): $count++;
                    echo '<tr>';
                    echo '<td>#' . $count . '</td>';
                    echo '<td>' . $record['pay_id'] . '</td>';
                    echo '<td>' . $record['pay_venc'] . '</td>';
                    echo '<td>' . $record['pay_date_pay'] . '</td>';
                    echo '</tr>';
                endforeach;
                echo <<<HTML
                    </tbody>
                </table>    
HTML;
                echo $pagination->createLinks(); 
            }else {
                echo '<tr><td colspan="5">No user(s) found......</td></tr>';
            }
        } elseif ($_POST['action_type'] == 'add') {
            # Retorna a função que faz o registro no sistema e finaliza.
            return $modelo->validate_register_form();
            
        } elseif ($_POST['action_type'] == 'edit') {
            # Retorna a função que faz o update e finaliza.
            return $modelo->validate_register_form();
            
        } elseif ($_POST['action_type'] == 'delete') {
            if (!empty($_POST['id'])) {
                $condition = array('id' => $_POST['id']);
                $delete = $db->delete($tblName, $condition);
                echo $delete ? 'ok' : 'err';
            }
        }
        exit;
    }
} else {
    header('Location: ' . HOME_URI . '/');
}
    
    
    
    
    