-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-06-2015 a las 08:37:39
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `procesos_iep`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estudiantes`
--

CREATE TABLE IF NOT EXISTS `tbl_estudiantes` (
`es_id` int(11) NOT NULL,
  `es_nombre` varchar(90) NOT NULL,
  `es_codigo` int(10) NOT NULL,
  `es_plan` int(5) NOT NULL,
  `es_registrado_por` int(10) NOT NULL,
  `es_fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `es_estado` int(2) NOT NULL,
  `es_us_id` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_estudiantes`
--

INSERT INTO `tbl_estudiantes` (`es_id`, `es_nombre`, `es_codigo`, `es_plan`, `es_registrado_por`, `es_fecha_registro`, `es_estado`, `es_us_id`) VALUES
(6, 'usuario uno', 123456, 1234, 1, '2015-01-23 22:22:49', 1, ''),
(7, 'usuario dos', 123457, 1235, 1, '2015-01-23 22:23:34', 1, ''),
(8, 'usuario tres', 123458, 1236, 1, '2015-01-23 22:23:58', 1, ''),
(9, 'usuario cuatro', 123459, 1237, 1, '2015-01-24 05:57:24', 1, ''),
(10, 'usuario cinco', 123460, 1238, 1, '2015-01-24 05:58:37', 1, ''),
(11, 'usuario seis', 123461, 1239, 1, '2015-01-24 06:00:25', 1, ''),
(12, 'usuario siete', 123462, 1240, 1, '2015-01-24 06:02:30', 1, ''),
(13, 'usuario ocho', 123463, 1241, 1, '2015-01-24 06:06:01', 1, ''),
(14, 'usuario nueve', 123464, 1242, 1, '2015-01-24 06:07:56', 1, ''),
(15, 'usuario diez', 123465, 1243, 1, '2015-01-27 06:12:04', 1, ''),
(16, 'usuario once', 123466, 1244, 1, '2015-01-27 06:51:22', 1, ''),
(21, 'usuario once', 123470, 3743, 1, '2015-05-08 22:20:41', 1, ''),
(22, 'usuario doce', 123471, 3743, 1, '2015-05-08 22:22:46', 1, ''),
(23, 'usuario trece', 123472, 3743, 1, '2015-05-08 22:45:14', 1, ''),
(24, 'usuario seis siete', 123467, 1234, 1, '2015-06-01 17:01:45', 1, ''),
(25, 'usuario seis ocho', 123468, 1234, 1, '2015-06-01 17:03:38', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_flujo_estudiantes`
--

CREATE TABLE IF NOT EXISTS `tbl_flujo_estudiantes` (
`fe_id` int(11) NOT NULL,
  `fe_es_codigo` int(10) NOT NULL,
  `fe_sala` int(11) NOT NULL,
  `fe_pc` int(11) NOT NULL,
  `fe_hora_entrada` time NOT NULL,
  `fe_hora_salida` time DEFAULT NULL,
  `fe_log_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_monitor` int(11) NOT NULL,
  `fe_estado` int(2) NOT NULL COMMENT '[1:en sala] [2:fuera de sala]',
  `fe_id_del` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_flujo_estudiantes`
--

INSERT INTO `tbl_flujo_estudiantes` (`fe_id`, `fe_es_codigo`, `fe_sala`, `fe_pc`, `fe_hora_entrada`, `fe_hora_salida`, `fe_log_fecha`, `fe_monitor`, `fe_estado`, `fe_id_del`) VALUES
(5, 123456, 1, 1, '23:24:35', '20:11:23', '2015-01-29 22:24:36', 1, 2, ''),
(6, 123457, 1, 2, '23:25:04', '21:22:39', '2015-01-28 22:25:05', 1, 2, ''),
(7, 123458, 1, 1, '23:25:45', '20:11:34', '2015-01-28 22:25:46', 1, 2, ''),
(8, 123466, 1, 11, '07:51:56', '07:52:05', '2015-01-27 06:51:57', 1, 99, ''),
(9, 123456, 1, 2, '23:25:04', '21:22:48', '2015-01-31 08:18:24', 1, 2, ''),
(10, 123456, 1, 2, '23:25:04', '21:23:04', '2015-01-31 08:19:03', 1, 2, ''),
(11, 123456, 1, 2, '23:25:04', '21:23:13', '2015-01-31 08:19:03', 1, 2, ''),
(12, 123456, 1, 2, '23:25:04', '21:26:20', '2015-01-31 08:19:03', 1, 2, ''),
(13, 123456, 2, 2, '23:25:04', NULL, '2015-01-31 08:19:03', 1, 99, ''),
(14, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:03', 1, 99, ''),
(15, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:03', 1, 99, ''),
(16, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:03', 1, 99, ''),
(17, 123456, 1, 2, '23:25:04', '18:44:07', '2015-01-31 08:19:03', 1, 2, ''),
(18, 123456, 1, 2, '23:25:04', '18:45:01', '2015-01-31 08:19:03', 1, 2, ''),
(19, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:03', 1, 99, ''),
(20, 123456, 2, 2, '23:25:04', NULL, '2015-01-31 08:19:03', 1, 99, ''),
(21, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:03', 1, 99, ''),
(22, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:03', 1, 99, ''),
(23, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:03', 1, 99, ''),
(24, 123456, 2, 2, '23:25:04', NULL, '2015-01-31 08:19:03', 1, 99, ''),
(25, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:07', 1, 99, ''),
(26, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:07', 1, 99, ''),
(27, 123456, 1, 2, '23:25:04', '21:54:18', '2015-01-31 08:19:07', 1, 2, ''),
(28, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:07', 1, 99, ''),
(29, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:07', 1, 99, ''),
(30, 123456, 2, 2, '23:25:04', NULL, '2015-01-27 08:19:07', 1, 99, ''),
(31, 123456, 1, 2, '23:25:04', NULL, '2015-01-27 08:19:07', 1, 99, ''),
(32, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:07', 1, 99, ''),
(33, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:07', 1, 99, ''),
(34, 123456, 3, 2, '23:25:04', NULL, '2015-01-28 08:19:07', 1, 99, ''),
(35, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:07', 1, 99, ''),
(36, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:07', 1, 99, ''),
(37, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:07', 1, 99, ''),
(38, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:07', 1, 99, ''),
(39, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:07', 1, 99, ''),
(40, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:07', 1, 99, ''),
(41, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:16', 1, 99, ''),
(42, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:16', 1, 99, ''),
(43, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:16', 1, 99, ''),
(44, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:16', 1, 99, ''),
(45, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:16', 1, 99, ''),
(46, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:16', 1, 99, ''),
(47, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:31', 1, 99, ''),
(48, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:19:43', 1, 99, ''),
(49, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:20:02', 1, 99, ''),
(50, 123456, 1, 2, '23:25:04', '23:49:22', '2015-01-31 08:20:02', 1, 99, ''),
(51, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:20:08', 1, 99, ''),
(52, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:20:08', 1, 99, ''),
(53, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:20:08', 1, 99, ''),
(54, 123456, 1, 2, '23:25:04', NULL, '2015-01-31 08:20:08', 1, 99, ''),
(55, 123456, 1, 2, '23:25:04', NULL, '2015-01-27 06:51:57', 1, 99, ''),
(56, 123456, 1, 2, '23:25:04', NULL, '2015-01-27 06:51:57', 1, 99, ''),
(57, 123456, 1, 2, '23:25:04', NULL, '2015-01-27 06:51:57', 1, 99, ''),
(58, 123456, 1, 2, '23:25:04', NULL, '2015-01-27 06:51:57', 1, 99, ''),
(59, 123456, 1, 2, '23:25:04', NULL, '2015-01-27 06:51:57', 1, 99, ''),
(60, 123460, 1, 1, '00:08:25', NULL, '2015-05-08 22:08:25', 1, 99, ''),
(61, 123459, 1, 12, '17:06:31', NULL, '2015-05-12 15:06:31', 1, 99, ''),
(62, 123460, 1, 5, '17:21:51', NULL, '2015-05-12 15:21:51', 1, 99, ''),
(63, 123459, 1, 4, '17:23:56', NULL, '2015-05-12 15:23:56', 1, 99, ''),
(64, 123459, 1, 10, '17:26:10', NULL, '2015-05-12 15:26:10', 1, 99, ''),
(65, 123456, 1, 12, '17:26:27', NULL, '2015-05-12 15:26:27', 1, 99, ''),
(66, 123458, 1, 13, '17:34:40', NULL, '2015-05-12 15:34:40', 1, 99, ''),
(67, 123456, 1, 1, '17:44:53', NULL, '2015-05-12 15:44:53', 1, 99, ''),
(68, 123457, 1, 2, '17:45:01', NULL, '2015-05-12 15:45:01', 1, 99, ''),
(69, 123460, 1, 1, '23:21:20', '23:21:34', '2015-05-25 21:21:20', 1, 99, ''),
(70, 123460, 1, 5, '23:23:45', NULL, '2015-05-25 21:23:45', 1, 99, ''),
(71, 123465, 2, 3, '23:24:25', NULL, '2015-05-25 21:24:25', 1, 99, ''),
(72, 123459, 1, 3, '23:27:30', NULL, '2015-05-25 21:27:30', 1, 99, ''),
(73, 123459, 1, 2, '23:28:41', NULL, '2015-05-25 21:28:41', 1, 99, ''),
(74, 123460, 1, 2, '23:29:47', NULL, '2015-05-25 21:29:47', 1, 99, ''),
(75, 123460, 1, 1, '23:44:27', NULL, '2015-05-25 21:44:27', 1, 99, ''),
(76, 123460, 1, 5, '23:50:43', NULL, '2015-05-25 21:50:43', 1, 99, ''),
(77, 123460, 1, 3, '22:16:55', NULL, '2015-05-27 20:16:55', 1, 99, ''),
(78, 123460, 1, 1, '22:18:31', NULL, '2015-05-27 20:18:31', 1, 99, ''),
(79, 123460, 1, 2, '22:21:42', NULL, '2015-05-27 20:21:42', 1, 99, ''),
(80, 123459, 1, 5, '22:24:03', NULL, '2015-05-27 20:24:03', 1, 99, ''),
(81, 123460, 1, 2, '22:25:35', NULL, '2015-05-27 20:25:35', 1, 99, ''),
(82, 123459, 1, 3, '22:25:52', NULL, '2015-05-27 20:25:52', 1, 99, ''),
(83, 123458, 1, 2, '22:26:22', NULL, '2015-05-27 20:26:22', 1, 99, ''),
(84, 123457, 2, 2, '22:27:19', NULL, '2015-05-27 20:27:19', 1, 99, ''),
(85, 123456, 3, 3, '22:27:32', NULL, '2015-05-27 20:27:32', 1, 99, ''),
(86, 123460, 1, 11, '23:26:30', NULL, '2015-05-27 21:26:30', 1, 99, ''),
(87, 123456, 1, 11, '23:28:30', NULL, '2015-05-27 21:28:30', 1, 99, ''),
(88, 123460, 1, 12, '23:28:41', NULL, '2015-05-27 21:28:41', 1, 99, ''),
(89, 123457, 1, 1, '23:29:09', NULL, '2015-05-27 21:29:09', 1, 99, ''),
(90, 123457, 1, 4, '23:30:02', NULL, '2015-05-27 21:30:02', 1, 99, ''),
(91, 123460, 3, 3, '23:30:29', NULL, '2015-05-27 21:30:29', 1, 99, ''),
(92, 123460, 1, 1, '23:53:40', NULL, '2015-05-27 21:53:40', 1, 99, ''),
(93, 123459, 1, 1, '23:54:06', NULL, '2015-05-27 21:54:06', 1, 99, ''),
(94, 123457, 1, 1, '23:56:51', NULL, '2015-05-27 21:56:51', 1, 99, ''),
(95, 123458, 1, 1, '23:57:14', NULL, '2015-05-27 21:57:14', 1, 99, ''),
(96, 123456, 1, 1, '19:04:16', '19:04:26', '2015-06-01 17:04:16', 1, 2, ''),
(97, 123456, 1, 1, '19:06:01', '19:06:33', '2015-06-01 17:06:01', 1, 2, ''),
(98, 123465, 1, 2, '19:06:21', '19:06:28', '2015-06-01 17:06:21', 1, 2, ''),
(99, 123456, 1, 12, '19:06:45', NULL, '2015-06-01 17:06:45', 1, 99, ''),
(100, 123466, 2, 1, '19:07:02', '19:07:26', '2015-06-01 17:07:02', 1, 2, ''),
(101, 123465, 2, 2, '19:07:20', '19:07:28', '2015-06-01 17:07:20', 1, 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_observaciones`
--

CREATE TABLE IF NOT EXISTS `tbl_observaciones` (
`ob_id` int(11) NOT NULL,
  `ob_us_id` int(2) NOT NULL COMMENT 'monitor',
  `ob_sala` int(4) NOT NULL,
  `ob_pc` int(4) NOT NULL,
  `ob_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ob_observacion` text NOT NULL,
  `ob_estado` int(2) NOT NULL,
  `ob_id_del` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_observaciones`
--

INSERT INTO `tbl_observaciones` (`ob_id`, `ob_us_id`, `ob_sala`, `ob_pc`, `ob_fecha`, `ob_observacion`, `ob_estado`, `ob_id_del`) VALUES
(1, 1, 1, 1, '2015-01-27 08:42:21', '1', 99, ''),
(2, 1, 2, 15, '2015-01-27 17:31:51', 'le falta mouse', 2, ''),
(3, 1, 3, 14, '2015-01-27 18:07:20', 'Ventilador con aspas del ventilador partidas', 2, ''),
(4, 1, 3, 13, '2015-01-27 18:21:29', 'Falta forro de mouse', 99, ''),
(5, 1, 1, 15, '2015-01-27 18:22:03', 'Equipo lento', 2, ''),
(6, 1, 2, 5, '2015-06-01 17:09:49', 'Fallo en arranque', 99, ''),
(7, 1, 1, 1, '2015-06-01 17:10:22', 'asda', 2, ''),
(8, 1, 3, 5, '2015-06-01 17:11:45', 'asdasdasd', 99, ''),
(9, 1, 3, 1, '2015-06-01 17:12:32', '213123123', 99, ''),
(10, 1, 2, 1312, '2015-06-01 17:13:07', '123123123', 2, ''),
(11, 1, 2, 1, '2015-06-01 17:13:31', '123123', 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reservas`
--

CREATE TABLE IF NOT EXISTS `tbl_reservas` (
`re_id` int(15) NOT NULL,
  `re_tipo_sol` int(2) NOT NULL,
  `re_nombre` varchar(100) NOT NULL,
  `re_cargo` varchar(100) NOT NULL,
  `re_tid` int(2) NOT NULL,
  `re_nid` int(30) NOT NULL,
  `re_edificio` int(6) NOT NULL,
  `re_oficina` int(6) NOT NULL,
  `re_tel` int(10) NOT NULL,
  `re_ext` int(6) NOT NULL,
  `re_email` varchar(50) NOT NULL,
  `re_fecha_reserva` date NOT NULL,
  `re_edificio_reserva` int(6) NOT NULL,
  `re_salon_reserva` int(6) NOT NULL,
  `re_desde` varchar(10) NOT NULL,
  `re_hasta` varchar(10) NOT NULL,
  `re_log_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `re_estado` int(2) NOT NULL,
  `re_id_del` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='Tabla de reservas de salones y sala de sistemas ';

--
-- Volcado de datos para la tabla `tbl_reservas`
--

INSERT INTO `tbl_reservas` (`re_id`, `re_tipo_sol`, `re_nombre`, `re_cargo`, `re_tid`, `re_nid`, `re_edificio`, `re_oficina`, `re_tel`, `re_ext`, `re_email`, `re_fecha_reserva`, `re_edificio_reserva`, `re_salon_reserva`, `re_desde`, `re_hasta`, `re_log_fecha`, `re_estado`, `re_id_del`) VALUES
(13, 1, 'Jhon Avila', 'Docente', 1, 12312312, 1231, 123123, 12123, 123, 'jhon.avila@correounivalle.edu.co', '2015-05-20', 388, 1014, '2:04 PM', '3:04 PM', '2015-05-20 19:12:52', 1, ''),
(14, 2, 'Jhon Avila', 'Docente', 1, 12312312, 1231, 123123, 12123, 123, 'jhon.avila@correounivalle.edu.co', '2015-05-20', 381, 2017, '2:04 PM', '3:04 PM', '2015-05-20 19:13:25', 1, ''),
(15, 2, 'Jhon Avila', 'Docente', 1, 12312312, 1231, 123123, 12123, 123, 'jhon.avila@correounivalle.edu.co', '2015-05-20', 388, 1013, '2:04 PM', '3:04 PM', '2015-05-20 19:24:32', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_servicios`
--

CREATE TABLE IF NOT EXISTS `tbl_servicios` (
`se_id` int(15) NOT NULL,
  `se_tipo_sol` int(2) NOT NULL,
  `se_nombre` varchar(100) NOT NULL,
  `se_cargo` varchar(50) NOT NULL,
  `se_tid` int(2) NOT NULL,
  `se_nid` int(30) NOT NULL,
  `se_edificio` int(6) NOT NULL,
  `se_oficina` int(6) NOT NULL,
  `se_tel` int(10) NOT NULL,
  `se_ext` int(6) NOT NULL,
  `se_inventario` varchar(25) NOT NULL,
  `se_email` varchar(50) NOT NULL,
  `se_desc` text NOT NULL,
  `se_log_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `se_estado` int(2) NOT NULL,
  `se_id_del` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='Tabla destinada a almacenar los servicios ';

--
-- Volcado de datos para la tabla `tbl_servicios`
--

INSERT INTO `tbl_servicios` (`se_id`, `se_tipo_sol`, `se_nombre`, `se_cargo`, `se_tid`, `se_nid`, `se_edificio`, `se_oficina`, `se_tel`, `se_ext`, `se_inventario`, `se_email`, `se_desc`, `se_log_fecha`, `se_estado`, `se_id_del`) VALUES
(1, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, '', 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:07', 5, ''),
(2, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, '', 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:12', 4, ''),
(3, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, '', 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:15', 1, ''),
(4, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, '', 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:17', 1, ''),
(5, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, '', 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:19', 1, ''),
(6, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, '', 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:21', 1, ''),
(7, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, '', 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:23', 1, ''),
(8, 2, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, '', 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:28', 1, ''),
(9, 2, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, '', 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:31', 1, ''),
(10, 2, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, '', 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:33', 1, ''),
(11, 2, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, '', 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:45', 1, ''),
(12, 1, 'Jhon Erik', 'monitor', 1, 123456789, 331, 2145, 3213210, 1234, '', 'jhon.avila@correounivalle.edu.co', 'Lorem Ipsum', '2015-01-28 20:40:23', 1, ''),
(13, 1, 'juan valdez', 'Monitor', 1, 123456789, 331, 2124, 3212100, 1234, '', 'juan.valdez@correounivalle.edu.co', 'lorem ipsum', '2015-01-28 22:02:29', 1, ''),
(14, 1, 'Milton Lenis', 'Developer', 2, 52476289, 331, 1234, 3212100, 1234, '', 'milton.lenis@correounivalle.edu.co', 'ASDASDASDASD', '2015-04-14 18:19:00', 1, ''),
(15, 1, '', 'Docente', 1, 123123123, 381, 1234, 123123, 123123, '123123123', 'jhon.avila@correounivalle.edu.co', '123123123', '2015-05-17 16:25:53', 1, ''),
(16, 1, '', 'Docente', 1, 123123, 381, 12312, 3123123, 123123, '123123', '123123123@correounivalle.edu.co', '1231231', '2015-05-17 16:26:27', 1, ''),
(17, 1, 'asdasdasd', 'Estudiante', 1, 1231231, 388, 12312, 123123, 123123, '123123', '123123@correounivalle.edu.co', '123123123', '2015-05-17 16:29:51', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
`us_id` int(18) NOT NULL,
  `us_usuario` int(20) NOT NULL,
  `us_clave` varchar(60) NOT NULL,
  `us_email` varchar(100) NOT NULL,
  `us_tipo` int(2) NOT NULL COMMENT '1=superAdmin; 2=Soporte; 3=Comunicaciones; 4=Monitor; 5=Secretaria',
  `us_log_fecha_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `us_log_fecha_off` varchar(15) NOT NULL,
  `us_estado` int(3) NOT NULL,
  `us_id_del` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_users`
--

INSERT INTO `tbl_users` (`us_id`, `us_usuario`, `us_clave`, `us_email`, `us_tipo`, `us_log_fecha_on`, `us_log_fecha_off`, `us_estado`, `us_id_del`) VALUES
(1, 1210209, '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'jhon.avila@correounivalle.edu.co', 1, '2015-01-10 23:31:50', '', 1, ''),
(3, 1210245, 'c7deb6676adcec9dd10f53acf22d37e70767bc68', 'pepito.perez@correounivalle.edu.co', 4, '2015-01-28 06:08:01', '', 1, ''),
(4, 123456789, '999502b7deba3c5ab9264f09f1a198407ed726c1', 'asdasdas@correounivalle.edu.co', 5, '2015-06-01 20:35:09', '', 1, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_estudiantes`
--
ALTER TABLE `tbl_estudiantes`
 ADD PRIMARY KEY (`es_id`), ADD UNIQUE KEY `es_codigo` (`es_codigo`);

--
-- Indices de la tabla `tbl_flujo_estudiantes`
--
ALTER TABLE `tbl_flujo_estudiantes`
 ADD PRIMARY KEY (`fe_id`);

--
-- Indices de la tabla `tbl_observaciones`
--
ALTER TABLE `tbl_observaciones`
 ADD PRIMARY KEY (`ob_id`);

--
-- Indices de la tabla `tbl_reservas`
--
ALTER TABLE `tbl_reservas`
 ADD PRIMARY KEY (`re_id`);

--
-- Indices de la tabla `tbl_servicios`
--
ALTER TABLE `tbl_servicios`
 ADD PRIMARY KEY (`se_id`);

--
-- Indices de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
 ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_estudiantes`
--
ALTER TABLE `tbl_estudiantes`
MODIFY `es_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `tbl_flujo_estudiantes`
--
ALTER TABLE `tbl_flujo_estudiantes`
MODIFY `fe_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT de la tabla `tbl_observaciones`
--
ALTER TABLE `tbl_observaciones`
MODIFY `ob_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `tbl_reservas`
--
ALTER TABLE `tbl_reservas`
MODIFY `re_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `tbl_servicios`
--
ALTER TABLE `tbl_servicios`
MODIFY `se_id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `tbl_users`
--
ALTER TABLE `tbl_users`
MODIFY `us_id` int(18) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
