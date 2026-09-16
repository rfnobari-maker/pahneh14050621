<?php
include('../../lock_p1.php');
include('../../login/config.php');
include('../../event.php');
include('../cod_m.php') ;
$m_poul = $_POST['m_poul'];
$id = $_POST['id'];
$no_moj = $_POST['no_moj'];
$bah_cod_m = $_POST['bah_cod_m'];
$sal  = $_POST['sal'];
$add_abadi = $_POST['add_abadi'];
$add_city  = $_POST['add_city'];
$vaz_s   = $_POST['vaz_s'];
if ($add_city=='-') $m_poul = 'abadi' ; 
if ($add_abadi=='-') $m_poul = 'shahr' ; 
$no_fa = $_POST['no_fa'];
// کیلک دکمه ادامه 
if (isset($_POST['action'])) 
 {  
$vaz_s   = $_POST['vaz_s'];
$no_fa   = $_POST['no_fa'];
$no_moj  = $_POST['no_moj'];
$m_poul  = $_POST["m_poul"]; 
    if ($m_poul=='') $mess='موقعیت بهره برداری را تعیین کنید '.'<p>' ;
    $add_city = $_POST["add_city"];
    if ($m_poul=='shahr' and $add_city=='') $mess.='نام شهر را انتخاب کنید'.'<p>' ; else $mess = '' ;
    $add_abadi = $_POST["add_abadi"];
    if ($m_poul=='abadi' and $add_abadi=='') $mess.='نام آبادی را انتخاب کنید'.'<p>' ;
    $bah_cod_m = $_POST['bah_cod_m'];
    if ($bah_cod_m=='') $mess.='کد ملی را وارد کنید'.'<p>' ;
    $vaz_s = $_POST['vaz_s'];
    if ($vaz_s=='') $mess.='وضعیت سکونت بهره بردار را انتخاب کنید'.'<p>' ;
    $no_moj = $_POST['no_moj'];
    if ($no_moj=='') $mess.='نوع مجوز را انتخاب کنید'.'<p>' ;
    $no_fa = $_POST['no_fa'];
    if ($no_fa=='') $mess.='نوع فعالیت واحد را انتخاب کنید'.'<p>' ;
    if ($bah_cod_m<>'' & check_code_melli($bah_cod_m)<>1)  $mess.='کد ملی بهره بردار صحیح نیست' ;
{

        $query = "SELECT no_bah from bah where bah_cod_m = $bah_cod_m";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
		$count_codm = $stmt -> rowCount();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($count_codm = 1) $no_bah = $row['no_bah'] ; 
        if ($count_codm==0) { $mess='اطلاعات بهره بردار یافت نشد <p> برای ثبت اطلاعات بهره برداری زراعی ، ابتدا اطلاعات بهره بردار را ثبت نمایید ' ; 
          $not_found_bah= true ;
            }
		if ($count_codm>1) {
?>
	 <form name="myform1" class="myform" method="post" action="bahEdit_history.php">
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="vaz_s" value="<?php echo $vaz_s ;?>" />
           <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
           <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
           <input type="hidden" name="id" value="<?php echo $id ;?>" />
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
?>
	 <form name="myform1" class="myform" method="post" action="Animaldata_edit.php">
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="vaz_s" value="<?php echo $vaz_s ;?>" />
           <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
           <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
           <input type="hidden" name="sal" value="<?php echo $sal ;?>" />
           <input type="hidden" name="id" value="<?php echo $id ;?>" />
          <input  type="hidden"  name="no_bah" value="<?php echo $no_bah ;?>" />
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
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
  <?php include('top.php'); ?>
    <td width="840" >

           <p class="style8">ویرایش اطلاعات بهره برداری دامی</p><a name="1" id="1"></a><br />
           <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
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
$query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = $login_session"  ;
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
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = $login_session"  ;
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
    <input type="hidden" name="vaz_s" value="<?php echo $vaz_s ;?>" />
    <input type="hidden" name="no_fa" value="<?php echo $no_fa ;?>" />
    <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
    <input type="hidden" name="sal" value="<?php echo $sal  ;?>" />
    <input type="hidden" name="id" value="<?php echo $id  ;?>" />
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
                                    <td height="62">&nbsp;</td>
                                    <td><div align="right">
                                      <select name="vaz_s" class="input_text required" id="vaz_s" style="height:40px ; width:200px ; direction:rtl" tabindex="4">
                                        <option value="">انتخاب کنید</option>
                                        <option value="1" <?php if ($vaz_s=='1') { echo 'selected="selected"' ; } ?>>ساکن</option>
                                        <option value="2" <?php if ($vaz_s=='2') { echo 'selected="selected"' ; } ?>>غیرساکن</option>
                                        <option value="3" <?php if ($vaz_s=='3') { echo 'selected="selected"' ; } ?>>عشایر</option>
                                      </select>
                                    </div></td>
                                    <td><div align="right"> :وضعیت سکونت</div></td>
                                  </tr>
                                  <tr>
                                    <td width="27%" height="62">&nbsp;</td>
                                    <td width="37%"><div align="right">
                                      <select name="no_moj" class="input_text required" id="no_moj" style="height:40px ; width:200px ; direction:rtl" tabindex="4">
                                        <option value="">انتخاب کنید</option>
                                        <option value="1" <?php if ($no_moj=='1') { echo 'selected="selected"' ; } ?>>پروانه بهره برداری واحد صنعتی</option>
                                        <option value="2" <?php if ($no_moj=='2') { echo 'selected="selected"' ; } ?>>پروانه بهره برداری واحد  نیمه صنعتی</option>
                                        <option value="3" <?php if ($no_moj=='3') { echo 'selected="selected"' ; } ?>>پروانه بهره برداری کوچک روستایی </option>
                                        <option value="4" <?php if ($no_moj=='4') { echo 'selected="selected"' ; } ?>>کارت شناسایی</option>
                                        <option value="5" <?php if ($no_moj=='5') { echo 'selected="selected"' ; } ?>>فاقد مجوز</option>
                                      </select>
                                    </div></td>
                                    <td><div align="right"> : نوع مجوز</div></td>

                                    </tr>
                                    <!--If not 3-->
                                    <tbody style="display: none"  class="kash">
                                        <tr class="kash3">
                                            <td align="center">&nbsp;</td>
                                            <td height="55" align="center"><div align="right">
                                                    <select name="no_fa" class="input_text  required" id="no_fa" style="height:40px ; width:200px ; direction:rtl" tabindex="4">
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
                                            <td><div align="right"> : نوع فعالیت</div></td>
                                        </tr>
                                    </tbody>

                                    <!--else-->
                                    <tbody style="display: none">
                                    <tr>
                                        <td><div id="kashno"></div></td>
                                    </tr>
                                    </tbody>

                                    <!--endif-->
                                    <tr>
                                        <td height="107"  colspan="3">
                                            <input name="action" type="submit" class="style8" value="ادامه"  />
                                            <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
                                            <input type="hidden" name="id" value="<?php echo $id ;?>" />
                                            <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                                            <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
                                            <?php if(isset($not_found_bah))  { ?>
                                            <input name="action1" type="submit" class="style8" value="ثبت اطلاعات بهره بردار"  />
                                        </td>
                                        <?php }?>
                                    </tr>
                                </table>
                            </form>
                        </div>
      <form action="liste_Animal.php#1" method="post" id="form1" name="form1">
     <input type="hidden" name="action_lise" value="1" />
     <input type="hidden" name="back_p" value="1" />
     <input type="submit" name="action" value="انصراف" id="submit"  class="btn" style="width:150px ; height:45px ; border-radius:10px ; font-family:Tahoma ; font-size:16px"   tabindex="30" />
</form>
                        <p>&nbsp;</p></td>
                </tr>
                <tr>
                    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
                </tr>
            </table>
</table>
<script>
       var e = document.getElementById("no_moj");
       var strUser = e.value;
           if(strUser !== '5') {
                console.log('not 5 : ' + this.value)
                $('.kash').show();
                $('#kashno').empty();
                 }
            else {
                console.log('5 : ' + this.value)
                $('.kash').hide();
                $('#kashno').html('<input type="hidden" name="no_fa" value="-" />');
            }
      
        $('#no_moj').change(function() {
            if(this.value !== '5') {
                console.log('not 5 : ' + this.value)
                $('.kash').show();
                $('#kashno').empty();
            }
            else {
                console.log('5 : ' + this.value)
                $('.kash').hide();
                $('#kashno').html('<input type="hidden" name="no_fa" value="-" />');
            }

        });

        $('.shahr_select').change(function() {
             $('[name=add_city]').val(this.value)
        });

        $('.abadi_select').change(function() {
            $('[name=add_abadi]').val(this.value)
        });

        $('input.region').change(function() {
            console.log(this.value)
            $('[type=hidden][name=m_poul]').val(this.value)
            if (this.value == 'shahr') {
                $('.shahr_select').show();
                $('.abadi_select').hide();
            }
            else if (this.value == 'abadi') {
                $('.abadi_select').show();
                $('.shahr_select').hide();
            }
        });
</script>
</body>
</html>
