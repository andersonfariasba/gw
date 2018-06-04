-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 22-Mar-2018 às 08:45
-- Versão do servidor: 5.5.58-0ubuntu0.14.04.1
-- versão do PHP: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `estrategic`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comp_itens`
--

CREATE TABLE IF NOT EXISTS `comp_itens` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitacao` int(11) NOT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `id_obra` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `id_custo` int(11) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  `data_inclusao` date DEFAULT NULL,
  `deletado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_item`),
  UNIQUE KEY `id_item_UNIQUE` (`id_item`),
  KEY `fk_comp_itens_idx` (`id_solicitacao`),
  KEY `fk_comp_forn_idx` (`id_fornecedor`),
  KEY `fk_comp_obra_idx` (`id_obra`),
  KEY `fk_comp_prod_idx` (`id_produto`),
  KEY `fk_comp_custo_idx` (`id_custo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comp_solicitacao`
--

CREATE TABLE IF NOT EXISTS `comp_solicitacao` (
  `id_solicitacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` int(11) NOT NULL,
  `id_status_cotacao` int(11) DEFAULT NULL,
  `id_solicitante` int(11) NOT NULL,
  `id_aprovador` int(11) DEFAULT NULL,
  `id_aprovador_cotacao` int(11) DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `data_necessidade` date DEFAULT NULL,
  `data_aprovacao` date DEFAULT NULL,
  `data_aprovacao_cotacao` date DEFAULT NULL,
  `tipo_entrada` tinyint(1) DEFAULT NULL,
  `observacao` text,
  `observacao_cotacao` text,
  `observacao_controladoria` text,
  `observacao_diretoria` text,
  `codigo_pc` varchar(45) DEFAULT NULL,
  `id_status_controladoria` int(11) DEFAULT NULL,
  `id_aprovador_controladoria` int(11) DEFAULT NULL,
  `data_aprovacao_controladoria` date DEFAULT NULL,
  `id_status_diretoria` int(11) DEFAULT NULL,
  `id_aprovador_diretoria` int(11) DEFAULT NULL,
  `data_aprovacao_diretoria` date DEFAULT NULL,
  `deletado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_solicitacao`),
  UNIQUE KEY `id_solicitacao_UNIQUE` (`id_solicitacao`),
  KEY `fk_comp_solicitacao_status_idx` (`id_status`),
  KEY `fk_comp_solicitante_idx` (`id_solicitante`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `comp_itens`
--
ALTER TABLE `comp_itens`
  ADD CONSTRAINT `fk_comp_custo` FOREIGN KEY (`id_custo`) REFERENCES `fin_centro_custos` (`id_custo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comp_forn` FOREIGN KEY (`id_fornecedor`) REFERENCES `com_fornecedores` (`id_fornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comp_itens` FOREIGN KEY (`id_solicitacao`) REFERENCES `comp_solicitacao` (`id_solicitacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comp_obra` FOREIGN KEY (`id_obra`) REFERENCES `proj_obra` (`id_obra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comp_prod` FOREIGN KEY (`id_produto`) REFERENCES `est_produtos` (`id_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `comp_solicitacao`
--
ALTER TABLE `comp_solicitacao`
  ADD CONSTRAINT `fk_comp_solicitacao_status` FOREIGN KEY (`id_status`) REFERENCES `conf_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comp_solicitante` FOREIGN KEY (`id_solicitante`) REFERENCES `rh_colaboradores` (`id_colaborador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
