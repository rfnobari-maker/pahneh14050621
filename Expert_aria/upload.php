<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<div align="center">
  <?php
$news_no =  $_POST["news_id"]; 
$p_title = $_POST['p_title'] ;
$title = $_POST['title'] ;
$body = $_POST['body'] ;
   // Configuration - Your Options
      $allowed_filetypes = array('.jpg','.gif','.GIF'); // These will be the types of file that will pass the validation.
      $max_filesize = 20288; // Maximum filesize in BYTES (currently 0.5MB).
      $upload_path = '../../1_files/'; // The place the files will be uploaded to (currently a 'files' directory).
 
   $filename = $_FILES['userfile']['name']; // Get the name of the file (including file extension).
   $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); // Get the extension from the filename.
 
   // Check if the filetype is allowed, if not DIE and inform the user.
   if(!in_array($ext,$allowed_filetypes))
      die('امكان ارسال اين نوع فايل وجود ندارد');
    // Now check the filesize, if it is too large then DIE and inform the user.
   if(filesize($_FILES['userfile']['tmp_name']) > $max_filesize)
      die('اندازه فايل بزرگ هست');
    // Check if we can upload to the specified path, if not DIE and inform the user.
   if(!is_writable($upload_path))
      die('امكان ارسال فايل به مقصد ممكن نيست.');
    // Upload the file to your specified path.
   if(move_uploaded_file($_FILES['userfile']['tmp_name'],$upload_path . $news_no.$ext))
   $send=1 ; 
         //echo 'Your file upload was successful, view the file <a href="' . $upload_path . $filename . '" title="Your File">here</a>'; // It worked.
      else
  echo 'خطا در مرحله ارسال فايل لطفا دوباره سعي كنيد '; // It failed :(.
?>
  <?php
$new_filename = $news_no.$ext ;
if ($send==1)
{
$con = mysql_connect("localhost","eagri_test1","13520312");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("eagri_header_news", $con);
mysql_query("INSERT INTO h_news (news_no, p_title, title, bady)
VALUES ( '$news_no', '$p_title', '$title','$body' )") ; 
//$news_no, $p_title, $title,$bady)");
 echo 'مطالب به همراه تصوير با موفقيت ارسال شد . <a href="' . $upload_path . $new_filename . '" title="تصوير خبر">مشاهده تصوير ارسالي</a>'; // It worked.
mysql_close($con);
unset($news_no, $p_title, $title,$bady) ; 
}
?>
<P align="center" class="style1"><a href="h_news.php" class="style2">برگشت</a> </P>
</div>
</body>
</html>