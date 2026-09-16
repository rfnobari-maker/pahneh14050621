<?php 
include('../../lock_cp.php');
include('../../event.php');
$id_ostan       = isset($_POST['id_ostan'])    ? $_POST['id_ostan']    : '';
$z_sal           = isset($_POST['z_sal'])        ? $_POST['z_sal']        : '';
$Agri_prod_table = 'Agri_prod' . str_replace('-', '_', $z_sal);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<script>
function close_window() {
      close();
 }
</script>
    <style type="text/css">
<!--
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
.report-title {
    font-size: 1.1rem;
    color: #2c3e50;
    margin-bottom: 15px;
    display: block;
    line-height: 1.6;
}

.report-title strong {
    color: #e74c3c;
    font-weight: bold;
}
</style>

</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
<p>
    <span class="report-title">
    لیست محصولات زراعی ثبت شده استان : 
    <strong><?php echo htmlspecialchars(ostan_name($id_ostan), ENT_QUOTES, 'UTF-8'); ?></strong>
     به تفکیک محصول در سال زراعی <strong><?php echo htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8'); ?></strong>
</span>
            <p><span class="style1"><a name="1" id="1"></a></span>
               <?php
 if (isset($_POST['id_ostan'])) 
 {  
 if ($id_ostan == '')   {$v_id_ostan =1;}else{ $v_id_ostan = "id_ostan = '$id_ostan'" ;}
 include('../../login/config.php') ; 
  $query = "SELECT cod_mah ,
sum(zer_kesht_a)  zer_keshta ,
sum(zer_kesht_b)  zer_keshtb ,
sum(s_bar_a)   s_bara ,
sum(s_bar_b)   s_barb ,
sum(mah_tol)  mahtol ,
sum(mah_tolp) mahtolp 
FROM $Agri_prod_table
where $v_id_ostan Group by cod_mah "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
            <table align="center" class="my-table" >
              <tr align="center" class="text1">
               <td height="46" colspan="2" bgcolor="#999999">میزان تولید محصول<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح برداشت<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت <br />
                <span class="style2">هکتار</span></td>
               <td width="12%" rowspan="2" bgcolor="#999999">نام / کد محصول</td>
               <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="38" bgcolor="#999999">قطعی</td>
               <td bgcolor="#999999">پیش بینی</td>
               <td width="10%" height="38" bgcolor="#999999">کل</td>
               <td width="11%" bgcolor="#999999">کشت دوم</td>
               <td width="10%" bgcolor="#999999">کشت اول</td>
               <td height="38" bgcolor="#999999">کل</td>
               <td bgcolor="#999999">کشت دوم</td>
               <td width="9%" bgcolor="#999999">کشت اول</td>
             </tr>
             <tr>
               <?php
$r = 1 ; 
 foreach($stmt as $row){
 $cod_mah = $row['cod_mah'] ;
round($row['zer_keshta'],3) ;
 $zer_keshta = round($row['zer_keshta'],3) ;
 $zer_keshtb = round($row['zer_keshtb'],3) ;
 $zer_keshtkol =  $zer_keshta + $zer_keshtb ; 
 $s_bara = round($row['s_bara'],3) ;
 $s_barb = round($row['s_barb'],3) ;
 $s_barkol =  $s_bara + $s_barb ;
 $mahtol= round($row['mahtol'],3) ; 
 $mahtolp= round($row['mahtolp'],3) ; 
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="11%" height="40" ><?php echo $mahtol ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="13%" ><?php echo $mahtolp ;?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_barkol ;?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_barb ;?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_bara ;?></td>
               <td width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshtkol ;?></td>
               <td width="10%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshtb ;?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshta ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name($row['cod_mah']);?><br />
                 <?php echo $row['cod_mah'];?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
         </table>
             <?php
}
}
?>
         </table>
           
           <p> <button  id="send" class="btn-33"  onclick="close_window()">بازگشت</button></p></p>  </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>