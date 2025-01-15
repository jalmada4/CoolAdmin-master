/*
SQLyog Community v12.5.1 (64 bit)
MySQL - 8.3.0 : Database - taller_pro
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`taller_pro` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `taller_pro`;

/*Table structure for table `caja` */

DROP TABLE IF EXISTS `caja`;

CREATE TABLE `caja` (
  `id_caja` int NOT NULL,
  `id_aper_cierre` int NOT NULL,
  `caja_descrip` varchar(25) NOT NULL,
  PRIMARY KEY (`id_caja`),
  KEY `apert_cierre_caja_fk` (`id_aper_cierre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `caja` */

insert  into `caja`(`id_caja`,`id_aper_cierre`,`caja_descrip`) values 
(1,1,'caja1'),
(2,2,'caja2'),
(3,1,'caja 3');

/*Table structure for table `caja_apertura_cierre` */

DROP TABLE IF EXISTS `caja_apertura_cierre`;

CREATE TABLE `caja_apertura_cierre` (
  `cod_apertura_cierre` int NOT NULL,
  `id_user` int NOT NULL,
  `fecha_apertura` date NOT NULL,
  `hora_apertura` time NOT NULL,
  `fecha_cierre` date NOT NULL,
  `hora_cierre` time NOT NULL,
  `monto_apertura` int NOT NULL,
  `monto_cierre` int NOT NULL,
  `estado` varchar(12) NOT NULL,
  `id_caja` int DEFAULT NULL,
  PRIMARY KEY (`cod_apertura_cierre`),
  KEY `usuario_caja_fk` (`id_user`),
  KEY `fk_id_caja` (`id_caja`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `caja_apertura_cierre` */

insert  into `caja_apertura_cierre`(`cod_apertura_cierre`,`id_user`,`fecha_apertura`,`hora_apertura`,`fecha_cierre`,`hora_cierre`,`monto_apertura`,`monto_cierre`,`estado`,`id_caja`) values 
(3,1,'2025-01-14','18:26:00','2025-01-14','21:27:49',50000,59000,'Cerrado',1),
(2,1,'2025-01-09','15:01:00','2025-01-09','18:05:19',10000,124000,'Cerrado',2),
(1,1,'2025-01-09','14:23:00','2025-01-09','17:27:43',40000,145000,'Cerrado',1);

/*Table structure for table `chofer` */

DROP TABLE IF EXISTS `chofer`;

CREATE TABLE `chofer` (
  `id_chofer` int NOT NULL,
  `chof_nombre` varchar(20) NOT NULL,
  `chof_apellido` varchar(20) NOT NULL,
  `chof_cedula` int NOT NULL,
  `chof_telefono` varchar(15) NOT NULL,
  `licencia` varchar(20) NOT NULL,
  `estado` varchar(15) NOT NULL,
  PRIMARY KEY (`id_chofer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `chofer` */

insert  into `chofer`(`id_chofer`,`chof_nombre`,`chof_apellido`,`chof_cedula`,`chof_telefono`,`licencia`,`estado`) values 
(1,'José','Lopez',1234560,'00112233','999888777','activo'),
(2,'Luis ','Rolon',2222,'222222','2222','activo');

/*Table structure for table `ciudad` */

DROP TABLE IF EXISTS `ciudad`;

CREATE TABLE `ciudad` (
  `cod_ciudad` int NOT NULL,
  `id_departamento` int NOT NULL,
  `descrip_ciudad` varchar(25) NOT NULL,
  PRIMARY KEY (`cod_ciudad`),
  KEY `departamento_ciudad_fk` (`id_departamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `ciudad` */

insert  into `ciudad`(`cod_ciudad`,`id_departamento`,`descrip_ciudad`) values 
(1,1,'San Lorenzo'),
(2,2,'Itacurubi'),
(3,3,'Encarnación'),
(4,4,'Paraguari');

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id_cliente` int NOT NULL,
  `cod_ciudad` int NOT NULL,
  `ci_ruc` varchar(10) NOT NULL,
  `cli_nombre` varchar(30) NOT NULL,
  `cli_apellido` varchar(50) NOT NULL,
  `cli_direccion` varchar(50) DEFAULT NULL,
  `cli_telefono` int DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `clientes_idx` (`ci_ruc`),
  KEY `ciudad_clientes_fk` (`cod_ciudad`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`id_cliente`,`cod_ciudad`,`ci_ruc`,`cli_nombre`,`cli_apellido`,`cli_direccion`,`cli_telefono`) values 
(1,1,'0044','jesus','almada','km 20 ruta 2 ',1263),
(2,2,'4000123','Juan','Perez','km 81 itacurubi',98111222),
(3,3,'3333','Roberto','Samaniego','km 28 Itaugua',3213);

/*Table structure for table `compra` */

DROP TABLE IF EXISTS `compra`;

CREATE TABLE `compra` (
  `cod_compra` int NOT NULL,
  `cod_proveedor` int NOT NULL,
  `id_user` int NOT NULL,
  `nro_factura` varchar(25) NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(15) NOT NULL,
  `hora` time NOT NULL,
  `total_compra` int NOT NULL,
  `cod_deposito` int NOT NULL,
  `id_orden` int NOT NULL,
  PRIMARY KEY (`cod_compra`),
  KEY `usuario_compra_fk` (`id_user`),
  KEY `proveedor_compra_fk` (`cod_proveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `compra` */

insert  into `compra`(`cod_compra`,`cod_proveedor`,`id_user`,`nro_factura`,`fecha`,`estado`,`hora`,`total_compra`,`cod_deposito`,`id_orden`) values 
(1,1,1,'000-000-000123','2007-01-25','activo','14:01:29',192000,1,0),
(2,1,1,'000-000-000124','2008-01-25','activo','16:01:26',8000,1,0),
(3,2,1,'000-000-000125','2008-01-25','activo','17:01:49',9000,1,0),
(4,2,1,'000-000-000126','2009-01-25','activo','17:01:49',7000,1,0),
(5,2,1,'000-000-000127','2009-01-25','activo','19:01:35',700,2,0),
(6,1,1,'000-000-000128','2010-01-25','activo','19:01:38',700,1,0),
(7,2,1,'000-000-000129','2010-01-25','activo','19:01:57',8000,2,0),
(8,1,1,'000-000-000130','2010-01-25','activo','19:01:26',8000,1,0),
(9,2,1,'000-000-000131','2025-01-11','activo','13:01:18',9000,2,0);

/*Table structure for table `departamento` */

DROP TABLE IF EXISTS `departamento`;

CREATE TABLE `departamento` (
  `id_departamento` int NOT NULL,
  `dep_descripcion` varchar(30) NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `departamento` */

insert  into `departamento`(`id_departamento`,`dep_descripcion`) values 
(1,'Central'),
(2,'Cordillera'),
(3,'Itapua'),
(4,'Paraguari');

/*Table structure for table `deposito` */

DROP TABLE IF EXISTS `deposito`;

CREATE TABLE `deposito` (
  `cod_deposito` int NOT NULL,
  `descrip` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_deposito`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `deposito` */

insert  into `deposito`(`cod_deposito`,`descrip`) values 
(1,'Deposito 1'),
(2,'Deposito 2');

/*Table structure for table `det_cred_deb` */

DROP TABLE IF EXISTS `det_cred_deb`;

CREATE TABLE `det_cred_deb` (
  `cod_producto` int NOT NULL,
  `id_nota_cred_deb` int NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`cod_producto`,`id_nota_cred_deb`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `det_cred_deb` */

/*Table structure for table `det_nota_remision` */

DROP TABLE IF EXISTS `det_nota_remision`;

CREATE TABLE `det_nota_remision` (
  `id_nota_remis` int NOT NULL,
  `cod_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id_nota_remis`,`cod_producto`),
  KEY `producto_det_nota_remision_fk` (`cod_producto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `det_nota_remision` */

insert  into `det_nota_remision`(`id_nota_remis`,`cod_producto`,`cantidad`) values 
(6,3,1),
(7,2,1);

/*Table structure for table `det_orden` */

DROP TABLE IF EXISTS `det_orden`;

CREATE TABLE `det_orden` (
  `id_orden` int NOT NULL,
  `cod_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio` int NOT NULL,
  PRIMARY KEY (`id_orden`,`cod_producto`),
  KEY `producto_det_orden_fk` (`cod_producto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `det_orden` */

/*Table structure for table `det_pedido` */

DROP TABLE IF EXISTS `det_pedido`;

CREATE TABLE `det_pedido` (
  `cod_producto` int NOT NULL,
  `id_pedido` int NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`cod_producto`,`id_pedido`),
  KEY `pedidos_det_pedido_fk` (`id_pedido`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `det_pedido` */

insert  into `det_pedido`(`cod_producto`,`id_pedido`,`cantidad`) values 
(3,9,1),
(3,8,1),
(1,7,1),
(2,6,1),
(2,5,1),
(3,4,1),
(3,3,100),
(3,2,1),
(3,1,1);

/*Table structure for table `det_presupuesto` */

DROP TABLE IF EXISTS `det_presupuesto`;

CREATE TABLE `det_presupuesto` (
  `cod_producto` int NOT NULL,
  `id_presup` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio` int NOT NULL,
  PRIMARY KEY (`cod_producto`,`id_presup`),
  KEY `presupuesto_det_presupuesto_fk` (`id_presup`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `det_presupuesto` */

insert  into `det_presupuesto`(`cod_producto`,`id_presup`,`cantidad`,`precio`) values 
(3,9,1,700),
(3,8,1,700),
(1,7,1,8000),
(2,6,1,9000),
(2,5,1,9000),
(3,4,1,700),
(2,3,1,9000),
(2,2,1,9000),
(3,1,1,7000);

/*Table structure for table `det_venta` */

DROP TABLE IF EXISTS `det_venta`;

CREATE TABLE `det_venta` (
  `cod_producto` int NOT NULL,
  `cod_venta` int NOT NULL,
  `cod_deposito` int NOT NULL,
  `det_precio_unit` int NOT NULL,
  `det_cantidad` int NOT NULL,
  PRIMARY KEY (`cod_producto`,`cod_venta`),
  KEY `venta_det_venta_fk` (`cod_venta`),
  KEY `deposito_det_venta_fk` (`cod_deposito`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `det_venta` */

insert  into `det_venta`(`cod_producto`,`cod_venta`,`cod_deposito`,`det_precio_unit`,`det_cantidad`) values 
(3,4,2,910,1),
(3,3,2,9000,1),
(3,2,2,9000,1),
(1,1,1,10500,10),
(2,5,2,11000,1),
(3,5,1,9000,1);

/*Table structure for table `detalle_compra` */

DROP TABLE IF EXISTS `detalle_compra`;

CREATE TABLE `detalle_compra` (
  `cod_producto` int NOT NULL,
  `cod_deposito` int NOT NULL,
  `cod_compra` int NOT NULL,
  `precio` int NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`cod_producto`,`cod_deposito`,`cod_compra`),
  KEY `deposito_detalle_compra_fk` (`cod_deposito`),
  KEY `compra_detalle_compra_fk` (`cod_compra`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `detalle_compra` */

insert  into `detalle_compra`(`cod_producto`,`cod_deposito`,`cod_compra`,`precio`,`cantidad`) values 
(3,2,5,700,1),
(3,1,4,7000,1),
(3,2,8,700,1),
(1,1,7,10000,1),
(1,2,6,8000,10),
(2,2,5,9000,10),
(3,2,4,7000,40),
(2,1,3,9000,1),
(1,1,2,8000,1),
(1,1,1,8000,24),
(3,1,6,700,1),
(1,2,7,8000,1),
(1,1,8,8000,1),
(2,2,9,9000,1);

/*Table structure for table `marca` */

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca` (
  `id_marca` int NOT NULL,
  `marca_descrip` varchar(15) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `marca` */

insert  into `marca`(`id_marca`,`marca_descrip`) values 
(1,'Toyota'),
(2,'Nissan');

/*Table structure for table `modelo` */

DROP TABLE IF EXISTS `modelo`;

CREATE TABLE `modelo` (
  `id_modelo` int NOT NULL,
  `id_marca` int NOT NULL,
  `mod_descrip` varchar(15) NOT NULL,
  `anho` int NOT NULL,
  PRIMARY KEY (`id_modelo`),
  KEY `marca_modelo_fk` (`id_marca`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `modelo` */

insert  into `modelo`(`id_modelo`,`id_marca`,`mod_descrip`,`anho`) values 
(1,1,'Corolla',2001),
(2,2,'Qicks',2020);

/*Table structure for table `movil` */

DROP TABLE IF EXISTS `movil`;

CREATE TABLE `movil` (
  `id_movil` int NOT NULL,
  `id_modelo` int NOT NULL,
  `nro_chapa` varchar(8) NOT NULL,
  `estado` varchar(8) NOT NULL,
  `color` varchar(12) NOT NULL,
  PRIMARY KEY (`id_movil`),
  KEY `modelo_movil_fk` (`id_modelo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `movil` */

insert  into `movil`(`id_movil`,`id_modelo`,`nro_chapa`,`estado`,`color`) values 
(1,1,'aaa 000','activo','blanco'),
(2,2,'bbb 111','inactivo','amarillo');

/*Table structure for table `nota_cred_deb` */

DROP TABLE IF EXISTS `nota_cred_deb`;

CREATE TABLE `nota_cred_deb` (
  `id_nota_cred_deb` int NOT NULL,
  `id_user` int NOT NULL,
  `cod_venta` int NOT NULL,
  `tipo` varchar(8) NOT NULL,
  `monto` int NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(12) NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id_nota_cred_deb`),
  KEY `usuario_nota_cred_deb_fk` (`id_user`),
  KEY `venta_nota_cred_deb_fk` (`cod_venta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `nota_cred_deb` */

/*Table structure for table `nota_remision` */

DROP TABLE IF EXISTS `nota_remision`;

CREATE TABLE `nota_remision` (
  `id_nota_remis` int NOT NULL,
  `cod_venta` int NOT NULL,
  `id_user` int NOT NULL,
  `id_movil` int NOT NULL,
  `id_chofer` int NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(12) NOT NULL,
  `hora` time NOT NULL,
  `id_cliente` int NOT NULL,
  `destino` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_nota_remis`,`id_cliente`),
  KEY `chofer_nota_remision_fk` (`id_chofer`),
  KEY `movil_nota_remision_fk` (`id_movil`),
  KEY `venta_nota_remision_fk` (`cod_venta`),
  KEY `fk_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `nota_remision` */

insert  into `nota_remision`(`id_nota_remis`,`cod_venta`,`id_user`,`id_movil`,`id_chofer`,`fecha`,`estado`,`hora`,`id_cliente`,`destino`) values 
(1,1,1,1,1,'2025-01-06','activo','16:10:00',1,'caacupe'),
(3,2,1,2,1,'2025-01-09','activo','16:10:00',3,'aregua'),
(4,4,1,1,2,'2025-01-14','activo','18:22:00',1,'san lorenzo'),
(2,2,1,1,1,'2025-01-09','activo','15:18:00',1,'san lorenzo'),
(5,5,1,1,1,'2025-01-14','activo','19:24:00',1,'aregua'),
(6,5,1,1,1,'2025-01-14','activo','19:28:00',1,'Capiata'),
(7,5,1,1,1,'2025-01-14','activo','20:08:00',1,'san lorenzo');

/*Table structure for table `orden` */

DROP TABLE IF EXISTS `orden`;

CREATE TABLE `orden` (
  `id_orden` int NOT NULL,
  `id_presup` int NOT NULL,
  `id_user` int NOT NULL,
  `fecha_emision` date NOT NULL,
  `estado` varchar(20) NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id_orden`),
  KEY `usuario_orden_fk` (`id_user`),
  KEY `presupuesto_orden_fk` (`id_presup`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `orden` */

insert  into `orden`(`id_orden`,`id_presup`,`id_user`,`fecha_emision`,`estado`,`hora`) values 
(4,4,1,'2025-01-13','activo','15:11:23'),
(3,3,1,'2025-01-11','activo','11:33:01'),
(2,2,1,'2025-01-11','activo','11:31:01'),
(1,1,1,'2009-01-25','activo','14:18:36'),
(5,5,1,'2025-01-13','activo','15:12:11');

/*Table structure for table `pedidos` */

DROP TABLE IF EXISTS `pedidos`;

CREATE TABLE `pedidos` (
  `id_pedido` int NOT NULL,
  `id_user` int NOT NULL,
  `cod_deposito` int NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(20) NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `usuario_pedidos_fk` (`id_user`),
  KEY `deposito_pedidos_fk` (`cod_deposito`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `pedidos` */

insert  into `pedidos`(`id_pedido`,`id_user`,`cod_deposito`,`fecha`,`estado`,`hora`) values 
(9,1,1,'2025-01-13','activo','15:09:48'),
(8,1,2,'2025-01-13','activo','14:54:36'),
(7,1,2,'2025-01-13','activo','14:49:59'),
(6,1,2,'2025-01-13','activo','14:48:34'),
(5,1,2,'2025-01-13','activo','14:47:04'),
(4,1,1,'2025-01-13','activo','14:33:33'),
(3,1,1,'2025-01-09','activo','14:15:08'),
(2,1,2,'2025-01-09','activo','14:13:07'),
(1,1,1,'2025-01-09','activo','14:12:45');

/*Table structure for table `presupuesto` */

DROP TABLE IF EXISTS `presupuesto`;

CREATE TABLE `presupuesto` (
  `id_presup` int NOT NULL,
  `id_pedido` int NOT NULL,
  `cod_proveedor` int NOT NULL,
  `id_user` int NOT NULL,
  `total_esti` int NOT NULL,
  `fecha_presup` date NOT NULL,
  `hora` time NOT NULL,
  `estado` enum('aprobado','anulado') NOT NULL,
  PRIMARY KEY (`id_presup`),
  KEY `usuario_presupuesto_fk` (`id_user`),
  KEY `proveedor_presupuesto_fk` (`cod_proveedor`),
  KEY `pedidos_presupuesto_fk` (`id_pedido`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `presupuesto` */

insert  into `presupuesto`(`id_presup`,`id_pedido`,`cod_proveedor`,`id_user`,`total_esti`,`fecha_presup`,`hora`,`estado`) values 
(9,9,2,1,700,'2025-01-13','18:10:40','aprobado'),
(8,8,2,1,700,'2025-01-13','17:55:15','aprobado'),
(7,7,1,1,8000,'2013-01-25','17:50:33','aprobado'),
(6,6,2,1,9000,'2013-01-25','17:49:01','aprobado'),
(5,5,2,1,9000,'2013-01-25','17:47:38','aprobado'),
(4,4,2,1,700,'0000-00-00','17:34:10','aprobado'),
(3,2,2,1,9000,'0000-00-00','14:17:33','anulado'),
(2,1,2,1,9000,'0000-00-00','14:14:35','aprobado'),
(1,3,2,1,7000,'0000-00-00','17:18:15','aprobado');

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `cod_producto` int NOT NULL,
  `cod_tipo_prod` int NOT NULL,
  `id_u_medida` int NOT NULL,
  `p_descrip` varchar(25) DEFAULT NULL,
  `precio` int NOT NULL,
  PRIMARY KEY (`cod_producto`),
  KEY `u_medida_producto_fk` (`id_u_medida`),
  KEY `tipo_producto_producto_fk` (`cod_tipo_prod`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `producto` */

insert  into `producto`(`cod_producto`,`cod_tipo_prod`,`id_u_medida`,`p_descrip`,`precio`) values 
(1,1,1,'Leche',8000),
(2,2,2,'Coca Cola',9000),
(3,3,2,'jugo watts',700);

/*Table structure for table `proveedor` */

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `cod_proveedor` int NOT NULL,
  `razon_social` varchar(75) NOT NULL,
  `ruc` varchar(9) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`cod_proveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `proveedor` */

insert  into `proveedor`(`cod_proveedor`,`razon_social`,`ruc`,`direccion`,`telefono`) values 
(1,'Lactolanda','1111','Capiata km 20','222222'),
(2,'Coca Cola','22222','Asunción km5','321');

/*Table structure for table `stock` */

DROP TABLE IF EXISTS `stock`;

CREATE TABLE `stock` (
  `cod_deposito` int NOT NULL,
  `cod_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`cod_deposito`,`cod_producto`),
  KEY `producto_stock_fk` (`cod_producto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `stock` */

insert  into `stock`(`cod_deposito`,`cod_producto`,`cantidad`) values 
(1,1,18),
(2,1,-1),
(1,2,1),
(2,2,-1),
(2,3,38),
(1,3,1);

/*Table structure for table `tipo_producto` */

DROP TABLE IF EXISTS `tipo_producto`;

CREATE TABLE `tipo_producto` (
  `cod_tipo_prod` int NOT NULL,
  `t_p_descrip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`cod_tipo_prod`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tipo_producto` */

insert  into `tipo_producto`(`cod_tipo_prod`,`t_p_descrip`) values 
(1,'Lacteos'),
(2,'Gaseosa'),
(3,'jugo');

/*Table structure for table `tmp` */

DROP TABLE IF EXISTS `tmp`;

CREATE TABLE `tmp` (
  `id_tmp` int NOT NULL AUTO_INCREMENT,
  `id_producto` int DEFAULT NULL,
  `cantidad_tmp` int DEFAULT NULL,
  `precio_tmp` int NOT NULL,
  `session_id` varchar(765) DEFAULT NULL,
  PRIMARY KEY (`id_tmp`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `tmp` */

insert  into `tmp`(`id_tmp`,`id_producto`,`cantidad_tmp`,`precio_tmp`,`session_id`) values 
(10,2,1,0,'emoitap6dp8vptrgt16re8f91s');

/*Table structure for table `u_medida` */

DROP TABLE IF EXISTS `u_medida`;

CREATE TABLE `u_medida` (
  `id_u_medida` int NOT NULL,
  `u_descrip` varchar(20) NOT NULL,
  PRIMARY KEY (`id_u_medida`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `u_medida` */

insert  into `u_medida`(`id_u_medida`,`u_descrip`) values 
(1,'2 litros'),
(2,'1 Litro');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id_user` int NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `name_user` varchar(25) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(20) NOT NULL,
  `status` char(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `permisos_acceso` varchar(20) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `usuario_idx` (`name_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id_user`,`username`,`name_user`,`password`,`email`,`status`,`telefono`,`foto`,`permisos_acceso`) values 
(1,'jesus4','Jesus Almada','92eb5ffee6ae2fec3ad71c777531578f','aaandrade4@gmail.com','activo','0982873205','Usuario-Icono.jpg','Super Admin'),
(2,'ucompras','jesus Compras','4a8a08f09d37b73795649038408b5f33','aaandrade4@gmail.com','activo','0123456','Usuario-Icono.jpg','Compras'),
(3,'uventas','uventas','9e3669d19b675bd57058fd4664205d2a','aaandrade4@gmail.com','activo','1234','','Ventas');

/*Table structure for table `venta` */

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `cod_venta` int NOT NULL,
  `id_cliente` int NOT NULL,
  `fecha` date NOT NULL,
  `total_venta` int NOT NULL,
  `hora` time NOT NULL,
  `estado` varchar(15) NOT NULL,
  `nro_factura` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cod_venta`),
  KEY `clientes_venta_fk` (`id_cliente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `venta` */

insert  into `venta`(`cod_venta`,`id_cliente`,`fecha`,`total_venta`,`hora`,`estado`,`nro_factura`) values 
(3,2,'2025-01-09',9000,'16:11:42','activo','000-000-000127'),
(2,3,'2025-01-09',9000,'15:02:23','activo','000-000-000127'),
(1,1,'2025-01-09',105000,'14:23:39','activo','000-000-000126'),
(4,3,'2025-01-09',910,'16:15:08','activo','000-000-000128'),
(5,1,'2025-01-14',9000,'18:27:07','activo','000-000-000129');

/* Trigger structure for table `compra` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `borrar_compra` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `borrar_compra` AFTER INSERT ON `compra` FOR EACH ROW BEGIN
DELETE FROM tmp;
END */$$


DELIMITER ;

/* Trigger structure for table `det_pedido` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `borrar_pedido` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `borrar_pedido` AFTER INSERT ON `det_pedido` FOR EACH ROW BEGIN
DELETE FROM tmp;
END */$$


DELIMITER ;

/* Trigger structure for table `det_presupuesto` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `borrar_presupuesto` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `borrar_presupuesto` AFTER INSERT ON `det_presupuesto` FOR EACH ROW BEGIN
DELETE FROM tmp;
END */$$


DELIMITER ;

/* Trigger structure for table `venta` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `borrar_venta` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `borrar_venta` AFTER INSERT ON `venta` FOR EACH ROW BEGIN
DELETE FROM tmp;
END */$$


DELIMITER ;

/*Table structure for table `v_caja_aper` */

DROP TABLE IF EXISTS `v_caja_aper`;

/*!50001 DROP VIEW IF EXISTS `v_caja_aper` */;
/*!50001 DROP TABLE IF EXISTS `v_caja_aper` */;

/*!50001 CREATE TABLE  `v_caja_aper`(
 `cod_apertura_cierre` int ,
 `id_user` int ,
 `name_user` varchar(25) ,
 `fecha_apertura` date ,
 `hora_apertura` time ,
 `fecha_cierre` date ,
 `hora_cierre` time ,
 `monto_apertura` int ,
 `monto_cierre` int ,
 `estado` varchar(12) ,
 `id_caja` int ,
 `caja_descrip` varchar(25) 
)*/;

/*Table structure for table `v_caja_apertura` */

DROP TABLE IF EXISTS `v_caja_apertura`;

/*!50001 DROP VIEW IF EXISTS `v_caja_apertura` */;
/*!50001 DROP TABLE IF EXISTS `v_caja_apertura` */;

/*!50001 CREATE TABLE  `v_caja_apertura`(
 `id_user` int ,
 `name_user` varchar(25) ,
 `fecha_apertura` date ,
 `hora_apertura` time ,
 `fecha_cierre` date ,
 `hora_cierre` time ,
 `monto_apertura` int ,
 `monto_cierre` int ,
 `estado` varchar(12) ,
 `id_caja` int ,
 `caja_descrip` varchar(25) 
)*/;

/*Table structure for table `v_clientes` */

DROP TABLE IF EXISTS `v_clientes`;

/*!50001 DROP VIEW IF EXISTS `v_clientes` */;
/*!50001 DROP TABLE IF EXISTS `v_clientes` */;

/*!50001 CREATE TABLE  `v_clientes`(
 `id_cliente` int ,
 `ci_ruc` varchar(10) ,
 `cli_nombre` varchar(30) ,
 `cli_apellido` varchar(50) ,
 `cli_direccion` varchar(50) ,
 `cli_telefono` int ,
 `cod_ciudad` int ,
 `descrip_ciudad` varchar(25) ,
 `id_departamento` int ,
 `dep_descripcion` varchar(30) 
)*/;

/*Table structure for table `v_compras` */

DROP TABLE IF EXISTS `v_compras`;

/*!50001 DROP VIEW IF EXISTS `v_compras` */;
/*!50001 DROP TABLE IF EXISTS `v_compras` */;

/*!50001 CREATE TABLE  `v_compras`(
 `cod_compra` int ,
 `cod_proveedor` int ,
 `razon_social` varchar(75) ,
 `id_orden` int ,
 `id_user` int ,
 `nro_factura` varchar(25) ,
 `fecha` date ,
 `estado` varchar(15) ,
 `hora` time ,
 `total_compra` int ,
 `cod_deposito` int ,
 `deposito_descrip` varchar(50) 
)*/;

/*Table structure for table `v_det_compra` */

DROP TABLE IF EXISTS `v_det_compra`;

/*!50001 DROP VIEW IF EXISTS `v_det_compra` */;
/*!50001 DROP TABLE IF EXISTS `v_det_compra` */;

/*!50001 CREATE TABLE  `v_det_compra`(
 `cod_compra` int ,
 `cod_producto` int ,
 `t_p_descrip` varchar(25) ,
 `u_descrip` varchar(20) ,
 `p_descrip` varchar(25) ,
 `precio` int ,
 `cantidad` int 
)*/;

/*Table structure for table `v_det_nota_remision` */

DROP TABLE IF EXISTS `v_det_nota_remision`;

/*!50001 DROP VIEW IF EXISTS `v_det_nota_remision` */;
/*!50001 DROP TABLE IF EXISTS `v_det_nota_remision` */;

/*!50001 CREATE TABLE  `v_det_nota_remision`(
 `id_nota_remis` int ,
 `p_descrip` varchar(25) ,
 `cantidad` int 
)*/;

/*Table structure for table `v_det_orden` */

DROP TABLE IF EXISTS `v_det_orden`;

/*!50001 DROP VIEW IF EXISTS `v_det_orden` */;
/*!50001 DROP TABLE IF EXISTS `v_det_orden` */;

/*!50001 CREATE TABLE  `v_det_orden`(
 `id_orden` int ,
 `cod_producto` int ,
 `p_descrip` varchar(25) ,
 `cantidad` int ,
 `precio` int 
)*/;

/*Table structure for table `v_det_pedido` */

DROP TABLE IF EXISTS `v_det_pedido`;

/*!50001 DROP VIEW IF EXISTS `v_det_pedido` */;
/*!50001 DROP TABLE IF EXISTS `v_det_pedido` */;

/*!50001 CREATE TABLE  `v_det_pedido`(
 `cod_producto` int ,
 `id_pedido` int ,
 `cantidad` int ,
 `p_descrip` varchar(25) ,
 `t_p_descrip` varchar(25) 
)*/;

/*Table structure for table `v_detalle_presupuesto` */

DROP TABLE IF EXISTS `v_detalle_presupuesto`;

/*!50001 DROP VIEW IF EXISTS `v_detalle_presupuesto` */;
/*!50001 DROP TABLE IF EXISTS `v_detalle_presupuesto` */;

/*!50001 CREATE TABLE  `v_detalle_presupuesto`(
 `id_presup` int ,
 `p_descrip` varchar(25) ,
 `cantidad` int ,
 `precio` int 
)*/;

/*Table structure for table `v_detalle_venta` */

DROP TABLE IF EXISTS `v_detalle_venta`;

/*!50001 DROP VIEW IF EXISTS `v_detalle_venta` */;
/*!50001 DROP TABLE IF EXISTS `v_detalle_venta` */;

/*!50001 CREATE TABLE  `v_detalle_venta`(
 `cod_producto` int ,
 `producto` varchar(25) ,
 `cod_venta` int ,
 `cod_deposito` int ,
 `deposito` varchar(50) ,
 `precio_unitario` int ,
 `cantidad` int 
)*/;

/*Table structure for table `v_stock` */

DROP TABLE IF EXISTS `v_stock`;

/*!50001 DROP VIEW IF EXISTS `v_stock` */;
/*!50001 DROP TABLE IF EXISTS `v_stock` */;

/*!50001 CREATE TABLE  `v_stock`(
 `cod_producto` int ,
 `p_descrip` varchar(25) ,
 `cod_deposito` int ,
 `descrip` varchar(50) ,
 `t_p_descrip` varchar(25) ,
 `u_descrip` varchar(20) ,
 `cantidad` int 
)*/;

/*Table structure for table `v_ventas` */

DROP TABLE IF EXISTS `v_ventas`;

/*!50001 DROP VIEW IF EXISTS `v_ventas` */;
/*!50001 DROP TABLE IF EXISTS `v_ventas` */;

/*!50001 CREATE TABLE  `v_ventas`(
 `cod_venta` int ,
 `id_cliente` int ,
 `fecha` date ,
 `total_venta` int ,
 `hora` time ,
 `estado` varchar(15) ,
 `nro_factura` varchar(30) 
)*/;

/*Table structure for table `vista_orden` */

DROP TABLE IF EXISTS `vista_orden`;

/*!50001 DROP VIEW IF EXISTS `vista_orden` */;
/*!50001 DROP TABLE IF EXISTS `vista_orden` */;

/*!50001 CREATE TABLE  `vista_orden`(
 `id_orden` int ,
 `id_presup` int ,
 `id_user` int ,
 `name_user` varchar(25) ,
 `fecha_emision` date ,
 `estado` varchar(20) ,
 `hora` time 
)*/;

/*Table structure for table `vista_pedidos` */

DROP TABLE IF EXISTS `vista_pedidos`;

/*!50001 DROP VIEW IF EXISTS `vista_pedidos` */;
/*!50001 DROP TABLE IF EXISTS `vista_pedidos` */;

/*!50001 CREATE TABLE  `vista_pedidos`(
 `id_pedido` int ,
 `name_user` varchar(25) ,
 `fecha` date ,
 `estado` varchar(20) ,
 `hora` time ,
 `descrip` varchar(50) 
)*/;

/*Table structure for table `vista_presupuesto` */

DROP TABLE IF EXISTS `vista_presupuesto`;

/*!50001 DROP VIEW IF EXISTS `vista_presupuesto` */;
/*!50001 DROP TABLE IF EXISTS `vista_presupuesto` */;

/*!50001 CREATE TABLE  `vista_presupuesto`(
 `id_presup` int ,
 `id_pedido` int ,
 `proveedor` varchar(75) ,
 `usuario` varchar(25) ,
 `total_esti` int ,
 `fecha_presup` date ,
 `hora` time ,
 `estado` enum('aprobado','anulado') 
)*/;

/*View structure for view v_caja_aper */

/*!50001 DROP TABLE IF EXISTS `v_caja_aper` */;
/*!50001 DROP VIEW IF EXISTS `v_caja_aper` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_caja_aper` AS select `aper`.`cod_apertura_cierre` AS `cod_apertura_cierre`,`u`.`id_user` AS `id_user`,`u`.`name_user` AS `name_user`,`aper`.`fecha_apertura` AS `fecha_apertura`,`aper`.`hora_apertura` AS `hora_apertura`,`aper`.`fecha_cierre` AS `fecha_cierre`,`aper`.`hora_cierre` AS `hora_cierre`,`aper`.`monto_apertura` AS `monto_apertura`,`aper`.`monto_cierre` AS `monto_cierre`,`aper`.`estado` AS `estado`,`c`.`id_caja` AS `id_caja`,`c`.`caja_descrip` AS `caja_descrip` from ((`caja_apertura_cierre` `aper` join `usuarios` `u`) join `caja` `c`) where ((`aper`.`id_user` = `u`.`id_user`) and (`aper`.`id_caja` = `c`.`id_caja`)) */;

/*View structure for view v_caja_apertura */

/*!50001 DROP TABLE IF EXISTS `v_caja_apertura` */;
/*!50001 DROP VIEW IF EXISTS `v_caja_apertura` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_caja_apertura` AS select `u`.`id_user` AS `id_user`,`u`.`name_user` AS `name_user`,`aper`.`fecha_apertura` AS `fecha_apertura`,`aper`.`hora_apertura` AS `hora_apertura`,`aper`.`fecha_cierre` AS `fecha_cierre`,`aper`.`hora_cierre` AS `hora_cierre`,`aper`.`monto_apertura` AS `monto_apertura`,`aper`.`monto_cierre` AS `monto_cierre`,`aper`.`estado` AS `estado`,`c`.`id_caja` AS `id_caja`,`c`.`caja_descrip` AS `caja_descrip` from ((`caja_apertura_cierre` `aper` join `usuarios` `u`) join `caja` `c`) where ((`aper`.`id_user` = `u`.`id_user`) and (`aper`.`id_caja` = `c`.`id_caja`)) */;

/*View structure for view v_clientes */

/*!50001 DROP TABLE IF EXISTS `v_clientes` */;
/*!50001 DROP VIEW IF EXISTS `v_clientes` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_clientes` AS select `cli`.`id_cliente` AS `id_cliente`,`cli`.`ci_ruc` AS `ci_ruc`,`cli`.`cli_nombre` AS `cli_nombre`,`cli`.`cli_apellido` AS `cli_apellido`,`cli`.`cli_direccion` AS `cli_direccion`,`cli`.`cli_telefono` AS `cli_telefono`,`ciu`.`cod_ciudad` AS `cod_ciudad`,`ciu`.`descrip_ciudad` AS `descrip_ciudad`,`dep`.`id_departamento` AS `id_departamento`,`dep`.`dep_descripcion` AS `dep_descripcion` from ((`clientes` `cli` join `departamento` `dep`) join `ciudad` `ciu`) where ((`cli`.`cod_ciudad` = `ciu`.`cod_ciudad`) and (`ciu`.`id_departamento` = `dep`.`id_departamento`)) */;

/*View structure for view v_compras */

/*!50001 DROP TABLE IF EXISTS `v_compras` */;
/*!50001 DROP VIEW IF EXISTS `v_compras` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_compras` AS select `comp`.`cod_compra` AS `cod_compra`,`prov`.`cod_proveedor` AS `cod_proveedor`,`prov`.`razon_social` AS `razon_social`,`comp`.`id_orden` AS `id_orden`,`comp`.`id_user` AS `id_user`,`comp`.`nro_factura` AS `nro_factura`,`comp`.`fecha` AS `fecha`,`comp`.`estado` AS `estado`,`comp`.`hora` AS `hora`,`comp`.`total_compra` AS `total_compra`,`dep`.`cod_deposito` AS `cod_deposito`,`dep`.`descrip` AS `deposito_descrip` from (((`compra` `comp` join `proveedor` `prov` on((`comp`.`cod_proveedor` = `prov`.`cod_proveedor`))) join `deposito` `dep` on((`comp`.`cod_deposito` = `dep`.`cod_deposito`))) join `usuarios` `usu` on((`comp`.`id_user` = `usu`.`name_user`))) */;

/*View structure for view v_det_compra */

/*!50001 DROP TABLE IF EXISTS `v_det_compra` */;
/*!50001 DROP VIEW IF EXISTS `v_det_compra` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_det_compra` AS select `comp`.`cod_compra` AS `cod_compra`,`pro`.`cod_producto` AS `cod_producto`,`tp`.`t_p_descrip` AS `t_p_descrip`,`um`.`u_descrip` AS `u_descrip`,`pro`.`p_descrip` AS `p_descrip`,`det`.`precio` AS `precio`,`det`.`cantidad` AS `cantidad` from (((((`detalle_compra` `det` join `compra` `comp` on((`det`.`cod_compra` = `comp`.`cod_compra`))) join `producto` `pro` on((`det`.`cod_producto` = `pro`.`cod_producto`))) join `tipo_producto` `tp` on((`pro`.`cod_tipo_prod` = `tp`.`cod_tipo_prod`))) join `u_medida` `um` on((`pro`.`id_u_medida` = `um`.`id_u_medida`))) join `proveedor` `p` on((`comp`.`cod_proveedor` = `p`.`cod_proveedor`))) */;

/*View structure for view v_det_nota_remision */

/*!50001 DROP TABLE IF EXISTS `v_det_nota_remision` */;
/*!50001 DROP VIEW IF EXISTS `v_det_nota_remision` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_det_nota_remision` AS select `aper`.`id_nota_remis` AS `id_nota_remis`,`u`.`p_descrip` AS `p_descrip`,`aper`.`cantidad` AS `cantidad` from (`det_nota_remision` `aper` join `producto` `u`) where (`aper`.`cod_producto` = `u`.`cod_producto`) */;

/*View structure for view v_det_orden */

/*!50001 DROP TABLE IF EXISTS `v_det_orden` */;
/*!50001 DROP VIEW IF EXISTS `v_det_orden` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_det_orden` AS select `o`.`id_orden` AS `id_orden`,`d`.`cod_producto` AS `cod_producto`,`p`.`p_descrip` AS `p_descrip`,`d`.`cantidad` AS `cantidad`,`d`.`precio` AS `precio` from ((`orden` `o` join `det_orden` `d` on((`o`.`id_orden` = `d`.`id_orden`))) join `producto` `p` on((`d`.`cod_producto` = `p`.`cod_producto`))) */;

/*View structure for view v_det_pedido */

/*!50001 DROP TABLE IF EXISTS `v_det_pedido` */;
/*!50001 DROP VIEW IF EXISTS `v_det_pedido` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_det_pedido` AS select `dp`.`cod_producto` AS `cod_producto`,`dp`.`id_pedido` AS `id_pedido`,`dp`.`cantidad` AS `cantidad`,`p`.`p_descrip` AS `p_descrip`,`tp`.`t_p_descrip` AS `t_p_descrip` from ((`det_pedido` `dp` join `producto` `p` on((`dp`.`cod_producto` = `p`.`cod_producto`))) join `tipo_producto` `tp` on((`p`.`cod_tipo_prod` = `tp`.`cod_tipo_prod`))) */;

/*View structure for view v_detalle_presupuesto */

/*!50001 DROP TABLE IF EXISTS `v_detalle_presupuesto` */;
/*!50001 DROP VIEW IF EXISTS `v_detalle_presupuesto` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detalle_presupuesto` AS select `dp`.`id_presup` AS `id_presup`,`pr`.`p_descrip` AS `p_descrip`,`dp`.`cantidad` AS `cantidad`,`dp`.`precio` AS `precio` from (`det_presupuesto` `dp` join `producto` `pr` on((`dp`.`cod_producto` = `pr`.`cod_producto`))) */;

/*View structure for view v_detalle_venta */

/*!50001 DROP TABLE IF EXISTS `v_detalle_venta` */;
/*!50001 DROP VIEW IF EXISTS `v_detalle_venta` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detalle_venta` AS select `dv`.`cod_producto` AS `cod_producto`,`p`.`p_descrip` AS `producto`,`dv`.`cod_venta` AS `cod_venta`,`dv`.`cod_deposito` AS `cod_deposito`,`d`.`descrip` AS `deposito`,`dv`.`det_precio_unit` AS `precio_unitario`,`dv`.`det_cantidad` AS `cantidad` from ((`det_venta` `dv` join `producto` `p` on((`dv`.`cod_producto` = `p`.`cod_producto`))) join `deposito` `d` on((`dv`.`cod_deposito` = `d`.`cod_deposito`))) */;

/*View structure for view v_stock */

/*!50001 DROP TABLE IF EXISTS `v_stock` */;
/*!50001 DROP VIEW IF EXISTS `v_stock` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stock` AS select `pro`.`cod_producto` AS `cod_producto`,`pro`.`p_descrip` AS `p_descrip`,`dep`.`cod_deposito` AS `cod_deposito`,`dep`.`descrip` AS `descrip`,`tpro`.`t_p_descrip` AS `t_p_descrip`,`um`.`u_descrip` AS `u_descrip`,`st`.`cantidad` AS `cantidad` from ((((`stock` `st` join `producto` `pro`) join `tipo_producto` `tpro`) join `u_medida` `um`) join `deposito` `dep`) where ((`st`.`cod_producto` = `pro`.`cod_producto`) and (`st`.`cod_deposito` = `dep`.`cod_deposito`) and (`pro`.`cod_tipo_prod` = `tpro`.`cod_tipo_prod`) and (`pro`.`id_u_medida` = `um`.`id_u_medida`)) */;

/*View structure for view v_ventas */

/*!50001 DROP TABLE IF EXISTS `v_ventas` */;
/*!50001 DROP VIEW IF EXISTS `v_ventas` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ventas` AS select `venta`.`cod_venta` AS `cod_venta`,`venta`.`id_cliente` AS `id_cliente`,`venta`.`fecha` AS `fecha`,`venta`.`total_venta` AS `total_venta`,`venta`.`hora` AS `hora`,`venta`.`estado` AS `estado`,`venta`.`nro_factura` AS `nro_factura` from `venta` */;

/*View structure for view vista_orden */

/*!50001 DROP TABLE IF EXISTS `vista_orden` */;
/*!50001 DROP VIEW IF EXISTS `vista_orden` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_orden` AS select `orden`.`id_orden` AS `id_orden`,`orden`.`id_presup` AS `id_presup`,`orden`.`id_user` AS `id_user`,(select `usuarios`.`name_user` from `usuarios` where (`usuarios`.`id_user` = `orden`.`id_user`)) AS `name_user`,`orden`.`fecha_emision` AS `fecha_emision`,`orden`.`estado` AS `estado`,`orden`.`hora` AS `hora` from `orden` */;

/*View structure for view vista_pedidos */

/*!50001 DROP TABLE IF EXISTS `vista_pedidos` */;
/*!50001 DROP VIEW IF EXISTS `vista_pedidos` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_pedidos` AS select `p`.`id_pedido` AS `id_pedido`,`u`.`name_user` AS `name_user`,`p`.`fecha` AS `fecha`,`p`.`estado` AS `estado`,`p`.`hora` AS `hora`,`d`.`descrip` AS `descrip` from ((`pedidos` `p` join `usuarios` `u` on((`p`.`id_user` = `u`.`id_user`))) join `deposito` `d` on((`p`.`cod_deposito` = `d`.`cod_deposito`))) */;

/*View structure for view vista_presupuesto */

/*!50001 DROP TABLE IF EXISTS `vista_presupuesto` */;
/*!50001 DROP VIEW IF EXISTS `vista_presupuesto` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_presupuesto` AS select `p`.`id_presup` AS `id_presup`,`p`.`id_pedido` AS `id_pedido`,`pr`.`razon_social` AS `proveedor`,`u`.`name_user` AS `usuario`,`p`.`total_esti` AS `total_esti`,`p`.`fecha_presup` AS `fecha_presup`,`p`.`hora` AS `hora`,`p`.`estado` AS `estado` from ((`presupuesto` `p` left join `proveedor` `pr` on((`p`.`cod_proveedor` = `pr`.`cod_proveedor`))) left join `usuarios` `u` on((`p`.`id_user` = `u`.`id_user`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
