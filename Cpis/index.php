<?php
require_once("../lock_cp.php");
require_once('../web/sokh.php');
require_once('side_menu1.php');

// آرایه‌ای برای تعریف فیلم‌ها
$videos = array(
    array('path' => './cpis_mov/1', 'title' => 'تعریف الگوی کشت'),
    array('path' => './cpis_mov/2', 'title' => 'محدوده هدف طرح الگوی کشت'),
    array('path' => './cpis_mov/3', 'title' => 'الزم قانونی تدوین برنامه الگوی کشت '),
    array('path' => './cpis_mov/4', 'title' => 'نحوه و تاریخچه تدوین برنامه الگوی کشت')
);

$default_video = $videos[0];
//$title = 'آرشیو فیلم‌های آموزشی';
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
    max-width: 960px; /* <--- تغییر: عرض کلی باکس کوچکتر شد (قبلا 1200 بود) */
    margin: -40px auto;
    padding: 20px;
    background-color: #f7f7f7;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}
.gallery-title {
    text-align: center;
    color: #004d99;
    margin-bottom: 25px;
    border-bottom: 3px solid #004d99;
    padding-bottom: 10px;
    font-size: 24px; /* کمی کوچکتر شدن فونت تیتر */
}
.video-player-area {
    display: flex;
    gap: 15px; /* فاصله بین لیست و ویدئو کمی کمتر شد */
    flex-direction: column; 
}

/* پلیر اصلی */
.main-video-box {
    flex: 2.4; /* <--- تغییر: نسبت ویدئو کمتر شد تا جمع‌وجورتر شود (قبلا 3 بود) */
    background-color: #000;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    position: relative;
    min-height: 300px;
}
#mainVideoPlayer {
    width: 100%;
    height: auto;
    display: block;
    min-height: 300px;
}
.current-video-title {
    padding: 12px;
    margin: 0;
    background-color: #333;
    color: #fff;
    font-size: 18px; /* فونت عنوان ویدئو کمی مناسب‌تر شد */
    text-align: right;
    direction: rtl;
}

/* استایل لودر (Loading) */
.video-loader {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    z-index: 10;
    color: #fff;
    font-family: tahoma, arial;
    font-size: 14px;
    transition: opacity 0.3s ease;
}
.loader-spinner {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    animation: spin 1s linear infinite;
    margin-bottom: 15px;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* لیست پخش (Playlist) */
.video-playlist {
    flex: 1;
    min-width: 260px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 10px;
    max-height: 400px; /* ارتفاع لیست پخش کمی بیشتر شد تا با ویدئو هماهنگ شود */
    overflow-y: auto;
}

/* آیتم‌های لیست پخش */
.video-item {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    margin-bottom: 6px;
    cursor: pointer;
    border-radius: 6px;
    transition: background-color 0.3s;
    background-color: #f0f0f0;
}
.video-item:hover {
    background-color: #e0e0e0;
}
.video-item.active {
    background-color: #007bff;
    color: #fff;
}
.video-number {
    font-size: 14px;
    margin-left: 8px;
    color: #666;
}
.video-item.active .video-number {
    color: #fff;
}
.video-text {
    flex-grow: 1;
    text-align: right;
    font-size: 14px;
}

/* Media Query دسکتاپ */
@media (min-width: 900px) {
    .video-player-area {
        flex-direction: row; 
    }
    .video-playlist {
        order: 1; 
    }
    .main-video-box {

        order: 2; 
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
                    <div id="videoLoader" class="video-loader">
                        <div class="loader-spinner"></div>
                        <span>در حال بارگذاری...</span>
                    </div>

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
        const loader = document.getElementById('videoLoader');

        function showLoader() {
            loader.style.opacity = '1';
            loader.style.visibility = 'visible'; 
        }

        function hideLoader() {
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.visibility = 'hidden';
            }, 300); // صبر برای تمام شدن انیمیشن محو شدن
        }

        mainVideo.addEventListener('loadstart', showLoader);
        mainVideo.addEventListener('waiting', showLoader);
        mainVideo.addEventListener('canplay', hideLoader);
        mainVideo.addEventListener('playing', hideLoader);

        videoItems.forEach(item => {
            item.addEventListener('click', function() {
                const newSrc = this.getAttribute('data-path');
                const newTitle = this.getAttribute('data-title');
                
                showLoader();

                mainVideo.querySelector('source').setAttribute('src', newSrc);
                mainVideo.load();
                mainVideo.play().catch(e => console.log("Autoplay prevented"));
                
                videoTitle.textContent = newTitle;

                videoItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        if (videoItems.length > 0) {
            videoItems[0].classList.add('active');
        }
    });
</script>

</body>
</html>