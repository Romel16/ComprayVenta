DELIMITER $$
USE `comprayventa`$$
CREATE PROCEDURE `spRegistrarCompra` (in idCompraSucursal int,
 in idUsuario int(11))
BEGIN
	insert into compra(compraSucursalId,compraUsuarioId,compraEstado) 
	values(idCompraSucursal,idUsuario,2);
    
        select compraId from compra where  compraId = @@Identity;

END$$

DELIMITER ;



CREATE PROCEDURE spUpdateCompra(
     IN idPago int,
    in idProveedor int,
    in rucProveedor varchar(50),
    in direccionProveedor varchar(150),
    in correoProveedor varchar(150),
    in comentarioCompra varchar(250),
    in idMoneda int
)
BEGIN
    update compra
   set 
	compraPagoId = idPago,
    compraProveedorId = idProveedor,
    compraProveedorRuc  = rucProveedor,
    compraProveedorDireccion = direccionProveedor,
    compraProveedorCorreo = correoProveedor,
    compraComentario = comentarioCompra,
    compraMonedaId = idMoneda,
    compraFechaCreacion = now(),
    compraEstado = 1;
END //

DELIMITER ;





DELIMITER //
CREATE PROCEDURE setViewSales(in idCompra int)
BEGIN
	SELECT          
 c.compraId,   
 c.compraSucursalId,   
 c.compraPagoId,   
 c.compraProveedorId,   
 c.compraProveedorRuc,   
 c.compraProveedorDireccion,   
 c.compraProveedorCorreo,  	
 c.compraSubTotal,   
 c.compraIgv,   
 c.compraTotal,   
 c.compraComentario,   
 c.compraUsuarioId,   
 c.compraMonedaId,   
 c.compraFechaCreacion,   
 c.compraEstado,   
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
 prov.proveedorNombre
 FROM              
 compra c JOIN  
 sucursal s ON c.compraSucursalId = s.sucursalId JOIN  
 empresa e ON s.sucursalEmpresaId = e.empresaId  JOIN  
 compania comp ON e.empresaCompaniaId = comp.companiaId JOIN  
 usuario u ON c.compraUsuarioId = u.usuarioId  JOIN  
 rol r ON u.usuarioRolId = r.rolId  JOIN  
 pago p ON c.compraPagoId = p.pagoId  JOIN  
 moneda m ON c.compraMonedaId = m.monedaId  JOIN  
 proveedor prov ON c.compraProveedorId =  prov.proveedorId  
 WHERE  
 c.compraEstado=1  
 AND c.compraId = idCompra ;
END //
DELIMITER ;

select * from empresa
