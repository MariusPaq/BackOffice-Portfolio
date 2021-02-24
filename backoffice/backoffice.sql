-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 27 jan. 2021 à 09:53
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `backoffice`
--

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `technologies` text NOT NULL,
  `description` text NOT NULL,
  `hide` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `title`, `technologies`, `description`, `hide`) VALUES
(1, 'Explorateur de fichiers', 'PHP - HTML - CSS', 'Un explorateur de fichiers en PHP.', 1),
(2, 'Back-office en PHP / MySQL', 'PHP - MySQL - HTML - CSS', 'Un back-office permettant de créer, d\'afficher, de modifier et de supprimer le contenu d\'une base de données.', 1),
(17, 'test', 'test', ' test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(10, 'borisd22', '$2y$10$/pN7O8IdDVG9lrRB69D6qe2TaCRcoyQY8otfMEW50CH3C3mM9GmHm', 'b.debot@codeur.online'),
(9, 'test1', '$2y$10$L359ItF/PfxAr9lITt9OUeqpjRg68xIem5t4wmh0kyTfYztkJT/0u', 'test1@a'),
(8, 'boris', '$2y$10$m22xfSgarLoQdRzh.NYPPeRhHVytatECfVFwtdk8SAQb7jL8kOJXe', 'b.debot@codeur.online'),
(7, 'bdebot-dev', '$2y$10$WmhESCTwYCbwypG74ux0nuH2vfO33JeLkEFmPoULUXeKWmhL6JHFm', 'b.debot@codeur.online'),
(11, 'coucou', '$2y$10$Kf233raK.nM0ZQOahhR1.ONd/E.V.WLVFEXm0UTFHC23dyWBHeIFC', 'coucou@coucou');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
