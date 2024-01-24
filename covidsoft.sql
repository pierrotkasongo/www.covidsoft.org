-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 09 nov. 2021 à 13:08
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `covidsoft`
--

-- --------------------------------------------------------

--
-- Structure de la table `discussion`
--

CREATE TABLE `discussion` (
  `id` int(11) NOT NULL,
  `auteur` int(11) NOT NULL,
  `destinataire` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `discussion`
--

INSERT INTO `discussion` (`id`, `auteur`, `destinataire`, `message`) VALUES
(25, 1, 3, 'bonsoir madame'),
(26, 1, 2, 'bonjour kabi ça  va ?'),
(27, 2, 1, 'oui je vais bien admin et toi ?'),
(28, 1, 2, 'tout va bien'),
(29, 2, 1, 'ok merci ❤'),
(30, 2, 1, 'by'),
(31, 1, 2, 'ok'),
(32, 1, 2, 'bonsoir'),
(33, 1, 2, '❣'),
(34, 2, 1, 'bonjour anordl'),
(35, 1, 2, 'bonjour mundele'),
(36, 2, 1, 'bonjour admin ça  va ?'),
(37, 4, 1, 'bonjour admin tu sais  je t\'aime 💜'),
(38, 1, 4, 'oui cheri ❣'),
(39, 2, 1, '❤'),
(40, 2, 1, '🤝'),
(41, 2, 1, 'jajajjaja'),
(42, 1, 2, 'bonjour 🤝'),
(43, 2, 1, 'bonjour admin ça va ?'),
(44, 1, 2, 'je vaias bien merci!'),
(45, 2, 1, 'ok bonne journée  ❤'),
(46, 1, 2, 'ok'),
(47, 1, 9, 'Bonjour 🤝'),
(48, 9, 1, 'bonjour admin j\'ai reçu votre courrier ✉'),
(49, 9, 1, 'ok merci d\'avoir accepter de travailler dans mon  écupe'),
(50, 1, 9, 'ok merci');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `postnom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `sexe` varchar(50) NOT NULL,
  `datenaiss` date NOT NULL,
  `lieunaiss` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `commune` varchar(50) NOT NULL,
  `quartier` varchar(50) NOT NULL,
  `avenue` varchar(50) NOT NULL,
  `domicile` varchar(10) NOT NULL,
  `nationalite` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `situation` varchar(50) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `resultat` varchar(50) NOT NULL,
  `hopital` varchar(50) DEFAULT NULL,
  `dateenreg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `nom`, `postnom`, `prenom`, `age`, `sexe`, `datenaiss`, `lieunaiss`, `ville`, `commune`, `quartier`, `avenue`, `domicile`, `nationalite`, `mail`, `telephone`, `photo`, `situation`, `categorie`, `resultat`, `hopital`, `dateenreg`) VALUES
(4, 'fatuma', 'mandundu', 'sarah', '23', 'masculin', '2021-10-14', 'kinshasa', 'kinshasa', 'matete', 'lubila', 'mukusa', '12', 'congolaise', 'mandundu@gmail.com', '0998934123', 'mandundu@gmail.com.png', 'marié', 'civile', 'guérie', 'monkole', '2021-10-16 14:04:29'),
(5, 'olinda', 'bokoto', 'judith', '23', 'feminin', '2021-10-12', 'kinshasa', 'kinshasa', 'mont-ngafula', 'montaka', 'mulili', '23', 'congolaise', 'bokoto@gmail.com', '0998734123', 'bokoto@gmail.com.png', 'célibataire', 'civile', 'suspecte', 'monkole', '2021-10-16 14:05:45'),
(8, 'kuzanuka', 'panzu', 'christ', '23', 'masculin', '2021-10-20', 'kinshasa', 'kinshasa', 'kitambo', 'lubila', 'mudiata', '34', 'congolaise', 'panzu@gmail.com', '0998945123', 'panzu@gmail.com.png', 'célibataire', 'civile', 'positive', 'ngaliema', '2021-10-17 01:11:35'),
(10, 'boya', 'basele', 'juliana', '21', 'feminin', '1998-10-28', 'kinshasa', 'kinshasa', 'kingasani', 'mokali', 'mweni', '28', 'congolaise', 'basele@gmail.com', '0821234781', 'basele@gmail.com.png', 'célibataire', 'civile', 'positive', 'monkole', '2021-10-17 01:17:58'),
(11, 'mantobo', 'mulala', 'sarah', '23', 'feminin', '1999-10-13', 'kinshasa', 'kinshasa', 'kinshasa ', 'lualaba', 'malala', '34', 'congolaise', 'mulala@gmail.com', '0893412345', 'mulala@gmail.com.png', 'célibataire', 'civile', 'décédée', 'monkole', '2021-10-17 01:21:50'),
(12, 'kisudiku', 'lubama', 'elie', '23', 'feminin', '1998-11-24', 'kinshasa', 'kinshasa', 'masina', 'nfumu-nsuka', 'mungwa', '90', 'congolaise', 'lubama@gmail.com', '0997834123', 'lubama@gmail.com.png', 'célibataire', 'civile', 'suspecte', 'monkole', '2021-10-17 01:25:44'),
(13, 'oku', 'dueme', 'manasse', '26', 'masculin', '2021-10-28', 'kinshasa', 'kinshasa', 'masina', 'nfumu-nsuka', 'mungwa', '15', 'congolaise', 'manasseoku@gmail.com', '0819814207', 'manasseoku@gmail.com.png', 'célibataire', 'civile', 'positive', 'ngaliema', '2021-10-18 15:25:01'),
(14, 'oku', 'pambani', 'manasse', '28', 'masculin', '1991-11-10', 'kinshasa ', 'kinshasa ', 'masina', 'nfuma-nsuka', 'mungwa', '28', 'congolaise', 'biduase@gmail.com', '099893462', 'biduase@gmail.com.png', 'célibataire', 'civile', 'positive', 'monkole', '2021-11-07 17:49:44'),
(15, 'elie', 'elie', 'elie', '34', 'masculin', '2021-11-03', 'elie', 'elie', 'elie', 'elie', 'elie', '42', 'elie', 'elie@gmail.com', '099783432', 'elie@gmail.com.png', 'marié', 'militaire', 'positive', 'saint joseph', '2021-11-07 17:57:44'),
(16, 'bernice', 'bernice', 'bernice', '12', 'feminin', '2021-11-24', 'bernice', 'bernice', 'bernice', 'bernice', 'bernice', '24', 'bernice', 'bernice@gmail.com', '0998734287', 'bernice@gmail.com.png', 'célibataire', 'civile', 'décédée', 'don de dieu ', '2021-11-07 17:59:12');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `postnom` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `service` varchar(50) NOT NULL,
  `hopital` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `postnom`, `password`, `mail`, `service`, `hopital`, `photo`, `telephone`, `date`) VALUES
(1, 'muyembe', 'tanfum', 'jean12', 'jean@gmail.com', 'administration', 'Direction générale', 'jean@gmail.com.jpg', '0829283883', '2021-10-14 10:53:15'),
(2, 'mundele', 'kabi', 'kabi12', 'mundele@gmail.com', 'utilisateur', 'monkole', 'mundele@gmail.com.jpg', '0998734123', '2021-10-16 13:55:52'),
(3, 'angela', 'musina', 'musina12', 'musina@gmail.com', 'utilisateur', 'saint joseph', 'musina@gmail.com.jpg', '0993412345', '2021-10-16 13:56:42');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `telephone` (`telephone`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `telephone` (`telephone`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
