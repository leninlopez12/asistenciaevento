/*
 Navicat Premium Data Transfer

 Source Server         : asistenciainudi
 Source Server Type    : MySQL
 Source Server Version : 80300 (8.3.0)
 Source Host           : localhost:3306
 Source Schema         : asistenciainudi

 Target Server Type    : MySQL
 Target Server Version : 80300 (8.3.0)
 File Encoding         : 65001

 Date: 07/03/2024 15:51:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for asistencia
-- ----------------------------
DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE `asistencia`  (
  `id_asistencia` int NOT NULL AUTO_INCREMENT,
  `id_asistente` int NOT NULL,
  `entrada` datetime NULL DEFAULT NULL,
  `salida` datetime NULL DEFAULT NULL,
  `id_evento` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_asistencia`) USING BTREE,
  INDEX `fk2`(`id_asistente` ASC) USING BTREE,
  CONSTRAINT `fk2` FOREIGN KEY (`id_asistente`) REFERENCES `asistente` (`id_asistente`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of asistencia
-- ----------------------------
INSERT INTO `asistencia` VALUES (1, 1, '2024-03-07 11:47:38', '2024-03-07 11:47:41', NULL);
INSERT INTO `asistencia` VALUES (2, 2, '2024-03-07 12:05:12', '2024-03-07 12:05:14', NULL);
INSERT INTO `asistencia` VALUES (3, 3, '2024-03-07 03:50:31', '2024-03-07 03:50:34', NULL);

-- ----------------------------
-- Table structure for grado
-- ----------------------------
DROP TABLE IF EXISTS `grado`;
CREATE TABLE `grado`  (
  `id_grado` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_grado`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of grado
-- ----------------------------
INSERT INTO `grado` VALUES (1, 'doctor');
INSERT INTO `grado` VALUES (2, 'titulado');

-- ----------------------------
-- Table structure for asistente
-- ----------------------------
DROP TABLE IF EXISTS `asistente`;
CREATE TABLE `asistente`  (
  `id_asistente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `apellido` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `dni` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `grado` int NOT NULL,
  `id_evento` int NULL DEFAULT NULL,
  `correo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `celular` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_asistente`) USING BTREE,
  INDEX `fk1`(`grado` ASC) USING BTREE,
  CONSTRAINT `fk1` FOREIGN KEY (`grado`) REFERENCES `grado` (`id_grado`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of asistente
-- ----------------------------
INSERT INTO `asistente` VALUES (1, 'lenin', 'López Yucra', '75896898', 1, 1, 'lenin@gmail.com', '952808082');
INSERT INTO `asistente` VALUES (2, 'lenino', 'Lopez', '7589555', 2, 1, 'elia@gmail.com', '88884585');
INSERT INTO `asistente` VALUES (3, 'edison', 'ramos', '75227341', 1, 1, 'ediii@gmail.com', '987456321');
INSERT INTO `asistente` VALUES (4, 'Antonio', 'Ra', '7896541', 2, 2, NULL, NULL);

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa`  (
  `id_empresa` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `ubicacion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `ruc` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_empresa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of empresa
-- ----------------------------
INSERT INTO `empresa` VALUES (1, 'INUDI SAC', '925310896 ', 'URB LOS JARDINES', '78945612378 ');

-- ----------------------------
-- Table structure for evento
-- ----------------------------
DROP TABLE IF EXISTS `evento`;
CREATE TABLE `evento`  (
  `id_evento` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `fecha` date NOT NULL,
  `tipo_evento` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_evento`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of evento
-- ----------------------------
INSERT INTO `evento` VALUES (1, 'X CONGRESO INTERNACIONAL', '2024-03-07', 'CONGRESO internaciona2');
INSERT INTO `evento` VALUES (2, 'TALLER DE INNOVACIÓN ', '2024-03-06', 'TALLER');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `apellido` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `usuario` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `id_evento` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'ismaelito', 'sandoval', 'isai', '202cb962ac59075b964b07152d234b70', NULL);
INSERT INTO `usuario` VALUES (2, 'juan', 'mamani', 'juan', '202cb962ac59075b964b07152d234b70', NULL);

SET FOREIGN_KEY_CHECKS = 1;
