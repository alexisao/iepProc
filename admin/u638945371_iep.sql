
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-02-2015 a las 05:59:13
-- Versión del servidor: 5.1.66
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `u638945371_iep`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estudiantes`
--

CREATE TABLE IF NOT EXISTS `tbl_estudiantes` (
  `es_id` int(11) NOT NULL AUTO_INCREMENT,
  `es_nombre` varchar(90) NOT NULL,
  `es_codigo` int(10) NOT NULL,
  `es_plan` int(5) NOT NULL,
  `es_registrado_por` int(10) NOT NULL,
  `es_fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `es_estado` int(2) NOT NULL,
  PRIMARY KEY (`es_id`),
  UNIQUE KEY `es_codigo` (`es_codigo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `tbl_estudiantes`
--

INSERT INTO `tbl_estudiantes` (`es_id`, `es_nombre`, `es_codigo`, `es_plan`, `es_registrado_por`, `es_fecha_registro`, `es_estado`) VALUES
(6, 'usuario uno', 123456, 1234, 1, '2015-01-23 22:22:49', 1),
(7, 'usuario dos', 123457, 1235, 1, '2015-01-23 22:23:34', 1),
(8, 'usuario tres', 123458, 1236, 1, '2015-01-23 22:23:58', 1),
(9, 'usuario cuatro', 123459, 1237, 1, '2015-01-24 05:57:24', 1),
(10, 'usuario cinco', 123460, 1238, 1, '2015-01-24 05:58:37', 1),
(11, 'usuario seis', 123461, 1239, 1, '2015-01-24 06:00:25', 1),
(12, 'usuario siete', 123462, 1240, 1, '2015-01-24 06:02:30', 1),
(13, 'usuario ocho', 123463, 1241, 1, '2015-01-24 06:06:01', 1),
(14, 'usuario nueve', 123464, 1242, 1, '2015-01-24 06:07:56', 1),
(15, 'usuario diez', 123465, 1243, 1, '2015-01-27 06:12:04', 1),
(16, 'usuario once', 123466, 1244, 1, '2015-01-27 06:51:22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_flujo_estudiantes`
--

CREATE TABLE IF NOT EXISTS `tbl_flujo_estudiantes` (
  `fe_id` int(11) NOT NULL AUTO_INCREMENT,
  `fe_es_codigo` int(10) NOT NULL,
  `fe_sala` int(11) NOT NULL,
  `fe_pc` int(11) NOT NULL,
  `fe_hora_entrada` time NOT NULL,
  `fe_hora_salida` time DEFAULT NULL,
  `fe_log_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_monitor` int(11) NOT NULL,
  `fe_estado` int(2) NOT NULL COMMENT '[1:en sala] [2:fuera de sala]',
  PRIMARY KEY (`fe_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tbl_flujo_estudiantes`
--

INSERT INTO `tbl_flujo_estudiantes` (`fe_id`, `fe_es_codigo`, `fe_sala`, `fe_pc`, `fe_hora_entrada`, `fe_hora_salida`, `fe_log_fecha`, `fe_monitor`, `fe_estado`) VALUES
(5, 123456, 1, 1, '23:24:35', '09:29:13', '2015-01-23 22:24:36', 1, 1),
(6, 123457, 2, 2, '23:25:04', '06:37:34', '2015-01-23 22:25:05', 1, 1),
(7, 123458, 3, 1, '23:25:45', '07:10:43', '2015-01-23 22:25:46', 1, 1),
(8, 123466, 1, 11, '07:51:56', '07:52:05', '2015-01-27 06:51:57', 1, 99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_observaciones`
--

CREATE TABLE IF NOT EXISTS `tbl_observaciones` (
  `ob_id` int(11) NOT NULL AUTO_INCREMENT,
  `ob_us_id` int(2) NOT NULL COMMENT 'monitor',
  `ob_sala` int(4) NOT NULL,
  `ob_pc` int(4) NOT NULL,
  `ob_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ob_observacion` text NOT NULL,
  `ob_estado` int(2) NOT NULL,
  PRIMARY KEY (`ob_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbl_observaciones`
--

INSERT INTO `tbl_observaciones` (`ob_id`, `ob_us_id`, `ob_sala`, `ob_pc`, `ob_fecha`, `ob_observacion`, `ob_estado`) VALUES
(1, 1, 1, 1, '2015-01-27 08:42:21', '1', 99),
(2, 1, 2, 15, '2015-01-27 17:31:51', 'le falta mouse', 2),
(3, 1, 3, 14, '2015-01-27 18:07:20', 'Ventilador con aspas del ventilador partidas', 1),
(4, 1, 3, 13, '2015-01-27 18:21:29', 'Falta forro de mouse', 1),
(5, 1, 1, 15, '2015-01-27 18:22:03', 'Equipo lento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reservas`
--

CREATE TABLE IF NOT EXISTS `tbl_reservas` (
  `re_id` int(15) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`re_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Tabla de reservas de salones y sala de sistemas ' AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `tbl_reservas`
--

INSERT INTO `tbl_reservas` (`re_id`, `re_tipo_sol`, `re_nombre`, `re_cargo`, `re_tid`, `re_nid`, `re_edificio`, `re_oficina`, `re_tel`, `re_ext`, `re_email`, `re_fecha_reserva`, `re_edificio_reserva`, `re_salon_reserva`, `re_desde`, `re_hasta`, `re_log_fecha`, `re_estado`) VALUES
(1, 1, 'Jhon Avila', 'monitor', 1, 123456789, 331, 2145, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', '2015-01-21', 331, 124, '12:32 PM', '5:37 PM', '2015-01-20 05:32:27', 1),
(2, 1, 'Jhon Avila', 'monitor', 1, 123456789, 331, 2145, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', '2015-01-21', 331, 124, '12:32 PM', '5:37 PM', '2015-01-20 05:32:32', 1),
(3, 1, 'Jhon Avila', 'monitor', 1, 123456789, 331, 2145, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', '2015-01-21', 331, 124, '12:32 PM', '5:37 PM', '2015-01-20 05:32:36', 1),
(4, 1, 'Jhon Avila', 'monitor', 1, 123456789, 331, 2145, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', '2015-01-21', 331, 124, '12:32 PM', '5:37 PM', '2015-01-20 05:32:43', 1),
(5, 1, 'Jhon Avila', 'monitor', 1, 123456789, 331, 2145, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', '2015-01-21', 331, 124, '12:32 PM', '5:37 PM', '2015-01-20 05:32:49', 1),
(6, 2, 'Jhon Avila', 'monitor', 1, 123456789, 331, 2145, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', '2015-01-21', 331, 124, '12:32 PM', '5:37 PM', '2015-01-20 05:32:56', 1),
(7, 2, 'Jhon Avila', 'monitor', 1, 123456789, 331, 2145, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', '2015-01-21', 331, 124, '12:32 PM', '5:37 PM', '2015-01-20 05:33:01', 1),
(8, 2, 'Jhon Avila', 'monitor', 1, 123456789, 331, 2145, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', '2015-01-21', 331, 124, '12:32 PM', '5:37 PM', '2015-01-20 05:33:07', 1),
(9, 2, 'Jhon Avila', 'monitor', 1, 123456789, 331, 2145, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', '2015-01-21', 331, 124, '12:32 PM', '5:37 PM', '2015-01-20 05:33:14', 1),
(10, 2, 'Jhon Avila', 'monitor', 1, 123456789, 331, 2145, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', '2015-01-21', 331, 124, '12:32 PM', '5:37 PM', '2015-01-20 05:33:40', 1),
(11, 1, 'Jhon Avila', 'monitor', 1, 123456789, 331, 2145, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', '2015-01-21', 331, 124, '12:32 PM', '5:37 PM', '2015-01-20 05:33:46', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_servicios`
--

CREATE TABLE IF NOT EXISTS `tbl_servicios` (
  `se_id` int(15) NOT NULL AUTO_INCREMENT,
  `se_tipo_sol` int(2) NOT NULL,
  `se_nombre` varchar(100) NOT NULL,
  `se_cargo` varchar(50) NOT NULL,
  `se_tid` int(2) NOT NULL,
  `se_nid` int(30) NOT NULL,
  `se_edificio` int(6) NOT NULL,
  `se_oficina` int(6) NOT NULL,
  `se_tel` int(10) NOT NULL,
  `se_ext` int(6) NOT NULL,
  `se_email` varchar(50) NOT NULL,
  `se_desc` text NOT NULL,
  `se_log_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `se_estado` int(2) NOT NULL,
  PRIMARY KEY (`se_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Tabla destinada a almacenar los servicios ' AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `tbl_servicios`
--

INSERT INTO `tbl_servicios` (`se_id`, `se_tipo_sol`, `se_nombre`, `se_cargo`, `se_tid`, `se_nid`, `se_edificio`, `se_oficina`, `se_tel`, `se_ext`, `se_email`, `se_desc`, `se_log_fecha`, `se_estado`) VALUES
(1, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:07', 1),
(2, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:12', 1),
(3, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:15', 1),
(4, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:17', 1),
(5, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:19', 1),
(6, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:21', 1),
(7, 1, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:23', 1),
(8, 2, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:28', 1),
(9, 2, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:31', 1),
(10, 2, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:33', 1),
(11, 2, 'Jhon Avila', 'Monitor', 1, 1107051610, 1234, 1234, 3212100, 1234, 'jhon.avila@correounivalle.edu.co', 'asdasdasdasdasdasdasasdasd', '2015-01-19 21:20:45', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `us_id` int(18) NOT NULL AUTO_INCREMENT,
  `us_usuario` int(20) NOT NULL,
  `us_clave` varchar(60) NOT NULL,
  `us_email` varchar(100) NOT NULL,
  `us_tipo` int(2) NOT NULL COMMENT '1=superAdmin; 2=Soporte; 3=Comunicaciones; 4=Monitor',
  `us_log_fecha_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `us_log_fecha_off` varchar(15) NOT NULL,
  `us_estado` int(3) NOT NULL,
  PRIMARY KEY (`us_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tbl_users`
--

INSERT INTO `tbl_users` (`us_id`, `us_usuario`, `us_clave`, `us_email`, `us_tipo`, `us_log_fecha_on`, `us_log_fecha_off`, `us_estado`) VALUES
(1, 1210209, '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'jhon.avila@correounivalle.edu.co', 1, '2015-01-10 23:31:50', '', 1),
(3, 1210245, '10470c3b4b1fed12c3baac014be15fac67c6e815', 'pepito.perez@correounivalle.edu.co', 4, '2015-01-28 06:08:01', '', 1),
(5, 123456789, '6d1d0437bb0b6b8fdbfdef03af98d64f3ccd15ee', 'usuario.soporte@correounivalle.edu.co', 2, '2015-02-03 16:37:44', '', 1),
(6, 123456798, 'c0d1e5ff1adf7c67b0ff89659ca8e158c22be7f4', 'usuario.comunicador@correounivalle.edu.co', 3, '2015-02-03 16:38:25', '', 1),
(7, 123465789, 'c7deb6676adcec9dd10f53acf22d37e70767bc68', 'usuario.monitor@correounivalle.edu.co', 4, '2015-02-03 16:43:42', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
