-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 Nis 2022, 21:20:20
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `eticaret1`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Ordering` int(11) NOT NULL,
  `Visibility` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Ordering`, `Visibility`) VALUES
(5, 'Cell phones', 'New and very good', 1, 0),
(6, 'Computers', 'New and very clean computers', 2, 0),
(7, 'Tablets ', 'New and hight quality', 5, 0),
(8, 'Games', 'various games for adults and children', 6, 0),
(9, 'laptops', 'clean and New laptopes with various operating systems', 3, 0),
(10, 'Electronic parts', 'Electronic parts', 4, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `status`, `comment_date`, `item_id`, `user_id`) VALUES
(23, 'excelent', 1, '2022-04-12', 14, 20),
(24, 'verry good', 1, '2022-04-19', 14, 20),
(29, 'harikkkkaaaa', 1, '2022-04-15', 14, 20),
(31, 'coook guzelll', 1, '2022-04-15', 32, 20),
(33, 'kapasitesi yuksek cok begendim', 1, '2022-04-16', 32, 21),
(34, 'cok hizli ben tavsiye ediyorum', 1, '2022-04-16', 30, 19),
(35, 'cok hizli cok begendim', 0, '2022-04-18', 22, 19);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product`
--

CREATE TABLE `product` (
  `Item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `product`
--

INSERT INTO `product` (`Item_ID`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `Image`, `Status`, `Cat_ID`, `Member_ID`) VALUES
(14, 'Iphone 8', 'New and very clean ', '$930', '2022-04-15', 'USA', '935953_iphone8.png', '1', 5, 1),
(15, 'Redmi Note 9 Pro', 'very clean', '$720', '2022-04-15', 'China', '724114_rediminote9.png', '2', 5, 1),
(16, 'Redmi Note 7', 'Redmi not 7 used', '$400', '2022-04-15', 'China', '896836_redminote7.png', '3', 5, 1),
(17, 'Iphone 12', 'very yeni ve clean phone', '$1430', '2022-04-15', 'Europ', '314233_iphone12.png', '1', 5, 1),
(18, 'Nokia', 'nokia phone ', '$160', '2022-04-15', 'irak', '985841_nokia.png', '4', 5, 1),
(19, 'Student desktop computer', 'very practical for study', '$550', '2022-04-15', 'Europ', '370340_studentdesktop.jpg', '2', 6, 1),
(20, 'personel desktop computer', 'computer is very pratical for work', '$600', '2022-04-15', 'USA', '278157_personelComputer.png', '1', 6, 1),
(21, 'HP 500GB desktop computer', 'used but New as Memory 500GB', '$620', '2022-04-15', 'japon', '282758_Hp500GB.png', '2', 6, 1),
(22, 'I3 Dell Desktop computer', 'New and very speed', '$590', '2022-04-15', 'USA', '244243_i3_Dell_Desktop.png', '1', 6, 1),
(23, 'Mario Game', 'Super Mario Game 2021', '$50', '2022-04-15', 'irak', '638634_mario.png', '1', 8, 1),
(24, 'GTA 5 Game', 'New Relese and very beautiful', '$80', '2022-04-15', 'Europ', '248411_gta5.png', '1', 8, 1),
(25, 'Ninja Turtles Game', 'New release and New Updates', '$30', '2022-04-15', 'China', '181486_ninja.png', '1', 8, 1),
(26, 'Pink Panther Game', 'very entertaining and easy', '$55', '2022-04-15', 'USA', '255249_pinkpanther.png', '1', 8, 1),
(27, 'Samsung galaxy Tab S7 Tablet', 'very clean and very speed', '$780', '2022-04-15', 'Europ', '150786_samsungTabs7.png', '1', 7, 1),
(28, 'Huawei MatePad Pro Tablet', 'New and very clean ', '$900', '2022-04-15', 'china', '829906_huaweiTp.png', '1', 7, 1),
(29, 'Samsung galaxy Tab S6 Tablet', 'New and very clean ', '$1000', '2022-04-15', 'USA', '399795_samsunggalaxyS6Tap.png', '1', 7, 1),
(30, 'Lenovo Core i5', 'Lenovo Core i5 Laptop', '$670', '2022-04-15', 'Europ', '122814_Lenovocorei5.png', '1', 9, 1),
(31, 'Lenovo Core i7 Intel', 'Lenovo Core i7 Laptop', '$900', '2022-04-15', 'USA', '554980_Lenovocorei7.png', '2', 9, 1),
(32, 'Hp i7 Core', 'Hp i7 Core Laptop', '$1200', '2022-04-15', 'USA', '686506_hpcorei7.png', '1', 9, 1),
(33, 'Hp Core i9', 'Hp Core i9 very speed', '$1500', '2022-04-15', 'Europ', '19952_hpcorei9.png', '1', 9, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`RoleID`, `RoleName`) VALUES
(1, 'customer'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Date` date NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Birthday` date NOT NULL,
  `RegStatus` int(11) NOT NULL DEFAULT 0,
  `RoleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Email`, `Password`, `gender`, `Date`, `avatar`, `Birthday`, `RegStatus`, `RoleID`) VALUES
(1, 'beyan', 'bayanrhayyem@gmail.com', '0ac8d8d76d37cbbdef222da367e517be098332d4', 'Female', '2022-01-15', '', '1998-06-21', 1, 2),
(19, 'fatma', 'fatma@gmail.com', '9a33cae76073f112161d4e16c35e97fb4448f5d5', 'Female', '2022-04-15', '331689_girl1.jpg', '2000-04-12', 1, 1),
(20, 'imen', 'imen@gmail.com', 'e6f74d0eb2ba1fc2c6a2180eeef724e755b8fab4', 'Female', '2022-04-15', '132177_girl2.jpg', '2000-06-01', 1, 1),
(21, 'hasan', 'hasan@gmail.com', '37becb6cd5d0f5d540386b3db2a91e322c637646', 'Male', '2022-04-15', '205558_boy1.png', '2001-03-27', 1, 1),
(23, 'sali', 'sali@gmail.com', '1dd0df3493ff861dbd7135eb4f4645c63c42f9c2', 'Female', '2022-04-15', '758336_girl3.jpg', '1998-04-05', 1, 2),
(24, 'selam', 'selam@gmail.com', 'b17e9bc900826b5b959bdf372c8cfc3f006c0a9c', 'female', '2022-04-15', '', '2003-03-29', 0, 1),
(27, 'rami', 'rami@gmail.com', '17a183c0e253497bdf31d9728e1eec9bb675e0f1', 'male', '2022-04-17', '', '2000-04-28', 0, 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `Cat_ID` (`Cat_ID`),
  ADD KEY `Member_ID` (`Member_ID`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleID`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `product`
--
ALTER TABLE `product`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `product` (`Item_ID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`);

--
-- Tablo kısıtlamaları `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserID`);

--
-- Tablo kısıtlamaları `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
