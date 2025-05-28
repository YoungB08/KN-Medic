<?php
include_once "../config.php'";
$token_auth = $knsite['TokenMomo'];
$data = $KNCMS->curl_get('https://api.sieuthicode.net/historyapimomo/' . $token_auth . '');
$result = json_decode($data, true);

foreach ($result['momoMsg']['tranList'] as $data) {
    $stt        = $data['io'];
    if ($stt == 1) {
        $sdt        = $data['partnerId'];
        $userbank   = $data['partnerName'];
        $sotien     = $data['amount'];
        $nd         = $KNCMS->anti_text($data['comment']);
        // $nd = "Khoi_Nguyenz";
        $mgd        = $data['tranId'];
        $naptien = $KNCMS->query("SELECT * FROM `accounts` WHERE `Username` = '$nd' ");
        if ($naptien->num_rows > 0) {
            $naptien = $naptien->fetch_array();
            $playernap = $naptien['Username'];
            $playerid = $naptien['id'];
            if (!check_rows($mgd, "kncms_momo", "mgd")) {
                $coin = $naptien['Coins'] + ($sotien / 10);
                $updatecoin = $KNCMS->query("UPDATE `accounts` SET 
                `Coins` = '$coin' WHERE `Username` = '$nd' ");
                $logmomo = $KNCMS->query("INSERT INTO `kncms_momo` SET
                `user` = '$playernap',
                `sdt` = '$sdt',
                `sotien` = '$sotien',
                `noidung` = '$nd',
                `uid` = '$playerid',
                `mgd` = '$mgd'");
                if ($updatecoin == 1 && $logmomo == 1) {
                    KNCMS_Log("Bạn đã nạp thành công $sotien vào tài khoản thông qua MOMO", $playerid);
                    echo "Bạn đã nạp thành công $sotien vào tài khoản thông qua MOMO";
                }
            }
        }
    }
}