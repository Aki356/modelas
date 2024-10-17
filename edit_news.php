<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include("connect.php");

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $news = $result->fetch_assoc();
} else {
    die("News not found.");
}

// Обработка изменения новости
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Обновляем заголовок и содержание, не изменяя изображение
    $stmt = $conn->prepare("UPDATE news SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id);

    if ($stmt->execute()) {
        echo "News updated successfully.";
        header("Location: manage_news.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit News</title>
</head>
<body>
    <h1>Edit News</h1>
    <form method="post">
        <input type="text" name="title" value="<?php echo htmlspecialchars($news['title']); ?>" required>
        <textarea name="content" required><?php echo htmlspecialchars($news['content']); ?></textarea>
        <button type="submit">Update News</button>
    </form>
    <?php if ($news['image']): ?>
        <h3>Current Image:</h3>
        <img src="<?php echo $news['image']; ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" style="max-width: 300px;">
    <?php endif; ?>
    <a href="manage_news.php">Cancel</a>
</body>
</html>