<?php if (!defined('ABSPATH')) {
    exit();
}

if (!empty(filter_input(INPUT_POST, 'action_type')) && (filter_input(INPUT_POST, 'action_type') == 'edit')) {
    $conditions['where'] = ['calendar_id' => $modelo->encodeDecode(0, filter_input(INPUT_POST, 'id'))];
    $conditions['return_type'] = 'single';
    $allReg = $modelo->searchTable('calendar', $conditions);
    echo json_encode($allReg);
} else {
    $modelo->return_json_evento();
}
