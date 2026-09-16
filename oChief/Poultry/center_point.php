<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=document_name.xls");
?>
<?php 
include('../../lock_oce.php');
include('../../event.php') ;

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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td><p>
      <?php 
include ('../../login/config.php');
$query = "SELECT * FROM  markers  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="98%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor='#CCCCCC'>
        <tr class="text1">
          <td width="5%" height="31" bgcolor="#FFCC99">lng</td>
          <td width="6%" bgcolor="#FFCC99">lat</td>
          <td width="4%" bgcolor="#FFCC99">کد مرکز</td>
          <td width="5%" bgcolor="#FFCC99">نام مرکز</td>
          <td width="6%" bgcolor="#FFCC99">شهرستان</td>
        </tr>
          <?php  foreach($stmt as $row){ 
  
  ?>
        <tr>
          <td height="41" bgcolor="#FFFFCC" class="normalTextSmall"><?php echo$row['lng'] ?></td>
          <td bgcolor="#FFFFCC" class="normalTextSmall"><?php echo$row['lat'] ?></td>
          <td class="normalTextSmall"><?php echo$row['id_mar'] ?></td>
          <td class="normalTextSmall"><?php echo$row['mar'] ?></td>
          <td class="normalTextSmall"><?php echo city_name($row['id_city']); ?></td>
        </tr>
        <?php 
}
?>
      </table>
      <p>
    </p></td>
  </tr>
</table>
</body>
</html>