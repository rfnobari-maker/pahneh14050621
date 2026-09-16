<?php
/**
 * Access to Chief / Cpis / dash is independent of the single S_access role.
 * One username can enter all three systems.
 */
if (!function_exists('pahneh_sys_has_col')) {
    function pahneh_sys_has_col($dbh, $col)
    {
        if (!$dbh) {
            return false;
        }
        try {
            $stmt = $dbh->prepare('SHOW COLUMNS FROM users LIKE ?');
            $stmt->execute(array($col));
            return (bool) $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }
}

if (!function_exists('pahneh_sys_ensure')) {
    function pahneh_sys_ensure($dbh)
    {
        static $done = false;
        if ($done || !$dbh) {
            return;
        }
        $done = true;
        $added = false;
        foreach (array('acc_chief', 'acc_cpis', 'acc_dash') as $col) {
            if (!pahneh_sys_has_col($dbh, $col)) {
                try {
                    $dbh->exec('ALTER TABLE users ADD COLUMN `' . $col . '` TINYINT(1) NOT NULL DEFAULT 0');
                    $added = true;
                } catch (Exception $e) {
                }
            }
        }
        if ($added) {
            try {
                $dbh->exec("UPDATE users SET acc_chief = 1, acc_cpis = 1, acc_dash = 1
                    WHERE S_access IN ('20','23','99')
                    AND acc_chief = 0 AND acc_cpis = 0 AND acc_dash = 0");
            } catch (Exception $e) {
            }
        }
        try {
            $dbh->exec("UPDATE users SET acc_cpis = 1
                WHERE chief = '1' AND IFNULL(acc_cpis, 0) = 0");
        } catch (Exception $e) {
        }
    }
}

if (!function_exists('pahneh_sys_can')) {
    function pahneh_sys_can($row, $sys)
    {
        if (!is_array($row) || $row === array()) {
            return false;
        }
        if ($sys === 'cpis') {
            $chief = isset($row['chief']) ? trim($row['chief'] . '') : '';
            if ($chief === '1') {
                return true;
            }
        }
        $flag = 'acc_' . $sys;
        $hasFlags = array_key_exists('acc_chief', $row)
            || array_key_exists('acc_cpis', $row)
            || array_key_exists('acc_dash', $row);
        if ($hasFlags) {
            $any = (int) (isset($row['acc_chief']) ? $row['acc_chief'] : 0)
                + (int) (isset($row['acc_cpis']) ? $row['acc_cpis'] : 0)
                + (int) (isset($row['acc_dash']) ? $row['acc_dash'] : 0);
            if ($any > 0) {
                return isset($row[$flag]) && (int) $row[$flag] === 1;
            }
        }
        $s = isset($row['S_access']) ? trim($row['S_access'] . '') : '';
        return in_array($s, array('20', '23', '99'), true);
    }
}

if (!function_exists('pahneh_sys_from_post')) {
    function pahneh_sys_from_post()
    {
        return array(
            'acc_chief' => (!empty($_POST['acc_chief']) && $_POST['acc_chief'] !== '0') ? 1 : 0,
            'acc_cpis' => (!empty($_POST['acc_cpis']) && $_POST['acc_cpis'] !== '0') ? 1 : 0,
            'acc_dash' => (!empty($_POST['acc_dash']) && $_POST['acc_dash'] !== '0') ? 1 : 0,
        );
    }
}

if (!function_exists('pahneh_sys_select_sql')) {
    function pahneh_sys_select_sql()
    {
        return 'username, cod_m, Last_name, ostan, city, id_ostan, id_city, markaz, id_mar, name, jens, date_pas, password, psalt, id, Access, S_access, pic, perm, chief, acc_chief, acc_cpis, acc_dash';
    }
}

if (!function_exists('pahneh_sys_select_fallback_sql')) {
    function pahneh_sys_select_fallback_sql()
    {
        return 'username, cod_m, Last_name, ostan, city, id_ostan, id_city, markaz, id_mar, name, jens, date_pas, password, psalt, id, Access, S_access, pic, perm, chief';
    }
}

if (!function_exists('pahneh_sys_select_basic_sql')) {
    function pahneh_sys_select_basic_sql()
    {
        return 'username, cod_m, Last_name, ostan, city, id_ostan, id_city, markaz, id_mar, name, jens, date_pas, password, psalt, id, Access, S_access, pic';
    }
}

if (!function_exists('pahneh_sys_try_user_sql')) {
    function pahneh_sys_try_user_sql($dbh, $sql, $username)
    {
        $stmt = @$dbh->prepare($sql);
        if (!$stmt) {
            return false;
        }
        if (!$stmt->execute(array($username))) {
            return false;
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row : false;
    }
}

if (!function_exists('pahneh_sys_fetch_user')) {
    function pahneh_sys_fetch_user($dbh, $username)
    {
        if (!$dbh || $username === '') {
            return false;
        }
        pahneh_sys_ensure($dbh);
        $row = pahneh_sys_try_user_sql($dbh, 'SELECT ' . pahneh_sys_select_sql() . ' FROM users WHERE username = ? LIMIT 1', $username);
        if ($row) {
            return $row;
        }
        $row = pahneh_sys_try_user_sql($dbh, 'SELECT ' . pahneh_sys_select_fallback_sql() . ' FROM users WHERE username = ? LIMIT 1', $username);
        if ($row) {
            return $row;
        }
        return pahneh_sys_try_user_sql($dbh, 'SELECT ' . pahneh_sys_select_basic_sql() . ' FROM users WHERE username = ? LIMIT 1', $username);
    }
}

if (!function_exists('pahneh_sys_checkboxes_html')) {
    function pahneh_sys_checkboxes_html($acc_chief, $acc_cpis, $acc_dash)
    {
        $items = array(
            'acc_chief' => array($acc_chief, 'سامانه پهنه‌بندی (Chief)'),
            'acc_cpis' => array($acc_cpis, 'سامانه الگوی کشت (Cpis)'),
            'acc_dash' => array($acc_dash, 'داشبورد مدیریتی (dash)'),
        );
        $html = '<div class="pahneh-sys-access">';
        foreach ($items as $name => $item) {
            $checked = ((int) $item[0] === 1) ? ' checked="checked"' : '';
            $html .= '<label for="' . $name . '"><input type="checkbox" name="' . $name . '" id="' . $name . '" value="1"' . $checked . '> ' . $item[1] . '</label> ';
        }
        $html .= '</div>';
        return $html;
    }
}
