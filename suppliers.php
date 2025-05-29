<?php
include 'config.php';
$result = $conn->query("SELECT * FROM suppliers");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Suppliers</title>
</head>
<body>
<h2>Supplier List</h2>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th></tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['phone'] ?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
