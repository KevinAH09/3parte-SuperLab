-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2021 a las 03:54:45
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_twitter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post` varchar(1024) NOT NULL,
  `date` varchar(20) NOT NULL,
  `tbl_posts_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_posts`
--

INSERT INTO `tbl_posts` (`id`, `post`, `date`, `tbl_posts_id`) VALUES
(64, 'holss', '2021-05-06 16:18:19', NULL),
(65, 'holaa', '2021-05-06 16:18:31', NULL),
(85, 'dd', '2021-05-06 16:45:13', 64),
(88, 'ddsdsd', '2021-05-06 16:45:22', 65),
(92, 'ddsds', '2021-05-06 17:45:52', 88),
(103, 'h<br> <img src=\"app_core/resources/files/gallina.png\" alt=\"\" title=\"\" width=\"40%\"/>', '2021-05-06 19:42:37', 65);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_tbl_posts_tbl_posts_idx` (`tbl_posts_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD CONSTRAINT `fk_tbl_posts_tbl_posts` FOREIGN KEY (`tbl_posts_id`) REFERENCES `tbl_posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
