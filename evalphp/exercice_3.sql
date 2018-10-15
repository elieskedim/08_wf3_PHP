-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 15 oct. 2018 à 12:24
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `exercice_3`
--

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id_film` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `actors` varchar(100) NOT NULL,
  `director` varchar(100) NOT NULL,
  `producer` varchar(100) NOT NULL,
  `year_of_prod` year(4) NOT NULL,
  `language` varchar(100) NOT NULL,
  `category` enum('fantastique','comedie','animation','romantique') NOT NULL,
  `storyline` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id_film`, `title`, `actors`, `director`, `producer`, `year_of_prod`, `language`, `category`, `storyline`, `video`) VALUES
(1, 'Harry Potter à lécole des sorcier', 'Daniel Radclif Emma Watson Ruppert Grint', 'JK Rowling', 'JK Rowling', 2001, 'fr', 'fantastique', 'Harry potter découvre à l&#039;age de 11ans que c&#039;est un sorcier et qu&#039;il vas entrer au collège Poudlard', 'https://www.youtube.com/watch?v=ht5T2thYQFk'),
(2, 'Harry Potter à l&#039;école des sorcier', 'Daniel Radclif Emma Watson Ruppert Grint', 'JK Rowling', 'JK Rowling', 2001, 'fr', 'fantastique', 'Harry potter découvre à l&#039;age de 11ans que c&#039;est un sorcier et qu&#039;il vas entrer au collège Poudlard', 'https://www.youtube.com/watch?v=ht5T2thYQFk'),
(3, 'Harry potter et la chambre des secrets', 'Daniel Radclif Emma Watson Ruppert Grint Elies Kedim', 'JK Rowling', 'Warner Bros', 2002, 'fr', 'fantastique', 'L&#039;elfe Dobby a bien tenté d&#039;empêcher Harry de retourner à l&#039;École des Sorciers, frappée d&#039;une terrible malédiction, mais Harry n&#039;est pas près de laisser choir ses amis. Après une fugue et une rentrée scolaire plutôt chaotique, voi', 'https://www.youtube.com/watch?v=3ak6jkrPhTg'),
(4, 'Harry Potter et le prisonnier daskaban', 'Elies Elies Elies', 'JK Rowling', 'Warner Bros', 2003, 'fr', 'fantastique', 'lorerekfmslfjùffzef', 'https://www.youtube.com/watch?v=iED1RK6z29w'),
(5, 'Elies trop fort', 'Elies Elies Elies', 'elies', 'Le saint esprit', 1992, 'fr', 'comedie', 'fesgsghsrhsrhhrh', 'https://www.youtube.com/watch?v=4ceowgHn8BE');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_film`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
