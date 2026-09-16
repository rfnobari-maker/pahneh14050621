<?php
include('../../lock_oce.php');
include('../../event.php');
include('../../login/config.php');
if  (isset($_POST['ShenaseKasboKar']))
{
   $ShenaseKasboKar = $_POST['ShenaseKasboKar'] ; 
$query = "SELECT * from ind_unit WHERE  ShenaseKasboKar = '$ShenaseKasboKar'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
   $id_ostan1 = $row['id_ostan'] ; 
   $id_city1 = $row['id_city'] ; 
   $id_mar = $row['id_mar'] ; 
   $add_abadi = $row['add_abadi'] ; 
   $add_city = $row['add_city'] ; 
   $NationalCode = $row['NationalCode'] ; 
   $no_bah = $row['no_bah'] ; 
   $add_abadi = $row["add_abadi"];
   $add_city = $row["add_city"];
   $no_mal = $row['no_mal'];
   $unit_name = $row['unit_name'] ;
   $t_mah = $row['unit_name'] ;
   ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .style10 {color: #FF0000}
    .style11 {font-size: 14px}
    .size:hover
    {
        width: 20px;
        height:19px ;
    }
.button1 {padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
.current {display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current {	font-weight:bold;
	color: #000;
}
</style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
        });
    </script>
    <!--دریافت اطلاعات مالک -->
    <script type="text/javascript">
function view_ind_prod(form) {
    window.open('null', 'formpopup', 'width=800,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
function close_window() {
      close();
 }
    </script>
</head>
<body>
<div id="rasul" style="width: 100%; height: 100%; background: #726d6d; display: none;  opacity: 0.6; position: fixed; z-index: 4;">
   <img src="img/loading2.gif" style="margin: auto;float: right;z-index: 93;width: 90px;min-height: 50px;position: fixed;left: 0;right: 0;margin: 200px auto;">
</div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td>

 <p class="style8">لیست عملکردهای ثبت شده  واحد صنعتی<br />
   <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
   <?php sar_ind_data($NationalCode,$no_bah) ;?>
 </p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
<td width="4"><p>&nbsp;</p>
                        <p>&nbsp;</p></td>
                    <td width="840" >

                          <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" id=" " style="border:3px solid #069;">
                                <tr>
                                  <td height="31" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
                                </tr>
                                <tr>
                                    <td width="30" height="31"><div align="right"> <?php echo city_name1($id_city1,$id_ostan1) ?></div></td>
                                    <td width="21%"><div align="right">:شهرستان</div></td>
                                    <td width="1%">&nbsp;</td>
                                    <td width="27"><div align="right"><?php echo ostan_name($id_ostan1) ; ?></div></td>
                                    <td width="21%"><div style="margin-right:30px" align="right">: استان</div></td>
                                </tr>
                                <tr>
                                    <td height="30"><div align="right"> <?php echo shahr_name($add_city); ?><?php echo abadi_name($add_abadi) ; ?></div></td>
                                    <td><div align="right">: آبادی/شهر</div></td>
                                    <td>&nbsp;</td>
                                    <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
                                    <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
                                </tr>
                                <tr>
                                    <td height="23"><div align="right"> <?php echo $no_mal; ?></div></td>
                                    <td><div align="right">:نوع مالکیت</div></td>
                                    <td>&nbsp;</td>
                                    <td><div align="right"><?php echo $unit_name ; ?></div></td>
                                    <td><div style="margin-right:30px" align="right" >:نام واحد</div></td>
                                </tr>
                                <tr>
                                  <td height="32" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>عملکرد واحد </strong></div></td>
                                </tr>
                                <tr>
                                  <td height="142" colspan="5">
                                <div   style=" text-align:right;height:150px; margin:auto;width:90%;overflow:auto;background-color:#ffffff;color:#06C;scrollbar-base-color:gold;font-family:tahoma;font-size:11px;padding:10px;; border-radius: 15px">
                                  <table width="90%"  border="0" align="center" cellpadding="1" cellspacing="1" >
                                    <tr align="center" class="text1">
                                      <td width="12%" height="28" bgcolor="#999999">مشاهده فرم</td>
                                      <td bgcolor="#999999">وضعیت واحد</td>
                                      <td bgcolor="#999999">دوره</td>
                                      <td bgcolor="#999999"> سال</td>
                                      <td width="9%" bgcolor="#999999">ردیف</td>
                                    </tr>
                                    <tr>
                                      <?php
$start=0;
$limit=25;
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
 $query = "SELECT * from ind_unit_info
 where ShenaseKasboKar = '$ShenaseKasboKar' ORDER BY BINARY y_prod,d_prod ASC LIMIT $start, $limit "; 
$query1 = "SELECT * from ind_unit_info
 where ShenaseKasboKar = '$ShenaseKasboKar' ORDER BY BINARY y_prod,d_prod ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = $start+1 ;
 foreach($stmt as $row)
  {
 if($row['v_unit'] == '1') $v_v_unit = 'فعال'   ;
 if($row['v_unit'] == '2') $v_v_unit = 'نیمه فعال';
 if($row['v_unit'] == '3') $v_v_unit = 'غیر فعال' ;
 if($row['d_prod'] == '6') $v_d_prod = 'شش ماهه' ;
 if($row['d_prod'] == '12') $v_d_prod = 'دوازده ماهه' ;

$mor_cod_m1=$row['mor_cod_m'];
//echo $row2['User_Name'] ; 
?>
        <td height="68"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
          <?php if ($row['v_unit'] !='3') { ?>
          <form   action="ind_proddata_view.php" method="post" onsubmit="view_ind_prod(this)">
            <input type="hidden" name="ShenaseKasboKar" value="<?php echo $row['ShenaseKasboKar'] ;?>" />
            <input type="hidden" name="y_prod" value="<?php echo $row['y_prod'] ;?>" />
            <input type="hidden" name="d_prod" value="<?php echo $row['d_prod'] ;?>" />
            <button><img src="../../files/view.png" title="نمایش اطلاعات بهره بردار صنعتی"  width="20" height="20"  alt=""/></button>
          </form><?php }?></td>
        <td  width="30%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_v_unit;?></td>
                                      <td  width="26%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_d_prod;?></td>
                                      <td  width="23%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['y_prod'];?></td>
                                      <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
                                      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
                                    </tr>
                                    <?php
$r++ ; 
}
}
?>
              </table>
          </div>
                                  <br />
</td>
                                </tr>
                          </table>
                            <p>&nbsp;</p>
                            <div align="center">
                              <p>
             <input type="button" name="btn1" value="بستن"  onclick="close_window()" style="width:150px ; height:45px" tabindex="36" />
                              </p>
                          </div>
                    </td>
        </tr>
                <tr>
                    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
                </tr>
        </table>
</table>
</body>
</html>