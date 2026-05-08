<!--SuccessOK!-->
<?php
// DEBUG
ini_set("error_reporting", E_ALL);
ini_set("display_errors", "1");

// REQUIRE(INI)
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/ini/setting.php");

// REQUIRE(FUNCTION)
require_once($_SERVER["DOCUMENT_ROOT"] . "/../../admin/public_html/functions/functions.php");
// REQUIRE(CLASS)
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/class/InputForm.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/../../admin/public_html/class/enq/StudentLog.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/../../admin/public_html/class/enq/Qa.php");
require_once($_SERVER["DOCUMENT_ROOT"]. "/../../admin/public_html/class/enq/Video.php");

//require_once(__DIR__ . "/enq/functions/functions.php");

// 支付回调页面
if (isset($_REQUEST['result_code'])) {
    header("Location:https://www.kabu-college.com/bpm_payment.php");
    die;
}
if (isset($_REQUEST['cancel']))  {
    header("Location:https://www.kabu-college.com/bpm_payment.php");
    die;
}

$input_form_obj = new InputForm();
$input_form_obj->payCallbackLog(json_encode($_REQUEST));

$isF = $input_form_obj->isFristRuJin($_REQUEST['shop_data1']);
//$email = $input_form_obj->paySuccess($_REQUEST['money'],$_REQUEST['sendid'],$_REQUEST['rel']=='yes'?'1':2);
$email = $input_form_obj->paySuccess($_REQUEST['amount'],$_REQUEST['shop_data1'],1);


if(!isset($_SESSION)){
    session_start();
    $_SESSION['account'] = $_REQUEST['shop_data1'];
}
$id = !empty($_REQUEST['shop_data2']) ? $_REQUEST['shop_data2'] : '39';
$student_log_obj   = new StudentLog();
if (isset($_REQUEST['cancel']) && $_REQUEST['cancel']==1) {
    $msg =  "fail";
    $_REQUEST['rel'] = 'no';
} else {
    $msg =  "SuccessOK";
    $_REQUEST['rel'] = 'yes';
}
($student_log_obj->add($input_form_obj->getStudentLog($email,$id,$_REQUEST)));


//setLogs('支付回调',$_REQUEST,'payment');
//setLogs('支付回调2',$_GET,'payment');
//setLogs('支付回调2',file_get_contents("php://input") ,'payment');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>     <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />     <meta http-equiv="Pragma" content="no-cache" />     <meta http-equiv="Expires" content="0" />
    <!-- Google Tag Manager -->

    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=

            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

        })(window,document,'script','dataLayer','GTM-PWJHKGB');</script>

    <!-- End Google Tag Manager -->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=10.0, user-scalable=yes">
    <title>payment</title>

    <link href="https://www.kabu-college.com/LP/pay-f-v/css/aos.css" rel="stylesheet" type="text/css" />
    <link href="https://www.kabu-college.com/LP/pay-f-v/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://www.kabu-college.com/LP/pay-f-v/css/featherlight.min.css" rel="stylesheet" type="text/css" />
    <link href="https://www.kabu-college.com/LP/pay-f-v/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="https://www.kabu-college.com/LP/pay-f-v/css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .error-tip{
            text-align: left;
            color: red;
            display: none;
        }
    </style>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6KC6F063BS"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-6KC6F063BS');
    </script>

</head>

<body>
<!-- Google Tag Manager (noscript) -->

<div><?php  echo $msg; ?></div>





<script src="/LP/common/jquery.cookie.min.js"></script></body>
</html>




