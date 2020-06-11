-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Máj 30. 19:42
-- Kiszolgáló verziója: 10.4.11-MariaDB
-- PHP verzió: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `hibajegyteszt`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hibajegyemp`
--

CREATE TABLE `hibajegyemp` (
  `empID` int(1) NOT NULL,
  `empName` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `hibajegyemp`
--

INSERT INTO `hibajegyemp` (`empID`, `empName`) VALUES
(1, 'Raveena Avery'),
(2, 'Callie Benitez'),
(3, 'Emelie Stephenson'),
(4, 'Efe OConnor'),
(5, 'Antonio Juarez'),
(6, 'Jokubas Quintero'),
(7, 'Ellie-Louise Jordan'),
(8, 'Zayd Delaney');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hibajegyusers`
--

CREATE TABLE `hibajegyusers` (
  `userID` int(2) NOT NULL,
  `userName` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `hibajegyusers`
--

INSERT INTO `hibajegyusers` (`userID`, `userName`) VALUES
(0, 'Hétfőő'),
(1, 'Marion Colley'),
(2, 'Jade Collier'),
(3, 'Alvin Bevan'),
(4, 'Warren Mcfarland'),
(5, 'Ismaeel Cantrell'),
(6, 'Ewen Rollins'),
(7, 'Ava-Mai Hodgson'),
(8, 'Janelle Taylor'),
(9, 'Wesley Dennis'),
(10, 'Joe Busby'),
(11, 'Varun Wilson'),
(12, 'Reggie Mcknight'),
(13, 'Samah Jacobson'),
(14, 'Micah Santos'),
(15, 'Saqlain Dyer'),
(16, 'Alaw Bateman'),
(17, 'Melissa Irving'),
(18, 'Oscar Gomez'),
(19, 'Gregg King'),
(20, 'Ameen Grant'),
(21, 'Sumaiya Nixon'),
(22, 'Celia York'),
(23, 'Aneesha Pineda'),
(24, 'Allison Read'),
(25, 'Cohan Andrew'),
(26, 'Dillon Dixon'),
(27, 'Melisa Shaffer'),
(28, 'Russell Buckley'),
(29, 'Eli Talley'),
(30, 'Darryl Hamilton'),
(31, 'Rizke'),
(32, 'TESZT'),
(33, 'Rizkeeee'),
(34, 'Rizke5'),
(35, 'Rizke5'),
(36, 'Rizke7'),
(37, 'Rizke9'),
(38, 'Rizke9'),
(39, 'Keddd'),
(40, 'Lilla');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tickets`
--

CREATE TABLE `tickets` (
  `ticketID` int(10) NOT NULL,
  `usersID` int(10) DEFAULT NULL,
  `type` varchar(5) NOT NULL DEFAULT 'hiba',
  `comment` text NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `empID` int(10) DEFAULT NULL,
  `IsDone` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `tickets`
--

INSERT INTO `tickets` (`ticketID`, `usersID`, `type`, `comment`, `date`, `empID`, `IsDone`) VALUES
(1, 2, 'Hiba', 'anyádat', '2020-05-28 22:23:09', 5, 0),
(2, 2, 'Hiba', ' gg', '2020-05-30 12:17:05', 0, 0),
(3, 2, 'Hiba', ' Ez egy teszt hiba', '2020-05-30 12:21:14', 1, 0),
(4, 1, 'Kérés', '    zzz', '2020-05-30 17:22:06', 0, 0),
(5, 3, 'Hiba', 'ADASDASDAS', '2020-05-25 12:24:23', 0, 0),
(6, 3, 'Hiba', '  ZZ', '2020-05-30 17:24:34', 1, 0),
(7, 3, 'Hiba', '1292', '2020-05-30 17:27:02', 1, 0),
(9, 39, 'emp_e', '   BOCS', '2020-05-30 16:15:07', 3, 0),
(10, 0, 'Hiba', 'JÓLESZMÁ?', '2020-05-25 12:56:32', 0, 0),
(11, 0, 'Kérés', 'ggg', '2020-05-25 12:58:44', 5, 0),
(12, 0, 'Kérés', '', '2020-05-25 13:22:57', 5, 0),
(13, 0, 'Hiba', 'BÉLA GOND BAN', '2020-05-25 13:26:07', 5, 0),
(14, 0, 'Hiba', 'ZZZ', '2020-05-25 13:28:18', 0, 0),
(16, 0, 'Hiba', 'hh', '2020-05-25 13:31:33', 5, 0),
(17, 0, 'Hiba', 'rr', '2020-05-25 13:33:09', 0, 0),
(19, 0, 'Hiba', 'ss', '2020-05-25 13:35:32', 0, 0),
(20, 1, 'Hiba', '    EZ IS EGY VALAMI HIBA', '2020-05-30 17:11:28', 0, 0),
(21, 40, 'Kérés', ' Gyere el velem kávézni PLS', '2020-05-25 14:51:34', 5, 0),
(23, 2, 'Kérés', ' zzz', '2020-05-30 12:34:16', 2, 0),
(25, 3, 'hiba', 'GECCCC', '2020-05-30 17:25:10', 0, 0),
(26, 3, 'kérés', 'faszomkivan', '2020-05-30 17:26:31', 0, 0),
(27, 3, 'emp_e', ' BOCS', '2020-05-30 17:34:04', 5, 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `hibajegyemp`
--
ALTER TABLE `hibajegyemp`
  ADD PRIMARY KEY (`empID`);

--
-- A tábla indexei `hibajegyusers`
--
ALTER TABLE `hibajegyusers`
  ADD PRIMARY KEY (`userID`);

--
-- A tábla indexei `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
