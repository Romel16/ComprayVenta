/*Procedimiento Almacenado Listar Categoria*/

/*
DELIMITER $$
USE `comprayventa`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarCategoria`(in idCategoriaSucursal int)
SELECT categoriaId,categoriaSucursalId,categoriaNombre, 
date_format(categoriaFechaCreacion,"%d-%m-%y") as categoriaFechaCreacion,
categoriaEstado
 FROM 
	categoria  
 WHERE  
	 categoriaSucursalId = idCategoriaSucursal
     and categoriaEstado=1$$

DELIMITER ;
*/

create  PROCEDURE `spListarCategoria`
(in idCategoriaSucursal int)
  
 SELECT categoriaId,categoriaSucursalId,categoriaNombre, 
date_format(categoriaFechaCreacion,"%d-%m-%y") as categoriaFechaCreacion,
categoriaEstado
FROM 
	categoria  
 WHERE  
	 categoriaSucursalId = idCategoriaSucursal
     and categoriaEstado=1; 

DELIMITER ;
-- Llamado del Store Procedure con argumento
call spListarCategoria(2) ;

/*Procedimiento Almacenado Listar por Id Categoria*/
CREATE  PROCEDURE `spListarCategoriaporId`
 (in idCategoria int)
  
 SELECT *
 FROM 
	categoria  
 WHERE  
	 categoriaId = idCategoria
     and categoriaEstado=1;
DELIMITER ;

/*Procedimiento Almacenado Eliminar Categoria*/
CREATE  PROCEDURE `spEliminarCategoria`
 (in idCategoria int)
  
 update
 categoria 
 set categoriaEstado=0 
 WHERE  
	 categoriaId = idCategoria;
DELIMITER ;

/*Procedimiento Almacenado Registrar Categoria*/
CREATE  PROCEDURE `spRegistrarCategoria`  
 (in idCategoriaSucursal int,
 nombreCategoria varchar(150))
 
insert into categoria 
 (categoriaSucursalId,categoriaNombre,categoriaFechaCreacion,categoriaEstado) 
 values  
	 (idCategoriaSucursal,nombreCategoria,now(),1);
DELIMITER ;


/*Procedimiento Almacenado Update Categoria*/
CREATE  PROCEDURE `spUpdateCategoria`  
 (in idCategoria int,
 idCategoriaSucursal int,
 nombreCategoria varchar(150))

	update categoria
    set 
		categoriaSucursalId = idCategoriaSucursal,
        categoriaNombre = nombreCategoria
	where
		categoriaId = idCategoria;

DELIMITER ;
/*
DELIMITER $$
USE `comprayventa`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateCategoria`(in idCategoria int,
 idCategoriaSucursal int,
 nombreCategoria varchar(150))
update categoria
    set 
		categoriaSucursalId = idCategoriaSucursal,
        categoriaNombre = nombreCategoria
	where
		categoriaId = idCategoria$$

DELIMITER ;
*/