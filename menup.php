<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <style>
      #alert-banner {
         background-color: #ffcc00;
         color: #333;
         text-align: center;
         padding: 5px;
         font-size: 18px;
         font-weight:normal;
         direction: rtl;
         display: none; /* مخفی در حالت عادی */
         min-height: 20px;
         margin-top: 10px; /* فاصله از منو */
      }

      #cssmenu {
         position: relative;
         z-index: 10; /* منو در بالای نوار پیام قرار می‌گیرد */
      }
   </style>
</head>
<body>

<!-- منو -->
<div id='cssmenu'>
<ul>
   <li class='active has-sub'><a href='#'><span>پروفایل کاربر</span></a>
      <ul>
   <li class='has-sub'><a href='profile'><span>ویرایش اطلاعات کاربری</span></a> </li>
   <li class='has-sub'><a href='change-password'><span>تغییر رمز</span></a></li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>آبادی ها</span></a>
      <ul>
   <li class='has-sub'><a href='lists_abadi'><span>آبادی های تحت پوشش</span></a> </li>
   <li class='has-sub'><a href='list_pubabadi'><span>اطلاعات عمومی آبادی ها</span></a></li>
      </ul>
   </li>
   <li class='active has-sub'><a href='#'><span>شهرها</span></a>
      <ul>
   <li class='has-sub'><a href='lists_city'><span>شهر های تحت پوشش</span></a> </li>
   <li class='has-sub'><a href='list_pubcity'><span>اطلاعات عمومی شهر ها</span></a></li>
      </ul>
   </li>
   <li class='active has-sub'><a href='prof'><span>اطلاعات اختصاصی</span></a>
      <ul>
   <li class='has-sub'><a href='prof/benefic'><span>بهره برداران کشاورزی</span></a> 
   <ul>
               <li><a href='prof/benef'><span>ثبت بهره بردار جدید</span></a></li>
               <li><a href='prof/liste_benef'><span>لیست بهره برداران</span></a></li>
               <li><a href='prof/manager_benef'><span>جستجو با کد ملی</span></a></li>
               <li><a href='prof/list_bah_lastname'><span>جستجو با نام خانوادگی</span></a></li>               
            <li class='last'><a href='prof/liste_benef_notok'><span>بهره برداران تایید نشده</span></a></li>
            </ul>
   </li>
   <li class='has-sub'><a href='prof/Poultry'><span>طیور و زنبورعسل</span></a>
          <ul>
               <li><a href='prof/Poultry/bee'><span>ثبت زنبورستان جدید</span></a></li>
               <li><a href='prof/Poultry/list_bee'><span>لیست زنبورستان ها</span></a></li>
               <li><a href='prof/Poultry/unknown_bee'><span>ثبت زنبورستان ناشناس</span></a></li>
               <li><a href='prof/Poultry/list_unknown_bee'><span>لیست زنبورستان ناشناس</span></a></li>
   </ul>
   </li>
   <li class='has-sub'><a href='prof/Animal'><span>دام</span></a>
          <ul>
               <li><a href='prof/Animal/Animal'><span>ثبت دامداری جدید</span></a></li>
               <li><a href='prof/Animal/liste_Animal'><span>لیست دامداری ها</span></a></li>
               <li><a href='prof/Animal/finish_Animal'><span>اعلام خاتمه عملیات</span></a></li>
   </ul>
   </li>
   <li class='has-sub'><a href='prof/Aquatic'><span>آبزی پروی </span></a>
         <ul>
         <li><a href='prof/Aquatic/Aquatic'><span>ثبت مزرعه تکثیر و پرورش</span></a></li>
         <li><a href='prof/Aquatic/liste_Aquatic'><span>لیست مزارع تکثیر و پرورش</span></a></li>
         <li><a href='prof/Aquatic/manager_Aquatic'><span>جستجوی یک مزرعه </span></a></li>
         </ul>
   </li>
   <li class='has-sub'><a href='prof/Agri'><span>زراعت</span></a>
         <ul>
         <li><a href='prof/Agri/Agri1'><span>ثبت بهره برداری زراعی</span></a></li>
         <li><a href='prof/Agri/liste_Agri'><span>لیست بهره برداری ها</span></a></li>
         <li><a href='prof/Agri/manager_Agri'><span>جستجوی بهره برداری</span></a></li>
         <li><a href='prof/Agri/Agri_rep1'><span>گزارش اطلاعات زراعی </span></a></li>
         </ul>
    </li>
      <li class='has-sub'><a href='prof/Garden'><span> باغبانی</span></a>
         <ul>
         <li><a href='prof/Garden/Garden'><span>ثبت بهره برداری باغی</span></a></li>
         <li><a href='prof/Garden/liste_Garden'><span>لیست بهره برداری ها</span></a></li>
         <li><a href='prof/Garden/manager_Garden'><span>جستجوی بهره برداری</span></a></li>
         <li><a href='prof/Garden/Greenhous'><span>ثبت گلخانه جدید</span></a></li>
         <li><a href='prof/Garden/liste_Greenhousn'><span>لیست گلخانه ها</span></a></li>
         <li><a href='prof/Garden/list_Greenhous_nonP'><span>گلخانه های فاقد عملکرد</span></a></li>
         </ul>
   </li>
   <li class='has-sub'><a href='#'><span>آب و خاک</span></a></li>
   <li class='has-sub'><a href='#'><span>صنایع کشاورزی</span></a></li>
   <li class='has-sub'><a href='#'><span>ترویج</span></a></li>
   </ul>
   </li>
   <li class='last'><a href='list_expar'><span>کارشناسان معین </span></a></li>
  <li class='active has-sub'><a href='#'><span>سیستم پیام</span></a>
      <ul>
   <li class='has-sub'><a target="new" href='search_promo'><span>ارسال پیام جدید</span></a> </li>
   <li class='has-sub'><a  target="new" href='messanger'><span>پیام های دریافتی</span></a></li>
   <li class='has-sub'><a target="new" href='sent_message'><span>پیام های ارسالی</span></a></li>
      </ul>
   </li>
</ul>
</div>

<!-- نوار اطلاعیه زیر منو -->
<div id="alert-banner"></div>

<script>
// آرایه‌ای از پیام‌های اطلاعیه
var alertMessages = [
//  "✅ مشکل وب سرویس ثبت احوال برطرف شد .",
//  "⚠️ وب سرویس ثبت احوال با مشکل مواجه شده .",
//  "📢 لطفا از ارسال پیام در خصوص عدم امکان ثبت بهره بردار جدید ، خودداری فرمایید .",
//  "✅ از طریق سازمان ثبت احوال پیگیر رفع مشکل هستیم .",

];

// اگر پیام وجود داشت، نمایش بده
if(alertMessages.length > 0){
    var banner = document.getElementById("alert-banner");
    banner.style.display = "block";

    var currentMessageIndex = 0;
    var currentCharIndex = 0;

    function typeWriter() {
        if (currentCharIndex < alertMessages[currentMessageIndex].length) {
            banner.innerHTML += alertMessages[currentMessageIndex].charAt(currentCharIndex);
            currentCharIndex++;
            setTimeout(typeWriter, 50); // سرعت تایپ حروف
        } else {
            // بعد از تمام شدن پیام فعلی، چند ثانیه مکث کن
            setTimeout(nextMessage, 3000); // ۳ ثانیه مکث
        }
    }

    function nextMessage(){
        currentMessageIndex++;
        if(currentMessageIndex >= alertMessages.length){
            currentMessageIndex = 0; // برگرد به پیام اول
        }
        banner.innerHTML = "";
        currentCharIndex = 0;
        typeWriter();
    }

    typeWriter(); // شروع تایپ پیام اول
}
</script>

</body>
</html>
