-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 24 juin 2024 à 05:36
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
(13, 'uploads/image/6678a6d2073a3_siniore.jpeg', 'uploads/image/6678db01a7659_classement.jpeg', 'فريق نهضة شيشاوة يتصدر دوري شيشاوة بأداء مميز وروح قتالية تعكس تفوقهم وإرادتهم للفوز باللقب.', NULL, 4);

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
(29, 'siniore.jpeg', 1, 1),
(30, 'الفتيان.jpeg', 1, 2),
(31, 'الفتيان.jpeg', 1, 3),
(32, 'براعم.jpeg', 1, 4),
(33, 'براعم.jpeg', 1, 5),
(34, 'football_sale.jpeg', 2, NULL),
(35, 'feminin.jpeg', 3, NULL),
(36, 'basketball.jpeg', 4, NULL),
(37, 'handball.jpeg', 5, NULL);

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
(8, 'Manuel', 'Neuer', 'uploads/image/6678ae5b3cda9_confiant-jeune-homme-sportif-afro-americain-portant-bandeau-bracelet-tenant-balle-epaule.jpg', 1, 'Gardien de but', 1, 1),
(10, 'Lionel', 'Messi', 'uploads/image/6678aca532b45_confiant-jeune-homme-sportif-afro-americain-portant-bandeau-bracelet-tenant-balle-epaule.jpg', 10, 'Attaquant', 1, 1),
(11, 'Erling', 'Haaland', 'uploads/image/6678af6408c03_football-trainer-teaching-his-pupils.jpg', 9, 'Attaquant', 2, 1),
(13, 'Cristiano', 'Ronaldo', 'uploads/image/6678acdb8f7c8_confiant-jeune-homme-sportif-afro-americain-portant-bandeau-bracelet-tenant-balle-epaule.jpg', 7, 'Attaquant', 1, 1),
(14, 'Kylian', 'Mbappé', 'uploads/image/6678ad7184ba8_confiant-jeune-homme-sportif-afro-americain-portant-bandeau-bracelet-tenant-balle-epaule.jpg', 7, 'Attaquant', 1, 1),
(15, 'Neymar', 'Jr.', 'uploads/image/6678adab51c43_confiant-jeune-homme-sportif-afro-americain-portant-bandeau-bracelet-tenant-balle-epaule.jpg', 10, 'Attaquant', 1, 1),
(16, 'Kevin', 'De Bruyne', 'uploads/image/6678add896797_confiant-jeune-homme-sportif-afro-americain-portant-bandeau-bracelet-tenant-balle-epaule.jpg', 17, 'Milieu de terrain', 1, 1),
(17, 'Virgil ', 'van Dijk', 'uploads/image/6678adff580cb_confiant-jeune-homme-sportif-afro-americain-portant-bandeau-bracelet-tenant-balle-epaule.jpg', 4, 'Défenseur', 1, 1),
(18, 'Sergio', 'Ramos', 'uploads/image/6678ae2a31478_confiant-jeune-homme-sportif-afro-americain-portant-bandeau-bracelet-tenant-balle-epaule.jpg', 4, 'Défenseur', 1, 1),
(19, 'Luka', 'Modrić', 'uploads/image/6678ae85940d2_confiant-jeune-homme-sportif-afro-americain-portant-bandeau-bracelet-tenant-balle-epaule.jpg', 10, 'Milieu de terrain', 1, 1),
(20, 'Mohamed', 'Salah', 'uploads/image/6678aeac9cb64_confiant-jeune-homme-sportif-afro-americain-portant-bandeau-bracelet-tenant-balle-epaule.jpg', 11, 'Attaquant', 1, 1),
(21, 'Robert', 'Lewandowski', 'uploads/image/6678aed0cb95f_confiant-jeune-homme-sportif-afro-americain-portant-bandeau-bracelet-tenant-balle-epaule.jpg', 9, 'Attaquant', 1, 1),
(22, 'Phil', 'Foden', 'uploads/image/6678af9302233_football-trainer-teaching-his-pupils.jpg', 47, 'Milieu de terrain', 2, 1),
(23, 'Vinícius', 'Júnior', 'uploads/image/6678b26f697e1_football-trainer-teaching-his-pupils.jpg', 7, 'Attaquant', 2, 1),
(24, 'Jude', 'Bellingham', 'uploads/image/6678b2cecebd2_football-trainer-teaching-his-pupils.jpg', 22, 'Milieu de terrain', 2, 1),
(25, 'Ansu', 'Fati', 'uploads/image/6678b30be2fbf_football-trainer-teaching-his-pupils.jpg', 10, 'Attaquant', 2, 1),
(26, 'Alphonso', 'Davies', 'uploads/image/6678b36eb631c_football-trainer-teaching-his-pupils.jpg', 19, 'Défenseur', 2, 1),
(27, 'Jude', 'Bellingham', 'uploads/image/6678b5f152133_football-trainer-teaching-his-pupils.jpg', 5, 'Milieu de terrain', 3, 1),
(28, 'Jamal', 'Musiala', 'uploads/image/6678b6e3adcc6_football-trainer-teaching-his-pupils.jpg', 42, 'Milieu offensif', 3, 1),
(29, 'Bukayo', 'Saka', 'uploads/image/6678b679ec46e_football-trainer-teaching-his-pupils.jpg', 7, 'Attaquant', 3, 1),
(30, 'Giovanni', 'Reyna', 'uploads/image/6678b6b54caca_football-trainer-teaching-his-pupils.jpg', 7, 'Milieu de terrain', 3, 1),
(31, 'Ryan', 'Gravenberch', 'uploads/image/6678b71420ee3_football-trainer-teaching-his-pupils.jpg', 38, 'Milieu de terrain', 3, 1),
(32, 'Ethan', 'Mbappé', 'uploads/image/6678b8390ce17_view-child-soccer-player-with-ball.jpg', 0, 'Milieu de terrain', 4, 1),
(33, 'Lamine', 'Yamal', 'uploads/image/6678b86f6f999_view-child-soccer-player-with-ball.jpg', 0, 'Attaquant', 4, 1),
(34, 'Maximo', 'Carrizo', 'uploads/image/6678b8a23e878_view-child-soccer-player-with-ball.jpg', 0, 'Milieu de terrain', 4, 1),
(35, 'Youssoufa', 'Moukoko', 'uploads/image/6678b8ce8665f_view-child-soccer-player-with-ball.jpg', 0, 'Attaquant', 4, 1),
(36, 'Simone', 'Pafundi', 'uploads/image/6678b91aa721c_view-child-soccer-player-with-ball.jpg', 0, 'Milieu offensif', 4, 1),
(37, 'Warren ', 'Zaïre-Emery', 'uploads/image/6678b9d421ef0_happy-kid-posing-with-his-ball-with-blurred-background.jpg', 0, 'Milieu de terrain', 5, 1),
(38, 'Kobi', 'Henry', 'uploads/image/6678ba2b74587_happy-kid-posing-with-his-ball-with-blurred-background.jpg', 0, 'Défenseur', 5, 1),
(39, 'Nico', 'Williams', 'uploads/image/6678ba5e47cdb_happy-kid-posing-with-his-ball-with-blurred-background.jpg', 0, 'Attaquant', 5, 1),
(40, 'Takuhiro', 'Nakai', 'uploads/image/6678ba9235365_happy-kid-posing-with-his-ball-with-blurred-background.jpg', 0, 'Milieu de terrain', 5, 1),
(41, 'Luca', 'Netz', 'uploads/image/6678bac044f95_happy-kid-posing-with-his-ball-with-blurred-background.jpg', 0, 'Défenseur', 5, 1),
(42, 'Zion', 'Williamson', 'uploads/image/6678ccdb63008_ethnic-sportsman-with-basketball-ball.jpg', 1, 'Ailier fort', NULL, 4),
(43, 'LaMelo', 'Ball', 'uploads/image/6678cd0d24fb0_ethnic-sportsman-with-basketball-ball.jpg', 2, 'Meneur de jeu', NULL, 4),
(44, 'Anthony', 'Edwards', 'uploads/image/6678cd3f412db_ethnic-sportsman-with-basketball-ball.jpg', 1, 'Arrière', NULL, 4),
(45, 'Luka', 'Dončić', 'uploads/image/6678cd891a868_ethnic-sportsman-with-basketball-ball.jpg', 77, ' Meneur de jeu/Ailier', NULL, 4),
(46, 'Jayson', 'Tatum', 'uploads/image/6678cdce5bab5_ethnic-sportsman-with-basketball-ball.jpg', 0, 'Ailier', NULL, 4),
(47, 'Rodrigo', 'Hardy', 'uploads/image/6678cf138b5fc_smiling-football-player-holding.jpg', 11, 'Attaquant', NULL, 2),
(48, 'Bruno', 'Xavier', 'uploads/image/6678cf3fafeb7_smiling-football-player-holding.jpg', 3, 'Défenseur', NULL, 2),
(49, 'Douglas ', 'Jr.', 'uploads/image/6678cf742523c_smiling-football-player-holding.jpg', 1, 'Gardien de but', NULL, 2),
(50, 'Leandro', 'Lino', 'uploads/image/6678cf9ed871f_smiling-football-player-holding.jpg', 9, 'Attaquant', NULL, 2),
(51, 'Vinicius', 'Rocha', 'uploads/image/6678cfe19f885_smiling-football-player-holding.jpg', 8, 'Milieu de terrain', NULL, 2),
(52, 'Ada', 'Hegerberg', 'uploads/image/6678d05052dbe_joueur-football-feminin-arabe-isole-mur-blanc-du-studio.jpg', 14, 'Attaquante', NULL, 3),
(53, 'Vivianne', 'Miedema', 'uploads/image/6678d0935ef39_joueur-football-feminin-arabe-isole-mur-blanc-du-studio.jpg', 11, 'Attaquante', NULL, 3),
(54, 'Wendie', 'Renard', 'uploads/image/6678d0be7658f_joueur-football-feminin-arabe-isole-mur-blanc-du-studio.jpg', 3, 'Défenseure', NULL, 3),
(55, 'Pernille', 'Harder', 'uploads/image/6678d0e815004_joueur-football-feminin-arabe-isole-mur-blanc-du-studio.jpg', 23, 'Attaquante', NULL, 3),
(56, 'Sam', 'Kerr', 'uploads/image/6678d10e17e8f_joueur-football-feminin-arabe-isole-mur-blanc-du-studio.jpg', 20, 'Attaquante', NULL, 3),
(57, 'Sander', 'Sagosen', 'uploads/image/6678d1b83255a_female-football-player-holding-ball.jpg', 24, 'Arrière central', NULL, 5),
(58, 'Mikkel', 'Hansen', 'uploads/image/6678d1e67c92e_female-football-player-holding-ball.jpg', 24, 'Arrière gauche', NULL, 5),
(59, 'Nikola', 'Karabatic', 'uploads/image/6678d20ddbf1c_female-football-player-holding-ball.jpg', 44, 'Arrière droit', NULL, 5),
(60, 'Domagoj', 'Duvnjak', 'uploads/image/6678d231d8fd8_female-football-player-holding-ball.jpg', 21, 'Demi-centre', NULL, 5),
(61, 'Andreas', 'Wolff', 'uploads/image/6678d2566df37_female-football-player-holding-ball.jpg', 16, 'Gardien de but', NULL, 5);

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
(7, 'uploads/', 'uploads/', '1:2', '2024-06-16', NULL, NULL, NULL, 1),
(10, 'uploads/0eaa1b6816d1a87bf51c1b9836161aad.png', 'uploads/1.png', '2:2', '2024-06-18', '12:30:00', 'asq', NULL, 5),
(12, 'uploads/RSC-removebg-preview.png', 'uploads/wac-removebg-preview.png', '0:1', '2024-06-22', '16:00:00', 'ملعب محمد السادس', 1, 1),
(13, 'uploads/wac-removebg-preview.png', 'uploads/RSC-removebg-preview.png', '1:0', '2024-06-24', '18:00:00', 'شيشاوة', 1, 1),
(14, 'uploads/RSC-removebg-preview.png', 'uploads/yvxRL0m.png', '1:1', '2024-06-12', '13:00:00', 'اليوسفية', 2, 1),
(15, 'uploads/yvxRL0m.png', 'uploads/RSC-removebg-preview.png', '1:1', '2024-06-19', '14:00:00', 'شيشاوة', 2, 1);

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
(6, 'Abdellah Albadi', 'badi.jpeg', 4),
(10, 'Bojmaa', 'bojmaa.jpeg', 2);

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
(3, 'تفوق مذهل: فريق نهضة شيشاوة يتصدر دوريه بأداء استثنائي وروح جماعية قوية', '2024-06-07', 'الكبار.jpeg', 'فريق نهضة شيشاوة يبرز بشكل مذهل في دوري شيشاوة هذا الموسم، حيث يتصدر الترتيب ويسطع نجمه بين الفرق المتنافسة. بفضل أداءه المتميز وتفوقه في المباريات، يعكس الفريق قوته وإرادته القوية في تحقيق الانتصارات وتحقيق النقاط الثلاث في كل مباراة. يتميز نهضة شيشاوة بروح الفريق القوية والتعاون الجيد بين اللاعبين، مما يسهم في تحقيق النتائج الإيجابية. وبهذا التفوق، يلهم الفريق جماهيره ويثير حماسهم لمواصلة دعمهم ومساندتهم لتحقيق البطولة والتتويج باللقب في نهاية الموسم.');

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
(20, 'coummun-chichaoua-removebg-preview.png'),
(21, 'arije.png'),
(22, 'in.png');

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
(1, 'كرة القدم', '\r\nكرة القدم هي رياضة جماعية تلعب بين فريقين مكونين من 11 لاعباً لكل فريق. الهدف من اللعبة هو تسجيل الأهداف بتسديد الكرة داخل مرمى الفريق المنافس. يستخدم اللاعبون أقدامهم لتمرير وتسديد الكرة، باستثناء الحارس الذي يمكنه استخدام يديه داخل منطقة الجزاء. تُعتبر كرة القدم من أكثر الرياضات شعبية على مستوى العالم.', 'uploads/image/6678d87708866_football.png'),
(2, 'كرة القدم داخل القاعة', '\r\nكرة القدم للقاعة هي نسخة صغيرة من كرة القدم العادية، تُلعب في ملعب مغلق وعادةً ما يلعب كل فريق بخمسة لاعبين، بما في ذلك الحارس. تتميز هذه اللعبة بالسرعة والمهارة، حيث يُسمح بالتحكم في الكرة باستخدام القدم والجسم بأكمله داخل الملعب. تتميز كرة القدم للقاعة بشعبية كبيرة في العديد من الدول.', 'uploads/image/6678d95ccedd9_foot-sale.png'),
(3, 'كرة القدم النسوية', '\r\nكرة القدم هي رياضة جماعية تلعب بين فريقين مكونين من 11 لاعباً لكل فريق. الهدف من اللعبة هو تسجيل الأهداف بتسديد الكرة داخل مرمى الفريق المنافس. يستخدم اللاعبون أقدامهم لتمرير وتسديد الكرة، باستثناء الحارس الذي يمكنه استخدام يديه داخل منطقة الجزاء. تُعتبر كرة القدم من أكثر الرياضات شعبية على مستوى العالم.', 'uploads/image/6678d8920a270_femme.png'),
(4, 'كرة السلة', '\r\nكرة السلة هي رياضة تتنافس فيها فرق من خمسة لاعبين كلٌ على ملعب مستطيل الشكل، ويحاول كل فريق تسجيل النقاط عن طريق رمي الكرة في سلة الفريق المنافس. تتطلب اللعبة مهارات متنوعة مثل القفز والتمرير والتسديد والدفاع. كرة السلة تحظى بشعبية كبيرة في جميع أنحاء العالم.', 'uploads/image/6678d8b7cbf35_basketball.png'),
(5, 'كرة اليد', 'كرة اليد هي رياضة تجمع بين السرعة والمهارة، حيث يتنافس فريقان في التمرير والتسديد لتسجيل الأهداف في مرمى الفريق المنافس. يلعب كل فريق بـ 7 لاعبين، بما في ذلك الحارس. يستخدم اللاعبون أيديهم للتحكم في الكرة. تُعتبر كرة اليد شعبية جدًا في أوروبا والعديد من أنحاء العالم.', 'uploads/image/6678d8dbb57f8_handball.png');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `joueurs`
--
ALTER TABLE `joueurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
