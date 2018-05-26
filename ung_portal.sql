-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24-Maio-2018 às 04:44
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ung_portal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(11) NOT NULL,
  `adm_nome` varchar(20) NOT NULL,
  `adm_sobrenome` varchar(20) NOT NULL,
  `adm_ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`adm_id`, `adm_nome`, `adm_sobrenome`, `adm_ativo`) VALUES
(1, 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `alu_id` int(11) NOT NULL,
  `alu_nome` varchar(20) NOT NULL,
  `alu_sobrenome` varchar(20) NOT NULL,
  `alu_ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`alu_id`, `alu_nome`, `alu_sobrenome`, `alu_ativo`) VALUES
(1, 'Felipe', 'Marchant', 1),
(2, 'Juquinha', 'Juca', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos_materias`
--

CREATE TABLE `alunos_materias` (
  `alu_id` int(11) NOT NULL,
  `mat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `alunos_materias`
--

INSERT INTO `alunos_materias` (`alu_id`, `mat_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencias`
--

CREATE TABLE `frequencias` (
  `fre_id` int(11) NOT NULL,
  `alu_id` int(11) NOT NULL,
  `mat_id` int(11) NOT NULL,
  `fre_presenca` tinyint(1) NOT NULL,
  `fre_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `frequencias`
--

INSERT INTO `frequencias` (`fre_id`, `alu_id`, `mat_id`, `fre_presenca`, `fre_data`) VALUES
(1, 1, 1, 1, '2018-05-24 04:27:35'),
(2, 1, 1, 0, '2018-05-24 04:28:11'),
(3, 1, 1, 0, '2018-05-24 04:29:29'),
(4, 2, 1, 1, '2018-05-24 04:42:04'),
(5, 1, 1, 0, '2018-05-24 04:42:07'),
(6, 2, 1, 0, '2018-05-24 04:42:11'),
(7, 2, 1, 1, '2018-05-24 04:42:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materias`
--

CREATE TABLE `materias` (
  `mat_id` int(11) NOT NULL,
  `mat_nome` varchar(100) NOT NULL,
  `pro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `materias`
--

INSERT INTO `materias` (`mat_id`, `mat_nome`, `pro_id`) VALUES
(1, 'Computacao Basica', 1),
(2, 'Fisica Aplicada A Computacao', NULL),
(3, 'Leitura E Producao De Texto', NULL),
(4, 'Logica De Programacao', NULL),
(5, 'Matematica Aplicada Basica', NULL),
(6, 'Arquitetura E Organizacao De Computadores', NULL),
(7, 'Calculo Diferencial E Integral I', NULL),
(8, 'Computacao E Algoritmos I', NULL),
(9, 'Metodologia Cientifica', NULL),
(10, 'Pensamento Sistemico', NULL),
(11, 'Projeto Integrado I', NULL),
(12, 'Calculo Diferencial E Integral Ii', NULL),
(13, 'Computacao E Algoritmos Ii', NULL),
(14, 'Ingles Instrumental', NULL),
(15, 'Modelagem De Banco De Dados', NULL),
(16, 'Modelagem De Sistemas', NULL),
(17, 'Probabilidade E Estatistica', NULL),
(18, 'Projeto Integrado Ii', NULL),
(19, 'Banco De Dados Avancado', NULL),
(20, 'Calculo Numerico', NULL),
(21, 'Direito Digital', NULL),
(22, 'Estrutura De Dados', NULL),
(23, 'Introducao Aos Sistemas Operacionais', NULL),
(24, 'Linguagem De Programacao I', NULL),
(25, 'Projeto Integrado Iii', NULL),
(26, 'Computador E Sociedade', NULL),
(27, 'Engenharia De Software', NULL),
(28, 'Introducao As Redes De Computadores', NULL),
(29, 'Linguagem De Programacao Ii', NULL),
(30, 'Projeto Integrado Iv', NULL),
(31, 'Sistemas Operacionais Aplicados', NULL),
(32, 'Teoria Dos Grafos', NULL),
(33, 'Administracao De Redes De Computadores', 2),
(34, 'Geometria Analitica', NULL),
(35, 'Linguagem De Programacao Para Web I', NULL),
(36, 'Metodologia Da Pesquisa Cientifica', NULL),
(37, 'Pesquisa Operacional', NULL),
(38, 'Projeto E Nalise De Algoritimos', NULL),
(39, 'Projeto Integrado V', NULL),
(40, 'Algebra Linear', NULL),
(41, 'Compiladores', NULL),
(42, 'Engenharia De Sistemas', NULL),
(43, 'Inteligencia Artificial', NULL),
(44, 'Linguagem De Programacao Para Web Ii', NULL),
(45, 'Orientacao A Pratica Profissional Supervisionada', NULL),
(46, 'Pratica Profissional Supervisionada', NULL),
(47, 'Redes Wi-fi', NULL),
(48, 'Seguranca E Auditoria De Sistemas', NULL),
(49, 'Automacao Industrial E Sistemas Digitais', NULL),
(50, 'Cidadania E Responsabilidade Social', NULL),
(51, 'Computacao Grafica', NULL),
(52, 'Gerencia De Projetos', NULL),
(53, 'Orientacao Ao Trabalho De Conclusao De Curso', NULL),
(54, 'Sistemas Multimidia E Realidade Virtual', NULL),
(55, 'Topicos Especiais Em Ti', NULL),
(56, 'Trabalho De Conclusao De Curso - Tcc', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notas`
--

CREATE TABLE `notas` (
  `not_id` int(11) NOT NULL,
  `alu_id` int(11) NOT NULL,
  `mat_id` int(11) NOT NULL,
  `not_b1` float NOT NULL,
  `not_b2` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE `professores` (
  `pro_id` int(11) NOT NULL,
  `pro_nome` varchar(20) NOT NULL,
  `pro_sobrenome` varchar(20) NOT NULL,
  `pro_ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`pro_id`, `pro_nome`, `pro_sobrenome`, `pro_ativo`) VALUES
(1, 'Erwin', 'Uhulman', 1),
(2, 'marta', 'pina', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL,
  `usu_usu_id` int(11) NOT NULL,
  `usu_ra` int(8) NOT NULL,
  `usu_email` varchar(30) NOT NULL,
  `usu_senha` varchar(40) NOT NULL,
  `usu_nivel` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usu_id`, `usu_usu_id`, `usu_ra`, `usu_email`, `usu_senha`, `usu_nivel`) VALUES
(1, 1, 12345678, 'admin@admin.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1),
(2, 1, 17976074, 'e@u.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2),
(3, 1, 69548645, 'f@m.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3),
(4, 2, 20780334, 'm@p.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2),
(5, 2, 11656188, 'j@j.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`alu_id`);

--
-- Indexes for table `alunos_materias`
--
ALTER TABLE `alunos_materias`
  ADD KEY `alu_id` (`alu_id`),
  ADD KEY `mat_id` (`mat_id`);

--
-- Indexes for table `frequencias`
--
ALTER TABLE `frequencias`
  ADD PRIMARY KEY (`fre_id`),
  ADD KEY `alu_id` (`alu_id`),
  ADD KEY `mat_id` (`mat_id`);

--
-- Indexes for table `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`mat_id`),
  ADD KEY `pro_id` (`pro_id`) USING BTREE;

--
-- Indexes for table `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`not_id`),
  ADD KEY `alu_id` (`alu_id`),
  ADD KEY `mat_id` (`mat_id`);

--
-- Indexes for table `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `alunos`
--
ALTER TABLE `alunos`
  MODIFY `alu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `frequencias`
--
ALTER TABLE `frequencias`
  MODIFY `fre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `materias`
--
ALTER TABLE `materias`
  MODIFY `mat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `notas`
--
ALTER TABLE `notas`
  MODIFY `not_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `professores`
--
ALTER TABLE `professores`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alunos_materias`
--
ALTER TABLE `alunos_materias`
  ADD CONSTRAINT `fk_alunmat_mat` FOREIGN KEY (`mat_id`) REFERENCES `materias` (`mat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alunmat_usu` FOREIGN KEY (`alu_id`) REFERENCES `alunos` (`alu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `frequencias`
--
ALTER TABLE `frequencias`
  ADD CONSTRAINT `fk_fre_alu` FOREIGN KEY (`alu_id`) REFERENCES `alunos` (`alu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fre_mat` FOREIGN KEY (`mat_id`) REFERENCES `materias` (`mat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `fk_mat_prof` FOREIGN KEY (`pro_id`) REFERENCES `professores` (`pro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `fk_not_alu` FOREIGN KEY (`alu_id`) REFERENCES `alunos` (`alu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_not_mat` FOREIGN KEY (`mat_id`) REFERENCES `materias` (`mat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
