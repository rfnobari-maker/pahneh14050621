<?php
include("../../lock_ce.php");
include('../../event.php') ;
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
function bee_popup(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
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
 include ('../../login/config.php');
 ?>
<p align="center" >&nbsp;</p>
<p align="center" class="style8" >جستجوی زنبوردار</p>
 <p align="center" ><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form id="form1" name="form1" method="post" action="#result">
   <p>
     <input type="text" name="bah_cod_m" id="bah_cod_m" style="width:200px ; height:40px ; color:#900 ; font-size:14px" />
     :کد ملی زنبوردار</p>
   <p>
     <input type="submit" name="action" id="action" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
   </p>
 </form>
  <p>
    <?php
 if (isset($_POST['action'])) 
 {  
include('../../login/config.php');
$bah_cod_m=$_POST['bah_cod_m'];
$query = "SELECT * from bee where  bah_cod_m = :bah_cod_m "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
if ($found>0) {
?>
    <span class="style21"><a name="result" id="result"></a></span>  </p>
  <table width="98%" border="1" align="center" cellpadding="1" cellspacing="0" bordercolor='#CCCCCC'>
    <tr class="text1">
    <td rowspan="2" bgcolor="#006699">عملیات</td>
    <td width="8%" height="54" rowspan="2" bgcolor="#006699">کارشناس<br />
      مروج</td>
    <td colspan="3" bgcolor="#006699">تولید عسل<br />
      Kg</td>
    <td height="54" colspan="3" bgcolor="#006699">تعداد کندو</td>
    <td width="5%" rowspan="2" bgcolor="#006699">سال</td>
    <td colspan="2" bgcolor="#006699">مشخصات زنبوردار</td>
    <td width="9%" rowspan="2" bgcolor="#006699"><p>نوع </p>
      <p>زنبورستان</p></td>
    <td colspan="3" bgcolor="#006699">موقعیت زنبورستان</td>
    </tr>
    <tr class="text1">
      <td width="6%" bgcolor="#006699">جمع</td>
      <td width="6%" bgcolor="#006699">مدرن</td>
      <td width="5%" bgcolor="#006699">سنتی</td>
      <td width="5%" bgcolor="#006699">جمع</td>
      <td width="6%" height="31" bgcolor="#006699">مدرن</td>
      <td width="5%" bgcolor="#006699">سنتی</td>
      <td width="7%" bgcolor="#006699">کد ملی </td>
      <td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
      <td width="7%" bgcolor="#006699">شهر/آبادی</td>
      <td width="8%" bgcolor="#006699">شهرستان</td>
      <td width="10%" bgcolor="#006699">استان</td>
    </tr>  <tr>
<?php  foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
 if ($row['no_zan']=='1') $v_no_zan = 'غیرمهاجر '; else $v_no_zan = 'مهاجر' ;
  ?>
    <td width="7%">
      <form  action="view_bee.php" method="post" onsubmit="bee_popup(this)">
      <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
      <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
      <input type="hidden" name="m_page"  value="manager_bee.php" />
      <button><img src="../../files/view.png" title="نمایش اطلاعات زنبورستان"  width="25" height="25"  alt=""/></button>
      </form>
    </td>
    <td height="81" class="normalTextSmaller"><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />      
      <?php echo user_name($row['mor_cod_m'])?><br/><?php echo $row['mor_cod_m']?><br /></td>
    <td class="normalTextSmall" ><?php echo $row['to_mo']+$row['to_bo'] ;   ?></td>
    <td class="normalTextSmall" ><?php echo $row['to_mo'] ?></td>
    <td class="normalTextSmall" ><?php echo $row['to_bo'] ?></td>
    <td class="normalTextSmall"><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
    <td class="normalTextSmall"><?php echo $row['tk_mo'] ?></td>
    <td class="normalTextSmall"><?php echo $row['tk_bo'] ?></td>
    <td class="normalTextSmall"><?php echo $row['sal'] ?></td>
    <td height="81" class="normalTextSmall"><?php echo $row['bah_cod_m'] ?></td>
    <td class="normalTextSmall"><?php echo bah_name($row['bah_cod_m'])?></td>
    <td class="normalTextSmall"><?php echo $v_no_zan?></td>
    <td class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
    <td class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
    <td class="normalTextSmall"><?php echo ostan_name($row['id_ostan']); ?></td> 
    </tr>
    <?php }?>
   </table>
<?php
 }
 else 
 {
echo '<p class=style8> بهره برداری با مشخصات وارد شده یافت نشد</p>'  ;
 }
 }
?>
   <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p> 
  </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>
