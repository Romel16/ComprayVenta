<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/unidadModels.php");

/*TODO: inicializando clases */
$unidad = new UnidadModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["idunidad"])) {
            $unidad->insertarUnidad($_POST["idsucursal"], $_POST["nombreUnidad"]);
        }else{
            $unidad->updateUnidad($_POST["idunidad"], $_POST["idsucursal"],$_POST["nombreUnidad"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $unidad->getUnidad_x_sucursalId($idsucursal);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array = $row["nombreunidad"];
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
        $datos = $unidad->getUnidad_x_id($_POST["idunidad"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["idunidad"] = $row["idunidad"];
                $output["idsucursal"] = $row["idsucursal"];
                $output["nombreunidad"] = $row["nombreunidad"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $unidad->eliminarUnidad($_POST["idunidad"]);
        break;
    
}

?>