/*creacion de la base de datos*/
create database comprayventa;

/*Creacion de tablas*/
create table compania(
	companiaId int(10) primary key auto_increment not null,
    companiaNombre varchar(250) not null,
    companiaFechaCreacion datetime not null,
    companiaEstado int(1) not null    
);


/*Creacion de tablas*/
create table empresa (
	empresaId int(11) primary key auto_increment not null,
    empresaCompaniaId int(11) not null,
    empresaNombre varchar(150) not null,
    empresaRuc varchar(10)not null,
	empresaFechaCreacion datetime not null,
    empresaEstado int(1) not null,
    constraint fkcompania foreign key (empresaCompaniaId) references compania(companiaId)
);

ALTER TABLE `empresa`
  ADD CONSTRAINT `fkcompania` FOREIGN KEY (`empresaCompaniaId`) REFERENCES `compania` (`copaniaId`) ON DELETE CASCADE ON UPDATE CASCADE;


/*Creacion de tablas*/
create table sucursal (
	sucursalId int(11) primary key auto_increment not null,
    sucursalEmpresaId int(11) not null,
    sucursalNombre varchar(150) not null,
	sucursalFechaCreacion datetime not null,
    sucursalEstado int(1) not null ,
    constraint fkempresa foreign key (sucursalEmpresaId) references empresa(empresaId)
);


/*Creacion de tablas*/
create table rol (
	rolId int(11) primary key auto_increment not null,
    rolSucursalId int(11) not null,
    rolNombre varchar(150) not null,
	rolFechaCreacion datetime not null,
    rolEstado int(1) not null ,
    constraint fksucursal_02 foreign key (rolSucursalId) references sucursal(sucursalId)
);

/*Creacion de tablas*/
create table usuario (
	usuarioId int(11) primary key auto_increment not null,
    usuarioSucursalId int(11) not null,
    usuarioRolId int(11) not null,
    usuarioCorreo varchar(150) not null,
    usuarioNombre varchar(150) not null,
    usuarioApellido varchar(200) not null,
    usuarioDni int (8) not null,
    usuarioTelefono varchar (30)not null,
    usuarioPassword varchar(250)not null,
	usuarioFechaCreacion datetime not null,
    usuarioEstado int(1) not null ,
    constraint fksucursal foreign key (usuarioSucursalId) references sucursal(sucursalId),
    constraint fkrol foreign key (usuarioRolId) references rol(rolId)
);
/*Creacion de tablas*/
create table categoria (
	categoriaId int(11) primary key auto_increment not null,
    categoriaSucursalId int(11) not null,
    categoriaNombre varchar(150) not null,
	categoriaFechaCreacion datetime not null,
    categoriaEstado int(1) not null ,
    constraint fksucursal_03 foreign key (categoriaSucursalId) references sucursal(sucursalId)
);

/*Creacion de tablas*/
create table moneda (
	monedaId int(11) primary key auto_increment not null,
    monedaSucursalId int(11) not null,
    monedaNombre varchar(150) not null,
	monedaFechaCreacion datetime not null,
    monedaEstado int(1) not null ,
    constraint fksucursal_04 foreign key (monedaSucursalId) references sucursal(sucursalId)
);

/*Creacion de tablas*/
create table unidad (
	unidadId int(11) primary key auto_increment not null,
    unidadSucursalId int(11) not null,
    unidadNombre varchar(150) not null,
    unidadFechaCreacion datetime not null,
    unidadEstado int(1) not null ,
    constraint fksucursal_5 foreign key (unidadSucursalId) references sucursal(sucursalId)
);


/*Creacion de tablas*/
create table producto (
	productoId int(11) primary key auto_increment not null,
    productoSucursalId int(11) not null,
    productoCategoriaId int(11) not null,
    productoNombre varchar(150) not null,
    productoDescripcion varchar(150) not null,
    productoMonedaId int (11) not null,
    productoUnidadId int (11) not null,
    productoPrecioCompra decimal (9,2) not null,
    productoPrecioVenta decimal (9,2) not null,
    productoStock int(5) not null,
    productoFechaVenta datetime not null,
    productoImagen blob not null,
    productoFechaCreacion datetime not null,
    productoEstado int(1) not null ,
    constraint fksucursal_6 foreign key (productoSucursalId) references sucursal(sucursalId),
    constraint fkcategoria foreign key (productoCategoriaId) references categoria(categoriaId),
    constraint fkmoneda foreign key (productoMonedaId) references moneda(monedaId),
    constraint fkunidad foreign key (productoUnidadId) references unidad(unidadId)
);
/*Creacion de tablas*/
create table cliente (
	clienteId int(11) primary key auto_increment not null,
    clienteEmpresaId int(11) not null,
    clienteNombre varchar(150) not null,
    clienteRuc varchar(50) not null,
	clienteTelefono varchar(20) not null,
    clienteDireccion varchar(100) not null,
    clienteCorreo varchar(150)not null,
    clienteFechaCreacion datetime not null,
    clienteEstado int(1) not null ,
    constraint fkempresa_01 foreign key (clienteEmpresaId) references empresa(empresaId)
);

/*Creacion de tablas*/
create table proveedor (
  proveedorId int(11) primary key NOT NULL AUTO_INCREMENT,
  proveedorEmpresaId int(11) not null,
  proveedorNombre varchar(150) DEFAULT NULL,
  proveedorRuc varchar(15) DEFAULT NULL,
  proveedorTelefono varchar(50) DEFAULT NULL,
  proveedorDireccion varchar(150) DEFAULT NULL,
  proveedorCorreo varchar(150) DEFAULT NULL,
  proveedorFechaCreacion datetime(3) DEFAULT NULL,
  proveedorEstado int(11) DEFAULT NULL,
  constraint fkempresa_02 foreign key (proveedorEmpresaId) references empresa(empresaId)
);

/*Creacion de tablas*/
create table menu(
    menuId int(11) NOT NULL auto_increment primary key, 
    menuNombre varchar(250) not null,
    menuRuta varchar(250) not null,
    menuIdentificacion varchar(250) not null,
    menuGrupo varchar(150) not null,
    menuFechaCreacion datetime,
    menuEstado int(11) DEFAULT NULL,
)

create table detallemenu(
    detallemenuId int(11) NOT NULL auto_increment primary key, 
    detallemenuMenuId int(11) NOT NULL,
    detallemenuRolId int(11) NOT NULL,
    detallemenuPermiso varchar(2) NOT NULL,
    detallemenuFechacreacion datetime,
    detallemenuEstado int(11) DEFAULT NULL,
    constraint fkmenu foreign key (detallemenuMenuId) references menu(menuId)
    constraint fkrol_02 foreign key (detallemenuRolId) references rol(rolId)
)


/*==============*/
/*FALTA AGRAGAR*/
/*==============*/
create table documento(
    documentoId int(11) NOT NULL primary key auto_increment,
    documentoNombre varchar(50) NOT NULL,
    documentoTipo varchar(150) NOT NULL,
    documentoFechaCreacion datetime,
    documentoEstado int(11) DEFAULT NULL
)

create table pago(
    pagoId int(11) NOT NULL primary key auto_increment,
    pagoNombre varchar(50) NOT NULL,
    pagoFechaCreacion datetime,
    pagoEstado int(11) DEFAULT NULL
)


create table compra(
    compraId int(11) NOT NULL primary key auto_increment,
    compraSucursalId int(11) not null,
    compraPagoId int(11) not null,
    compraProveedorId int(11) not null,
    compraProveedorRuc varchar(150) not null,
    compraProveedorDireccion varchar(150) not null,
    compraProveedorCorreo varchar(150) not null,
    compraSubTotal numeric(9,2) not null,
    compraIgv numeric(9,2) not null,
    compraTotal numeric(9,2) not null,
    compraComentario varchar(250) not null,
    compraUsuarioId int(11) not null,
    compraMonedaId int(11) not null,
    compraDocumentoId int(11) not null,
    compraFechaCreacion datetime,
    compraEstado int(11) not null,
    constraint fksucursal_7 foreign key (compraSucursalId) references sucursal(sucursalId),
    constraint fkpago foreign key (compraPagoId) references pago(pagoId),
    constraint fkproveedor foreign key (compraProveedorId) references proveedor(proveedorId),
    constraint fkusuario foreign key (compraUsuarioId) references usuario(usuarioId),
    constraint fkmoneda_2 foreign key (compraMonedaId) references moneda(monedaId),
    constraint fkdocumento foreign key (compraDocumentoId) references documento(documentoId)

)

create table venta(
    ventaId int(11) not null primary key auto_increment,
    ventaSucursalId int(11) not null,
    ventaPagoId int(11) not null,
    ventaClienteId int(11) not null,
    ventaClienteRuc varchar(20) not null,
    ventaClienteDireccion varchar(250) not null,
    ventaClienteCorreo varchar(150) not null,
    ventaSubTotal numeric(9,2) not null,
    ventaIgv numeric(9,2) not null,
    ventaTotal numeric(9,2) not null,
    ventaComentario varchar(250) not null,
    ventaUsuarioId int(11) not null,
    ventaMonedaId int(11) not null,
    ventaDocumentoId int(11) not null,
    ventaFechaCreacion datetime,
    ventaEstado int(11) not null,
    constraint fksucursal_8 foreign key (ventaSucursalId) references sucursal(sucursalId),
    constraint fkpago_2 foreign key (ventaPagoId) references pago(pagoId),
    constraint fkcliente foreign key (ventaClienteId) references cliente(clienteId),
    constraint fkusuario_2 foreign key (ventaUsuarioId) references usuario(usuarioId),
    constraint fkmoneda_3 foreign key (ventaMonedaId) references moneda(monedaId),
    constraint fkdocumento_2 foreign key (ventaDocumentoId) references documento(documentoId)
)

create table detallecompra(
    detallecompraId int(11) not null primary key auto_increment,
    detallecompraCompraId int(11) not null,
    detallecompraProductoId int(11) not null,
    detallecompraProductoPrecioCompra numeric(9,2) not null,,
    detallecompraCantidad int(11) not null,
    detallecompraTotal numeric(9,2) not null,
    detallecompraFechaCreacion datetime,
    detallecompraEstado int(11)DEFAULT null,
    constraint fkcompra foreign key (detallecompraCompraId) references compra(compraId),
    constraint fkproducto foreign key (detallecompraProductoId) references producto(productoId),
)

create table detalleventa(
    detalleventaId int(11) NOT NULL primary key auto_increment,
    detalleventaVentaId int(11) NOT NULL,
    detalleventaProductoId int(11) NOT NULL,
    detalleventaProductoPrecioVenta numeric(9,2) NOT NULL,
    detalleventaCantidad int(11) not NULL,
    detalleventaTotal numeric(9,2) not null,
    detalleventaFechaCreacion datetime,
    detalleventaEstado int(11) DEFAULT null,
    constraint fkcompra_2 foreign key (detalleventaVentaId) references compra(compraId),
    constraint fkproducto_2 foreign key (detalleventaProductoId) references producto(productoId),
)