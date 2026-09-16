<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
include('../cod_m.php') ;
// آرایه‌ای از نام‌های فیلدها
$m_poul = '';
$mess = '' ; 
$add_abadi = '' ; 
$add_city = '' ; 
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$b_time = isset($_POST['b_time']) ? $_POST['b_time'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah1 = isset($_POST['mah1']) ? $_POST['mah1'] : '';
$mah2 = isset($_POST['mah2']) ? $_POST['mah2'] : '';
$mah3 = isset($_POST['mah3']) ? $_POST['mah3'] : '';
$m_ab = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
$t_kind = isset($_POST['t_kind']) ? $_POST['t_kind'] : '';
if (isset($_POST['action1'])) 
 {
?>
<form name="myform" class="myform" method="post" action="../benef.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
 <?php
 }
 $m_poul = isset($_POST['m_poul']) ? $_POST['m_poul'] : '';

if(isset($_POST["add_abadi"]))
{ 
$add_abadi = $_POST["add_abadi"]; 
$m_poul = $_POST["m_poul"]; 
}
if(isset($_POST["add_city"]))
{ 
 $add_city = $_POST["add_city"]; 
 $m_poul = $_POST["m_poul"]; 

}
 if (isset($_POST['action'])) 
 {  
$m_poul = $_POST["m_poul"]; 
if ($m_poul=='') $mess='موقعیت بهره برداری را تعیین کنید '.'<p>' ;
$add_city = $_POST["add_city"]; 
if ($m_poul=='shahr' and $add_city=='') $mess.='نام شهر را انتخاب کنید'.'<p>' ;
$add_abadi = $_POST["add_abadi"]; 
if ($m_poul=='abadi' and $add_abadi=='') $mess.='نام آبادی را انتخاب کنید'.'<p>' ;

if ($bah_cod_m=='') $mess.='کد ملی را وارد کنید'.'<p>' ;
if ($z_sal=='') $mess.='سال زراعی  انتخاب را کنید'.'<p>' ;
if ($b_time=='') $mess.='فصل تولید را انتخاب کنید'.'<p>' ;
if ($m_ab =='' ) $mess.='نوع منبع آب را انتخاب کنید'.'<p>' ;
if ($mah1!='1' and $mah2!='1' and $mah3 !='1')  $mess.=' حداقل باید یک محصول انتخاب شود'.'<p>' ;
if ($mah3 =='1' and $t_kind < 1)  $mess.=' تعداد ارقام کشت سیب زمینی را تصحیح کنید'.'<p>' ;
if ((isset($_POST['action'])) and ($mess==''))
{
$query = "SELECT no_bah from bah where bah_cod_m = '$bah_cod_m' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_codm = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$no_bah = $row['no_bah'] ;
if ($count_codm>1) {
?>
	 <form name="myform1" class="myform" method="post" action="Vbah_history.php">
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="b_time" value="<?php echo $b_time ;?>" />
           <input type="hidden" name="mah1" value="<?php echo $mah1 ;?>" />
           <input type="hidden" name="mah2" value="<?php echo $mah2 ;?>" />
           <input type="hidden" name="mah3" value="<?php echo $mah3 ;?>" />
           <input type="hidden" name="t_kind" value="<?php echo $t_kind ;?>" />
           <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
           <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
if ($count_codm==0) 
{
$mess='اطلاعات بهره بردار یافت نشد <p> برای ثبت اطلاعات محصولات عمده صیفی ، ابتدا اطلاعات بهره بردار را ثبت نمایید ' ; 
$not_found_bah= true ;
}
else 
{
$query = "SELECT count(*) FROM  Vege WHERE  bah_cod_m = '$bah_cod_m' and z_sal = '$z_sal' " ;
$stmt = $dbh->prepare($query);
$stmt -> execute();
$count_codm = $stmt->fetchColumn();
if ($count_codm>0) { 
?>
	 <form name="myform1" class="myform" method="post" action="Vege_history.php">
           <input type="hidden" name="no_bah" value="<?php echo $no_bah ;?>" />
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="b_time" value="<?php echo $b_time ;?>" />
           <input type="hidden" name="mah1" value="<?php echo $mah1 ;?>" />
           <input type="hidden" name="mah2" value="<?php echo $mah2 ;?>" />
           <input type="hidden" name="mah3" value="<?php echo $mah3 ;?>" />
           <input type="hidden" name="t_kind" value="<?php echo $t_kind ;?>" />
           <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
           <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
?>
	 <form name="myform1" class="myform" method="post" action="Vege_data.php">
           <input type="hidden" name="no_bah" value="<?php echo $no_bah ;?>" />
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="b_time" value="<?php echo $b_time ;?>" />
           <input type="hidden" name="mah1" value="<?php echo $mah1 ;?>" />
           <input type="hidden" name="mah2" value="<?php echo $mah2 ;?>" />
           <input type="hidden" name="mah3" value="<?php echo $mah3 ;?>" />
           <input type="hidden" name="t_kind" value="<?php echo $t_kind ;?>" />
           <input type="hidden" name="m_ab" value="<?php echo $m_ab ;?>" />
           <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
    </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="../reza_1.css">
    <link href="../radio.css" rel="stylesheet" type="text/css" />
<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
    <td width="11"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
  <?php include('top.php'); ?>
    <td width="996" >

           <p class="style8">ثبت اطلاعات محصولات عمده صیفی</p><a name="1" id="1"></a>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div id="div">
             <div id="mess"><?php if(isset($mess)) echo $mess ?>
              </div>
             <form  id="reg-form" method="post" action="#1">
             <table width="100%" height="106" border="0">
               <tr>
                 <td width="38%" height="102"><p style="text-align: right">
                   <?php if ($m_poul == 'shahr') { ?>
                   <select  name="add_city" class="input_text"  style="width:170px ; height:40px" dir="rtl"   onchange="this.form.submit()" >
                     <option value="" >انتخاب نام شهر</option>
                     <?php
$query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = '$login_session'"  ;
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
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if(isset($add_abadi) and $row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
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
                 <td width="24%" class="normalTextSmall"> : موقعیت بهره برداری</td>
               </tr>
             </table>
    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
             </form>
             <form id="form" name="form1" action="" method="post" >
               <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
   <td height="50" colspan="3" align="right">   <div align="right">
                      <input name="bah_cod_m"  class="required" type="text" maxlength="12" value="<?php echo $bah_cod_m ;?>"/>
   </div> </td>
                   <td width="22%"><div align="right"> : کد ملی بهره بردار / مدیرعامل </div></td>
                 </tr>
                  <tr>
                    <td height="46" colspan="3"><div align="right">
                      <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                        <option value="">انتخاب کنید</option>
                        <option value="1404-1405" <?php if (isset($z_sal) && $z_sal=='1404-1405') echo 'selected=selected'?>>1404-1405</option>
                        <option value="1403-1404" <?php if (isset($z_sal) && $z_sal=='1403-1404') echo 'selected=selected'?>>1403-1404</option>
                      </select>
                    </div></td>
                    <td><div align="right"> : سال زراعی</div></td>
                  </tr>
                  <tr>
                    <td height="47" colspan="3"><div align="right">
                      <select name="b_time" class="input_text  required" id="b_time" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                        <option value="">انتخاب کنید</option>
                        <option value="1" <?php if ($b_time=='1') { echo 'selected="selected"' ; } ?>>زمستانه/استمرار</option>
                        <option value="2" <?php if ($b_time=='2') { echo 'selected="selected"' ; } ?>>بهاره</option>
                        <option value="3" <?php if ($b_time=='3') { echo 'selected="selected"' ; } ?>>تابستانه</option>
                        <option value="4" <?php if ($b_time=='4') { echo 'selected="selected"' ; } ?>>پاییزه</option>
                      </select>
                    </div>
                    <span class="style2">منظور از فصل تولید ، زمان برداشت محصول نهایی می باشد</span></td>
                    <td><div align="right"> :فصل تولید</div></td>
                  </tr>
                  <tr>
                    <td width="22%">&nbsp;</td>
                    <td width="15%">&nbsp;</td>
                    <td width="22%" height="40"><div align="right"><span style="text-align: right">گوجه فرنگی
                          <input name="mah1" type="checkbox"  class="green" id="mah1" value="1" <?php if ($mah1 == '1') { ?>checked='checked' <?php } ?>  />
                    </span></div></td>
                                    <td rowspan="3"><div align="right"> :انتخاب محصول </div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td height="37" align="center"><div align="right"><span style="text-align: right">پیاز
                          <input name="mah2" type="checkbox"  class="green" id="mah2" value="1" <?php if ($mah2 == '1') { ?>checked='checked' <?php } ?>  />
                    </span></div></td>
                  </tr>
                  <tr>
                    <?php if ($mah3==1) {?>
                    <td width="22%"><div align="right">
                      <input name="t_kind" type="text"  class="required" id="t_mah" maxlength="2" style="width:50px ; text-align:center" value="<?php echo $t_kind ;?>"/>
                    </div></td>
                    <td width="15%"><div align="right"> : تعداد ارقام  </div>  </td> <?php } else {?>
                    <td width="22%"><div align="right">
                    </div></td>
                    <td width="12%"> </td> <?php } ?>
                    <td width="7%" height="55" align="center"><div align="right"><span style="text-align: right">سیب زمینی 
                      <input name="mah3" type="checkbox"  class="green" id="mah3" onChange="this.form.submit()" value="1" <?php if ($mah3 == '1') { ?>checked='checked' <?php } ?>  />
                    </span></div></td>
                  </tr>
                                    <tr>
                    <td height="55" colspan="3" align="center"><div align="right">
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
                    <td><div align="right"> :منبع آبیاری</div></td>
                  </tr>

                  <tr>
                    <td height="107"  colspan="4">
                      <input id="sub" name="action" type="submit" class="style8" value="ادامه"  />
                      <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
                      <input type="hidden" name="add_city" value="<?php if(isset($add_city)) echo $add_city ;?>" />
                      <input type="hidden" name="add_abadi" value="<?php if(isset($add_abadi)) echo $add_abadi ;?>" />
                      <?php if(isset($not_found_bah))  { ?>
                      <input name="action1" type="submit" class="style8" value="ثبت اطلاعات بهره بردار"  />
                    </td>
                    <?php }?>
                  </tr>
               </table>
          </form>
          </div>
           <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
<script>
    $('#sub').click(function () {

    var r = $('#rasul').css('display','block');
r.delay(400).find(30000);

    })
</script>
</body>
</html>