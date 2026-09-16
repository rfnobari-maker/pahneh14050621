<?php 
include('../../lock_cp.php');
include('../../event.php');
include('counter15.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city5'] ;
 $z_sal = $_POST['z_sal'] ;
 $id_city = $_POST['id_city5'] ;
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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

<script type="text/javascript">
$(document).ready(function()
{
$(".country<?php echo $num_t_mah ;?>").change(function()
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

<script type="text/javascript">
$(document).ready(function()
{
$(".country").change(function()
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
$(".mar<?php echo $num_t_mah ;?>").html(html);
} 
});
});
});
</script>
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_popup2(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>



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
    <td width="840" >
      <?php include('top.php');?>
      <span class="style8">مشخصات محصولات زراعی  </span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="229" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="247" height="46" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                     <option value="">انتخاب کنید</option>
                     <option value="1395-1396" <?php if ($z_sal=='1395-1396') echo 'selected=selected'?>>1395-1396</option>
                     <option value="1396-1397" <?php if ($z_sal=='1396-1397') echo 'selected=selected'?>>1396-1397</option>
                   </select>
                 </div></td>
                 <td width="113"  align='center' bgcolor="#DDDDDD" class="style8">: سال زراعی *</td>
                 <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
                 <select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
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
                 <td  align='center' bgcolor="#DDDDDD" class="style8">: استان </td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
                 <td height="47" align="right" bgcolor="#FFFFFF" class="style1" >&nbsp;</td>
                 <td width="221" align="right" bgcolor="#FFFFFF" class="input_text" >
                   <select  name="id_city5" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
                     <option value="0"> کل استان</option>
                     <?php
$query = "SELECT DISTINCT id_city,city FROM public_abadi4 WHERE  id_ostan = '$id_ostan1' ORDER BY BINARY city ASC "  ;
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
                 <td width="119"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
               </tr>
               <tr >
                 <td height="47" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >انتخاب نام شهر</option>
                   <?php
$query = "SELECT  add_city,shahr FROM list_city WHERE  id_ostan = '$id_ostan1' and id_city = '$id_city' ORDER BY BINARY shahr "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                   <?php }?>
                 </select></td>
                 <td height="47"  align='center' bgcolor="#DDDDDD" class="style8">:نام شهر</td>
                 <td height="42" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                   <option value="0" >انتخاب نام آبادی</option>
                   <?php
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE  id_ostan = '$id_ostan1' and id_city = '$id_city' ORDER BY BINARY abadi "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                   <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                   <?php }?>
                 </select></td>
                 <td height="42"  align='center' bgcolor="#DDDDDD" class="style8">نام آبادی</td>
                 </tr>
               <tr >
                 <td height="60" colspan="4" align="left"><div align="right" style="margin-right:20px ; color:#900 ; font-size: 12px">
                    فیلد  ضروری *</div>
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
 $v_id_ostan = "id_ostan='$id_ostan1'" ;

 if ($id_ostan1 == '-1')   { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)        { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($add_abadi  == '0')   { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')    { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}

 $v_z_sal = "z_sal = '$z_sal'" ;
 include('../../login/config61.php');
$start=0;
$limit=25;
if(isset($_GET['id']))
{
 $id=$_GET['id'];
 $start=($id-1)*$limit;
}
  $query = "SELECT add_abadi,add_city,cod_mah,id_ostan,id_city,id_mar,mor_cod_m,bah_cod_m,((zer_kesht_a+zer_kesht_b)) as zk,((s_bar_a+s_bar_b)) as sb ,mah_tol ,mah_tolp  from Agri_prod where $v_id_ostan  and $v_id_city  and $v_z_sal and  $f_add_abadi  and $f_add_city  ORDER BY bah_cod_m,cod_mah ASC  LIMIT $start, $limit "; 
 $query1 = "SELECT * from Agri_prod where $v_id_ostan  and $v_id_city  and $v_z_sal and  $f_add_abadi  and $f_add_city  ORDER BY bah_cod_m,cod_mah ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ; ?>
           <br />
           <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
            <table width="122" height="56" border="0" align="center">
            <tr>
            <td width="56">
            <form  action="Agri_rep19_xls.php" method="post">
              <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
              <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
              <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
              <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
            </form></td>
            <td width="56">
            <form  action="Agri_rep19_doc.php" method="post">
              <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
              <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
              <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
              <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
              <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
                   <button><img src="../../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="44" height="45"  alt=""/></button>
                 </form></td>
              </tr>
             </table>
            <p  align="center" style="font-size:16px; font-family:Tahoma" >مشخصات محصولات زراعی </p>
            <table width="95%" height="165" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td rowspan="2" bgcolor="#006699">کارشناس مروج</td>
                <td width="6%" rowspan="2" bgcolor="#006699">میزان تولید <br />
                تن </td>
          <td width="6%" rowspan="2" bgcolor="#006699">سطح برداشت<br />
            هکتار</td>
          <td width="7%" rowspan="2" bgcolor="#006699"> میزان پیش بینی تولید <br />
            تن</td>
          <td width="8%" rowspan="2" bgcolor="#006699">سطح زیر کشت<br />
            هکتار</td>
          <td height="32" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td width="10%" rowspan="2" bgcolor="#006699">نام  محصول</td>
          <td colspan="3" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="9%" height="35" bgcolor="#006699" class="style8"><img src="../../files/sort.png" width="15" height="24"  alt=""/><span class="text1"> کد ملی</span></td>
          <td width="13%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="10%" bgcolor="#006699">شهر/آبادی</td>
          <td width="9%" bgcolor="#006699">شهرستان</td>
          <td width="10%" bgcolor="#006699">استان</td>
          </tr>
        <tr>
         
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
  ?>
          <td width="7%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['mor_cod_m']) ?><br />
            <?php echo user_tel($row['mor_cod_m']) ?><br />
            <form  action="../send_pm1.php#1" method="post" onsubmit="target_popup2(this)">
              <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
              <button><img src="../../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
            </form></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],2)?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['sb'],2) ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],2)?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zk'],2) ; ?></td>
          <td height="94" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
  <td  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name($row['bah_cod_m'])?><br />
    <?php echo bah_tel_m($row['bah_cod_m']) ?></td>
  <td align="center"  class="normalTextSmall"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name($row['cod_mah']) ?><br />    <?php echo $row['cod_mah'] ?></td>
  <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?><br /><?php echo substr($row['add_abadi'],13,6) ?></td>
  <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
  <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']); ?></td>
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
    <form  action="Agri_rep19.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="Agri_rep19.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
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
      <li class='current'><form  action="Agri_rep19.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city?>" />
        <input type="hidden" name="z_sal" value="<?php echo $z_sal ;?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city ;?>" />
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