<?php 
//include('lock_p1.php');
include('event.php') ;
$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    <title>سامانه پهنه بندی آبادی های  آذربایجان شرقی</title>
	
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php //include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><p><!--تاریخ فارسی--></p>
      <p>
     <head>

<style type="text/css">
#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
</style>


<body>
<div id="content">
<?php
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
include('login/config.php');
require_once('Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
echo $date_edit ; 
$query = "SELECT * FROM  log  where date = '$date_edit'  ORDER BY date DESC , time DESC LIMIT $start, $limit" ;
$query1 = "SELECT * FROM log  where date = '$date_edit'  ORDER BY date DESC , time DESC " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p  align="center" class="style8">مشاهده عملکرد بروز کاربران در سامانه </p>
           <p><img src="files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
        <p>&nbsp;</p>
           <table width="90%" height="97" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="12%"  height="49" bgcolor="#CCCCCC">آی پی سیستم</td>
    <td width="8%"  bgcolor="#CCCCCC">ساعت</td>
    <td width="9%"  bgcolor="#CCCCCC">تاریخ</td>
    <td width="16%"  bgcolor="#CCCCCC">آدرس آماری آبادی</td>
    <td width="21%"  bgcolor="#CCCCCC">عملیات</td>
    <td  colspan="2"  bgcolor="#CCCCCC">مشخصات کاربر</td>
    <td width="4%"  bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
$username = $row['username'] ; 
$query2 = "SELECT * FROM  users  where username = $username " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
?>
    <td class="normalTextSmaller"><?php echo $row['ip'];?></td>
    <td class="normalTextSmaller"><?php echo $row['time'];?></td>
    <td class="normalTextSmaller"><?php echo $row['date'];?></td>
    <td class="normalTextSmaller"><?php echo abadi_name($row['add_abadi']).' '.$row['add_abadi'];?></td>
    <td class="normalTextSmaller"><?php echo $row['verb'];?></td>
    <td width="24%" class="normalTextSmaller"><?php echo $row2['Last_name'].' '.$row2['name'].' / '.$row2['city'].' - '.$row2['markaz'];?></td>
    <td width="6%" class="normalTextSmaller"><img src="files/users/<?php echo $row2['pic'];?>" width="28" height="33"  alt=""/></td>
    <td><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
<?

$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	echo "<a href='?id=".($id-1)."' class='button'>قبلی</a>";
}
if($id!=$total)
{
	echo "<a href='?id=".($id+1)."' class='button'>بعدی</a>";
}

echo "<ul class='page'>";
		for($i=1;$i<=$total;$i++)
		{
			if($i==$id) { echo "<li class='current'>".$i."</li>"; }
			
			else { echo "<li><a href='?id=".$i."'>".$i."</a></li>"; }
		}
echo "</ul>";
?>
</div>
          </p>
      <!--end form --> 
    </td>
  </tr>
  <tr>
  <td  height="109"colspan="3" valign="middle" background="files/bottom.gif"><p class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 34438000-6 041 فکس: 334439940 041<br />
          <span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</table>
</body>
</html>



<?php


 if (isset($_POST['action'])) 
 {  
 function alert($string)
{
    echo '<script type="text/javascript">alert("' . $string . '");</script>';
}
//alert('ثبت فشرده شد'); 
 $name = $_POST['name']; 
 $last_name = $_POST['last_name']; 
 $jens = $_POST['jens']; 
 $sh_sh = $_POST['sh_sh']; 
 $date_t = date_con($_POST['date_t']); 
 $m_sodor = $_POST['m_sodor']; 
 $fname = $_POST['fname']; 
 $m_tah = $_POST['m_tah']; 
 $r_tah = $_POST['r_tah']; 
 $univer = $_POST['univer']; 
 $m_date = date_con($_POST['m_date']); 
 $avre = $_POST['avre']; 
 $v_tahol = $_POST['v_tahol']; 
 $cod_p = $_POST['cod_p']; 
 $tel_s = $_POST['tel_s']; 
 $tel_m = $_POST['tel_m']; 
 $addres = $_POST['addres']; 



// تعریف متغیرهای که هنگام لود فرم خالی رد میشن
{ 
include('login/config.php');
$query = "UPDATE users 
        SET  name=?,Last_name=?,jens=?,sh_sh=?,date_t=?,m_sodor=?,fname=?,m_tah=?,r_tah=?,univer=?,m_date=?,avre=?,v_tahol=?,cod_p=?,tel_s=?,tel_m=?,addres=?
		WHERE username=?";
$q = $dbh->prepare($query);
$q->execute(array($name,$last_name,$jens,$sh_sh,$date_t,$m_sodor,$fname,$m_tah,$r_tah,$univer,$m_date,$avre,$v_tahol,$cod_p,$tel_s,$tel_m,$addres,$username
));

sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','ویرایش اطلاعات کاربر') ; 
alert('اطلاعات کاربری شما با موفقیت تصحیح شد ') ;
?>
<form name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
// end click update
 }
 }
 ?>
 

 <?php 
 // فانكشن آپلود فايل 
function upload($file_id, $folder="", $types="") 
{
// پوشه نام 

   if(!$_FILES[$file_id]['name']) return array('','No file specified');
      $file_title = $_FILES[$file_id]['name'];
    //Get file extension
   // $ext_arr = split("\.",basename($file_title));
   // $ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension
	$ext = substr(strrchr(basename($file_title), '.'), 1);
    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(),1)),0,5);
  //  $file_name = $id . '_' . $file_title;//Get Unique Name
    $no_file = $_POST['no_file']   ;
    $file_name = $no_file.'.' . $ext;//Get Unique Name
  //  echo $file_name ; 
	$all_types = explode(",",strtolower($types));
    if($types) {
        if(in_array($ext,$all_types));
        else {
            $result = 'فايل غير مجاز' ;
			echo "<br/>\n" ;
			 //Show error if any.
        //   return array('',$result);
		  return array($file_name,$result);
        }
    }
    //Where the file must be uploaded to
    if($folder) $folder .= '/';//Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;
    $result = 1;
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "امكان آپلود فايل وجود ندارد "; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : مقصد يافت نشد ";
        } elseif(!is_writable($folder)) {
            $result .= " : امكان نوشتن در مقصد وجود ندارد";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : فايل قابل نوشتن نيست";
        }
        $file_name = '';
        
    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result =  " فايل خالي است لطفا يك فايل معتبر انتخاب كنيد "; //Show the error message
			echo "<br/>\n" ;
        } else {
// کنترل حجم فایل
   
switch ($file_id)
 {
  case "pic":
        $max_filesize  = 30000;
		$min_filesize = 2000;
}
            $size=filesize($_FILES[$file_id]['tmp_name']);
//            $max_filesize = 122091;
            if (($size > $max_filesize) || ($size < $min_filesize))
		   {
			$result = 'حجم فایل غیر مجاز '.($size/1000).'کیلوبایت'  ;
             }
			 chmod($uploadfile,0777);//Make it universally writable.
        }
    }
		  return array($file_name,$result);
}
////End
?>
