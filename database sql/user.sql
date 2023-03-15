-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Mar 2023 pada 03.09
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini_assets`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nama_user` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `nama_user`, `password`, `created_at`, `update_at`) VALUES
(37, 'Riqza Muqtada', 'riqza', '$2y$10$4V.QP1FTsXPH6BlvjErUzej6GExppZycrNKBKhm/quQBLVqkOsV0i', '2023-02-06 07:23:11', '2023-02-06 07:23:11'),
(42, 'asdasdasdasd', 'asd', '$2y$10$8u40r3DbC8QBK.P1teGpQeBngc/1mgJ.tWz76rwdk8TO1Zi4jrnlC', '2023-02-07 08:51:57', '2023-02-10 03:21:28'),
(46, 'admin1', 'admin', '$2y$10$EF65v7Ae2yO60AaasoS1bufAuwF0lOyp/iqU/0Hhi1fsKtbXE3fpS', '2023-02-14 14:16:36', '2023-02-22 07:52:33'),
(47, 'Vahad Khusaini', 'vahadkhusaini', '$2y$10$bAJlxKO/Jnw7s8fpBkBBBONWojMxytHaa1TBC2V19Vcqtkjb2olx.', '2023-02-21 11:20:29', '2023-02-21 04:20:29');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
