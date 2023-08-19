/*Procedimiento Almacenado Listar cliente*/
create  PROCEDURE `spListarCliente`
(in idClienteEmpresa int)
  
 SELECT clienteId, clienteNombre,clienteRuc,clienteTelefono,clienteDireccion,clienteCorreo,
date_format(clienteFechaCreacion,"%d-%m-%y") as clienteFechaCreacion
 FROM 
	proveedor  
 WHERE  
	 clienteEmpresalId = idClienteEmpresa
     and clienteEstado=1; 

DELIMITER ;

-- Llamado del Store Procedure con argumento
call spListarcliente(2) ;

/*Procedimiento Almacenado Listar por Id cliente*/
CREATE  PROCEDURE `spListarClienteporId`
 (in idCliente int)
  
 SELECT *
 FROM 
	cliente  
 WHERE  
	 clienteId = idCliente
     and clienteEstado=1;
DELIMITER ;

/*Procedimiento Almacenado Eliminar cliente*/
CREATE  PROCEDURE `spEliminarCliente`
 (in idCliente int)
  
 update
 cliente 
 set clienteEstado=0 
 WHERE  
	 clienteId = idCliente;
DELIMITER ;

/*Procedimiento Almacenado Registrar cliente*/
CREATE  PROCEDURE `spRegistrarCliente`  
 (in idClienteEmpresa int,
 nombrecliente varchar(150),
 rucCliente varchar(150),
 telefonoCliente varchar(12),
 direccionCliente varchar(150),
 corrreoCliente varchar(150))
 
insert into cliente 
 (clienteEmpresaId,clienteNombre,clienteRuc,clienteTelefono,clienteDireccion,clienteCorreo,clienteFechaCreacion,clienteEstado) 
 values  
	 (idClienteEmpresa,nombrecliente,rucCliente,telefonoCliente,direccionCliente,corrreoCliente,now(),1);
DELIMITER ;


/*Procedimiento Almacenado Update cliente*/
CREATE  PROCEDURE `spUpdateCliente`  
 (in idCliente int,
 idClienteEmpresa int,
 nombreCliente varchar(150),
 rucCliente varchar(150),
 telefonoCliente varchar(12),
 direccionCliente varchar(150),
 corrreoCliente varchar(150))
 
	update cliente
    set 
		clienteEmpresaId = idClienteEmpresa,
        clienteNombre= nombreCliente,
        clienteRuc = rucCliente,
        clienteTelefono = telefonoCliente,
        clienteDireccion = direccionCliente,
        clienteCorreo = corrreoCliente
	where
		clienteId = idCliente;

DELIMITER ;
