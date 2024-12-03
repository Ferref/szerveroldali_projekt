-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Dec 03. 20:54
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
(8, 10, 24, 4, '2024-11-29 22:23:12'),
(9, 3, 2, 5, '2024-11-30 22:38:58'),
(10, 3, 25, 2, '2024-11-30 22:42:10'),
(11, 18, 4, 3, '2024-12-01 17:46:43');

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
(4, 'Szépirodalom'),
(6, 'Krimi'),
(7, 'Kaland'),
(8, 'Klasszikus'),
(9, 'Horror');

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
(8, 22, 3),
(12, 3, 3),
(13, 25, 3),
(14, 32, 3);

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
(2, 'Alapítvány', 'Egy jövőbeli történet egy galaktikus birodalom összeomlásáról.', 301, 1951, 'https://moly.hu/system/covers/big/covers_154642.jpg?1713601948', '', ''),
(3, '1984', 'Egy disztópikus regény a totalitarizmusról.', 250, 1949, 'https://moly.hu/system/covers/big/covers_590714.jpg?1580919360', '', ''),
(4, 'Egy polgár vallomásai', 'Az író legjelentősebb alkotásában – a két világháború közötti magyar irodalom egyik remekművében – egy városhoz: Kassához, egy osztályhoz: a polgársághoz, s egy életformához: az európai kultúrához való elkötelezettségéről vall, gyermekévei tájaira, a Felvidékre, ifjúkori élményeinek színhelyeire: Berlinbe, Párizsba, Velencébe kalauzolja el olvasóit.\r\n„S utolsó pillanatig, amíg a betűt leírnom engedik, tanúskodni akarok erről: hogy volt egy kor és élt néhány nemzedék, mely az értelem diadalát hirdette az ösztönök felett, s hitt a szellem ellenálló erejében… láttam és hallottam Európát, megéltem egy kultúrát… kaphattam-e sokkal többet az élettől?”', 528, 1934, 'https://moly.hu/system/covers/big/covers_761527.jpg?1662555143', '', ''),
(22, 'Harry ​Potter és a bölcsek köve', 'Harry remegő kézzel megfordította a küldeményt. A borítékot lezáró piros viaszpecsétet címer díszítette: oroszlán, sas, borz és kígyó vettek körül egy nagy R betűt.\r\n\r\nHarry Potter még csak hallani sem hallott Roxfortról, amikor a Privet Drive 4-es számú ház lábtörlőjére elkezdenek sorban hullani a levelek. A zöld tintával címzett és piros pecséttel lezárt sárgás pergameneket azonban gyorsan elorozza rémes nagynénje és nagybátyja. Harry tizenegyedik születésnapját egy hatalmas, bogárszemű óriás, Rubeus Hagrid zavarja meg, és elképesztő híreket hoz: Harry Potter varázsló, és felvételt nyert a Roxfort Boszorkány- és Varázslóképző Szakiskolába. Ezzel elkezdődik egy hihetetlen kaland!', 288, 1997, 'https://moly.hu/system/covers/big/covers_695092.jpg?1727699765', '', ''),
(24, 'Harry ​Potter és a Titkok Kamrája', 'A ​szemközti falon valami fénylett. Óvatosan közelebb mentek, s közben hunyorogva fürkészték a sötétséget. A lobogó fáklyák fényében egy felirat csillant meg. Valaki fél méter magas betűkkel ezt mázolta a két ablak között a falra: FELTÁRULT A TITKOK KAMRÁJA. AZ UTÓD ELLENSÉGEI RESZKESSENEK!\r\nHarry Potter varázslónak született, és jelenleg második tanévére készül a Roxfort Boszorkány-és Varázslóképző Szakiskolában. De már a szünidő sem telik eseménytelenül: egy nap különös szerzet , egy házimanó jelenik meg a Privet Drive-on, és közli Harryvel, hogy nagy veszély leselkedik rá, ha visszatér az iskolába. Harry a riválisa, Draco Malfoy mesterkedését sejti az üzenet mögött, és nem törődik a figyelmeztetéssel. Sőt, valójában el is feledkezik róla, ugyanis barátja, Ron egy repülő autón megszökteti a kibírhatatlan Dursley-éktől, s Harry a nyár további részét Weasley-éknél tölti. Ám a Roxfortba visszatérve hamarosan beigazolódik, hogy Dobby, a házimanó nem a levegőbe beszélt.', 336, 1998, 'https://moly.hu/system/covers/big/covers_282440.jpg?1395478519', '', ''),
(25, 'Harry ​Potter és az azkabani fogoly', 'Harry Potter szokásos rémes vakációját tölti Dursley-éknél, ám a helyzet úgy elfajul, hogy Harry elviharzik a Privet Drive-ról. Így köt ki a Kóbor Grimbuszon, ami elviszi őt abba a világba, ahová egész nyáron vágyott. Az Abszol úton ijesztő hírek járják: az Azkabanból, a gonosz varázslókat őrző rettegett börtönből megszökött egy fogoly. A Mágiaügyi Minisztériumban tudják, hogy a veszélyes szökevény a Roxfort Boszorkány- és Varázslóképző Szakiskolába tart. Harry pedig egy véletlen folytán tudomást szerez róla, hogy az illető az ő nyomát követi.', 480, 1999, 'https://moly.hu/system/covers/big/covers_791491.jpg?1676551444', '', ''),
(30, 'Tíz ​kicsi néger', 'Tíz egymásnak ismeretlen ember meghívást kap egy pazar villába. A villa egy sziklás, elhagyatott szigeten áll, amely sziget néger fejhez hasonlít, arról kapta a nevét is. A villa titokzatos tulajdonosáról mindenféle pletykák keringenek. A vendégek, bár valamennyiük múltjában van valami, amit legszívesebben elfelejtenének, reménykedve és örömmel érkeznek meg egy pompás nyári estén a sziklás öbölbe. A tulajdonos azonban nincs sehol… A felhőtlennek ígérkező napokat egyre félelmetesebb események árnyékolják be. A sziget látogatóit a különös fordulatok hatására hatalmába keríti a rettegés. Tízen érkeznek. Hányan távoznak?\r\nA bűnügyi regény koronázatlan királynőjének talán legjobb, leghíresebb művét tartja kezében az olvasó.', 278, 1939, 'https://moly.hu/system/covers/big/covers_59843.jpg?1679071026', '', ''),
(31, 'Gyilkosság ​az Orient expresszen', 'A híres Orient Expressz a hóban vesztegel. Az egyik utas holtan fekszik a kabinjában, testét tizenkét késszúrás járta át. Az ajtó belülről zárva. A vonaton tizenkét utas maradt, a legkülönbözőbb társadalmi osztályból és nemzetiségből, ám mind egyre idegesebbek. Vagy van más is, ami összeköti őket?\r\nHercule Poirot, a legendás nyomozó csak a kis szürke agysejtjeire támaszkodhat a hóviharban rekedt luxusvonaton. Egyetlen dolog biztos: a gyilkos az utasok közt van, és Poirot-nak meg kell találnia, mielőtt újra lesújt…', 300, 1934, 'https://moly.hu/system/covers/big/covers_732211.jpg?1649162430', '', ''),
(32, 'Halál ​a Níluson', 'Sétahajókázás a Níluson, egy minden kényelemmel felszerelt gőzhajó fedélzetén, elegáns és izgalmas társaságban: tökéletes lehetőség a kikapcsolódásra, akár mézesheteit töltő, szerelmes ifjú leány, akár zsémbes, gazdag öregasszony – vagy épp sokat látott, briliáns magándetektív az utazó.\r\n\r\nA csöndes, enyhe egyiptomi nyáréjszaka békéjét azonban pisztolylövés döreje zúzza szét. Bár az áldozat túléli a merényletet, a kéjutazás légkörét a forrongó szenvedélyek és a hideg gyanakvás igencsak megrontja. Hercule Poirot, a legendás nyomozó nem tehet mást: kis szürke agysejtjeit az ősi Egyiptom misztériumainak megfejtése helyett a bűntett felderítésének szolgálatába állítja…', 384, 1937, 'https://moly.hu/system/covers/big/covers_179705.jpg?1678202946', '', ''),
(33, 'Az ​Ackroyd-gyilkosság', 'King&#039;s Abbot békés falucska. Mindenki ismeri egymást, mindenki mindenkiről mindent tud, vagy tudni vél. Ám egyszer csak rejtélyes gyilkosság kavarja fel az álmos hétköznapokat. Vajon kinek állt érdekében meggyilkolni a környék leggazdagabb emberét? A számtalan gyanúsított egyikének sincs alibije, s rendre kiderül, hogy titkok lappanganak a nyugodt felszín alatt. Hercule Poirot, a belga mesterdetektív előtt semmi nem maradhat sokáig rejtve, holott nyomozása során nem használ más eszközt, csupán „szürke agysejtjeit”.\r\n\r\nAgatha Christie regénye változatlanul lebilincselő olvasmány.', 346, 1926, 'https://moly.hu/system/covers/big/covers_218465.jpg?1678716200', '', ''),
(34, 'Harry ​Potter és a Tűz Serlege', 'Attól fogva, hogy a Kviddics Világkupa döntője után felizzik az égen a Sötét Jegy, Harry Potter minden lépését veszély kíséri. A negyedik tanév elején a Tűz Serlege őt választja ki a Roxfort képviseletére a legendás Trimágus Tusán, ahol olyan feladatokkal kell megbirkóznia, amelyek a legkiválóbb varázslókat is próbára tennék. A tusa azonban csupán előjátéka egy minden eddiginél kockázatosabb erőpróbának. Little Hangleton ködlepte temetőjében ugyanis a legsötétebb mágia fortyog…\r\nA Kate Greenaway-díjjal kitüntetett Jim Kay utánozhatatlan művészi erővel idézi elénk a negyedik Harry Potter-kötet jeleneteit és szereplőit ebben a különleges, illusztrált kiadásban.', 678, 2000, 'https://moly.hu/system/covers/big/covers_791496.jpg?1676551619', '', ''),
(35, 'Harry ​Potter és a Főnix Rendje', 'A ​közelgő háború árnyékában a Főnix Rendjének tagjai a Black család ősi fészkének pompáját vesztett falai között gyűlnek össze, hogy megszervezzék a Voldemort elleni harcot. A Sötét Nagyúr ereje ugyanis egyre nő, gondolatai pedig baljós álmok formájában beférkőznek Harry elméjébe, és leleplezik, milyen emésztő vágyat érez arra, hogy megszerezzen valamit, amit a Misztériumügyi Főosztályon őriznek…\r\nA Roxfortra titkokkal és intrikákkal teli idők köszöntenek. Dolores Umbridge főinkvizítor, a Mágiaügyi Minisztérium megbízottja rendeletekkel szabályozza az iskolai élet legapróbb részleteit is, és igencsak megkeseríti Dumbledore és diákjai életét. Az igazgatóhoz hű, bátor roxfortosok azonban a háta mögött megalapítják Dumbledore Seregét, és megkezdik a felkészülést, hogy ha eljön az ideje, szembe tudjanak szállni a sötétség erőivel.', 760, 2003, 'https://moly.hu/system/covers/big/covers_381300.jpg?1454884204', '', ''),
(36, 'Harry ​Potter és a Félvér Herceg', 'A Voldemort elleni harc állása aggasztó; a baljós jeleket már a muglikormány is észleli. Szaporodnak a rejtélyes halálesetek, katasztrófák. Harry azt gyanítja, hogy esküdt ellensége, Draco Malfoy is a halálfalók jelét viseli. Az élet azonban háborús időkben sem csak harcból áll. A Weasley-ikrek üzleti tevékenysége egyre kiterjedtebb. Szerelmek szövődnek a felsőbb évesek között, a Roxfort házai pedig továbbra is versengenek egymással. Harry Dumbledore segítségével igyekszik minél alaposabban megismerni Voldemort múltját, ifjúságát, hogy rátaláljon a Sötét Nagyúr sebezhető pontjára.', 624, 2005, 'https://moly.hu/system/covers/big/covers_381299.jpg?1454884053', '', ''),
(37, 'Harry ​Potter és a Halál ereklyéi', 'Harry, ​mint mindig, most is a Privet Drive-on, az őt csecsemőkorában befogadó Dursley-család otthonában tölti az iskolai szünetet. Ám hetedik tanévét nem kezdheti el a Roxfort Boszorkány- és Varázslóképző Szakiskolában. A Főnix Rendje azon fáradozik, hogy biztos helyre szöktesse, ahol Voldemort és csatlósai nem találnak rá. De teljesítheti-e folytonos bujkálás és életveszély közepette a küldetést, melyet Dumbledore professzortól kapott?\r\n\r\nA hetedik, s egyben utolsó Harry Potter-regény megjelenése valószínűleg a legnagyobb izgalommal várt esemény a könyvkiadás történetében. J. K. Rowlingnak még a legapróbb, Harry és barátai várható sorsára vonatkozó utalásai is mind szenzációs hírekként láttak napvilágot a sajtóban.\r\n\r\nValóban meghalt Albus Dumbledore? Kinek az oldalán áll Perselus Piton? Mik a megmaradt horcruxok, hová rejtette el lelkét Ő, akit nem nevezünk a nevén? Harry a forradásában hordozza a Sötét Nagyúr lelkének egy darabját, s ezért párszaszájú? Ezekre a kérdésekre választ kapunk a hetedik, egyben befejező kötetben.', 654, 2007, 'https://moly.hu/system/covers/big/covers_378508.jpg?1452968419', '', ''),
(38, 'Én, ​a robot', 'A ​robotika három törvénye\r\n1. A robotnak nem szabad kárt okoznia emberi lényben vagy tétlenül tűrnie, hogy emberi lény bármilyen kárt szenvedjen.\r\n2. A robot engedelmeskedni tartozik az emberi lények utasításainak, kivéve, ha ezek az utasítások az első törvény előírásaiba ütköznének.\r\n3. A robot tartozik saját védelméről gondoskodni, amennyiben ez nem ütközik az első és második törvény előírásaiba.\r\n\r\nEzzel a három egyszerű szabállyal Asimov mindörökre megváltoztatta a robotokról alkotott képünket. A sci-fi egyik megkerülhetetlen klasszikusának számító Én, a robot összekapcsolódó történetek füzérében mutatja be a robotok útját a primitív kezdetektől kezdve a nem is olyan távoli jövő tökéletességéig – ahol már jóformán az emberiségre sincsen szükség.\r\nA novellákban találkozhatunk őrült, humoros és gondolatolvasó robotokkal, robot politikusokkal és olyan robotokkal, amelyek titkon irányítják a világot, és valamennyi történetet a tudományos tények és a science fiction jellegzetes keveréke jellemzi, ami Asimov védjegyévé vált.', 1950, 1950, 'https://moly.hu/system/covers/big/covers_416.jpg?1395342962', '', ''),
(39, 'Állatfarm', 'MINDEN ÁLLAT EGYENLŐ? UGYAN MÁR. VANNAK KÖZTÜK EGYENLŐBBEK IS.\r\nOrwell 1943-44-ben írott műve minden elnyomó, totalitárius rendszerre ráillik. Egy angol major a színhely, ahol az állatok a disznók vezetésével megdöntik az Ember uralmát. A maguk igazgatta farmon élik először szabadnak, derűsnek látszó, majd egyre jobban elkomoruló életüket. Az 1984 írójának már ebben a művében is nagy szerepet játszik a történelmi dokumentumok meghamisításának motívuma. Visszamenőlegesen megváltoznak, majd feledésbe merülnek az állatok hajdani ideológusának, az Őrnagynak az eszméi. A Napóleon nevű nagy kan ragadja magához a hatalmat, és – természetesen mindig a megfelelő ideológiai magyarázattal – egyre zordabb diktatúrát kényszerít állattársaira. A szerző a „Tündérmese” alcímet adta regényének, mely eredetileg a sztálini korszak szatírája volt, de az emberek és az állatok minden diktátor alatt ugyanolyanok.', 144, 1945, 'https://moly.hu/system/covers/big/covers_651230.jpg?1610457047', '', ''),
(40, 'A ​ragyogás', 'A ​ragyogás pompás rémtörténet, amelyben minden hitchcocki klisé adva van: a Colorado-hegység egyik magaslatán a hó által a világtól elzárt szálloda, melynek története hátborzongató rémségek sorozatából áll; egy ún. „második látással”, vagyis ragyogással megáldott-megvert túlérzékeny kisfiú, aki azt is megérzi, ami csak történni fog, s érzékenységével jelen idejű fenyegetésként éli át, ami a múltban már megesett; az alkoholizmusából éppen kigyógyult apa, akinek labilis idegrendszere fokozatosan tovább bomlik, mígnem a Szálloda (amelynek történetét meg akarja írni) szelleme teljesen hatalmába keríti, s ezzel a pusztító szellemmel azonosulva családja megsemmisítésére tör; az elhatalmasodó tébolynak már-már természetfölötti őrületté fokozása, s ennek megfelelően olyan „képsorok”, amelyekhez hasonlók csak a Hitchcock-filmek tetőpontján találhatók; s végül – ha nem is mindenki számára – a megmenekülés.', 440, 1977, 'https://moly.hu/system/covers/big/covers_128601.jpg?1395390658', '', ''),
(41, 'Tortúra', 'Paul ​Sheldon sikeríró, a szépkeblű közönség bálványa befejezi legújabb és legjobb regényét, minek örömére jól benyakal, és kábán autóba vágja magát. Egy veszélyes útkanyarban utoléri az észak-amerikai Sziklás-hegységben nem ritka hóvihar. Isten háta mögötti, magányos tanyaházából bevásárolni indul kisteherautóján Annie Wilkes, a Sheldon-regények könnyes rajongója. Az árokba borult autóroncsban kedvenc szerzőjére ismer, kinek összetört testében alig pislákol az élet. Kihúzza az árokból. Hazaviszi. Életre kelti. Új Sheldon-regényt akar. Csak magának.', 460, 1987, 'https://moly.hu/system/covers/big/covers_592918.jpg?1583096682', '', ''),
(42, 'Az', 'Heten ​voltak, gyerekek – mind a heten a másság számkivetettjei: Bill, a bandavezér, mert dadogott; Ben, akit kövérsége miatt csúfoltak; Richie, aki mindig előbb jártatta a száját, és csak azután gondolkodott; Stan, akit zsidósága miatt közösítettek ki a többiek; Mike, akit a bőre színe miatt; Eddie, aki félt, szorongott, és persze súlyos asztmás volt, és végül az egyetlen lány, Beverly, aki csak szegény volt, rossz ruhákban járt, és akit az apja ütött-vert, testileg-lelkileg terrorizált. Ők jöttek össze, kötöttek életre-halálra szóló barátságot és vérszövetséget, ami oly nagy erőt adott nekik, hogy még a város életét pokollá tevő, huszonhét évenként feltámadó, gyermekekkel táplálkozó, ezerarcú szörnnyel is szembe mertek szállni odalenn, a város alatti kiismerhetetlen csatornarendszer labirintusában. Meg is sebesítik Az-t, majd felnőttként, drámaian megfogyatkozva újból visszatérnek, hogy gyermekkorukban tett fogadalmukat megtartsák, s ha lehet, egyszer s mindenkorra végezzenek vele – hogy a megmaradt és az eljövendő gyerekeket soha, de soha ne tarthassa többé rettegésben Az', 1200, 1986, 'https://moly.hu/system/covers/big/covers_688163.jpg?1627125008', '', ''),
(43, 'A ​Gyűrűk Ura', 'A ​Gyűrűk Ura tündérmese. Mégpedig – legalábbis terjedelmét tekintve – alighanem minden idők legnagyobb tündérmeséje. Tolkien képzelete szabadon, ráérősen kalandozik a három vaskos könyvben, amikor a világ sorát még nem az ember szabta meg, hanem a jót és szépet, a gonoszat és álnokot egyaránt ember előtti lények, ősi erők képviselték. Abban az időben, amikor a mi időszámításunk előtt ki tudja, hány ezer, tízezer esztendővel a Jó kisebbségbe szorult erői szövetségre léptek, hogy a Rossz erőit legyőzzék: tündék, féltündék, az ősi Nyugatfölde erényeit őrző emberek, törpök és félszerzetek, erdőtündék fogtak össze, hogy a jó varázslat eszközével, s a nagy mágus, Gandalf vezetésével végül győzelmet arassanak, de épp e győzelem következtében elenyésszen az ő idejük, s az árnyak birodalmába áthajózva átadják a földet új urának, az ember fajnak.\r\nKülönös világ ez az emberfölötti – vagy emberalatti – lényekkel benépesített Középfölde. Anyagi valósága nincs. Baljós, fekete várai, csodás fehér tornyai, fullasztó, sűrű erdei, gyilkos hegyei, sötét mélységei gondoskodnak róla, hogy egy pillanatig ne érezzük magunkat a fogható valóság közegében. Különös, hisz ebben a mesevilágban, ahol oly ékesen virágoznak a lovagi erények, véletlenül sem találkozunk az emelkedett eszményeket hirdető kora középkori lovagvilág fonákjával, az eszmények máza alatt a könyörtelen társadalmi tagozódással, elnyomással, nyomorral, létbizonytalansággal; ebben a külsőre feudálisnak tetsző világban jó is, rossz is vele születik a szereplőkkel, ott rejlik a szívük mélyén; a könyv személytelen szereplője a morál, az pedig kiben-kiben belső parancs.', 1840, 1955, 'https://moly.hu/system/covers/big/covers_569577.jpg?1643293682', '', ''),
(44, 'A ​hobbit', 'Ha ​megmozgatják a fantáziádat az oda és vissza történő utazások, amelyek kivezetnek a kényelmes nyugati világból, a Vadon szegélyén túlra, és érdekel egy egyszerű (némi bölcsességgel, némi bátorsággal és jelentős szerencsével megáldott) hős, akkor ez a könyv tetszeni fog, mivel épp egy ilyen út és utazó leírása található benne. A történet a Tündérország kora és az emberek uralma közti réges-régi időkben játszódik, mikor még állott a híres Bakacsinerdő, és a hegyek veszéllyel voltak tele. Az egyszerű kalandozó útját követve útközben megtudhatsz (ahogy ő is megtudott) – ha még nem ismernéd mindezeket a dolgokat – egyet s mást a trollokról, koboldokról, törpökről és tündékről, s bepillantást nyerhetsz egy elhanyagolt, de lényeges időszak történelmébe és eseményeibe. Mert Zsákos Bilbó úr számos jelentős személynél járt; beszélt a sárkánnyal, a hatalmas Smauggal; és akaratán kívül jelen volt az Öt Sereg Csatájánál. Ez annál is inkább figyelemre méltó, mivel ő egy hobbit. A hobbitok fölött a történelem és a legendák mind ez idáig átsiklottak, talán mert rendszerint többre tartják a kényelmet, mint az izgalmakat. Ez a személyes visszaemlékezések alapján készült beszámoló, amely Zsákos úr egyébként csendes életének egy izgalmas évét írja le, azonban képet adhat erről a becses népről, akik (úgy mondják) manapság megfogyatkoztak. Mert nem szeretik a zajt.', 306, 1937, 'https://moly.hu/system/covers/big/covers_489526.jpg?1524599125', '', ''),
(45, 'Onnan ​túlról', 'Howard Phillips Lovecraft (1890‒1937) a nagy elődök (elsősorban Edgar Allan Poe és Ambrose Bierce) nyomdokain haladva összetéveszthetetlen stílust, hovatovább mítoszt teremtett – a „kozmikus rettenet” irodalmát, melyben az emberi élet iránt totálisan közömbös természetfeletti erők felbukkanása egész modern civilizációnk-történelmünk létjogosultságát kérdőjelezi meg.\r\n\r\nLovecraft életműve az egyedülálló rémtörténetek kimeríthetetlen bőségszaruja: számottevő hatással volt napjaink legnépszerűbb fantasy-horror szerzőire (Clive Barkertől Neil Gaimanen át egészen Stephen Kingig), világszerte kultikus rajongással övezett műveit évről évre filmek, képregények, valamint video- és társasjátékok légiója dolgozza fel.\r\n\r\nVálogatásunk Lovecraft tizenegy rövidebb-hosszabb elbeszélését idézi meg; az angolszász horrorirodalom mára megkerülhetetlen klasszikusainak számító történeteket, valamint a szerző néhány kevésbé ismert, ám nem kevésbé vérfagyasztó és elgondolkodtató írását.', 218, 2024, 'https://moly.hu/system/covers/big/covers_545662.jpg?1555531742', '', ''),
(46, 'Árnyék ​Innsmouth fölött', 'Noha életében elkerülték a jelentősebb sikerek, Howard Phillips Lovecraftot (1890-1937) napjainkban már a modern horror műfajának egyik legnagyobb hatású alkotójaként tartja számon a tágabb irodalmi köztudat, műveit világszerte kultikus rajongás övezi.\r\nNeve elválaszthatatlanul összefonódott az általa megálmodott „Cthulhu-mítosz”-szal – ezzel a megannyi rémtörténetből felépülő, visszatérő elemekkel (&quot;Necronomicon&quot;, „Cthulhu”, „Arkham” – ezek ma már a popkultúra bejáratott hívószavai) megszilárdított sötét szöveguniverzummal, amelynek alapzatát az ismeretlentől való ősi félelem szolgáltatja; annak iszonytató gyanúja, hogy az emberiség csupán jelentéktelen mellékszerepet játszik a modern világ díszletei mögött rejtőző kozmikus entitások mellett.\r\nA Helikon Zsebkönyvek második Lovecraft-válogatásában három hosszabb novellán (Cthulhu hívása, Árnyék Innsmouth fölött, A dolog a küszöbön) keresztül kaphatunk betekintést a „Cthulhu-mítosz” lebilincselő izgalmaiba', 244, 2023, 'https://moly.hu/system/covers/big/covers_609299.jpg?1589826714', '', ''),
(47, 'Utas ​és holdvilág', 'Mikor ​döbbenjen rá egy férfi, hogy nem adhatja föl ifjúsága eszményeit, és nem hajthatja fejét „csak úgy&quot; a házasság jármába, ha nem a nászútján? Szerb Antal regénybeli utasa holdvilágos transzban szökik meg fiatal felesége mellől, hogy kiegészítse, továbbélje azt az ifjúságot, amely visszavonhatatlanul elveszett. A szökött férj arra a kérdésre keresi a választ, hogy a lélek időgépén vissza lehet-e szállni a múltba, vajon torzónak maradt élet-epizódokkal kiteljesíthető-e a jelen, és megszabadulhat-e valamikor az ember énje börtönéből vagy hazugnak gondolt „felnőttsége&quot; bilincseitől? Az Utas és holdvilág a magát kereső ember önelemző regénye. Mihály, a regény hőse hiába akar előbb a házassága révén konformista polgári életet élni, s hiába szökik meg ez elől az élet elöl, a regény végén ott tart, ahol az elején: mégis bele kell törnie mindabba, amibe nem akar. „És ha az ember él, még mindig történhet valami&quot; – ezzel a mondattal zárul a finom lélektani részletekkel megírt, először 1937-ben megjelent regény, amely első megjelenése óta hatalmas világsikerre tett szert.', 280, 1937, 'https://moly.hu/system/covers/big/covers_824650.jpg?1694007616', '', ''),
(48, 'A ​Pendragon-legenda', 'Bátky János, a fiatal magyar tudós meghívást kap Skóciába, a llanwygani kastélyba, hogy kutatásokat folytasson a rózsakeresztesekkel kapcsolatban. Megérkezése után nem sokkal belekeveredik egy modern bűnügybe, ami egy hatalmas vagyon megszerzése körül forog, illetve kísértetekkel, szélhámosokkal és évszázados rejtélyekkel is találkozik.\r\n\r\nSzerb Antal 1934-ben megjelent és azóta is töretlen népszerűségnek örvendő műve bűnügyi regény, esszéregény és kísértethistória keveréke, valamint mindezeknek a rendkívül szellemes paródiája is egyben, amit a szerző filológiai detektívregénynek nevezett.\r\n\r\nAz Időkapu sorozat ezzel a kötettel egyszerre tiszteleg Szerb Antal emléke előtt, és kínál lehetőséget egy újabb nemzedéknek arra, hogy felfedezze magának ezt a csodálatosan vicces és fantasztikusan okos regényt.', 240, 1934, 'https://moly.hu/system/covers/big/covers_895474.jpg?1732390764', '', ''),
(49, 'Metró ​2033', '2033.\r\nAz egész világ romokban hever.\r\nAz emberiség majdnem teljesen elpusztult.\r\nMoszkva szellemvárossá változott, megmérgezte a radioaktív sugárzás, és szörnyek népesítik be. A kevés életben maradt ember a moszkvai metróban bújik meg – a Föld legnagyobb atombombabiztos óvóhelyén. A metró állomásai most városállamok, az alagutakban sötétség honol, és borzalom fészkel.\r\nArtyomnak az egész metróhálózaton át kell jutnia, hogy megmentse a szörnyű veszedelemtől az állomását, sőt talán az egész emberiséget.', 440, 2005, 'https://moly.hu/system/covers/big/covers_584956.jpg?1577631301', '', ''),
(50, 'Végjáték', 'A Föld újra támadás alatt áll. Egy földönkívüli faj a végső csatára készülődik. Az emberiség túléléséhez egy katonai géniuszra van szükség, aki talán legyőzheti az idegeneket.\r\nDe ki lesz az?\r\nEnder Wiggin. Zseni. Könyörtelen. Ravasz. A taktika és a stratégia mestere. És gyermek.\r\nA Nemzetközi Flotta besorozza katonai kiképzésre, s amint Ender belép új otthonának, a Hadiskolának a kapuin, gyermekkora azonnal véget ér. Az újoncok közül kiemelkedve Ender bebizonyítja, hogy géniusz a géniuszok között. A harci szimulációk koronázatlan királyává válik. De vajon meddig bírja a magányt és a rá nehezedő nyomást? A szimulációkban sikereket ért el, de hogyan fog majd bizonyítani az igazi csatamezőn? Elvégre, a Hadiskola csak játék.\r\nVagy mégsem?', 366, 1985, 'https://moly.hu/system/covers/big/covers_276309.jpg?1395474425', '', '');

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
(85, 30, 6),
(86, 31, 6),
(87, 32, 6),
(88, 33, 6),
(89, 22, 1),
(90, 22, 7),
(91, 24, 1),
(92, 24, 7),
(95, 25, 1),
(96, 25, 7),
(97, 34, 1),
(98, 34, 7),
(99, 35, 1),
(100, 35, 7),
(101, 36, 1),
(102, 36, 7),
(103, 37, 1),
(104, 37, 7),
(105, 38, 3),
(107, 39, 8),
(108, 4, 4),
(109, 4, 8),
(110, 40, 8),
(111, 40, 9),
(112, 41, 9),
(113, 42, 9),
(114, 43, 1),
(115, 44, 1),
(116, 45, 9),
(117, 46, 9),
(118, 47, 4),
(119, 47, 8),
(120, 48, 6),
(121, 49, 3),
(122, 49, 9),
(123, 50, 3),
(124, 2, 3),
(125, 3, 8);

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
(38, 30, 15),
(39, 31, 15),
(40, 32, 15),
(41, 33, 15),
(42, 22, 1),
(43, 24, 1),
(45, 25, 1),
(46, 34, 1),
(47, 35, 1),
(48, 36, 1),
(49, 37, 1),
(50, 38, 2),
(52, 39, 3),
(53, 4, 4),
(54, 40, 9),
(55, 41, 9),
(56, 42, 9),
(57, 43, 10),
(58, 44, 10),
(59, 45, 11),
(60, 46, 11),
(61, 47, 12),
(62, 48, 12),
(63, 49, 13),
(64, 50, 14),
(65, 2, 2),
(66, 3, 2),
(67, 3, 3);

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
(7, 22, 3),
(8, 24, 3);

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
(1, 'J.K. Rowling', 'https://cdn.moly.hu/file/molyhu/pictures/normal/pictures_322.jpg?1492714015', '1967-07-31', '0000-00-00', 'Angol'),
(2, 'Isaac Asimov', 'https://cdn.moly.hu/file/molyhu/pictures/big/pictures_3145.jpg?1500118177', '1920-01-02', '1992-04-06', 'Orosz'),
(3, 'George Orwell', 'https://cdn.moly.hu/file/molyhu/pictures/big/pictures_3203.jpg?1500465288', '1903-06-25', '1950-01-21', 'Angol'),
(4, 'Márai Sándor', 'https://cdn.moly.hu/file/molyhu/pictures/big/pictures_7661.jpg?1523472551', '1900-04-11', '1989-02-21', 'Magyar'),
(9, 'Stephen King', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Stephen_King_at_the_2024_Toronto_International_Film_Festival_2_%28cropped%29.jpg/800px-Stephen_King_at_the_2024_Toronto_International_Film_Festival_2_%28cropped%29.jpg', '1947-09-21', '0000-00-00', 'Amerikai'),
(10, 'J. R. R. Tolkien', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/J._R._R._Tolkien%2C_ca._1925.jpg/800px-J._R._R._Tolkien%2C_ca._1925.jpg', '1982-01-03', '1973-09-02', 'Angol'),
(11, 'Howard Phillips Lovecraft', 'https://upload.wikimedia.org/wikipedia/commons/9/95/Howard_Phillips_Lovecraft.jpg', '1890-08-20', '1937-03-15', 'Amerikai'),
(12, 'Szerb Antal', 'https://upload.wikimedia.org/wikipedia/commons/c/c0/Szerb_Antal.jpg', '1901-05-01', '1945-01-27', 'Magyar'),
(13, 'Dmitrij Gluhovszkij', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Dmitry_Glukhovsky.jpg/800px-Dmitry_Glukhovsky.jpg', '1979-06-12', '0000-00-00', 'Orosz'),
(14, 'Orson Scott Card', 'https://upload.wikimedia.org/wikipedia/commons/6/6e/Orson_Scott_Card_at_BYU_Symposium_20080216_closeup.jpg', '1951-08-24', '0000-00-00', 'Amerikai'),
(15, 'Agatha Christie', 'https://upload.wikimedia.org/wikipedia/commons/c/cf/Agatha_Christie.png', '1890-09-15', '1976-01-12', 'Angol');

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
(5, 25, 3),
(10, 3, 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `kedvencek`
--
ALTER TABLE `kedvencek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT a táblához `konyvek`
--
ALTER TABLE `konyvek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT a táblához `konyv_kategoria`
--
ALTER TABLE `konyv_kategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT a táblához `konyv_szerzo`
--
ALTER TABLE `konyv_szerzo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT a táblához `olvasott`
--
ALTER TABLE `olvasott`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `szerzok`
--
ALTER TABLE `szerzok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `varolistak`
--
ALTER TABLE `varolistak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
