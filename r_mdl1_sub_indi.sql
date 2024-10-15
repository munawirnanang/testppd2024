-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 06:10 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peppd_ppd2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `r_mdl1_sub_indi`
--

CREATE TABLE `r_mdl1_sub_indi` (
  `id` int(11) NOT NULL,
  `nourut` int(11) NOT NULL DEFAULT '1' COMMENT 'No Urut',
  `indiid` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `isactive` enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT 'status aktif',
  `istampil` enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT 'Ditampilkan',
  `isprov` enum('ALL','PROV','KOTKAB','KOT','KAB') NOT NULL DEFAULT 'ALL' COMMENT 'tag provinsi',
  `note` varchar(500) DEFAULT NULL,
  `cr_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cr_by` varchar(50) NOT NULL,
  `up_dt` datetime DEFAULT NULL,
  `up_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_mdl1_sub_indi`
--

INSERT INTO `r_mdl1_sub_indi` (`id`, `nourut`, `indiid`, `nama`, `isactive`, `istampil`, `isprov`, `note`, `cr_dt`, `cr_by`, `up_dt`, `up_by`) VALUES
(1, 1, 1, 'A. Pertumbuhan Ekonomi', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-02 15:06:51', 'SekretariatPPD'),
(3, 3, 1, 'B. Inklusivitas Pembangunan', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-02 15:06:59', 'SekretariatPPD'),
(4, 1, 2, 'Tingkat Pengangguran Terbuka (TPT) dan Jumlah Penganggur 1', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-02 14:19:00', 'SekretariatPPD'),
(5, 2, 2, 'Tingkat Pengangguran Terbuka (TPT) dan Jumlah Penganggur 2 (Khusus Provinsi)', 'Y', 'N', 'PROV', '', '2024-10-07 03:38:44', 'SekretariatPPD', '2024-01-23 10:57:46', 'SekretariatPPD'),
(6, 3, 2, 'Tingkat Pengangguran Terbuka (TPT) dan Jumlah Penganggur 3 - 5', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-02 14:26:57', 'SekretariatPPD'),
(7, 1, 3, 'A.   Tingkat Kemiskinan', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-16 16:34:57', 'SekretariatPPD'),
(8, 4, 3, 'B.     Indeks Kedalaman Kemiskinan', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2022-12-14 11:37:33', 'SekretariatPPD'),
(10, 2, 3, 'A.   Tingkat Kemiskinan 2 (Khusus Provinsi)', 'Y', 'N', 'PROV', '', '2024-10-07 03:38:44', 'SekretariatPPD', '2024-01-23 10:58:11', 'SekretariatPPD'),
(11, 3, 3, 'A.   Tingkat Kemiskinan 3-5', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-16 16:35:16', 'SekretariatPPD'),
(12, 1, 4, 'A.    Indeks Pembangunan Manusia (IPM)', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(13, 2, 4, 'B.     Angka Harapan Hidup (AHH)', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(14, 3, 4, 'C.     Rata-rata Lama Sekolah (RLS)', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(15, 4, 4, 'D.    Harapan Lama Sekolah (HLS)', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(16, 5, 4, 'E.     Pengeluaran per Kapita (Disesuaikan)', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(17, 1, 5, 'A. Ketimpangan Antar Kelompok Pendapatan', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(18, 2, 5, 'B. Ketimpangan Regional', 'Y', 'Y', 'PROV', '', '2024-10-07 03:38:44', 'SekretariatPPD', NULL, NULL),
(19, 1, 6, 'Pelayanan Publik dan Pengelolaan Keuangan', 'Y', 'N', 'ALL', 'Catatan: *)    Permendagri No. 15 Tahun 2023 tentang Pedoman Penyusunan APBD T.A. 2024\r\n **) Permen PANRB No. 14 Tahun 2017 tentang Pedoman Penyusunan Survei Kepuasan Masyarakat Unit Penyelenggara Pelayanan Publik\r\n', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-16 16:55:32', 'SekretariatPPD'),
(20, 1, 7, 'A. Transparansi', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-18 14:10:14', 'SekretariatPPD'),
(21, 2, 7, 'A. Transparansi 5 (Khusus Provinsi)', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-18 14:15:45', 'SekretariatPPD'),
(22, 3, 7, 'A. Transparansi 6 - 7', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(23, 4, 7, 'B. Akuntabilitas', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(24, 5, 7, 'B. Akuntabilitas 3 - 4 (Khusus Provinsi)', 'Y', 'N', 'PROV', '', '2024-10-07 03:38:44', 'SekretariatPPD', '2022-12-15 10:31:10', 'SekretariatPPD'),
(25, 1, 8, 'Tersedianya pemetaan kebijakan RKPD 2024 yang terkait dengan visi dan misi, strategi dan arah kebijakan RPJMD/RPD', 'Y', 'N', 'ALL', 'Catatan: \r\n1) Untuk daerah yang masa jabatan Kepala Daerahnya berakhir pada tahun 2023 (memiliki RPJMD yang berakhir pada 2023) mengacu pada dokumen Rencana Pembangunan Daerah (RPD)\r\n2) Untuk daerah yang belum memiliki RPJMD/RPD mengacu pada RPJPD atau dokumen transisi\r\n', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-16 16:33:42', 'SekretariatPPD'),
(26, 1, 9, 'Tersedianya penjelasan keterkaitan antara sasaran dan prioritas pembangunan daerah dalam RKPD 2024 dengan sasaran Prioritas Nasional (PN) RKP 2024', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-04 15:46:22', 'SekretariatPPD'),
(27, 1, 10, 'Terwujudnya konsistensi antara hasil evaluasi pelaksanaan RKPD 2022 dengan permasalahan/isu strategis pada RKPD 2024', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-04 16:12:03', 'SekretariatPPD'),
(28, 1, 11, 'Terwujudnya konsistensi antara prioritas pembangunan daerah dengan permasalahan/isu strategis pada RKPD 2024', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-04 16:15:02', 'SekretariatPPD'),
(29, 1, 12, 'Terwujudnya konsistensi antara prioritas pembangunan daerah dalam RKPD 2024 dengan program prioritas daerah', 'Y', 'N', 'ALL', 'Program Prioritas merupakan penjabaran dari prioritas daerah yang memiliki kejelasan implikasi kebijakan', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-16 16:27:22', 'SekretariatPPD'),
(30, 1, 13, 'Terwujudnya konsistensi antara prioritas pembangunan dalam RKPD 2024 dengan pagu anggaran', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-04 16:22:19', 'SekretariatPPD'),
(33, 1, 15, 'A. PN 1 - Penguatan Ketahanan Ekonomi untuk Pertumbuhan Berkualitas dan Berkeadilan', 'Y', 'Y', 'ALL', 'Catatan:\r\n1. Satu program daerah boleh mendukung beberapa PN. Program prioritas RKP 2024 tersedia di Lampiran 2\r\n2. Identifikasi dukungan program harus disertai indikator program yang relevan yang \r\n', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-16 16:19:46', 'SekretariatPPD'),
(34, 2, 15, 'B. PN 2 - Pengembangan dan Pemerataan Wilayah untuk Mengurangi Kesenjangan', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-04 16:33:41', 'SekretariatPPD'),
(35, 1, 16, 'Tersedianya kerangka ekonomi dan kerangka pendanaan yang dilengkapi dengan proyeksi dan arah kebijakan', 'Y', 'N', 'ALL', 'Catatan: Selisih pendapatan dengan belanja adalah dana bantuan sosial (asumsi)', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-16 17:56:51', 'SekretariatPPD'),
(40, 1, 21, 'Tersedianya kebijakan pembangunan daerah RKPD 2023 yang menerapkan konsep Tematik, Holistik, Integratif, dan Spasial (THIS)', 'Y', 'N', 'ALL', 'Catatan:\r\n- Tematik adalah tema-tema yang menjadi prioritas dalam satu jangka waktu tertentu\r\n- Holistik artinya penjabaran tematik dari program ke dalam perencanaan dan penganggaran yang komprehensif mulai dari hulu sampai ke hilir dalam suatu rangkaian kegiatan\r\n- Integratif artinya keterpaduan pelaksanaan perencanaan program yang dilihat dari berbagai peran pemangku kepentingan dan upaya keterpaduan dari berbagai sumber pembiayaan\r\n- Spasial artinya kegiatan pembangunan yang direncanakan fung', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-16 16:17:57', 'SekretariatPPD'),
(41, 1, 22, 'Tersedianya indikator kinerja sasaran pembangunan daerah dan program prioritas', 'Y', 'N', 'ALL', 'Catatan: Referensi indikator dampak dan hasil bersumber dari Permendagri No. 86 Tahun 2017', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-16 16:19:07', 'SekretariatPPD'),
(42, 1, 23, 'Kelengkapan dokumen inovasi daerah', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(43, 1, 24, 'Kedalaman inovasi daerah', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(44, 1, 25, 'Satu Data Indonesia', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(45, 1, 26, 'Penyelenggaraan Pengendalian Pemerintah Daerah', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(46, 1, 27, 'Keselarasan antara sasaran dan prioritas pembangunan daerah dalam RPJMD/RPD dengan sasaran Prioritas Nasional (PN) RPJMN', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(47, 1, 28, 'Tersedianya dukungan program daerah dalam RPJMD/RPD untuk mendukung program prioritas dalam RPJMN', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(48, 1, 29, 'Keselarasan Indikator Makro dan SPM RPJMD/RPD dengan RPJMN ', 'Y', 'N', 'ALL', 'Catatan: \r\n• Asumsi selaras memiliki minimal 90?ri target makro\r\n• SPM berdasarkan PP Nomor 2 Tahun 2018\r\n', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-16 16:39:37', 'SekretariatPPD'),
(49, 3, 15, 'C. PN 3 - Peningkatan Sumber Daya Manusia Berkualitas dan Berdaya Saing', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(50, 4, 15, 'D. PN 4 - Revolusi Mental dan Pembangunan Kebudayaan', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(51, 5, 15, 'E. PN 5 -Penguatan Infrastruktur untuk Pengembangan Ekonomi dan Pelayanan Dasar', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(52, 6, 15, 'F. PN 6 - Lingkungan Hidup, Ketahanan Bencana, dan Perubahan Iklim', 'Y', 'Y', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', NULL, NULL),
(53, 2, 22, 'Tersedianya indikator kinerja sasaran pembangunan daerah dan program prioritas 6', 'Y', 'N', 'PROV', '', '2024-10-07 03:38:44', 'SekretariatPPD', NULL, NULL),
(54, 2, 16, 'Tersedianya kerangka ekonomi dan kerangka pendanaan yang dilengkapi dengan proyeksi dan arah kebijakan (no 6)', 'Y', 'N', 'PROV', '', '2024-10-07 03:38:44', 'SekretariatPPD', NULL, NULL),
(55, 2, 1, 'A. Pertumbuhan Ekonomi (item 2)(khusus provinsi)', 'Y', 'N', 'PROV', '', '2024-10-07 03:38:44', 'SekretariatPPD', '2024-01-23 10:54:15', 'SekretariatPPD'),
(56, 3, 1, 'A. Pertumbuhan Ekonomi (item 3-5)', 'Y', 'N', 'ALL', '', '2024-10-07 03:37:53', 'SekretariatPPD', '2024-01-23 10:54:08', 'SekretariatPPD'),
(57, 99, 1, 'test 1 All', 'Y', 'Y', 'ALL', '', '2024-10-08 06:58:52', 'SekretariatPPD', '2024-10-08 13:58:52', 'SekretariatPPD'),
(58, 98, 1, 'test 2 Provinsi', 'Y', 'Y', 'PROV', '', '2024-10-08 06:58:44', 'SekretariatPPD', '2024-10-08 13:58:44', 'SekretariatPPD'),
(59, 97, 1, 'test 3 Kota dan Kabupaten', 'Y', 'Y', 'KOTKAB', '', '2024-10-08 06:58:36', 'SekretariatPPD', '2024-10-08 13:58:36', 'SekretariatPPD'),
(60, 96, 1, 'test 4 Kota', 'Y', 'Y', 'KOT', '', '2024-10-08 06:58:28', 'SekretariatPPD', '2024-10-08 13:58:28', 'SekretariatPPD'),
(61, 95, 1, 'test 5 Kabupaten', 'Y', 'Y', 'KAB', '', '2024-10-08 06:58:21', 'SekretariatPPD', '2024-10-08 13:58:21', 'SekretariatPPD');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_mdl1_sub_indi`
--
ALTER TABLE `r_mdl1_sub_indi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `indiid` (`indiid`,`nama`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_mdl1_sub_indi`
--
ALTER TABLE `r_mdl1_sub_indi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `r_mdl1_sub_indi`
--
ALTER TABLE `r_mdl1_sub_indi`
  ADD CONSTRAINT `r_mdl1_sub_indi_ibfk_1` FOREIGN KEY (`indiid`) REFERENCES `r_mdl1_indi` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
