/*
SQLyog Community v13.3.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - db_tiket_kereta
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_tiket_kereta` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `db_tiket_kereta`;

/*Table structure for table `kereta` */

DROP TABLE IF EXISTS `kereta`;

CREATE TABLE `kereta` (
  `id_kereta` varchar(10) NOT NULL,
  `nama_kereta` varchar(100) NOT NULL,
  `tipe_kereta` varchar(50) NOT NULL,
  `kapasitas_total` int(11) NOT NULL,
  PRIMARY KEY (`id_kereta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kereta` */

insert  into `kereta`(`id_kereta`,`nama_kereta`,`tipe_kereta`,`kapasitas_total`) values 
('K-01','Enggang Ekspres','Eksekutif',400),
('K-02','Mahakam Premium','Eksekutif & Ekonomi',500),
('K-03','Kapuas Utama','Eksekutif',450),
('K-04','Barito Jaya','Ekonomi',800),
('K-05','Borneo Indah','Eksekutif & Ekonomi',550);

/*Table structure for table `penumpang` */

DROP TABLE IF EXISTS `penumpang`;

CREATE TABLE `penumpang` (
  `id_penumpang` int(11) NOT NULL AUTO_INCREMENT,
  `NIK` varchar(16) NOT NULL,
  `nama_penumpang` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_penumpang`),
  UNIQUE KEY `NIK` (`NIK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penumpang` */

/*Table structure for table `stasiun` */

DROP TABLE IF EXISTS `stasiun`;

CREATE TABLE `stasiun` (
  `id_stasiun` varchar(10) NOT NULL,
  `nama_stasiun` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  PRIMARY KEY (`id_stasiun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `stasiun` */

insert  into `stasiun`(`id_stasiun`,`nama_stasiun`,`kota`) values 
('BDJ','Banjarmasin','Banjarmasin'),
('BPN','Balikpapan','Balikpapan'),
('PKY','Palangka Raya','Palangka Raya'),
('PNK','Pontianak','Pontianak'),
('SMD','Samarinda','Samarinda'),
('TRK','Tarakan','Tarakan');

/*Table structure for table `jadwal` */

DROP TABLE IF EXISTS `jadwal`;

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_kereta` varchar(10) NOT NULL,
  `id_stasiun_asal` varchar(10) NOT NULL,
  `id_stasiun_tujuan` varchar(10) NOT NULL,
  `waktu_berangkat` datetime NOT NULL,
  `waktu_tiba` datetime NOT NULL,
  `harga_dasar` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `id_kereta` (`id_kereta`),
  KEY `id_stasiun_asal` (`id_stasiun_asal`),
  KEY `id_stasiun_tujuan` (`id_stasiun_tujuan`),
  CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_kereta`) REFERENCES `kereta` (`id_kereta`) ON UPDATE CASCADE,
  CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_stasiun_asal`) REFERENCES `stasiun` (`id_stasiun`) ON UPDATE CASCADE,
  CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`id_stasiun_tujuan`) REFERENCES `stasiun` (`id_stasiun`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jadwal` */

insert into `jadwal`(`id_jadwal`, `id_kereta`, `id_stasiun_asal`, `id_stasiun_tujuan`, `waktu_berangkat`, `waktu_tiba`, `harga_dasar`) values
(1, 'K-01', 'BPN', 'SMD', '2026-05-13 08:30:00', '2026-05-13 11:00:00', 75000),
(2, 'K-01', 'SMD', 'BPN', '2026-05-13 12:30:00', '2026-05-13 15:00:00', 75000),
(3, 'K-02', 'SMD', 'BPN', '2026-05-13 08:30:00', '2026-05-13 11:00:00', 75000),
(4, 'K-02', 'BPN', 'SMD', '2026-05-13 12:30:00', '2026-05-13 15:00:00', 75000),
(5, 'K-03', 'BDJ', 'PKY', '2026-05-14 09:00:00', '2026-05-14 12:00:00', 90000),
(6, 'K-03', 'PKY', 'BDJ', '2026-05-14 13:30:00', '2026-05-14 16:30:00', 90000);

/*Table structure for table `tiket` */

DROP TABLE IF EXISTS `tiket`;

CREATE TABLE `tiket` (
  `id_tiket` int(11) NOT NULL AUTO_INCREMENT,
  `id_penumpang` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `nomor_kursi` varchar(10) NOT NULL,
  `tgl_pembelian` datetime NOT NULL,
  `total_bayar` decimal(10,2) NOT NULL,
  `status_pembayaran` enum('Pending','Lunas','Dibatalkan') DEFAULT 'Pending',
  PRIMARY KEY (`id_tiket`),
  KEY `id_penumpang` (`id_penumpang`),
  KEY `id_jadwal` (`id_jadwal`),
  CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`id_penumpang`) REFERENCES `penumpang` (`id_penumpang`) ON UPDATE CASCADE,
  CONSTRAINT `tiket_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tiket` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
