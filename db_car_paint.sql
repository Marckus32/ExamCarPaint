/*
 Navicat Premium Data Transfer

 Source Server         : phpmyadmin
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : db_car_paint

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 28/11/2020 10:51:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_queue
-- ----------------------------
DROP TABLE IF EXISTS `tbl_queue`;
CREATE TABLE `tbl_queue`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plate_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `current_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `target_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `is_completed` int(11) NULL DEFAULT 0,
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
