<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include("connect.php");

// Удаление материала
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM materials WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_materials.php"); // Перенаправление после удаления
    exit();
}

// Фильтрация по названию
$filter_title = "";
$query = "SELECT * FROM materials WHERE 1=1"; // Базовый запрос

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['title'])) {
        $filter_title = $_POST['title'];
        $query .= " AND title LIKE ?";
    }
}

// Подготовка запроса с параметрами
$stmt = $conn->prepare($query);

if (!empty($filter_title)) {
    $filter_title = "%" . $filter_title . "%";
    $stmt->bind_param("s", $filter_title);
}

$stmt->execute();
$result = $stmt->get_result();
?>
<?php $title_page = "Материалы в панели администратора";
include("src/head.php"); ?>

    <h1>Manage Materials</h1>
    
    <h2>Filter Materials</h2>
    <form method="post">
        <input type="text" name="title" placeholder="Search by title" value="<?php echo htmlspecialchars($filter_title); ?>">
        <button type="submit">Search</button>
        <a href="manage_materials.php" style="text-decoration: none;">
            <button type="button">Clear Filters</button>
        </a>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Format</th>
            <th>Size</th>
            <th>File</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['format']); ?></td>
                <td><?php echo htmlspecialchars($row['size']); ?></td>
                <td><a href="<?php echo $row['file_path']; ?>" download>Download</a></td>
                <td>
                    <a href="edit_material.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this material?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="add_material.php">Add New Material</a>
    <a href="admin_panel.php">Back to Admin Panel</a>

<?php include("src/footer.php"); ?>
<!-- <!DOCTYPE html>
<html>
<head>
    <title>Manage Materials</title>
</head>
<body>
    
</body>
</html> -->

<?php
$stmt->close();
$conn->close();
?>