-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.13-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para db_drc
CREATE DATABASE IF NOT EXISTS `db_drc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_drc`;

-- Copiando estrutura para procedure db_drc.pr_insert_usu
DELIMITER //
CREATE PROCEDURE `pr_insert_usu`(
	IN cpfp BIGINT,
	IN nomep VARCHAR(80),
	IN tusu INT,
	IN login VARCHAR(80),
	IN senha VARCHAR(15),
	OUT msg VARCHAR(60)
)
BEGIN 
	DECLARE ctrlp INT;
	DECLARE ctrlu INT;
	
	SELECT COUNT(cpf_pessoa) INTO ctrlp FROM tb_pessoa WHERE cpf_pessoa = cpfp;
	SELECT COUNT(login_usuario) INTO ctrlu FROM tb_usuario WHERE login_usuario = login;
	IF (ctrlp = 0 AND ctrlu = 0) THEN
		INSERT INTO tb_pessoa (cpf_pessoa, nome_pessoa, tpusu_pessoa) VALUES (cpfp, nomep, tusu);
		SET ctrlu = 1;		
		IF (ctrlu = 1) THEN
			INSERT INTO tb_usuario (login_usuario, pass_usuario, cpf_pessoa) VALUES (login, senha, cpfp);
			SET msg = 'Cadastro realizado com sucesso.';
		END IF;
	ELSE
		SET msg = 'Cadastro já existente.';
	END IF;
	SELECT msg;
END//
DELIMITER ;

-- Copiando estrutura para procedure db_drc.pr_login
DELIMITER //
CREATE PROCEDURE `pr_login`(
	IN `login` VARCHAR(80),
	IN `senha` VARCHAR(15)
)
BEGIN

SELECT usu.login_usuario, usu.pass_usuario, pess.nome_pessoa, pess.cpf_pessoa FROM tb_usuario usu 
INNER JOIN tb_pessoa pess ON usu.cpf_pessoa = pess.cpf_pessoa 
WHERE usu.login_usuario = login AND usu.pass_usuario = senha;

END//
DELIMITER ;

-- Copiando estrutura para tabela db_drc.tb_cor
CREATE TABLE IF NOT EXISTS `tb_cor` (
  `id_cor` int(11) NOT NULL AUTO_INCREMENT,
  `desc_cor` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_cor`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_drc.tb_fabricante
CREATE TABLE IF NOT EXISTS `tb_fabricante` (
  `id_fabricante` int(11) NOT NULL AUTO_INCREMENT,
  `desc_fabricante` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_fabricante`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_drc.tb_pessoa
CREATE TABLE IF NOT EXISTS `tb_pessoa` (
  `cpf_pessoa` bigint(20) NOT NULL,
  `nome_pessoa` varchar(80) NOT NULL DEFAULT '',
  `cnh_pessoa` bigint(20) DEFAULT 0,
  `dt_cad_pessoa` date DEFAULT NULL,
  `ender_pessoa` varchar(70) DEFAULT NULL,
  `bairro_pessoa` varchar(30) DEFAULT NULL,
  `cidade_pessoa` varchar(60) DEFAULT NULL,
  `uf_pessoa` varchar(30) DEFAULT NULL,
  `cep_pessoa` varchar(8) DEFAULT NULL,
  `tpusu_pessoa` int(11) NOT NULL,
  PRIMARY KEY (`cpf_pessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_drc.tb_reserva
CREATE TABLE IF NOT EXISTS `tb_reserva` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `dt_reserva` date NOT NULL,
  `dt_conf_reserva` date DEFAULT NULL,
  `confirma_reserva` char(1) NOT NULL DEFAULT 'N',
  `id_veiculo` int(11) NOT NULL DEFAULT 0,
  `cpf_pessoa` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_reserva`),
  KEY `FK__tb_veiculo` (`id_veiculo`),
  KEY `FK__tb_pessoa` (`cpf_pessoa`),
  CONSTRAINT `FK__tb_pessoa` FOREIGN KEY (`cpf_pessoa`) REFERENCES `tb_pessoa` (`cpf_pessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__tb_veiculo` FOREIGN KEY (`id_veiculo`) REFERENCES `tb_veiculo` (`id_veiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_drc.tb_tipo
CREATE TABLE IF NOT EXISTS `tb_tipo` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `desc_tipo` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_drc.tb_usuario
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `login_usuario` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `pass_usuario` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `cpf_pessoa` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `login_usuario` (`login_usuario`),
  KEY `cpf_pessoa` (`cpf_pessoa`),
  CONSTRAINT `cpf_pessoa` FOREIGN KEY (`cpf_pessoa`) REFERENCES `tb_pessoa` (`cpf_pessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela db_drc.tb_veiculo
CREATE TABLE IF NOT EXISTS `tb_veiculo` (
  `id_veiculo` int(11) NOT NULL AUTO_INCREMENT,
  `modelo_veiculo` varchar(30) NOT NULL DEFAULT '0',
  `placa_veiculo` varchar(9) NOT NULL DEFAULT '0',
  `dt_mod_veiculo` varchar(10) NOT NULL DEFAULT '0',
  `foto_veiculo` varchar(30) NOT NULL DEFAULT '0',
  `id_tipo` int(11) NOT NULL DEFAULT 0,
  `id_fabricante` int(11) NOT NULL DEFAULT 0,
  `id_cor` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_veiculo`),
  KEY `FK__tb_tipo` (`id_tipo`),
  KEY `FK__tb_fabricante` (`id_fabricante`),
  KEY `FK__tb_cor` (`id_cor`),
  CONSTRAINT `FK__tb_cor` FOREIGN KEY (`id_cor`) REFERENCES `tb_cor` (`id_cor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__tb_fabricante` FOREIGN KEY (`id_fabricante`) REFERENCES `tb_fabricante` (`id_fabricante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__tb_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tb_tipo` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para view db_drc.vw_pessoa
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `vw_pessoa` (
	`CPF` BIGINT(20) NOT NULL,
	`NOME` VARCHAR(80) NOT NULL COLLATE 'latin1_swedish_ci',
	`CNH` BIGINT(20) NULL,
	`CEP` VARCHAR(8) NULL COLLATE 'latin1_swedish_ci',
	`LOGRADOURO` VARCHAR(70) NULL COLLATE 'latin1_swedish_ci',
	`BAIRRO` VARCHAR(30) NULL COLLATE 'latin1_swedish_ci',
	`CIDADE` VARCHAR(60) NULL COLLATE 'latin1_swedish_ci',
	`UF` VARCHAR(30) NULL COLLATE 'latin1_swedish_ci',
	`LOGIN` VARCHAR(80) NOT NULL COLLATE 'utf8mb4_unicode_ci',
	`SENHA` VARCHAR(15) NOT NULL COLLATE 'utf8mb4_unicode_ci'
) ENGINE=MyISAM;

-- Copiando estrutura para view db_drc.vw_reserva
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `vw_reserva` (
	`RESERVA` INT(11) NOT NULL,
	`DATA` DATE NOT NULL,
	`CONFIRMA` CHAR(1) NOT NULL COLLATE 'latin1_swedish_ci',
	`CPF` BIGINT(20) NOT NULL,
	`NOME` VARCHAR(80) NOT NULL COLLATE 'latin1_swedish_ci',
	`MODELO` VARCHAR(30) NOT NULL COLLATE 'latin1_swedish_ci',
	`PLACA` VARCHAR(9) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Copiando estrutura para view db_drc.vw_veiculo
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `vw_veiculo` (
	`CODIGO` INT(11) NOT NULL,
	`MODELO` VARCHAR(30) NOT NULL COLLATE 'latin1_swedish_ci',
	`PLACA` VARCHAR(9) NOT NULL COLLATE 'latin1_swedish_ci',
	`ANO` VARCHAR(10) NOT NULL COLLATE 'latin1_swedish_ci',
	`FOTO` VARCHAR(30) NOT NULL COLLATE 'latin1_swedish_ci',
	`FABRICANTE` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`TIPO` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`COR` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Copiando estrutura para view db_drc.vw_pessoa
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `vw_pessoa`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_pessoa` AS SELECT p.cpf_pessoa CPF, p.nome_pessoa NOME, p.cnh_pessoa CNH, p.cep_pessoa CEP, p.ender_pessoa LOGRADOURO, p.bairro_pessoa BAIRRO, p.cidade_pessoa CIDADE, p.uf_pessoa UF, 
		 u.login_usuario LOGIN, u.pass_usuario SENHA FROM tb_pessoa p
INNER JOIN tb_usuario u ON u.cpf_pessoa = p.cpf_pessoa ;

-- Copiando estrutura para view db_drc.vw_reserva
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `vw_reserva`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_reserva` AS SELECT r.id_reserva RESERVA, r.dt_reserva 'DATA', r.confirma_reserva CONFIRMA,
		 p.CPF, p.NOME,
		 v.MODELO, v.PLACA 
FROM tb_reserva r
INNER JOIN vw_veiculo v ON v.CODIGO = r.id_veiculo
INNER JOIN vw_pessoa p ON p.CPF = r.cpf_pessoa
ORDER BY r.id_reserva ;

-- Copiando estrutura para view db_drc.vw_veiculo
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `vw_veiculo`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_veiculo` AS SELECT v.id_veiculo CODIGO, v.modelo_veiculo MODELO, v.placa_veiculo PLACA, v.dt_mod_veiculo ANO, v.foto_veiculo FOTO, 
		 f.desc_fabricante FABRICANTE, 
		 t.desc_tipo TIPO, 
		 c.desc_cor COR 
FROM tb_veiculo v
INNER JOIN tb_fabricante f ON f.id_fabricante = v.id_fabricante
INNER JOIN tb_tipo t ON t.id_tipo = v.id_tipo
INNER JOIN tb_cor c ON c.id_cor = v.id_cor ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
