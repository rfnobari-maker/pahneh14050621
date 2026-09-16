<?php
$dsn = 'mysql:dbname=eagri_pahneh;host=172.17.18.43';
$user = 'eagri_upahneh';
$password = 'Reza9147857121';
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
//$query = "SELECT * from Pay_User";
//$stmt = $dbh->prepare($query);
//$stmt->execute();
// $row تک خطی 
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
//echo $row['User_Name'] ; 
// $row حلقه ای
// foreach($stmt as $row){
//    echo "User : " . $row['Last_Name'] . "<br />";
//}
// شمارش تعداد ردیف ها 
//echo 'Rows: '.$stmt -> rowCount();


//// insert 
//$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
//$title = 'PHP Security';
//$author = 'Jack Hijack';
//$query = "INSERT INTO books (title,author) VALUES (:title,:author)";
//$q = $dbh->prepare($query);
//$q->execute(array(':author'=>$author,':title'=>$title));


////update
//$title = 'PHP Pattern';
//$author = 'Imanda';
//$id = 3;
//$query = "UPDATE books 
//        SET title=?, author=?
//		WHERE id=?";
//$q = $dbh->prepare($query);
//$q->execute(array($title,$author,$id));


////delete
//$sql = "DELETE FROM movies WHERE filmID =  :filmID";
//$stmt =  $dbh->prepare($sql);
//$stmt->bindParam(':filmID', $_POST['filmID'], PDO::PARAM_INT);   
//$stmt->execute();
//

// clos conntection 
//$dbh = null;
?>
