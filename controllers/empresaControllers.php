<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/empresaModels.php");

/*TODO: inicializando clases */
$empresa = new EmpresaModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["idempresa"])) {
            $empresa->insertarEmpresa($_POST["idcompania"], $_POST["nombreempresa"], $_POST["rucempresa"]);
        }else{
            $empresa->updateEmpresa($_POST["idempresa"], $_POST["idcompania"],$_POST["nombreempresa"], $_POST["rucempresa"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $empresa->getEmpresa_x_companialId($_POST["idcompania"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array = $row["rucempresa"];
            $sub_array = $row["nombreempresa"];
            $sub_array = $row["fechacreacionempresa"];
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
        $datos = $empresa->getEmpresa_x_id($_POST["idempresa"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["idempresa"] = $row["idempresa"];
                $output["idcompania"] = $row["idcompania"];
                $output["nombreempresa"] = $row["nombreempresa"];
                $output["rucempresa"] = $row["rucempresa"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $empresa->eliminarEmpresa($_POST["idempresa"]);
        break;

    /*TODO: Listar Combobox */
    case 'combo':
        $datos = $empresa->getEmpresa_x_companialId($_POST["empresaCompaniaId"]); 
                    
        if (is_array($datos)==true and count($datos)>0) {
            $html="";
            $html.="<option selected>Seleccionar</option>";
            foreach ($datos as $row) {
                $html.="<option value='".$row["idempresa"]."'>".$row["nombreempresa"]."</option>";
            }
            echo $html;
        }
        break;
    
}

?>