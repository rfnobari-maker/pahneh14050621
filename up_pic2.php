<?php
include("../lock.php");
include('../event.php');
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../PayAdmin/FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>پیوست مدارک : سازمان نظام مهندسی کشاورزی و منابع طبیعی استان</title>

    <script type="text/javascript" src="../script.js"></script>
    <style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
-->
    </style>
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>

</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../print/print_files/PLogo.jpg" width="949" height="152" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>

  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
          <p>&nbsp;</p>
          <p> مدارک درخواست طراحی</p>
          <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <p>
             <?php 
///// start
 include('../login/config.php');
 if (isset($_POST['cod_p'])) 
 { 
 $cod = $_POST['cod_p']; 
$query = "SELECT cod_p FROM dar WHERE cod_p='".$cod."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
// $row تک خطی 
$row_del = $stmt->fetch(PDO::FETCH_ASSOC);
 $id = $row_del['cod_p'] ; 
  sar_data($id); 
 $GLOBALS['cod_id'] = $row_del['cod_p'] ; 
 //echo $id ; 
// ثبت کد پیگیری در صورت عدم وجود در جدول پیوست 



$query = "SELECT cod_p FROM pevast WHERE cod_p='".$id."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count = $stmt -> rowCount();
if($count==0)
{


$query = "INSERT INTO pevast (cod_p) VALUES (:cod_p)";
$q = $dbh->prepare($query);
$q->execute(array(':cod_p'=>$id));
 }
/////

$query = "SELECT * FROM pevast WHERE cod_p='".$id."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
// $row تک خطی 
$row_del = $stmt->fetch(PDO::FETCH_ASSOC);


// حذف فایل شناسنامه 
 if (isset($_POST['del_sh']))
 {
$file ='savefiles/'.$id.'/'.$row_del['sh'] ;
	 unlink($file);
$query = "UPDATE pevast SET sh=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
// حذف فایل کد ملی 
 if (isset($_POST['del_cart_m']))
 {
$file ='savefiles/'.$id.'/'.$row_del['cart_m'] ;
	 unlink($file);
$query = "UPDATE pevast SET cart_m=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //
// حذف فایل تعهد ثبتی 
 if (isset($_POST['del_t_sabt']))
 {
$file ='savefiles/'.$id.'/'. $row_del['t_sabt'] ;
	 unlink($file);
$query = "UPDATE pevast SET t_sabt=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
// حذف فایل سند مالکیت 
 if (isset($_POST['del_s_mal']))
 {
$file ='savefiles/'.$id.'/'.$row_del['s_mal'] ;
	 unlink($file);
$query = "UPDATE pevast SET s_mal=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //
// 2حذف فایل سند مالکیت 
 if (isset($_POST['del_s_mal2']))
 {
$file ='savefiles/'.$id.'/'.$row_del['s_mal2'] ;
	 unlink($file);
$query = "UPDATE pevast SET s_mal2=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //
// حذف فایل سند مالکیت3 
 if (isset($_POST['del_s_mal3']))
 {
$file ='savefiles/'.$id.'/'.$row_del['s_mal3'] ;
	 unlink($file);
$query = "UPDATE pevast SET s_mal3=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //

// حذف فایل اسناد حقابه 
 if (isset($_POST['del_s_ab']))
 {
$file ='savefiles/'.$id.'/'.$row_del['s_ab'] ;
	 unlink($file);
$query = "UPDATE pevast SET s_ab=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //
// حذف فایل نتایج آزمایشات 
 if (isset($_POST['del_n_azma']))
 {
$file ='savefiles/'.$id.'/'.$row_del['n_azma'] ;
	 unlink($file);
$query = "UPDATE pevast SET n_azma=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //
// حذف کد پیگیری در سامانه ملی 
 if (isset($_POST['del_s_codp']))
 {
$query = "UPDATE pevast SET s_codp=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //

// حذف فایل معرفی شهرستان 
 if (isset($_POST['del_m_shahar']))
 {
$file ='savefiles/'.$id.'/'.$row_del['m_shahar'] ;
	 unlink($file);
$query = "UPDATE pevast SET m_shahar=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //
// حذف فایل معرفی نظام به شرکت طراح 
 if (isset($_POST['del_m_nezbt']))
 {
$file ='savefiles/'.$id.'/'.$row_del['m_nezbt'] ;
	 unlink($file);
$query = "UPDATE pevast SET m_nezbt=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //
// حذف فایل معرفی انتخاب شرکت طراح 
 if (isset($_POST['del_f_esht']))
 {
$file ='savefiles/'.$id.'/'.$row_del['f_esht'] ;
	 unlink($file);
$query = "UPDATE pevast SET f_esht=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //
// حذف فایل فرم شماره 1 
 if (isset($_POST['del_form_1']))
 {
$file ='savefiles/'.$id.'/'.$row_del['form_1'] ;
	 unlink($file);
$query = "UPDATE pevast SET form_1=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //
// حذف فایل فرم شماره 2 
 if (isset($_POST['del_form_2']))
 {
$file ='savefiles/'.$id.'/'.$row_del['form_2'] ;
	 unlink($file);
$query = "UPDATE pevast SET form_2=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //
// حذف فایل فرم شماره 3 
 if (isset($_POST['del_form_3']))
 {
$file ='savefiles/'.$id.'/'.$row_del['form_3'] ;
	 unlink($file);
$query = "UPDATE pevast SET form_3=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //
// حذف فایل utm 
 if (isset($_POST['del_utm']))
 {
$file ='savefiles/'.$id.'/'.$row_del['utm'] ;
	 unlink($file);
$query = "UPDATE pevast SET utm=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //
// حذف فایل سایر 
 if (isset($_POST['del_sayer']))
 {
$file ='savefiles/'.$id.'/'.$row_del['sayer'] ;
	 unlink($file);
$query = "UPDATE pevast SET sayer=?  WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array('',$id));
 }
 //

?>
           </p>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td height="44" colspan="5" align="center" bgcolor="#FFFFFF" class="up_row"><?php
		 $query = "SELECT * FROM pevast WHERE cod_p='".$id."'";
         $stmt = $dbh->prepare($query);
         $stmt->execute();
         // $row تک خطی 
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
 $row = mysql_fetch_array($sql) ;
 $sh = $row['sh'] ;
 $cart_m = $row['cart_m'] ;
 $t_sabt = $row['t_sabt'] ;
 $s_mal = $row['s_mal'] ;
 $s_mal2 = $row['s_mal2'] ;
 $s_mal3 = $row['s_mal3'] ;
 $s_ab = $row['s_ab'] ;
 $n_azma = $row['n_azma'] ;
 $s_codp = $row['s_codp'] ;
 $m_shahar = $row['m_shahar'] ;
 $m_nezbt = $row['m_nezbt'] ;
 $f_esht = $row['f_esht'] ;
 $form_1 = $row['form_1'] ;
 $form_2 = $row['form_2'] ;
 $form_3 = $row['form_3'] ;
 $utm = $row['utm'] ;
 $sayer = $row['sayer'] ;

///
if($_FILES['t_sabt']['name']) {
list($name,$result) = upload('t_sabt','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $t_sabt =  $name ;
// $mes = ' : فايل  اسناد با موفقيت ارسال شد ' ; 
//echo $t_sabt.'&nbsp;'.$mes ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویر تعهد ثبتی با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo 'خطا در بارگذاري فايل اسناد :'.$result ; 
  }
}

if($_FILES['sh']['name']) {
list($name,$result) = upload('sh','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $sh =  $name ;
// $mes = ' : فايل  اسناد با موفقيت ارسال شد ' ; 
//echo $sh.'&nbsp;'.$mes ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویر شناسنامه با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل شناسنامه :".$result."  </font></br>" ;
  }
 }
//
if($_FILES['s_mal']['name']) {
list($name,$result) = upload('s_mal','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $s_mal =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویر سند مالکیت با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo 'خطا در بارگذاري فايل اسناد :'.$result ;  }
 }
//
//
if($_FILES['s_mal2']['name']) {
list($name,$result) = upload('s_mal2','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $s_mal2 =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویر سند مالکیت با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo 'خطا در بارگذاري فايل اسناد :'.$result ;  }
 }
//
//
if($_FILES['s_mal3']['name']) {
list($name,$result) = upload('s_mal3','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $s_mal3 =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویر سند مالکیت با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo 'خطا در بارگذاري فايل اسناد :'.$result ;  }
 }
//

//
if($_FILES['s_ab']['name']) {
list($name,$result) = upload('s_ab','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $s_ab =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویر اسناد حقابه با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo 'خطا در بارگذاري فايل اسناد :'.$result ;  }
 }
//
//
if($_FILES['n_azma']['name']) {
list($name,$result) = upload('n_azma','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $n_azma =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل نتایج آزمایشات با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo 'خطا در بارگذاري فايل اسناد :'.$result ;  }
 }
//
//
if($_FILES['m_shahar']['name']) {
list($name,$result) = upload('m_shahar','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $m_shahar =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل معرفی نامه شهرستان با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo 'خطا در بارگذاري فايل اسناد :'.$result ;  }
 }
//
//
if($_FILES['m_nezbt']['name']) {
list($name,$result) = upload('m_nezbt','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $m_nezbt =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل معرفی نامه نظام به شرکت طراح با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo 'خطا در بارگذاري فايل اسناد :'.$result ;  }
 }
//
//
if($_FILES['f_esht']['name']) {
list($name,$result) = upload('f_esht','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $f_esht =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل فرم انتخاب شرکت طراح با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo 'خطا در بارگذاري فايل اسناد :'.$result ;  }
 }
//


if($_FILES['cart_m']['name']) {
list($name,$result) = upload('cart_m','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $cart_m =  $name ;
// $mes1 = ' : فايل  تصويري با موفقيت ارسال شد ' ; 
//echo  $cart_m.'&nbsp;'.$mes1 ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویر کارت ملی با موفقیت ارسال شد </font></br>";
} else 
 {
 echo 'خطا در بارگذاري فايل تصويري :'.$result ; 
 }
} 
//
if($_FILES['not_pln']['name']) {
list($name,$result) = upload('not_pln','savefiles/'.$id,'pdf,doc,docx',$id);
if ($result==1) {
 $not_pln =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل دفترچه طرح با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
if($_FILES['f_cont']['name']) {
list($name,$result) = upload('f_cont','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $f_cont =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویری فرم بررسی و کنترل فنی با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
if($_FILES['f_map']['name']) {
list($name,$result) = upload('f_map','savefiles/'.$id,'dwg,dxf,dwf',$id);
if ($result==1) {
 $f_map =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل نقشه اجرایی طرح با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
if($_FILES['m_nezts']['name']) {
list($name,$result) = upload('m_nezts','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $m_nezts =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویری معرفی نظام جهت اخذ تسهیلات با موفقیت ارسال شد </font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
if($_FILES['m_shtj']['name']) {
list($name,$result) = upload('m_shtj','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $m_shtj =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویری معرفی شهرستان(طرح های جدید بروز شده)با موفقیت ارسال شد</font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
if($_FILES['t_sajra']['name']) {
list($name,$result) = upload('t_sajra','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $t_sajra =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویری تعهد ثبتی اجرا با موفقیت ارسال شد</font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
if($_FILES['fish_fac']['name']) {
list($name,$result) = upload('fish_fac','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $fish_fac =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویری فیش واریزی/ فاکتور خرید با موفقیت ارسال شد</font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
if($_FILES['f_eshm']['name']) {
list($name,$result) = upload('f_eshm','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $f_eshm =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویری فرم انتخاب شرکت مجری با موفقیت ارسال شد</font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
if($_FILES['m_nezbm']['name']) {
list($name,$result) = upload('m_nezbm','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $m_nezbm =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل تصویری فرم معرفی نظام به شرکت مجری با موفقیت ارسال شد</font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
if($_FILES['g_pajra']['name']) {
list($name,$result) = upload('g_pajra','savefiles/'.$id,'pdf,doc,docx',$id);
if ($result==1) {
 $g_pajra =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل قرارداد پیمان اجرایی با موفقیت ارسال شد</font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
if($_FILES['form_1']['name']) {
list($name,$result) = upload('form_1','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $form_1 = $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل فرم شماره یک با موفقیت ارسال شد</font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
//
if($_FILES['form_2']['name']) {
list($name,$result) = upload('form_2','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $form_2 =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل فرم شماره دو با موفقیت ارسال شد</font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
//
if($_FILES['form_3']['name']) {
list($name,$result) = upload('form_3','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $form_3 =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل فرم شماره سه با موفقیت ارسال شد</font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
//
if($_FILES['utm']['name']) {
list($name,$result) = upload('utm','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $utm =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل مختصات با موفقیت ارسال شد</font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//
//
if($_FILES['sayer']['name']) {
list($name,$result) = upload('sayer','savefiles/'.$id,'jpg,jpeg,gif,png',$id);
if ($result==1) {
 $sayer =  $name ;
 echo "<br align='center'> <font size=3 color='#060' >فایل اضافی با موفقیت ارسال شد</font></br>";
 } else 
 {
 echo "<br align='center'> <font size=3 color='#900' >خطا در بارگذاري فايل :".$result."  </font></br>" ;
  }
 }
//


if (isset($_POST['action3'] ) ) {
$s_codp = $_POST['s_codp'] ;
$query = "UPDATE pevast 
        SET s_codp=?
		WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array($s_codp,$id));
}
//
if (isset($_POST['action4'] ) ) {
$no_fileadd = $_POST['no_file'] ;
$v_file = "${$no_fileadd}" ;
//'$'.$no_fileadd ; 
//$m_cart
//$v_file = $t_sabt ; 
$query = "UPDATE pevast 
        SET $no_fileadd=? WHERE cod_p=?";
$q = $dbh->prepare($query);
$q->execute(array($v_file,$id));
} 

//
$query = "SELECT * from pevast WHERE cod_p='$id'";
$stmt = $dbh->prepare($query);
$stmt->execute();
// $row تک خطی 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 // once saved, redirect back to the view page 
// header("Location: moza_view.php"); 
 ?></td>
               </tr>
               <tr>
                 <td width="103" height="44" bgcolor="#FF9900" class="up_row" align="center">عملیات </td>
                 <td width="89" bgcolor="#FF9900" class="up_row" align="center">وضعیت</td>
                 <td bgcolor="#FF9900" class="up_row" align="center">پیش نمایش </td>
                 <td bgcolor="#FF9900" class="up_row" align="center">انتخاب و ارسال فایل</td>
                 <td bgcolor="#FF9900" class="up_row" align="center">عنوان فایل </td>
               </tr>
               <tr>
                 <td height="52" align="center" bgcolor="#CCCCCC"><input type="submit" name="del_form_1" value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
  		<?php  
		$pic20 = '../files/ok.png' ;
		if ($row['form_1']=="")
		{
		$pic20 = '../files/notok.png'
		 ?>
		disabled="disabled"  
		<?php
		}
		?>
	  /></td>
                 <td height="52" align="center" bgcolor="#CCCCCC"><img src="<?php echo $pic20 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="109" height="52" align="center" bgcolor="#CCCCCC"><span class="up_row">
                   <?php if($row['form_1']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['form_1'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['form_1'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="325" height="52" bgcolor="#CCCCCC"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['form_1']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="form_1" accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="form_1" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center" bgcolor="#CCCCCC" >تقاضانامه / فرم  یک </td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center" bgcolor="#CCCCCC"><input type="submit" name="del_form_2"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic21 = '../files/ok.png' ;
		 if ($row['form_2']=="")
		{
		$pic21 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		 /></td>
                 <td width="89" align="center" bgcolor="#CCCCCC"><img src="<?php echo $pic21 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="109" height="53" align="center" bgcolor="#CCCCCC"><span class="up_row">
                   <?php if($row['form_2']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['form_2'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['form_2'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="325" height="53" bgcolor="#CCCCCC"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['form_2']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="form_2"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="form_2" />
                  <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center" bgcolor="#CCCCCC">شناسائی اراضی/ فرم  دو </td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center"><input type="submit" name="del_sh"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic1 = '../files/ok.png' ;
		 if ($row['sh']=="")
		{
		$pic1 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		 /></td>
                 <td width="89" align="center"><img src="<?php echo $pic1 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="109" height="53" align="center"><span class="up_row">
                   <?php if($row['sh']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['sh'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['sh'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="325" height="53"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['sh']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="sh"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="sh" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center">شناسنامه</td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center"><input type="submit" name="del_cart_m"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic2 = '../files/ok.png' ;
		 if ($row['cart_m']=="")
		{
		$pic2 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center"><img src="<?php echo $pic2 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="109" height="53" align="center"><span class="up_row">
                   <?php if($row['cart_m']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['cart_m'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['cart_m'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="325" height="53"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['cart_m']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="cart_m"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="cart_m" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center"><span class="up_row">کارت ملی</span></td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center" bgcolor="#CCCCCC"><input type="submit" name="del_t_sabt"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic3 = '../files/ok.png' ;
		 if ($row['t_sabt']=="")
		{
		$pic3 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center" bgcolor="#CCCCCC"><img src="<?php echo $pic3 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="109" height="53" align="center" bgcolor="#CCCCCC"><span class="up_row">
                   <?php if($row['t_sabt']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['t_sabt'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['t_sabt'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="325" height="53" bgcolor="#CCCCCC"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['t_sabt']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="t_sabt"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="t_sabt" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center" bgcolor="#CCCCCC"><span class="up_row"> تعهد ثبتی درختان </span></td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center"><input type="submit" name="del_s_mal"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "  
		<?php 
		$pic4 = '../files/ok.png' ;
		 if ($row['s_mal']=="")
		{
		$pic4 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center"><img src="<?php echo $pic4 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="110" height="53" align="center"><span class="up_row">
                   <?php if($row['s_mal']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['s_mal'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['s_mal'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="324" height="53"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['s_mal']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="s_mal"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="s_mal" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center"><span class="up_row">1 سند مالکیت</span></td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center" bgcolor="#CCCCCC"><input type="submit" name="del_s_mal2"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "  
		<?php 
		$pic24 = '../files/ok.png' ;
		 if ($row['s_mal2']=="")
		{
		$pic24 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center" bgcolor="#CCCCCC"><img src="<?php echo $pic24 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="110" height="53" align="center" bgcolor="#CCCCCC"><span class="up_row">
                   <?php if($row['s_mal2']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['s_mal2'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['s_mal2'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="324" height="53" bgcolor="#CCCCCC"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['s_mal2']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="s_mal2"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="s_mal2" />
                  <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center" bgcolor="#CCCCCC"><span class="up_row"> 2 سند مالکیت</span></td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center"><input type="submit" name="del_s_mal3"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "  
		<?php 
		$pic25 = '../files/ok.png' ;
		 if ($row['s_mal3']=="")
		{
		$pic25 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center"><img src="<?php echo $pic25 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="110" height="53" align="center"><span class="up_row">
                   <?php if($row['s_mal3']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['s_mal3'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['s_mal3'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="324" height="53"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['s_mal3']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="s_mal3"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="s_mal3" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center"><span class="up_row"> 3 سند مالکیت</span></td>
               </tr>
             </table>
           </form>

           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center" bgcolor="#CCCCCC"><input type="submit" name="del_utm"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic22 = '../files/ok.png' ;
		 if ($row['utm']=="")
		{
		$pic22 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center" bgcolor="#CCCCCC"><img src="<?php echo $pic22 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="109" height="53" align="center" bgcolor="#CCCCCC"><span class="up_row">
                   <?php if($row['utm']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['utm'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['utm'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="325" height="53" bgcolor="#CCCCCC"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['utm']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="utm"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="utm" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center" bgcolor="#CCCCCC">UTM / مختصات </td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center"><input type="submit" name="del_form_3"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic23 = '../files/ok.png' ;
		 if ($row['form_3']=="")
		{
		$pic23 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center"><img src="<?php echo $pic23 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="109" height="53" align="center"><span class="up_row">
                   <?php if($row['form_3']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['form_3'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['form_3'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="325" height="53"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['form_3']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="form_3"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="form_3" />
                  <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center"><span class="up_row">استعلام / فرم سه</span></td>
               </tr>
             </table>
           </form>

           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center" bgcolor="#CCCCCC"><input type="submit" name="del_s_ab"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic5 = '../files/ok.png' ;
		 if ($row['s_ab']=="")
		{
		$pic5 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center" bgcolor="#CCCCCC"><img src="<?php echo $pic5 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="109" height="53" align="center" bgcolor="#CCCCCC"><span class="up_row">
                   <?php if($row['s_ab']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['s_ab'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['s_ab'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="325" height="53" bgcolor="#CCCCCC"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['s_ab']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="s_ab"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="s_ab" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center" bgcolor="#CCCCCC"><span class="up_row">اسناد حقابه</span></td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center"><input type="submit" name="del_n_azma"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic6 = '../files/ok.png' ;
		 if ($row['n_azma']=="")
		{
		$pic6 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center"><img src="<?php echo $pic6 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="109" height="53" align="center"><span class="up_row">
                   <?php if($row['n_azma']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['n_azma'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['n_azma'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="325" height="53"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['n_azma']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="n_azma"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="n_azma" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center"><span class="up_row">نتایج آزمایشات آب و خاک</span></td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center" bgcolor="#CCCCCC"><input type="submit" name="del_s_codp" value="حذف کد"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic7 = '../files/ok.png' ;
		 if ($row['s_codp']=="")
		{
		$pic7 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center" bgcolor="#CCCCCC"><img src="<?php echo $pic7 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="109" height="53" align="center" bgcolor="#CCCCCC"><span class="up_row">
                   <input type="text" name="s_codp"  value="<?php  echo $row['s_codp'] ;?>"   dir="ltr"  readonly="readonly" style="width:80px; height:28px"/>
                 </span></td>
                 <td width="325" height="53" align="center" bgcolor="#CCCCCC"><input type="submit" value="ثبت کد" name="action3"  style="width:80px; height:28px ;  font-family:Tahoma, Geneva, sans-serif " />
                   <input type="text" name="s_codp" style="width:150px; height:30px " />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" />
                   </td>
                 <td width="202" align="center" bgcolor="#CCCCCC"><span class="up_row">کد پیگیری سامانه ملی</span></td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center"><input type="submit" name="del_m_shahar"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic8 = '../files/ok.png' ;
		 if ($row['m_shahar']=="")
		{
		$pic8 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center"><img src="<?php echo $pic8 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="109" height="53" align="center"><span class="up_row">
                   <?php if($row['m_shahar']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['m_shahar'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['m_shahar'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="325" height="53"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['m_shahar']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="m_shahar"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="m_shahar" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center"><span class="up_row">معرفی نامه شهرستان حهت طراحی</span></td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center" bgcolor="#CCCCCC"><input type="submit" name="del_f_esht"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic8 = '../files/ok.png' ;
		 if ($row['f_esht']=="")
		{
		$pic8 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center" bgcolor="#CCCCCC"><img src="<?php echo $pic8 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="108" height="53" align="center" bgcolor="#CCCCCC"><span class="up_row">
                   <?php if($row['f_esht']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['f_esht'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['f_esht'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="326" height="53" bgcolor="#CCCCCC"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['f_esht']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="f_esht"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="f_esht" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center" bgcolor="#CCCCCC"><span class="up_row">فرم انتخاب شرکت طراح</span></td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center"><input type="submit" name="del_m_nezbt"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic9 = '../files/ok.png' ;
		 if ($row['m_nezbt']=="")
		{
		$pic9 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center"><img src="<?php echo $pic9 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="107" height="53" align="center"><span class="up_row">
                   <?php if($row['m_nezbt']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['m_nezbt'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['m_nezbt'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="327" height="53"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['m_nezbt']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="m_nezbt"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="m_nezbt" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center"><span class="up_row">معرفی نامه نظام به شرکت طراح</span></td>
               </tr>
             </table>
           </form>
           <form action="" method="post" enctype="multipart/form-data">
             <table width="850px" border="1" align="center" cellpadding="0" cellspacing="0" >
               <tr>
                 <td width="103" height="53" align="center"><input type="submit" name="del_sayer"  value="حذف فایل"   style="width:70px; height:33px ; font-family:Tahoma, Geneva, sans-serif "
		<?php 
		$pic26 = '../files/ok.png' ;
		 if ($row['sayer']=="")
		{
		$pic26 = '../files/notok.png' ;
		 ?>
		disabled="disabled"
		<?php
		}
		?>
		
		 /></td>
                 <td width="89" align="center"><img src="<?php echo $pic26 ;?>" width="39" height="39"  alt=""/></td>
                 <td width="107" height="53" align="center"><span class="up_row">
                   <?php if($row['sayer']<>""){?>
                   <a href="<?php echo'savefiles/'.$id.'/'.$row['sayer'];?>" target="_blank" title="نمایش تصویر ارسالی"><img src="<?php echo'savefiles/'.$id.'/'.$row['sayer'];?>" width="30" height="50"/></a>
                   <?php }?>
                 </span></td>
                 <td width="327" height="53"><input type="submit" value="ارسال فايل" name="action4"  <?php if($row['sayer']<>"") { echo ' disabled="disabled"';}?>/>
                   <input type="file" name="sayer"  accept=".jpg,.jpeg,.gif,.png" />
                   <input type="hidden" name="no_file" value="sayer" />
                   <input type="hidden" name="cod_p" value="<?php echo $id ;?>" /></td>
                 <td width="202" align="center"><span class="up_row">سایر مدارک</span></td>
               </tr>
             </table>
           </form>

           <p>&nbsp;</p>
           <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" >
   <tr>
     <td width="212">
         <form action="../send_request.php" method="post">
         <input type="hidden" name="cod_p" value="<?php echo $cod_id ;?>" />
         <button title="تائید و ارسال درخواست"><img src="../files/sent.png"  alt="ارسال درخواست" width="75" height="65" border="0"/></button>
         </form>
      </td>
     <td width="218">
         <form action="view_attach.php" method="post">
         <input type="hidden" name="cod_p" value="<?php echo $cod_id ;?>" />
         <button title="مشاهده فایل های تصویر"><img src="../files/photo-gallery-icon.png"  alt="مشاهده فایل های تصویری ارسال شده" width="75" height="65" border="0"/></button>
         </form>
      </td>
     <td width="170" style="text-align: center">
         <form action="download.php" method="post">
         <input type="hidden" name="cod_p" value="<?php echo $cod_id ;?>" />
         <button title="دانلود کلیه فایل های پیوستی درخواست"><img src="../files/downloadzip.png"  alt="" width="75" height="65" border="0"/></button>
         </form>
     </td>
   </tr>
 </table>
 
 <p align="center"><a href="../index.php" title="برگشت به صفحه اصلی" ><img src="../files/goback.jpg" width="128" height="57" border="0" /></a></p>
   <?php
   } else {
?>
 </p>
</p>
<p>
  <?php
 echo 'شما مجوز دسترسي به اين صفحه را نداريد'  ; 
 }
?>
            
            
  <?php
// فانكشن آپلود فايل 
function upload($file_id, $folder="", $types="",$id) 
{
// پوشه نام 
$cod_p = $_POST['cod_p'] ;
// بررسی وجود پوشه و ایجاد پوشه 
if (!file_exists('savefiles/'.$cod_p)) {
    mkdir('savefiles/'.$cod_p, 0777, true);
}
    if(!$_FILES[$file_id]['name']) return array('','No file specified');

    $file_title = $_FILES[$file_id]['name'];
    //Get file extension
   // $ext_arr = split("\.",basename($file_title));
   // $ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension
	$ext = substr(strrchr(basename($file_title), '.'), 1);
    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(),1)),0,5);
  //  $file_name = $id . '_' . $file_title;//Get Unique Name
    $no_file = $_POST['no_file']   ;
    $file_name = $no_file.'.' . $ext;//Get Unique Name
    $all_types = explode(",",strtolower($types));
    if($types) {
        if(in_array($ext,$all_types));
        else {
            $result = 'فايل غير مجاز' ;
			echo "<br/>\n" ;
			 //Show error if any.
        //   return array('',$result);
		  return array($file_name,$result);
        }
    }
    //Where the file must be uploaded to
    if($folder) $folder .= '/';//Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;

    $result = 1;
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "امكان آپلود فايل وجود ندارد "; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : مقصد يافت نشد ";
        } elseif(!is_writable($folder)) {
            $result .= " : امكان نوشتن در مقصد وجود ندارد";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : فايل قابل نوشتن نيست";
        }
        $file_name = '';
        
    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result =  " فايل خالي است لطفا يك فايل معتبر انتخاب كنيد "; //Show the error message
			echo "<br/>\n" ;
        } else {
// کنترل حجم فایل
   
switch ($file_id)
 {
  case "sh":
        $max_filesize = 150000;
    break;
  case "cart_m":
        $max_filesize = 150000;
    break;
  case "t_sabt":
        $max_filesize = 250000;
    break;
  case "s_mal":
        $max_filesize = 350000;
    break;
  case "s_mal2":
        $max_filesize = 350000;
    break;
  case "s_mal3":
        $max_filesize = 350000;
    break;

  case "s_ab":
        $max_filesize = 150000;
  break;
  case "n_azma":
        $max_filesize = 150000;
  break;
  case "m_shahar":
        $max_filesize = 150000;
  break;
  case "m_nezbt":
        $max_filesize = 350000;
  break;
  case "f_esht":
        $max_filesize = 150000;
  break;
  case "form_1":
        $max_filesize = 150000;
  break;
  case "form_2":
        $max_filesize = 350000;
  break;
  case "form_3":
        $max_filesize = 150000;
  break;
  case "utm":
        $max_filesize = 250000;
  break;
  case "sayer":
        $max_filesize = 250000;
  break;

}
            $size=filesize($_FILES[$file_id]['tmp_name']);
//            $max_filesize = 122091;
            if($size > $max_filesize)
		   {
			$result = 'حجم فایل بزرگتر از حد مجاز'.$max_filesize ;
             }
			 chmod($uploadfile,0777);//Make it universally writable.
        }
    }
		  return array($file_name,$result);
}
////End
?>
    
    
     </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><p class="MenuItemRight">Copyright © 2014, سازمان نظام مهندسی کشاورزی و منابع طبیعی استان آذربایجان شرقی All Rights Reserved.</p>
      <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
    </tr>
</table>
</td>

</table>
</body>
</html>


