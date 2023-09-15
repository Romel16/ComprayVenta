<?php

    require_once("../../config/conexion.php");

    if (isset($_SESSION["usuarioId"])) {


?>

<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Punto de Venta | Perfil</title>
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
                                <h4 class="mb-sm-0">Mantenimiento Perfil</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Mantenimiento</a></li>
                                        <li class="breadcrumb-item active">Perfil </li>
                                    </ol>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row gy-4">
                                                <div class="col-xxl-3 col-md-6">
                                                    <div>
                                                        <label for="basiInput" class="form-label">Contraseña</label>
                                                        <input type="password" class="form-control" id="txtpass">
                                                    </div>
                                                </div>

                                                <div class="col-xxl-3 col-md-6">
                                                    <div>
                                                        <label for="labelInput" class="form-label">Confirmar Contraseña</label>
                                                        <input type="password" class="form-control" id="txtpassconfirm">
                                                    </div>
                                                </div>

                                                <div class="col-xxl-3 col-md-6">
                                                    <div>
                                                        <label for="labelInput" class="form-label">&nbsp;</label>
                                                        <button type="button" id="btnguardar" class="form-control btn btn-primary btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

            <?php require_once("../html/footer.php"); ?>
        </div>

    </div>

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

    <script type="text/javascript" src="mntperfil.js"></script>
</body>

</html>

<?php
    }else {
        header("Location:".Conectar::ruta()."vistas/404/");
    }
?>