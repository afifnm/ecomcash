-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jan 2024 pada 15.31
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_apotek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `kode_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `kode_penjualan`, `id_produk`, `jumlah`, `sub_total`) VALUES
(2, 2401271, 6, 3, 240000),
(3, 2401271, 1, 1, 100000),
(5, 2401282, 1, 2, 200000),
(6, 2401283, 5, 1, 900000),
(8, 2401284, 6, 3, 160000),
(9, 2401285, 1, 3, 100000),
(10, 2401285, 6, 1, 80000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL,
  `nama_cv` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfigurasi`, `nama_cv`, `alamat`, `telp`, `email`) VALUES
(1, 'Pipapip Pip', 'Jl. Radjiman Sutedjo 404, Kra', '+6289673333318', 'afifnuruddinmaisaroh@gmail.co');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `telp`) VALUES
(1, 'Bukan pelanggan', '-', '-'),
(2, 'Afif Nuruddin Maisaroh', 'polokarto', '08123912312');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `kode_penjualan` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` decimal(10,0) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `bayar` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `kode_penjualan`, `tanggal`, `total_harga`, `id_pelanggan`, `bayar`) VALUES
(2, '2401271', '2024-01-27', 340000, 1, 350000),
(3, '2401282', '2024-01-28', 200000, 1, 200000),
(4, '2401283', '2024-01-28', 900000, 2, 900000),
(5, '2401284', '2024-01-28', 240000, 2, 250000),
(6, '2401285', '2024-01-28', 380000, 1, 400000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama`, `stok`, `harga`) VALUES
(1, 'FST002', 'Buku teras', 45, 100000),
(2, 'TL001', 'Rasa', 2, 80000),
(4, 'JK09123', 'Weyon Kipas 45 Watt', 3, 180000),
(5, 'SGN002', 'Segovia GN 107', 4, 900000),
(6, 'ART0023', 'Aristoteles Journey', 5, 80000),
(10, 'JJK231001', 'Kertas F4', 40, 10000),
(11, 'KJKJ0031', 'Raket Nyamuk', 50, 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` enum('Admin','Kasir','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Afif Nuruddin Maisaroh', 'Admin'),
(6, 'kasir', 'c7911af3adbd12a035b289556d96470a', 'Apip', 'Kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
