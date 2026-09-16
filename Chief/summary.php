<?php 
include('../lock_ce.php');
include('counter.php');
$sal = $_POST['sal'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
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
<?php include_once('../login/config.php');
$query = "SELECT  DISTINCT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style8">فرم های ثبت شده  به تفکیک استان و نوع بهره برداری </p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <p>      <form  id="reg-form" method="post" action="#1">
        <div style="width: 300px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="128" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="142" height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                   <select  name="sal" class="style8" id="sal" style="width:70px ; height:40px" dir="rtl" >
                     <option value=1395 <?php if ($sal==1395) echo 'selected=selected'?>>1395</option>
                     <option value=1396 <?php if ($sal==1396) echo 'selected=selected'?>>1396</option>
                     <option value=1397 <?php if ($sal==1397) echo 'selected=selected'?>>1397</option>
                     <option value=1398 <?php if ($sal==1398) echo 'selected=selected'?>>1398</option>
                     </select>
</td>
                 <td width="158"  align='center' bgcolor="#DDDDDD" class="style8">: انتخاب سال مورد نظر</td>
               </tr>
               <tr >
                 <td height="60" colspan="2" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' />
                   </td>
               </tr>
             </table> 
           </div>
<?php 
              if(isset($_POST['action']))
{
?>
 </form></p>
 <table width="122" height="56" border="0" align="center">
   <tr>
     <td width="56"><form  action="summary_xls.php" method="post">
       <input type="hidden" name="sal"  value="<?php echo  $sal ;?>" />
       <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
     </form></td>
     <td width="56"><form  action="summary_doc.php" method="post">
       <input type="hidden" name="sal"  value="<?php echo  $sal ;?>" />
       <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
     </form></td>
   </tr>
 </table>
 <table width="85%" height="237" border="1" bordercolor="#0099FF" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
    <td height="56" colspan="4" bgcolor="#999999">تعداد فرم های های ثبت شده</td>
    <td width="15%" rowspan="2" bgcolor="#999999"> تعداد بهره بردار</td>
    <td width="20%" rowspan="2" bgcolor="#999999">استان </td>
    <td width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td height="56" bgcolor="#999999">آبزی پروری</td>
    <td bgcolor="#999999">گلخانه</td>
    <td bgcolor="#999999">باغی</td>
    <td width="15%" bgcolor="#999999">زراعی</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
$id_ostan = $row['id_ostan'] ;
$query2 = "SELECT id,username,tel_m,cod_m,Last_name,name,pic FROM  users WHERE  id_ostan = '$id_ostan' and  chief = '1' "  ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
//echo $row2['User_Name'] ; 
?>
  <td width="15%" height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Aquatic_count($row['id_ostan'],$sal) ?></td>
    <td width="16%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Greenhous_count($row['id_ostan'],$sal) ?></td>
    <td width="13%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Garden_count($row['id_ostan'],$sal) ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_Agri_count($row['id_ostan'],$sal) ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bah_count($row['id_ostan']);?></td>
    <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['ostan'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
  <tr>
    <td height="44" bgcolor="#CCCCCC"  class="morph"  >آبزی پروری</td>
    <td bgcolor="#CCCCCC"  class="morph"  >گلخانه</td>
    <td bgcolor="#CCCCCC"  class="morph"  >باغی<br />
    </td>
    <td bgcolor="#CCCCCC"  class="morph"  >زراعی</td>
    <td bgcolor="#CCCCCC"  class="morph"  >بهره بردار</td>
    <td colspan="2" rowspan="2" bgcolor="#FFFFCC"   class="morph">جمع کل</td>
    </tr>
  <tr>
    <td height="41" bgcolor="#FFFFCC"  class="normalTextSmaller"  ><?php echo total_Aquatic_count($sal)?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo total_Greenhous_count($sal)?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo total_Garden_count($sal)?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo total_Agri_count($sal)?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmall"  ><?php echo kol_bah_count();?></td>
    </tr>

         </table>
<?php }?>
           <p>&nbsp;</p><p><a href="benef.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>