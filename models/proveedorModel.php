<?php

    class ProveedorModels extends Conectar{
        /*TODO: Listar Proveedor*/
        public function getProveedor_x_sucursalId($idempresa) {
            $conectar = parent::Conexion();
            $sql = "spListarProveedor ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idempresa);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Proveedor por Id*/
        public function getProveedor_x_id($idproveedor){
            $conectar = parent::Conexion();
            $sql = "spListarProveedorporId ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idproveedor);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Proveedor*/
        public function eliminarProveedor($idproveedor){
            $conectar = parent::Conexion();
            $sql = "spEliminarProveedor ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idproveedor);
            $query->execute();
        }        
        /*TODO: Insertar Proveedor*/
        public function insertarProveedor($idempresa, $nombreproveedor, $rucproveedor, $telefonoproveedor,$direccionproveedor,$correoproveedor){
            $conectar = parent::Conexion();
            $sql = "spRegistrarProveedor ?,?,?,?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idempresa);
            $query->bindValue(2,$nombreproveedor);
            $query->bindValue(3,$rucproveedor);
            $query->bindValue(4,$telefonoproveedor);
            $query->bindValue(5,$direccionproveedor);
            $query->bindValue(6,$correoproveedor);
            $query->execute();
            
        }        
        /*TODO:Actualizar Registro*/
        public function updateProveedor($idproveedor, $idempresa, $nombreproveedor, $rucproveedor, $telefonoproveedor,$direccionproveedor,$correoproveedor){
            $conectar = parent::Conexion();
            $sql = "spUpdateProveedor ?,?,?,?,?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idproveedor);
            $query->bindValue(2,$idempresa);
            $query->bindValue(3,$nombreproveedor);
            $query->bindValue(4,$rucproveedor);
            $query->bindValue(5,$telefonoproveedor);
            $query->bindValue(6,$direccionproveedor);
            $query->bindValue(7,$correoproveedor);
            $query->execute();
        }        

    }

?>