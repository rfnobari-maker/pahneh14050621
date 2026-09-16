<?php
include("../../lock_p1.php");
include('../../event.php') ;
include_once('Agrinote_status.php'); // اضافه شد: برای نمایش وضعیت یادداشت‌ها
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
</style>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script>
    // تابع برای ویرایش محصول (باز شدن در پاپ‌آپ جدید)
    function target_Agri18(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=1200px,height=800px"); 
    form.target = 'formpopup'; 
	}
    
    // تابع برای یادداشت (باز شدن در پاپ‌آپ جدید)
    function target_Agri21(form) {
    var width = 500;
    var height = 800;
    var left = 0;
    var top = 100;

    window.open(
        "", 
        "formpopup",
        "location=no,menubar=no,toolbar=no,status=no,scrollbars=yes,resizable=no,width=" + width + ",height=" + height + ",left=" + left + ",top=" + top
    ); 
    form.target = 'formpopup'; 
    }
    
    // تابع برای بستن پنجره
    function close_window() {
        window.close();
    }
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php 
 include ('../../login/config.php');
 // top.php حذف شد
 ?>
<p align="center" >&nbsp;</p>
<p align="center" ><span class="style8">مدیریت اطلاعات بهره برداری های زراعی</span><br />
  <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<?php
 if (isset($_POST['action'])) 
 {  
//include('../../login/config.php');
$bah_cod_m=$_POST['bah_cod_m'];
$z_sal = $_POST['z_sal'] ;
$Agri_table = 'Agri'.str_replace('-','_',$z_sal) ; 
 if ($z_sal == '1403-1404' or  $z_sal == '1404-1405') $Agri_edit_available = '1'  ;  else  $Agri_edit_available = '0';  
 $query = "SELECT s_ayesh,num_bah,id,mor_cod_m,no_mal,bah_cod_m,add_abadi,add_city,sh_gat,z_sal,no_kesh,m_zamin,id_ostan,id_city,t_mah,check_cod from $Agri_table where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
if ($found>0) {
?>
    <span class="style21"><a name="result" id="result"></a></span>  </p></form>
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td colspan="5" rowspan="2" bgcolor="#006699">عملیات</td>
          <td width="6%" rowspan="2" bgcolor="#006699">سطح آیش</td>
          <td width="7%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
          هکتار</td>
          <td width="5%" rowspan="2" bgcolor="#006699">نوع کشت</td>
          <td width="10%" rowspan="2" bgcolor="#006699">نوع مالکیت</td>
          <td width="6%" rowspan="2" bgcolor="#006699">شماره قطعه</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="2" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="6%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="4%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="9%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="11%" bgcolor="#006699">شهر/آبادی</td>
          <td width="12%" bgcolor="#006699">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
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
  ?>

 <?php  if($row['mor_cod_m'] == $login_session) {
	 
	 
	 ?>
     <?php if ($Agri_edit_available == '1') {
 ?>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="del_list_Agri.php" method="post">
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
              <input type="hidden" name="add_city"  value="<?php echo $row['add_city'] ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="sh_gat" value="<?php echo $row['sh_gat']  ;?>" />
              <input type="hidden" name="z_sal" value="<?php echo $z_sal  ;?>" />
              <button onclick="return confirm('از حذف اطلاعات زراعی مطمئن هستید ؟ ')"><img src="../../files/del.png" title="حذف اطلاعات زراعی" width="30" height="23"  alt=""/></button>
            </form>
            </td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form action="P_edit1.php" method="post" onsubmit="target_Agri18(this)">
              <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="z_sal"  value="<?php echo $z_sal ;?>" />
              <button><img src="../../files/Pro.png" title="ویرایش اطلاعات محصول" width="33" height="26"  alt=""/></button>
              </form>
            </td>
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
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
              <button><img src="../../files/Ear.png" title="ویرایش اطلاعات بهره برداری" width="33" height="26"  alt=""/></button>
            </form>
           </td>
            <?php } else {?>
       <td colspan="3" style="font-size:12px ; color:#900 ">امکان ویرایش و حذف مقدور نیست</td>
            <?php } ?>
           
          <td width="10%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC' ?>>
                <form action="Agri_note" method="post" onsubmit="target_Agri21(this)">
                    <input type="hidden" name="Agri_id" value=<?php echo $row['id']; ?> />
                    <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
                    <input type="hidden" name="mor_cod_m" value="<?php echo $login_session ?>" />
                    <button style="display:flex; align-items:center; gap:4px;">
                        <?php echo getAgriStatus($z_sal, $row['id']) ?>
                        <img src="../../files/add_new.png" title="درج /نمایش توضیح" width="33" height="26" alt=""/>
                    </button>
                </form>
          </td>
            
          <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <form  action="Agridata_view.php" method="post">
           <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
           <input type="hidden" name="z_sal"  value="<?php echo $z_sal ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form></td>
          <?php
           }
 else 
{
?>
    <td width="7%" colspan="3">    
           <form  action="Agridata_view.php" method="post">
           <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
           <input type="hidden" name="z_sal"  value="<?php echo $z_sal ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
          </form>
    </td>

    <td width="10%" <?php if ($r % 2 == 0) echo 'bgcolor=#FFFFCC' ?>>
          <form action="Agri_note" method="post" onsubmit="target_Agri21(this)">
              <input type="hidden" name="Agri_id" value=<?php echo $row['id']; ?> />
              <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>" />
              <input type="hidden" name="mor_cod_m" value="<?php echo $login_session ?>" />
              <button style="display:flex; align-items:center; gap:4px;">
                  <?php echo getAgriStatus($z_sal, $row['id']) ?>
                  <img src="../../files/add_new.png" title="درج /نمایش توضیح" width="33" height="26" alt=""/>
              </button>
          </form>
    </td>

<td>
<img src="../../files/lock.gif" title="اطلاعات بهره برداری  توسط شما ثبت نشده است" width="33" height="26" alt=""/>
<?php 
}
?>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_ayesh']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mal ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
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
 }
 else 
 {
echo '<p class=style8> بهره برداری با مشخصات وارد شده یافت نشد</p>'  ;
 }
 }
?>
       <p><button onclick="close_window()"><img src="../../files/goback.jpg" width="118" height="47"  title="بستن پنجره" alt="بستن پنجره"/></button></p>
  </td>
  </tr>
</table>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>