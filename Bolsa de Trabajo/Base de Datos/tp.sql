-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2016 a las 06:59:01
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aspirantes`
--

CREATE TABLE IF NOT EXISTS `aspirantes` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacimiento` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `dni` int(11) NOT NULL,
  `idSexo` int(11) NOT NULL,
  `idDomicilio` int(11) NOT NULL,
  `fotoPerfil` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `pdf` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `aspirantes`
--

INSERT INTO `aspirantes` (`idUsuario`, `nombre`, `apellido`, `fechaNacimiento`, `dni`, `idSexo`, `idDomicilio`, `fotoPerfil`, `pdf`) VALUES
(13, 'Priscila', 'Ibarra', '05/09/1993', 22222, 2, 44, 'fotos/2016-06-11063327_116922.jpeg', 'pdf/2016-06-11063327_23985.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisoaspirante`
--

CREATE TABLE IF NOT EXISTS `avisoaspirante` (
  `dni` int(11) NOT NULL,
  `idAviso` int(11) NOT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisos`
--

CREATE TABLE IF NOT EXISTS `avisos` (
  `idAviso` int(11) NOT NULL AUTO_INCREMENT,
  `idRubro` int(11) NOT NULL,
  `asunto` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `idRequisitos` int(11) NOT NULL,
  `idDomicilio` int(11) NOT NULL,
  PRIMARY KEY (`idAviso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `avisos`
--

INSERT INTO `avisos` (`idAviso`, `idRubro`, `asunto`, `descripcion`, `idRequisitos`, `idDomicilio`) VALUES
(1, 1, 'Vendedores en Shopping', 'Importante cadena de supermercados, incorpora vendedores de electrodomésticos, para trabajar  en  Alto Rosario Shopping. Los interesados deben contar con excelente presencia secundario completo con analítico yo certificado experiencia en ventas de electrodomésticos, celulares.', 1, 1),
(2, 1, 'Vendedor o distribuidor de galletitas ', 'Se busca distribuidores o vendedores con cartera de clientes para venta de galletitas, excelente oportunidad con muy buenos precios.', 2, 45),
(7, 12, 'Publicista para lanzar al mercado un nue', 'Se solicita publicista moderna, con ideas creativas para participar en el lanzamiento de un nuevo producto', 7, 45),
(9, 12, 'Publicista para lanzar al mercado un nue', 'Se solicita publicista moderna, con ideas creativas para participar en el lanzamiento de un nuevo producto', 7, 45),
(10, 3, 'Distribuidor de productos', 'Se busca distribuidor de productos para importante marca distribuidora de galletitas y golosinas', 10, 45),
(11, 1, 'Vendedor de golosinas', 'Se busca vendedor con experiencia para  trabajar en una sucursal.', 11, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisosempresas`
--

CREATE TABLE IF NOT EXISTS `avisosempresas` (
  `idAviso` int(11) NOT NULL,
  `cuitEmpresa` bigint(11) NOT NULL,
  `fechaPublicacion` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`idAviso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `avisosempresas`
--

INSERT INTO `avisosempresas` (`idAviso`, `cuitEmpresa`, `fechaPublicacion`, `estado`) VALUES
(1, 30123453458, '31-05-2016', 1),
(2, 343333333, '07-06-2016', 1),
(10, 343333333, '08/06/2016', 1),
(11, 30123456789, '11/06/2016', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisosfavoritos`
--

CREATE TABLE IF NOT EXISTS `avisosfavoritos` (
  `idfav` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idAvisoFav` int(11) NOT NULL,
  `calificacion` varchar(12) NOT NULL,
  `comentarios` text NOT NULL,
  PRIMARY KEY (`idfav`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `avisosfavoritos`
--

INSERT INTO `avisosfavoritos` (`idfav`, `idUsuario`, `idAvisoFav`, `calificacion`, `comentarios`) VALUES
(2, 13, 0, 'Bueno', 'Entrevista pautada con el Jefe de Recursos Humanos par el 10-6-2016'),
(4, 13, 1, 'Excelente', 'La entrevista se realizo con exito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calles`
--

CREATE TABLE IF NOT EXISTS `calles` (
  `idCalle` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idCalle`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `calles`
--

INSERT INTO `calles` (`idCalle`, `nombre`) VALUES
(1, 'Junin'),
(2, 'Mendoza'),
(3, 'San Juan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE IF NOT EXISTS `ciudades` (
  `idCiudad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `idProvincia` int(11) NOT NULL,
  PRIMARY KEY (`idCiudad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`idCiudad`, `nombre`, `idProvincia`) VALUES
(1, 'Rosario', 1),
(2, 'Santa Fe', 1),
(3, 'Cordoba', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

CREATE TABLE IF NOT EXISTS `domicilio` (
  `idDomicilio` int(11) NOT NULL AUTO_INCREMENT,
  `idCalle` int(11) NOT NULL,
  `nro` int(11) NOT NULL,
  `idCiudad` int(11) NOT NULL,
  PRIMARY KEY (`idDomicilio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`idDomicilio`, `idCalle`, `nro`, `idCiudad`) VALUES
(1, 1, 501, 1),
(7, 2, 8000, 1),
(37, 1, 9999, 1),
(38, 2, 234123, 1),
(39, 2, 234123, 1),
(40, 2, 234123, 1),
(41, 2, 4534, 2),
(42, 1, 12312, 1),
(43, 2, 9897, 1),
(44, 2, 5000, 2),
(45, 2, 1500, 1),
(46, 2, 1500, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `idUsuario` int(11) NOT NULL,
  `razonSocial` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `cuit` bigint(11) NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `idDomicilio` int(11) NOT NULL,
  `tel` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `fotoPerfil` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`cuit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`idUsuario`, `razonSocial`, `cuit`, `descripcion`, `idDomicilio`, `tel`, `fotoPerfil`) VALUES
(3, 'True SA', 30123453458, 'True SA es una cadena de electrodomésticos de Argentina fundada en 2008. La empresa inició sus actividades como cadena de artículos para el hogar pero fue migrando con el tiempo al mercado de la venta de electrodomésticos y artículos tecnológicos', 1, '4578989', 'fotos/2016-06-07205313_53384.jpeg'),
(23, 'Bagley Sa', 30123456788, 'Empresa distribuidora de golosinas y galletitas.Lider a nivel mundial', 45, '3414566789', 'fotos/2016-06-11061452_68913.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `idEstado` tinyint(3) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(15) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idEstado`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Vencido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas`
--

CREATE TABLE IF NOT EXISTS `idiomas` (
  `idIdioma` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  PRIMARY KEY (`idIdioma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `idiomas`
--

INSERT INTO `idiomas` (`idIdioma`, `descripcion`) VALUES
(1, 'No especificado'),
(2, 'Español'),
(3, 'Ingles'),
(4, 'Francés');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveldeestudios`
--

CREATE TABLE IF NOT EXISTS `niveldeestudios` (
  `idNivelDeEstudio` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) NOT NULL,
  PRIMARY KEY (`idNivelDeEstudio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `niveldeestudios`
--

INSERT INTO `niveldeestudios` (`idNivelDeEstudio`, `descripcion`) VALUES
(1, 'Secundario'),
(2, 'Terciario'),
(3, 'Universitario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `idProvincia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idProvincia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`idProvincia`, `nombre`) VALUES
(1, 'Santa Fe'),
(2, 'Cordoba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisitos`
--

CREATE TABLE IF NOT EXISTS `requisitos` (
  `idRequisitos` int(11) NOT NULL AUTO_INCREMENT,
  `idSexo` int(11) NOT NULL,
  `edad` tinyint(2) NOT NULL,
  `idNivelDeEstudio` int(11) NOT NULL,
  `idTipoTrabajo` int(11) NOT NULL,
  `experienciaLaboral` tinyint(2) DEFAULT NULL,
  `idIdioma` int(11) NOT NULL,
  PRIMARY KEY (`idRequisitos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `requisitos`
--

INSERT INTO `requisitos` (`idRequisitos`, `idSexo`, `edad`, `idNivelDeEstudio`, `idTipoTrabajo`, `experienciaLaboral`, `idIdioma`) VALUES
(1, 1, 35, 1, 1, 3, 1),
(2, 1, 30, 1, 1, 3, 1),
(6, 1, 25, 2, 1, 3, 1),
(7, 2, 30, 3, 1, 2, 3),
(8, 2, 30, 3, 1, 2, 3),
(9, 2, 30, 3, 1, 2, 3),
(10, 1, 40, 1, 1, 3, 1),
(11, 3, 34, 1, 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE IF NOT EXISTS `rubros` (
  `idRubro` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  PRIMARY KEY (`idRubro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `rubros`
--

INSERT INTO `rubros` (`idRubro`, `descripcion`) VALUES
(1, 'Ventas'),
(2, 'Seguridad'),
(3, 'Transporte'),
(4, 'Call Center'),
(5, 'Atención al Cliente'),
(6, 'Finanzas'),
(7, 'Economia'),
(8, 'Comunicación y medios'),
(9, 'Logística y Transporte'),
(10, 'Legales'),
(12, 'Marketing y Publicidad'),
(13, 'Sistemas'),
(14, 'Tecnologías de Información'),
(15, 'Tecnología'),
(16, 'Programación'),
(17, 'Gastronomía'),
(18, 'Turismo y Hoteleria'),
(19, 'Gerencia y Direccion'),
(20, 'Arquitectura y Construccion'),
(21, 'Comercio Exterior'),
(22, 'Salud'),
(23, 'Educacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

CREATE TABLE IF NOT EXISTS `sexo` (
  `idSexo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  PRIMARY KEY (`idSexo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `sexo`
--

INSERT INTO `sexo` (`idSexo`, `descripcion`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'Indistinto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposdetrabajos`
--

CREATE TABLE IF NOT EXISTS `tiposdetrabajos` (
  `idTipoTrabajo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) NOT NULL,
  PRIMARY KEY (`idTipoTrabajo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tiposdetrabajos`
--

INSERT INTO `tiposdetrabajos` (`idTipoTrabajo`, `descripcion`) VALUES
(1, 'Full Time'),
(2, 'Part Time'),
(3, 'Freelance');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomUsuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `tipoUsuario` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nomUsuario`, `email`, `password`, `tipoUsuario`) VALUES
(1, 'prisci123', 'tutu@hotmail.com', 'a722c63db8ec8625af6cf71cb8c2d939', 2),
(3, 'True SA', 'TrueSA@gmail.com', 'a722c63db8ec8625af6cf71cb8c2d939', 1),
(4, 'Paladini SA', 'paladini@yahoo.com.ar', '699a545d270fb94ee5eb6cc817f91c0b', 1),
(5, 'asdfasd', 'li@hotmail.com', '$1$RX5.Gl5.$2v6Uhg9I86e3wxL7XfvW00', 1),
(6, 'asdfasd', 'li@hotmail.com', '$1$NL2.Si..$vAO4sAq/UJhtogiHWB/dD0', 1),
(7, 'Yooo', 'yo@hp.com', 'fcacf366e100ec0f419f6a2c3999047df8328a4c', 1),
(9, '123', '123', 'fcacf366e100ec0f419f6a2c3999047df8328a4c', 1),
(24, 'juan', 'juan@hotmail.com', 'b714337aa8007c433329ef43c7b8252c', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
