<?php
include("../../lock_p2.php");
include('../../event.php') ;
include('../../login/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
</style>
<script>
function close_window() {
      close();
 }
</script>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
<p align="center" >&nbsp;</p>
<p align="center" ><span class="style8">مدیریت اطلاعات بهره برداری های زراعی</span><br />
  <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 
  <p>
    <?php
 if (isset($_POST['mah_name'])) 
 {  
$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city = isset($_POST['id_city']) ? $_POST['id_city'] : '';
$id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$Agri_table = 'Agri'.str_replace('-','_',$z_sal) ;
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ;
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';

 if ($id_ostan1 == '-1')  {$v_id_ostan  =1;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)       {$v_id_city   =1;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)       {$v_id_mar    =1;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  {$f_add_abadi =1;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($no_kesh == '0')     {$f_no_kesh   =1;}else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
 if ($mor_cod_m == '')    {$v_mor_cod_m =1;}else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')    {$v_bah_cod_m =1;}else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($mah_name == '')     {$v_cod_mah   =1;}else{ $v_cod_mah = "cod_mah = '$mah_name'" ;}
  $query = "SELECT mor_cod_m,no_mal,no_kesh,id,bah_cod_m,add_city,add_abadi,t_mah,sh_gat,z_sal,m_zamin,id_ostan,id_city,num_bah from $Agri_table where  t_mah>0 and bah_cod_m = :bah_cod_m and $f_no_kesh and exists (select 1 from $Agri_prod_table where Agri_id = $Agri_table.id);
 ORDER BY sh_gat ASC"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
if ($found>0) {
?>
    <span class="style21"><a name="result" id="result"></a></span>  </p>
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td colspan="2" bgcolor="#006699">عملیات</td>
          <td width="8%" bgcolor="#006699">مساحت زمین<br />
            هکتار</td>
          <td width="7%" bgcolor="#006699">نوع کشت</td>
          <td width="8%" bgcolor="#006699">نوع مالکیت</td>
          <td width="4%" bgcolor="#006699">شماره قطعه</td>
          <td width="7%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="10%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="15%" bgcolor="#006699">شهر/آبادی</td>
          <td width="13%" bgcolor="#006699">شهرستان</td>
          <td width="6%" bgcolor="#006699">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
 $pic = user_pic($row['mor_cod_m']) ; 
$v_no_mal = '' ; 
if ($row['no_mal']=='1') $v_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $v_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $v_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $v_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $v_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $v_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $v_no_mal='اجاره' ;	 
if ($row['no_mal']=='8') $v_no_mal='سایر' ;	 
if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 
  ?>
                    <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>   <form  action="../send_pm1.php#1" method="post" onsubmit="target_popup2(this)">
     <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
     <button><img src="../../files/receive_mail.png" width="31" height="30" title="ارسال پیام خصوصی" /></button>
     </form>
</td>

          <td width="5%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
            <form  action="Agridata_view1.php" method="post">
              <input type="hidden" name="id"     value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="z_sal"  value="<?php echo $row['z_sal'] ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
              </form>
          </td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mal ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td height="62" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['num_bah'])?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
      </table>
<?php
 }
 else 
 {
echo '<p class=style8> بهره برداری با مشخصات وارد شده یافت نشد</p>'  ;
 }
 }
?>
       <p> <button  id="send" style="width:150px ; height:45px" onclick="close_window()">بازگشت</button></p></p>  
  </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>
