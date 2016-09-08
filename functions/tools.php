<?php


  // Avaliar os dados inseridos pelo usuário e excluir caracteres indesejados.
  function avaliar($valor_ini)
  {
    $nopermitido = array("'",'\\','<','>',"\"");
    $valor_1 = str_replace($nopermitido, "", $valor_ini);

    $valor = filter_var($valor_1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    return $valor;

  }

  // Microtime formatar uma data para adicionar o evento, tipo 1401517498985.
  function _formatar($fecha)
  {
    return strtotime(substr($fecha, 6, 4)."-".substr($fecha, 3, 2)."-".substr($fecha, 0, 2)." " .substr($fecha, 10, 6)) * 1000;
  }
