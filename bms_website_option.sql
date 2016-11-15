-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-11-10 12:27:50
-- 服务器版本： 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bms`
--

-- --------------------------------------------------------

--
-- 表的结构 `bms_website_option`
--

CREATE TABLE `bms_website_option` (
  `oid` tinyint(1) NOT NULL COMMENT '选项自增id',
  `oname` varchar(40) NOT NULL COMMENT '选项名称',
  `otype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '选项对应的类型：0单行填空，1单选，2多选，3下拉菜单',
  `odescription` varchar(100) NOT NULL COMMENT '对选项的描述',
  `oorder` tinyint(2) NOT NULL COMMENT '选项出现的顺序',
  `oselection` varchar(1000) DEFAULT NULL COMMENT '如果类型为单选，多选或者是下拉菜单时不为空，此字段用于存放选择项,各个选项用;隔开',
  `ovalue` varchar(100) NOT NULL COMMENT '各个选项的值，如果类型为单选，多选或者是下拉菜单时从0开始，按oselection字段中选择项的顺序存入'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='站点设置表';

--
-- 转存表中的数据 `bms_website_option`
--

INSERT INTO `bms_website_option` (`oid`, `oname`, `otype`, `odescription`, `oorder`, `oselection`, `ovalue`) VALUES
(1, '站点名称', 0, '站点的名称将显示在网页的标题处', 1, NULL, '好气啊在线'),
(2, '站点地址', 0, '站点地址主要用于生成内容的永久链接', 2, NULL, '地址没掉了wwww'),
(3, '站点描述', 0, '站点描述将显示在网页代码的头部', 3, NULL, '这里是http://www.w2fzu.com'),
(4, '关键词', 0, '请以半角逗号“,”分割多个关键字', 4, NULL, 'balabala这里是西二在线的官方网站'),
(5, '是否允许注册', 1, '允许反问者注册到你的网站，默认的注册用户不享有任何的写入权利', 5, '允许;不允许', '0'),
(6, '时区', 3, '选择所在时区', 6, '埃尼威托克岛，夸贾林岛 西12区;中途岛，东萨摩亚  西11区;夏威夷 西10区;阿拉斯加  西9区;太平洋时间（美国和加拿大），蒂华纳 西8区;山地时间（美国和加拿大），亚利桑那 西7区;中部时间（美国和加拿大），墨西哥城，特古西加尔巴，萨斯喀彻温省 西6区;东部时间（美国和加拿大），印第安那州（东部），波哥大，利马，基多  西5区;大西洋时间（加拿大），加拉加斯，拉巴斯 西4区;巴西利亚，布宜诺斯艾利斯，乔治敦  西3区;中大西洋  西2区;亚速尔群岛，佛得角群岛 西1区;伦敦，都柏林，爱丁堡，里斯本，卡萨布兰卡，蒙罗维亚', ''),
(7, '允许上传的文件类型', 2, '设置允许上传的文件类型', 7, '图片文件;多媒体文件;常用档案文件;视频文件', '0;1;2'),
(8, '开设站点数量', 1, '选择一共开设的站点的数量', 8, '只有一个;有两个啊;我们可有三个呢;辣鸡我有四个', '3'),
(9, '怎么这么难啊？', 1, '这到底是为什么呢？', 9, '对啊;没错;就是这样！', '0'),
(10, '你是通过什么方式了解到这个网站的？', 2, '选择了解此网站的途径', 10, '手机上;电视上;报纸上;从别人那里听说的;随便点开的', '2;3'),
(11, '今天是什么节日呢？', 3, '看一下今天是什么节日', 11, '万圣节;圣诞节;光棍节;感恩节;复活节;春节;单身狗节;单身好惨节;没有女朋友节;全世界就我单身节', ''),
(12, '最后一个', 0, '是不是最后一个啊？', 12, '这是用来测试的~', ''),
(13, '我是还行啦', 2, '这个才是最后一个‘', 13, '啥vhxv;就是不行那不行;环丙沙星', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bms_website_option`
--
ALTER TABLE `bms_website_option`
  ADD PRIMARY KEY (`oid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bms_website_option`
--
ALTER TABLE `bms_website_option`
  MODIFY `oid` tinyint(1) NOT NULL AUTO_INCREMENT COMMENT '选项自增id', AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
