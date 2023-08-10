<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/sucursalModels.php");
    /* TODO: Inicializando clase */
    $sucursal = new SucursalModels();

    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
        case "guardaryeditar":
            if(empty($_POST["idsucursal"])){
                $sucursal->insertarSucursal($_POST["idempresa"],$_POST["nombresucursal"]);
            }else{
                $sucursal->updateSucursal($_POST["idsucursal"],$_POST["idempresa"],$_POST["nombresucursal"]);
            }
            break;

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar":
            $datos=$sucursal->getSucursal_x_empresalId($_POST["idempresa"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["nombresucursal"];
                $sub_array[] = $row["sucursalFechaCreacion"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["idsucursal"].')" id="'.$row["idsucursal"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["idsucursal"].')" id="'.$row["idsucursal"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        /* TODO:Mostrar informacion de registro segun su ID */
        case "mostrar":
            $datos=$sucursal->getSucursal_x_id($_POST["idsucursal"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["idsucursal"] = $row["idsucursal"];
                    $output["idempresa"] = $row["idempresa"];
                    $output["nombresucursal"] = $row["nombresucursal"];
                }
                echo json_encode($output);
            }
            break;

        /* TODO: Cambiar Estado a 0 del Registro */
        case "eliminar";
            $sucursal->eliminarSucursal($_POST["idsucursal"]);
            break;

        /* TODO: Listar Combo */
        case "combo";
            $datos=$sucursal->getSucursal_x_empresalId($_POST["idempresa"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["sucursalId"]."'>".$row["sucursalNombre"]."</option>";
                }
                echo $html;
            }
            break;
    }
?>