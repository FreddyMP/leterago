-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2023 a las 16:50:51
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
(11, 'Revision de cableado', '2023-09-13 04:00:00', '1', NULL, NULL, NULL, NULL);

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
(7, '0001', 'Almacen', 'Super_admin', '2023-09-13 04:54:55', NULL, NULL, NULL, NULL);

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
  `frecuencia` int(1) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `id_almacen` int(11) NOT NULL,
  `ubicacion` text DEFAULT NULL,
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
(505, 'AA0016', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'TGM', 'MWNT245', 'D200298520515901120059', 'Activo', 0, 'N/A', 1, '705', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(506, 'AA0017', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'TGM', 'MUVT24S', '2403149460172210160014', 'Activo', 0, 'N/A', 1, '706', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(507, 'AA0018', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'DAIKIN', 'FTKS18EL216', '3D15970000053', 'Activo', 0, 'N/A', 1, '707', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(508, 'AA0019', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'DAIKIN', 'FTKS18EL216', '', 'Activo', 0, 'N/A', 1, '708', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(509, 'AA0020', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'DAIKIN', 'FTKS18EL216', '3D15970000059', 'Activo', 0, 'N/A', 1, '709', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(510, 'AA0021 ', 'Equipo de Aire  Acondicionado Split Pared ', 0, 2, 'CIAC', 'CH43KX024-H3N1C', '34052525371068307015025 4', 'Activo', 0, 'N/A', 1, '710', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(511, 'AA0022', 'Equipo de Aire Acondicionado Split Pared', 0, 2, 'TGM', 'MWDRTT18S', 'SN3405491690384230151193', 'Activo', 0, 'N/A', 1, '711', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(512, 'AA0023', 'Equipo de Aire Acondicionado Split Pared', 0, 2, 'Air Max', 'AWGCC30-C2', '', 'Activo', 0, 'N/A', 1, '712', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(513, 'BO0005 ', 'Bomba de Recirculación de Agua Helada # I', 0, 2, 'WEG', '020180P3E256JM', '', 'Activo', 0, 'N/A', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(514, 'BO0006 ', 'Bomba de Recirculación de Agua Helada # II', 0, 2, 'WEG', '02018EP3E256JM', '', 'Activo', 0, 'N/A', 1, '714', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(515, 'BO0007 ', 'Bomba de Recirculación de Agua Helada # III', 0, 2, 'WEG', '020180P3E256JM', '', 'Activo', 0, 'N/A', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(516, 'BO0009', 'Bomba de Recirculación de Agua Helada # IV', 0, 2, 'US MOTORS', 'FK32', '107656777-0047M0001', 'Activo', 0, 'N/A', 1, '716', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(517, 'BO0010', 'Bomba de Recirculación de Agua Helada # V', 0, 2, 'US MOTORS', 'FK38', '107656777-0047M0001', 'Activo', 0, 'N/A', 1, '716', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(518, 'CA0001', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 0, 'N/A', 1, '718', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(519, 'CA0002', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 0, 'N/A', 1, '718', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(520, 'CA0003', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 0, 'N/A', 1, '718', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(521, 'CA0004', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 0, 'N/A', 1, '718', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(522, 'CA0005', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 0, 'N/A', 1, '718', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(523, 'CA0006', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 0, 'N/A', 1, '718', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(524, 'CA0007', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 0, 'N/A', 1, '718', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(525, 'CA0008', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 0, 'N/A', 1, '718', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(526, 'CA0009', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1200R', 'N/A', 'Activo', 0, 'N/A', 1, '718', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(527, 'CA0010', 'Cortina de Aire', 0, 2, 'ComfortStart', 'EAC - 1500R', 'N/A', 'Activo', 0, 'N/A', 1, '718', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(528, 'CA0013', 'Cortina de Aire', 0, 2, 'Comfort Star', 'EAC - 1500 R', 'N/A', 'Activo', 0, 'N/A', 1, '728', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(529, 'CA0014', 'Cortina de Aire', 0, 2, 'Comfort Star', 'EAC - 1200 R', 'N/A', 'Activo', 0, 'N/A', 1, '728', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(530, 'CA0017', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A298656', 'Activo', 0, 'Equipo nuevo', 1, '730', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(531, 'CA0018', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A298653', 'Activo', 0, 'Equipo nuevo', 1, '730', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(532, 'CA0019', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A298660', 'Activo', 0, 'Equipo nuevo', 1, '730', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(533, 'CA0020', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A29922B', 'Activo', 0, 'Equipo nuevo', 1, '730', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(534, 'CA0021', 'Cortina de aire', 0, 2, 'SyP', 'CAF36', 'A299234', 'Activo', 3, 'Equipo nuevo', 1, '734', NULL, NULL, '1', '2023-09-13 00:00:00', '2023-09-13 14:17:53', 'System'),
(535, 'CA0022', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR09', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, '735', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(536, 'CA0023', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR10', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, '735', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(537, 'CA0024', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR12', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, '735', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(538, 'CA0025', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR15', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, '735', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(539, 'CA0026', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR18', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, '735', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(540, 'CA0027', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-CCCCR20', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, '735', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(541, 'CA0028', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1215-N2', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, '741', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(542, 'CA0029', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1215-N2', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, '741', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(543, 'CA0030', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1215-N2', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, '741', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(544, 'CA0031', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1209-N2', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, '744', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(545, 'CA0032', 'Cortina de aire', 0, 2, 'Comfort Time', 'FM-1209-N2', 'N/A', 'Activo', 0, 'Equipo nuevo', 1, '744', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(546, 'CF0002', 'Unidad Condensadora Cuarto Frío I', 0, 2, 'Copeland', 'FGAH-A301-TFC-020', '10H20890U', 'Activo', 0, 'N/A', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(547, 'CF0003', 'Evaporador I Cuarto Frío II', 0, 2, 'HEATCRAFT', 'LHT030X6CFM', 'T14D01777', 'Activo', 0, 'N/A', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(548, 'CF0004', 'Evaporador II Cuarto Frío II', 0, 2, 'HEATCRAFT', 'LHT030X6CFM', 'T14F02765', 'Activo', 0, 'N/A', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(549, 'CF0005', 'Evaporador Pre-Cámara', 0, 2, 'HEATCRAFT', 'LHT030X6CFM', 'T14F02761', 'Activo', 0, 'N/A', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(550, 'CF0006', 'Condensador I Cuarto Frío II', 0, 2, 'HEATCRAFT', 'LHT030X60CFM', 'T14DO1777', 'Activo', 0, 'N/A', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(551, 'CF0007', 'Condensador II Cuarto Frío II', 0, 2, 'HEATCRAFT', 'LHT030X60CFM', '14F02765', 'Activo', 0, 'N/A', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(552, 'CF0008', 'Condensador I Cuarto Frío I', 0, 2, 'DANFOSS', 'HJZ036D32Q', '0103654AV0417', 'Activo', 0, 'N/A', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(553, 'CH0001', 'Chiller I', 0, 2, 'TRANE', 'RTAC 1554 UX0H UAFN N1TY 1CDB NN6T NI0N N0EX N', 'U13B05652', 'Activo', 0, 'N/A', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(554, 'CH0002', 'Chiller II', 0, 2, 'TRANE', 'RTAC 1554 UX0H UAFN N1TY 1CDB NN6T NI0N N0EX N', 'U13B05651', 'Activo', 0, 'N/A', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(555, 'CH0003', 'Chiller III', 0, 2, 'TRANE', 'CGAM 052F 2Q03 AXB2 A1A1 A1AX 1AXX XXXX XA1A 3X1D 1XXL XX', 'U17E61969', 'Activo', 0, 'N/A', 1, '716', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(556, 'CH0004', 'Chiller IV', 0, 2, 'TRANE', 'CGAM 052F 2Q03 AXB2 A1A1 A1AX 1AXX XXXX XA1A 3X1D 1XXL XX', 'U19E61968', 'Activo', 0, 'N/A', 1, '716', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(557, 'EL0001', 'Máquina Fregadora de Pisos Tenant', 0, 2, 'TENNANT', 'M 5400', '5400-10301133', 'Activo', 0, 'N/A', 1, '757', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(558, 'EL0002', 'Máquina Aspiradora Seco y Húmedo Tenant', 0, 2, 'TENNANT 3500', '', '', 'Activo', 0, 'N/A', 1, '757', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(559, 'EL0006', 'Máquina Fregadora de Pisos Tenant', 0, 2, 'TENNANT', '', '5400-10301133', 'Activo', 0, 'N/A', 1, '759', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(560, 'GE0001', 'Generador Eléctrico', 0, 2, 'SDMO', 'JS275UC', 'JS275UC04013368', 'Activo', 0, 'N/A', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(561, 'GE0002', 'Generador Eléctrico', 0, 2, 'SDMO', 'J275UC', 'J275UC06020720', 'Activo', 0, 'N/A', 1, '716', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(562, 'GE0003', 'Generador Eléctrico', 0, 2, 'SDMO', 'TAD1344GE', '', 'Activo', 0, 'Nuevo', 1, '713', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(563, 'GE0004', 'Generador Eléctrico', 0, 2, 'CUMMINS', 'N/A', '', 'Activo', 0, 'N/A', 1, '763', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(564, 'IV0001', 'INVERSOR', 0, 2, 'TRACE', 'APC-1012', 'BB44010069', 'Activo', 0, 'Nuevo', 1, '764', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(565, 'IV0011', 'INVERSOR DE PANELES SOLARES', 0, 2, 'Solis', 'Solis-75K-5G-US', '', 'Activo', 0, 'Nuevo', 1, '765', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(566, 'IV0012', 'INVERSOR DE PANELES SOLARES', 0, 2, 'Solis', 'Solis-75K-5G-US', '', 'Activo', 0, 'Nuevo', 1, '765', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(567, 'IV0013', 'INVERSOR DE PANELES SOLARES', 0, 2, 'Solis', 'Solis-75K-5G-US', '', 'Activo', 0, 'Nuevo', 1, '765', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(568, 'UP0001', 'UPS', 0, 2, 'APC', 'SUA3000', 'AS1507234167', 'Activo', 0, 'Nuevo', 1, '765', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(569, 'UP0002', 'UPS', 0, 2, 'APC', 'N/A', 'N/A', 'Activo', 0, 'N/A', 1, '769', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(570, 'UP0003', 'UPS', 0, 2, 'APC', 'N/A', 'SYAF16KT', 'Activo', 0, 'N/A', 1, '770', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(571, 'UP0004', 'UPS', 0, 2, 'Ablerex', 'AB-TRBATV34-40', '', 'Activo', 0, 'Nuevo', 1, '771', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(572, 'UP0005', 'UPS', 0, 2, 'Ablerex', 'AB-TRBATV34-41', '', 'Activo', 0, 'Nuevo', 1, '771', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(573, 'MC0001', 'Montacargas Eléctrico', 0, 2, 'CROWN', 'RR-5225-30', '1A296094', 'Activo', 0, 'N/A', 1, '728', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(574, 'MC0002', 'Montacargas Eléctrico', 0, 2, 'CROWN', 'RD-5225-30', '1A312626', 'Activo', 0, 'N/A', 1, '728', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(575, 'MC0003', 'Stockpicker', 0, 2, 'CROWN', 'SP3520', '1A419962', 'Activo', 0, 'N/A', 1, '728', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(576, 'MC0004', 'Palet Eléctrico', 0, 2, 'CROWN', 'WP2335-45', '5A339602', 'Activo', 0, 'N/A', 1, '728', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(577, 'MC0005', 'Palet Eléctrico', 0, 2, 'CROWN', 'WP2335-45', '5A339603', 'Activo', 0, 'N/A', 1, '728', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(578, 'MC0006', 'Stockpicker', 0, 2, 'CROWN', 'SP3500', '1A467957', 'Activo', 0, 'N/A', 1, '728', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(579, 'MC0007', 'Palet Eléctrico', 0, 2, 'CROWN', 'WP3000', '7A300628', 'Activo', 0, 'N/A', 1, '779', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(580, 'MC0008', 'Montacargas Eléctrico', 0, 2, 'CROWN', 'RMD6000S', '1A569399', 'Activo', 0, 'N/A', 1, '728', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(581, 'MH0007', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02429', 'Activo', 0, 'N/A', 1, '781', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(582, 'MH0008', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02430', 'Activo', 0, 'N/A', 1, '781', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(583, 'MH0009', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02433', 'Activo', 0, 'N/A', 1, '783', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(584, 'MH0010', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02428', 'Activo', 0, 'N/A', 1, '783', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(585, 'MH0011', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02435', 'Activo', 0, 'N/A', 1, '785', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(586, 'MH0012', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02431', 'Activo', 0, 'N/A', 1, '785', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(587, 'MH0013', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02432', 'Activo', 0, 'N/A', 1, '785', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(588, 'MH0014', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA30F1K0EG0000003004BFA00PA000Y0060', 'K13A02434', 'Activo', 0, 'N/A', 1, '785', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(589, 'MH0015', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA12F1K0RG000000300EABA00PA000U0060', 'K13A02426', 'Activo', 0, 'N/A', 1, '728', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(590, 'MH0016', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAD12F1K0RG000000EACA00PA000000G0', 'K13A02427', 'Activo', 0, 'N/A', 1, '790', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(591, 'MH0017', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAD12F1K0RG000000300EACA00PA000U0060', 'K13A02425', 'Activo', 0, 'N/A', 1, '790', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(592, 'MH0018', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAD12F1K0RG000000300EACA00PA000U0060', 'K13A02424', 'Activo', 0, 'N/A', 1, '792', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(593, 'MH0019', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA10F1K0RG000000300DACA00PA000U0060', 'K13A02437', 'Activo', 0, 'N/A', 1, '793', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(594, 'MH0020', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'LPCAA10F1K0RG000000300DACA00PA000U0060', '74Y161AG', 'Activo', 0, 'N/A', 1, '744', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(595, 'MH0022', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'UCCAG14C0A0RL032000000EC859B00000000', 'K17D31292', 'Activo', 0, 'N/A', 1, '795', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(596, 'MH0023', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'UCCAG14C0A0RL032000000EC859B00000000', 'K17D31290', 'Activo', 0, 'N/A', 1, '744', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(597, 'MH0024', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'UCCAG14C0A0RL032000000EC859B00000000', 'K17D31291', 'Activo', 0, 'N/A', 1, '795', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(598, 'MH0025', 'Manejadora de Agua Helada', 0, 2, 'TRANE', 'UCCAG14C0A0RL032000000EC859B00000000', 'K17D31293', 'Activo', 0, 'N/A', 1, '744', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(599, 'NE0008', 'Nevera Dispensadora de Agua ', 0, 2, 'AMERICAN', 'BE-66', 'N/A', 'Activo', 0, 'N/A', 1, '799', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(600, 'NE0018', 'Congelador Horizontal No.2', 0, 2, 'Frigidaire', 'GLFC1526FW9', 'WB14548780', 'Activo', 0, 'N/A', 1, '800', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(601, 'NE0019', 'Congelador Horizontal No.1', 0, 2, 'Frigidaire', 'FGCH25M8LW1', 'WB41155383', 'Activo', 0, 'N/A', 1, '800', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(602, 'NE0020', 'Congelador Horizontal No.3', 0, 2, 'Electrolux', 'FFFC22M6QWE', 'WB72050658', 'Activo', 0, 'N/A', 1, '800', NULL, NULL, NULL, NULL, '2023-09-13 14:17:53', 'System'),
(603, 'NE0021', 'Congelador Horizontal No.4', 0, 2, 'Frigidaire', 'FFFC20M4TW', 'AA20350008', 'Activo', 3, 'N/A', 1, '800', NULL, NULL, '1', '2023-09-13 00:00:00', '2023-09-13 14:17:53', 'System');

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
(39, 11, 534, '1', '2023-09-13 10:34:39', NULL, NULL, NULL, NULL),
(40, 11, 603, '1', '2023-09-13 10:49:27', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas_ejecucion`
--

CREATE TABLE `fechas_ejecucion` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `equipo` int(10) NOT NULL,
  `realizado` int(1) DEFAULT 0,
  `id_programa` int(10) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(50) NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modify_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fechas_ejecucion`
--

INSERT INTO `fechas_ejecucion` (`id`, `fecha`, `equipo`, `realizado`, `id_programa`, `create_date`, `create_by`, `modify_date`, `modify_by`) VALUES
(201, '2023-08-16', 603, 0, 0, '2023-09-13 10:31:10', '1', NULL, NULL),
(202, '2023-09-13', 603, 0, 0, '2023-09-13 10:31:10', '1', NULL, NULL),
(203, '2023-09-15', 603, 0, 0, '2023-09-13 10:31:10', '1', NULL, NULL),
(204, '2023-09-30', 603, 0, 0, '2023-09-13 10:31:10', '1', NULL, NULL),
(205, '2023-09-01', 534, 1, 0, '2023-09-13 10:37:55', '1', NULL, NULL),
(206, '2023-09-13', 534, 0, 0, '2023-09-13 10:37:55', '1', NULL, NULL),
(207, '2023-09-22', 534, 0, 0, '2023-09-13 10:37:55', '1', NULL, NULL),
(208, '2023-10-26', 534, 0, 0, '2023-09-13 10:37:55', '1', NULL, NULL);

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
  `fecha` date NOT NULL,
  `date_planification` date DEFAULT NULL,
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

INSERT INTO `mantenimientos` (`id`, `documento_no`, `version`, `documento_relacionado`, `codigo`, `fecha`, `date_planification`, `ubicacion`, `equipo`, `observaciones`, `razon_tardanza`, `codigo_temp`, `create_by`) VALUES
(39, 'FOR-12', '1', 'FOR-11.0', 'CA0021', '2023-09-13', '2023-09-01', 705, 534, 'Ninguna', 'Ninguna', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos_details`
--

CREATE TABLE `mantenimientos_details` (
  `id` int(11) NOT NULL,
  `id_actividad` int(6) NOT NULL,
  `id_mantenimiento` int(6) NOT NULL,
  `ok` int(1) NOT NULL,
  `no_aplica` int(1) NOT NULL,
  `r` int(1) NOT NULL,
  `observacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mantenimientos_details`
--

INSERT INTO `mantenimientos_details` (`id`, `id_actividad`, `id_mantenimiento`, `ok`, `no_aplica`, `r`, `observacion`) VALUES
(26, 11, 39, 1, 0, 0, 'No hay observaciones');

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
  `documentoNum` varchar(50) DEFAULT NULL,
  `version` int(3) DEFAULT NULL,
  `documentoRelacionado` varchar(50) DEFAULT NULL,
  `orderNum` varchar(50) NOT NULL,
  `documento` varchar(150) DEFAULT NULL,
  `documento_original` varchar(150) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(10) DEFAULT NULL,
  `solicitadoPor` varchar(100) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `nivelPrioridad` varchar(3) NOT NULL,
  `areaOEquipo` varchar(100) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
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

INSERT INTO `ordentrabajoheader` (`id`, `documentoNum`, `version`, `documentoRelacionado`, `orderNum`, `documento`, `documento_original`, `fecha`, `hora`, `solicitadoPor`, `departamento`, `nivelPrioridad`, `areaOEquipo`, `codigo`, `ubicacion`, `descripcion`, `nota`, `create_date`, `create_by`, `modify_by`, `modify_date`, `delete_date`, `delete_by`) VALUES
(39, NULL, NULL, NULL, 'Test', 'documento0.pdf', 'Freddy Miguel Pereyra Peña.pdf', '2023-09-13', NULL, 'Freddy Pereyra', '', '1', '', NULL, NULL, NULL, NULL, '2023-09-13 14:58:51', '1', NULL, NULL, NULL, NULL);

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
(1697, 19, 506),
(1698, 19, 507),
(1699, 19, 508),
(1700, 19, 509),
(1701, 19, 510),
(1702, 19, 511),
(1703, 19, 512),
(1704, 19, 513),
(1705, 19, 514),
(1706, 19, 515),
(1707, 19, 516),
(1708, 19, 517),
(1709, 19, 518),
(1710, 19, 519),
(1711, 19, 520),
(1712, 19, 521),
(1713, 19, 522),
(1714, 19, 523),
(1715, 19, 524),
(1716, 19, 525),
(1717, 19, 526),
(1718, 19, 527),
(1719, 19, 528),
(1720, 19, 529),
(1721, 19, 530),
(1722, 19, 531),
(1723, 19, 532),
(1724, 19, 533),
(1725, 19, 534),
(1726, 19, 535),
(1727, 19, 536),
(1728, 19, 537),
(1729, 19, 538),
(1730, 19, 539),
(1731, 19, 540),
(1732, 19, 541),
(1733, 19, 542),
(1734, 19, 543),
(1735, 19, 544),
(1736, 19, 545),
(1737, 19, 546),
(1738, 19, 547),
(1739, 19, 548),
(1740, 19, 549),
(1741, 19, 550),
(1742, 19, 551),
(1743, 19, 552),
(1744, 19, 553),
(1745, 19, 554),
(1746, 19, 555),
(1747, 19, 556),
(1748, 19, 557),
(1749, 19, 558),
(1750, 19, 559),
(1751, 19, 560),
(1752, 19, 561),
(1753, 19, 562),
(1754, 19, 563),
(1755, 19, 564),
(1756, 19, 565),
(1757, 19, 566),
(1758, 19, 567),
(1759, 19, 568),
(1760, 19, 569),
(1761, 19, 570),
(1762, 19, 571),
(1763, 19, 572),
(1764, 19, 573),
(1765, 19, 574),
(1766, 19, 575),
(1767, 19, 576),
(1768, 19, 577),
(1769, 19, 578),
(1770, 19, 579),
(1771, 19, 580),
(1772, 19, 581),
(1773, 19, 582),
(1774, 19, 583),
(1775, 19, 584),
(1776, 19, 585),
(1777, 19, 586),
(1778, 19, 587),
(1779, 19, 588),
(1780, 19, 589),
(1781, 19, 590),
(1782, 19, 591),
(1783, 19, 592),
(1784, 19, 593),
(1785, 19, 594),
(1786, 19, 595),
(1787, 19, 596),
(1788, 19, 597),
(1789, 19, 598),
(1790, 19, 599),
(1791, 19, 600),
(1792, 19, 601),
(1793, 19, 602),
(1794, 19, 603);

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
(19, 'RPG-11', 'FOR-11.0', '2023-01-01', '2023-12-31', 'Planificacion 2023', 1, 1, 67114, '2023-09-13 10:24:35', '1', NULL, NULL, NULL, NULL);

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
(1, 'Super_admin', '2023-06-18 17:37:23', '0', NULL, NULL, NULL, NULL);

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
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id` int(11) NOT NULL,
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

INSERT INTO `ubicaciones` (`id`, `description`, `create_by`, `create_date`, `modify_date`, `modify_by`, `delete_by`, `delete_date`) VALUES
(705, 'Área de Servicios - Mantenimiento', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(706, 'Comedor (Almacen II)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(707, 'Área de Cómputos (Almacen II)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(708, 'Garita de Seguridad (Almacen II)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(709, 'Recepcion (Almacen II)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(710, 'Área de Cómputos (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(711, 'Dispensario (Almacen I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(712, 'Garita de Seguridad', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(713, 'Area Externa Almacén (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(714, 'Área de Chiller (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(715, 'Area Externa Almacén (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(716, 'Area Externa (Almacén II) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(717, 'Area Externa (Almacén II) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(718, 'Área de Despacho (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(719, 'Área de Despacho (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(720, 'Área de Despacho (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(721, 'Área de Despacho (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(722, 'Área de Despacho (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(723, 'Área de Despacho (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(724, 'Área de Despacho (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(725, 'Área de Despacho (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(726, 'Área de Despacho (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(727, 'Área de Despacho (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(728, 'Área de Recepción (Almacén I) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(729, 'Área de Recepción (Almacén I) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(730, 'Entrada principal almacen (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(731, 'Entrada principal almacen (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(732, 'Entrada principal almacen (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(733, 'Entrada principal almacen (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(734, 'Devoluciones (Almacén I) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(735, 'Recepcion Carga pesada (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(736, 'Recepcion Carga pesada (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(737, 'Recepcion Carga pesada (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(738, 'Recepcion Carga pesada (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(739, 'Recepcion Carga pesada (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(740, 'Recepcion Carga pesada (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(741, 'Recepcion Carga pesada (Almacén II)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(742, 'Recepcion Carga pesada (Almacén II)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(743, 'Recepcion Carga pesada (Almacén II)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(744, 'Devoluciones (Almacén II) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(745, 'Devoluciones (Almacén II) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(746, 'Area Externa Almacén (Almacén I) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(747, 'Area Externa Almacén (Almacén I) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(748, 'Area Externa Almacén (Almacén I) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(749, 'Area Externa Almacén (Almacén I) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(750, 'Area Externa Almacén (Almacén I) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(751, 'Area Externa Almacén (Almacén I) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(752, 'Area Externa Almacén (Almacén I) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(753, 'Area Externa Almacén (Almacén I) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(754, 'Area Externa Almacén (Almacén I) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(755, 'Area Externa (Almacén II) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(756, 'Area Externa (Almacén II) ', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(757, 'Baño General Almacén (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(758, 'Baño General Almacén (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(759, 'Baño General (Almacén II)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(760, 'Área Externa Almacén (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(761, 'Área Externa (Almacén II)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(762, 'Área Externa Almacén (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(763, 'Oficina gazcue', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(764, 'Área de Cuarto Frío (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(765, 'Cuarto Eléctrico (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(766, 'Cuarto Eléctrico (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(767, 'Cuarto Eléctrico (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(768, 'Cuarto Eléctrico (Almacén I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(769, 'Garita de Seguridad (Almacen I)', '1', '2023-09-13 10:19:02', NULL, NULL, NULL, NULL),
(770, 'Computo Oficina Gazcue', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(771, 'Computo Almacen I', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(772, 'Computo Almacen I', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(773, 'Área de Recepción (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(774, 'Área de Recepción (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(775, 'Área de Recepción (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(776, 'Área de Recepción (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(777, 'Área de Recepción (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(778, 'Área de Recepción (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(779, 'Área de Recepción (Almacén II)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(780, 'Área de Recepción (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(781, 'Almacén Carga Pesada A (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(782, 'Almacén Carga Pesada A (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(783, 'Área de Picking (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(784, 'Área de Picking (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(785, 'Almacén Carga Pesada B (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(786, 'Almacén Carga Pesada B (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(787, 'Almacén Carga Pesada B (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(788, 'Almacén Carga Pesada B (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(789, 'Área de Recepción (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(790, 'Área de Preparación y Despacho (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(791, 'Área de Preparación y Despacho (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(792, 'Área de Oficinas (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(793, 'Área de Cafetería (Almacén I)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(794, 'Devoluciones (Almacen II)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(795, 'Carga Pesada (Almacen II)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(796, 'Devoluciones (Almacen II)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(797, 'Carga Pesada (Almacen II)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(798, 'Devoluciones (Almacen II)', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(799, 'Área de Recepción', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(800, 'Área de Preparación y Despacho', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(801, 'Área de Preparación y Despacho', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(802, 'Área de Preparación y Despacho', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL),
(803, 'Área de Preparación y Despacho', '1', '2023-09-13 10:19:03', NULL, NULL, NULL, NULL);

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
(1, 'Super_admin', 'cd9d379715cccc83fd8c8c2dc0730c6dd081bd35', 'Developer', 'Fullstack', '2023-06-18 20:46:50', 1, '2023-06-18 20:46:50', '0', NULL, NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=604;

--
-- AUTO_INCREMENT de la tabla `equipos_actividad`
--
ALTER TABLE `equipos_actividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `fechas_ejecucion`
--
ALTER TABLE `fechas_ejecucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT de la tabla `frecuencia`
--
ALTER TABLE `frecuencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `mantenimientos_details`
--
ALTER TABLE `mantenimientos_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `ordentrabajodetail`
--
ALTER TABLE `ordentrabajodetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ordentrabajoheader`
--
ALTER TABLE `ordentrabajoheader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `programacionmantenimientosheader`
--
ALTER TABLE `programacionmantenimientosheader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programadetails`
--
ALTER TABLE `programadetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1795;

--
-- AUTO_INCREMENT de la tabla `programaheader`
--
ALTER TABLE `programaheader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=804;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
