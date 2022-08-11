-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-08-2022 a las 16:26:54
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `landing_page`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id_registro` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `nit` bigint(255) NOT NULL,
  `punto` varchar(255) NOT NULL,
  `equipo` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `promotor` varchar(255) NOT NULL,
  `rtc` bigint(255) NOT NULL,
  `capitan` varchar(255) NOT NULL,
  `dir_ip` varchar(255) NOT NULL,
  `terminos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id_registro`, `nombre`, `nit`, `punto`, `equipo`, `ciudad`, `promotor`, `rtc`, `capitan`, `dir_ip`, `terminos`) VALUES
(1, 'Sergio Gamboa', 123456789, 'Usaquen', 'Ganador', 'Bogota', 'Monster', 830654145, 'sgamboa', '200.14.52.88', 'acepta'),
(2, 'Jairo Anibal Niño', 9876543210, 'Bosa', 'El Zoro', 'Cali', 'Red Bull', 654651321, 'janibal', '199.211.90.87', 'acepta'),
(3, 'Pedro Paramo', 123456789, 'Bosa', 'Liquid', 'Santa Martha', 'Bavaria', 890444666, 'pparamo', '200.19.25.88', 'acepta');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id_registro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
