<?php
include('../../lock_expsh.php');
include('../../event.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$bah_cod_m = $_POST['bah_cod_m'];
$unit_id = $_POST['unit_id'];
$y_prod = $_POST['y_prod'];
$v_unit = $_POST['v_unit'];
$t_mah = $_POST['t_mah'];
$id    = $_POST['unit_id'] ;
 if (isset($_POST['action'])) 
 {  
   $query = "SELECT count(*) from ind_unit_info where unit_id = '$unit_id' and y_prod = '$y_prod' ";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchColumn();
if ($result > 1 )
{
    alert ('خطا ! عملکرد این واحد در سال '.$y_prod.' قبلاً ثبت شده است') ;
	   unset($bah_cod_m,$unit_id,$y_prod,$v_unit,$t_mah);
    ?>
    <form  name="myform" class="myform" method="post" action="list_ind_prod.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
<?php
}
if ($bah_cod_m=='') $mess.='کد ملی بهره بردار / مدیر عامل را وارد کنید'.'<p>' ;
if ($unit_id=='') $mess.='نام واحد انتخاب نشده است'.'<p>' ;
if ($y_prod=='') $mess.='سال عملکرد  انتخاب را کنید'.'<p>' ;
if ($v_unit =='' ) $mess.='وضعیت واحد را انتخاب کنید'.'<p>' ;
if ($v_unit !='3' and $t_mah < 1)  $mess.=' حداقل تنوع محصول باید 1 باشد '.'<p>' ;
if ((isset($_POST['action'])) and ($mess=='') and ($v_unit !='3'))
{
?>
	 <form name="myform1" class="myform" method="post" action="edit_ind_prod_data.php">
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="unit_id" value="<?php echo $unit_id ;?>" />
           <input type="hidden" name="y_prod" value="<?php echo $y_prod ;?>" />
           <input type="hidden" name="t_mah" value="<?php echo $t_mah ;?>" />
           <input type="hidden" name="v_unit" value="<?php echo $v_unit ;?>" />
    </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
// وضعیت غیر فعال
if ((isset($_POST['action'])) and ($mess=='') and ($v_unit =='3'))
{

$query = "UPDATE ind_unit_info SET
date_s=?,y_prod=?,v_unit=?,t_mah=?,n_zd=?,n_d=?,n_fd=?,n_l=?,n_bl=?,gaz=?,gaz_oil=?,naft_w=?,naft_b=?,benz=?,barg=?,ab=?
WHERE unit_id=? ";
$q = $dbh->prepare($query);
$q->execute(array($date_edit,$y_prod,$v_unit,0,0,0,0,0,0,0,0,0,0,0,0,0,$unit_id));
    sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','تصحیح عملکرد واحد صنعتی - '.$bah_cod_m,$id_ostan) ;
$query = "DELETE FROM ind_unit_prod WHERE unit_id=? ";
$q = $dbh->prepare($query);
$q->execute(array($id));
    alert ('عملکرد واحد صنعتی با موفقیت تصحیح شد ') ;
    unset($bah_cod_m,$unit_id,$y_prod,$v_unit,$t_mah);
    ?>
    <form  name="myform" class="myform" method="post" action="list_ind_prod.php">
    </form>
    <script type="text/javascript">document.myform.submit();</script>
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
    <td width="11"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
  <?php include('top.php'); ?>
    <td width="996" >

           <p class="style8">ثبت اطلاعات عملکرد  واحد صنعتی</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div id="div">
             <div id="mess"><?php echo $mess ?>
              </div>
             <form id="form" name="form1" action="#1" method="post" >
               <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td colspan="3" align="right" bgcolor="#CCCCCC">   <div align="right">
                                      <input name="bah_cod_m" type="text"  class="required Mcod_m" onChange="this.form.submit()" value="<?php echo $bah_cod_m ;?>" maxlength="10" readonly />
                                    </div> </td>
                                    <td width="23%" bgcolor="#CCCCCC"><div align="right"> : کد ملی بهره بردار </div></td>
                  </tr>
                  <tr>
                                    <td height="64" colspan="3" bgcolor="#CCCCCC"><div align="right"> <a name="1" id="12"></a>
                           <select name="unit_id" class="input_text  required" id="unit_id" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
<?php
 $query = "SELECT  id,unit_name FROM ind_unit WHERE  id = '$id'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
        <option value="<?php echo $row['id'] ?>" <?php if($unit_id == $row['id']) echo "selected='selected'" ?>><?php echo $row['unit_name']?></option>
<?php
}
?>
</select>
                                    </div></td>
                    <td bgcolor="#CCCCCC"><div align="right"> : نام واحد</div></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="4"><div align="right"> <span class="style2">کد ملی  و نام واحد غیر قابل ویرایش میباشد</span> <img src="../../files/con_info.png" width="16" height="16"  alt=""/></div></td>
                  </tr>
                  <tr>
                    <td height="64" colspan="3"><div align="right">
                      <select name="y_prod" class="input_text  required" id="y_prod" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                        <option value="">انتخاب کنید</option>
                        <option value="1397"<?php if($y_prod=='1397') echo "selected='selected'"?> >1397</option>
                    </select>
                    </div></td>
                    <td><div align="right"> :عملکرد سال </div></td>
                  </tr>
                  <tr>
                    <?php if ($v_unit!=3) { ?>
                    <td width="9%" height="63"><div align="right">
                      <input name="t_mah" type="text"  class="required" id="t_mah" maxlength="2" style="width:50px ; text-align:center" value="<?php echo $t_mah ;?>"/>
                    </div></td>
                    <td width="13%"><div align="right"> : تنوع محصول  </div>  </td>
                    <?php } else {?>
                    <td width="18%">&nbsp;</td>
                    <td width="23%"> </td>
<?php } ?>
                    <td width="28%"><div align="right">
                      <select name="v_unit" class="input_text  required" id="v_unit" style="height:40px ; width:170px ; direction:rtl"  onChange="this.form.submit()"  tabindex="4">
                        <option value="">انتخاب کنید</option>
                        <option value="1"<?php if($v_unit == '1') echo "selected='selected'" ?> >فعال</option>
                        <option value="2"<?php if($v_unit == '2') echo "selected='selected'" ?>>نیمه فعال</option>
                        <option value="3"<?php if($v_unit == '3') echo "selected='selected'" ?>>غیرفعال</option>
                        </select>
                    </div></td>
                                    <td width="9%"><div align="right"> :وضعیت واحد</div></td>
                  </tr>
                  <tr>
                    <td height="107"  colspan="4">
                      <input name="action" type="submit" class="style8" value="<?php if($v_unit=='3')  echo 'ثبت و خروج' ;  else  echo 'ادامه' ; ?>"/>
                      <input type="hidden" name="m_poul" value="<?php echo $m_poul ;?>" />
                      <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                      <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
                      <?php if(isset($not_found_bah))  { ?>
                      
                    </td>
                    <?php }?>
                  </tr>
               </table>
        </form>
          </div>
           <p><a href="../Industry.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>