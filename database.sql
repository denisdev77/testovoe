create database `banner_system`;

use `banner_system`;

CREATE TABLE `banners`(
    `id` int(11) NOT NULL  AUTO_INCREMENT,
    `name` varchar(150) NOT NULL,
    `type` varchar(100) NOT NULL,
    `url` varchar(150) NOT NULL,
    `target` varchar(150) NOT NULL,
    `status` smallint (2) NOT NULL,
    `image` varchar(150) NOT NULL,
    `created_time` datetime NOT NULL,
    `updated_time` datetime NOT NULL,
     PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


