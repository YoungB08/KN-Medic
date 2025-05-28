<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/config.php';
$msg = $_POST['content'] ?? '';
$uid = $_POST['user'] ?? '';
if (empty($msg)) {
    echo json_encode([
        'status' => 2,
        'msg' => 'Chưa nhập tin nhắn!'
    ]);
    return 0;
}

if ($KNCMS->query("INSERT INTO `messages` (sender, content) VALUES ('$uid', '$msg')")) {
    echo json_encode([
        'status' => 1,
        'msg' => 'Gửi tin nhắn thành công!'
    ]);
    
}
