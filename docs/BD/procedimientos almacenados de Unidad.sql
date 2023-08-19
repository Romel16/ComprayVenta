/*Procedimiento Almacenado Listar unidad*/
create  PROCEDURE `spListarUnidad`
(in idUnidadSucursal int)
  
 SELECT unidadId, unidadNombre, date_format(unidadFechaCreacion,"%d-%m-%y") as unidadFechaCreacion,
	unidadEstado
 FROM 
	unidad  
 WHERE  
	 unidadSucursalId = idUnidadSucursal
     and unidadEstado=1; 

DELIMITER ;
-- Llamado del Store Procedure con argumento
call spListarUnidad(2) ;

/*Procedimiento Almacenado Listar por Id unidad*/
CREATE  PROCEDURE `spListarUnidadporId`
 (in idUnidad int)
  
 SELECT *
 FROM 
	unidad  
 WHERE  
	 unidadId = idUnidad
     and unidadEstado=1;
DELIMITER ;

/*Procedimiento Almacenado Eliminar unidad*/
CREATE  PROCEDURE `spEliminarUnidad`
 (in idUnidad int)
  
 update
 unidad 
 set unidadEstado=0 
 WHERE  
	 unidadId = idUnidad;
DELIMITER ;

/*Procedimiento Almacenado Registrar unidad*/
CREATE  PROCEDURE `spRegistrarUnidad`  
 (in idUnidadSucursal int,
 nombreUnidad varchar(150))
 
insert into unidad 
 (unidadSucursalId,unidadNombre,unidadFechaCreacion,unidadEstado) 
 values  
	 (idUnidadSucursal,nombreUnidad,now(),1);
DELIMITER ;


/*Procedimiento Almacenado Update unidad*/
create  PROCEDURE `spUpdateUnidad`  
 (in idUnidad int,
 idUnidadSucursal int,
 nombreUnidad varchar(150))

	update unidad
    set 
		unidadSucursalId = idUnidadSucursal,
        unidadNombre = nombreUnidad 
	where
		unidadId = idUnidad;

DELIMITER ;
