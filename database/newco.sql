-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2021 at 12:21 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newco`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_assistant` (`pName` VARCHAR(45), `pSurname` VARCHAR(45), `pShopID` INT)  BEGIN
	INSERT INTO assistants(Name, Surname, ShopID) VALUES (pName, pSurname, pShopID);
    
    SELECT a.ID AS 'ID', 
			a.Name AS 'Name', 
            a.Surname AS 'Surname', 
            s.Name AS 'ShopName' 
		FROM assistants a 
        INNER JOIN shops s ON s.ID = a.ShopID 
        WHERE a.ID = (SELECT LAST_INSERT_ID());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_customer` (`pName` VARCHAR(256), `pSurname` VARCHAR(256), `pAddress` VARCHAR(256), `pPhoneNumber` VARCHAR(256))  BEGIN
	INSERT INTO customers (Name, Surname, Address, PhoneNumber) VALUES (pName, pSurname, pAddress, pPhoneNumber);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_product` (`pDescription` VARCHAR(256), `pValidity` DATE, `pState` TINYINT, `pStock` INT, `pServiceDescription` VARCHAR(256), `pServicePrice` FLOAT, `pServiceActive` TINYINT)  BEGIN
	DECLARE pProductID INT;

	INSERT INTO products(Description, Validity, State, Stock) VALUES (pDescription, pValidity, pState, pStock);
    SET pProductID = (SELECT LAST_INSERT_ID());
    
    INSERT INTO services (ProductID, Description, Price, Active)
		VALUES (pProductID, pServiceDescription, pServicePrice, pServiceActive);
        
	SELECT pProductID AS 'NewProductID';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_service` (`pProductID` INT, `pDescription` VARCHAR(256), `pPrice` FLOAT, `pActive` TINYINT)  BEGIN
	INSERT INTO services (ProductID, Description, Price, Active) VALUES (pProductID, pDescription, pPrice, pActive);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_shop` (`pName` VARCHAR(256), `pCity` VARCHAR(256))  BEGIN
	
    INSERT INTO shops(Name, City) VALUES (pName, pCity);
    
    SELECT * FROM shops WHERE ID = (SELECT LAST_INSERT_ID());
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_service` (`pServiceID` INT)  BEGIN
	DELETE FROM services WHERE ID = pServiceID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_assistant` (`pID` INT, `pShopID` INT, `pName` VARCHAR(45), `pSurname` VARCHAR(45))  BEGIN
	UPDATE assistants SET ShopID = pShopID, Name = pName, Surname = pSurname WHERE ID = pID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_customer` (`pID` INT, `pName` VARCHAR(256), `pSurname` VARCHAR(256), `pAddress` VARCHAR(256), `pPhoneNumber` VARCHAR(256))  BEGIN
	UPDATE customers SET Name = pName, Surname = pSurname, Address = pAddress, PhoneNumber = pPhoneNumber WHERE ID = pID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_product` (`pID` INT, `pDescription` VARCHAR(256), `pValidity` DATE, `pStock` INT, `pState` TINYINT)  BEGIN
	UPDATE products SET Description = pDescription, Validity = pValidity, Stock = pStock, State = pState WHERE ID = pID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_service` (`pID` INT, `pDescription` VARCHAR(256), `pPrice` FLOAT, `pActive` TINYINT)  BEGIN
	UPDATE services SET Description = pDescription, Price = pPrice, Active = pActive WHERE ID = pID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_shop` (`pID` INT, `pName` VARCHAR(256), `pCity` VARCHAR(256))  BEGIN
	UPDATE shops SET Name = pName, City = pCity WHERE ID = pID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sell_product` (`pAssistantID` INT, `pCustomerID` INT, `pProductID` INT, `pQuantity` INT, `pAS_Price` FLOAT, `pTotal` FLOAT)  BEGIN
	INSERT INTO product_sales (AssistantID, CustomerID, ProductID, Quantity, AS_Price, Total)
		VALUES(pAssistantID, pCustomerID, pProductID, pQuantity, pAS_Price, pTotal);
        
	UPDATE products SET Stock = Stock - pQuantity WHERE ID = pProductID;
	UPDATE products SET State = 0 WHERE Stock = 0 AND ID = pProductID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sell_service` (`pServiceID` INT, `pAssistantID` INT, `pCustomerID` INT, `pTotal` FLOAT)  BEGIN
	INSERT INTO service_sales (AssistantID, CustomerID, ServiceID, Total)
		VALUES(pAssistantID, pCustomerID, pServiceID, pTotal);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `assistants`
--

CREATE TABLE `assistants` (
  `ID` int(11) NOT NULL,
  `ShopID` int(11) DEFAULT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Surname` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assistants`
--

INSERT INTO `assistants` (`ID`, `ShopID`, `Name`, `Surname`) VALUES
(1, 2, 'Durim', 'Gashi'),
(42, 1, 'Jane', 'Doe'),
(43, 4, 'John', 'Doe');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `ID` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Surname` varchar(45) DEFAULT NULL,
  `Address` varchar(128) DEFAULT NULL,
  `PhoneNumber` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`ID`, `Name`, `Surname`, `Address`, `PhoneNumber`) VALUES
(1, 'Bruce', 'Wayne', 'Gotham City', '044-911-911'),
(2, 'Clark', 'Kent', 'Metropolis', '044-123-456'),
(3, 'Mathew', 'Murdock', 'Hells Kitchen ', '044 555 777'),
(11, 'Steve', 'Rogers', 'Brooklyn', '044 154 554'),
(12, 'Peter', 'Parker', 'Queens', '049 969 015'),
(24, 'Tony', 'Stark', 'Los Angeles', '044 222 333');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Description` varchar(256) DEFAULT NULL,
  `Validity` date DEFAULT NULL,
  `State` tinyint(4) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `Description`, `Validity`, `State`, `Stock`) VALUES
(1, 'Samsung Galaxy S20 ', '2021-04-13', 1, 24),
(2, 'Product 2', '2021-04-13', 0, 6),
(3, 'Product 3', '2021-04-13', 1, 0),
(11, 'Product X', '2021-04-13', 0, 0),
(12, 'iPhone 12', '2021-05-08', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `product_sales`
--

CREATE TABLE `product_sales` (
  `ID` int(11) NOT NULL,
  `AssistantID` int(11) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `AS_Price` float DEFAULT NULL,
  `Total` float DEFAULT NULL,
  `Date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_sales`
--

INSERT INTO `product_sales` (`ID`, `AssistantID`, `CustomerID`, `ProductID`, `Quantity`, `AS_Price`, `Total`, `Date`) VALUES
(11, 1, 1, 1, 3, 212.41, 637.23, '2021-04-10 21:38:58'),
(12, 1, 1, 1, 3, 212.41, 637.23, '2021-04-10 21:39:03'),
(16, 1, 12, 12, 2, 129.97, 259.94, '2021-04-10 21:39:53'),
(17, 1, 1, 12, 3, 129.97, 389.91, '2021-04-10 21:40:09'),
(18, 1, 12, 2, 1, 15, 15, '2021-04-10 21:40:59'),
(19, 1, 12, 12, 3, 129.97, 389.91, '2021-04-10 21:41:24'),
(21, 1, 2, 2, 2, 15, 30, '2021-04-10 21:43:06'),
(22, 42, 24, 12, 7, 129.97, 909.79, '2021-04-11 12:18:52'),
(23, 42, 24, 1, 6, 7.98, 47.88, '2021-04-11 12:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Description` varchar(256) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `Active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ID`, `ProductID`, `Description`, `Price`, `Active`) VALUES
(1, 1, 'Samsung Headphones', 49.99, 0),
(3, 2, 'Service 2 - 1', 9.99, 0),
(8, 3, 'Service 3 - 1', 4, 1),
(12, 1, 'Samsung Case', 4.99, 1),
(13, 2, 'Service 2 - 2', 15, 1),
(14, 1, 'Screen Protector', 2.99, 1),
(15, 11, 'Service 1 - X', 12, 1),
(17, 12, 'Charging Cable', 19.99, 1),
(18, 12, 'Charging Brick', 29.99, 1),
(19, 12, 'iPhone Headphones', 79.99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_sales`
--

CREATE TABLE `service_sales` (
  `ID` int(11) NOT NULL,
  `AssistantID` int(11) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `ServiceID` int(11) DEFAULT NULL,
  `Total` float DEFAULT NULL,
  `Date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_sales`
--

INSERT INTO `service_sales` (`ID`, `AssistantID`, `CustomerID`, `ServiceID`, `Total`, `Date`) VALUES
(7, 1, 12, 1, 29.99, '2021-04-09 22:42:03'),
(8, 1, 2, 18, 29.99, '2021-04-09 22:55:23'),
(9, 1, 1, 18, 29.99, '2021-04-09 22:55:27'),
(10, 1, 1, 18, 29.99, '2021-04-09 22:55:31'),
(11, 1, 1, 18, 29.99, '2021-04-09 22:55:33'),
(12, 1, 11, 19, 79.99, '2021-04-09 22:55:40'),
(13, 1, 11, 19, 79.99, '2021-04-09 22:55:46'),
(14, 1, 11, 13, 15, '2021-04-09 22:55:51'),
(15, 1, 2, 13, 15, '2021-04-10 21:43:18'),
(16, 43, 2, 19, 79.99, '2021-04-10 22:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `ID` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `City` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`ID`, `Name`, `City`) VALUES
(1, 'Shop Prishtina', 'Prishtina'),
(2, 'Shop Tirana', 'Tirana'),
(4, 'Shop Skopje', 'Skopje'),
(205, 'Shop New York', 'New York');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_bestworstassistant`
-- (See below for the actual view)
--
CREATE TABLE `view_bestworstassistant` (
`Best selling assistant` varchar(23)
,`AssistantName` varchar(91)
,`TotalSold` decimal(32,0)
,`MoneyMade` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_bestworstproduct`
-- (See below for the actual view)
--
CREATE TABLE `view_bestworstproduct` (
`Best selling product` varchar(21)
,`Description` varchar(256)
,`TotalSold` decimal(32,0)
,`MoneyMade` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_bestworstservice`
-- (See below for the actual view)
--
CREATE TABLE `view_bestworstservice` (
`Best selling service` varchar(21)
,`ServiceName` varchar(256)
,`TotalSold` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_productsales`
-- (See below for the actual view)
--
CREATE TABLE `view_productsales` (
`ID` int(11)
,`AssistantID` int(11)
,`CustomerID` int(11)
,`ProductID` int(11)
,`ShopID` int(11)
,`Assistant` varchar(45)
,`ShopName` varchar(45)
,`Customer` varchar(91)
,`Description` varchar(256)
,`Quantity` int(11)
,`Total` double(19,2)
,`Date` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_salesbyassistant`
-- (See below for the actual view)
--
CREATE TABLE `view_salesbyassistant` (
`AssistantID` int(11)
,`AssistantName` varchar(91)
,`TotalSold` decimal(32,0)
,`MoneyMade` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_salesbyproduct`
-- (See below for the actual view)
--
CREATE TABLE `view_salesbyproduct` (
`ProductID` int(11)
,`Description` varchar(256)
,`TotalSold` decimal(32,0)
,`MoneyMade` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_salesbyservice`
-- (See below for the actual view)
--
CREATE TABLE `view_salesbyservice` (
`ID` int(11)
,`Description` varchar(256)
,`TotalSold` bigint(21)
,`MoneyMade` double(19,2)
);

-- --------------------------------------------------------

--
-- Structure for view `view_bestworstassistant`
--
DROP TABLE IF EXISTS `view_bestworstassistant`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_bestworstassistant`  AS  (select 'Best selling assistant' AS `Best selling assistant`,`view_salesbyassistant`.`AssistantName` AS `AssistantName`,`view_salesbyassistant`.`TotalSold` AS `TotalSold`,`view_salesbyassistant`.`MoneyMade` AS `MoneyMade` from `view_salesbyassistant` order by `view_salesbyassistant`.`TotalSold` desc,`view_salesbyassistant`.`MoneyMade` desc limit 1) union all (select 'Worst selling assistant' AS `Worst selling assistant`,`view_salesbyassistant`.`AssistantName` AS `AssistantName`,`view_salesbyassistant`.`TotalSold` AS `TotalSold`,`view_salesbyassistant`.`MoneyMade` AS `MoneyMade` from `view_salesbyassistant` order by `view_salesbyassistant`.`TotalSold`,`view_salesbyassistant`.`MoneyMade` limit 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_bestworstproduct`
--
DROP TABLE IF EXISTS `view_bestworstproduct`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_bestworstproduct`  AS  (select 'Best selling product' AS `Best selling product`,`view_salesbyproduct`.`Description` AS `Description`,`view_salesbyproduct`.`TotalSold` AS `TotalSold`,`view_salesbyproduct`.`MoneyMade` AS `MoneyMade` from `view_salesbyproduct` order by `view_salesbyproduct`.`TotalSold` desc,`view_salesbyproduct`.`MoneyMade` desc limit 1) union all (select 'Worst selling product' AS `Worst selling product`,`view_salesbyproduct`.`Description` AS `Description`,`view_salesbyproduct`.`TotalSold` AS `TotalSold`,`view_salesbyproduct`.`MoneyMade` AS `MoneyMade` from `view_salesbyproduct` order by `view_salesbyproduct`.`TotalSold`,`view_salesbyproduct`.`MoneyMade` limit 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_bestworstservice`
--
DROP TABLE IF EXISTS `view_bestworstservice`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_bestworstservice`  AS  (select 'Best selling service' AS `Best selling service`,`view_salesbyservice`.`Description` AS `ServiceName`,`view_salesbyservice`.`TotalSold` AS `TotalSold` from `view_salesbyservice` group by `view_salesbyservice`.`ID` order by `view_salesbyservice`.`TotalSold` desc limit 1) union all (select 'Worst selling service' AS `Worst selling service`,`view_salesbyservice`.`Description` AS `ServiceName`,`view_salesbyservice`.`TotalSold` AS `TotalSold` from `view_salesbyservice` group by `view_salesbyservice`.`ID` order by `view_salesbyservice`.`TotalSold` limit 1) ;

-- --------------------------------------------------------

--
-- Structure for view `view_productsales`
--
DROP TABLE IF EXISTS `view_productsales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_productsales`  AS  select `ps`.`ID` AS `ID`,`ps`.`AssistantID` AS `AssistantID`,`ps`.`CustomerID` AS `CustomerID`,`ps`.`ProductID` AS `ProductID`,`s`.`ID` AS `ShopID`,`a`.`Name` AS `Assistant`,`s`.`Name` AS `ShopName`,concat(`c`.`Name`,' ',`c`.`Surname`) AS `Customer`,`p`.`Description` AS `Description`,`ps`.`Quantity` AS `Quantity`,round(`ps`.`Total`,2) AS `Total`,`ps`.`Date` AS `Date` from ((((`product_sales` `ps` join `assistants` `a` on(`ps`.`AssistantID` = `a`.`ID`)) join `customers` `c` on(`ps`.`CustomerID` = `c`.`ID`)) join `products` `p` on(`ps`.`ProductID` = `p`.`ID`)) join `shops` `s` on(`s`.`ID` = `a`.`ShopID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_salesbyassistant`
--
DROP TABLE IF EXISTS `view_salesbyassistant`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_salesbyassistant`  AS  select `a`.`ID` AS `AssistantID`,concat(`a`.`Name`,' ',`a`.`Surname`) AS `AssistantName`,coalesce(sum(`ps`.`Quantity`),0) AS `TotalSold`,coalesce(round(sum(`ps`.`Total`),2),0) AS `MoneyMade` from (`assistants` `a` left join `product_sales` `ps` on(`a`.`ID` = `ps`.`AssistantID`)) group by `a`.`ID` ;

-- --------------------------------------------------------

--
-- Structure for view `view_salesbyproduct`
--
DROP TABLE IF EXISTS `view_salesbyproduct`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_salesbyproduct`  AS  select `p`.`ID` AS `ProductID`,`p`.`Description` AS `Description`,coalesce(sum(`ps`.`Quantity`),0) AS `TotalSold`,coalesce(round(sum(`ps`.`Total`),2),0) AS `MoneyMade` from (`products` `p` left join `product_sales` `ps` on(`ps`.`ProductID` = `p`.`ID`)) group by `p`.`ID` order by coalesce(sum(`ps`.`Quantity`),0) desc,coalesce(round(sum(`ps`.`Total`),2),0) desc ;

-- --------------------------------------------------------

--
-- Structure for view `view_salesbyservice`
--
DROP TABLE IF EXISTS `view_salesbyservice`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_salesbyservice`  AS  select `s`.`ID` AS `ID`,`s`.`Description` AS `Description`,coalesce(count(`ss`.`ID`),0) AS `TotalSold`,coalesce(round(sum(`ss`.`Total`),2),0) AS `MoneyMade` from (`services` `s` left join `service_sales` `ss` on(`ss`.`ServiceID` = `s`.`ID`)) group by `s`.`ID` order by coalesce(sum(`ss`.`ID`),0) desc,coalesce(round(sum(`ss`.`Total`),2),0) desc ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assistants`
--
ALTER TABLE `assistants`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_sales`
--
ALTER TABLE `product_sales`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `service_sales`
--
ALTER TABLE `service_sales`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assistants`
--
ALTER TABLE `assistants`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_sales`
--
ALTER TABLE `product_sales`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `service_sales`
--
ALTER TABLE `service_sales`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
