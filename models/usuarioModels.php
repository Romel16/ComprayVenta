<?php

    class UsuarioModels extends Conectar{
        /*TODO: Listar Usuario*/
        public function getUsuario_x_sucursalId($idsucursal) {
            $conectar = parent::Conexion();
            $sql = "call spListarUsuario (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Usuario por Id*/
        public function getUsuario_x_id($idusuario){
            $conectar = parent::Conexion();
            $sql = "call spListarUsuarioporId (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idusuario);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Usuario*/
        public function eliminarUsuario($idusuario){
            $conectar = parent::Conexion();
            $sql = "call spEliminarUsuario (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idusuario);
            $query->execute();
        }        
        /*TODO: Insertar Usuario*/
        public function insertarUsuario($idsucursal, $idrol, $correousuario, $nombreusuario, $apellidousuario,
                $dniusuario, $telefonousuario,$passwordusuario,$imagenusuario){
            $conectar = parent::Conexion();

            require_once("usuarioModels.php");
            $usuario = new UsuarioModels();
            $imagenusuario='';
            if ($_FILES["usuarioImagen"]["name"] !='' ) {
                $imagenusuario=$usuario->upload_image();
            }else{
                $imagenusuario = $_POST["hidden_usaurioo_imagen"];
            }

            $sql = "call spRegistrarUsuario (?,?,?,?,?,?,?,?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->bindValue(2,$idrol);
            $query->bindValue(3,$correousuario);
            $query->bindValue(4,$nombreusuario);
            $query->bindValue(5,$apellidousuario);
            $query->bindValue(6,$dniusuario);
            $query->bindValue(7,$telefonousuario);
            $query->bindValue(8,$passwordusuario);
            $query->bindValue(9,$imagenusuario);
            $query->execute();
            
        }        
        /*TODO:Actualizar Registro*/
        public function updateUsuario($idusuario, $idsucursal, $idrol, $correousuario, $nombreusuario, $apellidousuario,
                    $dniusuario, $telefonousuario,$passwordusuario, $imagenusuario){
            $conectar = parent::Conexion();

            require_once("usuarioModels.php");
            $usuario = new UsuarioModels();
            $imagenusuario='';
            if ($_FILES["usuarioImagen"]["name"] !='' ) {
                $imagenusuario=$usuario->upload_image();
            }else{
                $imagenusuario = $_POST["hidden_usuario_imagen"];
            }


            $sql = "call spUpdateUsuario (?,?,?,?,?,?,?,?,?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idusuario);
            $query->bindValue(2,$idsucursal);
            $query->bindValue(3,$idrol);
            $query->bindValue(4,$correousuario);
            $query->bindValue(5,$nombreusuario);
            $query->bindValue(6,$apellidousuario);
            $query->bindValue(7,$dniusuario);
            $query->bindValue(8,$telefonousuario);
            $query->bindValue(9,$passwordusuario);
            $query->bindValue(10,$imagenusuario);
            $query->execute();
        }       
        
        /*TODO: Cambio de Contraseña Models*/
        public function updateUsuarioPass($idusuario, $usuariopass) {
            $conectar = parent::Conexion();
            $sql = "call spCambioContrasena (?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idusuario);
            $query->bindValue(2,$usuariopass);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }


        /*TODO: Acceso al Sistema */
        public function login(){
            $conectar = parent::Conexion();
            if (isset($_POST["enviar"])) {
                $sucursal = $_POST["id_sucursal"];
                $correo = $_POST["usuariocorreo"];
                $pass = $_POST["usuariopassword"];

                if (empty($sucursal) and empty($correo) and empty($pass)) {
                    exit();
                }else {
                    $sql = "call spListarLogin (?,?,?)";
                    $query = $conectar->prepare($sql);
                    $query->bindValue(1,$sucursal);
                    $query->bindValue(2,$correo);
                    $query->bindValue(3,$pass);
                    $query->execute();
                    $resultado = $query->fetch();
                    if (is_array($resultado) and count($resultado)>0) {
                        /*TODO: Generar variables de sesion del usuario */
                        $_SESSION["usuarioId"] = $resultado["usuarioId"];
                        $_SESSION["usuarioNombre"] = $resultado["usuarioNombre"];
                        $_SESSION["usuarioApellido"] = $resultado["usuarioApellido"];
                        $_SESSION["usuarioCorreo"] = $resultado["usuarioCorreo"];
                        $_SESSION["sucursalId"] = $resultado["sucursalId"];
                        $_SESSION["empresaId"] = $resultado["empresaId"];
                        $_SESSION["companiaId"] = $resultado["companiaId"];
                        $_SESSION["rolId"] = $resultado["rolId"];
                        $_SESSION["usuarioImagen"] = $resultado["usuarioImagen"];

                        header("Location:".Conectar::ruta()."vistas/home/");
                    }else {
                        exit();
                    }
                }
            }else{

            }
        }
        
         /* TODO: Registrar Imagen */
         public function upload_image(){
            if (isset($_FILES["usuarioImagen"])){
                $extension = explode('.', $_FILES['usuarioImagen']['name']);
                $new_name = rand() . '.' . $extension[1];
                $destination = '../assets/usuario/' . $new_name;
                move_uploaded_file($_FILES['usuarioImagen']['tmp_name'], $destination);
                return $new_name;
            }
        }
    }

?>