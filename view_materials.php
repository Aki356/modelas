<?php
include("connect.php");

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

// Пагинация
$per_page = 10; // Количество материалов на странице
$total = $result->num_rows; // Общее количество материалов
$total_pages = ceil($total / $per_page); // Общее количество страниц

// Получаем номер текущей страницы
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Убедитесь, что номер страницы не меньше 1
$page = min($page, $total_pages); // Убедитесь, что номер страницы не больше общего количества страниц

$offset = ($page - 1) * $per_page; // Смещение для SQL-запроса

// Повторный запрос для получения материалов с учетом пагинации
$query .= " LIMIT ?, ?";
$stmt = $conn->prepare($query);
if (!empty($filter_title)) {
    $stmt->bind_param("sii", $filter_title, $offset, $per_page);
} else {
    $stmt->bind_param("ii", $offset, $per_page);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Materials</title>
</head>
<body>
    <h1>Available Materials</h1>

    <h2>Filter Materials</h2>
    <form method="post">
        <input type="text" name="title" placeholder="Search by title" value="<?php echo htmlspecialchars($filter_title); ?>">
        <button type="submit">Search</button>
        <a href="view_materials.php" style="text-decoration: none;">
            <button type="button">Clear Filters</button>
        </a>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Format</th>
            <th>Size</th>
            <th>Download</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['format']); ?></td>
                <td><?php echo htmlspecialchars($row['size']); ?></td>
                <td><a href="<?php echo $row['file_path']; ?>" download>Download</a></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div class="pagination">
        <?php if ($total_pages > 1): ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" style="margin: 0 5px;<?php if ($i === $page) echo ' font-weight: bold;'; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        <?php endif; ?>
    </div>

    <a href="index.php">Back to Home</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
