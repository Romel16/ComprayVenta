<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/productoModels.php");

/*TODO: inicializando clases */
$producto = new ProductoModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["idproducto"])) {
            $producto->insertarProducto($_POST["idsucursal"], $_POST["idcategoria"], $_POST["nombreproducto"],
                    $_POST["descripcionproducto"], $_POST["idmoneda"], $_POST["idunidad"], 
                    $_POST["preciocompraproducto"], $_POST["precioventaproducto"] , $_POST["stockproducto"], 
                    $_POST["imagenproducto"], $_POST["fechaventaproducto"]);
        }else{
            $producto->updateProducto($_POST["idproducto"],$_POST["idsucursal"], $_POST["idcategoria"], $_POST["nombreproducto"],
                $_POST["descripcionproducto"], $_POST["idmoneda"], $_POST["idunidad"], 
                $_POST["preciocompraproducto"], $_POST["precioventaproducto"] , $_POST["stockproducto"], 
                $_POST["imagenproducto"], $_POST["fechaventaproducto"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $producto->getProducto_x_sucursalId($idsucursal);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array = $row["nombreproducto"];
            $sub_array = $row["descripcionproducto"];
            $sub_array = $row["preciocompraproducto"];
            $sub_array = $row["precioventaproducto"];
            $sub_array = $row["stockproducto"];
            $sub_array = $row["fechaventaproducto"];
            $sub_array = $row["imagenproducto"];
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
        $datos = $producto->getProducto_x_id($_POST["idproducto"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["idproducto"] = $row["idproducto"];
                $output["idcategoria"] = $row["idcategoria"];
                $output["nombreproducto"] = $row["nombreproducto"];
                $output["descripcionproducto"] = $row["descripcionproducto"];
                $output["preciocompraproducto"] = $row["preciocompraproducto"];
                $output["precioventaproducto"] = $row["precioventaproducto"];
                $output["stockproducto"] = $row["stockproducto"];
                $output["stockproducto"] = $row["stockproducto"];
                $output["fechaventaproducto"] = $row["fechaventaproducto"];
                $output["imagenproducto"] = $row["imagenproducto"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $producto->eliminarProducto($_POST["idproducto"]);
        break;
    
}

?>