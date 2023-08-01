<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/clienteModels.php");

/*TODO: inicializando clases */
$cliente = new ClienteModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["idcliente"])) {
            $cliente->insertarCliente($_POST["idempresa"], $_POST["nombrecliente"], $_POST["ruccliente"], $_POST["telefonocliente"], $_POST["direccioncliente"], $_POST["correocliente"]);
        }else{
            $cliente->updateCliente($_POST["idcliente"], $_POST["idempresa"],$_POST["nombrecliente"], $_POST["ruccliente"], $_POST["telefonocliente"], $_POST["direccioncliente"], $_POST["correocliente"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $cliente->getCliente_x_empresaId($idempresa);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array = $row["nombrecliente"];
            $sub_array = $row["ruccliente"];
            $sub_array = $row["telefonocliente"];
            $sub_array = $row["direccioncliente"];
            $sub_array = $row["correocliente"];
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
        $datos = $cliente->getCliente_x_id($_POST["idcliente"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["idcliente"] = $row["idcliente"];
                $output["idempresa"] = $row["idempresa"];
                $output["nombrecliente"] = $row["nombrecliente"];
                $output["ruccliente"] = $row["ruccliente"];
                $output["telefonocliente"] = $row["telefonocliente"];
                $output["direccioncliente"] = $row["direccioncliente"];
                $output["correocliente"] = $row["correocliente"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $cliente->eliminarCliente($_POST["idcliente"]);
        break;
    
}

?>