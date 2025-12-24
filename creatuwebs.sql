-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2025 a las 21:43:57
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
-- Base de datos: `creatuwebs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplos`
--

CREATE TABLE `ejemplos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `link` varchar(300) DEFAULT NULL,
  `plan` varchar(50) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ejemplos`
--

INSERT INTO `ejemplos` (`id`, `titulo`, `imagen`, `link`, `plan`, `activo`) VALUES
(1, 'Web de Clínica Dental', 'ejemplos/assets/dental/dental.gif', 'ejemplos/clinicadental.html', 'basico', 1),
(2, 'Web de Profesional Kinesiología', 'ejemplos/assets/kine/kine.gif', 'ejemplos/kinesiologia.html', 'basico', 1),
(3, 'Web de Portafolio de Desarrollador', 'ejemplos/assets/portafolio_desarro/port_desarro.gif', 'ejemplos/portafolio_desarro.html', 'basico', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hero`
--

CREATE TABLE `hero` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `subtitulo` varchar(500) DEFAULT NULL,
  `texto_boton` varchar(50) DEFAULT NULL,
  `link_boton` varchar(200) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `orden` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hero`
--

INSERT INTO `hero` (`id`, `titulo`, `subtitulo`, `texto_boton`, `link_boton`, `imagen`, `orden`, `activo`) VALUES
(1, 'Diseño web a medida para tu negocio', 'Creamos sitios web atractivos y funcionales que impulsan tu marca y atraen a tus clientes.', 'Ver Planes', '#servicios', 'assets/carru_1.png', 1, 1),
(2, 'Impulsa tu presencia online', 'Transforma tu idea en una web moderna, rápida y optimizada para todos los dispositivos.', 'Contáctanos', '#contactanos', 'assets/carru_2.png', 2, 1),
(3, 'Webs profesionales para tu negocio', 'Diseños personalizados que reflejan la esencia de tu marca y generan confianza.', 'Ver Ejemplos', '#portafolio', 'assets/carru_3.png', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `link` varchar(200) NOT NULL,
  `orden` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `nombre`, `link`, `orden`, `activo`) VALUES
(1, 'Inicio', '#home', 0, 1),
(2, 'Portafolio', '#portafolio', 1, 1),
(3, 'Servicios', '#servicios', 2, 1),
(4, 'FAQ', '#faq', 3, 1),
(5, 'Contáctanos', '#contactanos', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` DECIMAL(10,3) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `color_tema` varchar(20) DEFAULT NULL,
  `detalles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`detalles`)),
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `precio`, `descripcion`, `color_tema`, `detalles`, `activo`) VALUES
(1, 'Página Web Básica', 59.990, 'Ideal para emprendedores o negocios pequeños.', 'secondary', '[\r\n        \"✅Diseño personalizado\",\r\n        \"✅Hasta 4 páginas\",\r\n        \"✅5 Correos Corporativos\",\r\n        \"✅Diseño Responsive\",\r\n        \"✅Alta en Buscadores\",\r\n        \"✅Dominio y hosting (1 año)\",\r\n        \"✅Botón Redes Sociales\",\r\n        \"✅Certificado SSL\",\r\n        \"✅Soporte básico\",\r\n        \"✅Botón Contacto Whatsapp\",\r\n        \"✅Mapa Ubicación Google Maps\",\r\n        \"✅Capacitación\"\r\n    ]', 1),
(2, 'Página Web Autoadministrable', 109.990, 'Incluye panel para editar contenidos sin conocimientos técnicos.', 'primary', '[\r\n        \"✅Diseño personalizado\",\r\n        \"✅Hasta 10 páginas\",\r\n        \"✅10 Correos Corporativos\",\r\n        \"✅Diseño Responsive\",\r\n        \"✅Alta en Buscadores\",\r\n        \"✅Dominio y hosting (1 año)\",\r\n        \"✅Botón Redes Sociales\",\r\n        \"✅Certificado SSL\",\r\n        \"✅Soporte básico\",\r\n        \"✅Botón Contacto Whatsapp\",\r\n        \"✅Mapa Ubicación Google Maps\",\r\n        \"✅Posicionamiento Google (SEO)\",\r\n        \"✅Sitio Autoadministrable\",\r\n        \"✅Formulario de Contacto\",\r\n        \"✅Crear Textos e imágenes\",\r\n        \"✅Capacitación\"\r\n    ]', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ejemplos`
--
ALTER TABLE `ejemplos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ejemplos`
--
ALTER TABLE `ejemplos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `hero`
--
ALTER TABLE `hero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
