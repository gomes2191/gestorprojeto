<?php
   
    
$jsondata = [];
$jsondataList = [];



//TESTE

if ($_GET['param1'] == "cuantos") {

    $resultado = $modelo->db->query( ' SELECT COUNT(*) total FROM `agendas` ' );


    $fila = $resultado->fetch(PDO::FETCH_ASSOC);

    $jsondata['total'] = $fila['total'];
} elseif ($_GET["param1"] == "dame") {

    $resultado2 = $modelo->db->query( ' SELECT * FROM `agendas` LIMIT ' .$_GET['limit']. " OFFSET " .$_GET['offset']);


    while ($fila = $resultado2->fetch(PDO::FETCH_ASSOC)) {
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
