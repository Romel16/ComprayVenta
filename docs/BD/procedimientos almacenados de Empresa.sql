/*Procedimiento Almacenado Listar empresa*/
create  PROCEDURE `spListarEmpresa`
  (IN IdCompania int)
 SELECT *
 FROM 
	empresa  
 WHERE  
      empresaCompaniaId = IdCompania
      and empresaEstado=1; 

DELIMITER ;
-- Llamado del Store Procedure con argumento
call spListarempresa(2) ;

/*Procedimiento Almacenado Listar por Id empresa*/
CREATE  PROCEDURE `spListarEmpresaporId`
 (in idEmpresa int)
  
 SELECT *
 FROM 
	empresa  
 WHERE  
	 empresaId = idEmpresa
     and empresaEstado=1;
DELIMITER ;

/*Procedimiento Almacenado Eliminar empresa*/
CREATE  PROCEDURE `spEliminarEmpresa`
 (in idEmpresa int)
  
 update
 empresa 
 set empresaEstado=0 
 WHERE  
	 empresaId = idEmpresa;
DELIMITER ;

/*Procedimiento Almacenado Registrar empresa*/
CREATE  PROCEDURE `spRegistrarEmpresa`  
 (in idCompaniaEmpresa int,
  nombreEmpresa varchar(150),
  rucEmpresa varchar(10))
 
insert into empresa 
 (empresaCompaniaId, empresaNombre,empresaRuc,empresaFechaCreacion,empresaEstado) 
 values  
	 (idCompaniaEmpresa,nombreEmpresa,rucEmpresa,now(),1);
DELIMITER ;


/*Procedimiento Almacenado Update empresa*/
CREATE  PROCEDURE `spUpdateEmpresa`  
 (in idEmpresa int,
 idCompaniaEmpresa int,
 nombreEmpresa varchar(150),
  rucEmpresa varchar(10))

	update empresa
    set 
		idCompaniaEmpresa = empresaCompaniaId,
		nombreEmpresa = empresaNombre,
        rucEmpresa = empresaRuc
	where
		empresaId = idempresa;

DELIMITER ;
