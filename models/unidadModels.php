<?php

    class UnidadModels extends Conectar{
        /*TODO: Listar Unidad*/
        public function getUnidad_x_sucursalId($idsucursal) {
            $conectar = parent::Conexion();
            $sql = "spListarUnidad ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Unidad por Id*/
        public function getUnidad_x_id($idunidad){
            $conectar = parent::Conexion();
            $sql = "spListarUnidadporId ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idunidad);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Unidad*/
        public function eliminarUnidad($idUnidad){
            $conectar = parent::Conexion();
            $sql = "spEliminarUnidad ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idUnidad);
            $query->execute();
        }        
        /*TODO: Insertar Unidad*/
        public function insertarUnidad($idsucursal, $nombreUnidad){
            $conectar = parent::Conexion();
            $sql = "spRegistrarUnidad ?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->bindValue(2,$nombreUnidad);
            $query->execute();
        
        }        
        /*TODO:Actualizar Registro*/
        public function updateUnidad($idunidad, $idsucursal, $nombreUnidad){
            $conectar = parent::Conexion();
            $sql = "spUpdateUnidad ?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idunidad);
            $query->bindValue(2,$idsucursal);
            $query->bindValue(3,$nombreUnidad);
            $query->execute();
        }        

    }

?>