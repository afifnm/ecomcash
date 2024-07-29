-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 29 Jul 2024 pada 21.50
-- Versi server: 8.0.37-cll-lve
-- Versi PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smkm1543_ecom_smkn2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_detail_pembelian` int NOT NULL,
  `kode_pembelian` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int NOT NULL,
  `kode_penjualan` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `kode_penjualan`, `id_produk`, `jumlah`, `harga`) VALUES
(1, '2407290801', 3, 1, 15200),
(2, '2407290801', 30, 5, 13500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `kategori` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(40) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`, `foto`, `slug`) VALUES
(9, 'Kebutuhan Sehari hari', '20240707131624.jpg', 'kebutuhan-sehari-hari'),
(10, 'Minuman', '20240707131934.jpg', 'minuman'),
(11, 'Perlengkapan Rumah', '20240707132349.jpg', 'perlengkapan-rumah'),
(12, 'Skincare (Perawatan)', '20240707132404.jpg', 'skincare-perawatan'),
(15, 'Alat Tulis Kantor', '20240711152827.jpg', 'alat-tulis-kantor'),
(16, 'Makanan', '20240729214920.jpg', 'makanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int NOT NULL,
  `id_produk` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfigurasi` int NOT NULL,
  `nama_cv` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telp` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfigurasi`, `nama_cv`, `alamat`, `telp`, `email`) VALUES
(1, 'KOPSISMART ', 'Jl. Yos Sudarso, Jengglong, Bejen, Kec. Karanganyar, Kabupaten Karanganyar, Jawa Tengah 57716', '+6289673333318', 'afifnuruddinmaisaroh@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi`
--

CREATE TABLE `mutasi` (
  `id_mutasi` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `telp` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `alamat`, `telp`, `email`, `password`) VALUES
(1, 'Bukan Pelanggan', '-', '-', '', ''),
(5, 'Atik Retnoningsih', 'Ringin Asri 1/12, Bejen', '+6285834176300', 'derstaveda@yahoo.com', 'Suwarno05'),
(6, 'Afif Nuruddin M', 'Suruh RT 02 RW 01, Kayuapak, Polokarto', '+6289673333318', 'afifnuruddinmaisaroh@gmail.com', '1234'),
(7, 'Dina Puji Setyawati', 'Griya Pokoh Asri 1/7 Ngijo, Tasikmadu', '+6285647066777', '', ''),
(8, 'Apip', 'Suruh Kayuapak', '+689673333318', 'contoh@gmail.com', '1234'),
(9, 'Purwanta', 'singit, Ngemplak, Karangpandan', '081329251751', 'ebenpurwanta@gmail.com', 'olahraga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int NOT NULL,
  `kode_pembelian` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `bayar` decimal(10,0) NOT NULL,
  `id_supplier` int NOT NULL,
  `bukti` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('selesai','dibatalkan') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int NOT NULL,
  `kode_penjualan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` decimal(10,0) NOT NULL,
  `id_pelanggan` int NOT NULL,
  `bayar` decimal(10,0) NOT NULL,
  `pembayaran` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `bukti` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `transaksi` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('selesai','proses','dibatalkan') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `kode_penjualan`, `tanggal`, `total_harga`, `id_pelanggan`, `bayar`, `pembayaran`, `bukti`, `transaksi`, `status`) VALUES
(1, '2407290801', '2024-07-29', 82700, 8, 82700, 'Transfer', '2407290801.jpg', 'Online', 'dibatalkan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `kode_produk` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `stok` int NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `foto` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_kategori` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `stok_gudang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama`, `stok`, `harga`, `foto`, `id_kategori`, `jenis`, `slug`, `stok_gudang`) VALUES
(2, 'GP01', 'gula pasir 1 kg', 50, 16700, '20240728113850.jpg', '9', 'Umum', 'gula-pasir-1-kg', 0),
(3, 'MK 900 ML', 'minyak kita 900 ML', 24, 15200, '20240728120031.jpg', '9', 'Umum', 'minyak-kita-900-ml', 0),
(4, 'TehDJ', 'Teh celup Dandang jasmin', 12, 7500, '20240728120743.jpg', '9', 'Umum', 'teh-celup-dandang-jasmin', 0),
(5, 'TehD2in1', 'teh dandang 2 in 1 box', 8, 18000, '20240728121212.jpg', '9', 'Umum', 'teh-dandang-2-in-1-box', 0),
(6, 'TehDJbox', 'Teh celup dandang box ', 27, 28000, '20240728122353.jpg', '9', 'Usman', 'teh-celup-dandang-box', 0),
(7, 'TehD2in1s', 'teh dandang 2 in 1 saset', 20, 1000, '20240728123145.jpg', '9', 'Umum', 'teh-dandang-2-in-1-saset', 0),
(8, 'energen coklat', 'energen coklat renceng', 16, 18500, '20240728123843.jpg', '9', 'Umum', 'energen-coklat-renceng', 0),
(9, 'Energ Vanila', 'energen vanila renceng', 16, 18500, '20240728124215.jpg', '9', 'Umum', 'energen-vanila-renceng', 0),
(10, 'SCGIV400', 'GIV Sabun Cair 400 ml', 6, 18000, '20240728125028.jpg', '12', 'Umum', 'giv-sabun-cair-400-ml', 0),
(11, 'SBGIV76', 'SABUN BATANG GIV 76 GR', 36, 3000, '20240728125511.jpg', '12', 'Umum', 'sabun-batang-giv-76-gr', 0),
(12, 'SBNUVO72', 'SABUN NUVO  72 GR', 36, 3000, '20240728125843.jpg', '12', 'Usman', 'sabun-nuvo-72-gr', 0),
(13, 'MSCUP', 'MIE SEDAP CUP SELECTION', 48, 5000, '20240728130528.jpg', '9', 'Umum', 'mie-sedap-cup-selection', 0),
(14, 'MSCUPG', 'MIE GORENG CUP', 40, 5000, '20240728141537.jpg', '9', 'Umum', 'mie-goreng-cup', 0),
(15, 'MSCUPK', 'MIE SEDAP CUP KUAH ', 40, 5000, '20240728142456.jpg', '9', 'Umum', 'mie-sedap-cup-kuah', 0),
(16, 'MSAB', 'MIE SEDAP AYAM BAWANG', 40, 3000, '20240728143008.jpg', '9', 'Umum', 'mie-sedap-ayam-bawang', 0),
(17, 'SZINCSASET', 'Shampo Zink Saset', 20, 18000, '20240728143550.jpg', '12', 'Umum', 'shampo-zink-saset', 0),
(18, 'SR160', 'Rejoice 160ML', 11, 19000, '20240728143928.jpg', '12', 'Umum', 'rejoice-160ml', 0),
(19, 'CS330', 'CLEAR Shampoo 330ml', 12, 21000, '20240728144031.jpg', '12', 'Umum', 'clear-shampoo-330ml', 0),
(20, 'SS160', 'SUNSILK Shampoo 160 ML', 10, 18000, '20240728144138.jpg', '12', 'Umum', 'sunsilk-shampoo-160-ml', 0),
(21, 'NIPISMADU', 'NIPIS MADU 330 ML', 12, 3500, '20240728145019.jpg', '10', 'Umum', 'nipis-madu-330-ml', 0),
(22, 'LE330', 'Le Mineral 330 ml', 48, 2000, '20240728145909.jpg', '10', 'Usman', 'le-mineral-330-ml', 0),
(23, 'GENTELG360', 'GENTEL GEN 360 ML', 12, 10000, '20240728150731.jpg', '12', 'Umum', 'gentel-gen-360-ml', 0),
(24, 'ML950', 'mama lemon 950 ML', 12, 12000, '20240728152149.jpg', '11', 'Umum', 'mama-lemon-950-ml', 0),
(25, 'SCPEKO', 'EKONOMI', 12, 8500, '20240728152350.jpg', '11', 'Umum', 'ekonomi', 0),
(26, 'SGC3', 'CIPTADENT Sikat Gigi', 12, 22000, '20240728152613.jpg', '12', 'Umum', 'ciptadent-sikat-gigi', 0),
(27, 'TOPGA', 'TOP GULA AREN RENCENG', 20, 19500, '20240728153149.jpg', '9', 'Umum', 'top-gula-aren-renceng', 0),
(28, 'TOPCAPP', 'TOP CAPPUCCINO RENCENG', 20, 19500, '20240728153712.jpg', '9', 'Umum', 'top-cappuccino-renceng', 0),
(29, 'TOPSAS', 'TOP SASET', 50, 1000, '20240728153919.jpg', '9', 'Umum', 'top-saset', 0),
(30, 'MIGELASSEDUH', 'MIGELAS Kuah Satuan', 50, 1500, '20240728154752.jpg', '9', 'Umum', 'migelas-kuah-satuan', 0),
(31, 'LE600', 'Lemineral 600 ml', 24, 3000, '20240728155228.jpg', '10', 'Usman', 'lemineral-600-ml', 0),
(32, 'BIMOLI1', 'Bimoli 1 liter', 12, 19000, '20240728161220.jpg', '9', 'Umum', 'bimoli-1-liter', 0),
(33, 'SUNCO1', 'Sunco 1 Liter', 12, 19000, '20240728161355.jpg', '9', 'Umum', 'sunco-1-liter', 0),
(34, 'BIMOLI2', 'Sunco 2 Liter', 12, 36000, '20240728161552.jpg', '9', 'Umum', 'sunco-2-liter', 0),
(35, 'FORT2', 'FORTUNE 2 Liter', 12, 36000, '20240728161752.jpg', '9', 'Umum', 'fortune-2-liter', 0),
(36, 'FORT1', 'FORTUNE 1 Liter', 12, 18000, '20240728161831.jpg', '9', 'Umum', 'fortune-1-liter', 0),
(37, 'SANIA1', 'Sania 1 LITER', 12, 18000, '20240728161910.jpg', '9', 'Umum', 'sania-1-liter', 0),
(38, 'SANIA2', 'Sania 2 Ltr', 12, 36000, '20240728161941.jpg', '9', 'Umum', 'sania-2-ltr', 0),
(39, 'DOWNYR', 'DOWNY Sachet', 40, 1000, '20240728162134.jpg', '11', 'Umum', 'downy-sachet', 0),
(40, 'SUNL680', 'Sunlight 668', 12, 13000, '20240728162329.jpg', '11', 'Umum', 'sunlight-668', 0),
(41, 'KRISBEE2', 'KRISBEE', 12, 2000, '20240728163148.jpg', '10', 'Usman', 'krisbee', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(25) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `no_telp`) VALUES
(1, 'Mayora', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp`
--

CREATE TABLE `temp` (
  `id_temp` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `temp`
--

INSERT INTO `temp` (`id_temp`, `id_produk`, `jumlah`, `id_pelanggan`, `id_user`) VALUES
(1, 32, 3, 6, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp2`
--

CREATE TABLE `temp2` (
  `id_temp` int NOT NULL,
  `id_produk` int NOT NULL,
  `id_user` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `temp2`
--

INSERT INTO `temp2` (`id_temp`, `id_produk`, `id_user`, `jumlah`, `harga`) VALUES
(2, 32, 3, 3, 4000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('Admin','Kasir','','') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Admin'),
(6, 'kasir', 'c7911af3adbd12a035b289556d96470a', 'Ali Marshanto', 'Kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_detail_pembelian`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indeks untuk tabel `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id_mutasi`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

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
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indeks untuk tabel `temp2`
--
ALTER TABLE `temp2`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id_detail_pembelian` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfigurasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id_mutasi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `temp`
--
ALTER TABLE `temp`
  MODIFY `id_temp` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `temp2`
--
ALTER TABLE `temp2`
  MODIFY `id_temp` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
