<?php
include 'config.php';
$result = $conn->query('SELECT * FROM products');
?>
<!DOCTYPE html>
<html>
<head><title>Products</title></head>
<body>
<h2>Product List</h2>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Price</th><th>Qty</th></tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['price'] ?></td>
    <td><?= $row['quantity'] ?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
