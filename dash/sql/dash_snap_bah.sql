-- Year-independent beneficiary snapshot (country + ostan).
-- No year_agri: dashboard reads the same counts for 1404 and 1405.
-- City / center stay live from bah.

SET NAMES utf8;

CREATE TABLE IF NOT EXISTS `dash_snap_bah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_code` enum('country','ostan') COLLATE utf8_persian_ci NOT NULL,
  `id_ostan` varchar(2) COLLATE utf8_persian_ci NOT NULL DEFAULT '',
  `name_label` varchar(100) COLLATE utf8_persian_ci DEFAULT NULL,
  `bah_total` int(10) unsigned NOT NULL DEFAULT '0',
  `bah_natural` int(10) unsigned NOT NULL DEFAULT '0',
  `bah_legal` int(10) unsigned NOT NULL DEFAULT '0',
  `bah_male` int(10) unsigned NOT NULL DEFAULT '0',
  `bah_female` int(10) unsigned NOT NULL DEFAULT '0',
  `built_at` datetime NOT NULL,
  `build_ms` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_dash_snap_bah` (`level_code`,`id_ostan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;
