<?php
   
    

//$modelo->db->set_charset("utf8");

$jsondata = [];
$jsondataList = [];





if ($_GET['param1'] == "cuantos") {

    $resultado = $modelo->db->query( ' SELECT COUNT(*) total FROM `agendas` ' );


    $fila = $resultado->fetch(PDO::FETCH_ASSOC);

    $jsondata['total'] = $fila['total'];
    
} elseif ($_GET['param1'] == 'dame') {
    
    $limit = $modelo->avaliar($_GET['limit']);
    $offset = $modelo->avaliar($_GET['offset']);
    

    $resultadoT = $modelo->db->query(" SELECT * FROM `agendas` LIMIT $limit OFFSET $offset ");


    while ($fila = $resultadoT->fetch()) {
        $jsondataperson = [];
        $jsondataperson["agenda_id"] = $fila["agenda_id"];
        $jsondataperson["agenda_pac"] = $fila["agenda_pac"];
        $jsondataperson["agenda_proc"] = $fila["agenda_proc"];
        $jsondataperson["agenda_desc"] = $fila["agenda_desc"];

        $jsondataList [] = $jsondataperson;
    }

    $jsondata['lista'] = array_values($jsondataList);
}




echo json_encode($jsondata);
