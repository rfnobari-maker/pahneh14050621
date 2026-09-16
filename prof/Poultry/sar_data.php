<?php
function sar_data($bah_cod_m)
{
//include('../../event.php');
//require_once('../ersal_p.php');
include('../../login/config.php');
$query = "SELECT * from bah where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_s= $row['city_s'] ; 
$mor_cod_m = $row['mor_cod_m'] ; 
$no_bah = $row['no_bah']; 
$bah_cod_m = $row['bah_cod_m']; 
$bah_jens= $row['jens']; 
$bah_name = $row['name']; 
$last_name = $row['last_name']; 
$date_t  = $row['date_t']; 
$sh_sh   = $row['sh_sh']; 
$m_sod   = $row['m_sod']; 
$fname   = $row['fname']; 
$m_tah   = $row['m_tah']; 
$er_mtah = $row['er_mtah'];
$tel_s   = $row['tel_s']; 
$tel_m  = $row['tel_m']; 
$ostan_s  = $row['ostan_s'] ;
$shahr_s  = $row['shahr_s'] ;
$city_s   =  $row['city_s'] ;
$rosta_s  = $row['rosta_s'] ;
$co_name  = $row['co_name'] ;
$no_co  = $row['no_co'] ;
$sh_meli  = $row['sh_meli'] ;
$co_sabt  = $row['co_sabt'] ;
$add_city = $row['add_city'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$id_mar = $row['id_mar'] ;
$add_abadi = $row['add_abadi'] ;

?> 
	    
 <table style="border:3px solid #069;" width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
 <?php  if ($no_bah=='1') { ?>
  <td height="38" colspan="5" align="right" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقیقی</strong></div></td>
   </tr>
   <tr>
     <td width="370" height="30"><div align="right">
       <?php echo city_name($id_city) ?>
     </div></td>
     <td width="152"><div align="right">:شهرستان</div></td>
     <td>&nbsp;</td>
     <td width="207"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td width="172"><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right">
<?php echo abadi_name($add_abadi); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
<?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
     </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $last_name ; ?></div></td>
     <td><div align="right">:نام خانوادگی</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $bah_name ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: نام</div></td>
     </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $sh_sh ; ?></div></td>
     <td><div align="right">:شماره شناسنامه</div></td>
     <td width="91">&nbsp;</td>
     <td><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:کد ملی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td width="91">&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
   <tr>
 <?php }  if ($no_bah=='2') { ?>
     <p class="one" >&nbsp;</p>
     <td height="38" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>مشخصات بهره بردار حقوقی</strong></div></td>
   </tr>
   <tr>
     <td width="370" height="30"><div align="right"> <?php echo city_name($id_city) ?> </div></td>
     <td width="152"><div align="right">:شهرستان</div></td>
     <td>&nbsp;</td>
     <td width="207"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"> <?php echo abadi_name($add_abadi); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $bah_cod_m ; ?></div></td>
     <td><div align="right">:کدملی مدیر عامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $co_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام شرکت</div></td>
   </tr>
   <tr>
     <td height="30" bgcolor="#FFFFFF"><div align="right"><?php echo $last_name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div align="right">: نام خانوادگی مدیرعامل</div></td>
     <td bgcolor="#FFFFFF">&nbsp;</td>
     <td bgcolor="#FFFFFF"><div align="right"><?php echo $name ; ?></div></td>
     <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام مدیرعامل</div></td>
   </tr>
   <tr>
     <td height="30"><div align="right"><?php echo $tel_m ; ?></div></td>
     <td><div align="right">:شماره همراه</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><?php echo $tel_s ; ?></div></td>
     <td><div style="margin-right:30px" align="right" >:شماره تلفن ثابت</div></td>
   </tr>
    <?php  }?>
 </table>
<?php } ?>