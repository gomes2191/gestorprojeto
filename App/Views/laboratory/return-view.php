<?php
    if (!defined('Config::HOME_URI')) {
        exit();
    }

    if (filter_input(INPUT_GET, 'get', FILTER_DEFAULT)) {
        $encode_id = filter_input(INPUT_GET, 'get', FILTER_DEFAULT);
        $modelo->delRegister($encode_id);


        # Destroy variavel não mais utilizadas
        unset($encode_id);
    }

  echo $modelo->form_msg;
