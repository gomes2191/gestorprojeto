<?php

    if (!defined('ABSPATH')) {
        exit();
    }

    # reference the Dompdf namespace
    use Dompdf\Dompdf;

    # instantiate and use the dompdf class
    $dompdf = new Dompdf();
    
    # Carrega seu Html
    $dompdf->loadHtml('Teste');

    # (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    # Renderiza
    $dompdf->render();

    # Exibe 
    $dompdf->stream(
            "laboratory", /* Nome do arquivo de saída */ ["Attachment" => false /* Para download, altere para true */]    
    );
