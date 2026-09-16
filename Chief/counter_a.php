<?php
include ('../lock_ce.php');
include('../login/config.php');

date_default_timezone_set('Asia/Tehran');
$v_date = date("Y-m-d", strtotime('-120 days'));
if (strtotime($date_pas) < strtotime($v_date)) {
    header("Location:expaire_pass.php");
}
?>
<script type="text/javascript">
var ray={
    ajax:function(st) {
        this.show('load');
    },
    show:function(el) {
        this.getID(el).style.display='';
    },
    getID:function(el) {
        return document.getElementById(el);
    }
}
</script>
<style type="text/css">
#load{
    position:absolute;
    z-index:1;
    margin-top:-150px;
    margin-left:-150px;
    top:50%;
    left:50%;
}
</style>
<div id="load" style="display:none;"><img src="../files/ajax_loader_red_512.gif" width="204" height="204"  alt=""/></div>

<?php
function get_province_counts() {
    global $dbh;
    $counts = array();

    // Combine all count queries into one set of efficient queries
    $queries = array(
        'benef_count' => "SELECT id_ostan, COUNT(*) AS count FROM bah WHERE ok = '1' GROUP BY id_ostan",
        'abadi_count' => "SELECT id_ostan, COUNT(*) AS count FROM list_abadi GROUP BY id_ostan",
        'shahr_count' => "SELECT id_ostan, COUNT(*) AS count FROM list_city GROUP BY id_ostan",
        'mor_count' => "SELECT id_ostan, COUNT(*) AS count FROM users WHERE S_access = '1' GROUP BY id_ostan",
        'mar_count' => "SELECT id_ostan, COUNT(*) AS count FROM mar GROUP BY id_ostan",
        'city_count' => "SELECT id_ostan, COUNT(*) AS count FROM cityname GROUP BY id_ostan"
    );

    foreach ($queries as $key => $sql) {
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ostan_id = $row['id_ostan'];
            if (!isset($counts[$ostan_id])) {
                $counts[$ostan_id] = array();
            }
            $counts[$ostan_id][$key] = $row['count'];
        }
    }
    return $counts;
}

function mor_count() {
    global $dbh;
    $query = "SELECT count(*)  FROM  users WHERE  S_access = '1'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function abadi_count() {
    global $dbh;
    $query = "SELECT count(*) FROM  list_abadi";
    $result = $dbh->prepare($query);
    $result->execute();
    return $result->fetchColumn();
}

function totl_shahr_count() {
    global $dbh;
    $query = "SELECT count(*) FROM  list_city";
    $result = $dbh->prepare($query);
    $result->execute();
    return $result->fetchColumn();
}

function totl_mar_count() {
    global $dbh;
    $query = "SELECT count(*) FROM mar";
    $result = $dbh->prepare($query);
    $result->execute();
    return $result->fetchColumn();
}

function kol_city_count() {
    global $dbh;
    $query = "SELECT  count(*)  FROM cityname";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function kol_bah_count() {
    global $dbh;
    $query = "SELECT count(*) FROM bah WHERE ok = '1'";
    $result = $dbh->prepare($query);
    $result->execute();
    return $result->fetchColumn();
}

function ostan_abadi_update_per($id_ostan) {
    global $dbh;
    $query_update = "SELECT count(*) FROM list_abadi JOIN public_abadi4 ON public_abadi4.add_abadi = list_abadi.add_abadi WHERE public_abadi4.id_ostan = :id_ostan AND public_abadi4.up_date <> ''";
    $stmt_update = $dbh->prepare($query_update);
    $stmt_update->bindParam(':id_ostan', $id_ostan);
    $stmt_update->execute();
    $count_update = $stmt_update->fetchColumn();

    $query_total = "SELECT count(*) FROM list_abadi WHERE id_ostan = :id_ostan";
    $stmt_total = $dbh->prepare($query_total);
    $stmt_total->bindParam(':id_ostan', $id_ostan);
    $stmt_total->execute();
    $count_kol = $stmt_total->fetchColumn();

    if ($count_kol > 0) {
        return round(($count_update * 100) / $count_kol, 1);
    }
    return 0;
}
?>