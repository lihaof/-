INSERT INTO `bms_open_time` (`start`, `end`, `price`, `time`, `status`, `court_num`) VALUES ('08:00:00', '10:00:00', 100.00, 1478964128, 1, 4);
INSERT INTO `bms_open_time` (`start`, `end`, `price`, `time`, `status`, `court_num`) VALUES ('10:00:00', '12:00:00', 100.00, 1478964143, 1, 4);
INSERT INTO `bms_open_time` (`start`, `end`, `price`, `time`, `status`, `court_num`) VALUES ('12:00:00', '14:00:00', 100.00, 1478964157, 1, 4);
INSERT INTO `bms_open_time` (`start`, `end`, `price`, `time`, `status`, `court_num`) VALUES ('14:00:00', '16:00:00', 100.00, 1478964175, 1, 4);
INSERT INTO `bms_open_time` (`start`, `end`, `price`, `time`, `status`, `court_num`) VALUES ('16:00:00', '18:00:00', 100.00, 1478964190, 1, 4);
INSERT INTO `bms_open_time` (`start`, `end`, `price`, `time`, `status`, `court_num`) VALUES ('18:00:00', '20:00:00', 100.00, 1478964202, 1, 4);
INSERT INTO `bms_open_time` (`start`, `end`, `price`, `time`, `status`, `court_num`) VALUES ('20:00:00', '22:00:00', 100.00, 1478964217, 1, 4);

INSERT INTO `bms_module_permissions` (`module_name`, `identity`, `display_order`, `pmid`, `level1`, `level2`, `level3`, `level4`, `level5`, `level6`, `level7`) VALUES ('开放时段管理', 'Time', 0, 0, 0, 0, 0, 1, 1, 1, 1);
INSERT INTO `bms_module_permissions` (`module_name`, `identity`, `display_order`, `pmid`, `level1`, `level2`, `level3`, `level4`, `level5`, `level6`, `level7`) VALUES ('具体时段管理', 'List', 0, 0, 0, 0, 0, 1, 1, 1, 1);
INSERT INTO `bms_module_permissions` (`module_name`, `identity`, `display_order`, `pmid`, `level1`, `level2`, `level3`, `level4`, `level5`, `level6`, `level7`) VALUES ('用户预约管理', 'Order', 0, 0, 0, 0, 0, 1, 1, 1, 1);

--
-- 转存表中的数据 `bms_team`
--
INSERT INTO `bms_team` (`team_id`, `team_name`, `team_leader`, `team_slogan`, `team_picture`, `team_status`) VALUES
(1, '球队1', 1, '球队1的宣言', 'default.png', 1),
(2, '球队2', 2, '球队2的宣言', 'default.png', 1),
(3, '球队3', 1, '球队3的宣言', 'default.png', 1),
(4, '球队4', 2, '球队4是未审核的，宣言', 'default.png', 0),
(5, '球队5', 1, '球队5也是未审核的，宣言', 'default.png', 3);

--
-- 转存表中的数据 `bms_team_memmber`
--
INSERT INTO `bms_team_memmber` (`team_memmber_id`, `team_id`, `position`, `team_memmber_status`, `uid`) VALUES
(1, 1, 0, 2, 1),
(2, 2, 2, 2, 2),
(4, 2, 0, 1, 1),
(5, 1, 4, 0, 2),
(6, 3, 5, 1, 2),
(8, 1, 3, 3, 2);