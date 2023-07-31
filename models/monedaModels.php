<?php

    class MonedaModels extends Conectar{
        /*TODO: Listar Moneda*/
        public function getMoneda_x_sucursalId($idsucursal) {
            $conectar = parent::Conexion();
            $sql = "spListarMoneda ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Moneda por Id*/
        public function getMoneda_x_id($idmoneda){
            $conectar = parent::Conexion();
            $sql = "spListarMonedaporId ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idmoneda);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Moneda*/
        public function eliminarMoneda($idmoneda){
            $conectar = parent::Conexion();
            $sql = "spEliminarMoneda ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idmoneda);
            $query->execute();
        }        
        /*TODO: Insertar Moneda*/
        public function insertarMoneda($idsucursal, $nombreMoneda){
            $conectar = parent::Conexion();
            $sql = "spRegistrarMoneda ?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->bindValue(2,$nombreMoneda);
            $query->execute();
        
        }        
        /*TODO:Actualizar Registro*/
        public function updateMoneda($idmoneda, $idsucursal, $nombreMoneda){
            $conectar = parent::Conexion();
            $sql = "spUpdateMoneda ?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idmoneda);
            $query->bindValue(2,$idsucursal);
            $query->bindValue(3,$nombreMoneda);
            $query->execute();
        }        

    }

?>