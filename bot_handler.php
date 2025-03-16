<?php
$botToken = "7625765343:AAHT3yUTUtmKtSOv-EDhIYj5fhLynw-Icas";
$conn = new mysqli("localhost", "root", "", "your_database");

$data = json_decode(file_get_contents("php://input"), true);
$callbackData = $data["callback_query"]["data"];
$chatID = $data["callback_query"]["message"]["chat"]["id"];

if (strpos($callbackData, "confirm_") !== false) {
    $transactionID = str_replace("confirm_", "", $callbackData);
    $conn->query("UPDATE activation_requests SET status='active' WHERE transaction_id='$transactionID'");
    file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatID&text=✅ একাউন্ট একটিভ করা হয়েছে!");
} elseif (strpos($callbackData, "delete_") !== false) {
    $transactionID = str_replace("delete_", "", $callbackData);
    $conn->query("DELETE FROM activation_requests WHERE transaction_id='$transactionID'");
    file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatID&text=❌ রিকোয়েস্ট বাতিল করা হয়েছে!");
}
?>
