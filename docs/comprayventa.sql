-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2023 a las 22:11:43
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comprayventa`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ListCompra` (IN `idSucursal` INT)   BEGIN
	SELECT          
 c.compraId,   
 c.compraSucursalId,   
 c.compraPagoId,   
 c.compraProveedorId,   
 c.compraSubTotal,   
 c.compraIgv,   
 c.compraTotal,   
 c.compraComentario,   
 c.compraUsuarioId,   
 c.compraMonedaId,   
 c.compraFechaCreacion,   
 c.compraEstado,   
 s.sucursalNombre,   
 e.empresaNombre,   
 e.empresaRuc,   
 e.empresaCorreo,   
 e.empresaTelefono,   
 e.empresaDireccion,   
 e.empresaPagina,   
 comp.companiaNombre,   
 u.usuarioCorreo,   
 u.usuarioNombre,   
 u.usuarioApellido,   
 u.usuarioDni,   
 u.usuarioTelefono,   
 r.rolNombre,   
 p.pagoNombre,   
 m.monedaNombre,  
 prov.proveedorRuc,
 prov.proveedorNombre
 FROM              
 compra c JOIN  
 sucursal s ON c.compraSucursalId = s.sucursalId JOIN  
 empresa e ON s.sucursalEmpresaId = e.empresaId  JOIN  
 compania comp ON e.empresaCompaniaId = comp.companiaId JOIN  
 usuario u ON c.compraUsuarioId = u.usuarioId  JOIN  
 rol r ON u.usuarioRolId = r.rolId  JOIN  
 pago p ON c.compraPagoId = p.pagoId  JOIN  
 moneda m ON c.compraMonedaId = m.monedaId  JOIN  
 proveedor prov ON c.compraProveedorId =  prov.proveedorId  
 WHERE  
 c.compraEstado=1  
 AND c.compraSucursalId = idSucursal ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ListVenta` (IN `idSucursal` INT)   BEGIN
	 SELECT          
 v.ventaId,   
 v.ventaSucursalId,   
 v.ventaPagoId,   
 v.ventaClienteId,   
 v.ventaSubTotal,   
 v.ventaIgv,   
 v.ventaTotal,   
 v.ventaComentario,   
 v.ventaUsuarioId,   
 v.ventaMonedaId,   
 v.ventaFechaCreacion,   
 v.ventaEstado,   
 s.sucursalNombre,   
 e.empresaNombre,   
 e.empresaRuc,   
 e.empresaCorreo,   
 e.empresaTelefono,   
 e.empresaDireccion,   
 e.empresaPagina,   
 comp.companiaNombre,   
 u.usuarioCorreo,   
 u.usuarioNombre,   
 u.usuarioApellido,   
 u.usuarioDni,   
 u.usuarioTelefono,   
 r.rolNombre,   
 p.pagoNombre,   
 m.monedaNombre,  
 c.clienteRuc,
 c.clienteNombre
 FROM              
 venta v JOIN  
 sucursal s ON v.ventaSucursalId = s.sucursalId JOIN  
 empresa e ON s.sucursalEmpresaId = e.empresaId  JOIN  
 compania comp ON e.empresaCompaniaId = comp.companiaId JOIN  
 usuario u ON v.ventaUsuarioId = u.usuarioId  JOIN  
 rol r ON u.usuarioRolId = r.rolId  JOIN  
 pago p ON v.ventaPagoId = p.pagoId  JOIN  
 moneda m ON v.ventaMonedaId = m.monedaId  JOIN  
 cliente c on v.ventaClienteId = c.clienteId
 WHERE  
 v.ventaEstado=1  
 and v.ventaSucursalId = idSucursal ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setViewBuys` (IN `idCompra` INT)   BEGIN
	SELECT          
 c.compraId,   
 c.compraSucursalId,   
 c.compraPagoId,   
 c.compraProveedorId,   
 c.compraProveedorRuc,   
 c.compraProveedorDireccion,   
 c.compraProveedorCorreo,  	
 c.compraSubTotal,   
 c.compraIgv,   
 c.compraTotal,   
 c.compraComentario,   
 c.compraUsuarioId,   
 c.compraMonedaId,   
 c.compraFechaCreacion,   
 c.compraEstado,   
 s.sucursalNombre,   
 e.empresaNombre,   
 e.empresaRuc,   
 e.empresaCorreo,   
 e.empresaTelefono,   
 e.empresaDireccion,   
 e.empresaPagina,   
 comp.companiaNombre,   
 u.usuarioCorreo,   
 u.usuarioNombre,   
 u.usuarioApellido,   
 u.usuarioDni,   
 u.usuarioTelefono,   
 r.rolNombre,   
 p.pagoNombre,   
 m.monedaNombre,  
 prov.proveedorNombre
 FROM              
 compra c JOIN  
 sucursal s ON c.compraSucursalId = s.sucursalId JOIN  
 empresa e ON s.sucursalEmpresaId = e.empresaId  JOIN  
 compania comp ON e.empresaCompaniaId = comp.companiaId JOIN  
 usuario u ON c.compraUsuarioId = u.usuarioId  JOIN  
 rol r ON u.usuarioRolId = r.rolId  JOIN  
 pago p ON c.compraPagoId = p.pagoId  JOIN  
 moneda m ON c.compraMonedaId = m.monedaId  JOIN  
 proveedor prov ON c.compraProveedorId =  prov.proveedorId  
 WHERE  
 c.compraEstado=1  
 AND c.compraId = idCompra ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setViewSales` (IN `idVenta` INT)   BEGIN
	SELECT          
 v.ventaId,   
 v.ventaSucursalId,   
 v.ventaPagoId,   
 v.ventaClienteId,   
 v.ventaClienteRuc,   
 v.ventaClienteDireccion,   
 v.ventaClienteCorreo,  	
 v.ventaSubTotal,   
 v.ventaIgv,   
 v.ventaTotal,   
 v.ventaComentario,   
 v.ventaUsuarioId,   
 v.ventaMonedaId,   
 v.ventaFechaCreacion,   
 v.ventaEstado,   
 s.sucursalNombre,   
 e.empresaNombre,   
 e.empresaRuc,   
 e.empresaCorreo,   
 e.empresaTelefono,   
 e.empresaDireccion,   
 e.empresaPagina,   
 comp.companiaNombre,   
 u.usuarioCorreo,   
 u.usuarioNombre,   
 u.usuarioApellido,   
 u.usuarioDni,   
 u.usuarioTelefono,   
 r.rolNombre,   
 p.pagoNombre,   
 m.monedaNombre,  
 c.clienteNombre
 FROM              
 venta v JOIN  
 sucursal s ON v.ventaSucursalId = s.sucursalId JOIN  
 empresa e ON s.sucursalEmpresaId = e.empresaId  JOIN  
 compania comp ON e.empresaCompaniaId = comp.companiaId JOIN  
 usuario u ON v.ventaUsuarioId = u.usuarioId  JOIN  
 rol r ON u.usuarioRolId = r.rolId  JOIN  
 pago p ON v.ventaPagoId = p.pagoId  JOIN  
 moneda m ON v.ventaMonedaId = m.monedaId  JOIN  
 cliente c ON v.ventaClienteId =  c.clienteId  
 WHERE  
 v.ventaEstado=1  
 AND v.ventaId = idVenta ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spAccesoUsuario` (IN `correoUsuario` VARCHAR(150), `passwordUsuario` VARCHAR(150))   SELECT *
 FROM 
	usuario  
 WHERE  
        usuarioCorreo = correoUsuario and
        usuarioPassword = passwordUsuario and
        usuarioEstado = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spCambioContrasena` (IN `idUsuario` INT, `passwordUsuario` VARCHAR(150))   update 
	usuario
    set
		usuarioPassword = passwordUsuario
    where
		usuarioId = idUsuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarCategoria` (IN `idCategoria` INT)   update
 categoria 
 set categoriaEstado=0 
 WHERE  
	 categoriaId = idCategoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarCliente` (IN `idCliente` INT)   update
 cliente 
 set clienteEstado=0 
 WHERE  
	 clienteId = idCliente$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarCompania` (IN `idCompania` INT)   update
 compania 
 set companiaEstado=0 
 WHERE  
	 companiaId = idCompania$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarDetalleCompra` (IN `idDetalleCompra` INT)   BEGIN
   update detallecompra
   set 
	detallecompraEstado = 0
    where 
		detallecompraId = idDetalleCompra ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarDetalleVenta` (IN `idDetalleVenta` INT)   BEGIN
update detalleventa
   set 
	detalleventaEstado = 0
    where 
		detalleventaId = idDetalleVenta ;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarEmpresa` (IN `idEmpresa` INT)   update
 empresa 
 set empresaEstado=0 
 WHERE  
	 empresaId = idEmpresa$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarMoneda` (IN `idMoneda` INT)   update
 moneda 
 set monedaEstado=0 
 WHERE  
	 monedaId = idMoneda$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarProducto` (IN `idproducto` INT)   update
 producto 
 set productoEstado=0 
 WHERE  
	 productoId = idProducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarProveedor` (IN `idProveedor` INT)   update
 proveedor 
 set proveedorEstado=0 
 WHERE  
	 proveedorId = idProveedor$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarRol` (IN `idRol` INT)   update
 rol 
 set rolEstado=0 
 WHERE  
	 rolId = idRol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarSucursal` (IN `idSucursal` INT)   update
 sucursal 
 set sucursalEstado=0 
 WHERE  
	 sucursalId = idSucursal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarUnidad` (IN `idUnidad` INT)   update
 unidad 
 set unidadEstado=0 
 WHERE  
	 unidadId = idUnidad$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spEliminarUsuario` (IN `idUsuario` INT)   update
 usuario 
 set usuarioEstado=0 
 WHERE  
	 usuarioId = idUsuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarCategoria` (IN `idCategoriaSucursal` INT)   SELECT categoriaId,categoriaNombre, 
date_format(categoriaFechaCreacion,"%d-%m-%y") as categoriaFechaCreacion,
categoriaEstado
 FROM 
	categoria  
 WHERE  
	 categoriaSucursalId = idCategoriaSucursal
     and categoriaEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarCategoriaporId` (IN `idCategoria` INT)   SELECT *
 FROM 
	categoria  
 WHERE  
	 categoriaId = idCategoria
     and categoriaEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarCliente` (IN `idClienteEmpresa` INT)   SELECT clienteId, clienteNombre,clienteRuc,clienteTelefono,clienteDireccion,clienteCorreo,
date_format(clienteFechaCreacion,"%d-%m-%y") as clienteFechaCreacion
 FROM 
	cliente  
 WHERE  
	 clienteEmpresaId = idClienteEmpresa
     and clienteEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarClienteporId` (IN `idCliente` INT)   SELECT *
 FROM 
	cliente  
 WHERE  
	 clienteId = idCliente
     and clienteEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarCompania` ()   SELECT companiaId, companiaNombre, 
date_format(companiaFechaCreacion,"%d-%m-%y") as companiaFechaCreacion, companiaEstado
 FROM 
	compania  
 WHERE  
      companiaEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarCompaniaporId` (IN `idCompania` INT)   SELECT *
 FROM 
	compania  
 WHERE  
	 companiaId = idCompania
     and companiaEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarDetalleCompra` (IN `idCompra` INT)   BEGIN
   select dc.detallecompraId, c.categoriaNombre, p.productoNombre, u.unidadNombre, dc.detallecompraProductoPrecioCompra,
dc.detallecompraCantidad, dc.detallecompraTotal, dc.detallecompraCompraId, dc.detallecompraProductoId
from detallecompra dc
join producto p on dc.detallecompraProductoId = p.productoId
join categoria c on p.productoCategoriaId = c.categoriaId
join unidad u on p.productoUnidadId = u.unidadId
where dc.detallecompraCompraId = idCompra
and dc.detallecompraEstado = 1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarDetalleVenta` (IN `idVenta` INT)   BEGIN
select dv.detalleventaId, c.categoriaNombre, p.productoNombre, u.unidadNombre, dv.detalleventaProductoPrecioVenta,
dv.detalleventaCantidad, dv.detalleventaTotal, dv.detalleventaVentaId, dv.detalleventaProductoId
from detalleventa dv
join producto p on dv.detalleventaProductoId = p.productoId
join categoria c on p.productoCategoriaId = c.categoriaId
join unidad u on p.productoUnidadId = u.unidadId
where dv.detalleventaVentaId = idVenta
and dv.detalleventaEstado = 1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarEmpresa` (`IdCompania` INT)   SELECT * FROM 
	empresa  
 WHERE  
      empresaCompaniaId = IdCompania
      and empresaEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarEmpresaporId` (IN `idEmpresa` INT)   SELECT *
 FROM 
	empresa  
 WHERE  
	 empresaId = idEmpresa
     and empresaEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarLogin` (IN `idUsuarioSucursal` INT, IN `correoUsuario` VARCHAR(150), IN `passwordUsuario` VARCHAR(150))   select 
u.usuarioId,
u.usuarioSucursalId, 
u.usuarioRolId,
u.usuarioCorreo,
u.usuarioNombre,
u.usuarioApellido,
u.usuarioDni,
u.usuarioTelefono,
u.usuarioPassword,
s.sucursalId, 
s.sucursalEmpresaId,
s.sucursalNombre,
e.empresaId,
e.empresaNombre,
e.empresaRuc,
e.empresaCompaniaId, 
c.companiaNombre,
r.rolId
from usuario u 
join sucursal s on u.usuarioSucursalId = s.sucursalId
join empresa e on s.sucursalEmpresaId = e.empresaId
join compania c on e.empresaCompaniaId = c.companiaId
join rol r on u.usuarioRolId = r.rolId
where u.usuarioSucursalId = idUsuarioSucursal
	and u.usuarioCorreo = correoUsuario
	and u.usuarioPassword = passwordUsuario
    and u.usuarioEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarMenu` (IN `idRolMenuDetalle` INT)   SELECT dm.detallemenuId,dm.detallemenuMenuId,dm.detallemenuRolId,dm.detallemenuPermiso, 
date_format(dm.detallemenuFechaCreacion,"%d-%m-%y") as detallemenuFechaCreacion,dm.detallemenuEstado,
m.menuNombre, m.menuRuta, m.menuIdentificacion, m.menuGrupo
FROM 
	detallemenu dm 
    inner join menu m on dm.detallemenuMenuId = m.menuId
WHERE  
	 dm.detallemenuRolId = idRolMenuDetalle$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarMoneda` (IN `idMonedaSucursal` INT)   SELECT monedaId,monedaSucursalId, monedaNombre,date_format(monedaFechaCreacion,"%d-%m-%y") as monedaFechaCreacion,
	monedaEstado
 FROM 
	moneda  
 WHERE  
	 monedaSucursalId = idMonedaSucursal
     and monedaEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarMonedaporId` (IN `idMoneda` INT)   SELECT *
 FROM 
	moneda  
 WHERE  
	 monedaId = idMoneda
     and monedaEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarPago` ()   SELECT pagoId, pagoNombre, 
date_format(pagoFechaCreacion,"%d-%m-%y") as pagoFechaCreacion
FROM 
	pago
WHERE  
	pagoEstado = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarProducto` (IN `idProductoSucursal` INT)   SELECT p.productoId,p.productoSucursalId, p.productoCategoriaId, p.productoNombre, p.productoDescripcion,
	p.productoUnidadId, p.productoMonedaId, p.productoPrecioCompra, p.productoPrecioVenta, p.productoStock,
    date_format(p.productoFechaCreacion,"%d-%m-%y") as productoFechaCreacion, 
    p.productoEstado,p.productoImagen ,c.categoriaNombre,
    u.unidadNombre, m.monedaNombre
 FROM 
	producto  p inner join
    categoria c on p.productoCategoriaId = c.categoriaId inner join
    unidad u on p.productoUnidadId = u.unidadId inner join
    moneda m on p.productoMonedaId = m.monedaId
 WHERE  
	 productoSucursalId = idProductoSucursal
     and productoEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarProductoporCategoria` (IN `idProductoCategoria` INT)   SELECT p.productoId,p.productoSucursalId, p.productoCategoriaId, p.productoNombre, p.productoDescripcion,
	p.productoUnidadId, p.productoMonedaId, p.productoPrecioCompra, p.productoPrecioVenta, p.productoStock,
	p.productoImagen,
    date_format(p.productoFechaCreacion,"%d-%m-%y") as productoFechaCreacion, 
    p.productoEstado, c.categoriaNombre,
    u.unidadNombre, m.monedaNombre
 FROM 
	producto  p inner join
    categoria c on p.productoCategoriaId = c.categoriaId inner join
    unidad u on p.productoUnidadId = u.unidadId inner join
    moneda m on p.productoMonedaId = m.monedaId
 WHERE  
	 productoCategoriaId = idProductoCategoria
     and productoEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarProductoporId` (IN `idProducto` INT)   SELECT p.productoId,p.productoSucursalId, p.productoCategoriaId, p.productoNombre, p.productoDescripcion,
	p.productoUnidadId, p.productoMonedaId, p.productoPrecioCompra,p.productoPrecioVenta,p.productoStock,
    p.productoImagen,
    date_format(p.productoFechaCreacion,"%d-%m-%y") as productoFechaCreacion, 
    p.productoEstado, c.categoriaNombre,
    u.unidadNombre, m.monedaNombre
 FROM 
	producto  p inner join
    categoria c on p.productoCategoriaId = c.categoriaId inner join
    unidad u on p.productoUnidadId = u.unidadId inner join
    moneda m on p.productoMonedaId = m.monedaId
 WHERE  
	 productoId = idProducto
     and productoEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarProveedor` (IN `idProveedorEmpresa` INT)   SELECT proveedorId, proveedorNombre, proveedorRuc, proveedorTelefono, proveedorDireccion,
proveedorCorreo,
 date_format(proveedorFechaCreacion,"%d-%m-%y") as proveedorFechaCreacion, proveedorEstado
 FROM 
	proveedor  
 WHERE  
	 proveedorEmpresaId = idProveedorEmpresa
     and proveedorEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarProveedorporId` (IN `idProveedor` INT)   SELECT *
 FROM 
	proveedor  
 WHERE  
	 proveedorId = idProveedor
     and proveedorEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarRol` (IN `idRolSucursal` INT)   SELECT rolId, rolSucursalId, rolNombre, 
date_format(rolFechaCreacion,"%d-%m-%y") as rolFechaCreacion
 FROM 
	rol  
 WHERE  
	 rolSucursalId = idRolSucursal
     and rolEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarRolporId` (IN `idRol` INT)   SELECT *
 FROM 
	rol  
 WHERE  
	 rolId = idRol
     and rolEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarSucursal` (IN `idSucursalEmpresa` INT)   SELECT sucursalId, sucursalNombre, 
date_format(sucursalFechaCreacion,"%d-%m-%y") as sucursalFechaCreacion, sucursalEstado
 FROM 
	sucursal  
 WHERE  
	 sucursalEmpresaId = idSucursalEmpresa
     and sucursalEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarSucursalporId` (IN `idSucursal` INT)   SELECT *
 FROM 
	sucursal  
 WHERE  
	 sucursalId = idSucursal
     and sucursalEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarUnidad` (IN `idUnidadSucursal` INT)   SELECT unidadId, unidadNombre, date_format(unidadFechaCreacion,"%d-%m-%y") as unidadFechaCreacion,
	unidadEstado
 FROM 
	unidad  
 WHERE  
	 unidadSucursalId = idUnidadSucursal
     and unidadEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarUnidadporId` (IN `idUnidad` INT)   SELECT *
 FROM 
	unidad  
 WHERE  
	 unidadId = idUnidad
     and unidadEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarUsuario` (IN `idUsuarioSucursal` INT)   SELECT u.usuarioId, u.usuarioSucursalId,u.usuarioCorreo,u.usuarioNombre, u.usuarioApellido, 
	u.usuarioDni, u.usuarioTelefono, u.usuarioPassword, u.usuarioRolId,
     date_format(u.usuarioFechaCreacion,"%d-%m-%y") as usuarioFechaCreacion,
     u.usuarioEstado, r.rolNombre
 FROM 
	usuario  u
    join rol r on r.rolId = u.usuarioRolId
 WHERE  
	 usuarioSucursalId = idUsuarioSucursal
     and usuarioEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarUsuarioporId` (IN `idUsuario` INT)   SELECT *
 FROM 
	usuario  
 WHERE  
	 usuarioId = idUsuario
     and usuarioEstado=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarCategoria` (IN `idCategoriaSucursal` INT, `nombreCategoria` VARCHAR(150))   insert into categoria 
 (categoriaSucursalId,categoriaNombre,categoriaFechaCreacion,categoriaEstado) 
 values  
	 (idCategoriaSucursal,nombreCategoria,now(),1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarCliente` (IN `idClienteEmpresa` INT, `nombrecliente` VARCHAR(150), `rucCliente` VARCHAR(150), `telefonoCliente` VARCHAR(12), `direccionCliente` VARCHAR(150), `corrreoCliente` VARCHAR(150))   insert into cliente 
 (clienteEmpresaId,clienteNombre,clienteRuc,clienteTelefono,clienteDireccion,clienteCorreo,clienteFechaCreacion,clienteEstado) 
 values  
	 (idClienteEmpresa,nombrecliente,rucCliente,telefonoCliente,direccionCliente,corrreoCliente,now(),1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarCompania` (IN `nombreCompania` VARCHAR(150))   insert into compania 
 (companiaNombre,companiaFechaCreacion,companiaEstado) 
 values  
	 (nombreCompania,now(),1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarCompra` (IN `idCompraSucursal` INT, IN `idUsuario` INT(11))   BEGIN
	insert into compra(compraSucursalId,compraUsuarioId,compraEstado) 
	values(idCompraSucursal,idUsuario,2);
    
        select compraId from compra where  compraId = @@Identity;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarDetalleCompra` (IN `idCompra` INT, IN `idProducto` INT, IN `precioCompra` NUMERIC(9,2), IN `cantidad` INT)   BEGIN
    -- Insertar un nuevo compra en la tabla 'detallecompra'
    INSERT INTO detallecompra (detallecompraCompraId, detallecompraProductoId, detallecompraProductoPrecioCompra, detallecompraCantidad, detallecompraTotal ,detallecompraFechaCreacion, detallecompraEstado)
    VALUES (idCompra, idProducto, precioCompra,cantidad, precioCompra * cantidad,now(),1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarDetalleVenta` (IN `idVenta` INT, IN `idProducto` INT, IN `precioVenta` NUMERIC(9,2), IN `cantidad` INT)   BEGIN
    -- Insertar un nuevo venta en la tabla 'detalleventa'
    INSERT INTO detalleventa(detalleventaVentaId, detalleventaProductoId, detalleventaProductoPrecioVenta, detalleventaCantidad, detalleventaTotal, detalleventaFechaCreacion ,detalleventaEstado)
    VALUES (idVenta, idProducto, precioVenta,cantidad, precioVenta * cantidad,now(),1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarEmpresa` (IN `idCompaniaEmpresa` INT, `nombreEmpresa` VARCHAR(150), `rucEmpresa` VARCHAR(11))   insert into empresa 
 (empresaCompaniaId, empresaNombre,empresaRuc,empresaFechaCreacion,empresaEstado) 
 values  
	 (idCompaniaEmpresa,nombreEmpresa,rucEmpresa,now(),1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarMoneda` (IN `idMonedaSucursal` INT, `nombreMoneda` VARCHAR(150))   insert into moneda 
 (monedaSucursalId,monedaNombre,monedaFechaCreacion,monedaEstado) 
 values  
	 (idMonedaSucursal,nombreMoneda,now(),1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarProducto` (IN `idProductoSucursal` INT, `idProductoCategoria` INT, `nombreProducto` VARCHAR(150), `descripcionProducto` VARCHAR(150), `idProductoMoneda` INT, `idProductoUnidad` INT, `precioCompraProducto` NUMERIC(9,2), `precioVentaProducto` NUMERIC(9,2), `stockProducto` INT, `imagenProducto` LONGTEXT)   insert into producto 
(productoSucursalId, productoCategoriaId, productoNombre,productoDescripcion,productoUnidadId,productoMonedaId, productoPrecioCompra,productoPrecioVenta, productoStock, productoImagen,productoFechaCreacion, productoEstado)
 values  
(idProductoSucursal,idProductoCategoria,nombreProducto,descripcionProducto,idProductoMoneda,idProductoUnidad,precioCompraProducto,precioVentaProducto,stockProducto,imagenProducto,now(3),1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarProveedor` (IN `idProveedorEmpresa` INT, `nombreProveedor` VARCHAR(150), `rucProveedor` VARCHAR(150), `telefonoProveedor` VARCHAR(12), `direccionProveedor` VARCHAR(150), `corrreoProveedor` VARCHAR(150))   insert into proveedor 
 (proveedorEmpresaId,proveedorNombre,proveedorRuc,proveedorTelefono,proveedorDireccion,proveedorCorreo,proveedorFechaCreacion,proveedorEstado) 
 values  
	 (idProveedorEmpresa,nombreProveedor,rucProveedor,telefonoProveedor,direccionProveedor,corrreoProveedor,now(),1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarrol` (IN `idRolSucursal` INT, `nombreRol` VARCHAR(150))   insert into rol 
 (rolSucursalId,rolNombre,rolFechaCreacion,rolEstado) 
 values  
	 (idRolSucursal,nombreRol,now(),1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarSucursal` (IN `idSucursalEmpresa` INT, `nombreSucursal` VARCHAR(150))   insert into sucursal 
 (sucursalEmpresaId,sucursalNombre,sucursalFechaCreacion,sucursalEstado) 
 values  
	 (idSucursalEmpresa,nombreSucursal,now(),1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarUnidad` (IN `idUnidadSucursal` INT, `nombreUnidad` VARCHAR(150))   insert into unidad 
 (unidadSucursalId,unidadNombre,unidadFechaCreacion,unidadEstado) 
 values  
	 (idUnidadSucursal,nombreUnidad,now(),1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarUsuario` (IN `idUsuarioSucursal` INT, `idUsuarioRol` INT, `correoUsuario` VARCHAR(150), `nombreUsuario` VARCHAR(150), `apellidoUsuario` VARCHAR(150), `dniUsuario` VARCHAR(30), `telefonoUsuario` VARCHAR(13), `passwordUsuario` VARCHAR(150))   insert into usuario 
 (usuarioSucursalId,usuarioRolId,usuarioCorreo,usuarioNombre,usuarioApellido,usuarioDni,usuarioTelefono,usuarioPassword,usuarioFechaCreacion,usuarioEstado) 
 values  
	 (idUsuarioSucursal,idUsuarioRol,correoUsuario,nombreUsuario,apellidoUsuario,dniUsuario,telefonoUsuario,passwordUsuario,now(),1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spRegistrarVenta` (IN `idVentaSucursal` INT, IN `idUsuario` INT)   BEGIN
    -- Insertar un nuevo venta en la tabla 'detalleventa'
    INSERT INTO venta (ventaSucursalId,ventaUsuarioId,ventaEstado)
    VALUES (idVentaSucursal, idUsuario,2);
    
    select ventaId from venta where ventaId = @@Identity;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateCategoria` (IN `idCategoria` INT, `idCategoriaSucursal` INT, `nombreCategoria` VARCHAR(150))   update categoria
    set 
		categoriaSucursalId = idCategoriaSucursal,
        categoriaNombre = nombreCategoria
	where
		categoriaId = idCategoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateCliente` (IN `idCliente` INT, `idClienteEmpresa` INT, `nombreCliente` VARCHAR(150), `rucCliente` VARCHAR(150), `telefonoCliente` VARCHAR(12), `direccionCliente` VARCHAR(150), `corrreoCliente` VARCHAR(150))   update cliente
    set 
		clienteEmpresaId = idClienteEmpresa,
        clienteNombre= nombreCliente,
        clienteRuc = rucCliente,
        clienteTelefono = telefonoCliente,
        clienteDireccion = direccionCliente,
        clienteCorreo = corrreoCliente
	where
		clienteId = idCliente$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateCompania` (IN `idCompania` INT, `nombreCompania` VARCHAR(150))   update compania
    set 
		companiaNombre = nombreCompania 
	where
		companiaId = idCompania$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateCompra` (IN `idCompra` INT, IN `idPago` INT, IN `idProveedor` INT, IN `rucProveedor` VARCHAR(50), IN `direccionProveedor` VARCHAR(150), IN `correoProveedor` VARCHAR(150), IN `comentarioCompra` VARCHAR(250), IN `idMoneda` INT)   BEGIN    
	DECLARE NOT_FOUND INT DEFAULT 0;
    DECLARE idRegistro INT;
    DECLARE idProducto INT;
    DECLARE cantidadProd INT;

    DECLARE CUR CURSOR FOR SELECT detallecompraId FROM detallecompra WHERE detallecompraCompraId = idCompra;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET NOT_FOUND = 1;  

 update compra
   set 
	compraPagoId = idPago,    
    compraMonedaId = idMoneda,
    compraProveedorId = idProveedor,
    compraProveedorRuc  = rucProveedor,
    compraProveedorDireccion = direccionProveedor,
    compraProveedorCorreo = correoProveedor,
    compraComentario = comentarioCompra,
    compraFechaCreacion = now(),
    compraEstado = 1
    where compraId = idCompra;        
		
    OPEN CUR;
    FETCH NEXT FROM CUR INTO idRegistro;
    
    WHILE NOT_FOUND=0 DO
    
           -- SQLINES LICENSE FOR EVALUATION USE ONLY
   SELECT detallecompraProductoId INTO idProducto FROM detallecompra WHERE detallecompraId = idRegistro;  
     
   -- SQLINES LICENSE FOR EVALUATION USE ONLY
   SELECT detallecompraCantidad INTO cantidadProd FROM detallecompra WHERE detallecompraId = idRegistro;  
   
        UPDATE producto
        SET
            productoStock = productoStock + cantidadProd
        WHERE
            productoId = idProducto;
        
        FETCH NEXT FROM CUR INTO idRegistro;
    END WHILE;    
    CLOSE CUR;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateDetalleCompra` (IN `idCompra` INT)   BEGIN
   update compra
   set 
	compraSubTotal = (select sum(detallecompraTotal) from detallecompra where detallecompraCompraId = idCompra and detallecompraEstado = 1),
	compraIgv = (select sum(detallecompraTotal) from detallecompra where detallecompraCompraId = idCompra and detallecompraEstado = 1) * 0.18,
	compraTotal = (select sum(detallecompraTotal) from detallecompra where detallecompraCompraId = idCompra and detallecompraEstado = 1) + 
    ((select sum(detallecompraTotal) from detallecompra where detallecompraCompraId = idCompra and detallecompraEstado = 1) * 0.18)
    where compraId = idCompra;
    
    select compraSubTotal,compraIgv, compraTotal from compra
		where compraId = idCompra;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateDetalleVenta` (IN `idVenta` INT)   BEGIN
	 update venta
   set 
	ventaSubTotal = (select sum(detalleventaTotal) from detalleventa where detalleventaVentaId = idVenta and detalleventaEstado = 1),
	ventaIgv = (select sum(detalleventaTotal) from detalleventa where detalleventaVentaId = idVenta and detalleventaEstado = 1) * 0.18,
	ventaTotal = (select sum(detalleventaTotal) from detalleventa where detalleventaventaId = idventa and detalleventaEstado = 1) + 
    ((select sum(detalleventaTotal) from detalleventa where detalleventaVentaId = idVenta and detalleventaEstado = 1) * 0.18)
    where ventaId = idVenta;
    
    select ventaSubTotal,ventaIgv,ventaTotal from venta
		where ventaId = idVenta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateEmpresa` (IN `idEmpresa` INT, `idCompaniaEmpresa` INT, `nombreEmpresa` VARCHAR(150), `rucEmpresa` VARCHAR(10))   update empresa
    set 
		empresaCompaniaId = idCompaniaEmpresa,
		empresaNombre = nombreEmpresa,
        empresaRuc = rucEmpresa 
	where
		empresaId = idempresa$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateMenuNo` (IN `iddetalleMenu` INT)   UPDATE detallemenu 
	SET
		detallemenuPermiso = 'No'
	WHERE
		detallemenuId = iddetalleMenu$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateMenuSi` (IN `iddetalleMenu` INT)   UPDATE detallemenu 
	SET
		detallemenuPermiso = 'Si'
	WHERE
		detallemenuId = iddetalleMenu$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateMoneda` (IN `idMoneda` INT, `idMonedaSucursal` INT, `nombreMoneda` VARCHAR(150))   update moneda
    set 
		monedaSucursalId = idMonedaSucursal,
        monedaNombre = nombreMoneda
	where
		monedaId = idMoneda$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateProducto` (IN `idProducto` INT, `idProductoSucursal` INT, `idProductoCategoria` INT, `nombreProducto` VARCHAR(150), `descripcionProducto` VARCHAR(150), `idProductoMoneda` INT, `idProductoUnidad` INT, `precioCompraProducto` NUMERIC(9,2), `precioVentaProducto` NUMERIC(9,2), `stockProducto` INT, `imagenProducto` BLOB)   update producto
    set 
		productoSucursalId = idProductoSucursal,
        productoCategoriaId= idProductoCategoria,
        productoNombre = nombreProducto,
        productoDescripcion = descripcionProducto,
        productoMonedaId = idProductoMoneda,
        productoUnidadId = idProductoUnidad,
        productoPrecioCompra = precioCompraProducto,
        productoPrecioVenta = precioVentaProducto,
        productoStock = stockProducto,
        productoImagen = imagenProducto
	where
		productoId = idProducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateProveedor` (IN `idProveedor` INT, `idProveedorEmpresa` INT, `nombreProveedor` VARCHAR(150), `rucProveedor` VARCHAR(150), `telefonoProveedor` VARCHAR(12), `direccionProveedor` VARCHAR(150), `corrreoProveedor` VARCHAR(150))   update proveedor
    set 
		proveedorEmpresaId = idProveedorEmpresa,
        proveedorNombre= nombreProveedor,
        proveedorRuc = rucProveedor,
        proveedorTelefono = telefonoProveedor,
        proveedorDireccion = direccionProveedor,
        proveedorCorreo = corrreoProveedor
	where
		proveedorId = idProveedor$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateRol` (IN `idRol` INT, `idRolSucursal` INT, `nombreRol` VARCHAR(150))   update rol
    set 
		rolSucursalId = idRolSucursal ,
        rolNombre = nombreRol  
	where
		rolId = idRol$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateSucursal` (IN `idSucursal` INT, `idSucursalEmpresa` INT, `nombreSucursal` VARCHAR(150))   update sucursal
    set 
		sucursalEmpresaId = idSucursalEmpresa,
        sucursalNombre = nombreSucursal 
	where
		sucursalId = idSucursal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateUnidad` (IN `idUnidad` INT, `idUnidadSucursal` INT, `nombreUnidad` VARCHAR(150))   update unidad
    set 
		unidadSucursalId = idUnidadSucursal,
        unidadNombre = nombreUnidad 
	where
		unidadId = idUnidad$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateUsuario` (IN `idUsuario` INT, `idUsuarioSucursal` INT, `idUsuarioRol` INT, `correoUsuario` VARCHAR(150), `nombreUsuario` VARCHAR(150), `apellidoUsuario` VARCHAR(150), `dniUsuario` VARCHAR(30), `telefonoUsuario` VARCHAR(13), `passwordUsuario` VARCHAR(150))   update usuario
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
		usuarioId = idUsuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spUpdateVenta` (IN `idVenta` INT, IN `idPago` INT, IN `idCliente` INT, IN `rucCliente` VARCHAR(50), IN `direccionCliente` VARCHAR(150), IN `correoCliente` VARCHAR(150), IN `comentarioVenta` VARCHAR(250), IN `idMoneda` INT)   BEGIN    
	DECLARE NOT_FOUND INT DEFAULT 0;
    DECLARE idRegistro INT;
    DECLARE idProducto INT;
    DECLARE cantidadProd INT;

    DECLARE CUR CURSOR FOR SELECT detalleventaId FROM detalleventa WHERE detalleventaVentaId = idVenta;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET NOT_FOUND = 1;  

 update venta
   set 
	ventaPagoId = idPago,    
    ventaMonedaId = idMoneda,
    ventaClienteId = idCliente,
    ventaClienteRuc  = rucCliente,
    ventaClienteDireccion = direccionCliente,
    ventaClienteCorreo = correoCliente,
    ventaComentario = comentarioVenta,
    ventaFechaCreacion = now(),
    ventaEstado = 1
    where ventaId = idVenta;        
		
    OPEN CUR;
    FETCH NEXT FROM CUR INTO idRegistro;
    
    WHILE NOT_FOUND=0 DO
    
           -- SQLINES LICENSE FOR EVALUATION USE ONLY
   SELECT detalleventaProductoId INTO idProducto FROM detalleventa WHERE detalleventaId = idRegistro;  
     
   -- SQLINES LICENSE FOR EVALUATION USE ONLY
   SELECT detalleventaCantidad INTO cantidadProd FROM detalleventa WHERE detalleventaId = idRegistro;  
   
        UPDATE producto
        SET
            productoStock = productoStock - cantidadProd
        WHERE
            productoId = idProducto;
        
        FETCH NEXT FROM CUR INTO idRegistro;
    END WHILE;    
    CLOSE CUR;    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoriaId` int(11) NOT NULL,
  `categoriaSucursalId` int(11) NOT NULL,
  `categoriaNombre` varchar(150) NOT NULL,
  `categoriaFechaCreacion` datetime NOT NULL,
  `categoriaEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoriaId`, `categoriaSucursalId`, `categoriaNombre`, `categoriaFechaCreacion`, `categoriaEstado`) VALUES
(1, 13, 'Video', '2023-08-11 00:00:00', 1),
(2, 13, 'Musica', '0000-00-00 00:00:00', 1),
(3, 13, 'Letra', '0000-00-00 00:00:00', 1),
(4, 14, 'Video', '0000-00-00 00:00:00', 1),
(5, 14, 'Musica', '0000-00-00 00:00:00', 1),
(6, 14, 'Letra', '0000-00-00 00:00:00', 1),
(7, 15, 'Video', '0000-00-00 00:00:00', 1),
(8, 15, 'Musica', '0000-00-00 00:00:00', 1),
(9, 15, 'Letra', '0000-00-00 00:00:00', 1),
(10, 15, 'Escritor', '0000-00-00 00:00:00', 1),
(11, 16, 'Video', '0000-00-00 00:00:00', 1),
(12, 16, 'Musica', '0000-00-00 00:00:00', 1),
(13, 16, 'Letra', '0000-00-00 00:00:00', 1),
(14, 17, 'Video', '0000-00-00 00:00:00', 1),
(15, 17, 'Musica', '0000-00-00 00:00:00', 1),
(16, 17, 'Letra', '0000-00-00 00:00:00', 1),
(17, 18, 'Video', '0000-00-00 00:00:00', 1),
(18, 18, 'Musica', '0000-00-00 00:00:00', 1),
(19, 18, 'Letra', '0000-00-00 00:00:00', 1),
(20, 13, 'test', '2023-08-14 16:16:32', 1),
(21, 13, 'test 2', '2023-08-14 16:33:11', 1),
(22, 13, 'test 3', '2023-08-14 16:36:31', 1),
(23, 13, 'test 4', '2023-08-14 16:36:57', 1),
(24, 13, 'test 5', '2023-08-14 16:37:16', 1),
(25, 13, 'test6', '2023-08-14 16:37:34', 0),
(26, 13, 'test6', '2023-08-14 16:37:41', 0),
(27, 13, 'test 6', '2023-08-14 16:37:45', 1),
(28, 13, 'test8', '2023-08-14 16:52:07', 0),
(29, 13, 'test 8', '2023-08-14 23:08:08', 1),
(30, 13, 'test 8', '2023-08-14 23:08:39', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `clienteId` int(11) NOT NULL,
  `clienteEmpresaId` int(11) NOT NULL,
  `clienteNombre` varchar(150) NOT NULL,
  `clienteRuc` varchar(50) NOT NULL,
  `clienteTelefono` varchar(20) NOT NULL,
  `clienteDireccion` varchar(100) NOT NULL,
  `clienteCorreo` varchar(150) NOT NULL,
  `clienteFechaCreacion` datetime NOT NULL,
  `clienteEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`clienteId`, `clienteEmpresaId`, `clienteNombre`, `clienteRuc`, `clienteTelefono`, `clienteDireccion`, `clienteCorreo`, `clienteFechaCreacion`, `clienteEstado`) VALUES
(19, 1, 'cliente 1', '1', '3', 'sin numero 123', 'cliente1@gmail.com', '2018-08-23 00:00:00', 1),
(20, 1, 'cliente2', '12', '32', 'sin numero 1232', 'cliente2@gmail.com', '2018-08-23 00:00:00', 0),
(21, 2, 'cliente 3', '1', '3', 'sin numero 123', 'cliente3@gmail.com', '2018-08-23 00:00:00', 1),
(22, 2, 'cliente 4', '1', '3', 'sin numero 123', 'cliente4@gmail.com', '2018-08-23 00:00:00', 1),
(23, 3, 'cliente 5', '1', '3', 'sin numero 123', 'cliente5@gmail.com', '2018-08-23 00:00:00', 1),
(24, 3, 'cliente 6', '1', '3', 'sin numero 123', 'cliente6@gmail.com', '2018-08-23 00:00:00', 1),
(25, 4, 'cliente 7', '1', '3', 'sin numero 123', 'cliente7@gmail.com', '2018-08-23 00:00:00', 1),
(26, 4, 'cliente 8', '1', '3', 'sin numero 123', 'cliente8@gmail.com', '2018-08-23 00:00:00', 1),
(27, 1, 'test2', '123', '54321', 'sin numero 1', 'test@gmail.com', '2023-08-18 23:44:41', 0),
(28, 1, 'test5', '123', '123', 'otro mas 1', 'otro@gmial.com', '2023-08-25 22:58:39', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compania`
--

CREATE TABLE `compania` (
  `companiaId` int(10) NOT NULL,
  `companiaNombre` varchar(250) NOT NULL,
  `companiaFechaCreacion` datetime NOT NULL,
  `companiaEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compania`
--

INSERT INTO `compania` (`companiaId`, `companiaNombre`, `companiaFechaCreacion`, `companiaEstado`) VALUES
(1, 'Ferreteria', '0000-00-00 00:00:00', 1),
(2, 'Bodega ', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `compraId` int(11) NOT NULL,
  `compraSucursalId` int(11) DEFAULT NULL,
  `compraPagoId` int(11) DEFAULT NULL,
  `compraProveedorId` int(11) DEFAULT NULL,
  `compraProveedorRuc` varchar(150) DEFAULT NULL,
  `compraProveedorDireccion` varchar(150) DEFAULT NULL,
  `compraProveedorCorreo` varchar(150) DEFAULT NULL,
  `compraSubTotal` decimal(9,2) DEFAULT NULL,
  `compraIgv` decimal(9,2) DEFAULT NULL,
  `compraTotal` decimal(9,2) DEFAULT NULL,
  `compraComentario` varchar(250) DEFAULT NULL,
  `compraUsuarioId` int(11) DEFAULT NULL,
  `compraMonedaId` int(11) DEFAULT NULL,
  `compraFechaCreacion` datetime DEFAULT NULL,
  `compraEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`compraId`, `compraSucursalId`, `compraPagoId`, `compraProveedorId`, `compraProveedorRuc`, `compraProveedorDireccion`, `compraProveedorCorreo`, `compraSubTotal`, `compraIgv`, `compraTotal`, `compraComentario`, `compraUsuarioId`, `compraMonedaId`, `compraFechaCreacion`, `compraEstado`) VALUES
(1, 13, 3, 1, '1', 'sin numero', 'prov@gmail.com', 19.20, 3.46, 22.66, '', 5, 2, '2023-10-12 22:48:23', 1),
(2, 13, 2, 2, '11', 'sin numero1', 'prov21@gmail.com', 52.00, 9.36, 61.36, '', 5, 8, '2023-10-12 22:49:15', 1),
(3, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, 2),
(4, 13, 1, 1, '1', 'sin numero', 'prov@gmail.com', 6.40, 1.15, 7.55, '', 5, 2, '2023-10-17 23:18:31', 1),
(5, 13, 1, 1, '1', 'sin numero', 'prov@gmail.com', 61.60, 11.09, 72.69, '', 5, 1, '2023-10-18 15:47:34', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

CREATE TABLE `detallecompra` (
  `detallecompraId` int(11) NOT NULL,
  `detallecompraCompraId` int(11) DEFAULT NULL,
  `detallecompraProductoId` int(11) DEFAULT NULL,
  `detallecompraProductoPrecioCompra` decimal(9,2) DEFAULT NULL,
  `detallecompraCantidad` int(11) DEFAULT NULL,
  `detallecompraTotal` decimal(9,2) DEFAULT NULL,
  `detallecompraFechaCreacion` datetime DEFAULT NULL,
  `detallecompraEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallecompra`
--

INSERT INTO `detallecompra` (`detallecompraId`, `detallecompraCompraId`, `detallecompraProductoId`, `detallecompraProductoPrecioCompra`, `detallecompraCantidad`, `detallecompraTotal`, `detallecompraFechaCreacion`, `detallecompraEstado`) VALUES
(1, 1, 2, 3.20, 6, 19.20, '2023-10-12 22:48:19', 1),
(2, 2, 11, 6.50, 8, 52.00, '2023-10-12 22:49:12', 1),
(3, 3, 2, 3.20, 2, 6.40, '2023-10-15 13:54:32', 0),
(4, 4, 2, 3.20, 2, 6.40, '2023-10-17 23:18:27', 1),
(5, 5, 2, 3.20, 3, 9.60, '2023-10-18 15:47:19', 1),
(6, 5, 3, 6.50, 8, 52.00, '2023-10-18 15:47:31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallemenu`
--

CREATE TABLE `detallemenu` (
  `detallemenuId` int(11) NOT NULL,
  `detallemenuMenuId` int(11) NOT NULL,
  `detallemenuRolId` int(11) NOT NULL,
  `detallemenuPermiso` varchar(2) NOT NULL,
  `detallemenuFechacreacion` datetime DEFAULT NULL,
  `detallemenuEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallemenu`
--

INSERT INTO `detallemenu` (`detallemenuId`, `detallemenuMenuId`, `detallemenuRolId`, `detallemenuPermiso`, `detallemenuFechacreacion`, `detallemenuEstado`) VALUES
(1, 1, 1, 'Si', '2023-09-11 00:00:00', 1),
(2, 2, 1, 'Si', '2023-09-11 00:00:00', 1),
(3, 3, 1, 'Si', '2023-09-11 00:00:00', 1),
(4, 4, 1, 'Si', '2023-09-11 00:00:00', 1),
(5, 5, 1, 'Si', '2023-09-11 00:00:00', 1),
(6, 6, 1, 'Si', '2023-09-11 00:00:00', 1),
(7, 7, 1, 'Si', '2023-09-11 00:00:00', 1),
(8, 8, 1, 'Si', '2023-09-11 00:00:00', 1),
(9, 9, 1, 'Si', '2023-09-11 00:00:00', 1),
(10, 10, 1, 'Si', '2023-09-11 00:00:00', 1),
(11, 11, 1, 'Si', '2023-09-11 00:00:00', 1),
(12, 12, 1, 'Si', '2023-09-15 00:00:00', 1),
(13, 13, 1, 'Si', '2023-09-15 00:00:00', 1),
(14, 14, 1, 'Si', '2023-09-15 00:00:00', 1),
(15, 15, 1, 'Si', '2023-09-15 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `detalleventaId` int(11) NOT NULL,
  `detalleventaVentaId` int(11) DEFAULT NULL,
  `detalleventaProductoId` int(11) DEFAULT NULL,
  `detalleventaProductoPrecioVenta` decimal(9,2) DEFAULT NULL,
  `detalleventaCantidad` int(11) DEFAULT NULL,
  `detalleventaTotal` decimal(9,2) DEFAULT NULL,
  `detalleventaFechaCreacion` datetime DEFAULT NULL,
  `detalleventaEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`detalleventaId`, `detalleventaVentaId`, `detalleventaProductoId`, `detalleventaProductoPrecioVenta`, `detalleventaCantidad`, `detalleventaTotal`, `detalleventaFechaCreacion`, `detalleventaEstado`) VALUES
(1, 1, 11, 6.50, 5, 32.50, '2023-10-18 15:33:02', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `documentoId` int(11) NOT NULL,
  `documentoNombre` varchar(50) NOT NULL,
  `documentoTipo` varchar(150) NOT NULL,
  `documentoFechaCreacion` datetime DEFAULT NULL,
  `documentoEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `empresaId` int(11) NOT NULL,
  `empresaCompaniaId` int(11) NOT NULL,
  `empresaNombre` varchar(150) NOT NULL,
  `empresaRuc` varchar(10) NOT NULL,
  `empresaCorreo` varchar(150) DEFAULT NULL,
  `empresaTelefono` varchar(150) DEFAULT NULL,
  `empresaDireccion` varchar(150) DEFAULT NULL,
  `empresaPagina` varchar(150) DEFAULT NULL,
  `empresaFechaCreacion` datetime NOT NULL,
  `empresaEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresaId`, `empresaCompaniaId`, `empresaNombre`, `empresaRuc`, `empresaCorreo`, `empresaTelefono`, `empresaDireccion`, `empresaPagina`, `empresaFechaCreacion`, `empresaEstado`) VALUES
(1, 1, 'Don Pedro', '1298765432', 'donPedrogmail.com', '2352351', 'sin numero1', 'mipagina.com', '0000-00-00 00:00:00', 1),
(2, 1, 'La Unión', '1298765432', 'launiongmail.com', '23523', 'sin numero2', 'mipagina.com', '0000-00-00 00:00:00', 1),
(3, 1, 'Empresa1', '8765432345', 'empresa1@gmail.com', '23456', 'sin numero3', 'mipagina.com', '2023-08-01 00:00:00', 1),
(4, 2, 'Empresa 2', '1234567876', 'empresa2@gmail.com', '5224423', 'sin numero4', 'mipagina.com', '2023-08-02 00:00:00', 1),
(5, 2, 'Empresa 3', '8765432532', 'empresa3@gamil.com', '2535564', 'sin numero6', 'mipagina.com', '2023-03-23 00:00:00', 1),
(6, 2, 'Empresa 4', '1234567987', 'empresa4@gmail.com', '32534663', 'sin numero7', 'mipagina.com', '2023-06-12 00:00:00', 1),
(8, 1, 'test2', '1111111', 'test2@gmail.com', '7893257', 'sin numero8', 'mipagina.com', '2023-08-17 00:03:33', 0),
(9, 1, 'test', '1111111', 'test@gmail.com', '68557', 'sin numero9', 'mipagina.com', '2023-08-17 14:10:09', 0),
(10, 1, 'test2', '222222', 'tes2@gmail.com', '3214673', 'sin numero110', 'mipagina.com', '2023-08-17 14:10:36', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `menuId` int(11) NOT NULL,
  `menuNombre` varchar(250) NOT NULL,
  `menuRuta` varchar(250) NOT NULL,
  `menuIdentificacion` varchar(250) NOT NULL,
  `menuGrupo` varchar(150) NOT NULL,
  `menuFechaCreacion` datetime DEFAULT NULL,
  `menuEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`menuId`, `menuNombre`, `menuRuta`, `menuIdentificacion`, `menuGrupo`, `menuFechaCreacion`, `menuEstado`) VALUES
(1, 'Dashboard', '../home/', 'dashboard', 'Dashboard', '2023-09-11 00:00:00', 1),
(2, 'Mnt.Categoria', '../MntCategoria/', 'mntcategoria', 'Mantenimiento', '2023-09-11 00:00:00', 1),
(3, 'Mnt.Producto', '../MntProducto/', 'mntproducto', 'Mantenimiento', '2023-09-11 00:00:00', 1),
(4, 'Mnt.Cliente', '../MntCliente/', 'mntcliente', 'Mantenimiento', '2023-09-11 00:00:00', 1),
(5, 'Mnt.Proveedor', '../MntProveedor/', 'mntproveedor', 'Mantenimiento', '2023-09-11 00:00:00', 1),
(6, 'Mnt.Moneda', '../MntMoneda/', 'mntmoneda', 'Mantenimiento', '2023-09-11 00:00:00', 1),
(7, 'Mnt.UndMedida', '../MntUnidadmedida/', 'mntundmedida', 'Mantenimiento', '2023-09-11 00:00:00', 1),
(8, 'Mnt.Empresa', '../MntEmpresa/', 'mntempresa', 'Mantenimiento', '2023-09-11 00:00:00', 1),
(9, 'Mnt.Sucursal', '../MntSucursal/', 'mntsucursal', 'Mantenimiento', '2023-09-11 00:00:00', 1),
(10, 'Mnt.Usuario', '../MntUsuario/', 'mntusuario', 'Mantenimiento', '2023-09-11 00:00:00', 1),
(11, 'Mnt.Rol', '../MntRol/', 'mntrol', 'Mantenimiento', '2023-09-11 00:00:00', 1),
(12, 'NuevaCompra', '../MntCompra/', 'mntcompra', 'Compra', '2023-09-15 00:00:00', 1),
(13, 'ListaCompra', '../ListaCompra/', 'listacompra', 'Compra', '2023-09-15 00:00:00', 1),
(14, 'NuevaVenta', '../MntVenta/', 'mntventa', 'Venta', '2023-09-15 00:00:00', 1),
(15, 'ListaVenta', '../ListaVenta/', 'listaventa', 'Venta', '2023-09-15 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `monedaId` int(11) NOT NULL,
  `monedaSucursalId` int(11) NOT NULL,
  `monedaNombre` varchar(150) NOT NULL,
  `monedaFechaCreacion` datetime NOT NULL,
  `monedaEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`monedaId`, `monedaSucursalId`, `monedaNombre`, `monedaFechaCreacion`, `monedaEstado`) VALUES
(1, 13, 'dolar', '0000-00-00 00:00:00', 1),
(2, 13, 'sol', '0000-00-00 00:00:00', 1),
(3, 14, 'dolar', '0000-00-00 00:00:00', 1),
(4, 14, 'sol', '0000-00-00 00:00:00', 1),
(5, 15, 'dolar', '0000-00-00 00:00:00', 1),
(6, 15, 'sol', '0000-00-00 00:00:00', 1),
(7, 13, 'test', '2023-08-16 15:24:56', 1),
(8, 13, 'test', '2023-08-16 15:24:56', 1),
(9, 13, 'test 2', '2023-08-16 15:25:24', 0),
(10, 13, 'test 2', '2023-08-16 15:25:24', 0),
(11, 13, 'test 3', '2023-08-16 15:32:39', 0),
(12, 13, 'test 3', '2023-08-16 15:32:39', 0),
(13, 13, 'test 4', '2023-08-16 15:46:21', 0),
(14, 13, 'test 4', '2023-08-16 15:46:21', 0),
(15, 13, 'test 5', '2023-08-16 15:50:37', 0),
(16, 13, 'test 6', '2023-08-16 15:50:49', 0),
(17, 13, 'test 7', '2023-08-16 15:51:01', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `pagoId` int(11) NOT NULL,
  `pagoNombre` varchar(50) NOT NULL,
  `pagoFechaCreacion` datetime DEFAULT NULL,
  `pagoEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`pagoId`, `pagoNombre`, `pagoFechaCreacion`, `pagoEstado`) VALUES
(1, 'cheque', '2023-10-03 00:00:00', 1),
(2, 'credito', '2023-10-03 00:00:00', 1),
(3, 'debito', '2023-10-03 00:00:00', 1),
(4, 'a 15 dias', '2023-10-03 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `productoId` int(11) NOT NULL,
  `productoSucursalId` int(11) DEFAULT NULL,
  `productoCategoriaId` int(11) DEFAULT NULL,
  `productoNombre` varchar(150) DEFAULT NULL,
  `productoDescripcion` varchar(150) DEFAULT NULL,
  `productoMonedaId` int(11) DEFAULT NULL,
  `productoUnidadId` int(11) DEFAULT NULL,
  `productoPrecioCompra` decimal(9,2) DEFAULT NULL,
  `productoPrecioVenta` decimal(9,2) DEFAULT NULL,
  `productoStock` int(5) DEFAULT NULL,
  `productoImagen` longtext DEFAULT NULL,
  `productoFechaCreacion` datetime DEFAULT NULL,
  `productoEstado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`productoId`, `productoSucursalId`, `productoCategoriaId`, `productoNombre`, `productoDescripcion`, `productoMonedaId`, `productoUnidadId`, `productoPrecioCompra`, `productoPrecioVenta`, `productoStock`, `productoImagen`, `productoFechaCreacion`, `productoEstado`) VALUES
(1, 13, 1, 'panes', 'desc', 2, 1, 1.20, 1.60, 2, '', '2019-07-23 00:00:00', 0),
(2, 13, 2, 'picaras', 'desc', 2, 2, 3.20, 3.50, 10, '756409889.png', '2019-07-23 00:00:00', 1),
(3, 13, 3, 'toffi', 'desc', 2, 3, 6.50, 7.00, 10, '1458419149.png', '2023-07-17 00:00:00', 1),
(4, 14, 4, 'big beng', 'desc', 4, 6, 0.60, 1.00, 5, '', '2023-07-17 00:00:00', 1),
(5, 14, 5, 'prod', 'desc', 4, 6, 0.20, 0.40, 6, '', '2023-07-17 00:00:00', 1),
(6, 15, 7, 'prod2', 'descripcion', 6, 9, 0.30, 0.60, 8, '', '2023-07-17 00:00:00', 1),
(7, 15, 8, 'prod3', 'desc', 6, 9, 1.50, 2.00, 9, '', '2023-07-17 00:00:00', 1),
(8, 16, 11, 'prod4', 'desc', 2, 2, 2.00, 2.50, 5, '', '2023-07-17 00:00:00', 1),
(9, 16, 12, 'prod5', 'desc', 2, 2, 1.30, 1.50, 6, '', '2023-07-17 00:00:00', 1),
(10, 16, 12, 'prod 6', 'desc', 2, 2, 1.20, 2.50, 5, '', '2023-09-07 00:00:00', 1),
(11, 13, 2, 'test', 'algos nomas', 1, 1, 6.50, 2.50, 15, '', '2023-09-07 16:25:07', 1),
(12, 13, 1, 'algo', 'desc', 1, 2, 3.20, 1.20, 12, NULL, '2023-10-20 23:30:55', 1),
(13, 13, 1, 'panes', 'algos nomas', 1, 2, 6.50, 7.00, 12, NULL, '2023-10-23 22:55:39', 1),
(14, 13, 3, 'test', 'Imagen prueba', 1, 1, 1.20, 2.50, 2, NULL, '2023-10-23 23:17:56', 1),
(15, 13, 20, 'test2', 'otro ', 1, 1, 3.20, 7.00, 20, NULL, '2023-10-24 15:32:09', 1),
(16, 13, 1, 'mas test 2', 'mas test 3', 2, 2, 0.20, 0.50, 10, NULL, '2023-10-24 15:36:09', 1),
(17, 13, 2, 'dos', 'dos mas', 3, 1, 0.20, 0.80, 12, NULL, '2023-10-24 15:46:18', 1),
(18, 13, 3, 'panes', 'otro ', 1, 2, 1.20, 1.60, 12, NULL, '2023-10-24 23:20:02', 1),
(19, 13, 21, 'uno', 'nos ', 2, 1, 1.00, 1.50, 12, NULL, '2023-10-25 22:52:40', 1),
(20, 13, 1, 'dos', 'dos 2', 1, 2, 0.20, 0.50, 2, NULL, '2023-10-25 23:12:56', 1),
(21, 13, 1, 'tres', 'tres 3', 1, 2, 1.00, 1.60, 12, NULL, '2023-10-25 23:27:19', 1),
(22, 13, 2, 'cuatro', 'cuatro 4', 3, 1, 3.20, 2.50, 12, NULL, '2023-10-26 15:09:38', 1),
(23, 13, 3, 'test', 'Imagen prueba', 2, 2, 1.20, 1.60, 12, NULL, '2023-10-26 15:15:43', 1),
(24, 13, 21, '4', 'cuatro', 2, 1, 0.20, 1.20, 12, NULL, '2023-10-27 22:29:49', 1),
(25, 13, 3, '5', 'cinco', 3, 2, 0.50, 0.80, 10, NULL, '2023-10-27 22:33:06', 1),
(26, 13, 2, '5', 'Imagen prueba', 2, 1, 1.20, 1.60, 2, NULL, '2023-10-29 22:11:04', 1),
(27, 13, 23, '6', 'seis', 1, 7, 3.20, 7.00, 10, NULL, '2023-10-29 22:12:50', 1),
(28, 13, 1, '7', 'siete', 1, 2, 1.20, 1.50, 12, NULL, '2023-10-29 22:24:40', 1),
(29, 13, 1, 'dos', 'Imagen prueba', 3, 2, 3.20, 7.00, 12, NULL, '2023-10-29 22:38:31', 1),
(30, 13, 3, 'panes', 'Imagen prueba', 2, 1, 1.20, 2.50, 2, '1546647650.png', '2023-10-29 22:40:49', 1),
(31, 13, 1, 'panes', 'Imagen prueba', 1, 2, 1.20, 2.50, 12, '857528876.png', '2023-10-29 22:42:36', 1),
(32, 13, 2, 'algo', 'Imagen prueba', 1, 1, 1.20, 2.50, 8, '562653859.png', '2023-10-29 22:45:30', 1),
(33, 13, 1, 'algo', 'desc', 1, 1, 1.20, 2.50, 12, '1197943912.png', '2023-10-29 22:48:19', 1),
(34, 13, 1, 'panes', 'mas test', 1, 2, 0.20, 1.20, 12, '309061421.png', '2023-10-29 22:50:13', 1),
(35, 13, 1, 'algo', 'nos ', 1, 1, 6.50, 7.00, 12, '679857410.png', '2023-10-29 23:42:44', 1),
(36, 13, 1, 'dos', 'desc', 2, 2, 0.20, 0.80, 2, '911913375.png', '2023-10-30 13:55:48', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `proveedorId` int(11) NOT NULL,
  `proveedorEmpresaId` int(11) NOT NULL,
  `proveedorNombre` varchar(150) DEFAULT NULL,
  `proveedorRuc` varchar(15) DEFAULT NULL,
  `proveedorTelefono` varchar(50) DEFAULT NULL,
  `proveedorDireccion` varchar(150) DEFAULT NULL,
  `proveedorCorreo` varchar(150) DEFAULT NULL,
  `proveedorFechaCreacion` datetime(3) DEFAULT NULL,
  `proveedorEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`proveedorId`, `proveedorEmpresaId`, `proveedorNombre`, `proveedorRuc`, `proveedorTelefono`, `proveedorDireccion`, `proveedorCorreo`, `proveedorFechaCreacion`, `proveedorEstado`) VALUES
(1, 1, 'Proveedor 1', '1', '0', 'sin numero', 'prov@gmail.com', '2025-08-23 00:00:00.000', 1),
(2, 1, 'Proveedor2', '11', '00', 'sin numero1', 'prov21@gmail.com', '2025-08-23 00:00:00.000', 1),
(3, 1, 'Proveedor 3', '1', '0', 'sin numero', 'prov3@gmail.com', '2025-08-23 00:00:00.000', 0),
(4, 2, 'Proveedor 4', '1', '0', 'sin numero', 'prov4@gmail.com', '2025-08-23 00:00:00.000', 1),
(5, 2, 'Proveedor 5', '1', '0', 'sin numero', 'prov5@gmail.com', '2025-08-23 00:00:00.000', 1),
(6, 2, 'Proveedor 6', '1', '0', 'sin numero', 'prov5@gmail.com', '2025-08-23 00:00:00.000', 1),
(7, 3, 'Proveedor 7', '1', '0', 'sin numero', 'prov6@gmail.com', '2025-08-23 00:00:00.000', 1),
(8, 3, 'Proveedor 8', '1', '0', 'sin numero', 'prov7@gmail.com', '2025-08-23 00:00:00.000', 1),
(9, 4, 'Proveedor 9', '1', '0', 'sin numero', 'prov8@gmail.com', '2025-08-23 00:00:00.000', 1),
(10, 4, 'Proveedor 10', '1', '0', 'sin numero', 'prov9@gmail.com', '2025-08-23 00:00:00.000', 1),
(11, 5, 'Proveedor 11', '1', '0', 'sin numero', 'prov10@gmail.com', '2025-08-23 00:00:00.000', 1),
(12, 5, 'Proveedor 12', '1', '0', 'sin numero', 'prov11@gmail.com', '2025-08-23 00:00:00.000', 1),
(13, 1, 'test', '1', '2', 'sin numero2', 'prov21@gmail.com', '2023-08-25 23:13:20.000', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rolId` int(11) NOT NULL,
  `rolSucursalId` int(11) NOT NULL,
  `rolNombre` varchar(150) NOT NULL,
  `rolFechaCreacion` datetime NOT NULL,
  `rolEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rolId`, `rolSucursalId`, `rolNombre`, `rolFechaCreacion`, `rolEstado`) VALUES
(1, 13, 'Admin', '2023-08-08 00:00:00', 1),
(2, 13, 'Vendedor', '2023-08-08 00:00:00', 1),
(3, 13, 'Comprador', '2023-08-08 00:00:00', 1),
(4, 14, 'Admin', '2023-08-08 00:00:00', 1),
(5, 14, 'Vendedor', '2023-08-08 00:00:00', 1),
(6, 14, 'Comprador', '2023-08-08 00:00:00', 1),
(7, 15, 'Admin', '2023-08-08 00:00:00', 1),
(8, 15, 'Vendedor', '2023-08-08 00:00:00', 1),
(9, 15, 'Comprador', '2023-08-08 00:00:00', 1),
(10, 13, 'Vendedores', '2023-09-09 23:31:47', 0),
(11, 13, 'Adminisgtrador', '2023-09-09 23:32:06', 0),
(12, 13, 'Reparto', '2023-09-10 14:04:55', 0),
(13, 13, 'Repartidor', '2023-09-10 14:05:06', 0),
(14, 13, 'Reparto a moto', '2023-09-10 14:05:38', 0),
(15, 13, 'Repartidor', '2023-09-10 14:06:01', 0),
(16, 13, 'Repartidor', '2023-09-10 14:06:09', 0),
(17, 13, 'Vendedores', '2023-09-10 14:07:56', 0),
(18, 13, 'Admins', '2023-09-10 14:08:08', 0),
(19, 13, 'Admins', '2023-09-10 14:08:35', 0),
(20, 13, 'Adminss', '2023-09-10 22:42:11', 0),
(21, 13, 'Adminsa', '2023-09-10 22:42:29', 0),
(22, 13, 'Adminsan', '2023-09-10 22:42:47', 0),
(23, 13, 'Cajero', '2023-09-10 22:45:02', 0),
(24, 13, 'Cajera', '2023-09-10 22:45:11', 0),
(25, 13, 'Cajeros', '2023-09-10 22:47:18', 0),
(26, 13, 'Cajero', '2023-09-10 22:52:08', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `sucursalId` int(11) NOT NULL,
  `sucursalEmpresaId` int(11) NOT NULL,
  `sucursalNombre` varchar(150) NOT NULL,
  `sucursalFechaCreacion` datetime NOT NULL,
  `sucursalEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`sucursalId`, `sucursalEmpresaId`, `sucursalNombre`, `sucursalFechaCreacion`, `sucursalEstado`) VALUES
(13, 1, 'Sucursal 1', '0000-00-00 00:00:00', 1),
(14, 2, 'Sucursal 2', '0000-00-00 00:00:00', 1),
(15, 3, 'Sucursal 3', '0000-00-00 00:00:00', 1),
(16, 4, 'Sucursal 4', '0000-00-00 00:00:00', 1),
(17, 5, 'Sucursal 5', '0000-00-00 00:00:00', 1),
(18, 6, 'Sucursal 6', '0000-00-00 00:00:00', 1),
(19, 1, 'Sucursales 3', '2023-08-17 15:02:13', 0),
(20, 1, 'Sucursales2', '2023-08-17 15:02:25', 0),
(25, 1, 'test', '2023-08-17 16:03:51', 0),
(26, 1, 'test 2', '2023-08-17 16:04:01', 1),
(27, 1, 'otro', '2023-09-02 23:37:40', 1),
(28, 1, 'algo', '2023-09-07 15:59:18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `unidadId` int(11) NOT NULL,
  `unidadSucursalId` int(11) NOT NULL,
  `unidadNombre` varchar(150) NOT NULL,
  `unidadFechaCreacion` datetime NOT NULL,
  `unidadEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`unidadId`, `unidadSucursalId`, `unidadNombre`, `unidadFechaCreacion`, `unidadEstado`) VALUES
(1, 13, 'Pieza', '2016-08-23 00:00:00', 1),
(2, 13, 'Kilogramo', '2016-08-23 00:00:00', 1),
(3, 13, 'Unidad', '2016-08-23 00:00:00', 1),
(4, 14, 'Pieza', '2016-08-23 00:00:00', 1),
(5, 14, 'Kilogramo', '2016-08-23 00:00:00', 1),
(6, 14, 'Unidad', '2016-08-23 00:00:00', 1),
(7, 15, 'Pieza', '2016-08-23 00:00:00', 1),
(8, 15, 'Kilogramo', '2016-08-23 00:00:00', 1),
(9, 15, 'Unidad', '2016-08-23 00:00:00', 1),
(10, 13, 'test', '2023-08-16 22:53:14', 0),
(11, 13, 'test2', '2023-08-16 22:53:31', 0),
(12, 13, 'test3', '2023-08-16 23:09:32', 0),
(13, 13, 'test2', '2023-08-16 23:09:42', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuarioId` int(11) NOT NULL,
  `usuarioSucursalId` int(11) NOT NULL,
  `usuarioRolId` int(11) NOT NULL,
  `usuarioCorreo` varchar(150) NOT NULL,
  `usuarioNombre` varchar(150) NOT NULL,
  `usuarioApellido` varchar(200) NOT NULL,
  `usuarioDni` int(8) NOT NULL,
  `usuarioTelefono` varchar(30) NOT NULL,
  `usuarioPassword` varchar(250) NOT NULL,
  `usuarioFechaCreacion` datetime NOT NULL,
  `usuarioEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuarioId`, `usuarioSucursalId`, `usuarioRolId`, `usuarioCorreo`, `usuarioNombre`, `usuarioApellido`, `usuarioDni`, `usuarioTelefono`, `usuarioPassword`, `usuarioFechaCreacion`, `usuarioEstado`) VALUES
(5, 13, 1, 'usuario1@gmail.com', 'Usuario 1', 'Apellido 1', 1, '0', '123456', '2023-08-08 00:00:00', 1),
(6, 14, 4, 'usuario2@gmail.com', 'Usuario 2', 'Apellido 2', 1, '0', '123456', '2023-08-08 00:00:00', 1),
(7, 15, 7, 'usuario3@gmail.com', 'Usuario 3', 'Apellido 3', 1, '0', '123456', '2023-08-08 00:00:00', 1),
(8, 16, 1, 'usuario4@gmail.com', 'Usuario 4', 'Apellido 4', 1, '0', '123456', '2023-08-08 00:00:00', 1),
(9, 17, 1, 'usuario5@gmail.com', 'Usuario 5', 'Apellido 5', 1, '0', '123456', '2023-08-08 00:00:00', 1),
(10, 13, 1, 'test@gmail.com', 'UserTes', 'TEst', 34325421, '1231412', '123456', '2023-09-09 22:54:13', 1),
(11, 13, 1, 'test@gmail.com', 'User11', 'TEst', 34325421, '1231412', '123456', '2023-09-09 22:54:37', 1),
(12, 13, 2, 'test1@gmail.com', 'UserTes', 'TEst', 34325421, '12315135', '123456', '2023-09-09 22:55:08', 0),
(13, 13, 3, 'test2@gmail.com', 'Test2', 'otro test', 123314, '12451', '123456', '2023-09-09 22:57:26', 0),
(14, 13, 2, 'test3@gmail.com', 'Test3', 'TEst3', 124124, '1341221', '123456', '2023-09-09 22:59:45', 1),
(15, 13, 2, 'test3@gmail.com', 'Test32', 'TEst32', 124124, '1341221', '123456', '2023-09-09 23:00:20', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `ventaId` int(11) NOT NULL,
  `ventaSucursalId` int(11) DEFAULT NULL,
  `ventaPagoId` int(11) DEFAULT NULL,
  `ventaClienteId` int(11) DEFAULT NULL,
  `ventaClienteRuc` varchar(20) DEFAULT NULL,
  `ventaClienteDireccion` varchar(250) DEFAULT NULL,
  `ventaClienteCorreo` varchar(150) DEFAULT NULL,
  `ventaSubTotal` decimal(9,2) DEFAULT NULL,
  `ventaIgv` decimal(9,2) DEFAULT NULL,
  `ventaTotal` decimal(9,2) DEFAULT NULL,
  `ventaComentario` varchar(250) DEFAULT NULL,
  `ventaUsuarioId` int(11) DEFAULT NULL,
  `ventaMonedaId` int(11) DEFAULT NULL,
  `ventaFechaCreacion` datetime DEFAULT NULL,
  `ventaEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`ventaId`, `ventaSucursalId`, `ventaPagoId`, `ventaClienteId`, `ventaClienteRuc`, `ventaClienteDireccion`, `ventaClienteCorreo`, `ventaSubTotal`, `ventaIgv`, `ventaTotal`, `ventaComentario`, `ventaUsuarioId`, `ventaMonedaId`, `ventaFechaCreacion`, `ventaEstado`) VALUES
(1, 13, 1, 19, '1', 'sin numero 123', 'cliente1@gmail.com', 32.50, 5.85, 38.35, '', 5, 1, '2023-10-18 15:33:06', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoriaId`),
  ADD KEY `fksucursal_03` (`categoriaSucursalId`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`clienteId`),
  ADD KEY `fkempresa_01` (`clienteEmpresaId`);

--
-- Indices de la tabla `compania`
--
ALTER TABLE `compania`
  ADD PRIMARY KEY (`companiaId`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`compraId`),
  ADD KEY `fksucursal_7` (`compraSucursalId`),
  ADD KEY `fkpago` (`compraPagoId`),
  ADD KEY `fkproveedor` (`compraProveedorId`),
  ADD KEY `fkusuario` (`compraUsuarioId`),
  ADD KEY `fkmoneda_2` (`compraMonedaId`);

--
-- Indices de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD PRIMARY KEY (`detallecompraId`),
  ADD KEY `fkcompra` (`detallecompraCompraId`),
  ADD KEY `fkproducto` (`detallecompraProductoId`);

--
-- Indices de la tabla `detallemenu`
--
ALTER TABLE `detallemenu`
  ADD PRIMARY KEY (`detallemenuId`),
  ADD KEY `fkmenu` (`detallemenuMenuId`),
  ADD KEY `fkrol_02` (`detallemenuRolId`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`detalleventaId`),
  ADD KEY `fkproducto_2` (`detalleventaProductoId`),
  ADD KEY `fkventa` (`detalleventaVentaId`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`documentoId`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresaId`),
  ADD KEY `fkcompania` (`empresaCompaniaId`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuId`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`monedaId`),
  ADD KEY `fksucursal_04` (`monedaSucursalId`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`pagoId`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`productoId`),
  ADD KEY `fkcategoria` (`productoCategoriaId`),
  ADD KEY `fkmoneda` (`productoMonedaId`),
  ADD KEY `fksucursal_6` (`productoSucursalId`),
  ADD KEY `fkunidad` (`productoUnidadId`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`proveedorId`),
  ADD KEY `fkempresa_02` (`proveedorEmpresaId`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rolId`),
  ADD KEY `fksucursal_02` (`rolSucursalId`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`sucursalId`),
  ADD KEY `fkempresa` (`sucursalEmpresaId`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`unidadId`),
  ADD KEY `fksucursal_5` (`unidadSucursalId`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuarioId`),
  ADD KEY `fksucursal` (`usuarioSucursalId`),
  ADD KEY `fkrol` (`usuarioRolId`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`ventaId`),
  ADD KEY `fksucursal_8` (`ventaSucursalId`),
  ADD KEY `fkpago_2` (`ventaPagoId`),
  ADD KEY `fkcliente` (`ventaClienteId`),
  ADD KEY `fkusuario_2` (`ventaUsuarioId`),
  ADD KEY `fkmoneda_3` (`ventaMonedaId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoriaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `clienteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `compania`
--
ALTER TABLE `compania`
  MODIFY `companiaId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `compraId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  MODIFY `detallecompraId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detallemenu`
--
ALTER TABLE `detallemenu`
  MODIFY `detallemenuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `detalleventaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `documentoId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empresaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `menuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `monedaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `pagoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `productoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `proveedorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rolId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `sucursalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `unidadId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuarioId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `ventaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fksucursal_03` FOREIGN KEY (`categoriaSucursalId`) REFERENCES `sucursal` (`sucursalId`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fkempresa_01` FOREIGN KEY (`clienteEmpresaId`) REFERENCES `empresa` (`empresaId`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fkmoneda_2` FOREIGN KEY (`compraMonedaId`) REFERENCES `moneda` (`monedaId`),
  ADD CONSTRAINT `fkpago` FOREIGN KEY (`compraPagoId`) REFERENCES `pago` (`pagoId`),
  ADD CONSTRAINT `fkproveedor` FOREIGN KEY (`compraProveedorId`) REFERENCES `proveedor` (`proveedorId`),
  ADD CONSTRAINT `fksucursal_7` FOREIGN KEY (`compraSucursalId`) REFERENCES `sucursal` (`sucursalId`),
  ADD CONSTRAINT `fkusuario` FOREIGN KEY (`compraUsuarioId`) REFERENCES `usuario` (`usuarioId`);

--
-- Filtros para la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD CONSTRAINT `fkcompra` FOREIGN KEY (`detallecompraCompraId`) REFERENCES `compra` (`compraId`),
  ADD CONSTRAINT `fkproducto` FOREIGN KEY (`detallecompraProductoId`) REFERENCES `producto` (`productoId`);

--
-- Filtros para la tabla `detallemenu`
--
ALTER TABLE `detallemenu`
  ADD CONSTRAINT `fkmenu` FOREIGN KEY (`detallemenuMenuId`) REFERENCES `menu` (`menuId`),
  ADD CONSTRAINT `fkrol_02` FOREIGN KEY (`detallemenuRolId`) REFERENCES `rol` (`rolId`);

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `fkproducto_2` FOREIGN KEY (`detalleventaProductoId`) REFERENCES `producto` (`productoId`),
  ADD CONSTRAINT `fkventa` FOREIGN KEY (`detalleventaVentaId`) REFERENCES `venta` (`ventaId`);

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fkcompania` FOREIGN KEY (`empresaCompaniaId`) REFERENCES `compania` (`companiaId`);

--
-- Filtros para la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD CONSTRAINT `fksucursal_04` FOREIGN KEY (`monedaSucursalId`) REFERENCES `sucursal` (`sucursalId`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fkcategoria` FOREIGN KEY (`productoCategoriaId`) REFERENCES `categoria` (`categoriaId`),
  ADD CONSTRAINT `fkmoneda` FOREIGN KEY (`productoMonedaId`) REFERENCES `moneda` (`monedaId`),
  ADD CONSTRAINT `fksucursal_6` FOREIGN KEY (`productoSucursalId`) REFERENCES `sucursal` (`sucursalId`),
  ADD CONSTRAINT `fkunidad` FOREIGN KEY (`productoUnidadId`) REFERENCES `unidad` (`unidadId`);

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `fkempresa_02` FOREIGN KEY (`proveedorEmpresaId`) REFERENCES `empresa` (`empresaId`);

--
-- Filtros para la tabla `rol`
--
ALTER TABLE `rol`
  ADD CONSTRAINT `fksucursal_02` FOREIGN KEY (`rolSucursalId`) REFERENCES `sucursal` (`sucursalId`);

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `fkempresa` FOREIGN KEY (`sucursalEmpresaId`) REFERENCES `empresa` (`empresaId`);

--
-- Filtros para la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD CONSTRAINT `fksucursal_5` FOREIGN KEY (`unidadSucursalId`) REFERENCES `sucursal` (`sucursalId`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fkrol` FOREIGN KEY (`usuarioRolId`) REFERENCES `rol` (`rolId`),
  ADD CONSTRAINT `fksucursal` FOREIGN KEY (`usuarioSucursalId`) REFERENCES `sucursal` (`sucursalId`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fkcliente` FOREIGN KEY (`ventaClienteId`) REFERENCES `cliente` (`clienteId`),
  ADD CONSTRAINT `fkmoneda_3` FOREIGN KEY (`ventaMonedaId`) REFERENCES `moneda` (`monedaId`),
  ADD CONSTRAINT `fkpago_2` FOREIGN KEY (`ventaPagoId`) REFERENCES `pago` (`pagoId`),
  ADD CONSTRAINT `fksucursal_8` FOREIGN KEY (`ventaSucursalId`) REFERENCES `sucursal` (`sucursalId`),
  ADD CONSTRAINT `fkusuario_2` FOREIGN KEY (`ventaUsuarioId`) REFERENCES `usuario` (`usuarioId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
