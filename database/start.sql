-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.6.5-MariaDB-1:10.6.5+maria~focal - mariadb.org binary distribution
-- OS do Servidor:               debian-linux-gnu
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura do banco de dados para painel
CREATE DATABASE IF NOT EXISTS `painel` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `painel`;

-- Copiando estrutura para tabela painel.sessoes
CREATE TABLE IF NOT EXISTS `sessoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(95) DEFAULT NULL,
  `description` varchar(195) DEFAULT NULL,
  `sessionkey` varchar(195) DEFAULT NULL,
  `server` varchar(95) DEFAULT NULL,
  `apitoken` varchar(195) DEFAULT NULL,
  `session` varchar(95) DEFAULT NULL,
  `status` varchar(95) DEFAULT NULL,
  `wh_status` varchar(195) DEFAULT NULL,
  `wh_message` varchar(195) DEFAULT NULL,
  `wh_qrcode` varchar(195) DEFAULT NULL,
  `wh_connect` varchar(195) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
