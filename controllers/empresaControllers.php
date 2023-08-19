<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/empresaModels.php");

/*TODO: inicializando clases */
$empresa = new EmpresaModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["empresaId"])) {
            $empresa->insertarEmpresa($_POST["empresaCompaniaId"], $_POST["empresaNombre"], $_POST["empresaRuc"]);
        }else{
            $empresa->updateEmpresa($_POST["empresaId"], $_POST["empresaCompaniaId"],$_POST["empresaNombre"], $_POST["empresaRuc"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $empresa->getEmpresa_x_companialId($_POST["idcompania"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["empresaRuc"];
            $sub_array[] = $row["empresaNombre"];
            $sub_array[] = $row["empresaFechaCreacion"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["empresaId"].')" id="'.$row["empresaId"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';;
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["empresaId"].')" id="'.$row["empresaId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
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
        $datos = $empresa->getEmpresa_x_id($_POST["empresaId"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["empresaId"] = $row["empresaId"];
                $output["empresaCompaniaId"] = $row["empresaCompaniaId"];
                $output["empresaNombre"] = $row["empresaNombre"];
                $output["empresaRuc"] = $row["empresaRuc"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $empresa->eliminarEmpresa($_POST["empresaId"]);
        break;

    /*TODO: Listar Combobox */
    case "combo":
        $datos = $empresa->getEmpresa_x_companialId($_POST["idcompania"]); 
                    
        if (is_array($datos)==true and count($datos)>0) {
            $html="";
            $html.="<option selected>Seleccionar</option>";
            foreach ($datos as $row) {
                $html.="<option value='".$row["empresaId"]."'>".$row["empresaNombre"]."</option>";
            }
            echo $html;
        }
        break;
    
}

?>