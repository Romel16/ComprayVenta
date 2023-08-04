/*Procedimiento Almacenado Listar Compania*/
create  PROCEDURE `spListarCompania`
  ()
 SELECT *
 FROM 
	compania  
 WHERE  
      companiaEstado=1; 

DELIMITER ;
-- Llamado del Store Procedure con argumento
call spListarCompania(2) ;

/*Procedimiento Almacenado Listar por Id Compania*/
CREATE  PROCEDURE `spListarCompaniaporId`
 (in idCompania int)
  
 SELECT *
 FROM 
	compania  
 WHERE  
	 companiaId = idCompania
     and companiaEstado=1;
DELIMITER ;

/*Procedimiento Almacenado Eliminar Compania*/
CREATE  PROCEDURE `spEliminarCompania`
 (in idCompania int)
  
 update
 compania 
 set companiaEstado=0 
 WHERE  
	 companiaId = idCompania;
DELIMITER ;

/*Procedimiento Almacenado Registrar Compania*/
CREATE  PROCEDURE `spRegistrarCompania`  
 (in nombreCompania varchar(150))
 
insert into compania 
 (companiaNombre,companiaFechaCreacion,companiaEstado) 
 values  
	 (nombreCompania,now(),1);
DELIMITER ;


/*Procedimiento Almacenado Update Compania*/
CREATE  PROCEDURE `spUpdateCompania`  
 (in idCompania int,
 nombreCompania varchar(150))

	update compania
    set 
		nombreCompania = companiaNombre
	where
		companiaId = idCompania;

DELIMITER ;
