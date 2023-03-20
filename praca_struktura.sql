-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 11 Sty 2015, 16:39
-- Wersja serwera: 5.6.13
-- Wersja PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `praca`
--
CREATE DATABASE IF NOT EXISTS `praca` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `praca`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rejestr`
--

CREATE TABLE IF NOT EXISTS `rejestr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zgloszenie` date NOT NULL,
  `zalatwienie` date NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `rodzaj` text COLLATE utf8_polish_ci NOT NULL,
  `typ` text COLLATE utf8_polish_ci NOT NULL,
  `fabryczny` int(11) NOT NULL,
  `zglaszajacy` text COLLATE utf8_polish_ci NOT NULL,
  `uzytkownik` text COLLATE utf8_polish_ci NOT NULL,
  `naprawa` int(1) NOT NULL,
  `serwis` int(3) NOT NULL,
  `zlecenie` int(11) NOT NULL,
  `uszkodzenie` text COLLATE utf8_polish_ci NOT NULL,
  `status` int(1) NOT NULL,
  `zwrot` text COLLATE utf8_polish_ci NOT NULL,
  `dojazd` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `praca` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `czesci` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `materialy` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `wysylka` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `faktura` int(11) NOT NULL,
  `karta` int(11) NOT NULL,
  `sprzedaz` date NOT NULL,
  `kupujacy` text COLLATE utf8_polish_ci NOT NULL,
  `osoba` text COLLATE utf8_polish_ci NOT NULL,
  `telefon` text COLLATE utf8_polish_ci NOT NULL,
  `adres` text COLLATE utf8_polish_ci NOT NULL,
  `czesci_wys` text COLLATE utf8_polish_ci NOT NULL,
  `czesci_adr` text COLLATE utf8_polish_ci NOT NULL,
  `inne` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `serwisy`
--

CREATE TABLE IF NOT EXISTS `serwisy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firma` text COLLATE utf8_polish_ci NOT NULL,
  `nip` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `telefon` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `adres` text COLLATE utf8_polish_ci NOT NULL,
  `kod` text COLLATE utf8_polish_ci NOT NULL,
  `wojewodztwo` text COLLATE utf8_polish_ci NOT NULL,
  `zakres` int(1) NOT NULL,
  `zlecenia` int(1) NOT NULL,
  `certyfikat` text COLLATE utf8_polish_ci NOT NULL,
  `data_cert` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `serwisy`
--

INSERT INTO `serwisy` (`id`, `firma`, `nip`, `nazwisko`, `telefon`, `email`, `adres`, `kod`, `wojewodztwo`, `zakres`, `zlecenia`, `certyfikat`, `data_cert`) VALUES
(1, 'Serwis DM', '', 'Tomasz Nowak', '', '', '', '', '', 2, 1, '', '0000-00-00'),
(2, 'WYSYŁKA CZĘŚCI', '', '', '', '', '', '', '', 2, 1, '', '0000-00-00'),
(3, 'Jachimowski, Zawiszewski ULTRA GASTRO Sp. k.', '', '', '602-587-658', 'serwis@ultra-gastro.pl', 'ul. Bór 18/24', '42-202 Częstochowa', '11', 2, 1, '', '0000-00-00'),
(4, 'FRICOLD Serwis Chłodnictwa, klimatyzacji, gastronomii', '', 'Kamila Barczok', '531 771 561', 'fricoldbarczok@wp.pl', '', '41-705 Ruda Śląska', '11', 0, 1, '', '0000-00-00'),
(5, 'Serwis chłodniczy ICE', '', 'Piotr Koszela', '606 752 987', 'piotrekkosz@interia.pl', 'ul. Opawska 16a/22', '44-100 Gliwice', '11', 0, 1, 'cert imienny', '2015-01-11'),
(6, 'Naprawa i Montaż Urządzeń Chłodniczych, Krystyna Beck', '', 'Józef Beck', '076 834 15 27, 601 731 215', 'krystyna.jozef@interia.pl', 'ul. Tenisowa 9', '67-200 Głogów', '0', 0, 1, '', '0000-00-00'),
(7, 'MIG IMPORT-EKSPORT GŁOWACKI Sp. J.', '', '', '85 662 67 67 wew 131', 'mig@mig.biz.pl', 'ul. Elewatorska 29A', '15-620 Białystok', '9', 2, 1, '', '0000-00-00'),
(8, 'Zakład Obsługi Technicznej', '', 'Marek Szwed', '602 55 99 90', 'chelm@zotserwis.com.pl', 'ul. Wieniawskiego 11a', '22-101 Chełm', '2', 2, 1, '', '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
