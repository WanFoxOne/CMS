-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 01 fév. 2018 à 09:08
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `i2m`
--

-- --------------------------------------------------------

--
-- Structure de la table `content_text`
--

DROP TABLE IF EXISTS `content_text`;
CREATE TABLE IF NOT EXISTS `content_text` (
  `content_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `locale` enum('fr','en') NOT NULL DEFAULT 'fr',
  `text` text,
  PRIMARY KEY (`content_id`,`locale`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `content_text`
--

INSERT INTO `content_text` (`content_id`, `locale`, `text`) VALUES
(1, 'fr', '<p>Les informations, les techniques et les logiciels (\"CONTENU\")\r\nfournis par ce site ont un but purement éducatif\r\net ne doivent pas être interprétés comme un engagement par leur auteur (\"AUTEUR\").</p>\r\n<p>Le CONTENU est fourni \"EN L\'ÉTAT\" sans garantie d\'aucune sorte, expresse ou implicite,\r\ny compris, mais sans limitation, les garanties de qualité marchande,\r\nd\'adéquation à un usage particulier et de non-violation des droits de tierces parties.\r\nL\'AUTEUR ne saurait en aucun cas être tenu responsable de toute réclamation\r\nou dommage indirect ou consécutif ou de tout autre dommage\r\nlié à la perte d\'utilisation, de données ou de bénéfices,\r\nque ce soit dans le cadre d\'un contrat, d\'une négligence ou d\'une autre action préjudiciable,\r\ndus ou liés à l\'utilisation ou aux performances du CONTENU.</p>'),
(1, 'en', '<p>The information, the techniques and the software (\"CONTENT\")\r\nprovided by this web site are for educational purposes only\r\nand should not be construed as a commitment by their author (\"AUTHOR\").</p>\r\n<p>The CONTENT is provided \"AS IS\", without warranty of any kind, express or implied,\r\nincluding but not limited to the warranties of merchantability,\r\nfitness for a particular purpose and noninfringment of third party rights.\r\nIn no event shall the AUTHOR be liable for any claim,\r\nor any special indirect or consequential damages,\r\nor any damages whatsoever resulting from loss of use, data or profits,\r\nwhether in an action of contract, negligence or other tortious action,\r\narising out of or in connection with the use or performance of the CONTENT.</p>'),
(2, 'fr', '<p><i>13 mai 2010</i></p>\r\n<p><b>frasq.org</b></p>'),
(2, 'en', '<p><i>May 13th, 2010</i></p>\r\n<p><b>frasq.org</b></p>');

-- --------------------------------------------------------

--
-- Structure de la table `credits`
--

DROP TABLE IF EXISTS `credits`;
CREATE TABLE IF NOT EXISTS `credits` (
  `user_id` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `credits`
--

INSERT INTO `credits` (`user_id`, `credit`) VALUES
(1, 990);

-- --------------------------------------------------------

--
-- Structure de la table `node`
--

DROP TABLE IF EXISTS `node`;
CREATE TABLE IF NOT EXISTS `node` (
  `node_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`node_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `node`
--

INSERT INTO `node` (`node_id`, `user_id`, `created`, `modified`) VALUES
(1, 1, '2011-02-28 08:48:57', '2011-02-28 08:48:57');

-- --------------------------------------------------------

--
-- Structure de la table `node_content`
--

DROP TABLE IF EXISTS `node_content`;
CREATE TABLE IF NOT EXISTS `node_content` (
  `node_id` int(10) UNSIGNED NOT NULL,
  `content_id` int(10) UNSIGNED NOT NULL,
  `content_type` enum('text') CHARACTER SET ascii NOT NULL DEFAULT 'text',
  `number` int(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`node_id`,`content_id`,`content_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `node_content`
--

INSERT INTO `node_content` (`node_id`, `content_id`, `content_type`, `number`) VALUES
(1, 1, 'text', 1),
(1, 2, 'text', 2);

-- --------------------------------------------------------

--
-- Structure de la table `node_locale`
--

DROP TABLE IF EXISTS `node_locale`;
CREATE TABLE IF NOT EXISTS `node_locale` (
  `node_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `locale` enum('fr','en') NOT NULL DEFAULT 'fr',
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `abstract` text,
  `cloud` text,
  PRIMARY KEY (`node_id`,`locale`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `node_locale`
--

INSERT INTO `node_locale` (`node_id`, `locale`, `name`, `title`, `abstract`, `cloud`) VALUES
(1, 'fr', 'informations-legales', 'Informations légales', 'Responsabilité de l\'auteur - Droits.', 'copyright responsabilité auteur droits diffusion'),
(1, 'en', 'legal-information', 'Legal information', 'Author\'s liability - Rights.', 'copyright liability author rights distribution');

-- --------------------------------------------------------

--
-- Structure de la table `registry`
--

DROP TABLE IF EXISTS `registry`;
CREATE TABLE IF NOT EXISTS `registry` (
  `name` varchar(100) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`role_id`, `name`) VALUES
(1, 'administrator'),
(2, 'writer'),
(3, 'reader'),
(4, 'moderator');

-- --------------------------------------------------------

--
-- Structure de la table `track`
--

DROP TABLE IF EXISTS `track`;
CREATE TABLE IF NOT EXISTS `track` (
  `track_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(15) NOT NULL,
  `request_uri` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`track_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `password` varchar(32) NOT NULL,
  `newpassword` varchar(32) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locale` enum('fr','en') NOT NULL DEFAULT 'fr',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `name`, `password`, `newpassword`, `mail`, `created`, `access`, `locale`, `active`, `banned`) VALUES
(1, 'foobar', 'e870de331d86ce7704620678e311dd1d', NULL, 'foobar@localnet.net', '2010-05-13 00:00:00', '2018-02-01 09:24:45', 'fr', 1, 0),
(2, 'barfoo', 'e4568fdee4c806000457ff36ae5f25ee', NULL, 'barfoo@localnet.net', '2010-05-13 00:00:00', '2011-01-29 12:19:04', 'en', 1, 0),
(4, 'i2m', '62e55637971a5c2b849b0b22581fb94c', NULL, 'wanfoxone@gmail.com', '2017-11-14 08:55:01', '0000-00-00 00:00:00', 'fr', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `role_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 1),
(1, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
