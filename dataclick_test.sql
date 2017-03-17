/* SQL Manager Lite for MySQL                              5.6.3.48526 */
/* ------------------------------------------------------------------- */
/* Host     : localhost                                                */
/* Port     : 3306                                                     */
/* Database : dataclick_test                                           */


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'utf8' */;

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `dataclick_test`
    CHARACTER SET 'utf8'
    COLLATE 'utf8_general_ci';

USE `dataclick_test`;

/* Structure for the `clube` table : */

CREATE TABLE `clube` (
  `ID` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`ID`)
) ENGINE=InnoDB
AUTO_INCREMENT=28 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `socio` table : */

CREATE TABLE `socio` (
  `ID` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(200) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`ID`)
) ENGINE=InnoDB
AUTO_INCREMENT=5 ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `clube_socio` table : */

CREATE TABLE `clube_socio` (
  `id_clube` INTEGER(11) NOT NULL,
  `id_socio` INTEGER(11) DEFAULT NULL,
  KEY `id_clube` USING BTREE (`id_clube`),
  KEY `id_socio` USING BTREE (`id_socio`),
  CONSTRAINT `clube_socio_fk1` FOREIGN KEY (`id_clube`) REFERENCES `clube` (`ID`),
  CONSTRAINT `clube_socio_fk2` FOREIGN KEY (`id_socio`) REFERENCES `socio` (`ID`)
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Data for the `clube` table  (LIMIT 0,500) */

INSERT INTO `clube` (`ID`, `NOME`) VALUES
  (1,'Palmeiras'),
  (13,'Brusque'),
  (16,'Lanus'),
  (21,'Camboriu'),
  (25,'Bayer'),
  (26,'Roma'),
  (27,'Marcilio Dias');
COMMIT;

/* Data for the `socio` table  (LIMIT 0,500) */

INSERT INTO `socio` (`ID`, `NOME`) VALUES
  (3,'Paulo'),
  (4,'Claudio');
COMMIT;

/* Data for the `clube_socio` table  (LIMIT 0,500) */

INSERT INTO `clube_socio` (`id_clube`, `id_socio`) VALUES
  (25,3),
  (13,3),
  (16,3),
  (26,3),
  (27,4),
  (1,4),
  (26,4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;