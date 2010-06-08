SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `tianguiscabal` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `tianguiscabal`;

-- -----------------------------------------------------
-- Table `tianguiscabal`.`category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tianguiscabal`.`category` (
  `category_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(255) NOT NULL DEFAULT 'Dale un valor no seas gacho' ,
  PRIMARY KEY (`category_id`) )
ENGINE = InnoDB
COMMENT = 'Holds the Categories';


-- -----------------------------------------------------
-- Table `tianguiscabal`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tianguiscabal`.`user` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `password` CHAR(40) NOT NULL ,
  `description` VARCHAR(255) NULL ,
  `full_name` VARCHAR(99) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `twitter` VARCHAR(45) NULL ,
  `date` DATE NOT NULL ,
  `role` ENUM('new', 'registered', 'moderator', 'admin') NOT NULL DEFAULT 'new' ,
  PRIMARY KEY (`user_id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `name` ON `tianguiscabal`.`user` (`name` ASC) ;


-- -----------------------------------------------------
-- Table `tianguiscabal`.`product`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tianguiscabal`.`product` (
  `product_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT UNSIGNED NOT NULL ,
  `category_id` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(45) NOT NULL ,
  `picture` VARCHAR(99) NULL ,
  `price` VARCHAR(45) NOT NULL DEFAULT 0 ,
  `quantity` TINYINT NOT NULL DEFAULT 1 ,
  `quality` ENUM('excellent', 'very good', 'good', 'average', 'parts') NOT NULL DEFAULT 'good' ,
  `transaction` ENUM('buy', 'sell', 'exchange') NOT NULL DEFAULT 'sell' ,
  `exchange_for` VARCHAR(99) NULL ,
  `date` DATE NOT NULL ,
  PRIMARY KEY (`product_id`) ,
  CONSTRAINT `fk_product_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `tianguiscabal`.`user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_category1`
    FOREIGN KEY (`category_id` )
    REFERENCES `tianguiscabal`.`category` (`category_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_product_user` ON `tianguiscabal`.`product` (`user_id` ASC) ;

CREATE INDEX `fk_product_category1` ON `tianguiscabal`.`product` (`category_id` ASC) ;


-- -----------------------------------------------------
-- Table `tianguiscabal`.`comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tianguiscabal`.`comment` (
  `comment_id` INT NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  `product_id` INT UNSIGNED NOT NULL ,
  `comment` VARCHAR(255) NOT NULL ,
  `date` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`comment_id`) ,
  CONSTRAINT `fk_comment_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `tianguiscabal`.`user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_product1`
    FOREIGN KEY (`product_id` )
    REFERENCES `tianguiscabal`.`product` (`product_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_comment_user1` ON `tianguiscabal`.`comment` (`user_id` ASC) ;

CREATE INDEX `fk_comment_product1` ON `tianguiscabal`.`comment` (`product_id` ASC) ;


-- -----------------------------------------------------
-- Table `tianguiscabal`.`report`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tianguiscabal`.`report` (
  `report_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` INT UNSIGNED NOT NULL ,
  `description` VARCHAR(45) NOT NULL ,
  `url` VARCHAR(99) NOT NULL ,
  `date` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`report_id`) ,
  CONSTRAINT `fk_report_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `tianguiscabal`.`user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_report_user1` ON `tianguiscabal`.`report` (`user_id` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `tianguiscabal`.`category`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `tianguiscabal`;
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Almacenamiento', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Cables', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Copiadoras', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Fax', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Impresoras', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Miscelanea', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Mouse', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Notebooks', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'PDAs', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Scanners', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Teclados', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Video', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Audio', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Camaras', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Energia', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Gabinetes', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Memoria', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Monitores', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Muebles', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'PCs', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Redes', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Tarjetas Madres', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'Telefonia', '');
INSERT INTO `category` (`category_id`, `name`, `description`) VALUES (0, 'No Computo', '');

COMMIT;

-- -----------------------------------------------------
-- Data for table `tianguiscabal`.`user`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `tianguiscabal`;
INSERT INTO `user` (`user_id`, `name`, `password`, `description`, `full_name`, `email`, `twitter`, `date`, `role`) VALUES (0, 'admin', '39528eed7b20660478bdb72704bcd7e028a1ae04', 'Temporal Admin, you should really change this', 'Temporal Admin', 'admin@example.com', 'example', NOW(), 'admin');

COMMIT;
