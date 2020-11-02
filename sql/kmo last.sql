-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2020 pada 13.50
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kmo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(11, 'ACEH'),
(12, 'SUMATERA UTARA'),
(13, 'SUMATERA BARAT'),
(14, 'RIAU'),
(15, 'JAMBI'),
(16, 'SUMATERA SELATAN'),
(17, 'BENGKULU'),
(18, 'LAMPUNG'),
(19, 'KEPULAUAN BANGKA BELITUNG'),
(21, 'KEPULAUAN RIAU'),
(31, 'DKI JAKARTA'),
(32, 'JAWA BARAT'),
(33, 'JAWA TENGAH'),
(34, 'DI YOGYAKARTA'),
(35, 'JAWA TIMUR'),
(36, 'BANTEN'),
(51, 'BALI'),
(52, 'NUSA TENGGARA BARAT'),
(53, 'NUSA TENGGARA TIMUR'),
(61, 'KALIMANTAN BARAT'),
(62, 'KALIMANTAN TENGAH'),
(63, 'KALIMANTAN SELATAN'),
(64, 'KALIMANTAN TIMUR'),
(65, 'KALIMANTAN UTARA'),
(71, 'SULAWESI UTARA'),
(72, 'SULAWESI TENGAH'),
(73, 'SULAWESI SELATAN'),
(74, 'SULAWESI TENGGARA'),
(75, 'GORONTALO'),
(76, 'SULAWESI BARAT'),
(81, 'MALUKU'),
(82, 'MALUKU UTARA'),
(91, 'PAPUA BARAT'),
(94, 'PAPUA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `examtitle` varchar(50) NOT NULL,
  `filepath` varchar(225) DEFAULT NULL,
  `examdate` date DEFAULT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `examstatus` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `exam`
--

INSERT INTO `exam` (`id`, `examtitle`, `filepath`, `examdate`, `starttime`, `endtime`, `description`, `examstatus`) VALUES
(3, 'INSCOM SMP ', '1604066892416.pdf', '2020-10-30', '21:10:00', '22:07:00', 'Selamat Mengerjakan', 'succsess');

-- --------------------------------------------------------

--
-- Struktur dari tabel `examresult`
--

CREATE TABLE `examresult` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `examid` int(11) DEFAULT NULL,
  `filepath` varchar(225) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `collecttime` datetime DEFAULT NULL,
  `resultstatus` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `examresult`
--

INSERT INTO `examresult` (`id`, `userid`, `examid`, `filepath`, `score`, `collecttime`, `resultstatus`) VALUES
(1, 46, 3, '1604067314718.pdf', NULL, '2020-10-30 15:15:14', 'unchecked'),
(2, 46, 3, '1604067321955.pdf', NULL, '2020-10-30 15:15:21', 'unchecked');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `accountname` varchar(50) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `paymentslip` varchar(100) DEFAULT NULL,
  `paymentstatus` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`id`, `userid`, `accountname`, `bank`, `paymentslip`, `paymentstatus`) VALUES
(1, 46, 'khoandriansyah11@gmail.co', 'alfamart', '1604066704670.png', 'Unconfirmed');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nisn` varchar(25) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `school` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `phoneNumber` char(13) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `privilege` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nisn`, `fullname`, `email`, `gender`, `school`, `address`, `phoneNumber`, `dateOfBirth`, `photo`, `password`, `salt`, `privilege`) VALUES
(41, '', 'Alfi Fani Supardi', 'alfifanisupardi1@gmail.com', 'P', '', '', '0', NULL, NULL, '3c23f6fb152b2076fe747de6a9a80431', 'oTlLmtbVBhJyxHyHjudgYYbqytlmjEeeXbwM4iTM8JFEsKqDTpyZtjVbAWxak5ms', 'panitia'),
(42, '', 'Citra Aditia Rahayu', 'citraaditiarahayu@student.ikipsiliwangi.ac.id', 'P', '', '', '0', NULL, NULL, 'd10f16cdce70a0dda005bbb534c34cc0', 'sWriWePfsDiRDKxHNYHaKi8yilyA7Xm1iimMB2v3uAiEtVzxd1FnNwyxhLt8gJqg', 'panitia'),
(43, '', 'Rizkiyah Rohmani', 'kiyarizkiyah14@gmail.com', 'P', '', '', '0', NULL, NULL, '80390825482721814e3c6945936059ae', 'RfXR5oyvqoNarkYwXWulxaEEjEjp1ufth5CJybT6c7NhpscgN7rRf654wKvn3TRx', 'panitia'),
(44, '', 'Fadilla Nurhidayah', 'fadilla1403@gmail.com', 'P', '', '', '0', NULL, NULL, '31ac85f8033aefd1553b540f39dd46be', 'dgEmkiC6Mu1HF2ru8F1lNuMpBfHZ8BEZniXLXERuWN6kLAVoxYKFAjBboippRptK', 'panitia'),
(45, '', 'Fikri Fauzi', 'fikrifa900@gmail.com', 'L', '', '', '0', NULL, NULL, '413903fb542e90f735b5b76838b3bb03', '35R8biVLPqafEt44WEAndtMLnclsaYsVwasy7Z1N1CKhC1Lkf9esqNw8zcvzMDuV', 'panitia'),
(46, '', 'Riko Andriansyah ', 'khoandriansyah11@gmail.com', 'L', '', '', '083873624007', '0000-00-00', '1604062339035.jpg', '4eb8a4f6ccf0a5318937f87b9e269e39', 'dnmh8p1aoRNDgyeBnHZrndM2yjiNbtW7ToH6eqEMPXrAsop7by76f8j5Awho5ju5', 'peserta'),
(47, '', 'ade mukhtar zaki', 'adezaki14@gmail.com', 'L', '', '', '087657654543', NULL, NULL, '8169ab151b0a1f959897d20bf23a3318', 'ZRaD9yAnHdFq9o3K2P7WcoBjpXy6jpKpy8lM7aWYnh1bJCBrtqBRCFeunem1LFay', 'peserta'),
(48, '', 'bismillah', 'bismillah@gmail.com', 'L', '', '', '09876568', NULL, NULL, 'a2e5033c9214169ba5fcd30bd09f9e09', '9Nzw2KgXu2ydkAD9kpbdl9mn7Y9n9BwHx5CqBYDqpEqawJJDJC5LAfmAja7cmnCa', 'peserta'),
(49, '', 'rama', 'rama1@gmail.com', 'P', '', '', '087657654543', NULL, NULL, '74c7545ea5cbd75c8658745246e23922', '3BD1HAzN6zTcxPAEZrbTla38WzhZWe6pvbpdAvW3Tg7o2sqdRX3aLt4dYVxVJice', 'peserta');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`id`) USING BTREE;

--
-- Indeks untuk tabel `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exam_pk` (`id`);

--
-- Indeks untuk tabel `examresult`
--
ALTER TABLE `examresult`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_examresu_collect_user` (`userid`),
  ADD KEY `fk_examresu_do_exam` (`examid`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payment_payment_user` (`userid`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_pk` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT untuk tabel `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `examresult`
--
ALTER TABLE `examresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `examresult`
--
ALTER TABLE `examresult`
  ADD CONSTRAINT `fk_examresu_collect_user` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_examresu_do_exam` FOREIGN KEY (`examid`) REFERENCES `exam` (`id`);

--
-- Ketidakleluasaan untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_payment_user` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
