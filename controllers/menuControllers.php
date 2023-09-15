<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/menuModels.php");

/*TODO: inicializando clases */
$menu = new MenuModels();

switch ($_GET["op"]) {
        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $menu->getmenu_x_rolId($_POST["rolId"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["menuNombre"];
            if ($row["detallemenuPermiso"]=="Si"){
                $sub_array[] = '<button type="button"  onClick="deshabilitar('.$row["detallemenuId"].')" id="'.$row["detallemenuId"].'" class="btn btn-success btn-label btn-sm"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>'.$row["detallemenuPermiso"].'</button>';
            }else{
                $sub_array[] = '<button type="button" onClick="habilitar('.$row["detallemenuId"].')" id="'.$row["detallemenuId"].'" class="btn btn-danger btn-label btn-sm"><i class="ri-close-circle-line label-icon align-middle fs-16 me-2"></i> '.$row["detallemenuPermiso"].'</button>';
            }
            $data[] = $sub_array;

        }

        $result = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data);
                        
        echo json_encode($result);
    break;
    
    /* TODO: habilitar permiso */
    case 'habilitar':
        $menu->update_menu_habilitar($_POST["detallemenuId"]);
        break;
        
        /* TODO: deshabilitar permiso */
    case 'deshabilitar':    
        $menu->update_menu_deshabilitar($_POST["detallemenuId"]);
    break;
    
    /* TODO: habilitar permiso */
    case 'insert':
        $menu = new MenuModels();
        //$menu->insert_menu_detalle_x_rolid($_POST["rolId"]);
    break;
}

?>