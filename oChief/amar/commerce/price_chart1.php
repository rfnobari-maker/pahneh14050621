<?php 
include('../../../lock_oce.php');
include('../../../event.php');
require_once('../../../Jalali.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $year = $_POST['year'] ;
 $mont = $_POST['mont'] ;
 $p_cod = $_POST['p_cod'] ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    </style>

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
</style>

</head>
<body>
                    <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../../files/images/header.jpg" width="100%" height="149" /></td>
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
    <td width="840" >
      <?php include('top.php');?>
      <span class="style8">نمودار میانگین قیمت محصول در استان </span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="229" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="year" class="input_text  required" id="year" style="height:40px ; width:170px ; direction:rtl" onchange="this.form.submit()">
                     <option value="1402" <?php if (isset($year) && $year=='1402') echo 'selected=selected'?>>1402</option>
                     <option value="1401" <?php if (isset($year) && $year=='1401') echo 'selected=selected'?>>1401</option>
                     <option value="1400" <?php if (isset($year) && $year=='1400') echo 'selected=selected'?>>1400</option>
                  </select>
                 </div></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: سال </td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                            <?php $id_ostan1 = $id_ostan ?>
                 <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                  <option value="-1">انتخاب استان</option>
                   <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan ASC "  ;
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
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select name="mont" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl" onchange="this.form.submit()">
                     <option value="01" <?php if($mont=="01") echo "selected='selected'"?>>فروردین</option>
                     <option value="02" <?php if($mont=="02") echo "selected='selected'"?>>اردیبهشت</option>
                     <option value="03" <?php if($mont=="03") echo "selected='selected'"?>>خرداد</option>
                     <option value="04" <?php if($mont=="04") echo "selected='selected'"?>>تیر</option>
                     <option value="05" <?php if($mont=="05") echo "selected='selected'"?>>مرداد</option>
                     <option value="06" <?php if($mont=="06") echo "selected='selected'"?>>شهریور</option>
                     <option value="07" <?php if($mont=="07") echo "selected='selected'"?>>مهر</option>
                     <option value="08" <?php if($mont=="08") echo "selected='selected'"?>>آبان</option>
                     <option value="09" <?php if($mont=="09") echo "selected='selected'"?>>آذر</option>
                     <option value="10" <?php if($mont=="10") echo "selected='selected'"?>>دی</option>
                     <option value="11" <?php if($mont=="11") echo "selected='selected'"?>>بهمن</option>
                     <option value="12" <?php if($mont=="12") echo "selected='selected'"?>>اسفند</option>
                   </select>
                 </div></td>
                 <td height="47" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="style8">: ماه</font></td>
                 <td width="214" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td width="146"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
               </tr>
               <tr >
                 <td height="54" colspan="3" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select  name="p_cod" class="style8" id="s_date" style="width:170px ; height:40px" dir="rtl" >
                   <option value="0">انتخاب محصول</option>
                     <?php
$query = "SELECT  p_name,p_cod FROM price_pro_list WHERE  1 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                     <option value="<?php echo $row['p_cod'] ;?>"
   <?php if ($row['p_cod']==$p_cod) echo 'selected=selected'?>> <?php echo $row['p_name'] ;?></option>
                     <?php }?>
                     </select>
                   </div></td>
                 <td height="54"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">: نام محصول</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='رسم نمودار ' />
                 </td>
                 </tr>
             </table> 
           </div>
 </form>
             <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['action'])) 
 {  
 if ($id_ostan1 == '-1') {$v_id_ostan   = 1 ;}else{ $v_id_ostan = "price_record.id_ostan='$id_ostan1'" ;}

         if($mont=="01") $v_mont = 'فروردین' ; 
         if($mont=="02") $v_mont ='اردیبهشت' ; 
         if($mont=="03") $v_mont ='خرداد' ; 
         if($mont=="04") $v_mont ='تیر' ; 
         if($mont=="05") $v_mont ='مرداد' ; 
         if($mont=="06") $v_mont ='شهریور' ; 
         if($mont=="07") $v_mont ='مهر' ; 
         if($mont=="08") $v_mont ='آبان' ; 
         if($mont=="09") $v_mont ='آذر' ; 
         if($mont=="10") $v_mont ='دی' ; 
         if($mont=="11") $v_mont ='بهمن' ; 
         if($mont=="12") $v_mont ='اسفند' ; 
include('../../../login/config.php'); 
$query="SELECT substr(s_date,9,2),round(avg(p_price),0) from price_record where p_cod='$p_cod' and year = '$year' and mont = '$mont' and id_ostan = '$id_ostan1' group by s_date ";
$step = $dbh->prepare($query);
if($step->execute()){
$php_data_array=$step->fetchAll();
//print_r($php_data_array);
echo "<script>
      var my_2d= ".json_encode($php_data_array)."
			</script>";
}
?>
<div align="center" class="style19" dir="rtl">نمودار میانگین قیمت استانی <?php echo p_name($p_cod) ; ?> طی <?php echo $v_mont?> ماه <?php echo $year?></div>
<div id='curve_chart'></div>
<script type="text/javascript"
	src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current',{packages:['corechart']})
google.charts.setOnLoadCallback(drawChart);
function drawChart(){
	//var data=new google.visualization
	var data=new google.visualization.DataTable();
	data.addColumn('string','روز');
    data.addColumn('number','میانگین استان');
	for(i=0;i<my_2d.length;i++)
data.addRow([my_2d[i][0],parseInt(my_2d[i][1])]);
var options = {
  curveType: 'function',
width: 800,
 height: 400,
	 legend: { position: 'bottom' },
	   animation:{'startup':true,
        duration: 5000,
        easing: 'out',
      },
 };
 var chart=new
 google.visualization.LineChart(document.getElementById('curve_chart'))
chart.draw(data,options);
}
</script>
<?php }?>
               <br />
             </p>
            <br />
            <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
          </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php
function p_name($p_cod)
{
include ('../../../login/config.php') ;
 $query = "SELECT p_name FROM price_pro_list WHERE 
  p_cod = '$p_cod' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['p_name'] ;
$dbh = null;
}
?>
