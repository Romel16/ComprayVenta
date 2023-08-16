<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/monedaModels.php");

/*TODO: inicializando clases */
$moneda = new MonedaModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["monedaId"])) {
            $moneda->insertarMoneda($_POST["monedaSucursalId"], $_POST["monedaNombre"]);
        }else{
            $moneda->updateMoneda($_POST["monedaId"], $_POST["monedaSucursalId"],$_POST["monedaNombre"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $moneda->getMoneda_x_sucursalId($_POST["idsucursal"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["monedaNombre"];
            $sub_array[] = $row["monedaFechaCreacion"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["monedaId"].')" id="'.$row["monedaId"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';;
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["monedaId"].')" id="'.$row["monedaId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
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
        $datos = $moneda->getMoneda_x_id($_POST["monedaId"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["monedaId"] = $row["monedaId"];
                $output["monedaSucursalId"] = $row["monedaSucursalId"];
                $output["monedaNombre"] = $row["monedaNombre"];

            }
            echo json_encode($output);
        }
    break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $moneda->eliminarMoneda($_POST["monedaId"]);
        break;
    
}

?>