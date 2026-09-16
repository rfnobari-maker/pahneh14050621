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
    // ✅ تغییر: خواندن mah_tolp هم از سال قبل
    $stmt_old = $dbh->prepare("SELECT id, cod_qroup, cod_mah, s_kesht_b, s_kesht_gb, tree_b, tree_gb,
                                      mah_tolp, mah_tol, mah_bem, mah_kh
                               FROM `Garden_prod` WHERE Garden_id = :id_old ORDER BY id");
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
            // ✅ این مقادیر برای پیش‌پر کردن جدول اصلی استفاده می‌شوند
            'old_mah_tolp' => (float)$prod['mah_tolp'],
            'old_mah_tol'  => (float)$prod['mah_tol'],
            'old_mah_bem'  => $prod['mah_bem'],
            'old_mah_kh'   => $prod['mah_kh'],
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

// ❌ بلوک transfer کاملاً حذف شد — انتقال سمت کلاینت انجام می‌شود

last_year_json(array('ok' => false, 'message' => 'عملیات نامعتبر است.', 'has_old' => false, 'items' => array()));
?>