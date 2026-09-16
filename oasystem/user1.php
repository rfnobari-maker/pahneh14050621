<?php
include("../lock_ad.php");
include("../event.php");
$id_ostan1 = $_POST['id_ostan'] ;
$id_city1 = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
#int
{ margin-right:10px 
}
</style>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
 <title>سامانه پهنه بندی آبادی های آذربایجان شرقی</title>
 <script src="../15_files/jquery.js" type="text/javascript"></script>
<script src="../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
            $.validator.addMethod("IsDate",
                  function (value, element) {
                      var result = /^(?:1[23]\d{2})\/(?:0?[1-9]|1[0-2])\/(?:0?[1-9]|[12][0-9]|3[01])$/.test(value);
                      if (value.length == 0)
                          return true;
                      else
                          return result;
                  },
                   "<br/><span style='color:#FF0066'>مثال<br/><span dir='ltr'>1390/08/14 </span></span>"
             );

            //$("#form1").validate();
        });
    </script>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 include ('../login/config.php');
 ?>
<p align="center" >&nbsp;</p>
<p align="center" >مدیریت کاربران </p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <p align="center" style="color:#900 ; font-family:Tahoma; font-size:12px" ><?php echo $_POST['mess'] ; ?></p>

   <table width="388" border='0' align="center" cellpadding='0' cellspacing='0'>
     <tr bgcolor='#f1f1f1' >
       <td height="45" align="right" bgcolor="#F1F1F1" class="input_text" ><form method="post" name="form1" id="form3"  action="#1">
         <select dir="rtl"  name="id_ostan" id="id_ostan" style="width:170px ; height:40px"  onchange="this.form.submit()">
           <option value="0">انتخاب استان</option>
           <?php
$query = "SELECT DISTINCT id_ostan,ostan FROM list_abadi "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
           <option value="<? echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <? echo $row['ostan'] ;?></option>
           <?php 
		   }?>
           </select>
         </form>
         <? if (isset($_POST['id_ostan']))
 $id_ostan = $_POST['id_ostan'] ; 
?></td>
       <td> <div id="int" align="right">: استان</div></td>
     </tr>
     <tr bgcolor='#f1f1f1' >
       <td width="246" height="45" align="right" bgcolor="#F1F1F1" class="input_text" >
         <form method="post" name="form1" id="form2"  action="#1">
           <select dir="rtl"  name="id_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
             <option value="0">انتخاب شهرستان</option>
             <?php
$query = "SELECT DISTINCT id_city,city FROM list_abadi WHERE  id_ostan = $id_ostan"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
             <option value="<? echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city1) echo 'selected=selected'?>> <? echo $row['city'] ;?></option>
             <?php 
		   }?>
            </select>
              <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
          </form>
         <? if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
       <td width="142"><div id="int" align="right">: شهرستان</div></td>
     </tr>
   </table>
 <form action="" method="post" id="form1" name="form1">
 <table width="388" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td width="241" height="38" bgcolor="#F1F1F1"><div align="right">
       <select dir="rtl"  name="id_mar" id="bakh" style="width:170px ; height:40px">
         <option value="0">انتخاب مرکز</option>
         <?php
$query = "SELECT DISTINCT id_mar,mar FROM list_abadi WHERE  id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
         <option value="<? echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <? echo $row['mar'] ;?></option>
         <?php }?>
         </select>
       <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
       <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
     </div></td>
     <td width="137" bgcolor="#F1F1F1"><div  id="int" align="right">: مرکز خدمات</div></td>
   </tr>
   <tr>
     <td height="38" bgcolor="#F1F1F1"><div align="right" >
       <select name="s_access" class="required input_text" style="height:40px ; width:200px ; direction:rtl" tabindex="11">
         <option value="0">انتخاب سطح دسترسی</option>
         <option value="1" <?php if ($_POST['s_access']=='1') { echo 'selected="selected"' ; } ?>>مروج کشاورزی</option>
         <option value="2" <?php if ($_POST['s_access']=='2') { echo 'selected="selected"' ; } ?>>رئیس مرکز</option>
         <option value="3" <?php if ($_POST['s_access']=='3') { echo 'selected="selected"' ; } ?>>مدیریت شهرستان</option>
         <option value="4" <?php if ($_POST['s_access']=='4') { echo 'selected="selected"' ; } ?>>مدیریت سامانه</option>
         <option value="5" <?php if ($_POST['s_access']=='5') { echo 'selected="selected"' ; } ?>>کارشناس معین</option>
         
option>
         </select>
     </div></td>
     <td bgcolor="#F1F1F1"><div id="int" align="right">:دسترسی سطح</div></td>
     </tr>
 </table>
 <p>&nbsp;</p>
 <div align="center">
     <p>
       <input type="hidden" name="id_city"  value="<?php echo $id_city1 ?>">
       <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan ?>">
       <input name="action" type="submit" style="width:150px ; height:45px" tabindex="12" value="جستجو" />
     </p>
     <p>&nbsp;</p>
 </div>
 
      </form>
  <?
 if (isset($_POST['action'])) 
 {  
  include ('../login/config.php');
 $id_city = $_POST['id_city']; 
 $id_mar = $_POST['id_mar']; 
 $id_ostan = $_POST['id_ostan']; 
 $s_access = $_POST['s_access']; 
if ($id_ostan == 0) { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($s_access == 0) { $v_s_access = 's_access=s_access' ;} else { $v_s_access = "s_access='$s_access'" ;}
 $query = "SELECT * FROM  users where  id_ostan = '$id_ostan' and  $v_id_city and $v_id_mar and $v_s_access"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>نتایج یافت شده 
  <table width="93%" height="119" border="1" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="style8">
      <td height="58" colspan="4" bgcolor="#CCCCCC">عملیات</td>
      <td width="13%" bgcolor="#CCCCCC">تلفن همراه</td>
      <td width="12%" bgcolor="#CCCCCC">کد ملی</td>
      <td width="14%" bgcolor="#CCCCCC">نام خانوادگی</td>
      <td width="10%" bgcolor="#CCCCCC">نام</td>
      <td width="6%" bgcolor="#CCCCCC">تصویر</td>
    </tr>
    <tr>
      <?php
 foreach($stmt as $row){
?>
      <td  width="5%" height="58" bgcolor="#FFFFCC" class="normalTextSmaller"><form  action="send_sms.php" method="post" onsubmit="target_popup(this)">
        <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
        <input type="hidden" name="tel_m" value="<?php echo $row['tel_m'] ;?>" />
        <button><img src="../files/sms_icon.png" border="0"  title="ارسال پیامک " width="31" height="31" /></button>
      </form></td>
      <td   width="4%" bgcolor="#FFFFCC" class="normalTextSmaller"><form  action="send_pm.php#1" method="post">
        <input type="hidden" name="username" value="<?php echo $row['username'] ;?>" />
        <button><img src="../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
      </form></td>
      <td   width="7%" bgcolor="#FFFFCC" class="normalTextSmaller"><form  action="prom_operation.php" method="post">
        <input type="hidden" name="username" value="<?php echo $row['cod_m'] ;?>" />
        <button><img src="../files/History.png" border="0"  title="مشاهده عملکرد مروج در سامانه  " width="40" height="35" /></button>
      </form></td>
      <td   width="7%" bgcolor="#FFFFCC" class="normalTextSmaller"><form  action="promo_profile.php" method="post">
        <input type="hidden" name="mor_cod_m" value="<?php echo $row['cod_m'] ;?>" />
        <button><img src="../files/adduser1.jpg" border="0"  title="مشاهده اطلاعات تکمیلی مروج " width="40" height="35" /></button>
      </form></td>
      <td bgcolor="#FFFFCC"  class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
      <td bgcolor="#FFFFCC"  class="normalTextSmaller"><?php echo $row['cod_m'];?></td>
      <td bgcolor="#FFFFCC"  class="normalTextSmaller"><?php echo $row['Last_name'];?></td>
      <td bgcolor="#FFFFCC"   class="normalTextSmaller"><?php echo $row['name'];?> <span class="style21"><a name="1" id="1"></a></span></td>
      <?php 
$pic =   $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
      <td bgcolor="#FFFFCC"><span class="normalTextSmaller"><img src="../files/users/<? echo $pic ?>" width="40" height="49"  alt=""/></span></td>
    </tr>
    <?php
}
}
?>
  </table>  <p>&nbsp;</p></td>
  </tr>
  
  
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><p class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 34438000-6 041 فکس: 334439940 041<br />
          <span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
  <?
 if (isset($_POST['action'])) 
 {  
 $id_city = $_POST['id_city']; 
 $id_mar = $_POST['id_mar']; 
 $id_ostan = $_POST['id_ostan']; 
 $s_access = $_POST['s_access']; 

  }
  ?>