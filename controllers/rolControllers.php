<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/rolModels.php");

/*TODO: inicializando clases */
$rol = new RolModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["rolId"])) {
            $rol->insertarRol($_POST["rolSucursalId"], $_POST["rolNombre"]);
        }else{
            $rol->updateRol($_POST["rolId"], $_POST["rolSucursalId"],$_POST["rolNombre"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $rol->getRol_x_sucursalId($_POST["idsucursal"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["rolNombre"];
            $sub_array[] = $row["rolFechaCreacion"];
            $sub_array[] = '<button type="button" onClick="permiso('.$row["rolId"].')" id="'.$row["rolId"].'" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';;
            $sub_array[] = '<button type="button" onClick="editar('.$row["rolId"].')" id="'.$row["rolId"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';;
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["rolId"].')" id="'.$row["rolId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
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
        $datos = $rol->getRol_x_id($_POST["rolId"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["rolId"] = $row["rolId"];
                $output["rolSucursalId"] = $row["rolSucursalId"];
                $output["rolNombre"] = $row["rolNombre"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $rol->eliminarRol($_POST["rolId"]);
        break;
    

     /*TODO: Listar Combobox */
     case "combo":
        $datos = $rol->getRol_x_sucursalId($_POST["idsucursal"]);
                   
        if (is_array($datos)==true and count($datos)>0) {
            $html="";
            $html.="<option selected>Seleccionar</option>";
            foreach ($datos as $row) {
                $html.="<option value='".$row["rolId"]."'>".$row["rolNombre"]."</option>";
            }
            echo $html;
        }
    break;
   
}

?>