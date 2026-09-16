<?php
include("../../lock_p1.php");
include('../../event.php') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
</style>
  <script type='text/javascript' src='../../15_files/jquery-1.9.0.min.js'></script>
  <script type='text/javascript' src='../../15_files/jquery.msgBox.js'></script>
  <link rel="stylesheet" href="../../15_files/msgBoxLight.css" />

<script type="text/javascript">
function delete_confirm(){
if ($('input[name="checked_id[]"]:checked').length == 0) {
		msgBoxImagePath = "../../15_files/";
	showMsgBox() ; 
		function showMsgBox(title,content,type) {
			$.msgBox({
				title: "خطا",
				content: " حداقل باید یک قطعه انتخاب شود .",
				type: "info" ,
				showButtons: true,
                opacity: 0.7,
                autoClose:true
				});
		}
	return false;
	 }
else 
{
	var result = confirm(" از آماده سازی قطعه / قطعات انتخاب شده برای سال  96 مطمئن هستید ؟");
	if(result){
		return true;
	}else{
		return false;
	}
}
}
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
	$('.checkbox').on('click',function(){
		if($('.checkbox:checked').length == $('.checkbox').length){
			$('#select_all').prop('checked',true);
		}else{
			$('#select_all').prop('checked',false);
		}
	});
});
</script>
<head>
<title><?php echo $title ;?></title>
</head>
<body>
 <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
          <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
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
 $bah_cod_m=$_POST['bah_cod_m'];
  ?>
<p align="center" >&nbsp;</p>
<p align="center" dir="rtl" ><span class="style8">آماده سازی اطلاعات  پایه ، سال  96 </span></p>
<p align="center" dir="rtl" ><span class="RightMenuCell"><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></span></p>
 <form id="form1" name="form1" method="post" action="#result">
   <p>
     <input type="text" name="bah_cod_m" id="bah_cod_m" style="width:200px ; height:40px ; color:#900 ; font-size:14px" value="<?php echo $bah_cod_m?>" />
     :کد ملی بهره بردار/ مدیر عامل<br />
     <br />
     <a href="http://10.7.234.126/login/help/New_Garden.pdf" target="new" class="LinkTitleNews"> راهنمای استفاده </a><img src="../../files/con_info.png" width="16" height="16"  alt=""/>   </p>
  <p>
    <input type="submit" name="action" id="action" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
   </p>
 </form>
  <p>
    <?php
 if (isset($_POST['action'])) 
 {  
$query = "SELECT num_bah,id,mor_cod_m,no_mal,bah_cod_m,add_abadi,add_city,sh_gat,z_sal,no_kesh,m_zamin,id_ostan,id_city,t_mah,check_cod from Garden where  bah_cod_m = :bah_cod_m and z_sal= :z_sal and mor_cod_m = :mor_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':z_sal'=>'1395',':mor_cod_m'=>$login_session));
$found = $stmt -> rowCount();
if ($found>0) {
?>
    <span class="style21"><a name="result" id="result"></a></span>  </p>
 <form name="bulk_action_form" action="send_data101.php" method="post" onSubmit="return delete_confirm();"/>
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td width="10%" rowspan="2" bgcolor="#006699">مساحت زمین<br />
          مترمربع</td>
          <td width="9%" rowspan="2" bgcolor="#006699">نوع کشت</td>
          <td width="13%" rowspan="2" bgcolor="#006699">نوع مالکیت</td>
          <td width="6%" rowspan="2" bgcolor="#006699">شماره قطعه</td>
          <td width="6%" rowspan="2" bgcolor="#006699">سال </td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="2" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
          <td width="9%" rowspan="2" bgcolor="#006699">انتخاب قطعه<br />            <input type="checkbox" name="select_all" id="select_all" value=""/></td>
        </tr>
        <tr class="text1">
          <td width="9%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="13%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="11%" bgcolor="#006699">شهر/آبادی</td>
          <td width="9%" bgcolor="#006699">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
if ($row['no_mal']=='1') $v_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $v_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $v_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $v_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $v_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $v_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $v_no_mal='اجاره' ;	 
if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 
  ?>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mal ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_gat']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_sal']; ?></td>
          <td height="108" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['num_bah'])?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $row['id']; ?>"/></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
      </table>
      
  <p>
    <?php
?>
        <input type="hidden" name="mor_cod_m" value="<?php echo  $login_session ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo  $bah_cod_m ;?>" />
        <input type="submit" name="Go_send_data" id="send_data" style="height:45px ; width:350px" value="مایل به ایجاد اطلاعات فوق در سال  96 هستم" />
      </form>
<?php
 }
 else 
 {
echo '<p class=style8> بهره برداری با مشخصات وارد شده یافت نشد</p>'  ;
 }
 }
?>
  <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p> 
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