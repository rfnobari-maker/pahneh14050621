<?php include_once('../../login/config.php') ;
$query = "SELECT ru_read FROM  pm WHERE r_user = '$login_session' and  ru_read = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_pm = $stmt -> rowCount();
?>
<meta charset="utf-8">
<style>
#user_data
{
  float:right; height:180px ; width:100% }
img.polaroid {  
    background:#000; /*Change this to a background image or remove*/ 
    border:solid #fff;  
    border-width:6px 6px 20px 6px;  
    box-shadow:1px 1px 3px #333; /* Standard blur at 5px. Increase for more depth */ 
    -webkit-box-shadow:1px 1px 5px #333;  
    -moz-box-shadow:1px 1px 5px #333;  
}  
.box_pm {  float:left ; line-height:150% ; margin-left:20px ; margin-top:-100px ; width:150px }
.tricky_image {	margin-bottom:10px;
    max-width:86px; 
    max-height:86px;
    -moz-transition: all 1s; 
    -webkit-transition: all 1s;  
    -ms-transition: all 1s;  
    -o-transition: all 1s;  
    transition: all 1s; 
    opacity:1;
    filter:alpha(opacity=100);
}
#mes_count
{
	 font-family:Tahoma ; color:#F00 ; font-size:14px ; margin-top:-30px }
</style>
  <script>
function target_popup2(form) {
    window.open('null', 'formpopup', 'scrollbars=0,resizable=0,width=700,height=700,left=0,top=0');
    form.target = 'formpopup';
}
</script>
<div id='user_data'>
<div style="float:right ; margin-right:30px ; margin-left:20px ; margin-top:15px ; padding:10px "  >
 <a  title="ویرایش اطلاعات کاربری" href="profile.php"><img  class="polaroid" src="../../files/users/<?php echo $pic ?>" width="79" height="103" id="img" alt="تصویر کاربر "/></a></div>
              <p align="right" class="style2" style="margin-right:30px">&nbsp;</p>
              <p align="right" class="style2" style="margin-right:30px">پانل مدیریتی سامانه جامع پهنه بندی و مدیریت داده های کشاورزی</p>
              <p align="right" class="RedTitleSmaller" style="margin-right:30px">ویژه مدیریت کشوری سامانه</p>
              <p align="right" class="normalTextSmaller" style="margin-right:30px">&nbsp;</p>
  <div class="box_pm">
    <p><a href="messanger.php" title="ارسال و دریافت پیام"><img src="../../files/messanger.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a>
<?php if ($count_pm > 0)
  echo '<div id=mes_count dir=rtl>'.$count_pm . ' : پیام  <img src=../../files/jadid.gif width=35 height=15 /></div>' ?>
   </p>
</div>
<div class="box_pm">
    <p><a href="support.php" onClick="target_popup2(this)" title="ارتباط با پشتیبان سامانه"><img src="../../files/support-png-icon.jpg" alt="users" width="83" height="83" border="0" class="tricky_image" /></a>
   </p>
</div>
</div>