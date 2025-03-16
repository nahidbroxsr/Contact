<?php
$botToken = "7625765343:AAHT3yUTUtmKtSOv-EDhIYj5fhLynw-Icas";
$chatID = "7294674899";

$userNumber = $_POST['user_number'];
$transactionID = $_POST['transaction_id'];

$conn = new mysqli("localhost", "root", "", "your_database");
$conn->query("INSERT INTO activation_requests (user_number, transaction_id, status) VALUES ('$userNumber', '$transactionID', 'pending')");

$message = "🆕 নতুন একটিভেশন রিকোয়েস্ট:\n\n📞 নম্বর: $userNumber\n💳 ট্রানজেকশন আইডি: $transactionID";

$keyboard = json_encode([
    "inline_keyboard" => [
        [["text" => "✅ কনফার্ম", "callback_data" => "confirm_$transactionID"]],
        [["text" => "❌ ডিলিট", "callback_data" => "delete_$transactionID"]]
    ]
]);

$url = "https://api.telegram.org/bot$botToken/sendMessage";
$data = [
    'chat_id' => $chatID,
    'text' => $message,
    'reply_markup' => $keyboard
];

$options = [
    'http' => [
        'header'  => "Content-Type: application/json",
        'method'  => 'POST',
        'content' => json_encode($data),
    ]
];

$context  = stream_context_create($options);
file_get_contents($url, false, $context);

echo "Success";
?>
