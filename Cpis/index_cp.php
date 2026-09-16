<?php
require_once("../lock_cp.php");
require_once('../web/sokh.php');
require_once('side_menu1.php');

// آرایه‌ای برای تعریف فیلم‌ها - سازگار با PHP 5.3.3
$videos = array(
    array('path' => './cpis_mov/1', 'title' => 'تعریف الگوی کشت'),
    array('path' => './cpis_mov/2', 'title' => 'محدوده هدف طرح الگوی کشت'),
    array('path' => './cpis_mov/3', 'title' => 'الزم قانونی تدوین برنامه الگوی کشت '),
    array('path' => './cpis_mov/4', 'title' => 'نحوه و تاریخچه تدوین برنامه الگوی کشت')
);

// تعیین ویدئوی پیش‌فرض برای نمایش (اولین ویدئو)
$default_video = $videos[0];
$title = 'آرشیو فیلم‌های آموزشی'; // عنوان صفحه
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>

<style>
/* تنظیمات عمومی */
.video-gallery-container {
    max-width: 1200px;
    margin: -40px auto;
    padding: 20px;
    background-color: #f7f7f7;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}
.gallery-title {
    text-align: center;
    color: #004d99;
    margin-bottom: 30px;
    border-bottom: 3px solid #004d99;
    padding-bottom: 10px;
    font-size: 28px;
}
.video-player-area {
    display: flex;
    gap: 20px;
    flex-direction: column; /* در موبایل: ستونی (عناوین، سپس پلیر) */
}

/* پلیر اصلی */
.main-video-box {
    flex: 3;
    background-color: #000;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}
#mainVideoPlayer {
    width: 100%;
    height: auto;
    display: block;
}
.current-video-title {
    padding: 15px;
    margin: 0;
    background-color: #333;
    color: #fff;
    font-size: 20px;
    text-align: right;
    direction: rtl;
}

/* لیست پخش (Playlist) */
.video-playlist {
    flex: 1;
    min-width: 280px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 10px;
    max-height: 350px;
    overflow-y: auto;
}

/* آیتم‌های لیست پخش */
.video-item {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    margin-bottom: 8px;
    cursor: pointer;
    border-radius: 8px;
    transition: background-color 0.3s, transform 0.1s, box-shadow 0.3s;
    background-color: #f0f0f0;
}
.video-item:hover {
    background-color: #e0e0e0;
    transform: translateY(-2px);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.video-item.active {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4);
}
.video-number {
    font-size: 16px;
    margin-left: 10px;
    color: #666;
}
.video-item.active .video-number {
    color: #fff;
}
.video-text {
    flex-grow: 1;
    text-align: right;
    font-size: 16px;
}

/* Media Query برای نمایش در دسکتاپ (جابه‌جایی آیتم‌ها) */
@media (min-width: 900px) {
    .video-player-area {
        flex-direction: row; /* در دسکتاپ کنار هم قرار می‌گیرند */
    }
    
    /* ************************************** */
    /* ** اعمال ترتیب جدید در دسکتاپ ** */
    /* ************************************** */
    .video-playlist {
        order: 1; /* لیست پخش به سمت راست (ترتیب اول) */
    }
    .main-video-box {
        order: 2; /* پلیر اصلی به سمت چپ (ترتیب دوم) */
    }
}
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("header.php"); ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" valign="middle">
       
        <div class="video-gallery-container" dir="rtl">
            <h2 class="gallery-title">📚 آشنائی با طرح الگوی کشت </h2>

            <div class="video-player-area">
                
                <div class="video-playlist">
                    <?php 
                    $index = 0;
                    foreach ($videos as $video): 
                        $index++;
                    ?>
                        <div class="video-item" 
                             data-path="<?php echo $video['path']; ?>.mp4" 
                             data-title="<?php echo $video['title']; ?>">
                            <span class="video-number"><?php echo $index; ?>.</span>
                            <span class="video-text"><?php echo $video['title']; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="main-video-box">
                    <video id="mainVideoPlayer" controls poster="../files/default-poster.jpg" playsinline>
                        <source src="<?php echo $default_video['path']; ?>.mp4" type="video/mp4">
                        مرورگر شما تگ ویدئو HTML5 را پشتیبانی نمی‌کند.
                    </video>
                    <h3 id="videoTitle" class="current-video-title"><?php echo $default_video['title']; ?></h3>
                </div>
            </div>
        </div>

    </td>
  </tr>
  <tr>
    <td height="50" colspan="3" valign="middle" >
      </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../files/bottom.gif">
      <?php include('../footer.php'); ?>
    </td>
  </tr>
</table>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainVideo = document.getElementById('mainVideoPlayer');
        const videoTitle = document.getElementById('videoTitle');
        const videoItems = document.querySelectorAll('.video-item');

        videoItems.forEach(item => {
            item.addEventListener('click', function() {
                const newSrc = this.getAttribute('data-path');
                const newTitle = this.getAttribute('data-title');
                
                // به‌روزرسانی منبع ویدئو
                mainVideo.querySelector('source').setAttribute('src', newSrc);
                mainVideo.load(); // بارگذاری منبع جدید
                mainVideo.play(); // پخش ویدئو جدید
                
                // به‌روزرسانی عنوان
                videoTitle.textContent = newTitle;

                // استایل‌دهی به آیتم انتخاب شده
                videoItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // فعال کردن آیتم اول به‌صورت پیش‌فرض
        if (videoItems.length > 0) {
            videoItems[0].classList.add('active');
        }
    });
</script>

</body>
</html>