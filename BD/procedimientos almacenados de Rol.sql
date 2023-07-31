/*Procedimiento Almacenado Listar rol*/
create  PROCEDURE `spListarRol`
(in idRolSucursal int)
  
 SELECT *
 FROM 
	rol  
 WHERE  
	 rolSucursalId = idRolSucursal
     and rolEstado=1; 

DELIMITER ;
-- Llamado del Store Procedure con argumento
call spListarrol(2) ;

/*Procedimiento Almacenado Listar por Id rol*/
CREATE  PROCEDURE `spListarRolporId`
 (in idRol int)
  
 SELECT *
 FROM 
	rol  
 WHERE  
	 rolId = idRol
     and rolEstado=1;
DELIMITER ;

/*Procedimiento Almacenado Eliminar rol*/
CREATE  PROCEDURE `spEliminarRol`
 (in idRol int)
  
 update
 rol 
 set rolEstado=0 
 WHERE  
	 rolId = idRol;
DELIMITER ;

/*Procedimiento Almacenado Registrar rol*/
CREATE  PROCEDURE `spRegistrarrol`  
 (in idRolSucursal int,
 nombreRol varchar(150))
 
insert into rol 
 (rolSucursalId,rolNombre,rolFechaCreacion,rolEstado) 
 values  
	 (idRolSucursal,nombreRol,now(),1);
DELIMITER ;


/*Procedimiento Almacenado Update rol*/
CREATE  PROCEDURE `spUpdateRol`  
 (in idRol int,
 idRolSucursal int,
 nombreRol varchar(150))

	update rol
    set 
		idRolSucursal = rolSucursalId,
        nombreRol = rolNombre
	where
		rolId = idRol;

DELIMITER ;
