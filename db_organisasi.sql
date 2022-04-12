-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_organisasi
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `divisi`
--

DROP TABLE IF EXISTS `divisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_divisi` varchar(255) NOT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisi`
--

LOCK TABLES `divisi` WRITE;
/*!40000 ALTER TABLE `divisi` DISABLE KEYS */;
INSERT INTO `divisi` VALUES (1,'Pendidikan dan Pelatihan'),(2,'Rohani'),(3,'Pengembangan Minat dan Bakat'),(4,'Komunikasi Teknologi dan Informasi'),(7,'Non Divisi');
/*!40000 ALTER TABLE `divisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jabatan`
--

DROP TABLE IF EXISTS `jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jabatan`
--

LOCK TABLES `jabatan` WRITE;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` VALUES (1,'Staff'),(4,'Ketua Divisi'),(7,'Sekretaris'),(8,'Bendahara'),(10,'Pembina');
/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengurus`
--

DROP TABLE IF EXISTS `pengurus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengurus` (
  `id_pengurus` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `semester` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  PRIMARY KEY (`id_pengurus`),
  KEY `id_jabatan` (`id_jabatan`),
  KEY `id_divisi` (`id_divisi`),
  CONSTRAINT `pengurus_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengurus_ibfk_2` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengurus`
--

LOCK TABLES `pengurus` WRITE;
/*!40000 ALTER TABLE `pengurus` DISABLE KEYS */;
INSERT INTO `pengurus` VALUES (4,'2004191','Muhammad Azar Nuzy',4,'foto1.jpg',8,1),(5,'2004192','Muhammad Zakaria S',3,'foto2.png',4,3),(6,'2004193','Sekar Madu Kusumawardani',2,'foto3.png',7,2);
/*!40000 ALTER TABLE `pengurus` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-12 13:25:14
