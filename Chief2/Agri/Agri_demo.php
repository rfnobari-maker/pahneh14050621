<?php 
include("../../lock_ce.php");
include_once("../../event.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
	text-align: center;
}

    </style>

</head>
<body>
  <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      </p>
<form  id="reg-form" method="post" action="#1">
  <p>&nbsp;</p>
  <div style="width: 450px; padding: 5px; border: 3px solid navy; margin: auto; text-align: left; border-radius:15px" >
    <table width="100%" height="154" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="48" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style8"> کشت کلزار در شهرستان خداآفرین</span><span class="style8"><a name="1" id="1"></a></span></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
            <option value="1397-1398" <?php if (isset($z_sal) && $z_sal=='1397-1398') echo 'selected=selected'?>>1397-1398</option>
            </select>
          </div></td>
        <td width="112"  align='center' bgcolor="#FFFFFF" class="style11"><span class="input_text"><font size="2" class="style8">: سال زراعی</font></span></td>
      </tr>
      <tr >
        <td align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
        <td height="60"  align='center' bgcolor="#FFFFFF" class="style11">&nbsp;</td>
      </tr>
    </table>
  </div>
</form>
<?php 
   if (isset($_POST['z_sal']))
   {
?>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
            <span class="style8">به تفکیک  برش مرکز جهاد کشاورزی </span></p>
           <table width="85%" height="177" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td width="20%" height="57" bgcolor="#999999">تراز<span class="style2"><br />
                هکتار               </span></td>
               <td width="24%" bgcolor="#999999">سطح زیر کشت<br />
                <span class="style2">هکتار</span></td>
               <td width="21%" bgcolor="#999999">تعهد کشت<br />
                <span class="style2">هکتار</span></td>
               <td width="26%" bgcolor="#999999">نام مرکز </td>
               <td width="9%" bgcolor="#999999">ردیف</td>
             </tr>
             <tr>
               <?php
 $query = "SELECT sum(demo.m_tah) as mar_m_tah,demo.id_mar,mar.mar
  FROM demo
  inner join mar ON demo.id_mar = mar.id_mar 
   group by demo.id_mar  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td height="59" <?php if((m_mar($row['id_mar']) - $row['mar_m_tah']) >= 0)   echo 'bgcolor=#0C3' ;  else echo 'bgcolor=#F63' ?> >
			   <?php echo m_mar($row['id_mar']) - $row['mar_m_tah']  ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo m_mar($row['id_mar']) ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['mar_m_tah'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['mar'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
            <tr>
               <td height="59" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo m_city('03','26') - 410  ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo m_city('03','26') ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo 410 ?></td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >کل شهرستان </td>
             </tr>
     </table>
           </div>
           <p>&nbsp;</p>
           <p>&nbsp;</p>
           <p><span class="style8">به تفکیک برش کارشناس پهنه </span></p>
           <table width="85%" height="122" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td rowspan="2" bgcolor="#999999">تراز<br />
                 <span class="style2">هکتار</span></td>
               <td rowspan="2" bgcolor="#999999">سطح زیر کشت<br />
                <span class="style2">هکتار</span></td>
               <td rowspan="2" bgcolor="#999999">تعهد کشت<br />
                <span class="style2">هکتار</span></td>
               <td height="37" colspan="4" bgcolor="#999999">مشخصات کارشناس پهنه<span class="style2"></span></td>
               <td width="16%" rowspan="2" bgcolor="#999999">نام مرکز  </td>
               <td width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="38" bgcolor="#999999">شماره همراه</td>
               <td bgcolor="#999999">کد ملی </td>
               <td bgcolor="#999999">نام و نام خانوادگی</td>
               <td width="5%" bgcolor="#999999">تصویر</td>
              </tr>
             <tr>
               <?php
$query = "SELECT demo.*,users.pic,users.name,users.last_name,users.pic,users.tel_m,mar.mar
 from demo
 left join users ON users.username = demo.mor_cod_m
 left join mar ON mar.id_mar = demo.id_mar
    order by demo.id_mar "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
	 $pic =   $row['pic'] ;
	 $mor_cod_m = $row['mor_cod_m'] ;
?>
               <td width="10%" height="45"   <?php if((m_mor($mor_cod_m) - $row['m_tah']) >= 0)   echo 'bgcolor=#0C3' ;  else echo 'bgcolor=#F63' ?>><?php echo m_mor($mor_cod_m) - $row['m_tah']  ?></td>
               <td width="10%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo m_mor($mor_cod_m)?></td>
               <td width="11%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah']?></td>
               <td width="10%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tel_m']?></td>
               <td width="13%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mor_cod_m?></td>
               <td width="19%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name']."&nbsp;"?><?php echo $row['last_name']?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller"><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/></span></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['mar']?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
           </table>
           <?php }?>
<p>
<p> 
<p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
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
 function m_mar($id_mar)
{
include ('../../login/config.php') ;
  $query = "SELECT sum(zer_kesht_a) as mar_zer_kesht_a FROM  Agri_prod
   where id_mar = '$id_mar' and cod_mah= '246' and z_sal = '1397-1398'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_mar =  $row['mar_zer_kesht_a'] ;
if(is_null($m_mar)) $m_mar= 0 ; 
return($m_mar*1) ; 
}
?>
<?php
 function m_city($id_ostan,$id_city)
{
include ('../../login/config.php') ;
  $query = "SELECT sum(zer_kesht_a) as mar_zer_kesht_a FROM  Agri_prod
   where id_ostan = '$id_ostan' and id_city = '$id_city' and cod_mah= '246' and z_sal = '1397-1398'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_mar =  $row['mar_zer_kesht_a'] ;
if(is_null($m_mar)) $m_mar= 0 ; 
return($m_mar*1) ; 
}
?>
<?php
 function m_mor($mor_cod_m)
{
include ('../../login/config.php') ;
   $query = "SELECT sum(zer_kesht_a) as mar_zer_kesht_a FROM  Agri_prod
   where mor_cod_m = '$mor_cod_m' and cod_mah= '246' and z_sal = '1397-1398'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_mar =  $row['mar_zer_kesht_a'] ;
if(is_null($m_mar)) $m_mar= 0 ; 
return($m_mar*1) ; 
}
?>

