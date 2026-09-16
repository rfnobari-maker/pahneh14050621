<?php 
include('../../lock_p1.php');
include('../../event.php');
$add_abadi = $add_city = $no_kesh = $no_mal = $bah_cod_m = $m_cod_m = $z_sal = '';
 if (isset($_POST['back_p']))
{
    $bah_cod_m = isset($_SESSION['page_date']['p_bah_cod_m']) ? $_SESSION['page_date']['p_bah_cod_m'] : '';
    $m_cod_m   = isset($_SESSION['page_date']['p_m_cod_m']) ? $_SESSION['page_date']['p_m_cod_m'] : '';
    $add_abadi = isset($_SESSION['page_date']['p_add_abadi']) ? $_SESSION['page_date']['p_add_abadi'] : '';
    $add_city  = isset($_SESSION['page_date']['p_add_city']) ? $_SESSION['page_date']['p_add_city'] : '';
    $no_kesh   = isset($_SESSION['page_date']['p_no_kesh']) ? $_SESSION['page_date']['p_no_kesh'] : '';
    $no_mal    = isset($_SESSION['page_date']['p_no_mal']) ? $_SESSION['page_date']['p_no_mal'] : '';
    $z_sal     = isset($_SESSION['page_date']['p_z_sal']) ? $_SESSION['page_date']['p_z_sal'] : '';
//$back = '1' ; 
}
else 
{
unset($_SESSION['page_date']) ; 
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city  = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh   = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$no_mal    = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$m_cod_m   = isset($_POST['m_cod_m']) ? $_POST['m_cod_m'] : '';
$z_sal     = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
include_once('../session_start.php') ; 
$_SESSION['page_date'] = array('p_add_abadi'=> $add_abadi,'p_add_city'=>$add_city,'p_bah_cod_m'=>$bah_cod_m,'p_m_cod_m'=>$m_cod_m,'p_no_kesh'=>$no_kesh,'p_no_mal'=>$no_mal,'p_z_sal'=>$z_sal) ; 
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
    function target_Agri17(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=750,height=600"); 
    form.target = 'formpopup'; 
	}

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
             <p> <span class="style1">لیست قطعات زراعی فاقد ویرایش بعد از انتقال </span></p>
             <div style="width: 600px; padding: 5px; border: 2px solid navy; border-radius:10px; margin: auto; text-align: left;" >
             <table width="100%" height="305" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
               <tr>
                 <td width="30%"><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                     <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405') echo 'selected=selected'?>>1404-1405</option>
                     <option value="1403-1404" <?php if (isset($z_sal) && $z_sal=='1403-1404') echo 'selected=selected'?>>1403-1404</option>
                   </select>
                 </div></td>
                 <td width="23%"><font size="2">: سال زراعی</font></td>
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
                   <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php if(isset($z_sal)) echo $bah_cod_m?>" />
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
   <?php if (isset($row['add_abadi'],$add_abadi) && $row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                     <?php }?>
                     </select>
                   </span></div>
                 </td>
                 <td height="51"><div align="right"><span style=" margin-right:15px;text-align: right">:
نام آبادی</span></div></td>
               </tr>
               <tr>
                 <td height="54" align="right" class="input_text" ><div align="right"><span style="text-align: right">
                   <input name="m_cod_m" type="text" class="input_text" id="m_cod_m"  style="height:35px ; width:170px " value="<?php if(isset($z_sal)) echo $m_cod_m?>" />
                 </span></div></td>
                 <td><font size="2">: کد ملی مالک</font></td>
                 <td height="56"><div align="right">
                   <select name="no_mal" class="input_text  required" id="no_mal" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if (isset($no_mal) && $no_mal=='1') { echo 'selected="selected"' ; } ?>>سند ششدانگ</option>
                     <option value="2" <?php if (isset($no_mal) && $no_mal=='2') { echo 'selected="selected"' ; } ?>>سند مشاعی</option>
                     <option value="3" <?php if (isset($no_mal) && $no_mal=='3') { echo 'selected="selected"' ; } ?>>اصلاحات اراضی</option>
                     <option value="4" <?php if (isset($no_mal) && $no_mal=='4') { echo 'selected="selected"' ; } ?>>موقوفه</option>
                     <option value="5" <?php if (isset($no_mal) && $no_mal=='5') { echo 'selected="selected"' ; } ?>>واگذاری</option>
                     <option value="6" <?php if (isset($no_mal) && $no_mal=='6') { echo 'selected="selected"' ; } ?>>قولنامه</option>
                     <option value="7" <?php if (isset($no_mal) && $no_mal=='7') { echo 'selected="selected"' ; } ?>>اجاره</option>
                     <option value="8" <?php if (isset($no_mal) && $no_mal=='8') { echo 'selected="selected"' ; } ?>>سایر</option>                     
                     </select>
                 </div></td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right">:نوع مالکیت</span></div></td>
               </tr>
               <tr>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td height="56"><div align="right"><span style="text-align: right">
                   <select name="no_kesh" class="input_text  required" id="no_kesh"  style="height:40px ; width:120px ; direction:rtl" tabindex="6">
                     <option value="">انتخاب کنید</option>
                     <option value="1" <?php if(isset($no_kesh) && $no_kesh=="1") echo "selected='selected'"?>>آبی</option>
                     <option value="2" <?php if(isset($no_kesh) && $no_kesh=="2") echo "selected='selected'"?>>دیم</option>
                     </select>
                   </span></div>
                 </td>
                 <td height="56"><div align="right"><span style="  margin-right:15px;text-align: right">:نوع کشت</span></div></td>
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
 $Agri_table = 'Agri'.str_replace('-','_',$z_sal) ; 

 if ( $z_sal  == '1403-1404' or $z_sal == '1404-1405') $Agri_edit_available = '1'  ;  else  $Agri_edit_available = '0';  
 if ($add_abadi =='') { $v_add_abadi = 1;}else{ $v_add_abadi = "`$Agri_table`.add_abadi = '$add_abadi'" ;}
 if ($add_city  =='') { $v_add_city  = 1;}else{ $v_add_city  = "`$Agri_table`.add_city  = '$add_city'" ;}
 if ($no_mal    =='') { $f_no_mal    = 1;}else{ $f_no_mal    = "`$Agri_table`.no_mal    = '$no_mal'" ;}
 if ($no_kesh   =='') { $f_no_kesh   = 1;}else{ $f_no_kesh   = "`$Agri_table`.no_kesh   = '$no_kesh'" ;}
 if ($bah_cod_m =='') { $v_bah_cod_m = 1;}else{ $v_bah_cod_m = "`$Agri_table`.bah_cod_m = '$bah_cod_m'" ;}
 if ($m_cod_m =='') { $v_m_cod_m = 1;}else{ $v_m_cod_m = "`$Agri_table`.m_cod_m = '$m_cod_m'" ;}

$start=0;
$limit=10;
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$start=($id-1)*$limit;
 $query = " SELECT 
    agri.docId,
    agri.s_ayesh,
    agri.num_bah,
    agri.id,
    agri.mor_cod_m,
    agri.no_mal,
    agri.bah_cod_m,
    agri.m_cod_m,
    agri.add_abadi,
    agri.add_city,
    agri.sh_gat,
    agri.no_kesh,
    agri.m_zamin,
    agri.id_ostan,
    agri.id_city,
    agri.t_mah,
    bah.name,
    bah.last_name,
    bah.no_bah,
    list_abadi.abadi,
    list_city.city
FROM 
    `$Agri_table` AS agri
INNER JOIN 
    bah 
    ON agri.bah_cod_m = bah.bah_cod_m AND agri.num_bah = bah.num_bah
LEFT JOIN 
    list_abadi 
    ON agri.add_abadi = list_abadi.add_abadi
LEFT JOIN 
    list_city 
    ON agri.add_city = list_city.add_city
WHERE 
    agri.mor_cod_m = '$login_session' 
    AND $v_add_abadi 
    AND $v_add_city 
    AND $f_no_kesh 
    AND $f_no_mal 
    AND $v_bah_cod_m 
    AND $v_m_cod_m 
    AND agri.date_s NOT LIKE '%/%'
ORDER BY 
    agri.bah_cod_m, agri.sh_gat ASC
LIMIT 
    $start, $limit;
  "; 
$query1 = "SELECT count(*) from `$Agri_table`  where  mor_cod_m = '$login_session' and $v_add_abadi and $v_add_city and $f_no_kesh and $f_no_mal and $v_bah_cod_m and $v_m_cod_m and  date_s not like '%/%'   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style1"><a name="1" id="1"></a></span>
<form  action="list_noon_edit_xls.php" method="post">
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city"  value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mal"    value="<?php echo $no_mal ;?>" />
        <input type="hidden" name="no_kesh"   value="<?php echo $no_kesh ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="m_cod_m"   value="<?php echo $m_cod_m ;?>" />
        <input type="hidden" name="z_sal"     value="<?php echo $z_sal ;?>" />
        <button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="58" height="62"  alt=""/></button>
      </form></p>
      <table align="center" class="my-table" >
        <tr class="text1">
          <td colspan="4" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="5%" rowspan="2" bgcolor="#006699">سطح آیش</td>
          <td width="6%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
          هکتار</td>
          <td width="4%" rowspan="2" bgcolor="#006699">نوع کشت</td>
          <td width="6%" rowspan="2" bgcolor="#006699">کد ملی مالک</td>
          <td width="5%" rowspan="2" bgcolor="#006699">نوع مالکیت</td>
          <td width="5%" rowspan="2" bgcolor="#006699">شماره قطعه</td>
          <td height="35" colspan="3" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="10%" rowspan="2" bgcolor="#006699"> آبادی/شهر</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="8%" bgcolor="#006699">همراه</td>
          <td width="8%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="10%" bgcolor="#006699">نام و نام خانوادگی</td>
          </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['no_mal']=='1') $v_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $v_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $v_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $v_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $v_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $v_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $v_no_mal='اجاره' ;	 
if ($row['no_mal']=='8') $v_no_mal='سایر' ;	 
if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 
  ?><td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($Agri_edit_available == '1' and $row['docId'] == '' ) {?>
            <form  action="del_list_Agri.php" method="post">
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
              <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="sh_gat" value="<?php echo $row['sh_gat']  ;?>" />
              <input type="hidden" name="z_sal" value="<?php echo $z_sal  ;?>" />
              <input type="hidden" name="id_page"  value="<?php echo $id ;?>" />
              <button onclick="return confirm('از حذف اطلاعات زراعی مطمئن هستید ؟ ')"><img src="../../files/del.png" title="حذف اطلاعات زراعی" width="33" height="26"  alt=""/></button>
              </form>
            <?php }?></td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($Agri_edit_available == '1')  {?>
                    <form action="P_edit1.php" method="post" onsubmit="target_Agri18(this)">
                        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']; ?>" />
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                        <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
                        <button><img src="../../files/Pro.png" title="ویرایش اطلاعات محصول" width="30" height="23" alt=""/></button>
                    </form>
            <?php }?></td>
<?php if($z_sal == '1402-1403') { ?>
          <?php }?>
          <td width="9%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($Agri_edit_available == '1')  {?>
            <form  action="Agri_edit.php" method="post">
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="sh_gat" value="<?php echo $row['sh_gat']  ;?>" />
              <input type="hidden" name="z_sal" value="<?php echo $z_sal  ;?>" />
              <input type="hidden" name="m_poul" value="<?php if(isset($row['m_poul'])) echo $row['m_poul']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="no_kesh" value="<?php echo $row['no_kesh']  ;?>" />
              <input type="hidden" name="no_mal" value="<?php echo $row['no_mal']  ;?>" />
              <input type="hidden" name="t_mah" value="<?php echo $row['t_mah']  ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="id_page"  value="<?php echo $id ;?>" />
              <button><img src="../../files/Ear.png" title="ویرایش اطلاعات زمین" width="33" height="26"  alt=""/></button>
              </form>
            <?php }?></td>
          <td width="7%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Agridata_view1.php" method="post" onsubmit="target_Agri17(this)">
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="z_sal"  value="<?php echo $z_sal ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
            </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_ayesh']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']*1; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if(isset($v_no_mal)) echo $v_no_mal ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_tel_m($row['bah_cod_m']);  ?></td>
          <td height="35" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'].'&nbsp;'.$row['name'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
 }
	?>
      </table>
       <div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">

      <?php 
if(isset($query1))
{
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> fetchColumn();
$total=ceil($rows/$limit);
if(isset($id) && $id>1)
{
	?>
    <form  action="liste_noon_edit.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action_lise" value="1" />
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if(isset($id) && $id!=$total)
{
	?>
    <form  action="liste_noon_edit.php?id=<?php echo $id+1 ?>" method="post">
        <input type="hidden" name="action_lise" value="1" />
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
        <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <button class='button' >بعدی</button>
      </form>
    <?php 
}

echo "<ul class='page'>";

		for($i=1;$i<=$total;$i++)
		{
			if(isset($id) && $i==$id) { echo "<li class='current'>".$i."</li>"; }
			else { 
			?>
      <li class='current'><form  action="liste_noon_edit.php?id=<?php echo $i?>" method="post">
        <input type="hidden" name="action_lise" value="1" />
         <input type="hidden" name="add_abadi" value="<?php if(isset($add_abadi)) echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php  if(isset($add_city))echo $add_city ;?>" />
        <input type="hidden" name="no_mal" value="<?php if(isset($no_mal)) echo $no_mal ;?>" />
        <input type="hidden" name="no_kesh" value="<?php if(isset($no_kesh)) echo $no_kesh ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php if(isset($bah_cod_m)) echo $bah_cod_m ;?>" />
        <input type="hidden" name="m_cod_m" value="<?php echo $m_cod_m ;?>" />
        <input type="hidden" name="z_sal" value="<?php if(isset($z_sal)) echo $z_sal ;?>" />

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
<p>&nbsp;</p><p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
 <?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>