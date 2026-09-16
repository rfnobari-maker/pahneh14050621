-- dash_year_status seed for MySQL 5.1
-- Paste in phpMyAdmin SQL tab (Import file often fails)
-- Open: agri,vege=1404+1405 | garden,greenhouse,mushroom,bee,aquatic=1405
-- Real table names:
--   AgriYYYY_YYYY+1 + Agri_prodYYYY_YYYY+1
--   Vege + Vege_prod (z_sal)
--   Garden + Garden_prod (z_sal)
--   Greenhous + Greenhous_prod
--   Mushroom + Mushroom_prod
--   bee (no bee_prod)
--   Aquatic + Aquatic2

SET NAMES utf8;

DROP TABLE IF EXISTS dash_year_status;

CREATE TABLE dash_year_status (
  year_agri varchar(4) NOT NULL,
  domain enum('agri','vege','garden','greenhouse','mushroom','bee','aquatic') NOT NULL,
  status enum('open','locked') NOT NULL DEFAULT 'locked',
  label varchar(20) DEFAULT NULL,
  source_table varchar(64) DEFAULT NULL,
  locked_at datetime DEFAULT NULL,
  locked_by varchar(50) DEFAULT NULL,
  note varchar(255) DEFAULT NULL,
  updated_at datetime DEFAULT NULL,
  PRIMARY KEY (year_agri, domain),
  KEY idx_dash_year_domain_status (domain, status),
  KEY idx_dash_year_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- Force open years into the year list even if absent from b_sal
CREATE TEMPORARY TABLE dash_seed_years (sal varchar(4) NOT NULL PRIMARY KEY);
INSERT IGNORE INTO dash_seed_years (sal) SELECT sal FROM b_sal;
INSERT IGNORE INTO dash_seed_years (sal) VALUES ('1404'), ('1405');

INSERT INTO dash_year_status (year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
SELECT
  sal, 'agri',
  IF(sal IN ('1404','1405'), 'open', 'locked'),
  CONCAT(sal, '_', CAST(sal AS UNSIGNED) + 1),
  CONCAT('Agri', sal, '_', CAST(sal AS UNSIGNED) + 1, ',Agri_prod', sal, '_', CAST(sal AS UNSIGNED) + 1),
  IF(sal IN ('1404','1405'), NULL, NOW()),
  IF(sal IN ('1404','1405'), NULL, 'seed'),
  IF(sal IN ('1404','1405'), 'active year', 'locked year'),
  NOW()
FROM dash_seed_years;

INSERT INTO dash_year_status (year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
SELECT
  sal, 'vege',
  IF(sal IN ('1404','1405'), 'open', 'locked'),
  CONCAT(sal, '_', CAST(sal AS UNSIGNED) + 1),
  'Vege,Vege_prod',
  IF(sal IN ('1404','1405'), NULL, NOW()),
  IF(sal IN ('1404','1405'), NULL, 'seed'),
  IF(sal IN ('1404','1405'), 'active year', 'locked year'),
  NOW()
FROM dash_seed_years;

INSERT INTO dash_year_status (year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
SELECT
  sal, 'garden',
  IF(sal = '1405', 'open', 'locked'),
  sal,
  'Garden,Garden_prod',
  IF(sal = '1405', NULL, NOW()),
  IF(sal = '1405', NULL, 'seed'),
  IF(sal = '1405', 'active year', 'locked year'),
  NOW()
FROM dash_seed_years;

INSERT INTO dash_year_status (year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
SELECT
  sal, 'greenhouse',
  IF(sal = '1405', 'open', 'locked'),
  sal,
  'Greenhous,Greenhous_prod',
  IF(sal = '1405', NULL, NOW()),
  IF(sal = '1405', NULL, 'seed'),
  IF(sal = '1405', 'active year', 'locked year'),
  NOW()
FROM dash_seed_years;

INSERT INTO dash_year_status (year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
SELECT
  sal, 'mushroom',
  IF(sal = '1405', 'open', 'locked'),
  sal,
  'Mushroom,Mushroom_prod',
  IF(sal = '1405', NULL, NOW()),
  IF(sal = '1405', NULL, 'seed'),
  IF(sal = '1405', 'active year', 'locked year'),
  NOW()
FROM dash_seed_years;

INSERT INTO dash_year_status (year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
SELECT
  sal, 'bee',
  IF(sal = '1405', 'open', 'locked'),
  sal,
  'bee',
  IF(sal = '1405', NULL, NOW()),
  IF(sal = '1405', NULL, 'seed'),
  IF(sal = '1405', 'active year', 'locked year'),
  NOW()
FROM dash_seed_years;

INSERT INTO dash_year_status (year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
SELECT
  sal, 'aquatic',
  IF(sal = '1405', 'open', 'locked'),
  sal,
  'Aquatic,Aquatic2',
  IF(sal = '1405', NULL, NOW()),
  IF(sal = '1405', NULL, 'seed'),
  IF(sal = '1405', 'active year', 'locked year'),
  NOW()
FROM dash_seed_years;

DROP TEMPORARY TABLE dash_seed_years;
