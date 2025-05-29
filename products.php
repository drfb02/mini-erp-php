<?php
include 'config.php';
$result = $conn->query("SELECT p.*, s.name AS supplier_name FROM products p LEFT JOIN suppliers s ON p.supplier_id = s.id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <style>
        .low-stock { color: red; font-weight: bold; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
<h2>Product List</h2>
<table>
<tr><th>ID</th><th>Name</th><th>Price</th><th>Qty</th><th>Min Stock</th><th>Supplier</th></tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr<?= ($row['quantity'] < $row['minimum_stock']) ? ' class="low-stock"' : '' ?>>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['price'] ?></td>
    <td><?= $row['quantity'] ?></td>
    <td><?= $row['minimum_stock'] ?></td>
    <td><?= $row['supplier_name'] ?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
