<?php include('lock_lice.php');
    include('pageurl.php') ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>لیست درخواست ها : سازمان نظام مهندسی کشاورزی و منابع طبیعی استان</title>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="files/PLogo.jpg" width="949" height="152" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >  
 <table width="100%" border="0">
   <tr>
     <td>
  <p>
    <?php include ("farsidigit.php") ; ?>
  </p>
  <span class="style1">درخواست های ثبت شده </span></p>
  <p><img src="files/horizontal-line-700x223.png" width="700" height="19"  alt=""/> </p>
    <p align="center" ><a href="manager_request4.php"  title="مشاهده درخواست های دامداری روستایی"><img src="files/vil.jpg" width="106" height="87" /></a><a href="manager_request3.php"  title="مشاهده درخواست های شیلات"><img src="files/fish.jpg" width="130" height="90" /></a><a href="manager_request2.php"  title="مشاهده درخواست های طیور"><img src="files/pol.jpg" width="108" height="103"  border="0"/></a><a href="manager_request1.php" title="مشاهده درخواست های دامداری صنعتی"><img src="files/ani.jpg" width="89" height="90" border="0" /></a></p>
<p align="center">
<?php
   $v_city = "city = '$city'" ;
if(isset($v_city)) 
 {
       // connect to the database 
        include('login/config.php');
$query = "SELECT cod_p,city,date_s,no_bah,no_dar,m_hadaf,f_no,name,last_name FROM dar_ani
      where $v_city and status='1'
	  union All 
	  SELECT cod_p,city,date_s,no_bah,no_dar,m_hadaf,f_no,name,last_name FROM dar_fish
      where $v_city and status='1'
	  union All 
	  SELECT cod_p,city,date_s,no_bah,no_dar,m_hadaf,f_no,name,last_name FROM dar_vil
      where $v_city and status='1'
	  union All 
	  SELECT cod_p,city,date_s,no_bah,no_dar,m_hadaf,f_no,name,last_name FROM dar_pol
      where $v_city and status='1' ORDER BY date_s DESC";
$stmt = $dbh->prepare($query);
$stmt->execute();
$check2 = $stmt -> rowCount();
if ($check2 == 0)
 {
echo 'درخواستی یافت نشد ' ; 
?>
    <p>&nbsp; </p>
    <p>&nbsp;</p>
    <p><a href="index.php" title="برگشت "><img src="files/goback.jpg" width="128" height="57"  border="0"/></a> </p>
           <p align="center" class="style9">&nbsp;</p>
           <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><p class="MenuItemRight">Copyright © 2014, سازمان نظام مهندسی کشاورزی و منابع طبیعی استان آذربایجان شرقی All Rights Reserved.</p>
      <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</td>
</table>
</body>
</html>
             <?php
exit ; 
}
?>
             <?php 	  echo "تعداد درخواست يافت شده  : ". farsidigit($check2) . " مورد" ; ?>
</tr>
<tr></tr>
           <p>&nbsp;</p>
           <tr>
      <table  with='75%' border='1' cellpadding='10' cellspacing='0' bgcolor='#FFFFFF' align='center' dir='rtl' bordercolor="#006699">
      <tr><th>تاریخ</th> <th>بهره برداری </th> <th>نوع درخواست</th> <th>مجوز هدف</th><th>نام</th> <th>نام خانوادگی</th><th colspan=7>عمليات</th></tr> 
 <?php
  foreach($stmt as $row)
 {
                 echo "<tr>"; 
             ?>
				  <?php
				echo '<td>' . $row['date_s'] . '</td>'; 
               echo '<td align="center" >' .$row['no_bah'];  '</td>'; 
               echo '<td align="center" >' .$row['no_dar'];  '</td>'; 
               echo '<td align="center" >' .$row['m_hadaf'];  '</td>'; 
                echo '<td align="center" >' .$row['name'];  '</td>'; 
                echo '<td align="center" >' .$row['last_name'];  '</td>'; 
              ?>
             <td><form  action="view.php" method="post">
             <input type="hidden" name="cod_p" value="<?php echo $row['cod_p'] ;?>" />
             <input type="hidden" name="no_bah" value="<?php echo $row['no_bah'] ;?>" />
             <input type="hidden" name="previous" value="<?php echo curPageURL()?>">
             <button><img src="files/view.png" border="0" title=" مشاهده درخواست " width="20" height="20"></button>
             </form></td>
          <td><form  action="edit.php" method="post">
             <input type="hidden" name="cod_p" value="<?php echo $row['cod_p'] ;?>" />
             <input type="hidden" name="no_bah" value="<?php echo $row['no_bah'] ;?>" />
             <input type="hidden" name="previous" value="<?php echo curPageURL()?>">
             <button><img src="files/edit.png" border="0"  title="ويرايش درخواست" width="20" height="20" ></button>
             </form></td>
          <td><form action="request_del1.php" method="post">
             <input type="hidden" name="cod_p" value="<?php echo $row['cod_p'] ;?>" />
             <input type="hidden" name="no_bah" value="<?php echo $row['no_bah'] ;?>" />
             <button onclick="return confirm('از حذف درخواست مطمئن هستید ؟ ')"><img src="files/del1.png" border="0"  title="حذف درخواست" width="20" height="20" ></button>
             </form></td>
         <?php   if ($row['no_bah']=='روستایی') $sendpage = "up_document_r"; else $sendpage = "up_document_e" ; ?>
          <td><form  action="upload/<?php echo $sendpage ;?>.php" method="post">
             <input type="hidden" name="cod_p" value="<?php echo $row['cod_p'] ;?>" />
             <input type="hidden" name="no_bah" value="<?php echo $row['no_bah'] ;?>" />
              <input type="hidden" name="previous" value="<?php echo curPageURL()?>">
             <button><img src="files/attachment.jpg" border="0"  title="مشاهده و پیوست مدارک" width="20" height="20" ></button             ></form></td>
          <td><form  action="chain_request.php" method="post">
             <input type="hidden" name="cod_p" value="<?php echo $row['cod_p'] ;?>" />
             <input type="hidden" name="no_bah" value="<?php echo $row['no_bah'] ;?>" />
             <input type="hidden" name="previous" value="<?php echo curPageURL()?>">
             <button><img src="files/refresh.jpg" border="0"  title="مشاهده گردش درخواست" width="20" height="20" ></button>
             </form></td>
       <td><form  action="gmaps.php" method="post">
             <input type="hidden" name="cod_p" value="<?php echo $row['cod_p'] ;?>" />
             <input type="hidden" name="no_bah" value="<?php echo $row['no_bah'] ;?>" />
             <input type="hidden" name="previous" value="<?php echo curPageURL()?>">
             <button><img src="files/maps.png" border="0"  title="موقعیت محل بر روی نقشه" width="20" height="20" ></button>
             </form></td>
          <td><form  action="send_request.php" method="post">
             <input type="hidden" name="cod_p" value="<?php echo $row['cod_p'] ;?>" />
             <input type="hidden" name="no_bah" value="<?php echo $row['no_bah'] ;?>" />
             <button><img src="files/coniform.png" border="0"  title="تائید و ارسال درخواست" width="20" height="20"></button>
             </form></td>
		  <p>
				    <?php
	      echo "</tr>";  
        }  
        echo "</table>"; 
		$dbh = null;
?>
				    </p>
		       </p>
				  <p>&nbsp;   </p>
				  <table width="850" border="0" align="center">
                 <tr>
                   <td><div align="right">
                                  </div></td>
          </tr>
               </table>
   <p> <a href="index.php" title="برگشت "><img src="files/goback.jpg" width="128" height="57" /></a> </p>                    </td>
           </tr>
</p>
              <?php
		}
?>    
  
  </tr>
    <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><p class="MenuItemRight">Copyright © 2014, سازمان نظام مهندسی کشاورزی و منابع طبیعی استان آذربایجان شرقی All Rights Reserved.</p>
      <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</td>
</table>
</body>
</html>