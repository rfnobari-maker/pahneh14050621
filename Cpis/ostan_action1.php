<?php
include("../lock_cp.php");
include("../event.php");
include('side_menu1.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<script src="../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../15_files/jquery.maskedinput.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $.mask.definitions['~'] = "[+-]";
        $("#date").mask("9999/99/99",{placeholder:"____/__/__"});
    	 $("#date2").mask("9999/99/99",{placeholder:"____/__/__"});
    });
</script>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

-->
</style>

</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php include("header.php"); ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" valign="middle" bgcolor="ffffff">
      
       <p class="style1"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<form method="post" name="form1" id="form2"  action="#1">
  <div style=" width: 500px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1 ; border-radius:10px" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style1">گزارش عملکرد استان در سامانه  </span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" align="right" bgcolor="#F1F1F1" class="input_text" >
              <select  name="id_ostan"  class="style2" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
            <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
            <?php 
		   }?>
          </select>
</td>
        <td width="163" bgcolor="#F1F1F1"><font size="2" class="style8">: استان</font></td>
      </tr>
      <tr >
        <td height="49" align="right" bgcolor="#F1F1F1" class="input_text" ><input name="date_s2" type="text" id="date2" style="width:100px ; height:35px" tabindex="5" value="<?php echo $date_s2?>" />
          <span class="style8">: تا 
            تاریخ </span>
          <input name="date_s1" type="text" id="date" style="width:100px ; height:35px" tabindex="4" value="<?php echo $date_s1?>" /></td>
        <td valign="top" height="49"  align='center' bgcolor="#F1F1F1" class="style8"><font size="2" class="style8">: از تاریخ</font></td>
      </tr>
      <tr >
        <td height="45" align="right" bgcolor="#FFFFFF" class="input_text" >
          <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" /></td>
        <td valign="top" height="45"  align='center' bgcolor="#FFFFFF" class="style8">&nbsp;</td>
      </tr>
      </table>
  </div>
</form>
  <p>
  <?php if(isset($_POST['action']))
{
$date_s1 = $_POST['date_s1'];
$date_s2 = $_POST['date_s2'];
if ($date_s1 == '') { $v_date_s1 = 1  ;} else { $v_date_s1 = "date_s>='$date_s1'" ;}
if ($date_s2 == '') { $v_date_s2 = 1  ;} else { $v_date_s2 = "date_s<='$date_s2'" ;}
 $v_id_ostan = "id_ostan='$id_ostan'" ;
 include('counter2.php');
?>
  <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style21"><a name="1" id="1"></a></span></p></p>
  <table width="90%" height="128" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC" >
    <tr align="center" class="text1">
      <td width="9%" height="50" bordercolor="#66CCFF" bgcolor="#999999">مزارع تکثیر و پرورش آبزیان</td>
      <td width="9%" bordercolor="#66CCFF" bgcolor="#999999"> گلخانه</td>
      <td width="9%" bordercolor="#66CCFF" bgcolor="#999999"> قطعات باغی</td>
      <td width="8%" bordercolor="#66CCFF" bgcolor="#999999"> قطعات زراعی</td>
      <td width="9%" bordercolor="#66CCFF" bgcolor="#999999"> بهره بردار</td>
      </tr>
    <tr>
      <td height="73" bordercolor="#66CCFF"><?php echo ostan_Aquatic_count($id_ostan,$v_date_s1,$v_date_s2)?></td>
      <td bordercolor="#66CCFF"><?php echo ostan_Greenhous_count($id_ostan,$v_date_s1,$v_date_s2)?></td>
      <td bordercolor="#66CCFF"><?php echo ostan_Garden_count($id_ostan,$v_date_s1,$v_date_s2)?></td>
      <td bordercolor="#66CCFF"><?php echo ostan_Agri_count($id_ostan,$v_date_s1,$v_date_s2)?></td>
      <td bordercolor="#66CCFF">            <?php echo ostan_bah_count($id_ostan,$v_date_s1,$v_date_s2)?></td>
      </tr>
  </table>
<?php }?>

      
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../files/bottom.gif">
      <?php include('../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>