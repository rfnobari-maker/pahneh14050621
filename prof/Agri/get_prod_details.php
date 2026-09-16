<?php
include('../../login/config.php');
include('../../event.php'); 

$id = $_POST['id'];
$z_sal = $_POST['z_sal'];
$prod = 'Agri_prod'.str_replace('-','_',$z_sal);
$Agri = 'Agri'.str_replace('-','_',$z_sal);

// ۱. دریافت اطلاعات رکورد فعلی
$stmt = $dbh->prepare("
    SELECT 
        p.*,
        A.m_zamin,
        A.s_ayesh,
        COALESCE(SUM(p2.zer_kesht_a), 0) AS kol_zer_a,
        COALESCE(SUM(p2.zer_kesht_b), 0) AS kol_zer_b
    FROM $prod p
    JOIN $Agri A ON A.id = p.Agri_id
    LEFT JOIN $prod p2 ON p2.Agri_id = p.Agri_id
    WHERE p.id = :id
    GROUP BY p.id, A.m_zamin
");
$stmt->execute(array('id' => $id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// ۲. پیدا کردن کد گروه محصول فعلی از جدول product_z
$stmt_g = $dbh->prepare("SELECT group_cod FROM product_z WHERE product_cod = :p_cod LIMIT 1");
$stmt_g->execute(array('p_cod' => $row['cod_mah']));
$g_info = $stmt_g->fetch(PDO::FETCH_ASSOC);
$row['current_group_cod'] = $g_info ? $g_info['group_cod'] : '';
$row['prod_name'] = mah_name($row['cod_mah']);

// ۳. ساخت لیست گروه‌ها برای نمایش در Select (دقیقاً مشابه ساختار مدنظر شما)
$query_groups = "SELECT DISTINCT group_cod, group_name FROM `product_z` ORDER BY group_name";
$stmt_list = $dbh->prepare($query_groups);
$stmt_list->execute();
$group_html = '<option value="">انتخاب گروه</option>';
foreach($stmt_list as $g_item){
    $selected = ($g_item['group_cod'] == $row['current_group_cod']) ? 'selected' : '';
    $group_html .= '<option value="'.$g_item['group_cod'].'" '.$selected.'>'.$g_item['group_name'].'</option>';
}
$row['group_list_html'] = $group_html;

echo json_encode($row);
?>