<?php
include ('../../login/config.php');
if ($_POST['group_cod']) {
    $group_cod = $_POST['group_cod'];
    $query = "SELECT product_cod, product_name FROM `product_z` WHERE `group_cod` = '$group_cod' AND product_cod NOT IN ('222', '486', '248', '220', '494', '226', '170', '172', '174')";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
?>
    <option value="" selected="selected">انتخاب محصول</option> 
<?php
    foreach ($stmt as $row) {
?>
        <option value="<?php echo $row['product_cod']; ?>">
            <?php echo $row['product_name']; ?>
        </option>
<?php
    }
}
?>
