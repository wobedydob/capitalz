-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema capitalz_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema capitalz_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `capitalz_db` DEFAULT CHARACTER SET utf8 ;
USE `capitalz_db` ;

-- -----------------------------------------------------
-- Table `capitalz_db`.`user_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `capitalz_db`.`user_role` (
  `role_id` INT(7) NOT NULL AUTO_INCREMENT,
  `role_title` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`role_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `capitalz_db`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `capitalz_db`.`user` (
  `user_id` INT(7) NOT NULL AUTO_INCREMENT,
  `email` VARBINARY(271) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `number` VARCHAR(20) NOT NULL,
  `user_role` INT(7) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `number_UNIQUE` (`number` ASC) ,
  INDEX `user_role_idx` (`user_role` ASC) ,
  CONSTRAINT `user_role`
    FOREIGN KEY (`user_role`)
    REFERENCES `capitalz_db`.`user_role` (`role_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `capitalz_db`.`profile_se`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `capitalz_db`.`profile_se` (
  `profile_id` INT(7) NOT NULL AUTO_INCREMENT,
  `user_id` INT(7) NOT NULL,
  `firstname` VARCHAR(50) NOT NULL,
  `infix` VARCHAR(15) NOT NULL,
  `lastname` VARCHAR(50) NOT NULL,
  `birthday` DATE NOT NULL,
  `gender` ENUM('m', 'f', 'o') NOT NULL,
  `nationality` VARCHAR(50) NOT NULL,
  `about` VARCHAR(50) NOT NULL,
  `btw_nummer` VARCHAR(20) NOT NULL,
  `cv_file` VARBINARY(271) NOT NULL,
  PRIMARY KEY (`profile_id`, `user_id`),
  UNIQUE INDEX `btw_nummer_UNIQUE` (`btw_nummer` ASC) ,
  INDEX `user_idx` (`user_id` ASC) ,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `capitalz_db`.`user` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `number`
    FOREIGN KEY (`btw_nummer`)
    REFERENCES `capitalz_db`.`user` (`number`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `capitalz_db`.`profile_co`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `capitalz_db`.`profile_co` (
  `profile_id` INT(7) NOT NULL,
  `user_id` INT(7) NOT NULL,
  `company_name` VARCHAR(255) NOT NULL,
  `country_loc` VARCHAR(45) NOT NULL,
  `city_loc` VARCHAR(45) NOT NULL,
  `about` TEXT NOT NULL,
  `website` VARBINARY(271) NOT NULL,
  `kvk_nummer` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`profile_id`, `user_id`),
  INDEX `user_id_idx` (`user_id` ASC) ,
  INDEX `number_idx` (`kvk_nummer` ASC) ,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `capitalz_db`.`user` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `number`
    FOREIGN KEY (`kvk_nummer`)
    REFERENCES `capitalz_db`.`user` (`number`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `capitalz_db`.`job`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `capitalz_db`.`job` (
  `job_id` INT(7) NOT NULL AUTO_INCREMENT,
  `company_id` INT(7) NOT NULL,
  `title` VARCHAR(75) NOT NULL,
  `tag` VARCHAR(100) NOT NULL,
  `desc` TEXT NOT NULL,
  `date_start` DATE NOT NULL,
  `date_end` DATE NOT NULL,
  `work_hours` VARCHAR(20) NOT NULL,
  `work_sal` VARCHAR(20) NOT NULL,
  `company_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`job_id`, `company_id`),
  INDEX `user_id_idx` (`company_id` ASC) ,
  INDEX `company_name_idx` (`company_name` ASC) ,
  CONSTRAINT `user_id`
    FOREIGN KEY (`company_id`)
    REFERENCES `capitalz_db`.`user` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `company_name`
    FOREIGN KEY (`company_name`)
    REFERENCES `capitalz_db`.`profile_co` (`company_name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
