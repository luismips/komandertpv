-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-06-2013 a las 10:05:49
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `wkomander`
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

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `nombre`, `cod_rapido`, `abreviatura`, `imagen`, `en_tarifa`, `costo`, `pvp`, `cargo_llevar`, `tipo_iva`, `cod_barra`, `descripcion`, `tiempo_servicio`, `id_familia`, `orden`, `posx_pantalla`, `posy_pantalla`, `activo`, `descrip`, `en_stock`, `en_carta`, `familia_hija`, `color`, `uds_stock`, `nombre_es`, `nombre_en`, `nombre_de`, `nombre_fr`) VALUES
(1, 'EXPRESO', '101', 'cf', 'expreso.png', 'S', '0.50', '1.00', '0.00', '0.00', NULL, '0', 0, 1, 1, 100, 100, 0, '', 1, 0, 3, 'FFFFFF', '-2.000', 'EXPRESO', 'ESPRESSO', 'ESPRESSO', 'ESPRESSO'),
(2, 'DESCAFEINADO', '200', 'xu', 'descafeinado.png', 'S', '0.50', '1.00', '0.00', '0.00', NULL, '', 0, 1, 0, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-2.000', 'DESCAFEINADO', 'DECAFFEINATED', 'KOFFEINFREI', 'DÉCAFÉINÉ'),
(3, 'COLACAO', '102', 'cc', 'colacao.png', 'S', '0.50', '1.00', '0.00', '0.00', NULL, '', 0, 1, 2, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-3.000', 'COLACAO', 'COLACAO', 'COLACAO', 'COLACAO'),
(121, 'ALITAS DIABLO PLATO', '0', '0', 'alitasdiablo.png', 'S', '0.00', '5.00', '0.00', '0.00', '0', '', 0, 15, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-5.000', 'ALITAS DIABLO PLATO', 'HOT WINGS PLATE', 'HOT WINGS PLATE', 'HOT WINGS PLATE'),
(118, 'TALLARINES', '0', '0', 'tallarines.png', 'S', '0.00', '0.00', '0.00', '0.00', '0', '', 0, 15, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-14.000', 'TALLARINES', 'NOODLES', 'NUDELN', 'NOUILLES'),
(119, 'CANELONES', '0', '0', 'canelones.png', 'S', '0.00', '9.50', '0.00', '0.00', '0', '', 0, 15, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-15.000', 'CANELONES', 'CANNELLONI', 'CANELONES', 'CANELONES'),
(120, 'EMPANADO', '0', '0', 'empanado.png', 'S', '0.00', '0.00', '0.00', '0.00', '0', '', 0, 15, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-15.000', 'EMPANADO', 'BREADED', 'PANIERTE', 'PANÉ'),
(15, 'HEINEKEN', '212', 'tan', 'heineken.png', 'S', '0.50', '2.50', '0.00', '0.00', '0', '0', 0, 5, 3, 0, 0, 0, '', 1, 0, 0, '9CFF38', '97.000', 'HEINEKEN', 'HEINEKEN', 'HEINEKEN', 'HEINEKEN'),
(16, 'CRUZCAMPO', '213', 'ka', 'cruzcampo.png', 'S', '0.50', '2.50', '0.00', '0.00', NULL, '0', 0, 5, 2, 0, 0, 0, '', 1, 0, 0, 'FFB012', '96.000', 'CRUZCAMPO', 'CRUZCAMPO', 'CRUZCAMPO', 'CRUZCAMPO'),
(17, 'SIN', '214', 'csin', 'cervezasin.png', 'S', '0.50', '1.40', '0.00', '0.00', '0', '0', 0, 5, 1, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '96.000', 'SIN', 'NO ALCOHOL', 'KEIN ALKOHOL', 'PAS D''ALCOOL'),
(18, 'CERVEZA BARRIL', '215', 'bot', 'cervezabarril.png', 'S', '0.50', '1.20', '0.00', '0.00', '0', '0', 0, 5, 0, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-55.000', 'CERVEZA BARRIL', 'BARREL BEER', 'BEER', 'BIÈRE'),
(69, 'FANTA LIMON', '0', '0', 'fantalimon.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFF00', '-14.000', 'FANTA LIMON', 'LEMON SODA', 'ZITRONE SODA', 'CITRON SODA'),
(68, 'FANTA NARANJA', '0', '0', 'fantanaranja.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FFAA00', '-7.000', 'FANTA NARANJA', 'ORANGE SODA', 'APFELSINE SODA', 'ORANGE SODA'),
(123, 'NUGGETS', '0', '0', 'nuggets.png', 'S', '0.00', '4.00', '0.00', '0.00', '0', '', 0, 35, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-4.000', 'NUGGETS', 'NUGGETS', 'NUGGETS', 'NUGGETS'),
(124, 'CROQUETAS NIÑO', '0', '0', 'croquetas.png', 'S', '0.00', '5.00', '0.00', '0.00', '0', '', 0, 35, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-10.000', 'CROQUETAS NIÑO', 'KIDS CROQUETTES', 'KINDER KROKETTEN', 'ENFANTS CROQUETTES'),
(125, 'POLLO NIÑO', '0', '0', 'polloninio.png', 'S', '0.00', '6.00', '0.00', '0.00', '0', '', 0, 35, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-9.000', 'POLLO NIÑO', 'KID CHICKEN BREAST', 'KINDER HÜHNERBRUST', 'ENFANTS POITRINE DE POULET'),
(33, 'DYC', '230', 'rdyc', 'dyc.png', 'S', '0.50', '2.50', '0.00', '0.00', '0', '0', 0, 4, 1, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-74.000', 'DYC', 'DYC', 'DYC', 'DYC'),
(34, 'GIN RIVES', '231', 'rriv', 'ginrives.png', 'S', '0.50', '2.50', '0.00', '0.00', '0', '0', 0, 4, 2, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-34.000', 'GIN RIVES', 'GIN RIVES', 'GIN RIVES', 'GIN RIVES'),
(35, 'JB', '232', 'rjb', 'jb.png', 'S', '0.50', '3.00', '0.00', '0.00', '0', '0', 0, 4, 3, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-11.000', 'JB', 'JB', 'JB', 'JB'),
(36, 'BALLANTINES', '233', 'rbal', 'ballantines.png', 'S', '0.50', '3.00', '0.00', '0.00', '0', '0', 0, 4, 4, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-5.000', 'BALLANTINES', 'BALLANTINES', 'BALLANTINES', 'BALLANTINES'),
(122, 'GAMBAS CREMA PLATO', '0', '0', 'gambascremaplato.png', 'S', '0.00', '9.50', '0.00', '0.00', '0', '', 0, 15, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-16.000', 'GAMBAS CREMA PLATO', 'CREAM SHRIMPS PLATE', 'GARNELEN CREAM SCHÜSSEL', 'CREVETTES CRÈME PLAQUE'),
(39, 'RON BACARDI', '236', 'rbac', 'bacardi.png', 'S', '0.50', '3.00', '0.00', '0.00', '0', '0', 0, 4, 6, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-7.000', 'RON BACARDI', 'BACARDI RUM', 'BACARDI RON', 'RON BACARDI'),
(40, 'CACIQUE', '237', 'rcac', 'cacique.png', 'S', '0.50', '3.00', '0.00', '0.00', '0', '0', 0, 4, 7, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-5.000', 'CACIQUE', 'CACIQUE', 'CACIQUE', 'CACIQUE'),
(41, 'PAMPERO', '238', 'rpam', 'pampero.png', 'S', '0.50', '3.00', '0.00', '0.00', '0', '0', 0, 4, 8, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-4.000', 'PAMPERO', 'PAMPERO', 'PAMPERO', 'PAMPERO'),
(42, 'CHURRASCO ARGENTINO', '239', 'cha', 'churrasco.png', 'S', '9.50', '9.50', '0.00', '0.00', '0', '0', 0, 8, 1, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-37.000', 'CHURRASCO ARGENTINO', 'CHURRASCO ARGENTINO', 'CHURRASCO ARGENTINO', 'CHURRASCO ARGENTINO'),
(43, 'SOLOMILLO TERNERA', '240', 'st', 'solomilloternera.png', 'S', '9.50', '9.60', '0.00', '0.00', '0', '0', 0, 8, 2, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-14.000', 'SOLOMILLO TERNERA', 'BEEF TENDERLOIN', 'RINDERFILET', 'FILET DE BOEUF'),
(44, 'SOLOMILLO CERDO', '241', 'sc', 'solomillocerdo.png', 'S', '9.50', '9.50', '0.00', '0.00', '0', '0', 0, 8, 3, 0, 0, 0, '', 1, 0, 0, 'FFFFFF', '-12.000', 'SOLOMILLO CERDO', 'PORK TENDERLOIN', 'SCHWEINEFILET', 'FILET DE PORC'),
(45, 'CHULETON BUEY', '242', 'chb', 'buey.png', 'S', '8.00', '12.00', '0.00', '0.00', '0', '0', 0, 8, 4, 0, 0, 0, '0', 1, 0, 0, 'FF5C21', '0.000', 'CHULETON BUEY', 'OX RIBEYE', 'RINDERSTEAK', 'STEAK DE BOEUF'),
(46, 'CHULETON AVILA', '243', 'chav', 'avila.png', 'S', '8.00', '12.00', '0.00', '0.00', '0', '0', 0, 8, 5, 0, 0, 0, '0', 1, 0, 0, '59A1FF', '-175.000', 'CHULETON AVILA', 'AVILA STEAK', 'AVILA STEAK', 'AVILA BIFTEK'),
(47, 'LOMO CERDO', '244', 'loce', 'lomocerdo.png', 'S', '8.00', '12.00', '0.00', '0.00', '0', '0', 0, 8, 6, 0, 0, 0, '0', 1, 0, 0, 'FFFFFF', '-1014.000', 'LOMO CERDO', 'PORK LOIN', 'SCHWEINELENDE', 'LONGE DE PORC'),
(48, 'MOLLEJAS', '245', 'moll', 'mollejas.png', 'S', '8.00', '12.00', '0.00', '0.00', '0', '0', 0, 8, 7, 0, 0, 0, '0', 1, 0, 0, 'B6FF38', '-8.000', 'MOLLEJAS', 'SWEETBREADS', 'MUSKELMAGEN', 'GÉSIERS'),
(49, 'PECHUGA POLLO', '246', 'ppoy', 'pechuga.png', 'S', '8.00', '12.00', '0.00', '0.00', '0', '0', 0, 8, 8, 0, 0, 0, '0', 1, 0, 0, 'FFFFFF', '-3.000', 'PECHUGA POLLO', 'CHICKEN BREAST', 'HÜHNERBRUST', 'POITRINE DE POULET'),
(50, 'AVESTRUZ', '247', 'aves', 'aveztruz.png', 'S', '8.00', '12.00', '0.00', '0.00', '0', '0', 0, 8, 9, 0, 0, 0, '0', 1, 0, 0, 'FFFFFF', '-5.000', 'AVESTRUZ', 'OSTRICH', 'STRAUSS', 'AUTRUCHE'),
(51, 'PRESA IBERICA', '248', 'prei', 'presa.png', 'S', '8.00', '12.00', '0.00', '0.00', '0', '0', 0, 8, 10, 0, 0, 0, '0', 1, 0, 0, 'FFFFFF', '-4.000', 'PRESA IBERICA', 'IBERIAN PORK', 'IBERISCHEN SCHWEIN', 'PORC IBÉRIQUE'),
(52, 'PARRILLADA', '249', 'parr', 'parrillada.png', 'S', '8.00', '12.00', '0.00', '0.00', '0', '0', 0, 8, 11, 0, 0, 0, '0', 1, 0, 0, 'FFFFFF', '-7.000', 'PARRILLADA', 'GRILLED MIX', 'GRILLTELLER', 'MIXED GRILL'),
(117, 'MUSAKA PLATO', '0', '0', 'musaka.png', 'S', '0.00', '10.00', '0.00', '0.00', '0', '', 0, 15, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-32.000', 'MUSAKA PLATO', 'MOUSACA PLATE', 'MOUSACA SCHÜSSEL', 'MOUSACA PLAQUE'),
(116, 'EMPANADO NIÑO', '0', '0', 'polloempninio.png', 'S', '0.00', '0.00', '0.00', '0.00', '0', '', 0, 35, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-12.000', 'EMPANADO NIÑO', 'KID BREADED', 'KINDER PANIERTE', 'ENFANTS PANÉ'),
(115, 'TALLARINES NIÑO', '0', '0', 'tallarinesninio.png', 'S', '0.00', '0.00', '0.00', '0.00', '0', '', 0, 35, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-4.000', 'TALLARINES NIÑO', 'KID NOODLES', 'KINDER NUDELN', 'ENFANTS NOUILLES'),
(61, 'COCA COLA', '0', '0', 'cocacola.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FF9980', '-3.000', 'COCA COLA', 'COKE', 'COKE', 'COKE'),
(59, 'MERLUZA A LA VASCA', '0', '0', 'merluza.png', 'S', '0.00', '12.50', '0.00', '0.00', '0', 'FRESCAS', 0, 15, 0, 0, 0, 1, '0', 1, 0, 0, '42FF42', '-15.000', 'MERLUZA A LA VASCA', 'BASQUE HAKE', 'SEEHECHT DEN BASKISCHEN', 'LE BASQUE MERLU'),
(58, 'MILLER', '0', '0', 'miller.png', 'S', '0.00', '3.00', '0.00', '0.00', '0', 'aaaa', 0, 5, 5, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '99.000', 'MILLER', 'MILLER', 'MILLER', 'MILLER'),
(60, 'PEZ ESPADA', '0', '0', 'pezespada.png', 'S', '0.00', '12.10', '0.00', '0.00', '0', 'rico rico', 0, 15, 0, 0, 0, 1, '0', 1, 0, 0, 'A3FFC8', '-13.000', 'PEZ ESPADA', 'SWORDFISH', 'SWORDFISH', 'ESPADON'),
(62, 'DORADA', '0', '0', 'dorada.png', 'S', '0.00', '10.00', '0.00', '0.00', '0', '', 0, 15, 0, 0, 0, 1, '0', 1, 0, 0, '40FF99', '-3.000', 'DORADA', 'GOLDFISH', 'GOLDBRASSEN', 'CYPRIN'),
(126, 'CERDO NIÑO', '0', '0', 'cerdoninio.png', 'S', '0.00', '6.00', '0.00', '0.00', '0', '', 0, 35, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-16.000', 'CERDO NIÑO', 'KID PORK ', 'KINDER SCHWEIN', 'ENFANTS PORC'),
(64, 'MOCA', '0', '0', 'moca.png', 'S', '0.00', '2.10', '0.00', '0.00', '0', 'cafe moka', 0, 1, 0, 0, 0, 1, '0', 1, 0, 0, 'DB8235', '-4.000', 'MOCA', 'MOCHA', 'MOCHA', 'MOCHA'),
(66, 'KOBE', '0', '0', 'cove.png', 'S', '0.00', '15.00', '0.00', '0.00', '0', 'Carne mu wena', 0, 8, 0, 0, 0, 1, '0', 1, 0, 0, 'FF3333', '-18.500', 'KOBE', 'KOBE', 'KOBE', 'KOBE'),
(67, 'BERONIA', '0', '0', '0', 'S', '0.00', '0.00', '0.00', '0.00', '0', '', 0, 22, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-5.000', 'BERONIA', 'BERONIA', 'BERONIA', 'BERONIA'),
(70, 'AGUA', '0', '0', 'agua.png', 'S', '0.00', '1.20', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'CCCCFF', '-42.000', 'AGUA', 'WATER', 'WASSER', 'EAU'),
(71, 'AGUA GAS', '0', '0', 'aguagas.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, '559955', '-84.000', 'AGUA GAS', 'GAS WATER', 'SPRUDELWASSER', 'EAU GAZEUSE'),
(72, 'COLA LIGHT', '0', '0', 'colalight.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'CCCCCC', '-15.000', 'COLA LIGHT', 'COKE LIGHT', 'COKE LIGHT', 'COKE LIGHT'),
(73, '7UP', '0', '0', '7up.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, '21FF29', '0.000', '7UP', '7UP', '7UP', '7UP'),
(74, 'CORONITA', '0', '0', 'coronita.png', 'S', '0.00', '2.50', '0.00', '0.00', '0', '', 0, 5, 4, 0, 0, 1, '0', 1, 0, 0, 'FFE608', '98.000', 'CORONITA', 'CORONITA', 'CORONITA', 'CORONITA'),
(84, 'SANGRIA', '0', '0', 'sangria.png', 'S', '0.00', '9.00', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '4.000', 'SANGRIA', 'SANGRIA', 'SANGRIA', 'SANGRIA'),
(85, 'SANGRIA 1/2', '0', '0', 'sangriamed.png', 'S', '0.00', '4.00', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-1.000', 'SANGRIA 1/2', 'HALF SANGRIA', 'HALBE SANGRIA', 'DEMI SANGRIA'),
(86, 'COPA RIOJA', '0', '0', 'coparioja.png', 'S', '0.00', '2.40', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-4.000', 'COPA RIOJA', 'RED WINE CUP', 'ROTWEIN KELCHGLAS', 'VERRE DE VIN ROUGE'),
(87, 'COPA BLANCO', '0', '0', 'copablanco.png', 'S', '0.00', '2.40', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-3.000', 'COPA BLANCO', 'WHITE WINE CUP', 'WEISSWEIN KELCHGLAS', 'VERRE DE VIN BLANC'),
(88, 'RADICAL NARANJA', '0', '0', 'radicalnaranja.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FFaa00', '-2.000', 'RADICAL NARANJA', 'ORANGE RADICAL', 'APFELSINE RADICAL', 'ORANGE RADICAL'),
(89, 'RADICAL LIMON', '0', '0', 'radicallimon.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFF00', '0.000', 'RADICAL LIMON', 'LEMON RADICAL', 'ZITRONE RADICAL', 'CITRON RADICAL'),
(90, 'TONICA', '0', '0', 'tonica.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-1.000', 'TONICA', 'TONIC WATER', 'TONIC WASSER', 'EAU TONIC'),
(83, 'TINTO', '0', '0', 'tintoverano.png', 'S', '0.00', '0.00', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FF3333', '0.000', 'TINTO', 'RED WINE WITH SODA', 'ROTWEIN MIT SODA', 'VIN ROUGE AVEC SODA'),
(91, 'BITTER KAS', '0', '0', 'bitterkas.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FF0000', '0.000', 'BITTER KAS', 'BITTERKAS', 'BITTERKAS', 'BITTERKAS'),
(92, 'CASERA', '0', '0', 'casera.png', 'S', '0.00', '2.00', '0.00', '0.00', '0', '', 0, 21, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '0.000', 'CASERA', 'CASERA SODA', 'CASERA SODA', 'CASERA SODA'),
(93, 'ZUMO NARANJA', '0', '0', 'zumonaranja.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 31, 0, 0, 0, 1, '0', 1, 0, 0, 'FFaa00', '-9.000', 'ZUMO NARANJA', 'ORANGE JUICE', 'ORANGE SAFT', 'JUS D''ORANGE'),
(94, 'ZUMO PIÑA', '0', '0', 'zumopinia.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 31, 0, 0, 0, 1, '0', 1, 0, 0, 'AAAA11', '-14.000', 'ZUMO PIÑA', 'PINNEAPPLE JUICE', 'ANANASSAFT', 'JUS D''ANANAS'),
(95, 'ZUMO MELOCOTON', '0', '0', 'zumomelocoton.png', 'S', '0.00', '1.40', '0.00', '0.00', '0', '', 0, 31, 0, 0, 0, 1, '0', 1, 0, 0, 'FFE926', '-6.000', 'ZUMO MELOCOTON', 'PEACH JUICE', 'PFIRSICHSAFT', 'JUS DE PECHE'),
(96, 'PROVOLONE AL GRILL', '0', '0', 'provolone.png', 'S', '0.00', '6.00', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-61.000', 'PROVOLONE AL GRILL', 'PROVOLONE GRILLED CHESSE', 'GEGRILLTER KÄSE PROVOLONE', 'FROMAGE GRILLÉ PROVOLONE'),
(97, 'CHORIZO CRIOYO', '0', '0', 'chorizo_criollo.png', 'S', '0.00', '7.00', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-30.000', 'CHORIZO CRIOYO', 'CREOLE SAUSAGE', 'CREOLE WURST', 'CRÉOLE SAUCISSE'),
(98, 'CHISTORRAS', '0', '0', 'chistorra.png', 'S', '0.00', '5.00', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-15.000', 'CHISTORRAS', 'CHISTORRAS', 'CHISTORRAS', 'CHISTORRAS'),
(99, 'MORCILLA', '0', '0', 'morcilla.png', 'S', '0.00', '6.00', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-18.000', 'MORCILLA', 'BLOOD ONION SAUSAGE', 'ZWIEBEL BLUTWURST', 'SAUCISSE OIGNON'),
(100, 'PIMIENTOS FRITOS', '0', '0', 'pimientos.png', 'S', '0.00', '7.00', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-17.000', 'PIMIENTOS FRITOS', 'FRIED PEPPERS', 'GEBRATENE PFEFFER', 'POIVRONS FRITS'),
(101, 'MOLLEJAS ENTRANTE', '0', '0', 'mollejas.png', 'S', '0.00', '15.00', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-4.000', 'MOLLEJAS ENTRANTE', 'SWEETBREAD APPETIZER', 'MUSKELMAGEN APERITIF', 'GÉSIERS ENTRÉES'),
(102, 'GAMBAS CREMA', '0', '0', 'gambascrema.png', 'S', '0.00', '10.00', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-7.000', 'GAMBAS CREMA', 'CREAM SHRIMPS', 'GARNELEN CREAM', 'CREVETTES CRÈME'),
(103, 'GAMBAS AJILLO', '0', '0', 'gambasajillo.png', 'S', '0.00', '10.00', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-31.000', 'GAMBAS AJILLO', 'GARLIC SHRIMPS', 'KNOBLAUCH-GARNELEN', 'CREVETTES AIL'),
(104, 'COSTILLAS ENTRANTE', '0', '0', 'costillas.png', 'S', '0.00', '9.00', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-8.000', 'COSTILLAS ENTRANTE', 'RIBS APPETIZER', 'RIBS APERITIF', 'ENTRÉES CÔTES'),
(105, 'TOMATE OREGANO', '0', '0', 'tomate.png', 'S', '0.00', '6.00', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-5.000', 'TOMATE OREGANO', 'OREGANO TOMATOES', 'TOMATEN MIT OREGANO', 'TOMATES À L''ORIGAN'),
(106, 'ESPARRAGOS', '0', '0', 'esparragos.png', 'S', '0.00', '6.00', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-3.000', 'ESPARRAGOS', 'ASPARAGUS', 'SPARGEL', 'ASPERGES'),
(107, 'CROQUETAS', '0', '0', 'croquetas.png', 'S', '0.00', '7.50', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-3.000', 'CROQUETAS', 'CROQUETTES', 'KROKETTEN', 'CROQUETTES'),
(108, 'ENSALADA SIMPLE', '0', '0', 'ensaladasimple.png', 'S', '0.00', '4.00', '0.00', '0.00', '0', '', 0, 33, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-27.000', 'ENSALADA SIMPLE', 'NORMAL SALAD', 'EINFACHEN SALAT', 'SALADE DE SIMPLE'),
(109, 'ENSALADA CASA', '0', '0', 'ensaladacasa.png', 'S', '0.00', '5.00', '0.00', '0.00', '0', '', 0, 33, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-14.000', 'ENSALADA CASA', 'HOUSE SALAD', 'HAUS SALAT', 'SALADE MAISON'),
(110, 'ENSALADA ROQUEFORT', '0', '0', 'ensaladaroke.png', 'S', '0.00', '6.00', '0.00', '0.00', '0', '', 0, 33, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-5.000', 'ENSALADA ROQUEFORT', 'BLUE CHESSE SALAD', 'ROQUEFORT SALAT', 'SALADE ROQUEFORT'),
(111, 'ENSALADA WALDORF', '0', '0', 'ensaladawaldorf.png', 'S', '0.00', '6.00', '0.00', '0.00', '0', '6', 0, 33, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-3.000', 'ENSALADA WALDORF', 'WALDORF SALAD', 'WALDORF SALAT', 'SALADE WALDORF'),
(112, 'MUSAKA ENTRANTE', '0', '0', 'musaka.png', 'S', '0.00', '6.50', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-1.000', 'MUSAKA ENTRANTE', 'MOUSACA APPETIZER', 'MOUSACA APERITIF', 'MOUSACA ENTRÉES'),
(113, 'CHOCOS FRITOS', '0', '0', 'chocos.png', 'S', '0.00', '7.00', '0.00', '0.00', '0', '', 0, 32, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-2.000', 'CHOCOS FRITOS', 'FRIED SQUIDS', 'GEBRATENE KALMARE', 'CALMARS FRITS'),
(114, 'SALMON A LA PLANCHA', '0', '0', 'salmon.png', 'S', '0.00', '10.00', '0.00', '0.00', '0', '', 0, 15, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '10.000', 'SALMON A LA PLANCHA', 'GRILLED SALMON', 'GEGRILLTER LACHS', 'SAUMON GRILLÉ'),
(127, 'TERNERA NIÑO', '0', '0', 'terneraninio.png', 'S', '0.00', '8.00', '0.00', '0.00', '0', '', 0, 35, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-5.000', 'TERNERA NIÑO', 'KID BEEF TENDERLOIN', 'KINDER KALB', 'ENFANTS VEAU'),
(128, 'CREPS', '0', '0', 'crep.png', 'S', '0.00', '3.50', '0.00', '0.00', '0', '', 0, 34, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-101.000', 'CREPS', 'CREPS', 'CREPS', 'CREPS'),
(129, 'FLAN CASERO', '0', '0', 'flan.png', 'S', '0.00', '3.00', '0.00', '0.00', '0', '', 0, 34, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-85.000', 'FLAN CASERO', 'HOMEMADE FLAN', 'HAUSGEMACHTE CREME', 'CREME ANGLAISE MAISON'),
(130, 'TARTA QUESO', '0', '0', 'tartaqueso.png', 'S', '0.00', '3.00', '0.00', '0.00', '0', '', 0, 34, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '-43.000', 'TARTA QUESO', 'CHEESE CAKE', 'KÄSEKUCHEN', 'GÂTEAU AU FROMAGE'),
(131, 'bcbcbcbc', '0', '0', '0', 'S', '0.00', '9.00', '0.00', '0.00', '0', 'bbbbbbbbb', 0, 4, 0, 0, 0, 1, '0', 1, 0, 0, 'FFFFFF', '4.000', 'bcbcbcbc', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arts_grupomods`
--

CREATE TABLE IF NOT EXISTS `arts_grupomods` (
  `id_art` int(11) unsigned NOT NULL,
  `id_grupo` int(11) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `arts_grupomods`
--

INSERT INTO `arts_grupomods` (`id_art`, `id_grupo`) VALUES
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 3),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(121, 3),
(120, 3),
(120, 21),
(126, 2),
(114, 22),
(66, 2),
(67, 10),
(83, 11),
(83, 12),
(109, 15),
(110, 15),
(108, 15),
(127, 2),
(125, 2),
(43, 3),
(42, 3),
(42, 4),
(43, 4),
(44, 3),
(44, 4),
(45, 3),
(45, 4),
(46, 2),
(47, 3),
(47, 4),
(48, 3),
(48, 4),
(49, 3),
(49, 4),
(50, 3),
(50, 4),
(51, 3),
(51, 4),
(52, 3),
(52, 4),
(121, 22),
(120, 3),
(120, 21),
(118, 20),
(116, 19),
(115, 18),
(126, 3),
(126, 4),
(62, 9),
(66, 3),
(66, 4),
(67, 10),
(83, 11),
(83, 12),
(111, 14),
(109, 17),
(110, 17),
(108, 16),
(127, 3),
(127, 4),
(125, 3),
(125, 4),
(114, 1);

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

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `fecha_ini`, `hora_ini`, `fecha_fin`, `hora_fin`, `total_contado`, `total_visa`, `cambio`, `abierta`) VALUES
(21, '2013-05-27', '14:15:00', '0000-00-00', '00:00:00', '0.00', '0.00', '300.00', 'S'),
(20, '2013-05-27', '09:18:00', '2013-05-27', '14:15:00', '0.00', '16054.24', '500.00', 'N'),
(19, '2013-05-26', '18:56:00', '2013-05-26', '21:13:00', '10.20', '99.70', '300.00', 'N');

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

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `direccion`, `zona_mapa`, `tlf`, `observ`) VALUES
(30, '22', '22', '22', '222', '22'),
(29, '22', '22', '22', '2222', '22'),
(28, '55', '55', '55', '55', '55'),
(27, '1111', '111', '111', '1111', '1111');

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

--
-- Volcado de datos para la tabla `familias`
--

INSERT INTO `familias` (`id_familia`, `nombre`, `id_padre`, `grupo_impresion`, `grupo_visor`, `preferencia`, `color`, `imagen`, `orden`, `nombre_es`, `nombre_en`, `nombre_de`, `nombre_fr`) VALUES
(1, 'CAFE', 34, 0, 2, 5, 'BF6BFF', 'cafe.png', 0, 'CAFE', 'COFFE', 'CAFE', 'CAFE'),
(32, 'ENTRANTES', 0, 0, 1, 2, 'FFFFFF', 'entrantes.png', 0, 'ENTRANTES', 'APPETIZERS', 'EINGEHENDE', 'ENTRANT'),
(4, 'ALCOHOL', 0, 0, 2, 0, 'FFFF00', 'alcohol.png', 0, 'ALCOHOL', 'ALCOHOL', 'ALKOHOL', 'ALCOOL'),
(5, 'CERVEZAS', 21, 0, 2, 5, 'CCAA00', 'cervezas.png', 0, 'CERVEZAS', 'BEERS', 'BEERS', 'BEERS'),
(6, 'VINOS', 0, 0, 2, 0, 'FF3E17', 'vinos.png', 0, 'VINOS', 'WINES', 'WEINE', 'VINS'),
(35, 'NIÑOS', 0, 0, 1, 1, 'FFFFFF', 'ninos.png', 0, 'NIÑOS', 'KIDS', 'KINDER', 'ENFANTS'),
(8, 'PARRIYA', 0, 0, 1, 5, '40CCFF', 'parriya.png', 1, 'PARRIYA', 'GRILL', 'GRILL', 'GRILL'),
(34, 'POSTRES', 0, 0, 1, 5, 'FFFFFF', 'postres.png', 0, 'POSTRES', 'DESSERTS', 'DESSERTS', 'DESSERTS'),
(15, 'COCINA', 0, 0, 1, 5, '5BFF29', 'cocina.png', 2, 'COCINA', 'COOKED', 'KÜCHE', 'CUISINE'),
(21, 'BEBIDAS', 0, 0, 2, 5, 'FAFAFA', 'bebidas.png', 0, 'BEBIDAS', 'DRINKS', 'GETRÄNKE', 'BOISSONS'),
(22, 'RIOJA', 6, 0, 2, 5, 'FFFFFF', NULL, 0, 'RIOJA', 'RIOJA', 'RIOJA', 'RIOJA'),
(23, 'RIBERA DEL DUERO', 6, 0, 2, 5, 'FFFFFF', NULL, 0, 'RIBERA DEL DUERO', 'RIBERA DEL DUERO', 'RIBERA DEL DUERO', 'RIBERA DEL DUERO'),
(24, 'VINO BLANCO', 6, 0, 2, 5, 'FFFFFF', NULL, 0, 'VINO BLANCO', 'WHITE WINE', 'WEISSWEIN', 'VIN BLANC'),
(25, 'VINO ROSADO', 6, 0, 2, 5, 'FFFFFF', NULL, 0, 'VINO ROSADO', 'ROSE WINE', 'ROSE WEIN', 'VIN ROSE'),
(26, 'VINO FINO', 6, 0, 2, 5, 'FFFFFF', NULL, 0, 'VINO FINO', 'FINO WINE', 'FINO WEIN', 'VIN FINO'),
(27, 'MANZANILLA', 6, 0, 2, 5, 'FFFFFF', NULL, 0, 'MANZANILLA', 'MANZANILLA WINE', 'MANZANILLA WEIN', 'VIN MANZANILLA'),
(28, 'OLOROSO DULCE', 6, 0, 2, 5, 'FFFFFF', NULL, 0, 'OLOROSO DULCE', 'OLOROSO SWEET', 'OLOROSO SWEET', 'OLOROSO DOUX'),
(29, 'OLOROSO SECO', 6, 0, 2, 5, 'FFFFFF', '', 0, 'OLOROSO SECO', 'OLOROSO DRY', 'OLOROSO TROCKEN', 'OLOROSO DRY'),
(31, 'ZUMOS', 21, 0, 2, 5, 'FFFFFF', 'zumos.png', 0, 'ZUMOS', 'JUICE', 'SAFT', 'JUS'),
(33, 'ENSALADAS', 32, 0, 1, 2, '70FF83', 'ensaladas.png', 0, 'ENSALADAS', 'SALADS', 'SALATE', 'SALADES');

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

--
-- Volcado de datos para la tabla `grupos_modificadores`
--

INSERT INTO `grupos_modificadores` (`id_grupo`, `nombre`, `observ`, `nombre_es`, `nombre_en`, `nombre_de`, `nombre_fr`) VALUES
(1, 'CON', 'para los pelotazos', 'CON', 'WITH', 'MIT', 'AVEC'),
(2, 'PUNTO', 'pa las carnes', 'PUNTO', 'MEAT POINT', 'FLEISCH POINT', 'POINT DE VIANDE'),
(3, 'GUAR NICION', 'guarniciones', 'GUAR NICION', 'SIDES', NULL, NULL),
(4, 'SALSA', 'salsas', 'SALSA', 'SAUCE', 'SOSSE', 'SALSA'),
(18, 'TALL. NIÑO', NULL, 'TALL. NIÑO', 'NOODLES KIDS', 'NUDELN KINDER', 'NOUILLES ENFANTS'),
(19, 'EMP N', NULL, 'EMP N', 'BREADED', 'PANIERTE', 'PANÉ'),
(8, 'VERDURAS', NULL, 'VERDURAS', 'VEGETABLES', 'GEMÜSE', 'LÉGUMES'),
(9, 'CREMAS', NULL, 'CREMAS', 'CREAMS', 'CREMES', 'CRÉMES'),
(10, 'BERONIA', NULL, 'BERONIA', 'BERONIA', 'BERONIA', 'BERONIA'),
(11, 'TINTO', NULL, 'TINTO', 'RED WINE', 'ROTWEIN', 'VIN ROUGE'),
(12, 'MEZCLA', NULL, 'MEZCLA', 'MIX', 'MIXTUR', 'MIX'),
(14, 'WALDORF', NULL, 'WALDORF', 'WALDORF', 'WALDORF', 'WALDORF'),
(15, 'ENSALADAS', NULL, 'ENSALADAS', 'SALADS', 'SALATS', 'SALADES'),
(16, 'ENSALADA SIMPLE', NULL, 'ENSALADA SIMPLE', 'NORMAL SALAD', 'EINFACHEN SALAT', 'SALADE DE SIMPLE'),
(17, 'ENSALADA CASA', NULL, 'ENSALADA CASA', 'HOUSE SALAD', 'HAUS SALAT', 'MAISON SALADE'),
(20, 'TALL', NULL, 'TALL', 'NOODLE', 'NUDELN', 'NOUILLES'),
(21, 'EMPANADO', NULL, 'EMPANADO', 'BREADED', 'PANIERTE', 'PANÉ'),
(22, 'ALITAS', NULL, 'ALITAS', 'HOT WINGS', 'HOT WINGS', 'HOT WINGS');

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

--
-- Volcado de datos para la tabla `historial_puntos`
--

INSERT INTO `historial_puntos` (`id_hist`, `fecha`, `fecha_fin`, `hora_apertura`, `hora_cierre`, `punto`, `comensal`, `cobrada`, `anulado`, `propina`, `descuento`, `usuario`) VALUES
(1069, '2013-05-29', '0000-00-00', '10:45:00', '00:00:00', '222', '1', 'N', 'S', '0.00', '0.00', 'ALI'),
(1068, '2013-05-29', '0000-00-00', '10:44:00', '00:00:00', '222', '1', 'S', 'S', '0.00', '0.00', 'ALI'),
(1067, '2013-05-29', '0000-00-00', '10:43:00', '00:00:00', 'pepe', '1', 'N', 'S', '0.00', '0.00', 'ALI'),
(1064, '2013-05-29', '0000-00-00', '10:37:00', '00:00:00', '55', '1', 'S', 'S', '0.00', '0.00', 'ALI'),
(1065, '2013-05-29', '0000-00-00', '10:40:00', '00:00:00', 'qqqqqqqqqqqqqqqqqqqqqqq', '1', 'S', 'S', '0.00', '0.00', 'ALI'),
(1066, '2013-05-29', '0000-00-00', '10:40:00', '00:00:00', '2222', '1', 'S', 'S', '0.00', '0.00', 'ALI'),
(1063, '2013-05-29', '0000-00-00', '10:34:00', '00:00:00', 'ddddddddddddddddddddd', '1', 'S', 'S', '0.00', '0.00', 'ALI'),
(1062, '2013-05-29', '0000-00-00', '10:25:00', '00:00:00', '1111', '1', 'S', 'S', '0.00', '0.00', 'ALI'),
(1061, '2013-05-29', '0000-00-00', '10:21:00', '00:00:00', 'luismi', '1', 'N', 'S', '0.00', '0.00', 'ALI'),
(1060, '2013-05-29', '0000-00-00', '10:20:00', '00:00:00', '', '', 'N', 'S', '0.00', '0.00', 'ALI'),
(1059, '2013-05-29', '0000-00-00', '10:20:00', '00:00:00', '', '', 'N', 'S', '0.00', '0.00', 'ALI'),
(1058, '2013-05-29', '0000-00-00', '10:20:00', '00:00:00', '', '', 'N', 'S', '0.00', '0.00', 'ALI'),
(1057, '2013-05-29', '0000-00-00', '10:20:00', '00:00:00', '', '', 'N', 'S', '0.00', '0.00', 'ALI'),
(1055, '2013-05-27', '0000-00-00', '13:24:00', '00:00:00', 'P2', '2', 'N', 'S', '10.00', '0.00', 'UWE'),
(1054, '2013-05-27', '0000-00-00', '12:24:00', '00:00:00', '4', '1', 'S', 'S', '10.00', '0.00', 'LUISMI'),
(1053, '2013-05-27', '0000-00-00', '09:50:00', '00:00:00', '7', '1', 'S', 'S', '10.00', '0.00', 'ALI'),
(1052, '2013-05-27', '0000-00-00', '09:36:00', '00:00:00', '7', '1', 'S', 'S', '10.00', '0.00', 'ALI'),
(1051, '2013-05-27', '0000-00-00', '09:31:00', '00:00:00', '6', '2', 'S', 'S', '10.00', '0.00', 'ALI'),
(1049, '2013-05-26', '0000-00-00', '20:42:00', '00:00:00', '7', '1', 'S', 'S', '0.00', '0.00', 'ALI'),
(1048, '2013-05-26', '0000-00-00', '20:28:00', '00:00:00', '6', 'rafa', 'S', 'S', '0.00', '0.00', 'ALI'),
(1047, '2013-05-26', '0000-00-00', '19:24:00', '00:00:00', '6', 'perete', 'S', 'S', '0.00', '0.00', 'ALI'),
(1046, '2013-05-26', '0000-00-00', '18:36:00', '00:00:00', '6', 'Andres', 'S', 'S', '0.00', '0.00', 'ALI'),
(1045, '2013-05-26', '0000-00-00', '18:20:00', '00:00:00', '15', '1', 'S', 'S', '0.00', '0.00', 'ALI'),
(1044, '2013-05-26', '0000-00-00', '18:13:00', '00:00:00', '6', 'Javier', 'N', 'S', '0.00', '0.00', 'ALI'),
(1043, '2013-05-26', '0000-00-00', '18:13:00', '00:00:00', '6', 'Pedro', 'N', 'S', '0.00', '0.00', 'ALI'),
(1056, '2013-05-29', '0000-00-00', '10:19:00', '00:00:00', '', '', 'N', 'S', '0.00', '0.00', 'ALI'),
(1041, '2013-05-26', '0000-00-00', '18:11:00', '00:00:00', '7', '1', 'S', 'S', '0.00', '0.00', 'ALI');

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

--
-- Volcado de datos para la tabla `historial_puntos_descr`
--

INSERT INTO `historial_puntos_descr` (`id_hist_descr`, `id_hist_punto`, `comensal`, `idarticulo`, `articulo`, `cantidad`, `pvp`, `usuario`, `hora`, `invitacion`, `enviado`, `anulado`, `llevar`, `mods`, `observ`, `mods_lang`) VALUES
(3569, '1069', '1', 59, 'MERLUZA A LA VASCA', '1.000', '12.50', 'ALI', '10:45:00', 'N', 'S', 'S', 'S', '', '', ''),
(3568, '1069', '1', 109, 'ENSALADA CASA', '1.000', '5.00', 'ALI', '10:45:00', 'N', 'S', 'S', 'S', 'SIN REMOLACHA ', '', '82 '),
(3567, '1069', '1', 0, 'REPARTO', '1.000', '1.00', 'ALI', '10:45:00', 'N', 'S', 'S', 'S', '', NULL, NULL),
(3566, '1068', '1', 59, 'MERLUZA A LA VASCA', '1.000', '12.50', 'ALI', '10:44:00', 'N', 'S', 'N', 'S', '', '', ''),
(3565, '1068', '1', 117, 'MUSAKA PLATO', '1.000', '10.00', 'ALI', '10:44:00', 'N', 'S', 'N', 'S', '', '', ''),
(3564, '1068', '1', 0, 'REPARTO', '1.000', '1.00', 'ALI', '10:44:00', 'N', 'S', 'N', 'S', '', NULL, NULL),
(3562, '1066', '1', 99, 'MORCILLA', '4.000', '24.00', 'ALI', '10:41:00', 'N', 'S', 'N', 'S', '', '', ''),
(3563, '1067', '1', 47, 'LOMO CERDO', '1.000', '12.00', 'ALI', '10:43:00', 'N', 'S', 'S', 'S', 'PATATAS ', '', '13 '),
(3561, '1066', '1', 47, 'LOMO CERDO', '1.000', '12.00', 'ALI', '10:41:00', 'N', 'S', 'N', 'S', 'BIEN ', '', '12 '),
(3560, '1066', '1', 0, 'REPARTO', '1.000', '1.00', 'ALI', '10:40:00', 'N', 'S', 'N', 'S', '', NULL, NULL),
(3559, '1065', '1', 117, 'MUSAKA PLATO', '1.000', '10.00', 'ALI', '10:40:00', 'N', 'S', 'N', 'S', '', '', ''),
(3558, '1063', '1', 70, 'AGUA', '4.000', '4.80', 'ALI', '10:40:00', 'N', 'S', 'N', 'S', '', '', ''),
(3557, '1064', '1', 42, 'CHURRASCO ARGENTINO', '1.000', '21.50', 'ALI', '10:39:00', 'N', 'S', 'N', 'S', 'BIEN ', '', '12 '),
(3556, '1062', '1', 118, 'TALLARINES', '1.000', '12.00', 'ALI', '10:38:00', 'N', 'S', 'N', 'S', 'AL PESTO ', '', '111 '),
(3555, '1064', '1', 46, 'CHULETON AVILA', '1.000', '18.00', 'ALI', '10:37:00', 'N', 'S', 'N', 'S', 'SP ', '', '10 '),
(3554, '1064', '1', 0, 'REPARTO', '1.000', '1.00', 'ALI', '10:37:00', 'N', 'S', 'N', 'S', '', NULL, NULL),
(3553, '1063', '1', 118, 'TALLARINES', '1.000', '6.00', 'ALI', '10:34:00', 'N', 'S', 'N', 'S', 'AL PESTO ', '', '111 '),
(3552, '1062', '1', 0, 'REPARTO', '1.000', '1.00', 'ALI', '10:25:00', 'N', 'S', 'N', 'S', '', NULL, NULL),
(3551, '1061', '1', 60, 'PEZ ESPADA', '1.000', '12.10', 'ALI', '10:21:00', 'N', 'S', 'S', 'S', '', '', ''),
(3550, '1061', '1', 120, 'EMPANADO', '1.000', '7.50', 'ALI', '10:21:00', 'N', 'S', 'S', 'S', 'PATATAS ', '', '13 '),
(3549, '1056', '', 60, 'PEZ ESPADA', '3.000', '36.30', 'ALI', '10:19:00', 'N', 'S', 'S', 'S', '', '', ''),
(3547, '1051', '1', 46, 'CHULETON AVILA', '100.000', '1200.00', 'UWE', '13:25:00', 'N', 'S', 'N', 'N', 'PATATAS ', '', '13 '),
(3548, '1051', '2', 47, 'LOMO CERDO', '1000.000', '12000.00', 'UWE', '13:30:00', 'N', 'S', 'N', 'N', 'BIEN ', '', '12 '),
(3545, '1055', '2', 45, 'CHULETON BUEY', '100.000', '1200.00', 'UWE', '13:24:00', 'N', 'S', 'N', 'N', 'BIEN ', '', '12 '),
(3546, '1051', '2', 45, 'CHULETON BUEY', '100.000', '1200.00', 'UWE', '13:24:00', 'N', 'S', 'N', 'N', 'BIEN ', '', '12 '),
(3541, '1051', '2', 72, 'COLA LIGHT', '13.000', '18.20', 'ALI', '09:53:00', 'N', 'S', 'N', 'N', '', '', ''),
(3542, '1051', '1', 68, 'FANTA NARANJA', '2.000', '2.80', 'ALI', '09:54:00', 'N', 'S', 'N', 'N', '', '', ''),
(3543, '1054', '1', 108, 'ENSALADA SIMPLE', '1.000', '4.00', 'LUISMI', '12:24:00', 'N', 'S', 'N', 'N', 'SIN REMOLACHA ', '', '82 '),
(3538, '1051', '2', 128, 'CREPS', '11.000', '38.50', 'ALI', '09:49:00', 'N', 'S', 'N', 'N', '', '', ''),
(3539, '1053', '1', 71, 'AGUA GAS', '69.000', '96.60', 'ALI', '09:50:00', 'N', 'S', 'N', 'N', '', '', ''),
(3544, '1054', '1', 46, 'CHULETON AVILA', '1.000', '12.00', 'ALI', '12:24:00', 'N', 'S', 'N', 'N', 'POCO PISTO ', '', '8 14 '),
(3537, '1052', '1', 33, 'DYC', '1.000', '2.50', 'ALI', '09:37:00', 'N', 'S', 'N', 'N', '', '', ''),
(3536, '1052', '1', 94, 'ZUMO PIÃ‘A', '1.000', '1.40', 'ALI', '09:36:00', 'N', 'S', 'N', 'N', '', '', ''),
(3535, '1051', '2', 122, 'GAMBAS CREMA PLATO', '1.000', '9.50', 'ALI', '09:31:00', 'N', 'S', 'N', 'N', '', '', ''),
(3532, '1048', 'rafa', 94, 'ZUMO PIÃ‘A', '1.000', '1.40', 'ALI', '20:29:00', 'N', 'S', 'N', 'N', '', '', ''),
(3533, '1049', '1', 46, 'CHULETON AVILA', '1.000', '12.00', 'ALI', '20:42:00', 'N', 'S', 'N', 'N', 'SP ', '', '10 '),
(3534, '1051', '1', 42, 'CHURRASCO ARGENTINO', '1.000', '9.50', 'ALI', '09:31:00', 'N', 'S', 'N', 'N', 'BIEN ', '', '12 '),
(3531, '1048', 'rafa', 42, 'CHURRASCO ARGENTINO', '1.000', '9.50', 'ALI', '20:29:00', 'N', 'S', 'N', 'N', 'BIEN PATATAS ', '', '12 13 '),
(3529, '1046', 'Andres', 103, 'GAMBAS AJILLO', '1.000', '10.00', 'ALI', '18:37:00', 'N', 'S', 'N', 'N', '', '', ''),
(3530, '1047', 'perete', 18, 'CERVEZA BARRIL', '3.000', '3.60', 'ALI', '19:24:00', 'N', 'S', 'N', 'N', '', '', ''),
(3528, '1046', 'Andres', 126, 'CERDO NIÑO', '1.000', '6.00', 'ALI', '18:37:00', 'N', 'S', 'S', 'N', 'BIEN ', '', '12 '),
(3527, '1046', 'Andres', 124, 'CROQUETAS NIÃ‘O', '1.000', '5.00', 'ALI', '18:37:00', 'N', 'S', 'N', 'N', '', '', ''),
(3526, '1046', 'Andres', 86, 'COPA RIOJA', '1.000', '2.40', 'ALI', '18:37:00', 'N', 'S', 'N', 'N', '', '', ''),
(3523, '1045', 'Pedro', 85, 'SANGRIA 1/2', '1.000', '4.00', 'ALI', '18:16:00', 'N', 'S', 'N', 'N', '', '', ''),
(3524, '1046', 'Andres', 93, 'ZUMO NARANJA', '2.000', '2.80', 'ALI', '18:37:00', 'N', 'S', 'N', 'N', '', '', ''),
(3525, '1046', 'Andres', 68, 'FANTA NARANJA', '1.000', '1.40', 'ALI', '18:37:00', 'N', 'S', 'N', 'N', '', '', ''),
(3522, '1045', 'Pedro', 94, 'ZUMO PIÃ‘A', '1.000', '1.40', 'ALI', '18:16:00', 'N', 'S', 'N', 'N', '', '', ''),
(3521, '1045', 'Pedro', 117, 'MUSAKA PLATO', '1.000', '10.00', 'ALI', '18:16:00', 'N', 'S', 'N', 'N', '', '', ''),
(3519, '1048', 'Juan', 46, 'CHULETON AVILA', '1.000', '12.00', 'ALI', '18:13:00', 'N', 'S', 'N', 'N', 'POCO ENSALADA ', '', '8 15 '),
(3520, '1045', 'Pedro', 124, 'CROQUETAS NIÃ‘O', '1.000', '5.00', 'ALI', '18:16:00', 'N', 'S', 'N', 'N', '', '', ''),
(3517, '1048', 'Javier', 101, 'MOLLEJAS ENTRANTE', '1.000', '15.00', 'ALI', '18:13:00', 'N', 'S', 'N', 'N', '', '', ''),
(3518, '1048', 'Juan', 39, 'RON BACARDI', '1.000', '3.00', 'ALI', '18:13:00', 'N', 'S', 'N', 'N', '', '', ''),
(3515, '1041', '1', 98, 'CHISTORRAS', '1.000', '5.00', 'ALI', '18:12:00', 'N', 'S', 'N', 'N', '', '', ''),
(3516, '1048', 'Javier', 70, 'AGUA', '1.000', '1.20', 'ALI', '18:13:00', 'N', 'S', 'N', 'N', '', '', ''),
(3514, '1041', '1', 61, 'COCA COLA', '1.000', '1.40', 'ALI', '18:11:00', 'N', 'S', 'N', 'N', '', '', ''),
(3513, '1041', '1', 71, 'AGUA GAS', '1.000', '1.40', 'ALI', '18:11:00', 'N', 'S', 'N', 'N', '', '', ''),
(3512, '1041', '1', 18, 'CERVEZA BARRIL', '2.000', '2.40', 'ALI', '18:11:00', 'N', 'S', 'N', 'N', '', '', '');

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

--
-- Volcado de datos para la tabla `hist_stock`
--

INSERT INTO `hist_stock` (`id_hs`, `fecha`, `hora`, `idart`, `articulo`, `uds`) VALUES
(1, '2013-05-27', '19:36:00', 91, 'BITTER KAS', 3),
(2, '2013-05-27', '20:02:00', 114, 'SALMON A LA PLANCHA', 6),
(3, '2013-05-28', '11:22:00', 114, 'SALMON A LA PLANCHA', 10),
(4, '2013-05-28', '12:39:00', 45, 'CHULETON BUEY', -296),
(5, '2013-05-28', '12:40:00', 45, 'CHULETON BUEY', 591);

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

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id_log`, `fecha`, `hora`, `usuario`, `ip`, `operacion`, `detalles`) VALUES
(552, '2013-05-26', '18:02:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(553, '2013-05-26', '18:02:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(554, '2013-05-26', '18:06:00', 'ALI', '192.168.1.65', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(555, '2013-05-26', '18:06:00', 'NATI', '192.168.1.65', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(556, '2013-05-26', '18:07:00', 'ALI', '192.168.1.66', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(557, '2013-05-26', '18:07:00', 'ANI', '192.168.1.66', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(558, '2013-05-26', '18:44:00', 'NATI', '192.168.1.65', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(559, '2013-05-26', '18:56:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(560, '2013-05-26', '18:56:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(561, '2013-05-26', '19:01:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(562, '2013-05-26', '19:01:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(563, '2013-05-26', '19:03:00', 'ALI', '127.0.0.1', 'ANULA LINEA', 'Linea anulada: 3528'),
(564, '2013-05-26', '19:05:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(565, '2013-05-26', '19:06:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(566, '2013-05-26', '19:11:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(567, '2013-05-26', '19:14:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(568, '2013-05-26', '20:52:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(569, '2013-05-26', '20:52:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(570, '2013-05-26', '21:00:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(571, '2013-05-26', '21:00:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(572, '2013-05-26', '21:12:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(573, '2013-05-26', '21:13:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(574, '2013-05-26', '21:13:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(575, '2013-05-27', '09:17:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(576, '2013-05-27', '09:18:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(577, '2013-05-27', '09:18:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(578, '2013-05-27', '09:18:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(579, '2013-05-27', '09:20:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(580, '2013-05-27', '09:31:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(581, '2013-05-27', '09:31:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(582, '2013-05-27', '09:45:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(583, '2013-05-27', '09:45:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(584, '2013-05-27', '09:45:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(585, '2013-05-27', '09:49:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(586, '2013-05-27', '11:26:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(587, '2013-05-27', '11:27:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(588, '2013-05-27', '11:34:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(589, '2013-05-27', '12:24:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(590, '2013-05-27', '12:24:00', 'LUISMI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(591, '2013-05-27', '12:24:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(592, '2013-05-27', '12:25:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(593, '2013-05-27', '14:14:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(594, '2013-05-27', '14:15:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(595, '2013-05-27', '14:15:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(596, '2013-05-27', '14:24:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(597, '2013-05-27', '16:05:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(598, '2013-05-27', '16:36:00', 'ALI', '192.168.1.89', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(599, '2013-05-27', '16:36:00', 'mips', '192.168.1.89', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(600, '2013-05-27', '16:47:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(601, '2013-05-28', '09:33:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(602, '2013-05-28', '09:33:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(603, '2013-05-28', '09:33:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(604, '2013-05-28', '10:56:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(605, '2013-05-28', '10:59:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(606, '2013-05-28', '12:03:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(607, '2013-05-28', '12:03:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(608, '2013-05-28', '12:04:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(609, '2013-05-28', '14:12:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(610, '2013-05-28', '14:19:00', 'ALI', '192.168.1.112', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(611, '2013-05-28', '14:20:00', 'ALI', '192.168.1.112', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(612, '2013-05-28', '14:20:00', 'mips', '192.168.1.112', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(613, '2013-05-28', '19:42:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(614, '2013-05-28', '19:42:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(615, '2013-05-29', '09:57:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(616, '2013-05-29', '09:57:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(617, '2013-05-29', '10:01:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(618, '2013-05-29', '10:01:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(619, '2013-05-29', '10:18:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(620, '2013-05-29', '10:18:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(621, '2013-05-29', '10:20:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(622, '2013-05-29', '10:29:00', 'ALI', '127.0.0.1', 'ANULA COMANDA', 'Mesa anulada: luismi Comensal: 1'),
(623, '2013-05-29', '10:29:00', 'ALI', '127.0.0.1', 'ANULA COMANDA', 'Mesa anulada: paco Comensal: 1'),
(624, '2013-05-29', '10:30:00', 'ALI', '127.0.0.1', 'ANULA COMANDA', 'Mesa anulada: cyro Comensal: 1'),
(625, '2013-05-29', '10:32:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(626, '2013-05-29', '10:32:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(627, '2013-05-29', '10:32:00', 'ALI', '127.0.0.1', 'ANULA COMANDA', 'Mesa anulada: aaaaaaaaaaaaaaa Comensal: 1'),
(628, '2013-05-29', '10:32:00', 'ALI', '127.0.0.1', 'ANULA COMANDA', 'Mesa anulada: ali Comensal: 1'),
(629, '2013-05-29', '10:32:00', 'ALI', '127.0.0.1', 'ANULA COMANDA', 'Mesa anulada: pepe Comensal: 1'),
(630, '2013-05-29', '10:34:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(631, '2013-05-29', '10:42:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(632, '2013-05-29', '10:43:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(633, '2013-05-29', '10:49:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(634, '2013-05-29', '10:49:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(635, '2013-05-29', '10:50:00', 'ALI', '127.0.0.1', 'ANULA COMANDA', 'Mesa anulada: pepe Comensal: 1'),
(636, '2013-06-04', '09:50:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(637, '2013-06-04', '09:50:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(638, '2013-06-04', '09:50:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(639, '2013-06-04', '09:51:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(640, '2013-06-04', '09:51:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(641, '2013-06-04', '09:51:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(642, '2013-06-04', '09:51:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(643, '2013-06-04', '09:52:00', 'ROSI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(644, '2013-06-04', '09:53:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(645, '2013-06-04', '09:53:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(646, '2013-06-04', '09:54:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(647, '2013-06-04', '09:54:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(648, '2013-06-04', '09:54:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Usuario Unico'),
(649, '2013-06-04', '09:55:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(650, '2013-06-04', '09:55:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(651, '2013-06-04', '09:56:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(652, '2013-06-04', '09:56:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(653, '2013-06-04', '09:56:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(654, '2013-06-04', '09:56:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(655, '2013-06-04', '09:57:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(656, '2013-06-04', '09:57:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(657, '2013-06-04', '09:57:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(658, '2013-06-04', '09:57:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(659, '2013-06-04', '09:58:00', 'mips', '127.0.0.1', 'ANULA COMANDA', 'Mesa anulada:  Comensal: '),
(660, '2013-06-04', '09:58:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(661, '2013-06-04', '09:58:00', 'mips', '127.0.0.1', 'ANULA COMANDA', 'Mesa anulada:  Comensal: '),
(662, '2013-06-04', '09:59:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(663, '2013-06-04', '09:59:00', 'mips', '127.0.0.1', 'ANULA COMANDA', 'Mesa anulada:  Comensal: '),
(664, '2013-06-04', '09:59:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(665, '2013-06-04', '10:00:00', 'mips', '127.0.0.1', 'ANULA COMANDA', 'Mesa anulada: 222 Comensal: 1'),
(666, '2013-06-04', '10:02:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(667, '2013-06-04', '10:03:00', 'mips', '127.0.0.1', 'ANULA COMANDA', 'Mesa anulada: 222 Comensal: 1'),
(668, '2013-06-04', '10:03:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(669, '2013-06-04', '10:03:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla LOGIN. Apertura para varios usuarios.'),
(670, '2013-06-04', '10:03:00', 'mips', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios'),
(671, '2013-06-04', '10:04:00', 'ALI', '127.0.0.1', 'ACCESO', 'Desde pantalla seleccion usuarios');

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

--
-- Volcado de datos para la tabla `modificadores`
--

INSERT INTO `modificadores` (`id_modificador`, `nombre`, `precio`, `observ`, `imagen`, `nombre_es`, `nombre_en`, `nombre_de`, `nombre_fr`) VALUES
(1, 'COLA', '1.20', '', 'programa/bArticulo.png', 'COLA', 'COKE', 'COKE', 'COKE'),
(66, 'NARANJA', '1.40', '', '', 'NARANJA', 'ORANGE', 'APFELSINE', 'ORANGE'),
(3, 'LIMON', '0.00', '', 'programa/bArticulo.png', 'LIMON', 'LEMON', 'ZITRONE', 'CITRON'),
(64, 'CASERA', '1.40', '', '', 'CASERA', 'CASERA', 'CASERA', 'CASERA'),
(5, '7UP', '0.00', '', 'programa/bArticulo.png', '7UP', '7UP', '7UP', '7UP'),
(7, 'ZUMO', '0.00', '', 'programa/bArticulo.png', 'ZUMO', 'JUICE', 'SAFT', 'JUS'),
(8, 'POCO', '0.00', '', 'programa/bArticulo.png', 'POCO', 'REAR', 'WENIG TATSACHE', 'FAIT PEU'),
(9, 'P--', '0.00', '0', 'programa/bArticulo.png', 'P--', 'MEDIUM REAR', 'MITTEL HINTERE', 'ARRIERE MEDIUM'),
(10, 'SP', '0.00', '0', 'programa/bArticulo.png', 'SP', 'MEDIUM', 'GAR', 'MEDIUM'),
(11, 'P++', '0.00', '0', 'programa/bArticulo.png', 'P++', 'MEDIUM WELL', 'EINIGE FRÜHERE', 'UN PASSÉ'),
(12, 'BIEN', '0.00', '0', 'programa/bArticulo.png', 'BIEN', 'WELL DONE', 'GUT GEMACHT', 'BIEN FAIT'),
(13, 'PATATAS', '0.00', '0', 'programa/bArticulo.png', 'PATATAS', 'FRIED FRENCH', 'CHIPS', 'CHIPS'),
(14, 'PISTO', '0.00', '0', 'programa/bArticulo.png', 'PISTO', 'VEGETABLES', 'GEMÜSE', 'LÉGUMES'),
(15, 'ENSALADA', '0.00', '0', 'programa/bArticulo.png', 'ENSALADA', 'SALAD', 'SALAT', 'SALADE'),
(16, 'PIMIENTA', '0.00', '0', 'programa/bArticulo.png', 'PIMIENTA', 'PEPPER', 'PFEFFER', 'POIVRE'),
(17, 'ROQUEFORT', '0.00', '0', 'programa/bArticulo.png', 'ROQUEFORT', 'BLUE CHEESSE', 'ROQUEFORT', 'ROQUEFORT'),
(18, 'CREMA', '0.00', '0', 'programa/bArticulo.png', 'CREMA', 'CREAM', 'CREME', 'CRÉME'),
(19, 'CASTELLANA', '0.00', '0', 'programa/bArticulo.png', 'CASTELLANA', 'CASTELLANA', 'CASTELLANA', 'CASTELLANA'),
(20, 'CURRY', '0.00', '0', 'programa/bArticulo.png', 'CURRY', 'CURRY', 'CURRY', 'CURRY'),
(21, 'TERNERA', '1.00', '0', 'programa/bArticulo.png', 'TERNERA', 'BEEF', NULL, NULL),
(22, 'CHORIZO', '1.00', '0', 'programa/bArticulo.png', 'CHORIZO', 'SAUSAGE', NULL, NULL),
(23, 'CEBOLLA', '1.00', '0', 'programa/bArticulo.png', 'CEBOLLA', 'ONION', NULL, NULL),
(24, 'PIMIENTO', '1.00', '0', 'programa/bArticulo.png', 'PIMIENTO', 'PEPPERS', NULL, NULL),
(25, 'ANCHOAS', '1.00', '0', 'programa/bArticulo.png', 'ANCHOAS', 'ANCHOVIES', NULL, NULL),
(26, 'JAMON', '1.00', '0', 'programa/bArticulo.png', 'JAMON', 'HAM', NULL, NULL),
(27, 'DOBLE QUESO', '1.00', '0', 'programa/bArticulo.png', 'DOBLE QUESO', 'DOUBLE CHEESSE', NULL, NULL),
(28, 'MEDIA TERNERA', '0.50', '0', 'programa/bArticulo.png', 'MEDIA TERNERA', NULL, NULL, NULL),
(29, 'MEDIA CHORIZO', '0.50', '0', 'programa/bArticulo.png', 'MEDIA CHORIZO', NULL, NULL, NULL),
(30, 'MEDIA CEBOLLA', '0.50', '0', 'programa/bArticulo.png', 'MEDIA CEBOLLA', NULL, NULL, NULL),
(31, 'MEDIA PIMIENTO', '0.50', '0', 'programa/bArticulo.png', 'MEDIA PIMIENTO', NULL, NULL, NULL),
(32, 'MEDIA ANCHOAS', '0.50', '0', 'programa/bArticulo.png', 'MEDIA ANCHOAS', NULL, NULL, NULL),
(33, 'MEDIA JAMON', '0.50', '0', 'programa/bArticulo.png', 'MEDIA JAMON', NULL, NULL, NULL),
(52, 'AAAA', '1.00', 'NADA', '', 'AAAA', NULL, NULL, NULL),
(41, 'qqqqqqq', '11.00', 'qqqq', '', 'qqqqqqq', NULL, NULL, NULL),
(53, 'LEGUMBRES', '0.50', 'crema de legumbres', '', 'LEGUMBRES', NULL, NULL, NULL),
(46, 'qqqq', '2.00', '', '', 'qqqq', NULL, NULL, NULL),
(49, 'aaaa', '2.00', '', '', 'aaaa', NULL, NULL, NULL),
(50, 'aaaa', '2.00', '', '', 'aaaa', NULL, NULL, NULL),
(56, 'BERENJENA', '0.00', '0', '', 'BERENJENA', NULL, NULL, NULL),
(57, 'BERENJENA', '0.00', '0', '', 'BERENJENA', NULL, NULL, NULL),
(58, 'COPA', '2.50', '', '', 'COPA', 'CUP', 'KELCHGLAS', 'COPA'),
(59, 'BOTELLA CRIANZA', '20.00', '', '', 'BOTELLA CRIANZA', 'BREEDING BOTTLE', 'ZIEHEN FLASCHE', 'ELEVAGE BOUTEILLE'),
(60, 'BOTELLA RESERVA', '30.00', '', '', 'BOTELLA RESERVA', 'RESERVE BOTTLE', 'ALTER FLASCHE', 'RESERVE BOUTEILLE'),
(61, '1/2 BOTELLA', '10.00', '', '', '1/2 BOTELLA', 'HALF BOTTLE', 'HALBE FLASCHE', 'DEMI BOUTEILLE'),
(62, 'LIMON', '1.40', '', '', 'LIMON', 'LEMON', 'ZITRONE', 'CITRON'),
(63, 'CASERA', '1.40', '', '', 'CASERA', 'CASERA', 'CASERA', 'CASERA'),
(65, 'NARANJA', '1.40', '', '', 'NARANJA', 'ORANGE', 'APFELSINE', 'ORANGE'),
(67, '7UP', '1.50', '', '', '7UP', '7UP', '7UP', '7UP'),
(68, '1/2 JARRA', '1.00', '', '', '1/2 JARRA', 'HALF PITCH', 'HALF PITCHER', 'MEDIA PICHET'),
(69, 'JARRA', '5.00', '', '', 'JARRA', 'PITCH', 'PITCHER', 'PICHET'),
(70, 'CORTO', '0.00', '', '', 'CORTO', 'SHORT', 'KURZ', 'COURT'),
(71, 'CORTO', '0.00', '', '', 'CORTO', 'SHORT', 'KURZ', 'COURT'),
(72, 'LARGO', '0.00', '', '', 'LARGO', 'BIG', 'LÄNGE', 'LONGUE'),
(73, '1 HIELO', '0.00', '', '', '1 HIELO', '1 ICE', '1 EIS', '1 CIE'),
(74, 'SIN HIELO', '0.00', '', '', 'SIN HIELO', 'NO ICE', 'KEIN EIS', 'PAS DE GLACE'),
(75, '1P', '4.00', '', '', '1P', '1 PERSON', '1 MENSCH', '1 PERSONNE'),
(124, '2P', '8.00', 'ENSALADA CASA', '', '2P', '2 PERSON', '2 MENSCHEN', '2 PERSONNES'),
(77, 'SIN PASAS', '0.00', '', '', 'SIN PASAS', 'NO RAISINS', NULL, NULL),
(78, 'SIN TOMATE', '0.00', '', '', 'SIN TOMATE', 'NO TOMATOE', NULL, NULL),
(79, 'SIN CEBOLLA', '0.00', '', '', 'SIN CEBOLLA', 'NO ONION', NULL, NULL),
(80, 'SIN ATUN', '0.00', '', '', 'SIN ATUN', 'NO TUNA', NULL, NULL),
(81, 'SIN MAIZ', '0.00', '', '', 'SIN MAIZ', 'NO CORN', NULL, NULL),
(82, 'SIN REMOLACHA', '0.00', '', '', 'SIN REMOLACHA', 'NO BEET', NULL, NULL),
(83, 'SIN QUESO', '0.00', '', '', 'SIN QUESO', 'NO CHEESSE', NULL, NULL),
(84, 'QUESO APARTE', '0.00', '', '', 'QUESO APARTE', 'CHEESSE ASIDE', NULL, NULL),
(85, '1P', '3.50', '', '', '1P', '1 PERSON', NULL, NULL),
(86, '2P', '6.20', '', '', '2P', '2 PERSONS', NULL, NULL),
(87, '1P', '5.00', '', '', '1P', '1 PERSON', NULL, NULL),
(88, '2P', '8.00', '', '', '2P', '2 PERSONS', NULL, NULL),
(89, 'TOMATE', '3.50', '', '', 'TOMATE', 'TOMATOE', 'TOMATO', 'TOMATE'),
(90, 'BOLOÑESA', '4.00', '', '', 'BOLOÑESA', 'BOLOGNESE', 'BOLOGNESE', 'BOLOGNESE'),
(102, 'CARBONARA', '5.20', '', '', 'CARBONARA', 'CARBONARA', 'CARBONARA', 'CARBONARA'),
(104, 'TRES QUESOS', '5.80', '', '', 'TRES QUESOS', '3 CHEESE', '3 KÄSE', '3 FROMAGE'),
(111, 'AL PESTO', '6.00', '', '', 'AL PESTO', 'PESTO', 'PESTO', 'PESTO'),
(114, 'POLLO', '7.50', '', '', 'POLLO', 'CHICKEN', 'HÜHNCHEN', 'POULET'),
(116, 'CERDO', '7.50', '', '', 'CERDO', 'PORK', 'SCHWEIN', 'PORC'),
(96, 'PISTO', '0.00', '', '', 'PISTO', 'VEGETABLES', 'GEMÜSE', 'LÉGUMES'),
(97, 'PATATAS', '0.00', '', '', 'PATATAS', 'FRIED FRENCH', 'CHIPS', 'CHIPS'),
(98, 'ENSALADA', '0.00', '', '', 'ENSALADA', 'SALAD', 'SALAT', 'SALADE'),
(99, 'CELIACO', '0.00', '', '', 'CELIACO', 'CELIAC', 'ZÖLIAKIE', 'COELIAQUE'),
(100, 'BOLOÑESA', '5.20', '', '', 'BOLOÑESA', 'BOLOGNESE', 'BOLOGNESE', 'BOLOGNESE'),
(101, 'CARBONARA', '5.20', '', '', 'CARBONARA', 'CARBONARA', 'CARBONARA', 'CARBONARA'),
(103, 'TRES QUESOS', '5.60', '', '', 'TRES QUESOS', '3 CHEESE', '3 KÄSE', '3 FROMAGE'),
(105, 'AL PESTO', '6.00', '', '', 'AL PESTO', 'PESTO', 'PESTO', 'PESTO'),
(106, 'AL PESTO', '6.00', '', '', 'AL PESTO', 'PESTO', 'PESTO', 'PESTO'),
(108, 'AL PESTO', '6.00', '', '', 'AL PESTO', 'PESTO', 'PESTO', 'PESTO'),
(110, 'AL PESTO', '6.00', '', '', 'AL PESTO', 'PESTO', 'PESTO', 'PESTO'),
(112, 'GAMBAS CREMA', '7.00', '', '', 'GAMBAS CREMA', 'CREAM SHRIMPS', 'CREME GARNELEN', 'CREVETTES CREME'),
(113, 'POLLO', '7.50', '', '', 'POLLO', 'CHICKEN', 'HÜHNCHEN', 'POULET'),
(115, 'CERDO', '7.50', '', '', 'CERDO', 'PORK', 'SCHWEIN', 'PORC'),
(117, 'SALSA APARTE', '0.00', '', '', 'SALSA APARTE', 'SAUCE ASIDE', 'SAUCE AUF DER SEITE', 'SAUCE SUR LE CÔTÉ'),
(123, '2P', '8.00', 'ENSALADA CASA', '', '2P', '2 PERSONS', '2 MENSCHEN', '2 PERSONNES'),
(122, '2P', '6.00', 'ENSALADA SIMPLE', '', '2P', '2 PERSONS', '2 MENSCHEN', '2 PERSONNES'),
(128, 'con sal', '0.00', 'lapas', '', 'con sal', 'con sal', 'con sal', 'con sal');

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

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id_mov`, `id_caja`, `id_hist`, `punto`, `comensal`, `fecha_ini`, `hora_ini`, `fecha_fin`, `hora_fin`, `tipo_cobro`, `total`, `entregado`, `cobro_efectivo`, `cobro_tarjeta`, `invitacion`, `motivo_invitacion`, `observ`, `propina`, `descuento`) VALUES
(255, 21, 1068, '222', '1', '2013-05-29', '10:44:00', '2013-05-29', '10:45:00', 'T', '23.50', '0.00', '0.00', '23.50', 'N', '', '', '0.00', '0.00'),
(254, 21, 1063, 'dddddddddddddddddddd', '1', '2013-05-29', '10:34:00', '2013-05-29', '10:42:00', 'T', '10.80', '0.00', '0.00', '10.80', 'N', '', '', '0.00', '0.00'),
(253, 21, 1065, 'qqqqqqqqqqqqqqqqqqqq', '1', '2013-05-29', '10:40:00', '2013-05-29', '10:42:00', 'T', '10.00', '0.00', '0.00', '10.00', 'N', '', '', '0.00', '0.00'),
(252, 21, 1066, '2222', '1', '2013-05-29', '10:40:00', '2013-05-29', '10:42:00', 'T', '37.00', '0.00', '0.00', '37.00', 'N', '', '', '0.00', '0.00'),
(251, 21, 1062, '1111', '1', '2013-05-29', '10:25:00', '2013-05-29', '10:42:00', 'T', '13.00', '0.00', '0.00', '13.00', 'N', '', '', '0.00', '0.00'),
(250, 21, 1064, '55', '1', '2013-05-29', '10:37:00', '2013-05-29', '10:41:00', 'T', '40.50', '0.00', '0.00', '40.50', 'N', '', '', '0.00', '0.00'),
(249, 20, 1054, '4', '1', '2013-05-27', '12:24:00', '2013-05-27', '14:14:00', 'T', '17.60', '0.00', '0.00', '17.60', 'N', '', '', '1.60', '0.00'),
(248, 20, 1051, '6', '0', '2013-05-27', '09:31:00', '2013-05-27', '14:14:00', 'T', '15926.35', '0.00', '0.00', '15926.35', 'N', '', '', '1447.85', '0.00'),
(247, 20, 1053, '7', '1', '2013-05-27', '09:50:00', '2013-05-27', '09:53:00', 'T', '106.00', '0.00', '0.00', '106.00', 'N', '', '', '9.66', '0.00'),
(246, 20, 1052, '7', '1', '2013-05-27', '09:36:00', '2013-05-27', '09:45:00', 'T', '4.29', '0.00', '0.00', '4.29', 'N', '', '', '0.39', '0.00'),
(245, 19, 1048, '6', '0', '2013-05-26', '20:28:00', '2013-05-26', '21:12:00', 'T', '42.10', '0.00', '0.00', '42.10', 'N', '', '', '0.00', '0.00'),
(244, 19, 1049, '7', '1', '2013-05-26', '20:42:00', '2013-05-26', '21:12:00', 'T', '12.00', '0.00', '0.00', '12.00', 'N', '', '', '0.00', '0.00'),
(243, 19, 1047, '6', 'perete', '2013-05-26', '19:24:00', '2013-05-26', '19:27:00', 'T', '3.60', '0.00', '0.00', '3.60', 'N', '', '', '0.00', '0.00'),
(242, 19, 1046, '6', 'Andres', '2013-05-26', '18:36:00', '2013-05-26', '19:09:00', 'T', '21.60', '0.00', '0.00', '21.60', 'N', '', '', '0.00', '0.00'),
(241, 19, 1045, '15', '1', '2013-05-26', '18:20:00', '2013-05-26', '19:05:00', 'T', '20.40', '0.00', '0.00', '20.40', 'N', '', '', '0.00', '0.00'),
(240, 19, 1041, '7', '1', '2013-05-26', '18:11:00', '2013-05-26', '19:01:00', 'E', '10.20', '15.00', '10.20', '0.00', 'N', '', '', '0.00', '0.00');

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
(1, 'mips', 'mips', 'mips', 'zzzz', '0', 1, '0', 0, 'N', 'images/wkomander/skin/usuarios/admin.png'),
(2, 'ali', 'ali', 'ALI', '1111', '0', 5, '0', 0, 'N', 'images/wkomander/skin/usuarios/usuario2.png'),
(3, 'nati', 'nati', 'NATI', '1111', '0', 3, '0', 0, 'N', 'images/wkomander/skin/usuarios/usuario2.png'),
(4, 'CRIS', 'CRIS', 'CRISTOBAL', '1111', '0', 5, '0', 0, 'S', 'images/wkomander/skin/usuarios/usuario.png'),
(5, 'koke', 'koke', 'KOKE', '1111', '0', 3, '0', 0, 'N', 'images/wkomander/skin/usuarios/usuario.png'),
(6, 'trini', 'trini', 'TRINI', '1111', '0', 2, '0', 0, 'S', 'images/wkomander/skin/usuarios/usuario2.png'),
(7, 'luismi', 'luismi', 'LUISMI', '1111', '567', 2, '0', 0, 'S', 'images/wkomander/skin/usuarios/usuario.png'),
(8, 'ANI', 'ANI', 'ANI', '1111', '0', 3, '0', 0, 'N', 'images/wkomander/skin/usuarios/usuario2.png'),
(9, 'Nia', 'Nia', 'NIA', '1111', '0', 2, '0', 0, 'N', 'images/wkomander/skin/usuarios/usuario2.png'),
(10, 'Rosi', 'Rosi', 'ROSI', '1111', '0', 2, '0', 0, 'N', 'images/wkomander/skin/usuarios/usuario2.png'),
(11, 'Rafa', 'Rafa', 'FALE', '1111', '0', 2, '0', 0, 'N', 'images/wkomander/skin/usuarios/usuario.png');

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

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`id_zona`, `nombre`, `imagen`, `observ`, `grupo_impresion`, `grupo_visor`, `nombre_es`, `nombre_en`, `nombre_de`, `nombre_fr`, `orden`, `tipo`, `activo`) VALUES
(1, 'SALON', 'null', 'null', 0, 0, 'SALON', 'LOUNGE', 'SALON', 'SALON', 0, 'LOCAL', 1),
(2, 'BARRA', '', '', 0, 0, 'BARRA', 'BAR', 'TRESEN', 'BAR', 1, 'LOCAL', 1),
(3, 'TERRAZA', 'no', 'no', 0, 0, 'TERRAZA', 'TERRACE', 'TERRASSE', 'TERRASSE', 2, 'LOCAL', 1),
(7, 'LLEVAR', 'no', 'no', 0, 3, 'PARA LLEVAR', 'TAKEAWAY', 'MITNEHMEN', 'PLAT À EMPORTER', 8, 'LLEVAR', 1),
(8, 'REPARTO', 'no', 'no', 0, 3, 'REPARTO', 'DELIVERY', 'LIEFERUNG', 'LIVRAISON', 9, 'REPARTO', 1),
(6, 'PARQUE', 'n', 'n', 0, 0, 'PARQUE', 'PARK', 'PARK', 'PARC', 4, 'LOCAL', 1),
(9, 'PATIO TRASERO', 'n', 'n', 0, 0, 'PATIO TRASERO', 'BACKYARD', 'HINTERHOF', 'COUR', 5, 'LOCAL', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
