-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2022 at 02:21 AM
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
  `kategori` varchar(30) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `afiliasi` varchar(50) NOT NULL,
  `tahun_usulan` date NOT NULL,
  `tahun_kegiatan` date NOT NULL,
  `tahun_pelaksanaan` date NOT NULL,
  `lama_kegiatan` varchar(20) NOT NULL,
  `dana_dikti` int(20) NOT NULL,
  `in_kind` int(20) NOT NULL,
  `no_sk_penugasan` int(30) NOT NULL,
  `tanggal_penugasan` date NOT NULL,
  `upload` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penelitian`
--

INSERT INTO `penelitian` (`id_penelitian`, `id_user`, `kategori`, `judul`, `afiliasi`, `tahun_usulan`, `tahun_kegiatan`, `tahun_pelaksanaan`, `lama_kegiatan`, `dana_dikti`, `in_kind`, `no_sk_penugasan`, `tanggal_penugasan`, `upload`) VALUES
(3, 12, 'ketua', 'batu bara', 'unuyo', '2022-12-28', '2022-12-31', '2023-01-04', '6 bulan', 500000, 40000, 2147483647, '2023-01-05', 'Upload Ulang.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `pengabdian`
--

CREATE TABLE `pengabdian` (
  `id_pengabdian` int(10) NOT NULL,
  `id_user` int(30) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `afiliasi` varchar(50) NOT NULL,
  `tahun_usulan` date NOT NULL,
  `tahun_kegiatan` date NOT NULL,
  `tahun_pelaksanaan` date NOT NULL,
  `lama_kegiatan` varchar(20) NOT NULL,
  `dana_dikti` int(20) NOT NULL,
  `in_kind` int(20) NOT NULL,
  `no_sk_penugasan` int(30) NOT NULL,
  `tanggal_penugasan` date NOT NULL,
  `dana_institusi_lain` int(30) NOT NULL,
  `dana_pt` int(30) NOT NULL,
  `mitra` varchar(40) NOT NULL,
  `kategori_mtr` varchar(40) NOT NULL,
  `upload` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengabdian`
--

INSERT INTO `pengabdian` (`id_pengabdian`, `id_user`, `kategori`, `judul`, `afiliasi`, `tahun_usulan`, `tahun_kegiatan`, `tahun_pelaksanaan`, `lama_kegiatan`, `dana_dikti`, `in_kind`, `no_sk_penugasan`, `tanggal_penugasan`, `dana_institusi_lain`, `dana_pt`, `mitra`, `kategori_mtr`, `upload`) VALUES
(2, 12, 'sekretaris', 'minyak bumi', 'unuyo', '2023-01-09', '2023-01-11', '2023-01-13', '1 tahun', 90000000, 450000, 9012345, '2023-01-15', 500000, 8000000, 'cv sejati', 'pelayanan', 'pernyataan_merged.pdf');

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
  `jml_hal` varchar(30) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `isbn` varchar(100) NOT NULL,
  `tautan` varchar(100) NOT NULL,
  `dokumen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publikasi`
--

INSERT INTO `publikasi` (`id_publikasi`, `id_user`, `jenis`, `kategori`, `judul`, `tanggal_terbit`, `jml_hal`, `penerbit`, `isbn`, `tautan`, `dokumen`) VALUES
(2, 13, 'jurnal nasional', 'buku', 'iot tumbuhan', '2022-11-30', '20', 'dr h kardijo', '345612390', 'www.ilm.com', 'template_nilai.pdf'),
(3, 1, 'prosidiy', 'pembicara', 'aplikasi robot', '2022-12-21', '6', 'prof dokamto', '778545535555', 'www.dkm.com', '002-PBR-UTS-MAHASISWA.pdf'),
(7, 13, 'prosidiy', 'buku', 'si kancil', '2022-12-19', '8', 'sidoel', '11223344556677', 'www.fb.com', 'padig_fe_kominfo22.pdf'),
(8, 13, 'jurnal nasional', 'pembicara', 'mc', '2022-12-21', '10', 'simc', '1121341434', 'www.dkm.com', 'RPS Dan Tugas Makalah.pdf'),
(9, 12, 'jurnal internasional bereputasi', 'publikasi', 'intern pub', '2022-12-25', '15', 'mr imran', '980789765091', 'www.ilm.com', 'Basis data_kelompok 10.pdf'),
(10, 12, 'jurnal nasional bereputasi', 'publikasi', 'ai', '2022-12-19', '6', 'dr soekamto', '12345', 'www.c.com', 'INFORMASI.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `repassword` varchar(10) NOT NULL,
  `level` enum('administrator','user') NOT NULL,
  `nama` varchar(30) NOT NULL,
  `nidn` int(10) NOT NULL,
  `prodi` varchar(40) NOT NULL,
  `jafung` varchar(20) NOT NULL,
  `no_wa` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `repassword`, `level`, `nama`, `nidn`, `prodi`, `jafung`, `no_wa`, `tgl_lahir`, `foto`) VALUES
(1, 'admin', 'admin@gmail.com', 'e172dd95f4feb21412a692e73929961e', 'bismillah', 'administrator', 'rava', 1234567891, 'informatika', 'guru besar', '085777123765', '2012-10-01', 'unuyo.png'),
(12, 'agus', 'agus@gmail.com', '01c3c766ce47082b1b130daedd347ffd', 'agus123', 'user', 'agus lena', 2147483647, 'informatika', 'lektor', '081723456981', '2022-11-27', 'css-logo.jpg'),
(13, 'indri', 'indri@gmail.com', '47370fd01903b707d9e393e735b9e22a', 'indri12', 'user', 'indriyanti', 2147483647, 'akuntansi', 'AA', '085678984123', '2022-06-14', 'zhumu background.jpg'),
(26, 'valen', 'va@gmail.com', '3000e0a0b51c05df9739cd6c375c0330', 'valen', 'user', 'valentino', 2147483647, 'farmasi', 'guru besar', '089786543123', '2022-12-06', '');

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
  MODIFY `id_penelitian` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengabdian`
--
ALTER TABLE `pengabdian`
  MODIFY `id_pengabdian` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `publikasi`
--
ALTER TABLE `publikasi`
  MODIFY `id_publikasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
