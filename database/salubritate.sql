-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2021 at 06:45 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salubritate`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nume` varchar(45) DEFAULT NULL,
  `prenume` varchar(45) DEFAULT NULL,
  `patronimic` varchar(45) DEFAULT NULL,
  `IDNP` varchar(13) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `e_mail` varchar(45) DEFAULT NULL,
  `adresa` varchar(45) DEFAULT NULL
) ENGINE=InnoDBRegiuni;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `nume`, `prenume`, `patronimic`, `IDNP`, `data`, `tel`, `e_mail`, `adresa`) VALUES
(4, 'Petru', 'Trifan', 'Sergiu', '1111111111112', NULL, '069567740', 'trifanp@mail.ru', 'Vasile Alecsandri 80'),
(5, 'sdsd', 'sss', 'weda', '1258645896563', NULL, '036586495', 'sdds@mail.ru', 'Stefan cel Mare 33');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `id` int(11) NOT NULL,
  `nr_contract` varchar(45) DEFAULT NULL,
  `id_imobil` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL
) ENGINE=InnoDBRegiuni;

-- --------------------------------------------------------

--
-- Table structure for table `imobil`
--

CREATE TABLE `imobil` (
  `id` int(11) NOT NULL,
  `id_proprietar` int(11) DEFAULT NULL,
  `id_strada` int(11) DEFAULT NULL,
  `nr_cadastral` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `nr` int(11) DEFAULT NULL,
  `id_suburbie` int(11) DEFAULT NULL,
  `adresa_gps` varchar(45) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0
) ENGINE=InnoDBRegiuni;

--
-- Dumping data for table `imobil`
--

INSERT INTO `imobil` (`id`, `id_proprietar`, `id_strada`, `nr_cadastral`, `tel`, `nr`, `id_suburbie`, `adresa_gps`, `isActive`) VALUES
(1, NULL, NULL, '2164561323', '+37369567740', 42, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `localitate`
--

CREATE TABLE `localitate` (
  `id` int(11) NOT NULL,
  `id_raion` int(11) DEFAULT NULL,
  `nume` varchar(45) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0
) ENGINE=InnoDBRegiuni;

-- --------------------------------------------------------

--
-- Table structure for table `locatari_imobil`
--

CREATE TABLE `locatari_imobil` (
  `id` int(11) NOT NULL,
  `data_start` date DEFAULT NULL,
  `data_stop` date DEFAULT NULL,
  `nr_locatari` int(11) DEFAULT NULL,
  `id_imobil` int(11) DEFAULT NULL
) ENGINE=InnoDBRegiuni;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `content` text NOT NULL,
  `datetime` int(11) NOT NULL
) ENGINE=InnoDBRegiuni;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `image`, `content`, `datetime`) VALUES
(1, 'Test Post', 'https://via.placeholder.com/150\r\n', '<p> Content </p>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `raion`
--

CREATE TABLE `raion` (
  `id` int(11) NOT NULL,
  `id_regiune` int(11) DEFAULT NULL,
  `nume` varchar(45) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0
) ENGINE=InnoDBRegiuni;

--
-- Dumping data for table `raion`
--

INSERT INTO `raion` (`id`, `id_regiune`, `nume`, `isActive`) VALUES
(33, 1, 'Chisinau', 0),
(35, 1, 'Straseni', 0),
(36, 2, 'Balti', 0);

-- --------------------------------------------------------

--
-- Table structure for table `regiune`
--

CREATE TABLE `regiune` (
  `id` int(11) NOT NULL,
  `nume` varchar(45) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0
) ENGINE=InnoDBRegiuni;

--
-- Dumping data for table `regiune`
--

INSERT INTO `regiune` (`id`, `nume`, `isActive`) VALUES
(1, 'Centru', 0),
(2, 'Nord', 0),
(3, 'Sud', 0);

-- --------------------------------------------------------

--
-- Table structure for table `servicii_prestate`
--

CREATE TABLE `servicii_prestate` (
  `id` int(11) NOT NULL,
  `nume` varchar(45) DEFAULT NULL,
  `unit_masura` varchar(3) DEFAULT NULL,
  `cost` decimal(2,0) DEFAULT NULL,
  `data_start` date DEFAULT NULL,
  `data_stop` date DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0
) ENGINE=InnoDBRegiuni;

--
-- Dumping data for table `servicii_prestate`
--

INSERT INTO `servicii_prestate` (`id`, `nume`, `unit_masura`, `cost`, `data_start`, `data_stop`, `isActive`) VALUES
(1, 'Serviciul de colectare si transport deseuri', '50', '50', '2021-04-04', '2022-04-04', 0),
(3, 'Serviciul de salubrizare stradala si piete', ' 1 ', '75', '2021-04-04', '2022-04-04', 0),
(4, 'Serviciul de deszapezire', '1 ', '99', '2021-04-04', '2022-04-04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `servicii_prestate_contract`
--

CREATE TABLE `servicii_prestate_contract` (
  `id` int(11) NOT NULL,
  `id_contract` int(11) DEFAULT NULL,
  `id_serviciu_prestat` int(11) DEFAULT NULL,
  `data_start` date DEFAULT NULL,
  `data_fin` date DEFAULT NULL,
  `statut` enum('activ','inactiv') DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT NULL
) ENGINE=InnoDBRegiuni;

-- --------------------------------------------------------

--
-- Table structure for table `strada`
--

CREATE TABLE `strada` (
  `id` int(11) NOT NULL,
  `id_localitate` int(11) DEFAULT NULL,
  `nume` varchar(45) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0
) ENGINE=InnoDBRegiuni;

-- --------------------------------------------------------

--
-- Table structure for table `suburbie`
--

CREATE TABLE `suburbie` (
  `id` int(11) NOT NULL,
  `id_localitate` int(11) DEFAULT NULL,
  `nume` varchar(45) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0
) ENGINE=InnoDBRegiuni;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL COMMENT 'role_id',
  `role` varchar(255) DEFAULT NULL COMMENT 'role_text'
) ENGINE=InnoDBRegiuni;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDBRegiuni;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `username`, `email`, `password`, `mobile`, `roleid`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Petru', 'MsvLzn', 'trifanp@mail.ru', '866d7aae96a62faf42291ea4b64ed35c52a15882', '+37369567740', 1, 0, '2021-03-17 20:17:50', '2021-03-17 20:17:50'),
(24, 'fffff', 'ddddd', 'sdadasd@mail.ru', 'b07fc57f620860b7cd2251d247e31eeb481b5ff0', '064648429', 3, 0, '2021-03-31 14:49:33', '2021-03-31 14:49:33'),
(25, 'dsalfdskml', 'daslnwnldf', 'kol@mail.ru', 'ad70ab97ae1376e656002641cfb067c9c94906a2', '046474689', 3, 0, '2021-03-31 14:50:19', '2021-03-31 14:50:19'),
(26, 'rerxfdfg', 'sadssd', 'gol@bk.ru', 'cf2e875d70c402e4aaf32ceb64b1fa6f7396af59', '056467941', 3, 0, '2021-03-31 20:51:24', '2021-03-31 20:51:24'),
(27, 'dsadsss', 'sadfdgvc', 'ded@bk.ru', 'ad70ab97ae1376e656002641cfb067c9c94906a2', '65498231194', 3, 0, '2021-04-05 12:07:51', '2021-04-05 12:07:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_imobil` (`id_imobil`);

--
-- Indexes for table `imobil`
--
ALTER TABLE `imobil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proprietar` (`id_proprietar`),
  ADD KEY `id_strada` (`id_strada`),
  ADD KEY `id_suburbie` (`id_suburbie`);

--
-- Indexes for table `localitate`
--
ALTER TABLE `localitate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_raion` (`id_raion`);

--
-- Indexes for table `locatari_imobil`
--
ALTER TABLE `locatari_imobil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_imobil` (`id_imobil`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raion`
--
ALTER TABLE `raion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_regiune` (`id_regiune`);

--
-- Indexes for table `regiune`
--
ALTER TABLE `regiune`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicii_prestate`
--
ALTER TABLE `servicii_prestate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicii_prestate_contract`
--
ALTER TABLE `servicii_prestate_contract`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contract` (`id_contract`),
  ADD KEY `id_serviciu_prestat` (`id_serviciu_prestat`);

--
-- Indexes for table `strada`
--
ALTER TABLE `strada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_localitate` (`id_localitate`);

--
-- Indexes for table `suburbie`
--
ALTER TABLE `suburbie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_localitate` (`id_localitate`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `imobil`
--
ALTER TABLE `imobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `localitate`
--
ALTER TABLE `localitate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `locatari_imobil`
--
ALTER TABLE `locatari_imobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `raion`
--
ALTER TABLE `raion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `regiune`
--
ALTER TABLE `regiune`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `servicii_prestate`
--
ALTER TABLE `servicii_prestate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `servicii_prestate_contract`
--
ALTER TABLE `servicii_prestate_contract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `strada`
--
ALTER TABLE `strada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suburbie`
--
ALTER TABLE `suburbie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'role_id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`id_imobil`) REFERENCES `imobil` (`id`);

--
-- Constraints for table `imobil`
--
ALTER TABLE `imobil`
  ADD CONSTRAINT `imobil_ibfk_1` FOREIGN KEY (`id_proprietar`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `imobil_ibfk_2` FOREIGN KEY (`id_strada`) REFERENCES `strada` (`id`),
  ADD CONSTRAINT `imobil_ibfk_3` FOREIGN KEY (`id_suburbie`) REFERENCES `suburbie` (`id`);

--
-- Constraints for table `localitate`
--
ALTER TABLE `localitate`
  ADD CONSTRAINT `localitate_ibfk_1` FOREIGN KEY (`id_raion`) REFERENCES `raion` (`id`);

--
-- Constraints for table `locatari_imobil`
--
ALTER TABLE `locatari_imobil`
  ADD CONSTRAINT `locatari_imobil_ibfk_1` FOREIGN KEY (`id_imobil`) REFERENCES `imobil` (`id`);

--
-- Constraints for table `raion`
--
ALTER TABLE `raion`
  ADD CONSTRAINT `raion_ibfk_1` FOREIGN KEY (`id_regiune`) REFERENCES `regiune` (`id`);

--
-- Constraints for table `servicii_prestate_contract`
--
ALTER TABLE `servicii_prestate_contract`
  ADD CONSTRAINT `servicii_prestate_contract_ibfk_1` FOREIGN KEY (`id_contract`) REFERENCES `contract` (`id`),
  ADD CONSTRAINT `servicii_prestate_contract_ibfk_2` FOREIGN KEY (`id_serviciu_prestat`) REFERENCES `servicii_prestate` (`id`);

--
-- Constraints for table `strada`
--
ALTER TABLE `strada`
  ADD CONSTRAINT `strada_ibfk_1` FOREIGN KEY (`id_localitate`) REFERENCES `localitate` (`id`);

--
-- Constraints for table `suburbie`
--
ALTER TABLE `suburbie`
  ADD CONSTRAINT `suburbie_ibfk_1` FOREIGN KEY (`id_localitate`) REFERENCES `localitate` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
