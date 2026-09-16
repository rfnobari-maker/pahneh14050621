<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="../../styles.css">
<div id='cssmenu'>
<ul>
   <li class='active has-sub'><a href='#'><span>پروفایل کاربر </span></a>
      <ul>
   <li class='has-sub'><a href='../profile.php'><span>ویرایش اطلاعات کاربری</span></a> </li>
   <li class='has-sub'><a href='../change-password.php'><span>تغییر رمز</span></a></li>
      </ul>
   </li>
   <?php  if(strstr($perm,'p3')) { ?>
   <li class='last'><a href="../list_center.php"><span>مراکز جهاد کشاورزی</span></a></li>
   <?php } if(strstr($perm,'p2')) {?>
   <li class='active has-sub'><a href='#'><span>شهرها</span></a>
      <ul>
   <li class='has-sub'><a href='../lists_city.php'><span>شهر های تحت پوشش</span></a> </li>
   <li class='has-sub'><a href='../list_pubcity.php'><span>اطلاعات عمومی شهر ها</span></a></li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>آبادی ها</span></a>
      <ul>
   <li class='has-sub'><a href='../lists_abadi.php'><span>آبادی های تحت پوشش</span></a> </li>
   <li class='has-sub'><a href='../listpublic_abadi.php'><span>اطلاعات عمومی آبادی ها</span></a></li>
   <li class='has-sub'><a href='../inactive_abadi.php'><span>آبادی های های غیر فعال</span></a></li>
      </ul>
   </li>
<?php } if(strstr($perm,'d')) {?>
   <li class='active has-sub'><a href='../prof.php'><span>اطلاعات اختصاصی</span></a>
      <ul>
  <?php  if(strstr($perm,'d9')) {?>
   <li class='has-sub'><a href='../benef.php'><span>بهره برداران کشاورزی</span></a>
  
      <ul>
   <li class='has-sub'><a href='../list_bah.php'><span>لیست بهره برداران کشاورزی</span></a> </li>
   <li class='has-sub'><a href='../bah_rep1.php'><span>بر اساس مدرک تحصیلی</span></a></li>
   <li class='has-sub'><a href='../bah_rep2.php'><span>بر اساس زمینه فعالیت</span></a></li>
      </ul>
   </li>
 <?php } if(strstr($perm,'d7')) { ?>
   <li class='has-sub'><a href='../Poultry/'><span>زنبورعسل</span></a>
          <ul>
               <li><a href='../Poultry/list_bee.php'><span>لیست زنبورستان ها</span></a></li>
               <li><a href='../Poultry/list_unknown_bee.php'><span>لیست زنبورستان ناشناس</span></a></li>
               <li><a href='../bee2.php'><span>زنبورستان های استان </span></a></li>
               <li><a href='../bee5.php'><span>استان/مدرک تحصیلی</span></a></li>
               <li><a href='../bee6.php'><span>زنبورستان های کشور</span></a></li>
               <li><a href='../bee7.php'><span>کشور/مدرک تحصیلی</span></a></li>
   </ul>
   </li>
 <?php } if(strstr($perm,'d6')) { ?>
   <li class='has-sub'><a href='../Aquatic'><span> شیلات</span></a>
         <ul>
         <li><a href='../Aquatic/liste_Aquatic.php'><span>مزارع تکثیر و پرورش آبزیان</span></a></li>
         </ul>
   </li>
 <?php } if(strstr($perm,'d1')) { ?>
 <li class='has-sub'><a href='../Agri'><span>زراعت</span></a>
         <ul>
         <li><a href='liste_Agri.php'><span>لیست بهره برداری ها</span></a></li>
         <li><a href='Agri_rep11.php'><span>گزارش اطلاعات زراعی </span></a></li>
         <li><a href='Agri_rep12.php'><span>نمودار اطلاعات زراعی </span></a></li>
         <li><a href='Agri_rep13.php'><span>گزارش محصولات زراعی</span></a></li>
         </ul>
   </li>
  <?php } if(strstr($perm,'d3')) { ?>
   <li class='has-sub'><a href='../Garden'><span>باغبانی</span></a>
         <ul>
         <li><a href='../Garden/liste_Garden.php'><span>لیست بهره برداری ها</span></a></li>
         <li><a href='../Garden/Garden_rep1.php'><span>آمار اطلاعات باغی</span></a></li>
         <li><a href='../Garden/Garden_rep3.php'><span>نمودار اطلاعات باغی</span></a></li>
         </ul>
   </li>
 <?php } if(strstr($perm,'d7')) { ?>
   <li class='has-sub'><a href='../Promotion'><span>تحقیقات آموزش و ترویج</span></a>
         <ul>
         <li><a href='../Promotion/Eworker/Eworker_rep.php'><span>مددکاران/تسهیلگران</span></a></li>
         </ul>
      </li>
<?php } if(strstr($perm,'10')) { ?>
   <li class='has-sub'><a href='../Industry'><span>صنایع کشاورزی</span></a>
         
      </li>
 <?php } ?>
   </ul>
   </li>
<?php }?>
  <li class='active has-sub'><a href='#'><span>سیستم پیام</span></a>
      <ul>
   <li class='has-sub'><a target="new" href='../search_promo.php'><span>ارسال پیام جدید</span></a> </li>
   <li class='has-sub'><a  target="new" href='../messanger.php'><span>پیام های دریافتی</span></a>
         <ul>
         <li><a href='../messanger.php'><span>کلیه پیام های دریافتی</span></a></li>
         <li><a href='../messanger_notseen.php'><span>پیام های مشاهده نشده</span></a></li>
         </ul>
</li>
   <li class='has-sub'><a target="new" href='../sent_message.php'><span>پیام های ارسالی</span></a>
         <ul>
         <li><a href='../sent_message.php'><span>کلیه پیام های ارسالی</span></a></li>
         <li><a href='../sent_message_seen.php'><span>پیام های مشاهده شده</span></a></li>
         <li><a href='../sent_message_notseen.php'><span>پیام های مشاهده نشده</span></a></li>
         </ul>
   
   </li>
      </ul>
   </li>
</ul>
</div>