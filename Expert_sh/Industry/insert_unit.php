<?php
include('../../lock_expsh.php');
include('../../login/config.php');
include('../../event.php');
include('../cod_m.php');
if (isset($_POST['identCode'])) $no_mal = $_POST['identCode'];
if (isset($_POST['action'])) {
    $identCode = $_POST["identCode"];
    if ($identCode == '') $mess = 'شماره پروانه بهره برداری را وارد کنید ' . '<p>';
    if ((isset($_POST['action'])) and ($mess == '')) {
            ?>
            <form name="myform1" class="myform" method="post" action="ind_unit_data.php">
                <input type="hidden" name="identCode" value="<?php echo $identCode; ?>"/>
            </form>
            <script type="text/javascript">document.myform1.submit();</script>
            <?php
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css"/>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <title><?php echo $title; ?></title>
    <style type="text/css">
        #error {
            display: block;
            color: red;
            font-style: italic;
        }

        #message {
            display: none;
            font-size: 15px;
            font-weight: bold;
            color: #333333;
        }
#div{
background-color:#FFF;
color:#036;
border-radius:15px;
border:1px solid #d3cd3d;
padding:4px 30px;
font-weight:700;
width:400px;
font-size:12px;
height:auto;
margin:auto
}
.new_btn
{
width:150px ;
 height:45px;
 border-radius:5px;
 font-size:15px 
}
.new_btn:hover {
 background-color:rgb(153,0,0) ; 
 color:rgb(255,255,255) ;
 font-size:14px 
}

    </style>
</head>
<body>

<div id="rasul" style="width: 100%; height: 100%; background: #726d6d; display: none;  opacity: 0.6; position: fixed; z-index: 4;">
    <img src="img/loading2.gif" style="margin: auto;float: right;z-index: 93;width: 90px;min-height: 50px;position: fixed;left: 0;right: 0;margin: 200px auto;">
    
</div>

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td><img src="../../files/images/header.jpg" width="100%" height="149"/></td>
    </tr>
    <tr>
        <td><?php include('menu.php'); ?>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                    <td width="4"><p>&nbsp;</p>
                        <p>&nbsp;</p></td>
                    <?php include('top.php'); ?>
                    <td width="840">

                        <p class="style8">ثبت اطلاعات واحد صنعتی جدید</p>
                        <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19" alt=""/></p>
                        <div id="div">
                            <div id="error"><?php if (isset($mess)) echo $mess ?>
                            <a name="1" id="1"></a></div>
                            <form id="form" name="form1" action="#1" method="post">
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="18%" height="68" align="right">
                                            <div align="right">
                                                <input name="identCode" type="text" class="required" id="identCode" tabindex="1"
                                                       value="<?php if (isset($_POST['identCode'])) echo $identCode; ?>" maxlength="10"/>
                                            </div>
                                        </td>
                                        <td width="31%">
                                            <div align="right"> : شماره پروانه بهره برداری</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="107" colspan="2">
      <input type="submit" name="action" value="ادامه" class="new_btn" tabindex="3" id="sub" /> 
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <p>&nbsp;</p>
                        <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg"
                                                                                 width="118" height="47" alt=""/> </a>
                        </p>
                        <p>&nbsp;</p></td>
                </tr>
                <tr>
                    <td height="109" colspan="3" valign="middle"
                        background="../../files/bottom.gif"><?php include('../../footer.php') ?></td>
                </tr>
            </table>
</table>
</body>
</html>