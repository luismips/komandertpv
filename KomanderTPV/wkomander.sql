-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-06-2013 a las 10:41:38
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `empty`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE IF NOT EXISTS `articulos` (
  `id_articulo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  `cod_rapido` varchar(45) CHARACTER SET latin1 NOT NULL,
  `abreviatura` varchar(45) CHARACTER SET latin1 NOT NULL,
  `imagen` text CHARACTER SET latin1,
  `en_tarifa` varchar(1) CHARACTER SET latin1 NOT NULL,
  `costo` decimal(10,2) unsigned NOT NULL,
  `pvp` decimal(10,2) unsigned DEFAULT NULL,
  `cargo_llevar` decimal(10,2) DEFAULT '0.00',
  `tipo_iva` decimal(10,2) unsigned NOT NULL,
  `cod_barra` text CHARACTER SET latin1,
  `descripcion` varchar(45) CHARACTER SET latin1 NOT NULL,
  `tiempo_servicio` int(10) unsigned NOT NULL,
  `id_familia` int(11) unsigned NOT NULL,
  `orden` int(11) unsigned NOT NULL,
  `posx_pantalla` int(11) unsigned NOT NULL,
  `posy_pantalla` int(11) unsigned NOT NULL,
  `activo` tinyint(1) unsigned NOT NULL,
  `descrip` text NOT NULL,
  `en_stock` tinyint(1) unsigned NOT NULL,
  `en_carta` tinyint(1) unsigned NOT NULL,
  `familia_hija` int(10) unsigned DEFAULT '0',
  `color` varchar(6) DEFAULT 'FFFFFF',
  `uds_stock` decimal(10,3) DEFAULT '0.000',
  `nombre_es` varchar(45) DEFAULT NULL,
  `nombre_en` varchar(45) DEFAULT NULL,
  `nombre_de` varchar(45) DEFAULT NULL,
  `nombre_fr` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_articulo`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=138 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arts_grupomods`
--

CREATE TABLE IF NOT EXISTS `arts_grupomods` (
  `id_art` int(11) unsigned NOT NULL,
  `id_grupo` int(11) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE IF NOT EXISTS `caja` (
  `id_caja` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha_ini` date NOT NULL,
  `hora_ini` time NOT NULL,
  `fecha_fin` date NOT NULL,
  `hora_fin` time NOT NULL,
  `total_contado` decimal(10,2) NOT NULL,
  `total_visa` decimal(10,2) NOT NULL,
  `cambio` decimal(10,2) NOT NULL,
  `abierta` varchar(1) NOT NULL,
  PRIMARY KEY (`id_caja`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `zona_mapa` varchar(10) DEFAULT NULL,
  `tlf` varchar(10) NOT NULL,
  `observ` text NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_mesa`
--

CREATE TABLE IF NOT EXISTS `cliente_mesa` (
  `id_mesa` int(5) unsigned DEFAULT NULL,
  `nick` varchar(15) DEFAULT NULL,
  `pass` varchar(15) DEFAULT NULL,
  `comensal` varchar(15) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cola`
--

CREATE TABLE IF NOT EXISTS `cola` (
  `id_cola` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_hist_descr` int(11) NOT NULL,
  `hora_recibo` time NOT NULL,
  `orden` int(11) NOT NULL,
  `usuario` varchar(45) CHARACTER SET latin1 NOT NULL,
  `articulo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `uds` decimal(10,3) NOT NULL,
  `servido` varchar(1) CHARACTER SET latin1 NOT NULL,
  `entregado` varchar(1) DEFAULT 'N',
  `anulado` varchar(1) CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `traspaso` varchar(1) CHARACTER SET latin1 NOT NULL DEFAULT 'N',
  `punto_anterior` varchar(40) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `mesa` varchar(45) NOT NULL,
  `comensal` varchar(45) NOT NULL,
  `mods` varchar(45) NOT NULL,
  `llevar` varchar(1) NOT NULL,
  `listo` varchar(1) NOT NULL,
  `observ` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cola`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3209 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comensales`
--

CREATE TABLE IF NOT EXISTS `comensales` (
  `id_comensal` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `id_punto` int(11) NOT NULL,
  `imagen` text NOT NULL,
  `pos_x` int(11) NOT NULL,
  `pos_y` int(11) NOT NULL,
  `ocupado` varchar(1) NOT NULL,
  `observ` text NOT NULL,
  PRIMARY KEY (`id_comensal`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=181 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `razon` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nif` varchar(13) NOT NULL,
  `domicilio` varchar(100) NOT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `tlf` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `email` text,
  `web` text,
  PRIMARY KEY (`id_empresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `razon`, `nombre`, `nif`, `domicilio`, `localidad`, `provincia`, `cp`, `tlf`, `fax`, `email`, `web`) VALUES
(2, 'Yo', 'Yo', '54321234', 'Aqui, 23', 'Rota', 'Cadiz', '11000', '987654321', '98765412', 'yo@yo.com', 'www.yo.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE IF NOT EXISTS `familias` (
  `id_familia` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `id_padre` int(11) NOT NULL,
  `grupo_impresion` int(11) NOT NULL,
  `grupo_visor` int(11) NOT NULL,
  `preferencia` int(10) unsigned DEFAULT '0',
  `color` varchar(6) CHARACTER SET utf8 DEFAULT 'FFFFFF',
  `imagen` varchar(50) DEFAULT NULL,
  `orden` int(10) DEFAULT '0',
  `nombre_es` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `nombre_en` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `nombre_de` varchar(45) DEFAULT NULL,
  `nombre_fr` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_familia`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_impresion`
--

CREATE TABLE IF NOT EXISTS `grupos_impresion` (
  `Id_GrupoImp` varchar(45) NOT NULL,
  `Id_Impresora` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_modificadores`
--

CREATE TABLE IF NOT EXISTS `grupos_modificadores` (
  `id_grupo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `observ` text,
  `nombre_es` varchar(45) DEFAULT NULL,
  `nombre_en` varchar(45) DEFAULT NULL,
  `nombre_de` varchar(45) DEFAULT NULL,
  `nombre_fr` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id_grupo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_visores`
--

CREATE TABLE IF NOT EXISTS `grupos_visores` (
  `id_grupo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `observ` text NOT NULL,
  PRIMARY KEY (`id_grupo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `grupos_visores`
--

INSERT INTO `grupos_visores` (`id_grupo`, `nombre`, `observ`) VALUES
(1, 'Comida', ''),
(2, 'Bebida', ''),
(3, 'puntos arriba', ''),
(4, 'puntos_abajo', 'los de abajo'),
(6, 'dummy', 'nuevo visor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_puntos`
--

CREATE TABLE IF NOT EXISTS `historial_puntos` (
  `id_hist` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `fecha_fin` date NOT NULL DEFAULT '0000-00-00',
  `hora_apertura` time NOT NULL,
  `hora_cierre` time NOT NULL,
  `punto` varchar(45) NOT NULL,
  `comensal` varchar(45) CHARACTER SET utf8 DEFAULT '1',
  `cobrada` varchar(1) NOT NULL,
  `anulado` varchar(1) NOT NULL DEFAULT 'N',
  `propina` decimal(10,2) unsigned DEFAULT '0.00',
  `descuento` decimal(10,2) unsigned DEFAULT '0.00',
  `usuario` varchar(45) CHARACTER SET utf8 DEFAULT 'admin',
  PRIMARY KEY (`id_hist`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1070 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_puntos_descr`
--

CREATE TABLE IF NOT EXISTS `historial_puntos_descr` (
  `id_hist_descr` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_hist_punto` varchar(45) NOT NULL,
  `comensal` varchar(45) NOT NULL,
  `idarticulo` int(10) unsigned DEFAULT '0',
  `articulo` varchar(100) NOT NULL,
  `cantidad` decimal(10,3) NOT NULL,
  `pvp` decimal(10,2) NOT NULL,
  `usuario` varchar(12) NOT NULL,
  `hora` time NOT NULL,
  `invitacion` varchar(1) NOT NULL,
  `enviado` varchar(1) NOT NULL,
  `anulado` varchar(1) NOT NULL DEFAULT 'N',
  `llevar` varchar(1) CHARACTER SET utf8 NOT NULL,
  `mods` varchar(100) NOT NULL,
  `observ` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mods_lang` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id_hist_descr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3570 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hist_stock`
--

CREATE TABLE IF NOT EXISTS `hist_stock` (
  `id_hs` bigint(12) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `idart` bigint(12) DEFAULT NULL,
  `articulo` varchar(50) DEFAULT NULL,
  `uds` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_hs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impresoras`
--

CREATE TABLE IF NOT EXISTS `impresoras` (
  `id_impresora` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `visor` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_impresora`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `impresoras`
--

INSERT INTO `impresoras` (`id_impresora`, `nombre`, `visor`) VALUES
(1, 'tiket', 0),
(2, 'cocina', 6),
(3, 'barra', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id_log` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `usuario` varchar(40) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `operacion` varchar(40) DEFAULT NULL,
  `detalles` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=672 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modificadores`
--

CREATE TABLE IF NOT EXISTS `modificadores` (
  `id_modificador` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `observ` text NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `nombre_es` varchar(45) DEFAULT NULL,
  `nombre_en` varchar(45) DEFAULT NULL,
  `nombre_de` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `nombre_fr` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_modificador`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=132 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE IF NOT EXISTS `movimientos` (
  `id_mov` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_caja` int(11) DEFAULT NULL,
  `id_hist` int(11) NOT NULL,
  `punto` varchar(20) NOT NULL,
  `comensal` varchar(20) NOT NULL,
  `fecha_ini` date NOT NULL,
  `hora_ini` time NOT NULL,
  `fecha_fin` date NOT NULL,
  `hora_fin` time NOT NULL,
  `tipo_cobro` varchar(1) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `entregado` decimal(10,2) NOT NULL,
  `cobro_efectivo` decimal(10,2) NOT NULL,
  `cobro_tarjeta` decimal(10,2) NOT NULL,
  `invitacion` varchar(1) NOT NULL,
  `motivo_invitacion` varchar(150) DEFAULT NULL,
  `observ` text,
  `propina` decimal(10,2) unsigned DEFAULT '0.00',
  `descuento` decimal(10,2) unsigned DEFAULT '0.00',
  PRIMARY KEY (`id_mov`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=256 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles`
--

CREATE TABLE IF NOT EXISTS `niveles` (
  `id_nivel` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `pantalla` text,
  `descr` text,
  PRIMARY KEY (`id_nivel`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `niveles`
--

INSERT INTO `niveles` (`id_nivel`, `nombre`, `pantalla`, `descr`) VALUES
(1, 'administrador', 'admin.php', 'Gestion caja y base datos'),
(2, 'camarero', 'mesas.php?', 'Tomar comandas y visores'),
(3, 'visor', 'selvisor.php', 'Controlar visores y tomar comandas'),
(4, 'repartidor', 'mesas.php?', 'Controlar repartos'),
(5, 'encargado', 'mesas.php?', 'como camarero, pero puede borrar comandas y lineas de comanda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE IF NOT EXISTS `puntos` (
  `id_punto` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `zona` int(11) NOT NULL,
  `imagen` text NOT NULL,
  `pos_x` int(11) NOT NULL,
  `pos_y` int(11) NOT NULL,
  `ocupada` varchar(1) NOT NULL,
  `comensales` int(11) NOT NULL,
  `grupo_impresion` int(11) NOT NULL,
  `grupo_visor` int(11) NOT NULL,
  `observ` text NOT NULL,
  `imagen_o` text NOT NULL,
  PRIMARY KEY (`id_punto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Volcado de datos para la tabla `puntos`
--

INSERT INTO `puntos` (`id_punto`, `nombre`, `zona`, `imagen`, `pos_x`, `pos_y`, `ocupada`, `comensales`, `grupo_impresion`, `grupo_visor`, `observ`, `imagen_o`) VALUES
(1, '1', 1, 'programa/punto_libre.png', 509, 492, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(2, '2', 1, 'programa/punto_libre.png', 332, 627, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(3, '3', 1, 'programa/punto_libre.png', 120, 696, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(4, '4', 1, 'programa/punto_libre.png', -93, 689, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(5, '5', 1, 'programa/punto_libre.png', -79, 441, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(6, '6', 1, 'programa/punto_libre.png', -386, 577, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(7, '7', 1, 'programa/punto_libre.png', -502, 441, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(8, '8', 1, 'programa/punto_libre.png', -465, 337, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(9, '9', 1, 'programa/punto_libre.png', -696, 285, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(10, '10', 1, 'programa/punto_libre.png', -762, 47, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(11, '11', 1, 'programa/punto_libre.png', -660, 216, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(12, '12', 1, 'programa/punto_libre.png', -805, 6, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(13, '13', 1, 'programa/punto_libre.png', -761, 21, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(14, '14', 1, 'programa/punto_libre.png', -726, 87, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(15, '15', 1, 'programa/punto_libre.png', -945, 326, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(21, '21', 2, 'programa/punto_libre.png', 335, 193, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(22, '22', 2, 'programa/punto_libre.png', 98, 55, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(23, '23', 2, 'programa/punto_libre.png', -140, 194, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(25, '25', 2, 'programa/punto_libre.png', -240, 637, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(26, '26', 2, 'programa/punto_libre.png', -42, 448, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(27, '27', 2, 'programa/punto_libre.png', -142, 648, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(28, '61', 9, 'programa/punto_libre.png', 21, 12, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(29, '62', 9, 'programa/punto_libre.png', -73, 124, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(30, '63', 9, 'programa/punto_libre.png', -168, 239, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(31, '31', 3, 'programa/punto_libre.png', 97, 23, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(32, '32', 3, 'programa/punto_libre.png', 6, 204, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(33, '33', 3, 'programa/punto_libre.png', -88, 418, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(34, '34', 3, 'programa/punto_libre.png', -186, 557, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(35, '35', 3, 'programa/punto_libre.png', -285, 701, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(36, '36', 3, 'programa/punto_libre.png', -218, 699, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(37, '37', 3, 'programa/punto_libre.png', -311, 551, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(38, '38', 3, 'programa/punto_libre.png', -413, 426, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(39, '39', 3, 'programa/punto_libre.png', -511, 198, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(40, '40', 3, 'programa/punto_libre.png', -604, 31, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(41, '41', 3, 'programa/punto_libre.png', -556, 25, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(42, '42', 3, 'programa/punto_libre.png', -658, 191, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(43, '51', 6, 'programa/punto_libre.png', 234, 426, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(44, '52', 6, 'programa/punto_libre.png', 33, 30, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(45, '53', 6, 'programa/punto_libre.png', 3, 183, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(46, '54', 6, 'programa/punto_libre.png', 100, 100, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(48, '56', 6, 'programa/punto_libre.png', 100, 100, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(49, '57', 6, 'programa/punto_libre.png', 100, 100, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(50, '58', 6, 'programa/punto_libre.png', 100, 100, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(80, '59', 6, 'programa/punto_libre.png', 100, 100, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(79, 'Tu', 4, 'no', 0, 0, 'N', 0, 0, 3, 'n', 'n'),
(81, '60', 6, 'programa/punto_libre.png', 100, 100, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(82, '64', 9, 'programa/punto_libre.png', -262, 358, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(83, '65', 9, 'programa/punto_libre.png', -357, 476, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(84, '66', 9, 'programa/punto_libre.png', -439, 589, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(85, '67', 9, 'programa/punto_libre.png', -534, 704, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(86, '68', 9, 'programa/punto_libre.png', -630, 819, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png'),
(87, '69', 9, 'programa/punto_libre.png', 100, 100, 'N', 0, 0, 3, '0', 'programa/punto_ocupado.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_modificadores`
--

CREATE TABLE IF NOT EXISTS `relacion_modificadores` (
  `id_grupo` int(11) unsigned DEFAULT NULL,
  `id_mod` int(11) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `relacion_modificadores`
--

INSERT INTO `relacion_modificadores` (`id_grupo`, `id_mod`) VALUES
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(1, 1),
(11, 5),
(1, 3),
(11, 66),
(1, 5),
(1, 7),
(3, 13),
(3, 14),
(3, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(22, 117),
(21, 116),
(21, 114),
(20, 112),
(20, 104),
(18, 90),
(18, 89),
(20, 102),
(20, 90),
(19, 99),
(19, 15),
(19, 13),
(19, 14),
(0, 41),
(8, 52),
(9, 53),
(10, 58),
(10, 59),
(10, 60),
(10, 61),
(11, 62),
(11, 64),
(11, 68),
(11, 69),
(11, 70),
(12, 70),
(12, 72),
(12, 73),
(12, 74),
(14, 75),
(17, 120),
(14, 77),
(15, 78),
(15, 79),
(15, 80),
(15, 81),
(15, 82),
(15, 83),
(15, 84),
(16, 75),
(17, 119),
(17, 75),
(16, 118),
(20, 111),
(16, 121),
(16, 122),
(17, 123),
(10, 126);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_visores`
--

CREATE TABLE IF NOT EXISTS `relacion_visores` (
  `id_grupo` bigint(20) NOT NULL,
  `id_visor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `relacion_visores`
--

INSERT INTO `relacion_visores` (`id_grupo`, `id_visor`) VALUES
(1, 2),
(1, 3),
(2, 1),
(3, 4),
(3, 5),
(3, 6),
(4, 1),
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_visores_cola`
--

CREATE TABLE IF NOT EXISTS `relacion_visores_cola` (
  `id_cola` bigint(20) NOT NULL,
  `id_visor` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_familia`
--

CREATE TABLE IF NOT EXISTS `tipo_familia` (
  `id_tipo` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipo_familia`
--

INSERT INTO `tipo_familia` (`id_tipo`, `tipo`) VALUES
(1, 'BEBIDA'),
(2, 'COMIDA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET utf8 NOT NULL,
  `apellidos` varchar(45) CHARACTER SET utf8 NOT NULL,
  `nick` varchar(45) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(45) CHARACTER SET utf8 NOT NULL,
  `tlf` varchar(45) CHARACTER SET utf8 NOT NULL,
  `nivel` int(10) DEFAULT NULL,
  `observ` text CHARACTER SET utf8 NOT NULL,
  `id_visor` int(10) unsigned NOT NULL,
  `autologin` varchar(1) CHARACTER SET utf8 NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `nick`, `pass`, `tlf`, `nivel`, `observ`, `id_visor`, `autologin`, `imagen`) VALUES
(1, 'admin', 'admin', 'admin', '1111', '0', 1, '0', 0, 'N', 'images/wkomander/skin/usuarios/admin.png'),
(2, 'ALI', 'ali', 'ALI', '1111', '0', 5, '0', 0, 'N', 'images/wkomander/skin/usuarios/usuario2.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vars`
--

CREATE TABLE IF NOT EXISTS `vars` (
  `variable` varchar(100) CHARACTER SET utf8 NOT NULL,
  `valor` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vars`
--

INSERT INTO `vars` (`variable`, `valor`) VALUES
('punto_libre', '100,255,100'),
('punto_libre_texto', '0,0,0'),
('punto_ocupado', '255,100,100'),
('punto_ocupado_texto', '0,0,0'),
('ruta_imagenes', 'images'),
('cobro_efectivo', 'S'),
('teclado_virtual', 'S'),
('impresoras', 'S'),
('propina', '0'),
('descuento', '0'),
('decimales', 'S'),
('moneda', '€'),
('empresa', '2'),
('clave_wifi', '12345abcd'),
('web_cliente', 'http://192.168.1.100'),
('nombre_wifi', 'KomanderTPV'),
('idioma', 'es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visores`
--

CREATE TABLE IF NOT EXISTS `visores` (
  `id_visor` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `observ` text NOT NULL,
  `nombre_es` varchar(45) DEFAULT NULL,
  `nombre_en` varchar(45) DEFAULT NULL,
  `nombre_de` varchar(45) DEFAULT NULL,
  `nombre_fr` varchar(45) DEFAULT NULL,
  `activo` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_visor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `visores`
--

INSERT INTO `visores` (`id_visor`, `nombre`, `id_usuario`, `clave`, `observ`, `nombre_es`, `nombre_en`, `nombre_de`, `nombre_fr`, `activo`) VALUES
(1, 'Barra', 1, 'Barra', '', 'BARRA', 'BAR', 'BAR', 'BAR', 0),
(2, 'Cocina', 1, 'Cocina', '', 'COCINA', 'KITCHEN', 'KÜCHE', 'CUISIN', 0),
(3, 'Parriya', 1, 'Parriya', '', 'PARRILLA', 'GRILL', 'GRILL', 'GRIL', 0),
(4, 'Barra 2', 1, 'Barra', '', 'BARRA', 'BAR', 'BAR', 'BAR', 1),
(5, 'Cocina 2', 1, 'Cocina', '', 'COCINA', 'KITCHEN', 'KÜCHEN', 'CUISIN', 1),
(6, 'Parriya2', 1, 'Parriya', '', 'PARRILLA', 'GRILL', 'GRILL', 'GRIL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE IF NOT EXISTS `zonas` (
  `id_zona` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `imagen` text NOT NULL,
  `observ` text NOT NULL,
  `grupo_impresion` bigint(20) NOT NULL,
  `grupo_visor` bigint(20) NOT NULL,
  `nombre_es` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `nombre_en` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `nombre_de` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `nombre_fr` varchar(45) DEFAULT NULL,
  `orden` int(5) unsigned DEFAULT '0',
  `tipo` varchar(10) DEFAULT 'LOCAL',
  `activo` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id_zona`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
