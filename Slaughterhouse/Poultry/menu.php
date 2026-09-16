<?php include('../../lock_expar.php') ; ?>
<link href="FA.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" align="center" bgcolor="#0099CC">
      <tr>
        <td width="14%" height="35" valign="middle"><div align="right"><a href="../../login/logout.php" class="LinkTitleNews" title="Exit"> خروج از سيستم <img src="../../files/exit.png" alt="خروج از سيستم " width="24" height="24" border="0" /></a></div></td>
        <td width="13%" ><div align="right"><a href="../change-password.php" target="_self" class="LinkTitleNews" title="Change Password">تغییر کلمه عبور <img src="../../files/lock.gif" width="32" height="32" border="0"/></a></div></td>
        <td width="18%" style="margin-top:20px ; text-align:right" ><span style="margin-top:20px"><?php echo $_SERVER['REMOTE_ADDR']; ?></span></td>
        <td width="4%" class="normalTextSmall"><img src="../../files/ip.gif" width="25" height="33"  alt=""/></td>
        <td width="30%" style="margin-top:20px ; text-align:right ; color:#FFF"><?php echo $v_jen.' '.$PersName ; ?><span class="normalTextSmall"> / </span><?php echo $name; ?> </td>
        <td width="7%" class="normalTextSmall">:نام کاربر</td>
        <td width="14%" align="right"><a href="../index.php" title="Home Page" class="LinkTitleNews">صفحه اصلي <img src="../../files/Home-icon.png" width="30" height="30" border="0" /></a></td>
      </tr>
</table>
