<?php
include('login/config.php');
include('event.php');
require_once('Jalali.php');
date_default_timezone_set('Asia/Tehran');
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');
$bday = substr($date_edit, 5);
$bday = str_replace('/', '-', $bday); 

$query = "SELECT username, id_ostan, id_mar, jens FROM users WHERE date_t LIKE  '%$bday%'";
$stmt = $dbh->prepare($query);
$stmt->execute();

$messages = array(
  "همکار گرامی {jens} {r_user_name}\n\nبا سلام و احترام\nسالروز تولدتان را تبریک عرض کرده و از خداوند بزرگ برایتان سلامتی، آرامش و کامیابی در مسیر زندگی آرزو می‌کنیم.\nبا احترام: پشتیبان سامانه",
  "{jens} {r_user_name} عزیز\n\nفرارسیدن روز میلاد شما را گرامی داشته و امیدواریم سال پیش‌رو سرشار از لحظات شیرین، موفقیت‌های تازه و روزهای روشن باشد.\nبا آرزوی بهترین‌ها: پشتیبان سامانه",
  "همکار محترم {jens} {r_user_name}\n\nتولدتان مبارک. برای شما سالی پربار، همراه با توفیق، شفقت و آرامش آرزو می‌نماییم. حضور ارزشمندتان در مجموعه مایه دلگرمی است.\nبا احترام: پشتیبان سامانه",
  "همکار گرامی {jens} {r_user_name}\n\nضمن تبریک صمیمانه به مناسبت روز تولدتان، از درگاه خداوند متعال شادی‌های پایدار و موفقیت‌های روزافزون برایتان مسئلت داریم.\nبا احترام: پشتیبانی سامانه",
  "{jens} {r_user_name} عزیز\n\nامیدواریم سال جدید زندگی‌تان آغازی باشد بر روزهایی روشن‌تر، دستاوردهایی ارزشمندتر و حال دلی بهتر. تولدتان را تبریک می‌گوییم.\nبا احترام: پشتیبان سامانه",
  "همکار ارجمند {jens} {r_user_name}\n\nزادروزتان خجسته باد. برای شما شادی، سلامتی و گام‌هایی استوار در مسیر موفقیت آرزو داریم.\nبا احترام: پشتیبان سامانه",
  "همکار محترم {jens} {r_user_name}\n\nبه مناسبت فرارسیدن روز تولدتان، صمیمانه‌ترین تبریکات ما را پذیرا باشید. امیدواریم سال پیش‌رو برایتان سرشار از خیر و برکت باشد.\nبا احترام: پشتیبانی سامانه",
  "{jens} {r_user_name} گرامی\n\nاین روز زیبا که آغاز فصل تازه‌ای از زندگی شماست، بر شما مبارک باد. آرزومندیم همیشه در مسیر رشد و موفقیت قدم بردارید.\nبا احترام: پشتیبان سامانه",
  "همکار عزیز {jens} {r_user_name}\n\nتولدتان را صمیمانه تبریک می‌گوییم و از خداوند منان برای شما سالی سرشار از امید، سعادت و آرامش آرزومندیم.\nبا احترام: پشتیبانی سامانه",
  "همکار محترم {jens} {r_user_name}\n\nدر سالروز تولدتان، بهترین‌ها را برای شما از درگاه خداوند مهربان خواهانیم. امیدواریم همواره در مسیر زندگی و کار بدرخشید.\nبا احترام: پشتیبان سامانه"
);

foreach ($stmt as $row) {
    $num = rand(0, 9); // Random message index (0 to 4)
    $mor_cod_m = $row['username'];
    $id_ostan = $row['id_ostan'];
    $id_mar = $row['id_mar'];
    $jens = $row['jens'];
    $v_jens = ($jens == 'مرد') ? 'جناب آقای' : 'سرکار خانم';
    
    // Get user name and set up other variables
    $r_user_name = user_name($mor_cod_m);
    $file_send = 'bd.jpg';
    $title1 = 'تبریک';
    $r_user = $mor_cod_m;
    $s_user = '1380066174'; // Example static user ID

    // Select message
    $message = str_replace(
        array('{jens}', '{r_user_name}'), 
        array($v_jens, $r_user_name), 
        $messages[$num]
    );

    // Insert the message into the database
    $query = "INSERT INTO pm (file, title, r_user, s_user, message, no_pm, s_date, s_time) 
              VALUES (:file, :title, :r_user, :s_user, :message, :no_pm, :s_date, :s_time)";
    $q = $dbh->prepare($query);
    $q->execute(array(
        ':file' => $file_send,
        ':title' => $title1,
        ':r_user' => $r_user,
        ':s_user' => $s_user,
        ':message' => $message,
        ':no_pm' => '1',
        ':s_date' => $date_edit,
        ':s_time' => $time
    ));
}

echo 'تمام';
?>
