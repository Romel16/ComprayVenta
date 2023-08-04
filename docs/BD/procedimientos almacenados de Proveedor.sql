/*Procedimiento Almacenado Listar proveedor*/
create  PROCEDURE `spListarProveedor`
(in idProveedorEmpresa int)

 SELECT *
 FROM 
	proveedor  
 WHERE  
	 proveedorEmpresaId = idProveedorEmpresa
     and proveedorEstado=1; 

DELIMITER ;

-- Llamado del Store Procedure con argumento
call spListarproveedor(2) ;

/*Procedimiento Almacenado Listar por Id proveedor*/
CREATE  PROCEDURE `spListarProveedorporId`
 (in idProveedor int)
  
 SELECT *
 FROM 
	proveedor  
 WHERE  
	 proveedorId = idProveedor
     and proveedorEstado=1;
DELIMITER ;

/*Procedimiento Almacenado Eliminar proveedor*/
CREATE  PROCEDURE `spEliminarProveedor`
 (in idProveedor int)
  
 update
 proveedor 
 set proveedorEstado=0 
 WHERE  
	 proveedorId = idProveedor;
DELIMITER ;

/*Procedimiento Almacenado Registrar proveedor*/
CREATE  PROCEDURE `spRegistrarProveedor`  
 (in idProveedorEmpresa int,
 nombreProveedor varchar(150),
 rucProveedor varchar(150),
 telefonoProveedor varchar(12),
 direccionProveedor varchar(150),
 corrreoProveedor varchar(150))
 
insert into proveedor 
 (proveedorEmpresaId,proveedorNombre,proveedorRuc,proveedorTelefono,proveedorDireccion,proveedorCorreo,proveedorFechaCreacion,proveedorEstado) 
 values  
	 (idProveedorEmpresa,nombreProveedor,rucProveedor,telefonoProveedor,direccionProveedor,corrreoProveedor,now(),1);
DELIMITER ;


/*Procedimiento Almacenado Update proveedor*/
CREATE  PROCEDURE `spUpdateProveedor`  
 (in idProveedor int,
 idProveedorEmpresa int,
 nombreProveedor varchar(150),
 rucProveedor varchar(150),
 telefonoProveedor varchar(12),
 direccionProveedor varchar(150),
 corrreoProveedor varchar(150))
 
	update proveedor
    set 
		proveedorEmpresaId = idProveedorEmpresa,
        proveedorNombre= nombreProveedor,
        proveedorRuc = rucProveedor,
        proveedorTelefono = telefonoProveedor,
        proveedorDireccion = direccionProveedor,
        proveedorCorreo = corrreoProveedor
	where
		proveedorId = idProveedor;

DELIMITER ;
