<?php
include('../../lock_expsh.php');
include('../../login/config.php');
  $id        = $_POST['id'];
  $add_abadi = $_POST['add_abadi'];
  $add_city  = $_POST['add_city'];
  $bah_cod_m = $_POST["bah_cod_m"]; 
  $no_mal    = $_POST["no_mal"]; 
  $num_bah   = $_POST['num_bah'];
if (strlen($add_city) < 5)  $m_bah = 'abadi' ; 
if (strlen($add_abadi) < 5) $m_bah = 'shahr' ; 
if (isset ($_POST['m_bah']))
{
 $m_bah = $_POST['m_bah'] ; 
 $bah_cod_m = $_POST["bah_cod_m"]; 
}
/////

$mess = '' ;
 if (isset($_POST['action'])) 
 {  
$m_bah = $_POST["m_bah"]; 
if ($m_bah=='') $mess='موقعیت بهره بردار را انتخاب کیند '.'<p>' ;
$add_city = $_POST["add_city"]; 
if ($m_bah=='shahr' and $add_city=='') $mess.='نام شهر را انتخاب کنید'.'<p>' ;
$add_abadi = $_POST["add_abadi"]; 
if ($m_bah=='abadi' and $add_abadi=='') $mess.='نام آبادی را انتخاب کنید'.'<p>' ;

$bah_cod_m = $_POST['bah_cod_m'];
if ($bah_cod_m=='') $mess.='کد ملی را وارد کنید'.'<p>' ;
 //$mess = check_code_melli($cod_m) ; 
if ((isset($_POST['action'])) and ($mess==''))
{
?>
	      <form name="myform1" class="myform" method="post" action="edit_ind_unit2.php">
           <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
           <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
           <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
           <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
           <input type="hidden" name="id" value="<?php echo $id ;?>" />
           <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
           <input type="hidden" name="m_bah" value="<?php echo $m_bah ;?>" />
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
    <link href="radio.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<script src="../../15_files/jquery.js" type="text/javascript"></script>
<script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
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

<script type="text/javascript">
$(document).ready(function()
{	
	/*
	
	using $.post() function
	
	$(document).on('submit', '#reg-form', function()
	{		
		$.post('submit.php', $(this).serialize())
		.done(function(data)
		{
			$("#reg-form").fadeOut('slow', function()
			{
				$(".result").fadeIn('slow', function()
				{
					$(".result").html(data);	
				});
			});
		})
		.fail(function()
		{
			alert('fail to submit the data');
		});
		return false;
	});	
	
	using $.post() function
	
	*/
	
	$(document).on('submit', '#reg-form', function()
	{
		
		//var fn = $("#fname").val();
		//var ln = $("#lname").val();
	
		//var data = 'fname='+fn+'&lname='+ln;
		
		var data = $(this).serialize();
		
		
		$.ajax({
		
		type : 'POST',
		url  : 'submit.php',
		data : data,
		success :  function(data)
				   {						
						$("#reg-form").fadeOut(500).hide(function()
						{
							$(".result").fadeIn(500).show(function()
							{
								$(".result").html(data);
							});
						});
						
				   }
		});
		return false;
	});
});
</script>
<script>
function autoSubmit()
{
    var formObject = document.forms['reg-form'];
    formObject.submit();
}
</script>
<script>
function autoSubmit1()
{
    var formObject = document.forms['no_bah'];
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

           <p class="style8">تصحیح اطلاعات  بهره بردار    <span class="normalTextSmall"><span class="style21"><a name="1" id="13"></a></span></span> </p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
          <div id="div">
             <div id="mess"><?php echo $mess ?></div>
             <form  id="reg-form" method="post" action="#1">
               <table width="100%" height="97" border="0">
                 <tr>
                   <td width="38%" height="93"><p style="text-align: right">
                     <?php if ($m_bah == 'shahr') { ?>
                     <select  name="add_city" class="input_text" id="add_city"  style="width:170px ; height:40px" dir="rtl"   onchange="this.form.submit()" >
                       <option value="" >انتخاب نام شهر</option>
                       <?php
 $query = "SELECT  add_city,shahr FROM list_city WHERE  id_ostan = '$id_ostan' and  id_city = '$id_city' ORDER BY BINARY city ASC"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                       <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                       <?php }?>
                       </select>
                     <?php }?>
                     <?php if ($m_bah == 'abadi') { ?>
                     <select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()" >
                       <option value="" >انتخاب نام آبادی</option>
                       <?php
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE id_ostan = '$id_ostan' and id_city = '$id_city' ORDER BY BINARY abadi ASC"   ;
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
                   <td width="20%"><?php if ($m_bah == 'shahr') { ?>
                     : نام شهر
                     <?php } 
                            if ($m_bah == 'abadi') { ?>
                     : نام آبادی
                     <?php }
				   	  ?></td>
                   <td width="18%"><p style="text-align: right">شهر
                     <input type="radio"  class="green" name="m_bah" <?php if ($m_bah == 'shahr') { ?>checked='checked' <?php } ?> value="shahr" onChange="autoSubmit();" />
                     </p>
                     <p style="text-align: right"> آبادی
                       <input type="radio" class="green" name="m_bah" <?php if ($m_bah == 'abadi') { ?>checked='checked' <?php } ?> value="abadi" onChange="autoSubmit();" />
                     </p></td>
                   <td width="24%" class="normalTextSmall"> : موقعیت بهره برداری<span style="text-align: right"> </span></td>
                 </tr>
               </table>
                       <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
                       <input type="hidden" name="no_mal" value="<?php echo $no_mal ;?>" />
                       <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
                       <input type="hidden" name="id" value="<?php echo $id ;?>" />
             </form>
             <form id="form" name="form1" action="" method="post" >
               <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                 <tr>
   <td width="78%" align="right" bgcolor="#CCCCCC">   <div align="right">
      <input name="bah_cod_m" type="text"  class="required" value="<?php echo $bah_cod_m ;?>" readonly/>
                       <input type="hidden" name="m_bah" value="<?php echo $m_bah ;?>" />
                       <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                       <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />

   </div> </td>
                   <td width="22%" bgcolor="#CCCCCC" class="normalTextSmall">: کد ملی بهره بردار </td>
                 </tr>
                 <tr>
                   <td height="64" colspan="2" align="right" bgcolor="#CCCCCC"><span class="style2" style="margin-right:10px"><div align="right"> <span class="style2">کد ملی ، غیر قابل ویرایش میباشد</span> <img src="../../files/con_info.png" width="16" height="16"  alt=""/></div></td>
                 </tr>
                 <tr>
                   <td height="56" align="right" bgcolor="#FFFFFF"><div align="right">
                           <select name="no_mal" class="input_text  required" id="no_mal"
                                                        style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                       <option value="">انتخاب کنید</option>
                       <option value="1" <?php if ($no_mal == '1') {
                                                        echo 'selected="selected"';
                                                    } ?>>امور اراضی </option>
                       <option value="2" <?php if ($no_mal == '2') {
                                                        echo 'selected="selected"';
                                                    } ?>>منابع طبیعی </option>
                       <option value="3" <?php if ($no_mal == '3') {
                                                        echo 'selected="selected"';
                                                    } ?>>شهرک صنعتی </option>
                       <option value="4" <?php if ($no_mal == '4') {
                                                        echo 'selected="selected"';
                                                    } ?>>مالکیت شخصی </option>
                       <option value="5" <?php if ($no_mal == '5') {
                                                        echo 'selected="selected"';
                                                    } ?>>اجاره ای </option>
                       <option value="6" <?php if ($no_mal == '6') {
                                                        echo 'selected="selected"';
                                                    } ?>>سایر </option>
                     </select>
                   </div></td>
                   <td height="56" align="right" bgcolor="#FFFFFF"><div align="right"> : نوع مالکیت</div></td>
                  </tr>
                 <tr>
                   <td height="107" colspan="2">
                     <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
                     <input type="hidden" name="id" value="<?php echo $id ;?>" />
                     <input type="hidden" name="m_bah" value="<?php echo $m_bah ;?>" />
                     <input name="action" type="submit" value="ادامه"  />

                    </td>
                 </tr>
               </table>
              
            </form>
            </div>
           <p><a href="list_ind_unit.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
          <p>&nbsp;</p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
