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
  `id_empleado` int NOT NULL,
  `entrada` datetime NULL DEFAULT NULL,
  `salida` datetime NULL DEFAULT NULL,
  `id_evento` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_asistencia`) USING BTREE,
  INDEX `fk2`(`id_empleado` ASC) USING BTREE,
  CONSTRAINT `fk2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of asistencia
-- ----------------------------
INSERT INTO `asistencia` VALUES (25, 6, '2024-03-07 11:37:06', '2024-03-07 11:44:45', NULL);
INSERT INTO `asistencia` VALUES (26, 11, '2024-03-07 11:47:38', '2024-03-07 11:47:41', NULL);
INSERT INTO `asistencia` VALUES (27, 13, '2024-03-07 12:05:12', '2024-03-07 12:05:14', NULL);
INSERT INTO `asistencia` VALUES (28, 14, '2024-03-07 03:50:31', '2024-03-07 03:50:34', NULL);

-- ----------------------------
-- Table structure for cargo
-- ----------------------------
DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo`  (
  `id_cargo` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_cargo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cargo
-- ----------------------------
INSERT INTO `cargo` VALUES (1, 'cirujano');
INSERT INTO `cargo` VALUES (2, 'odontologo');
INSERT INTO `cargo` VALUES (3, 'farmacia');
INSERT INTO `cargo` VALUES (4, 'limpieza');
INSERT INTO `cargo` VALUES (5, 'enfermera');

-- ----------------------------
-- Table structure for empleado
-- ----------------------------
DROP TABLE IF EXISTS `empleado`;
CREATE TABLE `empleado`  (
  `id_empleado` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `apellido` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `dni` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cargo` int NOT NULL,
  `id_evento` int NULL DEFAULT NULL,
  `correo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `celular` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_empleado`) USING BTREE,
  INDEX `fk1`(`cargo` ASC) USING BTREE,
  CONSTRAINT `fk1` FOREIGN KEY (`cargo`) REFERENCES `cargo` (`id_cargo`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of empleado
-- ----------------------------
INSERT INTO `empleado` VALUES (1, 'juan manuel', 'quispe chocce', '78945612', 1, NULL, 'juean@gmail.com', '952808082');
INSERT INTO `empleado` VALUES (3, 'erick', 'muleta paredes', '77885522', 3, NULL, '1@gmail.com', '951454184');
INSERT INTO `empleado` VALUES (4, 'maria', 'molina gutierrez', '00225566', 5, NULL, '2@gmail.com', '945145154');
INSERT INTO `empleado` VALUES (6, 'ismael', 'sandoval', '74433542', 4, NULL, 'isam@gmail.com', '941545154');
INSERT INTO `empleado` VALUES (11, 'prueba', 'prueba', '00225588', 1, NULL, 'prueba@gmail.com', '911111111');
INSERT INTO `empleado` VALUES (13, 'lenin', 'López Yucra', '75896898', 5, 1, 'lenin@gmail.com', '952808082');
INSERT INTO `empleado` VALUES (14, 'lenino', 'Lopez', '7589555', 2, 6, 'elia@gmail.com', '88884585');
INSERT INTO `empleado` VALUES (15, 'edison', 'ramos', '75227341', 4, 6, 'ediii@gmail.com', '987456321');
INSERT INTO `empleado` VALUES (16, 'Antonio', 'Ra', '7896541', 4, 6, NULL, NULL);

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
INSERT INTO `evento` VALUES (6, 'TALLER DE INNOVACIÓN ', '2024-03-06', 'TALLER');
INSERT INTO `evento` VALUES (7, 'TALLER DE CIENCIA', '2024-03-07', 'TALLER 2');

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
