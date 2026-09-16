<?php include('../../lock_expar.php');
include('../../event.php') ;
 if (isset($_POST['for_days'])) 
  {  
include('../../login/config.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
 $date_s = jdate("Y/m/d");
 $for_days   = $_POST['for_days'] ; 
 $age_day1  = $_POST['age_day1'];
 $age_day2 = $_POST['age_day2']; 
 $no_part = $_POST['no_part'] ;
 $target  = $_POST['target']; 
$date_home = $_POST['date_home'] ;
$date_end  = $_POST['date_end'] ;
$show_list = $_POST['show_list']; 
//alert($show_list) ; 
$query = "SELECT * from samasat_for_day order by x_days limit 1";
$stmt = $dbh->prepare($query);
$stmt->execute();
//$count_row = $stmt -> rowCount(); 
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$x = $row['x_days'];
$date_day =  $row['date_check_F'] ;
$date_day_name = $row['date_check_name_F'] ;


 $query = "DELETE FROM `samasat_slau_temp` WHERE 1 "; 
 $stmt = $dbh->prepare($query);
 $stmt->execute();

 $query = "INSERT INTO `samasat_slau_temp`(select * from samasat_slau_data where m_joj > 0 
 and age_day >= $age_day1-$x)"; 
 $stmt = $dbh->prepare($query);
 $stmt->execute();

 $query = "UPDATE `samasat_slau_temp` SET `age_day` = `age_day` + $x where 1"; 
 $stmt = $dbh->prepare($query);
 $stmt->execute();

  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
<title><?php echo $title ;?></title>
<style type="text/css">
#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
.row{
  width  :100%;
}
.column {
  float  : left;
  width  :40%;
  padding: 5px;
}
.row::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<script type="text/javascript">
$(document).ready(function()
{
$(".country<?php if(isset($num_t_mah)) echo $num_t_mah ;?>").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_city.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar").html(html);
} 
});
});
});
</script>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
  <p>
    <?php 
include('top.php'); 
 $query = "select * from  `samasat_slau_temp` where 1 order by age_day DESC"; 
 $stmt = $dbh->prepare($query);
 $stmt->execute();
 $t_row = $stmt -> rowCount() ; 
?>
  </p>
  <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
  </p>

    <div dir="rtl" id="b_yes" >   <input  id="yes" type="radio" name="color" value="green"> مشاهده و ویرایش لیست اولیه </div>
    <div dir="rtl" id="b_no" >    <input  id='no'  type="radio" name="color" value="green"> عدم نمایش لیست </div>

<div id="div_list" >
<p>
    <span class="style19">لیست اولیه واحدهای قابل کشتار برای روز <?php echo $date_day_name?>  مورخ <?php echo $date_day?>
    </span><br />
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#CCCCCC'>
  <tr class="text1">
    <td width="10%" bgcolor="#006699">عملیات</td>
    <td width="11%" bgcolor="#006699">تعداد قابل کشتار</td>
    <td width="10%" bgcolor="#006699">تعداد جوجه ریزی</td>
    <td width="9%" bgcolor="#006699">ظرفیت کل</td>
    <td width="7%" bgcolor="#006699">سن گله <br />
      روز</td>
    <td width="7%" bgcolor="#006699">تاریخ جوجه ریزی</td>
    <td width="12%" bgcolor="#006699">شناسه یکتا واحد</td>
    <td width="12%" bgcolor="#006699">کد اپیدمیولوژیک</td>
    <td width="10%" bgcolor="#006699"><p>نام واحد</p></td>
    <td width="8%" bgcolor="#006699">شهرستان</td>
    <td width="4%" bgcolor="#006699">ردیف</td>
  </tr>
    <tr>
      <?php 
$r = $start+1 ;
	   foreach($stmt as $row){ 
$t_r = $r
  ?>
      <td colspan="2" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <form name="form<?php echo $t_r ?>" id="form<?php echo $t_r ?>">
        <input type="hidden" id="z_kol<?php echo $t_r ?>"      name="z_kol"   value="<?php echo $row['z_kol'] ;?>" />
        <input type="hidden" id="sh_yek<?php echo $t_r ?>"     name="sh_yek"   value="<?php echo $row['sh_yek'] ;?>" />
        <input type="hidden" id="date_joj<?php echo $t_r ?>"   name="date_joj" value="<?php echo $row['date_joj'] ;?>" />
        <input type="hidden" id="m_joj1<?php echo $t_r ?>"     name="m_joj1" value="<?php echo $row['m_joj'] ;?>" />

        <div class="row">
          <div class="column" >
            <input name="submit"  type="submit" class="submit<?php echo $t_r ?>" id="submit<?php echo $t_r ?>" style="width:75px ; height:35px ; font-size:13px ; color:#900 ; font-family:tahoma ; text-align:center" tabindex="<?php echo $r.'4'?>"  value="ثبت تغییرات"  />
            <span class="error<?php echo $t_r ?>" style="display:none"><img src="../../files/unTick.png" width="15" height="15"  alt=""/></span> <span class="success<?php echo $t_r ?>" style="display:none"><img src="../../files/Tick.png" width="15" height="15"  alt=""/></span> </div>
          <div class="column" >
            <input name="m_joj"  type="text" class="m_joj<?php echo $t_r ?> required digits input_text" id="m_joj<?php echo $t_r ?>" style="width:50px; height:30px ; " tabindex="<?php echo $r.'1'?>"  dir="rtl" lang="fa" value="<?php echo $row['m_joj'] ; ?>" maxlength="6"  align="baseline" xml:lang="fa" />
      </div>
        </div>
      </form>
      </td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_joj'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_kol'] ; ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['age_day'] ;  ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_joj'] ?></td>
      <td height="67" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_yek'] ; ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_ep'] ; ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name_unit'] ; ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'] ; ?></td>
      <td class="normalTextSmall"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
       <?php 
	   $r++ ; 
   }
?>
</table>
</div>
  </p>
  </p>
  <p>  
  <p>
  <form name="myform" class="myform" method="post" action="samasat_slau_mah.php">
    <input type="hidden" name="X" value='<?php echo $x ?>'/>
    <input type="hidden" name="date_day_name" value='<?php echo $date_day_name ?>'/>
    <input type="hidden" name="date_day" value='<?php echo $date_day ?>'/>
    <input type="hidden" name="date_home" value='<?php echo $date_home ?>'/>
    <input type="hidden" name="date_end" value='<?php echo $date_end ?>'/>
    <input type="hidden" name="for_days" value='<?php echo $for_days ?>'/>
    <input type="hidden" name="age_day1" value='<?php echo $age_day1 ?>'/>
    <input type="hidden" name="age_day2" value='<?php echo $age_day2 ?>'/>
    <input type="hidden" name="no_part" value='<?php echo $no_part ?>'/>
    <input type="hidden" name="target" value='<?php echo $target ?>'/>
    <input type="hidden" name="show_list" value='<?php echo $show_list ?>'/>
    <input type="submit" name="conform" id="conform" style=" border-radius:15px ; font-family:Tahoma ; color:#06C ; height:45px " value="تایید اطلاعات و تهیه لیست کشتار <?php echo $date_day_name?>  <?php echo $date_day?> " />
    </form>
    <?php 
	if($show_list == '2') 
	{
	?>
    <script type="text/javascript">document.myform.submit();</script>
<?php }?>
  </p>
  </p>
  <p>&nbsp;</p>
  <p><a href="Broiler_chicken.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php
$no = $t_row ; 
while ($no > 0){
?>
   <script type="text/javascript" >
$(function() {
$(".submit<?php echo $no ?>").click(function() {
var m_joj      = $("#m_joj<?php echo $no ?>").val();
var m_joj1      = $("#m_joj1<?php echo $no ?>").val();
var z_kol      = $("#z_kol<?php echo $no ?>").val();
var date_joj   = $("#date_joj<?php echo $no ?>").val();
var sh_yek     = $("#sh_yek<?php echo $no ?>").val();
var dataString = 'm_joj='+ m_joj + '&date_joj=' + date_joj + '&sh_yek=' + sh_yek  ;
if(m_joj=='' ||  parseFloat(m_joj) < 0 || parseFloat(m_joj) > parseFloat(m_joj1))
{
$('.success<?php echo $no ?>').fadeOut(200).hide();
$('.error<?php echo $no ?>').fadeOut(200).show();
}
else
{
$.ajax({
type: "POST",
url: "post98.php",
data: dataString,
success: function(){
$('.success<?php echo $no ?>').fadeIn(200).show();
$('.error<?php echo $no ?>').fadeOut(200).hide();
}
});
}
return false;
});
});
</script>
<?php
 $no--;
}
?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
		   $('#div_list').hide();
		   $('#b_yes').show();
     	   $('#b_no').hide();

        $('#yes').click(function()
		{
          $('#div_list').show();
          $('#b_no').show();
         $('#b_yes').hide();
        });
        $('#no').click(function()
		{
          $('#div_list').hide();
    	   $('#b_yes').show();		  
     	   $('#b_no').hide();		   
        });
      });
    </script>
