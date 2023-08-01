<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/categoriaModels.php");

/*TODO: inicializando clases */
$categoria = new CategoriaModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["idcategoria"])) {
            $categoria->insertarCategoria($_POST["idsucursal"], $_POST["nombrecategoria"]);
        }else{
            $categoria->updateCategoria($_POST["idcategoria"], $_POST["idsucursal"],$_POST["nombrecategoria"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $categoria->getCategoria_x_sucursalId($idsucursal);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array = $row["nombrecategoria"];
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
        $datos = $categoria->getCategoria_x_id($_POST["idcategoria"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["idcategoria"] = $row["idcategoria"];
                $output["idsucursal"] = $row["idsucursal"];
                $output["nombrecategoria"] = $row["nombrecategoria"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $categoria->eliminarCategoria($_POST["idcategoria"]);
        break;
    
}

?>