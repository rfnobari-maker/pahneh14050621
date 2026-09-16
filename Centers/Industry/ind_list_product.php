<?php
include('../../lock_p2.php');
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
        $(document).ready(function()
        {
            $(".Mcod_m").change(function()
            {
                var id=$(this).val();
                var dataString = 'cod_m='+ id;
                $.ajax
                ({
                    type: "POST",
                    url: "select_mar.php",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        $(".mar").html(html);
                    }
                });

            });
        });
$(document).ready(function() {
      $(".vtas_comment").hide();
      $(".vbar_comment").hide();
      $(".vch_comment").hide();
      $(".vab_comment").hide();
	  <?php if($v_ab == '1') {?>$(".vab_comment").show();<?php }?>
	  <?php if($v_ch == '1') {?>$(".vch_comment").show();<?php }?>
	  <?php if($v_bar == '1') {?>$(".vbar_comment").show();<?php }?>
	  <?php if($v_tas == '1') {?>$(".vtas_comment").show();<?php }?>

  $("#v_ab").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vab_comment").show();
    } else if (value == "2") {
      $(".vab_comment").hide();
	  <?php $g_en = '0'?>
    } 
  });

  $("#v_ch").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vch_comment").show();
    } else if (value == "2") {
      $(".vch_comment").hide();
	  <?php $y_mch = '0000' ; $m_mch = '00' ; $d_mch = '00' ; $no_mch = '0' ;?>
    } 
  });

  $("#v_bar").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vbar_comment").show();
    } else if (value == "2") {
      $(".vbar_comment").hide();
	  <?php $t_faz = 0 ; $amp = 0 ;?>

    } 
  });

  $("#v_tas").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vtas_comment").show();
    } else if (value == "2") {
      $(".vtas_comment").hide();
	  <?php $no_tas = '1' ; ?>
    } 
  });
});
function close_window() {
      close();
 }
    </script>
    <!-- پایان دریافت اطلاعات مالک -->
</head>
<body>
<div id="rasul" style="width: 100%; height: 100%; background: #726d6d; display: none;  opacity: 0.6; position: fixed; z-index: 4;">
   <img src="img/loading2.gif" style="margin: auto;float: right;z-index: 93;width: 90px;min-height: 50px;position: fixed;left: 0;right: 0;margin: 200px auto;">
</div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td>

 <p class="style8">نمایش اطلاعات محصولات تولیدی واحد صنعتی<br />
   <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
   <?php sar_ind_data($NationalCode,$no_bah) ;?>
 </p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
<td width="4"><p>&nbsp;</p>
                        <p>&nbsp;</p></td>
                    <td width="840" >
                        <form action="" method="post" id="form1" name="form1">
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
                                  <td height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات محصول</strong></div></td>
                                </tr>
                                <tr>
                                  <td height="142" colspan="5">
                                  <table width="100%" height="107" border="1" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td width="13%" height="53" bgcolor="#FFFFCC">ظرفیت جذب مواد<br />
                                        <span class="style8">تن</span></td>
                                      <td width="9%" bgcolor="#FFFFCC">ظرفیت سالن<br />
                                        <span class="style8">تن</span></td>
                                      <td width="62%" bgcolor="#FFFFCC">نام محصول</td>
                                      <td width="10%" bgcolor="#FFFFCC">کد آیسیک</td>
                                      <td width="6%" bgcolor="#FFFFCC">ردیف</td>
                                    </tr>
                                    <?php 
$n = 1 ;
$num2_t_mah = $t_mah ;

$query = "SELECT * from ind_list_product where ShenaseKasboKar = '$ShenaseKasboKar' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                                    <tr>
                                      <td height="36" bgcolor="#FFFFFF"><div align="center"><?php echo $row['m_jazb']?></div></td>
                                      <td bgcolor="#FFFFFF"><div align="center"><?php echo $row['zarfiyat']?></div></td>
                                      <td bgcolor="#FFFFFF"><div align="right" style="margin-right:5px"><?php echo $row['product_name']?></div></td>
                                      <td bgcolor="#FFFFFF"><div align="right" style="margin-right:5px ; margin-left:5px" ><?php echo $row['isic_code'] ?></div></td>
                                      <td bgcolor="#FFFFFF"><?php echo $n ;?></td>
                                    </tr>
                                    <?php
 $num2_t_mah--;
 $n++ ;
}
?>
                                  </table></td>
                                </tr>
                          </table>
                            <p>&nbsp;</p>
                            <div align="center">
                              <p><a href="index.php">
             <input type="button" name="btn1" value="بستن"  onclick="close_window()" style="width:150px ; height:45px" tabindex="36" /></a>
                              </p>
                          </div>
                      </form>
                      <script>

                            $('#submit').click(function () {

                                $('#rasul').css('display', 'block');
                                setTimeout(function () {
                                    $('#rasul').css('display', 'none');
                                },3000)

                              
                            },3000)


                            function disableFunction() {
                                document.getElementById("submit").disabled = 'true';
                                $("#submit").attr("disabled","");
                            }
                        </script>
                    </td>
        </tr>
                <?php
}
    else
   {
                    ?>
                    <form  name="myform" class="myform" method="post" action="index.php">
                    </form>
        <script type="text/javascript">document.myform.submit();</script>
                    <?php
                }
                ?>
                <tr>
                    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
                </tr>
        </table>
</table>
</body>
</html>