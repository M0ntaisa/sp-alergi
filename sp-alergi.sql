-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 30 Nov 2020 pada 13.54
-- Versi server: 5.7.24
-- Versi PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp-alergi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_alergi`
--

CREATE TABLE `tb_alergi` (
  `id_alergi` int(11) NOT NULL,
  `kode_alergi` char(8) NOT NULL,
  `nama_alergi` varchar(256) NOT NULL,
  `ket` text,
  `solusi` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_alergi`
--

INSERT INTO `tb_alergi` (`id_alergi`, `kode_alergi`, `nama_alergi`, `ket`, `solusi`) VALUES
(11, 'A1', 'Gangguan Pencernaan', 'lorem', 'lorem'),
(12, 'A2', 'Gatal dan Ruam di kulit', '', ''),
(13, 'A3', 'Bengkak-bengkak dibagian tertentu', '', ''),
(14, 'A4', 'Batuk-batuk', '', ''),
(15, 'A5', 'Hidung meler', '', ''),
(16, 'A6', 'Mata berair', '', ''),
(17, 'A7', 'Mengi/sesak nafas', '', ''),
(18, 'A8', 'Gumoh/muntah secara spontan', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_aturan`
--

CREATE TABLE `tb_aturan` (
  `id_aturan` int(11) NOT NULL,
  `id_gejala` int(11) NOT NULL,
  `id_alergi` int(11) NOT NULL,
  `mb` float DEFAULT NULL,
  `md` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_aturan`
--

INSERT INTO `tb_aturan` (`id_aturan`, `id_gejala`, `id_alergi`, `mb`, `md`) VALUES
(1, 1, 11, 0.6, 0.8),
(2, 2, 11, 1, 0.4),
(3, 3, 11, 0.8, 0.5),
(4, 4, 12, 0.2, 0.15),
(5, 5, 12, 0.7, 0.2),
(6, 6, 13, 0.5, 0.7),
(7, 7, 14, 0.85, 0.5),
(8, 8, 15, 0.9, 0.2),
(9, 9, 15, 0.8, 0.15),
(10, 10, 16, 1, 0.8),
(11, 11, 17, 0.34, 0.1),
(12, 12, 17, 0.4, 0.8),
(13, 13, 17, 0.2, 0.4),
(14, 14, 17, 0.8, 0.5),
(15, 15, 18, 0.45, 0.15),
(16, 16, 18, 0.2, 0.9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gejala`
--

CREATE TABLE `tb_gejala` (
  `id_gejala` int(11) NOT NULL,
  `kode_gejala` char(8) NOT NULL,
  `nama_gejala` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_gejala`
--

INSERT INTO `tb_gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`) VALUES
(1, 'GA1', 'Perut kembung\r\n'),
(2, 'GA2', 'Diare'),
(3, 'GA3', 'Muntah'),
(4, 'GA4', 'Wajah memerah'),
(5, 'GA5', 'Gatal pada sekujur tubuh\r\n'),
(6, 'GA6', 'Muncul benjolan yang terasa gatal diarea kulit'),
(7, 'GA7', 'Batuk setelah minum susu dingin'),
(8, 'GA8', 'Bengkak pada lubang hidung'),
(9, 'GA9', 'Hidung berlendir'),
(10, 'GA10', 'Rewel'),
(11, 'GA11', 'Bintik merah yang terasa gatal pada kulit'),
(12, 'GA12', 'Tenggorokan terasa sakit'),
(13, 'GA13', 'Lidah terasa sakit'),
(14, 'GA14', 'Tekanan darah menurun'),
(15, 'GA15', 'Mual'),
(16, 'GA16', 'Nyeri pada perut');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_riwayat`
--

CREATE TABLE `tb_riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_gejala` varchar(128) DEFAULT NULL,
  `prob_alergi` longtext,
  `kode_alergi` char(8) DEFAULT NULL,
  `tanggal_konsul` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(24) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `tanggal_dibuat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `username`, `password`, `role_id`, `status`, `tanggal_dibuat`) VALUES
(8, 'naya', 'naya@gmail.com', 'admin', '$2y$10$Mpfkx6JtaqPTb10XPvVZG.FM35ZHUSgGcJbivn2mnb69.jCIo/kWW', 1, 1, 1599752463);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(68) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `tanggal_dibuat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id_token`, `email`, `token`, `tanggal_dibuat`) VALUES
(1, 'asma@gmail.com', '6I4ZMQTxBNo0skHD6CfSg7eN0BEYWWk0AYA8qATUfl8=', 1599752463);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_alergi`
--
ALTER TABLE `tb_alergi`
  ADD PRIMARY KEY (`id_alergi`),
  ADD KEY `kode_penyakit` (`kode_alergi`);

--
-- Indeks untuk tabel `tb_aturan`
--
ALTER TABLE `tb_aturan`
  ADD PRIMARY KEY (`id_aturan`),
  ADD KEY `gejala` (`id_gejala`),
  ADD KEY `penyakit` (`id_alergi`);

--
-- Indeks untuk tabel `tb_gejala`
--
ALTER TABLE `tb_gejala`
  ADD PRIMARY KEY (`id_gejala`),
  ADD KEY `kode_gejala` (`kode_gejala`);

--
-- Indeks untuk tabel `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `user` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_alergi`
--
ALTER TABLE `tb_alergi`
  MODIFY `id_alergi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_aturan`
--
ALTER TABLE `tb_aturan`
  MODIFY `id_aturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_gejala`
--
ALTER TABLE `tb_gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_aturan`
--
ALTER TABLE `tb_aturan`
  ADD CONSTRAINT `alergi` FOREIGN KEY (`id_alergi`) REFERENCES `tb_alergi` (`id_alergi`) ON DELETE CASCADE,
  ADD CONSTRAINT `gejala` FOREIGN KEY (`id_gejala`) REFERENCES `tb_gejala` (`id_gejala`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  ADD CONSTRAINT `user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
