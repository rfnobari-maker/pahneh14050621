<?php 
include('../lock_ce.php');
include('bee_counter.php');
$sal = '1395' ; 
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
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
            <td><img src="../files/images/header.jpg" width="1200" height="188" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="1200" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      </p>
        <p class="style1">آمار زنبورستان های استان در سال 1395</p>
        <p class="style1"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<div style=" width: 500px; padding: 0px;border: 3px solid navy; margin:auto ; background-color:#f1f1f1" >
<form method="post" name="form1" id="form"  action="">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="55%" height="68"><div align="right"><select  name="id_ostan" class="input_text" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  >
                <?php
$query = "SELECT id_ostan,ostan FROM ostanname"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
                <?php 
		   }?>
              </select></div></td>
              <td width="45%" class="style8"> : نام استان مورد نظر را انتخاب کنید </td>
            </tr>
          </table>
          <p>
            <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
          </p>
          </form>
  </div>

  <p>
  <?php if(isset($_POST['action']) and (isset($_POST['id_ostan'])))
{
	include('../login/config.php');
$id_ostan = $_POST['id_ostan'];
$query = "SELECT  DISTINCT id_ostan,id_city,city FROM list_abadi WHERE  id_ostan = '$id_ostan' order by id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <table width="98%" height="232" border="1" bordercolor="#CCCCCC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td colspan="6" bgcolor="#999999"> Kg میزان تولیدات</td>
               <td width="5%" rowspan="3" bgcolor="#999999">تعداد کلنی تحت پوشش بیمه</td>
               <td colspan="2" bgcolor="#999999">تعداد کندو</td>
               <td colspan="2" bgcolor="#999999">محل تامین ملکه </td>
               <td colspan="9" bgcolor="#999999">میزان تحصیلات زنبورداران استان </td>
               <td width="5%" rowspan="3" bgcolor="#999999">تعداد زنبوردار تحت پوشش بیمه</td>
               <td width="4%" rowspan="3" bgcolor="#999999">تعداد افراد شاغل</td>
               <td width="7%" height="100" rowspan="3" bgcolor="#999999">تایید<br />
                شهرستان</td>
    <td width="6%" rowspan="3" bgcolor="#999999">زنبوردار</td>
    <td width="7%" rowspan="3" bgcolor="#999999">شهرستان </td>
    <td width="3%" rowspan="3" bgcolor="#999999">ردیف</td>
    </tr>
             <tr align="center" class="text1">
               <td colspan="4" bgcolor="#999999">سایر فرآورده ها</td>
               <td colspan="2" bgcolor="#999999">عسل</td>
               <td width="3%" rowspan="2" bgcolor="#999999">مدرن</td>
               <td width="4%" rowspan="2" bgcolor="#999999">بومی</td>
               <td width="3%" rowspan="2" bgcolor="#999999">سایر</td>
               <td width="5%" rowspan="2" bgcolor="#999999">خود مصرفی</td>
               <td width="2%" rowspan="2" bgcolor="#999999">حوزوی</td>
               <td width="2%" rowspan="2" bgcolor="#999999">دکتری</td>
               <td width="2%" rowspan="2" bgcolor="#999999">فوق لیسانس</td>
               <td width="2%" rowspan="2" bgcolor="#999999">لیسانس</td>
               <td width="2%" rowspan="2" bgcolor="#999999">فوق دیپلم</td>
               <td width="3%" rowspan="2" bgcolor="#999999">دیپلم</td>
               <td width="4%" rowspan="2" bgcolor="#999999">سیکل</td>
               <td width="4%" rowspan="2" bgcolor="#999999">خواندن و نوشتن</td>
               <td width="5%" rowspan="2" bgcolor="#999999">بیسواد</td>
             </tr>
             <tr align="center" class="text1">
               <td height="100" bgcolor="#999999">برموم</td>
               <td bgcolor="#999999">موم</td>
               <td bgcolor="#999999">گرده گل </td>
               <td bgcolor="#999999">ژل رویال</td>
               <td bgcolor="#999999">مدرن</td>
               <td bgcolor="#999999">بومی</td>
             </tr>
  <tr>
    <?php
$r = 1 ;
 foreach($stmt as $row){
 $id_city = $row['id_city'] ;
?>
    <?php if(city_status($row['id_city'])=='1') $conf_status='../files/ok.png'; ?>
    <?php if(city_status($row['id_city'])=='2') $conf_status='../files/notok.png'; ?>
    <td width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_t_bar($id_ostan,$id_city,$sal)?></td>
    <td width="2%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_t_mom($id_ostan,$id_city,$sal)?></td>
    <td width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_t_gar($id_ostan,$id_city,$sal)?></td>
    <td width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_t_jel($id_ostan,$id_city,$sal)?></td>
    <td width="3%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_to_mo($id_ostan,$id_city,$sal)?></td>
    <td width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_to_bo($id_ostan,$id_city,$sal)?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bem_kand_count($id_ostan,$row['id_city'],$sal) ?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_tk_mo($id_ostan,$id_city,$sal)?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_tk_bo($id_ostan,$id_city,$sal)?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mt_mom_count($id_ostan,$row['id_city'],$sal,'2')?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mt_mom_count($id_ostan,$row['id_city'],$sal,'1')?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'9')?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'8')?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'7')?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'6')?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'5')?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'4')?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'3')?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'2')?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'1')?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bem_zan_count($id_ostan,$row['id_city'],$sal)?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo sum_city_t_sha($id_ostan,$row['id_city'],$sal) ;?></td>
    
    <td height="59"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="Poultry/confi_bee.php" method="post">
      <input type="hidden" name="id_city" value="<?php echo $row['id_city'] ;?>" />
      <input type="hidden" name="city" value="<?php echo $row['city'] ;?>" />
      <button><img src="<?php echo $conf_status ;?>" border="0"  title="مشاهده آخرین وضعیت تایید اطلاعات به تفکیک مرکز" width="31" height="30" /></button>
    </form></td>
    
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="Poultry/city_list_bee.php" method="post">
      <input type="hidden" name="id_ostan" value="<?php echo $row['id_ostan'] ;?>" />
      <input type="hidden" name="id_city" value="<?php echo $row['id_city'] ;?>" />
      <button><?php echo city_bee_count($row['id_city'],$id_ostan)?></button>
      </form></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?><br />      <?php echo $row['id_city'];?><br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
  <?php }?>
</table>

       <p>&nbsp;</p>
       <p> <p><a href="Poultry/index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>



