<?php 
include('../lock_p1.php');
include('../event.php') ;
 if(isset($_POST['add_abadi'])) $add_abadi1 = $_POST['add_abadi'] ;
 if(isset($_POST['add_city'])) $add_city1 = $_POST['add_city'] ;
 if(isset($_POST['no_fa'])) $no_fa1 = $_POST['no_fa'] ;
 if(isset($_POST['confi']))  $confi1 = $_POST['confi'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
-->
</style>
<style type="text/css">
#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
width:50px
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
</style>
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_popup2(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
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
  <p>
    <?php 
include('top.php'); 
?>
  </p>
  <p class="style1"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

     <form  id="reg-form" method="post" action="#1">
             <p> <span class="style1">لیست بهره برداران تایید نشده </span></p>
             <table width="450" height="307" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
               <tr>
                 <td width="73%" height="60">
                   <span style="text-align: center"></span>
                   <span style="text-align: right"></span>
                   <span style="text-align: right"></span>
                   <div align="right">
                     <select  name="add_city" class="input_text" id="add_city"  style="width:170px ; height:40px" dir="rtl">
                       <option value="0" >انتخاب نام شهر تحت پوشش</option>
                       <?php
$query = "SELECT  add_city,shahr FROM `list_city` WHERE  `mor_cod_m` = $login_session"   ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                       <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city1) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
                       <?php }?>
                     </select>
                   </div>
                   <div align="right"></div>
                 </td>
                 <td width="27%"><span style="text-align: right"> : 
                  نام شهر</span></td>
               </tr>
               <tr>
                 <td height="51"><span style="text-align: right">
                   </span>
                  <div align="right"><span style="text-align: right">
                    <select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
                      <option value="0" >انتخاب نام آبادی تحت پوشش</option>
                      <?php
$query = "SELECT  add_abadi,abadi FROM `list_abadi` WHERE  `mor_cod_m` = '$login_session' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                      <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi1) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
                      <?php }?>
                    </select>
                  </span></div></td>
                 <td height="51"><span style="text-align: right">:
نام آبادی</span></td>
               </tr>
               <tr>
                 <td height="56"><span style="text-align: right">
                   </span>
                  <div align="right"><span style="text-align: right">
                    <select  name="no_fa"  class="input_text" id="no_fa" style="width:170px ; height:40px" dir="rtl"   >
                      <option value="0" >انتخاب زمینه فعالیت</option>
                      <option value="fa_1"  <?php if ($no_fa1=='fa_1') echo 'selected=selected'?> >دارای اراضی زراعی</option>
                      <option value="fa_2"  <?php if ($no_fa1=='fa_2') echo 'selected=selected'?> >باغ و قلمستان</option>
                      <option value="fa_3"  <?php if ($no_fa1=='fa_3') echo 'selected=selected'?>>کشت گلخانه ای</option>
                      <option value="fa_45"  <?php if ($no_fa1=='fa_45') echo 'selected=selected'?>>دام سنگین</option>
                      <option value="fa_67"  <?php if ($no_fa1=='fa_67') echo 'selected=selected'?> >دام سبک</option>
                      <option value="fa_8"  <?php if ($no_fa1=='fa_8') echo 'selected=selected'?> >طیور سنتی</option>
                      <option value="fa_9"  <?php if ($no_fa1=='fa_9') echo 'selected=selected'?> >طیور صنعتی</option>
                      <option value="fa_10"  <?php if ($no_fa1=='fa_10') echo 'selected=selected'?> >زنبور عسل</option>
                      <option value="fa_11"  <?php if ($no_fa1=='fa_11') echo 'selected=selected'?> >کرم ابریشم</option>
                      <option value="fa_12" <?php if ($no_fa1=='fa_12') echo 'selected=selected'?> >اپرورش ماهی</option>
                      <option value="fa_13"  <?php if ($no_fa1=='fa_13') echo 'selected=selected'?> >صنایع کشاورزی</option>
                    </select>
                  </span></div></td>
                 <td height="56"><span style="text-align: right">:زمینه فعالیت</span></td>
               </tr>
               <tr>
                 <td height="56"><span style="text-align: right">
                   </span>
                  <div align="right"><span style="text-align: right">
                    <select dir="rtl"  name="confi"  class="input_text" style="width:170px ; height:40px"   >
                      <option value="0" >انتخاب وضعیت رکورد</option>
                      <option value="1"  <?php if ($confi1=='1') echo 'selected=selected'?> >تایید شده</option>
                      <option value="2"  <?php if ($confi1=='2') echo 'selected=selected'?>>تایید نشده</option>
                      <option value=''  <?php if ($confi1=='') echo 'selected=selected'?>>در حال بررسی</option>
                    </select>
                  </span></div></td>
                 <td height="56"><span style="text-align: right">:وضعیت تایید</span></td>
               </tr>
               <tr>
                 <td height="84" colspan="2">
                   <p>
                     <input type="submit" name="action" id="action" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
             </p>
                  <p class="style2"><span class="RedTitleSmaller">برای مشاهده لیست کلیه بهره برداران کلید</span> جستجو<span class="RedTitleSmaller"> را بدون انتخاب هیچ یک از آیتم ها کلیک کنید </span></p></td>
                </tr>
             </table>
   </form>

  <p>
  <?php if(isset($_POST['action']))
{
 if ($add_abadi1 == '0') { $v_add_abadi = 1; }else { $v_add_abadi = "add_abadi = '$add_abadi1'" ;}
 if ($add_city1 == '0')  { $v_add_city  = 1  ; }else{ $v_add_city = "add_city = '$add_city1'" ;}
 if ($no_fa1 == '0')  { $v_no_fa  = 1  ; }else{ $v_no_fa = "$no_fa1='1'" ;}
 if ($confi1 == '0')  { $v_confi  = 1  ; }else{ $v_confi = "confi = '$confi1'" ;}
$start=0;
$limit=25;
if(isset($_GET['id']))
{
$id=$_GET['id'];
$start=($id-1)*$limit;
}
 $query = "SELECT add_abadi,add_city,bah_cod_m,cod_p,tel_m,last_name,name,confi,num_bah,date_t from bah where  mor_cod_m = $login_session and $v_add_abadi and $v_add_city and $v_no_fa and $v_confi and ok !='1' ORDER BY BINARY last_name ASC LIMIT $start, $limit "; 
$query1 = "SELECT id from bah where  mor_cod_m = $login_session and $v_add_abadi and $v_add_city and $v_no_fa and $v_confi and ok !='1' ORDER BY BINARY last_name ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
         <p class="style1"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <form  action="list_bah_xls.php" method="post">
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi1 ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city1 ;?>" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa1 ;?>" />
         <input type="hidden" name="confi" value="<?php echo $confi1 ?>" />
        <button><img src="../files/xls.png" title="دانلود فایل اکسل"  width="58" height="62"  alt=""/></button>
      </form></p>
  <table width="98%" height="153" border="0" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text1">
    <td height="99" colspan="3" bgcolor="#999999">عملیات</td>
    <td height="99" bgcolor="#999999">شماره همراه</td>
    <td width="9%" bgcolor="#999999">کد پستی</td>
    <td width="9%" bgcolor="#999999">تاریخ تولد</td>
    <td width="9%" bgcolor="#999999"> کد ملی<br /></td>
    <td width="10%" bgcolor="#999999">نام خانوادگی</td>
    <td width="9%" bgcolor="#999999"> نام </td>
    <td width="10%" bgcolor="#999999">شهر / آبادی </td>
    <td width="14%" bgcolor="#999999">شهرستان </td>
    <td width="5%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
  <?php
$r = $start+1 ;
 foreach($stmt as $row)
  {
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
if ($add_abadi<>'') {
$query = "SELECT ostan,city,abadi,mar from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$abadi= $row2['abadi'] ; 
$mar = $row2['mar'];
}
if ($add_city<>'') {
$query = "SELECT ostan,city,shahr,mar from list_city where add_city = :add_city"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$shahr= $row2['shahr'] ; 
$mar = $row2['mar'];
}
//echo $row2['User_Name'] ; 
?>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" height="51" class="normalTextSmaller">
    <form  action="del_benef.php" method="post">
    <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
    <input type="hidden" name="add_abadi" value="<?php echo $row['add_abadi'] ;?>" />
    <input type="hidden" name="add_city" value="<?php echo $row['add_city'] ;?>" />
    <input type="hidden" name="num_bah" value="<?php echo $row['num_bah'] ;?>" />
    <button onclick="return confirm('از حذف اطلاعات بهره بردار مطمئن هستید ؟ ')"><img src="../files/del1.png" title="حذف اطلاعات بهره بردار"    width="33" height="26"  alt=""/></button>
    </form></td>
    <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
    <form  action="edit_benef.php" method="post">
    <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
    <input type="hidden" name="num_bah" value="<?php echo $row['num_bah'] ;?>" />
    <button><img src="../files/edit.png" title="ویرایش اطلاعات بهره بردار" width="33" height="26"  alt=""/></button>
    </form>
</td>
    <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> <form  action="view_benef.php" method="post">
      <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
      <input type="hidden" name="num_bah" value="<?php echo $row['num_bah'] ;?>" />
      <button><img src="../files/view.png" title="نمایش اطلاعات بهره بردار"  width="33" height="26"  alt=""/></button>
      </form>
    </td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="8%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
  <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_p'];?></td>
  <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_t'];?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <p><?php echo $row['bah_cod_m'];?></p></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php if(isset($row2['abadi'])) echo $row2['abadi'];?><?php if(isset($row2['shahr'])) echo $row2['shahr'];?></td>
    <?php 

 ?>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row2['city'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
}
?>
</table>
<?php 
if(isset($query1)) {
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1 -> rowCount() ;
$total=ceil($rows/$limit);

if(isset($id) && $id>1)
{
	?>
    <form  action="liste_benef.php?id=<?php echo $id-1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi1 ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city1 ;?>" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa1 ;?>" />
        <input type="hidden" name="confi" value="<?php echo $confi1 ?>" />

        <button class='button' >قبلی</button>
      </form>
    <?php 
}
if(isset($id) && $id!=$total)
{
	?>
    <form  action="liste_benef.php?id=<?php echo $id+1 ?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi1 ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city1 ;?>" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa1 ;?>" />
        <input type="hidden" name="confi" value="<?php echo $confi1 ?>" />
        <button class='button' >بعدی</button>
      </form>
    <?php 
}

echo "<ul class='page'>";

		for($i=1;$i<=$total;$i++)
		{
			if(isset($id) && $i==$id) { echo "<li class='current'>".$i."</li>"; }
			else { 
			?>
      <li class='current'><form  action="liste_benef.php?id=<?php echo $i?>" method="post">
        <input type="hidden" name="action" value="1" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi1 ;?>" />
        <input type="hidden" name="add_city" value="<?php echo $add_city1 ;?>" />
        <input type="hidden" name="no_fa" value="<?php echo $no_fa1 ;?>" />
        <input type="hidden" name="confi" value="<?php echo $confi1 ?>" />
        <button><?php echo $i ?></button>
      </form>
</li>
<?php
 }
		}
echo "</ul>";
}
?>
</div>
<p>&nbsp;</p>
          <p><a href="benefic.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>
    </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>

