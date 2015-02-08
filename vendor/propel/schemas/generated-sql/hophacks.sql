
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255),
    `first_name` VARCHAR(255),
    `last_name` VARCHAR(255),
    `last_active` DATETIME,
    `email` VARCHAR(255),
    `score` INTEGER,
    `token` LONGTEXT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- partnership
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `partnership`;

CREATE TABLE `partnership`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER,
    `partner_id` INTEGER,
    `campaign_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `partnership_fi_29554a` (`user_id`),
    INDEX `partnership_fi_58ad58` (`partner_id`),
    INDEX `partnership_fi_fb800b` (`campaign_id`),
    CONSTRAINT `partnership_fk_29554a`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`),
    CONSTRAINT `partnership_fk_58ad58`
        FOREIGN KEY (`partner_id`)
        REFERENCES `user` (`id`),
    CONSTRAINT `partnership_fk_fb800b`
        FOREIGN KEY (`campaign_id`)
        REFERENCES `campaign` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- campaign
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `campaign`;

CREATE TABLE `campaign`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER,
    `name` VARCHAR(255),
    `begin_date` DATE,
    `end_date` DATE,
    `campaign_status_id` INTEGER,
    `balance_id` INTEGER,
    `activity_id` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `campaign_fi_31dbc9` (`campaign_status_id`),
    INDEX `campaign_fi_70b2ac` (`balance_id`),
    INDEX `campaign_fi_8dfe0d` (`activity_id`),
    CONSTRAINT `campaign_fk_31dbc9`
        FOREIGN KEY (`campaign_status_id`)
        REFERENCES `campaign_status` (`id`),
    CONSTRAINT `campaign_fk_70b2ac`
        FOREIGN KEY (`balance_id`)
        REFERENCES `balance` (`id`),
    CONSTRAINT `campaign_fk_8dfe0d`
        FOREIGN KEY (`activity_id`)
        REFERENCES `activity` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- campaign_status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `campaign_status`;

CREATE TABLE `campaign_status`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `status` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- balance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `balance`;

CREATE TABLE `balance`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `amount` DOUBLE,
    `payment_info` LONGTEXT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- activity
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `activity`;

CREATE TABLE `activity`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
