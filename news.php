<?php
include("connect.php");


$result = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
?>
<?php $title_page = "Новости сайта";
include("src/head.php"); ?>

    <div class="directory_path">
        <ul>
            <li>
                <a href="index.php">Главная</a>
            </li>
            <li>
                <span>Новости</span>
            </li>
        </ul>
    </div>
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

<?php include("src/footer.php"); ?>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>News</title>
    <style>
        
    </style>
</head>
<body>
    
</body>
</html> -->

<?php
$conn->close();
?>