-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- 主機: mariadb
-- 產生時間： 2018 年 10 月 06 日 11:57
-- 伺服器版本: 10.3.7-MariaDB-1:10.3.7+maria~jessie
-- PHP 版本： 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- 資料庫： `mopcon-test`
--

-- --------------------------------------------------------

--
-- 資料表結構 `filegame_booth_missions`
--

CREATE TABLE `filegame_booth_missions` (
  `mission_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mission_id with timestamp, format: m_1000058673',
  `mission` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '攤位挑戰名稱',
  `mission_info` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '攤位挑戰內容',
  `reward` double NOT NULL DEFAULT 0 COMMENT '挑戰獎勵',
  `boothname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '挑戰獎勵',
  `boothinfo` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '攤位資訊',
  `started_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '開始時間',
  `expired_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '截止時間',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='攤位挑戰任務';

-- --------------------------------------------------------

--
-- 資料表結構 `filegame_quizzes`
--

CREATE TABLE `filegame_quizzes` (
  `quiz_id` varchar(12) COLLATE utf8_unicode_ci NOT NULL COMMENT 'quiz_id with timestamp, format: q_1000058673',
  `quiz` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '題目',
  `answer` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '答案',
  `choices` longtext COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '選項 with json',
  `reward` double NOT NULL DEFAULT 0 COMMENT '答題成功獎勵',
  `started_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '開始時間',
  `expired_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '截止時間',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='大地遊戲題庫';

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `public_key` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'RSA public key',
  `device_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'andoird, iOS, blackbarry, and so on...',
  `fcm_push_token` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'fcm 訂閱者的 user_token',
  `mission_progress` longtext COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '目前的攤位挑戰進度 with Json',
  `quiz_progress` longtext COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '目前的解題進度 with Json',
  `biilabs_balance` double NOT NULL DEFAULT 0 COMMENT 'biilabs 錢包餘額(本地統計)',
  `biilabs_address` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'biilabs 錢包 address',
  `biilabs_seed` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'biilabs 錢包 seed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用戶資訊';

-- --------------------------------------------------------

--
-- 資料表結構 `user_passbook`
--

CREATE TABLE `user_passbook` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '交易摘要',
  `info` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '交易詳細資訊',
  `withdrawal` double NOT NULL DEFAULT 0 COMMENT '提款額，如消費行為',
  `deposit` double NOT NULL DEFAULT 0 COMMENT '存款額，如賺取代幣',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='存簿，只有成功交易的才會寫入存簿';

-- --------------------------------------------------------

--
-- 資料表結構 `user_transactions`
--

CREATE TABLE `user_transactions` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '交易摘要',
  `info` text COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '交易詳細資訊',
  `amount` double NOT NULL DEFAULT 0 COMMENT '交易金額',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '交易類型 deposit | withdrawal',
  `status` smallint(6) NOT NULL DEFAULT 0 COMMENT '0: 未處理, 1: 成功, 2: 失敗',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='所有的交易請求，狀態 status 需更新';

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `filegame_booth_missions`
--
ALTER TABLE `filegame_booth_missions`
  ADD PRIMARY KEY (`mission_id`);

--
-- 資料表索引 `filegame_quizzes`
--
ALTER TABLE `filegame_quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uuid`);

--
-- 資料表索引 `user_passbook`
--
ALTER TABLE `user_passbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_passbook_uuid` (`uuid`);

--
-- 資料表索引 `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_transactions_uuid` (`uuid`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `user_passbook`
--
ALTER TABLE `user_passbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

SET AUTOCOMMIT=1;
