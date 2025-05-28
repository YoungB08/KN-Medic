<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/gpt.php';
$gpt = new GPTDoctor('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');
// $ai_rep = $gpt->ask($msg);
// $KNCMS->query("INSERT INTO `messages` (sender, content, AI) VALUES ('$uid', '$ai_rep', '1')");

foreach($KNCMS->get_list("SELECT * FROM `messages` WHERE `reply` = '0' AND `AI` = '0'") as $reply)
{
    $ai_rep = $gpt->ask($reply['content']);
    $KNCMS->query("INSERT INTO `messages` (sender, content, AI, reply) VALUES ('".$reply['sender']."', '$ai_rep', '1', '1')");
    $KNCMS->query("UPDATE `messages` SET `reply` = '1' WHERE `id` ='".$reply['id']."'");

    echo 'reply id '.$reply['id'].PHP_EOL;
}
