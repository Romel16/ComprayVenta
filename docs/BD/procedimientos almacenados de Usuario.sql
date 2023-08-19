/*Procedimiento Almacenado Listar usuario*/
create  PROCEDURE `spListarUsuario`
(in idUsuarioSucursal int)
  
 SELECT *
 FROM 
	usuario  
 WHERE  
	 usuarioSucursald = idUsuarioSucursal
     and usuarioEstado=1; 

DELIMITER ;

-- Llamado del Store Procedure con argumento
call spListarusuario(2) ;

/*Procedimiento Almacenado Listar por Id usuario*/
CREATE  PROCEDURE `spListarUsuarioporId`
 (in idUsuario int)
  
 SELECT *
 FROM 
	usuario  
 WHERE  
	 usuarioId = idUsuario
     and usuarioEstado=1;
DELIMITER ;

/*Procedimiento Almacenado Eliminar usuario*/
CREATE  PROCEDURE `spEliminarUsuario`
 (in idUsuario int)
  
 update
 usuario 
 set usuarioEstado=0 
 WHERE  
	 usuarioId = idUsuario;
DELIMITER ;

/*Procedimiento Almacenado Registrar usuario*/
CREATE  PROCEDURE `spRegistrarUsuario`  
 (in idUsuarioSucursal int,
 idUsuarioRol int,
 correoUsuario varchar(150),
 nombreUsuario varchar(150),
 apellidoUsuario varchar(150),
 dniUsuario varchar(30),
 telefonoUsuario varchar(13),
 passwordUsuario varchar(150))
 
insert into usuario 
 (usuarioSucursalId,usuarioRolId,usuarioCorreo,usuarioNombre,usuarioApellido,usuarioDni,usuarioTelefono,usuarioPassword,usuarioFechaCreacion,usuarioEstado) 
 values  
	 (idUsuarioSucursal,idUsuarioRol,correoUsuario,nombreUsuario,apellidoUsuario,dniUsuario,telefonoUsuario,passwordUsuario,now(),1);
DELIMITER ;


/*Procedimiento Almacenado Update usuario*/
create  PROCEDURE `spUpdateUsuario`  
 (in idUsuario int,
 idUsuarioSucursal int,
  idUsuarioRol int,
 correoUsuario varchar(150),
 nombreUsuario varchar(150),
 apellidoUsuario varchar(150),
 dniUsuario varchar(30),
 telefonoUsuario varchar(13),
 passwordUsuario varchar(150))
 
	update usuario
    set 
		    usuarioSucursalId = idUsuarioSucursal,
        usuarioRolId = idUsuarioRol,
        usuarioCorreo = correoUsuario,
        usuarioNombre = nombreUsuario,
        usuarioApellido = apellidoUsuario,
        usuarioDni = dniUsuario,
        usuarioTelefono = telefonoUsuario,
        usuarioPassword = passwordUsuario
	where
		usuarioId = idUsuario;

DELIMITER ;

-- Acceso de usuario
create  PROCEDURE `spAccesoUsuario`
(in correoUsuario varchar(150),
 passwordUsuario varchar(150))
  
 SELECT *
 FROM 
	usuario  
 WHERE  
        usuarioCorreo = correoUsuario and
        usuarioPassword = passwordUsuario and
        usuarioEstado = 1
	
DELIMITER ;

-- Cambio Contraseña
create  PROCEDURE `spCambioContrasena`
(in idUsuario int,
 passwordUsuario varchar(150))
  
 update 
	usuario
    set
		usuarioPassword = passwordUsuario
    where
		usuarioId = idUsuario ;
    
DELIMITER ;


/*Listar usuario con sucursal, correo, pass especificos*/
create procedure `spListarLogin`
(in idUsuarioSucursal int,
in correoUsuario varchar(150),
in passwordUsuario varchar(150))
 

select u.usuarioId,u.usuarioSucursalId, u.usuarioRolId,u.usuarioCorreo,u.usuarioNombre,u.usuarioApellido,u.usuarioDni,
	u.usuarioTelefono,u.usuarioPassword, s.sucursalEmpresaId,s.sucursalNombre,e.empresaNombre,e.empresaRuc,
    e.empresaCompaniaId, c.companiaNombre    
from usuario u 
join	sucursal s on u.usuarioSucursalId = s.sucursalId
join 	empresa e on s.sucursalEmpresaId = e.empresaId
join 	compania c on e.empresaCompaniaId = c.companiaId
where u.usuarioSucursalId = idUsuarioSucursal
	and u.usuarioCorreo = correoUsuario
	and u.usuarioPassword = passwordUsuario
    and u.usuarioEstado=1;

Delimiter ;;
