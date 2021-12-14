-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 07:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

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
-- Table structure for table `data_asisten`
--

CREATE TABLE `data_asisten` (
  `id_dataasisten` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_praktikum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_asisten`
--

INSERT INTO `data_asisten` (`id_dataasisten`, `id_user`, `id_praktikum`) VALUES
(1, 4, 1),
(2, 15, 2);

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
  `deskripsi_file` varchar(1000) DEFAULT NULL,
  `url` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `namafile_materi`, `id_pertemuan`, `judul_materi`, `deskripsi_file`, `url`) VALUES
(3, 'Adytia Dwi Hermawan_Universitas Lambung Mangkurat_PKM-R.pdf', 13, 'SSS', 'Tes data', ''),
(10, 'TROP-SUBTROP_WetlandV2_2016_CIFOR.docx', 15, 'PKM', 'cek', ''),
(11, '03 Jenis Citra.ppsx', 15, 'Citra digital', NULL, ''),
(12, 'mahasiswa-Matkul (1).docx', 15, 'Cek', NULL, ''),
(13, 'Password 123.txt', 17, 'Citra digital', NULL, ''),
(14, '1. Pengantar Metodologi Penelitian.pdf', 17, 'Teesting', 'Tes data', ''),
(15, '03IntelligentAgents.pdf', 17, 'MD', NULL, ''),
(16, '627-2133-1-PB.pdf', 18, 'Teesting', NULL, ''),
(17, '5630-11333-1-SM.pdf', 18, 'Teesting', 'Tes data', ''),
(18, '02.13, TST Prep Test 13, The Listening Section.pdf', 18, 'ss', NULL, ''),
(19, '29697469.pdf', 18, 'kk', NULL, ''),
(20, '8819pengukuran_keselarasan_strategi_teknologi_informasi_dan_strategi_bisnis_dengan_model_luftman.pdf', 18, 'Teesting', 'asa', ''),
(21, '5152-Article Text-45703-2-10-20170227.pdf', 7, 'Text', NULL, ''),
(22, '241408-membangun-database-jurnal-ilmiah-berbasi-87dbd8e7.pdf', 18, 'AAA', NULL, ''),
(23, 'i126-6811-04_04-2018_id_ID.pdf', 19, 'AE', NULL, ''),
(24, '8819pengukuran_keselarasan_strategi_teknologi_informasi_dan_strategi_bisnis_dengan_model_luftman.pdf', 4, 'aaaaaa', NULL, ''),
(25, '29697469.pdf', 20, 'bbbbb', NULL, ''),
(26, 'altstadt.png', 12, 'Cek', 'd', ''),
(30, 'geser.m', 6, 'PKM', NULL, 'https://www.youtube.com/watch?v=qIuEv5WkyaU&list=RDqIuEv5WkyaU&start_radio=1');

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
(20, 'Okay', 'Cekcek', 2),
(21, 'Pertemuan 1', NULL, 7);

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
(6, 'Database', '2022', NULL, NULL, NULL),
(7, 'Pengolahan Citra Digital', '2020', NULL, NULL, NULL);

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
(1, 4, 13),
(7, 21, 15),
(1, 5, 16),
(7, 15, 19),
(7, 16, 20),
(7, 17, 21),
(7, 18, 22),
(7, 19, 23),
(7, 20, 24);

-- --------------------------------------------------------

--
-- Table structure for table `rekrutasisten`
--

CREATE TABLE `rekrutasisten` (
  `id_user` int(25) DEFAULT NULL,
  `praktikum_pilihan1` int(11) NOT NULL,
  `IPK` int(11) NOT NULL,
  `Nohp` varchar(50) NOT NULL,
  `filetranskripnilai` varchar(200) DEFAULT NULL,
  `id_rekrut` int(11) NOT NULL,
  `praktikum_pilihan2` int(11) DEFAULT NULL,
  `nilai_pilihan1` varchar(10) DEFAULT NULL,
  `nilai_pilihan2` varchar(10) DEFAULT NULL
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
(4, 1, 3, 1),
(15, 3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `statusform`
--

CREATE TABLE `statusform` (
  `id_statusform` int(11) NOT NULL,
  `statusform` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statusform`
--

INSERT INTO `statusform` (`id_statusform`, `statusform`) VALUES
(1, 1);

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
  `id_user` int(25) DEFAULT NULL,
  `waktu_submit` timestamp NULL DEFAULT NULL,
  `id_wadahtugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploadtugas`
--

INSERT INTO `uploadtugas` (`id_tugas`, `namafile_tugas`, `id_praktikum`, `id_materi`, `id_user`, `waktu_submit`, `id_wadahtugas`) VALUES
(3, 'mahasiswaasisten.html', 1, NULL, 4, NULL, NULL),
(4, 'PK.sql.zip', 1, NULL, 4, '2021-09-26 05:45:05', NULL),
(12, 'boneka.tif', 1, NULL, 5, '2021-12-14 17:09:15', 1),
(13, 'Coin.png', 1, NULL, 5, '2021-12-14 17:09:15', 1);

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
(4, 'Aji Sukma Ramadhan', 4, '$2y$10$cTQGUq7KqOjLC1OFep1WUOawyaxp8B2mlASU5rraIApTE/QNKZuE6', 'User Image_20210825612620d5c4fa2.jpg', '1810817210006'),
(5, 'Adytia Dwi Hermawan', 4, '$2y$10$G35l0.hXKF7JAY7fB5Uuq.ywHINzswGe6xHMierjuzzgVftf/YHfC', 'User Image_2021091961476a922918b.jpg', '1810817210007'),
(6, 'Eka Setya Wijaya, S.T., M.Kom', 2, '$2y$10$1JQJbvdsUocModb9dYCeAuubvxD2VlvY7ARq8Fbi.DAXuZ8aG9lpG', NULL, '198205082008011010'),
(7, 'Andry Fajar Zulkarnain, S.Kom., M.Kom', 2, '$2y$10$MtIN.6hBMO4tjLKclPINyeULykk6p7NryJWCipmJ.RRBWJHfLqy1u', NULL, '199007272019031018'),
(8, 'Andreyan Rizky Baskara, S.Kom., M.Kom', 2, '$2y$10$P6Of6Saq0phva7xk4eP9SObA2gxaPyZo5h0CVMcfv9KnNn2aCVZsW', 'User Image_202109196146f4fc89f00.jpg', '199307032019031011'),
(9, 'Nurul Fathanah Mustamin, S.Kom., M.Kom', 2, '$2y$10$JQz2hCyR159zogyogvpEBePUNqCwIZjW6xvlji1KWPU1r6acf87bO', NULL, '199110252019032018'),
(10, 'Admin', 1, '$2y$10$xb4chKWaJErcc8tWGoDJXuQmNsh8.MtQ1uli52QyZdqo5Lh/j4lMS', NULL, 'admin'),
(15, 'TAUFIK NUR HIDAYAT', 4, '$2y$10$xNKQ8vPPd4c5Dnfov8prJuU.xG.OcVtIS1fXfdXYAQYSy1HcJRuLS', NULL, '1810817110015'),
(16, 'NOVAL APRIANDA', 4, '$2y$10$80l.VF0Ramgh.plVVbZxJum8os92rD9jF01ONlvFMShalf0pERX.6', NULL, '1810817110017'),
(17, 'FERRY PRATAMA', 4, '$2y$10$IPKm1ZcXeQL3VcfkeiccFemQRIRVlzCEmY.AlW5clT26LlfUKy3OS', NULL, '1810817110018'),
(18, 'SILVIA HANDAYANI', 4, '$2y$10$SIa/EHTvxx4KkZVcPK92CeOHM.siKkxvg86VzwP.btXUUTgu.YCJa', NULL, '1810817120003'),
(19, 'SITI ROHMAH', 4, '$2y$10$FN84jGDKWov.OsOgtYxJD.AID8fSb6000zE5Pojl3BfC4XG1guPfW', NULL, '1810817120006'),
(20, 'RIZKA ARDIYANTI', 4, '$2y$10$4o5V9k.ODH4FXYnqi.04de4HrwE6w4g4wjJZn2rV7lvSAmgdqxbyS', NULL, '1810817120008'),
(21, 'Ir. Yuslena Sari, S.Kom., M.Kom, IPM', 2, '$2y$10$yCToV.htfsIaScR175v2NOmj5jCYwHsUo0GV4Y7s1hSsWD1zx0gYG', NULL, 'dosentesting'),
(22, 'NOVIANI', 4, '$2y$10$OMVEeZhTk97jPTHmj5h7duoRWQpQ0fhx3Pk/YWKic163lQjpdrWve', NULL, '1810817120014'),
(23, 'Ir. Muhammad Alkaff, S.Kom., M.Kom, IPM', 2, '$2y$10$Ujp7QfG3szVTwMKvBOSjqOYPFDuzQXQFurkrFKkELolkmcOzRuwNS', NULL, '198606132015041001'),
(24, 'Mutia Maulida, S.Kom, M.T.I', 2, '$2y$10$uL.jGgD3ISj2J1zjbsnd5eerGPWwDOPMYo3TGx8nAWpYOwP.PcjGu', NULL, '198810272019032013'),
(25, 'WINDI WULANDARI', 4, '$2y$10$xGw434d3mg/VRREsuRJK7.8oy2JaE0vHMDocJbnJDnu17a0XO87hG', NULL, '1810817120009'),
(26, 'ADITA LIA DAMAYANTI', 4, '$2y$10$8ZaTzG1weSTIUcyuzcvbMOi448.GkzTNXnQnd.JVu8pnjjTLI9e56', NULL, '1810817120010'),
(27, 'ANANDA', 4, '$2y$10$e1Qomh.k63wvaLaGmr98o.cZhvZQtqiHHZbuNtnrvTvw8pVfSCtKW', NULL, '1810817120011'),
(28, 'SITI MAHMUDAH', 4, '$2y$10$4K/dWcE4vfHlEvzGHgy5m.TKeYpFCeBCo9L1pGQ5vkrjoHtgEx9EG', NULL, '1810817120012'),
(29, 'NUR WIDYA ANISA MUSLIM', 4, '$2y$10$SWIj8FJg9pTRX.cSU98x8OjPhVnONC5CxKiYHnGmNsyd7OGVWD0re', NULL, '1810817120013'),
(30, 'ELDY YUDA KURNIAWAN', 4, '$2y$10$mMdV03ZN3CXW1qeH3gJboOaB3.CPvxox588TpwiugqAcYB8YyFZM.', NULL, '1810817210001'),
(31, 'MUHAMMAD NOOR SALIM', 4, '$2y$10$HFuphxvugeGKvM66Gz1EVOf02tb71Q4DIuzsOheNvFDAMOZUEXtvO', NULL, '1810817210004'),
(32, 'MAHRUDIN', 4, '$2y$10$OSVdNEIPQI/nj/Y5jDdJ..ImC0AI5CW3avJosR.FcWf/hx8njKYHO', NULL, '1810817210010'),
(33, 'M. BASRI', 4, '$2y$10$6cGX83CWFMrLFyBAQaPvEeQ3oWDGY5R1.6y/iqbMExwwzPdhKUwQS', NULL, '1810817210012'),
(34, 'GUSTI ADITYA AROMATICA FIRDAUS', 4, '$2y$10$xZykkTDG43bJs9924v/dvO9AjNPFqbFO1g1AGwWCNOuSyEEbRL.wm', NULL, '1810817210013'),
(35, 'MUHAMMAD TRI MADYA LESTIYANTO', 4, '$2y$10$HITobAtVByBWpLP/6aPx1eYCRY2pdXTgMwUn.v/jmMitENHYhks5W', NULL, '1810817210014'),
(36, 'SIGIT HERMAWAN', 4, '$2y$10$ybo.P1ZdEUvDVGjZoDIV0.WzNggnZsOdN25Zc/nIsKB56n/jW.mvS', NULL, '1810817210018'),
(37, 'REZI RAHDIANOR', 4, '$2y$10$/X0pZ7eBUT.Vwy.6lfVp4.gN0Wr9gBqQvzpzmqINE.fWGyuPr8Jvu', NULL, '1810817210019'),
(38, 'MUHAMMAD RIZAL', 4, '$2y$10$doE04wAWjk3Gy49a/7LNN.KSgZYgb9ZLjwFZDZ6xwBdqtf8sdzw3i', NULL, '1810817210020'),
(39, 'PUTRI ANANDA', 4, '$2y$10$Y6xb9iYMC9wdNiFLdf5GbetMR9D/.ljHexOu5RU7qQGhQE7OVvlU.', NULL, '1810817220008'),
(40, 'SITI SHEILAWATI', 4, '$2y$10$eeysLiWAS1k4X0aHAoBMSepkvcPTdlkExT98.SNEgcymjMRplIbn2', NULL, '1810817220009'),
(41, 'SITI VIONA INDAH SWARI', 4, '$2y$10$/249kTV3VNHcMA72d1hTQ.XAfDpaetTkeuudRiBO07VGiTpgsVE7a', NULL, '1810817220011'),
(42, 'FARIDAH', 4, '$2y$10$xRn91yF9352B6yXgpTfb8eTYvyEnX8flx6Eq1nS7N0rFrLL9BrOz6', NULL, '1810817220015'),
(43, 'ERIKA MAULIDYA', 4, '$2y$10$KL88mWY0N6ssaOgYN8WTouq9IbvAXNhJEmY8bqE20PUaQOjMy8hYe', NULL, '1810817220017'),
(44, 'EVI', 4, '$2y$10$iRG9Ii.3wE8JbYeeKWYRW.hFnlP2JK9pkz5aPhxuyqudxLzzZaANi', NULL, '1810817220021'),
(45, 'MUHAMMAD DIMAS PRIMA AL FATHUSSHAFA', 4, '$2y$10$yeRScVHEq1tYghC134DHSeP8do.O0hhR7Cw0baqz6blwf80gn3Oh2', NULL, '1810817310004'),
(46, 'MUHAMMAD AZZAM BAGASWARA', 4, '$2y$10$jmdBc9u057aL9Gusjgb1Ne2upsB7ECQCVMoIcGVXbOGLSymSXSfpa', NULL, '1810817310002'),
(47, 'MUHAMMAD AZMI HAIDAR', 4, '$2y$10$iFc/FogHT8crTHIIRDHkC.W0wQvVUMEKGqYYIjIfkWKhh9bq1IXUG', NULL, '1810817310003'),
(48, 'M.ZILDHAN REYNALDI', 4, '$2y$10$ONsCNNLX7GO0gjwfm26pse7nwIE4VXk/wZA3BtszPGW7vEK91HNrK', NULL, '1810817310006'),
(49, 'AISYAH AWALIYAH', 4, '$2y$10$9MyWFLrJQNSaktVPf82fWuXrv/jcbg6UVum.wrX9EPj29uXyXUoje', NULL, '1810817310007'),
(50, 'AINIYYAH', 4, '$2y$10$kv5N7RmKXId.aAn3hx/MDe9r2kpAOetXgE2q9HkJrn2J196qXZxT2', NULL, '1810817320001'),
(51, 'FAZRIANOR', 4, '$2y$10$yPkMwODAo44w6dVmJK7pn.CKpvXoea/G8M6Abv2LKCBByLhiCa6ei', NULL, '1810817310009'),
(52, 'MUHAMMAD RIFQI HANIF FISKIA NUR', 4, '$2y$10$szfZCegwv4Pzry3T6g2nNeudHEI/sHxRgBSD2cL5j97JQxqpEyhce', NULL, '1810817310010'),
(53, 'MOCHAMAD ADEN ARDIANSYAH', 4, '$2y$10$A4PGRxHkz/t5r5fMjsvkW.5vn.PijMO3SU0QQ0okIsBo0DB8seCJW', NULL, '1810817310011'),
(54, 'CHRISANTO P.BURONGAN', 4, '$2y$10$2RlCt4a4XvhIEyps4G0.jOUSzlZWwAtdqTbPDKRlI51qkGqfxsBA2', NULL, '1810817710001'),
(55, 'GALIH AL FRYO', 4, '$2y$10$8cktJKZBgfBMQf3Y1hKrv.MsxWvDKnCWvTfLgoiTQHzvVFjGJ0Eq2', NULL, '1810817110001'),
(56, 'RIZKI APRIDO ROSGA', 4, '$2y$10$GhdIimY/W8D8Y.cohdhwqezQGhs7dY7ou/.Hmt/VxJnU3D8/.lOC2', NULL, '1810817110002'),
(57, 'RYAN RAMEL', 4, '$2y$10$v0SBPy2TnXvZzXxBtnyqK.H4Uu9XZGn9sAAuWyOjrCt0MKRv.BX/S', NULL, '1810817110005'),
(88, 'mhs1', 4, '$2y$10$x9CoHTK8.QOA3zfLkguBkejQkqlYa2/q56oPMtobukdS0YE52YP6K', NULL, '1111111111'),
(89, 'mhs2', 4, '$2y$10$RxmlV/s.nmCqX65gkgV0Guis0tLWYv.1dECdgDDLIs6NtFAvyLy1.', NULL, '2222222222'),
(90, 'mhs3', 4, '$2y$10$hV.epkNkZLyEVUEees2LpunlOt2yze.mTBRyr90aZN6Yu8f9M/aqa', NULL, '33333333333');

-- --------------------------------------------------------

--
-- Table structure for table `wadahform`
--

CREATE TABLE `wadahform` (
  `id_form` int(11) NOT NULL,
  `id_praktikum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wadahform`
--

INSERT INTO `wadahform` (`id_form`, `id_praktikum`) VALUES
(2, 1),
(1, 2),
(3, 3),
(4, 5);

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
(4, 2, 'Algoritma Dasar', '2021-09-19 23:11:00', '2021-09-19 11:11:00', '2021-09-19', 1),
(5, 2, 'Algoritma Dasar 2', '2021-09-20 00:39:00', '2021-09-20 12:39:00', '2021-09-22', 2),
(8, 1, 'Algoritma Dasar 3', '2021-09-20 00:40:00', '2021-09-20 12:40:00', '2021-09-21', 3);

-- --------------------------------------------------------

--
-- Table structure for table `wadah_tugas`
--

CREATE TABLE `wadah_tugas` (
  `url` varchar(1000) DEFAULT NULL,
  `id_wadahtugas` int(11) NOT NULL,
  `file_tugas` varchar(250) DEFAULT NULL,
  `judul_tugas` varchar(250) DEFAULT NULL,
  `deskripsi_tugas` varchar(10000) DEFAULT NULL,
  `id_pertemuan` int(11) DEFAULT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `waktu_cutoff` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wadah_tugas`
--

INSERT INTO `wadah_tugas` (`url`, `id_wadahtugas`, `file_tugas`, `judul_tugas`, `deskripsi_tugas`, `id_pertemuan`, `waktu_mulai`, `waktu_selesai`, `waktu_cutoff`) VALUES
(NULL, 1, 'tugas.html', 'Tugas 1', 'Tes data', 6, '2021-09-26 23:59:59', '2021-09-27 23:59:50', NULL),
(NULL, 2, 'tugas (1).html', 'Tugas 2', 'Halo', 11, '2021-12-07 14:26:57', '2021-12-30 14:27:03', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_asisten`
--
ALTER TABLE `data_asisten`
  ADD PRIMARY KEY (`id_dataasisten`),
  ADD KEY `userasisten` (`id_user`),
  ADD KEY `praktikumasisten` (`id_praktikum`);

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
  ADD KEY `userasisten` (`id_user`),
  ADD KEY `praktikum1fk` (`praktikum_pilihan1`),
  ADD KEY `praktikum2fk` (`praktikum_pilihan2`);

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
  ADD KEY `usertugas` (`id_user`),
  ADD KEY `fk_wadahtugas` (`id_wadahtugas`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statususer` (`id_status`);

--
-- Indexes for table `wadahform`
--
ALTER TABLE `wadahform`
  ADD PRIMARY KEY (`id_form`),
  ADD KEY `fkpraktikum` (`id_praktikum`);

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
-- AUTO_INCREMENT for table `data_asisten`
--
ALTER TABLE `data_asisten`
  MODIFY `id_dataasisten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pertemuan`
--
ALTER TABLE `pertemuan`
  MODIFY `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `praktikum`
--
ALTER TABLE `praktikum`
  MODIFY `id_praktikum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proses_praktikum`
--
ALTER TABLE `proses_praktikum`
  MODIFY `id_proses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rekrutasisten`
--
ALTER TABLE `rekrutasisten`
  MODIFY `id_rekrut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `wadahform`
--
ALTER TABLE `wadahform`
  MODIFY `id_form` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wadahpresensi`
--
ALTER TABLE `wadahpresensi`
  MODIFY `id_wadah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wadah_tugas`
--
ALTER TABLE `wadah_tugas`
  MODIFY `id_wadahtugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_asisten`
--
ALTER TABLE `data_asisten`
  ADD CONSTRAINT `praktikumasisten` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userasisten` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `praktikum1fk` FOREIGN KEY (`praktikum_pilihan1`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `praktikum2fk` FOREIGN KEY (`praktikum_pilihan2`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `fk_wadahtugas` FOREIGN KEY (`id_wadahtugas`) REFERENCES `wadah_tugas` (`id_wadahtugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usertugas` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `statususer` FOREIGN KEY (`id_status`) REFERENCES `status_user` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wadahform`
--
ALTER TABLE `wadahform`
  ADD CONSTRAINT `fkpraktikum` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE;

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
