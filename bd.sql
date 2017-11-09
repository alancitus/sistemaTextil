/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.7.14 : Database - textileria
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`textileria` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `textileria`;

/*Table structure for table `almacen` */

DROP TABLE IF EXISTS `almacen`;

CREATE TABLE `almacen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Tipo` tinyint(4) NOT NULL COMMENT '1 Entrada / 2 Salida / 3 Devolucion',
  `Usuario_id` int(11) NOT NULL,
  `Producto_id` int(11) NOT NULL,
  `ProductoNombre` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `UnidadMedida_id` varchar(10) COLLATE utf16_spanish_ci DEFAULT NULL,
  `Cantidad` decimal(10,2) NOT NULL,
  `Precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Fecha` varchar(10) COLLATE utf16_spanish_ci NOT NULL,
  `Empresa_id` int(11) NOT NULL,
  `Comprobante_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `almacen_producto` (`Producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `almacen` */

insert  into `almacen`(`id`,`Tipo`,`Usuario_id`,`Producto_id`,`ProductoNombre`,`UnidadMedida_id`,`Cantidad`,`Precio`,`Fecha`,`Empresa_id`,`Comprobante_id`) values (29,2,6,1,'Camisa','Unida',50.00,750.00,'2017/10/17',4,2),(31,2,6,1,'Camisa','Unida',20.00,300.00,'2017/10/17',4,3),(32,2,6,2,'Pantalon','Und',20.00,400.00,'2017/10/18',4,4),(33,2,6,1,'Camisa','Unida',100.00,1500.00,'2017/10/18',4,4),(34,2,6,3,'Chompas','Unid',3.00,36.00,'2017/10/18',4,4),(35,2,6,1,'Camisa','Unida',1.00,15.00,'2017/10/18',4,5),(36,2,6,3,'Chompas','Unid',1.00,12.00,'2017/10/18',4,6);

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Ruc` varchar(11) COLLATE utf16_spanish_ci DEFAULT NULL,
  `Dni` varchar(8) COLLATE utf16_spanish_ci DEFAULT NULL,
  `Nombre` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `Correo` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `Telefono1` varchar(20) COLLATE utf16_spanish_ci NOT NULL,
  `Telefono2` varchar(20) COLLATE utf16_spanish_ci NOT NULL,
  `Direccion` text COLLATE utf16_spanish_ci NOT NULL,
  `Empresa_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `cliente` */

insert  into `cliente`(`id`,`Ruc`,`Dni`,`Nombre`,`Correo`,`Telefono1`,`Telefono2`,`Direccion`,`Empresa_id`) values (1,'20544593430','41019142','Cliente','aaa@aaa.es','12345566','34455555','Zszszszszsz',4);

/*Table structure for table `comprobante` */

DROP TABLE IF EXISTS `comprobante`;

CREATE TABLE `comprobante` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Empresa_id` int(11) NOT NULL DEFAULT '0',
  `Serie` varchar(5) COLLATE utf16_spanish_ci DEFAULT NULL,
  `Correlativo` varchar(20) COLLATE utf16_spanish_ci DEFAULT NULL,
  `Cliente_id` int(11) NOT NULL DEFAULT '0',
  `ClienteIdentidad` varchar(11) COLLATE utf16_spanish_ci DEFAULT '',
  `ClienteNombre` varchar(100) COLLATE utf16_spanish_ci NOT NULL DEFAULT '',
  `ClienteDireccion` text COLLATE utf16_spanish_ci,
  `ComprobanteTipo_id` tinyint(4) NOT NULL DEFAULT '0',
  `Estado` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 Pendiente 2 Aprobada 3 Anulada',
  `FechaRegistro` varchar(10) COLLATE utf16_spanish_ci NOT NULL DEFAULT '0',
  `FechaEmitido` varchar(10) COLLATE utf16_spanish_ci NOT NULL DEFAULT '0',
  `Iva` decimal(10,2) NOT NULL DEFAULT '0.00',
  `IvaTotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `SubTotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `TotalCompra` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Ganancia` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Usuario_id` int(11) NOT NULL DEFAULT '0',
  `Glosa` text COLLATE utf16_spanish_ci,
  `Impresion` tinyint(4) NOT NULL DEFAULT '0',
  `UsuarioImprimiendo_id` int(11) DEFAULT NULL,
  `Devolucion` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 Pendiente 1 Cerrado',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Serie_Correlativo_Empresa_id` (`Serie`,`Correlativo`,`Empresa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `comprobante` */

insert  into `comprobante`(`id`,`Empresa_id`,`Serie`,`Correlativo`,`Cliente_id`,`ClienteIdentidad`,`ClienteNombre`,`ClienteDireccion`,`ComprobanteTipo_id`,`Estado`,`FechaRegistro`,`FechaEmitido`,`Iva`,`IvaTotal`,`SubTotal`,`Total`,`TotalCompra`,`Ganancia`,`Usuario_id`,`Glosa`,`Impresion`,`UsuarioImprimiendo_id`,`Devolucion`) values (1,4,NULL,'00001',1,'20544593430','Cliente','Zszszszszsz',1,2,'2017/10/17','2017/10/17',0.00,0.00,0.00,300.00,240.00,60.00,6,'',0,NULL,0),(2,4,NULL,NULL,1,'41019142','Cliente','Zszszszszsz',2,2,'2017/10/17','2017/10/17',0.00,0.00,0.00,750.00,600.00,150.00,6,'',0,NULL,0),(3,4,'002','00002',1,'20544593430','Cliente','Zszszszszsz',3,2,'2017/10/17','2017/10/17',18.00,45.76,254.24,300.00,240.00,60.00,6,'',2,NULL,0),(4,4,NULL,NULL,1,'41019142','Cliente','Zszszszszsz',2,2,'2017/10/18','2017/10/18',0.00,0.00,0.00,1936.00,1415.00,521.00,6,'',0,NULL,0),(5,4,NULL,'00001',1,'20544593430','Cliente','Zszszszszsz',4,2,'2017/10/18','2017/10/18',0.00,0.00,0.00,15.00,12.00,3.00,6,'',0,NULL,0),(6,4,'002','00003',1,'20544593430','Cliente','Zszszszszsz',3,2,'2017/10/18','2017/10/18',18.00,1.83,10.17,12.00,5.00,7.00,6,'',2,NULL,0);

/*Table structure for table `comprobantedetalle` */

DROP TABLE IF EXISTS `comprobantedetalle`;

CREATE TABLE `comprobantedetalle` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Tipo` tinyint(4) DEFAULT NULL COMMENT '1 Producto / 2 Servicio',
  `Comprobante_Id` bigint(20) NOT NULL DEFAULT '0',
  `Producto_id` int(11) NOT NULL DEFAULT '0',
  `ProductoNombre` varchar(100) COLLATE utf16_spanish_ci DEFAULT NULL,
  `PrecioUnitarioCompra` decimal(10,2) NOT NULL DEFAULT '0.00',
  `PrecioTotalCompra` decimal(10,2) NOT NULL DEFAULT '0.00',
  `UnidadMedida_id` char(10) COLLATE utf16_spanish_ci NOT NULL DEFAULT '0',
  `PrecioUnitario` decimal(10,2) NOT NULL DEFAULT '0.00',
  `PrecioTotal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Cantidad` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Devuelto` decimal(10,2) DEFAULT '0.00',
  `Ganancia` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `comprobantedetalle` */

insert  into `comprobantedetalle`(`id`,`Tipo`,`Comprobante_Id`,`Producto_id`,`ProductoNombre`,`PrecioUnitarioCompra`,`PrecioTotalCompra`,`UnidadMedida_id`,`PrecioUnitario`,`PrecioTotal`,`Cantidad`,`Devuelto`,`Ganancia`) values (1,1,1,1,'Camisa',12.00,240.00,'Unida',15.00,300.00,20.00,0.00,60.00),(2,1,2,1,'Camisa',12.00,600.00,'Unida',15.00,750.00,50.00,0.00,150.00),(3,1,3,1,'Camisa',12.00,240.00,'Unida',15.00,300.00,20.00,0.00,60.00),(4,1,4,2,'Pantalon',10.00,200.00,'Und',20.00,400.00,20.00,0.00,200.00),(5,1,4,1,'Camisa',12.00,1200.00,'Unida',15.00,1500.00,100.00,0.00,300.00),(6,1,4,3,'Chompas',5.00,15.00,'Unid',12.00,36.00,3.00,0.00,21.00),(7,1,5,1,'Camisa',12.00,12.00,'Unida',15.00,15.00,1.00,0.00,3.00),(8,1,6,3,'Chompas',5.00,5.00,'Unid',12.00,12.00,1.00,0.00,7.00);

/*Table structure for table `configuracion` */

DROP TABLE IF EXISTS `configuracion`;

CREATE TABLE `configuracion` (
  `Empresa_id` int(11) NOT NULL,
  `RazonSocial` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `Ruc` varchar(11) COLLATE utf16_spanish_ci NOT NULL,
  `Direccion` text COLLATE utf16_spanish_ci,
  `Iva` decimal(4,2) NOT NULL,
  `Moneda_id` varchar(10) COLLATE utf16_spanish_ci NOT NULL,
  `SBoleta` varchar(5) COLLATE utf16_spanish_ci NOT NULL,
  `NBoleta` varchar(20) COLLATE utf16_spanish_ci NOT NULL,
  `SFactura` varchar(5) COLLATE utf16_spanish_ci NOT NULL,
  `NFactura` varchar(20) COLLATE utf16_spanish_ci NOT NULL,
  `BoletaFormato` text COLLATE utf16_spanish_ci NOT NULL,
  `FacturaFormato` text COLLATE utf16_spanish_ci NOT NULL,
  `BoletaFoto` varchar(50) COLLATE utf16_spanish_ci DEFAULT NULL,
  `FacturaFoto` varchar(50) COLLATE utf16_spanish_ci DEFAULT NULL,
  `Lineas` tinyint(4) NOT NULL DEFAULT '15',
  `Impresion` tinyint(4) NOT NULL DEFAULT '1',
  `Zeros` tinyint(4) DEFAULT '5',
  `Anio` int(4) DEFAULT '2013',
  PRIMARY KEY (`Empresa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `configuracion` */

insert  into `configuracion`(`Empresa_id`,`RazonSocial`,`Ruc`,`Direccion`,`Iva`,`Moneda_id`,`SBoleta`,`NBoleta`,`SFactura`,`NFactura`,`BoletaFormato`,`FacturaFormato`,`BoletaFoto`,`FacturaFoto`,`Lineas`,`Impresion`,`Zeros`,`Anio`) values (4,'Textil','12345678978','Trujillo',18.00,'S/.','002','14','002','4','#fecha?left: 674px; top: 58px;|#cliente?left: 94px; top: 105px;|#ruc?left: 94px; top: 196px;|#direccion?left: 93px; top: 134px;|#serie?left: 674px; top: 41px;|#SubTotal?left: 708px; top: 413px;|#total?left: 701px; top: 429px;|#TotalLetras?left: 175px; top: 472px;|#IvaTotal?left: 220px; top: 474px;|#Iva?left: 743px; top: 406px;|#detalle?left: 23px; top: 214px;|#detalle .row?width: 74px;!width: 428px;!width: 107px;!width: 110px;','#fecha?left: 674px; top: 219px;|#cliente?left: 94px; top: 159px;|#ruc?left: 93px; top: 215px;|#direccion?left: 94px; top: 189px;|#serie?left: 650px; top: 110px;|#SubTotal?left: 691px; top: 490px;|#total?left: 686px; top: 533px;|#TotalLetras?left: 72px; top: 481px;|#IvaTotal?left: 695px; top: 512px;|#Iva?left: 602px; top: 511px;|#detalle?left: 2px; top: 250px;|#detalle .row?width: 74px;!width: 428px;!width: 107px;!width: 110px;','4_boleta.jpg','4_factura.jpg',15,1,5,2013);

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `Estado` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `empresa` */

insert  into `empresa`(`id`,`Nombre`,`Estado`) values (4,'TEXTIL',1);

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Class` varchar(50) COLLATE utf16_spanish_ci NOT NULL DEFAULT '',
  `Css` varchar(50) COLLATE utf16_spanish_ci NOT NULL DEFAULT '',
  `Nombre` varchar(50) COLLATE utf16_spanish_ci NOT NULL DEFAULT '0',
  `Url` varchar(100) COLLATE utf16_spanish_ci NOT NULL DEFAULT '',
  `Padre` int(11) NOT NULL DEFAULT '0',
  `Orden` tinyint(4) DEFAULT '1',
  `Separador` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `menu` */

insert  into `menu`(`id`,`Class`,`Css`,`Nombre`,`Url`,`Padre`,`Orden`,`Separador`) values (1,'inicio','glyphicon-home','Inicio','',0,1,0),(2,'ventas','glyphicon-credit-card','Ventas','#',0,2,0),(3,'mantenimiento','glyphicon-cog','Mantenimiento','#',0,4,0),(4,'','','Comprobantes','ventas/comprobantes',2,1,0),(5,'','','Reportes','ventas/reportes',2,2,1),(6,'','','Usuarios','mantenimiento/usuarios',3,1,0),(7,'','','Clientes','mantenimiento/clientes',3,2,0),(8,'','','Productos','mantenimiento/productos',3,3,0),(9,'','','Servicios','mantenimiento/servicios',3,4,0),(10,'','','Configuración','mantenimiento/configuracion',3,6,1),(11,'','','Copia De Seguridad','respaldo/index',3,5,1),(12,'almacen','glyphicon-th','Almacen','#',0,3,0),(13,'','','Entrada/Salida','almacen/index',12,1,0),(14,'','','Kardex','almacen/kardex',12,2,1);

/*Table structure for table `menusuario` */

DROP TABLE IF EXISTS `menusuario`;

CREATE TABLE `menusuario` (
  `UsuarioTipo_id` int(11) NOT NULL,
  `Menu_id` int(11) NOT NULL,
  PRIMARY KEY (`UsuarioTipo_id`,`Menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `menusuario` */

insert  into `menusuario`(`UsuarioTipo_id`,`Menu_id`) values (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(2,1),(2,2),(2,3),(2,4),(2,7),(2,8),(2,9),(2,12),(2,13),(4,1),(4,3),(4,8),(4,9),(4,12),(4,13),(5,1),(5,2),(5,3),(5,4),(5,5),(5,7),(5,8),(5,9),(5,12),(5,13),(5,14);

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `UnidadMedida_id` char(5) COLLATE utf16_spanish_ci NOT NULL,
  `PrecioCompra` decimal(10,2) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Stock` decimal(10,2) NOT NULL DEFAULT '0.00',
  `StockMinimo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Marca` varchar(50) COLLATE utf16_spanish_ci NOT NULL,
  `Empresa_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci CHECKSUM=1;

/*Data for the table `producto` */

insert  into `producto`(`id`,`Nombre`,`UnidadMedida_id`,`PrecioCompra`,`Precio`,`Stock`,`StockMinimo`,`Marca`,`Empresa_id`) values (1,'Camisa','Unida',12.00,15.00,819.00,0.00,'S/M',4),(2,'Pantalon','Und',10.00,20.00,80.00,0.00,'S/M',4),(3,'Chompas','Unid',5.00,12.00,46.00,10.00,'S/M',4);

/*Table structure for table `servicio` */

DROP TABLE IF EXISTS `servicio`;

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf16_spanish_ci NOT NULL DEFAULT '0',
  `PrecioCompra` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `UnidadMedida_id` char(5) COLLATE utf16_spanish_ci NOT NULL DEFAULT 'UND',
  `Empresa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `servicio` */

/*Table structure for table `tabladato` */

DROP TABLE IF EXISTS `tabladato`;

CREATE TABLE `tabladato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Relacion` varchar(20) COLLATE utf16_spanish_ci NOT NULL DEFAULT '0',
  `Value` varchar(10) COLLATE utf16_spanish_ci NOT NULL DEFAULT '0',
  `Nombre` varchar(50) COLLATE utf16_spanish_ci NOT NULL DEFAULT '0',
  `Orden` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `tabladato` */

insert  into `tabladato`(`id`,`Relacion`,`Value`,`Nombre`,`Orden`) values (1,'comprobantetipo','1','Proforma',1),(2,'comprobantetipo','2','Boleta',2),(3,'comprobantetipo','3','Factura',3),(5,'comprobanteestado','2','Aprobado',1),(6,'comprobanteestado','3','Anulado',2),(7,'comprobantetipo','4','Menudeo',3),(8,'moneda','S/.','Nuevo Soles',1),(9,'comprobanteestado','1','Pendiente',1),(10,'comprobanteestado','4','Revisión',2),(11,'usuariotipo','1','Administrador',1),(12,'usuariotipo','2','Vendedor',3),(13,'usuariotipo','3','Suspendido',5),(14,'estilo','light','Light Theme',0),(15,'estilo','dark','Dark Theme',0),(16,'almacentipo','1','Entrada',0),(17,'almacentipo','2','Salida',0),(18,'almacentipo','3','Devolución',0),(19,'usuariotipo','4','Almacenero',4),(20,'usuariotipo','5','Super Usuario',2);

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` int(11) NOT NULL DEFAULT '2' COMMENT '1 Administrador 2 Vendedor 3 Suspendido',
  `Nombre` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `Usuario` varchar(20) COLLATE utf16_spanish_ci NOT NULL,
  `Contrasena` varchar(32) COLLATE utf16_spanish_ci NOT NULL,
  `Empresa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`Tipo`,`Nombre`,`Usuario`,`Contrasena`,`Empresa_id`) values (6,1,'Administrador','demo','e10adc3949ba59abbe56e057f20f883e',4),(10,5,'Super Usuario','super','e10adc3949ba59abbe56e057f20f883e',4),(11,2,'Vendedor','vendedor','e10adc3949ba59abbe56e057f20f883e',4),(12,4,'Almacenero','almacen','e10adc3949ba59abbe56e057f20f883e',4),(13,3,'Suspendido','Suspendido','e10adc3949ba59abbe56e057f20f883e',4),(14,1,'Alan Garcia Sanchez','Alancitus','2743ad68419ee95f7c48a0743b278580',4),(15,1,'Administrador','dubal','e10adc3949ba59abbe56e057f20f883e',5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
