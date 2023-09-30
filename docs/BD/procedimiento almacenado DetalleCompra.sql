DELIMITER //
CREATE PROCEDURE spRegistrarDetalleCompra(
    IN idCompra int,
    IN idProducto int,
    IN precioCompra numeric(9,2),
	IN cantidad int
)
BEGIN
    -- Insertar un nuevo compra en la tabla 'detallecompra'
    INSERT INTO detallecompra (detallecompraCompraId, detallecompraProductoId, detallecompraProductoPrecioCompra, detallecompraCantidad, detallecompraTotal ,detallecompraFechaCreacion, detallecompraEstado)
    VALUES (idCompra, idProducto, precioCompra,cantidad, precioCompra * cantidad,now(),1);
END;
//

DELIMITER ;


DELIMITER //
CREATE PROCEDURE spListarDetalleCompra(
    IN idCompra int
)
BEGIN
   select dc.detallecompraId, c.categoriaNombre, p.productoNombre, u.unidadNombre, dc.detallecompraProductoPrecioCompra,
dc.detallecompraCantidad, dc.detallecompraTotal, dc.detallecompraCompraId, dc.detallecompraProductoId
from detallecompra dc
join producto p on dc.detallecompraProductoId = p.productoId
join categoria c on p.productoCategoriaId = c.categoriaId
join unidad u on p.productoUnidadId = u.unidadId
where dc.detallecompraCompraId = idCompra
and dc.detallecompraEstado = 1;

END;
//

DELIMITER ;

DELIMITER //
CREATE PROCEDURE spEliminarDetalleCompra(
    IN idDetalleCompra int
)
BEGIN
   update detallecompra
   set 
	detallecompraEstado = 0
    where 
		detallecompraId = idDetalleCompra ;
END;
//

DELIMITER ;



CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateDetalleCompra`(
    IN idCompra int
)
BEGIN
   update compra
   set 
	compraSubTotal = (select sum(detallecompraTotal) as compraSubTotal from detallecompra where detallecompraCompraId = idCompra and detallecompraEstado = 1),
	compraIgv = (select sum(detallecompraTotal) * 0.18 as compraSubTotal from detallecompra where detallecompraCompraId = idCompra and detallecompraEstado = 1),
	compraTotal = (select sum(detallecompraTotal) as compraSubTotal from detallecompra where detallecompraCompraId = idCompra and detallecompraEstado = 1) + 
    (select sum(detallecompraTotal) * 0.18 as compraSubTotal from detallecompra  where detallecompraCompraId = idCompra and detallecompraEstado = 1)
    where compraId = idCompra;
    
    select compraSubTotal,compraIgv, compraTotal from compra
		where compraId = idCompra;
END