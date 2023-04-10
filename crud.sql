/*
 Navicat Premium Data Transfer

 Source Server         : DB
 Source Server Type    : MySQL
 Source Server Version : 80031 (8.0.31)
 Source Host           : localhost:3306
 Source Schema         : crud

 Target Server Type    : MySQL
 Target Server Version : 80031 (8.0.31)
 File Encoding         : 65001

 Date: 10/04/2023 19:13:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for crud
-- ----------------------------
DROP TABLE IF EXISTS `crud`;
CREATE TABLE `crud`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nim` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_mahasiswa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nohp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_keuangan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crud
-- ----------------------------
INSERT INTO `crud` VALUES (1, '888888888', 'John Doe', '081234567890', 'Pembayaran Kuliah', '2.500.000', NULL);
INSERT INTO `crud` VALUES (2, '555555555', 'Jane Doe', '082345678901', 'Pembayaran SPP', '2.500.000', 'keterangan saja');
INSERT INTO `crud` VALUES (3, '777777777', 'Bob Smith', '083456789012', 'Pembayaran SPP', '2.500.000', NULL);

SET FOREIGN_KEY_CHECKS = 1;
