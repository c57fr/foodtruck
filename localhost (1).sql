-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `Food`;
CREATE DATABASE `Food` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `Food`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1,	'Galette'),
(2,	'Crêpe')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `nom` = VALUES(`nom`);

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210215152223',	'2021-02-15 16:22:34',	66),
('DoctrineMigrations\\Version20210216153644',	'2021-02-16 16:36:50',	59),
('DoctrineMigrations\\Version20210221143248',	'2021-02-21 15:32:58',	108)
ON DUPLICATE KEY UPDATE `version` = VALUES(`version`), `executed_at` = VALUES(`executed_at`), `execution_time` = VALUES(`execution_time`);

DROP TABLE IF EXISTS `produit`;
CREATE TABLE `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `composition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC27BCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_29A5EC27BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `produit` (`id`, `categorie_id`, `nom`, `image`, `composition`) VALUES
(1,	1,	'Galette Bretonne',	'bretonne-602b865534c6d.jpg',	'Jambon , oeuf , gruyère'),
(2,	2,	'Crêpe choco banane',	'crepechocobanane-602e34b19999a.jpg',	'chocolat et banane')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `categorie_id` = VALUES(`categorie_id`), `nom` = VALUES(`nom`), `image` = VALUES(`image`), `composition` = VALUES(`composition`);

DROP TABLE IF EXISTS `quisommesnous`;
CREATE TABLE `quisommesnous` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `trouver`;
CREATE TABLE `trouver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jour` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trouver` (`id`, `image`, `ville`, `adresse`, `jour`, `debut`, `fin`) VALUES
(2,	'placedumarche-602bdf70c3666.jpg',	'Rodez',	'place du marché',	'Lundi',	'08H30',	'14h00'),
(4,	'bretonne-602beb78b5c22.jpg',	'nantes',	'eeeeee',	'Mercredi',	'09h00',	'12h00')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `image` = VALUES(`image`), `ville` = VALUES(`ville`), `adresse` = VALUES(`adresse`), `jour` = VALUES(`jour`), `debut` = VALUES(`debut`), `fin` = VALUES(`fin`);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `nom`, `prenom`) VALUES
(1,	'd@d.fr',	'',	'$argon2id$v=19$m=65536,t=4,p=1$VAvUd8H/CphU/ABopU2loQ$QtlmtH9J8UUVQpD0+2I+M8KxJtRvat0mPx9dTCOZ7gE',	'LOMBARD',	'daniel')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `email` = VALUES(`email`), `roles` = VALUES(`roles`), `password` = VALUES(`password`), `nom` = VALUES(`nom`), `prenom` = VALUES(`prenom`);

-- 2021-02-21 17:45:18
