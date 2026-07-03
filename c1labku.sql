-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2026 at 12:55 PM
-- Server version: 10.11.2-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c1labku`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggaran_belanjas`
--

CREATE TABLE IF NOT EXISTS `anggaran_belanjas` (
  `id` char(36) NOT NULL,
  `tahun_anggaran_id` varchar(255) DEFAULT NULL,
  `kegiatan_id` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `volume_awal` decimal(15,2) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `sisa_volume` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `anggaran_belanjas`
--

INSERT INTO `anggaran_belanjas` (`id`, `tahun_anggaran_id`, `kegiatan_id`, `nama`, `volume_awal`, `satuan`, `sisa_volume`, `created_at`, `updated_at`) VALUES
('1na-1', NULL, NULL, 'Tanpa Anggaran', '0.00', '-', '0.00', NULL, NULL),
('2d86b5d9-eecf-4245-9b51-adef02b2598d', '9b702342-a1f8-4dd1-9156-33f80b7406ee', 'bd7e01de-430d-4336-8774-ed70142171d9', 'Baliho B (4x8 Horizontal)', '15.00', 'Satuan', '11.00', '2026-01-14 23:22:30', '2026-04-11 05:50:20'),
('2ffc1a52-b3e0-4b9f-95a5-c23ad39a5f0a', '9b702342-a1f8-4dd1-9156-33f80b7406ee', 'e32537d5-e045-4762-9f8a-70880b52d0bd', 'Spanduk/ Backdrop/ Banner', '1200.00', 'm2', '1010.00', '2026-01-14 23:42:03', '2026-05-04 08:10:19'),
('47dead77-8da1-48f2-bab7-38776416f4b0', '9b702342-a1f8-4dd1-9156-33f80b7406ee', 'cd6d6a81-e472-480b-8bf4-7144c0e75ed7', 'Tabloid Solo Berseri', '1000.00', 'Buku', '1000.00', '2026-01-14 23:42:33', '2026-03-31 05:53:17'),
('af09a15d-e6a4-4625-9fdb-cdd454cdcd0e', 'c826fd1a-1bb8-48a4-8986-9b9012aaccf4', 'bd7e01de-430d-4336-8774-ed70142171d9', 'Baliho A (4x6 Vertikal) a', '8.00', 'buah', '8.00', '2026-01-14 08:51:39', '2026-03-09 07:49:27'),
('af09a15d-e6a4-4625-9fdb-dc6454cdcxxx', '9b702342-a1f8-4dd1-9156-33f80b7406ee', 'bd7e01de-430d-4336-8774-ed70142171d9', 'Baliho A (4x6 Vertikal)', '8.00', 'buah', '6.00', '2026-01-14 08:51:39', '2026-04-11 06:10:38'),
('c012297c-4ca3-4a37-9587-6cfdfe681367', '9b702342-a1f8-4dd1-9156-33f80b7406ee', '9e9e8cf5-d669-4088-bf31-94fdce52779c', 'Brosur/Flyer/Leaflet A5', '5.00', 'rim', '5.00', '2026-01-14 23:42:55', '2026-04-11 02:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('dashboard-eksekutif-sumber-daya-informasi-cache-1b8a8007beac7e36e31c77374126c0adb5fd3308', 'i:1;', 1778125222),
('dashboard-eksekutif-sumber-daya-informasi-cache-1b8a8007beac7e36e31c77374126c0adb5fd3308:timer', 'i:1778125222;', 1778125222),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:220776ae685be118e24d5d496037621a19749c0e', 'i:1;', 1776428172),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:220776ae685be118e24d5d496037621a19749c0e:timer', 'i:1776428172;', 1776428172),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:33cced81bd422678d4c645e61bc2753b668f8612', 'i:1;', 1776992590),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:33cced81bd422678d4c645e61bc2753b668f8612:timer', 'i:1776992590;', 1776992590),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:38d06822ba6cbc52b793e03d439f6d5e83888fd1', 'i:1;', 1776248068),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:38d06822ba6cbc52b793e03d439f6d5e83888fd1:timer', 'i:1776248068;', 1776248068),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:57220eec76350bc34079149fe45b47e1167dbb71', 'i:1;', 1776323749),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:57220eec76350bc34079149fe45b47e1167dbb71:timer', 'i:1776323749;', 1776323749),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:7f8c0939ab142b915aeb7da89c1fdd9d26f9c16f', 'i:1;', 1775910595),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:7f8c0939ab142b915aeb7da89c1fdd9d26f9c16f:timer', 'i:1775910595;', 1775910595),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:b6afe0517d2377574ff4b4c5435ca24c9ae5d785', 'i:1;', 1778083701),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:b6afe0517d2377574ff4b4c5435ca24c9ae5d785:timer', 'i:1778083701;', 1778083701),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:bd72aabc652ce884e7950e21baf4f0d6018569f6', 'i:1;', 1775701504),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:bd72aabc652ce884e7950e21baf4f0d6018569f6:timer', 'i:1775701504;', 1775701504),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:be6a9c124cc0f5b83cedc98fcc96a7a12060368f', 'i:1;', 1775741551),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:be6a9c124cc0f5b83cedc98fcc96a7a12060368f:timer', 'i:1775741551;', 1775741551),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:c6019b6762ba1f29d9a6762df3e329a9d0d88619', 'i:1;', 1776469036),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:c6019b6762ba1f29d9a6762df3e329a9d0d88619:timer', 'i:1776469036;', 1776469036),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:d4ff6ba0227c29ee11016dc582630f6ea3874dcd', 'i:1;', 1778118389),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:d4ff6ba0227c29ee11016dc582630f6ea3874dcd:timer', 'i:1778118389;', 1778118389),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:d873486c958dda3b3abb5501439dc4f112d3bf90', 'i:1;', 1775831605),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:d873486c958dda3b3abb5501439dc4f112d3bf90:timer', 'i:1775831605;', 1775831605),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:fe47462aab2ed9c44b82c9225f7d245bc3be4eae', 'i:1;', 1776386667),
('dashboard-eksekutif-sumber-daya-informasi-cache-livewire-rate-limiter:fe47462aab2ed9c44b82c9225f7d245bc3be4eae:timer', 'i:1776386667;', 1776386667),
('dashboard-eksekutif-sumber-daya-informasi-cache-spatie.permission.cache', 'a:3:{s:5:"alias";a:5:{s:1:"a";s:2:"id";s:1:"b";s:4:"name";s:1:"c";s:10:"guard_name";s:1:"r";s:5:"roles";s:1:"j";s:7:"team_id";}s:11:"permissions";a:163:{i:0;a:4:{s:1:"a";i:1;s:1:"b";s:9:"view_role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:1;a:4:{s:1:"a";i:2;s:1:"b";s:13:"view_any_role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:2;a:4:{s:1:"a";i:3;s:1:"b";s:11:"create_role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:3;a:4:{s:1:"a";i:4;s:1:"b";s:11:"update_role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:4;a:3:{s:1:"a";i:5;s:1:"b";s:12:"restore_role";s:1:"c";s:3:"web";}i:5;a:3:{s:1:"a";i:6;s:1:"b";s:16:"restore_any_role";s:1:"c";s:3:"web";}i:6;a:3:{s:1:"a";i:7;s:1:"b";s:14:"replicate_role";s:1:"c";s:3:"web";}i:7;a:3:{s:1:"a";i:8;s:1:"b";s:12:"reorder_role";s:1:"c";s:3:"web";}i:8;a:4:{s:1:"a";i:9;s:1:"b";s:11:"delete_role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:9;a:4:{s:1:"a";i:10;s:1:"b";s:15:"delete_any_role";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:10;a:3:{s:1:"a";i:11;s:1:"b";s:17:"force_delete_role";s:1:"c";s:3:"web";}i:11;a:3:{s:1:"a";i:12;s:1:"b";s:21:"force_delete_any_role";s:1:"c";s:3:"web";}i:12;a:3:{s:1:"a";i:13;s:1:"b";s:11:"view_baliho";s:1:"c";s:3:"web";}i:13;a:3:{s:1:"a";i:14;s:1:"b";s:15:"view_any_baliho";s:1:"c";s:3:"web";}i:14;a:3:{s:1:"a";i:15;s:1:"b";s:13:"create_baliho";s:1:"c";s:3:"web";}i:15;a:3:{s:1:"a";i:16;s:1:"b";s:13:"update_baliho";s:1:"c";s:3:"web";}i:16;a:3:{s:1:"a";i:17;s:1:"b";s:14:"restore_baliho";s:1:"c";s:3:"web";}i:17;a:3:{s:1:"a";i:18;s:1:"b";s:18:"restore_any_baliho";s:1:"c";s:3:"web";}i:18;a:3:{s:1:"a";i:19;s:1:"b";s:16:"replicate_baliho";s:1:"c";s:3:"web";}i:19;a:3:{s:1:"a";i:20;s:1:"b";s:14:"reorder_baliho";s:1:"c";s:3:"web";}i:20;a:3:{s:1:"a";i:21;s:1:"b";s:13:"delete_baliho";s:1:"c";s:3:"web";}i:21;a:3:{s:1:"a";i:22;s:1:"b";s:17:"delete_any_baliho";s:1:"c";s:3:"web";}i:22;a:3:{s:1:"a";i:23;s:1:"b";s:19:"force_delete_baliho";s:1:"c";s:3:"web";}i:23;a:3:{s:1:"a";i:24;s:1:"b";s:23:"force_delete_any_baliho";s:1:"c";s:3:"web";}i:24;a:4:{s:1:"a";i:25;s:1:"b";s:13:"view_instansi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:25;a:4:{s:1:"a";i:26;s:1:"b";s:17:"view_any_instansi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:26;a:4:{s:1:"a";i:27;s:1:"b";s:15:"create_instansi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:27;a:4:{s:1:"a";i:28;s:1:"b";s:15:"update_instansi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:28;a:4:{s:1:"a";i:29;s:1:"b";s:16:"restore_instansi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:29;a:4:{s:1:"a";i:30;s:1:"b";s:20:"restore_any_instansi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:30;a:4:{s:1:"a";i:31;s:1:"b";s:18:"replicate_instansi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:31;a:4:{s:1:"a";i:32;s:1:"b";s:16:"reorder_instansi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:32;a:4:{s:1:"a";i:33;s:1:"b";s:15:"delete_instansi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:33;a:4:{s:1:"a";i:34;s:1:"b";s:19:"delete_any_instansi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:34;a:4:{s:1:"a";i:35;s:1:"b";s:21:"force_delete_instansi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:35;a:4:{s:1:"a";i:36;s:1:"b";s:25:"force_delete_any_instansi";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:36;a:4:{s:1:"a";i:37;s:1:"b";s:9:"view_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:37;a:4:{s:1:"a";i:38;s:1:"b";s:13:"view_any_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:38;a:4:{s:1:"a";i:39;s:1:"b";s:11:"create_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:39;a:4:{s:1:"a";i:40;s:1:"b";s:11:"update_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:40;a:4:{s:1:"a";i:41;s:1:"b";s:12:"restore_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:41;a:4:{s:1:"a";i:42;s:1:"b";s:16:"restore_any_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:42;a:4:{s:1:"a";i:43;s:1:"b";s:14:"replicate_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:43;a:4:{s:1:"a";i:44;s:1:"b";s:12:"reorder_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:44;a:4:{s:1:"a";i:45;s:1:"b";s:11:"delete_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:45;a:4:{s:1:"a";i:46;s:1:"b";s:15:"delete_any_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:46;a:4:{s:1:"a";i:47;s:1:"b";s:17:"force_delete_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:47;a:4:{s:1:"a";i:48;s:1:"b";s:21:"force_delete_any_user";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:48;a:4:{s:1:"a";i:49;s:1:"b";s:12:"view_layanan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:49;a:4:{s:1:"a";i:50;s:1:"b";s:16:"view_any_layanan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:50;a:4:{s:1:"a";i:51;s:1:"b";s:14:"update_layanan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:51;a:4:{s:1:"a";i:52;s:1:"b";s:15:"restore_layanan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:52;a:4:{s:1:"a";i:53;s:1:"b";s:19:"restore_any_layanan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:53;a:4:{s:1:"a";i:54;s:1:"b";s:17:"replicate_layanan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:54;a:4:{s:1:"a";i:55;s:1:"b";s:15:"reorder_layanan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:55;a:4:{s:1:"a";i:56;s:1:"b";s:20:"force_delete_layanan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:56;a:4:{s:1:"a";i:57;s:1:"b";s:24:"force_delete_any_layanan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:57;a:4:{s:1:"a";i:58;s:1:"b";s:20:"view_tahun::anggaran";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:58;a:4:{s:1:"a";i:59;s:1:"b";s:24:"view_any_tahun::anggaran";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:59;a:4:{s:1:"a";i:60;s:1:"b";s:22:"create_tahun::anggaran";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:60;a:4:{s:1:"a";i:61;s:1:"b";s:22:"update_tahun::anggaran";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:61;a:4:{s:1:"a";i:62;s:1:"b";s:23:"restore_tahun::anggaran";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:62;a:4:{s:1:"a";i:63;s:1:"b";s:27:"restore_any_tahun::anggaran";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:63;a:4:{s:1:"a";i:64;s:1:"b";s:25:"replicate_tahun::anggaran";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:64;a:4:{s:1:"a";i:65;s:1:"b";s:23:"reorder_tahun::anggaran";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:65;a:4:{s:1:"a";i:66;s:1:"b";s:22:"delete_tahun::anggaran";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:66;a:4:{s:1:"a";i:67;s:1:"b";s:26:"delete_any_tahun::anggaran";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:67;a:4:{s:1:"a";i:68;s:1:"b";s:28:"force_delete_tahun::anggaran";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:68;a:4:{s:1:"a";i:69;s:1:"b";s:32:"force_delete_any_tahun::anggaran";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:69;a:3:{s:1:"a";i:70;s:1:"b";s:13:"view_anggaran";s:1:"c";s:3:"web";}i:70;a:3:{s:1:"a";i:71;s:1:"b";s:17:"view_any_anggaran";s:1:"c";s:3:"web";}i:71;a:3:{s:1:"a";i:72;s:1:"b";s:15:"create_anggaran";s:1:"c";s:3:"web";}i:72;a:3:{s:1:"a";i:73;s:1:"b";s:15:"update_anggaran";s:1:"c";s:3:"web";}i:73;a:3:{s:1:"a";i:74;s:1:"b";s:16:"restore_anggaran";s:1:"c";s:3:"web";}i:74;a:3:{s:1:"a";i:75;s:1:"b";s:20:"restore_any_anggaran";s:1:"c";s:3:"web";}i:75;a:3:{s:1:"a";i:76;s:1:"b";s:18:"replicate_anggaran";s:1:"c";s:3:"web";}i:76;a:3:{s:1:"a";i:77;s:1:"b";s:16:"reorder_anggaran";s:1:"c";s:3:"web";}i:77;a:3:{s:1:"a";i:78;s:1:"b";s:15:"delete_anggaran";s:1:"c";s:3:"web";}i:78;a:3:{s:1:"a";i:79;s:1:"b";s:19:"delete_any_anggaran";s:1:"c";s:3:"web";}i:79;a:3:{s:1:"a";i:80;s:1:"b";s:21:"force_delete_anggaran";s:1:"c";s:3:"web";}i:80;a:3:{s:1:"a";i:81;s:1:"b";s:25:"force_delete_any_anggaran";s:1:"c";s:3:"web";}i:81;a:3:{s:1:"a";i:82;s:1:"b";s:22:"view_anggaran::belanja";s:1:"c";s:3:"web";}i:82;a:3:{s:1:"a";i:83;s:1:"b";s:26:"view_any_anggaran::belanja";s:1:"c";s:3:"web";}i:83;a:3:{s:1:"a";i:84;s:1:"b";s:24:"create_anggaran::belanja";s:1:"c";s:3:"web";}i:84;a:3:{s:1:"a";i:85;s:1:"b";s:24:"update_anggaran::belanja";s:1:"c";s:3:"web";}i:85;a:3:{s:1:"a";i:86;s:1:"b";s:25:"restore_anggaran::belanja";s:1:"c";s:3:"web";}i:86;a:3:{s:1:"a";i:87;s:1:"b";s:29:"restore_any_anggaran::belanja";s:1:"c";s:3:"web";}i:87;a:3:{s:1:"a";i:88;s:1:"b";s:27:"replicate_anggaran::belanja";s:1:"c";s:3:"web";}i:88;a:3:{s:1:"a";i:89;s:1:"b";s:25:"reorder_anggaran::belanja";s:1:"c";s:3:"web";}i:89;a:3:{s:1:"a";i:90;s:1:"b";s:24:"delete_anggaran::belanja";s:1:"c";s:3:"web";}i:90;a:3:{s:1:"a";i:91;s:1:"b";s:28:"delete_any_anggaran::belanja";s:1:"c";s:3:"web";}i:91;a:3:{s:1:"a";i:92;s:1:"b";s:30:"force_delete_anggaran::belanja";s:1:"c";s:3:"web";}i:92;a:3:{s:1:"a";i:93;s:1:"b";s:34:"force_delete_any_anggaran::belanja";s:1:"c";s:3:"web";}i:93;a:4:{s:1:"a";i:94;s:1:"b";s:19:"view_ukuran::baliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:94;a:4:{s:1:"a";i:95;s:1:"b";s:23:"view_any_ukuran::baliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:95;a:4:{s:1:"a";i:96;s:1:"b";s:21:"create_ukuran::baliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:96;a:4:{s:1:"a";i:97;s:1:"b";s:21:"update_ukuran::baliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:97;a:4:{s:1:"a";i:98;s:1:"b";s:22:"restore_ukuran::baliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:98;a:4:{s:1:"a";i:99;s:1:"b";s:26:"restore_any_ukuran::baliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:99;a:4:{s:1:"a";i:100;s:1:"b";s:24:"replicate_ukuran::baliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:100;a:4:{s:1:"a";i:101;s:1:"b";s:22:"reorder_ukuran::baliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:101;a:4:{s:1:"a";i:102;s:1:"b";s:21:"delete_ukuran::baliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:102;a:4:{s:1:"a";i:103;s:1:"b";s:25:"delete_any_ukuran::baliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:103;a:4:{s:1:"a";i:104;s:1:"b";s:27:"force_delete_ukuran::baliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:104;a:4:{s:1:"a";i:105;s:1:"b";s:31:"force_delete_any_ukuran::baliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:105;a:4:{s:1:"a";i:106;s:1:"b";s:18:"view_titik::baliho";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:106;a:4:{s:1:"a";i:107;s:1:"b";s:22:"view_any_titik::baliho";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:107;a:4:{s:1:"a";i:108;s:1:"b";s:20:"create_titik::baliho";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:108;a:4:{s:1:"a";i:109;s:1:"b";s:20:"update_titik::baliho";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:109;a:4:{s:1:"a";i:110;s:1:"b";s:21:"restore_titik::baliho";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:110;a:4:{s:1:"a";i:111;s:1:"b";s:25:"restore_any_titik::baliho";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:111;a:4:{s:1:"a";i:112;s:1:"b";s:23:"replicate_titik::baliho";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:112;a:4:{s:1:"a";i:113;s:1:"b";s:21:"reorder_titik::baliho";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:113;a:4:{s:1:"a";i:114;s:1:"b";s:20:"delete_titik::baliho";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:114;a:4:{s:1:"a";i:115;s:1:"b";s:24:"delete_any_titik::baliho";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:115;a:4:{s:1:"a";i:116;s:1:"b";s:26:"force_delete_titik::baliho";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:116;a:4:{s:1:"a";i:117;s:1:"b";s:30:"force_delete_any_titik::baliho";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:117;a:4:{s:1:"a";i:118;s:1:"b";s:15:"view_permohonan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:118;a:4:{s:1:"a";i:119;s:1:"b";s:19:"view_any_permohonan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:119;a:4:{s:1:"a";i:120;s:1:"b";s:17:"create_permohonan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:120;a:4:{s:1:"a";i:121;s:1:"b";s:17:"update_permohonan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:121;a:4:{s:1:"a";i:122;s:1:"b";s:18:"restore_permohonan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:122;a:4:{s:1:"a";i:123;s:1:"b";s:22:"restore_any_permohonan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:123;a:4:{s:1:"a";i:124;s:1:"b";s:20:"replicate_permohonan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:124;a:4:{s:1:"a";i:125;s:1:"b";s:18:"reorder_permohonan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:125;a:4:{s:1:"a";i:126;s:1:"b";s:17:"delete_permohonan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:126;a:4:{s:1:"a";i:127;s:1:"b";s:21:"delete_any_permohonan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:127;a:4:{s:1:"a";i:128;s:1:"b";s:23:"force_delete_permohonan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:128;a:4:{s:1:"a";i:129;s:1:"b";s:27:"force_delete_any_permohonan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:129;a:4:{s:1:"a";i:130;s:1:"b";s:37:"view_permohonan::det::med::kom::cetak";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:130;a:4:{s:1:"a";i:131;s:1:"b";s:41:"view_any_permohonan::det::med::kom::cetak";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:131;a:4:{s:1:"a";i:132;s:1:"b";s:39:"create_permohonan::det::med::kom::cetak";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:132;a:4:{s:1:"a";i:133;s:1:"b";s:39:"update_permohonan::det::med::kom::cetak";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:133;a:4:{s:1:"a";i:134;s:1:"b";s:40:"restore_permohonan::det::med::kom::cetak";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:134;a:4:{s:1:"a";i:135;s:1:"b";s:44:"restore_any_permohonan::det::med::kom::cetak";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:135;a:4:{s:1:"a";i:136;s:1:"b";s:42:"replicate_permohonan::det::med::kom::cetak";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:136;a:4:{s:1:"a";i:137;s:1:"b";s:40:"reorder_permohonan::det::med::kom::cetak";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:137;a:4:{s:1:"a";i:138;s:1:"b";s:39:"delete_permohonan::det::med::kom::cetak";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:138;a:4:{s:1:"a";i:139;s:1:"b";s:43:"delete_any_permohonan::det::med::kom::cetak";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:139;a:4:{s:1:"a";i:140;s:1:"b";s:45:"force_delete_permohonan::det::med::kom::cetak";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:140;a:4:{s:1:"a";i:141;s:1:"b";s:49:"force_delete_any_permohonan::det::med::kom::cetak";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:141;a:4:{s:1:"a";i:142;s:1:"b";s:42:"view_permohonan::det::med::kom::elektronik";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:142;a:4:{s:1:"a";i:143;s:1:"b";s:46:"view_any_permohonan::det::med::kom::elektronik";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:143;a:4:{s:1:"a";i:144;s:1:"b";s:44:"create_permohonan::det::med::kom::elektronik";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:144;a:4:{s:1:"a";i:145;s:1:"b";s:44:"update_permohonan::det::med::kom::elektronik";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:145;a:4:{s:1:"a";i:146;s:1:"b";s:45:"restore_permohonan::det::med::kom::elektronik";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:146;a:4:{s:1:"a";i:147;s:1:"b";s:49:"restore_any_permohonan::det::med::kom::elektronik";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:147;a:4:{s:1:"a";i:148;s:1:"b";s:47:"replicate_permohonan::det::med::kom::elektronik";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:148;a:4:{s:1:"a";i:149;s:1:"b";s:45:"reorder_permohonan::det::med::kom::elektronik";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:149;a:4:{s:1:"a";i:150;s:1:"b";s:44:"delete_permohonan::det::med::kom::elektronik";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:150;a:4:{s:1:"a";i:151;s:1:"b";s:48:"delete_any_permohonan::det::med::kom::elektronik";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:151;a:4:{s:1:"a";i:152;s:1:"b";s:50:"force_delete_permohonan::det::med::kom::elektronik";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:152;a:4:{s:1:"a";i:153;s:1:"b";s:54:"force_delete_any_permohonan::det::med::kom::elektronik";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}i:153;a:3:{s:1:"a";i:154;s:1:"b";s:19:"page_JadwalMedCetak";s:1:"c";s:3:"web";}i:154;a:4:{s:1:"a";i:155;s:1:"b";s:14:"create_layanan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:155;a:4:{s:1:"a";i:156;s:1:"b";s:18:"delete_any_layanan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:156;a:4:{s:1:"a";i:157;s:1:"b";s:14:"delete_layanan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:157;a:4:{s:1:"a";i:158;s:1:"b";s:26:"widget_StatsOverviewWidget";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:158;a:4:{s:1:"a";i:159;s:1:"b";s:20:"widget_StatsOverview";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:159;a:4:{s:1:"a";i:160;s:1:"b";s:29:"widget_DashboardAnggaranTable";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:160;a:4:{s:1:"a";i:161;s:1:"b";s:23:"widget_JenisKontenChart";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:161;a:4:{s:1:"a";i:162;s:1:"b";s:25:"widget_DashboardBalihoMap";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:162;a:4:{s:1:"a";i:163;s:1:"b";s:19:"widget_JadwalBaliho";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}}s:5:"roles";a:3:{i:0;a:4:{s:1:"a";i:1;s:1:"b";s:11:"super_admin";s:1:"c";s:3:"web";s:1:"j";N;}i:1;a:4:{s:1:"a";i:3;s:1:"b";s:5:"Admin";s:1:"c";s:3:"web";s:1:"j";N;}i:2;a:4:{s:1:"a";i:2;s:1:"b";s:8:"Pimpinan";s:1:"c";s:3:"web";s:1:"j";N;}}}', 1778170041);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `documentations`
--

CREATE TABLE IF NOT EXISTS `documentations` (
  `id` char(36) NOT NULL,
  `dokumentasiable_type` varchar(255) NOT NULL,
  `dokumentasiable_id` char(36) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tanggal_dokumentasi` date NOT NULL,
  `lokasi_file` varchar(255) NOT NULL,
  `jenis` enum('Desain','Publikasi','Pelepasan') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `documentations`
--

INSERT INTO `documentations` (`id`, `dokumentasiable_type`, `dokumentasiable_id`, `nama`, `tanggal_dokumentasi`, `lokasi_file`, `jenis`, `created_at`, `updated_at`) VALUES
('019ce820-9d9a-7228-9406-5195bc3d8391', 'App\\Models\\PermohonanDetMedKomCetak', 'f3f649c7-af0c-41ac-9953-aff63a4c247f', NULL, '2026-02-11', 'dokumentasi_medkom/01KNXZHFV156PEEZ90PZ0C2YGP.png', 'Desain', '2026-03-13 09:56:17', '2026-04-11 02:56:32'),
('019ce820-9e06-7274-a410-bbc896a629b4', 'App\\Models\\PermohonanDetMedKomCetak', 'f3f649c7-af0c-41ac-9953-aff63a4c247f', NULL, '2026-02-17', 'dokumentasi_medkom/01KNXZHFV2GG2HP4PZXTS5ZHH1.png', 'Publikasi', '2026-03-13 09:56:17', '2026-04-11 02:56:32'),
('019ce82f-a3b7-7382-b979-6da211a66a43', 'App\\Models\\PermohonanDetMedKomCetak', '3690d8cc-c3fa-4245-ab41-52a551e8914b', NULL, '2026-03-11', 'dokumentasi_medkom/01KNXZK9FBR5VCTD00R2XJ689Y.png', 'Desain', '2026-03-13 10:12:42', '2026-04-11 02:57:31'),
('019cecb9-9af0-7257-9d61-da5488aadb41', 'App\\Models\\PermohonanDetMedKomElektronik', 'e0f39e65-a6ac-4479-9c3d-94eb8d328408', NULL, '2026-03-14', 'dokumentasi_medkom/01KKPBK6N2HTV274NBGWM2E2GP.png', 'Publikasi', '2026-03-14 07:21:52', '2026-03-14 07:21:52'),
('019d6bf0-521d-71bc-97da-ee0b21eb8454', 'App\\Models\\PermohonanDetMedKomElektronik', 'f6728747-97a0-4035-b7b0-bc9ecff4c6fd', 'Desain HUT Satpol PP', '2026-04-08', 'dokumentasi_medkom/01KNNZ5D3ERY48A8NJKQHH9Y4G.jpg', 'Desain', '2026-04-08 00:13:25', '2026-04-08 00:16:01'),
('019d6bf7-7988-7309-96b9-745f8faeb13f', 'App\\Models\\PermohonanDetMedKomElektronik', 'bcb9713e-6dc9-463f-a893-90bd3ca5eeb6', 'Sisi Utara', '2026-03-17', 'dokumentasi_medkom/01KNNZEYB2BJZDN5G3CAJPGSNN.jpg', 'Desain', '2026-04-08 00:21:13', '2026-04-08 00:27:03'),
('019d710f-9fe1-7264-9fe9-20cf06dfb2bd', 'App\\Models\\PermohonanDetMedKomCetak', 'd2dc932a-eccb-42e1-837b-eeef31d79919', 'DESIGN', '2026-02-20', 'dokumentasi_medkom/01KNRGZ7XRMNQ5A869FJW0AH2P.jpeg', 'Desain', '2026-04-09 00:05:42', '2026-04-11 03:46:14'),
('019d710f-a00c-71ed-8f96-753fe9077e31', 'App\\Models\\PermohonanDetMedKomCetak', 'd2dc932a-eccb-42e1-837b-eeef31d79919', 'PASANG', '2026-03-03', 'dokumentasi_medkom/01KNRGZ7XSNNVDWEEYQMF2WQ5N.jpeg', 'Publikasi', '2026-04-09 00:05:42', '2026-04-11 03:46:14'),
('019d7bd8-8183-72c2-a6a7-aa3221525e23', 'App\\Models\\PermohonanDetMedKomCetak', 'e144f970-1532-4ae7-8fd4-782510e0576e', 'Foto publikasi', '2026-02-06', 'dokumentasi_medkom/01KNXXH0AW35MJ7EWKQCBRKZKA.png', 'Publikasi', '2026-04-11 02:21:19', '2026-04-11 02:21:19'),
('019d7bfa-4a88-708c-b14a-6cf926b008ab', 'App\\Models\\PermohonanDetMedKomCetak', 'b7c87236-0c57-4b67-ac83-d2df1b23d193', NULL, '2026-02-11', 'dokumentasi_medkom/01KNXZMJK2DJ773FM6ZQSN4RM5.png', 'Publikasi', '2026-04-11 02:58:13', '2026-04-11 02:58:13'),
('019d7bfa-bfe3-712f-9e49-30126c9911ca', 'App\\Models\\PermohonanDetMedKomCetak', '7901c871-f4fe-44a4-8fc0-5372870d10cc', NULL, '2026-02-11', 'dokumentasi_medkom/01KNXZNFXWKH5MWQKBJWT8FKYG.png', 'Desain', '2026-04-11 02:58:43', '2026-04-11 02:58:43'),
('019d7c08-5c0b-7252-a6f1-ec3eadf12050', 'App\\Models\\PermohonanDetMedKomCetak', '411c7dcc-92c1-47db-8caf-53a346a5480e', NULL, '2026-02-27', 'dokumentasi_medkom/01KNY0GPZ5FVX6VQPQ309XR4PE.png', 'Publikasi', '2026-04-11 03:13:35', '2026-04-11 03:13:35'),
('019d7c12-02ce-70a3-accf-3db0086ba6b9', 'App\\Models\\PermohonanDetMedKomCetak', '60ce09f1-7baf-4f5f-a004-50dd93610b73', NULL, '2026-02-27', 'dokumentasi_medkom/01KNY140N4JPAQWMEB0STS7KMP.png', 'Publikasi', '2026-04-11 03:24:08', '2026-04-11 03:24:08'),
('019d7c1f-787f-73e8-bf58-2ababe859402', 'App\\Models\\PermohonanDetMedKomCetak', '3e68a8e9-e04c-46c7-b3ea-a44040d54fae', NULL, '2026-03-03', 'dokumentasi_medkom/01KNY1YY2R52VP3DT57Q9MX252.png', 'Publikasi', '2026-04-11 03:38:50', '2026-04-11 03:46:47'),
('019d7c24-0d77-70d8-979f-6d24ed55f212', 'App\\Models\\PermohonanDetMedKomCetak', 'be7dc20f-d06e-4b51-85fd-24d4df810324', NULL, '2026-03-03', 'dokumentasi_medkom/01KNY283AECX207Z2PZW31D53B.png', 'Publikasi', '2026-04-11 03:43:50', '2026-04-11 03:43:50'),
('019d7c24-0d9f-70a2-bc1b-af038bae66bc', 'App\\Models\\PermohonanDetMedKomCetak', 'be7dc20f-d06e-4b51-85fd-24d4df810324', NULL, '2026-03-16', 'dokumentasi_medkom/01KNY283AFE4EVSXNNF8Z557D7.png', 'Pelepasan', '2026-04-11 03:43:50', '2026-04-11 03:43:50'),
('019d7c26-3e77-716b-9d38-c12d854de1d3', 'App\\Models\\PermohonanDetMedKomCetak', 'd2dc932a-eccb-42e1-837b-eeef31d79919', NULL, '2026-03-16', 'dokumentasi_medkom/01KNY2CFFZVG87YMDFSW2QAXXG.png', 'Pelepasan', '2026-04-11 03:46:14', '2026-04-11 03:46:14'),
('019d7c35-4892-7252-82d0-d81dce829b3b', 'App\\Models\\PermohonanDetMedKomCetak', '096aa09a-c52f-467b-8d9a-00d29acde206', NULL, '2026-03-12', 'dokumentasi_medkom/01KNY3AJ3BXN12T3C517Q0WPWR.png', 'Publikasi', '2026-04-11 04:02:40', '2026-04-11 04:02:40'),
('019d7c36-2ae9-7391-b08c-0c28e16820db', 'App\\Models\\PermohonanDetMedKomCetak', '46995870-f862-4a39-8ff3-9334db4c508e', NULL, '2026-03-12', 'dokumentasi_medkom/01KNY3CAP2GV9FK6NEN4XVJE5W.png', 'Publikasi', '2026-04-11 04:03:37', '2026-04-11 04:03:37'),
('019d7c42-b4ae-711b-8063-fca5268ccddc', 'App\\Models\\PermohonanDetMedKomCetak', 'c40d1452-147b-4680-aa3f-d64d28139728', NULL, '2026-03-12', 'dokumentasi_medkom/01KNY45D470WXV5Z4N3W8YP09E.png', 'Publikasi', '2026-04-11 04:17:19', '2026-04-11 04:17:19'),
('019d7c93-3094-716b-bfab-95a7598a1c4f', 'App\\Models\\PermohonanDetMedKomCetak', '3690d8cc-c3fa-4245-ab41-52a551e8914b', NULL, '2026-02-15', 'dokumentasi_medkom/01KNY96C2E99B3C7GF8XRXREMP.jpeg', 'Pelepasan', '2026-04-11 05:45:14', '2026-04-11 05:45:14'),
('019d7c95-642b-7325-b197-2123198618c3', 'App\\Models\\PermohonanDetMedKomCetak', 'b7c87236-0c57-4b67-ac83-d2df1b23d193', NULL, '2026-02-25', 'dokumentasi_medkom/01KNY9ARZ561C7STDT7B9WQWFD.jpeg', 'Pelepasan', '2026-04-11 05:47:38', '2026-04-11 05:47:38'),
('019d7ca7-68a6-7371-842e-23ea86b5b22d', 'App\\Models\\PermohonanDetMedKomCetak', '538bb82c-6c71-4d09-93cc-cdd6132b92c6', NULL, '2026-03-13', 'dokumentasi_medkom/01KNYAET3YG8XAA9E9K7VME03E.png', 'Publikasi', '2026-04-11 06:07:19', '2026-04-11 06:07:19'),
('019d7ca8-228e-72b0-b015-e601e8674f7e', 'App\\Models\\PermohonanDetMedKomCetak', 'ae447148-8f6b-45aa-9484-a99e2a781a9c', NULL, '2026-03-13', 'dokumentasi_medkom/01KNYAG8K4H6FM5ZVCW01X509S.png', 'Publikasi', '2026-04-11 06:08:06', '2026-04-11 06:08:06'),
('019d7caa-70f5-72a8-b991-88b48484b684', 'App\\Models\\PermohonanDetMedKomCetak', '7901c871-f4fe-44a4-8fc0-5372870d10cc', NULL, '2026-02-27', 'dokumentasi_medkom/01KNYAMW5FXZBX1P9SFDFE62CW.jpeg', 'Pelepasan', '2026-04-11 06:10:38', '2026-04-11 06:10:38'),
('019d7cb0-4832-7222-8b94-e850a92251ba', 'App\\Models\\PermohonanDetMedKomCetak', 'b8f30833-90f7-4216-abd3-fc72a3ba2651', NULL, '2026-03-13', 'dokumentasi_medkom/01KNYB0J0AM2N3YVT9R5MR1H4S.png', 'Publikasi', '2026-04-11 06:17:00', '2026-04-11 06:17:00'),
('019d7cb2-7209-7131-9199-66b45964c5f5', 'App\\Models\\PermohonanDetMedKomElektronik', '6067b641-f455-4ee3-9e02-80530abd89c9', NULL, '2025-12-29', 'dokumentasi_medkom/01KNYB4WF31WMJ6MCESJ45BR7P.', 'Desain', '2026-04-11 06:19:22', '2026-04-11 06:20:02'),
('019d7cb5-a2c0-7169-9147-0ab599772adc', 'App\\Models\\PermohonanDetMedKomElektronik', 'cb309405-b4a7-4bc3-86d2-0733b0612ae3', NULL, '2026-02-13', 'dokumentasi_medkom/01KNYBB8MTK9KPNB29EPET16CR.', 'Desain', '2026-04-11 06:22:51', '2026-04-11 06:22:51'),
('019d7cb6-ad01-70e0-a724-ecc579774ac0', 'App\\Models\\PermohonanDetMedKomElektronik', 'e02fe67d-8a56-469e-810d-95a01788b524', NULL, '2026-02-16', 'dokumentasi_medkom/01KNYBDB6WEKVX4DXGGTD0V28W.', 'Desain', '2026-04-11 06:23:59', '2026-04-11 06:23:59'),
('019d7cb7-5b0d-7032-9506-5f63c8233fb6', 'App\\Models\\PermohonanDetMedKomElektronik', 'c057a102-8771-439e-a448-b799d9f4016c', NULL, '2026-02-16', 'dokumentasi_medkom/01KNYBEPQ8XV5FZAB47D2S9WX3.', 'Desain', '2026-04-11 06:24:44', '2026-04-11 06:24:44'),
('019d7cb7-d82f-7151-9830-979109543cb2', 'App\\Models\\PermohonanDetMedKomElektronik', 'a7f8a3eb-341f-46e7-b6e8-152667d6b426', NULL, '2026-02-20', 'dokumentasi_medkom/01KNYBFP09CVHRVRS9QRWH1P0M.', 'Desain', '2026-04-11 06:25:16', '2026-04-11 06:25:16'),
('019d7cb8-7459-73b5-b516-927606fbdd5e', 'App\\Models\\PermohonanDetMedKomElektronik', '529f0386-9123-48bd-abe5-13cc02c6fc7f', NULL, '2026-02-24', 'dokumentasi_medkom/01KNYBGX1MW7XJ7TJH3ND2FB72.', 'Desain', '2026-04-11 06:25:56', '2026-04-11 06:25:56'),
('019d7cbc-9a67-730e-9603-2a1a52cd425e', 'App\\Models\\PermohonanDetMedKomElektronik', '223fa146-fe83-45dd-a936-f5b1bab9f0cf', NULL, '2026-03-17', 'dokumentasi_medkom/01KNYBS6J0VFT15AJWYEEHA2VW.', 'Desain', '2026-04-11 06:30:28', '2026-04-11 06:30:28'),
('019d7cbd-5d88-71bc-a3a5-ddb186f746b5', 'App\\Models\\PermohonanDetMedKomElektronik', '5050190a-7b2f-44c5-a778-1d157f2ace33', NULL, '2026-03-17', 'dokumentasi_medkom/01KNYBTQB4VBDXRSZ6TPQAGADY.', 'Desain', '2026-04-11 06:31:18', '2026-04-11 06:31:18'),
('019d7cbf-e9f4-7384-a562-6b1735fe616f', 'App\\Models\\PermohonanDetMedKomElektronik', 'ff3836b5-0e41-4a6f-ae61-82b7bc25f4f4', NULL, '2026-03-17', 'dokumentasi_medkom/01KNYBZTEE29ZAGQ8422WRXQFK.', 'Desain', '2026-04-11 06:34:05', '2026-04-11 06:34:05'),
('019d7cd8-a970-719d-b6c2-aae5fd795574', 'App\\Models\\PermohonanDetMedKomCetak', 'b685b092-107d-4159-8c0d-a5006f92b878', NULL, '2026-03-27', 'dokumentasi_medkom/01KNYDHAAAA5139TVNNAE6CB6F.png', 'Publikasi', '2026-04-11 07:01:07', '2026-04-11 07:01:07'),
('019d7ce2-f1a0-7049-b855-6fe3e3551894', 'App\\Models\\PermohonanDetMedKomCetak', '42ea76aa-1499-4b50-8875-ac1184cf46ac', NULL, '2026-04-02', 'dokumentasi_medkom/01KNYE5WBS3K67CQ66MHS026HZ.png', 'Publikasi', '2026-04-11 07:12:21', '2026-04-11 07:12:21'),
('019d7ce3-8225-70d4-bea4-a01f3bafb97a', 'App\\Models\\PermohonanDetMedKomCetak', '71ec9301-181e-43ba-aff8-212638242d1f', NULL, '2026-04-11', 'dokumentasi_medkom/01KNYE70FYVB165VXC71FRRVAE.png', 'Publikasi', '2026-04-11 07:12:58', '2026-04-11 07:12:58'),
('019d7cec-d802-7252-93c5-992079bca938', 'App\\Models\\PermohonanDetMedKomCetak', 'a6abb37c-1bef-4cfb-b2ee-c6936a9e5603', NULL, '2026-03-17', 'dokumentasi_medkom/01KNYESNYTFE3AFNSTQSMDZFXQ.png', 'Desain', '2026-04-11 07:23:09', '2026-04-11 07:23:09'),
('019d7cec-d828-70b8-aa4b-51b4f4eb2e14', 'App\\Models\\PermohonanDetMedKomCetak', 'a6abb37c-1bef-4cfb-b2ee-c6936a9e5603', NULL, '2026-03-25', 'dokumentasi_medkom/01KNYESNYW0C239T957T7CWX4V.png', 'Publikasi', '2026-04-11 07:23:09', '2026-04-11 07:23:09'),
('019d7cf1-f637-7115-bd45-e97424ac575d', 'App\\Models\\PermohonanDetMedKomCetak', 'ed8e08cd-b709-4865-8859-11c9d34332bb', NULL, '2026-03-30', 'dokumentasi_medkom/01KNYF3XGDK8AX20G24D4SHC55.png', 'Desain', '2026-04-11 07:28:45', '2026-04-11 07:28:45'),
('019d7cf1-f660-7332-9aa2-8cd13c455375', 'App\\Models\\PermohonanDetMedKomCetak', 'ed8e08cd-b709-4865-8859-11c9d34332bb', NULL, '2026-04-01', 'dokumentasi_medkom/01KNYF3XGFSNAHWMGCX4R75NPP.jpeg', 'Publikasi', '2026-04-11 07:28:45', '2026-04-11 07:28:45'),
('019df0f0-fc3a-7275-897e-33ff543bf09c', 'App\\Models\\PermohonanDetMedKomCetak', 'd9565b20-658b-41f2-ae0d-b6e9728cf8ad', NULL, '2026-04-02', 'dokumentasi_medkom/01KQRF1Z0KQW3JP146JPHKZAQD.jpeg', 'Publikasi', '2026-05-03 20:03:38', '2026-05-03 20:03:38'),
('019df0f2-8178-71df-a257-e6265c05a94a', 'App\\Models\\PermohonanDetMedKomCetak', '7642f237-06b7-4185-a94a-c13db1632163', NULL, '2026-04-02', 'dokumentasi_medkom/01KQRF50A7Q84PSGA5ZHGBS352.jpeg', 'Publikasi', '2026-05-03 20:05:17', '2026-05-03 20:05:17'),
('019df0f3-66fb-72cc-9f41-ea6fa634822a', 'App\\Models\\PermohonanDetMedKomCetak', '731bb3c4-1a51-44e4-a921-04bdaeb2f601', NULL, '2026-04-02', 'dokumentasi_medkom/01KQRF6SPF40ZKYEDA5NZ8AG6K.jpeg', 'Publikasi', '2026-05-03 20:06:16', '2026-05-03 20:06:16'),
('019df259-61d1-71c9-88ae-62e27cf05137', 'App\\Models\\PermohonanDetMedKomCetak', '02cafb67-be04-4d59-a659-22716ee1b6d2', NULL, '2026-04-20', 'dokumentasi_medkom/01KQS5JRDBWGQHXY6V356JJTS8.jpeg', 'Publikasi', '2026-05-04 02:37:17', '2026-05-04 02:37:17'),
('019df34d-7113-73a2-b11a-7735586511c8', 'App\\Models\\PermohonanDetMedKomCetak', '236a9144-2f44-4479-81c8-74a09b026aa2', NULL, '2026-04-21', 'dokumentasi_medkom/01KQSMTW7BE5RV0WSWNDB4DGZ0.png', 'Publikasi', '2026-05-04 07:03:51', '2026-05-04 07:03:51'),
('019df363-3d00-731c-ad9f-1b52d5b53595', 'App\\Models\\PermohonanDetMedKomCetak', '07e8a412-b83a-4eb4-af09-587831a08e56', NULL, '2026-04-26', 'dokumentasi_medkom/01KQSP6F6WA79ABGDJYEVVHA5K.jpeg', 'Publikasi', '2026-05-04 07:27:40', '2026-05-04 07:27:40'),
('019df364-9a95-727c-be69-25d32a31c68d', 'App\\Models\\PermohonanDetMedKomCetak', 'ec96aa08-91c3-4bab-b60e-59f04d4db5f9', NULL, '2026-04-26', 'dokumentasi_medkom/01KQSP96KGAXTDDX4HQN9X2PZS.jpeg', 'Publikasi', '2026-05-04 07:29:09', '2026-05-04 07:29:09'),
('019df367-1613-73ef-8274-a8b80cdcf488', 'App\\Models\\PermohonanDetMedKomCetak', '95e1bdfc-bfa5-46cd-87c6-f8c1d1bf40a4', NULL, '2026-04-26', 'dokumentasi_medkom/01KQSPE5FBW5TVE1CR54KH4AAE.jpeg', 'Publikasi', '2026-05-04 07:31:52', '2026-05-04 07:31:52'),
('019df372-a147-719e-a356-3866d842f0e4', 'App\\Models\\PermohonanDetMedKomCetak', '02cafb67-be04-4d59-a659-22716ee1b6d2', NULL, '2026-05-04', 'dokumentasi_medkom/01KQSQ5884WDE06QKK7J4EWCMY.jpeg', 'Pelepasan', '2026-05-04 07:44:29', '2026-05-04 07:44:29'),
('019df38a-4948-7317-8dba-209c69ee9f80', 'App\\Models\\PermohonanDetMedKomCetak', '74be65b5-dfb5-421a-8902-6158003ec164', NULL, '2026-04-27', 'dokumentasi_medkom/01KQSRMJ94XZJFVY18QQ5BKNPT.jpeg', 'Desain', '2026-05-04 08:10:19', '2026-05-04 08:10:19'),
('019df38a-4966-72e6-b6fe-07287d615476', 'App\\Models\\PermohonanDetMedKomCetak', '74be65b5-dfb5-421a-8902-6158003ec164', NULL, '2026-05-03', 'dokumentasi_medkom/01KQSRMJ95KF34AMARV64KY1AQ.jpeg', 'Publikasi', '2026-05-04 08:10:19', '2026-05-04 08:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `dokumentasi_med_koms`
--

CREATE TABLE IF NOT EXISTS `dokumentasi_med_koms` (
  `id` char(36) NOT NULL,
  `dokumentasiable_type` varchar(255) NOT NULL,
  `dokumentasiable_id` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_dokumentasi` date NOT NULL,
  `lokasi_file` varchar(255) NOT NULL,
  `jenis` enum('Desain','Publikasi','Pelepasan') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatans`
--

CREATE TABLE IF NOT EXISTS `kegiatans` (
  `id` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `layanan_id` varchar(255) NOT NULL,
  `dengan_anggaran` char(1) NOT NULL,
  `aktif` char(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `nama`, `layanan_id`, `dengan_anggaran`, `aktif`, `created_at`, `updated_at`) VALUES
('76a8d937-6879-4f36-91af-4bef7c8771ce', 'Running Text', 'c9730c78-1a46-4cf4-b75d-aaaf9fbfda56', '0', '1', '2026-01-14 23:38:23', '2026-02-26 19:12:29'),
('9e9e8cf5-d669-4088-bf31-94fdce52779c', 'Brosur/Flyer/Leaflet A5', '0c2ce546-aa59-4f23-8954-a03bcf5f5bb1', '1', '1', '2026-01-13 00:17:23', '2026-01-13 00:17:23'),
('bd7e01de-430d-4336-8774-ed70142171d9', 'Baliho', '0c2ce546-aa59-4f23-8954-a03bcf5f5bb1', '1', '1', '2026-01-13 00:14:39', '2026-01-13 00:14:39'),
('cd6d6a81-e472-480b-8bf4-7144c0e75ed7', 'Tabloid', '0c2ce546-aa59-4f23-8954-a03bcf5f5bb1', '1', '1', '2026-01-13 00:17:33', '2026-01-13 00:17:33'),
('e32537d5-e045-4762-9f8a-70880b52d0bd', 'Spanduk/ Backdrop/ Banner', '0c2ce546-aa59-4f23-8954-a03bcf5f5bb1', '1', '1', '2026-01-13 00:15:47', '2026-01-13 00:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_02_035419_rubah_tabel_users', 1),
(5, '2025_10_02_035805_buat_tabel_instansi', 1),
(6, '2025_10_02_040857_rubah_tabel_user_lagi', 1),
(7, '2025_10_02_061010_buat_tabel_baliho', 1),
(8, '2025_10_02_092111_add_foto_profil_to_users_table', 1),
(9, '2025_10_03_065915_buat_tabel_layanan', 1),
(10, '2025_10_08_030301_add_kode_layanan_to_tbl_layanan_table', 1),
(11, '2025_10_08_123615_create_permission_tables', 1),
(12, '2025_10_08_133436_update_user_id_on_sessions_table', 1),
(13, '2026_01_11_035406_edit_tbl_layanan', 2),
(19, '2026_01_11_041846_edit_tbl_instansi', 3),
(20, '2026_01_11_052004_create_kegiatans_table', 3),
(21, '2026_01_11_052558_create_jenis_spanduks_table', 3),
(22, '2026_01_11_052611_create_ukuran_balihos_table', 3),
(23, '2026_01_11_052759_create_titik_balihos_table', 3),
(24, '2026_01_11_055931_create_anggaran_belanjas_table', 4),
(25, '2026_01_11_060153_create_permohonans_table', 5),
(26, '2026_01_11_063758_create_permohonan_layanans_table', 5),
(27, '2026_01_11_064400_create_permohonan_det_running_texts_table', 5),
(28, '2026_01_11_064409_create_permohonan_det_spanduks_table', 5),
(29, '2026_01_11_064416_create_permohonan_det_balihos_table', 5),
(31, '2026_01_13_144038_create_tahun_anggarans_table', 6),
(32, '2026_01_13_144305_update_anggaran_belanja_table', 7),
(33, '2026_01_15_135945_edit_titik_baliho', 8),
(38, '2026_01_21_023755_create_permohonan_det_media_komunikasi_cetaks_table', 9),
(39, '2026_02_14_145803_create_permohonan_det_med_kom_elektroniks_table', 9),
(40, '2026_03_01_053736_edit_anggaran_belanja', 10),
(43, '2026_03_01_125843_editmedkomcetak', 11),
(44, '2026_03_11_005643_create_dokumentasi_med_koms_table', 12),
(46, '2026_03_24_142639_edit_roles', 13);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 'cb93b0ae-61fd-466c-b454-153d6ba83123'),
(2, 'App\\Models\\User', '8c09c324-fae4-4f95-8aea-8970cdde4490'),
(3, 'App\\Models\\User', '549ab1b1-075d-47e9-8013-e1f3a4127e6d');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_role', 'web', '2025-10-10 17:25:34', '2025-10-10 17:25:34'),
(2, 'view_any_role', 'web', '2025-10-10 17:25:36', '2025-10-10 17:25:36'),
(3, 'create_role', 'web', '2025-10-10 17:25:36', '2025-10-10 17:25:36'),
(4, 'update_role', 'web', '2025-10-10 17:25:36', '2025-10-10 17:25:36'),
(5, 'restore_role', 'web', '2025-10-10 17:25:36', '2025-10-10 17:25:36'),
(6, 'restore_any_role', 'web', '2025-10-10 17:25:36', '2025-10-10 17:25:36'),
(7, 'replicate_role', 'web', '2025-10-10 17:25:36', '2025-10-10 17:25:36'),
(8, 'reorder_role', 'web', '2025-10-10 17:25:36', '2025-10-10 17:25:36'),
(9, 'delete_role', 'web', '2025-10-10 17:25:36', '2025-10-10 17:25:36'),
(10, 'delete_any_role', 'web', '2025-10-10 17:25:36', '2025-10-10 17:25:36'),
(11, 'force_delete_role', 'web', '2025-10-10 17:25:36', '2025-10-10 17:25:36'),
(12, 'force_delete_any_role', 'web', '2025-10-10 17:25:36', '2025-10-10 17:25:36'),
(13, 'view_baliho', 'web', '2025-10-10 17:29:53', '2025-10-10 17:29:53'),
(14, 'view_any_baliho', 'web', '2025-10-10 17:29:54', '2025-10-10 17:29:54'),
(15, 'create_baliho', 'web', '2025-10-10 17:29:54', '2025-10-10 17:29:54'),
(16, 'update_baliho', 'web', '2025-10-10 17:29:54', '2025-10-10 17:29:54'),
(17, 'restore_baliho', 'web', '2025-10-10 17:29:54', '2025-10-10 17:29:54'),
(18, 'restore_any_baliho', 'web', '2025-10-10 17:29:54', '2025-10-10 17:29:54'),
(19, 'replicate_baliho', 'web', '2025-10-10 17:29:54', '2025-10-10 17:29:54'),
(20, 'reorder_baliho', 'web', '2025-10-10 17:29:54', '2025-10-10 17:29:54'),
(21, 'delete_baliho', 'web', '2025-10-10 17:29:54', '2025-10-10 17:29:54'),
(22, 'delete_any_baliho', 'web', '2025-10-10 17:29:54', '2025-10-10 17:29:54'),
(23, 'force_delete_baliho', 'web', '2025-10-10 17:29:54', '2025-10-10 17:29:54'),
(24, 'force_delete_any_baliho', 'web', '2025-10-10 17:29:54', '2025-10-10 17:29:54'),
(25, 'view_instansi', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(26, 'view_any_instansi', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(27, 'create_instansi', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(28, 'update_instansi', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(29, 'restore_instansi', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(30, 'restore_any_instansi', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(31, 'replicate_instansi', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(32, 'reorder_instansi', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(33, 'delete_instansi', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(34, 'delete_any_instansi', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(35, 'force_delete_instansi', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(36, 'force_delete_any_instansi', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(37, 'view_user', 'web', '2025-10-10 17:29:55', '2025-10-10 17:29:55'),
(38, 'view_any_user', 'web', '2025-10-10 17:29:56', '2025-10-10 17:29:56'),
(39, 'create_user', 'web', '2025-10-10 17:29:56', '2025-10-10 17:29:56'),
(40, 'update_user', 'web', '2025-10-10 17:29:56', '2025-10-10 17:29:56'),
(41, 'restore_user', 'web', '2025-10-10 17:29:56', '2025-10-10 17:29:56'),
(42, 'restore_any_user', 'web', '2025-10-10 17:29:56', '2025-10-10 17:29:56'),
(43, 'replicate_user', 'web', '2025-10-10 17:29:56', '2025-10-10 17:29:56'),
(44, 'reorder_user', 'web', '2025-10-10 17:29:56', '2025-10-10 17:29:56'),
(45, 'delete_user', 'web', '2025-10-10 17:29:56', '2025-10-10 17:29:56'),
(46, 'delete_any_user', 'web', '2025-10-10 17:29:56', '2025-10-10 17:29:56'),
(47, 'force_delete_user', 'web', '2025-10-10 17:29:56', '2025-10-10 17:29:56'),
(48, 'force_delete_any_user', 'web', '2025-10-10 17:29:56', '2025-10-10 17:29:56'),
(49, 'view_layanan', 'web', '2026-01-12 18:13:12', '2026-01-12 18:13:12'),
(50, 'view_any_layanan', 'web', '2026-01-12 18:13:12', '2026-01-12 18:13:12'),
(51, 'update_layanan', 'web', '2026-01-12 18:13:12', '2026-01-12 18:13:12'),
(52, 'restore_layanan', 'web', '2026-01-12 18:13:12', '2026-01-12 18:13:12'),
(53, 'restore_any_layanan', 'web', '2026-01-12 18:13:12', '2026-01-12 18:13:12'),
(54, 'replicate_layanan', 'web', '2026-01-12 18:13:12', '2026-01-12 18:13:12'),
(55, 'reorder_layanan', 'web', '2026-01-12 18:13:12', '2026-01-12 18:13:12'),
(56, 'force_delete_layanan', 'web', '2026-01-12 18:13:12', '2026-01-12 18:13:12'),
(57, 'force_delete_any_layanan', 'web', '2026-01-12 18:13:12', '2026-01-12 18:13:12'),
(58, 'view_tahun::anggaran', 'web', '2026-01-13 08:44:29', '2026-01-13 08:44:29'),
(59, 'view_any_tahun::anggaran', 'web', '2026-01-13 08:44:29', '2026-01-13 08:44:29'),
(60, 'create_tahun::anggaran', 'web', '2026-01-13 08:44:29', '2026-01-13 08:44:29'),
(61, 'update_tahun::anggaran', 'web', '2026-01-13 08:44:29', '2026-01-13 08:44:29'),
(62, 'restore_tahun::anggaran', 'web', '2026-01-13 08:44:29', '2026-01-13 08:44:29'),
(63, 'restore_any_tahun::anggaran', 'web', '2026-01-13 08:44:30', '2026-01-13 08:44:30'),
(64, 'replicate_tahun::anggaran', 'web', '2026-01-13 08:44:30', '2026-01-13 08:44:30'),
(65, 'reorder_tahun::anggaran', 'web', '2026-01-13 08:44:30', '2026-01-13 08:44:30'),
(66, 'delete_tahun::anggaran', 'web', '2026-01-13 08:44:30', '2026-01-13 08:44:30'),
(67, 'delete_any_tahun::anggaran', 'web', '2026-01-13 08:44:30', '2026-01-13 08:44:30'),
(68, 'force_delete_tahun::anggaran', 'web', '2026-01-13 08:44:30', '2026-01-13 08:44:30'),
(69, 'force_delete_any_tahun::anggaran', 'web', '2026-01-13 08:44:30', '2026-01-13 08:44:30'),
(70, 'view_anggaran', 'web', '2026-01-14 20:24:16', '2026-01-14 20:24:16'),
(71, 'view_any_anggaran', 'web', '2026-01-14 20:24:16', '2026-01-14 20:24:16'),
(72, 'create_anggaran', 'web', '2026-01-14 20:24:16', '2026-01-14 20:24:16'),
(73, 'update_anggaran', 'web', '2026-01-14 20:24:17', '2026-01-14 20:24:17'),
(74, 'restore_anggaran', 'web', '2026-01-14 20:24:17', '2026-01-14 20:24:17'),
(75, 'restore_any_anggaran', 'web', '2026-01-14 20:24:17', '2026-01-14 20:24:17'),
(76, 'replicate_anggaran', 'web', '2026-01-14 20:24:17', '2026-01-14 20:24:17'),
(77, 'reorder_anggaran', 'web', '2026-01-14 20:24:17', '2026-01-14 20:24:17'),
(78, 'delete_anggaran', 'web', '2026-01-14 20:24:17', '2026-01-14 20:24:17'),
(79, 'delete_any_anggaran', 'web', '2026-01-14 20:24:18', '2026-01-14 20:24:18'),
(80, 'force_delete_anggaran', 'web', '2026-01-14 20:24:18', '2026-01-14 20:24:18'),
(81, 'force_delete_any_anggaran', 'web', '2026-01-14 20:24:18', '2026-01-14 20:24:18'),
(82, 'view_anggaran::belanja', 'web', '2026-01-14 20:35:47', '2026-01-14 20:35:47'),
(83, 'view_any_anggaran::belanja', 'web', '2026-01-14 20:35:47', '2026-01-14 20:35:47'),
(84, 'create_anggaran::belanja', 'web', '2026-01-14 20:35:48', '2026-01-14 20:35:48'),
(85, 'update_anggaran::belanja', 'web', '2026-01-14 20:35:48', '2026-01-14 20:35:48'),
(86, 'restore_anggaran::belanja', 'web', '2026-01-14 20:35:48', '2026-01-14 20:35:48'),
(87, 'restore_any_anggaran::belanja', 'web', '2026-01-14 20:35:48', '2026-01-14 20:35:48'),
(88, 'replicate_anggaran::belanja', 'web', '2026-01-14 20:35:48', '2026-01-14 20:35:48'),
(89, 'reorder_anggaran::belanja', 'web', '2026-01-14 20:35:48', '2026-01-14 20:35:48'),
(90, 'delete_anggaran::belanja', 'web', '2026-01-14 20:35:48', '2026-01-14 20:35:48'),
(91, 'delete_any_anggaran::belanja', 'web', '2026-01-14 20:35:48', '2026-01-14 20:35:48'),
(92, 'force_delete_anggaran::belanja', 'web', '2026-01-14 20:35:49', '2026-01-14 20:35:49'),
(93, 'force_delete_any_anggaran::belanja', 'web', '2026-01-14 20:35:49', '2026-01-14 20:35:49'),
(94, 'view_ukuran::baliho', 'web', '2026-01-15 02:08:21', '2026-01-15 02:08:21'),
(95, 'view_any_ukuran::baliho', 'web', '2026-01-15 02:08:21', '2026-01-15 02:08:21'),
(96, 'create_ukuran::baliho', 'web', '2026-01-15 02:08:22', '2026-01-15 02:08:22'),
(97, 'update_ukuran::baliho', 'web', '2026-01-15 02:08:22', '2026-01-15 02:08:22'),
(98, 'restore_ukuran::baliho', 'web', '2026-01-15 02:08:22', '2026-01-15 02:08:22'),
(99, 'restore_any_ukuran::baliho', 'web', '2026-01-15 02:08:22', '2026-01-15 02:08:22'),
(100, 'replicate_ukuran::baliho', 'web', '2026-01-15 02:08:22', '2026-01-15 02:08:22'),
(101, 'reorder_ukuran::baliho', 'web', '2026-01-15 02:08:22', '2026-01-15 02:08:22'),
(102, 'delete_ukuran::baliho', 'web', '2026-01-15 02:08:22', '2026-01-15 02:08:22'),
(103, 'delete_any_ukuran::baliho', 'web', '2026-01-15 02:08:22', '2026-01-15 02:08:22'),
(104, 'force_delete_ukuran::baliho', 'web', '2026-01-15 02:08:22', '2026-01-15 02:08:22'),
(105, 'force_delete_any_ukuran::baliho', 'web', '2026-01-15 02:08:22', '2026-01-15 02:08:22'),
(106, 'view_titik::baliho', 'web', '2026-01-15 02:32:12', '2026-01-15 02:32:12'),
(107, 'view_any_titik::baliho', 'web', '2026-01-15 02:32:12', '2026-01-15 02:32:12'),
(108, 'create_titik::baliho', 'web', '2026-01-15 02:32:12', '2026-01-15 02:32:12'),
(109, 'update_titik::baliho', 'web', '2026-01-15 02:32:13', '2026-01-15 02:32:13'),
(110, 'restore_titik::baliho', 'web', '2026-01-15 02:32:13', '2026-01-15 02:32:13'),
(111, 'restore_any_titik::baliho', 'web', '2026-01-15 02:32:13', '2026-01-15 02:32:13'),
(112, 'replicate_titik::baliho', 'web', '2026-01-15 02:32:13', '2026-01-15 02:32:13'),
(113, 'reorder_titik::baliho', 'web', '2026-01-15 02:32:13', '2026-01-15 02:32:13'),
(114, 'delete_titik::baliho', 'web', '2026-01-15 02:32:13', '2026-01-15 02:32:13'),
(115, 'delete_any_titik::baliho', 'web', '2026-01-15 02:32:13', '2026-01-15 02:32:13'),
(116, 'force_delete_titik::baliho', 'web', '2026-01-15 02:32:13', '2026-01-15 02:32:13'),
(117, 'force_delete_any_titik::baliho', 'web', '2026-01-15 02:32:14', '2026-01-15 02:32:14'),
(118, 'view_permohonan', 'web', '2026-01-22 20:10:49', '2026-01-22 20:10:49'),
(119, 'view_any_permohonan', 'web', '2026-01-22 20:10:49', '2026-01-22 20:10:49'),
(120, 'create_permohonan', 'web', '2026-01-22 20:10:49', '2026-01-22 20:10:49'),
(121, 'update_permohonan', 'web', '2026-01-22 20:10:49', '2026-01-22 20:10:49'),
(122, 'restore_permohonan', 'web', '2026-01-22 20:10:49', '2026-01-22 20:10:49'),
(123, 'restore_any_permohonan', 'web', '2026-01-22 20:10:49', '2026-01-22 20:10:49'),
(124, 'replicate_permohonan', 'web', '2026-01-22 20:10:49', '2026-01-22 20:10:49'),
(125, 'reorder_permohonan', 'web', '2026-01-22 20:10:49', '2026-01-22 20:10:49'),
(126, 'delete_permohonan', 'web', '2026-01-22 20:10:49', '2026-01-22 20:10:49'),
(127, 'delete_any_permohonan', 'web', '2026-01-22 20:10:49', '2026-01-22 20:10:49'),
(128, 'force_delete_permohonan', 'web', '2026-01-22 20:10:49', '2026-01-22 20:10:49'),
(129, 'force_delete_any_permohonan', 'web', '2026-01-22 20:10:50', '2026-01-22 20:10:50'),
(130, 'view_permohonan::det::med::kom::cetak', 'web', '2026-03-08 03:00:46', '2026-03-08 03:00:46'),
(131, 'view_any_permohonan::det::med::kom::cetak', 'web', '2026-03-08 03:00:46', '2026-03-08 03:00:46'),
(132, 'create_permohonan::det::med::kom::cetak', 'web', '2026-03-08 03:00:47', '2026-03-08 03:00:47'),
(133, 'update_permohonan::det::med::kom::cetak', 'web', '2026-03-08 03:00:47', '2026-03-08 03:00:47'),
(134, 'restore_permohonan::det::med::kom::cetak', 'web', '2026-03-08 03:00:47', '2026-03-08 03:00:47'),
(135, 'restore_any_permohonan::det::med::kom::cetak', 'web', '2026-03-08 03:00:47', '2026-03-08 03:00:47'),
(136, 'replicate_permohonan::det::med::kom::cetak', 'web', '2026-03-08 03:00:47', '2026-03-08 03:00:47'),
(137, 'reorder_permohonan::det::med::kom::cetak', 'web', '2026-03-08 03:00:47', '2026-03-08 03:00:47'),
(138, 'delete_permohonan::det::med::kom::cetak', 'web', '2026-03-08 03:00:48', '2026-03-08 03:00:48'),
(139, 'delete_any_permohonan::det::med::kom::cetak', 'web', '2026-03-08 03:00:48', '2026-03-08 03:00:48'),
(140, 'force_delete_permohonan::det::med::kom::cetak', 'web', '2026-03-08 03:00:48', '2026-03-08 03:00:48'),
(141, 'force_delete_any_permohonan::det::med::kom::cetak', 'web', '2026-03-08 03:00:48', '2026-03-08 03:00:48'),
(142, 'view_permohonan::det::med::kom::elektronik', 'web', '2026-03-14 01:00:12', '2026-03-14 01:00:12'),
(143, 'view_any_permohonan::det::med::kom::elektronik', 'web', '2026-03-14 01:00:12', '2026-03-14 01:00:12'),
(144, 'create_permohonan::det::med::kom::elektronik', 'web', '2026-03-14 01:00:12', '2026-03-14 01:00:12'),
(145, 'update_permohonan::det::med::kom::elektronik', 'web', '2026-03-14 01:00:12', '2026-03-14 01:00:12'),
(146, 'restore_permohonan::det::med::kom::elektronik', 'web', '2026-03-14 01:00:13', '2026-03-14 01:00:13'),
(147, 'restore_any_permohonan::det::med::kom::elektronik', 'web', '2026-03-14 01:00:13', '2026-03-14 01:00:13'),
(148, 'replicate_permohonan::det::med::kom::elektronik', 'web', '2026-03-14 01:00:13', '2026-03-14 01:00:13'),
(149, 'reorder_permohonan::det::med::kom::elektronik', 'web', '2026-03-14 01:00:13', '2026-03-14 01:00:13'),
(150, 'delete_permohonan::det::med::kom::elektronik', 'web', '2026-03-14 01:00:13', '2026-03-14 01:00:13'),
(151, 'delete_any_permohonan::det::med::kom::elektronik', 'web', '2026-03-14 01:00:13', '2026-03-14 01:00:13'),
(152, 'force_delete_permohonan::det::med::kom::elektronik', 'web', '2026-03-14 01:00:13', '2026-03-14 01:00:13'),
(153, 'force_delete_any_permohonan::det::med::kom::elektronik', 'web', '2026-03-14 01:00:13', '2026-03-14 01:00:13'),
(154, 'page_JadwalMedCetak', 'web', '2026-03-24 05:33:32', '2026-03-24 05:33:32'),
(155, 'create_layanan', 'web', '2026-03-24 07:03:41', '2026-03-24 07:03:41'),
(156, 'delete_any_layanan', 'web', '2026-03-24 07:03:41', '2026-03-24 07:03:41'),
(157, 'delete_layanan', 'web', '2026-03-24 07:03:41', '2026-03-24 07:03:41'),
(158, 'widget_StatsOverviewWidget', 'web', '2026-03-24 16:21:01', '2026-03-24 16:21:01'),
(159, 'widget_StatsOverview', 'web', '2026-03-24 16:21:01', '2026-03-24 16:21:01'),
(160, 'widget_DashboardAnggaranTable', 'web', '2026-03-24 16:21:01', '2026-03-24 16:21:01'),
(161, 'widget_JenisKontenChart', 'web', '2026-03-24 16:21:01', '2026-03-24 16:21:01'),
(162, 'widget_DashboardBalihoMap', 'web', '2026-03-24 16:21:01', '2026-03-24 16:21:01'),
(163, 'widget_JadwalBaliho', 'web', '2026-03-24 16:21:01', '2026-03-24 16:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `permohonans`
--

CREATE TABLE IF NOT EXISTS `permohonans` (
  `id` char(36) NOT NULL,
  `instansi_id` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `isi_ringkas` text NOT NULL,
  `dengan_surat` char(1) NOT NULL,
  `no_surat` varchar(255) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `file_surat` varchar(255) DEFAULT NULL,
  `nama_narahubung` varchar(255) NOT NULL,
  `kontak_narahubung` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permohonans`
--

INSERT INTO `permohonans` (`id`, `instansi_id`, `perihal`, `isi_ringkas`, `dengan_surat`, `no_surat`, `tanggal_surat`, `file_surat`, `nama_narahubung`, `kontak_narahubung`, `created_at`, `updated_at`) VALUES
('07e4dbd9-2928-4f6b-8ea4-84a685889e94', '5a2c5757-7fbf-4870-a7c3-27d74bfecb50', 'Publikasi Running Text Februari', '-', '0', NULL, '2026-02-02', NULL, '-', '0000000', '2026-04-11 05:15:24', '2026-04-11 05:16:51'),
('0a73b3c0-2b5e-4b1b-aed9-8700a1549142', '5a2c5757-7fbf-4870-a7c3-27d74bfecb50', 'Permohonan fasilitasi baliho Ucapan Idulfitri ', 'Permohonan fasilitasi baliho ucapan selamat lebaran', '0', NULL, '2026-03-06', NULL, '-', '0000000000000', '2026-03-26 17:39:20', '2026-04-11 03:56:08'),
('0e91ea52-f2e2-48b6-8b76-068a70145634', '906d4380-940a-4e92-adac-735db5230c23', 'Publikasi Baliho Kejurkot PBSI Solo', 'Permohonan publikasi kegiatan dengan pemasangan baliho di wilayah Kota Surakarta', '1', '047/PBSI-SKA/IV/2026', '2026-04-26', 'surat_permohonan/01KQSNRA86QDMQ46JRQP1X8BX9.pdf', '-', '0000000', '2026-05-04 07:19:56', '2026-05-04 07:19:56'),
('1d242141-aa2e-4366-a7eb-74701aea4292', '2505865e-d3ad-494f-8168-0e03ce7115e8', 'Permohonana publikasi baliho event Pasar Pasaran by Hello Market Solo ', 'Permohonan Publikasi Baliho & Videotron Event Pasar Pasaran', '1', '7/HMS/III/2026', '2026-03-25', 'surat_permohonan/01KR05BK04YK795BPWYFRRE6D1.pdf', '-', '0000000', '2026-04-11 07:10:04', '2026-05-06 19:48:03'),
('4c7c004a-6d9d-493c-a3b7-f935e6d7d101', '02d5e50b-91f0-4fbf-b7b5-32547fe8819f', 'Acara Sumunar Adeging Praja Mangkunegaran ke 269', 'Permohonan izin dan dukungan titik baliho\n> Acara Sumunar Adeging Praja Mangkunegaran ke 269', '1', '667/MN-MA/II.A.3/A/III/2026', '2026-03-26', 'surat_permohonan/01KQRDYQ86YG699GGJZHV65ZZ9.pdf', '-', '0000000', '2026-05-03 19:44:23', '2026-05-03 19:44:23'),
('4e52dc1d-b98f-4add-a127-4be7c93a4631', '07c2b237-7f44-4889-889b-ad6923592b10', 'Permohonana publikasi baliho Event Lebaran Kota Solo', 'Permohonan Izin Pemakaian Titik Baliho', '1', 'B/500.13.3/927', '2026-03-10', 'surat_permohonan/01KR066NB4MBHQZJJQ70B0PF4X.pdf', 'Ibu Terry', '08781266674', '2026-04-11 05:52:57', '2026-05-06 20:02:50'),
('5bf8a36a-e08e-4e40-8781-61ca5143e4f3', '5a2c5757-7fbf-4870-a7c3-27d74bfecb50', 'Permohonana publikasi baliho HUT Kota Solo', 'Hari Jadi Kota Solo', '1', '-', '2026-02-10', 'surat_permohonan/01KNY2N50277SAJZQPD70HE2P4.pdf', '-', '00000000', '2026-01-24 03:28:39', '2026-04-11 03:51:00'),
('7f5a4117-b610-48da-a88b-ba6acb080508', '5a2c5757-7fbf-4870-a7c3-27d74bfecb50', 'Backdrop Upacara Peringatan Otonomi Daerah dan Hari Pendidikan Nasional', 'Backdrop Upacara Peringatan Otonomi Daerah dan Hari Pendidikan Nasional', '0', NULL, '2026-04-20', NULL, '-', '0000000', '2026-05-04 08:06:05', '2026-05-04 08:06:05'),
('8543ce7f-f04c-4245-b91d-3fd3fc751e5c', '5a2c5757-7fbf-4870-a7c3-27d74bfecb50', 'Cetak Backdrop Apel Bersama Pasca Lebaran', '-', '0', NULL, '2026-03-16', NULL, '-', '0000000', '2026-04-11 07:16:11', '2026-04-11 07:23:07'),
('9521fe4d-0761-4bb3-a8f8-1e0d4a338c77', 'b33c9dbe-221e-4f08-aacf-21849be3a0ea', 'Backdrop Upacara HUT SATPOL PP, SATLINMAS, dan DAMKAR', 'Permohonan backdrop 5x8 meter untuk upacara peringatan HUT ke-76 Satpol PP, ke-64 Satlinmas, dan ke-107 Damkar Tahun 2026', '1', 'B/300.1.2/698', '2026-03-12', 'surat_permohonan/01KR0551G8RE6TM2FFRJA8CN8M.pdf', '-', '0000000', '2026-04-11 07:24:59', '2026-05-06 19:44:28'),
('a261b2ba-c70b-4fba-80df-323618ba6a8c', '269a07b4-13a3-4e1b-949d-b2c0ea42b6f2', 'Permohonana publikasi baliho Berlangganan PDAM', 'PERMOHONAN IZIN PEMASANGAN BALIHO DAN IKLAN VISUAL', '1', '690/0202/PAM', '2026-02-09', 'surat_permohonan/01KR07PPMSMXQZEMMWFTVGX57Z.pdf', 'Much. Nur Fadjar Sutardjo', '085642099111', '2026-04-11 03:06:26', '2026-05-06 20:29:04'),
('a5100247-6762-41f8-82fd-f884416e2aa9', 'f226edd5-9c35-4a2e-a947-2406e80d4e96', 'Permohonana publikasi baliho UNI PARJO', 'Permohonan Izin Penggunaan Baliho', '1', '026/III/2026', '2026-03-16', 'surat_permohonan/01KR05MD6GEZ9WXA4A00Z5P3S7.pdf', 'Franky Simon', '085741240168', '2026-04-11 06:58:45', '2026-05-06 19:52:52'),
('ae629e70-a293-4492-a2ef-dfdb9751ee99', 'c6031350-34a7-49e0-8e57-000380949d1d', 'Permohonan fasilitas baliho', 'Permohonan Peminjaman Billboard', '1', '002/SPem/KTW-SS/GA/I/2026', '2026-01-09', 'surat_permohonan/01KR089PGYTF2W6ZXG5AKP4YF7.pdf', 'Madani Matadian', '089648719804', '2026-04-11 02:16:22', '2026-05-06 20:39:27'),
('afc96a42-41af-4a57-9e44-1616cd6d5c38', '5a2c5757-7fbf-4870-a7c3-27d74bfecb50', 'Publikasi Running Text Maret', '-', '0', NULL, '2026-03-02', NULL, '-', '0000000', '2026-04-11 05:16:13', '2026-04-11 05:16:13'),
('b4bb3c71-e525-483c-a8b2-4fe30ccdc9c3', '02d5e50b-91f0-4fbf-b7b5-32547fe8819f', 'Permohonan fasilitas baliho', 'Permohonan fasilitas baliho Adeging Projo Mangkunegaran', '1', '-', '2026-03-24', 'surat_permohonan/01KN1FF506C3GF44PPCBZAJ40N.pdf', '-', '00000000000', '2026-03-31 01:16:25', '2026-03-31 01:16:54'),
('b8dc2703-da7b-44f9-80dd-c5afcb2c7c60', 'ba8a6db1-a30b-4a54-94ee-242663594f67', 'Permohonana publikasi Sosialisasi BPJS Kesehatan', 'Permohonan Izin Peminjaman Media Informasi / Digital', '1', '423/VI-06/0126', '2026-01-28', 'surat_permohonan/01KR078V6T9E7WJXJR9PE87MF1.pdf', 'Frederikus Hardianto Wijoyo', '08112763934', '2026-04-11 03:20:10', '2026-05-06 20:21:30'),
('b92bfe5d-8017-498d-9bd5-e667d38f05aa', '269a07b4-13a3-4e1b-949d-b2c0ea42b6f2', 'Pemasangan Baliho Sosialisasi Air Minum Dalam Kemasan (AMDK)', 'Permohonan Pemasangan Baliho Sosialisasi Air Minum Dalam Kemasan (AMDK)\n> Perempatan Banjarsari Jalan Wolter Monginsidi', '1', '690/0432/PAM', '2026-04-13', 'surat_permohonan/01KQSMN101Y20K5X2J7V6HMG18.pdf', '-', '0000000', '2026-05-04 07:00:40', '2026-05-04 07:00:40'),
('bc08a005-f33d-4b13-8c40-36a65ed81f93', '5a2c5757-7fbf-4870-a7c3-27d74bfecb50', 'Publikasi Running Text Januari', '-', '0', NULL, '2026-01-01', NULL, '-', '0', '2026-04-08 00:11:27', '2026-04-11 05:14:43'),
('e488e138-9b5c-4243-8729-600681536200', '07c2b237-7f44-4889-889b-ad6923592b10', 'Permohonana publikasi baliho event di Balekambang', 'Permohonan Izin Pemakaian Titik Baliho', '1', 'B/500.13.3/973', '2026-03-12', 'surat_permohonan/01KR05Y73AXV22ZNDAWWGG94TT.pdf', 'Ibu Terry', '08781266674', '2026-04-11 06:14:27', '2026-05-06 19:58:13'),
('f53ebaca-0e59-48bd-830e-fa58c5476db3', '07c2b237-7f44-4889-889b-ad6923592b10', 'Permohonan publikasi Hari Tari Dunia dan Fasilitasi titik baliho', 'Permohonan Publikasi Hari Tari Dunia dan Fasilitasi titik baliho dan jaringan streaming\n> 28 - 29 April 2026', '1', 'B/500.13.3.3/1956', '2026-04-01', 'surat_permohonan/01KQS5170YJ7KNZAYKNSAWDDBX.pdf', 'Heru Mataya', '0816675808', '2026-05-04 02:27:42', '2026-05-04 02:27:42'),
('f7fe41f2-ed84-4699-a934-cf733686fd1f', 'aedb644d-7d18-458d-a6c6-92695e6cc595', 'Permohonan pinjam titik baliho', 'Sehubungan dengan pelaksanaan rangkaian kegiatan dalam rangka Dies Natalis Ke 50 Universitas Sebelas Maret Surakarta, kami bermaksud untuk mengajukan permohonan pemasangan baliho pada tanggal 01-31 Maret 2026 dengan tujuan sebagai media publikasi dan informasi kepada masyarakat tentang kegiatan Dies Natalis Ke 50 Universitas Sebelas Maret Surakarta. Adapun rencana pemasangan titik baliho yaitu:\n1.\nTitik Baliho Pasar Kleco (Patung Mbatik), 4M X 8M (Horizontal), Jl.Ahmad Yani Kleco.\n2.\nTitik Baliho Jurug, 4M X 8M (Horizontal), Jl.Ir Sutami.\n3.\nTitik Baliho Jajar Depan PDAM ( hadap Timur ), 4M X 8M (Horizontal), Jl.Adisucipto.\nKami menyatakan bersedia mematuhi seluruh ketentuan dan peraturan yang berlaku terkait pemasangan baliho serta memenuhi kewajiban administrasi sesuai peraturan daerah yang berlaku. Selanjutnya narahubung kegiatan tersebut Danang Hery Purwoko (085642182128).\nDemikian surat permohonan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih.', '1', '115/uns.27.26/RT02/2026', '2026-02-20', 'surat_permohonan/01KNRGRTA3HYFR1PBV9ZAV1XCA.pdf', 'danang', '085642182128', '2026-04-09 00:02:12', '2026-04-11 03:30:54'),
('f9eee0d0-a259-402e-95f4-066ffe9d15eb', '65d94339-c023-437f-9f82-948346c09a4d', 'Permohonan Fasilitasi Titik Baliho Reuni Perak Kasmaji 2001', 'Permohonan Fasilitasi Titik Baliho dan Videotron Reuni Perak Kasmaji 2001\n> 23 - 30 Mei 2026', '1', '009/RPK/V/2026', '2026-05-06', 'surat_permohonan/01KR04YTQ4AXX18E18M2RZ94WV.pdf', 'Wawan', '085641600038', '2026-05-06 19:41:05', '2026-05-06 19:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_det_med_kom_cetaks`
--

CREATE TABLE IF NOT EXISTS `permohonan_det_med_kom_cetaks` (
  `id` char(36) NOT NULL,
  `permohonan_id` varchar(255) NOT NULL,
  `anggaran_id` varchar(255) DEFAULT NULL,
  `kegiatan_id` varchar(255) DEFAULT NULL,
  `titik_baliho_id` varchar(255) DEFAULT NULL,
  `isi_konten` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `panjang` decimal(10,2) DEFAULT NULL,
  `lebar` decimal(10,2) DEFAULT NULL,
  `jumlah` int(11) DEFAULT 1,
  `volume_hitung` decimal(15,2) NOT NULL DEFAULT 1.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tgl_mulai_publikasi` date DEFAULT NULL,
  `tgl_selesai_publikasi` date DEFAULT NULL,
  `durasi_hari` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permohonan_det_med_kom_cetaks`
--

INSERT INTO `permohonan_det_med_kom_cetaks` (`id`, `permohonan_id`, `anggaran_id`, `kegiatan_id`, `titik_baliho_id`, `isi_konten`, `keterangan`, `panjang`, `lebar`, `jumlah`, `volume_hitung`, `created_at`, `updated_at`, `tgl_mulai_publikasi`, `tgl_selesai_publikasi`, `durasi_hari`) VALUES
('02cafb67-be04-4d59-a659-22716ee1b6d2', 'f53ebaca-0e59-48bd-830e-fa58c5476db3', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '4862ba02-298c-4033-a433-5e6826bc743d', 'Randown Solo Menari ', NULL, '4.00', '6.00', 1, '1.00', '2026-05-04 02:34:41', '2026-05-04 06:56:55', '2026-04-21', '2026-05-01', 11),
('07e8a412-b83a-4eb4-af09-587831a08e56', '0e91ea52-f2e2-48b6-8b76-068a70145634', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '431517b9-c5a7-4759-88f2-201ef06780a1', 'Kerjukot PBSI Piala Wali Kota', NULL, '4.00', '8.00', 1, '1.00', '2026-05-04 07:22:09', '2026-05-04 07:34:38', '2026-04-26', '2026-05-09', 14),
('096aa09a-c52f-467b-8d9a-00d29acde206', '0a73b3c0-2b5e-4b1b-aed9-8700a1549142', 'af09a15d-e6a4-4625-9fdb-dc6454cdcxxx', 'bd7e01de-430d-4336-8774-ed70142171d9', '07a90395-ecf9-4110-a997-d89f09e02e0e', 'Ucapan selamat idulfitri', NULL, '4.00', '6.00', 1, '1.00', '2026-04-11 04:00:47', '2026-04-11 04:00:47', '2026-03-13', '2026-03-27', 15),
('236a9144-2f44-4479-81c8-74a09b026aa2', 'b92bfe5d-8017-498d-9bd5-e667d38f05aa', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '4aa1865c-eecc-4964-a904-81d5ec180d22', 'Sosialisasi Air Minum Dalam Kemasan (AMDK) Toya Wening', NULL, '4.00', '6.00', 1, '1.00', '2026-05-04 07:02:06', '2026-05-04 07:02:06', '2026-04-20', '2026-05-03', 14),
('3690d8cc-c3fa-4245-ab41-52a551e8914b', '5bf8a36a-e08e-4e40-8781-61ca5143e4f3', '2d86b5d9-eecf-4245-9b51-adef02b2598d', 'bd7e01de-430d-4336-8774-ed70142171d9', 'c519b493-1670-4301-9f69-e374c735a55b', 'Hari Jadi Kota Solo', NULL, '8.00', '4.00', 1, '1.00', '2026-03-05 09:05:03', '2026-04-11 02:26:44', '2026-02-15', '2026-02-26', 12),
('3e68a8e9-e04c-46c7-b3ea-a44040d54fae', 'f7fe41f2-ed84-4699-a934-cf733686fd1f', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '43b0e196-b64d-43c4-8ebb-a9cda46f2f1a', 'Dies Natalis Ke 50 Universitas Sebelas Maret Surakarta', NULL, '4.00', '8.00', 1, '1.00', '2026-04-11 03:30:14', '2026-04-11 03:30:14', '2026-03-04', '2026-03-13', 10),
('411c7dcc-92c1-47db-8caf-53a346a5480e', 'a261b2ba-c70b-4fba-80df-323618ba6a8c', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', 'c519b493-1670-4301-9f69-e374c735a55b', 'Ayoo... Langganan PDAM', NULL, '8.00', '4.00', 1, '1.00', '2026-04-11 03:08:32', '2026-04-11 03:08:32', '2026-02-27', '2026-03-11', 13),
('42ea76aa-1499-4b50-8875-ac1184cf46ac', '1d242141-aa2e-4366-a7eb-74701aea4292', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', 'ac4ef9c4-a1ee-43b2-8d5a-993cbf35ac50', 'Pasar Pasaran by Hello Market Solo ', NULL, '4.00', '6.00', 1, '1.00', '2026-04-11 07:10:50', '2026-04-11 07:10:50', '2026-04-03', '2026-04-13', 11),
('46995870-f862-4a39-8ff3-9334db4c508e', '0a73b3c0-2b5e-4b1b-aed9-8700a1549142', '2d86b5d9-eecf-4245-9b51-adef02b2598d', 'bd7e01de-430d-4336-8774-ed70142171d9', '39230e1e-ba27-4eb1-83af-e430350c1611', 'Ucapan selamat idulfitri', NULL, '4.00', '8.00', 1, '1.00', '2026-03-26 17:53:02', '2026-04-11 03:59:31', '2026-03-13', '2026-03-27', 15),
('4c8e364f-5c9e-4f21-b7f7-51366ca48d1e', 'ae629e70-a293-4492-a2ef-dfdb9751ee99', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '43b0e196-b64d-43c4-8ebb-a9cda46f2f1a', 'SOLO SPRING FORTUNE di Solo Safari', NULL, '4.00', '8.00', 1, '1.00', '2026-04-11 02:18:59', '2026-04-11 02:18:59', '2026-02-06', '2026-02-24', 19),
('538bb82c-6c71-4d09-93cc-cdd6132b92c6', '4e52dc1d-b98f-4add-a127-4be7c93a4631', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '4862ba02-298c-4033-a433-5e6826bc743d', 'Libur Liburan Ke Solo Aja', NULL, '4.00', '6.00', 1, '1.00', '2026-04-11 06:05:04', '2026-04-11 06:05:04', '2026-03-14', '2026-03-31', 18),
('60ce09f1-7baf-4f5f-a004-50dd93610b73', 'b8dc2703-da7b-44f9-80dd-c5afcb2c7c60', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '88fe4e98-38c0-4a20-8026-fd8796a84c37', 'Cukup Pakai Gadget Urus BPJS Kesehatan Jadi Makin Sat Set', NULL, '4.00', '6.00', 1, '1.00', '2026-04-11 03:22:39', '2026-04-11 03:22:39', '2026-02-27', '2026-03-11', 13),
('71ec9301-181e-43ba-aff8-212638242d1f', '1d242141-aa2e-4366-a7eb-74701aea4292', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '43b0e196-b64d-43c4-8ebb-a9cda46f2f1a', 'Pasar Pasaran by Hello Market Solo ', NULL, '4.00', '8.00', 1, '1.00', '2026-04-11 07:11:11', '2026-04-11 07:11:11', '2026-04-03', '2026-04-13', 11),
('731bb3c4-1a51-44e4-a921-04bdaeb2f601', '4c7c004a-6d9d-493c-a3b7-f935e6d7d101', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', 'c519b493-1670-4301-9f69-e374c735a55b', '"Sumunar" Adeging Praja ', NULL, '8.00', '4.00', 1, '1.00', '2026-05-03 20:00:06', '2026-05-04 06:54:58', '2026-03-28', '2026-05-04', 38),
('74be65b5-dfb5-421a-8902-6158003ec164', '7f5a4117-b610-48da-a88b-ba6acb080508', '2ffc1a52-b3e0-4b9f-95a5-c23ad39a5f0a', 'e32537d5-e045-4762-9f8a-70880b52d0bd', NULL, 'Backdrop Upacara Peringatan Otonomi Daerah dan Hari Pendidikan Nasional', NULL, '10.00', '5.00', 1, '50.00', '2026-05-04 08:07:45', '2026-05-04 08:10:19', '2026-05-04', '2026-05-04', 1),
('7642f237-06b7-4185-a94a-c13db1632163', '4c7c004a-6d9d-493c-a3b7-f935e6d7d101', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '07a90395-ecf9-4110-a997-d89f09e02e0e', '"Sumunar" Adeging Praja ', NULL, '4.00', '6.00', 1, '1.00', '2026-05-03 20:01:05', '2026-05-04 06:55:16', '2026-03-28', '2026-05-04', 38),
('7901c871-f4fe-44a4-8fc0-5372870d10cc', '5bf8a36a-e08e-4e40-8781-61ca5143e4f3', 'af09a15d-e6a4-4625-9fdb-dc6454cdcxxx', 'bd7e01de-430d-4336-8774-ed70142171d9', '4862ba02-298c-4033-a433-5e6826bc743d', 'Hari Jadi Kota Solo', NULL, '4.00', '6.00', 1, '1.00', '2026-03-05 09:09:37', '2026-04-11 02:27:42', '2026-01-15', '2026-01-26', 12),
('95e1bdfc-bfa5-46cd-87c6-f8c1d1bf40a4', '0e91ea52-f2e2-48b6-8b76-068a70145634', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '2dee6d33-52a1-4db7-8bf9-e8b9f6d69a60', 'Kejuaraan Bulutangkis Piala FX Hadi Rudyatmo', NULL, '4.00', '6.00', 1, '1.00', '2026-05-04 07:25:04', '2026-05-04 07:31:52', '2026-04-26', '2026-05-09', 14),
('a6abb37c-1bef-4cfb-b2ee-c6936a9e5603', '8543ce7f-f04c-4245-b91d-3fd3fc751e5c', '2ffc1a52-b3e0-4b9f-95a5-c23ad39a5f0a', 'e32537d5-e045-4762-9f8a-70880b52d0bd', NULL, 'Apel Bersama Pasca Libur Nasional Nyepi dan Lebaran', NULL, '10.00', '5.00', 1, '50.00', '2026-04-11 07:17:28', '2026-04-11 07:23:09', '2026-03-25', '2026-03-25', 1),
('ae447148-8f6b-45aa-9484-a99e2a781a9c', '4e52dc1d-b98f-4add-a127-4be7c93a4631', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '2dee6d33-52a1-4db7-8bf9-e8b9f6d69a60', 'Libur Liburan Ke Solo Aja', NULL, '4.00', '6.00', 1, '1.00', '2026-04-11 06:06:20', '2026-04-11 06:06:20', '2026-03-14', '2026-03-31', 18),
('b685b092-107d-4159-8c0d-a5006f92b878', 'a5100247-6762-41f8-82fd-f884416e2aa9', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', 'ee13bb66-c4b9-4d1d-8205-c08166f65c50', 'Festival kuliner minang jawa', NULL, '3.00', '4.00', 1, '1.00', '2026-04-11 06:59:46', '2026-04-11 06:59:46', '2026-03-26', '2026-04-05', 11),
('b7c87236-0c57-4b67-ac83-d2df1b23d193', '5bf8a36a-e08e-4e40-8781-61ca5143e4f3', '2d86b5d9-eecf-4245-9b51-adef02b2598d', 'bd7e01de-430d-4336-8774-ed70142171d9', '6e6a3be5-2787-403f-86d8-7f1b36f8b0ca', 'Hari Jadi Kota Solo', NULL, '8.00', '4.00', 1, '1.00', '2026-03-03 07:44:14', '2026-04-11 02:28:35', '2026-02-15', '2026-02-26', 12),
('b8f30833-90f7-4216-abd3-fc72a3ba2651', 'e488e138-9b5c-4243-8729-600681536200', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '6e6a3be5-2787-403f-86d8-7f1b36f8b0ca', 'Gebyar Bakdan Ing Balekambang 2026', NULL, '8.00', '4.00', 1, '1.00', '2026-04-11 06:15:32', '2026-04-11 06:15:32', '2026-03-14', '2026-03-25', 12),
('be7dc20f-d06e-4b51-85fd-24d4df810324', 'f7fe41f2-ed84-4699-a934-cf733686fd1f', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '431517b9-c5a7-4759-88f2-201ef06780a1', 'Dies Natalis Ke 50 Universitas Sebelas Maret Surakarta', NULL, '4.00', '8.00', 1, '1.00', '2026-04-11 03:29:46', '2026-04-11 03:29:46', '2026-03-04', '2026-03-13', 10),
('c40d1452-147b-4680-aa3f-d64d28139728', '0a73b3c0-2b5e-4b1b-aed9-8700a1549142', '2d86b5d9-eecf-4245-9b51-adef02b2598d', 'bd7e01de-430d-4336-8774-ed70142171d9', 'c519b493-1670-4301-9f69-e374c735a55b', 'Ucapan selamat idulfitri', NULL, '8.00', '4.00', 1, '1.00', '2026-04-11 04:00:24', '2026-04-11 04:00:24', '2026-03-13', '2026-03-27', 15),
('d2dc932a-eccb-42e1-837b-eeef31d79919', 'f7fe41f2-ed84-4699-a934-cf733686fd1f', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '6e6a3be5-2787-403f-86d8-7f1b36f8b0ca', 'Dies Natalis Ke 50 Universitas Sebelas Maret Surakarta', NULL, '4.00', '8.00', 1, '1.00', '2026-04-09 00:03:25', '2026-04-11 03:29:10', '2026-03-04', '2026-03-13', 10),
('d9565b20-658b-41f2-ae0d-b6e9728cf8ad', '4c7c004a-6d9d-493c-a3b7-f935e6d7d101', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '39230e1e-ba27-4eb1-83af-e430350c1611', '"Sumunar" Adeging Praja ', NULL, '4.00', '8.00', 1, '1.00', '2026-05-03 20:00:28', '2026-05-04 06:55:27', '2026-03-28', '2026-05-04', 38),
('e144f970-1532-4ae7-8fd4-782510e0576e', 'ae629e70-a293-4492-a2ef-dfdb9751ee99', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '4aa1865c-eecc-4964-a904-81d5ec180d22', 'SOLO SPRING FORTUNE di Solo Safari', NULL, '4.00', '6.00', 1, '1.00', '2026-04-11 02:17:54', '2026-04-11 02:17:54', '2026-02-06', '2026-02-24', 19),
('ec96aa08-91c3-4bab-b60e-59f04d4db5f9', '0e91ea52-f2e2-48b6-8b76-068a70145634', '1na-1', 'bd7e01de-430d-4336-8774-ed70142171d9', '43b0e196-b64d-43c4-8ebb-a9cda46f2f1a', 'Kerjukot PBSI Piala Wali Kota', NULL, '4.00', '8.00', 1, '1.00', '2026-05-04 07:21:26', '2026-05-04 07:21:26', '2026-04-26', '2026-05-09', 14),
('ed8e08cd-b709-4865-8859-11c9d34332bb', '9521fe4d-0761-4bb3-a8f8-1e0d4a338c77', '2ffc1a52-b3e0-4b9f-95a5-c23ad39a5f0a', 'e32537d5-e045-4762-9f8a-70880b52d0bd', NULL, 'UPACARA HUT SATPOL PP KE-76, SATLINMAS KE-64 DAN DAMKAR KE-107', NULL, '8.00', '5.00', 1, '40.00', '2026-04-11 07:26:19', '2026-04-11 07:28:45', '2026-04-01', '2026-04-01', 1),
('f3f649c7-af0c-41ac-9953-aff63a4c247f', '5bf8a36a-e08e-4e40-8781-61ca5143e4f3', '2ffc1a52-b3e0-4b9f-95a5-c23ad39a5f0a', 'e32537d5-e045-4762-9f8a-70880b52d0bd', NULL, 'Backdrop Hari Jadi Kota Solo', NULL, '10.00', '5.00', 1, '50.00', '2026-03-13 09:47:37', '2026-04-11 02:56:32', '2026-02-19', '2026-02-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_det_med_kom_elektroniks`
--

CREATE TABLE IF NOT EXISTS `permohonan_det_med_kom_elektroniks` (
  `id` char(36) NOT NULL,
  `permohonan_id` varchar(255) NOT NULL,
  `isi_konten` text NOT NULL,
  `tgl_mulai_publikasi` date NOT NULL,
  `tgl_selesai_publikasi` date NOT NULL,
  `durasi_hari` int(11) NOT NULL,
  `volume_hitung` decimal(15,2) NOT NULL DEFAULT 1.00,
  `anggaran_id` varchar(255) DEFAULT NULL,
  `kegiatan_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permohonan_det_med_kom_elektroniks`
--

INSERT INTO `permohonan_det_med_kom_elektroniks` (`id`, `permohonan_id`, `isi_konten`, `tgl_mulai_publikasi`, `tgl_selesai_publikasi`, `durasi_hari`, `volume_hitung`, `anggaran_id`, `kegiatan_id`, `created_at`, `updated_at`) VALUES
('223fa146-fe83-45dd-a936-f5b1bab9f0cf', 'afc96a42-41af-4a57-9e44-1616cd6d5c38', 'Selamat Hari Raya Nyepi 2026', '2026-03-17', '2026-03-19', 3, '1.00', NULL, '76a8d937-6879-4f36-91af-4bef7c8771ce', '2026-04-11 06:27:40', '2026-04-11 06:27:40'),
('5050190a-7b2f-44c5-a778-1d157f2ace33', 'afc96a42-41af-4a57-9e44-1616cd6d5c38', 'Pengumuman Salat Idulfitri', '2026-03-17', '2026-03-25', 9, '1.00', NULL, '76a8d937-6879-4f36-91af-4bef7c8771ce', '2026-04-11 06:28:46', '2026-04-11 06:31:18'),
('529f0386-9123-48bd-abe5-13cc02c6fc7f', '07e4dbd9-2928-4f6b-8ea4-84a685889e94', 'Lindungi Keluarga dari Bahaya Narkoba', '2026-02-24', '2026-03-10', 15, '1.00', NULL, '76a8d937-6879-4f36-91af-4bef7c8771ce', '2026-04-11 06:12:36', '2026-04-11 06:12:36'),
('6067b641-f455-4ee3-9e02-80530abd89c9', 'bc08a005-f33d-4b13-8c40-36a65ed81f93', 'Ucapan Selamat Tahun Baru 2026', '2025-12-29', '2026-01-12', 15, '1.00', NULL, '76a8d937-6879-4f36-91af-4bef7c8771ce', '2026-04-11 05:19:48', '2026-04-11 05:19:48'),
('a7f8a3eb-341f-46e7-b6e8-152667d6b426', '07e4dbd9-2928-4f6b-8ea4-84a685889e94', 'Ambulans Jenazah Mangkunegaran', '2026-02-20', '2026-03-06', 15, '1.00', NULL, '76a8d937-6879-4f36-91af-4bef7c8771ce', '2026-04-11 06:11:44', '2026-04-11 06:11:44'),
('c057a102-8771-439e-a448-b799d9f4016c', '07e4dbd9-2928-4f6b-8ea4-84a685889e94', 'Selamat Hari Jadi Kota Solo ke-281', '2026-02-16', '2026-02-28', 13, '1.00', NULL, '76a8d937-6879-4f36-91af-4bef7c8771ce', '2026-04-11 06:08:04', '2026-04-11 06:08:04'),
('cb309405-b4a7-4bc3-86d2-0733b0612ae3', '07e4dbd9-2928-4f6b-8ea4-84a685889e94', 'Wujudkan Kota Surakarta Bersih Narkoba', '2026-02-13', '2026-02-27', 15, '1.00', NULL, '76a8d937-6879-4f36-91af-4bef7c8771ce', '2026-04-11 06:06:54', '2026-04-11 06:06:54'),
('e02fe67d-8a56-469e-810d-95a01788b524', '07e4dbd9-2928-4f6b-8ea4-84a685889e94', 'Selamat Tahun Baru Imlek 2026', '2026-02-16', '2026-02-17', 2, '1.00', NULL, '76a8d937-6879-4f36-91af-4bef7c8771ce', '2026-04-11 06:07:35', '2026-04-11 06:07:35'),
('ff3836b5-0e41-4a6f-ae61-82b7bc25f4f4', 'afc96a42-41af-4a57-9e44-1616cd6d5c38', 'Selamat Hari Raya Idulfitri', '2026-03-17', '2026-03-25', 9, '1.00', NULL, '76a8d937-6879-4f36-91af-4bef7c8771ce', '2026-04-11 06:28:16', '2026-04-11 06:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `team_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `team_id`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', NULL, '2025-10-10 17:25:36', '2025-10-10 17:25:36'),
(2, 'Pimpinan', 'web', NULL, '2026-03-24 16:20:40', '2026-03-31 08:33:35'),
(3, 'Admin', 'web', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(9, 1),
(10, 1),
(25, 1),
(25, 3),
(26, 1),
(26, 3),
(27, 1),
(27, 3),
(28, 1),
(28, 3),
(29, 1),
(29, 3),
(30, 1),
(30, 3),
(31, 1),
(31, 3),
(32, 1),
(32, 3),
(33, 1),
(33, 3),
(34, 1),
(34, 3),
(35, 1),
(35, 3),
(36, 1),
(36, 3),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(106, 3),
(107, 1),
(107, 3),
(108, 1),
(108, 3),
(109, 1),
(109, 3),
(110, 1),
(110, 3),
(111, 1),
(111, 3),
(112, 1),
(112, 3),
(113, 1),
(113, 3),
(114, 1),
(114, 3),
(115, 1),
(115, 3),
(116, 1),
(116, 3),
(117, 1),
(117, 3),
(118, 1),
(118, 2),
(118, 3),
(119, 1),
(119, 2),
(119, 3),
(120, 1),
(120, 3),
(121, 1),
(121, 2),
(121, 3),
(122, 1),
(122, 3),
(123, 1),
(123, 3),
(124, 1),
(124, 3),
(125, 1),
(125, 3),
(126, 1),
(126, 3),
(127, 1),
(127, 3),
(128, 1),
(128, 3),
(129, 1),
(129, 3),
(130, 1),
(130, 2),
(130, 3),
(131, 1),
(131, 2),
(131, 3),
(132, 1),
(132, 3),
(133, 1),
(133, 2),
(133, 3),
(134, 1),
(134, 3),
(135, 1),
(135, 3),
(136, 1),
(136, 3),
(137, 1),
(137, 3),
(138, 1),
(138, 3),
(139, 1),
(139, 3),
(140, 1),
(140, 3),
(141, 1),
(141, 3),
(142, 1),
(142, 2),
(142, 3),
(143, 1),
(143, 2),
(143, 3),
(144, 1),
(144, 3),
(145, 1),
(145, 2),
(145, 3),
(146, 1),
(146, 3),
(147, 1),
(147, 3),
(148, 1),
(148, 3),
(149, 1),
(149, 3),
(150, 1),
(150, 3),
(151, 1),
(151, 3),
(152, 1),
(152, 3),
(153, 1),
(153, 3),
(155, 1),
(156, 1),
(157, 1),
(158, 2),
(159, 2),
(160, 2),
(161, 2),
(162, 2),
(163, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CCKdTXhzpX5ZeBtsMFRYKWAt4HzUa7onZQmO49Pq', NULL, '103.83.192.7', 'python-requests/2.31.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicGwwTDc1NjJjUU9qenB5YmNSQzQ3b3MyYzJWYXZDY2Y3UFYyZ1lWUyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNToiaHR0cHM6Ly9sYWJrdS5zdXJha2FydGEuZ28uaWQvYWRtaW4iO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czo0MToiaHR0cHM6Ly9sYWJrdS5zdXJha2FydGEuZ28uaWQvYWRtaW4vbG9naW4iO3M6NToicm91dGUiO3M6MjU6ImZpbGFtZW50LmFkbWluLmF1dGgubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778247205),
('LQwYmtwtDEQTGE59FI0mwibxOvlRNEfsuEeSmBAS', NULL, '103.83.192.7', 'python-requests/2.31.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXVuekduQTJjZjFDM1MwNWNvVUtpSG5oQngxQ0l4UXFpUVVQM0M1RiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHBzOi8vbGFia3Uuc3VyYWthcnRhLmdvLmlkIjtzOjU6InJvdXRlIjtzOjc6ImxhbmRpbmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1778247238),
('qyzftxwcjdXhdsyl4v6enEii5fkwIa1NIThyJOJK', NULL, '103.83.192.7', 'python-requests/2.31.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOW1uNmltb0xBQWRxc3RwcUkzRWNEWURJdVFxclY2dGtWT2paT2dmViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vbGFia3Uuc3VyYWthcnRhLmdvLmlkL2FkbWluL2xvZ2luIjtzOjU6InJvdXRlIjtzOjI1OiJmaWxhbWVudC5hZG1pbi5hdXRoLmxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778247225);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_anggarans`
--

CREATE TABLE IF NOT EXISTS `tahun_anggarans` (
  `id` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tahun_anggarans`
--

INSERT INTO `tahun_anggarans` (`id`, `nama`, `mulai`, `selesai`, `aktif`, `created_at`, `updated_at`) VALUES
('9b702342-a1f8-4dd1-9156-33f80b7406ee', 'Anggaran 2026', '2026-01-01', '2026-02-24', 1, '2026-01-14 00:43:39', '2026-03-09 00:28:20'),
('c826fd1a-1bb8-48a4-8986-9b9012aaccf4', 'Anggaran 2025', '2025-01-01', '2025-12-31', 0, '2026-01-14 01:15:28', '2026-03-09 00:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_baliho`
--

CREATE TABLE IF NOT EXISTS `tbl_baliho` (
  `id` char(36) NOT NULL,
  `nama_baliho` varchar(255) NOT NULL,
  `lokasi_baliho` varchar(255) NOT NULL,
  `koordinat_baliho` varchar(255) DEFAULT NULL,
  `foto_baliho` varchar(255) NOT NULL,
  `ukuran_baliho` varchar(255) NOT NULL,
  `layout_baliho` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_baliho`
--

INSERT INTO `tbl_baliho` (`id`, `nama_baliho`, `lokasi_baliho`, `koordinat_baliho`, `foto_baliho`, `ukuran_baliho`, `layout_baliho`, `created_at`, `updated_at`) VALUES
('1b8fdd7a-79e4-491e-814d-52d5f8978b94', 'BALIHO DEPAN KECAMATAN LAWEYAN', 'Jl. Dr. Rajiman No.352, Penumping, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57141', NULL, 'baliho/01K6MCC0H1ZPGB3ZNKFMJ4CPJ3.jpg', '4M X 8M', 'Vertical', '2025-10-10 17:23:40', '2025-10-10 17:23:40'),
('3dec2736-e6d9-4fc6-9c53-11e4b2195775', 'BALIHO DEPAN PASAR JONGKE', 'Pasar Jongke, Jl. Dr. Rajiman 0441, Pajang, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57147', NULL, 'baliho/01K6MBJ6KTY04QVQ43BZK55EBH.jpg', '4M X 8M', 'Vertical', '2025-10-10 17:23:40', '2025-10-10 17:23:40'),
('49da6e69-0024-4001-9021-ae534beede94', 'BALIHO PDAM', 'Jl. Adi Sucipto No.135C, Kerten, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57143', NULL, 'baliho/01K6M2D71MXJ5EW4GRSJT3YYAD.jpg', '4M X 8M', 'Horizontal', '2025-10-10 17:23:40', '2025-10-10 17:23:40'),
('7b755978-6ebb-4a0b-ab95-a57dff1252ea', 'BALIHO JURUG', 'CVM5+H55, Jl. Ir. Sutami, Pucangsawit, Kec. Jebres, Kota Surakarta, Jawa Tengah 57125', NULL, 'baliho/01K6M1ZA5PWSJFR4NY1Q8TJEKK.jpg', '4M X 8M', 'Horizontal', '2025-10-10 17:23:40', '2025-10-10 17:23:40'),
('988b9e25-ab16-46b8-a738-8f114d671675', 'BALIHO INSTITUTE SENI INDONESIA', 'CVV2+GJV, Jl. Ki Hajar Dewantara, Jebres, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126', NULL, 'baliho/01K6M2A1T4N862C0666WF1WBW5.jpg', '4M X 8M', 'Vertical', '2025-10-10 17:23:40', '2025-10-10 17:23:40'),
('9f1b1f62-b5b8-457f-88ef-513c6f5954f7', 'BALIHO SHELTER LOJIWETAN', 'Shelter Lojiwetan, Jl. Kapten Mulyadi, Kedung Lumbu, Kec. Ps. Kliwon, Kota Surakarta, Jawa Tengah 57133', NULL, 'baliho/01K6MC22YSMN7VYTV7AWYYNW74.jpg', '4M X 6M', 'Vertical', '2025-10-10 17:23:40', '2025-10-10 17:23:40'),
('c488ab46-9da7-41ac-ac7c-e21b624f7942', 'BALIHO YOS SUDARSO / TANJUNGANOM', 'CR58+MXF, Jl. Yos Sudarso, Joyotakan, Kec. Serengan, Kota Surakarta, Jawa Tengah 57157', NULL, 'baliho/01K6M2S1YASFQHMK3V10CVCX3R.jpg', '4M X 6M', 'Vertical', '2025-10-10 17:23:40', '2025-10-10 17:23:40'),
('d93f54a1-50cd-4d55-9c77-4c4549788591', 'BALIHO SIMPANG LIMA BANJARSARI', 'Jl. Walter Monginsidi, Margoyudan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57134', NULL, 'baliho/01K6M2J3E2H3S3M1VTZ9CWS18C.jpg', '4M X 6M', 'Vertical', '2025-10-10 17:23:40', '2025-10-10 17:23:40'),
('dea38f38-692f-4c34-899b-cbcf591121a6', 'BALIHO DEPAN KECAMATAN BANJARSARI', 'Jl. Adi Sumarmo, Banyuanyar, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57137', NULL, 'baliho/01K6M21W546HFYKMTRQHEAPYHV.jpg', '4M X 8M', 'Vertical', '2025-10-10 17:23:40', '2025-10-10 17:23:40'),
('ec81712d-742f-408a-9aad-ca2afec1d60d', 'BALIHO KECAMATAN SERENGAN', 'Jl. Veteran, Serengan, Kec. Serengan, Kota Surakarta, Jawa Tengah 57155', NULL, 'baliho/01K6MB41SSV3E3Y195DBXVK139.jpg', '4M X 8M', 'Vertical', '2025-10-10 17:23:40', '2025-10-10 17:23:40'),
('ef7f0b4c-3638-4e58-b7ee-d5f797da0d51', 'BALIHO GIRIMULYO SUMBER', 'CRW2+WFR, Jl. Letjen Suprapto, Manahan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57143', NULL, 'baliho/01K6MB95023M40FQ5M4B7866RM.jpg', '4M X 6M', 'Vertical', '2025-10-10 17:23:40', '2025-10-10 17:23:40'),
('f454387f-5f1e-4805-a8bb-226844d3b37d', 'BALIHO TUGU LILIN SMA MURNI', 'Jl. Dr. Wahidin, Purwosari, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57142', NULL, 'baliho/01K6MBSJ562690V5817CKRBFCW.jpg', '4M X 6M', 'Vertical', '2025-10-10 17:23:40', '2025-10-10 17:23:40'),
('f7dcfc56-45d0-4e61-aa7f-5051f2b39b26', 'BALIHO PASAR SIDODADI KLECO', 'Pasar Sidodadi, Kleco, Karangasem, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57145', NULL, 'baliho/01K6MBXWRJQS16KRXSM72Z08DN.jpg', '4M X 8M', 'Horizontal', '2025-10-10 17:23:40', '2025-10-10 17:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instansi`
--

CREATE TABLE IF NOT EXISTS `tbl_instansi` (
  `id` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kategori` enum('Pemerintah','Non Pemerintah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_instansi`
--

INSERT INTO `tbl_instansi` (`id`, `nama`, `created_at`, `updated_at`, `kategori`) VALUES
('0198a1a2-ebd0-429f-88ee-4e4296663c58', 'KELURAHAN TIPES', '2025-10-10 17:23:40', '2025-10-10 17:23:40', 'Pemerintah'),
('01d1e6ba-ec07-40b0-83f7-31d7b1cbbbe8', 'KELURAHAN SUDIROPRAJAN', '2025-10-10 17:23:40', '2025-10-10 17:23:40', 'Pemerintah'),
('0263dca3-d243-421f-befb-471f2fdb2af6', 'DPUPR', '2025-10-10 17:23:40', '2025-10-10 17:23:40', 'Pemerintah'),
('02b833b0-d599-45fb-9464-0885328dfa58', 'KELURAHAN KARANGASEM', '2025-10-10 17:23:40', '2025-10-10 17:23:40', 'Pemerintah'),
('02d5e50b-91f0-4fbf-b7b5-32547fe8819f', 'Mangkunegaran', '2026-03-31 01:14:41', '2026-03-31 01:14:41', 'Non Pemerintah'),
('0329ca40-98d4-44e0-b2ce-b0c30778d0b2', 'KELURAHAN KEPATIHAN KULON', '2025-10-10 17:23:40', '2025-10-10 17:23:40', 'Pemerintah'),
('03be7a5f-29f3-4176-8ede-c42d9f16c05e', 'KECAMATAN SERENGAN', '2025-10-10 17:23:40', '2025-10-10 17:23:40', 'Pemerintah'),
('0404ddf7-9c15-44ee-8d89-af87878d4ccd', 'KELURAHAN TIMURAN', '2025-10-10 17:23:40', '2025-10-10 17:23:40', 'Pemerintah'),
('06dd1556-8cd0-420f-8adc-f29834ba7f4f', 'KELURAHAN BALUWARTI', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('07c2b237-7f44-4889-889b-ad6923592b10', 'DISBUDPAR', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('080dd40e-26ef-4852-8e2c-760f482a7a6e', 'KELURAHAN PANULARAN', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('0892d0b8-a858-4d4e-a2bd-0708b1e044a8', 'KELURAHAN SANGKRAH', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('09344a1e-2420-497b-a3c0-1bf47b78473a', 'KELURAHAN KAUMAN', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('09bfda1b-9b0e-4e70-8799-bc689e067dca', 'KELURAHAN LAWEYAN', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('0a02e20f-855a-44c6-ae1f-e10b484a4d35', 'KELURAHAN GANDEKAN', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('0a5a0352-ff21-4271-9bac-3e18a1f54981', 'KELURAHAN PAJANG', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('0b532f1d-92d6-4976-9584-9159db7cf0d6', 'KELURAHAN JAJAR', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('0b6c1db9-1c96-40bb-9701-e22d406d9eac', 'KELURAHAN PUNGGAWAN', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('0c62c568-9df8-4595-9496-fb8c0466f079', 'BAKESBANGPOL', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('0dcdd8a8-56d8-45af-9330-2a9c1ca1b013', 'KELURAHAN JEBRES', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('0eb7f9bd-10a5-4054-a6f9-56c4770d0e75', 'KELURAHAN MOJOSONGO', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('15a1d92c-ad5b-4175-a702-97fe7354fc6b', 'KELURAHAN KAMPUNG BARU', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('15cdd098-61b7-4344-a729-b9c48d5306e4', 'KECAMATAN JEBRES', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('17bf3208-4a2b-45ba-8679-4a87e78d0057', 'KELURAHAN PASARKLIWON', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('1b83d044-1ca5-48bb-95d2-693fe5e76edf', 'KELURAHAN BANJARSARI', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('1bfff7c6-866f-4015-b694-e39226c28912', 'KELURAHAN KEMLAYAN', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('1c578e05-3d20-4a0d-bbff-1bde71c79216', 'KELURAHAN TEGALHARJO', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('1c8d3bc3-ee56-4212-9585-5167949078d8', 'DPMPTSP', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('1daa5f52-3275-490b-9c88-f7cee1222e1a', 'Badan Koordinasi Lembaga Pendidikan Al Qur''an', '2026-05-04 07:49:21', '2026-05-04 07:49:21', 'Non Pemerintah'),
('1dea27ce-4a55-4a19-9a84-d84b893416ca', 'BAPPEDA', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('1f94af1b-cae7-48f9-bc9f-af1361e9a6f1', 'BAPENDA', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('20d50209-5a8c-4f1f-98b0-bd408a5e1e14', 'DISDIK', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('22a98073-2320-4c22-8c9a-b89c818267ae', 'KELURAHAN DANUKUSUMAN', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('22b6d31d-6e73-46e2-9261-2e897aeb0409', 'DINAS KESEHATAN', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('23b6d94c-e781-48de-9982-4e5bab9beb14', 'KELURAHAN MANAHAN', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('24f88e4b-c007-4b93-b1ab-e8a57fbb378e', 'KELURAHAN PENUMPING', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('2505865e-d3ad-494f-8168-0e03ce7115e8', 'Hello Market', '2026-04-11 07:09:30', '2026-04-11 07:09:30', 'Non Pemerintah'),
('260d4253-10d6-4255-8953-e84c9cab38be', 'BADAN PERENCANAAN PEMBANGUNAN DAERAH', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('269a07b4-13a3-4e1b-949d-b2c0ea42b6f2', 'Perumda Air Minum (PDAM) Kota Surakarta', '2026-04-11 03:03:46', '2026-04-11 03:03:46', 'Pemerintah'),
('290a69a6-e5d9-49e3-9f52-a917dcd62c27', 'KELURAHAN JAGALAN', '2025-10-10 17:23:41', '2025-10-10 17:23:41', 'Pemerintah'),
('2a147d92-d19d-4145-b837-51a6a63629b5', 'BPBD', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('2c64cd42-0f43-4280-81bd-b7beb4d3696d', 'KELURAHAN KESTALAN', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('2c86da0f-fc60-4809-b21e-fec24d1fa06e', 'BAGIAN PEREKONOMIAN DAN SDA', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('2f1a9dd1-d6d7-4ea8-9696-f60233e4d5fd', 'DISPERSIP', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('3232f822-d340-4540-8e05-90edc8c0701a', 'KELURAHAN SUMBER', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('324e0011-fc2e-4b74-934d-5f3c3918e299', 'KELURAHAN KADIPIRO', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('32a1ee4e-1030-45f1-a43c-492b9360e91e', 'KELURAHAN PUCANGSAWIT', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('32e56a8f-5d9d-4560-8ac5-6082281ad0ae', 'KELURAHAN SETABELAN', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('364b55c7-d740-455f-b47f-ccae11105941', 'KELURAHAN JOGLO', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('3677247e-45d3-4505-81e1-f0c2391aed72', 'BAGIAN PROKOMPIM', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('389c120d-a555-4b83-ab1e-30fd70449d7d', 'KELURAHAN PURWODININGRATAN', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('3c03405d-3a1d-4adb-97f1-dd789361e608', 'KELURAHAN PURWOSARI', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('3da26659-c615-4fe5-907d-e9292c4a9743', 'DISNAKER', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('3e60b3fa-292d-4e1a-bb20-e6a6b92f6180', 'KELURAHAN MANGKUBUMEN', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('4160d79f-4bcf-4749-a36b-5838e34dfa6a', 'KELURAHAN KRATONAN', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('42ce8a59-e96a-4cc3-bc23-0cb79519b214', 'DINAS PENDIDIKAN', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('4346008a-f91a-49e4-82b5-9c5711ae6105', 'BAGIAN KERJASAMA SEKRETARIAT DAERAH', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('45637413-2975-460d-8217-cc2839a55b7e', 'KELURAHAN SEWU', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('456ba9a9-5c00-4a84-b94d-0d8056a84e4b', 'KELURAHAN KEPRABON', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('46a5f13d-384e-4b6f-b9dc-9bb84b310666', 'KELURAHAN JOYOSURAN', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('49a26166-4283-4438-b48e-f10270b10be5', 'DP3AP2KB', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('4c2d7682-bf82-4698-ad45-095fabafed19', 'KELURAHAN GILINGAN', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('4f94fad6-4dc7-4446-b6c8-50764f909d6e', 'Balekambang', '2026-04-11 06:13:29', '2026-04-11 06:13:29', 'Pemerintah'),
('5452b301-4413-4212-ac7c-47bd1478bc75', 'KELURAHAN JOYOTAKAN', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('5531cb26-e5b7-4a14-985b-35ea97ec0512', 'KELURAHAN KEDUNGLUMBU', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('573311d8-faeb-42d1-a1d5-5fe0f77f8fb4', 'KELURAHAN SEMANGGI', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('59603220-29ce-4aec-857a-aa8f7b2583b5', 'KELURAHAN KEPATIHAN WETAN', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('5a2c5757-7fbf-4870-a7c3-27d74bfecb50', 'DISKOMINFO SP', '2025-10-10 17:23:42', '2025-10-10 17:23:42', 'Pemerintah'),
('62741e6d-f727-4ba3-af29-830c1d270f27', 'KECAMATAN BANJARSARI', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('65d94339-c023-437f-9f82-948346c09a4d', 'SMAN 1 Surakarta', '2026-05-06 19:40:44', '2026-05-06 19:40:44', 'Pemerintah'),
('66739f57-4772-41c2-bff1-98887ee82df0', 'BAGIAN UMUM', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('69bab0a8-3564-4907-850b-bdea2a6c5d73', 'KELURAHAN KERTEN', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('6c212c3f-4531-45f7-ab0f-ec5188e60808', 'SETWAN', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('6f517dff-6413-4885-9f8e-d0c3ae1e9793', 'ADNAN MULYA SATYANU', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Non Pemerintah'),
('70e23b96-2f6d-49ac-be06-012032c1c7d8', 'KELURAHAN SONDAKAN', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('7b0fe311-0872-4dca-a26a-941417c06c45', 'KELURAHAN NUSUKAN', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('7b91be5b-ea11-4f3d-8be2-ba5cce796e9d', 'KELURAHAN SERENGAN', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('80f7d8e3-e6cf-4f5f-a618-2c4db7e65f5b', 'KELURAHAN BANYUANYAR', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('812753a2-58c0-4b03-a4b4-053d96fcb6c9', 'KELURAHAN BUMI', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('82910f8c-110b-4e72-a4dc-41b0192d303a', 'DISDAG', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('833631f2-487e-4026-bdaa-488ef1e67a02', 'BAGIAN KESEJAHTERAAN RAKYAT', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('8421e9c2-0e4f-4bcc-afbf-d126f6420afd', 'SANG GATOTKOCO KEMBALI', '2025-10-10 17:23:43', '2026-02-03 18:29:28', 'Non Pemerintah'),
('8eac0bfb-2a66-4d04-b643-36649964f46c', 'KELURAHAN MOJO', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('8f2858db-e451-4b51-91e8-a094b700ca71', 'DINKOPUKMPERIN', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('906d4380-940a-4e92-adac-735db5230c23', 'PBSI Surakarta', '2026-05-04 07:05:08', '2026-05-04 07:05:08', 'Non Pemerintah'),
('92799be3-e7a5-4b25-88e7-8a7fd230afc7', 'BKPSDM', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('94001e72-c0f8-443d-ae27-5cd8c77372d9', 'BAGIAN TATA PEMERINTAHAN', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('94679dcd-6885-490d-bc6b-98d5c9db7b05', 'DLH', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('95deed03-171d-4127-9d20-f846c95f5082', 'KELURAHAN GAJAHAN', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('99b603c3-993c-45e0-9ce8-a2469e01a0eb', 'BPKAD', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('9d51d9c5-3412-4607-83cb-e286380131fd', 'KELURAHAN KETELAN', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('9fa4e5a7-bcd0-4f7f-a4bd-8de7a4e35627', 'KELURAHAN JAYENGAN', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('a1210c5e-1e6f-4e53-8fd3-cfabd578dd48', 'INSPEKTORAT', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('a91dbdec-9d35-4fa1-a9f0-e2d87fc44acc', 'DISDUKCAPIL', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('aedb644d-7d18-458d-a6c6-92695e6cc595', 'Universitas Sebelas Maret (UNS)', '2026-03-31 07:21:22', '2026-03-31 07:21:22', 'Non Pemerintah'),
('b1f2071b-3e50-4010-8490-f3c351a572ca', 'DISPANGTAN', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('b2523b15-acb4-4a0c-95e3-0d0c9d10cdf3', 'KELURAHAN SRIWEDARI', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('b33c9dbe-221e-4f08-aacf-21849be3a0ea', 'SATPOL PP', '2025-10-10 17:23:43', '2025-10-10 17:23:43', 'Pemerintah'),
('b862f627-7ff7-481e-a979-ee580f52fd2c', 'KECAMATAN LAWEYAN', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah'),
('ba8a6db1-a30b-4a54-94ee-242663594f67', 'BPJS Kesehatan Surakarta', '2026-04-11 03:14:40', '2026-04-11 03:14:40', 'Pemerintah'),
('c6031350-34a7-49e0-8e57-000380949d1d', 'Solo Safari', '2026-04-11 02:14:33', '2026-04-11 02:14:33', 'Non Pemerintah'),
('c99b3445-8da6-42d1-a01f-31dc255b1480', 'BAGIAN HUKUM', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah'),
('d230eeb0-b56a-4462-adce-621ebdc6b59d', 'DISHUB', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah'),
('d8831bde-d449-4fef-adfb-dfedbe83cb06', 'DINKES', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah'),
('d8832a1d-b914-4d37-b892-fa94ccfdeb69', 'DAMKAR', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah'),
('d9585628-7579-4580-8cf3-94238af0274c', 'BLP', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah'),
('daa4f63b-38a6-4ec9-8790-734a246c6627', 'DINSOS', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah'),
('dbd2dcdc-98d4-4146-8a3a-067e6c6e7914', 'KECAMATAN PASAR KLIWON', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah'),
('ea428dcb-6e99-4ced-a203-c42c3d963b6e', 'BAGIAN ADMINISTRASI PEMBANGUNAN', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah'),
('ef738b84-a69e-49ac-beb1-2413a4685f49', 'BADAN PENDAPATAN DAERAH', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah'),
('f226edd5-9c35-4a2e-a947-2406e80d4e96', 'Ikatan Keluarga Minangkabau (IKM) Kota Surakarta', '2026-04-11 06:56:08', '2026-04-11 06:56:08', 'Non Pemerintah'),
('f3a31836-c56f-4e1d-9ef5-b196d215f915', 'BAGIAN ORGANISASI', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah'),
('f5621f63-4e52-4b54-b5da-963161d88895', 'DISPORA', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah'),
('f70aac61-0858-4aa0-ac7f-091822d519ee', 'DISPERKIMTAN', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'Pemerintah');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_layanan`
--

CREATE TABLE IF NOT EXISTS `tbl_layanan` (
  `id` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_layanan` varchar(10) DEFAULT NULL,
  `aktif` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_layanan`
--

INSERT INTO `tbl_layanan` (`id`, `nama`, `created_at`, `updated_at`, `kode_layanan`, `aktif`) VALUES
('0c2ce546-aa59-4f23-8954-a03bcf5f5bb1', 'Fasilitas Media Cetak', '2025-10-10 17:23:44', '2026-03-25 22:13:22', 'MCKP', '1'),
('75fcd134-0fcf-4694-8625-8d43bf41ccb0', 'SIARAN RADIO KONATA', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'KONATA', ''),
('c9730c78-1a46-4cf4-b75d-aaaf9fbfda56', 'Fasilitas Media Eletronik', '2025-10-10 17:23:44', '2026-02-26 01:24:37', 'MEKP', '1'),
('d062f47c-d9a9-4096-b941-894a7ca30915', 'PPID', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'PPID', ''),
('eb64bf1d-1a9f-4c53-88dc-36089dd196c4', 'KELOMPOK INFOMASI MASYARAKAT (KIM)', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'KIM', ''),
('f20ffbd5-9333-4a87-81ba-d7ff76aa669e', 'BULETIN SIBER (BUSI)', '2025-10-10 17:23:44', '2025-10-10 17:23:44', 'BUSI', '');

-- --------------------------------------------------------

--
-- Table structure for table `titik_balihos`
--

CREATE TABLE IF NOT EXISTS `titik_balihos` (
  `id` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `titik_lokasi` varchar(255) NOT NULL,
  `foto_baliho` varchar(255) DEFAULT NULL,
  `ukuran_baliho_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `titik_balihos`
--

INSERT INTO `titik_balihos` (`id`, `nama`, `alamat`, `titik_lokasi`, `foto_baliho`, `ukuran_baliho_id`, `created_at`, `updated_at`, `lat`, `lng`) VALUES
('07a90395-ecf9-4110-a997-d89f09e02e0e', 'Baliho Sumber', 'Jl. Letjen Suprapto (Lampu Merah Girimulyo), Manahan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57143', 'https://maps.app.goo.gl/tX1L1P8Y2MmCGSFW6', 'baliho/01KNXHF41THE1MKRX4RB82WZQP.', '423a2a9a-c6b3-4c39-bc53-8e2f01387fad', '2026-04-10 22:50:35', '2026-04-10 22:50:35', '-7.5526192821794105', '110.80117002713763'),
('11498f3e-2d22-4341-98b0-213ac7fcda6a', 'Baliho Jl. K Hajar Dewantara (HIBAH KPU)', 'Jl. Ki Hajar Dewantara (Depan PLUT), Jebres, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126', 'https://maps.app.goo.gl/RKb1LLRf8Ds1V31y8', 'baliho/01KNXTQ4VTFQ3KMVWRN84M1TAN.', '79ffbbef-75fd-4b5e-ba2a-054aa1b349d2', '2026-04-11 01:32:15', '2026-04-11 01:32:15', '-7.556640660959729', '110.85277209701415'),
('2dee6d33-52a1-4db7-8bf9-e8b9f6d69a60', 'BALIHO TANJUNGANOM', 'Jl. Yos Sudarso, Joyotakan, Kec. Serengan, Kota Surakarta, Jawa Tengah 57157', 'https://www.google.com/maps/place/Jl.+Yos+Sudarso,+Jawa+Tengah/@-7.5814894,110.818053,17z/data=!3m1!4b1!4m6!3m5!1s0x2e7a16645c932ee7:0x4df61fe32618dce2!8m2!3d-7.5814894!4d110.8206279!16s%2Fg%2F1hm4tj3hm?entry=ttu&g_ep=EgoyMDI2MDExMy4wIKXMDSoKLDEwMDc5MjA2O', 'baliho/01KNXEFRDYAXHD2WDPQHPP4SMP.png', '423a2a9a-c6b3-4c39-bc53-8e2f01387fad', '2026-01-16 03:19:02', '2026-04-10 21:58:30', '-7.581329866702957', '110.82070299640586'),
('39230e1e-ba27-4eb1-83af-e430350c1611', 'Baliho Pasar Kleco', 'Jl. Slamet Riyadi (Barat Ps. Kleco), Karangasem, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57145', 'https://maps.app.goo.gl/V1vy3WeRtnehEyqF7', 'baliho/01KNXV11YXP116Z9S738X8QQDP.', '13814d3d-c202-4fce-83dc-e5af8f5baa82', '2026-04-11 01:37:39', '2026-04-11 01:37:39', '-7.557413929319504', '110.779184751537'),
('431517b9-c5a7-4759-88f2-201ef06780a1', 'BALIHO INSTITUTE SENI INDONESIA (ISI)', 'Jl. Ki Hajar Dewantara (Belakang Kampus ISI), Jebres, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126', 'https://maps.app.goo.gl/xa4DNff6qpPmUepe6', 'baliho/01KQSPWJSXVFDAYWJ80C8R9AY6.', '13814d3d-c202-4fce-83dc-e5af8f5baa82', '2026-01-16 03:13:27', '2026-05-04 07:39:44', '-7.5565377294394755', '110.8527866932529'),
('43b0e196-b64d-43c4-8ebb-a9cda46f2f1a', 'BALIHO PASAR JONGKE', 'Pasar Jongke, Jl. Dr. Rajiman 0441, Pajang, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57147', 'https://maps.app.goo.gl/9ohaBvQy6qSemQHs7', 'baliho/01KNXH0BDEDYDQE9HSXWSGEP1N.', '13814d3d-c202-4fce-83dc-e5af8f5baa82', '2026-01-16 02:49:21', '2026-04-10 22:42:31', '-7.56838734197003', '110.78942151155454'),
('4862ba02-298c-4033-a433-5e6826bc743d', 'Baliho Tugu Lilin', 'Jl. Dr Wahidin (Dpn. Selat Tenda Biru) , Purwosari, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57142\n', 'https://maps.app.goo.gl/cAiKwJoXHsMv1qrT6', 'baliho/01KNYA73N9VCKP3ARATE1SN2Z1.', '423a2a9a-c6b3-4c39-bc53-8e2f01387fad', '2026-04-10 22:02:52', '2026-04-11 06:03:06', '-7.568777699926666', '110.80547299999922'),
('4aa1865c-eecc-4964-a904-81d5ec180d22', 'Baliho Banjarsari', 'Perempatan Banjarsari, Jl. Walter Monginsidi, Gilingan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57134', 'https://maps.app.goo.gl/c1H64dmRpkoZbqtq5', 'baliho/01KNXH8QRCT92BTCM2ZMNTZGHA.', '423a2a9a-c6b3-4c39-bc53-8e2f01387fad', '2026-04-10 22:47:05', '2026-04-10 22:47:05', '-7.5584997859210095', '110.82851377239449'),
('56603898-38b8-477d-a069-779c36f67d94', 'Baliho Ring Road Mojosongo (HIBAH KPU)', 'Jl. Sumpah Pemuda, Mojosongo, Kec. Jebres, Kota Surakarta, Jawa Tengah 57127', 'https://maps.app.goo.gl/9QUKdkFQpP7W5zhR7', 'baliho/01KNXS4QZB08ZHZDG85Q8T0F0A.', '79ffbbef-75fd-4b5e-ba2a-054aa1b349d2', '2026-04-11 01:04:43', '2026-04-11 01:04:43', '-7.539068512505847', '110.84673972358152'),
('670b439b-094e-497c-94db-52e19e5822f6', 'Baliho Jl. Sungai Serang Kusumadilagan (HIBAH KPU)', 'Jl. Kahar Muzakir (Arah RSUD Bung Karno), Semanggi, Kec. Ps. Kliwon, Kota Surakarta, Jawa Tengah 57191', 'https://maps.app.goo.gl/6oP5GwBthLyFvPaZ7', 'baliho/01KNXTGJ325QGCFRXJ3CA2476D.', '79ffbbef-75fd-4b5e-ba2a-054aa1b349d2', '2026-04-11 01:28:39', '2026-04-11 01:28:39', '-7.590898734989292', '110.82990322091686'),
('6e6a3be5-2787-403f-86d8-7f1b36f8b0ca', 'BALIHO JURUG', 'Jl. Ir. Sutami, Pucangsawit, Kec. Jebres, Kota Surakarta, Jawa Tengah 57125', 'https://maps.app.goo.gl/YF7MLtVRVw9xgatP7', 'baliho/01KNYA3Q3YMY88CRNKXE8CPBTE.png', 'ea26cb13-a523-46df-bf71-ec8abd423b9e', '2026-01-16 03:12:01', '2026-04-11 06:01:15', '-7.5657934793896695', '110.85899574279986'),
('88fe4e98-38c0-4a20-8026-fd8796a84c37', 'BALIHO LOJIWETAN', 'Pertigaan Lojiwetan, Jl. Kapten Mulyadi, Kedung Lumbu, Kec. Ps. Kliwon, Kota Surakarta, Jawa Tengah 57133', 'https://maps.app.goo.gl/BQBkKtT5xTkDzq3n6', 'baliho/01KNXE6N416YAB1QGDRQ46S4HM.', '423a2a9a-c6b3-4c39-bc53-8e2f01387fad', '2026-01-16 03:17:38', '2026-04-10 21:53:31', '-7.5715027351084725, ', '110.83309101185513'),
('8daff39a-33d1-4ffd-a620-daaa8c9f70cb', 'Baliho Kec Serengan', 'Jl. Veteran (Dpn Kec Serengan), Serengan, Kec. Serengan, Kota Surakarta, Jawa Tengah 57155', 'https://maps.app.goo.gl/7Dnh3kFinxb5HEfN6', 'baliho/01KNXHSAP489X070ZNCDVX393P.', 'e60dc17b-eb4c-43f7-8d0c-e8c1fa52437f', '2026-04-10 22:56:09', '2026-04-10 22:56:09', '-7.58060673210639', '110.81531572822932'),
('abef121c-a7d7-429d-a7ec-a9deb9ce0924', 'Baliho Jl. Hasanudin Pasarnongko (HIBAH KPU)', 'Jl. Hasanudin (Pertigaan Utara Solo Paragon), Mangkubumen, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57139', 'https://maps.app.goo.gl/icPtWZcM5xXFf8fDA', 'baliho/01KNXT96E1B5PY62W1Z86HS6JE.png', '79ffbbef-75fd-4b5e-ba2a-054aa1b349d2', '2026-04-11 01:24:38', '2026-04-11 01:24:38', '-7.5586137433942895', '110.81120509653265'),
('ac4ef9c4-a1ee-43b2-8d5a-993cbf35ac50', 'Baliho Kec.Banjarsari', 'Jl. Adisumarmo (Dpn Kec.Banjarsari), Banyuanyar, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57135', 'https://maps.app.goo.gl/eALqdpnHhzhKDGAp8', 'baliho/01KNXGFDK5D4HX81NPVKRDF6GJ.', '423a2a9a-c6b3-4c39-bc53-8e2f01387fad', '2026-04-10 22:33:16', '2026-04-10 22:33:16', '-7.542397692645768', '110.81041185778142'),
('b8b164ed-6202-4dcb-891c-5f1fe373c24a', 'Baliho Kec. Pasar Kliwon', 'Jl. Kapten Mulyadi (Dpn Kec. Ps. Kliwon), Joyosuran, Kec. Ps. Kliwon, Kota Surakarta, Jawa Tengah 57133', 'https://www.google.com/maps?q=-7.5867923,110.8283039&z=17&hl=en', 'baliho/01KNXRZQ29D1WC4MVDM1ZASVXP.', 'e60dc17b-eb4c-43f7-8d0c-e8c1fa52437f', '2026-04-11 01:01:58', '2026-04-11 01:01:58', '-7.586785068875747', '110.8283466304536'),
('c519b493-1670-4301-9f69-e374c735a55b', 'BALIHO PDAM', 'Jl. Adi Sucipto No.135C, Kerten, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57143', 'https://maps.app.goo.gl/7jocC7VpT98U8qFX6', 'baliho/01KNYA2FP2F4FYS7MTQD3S8SAJ.png', 'ea26cb13-a523-46df-bf71-ec8abd423b9e', '2026-01-16 02:57:06', '2026-04-11 06:00:35', '-7.548842782792842', '110.7839549640964'),
('c59807c4-4b2e-4b22-87c7-320c220357d8', 'Baliho RSUD Ngipang (HIBAH KPU)', 'Jl. Kapten Dr. Prakosa, Kedungupit (Selatan RSUD Ngipang), ngipang, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57136', 'https://maps.app.goo.gl/epoy8tCpqpSGu9nm6', 'baliho/01KNXSXETE3TD8TSK0YYHY0VA2.', '79ffbbef-75fd-4b5e-ba2a-054aa1b349d2', '2026-04-11 01:18:13', '2026-04-11 01:18:13', '-7.526313653750271', '110.81220149203382'),
('ee13bb66-c4b9-4d1d-8205-c08166f65c50', 'BALIHO KEC. LAWEYAN', 'Jl. Dr. Rajiman (Dpn Kec Laweyan), Penumping, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57141', 'https://maps.app.goo.gl/H7z3N5dA83hYogeJA', 'baliho/01KNXHN31ETWABSASK1Q5YTD6A.', 'e60dc17b-eb4c-43f7-8d0c-e8c1fa52437f', '2026-01-15 08:06:38', '2026-04-10 22:53:50', '-7.571396379712262', '110.80922974792502');

-- --------------------------------------------------------

--
-- Table structure for table `ukuran_balihos`
--

CREATE TABLE IF NOT EXISTS `ukuran_balihos` (
  `id` char(36) NOT NULL,
  `ukuran_panjang` double NOT NULL,
  `ukuran_lebar` double NOT NULL,
  `layout` enum('horizontal','vertical') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ukuran_balihos`
--

INSERT INTO `ukuran_balihos` (`id`, `ukuran_panjang`, `ukuran_lebar`, `layout`, `created_at`, `updated_at`) VALUES
('13814d3d-c202-4fce-83dc-e5af8f5baa82', 4, 8, 'vertical', '2026-01-16 02:48:47', '2026-01-16 02:48:47'),
('423a2a9a-c6b3-4c39-bc53-8e2f01387fad', 4, 6, 'vertical', '2026-01-15 02:11:32', '2026-01-15 02:11:32'),
('79ffbbef-75fd-4b5e-ba2a-054aa1b349d2', 3, 5, 'vertical', '2026-04-11 01:02:33', '2026-04-11 01:02:33'),
('e60dc17b-eb4c-43f7-8d0c-e8c1fa52437f', 3, 4, 'vertical', '2026-04-10 22:27:33', '2026-04-10 22:27:33'),
('ea26cb13-a523-46df-bf71-ec8abd423b9e', 8, 4, 'horizontal', '2026-01-15 02:19:30', '2026-04-10 22:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` char(36) NOT NULL,
  `instansi_id` char(36) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `instansi_id`, `name`, `email`, `foto_profil`, `telepon`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('549ab1b1-075d-47e9-8013-e1f3a4127e6d', NULL, 'admin', 'erik@admin.com', NULL, '081111111111', NULL, '$2y$12$4B5Ugn/oSppU.i5CCnAKAeP.t4IZxAtaA/7P3Tq9bEqF93.cWo5F2', NULL, '2026-04-07 01:50:07', '2026-04-07 01:50:07'),
('8c09c324-fae4-4f95-8aea-8970cdde4490', NULL, 'Pimpinan DKISP', 'pimpinan@dkisp.com', NULL, '0812121212', NULL, '$2y$12$nuNi9boIsTWmZpwe/qnAReKNQZqkFh0ujCICA1Xs8xMDtLiwYjXHa', NULL, '2026-03-31 08:38:15', '2026-03-31 08:38:15'),
('cb93b0ae-61fd-466c-b454-153d6ba83123', NULL, 'Erik', 'erik@gmail.com', NULL, NULL, NULL, '$2y$12$tUzx8oJPp.cbJJz0CbOAQeMTpC35EVkEaCHQX2uC8ywJ9HVdDKgTi', NULL, '2025-10-10 17:30:21', '2025-10-10 17:30:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggaran_belanjas`
--
ALTER TABLE `anggaran_belanjas`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `anggaran_belanjas_tahun_anggaran_id_foreign` (`tahun_anggaran_id`) USING BTREE,
  ADD KEY `anggaran_belanjas_kegiatan_id_foreign` (`kegiatan_id`) USING BTREE;

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`) USING BTREE;

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`) USING BTREE;

--
-- Indexes for table `documentations`
--
ALTER TABLE `documentations`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `documentations_dokumentasiable_type_dokumentasiable_id_index` (`dokumentasiable_type`,`dokumentasiable_id`) USING BTREE;

--
-- Indexes for table `dokumentasi_med_koms`
--
ALTER TABLE `dokumentasi_med_koms`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING BTREE;

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `jobs_queue_index` (`queue`) USING BTREE;

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `kegiatans_layanan_id_foreign` (`layanan_id`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`) USING BTREE,
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`) USING BTREE;

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`) USING BTREE,
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`) USING BTREE;

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`) USING BTREE;

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`) USING BTREE;

--
-- Indexes for table `permohonans`
--
ALTER TABLE `permohonans`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `permohonans_instansi_id_foreign` (`instansi_id`) USING BTREE;

--
-- Indexes for table `permohonan_det_med_kom_cetaks`
--
ALTER TABLE `permohonan_det_med_kom_cetaks`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `permohonan_det_med_kom_cetaks_permohonan_id_foreign` (`permohonan_id`) USING BTREE,
  ADD KEY `permohonan_det_med_kom_cetaks_titik_baliho_id_foreign` (`titik_baliho_id`) USING BTREE,
  ADD KEY `permohonan_det_med_kom_cetaks_anggaran_id_foreign` (`anggaran_id`) USING BTREE,
  ADD KEY `permohonan_det_med_kom_cetaks_kegiatan_id_foreign` (`kegiatan_id`) USING BTREE;

--
-- Indexes for table `permohonan_det_med_kom_elektroniks`
--
ALTER TABLE `permohonan_det_med_kom_elektroniks`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `permohonan_det_med_kom_elektroniks_permohonan_id_foreign` (`permohonan_id`) USING BTREE,
  ADD KEY `permohonan_det_med_kom_elektroniks_anggaran_id_foreign` (`anggaran_id`) USING BTREE,
  ADD KEY `permohonan_det_med_kom_elektroniks_kegiatan_id_foreign` (`kegiatan_id`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`) USING BTREE,
  ADD KEY `roles_team_id_index` (`team_id`) USING BTREE;

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`) USING BTREE,
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`) USING BTREE;

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `sessions_user_id_index` (`user_id`) USING BTREE,
  ADD KEY `sessions_last_activity_index` (`last_activity`) USING BTREE;

--
-- Indexes for table `tahun_anggarans`
--
ALTER TABLE `tahun_anggarans`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_baliho`
--
ALTER TABLE `tbl_baliho`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_instansi`
--
ALTER TABLE `tbl_instansi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_layanan`
--
ALTER TABLE `tbl_layanan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `titik_balihos`
--
ALTER TABLE `titik_balihos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `titik_balihos_ukuran_baliho_id_foreign` (`ukuran_baliho_id`) USING BTREE;

--
-- Indexes for table `ukuran_balihos`
--
ALTER TABLE `ukuran_balihos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE,
  ADD KEY `users_instansi_id_foreign` (`instansi_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=164;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggaran_belanjas`
--
ALTER TABLE `anggaran_belanjas`
  ADD CONSTRAINT `anggaran_belanjas_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatans` (`id`),
  ADD CONSTRAINT `anggaran_belanjas_tahun_anggaran_id_foreign` FOREIGN KEY (`tahun_anggaran_id`) REFERENCES `tahun_anggarans` (`id`);

--
-- Constraints for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD CONSTRAINT `kegiatans_layanan_id_foreign` FOREIGN KEY (`layanan_id`) REFERENCES `tbl_layanan` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permohonans`
--
ALTER TABLE `permohonans`
  ADD CONSTRAINT `permohonans_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `tbl_instansi` (`id`);

--
-- Constraints for table `permohonan_det_med_kom_cetaks`
--
ALTER TABLE `permohonan_det_med_kom_cetaks`
  ADD CONSTRAINT `permohonan_det_med_kom_cetaks_anggaran_id_foreign` FOREIGN KEY (`anggaran_id`) REFERENCES `anggaran_belanjas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `permohonan_det_med_kom_cetaks_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `permohonan_det_med_kom_cetaks_permohonan_id_foreign` FOREIGN KEY (`permohonan_id`) REFERENCES `permohonans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permohonan_det_med_kom_cetaks_titik_baliho_id_foreign` FOREIGN KEY (`titik_baliho_id`) REFERENCES `titik_balihos` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `permohonan_det_med_kom_elektroniks`
--
ALTER TABLE `permohonan_det_med_kom_elektroniks`
  ADD CONSTRAINT `permohonan_det_med_kom_elektroniks_anggaran_id_foreign` FOREIGN KEY (`anggaran_id`) REFERENCES `anggaran_belanjas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `permohonan_det_med_kom_elektroniks_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `permohonan_det_med_kom_elektroniks_permohonan_id_foreign` FOREIGN KEY (`permohonan_id`) REFERENCES `permohonans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `titik_balihos`
--
ALTER TABLE `titik_balihos`
  ADD CONSTRAINT `titik_balihos_ukuran_baliho_id_foreign` FOREIGN KEY (`ukuran_baliho_id`) REFERENCES `ukuran_balihos` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `tbl_instansi` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
