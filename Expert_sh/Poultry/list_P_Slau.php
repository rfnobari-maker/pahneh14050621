<?php include('../../lock_expsh.php');
include('../../event.php') ;
 if(isset($_POST['id_ostan']))  $id_ostan1 = $_POST['id_ostan'] ;
 if(isset($_POST['id_city5']))  $id_city   = $_POST['id_city5'] ;
 if(isset($_POST['date_slau'])) $date_slau = $_POST['date_slau'] ;
 if(isset($_POST['sh_yek']))    $sh_yek    = $_POST['sh_yek'] ;

//alert($date_home) ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
?>
  </p>
  <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

<div id="div_list" >
  <p>
    <span class="style19">لیست پیشنهادی  کشتار به تفکیک مرغداری </span>
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
          <form  id="reg-form" method="post" action="#1">
  <table width="100%" height="185" border='0' align="center" cellpadding='0' cellspacing='0'>
    <tr bgcolor='#f1f1f1' >
      <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr bgcolor='#f1f1f1' >
      <td align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_city5" disabled="disabled"  class="style8" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
        <option value="0"> کل استان</option>
        <?php
$query = "SELECT id_city,city FROM cityname  WHERE  id_ostan = '$id_ostan'  ORDER BY BINARY city ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
        <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
        <?php }?>
      </select>
        <?php 
				   if (isset($_POST['id_city5']))
  $id_city = $_POST['id_city5'] ; 
?></td>
      <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
      <td height="49" align="right" bgcolor="#FFFFFF" class="input_text" >
      <?php $id_ostan1 = $id_ostan ;?>
      <select  name="id_ostan" disabled="disabled"  class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
        <?php
$query = "SELECT id_ostan,ostan FROM ostanname where id_ostan = '$id_ostan' ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
        <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
        <?php 
		   }?>
      </select>
        <?php 
				   if (isset($_POST['id_ostan']))
  $id_ostan1= $_POST['id_ostan'] ; 
?></td>
      <td  align='center' bgcolor="#FFFFFF" class="style8">: استان<span class="style1"><a name="1" id="12"></a></span></td>
    </tr>
    <tr >
      <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
        <input name="sh_yek" type="text" class="input_text" id="sh_yek"  style="height:35px ; width:170px " value="<?php echo $sh_yek?>" />
      </div></td>
      <td height="54" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="style8">: شناسه یکتا</font></td>
      <td align="right" bgcolor="#DDDDDD" class="input_text" >
      <select  name="date_slau"  class="style8" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
        <option value="0">همه</option>
        <?php
$query = "SELECT date_slau FROM samasat_slau_Plist  
 WHERE 1 group by date_slau "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
        <option value="<?php echo $row['date_slau'] ;?>"
   <?php if ($row['date_slau']==$date_slau) echo 'selected=selected'?>> <?php echo $row['date_slau'] ;?></option>
        <?php }?>
      </select>
        <?php 
?></td>
      <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :تاریخ</font></td>
      </tr>
    <tr >
      <td height="60" colspan="4" align="left">
    <input type="hidden" name="date_home" value='<?php echo $date_home ?>'/>
    <input type="hidden" name="date_end" value='<?php echo $date_end ?>'/>
        <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
    </tr>
  </table>
     </form>
</div>
<p>
  <?php if(isset($_POST['action']))
{
 if ($id_ostan1 == '-1')  { $v_id_ostan   = 1 ;}else{ $v_id_ostan  = "id_ostan='$id_ostan1'" ;}
 if ($id_city   == 0)       { $v_id_city    = 1 ;}else{ $v_id_city   = "id_city='$id_city'" ;}
 if ($date_slau == 0)     { $v_date_slau  = 1 ;}else{ $v_date_slau = "date_slau = '$date_slau'" ;}
 if ($sh_yek    == '')       { $v_sh_yek     = 1 ;}else{ $v_sh_yek    = "sh_yek = '$sh_yek'" ;}
$start=0;
  $query  = "SELECT * FROM  samasat_slau_Plist where  $v_id_ostan and $v_id_city and $v_date_slau and $v_sh_yek order by date_slau" ; 
 $stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <span class="style21"><a name="1" id="1"></a></span>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#CCCCCC'>
  <tr class="text1">
    <td width="9%" bgcolor="#006699">تعداد ارسال به کشتار</td>
    <td width="9%" bgcolor="#006699">تاریخ ارسال کشتار</td>
    <td width="6%" bgcolor="#006699">تعداد بارگیری</td>
    <td width="8%" bgcolor="#006699">تعداد باقی</td>
    <td width="10%" bgcolor="#006699">تعداد جوجه ریزی</td>
    <td width="8%" bgcolor="#006699">ظرفیت کل</td>
    <td width="5%" bgcolor="#006699">سن گله <br />
      روز</td>
    <td width="10%" bgcolor="#006699">تاریخ جوجه ریزی</td>
    <td width="11%" bgcolor="#006699">شناسه یکتا واحد</td>
    <td width="14%" bgcolor="#006699"><p>نام واحد</p></td>
    <td width="7%" bgcolor="#006699">شهرستان</td>
    <td width="3%" bgcolor="#006699">ردیف</td>
  </tr>
  
  
      <?php 
$r = $start+1 ;
	   foreach($stmt as $row){ 
$t_r = $r
  ?>
    <tr>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_slau'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_slau'] ;  ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_part'] ;  ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_joj1'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_joj'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_kol'] ; ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['age_day'] ;  ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_joj'] ?></td>
      <td height="23" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_yek'] ; ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name_unit'] ; ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'] ; ?></td>
      <td class="normalTextSmall"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r ; ?></td>
    </tr>
       <?php 
	   $r++ ; 
   }
}
?>
</table>
</div>
  </p>
  </p>
  <p>  
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
		   $('#div_list').show();
		   $('#b_yes').hide();
     	   $('#b_no').show();

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
