-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Okt 2024 pada 01.22
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarpras2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggaran`
--

CREATE TABLE `anggaran` (
  `id` int(11) NOT NULL,
  `nama_anggaran` varchar(100) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggaran`
--

INSERT INTO `anggaran` (`id`, `nama_anggaran`, `status`) VALUES
(1, 'APBN', 'aktif'),
(2, 'APBD', 'aktif'),
(3, 'DAK', 'aktif'),
(4, 'Hibah', 'aktif'),
(5, 'Bankeu', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `approvals`
--

CREATE TABLE `approvals` (
  `id` int(11) NOT NULL,
  `aset_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `documentation` varchar(255) DEFAULT NULL,
  `approval_type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `approvals`
--

INSERT INTO `approvals` (`id`, `aset_id`, `school_id`, `status`, `documentation`, `approval_type`, `created_at`, `updated_at`) VALUES
(1, 7, 47, 'Disetujui', NULL, NULL, '2024-10-21 22:41:22', '2024-10-21 22:42:42'),
(2, 8, 47, 'Sedang Ditinjau', NULL, NULL, '2024-10-21 22:54:52', '2024-10-21 22:54:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_aset`
--

CREATE TABLE `data_aset` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `kode_inventaris` varchar(100) NOT NULL,
  `nama_aset` varchar(100) NOT NULL,
  `tanggal_aset` date NOT NULL,
  `masa_garansi` int(11) NOT NULL,
  `harga_aset` decimal(15,2) NOT NULL,
  `kondisi` enum('baik','rusak_ringan','rusak_sedang','rusak_berat') NOT NULL,
  `nomor_seri` varchar(100) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `bukti_gambar` varchar(255) DEFAULT NULL,
  `kategori_aset_id` int(11) NOT NULL,
  `kategori_data_id` int(11) NOT NULL,
  `anggaran_id` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `status_penanganan` enum('belum ditangani','sedang ditangani','selesai') DEFAULT 'belum ditangani',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_aset`
--

INSERT INTO `data_aset` (`id`, `school_id`, `kode_inventaris`, `nama_aset`, `tanggal_aset`, `masa_garansi`, `harga_aset`, `kondisi`, `nomor_seri`, `catatan`, `bukti_gambar`, `kategori_aset_id`, `kategori_data_id`, `anggaran_id`, `ruangan_id`, `status_penanganan`, `created_at`, `updated_at`) VALUES
(1, 47, '1231231', 'test', '2024-09-18', 1, '1000000.00', 'baik', '1231231', '', '1729552552_493ad20e6f7d9da5726b.webp', 1, 1, 1, 1, 'belum ditangani', '2024-09-18 03:28:31', '2024-10-21 23:15:52'),
(2, 47, '12312311', 'test2', '2024-09-19', 1, '1000000.00', 'baik', '12312311', 'test2', '1726714605_3ddd895bca213adfc71a.jpg', 3, 1, 2, 2, 'belum ditangani', '2024-09-19 02:56:45', '2024-09-19 02:56:45'),
(3, 47, '123123111', 'test3', '2024-10-21', 1, '1500000.00', 'baik', '123123111', '', '1729472961_9543e8be995911d48c4f.png', 2, 1, 2, 2, 'belum ditangani', '2024-10-21 01:09:21', '2024-10-21 01:09:21'),
(4, 47, '1231231111', 'test4', '2024-10-21', 1, '2500000.00', 'rusak_ringan', '1231231111', '', '1729551031_682d8fe61d0e9f6e4814.png', 1, 1, 2, 3, 'belum ditangani', '2024-10-21 01:27:24', '2024-10-21 22:52:07'),
(5, 47, '12312311111', 'test5', '2024-10-21', 1, '2530000.00', 'rusak_berat', '12312311111', '', '1729476708_c395dca8a30318962c93.png', 1, 1, 3, 9, 'belum ditangani', '2024-10-21 01:53:06', '2024-10-21 02:11:48'),
(6, 47, 'test6', 'test6', '2024-10-21', 1, '123123123.00', 'rusak_sedang', '12312312', '', '1729476775_a2a5407d6042ad7aa993.png', 1, 1, 3, 5, 'belum ditangani', '2024-10-21 02:12:55', '2024-10-21 02:12:55'),
(7, 47, 'test7', 'test7', '2024-10-21', 1, '123141225.00', 'rusak_sedang', '1212312', '', '1729477110_ef3525aebeb09c2d4fa4.pdf', 1, 1, 2, 8, 'belum ditangani', '2024-10-21 02:14:40', '2024-10-21 12:47:57'),
(8, 47, 'test8', 'test8', '2024-10-22', 1, '123112512.00', 'rusak_ringan', 'test8', 'test8', '1729551219_3ba36f62571a5efe2701.png', 2, 1, 4, 6, 'belum ditangani', '2024-10-21 22:53:39', '2024-10-21 22:54:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_rkb`
--

CREATE TABLE `data_rkb` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `jumlah_siswa` int(11) DEFAULT NULL,
  `jumlah_rombel` int(11) DEFAULT NULL,
  `jumlah_rkb` int(11) DEFAULT NULL,
  `kekurangan_rkb` int(11) DEFAULT NULL,
  `rkb_baik` int(11) DEFAULT NULL,
  `rkb_rusak_ringan` int(11) DEFAULT NULL,
  `rkb_rusak_sedang` int(11) DEFAULT NULL,
  `rkb_rusak_berat` int(11) DEFAULT NULL,
  `meja_kursi_siswa_layak` int(11) DEFAULT NULL,
  `meja_kursi_siswa_tidak_layak` int(11) DEFAULT NULL,
  `meja_kursi_guru_layak` int(11) DEFAULT NULL,
  `meja_kursi_guru_tidak_layak` int(11) DEFAULT NULL,
  `lemari` int(11) DEFAULT NULL,
  `papan_tulis` int(11) DEFAULT NULL,
  `papan_pajangan` int(11) DEFAULT NULL,
  `proyektor` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_aset`
--

CREATE TABLE `kategori_aset` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_aset`
--

INSERT INTO `kategori_aset` (`id`, `nama_kategori`, `status`) VALUES
(1, 'Sarana', 'aktif'),
(2, 'Prasarana', 'aktif'),
(3, 'Sarana Pendukung', 'aktif'),
(4, 'Fisik', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_data`
--

CREATE TABLE `kategori_data` (
  `id` int(11) NOT NULL,
  `nama_kategori_data` varchar(100) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_data`
--

INSERT INTO `kategori_data` (`id`, `nama_kategori_data`, `status`) VALUES
(1, 'Data RKB', 'aktif'),
(2, 'Data Fisik Prioritas', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `name`) VALUES
(1, 'Penajam'),
(2, 'Sepaku'),
(3, 'Babulu'),
(4, 'Waru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  `status` enum('aktif','tidak aktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama_ruangan`, `status`) VALUES
(1, 'Ruang Pimpinan', 'aktif'),
(2, 'Ruang Guru', 'aktif'),
(3, 'Ruang TU', 'aktif'),
(4, 'Ruang Perpustakaan', 'aktif'),
(5, 'Ruang UKS', 'aktif'),
(6, 'Lab. Komputer', 'aktif'),
(7, 'Lab. IPA', 'aktif'),
(8, 'Ruang BK', 'aktif'),
(9, 'Ruang Kesenian', 'aktif'),
(10, 'Tempat Ibadah', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `kecamatan_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `category` enum('PAUD','SD','SMP') NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `alamat_sekolah` text DEFAULT NULL,
  `alamat_email` varchar(255) DEFAULT NULL,
  `status_lahan` varchar(100) DEFAULT NULL,
  `luas_lahan` float DEFAULT NULL,
  `daya_listrik` float DEFAULT NULL,
  `instalasi_air` varchar(100) DEFAULT NULL,
  `status_internet` varchar(100) DEFAULT NULL,
  `nama_kepala_sekolah` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `jumlah_siswa_laki` int(11) DEFAULT 0,
  `jumlah_siswi` int(11) DEFAULT 0,
  `total_rombel` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `schools`
--

INSERT INTO `schools` (`id`, `kecamatan_id`, `name`, `category`, `latitude`, `longitude`, `alamat_sekolah`, `alamat_email`, `status_lahan`, `luas_lahan`, `daya_listrik`, `instalasi_air`, `status_internet`, `nama_kepala_sekolah`, `nomor_telepon`, `foto`, `jumlah_siswa_laki`, `jumlah_siswi`, `total_rombel`) VALUES
(47, 1, 'SMPN 1 PPU', 'SMP', -1.2495672576007355, 116.77377283573152, 'Jln. Raya Penajam No 12, Penajam, Penajam, PPU', 'smpn1ppu@gmail.com', 'Segel', 5712, 37900, 'PDAM', 'Ada', 'Budi Lestarianto, S.Pd', '082148730765', '1715304343_2beace6ce8889b27c370.jpg', 233, 266, 15),
(48, 2, 'SMPN 2 PPU', 'SMP', -0.913514643733068, 116.81611955165864, 'Jl. Negara Km. 35, Tengin Baru, Sepaku, PPU', 'info@smpn2ppu.sch.id', 'Segel', 23358, 5000, 'PDAM', 'Ada', 'Supardi, S.Pd, MM', NULL, '1715304170_66cb26ed20fcc7a80847.jpg', 215, 226, 15),
(49, 3, 'SMPN 3 PPU', 'SMP', -1.518256686455638, 116.41274750232697, 'Jl. Transmigrasi Rt.10, Gunung Intan, Babulu, PPU', 'smpnegeri3penajampaserutara@gmail.com', 'Sertifikat', 43660, 16000, 'Sumur Bor', 'Ada', 'Abdullah, S.Pd', '081254034417', '1715304493_e5d999b6d1272d929fe9.jpg', 216, 245, 15),
(50, 4, 'SMPN 4 PPU', 'SMP', -1.4023835280577457, 116.60584241151811, 'Jl. Raya Waru Km. 27, Waru, Waru, PPU', 'smp4ppu@gmail.com', 'Sertifikat', 20000, 16500, 'PDAM', 'Ada', 'Rosnah, M.Pd', NULL, '1715304726_118c5c36a0d87317fa04.jpg', 159, 187, 12),
(51, 1, 'SMPN 5 PPU', 'SMP', -1.3427107774696676, 116.67826741933824, 'Jl. Raya Girimukti Km.15, Girimukti, Penajam, PPU', 'smpn5ppu2018@gmail.com', 'Sertifikat', 18968, 27300, 'PDAM', 'Ada', 'Yaleswati, S.Pd, MM', '05435233167', '1715304905_41eee332507e9694a009.jpg', 275, 267, 18),
(52, 2, 'SMPN 6 PPU', 'SMP', -0.9419512156491487, 116.8946197628975, 'Jl. Pulau Laut No.1, Semoi Dua, Sepaku, PPU', 'smpn6ppusemoi@gmail.com', 'Segel', 22064, 7700, 'Sumur Galian', 'Ada', 'Sugeng Subandi, S.Pd', '081347245375', '1715305101_1525636a94effa7a2105.jpg', 80, 87, 7),
(53, 1, 'SMPN 7 PPU', 'SMP', -1.186665740313766, 116.61535888910295, 'Sotek Rt 15, Sotek, Penajam, PPU', 'smpn7ppu@gmail.com', 'Sertifikat', 17240, 6600, 'PDAM', 'Ada', 'Drs.Sukaryadi', '082291204419', '1715305385_bda38005976d3cbabbcf.jpg', 148, 135, 9),
(54, 3, 'SMPN 8 PPU', 'SMP', -1.5400748863925051, 116.46080464124681, 'Jl. Lobk RT.09, Sebakung Jaya, Babulu, PPU', 'smpndelapanppu@gmail.com', 'Sertifikat', 14540, 11800, 'Sumur Bor', 'Ada', 'Dra. Wagiyamawati', '081346456772', '1715305557_61fa96a407e47567be90.jpg', 99, 134, 9),
(55, 1, 'SMPN 9 PPU', 'SMP', -1.373955094189525, 116.69291764497758, 'Jl. Pondok Uma, Saloloang, Penajam, PPU', NULL, 'Segel', 10600, 21000, 'Sumur Bor', 'Ada', 'Kusmiati, S.Pd, MM', '08125566341', '1715305706_27b5a58530cb1e5e7d50.jpg', 161, 115, 9),
(56, 1, 'SMPN 10 PPU', 'SMP', -1.2768207609157927, 116.74685150384904, 'Jl. Propinsi Km. 4,5, Nenang, Penajam, PPU', 'smpn10ppu@yahoo.co.id', 'Sertifikat', 30000, 10600, 'PDAM', 'Ada', 'Pedie Dawid, S.Pd', '05428540091', '1715305853_fdd7f8dbddcb296bf400.jpg', 188, 158, 12),
(57, 3, 'SMPN 11 PPU', 'SMP', -1.4786682521339278, 116.48725122213366, 'Jl. Negara Km. 44, Labangka Barat, Babulu, PPU', 'smpn11ppu@gmail.com', 'Segel', 10000, 10600, 'Sumur Bor', 'Ada', 'Supriadi, S.Pd, MM', '05433120712', '1715305977_5f1b342737926b725c66.jpg', 147, 183, 12),
(58, 2, 'SMPN 12 PPU', 'SMP', -1.098465602117811, 116.68917059898378, 'Jl. Mariko RT 06, Maridan, Sepaku, PPU', 'smpn12maridan@yahoo.co.id', 'Sertifikat', 106015, 5000, 'PDAM', 'Ada', 'Kukuh Yuliarso, S.Pd', '082142149046', '1715306240_bcbeff977d75223347ab.jpg', 139, 154, 9),
(59, 4, 'SMPN 13 PPU', 'SMP', -1.3789299941826472, 116.61332309246065, 'Jl. Agatis, RT.03, Bangun Mulyo, Waru, PPU', 'smpn13ppu@yahoo.co.id', 'Sertifikat', 10090, 10000, 'Sumur Bor', 'Ada', 'Lilik Suryani, S.Pd, MM', '081346277966', NULL, 167, 202, 12),
(60, 1, 'SMPN 14 PPU', 'SMP', -1.1205734196611195, 116.63974016904834, 'Jl. Maridan RT.06, Riko, Penajam, PPU', 'smpnegeri_14@yahoo.co.id', 'Segel', 15029, 4300, 'Sumur Galian', 'Ada', 'Dra. Rarik Kristiani, M.M, M.Pd', '082148441802', '1715306382_2472576250a4b9a5bd88.jpg', 59, 35, 3),
(61, 1, 'SMPN 15 PPU', 'SMP', -1.1922167166228856, 116.75189942121507, 'JL KH Ahmad Dahlan RT.02, Gersik, Penajam, PPU', 'smplimabelasppu@gmail.com', 'Segel', 4817, 8800, 'Sumur Galian', 'Ada', 'Raif Wijaya,S.Pd', '0811591689', '1715306510_d861740821d057c9e352.jpg', 90, 69, 6),
(62, 3, 'SMPN 16 PPU', 'SMP', -1.5073098819871162, 116.37658864259721, 'Jl. Trans Sisipan RT.09, Rintik, Babulu, PPU', 'smpn.16PPU@gmail.com', 'Sertifikat', 18310, 5500, 'Sumur Bor', 'Ada', 'Drs.Alimuddin', '082352272006', '1715306617_bc8e31f81138df30d567.jpg', 51, 69, 6),
(63, 3, 'SMPN 17 PPU', 'SMP', -1.5206947950248353, 116.51338666677478, 'Jl. Unmul, RT.9, Babulu Laut, Babulu, PPU', 'smpn17ppu@yahoo.co.id', 'Sertifikat', 15000, 5500, 'Tadah Hujan', 'Ada', 'Kaswan, S.Pd', '085345388265', '1715306865_91e667bb2a584fe232ab.jpg', 90, 84, 6),
(64, 4, 'SMPN 18 PPU', 'SMP', -1.4444758511675604, 116.54583066701892, 'Jl. Negara Km. 35, Api-Api, Waru, PPU', 'smp18ppu@yahoo.co.id', 'Sertifikat', 11457, 2200, 'Sumur Bor', 'Ada', 'Jumardin, S.Pd', '081347719291', '1715306991_6500418cb41e00d9aa75.jpg', 30, 21, 3),
(65, NULL, 'SMPN 19 PPU', 'SMP', -1.1615494452699298, 116.75011843442918, 'Jl. Mulawarman RT 01, Pantai Lango, Penajam, PPU', 'smpn_sembilanbelas@yahoo.com', 'Sertifikat', 3572, 2200, 'Sumur Bor', 'Tidak Ada', 'Sukisno, S.Pd.,MM', '08125332735', '1715307135_92ea8e4b8a6c6f0a874e.jpg', 48, 61, 5),
(66, 2, 'SMPN 20 PPU', 'SMP', -0.9657034108493948, 116.81973516941072, 'Jl. Wijaya Kusuma RT.01, Wonosari, Sepaku, PPU', 'smpn20ppu_sepaku@yahoo.co.id', 'Segel', 15498, 6600, NULL, NULL, 'Nurasiah, S.Pd', '085820117538', '1715307240_53921e9e5fb86686f8fa.jpg', 46, 56, 5),
(67, NULL, 'SMPN 21 PPU', 'SMP', -1.3126083828589918, 116.7383596301079, 'Jalan Coastal Road Km. 1,5 Kel. Nipah-nipah', 'smpn21ppu@yahoo.co.id', 'Hibah', 40000, 16500, 'PDAM', 'Ada', 'Edy Prayitno, S.Pd.', '05438540011', '1715307556_e9a8cae130e723c5341b.jpg', 193, 172, 12),
(68, 1, 'SMPN 22 PPU', 'SMP', -1.2566824618320434, 116.7585861682892, 'Jl. Telaga RT. 016 Gunung Setelenng, Penajam, PPU', 'Smpn22ppu@yahoo.co.id', 'Segel', 53181, 8000, 'Sumur', 'Ada', 'Dwi Astutik, S.Pd', '05428540589', '1715307671_6432d25c979ca0506178.jpg', 130, 109, 9),
(69, 1, 'SMPN 23 PPU', 'SMP', -1.363599526375094, 116.64722084999086, 'JL Provinsi KM.21 RT.11, Petung, Penajam, PPU', 'smpn23ppu@gmail.com', 'Sertifikat', 34000, 22000, 'Sumur Bor', 'Ada', 'Jaman, S.Pd', '081347638002', '1715307793_5ce84a8ec769d7ffde69.jpg', 133, 132, 9),
(70, 1, 'SMPN 24 PPU', 'SMP', -1.1343143978809944, 116.54572874307635, 'Jl. HTI Trans RT.10, Bukit Subur, Penajam, PPU', 'smpn24ppu10@gmail.com', 'Hibah', 17000, 1300, 'PDAM', 'Ada', 'Darmawati,S.Pd', '081586715536', '1715307932_0a2ffbcc668e7fa96af1.jpg', 34, 24, 3),
(71, 1, 'SMPN 25 PPU', 'SMP', -1.3427322292498338, 116.65597289800645, 'Jl. Propinsi KM.16, Buluminung, Penajam, PPU', 'smpn25ppu@yahoo.co.id', 'Sertifikat', 39480, 1300, 'Tadah Hujan', 'Ada', 'H. Nuzulul Susanto, S.Pd', '081256816658', '1715308390_947b6b051e58a7f53ef6.jpg', 63, 58, 6),
(72, 2, 'SMPN 26 PPU', 'SMP', -1.3427322292498338, 116.65597289800645, 'Giri Purwa RT.03, Penajam, PPU', 'smpn26ppu@gmail.com', 'Sertifikat', 30784, NULL, 'Tadah Hujan', 'Tidak Ada', 'Rindi Wulandari, S.Pd', '083150182520', NULL, 25, 25, 3),
(73, 2, 'SMPN 27 PPU', 'SMP', -0.9583337394223396, 116.73788487911226, 'Jl. Negara Samboja Petung Km.46, Bumi Harapan, Sepaku, PPU', 'smpn27ppu@gmail.com', 'Hibah', 10020, NULL, 'Tadah Hujan', 'Tidak Ada', 'Nanang Faisol Hadi, M.SI', '081336308031', '1715308518_38ca53ad5ed6e36bc7c2.jpg', 27, 45, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `npsn` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','admin','operator','user') NOT NULL DEFAULT 'user',
  `school_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `npsn`, `email`, `password`, `role`, `school_id`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '00000000', 'superadmin@admin.com', '$2y$10$AeD4diz9cHi5ja23apZcqOz1qJjseKbN4upN5ty9B0ek6URbvT34y', 'superadmin', NULL, '2024-09-07 09:21:43', '2024-10-20 21:18:56'),
(3, 'adminSMP1', '30402057', 'smpn1ppu@yahoo.co.id', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 47, '2024-09-18 01:35:13', '2024-10-20 21:16:01'),
(4, 'adminSMP2', '30402058', 'info@smp2ppu.sch.id', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 48, '2024-09-18 01:35:13', '2024-10-20 21:16:05'),
(5, 'adminSMP3', '30402059', 'andhikasaputro048@gmail.com1', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 49, '2024-09-18 01:35:13', '2024-10-20 21:16:08'),
(6, 'adminSMP4', '30402060', 'smp4ppu@gmail.com', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 50, '2024-09-18 01:35:13', '2024-10-20 21:16:11'),
(7, 'adminSMP5', '30402061', 'smpn5ppu@gmail.com', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 51, '2024-09-18 01:35:13', '2024-10-20 21:16:14'),
(8, 'adminSMP6', '30402062', 'smpn6ppu@gmail.com', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 52, '2024-09-18 01:35:13', '2024-10-20 21:16:18'),
(9, 'adminSMP7', '30402063', 'smpn7ppu@gmail.com\n', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 53, '2024-09-18 01:35:13', '2024-10-20 21:16:21'),
(10, 'adminSMP8', '30402064', 'smpndelapanppu@yahoo.co.id', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 54, '2024-09-18 01:35:13', '2024-10-20 21:16:24'),
(11, 'adminSMP9', '30402065', 'ridho_listanto@yahoo.co.id', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 55, '2024-09-18 01:35:13', '2024-10-20 21:16:27'),
(12, 'adminSMP10', '30402053', 'smpn10ppu@yahoo.co.id', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 56, '2024-09-18 01:35:13', '2024-10-20 21:16:30'),
(13, 'adminSMP11', '30402054', 'muhfajars.jos@gmail.com', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 57, '2024-09-18 01:35:13', '2024-10-20 21:16:36'),
(14, 'adminSMP12', '30402055', 'smpn12maridan@yahoo.co.id', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 58, '2024-09-18 01:35:13', '2024-10-20 21:16:39'),
(15, 'adminSMP13', '30402056', 'smpnegeri13ppu@gmail.com', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 59, '2024-09-18 01:35:13', '2024-10-20 21:16:42'),
(16, 'adminSMP14', '30404296', 'adzier@yahoo.co.id', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 60, '2024-09-18 01:35:13', '2024-10-20 21:16:46'),
(17, 'adminSMP15', '30404297', 'smplimabelasppu@gmail.com', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 61, '2024-09-18 01:35:13', '2024-10-20 21:16:49'),
(18, 'adminSMP16', '30404298', 'abd.hafith@yahoo.co.id', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 62, '2024-09-18 01:35:13', '2024-10-20 21:16:52'),
(19, 'adminSMP17', '30404299', 'smpn17ppu@yahoo.co.id', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 63, '2024-09-18 01:35:13', '2024-10-20 21:16:55'),
(20, 'adminSMP18', '30405629', 'smp18ppu@yahoo.co.id', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 64, '2024-09-18 01:35:13', '2024-10-20 21:16:59'),
(21, 'adminSMP19', '30402067', 'Aryanto325@yahoo.co.id', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 65, '2024-09-18 01:35:13', '2024-10-20 21:17:03'),
(22, 'adminSMP20', '30402068', 'ppusmpn20@gmail.com', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 66, '2024-09-18 01:35:13', '2024-10-20 21:17:06'),
(23, 'operatorSMP1', NULL, 'operatorSMP1@smpn1ppu.sch.id', '$2y$10$SEISlbofHMIE6oM5ID8OWuKj2dmsBLWfJkRBn1.F4oU8sl6HgQ8bS', 'operator', 47, '2024-09-18 01:35:13', '2024-09-22 22:39:59'),
(24, 'operatorSMP2', NULL, 'operatorSMP2@smpn2ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 48, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(25, 'operatorSMP3', NULL, 'operatorSMP3@smpn3ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 49, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(26, 'operatorSMP4', NULL, 'operatorSMP4@smpn4ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 50, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(27, 'operatorSMP5', NULL, 'operatorSMP5@smpn5ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 51, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(28, 'operatorSMP6', NULL, 'operatorSMP6@smpn6ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 52, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(29, 'operatorSMP7', NULL, 'operatorSMP7@smpn7ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 53, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(30, 'operatorSMP8', NULL, 'operatorSMP8@smpn8ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 54, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(31, 'operatorSMP9', NULL, 'operatorSMP9@smpn9ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 55, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(32, 'operatorSMP10', NULL, 'operatorSMP10@smpn10ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 56, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(33, 'operatorSMP11', NULL, 'operatorSMP11@smpn11ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 57, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(34, 'operatorSMP12', NULL, 'operatorSMP12@smpn12ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 58, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(35, 'operatorSMP13', NULL, 'operatorSMP13@smpn13ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 59, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(36, 'operatorSMP14', NULL, 'operatorSMP14@smpn14ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 60, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(37, 'operatorSMP15', NULL, 'operatorSMP15@smpn15ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 61, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(38, 'operatorSMP16', NULL, 'operatorSMP16@smpn16ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 62, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(39, 'operatorSMP17', NULL, 'operatorSMP17@smpn17ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 63, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(40, 'operatorSMP18', NULL, 'operatorSMP18@smpn18ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 64, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(41, 'operatorSMP19', NULL, 'operatorSMP19@smpn19ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 65, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(42, 'operatorSMP20', NULL, 'operatorSMP20@smpn20ppu.sch.id', '2407bd807d6ca01d1bcd766c730cec9a', 'operator', 66, '2024-09-18 01:35:13', '2024-09-18 01:35:13'),
(43, 'sadminsmp1 ', NULL, 'sadminSMP1@smpn1ppu.sch.id', '$2y$10$90/LrJN4Eam0aRrxMEF9tuyOt7CLs3eWNz4tAF3yvhn1iW7GpfLDu', 'admin', 47, '2024-09-22 22:28:08', '2024-09-22 22:28:08');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aset_id` (`aset_id`);

--
-- Indeks untuk tabel `data_aset`
--
ALTER TABLE `data_aset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `kategori_aset_id` (`kategori_aset_id`),
  ADD KEY `kategori_data_id` (`kategori_data_id`),
  ADD KEY `anggaran_id` (`anggaran_id`),
  ADD KEY `ruangan_id` (`ruangan_id`);

--
-- Indeks untuk tabel `data_rkb`
--
ALTER TABLE `data_rkb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indeks untuk tabel `kategori_aset`
--
ALTER TABLE `kategori_aset`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_data`
--
ALTER TABLE `kategori_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kecamatan` (`kecamatan_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `school_id` (`school_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_aset`
--
ALTER TABLE `data_aset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `data_rkb`
--
ALTER TABLE `data_rkb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_aset`
--
ALTER TABLE `kategori_aset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kategori_data`
--
ALTER TABLE `kategori_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `approvals_ibfk_1` FOREIGN KEY (`aset_id`) REFERENCES `data_aset` (`id`);

--
-- Ketidakleluasaan untuk tabel `data_aset`
--
ALTER TABLE `data_aset`
  ADD CONSTRAINT `data_aset_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`),
  ADD CONSTRAINT `data_aset_ibfk_2` FOREIGN KEY (`kategori_aset_id`) REFERENCES `kategori_aset` (`id`),
  ADD CONSTRAINT `data_aset_ibfk_3` FOREIGN KEY (`kategori_data_id`) REFERENCES `kategori_data` (`id`),
  ADD CONSTRAINT `data_aset_ibfk_4` FOREIGN KEY (`anggaran_id`) REFERENCES `anggaran` (`id`),
  ADD CONSTRAINT `data_aset_ibfk_5` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`);

--
-- Ketidakleluasaan untuk tabel `data_rkb`
--
ALTER TABLE `data_rkb`
  ADD CONSTRAINT `data_rkb_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Ketidakleluasaan untuk tabel `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `fk_kecamatan` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
