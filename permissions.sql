-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2015 a las 23:00:06
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `saar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `model`, `created_at`, `updated_at`) VALUES
(1, 'Menu contrato', 'menu.contrato', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Menu factura', 'menu.factura', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Menu cliente', 'menu.cliente', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Menu modulo', 'menu.modulo', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Menu concepto', 'menu.concepto', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Menu pilotos', 'menu.piloto', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Menu aeronaves', 'menu.aeronave', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Menu puertos', 'menu.puerto', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Menu hangares', 'menu.hangar', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Menu modelo aeronave', 'menu.modeloaeronave', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Menu usuario', 'menu.usuario', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Menu cobranza', 'menu.cobranza', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Menu estacionamiento', 'menu.estacionamiento', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Menu grupos de usuario', 'menu.role', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Menu Aterrizaje', 'menu.aterrizaje', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Menu Despegue', 'menu.despegue', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Menu Carga', 'menu.carga', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Menu Configuración de Precios SCV', 'menu.preciosSCV', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Menú Información', 'menu.informacion', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Menú Reportes SCV', 'menu.reporteSCV', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Menú Reportes Recaudación', 'menu.reporteRecaudacion', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Menú Tasas', 'menu.tasas', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Menú Systas', 'menu.systas', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
