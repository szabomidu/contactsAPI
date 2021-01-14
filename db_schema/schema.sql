/*
 * Contacts API
 *
 * Database schema
 * Version: 8.0.22-MySQL
 */

CREATE DATABASE IF NOT EXISTS `contactsDB`;

USE `contactsDB`;

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts`
(
    `id`           INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`         TEXT             NOT NULL,
    `phone_number` VARCHAR(15)      NOT NULL,
    `address`      VARCHAR(250)     NOT NULL,
    PRIMARY KEY (`id`)
);
