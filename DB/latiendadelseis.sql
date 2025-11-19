-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2025 a las 21:03:08
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
  `IdUsuario` int(11) DEFAULT NULL,
  `IdFactura` int(11) DEFAULT NULL,
  `DescripcionFactura` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `IdEntrada` int(11) NOT NULL,
  `FechaIngreso` date DEFAULT NULL,
  `IdProducto` int(11) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `IdFactura` int(11) NOT NULL,
  `FechaFactura` date DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`IdFactura`, `FechaFactura`, `IdUsuario`, `Total`) VALUES
(1, '2025-03-08', 4, 430000),
(2, '2025-02-06', 3, 349000),
(3, '2025-02-05', 5, 709000),
(4, '2025-01-01', 7, 618000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IdProducto` int(11) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `Material` varchar(60) DEFAULT NULL,
  `Precio` int(11) DEFAULT NULL,
  `Talla_unidadMedida` varchar(15) DEFAULT NULL,
  `Color` varchar(10) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Oferta` int(1) DEFAULT NULL,
  `Foto` varchar(250) DEFAULT NULL,
  `Categoria` varchar(12) DEFAULT NULL,
  `Marca` varchar(20) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `Nombre`, `Material`, `Precio`, `Talla_unidadMedida`, `Color`, `Stock`, `Oferta`, `Foto`, `Categoria`, `Marca`, `Descripcion`) VALUES
(1, 'Puma speedcat', 'Gamusa', 618000, '36-37-38-39-40', 'NEGRO', 80, 0, '1763530884_Zapatillas.jpg', 'Zapatillas', 'PUMA', 'Zapatillas rojas creadas e inspiradas para y en los corredores de la F1 ahora en material de gamusa desde la talla 36 a la 40'),
(2, 'Adidas Campus', 'Gamusa', 340900, '36-37-38-39-40', 'Negro', 80, 0, '1763530907_CampusZ.png', 'Zapatillas', 'ADIDAS', 'Zapatillas negras en gamusa desde la talla 36 a la 40'),
(3, 'Vans knu skool', 'Gamusa y lona', 430000, '36-37-38-39-40', 'Negro', 80, NULL, NULL, 'Zapatillas', 'VANS', 'Zapatillas negras en gamusa con una l?nea blanca lateral'),
(4, 'New balance 550', 'cuero, malla y Gamusa', 709000, '36-37-38-39-40', 'verde', 80, NULL, NULL, 'Zapatillas', 'NEW BALANCE', 'Zapatillas blancas con detalles verdes con un estilo retro'),
(5, 'Lattafa Yara', 'Vidrio', 180000, '100ml, 50ml', 'rosa claro', 80, 0, '1763531040_YaraP.png', 'Perfumes', 'LATTAFA', 'Famoso perfume para mujer se caracteriza por un aroma dulce, afrutado y cremoso'),
(6, 'puma ballerina', 'gamusa', 559000, '35-36-37-38', 'rosado', 80, 2, NULL, 'zapatillas', 'PUMA', 'zapatillas de gamusa ballerina '),
(7, 'vans', 'goma', 369000, '35-36-37-38', 'verde', 80, 2, '1763530810_vans-slip-on-trk-calzado-deportes-acuaticos.jpg', 'zapatillas', 'VANS', 'zapatillas de goma versatiles');

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
(2, 'Cliente'),
(3, 'Empleado');

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
  `IdUsuario` int(11) NOT NULL,
  `NumDoc` int(11) DEFAULT NULL,
  `TipoDoc` varchar(5) DEFAULT NULL,
  `NombreCom` varchar(40) DEFAULT NULL,
  `Correo` varchar(60) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL,
  `Tel` varchar(15) DEFAULT NULL,
  `Direccion` varchar(60) DEFAULT NULL,
  `IdTipoDocum` int(11) DEFAULT NULL,
  `Rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `NumDoc`, `TipoDoc`, `NombreCom`, `Correo`, `Password`, `Tel`, `Direccion`, `IdTipoDocum`, `Rol`) VALUES
(3, 146321789, 'CC', 'Julia castillo morales', 'juliacasmor25@gmail.com', 'Julia25', '2147483647', 'Mz C5 El casa verde murilo', NULL, 2),
(4, 1018567224, 'CC', 'mariana ricon mora', 'maririnmo86@gmail.com', 'marimari8686', '2147483647', 'Mj C7 mirador de boqueron', NULL, NULL),
(5, 142657930, 'TI', 'Mario contreras bello', 'mmariobello@gmail.com', 'bellobello34', '2147483647', 'Mk C9 El vergel', NULL, NULL),
(6, 107666666, 'CC', 'Dilan camilo blanco castillo', 'camicastillovla24@gmail.com', 'BlancoCastillo25', '2147483647', ' torre 4 apto304 conjunto miraflores', NULL, NULL),
(7, 1014736991, 'CC', 'Camila saavedra lima', 'camilima34@gmail.com', 'camcami1234', '2147483647', 'Mc C4 barrio villa cindy', NULL, NULL),
(8, 1013702224, 'TI', 'Andrea rojas primera', 'primerarojas2@gmail.com', 'RojasRojas2', '2147483647', 'Ma C8 calucaima', NULL, NULL),
(9, 1431567122, 'CC', 'Sebastian jimenez mendoza', 'sebasjimen76@gmail.com', '76mendoza', '2147483647', 'Mg C6 bella vista', NULL, NULL),
(10, 102476558, 'CC', 'juliana miranda cero', 'cerojuli0222@gmail.com', 'cerojul0222', '2147483647', 'Ml C2 loma alta', NULL, NULL);

--
-- Índices para tablas volcadas
--

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
  ADD KEY `IdUsuario` (`IdUsuario`),
  ADD KEY `IdFactura` (`IdFactura`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`IdEntrada`),
  ADD KEY `IdProducto` (`IdProducto`),
  ADD KEY `IdUsuario` (`IdUsuario`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`IdFactura`),
  ADD KEY `IdUsuario` (`IdUsuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Rol`);

--
-- Indices de la tabla `tipodocum`
--
ALTER TABLE `tipodocum`
  ADD PRIMARY KEY (`IdTipoDocum`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `IdTipoDocum` (`IdTipoDocum`),
  ADD KEY `Rol` (`Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

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
  MODIFY `IdFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipodocum`
--
ALTER TABLE `tipodocum`
  MODIFY `IdTipoDocum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

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
  ADD CONSTRAINT `devolucion_ibfk_4` FOREIGN KEY (`IdFactura`) REFERENCES `factura` (`IdFactura`);

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`),
  ADD CONSTRAINT `entrada_ibfk_2` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`);

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
