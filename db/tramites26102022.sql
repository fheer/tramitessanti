/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.4.22-MariaDB : Database - tramites
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tramites` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `tramites`;

/*Table structure for table `actividad` */

DROP TABLE IF EXISTS `actividad`;

CREATE TABLE `actividad` (
  `idactividad` int(11) NOT NULL AUTO_INCREMENT,
  `actividad` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `key` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idactividad`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `actividad` */

insert  into `actividad`(`idactividad`,`actividad`,`estado`,`key`) values (1,'Natural',1,''),(2,'Juridica',1,''),(3,'Ninguno',0,''),(4,'Otro',1,'');

/*Table structure for table `cargo` */

DROP TABLE IF EXISTS `cargo`;

CREATE TABLE `cargo` (
  `idcargo` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `key` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idcargo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `cargo` */

insert  into `cargo`(`idcargo`,`cargo`,`estado`,`key`) values (1,'Profesional 1',1,''),(2,'Tecnico 1',1,''),(3,'Ascesor legal',1,''),(4,'Sub Alcalde',1,''),(5,'Ninguno',0,''),(6,'Atención Ventanilla',1,'');

/*Table structure for table `datotecnico` */

DROP TABLE IF EXISTS `datotecnico`;

CREATE TABLE `datotecnico` (
  `iddatotecnico` int(11) NOT NULL AUTO_INCREMENT,
  `zona` varchar(50) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `fecha` date NOT NULL,
  `manzano` varchar(25) NOT NULL,
  `predio` varchar(25) NOT NULL,
  `avaluo` varchar(25) NOT NULL,
  `codigo` varchar(25) NOT NULL,
  `distrito` varchar(25) NOT NULL,
  `subdistrito` varchar(25) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `idpersona` int(11) NOT NULL,
  `idtipotramite` int(11) NOT NULL,
  PRIMARY KEY (`iddatotecnico`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

/*Data for the table `datotecnico` */

insert  into `datotecnico`(`iddatotecnico`,`zona`,`direccion`,`fecha`,`manzano`,`predio`,`avaluo`,`codigo`,`distrito`,`subdistrito`,`estado`,`idpersona`,`idtipotramite`) values (62,'Trojes','Calle Loa y calle Beni 890','2022-10-26','M1','L2','ADFRTT1234','1234FGHYT','D2','SD5',1,9,12);

/*Table structure for table `departamento` */

DROP TABLE IF EXISTS `departamento`;

CREATE TABLE `departamento` (
  `iddepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `key` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`iddepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `departamento` */

insert  into `departamento`(`iddepartamento`,`departamento`,`key`,`estado`) values (1,'Ninguno','1',1);

/*Table structure for table `normalegal` */

DROP TABLE IF EXISTS `normalegal`;

CREATE TABLE `normalegal` (
  `idnormaLegal` int(11) NOT NULL AUTO_INCREMENT,
  `normalegal` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `key` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idnormaLegal`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `normalegal` */

insert  into `normalegal`(`idnormaLegal`,`normalegal`,`key`,`estado`) values (1,'ACD-1230','2y10qsYxjGDwAD.o.EirwR8k1uvvUB2zOQs377m5NROxTom69flBbxUBi',1),(2,'QWE-1242','2y10S4htqstrwZnE4bQLHuzDOCYp.wFPokf9DuIgO2LpSaD6ERq0csHu',1),(3,'ACD-1233','2y10f8yOboFrl4zwwRHQD4ByOwLLtvNcgqD4qcoFy3ajuZrlLy25yZp.',1),(4,'247-RP','2y10Fad1FRngLiImr20ncKdHAe1O2z3yu3taDMH37YnsfVQB4yGPvtL.',1),(9,'271-RP','2y10J6D.DfyNXevv12Cc72yBq.DRwtBmhESKTQMEMTTWMCSfo5HlI4li',1),(10,'45-LP','2y10FkQ8jQQkaVUfjoJruZ5s1.mtJs8DFyjmsNdhpxC.KxzGajobYj3I2',1),(11,'asd-24234234','2y10R7nSF97N6FcpOApM0ynxWuuq7cC1jaJJ.20LNQZ51YNdrK8Zksqji',1);

/*Table structure for table `observacion` */

DROP TABLE IF EXISTS `observacion`;

CREATE TABLE `observacion` (
  `idobservacion` int(11) NOT NULL AUTO_INCREMENT,
  `observaciones` text NOT NULL DEFAULT 'Ninguna',
  `idtramite` int(11) NOT NULL,
  `idpersonatramite` int(11) NOT NULL,
  PRIMARY KEY (`idobservacion`),
  KEY `fk_obsevacion_has_tramite_observacion1` (`idtramite`),
  CONSTRAINT `fk_obsevacion_has_tramite_observacion1` FOREIGN KEY (`idtramite`) REFERENCES `tramite` (`idtramite`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;

/*Data for the table `observacion` */

insert  into `observacion`(`idobservacion`,`observaciones`,`idtramite`,`idpersonatramite`) values (133,'Inicio trámite Fecha: 10/10/2022',2,0),(141,'Se reviso la documentación no se encontraron irregularidades, se paso el tramite al Tecnico 1',2,0),(146,'Inicio trámite Fecha: 19/10/2022',7,0),(147,'Inicio trámite Fecha: 19/10/2022',8,0),(148,'Inicio trámite Fecha: 23/10/2022',9,0),(149,'Se cumple con toda la documentación, se paso a la siguente fase con el Tecnico 1',9,0),(152,'Inicio trámite Fecha: 26/10/2022',12,0),(153,'Cumple con toda la documentación el trámote pasa a la siguiente Fase con el Tecnico 1',12,0);

/*Table structure for table `persona` */

DROP TABLE IF EXISTS `persona`;

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `ci` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoPaterno` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidoMaterno` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `genero` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `estadoCivil` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `tipoPersona` tinyint(1) NOT NULL DEFAULT 1,
  `direccion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `key` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `idexpedido` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `idactividad` int(11) NOT NULL,
  `idcargo` int(11) NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `permisos` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(45) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'sinfoto.jpg',
  PRIMARY KEY (`idpersona`),
  KEY `fk_persona_actividad1_idx` (`idactividad`),
  KEY `fk_persona_cargo1_idx` (`idcargo`),
  CONSTRAINT `fk_persona_actividad1` FOREIGN KEY (`idactividad`) REFERENCES `actividad` (`idactividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_cargo1` FOREIGN KEY (`idcargo`) REFERENCES `cargo` (`idcargo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `persona` */

insert  into `persona`(`idpersona`,`ci`,`nombres`,`apellidoPaterno`,`apellidoMaterno`,`genero`,`estadoCivil`,`fechaNacimiento`,`tipoPersona`,`direccion`,`telefono`,`celular`,`key`,`estado`,`idexpedido`,`idactividad`,`idcargo`,`usuario`,`clave`,`permisos`,`foto`) values (1,'1234567','Rodrigo','Lozano','Pacheco','M','Soltero(a)','2000-03-01',1,'Av. Pando','4505050','70700011','2y10.ZW740EasHMWyTXRrgMgjOZ0oh80XVrVVfJn9Cw9zrtY7od8IwMFS',1,'CB.',3,5,'RLP1234567','$2y$10$gmUPWkjM6m51RuxdfhxRL.Zesa8arG/d2fhO4ft..rc0SKqHrw4g2','c4ca4238a0b923820dcc509a6f75849b#c81e728d9d4c2f636f067f89cc14862c#eccbc87e4b5ce2fe28308fd9f2a7baf3#a87ff679a2f3e71d9181a67b7542122c#e4da3b7fbbce2345d7772b0674a318d5#1679091c5a880faf6fb5e6087eb1b2dc#','sinfoto.jpg'),(5,'3728230','Mauricio','Lopez','Blanco','M','Soltero(a)','1980-07-08',1,'Av Ayacucho','4505051','79715825','2y10D.pmvh3Xf5i4nL5Nefv.VeFwAg94qKYrBD.bk5GJYUJgDr8qFdRCe',1,'LP.',3,5,'MLB3728230','$2y$10$bczbWJ5eu/qeu6/rsisEuumVbYjhkr/zQ171YpAQ4VM4PlNQlHity','a87ff679a2f3e71d9181a67b7542122c#','sinfoto.jpg'),(9,'3728231','Mariel','Sanchez','Rojas','F','Casado(a)','1999-10-10',2,'Calle Loa y calle Beni','4252525','79715824','2y10LHBqwnBAqsmUO5m4ZJU6fO9NXuieZntbXLByGp3h4GcNBZi4ZeYHm',1,'TJ.',3,6,'MSR3728231','$2y$10$zF76IIDGN6O6VbmZnlsvP.GA0N8WPXz.ppkCEZ09P7wEtTWlmVPR6','eccbc87e4b5ce2fe28308fd9f2a7baf3#a87ff679a2f3e71d9181a67b7542122c#','sinfoto.jpg'),(10,'3728232','Eiver','Castro','Sanches','M','Casado(a)','1989-12-12',2,'Calle Loa y calle Beni # 200','4252525','79715825','2y101QuF2tnVZ0AT1rHvHQMr.psXSDSdEF6jUePGzEjD9czp.0CErbG',1,'BN.',3,3,'ECS3728232','$2y$10$NiLzks8LFMaTRHsMLItXEeZwrnuBaST04XgFIUwG/WePWNarRyhse','a87ff679a2f3e71d9181a67b7542122c#','7821.jpg'),(11,'13473393','Santiago','Terrazas','Rubio','M','Soltero(a)','1999-06-24',2,'Av Ayacucho','4504040','79715824','2y10ArAoFDC1H77wqsb731.7FuV3ECVrhKfenpoyyiQmugNWsBIsjp7Lu',1,'BN.',3,2,'STR13473393','$2y$10$gRjwDxiOBlc2gV4qveWev.bc8.W/khiqHvENMSb0cesmGGiXY3DhG','a87ff679a2f3e71d9181a67b7542122c#1679091c5a880faf6fb5e6087eb1b2dc#','sinfoto.jpg'),(14,'7654321','Federico','Alvarez','Plata','M','Casado(a)','1986-08-02',1,'Av Ayacucho','4504040','79715824','2y101lGjbhedzREpSd030JpoMeT11VSobySpNtOu5sShkfigSsd9ux6y',1,'LP.',1,5,'FAP7654321','$2y$10$XBofOfmtNjtSsc1/5i9Ag.8h6PwH683W6iTfIxwPqvWDXcFZUTm1.','a87ff679a2f3e71d9181a67b7542122c#1679091c5a880faf6fb5e6087eb1b2dc#','sinfoto.jpg');

/*Table structure for table `personatramite` */

DROP TABLE IF EXISTS `personatramite`;

CREATE TABLE `personatramite` (
  `idpersonatramite` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `idtramite` int(11) NOT NULL,
  `idfuncionario` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `pdf` varchar(125) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idpersonatramite`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `personatramite` */

insert  into `personatramite`(`idpersonatramite`,`idpersona`,`idtramite`,`idfuncionario`,`fechaInicio`,`fechaFin`,`activo`,`pdf`) values (1,5,2,10,'2022-10-10','2022-10-17',0,'declaracion-15369014.pdf'),(2,5,2,11,'2022-10-17',NULL,1,'declaracion-15369015.pdf'),(7,9,7,10,'2022-10-19','2022-11-28',1,''),(8,1,8,10,'2022-10-19','2022-11-28',1,''),(9,1,9,10,'2022-10-23','2022-10-24',0,'declaracion-1536902.pdf'),(10,1,9,11,'2022-10-24',NULL,1,'declaracion-15369016.pdf'),(13,9,12,10,'2022-10-26','2022-10-26',0,'Sistema_de_Ahorro1.pdf'),(14,9,12,11,'2022-10-26',NULL,1,'Sistema_de_Ahorro2.pdf');

/*Table structure for table `requisito` */

DROP TABLE IF EXISTS `requisito`;

CREATE TABLE `requisito` (
  `idrequisito` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRequisito` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `key` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idrequisito`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `requisito` */

insert  into `requisito`(`idrequisito`,`nombreRequisito`,`descripcion`,`key`,`estado`) values (1,'Fotocopia de reporte de registro de contribuyente','Fotocopia de reporte de registro de contribuyente','2y10tR1eqvmS0Wp0OCM4buWcwedz92riiOFL4kaw.wRDID9QuJ0uDyN.C',1),(2,'Fotocopia de cédula de identidad (Blanco y negro legible)','Ninguna','2',1),(3,'Plano de funcionamiento','Ninguna','3',1),(4,'Contrato con EMSA (Original y Fotocopia)','Ninguna','4',1),(5,'Contrato con SEMAPA (Original y Fotocopia)','Ninguna','5',1),(6,'Plano de la estructura del bien inmueble, aprobado por el Gobierno Autónomo Municipal de Cochabamba (Original y Fotocopia)','Ninguna','6',1),(7,'Original y fotocopia de ficha o manifiesto ambiental, licencia ambiental o registro ambiental industrial','Ninguna','7',1),(8,'Formulario virtual de Declaración Jurada – Otorgación de Licencia de Funcionamiento','Ninguna','8',1),(9,'Fotocopia a color de cédula de identidad, pasaporte','Ninguna','9',1),(10,'Fotografía 3x3 fondo rojo','Ninguna','0',1),(11,'Fotocopia a solo Pasaporte o fotocopia a color de cédula de identidad de extranjero expedido en Bolivia','Ninguna','11',1),(12,'Acta o Testimonio de Constitución','Ninguna','12',1),(13,'Poder de representante legal','Ninguna','11111',1),(14,'Fotocopia del NIT','Ninguna','14',1),(15,'Fotocopia de la cédula de identidad del representante legal','Ninguna','15',1),(16,'Minuta de compra y venta del bien inmueble con reconocimiento de firmas','Ninguna','16',1),(17,'Visación de la minuta en la respectiva Sub Alcaldía','Ninguna','17',1),(18,'Plano del bien inmueble, aprobado por la Sub Alcaldía','Ninguna','18',1),(19,'Comprobante de pago de impuestos de los últimos 5 años (original y fotocopia)','Ninguna','19',1),(20,'Título de propiedad (original y fotocopia)','Ninguna','20',1),(21,'Comprobantes de pago de todos los impuestos a la propiedad de bienes inmuebles (IMPBI) (originales)','Ninguna','21',1),(22,'Registro Catastral emitido por la Sub Alcaldía correspondiente (original y fotocopia)','Ninguna','22',1),(23,'Certificado de libertad (Folio Real o Partida Literal) emitido por Derechos Reales (original y fotocopia)','Ninguna','23',1),(24,'Minuta de compra y venta (Original y dos copias)','Ninguna','24',1),(25,'Fotocopia Título de Propiedad','Ninguna','25',1),(26,'Declaratoria de herederos, transferencia o anticipo de legítima','Ninguna','26',1),(27,'Solicitud de facilidades de pago (3 copias)','Ninguna','27',1),(28,'Original y fotocopia del NIT de la entidad','Ninguna','28',1),(29,'Original y fotocopia del Plano aprobado del inmueble','Ninguna','29',1),(30,'Original y fotocopia de Título de Propiedad con Folio Real','Ninguna','30',1),(31,'Original y fotocopia de Registro Catastral','Ninguna','31',1),(32,'Original y fotocopia de Certificado de Propiedad – RUA','Ninguna','32',1),(33,'Dos ejemplares del formulario de Declaración Jurada – Baja','Ninguna','33',1),(34,'Original de la Licencia de Funcionamiento','Ninguna','34',1),(35,'Memorial con copia dirigido al Señor Alcalde','Ninguna','35',1),(36,'Papeleta de Pre liquidación o proforma original','Ninguna','36',1),(37,'Copia legalizada del Testimonio de Propiedad o Minuta de Transferencia','Ninguna','37',1),(38,'Fotocopia vigente de Licencia de Funcionamiento de la actividad económica','Ninguna','38',1),(39,'Fotografías del lugar','Ninguna','39',1),(40,'Diseño del anuncio publicitario que se pretende emplazar, especificando dimensiones y materiales a utilizarse.','Ninguna','40',1),(43,'Caratula Notarial','Caratula Notarial','2y10A3GSiJWne1cOiOStDTxLj.FTzJBLJfE96jRRR9cBkJhTzaJnOZngS',1),(47,'Fotocopia CI a color','Fotocopia CI a color','2y106sjlhwrbxJTt7YdgYCS3.P372ahdSYhUJXrT71n0E8b8XmHTtuC6',1);

/*Table structure for table `requisitoimagen` */

DROP TABLE IF EXISTS `requisitoimagen`;

CREATE TABLE `requisitoimagen` (
  `idrequisitoimagen` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(10) NOT NULL,
  `idtramite` int(11) NOT NULL,
  `idrequisito` int(11) NOT NULL,
  PRIMARY KEY (`idrequisitoimagen`),
  KEY `idrequisitoimagen` (`idrequisitoimagen`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Data for the table `requisitoimagen` */

insert  into `requisitoimagen`(`idrequisitoimagen`,`ruta`,`idtramite`,`idrequisito`) values (14,'22.jpg',2,2),(15,'21.jpg',2,1),(22,'32.jpg',3,2),(23,'31.jpg',3,1),(24,'42.jpg',4,2),(25,'41.jpg',4,1),(26,'52.jpg',5,2),(27,'51.jpg',5,1),(28,'62.jpg',6,2),(29,'61.jpg',6,1),(30,'72.jpg',7,2),(31,'71.jpg',7,1),(32,'82.jpg',8,2),(33,'81.jpg',8,1),(34,'92.jpg',9,2),(35,'91.jpg',9,1),(36,'112.jpg',11,2),(37,'111.jpg',11,1),(38,'122.jpg',12,2),(39,'121.jpg',12,1);

/*Table structure for table `tipotramite` */

DROP TABLE IF EXISTS `tipotramite`;

CREATE TABLE `tipotramite` (
  `idtipotramite` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRequisito` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `tiempoEstimado` int(11) NOT NULL,
  `key` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `idnormaLegal` int(11) NOT NULL,
  PRIMARY KEY (`idtipotramite`),
  KEY `fk_tipoTramite_normaLegal1_idx` (`idnormaLegal`),
  CONSTRAINT `fk_tipoTramite_normaLegal1` FOREIGN KEY (`idnormaLegal`) REFERENCES `normalegal` (`idnormaLegal`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tipotramite` */

insert  into `tipotramite`(`idtipotramite`,`nombreRequisito`,`descripcion`,`tiempoEstimado`,`key`,`estado`,`idnormaLegal`) values (2,'Regularización de Plano','Regularización de Plano',20,'2y10N6lZjKALthKrSL0f1c.VcOurrrLsNFIZxqoGvOkgNq7H2QlsO6ctm',1,4),(3,'Regularización de Plano de Construcción','Regularización de Plano de Construcción',60,'RegularizaciondePlanodeConstruccion',1,1),(9,'Aprobación de Plano de Construcción','Descripción Nuevo tramite',30,'2y107vYNmQqqbSxuAygQiIX5XOygKxNEw4yhuSLGoffIBkTdxRK3uUcK',1,1),(10,'Aprobación de Plano de Lote','Aprobación de Plano de Lote',45,'2y10Bsu.dK7sKAE7YhEPwD0.hFLf0Oxj.EZlqPx2t7faK9htcxXSWP2',1,1),(12,'Cambio de Nombre','Cambio de Nombre',40,'2y10SwJTD6x3Atu7LGLiXeZ.Su753OMucaDLbSoryHsptaT1cV.hF8UUi',1,1);

/*Table structure for table `tipotramiterequisito` */

DROP TABLE IF EXISTS `tipotramiterequisito`;

CREATE TABLE `tipotramiterequisito` (
  `idTipoTramite` int(11) NOT NULL,
  `idrequisito` int(11) NOT NULL,
  PRIMARY KEY (`idTipoTramite`,`idrequisito`),
  KEY `fk_tipoTramite_has_requisito_requisito1_idx` (`idrequisito`),
  KEY `fk_tipoTramite_has_requisito_tipoTramite1_idx` (`idTipoTramite`),
  CONSTRAINT `fk_tipoTramite_has_requisito_requisito1` FOREIGN KEY (`idrequisito`) REFERENCES `requisito` (`idrequisito`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipoTramite_has_requisito_tipoTramite1` FOREIGN KEY (`idTipoTramite`) REFERENCES `tipotramite` (`idtipotramite`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tipotramiterequisito` */

insert  into `tipotramiterequisito`(`idTipoTramite`,`idrequisito`) values (2,1),(2,2),(2,9),(2,10),(2,18),(2,19),(2,20),(2,21),(2,22),(2,24),(2,25),(3,6),(3,7),(3,8),(9,1),(9,3),(9,5),(9,7),(9,9),(10,2),(10,6),(10,9),(10,10),(10,16),(10,17),(10,18),(10,19),(10,20),(10,21),(10,22),(10,24),(10,25),(10,29),(10,30),(10,31),(12,1),(12,2);

/*Table structure for table `tramite` */

DROP TABLE IF EXISTS `tramite`;

CREATE TABLE `tramite` (
  `idtramite` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `requisitos` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `latitud` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `longitud` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `key` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idtipotramite` int(11) NOT NULL,
  PRIMARY KEY (`idtramite`),
  KEY `fk_tramite_tipoTramite1_idx` (`idtipotramite`),
  CONSTRAINT `fk_tramite_tipoTramite1` FOREIGN KEY (`idTipoTramite`) REFERENCES `tipotramite` (`idtipotramite`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `tramite` */

insert  into `tramite`(`idtramite`,`codigo`,`fechaRegistro`,`fechaActualizacion`,`fechaInicio`,`fechaFin`,`requisitos`,`direccion`,`estado`,`latitud`,`longitud`,`key`,`idusuario`,`idtipotramite`) values (2,'CDN-1000','2022-10-10 16:00:09',NULL,'2022-10-10','2022-10-10','Fotocopia de cédula de identidad (Blanco y negro legible)#Fotocopia de reporte de registro de contribuyente#','Calle Loa y calle Beni 890',1,'-17.33713899810084','-66.22065526198283','2y10WWqYOiTrkaH83BOIhfqyBuKz.Qeky047STrjQ0rLpg8tB6YGM7P6.',1,12),(7,'CDN-1001','2022-10-19 15:29:39',NULL,'2022-10-19','2022-11-28','Fotocopia de cédula de identidad (Blanco y negro legible)#Fotocopia de reporte de registro de contribuyente#','Calle Loa y calle Beni # 1234444',1,'-17.33068168071941','-66.21858861844127','2y10D4dSyUF7iHHbFukSK7XQuJd62QbmpRcZ8qjA5qjcMTkVfhFp0I06',1,12),(8,'CDN-1002','2022-10-19 19:04:56',NULL,'2022-10-19','2022-11-28','Fotocopia de cédula de identidad (Blanco y negro legible)#Fotocopia de reporte de registro de contribuyente#','Calle Loa y calle Beni # 1234444',1,'-17.32586798973649','-66.21858859901458','2y10H2hu2e34xb07zAPP7uYncOSgS1UGy4aCAV0mq0Pa1r4VCXvp5ndj2',1,12),(9,'CDN-1003','2022-10-23 22:22:22',NULL,'2022-10-23','2022-12-02','Fotocopia de cédula de identidad (Blanco y negro legible)#Fotocopia de reporte de registro de contribuyente#','Calle Loa y calle Beni # 1234444',1,'-17.32371032225108','-66.22019974103905','2y10pv.g6yID5GVhBMhUW6Keel0qRoixHN5bRa6kwxoP8oIwBlfL0oa',9,12),(12,'CDN-1004','2022-10-26 09:37:29',NULL,'2022-10-26','2022-12-05','Fotocopia de cédula de identidad (Blanco y negro legible)#Fotocopia de reporte de registro de contribuyente#','Calle Loa y calle Beni 890',1,'-17.338573642193364','-66.22125020074688','2y10kG17iAoPMC3Vmwv6mdfuuAiQRoTnvBnPcb5JnB11sGUszpZIlg3G',1,12);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
