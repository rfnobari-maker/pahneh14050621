<form enctype="multipart/form-data" action=""  method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
  <input type="file" name="attachment" />

  <input type="submit" value="ارسال" />

</form>

<?php
if(isset($_POST['MAX_FILE_SIZE']))
{
	 $uploaddir='./';
	 $uploadfile=$uploaddir . basename($_FILES['attachment']['name']);
	 if (move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadfile))
	{ 
	echo 'فایل با موفقیت آپلود شد';
	} 
	else
	 echo 'مشکلی در آپلود فایل به وجود آمد.
	- حجم فایل باید کمتر از 1000 کیلوبایت باشد.
	- پوشه backup باید دارای سطح دسترسی 777 باشد.'; 
	
}
?>

