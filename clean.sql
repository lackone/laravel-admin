/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50726 (5.7.26)
 Source Host           : 127.0.0.1:3306
 Source Schema         : clean

 Target Server Type    : MySQL
 Target Server Version : 50726 (5.7.26)
 File Encoding         : 65001

 Date: 21/07/2023 16:35:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cl_admin_auths
-- ----------------------------
DROP TABLE IF EXISTS `cl_admin_auths`;
CREATE TABLE `cl_admin_auths`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '规则名',
  `title` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '规则标题',
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '类型(1:菜单,2:按钮)',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态(-1:禁用,1:启用)',
  `pid` int(11) NOT NULL DEFAULT 0 COMMENT '父级',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '图标',
  `sort` smallint(5) NOT NULL DEFAULT 0 COMMENT '排序(越小越前)',
  `created` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uniq_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '后台权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cl_admin_auths
-- ----------------------------
INSERT INTO `cl_admin_auths` VALUES (1, 'system', '系统管理', 1, 1, 0, '', 0, 1689660985, 1689660985);
INSERT INTO `cl_admin_auths` VALUES (2, 'admin', '用户管理', 1, 1, 1, '', 0, 1689660985, 1689660985);
INSERT INTO `cl_admin_auths` VALUES (3, 'adminRole', '角色管理', 1, 1, 1, '', 0, 1689660985, 1689660985);
INSERT INTO `cl_admin_auths` VALUES (4, 'adminAuth', '权限管理', 1, 1, 1, '', 0, 1689660985, 1689660985);
INSERT INTO `cl_admin_auths` VALUES (5, '/admin/user/list', '用户列表', 1, 1, 2, '', 0, 1689660985, 1689660985);
INSERT INTO `cl_admin_auths` VALUES (6, '/admin/role/list', '角色列表', 1, 1, 3, '', 0, 1689660985, 1689660985);
INSERT INTO `cl_admin_auths` VALUES (7, '/admin/auth/list', '权限列表', 1, 1, 4, '', 0, 1689660985, 1689660985);
INSERT INTO `cl_admin_auths` VALUES (8, '/admin/user/save/*', '添加或修改用户', 2, 1, 2, '', 0, 1689911782, 1689911782);
INSERT INTO `cl_admin_auths` VALUES (9, '/admin/user/delete', '删除用户', 2, 1, 2, '', 0, 1689911901, 1689911901);
INSERT INTO `cl_admin_auths` VALUES (10, '/admin/user/set_role/*', '分配角色', 2, 1, 2, '', 0, 1689911954, 1689911954);
INSERT INTO `cl_admin_auths` VALUES (11, '/admin/role/save/*', '添加或修改角色', 2, 1, 3, '', 0, 1689918296, 1689918296);
INSERT INTO `cl_admin_auths` VALUES (12, '/admin/role/delete', '删除角色', 2, 1, 3, '', 0, 1689918318, 1689918318);
INSERT INTO `cl_admin_auths` VALUES (13, '/admin/auth/save/*', '添加或修改权限', 2, 1, 4, '', 0, 1689918353, 1689918353);
INSERT INTO `cl_admin_auths` VALUES (14, '/admin/auth/delete', '删除权限', 2, 1, 4, '', 0, 1689918376, 1689918376);
INSERT INTO `cl_admin_auths` VALUES (15, '/admin/welcome', '欢迎页', 2, 1, 0, '', 0, 1689918625, 1689918625);
INSERT INTO `cl_admin_auths` VALUES (16, '/admin/logout', '退出', 2, 1, 0, '', 0, 1689918663, 1689918663);
INSERT INTO `cl_admin_auths` VALUES (17, '/admin/changePassword', '修改密码', 2, 1, 0, '', 0, 1689918713, 1689918713);

-- ----------------------------
-- Table structure for cl_admin_role_assocs
-- ----------------------------
DROP TABLE IF EXISTS `cl_admin_role_assocs`;
CREATE TABLE `cl_admin_role_assocs`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户ID',
  `role_id` int(11) NOT NULL DEFAULT 0 COMMENT '角色ID',
  `created` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uniq_role_admin`(`role_id`, `admin_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '后台用户角色关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cl_admin_role_assocs
-- ----------------------------
INSERT INTO `cl_admin_role_assocs` VALUES (1, 1, 1, 1689660985, 1689660985);

-- ----------------------------
-- Table structure for cl_admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `cl_admin_roles`;
CREATE TABLE `cl_admin_roles`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '角色名',
  `auth_ids` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '权限ID(逗号分割)',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态(-1:禁用,1:启用)',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `created` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '后台用户角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cl_admin_roles
-- ----------------------------
INSERT INTO `cl_admin_roles` VALUES (1, '管理员', '1,2,5,8,9,10,3,6,11,12,4,7,13,14,15,16,17', 1, '管理员', 1689660985, 1689923908);

-- ----------------------------
-- Table structure for cl_admins
-- ----------------------------
DROP TABLE IF EXISTS `cl_admins`;
CREATE TABLE `cl_admins`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `account` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '账号',
  `nick` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `real_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '真实姓名',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '头像',
  `sex` tinyint(1) NOT NULL DEFAULT 0 COMMENT '性别(0:未知,1:男,2:女)',
  `salt` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '加密盐',
  `password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '密码(md5(md5(salt) . password))',
  `phone` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `tel` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '座机',
  `email` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `weixin` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '微信',
  `last_login_ip` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `is_super` tinyint(1) NOT NULL DEFAULT -1 COMMENT '超级管理员(-1:否,1:是)',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态(-1:禁用,1:启用)',
  `created` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uniq_account`(`account`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '后台用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cl_admins
-- ----------------------------
INSERT INTO `cl_admins` VALUES (1, 'admin', 'admin', 'admin', '/images/202307/21/xFW27RztefAsZ2S2Aqwuy5rJ1XlVSHNM24AwWEXw.png', 0, 'OuWUGp', 'dba6e244d4350df734600e7d66b51eac', '', '', '', '', '127.0.0.1', 1689928110, 1, 1, 1689660985, 1689928110);

SET FOREIGN_KEY_CHECKS = 1;
