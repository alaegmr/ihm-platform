-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 22 déc. 2023 à 04:18
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ihm`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id_cours` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_cours`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

DROP TABLE IF EXISTS `enseignants`;
CREATE TABLE IF NOT EXISTS `enseignants` (
  `id_ens` int NOT NULL AUTO_INCREMENT,
  `nom_ens` varchar(255) NOT NULL,
  `prenom_ens` varchar(200) NOT NULL,
  `username_ens` varchar(100) NOT NULL,
  `password1` varchar(200) DEFAULT NULL,
  `email_ens` varchar(200) NOT NULL,
  `categorie_ens` varchar(100) NOT NULL,
  `password2` varchar(255) DEFAULT NULL,
  `diplome_ens` varchar(500) DEFAULT NULL,
  `id_module` int DEFAULT NULL,
  PRIMARY KEY (`id_ens`),
  KEY `fk_enseignants_modules` (`id_module`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enseignants`
--

INSERT INTO `enseignants` (`id_ens`, `nom_ens`, `prenom_ens`, `username_ens`, `password1`, `email_ens`, `categorie_ens`, `password2`, `diplome_ens`, `id_module`) VALUES
(10, 'GUERROUDJI', 'fatiha', 'fatiha', 'fatiha', 'fatiha@gmail.com', 'cours', 'fatiha', 'Doctorat en GUI', NULL),
(14, 'BAGHDADI', 'Leila', 'leila', 'leila', 'leila@gmail.com', 'td', 'leila', 'Intelligence Artificielle (IA) et Apprentissage Automatique (ML)', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id_etud` int NOT NULL AUTO_INCREMENT,
  `nom_etud` varchar(200) NOT NULL,
  `prenom_etud` varchar(200) NOT NULL,
  `username_etud` varchar(200) NOT NULL,
  `password1` varchar(255) DEFAULT NULL,
  `email_etud` varchar(200) NOT NULL,
  `niveau_etud` varchar(100) NOT NULL,
  `password2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_etud`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id_etud`, `nom_etud`, `prenom_etud`, `username_etud`, `password1`, `email_etud`, `niveau_etud`, `password2`) VALUES
(19, 'GHOMARI', 'Alae', 'alaegmr98', 'alae', 'alaegmr98@gmail.com', 'L3', 'alae'),
(20, 'GHOMARI', 'anfel', 'anfel2010', 'anfel', 'anfel@gmail.com', 'L3', 'anfel'),
(21, 'GHOMARI', 'iheb', 'iheb', 'iheb', 'iheb@gmail.com', 'L3', 'iheb'),
(23, 'TALEB', 'amina', 'amina', 'amina', 'amine@gmail.com', 'L3', 'amina');

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id_module` int NOT NULL,
  `nom_module` varchar(255) DEFAULT NULL,
  `description_module` text,
  PRIMARY KEY (`id_module`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id_quest` int NOT NULL AUTO_INCREMENT,
  `contenu_quest` varchar(500) NOT NULL,
  `id_etud` int DEFAULT NULL,
  PRIMARY KEY (`id_quest`),
  KEY `fk_questionss_etudiants` (`id_etud`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id_quest`, `contenu_quest`, `id_etud`) VALUES
(76, 'Salem Alaykoum on demande la date des tests IHM tp et td . \r\nMerci Cordialement .', 19),
(77, 'SVP on veut laffichage des notes examens IHM S5 . \r\nMerci Cordialement.', 20);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
CREATE TABLE IF NOT EXISTS `reponses` (
  `id_rep` int NOT NULL AUTO_INCREMENT,
  `contenu_rep` varchar(500) NOT NULL,
  `id_ens` int DEFAULT NULL,
  `id_quest` int DEFAULT NULL,
  PRIMARY KEY (`id_rep`),
  KEY `fk_reponses_enseignants` (`id_ens`),
  KEY `fk_reponses_questions` (`id_quest`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id_rep`, `contenu_rep`, `id_ens`, `id_quest`) VALUES
(61, 'Elle sera affichee demain inchallah . \r\nBon Courage.', 10, 76);

-- --------------------------------------------------------

--
-- Structure de la table `tds`
--

DROP TABLE IF EXISTS `tds`;
CREATE TABLE IF NOT EXISTS `tds` (
  `id_td` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_td`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tps`
--

DROP TABLE IF EXISTS `tps`;
CREATE TABLE IF NOT EXISTS `tps` (
  `id_tp` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_tp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enseignants`
--
ALTER TABLE `enseignants`
  ADD CONSTRAINT `fk_enseignants_modules` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id_module`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questionss_etudiants` FOREIGN KEY (`id_etud`) REFERENCES `etudiants` (`id_etud`);

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `fk_reponses_enseignants` FOREIGN KEY (`id_ens`) REFERENCES `enseignants` (`id_ens`),
  ADD CONSTRAINT `fk_reponses_questions` FOREIGN KEY (`id_quest`) REFERENCES `questions` (`id_quest`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
