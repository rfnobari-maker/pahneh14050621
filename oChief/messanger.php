<?php 
include('../lock_oce.php');
include('counter.php');
include('../event.php');
$ru_read = isset($_POST['ru_read']) ? $_POST['ru_read'] : (isset($_GET['ru_read']) ? $_GET['ru_read'] : '');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <style>
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
#menu {
font-family: Tahoma;
    font-size: 13px;
    list-style: none;
    direction: rtl;
    width: 500px;
    line-height: 40px;
    background: #069;
    margin: 0 auto; /* برای مرکز کردن منو */
    border: 1px solid #990000;
    border-radius: 10px;
    display: flex;
    justify-content: space-between; /* فاصله برابر بین آیتم‌ها */
    padding: 0 20px; /* برای ایجاد کمی فاصله از طرفین */}

#menu li {
    display: inline-block; /* برای نمایش آیتم‌های لیست به صورت افقی */
    padding-left: 10px;
    padding-right: 10px;
}

#menu li:hover {
    background: #903;
    line-height: 40px;
    border-radius: 10px;
}

#menu li a {
    text-decoration: none;
    color: #FFF;
}

#img1 {
    border-radius: 40px;
}
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
.my-table {
  border-collapse: separate; /* استفاده از separate به جای collapse */
  border-spacing: 0; /* حذف فاصله بین سلول‌ها */
  width: 90%;
  border: 1px solid #ddd;
  border-radius: 10px; /* اعمال border-radius به جدول */
}

.my-table th,
.my-table td {
  padding: 10px;
  border: 1px solid #ddd;
}

.my-table thead th {
  background-color: #f4f4f4;
}

.my-table tbody tr:first-child td:first-child {
  border-top-left-radius: 10px; /* گرد کردن گوشه بالا چپ */
}

.my-table tbody tr:first-child td:last-child {
  border-top-right-radius: 10px; /* گرد کردن گوشه بالا راست */
}

.my-table tbody tr:last-child td:first-child {
  border-bottom-left-radius: 10px; /* گرد کردن گوشه پایین چپ */
}

.my-table tbody tr:last-child td:last-child {
  border-bottom-right-radius: 10px; /* گرد کردن گوشه پایین راست */
}
.rotated-text {
    transform: rotate(-45deg);
    display: inline-block; /* اطمینان از رفتار مناسب چرخش */
	font-size: 12px ; 
	color:#930 ;
}

</style>
<script type="text/javascript" src="../assets/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
function delete_confirm(){
	var result = confirm("آیا از حذف پیام های انتخابی مطمئن هستید ؟");
	if(result){
		return true;
	}else{
		return false;
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
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
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
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
    <ul id="menu">
      <li><a href="send_group_pm.php">ارسال پیام گروهی</a></li>
      <li><a href="search_promo.php">ارسال پیام جدید</a></li>
      <li><a href="sent_message.php">پیام های ارسالی</a></li>
      <li><a href="messanger.php">پیام های دریافتی</a></li>
    </ul>
<p style="padding-top:15px"><span class="style8">لیست پیام های دریافتی </span> </p>
<p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<form name="ru_read" action="messanger.php?id=1" method="post">
  <table  width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="203"><input type="radio" name="ru_read" value="1" id="12" <?php if ($ru_read == '1') echo "checked='checked'" ?> onchange="this.form.submit()" />
مشاهده نشده</td>
      <td width="203"><label>
        <input type="radio" name="ru_read" value="2" id="1" <?php if ($ru_read != '1' and  $ru_read != '') echo "checked='checked'" ?> onchange="this.form.submit()" />
        مشاهده شده</label></td>
      <td width="141"><input type="radio" name="ru_read" value="" id="0" <?php if ($ru_read == '') echo "checked='checked'" ?> onchange="this.form.submit()" />
کلیه پیام ها</td>
    </tr>
  </table>
</form>
<?php 
$start=0;
$limit=25;

$id = isset($_GET['id']) ? $_GET['id'] : 1;
$start=($id-1)*$limit;
 if ($ru_read == '')   $v_ru_read  =  " (del != 'T' OR del IS NULL)"  ;
 if ($ru_read == '1')  $v_ru_read  = "ru_read  = 1 " ;
 if ($ru_read == '2')  $v_ru_read  = "ru_read != 1 and del !='T' " ;

$query = "SELECT r_date,del_date,s_user,id,s_time,title,s_date,ru_read,file FROM  pm WHERE  r_user = '$login_session'  and $v_ru_read ORDER BY s_date DESC , s_time DESC  LIMIT $start, $limit" ;
$query1 = "SELECT count(*) FROM  pm WHERE  r_user = '$login_session' and $v_ru_read    "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
 <form name="bulk_action_form" action="message_del2.php" method="post" onSubmit="return delete_confirm();"/>
           <table class="my-table"   align="center"  >
             <tr align="center" class="text1">
    <th width="36" rowspan="2" bgcolor="#0099CC"><input type="checkbox" name="select_all" id="select_all" value=""/></th>
            <td width="55" rowspan="2" bgcolor="#0099CC">حذف</td>
            <td width="54" rowspan="2" bgcolor="#0099CC">مشاهده</td>
            <td width="94" rowspan="2" bgcolor="#0099CC">آخرین وضعیت</td>
    <td colspan="2" bgcolor="#0099CC">فرستنده</td>
    <td height="33" colspan="2" bgcolor="#0099CC">دریافت پیام </td>
    <td width="25%" rowspan="2" bgcolor="#0099CC">موضوع پیام </td>
    <td width="3%" rowspan="2" bgcolor="#0099CC">پیوست</td>
    <td width="5%" rowspan="2" bgcolor="#0099CC">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td width="16%" height="33" bgcolor="#0099CC">نام و نام خانوادگی</td>
    <td width="7%" bgcolor="#0099CC">تصویر</td>
    <td width="10%" bgcolor="#0099CC">ساعت </td>
    <td width="9%" bgcolor="#0099CC">تاریخ</td>
    </tr>
  <tr>
<?php
$r = $start+1 ;
            if($stmt -> rowCount() > 0){
 foreach($stmt as $row)
 {
	 if ($row['ru_read']=='1')  $v_message = 'مشاهده نشده' ; 
	 if ($row['ru_read']=='2')  $v_message = 'مشاهده '.'<br>'.$row['r_date'] ; 
	 if ($row['ru_read']=='3')  $v_message = 'ارسال پاسخ'.'<br>'.$row['r_date'] ;  ; 
	 if ($row['ru_read']=='5')  $v_message = 'انتقال'.'<br>'.$row['r_date'] ; 
  if (S_access($row['s_user'])=='1') $v_s_access = 'مروج کشاورزی';
  if (S_access($row['s_user'])=='2') $v_s_access = 'رئیس مرکز';
  if (S_access($row['s_user'])=='3') $v_s_access = 'مدیریت شهرستان';
  if (S_access($row['s_user'])=='4') $v_s_access = 'مدیریت سامانه';
  if (S_access($row['s_user'])=='5') $v_s_access = 'کارشناس معین استان';
  if (S_access($row['s_user'])=='6') $v_s_access = 'کارشناس موضوعی شهرستان';
  if (S_access($row['s_user'])=='7') $v_s_access = 'کارشناس محقق معین شهرستان';
  if (S_access($row['s_user'])=='20') $v_s_access = 'مدیریت کشوری';
  if (S_access($row['s_user'])=='98') $v_s_access = 'کارشناس ادمین استان';

?>
<tr>
            <td height="79" align="center"><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $row['id']; ?>"/></td>
<td width="8%" height="59" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <form></form><form  action="message_del.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
    <input type="hidden" name="s_user" value="<?php echo $row['s_user'] ;?>" />
    <button style="border-color:#FFF" onclick="return confirm('از حذف این پیام مطمئن هستید ؟ ')"><img src="../files/del1.png" border="0"  title="حذف پیام" width="33" height="31" /></button>
  </form></td>
<td width="8%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <form  action="sabt_view.php" method="post" >
    <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
    <input type="hidden" name="s_user" value="<?php echo $row['s_user'] ;?>" />
    <input type="hidden" name="ru_read" value="<?php echo $row['ru_read'] ;?>" />
  <button style="border-color:#FFF"><img src="../files/view.png" border="0"  title="مشاهده پیام" width="29" height="30" /></button>
    </form></td>
<td  class="style2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_message ;?></td>
<td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['s_user']);?><br />
  <span class="style2"><?php echo $v_s_access ;  ?><br />
  <?php echo user_mfa($row['s_user']);?>  <br />
  <?php echo user_tel($row['s_user']);?>  <br />
  </span></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <form  action="last_login.php" method="post" onsubmit="target_popup(this)">
      <input type="hidden" name="username" value="<?php echo $row['s_user'] ;?>" />
      <button style="border-color:#FFF"><img  id="img1" src="../files/users/<?php echo user_pic($row['s_user']) ?>?m="<?php @filemtime(user_pic($row['s_user'])) ?> width="42" height="46"  alt=""/></button>
      </form></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmall"><?php echo $row['s_time']?></td>
    <?php 
$pic = isset($row['pic']) ? $row['pic'] : '';
if ($pic == '') $pic = 'no_pic.png'

 ?>
   <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['s_date']?></td>
   <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['title'];?></td>
 <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if ($row['file'] <> '') { ?>
               <img src="../files/attachment.jpg" width="30" height="30" />
               <?php } else { ?>
               <span class="rotated-text">ندارد</span>
               <?php } ?>
            </td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
    </tr>
        <?php
		 $r++ ; 
} }else{ ?>
            <tr>
              <td colspan="11">پیامی موجود نیست </td></tr> 
        <?php } ?>
  </table>
<br />
<input type="submit" class="btn btn-danger" name="bulk_delete_submit" value="حذف پیام های انتخابی"/>
</form>
     <p>
</p>
<div style="height:20px"></div>
</div>
<?php 
if(isset($query1)) {
    $stmt1 = $dbh->prepare($query1);
    $stmt1->execute();
    $rows = $stmt1->fetchColumn();
    $total = ceil($rows/$limit);
    
    // تعیین محدوده صفحات برای نمایش
    $visible_pages = 3;
    $start_page = max(1, $id - $visible_pages);
    $end_page = min($total, $id + $visible_pages);
    
    $show_first = ($start_page > 1);
    $show_last = ($end_page < $total);
    ?>
    
    <div dir="rtl" class="pagination-container" style="margin-top:20px; text-align:center; height:auto; margin:auto; width:98%; overflow:auto; background-color:#ffffff; color:#06C; font-size:11px; padding:10px; border-radius:15px">
        <ul class="pagination" style="list-style-type:none; padding:0; margin:0; display:flex; justify-content:center; align-items:center; flex-wrap:wrap;">
            <?php if($id > 1): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <a href="messanger.php?id=<?php echo $id-1 ?>&ru_read=<?php echo htmlspecialchars($ru_read); ?>#1" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">&laquo; قبلی</a>
                </li>
            <?php endif; ?>
            
            <?php if($show_first): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <a href="messanger.php?id=1&ru_read=<?php echo htmlspecialchars($ru_read); ?>#1" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;">1</a>
                </li>
                <?php if($start_page > 2): ?>
                    <li class="page-item disabled" style="display:inline-block; margin:2px; color:#ccc;">
                        <span style="padding:5px 10px;">...</span>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php for($i = $start_page; $i <= $end_page; $i++): ?>
                <li class="page-item <?php echo ($i == $id) ? 'active' : ''; ?>" style="display:inline-block; margin:2px;">
                    <?php if($i == $id): ?>
                        <span class="current-page" style="background:#06C; color:white; padding:5px 10px; border-radius:4px; display:inline-block;"><?php echo $i; ?></span>
                    <?php else: ?>
                    <a href="messanger.php?id=<?php echo $i ?>&ru_read=<?php echo htmlspecialchars($ru_read); ?>#1" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $i; ?></a>
                    <?php endif; ?>
                </li>
            <?php endfor; ?>
            
            <?php if($show_last): ?>
                <?php if($end_page < $total - 1): ?>
                    <li class="page-item disabled" style="display:inline-block; margin:2px; color:#ccc;">
                        <span style="padding:5px 10px;">...</span>
                    </li>
                <?php endif; ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <a href="messanger.php?id=<?php echo $total ?>&ru_read=<?php echo htmlspecialchars($ru_read); ?>#1" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $total; ?></a>
                </li>
            <?php endif; ?>
            
            <?php if($id != $total): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <a href="messanger.php?id=<?php echo $id+1 ?>&ru_read=<?php echo htmlspecialchars($ru_read); ?>#1" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">بعدی &raquo;</a>
                </li>
            <?php endif; ?>
        </ul>
        
        <div class="page-jump" style="margin-top:10px;">
            <form id="pageJumpForm" action="messanger.php" method="get" style="display:inline-block;">
                <input type="hidden" name="ru_read" value="<?php echo htmlspecialchars($ru_read); ?>" />
                <span style="font-size:16px; margin-left:15px"><?php echo 'به صفحه'; ?></span>
                <input type="number" 
                       id="pageIdInput"
                       name="id"
                       value="<?php echo isset($id) ? (int)$id : 1; ?>" 
                       placeholder="شماره صفحه" 
                       style="width:80px; padding:5px; border-radius:4px; border:1px solid #ccc;">
                <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">برو</button>
            </form>
        </div>
    </div>
    <script>
    document.getElementById('pageJumpForm').addEventListener('submit', function(e) {
        var input = document.getElementById('pageIdInput');
        var pageId = parseInt(input.value, 10);
        if (!isNaN(pageId) && pageId >= 1 && pageId <= <?php echo $total; ?>) {
            this.action = 'messanger.php?id=' + pageId + '&ru_read=<?php echo urlencode($ru_read); ?>#1';
        } else {
            e.preventDefault();
            alert("لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo $total; ?> وارد کنید.");
        }
    });
    </script>
<?php } ?>

<p>&nbsp;</p>
<p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php if(isset($_GET["unread"]))  
{
$string = 'لطفا برای ادامه ابتدا پیام های مشاهده نشده را ملاحظه فرمایید ' ;
echo '<script type="text/javascript">alert("' . $string . '");</script>' ; 
}
?>


