-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2021 at 07:38 AM
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
-- Database: `pklpkfix`
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
  `id_kepalalaboratorium` int(11) DEFAULT NULL,
  `info_laboratorium` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab`
--

INSERT INTO `lab` (`id_laboratorium`, `nama_laboratorium`, `id_kepalalaboratorium`, `info_laboratorium`) VALUES
(1, 'Laboratorium Rekayasa Perangkat Lunak', 7, NULL),
(2, 'Laboratorium Jaringan dan', 8, NULL),
(3, 'Laboratorium Komputer Das', 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `id_praktikum` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `file_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `id_praktikum`, `name`, `file_path`) VALUES
(1, 3, 'PHPintro.pdf', ''),
(2, NULL, '1629427780_62.pdf', '/fileuploads/1629427780_62.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `id_user` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `nilai`, `id_materi`, `id_user`) VALUES
(1, 90, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `praktikum`
--

CREATE TABLE `praktikum` (
  `id_praktikum` int(11) NOT NULL,
  `nama_praktikum` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `waktu_praktikum` time DEFAULT NULL,
  `id_lab` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktikum`
--

INSERT INTO `praktikum` (`id_praktikum`, `nama_praktikum`, `tahun_ajaran`, `waktu_praktikum`, `id_lab`) VALUES
(1, 'Basis Data I', '2021', '02:00:00', NULL),
(2, 'Algoritma dan Struktur Data', '2021', '02:00:00', NULL),
(3, 'Pemrograman Web I', '2021', '02:00:00', NULL);

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
(3, 'novianittd.png', 1, '2021-03-19 02:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `proses_praktikum`
--

CREATE TABLE `proses_praktikum` (
  `id_praktikum` int(11) DEFAULT NULL,
  `id_user` int(25) DEFAULT NULL,
  `tgl_praktikum` date DEFAULT NULL,
  `id_presensi` int(11) DEFAULT NULL,
  `id_proses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proses_praktikum`
--

INSERT INTO `proses_praktikum` (`id_praktikum`, `id_user`, `tgl_praktikum`, `id_presensi`, `id_proses`) VALUES
(3, 1, '2021-03-19', NULL, 1),
(3, 2, NULL, NULL, 2),
(2, 8, NULL, NULL, 3);

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
-- Table structure for table `rolls`
--

CREATE TABLE `rolls` (
  `roll` varchar(25) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_roll` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'noviani_tugas1.php', 3, 1, 1);

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
(1, 'Noviani', 4, '1810817120014', NULL, ''),
(2, 'Andreyan Rizky Baskara, S.Kom., M.Kom', 2, '', NULL, ''),
(3, 'Eren Jeager', 4, '$2y$10$TrnEksPOkld9fHBI6CeLyu7HgszsGWU2s5j66XDzH8CWXJ1viDaS.', NULL, ''),
(4, 'Aji Sukma Ramadhan', 4, '$2y$10$ltFnp.vlTWjmtEu5IpadKe2tKaagdVaambs/Q6v5ZvkADD5YQlYSG', NULL, ''),
(5, 'Adytia Dwi Hermawana', 3, '$2y$10$GVN7Var7uPiZCq6TR9uz9O2Nt8EWftGP3VRuBtse2NSOL2lFQTts2', NULL, ''),
(6, 'Eka Setya Wijaya', 2, '$2y$10$1JQJbvdsUocModb9dYCeAuubvxD2VlvY7ARq8Fbi.DAXuZ8aG9lpG', NULL, ''),
(7, 'Andry Fajar Zulkarnain, S.Kom., M.Kom', 2, '$2y$10$MtIN.6hBMO4tjLKclPINyeULykk6p7NryJWCipmJ.RRBWJHfLqy1u', NULL, ''),
(8, 'Andreyan Rizky Baskara, S.Kom., M.Kom', 2, '$2y$10$rqnVawz.MML38FxfQ32mHu96woJ8M667SzFFUofntJjaqfTKIuC5a', NULL, '199307032019031011'),
(9, 'Nurul Fathanah Mustamin, S.Kom., M.Kom', 2, '$2y$10$JQz2hCyR159zogyogvpEBePUNqCwIZjW6xvlji1KWPU1r6acf87bO', NULL, ''),
(10, 'Admin', 1, '$2y$10$xb4chKWaJErcc8tWGoDJXuQmNsh8.MtQ1uli52QyZdqo5Lh/j4lMS', NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `wadahpresensi`
--

CREATE TABLE `wadahpresensi` (
  `id_wadah` int(11) NOT NULL,
  `id_praktikum` int(11) DEFAULT NULL,
  `urutanpertemuan` int(11) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_berakhir` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `fk_materipraktikum` (`id_praktikum`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `nilaimateri` (`id_materi`),
  ADD KEY `usernilai` (`id_user`);

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
  ADD KEY `presensipraktikum` (`id_presensi`),
  ADD KEY `userpraktikum` (`id_user`);

--
-- Indexes for table `rekrutasisten`
--
ALTER TABLE `rekrutasisten`
  ADD PRIMARY KEY (`id_rekrut`),
  ADD KEY `praktikumfk` (`id_praktikum`),
  ADD KEY `userasisten` (`id_user`);

--
-- Indexes for table `rolls`
--
ALTER TABLE `rolls`
  ADD PRIMARY KEY (`id_roll`),
  ADD KEY `userroll` (`id_user`);

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
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `praktikum`
--
ALTER TABLE `praktikum`
  MODIFY `id_praktikum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proses_praktikum`
--
ALTER TABLE `proses_praktikum`
  MODIFY `id_proses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rekrutasisten`
--
ALTER TABLE `rekrutasisten`
  MODIFY `id_rekrut` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rolls`
--
ALTER TABLE `rolls`
  MODIFY `id_roll` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wadahpresensi`
--
ALTER TABLE `wadahpresensi`
  MODIFY `id_wadah` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `fk_materipraktikum` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilaimateri` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usernilai` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `presensipraktikum` FOREIGN KEY (`id_presensi`) REFERENCES `presensi` (`id_presensi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userpraktikum` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekrutasisten`
--
ALTER TABLE `rekrutasisten`
  ADD CONSTRAINT `praktikumfk` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userrekrutfk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rolls`
--
ALTER TABLE `rolls`
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
  ADD CONSTRAINT `wadahpresensifk` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
