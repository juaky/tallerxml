-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2014 at 11:22 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a5500181_xml`
--

-- --------------------------------------------------------

--
-- Table structure for table `visites`
--

CREATE TABLE `visites` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `ip` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `pais` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `ciutat` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `idioma` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `coordenades` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `navegador` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `visites`
--


