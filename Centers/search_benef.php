<?php
include("../lock_p2.php");
include('../event.php') ;
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$no_bah    = isset($_POST['no_bah']) ? $_POST['no_bah'] : '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
</style>
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_popup3(form) {
    window.open('null', 'formpopup', 'width=1100,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
 <script src="../15_files/jquery.js" type="text/javascript"></script>
<script src="../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
            $.validator.addMethod("IsDate",
                  function (value, element) {
                      var result = /^(?:1[23]\d{2})\/(?:0?[1-9]|1[0-2])\/(?:0?[1-9]|[12][0-9]|3[01])$/.test(value);
                      if (value.length == 0)
                          return true;
                      else
                          return result;
                  },
                   "<br/><span style='color:#FF0066'>مثال<br/><span dir='ltr'>1390/08/14 </span></span>"
             );

            //$("#form1").validate();
        });
    </script>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 include ('../login/config.php');
 ?>
<p align="center" > سوابق بهره بردار <br />
  <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<form  id="reg-form" method="post" action="#1">
<div style="width: 400px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="186" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td height="58" align="right" class="input_text" >
                 <input type="text" name="bah_cod_m" id="bah_cod_m"  value="<?php echo $bah_cod_m?>" style="width:100px ; height:40px ; color:#900 ; font-size:14px" /></td>
                 <td  align='center' class="style8"> : کد ملی بهره بردار/مدیرعامل</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="198" height="46" align="right" class="input_text" >
                   <select  name="no_bah" class="style8" id="sal" style="width:100px ; height:40px" dir="rtl" >
                     <option value='1' <?php if ($no_bah=='1') echo 'selected=selected'?>>حقیقی</option>
                     <option value='2' <?php if ($no_bah=='2') echo 'selected=selected'?>>حقوقی</option>
                     </select>
</td>
                 <td width="202"  align='center' class="style8"> : نوع بهره بردار</td>
               </tr>
               <tr >
                 <td height="60" colspan="2" align="left">
                   <input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' />
                   </td>
               </tr>
             </table> 
           </div>
 </form>
  <p>
    <?php 
 if (isset($_POST['action'])) 
 {  
    include('../login/config.php');

$query = "SELECT bah_cod_m,num_bah from bah where  bah_cod_m = :bah_cod_m and no_bah = :no_bah"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':no_bah'=>$no_bah ));
$found = $stmt -> rowCount();
if ($found>0) {
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $bah_cod_m = $row['bah_cod_m'] ;
 $num_bah   = $row['num_bah'] ;
?>
    <span class="style21"><a name="1" id="1"></a></span>  
      <?php sar_data20($bah_cod_m,$num_bah) ;?>
  <br>
  <table align="center" class="my-table" >
    <tr>
     <td height="38" colspan="10" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>سوابق بهره بردار در سامانه </strong></div></td>
   </tr>
    <tr>
      <td height="32" colspan="8" bgcolor="#FFFFCC" class="style8">تعداد واحد ثبت شده در سال</td>
      <td colspan="2" rowspan="2" bgcolor="#FFFFCC">نوع بهره برداری </td>
    </tr>
    <tr>
      <td width="101" bgcolor="#FFFFCC"><span class="style8">1405</span><br />
        1404-1405</td>
      <td width="101" bgcolor="#FFFFCC"><span class="style8">1404</span><br />
        1403-1404</td>
      <td width="99" bgcolor="#FFFFCC"><span class="style8">1403</span><br />
1402-1403</td>
      <td width="101" bgcolor="#FFFFCC"><span class="style8">1402</span><br />
        1401-1402</td>
      <td width="99" bgcolor="#FFFFCC"><span class="style8">1401</span><br />
        1400-1401</td>
      <td width="96" bgcolor="#FFFFCC"><span class="style8">1400</span><br />
        1399-1400</td>
      <td width="94" bgcolor="#FFFFCC"><span class="style8">1399</span><br />
        1398-1399</td>
      <td height="40" bgcolor="#FFFFCC"><span class="style8">1398</span><br />
        1397-1398</td>
      </tr>
   <tr>
     <td bgcolor="#CCCCCC"><?php
	 $valeu = bah_agri_count($bah_cod_m,$num_bah,'Agri1404_1405') ;
      if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1404_1405" />
         <input type="hidden" name="z_sal" value="1404_1405" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
	 $valeu = bah_agri_count($bah_cod_m,$num_bah,'Agri1403_1404') ;
      if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1403_1404" />
         <input type="hidden" name="z_sal" value="1403_1404" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
	 $valeu = bah_agri_count($bah_cod_m,$num_bah,'Agri1402_1403') ;
      if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1402_1403" />
         <input type="hidden" name="z_sal" value="1402_1403" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
	 $valeu = bah_agri_count($bah_cod_m,$num_bah,'Agri1401_1402') ;
      if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1401_1402" />
         <input type="hidden" name="z_sal" value="1401_1402" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
	 $valeu = bah_agri_count($bah_cod_m,$num_bah,'Agri1400_1401') ;
      if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1400_1401" />
         <input type="hidden" name="z_sal" value="1400_1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
	 $valeu = bah_agri_count($bah_cod_m,$num_bah,'Agri1399_1400') ;
      if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1399_1400" />
         <input type="hidden" name="z_sal" value="1399_1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td height="49" bgcolor="#CCCCCC"><?php
	 $valeu = bah_agri_count($bah_cod_m,$num_bah,'Agri1398_1399') ;
      if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1398_1399" />
         <input type="hidden" name="z_sal" value="1399-1398" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td width="94" bgcolor="#CCCCCC" class="style8"><?php 	 $valeu = bah_agri_count($bah_cod_m,$num_bah,'Agri1397_1398') ;
      if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1397_1398" />
         <input type="hidden" name="z_sal" value="1398-1397" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td width="82" bgcolor="#CCCCCC" class="style8"><div style="margin-right:30px" align="right" >زراعی</div></td>
     <td width="48" bgcolor="#FFFFFF" class="style8"><img src="../files/zera.png" width="37" height="40"  alt=""/></td>
     </tr>
   <tr>
     <td><?php
     $valeu = bah_vege_count($bah_cod_m,$num_bah,'1404-1405') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1404-1405" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td><?php
     $valeu = bah_vege_count($bah_cod_m,$num_bah,'1403-1404') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1403-1404" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php } ?></td>
     <td><?php
     $valeu = bah_vege_count($bah_cod_m,$num_bah,'1402-1403') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1402-1403" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php } ?></td>
     <td><?php
     $valeu = bah_vege_count($bah_cod_m,$num_bah,'1401-1402') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401-1402" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php } ?></td>
     <td><?php
     $valeu = bah_vege_count($bah_cod_m,$num_bah,'1400-1401') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400-1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td><?php
     $valeu = bah_vege_count($bah_cod_m,$num_bah,'1399-1400') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1399-1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td height="49"><?php
     $valeu = bah_vege_count($bah_cod_m,$num_bah,'1398-1399') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1398-1399" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td class="style8"><?php
     $valeu = bah_vege_count($bah_cod_m,$num_bah,'1397-1398') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1397-1398" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td bgcolor="#FFFFFF" class="style8"><div style="margin-right:30px" align="right" >صیفی</div></td>
     <td bgcolor="#FFFFFF" class="style8"><img src="../files/Vege.png" width="37" height="40"  alt=""/></td>
     </tr>
   <tr>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_garden_count($bah_cod_m,$num_bah,'1405') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1405" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_garden_count($bah_cod_m,$num_bah,'1404') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1404" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
         </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_garden_count($bah_cod_m,$num_bah,'1403') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1403" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
         </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_garden_count($bah_cod_m,$num_bah,'1402') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1402" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
         </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_garden_count($bah_cod_m,$num_bah,'1401') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_garden_count($bah_cod_m,$num_bah,'1400') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php } ?></td>
     <td height="50" bgcolor="#CCCCCC"><?php
     $valeu = bah_garden_count($bah_cod_m,$num_bah,'1399') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1399" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php } ?></td>
     <td height="50" bgcolor="#CCCCCC"><?php
     $valeu = bah_garden_count($bah_cod_m,$num_bah,'1398') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1398" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC" class="style8"><div style="margin-right:30px" align="right" >باغی</div></td>
     <td bgcolor="#FFFFFF" class="style8"><img src="../files/tree.png" width="37" height="40"  alt=""/></td>
     </tr>
   <tr>
     <td><?php
     $valeu = bah_Mushroom_count($bah_cod_m,$num_bah,'1405') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1405" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td><?php
     $valeu = bah_Mushroom_count($bah_cod_m,$num_bah,'1404') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1404" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php }?></td>
     <td><?php
     $valeu = bah_Mushroom_count($bah_cod_m,$num_bah,'1403') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1403" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php }?></td>
     <td><?php
     $valeu = bah_Mushroom_count($bah_cod_m,$num_bah,'1402') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1402" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php }?></td>
     <td><?php
     $valeu = bah_Mushroom_count($bah_cod_m,$num_bah,'1401') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td><?php
     $valeu = bah_Mushroom_count($bah_cod_m,$num_bah,'1400') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td height="50"><?php
     $valeu = bah_Mushroom_count($bah_cod_m,$num_bah,'1399') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1399" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td class="style8"><?php
     $valeu = bah_Mushroom_count($bah_cod_m,$num_bah,'1398') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1398" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td class="style8"><div style="margin-right:30px" align="right" >قارچ</div></td>
     <td bgcolor="#FFFFFF" class="style8"><img src="../files/mushprod.jpg" width="37" height="40"  alt=""/></td>
     </tr>
   <tr>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_Greenhous_count($bah_cod_m,$num_bah,'1405') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1405" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_Greenhous_count($bah_cod_m,$num_bah,'1404') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1404" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
         </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_Greenhous_count($bah_cod_m,$num_bah,'1403') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1403" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
         </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_Greenhous_count($bah_cod_m,$num_bah,'1402') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1402" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
         </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_Greenhous_count($bah_cod_m,$num_bah,'1401') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_Greenhous_count($bah_cod_m,$num_bah,'1400') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td height="50" bgcolor="#CCCCCC"><?php
     $valeu = bah_Greenhous_count($bah_cod_m,$num_bah,'1399') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1399" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td height="50" bgcolor="#CCCCCC"><?php
     $valeu = bah_Greenhous_count($bah_cod_m,$num_bah,'1398') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1398" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC" class="style8"><div style="margin-right:30px" align="right" >گلخانه </div></td>
     <td bgcolor="#FFFFFF" class="style8"><img src="../files/greenhous.png" width="37" height="40"  alt=""/></td>
     </tr>
   <tr>
     <td><?php
     $valeu = bah_Aquatic_count($bah_cod_m,$num_bah,'1405') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1405" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td><?php
     $valeu = bah_Aquatic_count($bah_cod_m,$num_bah,'1404') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1404" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
         </form>
       <?php }?></td>
     <td><?php
     $valeu = bah_Aquatic_count($bah_cod_m,$num_bah,'1403') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1403" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
         </form>
       <?php }?></td>
     <td><?php
     $valeu = bah_Aquatic_count($bah_cod_m,$num_bah,'1402') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1402" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
         </form>
       <?php }?></td>
     <td><?php
     $valeu = bah_Aquatic_count($bah_cod_m,$num_bah,'1401') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td><?php
     $valeu = bah_Aquatic_count($bah_cod_m,$num_bah,'1400') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td height="50"><?php
     $valeu = bah_Aquatic_count($bah_cod_m,$num_bah,'1399') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1399" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td height="50"><?php
     $valeu = bah_Aquatic_count($bah_cod_m,$num_bah,'1398') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1398" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td bgcolor="#FFFFFF" class="style8"><div style="margin-right:30px" align="right" >آبزی پروری</div></td>
     <td bgcolor="#FFFFFF" class="style8"><img src="../files/fish1.png" width="45" height="40"  alt=""/></td>
     </tr>
   <tr>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_bee_count($bah_cod_m,$num_bah,'1405') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_bee_count($bah_cod_m,$num_bah,'1404') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_bee_count($bah_cod_m,$num_bah,'1403') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_bee_count($bah_cod_m,$num_bah,'1402') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_bee_count($bah_cod_m,$num_bah,'1401') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = bah_bee_count($bah_cod_m,$num_bah,'1400') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td height="50" bgcolor="#CCCCCC"><?php
     $valeu = bah_bee_count($bah_cod_m,$num_bah,'1399') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1399" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td height="50" bgcolor="#CCCCCC"><?php
     $valeu = bah_bee_count($bah_cod_m,$num_bah,'1398') ;
	 if($valeu== 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1398" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC" class="style8"><div style="margin-right:30px" align="right" >زنبورستان</div></td>
     <td bgcolor="#FFFFFF" class="style8"><img src="../files/bee.png" width="37" height="40"  alt=""/></td>
     </tr>
 </table>
 <p>
   <?php
 }
 else 
 {
echo '<p class=style8> بهره برداری با مشخصات وارد شده یافت نشد</p>'  ;
 }
 }
?>
 </p>
 <p><a href="benef.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p> 
  </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert']) ;?>