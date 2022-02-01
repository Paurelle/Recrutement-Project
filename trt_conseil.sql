-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 01 fév. 2022 à 18:43
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `trt_conseil`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrators`
--

CREATE TABLE `administrators` (
  `Id_User` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `administrators`
--

INSERT INTO `administrators` (`Id_User`) VALUES
(3);

-- --------------------------------------------------------

--
-- Structure de la table `announcements`
--

CREATE TABLE `announcements` (
  `Id_Announcement` int(11) NOT NULL,
  `Id_Recruiter` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Company_Name` varchar(255) NOT NULL,
  `Workplace` varchar(255) NOT NULL,
  `Schedule` varchar(255) NOT NULL,
  `Salary` varchar(255) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Is_Checked` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `announcements`
--

INSERT INTO `announcements` (`Id_Announcement`, `Id_Recruiter`, `Title`, `Company_Name`, `Workplace`, `Schedule`, `Salary`, `Description`, `Is_Checked`) VALUES
(1, 12, 'Serveur', 'Au Bon Laboureur', '77480 Bray-sur-Seine', '8h - 19h', '2 020 € - 3 000 € par mois', 'À propos de nous\r\n\r\nAu Bon Laboureur est un restaurant de qualité. Service professionnel et bonne ambiance de travail.\r\n\r\nPassionné par la restauration? N&#39;hésitez pas à rejoindre notre équipe au sein d&#39;un restaurant de qualité!\r\n\r\nType d&#39;emploi : Temps plein, CDI\r\n\r\nSalaire : 2 020,00€ à 3 000,00€ par mois\r\n\r\nHoraires :\r\n\r\nHeures Supplémentaires\r\nRémunération supplémentaire :\r\n\r\nHeures supplémentaires majorées\r\nExpérience:\r\n\r\nRestauration: 1 an (Exigé)\r\nserveur H/F: 1 an (Exigé)\r\nLangue:\r\n\r\nAnglais (Optionnel)\r\nTélétravail:\r\n\r\nNon', b'1');

-- --------------------------------------------------------

--
-- Structure de la table `applied_candidates`
--

CREATE TABLE `applied_candidates` (
  `Id_Candidate` int(11) NOT NULL,
  `Id_Announcement` int(11) NOT NULL,
  `Is_Checked` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `applied_candidates`
--

INSERT INTO `applied_candidates` (`Id_Candidate`, `Id_Announcement`, `Is_Checked`) VALUES
(14, 1, b'1');

-- --------------------------------------------------------

--
-- Structure de la table `candidates`
--

CREATE TABLE `candidates` (
  `Id_User` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `CV_Id` varchar(255) DEFAULT NULL,
  `CV_Name` varchar(255) DEFAULT NULL,
  `Is_Checked` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `candidates`
--

INSERT INTO `candidates` (`Id_User`, `Name`, `Lastname`, `CV_Id`, `CV_Name`, `Is_Checked`) VALUES
(14, 'candidat', 'candidat', '14.pdf', 'ECF-Entrainement-Recrutement-Back.pdf', b'1');

-- --------------------------------------------------------

--
-- Structure de la table `consultants`
--

CREATE TABLE `consultants` (
  `Id_User` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `consultants`
--

INSERT INTO `consultants` (`Id_User`) VALUES
(13);

-- --------------------------------------------------------

--
-- Structure de la table `recruiters`
--

CREATE TABLE `recruiters` (
  `Id_User` int(11) NOT NULL,
  `Company_Name` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Is_Checked` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `recruiters`
--

INSERT INTO `recruiters` (`Id_User`, `Company_Name`, `Address`, `Is_Checked`) VALUES
(12, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `Id_Role` int(11) NOT NULL,
  `Role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`Id_Role`, `Role`) VALUES
(1, 'recruiter'),
(2, 'candidate'),
(3, 'consultant'),
(4, 'administrator');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Id_User` int(11) NOT NULL,
  `Id_Role` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Id_User`, `Id_Role`, `Email`, `Password`) VALUES
(3, 4, 'admin@gmail.com', '$2y$10$EazIhfhGsyFbvhjQsKxhYeWh3RhrLM20lpy1trHbOVmQaezMIc0xC'),
(12, 1, 'recruteur@gmail.com', '$2y$10$7449RMzm1VJIWvH3ODUJ/.9VPVlUF/uXL7sgQAvmbYabXUqiLR3Ea'),
(13, 3, 'consultant@gmail.com', '$2y$10$/zT3aTvCDIfTA9x49lqlVuX/qACQ3b3yqMui.TL4sgN4tKD.c24my'),
(14, 2, 'candidate@gmail.com', '$2y$10$4wm4NBU36oQ4QBudsrgFtOflrS1N5eGaAmwR4DGYZRLfHo4Vpi97W');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`Id_User`);

--
-- Index pour la table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`Id_Announcement`),
  ADD KEY `Id_Recruiter` (`Id_Recruiter`);

--
-- Index pour la table `applied_candidates`
--
ALTER TABLE `applied_candidates`
  ADD PRIMARY KEY (`Id_Candidate`,`Id_Announcement`),
  ADD KEY `Id_Announcement` (`Id_Announcement`);

--
-- Index pour la table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`Id_User`);

--
-- Index pour la table `consultants`
--
ALTER TABLE `consultants`
  ADD PRIMARY KEY (`Id_User`);

--
-- Index pour la table `recruiters`
--
ALTER TABLE `recruiters`
  ADD PRIMARY KEY (`Id_User`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id_Role`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_User`),
  ADD KEY `Id_Role` (`Id_Role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `Id_Announcement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `Id_Role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrators`
--
ALTER TABLE `administrators`
  ADD CONSTRAINT `administrators_ibfk_1` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE;

--
-- Contraintes pour la table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`Id_Recruiter`) REFERENCES `recruiters` (`Id_User`) ON DELETE CASCADE;

--
-- Contraintes pour la table `applied_candidates`
--
ALTER TABLE `applied_candidates`
  ADD CONSTRAINT `applied_candidates_ibfk_1` FOREIGN KEY (`Id_Candidate`) REFERENCES `candidates` (`Id_User`),
  ADD CONSTRAINT `applied_candidates_ibfk_2` FOREIGN KEY (`Id_Announcement`) REFERENCES `announcements` (`Id_Announcement`);

--
-- Contraintes pour la table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE;

--
-- Contraintes pour la table `consultants`
--
ALTER TABLE `consultants`
  ADD CONSTRAINT `consultants_ibfk_1` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE;

--
-- Contraintes pour la table `recruiters`
--
ALTER TABLE `recruiters`
  ADD CONSTRAINT `recruiters_ibfk_1` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Id_Role`) REFERENCES `roles` (`Id_Role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
