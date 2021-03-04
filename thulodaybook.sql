-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2020 at 10:46 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thulodaybook`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `b_id` bigint(20) NOT NULL,
  `b_name` varchar(70) NOT NULL,
  `b_establishengdate` date DEFAULT NULL,
  `b_regnumber` varchar(50) DEFAULT NULL,
  `b_pan` varchar(50) DEFAULT NULL,
  `b_address` varchar(100) DEFAULT NULL,
  `b_phone` varchar(15) NOT NULL,
  `b_website` varchar(75) DEFAULT NULL,
  `b_email` varchar(120) DEFAULT NULL,
  `b_numberofstaff` int(11) DEFAULT NULL,
  `b_logo` varchar(248) DEFAULT NULL,
  `b_vat` decimal(4,2) DEFAULT NULL,
  `b_status` enum('Free','Premium') NOT NULL DEFAULT 'Free',
  `b_startdate` datetime NOT NULL DEFAULT current_timestamp(),
  `b_enddate` datetime NOT NULL DEFAULT current_timestamp(),
  `b_addedbyip` varchar(100) DEFAULT NULL,
  `b_addedbymac` varchar(100) DEFAULT NULL,
  `b_addedbydevid` varchar(100) DEFAULT NULL,
  `b_addedbylocation` varchar(100) DEFAULT NULL,
  `b_isverified` enum('Not Verified','Verified') NOT NULL DEFAULT 'Not Verified',
  `b_isdeactivated` int(11) NOT NULL DEFAULT 0,
  `b_isadded` datetime NOT NULL DEFAULT current_timestamp(),
  `b_isupdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `b_remarks` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`b_id`, `b_name`, `b_establishengdate`, `b_regnumber`, `b_pan`, `b_address`, `b_phone`, `b_website`, `b_email`, `b_numberofstaff`, `b_logo`, `b_vat`, `b_status`, `b_startdate`, `b_enddate`, `b_addedbyip`, `b_addedbymac`, `b_addedbydevid`, `b_addedbylocation`, `b_isverified`, `b_isdeactivated`, `b_isadded`, `b_isupdated`, `b_remarks`) VALUES
(1, 'Thulo Technology', '2000-01-01', 'N/A', 'N/A', 'N/A', '06752854', 'www.yourwebsite.com', '', 1, 'N/A', '13.00', 'Free', '2020-06-10 13:44:24', '2020-06-10 13:44:24', '192.168.1.145', 'mac', '', 'Lat: 28.2288521, Long: 83.9979284', 'Not Verified', 0, '2020-06-10 13:44:24', '2020-06-10 13:44:24', 'No Remarks');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `h_id` bigint(20) NOT NULL,
  `h_body` text NOT NULL,
  `h_category` varchar(20) DEFAULT NULL,
  `h_date` date NOT NULL,
  `h_isadded` datetime NOT NULL DEFAULT current_timestamp(),
  `h_isupdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `h_isdeleted` int(11) NOT NULL,
  `h_userid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`h_id`, `h_body`, `h_category`, `h_date`, `h_isadded`, `h_isupdated`, `h_isdeleted`, `h_userid`) VALUES
(1, 'New user: iambrp, successfully login through ip:  & device id.', 'New Login', '2020-06-10', '2020-06-10 13:44:46', '2020-06-10 13:44:46', 0, 1),
(2, 'New user , is created with name Bhupendra Gautam, Phone no 984652532, Role User.', 'Business is Updated.', '2020-06-10', '2020-06-10 13:45:32', '2020-06-10 13:45:32', 0, 1),
(3, 'New user: bhupendra, successfully login through ip:  & device id.', 'New Login', '2020-06-10', '2020-06-10 13:46:21', '2020-06-10 13:46:21', 0, 2),
(4, 'New user , is created with name Bijat Poudel, Phone no 9846556811, Role User.', 'Business is Updated.', '2020-06-10', '2020-06-10 13:48:40', '2020-06-10 13:48:40', 0, 2),
(5, 'New user: iambrp, successfully login through ip:  & device id.', 'New Login', '2020-06-10', '2020-06-10 13:56:55', '2020-06-10 13:56:55', 0, 1),
(6, 'New user: iambrp, successfully login through ip:  & device id.', 'New Login', '2020-06-10', '2020-06-10 13:59:43', '2020-06-10 13:59:43', 0, 1),
(7, 'New user: bhupendra, successfully login through ip:  & device id.', 'New Login', '2020-06-10', '2020-06-10 14:02:55', '2020-06-10 14:02:55', 0, 2),
(8, 'User name: bijay named Bijat Poudela id 3, as status Registered, as status User, contact 9846556811, is updated through user 3, Through IP .', 'User', '2020-06-10', '2020-06-10 14:03:20', '2020-06-10 14:03:20', 0, 3),
(9, 'User name: bijay named Bijay Poudela id 3, as status Registered, as status User, contact 9846556811, is updated through user 3, Through IP .', 'User', '2020-06-10', '2020-06-10 14:03:59', '2020-06-10 14:03:59', 0, 3),
(10, 'New user: iambrp, successfully login through ip:  & device id.', 'New Login', '2020-06-10', '2020-06-10 14:09:18', '2020-06-10 14:09:18', 0, 1),
(11, 'User name: bijay named Bijay Poudela id 3, as status Registered, as status User, contact 9846556811, is updated through user 3, Through IP .', 'User', '2020-06-10', '2020-06-10 14:09:32', '2020-06-10 14:09:32', 0, 3),
(12, 'User name: bijays named Bijay Poudela id 3, as status Registered, as status User, contact 9846556811, is updated through user 3, Through IP .', 'User', '2020-06-10', '2020-06-10 14:09:38', '2020-06-10 14:09:38', 0, 3),
(13, 'New Purchases is created with supplier: Cosmic company, Phone No: 91488, Bill no: 489, catagory: vesk, status: Paid, Amount: 81819, VAT: 10636.47.', 'Purchases', '2020-06-10', '2020-06-10 14:15:34', '2020-06-10 14:15:34', 0, 1),
(14, 'New user: iambrp, successfully login through ip:  & device id.', 'New Login', '2020-06-10', '2020-06-10 14:16:15', '2020-06-10 14:16:15', 0, 1),
(15, 'New user: iambrp, successfully login through ip:  & device id.', 'New Login', '2020-06-10', '2020-06-10 14:28:05', '2020-06-10 14:28:05', 0, 1),
(16, 'New Sales is created with customer: Bijay\n, Phone No: 7774878, Bill no: 565656, catagory: material, status: Paid, Amount: 25000, VAT: 3000.', 'Sales', '2020-06-11', '2020-06-11 14:27:01', '2020-06-11 14:27:01', 0, 1),
(17, 'New Sales is created with customer: Bijay\n, Phone No: 7774878, Bill no: 565656, catagory: material, status: Paid, Amount: 25000, VAT: 3000.', 'Sales', '2020-06-11', '2020-06-11 14:27:12', '2020-06-11 14:27:12', 0, 1),
(18, 'Sales is updated with customer: abcdefg-Updated1, Phone No: 777487841, Bill no: 56565622, catagory: material, status: Paid, Amount: 1000, VAT: 3000.', 'Sales sales updated.', '2020-06-11', '2020-06-11 14:34:22', '2020-06-11 14:34:22', 0, 1),
(19, 'Sales is updated with customer: abcdefg-Updated1, Phone No: 777487841, Bill no: 56565622, catagory: material, status: Paid, Amount: 1000, VAT: 3000.', 'Sales sales updated.', '2020-06-11', '2020-06-11 14:35:39', '2020-06-11 14:35:39', 0, 1),
(20, 'Sales is updated with customer: abcdefg-Updated1, Phone No: 777487841, Bill no: 56565622, catagory: material, status: Paid, Amount: 100, VAT: 3000.', 'Sales sales updated.', '2020-06-11', '2020-06-11 14:36:47', '2020-06-11 14:36:47', 0, 1),
(21, 'Sales is updated with customer: abcdefg-Updated1, Phone No: 777487841, Bill no: 56565622, catagory: material, status: Paid, Amount: 100, VAT: 3000.', 'Sales sales updated.', '2020-06-11', '2020-06-11 14:45:48', '2020-06-11 14:45:48', 0, 1),
(22, 'Sales is updated with customer: abcdefg-Updated1, Phone No: 777487841, Bill no: 56565622, catagory: material, status: Paid, Amount: 100, VAT: 3000.', 'Sales sales updated.', '2020-06-11', '2020-06-11 14:59:18', '2020-06-11 14:59:18', 0, 1),
(23, 'Purchases is updated with supplier: purchases_updated, Phone No: 777487841, Bill no: 56565622, catagory: material, status: Paid, Date: 2020-5-12, Amount: 5000, VAT: 300.', 'Purchase', '2020-06-11', '2020-06-11 15:12:03', '2020-06-11 15:12:03', 0, 1),
(24, 'Purchases is updated with supplier: purchases_updated, Phone No: 777487841, Bill no: 56565622, catagory: material, status: Paid, Date: 2020-5-12, Amount: 5001, VAT: 301.', 'Purchase', '2020-06-11', '2020-06-11 15:12:47', '2020-06-11 15:12:47', 0, 1),
(25, 'Purchases is updated with supplier: purchases_updated, Phone No: 777487841, Bill no: 56565622, catagory: material, status: Paid, Date: 2020-5-12, Amount: 5003, VAT: 301.', 'Purchase', '2020-06-11', '2020-06-11 15:13:11', '2020-06-11 15:13:11', 0, 1),
(26, 'New Purchases is created with supplier: Phone, Phone No: 94884, Bill no: 25, catagory: 12426, status: Paid, Amount: 250, VAT: 32.5.', 'Purchases', '2020-06-11', '2020-06-11 16:34:01', '2020-06-11 16:34:01', 0, 1),
(27, 'New Purchases is created with supplier: Phone, Phone No: 94884, Bill no: 25, catagory: 12426, status: Paid, Amount: 250, VAT: 32.5.', 'Purchases', '2020-06-11', '2020-06-11 16:38:38', '2020-06-11 16:38:38', 0, 1),
(28, 'New Purchases is created with supplier: Phone, Phone No: 94884, Bill no: 25, catagory: 12426, status: Paid, Amount: 250, VAT: 32.5.', 'Purchases', '2020-06-11', '2020-06-11 16:39:33', '2020-06-11 16:39:33', 0, 1),
(29, 'Changed the password.', 'User', '2020-06-14', '2020-06-14 11:54:51', '2020-06-14 11:54:51', 0, 1),
(30, 'New Purchases is created with supplier: Phone, Phone No: 94884, Bill no: 25, catagory: 12426, status: Paid, Amount: 250, VAT: 32.5.', 'Purchases', '2020-06-14', '2020-06-14 12:09:55', '2020-06-14 12:09:55', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `l_id` bigint(20) NOT NULL,
  `l_addedbyip` varchar(100) DEFAULT NULL,
  `l_addedbymac` varchar(100) DEFAULT NULL,
  `l_addedbydevid` varchar(100) DEFAULT NULL,
  `l_addedbylocation` varchar(100) DEFAULT NULL,
  `l_userid` bigint(20) NOT NULL,
  `l_isadded` datetime NOT NULL DEFAULT current_timestamp(),
  `l_isupdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(250) NOT NULL,
  `p_phone` varchar(20) NOT NULL,
  `P_billno` varchar(20) DEFAULT NULL,
  `p_category` varchar(250) DEFAULT NULL,
  `p_status` varchar(250) DEFAULT NULL,
  `p_date` date NOT NULL,
  `p_amount` decimal(13,2) NOT NULL,
  `p_vatamount` decimal(13,2) NOT NULL DEFAULT 0.00,
  `p_image` varchar(256) DEFAULT NULL,
  `p_remarks` varchar(200) DEFAULT NULL,
  `p_isadded` datetime NOT NULL DEFAULT current_timestamp(),
  `p_isupdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `p_isdeleted` int(11) NOT NULL,
  `p_userid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`p_id`, `p_name`, `p_phone`, `P_billno`, `p_category`, `p_status`, `p_date`, `p_amount`, `p_vatamount`, `p_image`, `p_remarks`, `p_isadded`, `p_isupdated`, `p_isdeleted`, `p_userid`) VALUES
(1, 'purchases_updated', '777487841', '56565622', 'material', 'Paid', '2020-05-12', '5003.00', '301.00', 'No Image', 'Completely Purchased111', '2020-06-10 14:15:34', '2020-06-11 15:13:11', 0, 1),
(2, 'Phone', '94884', '25', '12426', 'Paid', '2020-06-09', '250.00', '32.50', 'aX_429a572303d3cf06ac5169ab1df229d4en_29888364.jpg', 'okay', '2020-06-11 16:34:01', '2020-06-11 16:34:01', 0, 1),
(3, 'Phone', '94884', '25', '12426', 'Paid', '2020-06-09', '250.00', '32.50', 'aX_429a572303d3cf06ac5169ab1df229d4en_29888364.jpg', 'okay', '2020-06-11 16:38:37', '2020-06-11 16:38:37', 0, 1),
(4, 'Phone', '94884', '25', '12426', 'Paid', '2020-06-09', '250.00', '32.50', 'aX_429a572303d3cf06ac5169ab1df229d4en_29888364.jpg', 'okay', '2020-06-11 16:39:33', '2020-06-11 16:39:33', 0, 1),
(5, 'Phone', '94884', '25', '12426', 'Paid', '2020-06-09', '250.00', '32.50', 'aX_429a572303d3cf06ac5169ab1df229d4en_29888364.jpg', 'okay', '2020-06-14 12:09:55', '2020-06-14 12:09:55', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(250) NOT NULL,
  `s_phone` varchar(20) NOT NULL,
  `s_billno` varchar(20) NOT NULL,
  `s_category` varchar(250) DEFAULT NULL,
  `s_status` varchar(250) DEFAULT NULL,
  `s_date` date NOT NULL,
  `s_amount` decimal(13,2) NOT NULL,
  `s_vatamount` decimal(13,2) NOT NULL DEFAULT 0.00,
  `s_image` varchar(256) DEFAULT NULL,
  `s_remarks` varchar(200) DEFAULT NULL,
  `s_isadded` datetime NOT NULL DEFAULT current_timestamp(),
  `s_isupdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `s_isdeleted` int(11) NOT NULL,
  `s_userid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`s_id`, `s_name`, `s_phone`, `s_billno`, `s_category`, `s_status`, `s_date`, `s_amount`, `s_vatamount`, `s_image`, `s_remarks`, `s_isadded`, `s_isupdated`, `s_isdeleted`, `s_userid`) VALUES
(1, 'Bijay\n', '7774878', '565656', 'material', 'Paid', '2020-06-09', '25000.00', '3000.00', 'Abc', 'Completely Sold', '2020-06-11 14:27:00', '2020-06-11 14:27:00', 0, 1),
(2, 'abcdefg-Updated1', '777487841', '56565622', 'material', 'Paid', '2020-05-12', '100.00', '3000.00', 'Abc', 'Completely Sold111', '2020-06-11 14:27:12', '2020-06-11 14:45:48', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` bigint(20) NOT NULL,
  `u_fname` varchar(100) NOT NULL,
  `u_lname` varchar(100) NOT NULL,
  `u_name` varchar(100) NOT NULL,
  `u_password` varchar(256) NOT NULL,
  `u_password2` varchar(256) DEFAULT NULL,
  `u_status` enum('Registered','Unregistered') DEFAULT NULL,
  `u_regdate` datetime DEFAULT current_timestamp(),
  `u_lastlogin` datetime NOT NULL DEFAULT current_timestamp(),
  `u_role` enum('Superadmin','Admin','User') NOT NULL,
  `u_email` varchar(250) NOT NULL,
  `u_contact` varchar(15) DEFAULT NULL,
  `u_remarks` varchar(500) DEFAULT 'N/A',
  `u_isadded` datetime NOT NULL DEFAULT current_timestamp(),
  `u_image` varchar(355) DEFAULT NULL,
  `u_isupdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `u_isdeactivated` int(11) NOT NULL DEFAULT 0,
  `u_isdeleted` int(11) NOT NULL DEFAULT 0,
  `business_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_fname`, `u_lname`, `u_name`, `u_password`, `u_password2`, `u_status`, `u_regdate`, `u_lastlogin`, `u_role`, `u_email`, `u_contact`, `u_remarks`, `u_isadded`, `u_image`, `u_isupdated`, `u_isdeactivated`, `u_isdeleted`, `business_id`) VALUES
(1, 'Bishworaj', 'Poudel', 'iambrp', 'K872dNPPuqDuU36yajw1ng==', NULL, 'Registered', '2020-06-10 13:44:24', '2020-06-10 13:44:24', 'Superadmin', '', '06752854', 'N/A', '2020-06-10 13:44:24', 'N/A', '2020-06-10 13:44:24', 0, 0, 1),
(2, 'Bhupendra', 'Gautam', 'bhupendra', 'QaFs8FxbgAAuPdYUsOUZqw==', NULL, 'Registered', '2020-06-10 13:45:32', '2020-06-10 13:45:32', 'User', 'iambrp.tech@gmail.com', '984652532', '', '2020-06-10 13:45:32', NULL, '2020-06-10 13:45:32', 0, 0, 1),
(3, 'Bijay', 'Poudela', 'bijays', 'K872dNPPuqDuU36yajw1ng==', NULL, 'Registered', '2020-06-10 13:48:40', '2020-06-10 13:48:40', 'User', 'bijay@gmail.com', '9846556811', '', '2020-06-10 13:48:40', NULL, '2020-06-10 14:09:38', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`h_id`),
  ADD KEY `h_userid` (`h_userid`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`l_id`),
  ADD KEY `l_userid` (`l_userid`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `p_userid` (`p_userid`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `s_userid` (`s_userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_name` (`u_name`),
  ADD KEY `business_id` (`business_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `b_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `h_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `l_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`h_userid`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `login_details`
--
ALTER TABLE `login_details`
  ADD CONSTRAINT `login_details_ibfk_1` FOREIGN KEY (`l_userid`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`p_userid`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`s_userid`) REFERENCES `users` (`u_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `business` (`b_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
