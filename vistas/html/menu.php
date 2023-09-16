<?php
    require_once("../../models/menuModels.php");
    $menu = new MenuModels();
    $datos = $menu->getmenu_x_rolId($_SESSION["rolId"]);
    
?>

<div class="app-menu navbar-menu">

    <div class="navbar-brand-box">

        <a href="#" class="logo logo-dark">
            <span class="logo-sm">
                <img src="../../assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../../assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>

        <a href="#" class="logo logo-light">
            <span class="logo-sm">
                <img src="../../assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../../assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>

    </div>

    <div id="scrollbar">

        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                
                <?php
                    
                    foreach ($datos as $row) {
                        if ($row["menuGrupo"]=="Dashboard" && $row["detallemenuPermiso"]=="Si") {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="<?php echo $row["menuRuta"];?>">
                                    <i class="ri-honour-line"></i> <span data-key="t-widgets"><?php echo $row["menuNombre"];?> </span>
                                </a>
                            </li>
                        <?php
                        }
                    }

                ?>
                
                


                <li class="menu-title"><span data-key="t-menu">Mantenimiento</span></li>
                
                <?php
                    foreach ($datos as $row) {
                       if ($row["menuGrupo"]=="Mantenimiento" && $row["detallemenuPermiso"]=="Si"){
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="<?php echo $row["menuRuta"];?>">
                                        <i class="ri-honour-line"></i> <span data-key="t-widgets"><?php echo $row["menuNombre"];?></span>
                                    </a>
                                </li>
                            <?php
                        }
                    }
                ?>

                <li class="menu-title"><span data-key="t-menu">Compra</span></li>

                <?php
                    foreach ($datos as $row) {
                       if ($row["menuGrupo"]=="Compra" && $row["detallemenuPermiso"]=="Si"){
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="<?php echo $row["menuRuta"];?>">
                                        <i class="ri-honour-line"></i> <span data-key="t-widgets"><?php echo $row["menuNombre"];?></span>
                                    </a>
                                </li>
                            <?php
                        }
                    }
                ?>

                <li class="menu-title"><span data-key="t-menu">Venta</span></li>
                <?php
                    foreach ($datos as $row) {
                       if ($row["menuGrupo"]=="Venta" && $row["detallemenuPermiso"]=="Si"){
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="<?php echo $row["menuRuta"];?>">
                                        <i class="ri-honour-line"></i> <span data-key="t-widgets"><?php echo $row["menuNombre"];?></span>
                                    </a>
                                </li>
                            <?php
                        }
                    }
                ?>


            </ul>
        </div>

    </div>

    <div class="sidebar-background"></div>
</div>

<div class="vertical-overlay"></div>