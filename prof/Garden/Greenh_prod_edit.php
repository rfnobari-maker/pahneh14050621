<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');
include_once('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
if(isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'];
if(isset($_POST['unit_id']))   $unit_id = $_POST['unit_id'];
if(isset($_POST['y_prod']))    $y_prod = $_POST['y_prod'];
if(isset($_POST['v_unit']))    $v_unit = $_POST['v_unit'];
if(isset($_POST['num_bah']))   $num_bah = $_POST['num_bah'] ;
if(isset($_POST['t_mah']))     $t_mah = $_POST['t_mah'] ;
if(isset($_POST['no_mtol']))   $no_mtol =  $_POST['no_mtol'] ;  else  $no_mtol = '' ;
 if (isset($_POST['action'])) 
 {  

if ($bah_cod_m=='') $mess.='کد ملی بهره بردار / مدیر عامل را وارد کنید'.'<p>' ;
if ($unit_id=='') $mess.='نام واحد انتخاب نشده است'.'<p>' ;
if ($y_prod=='') $mess.='سال عملکرد انتخاب نشده است'.'<p>' ;
if ($v_unit =='' ) $mess.='وضعیت واحد انتخاب نشده است'.'<p>' ;
if($t_mah !='x') {
if ($t_mah=='') $mess.='تنوع محصول را وارد کنید'.'<p>' ;
if ($t_mah<1) $mess.='تنوع محصول حداقل باید 1 باشد '.'<p>' ;
if ($no_mtol=='') $mess.='نوع محصول تولیدی را انتخاب کنید'.'<p>' ;
}

if ((isset($_POST['action'])) and ($mess=='') and ($v_unit =='1'))
{
?>
	 <form name="myform1" class="myform" method="post" action="Greenhdata_prod_edit.php">
           <input type="hidden" name="num_bah" value="<?php echo '1' ;?>" />
           <input type="hidden" name="unit_id" value="<?php echo $unit_id ;?>" />
           <input type="hidden" name="y_prod" value="<?php echo $y_prod ;?>" />
           <input type="hidden" name="t_mah" value="<?php echo $t_mah ;?>" />
           <input type="hidden" name="no_mtol" value="<?php echo $no_mtol ;?>" />
    </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
// وضعیت غیر فعال
if ((isset($_POST['action'])) and ($mess=='') and ($v_unit !='1'))
{
$query = "SELECT  num_bah,id_ostan,id_city,id_mar,add_abadi,add_city,no_kesht FROM `Greenhous` WHERE  `id` = '$unit_id' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$num_bah    = $row['num_bah'] ;
$add_city   = $row['add_city'] ;
$add_abadi  = $row['add_abadi'] ;
$id_ostan   = $row['id_ostan'] ;
$id_city    = $row['id_city'] ;
$id_mar     = $row['id_mar'] ;
$no_kesht     = $row['no_kesht'] ;

   $query = "DELETE FROM Greenhous_prod WHERE unit_id=? and y_prod = ?  ";
   $q = $dbh->prepare($query);
   $q->execute(array($unit_id,$y_prod));

 $sql = "DELETE FROM Greenprod_annual WHERE unit_id =  :unit_id";
   $stmt =  $dbh->prepare($sql);
   $stmt->bindParam(':unit_id', $unit_id, PDO::PARAM_INT);   
   $stmt->execute();
   $query = "INSERT INTO Greenhous_prod (date_s,unit_id,y_prod,v_unit,num_bah,bah_cod_m,mor_cod_m,no_kesht,
	id_ostan,id_city,id_mar,add_abadi,add_city)
	  VALUES(:date_s,:unit_id,:y_prod,:v_unit,:num_bah,:bah_cod_m,:mor_cod_m,:no_kesht,:id_ostan,:id_city,
	  :id_mar,:add_abadi,:add_city)";
    $q = $dbh->prepare($query);
    $q->execute(array(':date_s'=>$date_edit,':unit_id'=>$unit_id,':y_prod'=>$y_prod,':v_unit'=>$v_unit,':mor_cod_m'=>$login_session,':no_kesht'=>$no_kesht,':num_bah'=>$num_bah,':bah_cod_m'=>$bah_cod_m
	,':no_kesht'=>$no_kesht,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi
	,':add_city'=>$add_city));


    sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','ثبت عملکرد گلخانه-'.$bah_cod_m,$id_ostan) ;
    alert ('ویرایش عملکرد واحد گلخانه با موفقیت ثبت شد ') ;
        ?>
    <form  name="myform" class="myform" method="post" action="liste_Greenhous_prod.php">
            <input type="hidden" name="id"  value="<?php echo $unit_id ;?>" />
            <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m  ;?>" />
    </form>
    <script type="text/javascript">document.myform.submit();</script>
<?php
unset($bah_cod_m,$unit_id,$y_prod,$v_unit);
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
<?php
   $query = "SELECT t_mah, no_mtol from Greenhous_prod where unit_id = '$unit_id' and y_prod = '$y_prod' ";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
     $no_mtol =  $row['no_mtol'] ; 
     $t_mah   =  $row['t_mah'] ; 
?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="11"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="996" >

           <p class="style8">&nbsp;</p>
           <p class="style8">ویرایش اطلاعات عملکرد سالانه گلخانه</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <div id="div">
             <div id="mess"><?php echo $mess ?>
             </div>
             <form id="form" name="form1" action="#1" method="post" >
               <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="54%" align="right">   <div align="right">
           <input name="bah_cod_m"  class="required Mcod_m" type="text" maxlength="10" value="<?php echo $bah_cod_m ;?>" onChange="this.form.submit()" />
                                    </div> </td>
                                    <td width="25%"><div align="right"> : کد ملی بهره بردار </div></td>
                  </tr>
                  <tr>
                                    <td height="64"><div align="right"> <a name="1" id="12"></a>
                           <select name="unit_id" class="input_text  required" id="unit_id" style="height:40px ; width:300px ; direction:rtl" tabindex="4">
<?php
 $query="SELECT id,unit_name,no_kesht,num_bah FROM `Greenhous` WHERE `bah_cod_m`='$bah_cod_m' and mor_cod_m='$login_session' and num_bah = '$num_bah' and id = '$unit_id' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
if ($stmt -> rowCount() <> 0)
{
foreach($stmt as $row){
if ($row['no_kesht']=='1')  $v_no_kesht='گلخانه';
if ($row['no_kesht']=='2')  $v_no_kesht='فضای باز';
?>
        <option value="<?php echo $row['id'] ?>" <?php if($unit_id == $row['id']) echo "selected='selected'" ?>>
		<?php echo $row['unit_name'].'/ نوع کشت : '.$v_no_kesht ?></option>
<?php
}
}
?>
</select>
                                    </div></td>
                                    <td><div align="right"> : نام واحد</div></td>
                  </tr>
                  <tr>
                    <td height="64"><div align="right"> <a name="1" id="1"></a>
                      <select name="y_prod" class="input_text required" id="y_prod" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                        <option value="">انتخاب کنید</option>
                        <option value="1405"<?php if($y_prod=='1405') echo "selected='selected'"?> >1405</option>
                      </select>
                    </div></td>
                    <td><div align="right"> :عملکرد سال </div></td>
                  </tr>
                  <tr>
                    <td height="64"><div align="right">
                      <select name="v_unit" class="input_text v_unit required" id="v_unit" style="height:40px ; width:170px ; direction:rtl"   tabindex="4">
                        <option value="">انتخاب کنید</option>
                        <option value="1"<?php if($v_unit == '1') echo "selected='selected'" ?> >فعال</option>
                        <option value="2"<?php if($v_unit == '2') echo "selected='selected'" ?>>در حال اخذ پروانه تاسیس</option>
                        <option value="3"<?php if($v_unit == '3') echo "selected='selected'" ?>>دارای پیشرفت فیزیکی</option>
                        <option value="4"<?php if($v_unit == '4') echo "selected='selected'" ?>>غیرفعال</option>
                      </select>
                    </div></td>
                    <td><div align="right"> :وضعیت واحد</div></td>
                  </tr>
                  <tr>
                    <td height="64"><div align="right">
                      <select name="no_mtol" class="input_text  required" id="no_mtol" style="height:40px ; width:230px ; direction:rtl ; display:" tabindex="4" >
                        <option value="">انتخاب کنید</option>
                        <?php   if ($row['no_kesht']=='2') { ?>
                        <option value="211300" <?php if ($no_mtol=='211300') { echo 'selected="selected"' ; } ?>>گل و گیاه زینتی </option>
                        <? } else { ?>
                        <option value="211100" <?php if ($no_mtol=='211100') { echo 'selected="selected"' ; } ?>>سبزی و صیفی</option>
                        <option value="211300" <?php if ($no_mtol=='211300') { echo 'selected="selected"' ; } ?>>گل و گیاه زینتی </option>
                        <option value="211200" <?php if ($no_mtol=='211200') { echo 'selected="selected"' ; } ?>>سایر</option>
                        <?php }?>
                      </select>
                      <!--< </form> -->
                    </div></td>
                    <td><div style=" display:" id="no_mtol_title" align="right"> :نوع محصول تولیدی</div></td>
                  </tr>
                  <tr>
                    <td height="64"><div align="right">
                      <input name="t_mah" type="text"  class="required" id="t_mah" maxlength="2" style="width:100px ; text-align:center " value="<?php echo $t_mah ?>" tabindex="5"/>
                    </div></td>
                    <td><div style=" display:" id="t_mah_title" align="right"> :  تنوع محصول </div></td>
                  </tr>
                  <tr>
                    <td height="107"  colspan="3">
                      <input name="action" id="btn" type="submit" class="style8" value="ثبت و خروج" style="display:none" tabindex="6"/>
                      <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
                      <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
                      <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
                      <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
                      <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
                      <?php if(isset($not_found_bah))  { ?>
                      
                    </td>
                    <?php }?>
                  </tr>
               </table>
        </form>
     <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
<script>
     $(".v_unit").change(function() {
			if ($(this).val() == "1") {
				$('#no_mtol').show();
				$('#t_mah').show();
				$('#no_mtol_title').show();
				$('#t_mah_title').show();
				$('#btn').show() ; 
				$('#btn').val('ادامه') ; 

			} else {
				$('#no_mtol').hide();
				$('#t_mah').hide();
     			$('#t_mah').val('x');
				$('#no_mtol_title').hide();
				$('#t_mah_title').hide();
				$('#btn').show() ; 				
				$('#btn').val('ثبت و خروج')				
			}
		});
//
window.onload = function() {
			if ($(".v_unit").val() == "1") {
				$('#no_mtol').show();
				$('#t_mah').show();
				$('#no_mtol_title').show();
				$('#t_mah_title').show();
				$('#btn').show() ; 
				$('#btn').val('ادامه') ; 

			} else {
				$('#no_mtol').hide();
				$('#t_mah').hide();
     			$('#t_mah').val('x');
				$('#no_mtol_title').hide();
				$('#t_mah_title').hide();
				$('#btn').show() ; 				
				$('#btn').val('ثبت و خروج')				
			}
		};
</script>
</body>
</html>
