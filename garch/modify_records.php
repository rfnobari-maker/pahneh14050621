<?php
include('../login/config.php') ;
if(isset($_POST['edit_row']))
{
 $id=$_POST['row_id'];
 $num_row=$_POST['num_row_val'];
 $num_t_row=$_POST['num_t_row_val'];
 $h_t=$_POST['h_t_val'];
 $w_t=$_POST['w_t_val'];
 $zer_kesh = $num_row * $num_t_row * $h_t * $w_t ; 
$query = "UPDATE user_detail SET num_row=?, num_t_row=? , h_t=? , w_t=? , zer_kesh=? WHERE id=?";
$q = $dbh->prepare($query);
$q->execute(array($num_row,$num_t_row,$h_t,$w_t,$zer_kesh,$id));
 echo "success";
 exit();
}

if(isset($_POST['delete_row']))
{
 $row_no=$_POST['row_id'];
$sql = "delete from user_detail where id=:id";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':id',$row_no, PDO::PARAM_INT);   
$stmt->execute();
 echo "success";
 exit();
}

if(isset($_POST['insert_row']))
{
 $num_row   =$_POST['num_row_val'];
 $num_t_row =$_POST['num_t_row_val'];
 $h_t       =$_POST['h_t_val'];
 $w_t       =$_POST['w_t_val'];
 $zer_kesh = $num_row * $num_t_row * $h_t * $w_t ; 
if ($num_row > 0 and $num_t_row!='' and $h_t !='' and $w_t != '' )
{
$query = "INSERT INTO user_detail (num_row,num_t_row,h_t,w_t,zer_kesh) VALUES (:num_row,:num_t_row,:h_t,:w_t,:zer_kesh)";
$q = $dbh->prepare($query);
$q->execute(array(':num_row'=>$num_row,':num_t_row'=>$num_t_row,':h_t'=>$h_t,':w_t'=>$w_t,':zer_kesh'=>$zer_kesh));
echo $order_id = $dbh->lastInsertId();
}
 exit();
}
?>