<?php include('../../lock_ce.php');
include('../../event.php') ;
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی</title>
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
    <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
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
  <p class="style1"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

  <div style=" width: 500px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1" >
    <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="40" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style1">اطلاعات زنبورستان های تحت پوشش</span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="45" bgcolor="#DDDDDD" class="input_text" align="right" >
        <form method="post" name="form1" id="form1" >
          <select dir="rtl"  name="id_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()">
                       <option value="0"> کل استان</option>
            <?php
$id_ostan = '03' ;
$query = "SELECT DISTINCT id_city,city FROM list_abadi WHERE  id_ostan = $id_ostan"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<? echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <? echo $row['city'] ;?></option>
            <?php }?>
          </select>
        </form>
          <? if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?></td>
        <td width="163"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
      </tr>
      <tr >
        <td height="23" rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >
          <form method="post" name="form3" id="form3"  action="#1">
            <p>
              <select dir="rtl"  name="id_mar" id="bakh" style="width:170px ; height:40px">
                <option value="0"> نام مرکز</option>
                <?php
$query = "SELECT DISTINCT id_mar,mar FROM list_abadi WHERE  id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                <option value="<? echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <? echo $row['mar'] ;?></option>
                <?php }?>
                </select>
              </p>
            <p>
              <input name="id_city" type="hidden" value="<?php echo $id_city ;?>" />
                        <input type="reset"  value='پاک کردن' style="width:150px ; height:45px" />
              <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
              </p>
            </form></td>
        <td height="47"  align='center' bgcolor="#FFFFFF" class="style8"><font size="2" class="style8">: مرکز خدمات</font></td>
      </tr>
      <tr >
        <td height="29"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
      </tr>
    </table>
</div>

  <p>
  <?php if(isset($_POST['action']))
{
$id_city = $_POST['id_city'] ; 
$id_mar = $_POST['id_mar'] ; 
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
$query = "SELECT * FROM  bee where  id_ostan = '$id_ostan' and  $v_id_city and $v_id_mar "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><span class="style21"><a name="1" id="1"></a></span>
<p align="right"><form  action="list_bee_xls.php" method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ;?>" />
        <input type="hidden" name="id_city" value="<?php echo $_POST['id_city'] ;?>" />
        <input type="hidden" name="id_mar" value="<?php echo $_POST['id_mar'] ;?>" />
        <button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="58" height="59"  alt=""/></button>
      </form></p>
  </p>
  <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#CCCCCC'>
    <tr class="text1">
      <td rowspan="2" bgcolor="#006699">عملیات</td>
      <td width="9%" height="54" rowspan="2" bgcolor="#006699">کارشناس<br />
        مروج</td>
      <td colspan="3" bgcolor="#006699">تولید عسل</td>
      <td height="43" colspan="3" bgcolor="#006699">تعداد کندو</td>
      <td colspan="2" bgcolor="#006699">مشخصات زنبوردار</td>
      <td width="8%" rowspan="2" bgcolor="#006699"><p>نوع </p>
        <p>زنبورستان</p></td>
      <td colspan="2" bgcolor="#006699">موقعیت زنبورستان</td>
      <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
    </tr>
    <tr class="text1">
      <td width="6%" bgcolor="#006699">جمع</td>
      <td width="6%" bgcolor="#006699">مدرن</td>
      <td width="5%" bgcolor="#006699">بومی</td>
      <td width="5%" bgcolor="#006699">جمع</td>
      <td width="6%" height="45" bgcolor="#006699">مدرن</td>
      <td width="6%" bgcolor="#006699">بومی</td>
      <td width="8%" bgcolor="#006699">کد ملی </td>
      <td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
      <td width="10%" bgcolor="#006699">شهر/آبادی</td>
      <td width="9%" bgcolor="#006699">شهرستان</td>
      </tr>
    <tr>
      <?php 
	  $r = 1 ;
	   foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
 if ($row['no_zan']=='1') $v_no_zan = 'بومی '; else $v_no_zan = 'مهاجر' ;
  ?>
      <td width="6%" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="view_bee.php" method="post">
        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
        <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
        <button><img src="../../files/view.png" title="نمایش اطلاعات زنبورستان"  width="33" height="40"  alt=""/></button>
      </form></td>
      <td height="81" class="normalTextSmaller" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><img id="img1" src="../../files/users/<? echo $pic ?>" width="37" height="43"  alt=""/><br />
        <?php echo user_name($row['mor_cod_m'])?><br/>
        <?php echo $row['mor_cod_m']?><br />
        <?php echo user_tel($row['mor_cod_m'])?><br />
        </p></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['to_mo']+$row['to_bo'] ;   ?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['to_mo'] ?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['to_bo'] ?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo'] ?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_bo'] ?></td>
      <td height="81" class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name($row['bah_cod_m'])?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_zan?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
      <td class="normalTextSmall" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name($row['id_city']); ?></td>
      <td class="normalTextSmall"<? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
       <?php 
	   $r++ ; 
}
$query = "SELECT SUM(tk_bo) AS kol_k_bo ,SUM(tk_mo) AS kol_k_mo,SUM(to_bo) AS kol_t_bo,SUM(to_mo) AS kol_t_mo from bee where id_ostan = '$id_ostan' and  $v_id_city and $v_id_mar ";
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
 <tr>
      <td height="81" colspan="2" bgcolor="#999999">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="normalTextSmall" ><?php echo $kol_to ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_t_mo ;  ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_t_bo ;  ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_tk ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_k_mo ;  ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_k_bo ;  ?></td>
      <td height="81" colspan="6" bgcolor="#FFFFFF" class="style1">جمع کل</td>
      </tr>
  </table>
  <p align="right" class="input_text" style="margin-right:20px">میانگین تولید کندوهای بومی : <?php echo $av_to_bo ?> کیلوگرم</p>
  <p align="right" class="input_text" style="margin-right:20px">میانگین تولید کندوهای مدرن : <span class="normalTextSmall"><?php echo $av_to_mo ?><span class="input_text"> کیلوگرم</span></span></p>
  <p>
    <?php }?>
    
  </p>
  <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
  <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><p class="MenuItemRight">سازمان جهاد کشاورزی آذربایجان شرقی<br />
آدرس: 
                
              تبریز، خیابان آزادی - حد فاصل میدان جهاد و چهارراه لاله ،
              تلفن: 34438000-6 041 فکس: 334439940 041<br />
          <span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</table>
</body>
</html>



