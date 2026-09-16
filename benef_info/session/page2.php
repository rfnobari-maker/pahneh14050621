<?php 
session_start();
if(isset($_SESSION['userName'])) {
  echo "Your username is :  " . $_SESSION['userName'];
}
else 
{
	echo 'you are news users' ;
	}
?>
<p>
<a href="<?php echo $_SESSION['userName']?>">back</a>
</p>