<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    echo '<form name="fwd" method="post" action="Garden_edit.php">';
    foreach ($_POST as $key => $value) {
        if (is_array($value)) continue;
        echo '<input type="hidden" name="' . htmlspecialchars($key, ENT_QUOTES, 'UTF-8') . '" value="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '"/>';
    }
    if (!isset($_POST['garden_edit_step']) && !(isset($_POST['garden_step']) && $_POST['garden_step'] == '1')) {
        echo '<input type="hidden" name="garden_edit_step" value="2"/>';
    }
    echo '</form>';
    echo '<script type="text/javascript">document.fwd.submit();</script>';
    exit;
}
header('Location: Garden_edit.php');
exit;
