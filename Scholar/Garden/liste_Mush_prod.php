<?php 
include('../../lock_Sc.php');
include('../../event.php');
$id = $_POST['id'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
   <style type="text/css">
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
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
width:50px
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
  <script>
function target_po2(form) {
    window.open('null', 'formpopup', 'width=500,height=130,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_po3(form) {
    window.open('null', 'formpopup', 'width=950,height=1400,resizeable,scrollbars');
    form.target = 'formpopup';
}
function close_window() {
      close();
 }
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php 
 if (isset($_POST['id'])) 
 {  
include('../../login/config.php') ;
$query = "SELECT id,id_ostan,id_city,add_abadi,add_city,no_mush,m_zamin,bah_cod_m,unit_name,no_mal,num_bah from Mushroom where  id = $id "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p> 
<p class="style19">عملکرد سالانه واحد پرورش قارچ   </p>
<table width="85%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099FF">
  <tr class="text1">
          <td width="10%" rowspan="2" bgcolor="#999999">مساحت زمین<br />
            <span class="style2">مترمربع</span></td>
          <td width="14%" rowspan="2" bgcolor="#999999">نوع قارچ پرورشی</td>
          <td width="15%" rowspan="2" bgcolor="#999999">نام واحد</td>
          <td height="41" colspan="2" bgcolor="#999999">مشخصات بهره بردار</td>
          <td colspan="2" bgcolor="#999999">موقعیت واحد </td>
          </tr>
        <tr class="text1">
          <td width="15%" height="39" bgcolor="#999999">کد ملی </td>
          <td width="17%" bgcolor="#999999">نام و نام خانوادگی</td>
          <td width="15%" bgcolor="#999999">شهر/آبادی</td>
          <td width="14%" bgcolor="#999999">شهرستان</td>
        </tr>
        <tr>
          <?php 
$row = $stmt->fetch(PDO::FETCH_ASSOC); 
if ($row['no_mush']=='1')  $v_no_mush='صدفی';
if ($row['no_mush']=='2')  $v_no_mush='دکمه ای';
if ($row['no_mush']=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';

$num_bah   = $row['num_bah'] ; 
$bah_cod_m = $row['bah_cod_m'] ; 
  ?>
          <td class="normalTextSmall" ><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" ><?php echo $v_no_mush ?></td>
          <td class="normalTextSmall" ><?php echo $row['unit_name']; ?></td>
          <td height="40" class="normalTextSmall" ><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" ><?php echo bah_name2($row['bah_cod_m'],$row['no_bah'])?></td>
          <td class="normalTextSmall" ><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" ><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          </tr>
        <tr>
          <td height="206" colspan="7" class="normalTextSmall" ><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr >
                <td height="34"  bgcolor="#006699" class="text2">عملیات</td>
                <td width="7%" bgcolor="#006699" class="text2">عملکرد تولید <br />
                  <span class="style2">کیلوگرم / مترمربع</span></td>
                <td width="14%" bgcolor="#006699" class="text2">میزان کل تولید<br />
                  <span class="style2">تن</span></td>
                <td width="14%" bgcolor="#006699" class="text2">سطح زیر کشت سالیانه</td>
                <td width="10%" bgcolor="#006699" class="text2">تعداد دوره پرورش در سال </td>
                <td width="11%" bgcolor="#006699" class="text2">وضعیت واحد </td>
                <td width="10%" bgcolor="#006699" class="text2">عملکرد سال</td>
              </tr>
              <tr>
                <?php
$query = "SELECT * from Mushroom_prod where  unit_id = $id "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_prod = $stmt -> rowCount();
if ($count_prod == 0) 
{
?>
   <td height="50" colspan="9" class="style8" style="font-size: 14px; font-family: Tahoma;">عملکردی برای این واحد تاکنون ثبت نشده است </td>
<?php
}
else 
{
foreach($stmt as $row){ 
if ($row['v_unit']== '1')  $f_v_uint='فعال' ; elseif ($row['v_unit']== '2')  $f_v_uint='در حال اخذ پروانه تاسیس' ;
elseif ($row['v_unit']== '3')  $f_v_uint='دارای پیشرفت فیزیکی' ; elseif ($row['v_unit']== '4')  $f_v_uint='غیرفعال' ;
?>
                <td width="6%"><form  action="Mushdata_prod_view.php" method="post"  onsubmit="target_po3(this)">
                  <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
                  <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m']  ;?>" />
                  <input type="hidden" name="unit_id" value="<?php echo $row['unit_id']  ;?>" />
                  <input type="hidden" name="y_prod" value="<?php echo $row['y_prod']  ;?>" />
                  <input type="hidden" name="v_unit" value="<?php echo $row['v_unit']  ;?>" />
                  <input type="hidden" name="num_bah" value="<?php echo $row['num_bah']  ;?>" />
                  <button><img src="../../files/view.png" title="نمایش اطلاعات عملکرد واحد"  width="20" height="20"  alt=""/></button>
                </form></td>
                <?php if($row['v_unit']=='1') {?>
                <?php } else { ?>
 					                <td width="10%">&nbsp;</td>

                <?php }?>
                <td width="2%" height="50"><?php echo $row['tol_avg'] ; ?></td>
                <td width="2%"><?php echo $row['mah_tol'] ; ?></td>
                <td width="2%"><?php echo $row['zer_kesh'] ; ?></td>
                <td width="2%"><?php echo $row['t_dpar'] ; ?></td>
                <td width="2%"><?php echo $f_v_uint?></td>
                <td width="2%"><?php echo $row['y_prod'] ; ?></td>
              </tr>
               <?php 
    }
    }
   	?>
          </table>
            <p><br />
            <form id="form_name" name="form_name" action="Mushroom_prod.php" method="post">
<input type="hidden"  name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
<input type="hidden"  name="unit_id" value="<?php echo $id ?>" />
<input type="hidden"  name="num_bah" value="<?php echo $num_bah ?>" />
</form>
            </p>
            </td>
          </tr>
    <?php 
    }
   	?>
</table>
    
           </p>
     <input type="button" name="btn1" value="بستن پنجره" onclick="close_window()" style="width:150px ; height:45px" tabindex="28" /></a>
</td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</body>
</html>