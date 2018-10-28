-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28 Okt 2018 pada 04.05
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metro`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cetak`
--

CREATE TABLE `cetak` (
  `id_cetak` int(11) NOT NULL,
  `id_percetakan` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sesi` int(1) NOT NULL,
  `jam_masuk_cetak` time NOT NULL,
  `jam_selesai_cetak` time NOT NULL,
  `status` varchar(20) NOT NULL,
  `jumlah_cetak` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cetak`
--

INSERT INTO `cetak` (`id_cetak`, `id_percetakan`, `username`, `sesi`, `jam_masuk_cetak`, `jam_selesai_cetak`, `status`, `jumlah_cetak`) VALUES
(1, 10, 'dika', 1, '00:00:00', '00:00:00', 'Menunggu', 450),
(2, 11, 'dika', 1, '11:46:00', '13:57:36', 'Selesai', 450),
(3, 11, 'dika', 2, '13:56:13', '20:36:38', 'Selesai', 420),
(4, 14, 'dika', 1, '20:36:55', '22:05:55', 'Selesai', 500),
(5, 13, 'dika', 1, '22:06:07', '00:00:00', 'Proses', 480),
(6, 15, 'dika', 1, '01:01:23', '01:17:08', 'Selesai', 480),
(7, 16, 'dika', 1, '08:50:23', '08:50:31', 'Selesai', 500),
(8, 16, 'dika', 2, '09:27:24', '00:00:00', 'Proses', 500),
(11, 16, 'dika', 3, '10:04:42', '00:00:00', 'Proses', 420);

-- --------------------------------------------------------

--
-- Struktur dari tabel `finishing`
--

CREATE TABLE `finishing` (
  `id_finishing` int(11) NOT NULL,
  `id_percetakan` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `jam_masuk_finishing` time NOT NULL,
  `jam_selesai_finishing` time NOT NULL,
  `status` varchar(20) NOT NULL,
  `jumlah_edaran` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `finishing`
--

INSERT INTO `finishing` (`id_finishing`, `id_percetakan`, `username`, `jam_masuk_finishing`, `jam_selesai_finishing`, `status`, `jumlah_edaran`) VALUES
(5, 13, 'rizki', '00:39:54', '00:56:53', 'Selesai', 1601),
(7, 14, 'rizki', '00:57:19', '08:31:05', 'Selesai', 1605),
(8, 15, 'rizki', '08:31:27', '08:37:17', 'Selesai', 450);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `hak_akses` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `nama_pengguna`, `hak_akses`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Admin'),
('bayu', 'a430e06de5ce438d499c2e4063d60fd6', 'Bayu Sugara', 'Pre Cetak'),
('dian', 'f97de4a9986d216a6e0fea62b0450da9', 'A. D. Dian Kurniawan', 'Pimpinan'),
('dika', 'e9ce15bcebcedde2cb3cf9fe8f84fc0c', 'Mahardika Kharisma Adjie', 'Cetak'),
('rizki', '3e089c076bf1ec3a8332280ee35c28d4', 'Rizki Trybudiman', 'Finishing'),
('zul', '1cf440e0df367e8a74becfa88ba0595a', 'Zulkarnain', 'Pre Cetak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `percetakan`
--

CREATE TABLE `percetakan` (
  `id_percetakan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_koran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `percetakan`
--

INSERT INTO `percetakan` (`id_percetakan`, `tanggal`, `nama_koran`) VALUES
(1, '2018-10-18', 'Metro Riau'),
(3, '2018-10-18', 'Haluan Riau'),
(4, '2018-10-17', 'Haluan Riau'),
(8, '2018-10-24', 'Metro Riau'),
(10, '2018-10-25', 'Metro Riau'),
(11, '2018-10-26', 'Metro Riau'),
(12, '2018-10-26', 'Haluan Riau'),
(13, '2018-10-27', 'Metro Riau'),
(14, '2018-10-27', 'Haluan Riau'),
(15, '2018-10-28', 'Kompas'),
(16, '2018-10-28', 'Riau MX');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pre_cetak`
--

CREATE TABLE `pre_cetak` (
  `id_pre_cetak` int(11) NOT NULL,
  `id_percetakan` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sesi` int(1) NOT NULL,
  `jam_masuk_pre_cetak` time NOT NULL,
  `jam_selesai_pre_cetak` time NOT NULL,
  `sumber_berita` varchar(50) NOT NULL,
  `penerima_berita` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pre_cetak`
--

INSERT INTO `pre_cetak` (`id_pre_cetak`, `id_percetakan`, `username`, `sesi`, `jam_masuk_pre_cetak`, `jam_selesai_pre_cetak`, `sumber_berita`, `penerima_berita`, `status`) VALUES
(1, 1, 'zul', 1, '02:04:09', '21:30:00', 'Olahraga', 'Zul', 'Proses'),
(2, 1, 'zul', 2, '21:30:00', '22:00:00', 'Nasional', 'Rizki', 'Menunggu'),
(3, 3, 'zul', 1, '00:00:00', '01:00:00', 'Nasional', 'Wirya', 'Menunggu'),
(4, 3, 'zul', 2, '00:00:00', '00:00:00', 'Masyarakat', 'Beno', 'Menunggu'),
(5, 3, 'zul', 3, '20:33:37', '00:00:00', 'Olahraga', 'Rizki', 'Proses'),
(6, 4, 'zul', 1, '17:45:18', '17:45:27', 'Olahraga', 'Beno', 'Selesai'),
(7, 8, 'zul', 1, '00:38:10', '01:05:19', 'Nasional', 'Dian', 'Selesai'),
(8, 8, 'zul', 2, '00:43:45', '01:05:25', 'Olahraga', 'Rizki', 'Selesai'),
(10, 10, 'zul', 1, '01:10:20', '01:11:48', 'Nasional', 'Nurhayati', 'Selesai'),
(11, 10, 'zul', 2, '01:20:44', '00:00:00', 'Olahraga', 'Dini', 'Proses'),
(12, 10, 'bayu', 3, '20:44:04', '00:00:00', 'Masyarakat', 'Fitrah', 'Proses'),
(13, 11, 'zul', 1, '16:39:54', '18:46:07', 'Nasional', 'Beno', 'Selesai'),
(14, 11, 'zul', 2, '18:46:13', '00:00:00', 'Masyarakat', 'Beno', 'Proses'),
(15, 11, 'zul', 3, '04:04:33', '00:00:00', 'Olahraga', 'Rizki', 'Proses'),
(16, 12, 'zul', 1, '23:02:51', '04:03:58', 'Nasional', 'Beno', 'Selesai'),
(17, 12, 'zul', 2, '04:04:15', '04:04:28', 'Olahraga', 'Rizki', 'Selesai'),
(18, 13, 'zul', 1, '04:05:13', '00:00:00', 'Olahraga', 'Dini', 'Proses'),
(19, 13, 'zul', 2, '22:07:03', '00:00:00', 'Masyarakat', 'Beno', 'Proses'),
(20, 14, 'zul', 1, '00:00:00', '00:00:00', 'Nasional', 'Beno', 'Menunggu'),
(21, 15, 'zul', 1, '00:58:58', '00:00:00', 'Masyarakat', 'Dian', 'Proses'),
(22, 16, 'zul', 1, '09:36:27', '09:59:30', 'Nasional', 'Dini', 'Selesai'),
(23, 16, 'zul', 2, '09:37:36', '10:01:58', 'Olahraga', 'Beno', 'Selesai'),
(25, 16, 'zul', 3, '10:02:06', '10:02:19', 'Masyarakat', 'Beno', 'Selesai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cetak`
--
ALTER TABLE `cetak`
  ADD PRIMARY KEY (`id_cetak`),
  ADD KEY `fk2` (`id_percetakan`),
  ADD KEY `fk5` (`username`);

--
-- Indexes for table `finishing`
--
ALTER TABLE `finishing`
  ADD PRIMARY KEY (`id_finishing`),
  ADD KEY `fk3` (`id_percetakan`),
  ADD KEY `fk6` (`username`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `percetakan`
--
ALTER TABLE `percetakan`
  ADD PRIMARY KEY (`id_percetakan`);

--
-- Indexes for table `pre_cetak`
--
ALTER TABLE `pre_cetak`
  ADD PRIMARY KEY (`id_pre_cetak`),
  ADD KEY `fk1` (`id_percetakan`),
  ADD KEY `fk4` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cetak`
--
ALTER TABLE `cetak`
  MODIFY `id_cetak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `finishing`
--
ALTER TABLE `finishing`
  MODIFY `id_finishing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `percetakan`
--
ALTER TABLE `percetakan`
  MODIFY `id_percetakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `pre_cetak`
--
ALTER TABLE `pre_cetak`
  MODIFY `id_pre_cetak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cetak`
--
ALTER TABLE `cetak`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`id_percetakan`) REFERENCES `percetakan` (`id_percetakan`),
  ADD CONSTRAINT `fk5` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`);

--
-- Ketidakleluasaan untuk tabel `finishing`
--
ALTER TABLE `finishing`
  ADD CONSTRAINT `fk3` FOREIGN KEY (`id_percetakan`) REFERENCES `percetakan` (`id_percetakan`),
  ADD CONSTRAINT `fk6` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`);

--
-- Ketidakleluasaan untuk tabel `pre_cetak`
--
ALTER TABLE `pre_cetak`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`id_percetakan`) REFERENCES `percetakan` (`id_percetakan`),
  ADD CONSTRAINT `fk4` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
