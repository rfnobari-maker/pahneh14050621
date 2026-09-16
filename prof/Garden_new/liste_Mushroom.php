<?php 
include('../../lock_p1.php');
include('../../event.php');
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$no_moj = isset($_POST['no_moj']) ? $_POST['no_moj'] : '';
$no_mush = isset($_POST['no_mush']) ? $_POST['no_mush'] : '';
$gaz = isset($_POST['gaz']) ? $_POST['gaz'] : '';
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
             <p> <span class="style1">لیست واحدهای پرورش قارچ</span></p>
             <div style="width: 600px; padding: 5px; border: 5px solid navy; margin: auto; text-align: left;" >
             <table width="100%" height="306" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
               <tr>
                 <td width="36%"><div align="right"><span style="text-align: right">
                   <select  name="add_abadi"  class="input_text" id="add_abadi" style="width:180px ; height:40px" dir="rtl"   >
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
                 </span></div></td>
                 <td width="16%"><div align="right"><span style=" margin-right:15px;text-align: right">:
                   نام آبادی</span></div></td>
                 <td width="29%" height="63">
                   <div align="right">
                     <select  name="add_city" class="input_text" id="add_city"  style="width:170px ; height:40px" dir="rtl"  >
                       <option value="" >انتخاب نام شهر </option>
                       <?php
$query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = '$login_session' "   ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                       <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                       <?php }?>
                     </select></div>                                   
                   </td>
                 <td width="19%"><div align="right"><span style=" margin-right:15px ; text-align: right">: نام شهر</span></div>                 </td>
               </tr>
               <tr>
                 <td height="47" align="right" class="input_text" ><div align="right">
                   <select name="no_mush" class="input_text  required" id="no_mush" style="height:40px ; width:180px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($no_mush=='1') { echo 'selected="selected"' ; } ?>>صدفی</option>
                     <option value="2" <?php if ($no_mush=='2') { echo 'selected="selected"' ; } ?>>دکمه ای</option>
                     <option value="3" <?php if ($no_mush=='3') { echo 'selected="selected"' ; } ?>>سایر قارچ های پرورشی خاص</option>
                   </select>
                 </div></td>
                 <td width="16%"><div align="right"><span style="  margin-right:15px;text-align: right"><font size="2">:نوع قارچ </font></span></div></td>
                 <td height="47"><div align="right"><span style="text-align: right">
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  maxlength="10"  style="height:35px ; width:160px " value="<?php echo $bah_cod_m?>" />
                 </span></div></td>
                 <td height="47"><div align="right"><span style="  margin-right:15px;text-align: right"><font size="2">:کد ملی بهره بردار</font></span></div></td>
               </tr>
               <tr>
                 <td height="56">&nbsp;</td>
                 <td height="56">&nbsp;</td>
                 <td height="56"><div align="right">
                   <select name="no_moj" class="input_text required " id="no_moj"  style="height:40px ; width:170px ; direction:rtl" tabindex="13">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if ($no_moj=='1') { echo 'selected="selected"' ; } ?> >پروانه بهره برداری/نظام مهندسی</option>
                     <option value="2" <?php if ($no_moj=='2') { echo 'selected="selected"' ; } ?>>مشاغل خانگی/وزارت جهاد</option>
                     <option value="3" <?php if ($no_moj=='3') { echo 'selected="selected"' ; } ?>>تسهیلات/بسیج سازندگی</option>
                     <option value="4" <?php if ($no_moj=='4') { echo 'selected="selected"' ; } ?>>فاقد مجوز</option>                     
                   </select>
                 </div></td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right"><font size="2">:نوع مجوز</font></span></div></td>
               </tr>
               <tr>
                 <td height="56">&nbsp;</td>
                 <td height="56">&nbsp;</td>
                 <td height="56"><div align="right">
                   <select name="gaz" class="input_text required " id="gaz"  style="height:40px ; width:170px ; direction:rtl" tabindex="26">
                     <option value="">انتخاب کنید</option>
                     <option value="1"<?php if ($gaz=='1') { echo 'selected="selected"' ; } ?>>هست</option>
                     <option value="2"<?php if ($gaz=='2') { echo 'selected="selected"' ; } ?>>نیست</option>
                   </select>
                 </div></td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right"><font size="2">:واحد گاز سوز</font></span></div></td>
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
 if ($add_abadi == '') { $v_add_abadi = 1; }else { $v_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city == '')  { $v_add_city  = 1 ; }else{ $v_add_city = "add_city = '$add_city'" ;}
 if ($no_mush == '')  { $f_no_mush  = 1  ; }else{ $f_no_mush = "no_mush = '$no_mush'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($no_moj == '')  { $f_no_moj  = 1  ; }else{ $f_no_moj = "no_moj = '$no_moj'" ;}
 if ($gaz == '')  { $f_gaz  = 1  ; }else{ $f_gaz = "gaz = '$gaz'" ;}

$start=0;
$limit=15;
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start = ($id - 1) * $limit;

//$confi = 2 ;
$query = "SELECT id,id_ostan,id_city,add_abadi,add_city,no_mush,m_zamin,bah_cod_m,unit_name,no_mal,no_moj from Mushroom where  mor_cod_m = '$login_session' and $v_add_abadi and $v_add_city and $f_no_mush and $v_bah_cod_m and $f_gaz and $f_no_moj  ORDER BY mor_cod_m ASC LIMIT $start, $limit  "; 
$query1 = "SELECT count(*) from Mushroom where  mor_cod_m = '$login_session' and $v_add_abadi and $v_add_city and $f_no_mush and $v_bah_cod_m and $f_gaz and $f_no_moj "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<p align="right"><p><span class="style1"><a name="1" id="1"></a></span>
<form  action="list_Mushroom_xls.php" method="post">
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="gaz" value="<?php echo $gaz ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="no_mush" value="<?php echo $b_time ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $m_ab ;?>" />
<button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="39" height="45"  alt=""/></button>
      </form></p>
      <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td colspan="4" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="7%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
            <span class="style2">مترمربع</span></td>
          <td width="9%" rowspan="2" bgcolor="#006699">نوع قارچ پرورشی</td>
          <td width="15%" rowspan="2" bgcolor="#006699">نام واحد</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="2" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="12%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="13%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="9%" bgcolor="#006699">شهر/آبادی</td>
          <td width="10%" bgcolor="#006699">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['no_mush']=='1')  $v_no_mush='صدفی';
if ($row['no_mush']=='2')  $v_no_mush='دکمه ای';
if ($row['no_mush']=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';
  ?>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($confi !='2') {?>
            <form  action="del_list_Mushroom.php" method="post" onsubmit="target_po2(this)">
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
              <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <button onclick="return confirm('از حذف اطلاعات این واحد مطمئن هستید ؟ ')"><img src="../../files/del.png" title="حذف اطلاعات واحد " width="20" height="20"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <form  action="liste_Mush_prod.php" method="post" >
            <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
            <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
            <button><img src="../../files/komo2.png" title="نمایش اطلاعات عملکرد واحد "  width="20" height="20"  alt=""/></button>
          </form></td>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($confi!='2')  {?>
            <form  action="Mushroom_edit.php" method="post">
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="no_mal" value="<?php echo $row['no_mal']  ;?>" />
              <input type="hidden" name="no_mush" value="<?php echo $row['no_mush']  ;?>" />
              <input type="hidden" name="no_moj" value="<?php echo $row['no_moj'] ;?>" />
              <input type="hidden" name="num_bah" value="<?php echo $row['num_bah']  ;?>" />
              <button><img src="../../files/edit.png" title="ویرایش اطلاعات واحد " width="20" height="20"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' 
        ?>>
	        <form  action="Mushroom_view.php" method="post"  onsubmit="target_po3(this)">
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات واحد"  width="20" height="20"  alt=""/></button>
            </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mush ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['unit_name']; ?></td>
          <td height="40" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['no_bah'])?></td>
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
      <?php 
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> fetchColumn();
$total=ceil($rows/$limit);
if($id>1)
{
	?>
    <form  action="liste_Mushroom.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action_lise" value="1" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mush" value="<?php echo $no_mush ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
        <input type="hidden" name="gaz" value="<?php echo $gaz ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="liste_Mushroom.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action_lise" value="1" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mush" value="<?php echo $no_mush ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
        <input type="hidden" name="gaz" value="<?php echo $gaz ;?>" />
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
      <li class='current'><form  action="liste_Mushroom.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action_lise" value="1" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mush" value="<?php echo $no_mush ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
        <input type="hidden" name="gaz" value="<?php echo $gaz ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
 }
echo "</ul>";
?>
</div>
<p>&nbsp;</p>
     <p>&nbsp;</p>
           <p><a href="#" title="ثبت واحد جدید"><img src="../../files/add_new.png" width="51" height="58"  alt=""/></a> 
             <br />
             <br />
           <p><a href="index.php"    title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
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