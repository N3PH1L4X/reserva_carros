-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2024 a las 06:58:18
-- Versión del servidor: 8.0.33
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reserva_carritos`
--
CREATE DATABASE IF NOT EXISTS `reserva_carritos` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `reserva_carritos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carro`
--

DROP TABLE IF EXISTS `carro`;
CREATE TABLE IF NOT EXISTS `carro` (
  `id_carro` int NOT NULL AUTO_INCREMENT,
  `cant_comp_carro` int NOT NULL,
  PRIMARY KEY (`id_carro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Truncar tablas antes de insertar `carro`
--

TRUNCATE TABLE `carro`;
--
-- Volcado de datos para la tabla `carro`
--

INSERT INTO `carro` (`id_carro`, `cant_comp_carro`) VALUES
(1, 40),
(2, 40),
(3, 40),
(4, 30),
(5, 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela`
--

DROP TABLE IF EXISTS `escuela`;
CREATE TABLE IF NOT EXISTS `escuela` (
  `id_escuela` int NOT NULL AUTO_INCREMENT,
  `nombre_escuela` varchar(45) NOT NULL,
  PRIMARY KEY (`id_escuela`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Truncar tablas antes de insertar `escuela`
--

TRUNCATE TABLE `escuela`;
--
-- Volcado de datos para la tabla `escuela`
--

INSERT INTO `escuela` (`id_escuela`, `nombre_escuela`) VALUES
(1, 'Escuela de Administración y Negocios'),
(2, 'Escuela de Construcción'),
(3, 'Escuela de Ingeniería y Recursos Naturales'),
(4, 'Escuela de Salud'),
(5, 'Escuela de Informática y Telecomunicaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

DROP TABLE IF EXISTS `profesor`;
CREATE TABLE IF NOT EXISTS `profesor` (
  `id_profesor` int NOT NULL AUTO_INCREMENT,
  `nombre_profesor` varchar(45) DEFAULT NULL,
  `apellido_profesor` varchar(45) DEFAULT NULL,
  `escuela_id_escuela` int NOT NULL,
  PRIMARY KEY (`id_profesor`),
  KEY `fk_profesor_escuela_idx` (`escuela_id_escuela`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Truncar tablas antes de insertar `profesor`
--

TRUNCATE TABLE `profesor`;
--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id_profesor`, `nombre_profesor`, `apellido_profesor`, `escuela_id_escuela`) VALUES
(1, 'Carlos', 'Correa Sanhueza', 5),
(2, 'Sebastian', 'Blanco Mac-Namara', 5),
(3, 'Nicolas', 'Muñoz', 5),
(4, 'Emanuel', 'Lopez Adaro', 5),
(5, 'Cristofer', 'San Martin', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `id_reserva` int NOT NULL AUTO_INCREMENT,
  `hora_inicio` datetime DEFAULT NULL,
  `hora_termino` datetime DEFAULT NULL,
  `profesor_id_profesor` int NOT NULL,
  `sala_id_sala` int DEFAULT NULL,
  `carro_id_carro` int NOT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `fk_reserva_profesor1_idx` (`profesor_id_profesor`),
  KEY `fk_reserva_sala1_idx` (`sala_id_sala`),
  KEY `fk_reserva_carro1_idx` (`carro_id_carro`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

--
-- Truncar tablas antes de insertar `reserva`
--

TRUNCATE TABLE `reserva`;
--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `hora_inicio`, `hora_termino`, `profesor_id_profesor`, `sala_id_sala`, `carro_id_carro`) VALUES
(22, '2023-06-13 10:30:00', '2023-06-13 11:30:00', 2, 3, 3),
(23, '2023-06-13 14:30:00', '2023-06-13 15:30:00', 1, 3, 4),
(24, '2023-06-13 08:30:00', '2023-06-13 09:30:00', 4, 99999999, 1),
(25, '2024-01-23 10:30:00', '2024-01-23 11:30:00', 4, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

DROP TABLE IF EXISTS `sala`;
CREATE TABLE IF NOT EXISTS `sala` (
  `id_sala` int NOT NULL AUTO_INCREMENT,
  `piso_sala` int NOT NULL,
  `numero_sala` int NOT NULL,
  PRIMARY KEY (`id_sala`)
) ENGINE=InnoDB AUTO_INCREMENT=100000000 DEFAULT CHARSET=utf8mb3;

--
-- Truncar tablas antes de insertar `sala`
--

TRUNCATE TABLE `sala`;
--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`id_sala`, `piso_sala`, `numero_sala`) VALUES
(1, 3, 305),
(2, 3, 306),
(3, 3, 307),
(4, 3, 308),
(5, 3, 309),
(99999999, 1, 109);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `fk_profesor_escuela` FOREIGN KEY (`escuela_id_escuela`) REFERENCES `escuela` (`id_escuela`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_reserva_carro1` FOREIGN KEY (`carro_id_carro`) REFERENCES `carro` (`id_carro`),
  ADD CONSTRAINT `fk_reserva_profesor1` FOREIGN KEY (`profesor_id_profesor`) REFERENCES `profesor` (`id_profesor`),
  ADD CONSTRAINT `fk_reserva_sala1` FOREIGN KEY (`sala_id_sala`) REFERENCES `sala` (`id_sala`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
