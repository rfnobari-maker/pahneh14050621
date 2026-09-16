<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');
require_once('../../Jalali.php');
require_once('CropValidationService.php');

date_default_timezone_set('Asia/Tehran');
header('Content-Type: application/json; charset=utf-8');

function last_year_json($data) {
    echo json_encode($data);
    exit;
}

function last_year_load_garden($dbh, $garden_id) {
    $stmt = $dbh->prepare("SELECT id, id_old, z_sal, nah_kesh, no_kesh, m_zamin, id_ostan, id_city, id_mar, num_bah, sh_gat, add_abadi, add_city, bah_cod_m FROM `Garden` WHERE id = :id LIMIT 1");
    $stmt->bindValue(':id', intval($garden_id), PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function last_year_existing_codes($dbh, $garden_id) {
    $codes = array();
    $stmt = $dbh->prepare("SELECT cod_mah FROM `Garden_prod` WHERE Garden_id = :gid");
    $stmt->bindValue(':gid', intval($garden_id), PDO::PARAM_INT);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $codes[$row['cod_mah']] = true;
    }
    return $codes;
}

function last_year_current_area($dbh, $garden_id) {
    $stmt = $dbh->prepare("SELECT SUM(s_kesht_b + s_kesht_gb) AS total_area FROM `Garden_prod` WHERE Garden_id = :gid");
    $stmt->bindValue(':gid', intval($garden_id), PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return (float)$row['total_area'];
}

function last_year_product_name($dbh, $product_code) {
    if (function_exists('mah_name_bagh')) {
        $name = mah_name_bagh($product_code);
        if ($name !== null && $name !== '') {
            return $name;
        }
    }
    $stmt = $dbh->prepare("SELECT product_name FROM `product_b` WHERE product_cod = :cod LIMIT 1");
    $stmt->bindValue(':cod', $product_code);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['product_name'] : $product_code;
}

function last_year_group_name($dbh, $group_code) {
    $stmt = $dbh->prepare("SELECT group_name FROM `product_b` WHERE group_cod = :cod LIMIT 1");
    $stmt->bindValue(':cod', $group_code);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['group_name'] : $group_code;
}

function last_year_evaluate($validationService, $garden, $prod, $existing_codes, $claimed_codes, $used_area) {
    $cod = $prod['cod_mah'];
    $result = array('can_transfer' => false, 'status' => '');

    if (isset($existing_codes[$cod]) || isset($claimed_codes[$cod])) {
        $result['status'] = 'این محصول در این قطعه فقط یک‌بار قابل ثبت است.';
        return $result;
    }

    $s_bar = (float)$prod['s_kesht_b'];
    $s_nobar = (float)$prod['s_kesht_gb'];
    $tree_b = (float)$prod['tree_b'];
    $tree_gb = (float)$prod['tree_gb'];

    if ($garden['nah_kesh'] == '3') {
        $s_bar = 0;
        $s_nobar = 0;
        if ($tree_b == 0 && $tree_gb == 0) {
            $result['status'] = 'در نحوه کشت درختان پراکنده ثبت محصول بدون تعداد درخت مجاز نیست.';
            return $result;
        }
        $patternCheck = $validationService->validateProductExistsInAllocation(
            $cod,
            $garden['z_sal'],
            $garden['id_ostan'],
            $garden['id_city'],
            $garden['id_mar']
        );
        if (!$patternCheck['isValid']) {
            $result['status'] = $patternCheck['message'];
            return $result;
        }
        $result['can_transfer'] = true;
        $result['status'] = 'قابل انتقال';
        return $result;
    }

    if ($s_bar == 0 && $s_nobar == 0 && $tree_b == 0 && $tree_gb == 0) {
        $result['status'] = 'ثبت محصول بدون سطح کشت و تعداد درخت مجاز نیست.';
        return $result;
    }
    if ($s_bar <= 0 && $tree_b > 0) {
        $result['status'] = 'امکان ثبت تعداد درخت بارور بدون ثبت سطح کشت بارور وجود ندارد.';
        return $result;
    }
    if ($s_nobar <= 0 && $tree_gb > 0) {
        $result['status'] = 'امکان ثبت تعداد درخت غیربارور بدون ثبت سطح کشت غیربارور وجود ندارد.';
        return $result;
    }

    $row_area = $s_bar + $s_nobar;
    if (($used_area + $row_area) > ((float)$garden['m_zamin'] + 0.00001)) {
        $result['status'] = 'از تراز مساحت این قطعه بیشتر است.';
        return $result;
    }

    $alloc = $validationService->validateCultivatedAreaAgainstAllocation(
        null,
        $garden['id'],
        $cod,
        $s_bar,
        $s_nobar,
        $garden['z_sal'],
        $garden['id_ostan'],
        $garden['id_city'],
        $garden['id_mar'],
        $garden['no_kesh'],
        0,
        0
    );
    if (!$alloc['isValid']) {
        $result['status'] = $alloc['message'];
        return $result;
    }

    $result['can_transfer'] = true;
    $result['status'] = 'قابل انتقال';
    return $result;
}

$op = isset($_POST['op']) ? $_POST['op'] : '';
$garden_id = isset($_POST['garden_id']) ? intval($_POST['garden_id']) : 0;

if ($garden_id <= 0) {
    last_year_json(array('ok' => false, 'message' => 'شناسه قطعه نامعتبر است.', 'has_old' => false, 'items' => array()));
}

$garden = last_year_load_garden($dbh, $garden_id);
if (!$garden) {
    last_year_json(array('ok' => false, 'message' => 'قطعه یافت نشد.', 'has_old' => false, 'items' => array()));
}

$id_old = isset($garden['id_old']) ? intval($garden['id_old']) : 0;
if ($id_old <= 0) {
    last_year_json(array('ok' => true, 'has_old' => false, 'items' => array(), 'message' => ''));
}

$validationService = new CropValidationService($dbh);

if ($op == 'list') {
    $stmt_old = $dbh->prepare("SELECT id, cod_qroup, cod_mah, s_kesht_b, s_kesht_gb, tree_b, tree_gb FROM `Garden_prod` WHERE Garden_id = :id_old ORDER BY id");
    $stmt_old->bindValue(':id_old', $id_old, PDO::PARAM_INT);
    $stmt_old->execute();
    $old_rows = $stmt_old->fetchAll(PDO::FETCH_ASSOC);

    $existing_codes = last_year_existing_codes($dbh, $garden_id);
    $claimed_codes = array();
    $used_area = last_year_current_area($dbh, $garden_id);
    $items = array();

    foreach ($old_rows as $prod) {
        $eval = last_year_evaluate($validationService, $garden, $prod, $existing_codes, $claimed_codes, $used_area);
        if ($eval['can_transfer']) {
            $claimed_codes[$prod['cod_mah']] = true;
            if ($garden['nah_kesh'] != '3') {
                $used_area += (float)$prod['s_kesht_b'] + (float)$prod['s_kesht_gb'];
            }
        }
        $s_bar = ($garden['nah_kesh'] == '3') ? 0 : (float)$prod['s_kesht_b'];
        $s_nobar = ($garden['nah_kesh'] == '3') ? 0 : (float)$prod['s_kesht_gb'];
        $items[] = array(
            'id' => (int)$prod['id'],
            'cod_qroup' => $prod['cod_qroup'],
            'cod_mah' => $prod['cod_mah'],
            'group_name' => last_year_group_name($dbh, $prod['cod_qroup']),
            'product_name' => last_year_product_name($dbh, $prod['cod_mah']),
            's_kesht_b' => $s_bar,
            's_kesht_gb' => $s_nobar,
            'tree_b' => (float)$prod['tree_b'],
            'tree_gb' => (float)$prod['tree_gb'],
            'can_transfer' => $eval['can_transfer'] ? 1 : 0,
            'status' => $eval['status']
        );
    }

    last_year_json(array(
        'ok' => true,
        'has_old' => (count($items) > 0),
        'items' => $items,
        'message' => ''
    ));
}

if ($op == 'transfer') {
    $prod_ids = isset($_POST['prod_ids']) ? $_POST['prod_ids'] : array();
    if (!is_array($prod_ids)) {
        $prod_ids = array($prod_ids);
    }
    $clean_ids = array();
    foreach ($prod_ids as $pid) {
        $pid = intval($pid);
        if ($pid > 0) {
            $clean_ids[$pid] = $pid;
        }
    }
    $clean_ids = array_values($clean_ids);

    if (empty($clean_ids)) {
        last_year_json(array('ok' => false, 'message' => 'محصولی برای انتقال انتخاب نشده است.', 'transferred' => 0));
    }

    $date_edit = jdate("Y/m/d");
    $time = date('H:i:s');
    $existing_codes = last_year_existing_codes($dbh, $garden_id);
    $claimed_codes = array();
    $used_area = last_year_current_area($dbh, $garden_id);
    $errors = array();
    $to_insert = array();

    foreach ($clean_ids as $pid) {
        $stmt_p = $dbh->prepare("SELECT id, cod_qroup, cod_mah, s_kesht_b, s_kesht_gb, tree_b, tree_gb FROM `Garden_prod` WHERE id = :id AND Garden_id = :id_old LIMIT 1");
        $stmt_p->execute(array(':id' => $pid, ':id_old' => $id_old));
        $prod = $stmt_p->fetch(PDO::FETCH_ASSOC);
        if (!$prod) {
            $errors[] = 'یکی از ردیف‌های سال قبل متعلق به این قطعه نیست.';
            continue;
        }

        $eval = last_year_evaluate($validationService, $garden, $prod, $existing_codes, $claimed_codes, $used_area);
        if (!$eval['can_transfer']) {
            $errors[] = last_year_product_name($dbh, $prod['cod_mah']) . ': ' . $eval['status'];
            continue;
        }

        $claimed_codes[$prod['cod_mah']] = true;
        $s_bar = ($garden['nah_kesh'] == '3') ? 0 : (float)$prod['s_kesht_b'];
        $s_nobar = ($garden['nah_kesh'] == '3') ? 0 : (float)$prod['s_kesht_gb'];
        if ($garden['nah_kesh'] != '3') {
            $used_area += $s_bar + $s_nobar;
        }

        $to_insert[] = array(
            'cod_qroup' => $prod['cod_qroup'],
            'cod_mah' => $prod['cod_mah'],
            's_kesht_b' => $s_bar,
            's_kesht_gb' => $s_nobar,
            'tree_b' => (float)$prod['tree_b'],
            'tree_gb' => (float)$prod['tree_gb']
        );
    }

    if (empty($to_insert)) {
        last_year_json(array(
            'ok' => false,
            'message' => empty($errors) ? 'محصول قابل انتقالی یافت نشد.' : implode("\n", $errors),
            'transferred' => 0
        ));
    }

    try {
        $dbh->beginTransaction();

        $insert_sql = 'INSERT INTO `Garden_prod`
            (date_s, cod_qroup, cod_mah, s_kesht_b, s_kesht_gb, tree_b, tree_gb,
             mah_tolp, mah_tol, mah_bem, mah_kh, id_mar, Garden_id, mor_cod_m,
             no_kesh, nah_kesh, id_ostan, id_city, num_bah, sh_gat, z_sal,
             add_abadi, add_city, bah_cod_m, Garden_id_old)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $ins = $dbh->prepare($insert_sql);

        foreach ($to_insert as $row) {
            $ins->execute(array(
                $date_edit,
                $row['cod_qroup'],
                $row['cod_mah'],
                $row['s_kesht_b'],
                $row['s_kesht_gb'],
                $row['tree_b'],
                $row['tree_gb'],
                0,
                0,
                '2',
                '2',
                $garden['id_mar'],
                (int)$garden['id'],
                $login_session,
                $garden['no_kesh'],
                $garden['nah_kesh'],
                $garden['id_ostan'],
                $garden['id_city'],
                $garden['num_bah'],
                $garden['sh_gat'],
                $garden['z_sal'],
                $garden['add_abadi'],
                $garden['add_city'],
                $garden['bah_cod_m'],
                $id_old
            ));
        }

        $updateQuery = "UPDATE `Garden`
                        SET t_mah = (SELECT COUNT(*) FROM `Garden_prod` WHERE Garden_id = :garden_id_subquery),
                            date_s = :date_s_update
                        WHERE id = :id_update";
        $updateStmt = $dbh->prepare($updateQuery);
        $updateStmt->execute(array(
            ':garden_id_subquery' => $garden['id'],
            ':date_s_update' => $date_edit,
            ':id_update' => $garden['id']
        ));

        sabt_event(
            $login_session,
            $_SERVER['REMOTE_ADDR'],
            $date_edit,
            $time,
            $garden['add_abadi'],
            'انتقال محصول باغی از سال قبل /' . $garden['z_sal'] . '/' . $garden['sh_gat'] . '/' . $garden['bah_cod_m'] . ' (شامل ' . count($to_insert) . ' محصول)',
            $garden['id_ostan']
        );

        $dbh->commit();

        $msg = 'اطلاعات ' . count($to_insert) . ' محصول از سال قبل منتقل شد.';
        if (!empty($errors)) {
            $msg .= "\n" . implode("\n", $errors);
        }

        last_year_json(array(
            'ok' => true,
            'message' => $msg,
            'transferred' => count($to_insert)
        ));
    } catch (PDOException $e) {
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
        }
        last_year_json(array(
            'ok' => false,
            'message' => 'خطا در انتقال: ' . $e->getMessage(),
            'transferred' => 0
        ));
    }
}

last_year_json(array('ok' => false, 'message' => 'عملیات نامعتبر است.', 'has_old' => false, 'items' => array()));
?>
