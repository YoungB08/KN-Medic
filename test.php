<?php
// URL bạn muốn gửi POST tới
$url = 'http://localhost/API/SendAI-Chat';

// Dữ liệu POST
$data = [
    'content' => 'Chào bác sĩ Gấu, tôi nhớ người yêu?',
    'user' => 5
];

// Khởi tạo cURL
$ch = curl_init($url);

// Thiết lập tùy chọn
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/x-www-form-urlencoded'
    ],
    CURLOPT_POSTFIELDS => http_build_query($data)
]);

// Gửi yêu cầu và lấy phản hồi
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Hiển thị kết quả
echo "HTTP Code: $httpCode\n";
echo "Response:\n$response\n";
