-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2022 at 07:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onedocument`
--

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

CREATE TABLE `penelitian` (
  `id_penelitian` int(10) NOT NULL,
  `id_user` int(30) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `afiliasi` varchar(50) NOT NULL,
  `tahun_usulan` date NOT NULL,
  `tahun_kegiatan` date NOT NULL,
  `tahun_pelaksanaan` date NOT NULL,
  `lama_kegiatan` date NOT NULL,
  `dana` int(11) NOT NULL,
  `kind` int(11) NOT NULL,
  `sk` int(50) NOT NULL,
  `tanggal_penugasan` date NOT NULL,
  `upload` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian`
--

CREATE TABLE `pengabdian` (
  `id_pengabdian` int(10) NOT NULL,
  `id_user` int(30) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `judul` int(11) NOT NULL,
  `afiliasi` varchar(50) NOT NULL,
  `tahun_usulan` date NOT NULL,
  `tahun_kegiatan` date NOT NULL,
  `tahun_pelaksanaan` date NOT NULL,
  `lama_kegiatan` date NOT NULL,
  `dana_dikti` int(100) NOT NULL,
  `kind` int(100) NOT NULL,
  `sk_penugasan` int(50) NOT NULL,
  `tanggal_penugasan` date NOT NULL,
  `upload` varchar(100) NOT NULL,
  `dana_lain` int(100) NOT NULL,
  `dana_pt` int(100) NOT NULL,
  `mitra` varchar(50) NOT NULL,
  `kategori_mtr` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publikasi`
--

CREATE TABLE `publikasi` (
  `id_publikasi` int(10) NOT NULL,
  `id_user` int(30) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `jurnal` varchar(100) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `isbn` varchar(100) NOT NULL,
  `tautan` varchar(100) NOT NULL,
  `dokumen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('administrator','user') NOT NULL,
  `nama` varchar(30) NOT NULL,
  `nidn` int(10) NOT NULL,
  `prodi` varchar(30) NOT NULL,
  `jafung` varchar(20) NOT NULL,
  `no_wa` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `foto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `level`, `nama`, `nidn`, `prodi`, `jafung`, `no_wa`, `tgl_lahir`, `foto`) VALUES
(1, 'admin', 'admin@gmail.com', 'e172dd95f4feb21412a692e73929961e', 'administrator', 'rava', 1234567891, 'informatika', 'guru besar', '085777123765', '2012-10-01', 'logo_unu.png'),
(12, 'agus', 'agus@gmail.com', '01c3c766ce47082b1b130daedd347ffd', 'user', 'agus lena', 1234567892, 'informatika', 'guru besar', '081723456981', '2022-11-27', 'onedoc.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD PRIMARY KEY (`id_penelitian`);

--
-- Indexes for table `pengabdian`
--
ALTER TABLE `pengabdian`
  ADD PRIMARY KEY (`id_pengabdian`);

--
-- Indexes for table `publikasi`
--
ALTER TABLE `publikasi`
  ADD PRIMARY KEY (`id_publikasi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `penelitian`
--
ALTER TABLE `penelitian`
  MODIFY `id_penelitian` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publikasi`
--
ALTER TABLE `publikasi`
  MODIFY `id_publikasi` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
