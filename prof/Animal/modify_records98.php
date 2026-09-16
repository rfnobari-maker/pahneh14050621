<?php
include('../../login/config.php') ;
if(isset($_POST['edit_row']))
{
 $id=$_POST['row_id'];
 $num_row=$_POST['num_row_val'];
 $num_t_row=$_POST['num_t_row_val'];
 $h_t=$_POST['h_t_val'];
 $w_t=$_POST['w_t_val'];
 $num_spawn=$_POST['num_spawn_val'];
 $zer_kesh = $num_row * $num_t_row * $h_t * $w_t * $num_spawn ; 
$query = "UPDATE Mushroom_spawn SET num_row=?, num_t_row=? , h_t=? , w_t=? , num_spawn = ? , zer_kesh=? WHERE id=?";
$q = $dbh->prepare($query);
$q->execute(array($num_row,$num_t_row,$h_t,$w_t,$num_spawn,$zer_kesh,$id));
 echo "success";
 exit();
}

if(isset($_POST['delete_row']))
{
 $row_no=$_POST['row_id'];
$sql = "delete from Mushroom_spawn where id=:id";
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
 $num_spawn =$_POST['num_spawn_val'];
 $unit_id   =$_POST['unit_id_val'];
 $y_prod    =$_POST['y_prod_val'];
 $zer_kesh = $num_row * $num_t_row * $h_t * $w_t  * $num_spawn; 
if ($num_row > 0 & $num_t_row!='' & $h_t !='' & $w_t != '' & $num_spawn >= 1 )
{
$query = "INSERT INTO Mushroom_spawn (unit_id,y_prod,num_row,num_t_row,h_t,w_t,num_spawn,zer_kesh)
 VALUES (:unit_id,:y_prod,:num_row,:num_t_row,:h_t,:w_t,:num_spawn,:zer_kesh)";
$q = $dbh->prepare($query);
$q->execute(array(':unit_id'=>$unit_id,':y_prod'=>$y_prod,':num_row'=>$num_row,':num_t_row'=>$num_t_row,':h_t'=>$h_t,':w_t'=>$w_t,':num_spawn'=>$num_spawn,':zer_kesh'=>$zer_kesh));
echo $order_id = $dbh->lastInsertId();
}
 exit();
}
?>