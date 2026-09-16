<?php
session_start() ;
if(isset($_SESSION['test'])) {
echo 'username is :' . $_SESSION['test']['username'];
echo '<p>' ;
echo 'your age is :' . $_SESSION['test']['age'];
}
else 
{
	echo 'you are news users' ;
	}
?>
<?php if (isset($_SESSION['test']))
{
echo '<p>' ;
?>
<a href="<?php echo $_SESSION['test']['page_url']?>">back</a>
<p>
<a href="<?php unset($_SESSION['test']) ;?>">unset session</a>
<p>
<a href="test3.php">test3</a>
<?php 
}
?>