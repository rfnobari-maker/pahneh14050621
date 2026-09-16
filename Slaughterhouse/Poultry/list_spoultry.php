<?php include('../../lock_expar.php');
include('../../event.php') ;
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی</title>
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
    <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="949" height="149" /></td>
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
  <p>
    <?php 
include('top.php'); 
include ('../../login/config.php');
?>
  </p>
  <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <div style=" width: 500px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style1">اطلاعات مرغداری های صنعتی های تحت پوشش</span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" bgcolor="#DDDDDD" class="input_text" align="right" >
        <form method="post" name="form1" id="form1" >
          <select dir="rtl"  name="id_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
                       <option value="0"> کل منطقه <?php echo $id_aria?></option>
            <?php
$id_ostan = '03' ;
$query = "SELECT id_city,city FROM `aria` WHERE  `id_ostan` = $id_ostan and `id_aria` = $id_aria"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<? echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <? echo $row['city'] ;?></option>
            <?php }?>
          </select>
        </form>
          <? if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
        <td width="163"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
      </tr>
      <tr >
        <td height="23" rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >
          <form method="post" name="form3" id="form3"  action="#1">
            <p>
              <select dir="rtl"  name="id_mar" id="bakh" style="width:170px ; height:40px">
                <option value="0"> نام مرکز</option>
                <?php
$query = "SELECT  id_mar,mar FROM `mar` WHERE  `id_city` = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                <option value="<? echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <? echo $row['mar'] ;?></option>
                <?php }?>
                </select>
              </p>
            <p>
              <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
                        <input type="reset"  value='پاک کردن' style="width:150px ; height:45px" />
              <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
              </p>
            </form></td>
        <td height="47"  align='center' bgcolor="#FFFFFF" class="style8"><font size="2" class="style8">: مرکز خدمات</font></td>
      </tr>
      <tr >
        <td height="29"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
      </tr>
    </table>
</div>

  <p>
  <?php if(isset($_POST['action']))
{
$id_city = $_POST['id_city'] ; 
$id_mar = $_POST['id_mar'] ; 
if ($id_city == 0) { $v_id_city = 'id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
$query = "SELECT spoultry.id_city, spoultry.add_abadi,spoultry.add_city,spoultry.no_bah,spoultry.bah_cod_m,spoultry.no_moj,spoultry.z_unit,spoultry.mor_cod_m,spoultry.id
FROM spoultry
INNER JOIN aria ON spoultry.id_city = aria.id_city
WHERE aria.id_aria='$id_aria' and aria.id_ostan='$id_ostan' and  spoultry.$v_id_city and spoultry.$v_id_mar 
ORDER BY BINARY spoultry.id_city,spoultry.add_city,spoultry.add_abadi ASC ";
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style21"><a name="1" id="1"></a></span>
  <table width="200" height="56" border="0" align="center">
    <tr>
      <td><form  action="list_poultry_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $_POST['id_city'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $_POST['id_mar'] ;?>" />
        <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="58" height="59"  alt=""/></button>
      </form></td>
      <td><form  action="list_poultry_doc.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $_POST['id_city'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $_POST['id_mar'] ;?>" />
        <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="58" height="59"  alt=""/></button>
      </form></td>
       </tr>
  </table>
  </p>
  <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#CCCCCC'>
    <tr class="text1">
      <td rowspan="2" bgcolor="#006699">عملیات</td>
      <td width="9%" height="54" rowspan="2" bgcolor="#006699">کارشناس<br />
        مروج</td>
      <td width="8%" rowspan="2" bordercolor="#FFFFFF" bgcolor="#006699">ظرفیت</td>
      <td width="10%" rowspan="2" bordercolor="#FFFFFF" bgcolor="#006699">نوع مجوز</td>
      <td height="36" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
      <td width="8%" rowspan="2" bgcolor="#006699"><p>نوع بهره برداری</p></td>
      <td colspan="2" bgcolor="#006699">موقعیت مرغداری</td>
      <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
    </tr>
    <tr class="text1">
      <td width="8%" height="45" bgcolor="#006699">کد ملی </td>
      <td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
      <td width="10%" bgcolor="#006699">شهر/آبادی</td>
      <td width="9%" bgcolor="#006699">شهرستان</td>
      </tr>
    <tr>
      <?php 
	  $r = 1 ;
	   foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
if ($row['no_bah']=='1') $v_no_bah='مرغ گوشتی' ;	 
if ($row['no_bah']=='2') $v_no_bah='مرغ تخمگذار' ;	 
if ($row['no_bah']=='3') $v_no_bah='مادر گوشتی' ;	 
if ($row['no_bah']=='4') $v_no_bah='مادر تخمگذار' ;	 
if ($row['no_bah']=='5') $v_no_bah='اجداد گوشتی' ;	 
if ($row['no_bah']=='6') $v_no_bah='اجداد تخمگذار' ;	 
if ($row['no_bah']=='7') $v_no_bah='پولت تخمگذار' ;	 
if ($row['no_bah']=='8') $v_no_bah='جوجه کشی' ;	 
if ($row['no_bah']=='9') $v_no_bah='شترمرغ مولد' ;	 
if ($row['no_bah']=='10') $v_no_bah='شترمرغ پرواری' ;	 
if ($row['no_bah']=='11') $v_no_bah='بوقلمون مولد' ;	 
if ($row['no_bah']=='12') $v_no_bah='بوقلمون گوشتی' ;	 
if ($row['no_bah']=='13') $v_no_bah='بلدرچین' ;	 
if ($row['no_bah']=='14') $v_no_bah='کبک' ;	 
if ($row['no_bah']=='15') $v_no_bah='پرندگان زینتی' ;	 
if ($row['no_bah']=='16') $v_no_bah='سایر ماکیان' ;	 
if ($row['no_moj']=='1') $v_no_moj='پروانه بهره برداری' ;	 
if ($row['no_moj']=='2') $v_no_moj='کارت شناسائی' ;	 
if ($row['no_moj']=='3') $v_no_moj='فاقد مجوز' ;	 
  ?>
      <td width="6%" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="view_list_spoultry.php" method="post">
        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
        <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
        <button><img src="../../files/view.png" title="نمایش اطلاعات مرغداری"  width="33" height="40"  alt=""/></button>
      </form></td>
      <td height="81" class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><img id="img1" src="../../files/users/<? echo $pic ?>" width="37" height="43"  alt=""/><br />
        <?php echo user_name($row['mor_cod_m'])?><br/>
        <?php echo $row['mor_cod_m']?><br />
        <?php echo user_tel($row['mor_cod_m'])?><br />
      </p></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_unit']; ?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_moj ?></td>
      <td height="81" class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name($row['bah_cod_m'])?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name($row['id_city']); ?></td>
      <td class="normalTextSmall"<? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
       <?php 
	   $r++ ; 
}
?>
  </table>
  <p align="right" class="input_text" style="margin-right:20px">&nbsp;</p>
  <p>
    <?php }?>
    
  </p>
  <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a>
      </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
  <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><p class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 34438000-6 041 فکس: 334439940 041<br />
          <span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</table>
</body>
</html>



