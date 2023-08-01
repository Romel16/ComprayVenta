<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/rolModels.php");

/*TODO: inicializando clases */
$rol = new RolModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["idrol"])) {
            $rol->insertarRol($_POST["idsucursal"], $_POST["nombreRol"]);
        }else{
            $rol->updateRol($_POST["idrol"], $_POST["idsucursal"],$_POST["nombreRol"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $rol->getRol_x_sucursalId($idsucursal);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array = $row["nombrerol"];
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
        $datos = $rol->getRol_x_id($_POST["idrol"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["idrol"] = $row["idrol"];
                $output["idsucursal"] = $row["idsucursal"];
                $output["nombrerol"] = $row["nombrerol"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $rol->eliminarRol($_POST["idrol"]);
        break;
    
}

?>