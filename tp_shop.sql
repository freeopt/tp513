/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp_shop

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-12-14 13:58:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL COMMENT 'banner����',
  `description` varchar(255) DEFAULT NULL COMMENT 'banner����',
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='banner�ֲ�ͼ';

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO `banner` VALUES ('1', '首页置顶', '首页轮播图', null, null);
INSERT INTO `banner` VALUES ('11', '首页置顶2', '首页轮播图2', null, null);

-- ----------------------------
-- Table structure for banner_item
-- ----------------------------
DROP TABLE IF EXISTS `banner_item`;
CREATE TABLE `banner_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) unsigned NOT NULL COMMENT '外键,关联banner表',
  `img_id` int(11) unsigned NOT NULL COMMENT '外键,关联image表',
  `type` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '跳转类型,导向商品/专题或其他. 0:无导向 1:导向商品 2:导向专题',
  `key_word` varchar(64) NOT NULL COMMENT '执行关键字,根据type含义不同',
  `delete_time` int(11) unsigned DEFAULT NULL,
  `update_time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='banner子项表';

-- ----------------------------
-- Records of banner_item
-- ----------------------------
INSERT INTO `banner_item` VALUES ('1', '1', '65', '1', '6', null, null);
INSERT INTO `banner_item` VALUES ('2', '1', '2', '1', '25', null, null);
INSERT INTO `banner_item` VALUES ('3', '1', '3', '1', '11', null, null);
INSERT INTO `banner_item` VALUES ('5', '1', '1', '1', '10', null, null);
