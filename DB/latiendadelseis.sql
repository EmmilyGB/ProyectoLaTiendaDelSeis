-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-02-2026 a las 21:16:14
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

--
-- Volcado de datos para la tabla `carrusel`
--

INSERT INTO `carrusel` (`Id`, `IdProducto`) VALUES
(2, 9),
(3, 10),
(4, 11);

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

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`IdDetalle`, `IdFactura`, `IdProducto`, `Cantidad`, `PrecioUnitario`, `Subtotal`) VALUES
(37, 26, 28, 1, 150000, 150000);

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
  `Total` int(11) DEFAULT NULL,
  `Estado` varchar(20) NOT NULL DEFAULT 'Pendiente',
  `Inhabilitado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`IdFactura`, `FechaFactura`, `NumDoc`, `Total`, `Estado`, `Inhabilitado`) VALUES
(9, '2026-02-04', 1102346558, 1141000, 'Pendiente', 0),
(10, '2026-02-04', 1102346558, 1555500, 'Pendiente', 0),
(11, '2026-02-04', 1102346558, 2070000, 'Pendiente', 0),
(12, '2026-02-04', 1102346558, 500000, 'Pendiente', 0),
(13, '2026-02-04', 1102346558, 1461000, 'Pendiente', 0),
(14, '2026-02-04', 1104578992, 1461000, 'Pendiente', 0),
(15, '2026-02-04', 1106634561, 1555500, 'Pendiente', 1),
(16, '2026-02-16', 999999999, 1366500, 'Pendiente', 0),
(17, '2026-02-16', 2147483647, 1100000, 'Enviado', 0),
(18, '2026-02-17', 1105466149, 550000, 'Finalizado', 0),
(19, '2026-02-18', 1105466149, 1785500, 'Finalizado', 0),
(20, '2026-02-18', 1105466149, 1880000, 'En proceso', 0),
(21, '2026-02-18', 1105466149, 920000, 'Pendiente', 0),
(22, '2026-02-19', 1105466149, 455500, 'Pendiente', 0),
(23, '2026-02-23', 1105466149, 500000, 'Pendiente', 0),
(24, '2026-02-23', 1105466149, 1649700, 'Pendiente', 0),
(25, '2026-02-25', 1105466149, 549900, 'Pendiente', 0),
(26, '2026-02-25', 1105466149, 150000, 'Pendiente', 0);

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
(18, '1105466149', 19, '2026-02-23 17:26:15');

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
(9, 'onitsuka'),
(10, 'Jordan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_producto`
--

CREATE TABLE `oferta_producto` (
  `Id` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `PrecioOferta` decimal(10,2) NOT NULL,
  `ActualizadoEn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oferta_producto`
--

INSERT INTO `oferta_producto` (`Id`, `IdProducto`, `PrecioOferta`, `ActualizadoEn`) VALUES
(18, 28, 150000.00, '2026-02-25 18:59:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `NumDoc` varchar(50) NOT NULL,
  `Token` varchar(255) NOT NULL,
  `ExpiresAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`id`, `NumDoc`, `Token`, `ExpiresAt`) VALUES
(16, '1105466149', 'd36d50b2f2db3cbded9f102bb980456ce2238d9bca1565e8140ac2501e0b3da1', '2026-02-19 19:42:44');

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
  `Foto` varchar(250) DEFAULT NULL,
  `IdCategoria` int(11) DEFAULT NULL,
  `IdMarca` int(11) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `Nombre`, `Material`, `Precio`, `IdTalla`, `IdColor`, `Stock`, `Foto`, `IdCategoria`, `IdMarca`, `Descripcion`) VALUES
(28, 'New Balance 550', 'cuerina', 550000, 2, 7, 10, '1772045953_Captura_de_pantalla_2026-02-23_153001.png', 1, 4, 'Las New Balance 550 son zapatillas que debutaron en 1989 y han dejado una huella en el baloncesto y la moda. Originalmente lanzadas como zapatillas de baloncesto, han resurgido como un modelo emblemático, combinando un diseño retro con comodidad moderna.\r\n'),
(29, 'Jordan 3 J Balvín ', 'Cuero', 660000, 2, 7, 10, '1772049618_1220961_01.jpg.webp', 1, 10, 'El J Balvin x Air Jordan 3 Retro \'Medellín Sunset\' reúne a los socios creativos en una combinación de colores tropical de la icónica silueta. Inspirado en las impresionantes puestas de sol de la ciudad natal de J Balvin, Medellín, Colombia, esta edición especial AJ3 presenta una parte superior de cu'),
(30, 'Jordan 3 J Balvín ', 'Cuero', 660000, 3, 7, 10, '1772049618_1220961_01.jpg.webp', 1, 10, 'El J Balvin x Air Jordan 3 Retro \'Medellín Sunset\' reúne a los socios creativos en una combinación de colores tropical de la icónica silueta. Inspirado en las impresionantes puestas de sol de la ciudad natal de J Balvin, Medellín, Colombia, esta edición especial AJ3 presenta una parte superior de cu'),
(31, 'Jordan 3 J Balvín ', 'Cuero', 660000, 4, 7, 10, '1772049618_1220961_01.jpg.webp', 1, 10, 'El J Balvin x Air Jordan 3 Retro \'Medellín Sunset\' reúne a los socios creativos en una combinación de colores tropical de la icónica silueta. Inspirado en las impresionantes puestas de sol de la ciudad natal de J Balvin, Medellín, Colombia, esta edición especial AJ3 presenta una parte superior de cu'),
(32, 'Jordan 3 J Balvín ', 'Cuero', 660000, 5, 7, 10, '1772049618_1220961_01.jpg.webp', 1, 10, 'El J Balvin x Air Jordan 3 Retro \'Medellín Sunset\' reúne a los socios creativos en una combinación de colores tropical de la icónica silueta. Inspirado en las impresionantes puestas de sol de la ciudad natal de J Balvin, Medellín, Colombia, esta edición especial AJ3 presenta una parte superior de cu'),
(33, 'New Balance 550', 'cuerina', 550000, 3, 7, 10, '1772045953_Captura_de_pantalla_2026-02-23_153001.png', 1, 4, 'Las New Balance 550 son zapatillas que debutaron en 1989 y han dejado una huella en el baloncesto y la moda. Originalmente lanzadas como zapatillas de baloncesto, han resurgido como un modelo emblemático, combinando un diseño retro con comodidad moderna.\r\n'),
(34, ' Knu Skool Vans | Chunky Train', 'Gamusa', 700000, 5, 8, 10, '1772049966_Knu-Skool-Suede-Shoe.jpg', 3, 3, ' California el 16 de marzo. Van Doren Rubber Company es único en que fabrica zapatos en las mismas instalaciones y los vende directamente al público. En esa primera mañana, 12 clientes compran zapatos, que se hicieron ese día y quedan listos para recoger esa misma tarde VANS #44 DECK SHOES, AHORA CO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_foto`
--

CREATE TABLE `producto_foto` (
  `IdFoto` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `RutaFoto` varchar(255) NOT NULL,
  `Orden` int(11) NOT NULL DEFAULT 0,
  `EsPrincipal` tinyint(1) NOT NULL DEFAULT 0,
  `FechaRegistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_foto`
--

INSERT INTO `producto_foto` (`IdFoto`, `IdProducto`, `RutaFoto`, `Orden`, `EsPrincipal`, `FechaRegistro`) VALUES
(2, 29, '1772049618_0_3333.jpg', 1, 0, '2026-02-25 20:00:18');

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
(999999999, 'Administrador Auto', 'admin_auto@gmail.com', '$2y$10$OR0cqmh9aYAnj9yE.axiz.EKaI9mopVCZaGr4WPAzyBkVskXvfqVO', '3154798662', 'holhol', 1, 1),
(1102346558, 'Cliente nuevo', 'cliente_nuevo@gmail.com', '$2y$10$Ie7gr.0X2NZoXRJMEgxim.v6KnHymhX2XfV8tb83hShhVq4szpPVq', '3154798662', 'prueba cliente colombia', 3, 2),
(1104578992, 'Usuario nuevo', 'Usuario@gmail.com', '$2y$10$fd92aX3j7e0alYCFKsgRAen1ZKgTWuv230d5L1VDcaB96tWXD4aca', '514278963', 'Manzana p casa 7 praderas del norte', 3, 2),
(1105466149, 'sebastian vargas', 'sebastianvargas2246@gmail.com', '$2y$10$zfGCKeeXbPWQp/L1jwq7AO2JUGN/9sNISql7h.U0EWQEz.5d28zKa', '123', 'Mz B casa 14', 3, 2),
(1106634561, 'Danna Sofia Buritica', 'danfia.bl02@gmail.com', '$2y$10$mmKkwEzXWAPkUpN7axUYR.wpffwgK5ChV.P/Xyr77Nr1yA6wDfyh6', '3126074544', 'Manzana p casa 7 praderas del norte', 2, 2),
(1107546225, 'Emmily Giraldo Buritica', 'emmilygiraldo0208@gmail.com', '$2y$10$683SCZfOZnHtgSdmguVjgugRUB3JG1W7m.r74CocpnM/MWE.LQV76', '312456789', '2do jardín verde', 2, 2),
(2147483647, 'Harvey caicedo', 'Harvey@gmail.com', '$2y$10$nbzdFfKK1P2rzq0j6141KueTimbxTjKn04BEqv/IkJfCWYt0XLo5m', '123456789', 'dfghj,.', 3, 2);

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
-- Indices de la tabla `oferta_producto`
--
ALTER TABLE `oferta_producto`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NumDoc` (`NumDoc`),
  ADD KEY `Token` (`Token`);

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
-- Indices de la tabla `producto_foto`
--
ALTER TABLE `producto_foto`
  ADD PRIMARY KEY (`IdFoto`),
  ADD KEY `idx_producto_foto_producto` (`IdProducto`);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `IdColor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `IdDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  MODIFY `IdFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `IdMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `oferta_producto`
--
ALTER TABLE `oferta_producto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `producto_foto`
--
ALTER TABLE `producto_foto`
  MODIFY `IdFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Filtros para la tabla `producto_foto`
--
ALTER TABLE `producto_foto`
  ADD CONSTRAINT `fk_producto_foto_producto` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

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
