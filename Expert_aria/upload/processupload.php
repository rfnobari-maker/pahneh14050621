<?php
include ('../../login/config.php') ;
if(isset($_post["title"])) 
{
	############ Edit settings ##############
	$UploadDirectory	= 'uploads/'; //فولدری که میخواهید فایلهایتان در آن آپلود شود
	##########################################
	
	/*
	Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini". 
	Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit 
	and set them adequately, also check "post_max_size".
	*/
	
	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}
	
	
	//تنظیم میزان فایل آپلودی اگر حجم فایل از مقدار نوشته شده بیشتر باشد اخطار مورد نظر ارسال میشود
	if ($_FILES["FileInput"]["size"] > 5242880) {
		die("حجم فایل از حد مجاز بیشتر میباشد!");
	}
	
	//نوع فایلی که کاربر میتواند ارسال کنید
	switch(strtolower($_FILES['FileInput']['type']))
		{
			//allowed file types
            case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
			case 'image/pjpeg':
			case 'text/plain':
			case 'text/html': //html file
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':
			case 'video/mp4':
				break;
			default:
				die('پسوند فایل مورد نظر پشتیبانی نمیشود!'); //output error
	}
	
	$File_Name          = strtolower($_FILES['FileInput']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = rand(0, 9999999999); //Random number to be added to name.
	$NewFileName 		= $Random_Number.$File_Ext; //new file name
	
	if(move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory.$NewFileName ))
	   {
		   $title = $_POST['title'];
	$query = "INSERT INTO pm (file,title) VALUES (:file,:title)";
    $q = $dbh->prepare($query);
    $q->execute(array(':file'=>$NewFileName,':title'=>$title));
	die('فایل با موفقیت آپلود شد!!!');
	}else{
		die('خطا! فایل آپلود نشد');
	}
	
}
else
{
	die('خطایی رخ داده است لطفا تنظیمات فایل php.ini  را نیز بررسی نمایید.');
}

//download from http://goldtheme.ir