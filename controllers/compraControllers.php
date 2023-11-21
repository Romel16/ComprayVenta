<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/compraModels.php");

/*TODO: inicializando clases */
$compra = new CompraModels();

switch ($_GET["op"]) {
        /*TODO: Registro de compra */
    case 'registrar':
        $datos = $compra->insert_compra_x_sucursalid($_POST["idsucursal"], $_POST["idusuario"]);
        foreach ($datos as $row) {
            $output["compraId"] = $row["compraId"];
        }
        echo json_encode($output);
        break;
        /*TODO: Registro de detallecompra */
    case 'guardardetalle':
        $datos = $compra->insert_detallecompra($_POST["compraId"], $_POST["productoId"], $_POST["precioCompra"], $_POST["cantidad"]);
        break;
        /*TODO: Calculo de SubTota, Igv, Total */
    case 'calculo':
        $datos = $compra->calcularCampos($_POST["idcompra"]);
        foreach ($datos as $row) {
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
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();

            if ($row["productoImagen"] != '') {
                $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                    "<div class='flex-shrink-0 me-2'>" .
                    "<img src='../../assets/producto/" . $row["productoImagen"] . "' alt='' class='avatar-xs rounded-circle'>" .
                    "</div>" .
                    "</div>";
            } else {
                $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                    "<div class='flex-shrink-0 me-2'>" .
                    "<img src='../../assets/producto/no_imagen.png' alt='' class='avatar-xs rounded-circle'>" .
                    "</div>" .
                    "</div>";
            }

            $sub_array[] = $row["categoriaNombre"];
            $sub_array[] = $row["productoNombre"];
            $sub_array[] = $row["unidadNombre"];
            $sub_array[] = $row["detallecompraProductoPrecioCompra"];
            $sub_array[] = $row["detallecompraCantidad"];
            $sub_array[] = $row["detallecompraTotal"];
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["detallecompraId"] . ',' . $row["detallecompraCompraId"] . ')" id="' . $row["detallecompraId"] . '" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
            $data[] = $sub_array;
        }

        $result = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($result);
        break;

        /* TODO: Formato compra para la vista del documento */
    case "listardetalleformato";
        $datos = $compra->getList_detallecompra($_POST["idcompra"]);
        foreach ($datos as $row) {
?>
            <tr>

                <td><?php if ($row["productoImagen"] != '') {
                        echo
                        "<div class='d-flex align-items-center'>" .
                            "<div class='flex-shrink-0 me-2'>" .
                            "<img src='../../assets/producto/" . $row["productoImagen"] . "' alt='' class='avatar-xs rounded-circle'>" .
                            "</div>" .
                            "</div>";
                    } else {
                        echo
                        "<div class='d-flex align-items-center'>" .
                            "<div class='flex-shrink-0 me-2'>" .
                            "<img src='../../assets/producto/no_imagen.png' alt='' class='avatar-xs rounded-circle'>" .
                            "</div>" .
                            "</div>";
                    }; ?></td>
                <td><?php echo $row["categoriaNombre"]; ?></td>
                <td><?php echo $row["productoNombre"]; ?></td>
                <td scope="row"><?php echo $row["unidadNombre"]; ?></td>
                <td><?php echo $row["detallecompraProductoPrecioCompra"]; ?></td>
                <td><?php echo $row["detallecompraCantidad"]; ?></td>
                <td class="text-end"><?php echo $row["detallecompraTotal"]; ?></td>
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
            $_POST["monedaId"],
            $_POST["documentoId"]
        );

        break;

        /*TODO: Eliminar registro de detallecompra */
    case 'mostrar':
        $datos = $compra->getCompra($_POST["compraId"]);
        foreach ($datos as $row) {
            $output["compraId"] = $row["compraId"];
            $output["compraSubTotal"] = $row["compraSubTotal"];
            $output["compraIgv"] = $row["compraIgv"];
            $output["compraTotal"] = $row["compraTotal"];
            $output["compraComentario"] = $row["compraComentario"];
            $output["compraFechaCreacion"] = $row["compraFechaCreacion"];

            $output["empresaNombre"] = $row["empresaNombre"];
            $output["empresaRuc"] = $row["empresaRuc"];
            $output["empresaCorreo"] = $row["empresaCorreo"];
            $output["empresaTelefono"] = $row["empresaTelefono"];
            $output["empresaDireccion"] = $row["empresaDireccion"];
            $output["empresaPagina"] = $row["empresaPagina"];

            $output["usuarioNombre"] = $row["usuarioNombre"];
            $output["usuarioApellido"] = $row["usuarioApellido"];

            $output["pagoNombre"] = $row["pagoNombre"];
            $output["rolNombre"] = $row["rolNombre"];

            $output["monedaNombre"] = $row["monedaNombre"];

            $output["proveedorNombre"] = $row["proveedorNombre"];
            $output["proveedorDireccion"] = $row["proveedorDireccion"];
            $output["proveedorRuc"] = $row["proveedorRuc"];
            $output["proveedorCorreo"] = $row["proveedorCorreo"];
        }
        echo json_encode($output);
        break;

        /*TODO: Listado de compra por sucursalId */
    case 'listarcompra':
        $datos = $compra->getCompraListado($_POST["idsucursal"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = "C-" . $row["compraId"];
            $sub_array[] = $row["documentoNombre"];
            $sub_array[] = $row["proveedorRuc"];
            $sub_array[] = $row["proveedorNombre"];
            $sub_array[] = $row["pagoNombre"];
            $sub_array[] = $row["monedaNombre"];
            $sub_array[] = $row["compraSubTotal"];
            $sub_array[] = $row["compraIgv"];
            $sub_array[] = $row["compraTotal"];
            $sub_array[] = $row["usuarioNombre"] . "" . $row["usuarioApellido"];

            if ($row["usuarioImagen"] != '') {
                $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                    "<div class='flex-shrink-0 me-2'>" .
                    "<img src='../../assets/usuario/" . $row["usuarioImagen"] . "' alt='' class='avatar-xs rounded-circle'>" .
                    "</div>" .
                    "</div>";
            } else {
                $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                    "<div class='flex-shrink-0 me-2'>" .
                    "<img src='../../assets/usuario/no_imagen.png' alt='' class='avatar-xs rounded-circle'>" .
                    "</div>" .
                    "</div>";
            }

            $sub_array[] = '<a href="../ViewCompra/?c=' . $row["compraId"] . '" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-printer-line"></i></a>';
            $sub_array[] = '<button type="button" onClick="ver(' . $row["compraId"] . ')" id="' . $row["compraId"] . '" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';
            $data[] = $sub_array;
        }

        $result = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($result);
        break;

        /* TODO: Formato compra top 5 para la vista por sucursal */
    case "listartopproducto";
        $datos = $compra->getTop5Compra($_POST["idsucursal"]);
        foreach ($datos as $row) {
        ?>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm bg-light rounded p-1 me-2">
                            <?php
                            if ($row["productoImagen"] != '') {
                            ?>
                                <?php
                                echo "<img src='../../assets/producto/" . $row["productoImagen"] . "' alt='' class='img-fluid d-block' />";
                                ?>
                            <?php
                            } else {
                            ?>
                                <?php
                                echo "<img src='../../assets/producto/no_imagen.png' alt='' class='img-fluid d-block' />";
                                ?>
                            <?php
                            }
                            ?>
                        </div>
                        <div>
                            <h5 class="fs-14 my-1"><?php echo $row["productoNombre"]; ?></h5>
                            <span class="text-muted"><?php echo $row["categoriaNombre"]; ?></span>
                        </div>
                    </div>
                </td>
                <td>
                    <h5 class="fs-14 my-1 fw-normal"><?php echo $row["productoPrecioCompra"]; ?></h5>
                    <span class="text-muted">P.Compra</span>
                </td>
                <td>
                    <h5 class="fs-14 my-1 fw-normal"><?php echo $row["cantidad"]; ?></h5>
                    <span class="text-muted">Cant</span>
                </td>
                <td>
                    <h5 class="fs-14 my-1 fw-normal"><?php echo $row["productoStock"]; ?></h5>
                    <span class="text-muted">Stock</span>
                </td>
                <td>
                    <h5 class="fs-14 my-1 fw-normal"><b><?php echo $row["monedaNombre"]; ?></b> <?php echo $row["total"]; ?></h5>
                    <span class="text-muted">Total</span>
                </td>
            </tr>
        <?php
        }
        break;


        /* TODO: Mostrar TOP 5 ultimas compras */
    case "top5":
        $datos = $compra->getComprasRecientes($_POST["idsucursal"]);
        foreach ($datos as $row) {
        ?>
            <tr>
                <td>
                    C-<?php echo $row["compraId"]; ?>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <?php
                            if ($row["usuarioImagen"] != '') {
                            ?>
                                <?php
                                echo "<img src='../../assets/usuario/" . $row["usuarioImagen"] . "' alt='' class='avatar-xs rounded-circle' />";
                                ?>
                            <?php
                            } else {
                            ?>
                                <?php
                                echo "<img src='../../assets/usuario/no_imagen.png' alt='' class='avatar-xs rounded-circle' />";
                                ?>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="flex-grow-1"><?php echo $row["usuarioNombre"]; ?> <?php echo $row["usuarioApellido"]; ?></div>
                    </div>
                </td>
                <td><?php echo $row["proveedorNombre"]; ?></td>
                <td><?php echo $row["monedaNombre"]; ?></td>
                <td><?php echo $row["compraSubTotal"]; ?></td>
                <td><?php echo $row["compraIgv"]; ?></td>
                <td><?php echo $row["compraTotal"]; ?></td>
            </tr>
        <?php
        }
    break;

     /* TODO: Listado de actividades recientes para dashboard */
     case "compraventa":
        $datos=$compra->getComprasVentas($_POST["idsucursal"]);
        foreach($datos as $row){
            ?>
                <div class="acitivity-item py-3 d-flex">
                    <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                        <?php
                            if ($row["Registro"] == 'Compra'){
                                ?>
                                    <div class="avatar-title bg-soft-success text-success rounded-circle">
                                        <i class="ri-shopping-cart-2-line"></i>
                                    </div>
                                <?php
                            }else{
                                ?>
                                    <div class="avatar-title bg-soft-danger text-danger rounded-circle">
                                        <i class="ri-stack-fill"></i>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-1 lh-base"><?php echo $row["Registro"];?> - <?php echo $row["documentoNombre"];?></h6>
                        <p class="text-muted mb-1"><?php echo $row["proveedorNombre"];?> </p>
                        <small class="mb-0 text-muted"><?php echo $row["fechaCreacion"];?></small>
                    </div>
                </div>
            <?php
        }
        break;
    /* TODO: consumo de compras por categoria para Donut del dashboard */
    case "dountcompra":
        $datos=$compra->getComprasporCategoria($_POST["idsucursal"]);
        $data = array();
        foreach($datos as $row){
            $data[]=$row;
        }
        echo json_encode($data);
    break; 

    /* case "barras":
        $datos=$compra->get_compra_barras($_POST["suc_id"]);
        $data = array();
        foreach($datos as $row){
            $data[]=$row;
        }
        echo json_encode($data);
        break; */


}


?>