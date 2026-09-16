<?php include ('../lock_p3.php')  ;
include ('../login/config.php');
?>
<meta charset="utf-8">
<div style=" width: 450px; padding: 15px;border: 3px solid navy; margin:auto" >
<form action='' method="post">
      <p>
        <input type=hidden name=todo value=change-password>
      </p>
              <table width="415" border='0' align=center cellpadding='0' cellspacing='0'>
        <tr bgcolor='#f1f1f1' > <td height="40" colspan='2' align='center' bgcolor="#FFFFCC"><font size="2">تعیین محدوده جستجو </font></td> 
        </tr>
<tr >
  <td width="252" height="48" bgcolor="#F1F1F1" align="right" >
    <select  dir="rtl" name="mar" id="mar" style="width:150px ; height:40px" />
    <option value="0">تمامی مراکز شهرستان</option>
<?php
$query = "SELECT DISTINCT id_mar,mar FROM  list_abadi WHERE  id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
    <option value="<? echo $row['id_mar'] ;?>"><? echo $row['mar'] ;?></option>
<?php }?>
  </select></td>
  <td width="163"  align='center' bgcolor="#F1F1F1" class="style1"><font size="2">: مرکز خدمات</font></td>
</tr>
<tr bgcolor='#f1f1f1' >
  <td height="45" bgcolor="#FFFFFF" class="input_text" align="right" >
  <select dir="rtl"  name="bakh" id="bakh" style="width:150px ; height:40px" />
    <option value="0">کلیه بخش های شهرستان</option>
  <?php
$query = "SELECT DISTINCT add_bakh,bakh FROM  list_abadi WHERE  id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
    <option value="<? echo $row['add_bakh'] ;?>"><? echo $row['bakh'] ;?></option>
<?php }?>
  </select></td>
  <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2"> :بخش</font></td>
</tr>
<tr bgcolor='#f1f1f1' >
  <td height="45" class="input_text" align="right" >
    <select dir="rtl"  name="deh" id="deh" style="width:150px ; height:40px" />
    <option value="0">کلیه دهستان ها</option>
  <?php
$query = "SELECT DISTINCT add_deh,deh FROM  list_abadi WHERE  id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
    <option value="<? echo $row['add_deh'] ;?>"><? echo $row['deh'] ;?></option>
<?php }?>

  </select></td>
  <td  align='center' class="style1"><font size="2"> :دهستان  </font></td>
</tr>
<tr bgcolor='#ffffff' > <td colspan=2 align=center><p>&nbsp;
  </p>
  <p>
    <input type=reset value='پاک کردن ' style="width:150px ; height:45px" >
    <input type=submit name="action" value='جستجو' style="width:150px ; height:45px" />
  </p>  </font></td></tr>
</table>
</form>
</div>

<?php if(isset($_POST['action']))
{
$mar = $_POST['mar'] ; 
$bakh = $_POST['bakh'] ; 
$deh = $_POST['deh'] ; 
if ($mar <>'0') $where = "mar = ' ".$mar. "'" ;
if ($mar <>'0' and $bakh <>'0') $where = $where. " and " ; 
if ($bakh <>'0') $where = $where. " bakh ='" .$bakh ."'" ;
if ($bakh <>'0' and $deh <>'0') $where = $where. " and " ; 
if ($deh <>'0') $where = $where. " deh = ' ".$deh."'" ;
echo $where ; 
	}
?>
