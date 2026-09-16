<?php
include('../lock_p1.php');
include ('../event.php');
?>

<!-- لودینگ -->
<div id="loading" style="display:none;">
    <div class="spinner"></div>
    در حال بروزرسانی اطلاعات آبادی های تحت پوشش شما هستم ، لطفاً صبر کنید...
</div>

<!-- استایل لودینگ -->
<style>
#loading {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    font-size: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner {
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top: 4px solid white;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
// نمایش لودینگ هنگام ارسال فرم
document.querySelector('form[name="test"]').onsubmit = function() {
    document.getElementById('loading').style.display = 'flex';  // نمایش لودینگ
};

// اگر عملیات PHP تمام شد، لودینگ را پنهان کنیم
function hideLoading() {
    document.getElementById('loading').style.display = 'none';  // مخفی کردن لودینگ
}
</script>

<form name="test" method="post" > 
  <p>
  <input type="text" name="mor_cod_m" width="75px">
  : کد ملی مروج  </p>
  <p>
    <input type="submit" name="action" id="btn1" >
  </p>
</form>
<?php
if (isset($_POST['action'])) 
{ 
$mor_cod_m = $_POST['mor_cod_m'];
    include ('login/config.php');
 $query = " SELECT add_abadi,mor_cod_m,id_mar,id_city,id_ostan  FROM list_abadi where mor_cod_m = '$mor_cod_m'  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();

foreach($stmt as $row){

$add_abadi = $row['add_abadi'] ;
$mor_cod_m = $row['mor_cod_m'] ;
$id_mar    = $row['id_mar'] ;
$id_city   = $row['id_city'] ;
$id_ostan   = $row['id_ostan'] ;

//alert($add_abadi) ; 
include ('login/config.php');
$query = "UPDATE bah SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));


$query = "UPDATE Agri1397_1398 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1398_1399 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1399_1400 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1400_1401 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1402_1403 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1401_1402 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1402_1403 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1403_1404 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1404_1405 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri1405_1406 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));


$query = "UPDATE Agri_prod1397_1398 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1398_1399 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1399_1400 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1400_1401 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1401_1402 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1402_1403 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1403_1404 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1404_1405 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Agri_prod1405_1406 SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));


$query = "UPDATE Garden SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Garden_prod SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Greenhous SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Greenhous_prod SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Greenprod_annual SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));


$query = "UPDATE Aquatic SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE bee SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE unknown_bee SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Vege SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Vege_prod SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Aquatic SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Mushroom SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));

$query = "UPDATE Mushroom_prod SET mor_cod_m=? , id_ostan=? , id_city=? , id_mar=?    WHERE add_abadi=?  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$id_ostan,$id_city,$id_mar,$add_abadi));
$dbh = null ; 
}
   echo "<script>hideLoading();</script>"; // مخفی کردن لودینگ پس از تکمیل عملیات

alert('اطلاعات شما با موفقبت بروز رسانی شد ');
}
?>
