-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-08-2023 a las 04:26:17
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `leterago`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(100) NOT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `description`, `create_date`, `create_by`, `modify_by`, `modify_date`, `delete_date`, `delete_by`) VALUES
(1, '1', '2023-07-04 04:00:00', '1', '1', '0000-00-00 00:00:00', '2023-07-05 00:00:00', '1'),
(2, 'FILTRO', '2023-07-04 04:00:00', '1', '1', '0000-00-00 00:00:00', '2023-07-05 00:00:00', '1'),
(3, 'Limpiar filtro', '2023-07-04 04:00:00', '1', '1', '0000-00-00 00:00:00', NULL, NULL),
(4, 'Revision de cableado', '2023-07-04 04:00:00', '1', NULL, NULL, NULL, NULL),
(5, 'lavar 3', '2023-07-05 04:00:00', '1', '1', '0000-00-00 00:00:00', '2023-07-05 00:00:00', '1'),
(6, 'Nueva actividad', '2023-07-05 04:00:00', '1', NULL, NULL, NULL, NULL),
(7, 'revision del sistema electrico', '2023-07-22 04:00:00', '1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
--

CREATE TABLE `almacenes` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `create_by` varchar(100) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_date` datetime DEFAULT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `almacenes`
--

INSERT INTO `almacenes` (`id`, `codigo`, `description`, `create_by`, `create_date`, `modify_date`, `modify_by`, `delete_by`, `delete_date`) VALUES
(1, 'A3', 'Almacen1', 'Super_admin', '2023-06-21 02:51:01', NULL, NULL, NULL, NULL),
(2, 'A2', 'Almacen 23', 'Super_admin', '2023-07-01 19:19:28', NULL, NULL, '1', '2023-07-01 00:00:00'),
(3, 'A4', 'Almacen 51', 'Super_admin', '2023-07-01 19:21:21', NULL, NULL, '1', '2023-07-01 00:00:00'),
(4, 'YH', 'Almacen 3', 'Super_admin', '2023-07-02 05:06:09', NULL, NULL, '1', '2023-07-02 00:00:00'),
(6, 'B2', 'Almacen12', 'Super_admin', '2023-07-02 13:23:22', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `id` int(11) NOT NULL,
  `id_equipo` int(6) NOT NULL,
  `id_programa` int(6) NOT NULL,
  `fecha` date NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `create_by` int(5) NOT NULL,
  `modify_by` int(5) DEFAULT NULL,
  `modify_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calendario`
--

INSERT INTO `calendario` (`id`, `id_equipo`, `id_programa`, `fecha`, `create_date`, `create_by`, `modify_by`, `modify_date`) VALUES
(1, 105, 13, '0000-00-00', '2023-07-21', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `create_by` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `codigo`, `description`, `create_by`, `create_date`, `modify_date`, `modify_by`, `delete_by`, `delete_date`) VALUES
(1, 'BB', 'Bombas 23', '1', '0000-00-00 00:00:00', '2023-07-03 00:00:00', '1', '1', '2023-07-03 00:00:00'),
(2, 'AA', 'Aire Acondicionados', '1', '0000-00-00 00:00:00', NULL, NULL, '1', '2023-07-03 00:00:00'),
(3, 'AAA', 'SD\"\"', '1', '0000-00-00 00:00:00', NULL, NULL, '1', '2023-07-03 00:00:00'),
(5, '', '', '1', '0000-00-00 00:00:00', NULL, NULL, '', '0000-00-00 00:00:00'),
(7, 'ZZ', 'Sue;o', '1', '0000-00-00 00:00:00', NULL, NULL, '1', '2023-07-03 00:00:00'),
(9, 'BB1', 'Bombas de agua', '1', '0000-00-00 00:00:00', '2023-07-03 00:00:00', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `orden` int(1) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `serie` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `frecuencia` int(1) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `id_almacen` int(11) NOT NULL,
  `ubicacion` text NOT NULL,
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `codigo`, `description`, `orden`, `id_categoria`, `marca`, `modelo`, `serie`, `estado`, `frecuencia`, `observaciones`, `id_almacen`, `ubicacion`, `delete_by`, `delete_date`, `modify_by`, `modify_date`, `create_date`, `create_by`) VALUES
(1, 'AA0016', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'TGM', 'MWNT245', 'D200298520515901120059', 'Activo', 0, 'N/A', 1, 'Área de Servicios - Mantenimiento', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(2, 'AA0017', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'TGM', 'MUVT24S', '2403149460172210160014', 'Activo', 0, 'N/A', 1, 'Comedor (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(3, 'AA0018', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'DAIKIN', 'FTKS18EL216', '3D15970000053', 'Activo', 0, 'N/A', 1, 'Área de Cómputos (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(4, 'AA0019', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'DAIKIN', 'FTKS18EL216', '', 'Activo', 0, 'N/A', 1, 'Garita de Seguridad (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(5, 'AA0020', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'DAIKIN', 'FTKS18EL216', '3D15970000059', 'Activo', 0, 'N/A', 1, 'Recepcion (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(6, 'AA0021 ', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'CIAC', 'CH43KX024-H3N1C', '34052525371068307015025 4', 'Activo', 0, 'N/A', 1, 'Área de Cómputos (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(7, 'AA0022', 'Equipo de Aire Acondicionado Split Pared', 0, 2, 'TGM', 'MWDRTT18S', 'SN3405491690384230151193', 'Activo', 0, 'N/A', 1, 'Dispensario (Almacen I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(8, 'AA0023', 'Equipo de Aire Acondicionado Split Pared', 0, 2, 'Air Max', 'AWGCC30-C2', '', 'Activo', 0, 'N/A', 1, 'Garita de Seguridad', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(9, 'BO0005 ', 'Bomba de Recirculación de Agua Helada # I', 0, 2, 'WEG', '020180P3E256JM', '', 'Activo', 0, 'N/A', 1, 'Area Externa Almacén (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(10, 'BO0006 ', 'Bomba de Recirculación de Agua Helada # II', 0, 2, 'WEG', '02018EP3E256JM', '', 'Activo', 0, 'N/A', 1, 'Área de Chiller (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(11, 'BO0007 ', 'Bomba de Recirculación de Agua Helada # III', 0, 2, 'WEG', '020180P3E256JM', '', 'Activo', 0, 'N/A', 1, 'Area Externa Almacén (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(12, 'BO0009', 'Bomba de Recirculación de Agua Helada # IV', 0, 2, 'US MOTORS', 'FK32', '107656777-0047M0001', 'Activo', 0, 'N/A', 1, 'Area Externa (Almacén II) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(13, 'BO0010', 'Bomba de Recirculación de Agua Helada # V', 0, 2, 'US MOTORS', 'FK38', '107656777-0047M0001', 'Activo', 0, 'N/A', 1, 'Area Externa (Almacén II) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(14, 'CA0001', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(15, 'CA0002', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(16, 'CA0003', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(17, 'CA0004', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(18, 'CA0005', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(19, 'CA0006', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(20, 'CA0007', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(21, 'CA0008', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(22, 'CA0009', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(23, 'CA0010', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(24, 'CA0013', 'Cortina de Aire', 0, 2, 'Comfort Star', 'EAC - 1500 R', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Recepción (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(25, 'CA0014', 'Cortina de Aire', 0, 2, 'Comfort Star', 'EAC - 1200 R', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Recepción (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(26, 'CA0017', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A298656', 'Activo', 0, 'Equipo nuevo', 1, 'Entrada principal almacen (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(27, 'CA0018', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A298653', 'Activo', 0, 'Equipo nuevo', 1, 'Entrada principal almacen (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(28, 'CA0019', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A298660', 'Activo', 0, 'Equipo nuevo', 1, 'Entrada principal almacen (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(29, 'CA0020', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A29922B', 'Activo', 0, 'Equipo nuevo', 1, 'Entrada principal almacen (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(30, 'CA0021', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A299234', 'Activo', 0, 'Equipo nuevo', 1, 'Devoluciones (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(31, 'CA0022', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR09', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(32, 'CA0023', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR10', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(33, 'CA0024', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR12', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(34, 'CA0025', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR15', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(35, 'CA0026', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR18', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(36, 'CA0027', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR20', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(37, 'CA0028', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1215-N2', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(38, 'CA0029', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1215-N2', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(39, 'CA0030', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1215-N2', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(40, 'CA0031', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1209-N2', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, 'Devoluciones (Almacén II) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(41, 'CA0032', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1209-N2', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, 'Devoluciones (Almacén II) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(42, 'CF0002', 'Unidad Condensadora Cuarto Frío I', 0, 2, 'Copeland', 'FGAH-A301-TFC-020', '10H20890U', 'Activo', 0, 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(43, 'CF0003', 'Evaporador I Cuarto Frío II', 0, 2, 'HEATCRAFT', 'LHT030X6CFM', 'T14D01777', 'Activo', 0, 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(44, 'CF0004', 'Evaporador II Cuarto Frío II', 0, 2, 'HEATCRAFT', 'LHT030X6CFM', 'T14F02765', 'Activo', 0, 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(45, 'CF0005', 'Evaporador Pre-Cámara', 0, 2, 'HEATCRAFT', 'LHT030X6CFM', 'T14F02761', 'Activo', 0, 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(46, 'CF0006', 'Condensador I Cuarto Frío II', 0, 2, 'HEATCRAFT', 'LHT030X60CFM', 'T14DO1777', 'Activo', 0, 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(47, 'CF0007', 'Condensador II Cuarto Frío II', 0, 2, 'HEATCRAFT', 'LHT030X60CFM', '14F02765', 'Activo', 0, 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(48, 'CF0008', 'Condensador I Cuarto Frío I', 0, 2, 'DANFOSS', 'HJZ036D32Q', '0103654AV0417', 'Activo', 0, 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(49, 'CH0001', 'Chiller I', 0, 2, 'TRANE', 'RTAC 1554 UX0H UAFN N1TY 1CDB NN6T NI0N N0EX N', 'U13B05652', 'Activo', 0, 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(50, 'CH0002', 'Chiller II', 0, 2, 'TRANE', 'RTAC 1554 UX0H UAFN N1TY 1CDB NN6T NI0N N0EX N', 'U13B05651', 'Activo', 0, 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(51, 'CH0003', 'Chiller III', 0, 2, 'TRANE', 'CGAM 052F 2Q03 AXB2 A1A1 A1AX 1AXX XXXX XA1A 3X1D 1XXL XX', 'U17E61969', 'Activo', 0, 'N/A', 1, 'Area Externa (Almacén II) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(52, 'CH0004', 'Chiller IV', 0, 2, 'TRANE', 'CGAM 052F 2Q03 AXB2 A1A1 A1AX 1AXX XXXX XA1A 3X1D 1XXL XX', 'U19E61968', 'Activo', 0, 'N/A', 1, 'Area Externa (Almacén II) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(53, 'EL0001', 'Máquina Fregadora de Pisos Tenant', 0, 2, 'TENNANT', 'M 5400', '5400-10301133', 'Activo', 0, 'N/A', 1, 'Baño General Almacén (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(54, 'EL0002', 'Máquina Aspiradora Seco y Húmedo Tenant', 0, 2, 'TENNANT 3500', '', '', 'Activo', 0, 'N/A', 1, 'Baño General Almacén (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(55, 'EL0006', 'Máquina Fregadora de Pisos Tenant', 0, 2, 'TENNANT', '', '5400-10301133', 'Activo', 0, 'N/A', 1, 'Baño General (Almacén II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(56, 'GE0001', 'Generador Eléctrico', 0, 2, 'SDMO', 'JS275UC', 'JS275UC04013368', 'Activo', 0, 'N/A', 1, 'Área Externa Almacén (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(57, 'GE0002', 'Generador Eléctrico', 0, 2, 'SDMO', 'J275UC', 'J275UC06020720', 'Activo', 0, 'N/A', 1, 'Área Externa (Almacén II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(58, 'GE0003', 'Generador Eléctrico', 0, 2, 'SDMO', 'TAD1344GE', '', 'Activo', 0, 'Nuevo', 1, 'Área Externa Almacén (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(59, 'GE0004', 'Generador Eléctrico', 0, 2, 'CUMMINS', 'N/A', '', 'Activo', 0, 'N/A', 1, 'Oficina gazcue', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(60, 'IV0001', 'INVERSOR', 0, 2, 'TRACE', 'APC-1012', 'BB44010069', 'Activo', 0, 'Nuevo', 1, 'Área de Cuarto Frío (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(61, 'IV0011', 'INVERSOR DE PANELES SOLARES', 0, 2, 'Solis', 'Solis-75K-5G-US', '', 'Activo', 0, 'Nuevo', 1, 'Cuarto Eléctrico (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(62, 'IV0012', 'INVERSOR DE PANELES SOLARES', 0, 2, 'Solis', 'Solis-75K-5G-US', '', 'Activo', 0, 'Nuevo', 1, 'Cuarto Eléctrico (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(63, 'IV0013', 'INVERSOR DE PANELES SOLARES', 0, 2, 'Solis', 'Solis-75K-5G-US', '', 'Activo', 0, 'Nuevo', 1, 'Cuarto Eléctrico (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(64, 'UP0001', 'UPS', 0, 2, 'APC', 'SUA3000', 'AS1507234167', 'Activo', 0, 'Nuevo', 1, 'Cuarto Eléctrico (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(65, 'UP0002', 'UPS', 0, 2, 'APC', 'N/A', 'N/A', 'Activo', 0, 'N/A', 1, 'Garita de Seguridad (Almacen I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(66, 'UP0003', 'UPS', 0, 2, 'APC', 'N/A', 'SYAF16KT', 'Activo', 0, 'N/A', 1, 'Computo Oficina Gazcue', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(67, 'UP0004', 'UPS', 0, 2, 'Ablerex', 'AB-TRBATV34-40', '', 'Activo', 0, 'Nuevo', 1, 'Computo Almacen I', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(68, 'UP0005', 'UPS', 0, 2, 'Ablerex', 'AB-TRBATV34-41', '', 'Activo', 0, 'Nuevo', 1, 'Computo Almacen I', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(69, 'MC0001', 'Montacargas Eléctrico', 0, 2, 'CROWN', 'RR-5225-30', '1A296094', 'Activo', 0, 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(70, 'MC0002', 'Montacargas Eléctrico', 0, 2, 'CROWN', 'RD-5225-30', '1A312626', 'Activo', 0, 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(71, 'MC0003', 'Stockpicker', 0, 2, 'CROWN', 'SP3520', '1A419962', 'Activo', 0, 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(72, 'MC0004', 'Palet Eléctrico', 0, 2, 'CROWN', 'WP2335-45', '5A339602', 'Activo', 0, 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(73, 'MC0005', 'Palet Eléctrico', 0, 2, 'CROWN', 'WP2335-45', '5A339603', 'Activo', 0, 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(74, 'MC0006', 'Stockpicker', 0, 2, 'CROWN', 'SP3500', '1A467957', 'Activo', 0, 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(75, 'MC0007', 'Palet Eléctrico', 0, 2, 'CROWN', 'WP3000', '7A300628', 'Activo', 0, 'N/A', 1, 'Área de Recepción (Almacén II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(76, 'MC0008', 'Montacargas Eléctrico', 0, 2, 'CROWN', 'RMD6000S', '1A569399', 'Activo', 0, 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(77, 'MH0007', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02429', 'Activo', 0, 'N/A', 1, 'Almacén Carga Pesada A (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(78, 'MH0008', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02430', 'Activo', 0, 'N/A', 1, 'Almacén Carga Pesada A (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(79, 'MH0009', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02433', 'Activo', 0, 'N/A', 1, 'Área de Picking (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(80, 'MH0010', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02428', 'Activo', 0, 'N/A', 1, 'Área de Picking (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(81, 'MH0011', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02435', 'Activo', 0, 'N/A', 1, 'Almacén Carga Pesada B (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(82, 'MH0012', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02431', 'Activo', 0, 'N/A', 1, 'Almacén Carga Pesada B (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(83, 'MH0013', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02432', 'Activo', 0, 'N/A', 1, 'Almacén Carga Pesada B (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(84, 'MH0014', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02434', 'Activo', 0, 'N/A', 1, 'Almacén Carga Pesada B (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(85, 'MH0015', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA12F1K0RG000000300EABA00PA000U0060', 'K13A02426', 'Activo', 0, 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(86, 'MH0016', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAD12F1K0RG000000EACA00PA000000G0', 'K13A02427', 'Activo', 0, 'N/A', 1, 'Área de Preparación y Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(87, 'MH0017', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAD12F1K0RG000000300EACA00PA000U0060', 'K13A02425', 'Activo', 0, 'N/A', 1, 'Área de Preparación y Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(88, 'MH0018', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAD12F1K0RG000000300EACA00PA000U0060', 'K13A02424', 'Activo', 0, 'N/A', 1, 'Área de Oficinas (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(89, 'MH0019', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA10F1K0RG000000300DACA00PA000U0060', 'K13A02437', 'Activo', 0, 'N/A', 1, 'Área de Cafetería (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(90, 'MH0020', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA10F1K0RG000000300DACA00PA000U0060', '74Y161AG', 'Activo', 0, 'N/A', 1, 'Devoluciones (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(91, 'MH0022', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'UCCAG14C0A0RL032000000EC859B00000000', 'K17D31292', 'Activo', 0, 'N/A', 1, 'Carga Pesada (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(92, 'MH0023', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'UCCAG14C0A0RL032000000EC859B00000000', 'K17D31290', 'Activo', 0, 'N/A', 1, 'Devoluciones (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(93, 'MH0024', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'UCCAG14C0A0RL032000000EC859B00000000', 'K17D31291', 'Activo', 0, 'N/A', 1, 'Carga Pesada (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(94, 'MH0025', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'UCCAG14C0A0RL032000000EC859B00000000', 'K17D31293', 'Activo', 0, 'N/A', 1, 'Devoluciones (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(95, 'NE0008', 'Nevera Dispensadora de Agua ', 0, 2, 'AMERICAN', 'BE-66', 'N/A', 'Activo', 0, 'N/A', 1, 'Área de Recepción', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(96, 'NE0018', 'Congelador Horizontal No.2', 0, 2, 'Frigidaire', 'GLFC1526FW9', 'WB14548780', 'Activo', 0, 'N/A', 1, 'Área de Preparación y Despacho', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(97, 'NE0019', 'Congelador Horizontal No.1', 0, 2, 'Frigidaire', 'FGCH25M8LW1', 'WB41155383', 'Activo', 0, 'N/A', 1, 'Área de Preparación y Despacho', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(98, 'NE0020', 'Congelador Horizontal No.3', 0, 2, 'Electrolux', 'FFFC22M6QWE', 'WB72050658', 'Activo', 0, 'N/A', 1, 'Área de Preparación y Despacho', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(99, 'NE0021', 'Congelador Horizontal No.4', 0, 2, 'Frigidaire', 'FFFC20M4TW', 'AA20350008', 'Activo', 0, 'N/A', 1, 'Área de Preparación y Despacho', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(100, 'YHPVQL9', 'Bombas test', 0, 9, 'cualquiera', 'cualquiera', 'qwerqwerwe1113e', 'Activo', 1, '', 6, '2', NULL, NULL, NULL, NULL, '2023-07-05 01:56:49', '1'),
(101, 'YHPVQL12', 'Bombas test  ', 1, 9, 'cualquiera', 'cualquiera', 'zzzzz', 'Inactivo', 4, 'Ejemplo 3', 1, '8', NULL, NULL, '1', '2023-07-05 00:00:00', '2023-07-05 01:59:13', '1'),
(103, 'YHPV', 'Aire Acondicionados inverter', 1, 9, 'TCL', 'BAKKS2020', 'EW4444WDDDDS00', 'Activo', 1, 'Ejemplo', 6, '2', NULL, NULL, '1', '2023-07-06 00:00:00', '2023-07-06 00:00:01', '1'),
(104, 'YH', 'Aire Acondicionados inverter', 0, 9, 'MyIdea', 'FWW999', 'EW4444WDDDDS00', 'Activo', 1, 'Ejemplo', 6, '2', NULL, NULL, NULL, NULL, '2023-07-06 00:01:17', '1'),
(105, 'YHPVQL922', 'Bombas test 5', 1, 9, 'TCL', 'FWW', '24444R34333333333', 'Activo', 1, 'Ejemplo', 6, '2', NULL, NULL, '1', '2023-07-20 00:00:00', '2023-07-06 00:09:07', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_actividad`
--

CREATE TABLE `equipos_actividad` (
  `id` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `create_by` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modify_date` datetime DEFAULT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipos_actividad`
--

INSERT INTO `equipos_actividad` (`id`, `id_actividad`, `id_equipo`, `create_by`, `create_date`, `modify_date`, `modify_by`, `delete_by`, `delete_date`) VALUES
(2, 4, 101, '1', '2023-07-05 00:23:07', NULL, NULL, NULL, NULL),
(3, 3, 101, '1', '2023-07-05 00:36:56', NULL, NULL, NULL, NULL),
(5, 6, 100, '1', '2023-07-05 00:39:35', NULL, NULL, NULL, NULL),
(6, 4, 100, '1', '2023-07-05 00:41:06', NULL, NULL, NULL, NULL),
(12, 4, 104, '1', '2023-07-05 20:40:51', NULL, NULL, NULL, NULL),
(13, 6, 104, '1', '2023-07-05 20:40:56', NULL, NULL, NULL, NULL),
(15, 6, 11, '1', '2023-07-05 20:46:27', NULL, NULL, NULL, NULL),
(22, 4, 14, '1', '2023-07-05 21:34:14', NULL, NULL, NULL, NULL),
(23, 6, 14, '1', '2023-07-05 21:34:20', NULL, NULL, NULL, NULL),
(24, 3, 105, '1', '2023-07-05 21:36:12', NULL, NULL, NULL, NULL),
(27, 4, 103, '1', '2023-07-13 12:57:59', NULL, NULL, NULL, NULL),
(28, 7, 105, '1', '2023-07-22 10:26:02', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas_ejecucion`
--

CREATE TABLE `fechas_ejecucion` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `equipo` int(10) NOT NULL,
  `realizado` int(1) DEFAULT 0,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(50) NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fechas_ejecucion`
--

INSERT INTO `fechas_ejecucion` (`id`, `fecha`, `equipo`, `realizado`, `create_date`, `create_by`, `modify_date`, `modify_by`) VALUES
(157, '2023-08-02', 101, 0, '2023-08-09 20:42:47', '1', NULL, NULL),
(158, '2023-08-17', 101, 0, '2023-08-09 20:42:47', '1', NULL, NULL),
(159, '2023-08-19', 101, 0, '2023-08-09 20:42:47', '1', NULL, NULL),
(160, '2023-07-14', 104, 0, '2023-08-13 13:20:00', '1', NULL, NULL),
(161, '2023-08-13', 104, 0, '2023-08-13 13:20:00', '1', NULL, NULL),
(162, '2023-09-21', 104, 0, '2023-08-13 13:20:00', '1', NULL, NULL),
(163, '2023-10-11', 104, 0, '2023-08-13 13:20:00', '1', NULL, NULL),
(164, '2023-10-17', 104, 0, '2023-08-13 13:20:00', '1', NULL, NULL),
(165, '2023-11-26', 104, 0, '2023-08-13 13:20:00', '1', NULL, NULL),
(166, '2023-12-08', 104, 0, '2023-08-13 13:20:00', '1', NULL, NULL),
(167, '2023-08-31', 104, 0, '2023-08-13 13:20:00', '1', NULL, NULL),
(168, '2023-06-07', 104, 1, '2023-08-13 13:20:00', '1', NULL, NULL),
(169, '2023-10-15', 104, 0, '2023-08-13 13:20:00', '1', NULL, NULL),
(170, '2023-08-21', 104, 0, '2023-08-13 13:20:00', '1', NULL, NULL),
(171, '2023-12-04', 104, 0, '2023-08-13 13:20:00', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuencia`
--

CREATE TABLE `frecuencia` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(100) NOT NULL,
  `modify_by` varchar(100) NOT NULL,
  `modify_date` datetime NOT NULL,
  `delete_date` datetime NOT NULL,
  `delete_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos`
--

CREATE TABLE `mantenimientos` (
  `id` int(11) NOT NULL,
  `documento_no` varchar(100) NOT NULL,
  `version` varchar(100) NOT NULL,
  `documento_relacionado` varchar(100) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `ubicacion` int(6) NOT NULL,
  `equipo` int(6) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `razon_tardanza` text DEFAULT NULL,
  `codigo_temp` varchar(10) DEFAULT NULL,
  `create_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mantenimientos`
--

INSERT INTO `mantenimientos` (`id`, `documento_no`, `version`, `documento_relacionado`, `codigo`, `fecha`, `ubicacion`, `equipo`, `observaciones`, `razon_tardanza`, `codigo_temp`, `create_by`) VALUES
(30, '0012', '1', 'FOR-12', 'YH', '2023-08-19 00:00:00', 2, 104, 'Ninguna observacion general', 'Esto es probando', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos_details`
--

CREATE TABLE `mantenimientos_details` (
  `id` int(11) NOT NULL,
  `id_mantenimiento` int(6) NOT NULL,
  `ok` int(1) NOT NULL,
  `no_aplica` int(1) NOT NULL,
  `r` int(1) NOT NULL,
  `observacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mantenimientos_details`
--

INSERT INTO `mantenimientos_details` (`id`, `id_mantenimiento`, `ok`, `no_aplica`, `r`, `observacion`) VALUES
(7, 30, 1, 0, 0, 'Ninguna observacion'),
(8, 30, 0, 1, 0, 'Ninguna observacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordentrabajodetail`
--

CREATE TABLE `ordentrabajodetail` (
  `id` int(11) NOT NULL,
  `id_OrdenTrabajoHeader` int(11) NOT NULL,
  `realizado_por` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `horaIni` varchar(10) NOT NULL,
  `horaFin` varchar(10) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(100) NOT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ordentrabajodetail`
--

INSERT INTO `ordentrabajodetail` (`id`, `id_OrdenTrabajoHeader`, `realizado_por`, `fecha`, `horaIni`, `horaFin`, `create_date`, `create_by`, `modify_by`, `modify_date`, `delete_date`, `delete_by`) VALUES
(1, 1, 'Jose roberto', '2023-07-09 00:00:00', '17:05', '19:05', '2023-07-09 21:12:33', '1', NULL, NULL, NULL, NULL),
(5, 1, 'Maria Josefa', '2023-07-08 00:00:00', '17:29', '19:28', '2023-07-09 21:28:31', '1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordentrabajoheader`
--

CREATE TABLE `ordentrabajoheader` (
  `id` int(11) NOT NULL,
  `documentoNum` varchar(50) NOT NULL,
  `version` int(3) NOT NULL,
  `documentoRelacionado` varchar(50) NOT NULL,
  `orderNum` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `hora` varchar(10) NOT NULL,
  `solicitadoPor` varchar(100) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `nivelPrioridad` varchar(3) NOT NULL,
  `areaOEquipo` varchar(100) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `nota` text DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(100) NOT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ordentrabajoheader`
--

INSERT INTO `ordentrabajoheader` (`id`, `documentoNum`, `version`, `documentoRelacionado`, `orderNum`, `fecha`, `hora`, `solicitadoPor`, `departamento`, `nivelPrioridad`, `areaOEquipo`, `codigo`, `ubicacion`, `descripcion`, `nota`, `create_date`, `create_by`, `modify_by`, `modify_date`, `delete_date`, `delete_by`) VALUES
(1, 'PSR-001', 1, 'FOR-002', '022012', '2023-07-02 00:00:00', '20:02', 'Jorge2', 'Distribucion2', '2', 'produccion adentro2', 'YHPVQL932', 'Almacen2', 'Distribucion2', 'nad2', '2023-07-06 23:03:45', '1', '1', '2023-07-09 00:00:00', NULL, NULL),
(2, 'PSR-001', 1, 'FOR-001', '02201', '2023-07-06 00:00:00', '21:03', 'Claribel', 'Produccion', '1', 'produccion adentro', 'YHPVQL9', 'almaen', 'Esto es un ejemplo', '', '2023-07-06 23:04:14', '1', NULL, NULL, NULL, NULL),
(3, 'PSR-001', 1, 'FOR-001', '02201', '2023-07-06 00:00:00', '21:03', 'Claribel', 'Produccion', '1', 'produccion adentro', 'YHPVQL9', 'almaen', '', '', '2023-07-06 23:04:45', '1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacionmantenimientosheader`
--

CREATE TABLE `programacionmantenimientosheader` (
  `id` int(11) NOT NULL,
  `id_Equipos_Actividad` int(11) NOT NULL,
  `id_frecuencia` int(3) NOT NULL,
  `version` int(3) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(100) NOT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programadetails`
--

CREATE TABLE `programadetails` (
  `id` int(11) NOT NULL,
  `id_programaHeader` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programadetails`
--

INSERT INTO `programadetails` (`id`, `id_programaHeader`, `id_equipo`) VALUES
(14, 13, 105),
(17, 6, 103),
(18, 6, 105);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programaheader`
--

CREATE TABLE `programaheader` (
  `id` int(11) NOT NULL,
  `doc_no` varchar(100) NOT NULL,
  `doc_relacionado` varchar(100) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `descripcion` text NOT NULL,
  `version` int(11) NOT NULL,
  `estado` int(6) DEFAULT NULL,
  `temp` int(6) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(100) NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` varchar(3) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programaheader`
--

INSERT INTO `programaheader` (`id`, `doc_no`, `doc_relacionado`, `fecha_ini`, `fecha_fin`, `descripcion`, `version`, `estado`, `temp`, `create_date`, `create_by`, `modify_date`, `modify_by`, `delete_date`, `delete_by`) VALUES
(6, 'RPG-23', 'FOR-13', '2023-01-03', '2023-01-01', 'PROGRAMACION DE MANTENIMIENTO DE INSTALACION Y EQUIPOS 2021', 3, 0, NULL, '2023-07-17 21:01:37', '1', '2023-07-20 00:00:00', '1', NULL, NULL),
(7, 'RPG-22', 'FOR-11', '2023-01-01', '2023-01-01', 'PROGRAMACION DE MANTENIMIENTO DE INSTALACION Y EQUIPOS 2024', 1, 0, NULL, '2023-07-17 21:06:58', '1', '2023-07-20 00:00:00', '1', NULL, NULL),
(8, 'RPG-22', 'FOR-11', '2023-01-01', '2023-01-01', 'PROGRAMACION DE MANTENIMIENTO DE INSTALACION Y EQUIPOS 2024', 1, 0, NULL, '2023-07-19 22:14:45', '1', '2023-07-20 00:00:00', '1', NULL, NULL),
(9, 'RPG-22', 'FOR-11', '2023-01-01', '2023-01-01', 'PROGRAMACION DE MANTENIMIENTO DE INSTALACION Y EQUIPOS 2024', 1, NULL, 73956, '2023-07-19 22:38:49', '1', '2023-07-20 00:00:00', '1', NULL, NULL),
(10, 'RPG-22', 'FOR-11', '2023-01-01', '2023-01-01', 'PROGRAMACION DE MANTENIMIENTO DE INSTALACION Y EQUIPOS 2024', 1, 0, 91193, '2023-07-19 23:39:49', '1', '2023-07-20 00:00:00', '1', NULL, NULL),
(11, 'RPG-22', 'FOR-11', '2023-01-01', '2023-01-01', 'PROGRAMACION DE MANTENIMIENTO DE INSTALACION Y EQUIPOS 2024', 1, 0, 70099, '2023-07-19 23:41:01', '1', '2023-07-20 00:00:00', '1', NULL, NULL),
(12, 'RPG-22', 'FOR-11', '2023-01-01', '2023-01-01', 'PROGRAMACION DE MANTENIMIENTO DE INSTALACION Y EQUIPOS 2024', 1, 0, 28313, '2023-07-19 23:41:30', '1', '2023-07-20 00:00:00', '1', NULL, NULL),
(13, 'RPG-22', 'FOR-11', '2023-01-01', '2023-12-31', 'PROGRAMACION DE MANTENIMIENTO DE INSTALACION Y EQUIPOS 2024', 1, 1, 64108, '2023-07-19 23:42:32', '1', '2023-07-20 00:00:00', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(50) NOT NULL,
  `modify_by` varchar(50) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `description`, `create_date`, `create_by`, `modify_by`, `modify_date`, `delete_date`, `delete_by`) VALUES
(1, 'Super_admin', '2023-06-18 17:37:23', '0', NULL, NULL, NULL, NULL),
(8, 'Administrator', '2023-06-18 22:29:15', '1', NULL, NULL, '2023-07-01 00:00:00', '1'),
(9, 'Tecnicos', '2023-06-18 22:29:54', '1', NULL, NULL, NULL, NULL),
(10, 'Supervisor', '2023-06-18 22:30:22', '1', NULL, NULL, NULL, NULL),
(22, 'Contador', '2023-06-30 23:22:30', '1', NULL, NULL, '2023-07-01 00:00:00', '1'),
(23, 'New', '2023-06-30 23:50:31', '1', NULL, NULL, '2023-07-01 00:00:00', '1'),
(24, 'contador', '2023-07-01 14:05:21', '1', NULL, NULL, NULL, NULL),
(25, 'zz2', '2023-07-02 01:05:00', '1', NULL, NULL, '2023-07-02 00:00:00', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolpermisos`
--

CREATE TABLE `rolpermisos` (
  `id` int(11) NOT NULL,
  `id_Rol` int(2) NOT NULL,
  `Modulo_Ordenes` int(1) NOT NULL,
  `Crear_Modulo_Ordenes` int(1) NOT NULL,
  `Editar_Modulo_Ordenes` int(1) NOT NULL,
  `Eliminar_Modulo_Ordenes` int(1) NOT NULL,
  `Modulo_Usuarios` int(1) NOT NULL,
  `Crear_Modulo_Usuarios` int(1) NOT NULL,
  `Editar_Modulo_Usuarios` int(1) NOT NULL,
  `Eliminar_Modulo_Usuarios` int(1) NOT NULL,
  `Modulo_Roles` int(1) NOT NULL,
  `Crear_Modulo_Roles` int(1) NOT NULL,
  `Editar_Modulo_Roles` int(1) NOT NULL,
  `Eliminar_Modulo_Roles` int(1) NOT NULL,
  `Modulo_ProgramaMantenimiento` int(1) NOT NULL,
  `Crear_Modulo_ProgramaMantenimiento` int(1) NOT NULL,
  `Edita_Modulo_ProgramaMantenimiento` int(1) NOT NULL,
  `Eliminar_Modulo_ProgramaMantenimiento` int(1) NOT NULL,
  `Frecuencias` int(1) NOT NULL,
  `Crear_Frecuencias` int(1) NOT NULL,
  `Editar_Frecuencias` int(1) NOT NULL,
  `Eliminar_Frecuencias` int(1) NOT NULL,
  `Actividades` int(1) NOT NULL,
  `Crear_Actividades` int(1) NOT NULL,
  `Editar_Actividades` int(1) NOT NULL,
  `Eliminar_Actividades` int(1) NOT NULL,
  `Equipos` int(1) NOT NULL,
  `Crear_Equipos` int(1) NOT NULL,
  `Editar_Equipos` int(1) NOT NULL,
  `Eliminar_Equipos` int(1) NOT NULL,
  `Categorias` int(1) NOT NULL,
  `Crear_Categorias` int(1) NOT NULL,
  `Editar_Categorias` int(1) NOT NULL,
  `Eliminar_Categorias` int(1) NOT NULL,
  `Modulo_Almacenes` int(1) NOT NULL,
  `Crear_Modulo_Almacenes` int(1) NOT NULL,
  `Editar_Modulo_Almacenes` int(1) NOT NULL,
  `Eliminar_Modulo_Almacenes` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rolpermisos`
--

INSERT INTO `rolpermisos` (`id`, `id_Rol`, `Modulo_Ordenes`, `Crear_Modulo_Ordenes`, `Editar_Modulo_Ordenes`, `Eliminar_Modulo_Ordenes`, `Modulo_Usuarios`, `Crear_Modulo_Usuarios`, `Editar_Modulo_Usuarios`, `Eliminar_Modulo_Usuarios`, `Modulo_Roles`, `Crear_Modulo_Roles`, `Editar_Modulo_Roles`, `Eliminar_Modulo_Roles`, `Modulo_ProgramaMantenimiento`, `Crear_Modulo_ProgramaMantenimiento`, `Edita_Modulo_ProgramaMantenimiento`, `Eliminar_Modulo_ProgramaMantenimiento`, `Frecuencias`, `Crear_Frecuencias`, `Editar_Frecuencias`, `Eliminar_Frecuencias`, `Actividades`, `Crear_Actividades`, `Editar_Actividades`, `Eliminar_Actividades`, `Equipos`, `Crear_Equipos`, `Editar_Equipos`, `Eliminar_Equipos`, `Categorias`, `Crear_Categorias`, `Editar_Categorias`, `Eliminar_Categorias`, `Modulo_Almacenes`, `Crear_Modulo_Almacenes`, `Editar_Modulo_Almacenes`, `Eliminar_Modulo_Almacenes`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(4, 9, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(5, 10, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(7, 22, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(8, 23, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(9, 24, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(10, 25, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `create_by` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modify_date` datetime DEFAULT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `codigo`, `description`, `create_by`, `create_date`, `modify_date`, `modify_by`, `delete_by`, `delete_date`) VALUES
(2, 'DA', 'Direccion Administrativa 30', '1', '2023-07-02 12:52:12', '2023-07-02 00:00:00', '1', NULL, NULL),
(3, 'DA', 'Direccion Administrativa, ', '1', '2023-07-02 12:55:17', NULL, NULL, NULL, NULL),
(4, 'dd', 'Almacen12 \"', '1', '2023-07-02 13:13:19', NULL, NULL, '1', '2023-07-02 00:00:00'),
(5, 'dd', '\"fsdf\"', '1', '2023-07-02 13:14:50', NULL, NULL, '1', '2023-07-02 00:00:00'),
(6, 'dd', '\"fsdf', '1', '2023-07-02 13:15:11', NULL, NULL, '1', '2023-07-02 00:00:00'),
(7, 'YHPVQL9', 'Almacen121212', '1', '2023-07-02 13:17:12', NULL, NULL, '1', '2023-07-02 00:00:00'),
(8, 'ed', 'Ya es otra cosa', '1', '2023-07-02 14:39:18', '2023-07-02 00:00:00', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `last_session_init` datetime DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(100) NOT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `name`, `lastname`, `last_session_init`, `id_rol`, `create_date`, `create_by`, `modify_by`, `modify_date`, `delete_date`, `delete_by`) VALUES
(1, 'Super_admin', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', '', '', '2023-06-18 20:46:50', 1, '2023-06-18 20:46:50', '0', NULL, NULL, NULL, NULL),
(13, 'Freddypimpns', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', 'Freddy Miguel', 'Pereyra', NULL, 9, '0000-00-00 00:00:00', '1', NULL, NULL, NULL, NULL),
(14, 'Freddypimpns@', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', 'Felix', 'Pereyra', NULL, 9, '2023-06-19 22:49:26', '1', NULL, NULL, NULL, NULL),
(15, '40224540423', 'b6cad64f62527c34f77007fe88c6c65c37fcce98', 'Alura Challenges ONE', 'Pereyra', NULL, 8, '2023-06-19 22:51:03', '1', NULL, NULL, '2023-07-01 00:00:00', '1'),
(17, 'Claribel', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', 'Claribel Esther', 'Maldonado Villanueva', NULL, 10, '2023-06-20 22:02:18', '1', NULL, NULL, NULL, NULL),
(19, 'Contador', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', 'Claribel Esther', 'Maldonado', NULL, 10, '2023-06-30 21:48:17', '1', NULL, NULL, '2023-07-01 00:00:00', '1'),
(20, '2022-01-3-0201', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', '2022-01-3-0201', '2022-01-3-0201', NULL, 9, '2023-06-30 23:49:33', '1', NULL, NULL, '2023-07-01 00:00:00', '1'),
(21, 'Super_admin2', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', 'Claribel Esther', 'Maldonado', NULL, 23, '2023-06-30 23:57:32', '1', NULL, NULL, '2023-07-01 00:00:00', '1'),
(22, 'Freddypimpns9', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', 'Claribel Esther', 'Maldonado', NULL, 22, '2023-06-30 23:58:26', '1', NULL, NULL, '2023-07-01 00:00:00', '1'),
(23, 'nnn', 'c71a9db62f2cf6b35d69c38af22c4dd6d74e48a9', 'nnn', 'nnn', NULL, 23, '2023-06-30 23:58:52', '1', NULL, NULL, '2023-07-01 00:00:00', '1'),
(24, 'Prueba', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', 'prueba', 'prueba', NULL, 22, '2023-07-01 11:09:12', '1', NULL, NULL, '2023-07-01 00:00:00', '1'),
(26, 'zz', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', 'zz', 'zz', NULL, 10, '2023-07-02 01:04:05', '1', NULL, NULL, '2023-07-02 00:00:00', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `equipos_actividad`
--
ALTER TABLE `equipos_actividad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fechas_ejecucion`
--
ALTER TABLE `fechas_ejecucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `frecuencia`
--
ALTER TABLE `frecuencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mantenimientos_details`
--
ALTER TABLE `mantenimientos_details`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordentrabajodetail`
--
ALTER TABLE `ordentrabajodetail`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordentrabajoheader`
--
ALTER TABLE `ordentrabajoheader`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programacionmantenimientosheader`
--
ALTER TABLE `programacionmantenimientosheader`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programadetails`
--
ALTER TABLE `programadetails`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programaheader`
--
ALTER TABLE `programaheader`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rolpermisos`
--
ALTER TABLE `rolpermisos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_Rol` (`id_Rol`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `equipos_actividad`
--
ALTER TABLE `equipos_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `fechas_ejecucion`
--
ALTER TABLE `fechas_ejecucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT de la tabla `frecuencia`
--
ALTER TABLE `frecuencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `mantenimientos_details`
--
ALTER TABLE `mantenimientos_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ordentrabajodetail`
--
ALTER TABLE `ordentrabajodetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ordentrabajoheader`
--
ALTER TABLE `ordentrabajoheader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `programacionmantenimientosheader`
--
ALTER TABLE `programacionmantenimientosheader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programadetails`
--
ALTER TABLE `programadetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `programaheader`
--
ALTER TABLE `programaheader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `rolpermisos`
--
ALTER TABLE `rolpermisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
