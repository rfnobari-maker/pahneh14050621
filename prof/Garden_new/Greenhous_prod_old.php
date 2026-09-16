<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');
include_once('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$bah_cod_m = $_POST['bah_cod_m'];
$unit_id = $_POST['unit_id'];
if ($unit_id == '') { $v_id = 1; }else { $v_id = "id = '$unit_id'" ;}
$y_prod = $_POST['y_prod'];
$v_unit = $_POST['v_unit'];
$id    = $_POST['unit_id'] ;
$num_bah = $_POST['num_bah'] ;
$no_moj = $_POST['no_moj'] ; 
if ($no_moj == '' )
{
    $query = "SELECT add_abadi,add_city,no_mtol,no_mal from Greenhousn where id = '$id'  ";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    alert ('خطا ! ابتدا باید اطلاعات واحد را تکمیل کنید ') ;
	       ?>
<form  name="myform1" class="myform1" method="post" action="Greenhous_editn.php">
              <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m  ;?>" />
              <input type="hidden" name="id"  value="<?php echo $id ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi']  ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $row['add_city']  ;?>" />
              <input type="hidden" name="no_mtol" value="<?php echo $row['no_mtol']  ;?>" />
              <input type="hidden" name="no_mal" value="<?php echo $row['no_mal']  ;?>" />
              <input type="hidden" name="num_bah"  value="<?php echo $num_bah ;?>" />
    </form>
    <script type="text/javascript">document.myform1.submit();</script>
     <?php
	  }
  if (isset($_POST['action'])) 
 {  
   $query = "SELECT count(*) from Greenhous_prod where unit_id = '$unit_id' and y_prod = '$y_prod' ";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchColumn();
if ($result > 0 )
{
    alert ('خطا ! عملکرد این واحد در سال '.$y_prod.' قبلاً ثبت شده است') ;
	       ?>
<form  name="myform" class="myform" method="post" action="liste_Greenhous_prod.php">
            <input type="hidden" name="id"  value="<?php echo $unit_id ;?>" />
            <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m  ;?>" />
    </form>
    <script type="text/javascript">document.myform.submit();</script>
<?php
    unset($bah_cod_m,$unit_id,$y_prod,$v_unit,$t_mah);
}
if ($bah_cod_m=='') $mess.='کد ملی بهره بردار / مدیر عامل را وارد کنید'.'<p>' ;
if ($unit_id=='') $mess.='نام واحد انتخاب نشده است'.'<p>' ;
if ($y_prod=='') $mess.='سال عملکرد انتخاب نشده است'.'<p>' ;
if ($v_unit =='' ) $mess.='وضعیت واحد انتخاب نشده است'.'<p>' ;
if ((isset($_POST['action'])) and ($mess=='') and ($v_unit =='1'))
{
?>
	 <form name="myform1" class="myform" method="post" action="Greenh_prod.php">
           <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
           <input type="hidden" name="unit_id" value="<?php echo $unit_id ;?>" />
           <input type="hidden" name="y_prod" value="<?php echo $y_prod ;?>" />
    </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
}
// وضعیت غیر فعال
if ((isset($_POST['action'])) and ($mess=='') and ($v_unit !='1'))
{
$query = "SELECT  num_bah,id_ostan,id_city,id_mar,add_abadi,add_city,no_mtol FROM `Greenhousn` WHERE  `id` = '$unit_id' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$num_bah    = $row['num_bah'] ;
$add_city   = $row['add_city'] ;
$add_abadi  = $row['add_abadi'] ;
$id_ostan   = $row['id_ostan'] ;
$id_city    = $row['id_city'] ;
$id_mar     = $row['id_mar'] ;
$no_mtol     = $row['no_mtol'] ;

    $query = "INSERT INTO Greenhous_prod (date_s,unit_id,y_prod,v_unit,num_bah,bah_cod_m,mor_cod_m,no_mtol,
	id_ostan,id_city,id_mar,add_abadi,add_city
	)
	  VALUES(:date_s,:unit_id,:y_prod,:v_unit,:num_bah,:bah_cod_m,:mor_cod_m,:no_mtol,
	  :id_ostan,:id_city,:id_mar,:add_abadi,:add_city
	  )";
    $q = $dbh->prepare($query);
    $q->execute(array(':date_s'=>$date_edit,':unit_id'=>$unit_id,':y_prod'=>$y_prod,':v_unit'=>$v_unit,':mor_cod_m'=>$login_session,':no_mtol'=>$no_mtol,':num_bah'=>$num_bah,':bah_cod_m'=>$bah_cod_m
	,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city
	));
    sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','ثبت عملکرد واحد گلخانه-'.$bah_cod_m,$id_ostan) ;
    alert ('عملکرد واحد پرورش قارچ با موفقیت ثبت شد ') ;
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

           <p class="style8">&nbsp;</p>
           <p class="style8">ثبت اطلاعات عملکرد سالانه  واحد گلخانه</p>
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
                             <option value="">انتخاب کنید</option>
<?php
$query = "SELECT id,unit_name,no_mtol,num_bah FROM `Greenhousn` WHERE `bah_cod_m`='$bah_cod_m' and mor_cod_m='$login_session' and $v_id ";
$stmt = $dbh->prepare($query);
$stmt->execute();
if ($stmt -> rowCount() <> 0)
{
foreach($stmt as $row){
if ($row['no_mtol']=='1')  $v_no_mtol='سبزی و صیفی';
if ($row['no_mtol']=='2')  $v_no_mtol='گل و گیاه زینتی فضای گلخانه';
if ($row['no_mtol']=='4')  $v_no_mtol='گل و گیاه زینتی فضای باز ' ;	 
if ($row['no_mtol']=='5')  $v_no_mtol='گل و گیاه زینتی فضای توام' ;	 
if ($row['no_mtol']=='3')  $v_no_mtol='سایر' ;	 
?>
        <option value="<?php echo $row['id'] ?>" <?php if($unit_id == $row['id']) echo "selected='selected'" ?>>
		<?php echo $row['unit_name'].'/ نوع : '.$v_no_mtol ?></option>
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
                      <select name="y_prod" class="input_text  required" id="y_prod" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                        <option value="">انتخاب کنید</option>
                        <option value="1399"<?php if($y_prod=='1399') echo "selected='selected'"?> >1399</option>
                      </select>
                    </div></td>
                    <td><div align="right"> :عملکرد سال </div></td>
                  </tr>
                  <tr>
                    <td height="64"><div align="right">
                      <select name="v_unit" class="input_text  required" id="v_unit" style="height:40px ; width:200px ; direction:rtl"  onchange="this.form.submit()"  tabindex="4">
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
                    <td height="107"  colspan="2">
                      <input name="action" type="submit" class="style8" value="<?php if($v_unit !='1')  echo 'ثبت و خروج' ;  else  echo 'ادامه' ; ?>"/>
                      <input type="hidden" name="num_bah" value="<?php echo $row['num_bah'] ;?>" />
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
          </div>
     <p><a href="#" onClick="document.form_name.submit(); return false;"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/></a></p>
        <form  name="form_name" class="form_name" method="post" action="liste_Greenhous_prod.php">
         <input type="hidden" name="id"  value="<?php echo $unit_id ;?>" />
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m  ;?>" />
         </form>

          <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>