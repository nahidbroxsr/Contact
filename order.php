<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $player_id = $_POST['player_id'];
    $diamond_package = $_POST['diamond_package'];
    $payment_method = $_POST['payment_method'];
    $transaction_id = $_POST['transaction_id'];

    $sql = "INSERT INTO orders (player_id, diamond_package, payment_method, transaction_id, order_status)
            VALUES ('$player_id', '$diamond_package', '$payment_method', '$transaction_id', 'Pending')";

    if ($conn->query($sql) === TRUE) {
        header("Location: success.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>