-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2023 a las 21:14:45
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `capacitacion_continua`
--
CREATE DATABASE IF NOT EXISTS `capacitacion_continua` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `capacitacion_continua`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_administrador` int(11) NOT NULL,
  `nombre_administrador` varchar(30) NOT NULL,
  `apellido_administrador` varchar(50) NOT NULL,
  `dni_administrador` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_administrador`, `nombre_administrador`, `apellido_administrador`, `dni_administrador`, `id_usuario`) VALUES
(1, 'administrador', 'administrador', '12345678', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitaciones`
--

CREATE TABLE `capacitaciones` (
  `id_capacitacion` int(11) NOT NULL,
  `id_institucion` int(11) NOT NULL,
  `id_tipo_educacion` int(11) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `nombre_capacitacion` text NOT NULL,
  `fecha_inicio_capacitacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `dias_horarios_capacitacion` text NOT NULL,
  `fecha_fin_capacitacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `modalidad_capacitacion` varchar(20) NOT NULL,
  `lugar_o_plataforma_capacitacion` text NOT NULL,
  `estado_respuesta` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `capacitaciones`
--

INSERT INTO `capacitaciones` (`id_capacitacion`, `id_institucion`, `id_tipo_educacion`, `id_especialidad`, `nombre_capacitacion`, `fecha_inicio_capacitacion`, `dias_horarios_capacitacion`, `fecha_fin_capacitacion`, `modalidad_capacitacion`, `lugar_o_plataforma_capacitacion`, `estado_respuesta`) VALUES
(3, 1, 1, 1, 'Equipos de Networking (Redes LAN – WAN)', '2023-09-02 18:01:07', 'Lunes 13:00', '2023-10-09 18:01:07', 'Virtual', 'Zoom', 1),
(4, 1, 1, 1, 'Administración del Aula por Software (símil E-Learning Class-Netbooks)', '2023-10-22 14:00:00', 'Martes y jueves 09:00', '2023-11-02 14:00:00', 'Híbrido', 'Martes: Juan b Justo 4287 - Jueves: Meet', 0),
(5, 1, 1, 1, 'Impresión 3D', '2023-10-26 03:00:00', 'Martes y Miércoles 20:00', '2023-10-25 03:00:00', 'Virtual', 'Meet', 0),
(9, 2, 1, 1, 'Reparación de PC', '2023-10-20 03:00:00', 'asdas', '2023-10-25 03:00:00', 'Virtual', 'asda', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_capacitaciones`
--

CREATE TABLE `detalle_capacitaciones` (
  `id_detalle_capacitacion` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_capacitacion` int(11) NOT NULL,
  `estado_capacitacion` tinyint(1) NOT NULL,
  `estado_respuesta` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_capacitaciones`
--

INSERT INTO `detalle_capacitaciones` (`id_detalle_capacitacion`, `id_docente`, `id_capacitacion`, `estado_capacitacion`, `estado_respuesta`) VALUES
(1, 1, 3, 1, 1),
(12, 1, 5, 0, 0),
(15, 2, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_docente`
--

CREATE TABLE `detalle_docente` (
  `id_detalle_docente` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_institucion` int(11) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `estado_validacion_docente` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_docente`
--

INSERT INTO `detalle_docente` (`id_detalle_docente`, `id_docente`, `id_institucion`, `id_especialidad`, `estado_validacion_docente`) VALUES
(3, 1, 1, 1, 1),
(6, 2, 1, 1, 1),
(7, 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL,
  `nombre_docente` varchar(30) NOT NULL,
  `apellido_docente` varchar(40) NOT NULL,
  `dni_docente` varchar(8) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `nombre_docente`, `apellido_docente`, `dni_docente`, `id_usuario`) VALUES
(1, 'Paola', 'Flament', '12345678', 3),
(2, 'Pablo', 'Abdala', '23456789', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id_especialidad` int(11) NOT NULL,
  `nombre_especialidad` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id_especialidad`, `nombre_especialidad`) VALUES
(1, 'Informática'),
(2, 'Electrónica'),
(3, 'Química'),
(4, 'Electromecánica'),
(5, 'Construcciones'),
(6, 'Alimentos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones`
--

CREATE TABLE `instituciones` (
  `id_institucion` int(11) NOT NULL,
  `nombre_institucion` varchar(40) NOT NULL,
  `cue_institucion` varchar(9) NOT NULL,
  `domicilio_institucion` varchar(30) NOT NULL,
  `id_localidad` int(11) NOT NULL,
  `telefono_institucion` varchar(20) NOT NULL,
  `id_representante` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado_validacion_institucion` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `instituciones`
--

INSERT INTO `instituciones` (`id_institucion`, `nombre_institucion`, `cue_institucion`, `domicilio_institucion`, `id_localidad`, `telefono_institucion`, `id_representante`, `id_usuario`, `estado_validacion_institucion`) VALUES
(1, 'EESTN5 Amancio Williams', '060622400', 'JUAN B. JUSTO 4287', 1, '223 472-2408', 1, 2, 1),
(2, 'EESTN3 Domingo Faustino Sarmiento', '060597100', '14 DE JULIO 2550', 1, '223 495-0285', 2, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `id_localidad` int(11) NOT NULL,
  `cp_localidad` varchar(10) NOT NULL,
  `nombre_localidad` varchar(30) NOT NULL,
  `id_provincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`id_localidad`, `cp_localidad`, `nombre_localidad`, `id_provincia`) VALUES
(1, '7600', 'Mar del Plata', 1),
(2, '7607', 'Miramar', 1),
(3, '7174', 'Coronel Vidal', 1),
(4, '7609', 'Mar Chiquita', 1),
(5, '7605', 'Mechongué', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id_provincia` int(11) NOT NULL,
  `nombre_provincia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id_provincia`, `nombre_provincia`) VALUES
(1, 'Buenos Aires'),
(2, 'CABA'),
(3, 'Catamarca'),
(4, 'Chaco'),
(5, 'Chubut'),
(6, 'Córdoba'),
(7, 'Corrientes'),
(8, 'Entre Ríos'),
(9, 'Formosa'),
(10, 'Jujuy'),
(11, 'La Pampa'),
(12, 'La Rioja'),
(13, 'Mendoza'),
(14, 'Misiones'),
(15, 'Neuquén'),
(16, 'Río Negro'),
(17, 'Salta'),
(18, 'San Juan'),
(19, 'San Luis'),
(20, 'Santa Cruz'),
(21, 'Santa Fe'),
(22, 'Santiago del Estero'),
(23, 'Tierra del Fuego'),
(24, 'Tucumán');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantes_institucionales`
--

CREATE TABLE `representantes_institucionales` (
  `id_representante` int(11) NOT NULL,
  `nombre_representante` varchar(30) NOT NULL,
  `apellido_representante` varchar(50) NOT NULL,
  `dni_representante` varchar(8) NOT NULL,
  `telefono_representante` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `representantes_institucionales`
--

INSERT INTO `representantes_institucionales` (`id_representante`, `nombre_representante`, `apellido_representante`, `dni_representante`, `telefono_representante`) VALUES
(1, 'Claudia', 'Cajaravilla', '12345678', '2236123456'),
(2, 'Martín', 'Villarroel', '12345678', '2236123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_docentes`
--

CREATE TABLE `respuestas_docentes` (
  `id_respuesta_docente` int(11) NOT NULL,
  `id_detalle_capacitacion` int(11) NOT NULL,
  `respuesta_contribucion` text NOT NULL,
  `respuesta_calidad` text NOT NULL,
  `respuesta_multiplicador` text NOT NULL,
  `respuesta_acompanamiento` text NOT NULL,
  `sugerencia` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `respuestas_docentes`
--

INSERT INTO `respuestas_docentes` (`id_respuesta_docente`, `id_detalle_capacitacion`, `respuesta_contribucion`, `respuesta_calidad`, `respuesta_multiplicador`, `respuesta_acompanamiento`, `sugerencia`) VALUES
(4, 1, 'Probablemente si', 'Si', 'Indeciso', 'Probablemente no', 'Más práctica'),
(7, 15, 'Probablemente no', 'No', 'Probablemente si', 'Indeciso', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_institucion`
--

CREATE TABLE `respuestas_institucion` (
  `id_respuesta_institucion` int(11) NOT NULL,
  `id_capacitacion` int(11) NOT NULL,
  `respuesta_realizacion` text NOT NULL,
  `respuesta_aplicacion` text NOT NULL,
  `respuesta_continuar` text NOT NULL,
  `respuesta_replica` text NOT NULL,
  `sugerencia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `respuestas_institucion`
--

INSERT INTO `respuestas_institucion` (`id_respuesta_institucion`, `id_capacitacion`, `respuesta_realizacion`, `respuesta_aplicacion`, `respuesta_continuar`, `respuesta_replica`, `sugerencia`) VALUES
(2, 3, 'Indeciso', 'Indeciso', 'Indeciso', 'Indeciso', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_educacion`
--

CREATE TABLE `tipos_educacion` (
  `id_tipo_educacion` int(11) NOT NULL,
  `desc_tipo_educacion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipos_educacion`
--

INSERT INTO `tipos_educacion` (`id_tipo_educacion`, `desc_tipo_educacion`) VALUES
(1, 'Secundaria técnica'),
(2, 'Tecnicatura superior'),
(3, 'Formación Profesional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuarios`
--

CREATE TABLE `tipo_usuarios` (
  `id_tipo_usuario` int(11) NOT NULL,
  `desc_tipo_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_usuarios`
--

INSERT INTO `tipo_usuarios` (`id_tipo_usuario`, `desc_tipo_usuario`) VALUES
(1, 'Administrador'),
(2, 'Docente'),
(3, 'Institucion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email_usuario` varchar(50) NOT NULL,
  `contrasena_usuario` text NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email_usuario`, `contrasena_usuario`, `id_tipo_usuario`) VALUES
(1, 'admin@gmail.com', 'admin', 1),
(2, 'escuelat5@gmail.com', 'escuelat5', 3),
(3, 'docentet5@gmail.com', 'docentet5', 2),
(4, 'escuelat3@gmail.com', 'escuelat3', 3),
(5, 'pablo@gmail.com', 'pablo', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_administrador`),
  ADD KEY `FK_administradores_usuarios` (`id_usuario`);

--
-- Indices de la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  ADD PRIMARY KEY (`id_capacitacion`),
  ADD KEY `FK_capacitaciones_instituciones` (`id_institucion`),
  ADD KEY `FK_capacitaciones_tEducacion` (`id_tipo_educacion`),
  ADD KEY `FK_Capacitaciones_Especialidad` (`id_especialidad`);

--
-- Indices de la tabla `detalle_capacitaciones`
--
ALTER TABLE `detalle_capacitaciones`
  ADD PRIMARY KEY (`id_detalle_capacitacion`),
  ADD KEY `FK_dCapacitaciones_docentes` (`id_docente`),
  ADD KEY `FK_dCapacitaciones_capacitaciones` (`id_capacitacion`);

--
-- Indices de la tabla `detalle_docente`
--
ALTER TABLE `detalle_docente`
  ADD PRIMARY KEY (`id_detalle_docente`),
  ADD KEY `FK_dDocente_Docentes` (`id_docente`),
  ADD KEY `FK_dDocente_instituciones` (`id_institucion`),
  ADD KEY `FK_dDocente_especialidades` (`id_especialidad`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`),
  ADD KEY `FK_docentes_usuarios` (`id_usuario`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD PRIMARY KEY (`id_institucion`),
  ADD KEY `FK_instituciones_localidades` (`id_localidad`),
  ADD KEY `FK_instituciones_representantes` (`id_representante`),
  ADD KEY `FK_instituciones_usuarios` (`id_usuario`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id_localidad`),
  ADD KEY `FK_localidades_provincias` (`id_provincia`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id_provincia`);

--
-- Indices de la tabla `representantes_institucionales`
--
ALTER TABLE `representantes_institucionales`
  ADD PRIMARY KEY (`id_representante`);

--
-- Indices de la tabla `respuestas_docentes`
--
ALTER TABLE `respuestas_docentes`
  ADD PRIMARY KEY (`id_respuesta_docente`),
  ADD KEY `id_detalle_capacitacion` (`id_detalle_capacitacion`);

--
-- Indices de la tabla `respuestas_institucion`
--
ALTER TABLE `respuestas_institucion`
  ADD PRIMARY KEY (`id_respuesta_institucion`),
  ADD KEY `FK_Respuestas_Capacitacion` (`id_capacitacion`);

--
-- Indices de la tabla `tipos_educacion`
--
ALTER TABLE `tipos_educacion`
  ADD PRIMARY KEY (`id_tipo_educacion`);

--
-- Indices de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `FK_usuarios_tipo` (`id_tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  MODIFY `id_capacitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalle_capacitaciones`
--
ALTER TABLE `detalle_capacitaciones`
  MODIFY `id_detalle_capacitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `detalle_docente`
--
ALTER TABLE `detalle_docente`
  MODIFY `id_detalle_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id_localidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `representantes_institucionales`
--
ALTER TABLE `representantes_institucionales`
  MODIFY `id_representante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `respuestas_docentes`
--
ALTER TABLE `respuestas_docentes`
  MODIFY `id_respuesta_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `respuestas_institucion`
--
ALTER TABLE `respuestas_institucion`
  MODIFY `id_respuesta_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipos_educacion`
--
ALTER TABLE `tipos_educacion`
  MODIFY `id_tipo_educacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_usuarios`
--
ALTER TABLE `tipo_usuarios`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `FK_administradores_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `capacitaciones`
--
ALTER TABLE `capacitaciones`
  ADD CONSTRAINT `FK_Capacitaciones_Especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_capacitaciones_instituciones` FOREIGN KEY (`id_institucion`) REFERENCES `instituciones` (`id_institucion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_capacitaciones_tEducacion` FOREIGN KEY (`id_tipo_educacion`) REFERENCES `tipos_educacion` (`id_tipo_educacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_capacitaciones`
--
ALTER TABLE `detalle_capacitaciones`
  ADD CONSTRAINT `FK_dCapacitaciones_capacitaciones` FOREIGN KEY (`id_capacitacion`) REFERENCES `capacitaciones` (`id_capacitacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_dCapacitaciones_docentes` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_docente`
--
ALTER TABLE `detalle_docente`
  ADD CONSTRAINT `FK_dDocente_Docentes` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_dDocente_especialidades` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_dDocente_instituciones` FOREIGN KEY (`id_institucion`) REFERENCES `instituciones` (`id_institucion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `FK_docentes_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD CONSTRAINT `FK_instituciones_localidades` FOREIGN KEY (`id_localidad`) REFERENCES `localidades` (`id_localidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_instituciones_representantes` FOREIGN KEY (`id_representante`) REFERENCES `representantes_institucionales` (`id_representante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_instituciones_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD CONSTRAINT `FK_localidades_provincias` FOREIGN KEY (`id_provincia`) REFERENCES `provincias` (`id_provincia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuestas_docentes`
--
ALTER TABLE `respuestas_docentes`
  ADD CONSTRAINT `respuestas_docentes_ibfk_1` FOREIGN KEY (`id_detalle_capacitacion`) REFERENCES `detalle_capacitaciones` (`id_detalle_capacitacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuestas_institucion`
--
ALTER TABLE `respuestas_institucion`
  ADD CONSTRAINT `FK_Respuestas_Capacitacion` FOREIGN KEY (`id_capacitacion`) REFERENCES `capacitaciones` (`id_capacitacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_usuarios_tipo` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuarios` (`id_tipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
