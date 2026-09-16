<?php 
session_start();
include('../../../lock_p2.php');
include('../../../event.php');
 $add_abadi = $_POST['add_abadi']   ;
 $g_tah  = $_POST['g_tah'] ;
 $no_oz  = $_POST['no_oz'] ;
 $sal_z  = $_POST['sal_z']  ;      
 $no_ham = $_POST['no_ham']  ;      
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
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
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../../files/images/header.jpg" width="100%" height="149" /></td>
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
             <p> <span class="style8"><a name="1" id="1"></a>لیست مددکاران ترویجی / تسهیلگران مرکز </span></p>
             <div style="width: 550px;border: 2px solid #930 ;padding: 2px;margin: auto;border-radius:15px; bgcolor="#CCCCCC"" >
             <table width="100%" height="250" border="0" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td height="50" colspan="3"><div align="right"><span style="text-align: right">
                   <select  name="add_abadi"  class="input_text" id="add_abadi" style="width:150px ; height:40px" tabindex="1" dir="rtl"   >
                     <option value="0" >انتخاب نام آبادی </option>
                     <?php
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE  id_mar = '$id_mar' ORDER BY BINARY abadi "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$_POST["add_abadi"]) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                     <?php }?>
                     </select>
                   </span></div>
                  </td>
                 <td width="22%" height="50"><div align="right"><span style=" margin-right:15px;text-align: right">:
                   نام آبادی</span></div></td>
               </tr>
               <tr>
                 <td><div align="right">
                   <select name="no_ham"  class="input_text mar required" id="no_ham"  style="height:40px ; width:120px ; direction:rtl" tabindex="3">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($no_ham=='1') echo 'selected=selected'?>>مددکار ترویجی</option>
                     <option value="2" <?php if ($no_ham=='2') echo 'selected=selected'?>>تسهیلگر روستایی</option>
                   </select>
                 </div></td>
                 <td><div align="right"><span style="  margin-right:15px;text-align: right">:نوع همکاری</span></div></td>
                 <td height="48"><div align="right">
                   <select name="g_tah" class="input_text  required" id="no_mal" style="height:40px ; width:150px ; direction:rtl" tabindex="2">
                     <option value="">انتخاب کنید</option>
                     <option value="1"  <?php if ($g_tah=='1') echo 'selected=selected'?>>امور دام </option>
                     <option value="2"  <?php if ($g_tah=='2') echo 'selected=selected'?>>دامپزشکی</option>
                     <option value="3"  <?php if ($g_tah=='3') echo 'selected=selected'?>>زراعت و باغبانی</option>
                     <option value="4"  <?php if ($g_tah=='4') echo 'selected=selected'?>>شیلات و آبزیان</option>
                     <option value="5"  <?php if ($g_tah=='5') echo 'selected=selected'?>>منابع طبیعی و آبخیزداری</option>
                     <option value="6"  <?php if ($g_tah=='6') echo 'selected=selected'?>>آب و خاک</option>
                     <option value="7"  <?php if ($g_tah=='7') echo 'selected=selected'?>>مکانیزاسیون کشاورزی</option>
                     <option value="8"  <?php if ($g_tah=='8') echo 'selected=selected'?>>صنایع تبدیلی و تکمیلی</option>
                     <option value="9"  <?php if ($g_tah=='9') echo 'selected=selected'?>>ترویج و آموزش کشاورزی</option>
                     <option value="10" <?php if ($g_tah=='10') echo 'selected=selected'?>>غیر کشاورزی</option>
                     <option value="11" <?php if ($g_tah=='11') echo 'selected=selected'?>>اعلام نشده</option>
                     <option value="12" <?php if ($g_tah=='12') echo 'selected=selected'?>>فاقد مدرک دانشگاهی</option>
                     </select>
                 </div></td>
                 <td height="48"><div align="right"><span style="  margin-right:15px;text-align: right">:گرایش تحصیلی</span></div></td>
               </tr>
               <tr>
                 <td width="28%" height="51"><div align="right"><span style="text-align: right">
                   <select name="no_oz" class="input_text  required" id="no_oz"  style="height:40px ; width:120px ; direction:rtl" tabindex="5">
                     <option value="0" >انتخاب کنید</option>
                     <option value="1" <?php if ($no_oz=='1') echo 'selected=selected'?>>فعال</option>
                     <option value="2" <?php if ($no_oz=='2') echo 'selected=selected'?>>غیرفعال</option>
                     </select>
                   </span></div></td>
                 <td width="21%"><div align="right"><span style="  margin-right:15px;text-align: right">:نوع عضویت</span></div></td>
                 <td width="29%"><div align="right"><span style="text-align: right">
                   <input name="sal_z" type="text" class="input_text" id="sal_z"  placeholder="بعنوان مثال 1395" style="height:35px ; width:100px ; direction:rtl" tabindex="4"value="<?php echo $sal_z ?>" />
                   </span></div></td>
                 <td height="51"><div align="right"><span style="  margin-right:15px;text-align: right">: سال جذب</span></div></td>
               </tr>
               <tr>
                 <td height="84" colspan="4">
                   <p>
                     
                     <input name="action_lise" type="submit" id="action_lise" style="width:100px ; height:40px ; color:#900 ; font-size:14px" tabindex="6" value="جستجو " />
                     <br />
                    <span class="RedTitleSmaller">برای مشاهده لیست کلیه مددکاران  کلید</span> جستجو<span class="RedTitleSmaller"> را بدون انتخاب هیچ یک از آیتم ها کلیک کنید </span></p></td>
               </tr>
             </table></div>
   </form>
<?php 
 if (isset($_POST['action_lise'])) 
 {  
 if ($add_abadi == '0') { $v_add_abadi = 1 ; }else { $v_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($sal_z == '')  { $v_sal_z    = 1  ; }else{ $v_sal_z = "sal_z = '$sal_z'" ;}
 if ($g_tah == '')  { $f_g_tah    = 1  ; }else{ $f_g_tah = "g_tah = '$g_tah'" ;}
 if ($no_oz == '0')  { $f_no_oz    = 1  ; }else{ $f_no_oz = "no_oz = '$no_oz'" ;}
 if ($no_ham == '')  { $f_no_ham  = 1  ; }else{ $f_no_ham = "no_ham = '$no_ham'" ;}
    include('../../../login/config.php');
 $query = "SELECT * from Eworker where  id_mar = :id_mar and $v_add_abadi and $v_sal_z and $f_g_tah and $f_no_oz  and $f_no_ham ORDER BY cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id_mar'=>$id_mar));
?>
   
      <p class="style1"><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p><form  action="list_Eworker_xls.php" method="post">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="g_tah" value="<?php echo $g_tah ;?>" />
        <input type="hidden" name="no_oz" value="<?php echo $no_oz ;?>" />
        <input type="hidden" name="sal_z" value="<?php echo $sal_z ;?>" />
        <input type="hidden" name="no_ham" value="<?php echo $no_ham ;?>" />

        <button><img src="../../../files/xls.png" title="دانلود فایل اکسل"  width="58" height="62"  alt=""/></button>
      </form></p>
      <table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
        <tr class="text1">
          <td colspan="3" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="6%" rowspan="2" bgcolor="#006699">نوع عضویت</td>
          <td width="13%" rowspan="2" bgcolor="#006699">گرایش تحصیلی</td>
          <td width="12%" rowspan="2" bgcolor="#006699">رشته تحصیلی</td>
          <td width="5%" rowspan="2" bgcolor="#006699">سال جذب</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات </td>
          <td colspan="2" bgcolor="#006699">موقعیت </td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="9%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="13%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="11%" bgcolor="#006699">آبادی</td>
          <td width="9%" bgcolor="#006699">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
if ($row['g_tah']=='1') $v_g_tah='امور دام ' ;	 
if ($row['g_tah']=='2') $v_g_tah='دامپزشکی' ;	 
if ($row['g_tah']=='3') $v_g_tah='زراعت و باغبانی' ;	 
if ($row['g_tah']=='4') $v_g_tah='شیلات و آبزیان' ;	 
if ($row['g_tah']=='5') $v_g_tah='منابع طبیعی و آبخیزداری' ;	 
if ($row['g_tah']=='6') $v_g_tah='آب و خاک' ;	 
if ($row['g_tah']=='7') $v_g_tah='مکانیزاسیون کشاورزی' ;	 
if ($row['g_tah']=='8') $v_g_tah='صنایع تبدیلی و تکمیلی' ;	 
if ($row['g_tah']=='9') $v_g_tah='ترویج و آموزش کشاورزی' ;	 
if ($row['g_tah']=='10') $v_g_tah='غیر کشاورزی' ;	 
if ($row['g_tah']=='11') $v_g_tah='اعلام نشده' ;	 
if ($row['g_tah']=='12') $v_g_tah='فاقد مدرک دانشگاهی' ;	 
if ($row['no_oz']=='1') $v_no_oz='فعال' ;	 
if ($row['no_oz']=='2') $v_no_oz='غیرفعال' ;	 
  ?>
  <?php if($row['id_mar'] == $id_mar) {?>

          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="del_Eworker.php" method="post">
              <input type="hidden" name="m_page" value="liste_Eworker.php" />
              <input type="hidden" name="cod_m" value="<?php echo $row['cod_m']  ;?>" />
              <input type="hidden" name="h_add_abadi" value="<?php echo $add_abadi  ;?>" />
              <input type="hidden" name="h_g_tah" value="<?php echo $g_tah  ;?>" />
              <input type="hidden" name="h_sal_z" value="<?php echo $sal_z  ;?>" />
              <input type="hidden" name="h_no_oz" value="<?php echo $no_oz  ;?>" />
              <button onclick="return confirm('از حذف اطلاعات مددکار مطمئن هستید ؟ ')"><img src="../../../files/del1.png" title="حذف اطلاعات مددکار ترویجی" width="33" height="26"  alt=""/></button>
            </form>
            </td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
              <form  action="Eworker_edit.php" method="post">
               <input type="hidden" name="m_page" value="liste_Eworker.php" />
              <input type="hidden" name="add_abadi"  value="<?php echo $row['add_abadi'] ;?>" />
              <input type="hidden" name="cod_m" value="<?php echo $row['cod_m']  ;?>" />
              <input type="hidden" name="h_add_abadi" value="<?php echo $add_abadi  ;?>" />
              <input type="hidden" name="h_g_tah" value="<?php echo $g_tah  ;?>" />
              <input type="hidden" name="h_sal_z" value="<?php echo $sal_z  ;?>" />
              <input type="hidden" name="h_no_oz" value="<?php echo $no_oz  ;?>" />
              <input type="hidden" name="m_poul" value="<?php echo 'abadi' ;?>" />
              <button><img src="../../../files/edit.png" title="ویرایش اطلاعات مددکار" width="33" height="26"  alt=""/></button>
            </form>
           </td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <form  action="Eworker_view.php" method="post">
              <input type="hidden" name="m_page" value="liste_Eworker.php" />
              <input type="hidden" name="cod_m" value="<?php echo $row['cod_m']  ;?>" />
              <input type="hidden" name="h_add_abadi" value="<?php echo $add_abadi  ;?>" />
              <input type="hidden" name="h_g_tah" value="<?php echo $g_tah  ;?>" />
              <input type="hidden" name="h_sal_z" value="<?php echo $sal_z  ;?>" />
              <input type="hidden" name="h_no_oz" value="<?php echo $no_oz  ;?>" />

            <button><img src="../../../files/view.png" title="نمایش اطلاعات مددکار ترویجی"  width="33" height="26"  alt=""/></button>
          </form>
<?php
           }
?>
          
          </td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_oz; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $v_g_tah; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['r_tah']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal_z']; ?></td>
          <td height="71" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['cod_m'],'1')?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
 }
	?>
      </table>
                   

      <p>&nbsp;</p>
           <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../../files/goback.jpg" width="118" height="47"  alt=""/> </a>
          </p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
 <?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>
<?php session_regenerate_id(); ?>
