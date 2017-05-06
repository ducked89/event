-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: utedb
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `connexionlog`
--

DROP TABLE IF EXISTS `connexionlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `connexionlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `connexiondate` datetime DEFAULT NULL,
  `ipaddress` varchar(200) DEFAULT NULL,
  `browser` varchar(200) DEFAULT NULL,
  `deviceos` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connexionlog`
--

LOCK TABLES `connexionlog` WRITE;
/*!40000 ALTER TABLE `connexionlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `connexionlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `criteres`
--

DROP TABLE IF EXISTS `criteres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criteres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `description` mediumtext,
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `statut` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criteres`
--

LOCK TABLES `criteres` WRITE;
/*!40000 ALTER TABLE `criteres` DISABLE KEYS */;
INSERT INTO `criteres` VALUES (1,'Performance','Le consultant possÃ¨de les connaissances et l\'expÃ©rience nÃ©cessaires pour effectuer son travail de maniÃ¨re professionnelle. Il est capable de dÃ©montrer au quotidien la maÃ®trise de son travail.','2017-04-03 15:04:39',1),(2,'QualitÃ© du Travail et des Produits ','Le consultant dÃ©montre un rÃ©el souci du travail bien fait, fait attention aux dÃ©tails, respecte les procÃ©dures en vigueur. ','2017-04-03 15:04:39',1),(3,'DisponibilitÃ© / FlexibilitÃ© ','Le consultant sait adapter son programme de travail et ses horaires aux besoins ou aux urgences de l\'Ã©quipe et de l\'UTE.','2017-04-03 15:04:39',1),(4,'Esprit d\'initiative ','Le consultant prend des initiatives. Face Ã  des situations nouvelles ou inattendues,  il est capable d\'apporter des idÃ©es nouvelles ou des solutions innovantes','2017-04-03 15:04:39',1),(5,'Gestion du temps','Le consultant Ã©tablit et met Ã  jour rÃ©guliÃ¨rement son plan de travail. Il sait estimer convenablement les dÃ©lais et respecte les Ã©chÃ©ances.','2017-04-03 15:04:39',1),(6,'Communication Orale','Le consultant communique efficacement et de faÃ§on appropriÃ©e. Il sait trouver le ton juste en fonction de la situation. Il s\'exprime de faÃ§on prÃ©cise et crÃ©dible, Ã  l\'oral. Il prend le soin d\'Ã©couter les autres.','2017-04-03 15:04:39',1),(7,'Communication Ecrite','Le consultant maÃ®trise la langue franÃ§aise, communique efficacement et de faÃ§on appropriÃ©e. Il accorde une grande attention au fond et Ã  la forme de ses documents. ','2017-04-03 15:04:39',1),(8,'Relations Interpersonnelles','Le consultant est agrÃ©able dans ses Ã©changes. Il tient compte des besoins des autres et de leurs capacitÃ©s. Il traite ses interlocuteurs avec respect et considÃ©ration.','2017-04-03 15:04:39',1),(9,'Esprit d\'Ã©quipe ','Le consultant fait montre d\'un vrai esprit d\'Ã©quipe. Il apporte sa complÃ©mentaritÃ© Ã  l\'Ã©quipe Ã  travers ses idÃ©es, opinions et commentaires. Il communique de maniÃ¨re ouverte et franche et respecte les engagements pris auprÃ¨s de l\'Ã©quipe.','2017-04-03 15:04:39',1),(10,'RÃ©troaction','Le consultant est toujours Ã  l\'Ã©coute des commentaires sur son travail avec un esprit ouvert dans le but de s\'amÃ©liorer.','2017-04-03 15:04:39',1);
/*!40000 ALTER TABLE `criteres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employes`
--

DROP TABLE IF EXISTS `employes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `idservice` int(11) DEFAULT NULL,
  `firstname` varchar(245) DEFAULT NULL,
  `lastname` varchar(245) DEFAULT NULL,
  `sex` varchar(5) DEFAULT NULL,
  `email` varchar(245) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `extension` varchar(11) DEFAULT NULL,
  `position` varchar(245) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employes`
--

LOCK TABLES `employes` WRITE;
/*!40000 ALTER TABLE `employes` DISABLE KEYS */;
INSERT INTO `employes` VALUES (1,2,12,'Abraham ','GATEAU','m','agateau@ute.gouv.ht','3327-5835',NULL,'286','SpÃ©cialiste en Passation de MarchÃ©',''),(2,3,14,'Alix ','CLÃ‰MENT','m','aclement@ute.gouv.ht','3255-0505',NULL,'245','Junior Finance Assistant',''),(3,4,12,'CanÃ¨s ','GIROLIEN','m','cgirolien@ute.gouv.ht','3333-3405',NULL,'239','SpÃ©cialiste en Passation de MarchÃ©',''),(4,5,8,'Carline',' CHOUTE','f','cchoute@ute.gouv.ht','3273-2517','','250','Coordonnatrice des Programmes AEQ & APREH',NULL),(5,6,8,'Stephenson','Charles','m','mcstephenson@ute.gouv.ht','3273-2517','dsjkbds','25','Coordonnatrice du Programme TCD',''),(6,7,8,'Chrystelle B. ','POTEAU','f','cbpoteau@ute.gouv.ht','4042-1471',NULL,'259','ChargÃ© de projet TCD',''),(7,8,8,'Claude ','METAYER','m','cmetayer@ute.gouv.ht','3371-3747',NULL,'N/A','ChargÃ© de projet PAST',''),(8,9,4,'Clautilde ','MÃ‰US','f','cmeus@ute.gouv.ht ','4196-1765',NULL,'244','Chef Comptable',''),(9,10,8,'Dorphy ','LEONARD',NULL,'dnleonard@ute.gouv.ht','4042-0870',NULL,'236','ChargÃ© de Projet AEQ',''),(10,11,8,'Edwine ','TANIS','m','etanis@ute.gouv.ht','4042-4690',NULL,'293','Assistant Coordonnateur de Projet BCA',''),(11,12,6,'Emmanuel ','GEORGES','m','egeorges@ute.gouv.ht','4030-5992',NULL,'299','Directeur ExÃ©cutif Adjoint aux Affaires Administratives et FinanciÃ¨res',''),(12,13,8,'Erlande ','Ã‰GALITÃ‰','f','eegalite@ute.gouv.ht','4160-2172',NULL,'285','ChargÃ© de Projet BCA',''),(13,14,4,'Estervelo ','DERIUS','m','ederius@ute.gouv.ht','3333-9261',NULL,'255','Comptable',''),(14,15,8,'Farah Altagracia ','DORVAL','f','fdorval@ute.gouv.ht','4042-8346',NULL,'N/A','ChargÃ© de Projet HUEH',''),(15,16,12,'Farah P. ','DESGAZON','f','mpfdesgazon@ute.gouv.ht','4042-3329',NULL,'225','SpÃ©cialiste en Passation de MarchÃ©',''),(16,17,8,'Joseph Harold  ','GASPARD','m','jhgaspard@ute.gouv.ht','3364-1162',NULL,'231','Coordonnateur de Projet PAST',''),(17,18,4,'Jean Bernard ','POUX','m','jbpoux@ute.gouv.ht ','4196-1766',NULL,'242','Comptable',''),(18,19,8,'Jean Claude ','FAUSTIN','m','jfaustin@ute.gouv.ht ','4028-3232',NULL,'261','Coordonnateur de Projet PEPIM',''),(19,20,14,'Jean Garry ','DENIS','m','jgdenis@ute.gouv.ht','3333-2541',NULL,'N/A','SpÃ©cialiste Social ',''),(20,21,14,'Juto ','LOUIS-CHARLES ','m','jlouis-charles@ute.gouv.ht','4042-5931',NULL,'256','SpÃ©cialiste Environnemental ',''),(21,22,8,'Kulbert ','BEAUZILE','m','kbeauzile@ute.gouv.ht','3272-0659',NULL,'237','ChargÃ© de Projet ',''),(22,23,9,'Lanier ','SAGESSE','m','lsagesse@ute.gouv.ht ','3333-2535',NULL,'258','SpÃ©cialiste en Ã‰valuation et Suivi',''),(23,24,10,'Lenz G. ','FELIX','m','lgfelix@ute.gouv.ht ','4042-6543',NULL,'260','SpÃ©cialiste Informatique',''),(24,25,4,'Marie Gela ','BRICE','f','mgbrice@ute.gouv.ht','3390-4204',NULL,'248','Comptable',''),(25,26,3,'Marjorie ','ELIACIN','f','meliacin@ute.gouv.ht ','4242-4153',NULL,'298','SpÃ©cialiste en Communication',''),(26,27,7,'Mathilde F. ','MARDY','f','mfmardy@ute.gouv.ht','4042-2456',NULL,'224','Directrice FinanciÃ¨re',''),(27,28,6,'MichaÃ«l ','DE LANDSHEER','m','mdelandsheer@ute.gouv.ht','3333-3646',NULL,'222','Directeur ExÃ©cutif',''),(28,29,5,'Muriel ','ANTOINE','f','mantoine@ute.gouv.ht','4042-2259',NULL,'228','Directrice Administrative',''),(29,30,8,'Natacha DorÃ©lien ','JOSEPH','f','ndjoseph@ute.gouv.ht','3333-2531',NULL,'296','ChargÃ©e de Projet AEQ & APREH',''),(30,31,1,'Nathalie ','POUCHIN','f','npouchin@ute.gouv.ht','4042-4421',NULL,'N/A','SpÃ©cialiste Assurance QualitÃ©',''),(31,32,10,'NathanaÃ«l ','VIXAMAR',NULL,'nvixamar@ute.gouv.ht','4042-6676',NULL,'291','SpÃ©cialiste Informatique',''),(32,33,11,'Norma ','THÃ‰ODORE',NULL,'ntheodore@ute.gouv.ht','4043-0629',NULL,'223','Chef de Service Logistique et des Moyens GÃ©nÃ©raux',''),(33,34,8,'Parnelle S. ','BOURSIQUOT',NULL,'psvboursiquot@ute.gouv.ht','4041-9459',NULL,'240','Coordonnatrice du Projet HUEH',''),(34,35,5,'Philippe Rudy  ','APOLLON','m','papollon@ute.gouv.ht','4196-1767',NULL,'246','Directeur Administratif Adjoint',''),(35,36,8,'Pierre Gerton ','RENÃ‰','m','gertonrene@ute.gouv.ht','4042-0722',NULL,'230','Coordonnateur des Programmes PIC & GIDE',''),(36,37,6,'Pierre-Michel ','JOASSAINT','m','pmjoassaint@ute.gouv.ht','4030-5993',NULL,'241','Directeur ExÃ©cutif Adjoint aux OpÃ©rations',''),(37,38,8,'Reynold ','PAUYO','m','rpauyo@ute.gouv.ht','3269-2479',NULL,'247','Directeur Technique',''),(38,39,12,'Ronaldo ','JOANIS','m','rjoanis@ute.gouv.ht','3333-3410',NULL,'300','SpÃ©cialiste en Passation de MarchÃ©',''),(39,40,12,'Rudler ','MOSS',NULL,'rmoss@ute.gouv.ht','4030-6561',NULL,'226','Directeur de Passation de MarchÃ©s',''),(40,41,14,'Sabine Lilas C. ','LAMOUR','f','slamour@ute.gouv.ht','4042-5700',NULL,'257','SpÃ©cialiste Social ',''),(41,42,4,'StÃ©phane Y. ','CHARLOT',NULL,'yscharlot@ute.gouv.ht','4042-9332',NULL,'232','Comptable',''),(42,43,13,'Vianie L. ','LAUTURE',NULL,'mvlundi@ute.gouv.ht','4265-7080',NULL,'221','Chef de Service des Ressources Humaines',''),(43,44,10,'Wilson ','CUPIDON','M','wcupidon@ute.gouv.ht','4379-4510','','238','Chef de Service Technologie et Informatique',''),(44,45,5,'Araneta ','MICHEL','f','amichel@ute.gouv.ht','3333-3416',NULL,'N/A','Assistante Adm. et Logistique',''),(45,46,5,'Katianarenz O. ','FRANCOIS','f','kofrancois@ute.gouv.ht','4029-9413',NULL,'233','SecrÃ©taire de Direction',''),(46,47,7,'Lisbeth B. ','JEAN','f','lbjean@ute.gouv.ht','4043-1868',NULL,'303','Assistante FinanciÃ¨re',''),(47,48,6,'Lorna ','JN PHILIPPE','f','ljphilippe@ute.gouv.ht','3792-4928',NULL,'235','SecrÃ©taire de Direction',''),(48,49,7,'Mardelle G. ','DESTIMA','f','mgdestima@ute.gouv.ht','3472-7647',NULL,'253','SecrÃ©taire de Direction',''),(49,50,7,'Mulvia ','SAINT-HUBERT','f','msainthubert@ute.gouv.ht','3716-6898',NULL,'254','Assistante FinanciÃ¨re',''),(50,51,5,'Nancy ','ESTIVERNE','f','nestiverne@ute.gouv.ht','4043-1474',NULL,'304','Assistante Adm. et Logistique',''),(51,52,7,'PerpÃ©tue ','LAROSILIERE','f','plarosiliere@ute.gouv.ht','4849-0868',NULL,'235/303','Assistante FinanciÃ¨re',''),(52,53,5,'Solange ','DAVID','f','mjsdavid@ute.gouv.ht','3717-4435',NULL,'301','SecrÃ©taire Archiviste ',''),(53,54,12,'StÃ©phania ','ROBERT','f','srobert@ute.gouv.ht','3945-8296',NULL,'288','SecrÃ©taire de Direction',''),(54,55,6,'Wilmire ','ALABRE','f','walabre@ute.gouv.ht','3764-7564',NULL,'287','SecrÃ©taire de Direction',''),(55,56,5,'Yolna ','JOSEPH','f','yjoseph@ute.gouv.ht','4043-0767',NULL,'234','Assistante Adm. et Logistique',''),(56,57,2,'Tamara','OSTINE','f','tostine@ute.gouv.ht',NULL,NULL,NULL,'Auditeur Interne',''),(57,58,5,'Djoulie','JEAN','f','djean@ute.gouv.ht',NULL,NULL,NULL,'Secretaire',''),(58,59,5,'Mara G.','ILERMONT','f','milermont@ute.gouv.ht',NULL,NULL,NULL,'Assistante Adm. et Logistique',''),(59,60,8,'Phalandina E.','LUC','f','pluc@ute.gouv.ht',NULL,NULL,NULL,'SecrÃ©taire de Direction','');
/*!40000 ALTER TABLE `employes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evaluations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idponderation` int(255) NOT NULL,
  `idevalue` int(11) DEFAULT NULL,
  `idevaluateur` int(11) DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(300) CHARACTER SET utf8 NOT NULL,
  `alttitle` varchar(300) CHARACTER SET utf8 NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '0',
  `mois` int(11) NOT NULL DEFAULT '1',
  `annee` int(11) NOT NULL,
  `targetdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datemodified` datetime DEFAULT CURRENT_TIMESTAMP,
  `datecompleted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` int(11) DEFAULT '0',
  `commentaire` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluations`
--

LOCK TABLES `evaluations` WRITE;
/*!40000 ALTER TABLE `evaluations` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mailconfig`
--

DROP TABLE IF EXISTS `mailconfig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mailconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `smtpsecure` varchar(10) NOT NULL,
  `port` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mailconfig`
--

LOCK TABLES `mailconfig` WRITE;
/*!40000 ALTER TABLE `mailconfig` DISABLE KEYS */;
INSERT INTO `mailconfig` VALUES (1,'smtp.gmail.com','leger.kevenson@gmail.com','inika2014','ssl','465');
/*!40000 ALTER TABLE `mailconfig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mentions`
--

DROP TABLE IF EXISTS `mentions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mentions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mentions`
--

LOCK TABLES `mentions` WRITE;
/*!40000 ALTER TABLE `mentions` DISABLE KEYS */;
INSERT INTO `mentions` VALUES (1,'N/A',0,'Non applicable / Ma position ne me permet pas de juger lâ€™Ã©valuÃ© sur ce critÃ¨re','2017-04-12 23:37:04'),(2,'InadÃ©quat',1,'Le consultant nâ€™arrivera pas Ã  atteindre le niveau requis.','2017-04-12 23:37:40'),(3,'InadÃ©quat ',2,'le consultant nâ€™a pas les bases suffisantes lui permettant dâ€™atteindre le niveau requis','2017-04-13 21:19:50'),(4,'Nettement en dessous du niveau requis',3,'le consultant doit encore faire des efforts pour atteindre le niveau requis.','2017-04-13 21:20:29'),(5,'En dessous du niveau requis',4,'Lâ€™Ã©valuÃ© dispose de certaines compÃ©tences, mais il nâ€™arrive pas toujours Ã  rÃ©pondre aux attentes','2017-04-13 21:21:22'),(6,'Niveau adÃ©quat',5,'Lâ€™Ã©valuÃ© a le niveau requis. Il a les compÃ©tences nÃ©cessaires et rÃ©pond aux attentes dans ce domaine. ','2017-04-13 21:22:28'),(7,'Niveau adÃ©quat ',6,'Lâ€™Ã©valuÃ© a le niveau requis. Il a les compÃ©tences nÃ©cessaires, rÃ©pond aux attentes dans ce domaine et pourra sâ€™amÃ©liorer.','2017-04-13 21:22:59'),(8,'Niveau Ã©levÃ©',7,'Le consultant rÃ©pond Ã  toutes les attentes et dÃ©passe souvent le niveau requis.','2017-04-13 21:24:26'),(9,'Niveau trÃ¨s Ã©levÃ©',8,'Le consultant rÃ©pond Ã  toutes les attentes et dÃ©passe rÃ©guliÃ¨rement le niveau requis.','2017-04-13 21:24:57'),(10,'Niveau plus Ã©levÃ© que celui requis ',9,'Le consultant dÃ©passe systÃ©matiquement toutes les attentes dans ce domaine','2017-04-13 21:25:33'),(11,'Niveau plus Ã©levÃ© que celui requis ',10,'Lâ€™Ã©valuÃ© a une compÃ©tence exceptionnelle dans ce domaine','2017-04-13 21:26:04');
/*!40000 ALTER TABLE `mentions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagesadminenvoyes`
--

DROP TABLE IF EXISTS `messagesadminenvoyes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagesadminenvoyes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idreceiver` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `content` text,
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagesadminenvoyes`
--

LOCK TABLES `messagesadminenvoyes` WRITE;
/*!40000 ALTER TABLE `messagesadminenvoyes` DISABLE KEYS */;
/*!40000 ALTER TABLE `messagesadminenvoyes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagesadminrecus`
--

DROP TABLE IF EXISTS `messagesadminrecus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagesadminrecus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsender` int(11) DEFAULT NULL,
  `categorie` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `content` text,
  `statut` int(155) NOT NULL DEFAULT '0',
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagesadminrecus`
--

LOCK TABLES `messagesadminrecus` WRITE;
/*!40000 ALTER TABLE `messagesadminrecus` DISABLE KEYS */;
/*!40000 ALTER TABLE `messagesadminrecus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagesmembersenvoyes`
--

DROP TABLE IF EXISTS `messagesmembersenvoyes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagesmembersenvoyes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsender` int(11) DEFAULT NULL,
  `idreceiver` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `content` text,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagesmembersenvoyes`
--

LOCK TABLES `messagesmembersenvoyes` WRITE;
/*!40000 ALTER TABLE `messagesmembersenvoyes` DISABLE KEYS */;
/*!40000 ALTER TABLE `messagesmembersenvoyes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagesmembersrecus`
--

DROP TABLE IF EXISTS `messagesmembersrecus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagesmembersrecus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsender` int(11) DEFAULT NULL,
  `idreceiver` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `content` text,
  `statut` int(255) NOT NULL,
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagesmembersrecus`
--

LOCK TABLES `messagesmembersrecus` WRITE;
/*!40000 ALTER TABLE `messagesmembersrecus` DISABLE KEYS */;
/*!40000 ALTER TABLE `messagesmembersrecus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idevaluation` int(11) DEFAULT NULL,
  `idcritere` int(11) DEFAULT NULL,
  `notes` int(11) DEFAULT '100',
  `commentaire` varchar(700) DEFAULT NULL,
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(255) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `title` varchar(300) DEFAULT NULL,
  `content` varchar(800) DEFAULT NULL,
  `sent` int(155) NOT NULL,
  `datecreated` datetime DEFAULT NULL,
  `statut` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parametres`
--

DROP TABLE IF EXISTS `parametres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parametres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` int(11) DEFAULT '0',
  `accueil` varchar(1000) DEFAULT NULL,
  `contact1` varchar(2000) CHARACTER SET utf8mb4 DEFAULT NULL,
  `contact2` varchar(1000) DEFAULT '',
  `notice` text,
  `logo` varchar(200) NOT NULL,
  `banner` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parametres`
--

LOCK TABLES `parametres` WRITE;
/*!40000 ALTER TABLE `parametres` DISABLE KEYS */;
INSERT INTO `parametres` VALUES (1,1,'Lâ€™UnitÃ© Technique dâ€™ExÃ©cution (UTE) a Ã©tÃ© crÃ©Ã©e le 15 octobre 2004 au sein du MinistÃ¨re de lâ€™Ã‰conomie et des Finances (MEF) comme entitÃ© technique responsable de la prise en charge de lâ€™exÃ©cution du Programme de Remise en Ã‰tat de l\'Infrastructure Ã‰conomique de Base (PREIEB), financÃ© (PrÃªt 1493/SF-HA) par la Banque InteramÃ©ricaine de DÃ©veloppement (BID) et avec un apport en contrepartie de lâ€™Ã‰tat haÃ¯tien. Satisfaite de lâ€™avancement du programme, lâ€™Agence Canadienne de DÃ©veloppement Internationale (ACDI) apportait ultÃ©rieurement au PREIEB un financement complÃ©mentaire.\r\n\r\nFort des rÃ©sultats tangibles obtenus par cette Ã©quipe de spÃ©cialistes, dâ€™autres bailleurs ont vite manifestÃ© leur intÃ©rÃªt Ã  travailler avec lâ€™UTE. Ainsi, lâ€™Agence FranÃ§aise de DÃ©veloppement (AFD) a choisi de lui confier lâ€™exÃ©cution dâ€™un Projet de 8.0Mâ‚¬, la composante A du programme Environnement et DÃ©veloppement Urbains Ã  Jacmel (PEDUJ).','Lâ€™UnitÃ© Technique dâ€™ExÃ©cution (UTE) a Ã©tÃ© crÃ©Ã©e le 15 octobre 2004 au sein du MinistÃ¨re de lâ€™Ã‰conomie et des Finances (MEF) comme entitÃ© technique responsable de la prise en charge de lâ€™exÃ©cution du Programme de Remise en Ã‰tat de l\'Infrastructure Ã‰conomique de Base (PREIEB), financÃ© (PrÃªt 1493/SF-HA) par la Banque InteramÃ©ricaine de DÃ©veloppement (BID) et avec un apport en contrepartie de lâ€™Ã‰tat haÃ¯tien.\r\n\r\n<a href=\"http://www.ute.gouv.ht/\" target=\"_blank\" >Visitez notre site</a>','UnitÃ© Technique dâ€™ExÃ©cution (UTE) \r\n26, rue 3, Port-au-Prince, Haiti \r\n(509) 2813-0290 / 2941- 0290 \r\nwww.ute.gouv.ht','dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially \r\n\r\nunchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','utelogo.png','utebanner.png');
/*!40000 ALTER TABLE `parametres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ponderations`
--

DROP TABLE IF EXISTS `ponderations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ponderations` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ponderations`
--

LOCK TABLES `ponderations` WRITE;
/*!40000 ALTER TABLE `ponderations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ponderations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ponderationslites`
--

DROP TABLE IF EXISTS `ponderationslites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ponderationslites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idponderation` int(11) NOT NULL,
  `idcriteres` int(11) DEFAULT NULL,
  `percent` int(11) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ponderationslites`
--

LOCK TABLES `ponderationslites` WRITE;
/*!40000 ALTER TABLE `ponderationslites` DISABLE KEYS */;
/*!40000 ALTER TABLE `ponderationslites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiltypes`
--

DROP TABLE IF EXISTS `profiltypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiltypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(245) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiltypes`
--

LOCK TABLES `profiltypes` WRITE;
/*!40000 ALTER TABLE `profiltypes` DISABLE KEYS */;
INSERT INTO `profiltypes` VALUES (1,'Assurance QualitÃ©',NULL,'2017-04-07 08:55:22'),(2,'Audit',NULL,'2017-04-07 08:55:22'),(3,'Communication',NULL,'2017-04-07 08:55:22'),(4,'ComptabilitÃ©',NULL,'2017-04-07 08:55:22'),(5,'Direction Administrative',NULL,'2017-04-07 08:55:22'),(6,'Direction Executive',NULL,'2017-04-07 08:55:22'),(7,'Direction FinanciÃ¨re',NULL,'2017-04-07 08:55:22'),(8,'Direction Technique',NULL,'2017-04-07 08:55:22'),(9,'Evaluation et Suivi',NULL,'2017-04-07 08:55:22'),(10,'Informatique',NULL,'2017-04-07 08:55:22'),(11,'Logistique et des Moyens GÃ©nÃ©raux',NULL,'2017-04-07 08:55:22'),(12,'Passation de MarchÃ©',NULL,'2017-04-07 08:55:22'),(13,'Direction Ressources Humaines',NULL,'2017-04-07 08:55:22'),(14,'Sauvegarde Environnementale et Sociale',NULL,'2017-04-07 08:55:22'),(15,'Service Juridique',NULL,'2017-04-07 09:37:56');
/*!40000 ALTER TABLE `profiltypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrateur du systeme',1),(2,'users','Evaluateur',2);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `description` mediumtext,
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `statut` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleid` int(11) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `lastattempts` datetime DEFAULT CURRENT_TIMESTAMP,
  `numberattempts` int(11) DEFAULT NULL,
  `firstlogin` int(11) NOT NULL DEFAULT '0',
  `notice` int(11) NOT NULL DEFAULT '0',
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'devuser','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-09 00:00:00',1),(2,2,'agateau','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(3,2,'aclement','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(4,2,'cgirolien','e2d75b01c33ae9e173fc5668b6312bb25367f304',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(5,2,'cchoute','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(6,2,'mcstephenson','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(7,2,'cbpoteau','41fd89cdc306f6c772a5b8f63b626457102b8c4c',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(8,2,'cmetayer','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(9,2,'cmeus','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(10,2,'dnleonard','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(11,2,'etanis','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(12,2,'egeorges','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(13,2,'eegalite','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(14,2,'ederius','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(15,2,'fdorval','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(16,2,'mpfdesgazon','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(17,2,'jhgaspard','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(18,2,'jbpoux','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(19,2,'jfaustin','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(20,2,'jgdenis','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(21,2,'jlouis-charles','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(22,2,'kbeauzile','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(23,2,'lsagesse','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(24,2,'lgfelix','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(25,2,'mgbrice','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(26,2,'meliacin','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(27,2,'mfmardy','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(28,2,'mdelandsheer','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(29,2,'mantoine','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(30,2,'ndjoseph','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(31,2,'npouchin','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(32,2,'nvixamar','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(33,2,'ntheodore','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(34,2,'psvboursiquot','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(35,2,'papollon','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(36,2,'gertonrene','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(37,2,'pmjoassaint','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(38,2,'rpauyo','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(39,2,'rjoanis','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(40,2,'rmoss','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(41,2,'slamour','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(42,2,'yscharlot','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(43,2,'mvlundi','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(44,2,'wcupidon','d83177daa22aeba3081abf055f98fd39cb8ecf4a',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(45,2,'amichel','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(46,2,'kofrancois','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(47,2,'lbjean','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(48,2,'ljphilippe','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(49,2,'mgdestima','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(50,2,'msainthubert','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(51,2,'nestiverne','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(52,2,'plarosiliere','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(53,2,'mjsdavid','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(54,2,'srobert','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(55,2,'walabre','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(56,2,'yjoseph','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(57,2,'tostine','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(58,2,'djean','e2d75b01c33ae9e173fc5668b6312bb25367f304',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(59,2,'milermont','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684 ',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1),(60,2,'pluc','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684',NULL,NULL,0,0,0,'2017-03-30 08:05:34',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-26 11:35:39
