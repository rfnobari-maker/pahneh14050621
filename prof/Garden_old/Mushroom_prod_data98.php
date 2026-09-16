 <!--
<script type="text/javascript" src="../../15_files/jquery.js"></script>
<script type="text/javascript" src="modify_records98.js"></script> 
-->
<div id="wrapper">
<?php
//include_once('../../login/config.php') ;
//$unit_id = 27 ; 
//$y_prod = '1397';
$query = "SELECT * FROM Mushroom_spawn where unit_id =? and y_prod=? order by id";
$stmt = $dbh->prepare($query);
$stmt->execute(array($unit_id,$y_prod));
?>
<table width="815" border="1" align="center" cellpadding="10" cellspacing="0" dir="rtl" id="user_table">
<tr>
  <th width="70" bgcolor="#FFFF99">تعداد ردیف</th>
  <th width="77" bgcolor="#FFFF99">تعداد طبقه در هر ردیف</th>
  <th width="79" bgcolor="#FFFF99">طول هر طبقه <br>
    <span class="style2">متر</span></th>
  <th width="76" bgcolor="#FFFF99">عرض هر طبقه <br>
    <span class="style2">متر</span></th>
  <th width="93" bgcolor="#FFFF99">تعداد سالن موجود با این مشخصات</th>
  <th width="54" bgcolor="#FFFF99">سطح زیر کشت <br>
    <span class="style2">مترمربع</span></th>
  
  <th width="210" bgcolor="#FFFF99">عملیات</th>
</tr>
<?php
 foreach($stmt as $row)
{
 ?>
 <tr id="row<?php echo $row['id'];?>">
  <td align="center" id="num_row_val<?php echo $row['id'];?>"><?php echo $row['num_row'];?></td>
  <td align="center" id="num_t_row_val<?php echo $row['id'];?>"><?php echo $row['num_t_row'];?></td>
  <td align="center" id="h_t_val<?php echo $row['id'];?>"><?php echo $row['h_t'];?></td>
  <td align="center" id="w_t_val<?php echo $row['id'];?>"><?php echo $row['w_t'];?></td>
  <td align="center" id="num_spawn_val<?php echo $row['id'];?>"><?php echo $row['num_spawn'];?></td>
  <td align="center" id="zer_kesh_val<?php echo $row['id'];?>"><?php echo $row['zer_kesh']?></td>
  <td align="center">
   <input type='button' class="add edit_button"  id="edit_button<?php echo $row['id'];?>" value="ویرایش" onclick="edit_row('<?php echo $row['id'];?>');">
   <input type='button' class="add save_button"   id="save_button<?php echo $row['id'];?>" value="ذخیره" onclick="save_row('<?php echo $row['id'];?>');">
   <input type='button' class="add delete_button" id="delete_button<?php echo $row['id'];?>" value="حذف" onclick="delete_row('<?php echo $row['id'];?>');">
  </td>
 </tr>
 <?php
}
?>
<tr id="new_row">
 <td><input type="text"  id="new_num_row"   style="width:70px; height:30px ; "></td>
 <td><input type="text"  id="new_num_t_row" style="width:70px; height:30px ; "></td>
 <td><input type="text"  id="new_h_t"       style="width:70px; height:30px ; "></td>
 <td><input type="text"  id="new_w_t"       style="width:70px; height:30px ; "></td>
 <td><input type="text"  id="new_num_spawn"  min="1" style="width:70px; height:30px ; "></td>
 <td bgcolor="#CCCCCC">&nbsp;</td>
 <td><input type="button" value="ذخیره اطلاعات سالن" class="add" id="add" onclick="insert_row(<?php echo $unit_id.','.$y_prod ?>);"></td>
</tr>
</table>
</div>
<script>
$('.add').click(function() {
	$('#zer_kesh9').val('');
	$('#tol_avg').val('');
});
</script>
