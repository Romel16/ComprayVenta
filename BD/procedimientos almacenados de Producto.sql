/*Procedimiento Almacenado Listar producto*/
create  PROCEDURE `spListarProducto`
(in idProductoSucursal int)
  
 SELECT *
 FROM 
	producto  
 WHERE  
	 productoSucursalId = idProductoSucursal
     and productoEstado=1; 

DELIMITER ;
-- Llamado del Store Procedure con argumento
call spListarProducto(2) ;

/*Procedimiento Almacenado Listar por Id producto*/
CREATE  PROCEDURE `spListarProductoporId`
 (in idProducto int)
  
 SELECT *
 FROM 
	producto  
 WHERE  
	 productoId = idProducto
     and productoEstado=1;
DELIMITER ;

/*Procedimiento Almacenado Eliminar producto*/
CREATE  PROCEDURE `spEliminarProducto`
 (in idproducto int)
  
 update
 producto 
 set productoEstado=0 
 WHERE  
	 productoId = idProducto;
DELIMITER ;

/*Procedimiento Almacenado Registrar producto*/
CREATE  PROCEDURE `spRegistrarProducto`  
 (in idProductoSucursal int,
 idProductoCategoria int,
 nombreProducto varchar(150),
 descripcionProducto varchar(150),
 idProductoMoneda int,
 idProductoUnidad int,
 precioCompraProducto decimal(9,2),
 precioVentaProducto decimal(9,2),
 stockProducto int,
 imagenProducto blob,
 fechaVentaProducto date)
 
insert into producto 
 (productoSucursalId,productoCategoriaId,productoNombre,productoDescripcion,productoMonedaId,productoUnidadId,productoPrecioCompra,productoPrecioVenta,productoStock,productoFechaVenta,productoImagen,productoFechaCreacion,productoEstado) 
 values  
	 (idProductoSucursal,idProductoCategoria,nombreProducto,descripcionProducto,idProductoMoneda,idProductoUnidad,precioCompraProducto,precioVentaProducto,stockProducto,fechaVentaProducto,imagenProducto,now(),1);
DELIMITER ;


/*Procedimiento Almacenado Update producto*/
CREATE  PROCEDURE `spUpdateProducto`  
 (in idProducto int,
  idProductoSucursal int,
 idProductoCategoria int,
 nombreProducto varchar(150),
 descripcionProducto varchar(150),
 idProductoMoneda int,
 idProductoUnidad int,
 precioCompraProducto decimal(9,2),
 precioVentaProducto decimal(9,2),
 stockProducto int,
 imagenProducto blob,
 fechaVentaProducto date)
	update producto
    set 
		productoSucursalId = idProductoSucursal,
        productoCategoriaId= idProductoCategoria,
        productoNombre = nombreProducto,
        productoDescripcion = descripcionProducto,
        productoMonedaId = idProductoMoneda,
        productoUnidadId = idProductoUnidad,
        productoPrecioCompra = precioCompraProducto,
        productoPrecioVenta = precioVentaProducto,
        productoStock = stockProducto,
        productoFechaVenta = fechaVentaProducto,
        productoImagen = imagenProducto
	where
		productoId = idProducto;

DELIMITER ;
