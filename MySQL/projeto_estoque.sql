-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Nov-2021 às 04:03
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_estoque`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aux_produtos`
--

CREATE TABLE `aux_produtos` (
  `idProduto` int(11) NOT NULL,
  `nomeProduto` varchar(60) COLLATE utf8_bin NOT NULL,
  `imagemProduto` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `aux_produtos`
--

INSERT INTO `aux_produtos` (`idProduto`, `nomeProduto`, `imagemProduto`) VALUES
(1, 'CAIXA DE SOM RGB', '9dbf334c012d503f16917438e42ac250.jpg'),
(2, 'MOUSEPAD', '733c57b8889325d10e9ae2bd85a61d40.jpg'),
(3, 'TECLADO GAMER RGB', '51592958_1GG.jpg'),
(4, 'MOUSE GAMER', NULL),
(5, 'MONITOR 144HZ', 'monitor-gamer-led-ozone-24-5-full-hd-hdmi-144hz-1ms-ozdsp25fhd_1610377850_g.jpg');

--
-- Acionadores `aux_produtos`
--
DELIMITER $$
CREATE TRIGGER `AFTER_INSERT_ALERTAS_VERIFIC_IMG` AFTER INSERT ON `aux_produtos` FOR EACH ROW BEGIN

     -- Verificando se o produto foi adicionado sem imagem
     IF (NEW.imagemProduto IS NULL) THEN  
        INSERT INTO logs_alertas(acao, dataHora) values (CONCAT('Por favor, adicione uma imagem ao produto: ', NEW.nomeProduto), NOW());   
     END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AFTER_INSERT_ESTOQUE_NEW_PRODUCTS` AFTER INSERT ON `aux_produtos` FOR EACH ROW BEGIN         
    -- Realizar essa ação
	INSERT INTO estoque_produtos(produto, quantidadeAtual) VALUES (NEW.idProduto, 0);   
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AFTER_INSERT_LOGS_NEW_PRODUCTS` AFTER INSERT ON `aux_produtos` FOR EACH ROW BEGIN         
    -- Realizar essa ação
	INSERT INTO logs_produtos(acao, dataHora) values (CONCAT('Um novo produto foi adicionado: ', NEW.nomeProduto), NOW());   
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `controle_produtos`
--

CREATE TABLE `controle_produtos` (
  `idControle` int(11) NOT NULL,
  `acaoControle` int(1) NOT NULL COMMENT '1 = ENTRADA / 2 = SAÍDA',
  `produto` int(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `controle_produtos`
--

INSERT INTO `controle_produtos` (`idControle`, `acaoControle`, `produto`, `quantidade`, `data`) VALUES
(1, 1, 1, 120, '2021-11-20'),
(2, 1, 5, 80, '2021-11-20'),
(3, 1, 4, 240, '2021-11-20'),
(4, 1, 2, 40, '2021-11-20'),
(5, 1, 3, 90, '2021-11-20'),
(6, 2, 1, 33, '2021-11-20'),
(7, 2, 1, 16, '2021-11-20'),
(8, 2, 4, 31, '2021-11-20'),
(9, 2, 3, 35, '0000-00-00'),
(10, 2, 2, 31, '2021-11-20'),
(11, 2, 3, 55, '2021-11-21'),
(12, 2, 5, 76, '2021-11-21');

--
-- Acionadores `controle_produtos`
--
DELIMITER $$
CREATE TRIGGER `AFTER_INSERT_CONTROLE_PRODUTOS_ESTOQUE_LOGS` AFTER INSERT ON `controle_produtos` FOR EACH ROW BEGIN         
    
        -- Recuperando nome do produto da tabela auxiliar
        SELECT nomeProduto INTO @nameProduct FROM aux_produtos WHERE idProduto = NEW.produto;
    
        -- Verificando se foi uma entrada ou saída (1 = ENTRADA / 2 SAÍDA)
        -- Atualizando a quantidade desse produto na tabela "estoque_produtos" 
        -- Enviando ações a tabela "logs_produtos"

        IF (NEW.acaoControle = 1) THEN
             UPDATE estoque_produtos SET quantidadeAtual = quantidadeAtual + NEW.quantidade WHERE produto = NEW.produto;
             INSERT INTO logs_produtos(acao, dataHora) values (CONCAT('Entrada no produto: ', @nameProduct, ' - Quantidade: ' , NEW.quantidade), NOW());   
        ELSE 
             UPDATE estoque_produtos SET quantidadeAtual = quantidadeAtual - NEW.quantidade WHERE produto = NEW.produto;
             INSERT INTO logs_produtos(acao, dataHora) values (CONCAT('Saída no produto: ', @nameProduct, ' - Quantidade: ' , NEW.quantidade), NOW()); 
        END IF;
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque_produtos`
--

CREATE TABLE `estoque_produtos` (
  `idEstoque` int(11) NOT NULL,
  `produto` int(11) DEFAULT NULL,
  `quantidadeAtual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `estoque_produtos`
--

INSERT INTO `estoque_produtos` (`idEstoque`, `produto`, `quantidadeAtual`) VALUES
(1, 1, 71),
(2, 2, 9),
(3, 3, 0),
(4, 4, 209),
(5, 5, 4);

--
-- Acionadores `estoque_produtos`
--
DELIMITER $$
CREATE TRIGGER `AFTER_UPDATE_ESTOQUE_QTD_ALERTAS` AFTER UPDATE ON `estoque_produtos` FOR EACH ROW BEGIN
      
     -- Recuperando nome do produto da tabela auxiliar
     SELECT nomeProduto INTO @nameProduct FROM aux_produtos WHERE idProduto = NEW.produto;
     
     -- Verificando se a quantidade atual for menor que 1, se sim, o produto foi esgotado...
     IF (NEW.quantidadeAtual < 1) THEN  
        INSERT INTO logs_alertas(acao, dataHora) values (CONCAT('O produto: ', @nameProduct , ' foi esgotado!'), NOW());   
     END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs_alertas`
--

CREATE TABLE `logs_alertas` (
  `idAlerta` int(11) NOT NULL,
  `acao` varchar(255) COLLATE utf8_bin NOT NULL,
  `dataHora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `logs_alertas`
--

INSERT INTO `logs_alertas` (`idAlerta`, `acao`, `dataHora`) VALUES
(1, 'Por favor, adicione uma imagem ao produto: MOUSE GAMER', '2021-11-20 23:56:49'),
(2, 'O produto: TECLADO GAMER RGB foi esgotado!', '2021-11-21 00:00:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs_produtos`
--

CREATE TABLE `logs_produtos` (
  `idLog` int(11) NOT NULL,
  `acao` varchar(255) COLLATE utf8_bin NOT NULL,
  `dataHora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `logs_produtos`
--

INSERT INTO `logs_produtos` (`idLog`, `acao`, `dataHora`) VALUES
(1, 'Um novo produto foi adicionado: CAIXA DE SOM RGB', '2021-11-20 23:56:15'),
(2, 'Um novo produto foi adicionado: MOUSEPAD', '2021-11-20 23:56:27'),
(3, 'Um novo produto foi adicionado: TECLADO GAMER RGB', '2021-11-20 23:56:36'),
(4, 'Um novo produto foi adicionado: MOUSE GAMER', '2021-11-20 23:56:49'),
(5, 'Um novo produto foi adicionado: MONITOR 144HZ', '2021-11-20 23:57:03'),
(6, 'Entrada no produto: CAIXA DE SOM RGB - Quantidade: 120', '2021-11-20 23:58:07'),
(7, 'Entrada no produto: MONITOR 144HZ - Quantidade: 80', '2021-11-20 23:58:12'),
(8, 'Entrada no produto: MOUSE GAMER - Quantidade: 240', '2021-11-20 23:58:19'),
(9, 'Entrada no produto: MOUSEPAD - Quantidade: 40', '2021-11-20 23:58:28'),
(10, 'Entrada no produto: TECLADO GAMER RGB - Quantidade: 90', '2021-11-20 23:58:34'),
(11, 'Saída no produto: CAIXA DE SOM RGB - Quantidade: 33', '2021-11-20 23:58:54'),
(12, 'Saída no produto: CAIXA DE SOM RGB - Quantidade: 16', '2021-11-20 23:59:07'),
(13, 'Saída no produto: MOUSE GAMER - Quantidade: 31', '2021-11-20 23:59:14'),
(14, 'Saída no produto: TECLADO GAMER RGB - Quantidade: 35', '2021-11-20 23:59:19'),
(15, 'Saída no produto: MOUSEPAD - Quantidade: 31', '2021-11-20 23:59:49'),
(16, 'Saída no produto: TECLADO GAMER RGB - Quantidade: 55', '2021-11-21 00:00:02'),
(17, 'Saída no produto: MONITOR 144HZ - Quantidade: 76', '2021-11-21 00:00:36');

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `view_estoqueprodutos`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `view_estoqueprodutos` (
`idProduto` int(11)
,`nomeProduto` varchar(60)
,`quantidadeAtual` int(11)
,`imagemProduto` varchar(255)
);

-- --------------------------------------------------------

--
-- Estrutura para vista `view_estoqueprodutos`
--
DROP TABLE IF EXISTS `view_estoqueprodutos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_estoqueprodutos`  AS SELECT `b`.`idProduto` AS `idProduto`, `b`.`nomeProduto` AS `nomeProduto`, `a`.`quantidadeAtual` AS `quantidadeAtual`, `b`.`imagemProduto` AS `imagemProduto` FROM (`estoque_produtos` `a` join `aux_produtos` `b` on(`a`.`produto` = `b`.`idProduto`)) ORDER BY `b`.`nomeProduto` ASC ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aux_produtos`
--
ALTER TABLE `aux_produtos`
  ADD PRIMARY KEY (`idProduto`);

--
-- Índices para tabela `controle_produtos`
--
ALTER TABLE `controle_produtos`
  ADD PRIMARY KEY (`idControle`),
  ADD KEY `produto` (`produto`);

--
-- Índices para tabela `estoque_produtos`
--
ALTER TABLE `estoque_produtos`
  ADD PRIMARY KEY (`idEstoque`),
  ADD KEY `produto` (`produto`);

--
-- Índices para tabela `logs_alertas`
--
ALTER TABLE `logs_alertas`
  ADD PRIMARY KEY (`idAlerta`);

--
-- Índices para tabela `logs_produtos`
--
ALTER TABLE `logs_produtos`
  ADD PRIMARY KEY (`idLog`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aux_produtos`
--
ALTER TABLE `aux_produtos`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `controle_produtos`
--
ALTER TABLE `controle_produtos`
  MODIFY `idControle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `estoque_produtos`
--
ALTER TABLE `estoque_produtos`
  MODIFY `idEstoque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `logs_alertas`
--
ALTER TABLE `logs_alertas`
  MODIFY `idAlerta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `logs_produtos`
--
ALTER TABLE `logs_produtos`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `controle_produtos`
--
ALTER TABLE `controle_produtos`
  ADD CONSTRAINT `controle_produtos_ibfk_1` FOREIGN KEY (`produto`) REFERENCES `aux_produtos` (`idProduto`);

--
-- Limitadores para a tabela `estoque_produtos`
--
ALTER TABLE `estoque_produtos`
  ADD CONSTRAINT `estoque_produtos_ibfk_1` FOREIGN KEY (`produto`) REFERENCES `aux_produtos` (`idProduto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
