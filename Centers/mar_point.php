<?php include('../lock_p2.php');
      include('../login/config.php');
      include('../event.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
-->
    </style>
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
  #img1
    {
	border-radius:40px ; 
	}

-->
</style>
<script src="http://api.mygeoposition.com/api/geopicker/api.js" type="text/javascript"></script>
    
    <script type="text/javascript">
        function lookupGeoData() {            
            myGeoPositionGeoPicker({
                startAddress     : 'Tabriz',
                returnFieldMap   : {
                                     'geoposition1a' : '<LAT>',
                                     'geoposition1b' : '<LNG>',
                                     'geoposition1c' : '<CITY>',   /* ...or <COUNTRY>, <STATE>, <DISTRICT>,
                                                                           <CITY>, <SUBURB>, <ZIP>, <STREET>, <STREETNUMBER> */
                                     'geoposition1d' : '<ADDRESS>'
                                   }
            });
        }
    </script>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
      <td>
       <?php include('top.php'); ?>

      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><?php include('../login/config.php');
$query = "SELECT * FROM  list_city WHERE  id_mar = $id_mar" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p>ثبت و ویراش مختصات مرکز </p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <form id="form1" name="form1" method="post" action="">
           <div style="box-shadow:10px 10px 5px #CCC ; width:57%; border-width:1px; margin:auto ; border-radius:25px">
             <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
               <tr>
                 <td width="33%" rowspan="2"><button  type="button"  onclick="lookupGeoData();"><img src="../files/maps.png" width="30" height="31"  alt=""/></button>
                   <p class="normalTextSmall">درج مختصات از نقشه  </p></td>
                 <td width="40%" height="77"><input type="text" name="lat" id="geoposition1a" size="30" style="width:200px ; height:35px" /></td>
                 <td width="27%"><div style="margin-right:15px" align="right" >:عرض جغرافیایی</div></td>
               </tr>
               <tr>
                 <td height="77"><input type="text" name="lng" id="geoposition1b" size="30" style="width:200px ; height:35px" /></td>
                 <td ><div style="margin-right:15px" align="right" >:طول جغرافیایی</div></td>
               </tr>
               <tr>
                 <td height="44"><a href="map_help.html" target="_blank"  class="LinkRedTitle"> آموزش نحوه استفاده<img src="../files/jadid.gif" width="35" height="15"  alt=""/></a></td>
                 <td><input type="submit" name="action" value="ثبت اطلاعات " style="width:150px ; height:45px"/></td>
                 <td><p>&nbsp;</p>
                   <p>&nbsp;</p></td>
               </tr>
             </table>
             </div>
           </form>
           <p>&nbsp;</p>
           <p>&nbsp;</p>
           <p> <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>
<?php
if (isset($_POST['lat']) & isset($_POST['lng']))
{
 $lng = $_POST['lng'] ;
 $lat = $_POST['lat'] ;
 $id_mar ;
 $mar = $markaz ;
 $type = 'mar' ;
 $id_city = $mor_id_city ; 
$query = "SELECT id_mar from markers where id_mar = $id_mar";
$stmt = $dbh->prepare($query);
$stmt->execute();
$mar_count = $stmt -> rowCount();
if ($mar_count==0)
{
$query = "INSERT INTO markers  (id_mar,mar,lat,lng,type,id_city) VALUES (:id_mar,:mar,:lat,:lng,:type,:id_city)";
$q = $dbh->prepare($query);
$q->execute(array(':id_mar'=>$id_mar,':mar'=>$mar,':lat'=>$lat,':lng'=>$lng,':type'=>$type,':id_city'=>$id_city));
alert('مختصات مرکز با موفقیت ثبت شد ') ;
}
else 
{
$query = "UPDATE markers
        SET lat=?, lng=?
		WHERE id_mar=?";
$q = $dbh->prepare($query);
$q->execute(array($lat,$lng,$id_mar));	
alert('مختصات مرکز با موفقیت بروز شد ') ;
}
}
?>
