-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2025 at 11:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartbox_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActiveRentals` ()   BEGIN
SELECT COUNT(*) as total FROM smart_report WHERE session != 'EXPIRE' AND date_created = CURRENT_DATE();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_AccountForgotPasswordValidation` (IN `email` VARCHAR(50))   BEGIN 
DECLARE isAccountExist INT DEFAULT 0;
SELECT COUNT(*) INTO isAccountExist FROM smart_users SU WHERE SU.email = email; 
IF isAccountExist > 0 THEN
SELECT SU.* FROM smart_users SU WHERE SU.email = email;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_accountNotificationList` (IN `account_id` INT(11))   BEGIN
SELECT COUNT(*) as notif,activity,DATE(loggedDate) FROM `smart_lockercredentials_logs` WHERE accountid = account_id GROUP BY DATE(loggedDate),activity;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_AccountSessionNotifCount` (IN `account_id` INT(11))   BEGIN 
SELECT COUNT(DISTINCT activity) as notif FROM `smart_lockercredentials_logs` WHERE accountid = account_id GROUP BY DATE(loggedDate);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_checkLogs` ()   BEGIN 
SELECT SUL.* FROM smart_users_logs SUL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_CreateUserAccount` (IN `image` VARCHAR(255), IN `firstname` VARCHAR(50), IN `lastname` VARCHAR(50), IN `contact` VARCHAR(50), IN `email` VARCHAR(50), IN `password` VARCHAR(255), IN `unhashed` VARCHAR(50), IN `code` INT(11))   BEGIN 
DECLARE isAccountExisting INT DEFAULT 0; 
SELECT COUNT(*) INTO isAccountExisting FROM smart_users SU WHERE SU.email = email; 
IF isAccountExisting = 0 THEN 
INSERT INTO smart_users (image,firstname,lastname,contact,email,password,unhashed,code) VALUES (image,firstname,lastname,contact,email,password,unhashed,code); 
INSERT INTO smart_users_logs (user_id, image, firstname, lastname, contact, email, password, unhashed, code, status)
SELECT user_id, image, firstname, lastname, contact, email, password, unhashed, code, status FROM smart_users WHERE email = email;
SELECT SU.* FROM smart_users SU WHERE SU.email = email;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_CreateUserAccountUpdateCredentials` (IN `code` INT(11), IN `password` VARCHAR(255), IN `unhashed` VARCHAR(50))   BEGIN
DECLARE isAccountExist INT DEFAULT 0;
SELECT COUNT(*) INTO isAccountExist FROM smart_users SU WHERE SU.code = code;
IF isAccountExist > 0 THEN
UPDATE smart_users SET password = password, unhashed = unhashed WHERE code = code;
INSERT INTO smart_users_logs (user_id, image, firstname, lastname, contact, email, password, unhashed, code, status) SELECT user_id, image, firstname, lastname, contact, email, password, unhashed, code, status FROM smart_users WHERE code = code;
SELECT SU.* FROM smart_users SU WHERE SU.code = code;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_CreateUserAccountVerification` (IN `code` INT(11))   BEGIN 
DECLARE isAccountExist INT DEFAULT 0;
SELECT COUNT(*) INTO isAccountExist FROM smart_users SU WHERE SU.code = code;
IF isAccountExist > 0 THEN
UPDATE smart_users SET status = 'VERIFIED' WHERE code = code; 
INSERT INTO smart_users_logs (user_id, image, firstname, lastname, contact, email, password, unhashed, code, status) SELECT user_id, image, firstname, lastname, contact, email, password, unhashed, code, status FROM smart_users WHERE code = code;
SELECT SU.* FROM smart_users SU WHERE SU.code = code;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_LockerAccountLockerUpdate` (IN `account_id` INT(11), IN `lockerStatus` VARCHAR(50))   BEGIN
INSERT INTO smart_lockercredentials_logs (accountid,activity) VALUES (account_id,lockerStatus);
UPDATE smart_lockercredentials SLC SET SLC.lockerStatus = lockerStatus WHERE SLC.account_id = account_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_LockerAccountSession` (IN `account_id` INT(11))   BEGIN
INSERT INTO smart_lockercredentials_logs (accountid,activity) VALUES (account_id,'sign-in');
SELECT SR.account_id as account_id,SR.locker_id as lock_id,SR.phone as phone,SR.email as email, SR.name as fullname,SR.validationStatus as AccountValidation,SLC.pincode as password,SLC.status as LockerValidation,SRP.status as PaymentStatus, SL.locker as locker, SL.size as size,SR.hours as Hours,SR.date_created as DateStart, DATE_ADD(SR.date_created, INTERVAL SR.hours HOUR) AS EndDate, SLC.lockerStatus as lockerStat, SR.session as session FROM smart_report SR LEFT JOIN smart_lockercredentials SLC ON SR.account_id = SLC.account_id LEFT JOIN smart_reportpayment SRP ON SR.account_id = SRP.account_id LEFT JOIN smart_locker SL ON SR.locker_id = SL.id WHERE SR.account_id = account_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_LockerAccountSessionAdmin` (IN `user_id` INT(11))   BEGIN
SELECT SU.* FROM smart_users SU WHERE SU.user_id = user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_lockerAccountSpecificView` (IN `code` INT(11))   BEGIN
DECLARE isAccountExisting INT DEFAULT 0;
SELECT COUNT(*) INTO isAccountExisting FROM smart_report SR WHERE SR.code = code;
IF isAccountExisting > 0 THEN
SELECT SR.* FROM smart_report SR WHERE SR.code = code;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_lockerAccountSpecificViewUpdate` (IN `code` INT(11))   BEGIN
DECLARE isAccountExisting INT DEFAULT 0;
SELECT COUNT(*) INTO isAccountExisting FROM smart_report SR WHERE SR.code = code;
IF isAccountExisting > 0 THEN
UPDATE smart_report SR SET SR.validationStatus = 'VERIFIED' WHERE SR.code = code;
SELECT SR.* FROM smart_report SR WHERE SR.code = code;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_lockerCreation` (IN `locker` VARCHAR(50), IN `size` VARCHAR(50), IN `dimension` VARCHAR(50), IN `price` DOUBLE(5,2), IN `access` VARCHAR(50))   BEGIN
INSERT INTO smart_locker (locker,size,dimension,price,access) VALUES (locker,size,dimension,price,access);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_lockerCredentials` (IN `account_id` INT(11), IN `pincode` INT(50), IN `code` INT(11))   BEGIN 
DECLARE isAccountExisting INT DEFAULT 0;
SELECT COUNT(*) INTO isAccountExisting FROM smart_lockercredentials SLC WHERE SLC.account_id = account_id;
IF isAccountExisting = 0 THEN 
INSERT INTO smart_lockercredentials (account_id,pincode,code,lockerStatus) VALUE (account_id,pincode,code,'unlocked');
SELECT SLC.* FROM smart_lockercredentials SLC WHERE SLC.account_id = account_id;
ELSE 
UPDATE smart_lockercredentials SLC SET SLC.pincode = pincode WHERE SLC.account_id = account_id;
SELECT SLC.* FROM smart_lockercredentials SLC WHERE SLC.account_id = account_id;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_lockercredentialsSpecificView` (IN `account_id` INT(11), IN `pincode` INT(50))   BEGIN
DECLARE isAccountExistent INT DEFAULT 0;
SELECT COUNT(*) INTO isAccountExistent FROM smart_lockercredentials SLC WHERE SLC.account_id = account_id;
IF isAccountExistent > 0 THEN 
UPDATE smart_lockercredentials SET status = 'VERIFIED' WHERE account_id = account_id AND pincode = pincode;
SELECT SLC.* FROM smart_lockercredentials SLC WHERE SLC.account_id = account_id;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_lockerCredentialUpdateTerms` (IN `account_id` INT(11), IN `terms` VARCHAR(50))   BEGIN
DECLARE isAccountExist INT DEFAULT 0;
SELECT COUNT(*) INTO isAccountExist FROM smart_lockercredentials SLC WHERE SLC.account_id = account_id;
IF isAccountExist > 0 THEN
UPDATE smart_lockercredentials SLC SET SLC.terms = terms WHERE SLC.account_id = account_id;  
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_lockerServiceExpire` (IN `account_id` INT(11), IN `locker_id` INT(11))   BEGIN
UPDATE smart_locker sl SET sl.status = 'AVAILABLE' WHERE sl.id = locker_id;
UPDATE smart_report sr SET sr.session = 'EXPIRE' WHERE sr.account_id = account_id;
UPDATE smart_lockercredentials SLC SET SLC.lockerStatus = 'unlocked' WHERE SLC.account_id = account_id;
SELECT SR.name as name, SR.phone, SR.email FROM smart_report SR WHERE SR.account_id = account_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_lockerSpecificView` (IN `id` INT(11))   BEGIN 
DECLARE isLockerCount INT DEFAULT 0;
SELECT COUNT(*) INTO isLockerCount FROM smart_locker SL WHERE SL.id = id;
IF isLockerCount > 0 THEN
SELECT SL.* FROM smart_locker SL WHERE SL.id = id;
ELSE
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'There is no locker in that id';
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_lockerView` ()   BEGIN 
SELECT SL.* FROM smart_locker SL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_profits` ()   BEGIN
SELECT SUM(price) as total FROM smart_report WHERE date_created = CURRENT_DATE();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_rents` ()   BEGIN
SELECT COUNT(*) as total FROM smart_report WHERE date_created = CURRENT_DATE();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_ReportCreation` (IN `locker_id` INT(11), IN `name` VARCHAR(50), IN `phone` VARCHAR(50), IN `email` VARCHAR(50), IN `hours` INT(11), IN `price` DOUBLE(5,2), IN `payment` VARCHAR(50), IN `code` INT(11))   BEGIN
INSERT INTO smart_report (locker_id,name,phone,email,hours,price,payment,code) VALUES (locker_id,name,phone,email,hours,price,payment,code);
SELECT SR.* FROM smart_report SR WHERE SR.code = code;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_reportLoginLocker` (IN `pincode` INT(50))   BEGIN
SELECT SR.account_id as account_id,SR.locker_id as lock_id,SR.phone as phone,SR.email as email, SR.name as fullname,SR.validationStatus as AccountValidation,SLC.pincode as password,SLC.status as LockerValidation,SRP.status as PaymentStatus, SL.locker as locker,SR.hours as Hours,SR.date_created as DateStart, DATE_ADD(SR.date_created, INTERVAL SR.hours HOUR) AS EndDate, SLL.accountid as checkAccountLogin,SLC.terms as terms, SR.session as session FROM smart_report SR LEFT JOIN smart_lockercredentials SLC ON SR.account_id = SLC.account_id LEFT JOIN smart_reportpayment SRP ON SR.account_id = SRP.account_id LEFT JOIN smart_locker SL ON SR.locker_id = SL.id LEFT JOIN smart_lockercredentials_logs SLL ON SR.account_id = SLL.accountid WHERE SLC.pincode = pincode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_ReportPaymentCreation` (IN `account_id` INT(11), IN `code` INT(11), IN `src_id` VARCHAR(50), IN `src_link` TEXT)   BEGIN 
DECLARE isExistingCode INT DEFAULT 0;
SELECT COUNT(*) INTO isExistingCode FROM smart_reportpayment SRP WHERE SRP.code = code; 
IF isExistingCode = 0 THEN
INSERT INTO smart_reportpayment (account_id,code,src_id,src_link) VALUES (account_id,code,src_id,src_link);
SELECT SRP.* FROM smart_reportpayment SRP WHERE SRP.code= code;
ELSE 
SELECT SRP.* FROM smart_reportpayment SRP WHERE SRP.code= code;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_ReportPaymentView` (IN `code` INT(11))   BEGIN 
DECLARE isAccountPaymentReport INT DEFAULT 0;
SELECT COUNT(*) INTO isAccountPaymentReport FROM smart_reportpayment SRP WHERE SRP.code = code;
IF isAccountPaymentReport > 0 THEN
SELECT SRP.* FROM smart_reportpayment SRP WHERE SRP.code = code;
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_ReportPaymentViewUpdateStatus` (IN `status` VARCHAR(50), IN `code` INT(11))   BEGIN 
UPDATE smart_locker SL SET SL.status = 'Occupied' WHERE SL.id IN (SELECT SR.locker_id FROM smart_report SR WHERE SR.code = code);
UPDATE smart_reportpayment SRP SET SRP.status = status WHERE SRP.code = code;
SELECT * FROM smart_report SR LEFT JOIN smart_reportpayment SRP ON SR.account_id = SRP.account_id WHERE SR.code = code;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_ReportView` ()   BEGIN 
SELECT SR.account_id as account_id, SR.locker_id as locker_id , SL.locker AS locker, SR.name AS name, SR.email AS email, SR.phone AS phone, SL.size AS size, SL.price AS price, SR.price AS total, SR.hours AS hours, SR.date_created AS date_created, DATE_ADD(SR.date_created, INTERVAL SR.hours HOUR) AS date_start,DATE_ADD(DATE_ADD(SR.date_created, INTERVAL SR.hours HOUR), INTERVAL SR.hours HOUR) AS date_end FROM smart_report SR LEFT JOIN smart_lockercredentials SLC ON SR.account_id = SLC.account_id LEFT JOIN smart_locker SL ON SL.id = SR.locker_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_reportViewGraph` ()   BEGIN
SELECT date_created as date, COUNT(*) as total FROM smart_report WHERE date_created >= CURDATE() - INTERVAL 14 DAY ORDER BY date_created DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_UserAccountAdminLogin` (IN `email` VARCHAR(50), IN `password` VARCHAR(255))   BEGIN
    DECLARE isAccountExisting INT DEFAULT 0;
    
    SELECT COUNT(*) INTO isAccountExisting 
    FROM smart_users SU 
    WHERE SU.email = email AND SU.password = password;

    IF isAccountExisting > 0 THEN
        INSERT INTO smart_users_history (user_id, activity)
        SELECT user_id, 'LOGGED IN' 
        FROM smart_users SU 
        WHERE SU.email = email AND SU.password = password;
        SELECT SU.user_id, SU.email, SU.firstname, SU.lastname, SU.contact
        FROM smart_users SU
        WHERE SU.email = email AND SU.password = password;
    ELSE
        SELECT 'Account does not exist or invalid credentials' AS message;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_usersAdmin` ()   BEGIN 
SELECT SU.* FROM smart_users SU;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `smart_usershistory` (IN `user_id` INT(11))   BEGIN 
SELECT SUH.* FROM smart_users_history SUH WHERE SUH.user_id = user_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `smart_locker`
--

CREATE TABLE `smart_locker` (
  `id` int(11) NOT NULL,
  `locker` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `dimension` varchar(50) NOT NULL,
  `price` double(5,2) NOT NULL,
  `status` varchar(50) DEFAULT 'Available',
  `access` varchar(50) DEFAULT NULL,
  `date_created` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smart_locker`
--

INSERT INTO `smart_locker` (`id`, `locker`, `size`, `dimension`, `price`, `status`, `access`, `date_created`) VALUES
(1, '001', 'Medium', '136mm x 125mm', 120.00, 'Occupied', 'Unlock', '2025-02-08');

-- --------------------------------------------------------

--
-- Table structure for table `smart_lockercredentials`
--

CREATE TABLE `smart_lockercredentials` (
  `lockercred` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `pincode` int(50) NOT NULL,
  `code` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'UNVERIFIED',
  `lockerStatus` varchar(50) NOT NULL,
  `terms` varchar(50) NOT NULL DEFAULT 'un-signed',
  `date_created` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smart_lockercredentials`
--

INSERT INTO `smart_lockercredentials` (`lockercred`, `account_id`, `pincode`, `code`, `status`, `lockerStatus`, `terms`, `date_created`) VALUES
(1, 1, 123456, 8077, 'VERIFIED', 'unlocked', 'signed', '2025-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `smart_lockercredentials_logs`
--

CREATE TABLE `smart_lockercredentials_logs` (
  `logid` int(11) NOT NULL,
  `accountid` int(11) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `loggedDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smart_lockercredentials_logs`
--

INSERT INTO `smart_lockercredentials_logs` (`logid`, `accountid`, `activity`, `loggedDate`) VALUES
(1, 1, 'sign-in', '2025-02-11 14:14:32'),
(2, 1, 'sign-in', '2025-02-11 14:14:36'),
(3, 1, 'sign-in', '2025-02-11 14:14:36'),
(4, 1, 'sign-in', '2025-02-11 14:14:39'),
(5, 1, 'sign-in', '2025-02-11 14:14:42'),
(6, 1, 'sign-in', '2025-02-11 14:14:45'),
(7, 1, 'locked', '2025-02-11 14:14:45'),
(8, 1, 'sign-in', '2025-02-11 14:14:48'),
(9, 1, 'sign-in', '2025-02-11 14:14:59'),
(10, 1, 'sign-in', '2025-02-11 14:15:02'),
(11, 1, 'sign-in', '2025-02-11 14:15:03'),
(12, 1, 'unlocked', '2025-02-11 14:15:03'),
(13, 1, 'sign-in', '2025-02-11 14:15:06'),
(14, 1, 'sign-in', '2025-02-11 14:15:19'),
(15, 1, 'sign-in', '2025-02-11 14:15:26'),
(16, 1, 'sign-in', '2025-02-11 14:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `smart_report`
--

CREATE TABLE `smart_report` (
  `account_id` int(11) NOT NULL,
  `locker_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hours` int(11) NOT NULL,
  `price` double(5,2) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `code` int(11) NOT NULL,
  `validationStatus` varchar(50) DEFAULT 'UN-VERIFIED',
  `session` varchar(50) NOT NULL DEFAULT 'VALID',
  `date_created` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smart_report`
--

INSERT INTO `smart_report` (`account_id`, `locker_id`, `name`, `phone`, `email`, `hours`, `price`, `payment`, `code`, `validationStatus`, `session`, `date_created`) VALUES
(1, 1, 'Sherwin', '09171439388', 'gmfacistol@outlook.com', 5, 600.00, 'GCash', 6749, 'VERIFIED', 'VALID', '2025-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `smart_reportpayment`
--

CREATE TABLE `smart_reportpayment` (
  `payid` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `src_id` varchar(50) NOT NULL,
  `src_link` text NOT NULL,
  `status` varchar(50) DEFAULT 'IN-PROGRESS',
  `created_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smart_reportpayment`
--

INSERT INTO `smart_reportpayment` (`payid`, `account_id`, `code`, `src_id`, `src_link`, `status`, `created_date`) VALUES
(1, 1, 6749, 'https://test-sources.paymongo.com/sources?id=src_c', 'src_cZZfZ9T2PBdiwZYUdx7bqgvS', 'SUCCESS', '2025-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `smart_users`
--

CREATE TABLE `smart_users` (
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `unhashed` varchar(50) NOT NULL,
  `code` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'UNVERIFIED',
  `date_created` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smart_users`
--

INSERT INTO `smart_users` (`user_id`, `image`, `firstname`, `lastname`, `contact`, `email`, `password`, `unhashed`, `code`, `status`, `date_created`) VALUES
(1, 'locker.PNG', 'Sherwin', 'Sherwin', '0916653189', 'gmfacistol@outlook.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 9688, 'VERIFIED', '2025-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `smart_users_history`
--

CREATE TABLE `smart_users_history` (
  `sid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `date_created` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smart_users_history`
--

INSERT INTO `smart_users_history` (`sid`, `user_id`, `activity`, `date_created`) VALUES
(1, 1, 'LOGGED IN', '2025-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `smart_users_logs`
--

CREATE TABLE `smart_users_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `unhashed` varchar(50) NOT NULL,
  `code` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smart_users_logs`
--

INSERT INTO `smart_users_logs` (`log_id`, `user_id`, `image`, `firstname`, `lastname`, `contact`, `email`, `password`, `unhashed`, `code`, `status`, `date_created`) VALUES
(1, 1, 'locker.PNG', 'Sherwin', 'Sherwin', '0916653189', 'gmfacistol@outlook.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 9688, 'UNVERIFIED', '2025-02-11 14:16:09'),
(2, 1, 'locker.PNG', 'Sherwin', 'Sherwin', '0916653189', 'gmfacistol@outlook.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 9688, 'VERIFIED', '2025-02-11 14:16:23'),
(3, 1, 'locker.PNG', 'Sherwin', 'Sherwin', '0916653189', 'gmfacistol@outlook.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 9688, 'VERIFIED', '2025-02-11 14:17:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `smart_locker`
--
ALTER TABLE `smart_locker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smart_lockercredentials`
--
ALTER TABLE `smart_lockercredentials`
  ADD PRIMARY KEY (`lockercred`);

--
-- Indexes for table `smart_lockercredentials_logs`
--
ALTER TABLE `smart_lockercredentials_logs`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `smart_report`
--
ALTER TABLE `smart_report`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `smart_reportpayment`
--
ALTER TABLE `smart_reportpayment`
  ADD PRIMARY KEY (`payid`);

--
-- Indexes for table `smart_users`
--
ALTER TABLE `smart_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `smart_users_history`
--
ALTER TABLE `smart_users_history`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `smart_users_logs`
--
ALTER TABLE `smart_users_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `smart_locker`
--
ALTER TABLE `smart_locker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smart_lockercredentials`
--
ALTER TABLE `smart_lockercredentials`
  MODIFY `lockercred` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smart_lockercredentials_logs`
--
ALTER TABLE `smart_lockercredentials_logs`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `smart_report`
--
ALTER TABLE `smart_report`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smart_reportpayment`
--
ALTER TABLE `smart_reportpayment`
  MODIFY `payid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smart_users`
--
ALTER TABLE `smart_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smart_users_history`
--
ALTER TABLE `smart_users_history`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smart_users_logs`
--
ALTER TABLE `smart_users_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
