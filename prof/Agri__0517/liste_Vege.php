<?php 
include('../../lock_p1.php');
include('../../event.php');
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$b_time = isset($_POST['b_time']) ? $_POST['b_time'] : '';
$m_ab = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
$confi = isset($_POST['confi']) ? $_POST['confi'] : '';
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
function target_po2(form) {
    window.open('null', 'formpopup', 'width=500,height=130,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
  <script>
function target_po3(form) {
    window.open('null', 'formpopup', 'width=950,height=1400,resizeable,scrollbars');
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
             <p> <span class="style1">لیست بهره برداری های صیفی </span></p>
             <div style="width: 600px; padding: 5px; border: 2px solid navy; margin: auto; text-align: left; border-radius:10px" >
             <table width="100%" height="305" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
               <tr>
                 <td width="30%"><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                       <?php
                    $query = "SELECT z_sal FROM `z_sal`  ORDER BY z_sal DESC "  ;
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                   <option value="<?php echo $row['z_sal'] ;?>"
                   <?php if ($row['z_sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['z_sal'] ;?></option>
                   <?php }?>
                   </select>
                 </div></td>
                 <td width="23%"><font size="2">: سال زراعی</font></td>
                 <td width="29%" height="55">
                   <p><span style="text-align: center"></span>
                     <span style="text-align: right"></span>
                     <span style="text-align: right"></span>
                   <div align="right">
                     <select  name="add_city" class="input_text" id="add_city"  style="width:170px ; height:40px" dir="rtl"  >
                       <option value="0" >انتخاب نام شهر </option>
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
                     <option value="0" >انتخاب نام آبادی </option>
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
                 <td height="56"><div align="right">
                   <select name="m_ab" class="input_text required " id="m_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="14">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($m_ab=='1') { echo 'selected="selected"' ; } ?> >چشمه</option>
                     <option value="2" <?php if ($m_ab=='2') { echo 'selected="selected"' ; } ?>>قنات</option>
                     <option value="3" <?php if ($m_ab=='3') { echo 'selected="selected"' ; } ?>>رودخانه</option>
                     <option value="4" <?php if ($m_ab=='4') { echo 'selected="selected"' ; } ?>>سد</option>
                     <option value="5" <?php if ($m_ab=='5') { echo 'selected="selected"' ; } ?>>چاه سطحی</option>
                     <option value="6"  <?php if ($m_ab=='6') { echo 'selected="selected"' ; } ?>>چاه عمیق</option>
                     <option value="7"  <?php if ($m_ab=='7') { echo 'selected="selected"' ; } ?>>چاه نیمه عمیق</option>
                     <option value="8"  <?php if ($m_ab=='8') { echo 'selected="selected"' ; } ?>>زهکش</option>
                     <option value="9"  <?php if ($m_ab=='9') { echo 'selected="selected"' ; } ?>>پساب</option>
                     <option value="10" <?php if ($m_ab=='10') { echo 'selected="selected"' ; } ?>>آب بندان</option>
                     <option value="11" <?php if ($m_ab=='11') { echo 'selected="selected"' ; } ?>>سایر</option>
                   </select>
                 </div></td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right">:منبع آب</span></div></td>
                 <td height="56"><div align="right">
                   <select name="b_time" class="input_text  required" id="b_time" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($b_time=='1') { echo 'selected="selected"' ; } ?>>زمستانه/استمرار</option>
                     <option value="2" <?php if ($b_time=='2') { echo 'selected="selected"' ; } ?>>بهاره</option>
                     <option value="3" <?php if ($b_time=='3') { echo 'selected="selected"' ; } ?>>تابستانه</option>
                     <option value="4" <?php if ($b_time=='4') { echo 'selected="selected"' ; } ?>>پاییزه</option>
                     </select>
                 </div></td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right">:فصل تولید</span></div></td>
               </tr>
               <tr>
                 <td height="56">&nbsp;</td>
                 <td height="56">&nbsp;</td>
                 <td height="56"><div align="right">
                   <select name="confi" class="input_text  required" id="confi" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="" <?php if ($confi=='') { echo 'selected="selected"' ; } ?> >همه موارد</option>
                     <option value="1" <?php if ($confi=='1') { echo 'selected="selected"' ; } ?>>در حال بررسی</option>
                     <option value="2" <?php if ($confi=='2') { echo 'selected="selected"' ; } ?>>تایید شده</option>
                     <option value="3" <?php if ($confi=='3') { echo 'selected="selected"' ; } ?>>عدم تایید</option>
                   </select>
                 </div></td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right">:وضعیت رکورد</span></div></td>
                 </tr>
               <tr>
                 <td height="84" colspan="4">
                   <p>
                    <input type="submit" name="action_lise" id="action_lise" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
             </p>
                  <p class="style2"><span class="RedTitleSmaller">برای مشاهده لیست کلیه بهره برداری ها کلید</span> جستجو<span class="RedTitleSmaller"> را بدون انتخاب هیچ یک از آیتم ها کلیک کنید </span></p></td>
                </tr>
             </table>
             </div>
   </form>

<?php 
$limit  = 25;
$id     = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$query1 = '';
$total  = 0;

 if (isset($_POST['action_lise'])) 
 {  
  if ($z_sal == '1404-1405' ) $Agri_edit_available = '1'  ;  else  $Agri_edit_available = '0';  
// if ( $z_sal == '1404-1405' or $z_sal == '1403-1404') $Agri_edit_available = '1'  ;  else  $Agri_edit_available = '0';  
 if ($add_abadi == '0') { $v_add_abadi = 1; }else { $v_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city == '0')  { $v_add_city  = 1 ; }else{ $v_add_city = "add_city = '$add_city'" ;}
 if ($b_time == '')  { $f_b_time  = 1  ; }else{ $f_b_time = "b_time = '$b_time'" ;}
 if ($m_ab == '')  { $f_m_ab  = 1  ; }else{ $f_m_ab = "m_ab = '$m_ab'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "z_sal = '$z_sal'" ;}
 if ($confi == '')  { $v_confi  = 1  ; }else{ $v_confi = "confi = '$confi'" ;}
$start=($id-1)*$limit;
$query = "SELECT id,id_ostan,id_city,add_abadi,add_city,no_bah,b_time,m_ab,m_zamin,bah_cod_m,z_sal,sh_gat,confi,confi2 from Vege where  mor_cod_m = '$login_session' and $v_add_abadi and $v_add_city and $f_b_time and $f_m_ab and $v_bah_cod_m and $v_z_sal and $v_confi ORDER BY mor_cod_m ASC LIMIT $start, $limit  "; 
$query1 = "SELECT count(*) from Vege where  mor_cod_m = '$login_session' and $v_add_abadi and $v_add_city and $f_b_time and $f_m_ab and $v_bah_cod_m and $v_z_sal and $v_confi  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<p align="right"><p><span class="style1"><a name="1" id="1"></a></span>
<form  action="list_Vege_xls.php" method="post">
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="b_time" value="<?php echo $b_time ;?>" />
        <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
        <input type="hidden" name="confi" value="<?php echo $confi ;?>" />
<button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="58" height="62"  alt=""/></button>
      </form></p>
      <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td colspan="3" rowspan="2" bgcolor="#006699">عملیات</td>
          <td colspan="2" bgcolor="#006699">وضعیت تایید</td>
          <td width="8%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
            <span class="style2">هکتار</span></td>
          <td width="7%" rowspan="2" bgcolor="#006699">منبع آب </td>
          <td width="11%" rowspan="2" bgcolor="#006699">فصل تولید</td>
          <td width="5%" rowspan="2" bgcolor="#006699">شماره قطعه</td>
          <td width="6%" rowspan="2" bgcolor="#006699">سال زراعی</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="2" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td bgcolor="#006699">تکمیلی</td>
          <td bgcolor="#006699">اولیه</td>
          <td width="10%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="9%" bgcolor="#006699">شهر/آبادی</td>
          <td width="10%" bgcolor="#006699">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['b_time']=='1')  $v_b_time='زمستانه/استمرار';
if ($row['b_time']=='2')  $v_b_time='بهاره';
if ($row['b_time']=='3')  $v_b_time='تابستانه';
if ($row['b_time']=='4')  $v_b_time='پاییزه';
if ($row['m_ab']=='1')  $v_m_ab='چشمه';
if ($row['m_ab']=='2')  $v_m_ab='قنات';
if ($row['m_ab']=='3')  $v_m_ab='رودخانه'; 
if ($row['m_ab']=='4')  $v_m_ab='سد';
if ($row['m_ab']=='5')  $v_m_ab='چاه سطحی';
if ($row['m_ab']=='6')  $v_m_ab='چاه عمیق';
if ($row['m_ab']=='7')  $v_m_ab='چاه نیمه عمیق';
if ($row['m_ab']=='8')  $v_m_ab='زهکش';
if ($row['m_ab']=='9')  $v_m_ab='پساب';
if ($row['m_ab']=='10')  $v_m_ab='آب بندان' ;
if ($row['m_ab']=='11')  $v_m_ab='سایر' ;
  ?>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($Agri_edit_available == '1' and $row['confi']!='2') {?>
            <form  action="del_list_Vege.php" method="post" onsubmit="target_po2(this)">
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
              <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <button onclick="return confirm('از حذف اطلاعات این رکورد مطمئن هستید ؟ ')"><img src="../../files/del1.png" title="حذف اطلاعات " width="33" height="26"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($Agri_edit_available == '1' and $row['confi']!='2')  {?>
            <form  action="Vege_edit.php" method="post">
          <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
          <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
          <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
           <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
           <input type="hidden" name="b_time" value="<?php echo $row['b_time'] ;?>" />
           <input type="hidden" name="mah1" value="<?php echo isset($row['mah1']) ? htmlspecialchars($row['mah1']) : ''; ?>" />
           <input type="hidden" name="mah2" value="<?php echo isset($row['mah2']) ? htmlspecialchars($row['mah2']) : ''; ?>" />
           <input type="hidden" name="mah3" value="<?php echo isset($row['mah3']) ? htmlspecialchars($row['mah3']) : ''; ?>" />
           <input type="hidden" name="t_kind" value="<?php echo isset($row['t_kind']) ? htmlspecialchars($row['t_kind']) : ''; ?>" />
           <input type="hidden" name="m_ab" value="<?php echo $row['m_ab'] ;?>" />
           <input type="hidden" name="z_sal" value="<?php echo $row['z_sal'] ;?>" />
           <input type="hidden" name="sh_gat" value="<?php echo $row['sh_gat'] ;?>" />
              <button><img src="../../files/edit.png" title="ویرایش اطلاعات " width="33" height="26"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Vegedata_T_view.php" method="post"  onsubmit="target_po3(this)">
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
            </form></td>
          <td  width="5%" class="normalTextSmaller" 
        <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ((Vege_pt($row['id']) > 0) or ($row['confi']!='2')) {  
		  echo "<img src='../../files/disable.png' width='20' height='20' title='اطلاعات کشت تکمیل نشده'  alt=''/>" ;
		  }
	    else
		{
      ?>
            <?php if ($row['confi2']=='1') {?>
            <img src="../../files/FAQ.png" title="بررسی نشده"  width="30" height="20"  alt=""/>
            <?php }?>
            <?php if ($row['confi2']=='2') {?>
            <img src="../../files/icon1Active.png" title="تایید شده"  width="33" height="26"  alt=""/>
            <?php }?>
            <?php if ($row['confi2']=='3') {?>
            <img src="../../files/icon1Inactive.png" title="تایید نشده"  width="33" height="26"  alt=""/>
            <?php }}?></td>
          <td 
        <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="8%" class="normalTextSmaller"> 
            <?php if ($row['confi']=='1') {?>
            <img src="../../files/FAQ.png" title="در حال بررسی "  width="30" height="20"  alt=""/> <?php }?>
            <?php if ($row['confi']=='2') {?>
            <img src="../../files/icon1Active.png" title="تایید شده"  width="33" height="26"  alt=""/> <?php }?>
            <?php if ($row['confi']=='3') {?>
            <img src="../../files/icon1Inactive.png" title="تایید نشده"  width="33" height="26"  alt=""/> <?php }?>
          </td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_ab?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_b_time ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_sal']; ?></td>
          <td height="40" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['no_bah'])?></td>
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
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> fetchColumn();

if ($limit > 0) {
    $total = ceil($rows / $limit);
} else {
    $total = 1;
}

if($id>1)
{
	?>
    <form  action="liste_Vege.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action_lise" value="1" />
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="b_time" value="<?php echo $b_time ;?>" />
        <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
        <input type="hidden" name="confi" value="<?php echo $confi ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="liste_Vege.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action_lise" value="1" />
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="b_time" value="<?php echo $b_time ;?>" />
        <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
        <input type="hidden" name="confi" value="<?php echo $confi ;?>" />
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
      <li class='current'><form  action="liste_Vege.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action_lise" value="1" />
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="b_time" value="<?php echo $b_time ;?>" />
        <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
        <input type="hidden" name="confi" value="<?php echo $confi ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
 }
echo "</ul>";
 }

?>
</div>
<p>&nbsp;</p>
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