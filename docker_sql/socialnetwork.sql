-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2023 at 10:58 AM
-- Server version: 8.0.32-0ubuntu0.22.04.2
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialnetwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int UNSIGNED NOT NULL,
  `followed_user_id` int UNSIGNED NOT NULL,
  `following_user_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `followed_user_id`, `following_user_id`) VALUES
(3, 2, 7),
(4, 2, 5),
(6, 1, 5),
(7, 7, 5),
(9, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `post_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(34, 1, 8),
(35, 1, 9),
(21, 3, 8),
(25, 5, 2),
(31, 5, 6),
(24, 5, 7),
(37, 5, 8),
(17, 5, 9),
(39, 5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `parent_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `content`, `created`, `parent_id`) VALUES
(1, 5, '#politique étrangère Joe Biden, le président des Américains \r\n\r\n', '2020-02-05 18:19:12', NULL),
(2, 5, 'Le gouvernement a lancé, le 3 septembre, un plan de relance historique de 100 milliards d’euros pour redresser l’#économie.', '2020-04-06 18:19:12', NULL),
(3, 5, 'Dans une définition large de la notion du #social, on peut l\'entendre comme l\'expression de l\'existence de relations et de communication entre les êtres vivants.', '2020-07-12 18:21:49', NULL),
(4, 5, 'La #société (du latin socius : compagnon, associé) est un groupe d\'individus unifiés par un réseau de relations, de traditions et d\'institutions. ', '2020-08-04 18:21:49', NULL),
(5, 5, 'La #technologie est l\'étude des outils et des techniques. Le terme désigne les observations sur l\'état de l\'art aux diverses périodes historiques, en matière d\'outils et de savoir-faire. Il comprend l\'art, l\'artisanat, les métiers, les sciences appliquées et éventuellement les connaissances.', '2020-09-25 18:24:30', NULL),
(6, 5, 'En sociologie, comme en éthologie, la #culture est définie de façon plus étroite comme « ce qui est commun à un groupe d\'individus » et comme « ce qui le soude », c\'est-à-dire ce qui est appris, transmis, produit et inventé. Ainsi, pour une organisation internationale comme l\'UNESCO : « Dans son sens le plus large, la culture peut aujourd’hui être considérée comme l\'ensemble des traits distinctifs, spirituels, matériels, intellectuels et affectifs, qui caractérisent une société ou un groupe social. Elle englobe, outre les arts, les lettres et les sciences, les modes de vie, les lois, les systèmes de valeurs, les traditions et les croyances ». Ce « réservoir commun » évolue dans le temps par et dans les formes des échanges. Il se constitue en de multiples manières distinctes d\'être, de penser, d\'agir et de communiquer en société.', '2020-10-15 00:35:42', NULL),
(7, 5, 'On peut définir le jeu comme une activité d\'ordre psychique ou bien physique pensée pour divertir et improductive à court terme. Le jeu entraîne des dépenses d\'énergie et de moyens matériels, sans créer aucune richesse nouvelle. La plupart des individus qui s\'y engagent n\'en retirent que du plaisir, bien que certains puissent en obtenir des avantages matériels. De ce fait, Johan Huizinga remarque que de très nombreuses activités humaines peuvent s\'assimiler à des jeux. La difficulté de circonscrire la définition du jeu présente un intérêt pour la philosophie. ', '2020-10-25 00:35:39', NULL),
(8, 5, 'Un #jeu de rôle est une technique ou activité, par laquelle une personne interprète le rôle d\'un personnage (réel ou imaginaire) dans un environnement fictif. Le participant agit à travers ce rôle par des actions physiques ou imaginaires, par des actions narratives (dialogues improvisés, descriptions, jeu) et par des prises de décision sur le développement du personnage et de son histoire.', '2020-11-10 18:26:12', NULL),
(9, 1, 'Le #féminisme est un ensemble de mouvements et d\'idées philosophiques qui partagent un but commun : définir, promouvoir et atteindre l\'égalité #politique, économique, culturelle, sociale et juridique entre les femmes et les hommes. Le féminisme a donc pour objectif d\'abolir, dans ces différents domaines, les inégalités homme-femme dont les femmes sont les principales victimes, et ainsi de promouvoir les droits des femmes dans la société civile et dans la vie privée. ', '2020-11-20 18:26:50', NULL),
(10, 7, 'Le #sport est un ensemble d\'exercices physiques se pratiquant sous forme de jeux individuels ou collectifs pouvant donner lieu à des compétitions. Le sport est un phénomène presque universel dans le temps et dans l\'espace humain. La Grèce antique, la Rome antique, Byzance, l\'Occident médiéval puis moderne, mais aussi l\'Amérique précolombienne ou l\'Asie, sont tous marqués par l\'importance du sport. Certaines périodes sont surtout marquées par des interdits. ', '2020-11-30 18:31:16', NULL),
(11, 5, 'Bonjour, j\'aime #AdaTechSchool.', '2023-02-24 11:23:45', NULL),
(12, 5, 'Salut je suis #Jeremy', '2023-02-24 17:36:46', NULL),
(13, 2, 'J\'adore le #sport ! Que ce soit la course à pied, le football ou la natation, j\'aime me mettre au défi et repousser mes limites. Le sport me permet de me vider la tête et de me sentir bien dans mon corps.', '2023-02-28 14:36:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--

CREATE TABLE `posts_tags` (
  `id` int UNSIGNED NOT NULL,
  `post_id` int UNSIGNED NOT NULL,
  `tag_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts_tags`
--

INSERT INTO `posts_tags` (`id`, `post_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 6),
(6, 6, 7),
(7, 7, 8),
(8, 8, 8),
(9, 9, 9),
(10, 10, 5),
(11, 9, 1),
(12, 1, 1),
(13, 1, 8),
(14, 11, 10),
(15, 12, 11),
(16, 13, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `label`) VALUES
(10, 'AdaTechSchool'),
(7, 'culture'),
(2, 'économie'),
(9, 'féminisme'),
(8, 'jeux'),
(11, 'Mehmet'),
(1, 'politique'),
(3, 'social'),
(4, 'société'),
(5, 'sport'),
(6, 'technologie');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `alias`, `avatar`) VALUES
(1, 'ada@test.org', '6384e2b2184bcbf58eccf10ca7a6563c', 'ada', './avatars/avatar1.png'),
(2, 'alex@test.org', '6384e2b2184bcbf58eccf10ca7a6563c', 'Alexandra', './avatars/avatar2.png'),
(3, 'bea@test.org', '6384e2b2184bcbf58eccf10ca7a6563c', 'Béatrice', './avatars/avatar3.png'),
(4, 'zoe@test.org', '6384e2b2184bcbf58eccf10ca7a6563c', 'Zoé', './avatars/avatar4.png'),
(5, 'felicie@test.org', '6384e2b2184bcbf58eccf10ca7a6563c', 'Félicie', './avatars/avatar5.png'),
(7, 'jeremyzynger@gmail.com', '6384e2b2184bcbf58eccf10ca7a6563c', 'Jeremy', './avatars/avatar7.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_has_users_users2_idx` (`following_user_id`),
  ADD KEY `fk_users_has_users_users1_idx` (`followed_user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `fk_users_has_posts_posts1_idx` (`post_id`),
  ADD KEY `fk_users_has_posts_users1_idx` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_users_idx` (`user_id`),
  ADD KEY `fk_posts_posts1_idx` (`parent_id`);

--
-- Indexes for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_has_tags_tags1_idx` (`tag_id`),
  ADD KEY `fk_posts_has_tags_posts1_idx` (`post_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label_UNIQUE` (`label`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `alias_UNIQUE` (`alias`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts_tags`
--
ALTER TABLE `posts_tags`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `fk_users_has_users_users1` FOREIGN KEY (`followed_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_users_has_users_users2` FOREIGN KEY (`following_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_users_has_posts_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_users_has_posts_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_posts1` FOREIGN KEY (`parent_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD CONSTRAINT `fk_posts_has_tags_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `fk_posts_has_tags_tags1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);
COMMIT;

ALTER TABLE `users` CHANGE `avatar` `avatar` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
