-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.11-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para gti_equipo7
CREATE DATABASE IF NOT EXISTS `gti_equipo7` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `gti_equipo7`;

-- Volcando estructura para tabla gti_equipo7.mediciones
CREATE TABLE IF NOT EXISTS `mediciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `humedad` decimal(10,0) NOT NULL,
  `salinidad` decimal(10,0) NOT NULL,
  `tempeatura` decimal(10,0) NOT NULL,
  `iluminacion` decimal(10,0) NOT NULL,
  `posicion` int(11) NOT NULL COMMENT 'ID de la posicion',
  `hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `posicion-medicion` (`posicion`),
  CONSTRAINT `posicion-medicion` FOREIGN KEY (`posicion`) REFERENCES `posicion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla gti_equipo7.mediciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mediciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `mediciones` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.parcelas
CREATE TABLE IF NOT EXISTS `parcelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL COMMENT 'Se coge la id del usuario proveniente de la tabla usuarios',
  `posicion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario-parcela` (`usuario`),
  CONSTRAINT `usuario-parcela` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla gti_equipo7.parcelas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `parcelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `parcelas` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.posicion
CREATE TABLE IF NOT EXISTS `posicion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posicion` int(11) NOT NULL,
  `sonda` int(11) NOT NULL COMMENT 'id de la sonda',
  PRIMARY KEY (`id`),
  KEY `sonda-posicion` (`sonda`),
  CONSTRAINT `sonda-posicion` FOREIGN KEY (`sonda`) REFERENCES `sonda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla gti_equipo7.posicion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `posicion` DISABLE KEYS */;
/*!40000 ALTER TABLE `posicion` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.sonda
CREATE TABLE IF NOT EXISTS `sonda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posicion` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario-sonda` (`usuario`),
  CONSTRAINT `usuario-sonda` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla gti_equipo7.sonda: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `sonda` DISABLE KEYS */;
/*!40000 ALTER TABLE `sonda` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `contraseña` int(11) NOT NULL,
  `rol` enum('admin','user','sincro') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla gti_equipo7.usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
REPLACE INTO `usuarios` (`id`, `usuario`, `contraseña`, `rol`) VALUES
	(1, 'admin@gmail.com', 1234, 'admin'),
	(2, 'user@gmail.com', 1234, 'user');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla gti_equipo7.vertices
CREATE TABLE IF NOT EXISTS `vertices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parcela` int(11) NOT NULL COMMENT 'id de la parcela',
  `coordenadas` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parcela-vertices` (`parcela`),
  CONSTRAINT `parcela-vertices` FOREIGN KEY (`parcela`) REFERENCES `parcelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla gti_equipo7.vertices: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `vertices` DISABLE KEYS */;
/*!40000 ALTER TABLE `vertices` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
