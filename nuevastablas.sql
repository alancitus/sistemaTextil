-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: textileria
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

INSERT INTO `menu` (`id`,`Class`,`Css`,`Nombre`,`Url`,`Padre`,`Orden`,`Separador`) VALUES (15,'secuenciaoperaciones','','Secuencia de Operaciones','#',0,5,0);
INSERT INTO `menu` (`id`,`Class`,`Css`,`Nombre`,`Url`,`Padre`,`Orden`,`Separador`) VALUES (16,'Procesos','','Procesos','secuenciaoperaciones/procesos',15,1,0);
INSERT INTO `menu` (`id`,`Class`,`Css`,`Nombre`,`Url`,`Padre`,`Orden`,`Separador`) VALUES (17,'proyectos','','Proyectos','secuenciaoperaciones/proyectos',15,2,0);
INSERT INTO `menusuario` (`UsuarioTipo_id`,`Menu_id`) VALUES (1,15);
INSERT INTO `menusuario` (`UsuarioTipo_id`,`Menu_id`) VALUES (1,16);
INSERT INTO `menusuario` (`UsuarioTipo_id`,`Menu_id`) VALUES (1,17);
--
-- Table structure for table `proceso`
--

DROP TABLE IF EXISTS `proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proceso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf16_spanish_ci NOT NULL DEFAULT '0',
  `fechainicio` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `procesoproyecto`
--

DROP TABLE IF EXISTS `procesoproyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) DEFAULT NULL,
  `Fecha_inicio` varchar(10) DEFAULT NULL,
  `Fecha_fin` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-13  1:22:11

INSERT INTO `menu` (`id`,`Class`,`Css`,`Nombre`,`Url`,`Padre`,`Orden`,`Separador`) VALUES (18,'registro','','Registro de Compras y Ventas','#',0,6,0);
INSERT INTO `menu` (`id`,`Class`,`Css`,`Nombre`,`Url`,`Padre`,`Orden`,`Separador`) VALUES (19,'Compras','','Compras','registro/compras',18,1,0);
INSERT INTO `menu` (`id`,`Class`,`Css`,`Nombre`,`Url`,`Padre`,`Orden`,`Separador`) VALUES (20,'Ventas','','Ventas','registro/ventas',18,2,0);
INSERT INTO `menusuario` (`UsuarioTipo_id`,`Menu_id`) VALUES (1,18);
INSERT INTO `menusuario` (`UsuarioTipo_id`,`Menu_id`) VALUES (1,19);
INSERT INTO `menusuario` (`UsuarioTipo_id`,`Menu_id`) VALUES (1,20);