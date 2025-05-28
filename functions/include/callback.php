<?php
include_once "../config.php'";

$callback_sign = md5($partner_key . $_GET['code'] . $_GET['serial']);
if ($_GET['callback_sign'] == $callback_sign) {
    $getdata['status'] = $_GET['status'];
    $getdata['message'] = $_GET['message'];
    $getdata['request_id'] = $_GET['request_id'];
    $getdata['trans_id'] = $_GET['trans_id'];
    $getdata['value'] = $_GET['value'];
    $getdata['amount'] = $_GET['amount'];
    $getdata['code'] = $_GET['code'];
    $getdata['serial'] = $_GET['serial'];
    $getdata['telco'] = $_GET['telco'];
    $code =  $_GET['code'];
    $seri =  $_GET['serial'];
}
$card = $KNCMS->query("SELECT * FROM `kncms_napthe` WHERE `code` = '$code' AND `serial` = '$seri'");

foreach($getdata as $data)
{
    echo $data . "<br>";
}

$status = $_GET['status'];
$uid = $card['uid'];
if ($_GET['status'] == '1') {
    $usercard = $KNCMS->query("SELECT * FROM `users` WHERE `uid` = '$uid'");
    $coin = $usercard['kncms_coin']+=((int) $getdata['amount'])/10;
    $cash = $KNCMS->format_cash($getdata['amount']);
    $update_coin = $KNCMS->query("UPDATE `users` SET 
    `kncms_coin` = '$coin' WHERE `uid` = '$uid'");
    KNCMS_Log("Bạn đã nạp thành công $cash vào tài khoản", $uid);
    
    if($update_coin)
    {
        $update_status = $KNCMS->query("UPDATE `kncms_napthe` SET
        `status` = '$status'
        WHERE `code` = '$code' AND `serial` = '$seri' ");
    }
}