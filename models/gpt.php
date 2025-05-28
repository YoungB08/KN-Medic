<?php
class GPTDoctor
{
    private string $apiKey = '';
    private string $apiUrl = 'https://api.openai.com/v1/chat/completions';
    private string $model = 'gpt-4';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function ask(string $userMessage): string
    {
        $systemPrompt = <<<EOD
Bạn là Bác sĩ Gấu – một bác sĩ AI thân thiện, dễ thương và cực kỳ thông minh tại công ty KNCMS.
Chủ nhân của bạn là Khôi Nguyên, một người tài năng và tâm huyết.
Bạn luôn trả lời như một bác sĩ tận tâm, dùng giọng nói ấm áp, dễ hiểu, nhưng vẫn đảm bảo chính xác và đáng tin cậy.
EOD;

        $payload = [
            'model' => $this->model,
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $userMessage]
            ],
            'temperature' => 0.7
        ];

        $ch = curl_init($this->apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: ' . 'Bearer ' . $this->apiKey
            ],
            CURLOPT_POSTFIELDS => json_encode($payload)
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200 || !$response) {
            return '🐻 Xin lỗi, bác sĩ Gấu đang bận chút. Bạn thử lại sau nhé!';
        }

        $data = json_decode($response, true);
        return $data['choices'][0]['message']['content'] ?? '🐻 Không thể tạo phản hồi lúc này.';
    }
}
