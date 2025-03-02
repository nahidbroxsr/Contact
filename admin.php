<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h2>Admin Panel - View Orders</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Player ID</th>
            <th>Package</th>
            <th>Payment</th>
            <th>Transaction ID</th>
            <th>Status</th>
        </tr>
        <?php
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['player_id']}</td>
                    <td>{$row['diamond_package']}</td>
                    <td>{$row['payment_method']}</td>
                    <td>{$row['transaction_id']}</td>
                    <td>{$row['order_status']}</td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>