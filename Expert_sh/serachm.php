<html>
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
     <title>جستجوی کاربر</title>
    <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="typeahead.min.js"></script>
    <script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search.php?key=%QUERY',
        limit : 15
    });
});
    </script>
    <style type="text/css">
.bs-example{
	font-family: Tahoma;
	position: relative;
	margin: 50px;
	text-align: center;
}
.typeahead, .tt-query, .tt-hint {
	border: 2px solid #CCCCCC;
	border-radius: 8px;
	font-size: 16px;
	height: 30px;
	line-height: 30px;
	outline: medium none;
	padding: 8px 12px;
	width: 396px;
}
.typeahead {
	background-color: #FFFFFF;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
	color: #999999;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 12px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {
	font-size: 14px;
	line-height: 24px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}
    </style>
  </head>
  <body>
  <form action="" name='myform' method="post">
    <div class="row">
      <div class=".col-md-6">
        <div class="panel panel-default">
    <div dir="rtl" class="bs-example">
        <p>
          <input type="text" dir="rtl" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="نام خانوادگی">
        </p>
        <p>&nbsp;</p>
        <p>
          <input type="submit" name="action" value="تایید" style=" margin:auto ; width:100px ; height:45px ; font-size:10px"" tabindex="9" />
        </p>
        
    </div>
  </div>
</div>
  </div>
  </form>
  <?php 
 if (isset($_POST['action'])) 
    {  
//   echo $_POST['typeahead'].'<p>' ; 
//echo stristr($_POST['typeahead'],"1");
$b = strpos($_POST['typeahead'],'-').'<p>' ;
$a= strlen($_POST['typeahead']);
$c = $a - $b ;
$cod_m =  substr($_POST['typeahead'],$b+1,$c) ;

include('../login/config.php');
$query = "SELECT * FROM  log where username = $cod_m ORDER BY date DESC , time DESC" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
           <p style="text-align: center">مشاهده عملکرد کاربر در سامانه </p>
           <p style="text-align: center"><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <p>&nbsp;</p>
<? echo $cod_m ; ?>
  <table width="85%" height="97" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="style8">
    <td width="11%"  bgcolor="#CCCCCC">ساعت</td>
    <td width="10%"  bgcolor="#CCCCCC">تاریخ</td>
    <td width="22%"  bgcolor="#CCCCCC">عملیات</td>
    <td width="30%"  bgcolor="#CCCCCC">آدرس آماری آبادی</td>
    <td width="21%"  bgcolor="#CCCCCC">آی پی سیستم </td>
    <td width="6%"  bgcolor="#CCCCCC">ردیف</td>

  </tr>
  <tr>
<?php
$r = 1 ;
 foreach($stmt as $row){
?>
    <td class="normalTextSmaller"><?php echo $row['time'];?></td>
    <td class="normalTextSmaller"><?php echo $row['date'];?></td>
    <td class="normalTextSmaller"><?php echo $row['verb'];?></td>
    <td class="normalTextSmaller"><?php echo $row['add_abadi'];?></td>
    <td class="normalTextSmaller"><?php echo $row['ip'];?></td>
    <td><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
<?php
}
	?>
</body>
</html>
