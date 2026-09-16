<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>آپلود فایل بصورت AJAX -Jquery</title>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery.form.min.js"></script>

<script type="text/javascript">
$(document).ready(function() { 
	var options = { 
			target:   '#output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			success:       afterSuccess,  // post-submit callback 
			uploadProgress: OnProgress, //upload progress callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}); 
		

//function after succesful file upload (when server response)
function afterSuccess()
{
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button
	$('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar

}

//function to check file size before uploading.
function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{

		if( !$('#FileInput').val()) //check empty input filed
		{
			$("#output").html("فایلی انتخاب نشده ");
			//return false

		}
		
		var fsize = $('#FileInput')[0].files[0].size; //get file size
		var ftype = $('#FileInput')[0].files[0].type; // get file type
		

		//allow file types 
		switch(ftype)
        {
            case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
			case 'image/pjpeg':
			case 'text/plain':
			case 'text/html':
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':
			case 'video/mp4':
                break;
            default:
                $("#output").html("<b>"+ftype+"</b> فایل غیر مجاز ");
				return false
        }
		
		//Allowed file size is less than 5 MB (1048576)
		if(fsize>5242880) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big file! <br />File is too big, it should be less than 5 MB.");
			return false
		}
				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");  
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#output").html("مروگر شما قدیمی است و برخی امکانات سایت را پشتیبانی نمی کند");
		return false;
	}
}

//progress bar function
function OnProgress(event, position, total, percentComplete)
{
    //Progress bar
	$('#progressbox').show();
    $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
    $('#statustxt').html(percentComplete + '%'); //update status text
    if(percentComplete>50)
        {
            $('#statustxt').css('color','#000'); //change status text to white after 50%
        }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

}); 

</script>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="upload-wrapper">
<div align="center">
<h3>ارسال پیام </h3>
<form action="processupload.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
  
  <table width="491" border="0">
    <tr>
      <td width="324" height="69"><div align="right"  >
        <input name="r_user" type="text" class="required input_text" id="r_user" style="width:200px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $_POST['co_name']?>" maxlength="100"  align="baseline" xml:lang="fa" />
      </div></td>
      <td width="157"><div align="right">:گیرنده</div></td>
    </tr>
    <tr>
      <td height="59"><div align="right">
        <input name="title" type="text" class="required input_text" id="title" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $_POST['name']?>" maxlength="100" xml:lang="fa" />
      </div></td>
      <td><div align="right">:عنوان پیام </div></td>
    </tr>
    <tr>
      <td height="112"><div align="right">
        <textarea name="message" id="message" cols="45" rows="5"></textarea>
      </div></td>
      <td><div align="right" >:متن پیام</div></td>
    </tr>
    <tr>
      <td><div align="right" class="input_text" >
       <input name="FileInput" id="FileInput" type="file" />
               <br />
      </div></td>
      <td><div align="right">:فایل پیوستی </div></td>
    </tr>
  </table>
  <p>
    <input type="submit"  id="submit-btn" value="ارسال پیام " />
    <img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/></p>
</form>
<div id="progressbox" ><div id="progressbar"></div ><div id="statustxt">0%</div></div>
<div id="output"></div>
</div>
</div>

</body>
</html>