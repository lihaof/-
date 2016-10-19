-- 大家把建表的信息都写在这个文件里
-- 每个字段后面都要用 COMMENT '注释'

-- 导出  表 bms.bms_time_limit 结构
CREATE TABLE IF NOT EXISTS `bms_time_limit` (
  `time_limit_id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `time` int(10) unsigned NOT NULL DEFAULT '604800' COMMENT '时间,单位:秒(7天=604800秒)',
  PRIMARY KEY (`time_limit_id`),
  KEY `time` (`time`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='预约时间限制记录';

INSERT IGNORE INTO `bms_time_limit` (`time_limit_id`, `time`) VALUES
  (1, 604800);

-- 导出  表 bms.bms_open_time 结构
CREATE TABLE IF NOT EXISTS `bms_open_time` (
  `time_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增time_id',
  `start` time NOT NULL COMMENT '时段开始时间。格式: 13:59:23',
  `end` time NOT NULL COMMENT '时段结束时间。格式: 13:59:23',
  `price` decimal(10,2) unsigned NOT NULL COMMENT '预订价格',
  `time` int(10) unsigned NOT NULL COMMENT '修改时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '开放状态,1启用,2停用',
  `court_num` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '开放球场数量',
  PRIMARY KEY (`time_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台设置开放时间段的数据表';

-- 导出  表 bms.bms_time_list 结构
CREATE TABLE IF NOT EXISTS `bms_time_list` (
  `list_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增list_id',
  `date` date NOT NULL COMMENT '日期,日期格式: 2016-02-29',
  `start` time NOT NULL COMMENT '开始时间,时间格式: 14:59:03',
  `end` time NOT NULL COMMENT '结束时间,时间格式:  14:59:03',
  `price` decimal(10,2) unsigned NOT NULL COMMENT '预约价格,价格格式: 123.00',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '预约状态,1:开放预约,2...,3:管理员锁定此时段不开放预约',
  `court_num` tinyint(3) unsigned NOT NULL COMMENT '开放球场数量',
  `surplus_num` tinyint(3) unsigned NOT NULL COMMENT '球场剩余数量',
  PRIMARY KEY (`list_id`)
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

-- 导出  表 bms.bms_team 结构
CREATE TABLE IF NOT EXISTS `bms_team`(
  `team_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `team_name` varchar(200) NOT NULL COMMENT '球队名称',
  `team_leader` int(8) unsigned COMMENT '队长id',
  `team_memmber_id` int(8) unsigned COMMENT '成员列表',
  `team_slogan` mediumtext COMMENT '球队口号',
  `team_picture` varchar(40) COMMENT '球队宣传照片',
  `team_status` int(8) DEFAULT '0' COMMENT '是否通过审核',
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 导出  表 bms.bms_team_memmber 结构
CREATE TABLE IF NOT EXISTS `bms_team_memmber`(
  `team_memmber_id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '所属球队',
  `uid` int(8) unsigned COMMENT '球队成员id',
  PRIMARY KEY (`team_memmber_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 导出  表 bms.bms_module_permissions 结构
CREATE TABLE IF NOT EXISTS `bms_module_permissions`(
  `mid` int (10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增的模块id',
  `module_name` varchar(40) NOT NULL COMMENT '模块的名称',
  `identity` varchar(20) NOT NULL COMMENT '该模块对应的类或方法',
  `display_order` int(3) unsigned NOT NULL COMMENT '模块显示的顺序',
  `pmid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父模块id，默认为0',
  `level1` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '对该等级用户权限：1有，0无',
  `level2` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '对该等级用户权限：1有，0无',
  `level3` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '对该等级用户权限：1有，0无',
  `level4` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '对该等级用户权限：1有，0无',
  `level5` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '对该等级用户权限：1有，0无',
  `level6` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '对该等级用户权限：1有，0无',
  `level7` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '对该等级用户权限：1有，0无',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模块和权限的对应表';


-- 球队员请求加入球队 加入球队申请表  bms_join_info
DROP TABLE IF EXISTS `bms_join_info`;
CREATE TABLE IF NOT EXISTS `bms_join_info` (
  `teamid` char(138) NOT NULL COMMENT '队伍id',
  `member` int(8) NOT NULL COMMENT '想要加入该队伍的队员',
  `status` int(1) NOT NULL COMMENT '0表等待队长审核，1表队长审核通过，2表队长审核失败',
  PRIMARY KEY (`member`)
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT= '添加队伍信息表';

-- 球队信息 表 bms_team_info
DROP TABLE IF EXISTS `bms_team_info`;
CREATE TABLE IF NOT EXISTS `bms_team_info` (
  `teamid` int(5) NOT NULL AUTO_INCREMENT COMMENT '队伍id',
  `status` int(1) NOT NULL COMMENT '队伍状态，0表待审核，1表审核通过，2表审核失败',
  `teamname` varchar(40) NOT NULL COMMENT '队伍名称',
  `teamleader` int(8) NOT NULL COMMENT '队长id',
  `teamnum` int(2) NOT NULL COMMENT '队伍目前人数',
  `member_1` int(8) NULL COMMENT '队员1号id',
  `member_2` int(8) NULL COMMENT '队员2号id',
  `member_3` int(8) NULL COMMENT '队员3号id',
  `member_4` int(8) NULL COMMENT '队员4号id',
  PRIMARY KEY (`teamid`)
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT = '队伍信息表';


-- 用户信息表 bms_user_info
DROP TABLE IF EXISTS `bms_user_info`;
CREATE TABLE IF NOT EXISTS `bms_user_info` (
  `openid` varchar(40) NOT NULL COMMENT 'openid',
  `uid` int(8) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `nickname` varchar(40) NOT NULL COMMENT '用户昵称',
  `weight` varchar(3) NULL COMMENT '用户体重',
  `height` int(3) NULL COMMENT '用户身高',
  `position` int(1) NULL COMMENT '用户场位',
  `point` int(7) NULL COMMENT '用户积分',
  `user_level` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户权限等级',
  `teamid` int(5) NULL COMMENT '队伍id',
  PRIMARY KEY (`uid`)
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT = '用户信息表';

-- 管理员信息表 bms_administrator
CREATE TABLE IF NOT EXISTS `bms_administrator` (
  `aid` int(10) NOT NULL AUTO_INCREMENT COMMENT '管理员自增id',
  `user` varchar(40) NOT NULL COMMENT '管理员账号',
  `password` varchar(50) NOT NULL COMMENT '管理员密码',
  `level` tinyint(1) NOT NULL DEFAULT '4' COMMENT '权限等级，管理员从4至7，默认为4',
  PRIMARY KEY (`aid`)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT = '管理员信息表';

