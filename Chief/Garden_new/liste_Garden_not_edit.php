<?php 
include('../../lock_p1.php');
include('../../event.php');
// آدرس صفحه قبلی 
$p_page = $_SERVER['HTTP_REFERER'] ;
//alert($p_page);
 if (isset($_POST['back_p']))
{
$bah_cod_m = $_SESSION['page_date']['p_bah_cod_m'] ; 
$add_abadi = $_SESSION['page_date']['p_add_abadi'] ;
$add_city = $_SESSION['page_date']['p_add_city'] ;
$bah_cod_m = $_SESSION['page_date']['p_bah_cod_m'] ;
$z_sal =$_SESSION['page_date']['p_z_sal'] ;
//$back = '1' ; 
}
else 
{
unset($_SESSION['page_date']) ; 
if(isset($_POST['add_abadi'])) $add_abadi = $_POST['add_abadi'] ;
if(isset($_POST['add_city'])) $add_city = $_POST['add_city'] ;
if(isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'] ;
if(isset($_POST['z_sal'])) $z_sal = $_POST['z_sal'] ;
include_once('../session_start.php') ; 
$_SESSION['page_date'] = array('p_add_abadi'=> $add_abadi,'p_add_city'=>$add_city,'p_bah_cod_m'=>$bah_cod_m,'p_no_kesh'=>$no_kesh,'p_nah_kesh'=>$nah_kesh,'p_no_mal'=>$no_mal,'p_z_sal'=>$z_sal) ; 
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
             <p> <span class="style1">لیست بهره برداری های باغی که بعد از انتقال ویرایش نشده اند</span></p>
             <div style="width: 600px; padding: 5px; border: 5px solid navy; margin: auto; text-align: left;" >
             <table width="100%" height="193" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
               <tr>
                 <td width="30%"><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                     <option value="1401" <?php if ($z_sal=='1401') echo 'selected=selected'?>>1401</option>
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
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "Garden.bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "Garden.z_sal = '$z_sal'" ;}

$start=0;
$limit=15;
if(isset($_GET['id']))
{
$id=$_GET['id'];
$start=($id-1)*$limit;
}
// $query = "SELECT num_bah,id,mor_cod_m,no_mal,bah_cod_m,add_abadi,add_city,sh_gat,z_sal,no_kesh,nah_kesh,m_zamin,id_ostan,id_city,t_mah from Garden where `date_s` not LIKE '%/%' AND  mor_cod_m = $login_session and $v_add_abadi and $v_add_city and $f_no_kesh and $f_nah_kesh and $f_no_mal and $v_bah_cod_m and $v_z_sal  ORDER BY mor_cod_m ASC LIMIT $start, $limit  "; 
//$query1 = "SELECT id from Garden where  `date_s` not LIKE '%/%' AND  mor_cod_m = $login_session and $v_add_abadi and $v_add_city and $f_no_kesh and $f_nah_kesh and $f_no_mal and $v_bah_cod_m and $v_z_sal ORDER BY mor_cod_m ASC  "; 

 $query = " SELECT Garden.num_bah,Garden.id,Garden.mor_cod_m,Garden.no_mal,Garden.bah_cod_m,Garden.add_abadi,
 Garden.add_city,Garden.sh_gat,Garden.z_sal,Garden.no_kesh,Garden.nah_kesh,Garden.m_zamin,Garden.id_ostan,
 Garden.id_city,Garden.t_mah
 from Garden
where Garden.mor_cod_m = $login_session and Garden.date_s not LIKE '%/%' 
and $v_add_abadi and $v_add_city and $v_bah_cod_m and $v_z_sal
group by Garden.id  ASC LIMIT $start, $limit "; 
$query1 = " 
 SELECT Garden.id from Garden
where Garden.mor_cod_m = $login_session and Garden.date_s not LIKE '%/%' 
and $v_add_abadi and $v_add_city and $v_bah_cod_m and $v_z_sal
group by Garden.id"; 

$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p><p><span class="style1"><a name="1" id="1"></a></span>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
  <tr class="text1">
          <td colspan="3" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="7%" rowspan="2" bgcolor="#006699">نوع کشت</td>
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
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['z_sal']=='1401') {?>
            <form  action="del_list_Garden_nonedit.php" method="post">
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
              <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="sh_gat" value="<?php echo $row['sh_gat']  ;?>" />
              <input type="hidden" name="z_sal" value="<?php echo $row['z_sal']  ;?>" />
              <input type="hidden" name="id_page"  value="<?php echo $id ;?>" />
              <button onclick="return confirm('از حذف اطلاعات زراعی مطمئن هستید ؟ ')"><img src="../../files/del1.png" title="حذف اطلاعات زراعی" width="33" height="26"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['z_sal']=='1401')  {?>
            <form  action="Garden_edit_nonedit.php" method="post">
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
              <button><img src="../../files/edit.png" title="ویرایش اطلاعات بهره برداری" width="33" height="26"  alt=""/></button>
            </form>
            <?php }?></td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Gardendata_view_nonedit.php" method="post">
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="id_page"  value="<?php echo $id ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
            </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh?></td>
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
 }
	?>
    </table>
      <?php 

if(isset($query1))
{
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
if(isset($limit)) $total=ceil($rows/$limit);

if(isset($id) and $id>1)
{
	?>
    <form  action="liste_Garden_not_edit.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action_lise" value="1" />
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="liste_Garden_not_edit.php?id=<?php echo $id+1 ?>" method="post">
        <input type="hidden" name="action_lise" value="1" />
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
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
      <li class='current'><form  action="liste_Garden_not_edit.php?id=<?php echo $i?>" method="post">
        <input type="hidden" name="action_lise" value="1" />
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
 }
 }
echo "</ul>";
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