<? include('../login/config.php');
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<p>
        <input type=hidden name=todo value=change-password>
  </p>
<table width="500" border='0' align="center" cellpadding='0' cellspacing='0'>
    <tr bgcolor='#f1f1f1' >
      <td height="40" colspan='2' align='center' bgcolor="#FFFFCC"><font size="2" class="style1">تعیین معیار جستجو </font></td>
    </tr>
    <tr bgcolor='#f1f1f1' >
      <td height="45" bgcolor="#FFFFFF" class="input_text" align="right" >
      <form name="form1" method="post" >
      <select dir="rtl"  name="id_city" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()"> >
      <option value="0"> شهرستان</option>
        <?php
$id_ostan = '03' ;
$query = "SELECT DISTINCT id_city,city FROM list_abadi WHERE  id_ostan = $id_ostan"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
        <option value="<? echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <? echo $row['city'] ;?></option>
        <?php }?>
      </select>
      </form>
<? if (isset($_POST['id_city']))
 $id_city = $_POST['id_city'] ; 
?>

      </td>
      <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2"> :شهرستان</font></td>
    </tr>
    <tr >
      <td height="74" bgcolor="#f1f1f1" class="input_text" align="right" >
      <form name="form2" method="post" >
      <select dir="rtl"  name="id_mar" id="bakh" style="width:170px ; height:40px"  onchange="this.form.submit()"> >
      <option value="0"> مرکز</option>
        <?php
$query = "SELECT DISTINCT id_mar,mar FROM list_abadi WHERE  id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
        <option value="<? echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <? echo $row['mar'] ;?></option>
        <?php }?>
      </select>
      <input name="id_city" type="hidden" value="<?php echo $id_city ;?>">
      </form>
<? if (isset($_POST['id_mar']))
 $id_mar = $_POST['id_mar'] ; 
?>
</td>
      <td width="163"  align='center' bgcolor="#F1F1F1" class="style1"><font size="2">: مرکز خدمات</font></td>
    </tr>
    <tr >
      <td height="23" rowspan="2" align="right" bgcolor="#FFFFFF" class="input_text" >    
        <form name="form3" method="post" >
        <p>
          <select dir="rtl"  name="id_deh" id="id_deh" style="width:170px ; height:40px" >
            <option value="0">کلیه دهستان ها</option>
            <?php
$query = "SELECT DISTINCT add_deh,deh FROM  list_abadi WHERE  id_mar = $id_mar"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<? echo $row['add_deh'] ;?>"
   <?php if ($row['add_deh']==$add_deh) echo 'selected=selected'?>> <? echo $row['deh'] ;?></option>
            <?php }?>
          </select>
        </p>
        <p>
      <input name="id_city" type="hidden" value="<?php echo $id_city ;?>">
      <input name="id_mar" type="hidden"  value="<?php echo $id_mar ;?>">
      <input type="reset"  value='پاک کردن' style="width:150px ; height:45px" />
      <input type="submit" name="action" value='جستجو' style="width:150px ; height:45px" />
        </p>
      </form>
</td>
      <td height="47"  align='center' bgcolor="#FFFFFF" class="style1"> : دهستان</td>
    </tr>
    <tr >
      <td height="29"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
    </tr>
  </table>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>

  <?php if(isset($_POST['action']))
{
echo $id_city = $_POST['id_city'] ; 
echo '<P>' ;
echo $id_mar = $_POST['id_mar'] ; 
echo '<P>' ;
echo $add_deh = $_POST['id_deh'] ; 
echo '<P>' ;
if ($id_city == 0) { $v_id_city = 'id_city=id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar=id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($add_deh == 0) { $v_add_deh = 'add_deh=add_deh' ;} else { $v_add_deh = "add_deh='$add_deh'" ;}
echo $query = "SELECT * FROM  list_abadi where  id_ostan = '$id_ostan' and  $v_id_city and $v_id_mar  and $v_add_deh  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
}
?>
