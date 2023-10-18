CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateVenta`(in idVentaSucursal int,
 in idUsuario int(11))
BEGIN    
    insert into venta(ventaSucursalId,ventaUsuarioId,ventaEstado) 
	values(idVentaSucursal,idUsuario,2);
    
        select compraId from compra where  compraId = @@Identity;

END

DELIMITER //
CREATE PROCEDURE spRegistrarVenta(
    IN idVenta int,
    IN idProducto int,
    IN precioVenta numeric(9,2),
	IN cantidad int
)
BEGIN
    -- Insertar un nuevo venta en la tabla 'detallecompra'
    INSERT INTO detalleventa (detalleventaCompraId, detalleventaProductoId, detalleventaProductoPrecioCompra, detalleventaCantidad, detalleventaTotal ,detalleventaFechaCreacion, detalleventaEstado)
    VALUES (idVenta, idProducto, precioVenta,cantidad, precioVenta * cantidad,now(),1);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE spListarDetalleVenta(
	IN idVenta int
)
BEGIN
select dv.detalleventaId, c.categoriaNombre, p.productoNombre, u.unidadNombre, dv.detalleventaProductoPrecioVenta,
dv.detalleventaCantidad, dv.detalleventaTotal, dv.detalleventaVentaId, dv.detalleventaProductoId
from detalleventa dv
join producto p on dv.detalleventaProductoId = p.productoId
join categoria c on p.productoCategoriaId = c.categoriaId
join unidad u on p.productoUnidadId = u.unidadId
where dv.detalleventaVentaId = idVenta
and dv.detalleventaEstado = 1;

END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE spEliminarDetalleVenta(
	IN idDetalleVenta int
)
BEGIN
update detalleventa
   set 
	detalleventaEstado = 0
    where 
		detalleventaId = idDetalleVenta ;

END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE spUpdateDetalleVenta(
	IN idVenta int
)
BEGIN
	 update compra
   set 
	ventaSubTotal = (select sum(detalleventaTotal) from detalleventa where detalleventaVentaId = idVenta and detalleventaEstado = 1),
	ventaIgv = (select sum(detalleventaTotal) from detalleventa where detalleventaVentaId = idVenta and detalleventaEstado = 1) * 0.18,
	ventaTotal = (select sum(detalleventaTotal) from detalleventa where detalleventaventaId = idventa and detalleventaEstado = 1) + 
    ((select sum(detalleventaTotal) from detalleventa where detalleventaVentaId = idVenta and detalleventaEstado = 1) * 0.18)
    where ventaId = idVenta;
    
    select ventaSubTotal,ventaIgv,ventaTotal from venta
		where ventaId = idCompra;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE ListVenta(
	IN idSucursal int
)
BEGIN
	 SELECT          
 v.ventaId,   
 v.ventaSucursalId,   
 v.ventaPagoId,   
 v.ventaClienteId,   
 v.ventaSubTotal,   
 v.ventaIgv,   
 v.ventaTotal,   
 v.ventaComentario,   
 v.ventaUsuarioId,   
 v.ventaMonedaId,   
 v.ventaFechaCreacion,   
 v.ventaEstado,   
 s.sucursalNombre,   
 e.empresaNombre,   
 e.empresaRuc,   
 e.empresaCorreo,   
 e.empresaTelefono,   
 e.empresaDireccion,   
 e.empresaPagina,   
 comp.companiaNombre,   
 u.usuarioCorreo,   
 u.usuarioNombre,   
 u.usuarioApellido,   
 u.usuarioDni,   
 u.usuarioTelefono,   
 r.rolNombre,   
 p.pagoNombre,   
 m.monedaNombre,  
 c.clienteRuc,
 c.clienteNombre
 FROM              
 venta v JOIN  
 sucursal s ON v.ventaSucursalId = s.sucursalId JOIN  
 empresa e ON s.sucursalEmpresaId = e.empresaId  JOIN  
 compania comp ON e.empresaCompaniaId = comp.companiaId JOIN  
 usuario u ON v.ventaUsuarioId = u.usuarioId  JOIN  
 rol r ON u.usuarioRolId = r.rolId  JOIN  
 pago p ON v.ventaPagoId = p.pagoId  JOIN  
 moneda m ON v.ventaMonedaId = m.monedaId  JOIN  
 cliente c on v.ventaClienteId = c.clienteId
 WHERE  
 v.ventaEstado=1  
 and v.ventaSucursalId = idSucursal ;
END //
DELIMITER ;




DELIMITER //
CREATE PROCEDURE `setViewSales`(in idVenta int)
BEGIN
	SELECT          
 c.ventaId,   
 c.ventaSucursalId,   
 c.ventaPagoId,   
 c.ventaClienteId,   
 c.ventaClienteRuc,   
 c.ventaClienteDireccion,   
 c.ventaClienteCorreo,  	
 c.ventaSubTotal,   
 c.ventaIgv,   
 c.ventaTotal,   
 c.ventaComentario,   
 c.ventaUsuarioId,   
 c.ventaMonedaId,   
 c.ventaFechaCreacion,   
 c.ventaEstado,   
 s.sucursalNombre,   
 e.empresaNombre,   
 e.empresaRuc,   
 e.empresaCorreo,   
 e.empresaTelefono,   
 e.empresaDireccion,   
 e.empresaPagina,   
 comp.companiaNombre,   
 u.usuarioCorreo,   
 u.usuarioNombre,   
 u.usuarioApellido,   
 u.usuarioDni,   
 u.usuarioTelefono,   
 r.rolNombre,   
 p.pagoNombre,   
 m.monedaNombre,  
 c.clienteNombre
 FROM              
 venta v JOIN  
 sucursal s ON c.ventaSucursalId = s.sucursalId JOIN  
 empresa e ON s.sucursalEmpresaId = e.empresaId  JOIN  
 compania comp ON e.empresaCompaniaId = comp.companiaId JOIN  
 usuario u ON c.ventaUsuarioId = u.usuarioId  JOIN  
 rol r ON u.usuarioRolId = r.rolId  JOIN  
 pago p ON c.ventaPagoId = p.pagoId  JOIN  
 moneda m ON c.ventaMonedaId = m.monedaId  JOIN  
 cliente c ON c.ventaClienteId =  c.clienteId  
 WHERE  
 v.ventaEstado=1  
 AND v.ventaId = idVenta ;
END//
DELIMITER ;

