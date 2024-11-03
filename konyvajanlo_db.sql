-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Nov 03. 21:54
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
(1, 1, 1),
(2, 2, 3),
(3, 3, 3),
(4, 4, 4),
(5, 1, 3),
(6, 2, 1),
(7, 3, 4),
(8, 4, 3);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `konyv_kategoria`
--
ALTER TABLE `konyv_kategoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konyv_id` (`konyv_id`),
  ADD KEY `kategoria_id` (`kategoria_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `konyv_kategoria`
--
ALTER TABLE `konyv_kategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `konyv_kategoria`
--
ALTER TABLE `konyv_kategoria`
  ADD CONSTRAINT `konyv_kategoria_ibfk_1` FOREIGN KEY (`konyv_id`) REFERENCES `konyvek` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `konyv_kategoria_ibfk_2` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoriak` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
