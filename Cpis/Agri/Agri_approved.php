<?php
include("../../lock_cp.php");
include("../../event.php");
include('../side_menu1.php');
$z_sal           = isset($_POST['z_sal'])        ? $_POST['z_sal']        : '';
$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <style type="text/css">
<!--
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
/* Modal Styles */
.modal {
    display: none; 
    position: fixed; 
    z-index: 9999; 
    left: 0; 
    top: 0; 
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgba(0,0,0,0.4);
}
.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 500px;
    height: 400px;
    border-radius: 15px;
    position: relative;
    box-shadow: 0 4px 16px rgba(0,0,0,0.2);
    display: flex;
    flex-direction: column;
}
.close {
    color: #aaa;
    position: absolute;
    left: 10px;
    top: 10px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}
.profile-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  font-family: Tahoma, sans-serif;
  padding: 8px;
  height: 100%;
  background-color:#CCC ;
  border-radius:15px ;
  
  
}

.city-label {
  background-color: #005c8c;
  color: white;
  padding: 4px 10px;
  border-radius: 6px;
  font-size: 15px;
  font-weight: bold;
  margin-bottom: 6px;
}

.user-name {
  font-weight: bold;
  color:#039 ;
  font-size:12px ;
  margin-top: 5px;
}

.user-code {
  color: #555;
}

.user-tel {
  display: flex;
  align-items: center;
  gap: 5px;
  color: #2e7d32;
  font-size: 13px;
}

.phone-icon {
  width: 14px;
  height: 14px;
}


</style>
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_popup2(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php include("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
      <h3 style="margin: 0; color: #903; font-size: 18px;">تایید اطلاعات زراعی</h3>
      <form  id="reg-form" method="post" action="#1">
        <div dir="rtl" style="width: 380px; padding: 20px; border: 1px solid #e0e0e0; margin: auto; text-align: center; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); background: linear-gradient(to bottom, #f9f9f9, #ffffff); font-family: 'Tahoma', 'Arial', sans-serif;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" style="padding-bottom: 15px;">
                
            </td>
        </tr>
        <tr>
            <td style="width: 150px; text-align: left; padding: 8px 0; color: #555; font-size: 14px;">سال زراعی:</td>
            <td style="padding: 8px 0;">
                <select name="z_sal" id="z_sal" style="width: 200px; height: 40px; padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff; font-family: inherit; font-size: 14px; color: #333; outline: none; transition: border 0.3s;" onfocus="this.style.borderColor='#09C'">
    <option value="1403-1404" selected>1403-1404</option>
</select>

            </td>
        </tr>
        <tr>
          <td colspan="2" style="padding-top: 20px;">
            <button type="submit" name="action" style="width: 120px; height: 45px; background: linear-gradient(to bottom, #09C, #0077aa); color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.2);" 
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)'" 
                        onmouseout="this.style.transform=''; this.style.boxShadow='0 2px 5px rgba(0,0,0,0.2)'">
              جستجو
              </button>
            </td>
        </tr>
    </table>
</div>
 </form>
            <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['action'])) 
 {  
  $v_id_ostan = "id_ostan='$id_ostan'" ;

 if ($conf  == '') {$V_conf =1;} elseif ($conf  == '2') {$V_conf ="app_level = '' ";}  else{ $v_id_mar = "app_level= ''" ;}

 $query ="SELECT 
    a.id_ostan, 
    (SELECT username FROM users WHERE  id_ostan = a.id_ostan AND chief = '1' LIMIT 1) AS mor_cod_m,
    SUM(a.zer_kesht_a) AS zer_keshta,
    SUM(a.zer_kesht_b) AS zer_keshtb,
    SUM(a.s_bar_a) AS s_bara,
    SUM(a.s_bar_b) AS s_barb,
    SUM(a.mah_tol) AS mahtol,
    SUM(a.mah_tolp) AS mahtolp,

    SUM(CASE WHEN a.app_level = '3' THEN a.zer_kesht_a ELSE 0 END) AS zer_keshta_app,
    SUM(CASE WHEN a.app_level = '3' THEN a.zer_kesht_b ELSE 0 END) AS zer_keshtb_app,
    SUM(CASE WHEN a.app_level = '3' THEN a.s_bar_a ELSE 0 END) AS s_bara_app,
    SUM(CASE WHEN a.app_level = '3' THEN a.s_bar_b ELSE 0 END) AS s_barb_app,
    SUM(CASE WHEN a.app_level = '3' THEN a.mah_tol ELSE 0 END) AS mahtol_app,
    SUM(CASE WHEN a.app_level = '3' THEN a.mah_tolp ELSE 0 END) AS mahtolp_app,

    SUM(CASE WHEN a.app_level = '4' THEN a.zer_kesht_a ELSE 0 END) AS zer_keshta_app4,
    SUM(CASE WHEN a.app_level = '4' THEN a.zer_kesht_b ELSE 0 END) AS zer_keshtb_app4,
    SUM(CASE WHEN a.app_level = '4' THEN a.s_bar_a ELSE 0 END) AS s_bara_app4,
    SUM(CASE WHEN a.app_level = '4' THEN a.s_bar_b ELSE 0 END) AS s_barb_app4,
    SUM(CASE WHEN a.app_level = '4' THEN a.mah_tol ELSE 0 END) AS mahtol_app4,
    SUM(CASE WHEN a.app_level = '4' THEN a.mah_tolp ELSE 0 END) AS mahtolp_app4
FROM $Agri_prod_table a
WHERE 1
GROUP BY a.id_ostan; "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
 <div align="center"><form  action="Agri_rep16_xls.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
                   <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
                   <input type="hidden" name="id_mar" value="<?php echo  $id_mar ;?>" />
                   <input type="hidden" name="add_abadi" value="<?php echo  $add_abadi ;?>" />
                   <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
                   <input type="hidden" name="no_kesh" value="<?php echo  $no_kesh ;?>" />
                   <input type="hidden" name="mor_cod_m" value="<?php echo  $mor_cod_m ;?>" />
                   <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
                   <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
                   <input type="hidden" name="mah_name" value="<?php echo $mah_name ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></div>

<div style="width: 100%; height: 500px; overflow-y: auto; overflow-x: hidden;">
<table align="center" class="my-table">
    <!-- هدر جدول (ثابت می‌ماند) -->
    <thead style="position: sticky; top: 0; background-color: #336699; z-index: 10;">
        <tr align="center" class="text1">
            <td rowspan="2" bgcolor="#336699">عملیات</td>
            <td height="46" colspan="2" bgcolor="#336699">میزان تولید محصول<br />
            <span class="style8">تن</span></td>
            <td colspan="3" bgcolor="#336699">سطح برداشت<br />
                <span class="style8">هکتار</span></td>
            <td colspan="3" bgcolor="#336699">سطح زیر کشت <br />
            <span class="style8">هکتار</span></td>
            <td width="11%" rowspan="2" bgcolor="#336699">وضعیت رکورد</td>
            <td width="11%" rowspan="2" bgcolor="#336699">استان</td>
            <td width="4%" rowspan="2" bgcolor="#336699">ردیف</td>
        </tr>
        <tr align="center" class="text1">
            <td height="38" bgcolor="#336699">قطعی</td>
            <td bgcolor="#336699">پیش بینی</td>
            <td width="7%" height="38" bgcolor="#336699">کل</td>
            <td width="7%" bgcolor="#336699">کشت دوم</td>
            <td width="7%" bgcolor="#336699">کشت اول</td>
            <td height="38" bgcolor="#336699">کل</td>
            <td bgcolor="#336699">کشت دوم</td>
            <td width="6%" bgcolor="#336699">کشت اول</td>
        </tr>
    </thead>
    
    <!-- بدنه جدول (قابل اسکرول) -->
    <tbody>
    <?php
    $r = 1; 
    foreach($stmt as $row){
        $zer_keshta = round($row['zer_keshta'],3);
        $zer_keshtb = round($row['zer_keshtb'],3);
        $zer_keshtkol =  $zer_keshta + $zer_keshtb; 
        $s_bara = round($row['s_bara'],3);
        $s_barb = round($row['s_barb'],3);
        $s_barkol =  $s_bara + $s_barb ;
        $mahtol= round($row['mahtol'],3) ; 
        $mahtolp= round($row['mahtolp'],3) ;

        $zer_keshta_app = round($row['zer_keshta_app'],3);
        $zer_keshtb_app = round($row['zer_keshtb_app'],3);
        $zer_keshtkol_app =  $zer_keshta_app + $zer_keshtb_app ; 
        $s_bara_app = round($row['s_bara_app'],3);
        $s_barb_app = round($row['s_barb_app'],3);
        $s_barkol_app =  $s_bara_app + $s_barb_app ;
        $mahtol_app= round($row['mahtol_app'],3) ; 
        $mahtolp_app= round($row['mahtolp_app'],3) ;

        $zer_keshta_app4 = round($row['zer_keshta_app4'],3);
        $zer_keshtb_app4 = round($row['zer_keshtb_app4'],3);
        $zer_keshtkol_app4 =  $zer_keshta_app4 + $zer_keshtb_app4 ; 
        $s_bara_app4 = round($row['s_bara_app4'],3);
        $s_barb_app4 = round($row['s_barb_app4'],3);
        $s_barkol_app4 =  $s_bara_app4 + $s_barb_app4 ;
        $mahtol_app4= round($row['mahtol_app4'],3) ; 
        $mahtolp_app4= round($row['mahtolp_app4'],3) ;

        $pic = user_pic($row['mor_cod_m']) ;  
    ?>
        <!-- ردیف کل -->
        <tr style="color:#09F">
           <td rowspan="3" style="font-size: 20px; text-align: center; vertical-align: middle; <?php if($r%2 == 0) echo 'background-color:#FFFFCC;' ?>">
  <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">

    <?php if ($zer_keshtkol_app > 0 ) { ?>
      <a href="#" title="تایید/عدم تایید"
         onclick="openModal('<?php echo $row['id_ostan']; ?>', '<?php echo $z_sal; ?>', '<?php echo $user_check; ?>'); return false;">
        📝
      </a>
    <?php } ?>

    <form action="app_history" method="post" onsubmit="target_popup2(this)" style="margin: 0;">
      <input type="hidden" name="id_ostan" value="<?php echo $row['id_ostan']; ?>">
      <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>">
      <button title="سوابق بررسی های قبلی" style="font-size: 20px; cursor: pointer; background: none; border: none;">🔄</button>
    </form>

    <form action="Agri_mor.php" method="post" onsubmit="target_popup2(this)" style="margin: 0;">
      <input type="hidden" name="id_ostan" value="<?php echo $row['id_ostan']; ?>">
      <input type="hidden" name="z_sal" value="<?php echo $z_sal; ?>">
      <button title="نمایش اطلاعات به تفکیک محصول" style="font-size: 20px; cursor: pointer; background: none; border: none;">👁️</button>
    </form>

  </div>
</td>

            <td width="8%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>><?php echo $mahtol ;?></td>
            <td width="9%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>><?php echo $mahtolp ;?></td>
            <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>><?php echo $s_barkol ;?></td>
            <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>><?php echo $s_barb ;?></td>
            <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>><?php echo $s_bara ;?></td>
            <td width="7%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>><?php echo $zer_keshtkol ;?></td>
            <td width="7%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>><?php echo $zer_keshtb ;?></td>
            <td height="53" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>><?php echo $zer_keshta ;?></td>
            <td style="color:#333; font-size:14px" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>>کل</td>
<td rowspan="3" class="profile-cell <?php echo ($r % 2 == 0) ? 'highlight' : '' ?>">
    <div dir="rtl" class="profile-content">
  <span class="city-label"><?php echo ostan_name($row['id_ostan']) ?></span>

  <img src="../../files/users/<?php echo $pic ?>" width="37" height="43" alt="">

  <div class="user-name"><?php echo user_name($row['mor_cod_m']) ?></div>
  <div class="user-code"><?php echo $row['mor_cod_m'] ?></div>
  
  <div class="user-tel">
        <?php echo user_tel($row['mor_cod_m']) ?>
  </div>
</div>

</td>

            <td rowspan="3" style="color:#333" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>><?php echo $r;?></td>
        </tr>
        
        <!-- ردیف تایید شده -->
        <tr style="color:#093">
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $mahtol_app4 ;?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $mahtolp_app4 ;?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $s_barkol_app4 ;?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $s_barb_app4 ;?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $s_bara_app4 ;?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $zer_keshtkol_app4 ;?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $zer_keshtb_app4 ;?></td>
            <td height="58" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $zer_keshta_app4 ;?></td>
            <td style="color:#333; font-size:14px" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>>تایید شده</td>
        </tr>
        
        <!-- ردیف بررسی/تایید نشده -->
        <tr style="color:#F90">
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $mahtol_app ;?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $mahtolp_app ;?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $s_barkol_app ;?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $s_barb_app ;?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $s_bara_app ;?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $zer_keshtkol_app ;?></td>
            <td <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $zer_keshtb_app ;?></td>
            <td height="40" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $zer_keshta_app ;?></td>
            <td style="color:#333; font-size:14px" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>>بررسی / تایید نشده</td>
        </tr>
        
        <!-- ردیف برگشت از وزارت -->
        <?php
    $r++;
    }
    ?>
    </tbody>
</table>
</div>
            <?php
}
}
?>
            <div id="modal" class="modal" style="display: none;">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <iframe id="forgetIframe" width="100%" height="100%" style="border: none;  border-radius: 15px;"></iframe>
                </div>
            </div>


    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>
<script>
    function openModal(id_ostan, z_sal,username) {
      var url = "approved.php?id_ostan=" + encodeURIComponent(id_ostan) + "&z_sal=" + encodeURIComponent(z_sal) + "&username=" + encodeURIComponent(username);
        document.getElementById("forgetIframe").src = url;
        document.getElementById("modal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("modal").style.display = "none";
        document.getElementById("forgetIframe").src = "";
    }
</script> 