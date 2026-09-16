<?php
require_once("../lock_cp.php");
require_once("../event.php");
require_once('side_menu1.php');
if(isset($_POST['add_abadi']))  $add_abadi=$_POST['add_abadi'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
 <script src="../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
<style>
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

</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
<p align="center" > سوابق آبادی <br />
  <img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<form  id="reg-form" method="post" action="#1">
<div style="width: 400px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
               <table width="100%" height="140" border='0' align="center" cellpadding='0' cellspacing='0'>
               <tr bgcolor='#f1f1f1' >
                 <td height="22" colspan='2' align='center' bgcolor="#FFFFFF">&nbsp;</td>
               </tr>
               <tr bgcolor='#f1f1f1' >
                 <td width="198" height="58" align="right" class="input_text" >
                 <input type="text" name="add_abadi" id="add_abadi"  value="<?php echo $add_abadi?>" style="width:150px ; height:40px ; color:#900 ; font-size:14px" /></td>
                 <td width="202"  align='center' class="style8"> : آدرس آماری آبادی</td>
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
    include_once('../login/config.php');

$query = "SELECT ostan,add_abadi,mor_cod_m,id_mar,abadi,deh,city,mar from list_abadi where  add_abadi = :add_abadi "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi ));
$found = $stmt -> rowCount();
if ($found>0) {
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $add_abadi = $row['add_abadi'] ;
?>
  <table style="border:3px solid #069;" width="90%" border="1" align="center" cellpadding="1" cellspacing="0">
    <tr>
     <td height="38" colspan="8" align="right" bgcolor="#CCCCCC"><?php if (isset($_POST['add_abadi'])) 
 
$id_abadi = substr($add_abadi,13,6) ; 
$ostan= $row['ostan'] ; 
$city= $row['city'] ; 
$deh= $row['deh'] ; 
$abadi= $row['abadi'] ; 
$add_abadi= $row['add_abadi'] ; 
$mor_cod_m= $row['mor_cod_m'] ; 
$id_mar= $row['id_mar'] ; 
$mar= $row['mar'] ; 
?>
       <table style="border:1px solid #069;" width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
         <tr>
           <td height="38" colspan="2" bgcolor="#999999"><span class="text1">مشخصات کارشناس  </span></td>
           <td colspan="2" bgcolor="#999999"><span class="text1">مشخصات مرکز </span></td>
           <td width="18%" rowspan="2" bgcolor="#999999" class="text1">آبادی</td>
           <td width="18%" rowspan="2" bgcolor="#999999" class="text1">دهستان</td>
           <td width="14%" rowspan="2" bgcolor="#999999"><span class="text1">شهرستان</span></td>
           <td width="14%" rowspan="2" bgcolor="#999999"><span class="text1">استان</span></td>
         </tr>
         <tr>
           <td height="35" bgcolor="#999999"><span class="text1">کد ملی </span></td>
           <td width="22%" bgcolor="#999999"><span class="text1">نام و نام خانوادگی</span></td>
           <td width="9%" bgcolor="#999999"><span class="text1">کد مرکز</span></td>
           <td width="15%" bgcolor="#999999"><span class="text1">نام مرکز</span></td>
         </tr>
         <tr>
           <td width="22%" height="48"><?php echo $mor_cod_m?></td>
           <td><?php echo user_name1($mor_cod_m) ?></td>
           <td><?php echo $id_mar ?></td>
           <td><?php echo $mar ?></td>
           <td><?php echo $abadi ?><br /></td>
           <td><?php echo $deh ?></td>
           <td><?php echo $city ?></td>
           <td><?php echo $ostan ?></td>
         </tr>
       </table></td>
   </tr>
    <tr>
      <td height="32" colspan="6" bgcolor="#FFFFCC" class="style8"><?php
	 $valeu = Abadi_tbah_count($add_abadi) ;
	  if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
        <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
          <input type="hidden" name="add_abadi2" value="<?php echo $add_abadi ;?>" />
          <input type="hidden" name="num_bah2" value="<?php echo $num_bah ;?>" />
          <input type="hidden" name="table2" value="Agri1395_1396" />
          <input type="hidden" name="z_sal2" value="1396-1395" />
          <input type="hidden" name="action2" value="1" />
          <button ><?php echo $valeu ;?></button>
        </form>
        <?php }?></td>
      <td colspan="2" bgcolor="#FFFFCC">تعداد بهره بردار </td>
    </tr>
    <tr>
      <td height="32" colspan="6" bgcolor="#FFFFCC" class="style8">تعداد واحد ثبت شده در سال</td>
      <td colspan="2" rowspan="2" bgcolor="#FFFFCC">نوع بهره برداری </td>
      </tr>
    <tr>
      <td width="116" bgcolor="#FFFFCC"><span class="style8">1403</span><br />
        1402-1403</td>
      <td width="114" bgcolor="#FFFFCC"><span class="style8">1402</span><br />
        1401-1402</td>
      <td width="104" bgcolor="#FFFFCC"><span class="style8">1401</span><br />
        1400-1401</td>
      <td width="111" bgcolor="#FFFFCC"><span class="style8">1400</span><br />
        1399-1400</td>
      <td width="118" bgcolor="#FFFFCC"><span class="style8">1399</span><br />
        1398-1399</td>
      <td height="40" bgcolor="#FFFFCC"><span class="style8">1398</span><br />
        1397-1398</td>
      </tr>
   <tr>
     <td bgcolor="#CCCCCC"><?php
	 $valeu = Abadi_agri_count($add_abadi,'Agri1402_1403') ;
      if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1400_1401" />
         <input type="hidden" name="z_sal" value="1400_1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
	 $valeu = Abadi_agri_count($add_abadi,'Agri1401_1402') ;
      if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1399_1400" />
         <input type="hidden" name="z_sal" value="1399_1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
	 $valeu = Abadi_agri_count($add_abadi,'Agri1400_1401') ;
      if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1400_1401" />
         <input type="hidden" name="z_sal" value="1400_1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
	 $valeu = Abadi_agri_count($add_abadi,'Agri1399_1400') ;
      if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1399_1400" />
         <input type="hidden" name="z_sal" value="1399_1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td height="49" bgcolor="#CCCCCC"><?php
	 $valeu = Abadi_agri_count($add_abadi,'Agri1398_1399') ;
      if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1398_1399" />
         <input type="hidden" name="z_sal" value="1399-1398" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td width="101" bgcolor="#CCCCCC" class="style8"><?php 	 $valeu = Abadi_agri_count($add_abadi,'Agri1397_1398') ;
      if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Agri.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="table" value="Agri1397_1398" />
         <input type="hidden" name="z_sal" value="1398-1397" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td width="90" bgcolor="#CCCCCC" class="style8"><div style="margin-right:30px" align="right" >زراعی</div></td>
     <td width="59" bgcolor="#FFFFFF" class="style8"><img src="../files/zera.png" width="37" height="40"  alt=""/></td>
     </tr>
   <tr>
     <td><?php
     $valeu = Abadi_vege_count($add_abadi,'1402-1403') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400-1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td><?php
     $valeu = Abadi_vege_count($add_abadi,'1401-1402') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1399-1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td><?php
     $valeu = Abadi_vege_count($add_abadi,'1400-1401') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400-1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php } ?></td>
     <td><?php
     $valeu = Abadi_vege_count($add_abadi,'1399-1400') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1399-1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td height="49"><?php
     $valeu = Abadi_vege_count($add_abadi,'1398-1399') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1398-1399" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td class="style8"><?php
     $valeu = Abadi_vege_count($add_abadi,'1397-1398') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Agri/bah_liste_Vege.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
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
     $valeu = Abadi_garden_count($add_abadi,'1403') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = Abadi_garden_count($add_abadi,'1402') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = Abadi_garden_count($add_abadi,'1401') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
         </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = Abadi_garden_count($add_abadi,'1400') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php } ?></td>
     <td height="50" bgcolor="#CCCCCC"><?php
     $valeu = Abadi_garden_count($add_abadi,'1399') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1399" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php } ?></td>
     <td height="50" bgcolor="#CCCCCC"><?php
     $valeu = Abadi_garden_count($add_abadi,'1398') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Garden.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
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
     $valeu = Abadi_Mushroom_count($add_abadi,'1403') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td><?php
     $valeu = Abadi_Mushroom_count($add_abadi,'1402') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td><?php
     $valeu = Abadi_Mushroom_count($add_abadi,'1401') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php }?></td>
     <td><?php
     $valeu = Abadi_Mushroom_count($add_abadi,'1400') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td height="50"><?php
     $valeu = Abadi_Mushroom_count($add_abadi,'1399') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1399" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php }?></td>
     <td class="style8"><?php
     $valeu = Abadi_Mushroom_count($add_abadi,'1398') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Mushroom.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
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
     $valeu = Abadi_Greenhous_count($add_abadi,'1403') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = Abadi_Greenhous_count($add_abadi,'1402') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = Abadi_Greenhous_count($add_abadi,'1401') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
         </form>
       <?php }?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = Abadi_Greenhous_count($add_abadi,'1400') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td height="50" bgcolor="#CCCCCC"><?php
     $valeu = Abadi_Greenhous_count($add_abadi,'1399') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="y_prod" value="1399" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td height="50" bgcolor="#CCCCCC"><?php
     $valeu = Abadi_Greenhous_count($add_abadi,'1398') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Garden/bah_liste_Greenhous.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
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
     $valeu = Abadi_Aquatic_count($add_abadi,'1403') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td><?php
     $valeu = Abadi_Aquatic_count($add_abadi,'1402') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td><?php
     $valeu = Abadi_Aquatic_count($add_abadi,'1401') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
         </form>
       <?php }?></td>
     <td><?php
     $valeu = Abadi_Aquatic_count($add_abadi,'1400') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td height="50"><?php
     $valeu = Abadi_Aquatic_count($add_abadi,'1399') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1399" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu;?></button>
       </form>
       <?php }?></td>
     <td height="50"><?php
     $valeu = Abadi_Aquatic_count($add_abadi,'1398') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Aquatic/bah_liste_Aquatic.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
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
     $valeu = Abadi_bee_count($add_abadi,'1403') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = Abadi_bee_count($add_abadi,'1402') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = Abadi_bee_count($add_abadi,'1401') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1401" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
         </form>
       <?php } ?></td>
     <td bgcolor="#CCCCCC"><?php
     $valeu = Abadi_bee_count($add_abadi,'1400') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1400" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td height="50" bgcolor="#CCCCCC"><?php
     $valeu = Abadi_bee_count($add_abadi,'1399') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
         <input type="hidden" name="num_bah" value="<?php echo $num_bah ;?>" />
         <input type="hidden" name="z_sal" value="1399" />
         <input type="hidden" name="action" value="1" />
         <button ><?php echo $valeu ;?></button>
       </form>
       <?php } ?></td>
     <td height="50" bgcolor="#CCCCCC"><?php
     $valeu = Abadi_bee_count($add_abadi,'1398') ;
	 if($valeu>= 0) { 	 echo $valeu ;  } else {  ?>
       <form  action="Poultry/bah_liste_bee.php" method="post" onsubmit="target_popup3(this)">
         <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ;?>" />
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
echo '<p class=style8> آبادی مورد نظر یافت نشد</p>'  ;
 }
 }
?>
 </p>

    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../files/bottom.gif">
      <?php include('../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>