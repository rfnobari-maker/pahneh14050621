-- Fix source_table names to match real MySQL tables (ASCII only)
-- Paste in phpMyAdmin SQL tab (do not use Import file)

UPDATE dash_year_status
SET source_table = CONCAT('Agri', year_agri, '_', CAST(year_agri AS UNSIGNED) + 1, ',Agri_prod', year_agri, '_', CAST(year_agri AS UNSIGNED) + 1)
WHERE domain = 'agri';

UPDATE dash_year_status
SET source_table = 'Vege,Vege_prod'
WHERE domain = 'vege';

UPDATE dash_year_status
SET source_table = 'Garden,Garden_prod'
WHERE domain = 'garden';

UPDATE dash_year_status
SET source_table = 'Greenhous,Greenhous_prod'
WHERE domain = 'greenhouse';

UPDATE dash_year_status
SET source_table = 'Mushroom,Mushroom_prod'
WHERE domain = 'mushroom';

UPDATE dash_year_status
SET source_table = 'bee'
WHERE domain = 'bee';

UPDATE dash_year_status
SET source_table = 'Aquatic,Aquatic2'
WHERE domain = 'aquatic';

SELECT year_agri, domain, status, label, source_table
FROM dash_year_status
ORDER BY year_agri DESC, domain;
