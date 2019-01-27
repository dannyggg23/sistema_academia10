-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-01-2019 a las 23:38:03
-- Versión del servidor: 10.2.21-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `escueladel10_dbdel10`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `idalumno` int(11) NOT NULL,
  `cedula_alumno` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombre_alumno` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `genero_alumno` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagen_alumno` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `representante_idrepresentante` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT 1,
  `tipo_sangre_alumno` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `escuela_alumno` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `posicion_alumno` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `peso_alumno` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `talla_alumno` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `informacion_alumno` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`idalumno`, `cedula_alumno`, `nombre_alumno`, `genero_alumno`, `imagen_alumno`, `representante_idrepresentante`, `estado`, `tipo_sangre_alumno`, `escuela_alumno`, `fecha_nacimiento`, `posicion_alumno`, `peso_alumno`, `talla_alumno`, `informacion_alumno`) VALUES
(29, '0504353210', 'Danny Garcia', 'Masculino', 'default.jpg', 1, 1, 'O negativo', 'Isidro ayora', '1993-04-23', 'Delantero', '90', '1.73', 'Danny');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idasistencia` int(11) NOT NULL,
  `asistencia_alumno` tinyint(4) NOT NULL,
  `fecha_asistencia` date NOT NULL,
  `ficha_alumno_idficha_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`idasistencia`, `asistencia_alumno`, `fecha_asistencia`, `ficha_alumno_idficha_alumno`) VALUES
(5, 1, '2019-01-18', 35),
(6, 1, '2019-01-17', 35),
(7, 0, '2019-01-16', 35),
(8, 1, '2019-01-15', 35),
(9, 1, '2019-01-14', 35),
(10, 0, '2019-01-13', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombre_categoria` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion_categoria` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre_categoria`, `descripcion_categoria`, `estado`) VALUES
(1, 'SUB 10', 'EDADES HASTA 10 AÑOS', 1),
(2, 'SUB 11', 'CATEGORIAS HASTA 12 AÑOS', 1),
(3, 'SUB 12', 'CATEGORIAS HASTA 12 AÑOS', 1),
(4, 'Sub 6', 'Sub 6', 1),
(5, 'Sub 8', 'Sub 8', 1),
(6, 'sub 2', 'sub 2', 1),
(7, 'SUB 16 FEMENINO', 'HORARIO NOCTURNO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_productos_servicios`
--

CREATE TABLE `categorias_productos_servicios` (
  `idcategorias_productos_servicios` int(11) NOT NULL,
  `nombre_categoria_productos` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion_categoria_productos` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias_productos_servicios`
--

INSERT INTO `categorias_productos_servicios` (`idcategorias_productos_servicios`, `nombre_categoria_productos`, `descripcion_categoria_productos`, `estado`) VALUES
(1, 'Servicios', 'Servicios', 1),
(2, 'Productos', 'Productos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `idCiudad` int(11) NOT NULL,
  `ciudad` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `IDPROVINCIA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`idCiudad`, `ciudad`, `IDPROVINCIA`) VALUES
(1, 'CUENCA', 1),
(2, 'GIRON', 1),
(3, 'GUALACEO', 1),
(4, 'NABON', 1),
(5, 'PAUTE', 1),
(6, 'PUCARA', 1),
(7, 'SAN FERNANDO', 1),
(8, 'SANTA ISABEL', 1),
(9, 'SIGSIG', 1),
(10, 'OÑA', 1),
(11, 'CHORDELEG', 1),
(12, 'EL PAN', 1),
(13, 'SEVILLA DE ORO', 1),
(14, 'GUACHAPALA', 1),
(15, 'CAMILO PONCE ENRIQUEZ', 1),
(16, 'GUARANDA', 2),
(17, 'CHILLANES', 2),
(18, 'CHIMBO', 2),
(19, 'ECHEANDIA', 2),
(20, 'SAN MIGUEL', 2),
(21, 'CALUMA', 2),
(22, 'LAS NAVES', 2),
(23, 'AZOGUES', 3),
(24, 'BIBLIAN', 3),
(25, 'CAÑAR', 3),
(26, 'LA TRONCAL', 3),
(27, 'EL TAMBO', 3),
(28, 'DÉLEG', 3),
(29, 'SUSCAL', 3),
(30, 'TULCAN', 4),
(31, 'BOLIVAR', 4),
(32, 'ESPEJO', 4),
(33, 'MIRA', 4),
(34, 'MONTUFAR', 4),
(35, 'SAN PEDRO DE HUACA', 4),
(36, 'LATACUNGA', 5),
(37, 'LA MANA', 5),
(38, 'PANGUA', 5),
(39, 'PUJILI', 5),
(40, 'SALCEDO', 5),
(41, 'SAQUISILI', 5),
(42, 'SIGCHOS', 5),
(43, 'RIOBAMBA', 6),
(44, 'ALAUSI', 6),
(45, 'COLTA', 6),
(46, 'CHAMBO', 6),
(47, 'CHUNCHI', 6),
(48, 'GUAMOTE', 6),
(49, 'GUANO', 6),
(50, 'PALLATANGA', 6),
(51, 'PENIPE', 6),
(52, 'CUMANDA', 6),
(53, 'MACHALA', 7),
(54, 'ARENILLAS', 7),
(55, 'ATAHUALPA', 7),
(56, 'BALSAS', 7),
(57, 'CHILLA', 7),
(58, 'EL GUABO', 7),
(59, 'HUAQUILLAS', 7),
(60, 'MARCABELI', 7),
(61, 'PASAJE', 7),
(62, 'PIÑAS', 7),
(63, 'PORTOVELO', 7),
(64, 'SANTA ROSA', 7),
(65, 'ZARUMA', 7),
(66, 'LAS LAJAS', 7),
(67, 'ESMERALDAS', 8),
(68, 'ELOY ALFARO', 8),
(69, 'MUISNE', 8),
(70, 'QUININDÉ', 8),
(71, 'SAN LORENZO', 8),
(72, 'ATACAMES', 8),
(73, 'RIOVERDE', 8),
(74, 'LA CONCORDIA', 8),
(75, 'GUAYAQUIL', 9),
(76, 'ALFREDO BAQUERIZO MORENO (JUJAN)', 9),
(77, 'BALAO', 9),
(78, 'BALZAR', 9),
(79, 'COLIMES', 9),
(80, 'DAULE', 9),
(81, 'DURAN', 9),
(82, 'EL EMPALME', 9),
(83, 'EL TRIUNFO', 9),
(84, 'MILAGRO', 9),
(85, 'NARANJAL', 9),
(86, 'NARANJITO', 9),
(87, 'PALESTINA', 9),
(88, 'PEDRO CARBO', 9),
(89, 'SAMBORONDON', 9),
(90, 'SANTA LUCIA', 9),
(91, 'SALITRE (URBINA JADO)', 9),
(92, 'SAN JACINTO DE YAGUACHI', 9),
(93, 'PLAYAS', 9),
(94, 'SIMON BOLIVAR', 9),
(95, 'CORONEL MARCELINO MARIDUEÑA', 9),
(96, 'LOMAS DE SARGENTILLO', 9),
(97, 'NOBOL', 9),
(98, 'GENERAL ANTONIO ELIZALDE', 9),
(99, 'ISIDRO AYORA', 9),
(100, 'IBARRA', 10),
(101, 'ANTONIO ANTE', 10),
(102, 'COTACACHI', 10),
(103, 'OTAVALO', 10),
(104, 'PIMAMPIRO', 10),
(105, 'SAN MIGUEL DE URCUQUI', 10),
(106, 'LOJA', 11),
(107, 'CALVAS', 11),
(108, 'CATAMAYO', 11),
(109, 'CELICA', 11),
(110, 'CHAGUARPAMBA', 11),
(111, 'ESPINDOLA', 11),
(112, 'GONZANAMA', 11),
(113, 'MACARA', 11),
(114, 'PALTAS', 11),
(115, 'PUYANGO', 11),
(116, 'SARAGURO', 11),
(117, 'SOZORANGA', 11),
(118, 'ZAPOTILLO', 11),
(119, 'PINDAL', 11),
(120, 'QUILANGA', 11),
(121, 'OLMEDO', 11),
(122, 'BABAHOYO', 12),
(123, 'BABA', 12),
(124, 'MONTALVO', 12),
(125, 'PUEBLOVIEJO', 12),
(126, 'QUEVEDO', 12),
(127, 'URDANETA', 12),
(128, 'VENTANAS', 12),
(129, 'VINCES', 12),
(130, 'PALENQUE', 12),
(131, 'BUENA FÉ', 12),
(132, 'VALENCIA', 12),
(133, 'MOCACHE', 12),
(134, 'QUINSALOMA', 12),
(135, 'PORTOVIEJO', 13),
(136, 'BOLIVAR', 13),
(137, 'CHONE', 13),
(138, 'EL CARMEN', 13),
(139, 'FLAVIO ALFARO', 13),
(140, 'JIPIJAPA', 13),
(141, 'JUNIN', 13),
(142, 'MANTA', 13),
(143, 'MONTECRISTI', 13),
(144, 'PAJAN', 13),
(145, 'PICHINCHA', 13),
(146, 'ROCAFUERTE', 13),
(147, 'SANTA ANA', 13),
(148, 'SUCRE', 13),
(149, 'TOSAGUA', 13),
(150, '24 DE MAYO', 13),
(151, 'PEDERNALES', 13),
(152, 'OLMEDO', 13),
(153, 'PUERTO LOPEZ', 13),
(154, 'JAMA', 13),
(155, 'JARAMIJO', 13),
(156, 'SAN VICENTE', 13),
(157, 'MORONA', 14),
(158, 'GUALAQUIZA', 14),
(159, 'LIMON INDANZA', 14),
(160, 'PALORA', 14),
(161, 'SANTIAGO', 14),
(162, 'SUCUA', 14),
(163, 'HUAMBOYA', 14),
(164, 'SAN JUAN BOSCO', 14),
(165, 'TAISHA', 14),
(166, 'LOGROÑO', 14),
(167, 'PABLO SEXTO', 14),
(168, 'TIWINTZA', 14),
(169, 'TENA', 15),
(170, 'ARCHIDONA', 15),
(171, 'EL CHACO', 15),
(172, 'QUIJOS', 15),
(173, 'CARLOS JULIO AROSEMENA TOLA', 15),
(174, 'PASTAZA', 16),
(175, 'MERA', 16),
(176, 'SANTA CLARA', 16),
(177, 'ARAJUNO', 16),
(178, 'QUITO', 17),
(179, 'CAYAMBE', 17),
(180, 'MEJIA', 17),
(181, 'PEDRO MONCAYO', 17),
(182, 'RUMIÑAHUI', 17),
(183, 'SAN MIGUEL DE LOS BANCOS', 17),
(184, 'PEDRO VICENTE MALDONADO', 17),
(185, 'PUERTO QUITO', 17),
(186, 'AMBATO', 18),
(187, 'BAÑOS DE AGUA SANTA', 18),
(188, 'CEVALLOS', 18),
(189, 'MOCHA', 18),
(190, 'PATATE', 18),
(191, 'QUERO', 18),
(192, 'SAN PEDRO DE PELILEO', 18),
(193, 'SANTIAGO DE PILLARO', 18),
(194, 'TISALEO', 18),
(195, 'ZAMORA', 19),
(196, 'CHINCHIPE', 19),
(197, 'NANGARITZA', 19),
(198, 'YACUAMBI', 19),
(199, 'YANTZAZA (YANZATZA)', 19),
(200, 'EL PANGUI', 19),
(201, 'CENTINELA DEL CONDOR', 19),
(202, 'PALANDA', 19),
(203, 'PAQUISHA', 19),
(204, 'SAN CRISTOBAL', 20),
(205, 'ISABELA', 20),
(206, 'SANTA CRUZ', 20),
(207, 'LAGO AGRIO', 21),
(208, 'GONZALO PIZARRO', 21),
(209, 'PUTUMAYO', 21),
(210, 'SHUSHUFINDI', 21),
(211, 'SUCUMBIOS', 21),
(212, 'CASCALES', 21),
(213, 'CUYABENO', 21),
(214, 'ORELLANA', 22),
(215, 'AGUARICO', 22),
(216, 'LA JOYA DE LOS SACHAS', 22),
(217, 'LORETO', 22),
(218, 'SANTO DOMINGO', 23),
(219, 'SANTA ELENA', 24),
(220, 'LA LIBERTAD', 24),
(221, 'SALINAS', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_academia`
--

CREATE TABLE `datos_academia` (
  `iddatos_academia` int(11) NOT NULL,
  `titulo_factura` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_propietario` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `documento_identidad` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion_academia` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono_academia` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `email_academia` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `serie_factura` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `datos_academia`
--

INSERT INTO `datos_academia` (`iddatos_academia`, `titulo_factura`, `nombre_propietario`, `documento_identidad`, `direccion_academia`, `telefono_academia`, `email_academia`, `serie_factura`, `numero_factura`) VALUES
(1, 'LA ESCUELA DEL 10', 'Mg. Pablo Poveda', '1803610920', 'Ambato', '0996269763', 'pablopoveda@escueladel10.com', 12346, 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pago`
--

CREATE TABLE `detalle_pago` (
  `iddetalle_pago` int(11) NOT NULL,
  `pago_idpago` int(11) NOT NULL,
  `ficha_alumno_idficha_alumno` int(11) DEFAULT NULL,
  `numero_meses_pago` int(11) NOT NULL,
  `precio_pago` decimal(11,2) NOT NULL,
  `descuento_pago` decimal(11,2) NOT NULL,
  `productos_servicios_idproductos_servicios` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_pago`
--

INSERT INTO `detalle_pago` (`iddetalle_pago`, `pago_idpago`, `ficha_alumno_idficha_alumno`, `numero_meses_pago`, `precio_pago`, `descuento_pago`, `productos_servicios_idproductos_servicios`) VALUES
(34, 30, 35, 1, '20.00', '0.00', 2),
(35, 31, 35, 1, '25.00', '0.00', 1),
(36, 32, 35, 1, '25.00', '0.00', 1),
(37, 33, 35, 1, '25.00', '0.00', 1);

--
-- Disparadores `detalle_pago`
--
DELIMITER $$
CREATE TRIGGER `tr_updAccesoPago` AFTER INSERT ON `detalle_pago` FOR EACH ROW BEGIN
IF NEW.productos_servicios_idproductos_servicios=1 THEN 
UPDATE ficha_alumno set ficha_alumno.fecha_acceso = DATE(DATE_ADD(ficha_alumno.fecha_acceso, INTERVAL NEW.numero_meses_pago MONTH)) WHERE ficha_alumno.idficha_alumno=NEW.ficha_alumno_idficha_alumno; 
ELSEIF NEW.productos_servicios_idproductos_servicios=2 THEN
UPDATE ficha_alumno set ficha_alumno.inscripcion=1 WHERE ficha_alumno.idficha_alumno=NEW.ficha_alumno_idficha_alumno;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenador`
--

CREATE TABLE `entrenador` (
  `identrenador` int(11) NOT NULL,
  `cedula_entrenador` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombre_entrenador` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion_entrenador` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email_entrenador` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono_entrenador` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celular_entrenador` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagen_entrenador` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usuario` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `clave` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(4) DEFAULT 1,
  `token` text COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `genero_entrenador` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `titulo_entrenador` varchar(240) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fechanacimiento_entrenador` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `entrenador`
--

INSERT INTO `entrenador` (`identrenador`, `cedula_entrenador`, `nombre_entrenador`, `direccion_entrenador`, `email_entrenador`, `telefono_entrenador`, `celular_entrenador`, `imagen_entrenador`, `usuario`, `clave`, `estado`, `token`, `descripcion`, `genero_entrenador`, `titulo_entrenador`, `fechanacimiento_entrenador`) VALUES
(1, '1802707511', 'Andres Sanchez Paez', 'av cevallos', 'a.sanchez@escueladel10.com', '098790024', '0987900242', '1538401096.jpg', '1802707511', '1802707511', 1, 'd615f9cb-ab77-4f53-8fe7-ebaf69b7cc79', 'assasa', 'Masculino', 'Licenciado', '1982-01-01'),
(2, '1803610920', 'Alex Fiallos', 'av cevallos', 'a.fiallos@escueladel10.com', '098790024', '0987900242', '1538401293.jpg', '1803610920', '1803610920', 1, '', '', 'Masculino', 'Licenciado', '1998-01-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_alumno`
--

CREATE TABLE `ficha_alumno` (
  `idficha_alumno` int(11) NOT NULL,
  `numeroFicha_alumno` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `fechaApertura_alumno` date NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `alumno_idalumno` int(11) NOT NULL,
  `fecha_acceso` date DEFAULT NULL,
  `sucursal_categorias_idsucursal_categorias` int(11) NOT NULL,
  `descuento_ficha_alumno` int(11) DEFAULT NULL,
  `inscripcion` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ficha_alumno`
--

INSERT INTO `ficha_alumno` (`idficha_alumno`, `numeroFicha_alumno`, `fechaApertura_alumno`, `estado`, `alumno_idalumno`, `fecha_acceso`, `sucursal_categorias_idsucursal_categorias`, `descuento_ficha_alumno`, `inscripcion`) VALUES
(35, '0504353210', '2018-09-01', 1, 29, '2019-03-05', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_entrenador`
--

CREATE TABLE `ficha_entrenador` (
  `idficha_entrenador` int(11) NOT NULL,
  `fechaApertura_entrenador` date NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `entrenador_identrenador` int(11) NOT NULL,
  `sucursal_categorias_idsucursal_categorias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ficha_entrenador`
--

INSERT INTO `ficha_entrenador` (`idficha_entrenador`, `fechaApertura_entrenador`, `estado`, `entrenador_identrenador`, `sucursal_categorias_idsucursal_categorias`) VALUES
(1, '2018-10-01', 1, 1, 3),
(2, '2018-10-01', 1, 2, 4),
(3, '2018-10-29', 1, 1, 6),
(4, '2019-01-15', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idhorario` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idhorario`, `nombre`, `hora_inicio`, `hora_fin`, `estado`) VALUES
(1, 'LUNES-MIERCOLES-VIERNES', '16:00:00', '17:30:00', 1),
(2, 'MARTES-JUEVES-SABADOS', '16:00:00', '17:30:00', 1),
(3, 'SABADO Y DOMINGO', '08:00:00', '10:00:00', 1),
(4, 'SUB 16 FEMENINO', '18:30:00', '20:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idimagenes` int(11) NOT NULL,
  `imagen` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  `noticias_idnoticias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_app`
--

CREATE TABLE `imagenes_app` (
  `idimagenes_app` int(11) NOT NULL,
  `imagen` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes_app`
--

INSERT INTO `imagenes_app` (`idimagenes_app`, `imagen`, `estado`) VALUES
(1, '1539347048.jpg', 1),
(2, '1539347064.jpg', 1),
(3, '1539347077.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idnoticias` int(11) NOT NULL,
  `titulo` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagen` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `sucursal_categorias_idsucursal_categorias` int(11) DEFAULT NULL,
  `todos` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idnoticias`, `titulo`, `fecha`, `descripcion`, `imagen`, `estado`, `sucursal_categorias_idsucursal_categorias`, `todos`) VALUES
(1, 'sefwwe', '2019-01-16', 'werwerwer', '1547586178.jpg', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `idpago` int(11) NOT NULL,
  `representante_idrepresentante` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_documento` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `serie_comprobante` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `num_comprobante` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `impuesto` int(11) NOT NULL,
  `subtotal` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`idpago`, `representante_idrepresentante`, `usuario_idusuario`, `fecha`, `total`, `tipo_documento`, `estado`, `serie_comprobante`, `num_comprobante`, `impuesto`, `subtotal`) VALUES
(30, 2, 5, '2018-12-05', '22.4', 'Factura', 'Aceptado', '12346', '38', 12, '20'),
(31, 2, 5, '2018-12-11', '28', 'Factura', 'Aceptado', '12346', '39', 12, '25'),
(32, 2, 5, '2018-12-12', '28', 'Factura', 'Aceptado', '12346', '40', 12, '25'),
(33, 1, 5, '2019-01-15', '28', 'Factura', 'Aceptado', '12346', '41', 12, '25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_deposito`
--

CREATE TABLE `pagos_deposito` (
  `idpagos_deposito` int(11) NOT NULL,
  `imagen` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `ficha_alumno_idficha_alumno` int(11) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estado_aprobada` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'Sucursales'),
(2, 'Categorias'),
(3, 'Ficha-Alumno'),
(4, 'Ficha-Entrenador'),
(5, 'Pagos'),
(6, 'Configuracion'),
(7, 'Escritorio'),
(8, 'Noticias'),
(9, 'Productos-Servicios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_servicios`
--

CREATE TABLE `productos_servicios` (
  `idproductos_servicios` int(11) NOT NULL,
  `nombre_productos_servicios` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precio_productos_servicios` decimal(11,2) DEFAULT NULL,
  `descripcion_productos_servicios` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `categorias_productos_servicios_idcategorias_productos_servicios` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos_servicios`
--

INSERT INTO `productos_servicios` (`idproductos_servicios`, `nombre_productos_servicios`, `precio_productos_servicios`, `descripcion_productos_servicios`, `categorias_productos_servicios_idcategorias_productos_servicios`, `estado`) VALUES
(1, 'MENSUALIDAD', '25.00', 'Mensualidades para los alumnos ', 1, 1),
(2, 'INSCRIPCION', '20.00', 'INSCRIPCIÓN PARA LOS ALUMNOS ', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `idProvincia` int(11) NOT NULL,
  `provincia` varchar(45) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`idProvincia`, `provincia`) VALUES
(1, 'AZUAY'),
(2, 'BOLIVAR'),
(3, 'CAÑAR'),
(4, 'CARCHI'),
(5, 'COTOPAXI'),
(6, 'CHIMBORAZO'),
(7, 'EL ORO'),
(8, 'ESMERALDAS'),
(9, 'GUAYAS'),
(10, 'IMBABURA'),
(11, 'LOJA'),
(12, 'LOS RIOS'),
(13, 'MANABI'),
(14, 'MORONA SANTIAGO'),
(15, 'NAPO'),
(16, 'PASTAZA'),
(17, 'PICHINCHA'),
(18, 'TUNGURAHUA'),
(19, 'ZAMORA CHINCHIPE'),
(20, 'GALAPAGOS'),
(21, 'SUCUMBIOS'),
(22, 'ORELLANA'),
(23, 'SANTO DOMINGO DE LOS TSACHILAS'),
(24, 'SANTA ELENA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representante`
--

CREATE TABLE `representante` (
  `idrepresentante` int(11) NOT NULL,
  `cedula_representante` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_representante` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `email_representante` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion_representante` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono_representante` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `usuario` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `clave` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` tinyint(4) DEFAULT 1,
  `token` text COLLATE utf8_spanish2_ci DEFAULT NULL,
  `genero_representante` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_nacimiento_representante` date DEFAULT NULL,
  `parentesco_respresentante` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `celular_representante` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `lugar_trabajo_representante` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cedula_conyugue_representante` varchar(13) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombre_conyugue_representante` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `barrio_representante` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciudad_representante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `representante`
--

INSERT INTO `representante` (`idrepresentante`, `cedula_representante`, `nombre_representante`, `email_representante`, `direccion_representante`, `telefono_representante`, `usuario`, `clave`, `estado`, `token`, `genero_representante`, `fecha_nacimiento_representante`, `parentesco_respresentante`, `celular_representante`, `lugar_trabajo_representante`, `cedula_conyugue_representante`, `nombre_conyugue_representante`, `barrio_representante`, `ciudad_representante`) VALUES
(1, '1803610920', 'Fausto Viscaino', 'faustov_zh1@hotmail.com', 'Enrique gallo y Av. los chasquis', '098765445', '1803610920', '1803610920', 1, NULL, 'Femenino', '1982-04-30', 'Padre', '098765456', 'UNIANDES', '1803688652', 'Gabriela Amancha', 'La pradera', 186),
(2, '0504353211', 'GLORIA GALARZA', 'dannyggg23@gmail.com', 'VERTIENTES DEL COTOPAXI LATACUNGA', '099626976', '0504353211', '0504353211', 1, '', 'Masculino', '1978-01-12', 'MADRE', '0996269763', 'EL SALTO', '0504353213', 'GUSTAVO GARCIA', 'VERTIENTES DEL COTOPAXI', 36),
(3, '1802460103', 'POVEDA PABLO', 'pablopoveda_10@hotmail.com', 'los girasoles y av. los guaytambos', '6001850', '1802460103', '1802460103', 1, NULL, 'Masculino', '1974-11-20', 'padre', '0995001812', 'Municipio de Ambato', '1802990646', 'LEON MARIA JOSE', 'Ficoa', 186),
(4, '1802259943', 'ALVARO CHATO', 'joseleon85@hotmail.com', 'COLEGIO PIO X', '', '1802259943', '1802259943', 1, NULL, 'Masculino', '1980-02-19', 'PADRE', '0984216949', 'PROFESIONAL INDEPENDIENTE', '1802342186', 'MARTHA HEREDIA', 'ATOCHA', 186),
(5, '0000000076', 'Sin representante', 'Sin representante', 'Sin representante', NULL, 'representante', 'representante', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `idsucursal` int(11) NOT NULL,
  `nombre_sucursal` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `direrccion_ducursal` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono_sucursal` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `encargado_sucursal` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad_idCiudad` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `imagen` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `latitud_sucursal` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `longitud_sucursal` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`idsucursal`, `nombre_sucursal`, `direrccion_ducursal`, `telefono_sucursal`, `encargado_sucursal`, `ciudad_idCiudad`, `estado`, `imagen`, `latitud_sucursal`, `longitud_sucursal`) VALUES
(1, 'Futgol', 'Rodrigo Pachano y Dalias', '0980224517', 'Mg. Pablo Poveda', 186, 1, '1538199693.jpg', '-0.931513', '-78.6233596'),
(2, 'Futbol City', 'Av. Los Chasquis y Velasco Ibarra', '0983384885', 'Mg. Pablo Poveda', 186, 1, '1538199793.jpg', '1.262755', '78.625113');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal_categorias`
--

CREATE TABLE `sucursal_categorias` (
  `idsucursal_categorias` int(11) NOT NULL,
  `sucursal_idsucursal` int(11) NOT NULL,
  `categoria_idcategoria` int(11) NOT NULL,
  `horario_idhorario` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `disponible` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `sucursal_categorias`
--

INSERT INTO `sucursal_categorias` (`idsucursal_categorias`, `sucursal_idsucursal`, `categoria_idcategoria`, `horario_idhorario`, `estado`, `disponible`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 1, 2, 1, 1, 0),
(3, 2, 1, 1, 1, 1),
(4, 2, 5, 2, 1, 1),
(5, 1, 3, 3, 1, 0),
(6, 2, 6, 2, 1, 1),
(7, 1, 7, 4, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre_usuario` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `cedula_usuario` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion_usuario` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono_usuario` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `celular_usuario` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email_usuario` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `cargo_usuario` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `login_usuario` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `clave_usuario` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen_usuario` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `token` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre_usuario`, `cedula_usuario`, `direccion_usuario`, `telefono_usuario`, `celular_usuario`, `email_usuario`, `cargo_usuario`, `login_usuario`, `clave_usuario`, `imagen_usuario`, `estado`, `token`) VALUES
(5, 'admin', '0000000000', 'admin', '0000000000', '0000000000', 'admin', 'admin', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '1538194716.jpg', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `permiso_idpermiso` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `permiso_idpermiso`, `usuario_idusuario`) VALUES
(88, 1, 5),
(89, 2, 5),
(90, 3, 5),
(91, 4, 5),
(92, 5, 5),
(93, 6, 5),
(94, 7, 5),
(95, 8, 5),
(96, 9, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`idalumno`),
  ADD KEY `fk_alumno_representante1_idx` (`representante_idrepresentante`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idasistencia`),
  ADD KEY `fk_asistencia_ficha_alumno1_idx` (`ficha_alumno_idficha_alumno`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `categorias_productos_servicios`
--
ALTER TABLE `categorias_productos_servicios`
  ADD PRIMARY KEY (`idcategorias_productos_servicios`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`idCiudad`),
  ADD KEY `fk_ciudad_provincia_idx` (`IDPROVINCIA`);

--
-- Indices de la tabla `datos_academia`
--
ALTER TABLE `datos_academia`
  ADD PRIMARY KEY (`iddatos_academia`);

--
-- Indices de la tabla `detalle_pago`
--
ALTER TABLE `detalle_pago`
  ADD PRIMARY KEY (`iddetalle_pago`),
  ADD KEY `fk_detalle_pago_ficha_alumno1_idx` (`ficha_alumno_idficha_alumno`),
  ADD KEY `fk_detalle_pago_pago1_idx` (`pago_idpago`),
  ADD KEY `fk_detalle_pago_productos_servicios1_idx` (`productos_servicios_idproductos_servicios`);

--
-- Indices de la tabla `entrenador`
--
ALTER TABLE `entrenador`
  ADD PRIMARY KEY (`identrenador`),
  ADD UNIQUE KEY `cedula_entrenador` (`cedula_entrenador`);

--
-- Indices de la tabla `ficha_alumno`
--
ALTER TABLE `ficha_alumno`
  ADD PRIMARY KEY (`idficha_alumno`),
  ADD UNIQUE KEY `numeroFicha_alumno` (`numeroFicha_alumno`),
  ADD KEY `fk_ficha_alumno_alumno1_idx` (`alumno_idalumno`),
  ADD KEY `fk_ficha_alumno_sucursal_categorias1_idx` (`sucursal_categorias_idsucursal_categorias`);

--
-- Indices de la tabla `ficha_entrenador`
--
ALTER TABLE `ficha_entrenador`
  ADD PRIMARY KEY (`idficha_entrenador`),
  ADD KEY `fk_ficha_entrenador_entrenador1_idx` (`entrenador_identrenador`),
  ADD KEY `fk_ficha_entrenador_sucursal_categorias1_idx` (`sucursal_categorias_idsucursal_categorias`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idhorario`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idimagenes`),
  ADD KEY `fk_imagenes_noticias1_idx` (`noticias_idnoticias`);

--
-- Indices de la tabla `imagenes_app`
--
ALTER TABLE `imagenes_app`
  ADD PRIMARY KEY (`idimagenes_app`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idnoticias`),
  ADD KEY `fk_noticias_sucursal_categorias1_idx` (`sucursal_categorias_idsucursal_categorias`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idpago`),
  ADD KEY `fk_pago_representante1_idx` (`representante_idrepresentante`),
  ADD KEY `fk_pago_usuario1_idx` (`usuario_idusuario`);

--
-- Indices de la tabla `pagos_deposito`
--
ALTER TABLE `pagos_deposito`
  ADD PRIMARY KEY (`idpagos_deposito`),
  ADD KEY `fk_habilidad_ficha_alumno1_idx` (`ficha_alumno_idficha_alumno`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `productos_servicios`
--
ALTER TABLE `productos_servicios`
  ADD PRIMARY KEY (`idproductos_servicios`),
  ADD KEY `fk_productos_servicios_categorias_productos_servicios1_idx` (`categorias_productos_servicios_idcategorias_productos_servicios`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`idProvincia`);

--
-- Indices de la tabla `representante`
--
ALTER TABLE `representante`
  ADD PRIMARY KEY (`idrepresentante`),
  ADD UNIQUE KEY `cedula_representante` (`cedula_representante`),
  ADD KEY `fk_representante_ciudad1_idx` (`ciudad_representante`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`idsucursal`),
  ADD KEY `fk_sucursal_ciudad1_idx` (`ciudad_idCiudad`);

--
-- Indices de la tabla `sucursal_categorias`
--
ALTER TABLE `sucursal_categorias`
  ADD PRIMARY KEY (`idsucursal_categorias`),
  ADD KEY `fk_sucursal_categorias_sucursal1_idx` (`sucursal_idsucursal`),
  ADD KEY `fk_sucursal_categorias_categoria1_idx` (`categoria_idcategoria`),
  ADD KEY `fk_sucursal_categorias_horario1_idx` (`horario_idhorario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `fk_usuario_permiso_permiso1_idx` (`permiso_idpermiso`),
  ADD KEY `fk_usuario_permiso_usuario1_idx` (`usuario_idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `idalumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idasistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categorias_productos_servicios`
--
ALTER TABLE `categorias_productos_servicios`
  MODIFY `idcategorias_productos_servicios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `idCiudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT de la tabla `datos_academia`
--
ALTER TABLE `datos_academia`
  MODIFY `iddatos_academia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_pago`
--
ALTER TABLE `detalle_pago`
  MODIFY `iddetalle_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `entrenador`
--
ALTER TABLE `entrenador`
  MODIFY `identrenador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ficha_alumno`
--
ALTER TABLE `ficha_alumno`
  MODIFY `idficha_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `ficha_entrenador`
--
ALTER TABLE `ficha_entrenador`
  MODIFY `idficha_entrenador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idimagenes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes_app`
--
ALTER TABLE `imagenes_app`
  MODIFY `idimagenes_app` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idnoticias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `idpago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `pagos_deposito`
--
ALTER TABLE `pagos_deposito`
  MODIFY `idpagos_deposito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos_servicios`
--
ALTER TABLE `productos_servicios`
  MODIFY `idproductos_servicios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `idProvincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `representante`
--
ALTER TABLE `representante`
  MODIFY `idrepresentante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `idsucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sucursal_categorias`
--
ALTER TABLE `sucursal_categorias`
  MODIFY `idsucursal_categorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_alumno_representante1` FOREIGN KEY (`representante_idrepresentante`) REFERENCES `representante` (`idrepresentante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `fk_ciudad_provincia` FOREIGN KEY (`IDPROVINCIA`) REFERENCES `provincia` (`idProvincia`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
