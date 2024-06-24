-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 22 juin 2024 à 23:37
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `association`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('principal','secondaire') NOT NULL DEFAULT 'secondaire'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `role`) VALUES
(9, 'aaa', '$2y$10$HsmDKdULRX2jRrNF2f6uWuHYaEsJ1uAyhicAuI/EHxYs4sHv/WB5S', 'principal'),
(10, 'mmm', '$2y$10$.IY5Of2QojhU1mctkOsWtub.jnD67bPmRpuhzSn3LfNXrUDGQXurW', 'secondaire'),
(11, 'sss', '$2y$10$YwZ/iB5daEBEsoqRD8PipuFQibCdIYNoFf6VjXNu.9efJ.j1OHMW6', 'principal');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom_categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom_categorie`) VALUES
(1, 'الكبار'),
(2, 'الشبان'),
(3, 'الفتيان'),
(4, 'الصغار'),
(5, 'البراعم');

-- --------------------------------------------------------

--
-- Structure de la table `classement`
--

CREATE TABLE `classement` (
  `id` int(11) NOT NULL,
  `equipe_image` varchar(255) DEFAULT NULL,
  `classement_image` varchar(255) DEFAULT 'default_image.jpg',
  `description` varchar(255) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `type_sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classement`
--

INSERT INTO `classement` (`id`, `equipe_image`, `classement_image`, `description`, `categorie_id`, `type_sport_id`) VALUES
(5, 'uploads/image/6663a2972102a_0eaa1b6816d1a87bf51c1b9836161aad.png', 'uploads/image/6663a3249bbef_1.png', 'hhhh', NULL, NULL),
(8, 'uploads/image/6672ff44f05c7_0eaa1b6816d1a87bf51c1b9836161aad.png', 'default_image.jpg', 'ss', 2, NULL),
(9, 'uploads/image/6673005c68673_1.png', 'default_image.jpg', 'aaa', 1, NULL),
(10, 'uploads/image/667305c5a8f72_1.png', 'default_image.jpg', '', NULL, NULL),
(11, NULL, 'uploads/image/667305d346e8b_1.png', 'sss', NULL, NULL),
(12, 'uploads/image/667306678a9dd_0eaa1b6816d1a87bf51c1b9836161aad.png', 'uploads/image/66730677bf640_1.png', 'aaa', 5, NULL),
(13, 'uploads/image/667307d0702e2_2_3.png', 'uploads/image/6673587e11100_1.png', 'azqlsk', NULL, 4);

-- --------------------------------------------------------

--
-- Structure de la table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `map_url` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact_info`
--

INSERT INTO `contact_info` (`id`, `type`, `icon`, `title`, `value`, `map_url`) VALUES
(1, 'address', 'bx bx-map', 'Our Address', 'A108 Adam Street, New York, NY 535022', NULL),
(2, 'email', 'bx bx-envelope', 'Email Us', 'contact@example.com', NULL),
(4, 'phone', 'bx bx-phone-call', 'Call Us', '000000', ''),
(5, 'map', 'bx bx-map', 'Our Address', 'A108 Adam Street, New York, NY 535022', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3400.456916818469!2d-8.768626424138773!3d31.539072774205422!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdae3da0a13d5c75%3A0x40a87c11c5232922!2zQXNzb2NpYXRpb24gQVJJSiDYrNmF2LnZitipINij2LHZitis!5e0!3m2!1sfr!2sma!4v1717856004891!5m2!1sfr!2sma');

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `documents`
--

INSERT INTO `documents` (`id`, `title`, `pdf`, `type_id`) VALUES
(1, 'الوصل النهائي', 'certificat.pdf', 1),
(2, 'لائحة المكتب المسير', 'bureau.pdf', 1),
(3, 'القانون الداخلي للجمعية', 'lois-domestiques.pdf', 2);

-- --------------------------------------------------------

--
-- Structure de la table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `type_id`, `categorie_id`) VALUES
(14, '0eaa1b6816d1a87bf51c1b9836161aad.png', 1, 2),
(16, '1.png', 1, 3),
(17, '1.png', 2, 1),
(18, '1.png', 2, 1),
(19, '1.png', 2, 1),
(21, '4_2.png', 3, 1),
(22, '0eaa1b6816d1a87bf51c1b9836161aad.png', 4, 1),
(23, '1.png', 4, 1),
(24, '1.png', 2, 1),
(25, '3_3.png', 1, 1),
(26, '0eaa1b6816d1a87bf51c1b9836161aad.png', 1, 1),
(27, '3_3.png', 4, NULL),
(28, '2_2_3.png', 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE `joueurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `numero_maillot` int(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `type_sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`id`, `nom`, `prenom`, `image`, `numero_maillot`, `role`, `categorie_id`, `type_sport_id`) VALUES
(8, 'abdelhaq', 'marouan', 'uploads/image/667457781d097_', 1, 'gole', 2, 1),
(9, 'aa', 'aa', 'uploads/image/667359e639827_', 2, 'zz', 1, 2),
(10, 'ddd', 'ddd', 'uploads/image/6674497c93b2d_', 3, 'ddd', 1, 1),
(11, 'marouan', 'abdelhaq', 'uploads/image/667457cbca01d_', 3, 'jj', 2, 1),
(12, 'qq', 'qqq', 'uploads/image/66745c8bdf00a_0eaa1b6816d1a87bf51c1b9836161aad.png', 2, 'aa', NULL, 4);

-- --------------------------------------------------------

--
-- Structure de la table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `team1_logo` varchar(255) DEFAULT NULL,
  `team2_logo` varchar(255) DEFAULT NULL,
  `score` varchar(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `type_sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matches`
--

INSERT INTO `matches` (`id`, `team1_logo`, `team2_logo`, `score`, `date`, `time`, `location`, `categorie_id`, `type_sport_id`) VALUES
(2, 'uploads/', 'uploads/', '0:1', '2022-02-03', '00:00:00', 'ملعب ابن بطوطة', 3, 1),
(3, 'team1_logo.png', 'team2_logo.png', '1:0', '2022-03-01', '20:00:00', 'ملعب ابن بطوطة', NULL, 2),
(4, 'team1_logo.png', 'team2_logo.png', '3:0', '2022-02-12', '18:00:00', 'ملعب البشير', 1, 1),
(5, 'team1_logo.png', 'team2_logo.png', '0:1', '2022-02-03', '00:00:00', 'ملعب ابن بطوطة', 1, 1),
(7, 'uploads/', 'uploads/', '1:2', '2024-06-16', NULL, NULL, NULL, 1),
(8, 'uploads/0eaa1b6816d1a87bf51c1b9836161aad.png', 'uploads/1.png', '2:2', '2024-06-19', '12:30:00', 'azilal', 1, 1),
(9, 'uploads/2_2_3.png', 'uploads/3_3.png', '0:0', '2024-06-18', '13:00:00', 'azilal', 2, 1),
(10, 'uploads/0eaa1b6816d1a87bf51c1b9836161aad.png', 'uploads/1.png', '2:2', '2024-06-18', '12:30:00', 'asq', NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `name`, `image`, `role_id`) VALUES
(6, 'badi', '1.png', 1),
(10, 'marouan', '1.png', 2);

-- --------------------------------------------------------

--
-- Structure de la table `member_roles`
--

CREATE TABLE `member_roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `member_roles`
--

INSERT INTO `member_roles` (`id`, `role_name`) VALUES
(1, 'President'),
(2, 'Vice President'),
(3, 'Secretary'),
(4, 'Treasurer');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(13, 'aaa', 'aaa@gmail.com', 'sss', 'ssss', '2024-06-08 13:23:43'),
(14, 'maro', 'mar@gmail.com', 'aqsz', 'zes', '2024-06-08 14:30:51'),
(15, 'mae', 'am@gmail.com', 'ample', 'snqnd', '2024-06-08 14:31:33'),
(16, 'maroua', 'amzks@gmail.com', 'annnz', 'snzz', '2024-06-08 14:33:22'),
(17, 'mm', 'm@gmail.com', 'zzz', 'zz', '2024-06-08 14:36:45'),
(18, 'aa', 'a@gmail.com', 'ss', 'ss', '2024-06-08 14:37:20'),
(19, 'zzz', 'zz@gmail.com', 'dddd', 'dd', '2024-06-08 14:42:27'),
(20, 'zzz', 'ddd@gmail.com', 'ddd', 'dddd', '2024-06-08 14:43:26'),
(21, 'gg', 'ff@gmail.com', 'ff', 'dd', '2024-06-08 14:44:09'),
(22, 'zzz', 'zzzz@gmail.com', 'ddd', 'dd', '2024-06-08 14:45:36'),
(23, 'qqq', 'qq@gmail.com', 'ss', 'ss', '2024-06-08 14:48:25'),
(24, 'qqq', 'qq@gmail.com', 'ss', 'ss', '2024-06-08 15:24:28');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `title`, `date`, `image`, `content`) VALUES
(3, 'aazz', '2024-06-07', '1.png', 'azerr');

-- --------------------------------------------------------

--
-- Structure de la table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `platform` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `social_links`
--

INSERT INTO `social_links` (`id`, `platform`, `icon`, `url`) VALUES
(2, 'facebook', 'bi bi-facebook', '#'),
(3, 'instagram', 'bi bi-instagram', '#');

-- --------------------------------------------------------

--
-- Structure de la table `sponsors`
--

CREATE TABLE `sponsors` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sponsors`
--

INSERT INTO `sponsors` (`id`, `image`) VALUES
(19, '1.png');

-- --------------------------------------------------------

--
-- Structure de la table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `badge` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `support`
--

INSERT INTO `support` (`id`, `title`, `description`, `badge`) VALUES
(1, 'Faire un Don Bancaire', '007  465  0008494000301578  66', 'تبرع مصرفي'),
(2, 'International Bank', 'MA64  007  465  0008494000301578  66', 'international Bank');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'الملف القانوني للجمعية'),
(2, 'الجموع العامة'),
(3, 'الجموع الإستتنائية');

-- --------------------------------------------------------

--
-- Structure de la table `types_photos`
--

CREATE TABLE `types_photos` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `types_photos`
--

INSERT INTO `types_photos` (`id`, `type`, `description`, `image`) VALUES
(1, 'كرة القدم', 'azhhs', 'uploads/image/6663ab8c883d2_0eaa1b6816d1a87bf51c1b9836161aad.png'),
(2, 'كرة القدم داخل القاعة', 'qsd', 'uploads/image/6663abaa05f37_1.png'),
(3, 'كرة القدم النسوية', 'azer', 'uploads/image/6663abcc06e1b_52b220e7bc08eb7b684c74071a775f4206a3dd69.webp'),
(4, 'كرة السلة', 'asdq', 'uploads/image/6663abdb96d94_77c40978a5de043cc8c15e483c848076.jpeg'),
(5, 'كرة اليد', 'psd', 'uploads/image/6663ac0f05c86_Capture d’écran 2023-12-14 à 20.48.49.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classement`
--
ALTER TABLE `classement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categorie` (`categorie_id`),
  ADD KEY `fk_type_sport` (`type_sport_id`);

--
-- Index pour la table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Index pour la table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_type_id` (`type_id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Index pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_sport_id` (`type_sport_id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Index pour la table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categorie_id` (`categorie_id`),
  ADD KEY `fk_type_sport_id` (`type_sport_id`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Index pour la table `member_roles`
--
ALTER TABLE `member_roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `types_photos`
--
ALTER TABLE `types_photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `classement`
--
ALTER TABLE `classement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `joueurs`
--
ALTER TABLE `joueurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `member_roles`
--
ALTER TABLE `member_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `types_photos`
--
ALTER TABLE `types_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classement`
--
ALTER TABLE `classement`
  ADD CONSTRAINT `fk_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_type_sport` FOREIGN KEY (`type_sport_id`) REFERENCES `types_photos` (`id`);

--
-- Contraintes pour la table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Contraintes pour la table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `categorie_id` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_type_id` FOREIGN KEY (`type_id`) REFERENCES `types_photos` (`id`);

--
-- Contraintes pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD CONSTRAINT `joueurs_ibfk_1` FOREIGN KEY (`type_sport_id`) REFERENCES `types_photos` (`id`),
  ADD CONSTRAINT `joueurs_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `fk_categorie_id` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_type_sport_id` FOREIGN KEY (`type_sport_id`) REFERENCES `types_photos` (`id`);

--
-- Contraintes pour la table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `member_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
