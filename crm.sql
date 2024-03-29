/*
 Navicat Premium Data Transfer

 Source Server         : db
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : db_yii

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 07/03/2023 22:38:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment`  (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`) USING BTREE,
  INDEX `idx-auth_assignment-user_id`(`user_id`) USING BTREE,
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('admin', '1', 1671119696);
INSERT INTO `auth_assignment` VALUES ('manager-post', '2', 1671119696);

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `data` blob NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE,
  INDEX `rule_name`(`rule_name`) USING BTREE,
  INDEX `idx-auth_item-type`(`type`) USING BTREE,
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('admin', 1, NULL, NULL, NULL, 1671119425, 1671119425);
INSERT INTO `auth_item` VALUES ('create-categories', 2, 'Index a categories', NULL, NULL, 1671118678, 1671118678);
INSERT INTO `auth_item` VALUES ('create-post', 2, 'Create a post', NULL, NULL, 1671116852, 1671116852);
INSERT INTO `auth_item` VALUES ('delete-categories', 2, 'Delete a categories', NULL, NULL, 1671119010, 1671119010);
INSERT INTO `auth_item` VALUES ('Delete-post', 2, 'Delete a post', NULL, NULL, 1671117098, 1671117098);
INSERT INTO `auth_item` VALUES ('index-categories', 2, 'Index a categories', NULL, NULL, 1671119010, 1671119010);
INSERT INTO `auth_item` VALUES ('index-post', 2, 'Index a post', NULL, NULL, 1671117033, 1671117033);
INSERT INTO `auth_item` VALUES ('manager-categories', 1, NULL, NULL, NULL, 1671119078, 1671119078);
INSERT INTO `auth_item` VALUES ('manager-post', 1, NULL, NULL, NULL, 1671117212, 1671117212);
INSERT INTO `auth_item` VALUES ('update-categories', 2, 'update a categories', NULL, NULL, 1671119010, 1671119010);
INSERT INTO `auth_item` VALUES ('update-post', 2, 'update a post', NULL, NULL, 1671117033, 1671117033);
INSERT INTO `auth_item` VALUES ('view-categories', 2, 'View a categories', NULL, NULL, 1671119010, 1671119010);
INSERT INTO `auth_item` VALUES ('View-post', 2, 'View a post', NULL, NULL, 1671117033, 1671117033);

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child`  (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`, `child`) USING BTREE,
  INDEX `child`(`child`) USING BTREE,
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('manager-categories', 'create-categories');
INSERT INTO `auth_item_child` VALUES ('manager-post', 'create-post');
INSERT INTO `auth_item_child` VALUES ('manager-categories', 'delete-categories');
INSERT INTO `auth_item_child` VALUES ('manager-post', 'Delete-post');
INSERT INTO `auth_item_child` VALUES ('manager-categories', 'index-categories');
INSERT INTO `auth_item_child` VALUES ('manager-post', 'index-post');
INSERT INTO `auth_item_child` VALUES ('admin', 'manager-categories');
INSERT INTO `auth_item_child` VALUES ('admin', 'manager-post');
INSERT INTO `auth_item_child` VALUES ('manager-categories', 'update-categories');
INSERT INTO `auth_item_child` VALUES ('manager-post', 'update-post');
INSERT INTO `auth_item_child` VALUES ('manager-categories', 'view-categories');
INSERT INTO `auth_item_child` VALUES ('manager-post', 'View-post');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` blob NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for belong_unit
-- ----------------------------
DROP TABLE IF EXISTS `belong_unit`;
CREATE TABLE `belong_unit`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `belong_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `province_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of belong_unit
-- ----------------------------
INSERT INTO `belong_unit` VALUES (2, 'Hóc Môn', 'HM', 'HCM');
INSERT INTO `belong_unit` VALUES (3, 'Cần giờ', 'CG', 'HCM');
INSERT INTO `belong_unit` VALUES (4, 'Quận 12', 'Q12', 'HCM');
INSERT INTO `belong_unit` VALUES (5, 'Sở GD&ĐT ', 'Sở GD&ĐT ', 'HCM');
INSERT INTO `belong_unit` VALUES (6, 'Quận Tân Phú', 'QTP', 'HCM');
INSERT INTO `belong_unit` VALUES (7, 'Bình Tân', 'BT', 'HCM');
INSERT INTO `belong_unit` VALUES (8, 'Nhà Bè', 'NB', 'HCM');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------

-- ----------------------------
-- Table structure for level
-- ----------------------------
DROP TABLE IF EXISTS `level`;
CREATE TABLE `level`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of level
-- ----------------------------
INSERT INTO `level` VALUES (1, 'Bình thường', '#113ce8', '2022-12-24 11:56:59', '2022-12-24 11:56:59', NULL);

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `parent` int(11) NULL DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int(11) NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'Quản trị', NULL, '', '2023-02-05 10:56:15', '2023-03-07 22:28:45', 0, '<i class=\"fa fa-laptop me-2\"></i>', 1);
INSERT INTO `menu` VALUES (2, 'Danh sách dự án', 1, '/project', '2023-02-05 11:00:32', '2023-03-04 00:16:57', NULL, '', 0);
INSERT INTO `menu` VALUES (3, 'Danh sách yêu cầu', 1, '/request', '2023-02-05 11:00:57', '2023-03-07 22:30:21', NULL, '', 0);
INSERT INTO `menu` VALUES (4, 'Danh mục', NULL, '', '2023-02-05 11:01:12', '2023-03-04 00:17:29', 0, '<i class=\"fas fa-list-alt\"></i>', 1);
INSERT INTO `menu` VALUES (5, 'Danh sách thể loại', 4, '/categories', '2023-02-05 11:02:24', '2023-03-04 00:17:51', NULL, '', 1);
INSERT INTO `menu` VALUES (6, 'Danh sách cấp độ', 4, '/level', '2023-02-05 11:02:50', '2023-03-04 00:18:01', NULL, '', 1);
INSERT INTO `menu` VALUES (7, 'Danh sách trạng thái', 4, '/status', '2023-02-05 11:03:10', '2023-03-04 00:18:49', NULL, '', 1);
INSERT INTO `menu` VALUES (8, 'Quản lý menu', 9, '/menu', '2023-02-05 15:53:40', '2023-03-04 00:18:11', NULL, '', 1);
INSERT INTO `menu` VALUES (9, 'Cấu hình', NULL, '', '2023-02-09 20:36:48', '2023-03-04 00:18:27', 0, '<i class=\"fas fa-cog\"></i>', 1);
INSERT INTO `menu` VALUES (10, 'Quản lý task công việc', 1, '/task', '2023-02-11 11:06:51', '2023-03-04 00:17:22', 2, '', 1);
INSERT INTO `menu` VALUES (11, 'Quản lý đơn vị', 1, '/unit', '2023-03-06 23:49:47', '2023-03-06 23:50:01', NULL, '', 1);
INSERT INTO `menu` VALUES (12, 'Đơn vị trực thuộc', 4, '/belong-unit', '2023-03-06 23:50:48', '2023-03-06 23:50:48', 1, '', 1);
INSERT INTO `menu` VALUES (13, 'Loại đơn vị', 4, '/type-unit', '2023-03-06 23:51:06', '2023-03-06 23:51:11', 1, '', 1);
INSERT INTO `menu` VALUES (14, 'Quản lý nhân viên', 1, '/staff', '2023-03-06 23:51:39', '2023-03-06 23:52:33', NULL, '', 1);
INSERT INTO `menu` VALUES (15, 'Gói cước', 4, '/package', '2023-03-07 22:24:18', '2023-03-07 22:24:28', 1, '', 1);
INSERT INTO `menu` VALUES (16, 'Quản lý kế hoạch đào tạo', 1, '/paln', '2023-03-07 22:25:40', '2023-03-07 22:29:04', 1, '', 1);
INSERT INTO `menu` VALUES (17, 'Quản lý giao dịch', 1, '/transaction', '2023-03-07 22:26:08', '2023-03-07 22:30:01', 1, '', 1);

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration`  (
  `version` varchar(180) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apply_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', 1670825468);
INSERT INTO `migration` VALUES ('m130524_201442_init', 1670825471);
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', 1671114338);
INSERT INTO `migration` VALUES ('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1671114338);
INSERT INTO `migration` VALUES ('m180523_151638_rbac_updates_indexes_without_prefix', 1671114338);
INSERT INTO `migration` VALUES ('m190124_110200_add_verification_token_column_to_user_table', 1670825471);
INSERT INTO `migration` VALUES ('m200409_110543_rbac_update_mssql_trigger', 1671114338);
INSERT INTO `migration` VALUES ('m221212_131456_create_table_categories', 1670851105);
INSERT INTO `migration` VALUES ('m221215_141252_init_rbac', 1671113592);
INSERT INTO `migration` VALUES ('m221215_152437_create_table_post', 1671118144);
INSERT INTO `migration` VALUES ('m221219_144804_create_table_project', 1671463927);
INSERT INTO `migration` VALUES ('m221222_042603_creat_table_position', 1671683490);
INSERT INTO `migration` VALUES ('m221222_042914_creat_table_level', 1671683490);
INSERT INTO `migration` VALUES ('m221222_043011_creat_table_status', 1671683490);
INSERT INTO `migration` VALUES ('m221222_120821_create_project_table', 1671719117);
INSERT INTO `migration` VALUES ('m221224_022547_create_table_request', 1673059686);
INSERT INTO `migration` VALUES ('m221224_022620_create_request_table', 1671849671);
INSERT INTO `migration` VALUES ('m230107_024516_add_column_request', 1673059686);
INSERT INTO `migration` VALUES ('m230205_034806_create_table_menu', 1675569188);
INSERT INTO `migration` VALUES ('m230205_040647_add_colum_icon_menu', 1675587426);
INSERT INTO `migration` VALUES ('m230209_131446_add_column_icon_table_menu', 1675948531);
INSERT INTO `migration` VALUES ('m230210_151036_create_table_task', 1676088316);
INSERT INTO `migration` VALUES ('m230304_032129_create_table_notify', 1677900342);
INSERT INTO `migration` VALUES ('m230306_143549_create_table_belong_unit', 1678114447);
INSERT INTO `migration` VALUES ('m230306_145235_create_table_province', 1678114447);
INSERT INTO `migration` VALUES ('m230306_145436_create_table_staff', 1678116442);
INSERT INTO `migration` VALUES ('m230306_145748_create_table_type_unit', 1678114884);
INSERT INTO `migration` VALUES ('m230306_145959_create_table_type_customer', 1678114884);
INSERT INTO `migration` VALUES ('m230306_150147_create_table_unit', 1678115415);
INSERT INTO `migration` VALUES ('m230307_143532_create_table_plan', 1678200098);
INSERT INTO `migration` VALUES ('m230307_145844_create_table_package', 1678201275);
INSERT INTO `migration` VALUES ('m230307_150936_create_table_transaction', 1678201952);

-- ----------------------------
-- Table structure for notify
-- ----------------------------
DROP TABLE IF EXISTS `notify`;
CREATE TABLE `notify`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `task_id` int(11) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notify
-- ----------------------------
INSERT INTO `notify` VALUES (2, 'CRUD', NULL, 17, 1, 0, '2023-03-04 10:28:53', '2023-03-04 11:25:16');

-- ----------------------------
-- Table structure for package
-- ----------------------------
DROP TABLE IF EXISTS `package`;
CREATE TABLE `package`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of package
-- ----------------------------
INSERT INTO `package` VALUES (1, 'G01', 'Gói basic', '');

-- ----------------------------
-- Table structure for plan
-- ----------------------------
DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `customer_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `form` int(11) NULL DEFAULT NULL,
  `time_start` datetime NULL DEFAULT NULL,
  `time_end` datetime NULL DEFAULT NULL,
  `unit_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `error` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `request` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fix` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of plan
-- ----------------------------

-- ----------------------------
-- Table structure for position
-- ----------------------------
DROP TABLE IF EXISTS `position`;
CREATE TABLE `position`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of position
-- ----------------------------

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of posts
-- ----------------------------

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `deadline` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx-project-category_id`(`category_id`) USING BTREE,
  INDEX `idx-project-user_id`(`user_id`) USING BTREE,
  CONSTRAINT `fk-project-category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk-project-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of project
-- ----------------------------

-- ----------------------------
-- Table structure for province
-- ----------------------------
DROP TABLE IF EXISTS `province`;
CREATE TABLE `province`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `province_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of province
-- ----------------------------
INSERT INTO `province` VALUES (1, 'Thành phố Hồ Chí Minh', 'HCM');
INSERT INTO `province` VALUES (2, 'Hà Nội', 'HN');

-- ----------------------------
-- Table structure for request
-- ----------------------------
DROP TABLE IF EXISTS `request`;
CREATE TABLE `request`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `deadline` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `time_start` datetime NULL DEFAULT NULL,
  `time_end` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx-request-project_id`(`project_id`) USING BTREE,
  INDEX `idx-request-user_id`(`user_id`) USING BTREE,
  INDEX `idx-request-status_id`(`status_id`) USING BTREE,
  INDEX `idx-request-level_id`(`level_id`) USING BTREE,
  CONSTRAINT `fk-request-level_id` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk-request-project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk-request-status_id` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk-request-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of request
-- ----------------------------

-- ----------------------------
-- Table structure for staff
-- ----------------------------
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `province_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `staff_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of staff
-- ----------------------------
INSERT INTO `staff` VALUES (1, 'Nguyễn Hoài Sơn', '0974991001', 'sonnh41@viettel.com.vn', 'HCM', '213518');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES (1, 'Chờ xác nhận', '#ff4000', '2022-12-24 10:08:38', '2022-12-24 10:08:38', NULL);
INSERT INTO `status` VALUES (2, 'Đang thực hiện', '#1ae0b8', '2023-01-07 12:09:56', '2023-01-07 12:10:03', NULL);

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `database` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `table` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES (2, 'crud, import excel', NULL, '/promotion-code', 'persional_service', 'promotion_code', 1, NULL, NULL, NULL, NULL);
INSERT INTO `task` VALUES (3, 'view,search, export_excel', NULL, '/promotion-code-his', 'persional_service', 'promotion_code_his', 1, NULL, NULL, NULL, NULL);
INSERT INTO `task` VALUES (4, 'crud, import excel', NULL, '/promotion-code', 'persional_service', 'promotion_code', 1, NULL, NULL, NULL, NULL);
INSERT INTO `task` VALUES (5, 'view,search, export_excel', NULL, '/promotion-code-his', 'persional_service', 'promotion_code_his', 1, NULL, NULL, NULL, NULL);
INSERT INTO `task` VALUES (17, 'CRUD', '', '', '', '', 0, '', '', '2023-03-04 10:28:53', '2023-03-04 10:28:53');

-- ----------------------------
-- Table structure for transaction
-- ----------------------------
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `unit_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time_start` datetime NULL DEFAULT NULL,
  `time_end` datetime NULL DEFAULT NULL,
  `package_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `total` int(11) NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaction
-- ----------------------------

-- ----------------------------
-- Table structure for type_customer
-- ----------------------------
DROP TABLE IF EXISTS `type_customer`;
CREATE TABLE `type_customer`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of type_customer
-- ----------------------------
INSERT INTO `type_customer` VALUES (1, 'VIP');

-- ----------------------------
-- Table structure for type_unit
-- ----------------------------
DROP TABLE IF EXISTS `type_unit`;
CREATE TABLE `type_unit`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type_unit_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of type_unit
-- ----------------------------
INSERT INTO `type_unit` VALUES (1, 'Sở', 'S');

-- ----------------------------
-- Table structure for unit
-- ----------------------------
DROP TABLE IF EXISTS `unit`;
CREATE TABLE `unit`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type_unit_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `belong_unit_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type_customer_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  `province_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `unit_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of unit
-- ----------------------------
INSERT INTO `unit` VALUES (1, 'Trường THCS Nguyễn HIền', 'S', 'PQ1', 'ádfssfs', '1', 0, 'HCM', 'THCS NH');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `type` int(11) NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `gender` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `birthday` date NULL DEFAULT NULL,
  `phone` int(11) NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `password_reset_token`(`password_reset_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'gK_iS4tRG7WLnE2YswEGKNXZfo5OMnfI', '$2y$13$ChFLs0hvouF9ZgJCb22qxebPEtm.8sF.1uMx91HLonVlp0rguwCge', NULL, 'nguyenxuanhoang2000@gmail.com', 10, 1670828286, 1670828286, 'A4FWWUa4r7mGMLs3Il4gU3CNQ1aza8Ue_1670828286', 0, 'Nguyễn Xuân Hoàng', 'Nam', '2000-01-08', 339715404, 'Hà Nội', '1.png');
INSERT INTO `user` VALUES (2, 'post', 'BiTQT7bBTu-D0I4qGGTFrguRSfaG6wkx', '$2y$13$y1ieO5w2WdfCPBmhjOIi4.UHvMjCsgHqDC4nwtyxnq3Ozitqkw176', NULL, 'post@gmail.com', 9, 1671120746, 1671120746, 'v4OkZZyjCeAOvO7z93M7F2cXcjGJDKfR_1671120746', 1, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (5, 'categories', '4zGA3fqk9LuyWMg4ra1QwWGgkSfXw_N2', '$2y$13$E1D3ZwtQM5YdfEj5R17owuYonWMIhNJ2muCl7iUcyczgmR6wLjcVK', NULL, 'categories@gmail.com', 9, 1671120808, 1671120808, 'c_llOvCJIn-7DsrAVIjN2eFRPy3uT1ii_1671120808', 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (6, 'nv01', '6lW-gu_aT5JdAidz7xQaeD8xA_1sxONp', '$2y$13$cMCb9UpO9Er0aRB96zbW0.dawu.TZlIFDJOW1vPl5vwXoE3uAkihm', NULL, 'nv01@gmail.com', 10, 1671960983, 1671960983, 'TJbRmPmz3Yir47BIXumtaaMONgU0DES1_1671960983', 1, NULL, NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
