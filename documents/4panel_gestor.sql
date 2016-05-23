-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2016 a las 13:30:43
-- Versión del servidor: 10.0.17-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `4panel_gestor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_administrador`
--

CREATE TABLE `gc_administrador` (
  `adm_id` int(11) NOT NULL,
  `adm_correo` varchar(30) NOT NULL,
  `adm_password` varchar(50) NOT NULL,
  `adm_nick` varchar(10) NOT NULL,
  `adm_nombre` varchar(30) NOT NULL,
  `adm_apellidos` varchar(40) NOT NULL,
  `adm_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adm_estado` int(1) NOT NULL DEFAULT '1',
  `adm_ta_id` int(11) NOT NULL DEFAULT '0',
  `adm_sed_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_administrador`
--

INSERT INTO `gc_administrador` (`adm_id`, `adm_correo`, `adm_password`, `adm_nick`, `adm_nombre`, `adm_apellidos`, `adm_fecha_reg`, `adm_estado`, `adm_ta_id`, `adm_sed_id`) VALUES
(1, 'j.salsavilca@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'julios', 'julio alcides', 'salsavilca huamanayauri', '2016-05-07 04:21:32', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_archivo`
--

CREATE TABLE `gc_archivo` (
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

CREATE TABLE `gc_detalle_seccion` (
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
-- Estructura de tabla para la tabla `gc_modulo`
--

CREATE TABLE `gc_modulo` (
  `mod_id` int(11) NOT NULL,
  `mod_nombre` varchar(45) NOT NULL,
  `mod_url` varchar(50) NOT NULL,
  `mod_icon` varchar(15) NOT NULL,
  `mod_estado` int(1) NOT NULL DEFAULT '1',
  `mod_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_modulo`
--

INSERT INTO `gc_modulo` (`mod_id`, `mod_nombre`, `mod_url`, `mod_icon`, `mod_estado`, `mod_fecha_reg`) VALUES
(1, 'Configuración', 'configuracion', 'fa-cog', 1, '2016-05-20 05:05:24'),
(2, 'Seguridad', 'seguridad', 'fa-key', 1, '2016-05-20 05:05:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_pagina`
--

CREATE TABLE `gc_pagina` (
  `pag_id` int(11) NOT NULL,
  `pag_nombre` varchar(45) NOT NULL,
  `pag_url` varchar(20) NOT NULL,
  `pag_icon` varchar(15) NOT NULL,
  `pag_estado` int(1) NOT NULL DEFAULT '1',
  `pag_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pag_mod_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_pagina`
--

INSERT INTO `gc_pagina` (`pag_id`, `pag_nombre`, `pag_url`, `pag_icon`, `pag_estado`, `pag_fecha_reg`, `pag_mod_id`) VALUES
(1, 'Administradores', 'administrador/index', 'fa-users', 1, '2016-05-20 05:06:48', 2),
(2, 'Log', 'log/index', 'fa-bug', 1, '2016-05-20 05:53:04', 2),
(3, 'Sede', 'sede/index', 'fa-building', 1, '2016-05-20 06:10:21', 1),
(4, 'Modulos', 'modulo/index', 'fa-folder', 1, '2016-05-21 03:14:45', 2),
(5, 'Secciones Web', 'seccion/index', 'fa-globe', 1, '2016-05-21 16:31:53', 1),
(6, 'Tipo de aministrador', 'tipoAdmin/index', 'fa-user', 1, '2016-05-21 16:38:26', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_permiso`
--

CREATE TABLE `gc_permiso` (
  `per_id` int(11) NOT NULL,
  `per_crear` int(1) NOT NULL DEFAULT '1',
  `per_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `per_estado` int(1) NOT NULL DEFAULT '1',
  `per_modificar` int(1) NOT NULL DEFAULT '1',
  `per_eliminar` int(1) NOT NULL DEFAULT '1',
  `per_pag_id` int(11) NOT NULL DEFAULT '0',
  `per_ta_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_permiso`
--

INSERT INTO `gc_permiso` (`per_id`, `per_crear`, `per_fecha_reg`, `per_estado`, `per_modificar`, `per_eliminar`, `per_pag_id`, `per_ta_id`) VALUES
(1, 1, '2016-05-20 05:07:30', 1, 1, 1, 1, 1),
(2, 1, '2016-05-20 05:55:01', 1, 1, 1, 2, 1),
(3, 1, '2016-05-20 06:10:37', 1, 1, 1, 3, 1),
(4, 1, '2016-05-21 03:15:43', 1, 1, 1, 4, 1),
(5, 1, '2016-05-21 16:38:53', 1, 1, 1, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_seccion`
--

CREATE TABLE `gc_seccion` (
  `sec_id` int(11) NOT NULL,
  `sec_nombre` varchar(20) NOT NULL,
  `sec_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sec_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `gc_sede` (
  `sed_id` int(11) NOT NULL,
  `sed_nombre` varchar(30) NOT NULL,
  `sed_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sed_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_sede`
--

INSERT INTO `gc_sede` (`sed_id`, `sed_nombre`, `sed_fecha_reg`, `sed_estado`) VALUES
(1, 'Lima', '2016-05-10 02:03:56', 1),
(2, 'Cuzco', '2016-05-20 02:27:05', 1),
(3, 'Arequipa', '2016-05-21 16:08:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_sede_seccion`
--

CREATE TABLE `gc_sede_seccion` (
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

CREATE TABLE `gc_tipo_admin` (
  `ta_id` int(11) NOT NULL,
  `ta_nombre` varchar(30) NOT NULL,
  `ta_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ta_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_tipo_admin`
--

INSERT INTO `gc_tipo_admin` (`ta_id`, `ta_nombre`, `ta_fecha_reg`, `ta_estado`) VALUES
(1, 'Admin7', '2016-05-10 01:56:10', 1),
(2, 'Usuario', '2016-05-10 01:56:10', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gc_administrador`
--
ALTER TABLE `gc_administrador`
  ADD PRIMARY KEY (`adm_id`),
  ADD KEY `adm_ta_id` (`adm_ta_id`),
  ADD KEY `adm_sed_id` (`adm_sed_id`);

--
-- Indices de la tabla `gc_archivo`
--
ALTER TABLE `gc_archivo`
  ADD PRIMARY KEY (`ar_id`),
  ADD KEY `ar_adm_id` (`ar_adm_id`),
  ADD KEY `ar_ds_id` (`ar_ds_id`) USING BTREE;

--
-- Indices de la tabla `gc_detalle_seccion`
--
ALTER TABLE `gc_detalle_seccion`
  ADD PRIMARY KEY (`ds_id`),
  ADD KEY `sec_adm_id` (`ds_adm_id`),
  ADD KEY `ds_ds_id` (`ds_de_id`);

--
-- Indices de la tabla `gc_modulo`
--
ALTER TABLE `gc_modulo`
  ADD PRIMARY KEY (`mod_id`);

--
-- Indices de la tabla `gc_pagina`
--
ALTER TABLE `gc_pagina`
  ADD PRIMARY KEY (`pag_id`),
  ADD KEY `pag_mod_id` (`pag_mod_id`);

--
-- Indices de la tabla `gc_permiso`
--
ALTER TABLE `gc_permiso`
  ADD PRIMARY KEY (`per_id`),
  ADD KEY `per_ta_id` (`per_ta_id`),
  ADD KEY `per_pag_id` (`per_pag_id`) USING BTREE;

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
  ADD PRIMARY KEY (`ss_id`),
  ADD KEY `ss_sed_id` (`ss_sed_id`) USING BTREE,
  ADD KEY `ss_sec_id` (`ss_sec_id`);

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
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- AUTO_INCREMENT de la tabla `gc_modulo`
--
ALTER TABLE `gc_modulo`
  MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gc_pagina`
--
ALTER TABLE `gc_pagina`
  MODIFY `pag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `gc_permiso`
--
ALTER TABLE `gc_permiso`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `gc_seccion`
--
ALTER TABLE `gc_seccion`
  MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `gc_sede`
--
ALTER TABLE `gc_sede`
  MODIFY `sed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `gc_sede_seccion`
--
ALTER TABLE `gc_sede_seccion`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gc_tipo_admin`
--
ALTER TABLE `gc_tipo_admin`
  MODIFY `ta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
