<?php

/*TODO: llamando clases*/
require_once("../config/conexion.php");
require_once("../models/usuarioModels.php");

/*TODO: inicializando clases */
$usuario = new UsuarioModels();

switch ($_GET["op"]) {
    /*TODO: guardar y Editar, guardar cuando el ID este vacion, y Actualuzar cuando se envie el ID */
    case 'guardaryeditar':
        if (empty($_POST["idusuario"])) {
            $usuario->insertarUsuario($_POST["idsucursal"], $_POST["idrol"], $_POST["correousuario"], 
                        $_POST["nombreusuario"], $_POST["apellidousuario"], $_POST["dniusuario"], 
                        $_POST["telefonousuario"], $_POST["passwordusuario"]);
        }else{
            $usuario->updateUsuario($_POST["idusuario"], $_POST["idsucursal"],$_POST["idrol"], 
                        $_POST["correousuario"], $_POST["nombreusuario"], $_POST["apellidousuario"], 
                        $_POST["dniusuario"], $_POST["telefonousuario"], $_POST["passwordusuario"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $usuario->getUsuario_x_sucursalId($idsucursal);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array = $row["correousuario"];
            $sub_array = $row["nombreusuario"];
            $sub_array = $row["apellidousuario"];
            $sub_array = $row["dniusuario"];
            $sub_array = $row["telefonousuario"];
            $sub_array = $row["passwordusuario"];
            $sub_array = $row["idrol"];
            $sub_array = "Editar";
            $sub_array = "Eliminar";
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
        $datos = $usuario->getUsuario_x_id($_POST["idusuario"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["idusuario"] = $row["idusuario"];
                $output["idsucursal"] = $row["idsucursal"];
                $output["nombreusuario"] = $row["nombreusuario"];
                $output["apellidousuario"] = $row["apellidousuario"];
                $output["correousuario"] = $row["correousuario"];
                $output["dniusuario"] = $row["dniusuario"];
                $output["telefonousuario"] = $row["telefonousuario"];
                $output["passwordusuario"] = $row["passwordusuario"];
                $output["idrol"] = $row["idrol"];

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $usuario->eliminarUsuario($_POST["idusuario"]);
        break;
    
}

?>