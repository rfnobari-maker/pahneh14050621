<?php 
include('../lock_expar.php');
//include('counter.php');
include('../event.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    </style>
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
#menu
{font-family:Tahoma ; font-size:13px ; float:right ; list-style:none ; direction:rtl; width:470px ; line-height:40px 
; background:#069; margin-right:250px ; border:1px #990000; border-radius:10px} 
 #menu li
{ float:right ; padding-left:10px ; padding-right:10px}
 #menu li:hover
{ background:#903; line-height:45px;border-radius:10px  }

#menu li a 
{ text-decoration:none ; color:#FFF }
  #img1
    {
	border-radius:40px ; 
	}
-->
</style>
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
<script type="text/javascript" src="jquery.min.js"></script>
  <script type='text/javascript' src='../15_files/jquery.msgBox.js'></script>
  <link rel="stylesheet" href="../15_files/msgBoxLight.css" />

</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu_notseen.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top_notseen.php');?>
      </p>
<?php 
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
include('../login/config.php');
$query = "SELECT * FROM  pm WHERE  r_user = '$login_session'  and ru_read = '1' ORDER BY id DESC LIMIT $start, $limit" ;
$query1 = "SELECT * FROM  pm WHERE  r_user = '$login_session' and ru_read = '1' ORDER BY id DESC  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p><span class="style8">لیست پیام های مشاهده نشده </span> </p>
<p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <table width="900" height="127" border="1" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
            <td width="75" rowspan="2" bgcolor="#0099CC">مشاهده</td>
            <td width="71" rowspan="2" bgcolor="#0099CC">آخرین وضعیت</td>
    <td colspan="3" bgcolor="#0099CC">فرستنده</td>
    <td height="33" colspan="2" bgcolor="#0099CC">دریافت پیام </td>
    <td width="204" rowspan="2" bgcolor="#0099CC">موضوع پیام </td>
    <td width="51" rowspan="2" bgcolor="#0099CC">پیوست</td>
    <td width="39" rowspan="2" bgcolor="#0099CC">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td width="96" height="33" bgcolor="#0099CC">سمت</td>
    <td width="126" bgcolor="#0099CC">نام و نام خانوادگی</td>
    <td width="52" bgcolor="#0099CC">تصویر</td>
    <td width="73" bgcolor="#0099CC">ساعت </td>
    <td width="91" bgcolor="#0099CC">تاریخ</td>
    </tr>
  <tr>
<?php
$r = $start+1 ;
            if($stmt -> rowCount() > 0){
 foreach($stmt as $row)
 {
	 if ($row['ru_read']=='1')  $v_message = 'مشاهده نشده' ; 
	 if ($row['ru_read']=='2')  $v_message = 'مشاهده '.'<br>'.$row['r_date'] ; 
	 if ($row['ru_read']=='3')  $v_message = 'ارسال پاسخ'.'<br>'.$row['r_date'] ;  ; 
	 if ($row['ru_read']=='5')  $v_message = 'انتقال'.'<br>'.$row['r_date'] ; 
  if (S_access($row['s_user'])=='1') $v_s_access = 'مروج کشاورزی';
  if (S_access($row['s_user'])=='2') $v_s_access = 'رئیس مرکز';
  if (S_access($row['s_user'])=='3') $v_s_access = 'مدیریت شهرستان';
  if (S_access($row['s_user'])=='4') $v_s_access = 'مدیریت سامانه';
  if (S_access($row['s_user'])=='5') $v_s_access = 'کارشناس معین استان';
  if (S_access($row['s_user'])=='6') $v_s_access = 'کارشناس موضوعی شهرستان';
  if (S_access($row['s_user'])=='20') $v_s_access = 'مدیریت کشوری';
  if (S_access($row['s_user'])=='98') $v_s_access = 'کارشناس ادمین استان';
  if (S_access($row['s_user'])=='99') $v_s_access = 'مدیر سامانه';
?>
<tr>
<td width="75" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <form  action="sabt_view.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
    <input type="hidden" name="s_user" value="<?php echo $row['s_user'] ;?>" />
    <input type="hidden" name="ru_read" value="<?php echo $row['ru_read'] ;?>" />
  <button><img src="../files/view.png" border="0"  title="مشاهده پیام" width="29" height="30" /></button>
    </form></td>
<td  class="style2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_message ;?></td>
<td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><br />
  <span class="style2"><?php echo $v_s_access ;  ?><br />
  <?php echo user_mfa($row['s_user']);?>  <br />
  <br />
  </span></td>
<td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['s_user']);?><br />
  <span class="style2"><?php echo user_tel($row['s_user']);?></span></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <img  id="img1" src="../files/users/<?php echo user_pic($row['s_user']) ?>?m="<?php filemtime(user_pic($row['s_user'])) ?> width="42" height="46"  alt=""/></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmall"><?php echo $row['s_time']?></td>
    <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
   <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['s_date']?></td>
   <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['title'];?></td>
   <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php if ($row['file']<>'') echo '<img src=../files/attachment.jpg width=30 height=30/>' ; else echo 'ندارد' ; ?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
        <?php
		 $r++ ; 
} }else{ ?>
            <tr>
              <td colspan="12">پیامی موجود نیست </td></tr> 
        <?php } ?>
    </table>
<br />
     <p>
</p>
  <?php
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

<p>&nbsp;</p>
<p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php if(isset($_GET["unread"]))  
{
?>
	   <script type="text/javascript">
    	msgBoxImagePath = "../15_files/";
	showMsgBox() ; 
		function showMsgBox(title,content,type) {
			$.msgBox({
				title: "توجه :",
				content: " لطفاً برای ادامه ، ابتدا پیام های جدید خود را مشاهده کنید .",
				type: "alert" ,
				showButtons: true,
                opacity: 0.8,
                autoClose:true,
				});
		}
		 </script>
<?php
}
?>
