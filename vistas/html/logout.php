<?php
    require_once("../../config/conexion.php");
    header("Location:".Conectar::ruta()."?c=".$_SESSION["empresaCompaniaId"]);
    /* TODO:Destruir Session */
    session_destroy();
    exit();
?>