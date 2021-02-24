-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 24 fév. 2021 à 11:14
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `completion_period` varchar(255) DEFAULT NULL,
  `technologies` varchar(255) DEFAULT NULL,
  `description` varchar(2000) NOT NULL,
  `hide` varchar(255) NOT NULL DEFAULT 'hide',
  `thumbnail` varchar(255) DEFAULT NULL,
  `project_link` varchar(2000) DEFAULT NULL,
  `github_link` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `title`, `completion_period`, `technologies`, `description`, `hide`, `thumbnail`, `project_link`, `github_link`) VALUES
('BigBlueButton6033a7813d910', 'BigBlueButton', '04/11/2020-08/01-2021', 'SSH,Ubuntu', ' Initialisation d\'un serveur OVH avec Ubuntu 16.04 et installation d\'une plateforme de visioconfÃ©rence \'BigBlueButton\' pour l\'entreprise Bien-EncrÃ© sur le dit serveur.\r\nProjet rÃ©aliser en groupe de quatre pour le stage de la formation Ã  ONLINEFORMATPRO dans l\'entreprise \'Bien-EncrÃ©\' avec Adeline Levionnois, Tsiry Trafanoharantsoa et Dimitri Hoerth.', 'hide', 'https://mariusp.promo-42.codeur.online/PortMP/img/BBB1.PNG', 'https://bien-tourner.fr/b', '#'),
('Design Explorateur Fichiers6033a7dfcd433', 'Design Explorateur Fichiers', '08/2020', 'AdobeXD', ' CrÃ©ation de maquette pour un explorateur de fichiers interactive avec Adobe XD.\r\nPremier projet et dÃ©couverte du logiciel Adobe XD.', 'hide', 'https://mariusp.promo-42.codeur.online/PortMP/img/Explo.jpeg', '#', '#'),
('Flappy Bird6033a6f0762aa', 'Flappy Bird', '07/2020', 'JS HTML/CSS ', ' CrÃ©ation dâ€™un jeu Flappy Bird en native JavaScript en duo avec Julie Boulenger. \r\nPremier Projet en groupe effectuer Ã  ONLINEFORMATPRO sur le langage JS.', 'hide', 'https://mariusp.promo-42.codeur.online/PortMP/img/FB1.jpg', 'https://mariusp.promo-42.codeur.online/flappyBirds/', 'https://github.com/MariusPaq/Flappy_Bird_JS'),
('Projet Wordpress6033a67647465', 'Projet Wordpress', '05/10/2020-20/10/2020', 'HTML/CSS PHP JS', ' DÃ©veloppement d\'un outil de communication sur Wordpress ayant vocation Ã  sensibiliser sur l\'importance de l\'Ã©galitÃ© femmes / hommes en contexte professionnel, en abordant le problÃ¨me sous diffÃ©rents angles.\r\nProjet rÃ©aliser en groupe de trois avec Adeline Levionnois et Louis Meunier sur une durÃ©e d\'une semaine, crÃ©ation dâ€™une maquette ainsi quâ€™un cahier des charges et ensuite un dÃ©veloppement en local puis une mise en ligne du site.', 'hide', 'https://mariusp.promo-42.codeur.online/PortMP/img/WPE1.PNG', 'https://mariusp.promo-42.codeur.online/wordpressEgalite/', 'https://github.com/MariusPaq/themesWordPressOnePage'),
('ProjetDemo602ce5e64f77f', 'ProjetDemoModif', '16/02/2021', 'none', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas molestie, dui quis faucibus malesuada, erat mauris eleifend orci, placerat vulputate tellus felis non ipsum. Nunc non justo varius, tempor lacus vulputate, tincidunt ex. Donec neque leo, maximus in sollicitudin quis, rhoncus malesuada purus. Vestibulum at euismod massa. Maecenas posuere maximus sapien. Integer semper id justo eget ornare. Nulla eu dui dictum, semper leo eget, maximus purus. In imperdiet a nisl eu imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vivamus sagittis tortor leo, in maximus sem scelerisque ut. Donec placerat, lacus vitae volutpat ultricies, est lorem interdum eros, eu rutrum dolor quam eget erat. Fusce leo erat, porta in dolor ut, aliquam congue turpis. Suspendisse nec consequat ante, et consequat quam. Morbi non arcu tincidunt, laoreet lacus ut, pharetra nunc. Praesent molestie tincidunt ante, id mollis tellus luctus et.', 'hide', 'https://www.lavideopourleweb.com/wp-content/uploads/2015/01/Faire-une-vid%C3%A9o-de-d%C3%A9monstration-dun-produit-ou-service.jpg', 'https://www.google.fr/', 'https://github.com/');

-- --------------------------------------------------------

--
-- Structure de la table `projects_tags`
--

DROP TABLE IF EXISTS `projects_tags`;
CREATE TABLE IF NOT EXISTS `projects_tags` (
  `project_id` varchar(255) NOT NULL,
  `tag_id` varchar(255) NOT NULL,
  KEY `project_id` (`project_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projects_tags`
--

INSERT INTO `projects_tags` (`project_id`, `tag_id`) VALUES
('ProjetDemo602ce5e64f77f', 'demo602ce99721a31'),
('ProjetDemo602ce5e64f77f', 'test602ce9975600b'),
('ProjetDemo602ce5e64f77f', 'modif602ce9976ccc7'),
('Projet Wordpress6033a67647465', 'wordpress6033a9ac06d71'),
('Projet Wordpress6033a67647465', 'CMS6033a9ac37408'),
('Flappy Bird6033a6f0762aa', 'Game6033a9c678f54'),
('Flappy Bird6033a6f0762aa', 'JS6033a9c693114'),
('BigBlueButton6033a7813d910', 'live6033a9de85d44'),
('BigBlueButton6033a7813d910', 'serveur6033a9de9734b'),
('BigBlueButton6033a7813d910', 'OVH6033a9dea8ad7'),
('BigBlueButton6033a7813d910', 'Ubuntu6033a9deba1f2'),
('Design Explorateur Fichiers6033a7dfcd433', 'design6033aa37a35c2'),
('Design Explorateur Fichiers6033a7dfcd433', 'maquettage 6033aa37d23e7');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` varchar(255) NOT NULL,
  `tag_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id`, `tag_name`) VALUES
('CMS6033a9ac37408', 'CMS'),
('demo602ce99721a31', 'demo'),
('design6033aa37a35c2', 'design'),
('Game6033a9c678f54', 'Game'),
('JS6033a9c693114', 'JS'),
('live6033a9de85d44', 'live'),
('maquettage 6033aa37d23e7', 'maquettage '),
('modif602ce9976ccc7', 'modif'),
('OVH6033a9dea8ad7', 'OVH'),
('serveur6033a9de9734b', 'serveur'),
('test602ce9975600b', 'test'),
('Ubuntu6033a9deba1f2', 'Ubuntu'),
('wordpress6033a9ac06d71', 'wordpress');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'visitor',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'root', 'marius.paquet@gmail.com', 'root', 'visitor');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `projects_tags`
--
ALTER TABLE `projects_tags`
  ADD CONSTRAINT `projects_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_tags_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
