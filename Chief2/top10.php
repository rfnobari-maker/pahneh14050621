<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>

<?php include('../login/config.php') ;
$query = "SELECT ru_read FROM  pm WHERE r_user = '$login_session' and  ru_read = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_pm = $stmt -> rowCount();
?>
<div class='user_data'>
<div class="div2"> <a title="ویرایش اطلاعات کاربری" href="profile.php"><img  class="polaroid" src="../files/users/<?php echo $pic ?>" width="79" height="103" id="img" alt="تصویر کاربر "/></a></div>
<div class="div3">
              <p align="right"  style="margin-right:30px">پانل مدیریتی سامانه جامع پهنه بندی و مدیریت داده های کشاورزی</p>
              <p align="right" class="RedTitleSmaller" style="margin-right:30px">ویژه مدیریت کشوری سامانه</p>
</div>
<div  class="div5"><a href="support.php" onClick="target_popup2(this)" title="ارتباط با پشتیبان سامانه"><img src="../files/support-png-icon.jpg" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></div>
<div class="div4"><a href="messanger.php" title="ارسال و دریافت پیام"><img src="../files/messanger.png" alt="users" width="83" height="83" border="0" class="tricky_image" /></a></div>
</div>
</body>
</html>

<style>
    .user_data{
      display: flex;
     flex-direction: row-reverse;
     justify-content: space-between;
    
    }
  </style>