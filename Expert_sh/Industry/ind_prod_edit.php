<?php
include('../../lock_expsh.php');
include('../../event.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$NationalCode    = $_POST['NationalCode'];
$ShenaseKasboKar = $_POST['ShenaseKasboKar'];
//alert($ShenaseKasboKar) ; 
if(isset($_POST['id'])) $id = $_POST['id'];
$y_prod = $_POST['y_prod'];
$d_prod = $_POST['d_prod'];
$v_unit = $_POST['v_unit'];
$t_mah = $_POST['t_mah'];
//alert($t_mah) ; 
 if (isset($_POST['action'])) 
 {  
if ($y_prod=='') $mess.='سال عملکرد را انتخاب کنید'.'<p>' ;
if ($d_prod=='') $mess.='دوره عملکرد را انتخاب کنید'.'<p>' ;
if ($v_unit =='' ) $mess.='وضعیت واحد را انتخاب کنید'.'<p>' ;
if ($v_unit !='3' and $t_mah < 1)  $mess.=' حداقل تنوع محصول باید 1 باشد '.'<p>' ;
if ((isset($_POST['action'])) and ($mess=='') and ($v_unit !='3'))
{
?>
	 <form name="myform1" class="myform" method="post" action="ind_proddata_edit.php">
           <input type="hidden" name="NationalCode" value="<?php echo $NationalCode ;?>" />
           <input type="hidden" name="ShenaseKasboKar" value="<?php echo $ShenaseKasboKar ;?>" />
           <input type="hidden" name="y_prod" value="<?php echo $y_prod ;?>" />
           <input type="hidden" name="d_prod" value="<?php echo $d_prod ;?>" />
           <input type="hidden" name="y_prod_old" value="<?php echo $y_prod_old ;?>" />
           <input type="hidden" name="d_prod_old" value="<?php echo $d_prod_old ;?>" />
           <input type="hidden" name="t_mah" value="<?php echo $t_mah ;?>" />
           <input type="hidden" name="v_unit" value="<?php echo $v_unit ;?>" />
           <input type="hidden" name="id" value="<?php echo $id ;?>" />
    </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
// وضعیت غیر فعال
if ((isset($_POST['action'])) and ($mess=='') and ($v_unit =='3'))
{
    $query = "UPDATE ind_unit_info SET date_s=?,y_prod=?,d_prod=?,v_unit=?,n_zd=?,n_d=?,n_fd=?,n_l=?
	,n_bl=?,gaz=?,gaz_oil=?,naft_w=?,naft_b=?,benz=?,barg=?,ab=? where id=?";
    $q = $dbh->prepare($query);
    $q->execute(array($date_edit,$y_prod,$d_prod,$v_unit,'','','','','','','','','','','','',$id));

    $query = "DELETE FROM ind_unit_prod where y_prod=? and d_prod=?  and  ShenaseKasboKar=?  ";
    $q = $dbh->prepare($query);
    $q->execute(array($y_prod,$d_prod,$ShenaseKasboKar));

    sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','ویرایش عملکرد واحد صنعتی - '.$NationalCode,$id_ostan) ;
    alert ('عملکرد واحد صنعتی با موفقیت ثبت شد ') ;
   // unset($NationalCode,$unit_id,$y_prod,$v_unit,$t_mah);
    ?>
     <form name="myform" class="myform" action="ind_list_performance.php" method="post" onsubmit="winpap1(this)">
         <input type="hidden" name="ShenaseKasboKar" value="<?php echo $ShenaseKasboKar ;?>" />
         <button><img src="../../files/komo.png" title="نمایش عملکرد واحد صنعتی"  width="20" height="20"  alt=""/></button>
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
<script>
function winpap1(form) {
    window.open('null', 'formpopup', 'width=900,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}

function close_window() {
      close();
 }
</script>
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="11"><p>&nbsp;</p>
      <p>&nbsp;</p></td>

    <td width="996" >

           <p class="style8">ویرایش  اطلاعات عملکرد  واحد صنعتی</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div id="div">
             <div id="mess"><?php echo $mess ?>
             </div>
             <form id="form" name="form1" action="#1" method="post" >
               <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="53" colspan="3" align="right">   <div align="right">
                                      <input name="NationalCode" type="text"  class="required Mcod_m" value="<?php echo $NationalCode ;?>" maxlength="11" readonly  />
                                    </div> </td>
                                    <td width="23%"><div align="right"> : شناسه / کد ملی</div></td>
                  </tr>
                  <tr>
                                    <td height="64" colspan="3"><div align="right">
                                      <input name="ShenaseKasboKar" type="text"  class="required Mcod_m" value="<?php echo $ShenaseKasboKar ;?>" maxlength="11" readonly  />
                                    </div></td>
                                    <td><div align="right"> :شناسه کسب و کار</div></td>
                  </tr>
                  <tr>
                    <td height="64" colspan="3"><div align="right"> <a name="1" id="13"></a>
                      <select name="y_prod" disabled="disabled" class="input_text  required" id="y_prod" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                        <option value="">انتخاب کنید</option>
                        <option value="1399"<?php if($y_prod=='1399') echo "selected='selected'"?> >1399</option>
                      </select>
                    </div></td>
                    <td><div align="right"> : سال </div></td>
                  </tr>
                  <tr>
                    <td height="64" colspan="3"><div align="right">
                      <a name="1" id="1"></a>
                      <select name="d_prod" disabled="disabled" class="input_text  required" id="d_prod" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                        <option value="">انتخاب کنید</option>
                        <option value="6"<?php if($d_prod=='6') echo "selected='selected'"?> >شش ماهه</option>
                        <option value="12"<?php if($d_prod=='12') echo "selected='selected'"?> >دوازده ماهه</option>
                      </select>
                    </div></td>
                    <td><div align="right"> : دوره </div></td>
                  </tr>
                  <tr>
                    
					<?php if ($v_unit!=3) { ?>
                    <td width="9%" height="63"><div class="style8" align="right"><?php echo $t_mah ;?></div></td>
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
                      <input type="hidden" name="NationalCode" value="<?php echo $NationalCode ;?>" />
                      <input type="hidden" name="ShenaseKasboKar" value="<?php echo $ShenaseKasboKar ;?>" />
                      <input type="hidden" name="id" value="<?php echo $id ;?>" />
                      <input type="hidden" name="t_mah" value="<?php echo $t_mah ;?>" />
                      <input type="hidden" name="y_prod" value="<?php echo $y_prod ;?>" />
                      <input type="hidden" name="d_prod" value="<?php echo $d_prod ;?>" />
                      <?php if(isset($not_found_bah))  { ?>
                      
                    </td>
                    <?php }?>
                  </tr>
               </table>
        </form>
          </div>
       <p> <button  id="send" class="style8" style="width:150px ; height:45px "  onclick="close_window()">بستن پنجره</button></p>  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</body>
</html>