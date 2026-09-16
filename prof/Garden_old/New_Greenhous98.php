<?php
include("../../lock_p1.php");
include('../../event.php') ;
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
	var result = confirm(" از آماده سازی اطلاعات گلخانه های انتخاب شده برای سال 1398 مطمئن هستید ؟");
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
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
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
<p align="center" dir="rtl" ><span class="style8">آماده سازی اطلاعات  پایه گلخانه سال 1398</span><br />
  <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
</p>
 <form id="form1" name="form1" method="post" action="#result">
   <p>
     <input type="text" name="bah_cod_m" id="bah_cod_m" style="width:200px ; height:40px ; color:#900 ; font-size:14px" value="<?php echo $bah_cod_m?>" />
     :کد ملی بهره بردار/ مدیر عامل<br />
     <br />
     <a href="http://10.7.234.126/login/help/New_Agri.pdf" target="new" class="LinkTitleNews"> راهنمای استفاده </a><img src="../../files/con_info.png" width="16" height="16"  alt=""/>   </p>
  <p>
    <input type="submit" name="action" id="action" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
   </p>
 </form>
  <p>
    <?php
 if (isset($_POST['action'])) 
 {  
$query = "SELECT * from Greenhous where  bah_cod_m = :bah_cod_m and sal= :sal and mor_cod_m = :mor_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':sal'=>'1397',':mor_cod_m'=>$login_session));
$found = $stmt -> rowCount();
if ($found>0) {
?>
    <span class="style21"><a name="result" id="result"></a></span>  </p>
 <form name="bulk_action_form" action="Greenhous_send_data98.php" method="post" onSubmit="return delete_confirm();"/>
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td width="8%" rowspan="2" bgcolor="#006699">مساحت فضای باز<br />
            <span class="style2">مترمربع</span></td>
          <td width="8%" rowspan="2" bgcolor="#006699">مساحت گلخانه<br />
            <span class="style2">مترمربع</span></td>
          <td width="7%" rowspan="2" bgcolor="#006699">نوع گلخانه</td>
          <td width="11%" rowspan="2" bgcolor="#006699">نوع سازه</td>
          <td width="7%" rowspan="2" bgcolor="#006699">سیستم کشت</td>
          <td width="9%" rowspan="2" bgcolor="#006699">نوع و کلاس محصول تولیدی</td>
          <td width="6%" rowspan="2" bgcolor="#006699">سال</td>
          <td height="35" colspan="2" bgcolor="#006699">مشخصات بهره بردار</td>
          <td colspan="2" bgcolor="#006699">موقعیت بهره برداری</td>
          <td width="4%" rowspan="2" bgcolor="#006699">ردیف</td>
          <td width="4%" rowspan="2" bgcolor="#006699">انتخاب قطعه<br />            <input type="checkbox" name="select_all" id="select_all" value=""/></td>
        </tr>
        <tr class="text1">
          <td width="9%" height="31" bgcolor="#006699">کد ملی </td>
          <td width="10%" bgcolor="#006699">نام و نام خانوادگی</td>
          <td width="9%" bgcolor="#006699">شهر/آبادی</td>
          <td width="8%" bgcolor="#006699">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
if ($row['no_mtol']=='1') $v_no_mtol='سبزی و صیفی' ;	 
if ($row['no_mtol']=='2') $v_no_mtol='گل و گیاه زینتی در فضای گلخانه' ;	 
if ($row['no_mtol']=='4') $v_no_mtol='گل و گیاه زینتی در فضای باز' ;	 
if ($row['no_mtol']=='5') $v_no_mtol='گل و گیاه زینتی در فضای توام' ;	 
if ($row['no_mtol']=='3') $v_no_mtol='سایر' ;	 
	 
if ($row['no_saz']=='1') $v_no_saz='فلزی با پوشش پلاستیکی' ;	 
if ($row['no_saz']=='2') $v_no_saz='فلزی با پوشش پلی کربنات' ;	
if ($row['no_saz']=='3') $v_no_saz='فلزی با پوشش شیشه ای' ;	
if ($row['no_saz']=='4') $v_no_saz='چوبی پلاستیکی' ;	 

if ($row['no_gol']=='1') $v_no_gol='تونلی تک قلو' ;	 
if ($row['no_gol']=='2') $v_no_gol='تونلی به هم پیوسته' ;	
if ($row['no_gol']=='3') $v_no_gol='یک طرفه' ;	
if ($row['no_gol']=='4') $v_no_gol='شیشه ای سقف شیروانی' ;	 

if ($row['sys_kesh']=='1') $v_sys_kesh='خاکی' ;	 
if ($row['sys_kesh']=='2') $v_sys_kesh='هیدروپونیک' ;	 
  ?>
 <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin_baz']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_gol?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_saz ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_sys_kesh  ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_mtol ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal'] ?></td>
          <td height="81" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
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
        <input type="submit" name="Go_send_data" id="send_data" style="height:45px ; width:350px" value="مایل به ایجاد اطلاعات فوق در سال 1398 هستم" />
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