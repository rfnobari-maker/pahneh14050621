<?php      
$status=unlink('users2.csv');    
if($status){  
echo "File deleted successfully";    
}else{  
echo "Sorry!";    
}  
?>  