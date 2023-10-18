<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/ventaModels.php");

/*TODO: inicializando clases */
$venta = new VentaModels();

switch ($_GET["op"]) {
    /*TODO: Registro de venta */
    case 'registrar':
       $datos = $venta->insert_venta_x_sucursalid($_POST["idsucursal"],$_POST["idusuario"]);
       foreach ($datos as $row) {
            $output["ventaId"] = $row["ventaId"];
        }
        echo json_encode($output);
    break;
    /*TODO: Registro de detalleventa */
    case 'guardardetalle':
        $datos = $venta->insert_detalleventa($_POST["ventaId"],$_POST["productoId"],$_POST["precioVenta"],$_POST["cantidad"]);
    break;
    /*TODO: Calculo de SubTota, Igv, Total */
    case 'calculo':
    $datos = $venta->calcularCampos($_POST["idventa"]);        
        foreach ($datos as $row){
            $output["ventaSubTotal"] = $row["ventaSubTotal"];
            $output["ventaIgv"] = $row["ventaIgv"];
            $output["ventaTotal"] = $row["ventaTotal"];
        }
        echo json_encode($output);
        
    break;
    /*TODO: Eliminar registro de detalleventa */
    case 'eliminardetalle':
        $venta->delete_detalleventa($_POST["detalleventaId"]);
    break;

     /*TODO: Listado de registros formato json para Datatables js     */
     case 'listardetalle':
        $datos = $venta->getList_detalleventa($_POST["idventa"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["categoriaNombre"];
            $sub_array[] = $row["productoNombre"];
            $sub_array[] = $row["unidadNombre"];
            $sub_array[] = $row["detalleventaProductoPrecioVenta"];
            $sub_array[] = $row["detalleventaCantidad"];
            $sub_array[] = $row["detalleventaTotal"];
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["detalleventaId"].','.$row["detalleventaVentaId"].')" id="'.$row["detalleventaId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
            $data[] = $sub_array;

        }

        $result = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
                        
        echo json_encode($result);
        break;

        /* TODO: Formato venta para la vista del documento */
        case "listardetalleformato";
            $datos=$venta->getList_detalleventa($_POST["idventa"]);
            foreach($datos as $row){
                ?>
                     <tr>
                        <td><?php echo $row["categoriaNombre"];?></td>
                        <td><?php echo $row["productoNombre"];?></td>
                        <td scope="row"><?php echo $row["unidadNombre"];?></td>
                        <td><?php echo $row["detalleventaProductoPrecioVenta"];?></td>
                        <td><?php echo $row["detalleventaCantidad"];?></td>
                        <td class="text-end"><?php echo $row["detalleventaTotal"];?></td>
                    </tr>
                <?php
            }
            break;


        /*TODO: Actualizar de venta a estado = 1*/
        case 'guardar':
            $datos = $venta->update_venta(
                $_POST["ventaId"],
                $_POST["pagoId"],
                $_POST["idCliente"],
                $_POST["rucCliente"],
                $_POST["direccionCliente"],
                $_POST["correoCliente"],
                $_POST["comentarios"],
                $_POST["monedaId"]);

        break;

        /*TODO: Eliminar registro de detalleventa */
         case 'mostrar':
        $datos = $venta->getVenta($_POST["idventa"]);
        foreach ($datos as $row){
            $output["ventaId"] = $row["ventaId"];
            $output["ventaSucursalId"] = $row["ventaSucursalId"];
            $output["ventaPagoId"] = $row["ventaPagoId"];
            $output["ventaClienteId"] = $row["ventaClienteId"];
            $output["ventaClienteRuc"] = $row["ventaClienteRuc"];
            $output["ventaClienteDireccion"] = $row["ventaClienteDireccion"];
            $output["ventaClienteCorreo"] = $row["ventaClienteCorreo"];
            $output["ventaSubTotal"] = $row["ventaSubTotal"];
            $output["ventaIgv"] = $row["ventaIgv"];
            $output["ventaTotal"] = $row["ventaTotal"];
            $output["ventaComentario"] = $row["ventaComentario"];
            $output["ventaUsuarioId"] = $row["ventaUsuarioId"];
            $output["ventaMonedaId"] = $row["ventaMonedaId"]; 
            $output["ventaFechaCreacion"] = $row["ventaFechaCreacion"];

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

            $output["clienteNombre"] = $row["clienteNombre"]; 
 
        }
        echo json_encode($output);
         break;
    
         /*TODO: Listado de venta por sucursalId */
         case 'listarventa':
            $datos = $venta->getVentaListado($_POST["idsucursal"]);
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = "C-".$row["ventaId"];
                $sub_array[] = $row["clienteRuc"];
                $sub_array[] = $row["clienteNombre"];
                $sub_array[] = $row["pagoNombre"];
                $sub_array[] = $row["monedaNombre"];
                $sub_array[] = $row["ventaSubTotal"];
                $sub_array[] = $row["ventaIgv"];
                $sub_array[] = $row["ventaTotal"];
                $sub_array[] = $row["usuarioNombre"]."".$row["usuarioApellido"];
                $sub_array[] = '<a href="../ViewVenta/?c='.$row["ventaId"].'" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-printer-line"></i></a>';
                $sub_array[] = '<button type="button" onClick="ver('.$row["ventaId"].')" id="'.$row["ventaId"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';
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