<?php
// اتصال به دیتابیس
include('../lock_ce.php');
include('../event.php');
include('../login/config.php') ;
//
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $sh_meli   = $_POST['sh_meli'] ;
 $s_bah     = $_POST['s_bah'] ;
 $ok     = $_POST['ok'] ;
 if(isset($_POST['jens'])) $jens = $_POST['jens'] ;
 
 if(isset($_POST['no_bah'])) $no_bah = $_POST['no_bah'] ;
 if(isset($_POST['no_fa'])) $no_fa1 = $_POST['no_fa'] ;
 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "bah.id_ostan='$id_ostan1'" ;}
 if ($id_city == '')    { $v_id_city = 1 ;} else { $v_id_city = "bah.id_city='$id_city'" ;}
 if ($id_mar  == '')    { $v_id_mar = 1 ;} else { $v_id_mar = "bah.id_mar='$id_mar'" ;}
 if ($add_abadi  == '')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "bah.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '')  { $f_add_city  = 1  ; }else{ $f_add_city = "bah.add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "bah.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah.bah_cod_m = '$bah_cod_m'" ;}
 if ($sh_meli == '')    { $v_sh_meli  = 1      ; }else{ $v_sh_meli = "bah.sh_meli = '$sh_meli'" ;}
 if ($s_bah == '')     { $v_s_bah  = 1         ; }else{ $v_s_bah = "bah.s_bah = '$s_bah'" ;}
 if ($no_fa1 == '')  { $v_no_fa  = 1  ; }else{ $v_no_fa = "$no_fa1='1'" ;}
 if ($ok == '')  { $f_ok  = 1  ; }else{ $f_ok = "bah.ok = '$ok'" ;}
 if ($no_bah == '')  { $f_no_bah  = 1  ; }else{ $f_no_bah = "bah.no_bah = '$no_bah'" ;}
 if ($jens == '')    { $f_jens  = 1    ; }else{ $f_jens   = "bah.jens = '$jens'" ;}

// درخواست برای خواندن اطلاعات از دیتابیس
$query = "SELECT bah.*
,list_abadi.ostan,list_abadi.city as city1,list_abadi.abadi,list_abadi.mar
,list_city.ostan,list_city.city as city2,list_city.shahr,list_city.mar
 FROM  bah
 left join list_abadi on list_abadi.add_abadi = bah.add_abadi
 left join list_city  on list_city.add_city   = bah.add_city
 where $v_id_ostan and $f_jens and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city  and $v_mor_cod_m and
  $v_bah_cod_m and $v_sh_meli  and $v_s_bah and $v_no_fa and $f_ok and $f_no_bah ORDER BY BINARY last_name ASC ";
$stmt = $dbh->prepare($query);
$stmt->execute();
 

// ایجاد فایل اکسل
require_once '../PHPEXCEL/PHPExcel.php';
$objPHPExcel = new PHPExcel();

// تنظیم سربرگ فایل اکسل
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'کد ملی کارشناس')
            ->setCellValue('B1', 'نام کارشناس')
            ->setCellValue('C1', 'پرورش قارچ')
            ->setCellValue('D1', 'صنایع کشاورزی')
            ->setCellValue('E1', 'پرورش ماهی')
            ->setCellValue('F1', 'کرم ابرایشم')
            ->setCellValue('G1', 'زنبورعسل')
            ->setCellValue('H1', 'طیور صنعتی')
            ->setCellValue('I1', 'طیور سنتی')
            ->setCellValue('J1', ' دام سبک')
            ->setCellValue('K1', ' دام سنگین')
            ->setCellValue('L1', 'گلخانه')
            ->setCellValue('M1', 'باغ و قلمستان')
            ->setCellValue('N1', 'اراضی زراعی')
            ->setCellValue('O1', 'آخرین وضعیت بهره بردار')
            ->setCellValue('P1', 'کد پستی')
            ->setCellValue('Q1', 'شماره همراه')
            ->setCellValue('R1', 'شماره ثابت')
            ->setCellValue('S1', 'مدرک مرتبط')
            ->setCellValue('T1', 'مدرک تحصیلی')
            ->setCellValue('U1', 'نام پدر')
            ->setCellValue('V1', 'محل صدور')
            ->setCellValue('W1', 'شماره شناسنامه')			
            ->setCellValue('X1', 'تاریخ تولد ')
            ->setCellValue('Y1', 'نام شرکت')			
            ->setCellValue('Z1', 'شناسه ملی')			
            ->setCellValue('AA1', 'کد ملی')			
            ->setCellValue('AB1', 'جنسیت')			
            ->setCellValue('AC1', 'نام خانوادگی')			
            ->setCellValue('AD1', 'نام')			
            ->setCellValue('AE1', 'نوع سکونت')			
            ->setCellValue('AF1', 'نوع بهره بردار')			
            ->setCellValue('AG1', 'آدرس آماری')			
            ->setCellValue('AH1', 'شهر / آبادی ')			
            ->setCellValue('AI1', 'شهرستان ')			
            ->setCellValue('AJ1', ' تاریخ ثبت / ویرایش')			
            ->setCellValue('AK1', 'ردیف');			

// وسط چین کردن همه سلول‌های سربرگ
$objPHPExcel->getActiveSheet()->getStyle('A1:AK1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:AK1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

// درج اطلاعات از دیتابیس در فایل اکسل
$r = 1 ;
$i = 2;
foreach($stmt as $row){
$mor_cod_m=$row['mor_cod_m'];
     	  if($row['ok'] == '4') $v_ok = 'تایید نشده' ;
          if($row['ok'] == '1') $v_ok = 'زنده' ;
          if($row['ok'] == '2') $v_ok = 'فوتی' ;
           if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;
           if($row['s_bah'] == '1')  $v_s_bah = 'ساکن' ; 
           if($row['s_bah'] == '2')  $v_s_bah = 'غیر ساکن' ; 
           if($row['s_bah'] == '3')  $v_s_bah = 'عشایر' ; 
           if($row['jens'] == '1') $v_jens = 'مرد' ; else $v_jens='زن' ;
           if($row['er_mtah'] == '1') $v_er_mtah = 'بلی' ; else $v_er_mtah='خیر' ;
           if($row['fa_1'] == '1') $v_fa_1 = '1' ; else $v_fa_1 ='0' ;
           if($row['fa_2'] == '1') $v_fa_2 = '1' ; else $v_fa_2 ='0' ;
           if($row['fa_3'] == '1') $v_fa_3 = '1' ; else $v_fa_3 ='0' ;
           if($row['fa_45'] == '1') $v_fa_45 = '1' ; else $v_fa_45 ='0' ;
           if($row['fa_67'] == '1') $v_fa_67 = '1' ; else $v_fa_67 ='0' ;
           if($row['fa_8'] == '1') $v_fa_8 = '1' ; else $v_fa_8 ='0' ;
           if($row['fa_9'] == '1') $v_fa_9 = '1' ; else $v_fa_9 ='0' ;
           if($row['fa_10'] == '1') $v_fa_10 = '1' ; else $v_fa_10 ='0' ;
           if($row['fa_11'] == '1') $v_fa_11 = '1' ; else $v_fa_11 ='0' ;
           if($row['fa_12'] == '1') $v_fa_12 = '1' ; else $v_fa_12 ='0' ;
           if($row['fa_13'] == '1') $v_fa_13 = '1' ; else $v_fa_13 ='0' ;
           if($row['fa_14'] == '1') $v_fa_14 = '1' ; else $v_fa_14 ='0' ;
switch ($row['m_tah']) {
    case "1":
        $v_m_tah= "بیسواد";
        break;
    case "2":
        $v_m_tah= "خواندن و نوشتن";
        break;
    case "3":
        $v_m_tah= "سیکل";
        break;
    case "4":
        $v_m_tah= "دیپلم";
        break;
    case "5":
        $v_m_tah= "فوق دیپلم";
        break;
    case "6":
        $v_m_tah= "لیسانس";
        break;
    case "7":
        $v_m_tah= "فوق لیسانس";
        break;
    case "8":
        $v_m_tah= "دکتری";
        break;
    case "9":
        $v_m_tah= "تحصیلات حوزوی";
}

    $objPHPExcel->getActiveSheet()
                ->setCellValue('A'.$i, $mor_cod_m)
                ->setCellValue('B'.$i, user_name($mor_cod_m))
                ->setCellValue('C'.$i, $v_fa_14)
                ->setCellValue('D'.$i, $v_fa_13)
                ->setCellValue('E'.$i, $v_fa_12)
                ->setCellValue('F'.$i, $v_fa_11)
                ->setCellValue('G'.$i, $v_fa_10)
                ->setCellValue('H'.$i, $v_fa_9)
                ->setCellValue('I'.$i, $v_fa_8)
                ->setCellValue('J'.$i, $v_fa_67)
                ->setCellValue('K'.$i, $v_fa_45)
                ->setCellValue('L'.$i, $v_fa_3)
                ->setCellValue('M'.$i, $v_fa_2)
                ->setCellValue('N'.$i, $v_fa_1)
                ->setCellValue('O'.$i, $v_ok)
                ->setCellValue('P'.$i, $row['cod_p'])
                ->setCellValue('Q'.$i, $row['tel_m'])
                ->setCellValue('R'.$i, $row['tel_s'])
                ->setCellValue('S'.$i, $v_er_mtah)
                ->setCellValue('T'.$i, $v_m_tah)
                ->setCellValue('U'.$i, $row['fname'])
                ->setCellValue('V'.$i, $row['m_sod'])
                ->setCellValue('W'.$i, $row['sh_sh'])
                ->setCellValue('X'.$i, $row['date_t'])
                ->setCellValue('Y'.$i, $row['co_name'])
                ->setCellValue('Z'.$i, $row['sh_meli'])
                ->setCellValue('AA'.$i, $row['bah_cod_m'])
                ->setCellValue('AB'.$i, $v_jens)
                ->setCellValue('AC'.$i, $row['last_name'])
                ->setCellValue('AD'.$i, $row['name'])
                ->setCellValue('AE'.$i, $v_s_bah)
                ->setCellValue('AF'.$i, $v_no_bah)
                ->setCellValue('AG'.$i, '"'.$row['add_abadi'].'"'.$row['add_city'])
                ->setCellValue('AH'.$i, $row['abadi'].$row['shahr'])
                ->setCellValue('AI'.$i, $row['city1'].$row['city2'])
                ->setCellValue('AJ'.$i, $row['date_s'] ) 
                ->setCellValue('AK'.$i, $r ) ;

    // وسط چین کردن سلول‌ها
    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':AK'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':AK'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

    $i++;
	$r++ ;
}
// تغییر رنگ پس زمینه ردیف‌های فرد به رنگ کرم و ردیف‌های زوج به رنگ سفید

$oddFill = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'F7F9C5'
    ),
    'endcolor' => array(
        'argb' => 'F7F9C5'
    )
);

$evenFill = array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'FFFFFF'
    ),
    'endcolor' => array(
        'argb' => 'FFFFFF'
    )
);

for ($row = 1; $row <= $i; $row++) {
    if ($row % 2 == 0) {
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':Ak'.$row)->getFill()->applyFromArray($oddFill);
    } else {
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':AK'.$row)->getFill()->applyFromArray($evenFill);
    }
}
// تغییر رنگ سلول‌ها به رنگ قرمز
$objPHPExcel->getActiveSheet()->getStyle('A1:AK1')->applyFromArray(
    array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => 'FF0000')
        )
    )
);


// تنظیم عرض ستون‌ها با استفاده از تابع setAutoSize()
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setAutoSize(true);
// ...


// تنظیمات فایل اکسل
$objPHPExcel->getActiveSheet()->setTitle('لیست بهره برداران کشاورزی');
$objPHPExcel->setActiveSheetIndex(0);

// خروجی دادن فایل اکسل
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="بهره_برداران_کشاورزی.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>