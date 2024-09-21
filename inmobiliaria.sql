-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-09-2024 a las 17:59:48
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `duenio`
--

DROP TABLE IF EXISTS `duenio`;
CREATE TABLE IF NOT EXISTS `duenio` (
  `id_owner` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  PRIMARY KEY (`id_owner`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `duenio`
--

INSERT INTO `duenio` (`id_owner`, `name`, `phone`, `email`) VALUES
(1, 'Eduardo', '+54 9 2494060417', 'eduardo@gmail.com'),
(2, 'Eduardo', '+54 9 2494060417', 'eduardo@gmail.com'),
(3, 'Lis', '+54 9 2494060417', 'lis@gmail.com'),
(4, 'Diego', '+54 9 2494367895', 'diego@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedad`
--

DROP TABLE IF EXISTS `propiedad`;
CREATE TABLE IF NOT EXISTS `propiedad` (
  `id_property` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `zone` varchar(45) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` varchar(500) NOT NULL,
  `mode` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `city` varchar(45) NOT NULL,
  `id_owner` int(11) NOT NULL,
  PRIMARY KEY (`id_property`),
  KEY `id_duenioFK` (`id_owner`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `propiedad`
--

INSERT INTO `propiedad` (`id_property`, `type`, `zone`, `price`, `description`, `mode`, `status`, `city`, `id_owner`) VALUES
(1, 'Casa', 'Barrio Procrear', 100000, 'Cuenta con 3 dormitorios(2 en planta alta), 2 baños (uno en planta alta), living/comedor, cocina separada, patio amplio con césped, garage cubierto con portón y entrada directa a la casa. Calefacción por Calefactores. Ventiladores de techo.', 'Venta', 'Disponible', 'Tandil', 3),
(2, 'Casa', 'Barrio Procrear', 100000, 'Cuenta con 3 dormitorios(2 en planta alta), 2 baños (uno en planta alta), living/comedor, cocina separada, patio amplio con césped, garage cubierto con portón y entrada directa a la casa. Calefacción por Calefactores. Ventiladores de techo.', 'Venta', 'Disponible', 'Tandil', 3),
(3, 'Departamento', 'Cerrito', 110000, 'Cuenta con 2 dormitorios, baño, cocina, living/comedor, amplio balcón, terraza con espacio para parrilla. 84m2 TOTAL . Una unidad para aprovechar, por su buen valor y estado.', 'Alquiler', 'Alquilado', 'Tandil', 3),
(4, 'Quinta', 'Centinela', 150000, 'Quinta en venta: amplio terreno, piscina, parrilla y hermosa arboleda. Ideal para disfrutar de la tranquilidad.', 'Venta', 'Disponible', 'Tandil', 2),
(6, 'Departamento', 'Centro', 200000, 'Departamento luminoso', 'Alquiler', 'Alquilado', 'Tandil', 3);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `propiedad`
--
ALTER TABLE `propiedad`
  ADD CONSTRAINT `propiedad_ibfk_1` FOREIGN KEY (`id_owner`) REFERENCES `duenio` (`id_owner`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
