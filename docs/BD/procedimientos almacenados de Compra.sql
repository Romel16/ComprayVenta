CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarCompra`(in idCompraSucursal int,
 idUsuario int(11))
insert into compra 
 (compraSucursalId,compraUsuarioId,compraEstado) 
 values  
	 (idCompraSucursal,idUsuario,2)
	