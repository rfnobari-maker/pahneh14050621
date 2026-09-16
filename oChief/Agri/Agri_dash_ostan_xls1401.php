<?php
// اتصال به دیتابیس
include('../../lock_oce.php');
include('../../event.php');
include('../../login/config.php') ;
// درخواست برای خواندن اطلاعات از دیتابیس
$query = "SELECT z_sal,id_ostan,cod_mah_amar,cod_qroup_amar,no_kesh,sum(s_bar_a+s_bar_b)
 as sb , sum(mah_tol) as mah_tol FROM Agriprod1401_1402 WHERE mah_tol>0  group by id_ostan 
  ,cod_mah_amar,no_kesh ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21')";
$stmt = $dbh->prepare($query);
$stmt->execute();
 

// ایجاد فایل اکسل
require_once '../../PHPEXCEL/PHPExcel.php';
$objPHPExcel = new PHPExcel();

// تنظیم سربرگ فایل اکسل
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ردیف')
            ->setCellValue('B1', 'سال زراعی')
            ->setCellValue('C1', 'نام استان')
            ->setCellValue('D1', 'کد استان')
            ->setCellValue('E1', 'نام محصول')
            ->setCellValue('F1', 'کد محصول')
            ->setCellValue('G1', 'نام گروه')
            ->setCellValue('H1', 'کد گروه')
            ->setCellValue('I1', 'نوع کشت')
            ->setCellValue('J1', 'سطح برداشت به هکتار')
            ->setCellValue('K1', 'تولید به تن')
            ->setCellValue('L1', 'عملکرد کیلوگرم در هکتار');

// وسط چین کردن همه سلول‌های سربرگ
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

// درج اطلاعات از دیتابیس در فایل اکسل
$r = 1 ;
$i = 2;
foreach($stmt as $row){
 $s_b = round($row['sb'],2) ;
 $mah_tol = round($row['mah_tol'],2) ;

    $objPHPExcel->getActiveSheet()
                ->setCellValue('A'.$i, $r)
                ->setCellValue('B'.$i, $row['z_sal'])
                ->setCellValue('C'.$i, ostan_name($row['id_ostan'] ))
                ->setCellValue('D'.$i, $row['id_ostan'])
                ->setCellValue('E'.$i, mah_name_amar($row['cod_mah_amar']))
                ->setCellValue('F'.$i, $row['cod_mah_amar'])
                ->setCellValue('G'.$i, group_name_amar($row['cod_qroup_amar']))
                ->setCellValue('H'.$i, $row['cod_qroup_amar'])
                ->setCellValue('I'.$i, $row['no_kesh'])
                ->setCellValue('J'.$i, $s_b)
                ->setCellValue('K'.$i, $mah_tol)
                ->setCellValue('L'.$i, round(($mah_tol/$s_b)*1000,0));

    // وسط چین کردن سلول‌ها
    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':L'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$i.':L'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

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
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':L'.$row)->getFill()->applyFromArray($oddFill);
    } else {
        $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':L'.$row)->getFill()->applyFromArray($evenFill);
    }
}
// تغییر رنگ سلول‌ها به رنگ قرمز
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray(
    array(
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => 'FF0000')
        )
    )
);


// تنظیمات فایل اکسل
$objPHPExcel->getActiveSheet()->setTitle('گزارش داشبورد استان');
$objPHPExcel->setActiveSheetIndex(0);

// خروجی دادن فایل اکسل
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="گزارش_داشبورد_استان.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>