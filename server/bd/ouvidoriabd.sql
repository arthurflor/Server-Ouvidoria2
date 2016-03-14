-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2016 at 03:29 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ouvidoriabd`
--

-- --------------------------------------------------------

--
-- Table structure for table `reclamacoes`
--

DROP TABLE IF EXISTS `reclamacoes`;
CREATE TABLE IF NOT EXISTS `reclamacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nome` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_idade` tinyint(3) UNSIGNED DEFAULT NULL,
  `user_genero` varchar(1) DEFAULT NULL,
  `texto` varchar(144) NOT NULL,
  `data` date NOT NULL,
  `imagem` varchar(100) NOT NULL COMMENT 'endereço da imagem',
  `categoria` tinyint(4) NOT NULL,
  `latitude` float(10,6) DEFAULT NULL,
  `longitude` float(10,6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
