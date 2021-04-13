-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-04-2021 a las 08:53:37
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
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Tecnologia'),
(2, 'Alimentos'),
(3, 'Textiles'),
(4, 'Videojuegos'),
(5, 'Juguetes'),
(6, 'Higiene');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `categoria` int(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `categoria`, `stock`, `imagen`, `precio`) VALUES
(2, 'Azúcar', 2, 45, 'Azucar.jpg', 5.35),
(3, 'Pantalla LED', 1, 41, 'Pantalla.jpg', 149.99),
(4, 'Juguete', 5, 16, 'Juguete.jpg', 49.99),
(5, 'Camiseta', 3, 50, 'Camiseta.jpg', 19.99),
(6, 'Pescado', 2, 41, 'Pescado.jpg', 12),
(7, 'Queso', 2, 212, 'Queso.jpg', 0.35),
(8, 'Jamón', 2, 0, 'Jamon.jpg', 59.99),
(9, 'Pantalones', 3, 0, 'Pantalones.jpg', 19.99),
(10, 'Zapatillas', 3, 39, 'Zapatillas.jpg', 19),
(11, 'Gorra', 3, 34, 'Gorra.jpg', 25),
(13, 'Samgung Galaxy 10', 1, 46, 'SamsungG10.jpg', 199.99),
(14, 'Xiaomi Redmi Note 10', 1, 36, 'XiaomiRN.jpg', 199.99),
(15, 'Pizza', 2, 40, 'Pizza.jpg', 2.5),
(16, 'Pasta dental', 6, 100, 'PastaDental.jpg', 5),
(17, 'Call of Duty', 4, 999, 'CallOfDuty.jpg', 59.99),
(30, 'Manzana', 2, 295, 'Manzana2.png', 0.3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productousuario`
--

CREATE TABLE `productousuario` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productousuario`
--

INSERT INTO `productousuario` (`id`, `cantidad`, `idUsuario`, `idProducto`) VALUES
(1, 5, 1, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `CP` int(5) DEFAULT NULL,
  `admin` int(11) DEFAULT 0,
  `usuario` varchar(20) DEFAULT NULL,
  `pass` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `dni`, `nombre`, `apellidos`, `email`, `direccion`, `ciudad`, `CP`, `admin`, `usuario`, `pass`) VALUES
(1, '1234567A', 'Patata', 'Frita', 'patatafrita@patato.pat', 'Calle Patata 123', 'Patatalandia', 12345, 1, 'Patata', '$2y$10$xDf7lbMugpZIWTTIaDcTVOumrxjNc9avQnxz/UT7hvKLXCEQqXitO'),
(2, '12345678B', 'not', 'admin', 'usuariorandom@patata.com', 'Calle Patata 121', 'Patatalandia', 12345, 0, 'notadmin', '$2y$10$Roqe1nekDuQpZWfai59E1OOlgWLPkAQSpS9jpt2aezEt8gQO/hwEK');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria` (`categoria`);

--
-- Indices de la tabla `productousuario`
--
ALTER TABLE `productousuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `productousuario`
--
ALTER TABLE `productousuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `productousuario`
--
ALTER TABLE `productousuario`
  ADD CONSTRAINT `productousuario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productousuario_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
