-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2023 a las 04:19:54
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
(1, 'A3', 'Almacen 3\"', 'Freddypimpns@gmail.com', '2023-06-21 02:51:01', NULL, NULL, NULL, NULL);

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

INSERT INTO `equipos` (`id`, `codigo`, `description`, `orden`, `id_categoria`, `marca`, `modelo`, `serie`, `estado`, `observaciones`, `id_almacen`, `ubicacion`, `delete_by`, `delete_date`, `modify_by`, `modify_date`, `create_date`, `create_by`) VALUES
(1, 'AA0016', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'TGM', 'MWNT245', 'D200298520515901120059', 'Activo', 'N/A', 1, 'Área de Servicios - Mantenimiento', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(2, 'AA0017', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'TGM', 'MUVT24S', '2403149460172210160014', 'Activo', 'N/A', 1, 'Comedor (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(3, 'AA0018', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'DAIKIN', 'FTKS18EL216', '3D15970000053', 'Activo', 'N/A', 1, 'Área de Cómputos (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(4, 'AA0019', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'DAIKIN', 'FTKS18EL216', '', 'Activo', 'N/A', 1, 'Garita de Seguridad (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(5, 'AA0020', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'DAIKIN', 'FTKS18EL216', '3D15970000059', 'Activo', 'N/A', 1, 'Recepcion (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(6, 'AA0021 ', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'CIAC', 'CH43KX024-H3N1C', '34052525371068307015025 4', 'Activo', 'N/A', 1, 'Área de Cómputos (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(7, 'AA0022', 'Equipo de Aire Acondicionado Split Pared', 0, 2, 'TGM', 'MWDRTT18S', 'SN3405491690384230151193', 'Activo', 'N/A', 1, 'Dispensario (Almacen I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(8, 'AA0023', 'Equipo de Aire Acondicionado Split Pared', 0, 2, 'Air Max', 'AWGCC30-C2', '', 'Activo', 'N/A', 1, 'Garita de Seguridad', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(9, 'BO0005 ', 'Bomba de Recirculación de Agua Helada # I', 0, 2, 'WEG', '020180P3E256JM', '', 'Activo', 'N/A', 1, 'Area Externa Almacén (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(10, 'BO0006 ', 'Bomba de Recirculación de Agua Helada # II', 0, 2, 'WEG', '02018EP3E256JM', '', 'Activo', 'N/A', 1, 'Área de Chiller (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(11, 'BO0007 ', 'Bomba de Recirculación de Agua Helada # III', 0, 2, 'WEG', '020180P3E256JM', '', 'Activo', 'N/A', 1, 'Area Externa Almacén (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(12, 'BO0009', 'Bomba de Recirculación de Agua Helada # IV', 0, 2, 'US MOTORS', 'FK32', '107656777-0047M0001', 'Activo', 'N/A', 1, 'Area Externa (Almacén II) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(13, 'BO0010', 'Bomba de Recirculación de Agua Helada # V', 0, 2, 'US MOTORS', 'FK38', '107656777-0047M0001', 'Activo', 'N/A', 1, 'Area Externa (Almacén II) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(14, 'CA0001', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(15, 'CA0002', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(16, 'CA0003', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(17, 'CA0004', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(18, 'CA0005', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(19, 'CA0006', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(20, 'CA0007', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(21, 'CA0008', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(22, 'CA0009', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(23, 'CA0010', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 'N/A', 1, 'Área de Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(24, 'CA0013', 'Cortina de Aire', 0, 2, 'Comfort Star', 'EAC - 1500 R', 'N/A', 'Activo', 'N/A', 1, 'Área de Recepción (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(25, 'CA0014', 'Cortina de Aire', 0, 2, 'Comfort Star', 'EAC - 1200 R', 'N/A', 'Activo', 'N/A', 1, 'Área de Recepción (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(26, 'CA0017', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A298656', 'Activo', 'Equipo nuevo', 1, 'Entrada principal almacen (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(27, 'CA0018', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A298653', 'Activo', 'Equipo nuevo', 1, 'Entrada principal almacen (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(28, 'CA0019', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A298660', 'Activo', 'Equipo nuevo', 1, 'Entrada principal almacen (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(29, 'CA0020', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A29922B', 'Activo', 'Equipo nuevo', 1, 'Entrada principal almacen (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(30, 'CA0021', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A299234', 'Activo', 'Equipo nuevo', 1, 'Devoluciones (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(31, 'CA0022', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR09', 'N/A', 'Activo', 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(32, 'CA0023', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR10', 'N/A', 'Activo', 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(33, 'CA0024', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR12', 'N/A', 'Activo', 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(34, 'CA0025', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR15', 'N/A', 'Activo', 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(35, 'CA0026', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR18', 'N/A', 'Activo', 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(36, 'CA0027', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR20', 'N/A', 'Activo', 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(37, 'CA0028', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1215-N2', 'N/A', 'Activo', 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(38, 'CA0029', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1215-N2', 'N/A', 'Activo', 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(39, 'CA0030', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1215-N2', 'N/A', 'Activo', 'Equipo nuevo', 1, 'Recepcion Carga pesada (Almacén II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(40, 'CA0031', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1209-N2', 'N/A', 'Activo', 'Equipo nuevo', 1, 'Devoluciones (Almacén II) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(41, 'CA0032', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1209-N2', 'N/A', 'Activo', 'Equipo nuevo', 1, 'Devoluciones (Almacén II) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(42, 'CF0002', 'Unidad Condensadora Cuarto Frío I', 0, 2, 'Copeland', 'FGAH-A301-TFC-020', '10H20890U', 'Activo', 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(43, 'CF0003', 'Evaporador I Cuarto Frío II', 0, 2, 'HEATCRAFT', 'LHT030X6CFM', 'T14D01777', 'Activo', 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(44, 'CF0004', 'Evaporador II Cuarto Frío II', 0, 2, 'HEATCRAFT', 'LHT030X6CFM', 'T14F02765', 'Activo', 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(45, 'CF0005', 'Evaporador Pre-Cámara', 0, 2, 'HEATCRAFT', 'LHT030X6CFM', 'T14F02761', 'Activo', 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(46, 'CF0006', 'Condensador I Cuarto Frío II', 0, 2, 'HEATCRAFT', 'LHT030X60CFM', 'T14DO1777', 'Activo', 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(47, 'CF0007', 'Condensador II Cuarto Frío II', 0, 2, 'HEATCRAFT', 'LHT030X60CFM', '14F02765', 'Activo', 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(48, 'CF0008', 'Condensador I Cuarto Frío I', 0, 2, 'DANFOSS', 'HJZ036D32Q', '0103654AV0417', 'Activo', 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(49, 'CH0001', 'Chiller I', 0, 2, 'TRANE', 'RTAC 1554 UX0H UAFN N1TY 1CDB NN6T NI0N N0EX N', 'U13B05652', 'Activo', 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(50, 'CH0002', 'Chiller II', 0, 2, 'TRANE', 'RTAC 1554 UX0H UAFN N1TY 1CDB NN6T NI0N N0EX N', 'U13B05651', 'Activo', 'N/A', 1, 'Area Externa Almacén (Almacén I) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(51, 'CH0003', 'Chiller III', 0, 2, 'TRANE', 'CGAM 052F 2Q03 AXB2 A1A1 A1AX 1AXX XXXX XA1A 3X1D 1XXL XX', 'U17E61969', 'Activo', 'N/A', 1, 'Area Externa (Almacén II) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(52, 'CH0004', 'Chiller IV', 0, 2, 'TRANE', 'CGAM 052F 2Q03 AXB2 A1A1 A1AX 1AXX XXXX XA1A 3X1D 1XXL XX', 'U19E61968', 'Activo', 'N/A', 1, 'Area Externa (Almacén II) ', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(53, 'EL0001', 'Máquina Fregadora de Pisos Tenant', 0, 2, 'TENNANT', 'M 5400', '5400-10301133', 'Activo', 'N/A', 1, 'Baño General Almacén (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(54, 'EL0002', 'Máquina Aspiradora Seco y Húmedo Tenant', 0, 2, 'TENNANT 3500', '', '', 'Activo', 'N/A', 1, 'Baño General Almacén (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(55, 'EL0006', 'Máquina Fregadora de Pisos Tenant', 0, 2, 'TENNANT', '', '5400-10301133', 'Activo', 'N/A', 1, 'Baño General (Almacén II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(56, 'GE0001', 'Generador Eléctrico', 0, 2, 'SDMO', 'JS275UC', 'JS275UC04013368', 'Activo', 'N/A', 1, 'Área Externa Almacén (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(57, 'GE0002', 'Generador Eléctrico', 0, 2, 'SDMO', 'J275UC', 'J275UC06020720', 'Activo', 'N/A', 1, 'Área Externa (Almacén II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(58, 'GE0003', 'Generador Eléctrico', 0, 2, 'SDMO', 'TAD1344GE', '', 'Activo', 'Nuevo', 1, 'Área Externa Almacén (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(59, 'GE0004', 'Generador Eléctrico', 0, 2, 'CUMMINS', 'N/A', '', 'Activo', 'N/A', 1, 'Oficina gazcue', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(60, 'IV0001', 'INVERSOR', 0, 2, 'TRACE', 'APC-1012', 'BB44010069', 'Activo', 'Nuevo', 1, 'Área de Cuarto Frío (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(61, 'IV0011', 'INVERSOR DE PANELES SOLARES', 0, 2, 'Solis', 'Solis-75K-5G-US', '', 'Activo', 'Nuevo', 1, 'Cuarto Eléctrico (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(62, 'IV0012', 'INVERSOR DE PANELES SOLARES', 0, 2, 'Solis', 'Solis-75K-5G-US', '', 'Activo', 'Nuevo', 1, 'Cuarto Eléctrico (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(63, 'IV0013', 'INVERSOR DE PANELES SOLARES', 0, 2, 'Solis', 'Solis-75K-5G-US', '', 'Activo', 'Nuevo', 1, 'Cuarto Eléctrico (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(64, 'UP0001', 'UPS', 0, 2, 'APC', 'SUA3000', 'AS1507234167', 'Activo', 'Nuevo', 1, 'Cuarto Eléctrico (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(65, 'UP0002', 'UPS', 0, 2, 'APC', 'N/A', 'N/A', 'Activo', 'N/A', 1, 'Garita de Seguridad (Almacen I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(66, 'UP0003', 'UPS', 0, 2, 'APC', 'N/A', 'SYAF16KT', 'Activo', 'N/A', 1, 'Computo Oficina Gazcue', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(67, 'UP0004', 'UPS', 0, 2, 'Ablerex', 'AB-TRBATV34-40', '', 'Activo', 'Nuevo', 1, 'Computo Almacen I', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(68, 'UP0005', 'UPS', 0, 2, 'Ablerex', 'AB-TRBATV34-41', '', 'Activo', 'Nuevo', 1, 'Computo Almacen I', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(69, 'MC0001', 'Montacargas Eléctrico', 0, 2, 'CROWN', 'RR-5225-30', '1A296094', 'Activo', 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(70, 'MC0002', 'Montacargas Eléctrico', 0, 2, 'CROWN', 'RD-5225-30', '1A312626', 'Activo', 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(71, 'MC0003', 'Stockpicker', 0, 2, 'CROWN', 'SP3520', '1A419962', 'Activo', 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(72, 'MC0004', 'Palet Eléctrico', 0, 2, 'CROWN', 'WP2335-45', '5A339602', 'Activo', 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(73, 'MC0005', 'Palet Eléctrico', 0, 2, 'CROWN', 'WP2335-45', '5A339603', 'Activo', 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(74, 'MC0006', 'Stockpicker', 0, 2, 'CROWN', 'SP3500', '1A467957', 'Activo', 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(75, 'MC0007', 'Palet Eléctrico', 0, 2, 'CROWN', 'WP3000', '7A300628', 'Activo', 'N/A', 1, 'Área de Recepción (Almacén II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(76, 'MC0008', 'Montacargas Eléctrico', 0, 2, 'CROWN', 'RMD6000S', '1A569399', 'Activo', 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(77, 'MH0007', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02429', 'Activo', 'N/A', 1, 'Almacén Carga Pesada A (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(78, 'MH0008', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02430', 'Activo', 'N/A', 1, 'Almacén Carga Pesada A (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(79, 'MH0009', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02433', 'Activo', 'N/A', 1, 'Área de Picking (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(80, 'MH0010', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02428', 'Activo', 'N/A', 1, 'Área de Picking (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(81, 'MH0011', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02435', 'Activo', 'N/A', 1, 'Almacén Carga Pesada B (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(82, 'MH0012', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02431', 'Activo', 'N/A', 1, 'Almacén Carga Pesada B (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(83, 'MH0013', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02432', 'Activo', 'N/A', 1, 'Almacén Carga Pesada B (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(84, 'MH0014', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02434', 'Activo', 'N/A', 1, 'Almacén Carga Pesada B (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(85, 'MH0015', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA12F1K0RG000000300EABA00PA000U0060', 'K13A02426', 'Activo', 'N/A', 1, 'Área de Recepción (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(86, 'MH0016', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAD12F1K0RG000000EACA00PA000000G0', 'K13A02427', 'Activo', 'N/A', 1, 'Área de Preparación y Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(87, 'MH0017', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAD12F1K0RG000000300EACA00PA000U0060', 'K13A02425', 'Activo', 'N/A', 1, 'Área de Preparación y Despacho (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(88, 'MH0018', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAD12F1K0RG000000300EACA00PA000U0060', 'K13A02424', 'Activo', 'N/A', 1, 'Área de Oficinas (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(89, 'MH0019', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA10F1K0RG000000300DACA00PA000U0060', 'K13A02437', 'Activo', 'N/A', 1, 'Área de Cafetería (Almacén I)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(90, 'MH0020', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA10F1K0RG000000300DACA00PA000U0060', '74Y161AG', 'Activo', 'N/A', 1, 'Devoluciones (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(91, 'MH0022', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'UCCAG14C0A0RL032000000EC859B00000000', 'K17D31292', 'Activo', 'N/A', 1, 'Carga Pesada (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(92, 'MH0023', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'UCCAG14C0A0RL032000000EC859B00000000', 'K17D31290', 'Activo', 'N/A', 1, 'Devoluciones (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(93, 'MH0024', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'UCCAG14C0A0RL032000000EC859B00000000', 'K17D31291', 'Activo', 'N/A', 1, 'Carga Pesada (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(94, 'MH0025', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'UCCAG14C0A0RL032000000EC859B00000000', 'K17D31293', 'Activo', 'N/A', 1, 'Devoluciones (Almacen II)', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(95, 'NE0008', 'Nevera Dispensadora de Agua ', 0, 2, 'AMERICAN', 'BE-66', 'N/A', 'Activo', 'N/A', 1, 'Área de Recepción', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(96, 'NE0018', 'Congelador Horizontal No.2', 0, 2, 'Frigidaire', 'GLFC1526FW9', 'WB14548780', 'Activo', 'N/A', 1, 'Área de Preparación y Despacho', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(97, 'NE0019', 'Congelador Horizontal No.1', 0, 2, 'Frigidaire', 'FGCH25M8LW1', 'WB41155383', 'Activo', 'N/A', 1, 'Área de Preparación y Despacho', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(98, 'NE0020', 'Congelador Horizontal No.3', 0, 2, 'Electrolux', 'FFFC22M6QWE', 'WB72050658', 'Activo', 'N/A', 1, 'Área de Preparación y Despacho', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System'),
(99, 'NE0021', 'Congelador Horizontal No.4', 0, 2, 'Frigidaire', 'FFFC20M4TW', 'AA20350008', 'Activo', 'N/A', 1, 'Área de Preparación y Despacho', NULL, NULL, NULL, NULL, '2023-06-29 17:30:54', 'System');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_actividad`
--

CREATE TABLE `equipos_actividad` (
  `id` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `create_by` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(100) NOT NULL,
  `modify_by` varchar(100) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 'Super_admin', '2023-06-18 17:37:23', '0', NULL, NULL, NULL, NULL),
(8, 'Administrator', '2023-06-18 22:29:15', '1', NULL, NULL, NULL, NULL),
(9, 'Tecnicos', '2023-06-18 22:29:54', '1', NULL, NULL, NULL, NULL),
(10, 'Supervisor', '2023-06-18 22:30:22', '1', NULL, NULL, NULL, NULL),
(11, '', '2023-06-23 11:26:28', '1', NULL, NULL, NULL, NULL);

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
(1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(3, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(4, 9, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(5, 10, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(6, 11, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0);

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
(1, 'Super_admin', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', '', '', '2023-06-18 20:46:50', 0, '2023-06-18 20:46:50', '0', NULL, NULL, NULL, NULL),
(13, 'Freddypimpns', 'e8ddca27bd7bca532a6bbba4634f449109ee8040', 'Alura Challenges', 'Pereyra', NULL, 8, '0000-00-00 00:00:00', '1', NULL, NULL, NULL, NULL),
(14, 'Freddypimpns@gmail.com', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', 'Alura ', 'Pereyra', NULL, 9, '2023-06-19 22:49:26', '1', NULL, NULL, NULL, NULL),
(15, '40224540423', 'b6cad64f62527c34f77007fe88c6c65c37fcce98', 'Alura Challenges ONE', 'Pereyra', NULL, 8, '2023-06-19 22:51:03', '1', NULL, NULL, NULL, NULL),
(17, 'Claribel', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', 'Claribel Esther', 'Maldonado Villanueva', NULL, 10, '2023-06-20 22:02:18', '1', NULL, NULL, NULL, NULL);

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
-- Indices de la tabla `frecuencia`
--
ALTER TABLE `frecuencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordentrabajodetail`
--
ALTER TABLE `ordentrabajodetail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_OrdenTrabajoHeader` (`id_OrdenTrabajoHeader`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `equipos_actividad`
--
ALTER TABLE `equipos_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `frecuencia`
--
ALTER TABLE `frecuencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ordentrabajodetail`
--
ALTER TABLE `ordentrabajodetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ordentrabajoheader`
--
ALTER TABLE `ordentrabajoheader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programacionmantenimientosheader`
--
ALTER TABLE `programacionmantenimientosheader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rolpermisos`
--
ALTER TABLE `rolpermisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
