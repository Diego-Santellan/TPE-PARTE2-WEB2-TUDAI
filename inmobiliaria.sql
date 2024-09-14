--inf. de la versión de phpMyAdmin usada para generar el volcado,  la versión del servidor de la DB y de PHP:
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-09-2024 a las 22:26:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12


-- Configuración del entorno SQL: configuraciones clave para la ejecución de las transacciones SQL.



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";--controla el valor de A.I en las tablas.
START TRANSACTION;--inicia una transacción para garantizar que todas las operaciones se realicen en conjunto. 
SET time_zone = "+00:00";-- establece  zona horaria.


--Configuración de la codificación de caracteres para que esta sea compatible con utf8mb4, que permite almacenar emojis y  caracteres especiales.

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--4. Creación de la base de datos y uso
-- Base de datos: `inmobiliaria`
--crea la  DB inmobiliaria si no existe y luego la selecciona para empezar a trabajar en ella. especifica que utilizará la codificación utf8.

CREATE DATABASE IF NOT EXISTS `inmobiliaria` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `inmobiliaria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `duenio`
-- Creación de la tabla duenio

--

DROP TABLE IF EXISTS `duenio`;--Elimina la tabla duenio si ya existe para evitar conflictos.

CREATE TABLE `duenio` (--Define la estructura de la tabla duenio con 4 columnas. La tabla está configurada para usar el motor InnoDB, lo cual es importante porque soporta integridad referencial y transacciones.
  `id_duenio` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 6. Inserción de datos en la tabla duenio.Cada fila representa a un dueño
--

INSERT INTO `duenio` (`id_duenio`, `nombre`, `telefono`, `email`) VALUES
(1, 'Eduardo', '+54 9 2494060417', 'eduardo@gmail.com'),
(2, 'Eduardo', '+54 9 2494060417', 'eduardo@gmail.com'),
(3, 'Lis', '+54 9 2494060417', 'lis@gmail.com'),
(4, 'Diego', '+54 9 2494367895', 'diego@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedad`. Creación de dicha tabla: Almacena las propiedades, con columnas que definen el tipo de propiedad, ubicación, precio, descripción, y su relación con el dueño (id_duenio).


--

DROP TABLE IF EXISTS `propiedad`;
CREATE TABLE `propiedad` (
  `id_propiedad` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `zona` varchar(45) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `modalidad` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `localidad` varchar(45) NOT NULL,
  `id_duenio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `propiedad`. se insertan propiedades con sus detalles, incluyendo el id_duenio que relaciona cada propiedad con su dueño.
--

INSERT INTO `propiedad` (`id_propiedad`, `tipo`, `zona`, `precio`, `descripcion`, `modalidad`, `estado`, `localidad`, `id_duenio`) VALUES
(1, 'Casa', 'Barrio Procrear', 100000, 'Cuenta con 3 dormitorios(2 en planta alta), 2 baños (uno en planta alta), living/comedor, cocina separada, patio amplio con césped, garage cubierto con portón y entrada directa a la casa. Calefacción por Calefactores. Ventiladores de techo.', 'Venta', 'Disponible', 'Tandil', 3),
(2, 'Casa', 'Barrio Procrear', 100000, 'Cuenta con 3 dormitorios(2 en planta alta), 2 baños (uno en planta alta), living/comedor, cocina separada, patio amplio con césped, garage cubierto con portón y entrada directa a la casa. Calefacción por Calefactores. Ventiladores de techo.', 'Venta', 'Disponible', 'Tandil', 3),
(3, 'Departamento', 'Cerrito', 110000, 'Cuenta con 2 dormitorios, baño, cocina, living/comedor, amplio balcón, terraza con espacio para parrilla. 84m2 TOTAL . Una unidad para aprovechar, por su buen valor y estado.', 'Alquiler', 'Alquilado', 'Tandil', 3),
(4, 'Quinta', 'Centinela', 150000, 'Quinta en venta: amplio terreno, piscina, parrilla y hermosa arboleda. Ideal para disfrutar de la tranquilidad.', 'Venta', 'Disponible', 'Tandil', 2),
(6, 'Departamento', 'Centro', 200000, 'Departamento luminoso', 'Alquiler', 'Alquilado', 'Tandil', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `duenio`
--
-- Claves primarias: se establece que id_duenio es la clave primaria en duenio y id_propiedad en propiedad, lo que asegura la unicidad de los registros.
-- Claves foráneas: id_duenioFK es una clave foránea que relaciona la tabla propiedad con duenio.
ALTER TABLE `duenio`
  ADD PRIMARY KEY (`id_duenio`);

--
-- Indices de la tabla `propiedad`
--
ALTER TABLE `propiedad`
  ADD PRIMARY KEY (`id_propiedad`),
  ADD KEY `id_duenioFK` (`id_duenio`);

--
-- AUTO_INCREMENT de las tablas volcadas: Define que las columnas id_duenio y id_propiedad sean auto-incrementables, lo que significa que se incrementarán automáticamente cuando se inserten nuevos registros.


--

--
-- AUTO_INCREMENT de la tabla `duenio`
--
ALTER TABLE `duenio`
  MODIFY `id_duenio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `propiedad`
--
ALTER TABLE `propiedad`
  MODIFY `id_propiedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `propiedad`
--
ALTER TABLE `propiedad`
  ADD CONSTRAINT `propiedad_ibfk_1` FOREIGN KEY (`id_duenio`) REFERENCES `duenio` (`id_duenio`);

COMMIT;--Este comando finaliza la transacción, confirmando que todos los cambios realizados en la base de datos son permanentes.



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
