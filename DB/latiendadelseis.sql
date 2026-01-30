-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2026 a las 08:53:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `latiendadelseis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrusel`
--

CREATE TABLE `carrusel` (
  `Id` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IdCategoria` int(11) NOT NULL,
  `NomCategoria` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `NomCategoria`) VALUES
(1, 'Hombre'),
(2, 'Mujer'),
(3, 'Unisex');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `IdColor` int(11) NOT NULL,
  `NomColor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`IdColor`, `NomColor`) VALUES
(1, 'Azul'),
(2, 'Morado'),
(3, 'Verde'),
(4, 'Naranja'),
(5, 'Rojo'),
(6, 'Cafe'),
(7, 'Blanco'),
(8, 'Negro'),
(9, 'Beige'),
(10, 'Amarillo'),
(11, 'Rosado'),
(12, 'Fucsia'),
(13, 'Lila'),
(14, 'Agua Marina'),
(15, 'Vino Tinto'),
(16, 'Gris');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `IdDetalle` int(11) NOT NULL,
  `IdFactura` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `PrecioUnitario` int(11) NOT NULL,
  `Subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesalida`
--

CREATE TABLE `detallesalida` (
  `IdDetalle` int(11) NOT NULL,
  `IdFactura` int(11) DEFAULT NULL,
  `IdProducto` int(11) DEFAULT NULL,
  `CantSalida` int(11) DEFAULT NULL,
  `ValorUnitario` int(11) DEFAULT NULL,
  `ValorTotalVenta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devolucion`
--

CREATE TABLE `devolucion` (
  `IdDevolucion` int(11) NOT NULL,
  `IdEntrada` int(11) DEFAULT NULL,
  `FechaIngreso` date DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `IdProducto` int(11) DEFAULT NULL,
  `IdFactura` int(11) DEFAULT NULL,
  `DescripcionFactura` varchar(50) DEFAULT NULL,
  `NumDoc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `IdEntrada` int(11) NOT NULL,
  `FechaIngreso` date DEFAULT NULL,
  `IdProducto` int(11) DEFAULT NULL,
  `NumDoc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `IdFactura` int(11) NOT NULL,
  `FechaFactura` date DEFAULT NULL,
  `NumDoc` int(11) DEFAULT NULL,
  `Total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `Id` int(11) NOT NULL,
  `NumDoc` varchar(50) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`Id`, `NumDoc`, `IdProducto`, `created_at`) VALUES
(6, '1107845661', 9, '2026-01-30 02:24:54'),
(7, '1107845661', 10, '2026-01-30 02:24:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `IdMarca` int(11) NOT NULL,
  `NomMarca` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`IdMarca`, `NomMarca`) VALUES
(1, 'Puma'),
(2, 'Adidas'),
(3, 'Vans'),
(4, 'New Balance'),
(5, 'Nike'),
(6, 'Converse'),
(7, 'Asics'),
(8, 'onitsuka');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IdProducto` int(11) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `Material` varchar(60) DEFAULT NULL,
  `Precio` int(11) DEFAULT NULL,
  `IdTalla` int(11) DEFAULT NULL,
  `IdColor` int(11) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Oferta` int(1) DEFAULT NULL,
  `Foto` varchar(250) DEFAULT NULL,
  `IdCategoria` int(11) DEFAULT NULL,
  `IdMarca` int(11) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `UdMedida` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `Nombre`, `Material`, `Precio`, `IdTalla`, `IdColor`, `Stock`, `Oferta`, `Foto`, `IdCategoria`, `IdMarca`, `Descripcion`, `UdMedida`) VALUES
(9, 'Puma speedcat', 'Gamusa', 455500, 2, 8, 10, 0, '1767504850_Zapatillas.jpg', 1, 1, 'Los PUMA Club II llevan el estilo urbano a otro nivel con su diseño inspirado en la cultura de las gradas. Confeccionadas en ante de alta calidad y una duradera suela de goma, estos tenis ofrecen una comodidad excepcional que te acompaña desde la mañana hasta la noche. Cada paso refleja un estilo di', '0'),
(10, 'Adidas Campus', 'Gamusa', 550000, 2, 8, 10, 0, '1767649658_CampusZ.png', 1, 2, 'zap\'atillas de gamusa', '0'),
(11, 'Lattafa Yara 100ml', 'Vidrio', 230000, 1, 11, 10, 0, '1767649733_YaraP.png', 2, 1, 'perfume de mujer', '100ml');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Rol` int(11) NOT NULL,
  `NameRol` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`Rol`, `NameRol`) VALUES
(1, 'Admin'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla`
--

CREATE TABLE `talla` (
  `IdTalla` int(11) NOT NULL,
  `NomTalla` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `talla`
--

INSERT INTO `talla` (`IdTalla`, `NomTalla`) VALUES
(1, 36),
(2, 37),
(3, 38),
(4, 39),
(5, 40),
(6, 41),
(7, 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocum`
--

CREATE TABLE `tipodocum` (
  `IdTipoDocum` int(11) NOT NULL,
  `TipoDoc` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipodocum`
--

INSERT INTO `tipodocum` (`IdTipoDocum`, `TipoDoc`) VALUES
(1, 'RC'),
(2, 'TI'),
(3, 'CC'),
(4, 'PPT'),
(5, 'CE'),
(6, 'VISA'),
(7, 'PASS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `NumDoc` int(11) NOT NULL,
  `NombreCom` varchar(40) DEFAULT NULL,
  `Correo` varchar(60) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Tel` varchar(15) DEFAULT NULL,
  `Direccion` varchar(60) DEFAULT NULL,
  `IdTipoDocum` int(11) DEFAULT NULL,
  `Rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`NumDoc`, `NombreCom`, `Correo`, `Password`, `Tel`, `Direccion`, `IdTipoDocum`, `Rol`) VALUES
(999999999, 'Administrador Auto', 'admin_auto@gmail.com', '$2y$10$Is/4YL/34OPrfwP6yHkNRu9MqBYUvaClTsuhm1uWzgtOschUD2H3u', '', '', 1, 1),
(1107845661, 'Emmily giraldo', 'emmy@gmail.com', '$2y$10$S52PkZHKVxKp366x.9mzxOi8yPZWWxsfW.PFINpZvJwxljIOWi0c2', '987456321', 'pepelolo', 2, 2),
(1131573886, 'Cliente Prueba', 'Cliente@gmail.com', '$2y$10$pGnpeoX0MljED.yxYV4GqOFXZOzZJxZ2z7dgzNK6IX7zwILg/yeea', '3187916361', 'x', 3, 2),
(1134559887, 'Admin Prueba', 'Admin@gmail.com', '$2y$10$jMx76OusDm.n7nmavXv7wui5mekrXW9wAQQmPQnxhaDby01vNdoJi', '3187645957', 'jojojo', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrusel`
--
ALTER TABLE `carrusel`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`IdColor`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`IdDetalle`),
  ADD KEY `IdFactura` (`IdFactura`),
  ADD KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `detallesalida`
--
ALTER TABLE `detallesalida`
  ADD PRIMARY KEY (`IdDetalle`),
  ADD KEY `IdFactura` (`IdFactura`),
  ADD KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD PRIMARY KEY (`IdDevolucion`),
  ADD KEY `IdEntrada` (`IdEntrada`),
  ADD KEY `IdProducto` (`IdProducto`),
  ADD KEY `IdFactura` (`IdFactura`),
  ADD KEY `NumDoc` (`NumDoc`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`IdEntrada`),
  ADD KEY `IdProducto` (`IdProducto`),
  ADD KEY `NumDoc` (`NumDoc`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`IdFactura`),
  ADD KEY `NumDoc` (`NumDoc`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `uniq_user_prod` (`NumDoc`,`IdProducto`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`IdMarca`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`),
  ADD KEY `IdMarca` (`IdMarca`),
  ADD KEY `IdTalla` (`IdTalla`),
  ADD KEY `IdCategoria` (`IdCategoria`),
  ADD KEY `IdColor` (`IdColor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Rol`);

--
-- Indices de la tabla `talla`
--
ALTER TABLE `talla`
  ADD PRIMARY KEY (`IdTalla`);

--
-- Indices de la tabla `tipodocum`
--
ALTER TABLE `tipodocum`
  ADD PRIMARY KEY (`IdTipoDocum`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`NumDoc`),
  ADD KEY `IdTipoDocum` (`IdTipoDocum`),
  ADD KEY `Rol` (`Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrusel`
--
ALTER TABLE `carrusel`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `IdColor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `IdDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detallesalida`
--
ALTER TABLE `detallesalida`
  MODIFY `IdDetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `devolucion`
--
ALTER TABLE `devolucion`
  MODIFY `IdDevolucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `IdEntrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `IdFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `IdMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `talla`
--
ALTER TABLE `talla`
  MODIFY `IdTalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipodocum`
--
ALTER TABLE `tipodocum`
  MODIFY `IdTipoDocum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`IdFactura`) REFERENCES `factura` (`IdFactura`),
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`);

--
-- Filtros para la tabla `detallesalida`
--
ALTER TABLE `detallesalida`
  ADD CONSTRAINT `detallesalida_ibfk_1` FOREIGN KEY (`IdFactura`) REFERENCES `factura` (`IdFactura`),
  ADD CONSTRAINT `detallesalida_ibfk_2` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`);

--
-- Filtros para la tabla `devolucion`
--
ALTER TABLE `devolucion`
  ADD CONSTRAINT `devolucion_ibfk_1` FOREIGN KEY (`IdEntrada`) REFERENCES `entrada` (`IdEntrada`),
  ADD CONSTRAINT `devolucion_ibfk_2` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`),
  ADD CONSTRAINT `devolucion_ibfk_4` FOREIGN KEY (`IdFactura`) REFERENCES `factura` (`IdFactura`),
  ADD CONSTRAINT `devolucion_ibfk_5` FOREIGN KEY (`NumDoc`) REFERENCES `usuario` (`NumDoc`);

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`),
  ADD CONSTRAINT `entrada_ibfk_2` FOREIGN KEY (`NumDoc`) REFERENCES `usuario` (`NumDoc`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`NumDoc`) REFERENCES `usuario` (`NumDoc`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`IdMarca`) REFERENCES `marca` (`IdMarca`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`IdTalla`) REFERENCES `talla` (`IdTalla`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`),
  ADD CONSTRAINT `producto_ibfk_4` FOREIGN KEY (`IdColor`) REFERENCES `color` (`IdColor`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdTipoDocum`) REFERENCES `tipodocum` (`IdTipoDocum`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`Rol`) REFERENCES `rol` (`Rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
