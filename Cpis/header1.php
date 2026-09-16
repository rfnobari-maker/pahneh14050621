<?php require_once('side_menu1.php'); ?>
<style>
.header_test {
    position: sticky;
    top: 0;
    z-index: 98; /* برای اطمینان از اینکه همیشه در بالای سایر محتوا نمایش داده می‌شود */
}

.menu_test {
    position: sticky;
    top: 130px; /* بالای این عنصر از ابتدای صفحه بعد از تصویر هدر تنظیم می‌شود */
    z-index: 97; /* برای اطمینان از اینکه منو زیر هدر قرار نمی‌گیرد */
}
</style>

<!-- هدر ثابت -->
<tr>
    <td class="header_test">
        <img src="<?php echo $root ?>files/images/header.jpg" width="100%" height="130" />
    </td>
</tr>

<!-- منوی ثابت -->
<tr>
    <td class="menu_test" dir="ltr">
        <?php include($_SERVER['DOCUMENT_ROOT'].'/Chief/menu.php'); ?>
    </td>
</tr>

<!-- سایر محتوا -->
<tr>
    <td>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/Chief/top.php'); ?>
    </td>
</tr>
          