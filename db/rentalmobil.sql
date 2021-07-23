-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Des 2020 pada 05.52
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentalmobil_b4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_sewa`
--

CREATE TABLE `detail_sewa` (
  `ID_detail_sewa` int(4) NOT NULL,
  `ID_sewa` int(3) NOT NULL,
  `ID_Mobil` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga_sewa_rute`
--

CREATE TABLE `harga_sewa_rute` (
  `Code_harga` varchar(3) NOT NULL,
  `Tujuan` varchar(20) NOT NULL,
  `Jenis_hari` enum('Biasa','weekend/libur','Biasa/weekend/libur') NOT NULL,
  `Harga_rute` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `harga_sewa_rute`
--

INSERT INTO `harga_sewa_rute` (`Code_harga`, `Tujuan`, `Jenis_hari`, `Harga_rute`) VALUES
('DKB', 'Dalam Kota', 'Biasa', 250000),
('DKW', 'Dalam Kota', 'weekend/libur', 350000),
('LK', 'Luar Kota', 'Biasa/weekend/libur', 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `ID_karyawan` varchar(4) NOT NULL,
  `Nama_karyawan` varchar(50) NOT NULL,
  `No_HP` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`ID_karyawan`, `Nama_karyawan`, `No_HP`) VALUES
('K001', 'Alexander Septian Hadiant', '085344689344'),
('K003', 'Widhi Kurniawan', '083244536443'),
('K004', 'Sylvia Pretty Tulus', '082355435534');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_insert_into_pelanggan`
--

CREATE TABLE `log_insert_into_pelanggan` (
  `ID_log` int(11) NOT NULL,
  `ID_pelanggan` varchar(4) DEFAULT NULL,
  `Nama_pelanggan` varchar(255) DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `No_HP` varchar(15) DEFAULT NULL,
  `action` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_insert_into_pelanggan`
--

INSERT INTO `log_insert_into_pelanggan` (`ID_log`, `ID_pelanggan`, `Nama_pelanggan`, `Alamat`, `No_HP`, `action`) VALUES
(1, 'P011', 'Ivanda Bagas Pratama P.', 'RH.abdul halm, Rt.3 Rw.3 Cimah', '082345678900', 'INSERT'),
(2, 'P012', 'Yohan Pratama', 'Nolojayan Rt,2/1, somopuro, Kl', '082345678910', 'INSERT'),
(3, 'P013', 'Emanuel Christian Henry P.', 'Pr. Griya prima Barat, Belangw', '082345678920', 'INSERT'),
(4, 'P014', 'Bayu Purnomo Adi', 'Menden, Paseban, Bayat, Klaten', '082345678930', 'INSERT'),
(5, 'P015', 'Yoel Christy Lumembang', 'Perdos Unhas Block EC, Tamalan', '082345678940', 'INSERT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_insert_into_penyewaan`
--

CREATE TABLE `log_insert_into_penyewaan` (
  `id_log` int(11) NOT NULL,
  `ID_sewa` int(3) DEFAULT NULL,
  `ID_pelanggan` varchar(4) DEFAULT NULL,
  `Jenis_ID` varchar(5) DEFAULT NULL,
  `Waktu_peminjaman` datetime DEFAULT NULL,
  `Waktu_pengembalian` datetime DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  `code_harga` varchar(3) DEFAULT NULL,
  `ID_mobil` varchar(3) DEFAULT NULL,
  `action` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_insert_into_penyewaan`
--

INSERT INTO `log_insert_into_penyewaan` (`id_log`, `ID_sewa`, `ID_pelanggan`, `Jenis_ID`, `Waktu_peminjaman`, `Waktu_pengembalian`, `denda`, `code_harga`, `ID_mobil`, `action`) VALUES
(1, 27, 'P012', 'KTP', '2020-10-23 13:00:00', '2020-10-24 13:00:00', 0, 'DKW', 'M09', 'INSERT'),
(2, 28, 'P014', 'KTP', '2020-12-23 12:00:00', '2020-12-23 13:00:00', 10000, 'DKB', 'M10', 'INSERT'),
(3, 29, 'P011', 'KTP', '2020-10-23 13:00:00', '2020-10-24 13:00:00', 0, 'DKB', 'M10', 'INSERT'),
(4, 30, 'P010', 'KK', '2020-12-23 09:00:00', '2020-10-24 10:00:00', 10000, 'LK', 'M09', 'INSERT'),
(5, 31, 'P006', 'KTP', '2020-12-27 13:00:00', '2020-12-28 12:00:00', 0, 'DKW', 'M09', 'INSERT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_pelanggan`
--

CREATE TABLE `log_pelanggan` (
  `id_log` int(11) NOT NULL,
  `ID_pelanggan_baru` varchar(4) NOT NULL,
  `Nama_pelanggan_lama` varchar(30) NOT NULL,
  `Alamat_lama` varchar(50) NOT NULL,
  `No_HP_baru` varchar(15) NOT NULL,
  `Nama_pelanggan_baru` varchar(30) DEFAULT NULL,
  `Alamat_baru` varchar(50) DEFAULT NULL,
  `No_HP_lama` varchar(15) DEFAULT NULL,
  `action` varchar(10) DEFAULT NULL,
  `ID_pelanggan_lama` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_pelanggan`
--

INSERT INTO `log_pelanggan` (`id_log`, `ID_pelanggan_baru`, `Nama_pelanggan_lama`, `Alamat_lama`, `No_HP_baru`, `Nama_pelanggan_baru`, `Alamat_baru`, `No_HP_lama`, `action`, `ID_pelanggan_lama`) VALUES
(11, 'P011', 'Meirlan Rante Palalangan', 'Jl. Warah Made RT/RW 2 Danawer', '082355435534', 'Meirlan Rante Palalangan', 'Jl. Warah Made RT/RW 2 Danawer', '082355435534', 'Update', 'P010'),
(12, 'P011', 'Meirlan Rante Palalangan', 'Jl. Warah Made RT/RW 2 Danawer', '082355435534', 'Meirlan', 'Jl. Warah Made RT/RW 2 Danawer', '082355435534', 'Update', 'P011'),
(13, 'P011', 'Meirlan', 'Jl. Warah Made RT/RW 2 Danawer', '082355435534', 'Meirlan', 'Jl. Warah Made RT/RW 2', '082355435534', 'Update', 'P011'),
(14, 'P011', 'Meirlan', 'Jl. Warah Made RT/RW 2', '083522331167', 'Meirlan', 'Jl. Warah Made RT/RW 2', '082355435534', 'Update', 'P011'),
(15, 'P010', 'Meirlan', 'Jl. Warah Made RT/RW 2', '083522331167', 'Meirlan Rante Palalangan', 'Jl. Warah Made RT/RW 2 Danawer', '083522331167', 'Update', 'P011');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `ID_Mobil` varchar(3) NOT NULL,
  `Jenis_mobil` varchar(20) NOT NULL,
  `Warna_mobil` varchar(10) NOT NULL,
  `Harga_sewa_mobil` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`ID_Mobil`, `Jenis_mobil`, `Warna_mobil`, `Harga_sewa_mobil`) VALUES
('M09', 'Mitsubishi', 'Hitam', 100000),
('M10', 'Range Roger', 'Putih', 200000),
('M11', 'CRV', 'Silver', 150000),
('M12', 'Xenia', 'Hitam', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ID_pelanggan` varchar(4) NOT NULL,
  `Nama_pelanggan` varchar(30) NOT NULL,
  `Alamat` varchar(30) NOT NULL,
  `No_HP` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`ID_pelanggan`, `Nama_pelanggan`, `Alamat`, `No_HP`) VALUES
('P001', 'Stenly Manipi', 'Werpigan RT 2/0, Kec. Fakfak B', '085366778988'),
('P002', 'Angelina Rumuy', 'Kel. Danaweria RT 18', '085422785567'),
('P003', 'Ericson Rumuy', 'Danaweria, Kec. Fakfak Tengah,', '082355748934'),
('P004', 'Trendy Manipi', 'Jl.Trikora II, Kec. Fakfak Ten', '082344553345'),
('P005', 'Rizqi Afriansyah', 'DS.Dongsong RT.002/005, Kec. K', '084322335479'),
('P006', 'Yeremia Rossul Anwar', 'Jl. Tulip 14 RT 06/06 Kel Peta', '083422564435'),
('P007', 'Feri Afrilliah', 'Megulung Lor Pituluh RT 01 RW ', '083522331155'),
('P008', 'Fadli Samudin', 'Jl. Yos Sudarso RT XXVII Wagom', '085344672239'),
('P009', 'Marlan Rante Palalangan', 'Jl. Warah Made RT/RW 2 Danawer', '085344785569'),
('P010', 'Meirlan Rante Palalangan', 'Jl. Warah Made RT/RW 2 Danawer', '083522331167'),
('P011', 'Ivanda Bagas Pratama P.', 'RH.abdul halm, Rt.3 Rw.3 Cimah', '082345678900'),
('P012', 'Yohan Pratama', 'Nolojayan Rt,2/1, somopuro, Kl', '082345678910'),
('P013', 'Emanuel Christian Henry P.', 'Pr. Griya prima Barat, Belangw', '082345678920'),
('P014', 'Bayu Purnomo Adi', 'Menden, Paseban, Bayat, Klaten', '082345678930'),
('P015', 'Yoel Christy Lumembang', 'Perdos Unhas Block EC, Tamalan', '082345678940');

--
-- Trigger `pelanggan`
--
DELIMITER $$
CREATE TRIGGER `after_delete_pelanggan` AFTER DELETE ON `pelanggan` FOR EACH ROW BEGIN
	INSERT INTO log_pelanggan
    SET
    ID_pelanggan = old.id_pelanggan,
    Nama_pelanggan_lama = old.nama_pelanggan,
    Alamat_lama = old.Alamat,
    No_HP_lama = old.no_hp,
    action = "Delete";
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_after_pelanggan` AFTER INSERT ON `pelanggan` FOR EACH ROW BEGIN
INSERT INTO log_insert_into_pelanggan
SET
ID_pelanggan = NEW.ID_pelanggan,
Nama_pelanggan = NEw.nama_pelanggan,
Alamat = new.alamat,
No_HP = new.no_hp,
action = "INSERT";
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pelanggan_after_update` AFTER UPDATE ON `pelanggan` FOR EACH ROW BEGIN
	INSERT INTO log_pelanggan
    SET
    ID_pelanggan_lama = old.id_pelanggan,
    ID_pelanggan_baru = new.id_pelanggan,
    Nama_pelanggan_lama = old.nama_pelanggan,
    Nama_pelanggan_baru = new.nama_pelanggan,
    No_HP_baru = new.no_hp,
    No_HP_lama=old.no_hp,
    Alamat_lama=old.alamat,
    Alamat_baru=new.alamat,
    action = "Update";
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewaan`
--

CREATE TABLE `penyewaan` (
  `ID_sewa` int(3) NOT NULL,
  `ID_karyawan` varchar(4) NOT NULL,
  `ID_pelanggan` varchar(4) NOT NULL,
  `Jenis_ID` enum('KTP','KK') NOT NULL,
  `Waktu_peminjaman` datetime NOT NULL,
  `Waktu_pengembalian` datetime NOT NULL,
  `denda` int(11) NOT NULL DEFAULT 0,
  `code_harga` varchar(3) NOT NULL,
  `ID_mobil` varchar(3) NOT NULL,
  `total_harga` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penyewaan`
--

INSERT INTO `penyewaan` (`ID_sewa`, `ID_karyawan`, `ID_pelanggan`, `Jenis_ID`, `Waktu_peminjaman`, `Waktu_pengembalian`, `denda`, `code_harga`, `ID_mobil`, `total_harga`) VALUES
(0, 'K003', 'P003', 'KK', '2020-12-17 13:37:00', '2020-12-18 14:38:00', 10000, 'DKW', 'M11', 510000),
(1, 'K001', 'P001', 'KTP', '2020-11-05 16:40:00', '2020-11-04 16:47:17', 0, 'DKB', 'M09', 350000),
(2, 'K001', 'P003', 'KK', '2020-11-19 18:00:00', '2020-11-04 16:47:17', 10000, 'LK', 'M10', 510000),
(23, 'K003', 'P002', 'KTP', '2020-10-10 00:00:00', '2020-10-11 12:00:00', 0, 'DKW', 'M10', 550000),
(24, 'K004', 'P008', 'KK', '2020-12-02 13:43:00', '2020-12-03 14:43:00', 10000, 'LK', 'M12', 310000),
(26, 'K003', 'P006', 'KK', '2020-12-01 14:06:00', '2020-12-02 14:06:00', 0, 'DKB', 'M10', 0),
(27, 'K001', 'P012', 'KTP', '2020-10-23 13:00:00', '2020-10-24 13:00:00', 0, 'DKW', 'M09', NULL),
(28, 'K003', 'P014', 'KTP', '2020-12-23 12:00:00', '2020-12-23 13:00:00', 10000, 'DKB', 'M10', NULL),
(29, 'K003', 'P011', 'KTP', '2020-10-23 13:00:00', '2020-10-24 13:00:00', 0, 'DKB', 'M10', NULL),
(30, 'K001', 'P010', 'KK', '2020-12-23 09:00:00', '2020-10-24 10:00:00', 10000, 'LK', 'M09', NULL),
(31, 'K001', 'P006', 'KTP', '2020-12-27 13:00:00', '2020-12-28 12:00:00', 0, 'DKW', 'M09', NULL);

--
-- Trigger `penyewaan`
--
DELIMITER $$
CREATE TRIGGER `insert_after_penyewaan` AFTER INSERT ON `penyewaan` FOR EACH ROW BEGIN
INSERT INTO log_insert_into_penyewaan 
SET
ID_sewa = new.id_sewa,
ID_pelanggan = new.id_pelanggan,
Jenis_ID = new.jenis_id,
Waktu_peminjaman = new.waktu_peminjaman,
Waktu_pengembalian = new.waktu_pengembalian,
denda = new.denda,
code_harga = new.code_harga,
ID_mobil = new.id_mobil,
action = "INSERT";

END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_sewa`
--
ALTER TABLE `detail_sewa`
  ADD PRIMARY KEY (`ID_detail_sewa`),
  ADD KEY `id_sewa` (`ID_sewa`),
  ADD KEY `id_mobil` (`ID_Mobil`);

--
-- Indeks untuk tabel `harga_sewa_rute`
--
ALTER TABLE `harga_sewa_rute`
  ADD PRIMARY KEY (`Code_harga`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`ID_karyawan`);

--
-- Indeks untuk tabel `log_insert_into_pelanggan`
--
ALTER TABLE `log_insert_into_pelanggan`
  ADD PRIMARY KEY (`ID_log`);

--
-- Indeks untuk tabel `log_insert_into_penyewaan`
--
ALTER TABLE `log_insert_into_penyewaan`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `log_pelanggan`
--
ALTER TABLE `log_pelanggan`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`ID_Mobil`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`ID_pelanggan`);

--
-- Indeks untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`ID_sewa`),
  ADD KEY `id_karyawan` (`ID_karyawan`),
  ADD KEY `id_pelanggan` (`ID_pelanggan`),
  ADD KEY `code_harga` (`code_harga`),
  ADD KEY `ID_mobil_sewa` (`ID_mobil`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_sewa`
--
ALTER TABLE `detail_sewa`
  MODIFY `ID_detail_sewa` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `log_insert_into_pelanggan`
--
ALTER TABLE `log_insert_into_pelanggan`
  MODIFY `ID_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `log_insert_into_penyewaan`
--
ALTER TABLE `log_insert_into_penyewaan`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `log_pelanggan`
--
ALTER TABLE `log_pelanggan`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `ID_sewa` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_sewa`
--
ALTER TABLE `detail_sewa`
  ADD CONSTRAINT `id_mobil` FOREIGN KEY (`ID_Mobil`) REFERENCES `mobil` (`ID_Mobil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_sewa` FOREIGN KEY (`ID_sewa`) REFERENCES `penyewaan` (`ID_sewa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `ID_mobil_sewa` FOREIGN KEY (`ID_mobil`) REFERENCES `mobil` (`ID_Mobil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `code_harga` FOREIGN KEY (`code_harga`) REFERENCES `harga_sewa_rute` (`Code_harga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_karyawan` FOREIGN KEY (`ID_karyawan`) REFERENCES `karyawan` (`ID_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pelanggan` FOREIGN KEY (`ID_pelanggan`) REFERENCES `pelanggan` (`ID_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
