-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-07-2021 a las 20:57:17
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) UNSIGNED NOT NULL,
  `id_cliente` int(11) UNSIGNED NOT NULL,
  `id_producto` int(11) UNSIGNED NOT NULL,
  `precio` decimal(20,2) UNSIGNED NOT NULL,
  `cantidad` int(5) UNSIGNED NOT NULL,
  `talla` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `id_cliente`, `id_producto`, `precio`, `cantidad`, `talla`) VALUES
(64, 2, 17, '18.00', 1, '25'),
(65, 0, 17, '18.00', 1, '25'),
(66, 0, 19, '30.00', 5, '25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `telefono`, `apellidos`, `email`, `password`) VALUES
(1, 'Fernando', '3123124454', 'delgado', 'fernanbravo124@gmail.com', '1234'),
(33, 'dfsdf', '1234567890', 'fff', 'fwefw@gmail.com', 'prueba1234'),
(34, 'fernan', '2222222222', 'deldd', 'fwefw@gmail.com', ''),
(35, 'ffsfsd', '23123123', 'fsfsf', 'fernanbravo124@gmail.com', ''),
(36, '435345ghjghjg', '4535345345', NULL, 'fernanbravo124@gmail.com', ''),
(37, 'fer', '423423234', NULL, 'fernanbravo124@gmail.com', ''),
(38, 'fer', '1234567890', NULL, 'fwefw@gmail.com', ''),
(39, 'vcbcvb', '2342342', NULL, 'fwefw@gmail.com', ''),
(40, 'vcbcvb', '2342342', NULL, 'fwefw@gmail.com', ''),
(41, 'hfhfgh', '23423343', NULL, 'fernanbravo124@gmail.com', ''),
(42, 'hfhfgh', '23423343', NULL, 'fernanbravo124@gmail.com', ''),
(43, 'hfhfgh', '23423343', NULL, 'fernanbravo124@gmail.com', ''),
(44, 'hfhfgh', '23423343', NULL, 'fernanbravo124@gmail.com', ''),
(45, 'hfhfgh', '23423343', NULL, 'fernanbravo124@gmail.com', ''),
(46, 'hfhfgh', '23423343', NULL, 'fernanbravo124@gmail.com', ''),
(47, 'fer', '323123123', NULL, 'fwefw@gmail.com', ''),
(48, 'fer', '34234234231', NULL, 'fwefw@gmail.com', ''),
(49, 'fer', '34234234231', NULL, 'fwefw@gmail.com', ''),
(50, 'fer', '34234234231', NULL, 'fwefw@gmail.com', ''),
(51, 'fer', '34234234231', NULL, 'fwefw@gmail.com', ''),
(52, 'd', '65658598', NULL, 'fwefw@gmail.com', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `id_envio` int(11) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `ciudad` varchar(60) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `info_adicional_direccion` varchar(100) NOT NULL,
  `info_adicional_referencia` varchar(150) NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `envios`
--

INSERT INTO `envios` (`id_envio`, `pais`, `direccion`, `ciudad`, `estado`, `codigo_postal`, `info_adicional_direccion`, `info_adicional_referencia`, `id_venta`) VALUES
(93, 'méxico', 'aserae', 'jbjh', 'drdr', 45645, 'rweq', '', 96);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `id_pago_paypal` varchar(30) NOT NULL,
  `metodo` varchar(50) NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `imagen` varchar(70) NOT NULL,
  `descripcion` text NOT NULL,
  `promo` tinyint(1) NOT NULL,
  `precio_promo` decimal(20,2) NOT NULL,
  `genero` varchar(15) NOT NULL,
  `stock` int(5) NOT NULL,
  `precio` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `imagen`, `descripcion`, `promo`, `precio_promo`, `genero`, `stock`, `precio`) VALUES
(8, 'Producto 13', 'featured1.png', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque ipsum vel dui vestibulum accumsan. Curabitur at lectus vel mauris lobortis venenatis id in nisi. Cras ultrices dignissim lorem, sed tempus sapien dictum ultricies. Praesent a viverra mauris, non bibendum quam.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ', 0, '0.00', 'hombre', 55, '20.00'),
(9, 'Producto 8', 'new3.png', '                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque ipsum vel dui vestibulum accumsan. Curabitur at lectus vel mauris lobortis venenatis id in nisi. Cras ultrices dignissim lorem, sed tempus sapien dictum ultricies. Praesent a viverra mauris, non bibendum quam.                ', 0, '0.00', 'hombre', 50, '23.00'),
(10, 'Producto 12', 'featured3.png', '                 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque ipsum vel dui vestibulum accumsan. Curabitur at lectus vel mauris lobortis venenatis id in nisi.                                                ', 1, '30.00', 'mujer', 55, '39.00'),
(12, 'Producto 5', 'new1.png', '                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque ipsum vel dui vestibulum accumsan. Curabitur at lectus vel mauris lobortis venenatis id in nisi. Cras ultrices dignissim lorem, sed tempus sapien dictum ultricies. Praesent a viverra mauris, non bibendum quam.                                ', 0, '0.00', 'hombre', 50, '12.00'),
(15, 'Producto 6', 'new2.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque ipsum vel dui vestibulum accumsan. Curabitur at lectus vel mauris lobortis venenatis id in nisi. Cras ultrices dignissim lorem, sed tempus sapien dictum ultricies. Praesent a viverra mauris, non bibendum quam.', 0, '0.00', 'unisex', 50, '19.99'),
(16, 'Producto 7', 'featured2.png', '                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque ipsum vel dui vestibulum accumsan. Curabitur at lectus vel mauris lobortis venenatis id in nisi. Cras ultrices dignissim lorem, sed tempus sapien dictum ultricies. Praesent a viverra mauris, non bib                ', 0, '0.00', 'unisex', 50, '220.00'),
(17, 'Producto 2', 'new4.png', '                Sed scelerisque ipsum vel dui vestibulum accumsan. Curabitur at lectus vel mauris lobortis venenatis id in nisi. Cras ultrices dignissim lorem, sed tempus sapien dictum ultricies. Praesent a viverra mauris, non bibendum quam.                ', 1, '18.00', 'unisex', 50, '20.00'),
(18, 'Producto 9', 'new5.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque ipsum vel dui vestibulum accumsan. Curabitur at lectus vel mauris lobortis venenatis id in nisi. Cras ultrices dignissim lorem, sed tempus sapien dictum ultricies. Praesent a viverra mauris, non bibendum quam.', 0, '0.00', 'unisex', 50, '15.00'),
(19, 'Producto 10', 'women1.png', '                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque ipsum vel dui vestibulum accumsan. Curabitur at lectus vel mauris lobortis venenatis id in nisi. Cras ultrices dignissim lorem, sed tempus sapien dictum ultricies. Praesent a viverra mauris, non bibendum quam.                ', 1, '30.00', 'mujer', 50, '35.00'),
(20, 'Producto 11', 'women2.png', '                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque ipsum vel dui vestibulum accumsan. Curabitur at lectus vel mauris lobortis venenatis id in nisi. Cras ultrices dignissim lorem, sed tempus sapien dictum ultricies. Praesent a viverra mauris, non bibendum quam.                                ', 0, '0.00', 'mujer', 50, '15.00'),
(21, 'Producto 3', 'women3.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed scelerisque ipsum vel dui vestibulum accumsan. Curabitur at lectus vel mauris lobortis venenatis id in nisi. Cras ultrices dignissim lorem, sed tempus sapien dictum ultricies. Praesent a viverra mauris, non bibendum quam.', 0, '0.00', 'unisex', 50, '15.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla`
--

CREATE TABLE `talla` (
  `id` int(5) UNSIGNED NOT NULL,
  `talla` varchar(5) NOT NULL,
  `descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `talla`
--

INSERT INTO `talla` (`id`, `talla`, `descripcion`) VALUES
(37, '25', ''),
(38, '25.5', ''),
(39, '26', ''),
(40, '26.5', ''),
(41, '27', ''),
(42, '27.5', ''),
(43, '28', ''),
(44, '28.5', ''),
(45, '29', ''),
(46, '29.5', ''),
(47, '30', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nivel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `telefono`, `email`, `password`, `nivel`) VALUES
(1, 'Fernando', '9982184312', 'fernanbravo124@gmail.com', '1234', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) UNSIGNED NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `info_producto` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL,
  `id_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_cliente`, `info_producto`, `total`, `fecha`, `status`, `id_pago`) VALUES
(96, 52, '[{\"id\":\"19\",\"qty\":\"1\",\"price\":\"30.00\",\"size\":\"25\"}]', '30.00', '2021-05-29 10:05:36', '', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_cliente` (`id_cliente`) USING BTREE,
  ADD KEY `id_product` (`id_producto`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id_envio`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `talla`
--
ALTER TABLE `talla`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `id_envio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `talla`
--
ALTER TABLE `talla`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `id_product` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
