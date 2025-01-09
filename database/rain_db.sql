-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2025 at 04:07 PM
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
(1, 19, 19, 'Politeknik Negeri Batam', 'rain_db.*:SELECT, INSERT, UPDATE, DELETE', NULL, NULL);

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
('1647354321', 10, 10, 'PT', 'manufaktur hardware application dan system', 'cooperation_folder/SURAT KERJASAMA PT. AOHAI INDONESIA DAN POLIBATAM.docx', '2019-01-13', '2025-01-09', NULL, NULL),
('1983214321', 13, 13, 'LPK', 'LPK, Kursus dan pembelajaran', 'cooperation_folder/SURAT KERJASAMA INFINITE LEARNING DAN POLIBATAM.pdf', '2005-09-30', '2025-01-09', NULL, NULL),
('1983647321', 17, 17, 'PT', 'manufaktur mekanik', 'cooperation_folder/SURAT KERJASAMA PT. NOK FREUDENBERG DAN POLIBATAM.pdf', '2007-04-18', '2025-01-09', NULL, NULL),
('2309817463', 18, 18, 'PT', 'Manufacturing, Transport & Logistics', 'cooperation_folder/SURAT KERJASAMA PT. AMBER KARYA DAN POLIBATAM.pdf', '2013-01-26', '2025-01-09', NULL, NULL),
('6648921221', 15, 15, 'PT', 'bidang kesehatan', 'cooperation_folder/SURAT KERJASAMA PT. CIBA ALCON BATAM DAN POLIBATAM.pdf', '2011-02-05', '2025-01-09', NULL, NULL),
('7765902312', 14, 14, 'PT', 'bidang alat pancing dan sepeda', 'cooperation_folder/SURAT KERJASAMA PT. SHIMANO BATAM DAN POLIBATAM.pdf', '2010-10-11', '2025-01-09', NULL, NULL),
('8756431231', 11, 11, 'PT', 'manufaktur mesin berat', 'cooperation_folder/SURAT KERJASAMA PT. BATAM TECHNO INDONESIA DAN POLIBATAM.pdf', '2012-03-13', '2025-01-09', NULL, NULL),
('8864099912', 16, 16, 'PT', 'manufaktur jaringan dan teknologi', 'cooperation_folder/SURAT KERJASAMA TELKOM INDONESIA DAN POLIBATAM.pdf', '2017-04-18', '2025-01-09', NULL, NULL),
('9845563123', 12, 12, 'PT', 'jasa logistik', 'cooperation_folder/SURAT KERJASAMA PT. GLOBALINDO MULTILOGISTIK DAN POLIBATAM.pdf', '2005-09-20', '2025-01-09', NULL, NULL);

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
(1, 'Manajemen & Bisnis', '2025-01-09 16:04:50', '2025-01-09 16:04:50'),
(2, 'Teknik Elektro', '2025-01-09 16:04:50', '2025-01-09 16:04:50'),
(3, 'Teknik Informatika', '2025-01-09 16:04:50', '2025-01-09 16:04:50'),
(4, 'Teknik Mesin', '2025-01-09 16:04:50', '2025-01-09 16:04:50');

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
(1, 'profile/Wasyn-removebg-preview.png', 'Wasyn', 'Sulaiman Siregar', 'Legenda Malaka', '248743', 'Batam', '0987543123', NULL, NULL, NULL),
(2, 'profile/Eric-removebg-preview.png', 'Eric', 'Marchelino Hutabarat', 'Botania', '244371', 'Batam', '0898997543', NULL, NULL, NULL),
(3, 'profile/Aidil-removebg-preview.png', 'Muhammad', 'Aidil Jupriadi Sale', 'Tanjung Piayu', '248364', 'Batam', '0844332561', NULL, NULL, NULL),
(4, 'profile/Fito-removebg-preview.png', 'Fito', 'Desta Fabiansyah', 'Batu Ampar', '231098', 'Batam', '0899765482', NULL, NULL, NULL),
(5, 'profile/Indria-removebg-preview.png', 'Indria', 'Bintani Aiska', 'Suka Jadi', '230998', 'Batam', '0891123211', NULL, NULL, NULL),
(6, 'profile/Winda-removebg-preview.png', 'Winda', 'Tri Wulan Dari', 'Batu Aji', '233451', 'Batam', '0844563321', NULL, NULL, NULL),
(7, 'profile/Screenshot 2025-01-04 215434.png', 'Andri', 'Putra Siregar', 'Legenda Bali', '220098', 'Batam', '0875667564', NULL, NULL, NULL),
(8, 'profile/Screenshot 2025-01-04 215533.png', 'Doni', 'Tata Fahreza', 'Belian', '233467', 'Batam', '0878122231', NULL, NULL, NULL),
(9, 'profile/Screenshot 2025-01-04 215619.png', 'Muhammad', 'Hasan Firdaus', 'Batu Aji', '231166', 'Batam', '0875901954', NULL, NULL, NULL),
(10, 'profile/PT. AOHAI.jpeg', 'PT', 'Aohai', 'Legenda Malaka', '248743', 'Batam', '0888982312', NULL, NULL, NULL),
(11, 'profile/PT. Batam Techno Indonesia.jpg', 'PT', 'Batam Techno Indonesia', 'Temenggung', '244371', 'Batam', '0899823317', NULL, NULL, NULL),
(12, 'profile/PT. Globalindo Multilogistik.jpeg', 'PT', 'Globalindo multi logistik', 'Tanjung Piayu', '248364', 'Batam', '0845667312', NULL, NULL, NULL),
(13, 'profile/Infinite Learning.jpg', 'Infinite', 'Learning', 'Bengkong', '231098', 'Batam', '0891211650', NULL, NULL, NULL),
(14, 'profile/PT. Shimano Batam.png', 'Shimano', 'Batam', 'Tiban', '230998', 'Batam', '0845332120', NULL, NULL, NULL),
(15, 'profile/PT. Ciba Alcon Vision Batam.png', 'Ciba', 'Alcon Batam', 'Nongsa', '233451', 'Batam', '0877659801', NULL, NULL, NULL),
(16, 'profile/PT. Telkom Indonesia Batam.png', 'Telkom Batam', 'Indonesia', 'Nongsa', '220098', 'Batam', '0866540912', NULL, NULL, NULL),
(17, 'profile/PT. Nok Freudenberg.jpg', 'PT NOK', 'FREUDENBERG', 'Tiban', '233467', 'Batam', '0876543908', NULL, NULL, NULL),
(18, 'profile/PT. Amber Karya.jpg', 'PT', 'Amber Karya', 'Muka Kuning', '231166', 'Batam', '0876498012', NULL, NULL, NULL),
(19, 'default/profile_company.jpg', 'Admin', 'RAIN Polibatam', 'Batam Centre', '289743', 'Batam', '0822360917', NULL, NULL, NULL);

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
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
(1, 'wasyn@gmail.com', 1, '2025-01-09', '$2y$12$J3E.RZYjfNS.wQ9IRvsaJeF93qUGyASIedjpXymE5eLdzf5e2EcPO', NULL, NULL, NULL),
(2, 'eric@gmail.com', 1, '2025-01-09', '$2y$12$oV14bEvOgG6nYEkDOXBKhenH9RvOM2ja2ZVAbnG61n0JpqeVwmUMW', NULL, NULL, NULL),
(3, 'aidil@gmail.com', 1, '2025-01-09', '$2y$12$L7YxlfW.k7k9BrpMk369YOn9wGx7Nrnfdf9DFb9iGs6eujRWqx1aa', NULL, NULL, NULL),
(4, 'fito@gmail.com', 1, '2025-01-09', '$2y$12$/MqC422ae5HhODsxVvCAke8.Jf5Kn.Bs1HRRQdo9AsvgwOI6EZk4e', NULL, NULL, NULL),
(5, 'indria@gmail.com', 1, '2025-01-09', '$2y$12$D97HE8fjXkH7E.K0jIt5TOo72YEyX9m.UMrk8hhdEA3cKhoyVqYQS', NULL, NULL, NULL),
(6, 'winda@gmail.com', 1, '2025-01-09', '$2y$12$ZbLidr38sddDEhpTr36DseTiVWaHeqqDib8ZkSMnQy4PIHE3k6aji', NULL, NULL, NULL),
(7, 'andri@gmail.com', 1, '2025-01-09', '$2y$12$J.Y.5poaW4XhejX715wFP..UaoMe19JyYcI7rVGk.1n/R1pzP3OA.', NULL, NULL, NULL),
(8, 'doni@gmail.com', 1, '2025-01-09', '$2y$12$TpvcLGj5V9M3HCzs6YUbrO2oGOGYfg8lhpwYeyUxo6TiOoXG8wi4.', NULL, NULL, NULL),
(9, 'hasan@gmail.com', 1, '2025-01-09', '$2y$12$q71nyr2iLWr3rjx.0nyEdu2cSksgqmtsLtGYHyXygUYaKfa7e5Tyy', NULL, NULL, NULL),
(10, 'ptaohai@gmail.com', 2, '2025-01-09', '$2y$12$WDMOFrsN6w7avLnIgynRQOT2sVI4WH9BUGuIhiBpp62sfdwLCj2N6', NULL, NULL, NULL),
(11, 'ptbatamtechnoindonesia@gmail.com', 2, '2025-01-09', '$2y$12$pGBaeATs8xX4igpevxBT8uNhG7cKsK0zT2VSOyw2fulNgoI6ZLOs6', NULL, NULL, NULL),
(12, 'ptglobalindomultilogistik@gmail.com', 2, '2025-01-09', '$2y$12$pfK4NZCJq/xqVbIK/yDZMO9tQS3iAgJGZLaEqznln/sKvqffypS.e', NULL, NULL, NULL),
(13, 'infinitelearningbatam@gmail.com', 2, '2025-01-09', '$2y$12$GIGepkDaX713NIjRP9kjMOGXcjG3UkaN3tprq3PLovhAXQtkNBnAe', NULL, NULL, NULL),
(14, 'ptshimanobatam@gmail.com', 2, '2025-01-09', '$2y$12$yYV0.jDQCf4gF5ap6ZLaf.Glj2sjVwTOy.3iaXrSoGGUXzldsDm66', NULL, NULL, NULL),
(15, 'ptcibaalconvision@gmail.com', 2, '2025-01-09', '$2y$12$0gS.JiBpohJElSacaLT8ve1KRX9UgRyvTUgZg8Tcb3ELMp7ove6fm', NULL, NULL, NULL),
(16, 'pttelkombatamindonesia@gmail.com', 2, '2025-01-09', '$2y$12$i72IxzNkxAIUSaZhwOm4TOz43uC/Bv.1x76ZArgamWSorFIOrD56q', NULL, NULL, NULL),
(17, 'ptnokfreudenberg@gmail.com', 2, '2025-01-09', '$2y$12$ijk1HgvLqZJRiguorvzXIe7k7AbFzdZsnpsy2ilDptJ5YJVQllIkG', NULL, NULL, NULL),
(18, 'ptamberkarya@gmail.com', 2, '2025-01-09', '$2y$12$JqWp9Gb8Q6A4hraXOwsyzexAICbzQYo79FWA9d87noP4KDGJgKE06', NULL, NULL, NULL),
(19, 'rainpolibatam@gmail.com', 3, '2025-01-09', '$2y$12$taYE7qPiHwyLWDAAHpkZSOGoLHpbLyrzsgaJYjEAjSePG9H84/yYO', NULL, NULL, NULL);

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
(1, 'Mahasiswa', '2025-01-09 16:04:50', '2025-01-09 16:04:50'),
(2, 'Perusahaan', '2025-01-09 16:04:50', '2025-01-09 16:04:50'),
(3, 'Admin', '2025-01-09 16:04:50', '2025-01-09 16:04:50');

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
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, '1983214321', 3, 0, 'Backend Developer', '2000000', 'full time', 'offline', '5', 'Batam, Nongsa', 'Lowongan Backend Developer di LPK Infinite Learning\r\n\r\nPosisi: Backend Developer\r\nPerusahaan: LPK Infinite Learning\r\n\r\nDeskripsi Pekerjaan:\r\n- Membuat, mengembangkan, dan memelihara sistem backend aplikasi.\r\n- Mengintegrasikan API dan database dengan frontend.\r\n- Melakukan debugging dan optimasi performa aplikasi.\r\n- Bekerja sama dengan tim frontend dan stakeholder untuk mengimplementasikan kebutuhan aplikasi.\r\n- Menyusun dokumentasi teknis terkait pengembangan sistem.\r\n\r\nKualifikasi:\r\n1. Mahasiswa aktif jurusan Teknik Informatika atau bidang terkait.\r\n2. Memahami salah satu bahasa pemrograman backend seperti Python (Django/Flask), PHP (Laravel), Node.js, atau Java (Spring Boot).\r\n3. Berpengalaman menggunakan database seperti MySQL, PostgreSQL, atau MongoDB.\r\n4. Memahami konsep RESTful API.\r\n5. Mampu bekerja secara tim maupun individu.\r\n6. Berorientasi pada detail dan memiliki kemampuan analitis yang baik.\r\n7. Diutamakan yang memiliki pengalaman proyek sebelumnya (baik akademis maupun pribadi).\r\n\r\nBenefit:\r\n- Pengalaman kerja nyata di lingkungan profesional.\r\n- Sertifikat magang dari LPK Infinite Learning.\r\n- Bimbingan dari mentor berpengalaman.\r\n- Jadwal kerja fleksibel yang disesuaikan dengan aktivitas kuliah.\r\n\r\nLokasi Kerja:\r\nRemote atau Onsite (sesuai dengan kebutuhan).\r\n\r\nCara Melamar:\r\nKirimkan CV dan portofolio ke email: hr@infinitelearning.com dengan subjek [Magang Backend Developer] - Nama Lengkap.\r\n\r\nDeadline Pendaftaran:\r\n30 Januari 2025.\r\n\r\nCatatan:\r\nHanya kandidat terpilih yang akan dihubungi untuk tahap selanjutnya.', 12, '2025-01-09', '2025-01-30', '2025-01-09 16:05:47', '2025-01-09 16:06:23');

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
  MODIFY `id_vacancy` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
