/*Procedimiento Almacenado Listar moneda*/
create  PROCEDURE `spListarMoneda`
(in idMonedaSucursal int)
  
 SELECT *
 FROM 
	moneda  
 WHERE  
	 monedaSucursalId = idMonedaSucursal
     and monedaEstado=1; 

DELIMITER ;
-- Llamado del Store Procedure con argumento
call spListarmoneda(2) ;

/*Procedimiento Almacenado Listar por Id moneda*/
CREATE  PROCEDURE `spListarMonedaporId`
 (in idMoneda int)
  
 SELECT *
 FROM 
	moneda  
 WHERE  
	 monedaId = idMoneda
     and monedaEstado=1;
DELIMITER ;

/*Procedimiento Almacenado Eliminar moneda*/
CREATE  PROCEDURE `spEliminarMoneda`
 (in idMoneda int)
  
 update
 moneda 
 set monedaEstado=0 
 WHERE  
	 monedaId = idMoneda;
DELIMITER ;

/*Procedimiento Almacenado Registrar moneda*/
CREATE  PROCEDURE `spRegistrarMoneda`  
 (in idMonedaSucursal int,
 nombreMoneda varchar(150))
 
insert into moneda 
 (monedaSucursalId,monedaNombre,monedaFechaCreacion,monedaEstado) 
 values  
	 (idMonedaSucursal,nombreMoneda,now(),1);
DELIMITER ;


/*Procedimiento Almacenado Update moneda*/
CREATE  PROCEDURE `spUpdateMoneda`  
 (in idMoneda int,
 idMonedaSucursal int,
 nombreMoneda varchar(150))

	update moneda
    set 
		idMonedaSucursal = monedaSucursalId,
        nombreMoneda = monedaNombre
	where
		monedaId = idMoneda;

DELIMITER ;
