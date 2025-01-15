-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 14, 2025 at 05:13 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rain_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` bigint UNSIGNED NOT NULL,
  `id_profile` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `institute` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Politeknik Negeri Batam',
  `privilege` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `id_profile`, `id_user`, `institute`, `privilege`, `created_at`, `updated_at`) VALUES
(1, 19, 19, 'Politeknik Negeri Batam', 'rain_db.*:SELECT, INSERT, UPDATE, DELETE', NULL, '2025-01-14 17:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `nib` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_profile` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_fields` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cooperation_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `founded_date` date DEFAULT NULL,
  `status_verified_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`nib`, `id_profile`, `id_user`, `type`, `business_fields`, `cooperation_file`, `founded_date`, `status_verified_at`, `created_at`, `updated_at`) VALUES
('1647354321', 10, 10, 'PT', 'manufaktur hardware application dan system', 'cooperation_folder/SURAT KERJASAMA PT. AOHAI INDONESIA DAN POLIBATAM.docx', '2019-01-13', '2025-01-14', NULL, '2025-01-14 17:03:49'),
('1983214321', 13, 13, 'LPK', 'LPK, Kursus dan pembelajaran', 'cooperation_folder/SURAT KERJASAMA INFINITE LEARNING DAN POLIBATAM.pdf', '2005-09-30', '2025-01-14', NULL, '2025-01-14 17:07:24'),
('1983647321', 17, 17, 'PT', 'manufaktur mekanik', 'cooperation_folder/SURAT KERJASAMA PT. NOK FREUDENBERG DAN POLIBATAM.pdf', '2007-04-18', '2025-01-14', NULL, '2025-01-14 17:10:22'),
('2309817463', 18, 18, 'PT', 'Manufacturing, Transport & Logistics', 'cooperation_folder/SURAT KERJASAMA PT. AMBER KARYA DAN POLIBATAM.pdf', '2013-01-26', '2025-01-14', NULL, '2025-01-14 17:11:27'),
('6648921221', 15, 15, 'PT', 'bidang kesehatan', 'cooperation_folder/SURAT KERJASAMA PT. CIBA ALCON BATAM DAN POLIBATAM.pdf', '2011-02-05', '2025-01-14', NULL, '2025-01-14 17:08:24'),
('7765902312', 14, 14, 'PT', 'bidang alat pancing dan sepeda', 'cooperation_folder/SURAT KERJASAMA PT. SHIMANO BATAM DAN POLIBATAM.pdf', '2010-10-11', '2025-01-14', NULL, '2025-01-14 17:07:57'),
('8756431231', 11, 11, 'PT', 'manufaktur mesin berat', 'cooperation_folder/SURAT KERJASAMA PT. BATAM TECHNO INDONESIA DAN POLIBATAM.pdf', '2012-03-13', '2025-01-14', NULL, '2025-01-14 17:04:37'),
('8864099912', 16, 16, 'PT', 'manufaktur jaringan dan teknologi', 'cooperation_folder/SURAT KERJASAMA TELKOM INDONESIA DAN POLIBATAM.pdf', '2017-04-18', '2025-01-14', NULL, '2025-01-14 17:09:10'),
('9845563123', 12, 12, 'PT', 'jasa logistik', 'cooperation_folder/SURAT KERJASAMA PT. GLOBALINDO MULTILOGISTIK DAN POLIBATAM.pdf', '2005-09-20', '2025-01-14', NULL, '2025-01-14 17:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Manajemen & Bisnis', '2025-01-14 16:43:00', '2025-01-14 16:43:00'),
(2, 'Teknik Elektro', '2025-01-14 16:43:00', '2025-01-14 16:43:00'),
(3, 'Teknik Informatika', '2025-01-14 16:43:00', '2025-01-14 16:43:00'),
(4, 'Teknik Mesin', '2025-01-14 16:43:00', '2025-01-14 16:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_12_13_194936_create_user_roles_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(3, '0001_01_01_000001_create_cache_table', 1),
(4, '0001_01_01_000002_create_jobs_table', 1),
(5, '2024_11_13_154049_create_personal_access_tokens_table', 1),
(6, '2024_12_07_151728_create_major_table', 1),
(7, '2024_12_07_151822_create_study_program_table', 1),
(8, '2024_12_08_123714_create_profile_table', 1),
(9, '2024_12_08_130250_create_student_table', 1),
(10, '2024_12_08_132545_create_company_table', 1),
(11, '2024_12_08_133210_create_admin_table', 1),
(12, '2024_12_08_134046_create_vacancy_table', 1),
(13, '2024_12_08_163211_create_proposal_table', 1),
(14, '2024_12_13_073941_create_password_reset_tokens', 1),
(15, '2024_12_13_203730_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id_profile` bigint UNSIGNED NOT NULL,
  `photo_profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id_profile`, `photo_profile`, `first_name`, `last_name`, `location`, `postal_code`, `city`, `phone_number`, `description`, `created_at`, `updated_at`) VALUES
(1, 'profile/Wasyn-removebg-preview.png', 'Wasyn', 'Sulaiman Siregar', 'Legenda Malaka', '248743', 'Batam', '0987543123', 'Mahasiswa aktif dari Politeknik Negeri Batam, jurusan Teknik Informatika dengan fokus pada program studi Sarjana Terapan Rekayasa Perangkat Lunak. Memiliki keahlian dalam membuat website responsif serta pengalaman dalam pengembangan perangkat lunak. Berdomisili di Legenda Malaka, Batam, dengan kode pos 248743.\\r\\n\\r\\nMahasiswa ini memiliki semangat untuk terus belajar dan berkembang di dunia teknologi, terutama dalam membangun solusi berbasis web yang inovatif dan efektif. Dengan keterampilan teknis yang solid dan kemampuan komunikasi yang baik, ia siap berkontribusi dalam proyek-proyek teknologi informasi yang menantang di industri.', NULL, '2025-01-14 16:46:14'),
(2, 'profile/Eric-removebg-preview.png', 'Eric', 'Marchelino Hutabarat', 'Botania', '244371', 'Batam', '0898997543', 'Seorang mahasiswa Politeknik Negeri Batam dari jurusan Teknik Informatika, khususnya pada program studi Sarjana Terapan Rekayasa Perangkat Lunak. Mahasiswa ini memiliki kemampuan unggul dalam pengembangan website responsif dan berfokus pada teknologi modern untuk menciptakan solusi digital yang efisien.\\r\\n\\r\\nBerasal dari Batam, tepatnya di daerah Botania, mahasiswa ini memiliki motivasi tinggi untuk mengembangkan keterampilan teknis dan non-teknis yang relevan di dunia kerja. Dengan latar belakang pendidikan yang kuat dan keterampilan dalam pengembangan perangkat lunak, ia siap menghadapi berbagai tantangan dalam dunia profesional dan memberikan dampak positif pada perusahaan atau organisasi tempatnya bekerja.', NULL, '2025-01-14 16:57:56'),
(3, 'profile/Aidil-removebg-preview.png', 'Muhammad', 'Aidil Jupriadi Sale', 'Tanjung Piayu', '248364', 'Batam', '0844332561', 'Muhammad Aidil Jupriadi Sale adalah seorang mahasiswa aktif dari Politeknik Negeri Batam yang sedang menempuh pendidikan di jurusan Teknik Informatika, program studi Sarjana Terapan Rekayasa Perangkat Lunak. Dengan fokus pada pengembangan teknologi digital, ia memiliki keahlian utama dalam membuat website responsif yang tidak hanya menarik secara visual, tetapi juga optimal dari segi fungsionalitas.\\r\\n\\r\\nDibesarkan di lingkungan kota Batam, tepatnya di Tanjung Piayu, Aidil memiliki semangat belajar tinggi serta minat mendalam terhadap inovasi teknologi. Dalam perjalanannya, ia telah mengembangkan keterampilan analisis, desain, dan pemrograman untuk membangun solusi perangkat lunak yang sesuai dengan kebutuhan industri modern.\\r\\n\\r\\nTidak hanya unggul dalam aspek teknis, Aidil juga memiliki kemampuan komunikasi dan kolaborasi yang baik, menjadikannya kandidat yang ideal untuk bekerja dalam tim. Dengan visi untuk terus belajar dan berkembang, ia berkomitmen untuk memberikan kontribusi nyata dalam dunia teknologi informasi, khususnya di bidang pengembangan perangkat lunak dan solusi berbasis web.', NULL, '2025-01-14 16:58:49'),
(4, 'profile/Fito-removebg-preview.png', 'Fito', 'Desta Fabiansyah', 'Batu Ampar', '231098', 'Batam', '0899765482', 'Fito Desta Fabiansah adalah mahasiswa Teknik Informatika di Politeknik Negeri Batam yang saat ini menempuh program studi Sarjana Terapan Rekayasa Perangkat Lunak. Dengan minat yang besar terhadap pengembangan teknologi digital, ia memiliki kemampuan mumpuni dalam merancang dan mengimplementasikan website responsif yang inovatif dan berorientasi pada pengalaman pengguna.\\r\\n\\r\\nLahir dan besar di Batam, tepatnya di Batu Ampar, Fito adalah pribadi yang penuh semangat dalam mempelajari teknologi terbaru, terutama di bidang pengembangan perangkat lunak. Selama masa studinya, ia telah membekali dirinya dengan keterampilan teknis seperti analisis kebutuhan, desain sistem, dan pemrograman berbasis web yang modern dan relevan dengan dunia kerja.\\r\\n\\r\\nSelain kemampuan teknis, Fito dikenal sebagai individu yang bertanggung jawab, mampu bekerja dalam tim, dan memiliki keinginan kuat untuk terus berkembang. Dengan visi untuk berkontribusi pada dunia teknologi, ia siap menghadapi tantangan baru dalam dunia profesional dan memberikan solusi teknologi yang berdampak positif.', NULL, '2025-01-14 16:59:44'),
(5, 'profile/Indria-removebg-preview.png', 'Indria', 'Bintani Aiska', 'Suka Jadi', '230998', 'Batam', '0891123211', 'Indria Bintani Aiska adalah mahasiswi aktif Politeknik Negeri Batam, jurusan Teknik Informatika, program studi Sarjana Terapan Rekayasa Perangkat Lunak. Ia memiliki keahlian dalam pengembangan website responsif, dengan fokus pada solusi yang user-friendly dan sesuai dengan kebutuhan pengguna.Berdomisili di Batam, tepatnya di kawasan Suka Jadi, Indria memiliki tekad besar untuk terus mengasah kemampuan teknisnya, seperti analisis sistem, desain antarmuka, dan pengkodean berbasis web. Ia percaya bahwa teknologi dapat menjadi alat untuk memecahkan masalah nyata dan menciptakan peluang baru, terutama dalam dunia digital.\\r\\n\\r\\nIndia dikenal sebagai pribadi yang bertanggung jawab, rajin, dan memiliki kemampuan kerja sama yang baik dalam tim. Ia juga memiliki ketertarikan besar pada pembelajaran berkelanjutan untuk mengikuti perkembangan teknologi terkini. Dengan dasar pendidikan yang kuat dan semangat yang tinggi, ia siap untuk memulai perjalanan karier di industri teknologi informasi melalui program magang yang dapat memperluas pengalamannya.', NULL, '2025-01-14 17:00:36'),
(6, 'profile/Winda-removebg-preview.png', 'Winda', 'Tri Wulan Dari', 'Batu Aji', '233451', 'Batam', '0844563321', 'Winda Tri Wulan Dari adalah mahasiswi Teknik Informatika di Politeknik Negeri Batam yang memiliki fokus dalam pengembangan perangkat lunak modern. Sebagai bagian dari program studi Sarjana Terapan Rekayasa Perangkat Lunak, ia telah mengasah keterampilannya dalam menciptakan website responsif yang efisien dan relevan dengan kebutuhan industri digital saat ini.\\r\\n\\r\\nBerada di kota Batam, ia memahami pentingnya adaptasi terhadap perkembangan teknologi dan selalu berupaya memperbarui kemampuannya, termasuk dalam desain antarmuka, analisis kebutuhan sistem, dan pemrograman berbasis web. Dengan dedikasi yang tinggi, ia berkomitmen untuk menghadirkan solusi digital yang tidak hanya berfungsi dengan baik tetapi juga memberikan pengalaman pengguna yang optimal.\\r\\n\\r\\nSelain kemampuan teknis, Winda juga menunjukkan keunggulan dalam bekerja sama dengan tim, manajemen waktu, dan penyelesaian tugas secara efektif. Dengan semangat belajar yang terus menyala, ia siap berkontribusi melalui program magang untuk mengembangkan pengalaman praktis dan memberikan nilai tambah kepada perusahaan.', NULL, '2025-01-14 17:01:21'),
(7, 'profile/Screenshot 2025-01-04 215434.png', 'Andri', 'Putra Siregar', 'Legenda Bali', '220098', 'Batam', '0875667564', 'Saya adalah mahasiswa aktif di Politeknik Negeri Batam Program Studi Teknik Informatika, dengan minat yang kuat dalam pengembangan perangkat lunak, kecerdasan buatan, dan teknologi informasi. Selama kuliah, saya telah mempelajari berbagai bahasa pemrograman seperti Java, Python, C++,PHP, serta memiliki pengalaman dalam pengembangan aplikasi web dan mobile.\\r\\n\\r\\nSaya juga aktif dalam mengikuti kegiatan organisasi, yang membantu saya meningkatkan keterampilan dalam bekerja secara tim dan menyelesaikan proyek teknologi. Selain itu, saya memiliki pengalaman dalam Membuat aplikasi web berbasis React.js dan Node.js untuk manajemen tugas tim di universitas.\\r\\n\\r\\nSaya tertarik untuk bergabung dengan program magang untuk mengaplikasikan keterampilan teknis yang telah saya pelajari serta untuk mendapatkan pengalaman langsung dalam industri teknologi. Saya berharap dapat memberikan kontribusi yang positif dan terus berkembang sebagai profesional di bidang teknologi.', NULL, '2025-01-14 17:02:01'),
(8, 'profile/Screenshot 2025-01-04 215533.png', 'Doni', 'Tata Fahreza', 'Belian', '233467', 'Batam', '0878122231', 'Nama saya Doni Tata Fahreza, seorang mahasiswa Program Studi Sarjana Terapan Rekayasa Perangkat Lunak di Politeknik Negeri Batam dengan jurusan Teknik Informatika. Saya memiliki keahlian dalam membuat website responsif yang memenuhi kebutuhan pengguna dan mengikuti prinsip desain modern.\\r\\n\\r\\nDengan latar belakang akademik yang kuat dan pemahaman mendalam tentang teknologi informasi, saya bersemangat untuk terus belajar dan mengembangkan kemampuan di dunia industri. Saat ini, saya tinggal di daerah Belian dan siap menghadapi tantangan serta peluang yang dapat memperkaya pengalaman saya dalam dunia kerja.', NULL, '2025-01-14 17:02:34'),
(9, 'profile/Screenshot 2025-01-04 215619.png', 'Muhammad', 'Hasan Firdaus', 'Batu Aji', '231166', 'Batam', '0875901954', 'Halo! Saya Muhammad Hasan Firdaus, mahasiswa Program Studi Sarjana Terapan Rekayasa Perangkat Lunak di Politeknik Negeri Batam. Dengan latar belakang di bidang Teknik Informatika, saya memiliki passion dalam menciptakan solusi digital yang inovatif, khususnya dalam pengembangan website responsif yang tidak hanya fungsional tetapi juga menarik secara visual.\\r\\n\\r\\nSaya percaya bahwa teknologi adalah kunci untuk memecahkan berbagai tantangan, dan saya selalu berusaha untuk mengembangkan keterampilan teknis saya, termasuk pemahaman tentang desain web modern dan pengoptimalan pengalaman pengguna. Berlokasi di Batu Aji, saya siap berkontribusi dan belajar di lingkungan kerja yang dinamis melalui program magang.\\r\\n\\r\\nDengan kombinasi keahlian teknis, semangat belajar, dan kreativitas, saya berkomitmen untuk memberikan nilai tambah kepada tim dan organisasi tempat saya bergabung. Mari kita bekerja sama untuk menciptakan sesuatu yang luar biasa!', NULL, '2025-01-14 17:03:03'),
(10, 'profile/PT. AOHAI.jpeg', 'PT', 'Aohai', 'Legenda Malaka', '248743', 'Batam', '0888982312', 'PT Aohai adalah perusahaan yang bergerak di bidang manufaktur perangkat keras, aplikasi, dan sistem, yang berlokasi di Legenda Malaka, Batam. Berdiri sejak tanggal 13 Januari 2019, kami telah berkomitmen untuk menghadirkan solusi inovatif dalam teknologi perangkat keras dan aplikasi yang dirancang untuk memenuhi kebutuhan pelanggan di berbagai sektor industri.\\r\\n\\r\\nDengan fokus pada pengembangan teknologi yang efisien dan berkelanjutan, PT Aohai terus memperluas portofolio produk dan layanan kami. Kami menggabungkan keahlian dalam pengembangan perangkat keras dengan kemampuan dalam menciptakan aplikasi dan sistem terintegrasi untuk memberikan nilai tambah bagi mitra bisnis kami.\\r\\n\\r\\nKami percaya bahwa inovasi adalah kunci untuk mencapai keunggulan kompetitif, dan oleh karena itu, kami selalu terbuka untuk bekerja sama dengan talenta berbakat yang ingin berkembang dan berkontribusi di dunia teknologi. Sebagai perusahaan yang berstatus terverifikasi, kami memastikan kepercayaan dan integritas dalam setiap aspek operasional kami.', NULL, '2025-01-14 17:03:49'),
(11, 'profile/PT. Batam Techno Indonesia.jpg', 'PT', 'Batam Techno Indonesia', 'Temenggung', '244371', 'Batam', '0899823317', 'PT Batam Techno Indonesia adalah perusahaan yang bergerak di bidang manufaktur mesin berat yang berbasis di Batam, Indonesia. Berdiri sejak tanggal 13 Maret 2012, perusahaan ini telah memiliki reputasi yang terpercaya dalam menyediakan solusi manufaktur berkualitas tinggi untuk berbagai kebutuhan industri.\\r\\n\\r\\nAlamat:\\r\\n\\r\\nLokasi: Temenggung, Batam\\r\\nKode Pos: 244371\\r\\nInformasi Kontak:\\r\\n\\r\\nNomor Telepon: 0899-823-3317\\r\\nEmail: ptbatamtechnoindonesia@gmail.com\\r\\nBidang Usaha:\\r\\nPT Batam Techno Indonesia fokus pada inovasi dan pengembangan mesin berat yang mendukung keberlangsungan proses produksi industri. Dengan teknologi modern dan tim ahli, perusahaan ini terus berkomitmen untuk memberikan hasil terbaik kepada mitra bisnis.\\r\\n\\r\\nSebagai perusahaan yang telah diverifikasi pada 14 Januari 2025, PT Batam Techno Indonesia membuka peluang magang bagi mahasiswa yang ingin berkembang di dunia kerja nyata, khususnya di sektor teknik dan teknologi manufaktur.', NULL, '2025-01-14 17:04:37'),
(12, 'profile/PT. Globalindo Multilogistik.jpeg', 'PT', 'Globalindo multi logistik', 'Tanjung Piayu', '248364', 'Batam', '0845667312', 'PT Globalindo Multi Logistik adalah perusahaan yang bergerak di bidang jasa logistik dengan lokasi di Tanjung Piayu, Batam. Didirikan pada tanggal 20 September 2005, perusahaan ini telah menjadi salah satu penyedia jasa logistik terpercaya di wilayah Batam dan sekitarnya.\\r\\n\\r\\nAlamat dan Informasi Kontak:\\r\\n\\r\\nAlamat: Tanjung Piayu, Batam\\r\\nKode Pos: 248364\\r\\nNomor Telepon: 0845-667-312\\r\\nEmail: ptglobalindomultilogistik@gmail.com\\r\\nBidang Usaha:\\r\\nDengan pengalaman lebih dari satu dekade, PT Globalindo Multi Logistik menyediakan solusi logistik yang efisien dan terintegrasi. Perusahaan ini mendukung berbagai kebutuhan transportasi dan distribusi barang, memastikan keandalan dan ketepatan waktu untuk kliennya.\\r\\n\\r\\nKeunggulan Perusahaan:\\r\\n\\r\\nMemiliki tim profesional yang berpengalaman.\\r\\nMenawarkan layanan logistik modern dan teknologi terkini.\\r\\nBerkomitmen untuk memberikan pelayanan terbaik kepada pelanggan.\\r\\nSebagai perusahaan yang telah diverifikasi pada 14 Januari 2025, PT Globalindo Multi Logistik membuka peluang magang bagi mahasiswa yang ingin mendapatkan pengalaman praktis di dunia logistik, transportasi, dan manajemen distribusi.', NULL, '2025-01-14 17:06:32'),
(13, 'profile/Infinite Learning.jpg', 'Infinite', 'Learning', 'Bengkong', '231098', 'Batam', '0891211650', 'Infinite Learning adalah Lembaga Pelatihan Kerja (LPK) yang berlokasi di Bengkong, Batam. Berdiri sejak 30 September 2005, Infinite Learning telah berkontribusi dalam pengembangan sumber daya manusia melalui berbagai program pelatihan, kursus, dan pembelajaran yang inovatif dan berkualitas.\\r\\n\\r\\nAlamat dan Informasi Kontak:\\r\\n\\r\\nAlamat: Bengkong, Batam\\r\\nKode Pos: 231098\\r\\nNomor Telepon: 0891-211-650\\r\\nEmail: infinitelearningbatam@gmail.com\\r\\nBidang Usaha:\\r\\nSebagai lembaga yang berfokus pada kursus dan pembelajaran, Infinite Learning menyediakan program pelatihan yang dirancang untuk membantu individu meningkatkan keterampilan mereka, baik untuk pengembangan pribadi maupun profesional.\\r\\n\\r\\nKeunggulan Perusahaan:\\r\\n\\r\\nProgram pelatihan yang relevan dengan kebutuhan industri.\\r\\nTenaga pengajar profesional dan berpengalaman.\\r\\nFasilitas belajar yang nyaman dan mendukung.\\r\\nBerkomitmen untuk memberikan pendidikan berkualitas tinggi.\\r\\nPeluang Magang:\\r\\nInfinite Learning membuka kesempatan magang bagi mahasiswa yang ingin memperluas wawasan mereka di bidang pendidikan dan pelatihan. Program magang ini dirancang untuk memberikan pengalaman praktis sekaligus membantu peserta magang mengembangkan keterampilan profesional mereka.', NULL, '2025-01-14 17:07:24'),
(14, 'profile/PT. Shimano Batam.png', 'Shimano', 'Batam', 'Tiban', '230998', 'Batam', '0845332120', 'Shimano Batam adalah perusahaan manufaktur yang bergerak di bidang produksi alat pancing dan sepeda. Didirikan pada 11 Oktober 2010, perusahaan ini berlokasi di Tiban, Batam, dengan fasilitas modern dan inovasi teknologi terkini untuk mendukung proses produksinya.\\r\\n\\r\\nAlamat dan Informasi Kontak:\\r\\n\\r\\nAlamat: Tiban, Batam\\r\\nKode Pos: 230998\\r\\nNomor Telepon: 0845-332-120\\r\\nEmail: ptshimanobatam@gmail.com\\r\\nBidang Usaha:\\r\\nSebagai salah satu pemain utama dalam industri alat pancing dan sepeda, Shimano Batam memproduksi produk berkualitas tinggi yang dirancang untuk memenuhi kebutuhan konsumen global. Perusahaan ini berfokus pada inovasi, keberlanjutan, dan efisiensi untuk menciptakan produk yang ramah lingkungan sekaligus fungsional.\\r\\n\\r\\nKeunggulan Perusahaan:\\r\\n\\r\\nPengalaman lebih dari satu dekade di bidangnya.\\r\\nBerkomitmen pada kualitas dan inovasi produk.\\r\\nMemiliki lingkungan kerja yang mendukung pengembangan karyawan.\\r\\nPeluang Magang:\\r\\nShimano Batam membuka peluang magang bagi mahasiswa yang berminat untuk belajar di industri manufaktur, terutama dalam desain, produksi, dan manajemen alat pancing dan sepeda. Program magang ini bertujuan memberikan pengalaman kerja nyata sekaligus meningkatkan kompetensi peserta.', NULL, '2025-01-14 17:07:57'),
(15, 'profile/PT. Ciba Alcon Vision Batam.png', 'Ciba', 'Alcon Batam', 'Nongsa', '233451', 'Batam', '0877659801', 'Ciba Alcon Batam adalah perusahaan yang berfokus pada bidang pendidikan, didirikan pada 5 Februari 2011. Berlokasi di Nongsa, Batam, perusahaan ini bertujuan untuk memberikan kontribusi signifikan dalam pengembangan pendidikan melalui inovasi dan layanan berkualitas tinggi.\\r\\n\\r\\nAlamat dan Informasi Kontak:\\r\\n\\r\\nAlamat: Nongsa, Batam\\r\\nKode Pos: 233451\\r\\nNomor Telepon: 0877-659-801\\r\\nEmail: ptcibaalconvision@gmail.com\\r\\nBidang Usaha:\\r\\nSebagai entitas yang bergerak di bidang pendidikan, Ciba Alcon Batam menyediakan berbagai layanan pendidikan dan pelatihan. Perusahaan ini berkomitmen untuk meningkatkan kualitas sumber daya manusia melalui program-program pelatihan dan pengembangan keterampilan yang komprehensif.\\r\\n\\r\\nKeunggulan Perusahaan:\\r\\n\\r\\nFokus pada peningkatan kualitas pendidikan.\\r\\nMenggunakan pendekatan inovatif dalam pelatihan dan pembelajaran.\\r\\nMemiliki tim ahli dengan pengalaman luas di bidang pendidikan.\\r\\nPeluang Magang:\\r\\nCiba Alcon Batam menawarkan program magang bagi mahasiswa yang ingin mendapatkan pengalaman di sektor pendidikan. Program ini mencakup berbagai bidang seperti pengajaran, manajemen pendidikan, dan pengembangan kurikulum, memberikan kesempatan untuk belajar langsung dari para profesional di industri.', NULL, '2025-01-14 17:08:24'),
(16, 'profile/PT. Telkom Indonesia Batam.png', 'Telkom', 'Batam Indonesia', 'Nongsa', '220098', 'Batam', '0866540912', 'Telkom Batam Indonesia adalah perusahaan terkemuka di bidang manufaktur jaringan dan teknologi, yang didirikan pada 18 April 2017. Berbasis di Nongsa, Batam, perusahaan ini berfokus pada pengembangan solusi teknologi yang inovatif untuk mendukung infrastruktur digital di Indonesia dan kawasan sekitarnya.\\r\\n\\r\\nAlamat dan Informasi Kontak:\\r\\n\\r\\nAlamat: Nongsa, Batam\\r\\nKode Pos: 220098\\r\\nNomor Telepon: 0866-540-912\\r\\nEmail: pttelkombatamindonesia@gmail.com\\r\\nBidang Usaha:\\r\\nSebagai pemain utama di industri teknologi, Telkom Batam Indonesia memiliki spesialisasi dalam pengembangan dan produksi infrastruktur jaringan, perangkat keras teknologi, serta solusi inovatif di sektor telekomunikasi. Perusahaan ini bertujuan untuk memberikan layanan berkualitas tinggi yang mendukung era transformasi digital.\\r\\n\\r\\nKeunggulan Perusahaan:\\r\\n\\r\\nAhli dalam manufaktur dan pengembangan teknologi.\\r\\nMengedepankan inovasi dan efisiensi dalam setiap produk dan layanan.\\r\\nMemiliki tim yang terdiri dari profesional berpengalaman di bidang telekomunikasi dan teknologi.\\r\\nPeluang Magang:\\r\\nTelkom Batam Indonesia menawarkan peluang magang bagi mahasiswa yang ingin mendapatkan pengalaman langsung di bidang teknologi dan telekomunikasi. Program magang ini mencakup berbagai bidang seperti pengembangan perangkat keras, manajemen jaringan, dan inovasi teknologi, memberikan kesempatan untuk belajar dan bekerja dalam lingkungan yang dinamis dan inovatif.', NULL, '2025-01-14 17:09:10'),
(17, 'profile/PT. Nok Freudenberg.jpg', 'PT', 'NOK FREUDENBERG', 'Tiban', '233467', 'Batam', '0876543908', 'PT NOK Freudenberg adalah perusahaan yang bergerak di bidang keuangan, didirikan pada 18 April 2007 dan berbasis di Tiban, Batam. Sebagai salah satu perusahaan terkemuka di sektor ini, PT NOK Freudenberg menyediakan layanan keuangan yang inovatif untuk mendukung kebutuhan individu dan bisnis di berbagai industri.\\r\\n\\r\\nAlamat dan Informasi Kontak:\\r\\n\\r\\nAlamat: Tiban, Batam\\r\\nKode Pos: 233467\\r\\nNomor Telepon: 0876-543-908\\r\\nEmail: ptnokfreudenberg@gmail.com\\r\\nBidang Usaha:\\r\\nSpesialisasi perusahaan mencakup manajemen keuangan, layanan perbankan, investasi, serta solusi keuangan digital. PT NOK Freudenberg berkomitmen untuk memberikan layanan yang andal dan berbasis teknologi demi mendukung pertumbuhan ekonomi dan memenuhi kebutuhan pelanggan.\\r\\n\\r\\nKeunggulan Perusahaan:\\r\\n\\r\\nBerpengalaman lebih dari satu dekade di bidang keuangan.\\r\\nMengutamakan transparansi dan kepercayaan dalam setiap layanan.\\r\\nMenggunakan teknologi modern untuk solusi keuangan yang efisien.\\r\\nPeluang Magang:\\r\\nPT NOK Freudenberg membuka kesempatan magang bagi mahasiswa dan lulusan baru yang ingin mendapatkan pengalaman langsung di industri keuangan. Program magang ini menawarkan pembelajaran di berbagai bidang, seperti analisis data keuangan, pengelolaan aset, dan teknologi keuangan, serta menyediakan lingkungan kerja yang profesional dan mendukung.', NULL, '2025-01-14 17:10:22'),
(18, 'profile/PT. Amber Karya.jpg', 'PT', 'Amber Karya', 'Muka Kuning', '231166', 'Batam', '0876498012', 'PT Amber Karya merupakan perusahaan yang bergerak di bidang manufaktur, transportasi, dan logistik. Didirikan pada 26 Januari 2013, perusahaan ini berlokasi di Muka Kuning, Batam, dan memiliki reputasi sebagai salah satu perusahaan yang unggul dalam memberikan solusi transportasi dan logistik yang efisien.\\r\\n\\r\\nAlamat dan Informasi Kontak:\\r\\n\\r\\nAlamat: Muka Kuning, Batam\\r\\nKode Pos: 231166\\r\\nNomor Telepon: 0876-498-012\\r\\nEmail: ptamberkarya@gmail.com\\r\\nBidang Usaha:\\r\\nSpesialisasi perusahaan mencakup pengelolaan rantai pasok, pengiriman barang, dan manufaktur komponen berkualitas tinggi. PT Amber Karya memanfaatkan teknologi terkini untuk memastikan efisiensi dalam setiap proses operasional, mendukung kebutuhan industri lokal maupun internasional.\\r\\n\\r\\nKeunggulan Perusahaan:\\r\\n\\r\\nBerpengalaman lebih dari satu dekade di sektor manufaktur dan logistik.\\r\\nTim profesional yang berdedikasi untuk memberikan layanan terbaik.\\r\\nInfrastruktur modern yang mendukung operasional skala besar.\\r\\nPeluang Magang:\\r\\nPT Amber Karya membuka program magang bagi mahasiswa dan lulusan baru yang tertarik untuk mendalami dunia manufaktur, transportasi, dan logistik. Peserta magang akan mendapatkan kesempatan untuk belajar secara langsung tentang pengelolaan logistik, teknik manufaktur, dan manajemen transportasi dalam lingkungan kerja yang inovatif dan kolaboratif.', NULL, '2025-01-14 17:11:27'),
(19, 'default/profile_company.jpg', 'Admin', 'RAIN Polibatam', 'Batam Centre', '289743', 'Batam', '0822360917', 'Admin RAIN Polibatam adalah pengelola utama aplikasi RAIN (Recruitment and Internship Network) yang bertanggung jawab dalam mengelola data pengguna, perusahaan, dan lowongan magang. Sebagai representasi dari Politeknik Negeri Batam, admin memiliki tugas memastikan operasional aplikasi berjalan lancar, menjaga keamanan data, serta memberikan dukungan teknis kepada pengguna. Dengan hak akses penuh terhadap sistem, admin berperan penting dalam menjaga kualitas informasi dan keberhasilan program magang melalui aplikasi ini.', NULL, '2025-01-14 17:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id_proposal` bigint UNSIGNED NOT NULL,
  `id_vacancy` bigint UNSIGNED NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applied_date` date NOT NULL,
  `interview_date` datetime DEFAULT NULL,
  `final_status` enum('approved','rejected','waiting') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waiting',
  `proposal_status` enum('approved','rejected','waiting') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waiting',
  `interview_status` enum('approved','rejected','waiting') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waiting',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_profile` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_major` bigint UNSIGNED DEFAULT NULL,
  `id_study_program` bigint UNSIGNED DEFAULT NULL,
  `institute` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Politeknik Negeri Batam',
  `skill` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_datetime` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`nim`, `id_profile`, `id_user`, `id_major`, `id_study_program`, `institute`, `skill`, `approved_datetime`, `created_at`, `updated_at`) VALUES
('4342401010', 7, 7, 3, 6, 'Politeknik Negeri Batam', 'Membaut website responsive', NULL, NULL, NULL),
('4342401034', 1, 1, 3, 6, 'Politeknik Negeri Batam', 'Membaut website responsive', NULL, NULL, NULL),
('4342401042', 3, 3, 3, 6, 'Politeknik Negeri Batam', 'Membaut website responsive', NULL, NULL, NULL),
('4342401043', 8, 8, 3, 6, 'Politeknik Negeri Batam', 'Membaut website responsive', NULL, NULL, NULL),
('4342401047', 5, 5, 3, 6, 'Politeknik Negeri Batam', 'Membaut website responsive', NULL, NULL, NULL),
('4342401050', 4, 4, 3, 6, 'Politeknik Negeri Batam', 'Membaut website responsive', NULL, NULL, NULL),
('4342401056', 6, 6, 3, 6, 'Politeknik Negeri Batam', 'Membaut website responsive', NULL, NULL, NULL),
('4342401060', 2, 2, 3, 6, 'Politeknik Negeri Batam', 'Membaut website responsive', NULL, NULL, NULL),
('4342401066', 9, 9, 3, 6, 'Politeknik Negeri Batam', 'Membaut website responsive', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `study_program`
--

CREATE TABLE `study_program` (
  `id` bigint UNSIGNED NOT NULL,
  `id_major` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `study_program`
--

INSERT INTO `study_program` (`id`, `id_major`, `name`, `created_at`, `updated_at`) VALUES
(1, 3, 'Diploma 3 Teknik Informatika', NULL, NULL),
(2, 3, 'Diploma 3 Teknologi Geomatika', NULL, NULL),
(3, 3, 'Sarjana Terapan Animasi', NULL, NULL),
(4, 3, 'Sarjana Terapan Teknologi Rekayasa Multimedia', NULL, NULL),
(5, 3, 'Sarjana Terapan Rekayasa Keamanan Siber', NULL, NULL),
(6, 3, 'Sarjana Terapan Rekayasa Perangkat Lunak', NULL, NULL),
(7, 3, 'Magister Terapan (S2) Rekayasa / Teknik Komputer', NULL, NULL),
(8, 3, 'Sarjana Terapan Teknologi Permainan', NULL, NULL),
(9, 1, 'Diploma 3 Akuntansi', NULL, NULL),
(10, 1, 'Sarjana Terapan Akuntansi Manajerial', NULL, NULL),
(11, 1, 'Sarjana Terapan Administrasi Bisnis Terapan', NULL, NULL),
(12, 1, 'Sarjana Terapan Logistik Perdagangan Internasional', NULL, NULL),
(13, 1, 'Sarjana Terapan Administrasi Bisnis Terapan (International Class)', NULL, NULL),
(14, 1, 'Program Studi D2 Jalur Cepat Distribusi Barang', NULL, NULL),
(15, 2, 'Diploma 3 Teknik Elektronika Manufaktur', NULL, NULL),
(16, 2, 'Sarjana Terapan Teknologi Rekayasa Elektronika', NULL, NULL),
(17, 2, 'Diploma 3 Teknik Instrumentasi', NULL, NULL),
(18, 2, 'Sarjana Terapan Teknik Mekatronika', NULL, NULL),
(19, 2, 'Sarjana Terapan Teknologi Rekayasa Pembangkit Energi', NULL, NULL),
(20, 2, 'Sarjana Terapan Teknologi Rekayasa Robotika', NULL, NULL),
(21, 4, 'Diploma 3 Teknik Mesin', NULL, NULL),
(22, 4, 'Diploma 3 Teknik Perawatan Pesawat Udara', NULL, NULL),
(23, 4, 'Sarjana Terapan Teknologi Rekayasa Konstruksi Perkapalan', NULL, NULL),
(24, 4, 'Sarjana Terapan Teknologi Rekayasa Pengelasan dan Fabrikasi', NULL, NULL),
(25, 4, 'Program Profesi Insinyur (PSPPI)', NULL, NULL),
(26, 4, 'Sarjana Terapan Teknologi Rekayasa Metalurgi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` bigint UNSIGNED NOT NULL,
  `email_verified_at` date DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'wasyn@outlook.com', 1, '2025-01-14', '$2y$12$MWlmj6sXCabRhwHXpKBjCOckjtroEHqCeZbfuFQEQdpGfdsvUcOG.', 'QSygK7H3rnzmKMjO96kRqOo2Rv7YXRHI9ViNLJn18MMxBZH5GNGaBO6dZFiw', NULL, NULL),
(2, 'eric@outlook.com', 1, '2025-01-14', '$2y$12$DFqMp37um1dG3V2K8WDEYeZ4znhuCFUeeXiKvN5TcgGL2lHJimoZS', 'C25Um20C70KDLgmdUdHnmOdVfMDWso9RpKQd4pweDjjUdgjRQ81d2HFaD4Bs', NULL, NULL),
(3, 'aidil@outlook.com', 1, '2025-01-14', '$2y$12$ptMNjeVx8KNxkQZQIt0BHOFbbCG5nwSeiFP1P7sAR0aH25qlZqVS.', 'pe7RzWh8fDKG7QcBet7LsTdoDVMtrvVkqSrs5v6uRdcMSbs64rYFGkWeqfHK', NULL, NULL),
(4, 'fito@gmail.com', 1, '2025-01-14', '$2y$12$St6./dTMNAjNxZsssv4Xwu9fUrTIGrRQgNOqjkCfjVoHkpsTxm7y2', 'WqZnXOx2wxrVcmdDTez2XPNxv38jNZ1BfhZMI32AB6u2MGNd7gEsQRtmRNmJ', NULL, NULL),
(5, 'indria@gmail.com', 1, '2025-01-14', '$2y$12$D/Gb2Nql67lul9pyngB0We84dGt2cVpR48S54s72uwpcMRJLCY98C', 'LYvoLWaGcaBSTq8d8HbkHVNtpqaW3JTzei6PwaCF9INjxOTdlJOdUUwx89dS', NULL, NULL),
(6, 'winda@gmail.com', 1, '2025-01-14', '$2y$12$WPz0xTxgulTbSvwTRB8KkemWck8vOT0grB.OZLFhJETyuJNA.DZNG', 'FEC3AFnI6NUEpCyX4eXKZS2IgaUthAlzDNnJMfTu1jHEMd8Pm0etSdMxFWil', NULL, NULL),
(7, 'andri@gmail.com', 1, '2025-01-14', '$2y$12$aNIkl/1OSiqTmn6GcgVIweD0cy7LcRKh5HEb0tYMy6QtRqjru325y', 'eFcNlqNGFJPfTOhwC5trFOvj6eZFPVDXk2op3K6v0IRZ9IECdxxAQtJUXrWJ', NULL, NULL),
(8, 'doni@yahoo.com', 1, '2025-01-14', '$2y$12$cnkYPw61FpX2b6zKEHJ.Xe4bboQAYlFlr7cn5T8kqlzk8/HJx3TYK', '8ehkanKiAJnS4SZxAU5yM1zAKXfieIOkWIsFR5hpqejqzsQ8423YsmW3e2m8', NULL, NULL),
(9, 'hasan@yahoo.com', 1, '2025-01-14', '$2y$12$XPGFKuF0f2P7NLLjI5Ag7edqejSTtQpnfkGWBvL7Y4GhAp.35345C', '4Tk06FYqXVrhJXq47fnGvgAdOFig6EgOPTrIFqjeL8FsPGLuBvYXSGUORp1l', NULL, NULL),
(10, 'ptaohai@yahoo.com', 2, '2025-01-14', '$2y$12$VSH1Pa0KqWFkCUJShEykeuK837scWPSWKV8ur9mLPQOUCZcK3SOcK', 'w4IPfbNtMKwvySRs424wyO07zLKOXNEyYT68pmp44Nha31G3TtXnb59QOzzB', NULL, NULL),
(11, 'ptbatamtechnoindonesia@yahoo.com', 2, '2025-01-14', '$2y$12$p6ln0Fv3wCtcJP8rEwGY/OTFATCKAvcB/4lyLnsZET8Ahpz6s5hK.', 'WAM3UTlPcOPBG4R6YWGgFQ5yAz1cQoyKQHkt69c89D3mvHX8Nl6XthNOG6Ck', NULL, NULL),
(12, 'ptglobalindomultilogistik@yahoo.com', 2, '2025-01-14', '$2y$12$RfwJlfRyJKyiXq38DQ73D.EgaHYYs1l3CuG.xUol5rRd0eRCDKFfm', 'sjTZTL7aTMk0u8ahHOC1BxmEjiSyVJ1uO8NsaQvBVRH9Ho7pAxuJV2gKQsEK', NULL, NULL),
(13, 'infinitelearningbatam@gmail.com', 2, '2025-01-14', '$2y$12$fcltmWsR4M7.fVVt4sXz6uO526CuWrEguMxlkYtNnGFaV/h6ZloJe', 'lVmTbP45th85AcdhjE1HHN22aviH5tsSKeiZBeCmHNA0qiFR80NZ4ydvIV3w', NULL, NULL),
(14, 'ptshimanobatam@gmail.com', 2, '2025-01-14', '$2y$12$41ey2tbHUjwQAgMiJO8Vh.SEINhN.OncdDC5wdbf9jPDSu/nWPIfq', '1VJPTJtCKSeTTUNnqFYwblKuWGXLp1YCbDamc0fZPR3xPLhXl3f9eCOUiDsX', NULL, NULL),
(15, 'ptcibaalconvision@gmail.com', 2, '2025-01-14', '$2y$12$PuItGJVcsT7dfcnoETYhN.ZkjTHoIWUaFYONJ37Hj6PEwsMaFWs5i', 'NxxelmUycJ9NQ18TsjZVB1OkYwhJrZRG0cY5aWmi49bRNEZ877pggibUZmmL', NULL, NULL),
(16, 'pttelkombatamindonesia@outlook.com', 2, '2025-01-14', '$2y$12$mbvJqWH5vmARvf2Bxhh5r..boOab69WaMfPmc6lOkEOsVWKoaral2', 'tVBb9MB58eRH4aumUy2QSg7WnbJTnzoJCPH8a9PqsV5tCTXFR6hdy8D2Lixl', NULL, NULL),
(17, 'ptnokfreudenberg@outlook.com', 2, '2025-01-14', '$2y$12$ZbqG2U1EDaXIY8xmOGNit.G.x.weaq5UkesSf/1AEw6NEsw22K0oC', 'yShiZNcTGcDj5HnSKE71aIXlg8InrpodLKTr9epg691nLIdOfVC6YT4ncGz0', NULL, NULL),
(18, 'ptamberkarya@gmail.com', 2, '2025-01-14', '$2y$12$RBWd0QPSSBQKr7x8y7fP8OB1guOKJbwEXmaV/5ImkrN3tMJqntiUG', 'hafKbiAwJSshSBC4uo7YIYAoLN5pe6Wy2na476sJjJzegofY8aN6C5e5XNta', NULL, NULL),
(19, 'rainpolibatam@gmail.com', 3, '2025-01-14', '$2y$12$ltEPLHmg4lWbF97lk4GRMe4INYWdk/W/eL0V04xH54KmzuRLRWcnG', 'DKaAMW6osEqxPCGmMBPzRl3buWA9HNjx5NjP5RG2MCzcVFi5ISinH785PjHE', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Mahasiswa', '2025-01-14 16:43:00', '2025-01-14 16:43:00'),
(2, 'Perusahaan', '2025-01-14 16:43:00', '2025-01-14 16:43:00'),
(3, 'Admin', '2025-01-14 16:43:00', '2025-01-14 16:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `id_vacancy` bigint UNSIGNED NOT NULL,
  `nib` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_major` bigint UNSIGNED NOT NULL,
  `applied` int NOT NULL,
  `title` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_type` enum('part time','full time') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'full time',
  `type` enum('online','offline','hybrid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'offline',
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `quota` int NOT NULL,
  `date_created` date NOT NULL,
  `date_ended` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`id_vacancy`, `nib`, `id_major`, `applied`, `title`, `salary`, `time_type`, `type`, `duration`, `location`, `description`, `quota`, `date_created`, `date_ended`, `created_at`, `updated_at`) VALUES
(1, '1647354321', 3, 0, 'Pengembangan Aplikasi E-Commerce', '2000000', 'full time', 'online', '12', 'Legenda Malaka', 'PT Aohai membuka kesempatan bagi Anda yang berbakat dan memiliki semangat tinggi untuk bergabung sebagai Pengembang Aplikasi E-Commerce.\r\n\r\nKualifikasi:\r\n-Mahasiswa atau lulusan dari jurusan Teknik Informatika atau bidang terkait.\r\n-Memiliki pemahaman tentang pengembangan aplikasi berbasis web.\r\n-Pengalaman atau kemampuan dalam teknologi seperti HTML, CSS, JavaScript, dan \r\n   framework seperti React, Angular, atau Vue.js (nilai tambah).\r\n-Mampu bekerja dalam tim dan memiliki komunikasi yang baik.\r\n-Kreatif, inovatif, dan mampu berpikir solutif.\r\n\r\nTanggung Jawab:\r\n-Mengembangkan dan mengoptimalkan aplikasi e-commerce sesuai kebutuhan \r\n   pengguna.\r\n-Memastikan aplikasi responsif, aman, dan user-friendly.\r\n-Berkolaborasi dengan tim desain dan pengembangan untuk menghasilkan produk \r\n   yang berkualitas.\r\n-Mengidentifikasi dan memperbaiki bug atau isu yang muncul dalam aplikasi.\r\n\r\nInformasi Tambahan:\r\nGaji: Rp2.000.000/bulan\r\nDurasi: 12 bulan\r\nTipe Waktu: Full-time\r\nJenis Kerja: Online\r\nLokasi: Legenda Malaka\r\nQuota: 20 orang\r\nPeriode Pendaftaran: 14 Januari 2025 – 20 Januari 2025\r\n\r\nJadilah bagian dari tim yang berkomitmen menciptakan solusi e-commerce modern! Ayo daftarkan diri Anda dan tunjukkan potensi terbaik Anda.', 20, '2025-01-14', '2025-01-20', '2025-01-14 08:32:27', '2025-01-14 09:17:11'),
(2, '8756431231', 3, 0, 'Sistem Rekomendasi Berbasis Machine Learning', '3000000', 'part time', 'online', '3', 'Temenggung', 'Lowongan Pekerjaan: Sistem Rekomendasi Berbasis Machine Learning\r\nJurusan: Teknik Informatika\r\nLokasi: Temenggung\r\nGaji: Rp 3.000.000 / Bulan\r\nDurasi: 3 bulan\r\nJenis Kerja: Online\r\nTipe Waktu: Paruh Waktu (Part-time)\r\nKuota: 20 orang\r\nPeriode Pendaftaran: 14 Januari 2025 - 22 Januari 2025\r\n\r\nDeskripsi Pekerjaan:\r\nKami mencari individu berbakat untuk bergabung dalam proyek pengembangan sistem rekomendasi berbasis Machine Learning. Anda akan berkontribusi dalam penelitian, pengembangan algoritma, dan implementasi teknologi canggih dalam pengolahan data dan sistem rekomendasi.\r\n\r\nKualifikasi:\r\n\r\n-Mahasiswa atau lulusan dari jurusan Teknik Informatika.\r\n-Memiliki dasar pengetahuan tentang Machine Learning dan pengembangan sistem.\r\n-Mampu bekerja secara online dan berdedikasi sesuai dengan jadwal yang ditentukan.\r\n-Mampu bekerja dalam tim dengan komunikasi yang efektif.\r\n\r\nKeuntungan:\r\n\r\n-Pengalaman berharga dalam mengembangkan proyek nyata.\r\n-Peluang memperluas jaringan profesional.\r\n-Mendapatkan gaji yang kompetitif.\r\n\r\nJika Anda berminat, segera ajukan lamaran sebelum periode pendaftaran berakhir!', 20, '2025-01-14', '2025-01-22', '2025-01-14 08:40:11', '2025-01-14 09:15:05'),
(3, '9845563123', 3, 0, 'Optimasi Pencarian Database NoSQL', '5000000', 'part time', 'online', '3', 'Tanjung Piayu', 'Lowongan Magang: Optimasi Pencarian Database NoSQL\r\nJurusan: Teknik Informatika\r\nLokasi: Tanjung Piayu\r\nGaji: Rp 5.000.000 / Bulan\r\nDurasi: 3 bulan\r\nJenis Kerja: Online\r\nTipe Waktu: Paruh Waktu (Part-time)\r\nKuota: 20 orang\r\nPeriode Pendaftaran: 14 Januari 2025 - 23 Januari 2025\r\n\r\nDeskripsi Pekerjaan:\r\nKami membuka kesempatan magang bagi mahasiswa atau lulusan jurusan Teknik Informatika untuk bergabung dalam proyek Optimasi Pencarian Database NoSQL. Dalam proyek ini, Anda akan belajar dan berkontribusi pada analisis performa database NoSQL, merancang solusi optimasi pencarian data, dan mengimplementasikan teknik indexing serta query tuning.\r\n\r\nTanggung Jawab:\r\n\r\n-Menganalisis performa query pada database NoSQL.\r\n-Merancang strategi optimasi pencarian data.\r\n-Berkolaborasi dengan tim untuk menguji dan meningkatkan efisiensi database.\r\n-Membuat dokumentasi terkait proses dan hasil optimasi.\r\n\r\nKualifikasi:\r\n\r\n-Mahasiswa atau lulusan Teknik Informatika.\r\n-Memiliki pemahaman dasar tentang database NoSQL (seperti MongoDB, Cassandra, \r\n   atau Redis).\r\n-Menguasai konsep indexing dan pengelolaan database.\r\n-Mampu bekerja secara online dan berkolaborasi dalam tim.\r\n-Memiliki motivasi tinggi untuk belajar dan menyelesaikan tantangan teknis.\r\n\r\nKeuntungan:\r\n\r\n-Mendapatkan pengalaman langsung dalam optimasi sistem database.\r\n-Gaji kompetitif selama program magang.\r\n-Kesempatan untuk bekerja pada proyek nyata yang menantang.\r\n-Pengembangan keterampilan profesional di bidang teknologi database.\r\n\r\nJika Anda tertarik untuk bergabung dalam proyek ini, segera ajukan lamaran sebelum pendaftaran ditutup!', 20, '2025-01-14', '2025-01-23', '2025-01-14 08:44:51', '2025-01-14 08:44:51'),
(4, '9845563123', 3, 0, 'Aplikasi Manajemen Proyek Kolaboratif', '2500000', 'part time', 'online', '3', 'Tanjung Piayu', 'Lowongan Magang: Aplikasi Manajemen Proyek Kolaboratif\r\nJurusan: Teknik Informatika\r\nLokasi: Tanjung Piayu\r\nGaji: Rp 2.500.000 / Bulan\r\nDurasi: 3 bulan\r\nJenis Kerja: Online\r\nTipe Waktu: Paruh Waktu (Part-time)\r\nKuota: 10 orang\r\nPeriode Pendaftaran: 14 Januari 2025 - 22 Januari 2025\r\n\r\nDeskripsi Pekerjaan:\r\nKami mengundang individu berbakat untuk mengikuti program magang pada proyek Aplikasi Manajemen Proyek Kolaboratif. Dalam proyek ini, Anda akan terlibat dalam pengembangan aplikasi berbasis web yang mendukung kolaborasi tim, pengelolaan tugas, dan pelaporan proyek secara real-time.\r\n\r\nTanggung Jawab:\r\n\r\n-Merancang dan mengembangkan fitur aplikasi untuk mendukung manajemen proyek.\r\n-Mengimplementasikan sistem kolaborasi berbasis pengguna secara online.\r\n-Mengoptimalkan antarmuka pengguna untuk pengalaman terbaik.\r\n-Menguji dan memperbaiki aplikasi untuk memastikan performa optimal.\r\n\r\nKualifikasi:\r\n\r\n-Mahasiswa atau lulusan Teknik Informatika.\r\n-Memiliki pemahaman dasar tentang pengembangan aplikasi web (frontend dan \r\n   backend).\r\n-Berpengalaman dengan framework modern seperti React, Angular, atau Laravel (nilai \r\n   tambah).\r\n-Mampu bekerja secara online dengan komunikasi yang baik.\r\n-Mampu beradaptasi dengan tugas dan tantangan baru.\r\n\r\nKeuntungan:\r\n\r\n-Pengalaman langsung dalam pengembangan aplikasi berbasis proyek nyata.\r\n-Mendapatkan gaji selama program magang berlangsung.\r\n-Kesempatan untuk memperluas pengetahuan di bidang pengembangan perangkat \r\n   lunak kolaboratif.\r\n-Menambah portofolio dengan hasil kerja yang nyata.\r\n\r\nJangan lewatkan kesempatan untuk bergabung dengan tim kami! Segera ajukan lamaran sebelum batas waktu pendaftaran berakhir.', 10, '2025-01-14', '2025-01-22', '2025-01-14 08:47:57', '2025-01-14 08:47:57'),
(5, '1983214321', 3, 0, 'Keamanan Jaringan dengan Enkripsi', '3000000', 'part time', 'hybrid', '5', 'Bengkong', 'Deskripsi Pekerjaan:\r\nKami mencari peserta magang yang bersemangat untuk bergabung dalam proyek Keamanan Jaringan dengan Enkripsi. Proyek ini akan fokus pada penerapan teknologi enkripsi untuk melindungi data yang ditransmisikan melalui jaringan, sekaligus memastikan keamanan dan integritas informasi.\r\n\r\nTanggung Jawab:\r\n\r\n-Menganalisis risiko keamanan pada jaringan dan data yang ditransmisikan.\r\n-Mengembangkan dan mengimplementasikan algoritma enkripsi untuk perlindungan \r\n   data.\r\n-Mengintegrasikan teknologi enkripsi ke dalam sistem jaringan.\r\n-Menguji dan memastikan keamanan data dalam berbagai skenario serangan.\r\n\r\nKualifikasi:\r\n\r\n-Mahasiswa atau lulusan Teknik Informatika.\r\n-Memiliki pemahaman dasar tentang keamanan jaringan dan algoritma enkripsi (AES, \r\n   RSA, dsb.).\r\n-Berpengalaman menggunakan tools keamanan jaringan (Wireshark, OpenSSL, atau \r\n   sejenisnya) menjadi nilai tambah.\r\n-Mampu bekerja secara online dan berdedikasi dalam tim.\r\n-Memiliki keinginan untuk belajar lebih dalam tentang teknologi keamanan.\r\n\r\nKeuntungan:\r\n\r\n-Pengalaman nyata dalam pengembangan sistem keamanan jaringan.\r\n-Gaji kompetitif selama program magang berlangsung.\r\n-Peluang memperluas pengetahuan dan keterampilan di bidang keamanan siber.\r\n-Menambah nilai portofolio melalui proyek yang relevan dengan industri.\r\n\r\nJika Anda tertarik untuk mengasah keterampilan dan berkontribusi pada pengembangan teknologi keamanan, segera ajukan lamaran sebelum pendaftaran ditutup!', 15, '2025-01-14', '2025-01-23', '2025-01-14 08:51:03', '2025-01-14 08:51:03'),
(6, '1983214321', 3, 0, 'Analisis Sentimen Media Sosial', '1500000', 'part time', 'hybrid', '1', 'Bengkong', 'Deskripsi Pekerjaan:\r\nKami membuka kesempatan magang untuk mahasiswa atau lulusan jurusan Teknik Informatika yang ingin mengembangkan keterampilan di bidang Analisis Sentimen Media Sosial. Proyek ini akan fokus pada pengumpulan, analisis, dan interpretasi data dari berbagai platform media sosial untuk memahami pola sentimen publik.\r\n\r\nTanggung Jawab:\r\n\r\n-Mengumpulkan data dari berbagai platform media sosial menggunakan API atau \r\n  tools web scraping.\r\n-Menganalisis data untuk mengidentifikasi pola sentimen (positif, negatif, netral).\r\n-Menggunakan teknik Natural Language Processing (NLP) untuk analisis teks.\r\n-Membuat visualisasi data dan laporan analisis untuk mendukung pengambilan \r\n   keputusan.\r\n\r\nKualifikasi:\r\n\r\n-Mahasiswa atau lulusan Teknik Informatika.\r\n-Memiliki pengetahuan dasar tentang pengolahan data dan analisis teks.\r\n-Familiar dengan tools dan bahasa pemrograman seperti Python, R, atau SQL.\r\n-Berpengalaman menggunakan pustaka NLP seperti NLTK, spaCy, atau Transformers \r\n   (nilai tambah).\r\n-Mampu bekerja secara online dan memiliki komunikasi yang baik.\r\n\r\nKeuntungan:\r\n\r\n-Pengalaman langsung dalam menganalisis data media sosial.\r\n-Gaji kompetitif selama program magang.\r\n-Kesempatan untuk mempelajari teknik dan alat terbaru di bidang analitik data.\r\n-Menambah portofolio profesional dengan proyek nyata yang relevan dengan tren \r\n   industri.\r\n\r\nJangan lewatkan kesempatan untuk bergabung dalam proyek menarik ini! Segera ajukan lamaran sebelum periode pendaftaran berakhir.', 10, '2025-01-14', '2025-01-31', '2025-01-14 08:53:13', '2025-01-14 08:53:13'),
(7, '7765902312', 3, 0, 'Aplikasi Chatbot untuk Layanan Pelanggan', '5000000', 'full time', 'online', '3', 'Tiban', 'Deskripsi Pekerjaan:\r\nKami membuka kesempatan magang untuk mahasiswa atau lulusan Teknik Informatika yang ingin terlibat dalam pengembangan Aplikasi Chatbot untuk Layanan Pelanggan. Proyek ini bertujuan untuk mengembangkan chatbot berbasis kecerdasan buatan yang dapat membantu meningkatkan pengalaman pelanggan dengan memberikan respons cepat dan akurat.\r\n\r\nTanggung Jawab:\r\n\r\n-Merancang dan mengembangkan chatbot untuk layanan pelanggan.\r\n-Mengintegrasikan chatbot dengan platform komunikasi seperti WhatsApp, Telegram, \r\n   atau situs web.\r\n-Melatih chatbot menggunakan teknik Natural Language Processing (NLP) agar dapat \r\n   memahami dan merespons pertanyaan pelanggan secara otomatis.\r\n-Menguji dan meningkatkan performa chatbot berdasarkan masukan pengguna.\r\n\r\nKualifikasi:\r\n\r\n-Mahasiswa atau lulusan Teknik Informatika.\r\n-Memiliki pemahaman tentang pengembangan chatbot dan kecerdasan buatan.\r\n-Berpengalaman menggunakan framework chatbot seperti Dialogflow, Rasa, atau \r\n   Microsoft Bot Framework (nilai tambah).\r\n-Menguasai bahasa pemrograman seperti Python atau JavaScript.\r\n-Mampu bekerja secara online dan berkolaborasi dalam tim.\r\n\r\nKeuntungan:\r\n\r\n-Pengalaman langsung dalam pengembangan aplikasi berbasis AI.\r\n-Gaji kompetitif selama program magang berlangsung.\r\n-Kesempatan belajar dan menggunakan teknologi terkini di bidang AI dan NLP.\r\n-Menambah nilai portofolio dengan proyek berbasis teknologi inovatif.\r\n\r\nJika Anda memiliki semangat untuk belajar dan berkontribusi dalam menciptakan solusi layanan pelanggan berbasis teknologi, segera daftarkan diri Anda sebelum pendaftaran ditutup!', 12, '2025-01-14', '2025-01-14', '2025-01-14 08:55:58', '2025-01-14 08:55:58'),
(8, '6648921221', 3, 0, 'Sistem Informasi Akademik Berbasis Web', '6000000', 'part time', 'online', '4', 'Nongsa', 'Deskripsi Pekerjaan:\r\nKami membuka kesempatan magang untuk mahasiswa atau lulusan Teknik Informatika yang ingin berkontribusi dalam pengembangan Sistem Informasi Akademik Berbasis Web. Proyek ini bertujuan untuk menciptakan aplikasi web yang mempermudah pengelolaan data akademik, termasuk jadwal, nilai, dan administrasi mahasiswa.\r\n\r\nTanggung Jawab:\r\n\r\n-Merancang dan mengembangkan fitur-fitur sistem informasi akademik berbasis web.\r\n-Mengintegrasikan sistem dengan database untuk pengelolaan data akademik.\r\n-Mengoptimalkan antarmuka pengguna agar mudah digunakan oleh berbagai pihak \r\n   (admin, dosen, mahasiswa).\r\n-Menguji dan memastikan sistem berjalan dengan baik tanpa kendala teknis.\r\n\r\nKualifikasi:\r\n\r\n-Mahasiswa atau lulusan Teknik Informatika.\r\n-Memiliki pemahaman tentang pengembangan aplikasi web (frontend dan backend).\r\n-Menguasai bahasa pemrograman seperti PHP, JavaScript, atau Python.\r\n-Familiar dengan framework seperti Laravel, Django, atau React (nilai tambah).\r\n-Memiliki pengalaman dengan pengelolaan database seperti MySQL atau \r\n   PostgreSQL.\r\n-Mampu bekerja secara online dan berkomunikasi dengan baik dalam tim.\r\n\r\nKeuntungan:\r\n\r\n-Pengalaman langsung dalam mengembangkan sistem informasi skala besar.\r\n-Gaji kompetitif selama program magang berlangsung.\r\n-Kesempatan untuk memperluas keterampilan teknis dan manajemen proyek.\r\n-Menambah nilai portofolio dengan proyek nyata yang relevan dengan kebutuhan \r\n   industri.\r\n\r\nJika Anda tertarik untuk menjadi bagian dari proyek ini, segera kirimkan lamaran Anda sebelum batas waktu pendaftaran berakhir!', 20, '2025-01-14', '2025-01-31', '2025-01-14 08:59:15', '2025-01-14 08:59:15'),
(9, '6648921221', 3, 0, 'Pengolahan Citra Menggunakan Deep Learning', '3000000', 'part time', 'online', '4', 'Nongsa', 'Deskripsi Pekerjaan:\r\nKami mengundang mahasiswa atau lulusan Teknik Informatika untuk bergabung dalam program magang dengan fokus pada Pengolahan Citra Menggunakan Deep Learning. Proyek ini bertujuan untuk mengembangkan dan menerapkan model deep learning untuk analisis dan pengolahan citra dalam berbagai aplikasi, seperti deteksi objek, segmentasi gambar, dan pengenalan pola.\r\n\r\nTanggung Jawab:\r\n\r\n-Mengembangkan model deep learning untuk pengolahan citra.\r\n-Melakukan pra-pemrosesan data citra untuk pelatihan model.\r\n-Menggunakan pustaka deep learning seperti TensorFlow, PyTorch, atau Keras.\r\n-Melakukan evaluasi performa model dan meningkatkan akurasinya.\r\n-Menyusun dokumentasi teknis terkait pengembangan dan hasil proyek.\r\n\r\nKualifikasi:\r\n\r\n-Mahasiswa atau lulusan Teknik Informatika.\r\n-Memiliki dasar pemahaman tentang pengolahan citra dan deep learning.\r\n-Familiar dengan framework seperti TensorFlow atau PyTorch.\r\n-Menguasai bahasa pemrograman Python dan pustaka seperti OpenCV atau NumPy.\r\n-Memiliki kemampuan analisis data dan pengujian model.\r\n-Mampu bekerja secara online dan berkomunikasi secara efektif dalam tim.\r\n\r\nKeuntungan:\r\n\r\n-Pengalaman langsung dalam implementasi teknologi deep learning untuk \r\n   pengolahan citra.\r\n-Gaji kompetitif selama program magang berlangsung.\r\n-Kesempatan belajar dan menguasai teknologi terkini di bidang AI dan computer \r\n   vision.\r\n-Menambah portofolio profesional dengan proyek nyata yang relevan dengan tren \r\n   teknologi.\r\n\r\nJika Anda tertarik untuk mempelajari lebih dalam tentang deep learning dan pengolahan citra, segera ajukan lamaran sebelum pendaftaran ditutup!', 13, '2025-01-14', '2025-01-29', '2025-01-14 09:02:02', '2025-01-14 09:02:02'),
(10, '8864099912', 3, 0, 'Cloud Computing untuk Pengelolaan Data', '4000000', 'full time', 'hybrid', '5', 'Nongsa', 'Deskripsi Pekerjaan:\r\nKami membuka kesempatan magang untuk mahasiswa atau lulusan Teknik Informatika yang tertarik untuk mendalami Cloud Computing untuk Pengelolaan Data. Proyek ini bertujuan untuk mengelola dan mengoptimalkan data menggunakan platform cloud modern, memastikan keamanan, skalabilitas, dan efisiensi sistem.\r\n\r\nTanggung Jawab:\r\n\r\n-Merancang dan mengimplementasikan solusi pengelolaan data berbasis cloud.\r\n-Menggunakan layanan cloud seperti AWS, Google Cloud, atau Microsoft Azure.\r\n-Mengelola database terdistribusi di cloud untuk penyimpanan dan analisis data.\r\n-Memastikan keamanan data dan manajemen akses di lingkungan cloud.\r\n-Melakukan pengujian performa dan optimasi sistem berbasis cloud.\r\n\r\nKualifikasi:\r\n\r\n-Mahasiswa atau lulusan Teknik Informatika.\r\n-Memiliki pengetahuan dasar tentang konsep cloud computing dan pengelolaan data.\r\n-Familiar dengan layanan cloud seperti AWS S3, Google Cloud Storage, atau Azure \r\n   Blob Storage.\r\n-Menguasai bahasa pemrograman seperti Python, Java, atau Go untuk integrasi cloud.\r\n-Mampu memahami konsep keamanan data dan manajemen pengguna di cloud.\r\n-Mampu bekerja secara online dengan kolaborasi yang baik dalam tim.\r\n\r\nKeuntungan:\r\n\r\n-Pengalaman langsung dalam penerapan teknologi cloud computing.\r\n-Gaji kompetitif selama program magang berlangsung.\r\n-Kesempatan belajar teknologi terbaru di bidang cloud dan data management.\r\n-Menambah portofolio profesional dengan proyek berbasis cloud computing yang \r\n   relevan.\r\n\r\nJika Anda memiliki semangat untuk belajar dan berkontribusi dalam pengelolaan data berbasis cloud, segera kirimkan lamaran Anda sebelum pendaftaran ditutup!', 15, '2025-01-14', '2025-01-29', '2025-01-14 09:04:56', '2025-01-14 09:04:56'),
(11, '8864099912', 3, 0, 'Aplikasi Pengelolaan Keuangan Pribadi', '4000000', 'part time', 'online', '7', 'Nongsa', 'Deskripsi Pekerjaan:\r\nKami membuka peluang magang untuk mahasiswa atau lulusan Teknik Informatika yang ingin berkontribusi dalam pengembangan Aplikasi Pengelolaan Keuangan Pribadi. Proyek ini bertujuan untuk menciptakan solusi digital yang membantu pengguna dalam mengatur anggaran, melacak pengeluaran, dan mencapai tujuan keuangan.\r\n\r\nTanggung Jawab:\r\n\r\n-Merancang dan mengembangkan aplikasi pengelolaan keuangan pribadi berbasis \r\n   web atau mobile.\r\n-Mengintegrasikan fitur seperti pelacakan pengeluaran, pencatatan pendapatan, dan \r\n   pengingat tagihan.\r\n-Mengoptimalkan antarmuka pengguna agar mudah digunakan dan intuitif.\r\n-Menyediakan fitur analitik sederhana untuk membantu pengguna memahami pola \r\n   keuangan mereka.\r\n-Menguji dan memperbaiki aplikasi berdasarkan masukan pengguna.\r\n\r\nKualifikasi:\r\n\r\n-Mahasiswa atau lulusan Teknik Informatika.\r\n-Memiliki pemahaman dasar tentang pengembangan aplikasi mobile atau web.\r\n-Menguasai bahasa pemrograman seperti JavaScript, Python, atau Kotlin (untuk - \r\n   Android).\r\n-Familiar dengan framework seperti React Native, Flutter, atau Laravel (nilai tambah).\r\n-Memiliki pengetahuan dasar tentang konsep keuangan pribadi dan pengelolaan data.\r\n-Mampu bekerja secara online dan memiliki keterampilan komunikasi yang baik.\r\n\r\nKeuntungan:\r\n\r\n-Pengalaman langsung dalam pengembangan aplikasi yang relevan dengan \r\n   kebutuhan masyarakat.\r\n-Gaji kompetitif selama program magang berlangsung.\r\n-Kesempatan belajar teknologi terkini dalam pengembangan aplikasi keuangan.\r\n-Menambah portofolio profesional dengan aplikasi yang siap digunakan oleh \r\n   pengguna.\r\n\r\nJika Anda tertarik untuk berkontribusi dalam pengembangan solusi keuangan yang inovatif, segera ajukan lamaran sebelum pendaftaran ditutup!', 15, '2025-01-14', '2025-01-28', '2025-01-14 09:06:55', '2025-01-14 09:06:55'),
(12, '1983647321', 3, 0, 'Sistem Pembayaran Digital untuk E-Commerce', '6000000', 'full time', 'hybrid', '5', 'Tiban', 'Deskripsi Pekerjaan:\r\nKami sedang mencari tenaga ahli untuk mengembangkan sistem pembayaran digital yang dapat diimplementasikan pada platform e-commerce. Anda akan berkolaborasi dengan tim untuk merancang, membangun, dan menguji solusi inovatif di bidang teknologi finansial.\r\n\r\nTugas dan Tanggung Jawab:\r\n\r\n-Mengembangkan sistem pembayaran digital berbasis teknologi modern.\r\n-Mengintegrasikan sistem pembayaran dengan platform e-commerce.\r\n-Menjamin keamanan dan skalabilitas sistem.\r\n-Melakukan troubleshooting dan perbaikan jika terjadi masalah teknis.\r\n-Berkoordinasi dengan tim untuk memastikan proyek selesai tepat waktu.\r\n\r\nKualifikasi:\r\n\r\n-Lulusan atau mahasiswa Teknik Informatika.\r\n-Pengalaman dalam pengembangan sistem atau aplikasi adalah nilai tambah.\r\n-Mampu bekerja dalam tim dan memiliki kemampuan komunikasi yang baik.\r\n-Pengetahuan dalam teknologi pembayaran digital akan menjadi keunggulan.\r\n\r\nBergabunglah dengan kami untuk menciptakan solusi teknologi yang inovatif di dunia e-commerce.', 15, '2025-01-14', '2025-01-22', '2025-01-14 09:11:25', '2025-01-14 09:11:25'),
(13, '2309817463', 3, 0, 'DevOps untuk Pengembangan Aplikasi Web', '6000000', 'full time', 'online', '7', 'Muka Kuning', 'Deskripsi Pekerjaan:\r\nKami membuka lowongan untuk posisi DevOps yang bertanggung jawab atas pengelolaan dan pengembangan aplikasi web berbasis teknologi cloud. Posisi ini memungkinkan Anda untuk bekerja sepenuhnya secara online dengan fleksibilitas waktu kerja.\r\n\r\nTugas dan Tanggung Jawab:\r\n\r\n1.Mengelola proses CI/CD untuk aplikasi web.\r\n2.Memastikan infrastruktur cloud berjalan stabil dan efisien.\r\n3.Melakukan monitoring terhadap performa aplikasi dan sistem.\r\n4.Berkoordinasi dengan tim developer untuk integrasi fitur baru.\r\n5.Menjamin keamanan dan kelangsungan infrastruktur aplikasi.\r\n\r\nKualifikasi:\r\n\r\n-Lulusan atau mahasiswa Teknik Informatika.\r\n-Pengalaman dengan alat DevOps seperti Jenkins, Docker, atau Kubernetes.\r\n   Pengetahuan tentang pengelolaan server dan cloud computing (AWS, GCP, atau \r\n   Azure).\r\n-Kemampuan problem-solving yang baik dan dapat bekerja secara mandiri.\r\n\r\nBergabunglah dengan tim kami untuk menciptakan sistem yang andal dan inovatif di dunia pengembangan aplikasi web.', 15, '2025-01-14', '2025-01-20', '2025-01-14 09:14:08', '2025-01-14 09:14:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `admin_id_profile_foreign` (`id_profile`),
  ADD KEY `admin_id_user_foreign` (`id_user`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`nib`),
  ADD KEY `company_id_profile_foreign` (`id_profile`),
  ADD KEY `company_id_user_foreign` (`id_user`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id_proposal`),
  ADD KEY `proposal_id_vacancy_foreign` (`id_vacancy`),
  ADD KEY `proposal_nim_foreign` (`nim`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `student_id_profile_foreign` (`id_profile`),
  ADD KEY `student_id_user_foreign` (`id_user`),
  ADD KEY `student_id_major_foreign` (`id_major`),
  ADD KEY `student_id_study_program_foreign` (`id_study_program`);

--
-- Indexes for table `study_program`
--
ALTER TABLE `study_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `study_program_id_major_foreign` (`id_major`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_foreign` (`role`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_roles_label_unique` (`label`);

--
-- Indexes for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`id_vacancy`),
  ADD KEY `vacancy_nib_foreign` (`nib`),
  ADD KEY `vacancy_id_major_foreign` (`id_major`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id_profile` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id_proposal` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study_program`
--
ALTER TABLE `study_program`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `id_vacancy` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_id_profile_foreign` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id_profile`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_id_profile_foreign` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id_profile`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `password_reset_tokens_email_foreign` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `proposal`
--
ALTER TABLE `proposal`
  ADD CONSTRAINT `proposal_id_vacancy_foreign` FOREIGN KEY (`id_vacancy`) REFERENCES `vacancy` (`id_vacancy`) ON DELETE CASCADE,
  ADD CONSTRAINT `proposal_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `student` (`nim`) ON DELETE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_id_major_foreign` FOREIGN KEY (`id_major`) REFERENCES `major` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_id_profile_foreign` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id_profile`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_id_study_program_foreign` FOREIGN KEY (`id_study_program`) REFERENCES `study_program` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `study_program`
--
ALTER TABLE `study_program`
  ADD CONSTRAINT `study_program_id_major_foreign` FOREIGN KEY (`id_major`) REFERENCES `major` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_foreign` FOREIGN KEY (`role`) REFERENCES `user_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD CONSTRAINT `vacancy_id_major_foreign` FOREIGN KEY (`id_major`) REFERENCES `major` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vacancy_nib_foreign` FOREIGN KEY (`nib`) REFERENCES `company` (`nib`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
