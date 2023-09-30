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
       /* $datos = $compra->calcularCampos($_POST["idcompra"]);
        
        foreach ($datos as $row){
            $output["compraSubTotal"] = $row["compraSubTotal"];
            $output["compraIgv"] = $row["compraIgv"];
            $output["compraTotal"] = $row["compraTotal"];
        }
        json_encode($output);*/

        if (isset($_POST["idcompra"])) {
            $idCompra = $_POST["idcompra"];
            
            $datos = $compra->calcularCampos($idCompra);
        
            if ($datos !== false) {
                // Los datos se obtuvieron correctamente
                foreach ($datos as $row){
                    $output["compraSubTotal"] = $row["compraSubTotal"];
                    $output["compraIgv"] = $row["compraIgv"];
                    $output["compraTotal"] = $row["compraTotal"];
                }
                echo json_encode($output);
            } else {
                // La función calcularCampos no devolvió datos válidos
                echo json_encode(["error" => "No se pudieron obtener los datos."]);
            }
        } else {
            // El parámetro idcompra no se envió en $_POST
            echo json_encode(["error" => "Falta el parámetro idcompra en la solicitud."]);
        }
        
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
   
}

?>