<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/clienteModels.php");

/*TODO: inicializando clases */
$cliente = new ClienteModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["clienteId"])) {
            $cliente->insertarCliente($_POST["clienteEmpresaId"], $_POST["clienteNombre"], $_POST["clienteRuc"], $_POST["clienteTelefono"], $_POST["clienteDireccion"], $_POST["clienteCorreo"]);
        }else{
            $cliente->updateCliente($_POST["clienteId"], $_POST["clienteEmpresaId"],$_POST["clienteNombre"], $_POST["clienteRuc"], $_POST["clienteTelefono"], $_POST["clienteDireccion"], $_POST["clienteCorreo"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $cliente->getCliente_x_empresaId($_POST["idempresa"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["clienteNombre"];
            $sub_array[] = $row["clienteRuc"];
            $sub_array[] = $row["clienteTelefono"];
            $sub_array[] = $row["clienteDireccion"];
            $sub_array[] = $row["clienteCorreo"];
            $sub_array[] = $row["clienteFechaCreacion"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["clienteId"].')" id="'.$row["clienteId"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';;
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["clienteId"].')" id="'.$row["clienteId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
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
        $datos = $cliente->getCliente_x_id($_POST["clienteId"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["clienteId"] = $row["clienteId"];
                $output["clienteEmpresaId"] = $row["clienteEmpresaId"];
                $output["clienteNombre"] = $row["clienteNombre"];
                $output["clienteRuc"] = $row["clienteRuc"];
                $output["clienteTelefono"] = $row["clienteTelefono"];
                $output["clienteDireccion"] = $row["clienteDireccion"];
                $output["clienteCorreo"] = $row["clienteCorreo"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $cliente->eliminarCliente($_POST["clienteId"]);
        break;
    
}

?>