-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: eagri_pahneh
-- ------------------------------------------------------
-- Server version	5.1.73

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Agri1397_1398`
--

DROP TABLE IF EXISTS `Agri1397_1398`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri1397_1398` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `no_mal` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `md_ab` int(2) NOT NULL,
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` int(2) NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `s_ayesh` float(11,4) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `docId` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `inquiry` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `z_sal` (`z_sal`),
  KEY `m_cod_m` (`m_cod_m`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`)
) ENGINE=MyISAM AUTO_INCREMENT=14492126 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri1398_1399`
--

DROP TABLE IF EXISTS `Agri1398_1399`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri1398_1399` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `no_mal` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `md_ab` int(2) NOT NULL,
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` int(2) NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `s_ayesh` float(11,4) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `docId` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `inquiry` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `z_sal` (`z_sal`),
  KEY `m_cod_m` (`m_cod_m`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`)
) ENGINE=MyISAM AUTO_INCREMENT=4664992 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri1399_1400`
--

DROP TABLE IF EXISTS `Agri1399_1400`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri1399_1400` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `no_mal` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `md_ab` int(2) NOT NULL,
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` int(2) NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `s_ayesh` float(11,4) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `docId` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `inquiry` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `z_sal` (`z_sal`),
  KEY `m_cod_m` (`m_cod_m`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`)
) ENGINE=MyISAM AUTO_INCREMENT=4782946 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri1400_1401`
--

DROP TABLE IF EXISTS `Agri1400_1401`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri1400_1401` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `no_mal` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `md_ab` int(2) NOT NULL,
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` int(2) NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `s_ayesh` float(11,4) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `docId` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `inquiry` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `z_sal` (`z_sal`),
  KEY `m_cod_m` (`m_cod_m`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `num_bah` (`num_bah`)
) ENGINE=MyISAM AUTO_INCREMENT=6320137 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri1401_1402`
--

DROP TABLE IF EXISTS `Agri1401_1402`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri1401_1402` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `no_mal` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `md_ab` int(2) NOT NULL,
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` int(2) NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `s_ayesh` float(11,4) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `docId` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `inquiry` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `z_sal` (`z_sal`),
  KEY `m_cod_m` (`m_cod_m`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`)
) ENGINE=MyISAM AUTO_INCREMENT=7642254 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri1402_1403`
--

DROP TABLE IF EXISTS `Agri1402_1403`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri1402_1403` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `no_mal` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `md_ab` int(2) NOT NULL,
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` int(2) NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `s_ayesh` float(11,4) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `docId` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `z_sal` (`z_sal`),
  KEY `m_cod_m` (`m_cod_m`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`)
) ENGINE=MyISAM AUTO_INCREMENT=8798444 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri1403_1404`
--

DROP TABLE IF EXISTS `Agri1403_1404`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri1403_1404` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `no_mal` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `md_ab` int(2) NOT NULL,
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` int(2) NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `s_ayesh` float(11,4) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `docId` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `z_sal` (`z_sal`),
  KEY `m_cod_m` (`m_cod_m`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`)
) ENGINE=MyISAM AUTO_INCREMENT=9783786 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri1404_1405`
--

DROP TABLE IF EXISTS `Agri1404_1405`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri1404_1405` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `no_mal` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `md_ab` int(2) NOT NULL,
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` int(2) NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `s_ayesh` float(11,4) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `docId` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `z_sal` (`z_sal`),
  KEY `m_cod_m` (`m_cod_m`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`)
) ENGINE=InnoDB AUTO_INCREMENT=10820996 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri1405_1406`
--

DROP TABLE IF EXISTS `Agri1405_1406`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri1405_1406` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `no_mal` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `md_ab` int(2) NOT NULL,
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` int(2) NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `s_ayesh` float(11,4) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `docId` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `z_sal` (`z_sal`),
  KEY `m_cod_m` (`m_cod_m`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`)
) ENGINE=InnoDB AUTO_INCREMENT=10791163 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_ab_city`
--

DROP TABLE IF EXISTS `Agri_ab_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_ab_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `s_abi` float(7,1) NOT NULL,
  `s_dem` float(7,1) NOT NULL,
  `t_abi` float(8,1) NOT NULL,
  `t_dem` float(8,1) NOT NULL,
  `a_abi` float(8,1) NOT NULL,
  `a_dem` float(8,1) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`,`id_city`,`z_sal`,`product_cod`),
  KEY `idx_main` (`z_sal`,`group_cod`,`product_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=129769 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_ab_mar`
--

DROP TABLE IF EXISTS `Agri_ab_mar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_ab_mar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `s_abi` float(7,1) NOT NULL,
  `s_dem` float(7,1) NOT NULL,
  `t_abi` float(8,1) NOT NULL,
  `t_dem` float(8,1) NOT NULL,
  `a_abi` float(8,1) NOT NULL,
  `a_dem` float(8,1) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `z_kesht_abi` float(7,1) NOT NULL,
  `z_kesht_dem` float(7,1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`,`id_city`,`z_sal`,`product_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=513556 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_ab_ostan`
--

DROP TABLE IF EXISTS `Agri_ab_ostan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_ab_ostan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `s_abi` float(7,1) NOT NULL,
  `s_dem` float(7,1) NOT NULL,
  `t_abi` float(8,1) NOT NULL,
  `t_dem` float(8,1) NOT NULL,
  `a_abi` float(8,1) NOT NULL,
  `a_dem` float(8,1) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `group_cod` (`group_cod`),
  KEY `product_cod` (`product_cod`),
  KEY `idx_main` (`z_sal`,`group_cod`,`product_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=2377 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_ab_ostan_14050531`
--

DROP TABLE IF EXISTS `Agri_ab_ostan_14050531`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_ab_ostan_14050531` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `s_abi` float(7,1) NOT NULL,
  `s_dem` float(7,1) NOT NULL,
  `t_abi` float(8,1) NOT NULL,
  `t_dem` float(8,1) NOT NULL,
  `a_abi` float(8,1) NOT NULL,
  `a_dem` float(8,1) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `group_cod` (`group_cod`),
  KEY `product_cod` (`product_cod`),
  KEY `idx_main` (`z_sal`,`group_cod`,`product_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=2377 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_ab_request`
--

DROP TABLE IF EXISTS `Agri_ab_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_ab_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci DEFAULT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci DEFAULT NULL,
  `current_s_abi` decimal(7,1) DEFAULT NULL COMMENT 'سطح آبی ابلاغی فعلی',
  `current_s_dem` decimal(7,1) DEFAULT NULL COMMENT 'سطح دیم ابلاغی فعلی',
  `current_t_abi` decimal(10,1) DEFAULT NULL COMMENT 'تولید آبی ابلاغی فعلی',
  `current_t_dem` decimal(10,1) DEFAULT NULL COMMENT 'تولید دیم ابلاغی فعلی',
  `current_a_abi` decimal(8,2) DEFAULT NULL COMMENT 'عملکرد آبی ابلاغی فعلی',
  `current_a_dem` decimal(8,2) DEFAULT NULL COMMENT 'عملکرد دیم ابلاغی فعلی',
  `request_s_abi` decimal(7,1) DEFAULT NULL COMMENT 'سطح آبی درخواستی کاربر',
  `request_s_dem` decimal(7,1) DEFAULT NULL COMMENT 'سطح دیم درخواستی کاربر',
  `request_a_abi` decimal(8,2) DEFAULT NULL COMMENT 'عملکرد آبی درخواستی کاربر',
  `request_a_dem` decimal(8,2) DEFAULT NULL COMMENT 'عملکرد دیم درخواستی کاربر',
  `calculated_t_abi` decimal(10,1) DEFAULT NULL COMMENT 'تولید آبی محاسبه‌شده = (a_abi × s_abi) ÷ 1000',
  `calculated_t_dem` decimal(10,1) DEFAULT NULL COMMENT 'تولید دیم محاسبه‌شده = (a_dem × s_dem) ÷ 1000',
  `admin_s_abi` decimal(7,1) DEFAULT NULL COMMENT 'سطح آبی تأییدشده توسط مدیر',
  `admin_s_dem` decimal(7,1) DEFAULT NULL COMMENT 'سطح دیم تأییدشده توسط مدیر',
  `admin_a_abi` decimal(8,2) DEFAULT NULL COMMENT 'عملکرد آبی تأییدشده توسط مدیر',
  `admin_a_dem` decimal(8,2) DEFAULT NULL COMMENT 'عملکرد دیم تأییدشده توسط مدیر',
  `reason` text COLLATE utf8_persian_ci NOT NULL COMMENT 'علت درخواست',
  `attachment` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'مسیر فایل پیوست',
  `status` enum('pending','reviewing','approved','rejected') COLLATE utf8_persian_ci NOT NULL DEFAULT 'pending' COMMENT 'وضعیت درخواست',
  `admin_note` text COLLATE utf8_persian_ci COMMENT 'یادداشت مدیر',
  `created_by` varchar(10) COLLATE utf8_persian_ci NOT NULL COMMENT 'کاربر ایجادکننده',
  `created_at` varchar(10) COLLATE utf8_persian_ci NOT NULL COMMENT 'تاریخ ثبت درخواست (شمسی)',
  `updated_at` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'تاریخ ویرایش درخواست (شمسی)',
  `approved_at` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'تاریخ تأیید/رد درخواست (شمسی)',
  PRIMARY KEY (`id`),
  KEY `idx_ostan_zsal_product` (`id_ostan`,`z_sal`,`product_cod`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=562 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci COMMENT='جدول درخواست‌های تغییر الگوی کشت';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_ab_temp`
--

DROP TABLE IF EXISTS `Agri_ab_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_ab_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci DEFAULT NULL,
  `group_cod` varchar(3) COLLATE utf8_persian_ci DEFAULT NULL,
  `group_name` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci DEFAULT NULL,
  `s_abi` decimal(7,1) DEFAULT NULL,
  `s_dem` decimal(7,1) DEFAULT NULL,
  `t_abi` decimal(10,1) DEFAULT NULL,
  `t_dem` decimal(10,1) DEFAULT NULL,
  `a_abi` decimal(8,2) DEFAULT NULL,
  `a_dem` decimal(8,2) DEFAULT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2377 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_approved`
--

DROP TABLE IF EXISTS `Agri_approved`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_approved` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `z_sal` varchar(9) NOT NULL,
  `id_ostan` varchar(2) NOT NULL,
  `id_city` varchar(2) NOT NULL,
  `id_mar` varchar(5) NOT NULL,
  `mor_cod_m` varchar(10) NOT NULL,
  `app_user` varchar(10) NOT NULL,
  `app_level` varchar(1) NOT NULL,
  `app_date` varchar(10) NOT NULL,
  `app_result` varchar(1) NOT NULL,
  `app_comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_note1403_1404`
--

DROP TABLE IF EXISTS `Agri_note1403_1404`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_note1403_1404` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Agri_id` (`Agri_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17964 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_note1404_1405`
--

DROP TABLE IF EXISTS `Agri_note1404_1405`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_note1404_1405` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Agri_id` (`Agri_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19654 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_note1405_1406`
--

DROP TABLE IF EXISTS `Agri_note1405_1406`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_note1405_1406` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Agri_id` (`Agri_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6013 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_prod1397_1398`
--

DROP TABLE IF EXISTS `Agri_prod1397_1398`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_prod1397_1398` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`)
) ENGINE=MyISAM AUTO_INCREMENT=27693431 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_prod1398_1399`
--

DROP TABLE IF EXISTS `Agri_prod1398_1399`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_prod1398_1399` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah_amar` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`)
) ENGINE=MyISAM AUTO_INCREMENT=6321695 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_prod1399_1400`
--

DROP TABLE IF EXISTS `Agri_prod1399_1400`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_prod1399_1400` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_qroup_amar` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah_amar` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`)
) ENGINE=MyISAM AUTO_INCREMENT=6084290 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_prod1400_1401`
--

DROP TABLE IF EXISTS `Agri_prod1400_1401`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_prod1400_1401` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`)
) ENGINE=MyISAM AUTO_INCREMENT=7940439 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_prod1401_1402`
--

DROP TABLE IF EXISTS `Agri_prod1401_1402`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_prod1401_1402` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`),
  KEY `idx_agri_prod1401_1402_ostan_qroup_mah_no` (`id_ostan`,`cod_qroup`,`cod_mah`,`no_kesh`)
) ENGINE=MyISAM AUTO_INCREMENT=6172590 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_prod1402_1403`
--

DROP TABLE IF EXISTS `Agri_prod1402_1403`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_prod1402_1403` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `app_level` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `app_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`),
  KEY `idx_agri_prod_all` (`id_ostan`,`id_city`,`no_kesh`,`cod_mah`)
) ENGINE=MyISAM AUTO_INCREMENT=9182920 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_prod1403_1404`
--

DROP TABLE IF EXISTS `Agri_prod1403_1404`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_prod1403_1404` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `app_level` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `app_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`),
  KEY `idx_agri_prod_all` (`id_ostan`,`id_city`,`no_kesh`,`cod_mah`)
) ENGINE=MyISAM AUTO_INCREMENT=13401600 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_prod1404_1405`
--

DROP TABLE IF EXISTS `Agri_prod1404_1405`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_prod1404_1405` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `app_level` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `app_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`),
  KEY `idx_agri_prod_all` (`id_ostan`,`id_city`,`no_kesh`,`cod_mah`)
) ENGINE=InnoDB AUTO_INCREMENT=4428324 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_prod1404_1405_uot_ab`
--

DROP TABLE IF EXISTS `Agri_prod1404_1405_uot_ab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_prod1404_1405_uot_ab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `app_level` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `app_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`),
  KEY `idx_agri_prod_all` (`id_ostan`,`id_city`,`no_kesh`,`cod_mah`)
) ENGINE=InnoDB AUTO_INCREMENT=4255820 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_prod1405_1406`
--

DROP TABLE IF EXISTS `Agri_prod1405_1406`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_prod1405_1406` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `app_level` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `app_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`),
  KEY `idx_agri_prod_all` (`id_ostan`,`id_city`,`no_kesh`,`cod_mah`)
) ENGINE=InnoDB AUTO_INCREMENT=638489 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_prod1405_1406_uot_ab`
--

DROP TABLE IF EXISTS `Agri_prod1405_1406_uot_ab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_prod1405_1406_uot_ab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `app_level` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `app_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`),
  KEY `idx_agri_prod_all` (`id_ostan`,`id_city`,`no_kesh`,`cod_mah`)
) ENGINE=InnoDB AUTO_INCREMENT=81759 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_prod_req`
--

DROP TABLE IF EXISTS `Agri_prod_req`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_prod_req` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `Agri_id` int(11) DEFAULT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci DEFAULT NULL,
  `num_bah` int(2) DEFAULT NULL,
  `sh_gat` int(3) DEFAULT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci DEFAULT NULL,
  `mah_mas` float(10,4) DEFAULT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci DEFAULT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci DEFAULT NULL,
  `zer_kesht_a` float(10,4) DEFAULT NULL,
  `zer_kesht_b` float(10,4) DEFAULT NULL,
  `mah_tolp` float(15,5) DEFAULT NULL,
  `add_abadi` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_city` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `new_cod_qroup` varchar(3) COLLATE utf8_persian_ci DEFAULT NULL,
  `new_cod_mah` varchar(4) COLLATE utf8_persian_ci DEFAULT NULL,
  `new_zer_kesht_a` float(10,4) DEFAULT NULL,
  `new_zer_kesht_b` float(10,4) DEFAULT NULL,
  `new_mah_tolp` float(15,5) DEFAULT NULL,
  `reason` text COLLATE utf8_persian_ci,
  `status` int(2) DEFAULT '0',
  `date_req` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `center_comment` text COLLATE utf8_persian_ci,
  `center_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `city_comment` text COLLATE utf8_persian_ci,
  `city_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `prov_comment` text COLLATE utf8_persian_ci,
  `prov_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33866 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agri_req_bah`
--

DROP TABLE IF EXISTS `Agri_req_bah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agri_req_bah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_req` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `new_bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `new_num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `sh_gat` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `reason` text COLLATE utf8_persian_ci,
  `reg_status` int(2) DEFAULT NULL,
  `center_comment` text COLLATE utf8_persian_ci,
  `center_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `city_comment` text COLLATE utf8_persian_ci,
  `city_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `prov_comment` text COLLATE utf8_persian_ci,
  `prov_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `z_sal` (`z_sal`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`)
) ENGINE=InnoDB AUTO_INCREMENT=6064 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agriprod1398_1399`
--

DROP TABLE IF EXISTS `Agriprod1398_1399`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agriprod1398_1399` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `cod_qroup_amar` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah_amar` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`)
) ENGINE=MyISAM AUTO_INCREMENT=6321695 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agriprod1399_1400`
--

DROP TABLE IF EXISTS `Agriprod1399_1400`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agriprod1399_1400` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_qroup_amar` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah_amar` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`)
) ENGINE=MyISAM AUTO_INCREMENT=6084290 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agriprod1400_1401`
--

DROP TABLE IF EXISTS `Agriprod1400_1401`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agriprod1400_1401` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_qroup_amar` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah_amar` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Agri_id_2` (`Agri_id`,`date_s`,`mor_cod_m`,`bah_cod_m`,`num_bah`,`sh_gat`,`z_sal`,`cod_mah`,`zer_kesht_a`,`zer_kesht_b`,`s_bar_a`,`s_bar_b`,`mah_tol`,`mah_tolp`,`mah_bem`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`)
) ENGINE=MyISAM AUTO_INCREMENT=7940439 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agriprod1401_1402`
--

DROP TABLE IF EXISTS `Agriprod1401_1402`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agriprod1401_1402` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_qroup_amar` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah_amar` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Agri_id_2` (`Agri_id`,`date_s`,`mor_cod_m`,`bah_cod_m`,`num_bah`,`sh_gat`,`z_sal`,`cod_mah`,`zer_kesht_a`,`zer_kesht_b`,`s_bar_a`,`s_bar_b`,`mah_tol`,`mah_tolp`,`mah_bem`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`),
  KEY `cod_qroup_amar` (`cod_qroup_amar`),
  KEY `cod_mah_amar` (`cod_mah_amar`),
  KEY `mah_tol` (`mah_tol`),
  KEY `idx_group_by` (`id_ostan`,`cod_mah_amar`,`no_kesh`,`mah_tol`)
) ENGINE=MyISAM AUTO_INCREMENT=6172589 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agriprod1402_1403`
--

DROP TABLE IF EXISTS `Agriprod1402_1403`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agriprod1402_1403` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_qroup_amar` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah_amar` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `app_level` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `app_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`),
  KEY `idx_agri_prod_all` (`id_ostan`,`id_city`,`no_kesh`,`cod_mah`)
) ENGINE=MyISAM AUTO_INCREMENT=9182920 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Agriprod1403_1404`
--

DROP TABLE IF EXISTS `Agriprod1403_1404`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Agriprod1403_1404` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Agri_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `mah_mas` float(10,4) NOT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_qroup_amar` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah_amar` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `s_bar_a` float(10,4) NOT NULL,
  `s_bar_b` float(10,4) NOT NULL,
  `mah_tol` float(15,5) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `app_level` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `app_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Agri_id` (`Agri_id`),
  KEY `num_bah` (`num_bah`),
  KEY `zer_kesht_a` (`zer_kesht_a`),
  KEY `mah_tolp` (`mah_tolp`),
  KEY `idx_agri_prod_all` (`id_ostan`,`id_city`,`no_kesh`,`cod_mah`)
) ENGINE=MyISAM AUTO_INCREMENT=13401600 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Aquatic`
--

DROP TABLE IF EXISTS `Aquatic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Aquatic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `m_zamin` float(9,1) NOT NULL DEFAULT '0.0',
  `lng` float(10,6) NOT NULL DEFAULT '0.000000',
  `lat` float(10,6) NOT NULL DEFAULT '0.000000',
  `no_mal` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_fa` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `g_tol` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `pt_no` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `pt_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `pb_no` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `pb_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `unit_name` varchar(75) COLLATE utf8_persian_ci DEFAULT NULL,
  `sal` varchar(4) COLLATE utf8_persian_ci DEFAULT NULL,
  `tak1` int(10) NOT NULL,
  `tak2` int(10) NOT NULL,
  `tak3` int(10) NOT NULL,
  `tak4` int(10) NOT NULL,
  `tak5` int(10) NOT NULL,
  `par1` float(10,3) NOT NULL,
  `par2` float(10,3) NOT NULL,
  `par3` float(10,3) NOT NULL,
  `par4` float(10,3) NOT NULL,
  `par5` float(10,3) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_s` (`date_s`,`mor_cod_m`,`bah_cod_m`,`num_bah`,`m_zamin`,`lng`,`lat`,`no_fa`,`g_tol`,`unit_name`,`sal`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `id_ostan` (`id_ostan`)
) ENGINE=MyISAM AUTO_INCREMENT=65059 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Aquatic2`
--

DROP TABLE IF EXISTS `Aquatic2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Aquatic2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `m_zamin` float(9,1) NOT NULL DEFAULT '0.0',
  `lng` float(10,6) NOT NULL DEFAULT '0.000000',
  `lat` float(10,6) NOT NULL DEFAULT '0.000000',
  `no_mal` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_fa` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `g_tol` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `pt_no` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `pt_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `pb_no` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `pb_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `unit_name` varchar(75) COLLATE utf8_persian_ci DEFAULT NULL,
  `sal` varchar(4) COLLATE utf8_persian_ci DEFAULT NULL,
  `tak1` int(10) NOT NULL,
  `tak2` int(10) NOT NULL,
  `tak3` int(10) NOT NULL,
  `tak4` int(10) NOT NULL,
  `tak5` int(10) NOT NULL,
  `tak6` int(10) NOT NULL,
  `tak7` int(10) NOT NULL,
  `tak8` int(10) NOT NULL,
  `tak9` int(10) NOT NULL,
  `tak10` int(10) NOT NULL,
  `par1` float(10,3) NOT NULL,
  `par2` float(10,3) NOT NULL,
  `par3` float(10,3) NOT NULL,
  `par4` float(10,3) NOT NULL,
  `par5` float(10,3) NOT NULL,
  `par6` float(10,3) NOT NULL,
  `par7` float(10,3) NOT NULL,
  `par8` float(10,3) NOT NULL,
  `par9` float(10,3) NOT NULL,
  `par10` float(10,3) NOT NULL,
  `par11` int(10) NOT NULL,
  `par12` int(10) NOT NULL,
  `par13` int(10) NOT NULL,
  `par14` int(10) NOT NULL,
  `par15` float(10,3) NOT NULL,
  `par16` float(10,3) NOT NULL,
  `par17` float(10,3) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_s` (`date_s`,`mor_cod_m`,`bah_cod_m`,`num_bah`,`m_zamin`,`lng`,`lat`,`no_fa`,`g_tol`,`unit_name`,`sal`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `id_ostan` (`id_ostan`)
) ENGINE=MyISAM AUTO_INCREMENT=6192 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `D_mav1_bohr`
--

DROP TABLE IF EXISTS `D_mav1_bohr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `D_mav1_bohr` (
  `id` int(11) NOT NULL DEFAULT '0',
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `sal` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `A1` float(12,3) NOT NULL,
  `A2` float(12,3) NOT NULL,
  `A3` float(10,0) NOT NULL,
  `A4` float(12,3) NOT NULL,
  `A5` float(10,0) NOT NULL,
  `A6` float(5,2) NOT NULL,
  `B1` float(12,3) NOT NULL,
  `B2` float(12,3) NOT NULL,
  `B3` float(10,0) NOT NULL,
  `B4` float(12,3) NOT NULL,
  `B5` float(10,0) NOT NULL,
  `B6` float(5,2) NOT NULL,
  `C1` float(12,3) NOT NULL,
  `C2` float(12,3) NOT NULL,
  `C3` float(10,0) NOT NULL,
  `C4` float(12,3) NOT NULL,
  `C5` float(10,0) NOT NULL,
  `C6` float(5,2) NOT NULL,
  `D1` float(12,3) NOT NULL,
  `D2` float(12,3) NOT NULL,
  `D3` float(10,0) NOT NULL,
  `D4` float(12,3) NOT NULL,
  `D5` float(10,0) NOT NULL,
  `D6` float(5,2) NOT NULL,
  `E1` float(12,3) NOT NULL,
  `E2` float(12,3) NOT NULL,
  `E3` float(10,0) NOT NULL,
  `E4` float(12,3) NOT NULL,
  `E5` float(10,0) NOT NULL,
  `E6` float(5,2) NOT NULL,
  `F1` float(12,3) NOT NULL,
  `F2` float(12,3) NOT NULL,
  `F3` float(10,0) NOT NULL,
  `F4` float(12,3) NOT NULL,
  `F5` float(10,0) NOT NULL,
  `F6` float(5,2) NOT NULL,
  `G1` float(12,3) NOT NULL,
  `G2` float(12,3) NOT NULL,
  `G3` float(10,0) NOT NULL,
  `G4` float(12,3) NOT NULL,
  `G5` float(10,0) NOT NULL,
  `G6` float(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `D_mav1_etab`
--

DROP TABLE IF EXISTS `D_mav1_etab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `D_mav1_etab` (
  `id` int(11) NOT NULL DEFAULT '0',
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `sal` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `t_mo` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `t_pro` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `A1` float(10,0) NOT NULL,
  `A2` float(10,0) NOT NULL,
  `A3` float(10,0) NOT NULL,
  `A4` float(10,0) NOT NULL,
  `A5` float(10,0) NOT NULL,
  `A6` float(10,0) NOT NULL,
  `A7` float(10,0) NOT NULL,
  `A8` float(10,0) NOT NULL,
  `A9` float(5,2) NOT NULL,
  `B1` float(10,0) NOT NULL,
  `B2` float(10,0) NOT NULL,
  `B3` float(10,0) NOT NULL,
  `B4` float(10,0) NOT NULL,
  `B5` float(10,0) NOT NULL,
  `B6` float(10,0) NOT NULL,
  `B7` float(10,0) NOT NULL,
  `B8` float(10,0) NOT NULL,
  `B9` float(5,2) NOT NULL,
  `C1` float(10,0) NOT NULL,
  `C2` float(10,0) NOT NULL,
  `C3` float(10,0) NOT NULL,
  `C4` float(10,0) NOT NULL,
  `C5` float(10,0) NOT NULL,
  `C6` float(10,0) NOT NULL,
  `C7` float(10,0) NOT NULL,
  `C8` float(10,0) NOT NULL,
  `C9` float(5,2) NOT NULL,
  `D1` float(10,0) NOT NULL,
  `D2` float(10,0) NOT NULL,
  `D3` float(10,0) NOT NULL,
  `D4` float(10,0) NOT NULL,
  `D5` float(10,0) NOT NULL,
  `D6` float(10,0) NOT NULL,
  `D7` float(10,0) NOT NULL,
  `D8` float(10,0) NOT NULL,
  `D9` float(5,2) NOT NULL,
  `E1` float(10,0) NOT NULL,
  `E2` float(10,0) NOT NULL,
  `E3` float(10,0) NOT NULL,
  `E4` float(10,0) NOT NULL,
  `E5` float(10,0) NOT NULL,
  `E6` float(10,0) NOT NULL,
  `E7` float(10,0) NOT NULL,
  `E8` float(10,0) NOT NULL,
  `E9` float(5,2) NOT NULL,
  `F1` float(10,0) NOT NULL,
  `F2` float(10,0) NOT NULL,
  `F3` float(10,0) NOT NULL,
  `F4` float(10,0) NOT NULL,
  `F5` float(10,0) NOT NULL,
  `F6` float(10,0) NOT NULL,
  `F7` float(10,0) NOT NULL,
  `F8` float(10,0) NOT NULL,
  `F9` float(5,2) NOT NULL,
  `G1` float(10,0) NOT NULL,
  `G2` float(10,0) NOT NULL,
  `G3` float(10,0) NOT NULL,
  `G4` float(10,0) NOT NULL,
  `G5` float(10,0) NOT NULL,
  `G6` float(10,0) NOT NULL,
  `G7` float(10,0) NOT NULL,
  `G8` float(10,0) NOT NULL,
  `G9` float(5,2) NOT NULL,
  `H1` float(10,0) NOT NULL,
  `H2` float(10,0) NOT NULL,
  `H3` float(10,0) NOT NULL,
  `H4` float(10,0) NOT NULL,
  `H5` float(10,0) NOT NULL,
  `H6` float(10,0) NOT NULL,
  `H7` float(10,0) NOT NULL,
  `H8` float(10,0) NOT NULL,
  `H9` float(5,2) NOT NULL,
  `I1` float(10,0) NOT NULL,
  `I2` float(10,0) NOT NULL,
  `I3` float(10,0) NOT NULL,
  `I4` decimal(10,0) NOT NULL,
  `I5` float(10,0) NOT NULL,
  `I6` float(10,0) NOT NULL,
  `I7` float(10,0) NOT NULL,
  `I8` float(10,0) NOT NULL,
  `I9` float(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `D_mav1_tash`
--

DROP TABLE IF EXISTS `D_mav1_tash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `D_mav1_tash` (
  `id` int(11) NOT NULL DEFAULT '0',
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `sal` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `A1` float(10,0) NOT NULL,
  `A2` float(10,0) NOT NULL,
  `A3` float(10,0) NOT NULL,
  `A4` float(10,0) NOT NULL,
  `A5` float(10,0) NOT NULL,
  `A6` float(5,2) NOT NULL,
  `B1` float(10,0) NOT NULL,
  `B2` float(10,0) NOT NULL,
  `B3` float(10,0) NOT NULL,
  `B4` float(10,0) NOT NULL,
  `B5` float(10,0) NOT NULL,
  `B6` float(5,2) NOT NULL,
  `C1` float(10,0) NOT NULL,
  `C2` float(10,0) NOT NULL,
  `C3` float(10,0) NOT NULL,
  `C4` float(10,0) NOT NULL,
  `C5` float(10,0) NOT NULL,
  `C6` float(5,2) NOT NULL,
  `D1` float(10,0) NOT NULL,
  `D2` float(10,0) NOT NULL,
  `D3` float(10,0) NOT NULL,
  `D4` float(10,0) NOT NULL,
  `D5` float(10,0) NOT NULL,
  `D6` float(5,2) NOT NULL,
  `E1` float(10,0) NOT NULL,
  `E2` float(10,0) NOT NULL,
  `E3` float(10,0) NOT NULL,
  `E4` float(10,0) NOT NULL,
  `E5` float(10,0) NOT NULL,
  `E6` float(5,2) NOT NULL,
  `F1` float(10,0) NOT NULL,
  `F2` float(10,0) NOT NULL,
  `F3` float(10,0) NOT NULL,
  `F4` float(10,0) NOT NULL,
  `F5` float(10,0) NOT NULL,
  `F6` float(5,2) NOT NULL,
  `G1` float(10,0) NOT NULL,
  `G2` float(10,0) NOT NULL,
  `G3` float(10,0) NOT NULL,
  `G4` float(10,0) NOT NULL,
  `G5` float(10,0) NOT NULL,
  `G6` float(5,2) NOT NULL,
  `H1` float(10,0) NOT NULL,
  `H2` float(10,0) NOT NULL,
  `H3` float(10,0) NOT NULL,
  `H4` float(10,0) NOT NULL,
  `H5` float(10,0) NOT NULL,
  `H6` float(5,2) NOT NULL,
  `I1` float(10,0) NOT NULL,
  `I2` float(10,0) NOT NULL,
  `I3` float(10,0) NOT NULL,
  `I4` decimal(10,0) NOT NULL,
  `I5` float(10,0) NOT NULL,
  `I6` float(5,2) NOT NULL,
  `J1` float(10,0) NOT NULL,
  `J2` float(10,0) NOT NULL,
  `J3` float(10,0) NOT NULL,
  `J4` float(10,0) NOT NULL,
  `J5` float(10,0) NOT NULL,
  `J6` float(5,2) NOT NULL,
  `K1` float(10,0) NOT NULL,
  `K2` float(10,0) NOT NULL,
  `K3` float(10,0) NOT NULL,
  `K4` float(10,0) NOT NULL,
  `K5` float(10,0) NOT NULL,
  `K6` float(5,2) NOT NULL,
  `L1` float(10,0) NOT NULL,
  `L2` float(10,0) NOT NULL,
  `L3` float(10,0) NOT NULL,
  `L4` float(10,0) NOT NULL,
  `L5` float(10,0) NOT NULL,
  `L6` float(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Eworker`
--

DROP TABLE IF EXISTS `Eworker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Eworker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `cod_sh_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `jens` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sal_z` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `v_tah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_fam` int(2) NOT NULL,
  `f_tm` int(2) NOT NULL,
  `r_tah` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `z_fa1` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `z_fa2` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `no_ham` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `g_tah` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `addres` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `no_oz` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `oz_ta` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `name_co` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cod_m` (`cod_m`),
  UNIQUE KEY `date_s` (`date_s`,`id_mar`,`cod_m`,`add_abadi`,`add_city`),
  KEY `id_mar` (`id_mar`),
  KEY `id_city` (`id_city`),
  KEY `id_ostan` (`id_ostan`),
  KEY `jens` (`jens`),
  KEY `z_fa1` (`z_fa1`),
  KEY `z_fa2` (`z_fa2`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`)
) ENGINE=MyISAM AUTO_INCREMENT=70286 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Eworker_ac`
--

DROP TABLE IF EXISTS `Eworker_ac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Eworker_ac` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `sal_ac` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `mah_ac` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `no_ac` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `unit_ac` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `cap_ac` int(5) NOT NULL,
  `commen_ac` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_s` (`date_s`,`id_ostan`,`id_city`,`id_mar`,`cod_m`,`sal_ac`,`mah_ac`,`no_ac`,`unit_ac`,`cap_ac`)
) ENGINE=MyISAM AUTO_INCREMENT=6162 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Eworker_h`
--

DROP TABLE IF EXISTS `Eworker_h`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Eworker_h` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `sal_h` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `mah_h` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `no_h` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `commen_h` text COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_s` (`date_s`,`id_ostan`,`id_city`,`id_mar`,`cod_m`,`sal_h`,`mah_h`,`no_h`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `cod_m` (`cod_m`),
  KEY `no_h` (`no_h`)
) ENGINE=MyISAM AUTO_INCREMENT=1200 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden`
--

DROP TABLE IF EXISTS `Garden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_old` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL DEFAULT '0',
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL DEFAULT '0.000000',
  `lat` float(10,6) NOT NULL DEFAULT '0.000000',
  `no_mal` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `nah_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `md_ab` int(2) NOT NULL DEFAULT '0',
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `t_mah` int(2) NOT NULL DEFAULT '0',
  `z_sal` varchar(9) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `m_zamin` (`m_zamin`),
  KEY `num_bah` (`num_bah`),
  KEY `no_mal` (`no_mal`),
  KEY `no_kesh` (`no_kesh`),
  KEY `idx_garden_combined` (`id_ostan`,`id_city`,`z_sal`,`no_kesh`)
) ENGINE=InnoDB AUTO_INCREMENT=20445444 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_1405`
--

DROP TABLE IF EXISTS `Garden_1405`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_1405` (
  `id` int(11) NOT NULL,
  `id_old` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL DEFAULT '0',
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL DEFAULT '0.000000',
  `lat` float(10,6) NOT NULL DEFAULT '0.000000',
  `no_mal` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `nah_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `md_ab` int(2) NOT NULL DEFAULT '0',
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `t_mah` int(2) NOT NULL DEFAULT '0',
  `z_sal` varchar(9) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `m_zamin` (`m_zamin`),
  KEY `num_bah` (`num_bah`),
  KEY `no_mal` (`no_mal`),
  KEY `no_kesh` (`no_kesh`),
  KEY `idx_garden_combined` (`id_ostan`,`id_city`,`z_sal`,`no_kesh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_ab_city`
--

DROP TABLE IF EXISTS `Garden_ab_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_ab_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `s_nobar_abi` float(10,4) NOT NULL,
  `s_nobar_dem` float(10,4) NOT NULL,
  `s_bar_abi` float(10,4) NOT NULL,
  `s_bar_dem` float(10,4) NOT NULL,
  `t_abi` float(11,4) NOT NULL,
  `t_dem` float(11,4) NOT NULL,
  `a_abi` float(8,1) NOT NULL,
  `a_dem` float(8,1) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_cod` (`group_cod`),
  KEY `product_cod` (`product_cod`),
  KEY `id_ostan` (`id_ostan`,`id_city`)
) ENGINE=InnoDB AUTO_INCREMENT=30318 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_ab_mar`
--

DROP TABLE IF EXISTS `Garden_ab_mar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_ab_mar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `s_nobar_abi` float(10,4) NOT NULL,
  `s_nobar_dem` float(10,4) NOT NULL,
  `s_bar_abi` float(10,4) NOT NULL,
  `s_bar_dem` float(10,4) NOT NULL,
  `t_abi` float(8,1) NOT NULL,
  `t_dem` float(8,1) NOT NULL,
  `a_abi` float(8,1) NOT NULL,
  `a_dem` float(8,1) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_cod` (`group_cod`),
  KEY `product_cod` (`product_cod`),
  KEY `id_ostan` (`id_ostan`,`id_city`,`id_mar`)
) ENGINE=InnoDB AUTO_INCREMENT=391137 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_ab_ostan`
--

DROP TABLE IF EXISTS `Garden_ab_ostan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_ab_ostan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `s_nobar_abi` float(10,4) NOT NULL,
  `s_nobar_dem` float(10,4) NOT NULL,
  `s_bar_abi` float(10,4) NOT NULL,
  `s_bar_dem` float(10,4) NOT NULL,
  `t_abi` float(8,1) NOT NULL,
  `t_dem` float(8,1) NOT NULL,
  `a_abi` float(8,1) NOT NULL,
  `a_dem` float(8,1) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `group_cod` (`group_cod`),
  KEY `product_cod` (`product_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=3056 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_ab_ostan_14050531`
--

DROP TABLE IF EXISTS `Garden_ab_ostan_14050531`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_ab_ostan_14050531` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `s_nobar_abi` float(7,1) NOT NULL,
  `s_nobar_dem` float(7,1) NOT NULL,
  `s_bar_abi` float(7,1) NOT NULL,
  `s_bar_dem` float(7,1) NOT NULL,
  `t_abi` float(8,1) NOT NULL,
  `t_dem` float(8,1) NOT NULL,
  `a_abi` float(8,1) NOT NULL,
  `a_dem` float(8,1) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `group_cod` (`group_cod`),
  KEY `product_cod` (`product_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=3056 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_ab_request`
--

DROP TABLE IF EXISTS `Garden_ab_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_ab_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `current_s_nobar_abi` decimal(7,1) DEFAULT '0.0',
  `current_s_nobar_dem` decimal(7,1) DEFAULT '0.0',
  `current_s_bar_abi` decimal(7,1) DEFAULT '0.0',
  `current_s_bar_dem` decimal(7,1) DEFAULT '0.0',
  `current_t_abi` decimal(10,1) DEFAULT '0.0',
  `current_t_dem` decimal(10,1) DEFAULT '0.0',
  `current_a_abi` decimal(8,2) DEFAULT '0.00',
  `current_a_dem` decimal(8,2) DEFAULT '0.00',
  `request_s_nobar_abi` decimal(7,1) DEFAULT '0.0',
  `request_s_nobar_dem` decimal(7,1) DEFAULT '0.0',
  `request_s_bar_abi` decimal(7,1) DEFAULT '0.0',
  `request_s_bar_dem` decimal(7,1) DEFAULT '0.0',
  `request_a_abi` decimal(8,2) DEFAULT '0.00',
  `request_a_dem` decimal(8,2) DEFAULT '0.00',
  `calculated_t_abi` decimal(10,1) DEFAULT '0.0',
  `calculated_t_dem` decimal(10,1) DEFAULT '0.0',
  `admin_s_nobar_abi` decimal(7,1) DEFAULT '0.0',
  `admin_s_nobar_dem` decimal(7,1) DEFAULT '0.0',
  `admin_s_bar_abi` decimal(7,1) DEFAULT '0.0',
  `admin_s_bar_dem` decimal(7,1) DEFAULT '0.0',
  `admin_a_abi` decimal(8,2) DEFAULT '0.00',
  `admin_a_dem` decimal(8,2) DEFAULT '0.00',
  `reason` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `status` enum('pending','reviewing','approved','rejected') DEFAULT 'pending',
  `admin_note` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `attachment` varchar(255) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` varchar(10) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `updated_at` varchar(10) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `approved_at` varchar(10) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=509 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_ab_temp`
--

DROP TABLE IF EXISTS `Garden_ab_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_ab_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `s_nobar_abi` decimal(10,1) DEFAULT '0.0',
  `s_nobar_dem` decimal(10,1) DEFAULT '0.0',
  `s_bar_abi` decimal(10,1) DEFAULT '0.0',
  `s_bar_dem` decimal(10,1) DEFAULT '0.0',
  `t_abi` decimal(10,1) DEFAULT '0.0',
  `t_dem` decimal(10,1) DEFAULT '0.0',
  `a_abi` decimal(10,2) DEFAULT '0.00',
  `a_dem` decimal(10,2) DEFAULT '0.00',
  `date_s` varchar(10) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3056 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_nah_kesh_3`
--

DROP TABLE IF EXISTS `Garden_nah_kesh_3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_nah_kesh_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_old` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL DEFAULT '0',
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL DEFAULT '0.000000',
  `lat` float(10,6) NOT NULL DEFAULT '0.000000',
  `no_mal` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `nah_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `md_ab` int(2) NOT NULL DEFAULT '0',
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `t_mah` int(2) NOT NULL DEFAULT '0',
  `z_sal` varchar(9) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `m_zamin` (`m_zamin`),
  KEY `num_bah` (`num_bah`),
  KEY `no_mal` (`no_mal`),
  KEY `no_kesh` (`no_kesh`),
  KEY `idx_garden_combined` (`id_ostan`,`id_city`,`z_sal`,`no_kesh`)
) ENGINE=InnoDB AUTO_INCREMENT=20445121 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_noedit`
--

DROP TABLE IF EXISTS `Garden_noedit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_noedit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_old` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) NOT NULL DEFAULT '0',
  `check_cod` int(3) NOT NULL,
  `m_zamin` float(10,4) NOT NULL,
  `lng` float(10,6) NOT NULL DEFAULT '0.000000',
  `lat` float(10,6) NOT NULL DEFAULT '0.000000',
  `no_mal` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `nah_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `md_ab` int(2) NOT NULL DEFAULT '0',
  `h_ab` float(4,1) NOT NULL,
  `no_sab` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `es` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `t_mah` int(2) NOT NULL DEFAULT '0',
  `z_sal` varchar(9) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `m_zamin` (`m_zamin`),
  KEY `num_bah` (`num_bah`),
  KEY `no_mal` (`no_mal`),
  KEY `no_kesh` (`no_kesh`),
  KEY `idx_garden_combined` (`id_ostan`,`id_city`,`z_sal`,`no_kesh`)
) ENGINE=InnoDB AUTO_INCREMENT=18069615 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_nokesh`
--

DROP TABLE IF EXISTS `Garden_nokesh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_nokesh` (
  `bah_cod_m` varchar(12) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `cod_mah` varchar(6) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `bah_cod_m_2` (`bah_cod_m`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_note1405`
--

DROP TABLE IF EXISTS `Garden_note1405`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_note1405` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Garden_id` int(11) NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `description` text COLLATE utf8_persian_ci NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Agri_id` (`Garden_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_prod`
--

DROP TABLE IF EXISTS `Garden_prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Garden_id` int(11) NOT NULL,
  `Garden_id_old` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) DEFAULT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `nah_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci DEFAULT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci DEFAULT NULL,
  `cod_mah` varchar(6) COLLATE utf8_persian_ci DEFAULT NULL,
  `s_kesht_b` float(10,4) NOT NULL,
  `s_kesht_gb` float(10,4) NOT NULL,
  `tree_b` int(6) NOT NULL DEFAULT '0',
  `tree_gb` int(6) NOT NULL DEFAULT '0',
  `mah_tol` float(10,5) NOT NULL,
  `mah_tolp` float(10,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `Garden_id` (`Garden_id`),
  KEY `idx_geo` (`z_sal`,`id_ostan`,`id_city`,`id_mar`),
  KEY `idx_prod` (`z_sal`,`cod_mah`,`id_ostan`,`id_city`),
  KEY `add_city` (`add_city`),
  KEY `idx_bah_year_mor` (`bah_cod_m`,`z_sal`,`mor_cod_m`)
) ENGINE=InnoDB AUTO_INCREMENT=48198451 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Garden_prod_noedit`
--

DROP TABLE IF EXISTS `Garden_prod_noedit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Garden_prod_noedit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Garden_id` int(11) NOT NULL,
  `Garden_id_old` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `sh_gat` int(3) DEFAULT NULL,
  `check_cod` int(3) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `nah_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci DEFAULT NULL,
  `cod_qroup` varchar(3) COLLATE utf8_persian_ci DEFAULT NULL,
  `cod_mah` varchar(6) COLLATE utf8_persian_ci DEFAULT NULL,
  `s_kesht_b` float(10,4) NOT NULL,
  `s_kesht_gb` float(10,4) NOT NULL,
  `tree_b` int(6) NOT NULL DEFAULT '0',
  `tree_gb` int(6) NOT NULL DEFAULT '0',
  `mah_tol` float(10,5) NOT NULL,
  `mah_tolp` float(10,5) NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_qroup` (`cod_qroup`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Garden_id` (`Garden_id`),
  KEY `s_kesht_b` (`s_kesht_b`),
  KEY `s_kesht_gb` (`s_kesht_gb`),
  KEY `mah_tol` (`mah_tol`),
  KEY `no_kesh` (`no_kesh`),
  KEY `nah_kesh` (`nah_kesh`),
  KEY `idx_fast_query` (`id_ostan`,`id_city`,`z_sal`,`cod_mah`)
) ENGINE=InnoDB AUTO_INCREMENT=47063645 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Greenhous`
--

DROP TABLE IF EXISTS `Greenhous`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Greenhous` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci DEFAULT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `lng_d` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `lng_m` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `lng_s` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `lng_ds` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `lat_d` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `lat_m` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `lat_s` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `lat_ds` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_zamin` float(9,1) NOT NULL DEFAULT '0.0',
  `m_zamin_gol` float(9,1) NOT NULL,
  `no_mal` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `address` text COLLATE utf8_persian_ci NOT NULL,
  `no_kesht` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `unit_name` varchar(35) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_moj` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `pt_no` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `pt_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `pb_no` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `pb_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `sal_tas` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `sar_kol` float(10,2) NOT NULL,
  `no_saz` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_gol` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `sys_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_sokh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `sys_hot` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `sys_cool` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `gaz` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_gaz` int(3) NOT NULL,
  `barg` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `f_barg` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `a_barg` int(3) NOT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `num_ab` int(5) NOT NULL,
  `sard` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sard` float(10,2) NOT NULL,
  `m_sard` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sort` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sort` float(10,2) NOT NULL,
  `baz_chr` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `nft` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ab_sh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`)
) ENGINE=InnoDB AUTO_INCREMENT=108339 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Greenhous_prod`
--

DROP TABLE IF EXISTS `Greenhous_prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Greenhous_prod` (
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) NOT NULL,
  `no_mtol` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `no_kesht` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `y_prod` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `v_unit` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_dep` int(3) NOT NULL,
  `dep` int(3) NOT NULL,
  `lisan` int(3) NOT NULL,
  `m_fani` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mar` int(3) NOT NULL,
  `t_zan` int(3) NOT NULL,
  `gar_j` float(10,1) NOT NULL,
  `gar_ja` float(12,0) NOT NULL,
  `gar_m` float(10,1) NOT NULL,
  `gar_ma` float(12,0) NOT NULL,
  `zof_j` float(10,1) NOT NULL,
  `zof_ja` float(12,0) NOT NULL,
  `zof_m` float(10,1) NOT NULL,
  `zof_ma` float(12,0) NOT NULL,
  `hash_j` float(10,1) NOT NULL,
  `hash_ja` float(12,0) NOT NULL,
  `hash_m` float(10,1) NOT NULL,
  `hash_ma` float(12,0) NOT NULL,
  `ab_m` float(5,0) NOT NULL,
  `ab_a` decimal(12,0) NOT NULL,
  `gazoil_m` float(5,0) NOT NULL,
  `gazoil_a` float(12,0) NOT NULL,
  `gaz_m` float(5,0) NOT NULL,
  `gaz_a` float(12,0) NOT NULL,
  `barg_m` float(5,0) NOT NULL,
  `barg_a` float(12,0) NOT NULL,
  `benz_m` float(5,0) NOT NULL,
  `benz_a` float(12,0) NOT NULL,
  `kod_h1_m` float(10,1) NOT NULL,
  `kod_h1_a` float(12,0) NOT NULL,
  `kod_h2_m` float(10,1) NOT NULL,
  `kod_h2_a` float(12,0) NOT NULL,
  `kod_h3_m` float(10,1) NOT NULL,
  `kod_h3_a` float(12,0) NOT NULL,
  `kod_sh1_m` float(10,1) NOT NULL,
  `kod_sh1_a` float(12,0) NOT NULL,
  `kod_sh2_m` float(10,1) NOT NULL,
  `kod_sh2_a` float(12,0) NOT NULL,
  `kod_sh3_m` float(10,1) NOT NULL,
  `kod_sh3_a` float(12,0) NOT NULL,
  `kod_bio1_m` float(10,1) NOT NULL,
  `kod_bio1_a` float(12,0) NOT NULL,
  `kod_bio2_m` float(10,1) NOT NULL,
  `kod_bio2_a` float(12,0) NOT NULL,
  `kod_bio3_m` float(10,1) NOT NULL,
  `kod_bio3_a` float(12,0) NOT NULL,
  `bazr_m` float(7,2) NOT NULL,
  `bazr_a` float(12,0) NOT NULL,
  `nesha_m` float(7,0) NOT NULL,
  `nesha_a` float(12,0) NOT NULL,
  `t_hshekar` float(7,0) NOT NULL,
  `t_zgard` float(7,0) NOT NULL,
  `b_coco` float(5,2) NOT NULL,
  `b_mas` float(5,2) NOT NULL,
  `b_per` float(5,2) NOT NULL,
  `b_pet` float(5,2) NOT NULL,
  `b_say` float(5,2) NOT NULL,
  `no_mtol1_1` float(8,3) NOT NULL,
  `no_mtol1_2` float(8,3) NOT NULL,
  `no_mtol1_3` float(8,3) NOT NULL,
  `no_mtol1_4` float(8,3) NOT NULL,
  `no_mtol1_5` float(8,3) NOT NULL,
  `no_mtol1_6` float(8,3) NOT NULL,
  `no_mtol2_1` int(10) NOT NULL,
  `no_mtol2_2` int(10) NOT NULL,
  `no_mtol2_3` int(10) NOT NULL,
  `no_mtol2_4` int(10) NOT NULL,
  `no_mtol4_1` int(10) NOT NULL,
  `no_mtol4_2` int(10) NOT NULL,
  `no_mtol4_3` int(10) NOT NULL,
  `no_mtol4_4` int(10) NOT NULL,
  `no_mtol3_1` float(8,3) NOT NULL,
  `no_mtol3_2` float(8,3) NOT NULL,
  `no_mtol3_3` int(10) NOT NULL,
  `no_mtol3_4` int(10) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_s_2` (`date_s`,`bah_cod_m`,`unit_id`,`y_prod`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`y_prod`),
  KEY `cod_qroup` (`t_mar`),
  KEY `cod_mah` (`t_zan`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Garden_id` (`unit_id`),
  KEY `s_kesht_b` (`gar_j`),
  KEY `s_kesht_gb` (`gar_ja`)
) ENGINE=InnoDB AUTO_INCREMENT=326028 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Greenprod_annual`
--

DROP TABLE IF EXISTS `Greenprod_annual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Greenprod_annual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `unit_id` int(11) NOT NULL,
  `no_kesht` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_mtol` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `y_prod` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `mah_cod` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `date_1_kesh` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `date_2_kesh` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `s_kesh` float(8,2) NOT NULL,
  `date_1_bar` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `date_2_bar` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `m_tol` float(11,3) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`y_prod`),
  KEY `cod_qroup` (`m_tol`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Garden_id` (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=230560 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Household`
--

DROP TABLE IF EXISTS `Household`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Household` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `sp_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `s_bah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `jens` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `date_t` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `sh_sh` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `fname` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `tel_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `cod_p` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `ok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_nation` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `nation` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_bah` (`sp_cod_m`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `add_abadi` (`add_abadi`),
  KEY `date_s` (`date_s`),
  KEY `add_city` (`add_city`),
  KEY `last_name` (`last_name`),
  KEY `ok` (`ok`),
  KEY `jens` (`jens`),
  KEY `tel_m` (`tel_m`),
  KEY `sp_cod_m` (`sp_cod_m`),
  KEY `s_bah` (`s_bah`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Last_user`
--

DROP TABLE IF EXISTS `Last_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Last_user` (
  `date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `time` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `ip` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `PersName` varchar(150) COLLATE utf8_persian_ci NOT NULL,
  `PersCode` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `date` (`date`),
  KEY `PersCode` (`PersCode`)
) ENGINE=InnoDB AUTO_INCREMENT=28736659 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Mushroom`
--

DROP TABLE IF EXISTS `Mushroom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Mushroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `post_code` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `address` text COLLATE utf8_persian_ci NOT NULL,
  `lng_d` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `lng_m` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `lng_s` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `lng_ds` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `lat_d` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `lat_m` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `lat_s` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `lat_ds` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_zamin` float(9,1) NOT NULL DEFAULT '0.0',
  `m_arseh` float(9,1) NOT NULL,
  `m_salon` float(9,1) NOT NULL,
  `no_mal` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_vaz_sok` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_mush` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `unit_name` varchar(75) COLLATE utf8_persian_ci DEFAULT NULL,
  `no_moj` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sh_tas` varchar(15) COLLATE utf8_persian_ci NOT NULL,
  `date_tas` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `sh_moj` varchar(15) COLLATE utf8_persian_ci DEFAULT NULL,
  `date_moj` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `sal_tas` varchar(4) COLLATE utf8_persian_ci DEFAULT NULL,
  `sar_kol` float(10,2) DEFAULT NULL,
  `z_es` float(7,2) DEFAULT NULL,
  `z_vag` float(7,2) DEFAULT NULL,
  `hava` int(5) DEFAULT NULL,
  `cheler` int(5) DEFAULT NULL,
  `deek` int(5) DEFAULT NULL,
  `sakhti` int(5) DEFAULT NULL,
  `sard` int(5) DEFAULT NULL,
  `rotob` int(5) DEFAULT NULL,
  `gaz` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `z_gaz` int(3) NOT NULL,
  `barg` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `f_barg` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `a_barg` int(3) NOT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `num_ab` int(5) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_s` (`date_s`,`mor_cod_m`,`bah_cod_m`,`m_zamin`,`sh_moj`,`date_moj`,`gaz`,`rotob`,`z_es`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`)
) ENGINE=InnoDB AUTO_INCREMENT=5972 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Mushroom_prod`
--

DROP TABLE IF EXISTS `Mushroom_prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Mushroom_prod` (
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) NOT NULL,
  `no_mush` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `y_prod` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `v_unit` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_dep` int(3) NOT NULL,
  `dep` int(3) NOT NULL,
  `lisan` int(3) NOT NULL,
  `m_fani` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mar` int(3) NOT NULL,
  `t_zan` int(3) NOT NULL,
  `gar_j` float(10,1) NOT NULL,
  `gar_ja` float(12,0) NOT NULL,
  `gar_m` float(10,1) NOT NULL,
  `gar_ma` float(12,0) NOT NULL,
  `zof_j` float(10,1) NOT NULL,
  `zof_ja` float(12,0) NOT NULL,
  `zof_m` float(10,1) NOT NULL,
  `zof_ma` float(12,0) NOT NULL,
  `hash_j` float(10,1) NOT NULL,
  `hash_ja` float(12,0) NOT NULL,
  `hash_m` float(10,1) NOT NULL,
  `hash_ma` float(12,0) NOT NULL,
  `ab_m` float(5,0) NOT NULL,
  `ab_a` decimal(12,0) NOT NULL,
  `gazoil_m` float(5,0) NOT NULL,
  `gazoil_a` float(12,0) NOT NULL,
  `gaz_m` float(5,0) NOT NULL,
  `gaz_a` float(12,0) NOT NULL,
  `barg_m` float(5,0) NOT NULL,
  `barg_a` float(12,0) NOT NULL,
  `benz_m` float(5,0) NOT NULL,
  `benz_a` float(12,0) NOT NULL,
  `comp` float NOT NULL,
  `nt_comp` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_dpar` int(1) NOT NULL,
  `zer_kesh` float(10,1) NOT NULL,
  `mah_tol` float(10,2) NOT NULL,
  `tol_avg` float(6,2) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`y_prod`),
  KEY `cod_qroup` (`t_mar`),
  KEY `cod_mah` (`t_zan`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `Garden_id` (`unit_id`),
  KEY `s_kesht_b` (`gar_j`),
  KEY `s_kesht_gb` (`gar_ja`),
  KEY `mah_tol` (`mah_tol`)
) ENGINE=InnoDB AUTO_INCREMENT=27029 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Mushroom_spawn`
--

DROP TABLE IF EXISTS `Mushroom_spawn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Mushroom_spawn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) NOT NULL,
  `y_prod` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `num_row` int(3) NOT NULL,
  `num_t_row` int(3) NOT NULL,
  `h_t` float(5,2) NOT NULL,
  `w_t` float(5,2) NOT NULL,
  `num_spawn` int(3) NOT NULL,
  `zer_kesh` float(10,2) NOT NULL,
  `zer_kesh2` float(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38500 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Substrate`
--

DROP TABLE IF EXISTS `Substrate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Substrate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) NOT NULL,
  `id_ostan` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `y_prod` varchar(4) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(10) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `num_bah` varchar(1) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `no_bah` varchar(1) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `z_esmi` float(10,0) DEFAULT NULL,
  `z_amal` float(10,0) DEFAULT NULL,
  `zer_kesht2` float(5,0) NOT NULL,
  `zer_kesht` float(10,5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `V_Agri03`
--

DROP TABLE IF EXISTS `V_Agri03`;
/*!50001 DROP VIEW IF EXISTS `V_Agri03`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Agri03` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `ostan` tinyint NOT NULL,
  `city` tinyint NOT NULL,
  `mar` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `sh_gat` tinyint NOT NULL,
  `m_zamin` tinyint NOT NULL,
  `no_mal` tinyint NOT NULL,
  `no_kesh` tinyint NOT NULL,
  `m_ab` tinyint NOT NULL,
  `no_ab` tinyint NOT NULL,
  `t_mah` tinyint NOT NULL,
  `ayesh` tinyint NOT NULL,
  `abadi` tinyint NOT NULL,
  `shahr` tinyint NOT NULL,
  `z_sal` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Agri04`
--

DROP TABLE IF EXISTS `V_Agri04`;
/*!50001 DROP VIEW IF EXISTS `V_Agri04`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Agri04` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `ostan` tinyint NOT NULL,
  `city` tinyint NOT NULL,
  `mar` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `sh_gat` tinyint NOT NULL,
  `m_zamin` tinyint NOT NULL,
  `no_mal` tinyint NOT NULL,
  `no_kesh` tinyint NOT NULL,
  `m_ab` tinyint NOT NULL,
  `no_ab` tinyint NOT NULL,
  `t_mah` tinyint NOT NULL,
  `ayesh` tinyint NOT NULL,
  `abadi` tinyint NOT NULL,
  `shahr` tinyint NOT NULL,
  `z_sal` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Agri05`
--

DROP TABLE IF EXISTS `V_Agri05`;
/*!50001 DROP VIEW IF EXISTS `V_Agri05`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Agri05` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `ostan` tinyint NOT NULL,
  `city` tinyint NOT NULL,
  `mar` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `sh_gat` tinyint NOT NULL,
  `m_zamin` tinyint NOT NULL,
  `no_mal` tinyint NOT NULL,
  `no_kesh` tinyint NOT NULL,
  `m_ab` tinyint NOT NULL,
  `no_ab` tinyint NOT NULL,
  `t_mah` tinyint NOT NULL,
  `ayesh` tinyint NOT NULL,
  `abadi` tinyint NOT NULL,
  `shahr` tinyint NOT NULL,
  `z_sal` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Agri06`
--

DROP TABLE IF EXISTS `V_Agri06`;
/*!50001 DROP VIEW IF EXISTS `V_Agri06`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Agri06` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `ostan` tinyint NOT NULL,
  `city` tinyint NOT NULL,
  `mar` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `sh_gat` tinyint NOT NULL,
  `m_zamin` tinyint NOT NULL,
  `no_mal` tinyint NOT NULL,
  `no_kesh` tinyint NOT NULL,
  `m_ab` tinyint NOT NULL,
  `no_ab` tinyint NOT NULL,
  `t_mah` tinyint NOT NULL,
  `ayesh` tinyint NOT NULL,
  `abadi` tinyint NOT NULL,
  `shahr` tinyint NOT NULL,
  `z_sal` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Agri_prod`
--

DROP TABLE IF EXISTS `V_Agri_prod`;
/*!50001 DROP VIEW IF EXISTS `V_Agri_prod`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Agri_prod` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `ostan` tinyint NOT NULL,
  `city` tinyint NOT NULL,
  `mar` tinyint NOT NULL,
  `b_codm` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `gat` tinyint NOT NULL,
  `kesh` tinyint NOT NULL,
  `sal` tinyint NOT NULL,
  `qroup` tinyint NOT NULL,
  `cod_mah` tinyint NOT NULL,
  `kesht1` tinyint NOT NULL,
  `kesht2` tinyint NOT NULL,
  `bar1` tinyint NOT NULL,
  `bar2` tinyint NOT NULL,
  `pmah` tinyint NOT NULL,
  `mah` tinyint NOT NULL,
  `bem` tinyint NOT NULL,
  `kh` tinyint NOT NULL,
  `abadi` tinyint NOT NULL,
  `shahr` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Agri_prod03`
--

DROP TABLE IF EXISTS `V_Agri_prod03`;
/*!50001 DROP VIEW IF EXISTS `V_Agri_prod03`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Agri_prod03` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `ostan` tinyint NOT NULL,
  `city` tinyint NOT NULL,
  `mar` tinyint NOT NULL,
  `b_codm` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `gat` tinyint NOT NULL,
  `kesh` tinyint NOT NULL,
  `sal` tinyint NOT NULL,
  `qroup` tinyint NOT NULL,
  `cod_mah` tinyint NOT NULL,
  `kesht1` tinyint NOT NULL,
  `kesht2` tinyint NOT NULL,
  `bar1` tinyint NOT NULL,
  `bar2` tinyint NOT NULL,
  `pmah` tinyint NOT NULL,
  `mah` tinyint NOT NULL,
  `bem` tinyint NOT NULL,
  `kh` tinyint NOT NULL,
  `abadi` tinyint NOT NULL,
  `shahr` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Agri_prod04`
--

DROP TABLE IF EXISTS `V_Agri_prod04`;
/*!50001 DROP VIEW IF EXISTS `V_Agri_prod04`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Agri_prod04` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `ostan` tinyint NOT NULL,
  `city` tinyint NOT NULL,
  `mar` tinyint NOT NULL,
  `b_codm` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `gat` tinyint NOT NULL,
  `kesh` tinyint NOT NULL,
  `sal` tinyint NOT NULL,
  `qroup` tinyint NOT NULL,
  `cod_mah` tinyint NOT NULL,
  `kesht1` tinyint NOT NULL,
  `kesht2` tinyint NOT NULL,
  `bar1` tinyint NOT NULL,
  `bar2` tinyint NOT NULL,
  `pmah` tinyint NOT NULL,
  `mah` tinyint NOT NULL,
  `bem` tinyint NOT NULL,
  `kh` tinyint NOT NULL,
  `abadi` tinyint NOT NULL,
  `shahr` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Agri_prod05`
--

DROP TABLE IF EXISTS `V_Agri_prod05`;
/*!50001 DROP VIEW IF EXISTS `V_Agri_prod05`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Agri_prod05` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `ostan` tinyint NOT NULL,
  `city` tinyint NOT NULL,
  `mar` tinyint NOT NULL,
  `b_codm` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `gat` tinyint NOT NULL,
  `kesh` tinyint NOT NULL,
  `sal` tinyint NOT NULL,
  `qroup` tinyint NOT NULL,
  `cod_mah` tinyint NOT NULL,
  `kesht1` tinyint NOT NULL,
  `kesht2` tinyint NOT NULL,
  `bar1` tinyint NOT NULL,
  `bar2` tinyint NOT NULL,
  `pmah` tinyint NOT NULL,
  `mah` tinyint NOT NULL,
  `bem` tinyint NOT NULL,
  `kh` tinyint NOT NULL,
  `abadi` tinyint NOT NULL,
  `shahr` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Agri_prod06`
--

DROP TABLE IF EXISTS `V_Agri_prod06`;
/*!50001 DROP VIEW IF EXISTS `V_Agri_prod06`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Agri_prod06` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `ostan` tinyint NOT NULL,
  `city` tinyint NOT NULL,
  `mar` tinyint NOT NULL,
  `b_codm` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `gat` tinyint NOT NULL,
  `kesh` tinyint NOT NULL,
  `sal` tinyint NOT NULL,
  `qroup` tinyint NOT NULL,
  `cod_mah` tinyint NOT NULL,
  `kesht1` tinyint NOT NULL,
  `kesht2` tinyint NOT NULL,
  `bar1` tinyint NOT NULL,
  `bar2` tinyint NOT NULL,
  `pmah` tinyint NOT NULL,
  `mah` tinyint NOT NULL,
  `bem` tinyint NOT NULL,
  `kh` tinyint NOT NULL,
  `abadi` tinyint NOT NULL,
  `shahr` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Animal_Num`
--

DROP TABLE IF EXISTS `V_Animal_Num`;
/*!50001 DROP VIEW IF EXISTS `V_Animal_Num`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Animal_Num` (
 `id` tinyint NOT NULL,
  `partIDCode` tinyint NOT NULL,
  `sal` tinyint NOT NULL,
  `species` tinyint NOT NULL,
  `breed` tinyint NOT NULL,
  `gender` tinyint NOT NULL,
  `age` tinyint NOT NULL,
  `activity` tinyint NOT NULL,
  `quantity` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Animal_unit`
--

DROP TABLE IF EXISTS `V_Animal_unit`;
/*!50001 DROP VIEW IF EXISTS `V_Animal_unit`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Animal_unit` (
 `id` tinyint NOT NULL,
  `date_s` tinyint NOT NULL,
  `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `PartIdCode` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `vaz_s` tinyint NOT NULL,
  `epidemiologic` tinyint NOT NULL,
  `unit_postal_code` tinyint NOT NULL,
  `longitude` tinyint NOT NULL,
  `latitude` tinyint NOT NULL,
  `coordinates` tinyint NOT NULL,
  `unit_types` tinyint NOT NULL,
  `capacity` tinyint NOT NULL,
  `license_status` tinyint NOT NULL,
  `rent_status` tinyint NOT NULL,
  `active_status` tinyint NOT NULL,
  `docNum` tinyint NOT NULL,
  `entry_date` tinyint NOT NULL,
  `isikCode` tinyint NOT NULL,
  `licenseType` tinyint NOT NULL,
  `validityDate` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Garden`
--

DROP TABLE IF EXISTS `V_Garden`;
/*!50001 DROP VIEW IF EXISTS `V_Garden`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Garden` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `sh_gat` tinyint NOT NULL,
  `m_zamin` tinyint NOT NULL,
  `no_mal` tinyint NOT NULL,
  `no_kesh` tinyint NOT NULL,
  `nah_kesh` tinyint NOT NULL,
  `m_ab` tinyint NOT NULL,
  `t_mah` tinyint NOT NULL,
  `z_sal` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Garden_prod`
--

DROP TABLE IF EXISTS `V_Garden_prod`;
/*!50001 DROP VIEW IF EXISTS `V_Garden_prod`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Garden_prod` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `sh_gat` tinyint NOT NULL,
  `no_kesh` tinyint NOT NULL,
  `nah_kesh` tinyint NOT NULL,
  `z_sal` tinyint NOT NULL,
  `cod_qroup` tinyint NOT NULL,
  `cod_mah` tinyint NOT NULL,
  `s_kesht_b` tinyint NOT NULL,
  `s_kesht_gb` tinyint NOT NULL,
  `tree_b` tinyint NOT NULL,
  `tree_gb` tinyint NOT NULL,
  `mah_tol` tinyint NOT NULL,
  `mah_tolp` tinyint NOT NULL,
  `mah_bem` tinyint NOT NULL,
  `mah_kh` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Green`
--

DROP TABLE IF EXISTS `V_Green`;
/*!50001 DROP VIEW IF EXISTS `V_Green`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Green` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `m_zamin` tinyint NOT NULL,
  `no_mal` tinyint NOT NULL,
  `no_kesht` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Green_Fun`
--

DROP TABLE IF EXISTS `V_Green_Fun`;
/*!50001 DROP VIEW IF EXISTS `V_Green_Fun`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Green_Fun` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `unit_id` tinyint NOT NULL,
  `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `y_prod` tinyint NOT NULL,
  `v_unit` tinyint NOT NULL,
  `no_mtol` tinyint NOT NULL,
  `no_kesht` tinyint NOT NULL,
  `t_mah` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Green_Pro`
--

DROP TABLE IF EXISTS `V_Green_Pro`;
/*!50001 DROP VIEW IF EXISTS `V_Green_Pro`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Green_Pro` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `unit_id` tinyint NOT NULL,
  `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `y_prod` tinyint NOT NULL,
  `no_kesht` tinyint NOT NULL,
  `group_cod` tinyint NOT NULL,
  `mah_cod` tinyint NOT NULL,
  `s_kesh` tinyint NOT NULL,
  `m_tol` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Mush`
--

DROP TABLE IF EXISTS `V_Mush`;
/*!50001 DROP VIEW IF EXISTS `V_Mush`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Mush` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `no_mush` tinyint NOT NULL,
  `m_zamin` tinyint NOT NULL,
  `m_arseh` tinyint NOT NULL,
  `m_salon` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Mush_Pro`
--

DROP TABLE IF EXISTS `V_Mush_Pro`;
/*!50001 DROP VIEW IF EXISTS `V_Mush_Pro`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Mush_Pro` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `unit_id` tinyint NOT NULL,
  `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `y_prod` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `no_mush` tinyint NOT NULL,
  `v_unit` tinyint NOT NULL,
  `t_dpar` tinyint NOT NULL,
  `zer_kesh` tinyint NOT NULL,
  `mah_tol` tinyint NOT NULL,
  `tol_avg` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Vege`
--

DROP TABLE IF EXISTS `V_Vege`;
/*!50001 DROP VIEW IF EXISTS `V_Vege`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Vege` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL,
  `z_sal` tinyint NOT NULL,
  `b_time` tinyint NOT NULL,
  `m_ab` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `sh_gat` tinyint NOT NULL,
  `no_bah` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_Vege_prod`
--

DROP TABLE IF EXISTS `V_Vege_prod`;
/*!50001 DROP VIEW IF EXISTS `V_Vege_prod`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_Vege_prod` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL,
  `b_time` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `no_bah` tinyint NOT NULL,
  `sh_gat` tinyint NOT NULL,
  `z_sal` tinyint NOT NULL,
  `ra_kesh` tinyint NOT NULL,
  `cod_mah` tinyint NOT NULL,
  `ragham` tinyint NOT NULL,
  `zer_kesht` tinyint NOT NULL,
  `no_ab` tinyint NOT NULL,
  `mah_bem` tinyint NOT NULL,
  `mah_tol` tinyint NOT NULL,
  `s_bar` tinyint NOT NULL,
  `mah_tolp` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_bah`
--

DROP TABLE IF EXISTS `V_bah`;
/*!50001 DROP VIEW IF EXISTS `V_bah`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_bah` (
 `id` tinyint NOT NULL,
  `date_s` tinyint NOT NULL,
  `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `no_bah` tinyint NOT NULL,
  `num_bah` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `last_name` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `co_name` tinyint NOT NULL,
  `sh_meli` tinyint NOT NULL,
  `date_t` tinyint NOT NULL,
  `jens` tinyint NOT NULL,
  `m_tah` tinyint NOT NULL,
  `s_bah` tinyint NOT NULL,
  `tel_m` tinyint NOT NULL,
  `valid` tinyint NOT NULL,
  `no_nation` tinyint NOT NULL,
  `ok` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_bah_amar`
--

DROP TABLE IF EXISTS `V_bah_amar`;
/*!50001 DROP VIEW IF EXISTS `V_bah_amar`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_bah_amar` (
 `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL,
  `s_bah` tinyint NOT NULL,
  `no_bah` tinyint NOT NULL,
  `cod_p` tinyint NOT NULL,
  `jens` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `last_name` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `date_t` tinyint NOT NULL,
  `tel_s` tinyint NOT NULL,
  `tel_m` tinyint NOT NULL,
  `co_name` tinyint NOT NULL,
  `sh_meli` tinyint NOT NULL,
  `fa_1` tinyint NOT NULL,
  `fa_2` tinyint NOT NULL,
  `fa_3` tinyint NOT NULL,
  `fa_45` tinyint NOT NULL,
  `fa_67` tinyint NOT NULL,
  `fa_8` tinyint NOT NULL,
  `fa_9` tinyint NOT NULL,
  `fa_10` tinyint NOT NULL,
  `fa_11` tinyint NOT NULL,
  `fa_12` tinyint NOT NULL,
  `fa_13` tinyint NOT NULL,
  `fa_14` tinyint NOT NULL,
  `no_nation` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `V_bee`
--

DROP TABLE IF EXISTS `V_bee`;
/*!50001 DROP VIEW IF EXISTS `V_bee`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `V_bee` (
 `id` tinyint NOT NULL,
  `mor_cod_m` tinyint NOT NULL,
  `sal` tinyint NOT NULL,
  `id_ostan` tinyint NOT NULL,
  `id_city` tinyint NOT NULL,
  `id_mar` tinyint NOT NULL,
  `no_zan` tinyint NOT NULL,
  `m_ostan` tinyint NOT NULL,
  `m_city` tinyint NOT NULL,
  `vaz_zan` tinyint NOT NULL,
  `bem_zan` tinyint NOT NULL,
  `bem_kand` tinyint NOT NULL,
  `bah_cod_m` tinyint NOT NULL,
  `t_sha` tinyint NOT NULL,
  `tk_mo` tinyint NOT NULL,
  `tk_bo` tinyint NOT NULL,
  `to_mo` tinyint NOT NULL,
  `to_bo` tinyint NOT NULL,
  `t_gar` tinyint NOT NULL,
  `t_bar` tinyint NOT NULL,
  `t_mom` tinyint NOT NULL,
  `t_k_jel` tinyint NOT NULL,
  `t_jel` tinyint NOT NULL,
  `t_zah` tinyint NOT NULL,
  `add_abadi` tinyint NOT NULL,
  `add_city` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `Vege`
--

DROP TABLE IF EXISTS `Vege`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Vege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `no_bah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sh_gat` int(3) NOT NULL,
  `m_zamin` float(11,2) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `m_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `b_time` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` int(2) NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `confi` varchar(1) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `date_confi` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `confi2` varchar(1) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `date_confi2` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `check_cod_2` (`mor_cod_m`,`date_s`,`bah_cod_m`,`m_zamin`,`t_mah`,`z_sal`,`m_ab`,`add_abadi`,`add_city`,`lng`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `z_sal` (`z_sal`),
  KEY `confi` (`confi`),
  KEY `confi2` (`confi2`)
) ENGINE=MyISAM AUTO_INCREMENT=1015832 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=FIXED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Vege_e_ostan`
--

DROP TABLE IF EXISTS `Vege_e_ostan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Vege_e_ostan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `b_s_zk` int(10) NOT NULL,
  `b_p_t` int(10) NOT NULL,
  `t_s_zk` int(10) NOT NULL,
  `t_p_t` int(10) NOT NULL,
  `p_s_zk` int(10) NOT NULL,
  `p_p_t` int(10) NOT NULL,
  `z_s_zk` int(10) NOT NULL,
  `z_p_t` int(10) NOT NULL,
  `s_zk` int(10) NOT NULL,
  `p_t` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1922 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Vege_prod`
--

DROP TABLE IF EXISTS `Vege_prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Vege_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Vege_id` int(11) NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `b_time` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_bah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sh_gat` int(3) NOT NULL,
  `ra_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht` float(11,3) NOT NULL,
  `ragham` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `no_ab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `date_ab` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `sal_ab` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `mah_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `roz_ab` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `s_bar` float(11,3) DEFAULT NULL,
  `mah_tol` float(15,3) DEFAULT NULL,
  `mah_tolp` float(15,3) DEFAULT NULL,
  `dah_bazar` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mah_bazar` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `z_sal` (`z_sal`),
  KEY `cod_mah` (`cod_mah`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `zer_kesht` (`no_ab`),
  KEY `Vege_id` (`Vege_id`),
  KEY `s_bar` (`s_bar`)
) ENGINE=MyISAM AUTO_INCREMENT=1319803 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=FIXED;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `animals`
--

DROP TABLE IF EXISTS `animals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partIDCode` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `sal` int(11) NOT NULL,
  `species` int(11) NOT NULL,
  `breed` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `activity` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `partIDCode` (`partIDCode`),
  KEY `sal` (`sal`),
  KEY `species` (`species`)
) ENGINE=MyISAM AUTO_INCREMENT=317522 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `animals_unit`
--

DROP TABLE IF EXISTS `animals_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animals_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(16) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `PartIdCode` varchar(15) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `vaz_s` int(1) NOT NULL,
  `epidemiologic` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `unit_postal_code` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `postal_address` text COLLATE utf8_persian_ci NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `coordinates` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `unit_name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `unit_types` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `capacity` double NOT NULL,
  `license_status` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rent_status` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `active_status` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `docNum` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `entry_date` datetime NOT NULL,
  `Product_Name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `isikCode` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `licenseType` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `validityDate` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `PartIdCode` (`PartIdCode`),
  KEY `bah_cod_m` (`bah_cod_m`)
) ENGINE=MyISAM AUTO_INCREMENT=125169 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `aria`
--

DROP TABLE IF EXISTS `aria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_aria` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=660 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `b_sal`
--

DROP TABLE IF EXISTS `b_sal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_sal` (
  `sal` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`sal`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bah`
--

DROP TABLE IF EXISTS `bah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `sp_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `no_bah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `s_bah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(1) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `cod_p` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `jens` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `date_t` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `sh_sh` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `m_sod` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `fname` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `m_tah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `er_mtah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `tel_s` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `tel_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `valid` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `ostan_s` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `shahr_s` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `city_s` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `rosta_s` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `co_name` varchar(150) COLLATE utf8_persian_ci NOT NULL,
  `sh_meli` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `no_co` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `co_sabt` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `fa_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `fa_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `fa_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `fa_45` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `fa_67` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `fa_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `fa_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `fa_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `fa_11` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `fa_12` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `fa_13` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `fa_14` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `confi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_nation` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `nation` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_bah` (`no_bah`,`bah_cod_m`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `date_s` (`date_s`),
  KEY `add_city` (`add_city`),
  KEY `confi` (`confi`),
  KEY `last_name` (`last_name`),
  KEY `num_bah` (`num_bah`),
  KEY `sh_meli` (`sh_meli`),
  KEY `cod_p` (`cod_p`),
  KEY `ok` (`ok`),
  KEY `jens` (`jens`),
  KEY `tel_m` (`tel_m`),
  KEY `sp_cod_m` (`sp_cod_m`),
  KEY `valid` (`valid`)
) ENGINE=InnoDB AUTO_INCREMENT=12261173 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bakhname1403`
--

DROP TABLE IF EXISTS `bakhname1403`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bakhname1403` (
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_bakh` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `bakh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_ostan` (`id_ostan`,`id_city`,`bakh`),
  KEY `id_bakh` (`id_bakh`)
) ENGINE=MyISAM AUTO_INCREMENT=1192 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bakhname1404`
--

DROP TABLE IF EXISTS `bakhname1404`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bakhname1404` (
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_bakh` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `bakh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  UNIQUE KEY `id_ostan` (`id_ostan`,`id_city`,`bakh`),
  KEY `id_bakh` (`id_bakh`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bee`
--

DROP TABLE IF EXISTS `bee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bee` (
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `sal` varchar(4) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `lng` float(10,6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `no_zan` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `cod_sh` varchar(16) COLLATE utf8_persian_ci NOT NULL,
  `sh_zan` varchar(16) COLLATE utf8_persian_ci NOT NULL,
  `vaz_zan` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `bem_zan` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `bem_kand` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `oz_tav` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_sha` int(2) NOT NULL,
  `e_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `g_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `m_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `m_city` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `no_mo` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `m_nejad1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_nejad2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_nejad3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_nejad4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_nejad5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `tm_kh` float(4,0) NOT NULL,
  `tm_arz` float(4,0) NOT NULL,
  `mk_nejad1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mk_nejad2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mk_nejad3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mk_nejad4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mk_nejad5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `tmk_nejad1` float(4,0) NOT NULL,
  `tmk_nejad2` float(4,0) NOT NULL,
  `tmk_nejad3` float(4,0) NOT NULL,
  `tmk_nejad4` float(4,0) NOT NULL,
  `tmk_nejad5` float(4,0) NOT NULL,
  `m_shaker` float(7,2) NOT NULL,
  `tk_mo` int(10) NOT NULL,
  `tk_bo` int(10) NOT NULL,
  `to_mo` float(8,2) NOT NULL,
  `to_bo` float(8,2) NOT NULL,
  `t_gar` float(8,2) NOT NULL,
  `t_bar` float(8,2) NOT NULL,
  `t_mom` float(8,2) NOT NULL,
  `t_k_jel` float(10,0) NOT NULL,
  `t_jel` float(8,1) NOT NULL,
  `t_k_nan` float(10,0) NOT NULL,
  `t_nan` float(8,1) NOT NULL,
  `t_zah` float(8,1) NOT NULL,
  `tal_h_sam` float(4,0) NOT NULL,
  `tal_h_sel` float(4,0) NOT NULL,
  `tal_h_hv` float(4,0) NOT NULL,
  `tal_h_kh` float(4,0) NOT NULL,
  `tal_h_s` float(4,0) NOT NULL,
  `tal_b_var` float(4,0) NOT NULL,
  `tal_b_noz` float(4,0) NOT NULL,
  `tal_b_ccd` float(4,0) NOT NULL,
  `tal_b_lav` float(4,0) NOT NULL,
  `tal_b_s` float(4,0) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(36) COLLATE utf8_persian_ci NOT NULL,
  `tashilat` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `hijrat_jonub` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `faal_jel` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '0',
  `faal_asal` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '0',
  `faal_malek` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '0',
  `faal_garde` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '0',
  `faal_bare` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '0',
  `shop_bee` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `pack_bee` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `taj_khor` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `taj_khor_need` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '0',
  `taj_motor` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `taj_motor_need` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '0',
  `taj_vanet` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `taj_vanet_need` varchar(8) COLLATE utf8_persian_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sal_2` (`sal`,`id_ostan`,`id_city`,`id_mar`,`bah_cod_m`,`tk_mo`,`tk_bo`,`to_mo`,`to_bo`,`t_gar`,`t_bar`,`t_mom`,`t_jel`,`add_abadi`,`add_city`,`num_bah`),
  KEY `sal` (`sal`),
  KEY `add_abadi` (`add_abadi`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `add_city` (`add_city`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `num_bah` (`num_bah`),
  KEY `unique_id` (`unique_id`),
  KEY `m_ostan` (`m_ostan`),
  KEY `m_city` (`m_city`)
) ENGINE=InnoDB AUTO_INCREMENT=854116 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bee_equipment`
--

DROP TABLE IF EXISTS `bee_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bee_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `sal` varchar(4) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `no_zan` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `taj_2_exists` tinyint(4) DEFAULT NULL,
  `taj_2_needed` tinyint(4) DEFAULT NULL,
  `taj_3_exists` tinyint(4) DEFAULT NULL,
  `taj_3_needed` tinyint(4) DEFAULT NULL,
  `taj_4_exists` tinyint(4) DEFAULT NULL,
  `taj_4_needed` tinyint(4) DEFAULT NULL,
  `taj_5_exists` tinyint(4) DEFAULT NULL,
  `taj_5_needed` tinyint(4) DEFAULT NULL,
  `taj_6_exists` tinyint(4) DEFAULT NULL,
  `taj_6_needed` tinyint(4) DEFAULT NULL,
  `taj_7_exists` tinyint(4) DEFAULT NULL,
  `taj_7_needed` tinyint(4) DEFAULT NULL,
  `taj_8_exists` tinyint(4) DEFAULT NULL,
  `taj_8_needed` tinyint(4) DEFAULT NULL,
  `taj_9_exists` tinyint(4) DEFAULT NULL,
  `taj_9_needed` tinyint(4) DEFAULT NULL,
  `taj_10_exists` tinyint(4) DEFAULT NULL,
  `taj_10_needed` tinyint(4) DEFAULT NULL,
  `taj_11_exists` tinyint(4) DEFAULT NULL,
  `taj_11_needed` tinyint(4) DEFAULT NULL,
  `taj_12_exists` tinyint(4) DEFAULT NULL,
  `taj_12_needed` tinyint(4) DEFAULT NULL,
  `taj_13_exists` tinyint(4) DEFAULT NULL,
  `taj_13_needed` tinyint(4) DEFAULT NULL,
  `taj_14_exists` tinyint(4) DEFAULT NULL,
  `taj_14_needed` tinyint(4) DEFAULT NULL,
  `taj_15_exists` tinyint(4) DEFAULT NULL,
  `taj_15_needed` tinyint(4) DEFAULT NULL,
  `taj_16_exists` tinyint(4) DEFAULT NULL,
  `taj_16_needed` tinyint(4) DEFAULT NULL,
  `taj_17_exists` tinyint(4) DEFAULT NULL,
  `taj_17_needed` tinyint(4) DEFAULT NULL,
  `taj_18_exists` tinyint(4) DEFAULT NULL,
  `taj_18_needed` tinyint(4) DEFAULT NULL,
  `taj_19_exists` tinyint(4) DEFAULT NULL,
  `taj_19_needed` tinyint(4) DEFAULT NULL,
  `taj_20_exists` tinyint(4) DEFAULT NULL,
  `taj_20_needed` tinyint(4) DEFAULT NULL,
  `unique_id` varchar(36) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sal` (`sal`),
  KEY `add_abadi` (`add_abadi`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `add_city` (`add_city`),
  KEY `bah_cod_m` (`bah_cod_m`),
  KEY `num_bah` (`num_bah`),
  KEY `unique_id` (`unique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72893 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `change_mor`
--

DROP TABLE IF EXISTS `change_mor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `change_mor` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `mar` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `abadi` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `mor_codm_old` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `mor_codm_new` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `Last_name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `no_request` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `date_a` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `status` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=333108 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cityname`
--

DROP TABLE IF EXISTS `cityname`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cityname` (
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `idx_cityname` (`id_ostan`,`id_city`)
) ENGINE=MyISAM AUTO_INCREMENT=485 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dash_snap_agri_locked`
--

DROP TABLE IF EXISTS `dash_snap_agri_locked`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dash_snap_agri_locked` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_agri` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `level_code` enum('country','ostan','city') COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `plant_abi` double NOT NULL DEFAULT '0',
  `plant_dim` double NOT NULL DEFAULT '0',
  `harvest_abi` double NOT NULL DEFAULT '0',
  `harvest_dim` double NOT NULL DEFAULT '0',
  `prod_abi` double NOT NULL DEFAULT '0',
  `prod_dim` double NOT NULL DEFAULT '0',
  `pred_abi` double NOT NULL DEFAULT '0',
  `pred_dim` double NOT NULL DEFAULT '0',
  `plan_abi` double NOT NULL DEFAULT '0',
  `plan_dim` double NOT NULL DEFAULT '0',
  `built_at` datetime NOT NULL,
  `build_ms` int(10) unsigned DEFAULT NULL,
  `source_ver` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dash_snap_agri_locked` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`product_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=73833 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dash_snap_agri_open`
--

DROP TABLE IF EXISTS `dash_snap_agri_open`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dash_snap_agri_open` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_agri` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `level_code` enum('country','ostan','city') COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `plant_abi` double NOT NULL DEFAULT '0',
  `plant_dim` double NOT NULL DEFAULT '0',
  `harvest_abi` double NOT NULL DEFAULT '0',
  `harvest_dim` double NOT NULL DEFAULT '0',
  `prod_abi` double NOT NULL DEFAULT '0',
  `prod_dim` double NOT NULL DEFAULT '0',
  `pred_abi` double NOT NULL DEFAULT '0',
  `pred_dim` double NOT NULL DEFAULT '0',
  `plan_abi` double NOT NULL DEFAULT '0',
  `plan_dim` double NOT NULL DEFAULT '0',
  `built_at` datetime NOT NULL,
  `build_ms` int(10) unsigned DEFAULT NULL,
  `source_ver` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dash_snap_agri_open` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`product_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=98313 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dash_snap_bah`
--

DROP TABLE IF EXISTS `dash_snap_bah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dash_snap_bah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_code` enum('country','ostan','city') COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `name_label` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_total` int(10) unsigned NOT NULL DEFAULT '0',
  `bah_natural` int(10) unsigned NOT NULL DEFAULT '0',
  `bah_legal` int(10) unsigned NOT NULL DEFAULT '0',
  `bah_male` int(10) unsigned NOT NULL DEFAULT '0',
  `bah_female` int(10) unsigned NOT NULL DEFAULT '0',
  `extra_text` mediumtext COLLATE utf8_persian_ci COMMENT 'JSON: bah dashboard kpi/places',
  `built_at` datetime NOT NULL,
  `build_ms` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dash_snap_bah` (`level_code`,`id_ostan`,`id_city`)
) ENGINE=InnoDB AUTO_INCREMENT=2176 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dash_snap_garden_locked`
--

DROP TABLE IF EXISTS `dash_snap_garden_locked`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dash_snap_garden_locked` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_agri` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `level_code` enum('country','ostan','city') COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `baror_abi` double NOT NULL DEFAULT '0',
  `baror_dim` double NOT NULL DEFAULT '0',
  `nonbaror_abi` double NOT NULL DEFAULT '0',
  `nonbaror_dim` double NOT NULL DEFAULT '0',
  `tree_b_abi` double NOT NULL DEFAULT '0',
  `tree_b_dim` double NOT NULL DEFAULT '0',
  `tree_gb_abi` double NOT NULL DEFAULT '0',
  `tree_gb_dim` double NOT NULL DEFAULT '0',
  `prod_abi` double NOT NULL DEFAULT '0',
  `prod_dim` double NOT NULL DEFAULT '0',
  `pred_abi` double NOT NULL DEFAULT '0',
  `pred_dim` double NOT NULL DEFAULT '0',
  `plan_bar_abi` double NOT NULL DEFAULT '0',
  `plan_bar_dim` double NOT NULL DEFAULT '0',
  `plan_nobar_abi` double NOT NULL DEFAULT '0',
  `plan_nobar_dim` double NOT NULL DEFAULT '0',
  `cut_bar_abi` double NOT NULL DEFAULT '0',
  `cut_bar_dim` double NOT NULL DEFAULT '0',
  `cut_nobar_abi` double NOT NULL DEFAULT '0',
  `cut_nobar_dim` double NOT NULL DEFAULT '0',
  `built_at` datetime NOT NULL,
  `build_ms` int(10) unsigned DEFAULT NULL,
  `source_ver` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dash_snap_garden_locked` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`product_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=72142 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dash_snap_garden_open`
--

DROP TABLE IF EXISTS `dash_snap_garden_open`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dash_snap_garden_open` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_agri` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `level_code` enum('country','ostan','city') COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `baror_abi` double NOT NULL DEFAULT '0',
  `baror_dim` double NOT NULL DEFAULT '0',
  `nonbaror_abi` double NOT NULL DEFAULT '0',
  `nonbaror_dim` double NOT NULL DEFAULT '0',
  `tree_b_abi` double NOT NULL DEFAULT '0',
  `tree_b_dim` double NOT NULL DEFAULT '0',
  `tree_gb_abi` double NOT NULL DEFAULT '0',
  `tree_gb_dim` double NOT NULL DEFAULT '0',
  `prod_abi` double NOT NULL DEFAULT '0',
  `prod_dim` double NOT NULL DEFAULT '0',
  `pred_abi` double NOT NULL DEFAULT '0',
  `pred_dim` double NOT NULL DEFAULT '0',
  `plan_bar_abi` double NOT NULL DEFAULT '0',
  `plan_bar_dim` double NOT NULL DEFAULT '0',
  `plan_nobar_abi` double NOT NULL DEFAULT '0',
  `plan_nobar_dim` double NOT NULL DEFAULT '0',
  `cut_bar_abi` double NOT NULL DEFAULT '0',
  `cut_bar_dim` double NOT NULL DEFAULT '0',
  `cut_nobar_abi` double NOT NULL DEFAULT '0',
  `cut_nobar_dim` double NOT NULL DEFAULT '0',
  `built_at` datetime NOT NULL,
  `build_ms` int(10) unsigned DEFAULT NULL,
  `source_ver` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dash_snap_garden_open` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`product_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=32112 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dash_snap_locked`
--

DROP TABLE IF EXISTS `dash_snap_locked`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dash_snap_locked` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_agri` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `level_code` enum('country','ostan','city','mar') COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `name_label` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `cnt_agri` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_garden` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_greenhouse` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_mushroom` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_bee` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_animal` int(10) unsigned NOT NULL DEFAULT '0',
  `area_abi` double NOT NULL DEFAULT '0',
  `area_dim` double NOT NULL DEFAULT '0',
  `area_garden_b` double NOT NULL DEFAULT '0',
  `area_garden_gb` double NOT NULL DEFAULT '0',
  `prod_agri` double NOT NULL DEFAULT '0',
  `prod_garden` double NOT NULL DEFAULT '0',
  `users_zone` int(10) unsigned NOT NULL DEFAULT '0',
  `users_staff` int(10) unsigned NOT NULL DEFAULT '0',
  `users_admin` int(10) unsigned NOT NULL DEFAULT '0',
  `children_text` mediumtext COLLATE utf8_persian_ci COMMENT 'لیست فرزند/نقشه به صورت JSON متنی',
  `visits_text` text COLLATE utf8_persian_ci COMMENT 'بازدیدها JSON متنی (اختیاری)',
  `extra_text` mediumtext COLLATE utf8_persian_ci COMMENT 'JSON: garden_area detail, bah, rank',
  `built_at` datetime NOT NULL,
  `build_ms` int(10) unsigned DEFAULT NULL,
  `source_ver` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dash_snap_locked` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`id_mar`),
  KEY `idx_dash_snap_locked_lookup` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`id_mar`)
) ENGINE=InnoDB AUTO_INCREMENT=2069 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dash_snap_open`
--

DROP TABLE IF EXISTS `dash_snap_open`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dash_snap_open` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_agri` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `level_code` enum('country','ostan','city','mar') COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `name_label` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `cnt_agri` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_garden` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_greenhouse` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_mushroom` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_bee` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_animal` int(10) unsigned NOT NULL DEFAULT '0',
  `area_abi` double NOT NULL DEFAULT '0',
  `area_dim` double NOT NULL DEFAULT '0',
  `area_garden_b` double NOT NULL DEFAULT '0',
  `area_garden_gb` double NOT NULL DEFAULT '0',
  `prod_agri` double NOT NULL DEFAULT '0',
  `prod_garden` double NOT NULL DEFAULT '0',
  `users_zone` int(10) unsigned NOT NULL DEFAULT '0',
  `users_staff` int(10) unsigned NOT NULL DEFAULT '0',
  `users_admin` int(10) unsigned NOT NULL DEFAULT '0',
  `children_text` mediumtext COLLATE utf8_persian_ci COMMENT 'لیست فرزند/نقشه به صورت JSON متنی',
  `visits_text` text COLLATE utf8_persian_ci COMMENT 'بازدیدها JSON متنی (اختیاری)',
  `extra_text` mediumtext COLLATE utf8_persian_ci COMMENT 'JSON: garden_area detail, bah, rank',
  `built_at` datetime NOT NULL,
  `build_ms` int(10) unsigned DEFAULT NULL,
  `source_ver` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dash_snap_open` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`id_mar`),
  KEY `idx_dash_snap_open_lookup` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`id_mar`),
  KEY `idx_dash_snap_open_built` (`built_at`)
) ENGINE=InnoDB AUTO_INCREMENT=5870 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dash_snap_run`
--

DROP TABLE IF EXISTS `dash_snap_run`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dash_snap_run` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `started_at` datetime NOT NULL,
  `finished_at` datetime DEFAULT NULL,
  `status` enum('running','ok','fail') COLLATE utf8_persian_ci NOT NULL DEFAULT 'running',
  `target` enum('open','locked','both') COLLATE utf8_persian_ci NOT NULL DEFAULT 'open',
  `year_agri` varchar(4) COLLATE utf8_persian_ci DEFAULT NULL,
  `rows_written` int(10) unsigned NOT NULL DEFAULT '0',
  `error_text` text COLLATE utf8_persian_ci,
  `source_ver` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_dash_snap_run_started` (`started_at`),
  KEY `idx_dash_snap_run_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dash_year_status`
--

DROP TABLE IF EXISTS `dash_year_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dash_year_status` (
  `year_agri` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `domain` enum('agri','vege','garden','greenhouse','mushroom','bee','aquatic') COLLATE utf8_persian_ci NOT NULL,
  `status` enum('open','locked') COLLATE utf8_persian_ci NOT NULL DEFAULT 'locked',
  `label` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `source_table` varchar(64) COLLATE utf8_persian_ci DEFAULT NULL,
  `locked_at` datetime DEFAULT NULL,
  `locked_by` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`year_agri`,`domain`),
  KEY `idx_dash_year_domain_status` (`domain`,`status`),
  KEY `idx_dash_year_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `day`
--

DROP TABLE IF EXISTS `day`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `day` (
  `id` int(11) NOT NULL DEFAULT '1',
  `yesterday_shamsi_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `death`
--

DROP TABLE IF EXISTS `death`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `death` (
  `bah_cod_m` varchar(12) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `bah_cod_m` (`bah_cod_m`)
) ENGINE=InnoDB AUTO_INCREMENT=31504 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dehname1403`
--

DROP TABLE IF EXISTS `dehname1403`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dehname1403` (
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_bakh` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_deh` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `deh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_ostan` (`id_ostan`,`id_city`,`deh`),
  KEY `id_deh` (`id_deh`)
) ENGINE=MyISAM AUTO_INCREMENT=2776 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dehname1404`
--

DROP TABLE IF EXISTS `dehname1404`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dehname1404` (
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_bakh` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_deh` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `deh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  UNIQUE KEY `id_ostan` (`id_ostan`,`id_city`,`deh`),
  KEY `id_deh` (`id_deh`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `del_rec`
--

DROP TABLE IF EXISTS `del_rec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `del_rec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `cod_mah` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `Table_id` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `Table_name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `sal` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `num_bah` int(2) NOT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht_a` float(10,4) NOT NULL,
  `zer_kesht_b` float(10,4) NOT NULL,
  `mah_tolp` float(15,5) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `Type_Op` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `sal` (`sal`),
  KEY `bah_cod_m` (`bah_cod_m`)
) ENGINE=MyISAM AUTO_INCREMENT=2988909 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `del_rec_Garden`
--

DROP TABLE IF EXISTS `del_rec_Garden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `del_rec_Garden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_cod_m` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `cod_mah` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `Table_id` varchar(35) COLLATE utf8_persian_ci DEFAULT NULL,
  `Table_name` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `sal` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `num_bah` int(2) DEFAULT NULL,
  `no_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `nah_kesh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `s_kesht_b` float(12,4) DEFAULT NULL,
  `s_kesht_gb` float(12,4) DEFAULT NULL,
  `tree_b` int(11) DEFAULT NULL,
  `tree_gb` int(11) DEFAULT NULL,
  `mah_tolp` float(15,5) DEFAULT NULL,
  `mah_tol` float(15,5) DEFAULT NULL,
  `mah_bem` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `mah_kh` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_abadi` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `add_city` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `Type_Op` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `sal` (`sal`),
  KEY `bah_cod_m` (`bah_cod_m`)
) ENGINE=InnoDB AUTO_INCREMENT=850 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(20) NOT NULL,
  `bah_cod_m` varchar(20) NOT NULL,
  `Agri_id` int(11) NOT NULL,
  `s_bar_a` decimal(15,3) DEFAULT NULL,
  `s_bar_b` decimal(15,3) DEFAULT NULL,
  `mah_tol` decimal(15,3) DEFAULT NULL,
  `delivery_amount` decimal(15,3) DEFAULT NULL,
  `date_s` varchar(10) DEFAULT NULL,
  `time_s` varchar(20) DEFAULT NULL,
  `z_sal` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Agri_id` (`Agri_id`)
) ENGINE=InnoDB AUTO_INCREMENT=106960 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `eagri_data_mar_1404`
--

DROP TABLE IF EXISTS `eagri_data_mar_1404`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eagri_data_mar_1404` (
  `id_ostan` varchar(50) DEFAULT NULL,
  `id_city` varchar(50) DEFAULT NULL,
  `id_mar` varchar(50) DEFAULT NULL,
  `z_sal` varchar(50) DEFAULT NULL,
  `group_cod` varchar(50) DEFAULT NULL,
  `product_cod` varchar(50) DEFAULT NULL,
  `s_abi` double DEFAULT '0',
  `s_dem` double DEFAULT '0',
  `t_abi` double DEFAULT '0',
  `t_dem` double DEFAULT '0',
  `a_abi` double DEFAULT '0',
  `a_dem` double DEFAULT '0',
  `z_kesht_abi` double DEFAULT '0',
  `z_kesht_dem` double DEFAULT '0',
  `s_bar_abi` double DEFAULT '0',
  `s_bar_dem` double DEFAULT '0',
  `mah_tolp_abi` double DEFAULT '0',
  `mah_tolp_dem` double DEFAULT '0',
  `mah_tol_abi` double DEFAULT '0',
  `mah_tol_dem` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `eagri_data_mar_1405`
--

DROP TABLE IF EXISTS `eagri_data_mar_1405`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eagri_data_mar_1405` (
  `id_ostan` varchar(50) DEFAULT NULL,
  `id_city` varchar(50) DEFAULT NULL,
  `id_mar` varchar(50) DEFAULT NULL,
  `z_sal` varchar(50) DEFAULT NULL,
  `group_cod` varchar(50) DEFAULT NULL,
  `product_cod` varchar(50) DEFAULT NULL,
  `s_abi` double DEFAULT '0',
  `s_dem` double DEFAULT '0',
  `t_abi` double DEFAULT '0',
  `t_dem` double DEFAULT '0',
  `a_abi` double DEFAULT '0',
  `a_dem` double DEFAULT '0',
  `z_kesht_abi` double DEFAULT '0',
  `z_kesht_dem` double DEFAULT '0',
  `s_bar_abi` double DEFAULT '0',
  `s_bar_dem` double DEFAULT '0',
  `mah_tolp_abi` double DEFAULT '0',
  `mah_tolp_dem` double DEFAULT '0',
  `mah_tol_abi` double DEFAULT '0',
  `mah_tol_dem` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `h_status`
--

DROP TABLE IF EXISTS `h_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `h_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `cod_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `date_status` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `status` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_ostan` (`id_ostan`,`id_city`,`id_mar`,`cod_m`,`date_status`,`status`),
  KEY `cod_m` (`cod_m`)
) ENGINE=MyISAM AUTO_INCREMENT=58433 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ht_b`
--

DROP TABLE IF EXISTS `ht_b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ht_b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_mah` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `ht_ab` float(6,2) NOT NULL,
  `ht_dem` float(6,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ht_z`
--

DROP TABLE IF EXISTS `ht_z`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ht_z` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_mah` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `ht_ab` float(6,2) NOT NULL,
  `ht_dem` float(6,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ind_bah`
--

DROP TABLE IF EXISTS `ind_bah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ind_bah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `NationalCode` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `no_bah` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `cod_p` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `jens` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `date_t` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `sh_sh` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `fname` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `m_tah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `r_tah` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `tel_s` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `tel_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `co_name` varchar(700) COLLATE utf8_persian_ci NOT NULL,
  `no_co` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `co_sabt` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `date_sabt` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `addres` text COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `c_f_name` varchar(75) COLLATE utf8_persian_ci NOT NULL,
  `c_l_name` varchar(75) COLLATE utf8_persian_ci NOT NULL,
  `c_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `ShenaseKasboKar` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NationalCode` (`NationalCode`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `add_abadi` (`add_abadi`),
  KEY `date_s` (`date_s`),
  KEY `add_city` (`add_city`),
  KEY `last_name` (`last_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7831 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ind_list_product`
--

DROP TABLE IF EXISTS `ind_list_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ind_list_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `NationalCode` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `no_bah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `unit_name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `identCode` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `isic_code` varchar(15) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `zarfiyat` float(15,2) NOT NULL,
  `m_jazb` int(15) NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `ShenaseKasboKar` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `m_cod_m` (`identCode`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `NationalCode` (`NationalCode`),
  KEY `identCode` (`identCode`)
) ENGINE=InnoDB AUTO_INCREMENT=21229 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ind_unit`
--

DROP TABLE IF EXISTS `ind_unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ind_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `NationalCode` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `no_bah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `unit_name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `m_zamin` float(10,1) NOT NULL,
  `m_zmos` float(10,1) NOT NULL,
  `X1` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `Y1` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `Z1` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `Zone1` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `X2` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `Y2` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `Z2` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `Zone2` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `X3` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `Y3` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `Z3` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `Zone3` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `X4` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `Y4` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `Z4` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `Zone4` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `no_mal` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `no_mal_cod` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `identCode` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `ShenaseKasboKar` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `start_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `end_date` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `sarmayeh_s` int(10) NOT NULL,
  `sarmayeh_d` int(10) NOT NULL,
  `t_shagel` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `v_ab` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `g_en` float(5,2) NOT NULL,
  `v_ch` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_mch` varchar(15) COLLATE utf8_persian_ci NOT NULL,
  `date_mch` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `v_bar` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `amp` int(3) NOT NULL,
  `t_faz` int(3) NOT NULL,
  `v_gaz` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `v_tas` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `no_tas` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `v_tah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `v_rd` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identCode` (`NationalCode`,`identCode`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `m_cod_m` (`identCode`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `add_abadi` (`add_abadi`),
  KEY `add_city` (`add_city`),
  KEY `NationalCode` (`NationalCode`)
) ENGINE=InnoDB AUTO_INCREMENT=6694 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ind_unit_info`
--

DROP TABLE IF EXISTS `ind_unit_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ind_unit_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `NationalCode` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `ShenaseKasboKar` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `y_prod` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `d_prod` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `v_unit` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_mah` int(3) NOT NULL,
  `n_zd` int(5) NOT NULL,
  `n_d` int(5) NOT NULL,
  `n_fd` int(5) NOT NULL,
  `n_l` int(5) NOT NULL,
  `n_bl` int(5) NOT NULL,
  `gaz` float(10,1) NOT NULL,
  `gaz_oil` float(10,1) NOT NULL,
  `naft_w` float(10,1) NOT NULL,
  `naft_b` float(10,1) NOT NULL,
  `benz` float(10,1) NOT NULL,
  `barg` float(10,1) NOT NULL,
  `ab` float(10,1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unit_id` (`NationalCode`,`y_prod`,`d_prod`,`ShenaseKasboKar`),
  KEY `date_s` (`date_s`)
) ENGINE=InnoDB AUTO_INCREMENT=4884 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ind_unit_prod`
--

DROP TABLE IF EXISTS `ind_unit_prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ind_unit_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `NationalCode` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `ShenaseKasboKar` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `y_prod` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `d_prod` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `isic_cod` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_tol` float(10,3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_s` (`date_s`)
) ENGINE=InnoDB AUTO_INCREMENT=14191 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jahani_b`
--

DROP TABLE IF EXISTS `jahani_b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jahani_b` (
  `ostan` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `z_kesht` decimal(9,4) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11405 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jahani_z`
--

DROP TABLE IF EXISTS `jahani_z`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jahani_z` (
  `ostan` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `zer_kesht` decimal(10,4) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11632 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kood_bar`
--

DROP TABLE IF EXISTS `kood_bar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kood_bar` (
  `id_ostan` varchar(5) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `group_name` varchar(12) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `Count` float(10,2) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(4) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kood_kol`
--

DROP TABLE IF EXISTS `kood_kol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kood_kol` (
  `id` int(10) NOT NULL DEFAULT '0',
  `id_ostan` varchar(5) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(10) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `code` varchar(6) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `year` varchar(4) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `Count` float(10,2) DEFAULT NULL,
  `category` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `list_abadi`
--

DROP TABLE IF EXISTS `list_abadi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `list_abadi` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `bakh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `deh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `mar` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `abadi` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_deh` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `add_bakh` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `post_cod` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `add_abadi` (`add_abadi`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `city` (`city`),
  KEY `id_mar` (`id_mar`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `post_cod` (`post_cod`)
) ENGINE=MyISAM AUTO_INCREMENT=129315 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `list_abadi1403`
--

DROP TABLE IF EXISTS `list_abadi1403`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `list_abadi1403` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `bakh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `deh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `mar` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `abadi` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_deh` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `add_bakh` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `post_cod` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `add_abadi` (`add_abadi`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `city` (`city`),
  KEY `id_mar` (`id_mar`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `post_cod` (`post_cod`)
) ENGINE=MyISAM AUTO_INCREMENT=129304 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `list_abadi_del`
--

DROP TABLE IF EXISTS `list_abadi_del`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `list_abadi_del` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `bakh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `deh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `mar` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `abadi` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_deh` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `add_bakh` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `post_cod` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `add_abadi` (`add_abadi`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `city` (`city`),
  KEY `id_mar` (`id_mar`),
  KEY `mor_cod_m` (`mor_cod_m`),
  KEY `post_cod` (`post_cod`)
) ENGINE=MyISAM AUTO_INCREMENT=129265 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `list_city`
--

DROP TABLE IF EXISTS `list_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `list_city` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `bakh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `mar` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `shahr` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_bakh` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `add_city_2` (`add_city`),
  KEY `add_city` (`add_city`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `mor_cod_m` (`mor_cod_m`)
) ENGINE=MyISAM AUTO_INCREMENT=1690 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `list_city1403`
--

DROP TABLE IF EXISTS `list_city1403`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `list_city1403` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `bakh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `mar` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `shahr` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_bakh` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `add_city_2` (`add_city`),
  KEY `add_city` (`add_city`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`),
  KEY `mor_cod_m` (`mor_cod_m`)
) ENGINE=MyISAM AUTO_INCREMENT=1687 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `list_kood`
--

DROP TABLE IF EXISTS `list_kood`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `list_kood` (
  `id` int(4) DEFAULT NULL,
  `code` varchar(6) COLLATE utf8_persian_ci DEFAULT NULL,
  `group_name` varchar(12) COLLATE utf8_persian_ci DEFAULT NULL,
  `name` varchar(129) COLLATE utf8_persian_ci DEFAULT NULL,
  KEY `cod` (`code`,`group_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `verb` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `username` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_persian_ci NOT NULL,
  `date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `time` varchar(8) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `date` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=64085170 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `malek`
--

DROP TABLE IF EXISTS `malek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `malek` (
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  `m_addres` text COLLATE utf8_persian_ci NOT NULL,
  `m_jens` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `m_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `m_last_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `m_fname` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `m_tel_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `m_cod_m_2` (`m_cod_m`)
) ENGINE=MyISAM AUTO_INCREMENT=25192649 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mar`
--

DROP TABLE IF EXISTS `mar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `ostan` varchar(35) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `mar` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_mar` (`id_mar`),
  KEY `id_ostan` (`id_ostan`,`id_city`,`id_mar`),
  KEY `id_city` (`id_city`)
) ENGINE=MyISAM AUTO_INCREMENT=1852 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ostanname`
--

DROP TABLE IF EXISTS `ostanname`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ostanname` (
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `sort_order` int(11) DEFAULT '0',
  PRIMARY KEY (`id_ostan`),
  UNIQUE KEY `ostan` (`ostan`),
  KEY `id_ostan` (`id_ostan`),
  KEY `idx_ostanname_id_ostan` (`id_ostan`),
  KEY `idx_ostanname_sort` (`sort_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `otp_logs`
--

DROP TABLE IF EXISTS `otp_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otp_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bah_cod_m` varchar(10) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `tel_m` varchar(11) NOT NULL,
  `expires_at` datetime NOT NULL,
  `is_used` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_reset_codes`
--

DROP TABLE IF EXISTS `password_reset_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8_persian_ci NOT NULL,
  `verification_code` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `used` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20243 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `payesh`
--

DROP TABLE IF EXISTS `payesh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payesh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_hav` float(10,2) DEFAULT NULL,
  `m_tah` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `payesh_data`
--

DROP TABLE IF EXISTS `payesh_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payesh_data` (
  `id` varchar(7) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `AreaID` varchar(15) COLLATE utf8_persian_ci DEFAULT NULL,
  `status` varchar(6) COLLATE utf8_persian_ci DEFAULT NULL,
  `Method` varchar(17) COLLATE utf8_persian_ci DEFAULT NULL,
  KEY `AreaID` (`AreaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `payesh_status`
--

DROP TABLE IF EXISTS `payesh_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payesh_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `AreaID` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Code` int(11) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL,
  `Count` int(11) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `Method` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `RequestId` bigint(20) DEFAULT NULL,
  `User` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `Date_s` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `bah_cod_m` varchar(12) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `AreaID` (`AreaID`),
  KEY `Status` (`Status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pm`
--

DROP TABLE IF EXISTS `pm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pm` (
  `no_pm` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `s_user` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `r_user` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `title` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `message` text COLLATE utf8_persian_ci NOT NULL,
  `s_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `s_time` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `ru_read` varchar(1) COLLATE utf8_persian_ci NOT NULL DEFAULT '1',
  `r_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `r_time` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `rep_id` int(11) DEFAULT NULL,
  `file` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `del` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `del_date` varchar(10) COLLATE utf8_persian_ci DEFAULT NULL,
  `del_time` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  `m_send` varchar(1) COLLATE utf8_persian_ci DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pm` (`s_user`,`r_user`,`title`(50),`message`(50),`s_date`),
  KEY `r_user` (`r_user`),
  KEY `ru_read` (`ru_read`),
  KEY `idx_duplicate_check` (`s_user`,`r_user`,`s_date`,`s_time`)
) ENGINE=MyISAM AUTO_INCREMENT=3031659 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `polygons`
--

DROP TABLE IF EXISTS `polygons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `polygons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coordinates` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `area` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `post_cod`
--

DROP TABLE IF EXISTS `post_cod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_cod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_abadi` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `post_cod` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=78946 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `price_pro_list`
--

DROP TABLE IF EXISTS `price_pro_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_pro_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_cod` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `min_price` float(7,0) NOT NULL,
  `max_price` float(7,0) NOT NULL,
  `p_name` varchar(75) COLLATE utf8_persian_ci NOT NULL,
  `p_unit` varchar(75) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `p_cod` (`p_cod`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `price_record`
--

DROP TABLE IF EXISTS `price_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `s_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `year` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `mont` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `p_cod` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `p_price` float(7,0) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `s_date` (`s_date`,`id_ostan`,`id_city`,`p_cod`)
) ENGINE=MyISAM AUTO_INCREMENT=115889 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_G`
--

DROP TABLE IF EXISTS `product_G`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_G` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catagory_name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `catagory_cod` varchar(8) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `group_cod` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `mah_name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `mah_cod` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `ht` float(15,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_b`
--

DROP TABLE IF EXISTS `product_b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_cod` (`group_cod`),
  KEY `product_cod` (`product_cod`),
  KEY `idx_productb` (`group_cod`,`product_cod`),
  KEY `idx_productb_join` (`group_cod`,`product_cod`)
) ENGINE=MyISAM AUTO_INCREMENT=429 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_b_amar`
--

DROP TABLE IF EXISTS `product_b_amar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_b_amar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=445 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_b_new`
--

DROP TABLE IF EXISTS `product_b_new`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_b_new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_cod` (`group_cod`),
  KEY `product_cod` (`product_cod`),
  KEY `idx_productb` (`group_cod`,`product_cod`),
  KEY `idx_productb_join` (`group_cod`,`product_cod`)
) ENGINE=MyISAM AUTO_INCREMENT=429 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_b_new_back`
--

DROP TABLE IF EXISTS `product_b_new_back`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_b_new_back` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_cod_new` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_cod` (`group_cod`),
  KEY `product_cod` (`product_cod`),
  KEY `idx_productb` (`group_cod`,`product_cod`),
  KEY `idx_productb_join` (`group_cod`,`product_cod`)
) ENGINE=MyISAM AUTO_INCREMENT=429 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_b_old`
--

DROP TABLE IF EXISTS `product_b_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_b_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_cod` (`group_cod`),
  KEY `product_cod` (`product_cod`),
  KEY `idx_productb` (`group_cod`,`product_cod`),
  KEY `idx_productb_join` (`group_cod`,`product_cod`)
) ENGINE=MyISAM AUTO_INCREMENT=421 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_z`
--

DROP TABLE IF EXISTS `product_z`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_z` (
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=278 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_z_amar`
--

DROP TABLE IF EXISTS `product_z_amar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_z_amar` (
  `group_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `group_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `product_cod` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_cod_amar` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(55) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=136 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `promo_cent_build`
--

DROP TABLE IF EXISTS `promo_cent_build`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_cent_build` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `y_make` int(4) NOT NULL,
  `s_arce` float(8,2) NOT NULL,
  `s_ayan` float(6,2) NOT NULL,
  `no_mal` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `faz_1` float(8,2) NOT NULL,
  `faz_2` float(8,2) NOT NULL,
  `faz_3` float(8,2) NOT NULL,
  `faz_4` float(8,2) NOT NULL,
  `faz_5` float(8,2) NOT NULL,
  `faz_6` float(8,2) NOT NULL,
  `faz_7` float(8,2) NOT NULL,
  `faz_8` float(8,2) NOT NULL,
  `faz_9` float(8,2) NOT NULL,
  `faz_10` float(8,2) NOT NULL,
  `faz_11` float(8,2) NOT NULL,
  `faz_12` float(8,2) NOT NULL,
  `faz_13` float(8,2) NOT NULL,
  `faz_14` float(8,2) NOT NULL,
  `faz_15` float(8,2) NOT NULL,
  `faz_16` float(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_mar` (`id_mar`)
) ENGINE=MyISAM AUTO_INCREMENT=1985 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `promo_cent_organiz`
--

DROP TABLE IF EXISTS `promo_cent_organiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_cent_organiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `mmd_1` int(2) NOT NULL,
  `mmd_2` int(2) NOT NULL,
  `mmd_3` int(2) NOT NULL,
  `mmd_4` int(2) NOT NULL,
  `ta_1` int(2) NOT NULL,
  `ta_2` int(2) NOT NULL,
  `ta_3` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`)
) ENGINE=MyISAM AUTO_INCREMENT=2083 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `promo_cent_public`
--

DROP TABLE IF EXISTS `promo_cent_public`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_cent_public` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `m_name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `rating` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `y_tas` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `address` text COLLATE utf8_persian_ci NOT NULL,
  `cod_pos` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `lng` float(10,6) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `tel` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `fax` int(11) NOT NULL,
  `f_naz_ab` int(3) NOT NULL,
  `f_dor_ab` int(3) NOT NULL,
  `zf_g` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `to_z1` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `to_z2` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `to_z3` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `to_b1` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `to_b2` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `to_b3` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `to_d1` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `to_d2` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `to_d3` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_mar` (`id_mar`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`)
) ENGINE=MyISAM AUTO_INCREMENT=1616 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `promo_cent_repair`
--

DROP TABLE IF EXISTS `promo_cent_repair`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_cent_repair` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `faz_name` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `no_repair` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `meter` float(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`)
) ENGINE=MyISAM AUTO_INCREMENT=16673 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `promo_cent_supplies`
--

DROP TABLE IF EXISTS `promo_cent_supplies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promo_cent_supplies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `no_taj` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `model` varchar(300) COLLATE utf8_persian_ci NOT NULL,
  `y_make` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `num` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `id_mar` (`id_mar`)
) ENGINE=MyISAM AUTO_INCREMENT=28206 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `public_abadi1403`
--

DROP TABLE IF EXISTS `public_abadi1403`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `public_abadi1403` (
  `id_abadi` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(16) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi2` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `up_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_bakh` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_deh` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `id_hozeh` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `bakh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `deh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `abadi` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `hamyar` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `vaz_abadi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rah_zamin` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rah_ahan` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rah_abi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `vaz_soko` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `s_mosem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `e_mosem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_hadi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_11` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_12` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_13` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_14` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_15` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_16` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_17` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_11` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_12` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `nofos_1` int(7) NOT NULL,
  `nofos_2` int(7) NOT NULL,
  `nofos_3` int(7) NOT NULL,
  `nofos_4` int(7) NOT NULL,
  `nofos_5` int(7) NOT NULL,
  `post_cod` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `ok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `up_date` (`up_date`),
  KEY `post_cod` (`post_cod`),
  KEY `id_abadi` (`id_abadi`)
) ENGINE=MyISAM AUTO_INCREMENT=99260 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `public_abadi4`
--

DROP TABLE IF EXISTS `public_abadi4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `public_abadi4` (
  `id_abadi` varchar(6) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(16) COLLATE utf8_persian_ci NOT NULL,
  `add_abadi2` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `up_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_bakh` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_deh` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `id_hozeh` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `bakh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `deh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `abadi` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `hamyar` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `vaz_abadi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rah_zamin` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rah_ahan` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rah_abi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `vaz_soko` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `s_mosem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `e_mosem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_hadi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_11` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_12` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_13` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_14` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_15` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_16` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_17` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_11` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_12` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `nofos_1` int(7) NOT NULL,
  `nofos_2` int(7) NOT NULL,
  `nofos_3` int(7) NOT NULL,
  `nofos_4` int(7) NOT NULL,
  `nofos_5` int(7) NOT NULL,
  `post_cod` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `ok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`),
  KEY `up_date` (`up_date`),
  KEY `post_cod` (`post_cod`),
  KEY `id_abadi` (`id_abadi`),
  KEY `add_abadi` (`add_abadi`)
) ENGINE=MyISAM AUTO_INCREMENT=297894 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `public_city`
--

DROP TABLE IF EXISTS `public_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `public_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_bakh` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_shahr` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city1` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `bakh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `shahr` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `vaz_abadi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rah_zamin` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rah_ahan` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rah_abi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `vaz_soko` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `s_mosem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `e_mosem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_hadi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_11` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_12` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_13` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_14` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_15` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_16` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_17` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_11` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_12` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `nofos_1` int(7) NOT NULL,
  `nofos_2` int(7) NOT NULL,
  `nofos_3` int(7) NOT NULL,
  `nofos_4` int(7) NOT NULL,
  `nofos_5` int(7) NOT NULL,
  `up_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `ok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_city` (`id_city`),
  KEY `id_ostan` (`id_ostan`),
  KEY `add_city` (`add_city`)
) ENGINE=MyISAM AUTO_INCREMENT=1462 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `public_city1403`
--

DROP TABLE IF EXISTS `public_city1403`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `public_city1403` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_bakh` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_shahr` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city1` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `bakh` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `shahr` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `vaz_abadi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rah_zamin` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rah_ahan` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `rah_abi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `vaz_soko` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `s_mosem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `e_mosem` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `t_hadi` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `learn_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `sport_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `mazhab_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `siyasi_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `niro_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_11` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_12` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_13` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_14` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_15` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_16` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `beh_17` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_9` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_10` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_11` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `khad_12` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_1` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_2` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_3` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_4` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_5` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_6` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_7` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ertebat_8` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `nofos_1` int(7) NOT NULL,
  `nofos_2` int(7) NOT NULL,
  `nofos_3` int(7) NOT NULL,
  `nofos_4` int(7) NOT NULL,
  `nofos_5` int(7) NOT NULL,
  `up_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `ok` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_city` (`id_city`),
  KEY `id_ostan` (`id_ostan`),
  KEY `add_city` (`add_city`)
) ENGINE=MyISAM AUTO_INCREMENT=1459 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `salamat`
--

DROP TABLE IF EXISTS `salamat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salamat` (
  `bah_cod_m` varchar(12) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `valid` varchar(3) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tel_m` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bah_cod_m` (`bah_cod_m`,`valid`)
) ENGINE=InnoDB AUTO_INCREMENT=276242 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sokh`
--

DROP TABLE IF EXISTS `sokh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sokh` (
  `sokh` varchar(747) DEFAULT NULL,
  `name` varchar(113) DEFAULT NULL,
  `name_cod` int(4) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26709 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sokht_city`
--

DROP TABLE IF EXISTS `sokht_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sokht_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `z_sal` varchar(10) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `ostan` varchar(35) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `id_city` varchar(2) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(29) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `fasle` varchar(12) CHARACTER SET utf8 COLLATE utf8_persian_ci DEFAULT NULL,
  `s_city` int(11) DEFAULT NULL,
  `s_es_city` int(11) DEFAULT NULL,
  `s_ba_city` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ostan` (`id_ostan`),
  KEY `id_city` (`id_city`)
) ENGINE=InnoDB AUTO_INCREMENT=1809 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sokht_ostan`
--

DROP TABLE IF EXISTS `sokht_ostan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sokht_ostan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `ostan` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `sahmie_sal` int(11) DEFAULT '0',
  `sahmie_paeez` int(11) DEFAULT '0',
  `taghsim_paeez` int(11) DEFAULT '0',
  `estefade_paeez` int(11) DEFAULT '0',
  `baghimande_paeez` int(11) DEFAULT '0',
  `sahmie_zemestan` int(11) DEFAULT '0',
  `taghsim_zemestan` int(11) DEFAULT '0',
  `estefade_zemestan` int(11) DEFAULT '0',
  `baghimande_zemestan` int(11) DEFAULT '0',
  `sahmie_bahar` int(11) DEFAULT '0',
  `taghsim_bahar` int(11) DEFAULT '0',
  `estefade_bahar` int(11) DEFAULT '0',
  `baghimande_bahar` int(11) DEFAULT '0',
  `sahmie_tabestan` int(11) DEFAULT '0',
  `taghsim_tabestan` int(11) DEFAULT '0',
  `estefade_tabestan` int(11) DEFAULT '0',
  `baghimande_tabestan` int(11) DEFAULT '0',
  `taghzie_nashode` int(11) DEFAULT '0',
  `taghsim_nashode` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ostan` (`ostan`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `survey_responses`
--

DROP TABLE IF EXISTS `survey_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `speed_rating` int(11) DEFAULT NULL,
  `behavior_rating` int(11) DEFAULT NULL,
  `quality_rating` int(11) DEFAULT NULL,
  `suggestion` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4381 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `system_messages`
--

DROP TABLE IF EXISTS `system_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message_text` text NOT NULL,
  `message_key` varchar(100) NOT NULL,
  `message_type` enum('Emergency','Information') NOT NULL,
  `order_num` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `message_key` (`message_key`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `unknown_bee`
--

DROP TABLE IF EXISTS `unknown_bee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unknown_bee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `sal` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `mor_cod_m` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `no_zan` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `tk_mo` int(10) NOT NULL,
  `tk_bo` int(10) NOT NULL,
  `comment` text COLLATE utf8_persian_ci NOT NULL,
  `add_abadi` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  `add_city` varchar(19) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_pas` date NOT NULL,
  `username` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `password` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `psalt` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `ostan` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `markaz` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `date_es` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `date_kh` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `no_es` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `jens` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `Last_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `cod_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `sh_sh` varchar(25) COLLATE utf8_persian_ci NOT NULL,
  `fname` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `date_t` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_sodor` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `m_tah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `r_tah` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `avre` float NOT NULL,
  `univer` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `m_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `v_tahol` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `addres` text COLLATE utf8_persian_ci NOT NULL,
  `tel_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `tel_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `cod_p` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `pic` varchar(15) COLLATE utf8_persian_ci NOT NULL,
  `Access` int(1) NOT NULL,
  `S_access` int(1) NOT NULL,
  `id_aria` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `expert_unit` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `end_bee` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `date_end_bee` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `end_dam` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `date_end_dam` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `con_center` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `date_con_center` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `con_city` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `date_con_city` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `con_ostan` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `date_con_ostan` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `chief` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `ostans` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `perm` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `date_status` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `status` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `shaba` varchar(24) COLLATE utf8_persian_ci NOT NULL,
  `valid` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  `acc_chief` tinyint(1) NOT NULL DEFAULT '0',
  `acc_cpis` tinyint(1) NOT NULL DEFAULT '0',
  `acc_dash` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `id_ostan` (`id_ostan`,`id_city`,`id_mar`,`name`,`Last_name`,`cod_m`),
  KEY `cod_m` (`cod_m`),
  KEY `perm` (`perm`)
) ENGINE=InnoDB AUTO_INCREMENT=46890 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users_back`
--

DROP TABLE IF EXISTS `users_back`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_back` (
  `id` int(11) NOT NULL,
  `date_pas` date NOT NULL,
  `username` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `password` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `psalt` mediumtext COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '03',
  `ostan` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `city` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL,
  `markaz` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `date_es` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `date_kh` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `no_es` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `jens` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_persian_ci NOT NULL,
  `Last_name` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `cod_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `sh_sh` varchar(25) COLLATE utf8_persian_ci NOT NULL,
  `fname` varchar(35) COLLATE utf8_persian_ci NOT NULL,
  `date_t` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `m_sodor` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `m_tah` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `r_tah` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `avre` float NOT NULL,
  `univer` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `m_date` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `v_tahol` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `addres` text COLLATE utf8_persian_ci NOT NULL,
  `tel_s` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `tel_m` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `cod_p` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `pic` varchar(15) COLLATE utf8_persian_ci NOT NULL,
  `Access` int(1) NOT NULL,
  `S_access` int(1) NOT NULL,
  `id_aria` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `expert_unit` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `end_bee` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `date_end_bee` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `end_dam` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `date_end_dam` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `con_center` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `date_con_center` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `con_city` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `date_con_city` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `con_ostan` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `date_con_ostan` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `chief` varchar(1) COLLATE utf8_persian_ci NOT NULL,
  `ostans` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `perm` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `date_status` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `status` varchar(2) COLLATE utf8_persian_ci NOT NULL,
  `shaba` varchar(24) COLLATE utf8_persian_ci NOT NULL,
  `valid` varchar(3) COLLATE utf8_persian_ci NOT NULL,
  KEY `cod_m` (`cod_m`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `z_sal`
--

DROP TABLE IF EXISTS `z_sal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `z_sal` (
  `z_sal` varchar(9) COLLATE utf8_persian_ci NOT NULL,
  `available` varchar(1) COLLATE utf8_persian_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`z_sal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Final view structure for view `V_Agri03`
--

/*!50001 DROP TABLE IF EXISTS `V_Agri03`*/;
/*!50001 DROP VIEW IF EXISTS `V_Agri03`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Agri03` AS select `Agri1402_1403`.`id` AS `id`,`Agri1402_1403`.`mor_cod_m` AS `mor_cod_m`,`Agri1402_1403`.`id_ostan` AS `ostan`,`Agri1402_1403`.`id_city` AS `city`,`Agri1402_1403`.`id_mar` AS `mar`,`Agri1402_1403`.`bah_cod_m` AS `bah_cod_m`,`Agri1402_1403`.`num_bah` AS `num_bah`,`Agri1402_1403`.`sh_gat` AS `sh_gat`,`Agri1402_1403`.`m_zamin` AS `m_zamin`,`Agri1402_1403`.`no_mal` AS `no_mal`,`Agri1402_1403`.`no_kesh` AS `no_kesh`,`Agri1402_1403`.`m_ab` AS `m_ab`,`Agri1402_1403`.`no_ab` AS `no_ab`,`Agri1402_1403`.`t_mah` AS `t_mah`,`Agri1402_1403`.`s_ayesh` AS `ayesh`,`Agri1402_1403`.`add_abadi` AS `abadi`,`Agri1402_1403`.`add_city` AS `shahr`,`Agri1402_1403`.`z_sal` AS `z_sal` from `Agri1402_1403` where 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Agri04`
--

/*!50001 DROP TABLE IF EXISTS `V_Agri04`*/;
/*!50001 DROP VIEW IF EXISTS `V_Agri04`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Agri04` AS select `Agri1403_1404`.`id` AS `id`,`Agri1403_1404`.`mor_cod_m` AS `mor_cod_m`,`Agri1403_1404`.`id_ostan` AS `ostan`,`Agri1403_1404`.`id_city` AS `city`,`Agri1403_1404`.`id_mar` AS `mar`,`Agri1403_1404`.`bah_cod_m` AS `bah_cod_m`,`Agri1403_1404`.`num_bah` AS `num_bah`,`Agri1403_1404`.`sh_gat` AS `sh_gat`,`Agri1403_1404`.`m_zamin` AS `m_zamin`,`Agri1403_1404`.`no_mal` AS `no_mal`,`Agri1403_1404`.`no_kesh` AS `no_kesh`,`Agri1403_1404`.`m_ab` AS `m_ab`,`Agri1403_1404`.`no_ab` AS `no_ab`,`Agri1403_1404`.`t_mah` AS `t_mah`,`Agri1403_1404`.`s_ayesh` AS `ayesh`,`Agri1403_1404`.`add_abadi` AS `abadi`,`Agri1403_1404`.`add_city` AS `shahr`,`Agri1403_1404`.`z_sal` AS `z_sal` from `Agri1403_1404` where 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Agri05`
--

/*!50001 DROP TABLE IF EXISTS `V_Agri05`*/;
/*!50001 DROP VIEW IF EXISTS `V_Agri05`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Agri05` AS select `Agri1404_1405`.`id` AS `id`,`Agri1404_1405`.`mor_cod_m` AS `mor_cod_m`,`Agri1404_1405`.`id_ostan` AS `ostan`,`Agri1404_1405`.`id_city` AS `city`,`Agri1404_1405`.`id_mar` AS `mar`,`Agri1404_1405`.`bah_cod_m` AS `bah_cod_m`,`Agri1404_1405`.`num_bah` AS `num_bah`,`Agri1404_1405`.`sh_gat` AS `sh_gat`,`Agri1404_1405`.`m_zamin` AS `m_zamin`,`Agri1404_1405`.`no_mal` AS `no_mal`,`Agri1404_1405`.`no_kesh` AS `no_kesh`,`Agri1404_1405`.`m_ab` AS `m_ab`,`Agri1404_1405`.`no_ab` AS `no_ab`,`Agri1404_1405`.`t_mah` AS `t_mah`,`Agri1404_1405`.`s_ayesh` AS `ayesh`,`Agri1404_1405`.`add_abadi` AS `abadi`,`Agri1404_1405`.`add_city` AS `shahr`,`Agri1404_1405`.`z_sal` AS `z_sal` from `Agri1404_1405` where 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Agri06`
--

/*!50001 DROP TABLE IF EXISTS `V_Agri06`*/;
/*!50001 DROP VIEW IF EXISTS `V_Agri06`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Agri06` AS select `Agri1405_1406`.`id` AS `id`,`Agri1405_1406`.`mor_cod_m` AS `mor_cod_m`,`Agri1405_1406`.`id_ostan` AS `ostan`,`Agri1405_1406`.`id_city` AS `city`,`Agri1405_1406`.`id_mar` AS `mar`,`Agri1405_1406`.`bah_cod_m` AS `bah_cod_m`,`Agri1405_1406`.`num_bah` AS `num_bah`,`Agri1405_1406`.`sh_gat` AS `sh_gat`,`Agri1405_1406`.`m_zamin` AS `m_zamin`,`Agri1405_1406`.`no_mal` AS `no_mal`,`Agri1405_1406`.`no_kesh` AS `no_kesh`,`Agri1405_1406`.`m_ab` AS `m_ab`,`Agri1405_1406`.`no_ab` AS `no_ab`,`Agri1405_1406`.`t_mah` AS `t_mah`,`Agri1405_1406`.`s_ayesh` AS `ayesh`,`Agri1405_1406`.`add_abadi` AS `abadi`,`Agri1405_1406`.`add_city` AS `shahr`,`Agri1405_1406`.`z_sal` AS `z_sal` from `Agri1405_1406` where 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Agri_prod`
--

/*!50001 DROP TABLE IF EXISTS `V_Agri_prod`*/;
/*!50001 DROP VIEW IF EXISTS `V_Agri_prod`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Agri_prod` AS select `Agri_prod1401_1402`.`id` AS `id`,`Agri_prod1401_1402`.`mor_cod_m` AS `mor_cod_m`,`Agri_prod1401_1402`.`id_ostan` AS `ostan`,`Agri_prod1401_1402`.`id_city` AS `city`,`Agri_prod1401_1402`.`id_mar` AS `mar`,`Agri_prod1401_1402`.`bah_cod_m` AS `b_codm`,`Agri_prod1401_1402`.`num_bah` AS `num_bah`,`Agri_prod1401_1402`.`sh_gat` AS `gat`,`Agri_prod1401_1402`.`no_kesh` AS `kesh`,`Agri_prod1401_1402`.`z_sal` AS `sal`,`Agri_prod1401_1402`.`cod_qroup` AS `qroup`,`Agri_prod1401_1402`.`cod_mah` AS `cod_mah`,`Agri_prod1401_1402`.`zer_kesht_a` AS `kesht1`,`Agri_prod1401_1402`.`zer_kesht_b` AS `kesht2`,`Agri_prod1401_1402`.`s_bar_a` AS `bar1`,`Agri_prod1401_1402`.`s_bar_b` AS `bar2`,`Agri_prod1401_1402`.`mah_tolp` AS `pmah`,`Agri_prod1401_1402`.`mah_tol` AS `mah`,`Agri_prod1401_1402`.`mah_bem` AS `bem`,`Agri_prod1401_1402`.`mah_kh` AS `kh`,`Agri_prod1401_1402`.`add_abadi` AS `abadi`,`Agri_prod1401_1402`.`add_city` AS `shahr` from `Agri_prod1401_1402` where 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Agri_prod03`
--

/*!50001 DROP TABLE IF EXISTS `V_Agri_prod03`*/;
/*!50001 DROP VIEW IF EXISTS `V_Agri_prod03`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Agri_prod03` AS select `Agri_prod1402_1403`.`id` AS `id`,`Agri_prod1402_1403`.`mor_cod_m` AS `mor_cod_m`,`Agri_prod1402_1403`.`id_ostan` AS `ostan`,`Agri_prod1402_1403`.`id_city` AS `city`,`Agri_prod1402_1403`.`id_mar` AS `mar`,`Agri_prod1402_1403`.`bah_cod_m` AS `b_codm`,`Agri_prod1402_1403`.`num_bah` AS `num_bah`,`Agri_prod1402_1403`.`sh_gat` AS `gat`,`Agri_prod1402_1403`.`no_kesh` AS `kesh`,`Agri_prod1402_1403`.`z_sal` AS `sal`,`Agri_prod1402_1403`.`cod_qroup` AS `qroup`,`Agri_prod1402_1403`.`cod_mah` AS `cod_mah`,`Agri_prod1402_1403`.`zer_kesht_a` AS `kesht1`,`Agri_prod1402_1403`.`zer_kesht_b` AS `kesht2`,`Agri_prod1402_1403`.`s_bar_a` AS `bar1`,`Agri_prod1402_1403`.`s_bar_b` AS `bar2`,`Agri_prod1402_1403`.`mah_tolp` AS `pmah`,`Agri_prod1402_1403`.`mah_tol` AS `mah`,`Agri_prod1402_1403`.`mah_bem` AS `bem`,`Agri_prod1402_1403`.`mah_kh` AS `kh`,`Agri_prod1402_1403`.`add_abadi` AS `abadi`,`Agri_prod1402_1403`.`add_city` AS `shahr` from `Agri_prod1402_1403` where 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Agri_prod04`
--

/*!50001 DROP TABLE IF EXISTS `V_Agri_prod04`*/;
/*!50001 DROP VIEW IF EXISTS `V_Agri_prod04`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Agri_prod04` AS select `Agri_prod1403_1404`.`id` AS `id`,`Agri_prod1403_1404`.`mor_cod_m` AS `mor_cod_m`,`Agri_prod1403_1404`.`id_ostan` AS `ostan`,`Agri_prod1403_1404`.`id_city` AS `city`,`Agri_prod1403_1404`.`id_mar` AS `mar`,`Agri_prod1403_1404`.`bah_cod_m` AS `b_codm`,`Agri_prod1403_1404`.`num_bah` AS `num_bah`,`Agri_prod1403_1404`.`sh_gat` AS `gat`,`Agri_prod1403_1404`.`no_kesh` AS `kesh`,`Agri_prod1403_1404`.`z_sal` AS `sal`,`Agri_prod1403_1404`.`cod_qroup` AS `qroup`,`Agri_prod1403_1404`.`cod_mah` AS `cod_mah`,`Agri_prod1403_1404`.`zer_kesht_a` AS `kesht1`,`Agri_prod1403_1404`.`zer_kesht_b` AS `kesht2`,`Agri_prod1403_1404`.`s_bar_a` AS `bar1`,`Agri_prod1403_1404`.`s_bar_b` AS `bar2`,`Agri_prod1403_1404`.`mah_tolp` AS `pmah`,`Agri_prod1403_1404`.`mah_tol` AS `mah`,`Agri_prod1403_1404`.`mah_bem` AS `bem`,`Agri_prod1403_1404`.`mah_kh` AS `kh`,`Agri_prod1403_1404`.`add_abadi` AS `abadi`,`Agri_prod1403_1404`.`add_city` AS `shahr` from `Agri_prod1403_1404` where 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Agri_prod05`
--

/*!50001 DROP TABLE IF EXISTS `V_Agri_prod05`*/;
/*!50001 DROP VIEW IF EXISTS `V_Agri_prod05`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Agri_prod05` AS select `Agri_prod1404_1405`.`id` AS `id`,`Agri_prod1404_1405`.`mor_cod_m` AS `mor_cod_m`,`Agri_prod1404_1405`.`id_ostan` AS `ostan`,`Agri_prod1404_1405`.`id_city` AS `city`,`Agri_prod1404_1405`.`id_mar` AS `mar`,`Agri_prod1404_1405`.`bah_cod_m` AS `b_codm`,`Agri_prod1404_1405`.`num_bah` AS `num_bah`,`Agri_prod1404_1405`.`sh_gat` AS `gat`,`Agri_prod1404_1405`.`no_kesh` AS `kesh`,`Agri_prod1404_1405`.`z_sal` AS `sal`,`Agri_prod1404_1405`.`cod_qroup` AS `qroup`,`Agri_prod1404_1405`.`cod_mah` AS `cod_mah`,`Agri_prod1404_1405`.`zer_kesht_a` AS `kesht1`,`Agri_prod1404_1405`.`zer_kesht_b` AS `kesht2`,`Agri_prod1404_1405`.`s_bar_a` AS `bar1`,`Agri_prod1404_1405`.`s_bar_b` AS `bar2`,`Agri_prod1404_1405`.`mah_tolp` AS `pmah`,`Agri_prod1404_1405`.`mah_tol` AS `mah`,`Agri_prod1404_1405`.`mah_bem` AS `bem`,`Agri_prod1404_1405`.`mah_kh` AS `kh`,`Agri_prod1404_1405`.`add_abadi` AS `abadi`,`Agri_prod1404_1405`.`add_city` AS `shahr` from `Agri_prod1404_1405` where 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Agri_prod06`
--

/*!50001 DROP TABLE IF EXISTS `V_Agri_prod06`*/;
/*!50001 DROP VIEW IF EXISTS `V_Agri_prod06`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Agri_prod06` AS select `Agri_prod1405_1406`.`id` AS `id`,`Agri_prod1405_1406`.`mor_cod_m` AS `mor_cod_m`,`Agri_prod1405_1406`.`id_ostan` AS `ostan`,`Agri_prod1405_1406`.`id_city` AS `city`,`Agri_prod1405_1406`.`id_mar` AS `mar`,`Agri_prod1405_1406`.`bah_cod_m` AS `b_codm`,`Agri_prod1405_1406`.`num_bah` AS `num_bah`,`Agri_prod1405_1406`.`sh_gat` AS `gat`,`Agri_prod1405_1406`.`no_kesh` AS `kesh`,`Agri_prod1405_1406`.`z_sal` AS `sal`,`Agri_prod1405_1406`.`cod_qroup` AS `qroup`,`Agri_prod1405_1406`.`cod_mah` AS `cod_mah`,`Agri_prod1405_1406`.`zer_kesht_a` AS `kesht1`,`Agri_prod1405_1406`.`zer_kesht_b` AS `kesht2`,`Agri_prod1405_1406`.`s_bar_a` AS `bar1`,`Agri_prod1405_1406`.`s_bar_b` AS `bar2`,`Agri_prod1405_1406`.`mah_tolp` AS `pmah`,`Agri_prod1405_1406`.`mah_tol` AS `mah`,`Agri_prod1405_1406`.`mah_bem` AS `bem`,`Agri_prod1405_1406`.`mah_kh` AS `kh`,`Agri_prod1405_1406`.`add_abadi` AS `abadi`,`Agri_prod1405_1406`.`add_city` AS `shahr` from `Agri_prod1405_1406` where 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Animal_Num`
--

/*!50001 DROP TABLE IF EXISTS `V_Animal_Num`*/;
/*!50001 DROP VIEW IF EXISTS `V_Animal_Num`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Animal_Num` AS select `animals`.`id` AS `id`,`animals`.`partIDCode` AS `partIDCode`,`animals`.`sal` AS `sal`,`animals`.`species` AS `species`,`animals`.`breed` AS `breed`,`animals`.`gender` AS `gender`,`animals`.`age` AS `age`,`animals`.`activity` AS `activity`,`animals`.`quantity` AS `quantity` from `animals` where (`animals`.`sal` = '1403') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Animal_unit`
--

/*!50001 DROP TABLE IF EXISTS `V_Animal_unit`*/;
/*!50001 DROP VIEW IF EXISTS `V_Animal_unit`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Animal_unit` AS select `animals_unit`.`id` AS `id`,`animals_unit`.`date_s` AS `date_s`,`animals_unit`.`id_ostan` AS `id_ostan`,`animals_unit`.`id_city` AS `id_city`,`animals_unit`.`id_mar` AS `id_mar`,`animals_unit`.`add_abadi` AS `add_abadi`,`animals_unit`.`add_city` AS `add_city`,`animals_unit`.`mor_cod_m` AS `mor_cod_m`,`animals_unit`.`PartIdCode` AS `PartIdCode`,`animals_unit`.`bah_cod_m` AS `bah_cod_m`,`animals_unit`.`num_bah` AS `num_bah`,`animals_unit`.`vaz_s` AS `vaz_s`,`animals_unit`.`epidemiologic` AS `epidemiologic`,`animals_unit`.`unit_postal_code` AS `unit_postal_code`,`animals_unit`.`longitude` AS `longitude`,`animals_unit`.`latitude` AS `latitude`,`animals_unit`.`coordinates` AS `coordinates`,`animals_unit`.`unit_types` AS `unit_types`,`animals_unit`.`capacity` AS `capacity`,`animals_unit`.`license_status` AS `license_status`,`animals_unit`.`rent_status` AS `rent_status`,`animals_unit`.`active_status` AS `active_status`,`animals_unit`.`docNum` AS `docNum`,`animals_unit`.`entry_date` AS `entry_date`,`animals_unit`.`isikCode` AS `isikCode`,`animals_unit`.`licenseType` AS `licenseType`,`animals_unit`.`validityDate` AS `validityDate` from `animals_unit` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Garden`
--

/*!50001 DROP TABLE IF EXISTS `V_Garden`*/;
/*!50001 DROP VIEW IF EXISTS `V_Garden`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Garden` AS select `Garden`.`id` AS `id`,`Garden`.`mor_cod_m` AS `mor_cod_m`,`Garden`.`id_ostan` AS `id_ostan`,`Garden`.`id_city` AS `id_city`,`Garden`.`id_mar` AS `id_mar`,`Garden`.`bah_cod_m` AS `bah_cod_m`,`Garden`.`num_bah` AS `num_bah`,`Garden`.`sh_gat` AS `sh_gat`,`Garden`.`m_zamin` AS `m_zamin`,`Garden`.`no_mal` AS `no_mal`,`Garden`.`no_kesh` AS `no_kesh`,`Garden`.`nah_kesh` AS `nah_kesh`,`Garden`.`m_ab` AS `m_ab`,`Garden`.`t_mah` AS `t_mah`,`Garden`.`z_sal` AS `z_sal`,`Garden`.`add_abadi` AS `add_abadi`,`Garden`.`add_city` AS `add_city` from `Garden` where (`Garden`.`z_sal` = '1404') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Garden_prod`
--

/*!50001 DROP TABLE IF EXISTS `V_Garden_prod`*/;
/*!50001 DROP VIEW IF EXISTS `V_Garden_prod`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Garden_prod` AS select `Garden_prod`.`id` AS `id`,`Garden_prod`.`mor_cod_m` AS `mor_cod_m`,`Garden_prod`.`id_ostan` AS `id_ostan`,`Garden_prod`.`id_city` AS `id_city`,`Garden_prod`.`id_mar` AS `id_mar`,`Garden_prod`.`bah_cod_m` AS `bah_cod_m`,`Garden_prod`.`num_bah` AS `num_bah`,`Garden_prod`.`sh_gat` AS `sh_gat`,`Garden_prod`.`no_kesh` AS `no_kesh`,`Garden_prod`.`nah_kesh` AS `nah_kesh`,`Garden_prod`.`z_sal` AS `z_sal`,`Garden_prod`.`cod_qroup` AS `cod_qroup`,`Garden_prod`.`cod_mah` AS `cod_mah`,`Garden_prod`.`s_kesht_b` AS `s_kesht_b`,`Garden_prod`.`s_kesht_gb` AS `s_kesht_gb`,`Garden_prod`.`tree_b` AS `tree_b`,`Garden_prod`.`tree_gb` AS `tree_gb`,`Garden_prod`.`mah_tol` AS `mah_tol`,`Garden_prod`.`mah_tolp` AS `mah_tolp`,`Garden_prod`.`mah_bem` AS `mah_bem`,`Garden_prod`.`mah_kh` AS `mah_kh`,`Garden_prod`.`add_abadi` AS `add_abadi`,`Garden_prod`.`add_city` AS `add_city` from `Garden_prod` where (`Garden_prod`.`z_sal` = '1404') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Green`
--

/*!50001 DROP TABLE IF EXISTS `V_Green`*/;
/*!50001 DROP VIEW IF EXISTS `V_Green`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Green` AS select `Greenhous`.`id` AS `id`,`Greenhous`.`mor_cod_m` AS `mor_cod_m`,`Greenhous`.`id_ostan` AS `id_ostan`,`Greenhous`.`id_city` AS `id_city`,`Greenhous`.`id_mar` AS `id_mar`,`Greenhous`.`bah_cod_m` AS `bah_cod_m`,`Greenhous`.`num_bah` AS `num_bah`,`Greenhous`.`m_zamin` AS `m_zamin`,`Greenhous`.`no_mal` AS `no_mal`,`Greenhous`.`no_kesht` AS `no_kesht`,`Greenhous`.`add_abadi` AS `add_abadi`,`Greenhous`.`add_city` AS `add_city` from `Greenhous` where 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Green_Fun`
--

/*!50001 DROP TABLE IF EXISTS `V_Green_Fun`*/;
/*!50001 DROP VIEW IF EXISTS `V_Green_Fun`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Green_Fun` AS select `Greenhous_prod`.`id` AS `id`,`Greenhous_prod`.`mor_cod_m` AS `mor_cod_m`,`Greenhous_prod`.`unit_id` AS `unit_id`,`Greenhous_prod`.`id_ostan` AS `id_ostan`,`Greenhous_prod`.`id_city` AS `id_city`,`Greenhous_prod`.`id_mar` AS `id_mar`,`Greenhous_prod`.`bah_cod_m` AS `bah_cod_m`,`Greenhous_prod`.`y_prod` AS `y_prod`,`Greenhous_prod`.`v_unit` AS `v_unit`,`Greenhous_prod`.`no_mtol` AS `no_mtol`,`Greenhous_prod`.`no_kesht` AS `no_kesht`,`Greenhous_prod`.`t_mah` AS `t_mah`,`Greenhous_prod`.`add_abadi` AS `add_abadi`,`Greenhous_prod`.`add_city` AS `add_city` from `Greenhous_prod` where (`Greenhous_prod`.`y_prod` = '1404') order by `Greenhous_prod`.`add_abadi` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Green_Pro`
--

/*!50001 DROP TABLE IF EXISTS `V_Green_Pro`*/;
/*!50001 DROP VIEW IF EXISTS `V_Green_Pro`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Green_Pro` AS select `Greenprod_annual`.`id` AS `id`,`Greenprod_annual`.`mor_cod_m` AS `mor_cod_m`,`Greenprod_annual`.`unit_id` AS `unit_id`,`Greenprod_annual`.`id_ostan` AS `id_ostan`,`Greenprod_annual`.`id_city` AS `id_city`,`Greenprod_annual`.`id_mar` AS `id_mar`,`Greenprod_annual`.`bah_cod_m` AS `bah_cod_m`,`Greenprod_annual`.`num_bah` AS `num_bah`,`Greenprod_annual`.`y_prod` AS `y_prod`,`Greenprod_annual`.`no_kesht` AS `no_kesht`,`Greenprod_annual`.`group_cod` AS `group_cod`,`Greenprod_annual`.`mah_cod` AS `mah_cod`,`Greenprod_annual`.`s_kesh` AS `s_kesh`,`Greenprod_annual`.`m_tol` AS `m_tol`,`Greenprod_annual`.`add_abadi` AS `add_abadi`,`Greenprod_annual`.`add_city` AS `add_city` from `Greenprod_annual` where (`Greenprod_annual`.`y_prod` = '1404') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Mush`
--

/*!50001 DROP TABLE IF EXISTS `V_Mush`*/;
/*!50001 DROP VIEW IF EXISTS `V_Mush`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Mush` AS select `Mushroom`.`id` AS `id`,`Mushroom`.`mor_cod_m` AS `mor_cod_m`,`Mushroom`.`id_ostan` AS `id_ostan`,`Mushroom`.`id_city` AS `id_city`,`Mushroom`.`id_mar` AS `id_mar`,`Mushroom`.`bah_cod_m` AS `bah_cod_m`,`Mushroom`.`num_bah` AS `num_bah`,`Mushroom`.`no_mush` AS `no_mush`,`Mushroom`.`m_zamin` AS `m_zamin`,`Mushroom`.`m_arseh` AS `m_arseh`,`Mushroom`.`m_salon` AS `m_salon`,`Mushroom`.`add_abadi` AS `add_abadi`,`Mushroom`.`add_city` AS `add_city` from `Mushroom` where 1 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Mush_Pro`
--

/*!50001 DROP TABLE IF EXISTS `V_Mush_Pro`*/;
/*!50001 DROP VIEW IF EXISTS `V_Mush_Pro`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Mush_Pro` AS select `Mushroom_prod`.`id` AS `id`,`Mushroom_prod`.`mor_cod_m` AS `mor_cod_m`,`Mushroom_prod`.`unit_id` AS `unit_id`,`Mushroom_prod`.`id_ostan` AS `id_ostan`,`Mushroom_prod`.`id_city` AS `id_city`,`Mushroom_prod`.`id_mar` AS `id_mar`,`Mushroom_prod`.`y_prod` AS `y_prod`,`Mushroom_prod`.`bah_cod_m` AS `bah_cod_m`,`Mushroom_prod`.`no_mush` AS `no_mush`,`Mushroom_prod`.`v_unit` AS `v_unit`,`Mushroom_prod`.`t_dpar` AS `t_dpar`,`Mushroom_prod`.`zer_kesh` AS `zer_kesh`,`Mushroom_prod`.`mah_tol` AS `mah_tol`,`Mushroom_prod`.`tol_avg` AS `tol_avg`,`Mushroom_prod`.`add_abadi` AS `add_abadi`,`Mushroom_prod`.`add_city` AS `add_city` from `Mushroom_prod` where (`Mushroom_prod`.`y_prod` = '1404') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Vege`
--

/*!50001 DROP TABLE IF EXISTS `V_Vege`*/;
/*!50001 DROP VIEW IF EXISTS `V_Vege`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Vege` AS select `Vege`.`id` AS `id`,`Vege`.`mor_cod_m` AS `mor_cod_m`,`Vege`.`id_ostan` AS `id_ostan`,`Vege`.`id_city` AS `id_city`,`Vege`.`id_mar` AS `id_mar`,`Vege`.`add_abadi` AS `add_abadi`,`Vege`.`add_city` AS `add_city`,`Vege`.`z_sal` AS `z_sal`,`Vege`.`b_time` AS `b_time`,`Vege`.`m_ab` AS `m_ab`,`Vege`.`bah_cod_m` AS `bah_cod_m`,`Vege`.`sh_gat` AS `sh_gat`,`Vege`.`no_bah` AS `no_bah` from `Vege` where ((`Vege`.`z_sal` = '1404-1405') or (`Vege`.`z_sal` = '1403-1404')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_Vege_prod`
--

/*!50001 DROP TABLE IF EXISTS `V_Vege_prod`*/;
/*!50001 DROP VIEW IF EXISTS `V_Vege_prod`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_Vege_prod` AS select `Vege_prod`.`id` AS `id`,`Vege_prod`.`mor_cod_m` AS `mor_cod_m`,`Vege_prod`.`id_ostan` AS `id_ostan`,`Vege_prod`.`id_city` AS `id_city`,`Vege_prod`.`id_mar` AS `id_mar`,`Vege_prod`.`add_abadi` AS `add_abadi`,`Vege_prod`.`add_city` AS `add_city`,`Vege_prod`.`b_time` AS `b_time`,`Vege_prod`.`bah_cod_m` AS `bah_cod_m`,`Vege_prod`.`no_bah` AS `no_bah`,`Vege_prod`.`sh_gat` AS `sh_gat`,`Vege_prod`.`z_sal` AS `z_sal`,`Vege_prod`.`ra_kesh` AS `ra_kesh`,`Vege_prod`.`cod_mah` AS `cod_mah`,`Vege_prod`.`ragham` AS `ragham`,`Vege_prod`.`zer_kesht` AS `zer_kesht`,`Vege_prod`.`no_ab` AS `no_ab`,`Vege_prod`.`mah_bem` AS `mah_bem`,`Vege_prod`.`mah_tol` AS `mah_tol`,`Vege_prod`.`s_bar` AS `s_bar`,`Vege_prod`.`mah_tolp` AS `mah_tolp` from `Vege_prod` where ((`Vege_prod`.`z_sal` = '1404-1405') or (`Vege_prod`.`z_sal` = '1403-1404')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_bah`
--

/*!50001 DROP TABLE IF EXISTS `V_bah`*/;
/*!50001 DROP VIEW IF EXISTS `V_bah`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_bah` AS select `bah`.`id` AS `id`,`bah`.`date_s` AS `date_s`,`bah`.`id_ostan` AS `id_ostan`,`bah`.`id_city` AS `id_city`,`bah`.`add_abadi` AS `add_abadi`,`bah`.`add_city` AS `add_city`,`bah`.`id_mar` AS `id_mar`,`bah`.`no_bah` AS `no_bah`,`bah`.`num_bah` AS `num_bah`,`bah`.`name` AS `name`,`bah`.`last_name` AS `last_name`,`bah`.`bah_cod_m` AS `bah_cod_m`,`bah`.`co_name` AS `co_name`,`bah`.`sh_meli` AS `sh_meli`,`bah`.`date_t` AS `date_t`,`bah`.`jens` AS `jens`,`bah`.`m_tah` AS `m_tah`,`bah`.`s_bah` AS `s_bah`,`bah`.`tel_m` AS `tel_m`,`bah`.`valid` AS `valid`,`bah`.`no_nation` AS `no_nation`,`bah`.`ok` AS `ok`,`bah`.`mor_cod_m` AS `mor_cod_m` from `bah` where (`bah`.`date_s` = (select `day`.`yesterday_shamsi_date` from `day` where (`day`.`id` = 1))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_bah_amar`
--

/*!50001 DROP TABLE IF EXISTS `V_bah_amar`*/;
/*!50001 DROP VIEW IF EXISTS `V_bah_amar`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_bah_amar` AS select `bah`.`id_ostan` AS `id_ostan`,`bah`.`id_city` AS `id_city`,`bah`.`id_mar` AS `id_mar`,`bah`.`add_abadi` AS `add_abadi`,`bah`.`add_city` AS `add_city`,`bah`.`s_bah` AS `s_bah`,`bah`.`no_bah` AS `no_bah`,`bah`.`cod_p` AS `cod_p`,`bah`.`jens` AS `jens`,`bah`.`name` AS `name`,`bah`.`last_name` AS `last_name`,`bah`.`bah_cod_m` AS `bah_cod_m`,`bah`.`date_t` AS `date_t`,`bah`.`tel_s` AS `tel_s`,`bah`.`tel_m` AS `tel_m`,`bah`.`co_name` AS `co_name`,`bah`.`sh_meli` AS `sh_meli`,`bah`.`fa_1` AS `fa_1`,`bah`.`fa_2` AS `fa_2`,`bah`.`fa_3` AS `fa_3`,`bah`.`fa_45` AS `fa_45`,`bah`.`fa_67` AS `fa_67`,`bah`.`fa_8` AS `fa_8`,`bah`.`fa_9` AS `fa_9`,`bah`.`fa_10` AS `fa_10`,`bah`.`fa_11` AS `fa_11`,`bah`.`fa_12` AS `fa_12`,`bah`.`fa_13` AS `fa_13`,`bah`.`fa_14` AS `fa_14`,`bah`.`no_nation` AS `no_nation` from `bah` where (`bah`.`ok` <> 2) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `V_bee`
--

/*!50001 DROP TABLE IF EXISTS `V_bee`*/;
/*!50001 DROP VIEW IF EXISTS `V_bee`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `V_bee` AS select `bee`.`id` AS `id`,`bee`.`mor_cod_m` AS `mor_cod_m`,`bee`.`sal` AS `sal`,`bee`.`id_ostan` AS `id_ostan`,`bee`.`id_city` AS `id_city`,`bee`.`id_mar` AS `id_mar`,`bee`.`no_zan` AS `no_zan`,`bee`.`m_ostan` AS `m_ostan`,`bee`.`m_city` AS `m_city`,`bee`.`vaz_zan` AS `vaz_zan`,`bee`.`bem_zan` AS `bem_zan`,`bee`.`bem_kand` AS `bem_kand`,`bee`.`bah_cod_m` AS `bah_cod_m`,`bee`.`t_sha` AS `t_sha`,`bee`.`tk_mo` AS `tk_mo`,`bee`.`tk_bo` AS `tk_bo`,`bee`.`to_mo` AS `to_mo`,`bee`.`to_bo` AS `to_bo`,`bee`.`t_gar` AS `t_gar`,`bee`.`t_bar` AS `t_bar`,`bee`.`t_mom` AS `t_mom`,`bee`.`t_k_jel` AS `t_k_jel`,`bee`.`t_jel` AS `t_jel`,`bee`.`t_zah` AS `t_zah`,`bee`.`add_abadi` AS `add_abadi`,`bee`.`add_city` AS `add_city` from `bee` where (`bee`.`sal` = '1404') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-28  9:52:45
