<?php

    require_once("../../config/conexion.php");
    require_once("../../models/rolModels.php");
    $rol = new RolModels();
    $datos = $rol->validar_acceso_rol($_SESSION["usuarioId"],"listaventa");
    if (isset($_SESSION["usuarioId"])) {
        if(is_array($datos) and count($datos)>0){
    

?>

<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Punto de Venta | Listado de Ventas</title>
    <?php require_once("../html/head.php") ?>

    <!-- jsvectormap css -->
    <link href="../../assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="../../assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div id="layout-wrapper">
        <?php require_once("../html/header.php"); ?>

        <?php require_once("../html/menu.php"); ?>


        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Listado de Ventas</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Listado</a></li>
                                        <li class="breadcrumb-item active">Ventas </li>
                                    </ol>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" id="btnNuevo" name="btnNuevo" class="btn btn-primary btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Nuevo Registro</button>
                                </div>
                                <div class="card-body">
                                    <!-- TODO: Tabla de Categoria -->
                                    <table id="table_data" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Documento</th>
                                                <th>Ruc</th>
                                                <th>Cliente</th>
                                                <th>Pago</th>
                                                <th>Moneda</th>
                                                <th>SubTotal</th>
                                                <th>Igv</th>
                                                <th>Total</th>
                                                <th>Usuario</th>
                                                <th></th>
                                                <th></th>
                                                <th></th> 
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <?php require_once("../html/footer.php"); ?>
        </div>

    </div>

    <?php require_once("mantenimientoListaVenta.php"); ?>


    <?php require_once("../html/js.php"); ?>


    <!-- apexcharts -->
    <script src="../../assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="../../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="../../assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!--Swiper slider js-->
    <script src="../../assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- Dashboard init -->
    <script src="../../assets/js/pages/dashboard-ecommerce.init.js"></script>

    <!-- Chart JS -->
    <script src="../../assets/libs/chart.js/chart.min.js"></script>

    <script src="../../assets/js/pages/chartjs.init.js"></script>

    <script type="text/javascript" src="listaventa.js"></script>
</body>

</html>

<?php
        }else {
            header("Location:".Conectar::ruta()."vistas/404/");
        }
    }else {
        header("Location:".Conectar::ruta()."vistas/404/");
    }
?>