/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.4.3-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: shop
-- ------------------------------------------------------
-- Server version	11.4.3-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `Producttb`
--

DROP TABLE IF EXISTS `Producttb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Producttb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_description` text DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `date_of_publication` date DEFAULT NULL,
  `is_best_seller` tinyint(1) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `check_one_category` CHECK (`is_best_seller` = 1 and `is_featured` = 0 or `is_best_seller` = 0 and `is_featured` = 1 or `is_best_seller` = 0 and `is_featured` = 0)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Producttb`
--

LOCK TABLES `Producttb` WRITE;
/*!40000 ALTER TABLE `Producttb` DISABLE KEYS */;
INSERT INTO `Producttb` VALUES
(99,'Google Cloud Associate Cloud Engineer Certification and Implementation Guide',2500.00,'./images/books/61KmAKy5dvL._SL1360_.jpg','Google Cloud Platform (GCP) is a leading cloud provider, helping companies and users worldwide to solve the most challenging business issues. This book will teach cloud engineers working with GCP how to implement, configure, and secure cloud environments, and help students gain confidence in utilizing various GCP services.',26,'Doosan','2023-01-01',0,0),
(100,'The Self-Taught Cloud Computing Engineer',3700.00,'./images/books/61dpzZMWb9L._SL1360_.jpg','This book is an all-inclusive guide for IT professionals to master cloud computing concepts by building a broad and deep cloud knowledge base, developing hands-on cloud skills, and achieving professional cloud certifications.',50,'DOosan','2023-01-01',0,0),
(101,'Cloud Solution Architect\'s Career Master Plan',2500.00,'./images/books/71LEzyJ2MjL._SL1500_.jpg','The Solution Architect\'s Career Masterplan isn\'t just informative; it\'s an actionable roadmap to thriving in this role, providing the knowledge and strategies necessary to build a successful career in cloud computing.',80,'Doosan','2022-06-15',0,0),
(102,'Cloud Computing Demystified for Aspiring Professionals',4500.00,'./images/books/81k87CWzTrL._SL1500_.jpg','Cloud Computing Demystified for Aspiring Professionals helps you to master cloud computing essentials and important technologies offered by cloud service providers needed to succeed in a cloud-centric job role.',120,'Doosan','2023-02-01',0,0),
(103,'Journey to Become a Google Cloud Machine Learning Engineer',3000.00,'./images/books/71zZlpKAgUL._SL1500_.jpg','This book provides a study guide to learn and master machine learning in Google Cloud, enabling you to build a broad and strong knowledge base, train hands-on skills, and get certified as a Google Cloud Machine Learning Engineer.',90,'Unknown Author','2023-03-01',0,0),
(104,'Google Cloud for DevOps Engineers',1700.00,'./images/books/61y14cAq-SS._SL1360_.jpg','Explore the evolution of DevOps and SRE, before delving into SRE technical practices such as SLA, SLO, SLI, and error budgets that are critical to building reliable software faster.',60,'Unknown Author','2023-01-10',0,0),
(105,'Efficient Cloud FinOps',3500.00,'./images/books/71cvNGqkYhL._SL1500_.jpg','This book serves as your comprehensive guide to understanding how FinOps is implemented in organizations worldwide through team collaboration and proper cloud governance.',85,'Unknown Author','2023-05-01',0,0),
(106,'Terraform for Google Cloud Essential Guide',1500.00,'./images/books/61nYS8xdASL._SL1360_.jpg','Google Cloud has adopted Terraform as the standard Infrastructure as Code tool. This necessitates a solid understanding of Terraform for any cloud architect or engineer working on Google Cloud.',75,'Unknown Author','2022-11-01',0,0),
(107,'Generative AI for Cloud Solutions',7800.00,'./images/books/61etgGVEh7L._SL1360_.jpg','Explore Generative AI, the engine behind ChatGPT, and delve into topics like LLM-infused frameworks, autonomous agents, and responsible innovation, to gain valuable insights into the future of AI',20,'Unknown Author','2022-11-04',1,0),
(108,'Developing Blockchain Solutions in the Cloud',8900.00,'./images/books/61jwJanHxyL._SL1360_.jpg','Learn how to implement, deploy, and manage blockchain solutions across AWS, Azure, and GCP with the help of hands-on labs and real-world use cases',15,'Unknown Author','2022-11-02',1,0),
(109,'Salesforce Sales Cloud - An Implementation Handbook',3800.00,'./images/books/61iVWnkGtwL._SL1360_.jpg','A practical guide from design to deployment for driving success in sales. Design and build Sales Cloud solutions to solve business challenges with this easy-to-follow handbook',18,'Unknown Author','2022-11-03',1,0),
(110,'Solutions Architect\'s Handbook ',3700.00,'./images/profile-pic-6.png','Starting with a focus on the Amazon cloud, you\'ll be introduced to fundamental AWS cloud services, followed by advanced AWS cloud services in the domains of data, machine learning, and security. Next, you\'ll build proficiency in Microsoft Azure cloud and Google Cloud Platform (GCP) by examining the common attributes of the three clouds, differentiating their unique features, along with leveraging real-life cloud project implementations on these cloud platforms. Finally, you\'ll get guidance on cloud certifications and career development',3,'Unknown Author','2024-11-03',0,1),
(111,'AWS for Solutions Architects',2850.00,'./images/profile-pic-5.png','In the rapidly evolving landscape of technology, I recognize the importance of staying ahead of the curve. That\'s why I\'m committed to continuous learning and applying the latest tools and practices in the field. Whether it\'s through automating deployment pipelines, ensuring high availability of services, or securing infrastructure, my goal is to enable teams to deliver high-quality software quickly and reliably.',36,'Dr. Luan','2024-10-06',0,1),
(112,'The Self-Taught Cloud Computing Engineer V2',4800.00,'./images/profile-pic-3.png','I take pride in my ability to break down complex technical challenges into manageable solutions, fostering collaboration and innovation. With a keen eye for detail and a proactive mindset, I am always on the lookout for potential improvements that can lead to significant gains in performance and user satisfaction.',19,'Unknown Author','2024-07-18',0,1),
(114,' The Ultimate Kali Linux Book',3501.00,'./images/books/813SAQWm7pL._SL1500_.jpg','Embark on an exciting journey into the world of Kali Linux - the central hub for advanced penetration testing. Honing your pentesting skills and exploiting vulnerabilities or conducting advanced penetration tests on wired and wireless enterprise networks, Kali Linux empowers cybersecurity professionals.',18,'Doosan Pagooah','2021-01-05',0,1),
(115,'DevOps Unleashed with Git and GitHub',3800.00,'./images/books/61Alwd2RqsL._SL1360_.jpg','DevOps Unleashed with Git and GitHub enables you to harness the power of Git and GitHub to streamline workflows, drive collaboration, and fuel innovation. Authored by an expert from GitHub, the book starts by guiding you through Git fundamentals and delving into DevOps and the developer experience. ',16,' Yuki Hattori ','2020-04-29',0,0);
/*!40000 ALTER TABLE `Producttb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `role` enum('user','superuser') DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'1','2','hex','hex@gmail.com','55003108','$2y$10$RTeG9d3vzpYLurRVI6eGqeaEPk4qBKZftcUyYF2rjg00ck/NgHDtO','2024-10-04 10:26:07','superuser'),
(2,'Doosan','Pagooah','dec','niks@hotfemale.com','55003108','$2y$10$AXWfqcOUz4ZOBNRAceg1Sep.xBh74wAPKDtlCDuIJJNlyMxgRL4t.','2024-10-04 10:47:35','user'),
(4,'Nivesh','Pagooah','doosan','doosan@pagooah.com','55003108','$2y$10$KQFiS7KUdE79rJJY4O.EBeOL8LD6BnxfgMCcZzOccmm0ZMm6KW.N6','2024-10-04 10:52:38','user'),
(5,'Doosan','Pagooah','mux','hello@gmail.com','55003108','$2y$10$OBdZnnShRxZABHMnwnKrhepZrS.uWdcKXwK8oYZHW3JIDA7Y6ZE6G','2024-10-04 11:09:37','user'),
(6,'Nishan','Pagooah','nishan','nishan@pagooah.com','55003108','$2y$10$7KFNerbQtWA1DjU4Pxmy/uCVvCKHXdYmA1weI.mo5m1JHd1gSxzwO','2024-10-04 11:34:56','user'),
(7,'Doosan','Pagooah','Hex1','doosan1@pagooah.com','55003108','$2y$10$neGOfr3h2fAWwFuqbAdYMO6FskxO.sscIFa.C1yM88JOE3qC4wU2y','2024-10-05 17:10:31','user'),
(8,'Neel','Helios','nishan_1','k@gmail.com','52641211','$2y$10$qunxyJDnm2MDfhjhAYRnx.AXna/TfpchV.5cgqNFG9IPgD/BvJDGq','2024-10-05 23:32:04','user'),
(9,'Neervesh','Gokool','neer','neer@gmail.com','55003108','$2y$10$gcPuHoXOb14.0Aua8FTflepgJC/O/QbAO.5F47K0T82.J/mpvDq7i','2024-10-06 17:28:06','user'),
(11,'Niks','Jug','niks_1','hex_30@gmail.com','55003108','$2y$10$73PO9xnRmgwra1X2AoRoquePoh8HOkz9Qb9VnOf9npJO4RzU.6VIW','2024-10-07 17:28:49','user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2024-10-13 21:04:01
