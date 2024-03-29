-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.19 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных test_base
CREATE DATABASE IF NOT EXISTS `test_base` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `test_base`;

-- Дамп структуры для таблица test_base.cats
CREATE TABLE IF NOT EXISTS `cats` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `family` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `age` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы test_base.cats: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `cats` DISABLE KEYS */;
REPLACE INTO `cats` (`id`, `family`, `name`, `age`) VALUES
	(1, 'Lion', 'Simba', 4),
	(2, 'Lion', 'Simba', 4),
	(3, 'Lions', 'Simbas', 4),
	(4, 'Lions', 'Simbas', 4),
	(5, 'Opposum', 'Phonk', 5),
	(6, 'Opposum', 'Phonk', 5),
	(7, 'Opposum', 'Phonk', 5);
/*!40000 ALTER TABLE `cats` ENABLE KEYS */;

-- Дамп структуры для таблица test_base.classics
CREATE TABLE IF NOT EXISTS `classics` (
  `author` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `category` varchar(16) DEFAULT NULL,
  `year` smallint DEFAULT NULL,
  `isbn` char(13) NOT NULL,
  PRIMARY KEY (`isbn`),
  KEY `author` (`author`(20)),
  KEY `title` (`title`(20)),
  KEY `category` (`category`(4)),
  KEY `year` (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы test_base.classics: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `classics` DISABLE KEYS */;
REPLACE INTO `classics` (`author`, `title`, `category`, `year`, `isbn`) VALUES
	('dfdfgdfg', 'dfgdfgdfg', 'dfgdfg', 1999, '199987743'),
	('Emily B', 'Some title', 'Non fiction', 1877, '3459873495837');
/*!40000 ALTER TABLE `classics` ENABLE KEYS */;

-- Дамп структуры для таблица test_base.owners
CREATE TABLE IF NOT EXISTS `owners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `Second_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы test_base.owners: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `owners` DISABLE KEYS */;
REPLACE INTO `owners` (`id`, `name`, `Second_name`) VALUES
	(6, 'Jack', 'Black'),
	(7, 'Jack', 'Black');
/*!40000 ALTER TABLE `owners` ENABLE KEYS */;

-- Дамп структуры для таблица test_base.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `deleted` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы test_base.users: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `fullname`, `login`, `password`, `deleted`) VALUES
	(1, 'Тимашев Александр Алексеевич', 'admin', 'admin', 0),
	(2, 'Криворогов Антон Степанович', 'start', 'full', 0),
	(3, 'Елисеева Светлана Андреевна', 'elis', 'dron', 0),
	(4, 'dfgdf', 'erger', 'fdgdfg', 0),
	(5, 'fgdfg', 't3weqa', 'fg54', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
