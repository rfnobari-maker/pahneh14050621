-- Dashboard snapshot tables (MySQL 5.1+, utf8_persian_ci)
-- Run once on the application database.

SET NAMES utf8;

-- ---------------------------------------------------------------------------
-- 1) Year status per domain
--    agri/vege open: 1404+1405 | garden/greenhouse/mushroom/bee/aquatic: 1405
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `dash_year_status` (
  `year_agri` varchar(4) COLLATE utf8_persian_ci NOT NULL COMMENT 'سال مثل 1404',
  `domain` enum(
    'agri',
    'vege',
    'garden',
    'greenhouse',
    'mushroom',
    'bee',
    'aquatic'
  ) COLLATE utf8_persian_ci NOT NULL COMMENT 'حوزه داده',
  `status` enum('open','locked') COLLATE utf8_persian_ci NOT NULL DEFAULT 'locked',
  `label` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL COMMENT 'Agri/Vege: 1404_1405 | بقیه: 1405',
  `source_table` varchar(64) COLLATE utf8_persian_ci DEFAULT NULL,
  `locked_at` datetime DEFAULT NULL,
  `locked_by` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`year_agri`, `domain`),
  KEY `idx_dash_year_domain_status` (`domain`, `status`),
  KEY `idx_dash_year_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ---------------------------------------------------------------------------
-- 2) Locked years snapshot (build once, read forever)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `dash_snap_locked` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_agri` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `level_code` enum('country','ostan','city','mar') COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `name_label` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,

  `cnt_agri` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_garden` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_greenhouse` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_mushroom` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_bee` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_animal` int(10) unsigned NOT NULL DEFAULT '0',

  `area_abi` double NOT NULL DEFAULT '0',
  `area_dim` double NOT NULL DEFAULT '0',
  `area_garden_b` double NOT NULL DEFAULT '0',
  `area_garden_gb` double NOT NULL DEFAULT '0',
  `prod_agri` double NOT NULL DEFAULT '0',
  `prod_garden` double NOT NULL DEFAULT '0',

  `users_zone` int(10) unsigned NOT NULL DEFAULT '0',
  `users_staff` int(10) unsigned NOT NULL DEFAULT '0',
  `users_admin` int(10) unsigned NOT NULL DEFAULT '0',

  `children_text` mediumtext COLLATE utf8_persian_ci COMMENT 'لیست فرزند/نقشه به صورت JSON متنی',
  `visits_text` text COLLATE utf8_persian_ci COMMENT 'بازدیدها JSON متنی (اختیاری)',
  `extra_text` mediumtext COLLATE utf8_persian_ci COMMENT 'JSON: garden_area detail, rank',

  `built_at` datetime NOT NULL,
  `build_ms` int(10) unsigned DEFAULT NULL,
  `source_ver` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dash_snap_locked` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`id_mar`),
  KEY `idx_dash_snap_locked_lookup` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`id_mar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ---------------------------------------------------------------------------
-- 3) Open / current year snapshot (nightly rebuild)
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `dash_snap_open` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_agri` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `level_code` enum('country','ostan','city','mar') COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_city` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `id_mar` varchar(5) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `name_label` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,

  `cnt_agri` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_garden` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_greenhouse` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_mushroom` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_bee` int(10) unsigned NOT NULL DEFAULT '0',
  `cnt_animal` int(10) unsigned NOT NULL DEFAULT '0',

  `area_abi` double NOT NULL DEFAULT '0',
  `area_dim` double NOT NULL DEFAULT '0',
  `area_garden_b` double NOT NULL DEFAULT '0',
  `area_garden_gb` double NOT NULL DEFAULT '0',
  `prod_agri` double NOT NULL DEFAULT '0',
  `prod_garden` double NOT NULL DEFAULT '0',

  `users_zone` int(10) unsigned NOT NULL DEFAULT '0',
  `users_staff` int(10) unsigned NOT NULL DEFAULT '0',
  `users_admin` int(10) unsigned NOT NULL DEFAULT '0',

  `children_text` mediumtext COLLATE utf8_persian_ci COMMENT 'لیست فرزند/نقشه به صورت JSON متنی',
  `visits_text` text COLLATE utf8_persian_ci COMMENT 'بازدیدها JSON متنی (اختیاری)',
  `extra_text` mediumtext COLLATE utf8_persian_ci COMMENT 'JSON: garden_area detail, rank',

  `built_at` datetime NOT NULL,
  `build_ms` int(10) unsigned DEFAULT NULL,
  `source_ver` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dash_snap_open` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`id_mar`),
  KEY `idx_dash_snap_open_lookup` (`year_agri`,`level_code`,`id_ostan`,`id_city`,`id_mar`),
  KEY `idx_dash_snap_open_built` (`built_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- ---------------------------------------------------------------------------
-- 4) Build / cron run log
-- ---------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `dash_snap_run` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `started_at` datetime NOT NULL,
  `finished_at` datetime DEFAULT NULL,
  `status` enum('running','ok','fail') COLLATE utf8_persian_ci NOT NULL DEFAULT 'running',
  `target` enum('open','locked','both') COLLATE utf8_persian_ci NOT NULL DEFAULT 'open',
  `year_agri` varchar(4) COLLATE utf8_persian_ci DEFAULT NULL,
  `rows_written` int(10) unsigned NOT NULL DEFAULT '0',
  `error_text` text COLLATE utf8_persian_ci,
  `source_ver` varchar(20) COLLATE utf8_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_dash_snap_run_started` (`started_at`),
  KEY `idx_dash_snap_run_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- Existing installs (optional; also auto-added by PHP ensure on build):
-- ALTER TABLE `dash_snap_open` ADD COLUMN `extra_text` mediumtext COLLATE utf8_persian_ci COMMENT 'JSON: garden_area detail, rank' AFTER `visits_text`;
-- ALTER TABLE `dash_snap_locked` ADD COLUMN `extra_text` mediumtext COLLATE utf8_persian_ci COMMENT 'JSON: garden_area detail, rank' AFTER `visits_text`;
