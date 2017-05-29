/*
 Navicat Premium Data Transfer

 Source Server         : lokalmy
 Source Server Type    : MySQL
 Source Server Version : 50628
 Source Host           : localhost
 Source Database       : cbttest_db

 Target Server Type    : MySQL
 Target Server Version : 50628
 File Encoding         : utf-8

 Date: 05/29/2017 13:44:41 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `c_mahasiswa`
-- ----------------------------
DROP TABLE IF EXISTS `c_mahasiswa`;
CREATE TABLE `c_mahasiswa` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no_ujian` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `id_jurusan` int(3) NOT NULL,
  `id_prodi1` int(3) NOT NULL,
  `id_prodi2` int(3) NOT NULL,
  `jkel` varchar(3) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `member_type` varchar(100) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `c_mahasiswa`
-- ----------------------------
BEGIN;
INSERT INTO `c_mahasiswa` VALUES ('1', '1234567891011', '2003-01-01', '1', '1', '2', 'L', 'aris tri', 'Y', '1'), ('2', '1111111111111', '2003-01-01', '1', '1', '2', 'L', 'paijo', 'Y', '1'), ('3', '9348209384901', '2002-01-01', '1', '1', '2', 'L', 'sjdlajdljal', 'Y', '1');
COMMIT;

-- ----------------------------
--  Table structure for `hasil_test`
-- ----------------------------
DROP TABLE IF EXISTS `hasil_test`;
CREATE TABLE `hasil_test` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_ujian` varchar(20) NOT NULL,
  `id_mhs` varchar(20) NOT NULL,
  `mulai` varchar(20) NOT NULL,
  `akhir` varchar(20) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `monitor` varchar(100) NOT NULL,
  `jawaban` varchar(100) NOT NULL,
  `lsoal` text NOT NULL,
  `xsoal` text NOT NULL,
  `terjawab` varchar(100) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `soal` text NOT NULL,
  `soal_reading` text NOT NULL,
  `score` int(5) NOT NULL,
  `benar` varchar(100) NOT NULL,
  `salah` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `hasil_test`
-- ----------------------------
BEGIN;
INSERT INTO `hasil_test` VALUES ('1', '1', '3', '2017-05-29 08:17:48', '2017-05-29 09:47:48', '', '', '', '1,2,3,4,5', '', '', 'Y', '', '', '0', '', '');
COMMIT;

-- ----------------------------
--  Table structure for `jurusan`
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_kelompok` int(4) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `is_active` enum('T','Y') DEFAULT 'Y',
  `is_guru` enum('Y','N') DEFAULT NULL,
  `ket` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `jurusan`
-- ----------------------------
BEGIN;
INSERT INTO `jurusan` VALUES ('1', '1', 'Pendidikan Matematika', 'Y', 'Y', null), ('2', '1', 'Pendidikan Biologi', 'Y', 'Y', null), ('3', '1', 'Pendidikan Fisika', 'Y', 'Y', null), ('4', '1', 'Pendidikan Matematika Berstandar Internasional', 'Y', 'Y', null), ('5', '1', 'Pendidikan Biologi Berstandar Internasional', 'Y', 'Y', null), ('6', '1', 'Pendidikan Fisika Berstandar Internasional', 'Y', 'Y', null), ('7', '1', 'Pendidikan Teknologi Informasi', 'Y', 'Y', null), ('8', '1', 'Arsitektur', 'Y', 'N', null), ('9', '1', 'Teknik Sipil - DIII', 'T', 'N', null), ('10', '1', 'Teknik Mesin - DIII', 'T', 'N', null), ('11', '1', 'Teknik Elektronika - DIII', 'T', 'N', null), ('12', '1', 'Teknik Sipil - S1', 'Y', 'N', null), ('13', '1', 'Teknik Mesin - S1', 'Y', 'N', null), ('14', '1', 'Teknik Elektro - S1', 'Y', 'N', null), ('15', '1', 'Informatika', 'Y', 'N', null), ('16', '1', 'Teknik Lingkungan', 'Y', 'N', null), ('17', '1', 'Teknologi Pangan', 'Y', 'N', null), ('18', '2', 'Bimbingan Konseling', 'Y', 'Y', null), ('19', '2', 'Pendidikan Guru Sekolah Dasar', '', 'Y', ''), ('20', '2', 'Pendidikan Anak Usia Dini', 'Y', 'Y', null), ('21', '2', 'Pendidikan Pancasila dan Kewarganegaraan', 'Y', 'Y', null), ('22', '2', 'Pendidikan Ekonomi', 'Y', 'Y', null), ('23', '2', 'Pendidikan Jasmani, Kesehatan dan Rekreasi', 'Y', 'Y', null), ('24', '2', 'Pendidikan Bahasa dan Sastra Indonesia', 'Y', 'Y', null), ('25', '2', 'Pendidikan Bahasa Inggris', 'Y', 'Y', null), ('26', '2', 'Pendidikan Bahasa dan Sastra Daerah', 'Y', 'Y', null);
COMMIT;

-- ----------------------------
--  Table structure for `kelompok`
-- ----------------------------
DROP TABLE IF EXISTS `kelompok`;
CREATE TABLE `kelompok` (
  `id` int(2) NOT NULL,
  `kelompok` varchar(10) NOT NULL,
  `is_active` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `kelompok`
-- ----------------------------
BEGIN;
INSERT INTO `kelompok` VALUES ('1', 'IPA', 'Y'), ('2', 'IPS', 'Y'), ('4', 'IPC', 'y');
COMMIT;

-- ----------------------------
--  Table structure for `soal`
-- ----------------------------
DROP TABLE IF EXISTS `soal`;
CREATE TABLE `soal` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `soal` varchar(200) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `gambar` varchar(20) NOT NULL,
  `jawaban_A` varchar(20) NOT NULL,
  `jawaban_B` varchar(20) NOT NULL,
  `jawaban_C` varchar(20) NOT NULL,
  `jawaban_D` varchar(20) NOT NULL,
  `jawaban_E` varchar(255) NOT NULL,
  `kunci` enum('A','B','C','D','E') NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `mapel` varchar(50) NOT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `soal`
-- ----------------------------
BEGIN;
INSERT INTO `soal` VALUES ('1', '', '', '1.png', '', '', '', '', '', 'C', 'Y', 'math', ''), ('2', '', '', '2.png', '', '', '', '', '', 'D', 'Y', 'math', ''), ('3', '', '', '3.png', '', '', '', '', '', 'B', 'Y', 'math', ''), ('4', '', '', '4.png', '', '', '', '', '', 'D', 'Y', 'math', ''), ('5', '', '', '5.png', '', '', '', '', '', 'D', 'Y', 'math', ''), ('6', '', '', '6.png', '', '', '', '', '', 'B', 'Y', 'b_ind', ''), ('7', '', '', '7.png', '', '', '', '', '', 'C', 'Y', 'b_ind', ''), ('8', '', '', '8.png', '', '', '', '', '', 'A', 'Y', 'b_ind', '');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
