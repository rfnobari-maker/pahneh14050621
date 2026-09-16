<?php 
include('../../lock_p2.php');
include('../../event.php');


$add_abadi   = isset($_POST['add_abadi'])  ? $_POST['add_abadi']  : '';
$add_city    = isset($_POST['add_city'])   ? $_POST['add_city']   : '';
$mor_cod_m   = isset($_POST['mor_cod_m'])  ? $_POST['mor_cod_m']  : '';
$bah_cod_m   = isset($_POST['bah_cod_m'])  ? $_POST['bah_cod_m']  : '';
$z_sal       = isset($_POST['z_sal'])      ? $_POST['z_sal']      : '';
$b_time     = isset($_POST['b_time'])    ? $_POST['b_time']    : '';
$m_ab     = isset($_POST['m_ab'])    ? $_POST['m_ab']    : '';
$confi     = isset($_POST['confi'])    ? $_POST['confi']    : '';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_popup2(form) {
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
             <p> <span class="style1">لیست بهره برداری های صیفی </span><br />
              <span class="style8">ثبت اولیه</span></p>
             <div style="width: 600px; padding: 5px; border: 5px solid navy; margin: auto; text-align: left;" >
             <table width="100%" height="305" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
               <tr>
                 <td width="30%"><div align="right">
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
                 <td width="23%"><div align="right"><span style="  margin-right:15px;text-align: right">:سال زراعی</span></div></td>
                 <td width="29%" height="55">
                   <p><span style="text-align: center"></span>
                     <span style="text-align: right"></span>
                     <span style="text-align: right"></span>
                   <div align="right">
                     <select  name="add_city" class="input_text" id="add_city"  style="width:170px ; height:40px" dir="rtl"  >
                       <option value="0" >انتخاب نام شهر </option>
                       <?php
$query = "SELECT  add_city,shahr FROM list_city WHERE  id_mar = '$id_mar'"   ;
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
                 <td width="23%"><div align="right"><font size="2">: کد ملی بهره بردار</font></div>
                   </td>
                 <td height="51"><div align="right"><span style="text-align: right">
                   <select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                     <option value="0" >انتخاب نام آبادی </option>
                     <?php
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE  id_mar = '$id_mar'"   ;
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
                 <td height="54" align="right" class="input_text" ><div align="right"><span style="text-align: right">
                   <input name="mor_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $mor_cod_m?>" />
                 </span></div></td>
                 <td><div align="right"><font size="2">: کد ملی مروج</font></div></td>
                 <td height="56"><div align="right">
                   <select name="confi" class="input_text  required" id="confi" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="" <?php if ($confi=='') { echo 'selected="selected"' ; } ?> >همه موارد</option>
                     <option value="1" <?php if ($confi=='1') { echo 'selected="selected"' ; } ?>>بررسی نشده</option>
                     <option value="2" <?php if ($confi=='2') { echo 'selected="selected"' ; } ?>>تایید شده</option>
                     <option value="3" <?php if ($confi=='3') { echo 'selected="selected"' ; } ?>>تایید نشده</option>
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
 if (isset($_POST['action_lise'])) 
 {  
 if ($add_abadi == '0') { $v_add_abadi = 1; }else { $v_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city == '0')  { $v_add_city  = 1 ; }else{ $v_add_city = "add_city = '$add_city'" ;}
 if ($b_time == '')  { $f_b_time  = 1  ; }else{ $f_b_time = "b_time = '$b_time'" ;}
 if ($m_ab == '')  { $f_m_ab  = 1  ; }else{ $f_m_ab = "m_ab = '$m_ab'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "z_sal = '$z_sal'" ;}
 if ($confi == '')  { $v_confi  = 1  ; }else{ $v_confi = "confi = '$confi'" ;}

$start=0;
$limit=25;
$id     = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$query1 = '';
$total  = 0;
$start=($id-1)*$limit;

$query = "SELECT id,id_ostan,id_city,add_abadi,add_city,no_bah,b_time,m_ab,m_zamin,bah_cod_m,mor_cod_m,z_sal,sh_gat,confi from Vege where id_mar = '$id_mar' and $v_add_abadi and $v_add_city and $f_b_time and $f_m_ab and $v_bah_cod_m  and $v_mor_cod_m and $v_z_sal and $v_confi ORDER BY mor_cod_m ASC LIMIT $start, $limit  "; 
$query1 = "SELECT id,id_ostan,id_city,add_abadi,add_city,no_bah,b_time,m_ab,m_zamin,bah_cod_m,mor_cod_m,z_sal,sh_gat,confi from Vege where id_mar = '$id_mar' and $v_add_abadi and $v_add_city and $f_b_time and $f_m_ab and $v_bah_cod_m  and $v_mor_cod_m and $v_z_sal and $v_confi "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
<span class="style1"><a name="1" id="1"></a></span>
<form  action="list_Vege_xls.php" method="post">
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="b_time" value="<?php echo $b_time ;?>" />
        <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
        <input type="hidden" name="confi" value="<?php echo $confi ;?>" />
<button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="58" height="62"  alt=""/></button>
      </form></p>
      <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td colspan="2" rowspan="2" bgcolor="#006699">عملیات</td>
          <td colspan="2" rowspan="2" bgcolor="#006699">کارشناس<br />
            مروج</td>
          <td width="8%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
            <span class="style2">هکتار</span></td>
          <td width="7%" rowspan="2" bgcolor="#006699">منبع آب </td>
          <td width="11%" rowspan="2" bgcolor="#006699">نوع طرح</td>
          <td width="5%" rowspan="2" bgcolor="#006699">شماره قطعه</td>
          <td width="6%" rowspan="2" bgcolor="#006699">سال زراعی</td>
          <td  colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="2" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="6%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="10%"  bgcolor="#006699">کد ملی </td>
          <td width="12%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="10%" bgcolor="#006699">شهر/آبادی</td>
          <td width="11%" bgcolor="#006699">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
$pic = user_pic($row['mor_cod_m']) ; 
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
          <td width="9%" height="50" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <?php if($row['z_sal']=='1403-1404' or $row['z_sal']=='1404-1405')
		  {
			  ?>
          <form  action="confi_Vege.php" method="post" onsubmit="target_popup2(this)">
      <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
      <input type="hidden" name="back_no" value="1" />
      <input type="hidden" name="id"  value=<?php echo $row['id'] ;?> />
      <button>
        <?php if ($row['confi']=='1') {?>
        <img src="../../files/FAQ.png" title="اعتبار رکورد بررسی نشده "  width="33" height="26"  alt=""/>
        <?php }?>
        <?php if ($row['confi']=='2') {?>
        <img src="../../files/icon1Active.png" title="اعتبار رکورد تایید شده"  width="33" height="26"  alt=""/>
        <?php }?>
        <?php if ($row['confi']=='3') {?>
        <img src="../../files/icon1Inactive.png" title="اعتبار رکورد تایید نشده"  width="33" height="26"  alt=""/>
        <?php }?>
        </button>
    </form>
    <?php }?>
    </td>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Vegedata_view.php" method="post" onsubmit="target_popup2(this)">
              <input type="hidden" name="id"  value=<?php echo $row['id'] ;?> />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
            </form></td>
          <td width="11%" bordercolor="#CCCCCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['mor_cod_m'])?><br />
            <?php echo $row['mor_cod_m']?><br />
            <?php echo user_tel($row['mor_cod_m'])?><br />
            </p></td>
          <td width="6%" bordercolor="#CCCCCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br/></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_ab?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_b_time ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_sal']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
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
$rows = $stmt1 -> rowCount() ;

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
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
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
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
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
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
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
           <p> <p><a href="Vege_pro.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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