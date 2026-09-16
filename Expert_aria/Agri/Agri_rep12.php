<?php 
include("../../lock_expar.php");
include("../../Jalali.php");
include('counter11.php');
if (isset($_POST['z_sal'])) {
  $z_sal= $_POST['z_sal'] ; 
$Agri_table = 'Agri'.str_replace('-','_',$z_sal) ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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
	text-align: center;
}

-->
    </style>
		<script type="text/javascript" src="../../15_files/jsapi"></script>

		<script type="text/javascript" src="../../15_files/jquery-1.4.4.min.js"></script>

		<script type="text/javascript" src="../../15_files/jquery.gvChart-1.0.1.min.js"></script>

		<script type="text/javascript">

gvChartInit();

		jQuery(document).ready(function(){

			jQuery('#myTable5').gvChart({

//انواع نمودار www.jqueryscript.net/demo/jQuery-Plugin-To-Generate-Google-Charts-From-Tables-gvChart/
				chartType: 'PieChart',
				gvSettings: {
					vAxis: {title: 'میزان تولید : تن '},
					hAxis: {title: 'نام محصول'},
					width: 400,
					height: 250
					}
			});
		jQuery(document).ready(function(){
			jQuery('#myTable6').gvChart({
				chartType: 'PieChart',
				gvSettings: {
					vAxis: {title: 'No of players'},
					hAxis: {title: 'Month'},
					width: 400,
					height: 250
					}
			});

			});
		jQuery(document).ready(function(){
			jQuery('#myTable7').gvChart({
				chartType: 'PieChart',
				gvSettings: {
					vAxis: {title: 'No of players'},
					hAxis: {title: 'Month'},
					width: 400,
					height: 250
					}
			});


		});
		jQuery(document).ready(function(){
			jQuery('#myTable8').gvChart({
				chartType: 'PieChart',
				gvSettings: {
					vAxis: {title: 'No of players'},
					hAxis: {title: 'Month'},
					width: 400,
					height: 250
					}
			});
		});
		jQuery(document).ready(function(){
			jQuery('#myTable9').gvChart({
				chartType: 'PieChart',
				gvSettings: {
					vAxis: {title: 'No of players'},
					hAxis: {title: 'Month'},
					width: 400,
					height: 250
					}
			});
		});

			});
		</script>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
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
<?php include('../../login/config.php');
?>
<form  id="reg-form" method="post" action="#1">
  <p>&nbsp;</p>
  <div style="width: 450px; padding: 5px; border: 3px solid navy; margin: auto; text-align: left; border-radius:15px" >
    <table width="100%" height="200" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="48" colspan='2' align='center' bgcolor="#FFFFFF"><span class="style11"><span class="style1">نمودار های اراضی زراعی استان </span><span class="style8"><a name="1" id="1"></a></span></span></td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#DDDDDD" class="input_text" >
        <select  name="id_ostan" disabled="disabled" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl" >
           <?php $id_ostan1 = $id_ostan ; 
$query = "SELECT id_ostan,ostan FROM ostanname"  ;
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
?></td>
        <td  align='center' bgcolor="#DDDDDD" class="style8">: استان</td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="46" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="z_sal" class="input_text  required" id="z_sal" style="height:40px ; width:170px ; direction:rtl">
                       <?php
                    $query = "SELECT z_sal FROM z_sal  ORDER BY z_sal DESC "  ;
                    $stmt = $dbh->prepare($query);
                    $stmt->execute();
                    foreach($stmt as $row){
                    ?>
                   <option value="<?php echo $row['z_sal'] ;?>"
                   <?php if ($row['z_sal']==$z_sal) echo 'selected=selected'?>> <?php echo $row['z_sal'] ;?></option>
                   <?php }?>
            </select>
        </div></td>
        <td width="112"  align='center' bgcolor="#FFFFFF" class="style11"><span class="input_text"><font size="2" class="style8">: سال زراعی</font></span></td>
      </tr>
      <tr >
        <td align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
        <td height="60"  align='center' bgcolor="#FFFFFF" class="style11">&nbsp;</td>
      </tr>
    </table>
  </div>
</form>
<?php 
   if (isset($_POST['z_sal']))
   {
 $z_sal= $_POST['z_sal'] ; 
 ?>

           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="100%" height="284" border="0">
             <tr>
               <td width="34%" height="131"><table width="400" border="1" align="center" cellpadding="0" cellspacing="0"  bordercolor="#0066CC" class="Tableheader">
                 <tr>
                   <td width="100%" height="58"><p class="style8" style="text-align: center">نمودار سطح آیش اراضی زراعی استان </p>
                     <div class="main" align="center">
                       <div class="main" align="center">
                         <table id='myTable7' align="center">
                           <caption>
                             درصد / هکتار
                             </caption>
                           <thead>
                             <tr>
                               <th></th>
                               <th>آبی</th>
                               <th>دیم</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td><?php echo round(kol_sum_s_ayesh('1',$id_ostan,$z_sal),1) ?></td>
                               <td><?php echo round(kol_sum_s_ayesh('2',$id_ostan,$z_sal),1) ?></td>
                             </tr>
                           </tbody>
                           <tr>
                             <td></tbody></td>
                           </tr>
                         </table>
                       </div>
                     </div></td>
                 </tr>
               </table></td>
               <td width="33%"><table width="400" border="1" align="center" cellpadding="0" cellspacing="0"  bordercolor="#0066CC" class="Tableheader">
                 <tr>
                   <td width="100%" height="58"><p class="style8" style="text-align: center">نمودار سطح زیر کشت اراضی زراعی استان </p>
                     <div class="main" align="center">
                       <div class="main" align="center">
                         <table id='myTable6' align="center">
                           <caption>
                             درصد / هکتار
                             </caption>
                           <thead>
                             <tr>
                               <th></th>
                               <th>آبی</th>
                               <th>دیم</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td><?php echo round(kol_sum_zer_kesht_a('1',$id_ostan,$z_sal),1) ?></td>
                               <td><?php echo round(kol_sum_zer_kesht_a('2',$id_ostan,$z_sal),1) ?></td>
                             </tr>
                           </tbody>
                           <tr>
                             <td></tbody></td>
                           </tr>
                         </table>
                       </div>
                     </div></td>
                 </tr>
               </table></td>
               <td width="33%"><table width="400" border="1" align="center" cellpadding="0" cellspacing="0"  bordercolor="#0066CC" class="Tableheader">
                 <tr>
                   <td width="100%" height="58"><p class="style8" style="text-align: center">نمودار تعداد قطعات زراعی استان </p>
                     <div class="main" align="center">
                       <div class="main" align="center">
                         <table id='myTable5' align="center">
                           <caption>
                             درصد / قطعه
                             </caption>
                           <thead>
                             <tr>
                               <th></th>
                               <th>آبی</th>
                               <th>دیم</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <td><?php echo kol_no_Agri_gat('1',$id_ostan,$z_sal) ?></td>
                               <td><?php echo kol_no_Agri_gat('2',$id_ostan,$z_sal) ?></td>
                             </tr>
                           </tbody>
                           <tr>
                             <td></tbody></td>
                           </tr>
                         </table>
                       </div>
                     </div></td>
                 </tr>
               </table></td>
             </tr>
             <tr>
               <td height="147">&nbsp;</td>
               <td><table width="400" border="1" align="center" cellpadding="0" cellspacing="0"  bordercolor="#0066CC" class="Tableheader">
                 <tr>
                   <td width="100%" height="58"><p class="style8" style="text-align: center">نمودار سطح زیر کشت اراضی زراعی آبی استان<br />
                     به تفکیک نوع آبیاری </p>
                     <div class="main" align="center">
                       <div class="main" align="center">
                         <table id='myTable9' align="center">
                           <caption>
                             درصد / هکتار
                             </caption>
                           <thead>
                             <tr>
                               <th></th>
                               <?php  $query = "SELECT  no_ab,sum(m_zamin) as m_zamin  FROM $Agri_table where no_kesh = '1' and id_ostan = '$id_ostan' group by no_ab "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
 foreach($stmt as $row){
	 $no_ab = $row['no_ab'] ; 

if ($no_ab=='1') $v_no_ab = 'جوی و پشته' ; 
if ($no_ab=='2') $v_no_ab = 'نواری' ; 
if ($no_ab=='3') $v_no_ab = 'غرقابی' ; 
if ($no_ab=='4') $v_no_ab = 'تشتکی' ; 
if ($no_ab=='5') $v_no_ab = 'تحت فشار قطره ای' ; 
if ($no_ab=='6') $v_no_ab = 'تحت فشار بارانی' ; 
if ($no_ab=='7') $v_no_ab = 'سایر' ; 
?>
                               <th><?php echo  $v_no_ab  ; ?></th>
                               <?php }?>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                               <?php  //$query = "SELECT   m_ab,sum(m_zamin) as m_zamin  FROM $Agri_table where no_kesh = '1' and id_ostan = '$id_ostan' group by m_ab "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
 foreach($stmt as $row){
?>
                               <td><?php echo  $row['m_zamin'] ;?></td>
                               <?php }?>
                             </tr>
                           </tbody>
                           <tr>
                             <td></tbody></td>
                           </tr>
                         </table>
                       </div>
                     </div></td>
                 </tr>
               </table></td>
               <td><table width="400" border="1" align="center" cellpadding="0" cellspacing="0"  bordercolor="#0066CC" class="Tableheader">
                 <tr>
                   <td width="100%" height="58"><p class="style8" style="text-align: center">نمودار سطح زیر کشت اراضی زراعی آبی استان<br />
                     به تفکیک منبع آب </p>
                     <div class="main" align="center">
                       <div class="main" align="center">
                         <table id='myTable8' align="center">
                           <caption>
                             درصد / هکتار
                             </caption>
                           <thead>
                             <tr>
                               <th></th>
  <?php  $query = "SELECT  m_ab,sum(m_zamin) as m_zamin  FROM $Agri_table where no_kesh = '1' and id_ostan = '$id_ostan' group by m_ab "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
 foreach($stmt as $row){
	 $m_ab = $row['m_ab'] ; 
if ($m_ab=='1') $v_m_ab = 'چشمه' ; 
if ($m_ab=='2') $v_m_ab = 'قنات' ; 
if ($m_ab=='3') $v_m_ab = 'رودخانه' ; 
if ($m_ab=='4') $v_m_ab = 'سد' ; 
if ($m_ab=='5') $v_m_ab = 'چاه سطحی' ; 
if ($m_ab=='6') $v_m_ab = 'چاه عمیق' ; 
if ($m_ab=='7') $v_m_ab = 'چاه نیمه عمیق' ; 
if ($m_ab=='8') $v_m_ab = 'زهکش' ; 
if ($m_ab=='9') $v_m_ab = 'پساب' ; 
if ($m_ab=='10') $v_m_ab = 'آب بندان' ; 
if ($m_ab=='11') $v_m_ab = 'سایر' ; 
?>
                               <th><?php echo  $v_m_ab  ; ?></th>
                               <?php }?>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
  <?php  //$query = "SELECT   m_ab,sum(m_zamin) as m_zamin  FROM $Agri_table where no_kesh = '1' and id_ostan = '$id_ostan' group by m_ab "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
 foreach($stmt as $row){
?>
                               <td><?php echo  $row['m_zamin'] ;?></td>
                               <?php }?>
                             </tr>
                           </tbody>
                           <tr>
                             <td></tbody></td>
                           </tr>
                         </table>
                       </div>
                     </div></td>
                 </tr>
               </table></td>
             </tr>
           </table>
           <p>&nbsp;</p>
           <?php }?>
           <p>&nbsp;</p><p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>