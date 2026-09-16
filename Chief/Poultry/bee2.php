<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
require_once('bee_counter.php');
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
if(isset($_POST['sal']))      $sal = $_POST['sal'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style>
button
{
	border-color:#FFF ;
}
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
    </style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
      <p class="style1">آمار تولید زنبورستان های استان به تفکیک شهرستان </p>
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
                    <option value="1404"<?php if ($sal=='1404') echo 'selected=selected'?>>1404</option>
                    <option value="1403"<?php if ($sal=='1403') echo 'selected=selected'?>>1403</option>
                    <option value="1402"<?php if ($sal=='1402') echo 'selected=selected'?>>1402</option>
                    <option value="1401"<?php if ($sal=='1401') echo 'selected=selected'?>>1401</option>
                    <option value="1398"<?php if ($sal=='1398') echo 'selected=selected'?>>1398</option>
                    <option value="1397"<?php if ($sal=='1397') echo 'selected=selected'?>>1397</option>
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
        <p>
  <?php if(isset($_POST['action']) and (isset($_POST['sal'])))
{
	include('../../login/config.php');
$sal = $_POST['sal'];
$query = "SELECT cityname.city,cityname.id_city,
count(bee.id_city) zan,
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
sum(t_nan) t_nan ,
sum(t_zah) t_zah 
FROM cityname 
LEFT JOIN bee ON cityname.id_ostan = bee.id_ostan AND cityname.id_city  = bee.id_city AND bee.sal = '$sal'
WHERE cityname.id_ostan = '$id_ostan1' 
GROUP BY cityname.id_city 
ORDER BY BINARY cityname.city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
        <span class="style21"><a name="1" id="1"></a></span>
      <table width="69" height="56" border="0" align="center">
          <tr>
            <td width="63"><form  action="bee2_xls.php" method="post">
              <input type="hidden" name="id_ostan" value="<?php echo  $id_ostan1 ;?>" />
              <input type="hidden" name="sal" value="<?php echo  $sal ;?>" />
              <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
            </form></td>
          </tr>
        </table>
      <table width="90%"  align="center" class="my-table"  >
             <tr align="center" class="text1">
               <td  colspan="6" bgcolor="#669999">میزان تولید سایر فرآورده ها<br />
Kg</td>
               <td  colspan="2" bgcolor="#669999">عسل تولیدی<span class="style2"><br />
میانگین تولید </span><br />
Kg</td>
               <td colspan="2" bgcolor="#669999">تعداد کندو</td>
               <td colspan="2" bgcolor="#669999">وضعیت شغلی  زنبوردار نفر</td>
               <td colspan="2" bgcolor="#669999">تعداد تحت پوشش بیمه</td>
               <td colspan="2" bgcolor="#669999">تعداد</td>
               <td width="5%" rowspan="2" bgcolor="#669999">تایید </td>
    <td width="7%" rowspan="2" bgcolor="#669999">شهرستان<br /></td>
    <td width="4%" rowspan="2" bgcolor="#669999">ردیف</td>
    </tr>
             <tr align="center" class="text1">
               <td bgcolor="#669999">نان عسل</td>
               <td bgcolor="#669999">زهر</td>
               <td height="50" bgcolor="#669999">بره موم</td>
               <td bgcolor="#669999">موم</td>
               <td bgcolor="#669999">گرده گل </td>
               <td width="3%" bgcolor="#669999">ژل رویال</td>
               <td width="6%" bgcolor="#669999">مدرن</td>
               <td width="7%" bgcolor="#669999">سنتی</td>
               <td width="7%" bgcolor="#669999">مدرن</td>
               <td width="6%" bgcolor="#669999">سنتی</td>
               <td width="5%" bgcolor="#669999">شغل فرعی</td>
               <td width="5%" bgcolor="#669999">شغل اصلی</td>
               <td width="7%" bgcolor="#669999">زنبورستان</td>
               <td width="6%" bgcolor="#669999">زنبوردار</td>
               <td bgcolor="#669999">افراد شاغل</td>
               <td bgcolor="#669999">زنبورستان</td>
             </tr>
               <?php
$r = 1 ;
  foreach($stmt as $row){
 $m_kbo = $row['t_bo'] / $row['k_bo'] ;
 $m_kmo = $row['t_mo'] / $row['k_mo'] ; 
  if(city_status($id_ostan1,$row['id_city'])=='1') $conf_status='../../files/ok.png'; 
  if(city_status($id_ostan1,$row['id_city'])=='2') $conf_status='../../files/notok.png'; ?>
             <tr>
               <td width="3%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_nan'],1) ; ?></td>
               <td width="3%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_zah']/1000),3) ; ?></td>
               <td width="4%" height="51"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bar'],0) ; ?></td>
               <td width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mom'],0) ; ?></td>
               <td width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_gard'],0) ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_jel']/1000),3) ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mo'],0) ; ?><br />
                <?php echo "<div class=style2>" .round($m_kmo,1) . "</div>" ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bo'],0) ; ?><br />
                <?php echo "<div class=style2>" . round($m_kbo,1) . "</div>" ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_mo'] ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_bo'] ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['vaz_zan2'] ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['vaz_zan1'] ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_kandB'] ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_zanB'] ; ?></td>
               <td width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_sh'] ; ?></td>
               <td width="6%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'] ; ?></td>
               <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> <form  action="confi_bee.php" method="post">
                 <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />
                 <input type="hidden" name="id_city" value="<?php echo $row['id_city'] ;?>" />
                 <input type="hidden" name="city" value="<?php echo $row['city'] ;?>" />
                 <input type="hidden" name="sal" value="<?php echo $sal ;?>" />
                 <button><img src="<?php echo $conf_status ;?>" border="0"  title="مشاهده آخرین وضعیت تایید اطلاعات به تفکیک مرکز" width="18" height="23" /></button>
                </form></td>
               <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> > <div align="right" style="margin-right:2px"><?php echo $row['city'] ;?><br />
               </div></td>
               <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
<?php
$r++ ; 
}
$query = "SELECT id_city,
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
sum(t_nan) t_nan ,
sum(t_zah) t_zah 
FROM bee WHERE sal = '$sal' and id_ostan = '$id_ostan1' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $m_kbo = $row['t_bo'] / $row['k_bo'] ;
 $m_kmo = $row['t_mo'] / $row['k_mo'] ; 
?>
  <tr>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_nan'],1) ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_zah']/1000),3) ; ?></td>
    <td height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bar'],0) ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mom'],0) ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_gard'],0) ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_jel']/1000),3) ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mo'],0) ; ?><br />
      <?php echo "<div class=style2>" .round($m_kmo,1) . "</div>" ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bo'],0) ; ?><br />
      <?php echo "<div class=style2>" . round($m_kbo,1) . "</div>" ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_mo'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_bo'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['vaz_zan2'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['vaz_zan1'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_kandB'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_zanB'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_sh'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'] ; ?></td>
    <td colspan="3"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>جمع کل استان</td>
    </tr>
</table>
<?php }?>

    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>