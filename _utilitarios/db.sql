-- MySQL dump 10.13  Distrib 5.7.15, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: migration_ov
-- ------------------------------------------------------
-- Server version	5.7.15-0ubuntu0.16.04.1

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
-- Table structure for table `agendas`
--

DROP TABLE IF EXISTS `agendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agendas` (
  `agenda_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `agenda_start` varchar(15) COLLATE utf8_bin NOT NULL,
  `agenda_end` varchar(15) COLLATE utf8_bin NOT NULL,
  `agenda_start_normal` varchar(50) COLLATE utf8_bin NOT NULL,
  `agenda_end_normal` varchar(45) COLLATE utf8_bin NOT NULL,
  `agenda_class` varchar(45) COLLATE utf8_bin NOT NULL DEFAULT 'event-important',
  `agenda_url` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `agenda_proc` varchar(45) COLLATE utf8_bin NOT NULL,
  `agenda_pac` varchar(45) COLLATE utf8_bin NOT NULL,
  `agenda_desc` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`agenda_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela agenda de usuários.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendas`
--

LOCK TABLES `agendas` WRITE;
/*!40000 ALTER TABLE `agendas` DISABLE KEYS */;
INSERT INTO `agendas` VALUES (6,'1474944960000','1474944960000','26/09/2016 23:56','26/09/2016 23:56','event-info','http://127.0.0.1/gclinic/agenda/box-visao?ag=Njg5Ng==','Canal','Francisco','Francisco');
/*!40000 ALTER TABLE `agendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinics`
--

DROP TABLE IF EXISTS `clinics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clinics` (
  `clinic_id` int(11) NOT NULL AUTO_INCREMENT,
  `clinic_name` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`clinic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela clinica onde ficara armazendo o nome da clinica e seu respectivo id associado a tabela users';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinics`
--

LOCK TABLES `clinics` WRITE;
/*!40000 ALTER TABLE `clinics` DISABLE KEYS */;
INSERT INTO `clinics` VALUES (65,'Ortho'),(66,'Unimed'),(67,'dsdsdsd'),(68,'dsdsdsd'),(69,'FRANCISCO APARECIDO GOMES DE ALMEIDA'),(70,'CLIMED'),(71,'DGP'),(72,'Clinica dos dentes'),(73,'CLIMED'),(74,'SORRISSO'),(75,'Clinica do dentes'),(76,'Sorriso'),(77,'Sorriso');
/*!40000 ALTER TABLE `clinics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `login_attempts_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_attempts_users_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`login_attempts_id`,`login_attempts_users_id`),
  KEY `login_attempts_login_attempts_users_id_idx` (`login_attempts_users_id`),
  CONSTRAINT `login_attempts_login_attempts_users_id` FOREIGN KEY (`login_attempts_users_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `providers`
--

DROP TABLE IF EXISTS `providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `providers` (
  `provider_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do fornecedor',
  `provider_name` varchar(45) NOT NULL COMMENT 'Nome do fornecedor / Empresa',
  `provider_cpf_cnpj` varchar(45) DEFAULT NULL COMMENT 'CPF ou CNPJ do fornecedor',
  `provider_rs` varchar(45) DEFAULT NULL COMMENT 'Razão Social do fornecedor.',
  `provider_at` varchar(45) DEFAULT NULL COMMENT 'Fornecedor ará de atuação',
  `provider_end` varchar(45) DEFAULT NULL COMMENT 'Endereço do fornecedor',
  `provider_bair` varchar(45) DEFAULT NULL COMMENT 'Bairro',
  `provider_cid` varchar(45) DEFAULT NULL COMMENT 'Cidade',
  `provider_uf` varchar(45) DEFAULT NULL COMMENT 'Estado UF',
  `provider_pais` varchar(45) DEFAULT NULL COMMENT 'Pais / Nação',
  `provider_cep` varchar(45) DEFAULT NULL COMMENT 'CEP do fornecedor',
  `provider_cel` varchar(45) DEFAULT NULL COMMENT 'Celular',
  `provider_tel_1` varchar(45) DEFAULT NULL COMMENT 'Telefone 1',
  `provider_tel_2` varchar(45) DEFAULT NULL COMMENT 'Telefone 2',
  `provider_insc_uf` varchar(45) DEFAULT NULL COMMENT 'Inscrição Estadual',
  `provider_web_url` varchar(45) DEFAULT NULL COMMENT 'WebSite - do fornecedor',
  `provider_email` varchar(45) DEFAULT NULL COMMENT 'Email do fornecedor\n',
  PRIMARY KEY (`provider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `providers`
--

LOCK TABLES `providers` WRITE;
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recoveries`
--

DROP TABLE IF EXISTS `recoveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recoveries` (
  `recovery_id` int(11) NOT NULL AUTO_INCREMENT,
  `recovery_users_id` int(11) NOT NULL,
  `recovery_token` varchar(255) CHARACTER SET utf8 NOT NULL,
  `recovery_status` int(1) NOT NULL,
  PRIMARY KEY (`recovery_id`,`recovery_users_id`),
  KEY `passwords_users_id_idx` (`recovery_users_id`),
  CONSTRAINT `passwords_users_id` FOREIGN KEY (`recovery_users_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recoveries`
--

LOCK TABLES `recoveries` WRITE;
/*!40000 ALTER TABLE `recoveries` DISABLE KEYS */;
/*!40000 ALTER TABLE `recoveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_level` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'adm'),(2,'user');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_password` char(128) CHARACTER SET utf8 NOT NULL,
  `user_session_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_permissions` longtext CHARACTER SET utf8,
  `user_role_id` int(11) NOT NULL,
  `user_status` int(2) NOT NULL,
  `user_clinic_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`user_clinic_id`),
  KEY `users_user_role_id_idx` (`user_role_id`),
  KEY `users_user_clinic_id_idx` (`user_clinic_id`),
  CONSTRAINT `users_user_clinic_id` FOREIGN KEY (`user_clinic_id`) REFERENCES `clinics` (`clinic_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `users_user_role_id` FOREIGN KEY (`user_role_id`) REFERENCES `roles` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'FRANCISCO APARECIDO','gomes.tisystem@gmail.com','$2y$10$nln0jVGo1esSI7o3ux0n8Oxg2kMio4yW9ldftujcg9bgi7puU1VBK','cfad3a26ed17d3fe2c72ce2004a4df0a',NULL,1,1,77);
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

-- Dump completed on 2016-09-27  0:01:44
