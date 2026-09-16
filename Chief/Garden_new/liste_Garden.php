<?php 
include('../../lock_ce.php');
include('../../event.php');
include_once('Gardennote_status.php');
// آدرس صفحه قبلی 
$p_page = $_SERVER['HTTP_REFERER'] ;
//alert($p_page);
if (isset($_POST['back_p'])) {
    $bah_cod_m = isset($_SESSION['page_date']['p_bah_cod_m']) ? $_SESSION['page_date']['p_bah_cod_m'] : '';
    $add_abadi = isset($_SESSION['page_date']['p_add_abadi']) ? $_SESSION['page_date']['p_add_abadi'] : '';
    $add_city = isset($_SESSION['page_date']['p_add_city']) ? $_SESSION['page_date']['p_add_city'] : '';
    $no_kesh = isset($_SESSION['page_date']['p_no_kesh']) ? $_SESSION['page_date']['p_no_kesh'] : '';
    $nah_kesh = isset($_SESSION['page_date']['p_nah_kesh']) ? $_SESSION['page_date']['p_nah_kesh'] : '';
    $no_mal = isset($_SESSION['page_date']['p_no_mal']) ? $_SESSION['page_date']['p_no_mal'] : '';
    $z_sal = isset($_SESSION['page_date']['p_z_sal']) ? $_SESSION['page_date']['p_z_sal'] : '';
    $ok = isset($_SESSION['page_date']['ok']) ? $_SESSION['page_date']['ok'] : '';
} else {
    unset($_SESSION['page_date']);
    
    // بررسی داده‌های ارسال شده از طریق POST
    $add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
    $add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
    $no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
    $nah_kesh = isset($_POST['nah_kesh']) ? $_POST['nah_kesh'] : '';
    $no_mal = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
    $bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
    $z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
    $ok = isset($_POST['ok']) ? $_POST['ok'] : '';

    include_once('../session_start.php');
    
    $_SESSION['page_date'] = array(
        'p_add_abadi' => $add_abadi,
        'p_add_city' => $add_city,
        'p_bah_cod_m' => $bah_cod_m,
        'p_no_kesh' => $no_kesh,
        'p_nah_kesh' => $nah_kesh,
        'p_no_mal' => $no_mal,
        'p_z_sal' => $z_sal,
        'ok' => $ok
    );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
   <style type="text/css">
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
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
width:50px
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
<script>
    function target_Agri18(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=1200px,height=800px"); 
    form.target = 'formpopup'; 
	}
   </script>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
             <p> <span class="style1">لیست بهره برداری های باغی </span></p>
             <div style="width: 600px; padding: 5px; border: 2px solid navy; margin: auto; text-align: left; border-radius:15px" >
             <table width="100%" height="305" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
               <tr>
                 <td width="30%"><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                     <option value="1405" <?php if ($z_sal=='1405') echo 'selected=selected'?>>1405</option>
                     <option value="1404" <?php if ($z_sal=='1404') echo 'selected=selected'?>>1404</option>
                     <option value="1403" <?php if ($z_sal=='1403') echo 'selected=selected'?>>1403</option>
                     <option value="1402" <?php if ($z_sal=='1402') echo 'selected=selected'?>>1402</option>
                     <option value="1401" <?php if ($z_sal=='1401') echo 'selected=selected'?>>1401</option>
                     <option value="1400" <?php if ($z_sal=='1400') echo 'selected=selected'?>>1400</option>
                     <option value="1399" <?php if ($z_sal=='1399') echo 'selected=selected'?>>1399</option>
                     <option value="1398" <?php if ($z_sal=='1398') echo 'selected=selected'?>>1398</option>
                   </select>
                 </div></td>
                 <td width="23%"><font size="2">: سال </font></td>
                 <td width="29%" height="55">
                   <p><span style="text-align: center"></span>
                     <span style="text-align: right"></span>
                     <span style="text-align: right"></span>
                   <div align="right">
                     <select  name="add_city" class="input_text" id="add_city"  style="width:170px ; height:40px" dir="rtl"  >
                       <option value="" >انتخاب نام شهر </option>
                       <?php
$query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = '$login_session'"   ;
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
                 <td width="18%"><div align="right"><span style=" margin-right:15px ; text-align: right">: نام شهر</span></div>                 </td>
               </tr>
               <tr>
                 <td height="54" align="right" class="input_text" ><div align="right"><span style="text-align: right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
                 </span></div></td>
                 <td width="23%"><font size="2">: کد ملی بهره بردار</font></td>
                 <td height="51"><div align="right"><span style="text-align: right">
                   <select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="" >انتخاب نام آبادی </option>
                     <?php
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session'"  ;
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
                 <td height="56"><div align="right"><span style="text-align: right">
                     <select name="nah_kesh" class="input_text  required" id="nah_kesh"  style="height:40px ; width:170px ; direction:rtl">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if($nah_kesh=="1") echo "selected='selected'"?>>ساده</option>
                     <option value="2" <?php if($nah_kesh=="2") echo "selected='selected'"?>>مخلوط</option>
                     <option value="3" <?php if($nah_kesh=="3") echo "selected='selected'"?>>پراکنده</option>
                   </select>
                 </span></div></td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right">:نحوه کاشت</span></div></td>
                 <td height="56"><div align="right">
                   <select name="no_mal" class="input_text  required" id="no_mal" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($no_mal=='1') { echo 'selected="selected"' ; } ?>>سند ششدانگ</option>
                     <option value="2" <?php if ($no_mal=='2') { echo 'selected="selected"' ; } ?>>سند مشاعی</option>
                     <option value="3" <?php if ($no_mal=='3') { echo 'selected="selected"' ; } ?>>اصلاحات اراضی</option>
                     <option value="4" <?php if ($no_mal=='4') { echo 'selected="selected"' ; } ?>>موقوفه</option>
                     <option value="5" <?php if ($no_mal=='5') { echo 'selected="selected"' ; } ?>>واگذاری</option>
                     <option value="6" <?php if ($no_mal=='6') { echo 'selected="selected"' ; } ?>>قولنامه</option>
                     <option value="7" <?php if ($no_mal=='7') { echo 'selected="selected"' ; } ?>>اجاره</option>
                     <option value="8" <?php if ($no_mal=='8') { echo 'selected="selected"' ; } ?>>سایر</option>                     
                    </select>
                 </div></td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right">:نوع مالکیت</span></div></td>
               </tr>
               <tr>
                 <td><div align="right"><span style="text-align: right">
                   <select  name="ok"  class="input_text" id="ok" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="" <?php if ($ok == '') echo "selected=selected" ?>>همه موارد </option>
                     <option value="4"  <?php if ($ok == '4') echo "selected=selected" ?>>تایید نشده</option>
                     <option value="1" <?php if ($ok == '1') echo "selected=selected" ?>>زنده</option>
                     <option value="2" <?php if ($ok == '2') echo "selected=selected" ?>>فوتی</option>
                   </select>
                 </span></div></td>
                 <td><div align="right"><span style="  margin-right:15px;text-align: right">:وضعیت حیات</span></div></td>
                 <td height="56"><div align="right"><span style="text-align: right">
                   <select name="no_kesh" class="input_text  required" id="no_kesh"  style="height:40px ; width:120px ; direction:rtl" tabindex="6">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if($no_kesh=="1") echo "selected='selected'"?>>آبی</option>
                     <option value="2" <?php if($no_kesh=="2") echo "selected='selected'"?>>دیم</option>
                   </select>
                 </span></div>
                 </td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right">:نوع کشت</span></div></td>
               </tr>
               <tr>
                 <td height="84" colspan="4">
                   <p>
                    <input type="submit" name="action_lise"   id="action_lise" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
             </p>
                  <p class="style2"><span class="RedTitleSmaller">برای مشاهده لیست کلیه بهره برداری ها کلید</span> جستجو<span class="RedTitleSmaller"> را بدون انتخاب هیچ یک از آیتم ها کلیک کنید </span></p></td>
               </tr>
             </table>
             </div>
   </form>

<?php 
 if (isset($_POST['action_lise']) or (isset($back) and $back=='1'))
 {  
//session_destroy();
 if ($add_abadi == '') { $v_add_abadi = 1; }else { $v_add_abadi = "Garden.add_abadi = '$add_abadi'" ;}
 if ($add_city == '')  { $v_add_city  = 1 ; }else{ $v_add_city = "Garden.add_city = '$add_city'" ;}
 if ($no_mal == '')  { $f_no_mal  = 1  ; }else{ $f_no_mal = "Garden.no_mal = '$no_mal'" ;}
 if ($no_kesh == '')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "Garden.no_kesh = '$no_kesh'" ;}
 if ($nah_kesh == '')  { $f_nah_kesh  = 1  ; }else{ $f_nah_kesh = "Garden.nah_kesh = '$nah_kesh'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "Garden.bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "Garden.z_sal = '$z_sal'" ;}
 if ($ok == '')  { $f_ok  = 1  ; }else{ $f_ok = "bah.ok = '$ok'" ;}
$start=0;
$limit=10;
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$start=($id-1)*$limit;
$query = "SELECT Garden.num_bah,Garden.id,Garden.mor_cod_m,Garden.no_mal
,Garden.bah_cod_m,Garden.add_abadi,Garden.add_city,Garden.sh_gat,Garden.z_sal,Garden.no_kesh
,Garden.nah_kesh,Garden.m_zamin,Garden.id_ostan,Garden.id_city,Garden.t_mah 
from bah
INNER JOIN Garden ON Garden.bah_cod_m = bah.bah_cod_m
AND Garden.num_bah = bah.num_bah
 where  Garden.mor_cod_m = '$login_session' and $v_add_abadi and $v_add_city and $f_no_kesh and $f_nah_kesh and $f_no_mal and $v_bah_cod_m and $v_z_sal and $f_ok   LIMIT $start, $limit  "; 
$query1 = "SELECT count(*)
from bah
INNER JOIN Garden ON Garden.bah_cod_m = bah.bah_cod_m
AND Garden.num_bah = bah.num_bah
 where  Garden.mor_cod_m = '$login_session' and $v_add_abadi and $v_add_city and $f_no_kesh and $f_nah_kesh and $f_no_mal and $v_bah_cod_m and $v_z_sal and $f_ok  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      <p class="style1"><span class="style1"><a name="1" id="1"></a></span>      </p>
      <form  action="list_Garden_xls.php" method="post">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
        <input type="hidden" name="nah_kesh" value="<?php echo $nah_kesh ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="ok" value="<?php echo $ok ;?>" />
        <button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="46" height="52"  alt=""/></button>
      </form></p>
      <table  align="center" class="my-table" >
        <tr class="text1">
          <td colspan="5" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="8%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
          هکتار</td>
          <td width="7%" rowspan="2" bgcolor="#006699">نوع کشت</td>
          <td width="11%" rowspan="2" bgcolor="#006699">نوع مالکیت</td>
          <td width="5%" rowspan="2" bgcolor="#006699">شماره قطعه</td>
          <td width="6%" rowspan="2" bgcolor="#006699">سال </td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="2" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="6%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="10%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="9%" bgcolor="#006699">شهر/آبادی</td>
          <td width="9%" bgcolor="#006699">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
 $v_no_mal = '' ; 
if ($row['no_mal']=='') $v_no_mal='-' ;	 
if ($row['no_mal']=='1') $v_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $v_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $v_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $v_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $v_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $v_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $v_no_mal='اجاره' ;	 
if ($row['no_kesh']=='') $v_no_kesh='-' ;	 
if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 
  ?>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['z_sal']=='1405') {?>
            <form  action="del_list_Garden.php" method="post">
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
              <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="sh_gat" value="<?php echo $row['sh_gat']  ;?>" />
              <input type="hidden" name="z_sal" value="<?php echo $row['z_sal']  ;?>" />
              <input type="hidden" name="id_page"  value="<?php echo $id ;?>" />
              <button onclick="return confirm('از حذف اطلاعات باغی و قلمستان مطمئن هستید ؟ ')"><img src="../../files/del1.png" title="حذف اطلاعات باغی" width="33" height="26"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="5%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php if ($row['z_sal']=='1405')  {?>
                    <form action="P_edit1.php" method="post" onsubmit="target_Agri18(this)">
                        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']; ?>" />
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
                        <button><img src="../../files/Pro.png" title="ویرایش اطلاعات محصول" width="30" height="23" alt=""/></button>
                    </form>
                <?php }?></td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['z_sal']=='1405')  {?>
            <form  action="Garden_edit.php" method="post">
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="sh_gat" value="<?php echo $row['sh_gat']  ;?>" />
              <input type="hidden" name="z_sal" value="<?php echo $row['z_sal']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="no_kesh" value="<?php echo $row['no_kesh']  ;?>" />
              <input type="hidden" name="no_mal" value="<?php echo $row['no_mal']  ;?>" />
              <input type="hidden" name="t_mah" value="<?php echo $row['t_mah']  ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="nah_kesh" value="<?php echo $row['nah_kesh']  ;?>" />
              <input type="hidden" name="id_page"  value="<?php echo $id ;?>" />
              <button><img src="../../files/Gar.png" title="ویرایش اطلاعات باغ" width="30" height="23" alt=""/></button>
            </form>
            <?php }?></td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['z_sal']>'1404')  {?>
                              <form action="Garden_note" method="post" onsubmit="target_Agri21(this)">
                        <input type="hidden" name="Garden_id" value=<?php echo $row['id']; ?> />
                        <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
                        <input type="hidden" name="mor_cod_m" value="<?php echo $user_check ?>" />
<button style="display:flex; align-items:center; gap:4px;">
    <?php echo getGardenStatus($z_sal, $row['id']) ?>
    <img src="../../files/add_new.png" title="درج /نمایش توضیح" width="30" height="23" alt=""/>
</button>
                    </form>

          <?php }?></td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <form  action="Gardendata_view.php" method="post">
           <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
           <input type="hidden" name="id_page"  value="<?php echo $id ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mal ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_sal']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['num_bah'])?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}

	?>
      </table>
  <?php   
if(isset($query1)) {
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute();
    $rows = $stmt1->fetchColumn();
    $total = ceil($rows/$limit);
    if($total > 1)
	{
    // تعیین محدوده صفحات برای نمایش
    $visible_pages = 5; // تعداد صفحات قابل مشاهده در هر طرف صفحه فعلی
    $start_page = max(1, $id - $visible_pages);
    $end_page = min($total, $id + $visible_pages);
    
    // اگر صفحه اول در محدوده نیست، لینک صفحه اول را اضافه کنیم
    $show_first = ($start_page > 1);
    // اگر صفحه آخر در محدوده نیست، لینک صفحه آخر را اضافه کنیم
    $show_last = ($end_page < $total);
    ?>
    
    <div class="pagination-container" style="margin-top:20px; text-align:center; height:auto; margin:auto; width:98%; overflow:auto; background-color:#ffffff; color:#06C; font-size:11px; padding:10px; direction:rtl ;   border-radius:15px">
        <ul class="pagination" style="list-style-type:none; padding:0; margin:0; display:flex; justify-content:center; align-items:center; flex-wrap:wrap;">
            <?php if(isset($id) && $id > 1): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <form action="liste_Garden.php?id=<?php echo $id-1 ?>#1" method="post" style="display:inline;">
                        <input type="hidden" name="action_lise" value="1" />
                        <input type="hidden" name="add_abadi" value="<?php echo isset($add_abadi) ? $add_abadi : ''; ?>" />
                        <input type="hidden" name="add_city" value="<?php echo isset($add_city) ? $add_city : ''; ?>" />
                        <input type="hidden" name="no_mal" value="<?php echo isset($no_mal) ? $no_mal : ''; ?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo isset($no_kesh) ? $no_kesh : ''; ?>" />
                        <input type="hidden" name="nah_kesh" value="<?php echo isset($nah_kesh) ? $nah_kesh : ''; ?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo isset($bah_cod_m) ? $bah_cod_m : ''; ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? $z_sal : ''; ?>" />
                        <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">&laquo; قبلی</button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if($show_first): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <form action="liste_Garden.php?id=1#1" method="post" style="display:inline;">
                        <input type="hidden" name="action_lise" value="1" />
                        <input type="hidden" name="add_abadi" value="<?php echo isset($add_abadi) ? $add_abadi : ''; ?>" />
                        <input type="hidden" name="add_city" value="<?php echo isset($add_city) ? $add_city : ''; ?>" />
                        <input type="hidden" name="no_mal" value="<?php echo isset($no_mal) ? $no_mal : ''; ?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo isset($no_kesh) ? $no_kesh : ''; ?>" />
                        <input type="hidden" name="nah_kesh" value="<?php echo isset($nah_kesh) ? $nah_kesh : ''; ?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo isset($bah_cod_m) ? $bah_cod_m : ''; ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? $z_sal : ''; ?>" />
                        <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;">1</button>
                    </form>
                </li>
                <?php if($start_page > 2): ?>
                    <li class="page-item disabled" style="display:inline-block; margin:2px; color:#ccc;">
                        <span style="padding:5px 10px;">...</span>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php for($i = $start_page; $i <= $end_page; $i++): ?>
                <li class="page-item <?php echo ($i == $id) ? 'active' : ''; ?>" style="display:inline-block; margin:2px;">
                    <?php if($i == $id): ?>
                        <span class="current-page" style="background:#06C; color:white; padding:5px 10px; border-radius:4px; display:inline-block;"><?php echo $i; ?></span>
                    <?php else: ?>
                        <form action="liste_Garden.php?id=<?php echo $i ?>#1" method="post" style="display:inline;">
                            <input type="hidden" name="action_lise" value="1" />
                            <input type="hidden" name="add_abadi" value="<?php echo isset($add_abadi) ? $add_abadi : ''; ?>" />
                            <input type="hidden" name="add_city" value="<?php echo isset($add_city) ? $add_city : ''; ?>" />
                            <input type="hidden" name="no_mal" value="<?php echo isset($no_mal) ? $no_mal : ''; ?>" />
                            <input type="hidden" name="no_kesh" value="<?php echo isset($no_kesh) ? $no_kesh : ''; ?>" />
                            <input type="hidden" name="nah_kesh" value="<?php echo isset($nah_kesh) ? $nah_kesh : ''; ?>" />
                            <input type="hidden" name="bah_cod_m" value="<?php echo isset($bah_cod_m) ? $bah_cod_m : ''; ?>" />
                            <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? $z_sal : ''; ?>" />
                            <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $i; ?></button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endfor; ?>
            
            <?php if($show_last): ?>
                <?php if($end_page < $total - 1): ?>
                    <li class="page-item disabled" style="display:inline-block; margin:2px; color:#ccc;">
                        <span style="padding:5px 10px;">...</span>
                    </li>
                <?php endif; ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <form action="liste_Garden.php?id=<?php echo $total ?>#1" method="post" style="display:inline;">
                        <input type="hidden" name="action_lise" value="1" />
                        <input type="hidden" name="add_abadi" value="<?php echo isset($add_abadi) ? $add_abadi : ''; ?>" />
                        <input type="hidden" name="add_city" value="<?php echo isset($add_city) ? $add_city : ''; ?>" />
                        <input type="hidden" name="no_mal" value="<?php echo isset($no_mal) ? $no_mal : ''; ?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo isset($no_kesh) ? $no_kesh : ''; ?>" />
                        <input type="hidden" name="nah_kesh" value="<?php echo isset($nah_kesh) ? $nah_kesh : ''; ?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo isset($bah_cod_m) ? $bah_cod_m : ''; ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? $z_sal : ''; ?>" />
                        <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $total; ?></button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if(isset($id) && $id != $total): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <form action="liste_Garden.php?id=<?php echo $id+1 ?>#1" method="post" style="display:inline;">
                        <input type="hidden" name="action_lise" value="1" />
                        <input type="hidden" name="add_abadi" value="<?php echo isset($add_abadi) ? $add_abadi : ''; ?>" />
                        <input type="hidden" name="add_city" value="<?php echo isset($add_city) ? $add_city : ''; ?>" />
                        <input type="hidden" name="no_mal" value="<?php echo isset($no_mal) ? $no_mal : ''; ?>" />
                        <input type="hidden" name="no_kesh" value="<?php echo isset($no_kesh) ? $no_kesh : ''; ?>" />
                        <input type="hidden" name="nah_kesh" value="<?php echo isset($nah_kesh) ? $nah_kesh : ''; ?>" />
                        <input type="hidden" name="bah_cod_m" value="<?php echo isset($bah_cod_m) ? $bah_cod_m : ''; ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? $z_sal : ''; ?>" />
                        <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">بعدی &raquo;</button>
                    </form>
                </li>
            <?php endif; ?>
        </ul>
        
        <div class="page-jump" style="margin-top:10px;">
            <form id="pageJumpForm" action="liste_Garden.php" method="post" style="display:inline-block;">
                <input type="hidden" name="action_lise" value="1" />
                <input type="hidden" name="add_abadi" value="<?php echo isset($add_abadi) ? htmlspecialchars($add_abadi) : ''; ?>" />
                <input type="hidden" name="add_city" value="<?php echo isset($add_city) ? htmlspecialchars($add_city) : ''; ?>" />
                <input type="hidden" name="no_mal" value="<?php echo isset($no_mal) ? htmlspecialchars($no_mal) : ''; ?>" />
                <input type="hidden" name="no_kesh" value="<?php echo isset($no_kesh) ? htmlspecialchars($no_kesh) : ''; ?>" />
                <input type="hidden" name="nah_kesh" value="<?php echo isset($nah_kesh) ? htmlspecialchars($nah_kesh) : ''; ?>" />
                <input type="hidden" name="bah_cod_m" value="<?php echo isset($bah_cod_m) ? htmlspecialchars($bah_cod_m) : ''; ?>" />
                <input type="hidden" name="z_sal" value="<?php echo isset($z_sal) ? htmlspecialchars($z_sal) : ''; ?>" />
                <span style="font-size:18px; margin-left:15px"><?php echo 'به صفحه'; ?></span>
                <input type="number" 
                       id="pageIdInput"
                       name="page_input"
                       value="<?php echo isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 1; ?>" 
                       placeholder="شماره صفحه" 
                       style="width:80px; padding:5px; border-radius:4px; border:1px solid #ccc;">
                <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">برو</button>
            </form>
        </div>
<?php } ?>
        <script>
        document.getElementById('pageJumpForm').addEventListener('submit', function(e) {
            var input = document.getElementById('pageIdInput');
            var pageId = parseInt(input.value, 10);
            if (!isNaN(pageId) && pageId >= 1 && pageId <= <?php echo $total; ?>) {
                this.action = 'liste_Garden.php?id=' + pageId + '#1';
            } else {
                e.preventDefault();
                alert("لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo $total; ?> وارد کنید.");
            }
        });
	
	
            function target_Agri21(form) {
    var width = 500;
    var height = 800;
    var left = 0;
    var top = 100;

    window.open(
        "", // پنجره خالی برای هدف فرم
        "formpopup",
        "location=no,menubar=no,toolbar=no,status=no,scrollbars=yes,resizable=no,width=" + width + ",height=" + height + ",left=" + left + ",top=" + top
    ); 
    form.target = 'formpopup'; // ارسال فرم به پنجره جدید
}

        </script>
    </div>
<?php }  } ?>
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