-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Jun-2018 às 08:21
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_equipes_delete` (`pidequipe` INT)  BEGIN 
DELETE FROM tb_equipes WHERE idequipe = pidequipe;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_equipes_save` (IN `pidequipe` INT(11), IN `ptituloequipe` TEXT, IN `pdescequipe` TEXT, IN `purlequipe` VARCHAR(220), IN `purlfacebook` TEXT, IN `purlyoutube` TEXT, IN `purlinstagram` TEXT, IN `purlwhatsapp` TEXT)  BEGIN

IF pidequipe > 0 THEN

UPDATE tb_equipe
SET
tituloequipe = ptituloequipe, 
descequipe = pdescequipe,
urlequipe = purlequipe,
urlfacebook = purlfacebook,
urlyoutube = purlyoutube,
urlinstagram = purlinstagram,
urlwhatsapp = purlwhatsapp

WHERE idequipe = pidequipe;

ELSE

INSERT INTO tb_equipe (tituloequipe, descequipe, urlequipe, urlfacebook, urlyoutube, urlinstagram, urlwhatsapp) 
VALUES(ptituloequipe, pdescequipe, purlequipe, purlfacebook, purlyoutube, purlinstagram, purlwhatsapp);

SET pidequipe = LAST_INSERT_ID();

END IF;

SELECT * FROM tb_equipe WHERE idequipe = pidequipe;

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ritmos_delete` (`pidritmo` INT)  BEGIN 
DELETE FROM tb_ritmos WHERE idritmo = pidritmo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ritmos_save` (`pidritmo` INT(11), `ptituloritmo` TEXT, `pdescritmo` TEXT, `pdesurlritmo` VARCHAR(220))  BEGIN

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


DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_banners_delete` (`pidbanner` INT)  BEGIN 
    DELETE FROM tb_banners WHERE idbanner = pidbanner;
END$$

DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_banners_save` (
  pidbanner INT(11), 
  ptitulobanner TEXT, 
  pdesurlbanner VARCHAR(128)
  )  BEGIN
  
  IF pidbanner > 0 THEN
    
    UPDATE tb_banners
        SET 
            titulobanner = ptitulobanner,
            desurlbanner = pdesurlbanner
            
        WHERE idbanner = pidbanner;
        
    ELSE
    
    INSERT INTO tb_banners (titulobanner, desurlbanner) 
        VALUES(ptitulobanner, pdesurlbanner);
        
        SET pidbanner = LAST_INSERT_ID();
        
    END IF;
    
    SELECT * FROM tb_banners WHERE idbanner = pidbanner;
    
END$$

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
-- Estrutura da tabela `tb_equipe`
--

CREATE TABLE `tb_equipe` (
  `idequipe` int(11) NOT NULL,
  `tituloequipe` varchar(220) NOT NULL,
  `descequipe` text NOT NULL,
  `urlequipe` varchar(220) NOT NULL,
  `urlfacebook` text NOT NULL,
  `urlyoutube` text NOT NULL,
  `urlinstagram` text NOT NULL,
  `urlwhatsapp` text NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_equipe`
--

INSERT INTO `tb_equipe` (`idequipe`, `tituloequipe`, `descequipe`, `urlequipe`, `urlfacebook`, `urlyoutube`, `urlinstagram`, `urlwhatsapp`, `dtregister`) VALUES
(1, 'Professor', 'Oziel Ferreira', 'jaime-aroxa-niteroi-oziel-ferreira-professor-de-danca', 'https://www.facebook.com/oziel.ferreira.14', 'https://www.youtube.com/user/ferreiracostaoziel', 'https://www.instagram.com/ozielferreiraofficial', 'https://api.whatsapp.com/send?phone=5521999244944&text=Deixe%20sua%20mensagem!', '2018-06-29 04:05:25'),
(2, 'Professor  - Diretor da escola', 'Carlinhos de Niterói', 'jaime-aroxa-niteroi-carlinhos-de-niteroi-professor-de-danca', 'https://www.facebook.com/carlinhosdeniteroi', 'https://www.youtube.com/channel/UC0fEs0WekTUlg9qXAqFPSMA', 'https://www.instagram.com/carlinhosdeniteroi/', 'https://api.whatsapp.com/send?phone=5521996767737&text=Deixe%20sua%20mensagem!', '2018-06-29 05:02:59'),
(3, 'Professora', 'Mariana Dulcetti', 'jaime-aroxa-niteroi-mariana-dulcetti-professora-de-danca', 'https://www.facebook.com/mariana.dulcetti', 'https://www.youtube.com/channel/UC0fEs0WekTUlg9qXAqFPSMA', 'https://www.instagram.com/marianadulcetti/', 'https://api.whatsapp.com/send?phone=5521993332878&text=Deixe%20sua%20mensagem!', '2018-06-29 05:40:05');

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
(2, 'BAILE MENSAL', 'baile-mensal-escola-jaime-aroxa-niteroi', 'Acontece no segundo sábado de cada mês!', '2018-06-25 07:57:32'),
(3, 'Projeto ao ar Livre', 'projeto-dancando-na-praia-jaime-aroxa-niteroi', 'Acontece no terceiro domingo de cada mês!!!', '2018-06-26 12:50:05'),
(4, 'Baile CN Zouk', 'baile-de-cn-zouk-jaime-aroxa-niteroi', 'Acontece na terceira sexta-feira de cada mês!!!', '2018-06-26 12:52:00'),
(5, 'Novidades', 'novidades-aulas-bailes-jaime-aroxa-niteroi', 'Estamos de visual novo para 2018.', '2018-06-26 12:54:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_horarios`
--

CREATE TABLE `tb_horarios` (
  `idhorario` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
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
  `descritmo` text NOT NULL,
  `desurlritmo` varchar(128) NOT NULL,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_ritmos`
--

INSERT INTO `tb_ritmos` (`idritmo`, `tituloritmo`, `descritmo`, `desurlritmo`, `dtregister`) VALUES
(1, 'Bolero', 'O bolero é um ritmo cubano que mescla raízes espanholas com influências locais de vários países hispano-americanos.', 'jaime-aroxa-niteroi-ritmo-bolero', '2018-06-29 08:00:50');

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
(2, 'https://www.youtube.com/embed/ZsosmXAlY24', 'Oziel Ferreira & Larissa Camacho', 'Turma de danca de salão aos sábados.', '2018-06-24 05:08:39'),
(3, 'https://www.youtube.com/embed/IONhts0TdR4', 'Flash Mob na AABB', 'Baile de Aniversário - Carlinhos de Niterói', '2018-06-24 18:23:20'),
(4, 'https://www.youtube.com/embed/dnsgCW1p-Q0', '8º Aniversário da Escola', 'Segunda geração da equipe!', '2018-06-25 17:28:05'),
(5, 'https://www.youtube.com/embed/GqJh-82C4gA', 'Bolero in Foco 2016', 'Carlinhos de Niterói e Barbara Ribeiro', '2018-06-25 18:24:03'),
(9, 'https://www.youtube.com/embed/zYP8V_pMHpo', 'Carlinhos de Niterói Street Dance', 'Street Dance Compania de Botafogo', '2018-06-25 19:24:42'),
(13, 'https://www.youtube.com/embed/tJJBmgv6vws', 'Clube Central', 'Carlinhos de Niterói', '2018-06-25 22:29:40'),
(17, 'https://www.youtube.com/embed/vyZDiqX5D3o', 'Samba no pé - Projeto Praia', 'Carlinhos de Niterói.', '2018-06-26 00:35:47'),
(18, 'https://www.youtube.com/embed/BlmOwmISKX4', 'Bolero in Foco 2017', 'Carlinhos de Niterói e Barbara Ribeiro', '2018-06-26 00:58:37'),
(19, 'https://www.youtube.com/embed/kcgQjuxxSgw?t', 'Baile do Carlinhos Niterói ', 'Carlinhos de Niterói e Barbara Ribeiro', '2018-06-26 01:03:33'),
(20, 'https://www.youtube.com/embed/LO4la0Ljbgo', '15º Aniversário da Escola', 'Equipe dançando uma valsa.', '2018-06-26 01:07:45'),
(21, 'https://www.youtube.com/embed/S0b-Jhs4Ejc', 'Carlinhos de Niterói Aniversário', 'Carlinhos de Niterói no BelleVille', '2018-06-30 05:28:30'),
(22, 'https://www.youtube.com/embed/2GQwo90-FTg?start=97', '2º Congresso Cia Samba e Zouk', 'Bianca Gonzalez & Carlinhos de Niterói', '2018-06-30 05:37:29');

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
-- Indexes for table `tb_equipe`
--
ALTER TABLE `tb_equipe`
  ADD PRIMARY KEY (`idequipe`);

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
-- AUTO_INCREMENT for table `tb_equipe`
--
ALTER TABLE `tb_equipe`
  MODIFY `idequipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_eventos`
--
ALTER TABLE `tb_eventos`
  MODIFY `idevento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_horarios`
--
ALTER TABLE `tb_horarios`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_ritmos`
--
ALTER TABLE `tb_ritmos`
  MODIFY `idritmo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_videos`
--
ALTER TABLE `tb_videos`
  MODIFY `idvideo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_addresses`
--
ALTER TABLE `tb_addresses`
  ADD CONSTRAINT `fk_addresses_alunos` FOREIGN KEY (`idaluno`) REFERENCES `tb_alunos` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_users`
--
ALTER TABLE `tb_users`
  ADD CONSTRAINT `fk_users_alunos` FOREIGN KEY (`idaluno`) REFERENCES `tb_alunos` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
