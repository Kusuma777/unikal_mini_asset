-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Mar 2023 pada 03.08
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
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `file_foto` tinytext NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `id_jenis`, `nama_barang`, `status`, `stok`, `file_foto`, `keterangan`, `created_at`, `update_at`) VALUES
(9, 1, 'Asus', 'Tersedia', 1, 'e32e93e8c562d6597a26f63d8e3be05d.jpg', 'Normal', '0000-00-00 00:00:00', '2023-03-12 09:50:41'),
(17, 1, 'acer 2023', 'Tersedia', 12, 'spiderman.jpg', 'Normal', '2023-02-08 10:56:51', '2023-03-12 09:51:07'),
(18, 7, 'EpsonL360', 'Tersedia', 5, 'ss1.png', 'baik', '2023-02-09 10:20:55', '2023-03-12 09:51:13'),
(19, 11, 'HP', 'Tersedia', 13, '59a41c8c9ef621260449a14eb722fe69.jpg', 'Barang normal', '2023-02-14 08:53:55', '2023-03-12 09:51:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `created_at`, `update_at`) VALUES
(1, 'Monitor', '2023-01-27 03:20:45', '2023-01-27 02:21:04'),
(2, 'Keyboard ', '2023-01-27 03:20:45', '2023-01-27 02:21:04'),
(3, 'Mouse', '0000-00-00 00:00:00', '2023-01-27 03:58:37'),
(6, 'Kamera', '0000-00-00 00:00:00', '2023-01-27 04:24:39'),
(7, 'Printer', '0000-00-00 00:00:00', '2023-01-27 04:26:00'),
(9, 'Drone', '0000-00-00 00:00:00', '2023-01-30 02:40:02'),
(10, 'Speaker', '0000-00-00 00:00:00', '2023-01-30 03:09:44'),
(11, 'Laptop ', '2023-01-31 14:27:19', '2023-02-06 02:51:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `nama_peminjam` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `tgl_dipinjam` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `foto_peminjaman` tinytext NOT NULL,
  `foto_pengembalian` tinytext DEFAULT NULL,
  `status_peminjaman` enum('1','2','3') NOT NULL DEFAULT '1',
  `catatan` text NOT NULL,
  `ambil` int(11) NOT NULL DEFAULT 1,
  `tambah` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_barang`, `id_jenis`, `nama_peminjam`, `no_telp`, `tgl_dipinjam`, `tgl_pengembalian`, `foto_peminjaman`, `foto_pengembalian`, `status_peminjaman`, `catatan`, `ambil`, `tambah`, `created_at`, `update_at`) VALUES
(29, 9, 2, 'Erik', '089273462347', '2023-03-08', '2023-03-16', 'kai.png', 'pertamina.jpg', '2', 'oke', 1, 1, '2023-03-12 16:38:34', '2023-03-12 09:50:41');

--
-- Trigger `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `Ambilstok` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
	UPDATE barang set stok = stok - NEW.Ambil
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Tambahstok` AFTER UPDATE ON `peminjaman` FOR EACH ROW BEGIN
	UPDATE barang set stok = stok + NEW.Tambah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_detail`
--

CREATE TABLE `peminjaman_detail` (
  `id_peminjaman_detail` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `foto_peminjaman` tinytext NOT NULL,
  `foto_pengembalian` tinytext DEFAULT NULL,
  `ambil` int(11) DEFAULT 1,
  `tambah` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman_detail`
--

INSERT INTO `peminjaman_detail` (`id_peminjaman_detail`, `id_peminjaman`, `id_barang`, `id_jenis`, `foto_peminjaman`, `foto_pengembalian`, `ambil`, `tambah`, `created_at`, `update_at`) VALUES
(21, 3, 12, 6, '7a3b0af3d1a8bc5823f9df2063b330fe.jpg', 'kai.png', 1, 1, '2023-03-02 09:02:11', '2023-03-02 02:06:32'),
(22, 7, 9, 1, 'fd0a827960c0e713a334343ef9faf630.png', 'pertamina.jpg', 1, 1, '2023-03-02 09:05:21', '2023-03-02 02:06:52');

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
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indeks untuk tabel `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  ADD PRIMARY KEY (`id_peminjaman_detail`),
  ADD KEY `id_peminjaman` (`id_peminjaman`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  MODIFY `id_peminjaman_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
