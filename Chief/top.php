<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/login/config.php');

if (!isset($count_pm)) {
    $count_pm = 0;
    $pm_cache_ok = isset($_SESSION['top_pm_count'], $_SESSION['top_pm_at'], $_SESSION['top_pm_user'])
        && isset($login_session)
        && $_SESSION['top_pm_user'] === $login_session
        && (time() - (int)$_SESSION['top_pm_at']) < 30;

    if ($pm_cache_ok) {
        $count_pm = (int)$_SESSION['top_pm_count'];
    } elseif (isset($dbh, $login_session)) {
        $query = "SELECT COUNT(*) FROM pm WHERE r_user = :login_session AND ru_read = '1'";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':login_session', $login_session);
        $stmt->execute();
        $count_pm = (int)$stmt->fetchColumn();
        $_SESSION['top_pm_count'] = $count_pm;
        $_SESSION['top_pm_at'] = time();
        $_SESSION['top_pm_user'] = $login_session;
    }
}

$top_base = isset($base) ? htmlspecialchars($base, ENT_QUOTES, 'UTF-8') : '';
$top_root = isset($root) ? htmlspecialchars($root, ENT_QUOTES, 'UTF-8') : '';
$top_pic  = isset($pic) ? htmlspecialchars($pic, ENT_QUOTES, 'UTF-8') : '';
?>
<meta charset="utf-8">
<style>
#user_data {
  float: right;
  height: 180px;
  width: 100%;
  -webkit-text-size-adjust: 100%;
  text-size-adjust: 100%;
}
#user_data .top-photo {
  float: right;
  margin: 15px 30px 0 20px;
  padding: 10px;
}
img.polaroid {
  background: #000;
  border: solid #fff;
  border-width: 6px 6px 20px 6px;
  box-shadow: 1px 1px 3px #333;
}
.top-icons {
  float: left;
  margin-top: -100px;
  margin-left: 10px;
  white-space: nowrap;
}
.box_pm {
  display: inline-block;
  vertical-align: top;
  line-height: 150%;
  margin-left: 20px;
  width: 150px;
  text-align: center;
}
.tricky_image {
  margin-bottom: 10px;
  max-width: 76px;
  max-height: 76px;
  transition: all 1s;
  opacity: 1;
}
#mes_count {
  font-family: Tahoma;
  color: #F00;
  font-size: 14px;
  margin-top: 2px;
  line-height: 1.3;
  white-space: nowrap;
}

@media screen and (max-width: 768px),
       screen and (max-width: 1024px) and (pointer: coarse) {
  #user_data {
    float: none;
    height: auto;
    width: 100%;
    max-width: 100%;
    text-align: center;
    padding-bottom: 12px;
    overflow: hidden;
  }
  #user_data .top-photo {
    float: none;
    display: block;
    margin: 10px auto;
    padding: 6px;
    width: auto;
  }
  .top-icons {
    float: none;
    display: block;
    margin: 8px auto 0;
    white-space: normal;
    text-align: center;
  }
  .box_pm {
    display: block;
    margin: 12px auto;
    width: 150px;
    text-align: center;
  }
  #user_data p[align="right"] {
    text-align: center;
    margin-right: 12px !important;
    margin-left: 12px;
    padding: 0 8px;
    overflow-wrap: anywhere;
    word-wrap: break-word;
  }
  #user_data p.style2:first-of-type,
  #user_data p.normalTextSmaller {
    display: none;
  }
  img.polaroid {
    width: 79px;
    height: 103px;
    margin-top: 8px;
  }
  .tricky_image {
    transition: none;
  }
}
@media (prefers-reduced-motion: reduce) {
  .tricky_image { transition: none; }
}
</style>
<script>
function target_popup2(el) {
    var href = (el && el.href) ? el.href : 'about:blank';
    window.open(href, 'formpopup', 'scrollbars=1,resizable=1,width=700,height=700,left=0,top=0');
    return false;
}
</script>
<div id="user_data">
  <div class="top-photo">
    <a title="ویرایش اطلاعات کاربری" href="<?php echo $top_base; ?>profile"><img class="polaroid" src="<?php echo $top_root; ?>/files/users/<?php echo $top_pic; ?>" width="79" height="103" id="img" alt="تصویر کاربر" decoding="async"></a>
  </div>
  <p align="right" class="style2" style="margin-right:30px">&nbsp;</p>
  <p align="right" class="style2" style="margin-right:30px">سامانه جامع پهنه بندی و مدیریت داده های کشاورزی</p>
  <p align="right" class="RedTitleSmaller" style="margin-right:30px">ویژه مدیریت کشوری سامانه</p>
  <p align="right" class="normalTextSmaller" style="margin-right:30px">&nbsp;</p>
  <div class="top-icons">
    <div class="box_pm">
      <a href="<?php echo $top_base; ?>messanger" title="ارسال و دریافت پیام"><img src="<?php echo $top_root; ?>/files/messanger.png" alt="پیام‌رسان" width="73" height="73" border="0" class="tricky_image" decoding="async"></a>
      <?php if ($count_pm > 0): ?>
      <div id="mes_count" dir="rtl"><?php echo (int)$count_pm; ?> : پیام <img src="<?php echo $top_root; ?>/files/jadid.gif" width="35" height="15" alt=""></div>
      <?php endif; ?>
    </div>
    <div class="box_pm">
      <a href="<?php echo $top_base; ?>support" onclick="return target_popup2(this);" title="ارتباط با پشتیبان سامانه"><img src="<?php echo $top_root; ?>/files/support-png-icon.jpg" alt="پشتیبان" width="73" height="73" border="0" class="tricky_image" decoding="async"></a>
    </div>
  </div>
</div>
