-- MySQL dump 10.13  Distrib 5.5.62, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: shopedia
-- ------------------------------------------------------
-- Server version	5.5.62-0ubuntu0.14.04.1

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
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `userId` int(11) NOT NULL,
  `creditCardNumber` text NOT NULL,
  `cvvNumber` text NOT NULL,
  `expiryDate` text NOT NULL,
  `fullName` text NOT NULL,
  `cartItems` text NOT NULL,
  `orderId` int(11) NOT NULL,
  `amountPaid` float NOT NULL,
  UNIQUE KEY `orderId` (`orderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (5,'4242 4242 4242 4242','123','12 / 34','1234','{\"16\":{\"cost\":503.78999999999996,\"qty\":21},\"19\":{\"cost\":360,\"qty\":3},\"17\":{\"cost\":2627.3999999999996,\"qty\":58}}',1,3491.19),(5,'4242 4242 4242 4242','123','12 / 34','123123','{\"16\":{\"cost\":575.76,\"qty\":24},\"19\":{\"cost\":360,\"qty\":3},\"17\":{\"cost\":2627.3999999999996,\"qty\":58}}',2,3563.16),(5,'4242 4242 4242 4242','123','12 / 34','1234','{\"16\":{\"cost\":575.76,\"qty\":24},\"19\":{\"cost\":360,\"qty\":3},\"17\":{\"cost\":2718,\"qty\":60}}',3,3653.76),(5,'4242 4242 4','123','12 / 34','2','{\"16\":{\"cost\":575.76,\"qty\":24},\"19\":{\"cost\":360,\"qty\":3},\"17\":{\"cost\":2718,\"qty\":60}}',4,3653.76),(5,'4242 4242 4','123','12 / 34','2','{\"16\":{\"cost\":575.76,\"qty\":24},\"19\":{\"cost\":360,\"qty\":3},\"17\":{\"cost\":2718,\"qty\":60}}',5,3653.76),(5,'4242 4242 4','123','12 / 34','2','{\"16\":{\"cost\":575.76,\"qty\":24},\"19\":{\"cost\":360,\"qty\":3},\"17\":{\"cost\":2718,\"qty\":60}}',6,3653.76),(5,'4242 4242 4242 4242','123','12 / 34','12341234','{\"17\":{\"cost\":135.89999999999998,\"qty\":3}}',7,135.9);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `productName` varchar(512) NOT NULL,
  `productDesc` text NOT NULL,
  `cost` float NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL,
  `belongsTo` int(255) NOT NULL,
  `imgPath` text NOT NULL,
  `productCategory` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `belongsTo` (`belongsTo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (15,'Blue Bag','Super awesome bag',36.3,'2018-09-06 08:47:36','draft',5,'/uploads/ADqBNb8Gymrv3R9OS.jpg','Bag'),(16,'Blue Bag','Super awesome bag',23.99,'2018-09-06 08:47:39','draft',5,'/uploads/ylHVSOchepCr5PF6B.jpg','Bag'),(17,'Blue Bag','Super awesome bag',45.3,'2018-09-06 08:48:40','draft',5,'/uploads/0H2wY1lys6jPb93hi.jpg','Bag'),(18,'Nike Flex','Awesome shoes',69.99,'2018-09-06 08:49:32','draft',5,'/uploads/QKTExDXuAGkj429md.jpeg','Shoes'),(19,'Basket Ball Shoes','Pair of NIKE basketball shoes',120,'2018-09-06 09:58:49','draft',5,'/uploads/y9L2lvNdfuGWseTxA.jpg','Shoes'),(20,'Bagpipes','Musical Instrument',34.99,'2018-09-06 10:02:03','draft',5,'/uploads/9Qkutrbwesa57p8VT.jpg','Music Instrument');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `accountType` varchar(256) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'kongyujian94@gmail.com','123123','merchant','2018-09-03 08:08:31'),(4,'kongyujian@gmail.com','123123','merchant','2018-09-03 08:10:13'),(5,'1@gmail.com','123123','merchant','2018-09-03 08:19:00'),(6,'2@gmail.com','123123','merchant','2018-09-03 08:21:07'),(7,'3@gmail.com','123123','merchant','2018-09-03 08:22:47'),(8,'4@gmail.com','123123','merchant','2018-09-03 08:24:26'),(9,'5@gmail.com','123123','merchant','2018-09-03 08:26:30'),(10,'6@gmail.com','123123','merchant','2018-09-03 08:26:50'),(11,'7@gmail.com','123123','merchant','2018-09-03 08:27:06'),(12,'8@gmail.com','123123','merchant','2018-09-03 08:27:21'),(13,'13@gmail.com','123123','merchant','2018-09-03 08:49:27');
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

-- Dump completed on 2019-03-06 13:22:56
