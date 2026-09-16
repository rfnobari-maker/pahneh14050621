<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$mor_cod_m  = $_POST['mor_cod_m'] ;
?>
<form name="test" method="post" > 
  <p>
    <input type="text" name="mor_cod_m" id="mor_cod_m" value="<?php echo $mor_cod_m?>">
: کد ملی کارشناس </p>
  <p>
    <input type="text" name="bah_cod_m1" id="bah_cod_m1">
  : کد ملی نادرست</p>
  <p>
    <input type="text" name="bah_cod_m2" id="bah_cod_m2">
: کد ملی درست</p>
  <p>
    <input type="submit" name="action" id="btn1" >
  </p>
</form>
<?php
if (isset($_POST['action'])) 
{ 
$mor_cod_m  = $_POST['mor_cod_m'] ;
$bah_cod_m1 = $_POST['bah_cod_m1'] ;
$bah_cod_m2 = $_POST['bah_cod_m2'] ;

$query = "SELECT bah_cod_m from bah where bah_cod_m = $bah_cod_m1";
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt -> rowCount();
if ($count == 0) 
  {
  alert('بهره بردار با این کد ملی یافت نشد') ;
  }
   else 
  {
$query = "SELECT mor_cod_m from bah where bah_cod_m = $bah_cod_m1 and  mor_cod_m = $mor_cod_m";
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt -> rowCount();
if ($count == 0) 
{
  alert('کارشناس مروج ثبت کننده اطلاعات درست نیست') ;
  }
 else 
 {
$query = "UPDATE bah,bee,unknown_bee,Agri,Agri1394-1395,Garden,Garden_prod,Agri_prod,Agri_prod1394-1395,Aquatic,Greenhous,malek
         SET 
		 bah.bah_cod_m =$bah_cod_m2,bah.ok='2' ,
		 bee.bah_cod_m =$bah_cod_m2 ,
		 unknown_bee.bah_cod_m =$bah_cod_m2 ,
		 Agri.bah_cod_m =$bah_cod_m2 ,
		 Agri1394-1395.bah_cod_m =$bah_cod_m2 ,
		 Garden.bah_cod_m =$bah_cod_m2 ,
		 Garden_prod.bah_cod_m =$bah_cod_m2 ,
		 Agri_prod.bah_cod_m =$bah_cod_m2 ,
		 Agri_prod1394-1395.bah_cod_m =$bah_cod_m2 ,
		 Aquatic.bah_cod_m =$bah_cod_m2 ,
		 Greenhous.bah_cod_m =$bah_cod_m2 ,
		 malek.bah_cod_m =$bah_cod_m2 ,
	 WHERE 
	 bah.bah_cod_m                = $bah_cod_m1  and 
	 bee.bah_cod_m                = $bah_cod_m1  and 
	 unknown_bee.bah_cod_m        = $bah_cod_m1  and 
	 Agri.bah_cod_m               = $bah_cod_m1  and 
 	 Agri1394-1395.bah_cod_m      = $bah_cod_m1  and 
	 Garden.bah_cod_m             = $bah_cod_m1  and 
	 Garden_prod.bah_cod_m        = $bah_cod_m1  and 
	 Agri_prod.bah_cod_m          = $bah_cod_m1  and 
	 Agri_prod1394-1395.bah_cod_m = $bah_cod_m1  and 
	 Aquatic.bah_cod_m            = $bah_cod_m1  and 
	 Greenhous.bah_cod_m          = $bah_cod_m1  and 
	 malek.bah_cod_m              = $bah_cod_m1  " ;
$q = $dbh->prepare($query);
$q->execute();
$query = "DELETE FROM
      bah, Agri,Agri1394-1395,Agri_prod,Agri_prod1394-1395,bee,unknown_bee,Aquatic,Garden,Garden_prod,Greenhous,malek
USING bah, Agri,Agri1394-1395,Agri_prod,Agri_prod1394-1395,bee,unknown_bee,Aquatic,Garden,Garden_prod,Greenhous,malek
WHERE bah.bah_cod_m = Agri.bah_cod_m AND
      Agri.bah_cod_m = Agri1394-1395.bah_cod_m AND
      Agri1394-1395.bah_cod_m = Agri_prod.bah_cod_m AND
      Agri_prod.bah_cod_m = Agri_prod1394-1395.bah_cod_m AND
      Agri_prod1394-1395.bah_cod_m = bee.bah_cod_m AND
      bee.bah_cod_m = unknown_bee.bah_cod_m AND
      unknown_bee.bah_cod_m = Aquatic.bah_cod_m AND
      Aquatic.bah_cod_m = Garden.bah_cod_m AND
      Garden.bah_cod_m = Garden_prod.bah_cod_m AND
      Garden_prod.bah_cod_m = Greenhous.bah_cod_m AND
      Greenhous.bah_cod_m = malek.bah_cod_m AND
      malek.bah_cod_m  = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$dbh = null;
alert('تمام');
}
}
}
?>