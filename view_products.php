<?php
include("connect.php");

// Фильтрация по названию
$filter_name = "";
$query = "SELECT * FROM products WHERE 1=1"; // Базовый запрос

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name'])) {
        $filter_name = $_POST['name'];
        $query .= " AND name LIKE ?";
    }
}

// Подготовка запроса с параметрами
$stmt = $conn->prepare($query);

if (!empty($filter_name)) {
    $filter_name = "%" . $filter_name . "%";
    $stmt->bind_param("s", $filter_name);
}

$stmt->execute();
$result = $stmt->get_result();

?>
<?php $title_page = "Товары";
include("src/head.php"); ?>

    <h1>Available Products</h1>

    <h2>Filter Products</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Search by name" value="<?php echo htmlspecialchars($filter_name); ?>">
        <button type="submit">Search</button>
        <a href="view_products.php" style="text-decoration: none;">
            <button type="button">Clear Filters</button>
        </a>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
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
                <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image" style="max-width: 100px;"></td>
                <td><?php echo htmlspecialchars($row['sku']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo htmlspecialchars($row['part_count']); ?></td>
                <td><?php echo htmlspecialchars($row['age_group']); ?></td>
                <td><?php echo htmlspecialchars($row['child_count']); ?></td>
                <td><a href="view_materials.php">View Materials</a></td> <!-- Ссылка на материалы -->
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="index.php">Back to Home</a>

<?php include("src/footer.php"); ?>
<!-- <!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
</head>
<body>
    
</body>
</html> -->

<?php
$stmt->close();
$conn->close();
?>
