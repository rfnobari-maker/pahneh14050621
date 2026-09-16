           <table width="90%" height="97" border="1" align="center" cellpadding="0" cellspacing="0" >
           <tr align="center" class="style8">
    <td width="12%"  height="49" bgcolor="#CCCCCC">آی پی سیستم</td>
    <td width="8%"  bgcolor="#CCCCCC">ساعت</td>
    <td width="9%"  bgcolor="#CCCCCC">تاریخ</td>
    <td width="16%"  bgcolor="#CCCCCC">آدرس آماری آبادی</td>
    <td width="21%"  bgcolor="#CCCCCC">عملیات</td>
    <td  colspan="2"  bgcolor="#CCCCCC">مشخصات کاربر</td>
    <td width="4%"  bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
$username = $row['username'] ; 
$query2 = "SELECT * FROM  users  where username = $username " ;
$stmt2 = $dbh->prepare($query2);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
?>
    <td class="normalTextSmaller"><?php echo $row['ip'];?></td>
    <td class="normalTextSmaller"><?php echo $row['time'];?></td>
    <td class="normalTextSmaller"><?php echo $row['date'];?></td>
    <td class="normalTextSmaller"><?php echo abadi_name($row['add_abadi']).' '.$row['add_abadi'];?></td>
    <td class="normalTextSmaller"><?php echo $row['verb'];?></td>
    <td width="24%" class="normalTextSmaller"><?php echo $row2['Last_name'].' '.$row2['name'].' / '.$row2['city'].' - '.$row2['markaz'];?></td>
    <td width="6%" class="normalTextSmaller"><img src="../files/users/<?php echo $row2['pic'];?>" width="28" height="33"  alt=""/></td>
    <td><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
<?php 

$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if($id>1)
{
	echo "<a href='?id=".($id-1)."' class='button'>قبلی</a>";
}
if($id!=$total)
{
	echo "<a href='?id=".($id+1)."' class='button'>بعدی</a>";
}

echo "<ul class='page'>";
		for($i=1;$i<=$total;$i++)
		{
			if($i==$id) { echo "<li class='current'>".$i."</li>"; }
			
			else { echo "<li><a href='?id=".$i."'>".$i."</a></li>"; }
		}
echo "</ul>";
?>
</div>
          </p>
      
