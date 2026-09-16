<?php
include("../../lock_p1.php");
include('../../event.php') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
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
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 ?>
<p align="center" >&nbsp;</p>
<p align="center" class="style8" >لیست زنبورستان های ثبت شده <span class="style1"><a name="1" id="1"></a></span></p>
 <p align="center" ><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
   <?php
include('../../login/config.php');
 $query = "SELECT end_bee from users where username = '$login_session' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$end_bee =  $row['end_bee'] ; 
$bah_cod_m=$_POST['bah_cod_m'];
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $query  = "SELECT * from bee where mor_cod_m =:mor_cod_m and  sal='1404' ORDER BY bah_cod_m ASC LIMIT $start, $limit "; 
$query1 = "SELECT * from bee where mor_cod_m = :mor_cod_m and  sal='1404' ORDER BY bah_cod_m ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
$found = $stmt -> rowCount();
if ($found>0) {
?>
 </p>
  <table  align="center" class="my-table" >
    <tr class="text1">
    <td colspan="4" rowspan="2" bgcolor="#006699">عملیات</td>
    <td height="35" colspan="3" bgcolor="#006699">تولید عسل<br />
      <span class="style2">کیلوگرم</span></td>
    <td height="35" colspan="3" bgcolor="#006699">تعداد کندو</td>
    <td colspan="2" bgcolor="#006699">مشخصات زنبوردار</td>
    <td width="6%" rowspan="2" bgcolor="#006699">نوع زنبورستان</td>
    <td colspan="2" bgcolor="#006699">موقعیت زنبورستان</td>
    <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
    </tr>
    <tr class="text1">
      <td width="6%" bgcolor="#006699">جمع</td>
      <td width="6%" height="31" bgcolor="#006699">مدرن</td>
      <td width="6%" bgcolor="#006699">سنتی</td>
      <td width="6%" bgcolor="#006699">جمع</td>
      <td width="6%" height="31" bgcolor="#006699">مدرن</td>
      <td width="5%" bgcolor="#006699">سنتی</td>
      <td width="8%" bgcolor="#006699">کد ملی </td>
      <td width="12%" bgcolor="#006699">نام و نام خانوادگی</td>
      <td width="11%" bgcolor="#006699">شهر/آبادی</td>
      <td width="9%" bgcolor="#006699">شهرستان</td>
      </tr>  <tr>
<?php 
$r = $start+1 ;
foreach($stmt as $row){ 
$unique_id = $row['unique_id'] ; 
 $pic = user_pic($row['mor_cod_m']) ; 
 if ($row['no_zan']=='1') $v_no_zan = 'غیر مهاجر '; else $v_no_zan = 'مهاجر' ;
 // غیر فعال کردن تغییرات و حذف 
// $end_bee = '3' ; 
//
  ?>
    <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <?php //if ((!$end_bee=='1') or (!$end_bee=='3'))  {?>
    <?php if ('1'>'1' )   {?>
    <form  action="del_list_bee.php" method="post">
    <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
    <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
    <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
    <input type="hidden" name="unique_id"  value="<?php echo $unique_id ;?>" />
    <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
    <button onclick="return confirm('از حذف اطلاعات زنبورستان مطمئن هستید ؟ ')"><img src="../../files/del1.png" title="حذف اطلاعات زنبورستان" width="33" height="26"  alt=""/></button>
    </form>
        </td>
    <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="equip_edit.php" method="post">
      <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
      <input type="hidden" name="num_bah" value="<?php echo $row['num_bah']  ;?>" />
      <input type="hidden" name="unique_id"  value="<?php echo $row['unique_id'] ;?>" />
      <button><img src="../../files/komo2.png" title="ویرایش تجهیزات زنبورستان" width="20" height="20"  alt=""/></button>
    </form></td>
    <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <?php //if ((!$end_bee=='1') or (!$end_bee=='3'))  {?>
    <?php } else 
	{ ?>
    <td></td>
     <td></td>

	<? }if ('1'>'1' )   {?>
    <form  action="Bee_edit.php" method="post">
     <input type="hidden" name="m_poul" value="<?php if(isset($row['m_poul'])) echo $row['m_poul']  ;?>" />
    <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
    <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
    <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
    <input type="hidden" name="no_bee" value="<?php echo $row['no_zan']  ;?>" />
    <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
    <button><img src="../../files/edit.png" title="ویرایش اطلاعات زنبورستان" width="20" height="20"  alt=""/></button>
    </form>
    <?php }?>
</td>
    <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> <form  action="view_list_bee.php" method="post">
      <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
      <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
      <button><img src="../../files/view.png" title="نمایش اطلاعات زنبورستان"  width="20" height="20"  alt=""/></button>
      </form>
    </td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['to_mo']+$row['to_bo'] ;   ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['to_mo'] ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['to_bo'] ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo'] ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_bo'] ?></td>
    <td height="35" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name($row['bah_cod_m'])?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_zan?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
    <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td> 
     </tr>
    <?php 
	$r++ ; 
	}?>
</table>
  <p class="style2" align="center">
</p>
  <div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
  <?php   
$stmt1 = $dbh->prepare($query1);
$stmt1->execute(array(':mor_cod_m'=>$login_session));
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="list_bee.php?id=<?php echo $id-1 ?>#1" method="post">
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="list_bee.php?id=<?php echo $id+1 ?>#1" method="post">
        <button class='button' >بعدی</button>
      </form>
    <?php 
}

echo "<ul class='page'>";

		for($i=1;$i<=$total;$i++)
		{
			if($i==$id) { echo "<li class='current'>".$i."</li>"; }
			else { 
			?>
      <li class='current'><form  action="list_bee.php?id=<?php echo $i?>#1" method="post">
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
}
echo "</ul>";
?>
</div>
 
          <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>