<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/proveedorModels.php");

/*TODO: inicializando clases */
$proveedor = new ProveedorModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["proveedorId"])) {
            $proveedor->insertarProveedor($_POST["proveedorEmpresaId"], $_POST["proveedorNombre"], $_POST["proveedorRuc"], $_POST["proveedorTelefono"], $_POST["proveedorDireccion"], $_POST["proveedorCorreo"]);
        }else{
            $proveedor->updateProveedor($_POST["proveedorId"], $_POST["proveedorEmpresaId"],$_POST["proveedorNombre"], $_POST["proveedorRuc"], $_POST["proveedorTelefono"], $_POST["proveedorDireccion"], $_POST["proveedorCorreo"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $proveedor->getProveedor_x_empresaId($_POST["proveedorEmpresaId"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["proveedorNombre"];
            $sub_array[] = $row["proveedorRuc"];
            $sub_array[] = $row["proveedorTelefono"];
            $sub_array[] = $row["proveedorDireccion"];
            $sub_array[] = $row["proveedorCorreo"];
            $sub_array[] = $row["proveedorFechaCreacion"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["proveedorId"].')" id="'.$row["proveedorId"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';;
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["proveedorId"].')" id="'.$row["proveedorId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
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
        $datos = $proveedor->getProveedor_x_id($_POST["proveedorId"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["proveedorId"] = $row["proveedorId"];
                $output["proveedorEmpresaId"] = $row["proveedorEmpresaId"];
                $output["proveedorNombre"] = $row["proveedorNombre"];
                $output["proveedorRuc"] = $row["proveedorRuc"];
                $output["proveedorTelefono"] = $row["proveedorTelefono"];
                $output["proveedorDireccion"] = $row["proveedorDireccion"];
                $output["proveedorCorreo"] = $row["proveedorCorreo"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $proveedor->eliminarProveedor($_POST["proveedorId"]);
        break;
    
}

?>