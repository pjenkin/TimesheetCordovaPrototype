-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table fugrodemo.tbldriller
CREATE TABLE IF NOT EXISTS `tbldriller` (
  `DrillerID` int(11) NOT NULL AUTO_INCREMENT,
  `DrillerName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`DrillerID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table fugrodemo.tbldriller: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbldriller` DISABLE KEYS */;
INSERT INTO `tbldriller` (`DrillerID`, `DrillerName`) VALUES
	(1, 'Nasir Khan'),
	(2, 'Cedric Aromin'),
	(3, 'Nazzam Akram'),
	(4, 'Anil RK');
/*!40000 ALTER TABLE `tbldriller` ENABLE KEYS */;


-- Dumping structure for table fugrodemo.tbldrillershiftid
CREATE TABLE IF NOT EXISTS `tbldrillershiftid` (
  `DrillerShiftID` int(11) NOT NULL AUTO_INCREMENT,
  `DrillerID` int(11) DEFAULT NULL,
  `ShiftID` int(11) DEFAULT NULL,
  PRIMARY KEY (`DrillerShiftID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table fugrodemo.tbldrillershiftid: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbldrillershiftid` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbldrillershiftid` ENABLE KEYS */;


-- Dumping structure for table fugrodemo.tblproject
CREATE TABLE IF NOT EXISTS `tblproject` (
  `ProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectDescription` varchar(100) DEFAULT NULL,
  `ProjectCode` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ProjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table fugrodemo.tblproject: ~2 rows (approximately)
/*!40000 ALTER TABLE `tblproject` DISABLE KEYS */;
INSERT INTO `tblproject` (`ProjectID`, `ProjectDescription`, `ProjectCode`) VALUES
	(1, 'Dhofar ridge exploration', 'AD0044-0004BL'),
	(2, 'Ras al Khaima piling test', 'AD0055-0005BL');
/*!40000 ALTER TABLE `tblproject` ENABLE KEYS */;


-- Dumping structure for table fugrodemo.tblprojectshift
CREATE TABLE IF NOT EXISTS `tblprojectshift` (
  `ProjectShiftID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` int(11) DEFAULT NULL,
  `ShiftID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ProjectShiftID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table fugrodemo.tblprojectshift: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblprojectshift` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblprojectshift` ENABLE KEYS */;


-- Dumping structure for table fugrodemo.tblseprig
CREATE TABLE IF NOT EXISTS `tblseprig` (
  `SEPRigID` int(11) NOT NULL AUTO_INCREMENT,
  `SEPRigCode` varchar(45) NOT NULL,
  `SEPRigDescription` varchar(100) NOT NULL,
  PRIMARY KEY (`SEPRigID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table fugrodemo.tblseprig: ~3 rows (approximately)
/*!40000 ALTER TABLE `tblseprig` DISABLE KEYS */;
INSERT INTO `tblseprig` (`SEPRigID`, `SEPRigCode`, `SEPRigDescription`) VALUES
	(1, '001', 'Big yellow SEP rig'),
	(2, '002', 'Tamrock jumbo 4 x drifter'),
	(3, '003', 'air leg');
/*!40000 ALTER TABLE `tblseprig` ENABLE KEYS */;


-- Dumping structure for table fugrodemo.tblseprigshift
CREATE TABLE IF NOT EXISTS `tblseprigshift` (
  `SEPRigShiftID` int(11) NOT NULL AUTO_INCREMENT,
  `SEPRigID` int(11) DEFAULT NULL,
  `ShiftID` int(11) DEFAULT NULL,
  `tblSEPRIgShiftcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`SEPRigShiftID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table fugrodemo.tblseprigshift: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblseprigshift` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblseprigshift` ENABLE KEYS */;


-- Dumping structure for table fugrodemo.tblshift
CREATE TABLE IF NOT EXISTS `tblshift` (
  `ShiftID` int(11) NOT NULL AUTO_INCREMENT,
  `WorkHours` decimal(10,0) NOT NULL,
  `WorkTypeID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `DrillerID` int(11) NOT NULL,
  `Metres` decimal(10,0) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `StartDateTime` datetime(1) DEFAULT NULL,
  `EndDateTime` datetime(1) DEFAULT NULL,
  `SEPRigID` int(11) NOT NULL,
  PRIMARY KEY (`ShiftID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table fugrodemo.tblshift: ~6 rows (approximately)
/*!40000 ALTER TABLE `tblshift` DISABLE KEYS */;
INSERT INTO `tblshift` (`ShiftID`, `WorkHours`, `WorkTypeID`, `ProjectID`, `DrillerID`, `Metres`, `Date`, `StartDateTime`, `EndDateTime`, `SEPRigID`) VALUES
	(1, 4, 0, 1, 0, 20, '2016-02-02', '2016-06-11 20:30:48.0', NULL, 0),
	(2, 4, 1, 0, 1, 15, '2016-02-02', '2016-06-11 20:34:10.0', '2016-06-11 20:34:08.0', 1),
	(3, 0, 0, 1, 0, 20, '2016-04-02', '2016-06-11 20:35:06.0', '2016-06-11 20:35:07.0', 0),
	(4, 4, 0, 1, 2, 20, '2016-03-02', '2016-06-11 20:36:07.0', '2016-06-11 20:36:30.0', 0),
	(5, 0, 0, 0, 1, 10, '2016-03-02', '2016-06-11 20:37:12.0', '2016-06-11 20:37:12.0', 1),
	(6, 0, 0, 1, 0, 12, '2016-04-02', '2016-06-11 20:38:13.0', '2016-06-11 20:38:14.0', 0);
/*!40000 ALTER TABLE `tblshift` ENABLE KEYS */;


-- Dumping structure for table fugrodemo.tblworktype
CREATE TABLE IF NOT EXISTS `tblworktype` (
  `WorkTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `WorkTypeCode` varchar(45) DEFAULT NULL,
  `WorkTypeDescription` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`WorkTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table fugrodemo.tblworktype: ~7 rows (approximately)
/*!40000 ALTER TABLE `tblworktype` DISABLE KEYS */;
INSERT INTO `tblworktype` (`WorkTypeID`, `WorkTypeCode`, `WorkTypeDescription`) VALUES
	(1, 'D', 'Drilling'),
	(2, 'M', 'Mob / Demob / Move rig'),
	(3, 'W', 'Weather'),
	(4, 'SF', 'Standby Fugro'),
	(5, 'SC', 'Standby client'),
	(6, 'G', 'Grouting'),
	(7, 'P', 'Pump test');
/*!40000 ALTER TABLE `tblworktype` ENABLE KEYS */;


-- Dumping structure for table fugrodemo.tblworktypeshift
CREATE TABLE IF NOT EXISTS `tblworktypeshift` (
  `WorkTypeShiftID` int(11) NOT NULL AUTO_INCREMENT,
  `WorkTypeID` int(11) NOT NULL,
  `ShiftID` int(11) NOT NULL,
  `tblWorkTypeShiftcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`WorkTypeShiftID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table fugrodemo.tblworktypeshift: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblworktypeshift` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblworktypeshift` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
