<?php 
include('../../lock_ce.php');
include('../../event.php');
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if(isset($_POST['sal'])) $sal = $_POST['sal'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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

-->
</style>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="949" height="188" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      </p>
        <p class="style1">آمار مزارع پرورش و تکثیر آبزیان</p>
        <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
        <div style=" width: 400px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1 ; border-radius:10px" >
          <form method="post" name="form1" id="form"  action="#1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="55%" height="68"><div align="right">
                  <select  name="id_ostan" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
                   <option value="">کل کشور</option>
                    <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                    <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
                    <?php 
		   }?>
                  </select>
                </div></td>
                <td width="45%" class="style8">:  استان مورد نظر</td>
              </tr>
              <tr>
                <td height="68"><div align="right">
                  <select name="sal" class="input_text  required" id="sal" style="height:40px ; width:170px ; direction:rtl">
                    <option value="1398"<?php if ($sal=='1398') echo 'selected=selected'?>>1398</option>
                    <option value="1397"<?php if ($sal=='1397') echo 'selected=selected'?>>1397</option>
                  </select>
                </div></td>
                <td class="style8"> : سال </td>
              </tr>
            </table>
            <p>
              <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
            </p>
          </form>
        </div>
        <p>
  <?php if(isset($_POST['action']) and (isset($_POST['sal'])))
{
	include('../../login/config.php');
$sal = $_POST['sal'];
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if ($id_ostan1 == '') 
{
 $query = "SELECT id_ostan,ostan FROM ostanname WHERE 1 ORDER BY  FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21') "  ;  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT id_ostan,id_city,city FROM cityname WHERE id_ostan = '$id_ostan1'  "  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
        <span class="style21"><a name="1" id="1"></a></span>
        <table width="69" height="56" border="0" align="center">
          <tr>
            <td width="63"><form  action="Aquatic_rep10_xls.php" method="post">
              <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
              <input type="hidden" name="sal" value="<?php echo  $sal ;?>" />
              <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
            </form></td>
            </tr>
        </table>
        <table width="85%" height="227" border="1" bordercolor="#00CCFF" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="45" colspan="2" bgcolor="#999999" class="style19">جمع</td>
               <td height="45" colspan="2" bgcolor="#999999" class="style19">تکثیر و پرورش</td>
               <td colspan="2" bgcolor="#999999" class="style19">پرورش</td>
               <td colspan="2" bgcolor="#999999" class="style19">تکثیر</td>
               <td width="13%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?><br /></td>
    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
             <tr align="center" class="text1">
               <td width="16%" height="67" bgcolor="#999999">مساحت زمین<br />
                 <span class="style8">مترمربع</span></td>
               <td width="6%" bgcolor="#999999">تعداد واحد</td>
               <td width="17%" height="67" bgcolor="#999999">مساحت زمین<br />
                 <span class="style8">مترمربع</span></td>
               <td width="6%" bgcolor="#999999">تعداد واحد</td>
               <td width="14%" bgcolor="#999999">مساحت زمین<br />
                 <span class="style8">مترمربع</span></td>
               <td width="6%" bgcolor="#999999">تعداد واحد</td>
               <td width="13%" bgcolor="#999999">مساحت زمین<br />
                <span class="style8">مترمربع</span></td>
               <td width="5%" bgcolor="#999999">تعداد واحد</td>
             </tr>
             <tr>
               <?php
$r = 1 ;
  foreach($stmt as $row){
if($id_ostan1=='') {
 $id_ostan = $row['id_ostan'] ; 
 $shart = "id_ostan = '$id_ostan' " ; 
 $shart2 = 1 ; 
}
if($id_ostan1 !='') {
 $id_ostan = $row['id_ostan'] ; 
 $id_city = $row['id_city'] ; 
 $shart = "id_ostan = '$id_ostan' and id_city = '$id_city' " ; 
 $shart2 = "id_ostan = '$id_ostan'" ; 
}
 ?>
               <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo sum_zamin_t($sal,$shart) ; ?></td>
               <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo unit_count_t($sal,$shart) ; ?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo sum_zamin('3',$sal,$shart) ; ?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo unit_count('3',$sal,$shart) ; ?></td>
               <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo sum_zamin('2',$sal,$shart) ; ?></td>
               <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php  echo unit_count('2',$sal,$shart) ; ?></td>
               <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall">
                 <?php  echo sum_zamin('1',$sal,$shart) ; ?>
               </span></td>
               <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall">
                <?php  echo unit_count('1',$sal,$shart) ; ?>
               </span></td>
               <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >
                 <?php if($id_ostan1=='') echo $row['ostan'] ;  else echo $row['city']  ; ?>
               <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}

?>
  <tr>
    <td  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo sum_zamin_fa_tt($sal,$shart2) ; ?></td>
    <td  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo unit_count_fa_tt($sal,$shart2) ; ?></td>
    <td height="46"  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo sum_zamin_fa_t('3',$sal,$shart2) ; ?></td>
    <td height="46"  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><?php  echo unit_count_fa_t('3',$sal,$shart2) ; ?></td>
    <td  class="normalTextSmall" <?php  echo 'bgcolor=#ffcc99' ?>><?php  echo sum_zamin_fa_t('2',$sal,$shart2) ; ?></td>
    <td  class="normalTextSmall" <?php  echo 'bgcolor=#ffcc99' ?>><?php  echo unit_count_fa_t('2',$sal,$shart2) ; ?></td>
    <td  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><span class="normalTextSmall">
      <?php  echo sum_zamin_fa_t('1',$sal,$shart2) ; ?>
    </span></td>
    <td  class="normalTextSmall" <?php   echo 'bgcolor=#ffcc99' ?>><span class="normalTextSmall">
      <?php  echo unit_count_fa_t('1',$sal,$shart2) ; ?>
    </span></td>
    <td colspan="2"   <?php  echo 'bgcolor=#ffcc99' ?>><span class="style19">جمع کل</span></td>
  </tr>
  <?php }?>
        </table>
       <p>&nbsp;</p>
       <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php
function unit_count($no_fa,$sal,$shart)
{
include('../../login/config.php');
 $query = "SELECT count(*) FROM  Aquatic  WHERE  no_fa = '$no_fa' and sal = '$sal' and $shart " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$unit_count = $stmt->fetchColumn();
return $unit_count ; 	

}
function unit_count_t($sal,$shart)
{
include('../../login/config.php');
$query = "SELECT count(*) FROM  Aquatic  WHERE  sal = '$sal' and $shart " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$unit_count_t = $stmt->fetchColumn();
return $unit_count_t ; 	

}

function sum_zamin($no_fa,$sal,$shart)
{
include ('../../login/config.php') ;
 $query = "SELECT sum(m_zamin) as m_zamin FROM Aquatic WHERE  no_fa = '$no_fa' and sal = '$sal' and $shart " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_zamin = $row['m_zamin'] ; 
return $m_zamin ;

}
function sum_zamin_t($sal,$shart)
{
include ('../../login/config.php') ;
 $query = "SELECT sum(m_zamin) as m_zamin FROM Aquatic WHERE   sal = '$sal' and $shart " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_zamin = $row['m_zamin'] ; 
return $m_zamin ;

}
function unit_count_fa_t($no_fa,$sal,$shart2)
{
include('../../login/config.php');
 $query = "SELECT count(*) FROM  Aquatic  WHERE  no_fa = '$no_fa' and sal = '$sal' and $shart2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$unit_count = $stmt->fetchColumn();
return $unit_count ; 	

}
function unit_count_fa_tt($sal,$shart2)
{
include('../../login/config.php');
 $query = "SELECT count(*) FROM  Aquatic  WHERE  sal = '$sal' and $shart2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$unit_count = $stmt->fetchColumn();
return $unit_count ; 	

}
function sum_zamin_fa_t($no_fa,$sal,$shart2)
{
include ('../../login/config.php') ;
 $query = "SELECT sum(m_zamin) as m_zamin FROM Aquatic WHERE  no_fa = '$no_fa' and sal = '$sal' and $shart2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_zamin = $row['m_zamin'] ; 
return $m_zamin ;

}
function sum_zamin_fa_tt($sal,$shart2)
{
include ('../../login/config.php') ;
 $query = "SELECT sum(m_zamin) as m_zamin FROM Aquatic WHERE   sal = '$sal' and $shart2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_zamin = $row['m_zamin'] ; 
return $m_zamin ;

}

?>