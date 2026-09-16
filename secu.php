<?php 
function sec_mycod($value)
{
	$x= mysql_real_escape_string($valur);
//	$x= mysql_escape_string($valur);
	$y=htmlspecialchars($x);
	return $y ; 
	}
?>