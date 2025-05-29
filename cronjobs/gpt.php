<?php
include $_SERVER['DOCUMENT_ROOT'] . '/functions/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/models/gpt.php';

$gpt = new GPTDoctor('');
foreach($KNCMS->get_list("SELECT * FROM `messages` WHERE `reply` = '0' AND `AI` = '0'") as $reply)
{

    $ai_rep = $gpt->ask($reply['content']);

    // Thêm tin nhắn trả lời vào DB
    $KNCMS->query("INSERT INTO `messages` (sender, content, AI, reply) VALUES ('" . $reply['sender'] . "', '" . $ai_rep . "', '1', '1')");

    // Cập nhật trạng thái đã trả lời
    $KNCMS->query("UPDATE `messages` SET `reply` = '1' WHERE `id` = '" . $reply['id'] . "'");

    echo 'Replied to message id ' . $reply['id'] . PHP_EOL;
    return 1;
}
