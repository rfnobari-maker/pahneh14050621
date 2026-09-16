<?php 
include('../../lock_p1.php');
include('../../event.php');
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $no_mtol = $_POST['no_mtol'] ;
 $no_mal = $_POST['no_mal'] ;
 $sal = $_POST['sal'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
             <p> <span class="style1">لیست گلخانه های ثبت شده </span></p>
             <table width="450" height="358" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
               <tr>
                 <td width="70%" height="55">
                   <p><span style="text-align: center"></span>
                     <span style="text-align: right"></span>
                     <span style="text-align: right"></span>
                    
                   <div align="right">
                     <select  name="add_city" class="input_text" id="add_city"  style="width:170px ; height:40px" dir="rtl"  >
                       <option value="0" >انتخاب نام شهر </option>
                       <?php
$query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = $login_session"   ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                       <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                       <?php }?>
                     </select>
                   </div>
                </td>
                 <td width="30%"><div align="right"><span style=" margin-right:15px ; text-align: right">: نام شهر</span></div>                 </td>
               </tr>
               <tr>
                 <td height="51"><div align="right"><span style="text-align: right">
                   <select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="0" >انتخاب نام آبادی </option>
                     <?php
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                     <?php }?>
                   </select>
                 </span></div>
                 </td>
                 <td height="51"><div align="right"><span style=" margin-right:15px;text-align: right">:
نام آبادی</span></div></td>
               </tr>
               <tr>
                 <td height="56"><div align="right">
                   <select name="no_mtol" class="input_text  required" id="no_mtol" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="0">انتخاب کنید</option>
                        <option value="1" <?php if ($no_mtol=='1') { echo 'selected="selected"' ; } ?>>سبزی و صیفی</option>
                                        <option value="2" <?php if ($no_mtol=='2') { echo 'selected="selected"' ; } ?>>گل و گیاه زینتی</option>
                        <option value="3" <?php if ($no_mtol=='3') { echo 'selected="selected"' ; } ?>>سایر</option>
                   </select>
                 </div></td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right">:نوع محصول تولیدی</span></div></td>
               </tr>
               <tr>
                 <td height="56"><div align="right">
                   <select name="no_mal" class="input_text  required" id="no_mal" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="0">انتخاب کنید</option>
                     <option value="1" <?php if ($no_mal=='1') { echo 'selected="selected"' ; } ?>>سند ششدانگ</option>
                     <option value="2" <?php if ($no_mal=='2') { echo 'selected="selected"' ; } ?>>سند مشاعی</option>
                     <option value="3" <?php if ($no_mal=='3') { echo 'selected="selected"' ; } ?>>اصلاحات اراضی</option>
                     <option value="4" <?php if ($no_mal=='4') { echo 'selected="selected"' ; } ?>>موقوفه</option>
                     <option value="5" <?php if ($no_mal=='5') { echo 'selected="selected"' ; } ?>>واگذاری</option>
                     <option value="6" <?php if ($no_mal=='6') { echo 'selected="selected"' ; } ?>>قولنامه</option>
                     <option value="7" <?php if ($no_mal=='7') { echo 'selected="selected"' ; } ?>>اجاره</option>
                   </select>
                 </div></td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right">:نوع مالکیت</span></div></td>
               </tr>
               <tr>
                 <td height="56"><div align="right"><span style="text-align: right">
                   <select name="sal" class="input_text  required" id="sal"  style="height:40px ; width:120px ; direction:rtl" tabindex="6">
                     <option value="0">انتخاب کنید</option>
   <option value="1394" <?php if ($sal=='1394') { echo 'selected="selected"' ; } ?>>1394</option>
   <option value="1395" <?php if ($sal=='1395') { echo 'selected="selected"' ; } ?>>1395</option>
   <option value="1396" <?php if ($sal=='1396') { echo 'selected="selected"' ; } ?>>1396</option>
                   </select>
                 </span></div>
                 </td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right">:سال</span></div></td>
               </tr>
               <tr>
                 <td height="84" colspan="2">
                   <p>
                  
                    <input type="submit" name="action" id="action" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
             </p>
                  <p class="style2"><span class="RedTitleSmaller">برای مشاهده لیست کلیه بهره برداری ها کلید</span> جستجو<span class="RedTitleSmaller"> را بدون انتخاب هیچ یک از آیتم ها کلیک کنید </span></p></td>

<?php 
 if (isset($_POST['action'])) 
 {  
 if ($add_abadi == '0') { $v_add_abadi = 'add_abadi = add_abadi'; }else { $v_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city == '0')  { $v_add_city  = 'add_city = add_city'  ; }else{ $v_add_city = "add_city = '$add_city'" ;}
 if ($no_mal == '0')  { $f_no_mal  = 'id = id'  ; }else{ $f_no_mal = "no_mal = '$no_mal'" ;}
 if ($no_mtol == '0')  { $f_no_mtol  = 'id = id'  ; }else{ $f_no_mtol = "no_mtol = '$no_mtol'" ;}
 if ($sal == '0')  { $f_sal  = 'id = id'  ; }else{ $f_sal = "sal = '$sal'" ;}
    include_once('../../login/config.php');
 $query = "SELECT * from Greenhous where  mor_cod_m = :mor_cod_m and $v_add_abadi and $v_add_city and $f_no_mtol and $f_sal and $f_no_mal  ORDER BY mor_cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
                </tr>
             </table>
   </form>
      <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<p align="right"><form  action="Greenhous_xls.php" method="post">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
        <input type="hidden" name="no_mtol" value="<?php echo $no_mtol ;?>" />
        <input type="hidden" name="sal" value="<?php echo $sal ;?>" />
        <button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="58" height="62"  alt=""/></button>
      </form></p>
      <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td colspan="3" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="8%" rowspan="2" bgcolor="#006699">مساحت فضای باز<br />
            <span class="style2">مترمربع</span></td>
          <td width="8%" rowspan="2" bgcolor="#006699">مساحت گلخانه<br />
            <span class="style2">مترمربع</span></td>
          <td width="7%" rowspan="2" bgcolor="#006699">نوع گلخانه</td>
          <td width="11%" rowspan="2" bgcolor="#006699">نوع سازه</td>
          <td width="7%" rowspan="2" bgcolor="#006699">سیستم کشت</td>
          <td width="9%" rowspan="2" bgcolor="#006699">نوع و کلاس محصول تولیدی</td>
          <td width="6%" rowspan="2" bgcolor="#006699">سال</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="2" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="7%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="9%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="9%" bgcolor="#006699">شهر/آبادی</td>
          <td width="7%" bgcolor="#006699">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
if ($row['no_mtol']=='1') $v_no_mtol='سبزی و صیفی' ;	 
if ($row['no_mtol']=='2') $v_no_mtol='گل و گیاه زینتی در فضای گلخانه' ;	 
if ($row['no_mtol']=='4') $v_no_mtol='گل و گیاه زینتی در فضای باز' ;	 
if ($row['no_mtol']=='5') $v_no_mtol='گل و گیاه زینتی در فضای توام' ;	 
if ($row['no_mtol']=='3') $v_no_mtol='سایر' ;	 
	 
if ($row['no_saz']=='1') $v_no_saz='فلزی با پوشش پلاستیکی' ;	 
if ($row['no_saz']=='2') $v_no_saz='فلزی با پوشش پلی کربنات' ;	
if ($row['no_saz']=='3') $v_no_saz='فلزی با پوشش شیشه ای' ;	
if ($row['no_saz']=='4') $v_no_saz='چوبی پلاستیکی' ;	 

if ($row['no_gol']=='1') $v_no_gol='تونلی تک قلو' ;	 
if ($row['no_gol']=='2') $v_no_gol='تونلی به هم پیوسته' ;	
if ($row['no_gol']=='3') $v_no_gol='یک طرفه' ;	
if ($row['no_gol']=='4') $v_no_gol='شیشه ای سقف شیروانی' ;	 

if ($row['sys_kesh']=='1') $v_sys_kesh='خاکی' ;	 
if ($row['sys_kesh']=='2') $v_sys_kesh='هیدروپونیک' ;	 

  ?>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['sal']!='1395') {?>
            <form  action="del_Greenhous.php" method="post">
              <input type="hidden" name="h_add_abadi" value="<?php echo $add_abadi?>" />
              <input type="hidden" name="h_add_city" value="<?php echo $add_city?>" />
              <input type="hidden" name="h_no_mtol" value="<?php echo $no_mtol?>" />
              <input type="hidden" name="h_no_mal" value="<?php echo $no_mal?>" />
              <input type="hidden" name="h_sal" value="<?php echo $sal?>" />
              <input type="hidden" name="m_page" value="liste_Greenhous.php" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
              <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="sal" value="<?php echo $row['sal']  ;?>" />
              <button onclick="return confirm('از حذف اطلاعات این گلخانه مطمئن هستید ؟ ')"><img src="../../files/del1.png" title="حذف اطلاعات گلخانه" width="33" height="26"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['sal']!='1395') {?>
              <form  action="Greenhous_edit.php" method="post">
              <input type="hidden" name="h_add_abadi" value="<?php echo $add_abadi?>" />
              <input type="hidden" name="h_add_city" value="<?php echo $add_city?>" />
              <input type="hidden" name="h_no_mtol" value="<?php echo $no_mtol?>" />
              <input type="hidden" name="h_no_mal" value="<?php echo $no_mal?>" />
              <input type="hidden" name="h_sal" value="<?php echo $sal?>" />
              <input type="hidden" name="m_page" value="liste_Greenhous.php" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="sal" value="<?php echo $row['sal']  ;?>" />
              <input type="hidden" name="m_poul" value="<?php echo $row['m_poul']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="no_mtol" value="<?php echo $row['no_mtol']  ;?>" />
              <input type="hidden" name="no_mal" value="<?php echo $row['no_mal']  ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="num_bah"  value="<?php echo $row['num_bah'] ;?>" />
              <button><img src="../../files/edit.png" title="ویرایش اطلاعات بهره برداری" width="33" height="26"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <form  action="Greenhous_view.php" method="post">
              <input type="hidden" name="h_add_abadi" value="<?php echo $add_abadi?>" />
              <input type="hidden" name="h_add_city" value="<?php echo $add_city?>" />
              <input type="hidden" name="h_no_mtol" value="<?php echo $no_mtol?>" />
              <input type="hidden" name="h_no_mal" value="<?php echo $no_mal?>" />
              <input type="hidden" name="h_sal" value="<?php echo $sal?>" />
              <input type="hidden" name="m_page" value="liste_Greenhous.php" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="sal" value="<?php echo $row['sal']  ;?>" />
              <input type="hidden" name="m_poul" value="<?php echo $row['m_poul']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="no_mtol" value="<?php echo $row['no_mtol']  ;?>" />
              <input type="hidden" name="no_mal" value="<?php echo $row['no_mal']  ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="num_bah"  value="<?php echo $row['num_bah'] ;?>" />
           <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin_baz']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_gol?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_saz ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_sys_kesh  ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mtol ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal'] ?></td>
          <td height="165" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['num_bah'])?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
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
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
 <?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>




