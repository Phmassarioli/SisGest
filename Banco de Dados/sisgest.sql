-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Abr-2022 às 17:54
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sisgest`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cofre`
--

CREATE TABLE `cofre` (
  `cod` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `quantidadetitulo` int(11) NOT NULL,
  `valorunitario` varchar(60) NOT NULL,
  `valortotal` varchar(60) NOT NULL,
  `data` date NOT NULL,
  `instituicao` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contasfixas`
--

CREATE TABLE `contasfixas` (
  `cod` int(11) NOT NULL,
  `nomeconta` varchar(60) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `local` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ganhos`
--

CREATE TABLE `ganhos` (
  `cod` int(11) NOT NULL,
  `nomeganho` varchar(60) NOT NULL,
  `origemganho` varchar(60) NOT NULL,
  `data` date NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `gastos`
--

CREATE TABLE `gastos` (
  `cod` int(11) NOT NULL,
  `nomegasto` varchar(60) NOT NULL,
  `valorgasto` decimal(10,2) NOT NULL,
  `data` date NOT NULL,
  `local` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resgatecofre`
--

CREATE TABLE `resgatecofre` (
  `cod` int(11) NOT NULL,
  `data` date NOT NULL,
  `valor` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cofre`
--
ALTER TABLE `cofre`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `contasfixas`
--
ALTER TABLE `contasfixas`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `ganhos`
--
ALTER TABLE `ganhos`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `resgatecofre`
--
ALTER TABLE `resgatecofre`
  ADD PRIMARY KEY (`cod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cofre`
--
ALTER TABLE `cofre`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contasfixas`
--
ALTER TABLE `contasfixas`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ganhos`
--
ALTER TABLE `ganhos`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `gastos`
--
ALTER TABLE `gastos`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `resgatecofre`
--
ALTER TABLE `resgatecofre`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
