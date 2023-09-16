<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/pagoModels.php");

/*TODO: inicializando clases */
$pago = new PagoModels();

switch ($_GET["op"]) {            
    
    /*TODO: Listar Combobox */
    case "combo":
        $datos = $pago->getPago_x_estado();
                   
        if (is_array($datos)==true and count($datos)>0) {
            $html="";
            $html.="<option selected>Seleccionar</option>";
            foreach ($datos as $row) {
                $html.="<option value='".$row["pagoId"]."'>".$row["pagoNombre"]."</option>";
            }
            echo $html;
        }
    break;
   
}

?>