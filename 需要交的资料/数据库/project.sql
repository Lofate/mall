/*
Navicat MySQL Data Transfer

Source Server         : 192.168.1.6
Source Server Version : 50711
Source Host           : 192.168.1.29:3306
Source Database       : project

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2018-04-09 15:40:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` char(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `province` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `post` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('1', '潘骏杰', '15961726437', '1', '江苏省 无锡市 北塘区', '民丰西苑82号202室', '家', '214045');
INSERT INTO `address` VALUES ('2', '海涛', '13456789765', '1', '浙江省 杭州市 江干区', '河西大道432号', '公司', '310098');
INSERT INTO `address` VALUES ('47', '何峻凯', '13646793201', '27', '浙江 杭州市 江干区', '下沙电子商务园', '家', '310016');
INSERT INTO `address` VALUES ('15', '夏益栋', '12345678912', '23', '北京 北京市 东城区', '所前', '1', '100011');
INSERT INTO `address` VALUES ('20', '张曦予', '15789765674', '23', '北京 北京市 宣武区', '秦汉大道243号', '家', '10054');
INSERT INTO `address` VALUES ('38', '朱成杰', '15700113760', '24', '陕西 安康市 紫阳县', '110110', '阿萨达撒', '725303');
INSERT INTO `address` VALUES ('39', '朱成杰', '15700113760', '24', '陕西 安康市 紫阳县', '镇上110号', '公司', '725303');
INSERT INTO `address` VALUES ('40', '夏益栋', '15957138065', '20', '天津 天津市 河西区', '实打实大大', 'as', '300202');
INSERT INTO `address` VALUES ('42', '张勇', '17826789055', '19', '天津 天津市 南开区', '振林小道89号', '公司', '300100');

-- ----------------------------
-- Table structure for `admin_goods`
-- ----------------------------
DROP TABLE IF EXISTS `admin_goods`;
CREATE TABLE `admin_goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `gid` int(10) NOT NULL,
  `pic` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_goods
-- ----------------------------
INSERT INTO `admin_goods` VALUES ('27', 'Joyfish红焖牛肉300g', '35.00', '300g', '33', '20180322\\18862c1160c93122ec88a613fb426b53.jpg');
INSERT INTO `admin_goods` VALUES ('28', '獐子岛豆豉粉丝扇贝(速冻生制)200g(6枚装)', '19.00', '200g', '37', '20180322\\23772a7c57c0471e4d7117f6d5c1fc34.jpg');
INSERT INTO `admin_goods` VALUES ('29', 'KINGOSCAR熟冻拉直凡纳对虾500g', '138.00', '500g', '37', '20180322\\978c5c90f5e92c9cc3a430d09666696b.jpg');
INSERT INTO `admin_goods` VALUES ('26', 'Joyfish酸菜牛蛙370g', '35.00', '370g', '36', '20180322\\78a02a52104f0acb469c0c01453d0777.jpg');
INSERT INTO `admin_goods` VALUES ('30', '獐子岛蒜蓉粉丝扇贝(速冻生制)200g(6枚装)', '19.00', '200g', '37', '20180322\\7b108b6a8b49ba7b0c29fdb560fbccc2.jpg');
INSERT INTO `admin_goods` VALUES ('31', 'Zespri佳沛意大利绿奇异果6个83-94g/个', '29', '83~94g', '21', '20180322\\3dadfc3f5418c92913cfbc5ae2604e75.jpg');
INSERT INTO `admin_goods` VALUES ('32', '希腊绿奇异果10个85g以上/个', '36', '85g', '21', '20180322\\ff3439f05477e475e756d748de2861e7.jpg');
INSERT INTO `admin_goods` VALUES ('33', '智利西梅1kg', '59', '1kg', '22', '20180322\\2a32c095938c8eb5863c03bb8a74ba79.jpg');
INSERT INTO `admin_goods` VALUES ('34', '智利黑布林6个70g以上/个', '29', '70g', '22', '20180322\\aad3261b04a103598d7badca97922f7f.jpg');
INSERT INTO `admin_goods` VALUES ('35', 'SunMoon能量STAR墨西哥牛油果4个130-160g/个', '29', '130~160g', '24', '20180322\\3e3634986cda03987850c1010891a937.jpg');
INSERT INTO `admin_goods` VALUES ('36', 'SunMoon能量STAR墨西哥牛油果6个130-160g/个', '39', '130~160g', '24', '20180322\\423cb5b1d54741f55eb2817fd448cb03.jpg');
INSERT INTO `admin_goods` VALUES ('37', '秘鲁红提500g', '20', '500g', '25', '20180322\\e00bc9966025d6252cffa22ff227b82c.jpg');
INSERT INTO `admin_goods` VALUES ('38', '澳大利亚无籽红提1kg', '49', '1kg', '25', '20180322\\65131d4b38e8b47c18357417e64e9c60.jpg');
INSERT INTO `admin_goods` VALUES ('39', '秘鲁红提1kg', '39', '1kg', '25', '20180322\\465815210c004ae3264f22eb725f9999.jpg');
INSERT INTO `admin_goods` VALUES ('40', '美国爱妃苹果4个190g以上/个', '46', '190g', '26', '20180322\\a0b91179da2469a573d569f3667ac318.jpg');
INSERT INTO `admin_goods` VALUES ('44', '智利蓝莓4盒', '59.90', '约125g', '49', '20180327\\9f038d32425828d96d50221411e53323.jpg');
INSERT INTO `admin_goods` VALUES ('43', '常瀛进口香蕉6根', '25.00', '6根', '48', '20180327\\71ae6076a50439c0ba796c3d99e3823a.jpg');
INSERT INTO `admin_goods` VALUES ('45', '泰国龙眼1kg', '24.80', '1kg', '50', '20180327\\8dac97b29ba99caf209b799faf36f3b2.jpg');
INSERT INTO `admin_goods` VALUES ('46', '智利雪花李6个70g以上/个', '23.00', '6个', '22', '20180327\\33b1872802bc3aafc75db9c566c48d91.jpg');
INSERT INTO `admin_goods` VALUES ('47', '海南水仙芒2个200g以上/个', '45.00', '2个', '51', '20180327\\1a34651411ae7caf13b9613052b6b10b.jpg');
INSERT INTO `admin_goods` VALUES ('48', '百香果200g', '6.00', '200g', '50', '20180327\\ffbdddb7a91bff05f1948495843bec35.jpg');
INSERT INTO `admin_goods` VALUES ('49', '四川不知火丑柑2kg原箱(6-9个)', '39.90', '2kg', '28', '20180327\\7410d679a0415498a3ac55030e0e2639.jpg');
INSERT INTO `admin_goods` VALUES ('50', '新疆天山雪梨1.5kg180g以上/个', '19.00', '1.5kg', '30', '20180327\\58f444c45972d828e93972fce2fbf115.jpg');
INSERT INTO `admin_goods` VALUES ('51', '广西桂林金桔1kg', '19.00', '1kg', '28', '20180327\\709679e71e79458dbc34e3500fd8899d.jpg');
INSERT INTO `admin_goods` VALUES ('52', '甜岛宝台湾红心芭乐2个280g以上/个', '29.90', '2个', '52', '20180327\\5a3fda892dc9f39b73b5d2deb319ad16.jpg');

-- ----------------------------
-- Table structure for `admin_goodsinfo`
-- ----------------------------
DROP TABLE IF EXISTS `admin_goodsinfo`;
CREATE TABLE `admin_goodsinfo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `num` int(30) NOT NULL,
  `ship_address` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `pic` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_goodsinfo
-- ----------------------------
INSERT INTO `admin_goodsinfo` VALUES ('26', '50', '杭州', '35.00', '福建', '        牛蛙爱好者的不二选择\r\n      ', '20180322\\5d6ba8f6f524aca9a1d5a23f83b4e09c.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('27', '50', '杭州', '35', '澳大利亚', ' 江湖上，号称“肉中骄子”       \r\n      ', '20180322\\70902151841c885197cc31ed9767d531.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('28', '25', '杭州', '19', '辽宁', '豆豉鲜香 搭配爽口粉丝        \r\n      ', '20180322\\370e8e72b78039fb06d3bd301d6bd6cc.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('29', '16', '杭州', '138', '泰国', ' 拉直摆盘 口感鲜甜       \r\n      ', '20180322\\cf5485a988549fd2f0436bdf4bf6f240.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('30', '111', '杭州', '19.00', '辽宁', ' 精选优质原料，个大饱满味鲜       \r\n      ', '20180322\\d6789dcc899f010f900cf162e6642865.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('31', '100', '杭州', '29', '意大利', '佳沛经典品质 水润甜心        \r\n      ', '20180322\\d3d52533352f37983d94b8501cf416f1.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('32', '110', '杭州', '36', '希腊', '  香甜清润 清新爽滑      \r\n      ', '20180322\\340106dc78872cdce171cd4cfacf7d8e.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('33', '100', '杭州', '39', '智利', '    圆润饱满 果肉紧实    \r\n      ', '20180322\\1ca4b25c62116956b398d2bff7ca6b82.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('34', '115', '杭州', '29', '智利', ' 酸甜脆嫩 肉厚核小       \r\n      ', '20180322\\dc59e7b78f3c83d4b28ab6dab682045b.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('35', '212', '杭州', '29', '墨西哥', ' 清香细滑，入口即化       \r\n      ', '20180322\\9e514dbf9044b82808f3a130b462aaf1.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('36', '212', '杭州', '39', '墨西哥', ' 清香细滑，入口即化       \r\n      ', '20180322\\7ff431ba0343ef17a02514de8df3cbba.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('37', '500', '杭州', '20', '秘鲁', '  皮薄肉脆 果香浓郁      \r\n      ', '20180322\\da26a1c11b83332668a55564002c8e9b.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('38', '215', '杭州', '49', '澳大利亚', ' 晶莹剔透 紧实甜脆       \r\n      ', '20180322\\f46388f0d9bd0b2ee988a70edb7c29d6.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('39', '215', '杭州', '39', '秘鲁', '皮薄肉脆 果香浓郁        \r\n      ', '20180322\\096a2000bb2ac871efb4a3cdf54c2f1f.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('40', '211', '杭州', '46', '美国', '内外兼修的爱妃        \r\n      ', '20180322\\fa30469115037d8fa245b033e29bbdc8.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('43', '100', '杭州', '25.00', '菲律宾', '  独立包装，方便携带      \r\n      ', '20180327\\58a00fd9e78e73c39404b77ccb2385a6.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('42', '100', '杭州', '59.90', '智利', '能量之果 花青素小巨人        \r\n      ', '20180327\\77d49ddf3c53b24f987d8f8d665a4451.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('44', '100', '杭州', '59.90', '智利', '  能量之果 花青素小巨人      \r\n      ', '20180327\\0ef47dec6bd95f224f356f7a2ac43a1f.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('45', '125', '杭州', '24.80', '泰国', '核小肉厚，莹润剔透        \r\n      ', '20180327\\9bf85915f497e7c5b07d2018661fa20c.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('46', '100', '杭州', '23.00', '智利', '核小肉多 果肉爽脆        \r\n      ', '20180327\\d081e6a309537b14eb7d86ef99e22478.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('47', '100', '杭州', '45.00', '海南三亚', '果核细薄 大口啃食更过瘾        \r\n      ', '20180327\\ed97f4d62e1d73829f693a1c14d8e7c7.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('48', '100', '杭州', '6.00', '广西桂林', '榨汁泡饮，风味无穷       \r\n      ', '20180327\\2341df01e720351f956a675a72531b76.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('49', '100', '杭州', '39.90', '四川成都', ' 细嫩水润 皮松宜剥       \r\n      ', '20180327\\fa155d1c3039d248bbe0106c2c6bb91c.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('50', '50', '杭州', '19.00', '新疆阿克', ' 果肉白嫩 入口清润       \r\n      ', '20180327\\d6fd53120623dbe373dee368de8187e2.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('51', '100', '杭州', '19.00', '广西桂林', ' 金色小“榨”弹，一口爽爆味蕾       \r\n      ', '20180327\\a37146f1751ff9b72eed221dc081d2c9.jpg');
INSERT INTO `admin_goodsinfo` VALUES ('52', '50', '杭州', '19.90', '台湾', '不削皮不吐籽 洗洗直接啃食        \r\n      ', '20180327\\6f3baa3f1a84afe9a66b19d5beb3d7a8.jpg');

-- ----------------------------
-- Table structure for `admin_mails`
-- ----------------------------
DROP TABLE IF EXISTS `admin_mails`;
CREATE TABLE `admin_mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_mails
-- ----------------------------
INSERT INTO `admin_mails` VALUES ('4', 'admin', 'a', '<p>爱爱爱</p>', '1522063058', '1');
INSERT INTO `admin_mails` VALUES ('5', 'admin', 'a', '<p>akfhasdfjsaldfjas;ofjlkdsafjafsd;ajflkdsajdhfaflsakdfjsa</p>', '1522132076', '1');
INSERT INTO `admin_mails` VALUES ('6', 'admin', 'a', '<p>111111111</p>', '1522149809', '1');
INSERT INTO `admin_mails` VALUES ('10', 'hjk', 'a', '<p>1111<img src=\"http://img.baidu.com/hi/jx2/j_0001.gif\"/></p>', '1522150936', '1');
INSERT INTO `admin_mails` VALUES ('8', 'admin', 'a', '<p>2222222</p>', '1522149863', '1');
INSERT INTO `admin_mails` VALUES ('18', 'admin', 'admins', '<p>qqq</p>', '1523245679', '0');

-- ----------------------------
-- Table structure for `admin_users`
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '2',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES ('00000000001', 'admin', '1', '123456');
INSERT INTO `admin_users` VALUES ('00000000017', 'hjk999', '26', '123123');
INSERT INTO `admin_users` VALUES ('00000000018', 'xyd123', '38', 'xiayidong');
INSERT INTO `admin_users` VALUES ('00000000015', 'hjk111', '26', '123456');
INSERT INTO `admin_users` VALUES ('00000000007', 'hjk444', '23', '123456');
INSERT INTO `admin_users` VALUES ('00000000020', 'hjk6666', '39', '123456');

-- ----------------------------
-- Table structure for `ads`
-- ----------------------------
DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `miaoshu` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` int(10) NOT NULL,
  `opic` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `pid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ads
-- ----------------------------
INSERT INTO `ads` VALUES ('7', '水果专区', '全球水果最新鲜速递', '1522032369.jpg', '1', '20180326/72b29fc8dd2f6ee3c453403b970de5ae.jpg', '11');
INSERT INTO `ads` VALUES ('4', '优质生活', '美食有态度,生活更有味', '1522038558.jpg', '0', '20180326/32f721812f8477bbd0ce77db685eb195.jpg', '10');
INSERT INTO `ads` VALUES ('5', '新品专区', '探访源头产地 甄选当令时鲜', '1522038197.jpg', '0', '20180326/7549084ca21dd30d90196deda4b07a87.jpg', '17');
INSERT INTO `ads` VALUES ('6', '菜谱专栏', '大厨私房菜 餐桌新时尚', '1522033612.jpg', '0', '20180326/20b9f16e029fadca3ef60331a9425c6b.jpg', '19');

-- ----------------------------
-- Table structure for `assess`
-- ----------------------------
DROP TABLE IF EXISTS `assess`;
CREATE TABLE `assess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `good_id` int(11) NOT NULL,
  `good_score` int(11) NOT NULL,
  `service_score` int(11) NOT NULL,
  `time_score` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `status` tinyint(8) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of assess
-- ----------------------------
INSERT INTO `assess` VALUES ('29', '24', '61', '26', '3', '3', '4', '不错的', '1', '1522821775');

-- ----------------------------
-- Table structure for `carts`
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `good_id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of carts
-- ----------------------------
INSERT INTO `carts` VALUES ('89', '21', '38', '1');
INSERT INTO `carts` VALUES ('88', '21', '33', '1');
INSERT INTO `carts` VALUES ('97', '19', '32', '1');

-- ----------------------------
-- Table structure for `cates`
-- ----------------------------
DROP TABLE IF EXISTS `cates`;
CREATE TABLE `cates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pid` int(11) NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cates
-- ----------------------------
INSERT INTO `cates` VALUES ('14', '即烹美食', '0', '0');
INSERT INTO `cates` VALUES ('10', '进口水果', '0', '0');
INSERT INTO `cates` VALUES ('12', '精选肉类', '0', '0');
INSERT INTO `cates` VALUES ('13', '禽类蛋品', '0', '0');
INSERT INTO `cates` VALUES ('11', '国产水果', '0', '0');
INSERT INTO `cates` VALUES ('15', '海鲜水产', '0', '0');
INSERT INTO `cates` VALUES ('16', '乳品糕点', '0', '0');
INSERT INTO `cates` VALUES ('17', '新鲜蔬菜', '0', '0');
INSERT INTO `cates` VALUES ('18', '方便速食', '0', '0');
INSERT INTO `cates` VALUES ('19', '粮油杂货', '0', '0');
INSERT INTO `cates` VALUES ('20', '饮料酒水', '0', '0');
INSERT INTO `cates` VALUES ('21', '奇异果', '10', '0,10');
INSERT INTO `cates` VALUES ('22', '李', '10', '0,10');
INSERT INTO `cates` VALUES ('23', '莓', '10', '0,10');
INSERT INTO `cates` VALUES ('24', '牛油果', '10', '0,10');
INSERT INTO `cates` VALUES ('25', '提子', '10', '0,10');
INSERT INTO `cates` VALUES ('26', '苹果', '10', '0,10');
INSERT INTO `cates` VALUES ('27', '梨', '10', '0,10');
INSERT INTO `cates` VALUES ('28', '柑橘橙柚', '11', '0,11');
INSERT INTO `cates` VALUES ('29', '苹果', '11', '0,11');
INSERT INTO `cates` VALUES ('30', '梨', '11', '0,11');
INSERT INTO `cates` VALUES ('31', '猕猴桃', '11', '0,11');
INSERT INTO `cates` VALUES ('32', '进口牛肉', '12', '0,12');
INSERT INTO `cates` VALUES ('33', '国产牛肉', '12', '0,12');
INSERT INTO `cates` VALUES ('34', '鸡', '13', '0,13');
INSERT INTO `cates` VALUES ('35', '鸭', '13', '0,13');
INSERT INTO `cates` VALUES ('36', '独家秘制', '14', '0,14');
INSERT INTO `cates` VALUES ('37', '生猛海鲜', '14', '0,14');
INSERT INTO `cates` VALUES ('38', '鱼', '15', '0,15');
INSERT INTO `cates` VALUES ('39', '虾', '15', '0,15');
INSERT INTO `cates` VALUES ('40', '奶酪', '16', '0,16');
INSERT INTO `cates` VALUES ('41', '叶菜类', '17', '0,17');
INSERT INTO `cates` VALUES ('42', '养生汤品', '18', '0,18');
INSERT INTO `cates` VALUES ('43', '米', '19', '0,19');
INSERT INTO `cates` VALUES ('44', '水', '20', '0,20');
INSERT INTO `cates` VALUES ('48', '香蕉', '10', '0,10');
INSERT INTO `cates` VALUES ('49', '莓', '11', '0,11');
INSERT INTO `cates` VALUES ('50', '热带水果', '11', '0,11');
INSERT INTO `cates` VALUES ('51', '芒果', '11', '0,11');
INSERT INTO `cates` VALUES ('52', '时令水果', '11', '0,11');
INSERT INTO `cates` VALUES ('53', '果汁/饮料', '20', '0,20');
INSERT INTO `cates` VALUES ('54', '冲调饮品', '20', '0,20');
INSERT INTO `cates` VALUES ('55', '葡萄酒/酒具', '20', '0,20');
INSERT INTO `cates` VALUES ('56', '啤酒', '20', '0,20');
INSERT INTO `cates` VALUES ('57', '杂粮', '19', '0,19');
INSERT INTO `cates` VALUES ('58', '面/面制品', '19', '0,19');
INSERT INTO `cates` VALUES ('59', '油', '19', '0,19');
INSERT INTO `cates` VALUES ('60', '调味料', '19', '0,19');
INSERT INTO `cates` VALUES ('61', '干货', '19', '0,19');
INSERT INTO `cates` VALUES ('62', '果干/零食', '19', '0,19');
INSERT INTO `cates` VALUES ('63', '冷冻点心', '18', '0,18');
INSERT INTO `cates` VALUES ('64', '西式主食', '18', '0,18');
INSERT INTO `cates` VALUES ('65', '中式主食', '18', '0,18');
INSERT INTO `cates` VALUES ('66', '火锅料', '18', '0,18');
INSERT INTO `cates` VALUES ('67', '冷藏熟食', '18', '0,18');
INSERT INTO `cates` VALUES ('68', '半成品菜', '18', '0,18');
INSERT INTO `cates` VALUES ('69', '易盒家宴', '18', '0,18');
INSERT INTO `cates` VALUES ('70', '根茎类', '17', '0,17');
INSERT INTO `cates` VALUES ('71', '茄果/瓜果类', '17', '0,17');
INSERT INTO `cates` VALUES ('72', '花菜/豆类', '17', '0,17');
INSERT INTO `cates` VALUES ('73', '菌菇', '17', '0,17');
INSERT INTO `cates` VALUES ('74', '冷冻蔬菜', '17', '0,17');
INSERT INTO `cates` VALUES ('75', '豆制品', '17', '0,17');
INSERT INTO `cates` VALUES ('76', '葱蒜类', '17', '0,17');
INSERT INTO `cates` VALUES ('77', '蔬菜组合', '17', '0,17');
INSERT INTO `cates` VALUES ('78', '黄油/奶油', '16', '0,16');
INSERT INTO `cates` VALUES ('79', '酸奶/乳酸饮料', '16', '0,16');
INSERT INTO `cates` VALUES ('80', '牛奶', '16', '0,16');
INSERT INTO `cates` VALUES ('81', '面包', '16', '0,16');
INSERT INTO `cates` VALUES ('82', '蛋糕', '16', '0,16');
INSERT INTO `cates` VALUES ('83', '甜点', '16', '0,16');
INSERT INTO `cates` VALUES ('84', '三文鱼', '15', '0,15');
INSERT INTO `cates` VALUES ('85', '蟹', '15', '0,15');
INSERT INTO `cates` VALUES ('86', '贝', '15', '0,15');
INSERT INTO `cates` VALUES ('87', '活鲜', '15', '0,15');
INSERT INTO `cates` VALUES ('88', '海产干货', '15', '0,15');
INSERT INTO `cates` VALUES ('89', '特色海产', '15', '0,15');
INSERT INTO `cates` VALUES ('90', '日韩料理', '14', '0,14');
INSERT INTO `cates` VALUES ('91', ' 美味靓汤', '14', '0,14');
INSERT INTO `cates` VALUES ('92', '经典主菜', '14', '0,14');
INSERT INTO `cates` VALUES ('93', '中华美食', '14', '0,14');
INSERT INTO `cates` VALUES ('94', '精致西餐', '14', '0,14');
INSERT INTO `cates` VALUES ('95', '开胃小菜', '14', '0,14');
INSERT INTO `cates` VALUES ('96', '东南亚风味', '14', '0,14');
INSERT INTO `cates` VALUES ('97', '田园时蔬', '14', '0,14');
INSERT INTO `cates` VALUES ('98', '鹅/鸽/特色禽类', '13', '0,13');
INSERT INTO `cates` VALUES ('99', '蛋', '13', '0,13');
INSERT INTO `cates` VALUES ('100', '猪肉', '12', '0,12');
INSERT INTO `cates` VALUES ('101', '羊肉', '12', '0,12');
INSERT INTO `cates` VALUES ('102', '香肠', '12', '0,12');
INSERT INTO `cates` VALUES ('103', '火腿/培根', '12', '0,12');
INSERT INTO `cates` VALUES ('104', '肉制品', '12', '0,12');
INSERT INTO `cates` VALUES ('105', '进口鹿肉', '12', '0,12');
INSERT INTO `cates` VALUES ('106', '樱桃', '11', '0,11');
INSERT INTO `cates` VALUES ('107', '瓜', '11', '0,11');
INSERT INTO `cates` VALUES ('108', '桃', '11', '0,11');
INSERT INTO `cates` VALUES ('109', '枣', '11', '0,11');
INSERT INTO `cates` VALUES ('110', '凤梨', '11', '0,11');
INSERT INTO `cates` VALUES ('111', '百香果', '11', '0,11');
INSERT INTO `cates` VALUES ('112', '原箱水果', '11', '0,11');
INSERT INTO `cates` VALUES ('113', '桃', '10', '0,10');
INSERT INTO `cates` VALUES ('114', '柑橙橘柚', '10', '0,10');
INSERT INTO `cates` VALUES ('115', '山竹', '10', '0,10');
INSERT INTO `cates` VALUES ('116', '火龙果', '10', '0,10');
INSERT INTO `cates` VALUES ('117', '椰子', '10', '0,10');
INSERT INTO `cates` VALUES ('118', '芒果', '10', '0,10');
INSERT INTO `cates` VALUES ('119', '凤梨', '10', '0,10');
INSERT INTO `cates` VALUES ('120', '热带水果', '10', '0,10');
INSERT INTO `cates` VALUES ('121', '时令水果', '10', '0,10');
INSERT INTO `cates` VALUES ('122', '原箱水果', '10', '0,10');

-- ----------------------------
-- Table structure for `collection`
-- ----------------------------
DROP TABLE IF EXISTS `collection`;
CREATE TABLE `collection` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `gid` int(10) NOT NULL,
  `gname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `price` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `size` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of collection
-- ----------------------------
INSERT INTO `collection` VALUES ('20', '20', '31', 'Zespri佳沛意大利绿奇异果6个83-94g/个', '29', '20180322\\3dadfc3f5418c92913cfbc5ae2604e75.jpg', '1');
INSERT INTO `collection` VALUES ('10', '1', '31', 'Zespri佳沛意大利绿奇异果6个83-94g/个', '29', '20180322\\3dadfc3f5418c92913cfbc5ae2604e75.jpg', '32');
INSERT INTO `collection` VALUES ('11', '1', '43', '常瀛进口香蕉6根', '25.00', '20180327\\71ae6076a50439c0ba796c3d99e3823a.jpg', '26');
INSERT INTO `collection` VALUES ('12', '1', '26', 'Joyfish酸菜牛蛙370g', '35.00', '20180322\\78a02a52104f0acb469c0c01453d0777.jpg', '11');
INSERT INTO `collection` VALUES ('21', '20', '26', 'Joyfish酸菜牛蛙370g', '35.00', '20180322\\78a02a52104f0acb469c0c01453d0777.jpg', '1');
INSERT INTO `collection` VALUES ('19', '20', '43', '常瀛进口香蕉6根', '25.00', '20180327\\71ae6076a50439c0ba796c3d99e3823a.jpg', '1');
INSERT INTO `collection` VALUES ('24', '23', '27', 'Joyfish红焖牛肉300g', '35.00', '20180322\\18862c1160c93122ec88a613fb426b53.jpg', '7');

-- ----------------------------
-- Table structure for `customer`
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,
  `usercon` varchar(255) DEFAULT NULL,
  `admincon` varchar(255) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `ustatus` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=225 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('139', 'a', '哈哈', null, '1522396999', '1', '1');
INSERT INTO `customer` VALUES ('140', 'long', '啊', null, '1522397094', '1', '1');
INSERT INTO `customer` VALUES ('141', 'long', null, '额', '1522397177', '1', '1');
INSERT INTO `customer` VALUES ('142', 'long', '哦', null, '1522397183', '1', '1');
INSERT INTO `customer` VALUES ('143', 'long', null, '哈', '1522397187', '1', '1');
INSERT INTO `customer` VALUES ('144', 'long', '呵', null, '1522397193', '1', '1');
INSERT INTO `customer` VALUES ('145', 'long', null, '嘻', '1522397205', '1', '1');
INSERT INTO `customer` VALUES ('146', '夏益栋', '你好', null, '1522636782', '1', '1');
INSERT INTO `customer` VALUES ('147', 'hjk', 'hjk', null, '1522654370', '1', '1');
INSERT INTO `customer` VALUES ('148', 'hjk', null, 'aaa', '1522654462', '1', '1');
INSERT INTO `customer` VALUES ('149', 'hjk', 'ddd', null, '1522654468', '1', '1');
INSERT INTO `customer` VALUES ('150', 'admin', 'admin', null, '1522763057', '1', '1');
INSERT INTO `customer` VALUES ('151', 'admin', 'admin2', null, '1522763064', '1', '1');
INSERT INTO `customer` VALUES ('152', 'admin', null, 'aaa', '1522763074', '1', '1');
INSERT INTO `customer` VALUES ('153', 'hjk', '111', null, '1523234211', '1', '1');
INSERT INTO `customer` VALUES ('154', 'hjk', null, '222', '1523234217', '1', '1');
INSERT INTO `customer` VALUES ('155', 'hjk', null, '222', '1523234223', '1', '1');
INSERT INTO `customer` VALUES ('156', 'hjk', null, '333', '1523234414', '1', '1');
INSERT INTO `customer` VALUES ('157', 'hjk', null, '44', '1523234424', '1', '1');
INSERT INTO `customer` VALUES ('158', 'hjk', null, '555', '1523234436', '1', '1');
INSERT INTO `customer` VALUES ('159', 'hjk', null, 'eee', '1523234451', '1', '1');
INSERT INTO `customer` VALUES ('160', 'hjk', null, '222', '1523234494', '1', '1');
INSERT INTO `customer` VALUES ('161', 'hjk', null, '33', '1523234502', '1', '1');
INSERT INTO `customer` VALUES ('162', 'hjk', null, 'ttt', '1523234514', '1', '1');
INSERT INTO `customer` VALUES ('163', 'hjk', null, 'ttt', '1523234518', '1', '1');
INSERT INTO `customer` VALUES ('164', 'hjk', null, 'rrr', '1523234523', '1', '1');
INSERT INTO `customer` VALUES ('165', 'hjk', null, 'fff', '1523234528', '1', '1');
INSERT INTO `customer` VALUES ('166', 'hjk', null, 'sss', '1523234556', '1', '1');
INSERT INTO `customer` VALUES ('167', 'hjk', 'zzz', null, '1523234595', '1', '1');
INSERT INTO `customer` VALUES ('168', 'hjk', 'rrr', null, '1523234602', '1', '1');
INSERT INTO `customer` VALUES ('169', 'hjk', '111', null, '1523235050', '1', '1');
INSERT INTO `customer` VALUES ('170', 'hjk', null, '222', '1523235055', '1', '1');
INSERT INTO `customer` VALUES ('171', 'hjk', null, '333', '1523235060', '1', '1');
INSERT INTO `customer` VALUES ('172', 'hjk', null, '444', '1523235064', '1', '1');
INSERT INTO `customer` VALUES ('173', 'hjk', null, '666', '1523235071', '1', '1');
INSERT INTO `customer` VALUES ('174', 'hjk', null, '555', '1523235076', '1', '1');
INSERT INTO `customer` VALUES ('175', 'hjk', null, '777', '1523235081', '1', '1');
INSERT INTO `customer` VALUES ('176', 'hjk', null, '888', '1523235085', '1', '1');
INSERT INTO `customer` VALUES ('177', 'hjk', null, '111', '1523235090', '1', '1');
INSERT INTO `customer` VALUES ('178', 'hjk', null, '222', '1523235094', '1', '1');
INSERT INTO `customer` VALUES ('179', 'hjk', null, '333', '1523235099', '1', '1');
INSERT INTO `customer` VALUES ('180', 'hjk', null, '444', '1523235102', '1', '1');
INSERT INTO `customer` VALUES ('181', 'hjk', null, '555', '1523235108', '1', '1');
INSERT INTO `customer` VALUES ('182', 'hjk', null, '666', '1523235113', '1', '1');
INSERT INTO `customer` VALUES ('183', 'hjk', null, '777', '1523235119', '1', '1');
INSERT INTO `customer` VALUES ('184', 'hjk', null, '888', '1523235124', '1', '1');
INSERT INTO `customer` VALUES ('185', 'hjk', null, '111', '1523235362', '1', '1');
INSERT INTO `customer` VALUES ('186', 'hjk', null, '222', '1523235366', '1', '1');
INSERT INTO `customer` VALUES ('187', '夏益栋', 'zai m ', null, '1523235458', '1', '1');
INSERT INTO `customer` VALUES ('188', '夏益栋', null, '333', '1523235373', '1', '1');
INSERT INTO `customer` VALUES ('189', '夏益栋', null, '11', '1523235377', '1', '1');
INSERT INTO `customer` VALUES ('190', '夏益栋', null, '22', '1523235380', '1', '1');
INSERT INTO `customer` VALUES ('191', '夏益栋', null, '44', '1523235383', '1', '1');
INSERT INTO `customer` VALUES ('192', '夏益栋', null, '55', '1523235386', '1', '1');
INSERT INTO `customer` VALUES ('193', '夏益栋', '23', null, '1523235477', '1', '1');
INSERT INTO `customer` VALUES ('194', 'hjk', 'qqq', null, '1523235445', '1', '1');
INSERT INTO `customer` VALUES ('195', 'hjk', 'www', null, '1523235449', '1', '1');
INSERT INTO `customer` VALUES ('196', 'hjk', 'eee', null, '1523235453', '1', '1');
INSERT INTO `customer` VALUES ('197', 'hjk', 'rrrr', null, '1523235457', '1', '1');
INSERT INTO `customer` VALUES ('198', 'hjk', 'ttt', null, '1523235462', '1', '1');
INSERT INTO `customer` VALUES ('199', 'hjk', 'yyy', null, '1523235470', '1', '1');
INSERT INTO `customer` VALUES ('200', 'hjk', null, 'qqq', '1523235478', '1', '1');
INSERT INTO `customer` VALUES ('201', 'hjk', null, 'www', '1523235482', '1', '1');
INSERT INTO `customer` VALUES ('202', 'hjk', null, 'eee', '1523235487', '1', '1');
INSERT INTO `customer` VALUES ('203', 'hjk', null, 'rrr', '1523235491', '1', '1');
INSERT INTO `customer` VALUES ('204', 'hjk', null, 'ttt', '1523235496', '1', '1');
INSERT INTO `customer` VALUES ('205', 'hjk', null, 'yyy', '1523235502', '1', '1');
INSERT INTO `customer` VALUES ('206', 'hjk', null, 'aaa', '1523235506', '1', '1');
INSERT INTO `customer` VALUES ('207', '夏益栋', '就极乐空间', null, '1523235600', '1', '1');
INSERT INTO `customer` VALUES ('208', '夏益栋', null, 'asdadsd', '1523235526', '1', '1');
INSERT INTO `customer` VALUES ('209', 'hjk', null, 'sss', '1523235531', '1', '1');
INSERT INTO `customer` VALUES ('210', 'hjk', null, 'ddd', '1523235536', '1', '1');
INSERT INTO `customer` VALUES ('211', 'hjk', '111', null, '1523236656', '1', '1');
INSERT INTO `customer` VALUES ('212', 'hjk', null, '222', '1523236663', '1', '1');
INSERT INTO `customer` VALUES ('213', 'hjk', '333', null, '1523236666', '1', '1');
INSERT INTO `customer` VALUES ('214', 'hjk', null, '444', '1523236671', '1', '1');
INSERT INTO `customer` VALUES ('215', 'hjk', null, 'aaa', '1523238545', '1', '1');
INSERT INTO `customer` VALUES ('216', 'hjk', null, 'sss', '1523238550', '1', '1');
INSERT INTO `customer` VALUES ('217', 'hjk', null, 'ddd', '1523238554', '1', '1');
INSERT INTO `customer` VALUES ('218', 'hjk', null, 'fff', '1523238558', '1', '1');
INSERT INTO `customer` VALUES ('219', 'hjk', null, 'ggg', '1523238562', '1', '1');
INSERT INTO `customer` VALUES ('220', 'hjk', '111', null, '1523245348', '1', '1');
INSERT INTO `customer` VALUES ('221', 'hjk', '222', null, '1523245357', '1', '1');
INSERT INTO `customer` VALUES ('222', 'hjk', null, '333', '1523245360', '1', '1');
INSERT INTO `customer` VALUES ('223', '夏益栋', '111', null, '1523245808', '1', '1');
INSERT INTO `customer` VALUES ('224', '夏益栋', null, '444', '1523245824', '1', '1');

-- ----------------------------
-- Table structure for `link`
-- ----------------------------
DROP TABLE IF EXISTS `link`;
CREATE TABLE `link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` tinyint(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of link
-- ----------------------------
INSERT INTO `link` VALUES ('1', 'baidu', 'http://www.baidu.com', '0');
INSERT INTO `link` VALUES ('4', '小黑', 'http://www.xiaohei.com', '0');
INSERT INTO `link` VALUES ('6', '淘宝', 'http://www.taobao.com', '0');
INSERT INTO `link` VALUES ('5', '京东', 'http://www.jd.com', '0');
INSERT INTO `link` VALUES ('7', '小米', 'http://www.mi.com', '0');
INSERT INTO `link` VALUES ('8', '一加', 'http://www.onplus.com', '0');
INSERT INTO `link` VALUES ('9', '<a href=\"www.baidu.com\">haha</a>', 'http://www.haha.com', '0');
INSERT INTO `link` VALUES ('10', 'baiduu', 'http://www.baidu.com', '0');

-- ----------------------------
-- Table structure for `node`
-- ----------------------------
DROP TABLE IF EXISTS `node`;
CREATE TABLE `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `aname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of node
-- ----------------------------
INSERT INTO `node` VALUES ('1', '管理员查看', 'adminusers', 'getIndex');
INSERT INTO `node` VALUES ('2', '管理员添加', 'adminusers', 'getAdd');
INSERT INTO `node` VALUES ('3', '管理员修改', 'adminusers', 'getEdit');
INSERT INTO `node` VALUES ('4', '管理员删除', 'adminusers', 'getDelete');
INSERT INTO `node` VALUES ('5', '角色查看', 'roles', 'getIndex');
INSERT INTO `node` VALUES ('6', '角色添加', 'roles', 'getAdd');
INSERT INTO `node` VALUES ('7', '角色修改', 'roles', 'getEdit');
INSERT INTO `node` VALUES ('8', '角色删除', 'roles', 'getDelete');
INSERT INTO `node` VALUES ('9', '角色权限查看', 'nodes', 'getIndex');
INSERT INTO `node` VALUES ('10', '角色权限修改', 'nodes', 'getEdit');
INSERT INTO `node` VALUES ('11', '用户查看', 'users', 'getIndex');
INSERT INTO `node` VALUES ('12', '用户添加', 'users', 'getAdd');
INSERT INTO `node` VALUES ('13', '用户修改', 'users', 'getEdit');
INSERT INTO `node` VALUES ('14', '用户删除', 'users', 'getDelete');
INSERT INTO `node` VALUES ('15', '用户详情查看', 'users', 'getInfo');
INSERT INTO `node` VALUES ('16', '用户详情添加或修改', 'users', 'postInfochange');
INSERT INTO `node` VALUES ('17', '主页访问', 'index', 'getIndex');
INSERT INTO `node` VALUES ('18', '分类查看', 'cates', 'getIndex');
INSERT INTO `node` VALUES ('19', '分类添加', 'cates', 'getAdd');
INSERT INTO `node` VALUES ('20', '分类修改', 'cates', 'getEdit');
INSERT INTO `node` VALUES ('21', '分类删除', 'cates', 'getDelete');
INSERT INTO `node` VALUES ('22', '公告查看', 'notice', 'getindex');
INSERT INTO `node` VALUES ('23', '公告添加', 'notice', 'getadd');
INSERT INTO `node` VALUES ('24', '公告修改', 'notice', 'getedit');
INSERT INTO `node` VALUES ('25', '公告删除', 'notice', 'getdelete');
INSERT INTO `node` VALUES ('26', '广告查看', 'ads', 'getindex');
INSERT INTO `node` VALUES ('27', '广告添加', 'ads', 'getadd');
INSERT INTO `node` VALUES ('28', '广告修改', 'ads', 'getedit');
INSERT INTO `node` VALUES ('29', '广告删除', 'ads', 'getdelete');
INSERT INTO `node` VALUES ('30', '轮播图查看', 'pics', 'getindex');
INSERT INTO `node` VALUES ('31', '轮播图添加', 'pics', 'getadd');
INSERT INTO `node` VALUES ('32', '轮播图修改', 'pics', 'getedit');
INSERT INTO `node` VALUES ('33', '轮播图删除', 'pics', 'getdelete');
INSERT INTO `node` VALUES ('34', '商品查看', 'goods', 'getindex');
INSERT INTO `node` VALUES ('35', '商品添加', 'goods', 'getadd');
INSERT INTO `node` VALUES ('36', '商品修改', 'goods', 'getedit');
INSERT INTO `node` VALUES ('37', '商品删除', 'goods', 'getdelete');
INSERT INTO `node` VALUES ('38', '商品详情查看', 'goodsinfo', 'getindex');
INSERT INTO `node` VALUES ('39', '商品详情添加', 'goodsinfo', 'getadd');
INSERT INTO `node` VALUES ('40', '商品详情修改', 'goodsinfo', 'getedit');
INSERT INTO `node` VALUES ('41', '商品详情删除', 'goodsinfo', 'getdelete');
INSERT INTO `node` VALUES ('42', '订单查看', 'orders', 'getindex');
INSERT INTO `node` VALUES ('43', '订单发货', 'orders', 'getdeliver');
INSERT INTO `node` VALUES ('44', '订单详情', 'ordersinfo', 'getindex');
INSERT INTO `node` VALUES ('45', '友情链接查看', 'link', 'getindex');
INSERT INTO `node` VALUES ('46', '友情链接添加', 'link', 'getadd');
INSERT INTO `node` VALUES ('47', '友情连接修改', 'link', 'getedit');
INSERT INTO `node` VALUES ('48', '友情连接删除', 'link', 'getdelete');
INSERT INTO `node` VALUES ('49', '用户评价查看', 'assess', 'getindex');
INSERT INTO `node` VALUES ('50', '用户评价删除', 'assess', 'getdelete');
INSERT INTO `node` VALUES ('51', '站内信查看', 'adminmail', 'getindex');
INSERT INTO `node` VALUES ('52', '站内信发送', 'adminmail', 'getadd');
INSERT INTO `node` VALUES ('53', '限时抢购查看', 'shopping', 'getindex');
INSERT INTO `node` VALUES ('54', '限时抢购添加', 'shopping', 'getadd');
INSERT INTO `node` VALUES ('55', '限时抢购修改', 'shopping', 'getedit');
INSERT INTO `node` VALUES ('56', '限时抢购删除', 'shopping', 'getdelete');
INSERT INTO `node` VALUES ('57', '客服', 'customer', 'getindex');

-- ----------------------------
-- Table structure for `notice`
-- ----------------------------
DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `opic` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notice
-- ----------------------------
INSERT INTO `notice` VALUES ('16', '最新促销', '<p>全场八折!</p>', '1522034645.jpg', '20180326/14d3d14c42833a33d52fff93f1d7b12a.jpg');
INSERT INTO `notice` VALUES ('20', '最新公告:', '<p>最新公告:周六周日全体放假</p><p>放假啦</p><p>真的放假了</p>', '1522034879.JPG', '20180326/311498c37102250afd1f4e0e95f0dd24.JPG');
INSERT INTO `notice` VALUES ('21', '今天是最后一天!~', '<p>今天是最后一天!~</p><p>明天清明放假!</p>', '1522831337.gif', '20180404/3954d6149170c1718cb5e106d959494d.gif');
INSERT INTO `notice` VALUES ('22', '最后一天法斗', '<p>最后一天了最后一天了最后一天了最后一天了最后一天了最后一天了最后一天了最后一天了最后一天了最后一天了最后一天了最后一天了最后一天了最后一天了最后一天了最后一天了最后一天了</p>', '1523238046.jpg', '20180409/deb70fe11d2fb3f8044b11cdbb9bc54a.jpg');

-- ----------------------------
-- Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_num` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `address_id` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `order_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('61', '2018040458850', '24', '39', '70', '9', '1522821751');
INSERT INTO `orders` VALUES ('62', '2018040406935', '24', '39', '143', '9', '1522823094');
INSERT INTO `orders` VALUES ('63', '2018040457120', '24', '39', '127', '9', '1522824869');
INSERT INTO `orders` VALUES ('64', '2018040436754', '24', '39', '177', '9', '1522826563');
INSERT INTO `orders` VALUES ('65', '2018040448339', '23', '20', '89', '9', '1522827239');
INSERT INTO `orders` VALUES ('66', '2018040828630', '19', '19', '70', '2', '1523148252');
INSERT INTO `orders` VALUES ('67', '2018040856737', '19', '42', '36', '0', '1523150761');
INSERT INTO `orders` VALUES ('68', '2018040812883', '24', '39', '35', '9', '1523184783');
INSERT INTO `orders` VALUES ('69', '2018040973350', '23', '20', '264', '9', '1523246366');
INSERT INTO `orders` VALUES ('70', '2018040901501', '27', '47', '335.9', '4', '1523247159');

-- ----------------------------
-- Table structure for `order_info`
-- ----------------------------
DROP TABLE IF EXISTS `order_info`;
CREATE TABLE `order_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `good_id` varchar(255) NOT NULL,
  `num` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_info
-- ----------------------------
INSERT INTO `order_info` VALUES ('93', '61', '27', '1');
INSERT INTO `order_info` VALUES ('94', '61', '26', '1');
INSERT INTO `order_info` VALUES ('95', '62', '32', '1');
INSERT INTO `order_info` VALUES ('96', '62', '35', '1');
INSERT INTO `order_info` VALUES ('97', '62', '33', '2');
INSERT INTO `order_info` VALUES ('98', '63', '46', '1');
INSERT INTO `order_info` VALUES ('99', '63', '40', '1');
INSERT INTO `order_info` VALUES ('100', '63', '31', '2');
INSERT INTO `order_info` VALUES ('101', '64', '29', '1');
INSERT INTO `order_info` VALUES ('102', '64', '36', '1');
INSERT INTO `order_info` VALUES ('103', '65', '43', '1');
INSERT INTO `order_info` VALUES ('104', '65', '27', '1');
INSERT INTO `order_info` VALUES ('105', '65', '31', '1');
INSERT INTO `order_info` VALUES ('106', '66', '26', '1');
INSERT INTO `order_info` VALUES ('107', '66', '27', '1');
INSERT INTO `order_info` VALUES ('108', '67', '32', '1');
INSERT INTO `order_info` VALUES ('109', '68', '27', '1');
INSERT INTO `order_info` VALUES ('110', '69', '26', '1');
INSERT INTO `order_info` VALUES ('111', '69', '28', '1');
INSERT INTO `order_info` VALUES ('112', '69', '27', '6');
INSERT INTO `order_info` VALUES ('113', '70', '29', '2');
INSERT INTO `order_info` VALUES ('114', '70', '44', '1');

-- ----------------------------
-- Table structure for `pics`
-- ----------------------------
DROP TABLE IF EXISTS `pics`;
CREATE TABLE `pics` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pic` varchar(255) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pics
-- ----------------------------
INSERT INTO `pics` VALUES ('24', '聚合35', '20180409/ade8db6d6277de20bca8174eaaf768d9.jpg', '1');
INSERT INTO `pics` VALUES ('16', '黑色', '20180321/b546ff0e32beacc3c2028bd83766280c.jpg', '1');
INSERT INTO `pics` VALUES ('17', '狗狗2', '20180321/685d1d01d91a26a111ed4f047aa5e720.jpg', '1');
INSERT INTO `pics` VALUES ('18', '第三方', '20180321/7692bfa0087cb9b648213b6bf656710e.jpg', '1');
INSERT INTO `pics` VALUES ('19', '234', '20180321/c2fc8508d4aca3d5b12117b75418e32f.jpg', '0');
INSERT INTO `pics` VALUES ('20', '876', '20180327/65da36f5023c6d1667a8c58e5149ca0e.jpg', '0');

-- ----------------------------
-- Table structure for `protect`
-- ----------------------------
DROP TABLE IF EXISTS `protect`;
CREATE TABLE `protect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `q1` varchar(255) NOT NULL,
  `a1` varchar(255) NOT NULL,
  `q2` varchar(255) NOT NULL,
  `a2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of protect
-- ----------------------------
INSERT INTO `protect` VALUES ('5', '1', '父亲的真实姓名是？', '1', '我的爱好是？', '1');
INSERT INTO `protect` VALUES ('6', '25', '我的真实姓名是？', '1', '我的生日是？', '1');

-- ----------------------------
-- Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `node` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', '1', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57');
INSERT INTO `role` VALUES ('26', '游客', '1', '1,5,9,11,15,17,18,22,26,30,34,38,42,45,49,53');
INSERT INTO `role` VALUES ('23', '黑名单', '0', '');
INSERT INTO `role` VALUES ('37', 'aaa', '1', '1,17');
INSERT INTO `role` VALUES ('38', 'qqqq', '1', '1,17');
INSERT INTO `role` VALUES ('39', 'bbb', '1', '1,17');

-- ----------------------------
-- Table structure for `shopping`
-- ----------------------------
DROP TABLE IF EXISTS `shopping`;
CREATE TABLE `shopping` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) NOT NULL,
  `hour` varchar(10) NOT NULL,
  `min` varchar(10) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shopping
-- ----------------------------
INSERT INTO `shopping` VALUES ('5', '29', '10', '00', '1');
INSERT INTO `shopping` VALUES ('13', '27', '11', '30', '0');
INSERT INTO `shopping` VALUES ('4', '27', '10', '00', '0');
INSERT INTO `shopping` VALUES ('6', '26', '10', '00', '1');
INSERT INTO `shopping` VALUES ('7', '31', '10', '00', '1');
INSERT INTO `shopping` VALUES ('8', '32', '10', '00', '0');
INSERT INTO `shopping` VALUES ('9', '52', '10', '00', '0');
INSERT INTO `shopping` VALUES ('11', '35', '10', '00', '0');
INSERT INTO `shopping` VALUES ('14', '28', '11', '30', '1');
INSERT INTO `shopping` VALUES ('15', '29', '11', '30', '1');
INSERT INTO `shopping` VALUES ('16', '26', '11', '30', '1');
INSERT INTO `shopping` VALUES ('17', '30', '11', '30', '1');
INSERT INTO `shopping` VALUES ('18', '31', '11', '30', '1');
INSERT INTO `shopping` VALUES ('19', '49', '10', '00', '0');
INSERT INTO `shopping` VALUES ('21', '45', '11', '30', '1');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` char(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('25', 'mokie', '123123', '1207467358@qq.com', '15868263521', '5984');
INSERT INTO `users` VALUES ('18', 'fdevf', '4297f44b13955235245b2497399d7a93', '345@qq.com', '12345678910', '659');
INSERT INTO `users` VALUES ('19', 'long', '4297f44b13955235245b2497399d7a93', '1120368103@qq.com', '13588744709', '9508');
INSERT INTO `users` VALUES ('20', 'hjk', 'e10adc3949ba59abbe56e057f20f883e', '807333741@qq.com', '13646793201', '5693');
INSERT INTO `users` VALUES ('21', 'admin', '4297f44b13955235245b2497399d7a93', '123123@qq.com', '15858585858', '4747');
INSERT INTO `users` VALUES ('26', 'admins', '4297f44b13955235245b2497399d7a93', '123@qq.com', '12312312312', '7322');
INSERT INTO `users` VALUES ('23', '夏益栋', '1a4cf87b4c8376d2ac7a26470a9ad7e4', '1194431790@qq.com', '15957138065', '3075');
INSERT INTO `users` VALUES ('24', '朱成杰', 'e10adc3949ba59abbe56e057f20f883e', '958602927@qq.com', '15700113760', '5444');
INSERT INTO `users` VALUES ('27', 'hjk111', '5654d03685bf36fdf92bf1cf6e2e889c', 'hjk46793201@163.com', '15178397127', '7456');

-- ----------------------------
-- Table structure for `user_info`
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `realname` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `introduction` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_info
-- ----------------------------
INSERT INTO `user_info` VALUES ('12', '20', 'hjk', null, '0', '0', '');
INSERT INTO `user_info` VALUES ('11', '23', '夏益栋', '/userinfo/20180402\\5c21a5cdc335ce97063efa8138af3688.jpg', '1', '24', '你好啊');
INSERT INTO `user_info` VALUES ('13', '25', '', null, '1', '0', '');
INSERT INTO `user_info` VALUES ('14', '27', 'hejunkai', '/userinfo/20180409\\a26db86c1d2c6c7d3098aad126dd42a1.jpg', '0', '111', '111');
