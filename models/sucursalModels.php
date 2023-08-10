<?php

    class SucursalModels extends Conectar{
        /*TODO: Listar Sucursal*/
        public function getSucursal_x_empresalId($idempresa) {
            $conectar = parent::Conexion();
            $sql = "call spListarSucursal (?);";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idempresa);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Sucursal por Id*/
        public function getSucursal_x_id($idsucursal){
            $conectar = parent::Conexion();
            $sql = "call spListarSucursalporId (?);";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Sucursal*/
        public function eliminarSucursal($idsucursal){
            $conectar = parent::Conexion();
            $sql = "spEliminarSucursal ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->execute();
        }        
        /*TODO: Insertar Sucursal*/
        public function insertarSucursal($idempresa, $nombresucursal){
            $conectar = parent::Conexion();
            $sql = "spRegistrarSucursal ?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idempresa);
            $query->bindValue(2,$nombresucursal);
            $query->execute();
        
        }        
        /*TODO:Actualizar Registro*/
        public function updateSucursal($idsucursal, $idempresa, $nombresucursal){
            $conectar = parent::Conexion();
            $sql = "spUpdateSucursal ?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->bindValue(2,$idempresa);
            $query->bindValue(3,$nombresucursal);
            $query->execute();
        }        

    }

?>