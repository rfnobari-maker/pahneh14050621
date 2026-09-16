<?php
include("../lock_admin.php");
include("../event.php");
require_once dirname(__FILE__) . '/../login/sys_access.php';
$id_ostan1 = $_POST['id_ostan1'] ;
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
</style>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
         </tr>
     <tr bgcolor='#f1f1f1' >
       <td height="45" align="right" bgcolor="#F1F1F1" class="input_text" ><form method="post" name="form1" id="form3"  action="">
         <select  name="id_ostan1" id="id_ostan1" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
           <option value="0">انتخاب استان</option>
           <?php
$query = "SELECT  id_ostan,ostan FROM ostanname  ORDER BY BINARY ostan ASC"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
  <option value="<?php echo $row['id_ostan'] ;?>"<?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
           <?php }?>
           </select>
         </form>
         <?php if (isset($_POST['id_ostan1']))
?></td>
       <td><font size="2" class="style8">:استان</font></td>
     </tr>
     <tr bgcolor='#f1f1f1' >
       <td width="704" height="45" align="right" bgcolor="#FFFFFF" class="input_text" >
         <form method="post" name="form1" id="form2"  action="#1">
         <select dir="rtl"  name="id_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
         <option value="0"> شهرستان</option>
             <?php
echo $query = "SELECT id_city,city FROM cityname WHERE  id_ostan = $id_ostan1"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
             <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city1) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
             <?php 
		   }?>
          <input type="hidden" name="id_ostan1"  value="<?php echo $_POST['id_ostan1']?>">
             </select>
           </form>
         <?php if (isset($_POST['id_city']))
$id_ostan1 = $_POST['id_ostan1'] ;
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
$query = "SELECT DISTINCT id_mar,mar FROM mar WHERE  id_city = '$id_city1' and id_ostan = $id_ostan1"  ;
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
       <span class="style2">با حروف لاتین</span>
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
 <option value=1 <?php if ($_POST['s_access']=='1') { echo 'selected="selected"' ; } ?>>مروج کشاورزی</option>
 <option value=2 <?php if ($_POST['s_access']=='2') { echo 'selected="selected"' ; } ?>>رئیس مرکز</option>
 <option value=3 <?php if ($_POST['s_access']=='3') { echo 'selected="selected"' ; } ?>>مدیریت شهرستان</option>
 <option value=4 <?php if ($_POST['s_access']=='4') { echo 'selected="selected"' ; } ?>>مدیریت استانی سامانه</option>
 <option value=5 <?php if ($_POST['s_access']=='5') { echo 'selected="selected"' ; } ?>>کارشناس معین استان</option>
 <option value=6 <?php if ($_POST['s_access']=='6') { echo 'selected="selected"' ; } ?>>کارشناس موضوعی شهرستان</option>
 <option value=7 <?php if ($_POST['s_access']=='7') { echo 'selected="selected"' ; } ?>>محقق معین شهرستان</option>
 <option value=98 <?php if ($_POST['s_access']=='98') { echo 'selected="selected"' ; } ?>>ادمین استان</option>
 <option value=20 <?php if ($_POST['s_access']=='20') { echo 'selected="selected"' ; } ?>>مدیریت کشوری سامانه</option>
  <option value=23 <?php if ($_POST['s_access']=='23') { echo 'selected="selected"' ; } ?>>الگوی کشت سامانه</option>
       </select>
     </div></td>
     <td><div align="right">:دسترسی سطح</div></td>
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
     <td colspan="4" style="text-align:right; padding:12px 0;">
       <style type="text/css">
         .pahneh-sys-access { display:flex; flex-wrap:wrap; gap:10px 16px; justify-content:flex-end; }
         .pahneh-sys-access label { font-family:Tahoma; font-size:13px; cursor:pointer; }
         .pahneh-sys-access input { width:18px; height:18px; vertical-align:middle; }
       </style>
       <?php
       $acc_chief = !empty($_POST['acc_chief']) ? 1 : 0;
       $acc_cpis = !empty($_POST['acc_cpis']) ? 1 : 0;
       $acc_dash = !empty($_POST['acc_dash']) ? 1 : 0;
       echo pahneh_sys_checkboxes_html($acc_chief, $acc_cpis, $acc_dash);
       ?>
     </td>
     <td><div align="right">:ورود به سامانه‌ها</div></td>
   </tr>
 </table>
 <div align="center">
   <p>&nbsp;     </p>
   <p>
     <input type="hidden" name="id_city"  value="<?php echo $id_city1 ?>">
     <input type="hidden" name="id_ostan1"  value="<?php echo $id_ostan1 ?>">
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="12" value="ثبت کاربر " />
   </p>
   </p>
 </div>
 <p align="center" >&nbsp;</p>
      </form>
<script type="text/javascript">
(function () {
    var sel = document.querySelector('select[name="s_access"]');
    if (!sel) { return; }
    function syncBoxes() {
        var v = String(sel.value);
        if (v === '20' || v === '23' || v === '99') {
            var ids = ['acc_chief', 'acc_cpis', 'acc_dash'];
            for (var i = 0; i < ids.length; i++) {
                var el = document.getElementById(ids[i]);
                if (el) { el.checked = true; }
            }
        }
    }
    sel.addEventListener('change', syncBoxes);
})();
</script>
  </td>
  </tr>
  <tr>
            <td  height="100px"colspan="2" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
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
<input type="hidden" name="acc_chief"  value="<?php echo isset($_POST['acc_chief']) ? $_POST['acc_chief'] : ''; ?>">
<input type="hidden" name="acc_cpis"  value="<?php echo isset($_POST['acc_cpis']) ? $_POST['acc_cpis'] : ''; ?>">
<input type="hidden" name="acc_dash"  value="<?php echo isset($_POST['acc_dash']) ? $_POST['acc_dash'] : ''; ?>">
<input type="hidden" name="expert_unit"  value="<?php echo $_POST['expert_unit']?>">
<input type="hidden" name="id_aria"  value="<?php echo $_POST['id_aria']?>">

</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
	    }
	else
	{
  $id_ostan1= $_POST['id_ostan1']; 
  $id_city= $_POST['id_city']; 
  $id_mar= $_POST['id_mar']; 
  $ostan = ostan_name($id_ostan1) ;
  $city =city_name1($id_city,$id_ostan1) ;
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
 pahneh_sys_ensure($dbh);
 $acc = pahneh_sys_from_post();
 if (($acc['acc_chief'] + $acc['acc_cpis'] + $acc['acc_dash']) === 0 && in_array((string) $s_access, array('20', '23', '99'), true)) {
     $acc = array('acc_chief' => 1, 'acc_cpis' => 1, 'acc_dash' => 1);
 } 
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
     $sql=$dbh->prepare("INSERT INTO users (username,password, psalt,id_ostan,ostan,city,id_city,markaz,id_mar,name,Last_name,tel_m,Access,S_access,cod_m,acc_chief,acc_cpis,acc_dash) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
$insOk = $sql && $sql->execute(array($username,$salted_hash,$p_salt,$id_ostan1,$ostan,$city,$id_city1,$mar,$id_mar,$name,$last_name,$tel_m,$access,$s_access,$cod_m,$acc['acc_chief'],$acc['acc_cpis'],$acc['acc_dash']));
if (!$insOk) {
     $sql=$dbh->prepare("INSERT INTO users (username,password, psalt,id_ostan,ostan,city,id_city,markaz,id_mar,name,Last_name,tel_m,Access,S_access,cod_m) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
     $sql->execute(array($username,$salted_hash,$p_salt,$id_ostan1,$ostan,$city,$id_city1,$mar,$id_mar,$name,$last_name,$tel_m,$access,$s_access,$cod_m));
}
    // $mess = "کاربر جدید با موفقیت ثبت شد ";
	sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','تعریف کاربر جدید با نام کاربری :'.$username,$id_ostan) ; 
	 alert('کاربر جدید با موفقیت ثبت شد ')
?>
	 <form name="myform1" class="myform" method="post" action="user.php">
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
    }
   }
  }
  ?>