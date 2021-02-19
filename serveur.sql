-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 19 fév. 2021 à 09:27
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `application`
--
CREATE DATABASE IF NOT EXISTS `application` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `application`;

-- --------------------------------------------------------

--
-- Structure de la table `ban`
--

DROP TABLE IF EXISTS `ban`;
CREATE TABLE IF NOT EXISTS `ban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pseudo` varchar(255) NOT NULL,
  `tchat` int(20) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pseudo` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `tchat` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`id`, `date`, `pseudo`, `message`, `tchat`) VALUES
(21, '2021-02-15 14:48:48', 'test', 'test', 1),
(17, '2021-02-15 14:19:42', 'test', 'test', 1),
(20, '2021-02-15 14:48:47', 'test', 'test', 1),
(22, '2021-02-15 14:55:46', 'elyo', 'test message cc !!', 0),
(23, '2021-02-15 15:12:23', 'elyo', 'test message cc !!', 0),
(18, '2021-02-15 14:23:59', 'elyo', 'test message cc !!', 0),
(24, '2021-02-15 15:12:26', 'elyo', 'fdsfghjzqersgdthfjygukhilsdwgfxhjkl', 0),
(25, '2021-02-15 15:18:44', 'test', 'test', 0),
(26, '2021-02-16 08:11:40', 'elyo', 'tchat 0', 0),
(27, '2021-02-16 08:12:31', 'CONSOLE : Nom du tchat = ', 'Tchat 1 test', 0),
(28, '2021-02-16 08:12:43', 'CONSOLE : Nom du tchat = ', 'Tchat 2 test', 1),
(29, '2021-02-16 10:29:53', 'CONSOLE : Nom du tchat = ', 'Tchat de test 68888096', 68888096),
(30, '2021-02-16 11:28:59', 'CONSOLE : Nom du tchat = ', 'test1234', 32647776),
(31, '2021-02-16 11:32:38', 'CONSOLE : Nom du tchat = ', 'Tchat public 1', 0),
(32, '2021-02-16 11:33:08', 'CONSOLE : Nom du tchat = ', 'Tchat public 2', 1),
(33, '2021-02-16 11:45:02', 'CONSOLE : Nom du tchat = ', 'Tchat de l\'op', 96149163),
(34, '2021-02-16 11:45:32', 'CONSOLE : Nom du tchat = ', 'Tchat de l\'op 2', 71399151),
(35, '2021-02-16 14:29:45', 'elyo', 'Travaille plus !!!! ', 0),
(36, '2021-02-16 14:37:21', 'elyo', '(O_O)', 0),
(37, '2021-02-16 14:37:25', 'elyo', '(O_O)', 0),
(38, '2021-02-16 14:37:28', 'elyo', '(O_O)', 0),
(39, '2021-02-16 14:37:36', 'elyo', '(O_O)', 0),
(40, '2021-02-16 14:37:38', 'elyo', '(O_O)', 0),
(41, '2021-02-16 14:44:09', 'elyo', 'test message cc !!', 0),
(42, '2021-02-16 17:58:45', 'Lucas', 'Yo', 42572129),
(43, '2021-02-17 06:45:32', 'Lucas', 'C\'est pas sérieux tout ça ', 0),
(44, '2021-02-17 09:48:51', 'elyo', 'test', 0),
(45, '2021-02-17 09:55:36', 'elyo', 'd\'où tu parle tous seul', 42572129),
(46, '2021-02-17 15:39:02', 'elyo', 'Lucas je vais te ban', 0),
(48, '2021-02-17 17:16:56', 'Aventure', 'Facile', 0),
(49, '2021-02-18 15:31:35', 'elyo', 'Tu es qui Aventure', 0);

-- --------------------------------------------------------

--
-- Structure de la table `connecter`
--

DROP TABLE IF EXISTS `connecter`;
CREATE TABLE IF NOT EXISTS `connecter` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pseudo` varchar(255) NOT NULL,
  `tchat` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `niveau1op`
--

DROP TABLE IF EXISTS `niveau1op`;
CREATE TABLE IF NOT EXISTS `niveau1op` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tchat` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pseudo` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `niveau1op`
--

INSERT INTO `niveau1op` (`id`, `tchat`, `date`, `pseudo`) VALUES
(1, 68888096, '2021-02-16 09:45:37', 'test'),
(20, 1, '2021-02-16 11:59:46', 'elyo'),
(25, 0, '2021-02-19 08:16:26', 'elyo'),
(18, 71399151, '2021-02-16 11:45:12', 'elyo'),
(17, 96149163, '2021-02-16 11:44:45', 'elyo'),
(21, 42572129, '2021-02-16 17:58:40', 'Lucas'),
(22, 63062744, '2021-02-17 06:16:07', 'Seb la frite'),
(23, 42283257, '2021-02-17 17:31:52', 'Aventure'),
(26, 749027364, '2021-02-19 08:55:17', 'elyo');

-- --------------------------------------------------------

--
-- Structure de la table `nomchat`
--

DROP TABLE IF EXISTS `nomchat`;
CREATE TABLE IF NOT EXISTS `nomchat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `tchat` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `nomchat`
--

INSERT INTO `nomchat` (`id`, `date`, `name`, `tchat`) VALUES
(1, '2021-02-15 10:57:25', 'Tchat', 0),
(2, '2021-02-15 10:58:23', 'Tchat1234', 0),
(3, '2021-02-15 13:02:02', 'Tchat test', 0),
(4, '2021-02-15 13:02:05', 'Tchat test', 0),
(5, '2021-02-15 13:03:58', 'Tchat', 0),
(6, '2021-02-15 13:04:12', 'Tchat1234', 0),
(7, '2021-02-15 13:04:16', 'Tchat1234', 0),
(8, '2021-02-15 13:04:17', 'Tchat1234', 0),
(9, '2021-02-15 13:04:17', 'Tchat1234', 0),
(10, '2021-02-15 13:04:18', 'Tchat1234', 0),
(11, '2021-02-15 13:04:18', 'Tchat1234', 0),
(12, '2021-02-15 13:04:19', 'Tchat1234', 0),
(13, '2021-02-15 13:04:19', 'Tchat1234', 0),
(14, '2021-02-15 13:04:19', 'Tchat1234', 0),
(15, '2021-02-15 13:04:19', 'Tchat1234', 0),
(16, '2021-02-15 13:04:22', 'Tchat1234', 0),
(17, '2021-02-15 13:04:22', 'Tchat1234', 0),
(18, '2021-02-15 13:04:22', 'Tchat1234', 0),
(19, '2021-02-15 13:04:22', 'Tchat1234', 0),
(20, '2021-02-15 13:04:23', 'Tchat', 0),
(21, '2021-02-15 13:06:51', 'Tchat 2', 1),
(22, '2021-02-16 08:12:31', 'Tchat 1 test', 0),
(23, '2021-02-16 08:12:43', 'Tchat 2 test', 1),
(24, '2021-02-16 10:29:53', 'Tchat de test 68888096', 68888096),
(25, '2021-02-16 11:28:59', 'test1234', 32647776),
(26, '2021-02-16 11:32:38', 'Tchat public 1', 0),
(27, '2021-02-16 11:33:08', 'Tchat public 2', 1),
(28, '2021-02-16 11:45:02', 'Tchat de l\'op', 96149163),
(29, '2021-02-16 11:45:32', 'Tchat de l\'op 2', 71399151);

-- --------------------------------------------------------

--
-- Structure de la table `op`
--

DROP TABLE IF EXISTS `op`;
CREATE TABLE IF NOT EXISTS `op` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pseudo` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `op`
--

INSERT INTO `op` (`id`, `date`, `pseudo`) VALUES
(6, '2021-02-08 20:30:19', 'elyo'),
(9, '2021-02-11 17:03:43', 'Lucas');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passe` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `passe`, `date`) VALUES
(1, 'test', 'test@gmail.com', '$2y$12$8yrHV0BSeuvLi02ljBHCeuQWv.t5eVaurCB8xxP8s1MBxDMz9EY4y', '2021-02-04 08:05:11'),
(2, 'elyo', 'elyo.joss@gmail.com', '$2y$12$JcUkLgv0uH5NLTPiyWNh/ezpjC9omaS0ESB7SnfNwe7EsxW90umbK', '2021-02-04 09:57:55'),
(3, 'bbbb', 'elyojo@hotmail.fr', '$2y$12$KRQvkwDBhLrUCtMTinmod.88bC7nPj4nf/2fQMwC6sup/La0sueju', '2021-02-05 15:48:25'),
(4, 'ixokay 4', 'elyo.4@gmail.com', '$2y$12$otbDcsxayhZiwrfheeFP.OEXr4IAy/KNbEUSNIVu9sDWh81.tX52i', '2021-02-05 15:59:39'),
(5, '44rrrrrr', 'houzelle.l@stjoseph-lasalle.fr', '$2y$12$Z7GUXl8x0XFpaEJ6eWO/NOxxgrnw4jH.xXY7XvReovc.kfxyqKFmC', '2021-02-08 20:08:08'),
(6, 'Lucas', 'Zebi@gmail.com', '$2y$12$3Cs7EEPRyOwNa3EraLLmk.EO1oh4/3G2YSrnKHv/Jq2daLvE1rDdS', '2021-02-08 20:08:48'),
(7, 'Elyman', 'elyman@hotmail.fr', '$2y$12$6OXpZcnyIiCHpXkgdv2oHOo/YQ1gqKnBsErB/Gl5yS10eNTnuezcS', '2021-02-08 20:38:35'),
(8, 'Seb la frite', 'launay72140@hotmail.fr', '$2y$12$.Lom8bSo2g5p9.Pd2HoA8u8HkFGhw01hxdWi4vYXbG6vTlVW3bsXm', '2021-02-09 16:24:10'),
(9, 'JNG72210', 'gelebart.j@stjoseph-lasalle.fr', '$2y$12$uR5VSUVyuSrmQsStFYIb1.ahHJJmOaSeF/xN24yv.efamnPlDMybS', '2021-02-09 19:30:41'),
(12, 'Flavi', 'Jspquoi@orange.fr', '$2y$12$qmDkgrN57qJ5fRkUVUMFu.kTZClBqZJQC2oUWpxhaGhWE/Lj2k//W', '2021-02-11 16:46:40'),
(13, 'SIRrodrick', 'sirleroileplusvaillant.rodrick@wanadoo.fr', '$2y$12$cD6BWGMq307Aqo.7elYys.zC5eHgs0u47PEj7Ub4fcDyjKe6lo2jC', '2021-02-11 16:51:16'),
(14, 'Florian ', 'buzance.f@stjoseph-lasalle.fr', '$2y$12$/1pL5/onKYA8TNOKMy6Cfeoep.bwuCp.19XTFXIE5c0dfnPG207mq', '2021-02-11 16:59:12'),
(15, 'Natyk', 'n.gauteron@stjoseph-lasalle.fr', '$2y$12$E63afv4rf82BUFaVEub.DO/DW/rBIxLZQTX8yJ6g0p3067n4Igydq', '2021-02-11 17:58:23'),
(16, 'Manoë', 'manoe722@gmail.com', '$2y$12$oZ1nQ5R3kUM3P...tjirg.WpD89tSOl3m0mHuz2OK.YKu4wuJi6xq', '2021-02-12 21:06:34'),
(17, 'Clement', 'test@test.fr', '$2y$12$0dWG2kTFz178L55coU9F7edClFcgBeysMQnDvaVXh9qxCzE.aA.qa', '2021-02-15 09:27:16'),
(18, 'Aventure', 'azetassoboppi-63047245@yopmail.com', '$2y$12$s9N.opV0EWpt6XYkQhUiDO7baYF7rtgtJUJy5MmPKWUAA1j.FxJwG', '2021-02-17 17:16:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
