/*
 Navicat Premium Data Transfer

 Source Server         : Database(MSI)
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : administrasi_structure

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 18/12/2025 10:42:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for agenda
-- ----------------------------
DROP TABLE IF EXISTS `agenda`;
CREATE TABLE `agenda`  (
  `id_agenda` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tempat_agenda` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_agenda` date NOT NULL,
  `tujuan_agenda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi_agenda` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  `id_dibuat_oleh` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_agenda`) USING BTREE,
  INDEX `id_dibuat_oleh_agenda`(`id_dibuat_oleh` ASC) USING BTREE,
  CONSTRAINT `id_dibuat_oleh_agenda` FOREIGN KEY (`id_dibuat_oleh`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of agenda
-- ----------------------------

-- ----------------------------
-- Table structure for agenda_surat
-- ----------------------------
DROP TABLE IF EXISTS `agenda_surat`;
CREATE TABLE `agenda_surat`  (
  `id_agenda_surat` int NOT NULL AUTO_INCREMENT,
  `jenis_surat` enum('Surat Keluar','Surat Ekspedisi','Surat Masuk') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_pengiriman_penerimaan` date NOT NULL,
  `tanggal_surat` date NOT NULL,
  `kode_surat` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pengirim_penerima` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isi_singkat` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `id_pengelola` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NULL DEFAULT 0,
  PRIMARY KEY (`id_agenda_surat`) USING BTREE,
  INDEX `id_pengelola_agenda_surat`(`id_pengelola` ASC) USING BTREE,
  CONSTRAINT `id_pengelola_agenda_surat` FOREIGN KEY (`id_pengelola`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of agenda_surat
-- ----------------------------

-- ----------------------------
-- Table structure for aparatur_desa
-- ----------------------------
DROP TABLE IF EXISTS `aparatur_desa`;
CREATE TABLE `aparatur_desa`  (
  `id_aparatur` int NOT NULL AUTO_INCREMENT,
  `jabatan` enum('Kepala Desa','Sekretaris Desa','Kaur Umum dan Tata Usaha','Kaur Keuangan','Kaur Perencanaan','Kasi Pemerintahan','Kasi Kesejahteraan','Kasi Pelayanan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nipd` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nip` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tempat_lahir` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` enum('ISLAM','KRISTEN','KHATOLIK','HINDU','BUDHA','KHONGHUCU','KEPERCAYAAN KEPADA TUHAN YME LAINNYA') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `golongan` enum('Ia','Ib','Ic','Id','IIa','IIc','IId','IIIa','IIIb','IIIc','IIId','IVa','IVb','IVc','IVd','IVe') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pendidikan` enum('TIDAK PERNAH SEKOLAH','TK/KELOMPOK BERMAIN','SD/SEDERAJAT','SLTP/SEDERAJAT','SLTA/SEDERAJAT','D-1/SEDERAJAT','D-2/SEDERAJAT','D-3/SEDERAJAT','S-1/SEDERAJAT','S-2/SEDERAJAT','S-3/SEDERAJAT','SLB /SEDERAJAT') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_pengangkatan` date NOT NULL,
  `tanggal_pemberhentian` date NULL DEFAULT NULL,
  `is_active` tinyint(1) NULL DEFAULT 1,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `id_pengelola` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_aparatur`) USING BTREE,
  UNIQUE INDEX `nip`(`nip` ASC) USING BTREE,
  UNIQUE INDEX `niap`(`nipd` ASC) USING BTREE,
  INDEX `id_pengelola_aparatur_desa`(`id_pengelola` ASC) USING BTREE,
  CONSTRAINT `id_pengelola_aparatur_desa` FOREIGN KEY (`id_pengelola`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of aparatur_desa
-- ----------------------------

-- ----------------------------
-- Table structure for apbdes
-- ----------------------------
DROP TABLE IF EXISTS `apbdes`;
CREATE TABLE `apbdes`  (
  `id_apbdes` int NOT NULL AUTO_INCREMENT,
  `tahun_anggaran` year NOT NULL,
  `pendapatan_desa` int NULL DEFAULT NULL,
  `belanja_desa` int NULL DEFAULT NULL,
  `pembiayaan_desa` int NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  `id_dibuat_oleh` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_apbdes`) USING BTREE,
  INDEX `id_pendapatan_desa_apbdes`(`pendapatan_desa` ASC) USING BTREE,
  INDEX `id_belanja_desa_apbdes`(`belanja_desa` ASC) USING BTREE,
  INDEX `id_pembiayaan_desa_apbdes`(`pembiayaan_desa` ASC) USING BTREE,
  INDEX `id_dibuat_oleh_apbdes`(`id_dibuat_oleh` ASC) USING BTREE,
  CONSTRAINT `id_belanja_desa_apbdes` FOREIGN KEY (`belanja_desa`) REFERENCES `belanja_desa` (`id_belanja_desa`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `id_dibuat_oleh_apbdes` FOREIGN KEY (`id_dibuat_oleh`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `id_pembiayaan_desa_apbdes` FOREIGN KEY (`pembiayaan_desa`) REFERENCES `pembiayaan_desa` (`id_pembiayaan_desa`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `id_pendapatan_desa_apbdes` FOREIGN KEY (`pendapatan_desa`) REFERENCES `pendapatan_desa` (`id_pendapatan_desa`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of apbdes
-- ----------------------------

-- ----------------------------
-- Table structure for belanja_desa
-- ----------------------------
DROP TABLE IF EXISTS `belanja_desa`;
CREATE TABLE `belanja_desa`  (
  `id_belanja_desa` int NOT NULL AUTO_INCREMENT,
  `penyelenggaraan_pemerintahan` double NOT NULL,
  `pelaksanaan_pembangunan` double NOT NULL,
  `pembinaan_kemasyarakatan` double NOT NULL,
  `pemberdayaan_masyarakat` double NOT NULL,
  `penanggulangan_bencana_darurat_mendesak` double NOT NULL,
  `belanja_tak_terduga` double NOT NULL,
  `r_penyelenggaraan_pemerintahan` double NOT NULL,
  `r_pelaksanaan_pembangunan` double NOT NULL,
  `r_pembinaan_kemasyarakatan` double NOT NULL,
  `r_pemberdayaan_masyarakat` double NOT NULL,
  `r_penanggulangan_bencana_darurat_mendesak` double NOT NULL,
  `r_belanja_tak_terduga` double NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_belanja_desa`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of belanja_desa
-- ----------------------------

-- ----------------------------
-- Table structure for berita
-- ----------------------------
DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita`  (
  `id_berita` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  `id_dibuat_oleh` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_berita`) USING BTREE,
  INDEX `id_dibuat_oleh_berita`(`id_dibuat_oleh` ASC) USING BTREE,
  CONSTRAINT `id_dibuat_oleh_berita` FOREIGN KEY (`id_dibuat_oleh`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of berita
-- ----------------------------

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for dusun
-- ----------------------------
DROP TABLE IF EXISTS `dusun`;
CREATE TABLE `dusun`  (
  `id_dusun` int NOT NULL AUTO_INCREMENT,
  `dusun` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `is_deleted` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_dusun`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of dusun
-- ----------------------------

-- ----------------------------
-- Table structure for inventaris_desa
-- ----------------------------
DROP TABLE IF EXISTS `inventaris_desa`;
CREATE TABLE `inventaris_desa`  (
  `id_inventaris_desa` int NOT NULL AUTO_INCREMENT,
  `jenis_inventaris` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `oleh_desa` int NOT NULL,
  `oleh_pemerintah` int NOT NULL,
  `oleh_provinsi` int NOT NULL,
  `oleh_kabupaten` int NOT NULL,
  `oleh_sumbangan` int NOT NULL,
  `awal_baik` int NOT NULL,
  `awal_rusak` int NOT NULL,
  `jumlah_rusak` int UNSIGNED NOT NULL,
  `jumlah_baik` int NOT NULL,
  `jumlah_dijual` int NULL DEFAULT NULL,
  `jumlah_disumbangkan` int NULL DEFAULT NULL,
  `tanggal_penghapusan` date NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  `id_pengelola` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_inventaris_desa`) USING BTREE,
  INDEX `id_pengelola_inventaris_desa`(`id_pengelola` ASC) USING BTREE,
  CONSTRAINT `id_pengelola_inventaris_desa` FOREIGN KEY (`id_pengelola`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of inventaris_desa
-- ----------------------------

-- ----------------------------
-- Table structure for kader_pemberdayaan
-- ----------------------------
DROP TABLE IF EXISTS `kader_pemberdayaan`;
CREATE TABLE `kader_pemberdayaan`  (
  `id_kader_pemberdayaan` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pendidikan` enum('TIDAK PERNAH SEKOLAH','TK/KELOMPOK BERMAIN','SD/SEDERAJAT','SLTP/SEDERAJAT','SLTA/SEDERAJAT','D-1/SEDERAJAT','D-2/SEDERAJAT','D-3/SEDERAJAT','S-1/SEDERAJAT','S-2/SEDERAJAT','S-3/SEDERAJAT','SLB /SEDERAJAT') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bidang_keahlian` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  `id_pengelola` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_kader_pemberdayaan`) USING BTREE,
  INDEX `fk_bidang_keahlian`(`bidang_keahlian` ASC) USING BTREE,
  INDEX `id_pengelola_kader_pemberdayaan`(`id_pengelola` ASC) USING BTREE,
  CONSTRAINT `id_pengelola_kader_pemberdayaan` FOREIGN KEY (`id_pengelola`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kader_pemberdayaan
-- ----------------------------

-- ----------------------------
-- Table structure for kartu_keluarga
-- ----------------------------
DROP TABLE IF EXISTS `kartu_keluarga`;
CREATE TABLE `kartu_keluarga`  (
  `id_kartu_keluarga` int NOT NULL AUTO_INCREMENT,
  `nomor_kartu_keluarga` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `alamat_kk` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rt` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `rw` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `desa_kelurahan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kecamatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kabupaten_kota` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode_pos` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `provinsi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NULL DEFAULT 0,
  PRIMARY KEY (`id_kartu_keluarga`) USING BTREE,
  UNIQUE INDEX `no_kk`(`nomor_kartu_keluarga` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kartu_keluarga
-- ----------------------------

-- ----------------------------
-- Table structure for keputusan_kepala_desa
-- ----------------------------
DROP TABLE IF EXISTS `keputusan_kepala_desa`;
CREATE TABLE `keputusan_kepala_desa`  (
  `id_keputusan_kepala_desa` int NOT NULL AUTO_INCREMENT,
  `tanggal_keputusan` date NOT NULL,
  `tentang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `uraian` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_dilaporkan` date NULL DEFAULT NULL,
  `tujuan_dilaporkan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `id_pengelola` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_keputusan_kepala_desa`) USING BTREE,
  INDEX `id_pengelola_keputusan_kepala_desa`(`id_pengelola` ASC) USING BTREE,
  CONSTRAINT `id_pengelola_keputusan_kepala_desa` FOREIGN KEY (`id_pengelola`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of keputusan_kepala_desa
-- ----------------------------

-- ----------------------------
-- Table structure for organisasi
-- ----------------------------
DROP TABLE IF EXISTS `organisasi`;
CREATE TABLE `organisasi`  (
  `id_organisasi` int NOT NULL AUTO_INCREMENT,
  `nama_organisasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_berdiri` date NOT NULL,
  `alamat` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ketua` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto_ketua` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sekretaris` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto_sekretaris` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bendahara` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto_bendahara` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `logo_organisasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `visi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `misi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_organisasi`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of organisasi
-- ----------------------------

-- ----------------------------
-- Table structure for pembangunan
-- ----------------------------
DROP TABLE IF EXISTS `pembangunan`;
CREATE TABLE `pembangunan`  (
  `id_pembangunan` int NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `biaya_pemerintah` double NOT NULL,
  `biaya_provinsi` double NOT NULL,
  `biaya_kabupaten_kota` double NOT NULL,
  `biaya_swadaya` double NOT NULL,
  `lokasi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pelaksana` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `manfaat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `sifat_proyek` enum('Baru','Lanjutan','Rehab') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status_pengerjaan` enum('Belum Dimulai','Sedang Dikerjakan','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Belum Dimulai',
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `dokumentasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NULL DEFAULT 0,
  `id_pengelola` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_pembangunan`) USING BTREE,
  INDEX `id_pengelola_pembangunan`(`id_pengelola` ASC) USING BTREE,
  CONSTRAINT `id_pengelola_pembangunan` FOREIGN KEY (`id_pengelola`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pembangunan
-- ----------------------------

-- ----------------------------
-- Table structure for pembiayaan_desa
-- ----------------------------
DROP TABLE IF EXISTS `pembiayaan_desa`;
CREATE TABLE `pembiayaan_desa`  (
  `id_pembiayaan_desa` int NOT NULL AUTO_INCREMENT,
  `silpa_tahun_sebelumnya` double NOT NULL,
  `pencairan_dana_cadangan` double NULL DEFAULT NULL,
  `hasil_penjualan_kekayaan_desa` double NULL DEFAULT NULL,
  `pembentukan_dana_cadangan` double NOT NULL,
  `penyertaan_modal` double NOT NULL,
  `r_silpa_tahun_sebelumnya` double NOT NULL,
  `r_pencairan_dana_cadangan` double NOT NULL,
  `r_hasil_penjualan_kekayaan_desa` double NOT NULL,
  `r_pembentukan_dana_cadangan` double NOT NULL,
  `r_penyertaan_modal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pembiayaan_desa`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pembiayaan_desa
-- ----------------------------

-- ----------------------------
-- Table structure for pendapatan_desa
-- ----------------------------
DROP TABLE IF EXISTS `pendapatan_desa`;
CREATE TABLE `pendapatan_desa`  (
  `id_pendapatan_desa` int NOT NULL AUTO_INCREMENT,
  `hasil_usaha` double NOT NULL,
  `hasil_aset` double NOT NULL,
  `swadaya_partisipasi_gotong_royong` double NOT NULL,
  `pendapatan_asli_lain` double NOT NULL,
  `dana_desa` double NOT NULL,
  `bagian_pajak_daerah` double NOT NULL,
  `retribusi_daerah` double NOT NULL,
  `alokasi_dana_desa` double NOT NULL,
  `bantuan_keuangan_provinsi` double NOT NULL,
  `bantuan_keuangan_kabupaten` double NOT NULL,
  `penerimaan_kerja_sama` double NOT NULL,
  `bantuan_perusahaan_di_desa` double NOT NULL,
  `hibah_sumbangan_pihak_ketiga` double NOT NULL,
  `koreksi_kesalahan_belanja` double NOT NULL,
  `bunga_bank_desa` double NOT NULL,
  `pendapatan_lain_sah` double NOT NULL,
  `r_hasil_usaha` double NOT NULL,
  `r_hasil_aset` double NOT NULL,
  `r_swadaya_partisipasi_gotong_royong` double NOT NULL,
  `r_pendapatan_asli_lain` double NOT NULL,
  `r_dana_desa` double NOT NULL,
  `r_bagian_pajak_daerah` double NOT NULL,
  `r_retribusi_daerah` double NOT NULL,
  `r_alokasi_dana_desa` double NOT NULL,
  `r_bantuan_keuangan_provinsi` double NOT NULL,
  `r_bantuan_keuangan_kabupaten` double NOT NULL,
  `r_penerimaan_kerja_sama` double NOT NULL,
  `r_bantuan_perusahaan_di_desa` double NOT NULL,
  `r_hibah_sumbangan_pihak_ketiga` double NOT NULL,
  `r_koreksi_kesalahan_belanja` double NOT NULL,
  `r_bunga_bank_desa` double NOT NULL,
  `r_pendapatan_lain_sah` double NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_deleted` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pendapatan_desa`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pendapatan_desa
-- ----------------------------

-- ----------------------------
-- Table structure for penduduk
-- ----------------------------
DROP TABLE IF EXISTS `penduduk`;
CREATE TABLE `penduduk`  (
  `id_penduduk` int NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_ayah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_ibu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_kartu_keluarga` int NOT NULL,
  `tempat_lahir` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kewarganegaraan` enum('WNI','WNA') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nomor_akta_lahir` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `golongan_darah` enum('A','A+','A-','B','B+','B-','AB','AB+','AB-','O','O+','O-') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `agama` enum('ISLAM','KRISTEN','KHATOLIK','HINDU','BUDHA','KHONGHUCU','KEPERCAYAAN KEPADA TUHAN YME LAINNYA') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_keluar_ktp` date NULL DEFAULT NULL,
  `keturunan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `status_perkawinan` enum('Belum Kawin','Kawin Tercatat','Cerai Hidup','Cerai Mati') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pendidikan_terakhir` enum('TIDAK PERNAH SEKOLAH','TK/KELOMPOK BERMAIN','SD/SEDERAJAT','SLTP/SEDERAJAT','SLTA/SEDERAJAT','D-1/SEDERAJAT','D-2/SEDERAJAT','D-3/SEDERAJAT','S-1/SEDERAJAT','S-2/SEDERAJAT','S-3/SEDERAJAT','SLB /SEDERAJAT') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pekerjaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `baca_huruf` enum('D','A','L','I') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kedudukan_keluarga` enum('KEPALA KELUARGA','ISTRI','ANAK','FAMILI LAIN') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dusun` int NOT NULL,
  `asal_penduduk` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `suku` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `tanggal_penambahan` date NOT NULL,
  `tanggal_pengurangan` date NULL DEFAULT NULL,
  `tujuan_pindah` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `tempat_meninggal` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  `is_mutated` tinyint NOT NULL DEFAULT 0,
  `id_pengelola` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_penduduk`) USING BTREE,
  UNIQUE INDEX `nik`(`nik` ASC) USING BTREE,
  INDEX `fk_penduduk_pekerjaan`(`pekerjaan` ASC) USING BTREE,
  INDEX `fk_penduduk_dusun`(`dusun` ASC) USING BTREE,
  INDEX `fk_penduduk_kartu_keluarga`(`id_kartu_keluarga` ASC) USING BTREE,
  INDEX `id_pengelola_penduduk`(`id_pengelola` ASC) USING BTREE,
  CONSTRAINT `fk_penduduk_dusun` FOREIGN KEY (`dusun`) REFERENCES `dusun` (`id_dusun`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_penduduk_kartu_keluarga` FOREIGN KEY (`id_kartu_keluarga`) REFERENCES `kartu_keluarga` (`id_kartu_keluarga`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `id_pengelola_penduduk` FOREIGN KEY (`id_pengelola`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of penduduk
-- ----------------------------

-- ----------------------------
-- Table structure for penduduk_sementara
-- ----------------------------
DROP TABLE IF EXISTS `penduduk_sementara`;
CREATE TABLE `penduduk_sementara`  (
  `id_penduduk` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nomor_pengenal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tempat_lahir` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pekerjaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kewarganegaraan` enum('WNI','WNA') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keturunan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `asal` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `maksud_kedatangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tokoh_tujuan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat_tujuan` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_kedatangan` date NOT NULL,
  `tanggal_kepulangan` date NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  `id_pengelola` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_penduduk`) USING BTREE,
  UNIQUE INDEX `nomor_pengenal_unique`(`nomor_pengenal` ASC) USING BTREE,
  INDEX `id_pekerjaan_penduduk_sementara`(`pekerjaan` ASC) USING BTREE,
  INDEX `id_pengelola_penduduk_sementara`(`id_pengelola` ASC) USING BTREE,
  CONSTRAINT `id_pengelola_penduduk_sementara` FOREIGN KEY (`id_pengelola`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of penduduk_sementara
-- ----------------------------

-- ----------------------------
-- Table structure for pengumuman
-- ----------------------------
DROP TABLE IF EXISTS `pengumuman`;
CREATE TABLE `pengumuman`  (
  `id_pengumuman` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gambar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  `id_dibuat_oleh` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengumuman`) USING BTREE,
  INDEX `id_dibuat_oleh_pengumuman`(`id_dibuat_oleh` ASC) USING BTREE,
  CONSTRAINT `id_dibuat_oleh_pengumuman` FOREIGN KEY (`id_dibuat_oleh`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pengumuman
-- ----------------------------

-- ----------------------------
-- Table structure for peraturan_desa
-- ----------------------------
DROP TABLE IF EXISTS `peraturan_desa`;
CREATE TABLE `peraturan_desa`  (
  `id_peraturan_desa` int NOT NULL AUTO_INCREMENT,
  `jenis_peraturan` enum('Peraturan Desa','Peraturan Bersama','Peraturan Kepala Desa') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_ditetapkan` date NOT NULL,
  `tentang` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `uraian_singkat` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_kesepakatan` date NOT NULL,
  `tanggal_dilaporkan` date NOT NULL,
  `tujuan_dilaporkan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_diundangkan_berita_desa` date NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  `id_pengelola` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_peraturan_desa`) USING BTREE,
  INDEX `id_pengelola_peratura_desa`(`id_pengelola` ASC) USING BTREE,
  CONSTRAINT `id_pengelola_peratura_desa` FOREIGN KEY (`id_pengelola`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of peraturan_desa
-- ----------------------------

-- ----------------------------
-- Table structure for profil
-- ----------------------------
DROP TABLE IF EXISTS `profil`;
CREATE TABLE `profil`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `unique_key`(`key` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of profil
-- ----------------------------
INSERT INTO `profil` VALUES (1, 'deskripsi_beranda', NULL);
INSERT INTO `profil` VALUES (2, 'gambar_landing_page', NULL);
INSERT INTO `profil` VALUES (3, 'profil_desa', NULL);
INSERT INTO `profil` VALUES (4, 'visi_desa', NULL);
INSERT INTO `profil` VALUES (5, 'misi_desa', NULL);
INSERT INTO `profil` VALUES (6, 'sejarah_desa', NULL);
INSERT INTO `profil` VALUES (7, 'link_iframe_maps', NULL);
INSERT INTO `profil` VALUES (8, 'deskripsi_singkat_desa', NULL);
INSERT INTO `profil` VALUES (9, 'deskripsi_singkat_organisasi', NULL);

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sessions
-- ----------------------------

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `unique_key`(`key` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (1, 'logo', NULL);
INSERT INTO `settings` VALUES (2, 'nama_desa', NULL);
INSERT INTO `settings` VALUES (3, 'deskripsi_footer', NULL);
INSERT INTO `settings` VALUES (4, 'link_fb', NULL);
INSERT INTO `settings` VALUES (5, 'link_ig', NULL);
INSERT INTO `settings` VALUES (6, 'link_twt', NULL);
INSERT INTO `settings` VALUES (7, 'link_wa', NULL);
INSERT INTO `settings` VALUES (8, 'link_yt', NULL);
INSERT INTO `settings` VALUES (9, 'nomor_telp', NULL);
INSERT INTO `settings` VALUES (10, 'nomor_hp', NULL);
INSERT INTO `settings` VALUES (11, 'email', NULL);

-- ----------------------------
-- Table structure for tanah_desa
-- ----------------------------
DROP TABLE IF EXISTS `tanah_desa`;
CREATE TABLE `tanah_desa`  (
  `id_tanah_desa` int NOT NULL AUTO_INCREMENT,
  `nama_pemegang_hak_tanah` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `luas_hm` double NOT NULL,
  `luas_hgb` double NOT NULL,
  `luas_hp` double NOT NULL,
  `luas_hgu` double NOT NULL,
  `luas_hpl` double NOT NULL,
  `luas_ma` double NOT NULL,
  `luas_vi` double NOT NULL,
  `luas_tn` double NOT NULL,
  `luas_perumahan` double NOT NULL,
  `luas_perdagangan` double NOT NULL,
  `luas_perkantoran` double NOT NULL,
  `luas_industri` double NOT NULL,
  `luas_fasilitas_umum` double NOT NULL,
  `luas_sawah` double NOT NULL,
  `luas_tegalan` double NOT NULL,
  `luas_perkebunan` double NOT NULL,
  `luas_peternakan_perikanan` double NOT NULL,
  `luas_hutan_belukar` double NOT NULL,
  `luas_hutan_lebat` double NOT NULL,
  `luas_tanah_kosong` double NOT NULL,
  `luas_tanah_lain` double NOT NULL,
  `mutasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  `id_pengelola` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_tanah_desa`) USING BTREE,
  INDEX `id_pengelola_tanah_desa`(`id_pengelola` ASC) USING BTREE,
  CONSTRAINT `id_pengelola_tanah_desa` FOREIGN KEY (`id_pengelola`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tanah_desa
-- ----------------------------

-- ----------------------------
-- Table structure for tanah_kas_desa
-- ----------------------------
DROP TABLE IF EXISTS `tanah_kas_desa`;
CREATE TABLE `tanah_kas_desa`  (
  `id_tkd` int NOT NULL AUTO_INCREMENT,
  `asal_tkd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `letter_c` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `persil` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `oleh_desa` double NOT NULL,
  `oleh_pemerintah` double NOT NULL,
  `oleh_provinsi` double NOT NULL,
  `oleh_kabupaten` double NOT NULL,
  `oleh_lain_lain` double NOT NULL,
  `tanggal_perolehan` date NOT NULL,
  `sawah` double NOT NULL,
  `tegal` double NOT NULL,
  `kebun` double NOT NULL,
  `tombak` double NOT NULL,
  `tanah_kering` double NOT NULL,
  `patok` double NOT NULL,
  `tanpa_patok` double NOT NULL,
  `papan_nama` double NOT NULL,
  `tanpa_papan_nama` double NOT NULL,
  `lokasi` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `peruntukan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint NOT NULL DEFAULT 0,
  `id_pengelola` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id_tkd`) USING BTREE,
  INDEX `id_pengelola_tanah_kas_desa`(`id_pengelola` ASC) USING BTREE,
  CONSTRAINT `id_pengelola_tanah_kas_desa` FOREIGN KEY (`id_pengelola`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tanah_kas_desa
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint NULL DEFAULT NULL,
  `role` enum('admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (2, 'Admin Desa', 'desadigital@gmail.com', NULL, '$2y$12$hjik9KsuKwcCR6kEFTjUcO8VWBFULZPcRwhItjh/f9Y3VYwbaTajm', NULL, '2025-07-27 16:09:34', '2025-07-27 16:09:34', NULL, 'admin');

SET FOREIGN_KEY_CHECKS = 1;
