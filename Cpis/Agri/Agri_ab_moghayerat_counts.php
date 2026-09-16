<?php
require_once('../../lock_cp.php');
require_once(__DIR__ . '/Agri_ab_moghayerat_lib.php');

header('Content-Type: application/json; charset=utf-8');

$kinds = agri_ab_moghayer_kinds();
$z_sal = isset($_POST['z_sal']) ? trim($_POST['z_sal']) : '';
$id_ostan1 = isset($_POST['id_ostan']) ? trim($_POST['id_ostan']) : '';
$moghayer = agri_ab_moghayer_norm_kind(isset($_POST['moghayer']) ? $_POST['moghayer'] : 'ostan_city');
$out = array();

if (agri_ab_moghayer_valid_year($z_sal)) {
    foreach ($kinds as $k => $meta) {
        if ($k === $moghayer || $k === 'mar_prod') {
            continue;
        }
        $out[$k] = agri_ab_moghayer_count($dbh, $k, $z_sal, $id_ostan1);
    }
}

echo json_encode($out);
