-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Jun-2018 às 17:19
-- Versão do servidor: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_escoladedanca`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_days_save` (`piddays` INT, `piduser` INT(11), `pidstatus` INT(11), `pidaddress` INT(11))  BEGIN


IF piddays > 0 THEN

UPDATE tb_days
SET
iduser = piduser,
idstatus = pidstatus,
idaddress = pidaddress

WHERE iddays = piddays;

ELSE

INSERT INTO tb_dayss (iduser, idstatus, idaddress)
VALUES(piduser, pidstatus, pidaddress);

SET piddays = LAST_INSERT_ID();

END IF;

SELECT * 
FROM tb_days a
INNER JOIN tb_daysstatus b USING(idstatus)
INNER JOIN tb_users c ON c.iduser = a.iduser
INNER JOIN tb_addresses d USING(idaddress)
WHERE iddays = piddays;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eventos_delete` (`pidevento` INT)  BEGIN 
DELETE FROM tb_eventos WHERE idevento = pidevento;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eventos_save` (`pidevento` INT(11), `ptituloevento` TEXT, `pdesurl` VARCHAR(128), `pdescevento` TEXT)  BEGIN

IF pidevento > 0 THEN

UPDATE tb_eventos
SET 
tituloevento = ptituloevento,
desurl = pdesurl,
descevento = pdescevento

WHERE idevento = pidevento;

ELSE

INSERT INTO tb_eventos (tituloevento, desurl, descevento) 
VALUES(ptituloevento, pdesurl, pdescevento);

SET pidevento = LAST_INSERT_ID();

END IF;

SELECT * FROM tb_eventos WHERE idevento = pidevento;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_horarios_delete` (IN `pidhorario` INT)  BEGIN 
DELETE FROM tb_horarios WHERE idhorario = pidhorario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_horarios_save` (IN `pidhorario` INT(11), IN `pdessemana` VARCHAR(220), IN `pdesprofessor` VARCHAR(220), IN `pdesritmo` VARCHAR(220), IN `pdesnivel` VARCHAR(220), IN `pdeshorario` VARCHAR(220), IN `pdeschorario` TEXT, IN `pdestitulohorario` TEXT)  BEGIN

IF pidhorario > 0 THEN

UPDATE tb_horarios
SET 
dessemana = pdessemana,
desprofessor = pdesprofessor,
desritmo = pdesritmo,
desnivel = pdesnivel,
deshorario = pdeshorario,
deschorario = pdeschorario,
destitulohorario = pdestitulohorario

WHERE idhorario = pidhorario;

ELSE

INSERT INTO tb_horarios (dessemana, desprofessor, desritmo, desnivel, deshorario, deschorario, destitulohorario) 
VALUES(pdessemana, pdesprofessor, pdesritmo, pdesnivel, pdeshorario, pdeschorario, pdestitulohorario);

SET pidhorario = LAST_INSERT_ID();

END IF;

SELECT * FROM tb_horarios WHERE idhorario = pidhorario;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_userspasswordsrecoveries_create` (`piduser` INT, `pdesip` VARCHAR(45))  BEGIN

INSERT INTO tb_userspasswordsrecoveries (iduser, desip)
VALUES(piduser, pdesip);

SELECT * FROM tb_userspasswordsrecoveries
WHERE idrecovery = LAST_INSERT_ID();

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usersupdate_save` (`piduser` INT, `pdesaluno` VARCHAR(64), `pdeslogin` VARCHAR(64), `pdespassword` VARCHAR(256), `pdesemail` VARCHAR(128), `pnrphone` BIGINT, `pinadmin` TINYINT)  BEGIN

DECLARE vidaluno INT;

SELECT idaluno INTO vidaluno
FROM tb_users
WHERE iduser = piduser;

UPDATE tb_alunos
SET 
desaluno = pdesaluno,
desemail = pdesemail,
nrphone = pnrphone
WHERE idaluno = vidaluno;

UPDATE tb_users
SET
deslogin = pdeslogin,
despassword = pdespassword,
inadmin = pinadmin
WHERE iduser = piduser;

SELECT * FROM tb_users a INNER JOIN tb_alunos b USING(idaluno) WHERE a.iduser = piduser;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_delete` (`piduser` INT)  BEGIN

DECLARE vidaluno INT;

SELECT idaluno INTO vidaluno
FROM tb_users
WHERE iduser = piduser;

DELETE FROM tb_users WHERE iduser = piduser;
DELETE FROM tb_alunos WHERE idaluno = vidaluno;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_save` (IN `pdesaluno` VARCHAR(64), IN `pdeslogin` VARCHAR(64), IN `pdespassword` VARCHAR(256), IN `pdesemail` VARCHAR(128), IN `pnrphone` BIGINT, IN `pinadmin` TINYINT)  BEGIN

DECLARE vidaluno INT;

INSERT INTO tb_alunos (desaluno, desemail, nrphone)
VALUES(pdesaluno, pdesemail, pnrphone);

SET vidaluno = LAST_INSERT_ID();

INSERT INTO tb_users (idaluno, deslogin, despassword, inadmin)
VALUES(vidaluno, pdeslogin, pdespassword, pinadmin);

SELECT * FROM tb_users a INNER JOIN tb_alunos b USING(idaluno) WHERE a.iduser = LAST_INSERT_ID();

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_videos_delete` (`pidhorario` INT)  BEGIN 
DELETE FROM tb_videos WHERE idvideo = pidvideo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_videos_save` (IN `pidvideo` INT(11), IN `purlvideo` VARCHAR(220), IN `ptitulovideo` TEXT, IN `pdescvideo` TEXT)  BEGIN

IF pidvideo > 0 THEN

UPDATE tb_videos
SET 
urlvideo = purlvideo,
titulovideo = ptitulovideo,
descvideo = pdescvideo

WHERE idvideo = pidvideo;

ELSE

INSERT INTO tb_videos (urlvideo, titulovideo, descvideo) 
VALUES(purlvideo, ptitulovideo, pdescvideo);

SET pidvideo = LAST_INSERT_ID();

END IF;

SELECT * FROM tb_videos WHERE idvideo = pidvideo;

END$$

DELIMITER ;



----------------------------------------------------------

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eventos_save`(
  pidequipe INT(11), 
  purlequipe VARCHAR(220), 
  ptituloequipe TEXT, 
  pdescequipe TEXT,
  purlfacebook TEXT,
  purlyoutube TEXT,
  purlinstagram TEXT,
  purlwhatsapp TEXT 
)
BEGIN

IF pidequipe > 0 THEN

UPDATE tb_equipe
SET
tituloequipe = ptituloequipe, 
urlequipe = purlequipe,
descequipe = pdescequipe,
urlfacebook = purlfacebook,
urlyoutube = purlyoutube,
urlinstagram = purlinstagram,
urlwhatsapp = purlwhatsapp

WHERE idequipe = pidequipe;

ELSE

INSERT INTO tb_eventos (urlequipe, tituloequipe, descequipe, urlfacebook, urlyoutube, urlinstagram, urlwhatsapp) 
VALUES(purlequipe, ptituloequipe, pdescequipe, purlfacebook, purlyoutube, purlinstagram, purlwhatsapp);

SET pidequipe = LAST_INSERT_ID();

END IF;

SELECT * FROM tb_equipe WHERE idequipe = pidequipe;

END


DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_equipes_delete` (`pidequipe` INT)  BEGIN 
DELETE FROM tb_equipes WHERE idequipe = pidequipe;
END$$



DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ritmos_delete` (`pidritmo` INT)  BEGIN 
DELETE FROM tb_ritmos WHERE idritmo = pidritmo;
END$$

DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ritmos_save`(
  pidritmo INT(11), 
  ptituloritmo TEXT,
  pdescritmo TEXT,
  pdesurlritmo VARCHAR(220)
)
BEGIN

IF pidritmo > 0 THEN

UPDATE tb_ritmos
SET
tituloritmo = ptituloritmo, 
descritmo = pdescritmo,
desurlritmo = pdesurlritmo

WHERE idritmo = pidritmo;

ELSE

INSERT INTO tb_ritmos (tituloritmo, descritmo, desurlritmo) 
VALUES(ptituloritmo, pdescritmo, pdesurlritmo);

SET pidritmo = LAST_INSERT_ID();

END IF;

SELECT * FROM tb_ritmos WHERE idritmo = pidritmo;

END





-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_addresses`
--

CREATE TABLE `tb_addresses` (
  `idaddress` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `desaddress` varchar(128) NOT NULL,
  `desnumber` varchar(16) NOT NULL,
  `descomplement` varchar(32) DEFAULT NULL,
  `descity` varchar(32) NOT NULL,
  `desstate` varchar(32) NOT NULL,
  `descountry` varchar(32) NOT NULL,
  `deszipcode` char(8) NOT NULL,
  `desdistrict` varchar(32) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_alunos`
--

CREATE TABLE `tb_alunos` (
  `idaluno` int(11) NOT NULL,
  `desaluno` varchar(64) NOT NULL,
  `desemail` varchar(128) DEFAULT NULL,
  `nrphone` bigint(20) DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_alunos`
--

INSERT INTO `tb_alunos` (`idaluno`, `desaluno`, `desemail`, `nrphone`, `dtregister`) VALUES
(1, 'Administrador', 'jaimearoxaniteroifilial@gmail.com', 2127048558, '0000-00-00 00:00:00'),
(5, 'Oziel C. Ferreira', 'ozielleste@gmail.com', 21999999999, '2018-06-21 06:06:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_banners`
--

CREATE TABLE `tb_banners` (
  `idbanner` int(11) NOT NULL,
  `titulobanner` varchar(220) NOT NULL,
  `desurlbanner` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_contatos`
--

CREATE TABLE `tb_contatos` (
  `idcontato` int(20) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  `telefone` varchar(220) NOT NULL,
  `ritmos` varchar(220) NOT NULL,
  `assunto` varchar(220) NOT NULL,
  `mensagem` varchar(220) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_days`
--

CREATE TABLE `tb_days` (
  `iddays` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idstatus` int(11) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_daysstatus`
--

CREATE TABLE `tb_daysstatus` (
  `idstatus` int(11) NOT NULL,
  `desstatus` varchar(32) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_daysstatus`
--

INSERT INTO `tb_daysstatus` (`idstatus`, `desstatus`, `dtregister`) VALUES
(1, 'SEGUNDA-FEIRA', '2017-03-13 06:00:00'),
(2, 'TERÇA-FEIRA', '2017-03-13 06:00:00'),
(3, 'QUARTA-FEIRA', '2017-03-13 06:00:00'),
(4, 'QUINTA-FEIRA', '2017-03-13 06:00:00'),
(5, 'SEXTA-FEIRA', '2017-03-13 06:00:00'),
(6, 'SÁBADO', '2017-03-13 06:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_equipe`
--

CREATE TABLE `tb_equipe` (
  `idequipe` int(11) NOT NULL,
  `tituloequipe` varchar(220) NOT NULL,
  `desurlequipe` varchar(128) NOT NULL,
  `descequipe` text NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_escola`
--

CREATE TABLE `tb_escola` (
  `idescola` int(11) NOT NULL,
  `tituloEscola` text NOT NULL,
  `desurlescola` varchar(128) NOT NULL,
  `descescola` text NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_eventos`
--

CREATE TABLE `tb_eventos` (
  `idevento` int(11) NOT NULL,
  `tituloevento` text NOT NULL,
  `desurl` varchar(128) NOT NULL,
  `descevento` text NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_eventos`
--

INSERT INTO `tb_eventos` (`idevento`, `tituloevento`, `desurl`, `descevento`, `dtregister`) VALUES
(2, 'BAILE MENSAL', 'baile-mensal-escola-jaime-aroxa-niteroi', 'Acontece no segundo sábado de cada mês!', '2018-06-25 07:57:32');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_horarios`
--

CREATE TABLE `tb_horarios` (
  `idhorario` int(11) NOT NULL,
  `dessemana` varchar(128) NOT NULL,
  `desprofessor` varchar(128) NOT NULL,
  `desritmo` varchar(128) NOT NULL,
  `desnivel` varchar(128) NOT NULL,
  `deshorario` varchar(220) NOT NULL,
  `deschorario` text NOT NULL,
  `destitulohorario` text,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_horarios`
--

INSERT INTO `tb_horarios` (`idhorario`, `dessemana`, `desprofessor`, `desritmo`, `desnivel`, `deshorario`, `deschorario`, `destitulohorario`, `dtregister`) VALUES
(3, 'Terça-feira', 'Oziel Ferreira', 'Dança de Salão', 'Intermediária', '19:00 as 20:30', 'Turmas de segunda a sábado!', 'HORÁRIOS', '2018-06-21 06:29:09'),
(4, 'Segunda-Feira', 'Estephano', 'Ritmos Quentes', 'Avançada', '19:00 as 20:30', 'Turmas de segunda a sábado!', 'HORÁRIOS', '2018-06-21 06:30:31'),
(5, 'Sexta-Feira', 'Carlinhos de Niterói | Thais e Giulia', 'Tango', 'Iniciante', '19:00 as 20:00', 'Turmas de segunda a sábado!', 'HORÁRIOS', '2018-06-21 06:31:28'),
(6, 'Quarta', 'Carlinhos de Niterói', 'Ritmos Quentes', 'Intermediária', '19:00 as 20:30', 'Turmas de segunda a sábado!', 'HORÁRIOS', '2018-06-22 19:11:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_ritmos`
--

CREATE TABLE `tb_ritmos` (
  `idritmo` int(11) NOT NULL,
  `tituloritmo` varchar(220) NOT NULL,
  `desurlritmo` varchar(128) NOT NULL,
  `descritmo` text NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_users`
--

CREATE TABLE `tb_users` (
  `iduser` int(11) NOT NULL,
  `idaluno` int(11) NOT NULL,
  `deslogin` varchar(64) NOT NULL,
  `despassword` varchar(256) NOT NULL,
  `inadmin` tinyint(4) NOT NULL DEFAULT '0',
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_users`
--

INSERT INTO `tb_users` (`iduser`, `idaluno`, `deslogin`, `despassword`, `inadmin`, `dtregister`) VALUES
(1, 1, 'admin', '$2y$12$K//3jS6gFYzwDViewONa.uBWmbrxES.3Kl/nTqWUlcazV6Xiej1SK', 1, '0000-00-00 00:00:00'),
(5, 5, 'oziel', '$2y$12$uZKuBXXofUjQkGnpimKKZeVajd.C2MhRFmYJTNcJnIUKY2tzFG3Pi', 1, '2018-06-21 06:06:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_userslogs`
--

CREATE TABLE `tb_userslogs` (
  `idlog` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `deslog` varchar(128) NOT NULL,
  `desip` varchar(45) NOT NULL,
  `desuseragent` varchar(128) NOT NULL,
  `dessessionid` varchar(64) NOT NULL,
  `desurl` varchar(128) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_userspasswordsrecoveries`
--

CREATE TABLE `tb_userspasswordsrecoveries` (
  `idrecovery` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `desip` varchar(45) NOT NULL,
  `dtrecovery` datetime DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_userspasswordsrecoveries`
--

INSERT INTO `tb_userspasswordsrecoveries` (`idrecovery`, `iduser`, `desip`, `dtrecovery`, `dtregister`) VALUES
(0, 4, '127.0.0.1', '2018-06-21 02:26:06', '2018-06-21 05:25:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_videos`
--

CREATE TABLE `tb_videos` (
  `idvideo` int(11) NOT NULL,
  `urlvideo` varchar(220) NOT NULL,
  `titulovideo` text NOT NULL,
  `descvideo` text NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_videos`
--

INSERT INTO `tb_videos` (`idvideo`, `urlvideo`, `titulovideo`, `descvideo`, `dtregister`) VALUES
(2, 'https://www.youtube.com/watch?v=kcgQjuxxSgw', 'Baile Aniversário da Escola', 'Carlinhos de Niterói e Bárbara Ribeiro.', '2018-06-24 05:08:39'),
(3, 'https://www.youtube.com/watch?v=ijhJEPY63FY', 'Flash Mob', 'Baile do Carlinhos de Niterói e Jaime Arôxa.', '2018-06-24 18:23:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_addresses`
--
ALTER TABLE `tb_addresses`
ADD PRIMARY KEY (`idaddress`),
ADD KEY `fk_addresses_alunos_idx` (`idaluno`);

--
-- Indexes for table `tb_alunos`
--
ALTER TABLE `tb_alunos`
ADD PRIMARY KEY (`idaluno`);

--
-- Indexes for table `tb_banners`
--
ALTER TABLE `tb_banners`
ADD PRIMARY KEY (`idbanner`);

--
-- Indexes for table `tb_days`
--
ALTER TABLE `tb_days`
ADD PRIMARY KEY (`iddays`),
ADD KEY `fk_days_users_idx` (`iduser`),
ADD KEY `fk_days_daysstatus_idx` (`idstatus`);

--
-- Indexes for table `tb_daysstatus`
--
ALTER TABLE `tb_daysstatus`
ADD PRIMARY KEY (`idstatus`);

--
-- Indexes for table `tb_eventos`
--
ALTER TABLE `tb_eventos`
ADD PRIMARY KEY (`idevento`);

--
-- Indexes for table `tb_horarios`
--
ALTER TABLE `tb_horarios`
ADD PRIMARY KEY (`idhorario`);

--
-- Indexes for table `tb_ritmos`
--
ALTER TABLE `tb_ritmos`
ADD PRIMARY KEY (`idritmo`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
ADD PRIMARY KEY (`iduser`),
ADD KEY `FK_users_alunos_idx` (`idaluno`);

--
-- Indexes for table `tb_videos`
--
ALTER TABLE `tb_videos`
ADD PRIMARY KEY (`idvideo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_addresses`
--
ALTER TABLE `tb_addresses`
MODIFY `idaddress` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_alunos`
--
ALTER TABLE `tb_alunos`
MODIFY `idaluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_days`
--
ALTER TABLE `tb_days`
MODIFY `iddays` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_daysstatus`
--
ALTER TABLE `tb_daysstatus`
MODIFY `idstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_eventos`
--
ALTER TABLE `tb_eventos`
MODIFY `idevento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_horarios`
--
ALTER TABLE `tb_horarios`
MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_videos`
--
ALTER TABLE `tb_videos`
MODIFY `idvideo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_addresses`
--
ALTER TABLE `tb_addresses`
ADD CONSTRAINT `fk_addresses_alunos` FOREIGN KEY (`idaluno`) REFERENCES `tb_alunos` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_days`
--
ALTER TABLE `tb_days`
ADD CONSTRAINT `fk_days_daysstatus` FOREIGN KEY (`idstatus`) REFERENCES `tb_daysstatus` (`idstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_days_users` FOREIGN KEY (`iduser`) REFERENCES `tb_users` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_users`
--
ALTER TABLE `tb_users`
ADD CONSTRAINT `fk_users_alunos` FOREIGN KEY (`idaluno`) REFERENCES `tb_alunos` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
