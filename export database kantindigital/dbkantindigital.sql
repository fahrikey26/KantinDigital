-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2023 pada 01.26
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbkantindigital`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `kantin`
--

CREATE TABLE `kantin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kantin` varchar(255) NOT NULL,
  `nama_kantin` varchar(255) NOT NULL,
  `pemilik` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kantin`
--

INSERT INTO `kantin` (`id`, `id_kantin`, `nama_kantin`, `pemilik`, `created_at`, `updated_at`) VALUES
(10, 'Kan001', 'Baso', 'Ali', '2023-10-31 15:43:39', NULL),
(11, 'Kan002', 'Mie Ayam', 'Juli', '2023-10-31 15:47:29', NULL),
(12, 'Kan003', 'Ketoprak', 'Narisa', '2023-10-31 15:48:16', NULL),
(13, 'Kan004', 'Ayam', 'Siti', '2023-10-31 15:48:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_karyawan` varchar(255) NOT NULL,
  `nama_karyawan` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `point` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `id_karyawan`, `nama_karyawan`, `foto`, `point`, `created_at`, `updated_at`) VALUES
(1, 'Kar001', 'Asep', 'Asep.jpg', 990, NULL, '2023-10-31 15:40:12'),
(17, 'Kar002', 'ZULFAHRIZAL', 'ZULFAHRIZAL.jpg', 0, '2023-10-31 15:41:16', '2023-10-31 16:37:27'),
(18, 'Kar003', 'Nur Aisyah', 'Nur Aisyah.jpg', 2, '2023-10-31 15:42:35', '2023-10-31 17:14:36'),
(19, 'Kar004', 'Anisa', 'Anisa.jpg', 46, '2023-10-31 17:16:18', '2023-10-31 17:18:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_menu` varchar(255) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `id_kantin` varchar(255) NOT NULL,
  `point` int(11) NOT NULL,
  `foto` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `id_menu`, `nama_menu`, `id_kantin`, `point`, `foto`, `created_at`, `updated_at`) VALUES
(8, 'Menu001', 'Baso Malang', 'Kan001', 12, 'Baso Malang.jpg', '2023-10-30 17:00:00', NULL),
(9, 'Menu002', 'Baso Setan', 'Kan001', 15, 'Baso Setan.jpg', '2023-10-30 17:00:00', NULL),
(10, 'Menu003', 'Baso Urat', 'Kan001', 12, 'Baso Urat.jpg', '2023-10-30 17:00:00', NULL),
(11, 'Menu004', 'Ketoprak Telor', 'Kan003', 10, 'Ketoprak Telor.jpg', '2023-10-30 17:00:00', NULL),
(12, 'Menu005', 'Ketoprak Biasa', 'Kan003', 8, 'Ketoprak Biasa.jpg', '2023-10-30 17:00:00', NULL),
(13, 'Menu006', 'Ayam Geprek', 'Kan004', 15, 'Ayam Geprek.jpg', '2023-10-30 17:00:00', NULL),
(14, 'Menu007', 'Ayam Bakar', 'Kan004', 15, 'Ayam Bakar.jpg', '2023-10-30 17:00:00', NULL),
(15, 'Menu008', 'Ayam Goreng', 'Kan004', 15, 'Ayam Goreng.jpeg', '2023-10-30 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_30_032927_create_karyawan_table', 1),
(6, '2023_10_30_040603_create_menu_table', 2),
(7, '2023_10_30_040612_create_transaksi_table', 2),
(8, '2023_10_30_053543_create_kantin_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi` varchar(255) NOT NULL,
  `id_karyawan` varchar(255) NOT NULL,
  `id_menu` varchar(255) NOT NULL,
  `banyak` int(11) NOT NULL,
  `jumlahpoin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_transaksi`, `id_karyawan`, `id_menu`, `banyak`, `jumlahpoin`, `created_at`, `updated_at`) VALUES
(21, 'Trans001', 'Kar002', 'Menu004', 1, 10, '2023-10-31 16:37:27', NULL),
(22, 'Trans002', 'Kar003', 'Menu005', 1, 8, '2023-10-31 17:14:36', NULL),
(23, 'Trans003', 'Kar004', 'Menu008', 2, 30, '2023-10-31 17:18:02', NULL),
(24, 'Trans004', 'Kar004', 'Menu003', 2, 24, '2023-10-31 17:18:19', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `role` varchar(30) NOT NULL,
  `id_karyawan` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `foto`, `role`, `id_karyawan`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$16q0HHT6DOX3jARdWA/k6Oz/9mG5jTZ5/s4p53fWmGJQMmBfFP8DK', 'admin.jpg', 'admin', 'Kar001', NULL, '2023-10-30 17:00:00', NULL),
(9, 'ZULFAHRIZAL', 'fahrikey26@gmail.com', NULL, '$2y$10$XsgmkU6Z.h0lklTgGvBB5OL3bzwsyIheqmY6eMnvHNO9m7anTzc7u', 'ZULFAHRIZAL.jpg', 'karyawan', 'Kar002', NULL, '2023-10-31 15:41:16', NULL),
(10, 'Nur Aisyah', 'nur@gmail.com', NULL, '$2y$10$oh..XJtA0PdLtvVyGPPnrO5ae81jpDOw4bvwZVW/8C.LFMpTfTEKa', 'Nur Aisyah.jpg', 'karyawan', 'Kar003', NULL, '2023-10-31 15:42:35', NULL),
(11, 'Ali', 'ali@gmail.com', NULL, '$2y$10$4p9EDTN3ouAnTpyUJNlzUeQPmjuc1ZBddeO76yBhO5S6UKZu3Q806', 'Baso.jpg', 'pedagang', 'Kan001', NULL, '2023-10-31 15:43:39', NULL),
(12, 'Juli', 'juli@gmail.com', NULL, '$2y$10$EA2U9scUQeGLvDTLGTg0WeNX/Pl4iCUFi6mH/QCHKaJqXBCZwakdi', 'Mie Ayam.jpg', 'pedagang', 'Kan002', NULL, '2023-10-31 15:47:29', NULL),
(13, 'Narisa', 'nari@gmail.com', NULL, '$2y$10$RPdwgBi/aOzhNm3GUtdVNOx/d6GhgA.D9gFbQSoaD2GjSx2a4AzJC', 'Ketoprak.jpg', 'pedagang', 'Kan003', NULL, '2023-10-31 15:48:17', NULL),
(14, 'Siti', 'siti@gmail.com', NULL, '$2y$10$SPSk5GKUyT0WBvhfvroUgOZ4tA0/903WKiBOJlzPNxKPr9x2XPkMS', 'Ayam.jpg', 'pedagang', 'Kan004', NULL, '2023-10-31 15:48:49', NULL),
(15, 'Anisa', 'anisa@gmail.com', NULL, '$2y$10$Ft1WEhx8TvKRZLNjeFwzzOVT5OFF1Kkly6L2ck3h4pkG9ZpqsgBzK', 'Anisa.jpg', 'karyawan', 'Kar004', NULL, '2023-10-31 17:16:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kantin`
--
ALTER TABLE `kantin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_kantin` (`id_kantin`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kantin`
--
ALTER TABLE `kantin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
