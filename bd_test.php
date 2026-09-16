<?php
include ('login/config.php');
include ('event.php');
require_once('Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$bday = substr($date_edit,5) ;
$bday = str_replace('/','-',$bday) ; 
//$bday = '01-19' ; 
echo $bday ; 
$query = "SELECT username,id_ostan,id_mar,jens from users WHERE  date_t LIKE  '%$bday%'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$num =  rand(1,3)	; 
$mor_cod_m = $row['username'] ;
$id_ostan = $row['id_ostan'] ; 
$id_mar = $row['id_mar'] ; 
$jens = $row['jens'] ; 
if ($jens =='مرد') $v_jens = 'جناب آقای' ; 
if ($jens =='زن') $v_jens = 'سرکار خانم' ; 
//alert($mor_cod_m);
if (1 > 0 )
{
//alert($id_mar);
$r_uder_name = user_name($mor_cod_m) ; 
$title1 = 'تبریک' ; 
//$title2 = 'اشکالات زراعی 98-97 آقا/خانم :'.$r_uder_name  ; 
$r_user = $mor_cod_m ; 
//$s_user = '3230698584' ;
$s_user = '1380066174' ;
$file_send = 'bd.jpg' ; 
$r_uder_name = user_name($mor_cod_m) ; 
$message1 = <<<EOT

همکار گرامی $v_jens ، $r_uder_name 

با سلام و احترام
تولدتان را صمیمانه تبریک عرض نموده و از ایزد منان برایتان سالهای سال عمر با عزت و برکت خواستاریم.
باشد که بقاء عمرتان با عزت و سربلندی و توام با خدمت به ایران عزیزمان باشد.

با احترام : پشتیبان سامانه 

EOT;
$message2 = <<<EOT

$v_jens ، $r_uder_name 

آرزومند پدیدار شدن معجزه ی خوشبختی در زندگی شما هستیم لحظه های خوش و سعادت نصیب شما همکار گرامی
تولدتان مبارک

با احترام : پشتیبان سامانه 

EOT;
$message3 = <<<EOT

همکار گرامی $v_jens ، $r_uder_name 

تولدتان را صمیمانه تبریک گفته و از ایزد منان برای تان شادی، سلامتی و سربلندی آرزو داریم 
مایه خوشبختی و سعادت برای ماست که یک سال دیگر در کنار شما بودیم

با احترام : پشتیبان سامانه 

EOT;

if ($num == 1) $message = $message1 ; 
if ($num == 2) $message = $message2 ; 
if ($num == 3) $message = $message3 ; 

$query = "INSERT INTO pm (file,title,r_user,s_user,message,no_pm,s_date,s_time) VALUES (:file,:title,:r_user,:s_user,:message,:no_pm,:s_date,:s_time)";
$q = $dbh->prepare($query);
$q->execute(array(':file'=>$file_send,':title'=>$title1,':r_user'=>$r_user,':s_user'=>$s_user,':message'=>$message,':no_pm'=>'1',':s_date'=>$date_edit,':s_time'=>$time));

}
}
alert('تمام');
?>
