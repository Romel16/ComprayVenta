<?php

    class CompraModels extends Conectar{
        /*TODO: Registro de compra por sucursal*/
        public function insert_compra_x_sucursalid($idsucursal,$idusuario) {
            $conectar = parent::Conexion();
            $sql = "call spRegistrarCompra (?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->bindValue(2,$idusuario);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Registro de detallecompra*/
        public function insert_detallecompra($idcompra,$idproducto, $precioCompra, $cantidad) {
            $conectar = parent::Conexion();
            $sql = "call spRegistrarDetalleCompra (?,?,?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcompra);
            $query->bindValue(2,$idproducto);
            $query->bindValue(3,$precioCompra);
            $query->bindValue(4,$cantidad);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Lista de detallecompra*/
        public function getList_detallecompra($idcompra) {
            $conectar = parent::Conexion();
            $sql = "call spListarDetalleCompra (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcompra);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar registro de detallecompra*/
        public function delete_detallecompra($idcompraDetalle) {
            $conectar = parent::Conexion();
            $sql = "call spEliminarDetalleCompra (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcompraDetalle);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        

        /*TODO: Calcular SubTotal, Igv, Total */
        public function calcularCampos($idcompra) {
            $conectar = parent::Conexion();
            $sql = "call spUpdateDetalleCompra (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcompra);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Actualizar datos de la compra a est = 1 */
        public function update_compra($idcompra,$idpago,$idmoneda,$idproveedor,$rucproveedor,$direccionproveedor,$correoproveedor,$comentario) {
            $conectar = parent::Conexion();
            $sql = "call spUpdateCompra(?,?,?,?,?,?,?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcompra);
            $query->bindValue(2,$idpago);
            $query->bindValue(3,$idmoneda);
            $query->bindValue(4,$idproveedor);
            $query->bindValue(5,$rucproveedor);
            $query->bindValue(6,$direccionproveedor);
            $query->bindValue(7,$correoproveedor);
            $query->bindValue(8,$comentario);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

         /*TODO: Calcular SubTotal, Igv, Total */
        public function getCompra($idsucursal)
        {
            $conectar = parent::Conexion();
            $sql = "call setViewSales (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }       
        }

    
?>