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
                @$_POST["productoImagen"]

            );

            
        }else{
            $producto->updateProducto($_POST["productoId"],$_POST["productoSucursalId"], $_POST["productoCategoriaId"], $_POST["productoNombre"],
                $_POST["productoDescripcion"], $_POST["productoMonedaId"], $_POST["productoUnidadId"], 
                $_POST["productoPrecioCompra"], $_POST["productoPrecioVenta"] , $_POST["productoStock"] 
                ,@$_POST["productoImagen"] //el @ ayuda a que no aparezca el error undefined array "productoImagen"
            );
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $producto->getProducto_x_sucursalId($_POST["sucursalId"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            if ($row["productoImagen"] != ''){
                $sub_array[] =
                "<div class='d-flex align-items-center'>" .
                    "<div class='flex-shrink-0 me-2'>".
                        "<img src='../../assets/producto/".$row["productoImagen"]."' alt='' class='avatar-xs rounded-circle'>".
                    "</div>".
                "</div>";
            }else{
                $sub_array[] =
                "<div class='d-flex align-items-center'>" .
                    "<div class='flex-shrink-0 me-2'>".
                        "<img src='../../assets/producto/no_imagen.png' alt='' class='avatar-xs rounded-circle'>".
                    "</div>".
                "</div>";
            }

            $sub_array[] = $row["categoriaNombre"];
            $sub_array[] = $row["productoNombre"];
            $sub_array[] = $row["productoDescripcion"];
            $sub_array[] = $row["unidadNombre"];
            $sub_array[] = $row["monedaNombre"];
            $sub_array[] = $row["productoPrecioCompra"];
            $sub_array[] = $row["productoPrecioVenta"];
            $sub_array[] = $row["productoStock"];
            $sub_array[] = $row["productoFechaCreacion"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["productoId"].')" id="'.$row["productoId"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';;
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["productoId"].')" id="'.$row["productoId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
            $sub_array[] = '<button type="button" onClick="ver('.$row["productoId"].')" id="'.$row["productoId"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';
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
                $output["unidadNombre"] = $row["unidadNombre"];
                $output["productoMonedaId"] = $row["productoMonedaId"];
                $output["productoPrecioCompra"] = $row["productoPrecioCompra"];
                $output["productoPrecioVenta"] = $row["productoPrecioVenta"];
                $output["productoStock"] = $row["productoStock"];
                if($row["productoImagen"] != ''){
                    $output["productoImagen"] = '<img src="../../assets/producto/'.$row["productoImagen"].'" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_producto_imagen" value="'.$row["productoImagen"].'" />';
                }else{
                    $output["productoImagen"] = '<img src="../../assets/producto/no_imagen.png" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_producto_imagen" value="" />';
                }

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
        $datos = $producto->getProducto_x_categoriaid($_POST["categoriaId"]);
        
        if(is_array($datos)==true and count($datos)>0){
            $html="";
            $html.="<option selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row["productoId"]."'>".$row["productoNombre"]."</option>";
            }
            echo $html;
        }
    break;


    /* TODO: Listar consumo de Productos */
    case "consumo":
        $datos=$producto->get_producto_consumo($_POST["idproducto"]);
        $data=Array();
        foreach($datos as $row){
            $sub_array = array();
            if ($row["Registro"] == 'Compra'){
                $sub_array[] = "<div class='flex-shrink-0 avatar-xs acitivity-avatar'><div class='avatar-title bg-soft-success text-success rounded-circle'><i class='ri-shopping-cart-2-line'></i></div></div>";
            }else{
                $sub_array[] = "<div class='flex-shrink-0 avatar-xs acitivity-avatar'><div class='avatar-title bg-soft-danger text-danger rounded-circle'><i class='ri-stack-fill'></i></div></div>";
            }
            $sub_array[] = $row["Registro"];
            $sub_array[] = $row["documentoNombre"];
            $sub_array[] = $row["fechaCreacion"];
            $sub_array[] = $row["detallecompraCantidad"];
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
        echo json_encode($results);
        break;


}

?>