<?php 
include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city5'] ;
 $s_date = $_POST['s_date'] ; 
 $year = $_POST['year'] ;
 $mont = $_POST['mont'] ;
 $p_cod = $_POST['p_cod'] ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
    <td width="840" >
      <?php include('top.php');?>
      <span class="style8">گزارش میانگین قیمت اقلام خوراکی </span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="277" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="year" class="input_text  required" id="year" style="height:40px ; width:170px ; direction:rtl" onchange="this.form.submit()">
                     <option value="1403" <?php if (isset($year) && $year=='1403') echo 'selected=selected'?>>1403</option>
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
                 <td height="48" colspan="2" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
                 <td align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="s_date" class="style8" id="bakh" style="width:170px ; height:40px" dir="rtl" >
                   <option value="0">همه</option>
                   <?php
 if ($id_city == 0)      {$v_id_city    = 1 ;}else{ $v_id_city = "price_record.id_city='$id_city'" ;}				   
$query = "SELECT  s_date FROM price_record WHERE  id_ostan = '$id_ostan1' and $v_id_city  and year = $year and mont =$mont group by s_date "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['s_date'] ;?>"
   <?php if ($row['s_date']==$s_date) echo 'selected=selected'?>> <?php echo $row['s_date'] ;?></option>
                   <?php }?>
                   </select>
                   <?php
                 				   if (isset($_POST['s_date']))
  $s_date = $_POST['s_date'] ; 

				 ?>
                   <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" /></td>
                 <td  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> : تاریخ قیمت گیری</font></td>
               </tr>
               <tr >
                 <td height="54" colspan="3" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <select  name="p_cod" class="style8" id="s_date" style="width:170px ; height:40px" dir="rtl" >
                     <option value="0">همه محصولات</option>
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
                 <td height="54"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8">: نام محصول</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="4" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' />
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
 if ($id_city == 0)      {$v_id_city    = 1 ;}else{ $v_id_city = "price_record.id_city='$id_city'" ;}
 if ($s_date  == 0)      {$v_s_date     = 1 ;}else{ $v_s_date = "price_record.s_date='$s_date'" ;}
 if ($p_cod == '0')       {$v_p_cod      = 1 ;}else{ $v_p_cod = "price_record.p_cod = '$p_cod'" ;}
 include('../../login/config.php');
$start=0;
$limit=50;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $query = "SELECT price_record.id_ostan,price_record.p_cod, count(*) as count,round(avg(p_price),0) as avg,price_pro_list.p_name,price_pro_list.p_unit
FROM price_record 
inner join price_pro_list ON price_pro_list.p_cod = price_record.p_cod
 where year = $year and mont = $mont and $v_id_ostan  and  $v_s_date  and $v_p_cod and p_price > 0  group by price_record.p_cod  ORDER BY id_ostan,p_cod  ASC LIMIT $start, $limit "; 
 $query1 = "SELECT  count(id) 
FROM price_record 
 where year = $year and mont = $mont and $v_id_ostan and  $v_s_date   and $v_p_cod and p_price > 0 group by price_record.p_cod  ORDER BY id_ostan,p_cod  ASC"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
               <br />
             <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <table width="62" height="56" border="0" align="center">
               <tr>
                 <td width="56"><form  action="Price_rep2_xls.php" method="post">
                   <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
                   <input type="hidden" name="s_date" value="<?php echo $s_date ?>" />
                   <input type="hidden" name="p_cod" value="<?php echo $p_cod ?>" />
                   <input type="hidden" name="mont" value="<?php echo $mont ;?>" />
                   <input type="hidden" name="year" value="<?php echo $year ;?>" />
                   <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
                 </form></td>
               </tr>
            </table>
            <br />
<table width="95%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td width="7%" rowspan="2" bgcolor="#006699">درصد تغییرات</td>
                <td colspan="2" bgcolor="#006699">بالاترین  قیمت <img src="../../files/up.png" title="دانلود نتایج با فرمت فایل ورد"  width="25" height="23"  alt=""/></td>
                <td height="39" colspan="2" bgcolor="#006699"> پایین ترین قیمت<img src="../../files/down.png" title="دانلود نتایج با فرمت فایل ورد"  width="25" height="23"  alt=""/></td>
                <td width="8%" rowspan="2" bgcolor="#006699">میانگین قیمت <br />
                ریال</td>
                <td width="8%" rowspan="2" bgcolor="#006699">تعداد  رکورد</td>
                <td width="7%" rowspan="2" bgcolor="#006699">واحد</td>
                <td width="17%" rowspan="2" bgcolor="#006699">نام محصول</td>
                <td width="13%" rowspan="2" bgcolor="#006699"> استان</td>
                <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
              </tr>
              <tr class="text1">
                <td width="8%" height="31" bgcolor="#006699">قیمت ریال </td>
                <td width="10%" bgcolor="#006699">نام شهرستان </td>
                <td bgcolor="#006699">قیمت ریال </td>
                <td bgcolor="#006699">نام شهرستان</td>
              </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
$id_ostan = $row['id_ostan'] ; 
$id_city_1 = $row['id_city'] ; 
$p_cod_1 = $row['p_cod'] ; 
$p_price_min = min_price($id_ostan,$p_cod_1,$year,$mont,$v_s_date) ; 
$p_price_max = max_price($id_ostan,$p_cod_1,$year,$mont,$v_s_date) ; 
$max_city	=  price_city($id_ostan,$p_cod_1,$year,$mont,$v_s_date,$p_price_max) ;
$min_city	=  price_city($id_ostan,$p_cod_1,$year,$mont,$v_s_date,$p_price_min) ;
$d_n = round(($p_price_max - $p_price_min)/$p_price_max*100,2) ;
  ?>
          <td height="49" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $d_n ; 
		  ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo number_format($p_price_max) ; 
		  ?></td>
          <td height="49" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($max_city,$id_ostan) ?></td>
          <td width="7%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo number_format($p_price_min) ; 
		  ?></td>
          <td width="10%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($min_city,$id_ostan) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo number_format($row['avg']) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['count'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"  dir="rtl"><?php echo $row['p_unit']?></div></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo $row['p_name']?><br />
            <?php echo $row['p_cod']?>          </div></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo ostan_name($id_ostan)?></div></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
  </table>
   <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }}
?>
<div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
<?php   
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="Price_rep2.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="s_date" value="<?php echo $s_date ?>" />
        <input type="hidden" name="p_cod" value="<?php echo $p_cod ?>" />
        <input type="hidden" name="mont" value="<?php echo $mont ;?>" />
        <input type="hidden" name="year" value="<?php echo $year ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="Price_rep2.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="s_date" value="<?php echo $s_date ?>" />
        <input type="hidden" name="p_cod" value="<?php echo $p_cod ?>" />
        <input type="hidden" name="mont" value="<?php echo $mont ;?>" />
        <input type="hidden" name="year" value="<?php echo $year ;?>" />
        <button class='button' >بعدی</button>
      </form>
    <?php 
}

echo "<ul class='page'>";

		for($i=1;$i<=$total;$i++)
		{
			if($i==$id) { echo "<li class='current'>".$i."</li>"; }
			else { 
			?>
      <li class='current'><form  action="Price_rep2.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="s_date" value="<?php echo $s_date ?>" />
        <input type="hidden" name="p_cod" value="<?php echo $p_cod ?>" />
        <input type="hidden" name="mont" value="<?php echo $mont ;?>" />
        <input type="hidden" name="year" value="<?php echo $year ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
          <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    
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
function min_price($id_ostan,$p_cod,$year,$mont,$v_s_date)
{
include ('../../login/config.php') ;
 $query = "SELECT MIN( p_price ) AS min, id_city
FROM price_record
WHERE year ='$year'
AND mont ='$mont'
AND id_ostan = '$id_ostan'
AND p_cod = '$p_cod' 
AND $v_s_date
and p_price > 0";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['min'] ;
$dbh = null;
}

function max_price($id_ostan,$p_cod,$year,$mont,$v_s_date)
{
include ('../../login/config.php') ;
 $query = "SELECT max( p_price ) AS max, id_city
FROM price_record
WHERE year ='$year'
AND mont ='$mont'
AND id_ostan = '$id_ostan'
AND p_cod = '$p_cod' 
AND $v_s_date
and p_price > 0
";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['max'] ;
$dbh = null;
}
function price_city($id_ostan,$p_cod,$year,$mont,$v_s_date,$p_price)
{
include ('../../login/config.php') ;
 $query = "SELECT  id_city
FROM price_record
WHERE year ='$year'
AND mont ='$mont'
AND id_ostan = '$id_ostan'
AND p_cod = '$p_cod' 
AND $v_s_date and p_price = $p_price";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['id_city'] ;
$dbh = null;
}

?>