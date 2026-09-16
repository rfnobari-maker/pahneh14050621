-- Ensure year 1404/1405 rows exist with correct open status
-- Paste in phpMyAdmin SQL tab (not Import)
-- agri+vege open: 1404,1405 | garden open: 1405

SET NAMES utf8;

-- agri 1404
INSERT INTO dash_year_status
(year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
VALUES
('1404','agri','open','1404_1405','Agri1404_1405,Agri_prod1404_1405',NULL,NULL,'active year',NOW())
ON DUPLICATE KEY UPDATE
  status='open', label='1404_1405',
  source_table='Agri1404_1405,Agri_prod1404_1405',
  locked_at=NULL, locked_by=NULL, note='active year', updated_at=NOW();

-- agri 1405
INSERT INTO dash_year_status
(year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
VALUES
('1405','agri','open','1405_1406','Agri1405_1406,Agri_prod1405_1406',NULL,NULL,'active year',NOW())
ON DUPLICATE KEY UPDATE
  status='open', label='1405_1406',
  source_table='Agri1405_1406,Agri_prod1405_1406',
  locked_at=NULL, locked_by=NULL, note='active year', updated_at=NOW();

-- vege 1404
INSERT INTO dash_year_status
(year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
VALUES
('1404','vege','open','1404_1405','Vege,Vege_prod',NULL,NULL,'active year',NOW())
ON DUPLICATE KEY UPDATE
  status='open', label='1404_1405',
  source_table='Vege,Vege_prod',
  locked_at=NULL, locked_by=NULL, note='active year', updated_at=NOW();

-- vege 1405
INSERT INTO dash_year_status
(year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
VALUES
('1405','vege','open','1405_1406','Vege,Vege_prod',NULL,NULL,'active year',NOW())
ON DUPLICATE KEY UPDATE
  status='open', label='1405_1406',
  source_table='Vege,Vege_prod',
  locked_at=NULL, locked_by=NULL, note='active year', updated_at=NOW();

-- garden 1405
INSERT INTO dash_year_status
(year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
VALUES
('1405','garden','open','1405','Garden,Garden_prod',NULL,NULL,'active year',NOW())
ON DUPLICATE KEY UPDATE
  status='open', label='1405',
  source_table='Garden,Garden_prod',
  locked_at=NULL, locked_by=NULL, note='active year', updated_at=NOW();

SELECT year_agri, domain, status, label, source_table
FROM dash_year_status
WHERE year_agri IN ('1404','1405')
  AND domain IN ('agri','vege','garden')
ORDER BY year_agri, domain;
