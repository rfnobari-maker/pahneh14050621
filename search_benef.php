<?php
include("../lock_p1.php");
include('../event.php') ;
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
 <script src="./assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 include ('../login/config.php');
 ?>
<p align="center" >&nbsp;</p>
<p align="center" >مدیریت اطلاعات بهره بردار </p>
 <p align="center" ><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form id="form1" name="form1" method="post" action="#result">
   <p>
     <input type="text" name="bah_cod_m" id="bah_cod_m" style="width:200px ; height:40px ; color:#900 ; font-size:14px" />
     :کد ملی بهره بردار/مدیرعامل</p>
  <p>
    <input type="submit" name="action" id="action" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
   </p>
 </form>
  <p>
    <?php 
 if (isset($_POST['action'])) 
 {  
    include('../login/config.php');
    $bah_cod_m=$_POST['bah_cod_m'];
$query = "SELECT * from bah where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
if ($found>0) {
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $bah_cod_m = $row['bah_cod_m'] ;
 $num_bah   = $row['num_bah'] ;
?>
    <span class="style21"><a name="result" id="result"></a></span>  </p>
  <?php
$query = "SELECT * from bah where  bah_cod_m = :bah_cod_m and num_bah=:num_bah" ; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$bah_cod_m = $row['bah_cod_m']; 
$bah_jens= $row['jens']; 
$bah_name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$sh_sh   = $row['sh_sh']; 
$m_sod   = $row['m_sod']; 
$fname   = $row['fname']; 
$m_tah   = $row['m_tah']; 
$er_mtah = $row['er_mtah'];
$tel_s   = $row['tel_s']; 
$tel_m  = $row['tel_m']; 
// clos conntection 
$dbh = null;
?> 
	    
 <table style="border:3px solid #069;" width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>

  <td height="38" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات فردی بهره بردار </strong></div></td>
   </tr>
   <tr>
     <td width="429" height="30"><div align="right"><?php echo $last_name ; ?></div></td>
     <td width="191" class="style8"><div align="right">:نام خانوادگی</div></td>
     <td>&nbsp;</td>
     <td width="350"><div align="right"><?php echo $bah_name ; ?></div></td>
     <td width="180" class="style8"><div style="margin-right:30px" align="right">: نام</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $sh_sh ; ?></div></td>
     <td class="style8"><div align="right">:شماره شناسنامه</div></td>
     <td width="108">&nbsp;</td>
     <td><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td class="style8"><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td class="style8"><div align="right">:شماره همراه</div></td>
     <td width="108">&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td class="style8"><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
     <td height="40"><div align="right"><?php echo $fname ; ?></div></td>
     <td class="style8"><div align="right">:نام پدر</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $date_t ; ?></div></td>
     <td class="style8"><div style="margin-right:30px" align="right" >:تاریخ تولد </div></td>
   </tr>
</table>
 <table style="border:3px solid #069;" width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="38" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>سوابق بهره بردار </strong></div></td>
   </tr>
   <tr>
     <td height="52" bgcolor="#FFFFCC">&nbsp;</td>
     <td bgcolor="#FFFFCC" class="style8">ثبت مورد جدید </td>
     <td bgcolor="#FFFFCC">مدیریت اطلاعات موجود </td>
     <td colspan="2" bgcolor="#FFFFCC">عنوان </td>
     </tr>
   <tr>
     <td width="106" height="30">&nbsp;</td>
     <td width="193" class="style8">&nbsp;</td>
     <td width="208"><form  action="ostan_benef.php" method="post" onsubmit="return ray.ajax()">
       <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
       <button ><?php echo bah_count($bah_cod_m);?></button>
     </form></td>
     <td width="204" class="style8"><div style="margin-right:30px" align="right">  بهره بردار</div></td>
     <td width="88" class="style8"><img src="../files/farmer.png" width="52" height="60"  alt=""/></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#CCCCCC">&nbsp;</td>
     <td bgcolor="#CCCCCC" class="style8"><img src="../files/new.png" width="40" height="38"  alt=""/></td>
     <td bgcolor="#CCCCCC"><form  action="ostan_benef.php" method="post" onsubmit="return ray.ajax()">
       <input type="hidden" name="bah_cod_m2" value="<?php echo $bah_cod_m ;?>" />
       <button ><?php echo bah_agri_count($bah_cod_m);?></button>
     </form></td>
     <td bgcolor="#CCCCCC" class="style8"><div style="margin-right:30px" align="right" >اطلاعات زراعی </div></td>
     <td bgcolor="#CCCCCC" class="style8"><img src="../files/zera.png" width="52" height="60"  alt=""/></td>
   </tr>
   <tr>
     <td height="30">&nbsp;</td>
     <td class="style8"><img src="../files/new.png" width="40" height="38"  alt=""/></td>
     <td><form  action="ostan_benef.php" method="post" onsubmit="return ray.ajax()">
       <input type="hidden" name="bah_cod_m3" value="<?php echo $bah_cod_m ;?>" />
       <button ><?php echo bah_garden_count($bah_cod_m);?></button>
     </form></td>
     <td class="style8"><div style="margin-right:30px" align="right" >اطلاعات باغی</div></td>
     <td class="style8"><img src="../files/tree.png" width="52" height="62"  alt=""/></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#CCCCCC">&nbsp;</td>
     <td bgcolor="#CCCCCC" class="style8"><img src="../files/new.png" width="40" height="38"  alt=""/></td>
     <td bgcolor="#CCCCCC"><form  action="ostan_benef.php" method="post" onsubmit="return ray.ajax()">
       <input type="hidden" name="bah_cod_m4" value="<?php echo $bah_cod_m ;?>" />
       <button ><?php echo bah_greenhouse_count($bah_cod_m);?></button>
     </form></td>
     <td bgcolor="#CCCCCC" class="style8"><div style="margin-right:30px" align="right" >گلخانه </div></td>
     <td bgcolor="#CCCCCC" class="style8"><img src="../files/greenhous.png" width="52" height="60"  alt=""/></td>
   </tr>
   <tr>
     <td height="30">&nbsp;</td>
     <td class="style8"><img src="../files/new.png" width="40" height="38"  alt=""/></td>
     <td>&nbsp;</td>
     <td class="style8"><div style="margin-right:30px" align="right" >دام</div></td>
     <td class="style8"><img src="../files/ani.jpg" width="52" height="60"  alt=""/></td>
     </tr>
   <tr>
     <td height="69" bgcolor="#CCCCCC">&nbsp;</td>
     <td bgcolor="#CCCCCC" class="style8"><img src="../files/new.png" width="40" height="38"  alt=""/></td>
     <td bgcolor="#CCCCCC"><form  action="ostan_benef.php" method="post" onsubmit="return ray.ajax()">
       <input type="hidden" name="bah_cod_m5" value="<?php echo $bah_cod_m ;?>" />
       <button ><?php echo bah_aquatic_count($bah_cod_m);?></button>
     </form></td>
     <td bgcolor="#CCCCCC" class="style8"><div style="margin-right:30px" align="right" >آبزی پروری</div></td>
     <td bgcolor="#CCCCCC" class="style8"><img src="../files/fish1.png" width="62" height="60"  alt=""/></td>
     </tr>
   <tr>
     <td height="30">&nbsp;</td>
     <td class="style8"><img src="../files/new.png" width="40" height="38"  alt=""/></td>
     <td>&nbsp;</td>
     <td class="style8"><div style="margin-right:30px" align="right" >طیور </div></td>
     <td class="style8"><img src="../files/pol.jpg" width="52" height="60"  alt=""/></td>
     </tr>
   <tr>
     <td height="30" bgcolor="#CCCCCC">&nbsp;</td>
     <td bgcolor="#CCCCCC" class="style8"><img src="../files/new.png" width="40" height="38"  alt=""/></td>
     <td bgcolor="#CCCCCC"><form  action="ostan_benef.php" method="post" onsubmit="return ray.ajax()">
       <input type="hidden" name="bah_cod_m6" value="<?php echo $bah_cod_m ;?>" />
       <button ><?php echo bah_bee_count($bah_cod_m);?></button>
     </form></td>
     <td bgcolor="#CCCCCC" class="style8"><div style="margin-right:30px" align="right" >زنبور عسل</div></td>
     <td bgcolor="#CCCCCC" class="style8"><img src="../files/bee.png" width="52" height="60"  alt=""/></td>
     </tr>
   <tr>
     <td height="30">&nbsp;</td>
     <td class="style8"><img src="../files/icon1Inactive.png" width="20" height="20"  alt=""/></td>
     <td><form  action="ostan_benef.php" method="post" onsubmit="return ray.ajax()">
       <input type="hidden" name="bah_cod_m7" value="<?php echo $bah_cod_m ;?>" />
       <button ><?php echo bah_eworker_count($bah_cod_m);?></button>
     </form></td>
     <td class="style8"><div style="margin-right:30px" align="right" >مدد کار ترویجی</div></td>
     <td class="style8"><img src="../files/farmer-512.png" width="52" height="60"  alt=""/></td>
     </tr>
 </table>
 <p>&nbsp;   </p>
 <p>
   <?php
 }
 else 
 {
echo '<p class=style8> بهره برداری با مشخصات وارد شده یافت نشد</p>'  ;
 }
 }
?>
 </p>
 <p>&nbsp; </p>
 <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p> 
  </td>
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
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert']) ;?>


