<?php
include('login/config.php');
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
//
function check_bah_cod_m($bah_cod_m) {
    global $dbh;
    
    $query = "SELECT ok FROM bah WHERE bah_cod_m = :bah_cod_m";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m' => $bah_cod_m));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$row) {
        return 0; // بهره‌بردار یافت نشد
    }
    
    $ok = $row['ok'];
    
    if ($ok == '2') {
        return 2; // فوت شده
    }
    if ($ok == '4') {
        return 4; // تایید نشده
    }
    
    return 1; // مجاز
}
//
function getUserIP_1() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // حذف پورت در صورت وجود
    $ipParts = explode(':', $ip);
    return $ipParts[0];
}
//
    // zeratid = "0"; baghid = "1"; shilatid = "2"; golkhaneid = "3"; sabziid = "4"; gharchid = "5";

/**
 * بررسی مجوز حذف/ویرایش از طریق وب‌سرویس
 *
 * @param int $id شناسه منطقه (AreaID)
 * @param string $type نوع فعالیت (مثلاً "0" برای زراعت، "1" برای باغبانی و غیره)
 * @param int $year سال مورد نظر (مثلاً 1404)
 * @return int نتیجه مجوز:
 * -1: خطای ارتباط یا خطای Soap (وب‌سرویس در دسترس نیست)
 * 0: عدم مجوز (اگر وب‌سرویس 0 برگرداند)
 * 1: دارای مجوز (اگر وب‌سرویس 1 برگرداند)
 * سایر مقادیر: نتیجه برگشتی از وب‌سرویس
 */
function check_payesh($id, $type, $year)
{
	// بررسی شرط ویژه برای id مورد نظر
    if ($id == 3741675) {
        return 2;
    }
	
    $webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
    $Username = "test";
    $Password = "test";

    // مقدار پیش‌فرض: -1 به معنی خطای وب‌سرویس/ارتباط (برای تمایز با نتیجه مجاز 0)
    $chech_result = -1; 
    
    // اطمینان از نصب بودن افزونه SOAP
    if (!class_exists('SoapClient')) {
        error_log("SOAP extension is not installed.");
        return $chech_result;
    }

    try {
        // افزایش connection_timeout برای جلوگیری از قطع ارتباط سریع
        $client = new SoapClient($webservice_url, array(
            'connection_timeout' => 5, // افزایش زمان انتظار به 20 ثانیه
            'trace' => 1 // برای دیباگ کردن در صورت نیاز
        ));

        $res = $client->CheckEditorDeletePermission(array(
            "Username" => $Username,
            "Password" => $Password,
            "type" => $type,
            "year" => $year,
            "AreaID" => $id
        ));

        // بررسی وجود نتیجه در ساختار مورد انتظار (توجه به حساسیت حروف)
        if (isset($res->CheckEditorDeletePermissionResult->EditPermission)) {
            // وب‌سرویس با موفقیت پاسخ داده است، نتیجه آن را ثبت می‌کنیم
            $chech_result = (int)$res->CheckEditorDeletePermissionResult->EditPermission;
        } else {
            // اگر ارتباط برقرار شد اما ساختار پاسخ غیرمنتظره بود (ممکن است به معنی عدم مجوز یا مشکل داخلی وب‌سرویس باشد)
            $chech_result = 0;
            error_log("SOAP Success, but unexpected response structure for CheckEditorDeletePermission.");
        }

    } catch (SoapFault $e) {
        // خطاهای مربوط به SOAP (مثل مشکل در WSDL، زمان‌بندی یا عدم دسترسی به وب‌سرویس)
        error_log("SOAP Fault: " . $e->getMessage() . " | Request: " . (isset($client) ? $client->__getLastRequest() : 'N/A'));
        $chech_result = -1; 
    } catch (Exception $e) {
        // سایر خطاهای عمومی (مثل خطای شبکه یا مشکلات داخلی PHP)
        error_log("General Error: " . $e->getMessage());
        $chech_result = -1;
    }

    // مقدار نهایی (نتیجه وب‌سرویس یا -1 به ازای خطا) برگردانده می‌شود
    return $chech_result;
}
function check_payesh_1($id, $type, $year)
{
    // The web service is currently experiencing issues and causing the system to hang.
    // As a temporary fix, we're bypassing the web service call and
    // returning '2' directly to prevent the system from hanging.
    // This value '2' is a placeholder for a successful permission check
    // until the web service is restored.
    return 1;
}

//
function check_id($id)
{
$webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
$Username = "test";
$Password = "test";
$type= 0 ; 
$year= 1404 ;

	$client = new SoapClient($webservice_url);
	$res = $client->CheckEditorDeletePermission(array(
	 "Username"   => $Username ,
	 "Password"   => $Password ,
	 "type" => $type ,
     "year" => $year ,
	 "AreaID" => $id));
	$chech_result = $res->CheckEditorDeletePermissionResult->EditPermission ;
	return $chech_result  ; 
}
function check_product($id)
{
$webservice_url = "http://172.17.18.14/pahne/pahneservice.asmx?WSDL";
$Username = "test";
$Password = "test";
$type= 0 ; 
$year= 1404 ;

	$client = new SoapClient($webservice_url);
	$res = $client->CheckEditorDeletePermission(array(
	 "Username"   => $Username ,
	 "Password"   => $Password ,
	 "type" => $type ,
     "year" => $year ,
	 "AreaID" => $id));
	$chech_result = $res->CheckEditorDeletePermissionResult->product ;
	return $chech_result  ; 
}
function center_username($id_ostan,$id_mar)
{
global $dbh; 
$query = "SELECT username from users where id_ostan = '$id_ostan' and id_mar = '$id_mar' and S_Access = '2'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['username'] ;
// clos conntection 

}

function Abadi_tbah_count($add_abadi)
{
global $dbh; 
 $query = "SELECT count(*) from bah where add_abadi = '$add_abadi'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
 function Abadi_agri_count($add_abadi,$table)
{
global $dbh; 
 $query = "SELECT count(*) from $table where add_abadi = '$add_abadi'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function Abadi_vege_count($add_abadi,$sal)
{
global $dbh; 
 $query = "SELECT count(*) from Vege where add_abadi = '$add_abadi'  and z_sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}

function Abadi_garden_count($add_abadi,$sal)
{
global $dbh; 
 $query = "SELECT count(*) from Garden where add_abadi = '$add_abadi'  and z_sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function Abadi_Mushroom_count($add_abadi,$sal)
{
global $dbh; 
 $query = "SELECT count(*) from Mushroom_prod where add_abadi = '$add_abadi'  and y_prod = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function Abadi_Greenhous_count($add_abadi,$y_prod)
{
global $dbh; 
 $query = "SELECT count(*) from Greenhous_prod where add_abadi = '$add_abadi'  and y_prod = '$y_prod' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function Abadi_bee_count($add_abadi,$sal)
{
global $dbh; 
  $query = "SELECT count(*) from bee where add_abadi = '$add_abadi'  and sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function Abadi_Aquatic_count($add_abadi,$sal)
{
global $dbh; 
 $query = "SELECT count(*) from Aquatic where add_abadi = '$add_abadi'  and sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}

// شمارش تعداد روزهای کشتار
function slau_for_day($for_days){
	require_once('Jalali.php');
	global $dbh; 
	$sql = "DELETE FROM samasat_for_day WHERE 1";
    $stmt =  $dbh->prepare($sql);
    $stmt->bindParam( PDO::PARAM_INT);   
    $stmt->execute();
	
$xy = 1;
do {
 $date_check_E =  date('Y-m-d',time()+($xy*86400)) ;
 $date_check_F =  jdate('Y/m/d',time()+($xy*86400)) ;
 $date_check_name_E =  date('l',time()+($xy*86400)) ;
 $date_check_name_F =  jdate('l',time()+($xy*86400)) ;
$query = "INSERT INTO samasat_for_day(date_check_E,date_check_F,date_check_name_E,date_check_name_F) 
           VALUES (:date_check_E,:date_check_F,:date_check_name_E,:date_check_name_F)";
    $q = $dbh->prepare($query);
    $q->execute(array(':date_check_E'=>$date_check_E,':date_check_F'=>$date_check_F,':date_check_name_E'=>$date_check_name_E,':date_check_name_F'=>$date_check_name_F));
	  $xy++;
} while ($xy <= $for_days+10); // 10 روز اضافه کردم که بعد بتونم 5 شنبه ها را راحت حذف کنم
$date_check_name_E = 'Thursday'	; // 5 شنبه ها را حذف میکنه
$sql = "DELETE FROM samasat_for_day WHERE date_check_name_E =  :date_check_name_E";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':date_check_name_E', $date_check_name_E, PDO::PARAM_INT);   
$stmt->execute();

$query = "SELECT * from samasat_for_day";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_row = $stmt -> rowCount(); // تعداد موجود را شمارش میکنه 
$limit = $count_row-$for_days ;  // محاسبه محدودیت 
	$sql = "DELETE FROM samasat_for_day WHERE 1 order by date_check_E DESC limit $limit "; // تعداد روز های اضافه را حذف میکنه
    $stmt =  $dbh->prepare($sql);
    $stmt->bindParam( PDO::PARAM_INT);   
    $stmt->execute();

$query = "SELECT date_check_E from samasat_for_day where 1   " ; // محاسبه تفاوت هر روز با روز جاری 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$time2 = $row['date_check_E'] ; 
$time1 = date("Y-m-d");
  $x_days = strtotime($time2) - strtotime($time1);
  $x_days = round($x_days / 86400,0,1);
$query = "UPDATE samasat_for_day SET x_days = $x_days  where date_check_E = '$time2' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
}

 $query = "SELECT max(x_days) as diff  FROM samasat_for_day  WHERE 1 ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$diff= $row['diff'] ; 
return $diff ;  // محاسبه کل روز ها 


}

// سن گله به روز 
function age_day($date){
require_once('Jalali.php');
$time2 = date("Y/m/d");
$arr_parts = explode('/', $date);
 $jYear  = $arr_parts[0];
 $jMonth = $arr_parts[1];
 $jDay   = $arr_parts[2];
 $time1   = jalali_to_gregorian($jYear, $jMonth, $jDay);
 $time3 = $time1[0].'-'.$time1[1].'-'.$time1[2] ; 
    $diff = strtotime($time2) - strtotime($time3);
    return round($diff / 86400,0,1);
}
// تاریخ آخرین بازدید
function last_log($username)
{
global $dbh; 
$query = "SELECT max(date) as last_log from Last_user WHERE PersCode = '$username' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$last_login = $row['last_log'] ; 
return $last_login ;

}
// استعلام کد محصول  از خرید تضمینی 
function e_cod_mah($bah_cod_m,$id_ostan,$id_city,$num_bah,$cod_mah)
{
global $dbh; 
$query = "SELECT count(*) from Agri_prod1399 WHERE
 bah_cod_m = '$bah_cod_m' and 
 id_ostan  = '$id_ostan'  and
 id_city   = '$id_city'   and 
 num_bah   = '$num_bah'   and 
 cod_mah   = '$cod_mah'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$e_result = $stmt->fetchColumn();
return $e_result ;

}
function kol_zk_108($bah_cod_m,$id_ostan,$num_bah)
{
global $dbh; 
$query = "SELECT (sum(zer_kesht_a)+sum(zer_kesht_b)) as kol_zk FROM Agri_prod WHERE 
  cod_mah = '108' AND z_sal = '1395-1396' and id_ostan = '$id_ostan' and bah_cod_m = '$bah_cod_m'
  and num_bah = '$num_bah'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['kol_zk'] ;

}
function kol_pt_108($bah_cod_m,$id_ostan,$num_bah)
{
global $dbh; 
$query = "SELECT sum(mah_tolp) as kol_pt FROM Agri_prod WHERE 
  cod_mah = '108' AND z_sal = '1395-1396' and id_ostan = '$id_ostan' and bah_cod_m = '$bah_cod_m'
 and num_bah = '$num_bah'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['kol_pt'] ;

}
function edit_180($date_s,$bah_cod_m)
{
global $dbh; 
$query = "UPDATE Agri_prod SET date_s = '$date_s' WHERE z_sal = '1395-1396' and bah_cod_m = '$bah_cod_m' and cod_mah = '108'";
$q = $dbh->prepare($query);
$q->execute();

}
function edit_180_1($date_s,$bah_cod_m)
{
global $dbh; 
$query = "UPDATE Agri_prod SET date_s = '$date_s' WHERE z_sal = '1395-1396' and bah_cod_m = '$bah_cod_m' and cod_mah = '108'";
$q = $dbh->prepare($query);
$q->execute();

}
function bank_account5($bah_cod_m,$num_bah)
{
global $dbh; 
$query = "SELECT bank_account from bah where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['bank_account'] ;
// clos conntection 

}
function bah_fname($bah_cod_m)
{
global $dbh; 
$query = "SELECT fname from bah where bah_cod_m = '$bah_cod_m'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['fname'] ;
// clos conntection 

}
function bah_name2($bah_cod_m,$num_bah)
{
global $dbh; 
$query = "SELECT name,Last_name from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['Last_name'].'&nbsp;'.$row['name']; 
// clos conntection 

}
function bah_vaz($bah_cod_m)
{
global $dbh; 
$query = "SELECT ok from bah where bah_cod_m = '$bah_cod_m'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['ok']; 
// clos conntection 

}

function m_name($m_cod_m)
{
global $dbh; 
$query = "SELECT m_name,m_last_name from malek where m_cod_m = '$m_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['m_last_name'].'&nbsp;'.$row['m_name']; 
// clos conntection 

}

function abadi_name($add_abadi)
{
global $dbh; 
$query = "SELECT abadi,add_abadi from list_abadi where add_abadi = '$add_abadi' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['abadi'];
// clos conntection 

}
function abadi_name_id($id_abadi)
{
global $dbh; 
$query = "SELECT abadi from public_abadi4 where id_abadi = '$id_abadi' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['abadi'];
// clos conntection 

}
function bakh_name($id_ostan,$id_city,$id_bakh)
{
global $dbh; 
$query = "SELECT bakh from bakhname where id_ostan='$id_ostan' and id_city='$id_city' and id_bakh='$id_bakh' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['bakh'];
// clos conntection 

}

function city_name1($id_city,$id_ostan)
{
global $dbh; 
$query = "SELECT city from cityname  where id_city = '$id_city' and id_ostan = '$id_ostan' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['city']; 
// clos conntection 

}
function sabt_event($username,$ip,$date,$time,$add_abadi,$verb,$id_ostan) {
global $dbh; 
$query = "INSERT INTO log (username,ip,date,time,add_abadi,verb,id_ostan) VALUES (:username,:ip,:date,:time,:add_abadi,:verb,:id_ostan)";
$q = $dbh->prepare($query);
$q->execute(array(':username'=>$username,':ip'=>$ip,':date'=>$date,':time'=>$time,':add_abadi'=>$add_abadi,':verb'=>$verb,
':id_ostan'=>$id_ostan));
// clos conntection 

}
function user_name($username)
{
global $dbh; 
$query = "SELECT name,Last_name from users where username = '$username' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['Last_name'].'-'.$row['name']; 
// clos conntection 

}
function user_name1($cod_m)
{
global $dbh; 
$query = "SELECT name,Last_name from users where cod_m = '$cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['Last_name'].'&nbsp;'.$row['name']; 
// clos conntection 

}
function user_tel($username)
{
global $dbh; 
$query = "SELECT tel_m from users where username = '$username' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['tel_m']; 
// clos conntection 

}
function bah_name($bah_cod_m)
{
global $dbh; 
$query = "SELECT name,Last_name from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['Last_name'].'&nbsp;'.$row['name']; 
// clos conntection 

}
function bah_first_name($bah_cod_m)
{
global $dbh; 
$query = "SELECT name from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['name']; 
// clos conntection 

}
function bah_last_name($bah_cod_m)
{
global $dbh; 
$query = "SELECT Last_name from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['Last_name']; 
// clos conntection 

}

function user_pic($username)
{
global $dbh; 
$query = "SELECT pic from users where username = '$username' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$pic_name = isset($row['pic']) && $row['pic'] !== '' ? $row['pic'] : 'no_pic.png';
return $pic_name ; 

}
function shahr_name($add_city)
{
global $dbh; 
$query = "SELECT shahr from list_city where add_city = '$add_city' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['shahr']; 
// clos conntection 

}
function ostan_name($id_ostan)
{
global $dbh; 
$query = "SELECT ostan from ostanname where id_ostan = '$id_ostan' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['ostan']; 

}
function mar_name($id_mar)
{
global $dbh; 
$query = "SELECT mar from mar where id_mar = '$id_mar' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['mar']; 
// clos conntection 

}
function mar_name1($id_mar,$id_ostan)
{
global $dbh; 
$query = "SELECT mar from mar where id_ostan ='$id_ostan' and id_mar = '$id_mar' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['mar']; 
// clos conntection 

}
function alert($string)
{
    static $assets_sent = false;
    if (!$assets_sent) {
        $assets_sent = true;
        echo <<<'PAHNEH_ALERT'
<style id="pahneh-alert-style">
.pahneh-alert-overlay{position:fixed;inset:0;z-index:100000;display:none;align-items:center;justify-content:center;padding:16px;background:rgba(15,23,42,.55);font-family:myfont,Tahoma,"Segoe UI",sans-serif}
.pahneh-alert-overlay.is-open{display:flex}
.pahneh-alert-panel{display:flex;flex-direction:column;align-items:center;gap:16px;width:min(420px,100%);padding:24px;border-radius:16px;border:1px solid #86C9A0;background:#fff;color:#14532D;box-shadow:0 8px 24px rgba(20,83,45,.08);text-align:center}
.pahneh-alert-icon{width:24px;height:24px;flex:0 0 24px;color:#15803D}
.pahneh-alert-msg{margin:0;font-size:16px;line-height:1.6;white-space:pre-wrap;word-break:break-word}
.pahneh-alert-ok{min-height:44px;min-width:88px;padding:8px 24px;border:0;border-radius:12px;background:#15803D;color:#fff;font:inherit;font-size:16px;cursor:pointer;box-shadow:0 4px 12px rgba(21,128,61,.25)}
.pahneh-alert-ok:hover,.pahneh-alert-ok:active{background:#166534}
.pahneh-alert-ok:focus{outline:3px solid #15803D;outline-offset:2px}
@media (prefers-reduced-motion:reduce){
.pahneh-alert-overlay,.pahneh-alert-panel,.pahneh-alert-ok{transition:none;animation:none}
}
</style>
<script type="text/javascript" id="pahneh-alert-script">
(function (w, d) {
  if (w.pahnehAlert) { return; }
  var queue = [];
  var open = false;
  var pendingNav = null;
  var overlay, msgEl, okBtn, lastFocus;
  var loc = w.location;
  var nativeSubmit = null;
  function busy() {
    return open || queue.length > 0;
  }
  function holdNav(type, url) {
    pendingNav = { type: type, url: String(url) };
  }
  try {
    var nativeAssign = loc.assign;
    loc.assign = function (url) {
      if (busy()) { holdNav("assign", url); return; }
      return nativeAssign.call(loc, url);
    };
  } catch (errAssign) {}
  try {
    var nativeReplace = loc.replace;
    loc.replace = function (url) {
      if (busy()) { holdNav("replace", url); return; }
      return nativeReplace.call(loc, url);
    };
  } catch (errReplace) {}
  try {
    var hrefDesc = Object.getOwnPropertyDescriptor(Location.prototype, "href");
    if (hrefDesc && hrefDesc.set) {
      Object.defineProperty(Location.prototype, "href", {
        configurable: true,
        enumerable: hrefDesc.enumerable,
        get: function () { return hrefDesc.get.call(this); },
        set: function (url) {
          if (busy()) { holdNav("href", url); return; }
          hrefDesc.set.call(this, url);
        }
      });
    }
  } catch (errHref) {}
  try {
    nativeSubmit = HTMLFormElement.prototype.submit;
    HTMLFormElement.prototype.submit = function () {
      if (busy()) { pendingNav = { type: "submit", form: this }; return; }
      return nativeSubmit.call(this);
    };
  } catch (errSubmit) {}
  function flushNav() {
    if (!pendingNav) { return; }
    var nav = pendingNav;
    pendingNav = null;
    try {
      if (nav.type === "submit") {
        if (nativeSubmit && nav.form) { nativeSubmit.call(nav.form); }
      } else if (nav.type === "replace") { loc.replace(nav.url); }
      else if (nav.type === "assign") { loc.assign(nav.url); }
      else { loc.href = nav.url; }
    } catch (errNav) {}
  }
  function ready(fn) {
    if (d.body) { fn(); return; }
    if (d.addEventListener) { d.addEventListener("DOMContentLoaded", fn); }
    else { d.attachEvent("onreadystatechange", function () { if (d.readyState !== "loading") { fn(); } }); }
  }
  function ensureDom() {
    if (overlay) { return; }
    overlay = d.createElement("div");
    overlay.className = "pahneh-alert-overlay";
    overlay.setAttribute("dir", "rtl");
    overlay.setAttribute("lang", "fa");
    overlay.innerHTML = '<div class="pahneh-alert-panel" role="dialog" aria-modal="true" aria-labelledby="pahneh-alert-msg"><svg class="pahneh-alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="9"></circle><path d="M12 8v5"></path><circle cx="12" cy="16.5" r="0.8" fill="currentColor" stroke="none"></circle></svg><p class="pahneh-alert-msg" id="pahneh-alert-msg"></p><button type="button" class="pahneh-alert-ok">تأیید</button></div>';
    d.body.appendChild(overlay);
    msgEl = overlay.querySelector(".pahneh-alert-msg");
    okBtn = overlay.querySelector(".pahneh-alert-ok");
    okBtn.onclick = close;
    overlay.onclick = function (e) {
      e = e || w.event;
      if (e.stopPropagation) { e.stopPropagation(); }
    };
    overlay.onkeydown = function (e) {
      e = e || w.event;
      var key = e.key || e.keyCode;
      if (key === "Tab" || key === 9) {
        if (e.preventDefault) { e.preventDefault(); }
        okBtn.focus();
      }
    };
  }
  function showNext() {
    if (open || !queue.length) { return; }
    ready(function () {
      if (open || !queue.length) { return; }
      ensureDom();
      open = true;
      msgEl.textContent = queue.shift();
      overlay.className = "pahneh-alert-overlay is-open";
      d.documentElement.style.overflow = "hidden";
      lastFocus = d.activeElement;
      try { okBtn.focus(); } catch (err) {}
    });
  }
  function close() {
    if (!open) { return; }
    open = false;
    overlay.className = "pahneh-alert-overlay";
    d.documentElement.style.overflow = "";
    if (lastFocus && lastFocus.focus) {
      try { lastFocus.focus(); } catch (err) {}
    }
    showNext();
    if (!busy()) { flushNav(); }
  }
  w.pahnehAlert = function (message) {
    queue.push(message == null ? "" : String(message));
    showNext();
  };
})(window, document);
</script>
PAHNEH_ALERT;
    }
    $json = json_encode((string) $string, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    if ($json === false) {
        $json = '""';
    }
    echo '<script type="text/javascript">window.pahnehAlert(' . $json . ');</script>';
}
function sar_data($bah_cod_m)
{
global $dbh; 
$query = "SELECT * from bah where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_s= $row['city_s'] ; 
$mor_cod_m = $row['mor_cod_m'] ; 
$no_bah = $row['no_bah']; 
$bah_cod_m = $row['bah_cod_m']; 
$bah_jens= $row['jens']; 
$bah_name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$sh_sh   = $row['sh_sh']; 
$m_sod   = $row['m_sod']; 
$fname   = $row['fname']; 
$m_tah   = $row['m_tah']; 
$er_mtah = $row['er_mtah'];
$tel_s   = $row['tel_s']; 
$tel_m  = $row['tel_m']; 
$ostan_s  = $row['ostan_s'] ;
$shahr_s  = $row['shahr_s'] ;
$city_s   =  $row['city_s'] ;
$rosta_s  = $row['rosta_s'] ;
$co_name  = $row['co_name'] ;
$no_co  = $row['no_co'] ;
$sh_meli  = $row['sh_meli'] ;
$co_sabt  = $row['co_sabt'] ;
$add_city = $row['add_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$id_mar = $row['id_mar'] ;
$add_abadi = $row['add_abadi'] ;
// clos conntection 

?>
<table style="border:3px solid #069;" width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
 <?php  if ($no_bah=='1') { ?>
  <td height="27" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی</strong></div></td>
   </tr>
   <tr>
     <td width="370" height="30"><div align="right">
       <?php echo city_name1($id_city,$id_ostan) ?>
     </div></td>
     <td width="152"><div align="right">:شهرستان</div></td>
     <td>&nbsp;</td>
     <td width="207"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td width="172"><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
<?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $last_name ; ?></div></td>
     <td><div align="right">:نام خانوادگی</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $bah_name ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $sh_sh ; ?></div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td width="91">&nbsp;</td>
     <td><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td width="91">&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
 <?php }  if ($no_bah=='2') { ?>
     <td height="24" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی</strong></div></td>
   </tr>
   <tr>
     <td width="370" height="30"><div align="right"> <?php echo city_name($id_city) ?> </div></td>
     <td width="152"><div align="right">:شهرستان</div></td>
     <td>&nbsp;</td>
     <td width="207"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td><div align="right">:کد ملی مدیر عامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $co_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام شرکت</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $last_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $bah_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
    <?php  }?>
 </table>
<?php } function sar_data2($bah_cod_m,$num_bah)
{
global $dbh; 
$query = "SELECT city_s,mor_cod_m,no_bah,bah_cod_m,jens,name,last_name,date_t,sh_sh,m_sod,fname,m_tah,er_mtah,tel_s,tel_m,ostan_s,shahr_s,city_s,rosta_s,co_name,no_co,sh_meli,co_sabt,add_city,id_ostan,id_city,id_mar,add_abadi from bah where  bah_cod_m = :bah_cod_m and num_bah=:num_bah" ; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_s= $row['city_s'] ; 
$mor_cod_m = $row['mor_cod_m'] ; 
$no_bah = $row['no_bah']; 
$bah_cod_m = $row['bah_cod_m']; 
$bah_jens= $row['jens']; 
$bah_name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$sh_sh   = $row['sh_sh']; 
$m_sod   = $row['m_sod']; 
$fname   = $row['fname']; 
$m_tah   = $row['m_tah']; 
$er_mtah = $row['er_mtah'];
$tel_s   = $row['tel_s']; 
$tel_m  = $row['tel_m']; 
$ostan_s  = $row['ostan_s'] ;
$shahr_s  = $row['shahr_s'] ;
$city_s   =  $row['city_s'] ;
$rosta_s  = $row['rosta_s'] ;
$co_name  = $row['co_name'] ;
$no_co  = $row['no_co'] ;
$sh_meli  = $row['sh_meli'] ;
$co_sabt  = $row['co_sabt'] ;
$add_city = $row['add_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$id_mar = $row['id_mar'] ;
$add_abadi = $row['add_abadi'] ;
// clos conntection
static $sar2_css_done = false;
if (!$sar2_css_done) {
    $sar2_css_done = true;
?>
<style type="text/css">
.sar2-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 10px 14px; margin: 0 auto 14px; max-width: 920px; font-family: Tahoma, "IranSans", sans-serif; direction: rtl; text-align: right; color: #1f2937; }
.sar2-bar { overflow: hidden; }
.sar2-toggle {
    float: left; width: 36px; height: 36px; margin: 2px 0 0 0; border: 1px solid #d1d5db; border-radius: 6px;
    background: #f9fafb; color: #111827; font-size: 20px; line-height: 32px; cursor: pointer; font-family: Tahoma, sans-serif;
}
.sar2-toggle:hover { background: #059669; color: #fff; border-color: #047857; }
.sar2-who { overflow: hidden; padding-left: 48px; }
.sar2-who .sar2-label { display: block; font-size: 11px; color: #6b7280; margin-bottom: 2px; }
.sar2-who .sar2-main { font-size: 15px; color: #111827; font-weight: bold; }
.sar2-who .sar2-nid { display: block; margin-top: 4px; font-size: 13px; color: #374151; }
.sar2-more { display: none; margin-top: 12px; padding-top: 10px; border-top: 1px solid #e5e7eb; }
.sar2-card.sar2-open .sar2-more { display: block; }
.sar2-grid { width: 100%; overflow: hidden; }
.sar2-item { float: right; width: 48%; margin: 0 1% 12px 0; }
.sar2-item span { display: block; font-size: 12px; color: #6b7280; margin-bottom: 4px; }
.sar2-item strong { display: block; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 6px; padding: 8px 10px; font-size: 13px; font-weight: normal; color: #111827; min-height: 18px; }
@media screen and (max-width: 700px) {
    .sar2-item { float: none; width: 100%; margin: 0 0 12px 0; }
}
</style>
<script type="text/javascript">
function sar2Toggle(btn) {
    var card = btn;
    while (card && (card.className + '').indexOf('sar2-card') === -1) {
        card = card.parentNode;
    }
    if (!card) return;
    var open = (card.className + '').indexOf('sar2-open') !== -1;
    if (open) {
        card.className = card.className.replace('sar2-open', '');
        btn.innerHTML = '+';
        btn.title = 'نمایش جزئیات';
    } else {
        card.className = card.className + ' sar2-open';
        btn.innerHTML = '\u2212';
        btn.title = 'بستن جزئیات';
    }
}
</script>
<?php } ?>
<div class="sar2-card">
<?php if ($no_bah == '1') { ?>
    <div class="sar2-bar">
        <button type="button" class="sar2-toggle" onclick="sar2Toggle(this)" title="نمایش جزئیات">+</button>
        <div class="sar2-who">
            <span class="sar2-label">بهره بردار حقیقی</span>
            <span class="sar2-main"><?php echo $bah_name . ' ' . $last_name; ?></span>
            <span class="sar2-nid">کد ملی: <?php echo $bah_cod_m; ?></span>
        </div>
    </div>
    <div class="sar2-more">
        <div class="sar2-grid">
            <div class="sar2-item"><span>استان</span><strong><?php echo ostan_name($id_ostan); ?></strong></div>
            <div class="sar2-item"><span>شهرستان</span><strong><?php echo city_name1($id_city, $id_ostan); ?></strong></div>
            <div class="sar2-item"><span>مرکز جهاد کشاورزی</span><strong><?php echo mar_name($id_mar); ?></strong></div>
            <div class="sar2-item"><span>آبادی / شهر</span><strong><?php echo abadi_name($add_abadi), shahr_name($add_city); ?></strong></div>
            <div class="sar2-item"><span>نام</span><strong><?php echo $bah_name; ?></strong></div>
            <div class="sar2-item"><span>نام خانوادگی</span><strong><?php echo $last_name; ?></strong></div>
            <div class="sar2-item"><span>کد ملی - تاریخ تولد</span><strong><?php echo $date_t . '-' . $bah_cod_m; ?></strong></div>
            <div class="sar2-item"><span>شماره شناسنامه</span><strong><?php echo $sh_sh; ?></strong></div>
            <div class="sar2-item"><span>شماره تلفن ثابت</span><strong><?php echo $tel_s; ?></strong></div>
            <div class="sar2-item"><span>شماره همراه</span><strong><?php echo $tel_m; ?></strong></div>
        </div>
    </div>
<?php } if ($no_bah == '2') { ?>
    <div class="sar2-bar">
        <button type="button" class="sar2-toggle" onclick="sar2Toggle(this)" title="نمایش جزئیات">+</button>
        <div class="sar2-who">
            <span class="sar2-label">بهره بردار حقوقی — <?php echo $co_name; ?></span>
            <span class="sar2-main"><?php echo $bah_name . ' ' . $last_name; ?></span>
            <span class="sar2-nid">کد ملی مدیرعامل: <?php echo $bah_cod_m; ?></span>
        </div>
    </div>
    <div class="sar2-more">
        <div class="sar2-grid">
            <div class="sar2-item"><span>استان</span><strong><?php echo ostan_name($id_ostan); ?></strong></div>
            <div class="sar2-item"><span>شهرستان</span><strong><?php echo city_name1($id_city, $id_ostan); ?></strong></div>
            <div class="sar2-item"><span>مرکز جهاد کشاورزی</span><strong><?php echo mar_name($id_mar); ?></strong></div>
            <div class="sar2-item"><span>آبادی / شهر</span><strong><?php echo abadi_name($add_abadi), shahr_name($add_city); ?></strong></div>
            <div class="sar2-item"><span>نام شرکت / شناسه ملی شرکت</span><strong><?php echo $co_name; ?><br /><?php echo $sh_meli; ?></strong></div>
            <div class="sar2-item"><span>کدملی مدیر عامل</span><strong><?php echo $bah_cod_m; ?></strong></div>
            <div class="sar2-item"><span>نام مدیرعامل</span><strong><?php echo $bah_name; ?></strong></div>
            <div class="sar2-item"><span>نام خانوادگی مدیرعامل</span><strong><?php echo $last_name; ?></strong></div>
            <div class="sar2-item"><span>تلفن ثابت</span><strong><?php echo $tel_s; ?></strong></div>
            <div class="sar2-item"><span>شماره همراه</span><strong><?php echo $tel_m; ?></strong></div>
        </div>
    </div>
<?php } ?>
</div>
<?php } function sar_ind_data($NationalCode,$no_bah)
{
global $dbh; 
$query = "SELECT * from ind_bah where  NationalCode = :NationalCode and no_bah=:no_bah" ; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':NationalCode'=>$NationalCode,':no_bah'=>$no_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$mor_cod_m = $row['mor_cod_m'] ; 
$no_bah = $row['no_bah']; 
$NationalCode = $row['NationalCode']; 
$bah_jens= $row['jens']; 
$bah_name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$sh_sh   = $row['sh_sh']; 
$fname   = $row['fname']; 
$m_tah   = $row['m_tah']; 
$r_tah = $row['r_tah'];
$tel_s   = $row['tel_s']; 
$tel_m  = $row['tel_m']; 
$co_name  = $row['co_name'] ;
$c_f_name  = $row['c_f_name'] ;
$c_l_name  = $row['c_l_name'] ;
$c_cod_m  = $row['c_cod_m'] ;

$no_co  = $row['no_co'] ;
$co_sabt  = $row['co_sabt'] ;
$add_city = $row['add_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$id_mar = $row['id_mar'] ;
$add_abadi = $row['add_abadi'] ;
// clos conntection 

?>
<table  width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFCC" s >
   <tr>
 <?php  if ($no_bah=='1') { ?>
  <td height="22" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی صنایع کشاورزی</strong></div></td>
   </tr>
   <tr>
     <td width="179" height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $last_name ; ?></div></td>
     <td width="208" bgcolor="#FFFFFF"><div align="right">:نام خانوادگی</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td width="179" bgcolor="#FFFFFF"><div align="right"><?php echo $bah_name ; ?></div></td>
     <td width="334" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $sh_sh ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">:شماره شناسنامه</div></td>
     <td width="60" bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $NationalCode; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">:شماره همراه</div></td>
     <td width="60" bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $tel_s ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
 <?php }  if ($no_bah=='2') { ?>
     <td height="22" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی صنایع کشاورزی</strong></div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $c_cod_m ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">:کدملی مدیر عامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $co_name ; ?><br>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام شرکت</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $c_f_name,$c_l_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $NationalCode; ?><br>
     </div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: شناسه ملی </div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">:شماره همراه</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $tel_s ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >: تلفن ثابت</div></td>
   </tr>
    <?php  }?>
</table>
<?php } function bah_m_tah($bah_cod_m)
{
global $dbh; 
$query = "SELECT m_tah from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['m_tah']; 
// clos conntection 

}
function bah_tel_m($bah_cod_m)
{
global $dbh; 
$query = "SELECT tel_m from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['tel_m']; 
// clos conntection 

}
function bah_date_t($bah_cod_m)
{
global $dbh; 
$query = "SELECT date_t from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['date_t']; 
// clos conntection 

}

function edit_database_abadi($id_mar, $mor_cod_m, $id_abadi, $add_abadi)
{
    global $dbh;
    
    // لیست جداول برای بهینه‌سازی
    $tables = array(
        'bah',
        'bee',
        'unknown_bee',
        'Agri1397_1398',
        'Agri1398_1399',
        'Agri1399_1400',
        'Agri1400_1401',
        'Agri1401_1402',
        'Agri1402_1403',
        'Agri1403_1404',
        'Agri1404_1405',
        'Agri1405_1406',
        'Garden',
        'Garden_prod',
        'Agri_prod1397_1398',
        'Agri_prod1398_1399',
        'Agri_prod1399_1400',
        'Agri_prod1400_1401',
        'Agri_prod1401_1402',
        'Agri_prod1402_1403',
        'Agri_prod1403_1404',
        'Agri_prod1404_1405',
        'Agri_prod1405_1406',		
        'Aquatic',
        'Aquatic2',
        'Greenhous',
        'Greenhous_prod',
        'Greenprod_annual',
        'Mushroom',
        'Mushroom_prod',
        'Vege',
        'Vege_prod',
        'animals_unit'
    );
    
    try {
        $dbh->beginTransaction();
        $success = true;
        
        foreach ($tables as $table) {
            $query = "UPDATE $table SET id_mar = :id_mar, mor_cod_m = :mor_cod_m WHERE add_abadi = :add_abadi";
            $q = $dbh->prepare($query);
            $result = $q->execute(array(
                ':id_mar' => $id_mar,
                ':mor_cod_m' => $mor_cod_m,
                ':add_abadi' => $add_abadi
            ));
            
            if (!$result) {
                $success = false;
                error_log("Error updating table: $table");
                break;
            }
        }
        
        if ($success) {
            $dbh->commit();
            return true;
        } else {
            $dbh->rollBack();
            return false;
        }
        
    } catch (Exception $e) {
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
        }
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}

function edit_database_city($id_mar, $mor_cod_m, $add_city)
{
    global $dbh;
    
    // لیست جداول برای بهینه‌سازی
    $tables = array(
        'bah',
        'bee',
        'Aquatic',
        'unknown_bee',
        'Agri1397_1398',
        'Agri1398_1399',
        'Agri1399_1400',
        'Agri1400_1401',
        'Agri1401_1402',
        'Agri1402_1403',
        'Agri1403_1404',
        'Agri1404_1405',
        'Agri1405_1406',
        'Agri_prod1397_1398',
        'Agri_prod1398_1399',
        'Agri_prod1399_1400',
        'Agri_prod1400_1401',
        'Agri_prod1401_1402',
        'Agri_prod1402_1403',
        'Agri_prod1403_1404',
        'Agri_prod1404_1405',
        'Agri_prod1405_1406',		
        'Garden',
        'Garden_prod',
        'Greenhous',
        'Greenhous_prod',
        'Greenprod_annual',
        'Mushroom',
        'Mushroom_prod',
        'Vege',
        'Vege_prod',
        'animals_unit'
    );
    
    try {
        $dbh->beginTransaction();
        $success = true;
        
        foreach ($tables as $table) {
            $query = "UPDATE $table SET id_mar = :id_mar, mor_cod_m = :mor_cod_m WHERE add_city = :add_city";
            $q = $dbh->prepare($query);
            $result = $q->execute(array(
                ':id_mar' => $id_mar,
                ':mor_cod_m' => $mor_cod_m,
                ':add_city' => $add_city
            ));
            
            if (!$result) {
                $success = false;
                error_log("Error updating table: $table");
                break;
            }
        }
        
        if ($success) {
            $dbh->commit();
            return true;
        } else {
            $dbh->rollBack();
            return false;
        }
        
    } catch (Exception $e) {
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
        }
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}
function city_aria($id_ostan,$id_city)
{
global $dbh; 
$query = "SELECT id_aria from aria where id_ostan = '$id_ostan' and id_city = '$id_city' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['id_aria']; 

}
function  S_access($username)
{
global $dbh; 
$query = "SELECT S_access from users where username = '$username' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$S_access =  $row['S_access'] ;
return $S_access ; 

}

function mah_name_amar($cod_mah)
{
global $dbh; 
$query = "SELECT product_name from product_z_amar  where  product_cod_amar = :product_cod_amar"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':product_cod_amar'=>$cod_mah));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$product_name = $row['product_name'] ;
return $product_name ;

}

function mah_name($cod_mah)
{
global $dbh; 
$query = "SELECT product_name from product_z  where  product_cod = :product_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':product_cod'=>$cod_mah));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$product_name = $row['product_name'] ;
return $product_name ;

}

function group_name_amar($cod_qroup)
{
global $dbh; 
$query = "SELECT group_cod,group_name from product_z_amar  where  group_cod = :group_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':group_cod'=>$cod_qroup));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$group_name = $row['group_name'] ;
return $group_name ;

}

function group_name($cod_qroup)
{
global $dbh; 
$query = "SELECT group_cod,group_name from product_z  where  group_cod = :group_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':group_cod'=>$cod_qroup));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$group_name = $row['group_name'] ;
return $group_name ;

}

function group_name_green($group_cod)
{
global $dbh; 
$query = "SELECT group_cod,group_name from product_G  where  group_cod = :group_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':group_cod'=>$group_cod));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$group_name = $row['group_name'] ;
return $group_name ;

}


function mah_name_green($mah_cod)
{
global $dbh; 
$query = "SELECT mah_name from product_G  where  mah_cod = :mah_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mah_cod'=>$mah_cod));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$mah_name = $row['mah_name'] ;
return $mah_name ;

}

function mah_name_bagh($cod_mah)
{
global $dbh; 
$query = "SELECT product_name from product_b  where  product_cod = :product_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':product_cod'=>$cod_mah));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$product_name = $row['product_name'] ;
return $product_name ;

}
function mah_name_bagh_amar($cod_mah)
{
global $dbh; 
$query = "SELECT product_name from product_b_amar  where  product_cod = :product_cod"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':product_cod'=>$cod_mah));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$product_name = $row['product_name'] ;
return $product_name ;

}

function redirect($url){
     if (!headers_sent()){
         header('Location: '.$url); exit;
     }else{
         echo '<script type="text/javascript">';
         echo 'window.location.href="'.$url.'";';
         echo '</script>';
         echo '<noscript>';
         echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
         echo '</noscript>'; exit;
     }
 }
 function user_mfa($username)
{
global $dbh; 
$query = "SELECT ostan,city,markaz from users where username = '$username' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['ostan'].'/'.$row['city'].'/'.$row['markaz']; 
// clos conntection 

}
function sar_data3($bah_cod_m,$num_bah)
{
global $dbh; 
$query = "SELECT bah_cod_m,jens,name,last_name,date_t,sh_sh,m_sod,fname,m_tah,er_mtah,tel_s,tel_m from bah where  bah_cod_m = :bah_cod_m and num_bah=:num_bah" ; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$bah_cod_m = $row['bah_cod_m']; 
$bah_jens= $row['jens']; 
$bah_name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$sh_sh   = $row['sh_sh']; 
$m_sod   = $row['m_sod']; 
$fname   = $row['fname']; 
$m_tah   = $row['m_tah']; 
$er_mtah = $row['er_mtah'];
$tel_s   = $row['tel_s']; 
$tel_m  = $row['tel_m']; 
// clos conntection 

?> 
	    
 <table style="border:3px solid #069;" width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>

  <td height="30" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات فردی مددکار</strong></div></td>
   </tr>
   <tr>
     <td width="429" height="30"><div align="right"><?php echo $last_name ; ?></div></td>
     <td width="191" class="style8"><div align="right">:نام خانوادگی</div></td>
     <td>&nbsp;</td>
     <td width="350"><div align="right"><?php echo $bah_name ; ?></div></td>
     <td width="180" class="style8"><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $sh_sh ; ?></div></td>
     <td class="style8"><div align="right">:شماره شناسنامه</div></td>
     <td width="108">&nbsp;</td>
     <td><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td class="style8"><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td class="style8"><div align="right">:شماره همراه</div></td>
     <td width="108">&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td class="style8"><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $fname ; ?></div></td>
     <td class="style8"><div align="right">:نام پدر</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $date_t ; ?></div></td>
     <td class="style8"><div style="margin-right:30px" align="right" >:تاریخ تولد </div></td>
   </tr>
</table>
<?php }function bah_count($bah_cod_m)
{
global $dbh; 
$query = "SELECT count(*) from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt -> fetchColumn();
return $result ; 
// clos conntection 

}
function bah_ind_unit_count($bah_cod_m,$num_bah)
{
global $dbh; 
$query = "SELECT count(*) from ind_unit where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function bah_ind_prod_count($bah_cod_m,$num_bah)
{
global $dbh; 
$query = "SELECT count(*) from ind_prod where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function ind_unit_prod_count($unit_id)
{
global $dbh; 
$query = "SELECT count(*) from ind_unit_info where unit_id = '$unit_id'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function bah_agri_count($bah_cod_m,$num_bah,$table)
{
global $dbh; 
$query = "SELECT count(*) from $table where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function bah_vege_count($bah_cod_m,$num_bah,$sal)
{
global $dbh; 
 $query = "SELECT count(*) from Vege where bah_cod_m = '$bah_cod_m' and no_bah = '$num_bah' and z_sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}

function bah_garden_count($bah_cod_m,$num_bah,$sal)
{
global $dbh; 
 $query = "SELECT count(*) from Garden where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and z_sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function bah_Mushroom_count($bah_cod_m,$num_bah,$sal)
{
global $dbh; 
 $query = "SELECT count(*) from Mushroom_prod where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and y_prod = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function bah_Greenhous_count($bah_cod_m,$num_bah,$y_prod)
{
global $dbh; 
 $query = "SELECT count(*) from Greenhous_prod where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and y_prod = '$y_prod' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function bah_Greenhous_count_mor($bah_cod_m)
{
global $dbh; 
 $query = "SELECT count(*) from Greenhousn where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and y_prod = '$y_prod' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}

function bah_bee_count($bah_cod_m,$num_bah,$sal)
{
global $dbh; 
  $query = "SELECT count(*) from bee where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function bah_eworker_count($bah_cod_m)
{
global $dbh; 
$query = "SELECT count(*) from Eworker where cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
function bah_Aquatic_count($bah_cod_m,$num_bah,$sal)
{
global $dbh; 
 $query = "SELECT count(*) from Aquatic where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}

// میزان حداکثر تولید زراعی / مترمربع
function mht_z($cod_mah, $m_sb, $no_kesh)
{
    global $dbh; 
    // ۱. مقداردهی اولیه برای جلوگیری از خطای متغیر تعریف نشده
    // اگر هیچ‌کدام از شرط‌های پایین برقرار نباشد، این مقدار استفاده می‌شود
    $sh_ht = 299; 
    // ۲. استفاده صحیح از Prepared Statements برای جلوگیری از هک و SQL Injection
    $query = "SELECT ht_ab, ht_dem FROM ht_z WHERE cod_mah = :cod_mah";
    $stmt = $dbh->prepare($query);
    
    // ارسال مقدار متغیر به صورت پارامتر ایمن
    $stmt->execute(array(':cod_mah' => $cod_mah));
        $rcount = $stmt->rowCount();
        // ۳. بررسی وجود رکورد در دیتابیس
    if ($rcount > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($no_kesh == '1') {
            $sh_ht = $row['ht_ab'];
        } elseif ($no_kesh == '2') {
            $sh_ht = $row['ht_dem'];
        }
        // اگر رکوردی پیدا شد اما no_kesh برابر 1 یا 2 نبود،
        // برنامه به طور خودکار از همان مقدار پیش‌فرض 299 استفاده می‌کند.
    }
    // محاسبه نهایی بدون دریافت هیچ‌گونه خطایی
    $m_ht = $m_sb * $sh_ht;
    return $m_ht;
}

// حداکثر تولید گلخانه
function mht_G($mah_cod,$m_sk)
{
global $dbh; 
$query = "SELECT ht from product_G where mah_cod = '$mah_cod' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$rcount = $stmt -> rowCount();
if ($rcount > 0) {
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sh_ht = $row['ht'] ;
}
else 
{
$sh_ht = 299 ; 
// اگر حداکثر تولید برای یک محصول وارد نشده باشد حداکثر تولید آن را 299 تن در هکتار قبول کن
}
$m_ht = $m_sk * $sh_ht ;
return  $m_ht ;
// clos conntection 

}

// میزان حداکثر تولید باغی / هکتار
function mht_b($cod_mah,$m_sb,$no_kesh)
{
global $dbh; 
$query = "SELECT ht_ab,ht_dem from ht_b where cod_mah = '$cod_mah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$rcount = $stmt -> rowCount();
if ($rcount > 0) {
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($no_kesh == '1') $sh_ht = $row['ht_ab'] ;
if ($no_kesh == '2') $sh_ht = $row['ht_dem'] ;
}
else 
{
$sh_ht = 299 ; 
// اگر حداکثر تولید برای یک محصول وارد نشده باشد حداکثر تولید آن را 299 تن در هکتار قبول کن
}
$m_ht = $m_sb * $sh_ht ;
return  $m_ht ;
// clos conntection 

}
// میزان حداکثر تولید زراعی / هکتار
function V_mht($cod_mah,$m_sb)
{
global $dbh; 
$query = "SELECT ht_ab,ht_dem from ht_z where cod_mah = '$cod_mah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sh_ht = $row['ht_ab'] ;
$m_ht = ($m_sb ) * $sh_ht ;
return  $m_ht ;
// clos conntection 

}
function Agri_id2($bah_cod_m,$sh_gat,$z_sal,$mor_cod_m,$date_s)
{
global $dbh; 
$Agri_table = 'Agri'.str_replace('-','_',$z_sal) ;  
$query = "SELECT id from $Agri_table where bah_cod_m = '$bah_cod_m' and sh_gat='$sh_gat' and  z_sal = '$z_sal' and  mor_cod_m = '$mor_cod_m' and  date_s = '$date_s'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['id'] ;
// clos conntection 

}
function Garden_id($bah_cod_m,$sh_gat,$z_sal,$mor_cod_m,$date_s)
{
global $dbh; 
$query = "SELECT id from Garden where bah_cod_m = '$bah_cod_m' and sh_gat='$sh_gat' and  z_sal = '$z_sal' and  mor_cod_m = '$mor_cod_m' and  date_s = '$date_s'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['id'] ;
// clos conntection 

}
function Vege_id($bah_cod_m,$sh_gat,$z_sal,$mor_cod_m,$date_s)
{
global $dbh; 
$query = "SELECT id from Vege where bah_cod_m = '$bah_cod_m' and sh_gat='$sh_gat' and  z_sal = '$z_sal' and  mor_cod_m = '$mor_cod_m' and  date_s = '$date_s'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['id'] ;
// clos conntection 

}
function Vege_pt($Vege_id)
{
global $dbh; 
$query = "SELECT count(*)  from Vege_prod WHERE Vege_id = '$Vege_id' AND mah_tolp is null";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt -> fetchColumn();
return $result ; 
// clos conntection 

}
function Vege_baz($Vege_id)
{
global $dbh; 
$query = "SELECT count(*)  from Vege_prod WHERE Vege_id = '$Vege_id' AND mah_bazar = ''";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt -> fetchColumn();
return $result ; 
// clos conntection 

}
function Vege_sbar($Vege_id)
{
global $dbh; 
$query = "SELECT count(*)  from Vege_prod WHERE Vege_id = '$Vege_id' AND s_bar is null ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt -> fetchColumn();
return $result ; 
// clos conntection 

}
function Vege_tol($Vege_id)
{
global $dbh; 
$query = "SELECT count(*)  from Vege_prod WHERE Vege_id = '$Vege_id' AND mah_tol is null ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt -> fetchColumn();
return $result ; 
// clos conntection 

}
?>
<?php
   function sar_data20($bah_cod_m,$num_bah)
{
global $dbh; 
$query = "SELECT city_s,mor_cod_m,no_bah,bah_cod_m,jens,name,last_name,date_t,sh_sh,m_sod,fname,m_tah,er_mtah,tel_s,tel_m,ostan_s,shahr_s,city_s,rosta_s,co_name,no_co,sh_meli,co_sabt,add_city,id_ostan,id_city,id_mar,add_abadi from bah where  bah_cod_m = :bah_cod_m and num_bah=:num_bah" ; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_s= $row['city_s'] ; 
$mor_cod_m = $row['mor_cod_m'] ; 
$no_bah = $row['no_bah']; 
$bah_cod_m = $row['bah_cod_m']; 
$bah_jens= $row['jens']; 
$bah_name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$sh_sh   = $row['sh_sh']; 
$m_sod   = $row['m_sod']; 
$fname   = $row['fname']; 
$m_tah   = $row['m_tah']; 
$er_mtah = $row['er_mtah'];
$tel_s   = $row['tel_s']; 
$tel_m  = $row['tel_m']; 
$ostan_s  = $row['ostan_s'] ;
$shahr_s  = $row['shahr_s'] ;
$city_s   =  $row['city_s'] ;
$rosta_s  = $row['rosta_s'] ;
$co_name  = $row['co_name'] ;
$no_co  = $row['no_co'] ;
$sh_meli  = $row['sh_meli'] ;
$co_sabt  = $row['co_sabt'] ;
$add_city = $row['add_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$id_mar = $row['id_mar'] ;
$add_abadi = $row['add_abadi'] ;
// clos conntection 

?>
<table style="border:3px solid #069; margin-top:-10px" width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFCC" s >
   <tr>
 <?php  if ($no_bah=='1') { ?>
  <td height="22" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی</strong></div></td>
   </tr>
   <tr>
     <td width="179" height="30"><div align="right">
     <?php echo city_name1($id_city,$id_ostan) ?>
     </div></td>
     <td width="208"><div align="right">:شهرستان</div></td>
     <td>&nbsp;</td>
     <td width="179"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td width="334"><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right">
<?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
<?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $last_name ; ?></div></td>
     <td><div align="right">:نام خانوادگی</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $bah_name ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $sh_sh ; ?></div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td width="60">&nbsp;</td>
     <td><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td width="60">&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
 <?php }  if ($no_bah=='2') { ?>
     <td height="22" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی</strong></div></td>
   </tr>
   <tr>
     <td width="179" height="30"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?> </div></td>
     <td width="208"><div align="right">:شهرستان</div></td>
     <td>&nbsp;</td>
     <td width="179"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"> <?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td><div align="right">:کدملی مدیر عامل</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $co_name; ?><br>
     <?php echo $sh_meli ; ?>     </div></td>
     <td><div style="margin-right:30px" align="right">: نام شرکت/ شناسه ملی شرکت</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $last_name ; ?></div></td>
     <td><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $bah_name ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: نام مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >: تلفن ثابت</div></td>
   </tr>
    <?php } }?>
