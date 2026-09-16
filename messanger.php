<?php 
include('lock_p1.php');
//include('counter.php');
include('event.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <style type="text/css">
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
  #img1
    {
	border-radius:40px ; 
	}
-->
</style>
<style type="text/css">
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
</style>
<script type="text/javascript" src="./assets/js/jquery-3.6.0.min.js"></script>
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
</script>
  <script type='text/javascript' src='15_files/jquery.msgBox.js'></script>
  <link rel="stylesheet" href="15_files/msgBoxLight.css" />
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu_notseen.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      </p>
<?php 
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
include('login/config.php');
$query = "SELECT r_date,del_date,s_user,id,s_time,title,s_date,ru_read,file FROM  pm WHERE  r_user = '$login_session' AND (del != 'T' OR del IS NULL) ORDER BY s_date DESC LIMIT $start, $limit" ;
$query1 = "SELECT id FROM  pm WHERE  r_user = '$login_session' AND (del != 'T' OR del IS NULL) ORDER BY s_date DESC  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<ul id="menu">
<li><a href="search_promo.php">ارسال پیام جدید</a></li>
<li><a href="sent_message.php">پیام های ارسالی </a></li>
<li><a href="messanger.php">پیام های دریافتی</a></li>
</ul>
<p><span class="style8">لیست پیام های دریافتی </span> </p>
<p><img src="files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form name="bulk_action_form" action="message_del2.php" method="post" onSubmit="return delete_confirm();"/>
           <table  align="center" class="my-table"  >
             <tr align="center" class="text1">
    <th width="36" rowspan="2" bgcolor="#0099CC"><input type="checkbox" name="select_all" id="select_all" value=""/></th>
            <td width="55" rowspan="2" bgcolor="#0099CC">حذف</td>
            <td width="54" rowspan="2" bgcolor="#0099CC">مشاهده</td>
            <td width="94" rowspan="2" bgcolor="#0099CC">آخرین وضعیت</td>
    <td colspan="2" bgcolor="#0099CC">فرستنده</td>
    <td height="33" colspan="2" bgcolor="#0099CC">دریافت پیام </td>
    <td width="25%" rowspan="2" bgcolor="#0099CC">موضوع پیام </td>
    <td width="3%" rowspan="2" bgcolor="#0099CC">&nbsp;</td>
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
  if (S_access($row['s_user'])=='20') $v_s_access = 'مدیریت کشوری';
  if (S_access($row['s_user'])=='98') $v_s_access = 'کارشناس ادمین استان';

?>
<tr>
            <td height="79" align="center"><input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $row['id']; ?>"/></td>
<td width="8%" height="59" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <form></form><form  action="message_del.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
    <input type="hidden" name="s_user" value="<?php echo $row['s_user'] ;?>" />
    <button onclick="return confirm('از حذف این پیام مطمئن هستید ؟ ')"><img src="files/del1.png" border="0"  title="حذف پیام" width="33" height="31" /></button>
  </form></td>
<td width="8%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
  <form  action="sabt_view.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
    <input type="hidden" name="s_user" value="<?php echo $row['s_user'] ;?>" />
    <input type="hidden" name="ru_read" value="<?php echo $row['ru_read'] ;?>" />
  <button><img src="files/view.png" border="0"  title="مشاهده پیام" width="29" height="30" /></button>
    </form></td>
<td  class="style2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_message ;?></td>
<td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['s_user']);?><br />
  <span class="style2"><?php echo $v_s_access ;  ?><br />
  <?php echo user_mfa($row['s_user']);?><br />
  </span></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <img  id="img1" src="files/users/<?php echo user_pic($row['s_user']) ?>?m="<?php @filemtime(user_pic($row['s_user'])) ?> width="42" height="46"  alt=""/></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmall"><?php echo $row['s_time']?></td>
    <?php 

if(isset($row['pic'])) $pic = $row['pic'] ;
if ($pic == '') $pic = 'no_pic.png' ; 

 ?>
   <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['s_date']?></td>
   <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['title'];?></td>
   <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php if ($row['file']<>'') echo '<img src=files/attachment.jpg width=30 height=30/>'?></td>
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
  <?php
if(isset($query1))
{
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

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
                    <form action="messanger.php?id=<?php echo $id-1 ?>#1" method="post" style="display:inline;">
                        <input type="hidden" name="ru_read" value="<?php echo htmlspecialchars($ru_read); ?>" />
                        <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">&laquo; قبلی</button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if($show_first): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <form action="messanger.php?id=1#1" method="post" style="display:inline;">
                        <input type="hidden" name="ru_read" value="<?php echo htmlspecialchars($ru_read); ?>" />
                        <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;">1</button>
                    </form>
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
                        <form action="messanger.php?id=<?php echo $i ?>#1" method="post" style="display:inline;">
                            <input type="hidden" name="ru_read" value="<?php echo htmlspecialchars($ru_read); ?>" />
                            <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $i; ?></button>
                        </form>
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
                    <form action="messanger.php?id=<?php echo $total ?>#1" method="post" style="display:inline;">
                        <input type="hidden" name="ru_read" value="<?php echo htmlspecialchars($ru_read); ?>" />
                        <button type="submit" class="button" style="background:#f8f8f8; color:#06C; border:1px solid #ddd; padding:5px 10px; border-radius:4px; cursor:pointer;"><?php echo $total; ?></button>
                    </form>
                </li>
            <?php endif; ?>
            
            <?php if($id != $total): ?>
                <li class="page-item" style="display:inline-block; margin:2px;">
                    <form action="messanger.php?id=<?php echo $id+1 ?>#1" method="post" style="display:inline;">
                        <input type="hidden" name="ru_read" value="<?php echo htmlspecialchars($ru_read); ?>" />
                        <button type="submit" class="button" style="background:#06C; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer;">بعدی &raquo;</button>
                    </form>
                </li>
            <?php endif; ?>
        </ul>
        
        <div class="page-jump" style="margin-top:10px;">
            <form id="pageJumpForm" action="messanger.php" method="post" style="display:inline-block;">
                <input type="hidden" name="ru_read" value="<?php echo htmlspecialchars($ru_read); ?>" />
                <span style="font-size:16px; margin-left:15px"><?php echo 'به صفحه'; ?></span>
                <input type="number" 
                       id="pageIdInput"
                       name="page_input"
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
            this.action = 'messanger.php?id=' + pageId + '#1';
        } else {
            e.preventDefault();
            alert("لطفاً یک شماره صفحه معتبر بین 1 تا <?php echo $total; ?> وارد کنید.");
        }
    });
    </script>
<?php } ?>

<p>&nbsp;</p>
<p><a href="indexbenef.php" title="برگشت به صفحه قبل"><img src="files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="files/bottom.gif"><?php include('footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php if(isset($_GET["unread"]))  
{
//$string = 'همکار گرامی : شما پیام جدید دارید \n \n  برای ادامه ، پیام های جدید را مشاهده کنید  ' ;
//alert($string);
?>
	   <script type="text/javascript">
    	msgBoxImagePath = "15_files/";
	showMsgBox() ; 
		function showMsgBox(title,content,type) {
			$.msgBox({
				title: "توجه :",
				content: " لطفاً برای ادامه ، ابتدا پیام های جدید خود را مشاهده کنید .",
				type: "alert" ,
				showButtons: true,
                opacity: 0.8,
                autoClose:true,
				});
		}
		 </script>
<?php
}
?>