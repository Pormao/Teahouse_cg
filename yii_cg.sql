-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017-12-01 21:56:02
-- 服务器版本： 5.5.55-log
-- PHP Version: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii_cg`
--

-- --------------------------------------------------------

--
-- 表的结构 `pre_admin`
--

CREATE TABLE IF NOT EXISTS `pre_admin` (
  `id` bigint(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- 表的结构 `pre_cgdata`
--

CREATE TABLE IF NOT EXISTS `pre_cgdata` (
  `Id` bigint(11) NOT NULL,
  `cgname` varchar(200) NOT NULL,
  `cgdescr` varchar(200) NOT NULL,
  `cgtype` varchar(255) DEFAULT NULL,
  `cgmd5` varchar(200) NOT NULL,
  `cg_createuid` varchar(200) NOT NULL,
  `cg_createtime` varchar(200) NOT NULL,
  `cg_headpath` varchar(200) NOT NULL,
  `cg_backgroundpath` varchar(200) NOT NULL COMMENT '背景图路径',
  `cg_follow_num` varchar(200) NOT NULL DEFAULT '0',
  `cg_thread_num` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pre_cgfollow`
--

CREATE TABLE IF NOT EXISTS `pre_cgfollow` (
  `Id` bigint(11) NOT NULL,
  `cgid` varchar(255) DEFAULT NULL,
  `cgname` varchar(255) DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `exp` varchar(255) DEFAULT NULL,
  `join_time` varchar(255) DEFAULT NULL,
  `follow` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pre_cgmessage`
--

CREATE TABLE IF NOT EXISTS `pre_cgmessage` (
  `id` bigint(20) NOT NULL,
  `send_uid` bigint(20) NOT NULL,
  `send_username` varchar(220) CHARACTER SET utf8 NOT NULL,
  `receive_uid` bigint(20) NOT NULL,
  `post_content` varchar(100) CHARACTER SET utf8 NOT NULL,
  `tid` bigint(20) NOT NULL,
  `rid` bigint(20) NOT NULL,
  `rrid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `pre_cgthreads`
--

CREATE TABLE IF NOT EXISTS `pre_cgthreads` (
  `Id` bigint(11) NOT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_abstract` varchar(255) DEFAULT NULL,
  `post_content` longtext,
  `post_time` varchar(255) DEFAULT NULL,
  `post_floor_num` varchar(255) NOT NULL DEFAULT '1',
  `update_time` varchar(255) DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL COMMENT '为了测试性能暂时保留',
  `cgname` varchar(255) NOT NULL,
  `cgmd5` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pre_cgthread_reply`
--

CREATE TABLE IF NOT EXISTS `pre_cgthread_reply` (
  `Id` bigint(11) NOT NULL,
  `post_content` longtext NOT NULL,
  `post_floor` bigint(20) NOT NULL,
  `post_floor_num` varchar(255) NOT NULL DEFAULT '0',
  `post_time` varchar(255) NOT NULL,
  `tid` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pre_cgthread_reply_floor`
--

CREATE TABLE IF NOT EXISTS `pre_cgthread_reply_floor` (
  `Id` bigint(11) NOT NULL,
  `post_content` longtext NOT NULL,
  `post_time` varchar(255) NOT NULL,
  `post_floor` bigint(20) NOT NULL,
  `tid` bigint(20) NOT NULL,
  `rid` varchar(255) NOT NULL,
  `send_uid` varchar(255) NOT NULL,
  `send_username` varchar(255) NOT NULL DEFAULT '',
  `receive_uid` varchar(255) NOT NULL DEFAULT '',
  `receive_username` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `pre_migration`
--

CREATE TABLE IF NOT EXISTS `pre_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pre_user`
--

CREATE TABLE IF NOT EXISTS `pre_user` (
  `id` bigint(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `headpath` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pre_admin`
--
ALTER TABLE `pre_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `pre_cgdata`
--
ALTER TABLE `pre_cgdata`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `pre_cgfollow`
--
ALTER TABLE `pre_cgfollow`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `pre_cgmessage`
--
ALTER TABLE `pre_cgmessage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_cgthreads`
--
ALTER TABLE `pre_cgthreads`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `pre_cgthread_reply`
--
ALTER TABLE `pre_cgthread_reply`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `pre_cgthread_reply_floor`
--
ALTER TABLE `pre_cgthread_reply_floor`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `post_floor` (`post_floor`),
  ADD KEY `post_floor_2` (`post_floor`);

--
-- Indexes for table `pre_migration`
--
ALTER TABLE `pre_migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `pre_user`
--
ALTER TABLE `pre_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pre_admin`
--
ALTER TABLE `pre_admin`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pre_cgdata`
--
ALTER TABLE `pre_cgdata`
  MODIFY `Id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pre_cgfollow`
--
ALTER TABLE `pre_cgfollow`
  MODIFY `Id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pre_cgmessage`
--
ALTER TABLE `pre_cgmessage`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pre_cgthreads`
--
ALTER TABLE `pre_cgthreads`
  MODIFY `Id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pre_cgthread_reply`
--
ALTER TABLE `pre_cgthread_reply`
  MODIFY `Id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pre_cgthread_reply_floor`
--
ALTER TABLE `pre_cgthread_reply_floor`
  MODIFY `Id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pre_user`
--
ALTER TABLE `pre_user`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
