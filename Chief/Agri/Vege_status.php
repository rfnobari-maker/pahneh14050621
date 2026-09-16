<?php
include('../../login/config.php');

/**
 * تعیین وضعیت تولید محصول در 5 سال زراعی کامل گذشته (نسخه Vege)
 */
function check_production_status_pdo($dbh, $bah_cod_m, $z_sal, $cod_mah) {
    $parts = explode('-', $z_sal);
    $current_year_start = (count($parts) > 0) ? (int)$parts[0] : (int)date('Y');
    $start_year_check = $current_year_start - 5;
    
    $sql = "
        SELECT COUNT(*) 
        FROM Vege_prod
        WHERE 
            bah_cod_m = :bah_cod_m AND 
            cod_mah = :cod_mah AND 
            SUBSTRING_INDEX(z_sal, '-', 1) >= :start_year_check AND 
            SUBSTRING_INDEX(z_sal, '-', 1) < :current_year_start
    ";
    
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':bah_cod_m', $bah_cod_m);
        $stmt->bindParam(':cod_mah', $cod_mah, PDO::PARAM_INT);
        $stmt->bindParam(':start_year_check', $start_year_check, PDO::PARAM_INT);
        $stmt->bindParam(':current_year_start', $current_year_start, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();
    } catch (PDOException $e) {
        return "<span>Database Error</span>";
    }
    
    if ($count > 0) {
        return '<span style="color: green; font-size: 20px;">●</span>';
    } else {
        return '
        <style>
        @keyframes blinker {
          50% { opacity: 0; }
        }
        .blinking-red {
          color: red; 
          font-size: 20px;
          animation: blinker 1s linear infinite;
        }
        </style>
        <span class="blinking-red">●</span>';
    }
}

/**
 * تعیین وضعیت تولید محصول در 5 سال زراعی کامل گذشته (نسخه Agri)
 */
function check_agri_status_pdo($dbh, $bah_cod_m, $z_sal, $cod_mah) {
    $parts = explode('-', $z_sal);
    $current_year_start = (count($parts) > 0) ? (int)$parts[0] : (int)date('Y');
    $total_count = 0;
    
    for ($i = 1; $i <= 5; $i++) {
        $prev_start_year = $current_year_start - $i;
        $prev_end_year = $prev_start_year + 1;
        $table_name = "Agri_prod" . $prev_start_year . "_" . $prev_end_year;
        
        $sql = "SELECT COUNT(*) FROM {$table_name} WHERE bah_cod_m = :bah_cod_m AND cod_mah = :cod_mah";
        
        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':bah_cod_m', $bah_cod_m);
            $stmt->bindParam(':cod_mah', $cod_mah, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            $total_count += $count;
        } catch (PDOException $e) {
            continue;
        }
        
        if ($total_count > 0) {
            break;
        }
    }
    
    if ($total_count > 0) {
        return '<span style="color: green; font-size: 20px;">●</span>';
    } else {
        return '
        <style>
        @keyframes blinker {
          50% { opacity: 0; }
        }
        .blinking-red {
          color: red; 
          font-size: 20px;
          animation: blinker 1s linear infinite;
        }
        </style>
        <span class="blinking-red">●</span>';
    }
}
?>