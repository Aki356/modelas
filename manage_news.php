<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include("connect.php");

// Удаление новости
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_news.php"); // Перенаправление после удаления
    exit();
}

// Фильтрация по названию и дате
$filter_title = "";
$filter_date = "";
$query = "SELECT * FROM news WHERE 1=1"; // Базовый запрос

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['title'])) {
        $filter_title = $_POST['title'];
        $query .= " AND title LIKE ?";
    }
    if (!empty($_POST['date'])) {
        $filter_date = $_POST['date'];
        $query .= " AND DATE(created_at) = ?";
    }
}

// Подготовка запроса с параметрами
$stmt = $conn->prepare($query);

if (!empty($filter_title) && !empty($filter_date)) {
    $filter_title = "%" . $filter_title . "%";
    $stmt->bind_param("ss", $filter_title, $filter_date);
} elseif (!empty($filter_title)) {
    $filter_title = "%" . $filter_title . "%";
    $stmt->bind_param("s", $filter_title);
} elseif (!empty($filter_date)) {
    $stmt->bind_param("s", $filter_date);
}

$stmt->execute();
$result = $stmt->get_result();
?>
<?php $title_page = "Новости в панели администратора";
include("src/head.php"); ?>

    <h1>Manage News</h1>
    
    <h2>Filter News</h2>
    <form method="post">
        <input type="text" name="title" placeholder="Search by title" value="<?php echo htmlspecialchars($filter_title); ?>">
        <input type="date" name="date" value="<?php echo htmlspecialchars($filter_date); ?>">
        <button type="submit">Search</button>
        <a href="manage_news.php" style="text-decoration: none;">
            <button type="button">Clear Filters</button>
        </a>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Image</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td>
                    <?php if ($row['image']): ?>
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" style="max-width: 100px;">
                    <?php endif; ?>
                </td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <a href="edit_news.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this news?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="admin_panel.php">Back to Admin Panel</a>

<?php include("src/footer.php"); ?>
<!-- <!DOCTYPE html>
<html>
<head>
    <title>Manage News</title>
</head>
<body>
    
</body>
</html> -->

<?php
$stmt->close();
$conn->close();
?>