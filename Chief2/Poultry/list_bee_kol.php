<?php include('../../lock_ce.php');
include('../../event.php') ;
 $id_ostan1 = $_POST['id_ostan'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $sal = $_POST['sal'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
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
function bee_popup(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
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
?>
  </p>
  <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
  لیست نهایی زنبورستان های استان <br />
  <br />
  <span class="style8">غیر مهاجر استان + مهاجر استان - مهاجر سایر استان ها </span></p>
      <form  id="reg-form" method="post" action="#1">
  <div style="width: 400px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
    <table width="100%" height="234" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="49" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
          <select name="sal" class="input_text  required" id="sal" style="height:40px ; width:170px ; direction:rtl">
            <option value="1403" <?php if (isset($sal) && $sal=='1403') echo 'selected=selected'?>>1403</option>
            <option value="1402" <?php if (isset($sal) && $sal=='1402') echo 'selected=selected'?>>1402</option>
            <option value="1401" <?php if (isset($sal) && $sal=='1401') echo 'selected=selected'?>>1401</option>
            <option value="1398" <?php if (isset($sal) && $sal=='1398') echo 'selected=selected'?>>1398</option>
            <option value="1397" <?php if (isset($sal) && $sal=='1397') echo 'selected=selected'?>>1397</option>
            </select>
        </div></td>
        <td  align='center' bgcolor="#DDDDDD" class="style8">: سرشماری سال</td>
        </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="49" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
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
        <td  align='center' bgcolor="#FFFFFF" class="style8">: استان<span class="style1"><a name="1" id="12"></a></span></td>
        </tr>
      <tr >
        <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
          <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
        </div></td>
        <td height="54"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">: کد ملی بهره بردار</font></td>
      </tr>
      <tr >
        <td height="60" colspan="2" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
      </tr>
    </table>
  </div>
   </form>
  <p>
  <?php if(isset($_POST['action']))
{
 if ($id_ostan1 == '-1')    { $v_id_ostan   = 1 ;}else{ $v_id_ostan = "(((id_ostan='$id_ostan1') and (m_ostan='$id_ostan1' or m_ostan='-'))
 or (id_ostan != '$id_ostan1' and m_ostan = '$id_ostan1'))" ;}
 if ($bah_cod_m == '')      { $v_bah_cod_m  = 1 ;}else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($sal == '')            { $v_sal        = 1 ;}else{ $v_sal       = "sal = '$sal'" ;}
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $query = "SELECT * FROM  bee where  $v_id_ostan  and $v_sal  and $v_bah_cod_m  ORDER BY id_ostan ASC LIMIT $start, $limit ";
 $query1 = "SELECT * FROM  bee where  $v_id_ostan  and $v_sal  and $v_bah_cod_m "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style21"><a name="1" id="1"></a></span>
        <form  action="list_bee_kol_xls.php"  method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="sal" value="<?php echo $_POST['sal'] ;?>" />
          <button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="58" height="59"  alt=""/></button>
      </form></p>
  </p>
  <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#CCCCCC'>
    <tr class="text1">
      <td rowspan="2" bgcolor="#006699">عملیات</td>
      <td colspan="2" rowspan="2" bgcolor="#006699">کارشناس<br />
        مروج</td>
      <td colspan="3" bgcolor="#006699">تولید عسل<br />
        <span class="style8">kg</span></td>
      <td height="43" colspan="3" bgcolor="#006699">تعداد کندو</td>
      <td colspan="2" bgcolor="#006699">مشخصات زنبوردار</td>
      <td width="7%" rowspan="2" bgcolor="#006699"><p>نوع </p>
        <p>زنبورستان</p></td>
      <td colspan="3" bgcolor="#006699">موقعیت زنبورستان</td>
      <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
    </tr>
    <tr class="text1">
      <td width="5%" bgcolor="#006699">جمع</td>
      <td width="5%" bgcolor="#006699">مدرن</td>
      <td width="4%" bgcolor="#006699">سنتی</td>
      <td width="4%" bgcolor="#006699">جمع</td>
      <td width="5%" height="45" bgcolor="#006699">مدرن</td>
      <td width="5%" bgcolor="#006699">سنتی</td>
      <td width="7%" bgcolor="#006699">کد ملی </td>
      <td width="10%" bgcolor="#006699">نام و نام خانوادگی</td>
      <td width="10%" bgcolor="#006699">شهر/آبادی</td>
      <td width="10%" bgcolor="#006699">شهرستان</td>
      <td width="11%" bgcolor="#006699">استان</td>
      </tr>
    <tr>
      <?php 
$r = $start+1 ;
	   foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
 if ($row['no_zan']=='1') $v_no_zan = 'غیرمهاجر '; else $v_no_zan = 'مهاجر' ;
  ?>
      <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <form  action="view_bee.php" method="post" onsubmit="bee_popup(this)">
        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
        <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
        <input type="hidden" name="m_page"  value="list_bee_kol.php" />
        <button><img src="../../files/view.png" title="نمایش اطلاعات زنبورستان"  width="33" height="40"  alt=""/></button>
      </form></td>
      <td width="2%" height="67" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['mor_cod_m']?><br />
        <?php echo user_tel($row['mor_cod_m'])?></p></td>
      <td width="5%" height="67" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />
        <?php echo user_name($row['mor_cod_m'])?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['to_mo']+$row['to_bo'] ;   ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['to_mo'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['to_bo'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_bo'] ?></td>
      <td height="67" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name($row['bah_cod_m'])?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_zan?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']); ?></td>
      <td class="normalTextSmall"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
       <?php 
	   $r++ ; 
}
$query = "SELECT 
count(*) zan,
sum(t_sha) t_sh ,
count(CASE WHEN bee.bem_zan!='3' THEN 1  END )  t_zanB ,
count(CASE WHEN bee.bem_kand='1' THEN 1  END )  t_kandB ,
SUM(t_gar) AS kol_t_gar ,SUM(t_bar) AS kol_t_bar ,SUM(t_mom) AS kol_t_mom ,SUM(t_jel) AS kol_t_jel 
,SUM(t_zah) AS kol_t_zah,SUM(tk_bo) AS kol_k_bo ,SUM(tk_mo) AS kol_k_mo,SUM(to_bo) AS kol_t_bo,
SUM(to_mo) AS kol_t_mo from bee where  $v_id_ostan  and $v_sal and $v_bah_cod_m" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_k_bo = $row['kol_k_bo'];
$kol_k_mo = $row['kol_k_mo'] ; 
$kol_t_bo = $row['kol_t_bo'];
$kol_t_mo = $row['kol_t_mo'] ; 
$kol_to = round(($kol_t_mo + $kol_t_bo),2) ;
$kol_tk = round(($kol_k_mo + $kol_k_bo),2) ;
$av_to_mo = round(($kol_t_mo / $kol_k_mo),2) ;
$av_to_bo = round(($kol_t_bo / $kol_k_bo),2) ;
?>
  </table>
  <br />
  <table width="90%" height="152" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#00CCFF" >
  <tr align="center" class="text1">
    <td colspan="5" bgcolor="#999999">تولید سایر فرآورده های جانبی<br />
Kg<br /></td>
    <td colspan="3" bgcolor="#999999">تولید عسل<br />
      <span class="style8">      میانگین</span><br />
      Kg</td>
    <td height="60" colspan="3" bgcolor="#999999">تعداد کندو</td>
    <td colspan="2" bgcolor="#999999">تعداد تحت پوشش بیمه</td>
    <td colspan="2" bgcolor="#999999">تعداد</td>
    </tr>
  <tr align="center" class="text1">
    <td bgcolor="#999999">زهر</td>
    <td height="35" bgcolor="#999999">بره موم</td>
    <td bgcolor="#999999">موم</td>
    <td bgcolor="#999999">گرده گل </td>
    <td width="8%" bgcolor="#999999">ژل رویال</td>
    <td width="6%" bgcolor="#999999">جمع</td>
    <td width="7%" bgcolor="#999999">مدرن</td>
    <td width="11%" bgcolor="#999999">سنتی</td>
    <td width="6%" bgcolor="#999999">جمع</td>
    <td width="7%" bgcolor="#999999">مدرن</td>
    <td width="7%" bgcolor="#999999">سنتی</td>
    <td width="7%"  bgcolor="#999999">زنبورستان</td>
    <td width="6%"  bgcolor="#999999">زنبوردار</td>
    <td width="6%"  bgcolor="#999999">افراد شاغل</td>
    <td width="7%"  bgcolor="#999999">زنبورستان</td>
    </tr>
  <tr>
    <td width="7%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo round(($row['kol_t_zah']/1000),3) ?></span></td>
    <td width="7%" height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo round($row['kol_t_bar'],0) ?></span></td>
    <td width="8%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo round($row['kol_t_mom'],0) ?></span></td>
    <td width="7%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo round($row['kol_t_gar'],0) ?></span></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo round(($row['kol_t_jel']/1000),3) ?></span></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $kol_to ?></span></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($kol_t_mo,0) ; ?><br />
      <?php echo $av_to_mo ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($kol_t_bo,0) ; ?><br />
      <?php echo $av_to_bo ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $kol_tk ?></span></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $kol_k_mo ;  ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $kol_k_bo ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_kandB'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_zanB'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_sh'] ; ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'] ; ?></td>
    </tr>
</table>
  <p>&nbsp;</p>
  <div   style=" text-align:right;height:50px; margin:auto;width:80%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
  <?php   
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	?>
    <form  action="list_bee_kol.php?id=<?php echo $id-1 ?>#1" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_ostan2" value="<?php echo $mab_ostan ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_zan" value="<?php echo $no_zan ;?>" />
        <input type="hidden" name="sal" value="<?php echo $_POST['sal'] ;?>" />
        <input type="hidden" name="action" value="1" />
        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if($id!=$total)
{
	?>
    <form  action="list_bee_kol.php?id=<?php echo $id+1 ?>#1" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_ostan2" value="<?php echo $mab_ostan ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_zan" value="<?php echo $no_zan ;?>" />
        <input type="hidden" name="sal" value="<?php echo $_POST['sal'] ;?>" />
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
      <form  action="list_bee_kol.php?id=<?php echo $i?>#1" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="id_ostan2" value="<?php echo $mab_ostan ?>" />
        <input type="hidden" name="id_city5" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_zan" value="<?php echo $no_zan ;?>" />
        <input type="hidden" name="sal" value="<?php echo $_POST['sal'] ;?>" />
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
