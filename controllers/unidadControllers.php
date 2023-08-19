<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/unidadModels.php");

/*TODO: inicializando clases */
$unidad = new UnidadModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["unidadId"])) {
            $unidad->insertarUnidad($_POST["unidadSucursalId"], $_POST["unidadNombre"]);
        }else{
            $unidad->updateUnidad($_POST["unidadId"], $_POST["unidadSucursalId"],$_POST["unidadNombre"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $unidad->getUnidad_x_sucursalId($_POST["idsucursal"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["unidadNombre"];
            $sub_array[] = $row["unidadFechaCreacion"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["unidadId"].')" id="'.$row["unidadId"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';;
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["unidadId"].')" id="'.$row["unidadId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
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
        $datos = $unidad->getUnidad_x_id($_POST["unidadId"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["unidadId"] = $row["unidadId"];
                $output["unidadSucursalId"] = $row["unidadSucursalId"];
                $output["unidadNombre"] = $row["unidadNombre"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $unidad->eliminarUnidad($_POST["unidadId"]);
        break;
    
}

?>