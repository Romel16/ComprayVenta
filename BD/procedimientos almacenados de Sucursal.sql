/*Procedimiento Almacenado Listar sucursal*/
create  PROCEDURE `spListarSucursal`
(in idSucursalEmpresa int)
  
 SELECT *
 FROM 
	sucursal  
 WHERE  
	 sucursalEmpresaId = idSucursalEmpresa
     and sucursalEstado=1; 

DELIMITER ;

-- Llamado del Store Procedure con argumento
call spListarsucursal(2) ;

/*Procedimiento Almacenado Listar por Id sucursal*/
CREATE  PROCEDURE `spListarSucursalporId`
 (in idSucursal int)
  
 SELECT *
 FROM 
	sucursal  
 WHERE  
	 sucursalId = idSucursal
     and sucursalEstado=1;
DELIMITER ;

/*Procedimiento Almacenado Eliminar sucursal*/
CREATE  PROCEDURE `spEliminarSucursal`
 (in idSucursal int)
  
 update
 sucursal 
 set sucursalEstado=0 
 WHERE  
	 sucursalId = idSucursal;
DELIMITER ;

/*Procedimiento Almacenado Registrar sucursal*/
CREATE  PROCEDURE `spRegistrarSucursal`  
 (in idSucursalEmpresa int,
 nombreSucursal varchar(150))
 
insert into sucursal 
 (sucursalEmpresaId,sucursalNombre,sucursalFechaCreacion,sucursalEstado) 
 values  
	 (idSucursalEmpresa,nombreSucursal,now(),1);
DELIMITER ;


/*Procedimiento Almacenado Update sucursal*/
create  PROCEDURE `spUpdateSucursal`  
 (in idSucursal int,
 idSucursalEmpresa int,
 nombreSucursal varchar(150))

	update sucursal
    set 
		sucursalEmpresaId = idSucursalEmpresa,
        sucursalNombre = nombreSucursal 
	where
		sucursalId = idSucursal;

DELIMITER ;
