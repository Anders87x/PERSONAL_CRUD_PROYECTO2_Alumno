-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-02-2021 a las 16:29:00
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendabd`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `spc_actualizar_datos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spc_actualizar_datos` (IN `nombresU` VARCHAR(250), IN `apellidosU` VARCHAR(250), IN `emailU` VARCHAR(250), IN `celularU` VARCHAR(250), IN `direccionU` VARCHAR(250), IN `estadoU` INT, IN `idJuegoU` INT)  BEGIN
	update clientes set nombres=nombresU,
						apellidos=apellidosU,
						email=emailU,
                        celular=celularU,
                        direccion=direccionU,
                        estado=estadoU
				where id=idJuegoU;
END$$

DROP PROCEDURE IF EXISTS `spc_eliminar_datos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spc_eliminar_datos` (IN `idJuegoD` INT)  BEGIN
	delete from clientes 
    where id=idJuegoD;
END$$

DROP PROCEDURE IF EXISTS `spc_insertar_datos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spc_insertar_datos` (IN `nombresI` VARCHAR(250), IN `apellidosI` VARCHAR(250), IN `emailI` VARCHAR(250), IN `celularI` VARCHAR(250), IN `direccionI` VARCHAR(250))  NO SQL
BEGIN
	insert into clientes (nombres,
							apellidos,
                           email,
                           celular,
                           direccion)
			values (nombresI,apellidosI,emailI,celularI,direccionI);
END$$

DROP PROCEDURE IF EXISTS `spc_mostrar_datos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spc_mostrar_datos` ()  BEGIN
	select id,
			nombres,
			apellidos,
			email,
            celular,
            direccion,
            estado
	from clientes;
END$$

DROP PROCEDURE IF EXISTS `spc_obtener_regClientes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spc_obtener_regClientes` (IN `idJuegoO` INT)  BEGIN
	select * from clientes where id=idJuegoO;
END$$

DROP PROCEDURE IF EXISTS `sp_actualizar_datos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_datos` (IN `nombrepU` VARCHAR(50), IN `descripcionU` VARCHAR(50), IN `precioU` VARCHAR(50), IN `estadoU` INT, IN `idJuegoU` INT)  BEGIN
	update productos set nombrep=nombrepU,
						descripcion=descripcionU,
						precio=precioU,
                        estado=estadoU
				where id=idJuegoU;
END$$

DROP PROCEDURE IF EXISTS `sp_eliminar_datos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_datos` (IN `idJuegoD` INT)  BEGIN
	delete from productos 
    where id=idJuegoD;
END$$

DROP PROCEDURE IF EXISTS `sp_insertar_datos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_datos` (IN `nombrepI` VARCHAR(50), IN `descripcionI` VARCHAR(50), IN `categoria` VARCHAR(50), IN `precioI` VARCHAR(50))  BEGIN
	insert into productos (nombrep,
							descripcion,
                           categoria,
							precio)
			values (nombrepI,descripcionI,categoriaI,precioI);
END$$

DROP PROCEDURE IF EXISTS `sp_mostrar_datos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mostrar_datos` ()  BEGIN
	select id,
			nombrep,
			descripcion,
            categoria,
			precio,
            estado
	from productos;
END$$

DROP PROCEDURE IF EXISTS `sp_obtener_regClientes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_regClientes` (IN `idJuegoO` INT)  BEGIN
	select * from clientes where id=idJuegoO;
END$$

DROP PROCEDURE IF EXISTS `sp_obtener_regProducto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_regProducto` (IN `idJuegoO` INT)  BEGIN
	select * from productos where id=idJuegoO;
END$$

DROP PROCEDURE IF EXISTS `sp_obtener_regProductoID`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_regProductoID` (IN `id` INT)  NO SQL
SELECT id, nombrep FROM prodcutos WHERE id = id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `direccion` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creado` datetime DEFAULT NULL,
  `modificado` datetime DEFAULT NULL,
  `estado` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Activo | 0=Inactivo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellidos`, `email`, `celular`, `direccion`, `creado`, `modificado`, `estado`) VALUES
(1, 'victor', 'victorcix', 'victorsoplasanchez@gmail.com', '971603993', 'incas 123', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1'),
(2, 'Su', 'apellidos', 'su@gmail.com', '12345678', 'incas 123123', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1'),
(3, 'Miguel', 'perez perez', 'miguel@gmail.com', '12312312', 'la victoria 123', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_articulos`
--

DROP TABLE IF EXISTS `orden_articulos`;
CREATE TABLE IF NOT EXISTS `orden_articulos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `orden_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orden_id` (`orden_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `orden_articulos`
--

INSERT INTO `orden_articulos` (`id`, `orden_id`, `producto_id`, `cantidad`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 1),
(3, 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `clientes_id` int NOT NULL,
  `cantidad_total` float(10,2) NOT NULL,
  `creado` datetime NOT NULL,
  `estado` enum('Pendiente','Completado','Cancelado') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pendiente',
  PRIMARY KEY (`id`),
  KEY `clientes_id` (`clientes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `clientes_id`, `cantidad_total`, `creado`, `estado`) VALUES
(1, 1, 24.00, '2021-02-18 13:30:20', 'Pendiente'),
(2, 2, 57.00, '2021-02-18 13:33:15', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombrep` varchar(150) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `categoria` varchar(250) NOT NULL,
  `precio` varchar(150) DEFAULT NULL COMMENT 'Precio S./ soles',
  `estado` int NOT NULL DEFAULT '1' COMMENT '1=Activo | 0=Inactivo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombrep`, `descripcion`, `categoria`, `precio`, `estado`) VALUES
(1, 'pantalon', 'descripcion pantalon', 'pantalon', '44', 1),
(2, 'Polo Nike', 'Polo Deportivo', 'polos', '35', 1),
(3, 'polo', 'deescripcion polo', 'polos', '12', 1),
(4, 'Pantalon Norton', 'DESCRIPCIÓN DEL PRODUCTO ', 'polos', '180', 0),
(5, 'Polo Reebok clasico', 'Polo de calidad algodon Talla: XS', 'polos', '15', 1),
(6, 'polo lacoste', 'polo lacoste talla : M', 'polos', '25', 1),
(7, 'perwerwerantalterteeteron', 'descrewrwerripcion pantalon', 'pantarwerwerlon', '4333334', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orden_articulos`
--
ALTER TABLE `orden_articulos`
  ADD CONSTRAINT `orden_articulos_ibfk_1` FOREIGN KEY (`orden_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
