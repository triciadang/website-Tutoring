SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

 CREATE DATABASE tutor DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;

 USE `tutor`;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE IF NOT EXISTS `tutorList` (
  `tutorFName` varchar(50) NOT NULL,
  `tutorLName` varchar(50) NOT NULL,
  `tutorMajor` varchar(50) NOT NULL,
  `tutorPhone` char(12) NOT NULL,
  PRIMARY KEY (`tutorLName`)
);

--
-- Dumping data for table `partners`
--

INSERT INTO `tutorList` (`tutorFName`, `tutorLName`, `tutorMajor`, `tutorPhone`) VALUES
('Tricia', 'Dang','CompSci', '719-475-7800'),
('Brenna', 'Chen', 'Biology', '719-502-5290'),
('Nick', 'Baietto', 'Astro', '719-633-2443'),
('Ryan', 'Schwarz', 'Astro', '719-577-9111');