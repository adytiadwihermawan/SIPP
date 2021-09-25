-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2021 at 02:39 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pk`
--

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id_file` int(11) NOT NULL,
  `nama_file` varchar(50) NOT NULL,
  `id_materi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lab`
--

CREATE TABLE `lab` (
  `id_laboratorium` int(11) NOT NULL,
  `nama_laboratorium` varchar(200) DEFAULT NULL,
  `id_kepalalaboratorium` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id_laboratorium`, `nama_laboratorium`, `id_kepalalaboratorium`) VALUES
(1, 'Laboratorium Rekayasa Perangkat Lunak', 7),
(2, 'Laboratorium Jaringan dan', 8),
(3, 'Laboratorium Komputer Das', 9);

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `namafile_materi` varchar(250) DEFAULT NULL,
  `id_pertemuan` int(11) DEFAULT NULL,
  `judul_materi` varchar(500) DEFAULT NULL,
  `deskripsi_file` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `namafile_materi`, `id_pertemuan`, `judul_materi`, `deskripsi_file`) VALUES
(3, 'Adytia Dwi Hermawan_Universitas Lambung Mangkurat_PKM-R.pdf', 13, 'SSS', 'Tes data'),
(10, 'TROP-SUBTROP_WetlandV2_2016_CIFOR.docx', 15, 'PKM', 'cek'),
(11, '03 Jenis Citra.ppsx', 15, 'Citra digital', NULL),
(12, 'mahasiswa-Matkul (1).docx', 15, 'Cek', NULL),
(13, 'Password 123.txt', 17, 'Citra digital', NULL),
(14, '1. Pengantar Metodologi Penelitian.pdf', 17, 'Teesting', 'Tes data'),
(15, '03IntelligentAgents.pdf', 17, 'MD', NULL),
(16, '627-2133-1-PB.pdf', 18, 'Teesting', NULL),
(17, '5630-11333-1-SM.pdf', 18, 'Teesting', 'Tes data'),
(18, '02.13, TST Prep Test 13, The Listening Section.pdf', 18, 'ss', NULL),
(19, '29697469.pdf', 18, 'kk', NULL),
(20, '8819pengukuran_keselarasan_strategi_teknologi_informasi_dan_strategi_bisnis_dengan_model_luftman.pdf', 18, 'Teesting', 'asa'),
(21, '5152-Article Text-45703-2-10-20170227.pdf', 7, 'Text', NULL),
(22, '241408-membangun-database-jurnal-ilmiah-berbasi-87dbd8e7.pdf', 18, 'AAA', NULL),
(23, 'i126-6811-04_04-2018_id_ID.pdf', 19, 'AE', NULL),
(24, '8819pengukuran_keselarasan_strategi_teknologi_informasi_dan_strategi_bisnis_dengan_model_luftman.pdf', 4, 'aaaaaa', NULL),
(25, '29697469.pdf', 20, 'bbbbb', NULL),
(26, 'pk.sql', 6, 'Cek', 'ABCD');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pertemuan`
--

CREATE TABLE `pertemuan` (
  `id_pertemuan` int(11) NOT NULL,
  `nama_pertemuan` varchar(250) DEFAULT NULL,
  `deskripsi` varchar(2500) DEFAULT NULL,
  `id_praktikum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pertemuan`
--

INSERT INTO `pertemuan` (`id_pertemuan`, `nama_pertemuan`, `deskripsi`, `id_praktikum`) VALUES
(1, 'Pertemuan 1', 'cek', 2),
(4, 'Pertemuan 2', 'kk', 2),
(6, 'Framework ah', 'n o t h i n g', 1),
(7, 'laravel', 'l a r a v e l', 3),
(11, 'dsds', NULL, 1),
(12, 'Pertemuan 1', 'Cara menggunakan javascript', 4),
(13, 'Pertemuan 3', 'Cara install laravel', 4),
(14, 'Pertemuan 4', 'Basis Data', 4),
(15, 'Pertemuan 3', 'Metode Naive Bayes', 5),
(16, 'Pertemuan 5', 'Basis Data', 4),
(17, 'Pertemuan 6', 'asa', 5),
(18, 'dsds', 'Tes data', 5),
(19, 'Tes', 'ABCD', 5),
(20, 'Okay', 'Cekcek', 2);

-- --------------------------------------------------------

--
-- Table structure for table `praktikum`
--

CREATE TABLE `praktikum` (
  `id_praktikum` int(11) NOT NULL,
  `nama_praktikum` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `jam_praktikum` time DEFAULT NULL,
  `id_lab` int(11) DEFAULT NULL,
  `hari_praktikum` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktikum`
--

INSERT INTO `praktikum` (`id_praktikum`, `nama_praktikum`, `tahun_ajaran`, `jam_praktikum`, `id_lab`, `hari_praktikum`) VALUES
(1, 'Basis Data I', '2021', '13:30:00', NULL, 'Senin'),
(2, 'Algoritma dan Struktur Data', '2021', '10:00:00', NULL, 'Selasa'),
(3, 'Pemrograman Web I', '2021', '08:30:00', NULL, 'Rabu'),
(4, 'Robotik', '2021', NULL, NULL, NULL),
(5, 'Sistem Cerdas', '2021', NULL, NULL, NULL),
(6, 'DB', '2022', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` int(11) NOT NULL,
  `fotottd_presensi` varchar(20) DEFAULT NULL,
  `id_user` int(25) NOT NULL,
  `waktu_presensi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_wadah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id_presensi`, `fotottd_presensi`, `id_user`, `waktu_presensi`, `id_wadah`) VALUES
(15, '614ee00c17c28.png', 4, '2021-09-25 07:38:36', 9);

-- --------------------------------------------------------

--
-- Table structure for table `proses_praktikum`
--

CREATE TABLE `proses_praktikum` (
  `id_praktikum` int(11) DEFAULT NULL,
  `id_user` int(25) DEFAULT NULL,
  `id_proses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proses_praktikum`
--

INSERT INTO `proses_praktikum` (`id_praktikum`, `id_user`, `id_proses`) VALUES
(2, 4, 4),
(2, 8, 5),
(1, 8, 6),
(2, 5, 7),
(3, 5, 8),
(4, 5, 9),
(4, 8, 10),
(5, 8, 11),
(6, 5, 12),
(1, 4, 13);

-- --------------------------------------------------------

--
-- Table structure for table `rekrutasisten`
--

CREATE TABLE `rekrutasisten` (
  `id_user` int(25) NOT NULL,
  `id_praktikum` int(11) NOT NULL,
  `IPK` int(11) NOT NULL,
  `Nohp` int(11) NOT NULL,
  `filetranskipnilai` varchar(200) DEFAULT NULL,
  `id_rekrut` int(11) NOT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `tanggal_pendaftaran` date DEFAULT NULL,
  `tahun_ajaran` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_user` int(11) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `id_status` int(11) DEFAULT NULL,
  `id_praktikum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_user`, `id_role`, `id_status`, `id_praktikum`) VALUES
(4, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `statusform`
--

CREATE TABLE `statusform` (
  `id_statusform` int(11) NOT NULL,
  `statusform` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statusform`
--

INSERT INTO `statusform` (`id_statusform`, `statusform`) VALUES
(1, 1),
(2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_user`
--

CREATE TABLE `status_user` (
  `id_status` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_user`
--

INSERT INTO `status_user` (`id_status`, `status`) VALUES
(1, 'admin'),
(2, 'dosen'),
(3, 'asisten'),
(4, 'mahasiswa');

-- --------------------------------------------------------

--
-- Table structure for table `uploadtugas`
--

CREATE TABLE `uploadtugas` (
  `id_tugas` int(11) NOT NULL,
  `namafile_tugas` varchar(30) NOT NULL,
  `id_praktikum` int(11) DEFAULT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `id_user` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploadtugas`
--

INSERT INTO `uploadtugas` (`id_tugas`, `namafile_tugas`, `id_praktikum`, `id_materi`, `id_user`) VALUES
(2, 'tugas.html', 1, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(25) NOT NULL,
  `nama_user` varchar(250) NOT NULL,
  `id_status` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fotouser` varchar(100) DEFAULT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_user`, `id_status`, `password`, `fotouser`, `username`) VALUES
(4, 'Aji Sukma Ramadhan', 4, '$2y$10$ltFnp.vlTWjmtEu5IpadKe2tKaagdVaambs/Q6v5ZvkADD5YQlYSG', 'User Image_20210825612620d5c4fa2.jpg', '1810817210006'),
(5, 'Adytia Dwi Hermawan', 4, '$2y$10$G35l0.hXKF7JAY7fB5Uuq.ywHINzswGe6xHMierjuzzgVftf/YHfC', 'User Image_2021091961476a922918b.jpg', '1810817210007'),
(6, 'Eka Setya Wijaya', 2, '$2y$10$1JQJbvdsUocModb9dYCeAuubvxD2VlvY7ARq8Fbi.DAXuZ8aG9lpG', NULL, '198205082008011010'),
(7, 'Andry Fajar Zulkarnain, S.Kom., M.Kom', 2, '$2y$10$MtIN.6hBMO4tjLKclPINyeULykk6p7NryJWCipmJ.RRBWJHfLqy1u', NULL, '199007272019031018'),
(8, 'Andreyan Rizky Baskara, S.Kom., M.Kom', 2, '$2y$10$P6Of6Saq0phva7xk4eP9SObA2gxaPyZo5h0CVMcfv9KnNn2aCVZsW', 'User Image_202109196146f4fc89f00.jpg', '199307032019031011'),
(9, 'Nurul Fathanah Mustamin, S.Kom., M.Kom', 2, '$2y$10$JQz2hCyR159zogyogvpEBePUNqCwIZjW6xvlji1KWPU1r6acf87bO', NULL, '199110252019032018'),
(10, 'Admin', 1, '$2y$10$xb4chKWaJErcc8tWGoDJXuQmNsh8.MtQ1uli52QyZdqo5Lh/j4lMS', NULL, 'admin'),
(11, 'tes', 4, '$2y$10$U8RHRcJBF29EU8qnDu/tc.i5kBnLv4/mewu9doDbQEUrtFLjohc0S', NULL, '123');

-- --------------------------------------------------------

--
-- Table structure for table `wadahpresensi`
--

CREATE TABLE `wadahpresensi` (
  `id_wadah` int(11) NOT NULL,
  `id_praktikum` int(11) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_berakhir` datetime DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `urutanpertemuan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wadahpresensi`
--

INSERT INTO `wadahpresensi` (`id_wadah`, `id_praktikum`, `keterangan`, `waktu_mulai`, `waktu_berakhir`, `tanggal`, `urutanpertemuan`) VALUES
(9, 1, 'Coba Absen', '2021-09-25 12:00:21', '2021-09-25 14:58:00', '2021-09-25', 1),
(10, 1, 'Algoritma Dasar', '2021-09-25 13:46:00', '2021-09-25 14:46:00', '2021-09-26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `wadah_tugas`
--

CREATE TABLE `wadah_tugas` (
  `id_wadahtugas` int(11) NOT NULL,
  `judul_tugas` varchar(250) DEFAULT NULL,
  `file_tugas` varchar(250) DEFAULT NULL,
  `deskripsi_tugas` varchar(10000) DEFAULT NULL,
  `id_pertemuan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wadah_tugas`
--

INSERT INTO `wadah_tugas` (`id_wadahtugas`, `judul_tugas`, `file_tugas`, `deskripsi_tugas`, `id_pertemuan`) VALUES
(8, 'Tugas 2', 'DATAUSER (3).xlsx', 'Praktik update button pertemua', 11),
(9, 'Tugas 1', 'tugas.html', 'Tes data', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `materifile` (`id_materi`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`id_laboratorium`),
  ADD KEY `userkepalalab` (`id_kepalalaboratorium`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`),
  ADD KEY `fk_materipertemuan` (`id_pertemuan`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `nilaitugas` (`id_tugas`);

--
-- Indexes for table `pertemuan`
--
ALTER TABLE `pertemuan`
  ADD PRIMARY KEY (`id_pertemuan`),
  ADD KEY `pertemuanfk` (`id_praktikum`);

--
-- Indexes for table `praktikum`
--
ALTER TABLE `praktikum`
  ADD PRIMARY KEY (`id_praktikum`),
  ADD KEY `labpraktikum` (`id_lab`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `userpresensi` (`id_user`),
  ADD KEY `wadahpresentfk` (`id_wadah`);

--
-- Indexes for table `proses_praktikum`
--
ALTER TABLE `proses_praktikum`
  ADD PRIMARY KEY (`id_proses`),
  ADD KEY `praktikum_fk` (`id_praktikum`),
  ADD KEY `userpraktikum` (`id_user`);

--
-- Indexes for table `rekrutasisten`
--
ALTER TABLE `rekrutasisten`
  ADD PRIMARY KEY (`id_rekrut`),
  ADD KEY `praktikumfk` (`id_praktikum`),
  ADD KEY `userasisten` (`id_user`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`),
  ADD KEY `userroll` (`id_user`),
  ADD KEY `statusrole` (`id_status`),
  ADD KEY `id_praktikum` (`id_praktikum`);

--
-- Indexes for table `statusform`
--
ALTER TABLE `statusform`
  ADD PRIMARY KEY (`id_statusform`);

--
-- Indexes for table `status_user`
--
ALTER TABLE `status_user`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `uploadtugas`
--
ALTER TABLE `uploadtugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `fk_materitugas` (`id_materi`),
  ADD KEY `fk_praktikum` (`id_praktikum`),
  ADD KEY `usertugas` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statususer` (`id_status`);

--
-- Indexes for table `wadahpresensi`
--
ALTER TABLE `wadahpresensi`
  ADD PRIMARY KEY (`id_wadah`),
  ADD KEY `wadahpresensifk` (`id_praktikum`);

--
-- Indexes for table `wadah_tugas`
--
ALTER TABLE `wadah_tugas`
  ADD PRIMARY KEY (`id_wadahtugas`),
  ADD KEY `wadahtugasfk` (`id_pertemuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab`
--
ALTER TABLE `lab`
  MODIFY `id_laboratorium` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pertemuan`
--
ALTER TABLE `pertemuan`
  MODIFY `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `praktikum`
--
ALTER TABLE `praktikum`
  MODIFY `id_praktikum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `proses_praktikum`
--
ALTER TABLE `proses_praktikum`
  MODIFY `id_proses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rekrutasisten`
--
ALTER TABLE `rekrutasisten`
  MODIFY `id_rekrut` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `statusform`
--
ALTER TABLE `statusform`
  MODIFY `id_statusform` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_user`
--
ALTER TABLE `status_user`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uploadtugas`
--
ALTER TABLE `uploadtugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wadahpresensi`
--
ALTER TABLE `wadahpresensi`
  MODIFY `id_wadah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wadah_tugas`
--
ALTER TABLE `wadah_tugas`
  MODIFY `id_wadahtugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `materifile` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lab`
--
ALTER TABLE `lab`
  ADD CONSTRAINT `userkepalalab` FOREIGN KEY (`id_kepalalaboratorium`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `fk_materipertemuan` FOREIGN KEY (`id_pertemuan`) REFERENCES `pertemuan` (`id_pertemuan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilaitugas` FOREIGN KEY (`id_tugas`) REFERENCES `uploadtugas` (`id_tugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pertemuan`
--
ALTER TABLE `pertemuan`
  ADD CONSTRAINT `pertemuanfk` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `praktikum`
--
ALTER TABLE `praktikum`
  ADD CONSTRAINT `labpraktikum` FOREIGN KEY (`id_lab`) REFERENCES `lab` (`id_laboratorium`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `userpresensi` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wadahpresentfk` FOREIGN KEY (`id_wadah`) REFERENCES `wadahpresensi` (`id_wadah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `proses_praktikum`
--
ALTER TABLE `proses_praktikum`
  ADD CONSTRAINT `praktikum_fk` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userpraktikum` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekrutasisten`
--
ALTER TABLE `rekrutasisten`
  ADD CONSTRAINT `praktikumfk` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userrekrutfk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `statusrole` FOREIGN KEY (`id_status`) REFERENCES `status_user` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userroll` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uploadtugas`
--
ALTER TABLE `uploadtugas`
  ADD CONSTRAINT `fk_materitugas` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_praktikum` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usertugas` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `statususer` FOREIGN KEY (`id_status`) REFERENCES `status_user` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wadahpresensi`
--
ALTER TABLE `wadahpresensi`
  ADD CONSTRAINT `praktikumpresensi` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wadahpresensifk` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wadah_tugas`
--
ALTER TABLE `wadah_tugas`
  ADD CONSTRAINT `wadahtugasfk` FOREIGN KEY (`id_pertemuan`) REFERENCES `pertemuan` (`id_pertemuan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
