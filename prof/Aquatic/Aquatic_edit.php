<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
include('../cod_m.php') ;
$mor_cod_m = $login_session ;
$m_page      = isset($_POST['m_page']) ? $_POST['m_page'] : null;
$h_add_abadi = isset($_POST['h_add_abadi']) ? $_POST['h_add_abadi'] : null;
$h_add_city  = isset($_POST['h_add_city']) ? $_POST['h_add_city'] : null;
$h_no_fa     = isset($_POST['h_no_fa']) ? $_POST['h_no_fa'] : null;
$h_no_mal    = isset($_POST['h_no_mal']) ? $_POST['h_no_mal'] : null;
$h_sal       = isset($_POST['h_sal']) ? $_POST['h_sal'] : null;
$id          = isset($_POST['id']) ? $_POST['id'] : null;
$num_bah     = isset($_POST['num_bah']) ? $_POST['num_bah'] : null;
$m_poul      = isset($_POST['m_poul']) ? $_POST['m_poul'] : null;
$no_mal      = isset($_POST['no_mal']) ? $_POST['no_mal'] : null;
$bah_cod_m   = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : null;
$sal         = isset($_POST['sal']) ? $_POST['sal'] : null;
$add_abadi   = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : null;
$add_city    = isset($_POST['add_city']) ? $_POST['add_city'] : null;

// اعمال شرط بر اساس مقادیر add_city و add_abadi
if ($add_city == '-') {
    $m_poul = 'abadi';
}
if ($add_abadi == '-') {
    $m_poul = 'shahr';
}

$no_fa = isset($_POST['no_fa']) ? $_POST['no_fa'] : null;
$no_mal = isset($_POST['no_mal']) ? $_POST['no_mal'] : null;

// کیلک دکمه ادامه
if (isset($_POST['action'])) {
    $sal       = isset($_POST['sal']) ? $_POST['sal'] : null; // این خط تکراری است اگر $sal قبلا گرفته شده باشد
    $m_poul    = isset($_POST['m_poul']) ? $_POST['m_poul'] : null; // این خط تکراری است اگر $m_poul قبلا گرفته شده باشد

    $mess = ''; // مقداردهی اولیه به $mess

    if ($m_poul == '') {
        $mess .= 'موقعیت بهره برداری را تعیین کنید <p>';
    }
    
    $add_city = isset($_POST['add_city']) ? $_POST['add_city'] : null; // این خط تکراری است اگر $add_city قبلا گرفته شده باشد
    if ($m_poul == 'shahr' && $add_city == '') {
        $mess .= 'نام شهر را انتخاب کنید<p>';
    }
    
    $add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : null; // این خط تکراری است اگر $add_abadi قبلا گرفته شده باشد
    if ($m_poul == 'abadi' && $add_abadi == '') {
        $mess .= 'نام آبادی را انتخاب کنید<p>';
    }

    $bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : null; // این خط تکراری است اگر $bah_cod_m قبلا گرفته شده باشد
    if ($bah_cod_m == '') {
        $mess .= 'کد ملی را وارد کنید<p>';
    }
    
    $no_fa = isset($_POST['no_fa']) ? $_POST['no_fa'] : null; // این خط تکراری است اگر $no_fa قبلا گرفته شده باشد
    if ($no_fa == '') {
        $mess .= 'نوع و کلاس محصول تولیدی را انتخاب کنید<p>';
    }
    
    $no_mal = isset($_POST['no_mal']) ? $_POST['no_mal'] : null; // این خط تکراری است اگر $no_mal قبلا گرفته شده باشد
if ($no_mal=='') $mess.='نوع مالکیت را انتخاب کنید'.'<p>' ;
if ($bah_cod_m<>'' & check_code_melli($bah_cod_m)<>1)  $mess.='کد ملی بهره بردار صحیح نیست' ; 
if ((isset($_POST['action'])) and ($mess==''))
{
$query = "SELECT * from bah where bah_cod_m = '$bah_cod_m'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
if ($count_codm==0) { $mess='اطلاعات بهره بردار یافت نشد <p> برای ثبت اطلاعات گلخانه ، ابتدا اطلاعات بهره بردار را ثبت نمایید ' ; 
$not_found_bah= true ;
}
if ($count_codm>1) {
?>
	 <form name="myform1" class="myform" method="post" action="bahEdit_history2.php">
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
           <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
           <input type="hidden" name="sal" value="<?php echo $sal ;?>" />
           <input type="hidden" name="id" value="<?php echo $id ;?>" />
           <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
           
           <input type="hidden" name="m_page" value="<?php echo $m_page?>" />
           <input type="hidden" name="h_add_abadi" value="<?php echo $h_add_abadi?>" />
           <input type="hidden" name="h_add_city" value="<?php echo $h_add_city?>" />
           <input type="hidden" name="h_no_fa" value="<?php echo $h_no_fa?>" />
           <input type="hidden" name="h_no_mal" value="<?php echo $h_no_mal?>" />
           <input type="hidden" name="h_sal" value="<?php echo $h_sal?>" />


   </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
?>
	 <form name="myform1" class="myform" method="post" action="Aquaticdata_edit.php">
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
           <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
           <input type="hidden" name="sal" value="<?php echo $sal ;?>" />
           <input type="hidden" name="id" value="<?php echo $id ;?>" />
           <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
           <input type="hidden" name="m_page" value="<?php echo $m_page?>" />
           <input type="hidden" name="h_add_abadi" value="<?php echo $h_add_abadi?>" />
           <input type="hidden" name="h_add_city" value="<?php echo $h_add_city?>" />
           <input type="hidden" name="h_no_fa" value="<?php echo $h_no_fa?>" />
           <input type="hidden" name="h_no_mal" value="<?php echo $h_no_mal?>" />
           <input type="hidden" name="h_sal" value="<?php echo $h_sal?>" />

    </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="../reza_1.css">
    <link href="../radio.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<script src="../../15_files/jquery.js" type="text/javascript"></script>
<script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
<script>
function autoSubmit()
{
    var formObject = document.forms['reg-form'];
    formObject.submit();
}
</script>
<!--style the error message--> 
<style type="text/css"> 
.error { 
    display: block; 
    color: red; 
    font-style: italic; 
} 
#message { 
    display:none; 
    font-size:15px; 
    font-weight:bold; 
    color:#333333; 
} 
</style> 
</head>
<body>
<div id="rasul" style="width: 100%; height: 100%; background: #726d6d; display: none;  opacity: 0.6; position: fixed; z-index: 4;">
    <img src="img/loading2.gif" style="margin: auto;float: right;z-index: 93;width: 90px;min-height: 50px;position: fixed;left: 0;right: 0;margin: 200px auto;">
</div>
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
  <?php include('top.php'); ?>
    <td width="840" >

           <p class="style8">ویرایش اطلاعات مزرعه پرورش و تکثیر آبزیان<a name="1" id="1"></a><br />
           <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>           </p>
           <div id="div">
             <div id="mess"><?php echo $mess ?>
              </div>
             <form  id="reg-form" method="post" action="#1">
               <table width="100%" height="97" border="0">
               <tr>
                 <td width="38%" height="93"><p style="text-align: right">
                   <?php if ($m_poul == 'shahr') { ?>
                   <select  name="add_city" class="input_text"  style="width:170px ; height:40px" dir="rtl"   onchange="this.form.submit()" >
                     <option value="" >انتخاب نام شهر</option>
                     <?php
$query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = '$mor_cod_m'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                     <?php }?>
                        </select>
                   <?php }?>
                     
                   <?php if ($m_poul == 'abadi') { ?>
                   <select dir="rtl"  name="add_abadi"  class="input_text" style="width:170px ; height:40px"  onchange="this.form.submit()" >
                     <option value="" >انتخاب نام آبادی</option>
                     <?php
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$mor_cod_m' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                     <?php }?>
                   </select>
                   <?php }?>
                 </p></td>
                 <td width="20%"><?php if ($m_poul == 'shahr') { ?>
                   : نام شهر
                   <?php } 
                            if ($m_poul == 'abadi') { ?>
                   : نام آبادی
                   <?php }
				   	  ?></td>
                 <td width="18%"><p style="text-align: right">شهر
                   <input type="radio"  class="green" name="m_poul" <?php if ($m_poul == 'shahr') { ?>checked='checked' <?php } ?> value="shahr" onChange="autoSubmit();" />
                 </p>
                   <p style="text-align: right"> آبادی
       
                     <input type="radio" class="green" name="m_poul" <?php if ($m_poul == 'abadi') { ?>checked='checked' <?php } ?> value="abadi" onChange="autoSubmit();" />
                  </p></td>
                 <td width="24%" class="normalTextSmall"> : موقعیت بهره برداری<span style="text-align: right">
                      </span></td>
               </tr>
             </table>
                <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                <input type="hidden" name="no_kesh" value="<?php echo $no_kesh ;?>" />
                <input type="hidden" name="nah_kesh" value="<?php echo $nah_kesh ;?>" />
               <input type="hidden" name="t_mah" value="<?php echo $t_mah ;?>" />
               <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
               <input type="hidden" name="sh_gat" value="<?php echo $sh_gat  ;?>" />
               <input type="hidden" name="z_sal" value="<?php echo $z_sal  ;?>" />
              </form>
              <form id="form" name="form1" action="" method="post" >
               <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="68" colspan="2" align="right">   <div align="right">
                                      <input name="bah_cod_m" type="text"  class="required" value="<?php echo $bah_cod_m ;?>" maxlength="10" readonly/>
                                    </div> </td>
                                    <td width="41%"><div align="right"> : کد ملی بهره بردار / مدیرعامل </div></td>
                  </tr>
                                  <tr>
                                    <td width="23%" height="62">&nbsp;</td>
                                    <td width="37%"><div align="right">
                                      <!--<form action="" method="post" name="form_kesh"> -->
                                      <select name="no_fa" class="input_text  required" id="no_fa" style="height:40px ; width:170px ; direction:rtl" tabindex="3" >
                                        <option value="0">انتخاب کنید</option>
                                        <option value="1" <?php if ($no_fa=='1') { echo 'selected="selected"' ; } ?>>تکثیر</option>
                                        <option value="2" <?php if ($no_fa=='2') { echo 'selected="selected"' ; } ?>>پرورش</option>
                                        <option value="3" <?php if ($no_fa=='3') { echo 'selected="selected"' ; } ?>>تکثیر و پرورش</option>
                                      </select>
                                      <!--< </form> -->
                                    </div></td>
                                    <td><div align="right"> :نوع فعالیت</div></td>
                                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td height="55" align="center"><div align="right">
                      <select name="no_mal" class="input_text  required" id="no_mal" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                        <option value="">انتخاب کنید</option>
                        <option value="0" <?php if ($no_mal=='0') { echo 'selected="selected"' ; } ?>>------</option>
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
                    <td><div align="right"> : نوع مالکیت</div></td>
                  </tr>
                 <tr>
                   <td height="107"  colspan="3">
                     <input id='sub' name="action" type="submit" class="style8" value="ادامه"  />
                     <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
                     <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                     <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
                     <input type="hidden" name="sal" value="<?php echo $sal ;?>" />
                     <input type="hidden" name="id" value="<?php echo $id ;?>" />
                     <input type="hidden" name="num_bah"  value="<?php echo $num_bah ;?>" />
                     <input type="hidden" name="m_page" value="<?php echo $m_page?>" />
                     <input type="hidden" name="h_add_abadi" value="<?php echo $h_add_abadi?>" />
                     <input type="hidden" name="h_add_city" value="<?php echo $h_add_city?>" />
                     <input type="hidden" name="h_no_fa" value="<?php echo $h_no_fa?>" />
                     <input type="hidden" name="h_no_mal" value="<?php echo $h_no_mal?>" />
                     <input type="hidden" name="h_sal" value="<?php echo $h_sal?>" />
                 </tr>
               </table>
          </form>
      </div>
           <p><a href="../index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<script>
    $('#sub').click(function () {

    var r = $('#rasul').css('display','block');
r.delay(400).find(30000);

    })
</script>