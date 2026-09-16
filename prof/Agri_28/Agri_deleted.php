<?php
require_once("../../lock_p1.php");
require_once("../../event.php");
$z_sal       = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 	  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
 <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
<title><?php echo $title ;?></title>
<style>
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
	text-align: center;
}
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
border-color:#FFF ;
}
</style>

</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="130" /></td>
          </tr>
          <tr>
            <td dir="ltr"><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
      <?php include('top.php');?>
    <td  colspan="3" valign="middle" >
<form  id="reg-form" method="post" action="#1">
        <div style="width: 500px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
    <table width="100%" height="154" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="48" colspan='2' align='center' bgcolor="#FFFFFF">گزارش محصولات حذف شده زراعی<a name="1" id="1"></a></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
            <?php
                    $query = "SELECT z_sal FROM z_sal  ORDER BY z_sal DESC "  ;
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
            <option value="<?php echo $row['z_sal'] ;?>"
                   <?php if ($row['z_sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['z_sal'] ;?></option>
            <?php }?>
            </select>
          </div></td>
        <td width="112"  align='center' bgcolor="#FFFFFF" class="style11"><span class="input_text"><font size="2" class="style8">: سال زراعی</font></span></td>
      </tr>
      <tr >
        <td height="60" colspan="2" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
      </tr>
    </table>
  </div>
</form>
<?php 
   if (isset($_POST['z_sal']))
   {
 $z_sal= $_POST['z_sal'] ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 	  
?>
<table width="62" height="56" border="0" align="center">
        <tr>
               <td width="56"><form  action="Agri_deleted_xls.php" method="post">
                 <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                 <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
               </form></td>
        </tr>
      </table>
           <br />
      <table width="88%"  align="center" class="my-table" >
             <tr align="center" class="text1">
               <td colspan="3" bgcolor="#999999">بهره بردار<span class="style2"></span></td>
               <td rowspan="2" bgcolor="#999999">پیش بینی تولید</td>
               <td colspan="2" bgcolor="#999999">سطح زیر کشت </td>
               <td rowspan="2" bgcolor="#999999">نام محصول</td>
               <td width="4%" rowspan="2" bgcolor="#999999">نوع کشت </td>
               <td width="4%" rowspan="2" bgcolor="#999999">تاریخ ثبت</td>
               <td width="5%" rowspan="2" bgcolor="#999999">تاریخ حذف / ویرایس</td>
               <td width="5%" rowspan="2" bgcolor="#999999">نوع عملیات</td>
               <td width="11%" rowspan="2" bgcolor="#999999">آبادی/شهر</td>
               <td width="9%" rowspan="2" bgcolor="#999999">مرکز</td>
               <td width="11%" rowspan="2" bgcolor="#999999">شهرستان</td>
               <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="57" bgcolor="#999999">کد ملی </td>
               <td bgcolor="#999999">نام خانوادگی</td>
               <td bgcolor="#999999">نام </td>
               <td bgcolor="#999999">دوم </td>
               <td bgcolor="#999999">اول</td>
              </tr>
               <?php
$start=0;
$limit=25;
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$start=($id-1)*$limit;
   $query = "SELECT Type_Op,del_rec.date_s,del_rec.add_abadi,del_rec.add_city,del_rec.no_kesh,del_rec.zer_kesht_a,del_rec.zer_kesht_b,del_rec.mah_tolp,
   del_rec.Date,del_rec.sal,del_rec.mor_cod_m,del_rec.bah_cod_m,del_rec.cod_mah,users.city,users.markaz,users.name,users.last_name 
FROM del_rec
inner join users On del_rec.mor_cod_m = users.username
 WHERE del_rec.Table_name = '$Agri_prod_table' and  users.username = '$user_check' ORDER BY del_rec.Date DESC LIMIT $start, $limit " ;
  $query1 = "SELECT count(*) FROM del_rec
inner join users On del_rec.mor_cod_m = users.username
 WHERE del_rec.Table_name = '$Agri_prod_table'  and users.username = '$user_check' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = $start+1 ;
 foreach($stmt as $row){
 if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
 if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 
 if ($row['Type_Op']=='1') $v_Type_Op='حذف' ;	 
 if ($row['Type_Op']=='2') $v_Type_Op='ویرایش' ;	 

?>
             <tr>
               <td width="5%" height="42"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m']?></td>
               <td width="5%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_last_name($row['bah_cod_m'])?></td>
               <td width="4%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_first_name($row['bah_cod_m'])?></td>
               <td width="4%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tolp']*1?></td>
               <td width="4%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_b']*1?></td>
               <td width="4%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a']*1?></td>
               <td width="5%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  mah_name($row['cod_mah'])?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo $v_no_kesh?></span></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['date_s']?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['Date']?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $v_Type_Op?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></span></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['markaz']?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city']?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
   <?php }  
 
?>
<div   style=" text-align:right;height:80px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
<?php   
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> fetchColumn();
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="Agri_deleted.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="z_sal"    value="<?php echo $z_sal ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="Agri_deleted.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="z_sal"    value="<?php echo $z_sal ;?>" />
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
      <li class='current'><form  action="Agri_deleted.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="z_sal"    value="<?php echo $z_sal ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
          <p><a href="./index" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
      <!-- فاصله --></td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>