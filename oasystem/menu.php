<?php include('../lock_ad.php'); ?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="background: linear-gradient(135deg, #007849, #00a86b);  box-shadow: 0 2px 10px rgba(0,0,0,0.1); font-family: 'Tahoma', Arial, sans-serif;">
  <tr>
    <!-- خروج از سیستم -->
    <td width="14%" height="45" valign="middle" style="padding: 0 10px;">
      <div style="text-align: right;">
        <a href="../login/logout.php" style="display: inline-flex; align-items: center; text-decoration: none; color: white;  padding: 5px 12px;  transition: all 0.3s;">
          <span>خروج از سيستم</span>
          <img src="../files/exit.png" alt="خروج از سيستم" width="20" height="20" style="margin-right: 5px; border: none;"/>
        </a>
      </div>
    </td>
    
    <!-- تغییر کلمه عبور -->
    <td width="13%" style="padding: 0 10px;">
      <div style="text-align: right;">
        <a href="change-password.php" style="display: inline-flex; align-items: center; text-decoration: none; color: white; padding: 5px 10px;  transition: all 0.3s;">
          <span>تغییر کلمه عبور</span>
          <img src="../files/lock.gif" width="20" height="20" style="margin-right: 5px; border: none;"/>
        </a>
      </div>
    </td>
    
    <!-- آدرس IP -->
    <td width="18%" style="padding: 0 10px;">
      <div style="text-align: right; color: white;  padding: 5px 12px;  display: inline-flex; align-items: center;">
        <span><?php echo $_SERVER['REMOTE_ADDR']; ?></span>
        <img src="../files/ip.gif" width="20" height="25" style="margin-right: 5px; border: none;"/>
      </div>
    </td>
    
    <!-- اطلاعات کاربر -->
    <td width="30%" style="padding: 0 10px;">
      <div style="text-align: right; color: white;  padding: 5px 12px;  display: inline-flex; align-items: center;">
        <span><?php echo $name; ?></span>
        <span style="margin: 15 5px; color: #e0e0e0;">/</span>
        <span ><?php echo $v_jen.' '.$PersName ; ?></span>
        <span style="font-weight: bold; margin-right: 5px; margin-left:10px">:نام کاربر</span>
      </div>
    </td>
    
    <!-- صفحه اصلی -->
    <td width="14%" style="padding: 0 10px;">
      <div style="text-align: right;">
        <a href="index.php" style="display: inline-flex; font-family:tahoma;  align-items: center; text-decoration: none; color: white;  padding: 5px 10px;  transition: all 0.3s;">
          <span>صفحه اصلي</span>
          <img src="../files/Home-icon.png" width="20" height="20" style="margin-right: 5px; border: none;"/>
        </a>
      </div>
    </td>
  </tr>
</table>