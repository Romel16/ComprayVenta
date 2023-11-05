/*Procedimiento Almacenado Listar Menu*/

/*
DELIMITER $$
USE `comprayventa`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarMenu`(in idMenuSucursal int)
SELECT menuId,menuSucursalId,menuNombre, 
date_format(menuFechaCreacion,"%d-%m-%y") as menuFechaCreacion,
menuEstado
 FROM 
	menu  
 WHERE  
	 menuSucursalId = idMenuSucursal
     and menuEstado=1$$

DELIMITER ;
*/

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarMenu`(in idRolMenuDetalle int)
SELECT dm.detallemenuId,dm.detallemenuMenuId,dm.detallemenuRolId,dm.detallemenuPermiso, 
date_format(dm.detallemenuFechaCreacion,"%d-%m-%y") as detallemenuFechaCreacion,dm.detallemenuEstado,
m.menuNombre, m.MenuRuta, m.menuIdentificacion, m.menuGrupo
FROM 
	detallemenu dm inner join menu m on dm.detallemenuMenuId = m.menuId
WHERE  
	 dm.detallemenuRolId = idRolMenuDetalle
-- Llamado del Store Procedure con argumento
call spListarMenu(2) ;

/*Procedimiento Almacenado */

DELIMITER $$
CREATE PROCEDURE spUpdateMenuSi
(in iddetalleMenu INT)

UPDATE detallemenu 
	SET
		detallemenuPermiso = 'Si'
	WHERE
		detallemenuId = iddetalleMenu$$

DELIMITER ;


DELIMITER $$
CREATE PROCEDURE spUpdateMenuNo
(in iddetalleMenu INT)

UPDATE detallemenu 
	SET
		detallemenuPermiso = 'No'
	WHERE
		detallemenuId = iddetalleMenu$$

DELIMITER ;

/*
DELIMITER $$
USE `comprayventa`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateMenu`(in idMenu int,
 idMenuSucursal int,
 nombreMenu varchar(150))
update menu
    set 
		menuSucursalId = idMenuSucursal,
        menuNombre = nombreMenu
	where
		menuId = idMenu$$

DELIMITER ;
*/

DELIMITER //
CREATE PROCEDURE spListaMenuAcceso (
in idusuario int, 
identificacionMenu varchar(250))
BEGIN
   select 
   dm.detallemenuId,
   dm.detallemenuMenuId,
   dm.detallemenuRolId,
   dm.detallemenuPermiso,
   dm.detallemenuFechacreacion,
   dm.detallemenuEstado,
   m.menuNombre,
   m.menuRuta,
   m.menuIdentificacion,
   m.menuGrupo,
   u.usuarioId,
   r.rolNombre
   from
   detallemenu dm
   join menu m on dm.detallemenuMenuId = m.menuId
   join rol r on dm.detallemenuRolId = r.rolId
   join usuario u on u.r.rolId = u.usuarioRolId
   where u.usuario = 1
   and dm.detallemenuPermiso = 'Si'
   and m.menuIdentificacion = 'mntsucursal';
END //
DELIMITER ;
