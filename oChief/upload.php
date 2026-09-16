<form action="upload.php" method="post"
enctype="multipart/form-data">
  <p>
  <label for="file">upload form <br>
    <br>
    Filename:</label>
  <input type="file" name="file" id="file">
   <img src="newupload/<?php echo $_FILES["file"]["name"]  ?>" width="150" height="176"  alt=""/></p>
  <p><br>
    <input type="submit" name="submit" value="Submit">
  </p>
</form>
<style>
.sucess{
color:#088A08;
}
.error{
color:red;
}
</style>


<?php
if (isset($_POST['submit']))
{
$file_exts = array("jpg", "bmp", "jpeg", "gif", "png");
$upload_exts = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($upload_exts, $file_exts))
{
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
}
else
{
// Enter your path to upload file here
move_uploaded_file($_FILES["file"]["tmp_name"],
"newupload/" . $_FILES["file"]["name"]);
echo "<div class='sucess'>"."Stored in: " .
"newupload/" . $_FILES["file"]["name"]."</div>";
}
}
else
{
echo "<div class='error'>Invalid file</div>";
}
}
?>
