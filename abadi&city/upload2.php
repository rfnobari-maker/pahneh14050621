<?php 
 //echo $login_session ;
$main = $_GET['main'] ; 
if (isset($main))
{
$msg = "کلیه اطلاعات موجود حذف گردید " ; 
	}
 ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ارسال فايل ، ورود اطلاعات</title>
<link href="FA.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><img src="../print/print_files/PLogo.jpg" width="949" height="152" /></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><p>
      <style type="text/css">
<!--
.up_row {
	color: #000066;
	font-family: Tahoma;
	font-size: 16px;
}
.up_titer {color: #990000; font-family: Tahoma; font-size: 16px; }
-->
      </style>
</head>
<body>
    <?php
  
// فانكشن آپلود فايل 
function upload($file_id, $folder="", $types="",$id) {
    if(!$_FILES[$file_id]['name']) return array('','No file specified');

//    $file_title = $_FILES[$file_id]['name'];
	$file_title = $_FILES[$file_id]['name'];
	
    //Get file extension
    $ext_arr = split("\.",basename($file_title));
    $ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension

    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(),1)),0,5);
//    $file_name = $file_title;//Get Unique Name
    $file_name = file.'.'.$ext ;//Get Unique Name

    $all_types = explode(",",strtolower($types));
    if($types) {
        if(in_array($ext,$all_types));
        else {
            $result = 'فايل غير مجاز' ;
			echo "<br/>\n" ;
			 //Show error if any.
        //   return array('',$result);
		  return array($file_name,$result);
        }
    }
    //Where the file must be uploaded to
    if($folder) $folder .= '/';//Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;

    $result = 1;
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "امكان آپلود فايل وجود ندارد "; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : مقصد يافت نشد ";
        } elseif(!is_writable($folder)) {
            $result .= " : امكان نوشتن در مقصد وجود ندارد";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : فايل قابل نوشتن نيست";
        }
        $file_name = '';
        
    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result =  " فايل خالي است لطفا يك فايل معتبر انتخاب كنيد "; //Show the error message
			echo "<br/>\n" ;
        } else {
            chmod($uploadfile,0777);//Make it universally writable.
        }
    }
		  return array($file_name,$result);
}
?>
      <?php
if($_FILES['asnad']['name']) {
list($name,$result) = upload('asnad','','csv',$id);
if ($result==1) {
 $asnad =  $name ;
 $mes = ' : فايل مورد نظر با موفقيت ارسال شد ' ; 
echo $mes ;
echo "<br/>\n" ; 

 } else 
 {
 echo 'خطا در بارگذاري فايل  :'.$result ;  }
 echo "<br/>\n" ; 
}
   
?>

<?php
if (isset($_GET['function'])){
     import();
}
     ?>
      <p><? echo $msg ;?>      
      <table width="87%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td width="83%" align="right"><p align="right" class="htitle">نحوه آماده سازی  فایل اکسل </p>
            <p align="right" dir="rtl">فایل اکسل را در برنامه اکسل باز کنید و به صورت یک فایل متنی و به صورت Unicode Text ذخیره کنید. </p>
            <p align="right" dir="rtl">سپس فایل جدید را در NotePad باز کنید 
              ، آن را Save As کرده و Encoding را UTF-8 و پسوند را csv قرار  دهید. </p>
          <p align="right" dir="rtl">اکنون فایل شما آماده بارگذاری است </p></td>
          <td width="17%"><img src="../files/Convert-Excel-Thumb.gif" width="98" height="100" /></td>
        </tr>
        <tr>
          <td><img src="../files/horizontal-line-700x223.png" width="700" height="19" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><p align="right" class="htitle">بارگذاری فایل لیست حقوقی </p>
            <form action="" method="post" enctype="multipart/form-data">
           <fieldset style="color:#990000 ; border-color:#006699 ; width:450px; float:right" >
           <table width="80%" border="0" align="center" cellpadding="1" cellspacing="1"  dir="rtl" >
    <tr>
      <td width="211" height="78" class="style9"> انتخاب فایل  : </td>
      <td width="319"><p>
        <span ><input type="file" name="asnad"  />
          </span></p></td>
    </tr>
    </table>
           <p  dir="rtl" align="right"><img src="../files/con_info.png" width="16" height="18" />دقت : فقط مجاز به انتخاب فایل با پسوند csv  هستید</p>
           <p align="center">
    <span ><input type="submit" value="ارسال فايل" name="action" style="width:110px ; height:50px" />
  </span></p>
  </fieldset>	  
</form>
</td>
          <td><span ><img src="../files/download.jpg" width="79" height="77" /></span></td>
        </tr>
        <tr>
          <td><img src="../files/horizontal-line-700x223.png" width="700" height="19" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><p align="right" class="htitle" > اطلاعات فایل ارسالی  Import </p></td>
          <td><span ><img src="../files/images.jpg" width="62" height="57" /></span></td>
        </tr>
        <tr>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><p><a href="?function" title="ورود اطلاعات فایل ارسالی به پایگاه داده" class="btn">ورود اطلاعات آپلود شده به پایگاه داده</a></p>
          <p>&nbsp;</p></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><p align="right" dir="rtl"><img src="../files/con_info.png" width="16" height="18" /> اطلاعات فایل ارسالی شما به اطلاعات قبلی اضافه خواهد در صورتی که مایل به جایگزینی اطلاعات قبلی هستید، ابتدا <a  class="LinkRedTitle"href="Db_delete.php" title="حذف کلیه اطلاعات موجود" onclick="return confirm('از حذف کلیه اطلاعات موجود مطمئن هستید؟')">اطلاعات پایگاه داده را حذف</a> سپس اقدام به ورود اطلاعات نمایید .</p></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
          <td>&nbsp;</td>
        </tr>
      </table>
  <tr>
    <td  height="100px"colspan="2" valign="middle" background="../files/bottom.gif"><p class="MenuItemRight">Copyright © 2013, استانداری آذربایجان شرقی All rights   reserved</p>
    <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
</table>
<p><!-- Begin WebGozar.com Counter code -->
  <script type="text/javascript" language="javascript" src="http://www.webgozar.ir/c.aspx?Code=3151728&amp;t=counter" ></script>
<noscript><a href="http://www.webgozar.com/counter/stats.aspx?code=3151728" target="_blank">آمار</a></noscript>
<!-- End WebGozar.com Counter code --></p>
</body>
   
  <?php
function import()
{
$databasehost = "localhost";
$databasename = "eagri_pahneh";
$databasetable = "city_new";
$databaseusername ="eagri_upahneh";
$databasepassword = "Reza9147857121";
$fieldseparator = "\t";
//$fieldseparator = ",";
$lineseparator = "\n";
$csvfile = "file.csv";
/********************************/
/* Would you like to add an ampty field at the beginning of these records?
/* This is useful if you have a table with the first field being an auto_increment integer
/* and the csv file does not have such as empty field before the records.
/* Set 1 for yes and 0 for no. ATTENTION: don't set to 1 if you are not sure.
/* This can dump data in the wrong fields if this extra field does not exist in the table
/********************************/
$addauto = 0;
/********************************/

/* Would you like to save the mysql queries in a file? If yes set $save to 1.
/* Permission on the file should be set to 777. Either upload a sample file through ftp and
/* change the permissions, or execute at the prompt: touch output.sql && chmod 777 output.sql
/********************************/
$save = 0;
$outputfile = "output.sql";
/********************************/

if (!file_exists($csvfile)) {
        echo "فایل یافت نشد لطفا دوباره بارگذاری کنید";
        exit;
}


$file = fopen($csvfile,'r');

if (!$file) {
        echo "خطا در بازبینی فایل ";
        exit;
}

$size = filesize($csvfile);

if (!$size) {
        echo "فایل ارسالی خالی می باشد";
        exit;
}
$csvcontent = fread($file,$size);
fclose($file);
$con = @mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
@mysql_select_db($databasename) or die(mysql_error());
$lines = 0;
$queries = "";
$linearray = array();

foreach(split($lineseparator,$csvcontent) as $line) {

        $lines++;

        $line = trim($line," \t");

        $line = str_replace("\r","",$line);

        /************************************
        This line escapes the special character. remove it if entries are already escaped in the csv file
        ************************************/
        $line = str_replace("'","\'",$line);
        /*************************************/

        $linearray = explode($fieldseparator,$line);

        $linemysql = implode("','",$linearray);

        if($addauto)
                $query = "insert into $databasetable values('','$linemysql');";
        else
                $query = "insert into $databasetable values('$linemysql');";

        $queries .= $query . "\n";

        @mysql_query($query);
}

@mysql_close($con);

if ($save) {

        if (!is_writable($outputfile)) {
                echo "فایل قابل نوشتن نیست . دسترسی فایل را کنترل کنید .\n";
        }

        else {
                $file2 = fopen($outputfile,"w");

                if(!$file2) {
                        echo "Error writing to the output file.\n";
                }
                else {
                        fwrite($file2,$queries);
                        fclose($file2);
                }
        }

}
//echo('<font size="15" color="#990000" > تعداد $lines رکورد یافت شد ');
//echo "<p style=\"font-color: #ff0000; align='center'  \"> تعداد $lines رکورد یافت شد .\n</p>";
echo '<font  class="up_row">'.$lines.': تعداد رکورد قابل انتقال ' ;

}
?> 