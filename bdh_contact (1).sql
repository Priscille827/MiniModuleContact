-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 04 oct. 2026 à 07:22
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
-- Base de données : `bdh_contact`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `derniere_connexion` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `nom`, `email`, `mot_de_passe`, `actif`, `derniere_connexion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin Principal', 'admin@example.com', '$2y$12$ERZY.EfwW56eBFz8dUGGGuzolTRup.gvpOPuFzdl.ZQNJVT1xIcUC', 1, NULL, '2026-10-03 09:57:12', '2026-10-03 09:57:12', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demandes_contact`
--

CREATE TABLE `demandes_contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero_demande` varchar(30) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_service` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `statut` enum('en_attente','traitee') NOT NULL DEFAULT 'en_attente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demandes_contact`
--

INSERT INTO `demandes_contact` (`id`, `numero_demande`, `nom`, `email`, `id_service`, `message`, `statut`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'DEM-2026-0001', 'KINDOHO Priscille', 'priscillekindoho@gmail.com', 1, 'ezrtgyhujklmù*fdghjklmù', 'traitee', '2026-10-03 10:45:42', '2026-10-03 10:50:04', NULL),
(2, 'DEM-2026-BQ5N', 'KINDOHO Priscille', 'priscillekindoho@gmail.com', 2, 'DFGHJKLL§MFGHJKLM%GFGHHJJKLM', 'traitee', '2026-10-03 14:46:35', '2026-10-03 16:52:11', '2026-10-03 16:52:11'),
(3, 'DEM-2026-CDJ1', 'KINDOHO Priscille', 'priscillekindoho@gmail.com', 2, 'DFGHJKLL§MFGHJKLM%GFGHHJJKLM', 'en_attente', '2026-10-03 14:49:02', '2026-10-03 14:49:02', NULL),
(4, 'DEM-2026-MEZJ', 'KINDOHO Priscille', 'priscillekindoho@gmail.com', 2, 'DFGHJKLL§MFGHJKLM%GFGHHJJKLM', 'en_attente', '2026-10-03 15:06:20', '2026-10-03 15:06:20', NULL),
(5, 'DEM-2026-Z68M', 'KINDOHO Priscille', 'priscillekindoho@gmail.com', 2, 'DFGHJKLL§MFGHJKLM%GFGHHJJKLM', 'en_attente', '2026-10-03 15:07:54', '2026-10-03 15:07:54', NULL),
(6, 'DEM-2026-LQCR', 'KINDOHO', 'yissegnon40@gmail.com', 2, 'fghjklmù*ghjklmùù', 'en_attente', '2026-10-04 02:12:59', '2026-10-04 02:12:59', NULL),
(7, 'DEM-2026-JDUD', 'ok hu', 'priscillekindoho@gmail.com', 1, 'ghhhhhhcghcghhgggggggggggggggh', 'en_attente', '2026-10-04 02:53:56', '2026-10-04 02:53:56', NULL),
(8, 'DEM-2026-RQA3', 'ok hu', 'priscillekindoho@gmail.com', 1, 'ghhhhhhcghcghhgggggggggggggggh', 'en_attente', '2026-10-04 03:02:24', '2026-10-04 03:02:24', NULL),
(9, 'DEM-2026-309W', 'ok hu', 'priscillekindoho@gmail.com', 1, 'ghhhhhhcghcghhgggggggggggggggh', 'en_attente', '2026-10-04 03:11:10', '2026-10-04 03:11:10', NULL),
(10, 'DEM-2026-TDQ9', 'pllllllllll', 'priscillekindoho@gmail.com', 1, 'dsfgbhj,kl:!', 'en_attente', '2026-10-04 03:23:43', '2026-10-04 03:23:43', NULL),
(11, 'DEM-2026-WCGK', 'pllllllllll', 'priscillekindoho@gmail.com', 1, 'dsfgbhj,kl:!', 'en_attente', '2026-10-04 03:23:53', '2026-10-04 03:23:53', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom`, `description`, `actif`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Développement web', 'Sites vitrines, applications web', 1, '2026-10-03 09:41:00', '2026-10-03 09:41:00', NULL),
(2, 'Design', 'UI/UX, identité visuelle', 1, '2026-10-03 09:41:00', '2026-10-03 09:41:00', NULL),
(3, 'SEO', 'Référencement naturel', 1, '2026-10-03 09:41:00', '2026-10-03 09:41:00', NULL),
(4, 'Maintenance', 'Suivi et corrections', 1, '2026-10-03 09:41:00', '2026-10-03 09:41:00', NULL),
(5, 'Autre', 'Autre demande', 1, '2026-10-03 09:41:00', '2026-10-03 09:41:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kHm3hIlLVVfAWDQgNVdGqrR4J6so4sPS0jSYnJkj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 Edg/154.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUjBOOGNqbUNlQUhoYW9jNXNXVGo2M2RhZVNwaFpGN3VjbERaRXFCRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czoxNDoiY29udGFjdC5jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1791087841);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Index pour la table `demandes_contact`
--
ALTER TABLE `demandes_contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_demande` (`numero_demande`),
  ADD KEY `fk_demande_service` (`id_service`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `demandes_contact`
--
ALTER TABLE `demandes_contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demandes_contact`
--
ALTER TABLE `demandes_contact`
  ADD CONSTRAINT `fk_demande_service` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
