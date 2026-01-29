<?php
// ===============================
// TikTok Events API – Download
// ===============================

// 🔐 KEEP THIS SECRET
$accessToken = 'YOUR_ACCESS_TOKEN_HERE';

$payload = [
  "event_source" => "web",
  "event_source_id" => "D5TL63BC77UECCBSFML0",
  "data" => [
    [
      "event" => "Download",
      "event_time" => time(),
      "user" => [
        "email" => null,
        "phone" => null,
        "external_id" => null
      ],
      "properties" => [
        "currency" => "PKR",
        "content_type" => "product"
      ],
      "page" => [
        "url" => $_SERVER['HTTP_REFERER'] ?? '',
        "referrer" => $_SERVER['HTTP_REFERER'] ?? ''
      ]
    ]
  ]
];

$ch = curl_init("https://business-api.tiktok.com/open_api/v1.3/event/track/");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Access-Token: $accessToken",
  "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// Optional logging
// file_put_contents('tiktok_log.txt', $response . PHP_EOL, FILE_APPEND);

http_response_code(200);
echo "OK";
