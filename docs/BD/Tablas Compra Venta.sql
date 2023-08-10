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
    clientedDireccion varchar(100) not null,
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