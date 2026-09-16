<?php
include("../lock_ad.php");
include("../event.php");
$id_city1 = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
<p align="center" ><span class="style1">ثبت کاربر جديد</span></p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <p align="center" style="color:#900 ; font-family:Tahoma; font-size:12px" ><?php echo $_POST['mess'] ; ?></p>

   <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
     <tr bgcolor='#f1f1f1' >
       <td  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
     </tr>
     <tr bgcolor='#f1f1f1' >
       <td width="704" height="45" align="right" bgcolor="#FFFFFF" class="input_text" >
       <form method="post" name="form1" id="form2"  action="#1">
         <select dir="rtl"  name="id_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
           <option value="0"> شهرستان</option>
           <?php
//$id_ostan = '03' ;
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
           <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city1) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
		   <?php 
		   }?>
         </select>
       </form>
         <?php if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
       <td width="241"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
     </tr>
   </table>
 <form action="" method="post" id="form1" name="form1">
 <table width="850" border="0">
   <tr>
     <td width="293" height="38">&nbsp;</td>
     <td width="120">&nbsp;</td>
     <td width="37">&nbsp;</td>
     <td width="241"><div align="right">
       <select dir="rtl"  name="id_mar" id="bakh" style="width:170px ; height:40px">
         <option value="0"> نام مرکز</option>
         <?php
$query = "SELECT DISTINCT id_mar,mar FROM mar WHERE  id_city = '$id_city' and id_ostan = '$id_ostan' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
         <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
         <?php }?>
         </select>
            </div></td>
     <td width="137"><div align="right">:مرکز خدمات</div></td>
   </tr>
   <tr>
     <td height="38"><div align="right">
       <input name="tel_m" type="text" class="required digits input_text" id="tel_m" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $_POST['tel']?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td>&nbsp;</td>
     <td height="38"><div align="right">
       <input name="cod_m" type="text" class="required digits input_text" id="cod_m" style="width:150px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $_POST['cod_m']?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right">:شماره ملی</div></td>
     </tr>
   <tr>
     <td height="38" class="input_text"><div align="right">
       <input name="last_name" type="text" class="required input_text" style="width:150px; height:30px ; " dir="rtl" lang="fa" value="<?php echo $_POST['last_name']?>" maxlength="100" xml:lang="fa" tabindex="6" />
     </div></td>
     <td><div align="right">:نام خانوادگی</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
       <input name="name" type="text" class="required input_text" style="width:150px; height:30px ; " dir="rtl" lang="fa" value="<?php echo $_POST['name']?>" maxlength="100" xml:lang="fa" tabindex="5" />
     </div></td>
     <td><div align="right">:نام</div></td>
   </tr>
   <tr>
     <td height="38">&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td><div align="right">
       <span class="style2">کد ملی کاربر</span>
       <input name="username" type="text" class="required input_text" id="username" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $_POST['user_name5'] ; ?>" maxlength="100" xml:lang="fa" />
     </div></td>
     <td><div align="right" >:نام کاربری</div></td>
   </tr>
   <tr>
     <td height="41"><div align="right">
       <input name="pass2" type="password" class="required password" equalto="#password" style="width:100px; height:30px ; "dir="rtl" lang="fa" value="<?php echo $pass2; ?>" maxlength="100" xml:lang="fa" tabindex="9" />
     </div></td>
     <td><div align="right">:تکرار کلمه عبور</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
       <input name="pass" type="password" class="required password" id="password" style="width:100px; height:30px ; "dir="rtl" lang="fa" value="<?php echo $pass; ?>" maxlength="100" xml:lang="fa" tabindex="8" />
     </div></td>
     <td><div  align="right"> :کلمه عبور </div></td>
   </tr>
   <tr>
     <td><div align="right" >
       <select name="s_access" class="required input_text" style="height:40px ; width:200px ; direction:rtl" tabindex="11">
 <option value=1 <?php if ($_POST['s_access']=='1') { echo 'selected="selected"' ; } ?>>کارشناس مسئول پهنه</option>
 <option value=2 <?php if ($_POST['s_access']=='2') { echo 'selected="selected"' ; } ?>>رئیس مرکز</option>
 <option value=3 <?php if ($_POST['s_access']=='3') { echo 'selected="selected"' ; } ?>>مدیر شهرستان</option>
 <option value=4 <?php if ($_POST['s_access']=='4') { echo 'selected="selected"' ; } ?>>مدیر سامانه</option>
 <option value=5 <?php if ($_POST['s_access']=='5') { echo 'selected="selected"' ; } ?>>کارشناس معین استان</option>
       </select>
     </div></td>
     <td><div align="right">: سطح دسترسی</div></td>
     <td>&nbsp;</td>
     <td><div align="right" class="input_text" >
       <select name="access" class="required input_text" style="height:40px ; width:150px ; direction:rtl" tabindex="10">
         <option value=1  <?php if ($_POST['access']=='1') { echo 'selected="selected"' ; } ?>>بلی</option>
         <option value=0 <?php if ($_POST['access']=='0') { echo 'selected="selected"' ; } ?>>خیر</option>
       </select>
           </div></td>
     <td><div align="right">:دسترسی به سامانه</div></td>
   </tr>
   <tr>
     <td><div align="right" >
       <select name="expert_unit" class="required input_text" style="height:40px ; width:200px ; direction:rtl" tabindex="11">
         <option value="0">--</option>
         <option value="1" <?php if ($_POST['expert_unit']=='1') { echo 'selected="selected"' ; } ?>>مدیریت هماهنگی ترویج</option>
         <option value="2" <?php if ($_POST['expert_unit']=='2') { echo 'selected="selected"' ; } ?>>مدیریت باغبانی</option>
         <option value="3" <?php if ($_POST['expert_unit']=='3') { echo 'selected="selected"' ; } ?>>مدیریت حفظ نباتات</option>
         <option value="4" <?php if ($_POST['expert_unit']=='4') { echo 'selected="selected"' ; } ?>>مدیریت زراعت</option>
         <option value="5" <?php if ($_POST['expert_unit']=='5') { echo 'selected="selected"' ; } ?>>مدیریت امور شیلات و آبزیان</option>
         <option value="6" <?php if ($_POST['expert_unit']=='6') { echo 'selected="selected"' ; } ?>>مدیریت امور دام </option>
         <option value="7" <?php if ($_POST['expert_unit']=='7') { echo 'selected="selected"' ; } ?>>مدیریت امور طیور</option>
         <option value="8" <?php if ($_POST['expert_unit']=='8') { echo 'selected="selected"' ; } ?>>مدیریت امور اراضی </option>
         <option value="9" <?php if ($_POST['expert_unit']=='9') { echo 'selected="selected"' ; } ?>>مدیریت صنایع کشاورزی</option>
         <option value="10" <?php if ($_POST['expert_unit']=='10') { echo 'selected="selected"' ; } ?>>مدیریت آب و خاک</option>
       </select>
     </div></td>
     <td><div align="right">:واحد تخصصی</div></td>
     <td>&nbsp;</td>
     <td><div align="right" class="input_text" >
       <select dir="rtl" class="required input_text" name="id_aria" id="id_aria" style="width:170px ; height:40px" >
         <option value="0">--</option>
         <?php
      $query = "SELECT DISTINCT id_aria FROM aria WHERE  id_ostan = '$id_ostan'"  ;
      $stmt = $dbh->prepare($query);
      $stmt->execute();
      foreach($stmt as $row){
     ?>
         <option value="<?php echo $row['id_aria'] ;?>"
   <?php if ($row['id_aria']==$id_aria) echo 'selected=selected'?>> <?php echo $row['id_aria'] ;?></option>
         <?php 
		   }?>
       </select>
     </div></td>
     <td><div align="right">:منطقه تحت پوشش</div></td>
   </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
 </table>
 <div align="center">
   <p>&nbsp;     </p>
   <p>
     <input type="hidden" name="id_city"  value="<?php echo $id_city1 ?>">
     <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan ?>">
     <a href="index.php"><input type="button" name="action2"  value="بازگشت" style="width:150px ; height:45px" /></a>
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="12" value="ثبت کاربر " />
   </p>
   </p>
 </div>
 <p align="center" >&nbsp;</p>
      </form>  </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
  <?PHP
 if (isset($_POST['action'])) 
 {  
  $port = 3306;
    include('../login/config.php');
   if(isset($_POST['username']) && isset($_POST['pass'])){
    $password=$_POST['pass'];
    $sql=$dbh->prepare("SELECT COUNT(*) FROM users WHERE username=?");
    $sql->execute(array($_POST['username']));
    if($sql->fetchColumn()!=0){
?>
<form name="myform" class="myform" method="post" action="">
<input type="hidden" name="mess"  value="نام کاربری قبلاً ثبت شده است">
<input type="hidden" name="city"  value="<?php echo $_POST['city'] ;?>">
<input type="hidden" name="id_mar"  value="<?php echo $_POST['id_mar'] ;?>">
<input type="hidden" name="user_name5"  value="<?php echo $_POST['username'] ;?>">
<input type="hidden" name="id_city"  value="<?php echo $_POST['id_city']?>">
<input type="hidden" name="tel_m"  value="<?php echo $_POST['tel_m']?>">
<input type="hidden" name="name"  value="<?php echo $_POST['name']?>">
<input type="hidden" name="last_name"  value="<?php echo $_POST['last_name']?>">
<input type="hidden" name="access"  value="<?php echo $_POST['access']?>">
<input type="hidden" name="s_access"  value="<?php echo $_POST['s_access']?>">
<input type="hidden" name="expert_unit"  value="<?php echo $_POST['expert_unit']?>">
<input type="hidden" name="id_aria"  value="<?php echo $_POST['id_aria']?>">

</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
	    }
	else
	{
   $ostan = ostan_name($id_ostan) ;
  $city =city_name1($id_city,$id_ostan) ;
  $mar = mar_name($id_mar) ;
// کاربر مروج و رئیس مرکز نباشد 
if ($id_city=='')
{
	$id_mar='' ;
	$city='' ;
	$mar = '' ;
}
if ($id_mar=='0')
{
    $city='' ;
	$mar = '' ;
	$id_mar='' ;

}
  $username = $_POST['username']; 
 $name = $_POST['name']; 
 $last_name = $_POST['last_name']; 
  $access = $_POST['access']; 
  $s_access = $_POST['s_access']; 
  $tel_m= $_POST['tel_m']; 
  $cod_m= $_POST['cod_m']; 
  $expert_unit= $_POST['expert_unit']; 
  $id_aria= $_POST['id_aria']; 


     function rand_string($length) {
      $str="";
      $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $size = strlen($chars);
      for($i = 0;$i < $length;$i++) {
       $str .= $chars[rand(0,$size-1)];
      }
      return $str; /* http://subinsb.com/php-generate-random-string */
     }
     $p_salt = rand_string(20); /* http://subinsb.com/php-generate-random-string */
     $site_salt="subinsblogsalt"; /*Common Salt used for password storing on site.*/
     $salted_hash = hash('sha256', $password.$site_salt.$p_salt);
     $sql=$dbh->prepare("INSERT INTO users (username,password, psalt,id_ostan,ostan,city,id_city,markaz,id_mar,name,Last_name,tel_m,Access,S_access,cod_m,expert_unit,id_aria) VALUES ( ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?));");
     $sql->execute(array($username, $salted_hash, $p_salt,$id_ostan,$ostan,$city,$id_city,$mar,$id_mar,$name,$last_name,$tel_m,$access,$s_access,$cod_m,$expert_unit,$id_aria));
    // $mess = "کاربر جدید با موفقیت ثبت شد ";
	sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','تعریف کاربر جدید با نام کاربری :'.$username,$id_ostan) ; 
	 alert('کاربر جدید با موفقیت ثبت شد ')
?>
	 <form name="myform1" class="myform" method="post" action="index.php">
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
    }
   }
  }
  ?>