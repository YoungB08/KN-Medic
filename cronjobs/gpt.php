<?php
include $_SERVER['DOCUMENT_ROOT'] . '/functions/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/models/gpt.php';

$gpt = new GPTDoctor('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');

// Lấy 1 message chưa trả lời (chỉ 1 bản ghi để giới hạn 1 lần xử lý 1 tin nhắn)
$messages = $KNCMS->get_list("SELECT * FROM `messages` WHERE `reply` = '0' AND `AI` = '0' LIMIT 1");
if (count($messages) > 0) {
    $reply = $messages[0];

    // Gọi GPT trả lời
    $ai_rep = $gpt->ask($reply['content']);

    // Thêm tin nhắn trả lời vào DB
    $KNCMS->query("INSERT INTO `messages` (sender, content, AI, reply) VALUES ('" . $reply['sender'] . "', '" . $ai_rep . "', '1', '1')");

    // Cập nhật trạng thái đã trả lời
    $KNCMS->query("UPDATE `messages` SET `reply` = '1' WHERE `id` = '" . $reply['id'] . "'");

    echo 'Replied to message id ' . $reply['id'] . PHP_EOL;
}
