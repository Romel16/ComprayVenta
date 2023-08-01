<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/monedaModels.php");

/*TODO: inicializando clases */
$moneda = new MonedaModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["idmoneda"])) {
            $moneda->insertarMoneda($_POST["idsucursal"], $_POST["nombreMoneda"]);
        }else{
            $moneda->updateMoneda($_POST["idmoneda"], $_POST["idsucursal"],$_POST["nombreMoneda"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $moneda->getMoneda_x_sucursalId($idsucursal);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array = $row["nombremoneda"];
            $sub_array = "Editar";
            $sub_array = "Eliminar";
            $data[] = $sub_array;

        }

        $result = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
                        
        echo json_encode($result);
        break;
    
        /*TODO: mostrar registros con informacion por medio ID */
    case 'mostrar':
        $datos = $moneda->getMoneda_x_id($_POST["idmoneda"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["idmoneda"] = $row["idmoneda"];
                $output["idsucursal"] = $row["idsucursal"];
                $output["nombremoneda"] = $row["nombremoneda"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $moneda->eliminarMoneda($_POST["idmoneda"]);
        break;
    
}

?>