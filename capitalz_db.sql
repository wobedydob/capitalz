-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema capitalz_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema capitalz_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `capitalz_db` DEFAULT CHARACTER SET latin1;
USE `capitalz_db`;

-- -----------------------------------------------------
-- Table capitalz_db.user_role
-- -----------------------------------------------------
DROP TABLE IF EXISTS capitalz_db.user_role;

CREATE TABLE IF NOT EXISTS capitalz_db.user_role
(
    role_id INT(2)      NOT NULL AUTO_INCREMENT,
    title   VARCHAR(50) NOT NULL,
    PRIMARY KEY (role_id)
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 3
    DEFAULT CHARACTER SET = latin1;

INSERT INTO user_role(role_id, title)
VALUES (0, 'admin');
INSERT INTO user_role(role_id, title)
VALUES (1, 'company');
INSERT INTO user_role(role_id, title)
VALUES (2, 'selfemployed');



-- -----------------------------------------------------
-- Table `capitalz_db`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `capitalz_db`.`user`
(
    `user_id`  INT(7)         NOT NULL AUTO_INCREMENT,
    `email`    VARBINARY(271) NOT NULL,
    `password` VARCHAR(255)   NOT NULL,
    `userrole` INT(2)         NOT NULL,
    PRIMARY KEY (`user_id`),
    INDEX `user.user_role - user_role.role_id_idx` (`userrole` ASC),
    UNIQUE INDEX `email_UNIQUE` (`email` ASC),
    CONSTRAINT `user.user_role - user_role.role_id`
        FOREIGN KEY (`userrole`)
            REFERENCES `capitalz_db`.`user_role` (`role_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB
    AUTO_INCREMENT = 1
    DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `capitalz_db`.`job`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `capitalz_db`.`job`
(
    job_id     INT(7)       NOT NULL,
    title      VARCHAR(255) NOT NULL,
    info       VARCHAR(45)  NOT NULL,
    company_id INT(7)       NOT NULL,
    location   VARCHAR(45)  NOT NULL,
    hours      INT(3)       NOT NULL,
    salary     VARCHAR(45)  NOT NULL,
    date_start DATE         NOT NULL,
    date_end   DATE         NOT NULL,
    PRIMARY KEY (`job_id`),
    INDEX `job.company_id - user.user_id_idx` (`company_id` ASC),
    CONSTRAINT `job.company_id - user.user_id`
        FOREIGN KEY (`company_id`)
            REFERENCES `capitalz_db`.`user` (`user_id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `capitalz_db`.`user_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `capitalz_db`.`user_info`
(
    `user_id` INT(7)      NOT NULL,
    `key`     VARCHAR(45) NOT NULL,
    `value`   VARCHAR(45) NOT NULL,
    PRIMARY KEY (`user_id`),
    UNIQUE INDEX `value_UNIQUE` (`value` ASC),
    CONSTRAINT `user.user_id - user_info.user_id`
        FOREIGN KEY (`user_id`)
            REFERENCES `capitalz_db`.`user` (`user_id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `capitalz_db`.`user_profile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `capitalz_db`.`user_profile`
(
    `user_id`     INT                  NOT NULL,
    `name`        VARCHAR(50)          NOT NULL,
    `email`       VARBINARY(271)       NOT NULL,
    `birthday`    DATE                 NOT NULL,
    `gender`      ENUM ('m', 'f', 'o') NOT NULL,
    `nationality` VARCHAR(50)          NOT NULL,
    `info_number` VARCHAR(45)          NULL,
    `information` TEXT                 NOT NULL,
    PRIMARY KEY (`user_id`),
    INDEX `user_profile.user_id - user.user_id_idx` (`user_id` ASC, `email` ASC),
    INDEX `profile.info_number - user_info.value_idx` (`info_number` ASC),
    CONSTRAINT `profile.user_id+email - user_user_id+email`
        FOREIGN KEY (`user_id`, `email`)
            REFERENCES `capitalz_db`.`user` (`user_id`, `email`)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
    CONSTRAINT `profile.info_number - user_info.value`
        FOREIGN KEY (`info_number`)
            REFERENCES `capitalz_db`.`user_info` (`value`)
            ON DELETE CASCADE
            ON UPDATE CASCADE
)
    ENGINE = InnoDB;



SET SQL_MODE = @OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;
