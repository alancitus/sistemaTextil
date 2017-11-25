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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `almacen` */

insert  into `almacen`(`id`,`Tipo`,`Usuario_id`,`Producto_id`,`ProductoNombre`,`UnidadMedida_id`,`Cantidad`,`Precio`,`Fecha`,`Empresa_id`,`Comprobante_id`) values (37,1,6,11,'[S/M] - Camisa','Unid',20.00,10.00,'2017/10/26',4,NULL),(38,2,6,10,'Chompa','Unid',5.00,100.00,'2017/10/26',4,7),(39,1,6,10,'[S/M] - Chompa','Unid',10.00,10.00,'2017/10/26',4,NULL),(40,2,6,10,'Chompa','Unid',1.00,20.00,'2017/10/26',4,8);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `cliente` */

insert  into `cliente`(`id`,`Ruc`,`Dni`,`Nombre`,`Correo`,`Telefono1`,`Telefono2`,`Direccion`,`Empresa_id`) values (1,'20544593430','41019142','Instituto Trujillo','instituto@aaa.es','56463287','34455555','Calle Trujillo 123',4),(4,'','48019142','Instituto','','8766545','','',4);

/*Table structure for table `compra` */

DROP TABLE IF EXISTS `compra`;

CREATE TABLE `compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mes` int(11) NOT NULL,
  `anho` int(11) NOT NULL,
  `detalle` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `compra` */

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `comprobante` */

insert  into `comprobante`(`id`,`Empresa_id`,`Serie`,`Correlativo`,`Cliente_id`,`ClienteIdentidad`,`ClienteNombre`,`ClienteDireccion`,`ComprobanteTipo_id`,`Estado`,`FechaRegistro`,`FechaEmitido`,`Iva`,`IvaTotal`,`SubTotal`,`Total`,`TotalCompra`,`Ganancia`,`Usuario_id`,`Glosa`,`Impresion`,`UsuarioImprimiendo_id`,`Devolucion`) values (7,4,NULL,NULL,1,'20544593430','Instituto Trujillo','Calle Trujillo 123',3,2,'2017/10/26','2017/10/26',18.00,15.25,84.75,100.00,50.00,50.00,6,'',1,6,0),(8,4,NULL,NULL,4,'48019142','Instituto','',2,2,'2017/10/26','2017/10/26',0.00,0.00,0.00,20.00,10.00,10.00,6,'',0,NULL,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `comprobantedetalle` */

insert  into `comprobantedetalle`(`id`,`Tipo`,`Comprobante_Id`,`Producto_id`,`ProductoNombre`,`PrecioUnitarioCompra`,`PrecioTotalCompra`,`UnidadMedida_id`,`PrecioUnitario`,`PrecioTotal`,`Cantidad`,`Devuelto`,`Ganancia`) values (9,1,7,10,'Chompa',10.00,50.00,'Unid',20.00,100.00,5.00,0.00,50.00),(10,1,8,10,'Chompa',10.00,10.00,'Unid',20.00,20.00,1.00,0.00,10.00);

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

/*Table structure for table `costo` */

DROP TABLE IF EXISTS `costo`;

CREATE TABLE `costo` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Tela` decimal(10,2) DEFAULT NULL,
  `Otros` decimal(10,2) DEFAULT NULL,
  `Hilos` decimal(10,2) DEFAULT NULL,
  `Botones` decimal(10,2) DEFAULT NULL,
  `Broches` decimal(10,2) DEFAULT NULL,
  `Otros_Avios` decimal(10,2) DEFAULT NULL,
  `Mano_Obra` decimal(10,2) DEFAULT NULL,
  `Telefono` decimal(10,2) DEFAULT NULL,
  `Leasing` decimal(10,2) DEFAULT NULL,
  `Tercearizacion` decimal(10,2) DEFAULT NULL,
  `Depreciacion` decimal(10,2) DEFAULT NULL,
  `Packing` decimal(10,2) DEFAULT NULL,
  `Luz` decimal(10,2) DEFAULT NULL,
  `Agua` decimal(10,2) DEFAULT NULL,
  `Bordado` decimal(10,2) DEFAULT NULL,
  `Fusionado` decimal(10,2) DEFAULT NULL,
  `Costo_Produccion` decimal(10,2) DEFAULT NULL,
  `Empresa_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `costo` */

insert  into `costo`(`id`,`Nombre`,`Tela`,`Otros`,`Hilos`,`Botones`,`Broches`,`Otros_Avios`,`Mano_Obra`,`Telefono`,`Leasing`,`Tercearizacion`,`Depreciacion`,`Packing`,`Luz`,`Agua`,`Bordado`,`Fusionado`,`Costo_Produccion`,`Empresa_id`) values (1,'Aaa',12.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4),(19,'Aaa',11.00,22.00,11.00,22.00,1.00,1.00,1.00,2.00,2.00,2.00,2.00,1.00,1.00,1.00,2.00,2.00,NULL,4),(18,'Aa',1.00,1.00,1.00,1.00,2.00,2.00,3.00,NULL,NULL,NULL,NULL,NULL,1.00,1.00,1.00,2.00,NULL,4),(17,'A',1.00,1.00,2.00,1.00,1.00,1.00,NULL,NULL,NULL,NULL,NULL,NULL,1.00,1.00,1.00,1.00,NULL,4),(16,'Aa',1.00,1.00,1.00,1.00,1.00,1.00,NULL,NULL,NULL,NULL,NULL,NULL,1.00,1.00,NULL,NULL,NULL,4),(15,'Aa',1.00,2.00,3.00,4.00,3.00,2.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4),(14,'Sss',1.00,2.00,3.00,3.00,4.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4),(13,'Aaa',2.00,3.00,3.00,4.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4);

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `Estado` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `empresa` */

insert  into `empresa`(`id`,`Nombre`,`Estado`) values (4,'TEXTIL',1);

/*Table structure for table `maquinaria` */

DROP TABLE IF EXISTS `maquinaria`;

CREATE TABLE `maquinaria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `Marca` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `Codigo` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `Motor` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `Empresa_id` int(11) NOT NULL DEFAULT '0',
  `Foto` varchar(50) COLLATE utf16_spanish_ci DEFAULT NULL,
  `Anho` varchar(10) COLLATE utf16_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `maquinaria` */

insert  into `maquinaria`(`id`,`Nombre`,`Marca`,`Codigo`,`Motor`,`Empresa_id`,`Foto`,`Anho`) values (24,'Aaa','aa','Aa','Aa',4,'','2011'),(25,'Maquina De Coser','marca','1233','Motor',4,'25_maquinaria.jpg','1997');

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `menu` */

insert  into `menu`(`id`,`Class`,`Css`,`Nombre`,`Url`,`Padre`,`Orden`,`Separador`) values (1,'inicio','glyphicon-home','Inicio','',0,1,0),(2,'ventas','glyphicon-credit-card','Ventas','#',0,2,0),(3,'mantenimiento','glyphicon-cog','Mantenimiento','#',0,4,0),(4,'','','Comprobantes','ventas/comprobantes',2,1,0),(5,'','','Reportes','ventas/reportes',2,2,1),(6,'','','Usuarios','mantenimiento/usuarios',3,1,0),(7,'','','Clientes','mantenimiento/clientes',3,2,0),(8,'','','Productos','mantenimiento/productos',3,3,0),(9,'','','Servicios','mantenimiento/servicios',3,5,0),(10,'','','Configuración','mantenimiento/configuracion',3,9,1),(11,'','','Copia De Seguridad','respaldo/index',3,10,1),(12,'almacen','glyphicon-th','Almacen','#',0,3,0),(13,'','','Entrada/Salida','almacen/index',12,1,0),(14,'','','Kardex','almacen/kardex',12,2,1),(15,'secuenciaoperaciones','','Secuencia de Operaciones','#',0,5,0),(16,'Procesos','','Procesos','secuenciaoperaciones/procesos',15,1,0),(17,'proyectos','','Proyectos','secuenciaoperaciones/proyectos',15,2,0),(18,'registro','','Registro de Compras y Ventas','#',0,6,0),(19,'Compras','','Compras','registro/compras',18,1,0),(20,'Ventas','','Ventas','registro/ventas',18,2,0),(30,'','','Proveedores','mantenimiento/proveedores',3,4,0),(31,'','','Maquinarias','mantenimiento/maquinarias',3,6,0),(33,'','','Costo de Producción','mantenimiento/costos',3,8,0);

/*Table structure for table `menusuario` */

DROP TABLE IF EXISTS `menusuario`;

CREATE TABLE `menusuario` (
  `UsuarioTipo_id` int(11) NOT NULL,
  `Menu_id` int(11) NOT NULL,
  PRIMARY KEY (`UsuarioTipo_id`,`Menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `menusuario` */

insert  into `menusuario`(`UsuarioTipo_id`,`Menu_id`) values (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,30),(1,31),(1,32),(1,33),(2,1),(2,2),(2,3),(2,4),(2,7),(2,8),(2,9),(2,12),(2,13),(4,1),(4,3),(4,8),(4,9),(4,12),(4,13),(5,1),(5,2),(5,3),(5,4),(5,5),(5,7),(5,8),(5,9),(5,12),(5,13),(5,14);

/*Table structure for table `proceso` */

DROP TABLE IF EXISTS `proceso`;

CREATE TABLE `proceso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf16_spanish_ci NOT NULL DEFAULT '0',
  `fechainicio` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `proceso` */

insert  into `proceso`(`id`,`Nombre`,`fechainicio`,`fechafin`) values (1,'Proceso 1',NULL,NULL);

/*Table structure for table `procesoproyecto` */

DROP TABLE IF EXISTS `procesoproyecto`;

CREATE TABLE `procesoproyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `proceso_id` int(11) NOT NULL,
  `nrooperacion` int(11) DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  `fecha_fin` varchar(10) DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `fecha_real` varchar(10) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `procesoproyecto` */

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
  `Foto` varchar(50) COLLATE utf16_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci CHECKSUM=1;

/*Data for the table `producto` */

insert  into `producto`(`id`,`Nombre`,`UnidadMedida_id`,`PrecioCompra`,`Precio`,`Stock`,`StockMinimo`,`Marca`,`Empresa_id`,`Foto`) values (10,'Chompa','Unid',10.00,20.00,104.00,0.00,'S/M',4,'10_producto.jpg'),(11,'Camisa','Unid',10.00,13.00,120.00,0.00,'S/M',4,'11_producto.jpg'),(12,'Zzz','Unid',2.00,3.00,12.00,0.00,'Ee',4,'12_producto.jpg');

/*Table structure for table `proveedor` */

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `proveedor` */

insert  into `proveedor`(`id`,`Ruc`,`Dni`,`Nombre`,`Correo`,`Telefono1`,`Telefono2`,`Direccion`,`Empresa_id`) values (1,'20544593430','41019142','Proveedor','aaa@aaa.es','12345566','34455555','Zszszszszsz',4),(9,'','','Proveedor4','','','','',4),(11,'','11111111','Aaa','','','','',4);

/*Table structure for table `proyecto` */

DROP TABLE IF EXISTS `proyecto`;

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) DEFAULT NULL,
  `Fecha_inicio` varchar(10) DEFAULT NULL,
  `Fecha_fin` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proyecto` */

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `servicio` */

insert  into `servicio`(`id`,`Nombre`,`PrecioCompra`,`Precio`,`UnidadMedida_id`,`Empresa_id`) values (4,'Tendido',5.00,6.00,'UND',4),(5,'Desenrrollo',5.00,7.00,'UND',4),(6,'Elaboración Del Tizado',3.00,1.00,'UND',4),(7,'Corte',4.00,2.00,'UND',4),(8,'Habilitado',4.00,1.00,'UND',4),(9,'Ensamblaje',4.00,1.00,'UND',4),(10,'Acabados',4.00,1.00,'UND',4),(11,'Control De Calidad',5.00,1.00,'UND',4);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`Tipo`,`Nombre`,`Usuario`,`Contrasena`,`Empresa_id`) values (6,1,'Administrador','demo','e10adc3949ba59abbe56e057f20f883e',4),(10,5,'Super Usuario','super','e10adc3949ba59abbe56e057f20f883e',4),(11,2,'Vendedor','vendedor','e10adc3949ba59abbe56e057f20f883e',4),(12,4,'Almacenero','almacen','e10adc3949ba59abbe56e057f20f883e',4),(13,3,'Suspendido','Suspendido','e10adc3949ba59abbe56e057f20f883e',4),(14,1,'Alan Garcia Sanchez','Alancitus','2743ad68419ee95f7c48a0743b278580',4),(15,1,'Administrador','dubal','e10adc3949ba59abbe56e057f20f883e',5);

/*Table structure for table `venta` */

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mes` int(11) NOT NULL,
  `anho` int(11) NOT NULL,
  `detalle` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `venta` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
