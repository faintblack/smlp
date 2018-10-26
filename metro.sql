-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17 Okt 2018 pada 07.38
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
  `tanggal` date NOT NULL,
  `nama_koran` varchar(50) NOT NULL,
  `sesi` int(1) NOT NULL,
  `jam_masuk_cetak` time NOT NULL,
  `jam_selesai_cetak` time NOT NULL,
  `status` varchar(20) NOT NULL,
  `jumlah_cetak` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cetak`
--

INSERT INTO `cetak` (`id_cetak`, `tanggal`, `nama_koran`, `sesi`, `jam_masuk_cetak`, `jam_selesai_cetak`, `status`, `jumlah_cetak`) VALUES
(1, '2018-10-16', 'Metro Riau', 1, '00:00:00', '00:30:00', 'Selesai', 500),
(2, '2018-10-16', 'Metro Riau', 2, '00:30:00', '01:00:00', 'Selesai', 450),
(3, '2018-10-16', 'Metro Riau', 3, '01:00:00', '01:40:00', 'Proses', 420),
(4, '2018-10-16', 'Haluan Riau', 1, '00:10:00', '00:40:00', 'Selesai', 450),
(5, '2018-10-16', 'Haluan Riau', 2, '00:40:00', '01:10:00', 'Selesai', 400),
(6, '2018-10-15', 'Haluan Riau', 1, '00:00:00', '00:25:00', 'Selesai', 480),
(7, '2018-10-16', 'Haluan Riau', 3, '01:10:00', '01:40:00', 'Proses', 400),
(8, '2018-10-16', 'Haluan Riau', 4, '01:40:00', '02:10:00', 'Menunggu', 390);

-- --------------------------------------------------------

--
-- Struktur dari tabel `finishing`
--

CREATE TABLE `finishing` (
  `id_finishing` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_koran` varchar(50) NOT NULL,
  `jam_masuk_finishing` time NOT NULL,
  `jam_selesai_finishing` time NOT NULL,
  `status` varchar(20) NOT NULL,
  `jumlah_edaran` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `finishing`
--

INSERT INTO `finishing` (`id_finishing`, `tanggal`, `nama_koran`, `jam_masuk_finishing`, `jam_selesai_finishing`, `status`, `jumlah_edaran`) VALUES
(1, '2018-10-16', 'Metro Riau', '02:00:00', '02:30:00', 'Selesai', 1350),
(2, '2018-10-16', 'Haluan Riau', '02:00:00', '02:30:00', 'Proses', 1635),
(5, '2018-10-15', 'Haluan Riau', '03:00:00', '03:50:00', 'Menunggu', 350);

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `pre_cetak`
--

CREATE TABLE `pre_cetak` (
  `id_pre_cetak` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_koran` varchar(50) NOT NULL,
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

INSERT INTO `pre_cetak` (`id_pre_cetak`, `tanggal`, `nama_koran`, `sesi`, `jam_masuk_pre_cetak`, `jam_selesai_pre_cetak`, `sumber_berita`, `penerima_berita`, `status`) VALUES
(1, '2018-10-15', 'Metro Riau', 1, '22:00:00', '22:30:00', 'Nasional', 'Dika', 'Menunggu'),
(2, '2018-10-15', 'Metro Riau', 2, '22:30:00', '23:00:00', 'Olahraga', 'Zul', 'Proses'),
(3, '2018-10-15', 'Metro Riau', 3, '23:00:00', '23:30:00', 'Politik', 'Dian', 'Selesai'),
(4, '2018-10-14', 'Haluan Riau', 1, '19:00:00', '20:00:00', 'Olahraga', 'Bayu', 'Selesai'),
(5, '2018-10-15', 'Haluan Riau', 1, '20:15:00', '20:45:00', 'Nasional', 'Beno', 'Selesai'),
(6, '2018-10-15', 'Haluan Riau', 2, '22:30:00', '23:00:00', 'Masyarakat', 'Rizki', 'Selesai'),
(7, '2018-10-15', 'Haluan Riau', 3, '23:00:00', '23:25:00', 'Olahraga', 'Wirya', 'Selesai'),
(8, '2018-10-12', 'Haluan Riau', 1, '00:00:00', '00:30:00', 'Nasional', 'Deni', 'Proses');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cetak`
--
ALTER TABLE `cetak`
  ADD PRIMARY KEY (`id_cetak`);

--
-- Indexes for table `finishing`
--
ALTER TABLE `finishing`
  ADD PRIMARY KEY (`id_finishing`);

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
  ADD PRIMARY KEY (`id_pre_cetak`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cetak`
--
ALTER TABLE `cetak`
  MODIFY `id_cetak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `finishing`
--
ALTER TABLE `finishing`
  MODIFY `id_finishing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `percetakan`
--
ALTER TABLE `percetakan`
  MODIFY `id_percetakan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pre_cetak`
--
ALTER TABLE `pre_cetak`
  MODIFY `id_pre_cetak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
