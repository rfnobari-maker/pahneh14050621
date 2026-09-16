<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    echo '<form name="fwd" method="post" action="Agri.php">';
    foreach ($_POST as $key => $value) {
        if (is_array($value)) continue;
        echo '<input type="hidden" name="' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '" value="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '"/>';
    }
    echo '</form>';
    echo '<script type="text/javascript">document.fwd.submit();</script>';
    exit;
}
header('Location: Agri.php');
exit;
