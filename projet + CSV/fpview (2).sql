-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 26 avr. 2023 à 08:21
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fpview`
--

-- --------------------------------------------------------

--
-- Structure de la table `action`
--

DROP TABLE IF EXISTS `action`;
CREATE TABLE IF NOT EXISTS `action` (
  `id` int NOT NULL AUTO_INCREMENT,
  `map_id` int NOT NULL,
  `action` varchar(100) NOT NULL,
  `item_id` int NOT NULL,
  `requis` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `action`
--

INSERT INTO `action` (`id`, `map_id`, `action`, `item_id`, `requis`, `status`) VALUES
(1, 3, 'use', 1, 1, 0),
(2, 14, 'take', 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int DEFAULT NULL,
  `map_id` int DEFAULT NULL,
  `path` varchar(11) DEFAULT NULL,
  `status_action` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `map_id`, `path`, `status_action`) VALUES
(3, 1, '01-0.jpg', 0),
(4, 2, '01-90.jpg', 0),
(5, 3, '01-180.jpg', 0),
(6, 4, '01-270.jpg', 0),
(7, 5, '11-0.jpg', 0),
(8, 6, '11-90.jpg', 0),
(9, 7, '11-180.jpg', 0),
(10, 8, '11-270.jpg', 0),
(11, 9, '10-0.jpg', 0),
(12, 10, '10-90.jpg', 0),
(13, 11, '10-180.jpg', 0),
(14, 12, '10-270.jpg', 0),
(15, 13, '12-0.jpg', 0),
(16, 14, '12-90.jpg', 0),
(17, 15, '12-180.jpg', 0),
(18, 16, '12-270.jpg', 0),
(19, 14, '12-90-1.jpg', 1),
(20, 3, '01-180.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `description`) VALUES
(1, 'une clé dorée');

-- --------------------------------------------------------

--
-- Structure de la table `map`
--

DROP TABLE IF EXISTS `map`;
CREATE TABLE IF NOT EXISTS `map` (
  `id` int DEFAULT NULL,
  `coordx` int DEFAULT NULL,
  `coordy` int DEFAULT NULL,
  `direction` int DEFAULT NULL,
  `status_action` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `map`
--

INSERT INTO `map` (`id`, `coordx`, `coordy`, `direction`, `status_action`) VALUES
(1, 0, 1, 0, 0),
(2, 0, 1, 90, 0),
(3, 0, 1, 180, 1),
(4, 0, 1, 270, 0),
(5, 1, 1, 0, 0),
(6, 1, 1, 90, 0),
(7, 1, 1, 180, 0),
(8, 1, 1, 270, 0),
(9, 1, 0, 0, 0),
(10, 1, 0, 90, 0),
(11, 1, 0, 180, 0),
(12, 1, 0, 270, 0),
(13, 1, 2, 0, 0),
(14, 1, 2, 90, 1),
(15, 1, 2, 180, 0),
(16, 1, 2, 270, 0);

-- --------------------------------------------------------

--
-- Structure de la table `text`
--

DROP TABLE IF EXISTS `text`;
CREATE TABLE IF NOT EXISTS `text` (
  `id` int DEFAULT NULL,
  `map_id` int DEFAULT NULL,
  `text` varchar(864) DEFAULT NULL,
  `status_action` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `text`
--

INSERT INTO `text` (`id`, `map_id`, `text`, `status_action`) VALUES
(1, 1, 'Je dois trouver une clé pour sortir d\'ici...', 0),
(2, 2, 'Un mur m\'empêche de passer...', 0),
(3, 3, 'Je dois trouver une clé pour sortir d\'ici...', 0),
(7, 9, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', 0),
(6, 4, 'Rien par ici', 0),
(11, 14, 'Voici un bien joli vase !', 0),
(8, 10, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', 0),
(9, 11, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', 0),
(10, 12, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', 0),
(12, 14, 'Tu récupères le vase et la clé dorée qui se trouve à l\'intérieur !', 1),
(13, 3, 'Gagné !!', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
