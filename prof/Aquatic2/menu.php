<link href="../../FA.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" align="center" bgcolor="#0099CC">
      <tr>
        <td width="14%" height="35" valign="middle"><div align="right"><a href="../../login/logout.php" class="LinkTitleNews" title="Exit"> خروج از سيستم <img src="../../files/exit.png" alt="خروج از سيستم " width="23" height="22" border="0" /></a></div></td>
        <td width="13%" ><div align="right"><a href="../../change-password.php" target="_self" class="LinkTitleNews" title="Change Password">تغییر کلمه عبور <img src="../../files/lock.gif" width="23" height="22" border="0"/></a></div></td>
        <td width="18%" style="margin-top:20px ; text-align:right" ><span style="margin-top:20px"><?php echo getUserIP(); ?></span></td>
        <td width="4%" class="normalTextSmall"><img src="../../files/ip.gif" width="23" height="22"  alt=""/></td>
        <td width="30%" style="margin-top:20px ; text-align:right ; color:#FFF"><?php echo $v_jen.' '.$PersName ; ?><span class="normalTextSmall"> / </span><?php echo $name; ?> </td>
        <td width="7%" class="normalTextSmall">:نام کاربر</td>
        <td width="14%" align="right"><a href="../../indexbenef.php" title="Home Page" class="LinkTitleNews">صفحه اصلي <img src="../../files/Home-icon.png" width="23" height="22" border="0" /></a></td>
      </tr>
      <tr>
        <td height="45" colspan="7" valign="middle" >
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="text-align:right"><?php include('menup.php'); ?></td>
          </tr>
        </table></td>
      </tr>
 </table>
  <?php
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // حذف پورت در صورت وجود
    $ipParts = explode(':', $ip);
    return $ipParts[0];
}
?>