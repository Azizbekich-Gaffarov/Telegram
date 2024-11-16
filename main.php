<?php

// Telegram bot tokeningizni kiriting
$API_TOKEN = '7604142432:AAFMR8t6vKBl08iWDci67ECPcmj4r37NO0c';

// Webhook ma'lumotlarini olish
$content = file_get_contents("php://input");
$update = json_decode($content, true);

// Agar yangilanish mavjud bo'lsa
if ($update) {
    $chat_id = $update['message']['chat']['id'];
    $text = $update['message']['text'];

    // `/start` buyrug'iga javob
    if ($text === '/start') {
        sendMessage($chat_id, "Salom!");
    } else {
        // Foydalanuvchiga qaytarish (echo)
        sendMessage($chat_id, $text);
    }
}

// Xabar jo'natish funksiyasi
function sendMessage($chat_id, $text) {
    global $API_TOKEN;
    $url = "https://api.telegram.org/bot$API_TOKEN/sendMessage";

    $post_fields = [
        'chat_id' => $chat_id,
        'text' => $text
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

?>
