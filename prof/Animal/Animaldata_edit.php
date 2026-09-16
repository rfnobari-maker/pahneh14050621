<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
/////////////////////////////////////////////////// 
 if (isset($_POST['action'])) 
 {  
$date_s = $date_edit ;
$mor_cod_m = $login_session ;
$bah_cod_m = $_POST['bah_cod_m']; 
$add_city = $_POST['add_city'] ;
$add_abadi = $_POST['add_abadi'] ;
$id_ostan = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ;
$no_moj = $_POST['no_moj'] ;
$vaz_s = $_POST['vaz_s'] ;
$no_fa = $_POST['no_fa'] ;
$sh_yek = $_POST['sh_yek'] ;
$cod_api = $_POST['cod_api'] ;
$post_code = $_POST['post_code'] ;
$lng = $_POST['lng'] ;
$lat = $_POST['lat'] ;
$num_bah = $_POST['num_bah']; 
$id = $_POST['id']; 

if ($no_moj =='5')
{
$date_moj  = '' ; 
$sh_moj    = '' ; 
$exp_moj   = '' ; 
$z_moj_m   = 0 ; 
$z_moj_k   = 0 ; 
$z_m   = 0 ; 
$z_k   = 0 ; 
$t_h       = 0 ; 
}
else
{
$date_moj  = $_POST['date_moj'] ;
$sh_moj    = $_POST['sh_moj'] ;
$exp_moj   = $_POST['exp_moj'] ;
$z_moj_m   = $_POST['z_moj_m'] ;
$z_moj_k   = $_POST['z_moj_k'] ;
$z_m       = $_POST['z_m'] ;
$z_k       = $_POST['z_k'] ;
$t_h       = $_POST['t_h'] ;

}
if ($no_fa =='2' or $no_fa =='4' or $no_fa =='6' or $no_fa =='8' or $no_fa =='10' or $no_fa =='11')
{
$z_moj_m = $z_m = 0 ; 
}
$sal = '1399' ; 
$z_m_1 = $_POST['z_m_1'] ;
$t_h_1 = $_POST['t_h_1'] ;
$z_m_2 = $_POST['z_m_2'] ;
$t_h_2 = $_POST['t_h_2'] ;
$z_m_3 = $_POST['z_m_3'] ;
$t_h_3 = $_POST['t_h_3'] ;
$z_m_4 = $_POST['z_m_4'] ;
$t_h_4 = $_POST['t_h_4'] ;
$z_m_5 = $_POST['z_m_5'] ;
$t_h_5 = $_POST['t_h_5'] ;
$z_m_6 = $_POST['z_m_6'] ;
$t_h_6 = $_POST['t_h_6'] ;

$oz_ta = $_POST['oz_ta'] ;
$cod_ethad = $_POST['cod_ethad'] ;
$cod_tav = $_POST['cod_tav'] ;
if ($oz_ta =='3' )
{
$cod_ethad = '';
$cod_tav = '' ;
}
$query = "UPDATE Animal SET date_s=?,num_bah=?,add_abadi=?,add_city=?,no_moj=?,post_code=?
,sh_yek=?,cod_api=?,lng=?,lat=?,no_fa=?,sh_moj=?,date_moj=?,exp_moj=?,
z_moj_m=?,z_moj_k=?,z_m=?,z_k=?,t_h=?,z_m_1=?,t_h_1=?,z_m_2=?,t_h_2=?,z_m_3=?,t_h_3=?,z_m_4=?,
t_h_4=?,z_m_5=?,t_h_5=?,z_m_6=?,t_h_6=?,oz_ta=?,cod_ethad=?,cod_tav=?,vaz_s=? where id= ?" ;
$q = $dbh->prepare($query);
 $q->execute(array($date_s,$num_bah,$add_abadi,$add_city
,$no_moj,$post_code,$sh_yek,$cod_api,$lng,$lat,$no_fa,$sh_moj,$date_moj,$exp_moj,$z_moj_m,$z_moj_k,$z_m,$z_k,$t_h
,$z_m_1,$t_h_1,$z_m_2,$t_h_2,$z_m_3,$t_h_3,$z_m_4,$t_h_4,$z_m_5,$t_h_5,$z_m_6,$t_h_6,$oz_ta,$cod_ethad,$cod_tav,
$vaz_s,$id));
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_s,$time,$add_abadi,'تصحیح واحد پرورش دام-'.$bah_cod_m,$id_ostan) ; 
unset($date_s,$sal,$mor_cod_m,$bah_cod_m,$num_bah,$id_ostan,$id_city,$id_mar,$add_abadi,$add_city
,$no_maj,$post_code,$sh_yek,$cod_api,$lng,$lat,$no_fa,$sh_moj,$date_moj,$exp_moj,$z_moj_m,$z_moj_k,
$z_m,$z_k,$t_h,$z_m_1,$t_h_1,$z_m_2,$t_h_2,$z_m_3,$t_h_2,$z_m_4,$t_h_4,$z_m_5,$t_h_5,$z_m_6,$t_h_6,
$oz_ta,$cod_ethad,$cod_tav,$vaz_s);
alert ('اطلاعات واحد پرورش دام با موفقیت تصحیح شد ') ;
?>
<form  name="myform" class="myform" method="post" action="liste_Animal.php">
     <input type="hidden" name="action_lise" value="1" />
     <input type="hidden" name="back_p" value="1" />
      </form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
/////////////////////////////////////////////// 
if  (isset($_POST['bah_cod_m']))
{
$add_abadi = $_POST["add_abadi"]; 
$add_city  = $_POST["add_city"]; 
$bah_cod_m = $_POST['bah_cod_m'];
$m_poul    = $_POST['m_poul'];
$no_fa     = $_POST['no_fa'];
$vaz_s    = $_POST['vaz_s'];
if($vaz_s =='1') $v_vaz_s = 'ساکن' ;
if($vaz_s =='2') $v_vaz_s = 'غیر ساکن' ;
if($vaz_s =='3') $v_vaz_s = 'عشایر' ;
$no_moj    = $_POST['no_moj'];
$no_bah    = $_POST['no_bah'];
$id        = $_POST['id'];
$query = "SELECT * from Animal where id = :id"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$id));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$post_code = $row["post_code"]; 
$sh_yek = $row["sh_yek"]; 
$cod_api = $row["cod_api"]; 
$lng = $row['lng'] ;
$lat = $row['lat'] ;
$date_moj  = $row['date_moj'] ;
$sh_moj    = $row['sh_moj'] ;
$exp_moj   = $row['exp_moj'] ;
$z_moj_m   = $row['z_moj_m'] ;
$z_moj_k   = $row['z_moj_k'] ;
$z_m       = $row['z_m'] ;
$z_k       = $row['z_k'] ;
$t_h       = $row['t_h'] ;
$z_m_1 = $row['z_m_1'] ;
$t_h_1 = $row['t_h_1'] ;
$z_m_2 = $row['z_m_2'] ;
$t_h_2 = $row['t_h_2'] ;
$z_m_3 = $row['z_m_3'] ;
$t_h_3 = $row['t_h_3'] ;
$z_m_4 = $row['z_m_4'] ;
$t_h_4 = $row['t_h_4'] ;
$z_m_5 = $row['z_m_5'] ;
$t_h_5 = $row['t_h_5'] ;
$z_m_6 = $row['z_m_6'] ;
$t_h_6 = $row['t_h_6'] ;
$oz_ta = $row['oz_ta'] ;
$cod_ethad = $row['cod_ethad'] ;
$cod_mah = $row['cod_tav'] ;

if ($m_poul=='abadi') {
$query = "SELECT add_abadi,id_ostan,id_city,id_mar from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$add_abadi = $row["add_abadi"]; 
$add_city = '-'; 
$id_ostan = $row["id_ostan"]; 
$id_city = $row["id_city"]; 
$id_mar = $row["id_mar"]; 
}
if  ($m_poul=='shahr') {
$query = "SELECT add_city,id_ostan,id_city,id_mar from list_city where add_city = :add_city"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$add_city = $row["add_city"]; 
$add_abadi = '-'; 
$id_ostan = $row["id_ostan"]; 
$id_city = $row["id_city"]; 
$id_mar = $row["id_mar"]; 
}

 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="../jspc-gray.css">
	<script type="text/javascript" src="../js-persian-cal.min.js"></script>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
    </script>
<!--دریافت اطلاعات مالک -->
<script type="text/javascript">
$(document).ready(function()
{
$(".country").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_tavoni.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar").html(html);
} 
});
});
});
</script>
<!-- دریافت آدرس -->
<!-- پایان دریافت اطلاعات مالک -->
</head>
<body>
     <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td>
      <?php include('top.php'); ?>
           <p class="style8">ثبت اطلاعات واحد پرورش دام</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <br />
             <?php sar_data2($bah_cod_m,$no_bah) ;?>
    <form action="" method="post" id="form1" name="form1"><br />
      <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          
          <td height="25" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="31%" height="40" bgcolor="#CCCCCC"><div align="right" class="input_text"> <?php echo city_name1($id_city,$id_ostan)  ?></div></td>
          <td width="14%" bgcolor="#CCCCCC"><div align="right">:شهرستان</div></td>
          <td width="7%" bgcolor="#CCCCCC">&nbsp;</td>
          <td width="26%" bgcolor="#CCCCCC"><div align="right" class="input_text"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="22%" bgcolor="#CCCCCC"><div style="margin-right:10px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38" bgcolor="#CCCCCC"><div align="right" class="input_text"> <?php echo abadi_name($add_abadi); ?></div></td>
          <td bgcolor="#CCCCCC"><div align="right">: آبادی / شهر</div></td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td bgcolor="#CCCCCC"><div align="right" class="input_text"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td bgcolor="#CCCCCC"><div style="margin-right:10px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="63" bgcolor="#CCCCCC"><div align="right"> <span class="style2">درجه اعشار</span>
            <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">37.010521: مثال</span></div></td>
          <td bgcolor="#CCCCCC"><div align="right">:Y عرض جغرافیایی</div></td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td bgcolor="#CCCCCC"><div align="right"><span class="style2">درجه اعشار</span>
            <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">46.212486: مثال</span></div></td>
          <td bgcolor="#CCCCCC"><div style="margin-right:10px" align="right" >:X طول جغرافیایی </div></td>
        </tr>
        <tr>
          <td height="17" colspan="5" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="26" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
              </tr>
            <tr>
              <td height="45" bgcolor="#CCCCCC" class="style2"><div align="right"  >
                <input name="sh_yek" type="text"  class="input_text required Post_cod" id="post_code2"  style="width:150px; height:30px;  " tabindex="10"   dir="rtl" lang="fa" value="<?php echo $sh_yek ; ?>" maxlength="12" xml:lang="fa"/>
                </div></td>
              <td height="45" bgcolor="#CCCCCC"><div align="right"> : شناسه یکتا</div></td>
              <td height="45" bgcolor="#CCCCCC" class="style2">&nbsp;</td>
              <td height="45" bgcolor="#CCCCCC"><div align="right"  >
                <input name="post_code" type="text"  class="input_text required Post_cod" id="post_code3"  style="width:150px; height:30px;  " tabindex="9"   dir="rtl" lang="fa" value="<?php echo $post_code ; ?>" maxlength="10" xml:lang="fa"/>
                </div></td>
              <td height="45" bgcolor="#CCCCCC"><div style="margin-right:10px" align="right" > : کد پستی واحد </div></td>
              </tr>
            <tr>
              <td height="46" bgcolor="#CCCCCC"><div align="right">
                <select name="no_moj" disabled="disabled" class="input_text required" id="no_moj2" style="height:40px ; width:200px ; direction:rtl" tabindex="12">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($no_moj=='1') { echo 'selected="selected"' ; } ?>>پروانه بهره برداری واحد صنعتی</option>
                  <option value="2" <?php if ($no_moj=='2') { echo 'selected="selected"' ; } ?>>پروانه بهره برداری واحد  نیمه صنعتی</option>
                  <option value="3" <?php if ($no_moj=='3') { echo 'selected="selected"' ; } ?>>پروانه بهره برداری کوچک روستایی </option>
                  <option value="4" <?php if ($no_moj=='4') { echo 'selected="selected"' ; } ?>>کارت شناسایی</option>
                  <option value="5" <?php if ($no_moj=='5') { echo 'selected="selected"' ; } ?>>فاقد مجوز</option>
                  </select>
                </div></td>
              <td height="46" bgcolor="#CCCCCC"><div align="right"> : نوع مجوز </div></td>
              <td height="46" bgcolor="#CCCCCC">&nbsp;</td>
              <td height="46" bgcolor="#CCCCCC"><div align="right"  >
                <input name="cod_api" type="text"  class="input_text required Post_cod" id="cod_api"  style="width:150px; height:30px;  " tabindex="11"   dir="rtl" lang="fa" value="<?php echo $cod_api ; ?>" maxlength="12" xml:lang="fa"/>
                </div></td>
              <td height="46" bgcolor="#CCCCCC"><div style="margin-right:10px" align="right" > : کد اپیدیمیولوژیک </div></td>
              </tr>
            <tr>
              <td height="51" bgcolor="#CCCCCC" ><div align="right" class="input_text"> <?php echo $v_vaz_s; ?></div></td>
              <td bgcolor="#CCCCCC"><div align="right"> : وضعیت سکونت</div></td>
              <?php
 if($no_moj !='5' ) {?>
              <td width="7%" bgcolor="#CCCCCC">&nbsp;</td>
              <td width="26%" bgcolor="#CCCCCC"><div align="right">
                <select name="no_fa" disabled="disabled" class="input_text  required" id="no_fa" style="height:40px ; width:150px ; direction:rtl" tabindex="13">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($no_fa=='1') { echo 'selected="selected"' ; } ?>>گاو شیری </option>
                  <option value="2" <?php if ($no_fa=='2') { echo 'selected="selected"' ; } ?>>گوساله پرواری</option>
                  <option value="3" <?php if ($no_fa=='3') { echo 'selected="selected"' ; } ?>>گاومیش شیری</option>
                  <option value="4" <?php if ($no_fa=='4') { echo 'selected="selected"' ; } ?>>گاومیش پرواری</option>
                  <option value="5" <?php if ($no_fa=='5') { echo 'selected="selected"' ; } ?>>گوسفند داشتی</option>
                  <option value="6" <?php if ($no_fa=='6') { echo 'selected="selected"' ; } ?>>بره پرواری</option>
                  <option value="7" <?php if ($no_fa=='7') { echo 'selected="selected"' ; } ?>>بز داشتی</option>
                  <option value="8" <?php if ($no_fa=='8') { echo 'selected="selected"' ; } ?>>بز پرواری</option>
                  <option value="9" <?php if ($no_fa=='9') { echo 'selected="selected"' ; } ?>>شتر داشتی</option>
                  <option value="10" <?php if ($no_fa=='10') { echo 'selected="selected"' ; } ?>>شتر پرواری</option>
                  <option value="11" <?php if ($no_fa=='11') { echo 'selected="selected"' ; } ?>>پرورش و نگهداری اسب</option>
                  </select>
                </div></td>
              <td width="22%" bgcolor="#CCCCCC"><div style="margin-right:10px" align="right" > : نوع فعالیت</div></td>
              </tr>
            <tr>
              <td height="44" bgcolor="#CCCCCC"><div  align="right">
                <input name="date_moj" type="text"  class="pdate required input_text" id="pcal1"  style="width:100px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $date_moj ; ?>" maxlength="10" xml:lang="fa"/>
                <br />
                </div></td>
              <td bgcolor="#CCCCCC"><div  align="right">:تاریخ صدور مجوز</div></td>
              <td bgcolor="#CCCCCC">&nbsp;</td>
              <td bgcolor="#CCCCCC"><div  align="right">
                <input name="sh_moj" type="text" class="required  input_text" id="sh_moj" style="width:75px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $sh_moj ; ?>" maxlength="20" xml:lang="fa"/>
                <br />
                </div></td>
              <td bgcolor="#CCCCCC"><div style="margin-right:10px" align="right" > : شماره مجوز</div></td>
              </tr>
            <tr>
              <td height="45" bgcolor="#CCCCCC">&nbsp;</td>
              <td bgcolor="#CCCCCC">&nbsp;</td>
              <td bgcolor="#CCCCCC">&nbsp;</td>
              <td bgcolor="#CCCCCC"><div align="right">
                <input name="exp_moj" type="text" class="pdate required input_text" id="pcal2" style="width:75px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $exp_moj ; ?>"  maxlength="10" xml:lang="fa"/>
                <br />
                </div></td>
              <td bgcolor="#CCCCCC"><div style="margin-right:10px" align="right" >:مدت اعتبار یا تاریخ انقضاء</div></td>
              <?php } ?>
              </tr>
            </table></td>
        </tr>
          <tr>
          <td height="23" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong> آمار دام</strong></div></td>
          </tr>
        <tr>
          <td height="136" colspan="5" bgcolor="#CCCCCC">
         
          <?php 
		    if ($no_fa == 1 or $no_fa == 3 or $no_fa == 5 or $no_fa == 7 or $no_fa == 9  ) { ?>
          <br />
          <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
            <tr>
              <td width="15%" height="35" bgcolor="#FFFFCC">کل گله </td>
              <td width="16%" bgcolor="#FFFFCC">دام مولد </td>
              <td width="17%" bgcolor="#FFFFCC">عنوان</td>
            </tr>
            <tr>
              <td height="41"><div align="center">
                <input name="z_moj_k" type="text" class="required digits input_text" id="z_moj_k" style="width:70px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $z_moj_k ; ?>" maxlength="5" xml:lang="fa"/>
                <br />
              </div></td>
              <td><div align="center">
                <input name="z_moj_m" type="text" class="required digits input_text" id="z_moj_m" style="width:70px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $z_moj_m ; ?>" maxlength="5" xml:lang="fa"/>
                <br />
              </div></td>
              <td>ظرفیت مندرج در مجوز</td>
            </tr>
            <tr>
              <td height="41"><div align="center">
                <input name="z_k" type="text" class="z_k required digits input_text" id="z_k" style="width:70px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $z_k ; ?>" maxlength="5" xml:lang="fa"/>
                <br />
              </div></td>
              <td><div align="center">
                <input name="z_m" type="text" class="required digits input_text" id="z_m" style="width:70px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $z_m ; ?>" maxlength="5" xml:lang="fa"/>
                <br />
              </div></td>
              <td>ظرفیت موجود </td>
            </tr>
            <tr>
              <td height="41"><div align="center">
                <input name="t_h" type="text" class="t_h required digits input_text" id="t_h" style="width:70px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $t_h ; ?>" maxlength="5" xml:lang="fa"/>
                <br />
              </div></td>
              <td colspan="2">تعداد دام هویت گذاری شده</td>
            </tr>
            <tr>
              <td height="41" colspan="3"><span class="style8">اگر واحد به غیر از موارد  فوق دارای دام دیگری نیز هست میبایست  جدول زیر را تکمیل  نمایید </span></td>
              </tr>
          </table>
<?php } if ($no_fa == 2 or $no_fa == 4 or $no_fa == 6 or $no_fa == 8 or $no_fa == 10  or $no_fa == 11 ) { ?>
            <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
              <tr>
                <td width="15%" height="35" bgcolor="#FFFFCC">کل گله </td>
                <td width="17%" bgcolor="#FFFFCC">عنوان</td>
              </tr>
              <tr>
                <td><div align="center">
                  <input name="z_moj_k" type="text" class="required digits input_text" id="z_moj_k" style="width:70px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $z_moj_k ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td>ظرفیت مندرج در مجوز</td>
              </tr>
              <tr>
                <td><div align="center">
                  <input name="z_k" type="text" class="z_k required digits input_text" id="z_k" style="width:70px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $z_k ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td>ظرفیت موجود </td>
              </tr>
              <tr>
                <td><div align="center">
                  <input name="t_h" type="text" class="t_h required digits input_text" id="t_h" style="width:70px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $t_h ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td>تعداد دام هویت گذاری شده</td>
              </tr>
              <tr>
                <td height="28" colspan="2"><span class="style8">اگر واحد به غیر از موارد  فوق دارای دام دیگری نیز هست میبایست  جدول زیر را تکمیل  نمایید </span></td>
                </tr>
            </table>
            <?php }  ?>
            <br />
            <br />
            <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
              <tr>
                <td width="14%" height="38" bgcolor="#FFFFCC">الاغ</td>
                <td width="13%" bgcolor="#FFFFCC">اسب </td>
                <td width="14%" bgcolor="#FFFFCC">شتر</td>
                <td width="14%" bgcolor="#FFFFCC">گاومیش</td>
                <td width="14%" bgcolor="#FFFFCC">گاو و گوساله </td>
                <td width="14%" bgcolor="#FFFFCC">بز و بزغاله </td>
                <td width="17%" bgcolor="#FFFFCC">عنوان</td>
              </tr>
              <tr>
                <td height="41"><div align="center">
                  <input name="z_m_6" type="text" class="z_m_6 required digits input_text" id="z_m_6" style="width:70px; height:30px ; " tabindex="35" dir="rtl" lang="fa" value="<?php echo $z_m_6 ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td height="41"><div align="center">
                  <input name="z_m_5" type="text" class="z_m_5 required digits input_text" id="z_m_5" style="width:70px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $z_m_5 ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td height="41"><div align="center">
                  <input name="z_m_4" type="text" class="z_m_4 required digits input_text" id="z_m_4" style="width:70px; height:30px ; " tabindex="31" dir="rtl" lang="fa" value="<?php echo $z_m_4 ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td height="41"><div align="center">
                  <input name="z_m_3" type="text" class="z_m_3 required digits input_text" id="z_m_3" style="width:70px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $z_m_3 ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td height="41"><div align="center">
                  <input name="z_m_2" type="text" class="z_m_2 required digits input_text" id="z_m_2" style="width:70px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $z_m_2 ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td height="41"><div align="center">
                  <input name="z_m_1" type="text" class="z_m_1 required digits input_text" id="z_m_1" style="width:70px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $z_m_1 ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td>ظرفیت موجود </td>
              </tr>
              <tr>
                <td height="41"><div align="center">
                  <input name="t_h_6" type="text" class="t_h_6 required digits input_text" id="t_h_6" style="width:70px; height:30px ; " tabindex="36" dir="rtl" lang="fa" value="<?php echo $t_h_6 ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td height="41"><div align="center">
                  <input name="t_h_5" type="text" class="t_h_5 required digits input_text" id="t_h_5" style="width:70px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $t_h_5 ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td height="41"><div align="center">
                  <input name="t_h_4" type="text" class="t_h_4 required digits input_text" id="t_h_4" style="width:70px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $t_h_4 ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td height="41"><div align="center">
                  <input name="t_h_3" type="text" class="t_h_3 required digits input_text" id="t_h_3" style="width:70px; height:30px ; " tabindex="30" dir="rtl" lang="fa" value="<?php echo $t_h_3 ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td height="41"><div align="center">
                  <input name="t_h_2" type="text" class="t_h_2 required digits input_text" id="t_h_2" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $t_h_2 ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td height="41"><div align="center">
                  <input name="t_h_1" type="text" class="t_h_1 required digits input_text" id="t_h_1" style="width:70px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $t_h_1 ; ?>" maxlength="5" xml:lang="fa"/>
                  <br />
                </div></td>
                <td>تعداد دام هویت گذاری شده</td>
              </tr>
        </table>
        </td>
        </tr>
        <tr>
          <td height="35" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="42%" height="51" bgcolor="#CCCCCC" class="style2">&nbsp;</td>
              <td width="10%" height="51" bgcolor="#CCCCCC" >&nbsp;</td>
              <td width="36%" height="51" bgcolor="#CCCCCC" class="style2"><div align="right">
                <select name="oz_ta" class="input_text required " id="seeAnotherField2"  style="height:40px ; width:100px ; direction:rtl" tabindex="37">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($oz_ta=='1') { echo 'selected="selected"' ; } ?>>بلی</option>
                  <option value="3" <?php if ($oz_ta=='3') { echo 'selected="selected"' ; } ?>>خیر</option>
                  <option value="2" <?php if ($oz_ta=='2') { echo 'selected="selected"' ; } ?>>عضو خدماتی</option>
                </select>
              </div></td>
              <td width="12%" height="51" bgcolor="#CCCCCC" ><div style="margin-right:20px" align="right"> :عضویت در تعاونی</div></td>
            </tr>
            <tr>
              <td height="51" bgcolor="#CCCCCC" class="style2"><div align="right" id="otherFieldDiv6">
                <select  name="cod_tav" class="target required input_text mar" style="width:350px ; height:40px" tabindex="39" dir="rtl" id="cod_mah">
<?php
$query = "SELECT DISTINCT product_cod,product_name FROM `tavoni` WHERE  `group_cod` = $cod_ethad" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['product_cod'] ;?>"
   <?php if ($row['product_cod']==$cod_mah) echo 'selected=selected'?>> <?php echo $row['product_name'] ;?></option>
     <?php
}
?>                </select>
              </div></td>
              <td bgcolor="#CCCCCC"><div id="otherFieldDiv5" style="margin-right:5px" align="right"> :نام تعاونی</div>
                <span style="margin:10px"></div>
</td>
              <td bgcolor="#CCCCCC"><span style="margin:10px">
              <div align="right" id="otherFieldDiv4">
                <select  name="cod_ethad" class="qroup required input_text country" id="cod_ethad" style="width:300px ; height:40px" tabindex="38" dir="rtl"  >
                  <option value="0" > انتخاب نام تعاونی</option>
                  <?php
$query = "SELECT DISTINCT group_cod,group_name FROM `tavoni` "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                  <option value="<?php  echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']==$cod_ethad) echo 'selected=selected'?>>
                    <?php  echo $row['group_name'] ;?>
                    </option>
                  <?php }?>
                </select>
              </div></td>
              <td height="51" bgcolor="#CCCCCC" ><div id="otherFieldDiv3"
 style="margin-right:20px" align="right"> :نام اتحادیه</div></td>
            </tr>
          </table></td>
        </tr>
        </table>
          <div align="center">
        <p>
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="num_bah"   value=<?php echo $no_bah; ?> />
     <input type="hidden" name="id_ostan"  value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city"   value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city"  value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar"    value=<?php echo $id_mar; ?> />
     <input type="hidden" name="vaz_s"    value="<?php echo $vaz_s ;?>" />
     <input type="hidden" name="no_fa"     value=<?php echo $no_fa; ?> />
     <input type="hidden" name="no_moj"    value="<?php echo $no_moj ;?>" />
     <input type="hidden" name="sal"       value="<?php echo $sal ;?>" />
     <input type="hidden" name="id"       value="<?php echo $id ;?>" />
     <input type="submit" name="action"    value=" تصحیح اطلاعات" style="width:150px ; height:45px" tabindex="40" id="btn1" onClick="setTimeout(disableFunction, 1);"/>
     <a href="liste_Animal.php">
          <input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="41" /></a>
</form> 
<script>
function disableFunction() {
    document.getElementById("btn1").disabled = 'true';
	$("#btn1").attr("disabled","");
}
</script>
    <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal1' );
		var objCal1 = new AMIB.persianCalendar( 'pcal2' );

		  </script>
  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Animal.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
   </tr>
</table>
<script src="hide-show-fields-form2.js"></script>
</body>
</html>

    <script>
        $('.t_h').change(function () {
            var z_k = document.getElementById("z_k").value;
            var t_h = document.getElementById("t_h").value;
		    if (parseFloat(t_h) > parseFloat(z_k)) {
               alert("تعداد دام هویت گذاری شده بیش از دام موجود است ");
                  // پاک کردن مقدار تولید
           $('#t_h').val('');
                // فوکوس روی تولید محصول
                 document.getElementById("t_h").focus();
            }
        });

        $('.z_k').change(function () {
                  // پاک کردن مقدار تولید
           $('#t_h').val('');
                // فوکوس روی تولید محصول
        });

        $('.t_h_1').change(function () {
            var z_m_1 = document.getElementById("z_m_1").value;
            var t_h_1 = document.getElementById("t_h_1").value;
		    if (parseFloat(t_h_1) > parseFloat(z_m_1)) {
               alert("تعداد دام هویت گذاری شده بیش از دام موجود است ");
                  // پاک کردن مقدار تولید
           $('#t_h_1').val('');
                // فوکوس روی تولید محصول
                 document.getElementById("t_h_1").focus();
            }
        });

        $('.z_m_1').change(function () {
                  // پاک کردن مقدار تولید
           $('#t_h_1').val('');
                // فوکوس روی تولید محصول
        });

        $('.t_h_2').change(function () {
            var z_m_2 = document.getElementById("z_m_2").value;
            var t_h_2 = document.getElementById("t_h_2").value;
		    if (parseFloat(t_h_2) > parseFloat(z_m_2)) {
               alert("تعداد دام هویت گذاری شده بیش از دام موجود است ");
                  // پاک کردن مقدار تولید
           $('#t_h_2').val('');
                // فوکوس روی تولید محصول
                 document.getElementById("t_h_2").focus();
            }
        });

        $('.z_m_2').change(function () {
                  // پاک کردن مقدار تولید
           $('#t_h_2').val('');
                // فوکوس روی تولید محصول
        });
//
        $('.t_h_3').change(function () {
            var z_m_3 = document.getElementById("z_m_3").value;
            var t_h_3 = document.getElementById("t_h_3").value;
		    if (parseFloat(t_h_3) > parseFloat(z_m_3)) {
               alert("تعداد دام هویت گذاری شده بیش از دام موجود است ");
                  // پاک کردن مقدار تولید
           $('#t_h_3').val('');
                // فوکوس روی تولید محصول
                 document.getElementById("t_h_3").focus();
            }
        });

        $('.z_m_3').change(function () {
                  // پاک کردن مقدار تولید
           $('#t_h_3').val('');
                // فوکوس روی تولید محصول
        });

//
        $('.t_h_4').change(function () {
            var z_m_4 = document.getElementById("z_m_4").value;
            var t_h_4 = document.getElementById("t_h_4").value;
		    if (parseFloat(t_h_4) > parseFloat(z_m_4)) {
               alert("تعداد دام هویت گذاری شده بیش از دام موجود است ");
                  // پاک کردن مقدار تولید
           $('#t_h_4').val('');
                // فوکوس روی تولید محصول
                 document.getElementById("t_h_4").focus();
            }
        });

        $('.z_m_4').change(function () {
                  // پاک کردن مقدار تولید
           $('#t_h_4').val('');
                // فوکوس روی تولید محصول
        });

//
        $('.t_h_5').change(function () {
            var z_m_5 = document.getElementById("z_m_5").value;
            var t_h_5 = document.getElementById("t_h_5").value;
		    if (parseFloat(t_h_5) > parseFloat(z_m_5)) {
               alert("تعداد دام هویت گذاری شده بیش از دام موجود است ");
                  // پاک کردن مقدار تولید
           $('#t_h_5').val('');
                // فوکوس روی تولید محصول
                 document.getElementById("t_h_5").focus();
            }
        });

        $('.z_m_5').change(function () {
                  // پاک کردن مقدار تولید
           $('#t_h_5').val('');
                // فوکوس روی تولید محصول
        });

//
        $('.t_h_6').change(function () {
            var z_m_6 = document.getElementById("z_m_6").value;
            var t_h_6 = document.getElementById("t_h_6").value;
		    if (parseFloat(t_h_6) > parseFloat(z_m_6)) {
               alert("تعداد دام هویت گذاری شده بیش از دام موجود است ");
                  // پاک کردن مقدار تولید
           $('#t_h_6').val('');
                // فوکوس روی تولید محصول
                 document.getElementById("t_h_6").focus();
            }
        });

        $('.z_m_6').change(function () {
                  // پاک کردن مقدار تولید
           $('#t_h_6').val('');
                // فوکوس روی تولید محصول
        });

</script>

