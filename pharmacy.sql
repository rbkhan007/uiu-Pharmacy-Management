 -- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2021 at 08:20 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentials`
--

CREATE TABLE `admin_credentials` (
  `USERNAME` varchar(50) COLLATE utf16_bin NOT NULL,
  `PASSWORD` varchar(50) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `admin_credentials`
--

INSERT INTO `admin_credentials` (`USERNAME`, `PASSWORD`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(20) COLLATE utf16_bin NOT NULL,
  `CONTACT_NUMBER` varchar(10) COLLATE utf16_bin NOT NULL,
  `ADDRESS` varchar(100) COLLATE utf16_bin NOT NULL,
  `DOCTOR_NAME` varchar(20) COLLATE utf16_bin NOT NULL,
  `DOCTOR_ADDRESS` varchar(100) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `customers`
--
INSERT INTO `customers` (`ID`, `NAME`, `CONTACT_NUMBER`, `ADDRESS`, `DOCTOR_NAME`, `DOCTOR_ADDRESS`) VALUES
(1, 'Rakibul Hasan', '0171234567', 'Dhaka, Bangladesh', 'Dr. Ahsan', 'Apollo Hospital, Dhaka'),
(2, 'Mehedi Hasan', '0181234567', 'Chittagong, Bangladesh', 'Dr. Salim', 'Chittagong Medical, Chittagong'),
(3, 'Fatema Begum', '0191234567', 'Sylhet, Bangladesh', 'Dr. Asif', 'Sylhet MAG Osmani Medical College, Sylhet'),
(4, 'Shamim Khan', '0151234567', 'Rajshahi, Bangladesh', 'Dr. Tariq', 'Rajshahi Medical College, Rajshahi'),
(5, 'Nasrin Akter', '0161234567', 'Khulna, Bangladesh', 'Dr. Farzana', 'Khulna Medical College, Khulna');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `INVOICE_ID` int(11) NOT NULL,
  `NET_TOTAL` double NOT NULL DEFAULT 0,
  `INVOICE_DATE` date NOT NULL DEFAULT current_timestamp(),
  `CUSTOMER_ID` int(11) NOT NULL,
  `TOTAL_AMOUNT` double NOT NULL,
  `TOTAL_DISCOUNT` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`INVOICE_ID`, `NET_TOTAL`, `INVOICE_DATE`, `CUSTOMER_ID`, `TOTAL_AMOUNT`, `TOTAL_DISCOUNT`) VALUES
(1, 30, '2024-10-02', 14, 30, 0),
(2, 2626, '2024-10-02', 6, 2626, 0),
(3, 500, '2024-10-02', 12, 550, 50),
(4, 1200, '2024-10-02', 9, 1300, 100),
(5, 750, '2024-10-02', 15, 800, 50);
-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `PACKING` varchar(20) COLLATE utf16_bin NOT NULL,
  `GENERIC_NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `SUPPLIER_NAME` varchar(100) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
 
--
-- Dumping data for table `medicines`

INSERT INTO `medicines` (`ID`, `NAME`, `PACKING`, `GENERIC_NAME`, `SUPPLIER_NAME`) VALUES
(1, 'Nicip Plus', '10 tab', 'Paracetamol', 'BDPL Pharma'),
(2, 'Crosin', '10 tab', 'Acetaminophen', 'Kiran Pharma'),
(3, 'Dolo 650', '15 tab', 'Paracetamol', 'BDPL Pharma'),
(4, 'Gelusil', '10 tab', 'Aluminum Hydroxide + Magnesium Hydroxide', 'Desai Pharma');

-- --------------------------------------------------------

--
-- Table structure for table `medicines_stock`
--

CREATE TABLE `medicines_stock` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `BATCH_ID` varchar(20) COLLATE utf16_bin NOT NULL,
  `EXPIRY_DATE` varchar(10) COLLATE utf16_bin NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `MRP` double NOT NULL,
  `RATE` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `medicines_stock`
--

INSERT INTO `medicines_stock` (`ID`, `NAME`, `BATCH_ID`, `EXPIRY_DATE`, `QUANTITY`, `MRP`, `RATE`) VALUES
(1, 'Crosin', 'CROS12', '12/34', 2, 26.26, 26),
(2, 'Gelusil', 'G327', '12/42', 0, 15.00, 12),
(3, 'Dolo 650', 'DOLO327', '01/23', 3, 30.00, 24),
(4, 'Nicip Plus', 'NI325', '05/22', 3, 32.65, 28);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `SUPPLIER_NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `INVOICE_NUMBER` int(11) NOT NULL,
  `VOUCHER_NUMBER` int(11) NOT NULL,
  `PURCHASE_DATE` varchar(10) COLLATE utf16_bin NOT NULL,
  `TOTAL_AMOUNT` double NOT NULL,
  `PAYMENT_STATUS` varchar(20) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) COLLATE utf16_bin NOT NULL,
  `EMAIL` varchar(100) COLLATE utf16_bin NOT NULL,
  `CONTACT_NUMBER` varchar(10) COLLATE utf16_bin NOT NULL,
  `ADDRESS` varchar(100) COLLATE utf16_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `suppliers`

INSERT INTO `suppliers` (`ID`, `NAME`, `EMAIL`, `CONTACT_NUMBER`, `ADDRESS`) VALUES
(1, 'Desai Pharma', 'desai@gmail.com', '9948724242', 'Mahim East, Mumbai, India'),
(2, 'BDPL Pharma', 'bdpl@gmail.com', '8645632963', 'Dhaka, Bangladesh'),
(9, 'Kiran Pharma', 'kiranpharma@gmail.com', '7638683637', 'Chittagong, Bangladesh'),
(12, 'SS Distributors', 'ssdis@gmail.com', '3867868752', 'Rajshahi, Bangladesh'),
(13, 'Avceve Pharma', 'avceve@gmail.com', '3466626226', 'Sylhet, Bangladesh'),
(15, 'HealthMart Distributors', 'healthmart@gmail.com', '6553838835', 'Khulna, Bangladesh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_credentials`
--
ALTER TABLE `admin_credentials`
  ADD PRIMARY KEY (`USERNAME`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`INVOICE_ID`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `BATCH_ID` (`BATCH_ID`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`VOUCHER_NUMBER`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `INVOICE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medicines_stock`
--
ALTER TABLE `medicines_stock`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `VOUCHER_NUMBER` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
