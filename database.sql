-- 大家把建表的信息都写在这个文件里
-- 每个字段后面都要用 COMMENT '注释'


-- 导出  表 bms.bms_open_time 结构
CREATE TABLE IF NOT EXISTS `bms_open_time` (
  `time_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增time_id',
  `start` time NOT NULL COMMENT '时段开始时间。格式: 13:59:23',
  `end` time NOT NULL COMMENT '时段结束时间。格式: 13:59:23',
  `price` decimal(10,2) unsigned NOT NULL COMMENT '预订价格',
  `time` int(10) unsigned NOT NULL COMMENT '修改时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '开放状态,1开放,2不开放',
  PRIMARY KEY (`time_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台设置开放时间段的数据表';

-- 导出  表 bms.bms_time_list 结构
CREATE TABLE IF NOT EXISTS `bms_time_list` (
  `list_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增list_id',
  `uid` int(8) unsigned NOT NULL COMMENT '预约人uid,未预约为空,已预约则为预约者uid',
  `start` datetime NOT NULL COMMENT '开始时间,时间格式: 2016-02-29 14:59:03',
  `end` datetime NOT NULL COMMENT '结束时间,时间格式: 2016-02-29 14:59:03',
  `price` decimal(10,2) unsigned NOT NULL COMMENT '预约价格,价格格式: 123.00',
  `time` int(10) unsigned NOT NULL COMMENT '预约时间戳',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '预约状态,1:未被预约,2:已被预约,3:管理员锁定此时段不开放预约',
  PRIMARY KEY (`list_id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='每一天自动生成的预订表,需要生成的时段从bms_open_time读取';

-- 导出  表 bms.bms_user_order 结构
CREATE TABLE IF NOT EXISTS `bms_user_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增order_id',
  `uid` int(8) unsigned NOT NULL COMMENT '用户uid',
  `list_id` int(10) unsigned NOT NULL COMMENT '时间表里面的id',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '预约状态,1:预约成功,2:预约取消',
  `time` int(10) unsigned NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`order_id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户预约申请记录';

-- 导出  表 bms.bms_goods 结构
CREATE TABLE IF NOT EXISTS `bms_goods`(
  `goods_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(200) NOT NULL COMMENT '商品名称',
  `goods_desc`  mediumtext COMMENT '商品详情',
  `goods_picture` varchar(40) NOT NULL COMMENT '图片id',  
  `goods_value` int(8) unsigned NOT NULL COMMENT '商品价值',
  `goods_status` int(8) unsigned COMMENT '是否在售',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


