-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 14-Mar-2016 às 21:15
-- Versão do servidor: 5.5.47-0ubuntu0.14.04.1
-- versão do PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `ouvidoria_app`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `reclamacoes`
--

CREATE TABLE IF NOT EXISTS `reclamacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nome` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_idade` tinyint(3) unsigned DEFAULT NULL,
  `user_genero` varchar(1) DEFAULT NULL,
  `texto` varchar(144) NOT NULL,
  `data` date NOT NULL,
  `imagem` varchar(100) NOT NULL COMMENT 'endereço da imagem',
  `categoria` tinyint(4) NOT NULL,
  `latitude` float(10,6) DEFAULT NULL,
  `longitude` float(10,6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `reclamacoes`
--

INSERT INTO `reclamacoes` (`id`, `user_nome`, `user_email`, `user_idade`, `user_genero`, `texto`, `data`, `imagem`, `categoria`, `latitude`, `longitude`) VALUES
(20, 'Leylane', 'xlehx@gmail.com', 20, 'f', 'oi isso é um absurdo', '2016-03-01', 'images/upload/Centro.jpg', 18, -8.285913, -35.972218),
(21, 'renan', 'renan@bomito.com', 23, 'm', 'que coisa horrivel', '2016-03-10', 'images/upload/EncantoDaSerra.JPG', 18, -8.308123, -35.975121),
(22, 'iago', 'iago@gmail.com', 19, 'm', 'blitz ae kkkkk', '2016-03-01', 'images/upload/MariaAuxiliadora.jpg', 18, -8.277621, -36.002090),
(23, 'arthur', 'flor@com.ce', 23, 'm', 'falta as obras aeeee', '2016-03-10', 'images/upload/LuizGonzaga.jpg', 18, -8.255622, -35.971748),
(24, 'Gustavo leonardo', 'guto@leoni.com', 20, 'm', 'eu moro perto dae', '2016-03-01', 'images/upload/Rendeiras.jpg', 18, -8.282965, -35.938576);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`) VALUES
(1, 'iago', '123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
