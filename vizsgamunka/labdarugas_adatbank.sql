-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2021 at 10:14 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labdarugas_adatbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `bajnoksagok`
--

CREATE TABLE `bajnoksagok` (
  `Id` int(11) NOT NULL,
  `Nev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `Nacionalitas` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `Nehezseg` int(11) NOT NULL,
  `Leiras` text COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `bajnoksagok`
--

INSERT INTO `bajnoksagok` (`Id`, `Nev`, `Nacionalitas`, `Nehezseg`, `Leiras`) VALUES
(1, 'La Liga Santander', 'Spanyol', 10, '2020. szeptember 12. és 2021. május 23. között rendezik meg a spanyol élvonalbeli labdarúgó-bajnokság (La Liga) 90. idényét. A mezőnyt húsz csapat alkotja, a bajnoki címvédő a Real Madrid, a másodosztályból a Cádiz, az Elche és az Huesca jutott fel. Az első négy helyezett a Bajnokok Ligája főtáblájára kerül, az ötödik helyezett – akárcsak a Király Kupa győztese – az Európa-liga csoportkörébe, a hatodik pedig az új UEFA-sorozat, az Európa-konferencialiga playoff körébe. Az utolsó három helyezett kiesik. A spanyol bajnokság mérkőzései idehaza a Spíler TV csatornáin láthatók.'),
(2, 'Premier League', 'Angol', 10, '2020. szeptember 12. és 2021. május 23. között rendezik meg az angol élvonalbeli labdarúgó-bajnokság (Premier League) 29. idényét. A mezőnyt húsz csapat alkotja, a bajnoki címvédő a Liverpool, a Championshipből a West Bromwich Albion, a Leeds United és a Fulham jutott fel. Az első négy helyezett a Bajnokok Ligája főtáblájára kerül, míg az ötödik helyezett – akárcsak az FA-kupa győztese – az Európa-liga csoportkörébe. Az utolsó három helyezett kiesik. Az angol bajnokság mérkőzései idehaza a Spíler 1 csatornán láthatók.'),
(3, 'Bundesliga', 'Német', 10, '2020. szeptember 18. és 2021. május 22. között rendezik meg a német élvonalbeli labdarúgó-bajnokság (Bundesliga) 58. idényét. A mezőnyt tizennyolc csapat alkotja, a bajnoki címvédő a Bayern München, a Bundesliga 2-ből az Arminia Bielefeld és a Vfb Stuttgart jutott fel. Az első négy helyezett a Bajnokok Ligája főtáblájára kerül, míg az ötödik helyezett – akárcsak az német Kupa győztese – az Európa-liga csoportkörébe. Az utolsó két helyezett kiesik, a 16. helyezett osztályzót vív a másodosztály harmadik helyezettjével. A német bajnokság mérkőzései idehaza a Sport Tv csatornáin láthatók.'),
(4, 'Ligue 1 ', 'Francia', 10, 'A Ligue 1 (Première division vagy Division 1 2003-ig, jelenleg Ligue 1) a francia és a monacói labdarúgás legmagasabb osztálya, az LFP egyik divíziója, a másik a francia másodosztály, a Ligue 2 1932-ben alapították, a második világhbáorú vége óta többször volt a bajnokság 18 és 20 csapatos rendszerű is. A 20 Ligue 1 csapat egy 38 fordulós szezonban kétszer játszik egymással (egy hazai és egy idegenbeli mérkőzést). A szezon végén a tabella utolsó három helyén álló csapat kiesik a Ligue 2-be, onnan szintén 3 csapat érkezik a helyükre. Jelenleg a bajnokság első három helyén álló csapat bekerül a Bajnokok ligájába, az első kettő a csoportkörben, míg a harmadik az utolsó selejtezőkörben indulhat. A negyedik és ötödik helyen végző csapatok az Európa ligában indulhatnak. A győzelemért 3 pont jár, a döntetlenért 1, a vereségért egy sem, ugyanúgy, mint a többi labdarúgó-bajnokságban. A három pontos szabályt 1994-ben vezették be. Egyenlő pontszám esetén a gólkülönbség dönt a helyezésről. A 2019-2020-as idényt a koronavírus-járvány miatt félbeszakították és a listavezető Paris Saint-Germaint hirdették ki bajnoknak.'),
(5, 'Serie A', 'Olasz', 10, 'Szeptember 19-én megkezdődött az olasz Serie A 2020–2021-es idénye, amely 2021. május 23-án ér véget. A címvédő a Juventus, újonc a másodosztályú bajnok Benevento, a második Crotone, valamint a Serie B-s rájátszást megnyerő Spezia, amely fennállása során először szerepel a legmagasabb osztályban. Az első négy kerül a BL-csoportkörbe, az ötödik az El-csoportkörbe, a hatodik meg az új UEFA-sorozat, az Európa-konferencialiga playoff körébe, az utolsó három kiesik.'),
(6, 'NB I', 'Magyar', 4, ' A magyar labdarúgó-bajnokság élvonalbeli versenyét 1901 óta rendezik meg. Hagyományos neve: NB I. (nemzeti bajnokság). Napjainkban a Magyar labdarúgó szövetség szervezi.');

-- --------------------------------------------------------

--
-- Table structure for table `bajnoksagok_csapatok`
--

CREATE TABLE `bajnoksagok_csapatok` (
  `Id` int(11) NOT NULL,
  `bajnoksag_id` int(11) NOT NULL,
  `csapat_id` int(11) NOT NULL,
  `Pontok` int(11) NOT NULL,
  `Helyezes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `bajnoksagok_csapatok`
--

INSERT INTO `bajnoksagok_csapatok` (`Id`, `bajnoksag_id`, `csapat_id`, `Pontok`, `Helyezes`) VALUES
(1, 1, 1, 15, 3),
(2, 1, 2, 16, 2),
(3, 1, 3, 3, 5),
(4, 1, 4, 4, 4),
(5, 1, 5, 21, 1),
(6, 2, 6, 6, 2),
(7, 2, 7, 6, 3),
(8, 2, 8, 9, 1),
(9, 2, 9, 1, 4),
(10, 2, 10, 1, 5),
(11, 5, 12, 1, 2),
(12, 5, 11, 4, 1),
(13, 4, 13, 6, 1),
(14, 4, 14, 0, 2),
(15, 6, 15, 4, 1),
(16, 6, 16, 1, 2),
(17, 3, 17, 3, 1),
(18, 3, 18, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `csapatok`
--

CREATE TABLE `csapatok` (
  `Id` int(11) NOT NULL,
  `Nev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `Gyorsasag` int(11) NOT NULL,
  `Vedekezes` int(11) NOT NULL,
  `Kozeppalya` int(11) NOT NULL,
  `Tamadas` int(11) NOT NULL,
  `Moralitas` int(11) NOT NULL,
  `Forma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `csapatok`
--

INSERT INTO `csapatok` (`Id`, `Nev`, `Gyorsasag`, `Vedekezes`, `Kozeppalya`, `Tamadas`, `Moralitas`, `Forma`) VALUES
(1, 'Barcelona', 8, 7, 9, 10, 7, 6),
(2, 'Real Madrid', 8, 7, 9, 8, 7, 6),
(3, 'Sevilla', 8, 9, 7, 7, 8, 9),
(4, 'Real Sociedad', 8, 8, 7, 8, 9, 10),
(5, 'Atletico de Madrid', 9, 10, 10, 9, 10, 10),
(6, 'Manchester City', 7, 8, 8, 9, 9, 9),
(7, 'Liverpool', 10, 9, 10, 10, 7, 6),
(8, 'Manchester United', 7, 6, 7, 8, 9, 10),
(9, 'Arsenal', 5, 5, 7, 7, 5, 5),
(10, 'Chelsea', 10, 7, 8, 7, 7, 4),
(11, 'Juventus', 9, 9, 9, 10, 9, 10),
(12, 'Internazionale', 9, 9, 9, 9, 8, 10),
(13, 'Paris Saint German', 9, 9, 9, 10, 9, 9),
(14, 'Monaco', 4, 4, 4, 5, 7, 6),
(15, 'Ferencváros', 3, 3, 3, 3, 10, 10),
(16, 'Videoton', 3, 3, 3, 3, 10, 10),
(17, 'Bayern Munchen', 8, 9, 9, 10, 10, 10),
(18, 'Dortmund', 10, 8, 8, 10, 9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `edzok`
--

CREATE TABLE `edzok` (
  `Id` int(11) NOT NULL,
  `Csapat_Id` int(11) NOT NULL,
  `Nev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `Eletkor` int(11) NOT NULL,
  `Nemzetiseg` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `Ertekeles` int(11) NOT NULL,
  `Legnagyobb_siker` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `Elet_tortenete` text COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `edzok`
--

INSERT INTO `edzok` (`Id`, `Csapat_Id`, `Nev`, `Eletkor`, `Nemzetiseg`, `Ertekeles`, `Legnagyobb_siker`, `Elet_tortenete`) VALUES
(1, 1, 'Ronald Koeman', 56, 'Holland', 9, 'Copa del Rey', ' Ronald Koeman (Zaandam, 1963. március 21. –) holland labdarúgóedző és korábbi labdarúgó, Európa-bajnok. Jelenleg az FC Barcelona vezetőedzője.\r\n\r\nJátékosként évekig szerepelt az FC Barcelona együttesében, amellyel 1992-ben megnyerte a Bajnokcsapatok Európa-kupáját, illetve négyszer egymás után a spanyol bajnokságot.\r\n\r\nEdzői pályafutása során volt az Ajax Amsterdam, a Benfica, a Valencia CF és az AZ Alkmaar szakvezetője is.\r\n\r\nA bátyja Erwin Koeman, édesapjuk Martin Koeman.'),
(2, 4, 'Paul Di Resta', 57, 'Olasz', 9, 'Copa Del Rey', '1964-ben született Torinóban. Edző volt a Ferencvárosnál, Honvédnál, illetve most 6. éve edzi a Real Sociedad csapatát. '),
(3, 2, 'Zinedine Zidane', 56, 'Francia ', 10, 'Bajnokok ligája győzelem', 'Világ- és Európa-bajnok. 108-szoros francia válogatott, UEFA-bajnokok ligája-győztes, kétszeres európai Szuperkupa-győztes, UEFA-kupa-győztes, kétszeres olasz, egyszeres spanyol bajnok. A FIFA háromszor választotta az év labdarúgójának. 1998-ban aranylabdát nyert. A FIFA 100-nak a tagja, amely a világ valaha volt legjobb labdarúgóit tartalmazza.\r\nUtolsó mérkőzését 2006. július 9-én, a labdarúgó világbajnokság Franciaország-Olaszország döntőjén játszotta, melynek 110. percében egy súlyos, szándékos szabálytalanság miatt (mellbe fejelte az őt provokáló olasz Marco Materazzit) kiállították. 2013-tól 2014-ig Carlo Ancelotti mellett segédedző volt a Real Madridban, illetve 2014–16-ig a Real Madrid Castilla edzője. A Real Madrid CF edzőjeként már az első (fél)szezonjában bajnokok-ligája győztes lett. Zidane-nak mind a három fia futballista: Enzo Zidane Fernández, aki a svájci Lausanne Sport Club játékosa, Theo Zidane, a Real Madrid Castillában játszik, valamint Luca Zidane, aki a Real Madrid játékosa, de kölcsönben a Racing Santanderben szerepel.\r\n'),
(4, 5, 'Diego Simeone', 47, 'Argentín', 10, 'Bajnokok ligája 2. hely', 'Diego Simeone vagy Diego Pablo Simeone (Buenos Aires, 1970. április 28. –) argentin labdarúgó, középpályás, edző. A harmadik legtöbb válogatottsággal rendelkezik Argentínában. 2011-től a spanyol Atlético Madrid vezetőedzője.\r\nAmikor Simeone 14 éves volt, az ifjúsági edzője, Victorio Spinetto a Cholo becenevet adta neki, mivel az energikus játéka emlékeztette őt egy korábbi argentin válogatott és Boca Juniors-játékosra, Carmelo Simeone-ra. \r\n\r\n'),
(5, 6, 'Josep Guardiola', 50, 'Spanyol', 10, 'Bajnokok ligája győzelem', 'Josep Guardiola i Sala, vagy Pep Guardiola (Santpedor, 1971. január 18. –) olimpiai bajnok spanyol labdarúgó, labdarúgóedző, 2016 nyarától a Manchester City vezetőedzője.\r\n'),
(6, 7, 'Jürgen Klopp', 53, 'Német', 10, 'Bajnokok ligája győzelem', 'Jürgen Norbert Klopp (Stuttgart, 1967. június 16. –) német labdarúgó, edző. Posztját tekintve csatár, hátvéd. Játékosként az 1. FSV Mainz 05 egyik legtöbbet szereplő csatára, majd hátvédje volt. 2001-ben, szezon közben lett játékosból edző. 2008 és 2015 között a Borussia Dortmund vezetőedzője, amellyel kétszer nyert német bajnokságot, egyszer német kupát nyert. 2013-ban csapatával az UEFA-bajnokok ligája döntőjében szerepelt. 2015-től a Liverpool FC menedzsere. 2019-ben BL győztes lett csapatával.\r\n'),
(7, 8, 'Ole Gunnar Solkjaer', 47, 'Norvég', 7, 'Premier League 5. hely', 'Ole Gunnar Solskjær (Kristiansund, 1973. február 26. –) norvég Bajnokok Ligája és Világkupa győztes labdarúgó. 2018-tól a Premier League-ben szereplő Manchester United menedzsere. A norvég labdarúgó-válogatottban 67 mérkőzésen 23 gólt szerzett, az utolsó két találatát a magyar labdarúgó-válogatott ellen szerezte 2006. szeptember 2-án a 2008-as labdarúgó-Európa-bajnokság selejtezőjén Budapesten.\r\n\r\nŐt tartották a világ egyik legjobb cserejátékosának. Ezt bizonyítandó 1999-ben, a Bayern München elleni BL döntőben, amikor 4 perccel becserélését követően, a mérkőzés hosszabbításában belőtte csapata győztes gólját.\r\n\r\nÁllandó térdproblémái miatt sokat volt sérült, pályafutását is emiatt kellett befejeznie 2007 augusztus 27-én. Ezt követően 2008 és 2011 között a Manchester United tartalékcsapatának edzőjeként dolgozott, mielőtt hazatért korábbi együtteséhez, a Molde FK-hoz. A csapattal 2011-ben és 2012-ben is norvég bajnoki címet szerzett és részt vett a 2012–13-as Európa-liga csoportkörében.\r\n\r\nSzülővárosában egy fiatal labdarúgók számára létrehozott akadémiát felügyel és pártfogója a Manchester United Supporters’ Trust (korábban Shareholders United - Részvényesek szurkolói csoportja) nevű szervezetnek.\r\n'),
(8, 9, 'Mikel Arteta', 38, 'Spanyol', 8, 'Angol kupa győzelem', 'Mikel Arteta Amatriain (born 26 March 1982) is a Spanish professional football manager and former player. He is currently the manager of Premier League club Arsenal. \r\nBorn in San Sebastián, Arteta began his senior career at Barcelona in 1999, but limited playing time led to a loan move to Paris Saint-Germain in 2001. He then signed for Rangers, winning the double of the Premier League and League Cup in his debut season. After a brief return to hometown club Real Sociedad, Arteta joined Everton on loan in 2005; he later signed permanently. He signed for Arsenal in 2011, where he won two FA Cups and served as captain from 2014 until his retirement in 2016.\r\nArteta represented Spain through several youth levels, but never played for the senior national team. \r\nAfter retiring, Arteta was appointed as an assistant coach at Manchester City in 2016. In 2019, he returned to Arsenal as manager and won the FA Cup in his first year. \r\n\r\n\r\n'),
(9, 10, 'Thomas Tuchel', 47, 'Német', 9, 'Francia bajnok', 'Thomas Tuchel born 29 August 1973 is a German professional football coach and former player who is the head coach at Premier League club Chelsea. Revered for his tactical knowledge, however Tuchel\'s coaching career has been noted by his toxic relationships with his employers.\r\nBorn in Krumbach, Tuchel\'s playing career ended at age 25, as a result of a chronic knee cartilage injury, and in 2000, he began his coaching career, working for the youth teams at VfB Stuttgart for five years. In 2009, following a successful one-year period at FC Augsburg II, he was hired by newly promoted Bundesliga club Mainz 05.\r\nTuchel guided Mainz to league stability during his five seasons at the club, and gained plaudits for his brand of energetic, attacking football. He also cultivated a reputation for having a focus on promoting youth players. He departed Mainz in 2014 as a result of financial disputes, and in 2015, was appointed at fellow Bundesliga club Borussia Dortmund, where he won the DFB-Pokal before being dismissed in 2017. \r\nHe was then hired at French club Paris Saint-Germain in 2018, where he won two league titles, including a domestic quadruple in his second season, and guided the club to its first ever UEFA Champions League final.  However, Tuchel was dismissed in 2020 and was appointed by English club Chelsea in 2021. \r\n\r\n\r\n\r\n'),
(10, 3, 'Julen Lopetegui', 57, 'Spanyol', 8, 'Európa bajnokság', 'Julen Lopetegui Argote (Asteasu, 1966. augusztus 28. –) spanyol labdarúgó, edző. 2016 és 2018 nyara közt a spanyol válogatott szövetségi kapitánya, majd a 2018-as világbajnokságot követően a Real Madrid vezetőedzője volt. Jelenleg a Sevilla vezetőedzője.  \r\n\r\n\r\n\r\n'),
(11, 11, 'Freddie McGinn', 65, 'Angol', 9, 'Bl trófea', 'korábbi labdarúgó, Európa-bajnok. Jelenleg az FC Barcelona vezetőedzője.\\r\\n\\r\\nJátékosként évekig szerepelt az FC Barcelona együttesében, amellyel 1992-ben megnyerte a Bajnokcsapatok Európa-kupáját, illetve négyszer egymás után a spanyol bajnokságot.\\r\\n\\r\\nEdzői pályafutása során volt az Ajax Amsterdam, a Benfica, a Valencia CF és az AZ Alkmaar '),
(12, 12, 'Herr Germann', 67, 'Német ', 9, 'Bl trófea', 'korábbi labdarúgó, Európa-bajnok. Jelenleg az FC Barcelona vezetőedzője.\\r\\n\\r\\nJátékosként évekig szerepelt az FC Barcelona együttesében, amellyel 1992-ben megnyerte a Bajnokcsapatok Európa-kupáját, illetve négyszer egymás után a spanyol bajnokságot.\\r\\n\\r\\nEdzői pályafutása során volt az Ajax Amsterdam, a Benfica, a Valencia CF és az AZ Alkmaar '),
(13, 13, 'Fenyősi Bertalan', 65, 'Magyar', 8, 'Bl trófea', 'korábbi labdarúgó, Európa-bajnok. Jelenleg az FC Barcelona vezetőedzője.\\r\\n\\r\\nJátékosként évekig szerepelt az FC Barcelona együttesében, amellyel 1992-ben megnyerte a Bajnokcsapatok Európa-kupáját, illetve négyszer egymás után a spanyol bajnokságot.\\r\\n\\r\\nEdzői pályafutása során volt az Ajax Amsterdam, a Benfica, a Valencia CF és az AZ Alkmaar '),
(14, 13, 'Scott McTominay', 67, 'Angol', 9, 'Bl trófea', 'korábbi labdarúgó, Európa-bajnok. Jelenleg az FC Barcelona vezetőedzője.\\r\\n\\r\\nJátékosként évekig szerepelt az FC Barcelona együttesében, amellyel 1992-ben megnyerte a Bajnokcsapatok Európa-kupáját, illetve négyszer egymás után a spanyol bajnokságot.\\r\\n\\r\\nEdzői pályafutása során volt az Ajax Amsterdam, a Benfica, a Valencia CF és az AZ Alkmaar '),
(15, 14, 'Földes Kálmán', 67, 'Magyar', 9, 'Bl trófea', 'korábbi labdarúgó, Európa-bajnok. Jelenleg az FC Barcelona vezetőedzője.\\r\\n\\r\\nJátékosként évekig szerepelt az FC Barcelona együttesében, amellyel 1992-ben megnyerte a Bajnokcsapatok Európa-kupáját, illetve négyszer egymás után a spanyol bajnokságot.\\r\\n\\r\\nEdzői pályafutása során volt az Ajax Amsterdam, a Benfica, a Valencia CF és az AZ Alkmaar '),
(16, 15, 'Hegyvidéki István', 65, 'Magyar', 9, 'Magyar bajnokság', 'korábbi labdarúgó, Európa-bajnok. Jelenleg az FC Barcelona vezetőedzője.\\r\\n\\r\\nJátékosként évekig szerepelt az FC Barcelona együttesében, amellyel 1992-ben megnyerte a Bajnokcsapatok Európa-kupáját, illetve négyszer egymás után a spanyol bajnokságot.\\r\\n\\r\\nEdzői pályafutása során volt az Ajax Amsterdam, a Benfica, a Valencia CF és az AZ Alkmaar '),
(17, 16, 'Mezővári Kálmán', 65, 'Magyar', 8, 'Magyar bajnokság', 'korábbi labdarúgó, Európa-bajnok. Jelenleg az FC Barcelona vezetőedzője.\\r\\n\\r\\nJátékosként évekig szerepelt az FC Barcelona együttesében, amellyel 1992-ben megnyerte a Bajnokcsapatok Európa-kupáját, illetve négyszer egymás után a spanyol bajnokságot.\\r\\n\\r\\nEdzői pályafutása során volt az Ajax Amsterdam, a Benfica, a Valencia CF és az AZ Alkmaar '),
(18, 17, 'Száva József', 45, 'Magyar', 8, 'Német bajnokság', 'korábbi labdarúgó, Európa-bajnok. Jelenleg az FC Barcelona vezetőedzője.\\r\\n\\r\\nJátékosként évekig szerepelt az FC Barcelona együttesében, amellyel 1992-ben megnyerte a Bajnokcsapatok Európa-kupáját, illetve négyszer egymás után a spanyol bajnokságot.\\r\\n\\r\\nEdzői pályafutása során volt az Ajax Amsterdam, a Benfica, a Valencia CF és az AZ Alkmaar '),
(19, 18, 'Alvaro Soler', 65, 'Spanyol', 8, 'Német bajnokság', 'korábbi labdarúgó, Európa-bajnok. Jelenleg az FC Barcelona vezetőedzője.\\r\\n\\r\\nJátékosként évekig szerepelt az FC Barcelona együttesében, amellyel 1992-ben megnyerte a Bajnokcsapatok Európa-kupáját, illetve négyszer egymás után a spanyol bajnokságot.\\r\\n\\r\\nEdzői pályafutása során volt az Ajax Amsterdam, a Benfica, a Valencia CF és az AZ Alkmaar ');

-- --------------------------------------------------------

--
-- Table structure for table `jatekos`
--

CREATE TABLE `jatekos` (
  `Id` int(11) NOT NULL,
  `Csapat_id` int(11) NOT NULL,
  `Bajnoksag_id` int(11) NOT NULL,
  `Nev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `Poszt_id` int(11) NOT NULL,
  `Eletkor` int(11) NOT NULL,
  `Magassag` int(11) NOT NULL,
  `Suly` int(11) NOT NULL,
  `Meccs` int(11) NOT NULL,
  `Gol` int(11) NOT NULL,
  `Gol_meccs` decimal(11,0) NOT NULL,
  `Golpassz` int(11) NOT NULL,
  `Golpassz_meccs` decimal(11,0) NOT NULL,
  `Beadas` int(11) NOT NULL,
  `Sikeres_beadas` int(11) NOT NULL,
  `Nemzetiseg` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `Ertek` int(11) NOT NULL,
  `Fizetes` int(11) NOT NULL,
  `Serulesek` int(11) NOT NULL,
  `Atigazolas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `jatekos`
--

INSERT INTO `jatekos` (`Id`, `Csapat_id`, `Bajnoksag_id`, `Nev`, `Poszt_id`, `Eletkor`, `Magassag`, `Suly`, `Meccs`, `Gol`, `Gol_meccs`, `Golpassz`, `Golpassz_meccs`, `Beadas`, `Sikeres_beadas`, `Nemzetiseg`, `Ertek`, `Fizetes`, `Serulesek`, `Atigazolas`) VALUES
(1, 1, 1, 'Lionel Messi', 13, 33, 170, 68, 767, 650, '0', 451, '0', 1276, 778, 'Argentín', 120000000, 30000000, 2, 0),
(2, 1, 1, 'Marc-André Ter Stegen', 1, 27, 182, 78, 600, 0, '0', 3, '0', 0, 0, 'Német', 77000000, 20000000, 5, 3),
(3, 1, 1, 'Antoine Griezmann', 12, 27, 182, 81, 700, 521, '0', 302, '0', 1200, 894, 'Francia', 72000000, 25000000, 5, 7),
(4, 2, 1, 'Tibout Courtis', 1, 27, 187, 76, 400, 0, '0', 0, '0', 0, 0, 'Belga', 67000000, 23000000, 3, 8),
(5, 2, 1, 'Karim Benzema', 13, 35, 182, 78, 502, 351, '0', 243, '0', 1478, 902, 'Francia', 35000000, 14000000, 8, 5),
(6, 2, 1, 'Luka Modric', 13, 32, 176, 72, 502, 78, '0', 250, '0', 1500, 1248, 'Horvát', 38000000, 12000000, 6, 3),
(7, 3, 1, 'Ivan Rakitic', 6, 34, 182, 76, 722, 230, '0', 457, '0', 1317, 768, 'Horvát', 22000000, 10000000, 14, 7),
(8, 3, 1, 'Antonio Bellazza', 9, 25, 192, 85, 300, 187, '0', 78, '0', 765, 457, 'Olasz', 57000000, 7000000, 8, 2),
(9, 3, 1, 'Kádár Roland', 13, 18, 182, 75, 121, 103, '0', 65, '0', 217, 203, 'Magyar', 7000000, 2000000, 0, 1),
(10, 4, 1, 'Giovanni Da Silva', 10, 22, 175, 68, 217, 154, '0', 32, '0', 117, 78, 'Brazil', 17000000, 5000000, 7, 3),
(11, 4, 1, 'Ivan Walkow', 1, 27, 198, 94, 417, 0, '0', 0, '0', 0, 0, 'Orosz', 47000000, 120000000, 4, 3),
(12, 5, 1, 'Jan Oblak', 1, 27, 197, 92, 617, 0, '0', 0, '0', 0, 0, 'Szlovén', 97000000, 23000000, 3, 5),
(13, 5, 1, 'Luis Suarez', 13, 35, 178, 73, 762, 674, '0', 102, '0', 2578, 1788, 'Uruguayi', 17000000, 24000000, 8, 3),
(14, 6, 2, 'Sergio Aguero', 13, 34, 178, 67, 500, 300, '0', 300, '0', 1300, 700, 'Argentín', 12000000, 10000000, 9, 6),
(15, 6, 2, 'Eric Garcia', 2, 24, 178, 67, 200, 12, '0', 37, '0', 400, 314, 'Spanyol', 24000000, 7000000, 8, 2),
(16, 7, 2, 'Virgil Van Dijk', 2, 34, 78, 64, 56, 75, '0', 64, '0', 84, 26, 'Holland', 86, 86, 95, 34),
(17, 7, 2, 'Roberto Firmino', 2, 87, 67, 56, 45, 98, '0', 76, '0', 54, 32, 'Brazil', 98, 76, 54, 45),
(18, 8, 2, 'Harry Maguire', 2, 24, 98, 76, 87, 65, '0', 43, '0', 67, 54, 'Angol', 98, 56, 87, 54),
(19, 8, 2, 'David De Gea', 1, 34, 76, 87, 56, 45, '0', 23, '0', 98, 67, 'Spanyol', 54, 21, 65, 47),
(20, 9, 2, 'Harry Cahill', 2, 23, 67, 45, 75, 67, '0', 43, '0', 56, 23, 'Angol', 65, 45, 34, 87),
(21, 10, 2, 'Timo Werner', 2, 23, 76, 58, 76, 89, '0', 97, '0', 54, 34, 'Német', 87, 65, 45, 35),
(22, 10, 2, 'Leonardo Bonucci', 2, 35, 65, 78, 65, 98, '0', 45, '0', 76, 34, 'Olasz', 57, 76, 43, 56),
(23, 11, 5, 'Cristiano Ronaldo', 13, 35, 67, 65, 89, 76, '0', 34, '0', 65, 34, 'Portugal', 87, 56, 64, 75),
(24, 11, 5, 'Paulo Dybala', 13, 27, 87, 67, 56, 97, '0', 65, '0', 78, 65, '43', 57, 43, 23, 21),
(25, 12, 5, 'Lewis Hampton', 13, 26, 67, 65, 78, 98, '0', 76, '0', 46, 79, 'Angol', 98, 67, 56, 43),
(26, 12, 5, 'Fernando Parejo', 12, 25, 76, 89, 65, 45, '0', 67, '0', 987, 65, 'Spanyol', 98, 56, 76, 43),
(27, 13, 4, 'Mauro Icardi', 12, 28, 78, 65, 98, 56, '0', 78, '0', 54, 86, 'Argentín', 87, 987, 567, 456),
(28, 13, 4, 'Neymar Da Silva', 12, 29, 67, 86, 56, 56, '0', 45, '0', 85, 68, 'Brazil', 87, 57, 568, 54),
(29, 14, 4, 'Radamel Falcao', 12, 28, 78, 655, 976, 467, '0', 446, '0', 44, 788, 'Francia', 987, 67, 54, 78),
(30, 14, 4, 'Antoine Ndidi', 12, 32, 67, 8557, 57, 567, '0', 65, '0', 6655, 7667, 'Francia', 866, 7865, 78, 68),
(31, 15, 6, 'Lukács Máté', 12, 32, 67, 567, 75, 68, '0', 65, '0', 78, 7, 'Magyar', 78, 5678, 65, 78),
(32, 15, 6, 'Kukuts Máté', 12, 17, 8866, 7, 86, 56, '0', 78, '0', 876, 788, 'Magyar', 68, 667887667, 876, 88),
(33, 16, 6, 'Mihály Levente', 12, 22, 8679, 677, 65, 677, '0', 67, '0', 6, 567, 'Magyar', 677, 55, 67, 765),
(34, 16, 6, 'Gólya Bertalan', 12, 27, 86, 886, 68, 656, '0', 78, '0', 766, 7876, 'Magyar', 67865, 6765, 57, 76),
(35, 17, 3, 'Thomas Muller', 12, 32, 8767, 97, 6778, 76, '0', 67, '0', 898, 6, 'Német', 9, 986, 6, 79),
(36, 17, 3, 'Robert Lewandowski', 12, 35, 578, 67, 9766, 789, '0', 87, '0', 65, 67, 'Lengyel', 765, 67, 89, 876),
(37, 18, 3, 'Erling Braut Haaland', 12, 19, 6786, 6, 78, 655, '0', 78, '0', 6, 54, 'Norvég', 68765, 8765, 6876, 556),
(38, 18, 3, 'Roman Burki', 12, 31, 8665, 8765, 678, 65, '0', 78, '0', 765, 6789, '87', 5, 467, 98, 656);

-- --------------------------------------------------------

--
-- Table structure for table `jatekos_ertekelese`
--

CREATE TABLE `jatekos_ertekelese` (
  `Id` int(11) NOT NULL,
  `Ertekeles` int(11) NOT NULL,
  `Jatekos_id` int(11) NOT NULL,
  `Felszabaditas` int(11) NOT NULL,
  `Gyorsasag` int(11) NOT NULL,
  `Allo_kepesseg` int(11) NOT NULL,
  `Passz_pontossag` int(11) NOT NULL,
  `Loves_pontossag` int(11) NOT NULL,
  `Lovo_ero` int(11) NOT NULL,
  `Beadas` int(11) NOT NULL,
  `Cselezes` int(11) NOT NULL,
  `Helyezkedes` int(11) NOT NULL,
  `Fejeles` int(11) NOT NULL,
  `Fizikum` int(11) NOT NULL,
  `Szereles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `jatekos_ertekelese`
--

INSERT INTO `jatekos_ertekelese` (`Id`, `Ertekeles`, `Jatekos_id`, `Felszabaditas`, `Gyorsasag`, `Allo_kepesseg`, `Passz_pontossag`, `Loves_pontossag`, `Lovo_ero`, `Beadas`, `Cselezes`, `Helyezkedes`, `Fejeles`, `Fizikum`, `Szereles`) VALUES
(2, 99, 1, 34, 97, 98, 99, 99, 97, 96, 99, 87, 81, 84, 86),
(3, 97, 2, 99, 82, 99, 98, 84, 89, 0, 98, 96, 0, 98, 82),
(4, 96, 3, 37, 95, 92, 96, 97, 98, 82, 87, 77, 88, 85, 64),
(5, 97, 4, 95, 83, 98, 98, 98, 92, 0, 73, 87, 0, 87, 77),
(6, 84, 5, 42, 73, 79, 82, 96, 92, 84, 80, 91, 89, 86, 41),
(7, 86, 6, 77, 88, 89, 93, 90, 84, 86, 87, 75, 72, 67, 82),
(8, 84, 7, 32, 71, 87, 85, 89, 84, 75, 80, 76, 82, 85, 83),
(9, 82, 8, 86, 75, 86, 75, 84, 79, 87, 85, 73, 89, 91, 75),
(10, 93, 9, 35, 99, 92, 97, 97, 96, 89, 92, 95, 99, 98, 72),
(11, 87, 10, 85, 73, 87, 72, 89, 74, 85, 76, 95, 75, 62, 74),
(12, 96, 11, 85, 73, 9, 83, 90, 82, 87, 85, 78, 95, 84, 78),
(13, 97, 12, 95, 82, 98, 98, 97, 99, 0, 87, 91, 85, 95, 82),
(14, 89, 13, 35, 85, 89, 91, 97, 98, 83, 87, 87, 89, 86, 67),
(15, 78, 14, 768, 76, 67, 86, 55, 78, 6, 5, 6789, 8, 765, 678),
(16, 987, 15, 68, 765, 678, 976, 5, 789, 76, 57, 89, 8765, 5678, 9678),
(17, 8765, 16, 78, 85, 4, 789, 76, 5467, 9, 98765, 4, 6789, 965689, 9765),
(18, 8765, 17, 7889, 6, 57, 88, 64, 678, 76, 56, 7899, 7665, 5, 789),
(19, 975, 18, 789, 765, 67, 8976, 4, 5678, 98, 765, 79, 8, 754, 5789),
(20, 9765, 19, 89, 86, 57, 89, 765, 6789, 9, 865, 5678, 97, 65, 467),
(21, 8976, 20, 68, 76, 57, 865, 4, 678, 6, 56, 8, 875, 44, 789),
(22, 876, 21, 5, 7876, 4, 57, 865, 44, 678, 765, 56, 89, 98765, 567),
(23, 7, 22, 66, 896, 5, 788, 65, 578, 9, 765, 56, 789, 7656, 97655678),
(24, 89765, 23, 8, 8765, 567, 897, 64, 6789, 9, 875, 5, 899, 65, 7899876),
(25, 865, 24, 68, 6545, 788, 5, 4, 898, 765, 45678, 976, 356, 79, 98),
(26, 866, 25, 899, 6, 568, 8, 654, 678, 765, 46, 887, 4, 5678, 98765),
(27, 876, 26, 68, 8765, 79, 765, 789, 9, 87655, 78, 9987, 66, 56, 789),
(28, 876, 27, 678, 6544, 6789, 76, 5, 789, 9876, 56, 89, 8765, 6789, 976678987),
(29, 98765, 28, 787, 65, 5678, 7, 554, 678, 765, 7, 89, 8765, 5678, 86546789),
(30, 876, 29, 6798, 7656, 7899, 65, 6, 898, 7656, 789, 876, 789, 876, 6789),
(31, 8976, 30, 6789, 6, 6789, 876, 78987, 678, 9, 76, 78, 997, 67, 898),
(32, 866, 31, 7897, 6678, 9865, 678, 75, 4678, 77, 567, 56778, 54, 67, 85),
(33, 876678, 32, 976, 67898, 76565, 78, 98, 76556, 789, 654567, 89876, 5, 456, 789),
(34, 8767, 33, 8897, 65678, 9765, 678987, 65678, 98765, 56789, 76, 56789, 876678, 567, 8678),
(35, 8678, 34, 98, 76567, 898, 76, 796, 5678, 95, 6789, 65, 6789, 876, 656),
(36, 8767, 35, 899876, 567, 8987, 6567, 876, 5678, 9875, 5679, 987, 65678, 678, 989),
(37, 8678, 36, 986, 789, 976, 5678, 9876, 78, 776567, 897, 6679, 66, 787678976, 76789),
(38, 8678, 37, 99876, 678, 9876, 789, 8, 76, 789, 8, 75, 678, 9, 87),
(39, 9678, 38, 998, 766, 7899, 987, 6789, 68678, 9878, 9, 6789, 876, 789, 987);

-- --------------------------------------------------------

--
-- Table structure for table `meccsek`
--

CREATE TABLE `meccsek` (
  `Id` int(11) NOT NULL,
  `Bajnoksag_Id` int(11) NOT NULL,
  `Datum` date NOT NULL,
  `Hazai_csapat_id` int(11) NOT NULL,
  `Hazai_csapat_goljai` int(11) NOT NULL,
  `Vendeg_csapat_goljai` int(11) NOT NULL,
  `Vendeg_csapat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `meccsek`
--

INSERT INTO `meccsek` (`Id`, `Bajnoksag_Id`, `Datum`, `Hazai_csapat_id`, `Hazai_csapat_goljai`, `Vendeg_csapat_goljai`, `Vendeg_csapat_id`) VALUES
(1, 1, '2020-10-20', 1, 1, 3, 2),
(2, 1, '2021-01-20', 2, 2, 3, 1),
(3, 1, '2020-11-15', 1, 2, 1, 3),
(4, 1, '2020-11-22', 1, 3, 0, 4),
(5, 1, '2020-11-27', 1, 0, 3, 5),
(6, 1, '2020-11-27', 2, 2, 1, 3),
(7, 1, '2020-11-22', 2, 0, 0, 4),
(8, 1, '2020-11-15', 2, 2, 1, 5),
(9, 1, '2020-11-08', 3, 0, 1, 1),
(10, 1, '2020-11-22', 3, 0, 2, 2),
(11, 1, '2020-11-15', 3, 2, 1, 4),
(12, 1, '2020-11-27', 3, 0, 5, 5),
(13, 1, '2020-11-08', 4, 0, 2, 1),
(14, 1, '2020-11-15', 4, 3, 4, 2),
(15, 1, '2020-11-15', 4, 3, 2, 3),
(16, 1, '2020-11-27', 4, 0, 2, 5),
(17, 1, '2020-11-27', 5, 3, 0, 4),
(18, 1, '2020-11-22', 5, 4, 2, 3),
(19, 1, '2020-11-15', 5, 7, 2, 2),
(20, 1, '2020-11-08', 5, 2, 1, 1),
(21, 2, '2020-10-08', 6, 5, 4, 7),
(22, 2, '2020-10-15', 6, 1, 2, 8),
(23, 2, '2020-10-22', 9, 0, 4, 6),
(24, 2, '2020-10-15', 9, 0, 4, 7),
(25, 2, '2020-10-08', 9, 0, 2, 8),
(26, 2, '2020-10-22', 8, 2, 1, 10),
(27, 2, '2020-10-27', 7, 4, 1, 10),
(28, 2, '2020-10-27', 10, 1, 1, 9),
(29, 5, '2020-10-10', 11, 3, 1, 12),
(31, 5, '2020-10-17', 12, 1, 1, 11),
(32, 4, '2020-10-10', 13, 7, 2, 14),
(33, 4, '2020-10-17', 14, 0, 2, 13),
(34, 6, '2020-10-10', 15, 0, 0, 16),
(35, 6, '2020-10-17', 16, 0, 1, 15),
(36, 3, '2020-10-17', 17, 0, 1, 18),
(37, 3, '2020-10-10', 18, 0, 4, 17);

-- --------------------------------------------------------

--
-- Table structure for table `meccs_egy_csapat_felol`
--

CREATE TABLE `meccs_egy_csapat_felol` (
  `Id` int(11) NOT NULL,
  `Meccs_id` int(11) NOT NULL,
  `Csapat_id` int(11) NOT NULL,
  `Loves` int(11) NOT NULL,
  `Kapura_loves` int(11) NOT NULL,
  `Szoglet` int(11) NOT NULL,
  `Sarga_lap` int(11) NOT NULL,
  `Piros_lap` int(11) NOT NULL,
  `Labda_birtoklas` int(11) NOT NULL,
  `Szabalytalansagok` int(11) NOT NULL,
  `Vedesek` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `meccs_egy_csapat_felol`
--

INSERT INTO `meccs_egy_csapat_felol` (`Id`, `Meccs_id`, `Csapat_id`, `Loves`, `Kapura_loves`, `Szoglet`, `Sarga_lap`, `Piros_lap`, `Labda_birtoklas`, `Szabalytalansagok`, `Vedesek`) VALUES
(1, 1, 2, 8, 6, 2, 3, 0, 50, 7, 5),
(2, 2, 1, 9, 5, 8, 2, 0, 50, 4, 6),
(3, 3, 3, 7, 3, 6, 0, 0, 50, 1, 3),
(4, 1, 1, 9, 5, 8, 2, 0, 50, 3, 5),
(5, 2, 2, 8, 5, 7, 1, 0, 50, 2, 5),
(8, 2, 2, 8, 6, 7, 2, 0, 50, 4, 5),
(9, 3, 1, 8, 6, 7, 2, 0, 50, 4, 5),
(10, 4, 4, 8, 5, 7, 0, 0, 50, 3, 4),
(11, 4, 1, 9, 5, 7, 2, 0, 50, 4, 5),
(12, 5, 5, 9, 4, 7, 2, 0, 50, 3, 4),
(13, 5, 1, 9, 6, 4, 2, 0, 50, 4, 8),
(14, 6, 3, 5, 8, 4, 0, 0, 50, 1, 2),
(15, 6, 2, 9, 6, 8, 2, 0, 50, 4, 5),
(16, 7, 4, 9, 6, 8, 2, 0, 50, 4, 5),
(17, 7, 2, 8, 4, 8, 2, 0, 50, 4, 6),
(18, 8, 5, 9, 5, 7, 1, 0, 50, 2, 4),
(19, 8, 2, 9, 5, 7, 1, 0, 50, 2, 4),
(20, 9, 1, 9, 3, 1, 3, 0, 50, 5, 8),
(21, 9, 3, 9, 5, 3, 6, 0, 50, 9, 2),
(22, 10, 2, 9, 8, 5, 3, 0, 50, 5, 7),
(23, 10, 3, 9, 5, 8, 1, 0, 50, 3, 4),
(24, 11, 4, 9, 4, 7, 0, 0, 50, 2, 4),
(25, 11, 3, 9, 6, 8, 2, 0, 50, 4, 5),
(26, 12, 5, 9, 5, 8, 1, 0, 50, 3, 6),
(27, 12, 3, 9, 7, 3, 2, 0, 50, 8, 5),
(28, 13, 1, 9, 5, 7, 2, 0, 50, 3, 5),
(29, 13, 4, 9, 6, 8, 1, 0, 50, 3, 5),
(30, 14, 2, 9, 5, 7, 1, 0, 50, 3, 5),
(31, 14, 4, 9, 5, 7, 1, 0, 50, 3, 4),
(32, 15, 3, 9, 5, 8, 2, 0, 50, 4, 5),
(33, 16, 4, 9, 5, 8, 1, 0, 50, 3, 5),
(34, 17, 4, 9, 6, 8, 1, 0, 50, 4, 5),
(35, 17, 5, 9, 5, 8, 1, 0, 50, 4, 6),
(36, 18, 3, 9, 5, 8, 1, 0, 50, 3, 5),
(37, 18, 5, 9, 5, 8, 1, 0, 50, 3, 6),
(38, 19, 2, 9, 6, 3, 3, 0, 50, 5, 8),
(39, 19, 5, 9, 3, 5, 1, 0, 50, 6, 8),
(40, 20, 1, 9, 5, 8, 0, 0, 50, 3, 5),
(41, 20, 5, 9, 5, 7, 0, 0, 50, 1, 4),
(42, 21, 7, 8, 6, 5, 2, 0, 50, 4, 7),
(43, 21, 6, 9, 5, 8, 2, 0, 50, 3, 5),
(44, 22, 8, 7, 4, 8, 2, 0, 50, 3, 5),
(45, 22, 6, 9, 4, 7, 1, 0, 50, 3, 5),
(46, 23, 6, 8, 5, 7, 1, 0, 50, 3, 5),
(47, 23, 9, 9, 7, 5, 4, 0, 50, 7, 3),
(48, 24, 7, 9, 5, 8, 2, 0, 50, 3, 5),
(49, 24, 9, 9, 5, 8, 1, 0, 50, 3, 5),
(50, 25, 8, 9, 5, 8, 1, 0, 50, 3, 5),
(51, 25, 9, 9, 4, 8, 2, 0, 50, 4, 6),
(52, 26, 10, 9, 7, 6, 5, 0, 50, 8, 3),
(53, 26, 8, 9, 8, 7, 5, 0, 50, 8, 4),
(54, 27, 10, 9, 5, 8, 1, 0, 50, 3, 5),
(55, 27, 7, 9, 6, 8, 2, 0, 50, 3, 5),
(56, 28, 9, 9, 6, 8, 2, 0, 50, 3, 5),
(57, 28, 10, 9, 5, 8, 2, 0, 50, 3, 5),
(58, 15, 4, 9, 6, 8, 0, 0, 50, 3, 5),
(59, 16, 5, 9, 6, 8, 1, 0, 50, 3, 5),
(60, 29, 12, 9, 6, 8, 1, 0, 50, 3, 5),
(61, 29, 11, 9, 5, 8, 1, 0, 50, 3, 5),
(62, 31, 11, 9, 5, 7, 1, 0, 50, 4, 5),
(63, 31, 12, 9, 5, 7, 1, 0, 50, 3, 4),
(64, 32, 14, 9, 5, 7, 2, 0, 50, 4, 5),
(65, 32, 13, 9, 6, 4, 2, 0, 50, 4, 7),
(66, 33, 13, 9, 5, 8, 2, 0, 50, 4, 6),
(67, 33, 14, 9, 7, 8, 2, 0, 50, 4, 5),
(68, 34, 16, 13, 9, 9, 4, 0, 50, 7, 5),
(69, 34, 15, 9, 5, 8, 2, 0, 50, 4, 5),
(70, 35, 15, 9, 6, 8, 0, 0, 50, 2, 5),
(71, 35, 16, 9, 6, 8, 0, 0, 50, 2, 5),
(72, 36, 18, 9, 7, 8, 2, 0, 50, 4, 5),
(73, 36, 17, 9, 5, 7, 0, 0, 50, 2, 4),
(74, 37, 17, 9, 6, 8, 1, 0, 50, 3, 5),
(75, 37, 18, 9, 5, 8, 2, 0, 50, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `poszt`
--

CREATE TABLE `poszt` (
  `Id` int(11) NOT NULL,
  `Nev` text COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `poszt`
--

INSERT INTO `poszt` (`Id`, `Nev`) VALUES
(1, 'Kapus'),
(2, 'Közép hátvéd'),
(3, 'Jobb hátvéd'),
(4, 'Bal hátvéd'),
(5, 'Védekező középpályás'),
(6, 'Középső középpályás'),
(7, 'Jobb oldali középpályás'),
(8, 'Bal oldali középpályás'),
(9, 'Támadó középpályás'),
(10, 'Irányító'),
(11, 'Jobb szélső'),
(12, 'Bal szélső'),
(13, 'Csatár');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bajnoksagok`
--
ALTER TABLE `bajnoksagok`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `bajnoksagok_csapatok`
--
ALTER TABLE `bajnoksagok_csapatok`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Bajnoksag` (`bajnoksag_id`),
  ADD KEY `Csapat` (`csapat_id`);

--
-- Indexes for table `csapatok`
--
ALTER TABLE `csapatok`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `edzok`
--
ALTER TABLE `edzok`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Fk_edzok_csapatok` (`Csapat_Id`);

--
-- Indexes for table `jatekos`
--
ALTER TABLE `jatekos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Fk_jatekos_csapatok` (`Csapat_id`),
  ADD KEY `Fk_jatekos_bajnoksag` (`Bajnoksag_id`),
  ADD KEY `Fk_jatekos_poszt` (`Poszt_id`);

--
-- Indexes for table `jatekos_ertekelese`
--
ALTER TABLE `jatekos_ertekelese`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Fk_jatekos_ertekelese_jatekos` (`Jatekos_id`);

--
-- Indexes for table `meccsek`
--
ALTER TABLE `meccsek`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Fk_meccsek_bajnoksag` (`Bajnoksag_Id`),
  ADD KEY `Fk_hazai_meccsek_Csapatok` (`Hazai_csapat_id`),
  ADD KEY `Fk_vendeg_meccsek_csapat` (`Vendeg_csapat_id`);

--
-- Indexes for table `meccs_egy_csapat_felol`
--
ALTER TABLE `meccs_egy_csapat_felol`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_meccs_egy_csapatf_csapatid` (`Csapat_id`),
  ADD KEY `Fk_meccs_meccs_egy_csapat_felol` (`Meccs_id`);

--
-- Indexes for table `poszt`
--
ALTER TABLE `poszt`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bajnoksagok`
--
ALTER TABLE `bajnoksagok`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bajnoksagok_csapatok`
--
ALTER TABLE `bajnoksagok_csapatok`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `csapatok`
--
ALTER TABLE `csapatok`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `edzok`
--
ALTER TABLE `edzok`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jatekos`
--
ALTER TABLE `jatekos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `jatekos_ertekelese`
--
ALTER TABLE `jatekos_ertekelese`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `meccsek`
--
ALTER TABLE `meccsek`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `meccs_egy_csapat_felol`
--
ALTER TABLE `meccs_egy_csapat_felol`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `poszt`
--
ALTER TABLE `poszt`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bajnoksagok_csapatok`
--
ALTER TABLE `bajnoksagok_csapatok`
  ADD CONSTRAINT `Bajnoksag` FOREIGN KEY (`bajnoksag_id`) REFERENCES `bajnoksagok` (`Id`),
  ADD CONSTRAINT `Csapat` FOREIGN KEY (`csapat_id`) REFERENCES `csapatok` (`Id`);

--
-- Constraints for table `edzok`
--
ALTER TABLE `edzok`
  ADD CONSTRAINT `Fk_edzok_csapatok` FOREIGN KEY (`Csapat_Id`) REFERENCES `csapatok` (`Id`);

--
-- Constraints for table `jatekos`
--
ALTER TABLE `jatekos`
  ADD CONSTRAINT `Fk_jatekos_bajnoksag` FOREIGN KEY (`Bajnoksag_id`) REFERENCES `bajnoksagok` (`Id`),
  ADD CONSTRAINT `Fk_jatekos_csapatok` FOREIGN KEY (`Csapat_id`) REFERENCES `csapatok` (`Id`),
  ADD CONSTRAINT `Fk_jatekos_poszt` FOREIGN KEY (`Poszt_id`) REFERENCES `poszt` (`Id`);

--
-- Constraints for table `jatekos_ertekelese`
--
ALTER TABLE `jatekos_ertekelese`
  ADD CONSTRAINT `Fk_jatekos_ertekelese_jatekos` FOREIGN KEY (`Jatekos_id`) REFERENCES `jatekos` (`Id`);

--
-- Constraints for table `meccsek`
--
ALTER TABLE `meccsek`
  ADD CONSTRAINT `Fk_hazai_meccsek_Csapatok` FOREIGN KEY (`Hazai_csapat_id`) REFERENCES `csapatok` (`Id`),
  ADD CONSTRAINT `Fk_meccsek_bajnoksag` FOREIGN KEY (`Bajnoksag_Id`) REFERENCES `bajnoksagok` (`Id`),
  ADD CONSTRAINT `Fk_vendeg_meccsek_csapat` FOREIGN KEY (`Vendeg_csapat_id`) REFERENCES `csapatok` (`Id`);

--
-- Constraints for table `meccs_egy_csapat_felol`
--
ALTER TABLE `meccs_egy_csapat_felol`
  ADD CONSTRAINT `FK_meccs_egy_csapatf_csapatid` FOREIGN KEY (`Csapat_id`) REFERENCES `csapatok` (`Id`),
  ADD CONSTRAINT `Fk_meccs_meccs_egy_csapat_felol` FOREIGN KEY (`Meccs_id`) REFERENCES `meccsek` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
