<?php 
include('../../lock_ce.php');
include('bee_counter.php');
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if(isset($_POST['sal'])) $sal = $_POST['sal'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
            <td><img src="../../files/images/header.jpg" width="949" height="188" /></td>
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
      <?php include('top.php');?>
      </p>
        <p class="style1">گزارش زنبورستان به تفکیک شهرستان</p>
        <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<div style=" width: 400px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1 ; border-radius:10px" >
<form method="post" name="form1" id="form"  action="#1">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="55%" height="68"><div align="right">
                <select  name="id_ostan" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
                  <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                  <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
                  <?php 
		   }?>
                </select>
              </div></td>
              <td width="45%" class="style8">:  استان مورد نظر</td>
            </tr>
            <tr>
              <td height="68"><div align="right">
                <select name="sal" class="input_text  required" id="sal" style="height:40px ; width:170px ; direction:rtl">
            <option value="1403" <?php if (isset($sal) && $sal=='1403') echo 'selected=selected'?>>1403</option>
          </select>
              </div></td>
              <td class="style8"> : سرشماری سال </td>
            </tr>
          </table>
          <p>
            <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          </p>
          </form>
  </div>
  <?php if(isset($_POST['action']) and (isset($_POST['sal'])))
{
	include('../../login/config.php');
$query = "SELECT
cityname.city ,
sum(bee.tk_bo)     tk_bo,
sum(bee.tk_mo)     tk_mo,
sum(bee.tal_h_sam) tal_h_sam,
sum(bee.tal_h_sel) tal_h_sel,
sum(bee.tal_h_hv)  tal_h_hv,
sum(bee.tal_h_kh)  tal_h_kh,
sum(bee.tal_h_s)   tal_h_s,
sum(bee.tal_b_var) tal_b_var,
sum(bee.tal_b_noz) tal_b_noz,
sum(bee.tal_b_ccd) tal_b_ccd,
sum(bee.tal_b_s)   tal_b_s
from bee 
left join cityname ON bee.id_ostan = cityname.id_ostan  and bee.id_city = cityname.id_city 
where (((bee.id_ostan='$id_ostan1') and (bee.m_ostan='$id_ostan1' or bee.m_ostan='-'))
 or (bee.id_ostan != '$id_ostan1' and bee.m_ostan = '$id_ostan1')) and bee.sal = '$sal'
group by bee.id_city
order by binary cityname.city " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <span class="style21"><a name="1" id="1"></a></span>
  <table width="69" height="56" border="0" align="center">
    <tr>
      <td width="63"><form  action="beeTo_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
        <input type="hidden" name="sal"       value="<?php echo  $sal ;?>" />
        <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
      </form></td>
      </tr>
</table>
  <table width="98%" height="306" border="1" bordercolor="#CCCCCC" align="center" cellpadding="0" cellspacing="0" >
    <tr align="center" class="text1">
      <td height="42" colspan="4" bgcolor="#999999">تلفات ناشی از بیماری</td>
      <td colspan="5" bgcolor="#999999">تلفات ناشی از حوادث</td>
      <td colspan="3" bgcolor="#999999">تعداد کندوی موجود</td>
      <td width="11%" rowspan="2" bgcolor="#999999">شهرستان </td>
      <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
    <tr align="center" class="text1">
      <td width="5%" height="52" bgcolor="#999999">سایر</td>
      <td width="6%" bgcolor="#999999">CCD</td>
      <td width="6%" bgcolor="#999999">نوزما</td>
      <td width="6%" bgcolor="#999999">کنه واروآ</td>
      <td width="6%" height="52" bgcolor="#999999">سایر</td>
      <td width="8%" bgcolor="#999999">خشکسالی</td>
      <td width="8%" bgcolor="#999999">حمله وحوش</td>
      <td width="6%" bgcolor="#999999">سیل</td>
      <td width="7%" bgcolor="#999999">سمپاشی</td>
      <td width="12%" bgcolor="#999999">کل</td>
      <td width="7%" bgcolor="#999999">بومی</td>
      <td width="7%" bgcolor="#999999">مدرن</td>
    </tr>
    <?php
$r = 1 ;
 foreach($stmt as $row){
//$id_ostan = $row['id_ostan'] ; 
//$ostan = $row['ostan'] ; 
?>
    <tr>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_s'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_ccd'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_noz'];?></td>
      <td height="39"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_var'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_s'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_kh'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_hv'];?></td>
      <td height="39"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_sel'];?></td>
      <td height="39"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_sam'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo']+$row['tk_bo'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_bo'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo'];?></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?><br /></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
$query = "SELECT  
sum(tk_bo) tk_bo,
sum(tk_mo) tk_mo,
sum(tal_h_sam) tal_h_sam,
sum(tal_h_sel) tal_h_sel,
sum(tal_h_hv) tal_h_hv,
sum(tal_h_kh) tal_h_kh,
sum(tal_h_s) tal_h_s,
sum(tal_b_var) tal_b_var,
sum(tal_b_noz) tal_b_noz,
sum(tal_b_ccd) tal_b_ccd,
sum(tal_b_s) tal_b_s
from bee 
WHERE (((bee.id_ostan='$id_ostan1') and (bee.m_ostan='$id_ostan1' or bee.m_ostan='-'))
 or (bee.id_ostan != '$id_ostan1' and bee.m_ostan = '$id_ostan1')) and bee.sal = '$sal' "   ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <tr>
      <td height="52" colspan="4" align="center" bgcolor="#999999" class="text1">تلفات ناشی از بیماری</td>
      <td height="52" colspan="5" align="center" bgcolor="#999999" class="text1">تلفات ناشی از حوادث</td>
      <td height="38" colspan="3" bgcolor="#999999"  class="text1">تعداد کندوی موجود</td>
      <td colspan="2" rowspan="3" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل</td>
    </tr>
    <tr>
      <td height="52" align="center" bgcolor="#999999" class="text1">سایر</td>
      <td align="center" bgcolor="#999999" class="text1">CCD</td>
      <td align="center" bgcolor="#999999" class="text1">نوزما</td>
      <td align="center" bgcolor="#999999" class="text1">کنه واروآ</td>
      <td height="52" align="center" bgcolor="#999999" class="text1">سایر</td>
      <td align="center" bgcolor="#999999" class="text1">خشکسالی</td>
      <td align="center" bgcolor="#999999" class="text1">حمله وحوش</td>
      <td align="center" bgcolor="#999999" class="text1">سیل</td>
      <td align="center" bgcolor="#999999" class="text1">سمپاشی</td>
      <td align="center" bgcolor="#999999" class="text1">کل</td>
      <td align="center" bgcolor="#999999" class="text1">بومی</td>
      <td align="center" bgcolor="#999999" class="text1">مدرن</td>
    </tr>
    <tr>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_s'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_ccd'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_noz'];?></td>
      <td height="39"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_var'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_s'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_kh'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_hv'];?></td>
      <td height="39"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_sel'];?></td>
      <td height="39"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_sam'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo']+$row['tk_bo'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_bo'];?></td>
      <td  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo'];?></td>
      <?php
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    </tr>
  </table>
  <?php }?>
       <p>&nbsp;</p>
       <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>



