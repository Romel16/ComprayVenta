<?php

    class RolModels extends Conectar{
        /*TODO: Listar Rol*/
        public function getRol_x_sucursalId($idsucursal) {
            $conectar = parent::Conexion();
            $sql = "spListarRol ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Rol por Id*/
        public function getRol_x_id($idrol){
            $conectar = parent::Conexion();
            $sql = "spListarRolporId ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idrol);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Rol*/
        public function eliminarRol($idrol){
            $conectar = parent::Conexion();
            $sql = "spEliminarRol ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idrol);
            $query->execute();
        }        
        /*TODO: Insertar Rol*/
        public function insertarRol($idsucursal, $nombrerol){
            $conectar = parent::Conexion();
            $sql = "spRegistrarRol ?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->bindValue(2,$nombrerol);
            $query->execute();
        
        }        
        /*TODO:Actualizar Registro*/
        public function updateRol($idrol, $idsucursal, $nombrerol){
            $conectar = parent::Conexion();
            $sql = "spUpdateRol ?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idrol);
            $query->bindValue(2,$idsucursal);
            $query->bindValue(3,$nombrerol);
            $query->execute();
        }        

    }

?>