<?php
include("connect.php");

$result = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>News</title>
    <style>
        .news-item {
            margin-bottom: 20px;
        }
        .news-title {
            font-size: 1.5em;
            color: blue;
            text-decoration: none;
        }
        .news-title:hover {
            text-decoration: underline;
        }
        .news-image {
            max-width: 300px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Latest News</h1>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="news-item">
            <a href="news_detail.php?id=<?php echo $row['id']; ?>">
                <h2 class="news-title"><?php echo $row['title']; ?></h2>
                <?php if ($row['image']): ?>
                    <img class="news-image" src="<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
                <?php endif; ?>
            </a>
            <p>Published on: <?php echo $row['created_at']; ?></p>
        </div>
        <hr>
    <?php endwhile; ?>
</body>
</html>

<?php
$conn->close();
?>