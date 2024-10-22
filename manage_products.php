<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include("connect.php");
// Удаление товара
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_products.php"); // Перенаправление после удаления
    exit();
}

$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
</head>
<body>
    <h1>Manage Products</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Description</th>
            <th>Part Count</th>
            <th>Age Group</th>
            <th>Child Count</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['sku']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo htmlspecialchars($row['part_count']); ?></td>
                <td><?php echo htmlspecialchars($row['age_group']); ?></td>
                <td><?php echo htmlspecialchars($row['child_count']); ?></td>
                <td>
                    <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="add_product.php">Add New Product</a>
    <a href="admin_panel.php">Back to Admin Panel</a>
</body>
</html>

<?php
$conn->close();
?>
