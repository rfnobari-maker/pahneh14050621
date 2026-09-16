<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
 if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'] ;
 if(isset($_POST['m_ostan'])) $m_ostan = $_POST['m_ostan'] ;
 if(isset($_POST['m_city'])) $m_city = $_POST['m_city'] ;
 if(isset($_POST['id_city5'])) $id_city = $_POST['id_city5'] ;
 if(isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'] ;
 if(isset($_POST['add_abadi'])) $add_abadi = $_POST['add_abadi'] ;
 if(isset($_POST['add_city'])) $add_city = $_POST['add_city'] ;
 if(isset($_POST['no_zan'])) $no_zan = $_POST['no_zan'] ;
 if(isset($_POST['no_bah'])) $no_bah = $_POST['no_bah'] ;
 if(isset($_POST['no_nation'])) $no_nation = $_POST['no_nation'] ;
 if(isset($_POST['mor_cod_m'])) $mor_cod_m = $_POST['mor_cod_m'] ;
 if(isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'] ;
 if(isset($_POST['sal'])) $sal = $_POST['sal'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
 <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
 <title><?php echo $title ;?></title>
<style>
button
{
	border-color:#FFF ;
}
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
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
function bee_popup(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}

            $(document).ready(function()
            {
                $(".country").change(function()
                {
                    var id=$(this).val();
                    var dataString = 'group_cod='+ id;
                    $.ajax
                    ({
                        type: "POST",
                        url: "ajax_ostan.php",
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $(".mar").html(html);
                        }
                    });
                });
            });
 function target_Agri17(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=750,height=600");
    form.target = 'formpopup';
	}
        </script>

</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
   <p class="style19">لیست زنبورستان ها
     <br />
  </p>
      <form  id="reg-form" method="post" action="#1">
  <div style="width: 700px; padding: 5px; border: 2px solid #09C  ; margin: auto; text-align: left; ; border-radius: 15px" >
    <table width="100%" height="480" border='0' align="center" cellpadding='0' cellspacing='0'>
      <tr bgcolor='#f1f1f1' >
        <td height="22" colspan='4' align='center' bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
      <tr bgcolor='#f1f1f1' >
        <td height="49" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
        <td  align='center' bgcolor="#DDDDDD" class="style8">&nbsp;</td>
        <td height="49" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
          <select name="sal" class="input_text  required" id="sal" style="height:40px ; width:170px ; direction:rtl">
            <option value="1404" <?php if (isset($sal) && $sal=='1404') echo 'selected=selected'?>>1404</option>
            <option value="1403" <?php if (isset($sal) && $sal=='1403') echo 'selected=selected'?>>1403</option>
            <option value="1402" <?php if (isset($sal) && $sal=='1402') echo 'selected=selected'?>>1402</option>
            <option value="1401" <?php if (isset($sal) && $sal=='1401') echo 'selected=selected'?>>1401</option>
            <option value="1398" <?php if (isset($sal) && $sal=='1398') echo 'selected=selected'?>>1398</option>
            <option value="1397" <?php if (isset($sal) && $sal=='1397') echo 'selected=selected'?>>1397</option>
          </select>
        </div></td>
        <td  align='center' bgcolor="#DDDDDD" class="style8">: سرشماری سال</td>
        </tr>
      <tr bgcolor='#f1f1f1' >
        <td align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_city5" class="input_text" id="id_city" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
          <option value="0"> کل استان</option>
          <?php
$query = "SELECT id_city,city FROM cityname  WHERE  id_ostan = '$id_ostan1' ORDER BY BINARY city ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$id_city) echo 'selected=selected'?>> <?php echo $row['city'] ;?></option>
          <?php }?>
        </select>
          <?php
				   if (isset($_POST['id_city5']))
  $id_city = $_POST['id_city5'] ;
?></td>
        <td  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8"> :شهرستان</font></td>
        <td height="49" align="right" bgcolor="#FFFFFF" class="input_text" ><select  name="id_ostan" class="style8" id="id_ostan" style="width:170px ; height:40px" dir="rtl"  onchange="this.form.submit()">
          <option value="-1">انتخاب استان</option>
          <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan ASC "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$id_ostan1) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
          <?php
		   }?>
        </select>
          <?php
				   if (isset($_POST['id_ostan']))
  $id_ostan1= $_POST['id_ostan'] ;
?></td>
        <td  align='center' bgcolor="#FFFFFF" class="style8">: استان<span class="style1"><a name="1" id="12"></a></span></td>
        </tr>
      <tr >
        <td height="42" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_abadi"  class="input_text" id="add_abadi" style="width:170px ; height:40px" dir="rtl"   >
          <option value="0" >انتخاب نام آبادی</option>
          <?php
$query = "SELECT  add_abadi,abadi FROM list_abadi WHERE  id_mar = '$id_mar' ORDER BY BINARY abadi "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['add_abadi'] ;?>"
   <?php if ($row['add_abadi']==$add_abadi) echo 'selected=selected'?>> <?php echo $row['abadi'] ;?></option>
          <?php }?>
        </select></td>
        <td height="42"  align='center' bgcolor="#DDDDDD" class="style8">نام آبادی</td>
        <td rowspan="2" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="id_mar" class="input_text" id="bakh" style="width:170px ; height:40px" dir="rtl" onchange="this.form.submit()">
          <option value="0"> نام مرکز</option>
          <?php
$query = "SELECT  id_mar,mar FROM mar WHERE  id_ostan = '$id_ostan1' and id_city = $id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['id_mar'] ;?>"
   <?php if ($row['id_mar']==$id_mar) echo 'selected=selected'?>> <?php echo $row['mar'] ;?></option>
          <?php }?>
        </select>
          <?php
                 				   if (isset($_POST['id_mar']))
  $id_mar = $_POST['id_mar'] ;

				 ?>
          <input name="id_city2" type="hidden" value="<?php echo $id_city ;?>" /></td>
        <td rowspan="2"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8"> :مرکز جهاد کشاورزی</font></td>
      </tr>
      <tr >
        <td height="42" align="right" bgcolor="#DDDDDD" class="input_text" ><select  name="add_city"  class="input_text" id="add_city" style="width:170px ; height:40px" dir="rtl"   >
          <option value="0" >انتخاب نام شهر</option>
          <?php
$query = "SELECT  add_city,shahr FROM list_city WHERE  id_mar = '$id_mar' ORDER BY BINARY shahr "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
          <option value="<?php echo $row['add_city'] ;?>"
   <?php if ($row['add_city']==$add_city) echo 'selected=selected'?>> <?php echo $row['shahr'] ;?></option>
          <?php }?>
        </select></td>
        <td height="42"  align='center' bgcolor="#DDDDDD" class="style8">:نام شهر</td>
      </tr>
      <tr >
        <td height="54" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="no_bah" class="input_text  required" id="no_bah"  style="height:40px ; width:170px ; direction:rtl">
            <option value="0">انتخاب کنید</option>
            <option value="1" <?php if($no_bah=="1") echo "selected='selected'"?>>حقیقی</option>
            <option value="2" <?php if($no_bah=="2") echo "selected='selected'"?>>حقوقی</option>
          </select>
        </div></td>
        <td height="54"  align='center' bgcolor="#FFFFFF" class="style1"><font size="2" class="style8">: نوع بهره بردار </font></td>
        <td height="47" align="right" bgcolor="#FFFFFF" class="input_text" ><div align="right">
          <select name="no_zan" class="input_text  required" id="no_bah2"  style="height:40px ; width:170px ; direction:rtl">
            <option value="0">انتخاب کنید</option>
            <option value="1" <?php if($no_zan=="1") echo "selected='selected'"?>>غیرمهاجر</option>
            <option value="2" <?php if($no_zan=="2") echo "selected='selected'"?>>مهاجر</option>
          </select>
        </div></td>
        <td height="47" align="right" bgcolor="#FFFFFF" class="style1" ><font size="2" class="style8">: نوع زنبورداری</font></td>
        </tr>
      <tr >
        <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" >&nbsp;</td>
        <td height="54" align="right" bgcolor="#DDDDDD" class="style1" >&nbsp;</td>
        <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
          <select  name="no_nation" class="input_text required country" id="m_ostan" style="width:170px ; height:40px" tabindex="8" dir="rtl" >
            <option value="0">انتخاب کنید</option>
            <option value="1" <?php if($no_nation=="1") echo "selected='selected'"?>>ایرانی</option>
            <option value="2" <?php if($no_nation=="2") echo "selected='selected'"?>>غیرایرانی</option>
          </select>
        </div></td>
        <td height="54"  align='center' bgcolor="#DDDDDD" class="style1"><span class="style8">: ملیت زنبوردار</span></td>
        </tr>
      <tr >
        <td height="54" align="right" class="input_text" ><div align="right">
          <select  name="m_city" class="target required  input_text mar" id="cod_mah" style="width:140px ; height:40px" tabindex="9" dir="rtl">
                  <option value="" selected="selected">نام شهرستان</option>
              <?php
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$m_ostan' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
              <option value="<?php  echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$m_city) echo 'selected=selected'?>>
                <?php  echo $row['city'] ;?>
                </option>
              <?php
}
?>
            </select>
        </div></td>
        <td height="54" align="right" class="style1" ><span class="style8">: شهرستان مبدا</span></td>
        <td height="54" align="right" class="input_text" ><div align="right">
          <select  name="m_ostan" class="input_text required country" id="m_ostan" style="width:170px ; height:40px" tabindex="8" dir="rtl" >
            <option value="-1">انتخاب استان</option>
            <?php
$query = "SELECT id_ostan,ostan FROM ostanname ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$m_ostan) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
            <?php
		   }?>
          </select>
        </div></td>
        <td height="54"  align='center' class="style1"><span class="style8">: استان مبدا</span></td>
      </tr>
      <tr >
        <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
          <input name="bah_cod_m" type="text" class="input_text" id="bah_cod_m"  style="height:35px ; width:170px " value="<?php echo $bah_cod_m?>" />
        </div></td>
        <td height="54" align="right" bgcolor="#DDDDDD" class="style1" ><font size="2" class="style8">: کد ملی بهره بردار</font></td>
        <td height="54" align="right" bgcolor="#DDDDDD" class="input_text" ><div align="right">
          <input name="mor_cod_m" type="text" class="input_text" value="<?php echo $mor_cod_m?>"  style="height:35px ; width:170px " />
        </div></td>
        <td height="54"  align='center' bgcolor="#DDDDDD" class="style1"><font size="2" class="style8">: کد ملی مروج</font></td>
      </tr>
      <tr >
        <td height="60" colspan="4" align="left"><input name="action" type="submit" id="action" style="width:150px ; height:45px ; alignment-adjust:middle" value='جستجو' /></td>
      </tr>
    </table>
  </div>
   </form>
  <p>
  <?php if(isset($_POST['action']))
{
 if ($id_ostan1 == '-1')    { $v_id_ostan   = 1 ;}else{ $v_id_ostan  = "bee.id_ostan='$id_ostan1'" ;}
 if ($m_ostan == '-1')      { $v_m_ostan    = 1 ;}else{ $v_m_ostan   = "bee.m_ostan='$m_ostan'" ;}
 if ($m_city =='')          { $v_m_city     = 1 ;}else{ $v_m_city    = "bee.m_city='$m_city'" ;}
 if ($id_city == 0)         { $v_id_city    = 1 ;}else{ $v_id_city   = "bee.id_city='$id_city'" ;}
 if ($id_mar  == 0)         { $v_id_mar     = 1 ;}else{ $v_id_mar    = "bee.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')    { $f_add_abadi  = 1 ;}else{ $f_add_abadi = "bee.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')     { $f_add_city   = 1 ;}else{ $f_add_city  = "bee.add_city = '$add_city'" ;}
 if ($no_zan == '0')        { $f_no_zan     = 1 ;}else{ $f_no_zan    = "bee.no_zan = '$no_zan'" ;}
 if ($no_bah == '0')        { $f_no_bah     = 1 ;}else{ $f_no_bah    = "bah.no_bah = '$no_bah'" ;}
 if ($no_nation == '0')     { $f_no_nation  = 1 ;}else{ $f_no_nation = "bah.no_nation = '$no_nation'" ;}
 if ($mor_cod_m == '')      { $v_mor_cod_m  = 1 ;}else{ $v_mor_cod_m = "bee.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')      { $v_bah_cod_m  = 1 ;}else{ $v_bah_cod_m = "bee.bah_cod_m = '$bah_cod_m'" ;}
 if ($sal == '')            { $v_sal        = 1 ;}else{ $v_sal       = "bee.sal = '$sal'" ;}
$start=0;
$limit=25;
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$start = ($id - 1) * $limit;
  $query = "SELECT bee.* , bah.no_bah FROM  bee
 left join bah ON bee.num_bah = bah.num_bah and  bee.bah_cod_m = bah.bah_cod_m
 where  $f_no_nation and $f_no_bah and  $v_id_ostan  and $v_m_ostan and $v_m_city  and  $v_id_city and $v_id_mar and $v_sal and $f_add_abadi  and $f_add_city and $f_no_zan and $v_mor_cod_m and $v_bah_cod_m  ORDER BY bee.bah_cod_m ASC LIMIT $start, $limit ";
 $query1 = "SELECT COUNT(*) FROM bee
LEFT JOIN bah ON bee.num_bah = bah.num_bah AND bee.bah_cod_m = bah.bah_cod_m
WHERE $f_no_nation AND $f_no_bah AND $v_id_ostan AND $v_m_ostan AND $v_m_city AND $v_id_city AND $v_id_mar AND $v_sal AND $f_add_abadi AND $f_add_city AND $f_no_zan AND $v_mor_cod_m AND $v_bah_cod_m"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
  <span class="style21"><a name="1" id="1"></a></span>
      <form  action="list_bee_xls.php"  method="post">
        <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1 ?>" />
        <input type="hidden" name="m_ostan" value="<?php echo $m_ostan ?>" />
        <input type="hidden" name="m_city" value="<?php echo $m_city ?>" />
        <input type="hidden" name="id_city" value="<?php echo $id_city ?>" />
        <input type="hidden" name="id_mar" value="<?php echo $id_mar ?>" />
        <input type="hidden" name="add_abadi" value="<?php echo $add_abadi ?>" />
        <input type="hidden" name="add_city" value="<?php echo  $add_city ;?>" />
        <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
        <input type="hidden" name="mor_cod_m" value="<?php echo $mor_cod_m ;?>" />
        <input type="hidden" name="no_zan" value="<?php echo $no_zan ;?>" />
        <input type="hidden" name="no_bah" value="<?php echo $no_bah ;?>" />
        <input type="hidden" name="sal" value="<?php echo $_POST['sal'] ;?>" />
          <button><img src="../../files/xls.png" title="دانلود فایل اکسل"  width="58" height="59"  alt=""/></button>
      </form></p>
  </p>
  <table width="90%"  align="center" class="my-table" >
    <tr class="text1">
      <td colspan="2" rowspan="2" bgcolor="#006699">عملیات</td>
      <td width="5%" rowspan="2" bgcolor="#006699">کارشناس<br />
        مروج</td>
      <td colspan="3" bgcolor="#006699">تولید عسل<br />
        <span class="style2">کیلوگرم</span></td>
      <td height="43" colspan="3" bgcolor="#006699">تعداد کندو</td>
      <td colspan="2" bgcolor="#006699">مشخصات زنبوردار</td>
      <td width="8%" rowspan="2" bgcolor="#006699"><p>نوع </p>
        <p>زنبورستان</p></td>
      <td colspan="2" bgcolor="#006699">موقعیت زنبورستان</td>
      <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
    </tr>
    <tr class="text1">
      <td width="6%" bgcolor="#006699">جمع</td>
      <td width="6%" bgcolor="#006699">مدرن</td>
      <td width="5%" bgcolor="#006699">سنتی</td>
      <td width="5%" bgcolor="#006699">جمع</td>
      <td width="6%" height="45" bgcolor="#006699">مدرن</td>
      <td width="6%" bgcolor="#006699">سنتی</td>
      <td width="8%" bgcolor="#006699">کد ملی </td>
      <td width="11%" bgcolor="#006699">نام و نام خانوادگی</td>
      <td width="10%" bgcolor="#006699">شهر/آبادی</td>
      <td width="9%" bgcolor="#006699">شهرستان</td>
      </tr>
    <tr>
      <?php
$r = $start+1 ;
	   foreach($stmt as $row){
 $pic = user_pic($row['mor_cod_m']) ;
 if ($row['no_zan']=='1') $v_no_zan = 'غیرمهاجر '; else $v_no_zan = 'مهاجر' ;
  ?>
          <td width="6%" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
           <form  action="../send_pm1.php#1" method="post" onsubmit="target_Agri17(this)">
     <input type="hidden" name="username" value="<?php echo $row['mor_cod_m'] ;?>" />
     <button><img src="../../files/receive_mail.png" width="31" height="30" title="ارسال پیام " /></button>
     </form></td>

      <td width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <form  action="view_bee.php" method="post" onsubmit="bee_popup(this)">
        <input type="hidden" name="bah_cod_m" value="<?php echo $row['bah_cod_m'] ;?>" />
        <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
        <input type="hidden" name="m_page"  value="list_bee.php" />
        <button><img src="../../files/view.png" title="نمایش اطلاعات زنبورستان"  width="31" height="31"  alt=""/></button>
      </form></td>
      <td height="67" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><img id="img1" src="../../files/users/<?php echo $pic ?>" width="37" height="43"  alt=""/><br />
        <?php echo user_name($row['mor_cod_m'])?><br />
        <?php echo $row['mor_cod_m']?><br />
        <?php echo user_tel($row['mor_cod_m'])?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo ($row['to_mo']+$row['to_bo'])*1 ;   ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['to_mo']*1 ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['to_bo']*1 ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo']+$row['tk_bo'] ;   ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_mo'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tk_bo'] ?></td>
      <td height="67" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name($row['bah_cod_m'])?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_zan?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
      <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
      <td class="normalTextSmall"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
       <?php
	   $r++ ;
}
$query = "SELECT SUM(bee.tk_bo) AS kol_k_bo ,SUM(bee.tk_mo) AS kol_k_mo,SUM(bee.to_bo) AS kol_t_bo,
SUM(bee.to_mo) AS kol_t_mo from bee
left join bah ON bee.num_bah = bah.num_bah and  bee.bah_cod_m = bah.bah_cod_m
where  $f_no_nation and $f_no_bah and $v_id_ostan  and $v_m_ostan and $v_m_city  and  $v_id_city and $v_id_mar and $v_sal and $f_add_abadi  and $f_add_city and $f_no_zan and $v_mor_cod_m and $v_bah_cod_m" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_k_bo = $row['kol_k_bo'];
$kol_k_mo = $row['kol_k_mo'] ;
$kol_t_bo = $row['kol_t_bo'];
$kol_t_mo = $row['kol_t_mo'] ;
$kol_to = round(($kol_t_mo + $kol_t_bo),2) ;
$kol_tk = round(($kol_k_mo + $kol_k_bo),2) ;
$av_to_mo = round(($kol_t_mo / $kol_k_mo),2) ;
$av_to_bo = round(($kol_t_bo / $kol_k_bo),2) ;

?>
 <tr>
      <td height="43" colspan="3" bgcolor="#999999">&nbsp;</td>
      <td bgcolor="#FFFFFF" class="normalTextSmall" ><?php echo $kol_to * 1 ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_t_mo *1;  ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_t_bo *1 ;  ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_tk ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_k_mo ;  ?></td>
      <td bgcolor="#FFFFFF" class="normalTextSmall"><?php echo $kol_k_bo ;  ?></td>
      <td height="43" colspan="6" bgcolor="#FFFFFF" class="style1">جمع کل</td>
      </tr>
  </table>
  <p align="right" class="input_text" style="margin-right:20px">میانگین تولید کندوهای سنتی : <?php echo $av_to_bo ?> کیلوگرم</p>
  <p align="right" class="input_text" style="margin-right:20px">میانگین تولید کندوهای مدرن : <span class="normalTextSmall"><?php echo $av_to_mo ?><span class="input_text"> کیلوگرم</span></span></p>

<?php
$stmt1 = $dbh->prepare($query1);
$stmt1->execute();
$rows = $stmt1->fetchColumn();
$total = ceil($rows / $limit);

// Function to generate hidden inputs
function generate_hidden_inputs() {
    $id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
    $m_ostan = isset($_POST['m_ostan']) ? $_POST['m_ostan'] : '';
    $m_city = isset($_POST['m_city']) ? $_POST['m_city'] : '';
    $id_city = isset($_POST['id_city5']) ? $_POST['id_city5'] : '';
    $id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
    $add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
    $add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
    $bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
    $mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
    $no_zan = isset($_POST['no_zan']) ? $_POST['no_zan'] : '';
    $no_bah = isset($_POST['no_bah']) ? $_POST['no_bah'] : '';
    $sal = isset($_POST['sal']) ? $_POST['sal'] : '';
    $no_nation =  isset($_POST['no_nation']) ? $_POST['no_nation']:'' ;
	
    ?>
    <input type="hidden" name="action" value="1" />
    <input type="hidden" name="id_ostan" value="<?= htmlspecialchars($id_ostan1) ?>" />
    <input type="hidden" name="m_ostan" value="<?= htmlspecialchars($m_ostan) ?>" />
    <input type="hidden" name="m_city" value="<?= htmlspecialchars($m_city) ?>" />
    <input type="hidden" name="id_city5" value="<?= htmlspecialchars($id_city) ?>" />
    <input type="hidden" name="id_mar" value="<?= htmlspecialchars($id_mar) ?>" />
    <input type="hidden" name="add_abadi" value="<?= htmlspecialchars($add_abadi) ?>" />
    <input type="hidden" name="add_city" value="<?= htmlspecialchars($add_city) ?>" />
    <input type="hidden" name="bah_cod_m" value="<?= htmlspecialchars($bah_cod_m) ?>" />
    <input type="hidden" name="mor_cod_m" value="<?= htmlspecialchars($mor_cod_m) ?>" />
    <input type="hidden" name="no_zan" value="<?= htmlspecialchars($no_zan) ?>" />
    <input type="hidden" name="no_bah" value="<?= htmlspecialchars($no_bah) ?>" />
    <input type="hidden" name="sal" value="<?= htmlspecialchars($sal) ?>" />
    <input type="hidden" name="no_nation" value="<?= htmlspecialchars($no_nation) ?>" />    
    <?php
}

// Define visible pages range (shows 5 pages at a time)
$visible_pages = 5;
$start_page = max(1, $id - floor($visible_pages / 2));
$end_page = min($total, $start_page + $visible_pages - 1);
$start_page = max(1, min($start_page, $total - $visible_pages + 1));

?>

<div dir="rtl" class="pagination-container" style="margin: 20px auto; text-align: center; padding: 15px;">
    <ul class="pagination" style="list-style: none; padding: 0; margin: 0; display: flex; justify-content: center; flex-wrap: wrap; gap: 5px;">
        <?php if($id > 1): ?>
            <li style="display: inline-block;">
                <form action="list_bee.php?id=<?= $id-1 ?>#1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">&laquo; قبلی</button>
                </form>
            </li>
        <?php endif; ?>

        <?php if($start_page > 1): ?>
            <li style="display: inline-block;">
                <form action="list_bee.php?id=1#1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;">1</button>
                </form>
            </li>
            <?php if($start_page > 2): ?>
                <li style="display: inline-block; color: #999; padding: 5px 10px;">...</li>
            <?php endif; ?>
        <?php endif; ?>

        <?php for($i = $start_page; $i <= $end_page; $i++): ?>
            <li style="display: inline-block;">
                <?php if($i == $id): ?>
                    <span style="background: #4CAF50; color: white; padding: 5px 10px; border-radius: 4px; display: inline-block;"><?= $i ?></span>
                <?php else: ?>
                    <form action="list_bee.php?id=<?= $i ?>#1" method="post" style="display: inline;">
                        <?php generate_hidden_inputs(); ?>
                        <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?= $i ?></button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endfor; ?>

        <?php if($end_page < $total): ?>
            <?php if($end_page < $total - 1): ?>
                <li style="display: inline-block; color: #999; padding: 5px 10px;">...</li>
            <?php endif; ?>
            <li style="display: inline-block;">
                <form action="list_bee.php?id=<?= $total ?>#1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #f8f8f8; color: #333; border: 1px solid #ddd; padding: 5px 10px; border-radius: 4px; cursor: pointer;"><?= $total ?></button>
                </form>
            </li>
        <?php endif; ?>

        <?php if($id < $total): ?>
            <li style="display: inline-block;">
                <form action="list_bee.php?id=<?= $id+1 ?>#1" method="post" style="display: inline;">
                    <?php generate_hidden_inputs(); ?>
                    <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">بعدی &raquo;</button>
                </form>
            </li>
        <?php endif; ?>
    </ul>

    <div class="page-jump" style="margin-top: 15px;">
        <form action="list_bee.php" method="post" style="display: inline-flex; align-items: center; gap: 10px;">
            <?php generate_hidden_inputs(); ?>
            <span style="font-size: 14px;"> به صفحه:</span>
            <input type="number" name="page_input"
                   value="<?= $id ?>" style="width: 60px; padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
            <button type="submit" class="button" style="background: #4CAF50; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">برو</button>
        </form>
    </div>
</div>

<script>
document.querySelector('.page-jump form').addEventListener('submit', function(e) {
    const pageInput = this.querySelector('input[name="page_input"]');
    const pageNum = parseInt(pageInput.value);

    if (isNaN(pageNum)) {
        e.preventDefault();
        alert('لطفاً یک عدد معتبر وارد کنید');
        return;
    }

    if (pageNum < 1 || pageNum > <?= $total ?>) {
        e.preventDefault();
        alert('لطفاً عددی بین 1 و <?= $total ?> وارد کنید');
        return;
    }

    this.action = `list_bee.php?id=${pageNum}#1`;
});
</script>

    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>
<?php
}
?>