<?php

    class MonedaModels extends Conectar{
        /*TODO: Listar Moneda*/
        public function getMoneda_x_sucursalId($idsucursal) {
            $conectar = parent::Conexion();
            $sql = "call spListarMoneda (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Moneda por Id*/
        public function getMoneda_x_id($idmoneda){
            $conectar = parent::Conexion();
            $sql = "call spListarMonedaporId (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idmoneda);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Moneda*/
        public function eliminarMoneda($idmoneda){
            $conectar = parent::Conexion();
            $sql = "call spEliminarMoneda (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idmoneda);
            $query->execute();
        }        
        /*TODO: Insertar Moneda*/
        public function insertarMoneda($idsucursal, $nombremoneda){
            $conectar = parent::Conexion();
            $sql = "call spRegistrarMoneda (?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->bindValue(2,$nombremoneda);
            $query->execute();
        
        }        
        /*TODO:Actualizar Registro*/
        public function updateMoneda($idmoneda, $idsucursal, $nombremoneda){
            $conectar = parent::Conexion();
            $sql = "call spUpdateMoneda (?,?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idmoneda);
            $query->bindValue(2,$idsucursal);
            $query->bindValue(3,$nombremoneda);
            $query->execute();
        }        

    }

?>