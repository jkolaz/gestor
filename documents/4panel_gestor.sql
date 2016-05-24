-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2016 a las 18:23:30
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `4panel_gestor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_administrador`
--

CREATE TABLE IF NOT EXISTS `gc_administrador` (
`adm_id` int(11) NOT NULL,
  `adm_correo` varchar(30) NOT NULL,
  `adm_password` varchar(50) NOT NULL,
  `adm_nick` varchar(6) NOT NULL,
  `adm_nombre` varchar(30) NOT NULL,
  `adm_apellidos` varchar(40) NOT NULL,
  `adm_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adm_estado` int(1) NOT NULL DEFAULT '1',
  `adm_ta_id` int(11) NOT NULL DEFAULT '0',
  `adm_sed_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_administrador`
--

INSERT INTO `gc_administrador` (`adm_id`, `adm_correo`, `adm_password`, `adm_nick`, `adm_nombre`, `adm_apellidos`, `adm_fecha_reg`, `adm_estado`, `adm_ta_id`, `adm_sed_id`) VALUES
(1, 'j.salsavilca@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'j.sals', 'julio alcides', 'salsavilca huamanayauri', '2016-05-07 04:21:32', 1, 1, 0),
(2, 'ihuapaya@vmc.la', 'e10adc3949ba59abbe56e057f20f883e', 'ihuapa', '', 'huapaya romero', '2016-05-23 19:59:02', 0, 2, 2),
(3, 'rubygq@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'rubygq', '', 'gonzales', '2016-05-23 20:03:17', 0, 2, 0),
(4, 'ehuapayaromero@gmail.com', 'aee3067b663899c1f9eb2d811dab9804', 'ehuapa', 'ivan', 'huapaya romero', '2016-05-23 20:09:59', 0, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_archivo`
--

CREATE TABLE IF NOT EXISTS `gc_archivo` (
`ar_id` int(11) NOT NULL,
  `ar_archivo` varchar(30) NOT NULL,
  `ar_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ar_estado` int(1) NOT NULL DEFAULT '1',
  `ar_ds_id` int(11) NOT NULL DEFAULT '0',
  `ar_adm_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_detalle_seccion`
--

CREATE TABLE IF NOT EXISTS `gc_detalle_seccion` (
`ds_id` int(11) NOT NULL,
  `ds_titulo` varchar(30) NOT NULL,
  `ds_descripcion` text NOT NULL,
  `ds_fecha_inicio` datetime NOT NULL,
  `ds_fecha_fin` datetime NOT NULL,
  `ds_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ds_estado` int(1) NOT NULL DEFAULT '1',
  `ds_adm_id` int(11) NOT NULL DEFAULT '0',
  `ds_de_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_menu`
--

CREATE TABLE IF NOT EXISTS `gc_menu` (
`men_id` int(11) NOT NULL,
  `men_nombre` varchar(30) CHARACTER SET utf8 NOT NULL,
  `men_ruta` varchar(70) CHARACTER SET utf8 NOT NULL,
  `men_padre` int(11) NOT NULL DEFAULT '0',
  `men_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `men_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gc_menu`
--

INSERT INTO `gc_menu` (`men_id`, `men_nombre`, `men_ruta`, `men_padre`, `men_fecha_reg`, `men_estado`) VALUES
(1, 'Quienes Somos', '', 0, '2016-05-24 18:09:43', 1),
(2, 'Presentación', 'presentacion', 1, '2016-05-24 20:55:16', 1),
(3, 'Servicios', '', 0, '2016-05-24 22:54:43', 1),
(4, 'Psiquiatría Clínica', 'psiquiatriaclinica', 3, '2016-05-24 22:55:51', 1),
(5, 'Programas Adicionales', 'programasadicionales', 3, '2016-05-24 23:00:44', 1),
(6, 'Directorio', 'directorio', 1, '2016-05-24 23:01:59', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_menu_web`
--

CREATE TABLE IF NOT EXISTS `gc_menu_web` (
`mw_id` int(11) NOT NULL,
  `mw_men_id` int(11) NOT NULL DEFAULT '0',
  `mw_sed_id` int(11) NOT NULL DEFAULT '0',
  `mw_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mw_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_menu_web`
--

INSERT INTO `gc_menu_web` (`mw_id`, `mw_men_id`, `mw_sed_id`, `mw_fecha_reg`, `mw_estado`) VALUES
(1, 4, 1, '2016-05-24 23:05:45', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_modulo`
--

CREATE TABLE IF NOT EXISTS `gc_modulo` (
`mod_id` int(11) NOT NULL,
  `mod_nombre` varchar(45) NOT NULL,
  `mod_url` varchar(50) NOT NULL,
  `mod_icon` varchar(15) NOT NULL,
  `mod_estado` int(1) NOT NULL DEFAULT '1',
  `mod_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_modulo`
--

INSERT INTO `gc_modulo` (`mod_id`, `mod_nombre`, `mod_url`, `mod_icon`, `mod_estado`, `mod_fecha_reg`) VALUES
(1, 'Configuración', 'configuracion', 'fa-cog', 1, '2016-05-20 05:05:24'),
(2, 'Seguridad', 'seguridad', 'fa-key', 1, '2016-05-20 05:05:24'),
(3, 'Secciones Web', 'seccion', 'fa-globe', 1, '2016-05-20 20:13:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_pagina`
--

CREATE TABLE IF NOT EXISTS `gc_pagina` (
`pag_id` int(11) NOT NULL,
  `pag_nombre` varchar(45) NOT NULL,
  `pag_url` varchar(50) NOT NULL,
  `pag_icon` varchar(15) NOT NULL,
  `pag_estado` int(1) NOT NULL DEFAULT '1',
  `pag_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pag_mod_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_pagina`
--

INSERT INTO `gc_pagina` (`pag_id`, `pag_nombre`, `pag_url`, `pag_icon`, `pag_estado`, `pag_fecha_reg`, `pag_mod_id`) VALUES
(1, 'administradores', 'administrador/index', 'fa-users', 1, '2016-05-20 05:06:48', 2),
(2, 'Log', 'log/index', 'fa-bug', 1, '2016-05-20 05:53:04', 2),
(3, 'sede', 'sede/index', 'fa-building', 1, '2016-05-20 06:10:21', 1),
(4, 'Tipo Administrador', 'tipoAdmin/index', 'fa-user', 1, '2016-05-20 20:16:27', 2),
(5, 'Secciones Web', 'seccion/index', 'fa-globe', 1, '2016-05-20 20:16:27', 1),
(6, 'Mudolos del sistema', 'modulo/index', 'fa-folder', 1, '2016-05-20 22:11:55', 2),
(7, 'Menú', 'menu/index', 'fa-tag', 1, '2016-05-24 16:37:48', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_permiso`
--

CREATE TABLE IF NOT EXISTS `gc_permiso` (
`per_id` int(11) NOT NULL,
  `per_crear` int(1) NOT NULL DEFAULT '1',
  `per_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `per_estado` int(1) NOT NULL DEFAULT '1',
  `per_modificar` int(1) NOT NULL DEFAULT '1',
  `per_eliminar` int(1) NOT NULL DEFAULT '1',
  `per_pag_id` int(11) NOT NULL DEFAULT '0',
  `per_ta_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_permiso`
--

INSERT INTO `gc_permiso` (`per_id`, `per_crear`, `per_fecha_reg`, `per_estado`, `per_modificar`, `per_eliminar`, `per_pag_id`, `per_ta_id`) VALUES
(1, 1, '2016-05-20 05:07:30', 1, 1, 1, 1, 1),
(2, 1, '2016-05-20 05:55:01', 1, 1, 1, 2, 1),
(3, 1, '2016-05-20 06:10:37', 1, 1, 1, 3, 1),
(4, 1, '2016-05-20 20:17:32', 1, 1, 1, 4, 1),
(5, 1, '2016-05-20 20:17:32', 1, 1, 1, 5, 1),
(6, 1, '2016-05-20 22:12:08', 1, 1, 1, 6, 1),
(7, 1, '2016-05-24 16:37:59', 1, 1, 1, 7, 1),
(8, 1, '2016-05-24 19:57:40', 1, 1, 1, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_seccion`
--

CREATE TABLE IF NOT EXISTS `gc_seccion` (
`sec_id` int(11) NOT NULL,
  `sec_nombre` varchar(20) NOT NULL,
  `sec_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sec_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_seccion`
--

INSERT INTO `gc_seccion` (`sec_id`, `sec_nombre`, `sec_fecha_reg`, `sec_estado`) VALUES
(1, 'Novedades', '2016-05-11 03:29:38', 1),
(2, 'Slider', '2016-05-11 03:29:38', 2),
(3, 'Servicios', '2016-05-11 03:30:51', 1),
(4, 'Ofertas', '2016-05-11 03:30:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_sede`
--

CREATE TABLE IF NOT EXISTS `gc_sede` (
`sed_id` int(11) NOT NULL,
  `sed_nombre` varchar(30) NOT NULL,
  `sed_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sed_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_sede`
--

INSERT INTO `gc_sede` (`sed_id`, `sed_nombre`, `sed_fecha_reg`, `sed_estado`) VALUES
(1, 'Lima', '2016-05-10 02:03:56', 0),
(2, 'Cuzco', '2016-05-20 02:27:05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_sede_seccion`
--

CREATE TABLE IF NOT EXISTS `gc_sede_seccion` (
`ss_id` int(11) NOT NULL,
  `ss_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ss_estado` int(1) NOT NULL DEFAULT '1',
  `ss_sed_id` int(11) NOT NULL DEFAULT '0',
  `ss_sec_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_tipo_admin`
--

CREATE TABLE IF NOT EXISTS `gc_tipo_admin` (
`ta_id` int(11) NOT NULL,
  `ta_nombre` varchar(30) NOT NULL,
  `ta_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ta_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_tipo_admin`
--

INSERT INTO `gc_tipo_admin` (`ta_id`, `ta_nombre`, `ta_fecha_reg`, `ta_estado`) VALUES
(1, 'Admin', '2016-05-10 01:56:10', 1),
(2, 'Administrador web', '2016-05-10 01:56:10', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gc_administrador`
--
ALTER TABLE `gc_administrador`
 ADD PRIMARY KEY (`adm_id`), ADD KEY `adm_ta_id` (`adm_ta_id`), ADD KEY `adm_sed_id` (`adm_sed_id`);

--
-- Indices de la tabla `gc_archivo`
--
ALTER TABLE `gc_archivo`
 ADD PRIMARY KEY (`ar_id`), ADD KEY `ar_adm_id` (`ar_adm_id`), ADD KEY `ar_ds_id` (`ar_ds_id`) USING BTREE;

--
-- Indices de la tabla `gc_detalle_seccion`
--
ALTER TABLE `gc_detalle_seccion`
 ADD PRIMARY KEY (`ds_id`), ADD KEY `sec_adm_id` (`ds_adm_id`), ADD KEY `ds_ds_id` (`ds_de_id`);

--
-- Indices de la tabla `gc_menu`
--
ALTER TABLE `gc_menu`
 ADD PRIMARY KEY (`men_id`);

--
-- Indices de la tabla `gc_menu_web`
--
ALTER TABLE `gc_menu_web`
 ADD PRIMARY KEY (`mw_id`), ADD KEY `mw_men_id` (`mw_men_id`), ADD KEY `mw_sed_id` (`mw_sed_id`);

--
-- Indices de la tabla `gc_modulo`
--
ALTER TABLE `gc_modulo`
 ADD PRIMARY KEY (`mod_id`);

--
-- Indices de la tabla `gc_pagina`
--
ALTER TABLE `gc_pagina`
 ADD PRIMARY KEY (`pag_id`), ADD KEY `pag_mod_id` (`pag_mod_id`);

--
-- Indices de la tabla `gc_permiso`
--
ALTER TABLE `gc_permiso`
 ADD PRIMARY KEY (`per_id`), ADD KEY `per_ta_id` (`per_ta_id`), ADD KEY `per_pag_id` (`per_pag_id`) USING BTREE;

--
-- Indices de la tabla `gc_seccion`
--
ALTER TABLE `gc_seccion`
 ADD PRIMARY KEY (`sec_id`);

--
-- Indices de la tabla `gc_sede`
--
ALTER TABLE `gc_sede`
 ADD PRIMARY KEY (`sed_id`);

--
-- Indices de la tabla `gc_sede_seccion`
--
ALTER TABLE `gc_sede_seccion`
 ADD PRIMARY KEY (`ss_id`), ADD KEY `ss_sed_id` (`ss_sed_id`) USING BTREE, ADD KEY `ss_sec_id` (`ss_sec_id`);

--
-- Indices de la tabla `gc_tipo_admin`
--
ALTER TABLE `gc_tipo_admin`
 ADD PRIMARY KEY (`ta_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gc_administrador`
--
ALTER TABLE `gc_administrador`
MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `gc_archivo`
--
ALTER TABLE `gc_archivo`
MODIFY `ar_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gc_detalle_seccion`
--
ALTER TABLE `gc_detalle_seccion`
MODIFY `ds_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gc_menu`
--
ALTER TABLE `gc_menu`
MODIFY `men_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `gc_menu_web`
--
ALTER TABLE `gc_menu_web`
MODIFY `mw_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gc_modulo`
--
ALTER TABLE `gc_modulo`
MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `gc_pagina`
--
ALTER TABLE `gc_pagina`
MODIFY `pag_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `gc_permiso`
--
ALTER TABLE `gc_permiso`
MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `gc_seccion`
--
ALTER TABLE `gc_seccion`
MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `gc_sede`
--
ALTER TABLE `gc_sede`
MODIFY `sed_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gc_sede_seccion`
--
ALTER TABLE `gc_sede_seccion`
MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gc_tipo_admin`
--
ALTER TABLE `gc_tipo_admin`
MODIFY `ta_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

