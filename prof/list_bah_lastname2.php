<?php 
include('../lock_p1.php');
include('../event.php');
 if(isset($_POST['name1'])) $name1 = $_POST['name1'] ;
 if(isset($_POST['last_name'])) $last_name  = $_POST['last_name'] ;
 if(isset($_POST['fname'])) $fname  = $_POST['fname'] ;
 if(isset($_POST['aria'])) $aria  = $_POST['aria'] ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
            <td><img src="../files/images/header.jpg" width="949" height="117" /></td>
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
      <span class="style8">جستجوی بهره بردار بر اساس نام و نام خانوادگی</span><br />
      </p>
      <form  id="reg-form" method="post" action="#1">
        <div style="width: 500px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="322" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="76%" height="64" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <span class="style2">حداقل باید 3 کارکتر وارد شود </span>
                   <input name="last_name" type="text" class="input_text" id="last_name"  style="height:35px ; width:170px " tabindex="1" value="<?php echo $last_name?>" />
                 </div></td>
                 <td width="24%"  align='center' bgcolor="#DDDDDD" class="style8"><span class="style1"><font size="2" class="style8">: </font></span><span style="font-family: Tahoma; color: #003366;"><font size="2" style="text-decoration: none; font-family: Tahoma; color: #990000;">نام خانوادگی شامل</font></span></td>
                 </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="57" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
                   <input name="name1" type="text" class="input_text" id="name1"  style="height:35px ; width:170px " tabindex="2" value="<?php echo $name1?>" />
                 </div></td>
                 <td height="57" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="style8">:نام شامل</font></td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="59" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
                   <input name="fname" type="text" class="input_text" id="fname"  style="height:35px ; width:170px " tabindex="3" value="<?php echo $fname?>" />
                 </div></td>
                 <td height="59" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="style8">:نام پدر شامل</font></td>
                 </tr>
               <tr >
                 <td height="60" align="left"><div align="right">
                   <img src="../files/jadid.gif" width="35" height="15"  alt=""/>
                   <select name="aria" class="input_text" id="aria" style="height:40px ; width:170px ; direction:rtl" tabindex="4">
                     <option value="1" <?php if ($aria=='1') { echo 'selected="selected"' ; } ?>>کل کشور</option>
                     <option value="2" <?php if ($aria=='2') { echo 'selected="selected"' ; } ?>>استان</option>
                     <option value="3" <?php if ($aria=='3') { echo 'selected="selected"' ; } ?>>شهرستان</option>
                     <option value="4" <?php if ($aria=='4') { echo 'selected="selected"' ; } ?>>مرکز</option>
                     <option value="5" <?php if ($aria=='5') { echo 'selected="selected"' ; } ?>>ثبت شده توسط خودم</option>
                   </select>
                 </div></td>
                 <td height="60" align="left"><font size="2" class="style8">:محدوده جستجو</font></td>
               </tr>
               <tr >
                 <td height="60" colspan="2" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
               </tr>
               </table> 
           </div>
 </form>
             <span class="style1"><a name="1" id="1"></a></span>
             <?php
   if(isset($_POST['action']) and (strlen($last_name) > 3 ))
{
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}

if ($aria == '1') $v_aria = 1 ; 
if ($aria == '2') $v_aria = "bah.id_ostan = $id_ostan" ; 
if ($aria == '3') $v_aria = "bah.id_ostan = $id_ostan and bah.id_city = $id_city" ; 
if ($aria == '4') $v_aria = "bah.id_ostan = $id_ostan and bah.id_city = $id_city and bah.id_mar = $id_mar" ; 
if ($aria == '5') $v_aria = "bah.mor_cod_m = $login_session " ; 
  $query = "SELECT bah.*
,list_abadi.ostan as ostan1,list_abadi.city as city1,list_abadi.abadi,list_abadi.mar
,list_city.ostan as ostan2,list_city.city as city2,list_city.shahr,list_city.mar
 FROM  `bah`
 left join list_abadi on list_abadi.add_abadi = bah.add_abadi
 left join list_city  on list_city.add_city   = bah.add_city
 where name like '$name1%'  and last_name like '$last_name%' and fname like '$fname%'  and $v_aria ORDER BY BINARY last_name ASC LIMIT $start, $limit "; 

$query1 = "SELECT bah.id
 FROM  `bah`
 left join list_abadi on list_abadi.add_abadi = bah.add_abadi
 left join list_city  on list_city.add_city   = bah.add_city
 where name like '$name1%'  and last_name like '$last_name%' and fname like '$fname%' and $v_aria  ORDER BY BINARY last_name  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p></br>
           <table width="98%" height="132" border="0" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text1">
      <td height="57" bgcolor="#999999"><p>مشاهده</p>
        <p>اطلاعات</p></td>
      <td width="8%" bgcolor="#999999">کارشناس مروج</td>
      <td bgcolor="#999999">تاریخ ثبت</td>
      <td height="57" bgcolor="#999999">شماره همراه</td>
      <td width="15%" bgcolor="#999999"> کد ملی/ شناسه ملی<br /></td>
      <td width="9%" bgcolor="#999999">نام پدر</td>
      <td width="9%" bgcolor="#999999">نام خانوادگی / نام شرکت</td>
      <td width="6%" bgcolor="#999999"> نام </td>
      <td width="7%" bgcolor="#999999">نوع بهره بردار</td>
      <td width="11%" bgcolor="#999999">شهر / آبادی </td>
      <td width="8%" bgcolor="#999999">شهرستان </td>
      <td width="9%" bgcolor="#999999">استان</td>
      <td width="3%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
      <?php
$r = $start+1 ;
 foreach($stmt as $row)
  {
$mor_cod_m1=$row['mor_cod_m'];
$pic = user_pic($mor_cod_m1) ;
?>
      <td width="6%" height="72" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="view_benef1.php#1" method="post" onsubmit="target_popup2(this)">
        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
        <input type="hidden" name="no_bah" value="<?php echo $row['no_bah'] ;?>" />
        <button><img src="../files/view.png" title="نمایش اطلاعات بهره بردار"  width="33" height="26"  alt=""/></button>
      </form></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><img id="img1" src="../files/users/<?php echo $pic ?>" width="28" height="34"  alt=""/><br />
        <?php echo user_name($mor_cod_m1)?><br/>
        <?php echo $mor_cod_m1?><br /></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="9%" class="normalTextSmaller"><?php echo $row['date_s'];?></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="9%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?><br />
        <?php echo $row['sh_meli'];?>      </p></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fname'];?></td>
      <?php if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;?>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?><br />
        <?php echo $row['co_name'];?> <br /></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah ;?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['abadi'];?><?php echo $row['shahr'];?><br />
        <?php echo $row['add_abadi'];?><?php echo $row['add_city'];?></td>
      <?php 
if ($pic == '') $pic = 'no_pic.png'
 ?>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city1'];?><?php echo $row['city2'];?></td>
      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan1'];?><?php echo $row['ostan2'];?></td>
      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
}
?>
</table>
<div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
<?php 
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);
if($id>1)
{
	?>
    <form  action="list_bah_lastname.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="last_name" value="<?php echo  $last_name ;?>" />
        <input type="hidden" name="name" value="<?php echo  $name1 ;?>" />
        <input type="hidden" name="fname" value="<?php echo  $fname ;?>" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="list_bah_lastname.php?id=<?php echo $id+1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="last_name" value="<?php echo  $last_name ;?>" />
        <input type="hidden" name="name" value="<?php echo  $name1 ;?>" />
        <input type="hidden" name="fname" value="<?php echo  $fname ;?>" />
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
      <li class='current'><form  action="list_bah_lastname.php?id=<?php echo $i?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="last_name" value="<?php echo  $last_name ;?>" />
        <input type="hidden" name="name" value="<?php echo  $name1 ;?>" />
        <input type="hidden" name="fname" value="<?php echo  $fname ;?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
          <p><a href="benef.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>