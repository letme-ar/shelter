-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-04-2016 a las 23:01:37
-- Versión del servidor: 5.5.37
-- Versión de PHP: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `aw000309_shelter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE IF NOT EXISTS `contactos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo` bigint(20) NOT NULL,
  `id_negocio` int(11) NOT NULL,
  `nro_integrante` tinyint(4) NOT NULL,
  `nombrecontacto` varchar(100) NOT NULL,
  `telefonocontacto` varchar(50) NOT NULL,
  `principal` tinyint(4) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `id_grupo` (`id_grupo`),
  KEY `negocios` (`id_negocio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `id_grupo`, `id_negocio`, `nro_integrante`, `nombrecontacto`, `telefonocontacto`, `principal`, `updated_at`, `created_at`) VALUES
(1, 35, 7, 1, 'max', '1122334455', 1, '2015-02-14 16:31:41', '0000-00-00 00:00:00'),
(36, 36, 10, 1, 'el cantante', '123123123123', 1, '2015-05-23 18:16:31', '0000-00-00 00:00:00'),
(37, 36, 10, 2, 'el guitarrista', '12312313123', 0, '2015-05-23 18:16:31', '0000-00-00 00:00:00'),
(40, 35, 10, 1, 'Damian Ladiani', '321321312321', 1, '2015-05-24 20:38:50', '0000-00-00 00:00:00'),
(41, 35, 10, 3, 'juan', '13123123123', 0, '2015-05-24 20:38:50', '0000-00-00 00:00:00'),
(42, 37, 10, 1, 'Un contacto ', '4455667788', 1, '2015-11-02 16:51:54', '0000-00-00 00:00:00'),
(43, 35, 9, 1, 'Damian Ladiani', '01158140669', 1, '2015-12-11 21:32:17', '0000-00-00 00:00:00'),
(44, 38, 9, 1, 'Lucas', '1122334455', 1, '2016-01-25 17:11:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilos`
--

CREATE TABLE IF NOT EXISTS `estilos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estilo` varchar(50) DEFAULT NULL,
  `eliminado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `estilos`
--

INSERT INTO `estilos` (`id`, `estilo`, `eliminado`) VALUES
(1, 'Rock', 0),
(2, 'Regae', 0),
(3, 'Alternativo', 0),
(4, 'Punk', 0),
(5, 'Country', 0),
(6, 'Metal', 0),
(7, 'Cumbia', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `id_estilo` int(11) NOT NULL,
  `web` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `integrantes` varchar(100) NOT NULL,
  `eliminado` tinyint(4) DEFAULT '0',
  `id_usuario_creador` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_GRUPOS_ESTILOS` (`id_estilo`),
  KEY `usuarios` (`id_usuario_creador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `id_estilo`, `web`, `facebook`, `twitter`, `integrantes`, `eliminado`, `id_usuario_creador`, `updated_at`, `created_at`) VALUES
(35, 'the aberdeens', 1, 'www.theaberdeens.com.ar', 'losaberdeens222', '@losaberdeens', 'Nico, Max, Seba', 0, 2, '2015-12-11 21:32:17', '2015-02-14 19:31:41'),
(36, 'rata blanca', 1, 'ratablancaweb.com.ar', 'ratablancaFB', 'TWTWTW', 'los muchachos', 0, 4, '2015-05-23 21:16:31', '2015-05-23 21:16:31'),
(37, 'Los aberdeens', 1, 'Web', 'Face', 'Tw', 'Cuatro', 0, 4, '2015-11-02 16:51:53', '2015-11-02 16:51:53'),
(38, 'Los peligros', 3, '', '', '', '', 0, 2, '2016-01-25 17:11:39', '2016-01-25 17:11:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposxnegocios`
--

CREATE TABLE IF NOT EXISTS `gruposxnegocios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo` bigint(20) NOT NULL,
  `id_negocio` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `gruposxnegocios` (`id_grupo`),
  KEY `negociosxgrupos` (`id_negocio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `gruposxnegocios`
--

INSERT INTO `gruposxnegocios` (`id`, `id_grupo`, `id_negocio`, `created_at`, `updated_at`) VALUES
(1, 35, 7, '2015-02-14 19:31:41', '2015-02-14 19:31:41'),
(2, 35, 10, '2015-05-08 20:39:02', '2015-05-08 20:39:02'),
(3, 36, 10, '2015-05-23 21:16:31', '2015-05-23 21:16:31'),
(4, 37, 10, '2015-11-02 16:51:53', '2015-11-02 16:51:53'),
(5, 35, 9, '2015-12-11 21:32:17', '2015-12-11 21:32:17'),
(6, 38, 9, '2016-01-25 17:11:39', '2016-01-25 17:11:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE IF NOT EXISTS `localidades` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cp` smallint(6) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `id_provincia` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_provincias` (`id_provincia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1002 ;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`id`, `cp`, `localidad`, `id_provincia`, `created_at`, `updated_at`) VALUES
(1, 5742, '9 de abril', 1, NULL, NULL),
(2, 6416, 'Abasto', 1, NULL, NULL),
(3, 6072, 'Abbott', 1, NULL, NULL),
(4, 6277, 'Acassuso', 1, NULL, NULL),
(5, 6151, 'Acevedo', 1, NULL, NULL),
(6, 5499, 'Adolfo Gonzales Chaves', 1, NULL, NULL),
(7, 5510, 'Adrogué', 1, NULL, NULL),
(8, 5763, 'Aeropuerto Internacional Ezeiza', 1, NULL, NULL),
(9, 6062, 'Agote', 1, NULL, NULL),
(10, 6446, 'Agronomía', 1, NULL, NULL),
(11, 5939, 'Aguas Verdes', 1, NULL, NULL),
(12, 5930, 'Agustina', 1, NULL, NULL),
(13, 6382, 'Agustín Mosconi', 1, NULL, NULL),
(14, 5927, 'Agustín Roca', 1, NULL, NULL),
(15, 5979, 'Alberdi Viejo', 1, NULL, NULL),
(16, 5503, 'Alberti', 1, NULL, NULL),
(17, 5950, 'Aldo Bonzi', 1, NULL, NULL),
(18, 5826, 'Alegre', 1, NULL, NULL),
(19, 6303, 'Alejandro Korn', 1, NULL, NULL),
(20, 5633, 'Alejandro Petión', 1, NULL, NULL),
(21, 6106, 'Alfredo Demarchi (Est. Facundo Quiroga)', 1, NULL, NULL),
(22, 6447, 'Almagro', 1, NULL, NULL),
(23, 5623, 'Altamirano', 1, NULL, NULL),
(24, 5628, 'Alto Los Cardales', 1, NULL, NULL),
(25, 6314, 'Altona', 1, NULL, NULL),
(26, 6435, 'Altos de San Lorenzo', 1, NULL, NULL),
(27, 6215, 'América', 1, NULL, NULL),
(28, 5723, 'Andant', 1, NULL, NULL),
(29, 5999, 'Antonio Carboni', 1, NULL, NULL),
(30, 5698, 'Aparicio', 1, NULL, NULL),
(31, 6418, 'Arana', 1, NULL, NULL),
(32, 5720, 'Arboledas', 1, NULL, NULL),
(33, 5998, 'Arenas Verdes', 1, NULL, NULL),
(34, 5987, 'Arenaza', 1, NULL, NULL),
(35, 6405, 'Argerich', 1, NULL, NULL),
(36, 5544, 'Ariel', 1, NULL, NULL),
(37, 5522, 'Arrecifes', 1, NULL, NULL),
(38, 5793, 'Arribeños', 1, NULL, NULL),
(39, 6238, 'Arroyo Corto', 1, NULL, NULL),
(40, 5750, 'Arroyo de La Cruz', 1, NULL, NULL),
(41, 6251, 'Arroyo Dulce', 1, NULL, NULL),
(42, 5692, 'Arroyo Pareja', 1, NULL, NULL),
(43, 5911, 'Arroyo Venado', 1, NULL, NULL),
(44, 6419, 'Arturo Seguí', 1, NULL, NULL),
(45, 5620, 'Asamblea', 1, NULL, NULL),
(46, 5794, 'Ascensión', 1, NULL, NULL),
(47, 6027, 'Atalaya', 1, NULL, NULL),
(48, 6050, 'Atlántida', 1, NULL, NULL),
(49, 5525, 'Avellaneda', 1, NULL, NULL),
(50, 5532, 'Ayacucho', 1, NULL, NULL),
(51, 6260, 'Azcuénaga', 1, NULL, NULL),
(52, 6182, 'Azopardo', 1, NULL, NULL),
(53, 5540, 'Azul', 1, NULL, NULL),
(54, 5545, 'Bahía Blanca', 1, NULL, NULL),
(55, 6129, 'Bahía San Blas', 1, NULL, NULL),
(56, 5890, 'Baigorrita', 1, NULL, NULL),
(57, 5689, 'Bajo Hondo', 1, NULL, NULL),
(58, 5559, 'Balcarce', 1, NULL, NULL),
(59, 6102, 'Balneario Costa Bonita', 1, NULL, NULL),
(60, 6407, 'Balneario La chiquita', 1, NULL, NULL),
(61, 5932, 'Balneario Laguna de Gómez', 1, NULL, NULL),
(62, 6101, 'Balneario Los Ángeles', 1, NULL, NULL),
(63, 5700, 'Balneario Marisol', 1, NULL, NULL),
(64, 6356, 'Balneario Orense', 1, NULL, NULL),
(65, 5687, 'Balneario Pehuen-Có', 1, NULL, NULL),
(66, 6269, 'Balneario San Cayetano', 1, NULL, NULL),
(67, 6075, 'Balneario Sauce Grande', 1, NULL, NULL),
(68, 6448, 'Balvanera', 1, NULL, NULL),
(69, 5898, 'Banderaló', 1, NULL, NULL),
(70, 6008, 'Banfield', 1, NULL, NULL),
(71, 5561, 'Baradero', 1, NULL, NULL),
(72, 5567, 'Barker', 1, NULL, NULL),
(73, 6449, 'Barracas', 1, NULL, NULL),
(74, 5847, 'Barrio 2 de Abril', 1, NULL, NULL),
(75, 5589, 'Barrio Banco Provincia', 1, NULL, NULL),
(76, 6420, 'Barrio El Carmen (Oeste)', 1, NULL, NULL),
(77, 5583, 'Barrio El Carmen Este', 1, NULL, NULL),
(78, 5839, 'Barrio Felix U. Camet', 1, NULL, NULL),
(79, 6421, 'Barrio Gambier', 1, NULL, NULL),
(80, 5804, 'Barrio Kennedy', 1, NULL, NULL),
(81, 6422, 'Barrio Las Malvinas', 1, NULL, NULL),
(82, 6423, 'Barrio Las Quintas', 1, NULL, NULL),
(83, 5599, 'Barrio Obrero', 1, NULL, NULL),
(84, 5629, 'Barrio Otamendi', 1, NULL, NULL),
(85, 5858, 'Barrio Parque General San Martín', 1, NULL, NULL),
(86, 5855, 'Barrio Ruta 24 Kilómetro 10', 1, NULL, NULL),
(87, 6415, 'Barrio Ruta Sol', 1, NULL, NULL),
(88, 5824, 'Barrio Río Salado', 1, NULL, NULL),
(89, 6410, 'Barrio Saavedra', 1, NULL, NULL),
(90, 5600, 'Barrio Santa Teresita', 1, NULL, NULL),
(91, 5591, 'Barrio Universitario', 1, NULL, NULL),
(92, 5836, 'Batán', 1, NULL, NULL),
(93, 5989, 'Bayauca', 1, NULL, NULL),
(94, 6450, 'Belgrano', 1, NULL, NULL),
(95, 6280, 'Bella Vista', 1, NULL, NULL),
(96, 5643, 'Bellocq', 1, NULL, NULL),
(97, 5733, 'Belén de Escobar', 1, NULL, NULL),
(98, 6325, 'Benavídez', 1, NULL, NULL),
(99, 5565, 'Benito Juárez', 1, NULL, NULL),
(100, 5676, 'Benítez', 1, NULL, NULL),
(101, 5570, 'Berazategui', 1, NULL, NULL),
(102, 6254, 'Berdier', 1, NULL, NULL),
(103, 5579, 'Berisso', 1, NULL, NULL),
(104, 5992, 'Bermúdez', 1, NULL, NULL),
(105, 6201, 'Bernal', 1, NULL, NULL),
(106, 6343, 'Beruti', 1, NULL, NULL),
(107, 5859, 'Billinghurst', 1, NULL, NULL),
(108, 6127, 'Blancagrande', 1, NULL, NULL),
(109, 5776, 'Blaquier', 1, NULL, NULL),
(110, 5837, 'Bo. Chapadmalal', 1, NULL, NULL),
(111, 5838, 'Bo. Estación Camet', 1, NULL, NULL),
(112, 5840, 'Bo. Estación Chapadmalal', 1, NULL, NULL),
(113, 5853, 'Bo. Los Acantilados', 1, NULL, NULL),
(114, 5854, 'Bo. San Eduardo', 1, NULL, NULL),
(115, 6149, 'Bocayuva', 1, NULL, NULL),
(116, 6451, 'Boedo', 1, NULL, NULL),
(117, 6183, 'Bordenave', 1, NULL, NULL),
(118, 5765, 'Bosques', 1, NULL, NULL),
(119, 6275, 'Boulogne', 1, NULL, NULL),
(120, 5611, 'Bragado', 1, NULL, NULL),
(121, 5621, 'Brandsen', 1, NULL, NULL),
(122, 5511, 'Burzaco', 1, NULL, NULL),
(123, 6279, 'Béccar', 1, NULL, NULL),
(124, 6452, 'Caballito', 1, NULL, NULL),
(125, 5547, 'Cabildo', 1, NULL, NULL),
(126, 5645, 'Cadret', 1, NULL, NULL),
(127, 6051, 'Camet Norte', 1, NULL, NULL),
(128, 5627, 'Campana', 1, NULL, NULL),
(129, 6282, 'Campo de Mayo', 1, NULL, NULL),
(130, 6285, 'Campos Salles', 1, NULL, NULL),
(131, 5743, 'Canning', 1, NULL, NULL),
(132, 5764, 'Canning', 1, NULL, NULL),
(133, 5747, 'Capilla del Señor', 1, NULL, NULL),
(134, 6146, 'Capitán Castro', 1, NULL, NULL),
(135, 5639, 'Capitán Sarmiento', 1, NULL, NULL),
(136, 6385, 'Carapachay', 1, NULL, NULL),
(137, 6130, 'Cardenal Cagliero', 1, NULL, NULL),
(138, 5489, 'Carhué', 1, NULL, NULL),
(139, 6180, 'Cariló', 1, NULL, NULL),
(140, 6232, 'Carlos Beguerie', 1, NULL, NULL),
(141, 5641, 'Carlos Casares', 1, NULL, NULL),
(142, 6018, 'Carlos Keen', 1, NULL, NULL),
(143, 6110, 'Carlos María Naón', 1, NULL, NULL),
(144, 5991, 'Carlos Salas', 1, NULL, NULL),
(145, 5762, 'Carlos Spegazzini', 1, NULL, NULL),
(146, 5651, 'Carlos Tejedor', 1, NULL, NULL),
(147, 5656, 'Carmen de Areco', 1, NULL, NULL),
(148, 6131, 'Carmen de Patagones', 1, NULL, NULL),
(149, 6165, 'Casalins', 1, NULL, NULL),
(150, 5906, 'Casbas', 1, NULL, NULL),
(151, 5718, 'Cascada', 1, NULL, NULL),
(152, 6358, 'Caseros', 1, NULL, NULL),
(153, 6083, 'Castelar', 1, NULL, NULL),
(154, 5661, 'Castelli', 1, NULL, NULL),
(155, 5667, 'Castilla', 1, NULL, NULL),
(156, 6244, 'Cazón', 1, NULL, NULL),
(157, 5899, 'Cañada Seca', 1, NULL, NULL),
(158, 5631, 'Cañuelas', 1, NULL, NULL),
(159, 5784, 'Centinela del Mar', 1, NULL, NULL),
(160, 5578, 'Centro Agrícola El Pato', 1, NULL, NULL),
(161, 5662, 'Centro Guerrero', 1, NULL, NULL),
(162, 5734, 'Centro Urbano Barrancas de Escobar', 1, NULL, NULL),
(163, 5663, 'Cerro de la Gloria', 1, NULL, NULL),
(164, 5664, 'Chacabuco', 1, NULL, NULL),
(165, 6453, 'Chacarita', 1, NULL, NULL),
(166, 5821, 'Chacras de San Clemente', 1, NULL, NULL),
(167, 5669, 'Chascomús', 1, NULL, NULL),
(168, 6338, 'Chasicó', 1, NULL, NULL),
(169, 5758, 'Chenaut', 1, NULL, NULL),
(170, 6145, 'Chiclana', 1, NULL, NULL),
(171, 5865, 'Chilavert', 1, NULL, NULL),
(172, 5541, 'Chillar', 1, NULL, NULL),
(173, 5542, 'Chillar', 1, NULL, NULL),
(174, 5670, 'Chivilcoy', 1, NULL, NULL),
(175, 6359, 'Churruca', 1, NULL, NULL),
(176, 6424, 'City Bell - Country Grand Bell', 1, NULL, NULL),
(177, 5862, 'Ciudad del Libertador G. J. de S.Martin', 1, NULL, NULL),
(178, 5952, 'Ciudad Evita', 1, NULL, NULL),
(179, 5863, 'Ciudad Jardín El Libertador', 1, NULL, NULL),
(180, 6360, 'Ciudad Jardín Lomas del Palomar', 1, NULL, NULL),
(181, 6361, 'Ciudadela', 1, NULL, NULL),
(182, 6095, 'Claraz', 1, NULL, NULL),
(183, 6348, 'Claromecó', 1, NULL, NULL),
(184, 5513, 'Claypole', 1, NULL, NULL),
(185, 6454, 'Coghlan', 1, NULL, NULL),
(186, 6455, 'Colegiales', 1, NULL, NULL),
(187, 5843, 'Colinas Verdes', 1, NULL, NULL),
(188, 6121, 'Colonia Hinojo', 1, NULL, NULL),
(189, 5649, 'Colonia Mauricio', 1, NULL, NULL),
(190, 6128, 'Colonia Nievas', 1, NULL, NULL),
(191, 6404, 'Colonia San Adolfo', 1, NULL, NULL),
(192, 6240, 'Colonia San Martín', 1, NULL, NULL),
(193, 6122, 'Colonia San Miguel', 1, NULL, NULL),
(194, 5830, 'Colonia San Ricardo', 1, NULL, NULL),
(195, 5653, 'Colonia Seré', 1, NULL, NULL),
(196, 5681, 'Colón', 1, NULL, NULL),
(197, 5782, 'Comandante Nicanor Otamendi', 1, NULL, NULL),
(198, 5614, 'Comodoro Py', 1, NULL, NULL),
(199, 6286, 'Conesa', 1, NULL, NULL),
(200, 6456, 'Constitución', 1, NULL, NULL),
(201, 6349, 'Copetonas', 1, NULL, NULL),
(202, 5916, 'Coraceros', 1, NULL, NULL),
(203, 5975, 'Coronel Boerr', 1, NULL, NULL),
(204, 5897, 'Coronel Charlone', 1, NULL, NULL),
(205, 5695, 'Coronel Dorrego', 1, NULL, NULL),
(206, 5988, 'Coronel Martínez de Hoz', 1, NULL, NULL),
(207, 5703, 'Coronel Pringles', 1, NULL, NULL),
(208, 5507, 'Coronel Seguí', 1, NULL, NULL),
(209, 5709, 'Coronel Suárez', 1, NULL, NULL),
(210, 6043, 'Coronel Vidal', 1, NULL, NULL),
(211, 6019, 'Cortines', 1, NULL, NULL),
(212, 5941, 'Costa Azul', 1, NULL, NULL),
(213, 5935, 'Costa Chica', 1, NULL, NULL),
(214, 5938, 'Costa del Este', 1, NULL, NULL),
(215, 5947, 'Costa Esmeralda', 1, NULL, NULL),
(216, 5856, 'Country Club Bosque Real - Barrio Morabo', 1, NULL, NULL),
(217, 6411, 'Country Club El Casco', 1, NULL, NULL),
(218, 6414, 'Country Club El Rodeo', 1, NULL, NULL),
(219, 6319, 'Covello', 1, NULL, NULL),
(220, 6315, 'Crotto', 1, NULL, NULL),
(221, 5785, 'Cuartel I', 1, NULL, NULL),
(222, 5786, 'Cuartel II', 1, NULL, NULL),
(223, 5787, 'Cuartel III', 1, NULL, NULL),
(224, 5788, 'Cuartel IV', 1, NULL, NULL),
(225, 5789, 'Cuartel V', 1, NULL, NULL),
(226, 6079, 'Cuartel V', 1, NULL, NULL),
(227, 5790, 'Cuartel VI', 1, NULL, NULL),
(228, 5791, 'Cuartel VII', 1, NULL, NULL),
(229, 6259, 'Cucullú', 1, NULL, NULL),
(230, 5716, 'Cura Malal', 1, NULL, NULL),
(231, 5655, 'Curarú', 1, NULL, NULL),
(232, 5717, 'Orbigny', 1, NULL, NULL),
(233, 5719, 'Daireaux', 1, NULL, NULL),
(234, 6184, 'Darregueira', 1, NULL, NULL),
(235, 6148, 'De Bary', 1, NULL, NULL),
(236, 6311, 'De la Canal', 1, NULL, NULL),
(237, 5500, 'De la Garma', 1, NULL, NULL),
(238, 6242, 'Del Carril', 1, NULL, NULL),
(239, 6378, 'Del Valle', 1, NULL, NULL),
(240, 5922, 'Del Viso', 1, NULL, NULL),
(241, 6166, 'Del Viso', 1, NULL, NULL),
(242, 5495, 'Delfín Huergo', 1, NULL, NULL),
(243, 6330, 'Delta de Tigre', 1, NULL, NULL),
(244, 6312, 'Desvío Aguirre', 1, NULL, NULL),
(245, 5543, 'Dieciséis de Julio', 1, NULL, NULL),
(246, 5756, 'Diego Gaynor', 1, NULL, NULL),
(247, 6326, 'Dique Luján', 1, NULL, NULL),
(248, 5731, 'Dique Nº 1', 1, NULL, NULL),
(249, 6113, 'Doce de Octubre', 1, NULL, NULL),
(250, 5526, 'Dock Sud', 1, NULL, NULL),
(251, 5726, 'Dolores', 1, NULL, NULL),
(252, 6304, 'Domselaar', 1, NULL, NULL),
(253, 6202, 'Don Bosco', 1, NULL, NULL),
(254, 5514, 'Don Orione', 1, NULL, NULL),
(255, 6322, 'Don Torcuato', 1, NULL, NULL),
(256, 6105, 'Dudignac', 1, NULL, NULL),
(257, 6239, 'Dufaur', 1, NULL, NULL),
(258, 6265, 'Duggan', 1, NULL, NULL),
(259, 6353, 'Dunamar', 1, NULL, NULL),
(260, 5684, 'El Arbolito', 1, NULL, NULL),
(261, 5735, 'El Cazador', 1, NULL, NULL),
(262, 5841, 'El Coyunco', 1, NULL, NULL),
(263, 5707, 'El Divisorio', 1, NULL, NULL),
(264, 5844, 'El Dorado', 1, NULL, NULL),
(265, 5980, 'El Dorado', 1, NULL, NULL),
(266, 5744, 'El Jagüel', 1, NULL, NULL),
(267, 6362, 'El Libertador', 1, NULL, NULL),
(268, 6085, 'El Palomar', 1, NULL, NULL),
(269, 6208, 'El Paraíso', 1, NULL, NULL),
(270, 5706, 'El Pensamiento', 1, NULL, NULL),
(271, 5697, 'El Perdido', 1, NULL, NULL),
(272, 5753, 'El Remanso', 1, NULL, NULL),
(273, 6425, 'El Retiro', 1, NULL, NULL),
(274, 5850, 'El Sosiego', 1, NULL, NULL),
(275, 5638, 'El Taladro', 1, NULL, NULL),
(276, 6324, 'El Talar', 1, NULL, NULL),
(277, 5974, 'El Trigo', 1, NULL, NULL),
(278, 5986, 'El Triunfo', 1, NULL, NULL),
(279, 6000, 'Elvira', 1, NULL, NULL),
(280, 6058, 'Elías Romero', 1, NULL, NULL),
(281, 5673, 'Emilio Ayarza', 1, NULL, NULL),
(282, 5896, 'Emilio V. Bunge', 1, NULL, NULL),
(283, 6003, 'Empalme Lobos', 1, NULL, NULL),
(284, 6103, 'Energía', 1, NULL, NULL),
(285, 5818, 'Enrique Fynn', 1, NULL, NULL),
(286, 5728, 'Ensenada', 1, NULL, NULL),
(287, 6383, 'Ernestina', 1, NULL, NULL),
(288, 6287, 'Erézcano', 1, NULL, NULL),
(289, 6412, 'Escalada', 1, NULL, NULL),
(290, 5492, 'Espartillar', 1, NULL, NULL),
(291, 6236, 'Espartillar', 1, NULL, NULL),
(292, 6123, 'Espigas', 1, NULL, NULL),
(293, 5795, 'Estación Arenales', 1, NULL, NULL),
(294, 5563, 'Estación Ireneo Portela', 1, NULL, NULL),
(295, 5568, 'Estación López', 1, NULL, NULL),
(296, 5766, 'Estanislao Severo Zeballos', 1, NULL, NULL),
(297, 5494, 'Esteban Agustín Gascón', 1, NULL, NULL),
(298, 6185, 'Estela', 1, NULL, NULL),
(299, 5754, 'Etchegoyen', 1, NULL, NULL),
(300, 6316, 'Eufemio Uballes', 1, NULL, NULL),
(301, 5759, 'Ezeiza', 1, NULL, NULL),
(302, 6203, 'Ezpeleta', 1, NULL, NULL),
(303, 5702, 'Faro', 1, NULL, NULL),
(304, 6186, 'Felipe Solá', 1, NULL, NULL),
(305, 5796, 'Ferré', 1, NULL, NULL),
(306, 5775, 'Florentino Ameghino', 1, NULL, NULL),
(307, 6457, 'Flores', 1, NULL, NULL),
(308, 6458, 'Floresta', 1, NULL, NULL),
(309, 6386, 'Florida', 1, NULL, NULL),
(310, 6387, 'Florida Oeste', 1, NULL, NULL),
(311, 6160, 'Fontezuela', 1, NULL, NULL),
(312, 5981, 'Fortín Acha', 1, NULL, NULL),
(313, 6217, 'Fortín Olavarría', 1, NULL, NULL),
(314, 5928, 'Fortín Tiburcio', 1, NULL, NULL),
(315, 6141, 'Francisco Madero', 1, NULL, NULL),
(316, 6078, 'Francisco Álvarez', 1, NULL, NULL),
(317, 6262, 'Franklin', 1, NULL, NULL),
(318, 5708, 'Frapal', 1, NULL, NULL),
(319, 6052, 'Frente Mar', 1, NULL, NULL),
(320, 5725, 'Freyre, Enrique Lavalle', 1, NULL, NULL),
(321, 6167, 'Fátima', 1, NULL, NULL),
(322, 6253, 'Gahan', 1, NULL, NULL),
(323, 6310, 'Gardey', 1, NULL, NULL),
(324, 5910, 'Garré', 1, NULL, NULL),
(325, 5736, 'Garín', 1, NULL, NULL),
(326, 5792, 'General Arenales', 1, NULL, NULL),
(327, 5799, 'General Belgrano', 1, NULL, NULL),
(328, 6331, 'General Conesa', 1, NULL, NULL),
(329, 5546, 'General Daniel Cerri', 1, NULL, NULL),
(330, 5612, 'General Eduardo Brien', 1, NULL, NULL),
(331, 5801, 'General Guido', 1, NULL, NULL),
(332, 5814, 'General Hornos', 1, NULL, NULL),
(333, 5803, 'General Juan Madariaga', 1, NULL, NULL),
(334, 5805, 'General La Madrid', 1, NULL, NULL),
(335, 5812, 'General Las Heras', 1, NULL, NULL),
(336, 5819, 'General Lavalle', 1, NULL, NULL),
(337, 6026, 'General Mansilla (Est.Bartolomé Bavio)', 1, NULL, NULL),
(338, 6323, 'General Pacheco', 1, NULL, NULL),
(339, 5827, 'General Pinto', 1, NULL, NULL),
(340, 6044, 'General Pirán', 1, NULL, NULL),
(341, 6306, 'General Rivas', 1, NULL, NULL),
(342, 5857, 'General Rodríguez', 1, NULL, NULL),
(343, 6288, 'General Rojo', 1, NULL, NULL),
(344, 5894, 'General Villegas', 1, NULL, NULL),
(345, 5527, 'Gerli', 1, NULL, NULL),
(346, 5963, 'Gerli', 1, NULL, NULL),
(347, 5828, 'Germania', 1, NULL, NULL),
(348, 6344, 'Girodias', 1, NULL, NULL),
(349, 5512, 'Glew', 1, NULL, NULL),
(350, 5842, 'Gloria de la Peregrina', 1, NULL, NULL),
(351, 5757, 'Gobernador Andonaegui', 1, NULL, NULL),
(352, 6297, 'Gobernador Castro', 1, NULL, NULL),
(353, 5768, 'Gobernador Julio A. Costa', 1, NULL, NULL),
(354, 5637, 'Gobernador Udaondo', 1, NULL, NULL),
(355, 6379, 'Gobernador Ugarte', 1, NULL, NULL),
(356, 5953, 'González Catán', 1, NULL, NULL),
(357, 6216, 'González Moreno', 1, NULL, NULL),
(358, 5800, 'Gorchs', 1, NULL, NULL),
(359, 5672, 'Gorostiaga', 1, NULL, NULL),
(360, 6061, 'Gowland', 1, NULL, NULL),
(361, 6237, 'Goyena', 1, NULL, NULL),
(362, 6035, 'Grand Bourg', 1, NULL, NULL),
(363, 5954, 'Gregorio de Laferrere', 1, NULL, NULL),
(364, 5548, 'Grünbein', 1, NULL, NULL),
(365, 5907, 'Guaminí', 1, NULL, NULL),
(366, 6181, 'Guernica', 1, NULL, NULL),
(367, 6157, 'Guerrico', 1, NULL, NULL),
(368, 5624, 'Gómez', 1, NULL, NULL),
(369, 6084, 'Haedo', 1, NULL, NULL),
(370, 5604, 'Hale', 1, NULL, NULL),
(371, 5913, 'Henderson', 1, NULL, NULL),
(372, 5677, 'Henry Bell', 1, NULL, NULL),
(373, 5914, 'Herrera Vegas', 1, NULL, NULL),
(374, 6401, 'Hilario Ascasubi', 1, NULL, NULL),
(375, 6120, 'Hinojo', 1, NULL, NULL),
(376, 5646, 'Hortensia', 1, NULL, NULL),
(377, 5710, 'Huanguelén', 1, NULL, NULL),
(378, 5912, 'Huanguelén', 1, NULL, NULL),
(379, 5571, 'Hudson', 1, NULL, NULL),
(380, 5917, 'Hurlingham', 1, NULL, NULL),
(381, 6443, 'Ignacio Correas', 1, NULL, NULL),
(382, 5678, 'Indacochea', 1, NULL, NULL),
(383, 5704, 'Indio Rico', 1, NULL, NULL),
(384, 6036, 'Ingeniero Adolfo Sourdeaux', 1, NULL, NULL),
(385, 6014, 'Ingeniero Budge', 1, NULL, NULL),
(386, 5769, 'Ingeniero Juan Allan', 1, NULL, NULL),
(387, 6037, 'Ingeniero Pablo Nogués', 1, NULL, NULL),
(388, 6374, 'Ingeniero Thompson', 1, NULL, NULL),
(389, 5549, 'Ingeniero White', 1, NULL, NULL),
(390, 6252, 'Inés Indart', 1, NULL, NULL),
(391, 5616, 'Irala', 1, NULL, NULL),
(392, 5701, 'Irene', 1, NULL, NULL),
(393, 5957, 'Isidro Casanova', 1, NULL, NULL),
(394, 5732, 'Isla Santiago Oeste', 1, NULL, NULL),
(395, 6273, 'Islas', 1, NULL, NULL),
(396, 5920, 'Ituzaingó', 1, NULL, NULL),
(397, 6161, 'J.A. de la Peña', 1, NULL, NULL),
(398, 5622, 'Jeppener', 1, NULL, NULL),
(399, 6426, 'Joaquín Gorina', 1, NULL, NULL),
(400, 6132, 'José B. Casas', 1, NULL, NULL),
(401, 5923, 'José C. Paz ', 1, NULL, NULL),
(402, 6427, 'José Hernández', 1, NULL, NULL),
(403, 6363, 'José Ingenieros', 1, NULL, NULL),
(404, 6088, 'José Juan Almeyra', 1, NULL, NULL),
(405, 5867, 'José León Suárez', 1, NULL, NULL),
(406, 6020, 'José María Jáuregui', 1, NULL, NULL),
(407, 6428, 'José Melchor Romero', 1, NULL, NULL),
(408, 5518, 'José Mármol', 1, NULL, NULL),
(409, 6001, 'José Santos Arévalo', 1, NULL, NULL),
(410, 6133, 'Juan A. Pradere', 1, NULL, NULL),
(411, 6154, 'Juan Anchorena', 1, NULL, NULL),
(412, 5598, 'Juan B.Justo', 1, NULL, NULL),
(413, 5977, 'Juan Bautista Alberdi', 1, NULL, NULL),
(414, 6402, 'Juan Cousté (Est. Algarrobo)', 1, NULL, NULL),
(415, 5501, 'Juan Eulogio Barra', 1, NULL, NULL),
(416, 5605, 'Juan F. Ibarra', 1, NULL, NULL),
(417, 6246, 'Juan José Blaquier', 1, NULL, NULL),
(418, 6139, 'Juan José Paso', 1, NULL, NULL),
(419, 5572, 'Juan María Gutiérrez', 1, NULL, NULL),
(420, 6093, 'Juan Nepomuceno Fernández', 1, NULL, NULL),
(421, 5925, 'Junín', 1, NULL, NULL),
(422, 5848, 'La Adela', 1, NULL, NULL),
(423, 5797, 'La Angelita', 1, NULL, NULL),
(424, 6045, 'La Armonía', 1, NULL, NULL),
(425, 6109, 'La Aurora (Est. La Niña)', 1, NULL, NULL),
(426, 5597, 'La Balandra', 1, NULL, NULL),
(427, 6047, 'La Baliza', 1, NULL, NULL),
(428, 6227, 'La Beba', 1, NULL, NULL),
(429, 6459, 'La Boca', 1, NULL, NULL),
(430, 6048, 'La Caleta', 1, NULL, NULL),
(431, 5774, 'La Capilla', 1, NULL, NULL),
(432, 6345, 'La Carreta', 1, NULL, NULL),
(433, 5816, 'La Choza', 1, NULL, NULL),
(434, 5806, 'La Colina', 1, NULL, NULL),
(435, 5534, 'La Constancia', 1, NULL, NULL),
(436, 5721, 'La Copeta', 1, NULL, NULL),
(437, 6429, 'La Cumbre', 1, NULL, NULL),
(438, 5893, 'La Delfina', 1, NULL, NULL),
(439, 6289, 'La Emilia', 1, NULL, NULL),
(440, 6255, 'La Invencible', 1, NULL, NULL),
(441, 5722, 'La Larga', 1, NULL, NULL),
(442, 5619, 'La Limpia', 1, NULL, NULL),
(443, 6168, 'La Lonja', 1, NULL, NULL),
(444, 6388, 'La Lucila', 1, NULL, NULL),
(445, 5940, 'La Lucila del Mar', 1, NULL, NULL),
(446, 5640, 'La Luisa', 1, NULL, NULL),
(447, 6099, 'La Negra', 1, NULL, NULL),
(448, 5496, 'La Pala', 1, NULL, NULL),
(449, 6460, 'La Paternal', 1, NULL, NULL),
(450, 6430, 'La Plata', 1, NULL, NULL),
(451, 6077, 'La Reja', 1, NULL, NULL),
(452, 5674, 'La Rica', 1, NULL, NULL),
(453, 5650, 'La Sofía', 1, NULL, NULL),
(454, 5955, 'La Tablada', 1, NULL, NULL),
(455, 5798, 'La Trinidad', 1, NULL, NULL),
(456, 5761, 'La Unión', 1, NULL, NULL),
(457, 6155, 'La Violeta', 1, NULL, NULL),
(458, 5802, 'Labardén', 1, NULL, NULL),
(459, 5908, 'Laguna Alsina', 1, NULL, NULL),
(460, 6406, 'Laguna Chasicó', 1, NULL, NULL),
(461, 5835, 'Laguna de los Padres', 1, NULL, NULL),
(462, 5964, 'Lanús Este', 1, NULL, NULL),
(463, 5965, 'Lanús Oeste', 1, NULL, NULL),
(464, 5931, 'Laplacette', 1, NULL, NULL),
(465, 5969, 'Laprida', 1, NULL, NULL),
(466, 5705, 'Lartigau', 1, NULL, NULL),
(467, 6032, 'Las Armas', 1, NULL, NULL),
(468, 6209, 'Las Bahamas', 1, NULL, NULL),
(469, 6224, 'Las Carabelas', 1, NULL, NULL),
(470, 6004, 'Las Chacras', 1, NULL, NULL),
(471, 5972, 'Las Flores', 1, NULL, NULL),
(472, 6396, 'Las Gaviotas', 1, NULL, NULL),
(473, 6100, 'Las Grutas', 1, NULL, NULL),
(474, 5846, 'Las Margaritas', 1, NULL, NULL),
(475, 6089, 'Las Marianas', 1, NULL, NULL),
(476, 5808, 'Las Martinetas', 1, NULL, NULL),
(477, 5852, 'Las Quintas', 1, NULL, NULL),
(478, 6199, 'Las Tahonas', 1, NULL, NULL),
(479, 5934, 'Las Toninas', 1, NULL, NULL),
(480, 5990, 'Las Toscas', 1, NULL, NULL),
(481, 5810, 'Lastra', 1, NULL, NULL),
(482, 5978, 'Leandro N. Alem', 1, NULL, NULL),
(483, 5982, 'Lezama', 1, NULL, NULL),
(484, 6068, 'Libertad', 1, NULL, NULL),
(485, 5996, 'Licenciado Matienzo', 1, NULL, NULL),
(486, 6409, 'Lima', 1, NULL, NULL),
(487, 6355, 'Lin Calel', 1, NULL, NULL),
(488, 5983, 'Lincoln', 1, NULL, NULL),
(489, 6461, 'Liniers', 1, NULL, NULL),
(490, 6060, 'Lisandro de la Torre y Santa Marta', 1, NULL, NULL),
(491, 6431, 'Lisandro Olmos - Cárcel de Olmos', 1, NULL, NULL),
(492, 6010, 'Llavallol', 1, NULL, NULL),
(493, 5993, 'Lobería', 1, NULL, NULL),
(494, 6002, 'Lobos', 1, NULL, NULL),
(495, 5871, 'Loma Hermosa', 1, NULL, NULL),
(496, 6364, 'Loma Hermosa', 1, NULL, NULL),
(497, 5740, 'Loma Verde', 1, NULL, NULL),
(498, 5823, 'Loma Verde', 1, NULL, NULL),
(499, 6444, 'Lomas de Copello', 1, NULL, NULL),
(500, 6007, 'Lomas de Zamora', 1, NULL, NULL),
(501, 5956, 'Lomas del Mirador', 1, NULL, NULL),
(502, 5630, 'Lomas del Río Luján', 1, NULL, NULL),
(503, 5516, 'Longchamps', 1, NULL, NULL),
(504, 5748, 'Los Cardales', 1, NULL, NULL),
(505, 5595, 'Los Catorce', 1, NULL, NULL),
(506, 6432, 'Los Hornos', 1, NULL, NULL),
(507, 6226, 'Los Indios', 1, NULL, NULL),
(508, 6030, 'Los Naranjos', 1, NULL, NULL),
(509, 5557, 'Los Pinos', 1, NULL, NULL),
(510, 6136, 'Los Pocitos', 1, NULL, NULL),
(511, 6038, 'Los Polvorines', 1, NULL, NULL),
(512, 5592, 'Los Talas', 1, NULL, NULL),
(513, 5889, 'Los Toldos', 1, NULL, NULL),
(514, 5851, 'Los Zorzales', 1, NULL, NULL),
(515, 5668, 'Los Ángeles', 1, NULL, NULL),
(516, 5817, 'Lozano', 1, NULL, NULL),
(517, 6384, 'Lucas Monteverde', 1, NULL, NULL),
(518, 5745, 'Luis Guillón', 1, NULL, NULL),
(519, 6021, 'Luján', 1, NULL, NULL),
(520, 6097, 'Lumb', 1, NULL, NULL),
(521, 5807, 'Líbano', 1, NULL, NULL),
(522, 6187, 'López Lecube', 1, NULL, NULL),
(523, 6143, 'Magdala', 1, NULL, NULL),
(524, 6025, 'Magdalena', 1, NULL, NULL),
(525, 6031, 'Maipú', 1, NULL, NULL),
(526, 5864, 'Malaver', 1, NULL, NULL),
(527, 5517, 'Malvinas Argentinas', 1, NULL, NULL),
(528, 6039, 'Malvinas Argentinas', 1, NULL, NULL),
(529, 6169, 'Manuel Alberti', 1, NULL, NULL),
(530, 6433, 'Manuel B. Gonnet', 1, NULL, NULL),
(531, 6107, 'Manuel B. Gonnet (Est. French)', 1, NULL, NULL),
(532, 6152, 'Manuel Ocampo', 1, NULL, NULL),
(533, 6170, 'Manzanares', 1, NULL, NULL),
(534, 5739, 'Maquinista F. Savio Este', 1, NULL, NULL),
(535, 6394, 'Mar Azul', 1, NULL, NULL),
(536, 6046, 'Mar Chiquita', 1, NULL, NULL),
(537, 5943, 'Mar de Ajó', 1, NULL, NULL),
(538, 6049, 'Mar de Cobo', 1, NULL, NULL),
(539, 6395, 'Mar de las Pampas', 1, NULL, NULL),
(540, 5832, 'Mar del Plata', 1, NULL, NULL),
(541, 5781, 'Mar del Sud', 1, NULL, NULL),
(542, 5937, 'Mar del Tuyú', 1, NULL, NULL),
(543, 6114, 'Marcelino Ugarte (Est. Dennehy)', 1, NULL, NULL),
(544, 6057, 'Marcos Paz', 1, NULL, NULL),
(545, 6069, 'Mariano Acosta', 1, NULL, NULL),
(546, 6162, 'Mariano Benítez', 1, NULL, NULL),
(547, 6156, 'Mariano H. Alfonzo', 1, NULL, NULL),
(548, 5607, 'Mariano Unzué', 1, NULL, NULL),
(549, 6365, 'Martín Coronado', 1, NULL, NULL),
(550, 6276, 'Martínez', 1, NULL, NULL),
(551, 6309, 'María Ignacia (Estación Vela)', 1, NULL, NULL),
(552, 5915, 'María Lucila', 1, NULL, NULL),
(553, 5737, 'Maschwitz', 1, NULL, NULL),
(554, 5904, 'Massey', 1, NULL, NULL),
(555, 6462, 'Mataderos', 1, NULL, NULL),
(556, 5738, 'Matheu', 1, NULL, NULL),
(557, 5648, 'Mauricio Hirsch', 1, NULL, NULL),
(558, 6400, 'Mayor Buratovich', 1, NULL, NULL),
(559, 5504, 'Mechita', 1, NULL, NULL),
(560, 5613, 'Mechita', 1, NULL, NULL),
(561, 5783, 'Mechongué', 1, NULL, NULL),
(562, 6064, 'Mercedes', 1, NULL, NULL),
(563, 6065, 'Merlo', 1, NULL, NULL),
(564, 6350, 'Micaela Cascallares', 1, NULL, NULL),
(565, 5519, 'Ministro Rivadavia', 1, NULL, NULL),
(566, 6221, 'Mira Pampa', 1, NULL, NULL),
(567, 5780, 'Miramar', 1, NULL, NULL),
(568, 5644, 'Moctezuma', 1, NULL, NULL),
(569, 6140, 'Mones Cazón', 1, NULL, NULL),
(570, 6464, 'Monserrat', 1, NULL, NULL),
(571, 6463, 'Monte Castro', 1, NULL, NULL),
(572, 5966, 'Monte Chingolo', 1, NULL, NULL),
(573, 5746, 'Monte Grande', 1, NULL, NULL),
(574, 6074, 'Monte Hermoso', 1, NULL, NULL),
(575, 6200, 'Monte Veloz', 1, NULL, NULL),
(576, 6176, 'Montecarlo', 1, NULL, NULL),
(577, 5671, 'Moquehuá', 1, NULL, NULL),
(578, 6112, 'Morea', 1, NULL, NULL),
(579, 6076, 'Moreno', 1, NULL, NULL),
(580, 5926, 'Morse', 1, NULL, NULL),
(581, 6082, 'Morón', 1, NULL, NULL),
(582, 5724, 'Mouras, Salazar', 1, NULL, NULL),
(583, 6389, 'Munro', 1, NULL, NULL),
(584, 6281, 'Muñiz', 1, NULL, NULL),
(585, 5618, 'Máximo Fernández', 1, NULL, NULL),
(586, 5634, 'Máximo Paz', 1, NULL, NULL),
(587, 6399, 'Médanos', 1, NULL, NULL),
(588, 5558, 'Napaleofú', 1, NULL, NULL),
(589, 6087, 'Navarro', 1, NULL, NULL),
(590, 6091, 'Necochea', 1, NULL, NULL),
(591, 6094, 'Nicanor Olivera (Est. La Dulce)', 1, NULL, NULL),
(592, 6376, 'Norberto de La Riestra', 1, NULL, NULL),
(593, 6327, 'Nordelta', 1, NULL, NULL),
(594, 6115, 'Norumbega', 1, NULL, NULL),
(595, 5944, 'Nueva Atlantis', 1, NULL, NULL),
(596, 6144, 'Nueva Plata', 1, NULL, NULL),
(597, 6465, 'Nueva Pompeya', 1, NULL, NULL),
(598, 6104, 'Nueve de Julio', 1, NULL, NULL),
(599, 6466, 'Núñez', 1, NULL, NULL),
(600, 5666, 'Higgins', 1, NULL, NULL),
(601, 6301, 'Obligado', 1, NULL, NULL),
(602, 6268, 'Ochandío', 1, NULL, NULL),
(603, 6231, 'Ocho Cuarteles', 1, NULL, NULL),
(604, 5617, 'Olascoaga', 1, NULL, NULL),
(605, 5625, 'Oliden', 1, NULL, NULL),
(606, 6022, 'Olivera', 1, NULL, NULL),
(607, 6390, 'Olivos', 1, NULL, NULL),
(608, 6366, 'Once de Septiembre', 1, NULL, NULL),
(609, 6023, 'Open Door', 1, NULL, NULL),
(610, 5647, 'Ordoqui', 1, NULL, NULL),
(611, 6347, 'Orense', 1, NULL, NULL),
(612, 5696, 'Oriente', 1, NULL, NULL),
(613, 6178, 'Ostende', 1, NULL, NULL),
(614, 6367, 'Pablo Podestá', 1, NULL, NULL),
(615, 5679, 'Palemon Huergo', 1, NULL, NULL),
(616, 6467, 'Palermo', 1, NULL, NULL),
(617, 5593, 'Palo Blanco', 1, NULL, NULL),
(618, 5755, 'Parada La Lata - La Loma', 1, NULL, NULL),
(619, 5751, 'Parada Orlando', 1, NULL, NULL),
(620, 5752, 'Parada Robles', 1, NULL, NULL),
(621, 5690, 'Paraje Calderón', 1, NULL, NULL),
(622, 5536, 'Paraje Cangallo', 1, NULL, NULL),
(623, 6333, 'Paraje Esquina de Crotto', 1, NULL, NULL),
(624, 6249, 'Paraje Estación Graciarena', 1, NULL, NULL),
(625, 5538, 'Paraje Fair', 1, NULL, NULL),
(626, 5659, 'Paraje Kenny', 1, NULL, NULL),
(627, 5537, 'Paraje Langueyú', 1, NULL, NULL),
(628, 5778, 'Paraje Nueva Suiza', 1, NULL, NULL),
(629, 6413, 'Paraje Ortiz', 1, NULL, NULL),
(630, 5779, 'Paraje Porvenir', 1, NULL, NULL),
(631, 5539, 'Paraje San Ignacio', 1, NULL, NULL),
(632, 5660, 'Paraje Tatay', 1, NULL, NULL),
(633, 5609, 'Paraje Vallimanca', 1, NULL, NULL),
(634, 5610, 'Paraje Villa Sanz', 1, NULL, NULL),
(635, 5973, 'Pardo', 1, NULL, NULL),
(636, 6468, 'Parque Avellaneda', 1, NULL, NULL),
(637, 6469, 'Parque Chacabuco', 1, NULL, NULL),
(638, 6470, 'Parque Chas', 1, NULL, NULL),
(639, 6471, 'Parque Patricios', 1, NULL, NULL),
(640, 6067, 'Parque San Martín', 1, NULL, NULL),
(641, 5715, 'Pasman', 1, NULL, NULL),
(642, 6081, 'Paso del Rey', 1, NULL, NULL),
(643, 5985, 'Pasteur', 1, NULL, NULL),
(644, 6108, 'Patricios', 1, NULL, NULL),
(645, 5606, 'Paula', 1, NULL, NULL),
(646, 5749, 'Pavón', 1, NULL, NULL),
(647, 5820, 'Pavón', 1, NULL, NULL),
(648, 5682, 'Pearson', 1, NULL, NULL),
(649, 6377, 'Pedernales', 1, NULL, NULL),
(650, 6398, 'Pedro Luro', 1, NULL, NULL),
(651, 6138, 'Pehuajó', 1, NULL, NULL),
(652, 6147, 'Pellegrini', 1, NULL, NULL),
(653, 5575, 'Pereyra', 1, NULL, NULL),
(654, 6150, 'Pergamino', 1, NULL, NULL),
(655, 5905, 'Pichincha', 1, NULL, NULL),
(656, 5895, 'Piedritas', 1, NULL, NULL),
(657, 5997, 'Pieres', 1, NULL, NULL),
(658, 6234, 'Pigüé', 1, NULL, NULL),
(659, 6164, 'Pila', 1, NULL, NULL),
(660, 6171, 'Pilar', 1, NULL, NULL),
(661, 6177, 'Pinamar', 1, NULL, NULL),
(662, 5946, 'Pinar del Sol', 1, NULL, NULL),
(663, 6159, 'Pinzón', 1, NULL, NULL),
(664, 6196, 'Pipinas', 1, NULL, NULL),
(665, 5603, 'Pirovano', 1, NULL, NULL),
(666, 5528, 'Piñeyro', 1, NULL, NULL),
(667, 6053, 'Playa Dorada', 1, NULL, NULL),
(668, 5815, 'Plomer', 1, NULL, NULL),
(669, 5506, 'Plá', 1, NULL, NULL),
(670, 5576, 'Plátanos', 1, NULL, NULL),
(671, 6243, 'Polvaderas', 1, NULL, NULL),
(672, 5809, 'Pontaut', 1, NULL, NULL),
(673, 6070, 'Pontevedra', 1, NULL, NULL),
(674, 5777, 'Porvenir', 1, NULL, NULL),
(675, 6172, 'Presidente Derqui', 1, NULL, NULL),
(676, 6188, 'Puan', 1, NULL, NULL),
(677, 6300, 'Pueblo Doyle', 1, NULL, NULL),
(678, 5658, 'Pueblo Gouin', 1, NULL, NULL),
(679, 5971, 'Pueblo Nuevo', 1, NULL, NULL),
(680, 5970, 'Pueblo San Jorge', 1, NULL, NULL),
(681, 6472, 'Puerto Madero', 1, NULL, NULL),
(682, 5741, 'Puerto Paraná', 1, NULL, NULL),
(683, 5691, 'Puerto Rosales', 1, NULL, NULL),
(684, 5685, 'Punta Alta', 1, NULL, NULL),
(685, 5693, 'Punta Ancla', 1, NULL, NULL),
(686, 6197, 'Punta del Indio', 1, NULL, NULL),
(687, 5729, 'Punta Lara', 1, NULL, NULL),
(688, 5833, 'Punta Mogotes', 1, NULL, NULL),
(689, 5945, 'Punta Médanos', 1, NULL, NULL),
(690, 6210, 'Pérez Millán', 1, NULL, NULL),
(691, 6248, 'Quenumá', 1, NULL, NULL),
(692, 6092, 'Quequén', 1, NULL, NULL),
(693, 5811, 'Quilcó', 1, NULL, NULL),
(694, 6204, 'Quilmes', 1, NULL, NULL),
(695, 5515, 'Rafael Calzada', 1, NULL, NULL),
(696, 5951, 'Rafael Castillo', 1, NULL, NULL),
(697, 6225, 'Rafael Obligado', 1, NULL, NULL),
(698, 6207, 'Ramallo', 1, NULL, NULL),
(699, 5949, 'Ramos Mejía', 1, NULL, NULL),
(700, 5560, 'Ramos Otero', 1, NULL, NULL),
(701, 5680, 'Ramón Biaus', 1, NULL, NULL),
(702, 6096, 'Ramón Santamarina', 1, NULL, NULL),
(703, 6158, 'Rancagua', 1, NULL, NULL),
(704, 5822, 'Ranchos', 1, NULL, NULL),
(705, 5573, 'Ranelagh', 1, NULL, NULL),
(706, 6214, 'Rauch', 1, NULL, NULL),
(707, 5665, 'Rawson', 1, NULL, NULL),
(708, 6124, 'Recalde', 1, NULL, NULL),
(709, 6473, 'Recoleta', 1, NULL, NULL),
(710, 5967, 'Remedios de Escalada', 1, NULL, NULL),
(711, 6368, 'Remedios de Escalada', 1, NULL, NULL),
(712, 6352, 'Reta', 1, NULL, NULL),
(713, 6474, 'Retiro', 1, NULL, NULL),
(714, 6328, 'Ricardo Rojas', 1, NULL, NULL),
(715, 6329, 'Rincón de Milberg', 1, NULL, NULL),
(716, 6434, 'Ringuelet', 1, NULL, NULL),
(717, 5490, 'Rivera', 1, NULL, NULL),
(718, 6230, 'Roberto Cano', 1, NULL, NULL),
(719, 6029, 'Roberto J. Payró', 1, NULL, NULL),
(720, 5984, 'Roberts', 1, NULL, NULL),
(721, 6223, 'Rojas', 1, NULL, NULL),
(722, 6307, 'Román Báez', 1, NULL, NULL),
(723, 6219, 'Roosevelt', 1, NULL, NULL),
(724, 6233, 'Roque Pérez', 1, NULL, NULL),
(725, 5555, 'Rosendo López', 1, NULL, NULL),
(726, 6299, 'Río Tala', 1, NULL, NULL),
(727, 6235, 'Saavedra', 1, NULL, NULL),
(728, 6475, 'Saavedra', 1, NULL, NULL),
(729, 5929, 'Saforcada', 1, NULL, NULL),
(730, 6241, 'Saladillo', 1, NULL, NULL),
(731, 6336, 'Saldungaray', 1, NULL, NULL),
(732, 6247, 'Salliqueló', 1, NULL, NULL),
(733, 6250, 'Salto', 1, NULL, NULL),
(734, 6005, 'Salvador María', 1, NULL, NULL),
(735, 5626, 'Samborombón', 1, NULL, NULL),
(736, 5556, 'San Agustín', 1, NULL, NULL),
(737, 5866, 'San Andrés', 1, NULL, NULL),
(738, 6256, 'San Andrés de Giles', 1, NULL, NULL),
(739, 6263, 'San Antonio de Areco', 1, NULL, NULL),
(740, 6066, 'San Antonio de Padua', 1, NULL, NULL),
(741, 6318, 'San Bernardo', 1, NULL, NULL),
(742, 6142, 'San Bernardo de Pehuajó', 1, NULL, NULL),
(743, 5942, 'San Bernardo del Tuyú', 1, NULL, NULL),
(744, 5601, 'San Carlos de Bolívar', 1, NULL, NULL),
(745, 6267, 'San Cayetano', 1, NULL, NULL),
(746, 5933, 'San Clemente del Tuyú', 1, NULL, NULL),
(747, 6476, 'San Cristóbal', 1, NULL, NULL),
(748, 5892, 'San Emilio', 1, NULL, NULL),
(749, 6381, 'San Enrique', 1, NULL, NULL),
(750, 6270, 'San Fernando', 1, NULL, NULL),
(751, 6351, 'San Francisco de Bellocq', 1, NULL, NULL),
(752, 5520, 'San Francisco Solano', 1, NULL, NULL),
(753, 6205, 'San Francisco Solano', 1, NULL, NULL),
(754, 6189, 'San Germán', 1, NULL, NULL),
(755, 6278, 'San Isidro', 1, NULL, NULL),
(756, 5521, 'San José', 1, NULL, NULL),
(757, 5711, 'San José', 1, NULL, NULL),
(758, 6098, 'San José', 1, NULL, NULL),
(759, 5767, 'San Juan Bautista', 1, NULL, NULL),
(760, 5948, 'San Justo', 1, NULL, NULL),
(761, 5994, 'San Manuel', 1, NULL, NULL),
(762, 6222, 'San Mauricio', 1, NULL, NULL),
(763, 6354, 'San Mayol', 1, NULL, NULL),
(764, 1663, 'San Miguel', 1, NULL, NULL),
(765, 5493, 'San Miguel Arcángel', 1, NULL, NULL),
(766, 6071, 'San Miguel del Monte', 1, NULL, NULL),
(767, 6477, 'San Nicolás', 1, NULL, NULL),
(768, 6290, 'San Nicolás de los Arroyos', 1, NULL, NULL),
(769, 6296, 'San Pedro', 1, NULL, NULL),
(770, 5699, 'San Román', 1, NULL, NULL),
(771, 5675, 'San Sebastián', 1, NULL, NULL),
(772, 6478, 'San Telmo', 1, NULL, NULL),
(773, 6302, 'San Vicente', 1, NULL, NULL),
(774, 6218, 'Sansinena', 1, NULL, NULL),
(775, 5849, 'Santa Angela', 1, NULL, NULL),
(776, 6016, 'Santa Catalina', 1, NULL, NULL),
(777, 6054, 'Santa Clara del Mar', 1, NULL, NULL),
(778, 5564, 'Santa Coloma', 1, NULL, NULL),
(779, 6055, 'Santa Elena', 1, NULL, NULL),
(780, 5903, 'Santa Eleodora', 1, NULL, NULL),
(781, 6298, 'Santa Lucía', 1, NULL, NULL),
(782, 6126, 'Santa Luisa', 1, NULL, NULL),
(783, 6015, 'Santa Marta', 1, NULL, NULL),
(784, 5712, 'Santa María', 1, NULL, NULL),
(785, 6284, 'Santa María', 1, NULL, NULL),
(786, 5845, 'Santa Paula', 1, NULL, NULL),
(787, 5901, 'Santa Regina', 1, NULL, NULL),
(788, 5632, 'Santa Rosa', 1, NULL, NULL),
(789, 6059, 'Santa Rosa', 1, NULL, NULL),
(790, 5936, 'Santa Teresita', 1, NULL, NULL),
(791, 5713, 'Santa Trinidad', 1, NULL, NULL),
(792, 6033, 'Santo Domingo', 1, NULL, NULL),
(793, 6370, 'Santos Lugares', 1, NULL, NULL),
(794, 6116, 'Santos Unzué', 1, NULL, NULL),
(795, 5529, 'Sarandí', 1, NULL, NULL),
(796, 5683, 'Sarasa', 1, NULL, NULL),
(797, 5727, 'Sevigne', 1, NULL, NULL),
(798, 6119, 'Sierra Chica', 1, NULL, NULL),
(799, 6335, 'Sierra de la Ventana', 1, NULL, NULL),
(800, 5834, 'Sierra de los Padres', 1, NULL, NULL),
(801, 6117, 'Sierras Bayas', 1, NULL, NULL),
(802, 6211, 'Simón Santiago Sánchez', 1, NULL, NULL),
(803, 5642, 'Smith', 1, NULL, NULL),
(804, 5535, 'Solanet', 1, NULL, NULL),
(805, 6257, 'Solís', 1, NULL, NULL),
(806, 5574, 'Sourigues', 1, NULL, NULL),
(807, 6134, 'Stroeder', 1, NULL, NULL),
(808, 6305, 'Suipacha', 1, NULL, NULL),
(809, 6220, 'Sundblad', 1, NULL, NULL),
(810, 6369, 'Sáenz Peña', 1, NULL, NULL),
(811, 5995, 'Tamangueyú', 1, NULL, NULL),
(812, 6308, 'Tandil', 1, NULL, NULL),
(813, 6313, 'Tapalqué', 1, NULL, NULL),
(814, 5958, 'Tapiales', 1, NULL, NULL),
(815, 5569, 'Tedín Uriburu', 1, NULL, NULL),
(816, 6009, 'Temperley', 1, NULL, NULL),
(817, 6403, 'Teniente Origone', 1, NULL, NULL),
(818, 5497, 'Thames', 1, NULL, NULL),
(819, 6040, 'Tierras Altas', 1, NULL, NULL),
(820, 6321, 'Tigre', 1, NULL, NULL),
(821, 5654, 'Timote', 1, NULL, NULL),
(822, 5523, 'Todd', 1, NULL, NULL),
(823, 6436, 'Tolosa', 1, NULL, NULL),
(824, 6063, 'Tomás Jofré', 1, NULL, NULL),
(825, 6334, 'Tornquist', 1, NULL, NULL),
(826, 6024, 'Torres', 1, NULL, NULL),
(827, 5924, 'Tortuguitas', 1, NULL, NULL),
(828, 6041, 'Tortuguitas', 1, NULL, NULL),
(829, 6437, 'Transradio', 1, NULL, NULL),
(830, 6342, 'Treinta de Agosto', 1, NULL, NULL),
(831, 6341, 'Trenque Lauquen', 1, NULL, NULL),
(832, 5652, 'Tres Algarrobos', 1, NULL, NULL),
(833, 6346, 'Tres Arroyos', 1, NULL, NULL),
(834, 6190, 'Tres Cuervos', 1, NULL, NULL),
(835, 6373, 'Tres Lomas', 1, NULL, NULL),
(836, 6339, 'Tres Picos', 1, NULL, NULL),
(837, 5657, 'Tres Sargentos', 1, NULL, NULL),
(838, 5760, 'Tristán Suárez', 1, NULL, NULL),
(839, 6080, 'Trujui', 1, NULL, NULL),
(840, 6011, 'Turdera', 1, NULL, NULL),
(841, 5533, 'Udaquiola', 1, NULL, NULL),
(842, 5602, 'Urdampilleta', 1, NULL, NULL),
(843, 5635, 'Uribelarrea', 1, NULL, NULL),
(844, 6266, 'Vagués', 1, NULL, NULL),
(845, 6380, 'Valdés', 1, NULL, NULL),
(846, 5968, 'Valentín Alsina', 1, NULL, NULL),
(847, 6179, 'Valeria del Mar', 1, NULL, NULL),
(848, 5976, 'Vedia', 1, NULL, NULL),
(849, 5959, 'Veinte de Junio', 1, NULL, NULL),
(850, 6375, 'Veinticinco de Mayo', 1, NULL, NULL),
(851, 6320, 'Velloso', 1, NULL, NULL),
(852, 6480, 'Versalles', 1, NULL, NULL),
(853, 6195, 'Verónica', 1, NULL, NULL),
(854, 5636, 'Vicente Casares', 1, NULL, NULL),
(855, 6391, 'Vicente López', 1, NULL, NULL),
(856, 6271, 'Victoria', 1, NULL, NULL),
(857, 5909, 'Victorino de la Plaza', 1, NULL, NULL),
(858, 6028, 'Vieytes', 1, NULL, NULL),
(859, 6274, 'Villa Adelina', 1, NULL, NULL),
(860, 6392, 'Villa Adelina', 1, NULL, NULL),
(861, 6017, 'Villa Albertina', 1, NULL, NULL),
(862, 6118, 'Villa Alfredo Fortabat', 1, NULL, NULL),
(863, 5562, 'Villa Alsina', 1, NULL, NULL),
(864, 6153, 'Villa Angélica', 1, NULL, NULL),
(865, 5714, 'Villa Arcadia', 1, NULL, NULL),
(866, 5587, 'Villa Argüello', 1, NULL, NULL),
(867, 6173, 'Villa Astolfi', 1, NULL, NULL),
(868, 5872, 'Villa Ayacucho', 1, NULL, NULL),
(869, 5860, 'Villa Ballester', 1, NULL, NULL),
(870, 6137, 'Villa Balnearia 7 de Marzo', 1, NULL, NULL),
(871, 5594, 'Villa Banco Constructor', 1, NULL, NULL),
(872, 5873, 'Villa Bernardo Monteagudo', 1, NULL, NULL),
(873, 5861, 'Villa Bonich', 1, NULL, NULL),
(874, 5550, 'Villa Bordeu', 1, NULL, NULL),
(875, 6371, 'Villa Bosch', 1, NULL, NULL),
(876, 5770, 'Villa Brown', 1, NULL, NULL),
(877, 5566, 'Villa Cacique', 1, NULL, NULL),
(878, 6291, 'Villa Campi', 1, NULL, NULL),
(879, 6292, 'Villa Canto', 1, NULL, NULL),
(880, 6192, 'Villa Castelar (Erize)', 1, NULL, NULL),
(881, 5730, 'Villa Catella', 1, NULL, NULL),
(882, 6012, 'Villa Centenario', 1, NULL, NULL),
(883, 5874, 'Villa Chacabuco', 1, NULL, NULL),
(884, 5586, 'Villa Corbalan', 1, NULL, NULL),
(885, 5875, 'Villa Coronel José M. Zapiola', 1, NULL, NULL),
(886, 6481, 'Villa Crespo', 1, NULL, NULL),
(887, 6042, 'Villa de Mayo', 1, NULL, NULL),
(888, 5688, 'Villa del Mar', 1, NULL, NULL),
(889, 6482, 'Villa del Parque', 1, NULL, NULL),
(890, 6483, 'Villa Devoto', 1, NULL, NULL),
(891, 5584, 'Villa Dolores', 1, NULL, NULL),
(892, 5530, 'Villa Domínico', 1, NULL, NULL),
(893, 6193, 'Villa Durcudoy (17 de agosto)', 1, NULL, NULL),
(894, 5960, 'Villa Eduardo Madero', 1, NULL, NULL),
(895, 6438, 'Villa Elisa', 1, NULL, NULL),
(896, 6439, 'Villa Elvira', 1, NULL, NULL),
(897, 5577, 'Villa España', 1, NULL, NULL),
(898, 5596, 'Villa España', 1, NULL, NULL),
(899, 6293, 'Villa Esperanza', 1, NULL, NULL),
(900, 6261, 'Villa Espil', 1, NULL, NULL),
(901, 5551, 'Villa Espora', 1, NULL, NULL),
(902, 6013, 'Villa Fiorito', 1, NULL, NULL),
(903, 5829, 'Villa Francia', 1, NULL, NULL),
(904, 6440, 'Villa Garibaldi', 1, NULL, NULL),
(905, 5876, 'Villa General Antonio J. de Sucre', 1, NULL, NULL),
(906, 5686, 'Villa General Arias', 1, NULL, NULL),
(907, 5877, 'Villa General Eugenio Necochea', 1, NULL, NULL),
(908, 6111, 'Villa General Fournier (Est. Nueve de Julio Sud)', 1, NULL, NULL),
(909, 5878, 'Villa General José Tomás Guido', 1, NULL, NULL),
(910, 5879, 'Villa General Juan G. Las Heras', 1, NULL, NULL),
(911, 6484, 'Villa General Mitre', 1, NULL, NULL),
(912, 6213, 'Villa General Savio', 1, NULL, NULL),
(913, 6397, 'Villa Gesell', 1, NULL, NULL),
(914, 5880, 'Villa Godoy Cruz', 1, NULL, NULL),
(915, 5881, 'Villa Granaderos de San Martín', 1, NULL, NULL),
(916, 5882, 'Villa Gregoria Matorras', 1, NULL, NULL),
(917, 5508, 'Villa Grisolía (Est. Achupallas)', 1, NULL, NULL),
(918, 5552, 'Villa Harding Green', 1, NULL, NULL),
(919, 6294, 'Villa Hermosa', 1, NULL, NULL),
(920, 5585, 'Villa Independencia', 1, NULL, NULL),
(921, 6194, 'Villa Iris', 1, NULL, NULL),
(922, 5883, 'Villa Juan Martín de Pueyrredón', 1, NULL, NULL),
(923, 6206, 'Villa La Florida', 1, NULL, NULL),
(924, 6125, 'Villa La Serranía', 1, NULL, NULL),
(925, 5870, 'Villa Libertad', 1, NULL, NULL),
(926, 6485, 'Villa Lugano', 1, NULL, NULL),
(927, 6486, 'Villa Luro', 1, NULL, NULL),
(928, 5961, 'Villa Luzuriaga', 1, NULL, NULL),
(929, 5868, 'Villa Lynch', 1, NULL, NULL),
(930, 5608, 'Villa Lynch Pueyrredón', 1, NULL, NULL),
(931, 6264, 'Villa Lí­a', 1, NULL, NULL),
(932, 5869, 'Villa Maipú', 1, NULL, NULL),
(933, 6228, 'Villa Manuel Pomar', 1, NULL, NULL),
(934, 5885, 'Villa Marques Alejandro Maria de Aguado', 1, NULL, NULL),
(935, 6393, 'Villa Martelli', 1, NULL, NULL),
(936, 5509, 'Villa Maria', 1, NULL, NULL),
(937, 5884, 'Villa Maria Irene de los Remedios de Escalada', 1, NULL, NULL),
(938, 5491, 'Villa Maza', 1, NULL, NULL),
(939, 6090, 'Villa Moll', 1, NULL, NULL),
(940, 6441, 'Villa Montoro', 1, NULL, NULL),
(941, 5554, 'Villa Nueva', 1, NULL, NULL),
(942, 5590, 'Villa Nueva', 1, NULL, NULL),
(943, 5505, 'Villa Ortiz', 1, NULL, NULL),
(944, 6487, 'Villa Ortúzar', 1, NULL, NULL),
(945, 6229, 'Villa Parque Cecir', 1, NULL, NULL),
(946, 5886, 'Villa Parque Presidente Figueroa Alcorta', 1, NULL, NULL),
(947, 5887, 'Villa Parque San Lorenzo', 1, NULL, NULL),
(948, 6442, 'Villa Parque Sicardi', 1, NULL, NULL),
(949, 5580, 'Villa Porteña', 1, NULL, NULL),
(950, 5581, 'Villa Progreso', 1, NULL, NULL),
(951, 6488, 'Villa Pueyrredón', 1, NULL, NULL),
(952, 6372, 'Villa Raffo', 1, NULL, NULL),
(953, 6212, 'Villa Ramallo', 1, NULL, NULL),
(954, 6489, 'Villa Real', 1, NULL, NULL),
(955, 6490, 'Villa Riachuelo', 1, NULL, NULL),
(956, 6295, 'Villa Riccio', 1, NULL, NULL),
(957, 6332, 'Villa Roch', 1, NULL, NULL),
(958, 6357, 'Villa Rodríguez', 1, NULL, NULL),
(959, 6174, 'Villa Rosa', 1, NULL, NULL),
(960, 5831, 'Villa Roth', 1, NULL, NULL),
(961, 6258, 'Villa Ruiz', 1, NULL, NULL),
(962, 5902, 'Villa Saboya', 1, NULL, NULL),
(963, 5582, 'Villa San Carlos', 1, NULL, NULL),
(964, 6163, 'Villa San José', 1, NULL, NULL),
(965, 5771, 'Villa San Luis', 1, NULL, NULL),
(966, 6491, 'Villa Santa Rita', 1, NULL, NULL),
(967, 5772, 'Villa Santa Rosa', 1, NULL, NULL),
(968, 6086, 'Villa Sarmiento', 1, NULL, NULL),
(969, 5900, 'Villa Sauze', 1, NULL, NULL),
(970, 6340, 'Villa Serrana La Gruta', 1, NULL, NULL),
(971, 6492, 'Villa Soldati', 1, NULL, NULL),
(972, 5553, 'Villa Stella Maris', 1, NULL, NULL),
(973, 5919, 'Villa Tesei', 1, NULL, NULL),
(974, 5921, 'Villa Udaondo', 1, NULL, NULL),
(975, 6493, 'Villa Urquiza', 1, NULL, NULL),
(976, 5773, 'Villa Vatteone', 1, NULL, NULL),
(977, 6337, 'Villa Ventana', 1, NULL, NULL),
(978, 5888, 'Villa Yapeyú', 1, NULL, NULL),
(979, 5588, 'Villa Zula', 1, NULL, NULL),
(980, 6135, 'Villalonga', 1, NULL, NULL),
(981, 5825, 'Villanueva', 1, NULL, NULL),
(982, 5813, 'Villars', 1, NULL, NULL),
(983, 5962, 'Virrey del Pino', 1, NULL, NULL),
(984, 6272, 'Virreyes', 1, NULL, NULL),
(985, 6056, 'Vivoratá', 1, NULL, NULL),
(986, 5524, 'Viña', 1, NULL, NULL),
(987, 5502, 'Vásquez', 1, NULL, NULL),
(988, 6479, 'Vélez Sársfield', 1, NULL, NULL),
(989, 6191, 'Víboras', 1, NULL, NULL),
(990, 5615, 'Warnes', 1, NULL, NULL),
(991, 5531, 'Wilde', 1, NULL, NULL),
(992, 5918, 'William C. Morris', 1, NULL, NULL),
(993, 6317, 'Yerbas', 1, NULL, NULL),
(994, 5498, 'Yutuyaco', 1, NULL, NULL),
(995, 6006, 'Zapiola', 1, NULL, NULL),
(996, 5891, 'Zavalía', 1, NULL, NULL),
(997, 6175, 'Zelaya', 1, NULL, NULL),
(998, 6073, 'Zenón Videla Dorna', 1, NULL, NULL),
(999, 6408, 'Zárate', 1, NULL, NULL),
(1000, 6245, 'Álvarez de Toledo', 1, NULL, NULL),
(1001, 6198, 'Álvarez Jonte', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE IF NOT EXISTS `negocios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `id_localidad` int(11) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `web` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `negocios`
--

INSERT INTO `negocios` (`id`, `nombre`, `direccion`, `id_localidad`, `mail`, `facebook`, `twitter`, `web`, `estado`, `created_at`, `updated_at`) VALUES
(7, 'Negocio 1', 'Direccion negocio 1', 764, 'mail@negocio1.com', 'Facebook del negocio 1', 'Twitter del negocio 1', 'Web del negocio 1', 0, '2015-02-13 13:55:14', '2015-02-13 16:55:14'),
(8, 'Negocio 2', 'Direccion del negocio 2', 527, 'mail@negocio2.com', 'Facebook del negocio 2', 'Twitter del negocio 2', 'Web del negocio 2', 0, '2015-02-13 16:37:02', '2015-02-13 16:37:02'),
(9, 'Negocio 3', 'Direccion del negocio 3', 401, 'mail@negocio3.com', 'Facebook del negocio 3', 'Twitter del negocio 3', 'Web del negocio 3', 0, '2015-02-13 16:46:38', '2015-02-13 16:46:38'),
(10, 'SHELTER', 'Belgrano 500', 764, '', 'Salas de Ensayo Shelter', '', '', 0, '2015-03-27 18:17:30', '2015-03-27 18:17:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_negocio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_negocio`, `nombre`, `created_at`, `updated_at`) VALUES
(7, 10, 'Producto 1', '2015-04-20 16:37:41', '2015-04-20 16:37:41'),
(8, 10, 'Producto 2', '2015-04-20 16:38:06', '2015-04-20 16:38:06'),
(9, 10, 'Producto 3', '2015-04-20 16:38:28', '2015-04-20 16:38:28'),
(10, 10, 'insumo', '2015-07-17 19:24:53', '2015-07-17 19:24:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productosxstock`
--

CREATE TABLE IF NOT EXISTS `productosxstock` (
  `id` int(11) NOT NULL,
  `nro_registro` int(11) NOT NULL,
  `proveedor` varchar(100) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `stock_inicial` int(11) NOT NULL DEFAULT '0',
  `precio_costo` float NOT NULL DEFAULT '0',
  `precio_venta` float NOT NULL DEFAULT '0',
  `comentario` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`nro_registro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productosxstock`
--

INSERT INTO `productosxstock` (`id`, `nro_registro`, `proveedor`, `stock`, `stock_inicial`, `precio_costo`, `precio_venta`, `comentario`, `created_at`, `updated_at`) VALUES
(7, 1, 'Proveedor 1', 30, 30, 100, 150, NULL, '2015-04-20 16:37:41', '2015-05-04 15:40:39'),
(7, 2, 'Proveedor 1', 20, 0, 100, 150, '', '2015-05-04 16:47:47', '2015-05-04 16:47:47'),
(8, 1, 'Proveedor 2', 3, 25, 80, 110, NULL, '2015-04-20 16:38:06', '2015-11-02 16:56:31'),
(9, 1, 'proveedor 3', 20, 20, 50, 75, NULL, '2015-04-20 16:38:28', '2015-04-20 16:38:28'),
(10, 1, 'PEPE', 10, 0, 25, 35, NULL, '2015-07-17 19:24:53', '2015-07-17 19:24:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `provincia` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `provincia`, `created_at`, `updated_at`) VALUES
(1, 'Buenos Aires', NULL, NULL),
(2, 'Capital Federal', NULL, NULL),
(3, 'Catamarca', NULL, NULL),
(4, 'Chaco', NULL, NULL),
(5, 'Chubut', NULL, NULL),
(6, 'Cordoba', NULL, NULL),
(7, 'Corrientes', NULL, NULL),
(8, 'Entre Rios', NULL, NULL),
(9, 'Formosa', NULL, NULL),
(10, 'La Pampa', NULL, NULL),
(11, 'La Rioja', NULL, NULL),
(12, 'Mendoza', NULL, NULL),
(13, 'Misiones', NULL, NULL),
(14, 'Neuquen', NULL, NULL),
(15, 'Rio Negro', NULL, NULL),
(16, 'Salta', NULL, NULL),
(17, 'San Juan', NULL, NULL),
(18, 'San Luis', NULL, NULL),
(19, 'Santa Cruz', NULL, NULL),
(20, 'Santa Fe', NULL, NULL),
(21, 'Santiago del Estero', NULL, NULL),
(22, 'Tucuman', NULL, NULL),
(23, 'Tierra del Fuego', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_estados`
--

CREATE TABLE IF NOT EXISTS `reservas_estados` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `reservas_estados`
--

INSERT INTO `reservas_estados` (`id`, `estado`) VALUES
(1, 'Programada'),
(2, 'Re-Programada'),
(3, 'Cancelada'),
(4, 'Ganada'),
(5, 'Perdida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_salas`
--

CREATE TABLE IF NOT EXISTS `reservas_salas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sala` int(11) NOT NULL,
  `anio` smallint(6) NOT NULL,
  `mes` tinyint(4) NOT NULL,
  `dia` tinyint(4) NOT NULL,
  `hora_inicio` tinyint(4) NOT NULL,
  `minuto_inicio` tinyint(4) NOT NULL,
  `hora_fin` tinyint(4) NOT NULL,
  `minuto_fin` tinyint(4) NOT NULL,
  `id_grupo` bigint(20) NOT NULL,
  `comentario` varchar(10) DEFAULT NULL,
  `id_estado_reserva` tinyint(4) DEFAULT NULL,
  `id_servicio` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_salas` (`id_sala`),
  KEY `fk_grupos` (`id_grupo`),
  KEY `fk_estado` (`id_estado_reserva`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `reservas_salas`
--

INSERT INTO `reservas_salas` (`id`, `id_sala`, `anio`, `mes`, `dia`, `hora_inicio`, `minuto_inicio`, `hora_fin`, `minuto_fin`, `id_grupo`, `comentario`, `id_estado_reserva`, `id_servicio`, `created_at`, `updated_at`) VALUES
(7, 57, 2015, 5, 21, 14, 30, 16, 30, 35, 'dfdfgdg', NULL, 0, '2015-05-23 19:25:03', '2015-05-23 22:25:03'),
(8, 57, 2015, 5, 24, 11, 0, 13, 0, 36, 'ddssdd', NULL, 0, '2015-05-23 21:33:27', '2015-05-23 21:33:27'),
(9, 57, 2015, 6, 26, 21, 0, 22, 0, 35, 'asd', NULL, 0, '2015-06-27 02:40:51', '2015-06-27 02:40:51'),
(10, 57, 2015, 6, 26, 14, 0, 15, 0, 35, 'sadasda', 4, 5, '2015-06-28 16:06:02', '2015-06-28 16:06:02'),
(11, 57, 2015, 6, 27, 10, 0, 12, 0, 36, 'asdasd', 4, 5, '2015-06-28 16:57:23', '2015-06-28 16:57:23'),
(12, 57, 2015, 6, 30, 13, 0, 14, 0, 35, '', 5, 5, '2015-07-05 19:50:24', '2015-07-05 19:50:24'),
(13, 57, 2015, 6, 28, 14, 0, 16, 0, 36, '', 4, 5, '2015-07-05 19:50:24', '2015-07-05 19:50:24'),
(14, 57, 2015, 6, 27, 6, 0, 7, 0, 35, 'reserva pa', 4, 5, '2015-07-17 19:17:14', '2015-07-17 19:17:14'),
(15, 53, 2015, 12, 10, 0, 0, 1, 0, 35, 'cxzcxzcxzx', 4, 0, '2015-12-11 21:36:17', '2015-12-11 21:36:17'),
(16, 53, 2015, 12, 11, 2, 0, 3, 0, 35, 'czxczcxz', 1, 0, '2015-12-11 21:32:36', '2015-12-11 21:32:36'),
(17, 53, 2015, 12, 9, 1, 0, 2, 0, 35, 'cxzcxzcxzc', 1, 0, '2015-12-11 21:32:43', '2015-12-11 21:32:43'),
(18, 53, 2015, 12, 13, 1, 0, 2, 0, 35, 'Damian', 1, 0, '2015-12-13 15:55:18', '2015-12-13 15:55:18'),
(19, 54, 2016, 1, 25, 9, 0, 16, 0, 35, 'Hola', 4, 0, '2016-03-18 17:54:50', '2016-03-18 17:54:50'),
(20, 54, 2016, 3, 15, 1, 0, 2, 0, 38, '', 4, 0, '2016-03-18 17:54:50', '2016-03-18 17:54:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE IF NOT EXISTS `salas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_negocio` int(11) NOT NULL,
  `sala` varchar(30) DEFAULT NULL,
  `principal` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_negocios_salas` (`id_negocio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id`, `id_negocio`, `sala`, `principal`, `created_at`, `updated_at`) VALUES
(49, 8, 'Sala Velez', 0, '2015-02-13 14:44:34', '0000-00-00 00:00:00'),
(50, 8, 'Sala Estudiantes', 0, '2015-02-13 14:44:34', '0000-00-00 00:00:00'),
(51, 8, 'Sala Lanus', 0, '2015-02-13 14:44:34', '0000-00-00 00:00:00'),
(52, 8, 'Sala Central', 1, '2015-02-13 14:44:34', '0000-00-00 00:00:00'),
(53, 9, 'Sala Banfield', 0, '2016-01-25 17:04:49', '2016-01-25 17:04:48'),
(54, 9, 'Sala Allboys', 1, '2016-01-25 17:04:49', '2016-01-25 17:04:49'),
(55, 9, 'Sala Gimnasia', 0, '2016-01-25 17:04:49', '2016-01-25 17:04:48'),
(56, 9, 'Sala Chicago', 0, '2016-01-25 17:04:49', '2016-01-25 17:04:48'),
(57, 10, 'Marshall', 1, '2015-08-18 21:39:01', '2015-08-18 21:39:01'),
(58, 10, 'Fender', 0, '2015-08-18 21:39:01', '2015-08-18 21:39:01'),
(59, 10, 'Laney', 0, '2015-08-18 21:39:01', '2015-08-18 21:39:01'),
(60, 7, 'Sala San Lorenzo', 1, '2015-08-18 21:35:10', '0000-00-00 00:00:00'),
(61, 7, 'Sala River', 0, '2015-08-18 21:35:10', '0000-00-00 00:00:00'),
(62, 7, 'Sala Boca', 0, '2015-08-18 21:35:10', '0000-00-00 00:00:00'),
(63, 7, 'Sala Independiente', 0, '2015-08-18 21:35:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE IF NOT EXISTS `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_negocio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `vigencia_desde` date NOT NULL,
  `vigencia_hasta` date NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `id_negocio`, `nombre`, `vigencia_desde`, `vigencia_hasta`, `precio_venta`, `created_at`, `updated_at`) VALUES
(3, 7, 'weqweqew', '2015-04-01', '2015-06-22', 233, '2015-03-27 19:19:23', '2015-03-27 19:19:23'),
(4, 10, '2 hs - 200', '2015-04-01', '2015-04-30', 200, '2015-03-27 19:35:38', '2015-03-27 19:35:38'),
(5, 10, '2 hs - 250', '2015-06-01', '2015-07-31', 250, '2015-05-23 22:10:18', '2015-05-23 22:10:18'),
(6, 10, '3 hs 150', '2015-06-01', '2015-08-31', 150, '2015-06-28 16:27:54', '2015-06-28 16:27:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos`
--

CREATE TABLE IF NOT EXISTS `telefonos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_negocio` int(11) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `principal` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_negocios` (`id_negocio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `telefonos`
--

INSERT INTO `telefonos` (`id`, `id_negocio`, `telefono`, `principal`, `created_at`, `updated_at`) VALUES
(25, 8, '1558415485', 0, '2015-02-13 14:44:34', '0000-00-00 00:00:00'),
(26, 8, '02320455878', 1, '2015-02-13 14:44:34', '0000-00-00 00:00:00'),
(27, 9, '1558477885', 0, '2015-02-13 14:47:05', '0000-00-00 00:00:00'),
(28, 9, '0232055444', 1, '2015-02-13 14:47:05', '0000-00-00 00:00:00'),
(29, 10, '1133445566', 1, '2015-03-27 15:17:30', '0000-00-00 00:00:00'),
(30, 7, '1558140669', 1, '2015-08-18 21:35:10', '0000-00-00 00:00:00'),
(31, 7, '02320415554', 0, '2015-08-18 21:35:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(50) NOT NULL,
  `activo` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`id`, `tipo_usuario`, `activo`) VALUES
(1, 'Administrador', 0),
(2, 'Gestor de negocio', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_users_tipos_usuarios` (`tipo_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nombre`, `apellido`, `tipo_usuario`, `estado`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$aHbklATS3eU1B5k7elOyDejCWlp3Z4Kn1eOZBRgQkeNTwKgHxdu7q', 'Usuario', 'Administrador', 1, 0, 'kOk0kXSJjhyHGDvRsMXRKgbmgcqUvzhqYPYErFor7PEByW02sdC8YMkgVJ59', '2016-01-16 15:51:41', '2016-01-16 15:51:41'),
(2, 'gestor1', '$2y$10$aHbklATS3eU1B5k7elOyDejCWlp3Z4Kn1eOZBRgQkeNTwKgHxdu7q', 'Gestor', 'Uno', 2, 0, 'ZIMmMtU3XAzzxThWaM8ZRD5Q96fLwxNFepxg7TEUDVk11jZDOVxC2nOfKrts', '2016-01-16 15:59:49', '2016-01-16 15:59:49'),
(3, 'gestor2', '$2y$10$aHbklATS3eU1B5k7elOyDejCWlp3Z4Kn1eOZBRgQkeNTwKgHxdu7q', 'Gestor', 'Dos', 2, 0, 'a2Zz2e1UhJUbilz13YGQIGjaOZc2AJyEx6GmNJqslfxmHh3ixHZPd8C3Qrk6', '2015-02-13 13:54:47', '2015-02-13 16:54:47'),
(4, 'shelter', '$2y$10$JtbKkGrkjqzKNiWMjUz5a.lHeIIUyvT/AcHFuUNre8SxLqlBReQXa', 'Maxx', 'Sar Fernandez', 2, 0, '6kKPcK4zKiiON0sQpkLJpWX4lBfSD8etK2EifHLuD6Hym8J44CHppfnHBQrk', '2015-10-27 13:04:39', '2015-10-27 13:04:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosxnegocios`
--

CREATE TABLE IF NOT EXISTS `usuariosxnegocios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_negocio` int(11) NOT NULL,
  `principal` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usuariosxnegocios_users` (`id_usuario`),
  KEY `FK_usuariosxnegocios_negocios` (`id_negocio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `usuariosxnegocios`
--

INSERT INTO `usuariosxnegocios` (`id`, `id_usuario`, `id_negocio`, `principal`, `created_at`, `updated_at`) VALUES
(15, 3, 8, 1, NULL, NULL),
(17, 2, 9, 1, NULL, '2015-02-13 17:47:34'),
(18, 3, 9, 0, NULL, NULL),
(19, 4, 10, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `id` bigint(20) NOT NULL,
  `nro_registro` int(11) NOT NULL,
  `id_negocio` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  `precio_unitario` smallint(6) NOT NULL,
  `eliminado` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`,`nro_registro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `nro_registro`, `id_negocio`, `id_grupo`, `id_producto`, `cantidad`, `precio_unitario`, `eliminado`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 35, 7, 10, 150, 1, '2015-05-04 12:40:39', '2015-05-04 15:40:39'),
(1, 2, 10, 35, 8, 1, 110, 1, '2015-05-04 12:40:39', '2015-05-04 15:40:39'),
(2, 1, 10, 35, 8, 20, 110, 0, '2015-05-04 16:56:38', '2015-05-04 16:56:38'),
(3, 1, 10, 35, 8, 2, 110, 0, '2015-11-02 16:56:31', '2015-11-02 16:56:31');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `grupos` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `negocios` FOREIGN KEY (`id_negocio`) REFERENCES `negocios` (`id`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `estilos` FOREIGN KEY (`id_estilo`) REFERENCES `estilos` (`id`),
  ADD CONSTRAINT `usuarios` FOREIGN KEY (`id_usuario_creador`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `gruposxnegocios`
--
ALTER TABLE `gruposxnegocios`
  ADD CONSTRAINT `gruposxnegocios` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `negociosxgrupos` FOREIGN KEY (`id_negocio`) REFERENCES `negocios` (`id`);

--
-- Filtros para la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD CONSTRAINT `fk_provincias` FOREIGN KEY (`id_provincia`) REFERENCES `provincias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas_salas`
--
ALTER TABLE `reservas_salas`
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`id_estado_reserva`) REFERENCES `reservas_estados` (`id`),
  ADD CONSTRAINT `fk_grupos` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `fk_salas` FOREIGN KEY (`id_sala`) REFERENCES `salas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salas`
--
ALTER TABLE `salas`
  ADD CONSTRAINT `fk_negocios_salas` FOREIGN KEY (`id_negocio`) REFERENCES `negocios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `telefonos`
--
ALTER TABLE `telefonos`
  ADD CONSTRAINT `fk_negocios` FOREIGN KEY (`id_negocio`) REFERENCES `negocios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_users_tipos_usuarios` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipos_usuarios` (`id`);

--
-- Filtros para la tabla `usuariosxnegocios`
--
ALTER TABLE `usuariosxnegocios`
  ADD CONSTRAINT `FK_usuariosxnegocios_negocios` FOREIGN KEY (`id_negocio`) REFERENCES `negocios` (`id`),
  ADD CONSTRAINT `FK_usuariosxnegocios_users` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
