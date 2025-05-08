-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 07 mai 2025 à 16:32
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `prets_bancaires`
--

-- --------------------------------------------------------

--
-- Structure de la table `pret_bancaire`
--

CREATE TABLE `pret_bancaire` (
  `numero_compte` varchar(20) NOT NULL,
  `nom_client` varchar(100) NOT NULL,
  `nom_banque` varchar(100) NOT NULL,
  `montant` decimal(15,2) NOT NULL,
  `date_pret` date NOT NULL,
  `taux_pret` decimal(5,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pret_bancaire`
--

INSERT INTO `pret_bancaire` (`numero_compte`, `nom_client`, `nom_banque`, `montant`, `date_pret`, `taux_pret`) VALUES
('2532h_f', 'Andriamiandrisoa Emanuel', 'BOA', 50000.00, '2025-05-07', 0.0500),
('C001', 'Dupont Jean', 'BNP Paribas', 15000.00, '2023-06-15', 0.0350),
('C002', 'Martin Sophie', 'Crédit Agricole', 25000.00, '2023-05-20', 0.0315),
('C003', 'Lambert Michel', 'Société Générale', 10000.00, '2023-07-10', 0.0420),
('C004', 'Petit Laura', 'LCL', 18000.00, '2023-08-05', 0.0375);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pret_bancaire`
--
ALTER TABLE `pret_bancaire`
  ADD PRIMARY KEY (`numero_compte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
