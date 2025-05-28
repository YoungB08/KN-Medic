<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/config.php';
$uid = $_POST['uid'] ?? -1;
if ($uid > -1) {

    foreach ($KNCMS->get_list("SELECT * FROM `messages` WHERE `sender` = '$uid' ") as $row) {
        $isAI = $row['AI'];

        $result[] = [
            'id' => $row['id'],
            'msg' => $row['content'],
            'uid' => (int)$row['sender'],
            'time' => $row['created_at'],
            'ai' => $isAI
        ];
    }
    echo json_encode($result);
}
