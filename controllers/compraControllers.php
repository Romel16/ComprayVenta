<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/compraModels.php");

/*TODO: inicializando clases */
$compra = new CompraModels();

switch ($_GET["op"]) {
    /*TODO: Registro de compra */
    case 'registrar':
       $datos = $compra->insert_compra_x_sucursalid($_POST["idsucursal"],$_POST["idusuario"]);
       foreach ($datos as $row) {
            $output["compraId"] = $row["compraId"];
        }
        echo json_encode($output);
    break;
    /*TODO: Registro de detallecompra */
    case 'guardardetalle':
        $datos = $compra->insert_detallecompra($_POST["compraId"],$_POST["productoId"],$_POST["precioCompra"],$_POST["cantidad"]);
    break;
    /*TODO: Calculo de SubTota, Igv, Total */
    case 'calculo':
    $datos = $compra->calcularCampos($_POST["idcompra"]);        
        foreach ($datos as $row){
            $output["compraSubTotal"] = $row["compraSubTotal"];
            $output["compraIgv"] = $row["compraIgv"];
            $output["compraTotal"] = $row["compraTotal"];
        }
        echo json_encode($output);
        
    break;
    /*TODO: Eliminar registro de detallecompra */
    case 'eliminardetalle':
        $compra->delete_detallecompra($_POST["detallecompraId"]);
    break;

     /*TODO: Listado de registros formato json para Datatables js     */
     case 'listardetalle':
        $datos = $compra->getList_detallecompra($_POST["idcompra"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["categoriaNombre"];
            $sub_array[] = $row["productoNombre"];
            $sub_array[] = $row["unidadNombre"];
            $sub_array[] = $row["detallecompraProductoPrecioCompra"];
            $sub_array[] = $row["detallecompraCantidad"];
            $sub_array[] = $row["detallecompraTotal"];
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["detallecompraId"].','.$row["detallecompraCompraId"].')" id="'.$row["detallecompraId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
            $data[] = $sub_array;

        }

        $result = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
                        
        echo json_encode($result);
        break;

        /* TODO: Formato compra para la vista del documento */
        case "listardetalleformato";
            $datos=$compra->getList_detallecompra($_POST["idcompra"]);
            foreach($datos as $row){
                ?>
                     <tr>
                        <td><?php echo $row["categoriaNombre"];?></td>
                        <td><?php echo $row["productoNombre"];?></td>
                        <td scope="row"><?php echo $row["unidadNombre"];?></td>
                        <td><?php echo $row["detallecompraProductoPrecioCompra"];?></td>
                        <td><?php echo $row["detallecompraCantidad"];?></td>
                        <td class="text-end"><?php echo $row["detallecompraTotal"];?></td>
                    </tr>
                <?php
            }
            break;


        /*TODO: Actualizar de compra a estado = 1*/
        case 'guardar':
            $datos = $compra->update_compra(
                $_POST["compraId"],
                $_POST["pagoId"],
                $_POST["idProveedor"],
                $_POST["rucProveedor"],
                $_POST["direccionProveedor"],
                $_POST["correoProveedor"],
                $_POST["comentarios"],
                $_POST["monedaId"]);

            $compra->update_compraStock();
        break;

        /*TODO: Eliminar registro de detallecompra */
         case 'mostrar':
        $datos = $compra->getCompra($_POST["compraId"]);
        foreach ($datos as $row){
            $output["compraId"] = $row["compraId"];
            $output["compraSucursalId"] = $row["compraSucursalId"];
            $output["compraPagoId"] = $row["compraPagoId"];
            $output["compraProveedorId"] = $row["compraProveedorId"];
            $output["compraProveedorRuc"] = $row["compraProveedorRuc"];
            $output["compraProveedorDireccion"] = $row["compraProveedorDireccion"];
            $output["compraProveedorCorreo"] = $row["compraProveedorCorreo"];
            $output["compraSubTotal"] = $row["compraSubTotal"];
            $output["compraIgv"] = $row["compraIgv"];
            $output["compraTotal"] = $row["compraTotal"];
            $output["compraComentario"] = $row["compraComentario"];
            $output["compraUsuarioId"] = $row["compraUsuarioId"];
            $output["compraMonedaId"] = $row["compraMonedaId"]; 
            $output["compraFechaCreacion"] = $row["compraFechaCreacion"];

            $output["sucursalNombre"] = $row["sucursalNombre"];

            $output["empresaNombre"] = $row["empresaNombre"];
            $output["empresaRuc"] = $row["empresaRuc"];
            $output["empresaCorreo"] = $row["empresaCorreo"];
            $output["empresaTelefono"] = $row["empresaTelefono"];
            $output["empresaDireccion"] = $row["empresaDireccion"];
            $output["empresaPagina"] = $row["empresaPagina"];

            $output["companiaNombre"] = $row["companiaNombre"];

            $output["usuarioCorreo"] = $row["usuarioCorreo"];
            $output["usuarioNombre"] = $row["usuarioNombre"];
            $output["usuarioApellido"] = $row["usuarioApellido"];
            $output["usuarioDni"] = $row["usuarioDni"];
            $output["usuarioTelefono"] = $row["usuarioTelefono"];

            $output["rolNombre"] = $row["rolNombre"];

            $output["pagoNombre"] = $row["pagoNombre"];

            $output["monedaNombre"] = $row["monedaNombre"];

            $output["proveedorNombre"] = $row["proveedorNombre"]; 
 
        }
        echo json_encode($output);
         break;
    
         /*TODO: Listado de compra por sucursalId */
         case 'listarcompra':
            $datos = $compra->getCompraListado($_POST["idsucursal"]);
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = "C-".$row["compraId"];
                $sub_array[] = $row["proveedorRuc"];
                $sub_array[] = $row["proveedorNombre"];
                $sub_array[] = $row["pagoNombre"];
                $sub_array[] = $row["monedaNombre"];
                $sub_array[] = $row["compraSubTotal"];
                $sub_array[] = $row["compraIgv"];
                $sub_array[] = $row["compraTotal"];
                $sub_array[] = $row["usuarioNombre"]."".$row["usuarioApellido"];
                $sub_array[] = '<a href="../ViewCompra/?c='.$row["compraId"].'" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-printer-line"></i></a>';
                $sub_array[] = '<button type="button" onClick="ver('.$row["compraId"].')" id="'.$row["compraId"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';
                $data[] = $sub_array;
    
            }
    
            $result = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
                            
            echo json_encode($result);
        break;



    
}


?>