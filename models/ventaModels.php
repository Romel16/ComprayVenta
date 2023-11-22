<?php

    class VentaModels extends Conectar{
        /*TODO: Registro de venta por sucursal*/
        public function insert_venta_x_sucursalid($idsucursal,$idusuario) {
            $conectar = parent::Conexion();
            $sql = "call spRegistrarVenta (?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idsucursal);
            $query->bindValue(2,$idusuario);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Registro de detalleventa*/
        public function insert_detalleventa($idventa,$idproducto, $precioVenta, $cantidad) {
            $conectar = parent::Conexion();
            $sql = "call spRegistrarDetalleVenta (?,?,?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idventa);
            $query->bindValue(2,$idproducto);
            $query->bindValue(3,$precioVenta);
            $query->bindValue(4,$cantidad);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC); 
        }        
        /*TODO: Lista de detalleventa*/
        public function getList_detalleventa($idventa) {
            $conectar = parent::Conexion();
            $sql = "call spListarDetalleVenta (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idventa);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar registro de detalleventa*/
        public function delete_detalleventa($idventaDetalle) {
            $conectar = parent::Conexion();
            $sql = "call spEliminarDetalleVenta (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idventaDetalle);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        

        /*TODO: Calcular SubTotal, Igv, Total */
        public function calcularCampos($idventa) {
            $conectar = parent::Conexion();
            $sql = "call spUpdateDetalleVenta (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idventa);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Actualizar datos de la venta a est = 1 */
        public function update_venta($idventa,$idpago,$idmoneda,$idcliente,$ruccliente,$direccioncliente,$correocliente,$comentario,$iddocumento) {
            $conectar = parent::Conexion();
            $sql = "call spUpdateVenta(?,?,?,?,?,?,?,?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idventa);
            $query->bindValue(2,$idpago);
            $query->bindValue(3,$idmoneda);
            $query->bindValue(4,$idcliente);
            $query->bindValue(5,$ruccliente);
            $query->bindValue(6,$direccioncliente);
            $query->bindValue(7,$correocliente);
            $query->bindValue(8,$comentario);
            $query->bindValue(9,$iddocumento);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

         /*TODO: Calcular SubTotal, Igv, Total */
        public function getVenta($idsucursal){
            $conectar = parent::Conexion();
            $sql = "call setViewSales (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }       
         /*TODO: Listado de venta por sucursalId */
        public function getVentaListado($idsucursal){
            $conectar = parent::Conexion();
            $sql = "call ListVenta (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }         
        
         /*TODO: Listado de compra top 5 por sucursalId */
         public function getTop5Venta($idsucursal){
            $conectar = parent::Conexion();
            $sql = "call spTop5Ventas (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }       

          /*TODO: Reporte en barras de compra por sucursalId */
          public function get_venta_barras($idsucursal){
            $conectar = parent::Conexion();
            $sql = "call spVentasBarra (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $idsucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }       
    }

    
?>