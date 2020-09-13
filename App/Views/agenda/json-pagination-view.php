<?php

// Evita que o arquivo seja acessdado diretamente.
if (!defined('Config::HOME_URI')) {
    exit();
}

// Simpesmente verifica se existe os _parameters e executa a rotina
if ($_GET['param1'] == 'quantos') {
    $param1 = 'quantos';
    $modelo->jsonPagination($param1);
    exit();
} elseif ($_GET['param1'] == 'dame') {

    $param1 = 'dame';

    $limit = $modelo->avaliar($_GET['limit']);
    $offset = $modelo->avaliar($_GET['offset']);

    $modelo->jsonPagination($param1, $limit, $offset);
    exit();
} else {
    exit();
}
