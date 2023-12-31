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
            $usuario->insertarUsuario($_POST["usuarioSucursalId"], $_POST["usuarioRolId"], $_POST["usuarioCorreo"], 
                        $_POST["usuarioNombre"], $_POST["usuarioApellido"], $_POST["usuarioDni"], 
                        $_POST["usuarioTelefono"], $_POST["usuarioPassword"],@$_POST["usuarioImagen"]);
        }else{
            $usuario->updateUsuario($_POST["usuarioId"], $_POST["usuarioSucursalId"],$_POST["usuarioRolId"], 
                        $_POST["usuarioCorreo"], $_POST["usuarioNombre"], $_POST["usuarioApellido"], 
                        $_POST["usuarioDni"], $_POST["usuarioTelefono"], $_POST["usuarioPassword"], @$_POST["usuarioImagen"]);
        }
        break;

        /*TODO: Listado de registros formato json para Datatables js     */
    case 'listar':
        $datos = $usuario->getUsuario_x_sucursalId($_POST["idsucursal"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();

            if ($row["usuarioImagen"] != ''){
                $sub_array[] =
                "<div class='d-flex align-items-center'>" .
                    "<div class='flex-shrink-0 me-2'>".
                        "<img src='../../assets/usuario/".$row["usuarioImagen"]."' alt='' class='avatar-xs rounded-circle'>".
                    "</div>".
                "</div>";
            }else{
                $sub_array[] =
                "<div class='d-flex align-items-center'>" .
                    "<div class='flex-shrink-0 me-2'>".
                        "<img src='../../assets/usuario/no_imagen.png' alt='' class='avatar-xs rounded-circle'>".
                    "</div>".
                "</div>";
            }


            $sub_array[] = $row["usuarioCorreo"];
            $sub_array[] = $row["usuarioNombre"];
            $sub_array[] = $row["usuarioApellido"];
            $sub_array[] = $row["usuarioDni"];
            $sub_array[] = $row["usuarioTelefono"];
            $sub_array[] = $row["usuarioPassword"];
            $sub_array[] = $row["rolNombre"];
            $sub_array[] = $row["usuarioFechaCreacion"];
            $sub_array[] = '<button type="button" onClick="editar('.$row["usuarioId"].')" id="'.$row["usuarioId"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';;
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["usuarioId"].')" id="'.$row["usuarioId"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';;
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
        $datos = $usuario->getUsuario_x_id($_POST["usuarioId"]);
        if (is_array($datos)== true and count($datos)>0) {
            foreach ($datos as $row) {
                $output["usuarioId"] = $row["usuarioId"];
                $output["usuarioSucursalId"] = $row["usuarioSucursalId"];
                $output["usuarioNombre"] = $row["usuarioNombre"];
                $output["usuarioApellido"] = $row["usuarioApellido"];
                $output["usuarioCorreo"] = $row["usuarioCorreo"];
                $output["usuarioDni"] = $row["usuarioDni"];
                $output["usuarioTelefono"] = $row["usuarioTelefono"];
                $output["usuarioPassword"] = $row["usuarioPassword"];
                $output["usuarioRolId"] = $row["usuarioRolId"];

                if($row["usuarioImagen"] != ''){
                    $output["usuarioImagen"] = '<img src="../../assets/usuario/'.$row["usuarioImagen"].'" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_usuario_imagen" value="'.$row["usuarioImagen"].'" />';
                }else{
                    $output["usuarioImagen"] = '<img src="../../assets/usuario/no_imagen.png" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image"></img><input type="hidden" name="hidden_usuario_imagen" value="" />';
                }

            }
            echo json_encode($output);
        }
        break;
    /*TODO: Cambiar estado del registro a 0 */
    case 'eliminar':
        $usuario->eliminarUsuario($_POST["usuarioId"]);
    break;
    
    /*TODO: Cambiar de contraseña Controllers*/
    case 'actualizar':
        $usuario->updateUsuarioPass($_POST["usuarioId"], $_POST["passusuario"]);
    break;
    
}

?>