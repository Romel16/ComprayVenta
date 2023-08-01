<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/companiaModels.php");

/*TODO: inicializando clases */
$compania = new CompaniaModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["idcompania"])) {
            $compania->insertarCompania($_POST["nombrecompania"]);
        }else{
            $compania->updateCompania($_POST["idcompania"], $_POST["nombrecompania"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $compania->getCompania();
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array = $row["nombrecompania"];
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
        $datos = $compania->getCompania_x_id($_POST["idcompania"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["idcompania"] = $row["idcompania"];
                $output["idsucursal"] = $row["idsucursal"];
                $output["nombrecompania"] = $row["nombrecompania"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $compania->eliminarCompania($_POST["idcompania"]);
        break;
    
}

?>