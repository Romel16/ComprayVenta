<?php

    class CategoriaModels extends Conectar{
        /*TODO: Listar Categoria*/
        public function getCategoria_x_sucursalId($idsucursal) {
            $conectar = parent::Conexion();
            $sql = "call spListarCategoria (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Categoria por Id*/
        public function getCategoria_x_id($idcategoria){
            $conectar = parent::Conexion();
            $sql = "call spListarCategoriaporId (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcategoria);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Categoria*/
        public function eliminarCategoria($idcategoria){
            $conectar = parent::Conexion();
            $sql = "call spEliminarCategoria (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcategoria);
            $query->execute();
        }        
        /*TODO: Insertar Categoria*/
        public function insertarCategoria($idsucursal, $nombrecategoria){
            $conectar = parent::Conexion();
            $sql = "call spRegistrarCategoria (?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->bindValue(2,$nombrecategoria);
            $query->execute();
        
        }        
        /*TODO:Actualizar Registro*/
        public function updateCategoria($idcategoria, $idsucursal, $nombrecategoria){
            $conectar = parent::Conexion();
            $sql = "call spUpdateCategoria (?,?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcategoria);
            $query->bindValue(2,$idsucursal);
            $query->bindValue(3,$nombrecategoria);
            $query->execute();
        }        
        /*TODO:Mostrar total producto x Categoria*/
        public function StockProductoxCategoria($idsucursal){
            $conectar = parent::Conexion();
            $sql = "call spStockporCategoria (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        

    }

?>