<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=آمار_تلفات_به_تفکیک_شهرستان.xls");
include('../../lock_ce.php');
if(isset($_POST['sal'])) $sal = $_POST['sal'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
        <p align="center" >آمار تلفات به تفکیک شهرستان</p>
          <?php if(isset($_POST['sal']))
{
include('../../login/config.php');
$query = "SELECT * from ostanname where 1 order by binary ostanname.ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
        <table width="98%" height="211" border="1" bordercolor="#CCCCCC" align="center" cellpadding="0" cellspacing="0" >
          <tr align="center" class="text1">
               <td height="28" colspan="4" bgcolor="#999999">تلفات ناشی از بیماری</td>
               <td colspan="5" bgcolor="#999999">تلفات ناشی از حوادث</td>
               <td colspan="3" bgcolor="#999999">تعداد کندوی موجود</td>
    <td width="11%" rowspan="2" bgcolor="#999999">شهرستان  </td>
    <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
             <tr align="center" class="text1">
               <td width="5%" height="29" bgcolor="#999999">سایر</td>
               <td width="6%" bgcolor="#999999">CCD</td>
               <td width="6%" bgcolor="#999999">نوزما</td>
               <td width="6%" bgcolor="#999999">کنه واروآ</td>
               <td width="6%" height="29" bgcolor="#999999">سایر</td>
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
$id_ostan = $row['id_ostan'] ; 
$ostan = $row['ostan'] ; 
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
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
             <tr>
               <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_s'];?></td>
               <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_ccd'];?></td>
               <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_noz'];?></td>
               <td height="30"  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_var'];?></td>
               <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_s'];?></td>
               <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_kh'];?></td>
               <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_hv'];?></td>
               <td height="30"  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_sel'];?></td>
               <td height="30"  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_sam'];?></td>
               <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo']+$row['tk_bo'];?></td>
               <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_bo'];?></td>
               <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $ostan;?><br /></td>
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
      <td height="30" colspan="4" align="center" bgcolor="#999999" class="text1">تلفات ناشی از بیماری</td>
      <td height="30" colspan="5" align="center" bgcolor="#999999" class="text1">تلفات ناشی از حوادث</td>
      <td height="30" colspan="3" align="center" bgcolor="#999999"  class="text1">تعداد کندوی موجود</td>
      <td colspan="2" rowspan="3" align="center" valign="middle" class="style1" >جمع کل</td>
    </tr>
    <tr>
      <td height="34" align="center" bgcolor="#999999" class="text1">سایر</td>
      <td align="center" bgcolor="#999999" class="text1">CCD</td>
      <td align="center" bgcolor="#999999" class="text1">نوزما</td>
      <td align="center" bgcolor="#999999" class="text1">کنه واروآ</td>
      <td height="34" align="center" bgcolor="#999999" class="text1">سایر</td>
      <td align="center" bgcolor="#999999" class="text1">خشکسالی</td>
      <td align="center" bgcolor="#999999" class="text1">حمله وحوش</td>
      <td align="center" bgcolor="#999999" class="text1">سیل</td>
      <td align="center" bgcolor="#999999" class="text1">سمپاشی</td>
      <td align="center" bgcolor="#999999" class="text1">کل</td>
      <td align="center" bgcolor="#999999" class="text1">بومی</td>
      <td align="center" bgcolor="#999999" class="text1">مدرن</td>
      </tr>
    <tr>
      <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_s'];?></td>
      <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_ccd'];?></td>
      <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_noz'];?></td>
      <td height="30"  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_b_var'];?></td>
      <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_s'];?></td>
      <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_kh'];?></td>
      <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_hv'];?></td>
      <td height="30"  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_sel'];?></td>
      <td height="30"  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tal_h_sam'];?></td>
      <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo']+$row['tk_bo'];?></td>
      <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_bo'];?></td>
      <td  class="style1" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo'];?></td>
      <?php
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
      </tr>
</table>
<?php }
$dbh = null ; 
?>
      </td>
  </tr>
</table>
</body>
</html>