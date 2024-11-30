-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Nov 30. 12:59
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `konyvajanlo`
--
CREATE DATABASE IF NOT EXISTS `konyvajanlo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `konyvajanlo`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ertekelesek`
--

CREATE TABLE `ertekelesek` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `konyv_id` int(11) NOT NULL,
  `ertekeles` tinyint(4) NOT NULL CHECK (`ertekeles` between 1 and 5),
  `datum` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `ertekelesek`
--

INSERT INTO `ertekelesek` (`id`, `felhasznalo_id`, `konyv_id`, `ertekeles`, `datum`) VALUES
(2, 2, 2, 4, '2024-10-31 18:16:12'),
(3, 1, 3, 3, '2024-10-31 18:16:12'),
(4, 2, 4, 5, '2024-10-31 18:16:12'),
(5, 3, 24, 2, '2024-11-29 21:16:11'),
(7, 10, 25, 3, '2024-11-29 22:22:56'),
(8, 10, 24, 4, '2024-11-29 22:23:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `szerep` varchar(30) NOT NULL,
  `profilkep_url` varchar(255) DEFAULT NULL,
  `regisztracios_datum` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `nev`, `email`, `jelszo`, `szerep`, `profilkep_url`, `regisztracios_datum`) VALUES
(1, 'Kovács Péter', 'peter@example.com', 'titkositott_jelszo1', 'user', '', '2024-10-31 18:16:11'),
(2, 'Szabó Anna', 'anna@pelda.com', '$2y$10$2jPEA3sJsZx7.LYCcw4LLO/AkT0n1IkV0ryaQ/MeOTamr.Q/QiNuK', 'user', '', '2024-10-31 18:16:11'),
(3, 'admin', 'email@email.com', '$2y$10$wKwge67fwzspopakYJwMdOKkVzucpH6s/F9lg6HZtrxSFCSQkGX9S', 'admin', 'https://assets.moly.hu/system/users/missing_normal.png', '2024-11-02 18:44:54'),
(10, 'rico1', 'email@email1.com', '$2y$10$0iMbFLBZowt.0eQ2.9h2Euuhd/q3r2s.MdrOWN3Oi7ANwd1MQEA42', 'user', '', '2024-11-23 20:47:46'),
(11, 'rico2', 'email@email2.com', '$2y$10$l1.HO/hJ5b.lvCt8BwazzOTyjHPfOywv7fwolqIAQyPjaNnY0CAJ6', 'user', '', '2024-11-23 20:47:59'),
(12, 'rico3', 'email@email2.com2', '$2y$10$JiqF1XxYJCbzGv4LSakbfOcA9mKSBnyLYq9aQ9NX74iMSlwSeDokS', 'user', '', '2024-11-23 20:48:12'),
(13, 'rico4', 'email@email2.com3', '$2y$10$uN4gEzAvPYDJP/mVlTVA.O/lerU.SDrt/1ZNqklmEAIOegTI7fY2m', 'user', '', '2024-11-23 20:48:27'),
(14, 'rico5', 'email@email2.com4', '$2y$10$geu8ZUOIHislkxr5AvW1Q.ZJ84zXuBb8.CilPay/YROCjLOdrcIba', 'user', '', '2024-11-23 20:48:39'),
(15, 'rico6', 'email@email2.com5', '$2y$10$X.J5oiuGI.Uo6k0Ix8y9RenXkGhIH9LA98gnVVTnL/EPMmq65xOSO', 'user', '', '2024-11-23 20:50:15'),
(16, 'rico7', 'email@email2.com6', '$2y$10$AUOdTxJi4Lll8azLetbqEuIj.xnv/P9S1mcwiNUn8YOVt9ERbXLxu', 'user', '', '2024-11-23 20:50:29'),
(17, 'rico8', 'email@email2.com7', '$2y$10$eBqgr8JHBRaOdMSqOEKyheiIBx/MgtY3rl22PJT5IOE/qJpjX7xKe', 'user', '', '2024-11-23 20:50:43'),
(18, 'rico9', 'ggg@gg.com', '$2y$10$KW4eNBjxApFht98pPysuQ.1QPVISUlYuxgVCBA/pO1ht5c2tpV1xe', 'user', '', '2024-11-23 20:51:28');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hozzaszolasok`
--

CREATE TABLE `hozzaszolasok` (
  `id` int(11) NOT NULL,
  `velemeny_id` int(11) DEFAULT NULL,
  `felhasznalo_id` int(11) DEFAULT NULL,
  `hozzaszolas` text NOT NULL,
  `datum` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `hozzaszolasok`
--

INSERT INTO `hozzaszolasok` (`id`, `velemeny_id`, `felhasznalo_id`, `hozzaszolas`, `datum`) VALUES
(2, 2, 1, 'Valóban, Asimov megelőzte a korát.', '2024-10-31 18:16:12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoriak`
--

CREATE TABLE `kategoriak` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kategoriak`
--

INSERT INTO `kategoriak` (`id`, `nev`) VALUES
(1, 'Fantasy'),
(2, 'Történelem'),
(3, 'Sci-Fi'),
(4, 'Szépirodalom');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kedvencek`
--

CREATE TABLE `kedvencek` (
  `id` int(11) NOT NULL,
  `konyv_id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kedvencek`
--

INSERT INTO `kedvencek` (`id`, `konyv_id`, `felhasznalo_id`) VALUES
(6, 2, 3),
(7, 24, 3),
(8, 22, 3),
(12, 3, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `konyvek`
--

CREATE TABLE `konyvek` (
  `id` int(11) NOT NULL,
  `cim` varchar(255) NOT NULL,
  `leiras` text DEFAULT NULL,
  `oldalszam` int(11) NOT NULL,
  `kiadasi_ev` int(11) DEFAULT NULL,
  `boritokep_url` varchar(255) DEFAULT NULL,
  `link_amazon` varchar(255) DEFAULT NULL,
  `link_bookline` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `konyvek`
--

INSERT INTO `konyvek` (`id`, `cim`, `leiras`, `oldalszam`, `kiadasi_ev`, `boritokep_url`, `link_amazon`, `link_bookline`) VALUES
(2, 'Alapítvány', 'Egy jövőbeli történet egy galaktikus birodalom összeomlásáról.', 301, 1951, 'https://moly.hu/system/covers/big/covers_154642.jpg?1713601948', 'https://amazon.com/alapitvany', 'https://bookline.com/alapitvany'),
(3, '1984', 'Egy disztópikus regény a totalitarizmusról.', 250, 1949, 'https://moly.hu/system/covers/big/covers_590714.jpg?1580919360', '', ''),
(4, 'Egy polgár vallomásai', 'Márai Sándor regénye a polgári világról.', 200, 1934, 'https://moly.hu/system/covers/big/covers_761527.jpg?1662555143', 'https://amazon.com/egy_polgar', 'https://bookline.com/egy_polgar'),
(22, 'Harry ​Potter és a bölcsek köve', 'Harry remegő kézzel megfordította a küldeményt. A borítékot lezáró piros viaszpecsétet címer díszítette: oroszlán, sas, borz és kígyó vettek körül egy nagy R betűt.\r\n\r\nHarry Potter még csak hallani sem hallott Roxfortról, amikor a Privet Drive 4-es számú ház lábtörlőjére elkezdenek sorban hullani a levelek. A zöld tintával címzett és piros pecséttel lezárt sárgás pergameneket azonban gyorsan elorozza rémes nagynénje és nagybátyja. Harry tizenegyedik születésnapját egy hatalmas, bogárszemű óriás, Rubeus Hagrid zavarja meg, és elképesztő híreket hoz: Harry Potter varázsló, és felvételt nyert a Roxfort Boszorkány- és Varázslóképző Szakiskolába. Ezzel elkezdődik egy hihetetlen kaland!', 288, 1999, 'https://moly.hu/system/covers/big/covers_695092.jpg?1727699765', '', ''),
(24, 'Harry ​Potter és a Titkok Kamrája', 'A ​szemközti falon valami fénylett. Óvatosan közelebb mentek, s közben hunyorogva fürkészték a sötétséget. A lobogó fáklyák fényében egy felirat csillant meg. Valaki fél méter magas betűkkel ezt mázolta a két ablak között a falra: FELTÁRULT A TITKOK KAMRÁJA. AZ UTÓD ELLENSÉGEI RESZKESSENEK!\r\nHarry Potter varázslónak született, és jelenleg második tanévére készül a Roxfort Boszorkány-és Varázslóképző Szakiskolában. De már a szünidő sem telik eseménytelenül: egy nap különös szerzet , egy házimanó jelenik meg a Privet Drive-on, és közli Harryvel, hogy nagy veszély leselkedik rá, ha visszatér az iskolába. Harry a riválisa, Draco Malfoy mesterkedését sejti az üzenet mögött, és nem törődik a figyelmeztetéssel. Sőt, valójában el is feledkezik róla, ugyanis barátja, Ron egy repülő autón megszökteti a kibírhatatlan Dursley-éktől, s Harry a nyár további részét Weasley-éknél tölti. Ám a Roxfortba visszatérve hamarosan beigazolódik, hogy Dobby, a házimanó nem a levegőbe beszélt.', 200, 1999, 'https://moly.hu/system/covers/big/covers_282440.jpg?1395478519', '', ''),
(25, 'Harry ​Potter és az azkabani fogoly', 'Harry Potter szokásos rémes vakációját tölti Dursley-éknél, ám a helyzet úgy elfajul, hogy Harry elviharzik a Privet Drive-ról. Így köt ki a Kóbor Grimbuszon, ami elviszi őt abba a világba, ahová egész nyáron vágyott. Az Abszol úton ijesztő hírek járják: az Azkabanból, a gonosz varázslókat őrző rettegett börtönből megszökött egy fogoly. A Mágiaügyi Minisztériumban tudják, hogy a veszélyes szökevény a Roxfort Boszorkány- és Varázslóképző Szakiskolába tart. Harry pedig egy véletlen folytán tudomást szerez róla, hogy az illető az ő nyomát követi.', 200, 1999, 'https://moly.hu/system/covers/big/covers_458537.jpg?1507105020', '', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `konyv_kategoria`
--

CREATE TABLE `konyv_kategoria` (
  `id` int(11) NOT NULL,
  `konyv_id` int(11) DEFAULT NULL,
  `kategoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `konyv_kategoria`
--

INSERT INTO `konyv_kategoria` (`id`, `konyv_id`, `kategoria_id`) VALUES
(4, 4, 4),
(8, 4, 3),
(68, 2, 2),
(69, 2, 3),
(70, 24, 1),
(74, 25, 1),
(75, 25, 4),
(76, 22, 1),
(77, 22, 3),
(78, 3, 4);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `konyv_szerzo`
--

CREATE TABLE `konyv_szerzo` (
  `id` int(11) NOT NULL,
  `konyv_id` int(11) DEFAULT NULL,
  `szerzo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `konyv_szerzo`
--

INSERT INTO `konyv_szerzo` (`id`, `konyv_id`, `szerzo_id`) VALUES
(4, 4, 4),
(24, 2, 2),
(25, 24, 1),
(28, 25, 1),
(29, 22, 1),
(30, 3, 1),
(31, 3, 2),
(32, 3, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `olvasott`
--

CREATE TABLE `olvasott` (
  `id` int(11) NOT NULL,
  `konyv_id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `olvasott`
--

INSERT INTO `olvasott` (`id`, `konyv_id`, `felhasznalo_id`) VALUES
(4, 24, 3),
(7, 22, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szerzok`
--

CREATE TABLE `szerzok` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `profilkep_url` varchar(255) DEFAULT NULL,
  `szuletesi_ido` date DEFAULT NULL,
  `halal_ido` date DEFAULT NULL,
  `szarmazas` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `szerzok`
--

INSERT INTO `szerzok` (`id`, `nev`, `profilkep_url`, `szuletesi_ido`, `halal_ido`, `szarmazas`) VALUES
(1, 'J.K. Rowling', 'https://cdn.moly.hu/file/molyhu/pictures/normal/pictures_322.jpg?1492714015', NULL, NULL, ''),
(2, 'Isaac Asimov', 'https://cdn.moly.hu/file/molyhu/pictures/big/pictures_3145.jpg?1500118177', NULL, NULL, ''),
(3, 'George Orwell', 'https://cdn.moly.hu/file/molyhu/pictures/big/pictures_3203.jpg?1500465288', '1903-06-25', '1950-01-21', 'angol'),
(4, 'Márai Sándor', 'https://cdn.moly.hu/file/molyhu/pictures/big/pictures_7661.jpg?1523472551', '2024-11-21', NULL, 'magyar');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `varolistak`
--

CREATE TABLE `varolistak` (
  `id` int(11) NOT NULL,
  `konyv_id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `varolistak`
--

INSERT INTO `varolistak` (`id`, `konyv_id`, `felhasznalo_id`) VALUES
(5, 25, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `velemenyek`
--

CREATE TABLE `velemenyek` (
  `id` int(11) NOT NULL,
  `felhasznalo_id` int(11) NOT NULL,
  `konyv_id` int(11) NOT NULL,
  `velemeny` text NOT NULL,
  `datum` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `velemenyek`
--

INSERT INTO `velemenyek` (`id`, `felhasznalo_id`, `konyv_id`, `velemeny`, `datum`) VALUES
(2, 2, 2, 'Egy olyan könyv, ami sosem megy ki a divatból.', '2024-10-31 18:16:11'),
(4, 3, 2, 'nagyon jó', '2024-11-21 22:49:41');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `ertekelesek`
--
ALTER TABLE `ertekelesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `konyv_id` (`konyv_id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nev` (`nev`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A tábla indexei `hozzaszolasok`
--
ALTER TABLE `hozzaszolasok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `velemeny_id` (`velemeny_id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

--
-- A tábla indexei `kategoriak`
--
ALTER TABLE `kategoriak`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kedvencek`
--
ALTER TABLE `kedvencek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `konyv_id` (`konyv_id`);

--
-- A tábla indexei `konyvek`
--
ALTER TABLE `konyvek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `konyv_kategoria`
--
ALTER TABLE `konyv_kategoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konyv_id` (`konyv_id`),
  ADD KEY `kategoria_id` (`kategoria_id`);

--
-- A tábla indexei `konyv_szerzo`
--
ALTER TABLE `konyv_szerzo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konyv_id` (`konyv_id`),
  ADD KEY `szerzo_id` (`szerzo_id`);

--
-- A tábla indexei `olvasott`
--
ALTER TABLE `olvasott`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `konyv_id` (`konyv_id`);

--
-- A tábla indexei `szerzok`
--
ALTER TABLE `szerzok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `varolistak`
--
ALTER TABLE `varolistak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `konyv_id` (`konyv_id`);

--
-- A tábla indexei `velemenyek`
--
ALTER TABLE `velemenyek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `konyv_id` (`konyv_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `ertekelesek`
--
ALTER TABLE `ertekelesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT a táblához `hozzaszolasok`
--
ALTER TABLE `hozzaszolasok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `kategoriak`
--
ALTER TABLE `kategoriak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `kedvencek`
--
ALTER TABLE `kedvencek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `konyvek`
--
ALTER TABLE `konyvek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT a táblához `konyv_kategoria`
--
ALTER TABLE `konyv_kategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT a táblához `konyv_szerzo`
--
ALTER TABLE `konyv_szerzo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT a táblához `olvasott`
--
ALTER TABLE `olvasott`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `szerzok`
--
ALTER TABLE `szerzok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `varolistak`
--
ALTER TABLE `varolistak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `velemenyek`
--
ALTER TABLE `velemenyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `ertekelesek`
--
ALTER TABLE `ertekelesek`
  ADD CONSTRAINT `ertekelesek_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ertekelesek_ibfk_2` FOREIGN KEY (`konyv_id`) REFERENCES `konyvek` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `hozzaszolasok`
--
ALTER TABLE `hozzaszolasok`
  ADD CONSTRAINT `hozzaszolasok_ibfk_1` FOREIGN KEY (`velemeny_id`) REFERENCES `velemenyek` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hozzaszolasok_ibfk_2` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `kedvencek`
--
ALTER TABLE `kedvencek`
  ADD CONSTRAINT `kedvencek_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kedvencek_ibfk_2` FOREIGN KEY (`konyv_id`) REFERENCES `konyvek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `konyv_kategoria`
--
ALTER TABLE `konyv_kategoria`
  ADD CONSTRAINT `konyv_kategoria_ibfk_1` FOREIGN KEY (`konyv_id`) REFERENCES `konyvek` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `konyv_kategoria_ibfk_2` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoriak` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `konyv_szerzo`
--
ALTER TABLE `konyv_szerzo`
  ADD CONSTRAINT `konyv_szerzo_ibfk_1` FOREIGN KEY (`konyv_id`) REFERENCES `konyvek` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `konyv_szerzo_ibfk_2` FOREIGN KEY (`szerzo_id`) REFERENCES `szerzok` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `olvasott`
--
ALTER TABLE `olvasott`
  ADD CONSTRAINT `olvasott_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `olvasott_ibfk_2` FOREIGN KEY (`konyv_id`) REFERENCES `konyvek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `varolistak`
--
ALTER TABLE `varolistak`
  ADD CONSTRAINT `varolistak_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `varolistak_ibfk_2` FOREIGN KEY (`konyv_id`) REFERENCES `konyvek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `velemenyek`
--
ALTER TABLE `velemenyek`
  ADD CONSTRAINT `velemenyek_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `velemenyek_ibfk_2` FOREIGN KEY (`konyv_id`) REFERENCES `konyvek` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
