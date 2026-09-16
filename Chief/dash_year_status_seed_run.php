<?php
/**
 * One-shot seed for dash_year_status (avoids phpMyAdmin file import issues).
 * Open while logged in as dashboard admin:
 *   /Chief/dash_year_status_seed_run.php?confirm=1
 */
header('Content-Type: text/html; charset=utf-8');

$dash_allowed = array('20', '99', '23');
require_once dirname(__FILE__) . '/dash_mgmt_auth.php';

function h($s)
{
    return htmlspecialchars($s . '', ENT_QUOTES, 'UTF-8');
}

if (!isset($_GET['confirm']) || $_GET['confirm'] !== '1') {
    echo '<p>برای ساخت مجدد جدول و داده، این آدرس را باز کنید:</p>';
    echo '<p><a href="?confirm=1"><strong>?confirm=1</strong></a></p>';
    exit;
}

if (!$dbh) {
    echo '<p>DB connection failed.</p>';
    exit;
}

$log = array();
try {
    $dbh->exec('SET NAMES utf8');
    $dbh->exec('DROP TABLE IF EXISTS dash_year_status');
    $log[] = 'DROP OK';

    $sqlCreate = "
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci
";
    $dbh->exec($sqlCreate);
    $log[] = 'CREATE OK';

    $domains = array(
        'agri' => array(
            'open' => array('1404', '1405'),
            'label_mode' => 'range',
            'source' => null
        ),
        'vege' => array(
            'open' => array('1404', '1405'),
            'label_mode' => 'range',
            'source' => 'Vege,Vege_prod'
        ),
        'garden' => array(
            'open' => array('1405'),
            'label_mode' => 'year',
            'source' => 'Garden,Garden_prod'
        ),
        'greenhouse' => array(
            'open' => array('1405'),
            'label_mode' => 'year',
            'source' => 'Greenhous,Greenhous_prod'
        ),
        'mushroom' => array(
            'open' => array('1405'),
            'label_mode' => 'year',
            'source' => 'Mushroom,Mushroom_prod'
        ),
        'bee' => array(
            'open' => array('1405'),
            'label_mode' => 'year',
            'source' => 'bee'
        ),
        'aquatic' => array(
            'open' => array('1405'),
            'label_mode' => 'year',
            'source' => 'Aquatic,Aquatic2'
        )
    );

    $years = $dbh->query("SELECT sal FROM b_sal ORDER BY sal ASC");
    if (!$years) {
        throw new Exception('Cannot read b_sal');
    }
    $salList = $years->fetchAll(PDO::FETCH_COLUMN);
    if (!$salList) {
        throw new Exception('b_sal is empty');
    }

    $ins = $dbh->prepare(
        "INSERT INTO dash_year_status
        (year_agri, domain, status, label, source_table, locked_at, locked_by, note, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())"
    );

    $n = 0;
    foreach ($salList as $sal) {
        $sal = trim($sal . '');
        if ($sal === '') {
            continue;
        }
        $yNext = ((int) $sal) + 1;
        foreach ($domains as $domain => $cfg) {
            $isOpen = in_array($sal, $cfg['open'], true);
            $status = $isOpen ? 'open' : 'locked';
            if ($cfg['label_mode'] === 'range') {
                $label = $sal . '_' . $yNext;
            } else {
                $label = $sal;
            }
            if ($domain === 'agri') {
                $source = 'Agri' . $sal . '_' . $yNext . ',Agri_prod' . $sal . '_' . $yNext;
            } else {
                $source = $cfg['source'];
            }
            $lockedAt = $isOpen ? null : date('Y-m-d H:i:s');
            $lockedBy = $isOpen ? null : 'seed';
            $note = $isOpen ? 'active year' : 'locked year';
            $ok = $ins->execute(array(
                $sal, $domain, $status, $label, $source, $lockedAt, $lockedBy, $note
            ));
            if (!$ok) {
                $err = $ins->errorInfo();
                throw new Exception('INSERT fail: ' . (isset($err[2]) ? $err[2] : 'unknown'));
            }
            $n++;
        }
    }
    $log[] = 'INSERT rows: ' . $n;
} catch (Exception $e) {
    echo '<h1>FAIL</h1><pre>' . h($e->getMessage()) . '</pre>';
    echo '<pre>' . h(implode("\n", $log)) . '</pre>';
    exit;
}

echo '<h1>OK</h1>';
echo '<pre>' . h(implode("\n", $log)) . '</pre>';
echo '<table border="1" cellpadding="6" cellspacing="0">';
echo '<tr><th>year</th><th>domain</th><th>status</th><th>label</th><th>source</th><th>note</th></tr>';
$rows = $dbh->query(
    "SELECT year_agri, domain, status, label, source_table, note
     FROM dash_year_status
     ORDER BY year_agri DESC, domain ASC"
);
foreach ($rows as $r) {
    echo '<tr>';
    echo '<td>' . h($r['year_agri']) . '</td>';
    echo '<td>' . h($r['domain']) . '</td>';
    echo '<td>' . h($r['status']) . '</td>';
    echo '<td>' . h($r['label']) . '</td>';
    echo '<td>' . h($r['source_table']) . '</td>';
    echo '<td>' . h($r['note']) . '</td>';
    echo '</tr>';
}
echo '</table>';
echo '<p>After success, delete this file from server for safety.</p>';
