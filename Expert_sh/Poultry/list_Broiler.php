<?php include('../../lock_expsh.php');
include('../../event.php') ;
 if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'] ;
 if(isset($_POST['id_city5'])) $id_city   = $_POST['id_city5'] ;
 if(isset($_POST['cod_ep']))   $cod_ep    = $_POST['cod_ep'] ;
 if(isset($_POST['sh_yek']))   $sh_yek    = $_POST['sh_yek'] ;
 if(isset($_POST['no_joj1']))  $no_joj1   = $_POST['no_joj1'] ;
 if(isset($_POST['no_joj2']))  $no_joj2   = $_POST['no_joj2'] ;
 if(isset($_POST['m_joj1']))   $m_joj1    = $_POST['m_joj1'] ;
 if(isset($_POST['m_joj2']))   $m_joj2    = $_POST['m_joj2'] ;
 if(isset($_POST['age_day1'])) $age_day1  = $_POST['age_day1'] ;
 if(isset($_POST['age_day2'])) $age_day2  = $_POST['age_day2'] ;
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
<!--
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
function sama_popup(form) {
    window.open('null', 'formpopup', 'width=700,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
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
include ('../../login/config.php');
include ('../../update_age_day.php')
?>
  </p>
  <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
  لیست واحد های گوشتی در جریان </p>
      <form  id="reg-form" method="post" action="#1">
  <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
    <table width="100%" height="335" border='0' align="center" cellpadding='0' cellspacing='0'>
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
          <select  name="id_ostan"  class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
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
        <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
          <input name="cod_ep" type="text" class="input_text" id="cod_e"  style="height:35px ; width:170px " value="<?php echo $cod_ep?>" />
          </div></td>
        <td height="54"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">: کد اپیدمیولوژیک</font></td>
      </tr>
      <tr >
        <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"><span class="style2">قطعه</span>
          <input name="no_joj2" type="text" class="input_text" id="no_joj2"  style="height:35px ; width:70px " value="<?php echo $no_joj2 ?>" />
        </div></td>
        <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی </td>
        <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">قطعه </span>
            <input name="no_joj1" type="text" class="input_text" id="no_joj1"  style="height:35px ; width:70px " value="<?php echo $no_joj1 ?>" />
        </div></td>
        <td  align='center' bgcolor="#FFFFFF" class="style1"><span class="style8"><font size="2">تعداد جوجه ریزی</font></span><font size="2" class="normalTextSmall"><br />
          : بزرگتر یا مساوی</font></td>
      </tr>
      <tr >
        <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"><span class="style2">قطعه</span>
          <input name="m_joj2" type="text" class="input_text" id="m_joj2"  style="height:35px ; width:70px " value="<?php echo $m_joj2?>" />
        </div></td>
        <td height="50"  align='center' bgcolor="#DDDDDD" class="normalTextSmall">: کوچکتر یا مساوی </td>
        <td height="50" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right"><span class="style2">قطعه</span>
          <input name="m_joj1" type="text" class="input_text" id="m_joj1"  style="height:35px ; width:70px " value="<?php echo $m_joj1?>" />
        </div></td>
        <td  align='center' bgcolor="#DDDDDD" class="style1"><span class="style8"><font size="2">تعداد موجود</font></span><font size="2" class="normalTextSmall"><br />
          : بزرگتر یا مساوی</font></td>
      </tr>
      <tr >
        <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">روز </span>
            <input name="age_day2" type="text" class="input_text" id="age_day2"  style="height:35px ; width:70px " value="<?php echo $age_day2?>" />
        </div></td>
        <td height="50"  align='center' bgcolor="#FFFFFF" class="normalTextSmall">: کوچکتر یا مساوی </td>
        <td height="50" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right"> <span class="style2">روز </span>
            <input name="age_day1" type="text" class="input_text" id="zka4"  style="height:35px ; width:70px " value="<?php echo $age_day1?>" />
        </div></td>
        <td  align='center' bgcolor="#FFFFFF" class="style1"><span class="style8"><font size="2">سن گله</font></span><font size="2" class="normalTextSmall"><br />
          : بزرگتر یا مساوی</font></td>
      </tr>
      <tr >
        <td height="60" colspan="4" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
      </tr>
    </table>
  </div>
   </form>
  <p>
  <?php if(isset($_POST['action']))
{
 if ($id_ostan1 == '-1')  { $v_id_ostan   = 1 ;}else{ $v_id_ostan  = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)       { $v_id_city    = 1 ;}else{ $v_id_city   = "id_city='$id_city'" ;}
 if ($cod_ep == '')       { $v_cod_ep     = 1 ;}else{ $v_cod_ep = "cod_ep = '$cod_ep'" ;}
 if ($sh_yek == '')       { $v_sh_yek     = 1 ;}else{ $v_sh_yek = "sh_yek = '$sh_yek'" ;}
 if ($no_joj1 == '')      {$v_no_joj1      = 1;}else{ $v_no_joj1 = "no_joj >= '$no_joj1'" ;}
 if ($no_joj2 == '')      {$v_no_joj2      = 1;}else{ $v_no_joj2 = "no_joj <= '$no_joj2'" ;}
 if ($m_joj1 == '')       {$v_m_joj1      = 1;}else{ $v_m_joj1 = "m_joj >= '$m_joj1'" ;}
 if ($m_joj2 == '')       {$v_m_joj2      = 1;}else{ $v_m_joj2 = "m_joj <= '$m_joj2'" ;}
 if ($age_day1 == '')     {$v_age_day1  = 1;}else{ $v_age_day1 = "age_day >= '$age_day1'" ;}
 if ($age_day2 == '')     {$v_age_day2  = 1;}else{ $v_age_day2 = "age_day <= '$age_day2'" ;}
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $query  = "SELECT ostan,city,cod_ep,sh_yek,name_unit,z_kol,date_joj,no_joj,m_joj,age_day FROM  samasat2 where  $v_id_ostan  and $v_cod_ep and $v_sh_yek  and  $v_id_city and $v_no_joj1 and $v_no_joj2 and $v_m_joj1  and $v_m_joj2 and $v_age_day1 and $v_age_day2  ORDER BY age_day ASC LIMIT $start, $limit ";
 $query1 = "SELECT no_joj FROM  samasat2 where  $v_id_ostan  and $v_cod_ep and $v_sh_yek  and  $v_id_city and $v_no_joj1 and $v_no_joj2 and $v_m_joj1  and $v_m_joj2 and $v_age_day1 and $v_age_day2  ORDER BY age_day ASC"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style21"><a name="1" id="1"></a></span>
        <form  action="list_sama_xls.php"  method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
        <input type="hidden" name="cod_ep" value="<?php echo $cod_ep ;?>" />
        <input type="hidden" name="sh_yek" value="<?php echo $sh_yek ;?>" />
        <input type="hidden" name="no_joj1" value="<?php echo $no_joj1 ;?>" />
        <input type="hidden" name="no_joj2" value="<?php echo $no_joj2 ;?>" />
        <input type="hidden" name="m_joj1" value="<?php echo $m_joj1 ;?>" />
        <input type="hidden" name="m_joj2" value="<?php echo $m_joj2 ;?>" />
        <input type="hidden" name="age_day1" value="<?php echo $age_day1 ;?>" />
        <input type="hidden" name="age_day2" value="<?php echo $age_day2 ;?>" />
          <button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="58" height="59"  alt=""/></button>
      </form></p>
  </p>
  <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#CCCCCC'>
    <tr class="text1">
      <td rowspan="2" bgcolor="#006699">رویداد</td>
      <td width="5%" rowspan="2" bgcolor="#006699">تعداد موجود</td>
      <td width="8%" rowspan="2" bgcolor="#006699">تعداد جوجه ریزی</td>
      <td width="8%" rowspan="2" bgcolor="#006699">ظرفیت کل</td>
      <td width="5%" rowspan="2" bgcolor="#006699">سن گله <br />
        روز</td>
      <td width="9%" rowspan="2" bgcolor="#006699">تاریخ جوجه ریزی</td>
      <td width="12%" rowspan="2" bgcolor="#006699">شناسه یکتا واحد</td>
      <td width="11%" rowspan="2" bgcolor="#006699">کد اپیدمیولوژیک</td>
      <td width="15%" rowspan="2" bgcolor="#006699"><p>نام واحد</p></td>
      <td colspan="2" bgcolor="#006699">موقعیت واحد</td>
      <td width="3%" rowspan="2" bgcolor="#006699">ردیف</td>
    </tr>
    <tr class="text1">
      <td width="10%" height="45" bgcolor="#006699">شهرستان</td>
      <td width="9%" bgcolor="#006699">استان</td>
      </tr>
    <tr>
      <?php 
$r = $start+1 ;
	   foreach($stmt as $row){ 
$av_no_joj = $row['no_joj'];
  ?>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
        <form  action="report_view.php" method="post" onsubmit="sama_popup(this)">
          <input type="hidden" name="sh_yek" value="<?php echo $row['sh_yek'] ;?>" />
          <input type="hidden" name="date_joj"  value="<?php echo $row['date_joj'] ;?>" />
          <input type="hidden" name="m_page"  value="list_Broiler.php" />
          <button><img src="../../files/History.png" title="مشاهده رویدادهای ثبت شده "  width="26" height="22"  alt=""/></button>
        </form></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_joj'] ;  ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_joj'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_kol'] ; ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['age_day'] ;  ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_joj'] ?></td>
      <td height="50" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_yek'] ; ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_ep'] ; ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name_unit'] ; ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['city'] ; ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['ostan']; ?></td>
      <td class="normalTextSmall"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
       <?php 
	   $r++ ; 
}
$query = "SELECT AVG(age_day) as avg_age_day,SUM(no_joj) AS kol_no_joj,SUM(m_joj) AS kol_m_joj,SUM(z_kol) AS kol_z_kol FROM  samasat2 where  $v_id_ostan  and $v_cod_ep and $v_sh_yek  and  $v_id_city and $v_no_joj1 and $v_no_joj2 and $v_m_joj1  and $v_m_joj2 and $v_age_day1 and $v_age_day2" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_no_joj = $row['kol_no_joj'];
$kol_z_kol = $row['kol_z_kol'];
$kol_m_joj = $row['kol_m_joj'];
$avg_age_day = $row['avg_age_day'];


?>
 <tr>
      <td height="43" bgcolor="#999999">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_m_joj ;  ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_no_joj ;  ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_z_kol ;  ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo round($avg_age_day,0) ;  ?></td>
      <td height="43" colspan="7" bgcolor="#FFFFFF" class="normalTextSmall">جمع کل</td>
      </tr>
  </table>
  <p align="right" class="input_text" style="margin-right:20px">&nbsp;</p>
  <div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
    <?php   
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="list_Broiler.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="cod_ep" value="<?php echo $cod_ep ;?>" />
        <input type="hidden" name="sh_yek" value="<?php echo $sh_yek ;?>" />
        <input type="hidden" name="no_joj1" value="<?php echo $no_joj1 ;?>" />
        <input type="hidden" name="no_joj2" value="<?php echo $no_joj2 ;?>" />
        <input type="hidden" name="m_joj1" value="<?php echo $m_joj1 ;?>" />
        <input type="hidden" name="m_joj2" value="<?php echo $m_joj2 ;?>" />
        <input type="hidden" name="age_day1" value="<?php echo $age_day1 ;?>" />
        <input type="hidden" name="age_day2" value="<?php echo $age_day2 ;?>" />
        <input type="hidden" name="action" value="1" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="list_Broiler.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="cod_ep" value="<?php echo $cod_ep ;?>" />
        <input type="hidden" name="sh_yek" value="<?php echo $sh_yek ;?>" />
        <input type="hidden" name="no_joj1" value="<?php echo $no_joj1 ;?>" />
        <input type="hidden" name="no_joj2" value="<?php echo $no_joj2 ;?>" />
        <input type="hidden" name="m_joj1" value="<?php echo $m_joj1 ;?>" />
        <input type="hidden" name="m_joj2" value="<?php echo $m_joj2 ;?>" />
        <input type="hidden" name="age_day1" value="<?php echo $age_day1 ;?>" />
        <input type="hidden" name="age_day2" value="<?php echo $age_day2 ;?>" />
        <input type="hidden" name="action" value="1" />
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
      <li class='current'>
      <form  action="list_Broiler.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="cod_ep" value="<?php echo $cod_ep ;?>" />
        <input type="hidden" name="sh_yek" value="<?php echo $sh_yek ;?>" />
        <input type="hidden" name="no_joj1" value="<?php echo $no_joj1 ;?>" />
        <input type="hidden" name="no_joj2" value="<?php echo $no_joj2 ;?>" />
        <input type="hidden" name="m_joj1" value="<?php echo $m_joj1 ;?>" />
        <input type="hidden" name="m_joj2" value="<?php echo $m_joj2 ;?>" />
        <input type="hidden" name="age_day1" value="<?php echo $age_day1 ;?>" />
        <input type="hidden" name="age_day2" value="<?php echo $age_day2 ;?>" />
        <input type="hidden" name="action" value="1" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
}
echo "</ul>";
?>
</div>
 
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
