<?php
include('../lock_ad.php');
include('../login/config.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <style type="text/css">
    </style>
</head>
<body>
<?php
if(isset($_POST['action'])) {
    $username = $_POST['username'];

    try {
        $dbh->beginTransaction();

        // 1. دریافت اطلاعات کاربر
        $query_get_user_info = "SELECT id_ostan, perm FROM users WHERE username = ?";
        $stmt_get_user_info = $dbh->prepare($query_get_user_info);
        $stmt_get_user_info->execute(array($username));
        $current_user_data = $stmt_get_user_info->fetch(PDO::FETCH_ASSOC);

        if (!$current_user_data) {
            throw new Exception('کاربر یافت نشد.');
        }

        $current_user_id_ostan = $current_user_data['id_ostan'];

        // 2. مدیریت انحصار Bsh (زراعت)
        $bsh_checked = isset($_POST['Bsh']) && $_POST['Bsh'] == 'Bsh';

        if ($bsh_checked) {
            $query_find_other_bsh_user = "SELECT username, perm FROM users WHERE id_ostan = ? AND perm LIKE '%Bsh%' AND username != ?";
            $stmt_find_other_bsh_user = $dbh->prepare($query_find_other_bsh_user);
            $stmt_find_other_bsh_user->execute(array($current_user_id_ostan, $username));
            $other_bsh_users = $stmt_find_other_bsh_user->fetchAll(PDO::FETCH_ASSOC);

            foreach ($other_bsh_users as $other_user) {
                $other_user_perm = $other_user['perm'];
                $other_user_username = $other_user['username'];
                $new_perm_for_other_user = str_ireplace('Bsh', '', $other_user_perm);
                $query_update_other_user = "UPDATE users SET perm = ? WHERE username = ?";
                $q_update_other = $dbh->prepare($query_update_other_user);
                $q_update_other->execute(array($new_perm_for_other_user, $other_user_username));
            }
        }

        // 3. مدیریت انحصار Bgh (باغبانی) - *بخش جدید*
        $bgh_checked = isset($_POST['Bgh']) && $_POST['Bgh'] == 'Bgh';

        if ($bgh_checked) {
            // یافتن کاربران دیگری که در همین استان دسترسی Bgh دارند
            $query_find_other_bgh_user = "SELECT username, perm FROM users WHERE id_ostan = ? AND perm LIKE '%Bgh%' AND username != ?";
            $stmt_find_other_bgh_user = $dbh->prepare($query_find_other_bgh_user);
            $stmt_find_other_bgh_user->execute(array($current_user_id_ostan, $username));
            $other_bgh_users = $stmt_find_other_bgh_user->fetchAll(PDO::FETCH_ASSOC);

            // حذف دسترسی Bgh از سایر کاربران
            foreach ($other_bgh_users as $other_user) {
                $other_user_perm = $other_user['perm'];
                $other_user_username = $other_user['username'];
                
                $new_perm_for_other_user = str_ireplace('Bgh', '', $other_user_perm);
                $query_update_other_user = "UPDATE users SET perm = ? WHERE username = ?";
                $q_update_other = $dbh->prepare($query_update_other_user);
                $q_update_other->execute(array($new_perm_for_other_user, $other_user_username));
            }
        }

        // 4. ساخت رشته perm
        $perm = '';
        $full_access = isset($_POST['full']) ? $_POST['full'] : '';

        if ($full_access == 'p1p2p3p4d1d2d3d4d5d6d7d8d9d10d11') {
            $perm = $full_access; 
        } else {
            for ($i = 1; $i <= 4; $i++) {
                if (isset($_POST['p'.$i])) { $perm .= $_POST['p'.$i]; }
            }
            for ($i = 1; $i <= 11; $i++) {
                if (isset($_POST['d'.$i])) { $perm .= $_POST['d'.$i]; }
            }
            if ($bsh_checked) {
                $perm .= $_POST['Bsh'];
            }
            // اضافه کردن Bgh به رشته مجوزها
            if ($bgh_checked) {
                $perm .= $_POST['Bgh'];
            }
        }
if ($bsh_checked) {
    $perm .= 'Bsh';
}
if ($bgh_checked) {
    $perm .= 'Bgh';
}
        // 5. به‌روزرسانی کاربر فعلی
        $query_update_current_user = "UPDATE users SET perm=? WHERE username=?";
        $q_update_current = $dbh->prepare($query_update_current_user);
        $q_update_current->execute(array($perm, $username));

        $dbh->commit();

        ?>
        <script>
            alert('تغییرات با موفقیت اعمال شد');
            close();
        </script>
        <?php
    } catch (Exception $e) {
        $dbh->rollBack();
        echo '<script>alert("خطا در اعمال تغییرات: ' . htmlspecialchars($e->getMessage()) . '");</script>';
    }
}
?>

<table width="102%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
    <tr>
        <td width="4"><p>&nbsp;</p>
            <p>&nbsp;</p></td>
        <td width="1022" >
            <form action='' method=post>
                <?php
                if(isset($_POST['username'])) {
                    $username = $_POST['username'];
                    $query2 = "SELECT * FROM users WHERE username = ?";
                    $stmt2 = $dbh->prepare($query2);
                    $stmt2->execute(array($username));
                    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                    if ($row2) { 
                        ?>
                        <table style=" margin-right:35px" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="22" colspan="5"><span class="style8"><img src="../files/horizontal-line-700x223.png" width="630" height="17" alt=""/></span></td>
                            </tr>
                            <tr>
                                <td width="274" height="44" align="right" class="style19" ><?php echo htmlspecialchars($row2['cod_m']) ; ?></td>
                                <td width="181" align="right" ><span class="style8"><span class="style19">:کد ملی</span></span></td>
                                <td width="113">&nbsp;</td>
                                <td width="226"><div align="right" class="style9">
                                        <?php echo htmlspecialchars($row2['name'].' '.$row2['Last_name']) ?></div>
                                </td>
                                <td width="159"><span class="style8"><img src="../files/users/<?php echo htmlspecialchars($row2['pic']);?>" width="46" height="51" alt=""/></span></td>
                            </tr>
                            <tr>
                                <td height="18" colspan="5" align="right" ><span class="style8"><img src="../files/horizontal-line-700x223.png" width="630" height="17" alt=""/></span></td>
                            </tr>
                        </table>
                        <table width="75%" border='0' align=center cellpadding='0' cellspacing='0' bgcolor="#CCCCCC">
                            <tr bgcolor='#f1f1f1' > <td height="40" colspan='6' align='center' bgcolor="#FFFFCC"><font size="2" face="verdana, arial, helvetica" class="style8">مجوز دسترسی به اطلاعات</font></td> </tr>
                            <tr bgcolor='#f1f1f1' >
                                <td colspan="3"  align='center' bgcolor="#CC3333" class="text1">اطلاعات اختصاصی </td>
                                <td width="25" height="45"  align='center' bgcolor="#CC3333" class="text1">&nbsp;</td>
                                <td width="322"  align='center' bgcolor="#CC3333" class="text1">اطلاعات عمومی</td>
                                <td width="25"  align='center' bgcolor="#CC3333" class="text1">&nbsp;</td>
                            </tr>
                            <tr bgcolor='#f1f1f1' >
                                <td height="38" colspan="3"  align='center' bgcolor="#F1F1F1" class="style1">بهره برداران کشاورزی</td>
                                <td width="25"  align='center' bgcolor="#F1F1F1" class="style1"><input name="d9" type="checkbox" id="d9" value="d9" <?php if(strstr($row2['perm'],'d9')) echo "checked='checked'" ?> /></td>
                                <td width="322"  align='center' bgcolor="#F1F1F1" class="style1">استان های تحت پوشش</td>
                                <td width="25"  align='center' bgcolor="#F1F1F1" class="style1"><input type="checkbox" name="p1" id="p1" value="p1"  <?php if(strstr($row2['perm'],'p1')) echo "checked='checked'" ?> /></td>
                            </tr>
                            
                            <tr bgcolor='#f1f1f1' >
                                <td width="327" height="38"  align='center' bgcolor="#FFFFCC" class="style1">ثبت برش شهرستانی الگوی کشت </td>
                                <td width="25"  align='center' bgcolor="#FFFFCC" class="style1"><input name="Bsh" type="checkbox" id="Bsh" value="Bsh"
                                    <?php if(strstr($row2['perm'],'Bsh')) echo "checked='checked'"; ?> /></td>
                                <td width="238"  align='center' bgcolor="#FFFFCC" class="style1">زراعت </td>
                                <td width="25"  align='center' bgcolor="#FFFFCC" class="style1"><input name="d1" type="checkbox" id="d1" value="d1"
                                    <?php if (strstr($row2['perm'],'d1')) echo "checked='checked'"; ?> /></td>
                                <td  align='center' bgcolor="#FFFFCC" class="style1">شهرها و آبادی ها</td>
                                <td  align='center' bgcolor="#FFFFCC" class="style1"><input type="checkbox" name="p2" id="p2" value="p2"  <?php if(strstr($row2['perm'],'p2')) echo "checked='checked'" ?> /></td>
                            </tr>
                            
                            <tr bgcolor='#f1f1f1' >
                                <td height="35" colspan="3"  align='center' bgcolor="#F1F1F1" class="style1">صیفی</td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1"><input name="d2" type="checkbox" id="d2" value="d2"  <?php if(strstr($row2['perm'],'d2')) echo "checked='checked'" ?> /></td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1">مراکز جهاد کشاورزی</td>
                                <td  align='center' class="style1"><input name="p3" type="checkbox" id="p3" value="p3" <?php if(strstr($row2['perm'],'p3')) echo "checked='checked'" ?> /></td>
                            </tr>
                            
                            <tr bgcolor='#f1f1f1' >
                                <td width="327" height="35"  align='center' bgcolor="#FFFFCC" class="style1">ثبت برش شهرستانی الگوی کشت </td>
                                <td width="25" align='center' bgcolor="#FFFFCC" class="style1"><input name="Bgh" type="checkbox" id="Bgh" value="Bgh"
                                    <?php if(strstr($row2['perm'],'Bgh')) echo "checked='checked'"; ?> /></td>
                                <td width="238" align='center' bgcolor="#FFFFCC" class="style1">باغبانی</td>
                                <td align='center' bgcolor="#FFFFCC" class="style1"><input name="d3" type="checkbox" id="d3" value="d3" <?php if(strstr($row2['perm'],'d3')) echo "checked='checked'" ?> /></td>
                                <td align='center' bgcolor="#FFFFCC" class="style1">کاربران سامانه</td>
                                <td align='center' bgcolor="#FFFFCC" class="style1"><input name="p4" type="checkbox" id="p4" value="p4"  <?php if(strstr($row2['perm'],'p4')) echo "checked='checked'" ?> /></td>
                            </tr>
                            
                            <tr bgcolor='#f1f1f1' >
                                <td height="32" colspan="3"  align='center' bgcolor="#F1F1F1" class="style1">گلخانه</td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1"><input name="d4" type="checkbox" id="d4" value="d4"  <?php if(strstr($row2['perm'],'d4')) echo "checked='checked'" ?> /></td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
                            </tr>
                            <tr bgcolor='#f1f1f1' >
                                <td height="37" colspan="3"  align='center' bgcolor="#FFFFCC" class="style1">پرورش قارج</td>
                                <td  align='center' bgcolor="#FFFFCC" class="style1"><input name="d5" type="checkbox" id="d5" value="d5"  <?php if(strstr($row2['perm'],'d5')) echo "checked='checked'" ?> /></td>
                                <td  align='center' bgcolor="#FFFFCC" class="style1">&nbsp;</td>
                                <td  align='center' bgcolor="#FFFFCC" class="style1">&nbsp;</td>
                            </tr>
                            <tr bgcolor='#f1f1f1' >
                                <td height="42" colspan="3"  align='center' bgcolor="#F1F1F1" class="style1">مزارع پرورش آبزیان</td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1"><input name="d6" type="checkbox" id="d6" value="d6"  <?php if(strstr($row2['perm'],'d6')) echo "checked='checked'" ?> /></td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
                            </tr>
                            <tr bgcolor='#f1f1f1' >
                                <td height="35" colspan="3"  align='center' bgcolor="#FFFFCC" class="style1">زنبور عسل</td>
                                <td  align='center' bgcolor="#FFFFCC" class="style1"><input name="d7" type="checkbox" id="d7" value="d7"  <?php if(strstr($row2['perm'],'d7')) echo "checked='checked'" ?> /></td>
                                <td  align='center' bgcolor="#FFFFCC" class="style1">&nbsp;</td>
                                <td  align='center' bgcolor="#FFFFCC" class="style1">&nbsp;</td>
                            </tr>
                            <tr bgcolor='#f1f1f1' >
                                <td height="41" colspan="3"  align='center' bgcolor="#F1F1F1" class="style1">ترویج</td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1"><input name="d8" type="checkbox" id="d8" value="d8"  <?php if(strstr($row2['perm'],'d8')) echo "checked='checked'" ?> /></td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
                            </tr>
                            <tr bgcolor='#f1f1f1' >
                                <td height="41" colspan="3"  align='center' bgcolor="#FFFFCC" class="style1">صنایع تبدیلی و تکمیلی</td>
                                <td  align='center' bgcolor="#FFFFCC" class="style1"><input name="d10" type="checkbox" id="d10" value="d10"  <?php if(strstr($row2['perm'],'d10')) echo "checked='checked'" ?> /></td>
                                <td  align='center' bgcolor="#FFFFCC" class="style1">&nbsp;</td>
                                <td  align='center' bgcolor="#FFFFCC" class="style1">&nbsp;</td>
                            </tr>
                            <tr bgcolor='#f1f1f1' >
                                <td height="41" colspan="3"  align='center' bgcolor="#FFFFFF" class="style1">دام</td>
                                <td  align='center' bgcolor="#FFFFFF" class="style1"><input name="d11" type="checkbox" id="d11" value="d11"  <?php if(strstr($row2['perm'],'d11')) echo "checked='checked'" ?> /></td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
                                <td  align='center' bgcolor="#F1F1F1" class="style1">&nbsp;</td>
                            </tr>
                            <tr bgcolor='#f1f1f1' >
                                <td height="41" colspan="3"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
                                <td  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
                                <td  align='center' bgcolor="#CCCC33" class="style1">دسترسی طلائی </td>
                                <td  align='center' bgcolor="#CCCC33" class="style1"><input name="full" type="checkbox" id="full" value="p1p2p3p4d1d2d3d4d5d6d7d8d9d10d11"  <?php if($row2['perm']=='p1p2p3p4d1d2d3d4d5d6d7d8d9d10d11') echo "checked='checked'" ?> /></td>
                            </tr>
                            <tr bgcolor='#ffffff' > <td height="64" colspan=6 align=center><p>&nbsp;
                                </p>
                                    <p>
                                        <input type="hidden" name="username" value="<?php echo htmlspecialchars($row2['username']) ;?>" />
                                        <input name='action' type=submit class="style19" style="width:150px ; height:45px" value='ثبت تغییرات ' />
                                    </p>     </font></td></tr>
                        </table>

                    </form>
                    <?php
                    } else { 
                        echo '<br>';
                        echo '<p align=center style=color:red> کاربری با این نام کاربری یافت نشد. </p>';
                    }
                } else {
                    echo '<br>';
                    echo '<p align=center style=color:red> مجوز دسترسی به این صفحه را ندارید </p> ';
                }
                ?>
        </td>
    </tr>
</table>
</body>
</html>