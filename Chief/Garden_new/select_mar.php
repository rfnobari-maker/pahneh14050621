<?php
include ('../../login/config.php');
if($_POST['cod_m'])
{

$cod_m=$_POST['cod_m'];
$query = "SELECT  m_name,m_last_name,m_tel_m,m_fname,m_addres FROM `malek` WHERE  `m_cod_m` = '$cod_m'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
if ($stmt -> rowCount() <> 0)
{
foreach($stmt as $row){
?>
<script>
document.getElementById('m_name').value = "<?php echo $row['m_name']?>";
document.getElementById('m_last_name').value = "<?php echo $row['m_last_name']?>";
document.getElementById('m_fname').value = "<?php echo $row['m_fname']?>";
document.getElementById('m_tel_m').value = "<?php echo $row['m_tel_m']?>";
document.getElementById('m_addres').value = "<?php echo $row['m_addres']?>";
</script>
 <option value="1"
   <?php if ($row['jens']=='1') echo 'selected=selected'?>>مرد</option>
 <option value="2"
   <?php if ($row['jens']=='2') echo 'selected=selected'?>>زن</option>
   <?php

}
}
else 
{
$query = "SELECT  name,last_name,tel_m,fname FROM `bah` WHERE  `bah_cod_m` = '$cod_m'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
if ($stmt -> rowCount() == 0)
{
?>
<?php
echo   'اطلاعات مالک یافت نشد ' ;
?>
 <option value="">انتخاب کنید</option>
 <option value="1">مرد</option>
 <option value="2">زن</option>
<?php
}
else 
{
foreach($stmt as $row){
?>
<script>
document.getElementById('m_name').value = "<?php echo $row['name']?>";
document.getElementById('m_last_name').value = "<?php echo $row['last_name']?>";
document.getElementById('m_fname').value = "<?php echo $row['fname']?>";
document.getElementById('m_tel_m').value = "<?php echo $row['tel_m']?>";
</script>
 <option value="1"
   <?php if ($row['jens']=='1') echo 'selected=selected'?>>مرد</option>
 <option value="2"
   <?php if ($row['jens']=='2') echo 'selected=selected'?>>زن</option>
   <?php

}
}
}
}
?>