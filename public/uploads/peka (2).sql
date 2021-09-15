/*
SQLyog Enterprise v12.5.1 (64 bit)
MySQL - 10.4.10-MariaDB : Database - peka
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`peka` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `peka`;

/*Table structure for table `file` */

DROP TABLE IF EXISTS `file`;

CREATE TABLE `file` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(50) NOT NULL,
  `id_materi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_file`),
  KEY `materifile` (`id_materi`),
  CONSTRAINT `materifile` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `file` */

/*Table structure for table `lab` */

DROP TABLE IF EXISTS `lab`;

CREATE TABLE `lab` (
  `id_laboratorium` int(11) NOT NULL AUTO_INCREMENT,
  `nama_laboratorium` varchar(200) DEFAULT NULL,
  `id_kepalalaboratorium` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_laboratorium`),
  KEY `userkepalalab` (`id_kepalalaboratorium`),
  CONSTRAINT `userkepalalab` FOREIGN KEY (`id_kepalalaboratorium`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `lab` */

insert  into `lab`(`id_laboratorium`,`nama_laboratorium`,`id_kepalalaboratorium`) values 
(1,'Laboratorium Rekayasa Perangkat Lunak',7),
(2,'Laboratorium Jaringan dan',8),
(3,'Laboratorium Komputer Das',9);

/*Table structure for table `materi` */

DROP TABLE IF EXISTS `materi`;

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL AUTO_INCREMENT,
  `namafile_materi` varchar(250) DEFAULT NULL,
  `id_pertemuan` int(11) DEFAULT NULL,
  `judul_materi` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_materi`),
  KEY `fk_materipertemuan` (`id_pertemuan`),
  CONSTRAINT `fk_materipertemuan` FOREIGN KEY (`id_pertemuan`) REFERENCES `pertemuan` (`id_pertemuan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `materi` */

/*Table structure for table `nilai` */

DROP TABLE IF EXISTS `nilai`;

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `nilai` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `id_user` int(25) NOT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `nilaimateri` (`id_materi`),
  KEY `usernilai` (`id_user`),
  CONSTRAINT `nilaimateri` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usernilai` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `nilai` */

/*Table structure for table `pertemuan` */

DROP TABLE IF EXISTS `pertemuan`;

CREATE TABLE `pertemuan` (
  `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pertemuan` varchar(250) DEFAULT NULL,
  `deskripsi` varchar(2500) DEFAULT NULL,
  `id_praktikum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pertemuan`),
  KEY `pertemuanfk` (`id_praktikum`),
  CONSTRAINT `pertemuanfk` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pertemuan` */

insert  into `pertemuan`(`id_pertemuan`,`nama_pertemuan`,`deskripsi`,`id_praktikum`) values 
(1,'Pertemuan 1','cek',2),
(4,'Pertemuan 2','kk',2);

/*Table structure for table `praktikum` */

DROP TABLE IF EXISTS `praktikum`;

CREATE TABLE `praktikum` (
  `id_praktikum` int(11) NOT NULL AUTO_INCREMENT,
  `nama_praktikum` varchar(50) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `jam_praktikum` time DEFAULT NULL,
  `id_lab` int(11) DEFAULT NULL,
  `hari_praktikum` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_praktikum`),
  KEY `labpraktikum` (`id_lab`),
  CONSTRAINT `labpraktikum` FOREIGN KEY (`id_lab`) REFERENCES `lab` (`id_laboratorium`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `praktikum` */

insert  into `praktikum`(`id_praktikum`,`nama_praktikum`,`tahun_ajaran`,`jam_praktikum`,`id_lab`,`hari_praktikum`) values 
(1,'Basis Data I','2021','13:30:00',NULL,'Senin'),
(2,'Algoritma dan Struktur Data','2021','10:00:00',NULL,'Selasa'),
(3,'Pemrograman Web I','2021','08:30:00',NULL,'Rabu');

/*Table structure for table `presensi` */

DROP TABLE IF EXISTS `presensi`;

CREATE TABLE `presensi` (
  `id_presensi` int(11) NOT NULL AUTO_INCREMENT,
  `fotottd_presensi` varchar(20) DEFAULT NULL,
  `id_user` int(25) NOT NULL,
  `waktu_presensi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_wadah` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_presensi`),
  KEY `userpresensi` (`id_user`),
  KEY `wadahpresentfk` (`id_wadah`),
  CONSTRAINT `userpresensi` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wadahpresentfk` FOREIGN KEY (`id_wadah`) REFERENCES `wadahpresensi` (`id_wadah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `presensi` */

/*Table structure for table `proses_praktikum` */

DROP TABLE IF EXISTS `proses_praktikum`;

CREATE TABLE `proses_praktikum` (
  `id_praktikum` int(11) DEFAULT NULL,
  `id_user` int(25) DEFAULT NULL,
  `id_proses` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_proses`),
  KEY `praktikum_fk` (`id_praktikum`),
  KEY `userpraktikum` (`id_user`),
  CONSTRAINT `praktikum_fk` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userpraktikum` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `proses_praktikum` */

insert  into `proses_praktikum`(`id_praktikum`,`id_user`,`id_proses`) values 
(2,4,4),
(2,8,5),
(1,8,6),
(2,5,7),
(3,5,8);

/*Table structure for table `rekrutasisten` */

DROP TABLE IF EXISTS `rekrutasisten`;

CREATE TABLE `rekrutasisten` (
  `id_user` int(25) NOT NULL,
  `id_praktikum` int(11) NOT NULL,
  `IPK` int(11) NOT NULL,
  `Nohp` int(11) NOT NULL,
  `filetranskipnilai` varchar(200) DEFAULT NULL,
  `id_rekrut` int(11) NOT NULL AUTO_INCREMENT,
  `semester` varchar(50) DEFAULT NULL,
  `tanggal_pendaftaran` date DEFAULT NULL,
  `tahun_ajaran` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rekrut`),
  KEY `praktikumfk` (`id_praktikum`),
  KEY `userasisten` (`id_user`),
  CONSTRAINT `praktikumfk` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userrekrutfk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `rekrutasisten` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id_user` int(11) DEFAULT NULL,
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` int(11) DEFAULT NULL,
  `id_praktikum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_role`),
  KEY `userroll` (`id_user`),
  KEY `statusrole` (`id_status`),
  KEY `id_praktikum` (`id_praktikum`),
  CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `statusrole` FOREIGN KEY (`id_status`) REFERENCES `status_user` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userroll` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `roles` */

insert  into `roles`(`id_user`,`id_role`,`id_status`,`id_praktikum`) values 
(4,1,3,1);

/*Table structure for table `status_user` */

DROP TABLE IF EXISTS `status_user`;

CREATE TABLE `status_user` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `status_user` */

insert  into `status_user`(`id_status`,`status`) values 
(1,'admin'),
(2,'dosen'),
(3,'asisten'),
(4,'mahasiswa');

/*Table structure for table `statusform` */

DROP TABLE IF EXISTS `statusform`;

CREATE TABLE `statusform` (
  `id_statusform` int(11) NOT NULL AUTO_INCREMENT,
  `statusform` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_statusform`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `statusform` */

insert  into `statusform`(`id_statusform`,`statusform`) values 
(1,1),
(2,0);

/*Table structure for table `uploadtugas` */

DROP TABLE IF EXISTS `uploadtugas`;

CREATE TABLE `uploadtugas` (
  `id_tugas` int(11) NOT NULL AUTO_INCREMENT,
  `namafile_tugas` varchar(30) NOT NULL,
  `id_praktikum` int(11) DEFAULT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `id_user` int(25) DEFAULT NULL,
  PRIMARY KEY (`id_tugas`),
  KEY `fk_materitugas` (`id_materi`),
  KEY `fk_praktikum` (`id_praktikum`),
  KEY `usertugas` (`id_user`),
  CONSTRAINT `fk_materitugas` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_praktikum` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usertugas` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `uploadtugas` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(250) NOT NULL,
  `id_status` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fotouser` varchar(100) DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `statususer` (`id_status`),
  CONSTRAINT `statususer` FOREIGN KEY (`id_status`) REFERENCES `status_user` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`nama_user`,`id_status`,`password`,`fotouser`,`username`) values 
(4,'Aji Sukma Ramadhan',4,'$2y$10$ltFnp.vlTWjmtEu5IpadKe2tKaagdVaambs/Q6v5ZvkADD5YQlYSG','User Image_20210825612620d5c4fa2.jpg','1810817210006'),
(5,'Adytia Dwi Hermawan',4,'$2y$10$GVN7Var7uPiZCq6TR9uz9O2Nt8EWftGP3VRuBtse2NSOL2lFQTts2',NULL,'1810817210007'),
(6,'Eka Setya Wijaya',2,'$2y$10$1JQJbvdsUocModb9dYCeAuubvxD2VlvY7ARq8Fbi.DAXuZ8aG9lpG',NULL,'198205082008011010'),
(7,'Andry Fajar Zulkarnain, S.Kom., M.Kom',2,'$2y$10$MtIN.6hBMO4tjLKclPINyeULykk6p7NryJWCipmJ.RRBWJHfLqy1u',NULL,'199007272019031018'),
(8,'Andreyan Rizky Baskara, S.Kom., M.Kom',2,'$2y$10$rqnVawz.MML38FxfQ32mHu96woJ8M667SzFFUofntJjaqfTKIuC5a',NULL,'199307032019031011'),
(9,'Nurul Fathanah Mustamin, S.Kom., M.Kom',2,'$2y$10$JQz2hCyR159zogyogvpEBePUNqCwIZjW6xvlji1KWPU1r6acf87bO',NULL,'199110252019032018'),
(10,'Admin',1,'$2y$10$xb4chKWaJErcc8tWGoDJXuQmNsh8.MtQ1uli52QyZdqo5Lh/j4lMS',NULL,'admin'),
(11,'tes',4,'$2y$10$U8RHRcJBF29EU8qnDu/tc.i5kBnLv4/mewu9doDbQEUrtFLjohc0S',NULL,'123');

/*Table structure for table `wadah_tugas` */

DROP TABLE IF EXISTS `wadah_tugas`;

CREATE TABLE `wadah_tugas` (
  `id_wadahtugas` int(11) NOT NULL AUTO_INCREMENT,
  `file_tugas` varchar(250) DEFAULT NULL,
  `deskripsi` varchar(10000) DEFAULT NULL,
  `id_pertemuan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_wadahtugas`),
  KEY `wadahtugasfk` (`id_pertemuan`),
  CONSTRAINT `wadahtugasfk` FOREIGN KEY (`id_pertemuan`) REFERENCES `pertemuan` (`id_pertemuan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `wadah_tugas` */

/*Table structure for table `wadahpresensi` */

DROP TABLE IF EXISTS `wadahpresensi`;

CREATE TABLE `wadahpresensi` (
  `id_wadah` int(11) NOT NULL AUTO_INCREMENT,
  `id_praktikum` int(11) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_berakhir` datetime DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `urutanpertemuan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_wadah`),
  KEY `wadahpresensifk` (`id_praktikum`),
  CONSTRAINT `praktikumpresensi` FOREIGN KEY (`id_praktikum`) REFERENCES `praktikum` (`id_praktikum`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `wadahpresensifk` FOREIGN KEY (`id_praktikum`) REFERENCES `pertemuan` (`id_pertemuan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `wadahpresensi` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
