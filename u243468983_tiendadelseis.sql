-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-03-2026 a las 20:09:08
-- Versión del servidor: 11.8.6-MariaDB-log
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u243468983_tiendadelseis`
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
(35, 43),
(36, 48),
(37, 66),
(40, 71),
(39, 139),
(38, 149);

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
(40, 29, 29, 1, 319000, 319000),
(41, 30, 29, 1, 319000, 319000),
(42, 30, 28, 1, 550000, 550000),
(43, 31, 28, 1, 350000, 350000),
(44, 32, 28, 6, 350000, 2100000),
(47, 35, 28, 2, 350000, 700000),
(48, 35, 31, 2, 319000, 638000),
(49, 36, 43, 3, 499950, 1499850),
(51, 38, 28, 1, 350000, 350000),
(53, 40, 28, 1, 550000, 550000),
(58, 45, 53, 5, 459950, 2299750),
(59, 46, 43, 1, 499950, 499950),
(60, 47, 43, 1, 499950, 499950),
(63, 50, 38, 7, 394950, 2764650),
(64, 51, 53, 3, 459950, 1379850),
(65, 52, 28, 1, 550000, 550000),
(66, 53, 28, 8, 550000, 4400000),
(67, 53, 59, 10, 550000, 5500000),
(68, 54, 101, 2, 979000, 1958000),
(69, 54, 100, 1, 979000, 979000),
(70, 55, 28, 5, 550000, 2750000),
(71, 56, 94, 1, 259000, 259000),
(72, 56, 76, 1, 530000, 530000),
(73, 57, 76, 1, 530000, 530000),
(74, 58, 92, 2, 259000, 518000),
(75, 58, 122, 2, 509950, 1019900),
(76, 59, 89, 2, 198950, 397900),
(77, 60, 48, 2, 100000, 200000),
(78, 61, 149, 1, 549950, 549950),
(79, 62, 76, 2, 530000, 1060000),
(80, 62, 106, 1, 1334950, 1334950),
(81, 63, 127, 2, 679950, 1359900),
(82, 63, 103, 2, 160450, 320900);

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
(29, '2026-02-27', 1105466149, 319000, 'Finalizado', 0),
(30, '2026-02-27', 1105466149, 869000, 'Finalizado', 0),
(31, '2026-02-27', 1105466149, 350000, 'Finalizado', 0),
(32, '2026-02-27', 1105466149, 2100000, 'Finalizado', 0),
(35, '2026-02-27', 1105466149, 1338000, 'Finalizado', 0),
(36, '2026-02-27', 1105466149, 1499850, 'Finalizado', 0),
(38, '2026-03-07', 1105466149, 350000, 'Finalizado', 0),
(40, '2026-03-07', 1105466149, 550000, 'Finalizado', 0),
(45, '2026-03-13', 1105466149, 2299750, 'Finalizado', 0),
(46, '2026-03-13', 1105466149, 499950, 'Finalizado', 0),
(47, '2026-03-13', 1105466149, 499950, 'Finalizado', 1),
(50, '2026-03-18', 1105466149, 2764650, 'Finalizado', 0),
(51, '2026-03-18', 1105466149, 1379850, 'Finalizado', 0),
(52, '2026-03-18', 1105466149, 550000, 'Finalizado', 0),
(53, '2026-03-19', 1150184322, 9900000, 'Finalizado', 0),
(54, '2026-03-20', 1105466148, 2937000, 'Finalizado', 0),
(55, '2026-03-20', 1105466148, 2750000, 'Finalizado', 0),
(56, '2026-03-20', 1105466148, 789000, 'Finalizado', 0),
(57, '2026-03-20', 1103465147, 530000, 'Finalizado', 0),
(58, '2026-03-20', 1105466149, 1537900, 'Finalizado', 0),
(59, '2026-03-20', 1103465147, 397900, 'Finalizado', 0),
(60, '2026-03-20', 1105466148, 200000, 'Pendiente', 0),
(61, '2026-03-20', 1150184322, 549950, 'Pendiente', 0),
(62, '2026-03-20', 1107989551, 2394950, 'Pendiente', 0),
(63, '2026-03-20', 1105466149, 1680800, 'Pendiente', 1);

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
(21, '1105466149', 28, '2026-02-27 14:49:58'),
(27, '1105466148', 100, '2026-03-20 06:57:23'),
(29, '1107989551', 76, '2026-03-20 20:20:00'),
(30, '1103465147', 145, '2026-03-20 20:33:46'),
(31, '1103465147', 149, '2026-03-20 20:34:07'),
(32, '1103465147', 106, '2026-03-20 20:34:10');

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
(9, 'onitsuka');

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
(96, 48, 100000.00, '2026-03-20 20:24:22'),
(97, 121, 325950.00, '2026-03-20 20:24:22'),
(98, 114, 230550.00, '2026-03-20 20:24:22'),
(99, 103, 160450.00, '2026-03-20 20:24:22'),
(100, 111, 340000.00, '2026-03-20 20:24:22'),
(101, 118, 648950.00, '2026-03-20 20:24:22');

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
(28, 'New Balance 550', 'cuerina', 550000, 2, 3, 10, '1772045953_Captura_de_pantalla_2026-02-23_153001.png', 1, 4, 'La 550 original debutó en 1989 y dejó su huella en las canchas de baloncesto de costa a costa. Tras su lanzamiento inicial, las 550 se archivaron antes de ser reintroducidas en ediciones limitadas a finales de 2020, y volvieron a la alineación a tiempo completo en 2021, convirtiéndose rápidamente en'),
(29, 'Converse All Star', 'lona de algodon', 319000, 1, 8, 0, '1772216061_Captura_de_pantalla_2026-02-27_131310.png', 2, 6, 'Los tenis Converse son un ícono atemporal de estilo urbano y versatilidad. Con su diseño clásico y minimalista, estos zapatos combinan moda y comodidad en cada paso. Fabricados con materiales de alta calidad, cuentan con una capellada en lona resistente, puntera de goma característica y una suela vu'),
(30, 'Converse All Star', 'lona de algodon', 319000, 2, 8, 5, '1772216061_Captura_de_pantalla_2026-02-27_131310.png', 2, 6, 'Los tenis Converse son un ícono atemporal de estilo urbano y versatilidad. Con su diseño clásico y minimalista, estos zapatos combinan moda y comodidad en cada paso. Fabricados con materiales de alta calidad, cuentan con una capellada en lona resistente, puntera de goma característica y una suela vu'),
(31, 'Converse All Star', 'lona de algodon', 319000, 3, 8, 8, '1772216061_Captura_de_pantalla_2026-02-27_131310.png', 2, 6, 'Los tenis Converse son un ícono atemporal de estilo urbano y versatilidad. Con su diseño clásico y minimalista, estos zapatos combinan moda y comodidad en cada paso. Fabricados con materiales de alta calidad, cuentan con una capellada en lona resistente, puntera de goma característica y una suela vu'),
(32, 'Converse All Star', 'lona de algodon', 319000, 4, 8, 10, '1772216061_Captura_de_pantalla_2026-02-27_131310.png', 2, 6, 'Los tenis Converse son un ícono atemporal de estilo urbano y versatilidad. Con su diseño clásico y minimalista, estos zapatos combinan moda y comodidad en cada paso. Fabricados con materiales de alta calidad, cuentan con una capellada en lona resistente, puntera de goma característica y una suela vu'),
(38, 'Nike Court Visi', 'Cuero sintetico', 394950, 1, 16, 2, '1772220634_Captura_de_pantalla_2026-02-27_142727.png', 1, 5, '¿Amas el look clásico del básquetbol de los años 80, pero te atrae la cultura acelerada del deporte actual? Te presentamos los Court Vision Low. Este modelo mantiene el alma de las originales con cuero sintético impecable y revestimientos cosidos, y la zona del tobillo con sensación de suavidad mant'),
(39, 'Nike Court Visi', 'Cuero sintetico', 394950, 2, 16, 10, '1772220634_Captura_de_pantalla_2026-02-27_142727.png', 1, 5, '¿Amas el look clásico del básquetbol de los años 80, pero te atrae la cultura acelerada del deporte actual? Te presentamos los Court Vision Low. Este modelo mantiene el alma de las originales con cuero sintético impecable y revestimientos cosidos, y la zona del tobillo con sensación de suavidad mant'),
(40, 'Nike Court Visi', 'Cuero sintetico', 394950, 3, 16, 10, '1772220634_Captura_de_pantalla_2026-02-27_142727.png', 1, 5, '¿Amas el look clásico del básquetbol de los años 80, pero te atrae la cultura acelerada del deporte actual? Te presentamos los Court Vision Low. Este modelo mantiene el alma de las originales con cuero sintético impecable y revestimientos cosidos, y la zona del tobillo con sensación de suavidad mant'),
(41, 'Nike Court Visi', 'Cuero sintetico', 394950, 4, 16, 10, '1772220634_Captura_de_pantalla_2026-02-27_142727.png', 1, 5, '¿Amas el look clásico del básquetbol de los años 80, pero te atrae la cultura acelerada del deporte actual? Te presentamos los Court Vision Low. Este modelo mantiene el alma de las originales con cuero sintético impecable y revestimientos cosidos, y la zona del tobillo con sensación de suavidad mant'),
(42, 'Nike Court Visi', 'Cuero sintetico', 394950, 5, 16, 10, '1772220634_Captura_de_pantalla_2026-02-27_142727.png', 1, 5, '¿Amas el look clásico del básquetbol de los años 80, pero te atrae la cultura acelerada del deporte actual? Te presentamos los Court Vision Low. Este modelo mantiene el alma de las originales con cuero sintético impecable y revestimientos cosidos, y la zona del tobillo con sensación de suavidad mant'),
(43, 'Adidas Samaba OG', 'Cuero sintetico', 499950, 2, 7, 10, '1773976938_Captura1-removebg-preview.png', 1, 2, 'Nacidas en la cancha, las Samba son un ícono atemporal del estilo urbano. Esta silueta se mantiene fiel a su legado con un elegante exterior de cuero suave y un perfil bajo, revestimientos de gamuza y suela de goma, lo que la convierte en un básico en el armario de cualquiera, tanto dentro como fuer'),
(44, 'Adidas Samaba OG', 'Cuero sintetico', 499950, 6, 7, 10, '1773976938_Captura1-removebg-preview.png', 1, 2, 'Nacidas en la cancha, las Samba son un ícono atemporal del estilo urbano. Esta silueta se mantiene fiel a su legado con un elegante exterior de cuero suave y un perfil bajo, revestimientos de gamuza y suela de goma, lo que la convierte en un básico en el armario de cualquiera, tanto dentro como fuer'),
(48, 'Adidas Samba Og ', 'Cuero sintetico', 459950, 2, 8, 8, '1773976435_Captura-removebg-preview__1_.png', 1, 2, 'Nacidas en la cancha, las Samba son un ícono atemporal del estilo urbano. Esta silueta se mantiene fiel a su legado con un elegante exterior de cuero suave y un perfil bajo, revestimientos de gamuza y suela de goma, lo que la convierte en un básico en el armario de cualquiera, tanto dentro como fuer'),
(49, 'Adidas Samba Og ', 'Cuero sintetico', 459950, 1, 8, 10, '1773976435_Captura-removebg-preview__1_.png', 1, 2, 'Nacidas en la cancha, las Samba son un ícono atemporal del estilo urbano. Esta silueta se mantiene fiel a su legado con un elegante exterior de cuero suave y un perfil bajo, revestimientos de gamuza y suela de goma, lo que la convierte en un básico en el armario de cualquiera, tanto dentro como fuer'),
(50, 'Adidas Samba Og ', 'Cuero sintetico', 459950, 3, 8, 10, '1773976435_Captura-removebg-preview__1_.png', 1, 2, 'Nacidas en la cancha, las Samba son un ícono atemporal del estilo urbano. Esta silueta se mantiene fiel a su legado con un elegante exterior de cuero suave y un perfil bajo, revestimientos de gamuza y suela de goma, lo que la convierte en un básico en el armario de cualquiera, tanto dentro como fuer'),
(51, 'Adidas Samba Og ', 'Cuero sintetico', 459950, 4, 8, 10, '1773976435_Captura-removebg-preview__1_.png', 1, 2, 'Nacidas en la cancha, las Samba son un ícono atemporal del estilo urbano. Esta silueta se mantiene fiel a su legado con un elegante exterior de cuero suave y un perfil bajo, revestimientos de gamuza y suela de goma, lo que la convierte en un básico en el armario de cualquiera, tanto dentro como fuer'),
(52, 'Adidas Samba Og ', 'Cuero sintetico', 459950, 5, 8, 10, '1773976435_Captura-removebg-preview__1_.png', 1, 2, 'Nacidas en la cancha, las Samba son un ícono atemporal del estilo urbano. Esta silueta se mantiene fiel a su legado con un elegante exterior de cuero suave y un perfil bajo, revestimientos de gamuza y suela de goma, lo que la convierte en un básico en el armario de cualquiera, tanto dentro como fuer'),
(53, 'Campus 00\'s', 'Gamuza', 459950, 1, 8, 2, '1772897743_CampusZ.png', 3, 2, 'Aunque hicieron su debut en las canchas de básquet, los tenis adidas Campus fueron rápidamente adoptados en casi todas partes. Con este par, llevamos la icónica silueta en otra dirección y le agregamos materiales, colores y proporciones modernos. Traen una parte superior de cuero prémium con un forr'),
(54, 'Campus 00\'s', 'Gamuza', 459950, 2, 8, 10, '1772897743_CampusZ.png', 3, 2, 'Aunque hicieron su debut en las canchas de básquet, los tenis adidas Campus fueron rápidamente adoptados en casi todas partes. Con este par, llevamos la icónica silueta en otra dirección y le agregamos materiales, colores y proporciones modernos. Traen una parte superior de cuero prémium con un forr'),
(55, 'Campus 00\'s', 'Gamuza', 459950, 3, 8, 10, '1772897743_CampusZ.png', 3, 2, 'Aunque hicieron su debut en las canchas de básquet, los tenis adidas Campus fueron rápidamente adoptados en casi todas partes. Con este par, llevamos la icónica silueta en otra dirección y le agregamos materiales, colores y proporciones modernos. Traen una parte superior de cuero prémium con un forr'),
(56, 'Campus 00\'s', 'Gamuza', 459950, 4, 8, 10, '1772897743_CampusZ.png', 3, 2, 'Aunque hicieron su debut en las canchas de básquet, los tenis adidas Campus fueron rápidamente adoptados en casi todas partes. Con este par, llevamos la icónica silueta en otra dirección y le agregamos materiales, colores y proporciones modernos. Traen una parte superior de cuero prémium con un forr'),
(57, 'Campus 00\'s', 'Gamuza', 459950, 5, 8, 10, '1772897743_CampusZ.png', 3, 2, 'Aunque hicieron su debut en las canchas de básquet, los tenis adidas Campus fueron rápidamente adoptados en casi todas partes. Con este par, llevamos la icónica silueta en otra dirección y le agregamos materiales, colores y proporciones modernos. Traen una parte superior de cuero prémium con un forr'),
(58, 'Campus 00\'s', 'Gamuza', 459950, 6, 8, 10, '1772897743_CampusZ.png', 3, 2, 'Aunque hicieron su debut en las canchas de básquet, los tenis adidas Campus fueron rápidamente adoptados en casi todas partes. Con este par, llevamos la icónica silueta en otra dirección y le agregamos materiales, colores y proporciones modernos. Traen una parte superior de cuero prémium con un forr'),
(59, 'New Balance 550', 'cuerina', 550000, 3, 3, 10, '1772045953_Captura_de_pantalla_2026-02-23_153001.png', 1, 4, 'La 550 original debutó en 1989 y dejó su huella en las canchas de baloncesto de costa a costa. Tras su lanzamiento inicial, las 550 se archivaron antes de ser reintroducidas en ediciones limitadas a finales de 2020, y volvieron a la alineación a tiempo completo en 2021, convirtiéndose rápidamente en'),
(60, 'New Balance 550', 'cuerina', 550000, 4, 3, 10, '1772045953_Captura_de_pantalla_2026-02-23_153001.png', 1, 4, 'La 550 original debutó en 1989 y dejó su huella en las canchas de baloncesto de costa a costa. Tras su lanzamiento inicial, las 550 se archivaron antes de ser reintroducidas en ediciones limitadas a finales de 2020, y volvieron a la alineación a tiempo completo en 2021, convirtiéndose rápidamente en'),
(61, 'Puma Suede XL', 'gamuza', 510000, 1, 3, 10, '1773953464_Captura_de_pantalla_2026-03-19_153732-removebg-preview.png', 1, 1, 'Esta nueva versión de los clásicos tenis Suede se inspiran en la herencia de PUMA en el mundo del breakdance y en su influencia sobre streetwear moderno. Los Suede XL conservan su ADN icónico, pero le dan un giro con un borde y lengüeta exageradamente acolchados, además de una suela más gruesa. Esta'),
(62, 'Puma Suede XL', 'gamuza', 510000, 2, 3, 10, '1773953464_Captura_de_pantalla_2026-03-19_153732-removebg-preview.png', 1, 1, 'Esta nueva versión de los clásicos tenis Suede se inspiran en la herencia de PUMA en el mundo del breakdance y en su influencia sobre streetwear moderno. Los Suede XL conservan su ADN icónico, pero le dan un giro con un borde y lengüeta exageradamente acolchados, además de una suela más gruesa. Esta'),
(63, 'Puma Suede XL', 'gamuza', 510000, 3, 3, 10, '1773953464_Captura_de_pantalla_2026-03-19_153732-removebg-preview.png', 1, 1, 'Esta nueva versión de los clásicos tenis Suede se inspiran en la herencia de PUMA en el mundo del breakdance y en su influencia sobre streetwear moderno. Los Suede XL conservan su ADN icónico, pero le dan un giro con un borde y lengüeta exageradamente acolchados, además de una suela más gruesa. Esta'),
(64, 'Puma Suede XL', 'gamuza', 510000, 4, 3, 10, '1773953464_Captura_de_pantalla_2026-03-19_153732-removebg-preview.png', 1, 1, 'Esta nueva versión de los clásicos tenis Suede se inspiran en la herencia de PUMA en el mundo del breakdance y en su influencia sobre streetwear moderno. Los Suede XL conservan su ADN icónico, pero le dan un giro con un borde y lengüeta exageradamente acolchados, además de una suela más gruesa. Esta'),
(65, 'Puma Suede XL', 'gamuza', 510000, 5, 3, 10, '1773953464_Captura_de_pantalla_2026-03-19_153732-removebg-preview.png', 1, 1, 'Esta nueva versión de los clásicos tenis Suede se inspiran en la herencia de PUMA en el mundo del breakdance y en su influencia sobre streetwear moderno. Los Suede XL conservan su ADN icónico, pero le dan un giro con un borde y lengüeta exageradamente acolchados, además de una suela más gruesa. Esta'),
(66, 'Air Jordan 4 Retro Valentine\'s', 'Cuero', 1209000, 1, 5, 10, '1773977339_Captura-removebg-preview__5_.png', 2, 5, 'El nobuk aterciopelado y el cuero de acabado terso elevan la sensación premium desde el primer vistazo. Detalles en plata metalizada aportan un brillo sutil y preciso, sin excesos. La combinación de cuero auténtico y sintético se superpone sobre una base de malla reticulada, creando capas que suman '),
(67, 'Air Jordan 4 Retro Valentine\'s', 'Cuero', 1209000, 2, 5, 10, '1773977339_Captura-removebg-preview__5_.png', 2, 5, 'El nobuk aterciopelado y el cuero de acabado terso elevan la sensación premium desde el primer vistazo. Detalles en plata metalizada aportan un brillo sutil y preciso, sin excesos. La combinación de cuero auténtico y sintético se superpone sobre una base de malla reticulada, creando capas que suman '),
(68, 'Air Jordan 4 Retro Valentine\'s', 'Cuero', 1209000, 3, 5, 10, '1773977339_Captura-removebg-preview__5_.png', 2, 5, 'El nobuk aterciopelado y el cuero de acabado terso elevan la sensación premium desde el primer vistazo. Detalles en plata metalizada aportan un brillo sutil y preciso, sin excesos. La combinación de cuero auténtico y sintético se superpone sobre una base de malla reticulada, creando capas que suman '),
(69, 'Air Jordan 4 Retro Valentine\'s', 'Cuero', 1209000, 4, 5, 10, '1773977339_Captura-removebg-preview__5_.png', 2, 5, 'El nobuk aterciopelado y el cuero de acabado terso elevan la sensación premium desde el primer vistazo. Detalles en plata metalizada aportan un brillo sutil y preciso, sin excesos. La combinación de cuero auténtico y sintético se superpone sobre una base de malla reticulada, creando capas que suman '),
(70, 'Air Jordan 4 Retro Valentine\'s', 'Cuero', 1209000, 5, 5, 10, '1773977339_Captura-removebg-preview__5_.png', 2, 5, 'El nobuk aterciopelado y el cuero de acabado terso elevan la sensación premium desde el primer vistazo. Detalles en plata metalizada aportan un brillo sutil y preciso, sin excesos. La combinación de cuero auténtico y sintético se superpone sobre una base de malla reticulada, creando capas que suman '),
(71, 'TENIS SUPERSTAR II', 'Cuero sintetico', 459950, 1, 9, 10, '1773977794_Captura-removebg-preview__6_.png', 2, 2, 'Lo clásico se une a lo contemporáneo con los Tenis adidas Superstar II vuelven con un toque atrevido, con la emblemática puntera con relieve y las rayas dentadas que han definido el estilo durante décadas. Esta versión actualizada de un clásico de los años 90 aporta nuevas proporciones y una actitud'),
(72, 'TENIS SUPERSTAR II', 'Cuero sintetico', 459950, 2, 9, 10, '1773977794_Captura-removebg-preview__6_.png', 2, 2, 'Lo clásico se une a lo contemporáneo con los Tenis adidas Superstar II vuelven con un toque atrevido, con la emblemática puntera con relieve y las rayas dentadas que han definido el estilo durante décadas. Esta versión actualizada de un clásico de los años 90 aporta nuevas proporciones y una actitud'),
(73, 'TENIS SUPERSTAR II', 'Cuero sintetico', 459950, 3, 9, 10, '1773977794_Captura-removebg-preview__6_.png', 2, 2, 'Lo clásico se une a lo contemporáneo con los Tenis adidas Superstar II vuelven con un toque atrevido, con la emblemática puntera con relieve y las rayas dentadas que han definido el estilo durante décadas. Esta versión actualizada de un clásico de los años 90 aporta nuevas proporciones y una actitud'),
(74, 'TENIS SUPERSTAR II', 'Cuero sintetico', 459950, 4, 9, 10, '1773977794_Captura-removebg-preview__6_.png', 2, 2, 'Lo clásico se une a lo contemporáneo con los Tenis adidas Superstar II vuelven con un toque atrevido, con la emblemática puntera con relieve y las rayas dentadas que han definido el estilo durante décadas. Esta versión actualizada de un clásico de los años 90 aporta nuevas proporciones y una actitud'),
(75, 'TENIS SUPERSTAR II', 'Cuero sintetico', 459950, 5, 9, 10, '1773977794_Captura-removebg-preview__6_.png', 2, 2, 'Lo clásico se une a lo contemporáneo con los Tenis adidas Superstar II vuelven con un toque atrevido, con la emblemática puntera con relieve y las rayas dentadas que han definido el estilo durante décadas. Esta versión actualizada de un clásico de los años 90 aporta nuevas proporciones y una actitud'),
(76, 'Puma Speedcat ', 'Gamuza', 530000, 3, 5, 6, '1773978020_Captura-removebg-preview__7_.png', 2, 1, 'Un ícono de la cultura de las pistas, los PUMA Speedcat han sido sinónimo de velocidad, precisión y rendimiento inigualable durante más de 25 años. Nacieron como un estilo de Fórmula 1®, pero con el paso de las décadas encontraron un nuevo circuito, trascendiendo las pistas de Mónaco para llegar a l'),
(77, 'Puma Speedcat ', 'Gamuza', 530000, 4, 5, 10, '1773978020_Captura-removebg-preview__7_.png', 2, 1, 'Un ícono de la cultura de las pistas, los PUMA Speedcat han sido sinónimo de velocidad, precisión y rendimiento inigualable durante más de 25 años. Nacieron como un estilo de Fórmula 1®, pero con el paso de las décadas encontraron un nuevo circuito, trascendiendo las pistas de Mónaco para llegar a l'),
(78, 'New Balance 530', 'Malla transpirable', 483000, 1, 7, 10, '1773978585_Captura-removebg-preview__8_.png', 2, 4, 'La MR530 original combinada con la estética del cambio de milenio y la fiabilidad de una zapatilla de running de alto kilometraje. El nuevo modelo 530 ofrece un estilo contemporáneo y cotidiano con un diseño orientado a la respuesta. La entresuela ABZORB segmentada se combina con un diseño clásico d'),
(79, 'New Balance 530', 'Malla transpirable', 483000, 2, 7, 10, '1773978585_Captura-removebg-preview__8_.png', 2, 4, 'La MR530 original combinada con la estética del cambio de milenio y la fiabilidad de una zapatilla de running de alto kilometraje. El nuevo modelo 530 ofrece un estilo contemporáneo y cotidiano con un diseño orientado a la respuesta. La entresuela ABZORB segmentada se combina con un diseño clásico d'),
(80, 'Tenis Palermo', 'Gamuza', 311000, 1, 9, 10, '1773979152_Captura-removebg-preview__9_.png', 2, 1, 'raída de nuestros archivos, vuelve una leyenda de las gradas: Palermo. Este modelo debutó a principios de los años 80 y se convirtió rápidamente en un clásico de las gradas de los estadios de fútbol británicos. Ahora, lo hemos traído de vuelta para los fans. Al igual que el original, las Palermo se '),
(81, 'Tenis Palermo', 'Gamuza', 311000, 2, 9, 10, '1773979152_Captura-removebg-preview__9_.png', 2, 1, 'raída de nuestros archivos, vuelve una leyenda de las gradas: Palermo. Este modelo debutó a principios de los años 80 y se convirtió rápidamente en un clásico de las gradas de los estadios de fútbol británicos. Ahora, lo hemos traído de vuelta para los fans. Al igual que el original, las Palermo se '),
(82, 'TENIS FORUM LOW CL', 'Cuero sintetico', 459950, 3, 1, 10, '1773979501_Captura-removebg-preview__10_.png', 1, 2, 'Estos tenis adidas Forum Low CL te ofrecen el equilibrio perfecto entre un estilo informal y retro. El exterior de cuero prémium y el suave forro textil te ofrecen una comodidad sin límites. Estos tenis versátiles son un básico en cualquier armario.'),
(83, 'TENIS FORUM LOW CL', 'Cuero sintetico', 459950, 4, 1, 10, '1773979501_Captura-removebg-preview__10_.png', 1, 2, 'Estos tenis adidas Forum Low CL te ofrecen el equilibrio perfecto entre un estilo informal y retro. El exterior de cuero prémium y el suave forro textil te ofrecen una comodidad sin límites. Estos tenis versátiles son un básico en cualquier armario.'),
(84, 'TENIS FORUM BOLD STRIPES', 'Cuero sintetico', 439960, 1, 9, 10, '1773979623_Captura-removebg-preview__11_.png', 2, 2, 'Estos tenis adidas son una plataforma de estilo, que te dan un aspecto audaz y la confianza para expresarte. Su exterior de cuero premium está rematado con detalles de gamuza, creando un look tan versátil como clásico. Combínalos con tu atuendo favorito, ya sea informal o elegante, y marca la difere'),
(85, 'TENIS FORUM BOLD STRIPES', 'Cuero sintetico', 439960, 3, 9, 10, '1773979623_Captura-removebg-preview__11_.png', 2, 2, 'Estos tenis adidas son una plataforma de estilo, que te dan un aspecto audaz y la confianza para expresarte. Su exterior de cuero premium está rematado con detalles de gamuza, creando un look tan versátil como clásico. Combínalos con tu atuendo favorito, ya sea informal o elegante, y marca la difere'),
(86, 'TENIS FORUM BOLD STRIPES', 'Cuero sintetico', 439960, 2, 9, 10, '1773979623_Captura-removebg-preview__11_.png', 2, 2, 'Estos tenis adidas son una plataforma de estilo, que te dan un aspecto audaz y la confianza para expresarte. Su exterior de cuero premium está rematado con detalles de gamuza, creando un look tan versátil como clásico. Combínalos con tu atuendo favorito, ya sea informal o elegante, y marca la difere'),
(87, 'TENIS FORUM BOLD STRIPES', 'Cuero sintetico', 439960, 4, 9, 10, '1773979623_Captura-removebg-preview__11_.png', 2, 2, 'Estos tenis adidas son una plataforma de estilo, que te dan un aspecto audaz y la confianza para expresarte. Su exterior de cuero premium está rematado con detalles de gamuza, creando un look tan versátil como clásico. Combínalos con tu atuendo favorito, ya sea informal o elegante, y marca la difere'),
(88, 'DC Court Graffik', 'Gamuza', 198950, 1, 5, 10, '1773979846_Captura1-removebg-preview__1_.png', 1, 9, 'Las Court Graffik mejoran con el tiempo. Su clásica silueta acolchada evoluciona constantemente con colores de moda, llamativos logotipos de DC y nuevos tejidos que las distinguen del resto.'),
(89, 'DC Court Graffik', 'Gamuza', 198950, 2, 5, 8, '1773979846_Captura1-removebg-preview__1_.png', 1, 9, 'Las Court Graffik mejoran con el tiempo. Su clásica silueta acolchada evoluciona constantemente con colores de moda, llamativos logotipos de DC y nuevos tejidos que las distinguen del resto.'),
(90, 'DC Court Graffik', 'Gamuza', 198950, 3, 5, 10, '1773979846_Captura1-removebg-preview__1_.png', 1, 9, 'Las Court Graffik mejoran con el tiempo. Su clásica silueta acolchada evoluciona constantemente con colores de moda, llamativos logotipos de DC y nuevos tejidos que las distinguen del resto.'),
(91, 'Nike Cortez', 'Cuero sintetico', 259000, 2, 7, 10, '1773980179_Captura-removebg-preview__12_.png', 1, 5, '¿Cómo haces para mejorar un clásico? Haciendo que sea fácil de poner, claro. La presilla superior para las agujetas de estos tenis está unida a una correa de cierre por contacto para que los niños puedan ceñirla rápidamente. El espacio adicional en la puntera ofrece el espacio necesario para que los'),
(92, 'Nike Cortez', 'Cuero sintetico', 259000, 3, 7, 8, '1773980179_Captura-removebg-preview__12_.png', 1, 5, '¿Cómo haces para mejorar un clásico? Haciendo que sea fácil de poner, claro. La presilla superior para las agujetas de estos tenis está unida a una correa de cierre por contacto para que los niños puedan ceñirla rápidamente. El espacio adicional en la puntera ofrece el espacio necesario para que los'),
(93, 'Nike Cortez', 'Cuero sintetico', 259000, 4, 7, 10, '1773980179_Captura-removebg-preview__12_.png', 1, 5, '¿Cómo haces para mejorar un clásico? Haciendo que sea fácil de poner, claro. La presilla superior para las agujetas de estos tenis está unida a una correa de cierre por contacto para que los niños puedan ceñirla rápidamente. El espacio adicional en la puntera ofrece el espacio necesario para que los'),
(94, 'Nike Cortez', 'Cuero sintetico', 259000, 5, 7, 9, '1773980179_Captura-removebg-preview__12_.png', 1, 5, '¿Cómo haces para mejorar un clásico? Haciendo que sea fácil de poner, claro. La presilla superior para las agujetas de estos tenis está unida a una correa de cierre por contacto para que los niños puedan ceñirla rápidamente. El espacio adicional en la puntera ofrece el espacio necesario para que los'),
(95, 'Knu Skool', 'Gamuza', 449000, 1, 8, 10, '1773980426_Captura-removebg-preview__13_.png', 3, 3, 'Las Knu Skool son un modelo reeditado de los años 90, cuando las zapatillas de skate tenían un diseño con extra de acolchado. Esta silueta de caña baja, confeccionada con resistentes palas de ante, presenta un diseño con una gran lengüeta y un cuello acolchados, lo que le otorga un aspecto exagerado'),
(96, 'Knu Skool', 'Gamuza', 449000, 2, 8, 10, '1773980426_Captura-removebg-preview__13_.png', 3, 3, 'Las Knu Skool son un modelo reeditado de los años 90, cuando las zapatillas de skate tenían un diseño con extra de acolchado. Esta silueta de caña baja, confeccionada con resistentes palas de ante, presenta un diseño con una gran lengüeta y un cuello acolchados, lo que le otorga un aspecto exagerado'),
(97, 'Knu Skool', 'Gamuza', 449000, 3, 8, 10, '1773980426_Captura-removebg-preview__13_.png', 3, 3, 'Las Knu Skool son un modelo reeditado de los años 90, cuando las zapatillas de skate tenían un diseño con extra de acolchado. Esta silueta de caña baja, confeccionada con resistentes palas de ante, presenta un diseño con una gran lengüeta y un cuello acolchados, lo que le otorga un aspecto exagerado'),
(98, 'Knu Skool', 'Gamuza', 449000, 4, 8, 10, '1773980426_Captura-removebg-preview__13_.png', 3, 3, 'Las Knu Skool son un modelo reeditado de los años 90, cuando las zapatillas de skate tenían un diseño con extra de acolchado. Esta silueta de caña baja, confeccionada con resistentes palas de ante, presenta un diseño con una gran lengüeta y un cuello acolchados, lo que le otorga un aspecto exagerado'),
(99, 'Knu Skool', 'Gamuza', 449000, 5, 8, 10, '1773980426_Captura-removebg-preview__13_.png', 3, 3, 'Las Knu Skool son un modelo reeditado de los años 90, cuando las zapatillas de skate tenían un diseño con extra de acolchado. Esta silueta de caña baja, confeccionada con resistentes palas de ante, presenta un diseño con una gran lengüeta y un cuello acolchados, lo que le otorga un aspecto exagerado'),
(100, 'Nike Dunk Low Gore-Tex', 'Cuero sintetico', 979000, 1, 11, 9, '1773980670_Captura-removebg-preview__14_.png', 2, 5, 'Siempre puedes contar con un clásico. Confeccionadas con cuero premium, estas Dunk Low cuentan con GORE-TEX impermeable para mantenerte seco en condiciones húmedas. Como todos los Dunks, cuenta con una almohadilla que da una sensación de suavidad y brinda comodidad significativa y duradera.'),
(101, 'Nike Dunk Low Gore-Tex', 'Cuero sintetico', 979000, 2, 11, 8, '1773980670_Captura-removebg-preview__14_.png', 2, 5, 'Siempre puedes contar con un clásico. Confeccionadas con cuero premium, estas Dunk Low cuentan con GORE-TEX impermeable para mantenerte seco en condiciones húmedas. Como todos los Dunks, cuenta con una almohadilla que da una sensación de suavidad y brinda comodidad significativa y duradera.'),
(102, 'Nike Dunk Low Gore-Tex', 'Cuero sintetico', 979000, 3, 11, 10, '1773980670_Captura-removebg-preview__14_.png', 2, 5, 'Siempre puedes contar con un clásico. Confeccionadas con cuero premium, estas Dunk Low cuentan con GORE-TEX impermeable para mantenerte seco en condiciones húmedas. Como todos los Dunks, cuenta con una almohadilla que da una sensación de suavidad y brinda comodidad significativa y duradera.'),
(103, 'Chuck Taylor All Star Classic', 'lona de algodon', 296550, 4, 8, 8, '1773981044_Captura-removebg-preview__15_.png', 3, 6, 'Parte superior de lona duradera para crear el look clásico de las Chuck\r\nAmortiguación OrthoLite para ofrecer una comodidad óptima\r\nIcónica etiqueta All Star en la lengüeta y logotipo posterior\r\nOjales en la zona media para mejorar el flujo de aire.\r\nLogotipo posterior All Star reinventado.'),
(104, 'Chuck Taylor All Star Classic', 'lona de algodon', 296550, 5, 8, 10, '1773981044_Captura-removebg-preview__15_.png', 3, 6, 'Parte superior de lona duradera para crear el look clásico de las Chuck\r\nAmortiguación OrthoLite para ofrecer una comodidad óptima\r\nIcónica etiqueta All Star en la lengüeta y logotipo posterior\r\nOjales en la zona media para mejorar el flujo de aire.\r\nLogotipo posterior All Star reinventado.'),
(105, 'Chuck Taylor All Star Classic', 'lona de algodon', 296550, 6, 8, 10, '1773981044_Captura-removebg-preview__15_.png', 3, 6, 'Parte superior de lona duradera para crear el look clásico de las Chuck\r\nAmortiguación OrthoLite para ofrecer una comodidad óptima\r\nIcónica etiqueta All Star en la lengüeta y logotipo posterior\r\nOjales en la zona media para mejorar el flujo de aire.\r\nLogotipo posterior All Star reinventado.'),
(106, 'Air Jordan 3 x Levi\'s \'Black\'', 'Cuero sintetico', 1334950, 3, 8, 9, '1773981604_Captura-removebg-preview__16_.png', 1, 5, 'Jordan y Levi’s® vuelven a unirse para ofrecer una nueva versión de los AJ3. El denim negro invertido y el cuero premium mate en la parte superior crean un elegante look oscuro con efecto lavado. La icónica etiqueta roja en los ojales hace juego con los detalles en rojo gimnasio de la suela y la pla'),
(107, 'Air Jordan 3 x Levi\'s \'Black\'', 'Cuero sintetico', 1334950, 5, 8, 10, '1773981604_Captura-removebg-preview__16_.png', 1, 5, 'Jordan y Levi’s® vuelven a unirse para ofrecer una nueva versión de los AJ3. El denim negro invertido y el cuero premium mate en la parte superior crean un elegante look oscuro con efecto lavado. La icónica etiqueta roja en los ojales hace juego con los detalles en rojo gimnasio de la suela y la pla'),
(108, 'Air Jordan 3 x Levi\'s \'Black\'', 'Cuero sintetico', 1334950, 4, 8, 10, '1773981604_Captura-removebg-preview__16_.png', 1, 5, 'Jordan y Levi’s® vuelven a unirse para ofrecer una nueva versión de los AJ3. El denim negro invertido y el cuero premium mate en la parte superior crean un elegante look oscuro con efecto lavado. La icónica etiqueta roja en los ojales hace juego con los detalles en rojo gimnasio de la suela y la pla'),
(109, 'Air Jordan 3 x Levi\'s \'Black\'', 'Cuero sintetico', 1334950, 6, 8, 10, '1773981604_Captura-removebg-preview__16_.png', 1, 5, 'Jordan y Levi’s® vuelven a unirse para ofrecer una nueva versión de los AJ3. El denim negro invertido y el cuero premium mate en la parte superior crean un elegante look oscuro con efecto lavado. La icónica etiqueta roja en los ojales hace juego con los detalles en rojo gimnasio de la suela y la pla'),
(110, 'Adidas Samaba OG', 'Cuero sintetico', 499950, 4, 7, 10, '1773976938_Captura1-removebg-preview.png', 1, 2, 'Nacidas en la cancha, las Samba son un ícono atemporal del estilo urbano. Esta silueta se mantiene fiel a su legado con un elegante exterior de cuero suave y un perfil bajo, revestimientos de gamuza y suela de goma, lo que la convierte en un básico en el armario de cualquiera, tanto dentro como fuer'),
(111, 'New Balance 550', 'Cuero sintetico', 649950, 3, 3, 10, '1774008112_Captura-removebg-preview__17_.png', 1, 4, 'El modelo 550 original debutó en 1989 y dejó huella en las canchas de baloncesto de todo el país. Tras su lanzamiento inicial, el 550 quedó archivado, antes de volver a salir al mercado en ediciones limitadas a finales de 2020 y reincorporarse a la gama permanente en 2021, convirtiéndose rápidamente'),
(112, 'New Balance 550', 'Cuero sintetico', 649950, 4, 3, 10, '1774008112_Captura-removebg-preview__17_.png', 1, 4, 'El modelo 550 original debutó en 1989 y dejó huella en las canchas de baloncesto de todo el país. Tras su lanzamiento inicial, el 550 quedó archivado, antes de volver a salir al mercado en ediciones limitadas a finales de 2020 y reincorporarse a la gama permanente en 2021, convirtiéndose rápidamente'),
(113, 'New Balance 550', 'Cuero sintetico', 649950, 5, 3, 10, '1774008112_Captura-removebg-preview__17_.png', 1, 4, 'El modelo 550 original debutó en 1989 y dejó huella en las canchas de baloncesto de todo el país. Tras su lanzamiento inicial, el 550 quedó archivado, antes de volver a salir al mercado en ediciones limitadas a finales de 2020 y reincorporarse a la gama permanente en 2021, convirtiéndose rápidamente'),
(114, 'Campus 00\'s', 'Gamuza', 299950, 2, 3, 10, '1774008378_Captura-removebg-preview__18_.png', 3, 2, 'Ayuda a los niños a dar lo mejor de sí mismos con estos tenis Campus 00s de adidas Originals. De la escuela a la pista de skate, los emblemáticos tenis de corte bajo ofrecen a los niños un ajuste cómodo y fácil y una tracción fiable para sus carreras y juegos. La gamuza y el cuero proporcionan un ta'),
(115, 'Campus 00\'s', 'Gamuza', 299950, 1, 3, 10, '1774008378_Captura-removebg-preview__18_.png', 3, 2, 'Ayuda a los niños a dar lo mejor de sí mismos con estos tenis Campus 00s de adidas Originals. De la escuela a la pista de skate, los emblemáticos tenis de corte bajo ofrecen a los niños un ajuste cómodo y fácil y una tracción fiable para sus carreras y juegos. La gamuza y el cuero proporcionan un ta'),
(116, 'Campus 00\'s', 'Gamuza', 299950, 3, 3, 10, '1774008378_Captura-removebg-preview__18_.png', 3, 2, 'Ayuda a los niños a dar lo mejor de sí mismos con estos tenis Campus 00s de adidas Originals. De la escuela a la pista de skate, los emblemáticos tenis de corte bajo ofrecen a los niños un ajuste cómodo y fácil y una tracción fiable para sus carreras y juegos. La gamuza y el cuero proporcionan un ta'),
(117, 'Campus 00\'s', 'Gamuza', 299950, 4, 3, 10, '1774008378_Captura-removebg-preview__18_.png', 3, 2, 'Ayuda a los niños a dar lo mejor de sí mismos con estos tenis Campus 00s de adidas Originals. De la escuela a la pista de skate, los emblemáticos tenis de corte bajo ofrecen a los niños un ajuste cómodo y fácil y una tracción fiable para sus carreras y juegos. La gamuza y el cuero proporcionan un ta'),
(118, 'Nike V2K Run', 'Malla transpirable', 844950, 1, 16, 10, '1774009023_Captura-removebg-preview__19_.png', 2, 5, 'Adelanta. Regresa. ¡Es lo mismo! Estos tenis llevan el estilo retro al futuro. Los V2K remasterizan todo lo que amas de los Vomero con un look traído directamente de un catálogo de correr de principios de siglo. Equípate con una combinación de elementos metalizados llamativos, detalles de plástico r'),
(119, 'Nike V2K Run', 'Malla transpirable', 844950, 2, 16, 10, '1774009023_Captura-removebg-preview__19_.png', 2, 5, 'Adelanta. Regresa. ¡Es lo mismo! Estos tenis llevan el estilo retro al futuro. Los V2K remasterizan todo lo que amas de los Vomero con un look traído directamente de un catálogo de correr de principios de siglo. Equípate con una combinación de elementos metalizados llamativos, detalles de plástico r'),
(120, 'Nike V2K Run', 'Malla transpirable', 844950, 3, 16, 10, '1774009023_Captura-removebg-preview__19_.png', 2, 5, 'Adelanta. Regresa. ¡Es lo mismo! Estos tenis llevan el estilo retro al futuro. Los V2K remasterizan todo lo que amas de los Vomero con un look traído directamente de un catálogo de correr de principios de siglo. Equípate con una combinación de elementos metalizados llamativos, detalles de plástico r'),
(121, 'Air Jordan 1 Low OG \"Chicago\"', 'Cuero sintetico', 509950, 1, 5, 10, '1774009306_Captura-removebg-preview__20_.png', 1, 5, 'Los Jordan Retro son tenis clásicos, recreados para una nueva generación. Confeccionados con materiales premium y llenos de detalles exclusivos de Jordan, estos tenis harán que tu pequeño luzca increíble.'),
(122, 'Air Jordan 1 Low OG \"Chicago\"', 'Cuero sintetico', 509950, 2, 5, 8, '1774009306_Captura-removebg-preview__20_.png', 1, 5, 'Los Jordan Retro son tenis clásicos, recreados para una nueva generación. Confeccionados con materiales premium y llenos de detalles exclusivos de Jordan, estos tenis harán que tu pequeño luzca increíble.'),
(123, 'Air Jordan 1 Low OG \"Chicago\"', 'Cuero sintetico', 509950, 3, 5, 10, '1774009306_Captura-removebg-preview__20_.png', 1, 5, 'Los Jordan Retro son tenis clásicos, recreados para una nueva generación. Confeccionados con materiales premium y llenos de detalles exclusivos de Jordan, estos tenis harán que tu pequeño luzca increíble.'),
(124, 'Air Jordan 1 Low OG \"Chicago\"', 'Cuero sintetico', 509950, 4, 5, 10, '1774009306_Captura-removebg-preview__20_.png', 1, 5, 'Los Jordan Retro son tenis clásicos, recreados para una nueva generación. Confeccionados con materiales premium y llenos de detalles exclusivos de Jordan, estos tenis harán que tu pequeño luzca increíble.'),
(125, 'Air Jordan 1 Low OG \"Chicago\"', 'Cuero sintetico', 509950, 5, 5, 10, '1774009306_Captura-removebg-preview__20_.png', 1, 5, 'Los Jordan Retro son tenis clásicos, recreados para una nueva generación. Confeccionados con materiales premium y llenos de detalles exclusivos de Jordan, estos tenis harán que tu pequeño luzca increíble.'),
(126, 'Air Jordan 1 Low', 'Cuero sintetico', 679950, 1, 11, 10, '1774009624_Captura-removebg-preview__21_.png', 2, 5, 'Siempre a la moda, siempre con estilo. Los Air Jordan 1 Low te ofrecen una parte de la historia y herencia Jordan con una comodidad que dura todo el día. Elige tus colores y sal a lucirte con el icónico perfil creado con una combinación de materiales de calidad superior y una unidad Air encapsulada '),
(127, 'Air Jordan 1 Low', 'Cuero sintetico', 679950, 2, 11, 8, '1774009624_Captura-removebg-preview__21_.png', 2, 5, 'Siempre a la moda, siempre con estilo. Los Air Jordan 1 Low te ofrecen una parte de la historia y herencia Jordan con una comodidad que dura todo el día. Elige tus colores y sal a lucirte con el icónico perfil creado con una combinación de materiales de calidad superior y una unidad Air encapsulada '),
(128, 'Air Jordan 1 Low', 'Cuero sintetico', 679950, 3, 11, 10, '1774009624_Captura-removebg-preview__21_.png', 2, 5, 'Siempre a la moda, siempre con estilo. Los Air Jordan 1 Low te ofrecen una parte de la historia y herencia Jordan con una comodidad que dura todo el día. Elige tus colores y sal a lucirte con el icónico perfil creado con una combinación de materiales de calidad superior y una unidad Air encapsulada '),
(129, 'Air Jordan 1 Low', 'Cuero sintetico', 679950, 4, 11, 10, '1774009624_Captura-removebg-preview__21_.png', 2, 5, 'Siempre a la moda, siempre con estilo. Los Air Jordan 1 Low te ofrecen una parte de la historia y herencia Jordan con una comodidad que dura todo el día. Elige tus colores y sal a lucirte con el icónico perfil creado con una combinación de materiales de calidad superior y una unidad Air encapsulada '),
(130, 'Chuck Taylor All Star', 'lona de algodon', 319000, 1, 1, 10, '1774010046_Captura-removebg-preview__22_.png', 3, 6, 'Unas zapatillas de baloncesto que se convirtieron en un icono cultural y que has transformado en un símbolo de creatividad e independencia. Y, desde entonces, siempre han sido tus favoritas. Tus zapatillas de siempre: las Chuck Taylor All Star.'),
(131, 'Chuck Taylor All Star', 'lona de algodon', 319000, 2, 1, 10, '1774010046_Captura-removebg-preview__22_.png', 3, 6, 'Unas zapatillas de baloncesto que se convirtieron en un icono cultural y que has transformado en un símbolo de creatividad e independencia. Y, desde entonces, siempre han sido tus favoritas. Tus zapatillas de siempre: las Chuck Taylor All Star.'),
(132, 'Chuck Taylor All Star', 'lona de algodon', 319000, 3, 1, 10, '1774010046_Captura-removebg-preview__22_.png', 3, 6, 'Unas zapatillas de baloncesto que se convirtieron en un icono cultural y que has transformado en un símbolo de creatividad e independencia. Y, desde entonces, siempre han sido tus favoritas. Tus zapatillas de siempre: las Chuck Taylor All Star.'),
(133, 'Chuck Taylor All Star', 'lona de algodon', 319000, 4, 1, 10, '1774010046_Captura-removebg-preview__22_.png', 3, 6, 'Unas zapatillas de baloncesto que se convirtieron en un icono cultural y que has transformado en un símbolo de creatividad e independencia. Y, desde entonces, siempre han sido tus favoritas. Tus zapatillas de siempre: las Chuck Taylor All Star.'),
(134, 'Chuck Taylor All Star', 'lona de algodon', 319000, 5, 1, 10, '1774010046_Captura-removebg-preview__22_.png', 3, 6, 'Unas zapatillas de baloncesto que se convirtieron en un icono cultural y que has transformado en un símbolo de creatividad e independencia. Y, desde entonces, siempre han sido tus favoritas. Tus zapatillas de siempre: las Chuck Taylor All Star.'),
(135, 'Tenis PUMA 180', 'Gamuza', 598950, 2, 6, 10, '1774010351_Captura-removebg-preview__23_.png', 3, 1, 'Tomamos las PUMA-180, inspiradas en la estética skate de los años 90, y las renovamos para la época actual. Estos tenis unisex combinan una cubierta de técnica tosca con un diseño voluminoso y acolchado.'),
(136, 'Tenis PUMA 180', 'Gamuza', 598950, 3, 6, 10, '1774010351_Captura-removebg-preview__23_.png', 3, 1, 'Tomamos las PUMA-180, inspiradas en la estética skate de los años 90, y las renovamos para la época actual. Estos tenis unisex combinan una cubierta de técnica tosca con un diseño voluminoso y acolchado.'),
(137, 'Tenis PUMA 180', 'Gamuza', 598950, 4, 6, 10, '1774010351_Captura-removebg-preview__23_.png', 3, 1, 'Tomamos las PUMA-180, inspiradas en la estética skate de los años 90, y las renovamos para la época actual. Estos tenis unisex combinan una cubierta de técnica tosca con un diseño voluminoso y acolchado.'),
(138, 'Tenis PUMA 180', 'Gamuza', 598950, 5, 6, 10, '1774010351_Captura-removebg-preview__23_.png', 3, 1, 'Tomamos las PUMA-180, inspiradas en la estética skate de los años 90, y las renovamos para la época actual. Estos tenis unisex combinan una cubierta de técnica tosca con un diseño voluminoso y acolchado.'),
(139, 'TENIS SUPERSTAR', 'Cuero sintetico', 499950, 1, 7, 10, '1774010534_Captura-removebg-preview__24_.png', 3, 2, 'Vuelven los emblemáticos tenis adidas Superstar. Adéntrate en 50 años de estilo deportivo y urbano con estos tenis de caña baja. El suave exterior de cuero y la puntera clásica de caucho con relieve evocan recuerdos de las canchas de básquet y las calles de la ciudad. La lengüeta y el cuello acolcha'),
(140, 'TENIS SUPERSTAR', 'Cuero sintetico', 499950, 2, 7, 10, '1774010534_Captura-removebg-preview__24_.png', 3, 2, 'Vuelven los emblemáticos tenis adidas Superstar. Adéntrate en 50 años de estilo deportivo y urbano con estos tenis de caña baja. El suave exterior de cuero y la puntera clásica de caucho con relieve evocan recuerdos de las canchas de básquet y las calles de la ciudad. La lengüeta y el cuello acolcha'),
(141, 'TENIS SUPERSTAR', 'Cuero sintetico', 499950, 3, 7, 10, '1774010534_Captura-removebg-preview__24_.png', 3, 2, 'Vuelven los emblemáticos tenis adidas Superstar. Adéntrate en 50 años de estilo deportivo y urbano con estos tenis de caña baja. El suave exterior de cuero y la puntera clásica de caucho con relieve evocan recuerdos de las canchas de básquet y las calles de la ciudad. La lengüeta y el cuello acolcha'),
(142, 'TENIS SUPERSTAR', 'Cuero sintetico', 499950, 4, 7, 10, '1774010534_Captura-removebg-preview__24_.png', 3, 2, 'Vuelven los emblemáticos tenis adidas Superstar. Adéntrate en 50 años de estilo deportivo y urbano con estos tenis de caña baja. El suave exterior de cuero y la puntera clásica de caucho con relieve evocan recuerdos de las canchas de básquet y las calles de la ciudad. La lengüeta y el cuello acolcha'),
(143, 'TENIS SUPERSTAR', 'Cuero sintetico', 499950, 5, 7, 10, '1774010534_Captura-removebg-preview__24_.png', 3, 2, 'Vuelven los emblemáticos tenis adidas Superstar. Adéntrate en 50 años de estilo deportivo y urbano con estos tenis de caña baja. El suave exterior de cuero y la puntera clásica de caucho con relieve evocan recuerdos de las canchas de básquet y las calles de la ciudad. La lengüeta y el cuello acolcha'),
(144, 'TENIS SUPERSTAR', 'Cuero sintetico', 499950, 6, 7, 10, '1774010534_Captura-removebg-preview__24_.png', 3, 2, 'Vuelven los emblemáticos tenis adidas Superstar. Adéntrate en 50 años de estilo deportivo y urbano con estos tenis de caña baja. El suave exterior de cuero y la puntera clásica de caucho con relieve evocan recuerdos de las canchas de básquet y las calles de la ciudad. La lengüeta y el cuello acolcha'),
(145, 'Palermo Vintage', 'Gamuza', 312950, 1, 15, 10, '1774011023_Captura-removebg-preview__25_.png', 2, 1, 'Las Palermo debutaron a principios de los años 80 y se convirtieron rápidamente en un clásico de los estadios británicos, reconocibles al instante por sus toques de color y su clásica suela de goma. Hoy, pasaron de ser un ícono de la cultura futbolística a un ícono de la moda urbana.'),
(146, 'Palermo Vintage', 'Gamuza', 312950, 2, 15, 10, '1774011023_Captura-removebg-preview__25_.png', 2, 1, 'Las Palermo debutaron a principios de los años 80 y se convirtieron rápidamente en un clásico de los estadios británicos, reconocibles al instante por sus toques de color y su clásica suela de goma. Hoy, pasaron de ser un ícono de la cultura futbolística a un ícono de la moda urbana.'),
(147, 'Palermo Vintage', 'Gamuza', 312950, 3, 15, 10, '1774011023_Captura-removebg-preview__25_.png', 2, 1, 'Las Palermo debutaron a principios de los años 80 y se convirtieron rápidamente en un clásico de los estadios británicos, reconocibles al instante por sus toques de color y su clásica suela de goma. Hoy, pasaron de ser un ícono de la cultura futbolística a un ícono de la moda urbana.'),
(148, 'Palermo Vintage', 'Gamuza', 312950, 4, 15, 10, '1774011023_Captura-removebg-preview__25_.png', 2, 1, 'Las Palermo debutaron a principios de los años 80 y se convirtieron rápidamente en un clásico de los estadios británicos, reconocibles al instante por sus toques de color y su clásica suela de goma. Hoy, pasaron de ser un ícono de la cultura futbolística a un ícono de la moda urbana.'),
(149, 'TENIS GAZELLE INDOOR', 'Gamuza', 549950, 1, 3, 9, '1774011296_Captura-removebg-preview__26_.png', 1, 2, 'Creados originalmente como una alternativa para cancha bajo techo a los TENIS GAZELLE INDOOR, los TENIS GAZELLE INDOOR tienen una rica historia que resonará entre los entusiastas de adidas, mezclando un diseño clásico con un toque moderno.'),
(150, 'TENIS GAZELLE INDOOR', 'Gamuza', 549950, 2, 3, 10, '1774011296_Captura-removebg-preview__26_.png', 1, 2, 'Creados originalmente como una alternativa para cancha bajo techo a los TENIS GAZELLE INDOOR, los TENIS GAZELLE INDOOR tienen una rica historia que resonará entre los entusiastas de adidas, mezclando un diseño clásico con un toque moderno.'),
(151, 'TENIS GAZELLE INDOOR', 'Gamuza', 549950, 3, 3, 10, '1774011296_Captura-removebg-preview__26_.png', 1, 2, 'Creados originalmente como una alternativa para cancha bajo techo a los TENIS GAZELLE INDOOR, los TENIS GAZELLE INDOOR tienen una rica historia que resonará entre los entusiastas de adidas, mezclando un diseño clásico con un toque moderno.'),
(152, 'TENIS GAZELLE INDOOR', 'Gamuza', 549950, 4, 3, 10, '1774011296_Captura-removebg-preview__26_.png', 1, 2, 'Creados originalmente como una alternativa para cancha bajo techo a los TENIS GAZELLE INDOOR, los TENIS GAZELLE INDOOR tienen una rica historia que resonará entre los entusiastas de adidas, mezclando un diseño clásico con un toque moderno.'),
(153, 'TENIS GAZELLE INDOOR', 'Gamuza', 549950, 5, 3, 10, '1774011296_Captura-removebg-preview__26_.png', 1, 2, 'Creados originalmente como una alternativa para cancha bajo techo a los TENIS GAZELLE INDOOR, los TENIS GAZELLE INDOOR tienen una rica historia que resonará entre los entusiastas de adidas, mezclando un diseño clásico con un toque moderno.'),
(154, 'tenis Club C 85 Vintage', 'Cuero sintetico', 311000, 2, 7, 10, '1774012473_Captura-removebg-preview__27_.png', 3, 5, 'Cada detalle gotea en los Tenis Reebok Club C 85 Vintage del 40 aniversario. Los colores clásicos de culto son correctos. La parte superior original de cuero de plena flor parece intacta. El grabado personalizado en el talón y los logotipos exclusivos te hacen saber que son exclusivos.'),
(155, 'tenis Club C 85 Vintage', 'Cuero sintetico', 311000, 3, 7, 10, '1774012473_Captura-removebg-preview__27_.png', 3, 5, 'Cada detalle gotea en los Tenis Reebok Club C 85 Vintage del 40 aniversario. Los colores clásicos de culto son correctos. La parte superior original de cuero de plena flor parece intacta. El grabado personalizado en el talón y los logotipos exclusivos te hacen saber que son exclusivos.'),
(156, 'tenis Club C 85 Vintage', 'Cuero sintetico', 311000, 4, 7, 10, '1774012473_Captura-removebg-preview__27_.png', 3, 5, 'Cada detalle gotea en los Tenis Reebok Club C 85 Vintage del 40 aniversario. Los colores clásicos de culto son correctos. La parte superior original de cuero de plena flor parece intacta. El grabado personalizado en el talón y los logotipos exclusivos te hacen saber que son exclusivos.'),
(157, 'tenis Club C 85 Vintage', 'Cuero sintetico', 311000, 5, 7, 10, '1774012473_Captura-removebg-preview__27_.png', 3, 5, 'Cada detalle gotea en los Tenis Reebok Club C 85 Vintage del 40 aniversario. Los colores clásicos de culto son correctos. La parte superior original de cuero de plena flor parece intacta. El grabado personalizado en el talón y los logotipos exclusivos te hacen saber que son exclusivos.'),
(158, 'Nike Air Force 1', 'Cuero sintetico', 679950, 2, 7, 10, '1774012757_Captura-removebg-preview__28_.png', 3, 5, 'El fulgor vive en el Nike Air Force 1, el OG de básquetbol que le da un toque fresco a lo que mejor conoces: revestimientos con costuras duraderas, acabados impecables y la cantidad perfecta de destellos para que brilles.'),
(159, 'Nike Air Force 1', 'Cuero sintetico', 679950, 3, 7, 10, '1774012757_Captura-removebg-preview__28_.png', 3, 5, 'El fulgor vive en el Nike Air Force 1, el OG de básquetbol que le da un toque fresco a lo que mejor conoces: revestimientos con costuras duraderas, acabados impecables y la cantidad perfecta de destellos para que brilles.');
INSERT INTO `producto` (`IdProducto`, `Nombre`, `Material`, `Precio`, `IdTalla`, `IdColor`, `Stock`, `Foto`, `IdCategoria`, `IdMarca`, `Descripcion`) VALUES
(160, 'Nike Air Force 1', 'Cuero sintetico', 679950, 4, 7, 10, '1774012757_Captura-removebg-preview__28_.png', 3, 5, 'El fulgor vive en el Nike Air Force 1, el OG de básquetbol que le da un toque fresco a lo que mejor conoces: revestimientos con costuras duraderas, acabados impecables y la cantidad perfecta de destellos para que brilles.'),
(161, 'Nike Air Force 1', 'Cuero sintetico', 679950, 5, 7, 10, '1774012757_Captura-removebg-preview__28_.png', 3, 5, 'El fulgor vive en el Nike Air Force 1, el OG de básquetbol que le da un toque fresco a lo que mejor conoces: revestimientos con costuras duraderas, acabados impecables y la cantidad perfecta de destellos para que brilles.');

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
(8, 61, '1773953601_0_Captura_de_pantalla_2026-03-19_154530-removebg-preview.png', 1, 0, '2026-03-19 20:53:21'),
(9, 61, '1773953639_0_Captura_de_pantalla_2026-03-19_154641-removebg-preview.png', 1, 0, '2026-03-19 20:53:59'),
(10, 48, '1773976592_0_Captura-removebg-preview__2_.png', 1, 0, '2026-03-20 03:16:32'),
(11, 48, '1773976713_0_Captura-removebg-preview__4_.png', 1, 0, '2026-03-20 03:18:33'),
(12, 48, '1773976783_0_Captura-removebg-preview.png', 1, 0, '2026-03-20 03:19:43');

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
(1103465147, 'Juan Sebastián Andrade gonzales', 'sebastian@gmail.com', '$2y$10$zkRjYj1VMCMXshXJnpU38O7eutAZYAXcjl/gz/6Mm48cEpH8teVKS', '3227696874', 'Manzana B casa 15 Villa clara Salado', 3, 2),
(1105466148, 'Luz Anyela Quintero Gonzales', 'Luz@gmail.com', '$2y$10$7lho2xNdN8lSbLTr5U774uxWNnEAh3ScEdNuzTgDr1DbxBnEHslde', '3228982190', 'Mz c casa 22 Brisas del pedregal', 3, 1),
(1105466149, 'Lawrence Sebastián Vargas Gómez', 'sebastianvargas2246@gmail.com', '$2y$10$0zMY4vZHfpax78/LLHRm1e8bQbVsYjGLEdXbF7I59GaZm3JrMaZ5O', '3228982190', 'Mz B casa 14 Urb la floresta', 3, 2),
(1107546225, 'Emmily Giraldo Buritica', 'emmilygiraldo0208@gmail.com', '$2y$10$683SCZfOZnHtgSdmguVjgugRUB3JG1W7m.r74CocpnM/MWE.LQV76', '312456789', '2do jardín verde', 2, 2),
(1107989551, 'Ana maria torres', 'Anatorres@gmail.com', '$2y$10$MTXNhQ1guW/v8Pa3WqS89.j0hzpwMe/MZbZGPIpgBIrq5lIdCiL4G', '33147856965', 'mz p casa 7', 3, 2),
(1150184322, 'Manuel', 'mfds.camilo@gmail.com', '$2y$10$40gvx7iHsR7h5jMfavV.y.DIn7rPZ7qRI1oYHXTpwFHxkIsxQKE66', '3182569054', 'mz c casa 22 brisas del pedregal', 3, 1);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
  MODIFY `IdDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

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
  MODIFY `IdFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `IdMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `oferta_producto`
--
ALTER TABLE `oferta_producto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT de la tabla `producto_foto`
--
ALTER TABLE `producto_foto`
  MODIFY `IdFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
