--
-- Baza danych: `my_stats`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task_list`
--

CREATE TABLE `task_list` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `User_id` int(11) NOT NULL,
  `Title` varchar(256) COLLATE utf8_polish_ci NOT NULL,
  `Description` varchar(4096) COLLATE utf8_polish_ci NOT NULL,
  `Date` datetime NOT NULL,
  `Status` int(11) NOT NULL,
  `Groups` enum('Bugs','Website','Server','Other') COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `timeline`
--

CREATE TABLE `timeline` (
  `ID` int(11) NOT NULL,
  `Title` varchar(256) COLLATE utf8_polish_ci NOT NULL,
  `Description` varchar(1024) COLLATE utf8_polish_ci NOT NULL,
  `Date` datetime NOT NULL,
  `Image` varchar(70) COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL,
  `Email` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Password` char(64) COLLATE utf8_polish_ci NOT NULL,
  `FirstName` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `SecondName` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `Sex` tinyint(4) NOT NULL,
  `City` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `Job` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `Avatar` varchar(256) COLLATE utf8_polish_ci NOT NULL,
  `RegisterDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);
