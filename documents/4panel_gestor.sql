-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2016 a las 00:07:50
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
  `adm_nick` varchar(6) NOT NULL,
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
(1, 'j.salsavilca@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'julios', 'julio alcides', 'salsavilca huamanayauri', '2016-05-07 04:21:32', 1, 1, 0),
(2, 'ihuapaya@vmc.la', 'e10adc3949ba59abbe56e057f20f883e', 'ihuapa', '', 'huapaya romero', '2016-05-23 19:59:02', 1, 2, 2),
(3, 'rubygq@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'rubygq', '', 'gonzales', '2016-05-23 20:03:17', 0, 2, 0),
(4, 'ehuapayaromero@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'ehuapa', 'ivan', 'huapaya romero', '2016-05-23 20:09:59', 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_bienvenida`
--

CREATE TABLE `gc_bienvenida` (
  `bie_id` int(11) NOT NULL,
  `bie_titulo` varchar(200) NOT NULL,
  `bie_contenido` text NOT NULL,
  `bie_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bie_estado` int(1) NOT NULL DEFAULT '1',
  `bie_sed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_bienvenida`
--

INSERT INTO `gc_bienvenida` (`bie_id`, `bie_titulo`, `bie_contenido`, `bie_fecha_reg`, `bie_estado`, `bie_sed_id`) VALUES
(1, 'Bienvenidos', '<p>El Centro de Reposo San Juan de Dios de Piura (Perú) es una institución sanitaria especialista en Salud Mental, sin fines de lucro, perteneciente a la Orden Hospitalaria de San Juan de Dios (OHSJ). Brindamos servicios asistenciales en psicología, psiquiatría y adicciones, en consulta externa, hospitalización y farmacia.</p>', '2016-05-29 18:16:13', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_especialidad`
--

CREATE TABLE `gc_especialidad` (
  `esp_id` int(11) NOT NULL,
  `esp_nombre` varchar(45) NOT NULL,
  `esp_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `esp_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_especialidad`
--

INSERT INTO `gc_especialidad` (`esp_id`, `esp_nombre`, `esp_fecha_reg`, `esp_estado`) VALUES
(1, 'Odontologías', '2016-05-29 19:38:06', 1),
(2, 'Psiquiatría', '2016-05-29 20:17:17', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_evento`
--

CREATE TABLE `gc_evento` (
  `eve_id` int(11) NOT NULL,
  `eve_nombre` varchar(200) NOT NULL,
  `eve_url` varchar(60) NOT NULL,
  `eve_fecha` datetime NOT NULL,
  `eve_lugar` text NOT NULL,
  `eve_descripcion` text NOT NULL,
  `eve_imagen` varchar(45) NOT NULL,
  `eve_estado` int(1) NOT NULL DEFAULT '1',
  `eve_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `eve_sed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_evento`
--

INSERT INTO `gc_evento` (`eve_id`, `eve_nombre`, `eve_url`, `eve_fecha`, `eve_lugar`, `eve_descripcion`, `eve_imagen`, `eve_estado`, `eve_fecha_reg`, `eve_sed_id`) VALUES
(1, 'Campaña de salud en piura', 'http://www.contenidos.devel/seccion/evento/editar/1.html', '2016-05-02 00:00:00', 'Av. la cultura 346 - Santa Anita', '<p>Atenciones</p>\r\n                    <h2>Terapia individual.</h2>\r\n						<p>Es el encuentro entre el terapeuta y el paciente en donde en un ambiente de aceptación, confidencialidad y apertura el paciente puede expresar sus problemas y emociones. Esto implica ayudar a remover y modificar síntomas de malestar ya existentes, prevenir algunos otros, mediatizar comportamientos y promover el crecimiento. Implica además tratamiento de los problemas de ansiedad, depresión, angustia, fobias, estrés, intento suicida, comportamientos obsesivos, entre otros.</p>\r\n                    <h2>Terapia de pareja</h2>\r\n						<p>Es el tratamiento clínico psicológico que se le brinda a ambos miembros de una relación sentimental, en su condición de enamorados, novios, esposos, convivientes, separados, y/o divorciados, por parte de un psicoterapeuta o terapeuta profesional debidamente capacitado. </p>\r\n						<p>En una terapia de pareja, el psicoterapeuta se centrará fundamentalmente en mejorar la comunicación en la pareja en la relación. De esta manera se aprenderá a controlar los impulsos y emociones para afrontar y resolver los conflictos que puedan surgir de una manera más eficiente. Se enseñará a ver los problemas desde otra perspectiva, intentando relativizar los mismos sin que los personalicemos, la soberbia u orgullo puede distorsionar los juicios de valor.</p>\r\n                    <h2>Terapia familiar</h2>\r\n						<p>Es un método de tratamiento que intenta resolver conflictos o situaciones que atraviesan un grupo familiar, sirve para que sus integrantes expresen sus sentimientos, respecto a ese problema e intenten llegar a un acuerdo, comprendiéndose y acercándose a la realidad del resto.</p>\r\n                    <h2>Atención Psicopedagógica</h2>\r\n						<p>Es el servicio que tiene como propósito fundamental apoyar al alumno en sus estrategias de aprendizaje y/o en su proceso de desarrollo psicosocial y familiar, a través de la valoración, canalización y/o atención por parte del profesional competente. Este servicio proporciona al alumno la orientación educativa integral con un enfoque de desarrollo humano y atendiéndolo en la construcción y consolidación de su identidad personal y profesional, haciendo énfasis en las áreas personal, social, escolar y familiar en correspondencia con su entorno.</p>\r\n                    <h2>Evaluación psicológica</h2>\r\n						<p>Es una evaluación efectuada por un profesional de la salud mental, que por lo general es un psicólogo, para determinar el estado de la salud mental de una persona. Una evaluación psicológica puede tener como resultado un diagnóstico de una enfermedad mental. Esta evaluación generalmente incluye una entrevista preliminar y la aplicación de test de personalidad, inteligencia o neuropsicológica. El examen psicológico no es un proceso psicoterapéutico, sino que pretende precisar un diagnóstico, indicar un tratamiento, una psicoterapia o una reeducación neuropsicológica. También puede ser parte de un peritaje judicial, sea civil o penal.</p>', '', 1, '2016-05-29 03:20:18', 2),
(2, '', '', '0000-00-00 00:00:00', '', '', '', 0, '2016-05-29 17:25:33', 2),
(3, '', '', '0000-00-00 00:00:00', '', '', '', 0, '2016-05-29 18:15:21', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_menu`
--

CREATE TABLE `gc_menu` (
  `men_id` int(11) NOT NULL,
  `men_nombre` varchar(30) CHARACTER SET utf8 NOT NULL,
  `men_ruta` varchar(70) CHARACTER SET utf8 NOT NULL,
  `men_padre` int(11) NOT NULL DEFAULT '0',
  `men_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `men_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `gc_menu_web` (
  `mw_id` int(11) NOT NULL,
  `mw_men_id` int(11) NOT NULL DEFAULT '0',
  `mw_sed_id` int(11) NOT NULL DEFAULT '0',
  `mw_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mw_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_menu_web`
--

INSERT INTO `gc_menu_web` (`mw_id`, `mw_men_id`, `mw_sed_id`, `mw_fecha_reg`, `mw_estado`) VALUES
(1, 4, 1, '2016-05-24 23:05:45', 1),
(2, 6, 1, '2016-05-26 02:39:44', 1),
(3, 2, 1, '2016-05-26 02:41:43', 1),
(4, 5, 1, '2016-05-26 02:41:47', 1),
(5, 6, 2, '2016-05-29 15:00:00', 1);

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
(2, 'Seguridad', 'seguridad', 'fa-key', 1, '2016-05-20 05:05:24'),
(3, 'Secciones Web', 'seccion', 'fa-globe', 1, '2016-05-20 20:13:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_novedad`
--

CREATE TABLE `gc_novedad` (
  `nov_id` int(11) NOT NULL,
  `nov_titulo` varchar(200) NOT NULL,
  `nov_subtitulo` varchar(250) NOT NULL,
  `nov_youtube` varchar(250) NOT NULL,
  `nov_issuu` varchar(50) NOT NULL,
  `nov_destacada` int(1) NOT NULL DEFAULT '0',
  `nov_imagen` varchar(45) NOT NULL,
  `nov_contenido` text NOT NULL,
  `nov_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nov_estado` int(1) NOT NULL DEFAULT '1',
  `nov_sed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_novedad`
--

INSERT INTO `gc_novedad` (`nov_id`, `nov_titulo`, `nov_subtitulo`, `nov_youtube`, `nov_issuu`, `nov_destacada`, `nov_imagen`, `nov_contenido`, `nov_fecha_reg`, `nov_estado`, `nov_sed_id`) VALUES
(1, 'Centro Psicoterapéutico San Juan de Dios', 'Contamos con un moderno servicio dirigido a niños, adolescentes, adultos, familias y parejas. Ofrecemos psicoterapia individual, de pareja y de familia; atendemos problemas de aprendizaje y conductas.', '', '', 1, 'novedad_Desert.jpg', '<p>Atenciones</p>\n                    <h2>Terapia individual</h2>\n						<p>Es el encuentro entre el terapeuta y el paciente en donde en un ambiente de aceptación, confidencialidad y apertura el paciente puede expresar sus problemas y emociones. Esto implica ayudar a remover y modificar síntomas de malestar ya existentes, prevenir algunos otros, mediatizar comportamientos y promover el crecimiento. Implica además tratamiento de los problemas de ansiedad, depresión, angustia, fobias, estrés, intento suicida, comportamientos obsesivos, entre otros.</p>\n                    <h2>Terapia de pareja</h2>\n						<p>Es el tratamiento clínico psicológico que se le brinda a ambos miembros de una relación sentimental, en su condición de enamorados, novios, esposos, convivientes, separados, y/o divorciados, por parte de un psicoterapeuta o terapeuta profesional debidamente capacitado. </p>\n						<p>En una terapia de pareja, el psicoterapeuta se centrará fundamentalmente en mejorar la comunicación en la pareja en la relación. De esta manera se aprenderá a controlar los impulsos y emociones para afrontar y resolver los conflictos que puedan surgir de una manera más eficiente. Se enseñará a ver los problemas desde otra perspectiva, intentando relativizar los mismos sin que los personalicemos, la soberbia u orgullo puede distorsionar los juicios de valor.</p>\n                    <h2>Terapia familiar</h2>\n						<p>Es un método de tratamiento que intenta resolver conflictos o situaciones que atraviesan un grupo familiar, sirve para que sus integrantes expresen sus sentimientos, respecto a ese problema e intenten llegar a un acuerdo, comprendiéndose y acercándose a la realidad del resto.</p>\n                    <h2>Atención Psicopedagógica</h2>\n						<p>Es el servicio que tiene como propósito fundamental apoyar al alumno en sus estrategias de aprendizaje y/o en su proceso de desarrollo psicosocial y familiar, a través de la valoración, canalización y/o atención por parte del profesional competente. Este servicio proporciona al alumno la orientación educativa integral con un enfoque de desarrollo humano y atendiéndolo en la construcción y consolidación de su identidad personal y profesional, haciendo énfasis en las áreas personal, social, escolar y familiar en correspondencia con su entorno.</p>\n                    <h2>Evaluación psicológica</h2>\n						<p>Es una evaluación efectuada por un profesional de la salud mental, que por lo general es un psicólogo, para determinar el estado de la salud mental de una persona. Una evaluación psicológica puede tener como resultado un diagnóstico de una enfermedad mental. Esta evaluación generalmente incluye una entrevista preliminar y la aplicación de test de personalidad, inteligencia o neuropsicológica. El examen psicológico no es un proceso psicoterapéutico, sino que pretende precisar un diagnóstico, indicar un tratamiento, una psicoterapia o una reeducación neuropsicológica. También puede ser parte de un peritaje judicial, sea civil o penal.</p>', '2016-05-29 00:26:38', 1, 2),
(2, 'Centro Psicoterapéutico San Juan de Dios', 'Contamos con un moderno servicio dirigido a niños, adolescentes, adultos, familias y parejas. Ofrecemos psicoterapia individual, de pareja y de familia; atendemos problemas de aprendizaje y conductas.', '', '', 1, '', '<p>Atenciones</p>\r\n                    <h2>Terapia individual</h2>\r\n						<p>Es el encuentro entre el terapeuta y el paciente en donde en un ambiente de aceptación, confidencialidad y apertura el paciente puede expresar sus problemas y emociones. Esto implica ayudar a remover y modificar síntomas de malestar ya existentes, prevenir algunos otros, mediatizar comportamientos y promover el crecimiento. Implica además tratamiento de los problemas de ansiedad, depresión, angustia, fobias, estrés, intento suicida, comportamientos obsesivos, entre otros.</p>\r\n                    <h2>Terapia de pareja</h2>\r\n						<p>Es el tratamiento clínico psicológico que se le brinda a ambos miembros de una relación sentimental, en su condición de enamorados, novios, esposos, convivientes, separados, y/o divorciados, por parte de un psicoterapeuta o terapeuta profesional debidamente capacitado. </p>\r\n						<p>En una terapia de pareja, el psicoterapeuta se centrará fundamentalmente en mejorar la comunicación en la pareja en la relación. De esta manera se aprenderá a controlar los impulsos y emociones para afrontar y resolver los conflictos que puedan surgir de una manera más eficiente. Se enseñará a ver los problemas desde otra perspectiva, intentando relativizar los mismos sin que los personalicemos, la soberbia u orgullo puede distorsionar los juicios de valor.</p>\r\n                    <h2>Terapia familiar</h2>\r\n						<p>Es un método de tratamiento que intenta resolver conflictos o situaciones que atraviesan un grupo familiar, sirve para que sus integrantes expresen sus sentimientos, respecto a ese problema e intenten llegar a un acuerdo, comprendiéndose y acercándose a la realidad del resto.</p>\r\n                    <h2>Atención Psicopedagógica</h2>\r\n						<p>Es el servicio que tiene como propósito fundamental apoyar al alumno en sus estrategias de aprendizaje y/o en su proceso de desarrollo psicosocial y familiar, a través de la valoración, canalización y/o atención por parte del profesional competente. Este servicio proporciona al alumno la orientación educativa integral con un enfoque de desarrollo humano y atendiéndolo en la construcción y consolidación de su identidad personal y profesional, haciendo énfasis en las áreas personal, social, escolar y familiar en correspondencia con su entorno.</p>\r\n                    <h2>Evaluación psicológica</h2>\r\n						<p>Es una evaluación efectuada por un profesional de la salud mental, que por lo general es un psicólogo, para determinar el estado de la salud mental de una persona. Una evaluación psicológica puede tener como resultado un diagnóstico de una enfermedad mental. Esta evaluación generalmente incluye una entrevista preliminar y la aplicación de test de personalidad, inteligencia o neuropsicológica. El examen psicológico no es un proceso psicoterapéutico, sino que pretende precisar un diagnóstico, indicar un tratamiento, una psicoterapia o una reeducación neuropsicológica. También puede ser parte de un peritaje judicial, sea civil o penal.</p>', '2016-05-29 02:16:04', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_pagina`
--

CREATE TABLE `gc_pagina` (
  `pag_id` int(11) NOT NULL,
  `pag_nombre` varchar(45) NOT NULL,
  `pag_url` varchar(50) NOT NULL,
  `pag_icon` varchar(15) NOT NULL,
  `pag_estado` int(1) NOT NULL DEFAULT '1',
  `pag_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pag_mod_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_pagina`
--

INSERT INTO `gc_pagina` (`pag_id`, `pag_nombre`, `pag_url`, `pag_icon`, `pag_estado`, `pag_fecha_reg`, `pag_mod_id`) VALUES
(1, 'administradores', 'administrador/index', 'fa-users', 1, '2016-05-20 05:06:48', 2),
(2, 'Log', 'log/index', 'fa-bug', 1, '2016-05-20 05:53:04', 2),
(3, 'Sedes', 'sede/index', 'fa-building', 1, '2016-05-20 06:10:21', 1),
(4, 'Tipo Administrador', 'tipoAdmin/index', 'fa-user', 1, '2016-05-20 20:16:27', 2),
(5, 'Secciones Web', 'seccion/index', 'fa-globe', 1, '2016-05-20 20:16:27', 1),
(6, 'Mudolos del sistema', 'modulo/index', 'fa-folder', 1, '2016-05-20 22:11:55', 2),
(7, 'Menú', 'menu/index', 'fa-tag', 1, '2016-05-24 16:37:48', 1),
(8, 'Novedades', 'novedad/index', 'fa-bell', 1, '2016-05-29 14:05:17', 3),
(9, 'Eventos', 'evento/index', 'fa-bullhorn', 1, '2016-05-29 14:06:11', 3),
(10, 'Menú', 'menuweb/index', 'fa-tasks', 1, '2016-05-29 14:58:00', 3),
(11, 'Revistas', 'revista/index', 'fa-language', 1, '2016-05-30 01:09:59', 3),
(12, 'Bienvenidas', 'bienvenida/index', 'fa-coffee', 1, '2016-05-30 01:12:35', 3),
(13, 'Especialidades', 'especialidad/index', 'fa-stethoscope', 1, '2016-05-30 01:13:48', 1);

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
(4, 1, '2016-05-20 20:17:32', 1, 1, 1, 4, 1),
(5, 1, '2016-05-20 20:17:32', 1, 1, 1, 5, 1),
(6, 1, '2016-05-20 22:12:08', 1, 1, 1, 6, 1),
(7, 1, '2016-05-24 16:37:59', 1, 1, 1, 7, 1),
(8, 1, '2016-05-24 19:57:40', 1, 1, 1, 3, 2),
(9, 1, '2016-05-29 14:06:30', 0, 1, 1, 5, 2),
(10, 1, '2016-05-29 14:06:33', 0, 1, 1, 7, 2),
(11, 1, '2016-05-29 14:06:56', 1, 1, 1, 9, 2),
(12, 1, '2016-05-29 14:07:01', 1, 1, 1, 8, 2),
(13, 1, '2016-05-29 14:10:13', 1, 1, 1, 9, 1),
(14, 1, '2016-05-29 14:58:47', 1, 1, 1, 10, 2),
(15, 1, '2016-05-30 01:14:22', 1, 1, 1, 12, 2),
(16, 1, '2016-05-30 01:14:23', 1, 1, 1, 11, 2),
(17, 1, '2016-05-30 01:14:34', 1, 1, 1, 13, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_revista`
--

CREATE TABLE `gc_revista` (
  `rev_id` int(11) NOT NULL,
  `rev_nombre` varchar(200) NOT NULL,
  `rev_issuu` varchar(45) NOT NULL,
  `rev_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rev_estado` int(1) NOT NULL DEFAULT '1',
  `rev_sed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_revista`
--

INSERT INTO `gc_revista` (`rev_id`, `rev_nombre`, `rev_issuu`, `rev_fecha_reg`, `rev_estado`, `rev_sed_id`) VALUES
(1, 'Revista Odontologica....', '', '2016-05-29 17:29:04', 1, 2);

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
(2, 'Cuzco', '2016-05-20 02:27:05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gc_sede_especialidad`
--

CREATE TABLE `gc_sede_especialidad` (
  `se_id` int(11) NOT NULL,
  `se_estado` int(1) NOT NULL DEFAULT '1',
  `se_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `se_sed_id` int(11) NOT NULL,
  `se_esp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gc_sede_especialidad`
--

INSERT INTO `gc_sede_especialidad` (`se_id`, `se_estado`, `se_fecha_reg`, `se_sed_id`, `se_esp_id`) VALUES
(1, 0, '2016-05-30 04:59:36', 2, 1),
(2, 1, '2016-05-30 05:01:51', 2, 2);

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
(1, 'Admin', '2016-05-10 01:56:10', 1),
(2, 'Administrador web', '2016-05-10 01:56:10', 1);

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
-- Indices de la tabla `gc_bienvenida`
--
ALTER TABLE `gc_bienvenida`
  ADD PRIMARY KEY (`bie_id`),
  ADD KEY `bie_sed_id` (`bie_sed_id`);

--
-- Indices de la tabla `gc_especialidad`
--
ALTER TABLE `gc_especialidad`
  ADD PRIMARY KEY (`esp_id`);

--
-- Indices de la tabla `gc_evento`
--
ALTER TABLE `gc_evento`
  ADD PRIMARY KEY (`eve_id`),
  ADD KEY `eve_sed_id` (`eve_sed_id`);

--
-- Indices de la tabla `gc_menu`
--
ALTER TABLE `gc_menu`
  ADD PRIMARY KEY (`men_id`);

--
-- Indices de la tabla `gc_menu_web`
--
ALTER TABLE `gc_menu_web`
  ADD PRIMARY KEY (`mw_id`),
  ADD KEY `mw_men_id` (`mw_men_id`),
  ADD KEY `mw_sed_id` (`mw_sed_id`);

--
-- Indices de la tabla `gc_modulo`
--
ALTER TABLE `gc_modulo`
  ADD PRIMARY KEY (`mod_id`);

--
-- Indices de la tabla `gc_novedad`
--
ALTER TABLE `gc_novedad`
  ADD PRIMARY KEY (`nov_id`),
  ADD KEY `nov_sed_id` (`nov_sed_id`);

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
-- Indices de la tabla `gc_revista`
--
ALTER TABLE `gc_revista`
  ADD PRIMARY KEY (`rev_id`),
  ADD KEY `rev_sed_id` (`rev_sed_id`);

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
-- Indices de la tabla `gc_sede_especialidad`
--
ALTER TABLE `gc_sede_especialidad`
  ADD PRIMARY KEY (`se_id`),
  ADD KEY `se_sed_is` (`se_sed_id`) USING BTREE,
  ADD KEY `se_esp_id` (`se_esp_id`);

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
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `gc_bienvenida`
--
ALTER TABLE `gc_bienvenida`
  MODIFY `bie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gc_especialidad`
--
ALTER TABLE `gc_especialidad`
  MODIFY `esp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gc_evento`
--
ALTER TABLE `gc_evento`
  MODIFY `eve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `gc_menu`
--
ALTER TABLE `gc_menu`
  MODIFY `men_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `gc_menu_web`
--
ALTER TABLE `gc_menu_web`
  MODIFY `mw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `gc_modulo`
--
ALTER TABLE `gc_modulo`
  MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `gc_novedad`
--
ALTER TABLE `gc_novedad`
  MODIFY `nov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gc_pagina`
--
ALTER TABLE `gc_pagina`
  MODIFY `pag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `gc_permiso`
--
ALTER TABLE `gc_permiso`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `gc_revista`
--
ALTER TABLE `gc_revista`
  MODIFY `rev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gc_seccion`
--
ALTER TABLE `gc_seccion`
  MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `gc_sede`
--
ALTER TABLE `gc_sede`
  MODIFY `sed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gc_sede_especialidad`
--
ALTER TABLE `gc_sede_especialidad`
  MODIFY `se_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
