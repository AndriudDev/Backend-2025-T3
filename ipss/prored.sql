-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2025 a las 03:26:56
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
-- Base de datos: `prored`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `empresaTipo_id` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `empresaTipo_id`, `activo`) VALUES
(1, 'Reciclajes Santiago Ltda.', 7, 0),
(2, 'Consultora financiera Ltda.', 2, 1),
(3, 'Consultores Asociados S.A.', 3, 1),
(4, 'Transporte Express Ltda.', 4, 1),
(5, 'Gestor Integral Chile S.A.', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresatipo`
--

CREATE TABLE `empresatipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `codigo` varchar(2) NOT NULL,
  `icono_fa` varchar(50) DEFAULT NULL,
  `color_tw` varchar(30) DEFAULT NULL,
  `color_css` varchar(30) DEFAULT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresatipo`
--

INSERT INTO `empresatipo` (`id`, `nombre`, `codigo`, `icono_fa`, `color_tw`, `color_css`, `activo`) VALUES
(1, 'Reciclador de Base', 'R', 'fa-recycle11', 'bg-green123123123-100', 'rgb(220 252 231)', 1),
(2, 'Valorizador', 'V', 'fa-industry', 'bg-blue-100', '#eff6ff', 1),
(3, 'Consultor', 'C', 'fa-user-tie', 'bg-gray-100', '#f3f4f6', 1),
(4, 'Transportista', 'T', 'fa-truck', 'bg-yellow-100', 'rgb(254 249 195)', 1),
(5, 'Gestor Integral', 'G', 'fa-globe-americas', 'bg-purple-100', 'rgb(243, 232, 255)', 1),
(7, 'Reciclador de Bas2e', 'R1', 'fa-recycle', 'bg-green-100', 'rgb(220 252 231)', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `empresaTipo_id` (`empresaTipo_id`);

--
-- Indices de la tabla `empresatipo`
--
ALTER TABLE `empresatipo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `empresatipo`
--
ALTER TABLE `empresatipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`empresaTipo_id`) REFERENCES `empresatipo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
