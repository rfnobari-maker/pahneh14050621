<?php include('../lock_cp.php');
include('counter.php');
$id_ostan1 = $_POST['id_ostan'] ;
$id_city1 = $_POST['id_city'] ;
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
  <p class="style1"> اطلاعات مراکز جهاد کشاورزی </p>
  <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <div style=" width: 500px; padding: 15px;border: 3px solid navy; margin:auto" >
    <table width="500" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFCC"><font size="2" class="style1">تعیین معیار جستجو </font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="58" align="right" bgcolor="#F1F1F1" class="input_text" ><form method="post" name="form1" id="form"  action="">
          <select dir="rtl"  name="id_ostan" id="id_ostan" style="width:170px ; height:40px"  onchange="this.form.submit()">
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
        </form>
          <?php if (isset($_POST['id_ostan']))
 $id_ostan = $_POST['id_ostan'] ; 
?></td>
        <td width="163"  align='center' bgcolor="#F1F1F1" class="style1"><font size="2" class="style8">:استان</font></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >
          <form method="post" name="form3" id="form3" action="#1" onsubmit="return ray.ajax()" >
          <select dir="rtl"  name="id_city" id="id_city" style="width:170px ; height:40px">
            <option value="0">انتخاب شهرستان</option>
            <?php
$query = "SELECT DISTINCT id_city,city FROM public_abadi4 WHERE  id_ostan = '$id_ostan' ORDER BY BINARY city ASC"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city1) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
            <?php 
		   }?>
          </select>
            <p>
              <input name="id_ostan" type="hidden" value="<?php echo $id_ostan ;?>" />
              <input type="reset"  value='پاک کردن' style="width:150px ; height:45px" />
              <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
              </p>
          </form></td>
        <td height="38"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
      </tr>
      <tr >
        <td height="40"  align='center' bgcolor="#FFFFFF" class="style8">&nbsp;</td>
      </tr>
      </table>
  </div>

  <p>
    <?php if(isset($_POST['action']))
{
 $id_ostan = $_POST['id_ostan'] ; 
 $id_city = $_POST['id_city'] ; 
 $id_select_city = $_POST['id_city'] ; 
if ($id_ostan == -1) { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan'" ;}
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($add_deh == 0) { $v_add_deh = 'add_deh=add_deh' ;} else { $v_add_deh = "add_deh='$add_deh'" ;}
 $query = "SELECT * FROM  mar where  $v_id_ostan and  $v_id_city order by id_ostan,id_city "  ;
//echo  $query = "SELECT * FROM  public_abadi4 where  $v_id_ostan and  $v_id_city and $v_id_mar  and $v_add_deh  "  ;

$stmt = $dbh->prepare($query);
$stmt->execute();
?>
    <span class="style21"><a name="1" id="1"></a></span>  
  <table width="559" border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
      <td width="118"><form  action="Promotion/Centers/list_organiz.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/centers.png" border="0"  title="مشاهده اطلاعات عمومی مرکز " width="63" height="69" /></button>
        <br />
        <span class="normalTextSmaller">تشکل ها و شرکت ها </span>
      </form></td>
      <td width="99" ><form  action="Promotion/Centers/list_supplies.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/setting.png" border="0"  title="مشاهده اطلاعات عمومی مرکز " width="63" height="69" /></button>
        <br />
        <span class="normalTextSmaller">ملزومات مرکز </span>
      </form></td>
      <td width="102" height="123" >
      <form  action="Promotion/Centers/public.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/morvege1.png" border="0"  title="مشاهده اطلاعات عمومی مرکز " width="63" height="69" /></button>
        <br />
        <span class="normalTextSmaller">اطلاعات پرسنلی </span>
      </form></td>
      <td width="104" height="123" ><form  action="Promotion/Centers/list_build.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/repair.png" border="0"  title="مشاهده اطلاعات ساختمان مرکز " width="63" height="69" /></button>
        <br />
        <span class="normalTextSmaller">اطلاعات ساختمان </span>
      </form></td>
      <td width="104"><form  action="Promotion/Centers/list_public.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city1 ;?>" />
         <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/p_abadi.png" border="0"  title="مشاهده اطلاعات عمومی مرکز " width="63" height="69" /></button>
        <br />
        <span class="normalTextSmaller">اطلاعات عمومی </span>
      </form></td>
    </tr>
  </table>
  <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
  <table width="138" height="56" border="0" align="center">
    <tr>
      <td width="66"><form  action="list_center_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan ;?>" />
        <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
        <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="42" height="42"  alt=""/></button>
      </form></td>
      <td width="124"><form  action="list_center_doc.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan ;?>" />
        <input type="hidden" name="id_city" value="<?php echo  $id_city ;?>" />
        <button><img src="../files/word.png" title="دانلود نتایج با فرمت فایل اکسل"  width="42" height="42"  alt=""/></button>
      </form></td>
    </tr>
  </table>
  <table width="95%" height="145" border="0" align="center" cellpadding="0" cellspacing="2" >
    <tr align="center" class="text1">
      <td height="35" colspan="5" bgcolor="#999999">اطلاعات اختصاصی مرکز جهاد کشاورزی </td>
      <td colspan="3" bordercolor="#FFFFFF" bgcolor="#999999">مشخصات رئیس مرکز</td>
      <td width="15%" rowspan="2" bgcolor="#999999">مرکز جهاد کشاورزی</td>
      <td width="11%" rowspan="2" bgcolor="#999999">شهرستان</td>
      <td width="12%" rowspan="2" bgcolor="#999999">استان</td>
      <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
    <tr align="center" class="text1">
      <td height="44" bgcolor="#999999">تشکل ها </td>
      <td bgcolor="#999999">ملزومات</td>
      <td height="44" bgcolor="#999999">پرسنل</td>
      <td height="44" bgcolor="#999999">اطلاعات ساختمان</td>
      <td height="44" bgcolor="#999999">اطلاعات عمومی</td>
      <td width="10%" bordercolor="#FFFFFF" bgcolor="#999999">نام خانوادگی</td>
      <td width="7%" bordercolor="#FFFFFF" bgcolor="#999999">نام</td>
      <td width="6%" bordercolor="#FFFFFF" bgcolor="#999999">تصویر</td>
    </tr>
    <tr>
      <?php
$r = 1 ;
 foreach($stmt as $row){
$id_city = $row['id_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_mar = $row['id_mar'] ;

$query2 = "SELECT * FROM  users WHERE  id_mar = '$id_mar' and id_city = '$id_city' and id_ostan = '$id_ostan' and  S_access = '2'"  ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'
?>
      <td width="6%" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
      <form  action="Promotion/Centers/organiz.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $row2['id_ostan'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $row2['id_mar'] ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $row2['id_city'] ;?>" />
         <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/centers.png" border="0"  title="مشاهده اطلاعات تشکل و شرکت های مرکز " width="31" height="37" /></button>
      </form></td>
      <td width="7%" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
      <form  action="Promotion/Centers/supplies.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $row2['id_ostan'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $row2['id_mar'] ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $row2['id_city'] ;?>" />
         <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/setting.png" border="0"  title="مشاهده اطلاعات ملزومات مرکز " width="31" height="37" /></button>
      </form></td>
      <td width="6%" height="58" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
      <form  action="Promotion/Centers/personnel.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $row2['id_ostan'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $row2['id_mar'] ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $row2['id_city'] ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/morvege1.png" border="0"  title="مشاهده اطلاعات پرسنلی مرکز " width="31" height="37" /></button>
      </form></td>
      <td width="8%" height="58" class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
      <form  action="Promotion/Centers/building.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $row2['id_ostan'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $row2['id_mar'] ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $row2['id_city'] ;?>" />
       <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
        <button class="tilt"><img src="../files/repair.png" border="0"  title="مشاهده اطلاعات ساختمان مرکز " width="31" height="37" /></button>
      </form></td>
      <td width="7%"  class="tilt" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>>
      <form  action="Promotion/Centers/public.php" method="post">
      <input type="hidden" name="id_ostan" value="<?php echo $row2['id_ostan'] ;?>" />
      <input type="hidden" name="id_mar" value="<?php echo $row2['id_mar'] ;?>" />
      <input type="hidden" name="id_city" value="<?php echo $row2['id_city'] ;?>" />
      <input type="hidden" name="id_select_city" value="<?php echo $id_select_city ;?>" />
      <button class="tilt"><img src="../files/p_abadi.png" border="0"  title="مشاهده اطلاعات عمومی مرکز " width="31" height="37" /></button>
      </form></td>
      <td bordercolor="#FFFFFF" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['Last_name'];?></td>
      <td bordercolor="#FFFFFF"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['name'];?></td>
      <td bordercolor="#FFFFFF" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><img id="img1" src="../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/></span></td>
      <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['mar'];?></td>
      <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['city'];?></td>
      <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?> class="normalTextSmall"><?php echo $row['ostan'];?></td>
      <td  <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
 }
}
?>
</table>
  <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/></a></p>
  </p></td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>



