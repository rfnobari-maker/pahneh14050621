<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/login/config.php');
$query = "SELECT COUNT(*) FROM pm WHERE r_user = :login_session AND ru_read = '1'";
$stmt = $dbh->prepare($query);
$stmt->bindParam(':login_session', $login_session);
$stmt->execute();
$count_pm = $stmt->fetchColumn();

?>
<meta charset="utf-8">
<style>
/* CSS برای نمایش در کامپیوتر (صفحه نمایش بزرگ) */
#user_data {
  /* تنظیمات Flexbox برای قرار دادن محتویات در یک ردیف (چپ و راست) */
  display: flex; 
  justify-content: space-between; /* چپ و راست کردن دو بخش */
  align-items: center; /* مرکز قرار گرفتن عمودی کل محتوا */
  
  height: 180px;
  width: 100%;
}
.right-content {
    /* عکس و متن در یک ردیف، از راست به چپ چیده شود */
    display: flex;
    flex-direction: row-reverse; 
    align-items: center; /* برای مرکزیت عمودی عکس و کانتینر متن */
}
.right-text-container {
    /* کانتینر برای پاراگراف‌های متنی */
    display: flex;
    flex-direction: column;
    align-items: flex-end; /* راست‌چین کردن متن‌ها */
    justify-content: flex-start; 
    margin-top: 25px; /* تنظیم فاصله از بالای عکس برای چیدمان دقیق‌تر */
    margin-right: 30px;
}
/* **جدید:** کلاس برای بزرگتر کردن فونت عنوان اصلی */
.main-title {
    font-size: 16px; 
}
.left-content {
    /* چیدمان افقی برای دو آیکون در سمت چپ */
    display: flex;
    align-items: center; 
    flex-direction: row; 
    gap: 30px; /* فاصله بین آیکون‌ها */
    margin-left: 50px; /* فاصله از لبه چپ */
    height: 100%;
}

img.polaroid {  
    background: #000;
    border: solid #fff;  
    border-width: 6px 6px 20px 6px;  
    box-shadow: 1px 1px 3px #333;
    -webkit-box-shadow: 1px 1px 5px #333;  
    -moz-box-shadow: 1px 1px 5px #333;  
}  
.box_pm {
  line-height: 150%;
  width: 150px; 
  margin: 0;
}
.tricky_image {
  margin-bottom: 10px;
  max-width: 76px; 
  max-height: 76px;
  -moz-transition: all 1s; 
  -webkit-transition: all 1s;  
  -ms-transition: all 1s;  
  -o-transition: all 1s;  
  transition: all 1s; 
  opacity: 1;
  filter: alpha(opacity=100);
}
#mes_count {
  font-family: Tahoma;
  color: #F00;
  font-size: 14px;
  margin-top: -30px;
}
/* حذف تمام float های قبلی */
#user_data > div[style*="float:right"] {
    float: none !important;
}

/* --- Media Queries برای موبایل (صفحه نمایش کوچک) --- */
@media screen and (max-width: 768px) {
  #user_data {
    display: flex !important;
    flex-direction: column !important;
    height: auto;
    width: 100%;
    padding-bottom: 20px;
  }
  
  .right-content {
    flex-direction: column !important;
    align-items: center !important;
    width: 100% !important;
  }
  
  .right-text-container {
    align-items: center !important;
    margin-right: 0 !important;
  }
  
  .left-content {
    flex-direction: row !important;
    justify-content: center !important;
    margin: 10px auto;
    width: fit-content;
    gap: 20px;
  }

  .box_pm {
    margin: 0 10px;
    width: 150px;
    text-align: center;
  }

  p[align="right"] {
    text-align: center !important;
    margin-right: 0 !important;
  }

  img.polaroid {
    width: 79px;
    height: 103px;
    margin-top: 20px;
  }
  
  #mes_count {
    margin-top: -20px;
  }
}
</style>
<script>
function target_popup2(form) {
    window.open('null', 'formpopup', 'scrollbars=0,resizable=0,width=700,height=700,left=0,top=0');
    form.target = 'formpopup';
}
</script>
<div id='user_data' dir="rtl">
    
    <div class="right-content">
        <div class="right-text-container">
              <p align="right" class="style2">&nbsp;</p>
              <p align="right" class="style2 main-title">سامانه اجرای الگوی کشت<br><span class="RedTitleSmaller">ویژه مدیریت کشوری سامانه</span></p> 
              <p align="right" class="normalTextSmaller">&nbsp;</p>
        </div>
        <div style="margin-right:30px ; margin-left:20px ; margin-top:15px ; padding:10px ">
            <a title="ویرایش اطلاعات کاربری" href="<?php echo htmlspecialchars($base) ;?>profile"><img class="polaroid" src="<?php echo htmlspecialchars($root); ?>/files/users/<?php echo htmlspecialchars($pic); ?>" width="79" height="103" id="img" alt="تصویر کاربر "/></a>
        </div>
        
    </div>
    <div class="left-content">
        <div class="box_pm">
            <a href="<?php echo htmlspecialchars($base) ;?>support" onClick="target_popup2(this)" title="ارتباط با پشتیبان سامانه"><img src="<?php echo htmlspecialchars($root); ?>/files/support-png-icon.jpg" alt="users" width="73" height="73" border="0" class="tricky_image" /></a>
        </div>
        <div class="box_pm">
            <p><a href="<?php echo htmlspecialchars($base) ;?>messanger" title="ارسال و دریافت پیام"><img src="<?php echo htmlspecialchars($root); ?>/files/messanger.png" alt="users" width="73" height="73" border="0" class="tricky_image" /></a>
        <?php if ($count_pm > 0)
          echo '<div id="mes_count" dir="rtl">' . htmlspecialchars($count_pm) . ' : پیام <img src="' . htmlspecialchars($root . '/files/jadid.gif') . '" width="35" height="15" /></div>'; ?>
        </p>
        </div>
    </div>
</div>