<?php 
include('../../lock_ce.php');
include('../../event.php');
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
        <p class="style1">آمار نهایی تولید زنبورستان به تفکیک استان <br />
          <span class="style8">غیرمهاجر استان + مهاجر استان - مهاجر سایر استان ها </span>        </p>
        <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<div style=" width: 400px; padding: 0px; border-radius:10px ;border: 3px solid navy; margin:auto ; background-color:#f1f1f1" >
<form method="post" name="form1" id="form"  action="#1">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="64%" height="68"><div align="right">
<select name="sal" class="input_text  required" id="sal" style="height:40px ; width:170px ; direction:rtl">
            <option value="1403" <?php if (isset($sal) && $sal=='1403') echo 'selected=selected'?>>1403</option>
            <option value="1402" <?php if (isset($sal) && $sal=='1402') echo 'selected=selected'?>>1402</option>
            <option value="1401" <?php if (isset($sal) && $sal=='1401') echo 'selected=selected'?>>1401</option>
            <option value="1398" <?php if (isset($sal) && $sal=='1398') echo 'selected=selected'?>>1398</option>
            <option value="1397" <?php if (isset($sal) && $sal=='1397') echo 'selected=selected'?>>1397</option>
          </select>              </div></td>
              <td width="36%" class="style8"> : سرشماری سال </td>
            </tr>
          </table>
          <p>
            <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          </p>
          </form>
  </div>

  <p>
  <?php if(isset($_POST['action']) and (isset($_POST['sal'])))
{
	include('../../login/config.php');
$query = "SELECT ostan,id_ostan FROM ostanname WHERE 1 ORDER BY BINARY ostan  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <span class="style21"><a name="1" id="1"></a></span>
  <table width="69" height="56" border="0" align="center">
    <tr>
      <td width="63"><form  action="bee60_xls.php" method="post">
        <input type="hidden" name="sal" value="<?php echo  $sal ;?>" />
        <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
      </form></td>
    </tr>
  </table>
  <table width="98%" height="199" border="1" bordercolor="#CCCCCC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td colspan="5" bgcolor="#999999">میزان تولید سایر فرآورده ها<br />
Kg</td>
               <td colspan="2" bgcolor="#999999">عسل تولیدی<span class="style2"><br />
میانگین تولید </span><br />
Kg</td>
               <td height="58" colspan="2" bgcolor="#999999">تعداد کندو</td>
               <td colspan="2" bgcolor="#999999">وضعیت شغلی  زنبوردار نفر</td>
               <td colspan="2" bgcolor="#999999">تعداد تحت پوشش بیمه</td>
               <td colspan="2" bgcolor="#999999">تعداد</td>
               <td width="9%" rowspan="2" bgcolor="#999999"><br />      استان</td>
    <td width="3%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
             <tr align="center" class="text1">
               <td height="44" bgcolor="#999999">زهر</td>
               <td bgcolor="#999999">بره موم</td>
               <td bgcolor="#999999">موم</td>
               <td bgcolor="#999999">گرده گل </td>
               <td width="5%" bgcolor="#999999">ژله رویال</td>
               <td width="6%" bgcolor="#999999">مدرن</td>
               <td width="7%" bgcolor="#999999">سنتی</td>
               <td width="6%" bgcolor="#999999">مدرن</td>
               <td width="6%" bgcolor="#999999">سنتی</td>
               <td width="7%" bgcolor="#999999">شغل فرعی</td>
               <td width="7%" bgcolor="#999999">شغل اصلی</td>
               <td width="7%" bgcolor="#999999">زنبورستان</td>
               <td width="6%" bgcolor="#999999">زنبوردار</td>
               <td bgcolor="#999999">افراد شاغل</td>
               <td bgcolor="#999999">زنبورستان</td>
             </tr>
             <tr>
               <?php
$r = 1 ;
 foreach($stmt as $row2){
$id_ostan1 = $row2['id_ostan'] ; 
$v_id_ostan = "(((id_ostan='$id_ostan1') and (m_ostan='$id_ostan1' or m_ostan='-'))
 or (id_ostan != '$id_ostan1' and m_ostan = '$id_ostan1'))" ;
$query = "SELECT count(*) zan,
sum(t_sha) t_sh ,
count(CASE WHEN bee.bem_zan!='3' THEN 1  END )  t_zanB ,
count(CASE WHEN bee.vaz_zan ='1' THEN 1  END )  vaz_zan1 ,
count(CASE WHEN bee.vaz_zan ='2' THEN 1  END )  vaz_zan2 ,
sum(tk_bo) k_bo ,
sum(tk_mo) k_mo ,
count(CASE WHEN bee.bem_kand='1' THEN 1  END )  t_kandB ,
sum(to_bo) t_bo ,
sum(to_mo) t_mo ,
sum(t_gar) t_gard , 
sum(t_bar) t_bar , 
sum(t_mom) t_mom , 
sum(t_jel) t_jel ,
sum(t_zah) t_zah 
FROM bee where  $v_id_ostan  and sal = '$sal' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $m_kbo = $row['t_bo'] / $row['k_bo'] ;
 $m_kmo = $row['t_mo'] / $row['k_mo'] ; 

 ?>
               <td width="5%" height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_zah']/1000),3) ; ?></td>
               <td width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bar'],0) ; ?></td>
               <td width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mom'],0) ; ?></td>
               <td width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_gard'],0) ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_jel']/1000,3) ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mo'],0) ; ?><br />
                <?php echo "<div class=style2>" .round($m_kmo,1) . "</div>" ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bo'],0) ; ?><br />
                <?php echo "<div class=style2>" . round($m_kbo,1) . "</div>" ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_mo']*1 ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_bo']*1 ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['vaz_zan2'] ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['vaz_zan1'] ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_kandB'] ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_zanB'] ; ?></td>
               <td width="7%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_sh']*1 ; ?></td>
               <td width="6%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'] ; ?></td>
               <td  class="normalTextSmaller"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><div align="right" style="margin-right:2px"> <?php echo $row2['ostan'];?></div></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
<?php
$r++ ; 
}
$query = "SELECT id_ostan,
count(*) zan,
sum(t_sha) t_sh ,
count(CASE WHEN bee.bem_zan!='3' THEN 1  END )  t_zanB ,
count(CASE WHEN bee.vaz_zan ='1' THEN 1  END )  vaz_zan1 ,
count(CASE WHEN bee.vaz_zan ='2' THEN 1  END )  vaz_zan2 ,
sum(tk_bo) k_bo ,
sum(tk_mo) k_mo ,
count(CASE WHEN bee.bem_kand='1' THEN 1  END )  t_kandB ,
sum(to_bo) t_bo ,
sum(to_mo) t_mo ,
sum(t_gar) t_gard , 
sum(t_bar) t_bar , 
sum(t_mom) t_mom , 
sum(t_jel) t_jel ,
sum(t_zah) t_zah 
FROM bee WHERE sal = '$sal' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $m_kbo = $row['t_bo'] / $row['k_bo'] ;
 $m_kmo = $row['t_mo'] / $row['k_mo'] ; 
?>
  <tr>
    <td height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_zah']/1000),3) ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bar'],0) ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mom'],0) ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_gard'],0) ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_jel']/1000),3) ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mo'],0) ; ?><br />
      <?php echo "<div class=style2>" .round($m_kmo,1) . "</div>" ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bo'],0) ; ?><br />
      <?php echo "<div class=style2>" . round($m_kbo,1) . "</div>" ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_mo']*1 ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_bo']*1 ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['vaz_zan2'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['vaz_zan1'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_kandB'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_zanB'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_sh']*1; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'] ; ?></td>
    <td colspan="3" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >کل کشور</td>
    </tr>
</table>
<?php }?>
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