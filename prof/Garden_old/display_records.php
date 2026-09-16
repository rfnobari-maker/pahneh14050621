<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>اطلاعات سالن ها</title>
<script type="text/javascript" src="../../15_files/jquery.js"></script>
<script type="text/javascript" src="../../garch/modify_records.js"></script>
</head>
<body>
<div id="wrapper">

<?php
include_once('../../login/config.php') ;
$query = "SELECT * FROM user_detail order by id";
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<table width="700" border="1" align="center" cellpadding="10" cellspacing="0" dir="rtl" id="user_table">
<tr>
  <th colspan="6" bgcolor="#CCFF66">مشخصات قفسه بندی سالن ها</th>
  </tr>
<tr>
<th width="70" bgcolor="#FFFF99">تعداد ردیف</th>
<th width="77" bgcolor="#FFFF99">تعداد طبقه در هر ردیف</th>
<th width="79" bgcolor="#FFFF99">ارتفاع هر طبقه /متر</th>
<th width="76" bgcolor="#FFFF99">عرض هر طبقه / متر</th>
<th width="93" bgcolor="#FFFF99">سطح زیر کشت سالن /
  مترمربع</th>

<th width="171">عملیات</th>
</tr>
<?php
 foreach($stmt as $row)
{
 ?>
 <tr id="row<?php echo $row['id'];?>">
  <td align="center"  id="num_row_val<?php echo $row['id'];?>"><?php echo $row['num_row'];?></td>
  <td align="center" id="num_t_row_val<?php echo $row['id'];?>"><?php echo $row['num_t_row'];?></td>
  <td align="center" id="h_t_val<?php echo $row['id'];?>"><?php echo $row['h_t'];?></td>
  <td align="center" id="w_t_val<?php echo $row['id'];?>"><?php echo $row['w_t'];?></td>
  <td align="center" id="zer_kesh_val<?php echo $row['id'];?>"><?php echo $row['zer_kesh']?></td>
  <td align="center">
   <input type='button' class="edit_button" id="edit_button<?php echo $row['id'];?>" value="ویرایش" onclick="edit_row('<?php echo $row['id'];?>');">
   <input type='button' class="save_button" id="save_button<?php echo $row['id'];?>" value="ذخیره" onclick="save_row('<?php echo $row['id'];?>');">
   <input type='button' class="delete_button" id="delete_button<?php echo $row['id'];?>" value="حذف" onclick="delete_row('<?php echo $row['id'];?>');">
  </td>
 </tr>
 <?php
}
?>
<tr id="new_row">
 <td><input type="text" id="new_num_row" style="width:70px; height:30px ; "></td>
 <td><input type="text" id="new_num_t_row" style="width:70px; height:30px ; "></td>
 <td><input type="text" id="new_h_t" style="width:70px; height:30px ; "></td>
 <td><input type="text" id="new_w_t" style="width:70px; height:30px ; "></td>
 <td bgcolor="#CCCCCC">&nbsp;</td>
 <td><input type="button" value="اضافه کردن سالن جدید" onclick="insert_row();"></td>
</tr>
</table>

</div>
</body>
</html>