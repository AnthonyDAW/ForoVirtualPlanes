-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2015 a las 00:15:51
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `foro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_foro`
--

CREATE TABLE IF NOT EXISTS `comentario_foro` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `id_tema` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` date NOT NULL,
  `activo` int(1) NOT NULL,
  PRIMARY KEY (`id_comentario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `comentario_foro`
--

INSERT INTO `comentario_foro` (`id_comentario`, `id_tema`, `id_usuario`, `comentario`, `fecha`, `activo`) VALUES
(1, 1, 3, '<p>que bien!!!</p>', '2015-04-17', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas`
--

CREATE TABLE IF NOT EXISTS `estadisticas` (
  `id_estadistica` int(11) NOT NULL AUTO_INCREMENT,
  `id_tema` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_estadistica`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_categoria`
--

CREATE TABLE IF NOT EXISTS `foro_categoria` (
  `id_forocategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(250) NOT NULL,
  PRIMARY KEY (`id_forocategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `foro_categoria`
--

INSERT INTO `foro_categoria` (`id_forocategoria`, `categoria`) VALUES
(1, 'Deportes'),
(2, 'Musica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_foro`
--

CREATE TABLE IF NOT EXISTS `foro_foro` (
  `id_foro` int(11) NOT NULL AUTO_INCREMENT,
  `id_forocategoria` int(11) NOT NULL,
  `foro` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id_foro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `foro_foro`
--

INSERT INTO `foro_foro` (`id_foro`, `id_forocategoria`, `foro`, `descripcion`) VALUES
(1, 1, 'Futbol', 'Futbol'),
(2, 0, 'mundiales', 'mundiales'),
(3, 0, 'Liguillas', 'Liguillas'),
(4, 0, 'torneos', 'torneos'),
(5, 0, 'Lucha libre', 'Lucha libre'),
(6, 1, 'Lucha libre', 'Lucha libre'),
(7, 0, 'wwe', 'wwe'),
(8, 0, 'aaa', 'aaa'),
(10, 2, 'Pop', 'Pop'),
(11, 2, 'Rock', 'Rock');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_subforos`
--

CREATE TABLE IF NOT EXISTS `foro_subforos` (
  `id_subforo` int(11) NOT NULL AUTO_INCREMENT,
  `id_foro` int(11) NOT NULL,
  `subforo` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id_subforo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `foro_subforos`
--

INSERT INTO `foro_subforos` (`id_subforo`, `id_foro`, `subforo`, `descripcion`) VALUES
(1, 1, 'mundiales', 'mundiales'),
(2, 1, 'Liguillas', 'Liguillas'),
(3, 1, 'torneos', 'torneos'),
(5, 6, 'wwe', 'wwe'),
(6, 6, 'aaa', 'aaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_temas`
--

CREATE TABLE IF NOT EXISTS `foro_temas` (
  `id_tema` int(11) NOT NULL AUTO_INCREMENT,
  `id_foro` int(11) NOT NULL,
  `id_subforo` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario` int(5) NOT NULL,
  `activo` int(1) NOT NULL,
  `hits` int(11) NOT NULL,
  PRIMARY KEY (`id_tema`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `foro_temas`
--

INSERT INTO `foro_temas` (`id_tema`, `id_foro`, `id_subforo`, `titulo`, `contenido`, `fecha`, `id_usuario`, `activo`, `hits`) VALUES
(1, 10, 0, 'Nuevo disco de...', '<p>Despues de mucho esperar el grupo x a lanzado su nuevo disco con 12 canciones ineditas...</p>', '2015-04-17', 3, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `tipo` int(2) NOT NULL,
  `facebook` varchar(250) NOT NULL,
  `twitter` varchar(250) NOT NULL,
  `fechaderegistro` date NOT NULL,
  `ultimoacceso` date NOT NULL,
  `activo` int(2) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `firma` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nick`, `password`, `nombre`, `correo`, `tipo`, `facebook`, `twitter`, `fechaderegistro`, `ultimoacceso`, `activo`, `avatar`, `firma`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin', 'admin@admin.net', 2, 'f', 'ti', '2015-04-06', '2015-04-06', 1, '1_594451-1680x1050.jpg', 'sdad'),
(3, 'pedrito', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user1', 'user1@hotmail.com', 2, '', '', '2015-04-17', '2015-04-17', 1, 'default.jpg', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
