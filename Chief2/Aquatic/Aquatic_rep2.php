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
        <p class="style1">گزارش عملکرد تولید  مزارع پرورش و تکثیر آبزیان</p>
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
                    <option value="1403"<?php if ($sal=='1403') echo 'selected=selected'?>>1403</option>
                    <option value="1402"<?php if ($sal=='1402') echo 'selected=selected'?>>1402</option>
                    <option value="1401"<?php if ($sal=='1401') echo 'selected=selected'?>>1401</option>
                    <option value="1400"<?php if ($sal=='1400') echo 'selected=selected'?>>1400</option>
                    <option value="1399"<?php if ($sal=='1399') echo 'selected=selected'?>>1399</option>
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
 $query = "SELECT id_ostan,sum(tak1) as tak1,sum(tak2) as tak2,sum(tak3) as tak3,sum(tak4) as tak4,sum(tak5) as tak5
 ,sum(par1) as par1 ,sum(par2) as par2,sum(par3) as par3,sum(par4) as par4
 FROM Aquatic WHERE sal = '$sal' group by id_ostan 
 ORDER BY  FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21')
 "  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT id_city,sum(tak1) as tak1,sum(tak2) as tak2,sum(tak3) as tak3,sum(tak4) as tak4,sum(tak5) as tak5
 ,sum(par1) as par1 ,sum(par2) as par2,sum(par3) as par3,sum(par4) as par4 FROM Aquatic WHERE sal = '$sal' and id_ostan = '$id_ostan1' group by id_city "  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
        <span class="style21"><a name="1" id="1"></a></span>
        <table width="69" height="56" border="0" align="center">
          <tr>
            <td width="63"><form  action="Aquatic_rep2_xls.php" method="post">
              <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
              <input type="hidden" name="sal" value="<?php echo  $sal ;?>" />
              <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
            </form></td>
            </tr>
        </table>
        <table width="99%" height="279" border="1" bordercolor="#00CCFF" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="25" colspan="4" bgcolor="#999999">پرورش<span class="style2"><br /> 
                تن</span><br /></td>
               <td colspan="5" bgcolor="#999999">تکثیر<span class="style2"> <br />
                هزار قطعه</span><br /></td>
               <td width="14%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?><br /></td>
    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
             <tr align="center" class="text1">
               <td width="8%" bordercolor="#0099CC" bgcolor="#999999">میگوی و<br />
                 شاه میگو<br /></td>
               <td width="8%" bordercolor="#0099CC" bgcolor="#999999">قزل آلا <br /></td>
               <td width="9%" bordercolor="#0099CC" bgcolor="#999999">ماهیان کپور <br /></td>
               <td width="11%" bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
               <td width="10%" height="43" bordercolor="#0099CC" bgcolor="#999999">ماهیان زینتی<br /></td>
               <td width="9%" bordercolor="#0099CC" bgcolor="#999999">میگوی و<br />
                شاه میگو<br /></td>
               <td width="8%" bordercolor="#0099CC" bgcolor="#999999">قزل آلا <br /></td>
               <td width="9%" bordercolor="#0099CC" bgcolor="#999999">ماهیان کپور <br /></td>
               <td width="10%" bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
              </tr>
             <tr>
               <?php
$r = 1 ;
  foreach($stmt as $row){
	  if($row['no_fa'] == '1') $v_no_fa = 'تکثیر' ; 
	  if($row['no_fa'] == '2') $v_no_fa = 'پرورش' ; 
  	  if($row['no_fa'] == '3') $v_no_fa = 'تکثیر و پرورش' ; 
 ?>
               
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par4']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par3']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par2']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par1']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak5']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak4']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak3']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak2']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak1']?></td>
               <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >
                 <?php if($id_ostan1=='') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$id_ostan1)  ; ?>
               <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
if ($id_ostan1 == '') 
{
 $query = "SELECT sum(tak1) as tak1,sum(tak2) as tak2,sum(tak3) as tak3,sum(tak4) as tak4,sum(tak5) as tak5
 ,sum(par1) as par1 ,sum(par2) as par2,sum(par3) as par3,sum(par4) as par4 FROM Aquatic WHERE sal = '$sal' 
 ORDER BY no_fa
 "  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT sum(tak1) as tak1,sum(tak2) as tak2,sum(tak3) as tak3,sum(tak4) as tak4,sum(tak5) as tak5
 ,sum(par1) as par1 ,sum(par2) as par2,sum(par3) as par3,sum(par4) as par4 FROM Aquatic WHERE sal = '$sal' and id_ostan = '$id_ostan1'  "  ;
}
?>
             <tr align="center" class="text1">
               <td height="25" colspan="4" bgcolor="#999999">پرورش<span class="style2"><br />
                 تن</span><br /></td>
               <td colspan="5" bgcolor="#999999">تکثیر<span class="style2"> <br />
                 هزار قطعه</span><br /></td>
               <td rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?>
                 <br /></td>
               <td rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td bordercolor="#0099CC" bgcolor="#999999">میگوی و<br />
                 شاه میگو<br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">قزل آلا <br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">ماهیان کپور <br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
               <td height="43" bordercolor="#0099CC" bgcolor="#999999">ماهیان زینتی<br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">میگوی و<br />
                 شاه میگو<br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">قزل آلا <br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">ماهیان کپور <br /></td>
               <td bordercolor="#0099CC" bgcolor="#999999">ماهیان خاویاری<br /></td>
             </tr>

<?php
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

             <tr>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par4']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par3']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par2']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['par1']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak5']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak4']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak3']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak2']?></td>
               <td height="47"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tak1']?></td>
               <td colspan="2"   <?php  echo 'bgcolor=#ffcc99' ?>>مجموع کل</td>
             </tr>
         </table>
<?php }?>
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