-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 19 fév. 2021 à 10:04
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce_entreprise`
--

CREATE TABLE `annonce_entreprise` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenue` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `specification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat_validation` tinyint(1) NOT NULL,
  `entreprise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `annonce_entreprise`
--

INSERT INTO `annonce_entreprise` (`id`, `titre`, `contenue`, `specification`, `etat_validation`, `entreprise_id`) VALUES
(1, 'fsdgdfsgdfsgdfsgdfgds', 'fdsgdfsgdfsgsdf gdfsgdfsgdfsgdsfgdfsgdfsgdfgs', 'fsdgdfsgdfsgdfgfdsgdfgdfsgdfs', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `apprenant`
--

CREATE TABLE `apprenant` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` bigint(20) NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `git` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `promo_anne` date NOT NULL,
  `promo_ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `competences` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobilit` tinyint(1) NOT NULL,
  `zone_geographique` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `apprenant`
--

INSERT INTO `apprenant` (`id`, `nom`, `prenom`, `adress`, `code_postal`, `ville`, `telephone`, `email`, `portfolio`, `git`, `cv`, `promo_anne`, `promo_ville`, `avatar`, `competences`, `mobilit`, `zone_geographique`, `users_id`) VALUES
(1, ',gvh,g,', 'hg,gh,', 'g,hg,', 71560, 'hg,gh', '662326263', 'h,gggg,@cghjgh.fr', 'fgdfgdfg@fdqggd.fr', 'qgdgdf@fdqgfd.fr', 'zqeffzqef@sdsfds.fr', '2021-02-17', 'lons le saunier', 'qsdqs.jpg', 'html', 1, 'france', 2),
(39, 'Frédéric', 'Frédéric', 'dsdds', 71580, 'St Martin du Mont', '0621328093', 'frederic.cordier@gmx.fr', 'http://zertezr@eff.fr', 'http://gergergr@gdgf.fr', 'http://afezfez@azefe.fr', '2016-01-01', 'St Martin du Mont', 'zfvsdv.jpg', 'dggfdgs', 0, 'france', 5);

-- --------------------------------------------------------

--
-- Structure de la table `apprenant_annonce_entreprise`
--

CREATE TABLE `apprenant_annonce_entreprise` (
  `apprenant_id` int(11) NOT NULL,
  `annonce_entreprise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `candidature`
--

CREATE TABLE `candidature` (
  `id` int(11) NOT NULL,
  `date_candidature` datetime NOT NULL,
  `date_relance` datetime DEFAULT NULL,
  `date_entretient` datetime DEFAULT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apprenant_id` int(11) NOT NULL,
  `entreprise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `candidature`
--

INSERT INTO `candidature` (`id`, `date_candidature`, `date_relance`, `date_entretient`, `statut`, `apprenant_id`, `entreprise_id`) VALUES
(1, '2021-02-17 09:48:14', NULL, NULL, 'En attente', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `telephone`, `email`, `entreprise_id`) VALUES
(1, 'fhcghfgh', 'gfhfghf', 5062226266, 'fdghfdg@dsfgdsfg.fr', 1);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210216075144', '2021-02-16 07:52:13', 341),
('DoctrineMigrations\\Version20210216075908', '2021-02-16 07:59:18', 389),
('DoctrineMigrations\\Version20210216080312', '2021-02-16 08:03:23', 490),
('DoctrineMigrations\\Version20210216080555', '2021-02-16 08:06:06', 357),
('DoctrineMigrations\\Version20210216082155', '2021-02-16 08:22:02', 342),
('DoctrineMigrations\\Version20210216082415', '2021-02-16 08:24:21', 1845),
('DoctrineMigrations\\Version20210216082749', '2021-02-16 08:27:55', 3995),
('DoctrineMigrations\\Version20210216083514', '2021-02-16 08:35:20', 6861),
('DoctrineMigrations\\Version20210216083656', '2021-02-16 08:37:00', 769),
('DoctrineMigrations\\Version20210217084656', '2021-02-17 08:47:21', 945);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` bigint(20) NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_net` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `nom`, `adress`, `code_postal`, `ville`, `telephone`, `email`, `site_net`, `user_id`) VALUES
(1, 'lulu', 'fgfdghgh', 71560, 'fgdhdfghg', '5062226266', 'gdfhdgf@hdfg.fr', 'sdfgdfgsf@fsggdf.fr', 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'admin@contact.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$OWhHTzl2WWJHekJWdXdHeg$kIHyiLnwfgiJvNgiyTLDNh1G7yoaePN8anrsrDHGf2k'),
(2, 'apprenent@contact.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$ZnZEN2RyYkh5WjJQZnRjdQ$q/9g3QobAcYx9hypU9PUkLDBHAbkoqnUw4/dwmHrIH0'),
(3, 'entreprise@contact.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$eHNBT2o0cUsvck9KcFIwUA$hq5alhS8FN6I0s2Zv01J9rEjZgeWr6bo9ASESO+u1BU'),
(5, 'lulu@contact.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$WTJRR1JjYjlRNWpYRmI1QQ$zXgeCNOupEOp6eomg7r9YdKfhz+H9AsZhSJLLjMaT7w'),
(6, 'frederic.cordier@gmx.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$TFl0MGJsWDNtWlltY1lHTQ$Zr/dAiZOLjvbJ1QxoK9iynPf6FadWhvmGyNfXpwyJfk');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce_entreprise`
--
ALTER TABLE `annonce_entreprise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_136D2FE3A4AEAFEA` (`entreprise_id`);

--
-- Index pour la table `apprenant`
--
ALTER TABLE `apprenant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C4EB462E67B3B43D` (`users_id`);

--
-- Index pour la table `apprenant_annonce_entreprise`
--
ALTER TABLE `apprenant_annonce_entreprise`
  ADD PRIMARY KEY (`apprenant_id`,`annonce_entreprise_id`),
  ADD KEY `IDX_6FF21B3FC5697D6D` (`apprenant_id`),
  ADD KEY `IDX_6FF21B3FECFA8E52` (`annonce_entreprise_id`);

--
-- Index pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E33BD3B8C5697D6D` (`apprenant_id`),
  ADD KEY `IDX_E33BD3B8A4AEAFEA` (`entreprise_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4C62E638A4AEAFEA` (`entreprise_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D19FA60A76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce_entreprise`
--
ALTER TABLE `annonce_entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `apprenant`
--
ALTER TABLE `apprenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `candidature`
--
ALTER TABLE `candidature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce_entreprise`
--
ALTER TABLE `annonce_entreprise`
  ADD CONSTRAINT `FK_136D2FE3A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`);

--
-- Contraintes pour la table `apprenant`
--
ALTER TABLE `apprenant`
  ADD CONSTRAINT `FK_C4EB462E67B3B43D` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `apprenant_annonce_entreprise`
--
ALTER TABLE `apprenant_annonce_entreprise`
  ADD CONSTRAINT `FK_6FF21B3FC5697D6D` FOREIGN KEY (`apprenant_id`) REFERENCES `apprenant` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6FF21B3FECFA8E52` FOREIGN KEY (`annonce_entreprise_id`) REFERENCES `annonce_entreprise` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD CONSTRAINT `FK_E33BD3B8A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `FK_E33BD3B8C5697D6D` FOREIGN KEY (`apprenant_id`) REFERENCES `apprenant` (`id`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_4C62E638A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`);

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `FK_D19FA60A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
