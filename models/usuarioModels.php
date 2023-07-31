<?php

    class UsuarioModels extends Conectar{
        /*TODO: Listar Usuario*/
        public function getUsuario_x_sucursalId($idsucursal) {
            $conectar = parent::Conexion();
            $sql = "spListarUsuario ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Usuario por Id*/
        public function getUsuario_x_id($idusuario){
            $conectar = parent::Conexion();
            $sql = "spListarUsuarioporId ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idusuario);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Usuario*/
        public function eliminarUsuario($idusuario){
            $conectar = parent::Conexion();
            $sql = "spEliminarUsuario ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idusuario);
            $query->execute();
        }        
        /*TODO: Insertar Usuario*/
        public function insertarUsuario($idsucursal, $idrol, $correousuario, $nombreusuario, $apellidousuario,
                $dniusuario, $telefonousuario,$passwordusuario){
            $conectar = parent::Conexion();
            $sql = "spRegistrarUsuario ?,?,?,?,?,?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->bindValue(2,$idrol);
            $query->bindValue(3,$correousuario);
            $query->bindValue(4,$nombreusuario);
            $query->bindValue(5,$apellidousuario);
            $query->bindValue(6,$dniusuario);
            $query->bindValue(7,$telefonousuario);
            $query->bindValue(8,$passwordusuario);
            $query->execute();
            
        }        
        /*TODO:Actualizar Registro*/
        public function updateUsuario($idusuario, $idsucursal, $idrol, $correousuario, $nombreusuario, $apellidousuario,
                    $dniusuario, $telefonousuario,$passwordusuario){
            $conectar = parent::Conexion();
            $sql = "spUpdateUsuario ?,?,?,?,?,?,?,?,?";
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
            $query->execute();
        }        

    }

?>