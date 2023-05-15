-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 15, 2023 alle 13:34
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easychef`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `chef`
--

CREATE TABLE `chef` (
  `id` int(10) NOT NULL,
  `role` enum('USER','ADMIN') NOT NULL DEFAULT 'USER',
  `name` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `chef`
--

INSERT INTO `chef` (`id`, `role`, `name`, `email`, `password`) VALUES
(1, 'USER', 'topolino', 'topolino@gmail.com', 'ff3b0b79d587d7c2307093c3a41073c21fec14b6dff3ef52879f3408a4251ac6'),
(2, 'USER', 'paperino', 'paperino@gmail.com', 'f106e246ecdab88cb2262780f60079651aeaa6a3c8f5b1e75fc2ab0582cd3f67'),
(3, 'USER', 'minnie', 'minnie@gmail.com', 'bd5cff650821e43fd88ca5f9ade0e8b1987ff0d4288e511c941c7d241887a78e'),
(4, 'USER', 'pluto', 'pluto@gmail.com', 'c48b4df565b0c96f84fedf18f26596ed40aa9f46f11021af7125d34d1d3acffe'),
(6, 'USER', 'paperone', 'paperone@gmail.com', '7ffc5a58010006e3eb81cb986e241e0bd9982b6b50a443301ce87eea87963163'),
(17, 'ADMIN', 'stefano', 'stefano@gmail.com', '05b9115df05a2a467841772eccc969822d884c9e71841050fe9e0893cce7d11b'),
(20, 'USER', 'nonna papera', 'nonna_papera@gmail.com', '33b460d0cd55de87501d08f711355eb39e4d2fe070977af2d409d8aa50897ac3'),
(21, 'USER', 'bruto', 'bruto@gmail.com', 'f29ab044df25324e83fbff9f4b15a07afda136ee5de6e33117b9ea16fb851ce7'),
(22, 'USER', 'pippo', 'pippo@gmail.com', 'a2242ead55c94c3deb7cf2340bfef9d5bcaca22dfe66e646745ee4371c633fc8');

-- --------------------------------------------------------

--
-- Struttura della tabella `cooking_method`
--

CREATE TABLE `cooking_method` (
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cooking_method`
--

INSERT INTO `cooking_method` (`name`) VALUES
('cooker'),
('fryer'),
('grill'),
('no-cooking'),
('oden');

-- --------------------------------------------------------

--
-- Struttura della tabella `ingredient`
--

CREATE TABLE `ingredient` (
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ingredient`
--

INSERT INTO `ingredient` (`name`) VALUES
('carrot'),
('chicken'),
('egg'),
('fish'),
('flour'),
('meat'),
('onion'),
('pepper'),
('pumpkin'),
('salad'),
('zucchini');

-- --------------------------------------------------------

--
-- Struttura della tabella `ingredients_list`
--

CREATE TABLE `ingredients_list` (
  `ingredient` varchar(50) NOT NULL,
  `recipe` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ingredients_list`
--

INSERT INTO `ingredients_list` (`ingredient`, `recipe`) VALUES
('carrot', 15),
('chicken', 22),
('egg', 15),
('egg', 21),
('flour', 20),
('flour', 21),
('onion', 15),
('onion', 17),
('onion', 20),
('pumpkin', 15),
('salad', 22);

-- --------------------------------------------------------

--
-- Struttura della tabella `likes`
--

CREATE TABLE `likes` (
  `recipe` int(10) NOT NULL,
  `chef` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `likes`
--

INSERT INTO `likes` (`recipe`, `chef`) VALUES
(15, 3),
(15, 17),
(17, 1),
(17, 17),
(20, 17),
(22, 17);

-- --------------------------------------------------------

--
-- Struttura della tabella `recipe`
--

CREATE TABLE `recipe` (
  `id` int(10) NOT NULL,
  `chef_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `procedure` text NOT NULL,
  `category` varchar(10) NOT NULL,
  `cooking_method` varchar(50) NOT NULL,
  `portions` int(5) NOT NULL,
  `cooking_time` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `recipe`
--

INSERT INTO `recipe` (`id`, `chef_id`, `title`, `procedure`, `category`, `cooking_method`, `portions`, `cooking_time`) VALUES
(15, 1, 'Prova', 'Prova<br>Prova<br>Prova<br>Prova<br>Prova<br>Prova<br>ProvaProva', 'pasta', 'cooker', 1, 20),
(17, 3, 'Trofie al pesto', 'Prova 1<br>Prova 2<br>...<br>...<br>...<br>...<br>Prova ...', 'pasta', 'cooker', 1, 20),
(20, 3, 'Pizza', 'Test<br>test<br>test<br>....', 'other', 'cooker', 1, 60),
(21, 1, 'Torta al cioccolato', 'Prova...ProvaProva', 'dessert', 'no-cooking', 1, 20),
(22, 2, 'Insalata di Pollo', '1. Test...2. Test.........3. Test.', 'other', 'grill', 3, 20);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `chef`
--
ALTER TABLE `chef`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `cooking_method`
--
ALTER TABLE `cooking_method`
  ADD PRIMARY KEY (`name`);

--
-- Indici per le tabelle `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`name`);

--
-- Indici per le tabelle `ingredients_list`
--
ALTER TABLE `ingredients_list`
  ADD PRIMARY KEY (`ingredient`,`recipe`),
  ADD KEY `recipe_FK_lists` (`recipe`);

--
-- Indici per le tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`recipe`,`chef`),
  ADD KEY `chef_id_FK_likes` (`chef`);

--
-- Indici per le tabelle `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cooking_method_FK` (`cooking_method`),
  ADD KEY `chef_id_FK_recipe` (`chef_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `chef`
--
ALTER TABLE `chef`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT per la tabella `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ingredients_list`
--
ALTER TABLE `ingredients_list`
  ADD CONSTRAINT `ingredient_FK_lists` FOREIGN KEY (`ingredient`) REFERENCES `ingredient` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recipe_FK_lists` FOREIGN KEY (`recipe`) REFERENCES `recipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `chef_id_FK_likes` FOREIGN KEY (`chef`) REFERENCES `chef` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recipe_FK` FOREIGN KEY (`recipe`) REFERENCES `recipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `chef_id_FK_recipe` FOREIGN KEY (`chef_id`) REFERENCES `chef` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cooking_method_FK` FOREIGN KEY (`cooking_method`) REFERENCES `cooking_method` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
