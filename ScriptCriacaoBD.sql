-- MySQL Script generated by MySQL Workbench
-- Wed Jun  3 23:14:13 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema SistemaControlePedidos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema SistemaControlePedidos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `SistemaControlePedidos` DEFAULT CHARACTER SET utf8 ;
USE `SistemaControlePedidos` ;

-- -----------------------------------------------------
-- Table `SistemaControlePedidos`.`Perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaControlePedidos`.`Perfil` (
  `idPerfil` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPerfil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaControlePedidos`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaControlePedidos`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `idPerfil` INT NOT NULL,
  PRIMARY KEY (`idUsuario`),
  INDEX `fk_PerfilCliente_Perfil1_idx` (`idPerfil` ASC) ,
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) ,
  UNIQUE INDEX `idUsuario_UNIQUE` (`idUsuario` ASC) ,
  CONSTRAINT `fk_PerfilCliente_Perfil1`
    FOREIGN KEY (`idPerfil`)
    REFERENCES `SistemaControlePedidos`.`Perfil` (`idPerfil`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaControlePedidos`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaControlePedidos`.`Cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `cpf` BIGINT UNSIGNED NOT NULL UNIQUE,
  `nome` VARCHAR(45) NOT NULL,
  `sobrenome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(90) NOT NULL,
  `telefone` VARCHAR(90) NOT NULL,
  `cep` VARCHAR(45) NOT NULL,
  `logradouro` VARCHAR(45) NOT NULL,
  `numero` INT NOT NULL,
  `complemento` VARCHAR(45) NOT NULL,
  `idUsuario` INT NOT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE INDEX `idCliente_UNIQUE` (`idCliente` ASC) ,
  INDEX `fk_Cliente_Usuario1_idx` (`idUsuario` ASC) ,
  CONSTRAINT `fk_Cliente_Usuario1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `SistemaControlePedidos`.`Usuario` (`idUsuario`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaControlePedidos`.`StatusPedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaControlePedidos`.`StatusPedido` (
  `idStatusPedido` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(90) NULL,
  PRIMARY KEY (`idStatusPedido`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaControlePedidos`.`Pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaControlePedidos`.`Pedido` (
  `idPedido` INT NOT NULL AUTO_INCREMENT,
  `idStatusPedido` INT NOT NULL,
  `idFormaPagamento` INT NOT NULL,
  `idCliente` INT NOT NULL,
  PRIMARY KEY (`idPedido`),
  INDEX `fk_Pedido_statusPedido1_idx` (`idStatusPedido` ASC) ,
  INDEX `fk_Pedido_Cliente1_idx` (`idCliente` ASC) ,
  CONSTRAINT `fk_Pedido_statusPedido1`
    FOREIGN KEY (`idStatusPedido`)
    REFERENCES `SistemaControlePedidos`.`StatusPedido` (`idStatusPedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pedido_Cliente1`
    FOREIGN KEY (`idCliente`)
    REFERENCES `SistemaControlePedidos`.`Cliente` (`idCliente`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaControlePedidos`.`Categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaControlePedidos`.`Categoria` (
  `idCategoria` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(90) NULL,
  PRIMARY KEY (`idCategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaControlePedidos`.`Item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaControlePedidos`.`Item` (
  `idItem` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `preco` DECIMAL(10, 2) NULL,
  `quantidade` INT NULL,
  `idCategoria` INT NOT NULL,
  PRIMARY KEY (`idItem`),
  INDEX `fk_ItemPedido_Categoria1_idx` (`idCategoria` ASC) ,
  CONSTRAINT `fk_ItemPedido_Categoria1`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `SistemaControlePedidos`.`Categoria` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaControlePedidos`.`ItemPedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaControlePedidos`.`ItemPedido` (
  `idItemPedido` INT NOT NULL AUTO_INCREMENT,
  `idPedido` INT NOT NULL,
  `idItem` INT NOT NULL,
  `quantidade` INT NOT NULL,
  INDEX `fk_Pedido_has_ItemPedido_ItemPedido1_idx` (`idItem` ASC) ,
  INDEX `fk_Pedido_has_ItemPedido_Pedido1_idx` (`idPedido` ASC) ,
  PRIMARY KEY (`idItemPedido`),
  CONSTRAINT `fk_Pedido_has_ItemPedido_Pedido1`
    FOREIGN KEY (`idPedido`)
    REFERENCES `SistemaControlePedidos`.`Pedido` (`idPedido`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pedido_has_ItemPedido_ItemPedido1`
    FOREIGN KEY (`idItem`)
    REFERENCES `SistemaControlePedidos`.`Item` (`idItem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
