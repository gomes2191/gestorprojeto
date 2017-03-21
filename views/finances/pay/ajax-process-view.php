<?php

// Get job (and id)
$job = '';
$id = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];

    if ($job == 'get_pays' ||
            $job == 'get_pay' ||
            $job == 'add_pay' ||
            $job == 'edit_pay' ||
            $job == 'delete_pay') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (!is_numeric($id)) {
                $id = '';
            }
        }
    } else {
        $job = '';
    }
}

// Prepare array
$mysql_data = [];

// Valid job found
if ($job != '') {

    // Execute job
    if ($job == 'get_pays') {


        # Seleciona todos os pagamentos
        $sql = "SELECT * FROM `bills_to_pay` ORDER BY `pay_id`";
        $query = $modelo->getSelect_return($sql);

        //var_dump($query);die;
        if (!$query) {
            $result = 'error';
            $message = 'query error';
        } else {

            $result = 'sucesso';
            $message = 'query sucesso';
            foreach ($query as $pay) {
                $mysql_data[] = [
                    "pay_id" => $pay['pay_id'],
                    "pay_venc" => $pay['pay_venc'],
                    "pay_date_pay" => $pay['pay_date_pay'],
                    "pay_cat" => '$ ' . $pay['pay_cat'],
                    "pay_desc" => $pay['pay_desc'],
                    "pay_val" => $pay['pay_val']
                ];
            }
        }
    } elseif ($job == 'get_pay') {
        // Get pay
        if ($id == '') {
            $result = 'error';
            $message = 'id missing';
        } else {
            $sql = "SELECT * FROM bills_to_pay WHERE pay_id = $id";
            $query = $modelo->getSelect_return($sql);
            if (!$query) {
                $result = 'error';
                $message = 'query error';
            } else {
                $result = 'success';
                $message = 'query success';
                foreach ($query as $pay) {
                    //var_dump($pay);die;
                    $mysql_data[] = [
                        "pay_id" => $pay['pay_id'],
                        "pay_venc" => $pay['pay_venc'],
                        "pay_date_pay" => $pay['pay_date_pay'],
                        "pay_cat" => $pay['pay_cat'],
                        "pay_desc" => $pay['pay_desc'],
                        "pay_val" => $pay['pay_val']
                    ];
                }
            }
        }
    } elseif ($job == 'add_pay') {
        $modelo->validate_register_form();
        $data = $modelo->form_msg;
    }
}

// Prepara os dados
//$data['data'] = $mysql_data;

// Convert PHP array to JSON array
//$json_data = json_encode($data);

$fp = fopen('arquivo.json', 'w');
fwrite($fp, json_encode($mysql_data));
fclose($fp);

//echo $json_data;
