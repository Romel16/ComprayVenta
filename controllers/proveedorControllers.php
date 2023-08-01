<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/proveedorModels.php");

/*TODO: inicializando clases */
$proveedor = new ProveedorModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["idproveedor"])) {
            $proveedor->insertarProveedor($_POST["idempresa"], $_POST["nombreproveedor"], $_POST["rucproveedor"], $_POST["telefonoproveedor"], $_POST["direccionproveedor"], $_POST["correoproveedor"]);
        }else{
            $proveedor->updateProveedor($_POST["idproveedor"], $_POST["idempresa"],$_POST["nombreproveedor"], $_POST["rucproveedor"], $_POST["telefonoproveedor"], $_POST["direccionproveedor"], $_POST["correoproveedor"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $proveedor->getProveedor_x_empresaId($idempresa);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array = $row["nombreproveedor"];
            $sub_array = $row["rucproveedor"];
            $sub_array = $row["telefonoproveedor"];
            $sub_array = $row["direccionproveedor"];
            $sub_array = $row["correoproveedor"];
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
        $datos = $proveedor->getProveedor_x_id($_POST["idproveedor"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["idproveedor"] = $row["idproveedor"];
                $output["idempresa"] = $row["idempresa"];
                $output["nombreproveedor"] = $row["nombreproveedor"];
                $output["rucproveedor"] = $row["rucproveedor"];
                $output["telefonoproveedor"] = $row["telefonoproveedor"];
                $output["direccionproveedor"] = $row["direccionproveedor"];
                $output["correoproveedor"] = $row["correoproveedor"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $proveedor->eliminarProveedor($_POST["idproveedor"]);
        break;
    
}

?>