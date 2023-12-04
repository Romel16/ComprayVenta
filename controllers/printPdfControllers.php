<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/printPdfModels.php");

    
    /* TODO: Inicializando clase */
    $printPdf = new printPdfModels();

    switch($_GET["op"]){
        case "pdfventa":
            $printPdf->getPdfVenta($_GET["idventa"]);
            break;
    }
?>