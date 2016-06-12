-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 06 月 11 日 19:50
-- 服务器版本: 5.5.47
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `webim`
--
CREATE DATABASE `webim` DEFAULT CHARACTER SET gbk COLLATE gbk_chinese_ci;
USE `webim`;

-- --------------------------------------------------------

--
-- 表的结构 `msg`
--
-- 创建时间: 2016 年 06 月 09 日 13:19
-- 最后更新: 2016 年 06 月 09 日 14:15
--

CREATE TABLE IF NOT EXISTS `msg` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(30) NOT NULL,
  `text` text NOT NULL,
  `to` varchar(30) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `msg`
--

INSERT INTO `msg` (`msg_id`, `from`, `text`, `to`, `time`) VALUES
(1, 'admin', 'wqe', 'admin0', '2016-06-09 13:18:45'),
(2, 'admin', '12312312312', 'admin0', '2016-06-09 13:19:52'),
(3, 'admin', 'qqq', 'admin0', '2016-06-09 13:23:49'),
(4, 'admin', '鎴戠埍浣', 'admin0', '2016-06-09 13:28:00'),
(5, 'admin', '', 'admin0', '2016-06-09 14:06:04'),
(6, 'admin', '', 'admin0', '2016-06-09 14:06:44'),
(7, 'admin0', '12312qweasd', 'admin', '2016-06-09 14:15:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
