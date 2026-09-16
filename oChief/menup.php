<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="../styles.css">
<div id='cssmenu'>
<ul>
   <li class='active has-sub'><a href='#'><span>پروفایل کاربر</span></a>
      <ul>
   <li class='has-sub'><a href='./profile'><span>ویرایش اطلاعات کاربری</span></a> </li>
   <li class='has-sub'><a href='./change-password'><span>تغییر رمز</span></a></li>
      </ul>
   </li>
   <?php  if(strstr($perm,'p3')) { ?>
   <li class='last'><a href="./list_center"><span>مراکز جهاد کشاورزی</span></a></li>
   <?php } if(strstr($perm,'p2')) {?>
   <li class='active has-sub'><a href='#'><span>شهرها</span></a>
      <ul>
   <li class='has-sub'><a href='./lists_city'><span>شهر های تحت پوشش</span></a> </li>
   <li class='has-sub'><a href='./list_pubcity'><span>اطلاعات عمومی شهر ها</span></a></li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>آبادی ها</span></a>
      <ul>
   <li class='has-sub'><a href='./lists_abadi'><span>آبادی های تحت پوشش</span></a> </li>
   <li class='has-sub'><a href='./listpublic_abadi'><span>اطلاعات عمومی آبادی ها</span></a></li>
   <li class='has-sub'><a href='./inactive_abadi'><span>آبادی های های غیر فعال</span></a></li>
      </ul>
   </li>
<?php } if(strstr($perm,'d')) {?>
   <li class='active has-sub'><a href='./prof'><span>اطلاعات اختصاصی</span></a>
      <ul>
  <?php  if(strstr($perm,'d9')) {?>
   <li class='has-sub'><a href='./prof'><span>بهره برداران کشاورزی</span></a>
         <ul>
   <li class='has-sub'><a href='./list_bah'><span>لیست بهره برداران کشاورزی</span></a> </li>
   <li class='has-sub'><a href='./bah_rep11'><span>بر اساس مدرک تحصیلی</span></a></li>
   <li class='has-sub'><a href='./bah_rep22'><span>بر اساس زمینه فعالیت</span></a></li>
      </ul>
   </li>
 <?php } if(strstr($perm,'d7')) { ?>
   <li class='has-sub'><a href='./Poultry'><span>طیور و زنبورعسل</span></a>
          <ul>
               <li><a href='./Poultry/list_bee'><span>لیست زنبورستان ها</span></a></li>
               <li><a href='./Poultry/list_unknown_bee'><span>لیست زنبورستان ناشناس</span></a></li>
               <li><a href='./Poultry/list_bee_kol'><span>لیست نهایی زنبورستان ها</span></a></li>
               <li><a href='./Poultry/bee5'><span>شهرستان/مدرک تحصیلی</span></a></li>
               <li><a href='./Poultry/bee2'><span>تولید/شهرستان</span></a></li>
               <li><a href='./Poultry/bee_Ncity'><span>تولید نهایی/شهرستان</span></a></li>
   </ul>
   </li>
 <?php } if(strstr($perm,'d11')) { ?>
   <li class='has-sub'><a href='./Animal'><span> دام</span></a>
         <ul>
         <li><a href='./Animal/list_Animal'><span>لیست واحدها</span></a></li>
         <li><a href='./Animal/list_Animal_Num'><span>لیست دام </span></a></li>
         <li><a href='./Animal/Animal_rep2'><span>گزارش آمار دام </span></a></li>
         </ul>
   </li>
 <?php } if(strstr($perm,'d6')) { ?>
   <li class='has-sub'><a href='./Aquatic'><span> شیلات</span></a>
         <ul>
         <li><a href='./Aquatic/liste_Aquatic'><span>لیست مزارع تکثیر و پرورش </span></a></li>
         <li><a href='./Aquatic/Aquatic_rep1'><span>گزارش تعداد مزارع </span></a></li>
         <li><a href='./Aquatic/Aquatic_rep2'><span>گزارش تولید مزارع </span></a></li>
         </ul>
   </li>
 <?php } if(strstr($perm,'d1')) { ?>
 <li class='has-sub'><a href='./Agri'><span>زراعت</span></a>
         <ul>
         <li><a href='./Agri/liste_Agri'><span>لیست بهره برداری ها</span></a></li>
         <li><a href='./Agri/Agri_rep11'><span>گزارش اطلاعات زراعی </span></a></li>
         <li><a href='./Agri/Agri_rep12'><span>نمودار اطلاعات زراعی </span></a></li>
         <li><a href='./Agri/Agri_rep13'><span>گزارش محصولات زراعی</span></a></li>
         </ul>
   </li>
  <?php } if(strstr($perm,'d3')) { ?>
      <li class='has-sub'><a href='./Garden'><span>باغبانی</span></a>
         <ul>
         <li><a href='./Garden/liste_Garden'><span>لیست بهره برداری ها</span></a></li>
         <li><a href='./Garden/Garden_rep1'><span>آمار اطلاعات باغی</span></a></li>
         <li><a href='./Garden/Garden_rep3'><span>نمودار اطلاعات باغی</span></a></li>
         </ul>
   </li>
  <?php } if(strstr($perm,'d3')) { ?>
   <li class='has-sub'><a href='#'><span>صنایع کشاورزی</span></a>
         <ul>
         <li><a href='./Industry/list_ind_unit_prod'><span>لیست و عملکرد</span></a></li>
         <li><a href='./Industry/Ind_rep1'><span>گزارش محصولات</span></a></li>
         <li><a href='./Industry/Ind_rep2'><span>آمار واحدها</span></a></li>
         </ul>
   </li>

 <?php } if(strstr($perm,'d8')) { ?>
   <li class='has-sub'><a href='./Promotion'><span>تحقیقات آموزش و ترویج</span></a>
         <ul>
         <li><a href='./list_center'><span>مراکز جهاد کشاورزی</span></a></li>
         <li><a href='./Promotion/Eworker/Eworker_rep'><span>مددکاران ترویجی</span></a></li>
         </ul>
      </li>
 <?php } ?>
   </ul>
   </li>
<?php }?>
  <li class='active has-sub'><a href='#'><span>سیستم پیام</span></a>
      <ul>
   <li class='has-sub'><a target="new" href='./search_promo'><span>ارسال پیام جدید</span></a> </li>
   <li class='has-sub'><a  target="new" href='./messanger'><span>پیام های دریافتی</span></a></li>
   <li class='has-sub'><a target="new" href='./sent_message'><span>پیام های ارسالی</span></a>
         <ul>
         <li><a href='./sent_message'><span>کلیه پیام های ارسالی</span></a></li>
         <li><a href='./sent_message_notseen
         '><span>پیام های مشاهده نشده</span></a></li>
         </ul>
   </li>
      </ul>
   </li>
</ul>
</div>