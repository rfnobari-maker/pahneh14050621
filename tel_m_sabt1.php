<?php
include('./web/shah2.php'); 
require_once('./Jalali.php');

include("lock_p1.php");
date_default_timezone_set('Asia/Tehran');
    
    $tel_m = '09147857121' ; 
    $bah_cod_m = '1380066174' ; 
    $date_edit = jdate("Y/m/d");

    // بررسی وضعیت شماره موبایل و کد ملی
    $shahkarStatus = trim(getShahkarStatus($tel_m, $bah_cod_m));
  if ($shahkarStatus === "مطابقت دارد") {
        
        $valid = '200'; 
        
        // بروزرسانی جدول bah

        echo "success";

    } else if ($shahkarStatus === "عدم مطابقت") {
        // در صورت عدم مطابقت، شماره همراه را ثبت کرده و وضعیت را نامعتبر (مثلاً 0) نگه می‌داریم
        $valid = '0'; // یا هر کد دیگری غیر از '200'
        
        
        echo "no_match";
        
    } else {
        echo "error";
    }
    
    exit; // خروج از اسکریپت پس از انجام عملیات بهره‌بردار




?>