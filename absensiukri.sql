CREATE TABLE `absensiukri` (
  `id` int(11) NOT NULL,
  `namamahasiswa` varchar(100) NOT NULL,
  `npm` varchar(20) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `statuskehadiran` enum('Hadir','Sakit','Izin') NOT NULL,
  `buktifoto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `absensiukri`
--

INSERT INTO `absensiukri` (`id`, `namamahasiswa`, `npm`, `kelas`, `statuskehadiran`, `buktifoto`) VALUES
(1, 'Khanaya Salsabila', '20241320021', 'A1', 'Hadir', '1765133734_20241320021.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensiukri`
--
ALTER TABLE `absensiukri`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensiukri`
--
ALTER TABLE `absensiukri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
