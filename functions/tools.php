<?php


  // Avaliar os dados inseridos pelo usuário e excluir caracteres indesejados.
  function evaluar($valor)
  {
    $nopermitido = array("'",'\\','<','>',"\"");
    $valor = str_replace($nopermitido, "", $valor);

    $valor = filter_var($valor, FILTER_SANITIZE_STRING);
    return $valor;

  }

  // Microtime formatar uma data para adicionar o evento, tipo 1401517498985.
  function _formatear($fecha)
  {
    return strtotime(substr($fecha, 6, 4)."-".substr($fecha, 3, 2)."-".substr($fecha, 0, 2)." " .substr($fecha, 10, 6)) * 1000;
  }
