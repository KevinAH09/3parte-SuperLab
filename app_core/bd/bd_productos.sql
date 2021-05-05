-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2021 a las 02:24:54
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE `tbl_productos` (
  `id` int UNSIGNED NOT NULL,
  `codigo` varchar(8) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int NOT NULL,
  `vencimiento` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `proveedor` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`id`, `codigo`, `nombre`, `precio`, `cantidad`, `vencimiento`, `proveedor`) VALUES
(1, 'PQ-0015', 'Sal Diamante Verde', 95, 200, '2021-04-10', 'Coopeagri'),
(2, 'PQ-0008', 'Galletas Saladitas', 200, 16, '2021-04-10', 'Coopeagri'),
(3, 'PQ-0006', 'Esponja la Negrita', 334, 200, '2021-04-10', 'Coopeagri'),
(4, 'PQ-0009', 'Jabon Protex', 280, 30, '2021-04-10', 'Coopeagri'),
(5, 'PQ-0011', 'Meneitos Jacks CremiDulce', 261, 15, '2021-04-10', 'Coopeagri'),
(6, 'PQ-0012', 'Natilla del Prado Especial', 300, 30, '2021-04-10', 'Coopeagri'),
(7, 'PQ-0016', 'Tortiricas Gruesitas', 375, 23, '2021-04-10', 'Coopeagri'),
(8, 'PQ-0004', 'Coca Cola', 900, 10, '2021-04-10', 'Coopeagri'),
(9, 'PQ-0003', 'Café 1820', 1340, 200, '2021-04-10', 'Coopeagri'),
(10, 'PQ-0014', 'Pepsi', 850, 100, '2021-04-10', 'Coopeagri'),
(28, 'PQ-00200', 'Helado', 3423, 50, '2021-04-10', 'coopeagri'),
(29, 'PQ-00207', 'f4543', 3423, 50, '2021-05-14', 'coopeagri'),
(30, 'PQ-00208', 'caca', 3423, 50, '2021-05-08', 'coopeagri');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

