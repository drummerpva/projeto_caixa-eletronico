CREATE DATABASE IF NOT EXISTS `projeto_caixaeletronico` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projeto_caixaeletronico`;

CREATE TABLE `contas` (
  `id` int(11) NOT NULL,
  `titular` varchar(100) DEFAULT NULL,
  `agencia` int(11) DEFAULT NULL,
  `conta` int(11) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `saldo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `contas` (`id`, `titular`, `agencia`, `conta`, `senha`, `saldo`) VALUES
(1, 'Douglas Poma', 2389, 173444, '81dc9bdb52d04dc20036dbd8313ed055', NULL);

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `idConta` int(11) DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `data_operacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `contas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `contas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;