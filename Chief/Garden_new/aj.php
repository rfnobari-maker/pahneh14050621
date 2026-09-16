<?php
include('../../event.php');

switch ($_POST['op']) {
    case 'check_mah_tol':
        $mcod = $_POST['mcod'];
        $skb = $_POST['skb'];
        $mtol = $_POST['mtol'];
        $no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '1';
        
        $mt = mht_b($mcod, $skb, $no_kesh);
        
        if ($mtol > $mt)
            echo $mt;
        else
            echo 'true';
        break;
    
    case 'check_mah_tol_garden':
        $mcod = $_POST['mcod'];
        $skb = $_POST['skb'];
        $mtol = $_POST['mtol'];
        $no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '1';
        
        $mt = mht_b($mcod, $skb, $no_kesh);
        
        if ($mtol > $mt)
            echo number_format($mt, 2);
        else
            echo 'true';
        break;
    
    case 'check_mah_tol_edit':
        $mcod = $_POST['mcod'];
        $skb = $_POST['skb'];
        $mtol = $_POST['mtol'];
        $no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '1';
        $current_id = isset($_POST['current_id']) ? intval($_POST['current_id']) : 0;
        
        $mt = mht_b($mcod, $skb, $no_kesh);
        
        if ($mtol > $mt)
            echo number_format($mt, 2);
        else
            echo 'true';
        break;
    
    default:
        echo 'خطا: عملیات نامعتبر';
        break;
}
?>