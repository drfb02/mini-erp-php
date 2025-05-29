<?php
include 'config.php';
$productCount = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'];
$orderCount = $conn->query("SELECT COUNT(*) AS total FROM orders")->fetch_assoc()['total'];
$lowStock = $conn->query("SELECT COUNT(*) AS total FROM products WHERE quantity < minimum_stock")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
<h2>Dashboard Summary</h2>
<ul>
    <li>Total Products: <?= $productCount ?></li>
    <li>Total Orders: <?= $orderCount ?></li>
    <li>Low Stock Alerts: <?= $lowStock ?></li>
</ul>
</body>
</html>
