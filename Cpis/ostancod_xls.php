<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=ostan_cod.xls");
include("../lock_cp.php");
if (isset($_POST['id_ostan']))   $id_ostan1= $_POST['id_ostan'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
	text-align: center;
}

    </style>

</head>
<body>
<?php include_once('../login/config.php'); ?>
           <table width="70%" height="70" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td align="center"width="14%" height="32" bgcolor="#999999">کد شهرستان</td>
               <td align="center"width="14%" height="32" bgcolor="#999999">نام شهرستان</td>
               <td align="center"width="19%" height="32" bgcolor="#999999">کد استان</td>
               <td align="center"width="18%" bgcolor="#999999">نام استان</td>
               <td align="center"width="6%" bgcolor="#999999">ردیف</td>
             </tr>
             <tr>
               <?php
   if ($id_ostan1 == '-1')    { $v_id_ostan = 'id_ostan=id_ostan' ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
   $query = "SELECT  * FROM public_abadi4 WHERE  1 group by id_ostan, id_city order by  id_ostan,id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
 $id_city = $row['id_city'] ;
?>
               <td height="34" align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['id_city'];?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['city'];?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['id_ostan'];?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo $row['ostan'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
       </table>
           </div>
<p  align="center" >................. پایان گزارش .......................</p>
</body>
</html>



