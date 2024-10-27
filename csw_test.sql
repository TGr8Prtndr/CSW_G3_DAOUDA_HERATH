-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2024 at 10:01 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: csw_test
--

-- --------------------------------------------------------

--
-- Table structure for table ADMINS
--

CREATE TABLE ADMINS (
  idAdmin int(5) NOT NULL,
  emailAdmin varchar(50) NOT NULL,
  adminname varchar(50) NOT NULL,
  adminPassword varchar(20) NOT NULL,
  nom_admin varchar(50) NOT NULL,
  prenom_admin varchar(50) NOT NULL,
  membre tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table ENTRAINEMENTS
--

CREATE TABLE ENTRAINEMENTS (
  idEntrainment int(5) NOT NULL,
  titre varchar(50) NOT NULL,
  description text NOT NULL,
  categorie varchar(20) NOT NULL,
  date date NOT NULL,
  heure_debut time NOT NULL,
  lieu varchar(50) NOT NULL,
  nombre_participants_actuel int(11) NOT NULL,
  nombre_max_participants int(11) NOT NULL,
  idAdmin int(11) NOT NULL,
  heure_fin time NOT NULL,
  id_photo int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table INSCRIPTIONS
--

CREATE TABLE INSCRIPTIONS (
  id_inscription int(5) NOT NULL,
  idUser int(5) NOT NULL,
  idEntrainement int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table PHOTOS
--

CREATE TABLE PHOTOS (
  id_photo int(5) NOT NULL,
  url_image varchar(500) NOT NULL,
  uploaded_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  id_entrainement int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table UTILISATEURS
--

CREATE TABLE UTILISATEURS (
  idUser int(5) NOT NULL,
  emailUser varchar(50) NOT NULL,
  username varchar(50) NOT NULL,
  userPassword varchar(20) NOT NULL,
  nom_user varchar(50) NOT NULL,
  prenom_user varchar(50) NOT NULL,
  membre tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table ADMINS
--
ALTER TABLE ADMINS
  ADD PRIMARY KEY (idAdmin);

--
-- Indexes for table ENTRAINEMENTS
--
ALTER TABLE ENTRAINEMENTS
  ADD PRIMARY KEY (idEntrainment),
  ADD KEY idAdmin (idAdmin),
  ADD KEY id_photo (id_photo);

--
-- Indexes for table INSCRIPTIONS
--
ALTER TABLE INSCRIPTIONS
  ADD PRIMARY KEY (id_inscription),
  ADD KEY idUser (idUser),
  ADD KEY idEntrainement (idEntrainement);

--
-- Indexes for table PHOTOS
--
ALTER TABLE PHOTOS
  ADD PRIMARY KEY (id_photo),
  ADD KEY id_entrainement (id_entrainement);

--
-- Indexes for table UTILISATEURS
--
ALTER TABLE UTILISATEURS
  ADD PRIMARY KEY (idUser);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table ADMINS
--
ALTER TABLE ADMINS
  MODIFY idAdmin int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table ENTRAINEMENTS
--
ALTER TABLE ENTRAINEMENTS
  MODIFY idEntrainment int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table INSCRIPTIONS
--
ALTER TABLE INSCRIPTIONS
  MODIFY id_inscription int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table PHOTOS
--
ALTER TABLE PHOTOS
  MODIFY id_photo int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table UTILISATEURS
--
ALTER TABLE UTILISATEURS
  MODIFY idUser int(5) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table ENTRAINEMENTS
--
ALTER TABLE ENTRAINEMENTS
  ADD CONSTRAINT entrainements_ibfk_1 FOREIGN KEY (idAdmin) REFERENCES ADMINS (idAdmin) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT entrainements_ibfk_2 FOREIGN KEY (id_photo) REFERENCES PHOTOS (id_photo) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table INSCRIPTIONS
--
ALTER TABLE INSCRIPTIONS
  ADD CONSTRAINT INSCRIPTIONS_ibfk_1 FOREIGN KEY (idUser) REFERENCES UTILISATEURS (idUser) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT INSCRIPTIONS_ibfk_2 FOREIGN KEY (idEntrainement) REFERENCES ENTRAINEMENTS (idEntrainment) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
