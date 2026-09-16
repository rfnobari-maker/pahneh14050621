<?php include('../lock_p3.php');
include('../event.php') ;
include('counter.php');
$id_ostan1 = $_POST['id_ostan'] ;
$id_city1 = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
$no_fa = $_POST['no_fa'] ; 
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


</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
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
include ('../login/config.php');
?>
  </p>
  <p class="style1"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <div style=" width: 500px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="55" colspan='2' align='center' bgcolor="#CCCCCC"><span class="style1">لیست بهره برداران تحت پوشش </span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td width="354" height="45" align="right" valign="middle" bgcolor="#FFFFFF" class="input_text" ><form method="post" name="form1" id="form"  action="">
          <select  name="id_ostan" disabled="disabled" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
            <option value="-1">انتخاب استان</option>
            <?php
			$id_ostan1 = $id_ostan ;
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
        </form>
          <?php if (isset($_POST['id_ostan']))
 $id_ostan = $_POST['id_ostan'] ; 
?></td>
       <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :استان</font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" align="right" bgcolor="#FFFFFF" class="input_text" ><form method="post" name="form1" id="form2"  action="#1">
          <select  name="id_city" disabled="disabled" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
            <option value="0">انتخاب شهرستان</option>
            <?php
			$id_city1 = $id_city ; 
$query = "SELECT DISTINCT id_city,city FROM public_abadi4 WHERE  id_ostan = '$id_ostan' ORDER BY BINARY city ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city1) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
            <?php 
		   }?>
          </select>
          <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
        </form>
          <?php if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
        <td width="146"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
      </tr>
      <tr >
        <td height="12" align="right" bgcolor="#FFFFFF" class="input_text" ><form method="post" name="form3" id="form3"  action="#1">
          <div align="right">
            <p style="text-align: right">
              <select  name="id_mar" id="id_mar"  style="width:170px ; height:40px" dir="rtl">
                <option value="0"> نام مرکز</option>
                <?php
$query = "SELECT  id_mar,mar FROM mar WHERE   id_ostan = '$id_ostan' and  id_city = '$id_city'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
                <?php }?>
                </select>
              </p>
            <p style="text-align: right">
              <select  name="no_fa"  class="input_text" id="no_fa" style="width:170px ; height:40px" dir="rtl"   >
                <option value="0" >انتخاب زمینه فعالیت</option>
                <option value="fa_1"  <?php if ($no_fa=='fa_1')  echo  'selected=selected'?> >دارای اراضی زراعی</option>
                <option value="fa_2"  <?php if ($no_fa=='fa_2')  echo  'selected=selected'?> >باغ و قلمستان</option>
                <option value="fa_3"  <?php if ($no_fa=='fa_3')  echo  'selected=selected'?>>کشت گلخانه ای</option>
                <option value="fa_45" <?php if ($no_fa=='fa_45') echo  'selected=selected'?>>دام سنگین</option>
                <option value="fa_67" <?php if ($no_fa=='fa_67') echo  'selected=selected'?> >دام سبک</option>
                <option value="fa_8"  <?php if ($no_fa=='fa_8')  echo  'selected=selected'?> >طیور سنتی</option>
                <option value="fa_9"  <?php if ($no_fa=='fa_9')  echo  'selected=selected'?> >طیور صنعتی</option>
                <option value="fa_10" <?php if ($no_fa=='fa_10') echo  'selected=selected'?> >زنبور عسل</option>
                <option value="fa_11" <?php if ($no_fa=='fa_11') echo  'selected=selected'?> >کرم ابریشم</option>
                <option value="fa_12" <?php if ($no_fa=='fa_12') echo  'selected=selected'?> >اپرورش ماهی</option>
                <option value="fa_13" <?php if ($no_fa=='fa_13') echo  'selected=selected'?> >صنایع کشاورزی</option>
                </select>
              </p>
            </div>
          <p align="center">
            <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
            <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
            <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
            </p>
          </form></td>
               <td width="146" valign="top"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> <br />
                 :نام مرکز جهاد </font>
         <p><font  class="style8" size="2">:زمینه فعالیت</font></p></td>
      </tr>
      <tr >
        <td height="11" align="right" bgcolor="#FFFFFF" class="input_text" >&nbsp;</td>
        <td height="29"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
      </tr>
    </table>
  </div>

  <p>
  <?php if(isset($_POST['action']))
{
if ($id_ostan == '-1') { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($no_fa == '0')  { $v_no_fa  = 'id = id'  ; }else{ $v_no_fa = "$no_fa = '1'" ;}
$start=0;
$limit=500;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}

$query = "SELECT * FROM  bah where  $v_id_ostan and  $v_id_city and $v_id_mar and $v_no_fa  ORDER BY BINARY last_name ASC LIMIT $start, $limit "; 
$query1 = "SELECT * FROM  bah where  $v_id_ostan and  $v_id_city and $v_id_mar and $v_no_fa  ORDER BY BINARY last_name ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
  <table width="98%" height="132" border="0" align="center" cellpadding="1" cellspacing="1" >
    <tr align="center" class="text1">
      <td height="57" bgcolor="#999999"><p>مشاهده</p>
        <p>اطلاعات</p></td>
      <td width="10%" bgcolor="#999999">کارشناس مروج</td>
      <td height="57" bgcolor="#999999">شماره همراه</td>
      <td width="10%" bgcolor="#999999"> کد ملی<br /></td>
      <td width="12%" bgcolor="#999999">نام خانوادگی</td>
      <td width="9%" bgcolor="#999999"> نام </td>
      <td width="10%" bgcolor="#999999">نوع بهره بردار</td>
      <td width="13%" bgcolor="#999999">شهر / آبادی </td>
      <td width="12%" bgcolor="#999999">شهرستان </td>
      <td width="6%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
      <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$mor_cod_m=$row['mor_cod_m'];
$pic = user_pic($mor_cod_m) ;
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
if ($add_abadi<>'') {
$query = "SELECT * from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$abadi= $row2['abadi'] ; 
$mar = $row2['mar'];
}
if ($add_city<>'') {
$query = "SELECT * from list_city where add_city = :add_city"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$shahr= $row2['shahr'] ; 
$mar = $row2['mar'];
}

//echo $row2['User_Name'] ; 
?>
      <td width="7%" height="72" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="view_benef.php" method="post">
        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
        <button><img src="../files/view.png" title="نمایش اطلاعات بهره بردار"  width="33" height="26"  alt=""/></button>
      </form></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><img id="img1" src="../files/users/<?php echo $pic ?>" width="28" height="34"  alt=""/><br />
        <?php echo user_name($mor_cod_m)?><br/>
        <?php echo $mor_cod_m?><br /></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="11%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
      <?php if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;?>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah ;?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['abadi'];?><?php echo $row2['shahr'];?></td>
      <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['city'];?></td>
      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
}
?>
</table>
<?php 

$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="list_bah.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa ?>" />

        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="list_bah.php?id=<?php echo $id+1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa ?>" />
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
      <li class='current'><form  action="list_bah.php?id=<?php echo $i?>" method="post">
        <input type="hidden" name="action" value="1" />
         <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa ?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
?>
</div>
          <p>&nbsp;</p>
           <p> <p><a href="prof.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>
    </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>

