<?php

    class ProductoModels extends Conectar{
        /*TODO: Listar Producto*/
        public function getProducto_x_sucursalId($idsucursal) {
            $conectar = parent::Conexion();
            $sql = "call spListarProducto (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Producto por Id*/
        public function getProducto_x_id($idproducto){
            $conectar = parent::Conexion();
            $sql = "call spListarProductoporId (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idproducto);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Producto*/
        public function eliminarProducto($idproducto){
            $conectar = parent::Conexion();
            $sql = "call spEliminarProducto (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idproducto);
            $query->execute();
        }        
        /*TODO: Insertar Producto*/
        public function insertarProducto($idsucursal, $idcategoria, $nombreproducto, $descripcionproducto,
                $idmoneda,$idunidad, $preciocompraproducto,$precioventaproducto,$stockproducto,//$imagenproducto,$fechaventaproducto
                ){
            $conectar = parent::Conexion();
            $sql = "call spRegistrarProducto (?,?,?,?,?,?,?,?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->bindValue(2,$idcategoria);
            $query->bindValue(3,$nombreproducto);
            $query->bindValue(4,$descripcionproducto);
            $query->bindValue(5,$idmoneda);
            $query->bindValue(6,$idunidad);
            $query->bindValue(7,$preciocompraproducto);
            $query->bindValue(8,$precioventaproducto);
            $query->bindValue(9,$stockproducto);
            //$query->bindValue(10,$fechaventaproducto);
            //$query->bindValue(11,$imagenproducto);
            $query->execute();
            
        }        
        /*TODO:Actualizar Registro*/
        public function updateProducto($idproducto, $idsucursal, $idcategoria, $nombreproducto, $descripcionproducto,
                $idmoneda,$idunidad, $preciocompraproducto,$precioventaproducto,$stockproducto,//$imagenproducto,$fechaventaproducto
                ){
            $conectar = parent::Conexion();
            $sql = "call spUpdateProducto (?,?,?,?,?,?,?,?,?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idproducto);
            $query->bindValue(2,$idsucursal);
            $query->bindValue(3,$idcategoria);
            $query->bindValue(4,$nombreproducto);
            $query->bindValue(5,$descripcionproducto);
            $query->bindValue(6,$idmoneda);
            $query->bindValue(7,$idunidad);
            $query->bindValue(8,$preciocompraproducto);
            $query->bindValue(9,$precioventaproducto);
            $query->bindValue(10,$stockproducto);
            //$query->bindValue(11,$fechaventaproducto);
            //$query->bindValue(12,$imagenproducto);
            $query->execute();
        }        

    }

?>