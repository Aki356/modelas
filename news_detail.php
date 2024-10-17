<?php

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
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $news['title']; ?></title>
</head>
<body>
    <h1><?php echo $news['title']; ?></h1>
    <?php if ($news['image']): ?>
        <img src="<?php echo $news['image']; ?>" alt="<?php echo $news['title']; ?>" style="max-width: 600px;">
    <?php endif; ?>
    <p><strong>Published on:</strong> <?php echo $news['created_at']; ?></p>
    <p><?php echo nl2br($news['content']); ?></p>
    <a href="news.php">Back to News</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
