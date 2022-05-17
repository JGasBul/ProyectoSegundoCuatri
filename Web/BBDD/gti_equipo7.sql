-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.24-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla gti_equipo7.parcelas
CREATE TABLE IF NOT EXISTS `parcelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `color` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla gti_equipo7.parcelas: ~3 rows (aproximadamente)
DELETE FROM `parcelas`;
/*!40000 ALTER TABLE `parcelas` DISABLE KEYS */;
INSERT INTO `parcelas` (`id`, `nombre`, `color`) VALUES
	(1, 'Parcela nº1', 'FF8000'),
	(2, 'Parcela nº2', 'F44336'),
	(3, 'Parcela nº3', '2196F3');
/*!40000 ALTER TABLE `parcelas` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.posicion_sonda
CREATE TABLE IF NOT EXISTS `posicion_sonda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL,
  `sonda` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_vertice_sonda` (`sonda`) USING BTREE,
  CONSTRAINT `fk_vertice_sonda` FOREIGN KEY (`sonda`) REFERENCES `sondas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla gti_equipo7.posicion_sonda: ~0 rows (aproximadamente)
DELETE FROM `posicion_sonda`;
/*!40000 ALTER TABLE `posicion_sonda` DISABLE KEYS */;
INSERT INTO `posicion_sonda` (`id`, `lat`, `lng`, `sonda`) VALUES
	(14, 38.9981639, -0.1720151, 1);
/*!40000 ALTER TABLE `posicion_sonda` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.sondas
CREATE TABLE IF NOT EXISTS `sondas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `parcela` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_sonda_parcela` (`parcela`),
  KEY `FK2_sonda_usuario` (`usuario`),
  CONSTRAINT `FK1_sonda_parcela` FOREIGN KEY (`parcela`) REFERENCES `parcelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2_sonda_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla gti_equipo7.sondas: ~1 rows (aproximadamente)
DELETE FROM `sondas`;
/*!40000 ALTER TABLE `sondas` DISABLE KEYS */;
INSERT INTO `sondas` (`id`, `usuario`, `parcela`) VALUES
	(1, 1, 1);
/*!40000 ALTER TABLE `sondas` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `rol` enum('admin','normal') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla gti_equipo7.usuarios: ~3 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `email`, `nombre`, `password`, `rol`) VALUES
	(1, 'propietario1@gmail.com', 'propietario1', '1234', 'normal'),
	(2, 'propietario2@gmail.com', 'propietario2', '1234', 'normal'),
	(3, 'admin@gmail.com', 'admin', 'admin', 'admin');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.usuarios_parcelas
CREATE TABLE IF NOT EXISTS `usuarios_parcelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `parcela` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_parcela_usuario` (`usuario`),
  KEY `fk_usuario_parcela_parcela` (`parcela`),
  CONSTRAINT `fk_usuario_parcela_parcela` FOREIGN KEY (`parcela`) REFERENCES `parcelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_parcela_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla gti_equipo7.usuarios_parcelas: ~4 rows (aproximadamente)
DELETE FROM `usuarios_parcelas`;
/*!40000 ALTER TABLE `usuarios_parcelas` DISABLE KEYS */;
INSERT INTO `usuarios_parcelas` (`id`, `usuario`, `parcela`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 2, 1),
	(4, 2, 3);
/*!40000 ALTER TABLE `usuarios_parcelas` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.vertices
CREATE TABLE IF NOT EXISTS `vertices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL,
  `parcela` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vertice_parcela` (`parcela`),
  CONSTRAINT `fk_vertice_parcela` FOREIGN KEY (`parcela`) REFERENCES `parcelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla gti_equipo7.vertices: ~13 rows (aproximadamente)
DELETE FROM `vertices`;
/*!40000 ALTER TABLE `vertices` DISABLE KEYS */;
INSERT INTO `vertices` (`id`, `lat`, `lng`, `parcela`) VALUES
	(1, 38.9981639, -0.1720151, 1),
	(2, 38.9979802, -0.1715208, 1),
	(3, 38.9965934, -0.1721850, 1),
	(4, 38.9969109, -0.1729598, 1),
	(5, 38.9983908, -0.1785001, 2),
	(6, 38.9979107, -0.1774030, 2),
	(7, 38.9969825, -0.1779657, 2),
	(8, 38.9969494, -0.1783175, 2),
	(9, 38.9975874, -0.1795887, 2),
	(10, 38.9924270, -0.1713474, 3),
	(11, 38.9927512, -0.1694416, 3),
	(12, 38.9915003, -0.1684759, 3),
	(13, 38.9910870, -0.1709218, 3);
/*!40000 ALTER TABLE `vertices` ENABLE KEYS */;

-- Volcando estructura para vista gti_equipo7.vista_parcelas_con_vertices
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vista_parcelas_con_vertices` (
	`id` INT(11) NOT NULL,
	`nombre` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci',
	`color` VARCHAR(6) NOT NULL COLLATE 'utf8mb4_general_ci',
	`lat` DECIMAL(10,7) NOT NULL,
	`lng` DECIMAL(10,7) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista gti_equipo7.vista_propiedad_parcelas
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `vista_propiedad_parcelas` (
	`usuario` INT(11) NOT NULL,
	`parcela` INT(11) NOT NULL,
	`nombre_parcela` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci',
	`color` VARCHAR(6) NOT NULL COLLATE 'utf8mb4_general_ci',
	`nombre_usuario` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista gti_equipo7.vista_parcelas_con_vertices
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vista_parcelas_con_vertices`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vista_parcelas_con_vertices` AS select `parcelas`.`id` AS `id`,`parcelas`.`nombre` AS `nombre`,`parcelas`.`color` AS `color`,`vertices`.`lat` AS `lat`,`vertices`.`lng` AS `lng` from (`parcelas` join `vertices` on((`parcelas`.`id` = `vertices`.`parcela`))) ;

-- Volcando estructura para vista gti_equipo7.vista_propiedad_parcelas
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `vista_propiedad_parcelas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vista_propiedad_parcelas` AS select `usuarios_parcelas`.`usuario` AS `usuario`,`usuarios_parcelas`.`parcela` AS `parcela`,`parcelas`.`nombre` AS `nombre_parcela`,`parcelas`.`color` AS `color`,`usuarios`.`nombre` AS `nombre_usuario` from ((`usuarios_parcelas` join `parcelas` on((`parcelas`.`id` = `usuarios_parcelas`.`parcela`))) join `usuarios` on((`usuarios`.`id` = `usuarios_parcelas`.`usuario`))) ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
