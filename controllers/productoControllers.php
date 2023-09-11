<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/productoModels.php");

/*TODO: inicializando clases */
$producto = new ProductoModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["productoId"])) {
            $producto->insertarProducto(
                $_POST["productoSucursalId"], 
                $_POST["productoCategoriaId"], 
                $_POST["productoNombre"],
                $_POST["productoDescripcion"], 
                $_POST["productoMonedaId"], 
                $_POST["productoUnidadId"], 
                $_POST["productoPrecioCompra"], 
                $_POST["productoPrecioVenta"] , 
                $_POST["productoStock"], 
                //$_POST["productoImagen"], 
                //$_POST["productoFechaVenta"]
            );
        }else{
            $producto->updateProducto($_POST["productoId"],$_POST["productoSucursalId"], $_POST["productoCategoriaId"], $_POST["productoNombre"],
                $_POST["productoDescripcion"], $_POST["productoMonedaId"], $_POST["productoUnidadId"], 
                $_POST["productoPrecioCompra"], $_POST["productoPrecioVenta"] , $_POST["productoStock"] 
                //,$_POST["productoFechaVenta"]//$_POST["productoImagen"],
            );
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $producto->getProducto_x_sucursalId($_POST["sucursalId"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["categoriaNombre"];
            $sub_array[] = $row["productoNombre"];
            $sub_array[] = $row["productoDescripcion"];
            $sub_array[] = $row["unidadNombre"];
            $sub_array[] = $row["monedaNombre"];
            $sub_array[] = $row["productoPrecioCompra"];
            $sub_array[] = $row["productoPrecioVenta"];
            $sub_array[] = $row["productoStock"];
            //$sub_array[] = $row["productoFechaVenta"];
            //$sub_array[] = $row["productoImagen"];
            $sub_array[] = $row["productoFechaCreacion"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["productoId"].')" id="'.$row["productoId"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';;
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["productoId"].')" id="'.$row["productoId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
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
        $datos = $producto->getProducto_x_id($_POST["productoId"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["productoId"] = $row["productoId"];
                $output["productoCategoriaId"] = $row["productoCategoriaId"];
                $output["productoNombre"] = $row["productoNombre"];
                $output["productoDescripcion"] = $row["productoDescripcion"];
                $output["productoUnidadId"] = $row["productoUnidadId"];
                $output["productoMonedaId"] = $row["productoMonedaId"];
                $output["productoPrecioCompra"] = $row["productoPrecioCompra"];
                $output["productoPrecioVenta"] = $row["productoPrecioVenta"];
                $output["productoStock"] = $row["productoStock"];
                $output["productoFechaVenta"] = $row["productoFechaVenta"];
                //$output["productoImagen"] = $row["productoImagen"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $producto->eliminarProducto($_POST["productoId"]);
        break;
    

        
    /*TODO: Listar Combobox */
    case "combo";
        $datos = $producto->getProducto_x_sucursalId($_POST["productoId"]);
        
        if(is_array($datos)==true and count($datos)>0){
            $html="";
            $html.="<option selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row["productoId"]."'>".$row["productoNombre"]."</option>";
            }
            echo $html;
        }
    break;

}

?>