CREATE USER 'fmrepo'@'%' IDENTIFIED BY 'secret';
GRANT All PRIVILEGES ON *.* TO 'fmrepo'@'%';
FLUSH PRIVILEGES;
DROP DATABASE  IF EXISTS `fmrepo`;
CREATE DATABASE `fmrepo` COLLATE 'utf8_general_ci';
