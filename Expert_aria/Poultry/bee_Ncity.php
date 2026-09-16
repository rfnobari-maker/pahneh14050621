<?php 
include('../../lock_expar.php');
include('../../event.php');
if(isset($_POST['sal'])) $sal = $_POST['sal'];
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'] ;
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
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="188" /></td>
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
      </p>
        <p class="style1">آمار نهایی تولید زنبورستان به تفکیک شهرستان <br />
          <span class="style8">غیرمهاجر شهرستان + مهاجر شهرستان - مهاجر سایر شهرستان ها / استان ها </span>        </p>
        <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<div style=" width: 400px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1" >
<form method="post" name="form1" id="form"  action="#1">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="64%" height="68"><div align="right">
                <select name="sal" class="input_text  required" id="sal" style="height:40px ; width:170px ; direction:rtl">
            <option value="1404" <?php if (isset($sal) && $sal=='1404') echo 'selected=selected'?>>1404</option>
            <option value="1403" <?php if (isset($sal) && $sal=='1403') echo 'selected=selected'?>>1403</option>
            <option value="1402" <?php if (isset($sal) && $sal=='1402') echo 'selected=selected'?>>1402</option>
            <option value="1401" <?php if (isset($sal) && $sal=='1401') echo 'selected=selected'?>>1401</option>
            <option value="1398" <?php if (isset($sal) && $sal=='1398') echo 'selected=selected'?>>1398</option>
                  </select>
                </div></td>
              <td width="36%" class="style8"> : سرشماری سال </td>
            </tr>
            <tr bgcolor='#f1f1f1' >
              <td height="49" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
                <?php
$query = "SELECT id_ostan,ostan FROM ostanname where id_ostan =$id_ostan ORDER BY BINARY ostan ASC "  ;
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
            </table>
          <p>
            <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          </p>
          </form>
  </div>

  <p>
  <?php if(isset($_POST['action']) and (isset($_POST['sal'])) and $_POST['id_ostan']!='-1' )
{
	include('../../login/config.php');
 $query = "SELECT city,id_city FROM cityname WHERE id_ostan = '$id_ostan1' ORDER BY BINARY city  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <span class="style21"><a name="1" id="1"></a></span>
  <table width="69" height="56" border="0" align="center">
    <tr>
      <td width="63"><form  action="bee_Ncity_xls.php" method="post">
        <input type="hidden" name="sal" value="<?php echo  $sal ;?>" />
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ;?>" />

        <button><img src="../../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="44" height="45"  alt=""/></button>
      </form></td>
    </tr>
  </table>
  <table  align="center" class="my-table" >
    <tr align="center" class="text1">
      <td colspan="6" bgcolor="#669999">میزان تولید سایر فرآورده ها<br />
        Kg</td>
      <td colspan="2" bgcolor="#669999">عسل تولیدی<span class="style2"><br />
        میانگین تولید </span><br />
        Kg</td>
      <td height="59" colspan="2" bgcolor="#669999">تعداد کندو</td>
      <td colspan="2" bgcolor="#669999">وضعیت شغلی  زنبوردار نفر</td>
      <td colspan="2" bgcolor="#669999">تعداد تحت پوشش بیمه</td>
      <td colspan="2" bgcolor="#669999">تعداد</td>
      <td rowspan="2" bgcolor="#669999">شهرستان</td>
      <td width="4%" rowspan="2" bgcolor="#669999">ردیف</td>
    </tr>
    <tr align="center" class="text1">
      <td bgcolor="#669999">نان عسل</td>
      <td height="53" bgcolor="#669999">زهر</td>
      <td bgcolor="#669999">بره موم</td>
      <td bgcolor="#669999">موم</td>
      <td bgcolor="#669999">گرده گل </td>
      <td width="5%" bgcolor="#669999">ژل رویال</td>
      <td width="7%" bgcolor="#669999">مدرن</td>
      <td width="8%" bgcolor="#669999">سنتی</td>
      <td width="6%" bgcolor="#669999">مدرن</td>
      <td width="6%" bgcolor="#669999">سنتی</td>
      <td width="5%" bgcolor="#669999">شغل فرعی</td>
      <td width="5%" bgcolor="#669999">شغل اصلی</td>
      <td width="6%" bgcolor="#669999">زنبورستان</td>
      <td width="6%" bgcolor="#669999">زنبوردار</td>
      <td bgcolor="#669999">افراد شاغل</td>
      <td bgcolor="#669999">زنبورستان</td>
    </tr>
    <?php
$r = 1 ;
 foreach($stmt as $row2){
//$id_ostan1 = $row2['id_ostan'] ; 
$id_city1 = $row2['id_city'] ; 
$v_id_city = "(
((id_ostan='$id_ostan1') and (id_city='$id_city1') and (m_ostan = '-')) or
((m_ostan='$id_ostan1') and (m_city='$id_city1'))
)" ;
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
sum(t_nan) t_nan ,
sum(t_zah) t_zah 
FROM bee where  $v_id_city  and sal = '$sal' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $m_kbo = $row['t_bo'] / $row['k_bo'] ;
 $m_kmo = $row['t_mo'] / $row['k_mo'] ; 

 ?>
    <tr>
      <td width="3%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_nan'],1) ; ?></td>
      <td width="4%" height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_zah']/1000),3) ; ?></td>
      <td width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bar'],0) ; ?></td>
      <td width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mom'],0) ; ?></td>
      <td width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_gard'],0) ; ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_jel']/1000,3) ; ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mo'],0) ; ?><br />
        <?php echo "<div class=style2>" .round($m_kmo,1) . "</div>" ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bo'],0) ; ?><br />
        <?php echo "<div class=style2>" . round($m_kbo,1) . "</div>" ; ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_mo']*1 ; ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_bo']*1 ; ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['vaz_zan2'] ; ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['vaz_zan1'] ; ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_kandB']*1 ; ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_zanB']*1 ; ?></td>
      <td width="6%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_sh']*1 ; ?></td>
      <td width="7%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'] ; ?></td>
      <td  class="normalTextSmaller"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><div align="right" style="margin-right:2px"> <?php echo $row2['city'];?></div></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
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
sum(t_nan) t_nan ,
sum(t_zah) t_zah 
FROM bee WHERE $v_id_ostan  and  sal = '$sal'   "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $m_kbo = $row['t_bo'] / $row['k_bo'] ;
 $m_kmo = $row['t_mo'] / $row['k_mo'] ; 
?>
    <tr>
      <td width="3%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_nan'],1) ; ?></td>
      <td height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_zah']/1000),3) ; ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bar'],0) ; ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mom'],0) ; ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_gard'],0) ; ?></td>
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
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_sh']*1 ; ?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'] ; ?></td>
      <td colspan="3" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >کل استان</td>
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